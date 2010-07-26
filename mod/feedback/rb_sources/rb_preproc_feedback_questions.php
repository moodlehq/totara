<?php // $Id$

/*
 * mod/feedback/rb_sources/rb_preproc_feedback_questions.php
 *
 * Report Builder pre-processor for converting feedback tables into
 * a format suitable for use by the feedback source
 *
 * The key table is feedback_completed, which contains one row per
 * user response. This is converted into an answers table, which also
 * contains one row per response, but with columns for each question,
 * so all the information about that response is contained in a row.
 *
 * To help track this information, two additional tables are created,
 * one containing the questions and another containing the question
 * options (only for question types which include choices)
 *
 * @copyright Catalyst IT Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package Totara
 */
class rb_preproc_feedback_questions extends rb_base_preproc {

    var $name;
    var $prefix;

    function __construct($groupid) {
        $this->name = 'feedback_questions';
        $this->prefix = 'fbq';
        parent::__construct($groupid);
    }

    /*
     * Retrieve a list of all items for the specified group
     *
     * @return array Array of all items (usually IDs) to be used when
     *               group is set to 'all'
     */
    function get_all_items() {
        // return all feedback item IDs
        if($all = get_records('feedback', '', '', 'id', 'id')) {
            return array_keys($all);
        } else {
            return array();
        }
    }

    /*
     * Execute this preprocessor on the item, as a member of the given group
     *
     * @param string $item Identifier (usually an ID) of the item to process
     * @param integer $lastchecked Timestamp of when this item was last processed
     * @param string &$message For returning info to cron. Passed by reference
     *
     * @return boolean True if update was successful
     */
    function run($item, $lastchecked, &$message) {
        global $CFG;
        $groupid = $this->groupid;
        // need access to DB modification functions
        require_once($CFG->libdir . '/ddllib.php');

        $questionstable = "report_builder_{$this->prefix}_{$groupid}_q";
        $message = '';

        // initialize tables if not already done
        if(!$this->is_initialized()) {
            if(!$this->initialize_group($item)) {
                $message = $this->name . ': Failed to initialize tables for ' .
                    'group ' . $groupid . ' using feedback ' . $item .
                    ' as a template';
                return false;
            }
        }

        // get list of responses, skip if there aren't any
        $responses = $this->get_completed_responses($item);
        if(count($responses) == 0) {
            mtrace('No responses found for feedback ' . $item . '. Skipping.');
            return true;
        }

        // get list of questions that should be processed for this group
        $valid_questions = get_records($questionstable, '', '', 'id');

        mtrace('Processing ' . count($responses) .
            ' responses for feedback ' . $item);

        // process the responses
        $counts = $this->process_responses($responses, $lastchecked,
            $valid_questions, $item);

        // no responses matched at all
        if($counts['total'] == $counts['noresponses']) {
            $message = "None of this feedback's responses matched any of the " .
                "expected questions. Disabled for next time.";
            return false;
        }

        // something went wrong while inserting records
        if($counts['failedinsert'] > 0) {
            $message = "Something went wrong while trying to insert responses. " .
                "Disabled for next time.";
            return false;
        }

        // display how many items haven't changed
        if($counts['unchanged'] > 0) {
            mtrace('Ignoring ' . $counts['unchanged'] .' unchanged responses.');
        }

        // remove processed data for any items that no longer exist
        // (presumably deleted via moodle)
        $this->remove_deleted_items();

        // update tracking info for this item
        $this->update_track_info($item);

        // everything worked, don't disabled this item
        return true;
    }


