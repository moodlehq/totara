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

class rb_source_feedback_questions extends rb_base_source {
    public $base, $joinlist, $columnoptions, $filteroptions;
    public $contentoptions, $paramoptions, $defaultcolumns;
    public $defaultfilters, $preproc, $grouptables, $groupid;
    public $grouptype;

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

        // joinlist for this source
        $joinlist = array(
            'user' => "LEFT JOIN {$CFG->prefix}user u ON base.userid = u.id",
            'feedback' => "LEFT JOIN {$CFG->prefix}feedback f ON base.feedbackid = f.id",
            'position_assignment' => "LEFT JOIN {$CFG->prefix}pos_assignment pa ON base.userid = pa.userid",
            'position' => "LEFT JOIN {$CFG->prefix}pos position ON position.id = pa.positionid",
            'organisation' => "LEFT JOIN {$CFG->prefix}org organisation ON organisation.id = pa.organisationid",
            'course' => "LEFT JOIN {$CFG->prefix}course c ON c.id = f.course",
            'course_category' => "LEFT JOIN {$CFG->prefix}course_categories cat ON cat.id = c.category",
            'tags' => "LEFT JOIN (
                    SELECT crs.id AS cid, " . sql_group_concat('CAST(t.id AS varchar)','|') .
                    " AS idlist
                    FROM {$CFG->prefix}course crs
                    LEFT JOIN {$CFG->prefix}tag_instance ti
                        ON crs.id=ti.itemid AND ti.itemtype='course'
                    LEFT JOIN {$CFG->prefix}tag t
                        ON ti.tagid=t.id AND t.tagtype='official'
                    GROUP BY crs.id) tags ON tags.cid = c.id",
            'trainer' => "LEFT JOIN {$CFG->prefix}user trainer ON trainer.id = base.trainerid",
            'trainer_position_assignment' => "LEFT JOIN {$CFG->prefix}pos_assignment trainer_pa ON base.trainerid = trainer_pa.userid",
            'trainer_position' => "LEFT JOIN {$CFG->prefix}pos trainer_position ON trainer_position.id = trainer_pa.positionid",
            'trainer_organisation' => "LEFT JOIN {$CFG->prefix}org trainer_organisation ON trainer_organisation.id = trainer_pa.organisationid",
        );

        // create a join for each official tag
        if($tags = get_records('tag', 'tagtype', 'official')) {
            foreach($tags as $tag) {
                $name = $tag->name;
                $tagid = $tag->id;
                $key = "course_tag_$tagid";
                $joinlist[$key] = "LEFT JOIN {$CFG->prefix}tag_instance $key ON f.course=$key.itemid AND $key.itemtype='course' AND $key.tagid=$tagid";
            }
        }

        // add joins for user custom fields
        $this->add_user_custom_fields_to_joinlist($joinlist);

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

        return $joinlist;
    }

    function define_columnoptions() {
        $columnoptions = array(
            new rb_column_option(
                'responses',
                'number',
                '# Feedback Responses',
                'base.id',
                array('grouping' => 'count')
            ),
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
                'f.name',
                array('joins' => 'feedback')
            ),
            // used by tag content restriction
            new rb_column_option(
                'course',
                'tagids',
                'Course Tag IDs',
                "tags.idlist",
                array(
                    'joins' => array('feedback', 'course', 'tags'),
                )
            ),
            new rb_column_option(
                'trainer',
                'id',
                'Trainer ID',
                'base.trainerid'
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
                array(
                    'joins' => array('trainer',
                                     'trainer_position_assignment'),
                )
            ),
            new rb_column_option(
                'trainer',
                'organisation',
                'Trainer Organisation',
                'trainer_organisation.fullname',
                array(
                    'joins' => array('trainer',
                                     'trainer_position_assignment',
                                     'trainer_organisation'),
                )
            ),
        );

        // create a on/off field for every official tag
        if($tags = get_records('tag', 'tagtype', 'official')) {
            foreach($tags as $tag) {
                $tagid = $tag->id;
                $name = $tag->name;
                $join = "course_tag_$tagid";
                $columnoptions[] = new rb_column_option(
                    'tags',
                    $join,
                    "Tagged '$name'",
                    "CASE WHEN $join.id IS NOT NULL THEN 1 ELSE 0 END",
                    array(
                        'joins' => array('feedback', $join),
                        'displayfunc' => 'yes_no',
                    )
                );

            }
        }

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
                                $columnoptions[] = new rb_column_option(
                                    'q' . $qid,
                                    $oid . '_sum',
                                    'Q' . $qid . ': # option ' . $oid,
                                    'base.q' . $qid . '_' . $oid,
                                    array('grouping' => 'sum')
                                );
                                // percentage that selected this option
                                $columnoptions[] = new rb_column_option(
                                    'q' . $qid,
                                    $oid . '_perc',
                                    'Q' . $qid . ': % option ' . $oid,
                                    'base.q' . $qid . '_' . $oid,
                                    array('grouping' => 'percent')
                                );
                            }
                            // total to answer question
                            $columnoptions[] = new rb_column_option(
                                'q' . $qid,
                                'total',
                                'Q' . $qid . ' # Responses',
                                'base.q' . $qid . '_value',
                                array('grouping' => 'count')
                            );
                            // average answer to question
                            $columnoptions[] = new rb_column_option(
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
                        $columnoptions[] = new rb_column_option(
                            'q' . $qid,
                            'count',
                            'Q' . $qid . ': # answers',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'count')
                        );
                        // list of all answers provided
                        $columnoptions[] = new rb_column_option(
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
                        $columnoptions[] = new rb_column_option(
                            'q' . $qid,
                            'count',
                            'Q' . $qid . ': # answers',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'count')
                        );
                        // sum of all answers provided
                        $columnoptions[] = new rb_column_option(
                            'q' . $qid,
                            'sum',
                            'Q' . $qid . ': Sum',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'sum')
                        );
                        // average of all answers provided
                        $columnoptions[] = new rb_column_option(
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
                        $columnoptions[] = new rb_column_option(
                            'q' . $qid,
                            'min',
                            'Q' . $qid . ': Min',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'min')
                        );
                        // max of all answers provided
                        $columnoptions[] = new rb_column_option(
                            'q' . $qid,
                            'max',
                            'Q' . $qid . ': Max',
                            'base.q' . $qid . '_answer',
                            array('grouping' => 'max')
                        );
                        // standard deviation of all answers provided
                        $columnoptions[] = new rb_column_option(
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
        // add all user profile fields to columns
        // requires 'user' and 'user_profile' in join list
        $this->add_user_fields_to_columns($columnoptions);
        $this->add_user_custom_fields_to_columns($columnoptions);

        // add position and organisation columns
        $this->add_position_info_to_columns($columnoptions);

        // add course columns
        $this->add_course_info_to_columns($columnoptions, array('feedback'));
        $this->add_course_category_info_to_columns($columnoptions, array('feedback'));

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
        );

        // add some generic text filters
        // add all user profile field to filters
        $this->add_user_fields_to_filters($filteroptions);
        $this->add_user_custom_fields_to_filters($filteroptions);

        // add user position filters
        $this->add_position_fields_to_filters($filteroptions);

        // add course filters
        $this->add_course_fields_to_filters($filteroptions);
        $this->add_course_category_fields_to_filters($filteroptions);

        // create a filter for every official tag
        if($tags = get_records('tag', 'tagtype', 'official')) {
            foreach($tags as $tag) {
                $tagid = $tag->id;
                $name = $tag->name;
                $join = "course_tag_$tagid";
                $filteroptions[] = new rb_filter_option(
                    'tags',
                    $join,
                    "Tagged '$name'",
                    'simpleselect',
                    array('selectchoices' => array(
                        1 => get_string('yes'), 0 => get_string('no'))
                    )
                );
            }
        }

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
                'tags.idlist',
                array('feedback', 'course', 'tags')
            ),
            // START IRD SPECIFIC
            new rb_content_option(
                'trainer',
                'The trainer',
                'base.trainerid'
            ),
            // END IRD SPECIFIC
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
                'f.course',
                'feedback'
            ),
            new rb_param_option(
                'trainerid',
                'base.trainerid'
            ),
        );

        return $paramoptions;
    }

    function define_defaultcolumns() {
        $defaultcolumns = array(
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
                'value' => 'number',
            ),
        );

        // only create fields if being called on a group
        if($this->groupid !== null) {
            if($questions = get_records($this->grouptables.'q','', '', 'sortorder')) {
                foreach($questions as $question) {
                    $qid = $question->sortorder;
                    $name = $question->name;
                    switch($question->typ) {
                    case 'radio':
                    case 'radiorated':
                    case 'dropdown':
                    case 'dropdownrated':
                    case 'check':
                        // average answer
                        $defaultcolumns[] = array(
                            'type' => 'q' . $qid,
                            'value' => 'average',
                        );
                    break;
                    case 'textarea':
                    case 'textfield':
                    case 'numeric':
                        // count of number of submissions
                        $defaultcolumns[] = array(
                            'type' => 'q' . $qid,
                            'value' => 'count',
                        );
                    break;
                    }
                }
            }
        }

        return $defaultcolumns;
    }

    function define_defaultfilters() {

        $defaultfilters = array(
            array(
                'type' => 'course',
                'value' => 'fullname',
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


