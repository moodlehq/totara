<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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

class rb_plan_evidence_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;
    public $defaultsortcolumn, $defaultsortorder;

    public function __construct($data) {
        global $CFG;

        $userid = array_key_exists('userid', $data) ? $data['userid'] : null;
        $rolstatus = array_key_exists('rolstatus', $data) ? $data['rolstatus'] : null;

        $this->url = '/totara/plan/record/evidence/index.php';
        $this->source = 'dp_evidence';
        $this->defaultsortcolumn = 'evidence_namelink';
        $this->shortname = 'plan_evidence';
        $this->fullname = get_string('recordoflearningevidence', 'totara_plan');
        $this->columns = array();

        $this->columns[] = array(
            'type' => 'evidence',
            'value' => 'namelink',
            'heading' => get_string('objname', 'rb_source_dp_evidence'),
        );
        $this->columns[] = array(
            'type' => 'evidence',
            'value' => 'evidencetypeid',
            'heading' => get_string('evidencetype', 'rb_source_dp_evidence'),
        );
        $this->columns[] = array(
            'type' => 'evidence',
            'value' => 'institution',
            'heading' => get_string('institution', 'rb_source_dp_evidence'),
        );
        $this->columns[] = array(
            'type' => 'evidence',
            'value' => 'datecompleted',
            'heading' => get_string('datecompleted', 'rb_source_dp_evidence'),
        );
        $this->columns[] = array(
            'type' => 'evidence',
            'value' => 'evidenceinuse',
            'heading' => get_string('evidenceinuse', 'rb_source_dp_evidence'),
        );

        $this->columns[] = array(
            'type' => 'evidence',
            'value' => 'actionlinks',
            'heading' => get_string('actionlinks', 'rb_source_dp_evidence'),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        $this->embeddedparams = array();
        if(isset($userid)) {
            $this->embeddedparams['userid'] = $userid;
        }
        if (isset($rolstatus)) {
            $this->embeddedparams['rolstatus'] = $rolstatus;
        }

        parent::__construct();
    }
}
