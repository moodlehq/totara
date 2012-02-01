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
$organisation = required_param('organisation', PARAM_INT);
$frameworkid = optional_param('framework', PARAM_INT);

// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

require_capability('moodle/local:updateorganisation', $sitecontext);

// Setup page and check permissions
admin_externalpage_setup('organisationmanage');

// Load assignment
if (!$assignment = get_record('org_competencies', 'id', $id)) {
    error('Organisation competency assignment does not exist');
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

$returnurl = $CFG->wwwroot.'/hierarchy/item/view.php?prefix=organisation&amp;id='.$organisation.'&amp;framework='.$frameworkid;
$deleteurl = $CFG->wwwroot.'/hierarchy/prefix/organisation/assigncompetency/remove.php?id='.$id.'&amp;organisation='.$organisation.'&amp;framework='.$frameworkid.'&amp;delete='.md5($assignment->timecreated).'&amp;sesskey='.$USER->sesskey;

if ($delete) {
    /// Delete
    if ($delete != md5($assignment->timecreated)) {
        print_error('error:checkvariable', 'hierarchy');
    }

    if (!confirm_sesskey()) {
        print_error('confirmsesskeybad', 'error');
    }

    if (delete_records('org_competencies', 'id', $id)) {
        add_to_log(SITEID, 'organisation', 'delete competency assignment', "item/view.php?id={$organisation}&amp;prefix=organisation", "$fullname (ID $assignment->id)");
        totara_set_notification(get_string('deletedassignedcompetency','organisation'), $returnurl, array('style'=>'notifysuccess'));
    } else {
        totara_set_notification(get_string('error:deleteassignedcompetency','organisation'), $returnurl);
    }

} else {
    /// Display page
    admin_externalpage_print_header();

    if (!$delete) {
        $strdelete = get_string('competencyassigndeletecheck', 'organisation');

        notice_yesno(
            "$strdelete<br /><br />" . format_string($fullname),
            $deleteurl,
            $returnurl
        );

        print_footer();
        exit;
    }
}
