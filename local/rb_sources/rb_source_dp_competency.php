<?php
global $CFG;
require_once($CFG->dirroot . '/local/plan/lib.php');

/**
 * A report builder source for DP competencies
 */
class rb_source_dp_competency extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;


    /**
     * Constructor
     * @global object $CFG
     */
    public function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'dp_plan_competency_assign';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = array();
        $this->defaultfilters = array();
        $this->requiredcolumns = array();
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
    private function define_joinlist() {
        $joinlist = array();
        global $CFG;

        // to get access to position type constants
        require_once($CFG->dirroot . '/local/reportbuilder/classes/rb_join.php');

        $joinlist[] = new rb_join(
                'dp',
                'LEFT',
                $CFG->prefix . 'dp_plan',
                'base.planid = dp.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $joinlist[] = new rb_join(
                'template',
                'LEFT',
                $CFG->prefix . 'dp_template',
                'dp.templateid = template.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('dp')
        );

        $joinlist[] = new rb_join(
                'competency',
                'LEFT',
                $CFG->prefix . 'comp',
                'base.competencyid = competency.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $joinlist[] = new rb_join(
                'priority',
                'LEFT',
                $CFG->prefix . 'dp_priority_scale_value',
                'base.priority = priority.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $joinlist[] = new rb_join(
                'scale_value',
                'LEFT',
                $CFG->prefix . 'comp_scale_values',
                'base.scalevalueid = scale_value.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $joinlist[] = new rb_join(
                'linkedcourses',
                'LEFT',
                '(SELECT itemid1 ' . sql_as() . ' compassignid,
                    count(id) ' . sql_as() . " count
                    FROM {$CFG->prefix}dp_plan_component_relation
                    WHERE component1='competency' AND component2='course'
                    GROUP BY itemid1)",
                'base.id = linkedcourses.compassignid',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $joinlist[] = new rb_join(
                'comp_evidence',
                'LEFT',
                $CFG->prefix . 'comp_evidence',
                '(base.competencyid = comp_evidence.competencyid
                  AND comp_evidence.userid = dp.userid)',
                  REPORT_BUILDER_RELATION_ONE_TO_ONE,
                  array('dp')
        );

        $joinlist[] = new rb_join(
                'evidence_scale_value',
                'LEFT',
                $CFG->prefix . 'comp_scale_values',
                'comp_evidence.proficiency = evidence_scale_value.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('comp_evidence')
        );

        $this->add_user_table_to_joinlist($joinlist, 'dp','userid');

        return $joinlist;
    }

    /**
     * Creates the array of rb_column_option objects required for
     * $this->columnoptions
     *
     * @return array
     */
    private function define_columnoptions() {
        $columnoptions = array();

        $columnoptions[] = new rb_column_option(
                'plan',
                'name',
                get_string('planname', 'rb_source_dp_competency'),
                'dp.name',
                array(
                    'defaultheading' => 'Plan',
                    'joins' => 'dp'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'planlink',
                get_string('plannamelinked', 'rb_source_dp_competency'),
                'dp.name',
                array(
                    'defaultheading' => 'Plan',
                    'joins' => 'dp',
                    'displayfunc' => 'planlink',
                    'extrafields' => array( 'plan_id'=>'dp.id' )
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'startdate',
                get_string('planstartdate', 'rb_source_dp_competency'),
                'dp.startdate',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'enddate',
                get_string('planenddate', 'rb_source_dp_competency'),
                'dp.enddate',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'status',
                get_string('planstatus', 'rb_source_dp_competency'),
                'dp.status',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'plan_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'template',
                'name',
                get_string('templatename', 'rb_source_dp_competency'),
                'template.shortname',
                array(
                    'defaultheading' => 'Plan template',
                    'joins' => 'template'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'startdate',
                get_string('templatestartdate', 'rb_source_dp_competency'),
                'template.startdate',
                array(
                    'joins'=>'template',
                    'displayfunc'=>'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'enddate',
                get_string('templateenddate', 'rb_source_dp_competency'),
                'template.enddate',
                array(
                    'joins'=>'template',
                    'displayfunc'=>'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'fullname',
                get_string('competencyname', 'rb_source_dp_competency'),
                'competency.fullname',
                array(
                    'defaultheading' => get_string('competencyname', 'rb_source_dp_competency'),
                    'joins' => 'competency'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'duedate',
                get_string('competencyduedate', 'rb_source_dp_competency'),
                'base.duedate',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'priority',
                get_string('competencypriority', 'rb_source_dp_competency'),
                'priority.name',
                array(
                    'joins' => 'priority'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'status',
                get_string('competencystatus', 'rb_source_dp_competency'),
                'base.approved',
                array(
                    'displayfunc' => 'plan_item_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'proficiency',
                get_string('competencyproficiency', 'rb_source_dp_competency'),
                // source of proficiency depends on plan status
                // take 'live' value for active plans and static
                // stored value for completed plans
                'CASE WHEN dp.status = ' . DP_PLAN_STATUS_COMPLETE . '
                THEN
                    scale_value.name
                ELSE
                    evidence_scale_value.name
                END',
                array(
                    'joins' => array('dp', 'scale_value', 'evidence_scale_value')
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'proficiencyandapproval',
                get_string('competencyproficiencyandapproval', 'rb_source_dp_competency'),
                // source of proficiency depends on plan status
                // take 'live' value for active plans and static
                // stored value for completed plans
                'CASE WHEN dp.status = ' . DP_PLAN_STATUS_COMPLETE . '
                THEN
                    scale_value.name
                ELSE
                    evidence_scale_value.name
                END',
                array(
                    'joins' => array('dp', 'scale_value', 'evidence_scale_value'),
                    'displayfunc' => 'proficiency_and_approval',
                    'defaultheading' => get_string('competencyproficiency', 'rb_source_dp_competency'),
                    'extrafields' => array('approved' => 'base.approved')
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'linkedcourses',
                get_string('courses', 'rb_source_dp_competency'),
                'linkedcourses.count',
                array(
                    'joins' => 'linkedcourses'
                )
        );

        $this->add_user_fields_to_columns($columnoptions);

        return $columnoptions;
    }

    /**
     * Creates the array of rb_filter_option objects required for $this->filteroptions
     * @return array
     */
    private function define_filteroptions() {
        $filteroptions = array();

        $filteroptions[] = new rb_filter_option(
                'competency',
                'fullname',
                get_string('competencyname', 'rb_source_dp_competency'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'competency',
                'priority',
                get_string('competencypriority', 'rb_source_dp_competency'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'competency',
                'duedate',
                get_string('competencyduedate', 'rb_source_dp_competency'),
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'plan',
                'name',
                get_string('planname', 'rb_source_dp_competency'),
                'text'
        );
        return $filteroptions;
    }

    /**
     * Creates the array of rb_content_option object required for $this->contentoptions
     * @return array
     */
    private function define_contentoptions() {
        $contentoptions = array();

        // Include the rb_user_content content options for this report
        $contentoptions[] = new rb_content_option('user', 'Users', 'dp.userid', 'dp');
        return $contentoptions;
    }

    private function define_paramoptions() {
        global $CFG;
        require_once($CFG->dirroot.'/local/plan/lib.php');
        $paramoptions = array();

        $paramoptions[] = new rb_param_option(
                'userid',
                'dp.userid',
                'dp'
        );
        $paramoptions[] = new rb_param_option(
                'planstatus',
                '(case '.
                    'when dp.status='. DP_PLAN_STATUS_COMPLETE . ' then \'completed\' '.
                    'when dp.status in ('. DP_PLAN_STATUS_APPROVED .','. DP_PLAN_STATUS_UNAPPROVED.') then \'active\' '.
                    'else \'disapproved\' '.
                'end)',
                'dp',
                'string'
        );
        return $paramoptions;
    }

    function rb_display_proficiency_and_approval($status, $row) {
        global $CFG;
        // needed for approval constants
        require_once($CFG->dirroot . '/local/plan/lib.php');

        $approved = isset($row->approved) ? $row->approved : null;

        $content = $status;

        // highlight if the item has not yet been approved
        if($approved == DP_APPROVAL_UNAPPROVED ||
            $approved == DP_APPROVAL_REQUESTED) {
            $content .= '<br />' . $this->rb_display_plan_item_status($approved);
        }
        return $content;
    }
}

?>
