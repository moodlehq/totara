<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
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

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/totara/certification/lib.php');

/**
 * A report builder source for Certifications
 */
class rb_source_dp_certification_history extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    /**
     * Constructor
     */
    public function __construct() {
        global $DB;
        $activeunique = $DB->sql_concat("'active'", 'id');
        $historyunique = $DB->sql_concat("'history'", 'id');
        $sql = '(SELECT ' . $activeunique . ' AS id,
                1 AS active,
                id AS completionid,
                certifid,
                userid,
                timecompleted,
                timeexpires
                FROM {certif_completion}
                UNION
                SELECT ' . $historyunique . ' AS id,
                0 AS active,
                id AS completionid,
                certifid,
                userid,
                timecompleted,
                timeexpires
                FROM {certif_completion_history})';
        $this->base = $sql;
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = array();
        $this->requiredcolumns = array();
        $this->sourcetitle = get_string('sourcetitle', 'rb_source_dp_certification_history');
        parent::__construct();
    }


    //
    //
    // Methods for defining contents of source
    //
    //

    /**
     * Creates the array of rb_join objects required for this->joinlist
     *
     * @global object $CFG
     * @return array
     */
    protected function define_joinlist() {
        global $CFG;

        $joinlist = array();

        // to get access to position type constants
        require_once($CFG->dirroot . '/totara/reportbuilder/classes/rb_join.php');

        $joinlist[] = new rb_join(
                'prog',
                'LEFT',
                '{prog}',
                'prog.certifid = base.certifid',
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
        );

        $this->add_user_table_to_joinlist($joinlist, 'base', 'userid');
        $this->add_course_category_table_to_joinlist($joinlist, 'prog', 'category');

        return $joinlist;
    }


    /**
     * Creates the array of rb_column_option objects required for
     * $this->columnoptions
     *
     * @return array
     */
    protected function define_columnoptions() {
        $columnoptions = array();

        $columnoptions[] = new rb_column_option(
                'prog',
                'fullname',
                get_string('certificationname', 'totara_program'),
                'prog.fullname',
                array(
                    'joins' => 'prog',
                )
        );

        $columnoptions[] = new rb_column_option(
                'prog',
                'fullnamelink',
                get_string('certificationname', 'totara_program'),
                "prog.fullname",
                array(
                    'joins' => 'prog',
                    'defaultheading' => get_string('certificationname', 'totara_program'),
                    'displayfunc' => 'link_program_icon',
                    'extrafields' => array(
                        'programid' => 'prog.id',
                        'program_icon' => "prog.icon",
                        'userid' => 'base.userid',
                    ),
                )
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'active',
                get_string('current', 'rb_source_dp_certification_history'),
                'base.active',
                array(
                    'displayfunc' => 'yes_or_no',
                )
        );

        $columnoptions[] = new rb_column_option(
                'prog',
                'shortname',
                get_string('programshortname', 'totara_program'),
                'prog.shortname',
                array(
                    'joins' => 'prog',
                )
        );

        $columnoptions[] = new rb_column_option(
                'prog',
                'idnumber',
                get_string('programidnumber', 'totara_program'),
                'prog.idnumber',
                array(
                    'joins' => 'prog',
                )
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'certifid',
                get_string('certificationid', 'rb_source_dp_certification'),
                'base.certifid'
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'timecompleted',
                get_string('timecompleted', 'rb_source_dp_certification'),
                'base.timecompleted',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'timeexpires',
                get_string('timeexpires', 'rb_source_dp_certification'),
                'base.timeexpires',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        // include some standard columns
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_course_category_fields_to_columns($columnoptions, 'course_category', 'prog');

        return $columnoptions;
    }


    /**
     * Creates the array of rb_filter_option objects required for $this->filteroptions
     * @return array
     */
    protected function define_filteroptions() {
        $filteroptions = array();

        $filteroptions[] = new rb_filter_option(
                'prog',
                'fullname',
                get_string('certificationname', 'totara_program'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'base',
                'active',
                get_string('current', 'rb_source_dp_certification_history'),
                'select',
                array(
                    'selectfunc' => 'yesno_list',
                    'attributes' => rb_filter_option::select_width_limiter(),
                )
        );

        $filteroptions[] = new rb_filter_option(
                'prog',
                'shortname',
                get_string('programshortname', 'totara_program'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'prog',
                'idnumber',
                get_string('programidnumber', 'totara_program'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'base',
                'certifid',
                get_string('certificationid', 'rb_source_dp_certification'),
                'int'
        );

        $filteroptions[] = new rb_filter_option(
                'base',
                'timecompleted',
                get_string('timecompleted', 'rb_source_dp_certification'),
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'base',
                'timeexpires',
                get_string('timeexpires', 'rb_source_dp_certification'),
                'date'
        );

        $this->add_course_category_fields_to_filters($filteroptions);

        return $filteroptions;
    }


    /**
     * Creates the array of rb_content_option object required for $this->contentoptions
     * @return array
     */
    protected function define_contentoptions() {
        $contentoptions = array();

        // Include the rb_user_content content options for this report
        $contentoptions[] = new rb_content_option('user', get_string('users'), 'base.userid', 'base');
        return $contentoptions;
    }


    protected function define_paramoptions() {
        global $CFG;

        $paramoptions = array();
        require_once($CFG->dirroot.'/totara/plan/lib.php');

        $paramoptions[] = new rb_param_option(
                'userid',
                'base.userid'
        );
        $paramoptions[] = new rb_param_option(
                'certifid',
                'base.certifid'
        );
        $paramoptions[] = new rb_param_option(
                'active',
                'base.active'
        );
        $paramoptions[] = new rb_param_option(
                'visible',
                'prog.visible',
                'prog'
        );
        $paramoptions[] = new rb_param_option(
                'category',
                'prog.category',
                'prog'
        );
        return $paramoptions;
    }


    protected function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'prog',
                'value' => 'fullnamelink',
            ),
            array(
                'type' => 'course_category',
                'value' => 'namelink',
            ),
        );
        return $defaultcolumns;
    }


    protected function define_defaultfilters() {
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


    function rb_display_link_program_icon($certificationname, $row) {
        $program = new program($row->programid);
        return $program->display_link_program_icon($certificationname, $row->programid, $row->program_icon, $row->userid);
    }
}
