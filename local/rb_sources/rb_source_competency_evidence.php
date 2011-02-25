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
 * @package totara
 * @subpackage reportbuilder 
 */

defined('MOODLE_INTERNAL') || die();

class rb_source_competency_evidence extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

    function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'comp_evidence';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        $this->sourcetitle = get_string('sourcetitle', 'rb_source_competency_evidence');
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    function define_joinlist() {
        global $CFG;

        $joinlist = array(
            new rb_join(
                'competency',
                'LEFT',
                $CFG->prefix . 'comp',
                'competency.id = base.competencyid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'scale_values',
                'LEFT',
                $CFG->prefix . 'comp_scale_values',
                'scale_values.id = base.proficiency',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'assessor',
                'LEFT',
                $CFG->prefix . 'user',
                'assessor.id = base.assessorid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'completion_organisation',
                'LEFT',
                $CFG->prefix . 'org',
                'completion_organisation.id = base.organisationid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'completion_position',
                'LEFT',
                $CFG->prefix . 'pos',
                'completion_position.id = base.positionid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
        );

        // include some standard joins
        $this->add_user_table_to_joinlist($joinlist, 'base', 'userid');
        $this->add_user_custom_fields_to_joinlist($joinlist, 'base', 'userid');
        $this->add_position_tables_to_joinlist($joinlist, 'base', 'userid');
        // requires the position_assignment join
        $this->add_manager_tables_to_joinlist($joinlist,
            'position_assignment', 'reportstoid');

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            new rb_column_option(
                'competency_evidence',  // type
                'proficiency',          // value
                get_string('proficiency', 'rb_source_competency_evidence'), // name
                'scale_values.name',    // field
                array('joins' => 'scale_values') // options
            ),
            new rb_column_option(
                'competency_evidence',
                'proficiencyid',
                get_string('proficiencyid', 'rb_source_competency_evidence'),
                'base.proficiency'
            ),
            new rb_column_option(
                'competency_evidence',
                'completeddate',
                get_string('completiondate', 'rb_source_competency_evidence'),
                'base.timemodified',
                array('displayfunc' => 'nice_date')
            ),
            new rb_column_option(
                'competency_evidence',
                'organisationid',
                get_string('completionorgid', 'rb_source_competency_evidence'),
                'base.organisationid'
            ),
            new rb_column_option(
                'competency_evidence',
                'organisationpath',
                get_string('completionorgpath', 'rb_source_competency_evidence'),
                'completion_organisation.path',
                array('joins' => 'completion_organisation')
            ),
            new rb_column_option(
                'competency_evidence',
                'organisation',
                get_string('completionorgname', 'rb_source_competency_evidence'),
                'completion_organisation.fullname',
                array('joins' => 'completion_organisation')
            ),
            new rb_column_option(
                'competency_evidence',
                'positionid',
                get_string('completionposid', 'rb_source_competency_evidence'),
                'base.positionid'
            ),
            new rb_column_option(
                'competency_evidence',
                'positionpath',
                get_string('completionpospath', 'rb_source_competency_evidence'),
                'completion_position.path',
                array('joins' => 'completion_position')
            ),
            new rb_column_option(
                'competency_evidence',
                'position',
                get_string('completionposname', 'rb_source_competency_evidence'),
                'completion_position.fullname',
                array('joins' => 'completion_position')
            ),
            new rb_column_option(
                'competency_evidence',
                'assessor',
                get_string('assessorname', 'rb_source_competency_evidence'),
                sql_fullname("assessor.firstname","assessor.lastname"),
                array('joins' => 'assessor')
            ),
            new rb_column_option(
                'competency_evidence',
                'assessorname',
                get_string('assessororg', 'rb_source_competency_evidence'),
                'base.assessorname'
            ),
            new rb_column_option(
                'competency',
                'fullname',
                get_string('competencyname', 'rb_source_competency_evidence'),
                'competency.fullname',
                array('joins' => 'competency')
            ),
            new rb_column_option(
                'competency',
                'shortname',
                get_string('competencyshortname', 'rb_source_competency_evidence'),
                'competency.shortname',
                array('joins' => 'competency')
            ),
            new rb_column_option(
                'competency',
                'idnumber',
                get_string('competencyid', 'rb_source_competency_evidence'),
                'competency.idnumber',
                array('joins' => 'competency')
            ),
            new rb_column_option(
                'competency',
                'competencylink',
                get_string('competencylinkname', 'rb_source_competency_evidence'),
                'competency.fullname',
                array(
                    'joins' => 'competency',
                    'displayfunc' => 'link_competency',
                    'defaultheading' => get_string('competencyname', 'rb_source_competency_evidence'),
                    'extrafields' => array('competency_id' => 'competency.id'),
                )
            ),
            new rb_column_option(
                'competency',
                'id',
                get_string('competencyid', 'rb_source_competency_evidence'),
                'base.competencyid'
            ),
            new rb_column_option(
                'competency',
                'path',
                get_string('competencypath', 'rb_source_competency_evidence'),
                'competency.path',
                array('joins' => 'competency')
            ),
        );

        // include some standard columns
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_user_custom_fields_to_columns($columnoptions);
        $this->add_position_fields_to_columns($columnoptions);
        $this->add_manager_fields_to_columns($columnoptions);

        return $columnoptions;
    }

    function define_filteroptions() {
        $filteroptions = array(
            new rb_filter_option(
                'competency_evidence',  // type
                'completeddate',        // value
                get_string('completeddate', 'rb_source_competency_evidence'),       // label
                'date',                 // filtertype
                array()                 // options
            ),
            new rb_filter_option(
                'competency_evidence',
                'proficiencyid',
                get_string('proficiency', 'rb_source_competency_evidence'),
                'select',
                array(
                    'selectfunc' => 'proficiency_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'competency_evidence',
                'organisationid',
                get_string('officewhencompletedbasic', 'rb_source_competency_evidence'),
                'select',
                array(
                    'selectfunc' => 'organisations_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'competency_evidence',
                'organisationpath',
                get_string('organisationwhencompleted', 'rb_source_competency_evidence'),
                'org'
            ),
            new rb_filter_option(
                'competency_evidence',
                'positionid',
                get_string('positionwhencompletedbasic', 'rb_source_competency_evidence'),
                'select',
                array(
                    'selectfunc' => 'positions_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'competency_evidence',
                'positionpath',
                get_string('positionwhencompleted', 'rb_source_competency_evidence'),
                'pos'
            ),
            new rb_filter_option(
                'competency_evidence',
                'assessor',
                get_string('assessorname', 'rb_source_competency_evidence'),
                'text'
            ),
            new rb_filter_option(
                'competency_evidence',
                'assessorname',
                get_string('assessororg', 'rb_source_competency_evidence'),
                'text'
            ),
            new rb_filter_option(
                'competency',
                'path',
                get_string('competency', 'rb_source_competency_evidence'),
                'comp'
            ),
            new rb_filter_option(
                'competency',
                'fullname',
                get_string('competencyname', 'rb_source_competency_evidence'),
                'text'
            ),
            new rb_filter_option(
                'competency',
                'shortname',
                get_string('competencyshortname', 'rb_source_competency_evidence'),
                'text'
            ),
            new rb_filter_option(
                'competency',
                'idnumber',
                get_string('competencyid', 'rb_source_competency_evidence'),
                'text'
            ),

        );
        // include some standard filters
        $this->add_user_fields_to_filters($filteroptions);
        $this->add_user_custom_fields_to_filters($filteroptions);
        $this->add_position_fields_to_filters($filteroptions);
        $this->add_manager_fields_to_filters($filteroptions);

        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array(
            new rb_content_option(
                'current_org',                      // class name
                get_string('currentorg', 'rb_source_competency_evidence'),  // title
                'base.userid',                      // field
                null                                // joins
            ),
            new rb_content_option(
                'current_pos',                      // class name
                get_string('currentpos', 'rb_source_competency_evidence'),      // title
                'base.userid',                      // field
                null                                // joins
            ),
            new rb_content_option(
                'completed_org',
                get_string('completedorg', 'rb_source_competency_evidence'),
                'base.organisationid'
            ),
            new rb_content_option(
                'user',
                get_string('user', 'rb_source_competency_evidence'),
                'base.userid'
            ),
            new rb_content_option(
                'date',
                get_string('completiondate', 'rb_source_competency_evidence'),
                'base.timemodified'
            ),
        );
        return $contentoptions;
    }

    function define_paramoptions() {
        $paramoptions = array(
            new rb_param_option(
                'userid',       // parameter name
                'base.userid',  // field
                null            // joins
            ),
            new rb_param_option(
                'compid',
                'base.competencyid'
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'user',
                'value' => 'namelink'
            ),
            array(
                'type' => 'competency',
                'value' => 'competencylink',
            ),
            array(
                'type' => 'user',
                'value' => 'organisation',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'organisation',
            ),
            array(
                'type' => 'user',
                'value' => 'position',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'position',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'proficiency',
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'completeddate',
            ),
        );
        return $defaultcolumns;
    }

    function define_defaultfilters() {
        $defaultfilters = array(
            array(
                'type' => 'user',
                'value' => 'fullname',
                'advanced' => 0,
            ),
            array(
                'type' => 'user',
                'value' => 'organisationpath',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'organisationpath',
                'advanced' => 1,
            ),
            array(
                'type' => 'user',
                'value' => 'positionpath',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'positionpath',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency',
                'value' => 'fullname',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'completeddate',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'proficiencyid',
                'advanced' => 1,
            ),
        );
        return $defaultfilters;
    }

    function define_requiredcolumns() {
        $requiredcolumns = array(
            new rb_column(
                'admin',        // type
                'options',      // value
                get_string('options', 'rb_source_competency_evidence'),      // heading
                'base.id',      // field
                array(          // options
                    'displayfunc' => 'ce_admin_options',
                    'required' => true,
                    'capability' => 'moodle/local:updatecompetency',
                    'noexport' => true
                )
            ),
        );
        return $requiredcolumns;
    }

    //
    //
    // Source specific column display methods
    //
    //

    // link competency to competency view page
    // requires the competency_id extra field
    // in column definition
    function rb_display_link_competency($comp, $row) {
        global $CFG;
        $compid = $row->competency_id;
        return "<a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$compid}\">{$comp}</a>";
    }

    // display icons to edit and delete competency evidence
    function rb_display_ce_admin_options($itemid, $row) {
        global $CFG;
        $editstr = trim(get_string('edit'));
        $deletestr = trim(get_string('delete'));
        $editlink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/edit.php?id='.$itemid.'&amp;s='.sesskey().
            '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$editstr.
            '"><img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$editstr.'" /></a>';
        $deletelink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/delete.php?id='.$itemid.'&amp;s='.sesskey().
            '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$deletestr.
            '"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$deletestr.'" /></a>';
        return '<div align="center">' . $editlink .' '.$deletelink . '</div>';
    }

    //
    //
    // Source specific filter display methods
    //
    //

    function rb_filter_proficiency_list() {

        $proficiencies = array();
        // use all possible scale values
        if($scale_values = get_records('comp_scale_values', '', '', 'scaleid, sortorder')) {
            foreach($scale_values as $scale_value) {
                $id = $scale_value->id;
                $name = $scale_value->name;
                $proficiencies[$id] = $name;
            }
        }

        return $proficiencies;
    }

} // end of rb_source_competency_evidence class

