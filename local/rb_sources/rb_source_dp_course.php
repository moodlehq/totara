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
        $this->base = "( select distinct ".
                sql_concat_join(
                        "','",
                        array(
                            sql_cast2char('ra.userid'),
                            sql_cast2char('cx.instanceid')
                        )
                ) . " as id, ".
                "ra.userid as userid, cx.instanceid as courseid ".
                "from {$CFG->prefix}role_assignments ra ".
                "inner join {$CFG->prefix}context cx ".
                "on ra.contextid = cx.id and cx.contextlevel = " . CONTEXT_COURSE .
                " UNION ".
                "select distinct ".
                sql_concat_join(
                        "','",
                        array(
                            sql_cast2char('p1.userid'),
                            sql_cast2char('pca1.courseid')
                        )
                )." as id, ".
                "p1.userid as userid, pca1.courseid as courseid ".
                "from {$CFG->prefix}dp_plan_course_assign pca1 ".
                "inner join {$CFG->prefix}dp_plan p1 ".
                "on pca1.planid=p1.id )";
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

        /**
         * dp_plan has userid, dp_plan_course_assign has courseid. In order to
         * avoid multiplicity we need to join them together before we join
         * against the rest of the query
         */
        $joinlist[] = new rb_join(
                'dp_course',
                'LEFT',
                "(select
  p.id as planid,
  p.templateid as templateid,
  p.userid as userid,
  p.name as planname,
  p.description as plandescription,
  p.startdate as planstartdate,
  p.enddate as planenddate,
  p.status as planstatus,
  pc.id as id,
  pc.courseid as courseid,
  pc.priority as priority,
  pc.duedate as duedate,
  pc.approved as approved,
  pc.completionstatus as completionstatus,
  pc.grade as grade
from
  {$CFG->prefix}dp_plan p
  inner join {$CFG->prefix}dp_plan_course_assign pc
  on p.id = pc.planid)",
                'dp_course.userid = base.userid and dp_course.courseid = base.courseid',
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                array('base')
        );

        $joinlist[] = new rb_join(
                'dp_template',
                'LEFT',
                $CFG->prefix . 'dp_template',
                'dp_course.templateid = dp_template.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('dp_course','base')
        );

        $joinlist[] = new rb_join(
                'priority',
                'LEFT',
                $CFG->prefix . 'dp_priority_scale_value',
                'dp_course.priority = priority.id',
                REPORT_BUILDER_RELATION_MANY_TO_ONE,
                array('dp_course','base')
        );
        $joinlist[] = new rb_join(
                'course_completion',
                'LEFT',
                $CFG->prefix . 'course_completions',
                '(base.courseid = course_completion.course
                    AND base.userid = course_completion.userid)',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
        );

        $this->add_course_table_to_joinlist($joinlist, 'base', 'courseid');
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

        $this->add_course_fields_to_columns($columnoptions);

        $columnoptions[] = new rb_column_option(
                'plan',
                'name',
                get_string('planname', 'rb_source_dp_course'),
                'dp_course.planname',
                array(
                    'defaultheading' => 'Plan',
                    'joins' => 'dp_course'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'planlink',
                get_string('plannamelink', 'rb_source_dp_course'),
                'dp_course.planname',
                array(
                    'defaultheading' => 'Plan',
                    'joins' => 'dp_course',
                    'displayfunc' => 'planlink',
                    'extrafields' => array( 'plan_id'=>'dp_course.planid' )
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'startdate',
                get_string('planstartdate', 'rb_source_dp_course'),
                'dp_course.planstartdate',
                array(
                    'joins' => 'dp_course',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'enddate',
                get_string('planenddate', 'rb_source_dp_course'),
                'dp_course.planenddate',
                array(
                    'joins' => 'dp_course',
                    'displayfunc' => 'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'plan',
                'status',
                get_string('planstatus', 'rb_source_dp_course'),
                'dp_course.planstatus',
                array(
                    'joins' => 'dp_course',
                    'displayfunc' => 'plan_status'
                )
        );

        $columnoptions[] = new rb_column_option(
                'plan',
                'courseduedate',
                get_string('courseduedate', 'rb_source_dp_course'),
                'dp_course.duedate',
                array(
                    'joins' => 'dp_course',
                    'displayfunc' => 'nice_date'
                )
        );

        $columnoptions[] = new rb_column_option(
                'plan',
                'coursepriority',
                get_string('coursepriority', 'rb_source_dp_course'),
                'priority.name',
                array(
                    'joins' => 'priority'
                )
        );

        $columnoptions[] = new rb_column_option(
                'course',
                'status',
                get_string('coursestatus', 'rb_source_dp_course'),
                'dp_course.approved',
                array(
                    'joins' => 'dp_course',
                    'displayfunc' => 'plan_item_status'
                )
        );

        $this->add_user_fields_to_columns($columnoptions);

        $columnoptions[] = new rb_column_option(
                'template',
                'name',
                get_string('templatename', 'rb_source_dp_course'),
                'dp_template.shortname',
                array(
                    'defaultheading' => 'Plan template',
                    'joins' => 'dp_template'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'startdate',
                get_string('templatestartdate', 'rb_source_dp_course'),
                'dp_template.startdate',
                array(
                    'joins'=>'dp_template',
                    'displayfunc'=>'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'template',
                'enddate',
                get_string('templateenddate', 'rb_source_dp_course'),
                'dp_template.enddate',
                array(
                    'joins'=>'dp_template',
                    'displayfunc'=>'nice_date'
                )
        );
        $columnoptions[] = new rb_column_option(
                'course_completion',
                'status',
                get_string('completionstatus', 'rb_source_dp_course'),
                /*
                 * @todo use something like the following once completion
                 * status is being saved upon plan completion
                 * need to write a display function to manage this
                "CASE WHEN dp_course.planstatus = " . DP_PLAN_STATUS_COMPLETE . "
                THEN
                    dp_course.completionstatus
                ELSE
                    CASE WHEN course_completion.timecompleted IS NOT NULL
                    THEN
                        'Completed'
                    ELSE
                        'Not Completed'
                    END
                END",
                 */
                "CASE WHEN course_completion.timecompleted IS NOT NULL THEN 'Completed' " .
                    "ELSE 'Not Completed' END",
                array(
                    'joins' => 'course_completion',
                    /*
                    'joins' => array('course_completion','dp_course'),
                     */
                    'displayfunc' => 'course_completion_icon',
                    'defaultheading' => get_string('progress', 'rb_source_dp_course'),
                )
            );

        $columnoptions[] = new rb_column_option(
                'course_completion',
                'statusandapproval',
                get_string('completionstatusandapproval', 'rb_source_dp_course'),
                "CASE WHEN course_completion.timecompleted IS NOT NULL THEN 'Completed' " .
                    "ELSE 'Not Completed' END",
                array(
                    'joins' => array('course_completion', 'dp_course'),
                    'displayfunc' => 'course_completion_icon_and_approval',
                    'defaultheading' => get_string('progress', 'rb_source_dp_course'),
                    'extrafields' => array('approved' => 'dp_course.approved')
                )
            );

        return $columnoptions;
    }

    /**
     * Creates the array of rb_filter_option objects required for $this->filteroptions
     * @return array
     */
    private function define_filteroptions() {
        $filteroptions = array();

        $filteroptions[] = new rb_filter_option(
                'user',
                'id',
                get_string('userid', 'rb_source_dp_course'),
                'number',
                array(
                    'defaultadvanced' => true
                )
        );
        $filteroptions[] = new rb_filter_option(
                'course',
                'courselink',
                get_string('coursetitle', 'rb_source_dp_course'),
                'text'
        );
        //TODO select options for the course status filter
        /*$filteroptions[] = new rb_filter_option(
                'course',
                'status',
                get_string('coursestatus', 'rb_source_dp_course'),
                'select',
                array(
                    'selectfunc' => '',
                )
        );*/
        $filteroptions[] = new rb_filter_option(
                'plan',
                'name',
                get_string('planname', 'rb_source_dp_course'),
                'text'
        );
        $filteroptions[] = new rb_filter_option(
                'plan',
                'courseduedate',
                get_string('courseduedate', 'rb_source_dp_course'),
                'date'
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

    private function define_paramoptions() {
        global $CFG;
        require_once($CFG->dirroot.'/local/plan/lib.php');
        $paramoptions = array();

        $paramoptions[] = new rb_param_option(
                'userid',
                'base.userid',
                'base'
        );
        $paramoptions[] = new rb_param_option(
                'planstatus',
                '(case '.
                    'when dp_course.planstatus='. DP_PLAN_STATUS_COMPLETE . ' then \'completed\' '.
                    'when dp_course.planstatus in ('. DP_PLAN_STATUS_APPROVED .','. DP_PLAN_STATUS_UNAPPROVED.') then \'active\' '.
                    'else \'disapproved\' '.
                'end)',
                'dp_course',
                'string'
        );
        return $paramoptions;
    }

    function rb_display_course_type_icon($type) {
        global $CFG;

        switch ($type) {
        case null:
            return null;
            break;
        case 0:
            $image = 'elearning';
            break;
        case 1:
            $image = 'blended';
            break;
        case 2:
            $image = 'facetoface';
            break;
        }
        $alt = get_string($image, 'rb_source_dp_course');
        $icon = "<img title=\"{$alt}\" src=\"{$CFG->wwwroot}/theme/totara/msgicons/{$image}" . '-regular.png' . "\"></img>";

        return $icon;
    }

    function rb_display_course_completion_icon($status) {
        global $CFG;

        switch ($status) {
        case null:
            return null;
            break;
        case 'Not Completed':
            $statusstring = 'inprogress';
            break;
        case 'Completed':
            $statusstring = 'complete';
            break;
        }
        $content = "<span class=\"coursecompletionstatus\">";
        $content .= "<span class=\"completion-$statusstring\" title=\"$status\"></span></span>";

        return $content;
    }

    function rb_display_course_completion_icon_and_approval($status, $row) {
        global $CFG;
        // needed for approval constants
        require_once($CFG->dirroot . '/local/plan/lib.php');

        $approved = isset($row->approved) ? $row->approved : null;

        switch ($status) {
        case null:
            return null;
            break;
        case 'Not Completed':
            $statusstring = 'inprogress';
            break;
        case 'Completed':
            $statusstring = 'complete';
            break;
        }
        $content = "<span class=\"coursecompletionstatus\">";
        $content .= "<span class=\"completion-$statusstring\" title=\"$status\"></span></span>";

        // highlight if the item has not yet been approved
        if($approved == DP_APPROVAL_UNAPPROVED ||
            $approved == DP_APPROVAL_REQUESTED) {
            $content .= $this->rb_display_plan_item_status($approved);
        }
        return $content;
    }

}
