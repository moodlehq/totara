<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/evidenceitem/type/abstract.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id      = required_param('id', PARAM_INT); // Competency ID
$related = required_param('related', PARAM_INT); // Related competency ID

// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Load data
$hierarchy         = new competency();

// The relationship could be recorded in one of two directions
$item              = get_record('comp_relations', 'id1', $id, 'id2', $related);
if (!$item) {
    $item = get_record('comp_relations', 'id2', $id, 'id1', $related);
}

// If the relationship's not recorded in either direction
if (!$item) {
    error('Could not find competency relationship');
}

// Load related competency
if (!$rcompetency = get_record('comp', 'id', $related)) {
    error('Competency ID was incorrect');
}

// Check capabilities
require_capability('moodle/local:update'.$hierarchy->prefix, $sitecontext);

// Setup page and check permissions
admin_externalpage_setup($hierarchy->prefix.'manage');


///
/// Display page
///

admin_externalpage_print_header();

// Cancel/return url
$return = "{$CFG->wwwroot}/hierarchy/item/view.php?prefix={$hierarchy->prefix}&id={$id}";


if (!$delete) {
    $message = get_string('relateditemremovecheck', $hierarchy->prefix).'<br /><br />';
    $message .= format_string($rcompetency->fullname);

    $action = "{$CFG->wwwroot}/hierarchy/prefix/competency/related/remove.php?id={$id}&amp;related={$related}&amp;delete=".md5($rcompetency->timemodified)."&amp;sesskey={$USER->sesskey}";

    notice_yesno($message, $action, $return);

    print_footer();
    exit;
}


///
/// Delete
///

if ($delete != md5($rcompetency->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

// Delete relationship
delete_records('comp_relations', 'id1', $id, 'id2', $related);
delete_records('comp_relations', 'id2', $id, 'id1', $related);

add_to_log(SITEID, 'competency', 'delete related', "item/view.php?id=$id", $rcompetency->fullname." (ID $related)");

$message = get_string('removed'.$hierarchy->prefix.'relateditem', $hierarchy->prefix, format_string($rcompetency->fullname));

print_heading($message);
print_continue($return);
print_footer();
