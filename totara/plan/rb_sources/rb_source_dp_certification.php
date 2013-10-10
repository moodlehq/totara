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
require_once($CFG->dirroot . '/totara/program/lib.php');

/**
 * A report builder source for Certifications
 */
class rb_source_dp_certification extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    /**
     * Constructor
     */
    public function __construct() {
        $this->base = '{prog}';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = array();
        $this->requiredcolumns = array();
        $this->sourcetitle = get_string('sourcetitle', 'rb_source_dp_certification');
        $this->sourcewhere = '(base.certifid > 0)';
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
        global $CFG, $DB;

        $joinlist = array();

        // to get access to position type constants
        require_once($CFG->dirroot . '/totara/reportbuilder/classes/rb_join.php');

        $joinlist[] = new rb_join(
                'certif',
                'INNER',
                '{certif}',
                'certif.id = base.certifid',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('base')
        );

        $joinlist[] = new rb_join(
                'certif_completion',
                'INNER',
                '{certif_completion}',
                '(certif_completion.certifid = base.certifid
                        AND certif_completion.userid = prog_completion.userid)',
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base', 'prog_completion')
        );

        $joinlist[] = new rb_join(
                'certif_completion_history',
                'LEFT',
                '(SELECT ' . $DB->sql_concat('userid', 'certifid') . ' AS uniqueid,
                    userid,
                    certifid,
                    COUNT(id) AS historycount
                    FROM {certif_completion_history}
                    GROUP BY userid, certifid)',
                '(certif_completion_history.certifid = base.certifid
                    AND certif_completion_history.userid = certif_completion.userid)',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('base', 'certif_completion')
        );

        $joinlist[] =  new rb_join(
                'prog_completion', // table alias
                'INNER', // type of join
                '{prog_completion}',
                'base.id = prog_completion.programid AND prog_completion.coursesetid = 0', // zero = the program
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
        );

        $this->add_course_category_table_to_joinlist($joinlist, 'base', 'category');
        $this->add_cohort_program_tables_to_joinlist($joinlist, 'base', 'id');
