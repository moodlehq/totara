<?php

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');

$id = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

if (!$program = new program($id)) {
    print_error('error:programid', 'local_program');
}

admin_externalpage_setup('manageprograms', '', array('id' => $id, 'delete' => $delete), $CFG->wwwroot.'/local/program/delete.php');

$returnurl = "{$CFG->wwwroot}/local/program/edit.php?id={$program->id}";
$deleteurl = "{$CFG->wwwroot}/local/program/delete.php?id={$program->id}&amp;sesskey={$USER->sesskey}&amp;delete=".md5($program->timemodified);

if (!$delete) {
    admin_externalpage_print_header();
    $strdelete = get_string('checkprogramdelete', 'local_program');
    $strdelete .= "<br /><br />".format_string($program->fullname);
    $sql = "SELECT COUNT(DISTINCT pc.userid)
        FROM {$CFG->prefix}user AS u
        JOIN {$CFG->prefix}prog_completion AS pc ON u.id=pc.userid
        JOIN {$CFG->prefix}prog_user_assignment AS pua ON pua.programid = pc.programid AND pua.userid = pc.userid
        WHERE pc.programid = {$program->id}
        AND pc.coursesetid = 0
        AND pc.status = ".STATUS_PROGRAM_INCOMPLETE;
    $incomplete_program_learners = count_records_sql($sql);

    if ($incomplete_program_learners && $incomplete_program_learners > 0) {
        $strdelete .= "<br /><br />".get_string('xlearnerscurrentlyenrolled', 'local_program', $incomplete_program_learners);
    }

    notice_yesno(
        $strdelete,
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}

if ($delete != md5($program->timemodified)) {
    print_error('error:badcheckvariable', 'local_program');
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
