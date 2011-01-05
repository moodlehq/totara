<?php
global $CFG;
require_once($CFG->dirroot . '/local/plan/lib.php');

/**
 * A report builder source for DP objectives
 */
class rb_source_dp_objective extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;

    /**
     * Constructor
     * @global object $CFG
     */
    public function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'dp_plan_objective';
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
                'priority',
                'LEFT',
                $CFG->prefix . 'dp_priority_scale_value',
                'base.priority = priority.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $joinlist[] = new rb_join(
                'objective_scale_value',
                'LEFT',
                $CFG->prefix . 'dp_objective_scale_value',
                'base.scalevalueid = objective_scale_value.id',
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
                'template.fullname',
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
                'objective',
                'fullname',
                'Fullname',
                'base.fullname'
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'fullnamelink',
                'Fullname (linked to detail page)',
                'base.fullname',
                array(
                    'defaultheading' => 'Fullname',
                    'displayfunc' => 'objectivelink',
                    'extrafields' => array(
                        'objective_id' => 'base.id',
                        'plan_id' => 'dp.id',
                    ),
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'shortname',
                'Shortname',
                'base.shortname'
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'description',
                'Description',
                'base.description'
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'duedate',
                'Objective due date',
                'base.duedate',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'priority',
                'Objective priority',
                'priority.name',
                array(
                    'joins' => 'priority'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'status',
                'Objective status',
                'base.approved',
                array(
                    'displayfunc' => 'plan_item_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'proficiency',
                'Objective proficiency',
                'objective_scale_value.name',
                array(
                    'joins' => 'objective_scale_value'
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
                'objective',
                'fullname',
                'Objective fullname',
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'shortname',
                'Objective shortname',
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'description',
                'Objective description',
                'textarea'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'priority',
                'Objective priority',
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'duedate',
                'Objective due date',
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
     * Generate the objective name with a link to the objective details page
     * @global object $CFG
     * @param string $objective Objective name
     * @param object $row Object containing other fields
     * @return string
     */
    public function rb_display_objectivelink($objective, $row){
        global $CFG;

        return "<a href=\"{$CFG->wwwroot}/local/plan/components/objective/view.php?id={$row->plan_id}&amp;itemid={$row->objective_id}\">$objective</a>";
    }

}

?>
