<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}


/**
 * Save a notification message for displaying on the subsequent page view
 *
 * Optionally supply a url for redirecting to before displaying the message
 * and/or an options array.
 *
 * Currently the options array only supports a 'class' entry for passing as
 * the second parameter to notification()
 *
 * @param   string  $message    Message to display
 * @param   string  $redirect   Url to redirect to (optional)
 * @param   array   $options    Options array (optional)
 * @return  void
 */
function totara_set_notification($message, $redirect = null, $options = array()) {

    // Check options is an array
    if (!is_array($options)) {
        print_error('error:notificationsparamtypewrong', 'totara_core');
    }

    // Add message to options array
    $options['message'] = $message;

    // Add to notifications queue
    totara_queue_append('notifications', $options);

    // Redirect if requested
    if ($redirect !== null) {
        redirect($redirect);
        exit();
    }
}

/**
 * Return an array containing any notifications in $SESSION
 *
 * Should be called in the theme's header
 *
 * @return  array
 */
function totara_get_notifications() {
    return totara_queue_shift('notifications', true);
}


/**
 * Add an item to a totara session queue
 *
 * @param   string  $key    Queue key
 * @param   mixed   $data   Data to add to queue
 * @return  void
 */
function totara_queue_append($key, $data) {
    global $SESSION;

    if (!isset($SESSION->totara_queue)) {
        $SESSION->totara_queue = array();
    }

    if (!isset($SESSION->totara_queue[$key])) {
        $SESSION->totara_queue[$key] = array();
    }

    $SESSION->totara_queue[$key][] = $data;
}


/**
 * Return part or all of a totara session queue
 *
 * @param   string  $key    Queue key
 * @param   boolean $all    Flag to return entire session queue (optional)
 * @return  mixed
 */
function totara_queue_shift($key, $all = false) {
    global $SESSION;

    // Value to return if no items in queue
    $return = $all ? array() : null;

    // Check if an items in queue
    if (empty($SESSION->totara_queue) || empty($SESSION->totara_queue[$key])) {
        return $return;
    }

    // If returning all, grab all and reset queue
    if ($all) {
        $return = $SESSION->totara_queue[$key];
        $SESSION->totara_queue[$key] = array();
        return $return;
    }

    // Otherwise pop oldest item from queue
    return array_shift($SESSION->totara_queue[$key]);
}



/**
 *  Calls module renderer to return markup for displaying a progress bar for a user's course progress
 *
 * Optionally with a link to the user's profile if they have the correct permissions
 *
 * @access  public
 * @param   $userid     int
 * @param   $courseid   int
 * @param   $status     int     COMPLETION_STATUS_ constant
 * @return  string
 */
function totara_display_course_progress_icon($userid, $courseid, $status) {
    global $PAGE, $COMPLETION_STATUS;

    $renderer = $PAGE->get_renderer('totara_core');
    $content = $renderer->display_course_progress_icon($userid, $courseid, $status);
    return $content;
}

/**
*  Adds the current icon and icon select dropdown to a moodle form
*  replaces all the old totara/icon classes
*
* @access  public
* @param   object $mform reference to moodle form object
* @param   string $action form action - add, edit or view
* @param   string $type program, course or message icons
* @param   string $currenticon value currently stored in db
* @return  void
*/
function totara_add_icon_picker(&$mform, $action, $type, $currenticon='default', $nojs=0) {
    global $CFG, $OUTPUT;
    //get all icons of this type from core
    $replace = array('.png' => '', '_' => ' ', '-' => ' ');
    $iconhtml = $OUTPUT->pix_icon('/' . $type . 'icons/' . $currenticon,
                            ucwords(strtr($currenticon, $replace)),
                            'totara_core',
                            array('class' => "course_icon", 'id' => "icon_preview"));
    $mform->addElement('header', 'iconheader', get_string($type.'icon', 'totara_core'));
    if ($nojs == 1) {
        $mform->addElement('static', 'currenticon', get_string('currenticon', 'totara_core'), $iconhtml);
        if ($action=='add' || $action=='edit') {
            $path = $CFG->dirroot . '/totara/core/pix/' . $type . 'icons';
            foreach (scandir($path) as $icon) {
                if ($icon == '.' || $icon == '..') { continue;}
                $iconfile = str_replace('.png', '', $icon);
                $iconname = strtr($icon, $replace);
                $icons[$iconfile] = ucwords($iconname);
            }
            $mform->addElement('select', 'icon', get_string('icon', 'totara_core'), $icons);
            $mform->setDefault('icon', $currenticon);
        }
    } else {
        $buttonhtml = '';
        if ($action=='add' || $action=='edit') {
            $buttonhtml = html_writer::empty_tag('input', array('type' => 'button', 'value' => get_string('chooseicon', 'totara_program'), 'id' => 'show-icon-dialog'));
            $mform->addElement('hidden', 'icon');
        }
        $mform->addElement('static', 'currenticon', get_string('currenticon', 'totara_core'), $iconhtml . $buttonhtml);
    }
}
/**
* print out the Totara My Learning nav section
*/
function totara_print_my_learning_nav() {
    global $PAGE;

    $renderer = $PAGE->get_renderer('totara_core');
    $content = $renderer->print_my_learning_nav();
    return $content;
}

