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

class rb_goal_details_embedded extends rb_base_embedded {

    public $url, $source, $fullname, $columns, $filters;
    public $contentmode, $embeddedparams;

    public function __construct() {
        $this->url = '/totara/hierarchy/prefix/goal/detailsreport.php';
        $this->source = 'goal_details';
        $this->shortname = 'goal_details';
        $this->fullname = get_string('sourcetitle', 'rb_source_goal_details');

        $this->columns = $this->define_columns();
        $this->filters = $this->define_filters();

        // TODO What does this do?
        $this->contentmode = REPORT_BUILDER_CONTENT_MODE_NONE;

        parent::__construct();
    }

    protected function define_columns() {
        $columns = array(
            array(
                'type' => 'user',
                'value' => 'namelink',
                'heading' => get_string('embeddedusernameheading', 'rb_source_goal_details')
            ),
            array(
                'type' => 'user',
                'value' => 'position',
                'heading' => get_string('embeddedpositionheading', 'rb_source_goal_details')
            ),
            array(
                'type' => 'user',
                'value' => 'organisation',
                'heading' => get_string('embeddedorganisationheading', 'rb_source_goal_details')
            ),
            array(
                'type' => 'user',
                'value' => 'managername',
                'heading' => get_string('embeddedmanagerheading', 'rb_source_goal_details')
            ),
            array(
                'type' => 'goal',
                'value' => 'name',
                'heading' => get_string('embeddedgoalnameheading', 'rb_source_goal_details')
            ),
            array(
                'type' => 'goal',
                'value' => 'userstatus',
                'heading' => get_string('embeddedscalevalueheading', 'rb_source_goal_details')
            )
        );

        return $columns;
    }

    protected function define_filters() {
        $filters = array(
            array(
                'type' => 'user',
                'value' => 'fullname',
                'advanced' => 0
            ),
            array(
                'type' => 'goal',
                'value' => 'goalid',
                'advanced' => 0
            ),
            array(
                'type' => 'goal',
                'value' => 'scalevalueid',
                'advanced' => 0
            ),
            array(
                'type' => 'user',
                'value' => 'managername',
                'advanced' => 0
            )
        );

        return $filters;
    }

}
