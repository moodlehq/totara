<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage reportbuilder
 */

defined('MOODLE_INTERNAL') || die();

class rb_source_program extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'prog';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        $this->sourcetitle = get_string('rolprogramsourcename', 'local_program');
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    function define_joinlist() {
        global $CFG;

        $joinlist = array();

    $this->add_course_category_table_to_joinlist($joinlist, 'base', 'category');

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array();

    $columnoptions[] = new rb_column_option(
            'prog',
            'fullname',
            get_string('programname','local_program'),
            "base.fullname",
            array('joins' => 'base')
        );
    $columnoptions[] = new rb_column_option(
            'prog',
            'shortname',
            get_string('programshortname','local_program'),
            "base.shortname",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'idnumber',
           get_string('programidnumber','local_program'),
            "base.idnumber",
            array('joins' => 'base')
        );
        $columnoptions[] = new rb_column_option(
            'prog',
            'id',
            get_string('programid','local_program'),
            "base.id",
            array('joins' => 'base')
        );
    $columnoptions[] = new rb_column_option(
            'prog',
            'proglinkicon',
            get_string('prognamelinkedicon','local_program'),
            "base.fullname",
            array(
                'joins' => 'base',
                'displayfunc' => 'link_program_icon',
                'defaultheading' => 'Program Name',
                'extrafields' => array(
                    'program_id' => "base.id",
                    'program_icon' => "base.icon"
                )
            )
        );


        // include some standard columns
        $this->add_course_category_fields_to_columns($columnoptions, 'course_category', 'base');

        return $columnoptions;
    }

    function rb_display_link_program_icon($program, $row) {
        global $CFG;
        $programid = $row->program_id;
        $programicon = $row->program_icon;
        return "<a href=\"{$CFG->wwwroot}/local/program/view.php?id={$programid}\"><img class=\"course_icon\" src=\"{$CFG->wwwroot}/local/icon.php?icon=".urlencode($programicon)."&amp;id=$programid&amp;size=small&amp;type=course\" alt=\"$program\" />{$program}</a>";
    }

    function define_filteroptions() {
        $filteroptions = array(
        new rb_filter_option(
        'prog',
        'fullname',
        get_string('programname','local_program'),
        'text'
        )
        );

    $this->add_course_category_fields_to_filters($filteroptions, 'base', 'category');

        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array();
        return $contentoptions;
    }

    function define_paramoptions() {
        $paramoptions = array(
            new rb_param_option(
                'programid',
                'base.id'
            ),
            new rb_param_option(
                'visible',
                'base.visible'
            ),
            new rb_param_option(
                'category',
                'base.category'
            ),
        );
        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'prog',
                'value' => 'proglinkicon',
            ),
        array(
                'type' => 'course_category',
                'value' => 'namelinkicon',
            ),
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
            array(
                'type' => 'prog',
                'value' => 'fullname',
                'advanced' => 0,
            ),
        array(
                'type' => 'course_category',
                'value' => 'id',
                'advanced' => 0,
            ),
        );
        return $defaultfilters;
    }

    function define_requiredcolumns() {
        $requiredcolumns = array();
        return $requiredcolumns;
    }


    //
    //
    // Source specific column display methods
    //
    //


    //
    //
    // Source specific filter display methods
    //
    //



} // end of rb_source_courses class

