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

    public static $statusstrings = array(
        DP_APPROVAL_UNAPPROVED => 'Pending approval',
        DP_APPROVAL_APPROVED => 'Approved',
        DP_APPROVAL_DECLINED => 'Declined'
    );

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
                'Plan name',
                'dp.name',
                array(
                    'defaultheading' => 'Plan',
                    'joins' => 'dp'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'planlink',
                'Plan name (linked to plan page)',
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
                'Plan start date',
                'dp.startdate',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'enddate',
                'Plan end date',
                'dp.enddate',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'status',
                'Plan status',
                'dp.status',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'plan_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'template',
                'name',
                'Plan template name',
                'template.shortname',
                array(
                    'defaultheading' => 'Plan template',
                    'joins' => 'template'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'startdate',
                'Plan template start date',
                'template.startdate',
                array(
                    'joins'=>'template',
                    'displayfunc'=>'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'enddate',
                'Plan template end date',
                'template.enddate',
                array(
                    'joins'=>'template',
                    'displayfunc'=>'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'fullname',
                'Competency name',
                'competency.fullname',
                array(
                    'defaultheading' => 'Competency name',
                    'joins' => 'competency'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'duedate',
                'Competency due date',
                'base.duedate',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'priority',
                'Competency priority',
                'priority.name',
                array(
                    'joins' => 'priority'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'status',
                'Competency status',
                'base.approved',
                array(
                    'displayfunc' => 'plan_competency_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'competency',
                'proficiency',
                'Competency proficiency',
                'scale_value.name',
                array(
                    'joins' => 'scale_value'
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
                'Competency name',
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'competency',
                'priority',
                'Competency priority',
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'competency',
                'duedate',
                'Competency due date',
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'plan',
                'name',
                'Plan name',
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

    /**
     * Column displayfunc to convert the plan competency status to a human-readable
     * string
     *
     * @param int $status
     * @return string
     */
    public function rb_display_plan_competency_status($status){

        if ( array_key_exists( $status, self::$statusstrings )){
            return self::$statusstrings[$status];
        } else {
            return '';
        }
    }

    /**
     * Generate the plan title with a link to the plan
     * @global object $CFG
     * @param string $planname
     * @param object $row
     * @return string
     */
    public function rb_display_planlink($planname, $row){
        global $CFG;

        return "<a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$row->plan_id}\">$planname</a>";
    }

    /**
     * Display the plan's status (for use as a column displayfunc)
     *
     * @global object $CFG
     * @param int $status
     * @param object $row
     * @return string
     */
    public function rb_display_plan_status($status, $row){
        global $CFG;
        require_once($CFG->dirroot.'/local/plan/lib.php');

        switch ($status){
            case DP_PLAN_STATUS_UNAPPROVED:
                return 'Unapproved';
                break;
            case DP_PLAN_STATUS_DECLINED:
                return 'Declined';
                break;
            case DP_PLAN_STATUS_APPROVED:
                return 'Approved';
                break;
            case DP_PLAN_STATUS_COMPLETE:
                return 'Complete';
                break;
        }
    }

}

?>