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
$position = required_param('position', PARAM_INT);

// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

require_capability('moodle/local:updateposition', $sitecontext);

// Setup page and check permissions
admin_externalpage_setup('positionmanage');

// Load assignment
if (!$assignment = get_record('position_competencies', 'id', $id)) {
    error('Position competency assignment does not exist');
}

// Load competency
if ($assignment->competencyid) {
    $competency = get_record('competency', 'id', $assignment->competencyid);
    $fullname = $competency->fullname;
}
else {
    $template = get_record('competency_template', 'id', $assignment->templateid);
    $fullname = $template->fullname;
}


///
/// Display page
///

admin_externalpage_print_header();

$returnurl = $CFG->wwwroot.'/hierarchy/item/view.php?type=position&id='.$position;
$deleteurl = $CFG->wwwroot.'/hierarchy/type/position/assigncompetency/remove.php?id='.$id.'&position='.$position.'&delete='.md5($assignment->timecreated).'&sesskey='.$USER->sesskey;

if (!$delete) {
    $strdelete = get_string('competencyassigndeletecheck', 'position');

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

delete_records('position_competencies', 'id', $id);

add_to_log(SITEID, 'position', 'deleteassignment', "view.php?id=$id", "$fullname (ID $assignment->id)");

print_heading(get_string('deletedassignedcompetency', 'position', format_string($fullname)));
print_continue($returnurl);
print_footer();
