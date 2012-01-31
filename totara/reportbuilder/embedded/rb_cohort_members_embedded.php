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
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage reportbuilder
 */

class rb_cohort_members_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;

    public function __construct($data) {
    $cohortid = array_key_exists('cohortid', $data) ? $data['cohortid'] : null;
        $this->url = '/cohort/members.php';
        $this->source = 'cohort';
        $this->shortname = 'cohort_members';
        $this->fullname = get_string('cohortmembers', 'local_cohort');
        $this->columns = array(
            array(
                'type' => 'user',
                'value' => 'fullname',
                'heading' => get_string('name')
            ),
        array(
                'type' => 'user',
                'value' => 'position',
                'heading' => get_string('position','local_cohort')
            ),
        array(
                'type' => 'user',
                'value' => 'organisation',
                'heading' => get_string('organisation','local_cohort')
            ),
        );

        // no filters
        $this->filters = array(
        array(
                'type' => 'user',
                'value' => 'fullname',
                'advanced' => 0,
            ),
    );

    // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

    if ($cohortid != null) {
        // only show members of this cohort
        $this->embeddedparams['cohortid'] = $cohortid;
    }

        parent::__construct();
    }
}