/**
* print out the Totara My Team nav section
*/
function totara_print_my_team_nav() {
    global $CFG, $USER, $PAGE;

    $managerroleid = $CFG->managerroleid;

    // return users with this user as manager
    $staff = totara_get_staff();
    $teammembers = ($staff) ? count($staff) : 0;

    //call renderer
    $renderer = $PAGE->get_renderer('totara_core');
    $content = $renderer->print_my_team_nav($teammembers);
    return $content;
}

/**
* print out the table of visible reports
*/
function totara_print_report_manager() {
    global $CFG, $USER, $PAGE, $reportbuilder_permittedreports;
    require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

    if (!isset($reportbuilder_permittedreports) || !is_array($reportbuilder_permittedreports)) {
        $reportbuilder_permittedreports = reportbuilder::get_permitted_reports();
    }

    $context = context_system::instance();
    $canedit = has_capability('totara/reportbuilder:managereports',$context);

    if (count($reportbuilder_permittedreports) > 0) {
        $renderer = $PAGE->get_renderer('totara_core');
        $returnstr = $renderer->print_report_manager($reportbuilder_permittedreports, $canedit);
    } else {
        $returnstr = get_string('nouserreports', 'totara_reportbuilder');
    }
    return $returnstr;
}

/**
* Returns markup for displaying saved scheduled reports
*
* Optionally without the options column and add/delete form
* Optionally with an additional sql WHERE clause
* @access  public
* @param   $showoptions   bool
* @param   $showaddform   bool
* @param   $sqlclause     array in the form array($where, $params)

*/
function totara_print_scheduled_reports($showoptions=true, $showaddform=true, $sqlclause=array()) {
    global $CFG, $DB, $USER, $PAGE, $REPORT_BUILDER_EXPORT_OPTIONS, $REPORT_BUILDER_SCHEDULE_OPTIONS;
    $REPORT_BUILDER_SCHEDULE_CODES = array_flip($REPORT_BUILDER_SCHEDULE_OPTIONS);

    require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');
    require_once($CFG->dirroot.'/calendar/lib.php');
    require_once($CFG->dirroot.'/totara/reportbuilder/scheduled_forms.php');


    $sql = "SELECT rbs.*, rb.fullname
            FROM {report_builder_schedule} rbs
            JOIN {report_builder} rb
            ON rbs.reportid=rb.id
            WHERE rbs.userid=?";

    $parameters = array($USER->id);

    if (!empty($sqlclause)) {
        list($conditions, $params) = $sqlclause;
        $parameters = array_merge($parameters, $params);
        $sql .= " AND " . $conditions;
    }
    //note from M2.0 these functions return an empty array, not false
    $scheduledreports = $DB->get_records_sql($sql, $parameters);
    //pre-process before sending to renderer
    foreach ($scheduledreports as $sched) {
        //data column
        if ($sched->savedsearchid != 0){
            $sched->data = $DB->get_field('report_builder_saved', 'name', array('id' => $sched->savedsearchid));
        }
        else {
            $sched->data = get_string('alldata', 'totara_reportbuilder');
        }
        //format column
        $key = array_search($sched->format, $REPORT_BUILDER_EXPORT_OPTIONS);
        $sched->format = get_string($key . 'format','totara_reportbuilder');
        //schedule column
        if (isset($sched->frequency) && isset($sched->schedule)){
            $schedule = reportbuilder_get_formatted_schedule($sched->frequency, $sched->schedule);
        } else {
            $schedule = get_string('schedulenotset', 'totara_reportbuilder');
        }
        $sched->schedule = $schedule;
    }

    if (count($scheduledreports) > 0) {
        $renderer = $PAGE->get_renderer('totara_core');
        echo $renderer->print_scheduled_reports($scheduledreports, $showoptions);
    } else {
        echo get_string('noscheduledreports', 'totara_reportbuilder') . html_writer::empty_tag('br') . html_writer::empty_tag('br');
    }

    if ($showaddform) {
        $mform = new scheduled_reports_add_form($CFG->wwwroot . '/totara/reportbuilder/scheduled.php', array());
        $mform->display();
    }
}

