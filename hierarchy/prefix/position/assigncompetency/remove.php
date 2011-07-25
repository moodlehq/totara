<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Relationship id
$id       = required_param('id', PARAM_INT);
$position = required_param('position', PARAM_INT);
$frameworkid = optional_param('framework', PARAM_INT);

// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

require_capability('moodle/local:updateposition', $sitecontext);

// Setup page and check permissions
admin_externalpage_setup('positionmanage');

// Load assignment
if (!$assignment = get_record('pos_competencies', 'id', $id)) {
    error('Position competency assignment does not exist');
}

// Load competency
if ($assignment->competencyid) {
    $competency = get_record('comp', 'id', $assignment->competencyid);
    $fullname = $competency->fullname;
}
else {
    $template = get_record('comp_template', 'id', $assignment->templateid);
    $fullname = $template->fullname;
}


$returnurl = $CFG->wwwroot.'/hierarchy/item/view.php?prefix=position&amp;id='.$position.'&amp;framework='.$frameworkid;
$deleteurl = $CFG->wwwroot.'/hierarchy/prefix/position/assigncompetency/remove.php?id='.$id.'&amp;position='.$position.'&amp;framework='.$frameworkid.'&amp;delete='.md5($assignment->timecreated).'&amp;sesskey='.$USER->sesskey;

if ($delete) {
    /// Delete
    if ($delete != md5($assignment->timecreated)) {
        print_error('error:checkvariable', 'hierarchy');
    }

    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    if (delete_records('pos_competencies', 'id', $id)) {
        add_to_log(SITEID, 'position', 'delete competency assignment', "item/view.php?id={$position}&amp;prefix=position", "$fullname (ID $assignment->id)");
        totara_set_notification(get_string('deletedassignedcompetency','position'), $returnurl, array('style'=>'notifysuccess'));
    } else {
        totara_set_notification(get_string('deleteassignedcompetency','position'), $returnurl);
    }
} else {
    /// Display page
    admin_externalpage_print_header();
    $strdelete = get_string('competencyassigndeletecheck', 'position');

    notice_yesno(
        "$strdelete<br /><br />" . format_string($fullname),
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}


