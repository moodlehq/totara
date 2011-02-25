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

class rb_plan_competencies_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $planstatus = array_key_exists('planstatus', $data) ? $data['planstatus'] : null;

        $this->url = '/local/plan/record/competencies.php';
        $this->source = 'dp_competency';
        $this->shortname = 'plan_competencies';
        $this->fullname = get_string('recordoflearningcompetencies', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'plan',
                'value' => 'planlink',
                'heading' => 'Plan',
            ),
            array(
                'type' => 'plan',
                'value' => 'status',
                'heading' => 'Plan status'
            ),
            array(
                'type' => 'competency',
                'value' => 'fullname',
                'heading' => 'Competency',
            ),
            array(
                'type' => 'competency',
                'value' => 'priority',
                'heading' => 'Priority',
            ),
            array(
                'type' => 'competency',
                'value' => 'duedate',
                'heading' => 'Due date',
            ),
            array(
                'type' => 'competency',
                'value' => 'proficiencyandapproval',
                'heading' => 'Status'
            ),
        );

        $this->filters = array(
            array(
                'type' => 'competency',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'competency',
                'value' => 'priority',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency',
                'value' => 'duedate',
                'advanced' => 1,
            ),
            array(
                'type' => 'plan',
                'value' => 'name',
                'advanced' => 1,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        if(isset($planstatus)) {
            $this->embeddedparams['planstatus'] = $planstatus;
        }

        parent::__construct();
    }
}
