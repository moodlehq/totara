<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/evidence/type/abstract.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);
// Course id (if coming from the course view)
$course = optional_param('course', 0, PARAM_INT);

// Load data
$hierarchy         = new competency();
$item              = competency_evidence_type::factory($id);

// Load competency
if (!$competency = get_record('competency', 'id', $item->competencyid)) {
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
if (!$course) {
    $return = "{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$item->competencyid}";
} else {
    $return = "{$CFG->wwwroot}/course/competency.php?id={$course}";
}


if (!$delete) {
    $message = get_string('evidenceitemremovecheck', $hierarchy->prefix).'<br /><br />';
    $message .= format_string($item->get_name());

    $action = "{$CFG->wwwroot}/hierarchy/type/{$hierarchy->prefix}/evidence/remove.php?id={$item->id}&amp;delete=".md5($item->timemodified)."&amp;sesskey={$USER->sesskey}";

    // If called from the course view
    if ($course) {
        $action .= "&amp;course={$course}";
    }

    notice_yesno($message, $action, $return);

    print_footer();
    exit;
}


///
/// Delete
///

if ($delete != md5($item->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

$item->delete($competency);

add_to_log(SITEID, $hierarchy->prefix.'evidence', 'delete', "view.php?id=$item->id", $item->get_name()." (ID $item->id)");

$message = get_string('removed'.$hierarchy->prefix.'evidenceitem', $hierarchy->prefix, format_string($item->get_name()));

print_heading($message);
print_continue($return);
print_footer();