    /*
     * Removes any processed entries that no longer exist in the original
     * source table (i.e. have been deleted).
     *
     * @return boolean True if records found
     */
    private function remove_deleted_items() {
        global $CFG;
        $answerstable = "report_builder_{$this->prefix}_{$this->groupid}_a";

        // returns response IDs that are in answer table
        // but not in feedback_completed
        $deleted = get_records_sql("SELECT a.responseid
            FROM {$CFG->prefix}$answerstable a
            LEFT JOIN {$CFG->prefix}feedback_completed fc
            ON fc.id = a.responseid
            WHERE fc.id IS NULL");

        if($deleted) {
            // delete them from answers table
            foreach(array_keys($deleted) as $responseid) {
                mtrace('Removing out of date record with response ID of ' .
                    $responseid);
                delete_records($answerstable, 'responseid', $responseid);
            }
            return true;
        }

        return false;
    }


    /*
     * Process a set of responses and insert the processed data to the
     * appropriate table. Returns a set of counts indicating how it went
     *
     * @param array $responses Array of response objects
     * @param integer $lastchecked The timestamp of when this item was checked
     * @param array $valid_questions Array of question objects to look for
     * @param string Identifier (usually the ID) of the current item
     *
     * @return array Associative array containing stats on how insert went
     *               Keys are:
     *                  'total' => Total number of responses processed
     *                  'unchanged' => Number that weren't processed because
     *                                 the response was earlier than the
     *                                 lastchecked time
     *                  'noresponses' => Number of responses where none of the
     *                                   responses matched any of the questions
     *                                   provided
     *                  'insertfailed' => Number of responses where an insert
     *                                    was attempted but it failed
     *
     */
    private function process_responses($responses, $lastchecked,
        $valid_questions, $item) {

        $groupid = $this->groupid;
        $answerstable = "report_builder_{$this->prefix}_{$groupid}_a";

        // initialize counters
        $counts = array();
        $counts['total'] = 0;
        $counts['unchanged'] = 0;
        $counts['noresponses'] = 0;
        $counts['failedinsert'] = 0;

        foreach($responses as $response) {
            $counts['total']++;

            // don't do anything if this response hasn't changed since
            // last check
            if($response->timemodified < $lastchecked) {
                $counts['unchanged']++;
                continue;
            }

            // make a new copy of valid_questions for each response (because
            // questions are removed from the list as they are found)
            $valid_questions_list = $valid_questions;

            // track how many valid questions this reponse contains
            $responsecount = 0;

            // create a skeleton DB object
            $todb = new object();
            $todb->feedbackid = $item;
            $todb->responseid = $response->id;
            // don't store userid if response was anonymous
            if($response->anonymous_response == 1) {
                $todb->userid = 0;
            } else {
                $todb->userid = $response->userid;
            }
            $todb->completedtime = $response->timemodified;

            // get all answers for this response
            $response_answers = $this->get_response_answers($response->id);
            foreach($response_answers as $response_answer) {
                // only process if the question matches one of those we are
                // expecting. Otherwise just skip it
                if($question = $this->get_question_match($response_answer,
                    $valid_questions_list)) {
                    // add relevant fields to the skeleton DB object,
                    // depending on the question type and answer
                    $this->add_response_answer($todb, $response_answer->value,
                        $question);
                    // Remove the matching question from valid_questions list
                    // to prevent adding multiple processed items if the same
                    // question is asked multiple times
                    $this->remove_question_from_list($question,
                        $valid_questions_list);

                    // count how many questions matched
                    $responsecount++;
                }
            }

            // print some feedback on progress
            // displays 100 dots, then starts a new line
            if(($counts['total'] - $counts['unchanged']) % 100 == 0) {
                printf(".\n");
            } else {
                printf('.');
            }
            flush();

            if($responsecount == 0) {
                // no matching questions for this response so don't insert
                // it into the processed results table
                $counts['noresponses']++;
                continue;
            }

            if(!insert_record($answerstable, $todb)) {
                // something went wrong saving the data
                $counts['failedinsert']++;
            }
        }

        // if any dots were printed, finish with a new line
        if($counts['total'] - $counts['unchanged'] > 0 &&
            ($counts['total'] - $counts['unchanged']) % 100 != 0) {
            printf("\n");
        }

        return $counts;
    }

    /*
     * Given a question object and an array of questions, remove the question
     * provided from the array. The question objects must be identical.
     *
     * @param object $question A question object
     * @param array &$valid_questions An array of questions, passed by ref
     *
     * @return True if the question was found and removed
     */
    private function remove_question_from_list($question, &$valid_questions) {
        foreach($valid_questions as $key => $valid_question) {
            if($question === $valid_question) {
                unset($valid_questions[$key]);
                return true;
            }
        }
        return false;
    }

    /*
     * Adds the answer to a given question to the database object in
     * preparation for adding the processed answer to the database
     *
     * @param object &$todb Database object to be inserted (passed by ref)
     * @param string $value Answer to the question
     * @param object $question Question object that the answer is for
     *
     * @return True
     */
    private function add_response_answer(&$todb, $value, $question) {
        $qid = $question->id;
        $type = $question->typ;
        switch($type) {
        case 'trainer':
            if($value != '') {  //TODO or zero? What is saved when no trainer?
                $todb->trainerid = addslashes($value);
            }
        case 'textfield':
        case 'textarea':
        case 'numeric':
            if($value != '') {
                $fieldname = 'q' . $qid . '_answer';
                $todb->$fieldname = addslashes($value);
            }
            break;
        case 'radio':
        case 'radiorated':
        case 'dropdown':
        case 'dropdownrated':
            if($value != 0) {
                $options = $this->extract_item_options($question);
                $opt_num = 1;
                foreach($options as $option) {
                    $answername = 'q' . $qid . '_answer';
                    $valuename = 'q' . $qid . '_value';
                    $optionname = 'q' . $qid . '_' . $opt_num;
                    if($opt_num == $value) {
                        // if value matches this option, save the answer,
                        // value and set that option field to 1
                        $todb->$answername = addslashes($option->name);
                        $todb->$valuename = addslashes($option->value);
                        $todb->$optionname = 1;
                    } else {
                        $todb->$optionname = 0;
                    }
                    $opt_num++;
                }
            }
            break;
        case 'check':
            if($value != 0) {
                $options = $this->extract_item_options($question);
                $answername = 'q' . $qid . '_answer';
                $valuename = 'q' . $qid . '_value';

                // array of picked item indexes
                $allpicked = explode('|', $value);

                // arrays to store names/values of any matches
                $names = array();
                $values = array();

                $opt_num = 1;
                foreach($options as $option) {
                    // first assume that it's not checked
                    $optionname = 'q' . $qid . '_' . $opt_num;
                    $todb->$optionname = 0;

                    // if it is checked, override the individual option field
                    // and add this item to the names and values arrays
                    foreach($allpicked as $picked) {
                        if($opt_num == $picked) {
                            $todb->$optionname = 1;
                            $names[] = $option->name;
                            $values[] = $option->value;
                        }
                    }
                    $opt_num++;
                }

                // add an answers field if any fields checked
                if(count($names) > 0) {
                    $todb->$answername = addslashes(implode(', ', $names));
                }
                // add an average value field if any fields checked
                if(count($values) > 0) {
                    $todb->$valuename = array_sum($values) / count($values);
                }
            }
            break;
        }
        return true;
    }

    /*
     * Given a feedback response to a single question, see if it matches any
     * of the valid questions for this group. If so return the matched question
     *
     * @param object $response_answer Answer object
     * @param array $valid_questions Array of question objects
     *
     * @return object Question object that the response matched
     */
    private function get_question_match($response_answer, $valid_questions) {
        // check if response matches any of the questions
        // if so return the matching question object
        foreach($valid_questions as $valid_question) {
            if($valid_question->name == $response_answer->name &&
               $valid_question->presentation == $response_answer->presentation &&
               $valid_question->typ == $response_answer->typ) {
                return $valid_question;
            }
        }
        return false;
    }

    /*
     * Given an ID of a particular completed response, return the question
     * info and the user's answer to all the questions in the feedback
     *
     * @param integer $responseid ID from the feedback_completed table
     *
     * @return array Array of answer objects, or an empty array if none found
     */
    private function get_response_answers($responseid) {
        global $CFG;
        $answers = get_records_sql("
            SELECT i.name, i.presentation, i.typ, v.value
            FROM {$CFG->prefix}feedback_value v
            JOIN {$CFG->prefix}feedback_item i ON i.id = v.item
            WHERE i.hasvalue = 1
            AND v.completed = $responseid
            ORDER BY i.position
        ");
        return $answers ? $answers : array();
    }


    /*
     * Given a feedback activity ID, return a list of all complete responses
     *
     * @param integer $item ID of a feedback activity
     *
     * @return array Array of response objects, or an empty array if none found
     */
    private function get_completed_responses($item) {
        if($responses = get_records('feedback_completed', 'feedback', $item,
            'id')) {
            return $responses;
        } else {
            return array();
        }

    }

    /*
     * Check if a particular group has had its tables initialized yet
     *
     * Tables follow the convention:
     *
     *  report_builder_[preproc prefix]_[groupid]_[suffix]
     *
     * This allows every preprocessor to have a set of tables for every group
     *
     * @return boolean True if it has been initialized (required tables exist)
     *
     */
    function is_initialized() {

        $groupid = $this->groupid;

        // list of required tables to check
        $suffixes = array(
            'q',    // for storing questions
            'opt',  // for storing question options
            'a',    // for storing answers
        );

        // check all tables needed by this preprocessor and group exist
        foreach($suffixes as $suffix) {
            $name = 'report_builder_' . $this->prefix . '_' .
                $groupid . '_' . $suffix;
            $table = new XMLDBTable($name);
            if(!table_exists($table)) {
                return false;
            }
        }

        return true;

    }


    /*
     * Initialize and fill the required tables for this group, using the current
     * item as a template if necessary
     *
     * @param string $item Identifier (usually the ID) of the item to use as a
     *                     template if no base item is specified by the current
     *                     group
     *
     * @return boolean True if initialization successful
     */
    function initialize_group($item=null) {
        $status = true;

        // find out which item to use as the template for initializing
        $baseitem = get_field('report_builder_group', 'baseitem', 'id',
            $this->groupid);
        if($item === null && $baseitem === null) {
            return false;
        } else if ($baseitem === null) {
            // if none specified, use the current item
            $baseitem = $item;
        }

        // create questions table (unless it exists already)
        $status = $status && $this->initialize_questions_table($baseitem);

        // create question options table (unless it exists already)
        $status = $status && $this->initialize_question_options_table($baseitem);

        // create question answers table (unless it exists already)
        $status = $status && $this->initialize_answers_table($baseitem);

        return $status;
    }


    /*
     * Drop required tables for this group
     *
     * @return boolean True if tables removed successfully
     */
    function drop_group_tables() {
        $status = true;
        $groupid = $this->groupid;

        // list of required tables to drop
        $suffixes = array(
            'q',    // for storing questions
            'opt',  // for storing question options
            'a',    // for storing answers
        );

        // check all tables needed by this preprocessor and group exist
        foreach($suffixes as $suffix) {
            $name = 'report_builder_' . $this->prefix . '_' .
                $groupid . '_' . $suffix;
            $table = new XMLDBTable($name);
            if(table_exists($table)) {
                $status = $status && drop_table($table, true, false);
            }
        }

        return $status;
    }

    /*
     * Initialize and fill the questions table for this group, using the item
     * provided as a template (to determine which questions to add)
     *
     * @param string $item Identifier (usually the ID) of the item to use as a
     *                     template
     *
     * @return boolean True if initialization successful
     */
    private function initialize_questions_table($item) {
        global $CFG;
        $groupid = $this->groupid;
        $status = true;
        // create questions table
        $questionstable = "report_builder_{$this->prefix}_{$groupid}_q";
        $table = new XMLDBTable($questionstable);
        if(!table_exists($table)) {

            /// Adding fields to questions table
            $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
            $table->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null,
                XMLDB_NOTNULL, null, null);
            $table->addFieldInfo('presentation', XMLDB_TYPE_TEXT, 'medium',
                XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null);
            $table->addFieldInfo('typ', XMLDB_TYPE_CHAR, '255', null,
                XMLDB_NOTNULL, null, null);
            $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);

            /// Adding keys to questions table
            $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
            $status = $status && create_table($table, true, false);

            //mtrace('Creating questions table for preprocessor '.
            //    $this->name . ' and group ' . $groupid . ' using item ' .
            //    $item . ' as template.');

            // add questions for this item
            if($questions = get_records_sql("
                SELECT i.name, i.presentation, i.typ
                FROM {$CFG->prefix}feedback f
                LEFT JOIN {$CFG->prefix}feedback_item i
                ON f.id = i.feedback
                WHERE f.id = {$item} AND i.hasvalue != 0
                ORDER BY i.position")) {

                $i = 1;
                foreach($questions as $question) {
                    //mtrace('Inserting question ' . $i);
                    $todb = new object();
                    $todb->name = addslashes($question->name);
                    $todb->presentation = addslashes($question->presentation);
                    $todb->typ = addslashes($question->typ);
                    $todb->sortorder = $i;
                    $status = $status && insert_record($questionstable, $todb);
                    $i++;
                }

            }
        }
        return $status;
    }


    /*
     * Initialize and fill the question options table for this group, using the
     * item provided as a template (to determine which question options to add)
     *
     * @param string $item Identifier (usually the ID) of the item to use as a
     *                     template
     *
     * @return boolean True if initialization successful
     */
    private function initialize_question_options_table($item) {
        $status = true;
        $groupid = $this->groupid;
        $questionstable = "report_builder_{$this->prefix}_{$groupid}_q";
        if($questions = get_records($questionstable)) {
            $optionstable = "report_builder_{$this->prefix}_{$groupid}_opt";
            $table = new XMLDBTable($optionstable);
            if(!table_exists($table)) {

                /// Adding fields to question options table
                $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10',
                    XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null,
                    null);
                $table->addFieldInfo('qid', XMLDB_TYPE_INTEGER, '10',
                    XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
                $table->addFieldInfo('name', XMLDB_TYPE_CHAR, '255', null,
                    XMLDB_NOTNULL, null, null);
                $table->addFieldInfo('sortorder', XMLDB_TYPE_INTEGER, '10',
                    XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);

                /// Adding keys to question options table
                $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
                $status = $status && create_table($table, true, false);
                //mtrace('Creating question options table for preprocessor '.
                //    $this->name . ' and group ' . $groupid . ' using item ' .
                //    $item . ' as template.');

                // question types that have options
                // (and are supported)
                $option_types = array('radio', 'radiorated', 'check', 'dropdown',
                    'dropdownrated');

                foreach($questions as $question) {
                    if(in_array($question->typ, $option_types)) {
                        //mtrace('Inserting options for question ' . $question->id);
                        // get details about any options in this question
                        $options = $this->extract_item_options($question);
                        if(is_array($options)) {
                            // save each question option
                            foreach($options as $option) {
                                $todb = new object();
                                $todb->qid = $option->qid;
                                $todb->name = addslashes($option->name);
                                $todb->sortorder = $option->sortorder;
                                $status = $status &&
                                    insert_record($optionstable, $todb);
                            }
                        }
                    }
                }
            }
        } else {
            $status = false;
        }
        return $status;
    }


    /*
     * Given a question, return an array of objects containing information
     * about the items in it, depending on the question type
     *
     * @param object $question Question object
     *
     * @return mixed Array of option objects or false if question doesn't
     *               have any options (like a textarea)
     */
    private function extract_item_options($question) {
        global $CFG;
        $type = $question->typ;
        $status = true;

        $line_sep = null; // string which separates options
        $adjust_sep = null; // string containing config info
        $value_sep = null; // string which separates options from values

        // based on question type, figure out the separators that have
        // been used to format the string. Where possible we get these
        // directly from the feedback module
        $this->get_feedback_option_separators($type, $line_sep,
            $adjust_sep, $value_sep);

        // get rid of \r characters from question strings
        $options_string = str_replace('\r', '', $question->presentation);

        // if adjustment separator set, remove and discard anything
        // after it
        if($adjust_sep !== null) {
            $loc = strpos($options_string, $adjust_sep);
            if($loc !== false) {
                $options_string = substr($options_string, 0, $loc);
            }
        }

        // we need a line separator - exit if not set
        if($line_sep === null) {
            return false;
        }
        // split into individual options
        $options = explode($line_sep, stripslashes_safe($options_string));
        // insert into options in order from array
        $i = 1;
        $out = array();
        foreach($options as $option) {
            // if a value separator is set, save the value given as well as
            // the name. Otherwise use the option's index as the value
            if($value_sep !== null) {
                $loc = strpos($option, $value_sep);
                if($loc !== false) {
                    $name = substr($option, $loc + strlen($value_sep));
                    $value = substr($option, 0, $loc);
                }
            } else {
                $name = $option;
                $value = $i;
            }

            // save the option info to the table
            $optioninfo = new object();
            $optioninfo->qid = $question->id;
            $optioninfo->name = trim($name);
            $optioninfo->value = trim($value);
            $optioninfo->sortorder = $i;
            $out[] = $optioninfo;
            $i++;
        }
        return $out;
    }


    /*
     * Get the strings used to separate options for this particular question type
     *
     * @param string $type Question type
     * @param string &$line Line separator (passed by reference)
     * @param string &$adjust Adjustment separator (passed by reference)
     * @param string &$value Value separator (passed by reference)
     *
     * @return Returns true and updates separator variables
     */
    private function get_feedback_option_separators($type, &$line, &$adjust,
        &$value) {

        global $CFG;
        // special cases for feedback items that don't follow normal
        // conventions
        if($type == 'dropdown') {
            $this->get_feedback_dropdown_separators($line, $adjust, $value);
            return true;
        }
        if($type == 'dropdownrated') {
            $this->get_feedback_dropdownrated_separators($line, $adjust, $value);
            return true;
        }

        // import the feedback question type's library
        $lib = $CFG->dirroot . '/mod/feedback/item/' . $type . '/lib.php';
        require_once($lib);

        // get the values of the separator constants
        $line_sep_name = 'FEEDBACK_' . strtoupper($type) . '_LINE_SEP';
        $adjust_sep_name = 'FEEDBACK_' . strtoupper($type) . '_ADJUST_SEP';
        $value_sep_name = 'FEEDBACK_' . strtoupper($type) . '_VALUE_SEP';
        $line = defined($line_sep_name) ? constant($line_sep_name) : null;
        $adjust = defined($adjust_sep_name) ? constant($adjust_sep_name) : null;
        $value = defined($value_sep_name) ? constant($value_sep_name) : null;

        return true;
    }


    /*
     * Special case method for dropdown question type as it behaves in a
     * non-standard way
     *
     * @param string &$line Line separator (passed by reference)
     * @param string &$adjust Adjustment separator (passed by reference)
     * @param string &$value Value separator (passed by reference)
     *
     * @return Returns true and updates separator variables
     */
    private function get_feedback_dropdown_separators(&$line, &$adjust, &$value) {
        // hardcoded into item as |
        $line = '|';
        $adjust = null;
        $value = null;
        return true;
    }


    /*
     * Special case method for rated dropdown question type as it behaves in a
     * non-standard way
     *
     * @param string &$line Line separator (passed by reference)
     * @param string &$adjust Adjustment separator (passed by reference)
     * @param string &$value Value separator (passed by reference)
     *
     * @return Returns true and updates separator variables
     */
    private function get_feedback_dropdownrated_separators(&$line, &$adjust,
        &$value) {

        global $CFG;
        $lib = $CFG->dirroot . '/mod/feedback/item/dropdownrated/lib.php';
        require_once($lib);
        $line = constant('FEEDBACK_DROPDOWN_LINE_SEP');
        $adjust = null;
        $value = constant('FEEDBACK_DROPDOWN_VALUE_SEP');
        return true;
    }


    /*
     * Initialize (but don't fill) the answers table for this group, using the item
     * provided as a template (to determine which answer columns to add)
     *
     * @param string $item Identifier (usually the ID) of the item to use as a
     *                     template
     *
     * @return boolean True if initialization successful
     */
    private function initialize_answers_table($item) {
        $groupid = $this->groupid;
        $status = true;
        $questionstable = "report_builder_{$this->prefix}_{$groupid}_q";
        $optionstable = "report_builder_{$this->prefix}_{$groupid}_opt";

        // create answers table
        $answerstable = "report_builder_{$this->prefix}_{$groupid}_a";
        $table = new XMLDBTable($answerstable);
        if(!table_exists($table)) {

            /// Adding standard fields to answers table
            $table->addFieldInfo('id', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null, null);
            $table->addFieldInfo('feedbackid', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('userid', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('responseid', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, XMLDB_NOTNULL, null, null, null, null);
            $table->addFieldInfo('trainerid', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, null, null, null, null, null);
            $table->addFieldInfo('completedtime', XMLDB_TYPE_INTEGER, '10',
                XMLDB_UNSIGNED, null, null, null, null, null);

            // loop through questions and add the right columns for the
            // particular question type
            if($questions = get_records($questionstable, '', '', 'sortorder')) {
                $qnum = 1;
                foreach($questions as $question) {
                    $status = $status &&
                        $this->add_question_fields($table, $qnum, $question->typ,
                        $optionstable);
                    $qnum++;
                }
            } else {
                //mtrace("Can't generate answers table without questions!");
                return false;
            }

            // Adding keys to questions table
            $table->addKeyInfo('primary', XMLDB_KEY_PRIMARY, array('id'));
            $status = $status && create_table($table, true, false);

            //mtrace('Creating answers table for preprocessor '.
            //    $this->name . ' and group ' . $groupid . ' using item ' .
            //    $item . ' as template.');
        }
        return $status;
    }


    /*
     * Adds extra fields to the answers table, depending on the type of question
     *
     * @param object &$table XMLDB Table object to add the fields to
     * @param integer $qnum Question number (used in field name)
     * @param object $type The question type to insert
     * @param string $optionstable Name of the options table
     *
     * @return boolean True if all fields are added okay
     */
    private function add_question_fields(&$table, $qnum, $type, $optionstable) {
        $status = true;
        switch($type) {
        case 'textfield':
            $status = $status &&
                $table->addFieldInfo('q' . $qnum . '_answer',
                    XMLDB_TYPE_CHAR, '255', null, null, null, null);
            break;
        case 'textarea':
            $status = $status &&
                $table->addFieldInfo('q' . $qnum . '_answer',
                    XMLDB_TYPE_TEXT, 'medium', null, null, null, null);
            break;
        case 'numeric':
            $status = $status &&
                $table->addFieldInfo('q' . $qnum . '_answer',
                    XMLDB_TYPE_NUMBER, '10', null, null, null, null);
            break;
        case 'radio':
        case 'check':
        case 'dropdown':
        case 'radiorated':
        case 'dropdownrated':
            $status = $status &&
                $table->addFieldInfo('q' . $qnum . '_answer',
                    XMLDB_TYPE_CHAR, '255', null, null, null, null);
            $status = $status &&
                $table->addFieldInfo('q' . $qnum . '_value',
                    XMLDB_TYPE_NUMBER, '10', null, null, null, null);
            if($options = get_records($optionstable, 'qid', $qnum, 'sortorder')) {
                $optnum = 1;
                foreach($options as $option) {

                    $status = $status &&
                        $table->addFieldInfo('q' . $qnum . '_' . $optnum,
                            XMLDB_TYPE_INTEGER, '10', null, null, null, null);
                    $optnum++;
                }
            } else {
                mtrace('Warning: no options found for question '.$qnum);
            }
            break;
        }

        return $status;
    }


} // end of rb_feedback_questions_preproc class

