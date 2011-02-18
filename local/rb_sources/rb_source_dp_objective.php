<?php

defined('MOODLE_INTERNAL') || die();

global $CFG;
require_once($CFG->dirroot . '/local/plan/lib.php');

/**
 * A report builder source for DP objectives
 */
class rb_source_dp_objective extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns, $sourcetitle;

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
        $this->sourcetitle = get_string('sourcetitle', 'rb_source_dp_objective');
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
                get_string('planname', 'rb_source_dp_objective'),
                'dp.name',
                array(
                    'defaultheading' => 'Plan',
                    'joins' => 'dp'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'planlink',
                get_string('plannamelink', 'rb_source_dp_objective'),
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
                get_string('planstartdate', 'rb_source_dp_objective'),
                'dp.startdate',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'enddate',
                get_string('planenddate', 'rb_source_dp_objective'),
                'dp.enddate',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'status',
                get_string('planstatus', 'rb_source_dp_objective'),
                'dp.status',
                array(
                    'joins' => 'dp',
                    'displayfunc' => 'plan_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'template',
                'name',
                get_string('templatename', 'rb_source_dp_objective'),
                'template.fullname',
                array(
                    'defaultheading' => 'Plan template',
                    'joins' => 'template'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'startdate',
                get_string('templatestartdate', 'rb_source_dp_objective'),
                'template.startdate',
                array(
                    'joins'=>'template',
                    'displayfunc'=>'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'enddate',
                get_string('templateenddate', 'rb_source_dp_objective'),
                'template.enddate',
                array(
                    'joins'=>'template',
                    'displayfunc'=>'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'fullname',
                get_string('fullname', 'rb_source_dp_objective'),
                'base.fullname'
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'fullnamelink',
                get_string('fullnamelink', 'rb_source_dp_objective'),
                'base.fullname',
                array(
                    'defaultheading' => get_string('fullname', 'rb_source_dp_objective'),
                    'displayfunc' => 'objectivelink',
                    'extrafields' => array(
                        'objective_id' => 'base.id',
                        'plan_id' => 'dp.id',
                    ),
                    'joins' => 'dp',
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'shortname',
                get_string('shortname', 'rb_source_dp_objective'),
                'base.shortname'
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'description',
                get_string('description', 'rb_source_dp_objective'),
                'base.description'
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'duedate',
                get_string('objduedate', 'rb_source_dp_objective'),
                'base.duedate',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'priority',
                get_string('objpriority', 'rb_source_dp_objective'),
                'priority.name',
                array(
                    'joins' => 'priority'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'status',
                get_string('objstatus', 'rb_source_dp_objective'),
                'base.approved',
                array(
                    'displayfunc' => 'plan_item_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'proficiency',
                get_string('objproficiency', 'rb_source_dp_objective'),
                'objective_scale_value.name',
                array(
                    'joins' => 'objective_scale_value'
                )
        );

        $columnoptions[] = new rb_column_option(
                'objective',
                'proficiencyandapproval',
                get_string('objproficiencyandapproval', 'rb_source_dp_objective'),
                'objective_scale_value.name',
                array(
                    'joins' => 'objective_scale_value',
                    'displayfunc' => 'proficiency_and_approval',
                    'defaultheading' => get_string('objproficiency', 'rb_source_dp_objective'),
                    'extrafields' => array('approved' => 'base.approved')
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
                get_string('objfullname', 'rb_source_dp_objective'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'shortname',
                get_string('objshortname', 'rb_source_dp_objective'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'description',
                get_string('objdescription', 'rb_source_dp_objective'),
                'textarea'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'priority',
                get_string('objpriority', 'rb_source_dp_objective'),
                'text'
        );

        $filteroptions[] = new rb_filter_option(
                'objective',
                'duedate',
                get_string('objduedate', 'rb_source_dp_objective'),
                'date'
        );

        $filteroptions[] = new rb_filter_option(
                'plan',
                'name',
                get_string('planname', 'rb_source_dp_objective'),
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
