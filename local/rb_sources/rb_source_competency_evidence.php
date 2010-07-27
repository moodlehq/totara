<?php

class rb_source_competency_evidence extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;

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
            'competency' => "LEFT JOIN {$CFG->prefix}comp competency
                ON base.competencyid = competency.id",
            'scale_values' => "LEFT JOIN {$CFG->prefix}comp_scale_values
                scale_values ON scale_values.id = base.proficiency",
            'user' => "LEFT JOIN {$CFG->prefix}user u ON base.userid = u.id",
            'position_assignment' => "LEFT JOIN {$CFG->prefix}pos_assignment pa
                ON base.userid = pa.userid",
            'organisation' => "LEFT JOIN {$CFG->prefix}org organisation
                ON organisation.id = pa.organisationid",
            'position' => "LEFT JOIN {$CFG->prefix}pos position
                ON position.id = pa.positionid",
            'completion_organisation' => "LEFT JOIN
                {$CFG->prefix}org completion_organisation
                ON base.organisationid = completion_organisation.id",
            'completion_position' => "LEFT JOIN {$CFG->prefix}pos
                completion_position ON base.positionid =
                completion_position.id",
            'assessor' => "LEFT JOIN {$CFG->prefix}user assessor
                ON assessor.id = base.assessorid",
        );

        // only include these joins if the manager role is defined
        if($managerroleid = get_field('role','id','shortname','manager')) {
            $joinlist['manager_role_assignment'] =
                "LEFT JOIN {$CFG->prefix}role_assignments mra
                    ON ( pa.reportstoid = mra.id
                    AND mra.roleid = $managerroleid)";
            $joinlist['manager'] =
                "LEFT JOIN {$CFG->prefix}user manager ON manager.id =
                mra.userid";
        }

        // add joins for user custom fields
        $this->add_user_custom_fields_to_joinlist($joinlist);

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            new rb_column_option(
                'competency_evidence',  // type
                'proficiency',          // value
                'Proficiency',          // name
                'scale_values.name',    // field
                array('joins' => 'scale_values') // options
            ),
            new rb_column_option(
                'competency_evidence',
                'proficiencyid',
                'Proficiency ID',
                'base.proficiency'
            ),
            new rb_column_option(
                'competency_evidence',
                'completeddate',
                'Completion Date',
                'base.timemodified',
                array('displayfunc' => 'nice_date')
            ),
            new rb_column_option(
                'competency_evidence',
                'organisationid',
                'Completion Organisation ID',
                'base.organisationid'
            ),
            new rb_column_option(
                'competency_evidence',
                'organisation',
                'Completion Organisation Name',
                'completion_organisation.fullname',
                array('joins' => 'completion_organisation')
            ),
            new rb_column_option(
                'competency_evidence',
                'positionid',
                'Completion Position ID',
                'base.positionid'
            ),
            new rb_column_option(
                'competency_evidence',
                'position',
                'Completion Position Name',
                'completion_position.fullname',
                array('joins' => 'completion_position')
            ),
            new rb_column_option(
                'competency_evidence',
                'assessor',
                'Assessor Name',
                sql_fullname("assessor.firstname","assessor.lastname"),
                array('joins' => 'assessor')
            ),
            new rb_column_option(
                'competency_evidence',
                'assessorname',
                'Assessor Organisation',
                'base.assessorname'
            ),
            new rb_column_option(
                'competency',
                'fullname',
                'Competency Name',
                'competency.fullname',
                array('joins' => 'competency')
            ),
            new rb_column_option(
                'competency',
                'shortname',
                'Competency Shortname',
                'competency.shortname',
                array('joins' => 'competency')
            ),
            new rb_column_option(
                'competency',
                'idnumber',
                'Competency ID Number',
                'competency.idnumber',
                array('joins' => 'competency')
            ),
            new rb_column_option(
                'competency',
                'competencylink',
                'Competency Name (linked to competency page)',
                'competency.fullname',
                array(
                    'joins' => 'competency',
                    'displayfunc' => 'link_competency',
                    'defaultheading' => 'Competency Name',
                    'extrafields' => array('competency_id' => 'competency.id'),
                )
            ),
            new rb_column_option(
                'competency',
                'id',
                'Competency ID',
                'competency.id',
                array('joins' => 'competency')
            ),
        );

        // add all user profile fields to columns
        // requires 'user' and 'user_profile' in join list
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_user_custom_fields_to_columns($columnoptions);

        // add position and organisation columns
        $this->add_position_info_to_columns($columnoptions);

        return $columnoptions;
    }

    function define_filteroptions() {
        $filteroptions = array(
            new rb_filter_option(
                'competency_evidence',  // type
                'completeddate',        // value
                'Completed Date',       // label
                'date',                 // filtertype
                array()                 // options
            ),
            new rb_filter_option(
                'competency_evidence',
                'proficiencyid',
                'Proficiency',
                'select',
                array(
                    'selectfunc' => 'proficiency_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'competency_evidence',
                'organisationid',
                'Office when completed',
                'select',
                array(
                    'selectfunc' => 'organisations_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'competency_evidence',
                'positionid',
                'Position when completed',
                'select',
                array(
                    'selectfunc' => 'positions_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'competency_evidence',
                'assessor',
                'Assessor Name',
                'text'
            ),
            new rb_filter_option(
                'competency_evidence',
                'assessorname',
                'Assessor Organisation',
                'text'
            ),
            new rb_filter_option(
                'competency',
                'fullname',
                'Competency Name',
                'text'
            ),
            new rb_filter_option(
                'competency',
                'shortname',
                'Competency Short Name',
                'text'
            ),
            new rb_filter_option(
                'competency',
                'idnumber',
                'Competency ID Number',
                'text'
            ),

        );

        // add all user profile field to filters
        $this->add_user_fields_to_filters($filteroptions);
        $this->add_user_custom_fields_to_filters($filteroptions);

        // add user position filters
        $this->add_position_fields_to_filters($filteroptions);

        return $filteroptions;
    }

    function define_contentoptions() {
        $contentoptions = array(
            new rb_content_option(
                'current_org',                      // class name
                "The user's current organisation",  // title
                'base.userid',                      // field
                null                                // joins
            ),
            new rb_content_option(
                'current_pos',                      // class name
                "The user's current position",      // title
                'base.userid',                      // field
                null                                // joins
            ),
            new rb_content_option(
                'completed_org',
                "The organisation when completed",
                'base.organisationid'
            ),
            new rb_content_option(
                'user',
                'The user',
                'base.userid'
            ),
            new rb_content_option(
                'date',
                "The completion date",
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
                'competency.id',
                'competency'
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
                'value' => 'organisationid',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'organisationid',
                'advanced' => 1,
            ),
            array(
                'type' => 'user',
                'value' => 'positionid',
                'advanced' => 1,
            ),
            array(
                'type' => 'competency_evidence',
                'value' => 'positionid',
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
                'Options',      // heading
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

