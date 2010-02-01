<?php

function learningreport_link_course($course, $row) {
    global $CFG;
    $courseid = $row->course_id;
    return "<a href=\"{$CFG->wwwroot}/course/view.php?id={$courseid}\">{$course}</a>";
}

function learningreport_link_user($user, $row) {
    global $CFG;
    $userid = $row->user_id;
    return "<a href=\"{$CFG->wwwroot}/user/view.php?id={$userid}\">{$user}</a>";
}

function learningreport_nice_date($date, $row) {
    if($date && $date > 0) {
        return userdate($date, '%d %B %Y');
    } else {
        return '';
    }
}


