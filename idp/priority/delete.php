<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Setup page and check permissions
admin_externalpage_setup('idppriorities');

require_capability('moodle/local:manageidppriorities', $sitecontext);

if (!$priority = get_record('idp_tmpl_priority_scale', 'id', $id)) {
    error('IDP priority ID was incorrect');
}

///
/// Display page
///

admin_externalpage_print_header();

$returnurl = "{$CFG->wwwroot}/idp/priority/index.php";
$deleteurl = "{$CFG->wwwroot}/idp/priority/delete.php?id={$scale->id}&amp;delete=".md5($scale->timemodified)."&amp;sesskey={$USER->sesskey}";

// Can't delete if the scale is in use
if ( priority_scale_is_used($id) ) {
    print_error('error:nodeletepriorityinuse', 'idp', $returnurl);
}

if (!$delete) {
    $strdelete = get_string('deletecheckpriority', 'idp');

    notice_yesno(
        "{$strdelete}<br /><br />".format_string($scale->name),
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}


///
/// Delete priority scale
///

if ($delete != md5($priority->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'idppriorities', 'delete', "view.php?id=$priority->id", "$priority->name (ID $priority->id)");

// Delete assignment of scale to frameworks
delete_records('idp_tmpl_priority_scale_assignments', 'priorityscaleid', $scale->id);
// Delete scale values
delete_records('idp_tmpl_priority_scal_val', 'priorityscaleid', $scale->id);
// Delete scale itself
delete_records('idp_tmpl_priority_scale', 'id', $scale->id);

echo '<p>'.get_string('deletedpriorityscale', 'idp', format_string($scale->name)).'</p>';
print_continue($returnurl);
print_footer();
