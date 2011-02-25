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

class rb_course_completions_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;

        $this->url = '/my/coursecompletions.php';
        $this->source = 'course_completion';
        $this->shortname = 'course_completions';
        $this->fullname = get_string('mycoursecompletions', 'local');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => 'Course',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'status',
                'heading' => 'Status',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'completeddate',
                'heading' => 'Date Completed',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'organisation',
                'heading' => 'Completed At',
            ),
            array(
                'type' => 'course_completion',
                'value' => 'position',
                'heading' => 'Completed As',
            ),
        );

        // no filters
        $this->filters = array();

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        // also limited to single user by embedded params
        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }

        parent::__construct();
    }
}
