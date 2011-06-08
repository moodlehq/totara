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
    public $defaultsortcolumn, $defaultsortorder;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $rolstatus = array_key_exists('rolstatus', $data) ? $data['rolstatus'] : null;

        $this->url = '/local/plan/record/competencies.php';
        $this->source = 'dp_competency';
        $this->defaultsortcolumn = 'competency_fullname';
        $this->shortname = 'plan_competencies';
        $this->fullname = get_string('recordoflearningcompetencies', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'plan',
                'value' => 'planlink',
                'heading' => get_string('plan', 'local_plan'),
            ),
            array(
                'type' => 'plan',
                'value' => 'status',
                'heading' => get_string('planstatus', 'local_plan'),
            ),
            array(
                'type' => 'competency',
                'value' => 'fullname',
                'heading' => get_string('competency', 'competency'),
            ),
            array(
                'type' => 'competency',
                'value' => 'priority',
                'heading' => get_string('priority', 'rb_source_dp_competency'),
            ),
            array(
                'type' => 'competency',
                'value' => 'duedate',
                'heading' => get_string('duedate', 'rb_source_dp_competency'),
            ),
            array(
                'type' => 'competency',
                'value' => 'proficiencyandapproval',
                'heading' => get_string('status', 'rb_source_dp_competency'),
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
        if(isset($rolstatus)) {
            $this->embeddedparams['rolstatus'] = $rolstatus;
        }

        parent::__construct();
    }
}