function totara_print_my_courses() {
    global $USER, $PAGE, $COMPLETION_STATUS;
    $content = '';
    $courses = completion_info::get_all_courses($USER->id, 10);
    $displaycourses = array();
    if ($courses) {
        foreach ($courses as $course) {
            $displaycourse = new stdClass();
            $displaycourse->course = $course->course;
            $displaycourse->name = format_string($course->name);
            $enrolled = $course->timeenrolled;
            $completed = $course->timecompleted;
            $starteddate = '';
            if ($course->timestarted != 0) {
                $starteddate = userdate($course->timestarted, get_string('strfdateshortmonth', 'langconfig'));
            }
            $displaycourse->starteddate = $starteddate;
            $displaycourse->enroldate = isset($enrolled) && $enrolled != 0 ? userdate($enrolled, get_string('strfdateshortmonth', 'langconfig')) : null;
            $displaycourse->completeddate = isset($completed) && $completed != 0 ? userdate($completed, get_string('strfdateshortmonth', 'langconfig')) : null;
            $displaycourse->status = $course->status ? $course->status : COMPLETION_STATUS_NOTYETSTARTED;
            $displaycourses[] = $displaycourse;
        }
    }
    $renderer = $PAGE->get_renderer('totara_core');
    echo $renderer->print_my_courses($displaycourses, $USER->id);
}


/**
 * Check if a user is a manager of another user
 *
 * @param int $userid       ID of user
 * @param int $managerid    ID of a potential manager to check (optional)
 * @param int $postype      Type of the position to check (POSITION_TYPE_* constant). Defaults to all positions (optional)
 * @return boolean true if user $userid is managed by user $managerid
 *
 * If managerid is not set, uses the current user
**/
function totara_is_manager($userid, $managerid=null, $postype=null) {
    global $DB, $USER;

    $userid = (int) $userid;

    if (!isset($managerid)) {
        // Use logged in user as default
        $managerid = $USER->id;
    }

    $params = array($userid, $managerid);
    if ($postype) {
        $postypewhere = "AND pa.type = ?";
        $params[] = $postype;
    } else {
        $postypewhere = '';
    }

    return $DB->record_exists_select('pos_assignment', "userid = ? AND managerid = ?" . $postypewhere, $params);
}

/**
 * Returns the staff of the specified user
 *
 * @param int $userid ID of a user to get the staff of
 * @param mixed $postype Type of the position to check (POSITION_TYPE_* constant). Defaults to primary position (optional)
 * @return array Array of userids of staff who are managed by user $userid , or false if none
 *
 * If $userid is not set, returns staff of current user
**/
function totara_get_staff($userid=null, $postype=null) {
    global $CFG, $DB, $USER;
    require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');
    $postype = ($postype === null) ? POSITION_TYPE_PRIMARY : (int) $postype;

    $userid = !empty($userid) ? (int) $userid : $USER->id;
    // this works because:
    // - old pos_assignment records are deleted when a user is deleted by {@link delete_user()}
    //   so no need to check if the record is for a real user
    // - there is a unique key on (type, userid) on pos_assignment so no need to use
    //   DISTINCT on the userid
    $staff = $DB->get_fieldset_select('pos_assignment', 'userid', "type = ? AND managerid = ?", array($postype, $userid));
    return (empty($staff)) ? false : $staff;
}

/**
 * Find out a user's manager.
 *
 * @param int $userid Id of the user whose manager we want
 * @param int $postype Type of the position we want the manager for (POSITION_TYPE_* constant). Defaults to primary position(optional)
 * @return mixed False if no manager. Manager user object from mdl_user if the user has a manager.
 */
function totara_get_manager($userid, $postype=null){
    global $CFG, $DB;
    require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');
    $postype = ($postype === null) ? POSITION_TYPE_PRIMARY : (int) $postype;

    $userid = (int) $userid;
    $sql = "
        SELECT manager.*
          FROM {pos_assignment} pa
    INNER JOIN {user} manager
            ON pa.managerid = manager.id
         WHERE pa.userid = ?
           AND pa.type = ?";

    //Return a manager if they have one otherwise false
    return $DB->get_record_sql($sql, array($userid, $postype));
}


/**
* returns unix timestamp from a date string depending on the date format
*
* @param string $format e.g. "d/m/Y" - see date_parse_from_format for supported formats
* @param string $date a date to be converted e.g. "12/06/12"
* @return int unix timestamp (0 if fails to parse)
*/
function totara_date_parse_from_format ($format, $date) {

    global $CFG;
    $tz = isset($CFG->timezone) ? $CFG->timezone : 99;
    $timezone = get_user_timezone_offset($tz);
    $dateArray = array();
    $dateArray = date_parse_from_format($format, $date);
    if (is_array($dateArray) && isset($dateArray['error_count']) &&
        $dateArray['error_count'] == 0) {
        if (abs($timezone) > 13) {
            $time = mktime($dateArray['hour'],
                    $dateArray['minute'],
                    $dateArray['second'],
                    $dateArray['month'],
                    $dateArray['day'],
                    $dateArray['year']);
        } else {
            $time = gmmktime($dateArray['hour'],
                    $dateArray['minute'],
                    $dateArray['second'],
                    $dateArray['month'],
                    $dateArray['day'],
                    $dateArray['year']);
            $time = usertime($time, $timezone);
        }
        return $time;
    } else {
        return 0;
    }
}

