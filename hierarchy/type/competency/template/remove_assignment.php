<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$templateid     = required_param('templateid', PARAM_INT); // Competency template ID
$assignmentid   = required_param('assignment', PARAM_INT); // Assigned competency ID

// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Load data
$hierarchy          = new competency();
$template           = $hierarchy->get_template($templateid);
$competency         = $hierarchy->get_item($assignmentid);

if (!$template) {
    error('Could not find competency template');
}

if (!$competency) {
    error('Could not find assigned competency');
}

// Check capabilities
require_capability('moodle/local:update'.$hierarchy->prefix.'template', $sitecontext);

// Setup page and check permissions
admin_externalpage_setup($hierarchy->prefix.'frameworkmanage');


///
/// Display page
///

admin_externalpage_print_header();

// Cancel/return url
$return = "{$CFG->wwwroot}/hierarchy/type/competency/template/view.php?id={$template->id}";


if (!$delete) {
    $message = get_string('templatecompetencyremovecheck', $hierarchy->prefix).'<br /><br />';
    $message .= format_string($competency->fullname);

    $action = "{$CFG->wwwroot}/hierarchy/type/competency/template/remove_assignment.php?templateid={$template->id}&amp;assignment={$competency->id}&amp;delete=".md5($competency->timemodified)."&amp;sesskey={$USER->sesskey}";

    notice_yesno($message, $action, $return);

    print_footer();
    exit;
}


///
/// Delete
///

if ($delete != md5($competency->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

$hierarchy->delete_assigned_template_competency($template->id, $competency->id);

$message = get_string('removed'.$hierarchy->prefix.'templatecompetency', $hierarchy->prefix, format_string($competency->fullname));

print_heading($message);
print_continue($return);
print_footer();
