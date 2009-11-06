<?php

require_once('../../config.php');
require_once('../lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

$hierarchy         = new hierarchy();
$hierarchy->prefix = 'competency';

// Setup page and check permissions
admin_externalpage_setup($hierarchy->prefix.'frameworkmanage');

require_capability('moodle/local:deletecompetencydepth', $sitecontext);

$framework = $hierarchy->get_framework($id);
$depth     = $hierarchy->get_depth_by_id($id);

///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheckdepth', 'competency');

    notice_yesno("$strdelete<br /><br />" . format_string($framework->fullname),
                 "{$CFG->wwwroot}/competency/depth/delete.php?id={$depth->id}&amp;delete=".md5($depth->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/competency/frameworks/index.php");

    print_footer();
    exit;
}


///
/// Delete framework
///

if ($delete != md5($depth->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'competencydepths', 'delete', "view.php?frameworkid=$depth->frameworkid", "$depth->fullname (ID $depth->id)");

$hierarchy->delete_depth();

print_heading(get_string('deleteddepth', 'competency', format_string($framework->fullname)));
print_continue("{$CFG->wwwroot}/competency/frameworks/index.php");
print_footer();
