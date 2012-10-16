<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage reportbuilder
 */

class rb_findcourses_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $filters, $columns;
    public $contentmode, $contentsettings, $embeddedparams;
    public $hidden, $accessmode, $accesssettings, $shortname;
    public $defaultsortcolumn, $defaultsortorder;

    public function __construct($data) {
        $this->url = '/course/find.php';
        $this->source = 'courses';
        $this->defaultsortcolumn = 'course_courselinkicon';
        $this->shortname = 'findcourses';
        $this->fullname = get_string('findcourses', 'totara_core');
        $this->columns = array(
            array(
                'type' => 'course',
                'value' => 'courselinkicon',
                'heading' => get_string('coursename', 'totara_reportbuilder'),
            ),
            array(
                'type' => 'course_category',
                'value' => 'namelink',
                'heading' => get_string('category', 'totara_reportbuilder'),
            ),
            array(
                'type' => 'course',
                'value' => 'startdate',
                'heading' => get_string('report:startdate', 'totara_reportbuilder'),
            ),
            array(
                'type' => 'course',
                'value' => 'mods',
                'heading' => get_string('content', 'totara_reportbuilder'),
            ),
        );

        // no filters
        $this->filters = array(
            array(
                'type' => 'course',
                'value' => 'name_and_summary',
                'advanced' => 0,
            ),
            array(
                'type' => 'course',
                'value' => 'mods',
                'advanced' => 0,
            ),
            array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 1,
            ),
            array(
                'type' => 'course',
                'value' => 'startdate',
                'advanced' => 1,
            ),
        );

        // no restrictions
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        // don't include the front page (site-level course)
        $this->embeddedparams = array(
            'category' => '!0',
        );

        $context = context_system::instance();
        if (!is_siteadmin()) {
            // don't show hidden courses to non-admins
            $this->embeddedparams['visible'] = 1;
        }

        parent::__construct();
    }
}
