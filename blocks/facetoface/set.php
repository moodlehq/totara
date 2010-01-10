<?php
require_once '../../config.php';
require_once "$CFG->dirroot/calendar/lib.php";

$var        = required_param('var', PARAM_ALPHA);
$currenttab = required_param('tab', PARAM_ALPHA);
$day        = required_param('cal_d', PARAM_INT);
$month      = required_param('cal_m', PARAM_INT);
$year       = required_param('cal_y', PARAM_INT);

calendar_session_vars();

switch($var) {
case 'showgroups':
    $SESSION->cal_show_groups = !$SESSION->cal_show_groups;
    set_user_preference('calendar_savedflt', calendar_get_filters_status());
    break;
case 'showcourses':
    $SESSION->cal_show_course = !$SESSION->cal_show_course;
    set_user_preference('calendar_savedflt', calendar_get_filters_status());
    break;
case 'showglobal':
    $SESSION->cal_show_global = !$SESSION->cal_show_global;
    set_user_preference('calendar_savedflt', calendar_get_filters_status());
    break;
case 'showuser':
    $SESSION->cal_show_user = !$SESSION->cal_show_user;
    set_user_preference('calendar_savedflt', calendar_get_filters_status());
    break;
}

redirect("calendar.php?tab=$currenttab&amp;cal_d=$day&amp;cal_m=$month&amp;cal_y=$year");
