<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////


/**
 * Recent learning block
 *
 * Displays recent completed courses
 */
class block_recentlearning extends block_list {

    public function init() {
        $this->title   = get_string('recentlearning', 'block_recentlearning');
        $this->version = 2010112300;
    }

    public function get_content() {
        global $CFG, $USER;

        if($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass;
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';

        $courses = completion_info::get_all_courses($USER->id, 10);

        if(!$courses) {
            return $this->content;
        }

        if ($courses) {
            foreach($courses as $course) {
                $id = $course->course;
                $name = $course->name;
                $enrolled = $course->timeenrolled;
                $completed = $course->timecompleted;

                $statusstring = completion_completion::get_status($course);
                $status = get_string($statusstring, 'completion');

                $starteddate = '';
                if ($course->timestarted != 0) {
                    $starteddate = userdate($course->timestarted, '%e %b %y');
                }
                $enroldate = isset($enrolled) && $enrolled != 0 ? userdate($enrolled, '%e %b %y') : null;
                $completeddate = isset($completed) && $completed != 0 ? userdate($completed, '%e %b %y') : null;

                $test = "<table>";
                $test .= "<tr><td class=\"course\"><a href=\"{$CFG->wwwroot}/course/view.php?id={$id}\" title=\"$name\">$name</a></td>";
                $test .= "<td class=\"status\"><span class=\"completion-$statusstring\" title=\"$status\"></span></td></tr>";
                $test .= "</table>";

                $this->content->items[] = $test;
                $this->content->footer = '<a href="'.$CFG->wwwroot.'/my/coursecompletions.php?id='.$USER->id.'">'.get_string('allmycourses','local').'</a>';
            }
        }

        return $this->content;
    }
}
