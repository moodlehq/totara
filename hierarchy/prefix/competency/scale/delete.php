<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
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

if (!$scale = get_record('comp_scale', 'id', $id)) {
    error('Competency scale ID was incorrect');
}

$returnurl = "{$CFG->wwwroot}/hierarchy/framework/index.php?prefix=competency";
$deleteurl = "{$CFG->wwwroot}/hierarchy/prefix/competency/scale/delete.php?id={$scale->id}&amp;delete=".md5($scale->timemodified)."&amp;sesskey={$USER->sesskey}&amp;prefix=competency";

// Can't delete if the scale is in use or assigned
if ( competency_scale_is_used($id) ) {
    print_error('error:nodeletecompetencyscaleinuse', 'competency', $returnurl);
}
if ( competency_scale_is_assigned($id) ) {
    print_error('error:nodeletecompetencyscaleassigned', 'competency', $returnurl);
}

if (!$delete) {
    admin_externalpage_print_header();
    $strdelete = get_string('deletecheckscale', 'competency');

    notice_yesno(
        "{$strdelete}<br /><br />".format_string($scale->name),
        $deleteurl,
        $returnurl
    );

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

begin_sql();

// Delete assignment of scale to frameworks
if(!delete_records('comp_scale_assignments', 'scaleid', $scale->id)) {
    rollback_sql();
    // error
    totara_set_notification(get_string('error:couldnotdeletescale', 'competency', format_string($scale->name)), $CFG->wwwroot . '/hierarchy/framework/index.php?prefix=competency');
}

// Delete scale values
if(!delete_records('comp_scale_values', 'scaleid', $scale->id)) {
    rollback_sql();
    // error
    totara_set_notification(get_string('error:couldnotdeletescale', 'competency', format_string($scale->name)), $CFG->wwwroot . '/hierarchy/framework/index.php?prefix=competency');
}

// Delete scale itself
if(!delete_records('comp_scale', 'id', $scale->id)) {
    totara_set_notification(get_string('error:couldnotdeletescale', 'competency', format_string($scale->name)), $CFG->wwwroot . '/hierarchy/framework/index.php?prefix=competency');
    rollback_sql();
}

commit_sql();
add_to_log(SITEID, 'hierarchy', 'delete competency scale', "framework/index.php?id={$scale->id}&amp;prefix=competency", "$scale->name (ID $scale->id)");
// redirect
totara_set_notification(get_string('deletedcompetencyscale', 'competency', format_string($scale->name)), $CFG->wwwroot . '/hierarchy/framework/index.php?prefix=competency', array('style' => 'notifysuccess'));
