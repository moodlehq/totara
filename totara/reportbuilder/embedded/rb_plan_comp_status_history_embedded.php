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
 * @author Nathan Lewis <nathan.lewis@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

class rb_plan_comp_status_history_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $columns, $filters;
    public $contentmode, $embeddedparams;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $rolstatus = array_key_exists('rolstatus', $data) ? $data['rolstatus'] : null;
        $compid = array_key_exists('competencyid', $data) ? $data['competencyid'] : null;

        $this->url = '/totara/hierarchy/prefix/competency/statushistoryreport.php';
        $this->source = 'comp_status_history';
        $this->shortname = 'plan_comp_status_history';
        $this->fullname = get_string('sourcetitle', 'rb_source_comp_status_history');

        $this->columns = $this->define_columns();
        $this->filters = $this->define_filters();

        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if (isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        if (isset($rolstatus)) {
            $this->embeddedparams['rolstatus'] = $rolstatus;
        }
        if (isset($compid)) {
            $this->embeddedparams['competencyid'] = $compid;
        }

        parent::__construct();
    }

    protected function define_columns() {
        $columns = array(
            array(
                'type' => 'user',
                'value' => 'namelink',
                'heading' => get_string('embeddedusernameheading', 'rb_source_comp_status_history')
            ),
            array(
                'type' => 'competency',
                'value' => 'fullname',
                'heading' => get_string('embeddedcompnameheading', 'rb_source_comp_status_history')
            ),
            array(
                'type' => 'history',
                'value' => 'scalevalue',
                'heading' => get_string('embeddedscalevalueheading', 'rb_source_comp_status_history')
            ),
            array(
                'type' => 'history',
                'value' => 'timemodified',
                'heading' => get_string('embeddedtimemodifiedheading', 'rb_source_comp_status_history')
            ),
            array(
                'type' => 'history',
                'value' => 'usermodifiednamelink',
                'heading' => get_string('embeddedusermodifiedheading', 'rb_source_comp_status_history')
            )
        );

        return $columns;
    }

    protected function define_filters() {
        $filters = array(
            array(
                'type' => 'history',
                'value' => 'timemodified',
                'advanced' => 0
            )
        );

        return $filters;
    }

}