function get_totara_menu($header=true) {
    global $CFG, $USER;
    //$CFG and $USER are used by totara_menu.php
    include($CFG->dirroot.'/totara/core/totara_menu.php');
}


/**
 * Check if the HTTP request was of type POST
 *
 * This function is useful as sometimes the $_POST array can be empty
 * if it's size exceeded post_max_size
 *
 * @access  public
 * @return  boolean
 */
function totara_is_post_request() {
    return isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST';
}


/**
 * Download stored errorlog as a zip
 *
 * @access  public
 * @return  void
 */
function totara_errors_download() {
    global $DB;

    // Load errors from database
    $errors = $DB->get_records('errorlog');
    if (!$errors) {
        $errors = array();
    }

    // Format them nicely as strings
    $content = '';
    foreach ($errors as $error) {
        $error = (array) $error;
        foreach ($error as $key => $value) {
            $error[$key] = str_replace(array("\t", "\n"), ' ', $value);
        }

        $content .= implode("\t", $error);
        $content .= "\n";
    }

    send_temp_file($content, 'totara-error.log', true);
}


/**
 * Generate markup for search box
 *
 * Gives ability to specify courses, programs and/or categories in the results
 * as well as the ability to limit by category
 *
 * @access  public
 * @param   string  $value      Search value
 * @param   bool    $return     Return results (always true in M2.0, param left until all calls elsewhere cleaned up!)
 * @param   string  $type       Type of results ('all', 'course', 'program', 'category')
 * @param   int     $category   Parent category (0 means all, -1 means global search)
 * @return  string|void
 */
function print_totara_search($value = '', $return = true, $type = 'all', $category = -1) {

    global $CFG, $DB, $PAGE;
    $return = ($return) ? $return : true;

    static $count = 0;

    $count++;

    $id = 'totarasearch';

    if ($count > 1) {
        $id .= '_'.$count;
    }

    $action = "{$CFG->wwwroot}/course/search.php";

    // If searching in a category, indicate which category
    if ($category > 0) {
        // Get category name
        $categoryname = $DB->get_field('course_categories', 'name', array('id' => $category));
        if ($categoryname) {
            $strsearch = get_string('searchx', 'totara_core', $categoryname);
        } else {
            $strsearch = get_string('search');
        }
    } else {
        if ($type == 'course') {
            $strsearch = get_string('searchallcourses', 'totara_coursecatalog');
        } elseif ($type == 'program') {
            $strsearch = get_string('searchallprograms', 'totara_coursecatalog');
        } elseif ($type == 'category') {
            $strsearch = get_string('searchallcategories', 'totara_coursecatalog');
        } else {
            $strsearch = get_string('search');
            $type = '';
        }
    }

    $hiddenfields = array(
        'viewtype' => $type,
        'category' => $category,
    );
    $formid = 'searchtotara';
    $inputid = 'navsearchbox';
    $value = s($value, true);
    $strsearch = s($strsearch);

    $renderer = $PAGE->get_renderer('totara_core');
    $output = $renderer->print_totara_search($action, $hiddenfields, $strsearch, $value, $formid, $inputid);

    return $output;
}


/**
 * Displays a generic editing on/off button suitable for any page
 *
 * @param string $settingname Name of the $USER property used to determine if the button should display on or off
 * @param array $params Associative array of additional parameters to pass (optional)
 *
 * @return string HTML to display the button
 */
function totara_print_edit_button($settingname, $params = array()) {
    global $CFG, $USER, $OUTPUT;

    $currentstate = isset($USER->$settingname) ?
        $USER->$settingname : null;

    // Work out the appropriate action.
    if (empty($currentstate)) {
        $label = get_string('turneditingon');
        $edit = 'on';
    } else {
        $label = get_string('turneditingoff');
        $edit = 'off';
    }

    // Generate the button HTML.
    $params[$settingname] = $edit;
    return $OUTPUT->single_button(new moodle_url(qualified_me(), $params), $label, 'get');
}


/**
 * Return a language string in the local language for a given user
 *
 * @deprecated Use get_string() with 4th parameter instead
 *
 */
