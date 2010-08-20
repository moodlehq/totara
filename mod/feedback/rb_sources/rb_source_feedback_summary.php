<?php // $Id$

/*
 * mod/feedback/rb_sources/rb_source_feedback_summary.php
 *
 * Report Builder source for generating summary (high-level) reports on feedback
 * activities.
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */

class rb_source_feedback_summary extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters;

    function __construct($groupid=null) {
        global $CFG;
        $this->base = $CFG->prefix . 'feedback_completed';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        parent::__construct();
    }

    //
    //
    // Methods for defining contents of source
    //
    //

    function define_joinlist() {
        global $CFG;

        // get the trainer role's id (or set a dummy value)
        $trainerroleid = get_field('role', 'id', 'shortname', 'trainer');
        if(!$trainerroleid) {
            $trainerroleid = 0;
        }

        // to get access to position type constants
        require_once($CFG->dirroot . '/hierarchy/type/position/lib.php');

        // joinlist for this source
        $joinlist = array(
            new rb_join(
                'feedback',
                'LEFT',
                $CFG->prefix . 'feedback',
                'feedback.id = base.feedback',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'session_value',
                'LEFT',
                // subquery as table
                "(SELECT i.feedback, v.value
                    FROM {$CFG->prefix}feedback_item i
                    JOIN {$CFG->prefix}feedback_value v
                        ON v.item=i.id AND i.typ='trainer')",
                'session_value.feedback = base.feedback',
                // potentially could be multiple trainer questions
                // in a feedback instance
                REPORT_BUILDER_RELATION_ONE_TO_MANY
            ),
            new rb_join(
                'sessiontrainer',
                'LEFT',
                $CFG->prefix . 'facetoface_session_roles',
                '(sessiontrainer.userid = ' .
                    'CAST(session_value.value AS INTEGER) AND ' .
                    "sessiontrainer.roleid = $trainerroleid)",
                // potentially multiple trainers in a session
                REPORT_BUILDER_RELATION_ONE_TO_MANY,
                'session_value'
            ),
            new rb_join(
                'trainer',
                'LEFT',
                $CFG->prefix . 'user',
                'trainer.id = sessiontrainer.userid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'sessiontrainer'
            ),
            new rb_join(
                'trainer_position_assignment',
                'LEFT',
                $CFG->prefix . 'pos_assignment',
                '(trainer_position_assignment.userid = ' .
                    'sessiontrainer.userid AND
                    trainer_position_assignment.type = ' .
                    POSITION_TYPE_PRIMARY . ')',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'sessiontrainer'
            ),
            new rb_join(
                'trainer_position',
                'LEFT',
                $CFG->prefix . 'pos',
                'trainer_position.id = ' .
                    'trainer_position_assignment.positionid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'trainer_position_assignment'
            ),
            new rb_join(
                'trainer_organisation',
                'LEFT',
                $CFG->prefix . 'org',
                'trainer_organisation.id = ' .
                    'trainer_position_assignment.organisationid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE,
                'trainer_position_assignment'
            ),
        );

        // include some standard joins
        $this->add_user_table_to_joinlist($joinlist, 'base', 'userid');
        $this->add_user_custom_fields_to_joinlist($joinlist, 'base', 'userid');
        $this->add_course_table_to_joinlist($joinlist, 'feedback', 'course');
        // requires the course join
        $this->add_course_category_table_to_joinlist($joinlist,
            'course', 'category');
        $this->add_position_tables_to_joinlist($joinlist, 'base', 'userid');
        // requires the position_assignment join
        $this->add_manager_tables_to_joinlist($joinlist,
            'position_assignment', 'reportstoid');
        $this->add_course_tags_tables_to_joinlist($joinlist, 'feedback', 'course');
        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            new rb_column_option(
                'responses',
                'timecompleted',
                'Time Completed',
                'base.timemodified',
                array('displayfunc' => 'nice_datetime')
            ),
            new rb_column_option(
                'feedback',
                'name',
                'Feedback Activity',
                'feedback.name',
                array('joins' => 'feedback')
            ),
            new rb_column_option(
                'trainer',
                'id',
                'Trainer ID',
                'sessiontrainer.userid',
                array('joins' => 'sessiontrainer')
            ),
            new rb_column_option(
                'trainer',
                'fullname',
                'Trainer Fullname',
                sql_fullname('trainer.firstname', 'trainer.lastname'),
                array('joins' => 'trainer')
            ),
            new rb_column_option(
                'trainer',
                'organisationid',
                'Trainer Organisation ID',
                'trainer_position_assignment.organisationid',
                array('joins' => 'trainer_position_assignment')
            ),
            new rb_column_option(
                'trainer',
                'organisation',
                'Trainer Organisation',
                'trainer_organisation.fullname',
                array('joins' => 'trainer_organisation')
            ),
            new rb_column_option(
                'trainer',
                'positionid',
                'Trainer Position ID',
                'trainer_position_assignment.positionid',
                array('joins' => 'trainer_position_assignment')
            ),
            new rb_column_option(
                'trainer',
                'position',
                'Trainer Position',
                'trainer_position.fullname',
                array('joins' => 'trainer_position')
            ),
        );
        // include some standard columns
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_user_custom_fields_to_columns($columnoptions);
        $this->add_course_fields_to_columns($columnoptions);
        $this->add_course_category_fields_to_columns($columnoptions);
        $this->add_position_fields_to_columns($columnoptions);
        $this->add_manager_fields_to_columns($columnoptions);
        $this->add_course_tag_fields_to_columns($columnoptions);

        return $columnoptions;
    }


    function define_filteroptions() {
        $filteroptions = array(
            new rb_filter_option(
                'feedback',
                'name',
                'Feedback Name',
                'text'
            ),
            new rb_filter_option(
                'responses',
                'timecompleted',
                'Time completed',
                'date'
            ),
            new rb_filter_option(
                'trainer',
                'fullname',
                'Trainer Fullname',
                'text'
            ),
            new rb_filter_option(
                'trainer',
                'organisationid',
                'Trainer Organisation',
                'select',
                array(
                    'selectfunc' => 'organisations_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
            new rb_filter_option(
                'trainer',
                'positionid',
                'Trainer Position',
                'select',
                array(
                    'selectfunc' => 'positions_list',
                    'selectoptions' => rb_filter_option::select_width_limiter(),
                )
            ),
        );

        // include some standard filters
        $this->add_user_fields_to_filters($filteroptions);
        $this->add_user_custom_fields_to_filters($filteroptions);
        $this->add_course_fields_to_filters($filteroptions);
        $this->add_course_category_fields_to_filters($filteroptions);
        $this->add_position_fields_to_filters($filteroptions);
        $this->add_manager_fields_to_filters($filteroptions);
        $this->add_course_tag_fields_to_filters($filteroptions);

        return $filteroptions;
    }


    function define_contentoptions() {
        $contentoptions = array(
            new rb_content_option(
                'user',
                'The user',
                'base.userid'
            ),
            new rb_content_option(
                'current_pos',
                "The user's current position",
                'base.userid'
            ),
            new rb_content_option(
                'current_org',                      // class name
                "The user's current organisation",  // title
                'base.userid'                      // field
            ),
            new rb_content_option(
                'course_tag',
                'The course',
                'tagids.idlist',
                'tagids'
            ),
            new rb_content_option(
                'date',
                "The response time",
                'base.timemodified'
            ),
        );
        return $contentoptions;
    }

    function define_paramoptions() {
        $paramoptions = array(
            new rb_param_option(
                'userid',         // parameter name
                'base.userid'     // field
            ),
            new rb_param_option(
                'courseid',
                'feedback.course',
                'feedback'
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'user',
                'value' => 'namelink',
                'heading' => 'User',
            ),
            array(
                'type' => 'course',
                'value' => 'courselink',
                'heading' => 'Course Name',
            ),
            array(
                'type' => 'feedback',
                'value' => 'name',
            ),
            array(
                'type' => 'responses',
                'value' => 'timecompleted',
            ),
        );

        return $defaultcolumns;
    }

    function define_defaultfilters() {

        $defaultfilters = array(
            array(
                'type' => 'course',
                'value' => 'fullname',
            ),
            array(
                'type' => 'user',
                'value' => 'fullname',
            ),
            array(
                'type' => 'feedback',
                'value' => 'name',
                'advanced' => 1,
            ),
            array(
                'type' => 'responses',
                'value' => 'timecompleted',
                'advanced' => 1,
            ),
        );


        return $defaultfilters;
    }


    //
    //
    // Methods for adding commonly used data to source definitions
    //
    //

    //
    // Join data
    //

    //
    // Column data
    //

    //
    // Filter data
    //

    //
    //
    // Source specific display functions
    //
    //

    //
    //
    // Source specific filter display methods
    //
    //


} // end of rb_source_feedback_summary class


