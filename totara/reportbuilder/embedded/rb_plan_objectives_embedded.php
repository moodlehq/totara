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

class rb_plan_objectives_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;
    public $defaultsortcolumn, $defaultsortorder;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $rolstatus = array_key_exists('rolstatus', $data) ? $data['rolstatus'] : null;

        $this->url = '/local/plan/record/objectives.php';
        $this->source = 'dp_objective';
        $this->defaultsortcolumn = 'objective_fullnamelink';
        $this->shortname = 'plan_objectives';
        $this->fullname = get_string('recordoflearningobjectives', 'local_plan');
        $this->columns = array(
            array(
                'type' => 'plan',
                'value' => 'planlink',
                'heading' => get_string('plan', 'rb_source_dp_objective'),
            ),
            array(
                'type' => 'plan',
                'value' => 'status',
                'heading' => get_string('planstatus', 'rb_source_dp_objective'),
            ),
            array(
                'type' => 'objective',
                'value' => 'fullnamelink',
                'heading' => get_string('objname', 'rb_source_dp_objective'),
            ),
            array(
                'type' => 'objective',
                'value' => 'description',
                'heading' => get_string('objdescription', 'rb_source_dp_objective'),
            ),
            array(
                'type' => 'objective',
                'value' => 'priority',
                'heading' => get_string('priority', 'rb_source_dp_objective'),
            ),
            array(
                'type' => 'objective',
                'value' => 'duedate',
                'heading' => get_string('duedate', 'rb_source_dp_objective'),
            ),
            array(
                'type' => 'objective',
                'value' => 'proficiencyandapproval',
                'heading' => get_string('status', 'rb_source_dp_objective'),
            ),
        );

        $this->filters = array(
            array(
                'type' => 'objective',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'objective',
                'value' => 'priority',
                'advanced' => 1,
            ),
            array(
                'type' => 'objective',
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
