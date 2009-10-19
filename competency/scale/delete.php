<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Setup page and check permissions
admin_externalpage_setup('competencyscales');

require_capability('moodle/local:deletecompetency', $sitecontext);

if (!$scale = get_record('competency_scale', 'id', $id)) {
    error('Competency scale ID was incorrect');
}


///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheckscale', 'competency');

    notice_yesno("$strdelete<br /><br />" . format_string($scale->name),
                 "{$CFG->wwwroot}/competency/scale/delete.php?id={$scale->id}&amp;delete=".md5($scale->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/competency/scale/index.php");

    print_footer();
    exit;
}


///
/// Delete competency scale
///

if ($delete != md5($scale->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'competencyscales', 'delete', "view.php?id=$scale->id", "$scale->name (ID $scale->id)");

delete_records('competency_scale', 'id', $scale->id);

print_heading(get_string('deletedcompetencyscale', 'competency', format_string($scale->name)));
print_continue("{$CFG->wwwroot}/competency/scale/index.php");
print_footer();
