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

require_once($CFG->libdir.'/completionlib.php');

/**
 * Self course completion marking
 * Let's a user manually complete a course
 *
 * Will only display if the course has completion enabled,
 * there is a self completion criteria, and the logged in user is yet
 * to complete the course.
 */
class block_selfcompletion extends block_base {

    public function init() {
        $this->title   = get_string('selfcompletion', 'block_selfcompletion');
        $this->version = 2009072800;
    }

    public function get_content() {
        global $USER, $COURSE, $CFG;

        // If content is cached
        if ($this->content !== NULL) {
          return $this->content;
        }

        // Create empty content
        $this->content = new stdClass;
        $this->content->footer = '';

        // Can edit settings?
        $can_edit = has_capability('moodle/course:update', get_context_instance(CONTEXT_COURSE, $COURSE->id));

        // Get course completion data
        $info = new completion_info($COURSE);

        // Don't display if completion isn't enabled!
        if (!completion_info::is_enabled_for_site()) {
            if ($can_edit) {
                $this->content->text = get_string('completionnotenabledforsite', 'completion');
            }
            return $this->content;
        }
        elseif (!$info->is_enabled()) {
            if ($can_edit) {
                $this->content->text = get_string('completionnotenabledforcourse', 'completion');
            }
            return $this->content;
        }

        // Get this user's data
        $completion = $info->get_completion($USER->id, COMPLETION_CRITERIA_TYPE_SELF);

        // Check if self completion is one of this course's criteria
        if (empty($completion)) {
            if ($can_edit) {
                $this->content->text = get_string('selfcompletionnotenabled', 'block_selfcompletion');
            }
            return $this->content;
        }

        // Check this user is enroled
        if (!$info->is_tracked_user($USER->id)) {
            $this->content->text = get_string('notenroled', 'completion');
            return $this->content;
        }

        // Get generic blurb text
        $this->content->text = get_string('blurb', 'block_selfcompletion');

        // Get course specific blurb text
        $blurbkey = 'blurb_course_'.$COURSE->id;
        $blurbstr = get_string($blurbkey, 'block_selfcompletion');

        if ($blurbstr !== '[['.$blurbkey.']]') {
            $this->content->text .= '<br />'.$blurbstr;
        }

        // Is course complete?
        if ($info->is_course_complete($USER->id)) {
            $this->content->text .= get_string('coursealreadycompleted', 'completion');
            return $this->content;
        }
        // Check if the user has already marked themselves as complete
        elseif ($completion->is_complete()) {
            $this->content->text .= get_string('alreadyselfcompleted', 'block_selfcompletion');
            return $this->content;
        }
        // If user is not complete, or has not yet self completed
        else {
            $this->content->footer = '<br /><a href="'.$CFG->wwwroot.'/course/togglecompletion.php?course='.$COURSE->id.'">';
            $this->content->footer .= get_string('completecourse', 'block_selfcompletion').'</a>...';
        }

        return $this->content;
    }
}