function get_string_in_user_lang($user, $identifier, $module='', $a=NULL, $extralocations=NULL) {
    debugging('get_string_in_user_lang() is deprecated. Use get_string() with 4th param instead');
    return get_string($identifier, $module, $a, $user->lang);
}

/**
 * Returns the SQL to be used in order to CAST one column to CHAR
 *
 * @param string fieldname the name of the field to be casted
 * @return string the piece of SQL code to be used in your statement.
 */
function sql_cast2char($fieldname) {

    global $DB;

    $sql = '';

    switch ($DB->get_dbfamily()) {
        case 'mysql':
            $sql = ' CAST(' . $fieldname . ' AS CHAR) ';
            break;
        case 'postgres':
            $sql = ' CAST(' . $fieldname . ' AS VARCHAR) ';
            break;
        case 'mssql':
            $sql = ' CAST(' . $fieldname . ' AS VARCHAR(20)) ';
            break;
        case 'oracle':
            $sql = ' TO_CHAR(' . $fieldname . ') ';
            break;
        default:
            $sql = ' ' . $fieldname . ' ';
    }

    return $sql;
}


/**
 * Returns the SQL to be used in order to CAST one column to FLOAT
 *
 * @param string fieldname the name of the field to be casted
 * @return string the piece of SQL code to be used in your statement.
 */
function sql_cast2float($fieldname) {
    global $DB;

    $sql = '';

    switch ($DB->get_dbfamily()) {
        case 'mysql':
            $sql = ' CAST(' . $fieldname . ' AS DECIMAL(20,2)) ';
            break;
        case 'mssql':
        case 'postgres':
            $sql = ' CAST(' . $fieldname . ' AS FLOAT) ';
            break;
        case 'oracle':
            $sql = ' TO_BINARY_FLOAT(' . $fieldname . ') ';
            break;
        default:
            $sql = ' ' . $fieldname . ' ';
    }

    return $sql;
}


/**
 * Assign a user a position assignment and create/delete role assignments as required
 *
 * @param $assignment position_assignment object, include old reportstoid field (if any) and
 *                    new managerid
 * @param $unittest set to true if using for unit tests (optional)
 */
function assign_user_position($assignment, $unittest=false) {
    global $CFG, $DB;

        $transaction = $DB->start_delegated_transaction();

        // Get old user id
        $old_managerid = null;
        if ($assignment->reportstoid) {
            $old_managerid = $DB->get_field('role_assignments', 'userid', array('id' => $assignment->reportstoid));
        } else {
            $old_managerid = null;
        }
        $managerchanged = false;
        if ($old_managerid != $assignment->managerid) {
            $managerchanged = true;
        }
        // TODO SCANMSG: Need to figure out how to re-add start time and end time into manager role assignment
        //          now that the role_assignment record no longer has start/end fields. See:
        //          http://docs.moodle.org/dev/New_enrolments_in_2.0
        //          and mdl_enrol and mdl_user_enrolments

        // skip this bit during testing as we don't have all the required tables for role assignments
        if (!$unittest) {
            // Get context
            $context = context_user::instance($assignment->userid);
            // Get manager role id
            $roleid = $CFG->managerroleid;
            // Delete role assignment if there was a manager but it changed
            if ($old_managerid && $managerchanged) {
                role_unassign($roleid, $assignment->userid, $context->id);
            }
            // Create new role assignment if there is now and a manager but it changed
            if ($assignment->managerid && $managerchanged) {
                // Assign manager to user
                $raid = role_assign(
                    $roleid,
                    $assignment->managerid,
                    $context->id
                );
                // update reportstoid
                $assignment->reportstoid = $raid;
            }
        }
        // Store the date of this assignment
        require_once($CFG->dirroot.'/totara/program/lib.php');
        prog_store_position_assignment($assignment);
        // Save assignment
        $assignment->save($managerchanged);
        $transaction->allow_commit();

}

/**
* Loops through the navigation options and returns an array of classes
*
* The array contains the navigation option name as a key, and a string
* to be inserted into a class as the value. The string is either
* ' selected' if the option is currently selected, or an empty string ('')
*
* @param array $navstructure A nested array containing the structure of the menu
* @param string $primary_selected The name of the primary option
* @param string $secondary_selected The name of the secondary option
*
* @return array Array of strings, keyed on option names
*/
function totara_get_nav_select_classes($navstructure, $primary_selected, $secondary_selected) {

    $selectedstr = ' selected';
    $selected = array();
    foreach($navstructure as $primary => $secondaries) {
        if($primary_selected == $primary) {
            $selected[$primary] = $selectedstr;
        } else {
            $selected[$primary] = '';
        }
        foreach($secondaries as $secondary) {
            if($secondary_selected == $secondary) {
                $selected[$secondary] = $selectedstr;
            } else {
                $selected[$secondary] = '';
            }
        }
    }
    return $selected;
}