//         $this->add_user_table_to_joinlist($joinlist, 'certif_completion', 'userid');

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
                'base',
                'fullname',
                get_string('certificationname', 'totara_program'),
                'base.fullname',
                array(
                    'joins' => 'base',
                )
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'fullnamelink',
                get_string('certificationname', 'totara_program'),
                "base.fullname",
                array(
                    'joins' => array('base', 'certif_completion'),
                    'defaultheading' => get_string('certificationname', 'totara_program'),
                    'displayfunc' => 'link_program_icon',
                    'extrafields' => array(
                        'programid' => 'base.id',
                        'program_icon' => "base.icon",
                        'userid' => 'certif_completion.userid'
                    ),
                )
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'shortname',
                get_string('programshortname', 'totara_program'),
                'base.shortname',
                array(
                    'joins' => 'base',
                )
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'idnumber',
                get_string('programidnumber', 'totara_program'),
                'base.idnumber',
                array(
                    'joins' => 'base',
                )
        );

        $columnoptions[] = new rb_column_option(
                'base',
                'certifid',
                get_string('certificationid', 'rb_source_dp_certification'),
                'base.certifid',
                array(
                    'joins' => 'base',
                )
        );

        $columnoptions[] = new rb_column_option(
                'prog_completion',
                'timedue',
                get_string('certificationduedate', 'totara_program'),
                'prog_completion.timedue',
                array(
                    'joins' => array('prog_completion', 'certif_completion'),
                    'displayfunc' => 'timedue_date',
                    'extrafields' => array(
                        'completionstatus' => 'prog_completion.status',
                        'programid' => 'base.id',
                        'certifpath' => 'certif_completion.certifpath',
                        'timeexpires' => 'certif_completion.timeexpires',
                    )
                )
        );

        $columnoptions[] = new rb_column_option(
                'certif_completion',
                'certifpath',
                get_string('certifpath', 'rb_source_dp_certification'),
                'certif_completion.certifpath',
                array(
                    'joins' => 'certif_completion',
                    'displayfunc' => 'certif_certifpath'
                )
        );

        $columnoptions[] = new rb_column_option(
                'certif_completion',
                'status',
                get_string('status', 'rb_source_dp_certification'),
                'certif_completion.status',
                array(
                    'joins' => 'certif_completion',
                    'displayfunc' => 'certif_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'certif_completion',
                'renewalstatus',
                get_string('renewalstatus', 'rb_source_dp_certification'),
                'certif_completion.renewalstatus',
                array(
                    'joins' => 'certif_completion',
                    'displayfunc' => 'certif_renewalstatus'
                )
        );

        $columnoptions[] = new rb_column_option(
                'certif_completion',
                'timewindowopens',
                get_string('timewindowopens', 'rb_source_dp_certification'),
                'certif_completion.timewindowopens',
                array(
                    'joins' => 'certif_completion',
                    'displayfunc' => 'timewindowopens',
                    'extrafields' => array(
                        'status' => 'certif_completion.status'
                    )
                )
        );

        $columnoptions[] = new rb_column_option(
                'certif_completion',
                'timeexpires',
                get_string('timeexpires', 'rb_source_dp_certification'),
                'certif_completion.timeexpires',
                array(
                    'joins' => 'certif_completion',
                    'displayfunc' => 'timeexpires',
                    'extrafields' => array(
                        'status' => 'certif_completion.status'
                    )
                )
        );

        $columnoptions[] = new rb_column_option(
                'prog_completion',
                'timecompleted',
                get_string('timecompleted', 'rb_source_dp_certification'),
                'prog_completion.timecompleted',
                array(
                    'joins' => 'prog_completion',
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'certif_completion_history',
                'historylink',
                get_string('historylink', 'rb_source_dp_certification'),
                'certif_completion_history.historycount',
                array(
                    'joins' => 'certif_completion_history',
                    'defaultheading' => get_string('historylink', 'rb_source_dp_certification'),
                    'displayfunc' => 'historylink',
                    'extrafields' => array(
                        'certifid' => 'certif_completion.certifid',
                        'userid' => 'certif_completion.userid',
                    ),
                )
        );

        $columnoptions[] = new rb_column_option(
                'certif_completion_history',
                'historycount',
                get_string('historycount', 'rb_source_dp_certification'),
                'certif_completion_history.historycount',
                array(
                    'joins' => 'certif_completion_history',
                )
        );
        $columnoptions[] = new rb_column_option(
            'certif_completion',
            'progress',
            get_string('progress', 'rb_source_dp_course'),
            "certif_completion.status",
            array(
                'joins' => array('certif_completion'),
                'displayfunc' => 'progress',
                'defaultheading' => get_string('progress', 'rb_source_dp_course'),
                'extrafields' => array(
                    'programid' => "base.id",
                    'userid' => "certif_completion.userid"
                )
            )
        );

        // include some standard columns
//         $this->add_user_fields_to_columns($columnoptions);
        $this->add_course_category_fields_to_columns($columnoptions, 'course_category', 'base');

        return $columnoptions;
    }


    /**
     * Creates the array of rb_filter_option objects required for $this->filteroptions
     * @return array
     */
    protected function define_filteroptions() {
        $filteroptions = array();

        $filteroptions[] = new rb_filter_option(
                'base',
                'fullname',
                get_string('certificationname', 'totara_program'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'base',
                'shortname',
                get_string('programshortname', 'totara_program'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'base',
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
                'prog_completion',
                'timedue',
                get_string('certificationduedate', 'totara_program'),
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'certif_completion',
                'certifpath',
                get_string('certifpath', 'rb_source_dp_certification'),
                'select',
                array(
                    'selectfunc' => 'certifpath',
                    'attributes' => rb_filter_option::select_width_limiter(),
                )
        );

        $filteroptions[] = new rb_filter_option(
                'certif_completion',
                'status',
                get_string('status', 'rb_source_dp_certification'),
                'select',
                array(
                    'selectfunc' => 'status',
                    'attributes' => rb_filter_option::select_width_limiter(),
                )
        );

        $filteroptions[] = new rb_filter_option(
                'certif_completion',
                'renewalstatus',
                get_string('renewalstatus', 'rb_source_dp_certification'),
                'select',
                array(
                    'selectfunc' => 'renewalstatus',
                    'attributes' => rb_filter_option::select_width_limiter(),
                )
        );

        $filteroptions[] = new rb_filter_option(
                'certif_completion',
                'timewindowopens',
                get_string('timewindowopens', 'rb_source_dp_certification'),
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'certif_completion',
                'timeexpires',
                get_string('timeexpires', 'rb_source_dp_certification'),
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'prog_completion',
                'timecompleted',
                get_string('timecompleted', 'rb_source_dp_certification'),
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'certif_completion_history',
                'historycount',
                get_string('historycount', 'rb_source_dp_certification'),
                'number'
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

        return $contentoptions;
    }


    protected function define_paramoptions() {
        global $CFG;

        $paramoptions = array();
        require_once($CFG->dirroot.'/totara/plan/lib.php');

        $paramoptions[] = new rb_param_option(
                'userid',
                'certif_completion.userid',
                'certif_completion',
                'int'
        );
        // OR status = ' . CERTIFSTATUS_EXPIRED . '
        $paramoptions[] = new rb_param_option(
                'rolstatus',
                '(CASE WHEN certif_completion.status = ' . CERTIFSTATUS_COMPLETED . ' THEN \'completed\' ELSE \'active\' END)',
                'certif_completion',
                'string'
        );
        $paramoptions[] = new rb_param_option(
                'category',
                'base.category',
                'base'
        );
        return $paramoptions;
    }


    protected function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'base',
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
                'type' => 'base',
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


    function rb_display_timedue_date($time, $row) {
        if ($row->certifpath == CERTIFPATH_CERT) {
            $program = new program($row->programid);
            return $program->display_timedue_date($row->completionstatus, $time, 'strfdateshortmonth');
        } else {
            return userdate($row->timeexpires, get_string('strfdateshortmonth', 'langconfig'));
        }
    }


    function rb_display_timewindowopens($time, $row) {
        global $OUTPUT;
        $out = '';

        if (!empty($time)) {
            $out = userdate($time, get_string('strfdateshortmonth', 'langconfig'));

            $days = '';
            if ($row->status != CERTIFSTATUS_EXPIRED) {
                $days_remaining = floor(($time - time()) / 86400);
                if ($days_remaining == 1) {
                    $days = get_string('onedayremaining', 'totara_program');
                } else if ($days_remaining < 10 && $days_remaining > 0) {
                    $days = get_string('daysremaining', 'totara_program', $days_remaining);
                } else if ($time < time()) {
                    $days = get_string('overdue', 'totara_plan');
                }
                if ($days != '') {
                    $out .= html_writer::empty_tag('br') . $OUTPUT->error_text($days);
                }
            }
        }
        return $out;
    }


    function rb_display_timeexpires($time, $row) {
        global $OUTPUT;

        $out = '';

        if (!empty($time)) {
            $out = userdate($time, get_string('strfdateshortmonth', 'langconfig'));

            $days = '';
            if ($row->status != CERTIFSTATUS_EXPIRED) {
                $days_remaining = floor(($time - time()) / 86400);
                if ($days_remaining == 1) {
                    $days = get_string('onedayremaining', 'totara_program');
                } else if ($days_remaining < 10 && $days_remaining > 0) {
                    $days = get_string('daysremaining', 'totara_program', $days_remaining);
                } else if ($time < time()) {
                    $days = get_string('overdue', 'totara_plan');
                }
                if ($days != '') {
                    $out .= html_writer::empty_tag('br') . $OUTPUT->error_text($days);
                }
            } else if ($row->status != CERTIFSTATUS_EXPIRED) {
                $out .= html_writer::empty_tag('br') . $OUTPUT->error_text(get_string('expired'));
            }
        }
        return $out;
    }


    public function rb_display_historylink($name, $row) {
        global $OUTPUT;
        return $OUTPUT->action_link(new moodle_url('/totara/plan/record/certifications.php',
                array('certifid' => $row->certifid, 'userid' => $row->userid, 'history' => 1)), $name);
    }


    function rb_display_certif_certifpath($certifpath, $row) {
        global $CERTIFPATH;
        if ($certifpath && isset($CERTIFPATH[$certifpath])) {
            return get_string($CERTIFPATH[$certifpath], 'totara_certification');
        }
    }


    function rb_display_certif_status($status, $row) {
        global $CERTIFSTATUS;
        if ($status && isset($CERTIFSTATUS[$status])) {
            return get_string($CERTIFSTATUS[$status], 'totara_certification');
        }
    }

    function rb_display_certif_renewalstatus($renewalstatus, $row) {
        global $CERTIFRENEWALSTATUS;
        if ($renewalstatus && isset($CERTIFRENEWALSTATUS[$renewalstatus])) {
            return get_string($CERTIFRENEWALSTATUS[$renewalstatus], 'totara_certification');
        } else {
            return get_string($CERTIFRENEWALSTATUS[CERTIFRENEWALSTATUS_NOTDUE], 'totara_certification');
        }
    }

    function rb_display_progress($status, $row) {
        $program = new program($row->programid);
        return $program->display_progress($row->userid);
    }


    function rb_filter_certifpath() {
        global $CERTIFPATH;

        $out = array();
        foreach ($CERTIFPATH as $code => $cpstring) {
            $out[$code] = get_string($cpstring, 'totara_certification');
        }
        return $out;
    }


    function rb_filter_status() {
        global $CERTIFSTATUS;

        $out = array();
        foreach ($CERTIFSTATUS as $code => $statusstring) {
            $out[$code] = get_string($statusstring, 'totara_certification');
        }
        return $out;
    }


    function rb_filter_renewalstatus() {
        global $CERTIFRENEWALSTATUS;

        $out = array();
        foreach ($CERTIFRENEWALSTATUS as $code => $statusstring) {
            $out[$code] = get_string($statusstring, 'totara_certification');
        }
        return $out;
    }
}
