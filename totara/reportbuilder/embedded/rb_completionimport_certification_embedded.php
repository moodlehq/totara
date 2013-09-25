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

class rb_completionimport_certification_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;
    public $defaultsortcolumn, $defaultsortorder;

    public function __construct($data) {
        $timecreated = array_key_exists('timecreated', $data) ? $data['timecreated'] : null;
        $importuserid = array_key_exists('importuserid', $data) ? $data['importuserid'] : null;

        $this->url = new moodle_url('/totara/completionimport/viewreport.php',
                array('importname' => 'certification', 'timecreated' => $timecreated, 'importuserid' => $importuserid));
        $this->source = 'completionimport_certification'; // Source report not database table
        $this->defaultsortcolumn = 'id';
        $this->shortname = 'completionimport_certification';
        $this->fullname = get_string('sourcetitle', 'rb_source_completionimport_certification');

        $this->columns = array(
            array(
                'type' => 'base',
                'value' => 'id',
                'heading' => get_string('columnbaseid', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'rownumber',
                'heading' => get_string('columnbaserownumber', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'importerrormsg',
                'heading' => get_string('columnbaseimporterrormsg', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'importevidence',
                'heading' => get_string('columnbaseimportevidence', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'importuser',
                'value' => 'userfullname',
                'heading' => get_string('columnbaseimportuserfullname', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'timecreated',
                'heading' => get_string('columnbasetimecreated', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'username',
                'heading' => get_string('columnbaseusername', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'certificationshortname',
                'heading' => get_string('columnbasecertificationshortname', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'certificationidnumber',
                'heading' => get_string('columnbasecertificationidnumber', 'rb_source_completionimport_certification'),
            ),
            array(
                'type' => 'base',
                'value' => 'completiondate',
                'heading' => get_string('columnbasecompletiondate', 'rb_source_completionimport_certification'),
            ),
        );

        $this->filters = array(
            array(
                'type' => 'base',
                'value' => 'id',
                'advanced' => 1,
            ),
            array(
                'type' => 'base',
                'value' => 'rownumber',
                'advanced' => 0,
            ),
            array(
                'type' => 'base',
                'value' => 'timecreated',
                'advanced' => 0,
            ),
            array(
                'type' => 'importuser',
                'value' => 'userfullname',
                'advanced' => 1,
            ),
            array(
                'type' => 'base',
                'value' => 'username',
                'advanced' => 1,
            ),
            array(
                'type' => 'base',
                'value' => 'certificationshortname',
                'advanced' => 1,
            ),
            array(
                'type' => 'base',
                'value' => 'certificationidnumber',
                'advanced' => 1,
            ),
            array(
                'type' => 'base',
                'value' => 'completiondate',
                'advanced' => 1,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if ($timecreated) {
            $this->embeddedparams['timecreated'] = $timecreated;
        }
        if ($importuserid) {
            $this->embeddedparams['importuserid'] = $importuserid;
        }

        parent::__construct();
    }
}