/**
 * Builds Totara menu, returns an array of objects that
 * represent the stucture of the menu
 *
 * The parents must be defined before the children so we
 * can correctly figure out which items should be selected
 *
 * @return Array of menu item objects
 */
function totara_build_menu() {
    global $USER, $SESSION, $CFG, $reportbuilder_permittedreports;

    if (isset($SESSION->viewtype) && $SESSION->viewtype == 'program') {
        $findcourse_type = 'program';
    } else {
        $findcourse_type = 'course';
    }

    require_once($CFG->dirroot . '/totara/plan/lib.php');
    $canviewlearningplans = dp_can_view_users_plans($USER->id);
    $requiredlearninglink = prog_get_tab_link($USER->id);

    require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');
    if (!isset($reportbuilder_permittedreports) || !is_array($reportbuilder_permittedreports)) {
        $reportbuilder_permittedreports = reportbuilder::get_permitted_reports();
    }
    $hasreports = (is_array($reportbuilder_permittedreports) && (count($reportbuilder_permittedreports) > 0));

    $tree = array();

    $tree[] = (object)array(
        'name' => 'home',
        'linktext' => get_string('home'),
        'parent' => null,
        'url' => '/index.php'
    );

    $tree[] = (object)array(
        'name' => 'mylearning',
        'linktext' => get_string('mylearning', 'totara_core'),
        'parent' => null,
        'url' => '/my/'
    );

    if ($canviewlearningplans) {
        $tree[] = (object)array(
            'name' => 'learningplans',
            'linktext' => get_string('learningplans', 'totara_core'),
            'parent' => 'mylearning',
            'url' => '/totara/plan/index.php'
        );
    }

    $tree[] = (object)array(
        'name' => 'mybookings',
        'linktext' => get_string('mybookings', 'totara_core'),
        'parent' => 'mylearning',
        'url' => '/my/bookings.php'
    );

    $tree[] = (object)array(
        'name' => 'recordoflearning',
        'linktext' => get_string('recordoflearning', 'totara_core'),
        'parent' => 'mylearning',
        'url' => '/totara/plan/record/courses.php'
    );

    if ($requiredlearninglink) {
        $tree[] = (object)array(
            'name' => 'requiredlearning',
            'linktext' => get_string('requiredlearning', 'totara_program'),
            'parent' => 'mylearning',
            'url' => $requiredlearninglink
        );
    }

    if ($staff = totara_get_staff()) {

        $tree[] = (object)array(
            'name' => 'myteam',
            'linktext' => get_string('myteam', 'totara_core'),
            'parent' => null,
            'url' => '/my/teammembers.php'
        );

    }

    if ($hasreports) {
        $tree[] = (object)array(
            'name' => 'myreports',
            'linktext' => get_string('myreports', 'totara_core'),
            'parent' => null,
            'url' => '/my/reports.php'
        );
    }

    $tree[] = (object)array(
        'name' => 'findcourses',
        'linktext' => get_string('findcourses', 'totara_core'),
        'parent' => null,
        'url' => '/course/categorylist.php?viewtype=' . $findcourse_type
    );

    $tree[] = (object)array(
        'name' => 'course',
        'linktext' => get_string('courses'),
        'parent' => 'findcourses',
        'url' => '/course/categorylist.php?viewtype=course'
    );

    $tree[] = (object)array(
        'name' => 'program',
        'linktext' => get_string('programs', 'totara_program'),
        'parent' => 'findcourses',
        'url' => '/course/categorylist.php?viewtype=program'
    );

    $tree[] = (object)array(
        'name' => 'calendar',
        'linktext' => get_string('calendar', 'totara_core'),
        'parent' => null,
        'url' => '/calendar/view.php'
    );

    return $tree;
}

/**
 * Install the Totara MyMoodle blocks
 *
 * @return bool
 */
