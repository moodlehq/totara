<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT);
// Delete confirmation hash
// TODO implement this once the timemodified for a program
// is correctly updated
$delete = optional_param('delete', '', PARAM_TEXT);

if (!$program = new program($id)) {
    print_error('error:programid', 'local_program');
}

admin_externalpage_setup('manageprograms', '', array('id' => $id, 'delete' => $delete), $CFG->wwwroot.'/local/program/delete.php');

$returnurl = "{$CFG->wwwroot}/local/program/edit.php?id={$program->id}";
$deleteurl = "{$CFG->wwwroot}/local/program/delete.php?id={$program->id}&amp;sesskey={$USER->sesskey}&amp;delete=1";

if (!$delete) {
    admin_externalpage_print_header();
    $strdelete = get_string('checkprogramdelete', 'local_program');
    $strdelete .= "<br /><br />".format_string($program->fullname);

    $incomplete_program_learners = $program->get_program_learners(STATUS_PROGRAM_INCOMPLETE);

    if (count($incomplete_program_learners) > 0) {
        $strdelete .= "<br /><br />".get_string('xlearnerscurrentlyenrolled', 'local_program', count($incomplete_program_learners));
    }

    notice_yesno(
        $strdelete,
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

begin_sql();

if ($program->delete()) {
    if(!prog_fix_program_sortorder($program->category)) {
        rollback_sql();
    } else {
        commit_sql();
    }
    $notification_url = "{$CFG->wwwroot}/course/category.php?id={$program->category}";
    totara_set_notification(get_string('programdeletesuccess', 'local_program', $program->fullname), $notification_url, array('style' => 'notifysuccess'));
} else {
    rollback_sql();
}

?>
