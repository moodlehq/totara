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
 * @copyright Catalyst IT Limited
 * @author Aaron Barnes
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */

/**
 * Course grade competency evidence type
 */
class competency_evidence_type_coursegrade extends competency_evidence_type {

    /**
     * Evidence item type
     * @var string
     */
    public $itemtype = COMPETENCY_EVIDENCE_TYPE_COURSE_GRADE;

    /**
     * Return evidence name and link
     *
     * @return  string
     */
    public function get_name() {
        global $CFG;

        // Get course name
        $course = get_field('course', 'fullname', 'id', $this->iteminstance);

        return '<a href="'.$CFG->wwwroot.'/course/view.php?id='.$this->iteminstance.'">'.$course.'</a>';
    }

    /**
     * Return evidence item type and link
     *
     * @return  string
     */
    public function get_type() {
        global $CFG;

        $name = $this->get_type_name();

        return '<a href="'.$CFG->wwwroot.'/grade/report/grader/index.php?id='.$this->iteminstance.'">'.$name.'</a>';
    }

    /**
     * Get human readable type name
     *
     * @return  string
     */
    public function get_activity_type() {
        return '';
    }
}
