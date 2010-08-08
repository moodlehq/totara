<?php // $Id$

/*
 * mod/feedback/rb_sources/rb_source_feedback_questions.php
 *
 * Report Builder source for generating question-level reports on feedback
 * activities. Requires the rb_preproc_feedback_questions preprocessor and
 * an activity group
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package Totara
 */

class rb_source_graphical_feedback_questions extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $preproc, $grouptables, $groupid;
    public $grouptype, $requiredcolumns;

    function __construct($groupid=null) {
        global $CFG;
        $this->groupid = $groupid;
        $this->grouptables = 'report_builder_fbq_' . $groupid . '_';
        $this->base = $CFG->prefix . $this->grouptables . 'a';
        $this->joinlist = $this->define_joinlist();
        $this->columnoptions = $this->define_columnoptions();
        $this->filteroptions = $this->define_filteroptions();
        $this->contentoptions = $this->define_contentoptions();
        $this->paramoptions = $this->define_paramoptions();
        $this->defaultcolumns = $this->define_defaultcolumns();
        $this->defaultfilters = $this->define_defaultfilters();
        $this->requiredcolumns = $this->define_requiredcolumns();
        $this->preproc = 'feedback_questions';
        $this->grouptype = 'group';
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
                'feedback.id = base.feedbackid',
                REPORT_BUILDER_RELATION_ONE_TO_ONE
            ),
            new rb_join(
                'sessiontrainer',
                'LEFT',
                $CFG->prefix . 'facetoface_session_roles',
                '(sessiontrainer.sessionid = base.sessionid AND ' .
                    "sessiontrainer.roleid = $trainerroleid)",
                // potentially multiple trainers in a session
                REPORT_BUILDER_RELATION_ONE_TO_MANY
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
                'base.completedtime',
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
                'Face-to-face Session ID',
                'base.sessionid'
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
                'trainer_pa.organisationid',
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
                'trainer_pa.positionid',
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


    function define_requiredcolumns() {
        $requiredcolumns = array(
            new rb_column(
                'responses',
                'number',
                '# Feedback Responses',
                'base.id',
                array('grouping' => 'count')
            ),
        );
        // only create fields if being called on a group
        if($this->groupid !== null) {
            if($questions = get_records($this->grouptables . 'q', '', '',
                'sortorder')) {

                foreach($questions as $question) {
                    $qid = $question->sortorder;
                    $qname = $question->name;
                    switch($question->typ) {
                    case 'radio':
                    case 'radiorated':
                    case 'dropdown':
                    case 'dropdownrated':
                    case 'check':
                        if($options = get_records($this->grouptables . 'opt',
                            'qid', $qid, 'sortorder')) {

                            foreach($options as $option) {
                                $oid = $option->sortorder;
                                // number that selected this option
                                $requiredcolumns[] = new rb_column(
                                    'q' . $qid,
                                    $oid . '_sum',
                                    'Q' . $qid . ': # option ' . $oid,
                                    'base.q' . $qid . '_' . $oid,
                                    array('grouping' => 'sum')
                                );
                                // percentage that selected this option
                                $requiredcolumns[] = new rb_column(
                                    'q' . $qid,
                                    $oid . '_perc',
                                    'Q' . $qid . ': % option ' . $oid,
                                    'base.q' . $qid . '_' . $oid,
                                    array('grouping' => 'percent')
                                );
                            }
                            // total to answer question
                            $requiredcolumns[] = new rb_column(
                                'q' . $qid,
                                'total',
                                'Q' . $qid . ' # Responses',
                                'base.q' . $qid . '_value',
                                array('grouping' => 'count')
                            );
                            // average answer to question
                            $requiredcolumns[] = new rb_column(
                                'q' . $qid,
                                'average',
                                'Q' . $qid . ' Average',
                                'base.q' . $qid . '_value',
                                array(
                                    'displayfunc' => 'round2',
                                    'grouping' => 'average',
                                )
                            );
                        }
                        break;
                    case 'textarea':
                    case 'textfield':
                        // count of number of submissions
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'count',
                            'Q' . $qid . ': # answers',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'count')
                        );
                        // list of all answers provided
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'list',
                            'Q' . $qid . ': All answers',
                            'base.q' . $qid . '_answer',
                            array(
                                'grouping' => 'list_dash',
                                'style' => array('min-width' => '200px'),
                            )
                        );
                        break;
                        // options for number based fields
                    case 'numeric':
                        // count of number of submissions
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'count',
                            'Q' . $qid . ': # answers',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'count')
                        );
                        // display all answers
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'list',
                            'Q' . $qid . ': All answers',
                            'base.q' . $qid . '_answer',
                            array(
                                'grouping' => 'list_dash',
                                'style' => array('min-width' => '200px'),
                            )
                        );
                        // sum of all answers provided
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'sum',
                            'Q' . $qid . ': Sum',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'sum')
                        );
                        // average of all answers provided
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'average',
                            'Q' . $qid . ': Average',
                            'base.q' . $qid . '_answer',
                            array(
                                'displayfunc' => 'round2',
                                'grouping' => 'average',
                            )
                        );
                        // min of all answers provided
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'min',
                            'Q' . $qid . ': Min',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'min')
                        );
                        // max of all answers provided
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'max',
                            'Q' . $qid . ': Max',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'max')
                        );
                        // standard deviation of all answers provided
                        $requiredcolumns[] = new rb_column(
                            'q' . $qid,
                            'stddev',
                            'Q' . $qid . ': Standard Deviation',
                            'base.q' . $qid . '_answer',
                            array(
                                'displayfunc' => 'round2',
                                'grouping' => 'stddev',
                            )
                        );
                        break;
                    default:
                    }
                }
            }
        }

        return $requiredcolumns;
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
                'number',
                'Number of responses',
                'number'
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
                'trainer',
                'The trainer',
                'sessiontrainer.userid',
                'sessiontrainer'
            ),
            new rb_content_option(
                'date',
                "The response time",
                'base.completedtime'
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
            new rb_param_option(
                'trainerid',
                'sessiontrainer.userid',
                'sessiontrainer'
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
            array(
                'type' => 'feedback',
                'value' => 'name',
            ),
        );

        return $defaultcolumns;
    }

    function define_defaultfilters() {

        $defaultfilters = array(
            array(
                'type' => 'feedback',
                'value' => 'name',
            ),
        );
        // by default add each tag filter as an advanced option
        if($tags = get_records('tag', 'tagtype', 'official')) {
            foreach($tags as $tag) {
                $defaultfilters[] = array(
                    'type' => 'tags',
                    'value' => 'course_tag_' . $tag->id,
                    'advanced' => 1,
                );
            }
        }

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


} // end of rb_source_feedback_questions class


