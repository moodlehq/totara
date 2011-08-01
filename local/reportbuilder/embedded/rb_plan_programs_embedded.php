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

require_once($CFG->dirroot . '/local/program/lib.php');

class rb_plan_programs_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {

        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $rolstatus = array_key_exists('rolstatus', $data) ? $data['rolstatus'] : null;

        $this->url = '/local/plan/record/programs.php';
        $this->source = 'dp_program';
        $this->shortname = 'plan_programs';
        $this->fullname = get_string('recordoflearningprograms', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'program',
                'value' => 'proglinkicon',
                'heading' => 'Program Name',
            ),
            array(
                'type' => 'program',
                'value' => 'mandatory',
                'heading' => 'Mandatory',
            ),
            array(
                'type' => 'program',
                'value' => 'timedue',
                'heading' => 'Due/Status',
            ),
            array(
                'type' => 'program_completion',
                'value' => 'status',
                'heading' => 'Progress',
            ),
        );

        $this->filters = array(
            array(
                'type' => 'program',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 1,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        // don't include the front page (site-level course)
        $this->embeddedparams = array(
            'category' => '!0',
        );

        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }

        if(isset($rolstatus)) {
            $this->embeddedparams['programstatus'] = null;
            switch ($rolstatus) {
                case 'active':
                    $this->embeddedparams['programstatus'] = '!'.STATUS_PROGRAM_COMPLETE;
                break;
                case 'completed':
                    $this->embeddedparams['programstatus'] = STATUS_PROGRAM_COMPLETE;
                break;
            }
            $this->embeddedparams['rolstatus'] = $rolstatus;
        }

        $context = get_context_instance(CONTEXT_SYSTEM);
        if(!has_capability('local/program:viewhiddenprograms', $context)) {
            // don't show hidden programs to none-admins
            $this->embeddedparams['visible'] = 1;
        }

        parent::__construct();
    }
}