function totara_reset_mymoodle_blocks() {
    global $DB, $SITE;

    // get the id of the default mymoodle page
    $mypageid = $DB->get_field_sql('SELECT id FROM {my_pages} WHERE userid IS null AND private = 1');

    // build new block array
    $blocks = array(
        (object)array(
            'blockname'=> 'totara_tasks',
            'parentcontextid' => $SITE->id,
            'showinsubcontexts' => 0,
            'pagetypepattern' => 'my-index',
            'subpagepattern' => $mypageid,
            'defaultweight' => 1,
            'configdata' => '',
            'defaultregion' => 'content'
        ),
        (object)array(
            'blockname'=> 'totara_alerts',
            'parentcontextid' => $SITE->id,
            'showinsubcontexts' => 0,
            'pagetypepattern' => 'my-index',
            'subpagepattern' => $mypageid,
            'defaultweight' => 1,
            'configdata' => '',
            'defaultregion' => 'content',
        ),
        (object)array(
            'blockname'=> 'totara_stats',
            'parentcontextid' => $SITE->id,
            'showinsubcontexts' => 0,
            'pagetypepattern' => 'my-index',
            'subpagepattern' => $mypageid,
            'defaultweight' => 1,
            'configdata' => '',
            'defaultregion' => 'side-post',
        )
    );

    // insert blocks
    foreach ($blocks as $b) {
        $DB->insert_record('block_instances', $b);
    }

    //A separate set up for a quicklinks block as it needs additional data to be added on install
    $blockinstance = new stdClass();
    $blockinstance->blockname = 'totara_quicklinks';
    $blockinstance->parentcontextid = SITEID;
    $blockinstance->showinsubcontexts = 0;
    $blockinstance->pagetypepattern = 'my-index';
    $blockinstance->subpagepattern = $mypageid;
    $blockinstance->defaultregion = 'side-post';
    $blockinstance->defaultweight = 1;
    $blockinstance->configdata = '';
    $blockinstance->id = $DB->insert_record('block_instances', $blockinstance);

    // Ensure the block context is created.
    context_block::instance($blockinstance->id);

    // If the new instance was created, allow it to do additional setup
    if ($block = block_instance('totara_quicklinks', $blockinstance)) {
        $block->instance_create();
    }

    return 1;
}


/**
 * Color functions used by totara themes for auto-generating colors
 */

/**
 * Given a hex color code lighten or darken the color by the specified
 * percentage and return the hex code of the new color
 *
 * @param string $color Hex color code in format '#abc' or '#aabbcc'
 * @param integer $percent Number between -100 and 100, negative to darken
 * @return string 6 digit hex color code for resulting color
 */
function totara_brightness($color, $percent) {
    // convert 3 digit color codes into 6 digit form
    $pattern = '/^#([[:xdigit:]])([[:xdigit:]])([[:xdigit:]])$/';
    $color = preg_replace($pattern, '#$1$1$2$2$3$3', $color );

    // don't change if color format not recognised
    $pattern = '/^#([[:xdigit:]]{2})([[:xdigit:]]{2})([[:xdigit:]]{2})$/';
    if (!preg_match($pattern, $color, $matches)) {
        debugging("Bad hex color '{$color}' passed to totara_brightness().");
        return $color;
    }
    $red = hexdec($matches[1]);
    $green = hexdec($matches[2]);
    $blue = hexdec($matches[3]);

    if ($percent >= 0) {
        $red = floor($red + (255 - $red) * $percent / 100);
        $green = floor($green + (255 - $green) * $percent / 100);
        $blue = floor($blue + (255 - $blue) * $percent / 100);
    } else {
        // remember $percent is negative
        $red = floor($red + $red * $percent / 100);
        $green = floor($green + $green * $percent / 100);
        $blue = floor($blue + $blue * $percent / 100);
    }

    return '#' .
        str_pad(dechex($red), 2, '0', STR_PAD_LEFT) .
        str_pad(dechex($green), 2, '0', STR_PAD_LEFT) .
        str_pad(dechex($blue), 2, '0', STR_PAD_LEFT);
}


/**
 * Given a hex color code lighten or darken the color by the specified
 * number of hex points and return the hex code of the new color
 *
 * This differs from {@link totara_brightness} in that the scaling is
 * linear (until pure white or black is reached). *
 *
 * @param string $color Hex color code in format '#abc' or '#aabbcc'
 * @param integer $amount Number between -255 and 255, negative to darken
 * @return string 6 digit hex color code for resulting color
 */
function totara_brightness_linear($color, $amount) {
    // convert 3 digit color codes into 6 digit form
    $pattern = '/^#([[:xdigit:]])([[:xdigit:]])([[:xdigit:]])$/';
    $color = preg_replace($pattern, '#$1$1$2$2$3$3', $color );

    // don't change if color format not recognised
    $pattern = '/^#([[:xdigit:]]{2})([[:xdigit:]]{2})([[:xdigit:]]{2})$/';
    if (!preg_match($pattern, $color, $matches)) {
        debugging("Bad hex color '{$color}' passed to totara_brightness_linear().");
        return $color;
    }
    $red = hexdec($matches[1]);
    $green = hexdec($matches[2]);
    $blue = hexdec($matches[3]);

    // max and min ensure colour remains within range
    $red = max(min($red + $amount, 255), 0);
    $green = max(min($green + $amount, 255), 0);
    $blue = max(min($blue + $amount, 255), 0);

    return '#' .
        str_pad(dechex($red), 2, '0', STR_PAD_LEFT) .
        str_pad(dechex($green), 2, '0', STR_PAD_LEFT) .
        str_pad(dechex($blue), 2, '0', STR_PAD_LEFT);
}

