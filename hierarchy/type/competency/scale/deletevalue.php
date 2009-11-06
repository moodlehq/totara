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

if (!$value = get_record('competency_scale_values', 'id', $id)) {
    error('Competency scale value ID was incorrect');
}


///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheckscalevalue', 'competency');

    notice_yesno("$strdelete<br /><br />" . format_string($value->name),
                 "{$CFG->wwwroot}/competency/scale/deletevalue.php?id={$value->id}&amp;delete=".md5($value->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/competency/scale/view.php?id={$value->scaleid}");

    print_footer();
    exit;
}


///
/// Delete competency scale
///

if ($delete != md5($value->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'competencyscalesvalu', 'delete', "view.php?id=$value->scaleid", "$value->name (ID $value->id)");

delete_records('competency_scale_values', 'id', $value->id);

print_heading(get_string('deletedcompetencyscalevalue', 'competency', format_string($value->name)));
print_continue("{$CFG->wwwroot}/competency/scale/view.php?id={$value->scaleid}");
print_footer();
