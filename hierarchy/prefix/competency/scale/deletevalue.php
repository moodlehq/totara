<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once('lib.php');

hierarchy::support_old_url_syntax();

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id = required_param('id', PARAM_INT);
$prefix = required_param('prefix', PARAM_ALPHA);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Setup page and check permissions
admin_externalpage_setup($prefix.'manage');

require_capability('moodle/local:deletecompetency', $sitecontext);

if (!$value = get_record('comp_scale_values', 'id', $id)) {
    error('Competency scale value ID was incorrect');
}

$scale = get_record('comp_scale', 'id', $value->scaleid);

///
/// Display page
///


$returnurl = "{$CFG->wwwroot}/hierarchy/prefix/competency/scale/view.php?id={$value->scaleid}&amp;prefix=competency";
$deleteurl = "{$CFG->wwwroot}/hierarchy/prefix/competency/scale/deletevalue.php?id={$value->id}&amp;delete=".md5($value->timemodified)."&amp;sesskey={$USER->sesskey}&amp;prefix=competency";

// Can't delete if the scale is in use
if ( competency_scale_is_used($value->scaleid) ) {
    totara_set_notification(get_string('error:nodeletescalevalueinuse', 'hierarchy'), $returnurl);
}

if ($value->id == $scale->defaultid) {
    totara_set_notification(get_string('error:nodeletecompetencyscalevaluedefault', 'competency'), $returnurl);
}

if (!$delete) {
    admin_externalpage_print_header();
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
    totara_set_notification("The check variable was wrong - try again", $returnurl);
}

if (!confirm_sesskey()) {
    totara_set_notification(get_string('confirmsesskeybad', 'error'), $returnurl);
}

if(delete_records('comp_scale_values', 'id', $value->id)) {
    add_to_log(SITEID, 'competency', 'delete scale value', "prefix/competency/scale/view.php?id={$value->scaleid}&amp;prefix=competency", "$value->name (ID $value->id)");
    totara_set_notification(get_string('deletedcompetencyscalevalue', 'competency', format_string($value->name)), $returnurl, array('style' => 'notifysuccess'));
} else {
    totara_set_notification(get_string('couldnotdeletescalevalue', 'competency'), $returnurl);
}

