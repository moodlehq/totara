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
class block_totara_recent_learning extends block_list {

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

        $completions = completion_info::get_all_courses($USER->id);

        $sql = "SELECT c.id,c.fullname FROM
            {$CFG->prefix}role_assignments ra
            INNER JOIN {$CFG->prefix}context cx
                ON ra.contextid = cx.id AND cx.contextlevel = " . CONTEXT_COURSE . "
            LEFT JOIN {$CFG->prefix}course c
                ON cx.instanceid = c.id
            WHERE ra.userid = " . $USER->id . "
            ORDER BY ra.timestart DESC";

        $courses = get_records_sql($sql);
        if(!$courses) {
            return $this->content;

        }
        if ($courses) {
            foreach($courses as $course) {
                $id = $course->id;
                $name = $course->fullname;

                if(array_key_exists($id, $completions)) {
                    $comp = $completions[$id];
                    $statusstring = completion_completion::get_status($completions[$id]);
                    $status = get_string($statusstring, 'completion');
                } else {
                    $statusstring = 'notyetstarted';
                    $status = get_string($statusstring, 'completion');

                }

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
