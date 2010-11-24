<?php
global $CFG;
require_once($CFG->dirroot . '/local/plan/lib.php');

/**
 * A report builder source for DP courses
 */
class rb_source_dp_course extends rb_base_source {

    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $requiredcolumns;

    /**
     * Constructor
     * @global object $CFG
     */
    public function __construct() {
        global $CFG;
        $this->base = $CFG->prefix . 'course_completions';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = array();
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
                'course',
                'LEFT',
                $CFG->prefix . 'course',
                'base.course = course.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $joinlist[] = new rb_join(
                'dp_course',
                'LEFT',
                $CFG->prefix . 'dp_plan_course_assign',
                'base.course = dp_course.courseid',
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array()
        );

        $joinlist[] = new rb_join(
                'dp_plan',
                'LEFT',
                $CFG->prefix . 'dp_plan',
                'dp_plan.id = dp_course.planid',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('dp_course')
        );

        $joinlist[] = new rb_join(
                'dp_template',
                'LEFT',
                $CFG->prefix . 'dp_template',
                'dp_plan.templateid = dp_template.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('dp_plan')
        );

        $joinlist[] = new rb_join(
                'priority',
                'LEFT',
                $CFG->prefix . 'dp_priority_scale_value',
                'dp_course.priority = priority.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array()
        );

        $this->add_user_table_to_joinlist($joinlist, 'base','userid');

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
                'dp_plan.name',
                array(
                    'defaultheading' => 'Plan',
                    'joins' => 'dp_plan'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'startdate',
                'Plan start date',
                'dp_plan.startdate',
                array(
                    'joins' => 'dp_plan',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'enddate',
                'Plan end date',
                'dp_plan.enddate',
                array(
                    'joins' => 'dp_plan',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'status',
                'Plan status',
                'dp_plan.status',
                array(
                    'joins' => 'dp_plan',
                    'displayfunc' => 'plan_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'template',
                'name',
                'Plan template name',
                'dp_template.shortname',
                array(
                    'defaultheading' => 'Plan template',
                    'joins' => 'dp_template'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'startdate',
                'Plan template start date',
                'dp_template.startdate',
                array(
                    'joins'=>'dp_template',
                    'displayfunc'=>'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'enddate',
                'Plan template end date',
                'dp_template.enddate',
                array(
                    'joins'=>'dp_template',
                    'displayfunc'=>'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'course',
                'shortname',
                'Course title',
                'course.shortname',
                array('joins'=>'course')
        );

        $columnoptions[] = new rb_column_option(
                'course',
                'duedate',
                'Course due date',
                'dp_course.duedate',
                array(
                    'joins' => 'dp_course',
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'course',
                'id',
                'Course id',
                'base.course',
                array()
        );

        $columnoptions[] = new rb_column_option(
                'course',
                'idforicon',
                'Course icon',
                'course.id',
                array('joins'=>'course', 'displayfunc'=>'course_icon')
        );

        $columnoptions[] = new rb_column_option(
                'course',
                'icon',
                'Course icon (raw)',
                'course.icon',
                array('joins'=>'course')
        );


        $columnoptions[] = new rb_column_option(
                'course',
                'priority',
                'Priority',
                'priority.name',
                array(
                    'joins' => 'priority'
                )
        );

        $columnoptions[] = new rb_column_option(
                'completion',
                'timestarted',
                'Completion start date',
                'base.timestarted',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'completion',
                'timecompleted',
                'Completion date',
                'base.timecompleted',
                array(
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'completion',
                'status',
                'Completion status',
                'base.timecompleted',
                array(
                    'displayfunc' => 'completion_status'
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
        return $filteroptions;

        $filteroptions[] = new rb_filter_option(
                'user',
                'id',
                'User ID',
                'number',
                array(
                    'defaultadvanced'=>true
                )
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
        $contentoptions[] = new rb_content_option('user', 'Users', 'base.userid', 'base');
        return $contentoptions;
    }

    /**
     * Display a string representing the completion status (for use as a
     * column displayfunc)
     *
     * @param int $timecompleted
     * @param object $row
     * @return string
     */
    public function rb_display_completion_status($timecompleted, $row){

        if ( empty($timecompleted) ){
            return "In progress";
        } else {
            return "Completed " . $this->rb_display_nice_date($timecompleted, $row);
        }
    }

    /**
     * Display the course icon (for use a a column displayfunc)
     *
     * @global object $CFG
     * @param int $courseid
     * @param object $row
     * @return string
     */
    public function rb_display_course_icon($courseid, $row){
        global $CFG;
        $course = new stdClass();
        $course->id = $courseid;
        if ( isset($row->course_shortname) ){
            $course->shortname = $row->course_shortname;
        }
        if ( isset($row->course_icon) ){
            $course->icon = $row->course_icon;
        }
        require_once($CFG->dirroot.'/local/lib.php');
        return local_course_icon_tag($course);
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