/**
 * Given a hex color code return the hex code for either white or black,
 * depending on which color will have the most contrast compared to $color
 *
 * @param string $color Hex color code in format '#abc' or '#aabbcc'
 * @return string 6 digit hex color code for resulting color
 */
function totara_readable_text($color) {
    // convert 3 digit color codes into 6 digit form
    $pattern = '/^#([[:xdigit:]])([[:xdigit:]])([[:xdigit:]])$/';
    $color = preg_replace($pattern, '#$1$1$2$2$3$3', $color );

    // don't change if color format not recognised
    $pattern = '/^#([[:xdigit:]]{2})([[:xdigit:]]{2})([[:xdigit:]]{2})$/';
    if (!preg_match($pattern, $color, $matches)) {
        debugging("Bad hex color '{$color}' passed to totara_readable_text().");
        return $color;
    }
    $red = hexdec($matches[1]);
    $green = hexdec($matches[2]);
    $blue = hexdec($matches[3]);

    // get average intensity
    $avg = array_sum(array($red, $green, $blue)) / 3;
    return ($avg >= 153) ? '#000000' : '#FFFFFF';
}

/**
 * Given a hex color code return the rgba shadow that will work best on text
 * that is the readable-text color
 *
 * This is useful for adding shadows to text that uses the readable-text color.
 *
 * @param string $color Hex color code in format '#abc' or '#aabbcc'
 * @return string rgba() colour to provide an appropriate shadow for readable-text
 */
function totara_readable_text_shadow($color) {
    if (totara_readable_text($color) == '#FFFFFF') {
        return 'rgba(0, 0, 0, 0.75)';
    } else {
        return 'rgba(255, 255, 255, 0.75)';
    }
}
/**
 * Given a hex color code return the hex code for a desaturated version of
 * $color, which has the same brightness but is greyscale
 *
 * @param string $color Hex color code in format '#abc' or '#aabbcc'
 * @return string 6 digit hex color code for resulting greyscale color
 */
function totara_desaturate($color) {
    // convert 3 digit color codes into 6 digit form
    $pattern = '/^#([[:xdigit:]])([[:xdigit:]])([[:xdigit:]])$/';
    $color = preg_replace($pattern, '#$1$1$2$2$3$3', $color );

    // don't change if color format not recognised
    $pattern = '/^#([[:xdigit:]]{2})([[:xdigit:]]{2})([[:xdigit:]]{2})$/';
    if (!preg_match($pattern, $color, $matches)) {
        debugging("Bad hex color '{$color}' passed to desaturate().");
        return $color;
    }
    $red = hexdec($matches[1]);
    $green = hexdec($matches[2]);
    $blue = hexdec($matches[3]);

    // get average intensity
    $avg = array_sum(array($red, $green, $blue)) / 3;

    return '#' . str_repeat(str_pad(dechex($avg), 2, '0', STR_PAD_LEFT), 3);
}

/**
 * Given an array of the form:
 * array(
 *   // setting name => default value
 *   'linkcolor' => '#dddddd',
 * );
 * perform substitutions on the css provided
 *
 * @param string $css CSS to substitute settings variables
 * @param object $theme Theme object
 * @param array $substitutions Array of settingname/defaultcolor pairs
 * @return string CSS with replacements
 */
function totara_theme_generate_autocolors($css, $theme, $substitutions) {

    // each element added here will generate a new color
    // with the key appended to the existing setting name
    // and with the color passed through the function with the arguments
    // supplied via an array:
    $autosettings = array(
        'lighter' => array('brightness_linear', 15),
        'darker' => array('brightness_linear', -15),
        'light' => array('brightness_linear', 25),
        'dark' => array('brightness_linear', -25),
        'lighter-perc' => array('brightness', 15),
        'darker-perc' => array('brightness', -15),
        'light-perc' => array('brightness', 25),
        'dark-perc' => array('brightness', -25),
        'readable-text' => array('readable_text'),
        'readable-text-shadow' => array('readable_text_shadow'),
    );

    $find = array();
    $replace = array();
    foreach ($substitutions as $setting => $defaultcolor) {
        $value = isset($theme->settings->$setting) ? $theme->settings->$setting : $defaultcolor;
        $find[] = "[[setting:{$setting}]]";
        $replace[] = $value;

        foreach ($autosettings as $suffix => $modification) {
            if (!is_array($modification) || count($modification) < 1) {
                continue;
            }
            $function_name = 'totara_' . array_shift($modification);
            $function_args = $modification;
            array_unshift($function_args, $value);

            $find[] = "[[setting:{$setting}-$suffix]]";
            $replace[] = call_user_func_array($function_name, $function_args);
        }
    }
    return str_replace($find, $replace, $css);
}
