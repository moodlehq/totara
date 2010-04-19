<?php

require_once('../../../../config.php');
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
admin_externalpage_setup('competencyscales');

require_capability('moodle/local:deletecompetency', $sitecontext);

if (!$value = get_record('comp_scale_values', 'id', $id)) {
    error('Competency scale value ID was incorrect');
}


///
/// Display page
///

admin_externalpage_print_header();

$returnurl = "{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$value->scaleid}";
$deleteurl = "{$CFG->wwwroot}/hierarchy/type/competency/scale/deletevalue.php?id={$value->id}&amp;delete=".md5($value->timemodified)."&amp;sesskey={$USER->sesskey}";

// Can't delete if the scale is in use (assigned to at least one framework
// which has at least one competency)
if ( competency_scale_is_used($value->scaleid) ) {
    print_error('error:nodeletescalevalueinuse', 'hierarchy', $returnurl);
}

if (!$delete) {
    $strdelete = get_string('deletecheckscalevalue', 'competency');

    notice_yesno(
        "{$strdelete}<br /><br />" . format_string($value->name),
        $deleteurl,
        $returnurl
    );

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

delete_records('comp_scale_values', 'id', $value->id);

print_heading(get_string('deletedcompetencyscalevalue', 'competency', format_string($value->name)));
print_continue($returnurl);
print_footer();
