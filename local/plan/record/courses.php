<?php

/**
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    moodle
 * @subpackage totara
 * @author     Aaron Wells <aaronw@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * Displays collaborative features for the current user
 *
 */

    require_once('../../../config.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once($CFG->dirroot.'/local/reportheading/lib.php');
    require_once($CFG->dirroot.'/local/plan/lib.php');

    require_login();

    global $SESSION,$USER;

//    $userid     = optional_param('userid', null, PARAM_INT);                       // which user to show
    $format     = optional_param('format','',PARAM_TEXT); //export format
    $planstatus = optional_param('status', 'all', PARAM_ALPHANUM);
    if ( !in_array($planstatus, array('active','completed','all')) ){
        $planstatus = 'all';
    }
    $ustatus = ucfirst($planstatus);

    // default to current user
    if(empty($userid)) {
        $userid = $USER->id;
    }

    if (! $user = get_record('user', 'id', $userid)) {
        error('User not found');
    }

    $context = get_context_instance(CONTEXT_SYSTEM);
    // users can only view their own and their staff's pages
    // or if they are an admin
    if ($USER->id != $userid && !totara_is_manager($userid) && !has_capability('moodle/site:doanything',$context)) {
        error('You cannot view this page');
    }

    // todo: Set the page's heading
    if ($USER->id != $userid) {
        $strheading = get_string('recordoflearningfor','local').fullname($user, true);
    } else {
        $strheading = get_string('myrecordoflearning', 'local');
    }
    $strheading = "Record of Learning: {$ustatus} Courses";

    $embed = new object();
    $embed->source = 'dp_course';
    $embed->fullname = 'Record of Learning: Courses';
//    $embed->filters = array(
//        array(
//            'type' => 'competency',
//            'value' => 'fullname',
//            'advanced' => 0,
//        ),
//        array(
//            'type' => 'competency',
//            'value' => 'priority',
//            'advanced' => 1,
//        ),
//        array(
//            'type' => 'competency',
//            'value' => 'duedate',
//            'advanced' => 1,
//        ),
//        array(
//            'type' => 'plan',
//            'value' => 'name',
//            'advanced' => 1,
//        ),
//    ); //hide filter block
    $embed->columns = array(
        array(
            'type' => 'course',
            'value' => 'courselink',
            'heading' => 'Course Title',
        ),
        array(
            'type' => 'plan',
            'value' => 'planlink',
            'heading' => 'Plan',
        ),
        array(
            'type' => 'plan',
            'value' => 'status',
            'heading' => 'Plan status',
        ),
        array(
            'type' => 'plan',
            'value' => 'courseduedate',
            'heading' => 'Course due date',
        ),
        array(
            'type' => 'plan',
            'value' => 'coursepriority',
            'heading' => 'Course priority',
        ),
    );
    $embed->contentmode = 0;
    $embed->embeddedparams = array(
        // show report for a specific user
        'userid' => $userid,
    );
    if ( $planstatus !== 'all' ){
        $embed->embeddedparams['planstatus'] = $planstatus;
    }
    $shortname = 'plan_courses';
    $report = new reportbuilder(null, $shortname, $embed);

    if($format!='') {
        $report->export_data($format);
        die;
    }

    $report->include_js();

    ///
    /// Display the page
    ///

    print_header($strheading, $strheading, build_navigation($strheading));

    echo '<h1>'.$strheading.'</h1>';

    // tab bar
    $tabs = array();
    $row = array();

    $coursename = get_config(null, 'dp_course');
    $coursename = $coursename ? $coursename : get_string('course_defaultname', 'local_plan');
    $competencyname = get_config(null, 'dp_competency');
    $competencyname = $competencyname ? $competencyname : get_string('competency_defaultname', 'local_plan');

    // overview tab
    $row[] = new tabobject(
            'courses',
            $CFG->wwwroot . '/local/plan/record/courses.php?status=' . $planstatus,
            "{$ustatus} " . $coursename
    );
    $row[] = new tabobject(
            'competencies',
            $CFG->wwwroot . '/local/plan/record/competencies.php?status=' . $planstatus,
            "{$ustatus} " . $competencyname
    );
    $tabs[] = $row;

    echo "\n<ul>\n";
    foreach( array('all','active','completed') as $s ){
        if ( $planstatus == $s ){
            echo "  <li>" . ucfirst($s) ." Learning</li>\n";
        } else {
            echo "  <li><a href=\"{$CFG->wwwroot}/local/plan/record/courses.php?status={$s}\">" . ucfirst($s) . " Learning</a></li>";
        }
    }
    echo "</ul>\n";

    echo print_tabs($tabs, 'courses', null, null, true);


    // display table here
    $fullname = $report->fullname;
    $countfiltered = $report->get_filtered_count();
    $countall = $report->get_full_count();

    // display heading including filtering stats
    if($countfiltered == $countall) {
        print_heading("$countall records.");
    } else {
        print_heading("$countfiltered/$countall records shown.");
    }

    print $report->print_description();

    $report->display_search();

    if($countfiltered>0) {
        print $report->showhide_button();
        $report->display_table();
        print $report->edit_button();
        // export button
        $report->export_select();
    }
   print_footer();

?>
