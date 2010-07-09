<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Relationship id
$id       = required_param('id', PARAM_INT);
$organisation = required_param('organisation', PARAM_INT);

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


///
/// Display page
///

admin_externalpage_print_header();

$returnurl = $CFG->wwwroot.'/hierarchy/item/view.php?type=organisation&id='.$organisation;
$deleteurl = $CFG->wwwroot.'/hierarchy/type/organisation/assigncompetency/remove.php?id='.$id.'&organisation='.$organisation.'&delete='.md5($assignment->timecreated).'&sesskey='.$USER->sesskey;

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


///
/// Delete
///

if ($delete != md5($assignment->timecreated)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

delete_records('org_competencies', 'id', $id);

add_to_log(SITEID, 'organisation', 'deleteassignment', "view.php?id=$id", "$fullname (ID $assignment->id)");

print_heading(get_string('deletedassignedcompetency', 'organisation', format_string($fullname)));
print_continue($returnurl);
print_footer();
