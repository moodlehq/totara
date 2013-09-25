<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Russell England <russell.england@catalyst-eu.net>
 * @package totara
 * @subpackage reportbuilder
 */

class rb_plan_courses_completion_history_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;
    public $defaultsortcolumn, $defaultsortorder;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $courseid = array_key_exists('courseid', $data) ? $data['courseid'] : null;

        $url = new moodle_url('/totara/plan/record/courses.php', array('history' => 1));

        $this->url = $url->out_as_local_url();
        $this->source = 'dp_course_completion_history';
        $this->shortname = 'plan_courses_completion_history';
        $this->defaultsortcolumn = 'timecompleted';
        $this->fullname = get_string('recordoflearningcoursescompletionhistory', 'totara_plan');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'coursetypeicon',
                'heading' => get_string('coursetypeicon', 'totara_reportbuilder'),
            ),
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => get_string('coursetitle', 'rb_source_dp_course'),
            ),
            array(
                'type' => 'base',
                'value' => 'timecompleted',
                'heading' => get_string('timecompleted', 'rb_source_dp_course_completion_history'),
            ),
            array(
                'type' => 'base',
                'value' => 'grade',
                'heading' => get_string('grade', 'rb_source_dp_course_completion_history'),
            )
        );

        $this->filters = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
                'advanced' => 0,
            ),
            array(
                'type' => 'base',
                'value' => 'timecompleted',
                'advanced' => 0,
            ),
            array(
                'type' => 'base',
                'value' => 'grade',
                'advanced' => 0,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if (isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        if (isset($courseid)) {
            $this->embeddedparams['courseid'] = $courseid;
        }

        parent::__construct();
    }
}
