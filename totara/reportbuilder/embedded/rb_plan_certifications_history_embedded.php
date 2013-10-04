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

class rb_plan_certifications_history_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;
    public $defaultsortcolumn, $defaultsortorder;

    public function __construct($data) {
        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $certifid = array_key_exists('certifid', $data) ? $data['certifid'] : null;

        $url = new moodle_url('/totara/plan/record/certifications.php', array('history' => true));

        $this->url = $url->out_as_local_url();
        $this->source = 'dp_certification_history'; // Source report not database table
        $this->defaultsortcolumn = 'timecompleted';
        $this->shortname = 'plan_certifications_history';
        $this->fullname = get_string('recordoflearningcertificationshistory', 'totara_plan');
        $this->columns = array(
            array(
                'type' => 'prog',
                'value' => 'fullnamelink',
                'heading' => get_string('certificationname', 'totara_program'),
            ),
            array(
                'type' => 'base',
                'value' => 'active',
                'heading' => get_string('current', 'rb_source_dp_certification_history'),
            ),
            array(
                'type' => 'base',
                'value' => 'timecompleted',
                'heading' => get_string('timecompleted', 'rb_source_dp_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'timeexpires',
                'heading' => get_string('timeexpires', 'rb_source_dp_certification'),
            ),
        );

        $this->filters = array(
            array(
                'type' => 'prog',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'base',
                'value' => 'active',
                'advanced' => 0,
            ),
            array(
                'type' => 'base',
                'value' => 'timecompleted',
                'advanced' => 1,
            ),
            array(
                'type' => 'base',
                'value' => 'timeexpires',
                'advanced' => 1,
            ),
            array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 1,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if (isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        $context = context_system::instance();
        if (!has_capability('totara/certification:viewhiddencertifications', $context)) {
            // don't show hidden programs to non-admins
            $this->embeddedparams['visible'] = 1;
        }
        // don't include the front page (site-level course)
        $this->embeddedparams['category'] ='!0';
        if (isset($certifid)) {
            $this->embeddedparams['certifid'] = $certifid;
        }
        parent::__construct();
    }
}
