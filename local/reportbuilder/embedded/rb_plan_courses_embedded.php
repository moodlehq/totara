<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

class rb_plan_courses_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $rolstatus = array_key_exists('rolstatus', $data) ? $data['rolstatus'] : null;

        $this->url = '/local/plan/record/courses.php';
        $this->source = 'dp_course';
        $this->shortname = 'plan_courses';
        $this->fullname = get_string('recordoflearningcourses', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'coursetypeicon',
                'heading' => get_string('coursetypeicon', 'rb_source_dp_course'),
            ),
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => get_string('coursetitle', 'rb_source_dp_course'),
            ),
            array(
                'type' => 'plan',
                'value' => 'planlink',
                'heading' => get_string('plan', 'rb_source_dp_course'),
            ),
            array(
                'type' => 'plan',
                'value' => 'courseduedate',
                'heading' => get_string('courseduedate', 'rb_source_dp_course'),
            ),
            array(
                'type' => 'course_completion',
                'value' => 'statusandapproval',
                'heading' => get_string('progress', 'rb_source_dp_course'),
            ),
        );

        $this->filters = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
                'advanced' => 0,
            ),
            /*array(
                'type' => 'course',
                'value' => 'status',
                'advanced' => 1,
            ),*/
            array(
                'type' => 'plan',
                'value' => 'name',
                'advanced' => 1,
            ),
            array(
                'type' => 'plan',
                'value' => 'courseduedate',
                'advanced' => 1,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        if(isset($rolstatus)) {
            $this->embeddedparams['rolstatus'] = $rolstatus;
        }

        parent::__construct();
    }
}
