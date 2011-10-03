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
 * @author Ben Lobo <ben@benlobo.co.uk>
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

require_once($CFG->dirroot . '/local/program/lib.php');

class rb_plan_programs_recurring_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {

        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $programid = array_key_exists('programid', $data) ? $data['programid'] : null;

        $this->url = '/local/plan/record/programs_recurring.php';
        $this->source = 'dp_program_recurring';
        $this->shortname = 'plan_programs_recurring';
        $this->fullname = get_string('recordoflearningprogramsrecurring', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'program_completion_history',
                'value' => 'courselink',
                'heading' => get_string('coursenamelink','local_program'),
            ),
            array(
                'type' => 'program_completion_history',
                'value' => 'status',
                'heading' => get_string('completionstatus','local_program'),
            ),
            array(
                'type' => 'program_completion_history',
                'value' => 'timecompleted',
                'heading' => get_string('completiondate','local_program'),
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }

        if(isset($programid)) {
            $this->embeddedparams['programid'] = $programid;
        }

        $context = get_context_instance(CONTEXT_SYSTEM);
        if(!has_capability('local/program:viewhiddenprograms', $context)) {
            // don't show hidden programs to none-admins
            $this->embeddedparams['visible'] = 1;
        }

        parent::__construct();
    }
}
