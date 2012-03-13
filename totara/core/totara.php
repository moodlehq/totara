<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * Currently the options array only supports a 'style' entry for passing as
 * the second parameter to notify()
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
 * resets the customised front page blocks.  designed to be called from local_postinst
 *
 * @return bool
 */
function totara_reset_frontpage_blocks() {
    global $DB, $SITE;

    // first delete pre-set ones
    $DB->execute('DELETE FROM {block_instances}
        WHERE parentcontextid = ' . $SITE->id . "
        AND pagetypepattern = 'course-view-*'");

    // build new block array
    $blocks = array(
        (object)array(
            'blockname'=> 'admin_tree',
            'parentcontextid' => $SITE->id,
            'showinsubcontexts' => 0,
            'pagetypepattern' => 'course-view-*',
            'subpagepattern' => '',
            'defaultweight' => 1,
            'configdata' => '',
            'default-region' => 'side-post'
        ),
        (object)array(
            'blockname'=> 'messages',
            'parentcontextid' => $SITE->id,
            'showinsubcontexts' => 0,
            'pagetypepattern' => 'course-view-*',
            'subpagepattern' => '',
            'defaultweight' => 1,
            'configdata' => '',
            'default-region' => 'side-pre'
        ),
        (object)array(
            'blockname'=> 'calendar_month',
            'parentcontextid' => $SITE->id,
            'showinsubcontexts' => 0,
            'pagetypepattern' => 'course-view-*',
            'subpagepattern' => '',
            'defaultweight' => 1,
            'configdata' => '',
            'default-region' => 'side-post',
        )
    );

    // insert blocks
    foreach ($blocks as $b) {
        $DB->insert_record('block_instances', $b);
    }

    return 1;

}


/**
 *  Calls mopdule renderer to return markup for displaying a progress bar for a user's course progress
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
 * adds guides block on the site admin pages.  designed to be called from local_postinst
 *
 * @return bool
 */
function totara_add_guide_block_to_adminpages() {
    global $DB, $SITE;

        $b = (object)array(
            'blockname'=> 'guides',
            'parentcontextid' => $SITE->id,
            'showinsubcontexts' => 0,
            'pagetypepattern' => 'admin-*',
            'subpagepattern' => '',
            'defaultweight' => 1,
            'configdata' => '',
            'default-region' => 'side-pre'
        );
    $DB->insert_record('block_instances', $b);

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
    $teammembers = count(totara_get_staff());
    //call renderer
    $renderer = $PAGE->get_renderer('totara_core');
    $content = $renderer->print_my_team_nav($teammembers);
    return $content;

}
/**
* print out the table of visible reports
*/
function totara_print_report_manager() {
    global $CFG, $USER, $DB, $PAGE;
    require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');
    $reports = $DB->get_records('report_builder', null, 'fullname');
    if (!is_array($reports)){
        $reports = array();
    }
    $context = context_system::instance();
    $showsettings = (has_capability('totara/reportbuilder:managereports',$context) && isset($USER->editing) && $USER->editing) ? true : false;
    //pre-process to avoid any data logic in renderer
    $viewablereports = array();

    foreach ($reports as $report) {
        if (reportbuilder::is_capable($report->id) && !$report->hidden) {
            $report->viewurl = reportbuilder_get_report_url($report);
            $viewablereports[] = $report;
        }
    }

    if (count($viewablereports) > 0) {
        $renderer = $PAGE->get_renderer('totara_core');
        $returnstr = $renderer->print_report_manager($viewablereports, $showsettings);
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
    global $CFG, $DB, $USER, $PAGE, $REPORT_BUILDER_EXPORT_OPTIONS, $REPORT_BUILDER_SCHEDULE_OPTIONS, $CALENDARDAYS;
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
    $dateformat = ($USER->lang == 'en') ? 'jS' : 'j';
    //pre-process before sending to renderer
    foreach ($scheduledreports as $sched) {
        //data column
        if($sched->savedsearchid!=0){
            $sched->data = $DB->get_field('report_builder_saved', 'name', array('id' => $sched->savedsearchid));
        }
        else {
            $sched->$data = get_string('alldata', 'totara_reportbuilder');
        }
        //format column
        $key = array_search($sched->format, $REPORT_BUILDER_EXPORT_OPTIONS);
        $sched->format = get_string($key . 'format','local_reportbuilder');
        //schedule column
        if(isset($sched->frequency) && isset($sched->schedule)){
            $schedule = '';
            switch($REPORT_BUILDER_SCHEDULE_CODES[$sched->frequency]){
                case 'daily':
                    $schedule .= get_string('daily', 'totara_reportbuilder') . ' ' .  get_string('at', 'totara_reportbuilder') . ' ';
                    $schedule .= strftime('%l:%M%P' ,mktime($sched->schedule,0,0));
                    break;
                case 'weekly':
                    $schedule .= get_string('weekly', 'totara_reportbuilder') . ' ' . get_string('on', 'totara_reportbuilder') . ' ';
                    $schedule .= get_string($CALENDARDAYS[$sched->schedule], 'calendar');
                    break;
                case 'monthly':
                    $schedule .= get_string('monthly', 'totara_reportbuilder') . ' ' . get_string('onthe', 'totara_reportbuilder') . ' ';
                    $schedule .= date($dateformat ,mktime(0,0,0,0,$sched->schedule));
                    break;
            }
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
            $displaycourse->id = $course->course;
            $displaycourse->$name = format_string($course->name);
            $enrolled = $course->timeenrolled;
            $completed = $course->timecompleted;
            $starteddate = '';
            if ($course->timestarted != 0) {
                $starteddate = userdate($course->timestarted, '%d %b %y');
            }
            $displaycourse->starteddate = $starteddate;
            $displaycourse->enroldate = isset($enrolled) && $enrolled != 0 ? userdate($enrolled, '%d %b %y') : null;
            $displaycourse->completeddate = isset($completed) && $completed != 0 ? userdate($completed, '%d %b %y') : null;
            $displaycourse->status = array_key_exists($id, $courses) ? $courses[$id]->status : COMPLETION_STATUS_NOTYETSTARTED;
            $displaycourses[] = $displaycourse;
        }
    }
    $renderer = $PAGE->get_renderer('totara_core');
    echo $renderer->print_my_courses($displaycourses, $USER->id);
}

/**
* helper function to return a user's data stored in a given profile field
*
* @param int $userid id of the user whose user profile field value will be returned
* @param string $fieldshortname the shortname of the field to be returned
*
* @return string the field value
*/
function totara_print_user_profile_field($userid=null, $fieldshortname=null) {
    global $CFG, $DB;
    $sql = "SELECT uid.data
            FROM {user_info_data} uid
            JOIN {user_info_field} uif
              ON uif.id=uid.fieldid
            WHERE uif.shortname = ?
            AND uid.userid = ?
            ";
    return $DB->get_field_sql($sql, array($fieldshortname, $userid));
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
    global $CFG, $DB, $USER;

    $userid = (int) $userid;

    if (!isset($managerid)) {
        // Use logged in user as default
        $managerid = $USER->id;
    }

    require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');

    $params = array($managerid, $userid);
    if ($postype) {
        $postypewhere = "AND pa.type = ?";
        $params[] = $postype;
    } else {
        $postypewhere = '';
    }

    $sql = "SELECT DISTINCT u.id
        FROM
            {pos_assignment} pa
            INNER JOIN {role_assignments} ra ON pa.reportstoid = ra.id
            INNER JOIN {user} u ON ra.userid = u.id
        WHERE
            ra.userid = ?
            AND pa.userid = ?
            AND u.deleted = 0
            {$postypewhere}";

    return $DB->record_exists_sql($sql, $params);
}

/**
 * Returns the staff of the specified user
 *
 * @param int $userid ID of a user to get the staff of
 * @param mixed $postype Type of the position to check (POSITION_TYPE_* constant). Defaults to primary position(optional)
 * @return array Array of userids of staff who are managed by user $userid, or false if none (optional)
 *
 * If $userid is not set, returns staff of current user
**/
function totara_get_staff($userid=null, $postype=null) {
    global $CFG, $DB, $USER;
    require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');
    $postype = ($postype === null) ? POSITION_TYPE_PRIMARY : (int) $postype;

    $userid = !empty($userid) ? (int) $userid : $USER->id;
    $sql = "SELECT DISTINCT u.id
        FROM
            {pos_assignment} pa
            INNER JOIN {user} u ON pa.userid = u.id
            INNER JOIN {role_assignments} ra ON pa.reportstoid = ra.id
        WHERE
            ra.userid = ?
            AND u.deleted = 0
            AND pa.type = ?";

    if (!$res = $DB->get_records_sql($sql, array($userid, $postype))) {
        // no matches
        return false;
    }

    return array_keys($res);
}

/**
 * Find out a user's manager.
 *
 * @param int $userid Id of users whose manager we want
 * @param int $postype Type of the position we want the manager for (POSITION_TYPE_* constant). Defaults to primary position(optional)
 * @return mixed False if no manager. Manager user object from mdl_user if the user has a manager.
 */
function totara_get_manager($userid, $postype=null){
    global $CFG, $DB;
    require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');
    $postype = ($postype === null) ? POSITION_TYPE_PRIMARY : (int) $postype;

    $userid = (int) $userid;
    $sql = "
        SELECT
            u.*
        FROM
            {pos_assignment} pa
        INNER JOIN
            {role_assignments} ra
         ON pa.reportstoid = ra.id
        INNER JOIN
            {user} u
         ON ra.userid = u.id
        WHERE
            pa.userid = ?
            AND pa.type = ?
            AND u.deleted = 0";

    //Return a manager if they have one otherwise false
    return $DB->get_record_sql($sql, array($userid, $postype));
}

/**
* hacked page lib that gets used on any page that doesn't have one.
* really just exists to fulfil requirements and allow stickyblocks
*/
class totara_page_class_hack extends page_base {
    function get_type() {
        return 'Totara';
    }

    function user_is_editing() {
        if (defined('ADMIN_STICKYBLOCKS')) {
            return true;
        }
        return false;
    }

    function blocks_default_position() {
        return BLOCK_POS_LEFT; // avoid getting the admin block
    }

    function blocks_get_positions() {
        return array(BLOCK_POS_LEFT, BLOCK_POS_RIGHT);
    }

    function blocks_move_position(&$instance, $move) {
        if($instance->position == BLOCK_POS_LEFT && $move == BLOCK_MOVE_RIGHT) {
            return BLOCK_POS_RIGHT;
        } else if ($instance->position == BLOCK_POS_RIGHT && $move == BLOCK_MOVE_LEFT) {
            return BLOCK_POS_LEFT;
        }
        return $instance->position;
    }

    function get_id() {
        return 0;
    }

    function user_allowed_editing() {
        return $this->user_is_editing();
    }
    function url_get_path() {
        global $CFG;
        if (defined('ADMIN_STICKYBLOCKS')) {
            return $CFG->wwwroot . '/admin/stickyblocks.php';
        }
        return '';
    }

    function url_get_parameters() {
        if (defined('ADMIN_STICKYBLOCKS')) {
            return array('pt' => 'Totara');
        }
    }

    function print_header($title, $morenavlinks=NULL) {
        global $OUTPUT, $PAGE;
        $nav = build_navigation($morenavlinks);
        $PAGE->set_title($title);
        $PAGE->set_heading($title);
        echo $OUTPUT->header();
    }
}
page_map_class('Totara', 'totara_page_class_hack');


/**
* dashboard page lib
*/
class totara_dashboard_page_class extends page_base {
    private $dashb_instance;

    function init_full() {
        global $DB;

        if ($this->full_init_done) {
            return;
        }

        // Get the dashboard details
        $sql = "SELECT di.*, d.shortname, d.title
                FROM {dashb} d
                INNER JOIN {dashb_instance} di ON d.id = di.dashb_id
                WHERE di.id = ?";
        if (!$this->dashb_instance = $DB->get_record_sql($sql, array($this->id))) {
            print_error('error:dashboardnotfound', 'totara_core');
        }
        $this->full_init_done = true;
    }

    function get_type() {
        return 'totara-dashboard';
    }

    function blocks_get_positions() {
        return array(BLOCK_POS_LEFT, BLOCK_POS_RIGHT, BLOCK_POS_CENTER);
    }

    function blocks_default_position() {
        return BLOCK_POS_LEFT; // avoid getting the admin block
    }

    function url_get_parameters() {
        $this->init_full();

        return array('item'=>$this->dashb_instance->shortname);
    }

    function url_get_path() {
        return strip_querystring(me());
    }

    function user_allowed_editing() {
        return true;
    }

    function user_is_editing() {
        global $USER;

        $this->init_full();
        return !empty($USER->{$this->dashb_instance->shortname.'dashbediting'});
    }

    function print_header($title, $morenavlinks=NULL) {
        global $PAGE, $OUTPUT;
        $nav = build_navigation($morenavlinks);
        $PAGE->set_title($title);
        $PAGE->set_heading($title);
        echo $OUTPUT->header();
    }

}
page_map_class('totara-dashboard', 'totara_dashboard_page_class');


/**
* local footer hook. nothing yet but this could print right blocks
*/
function totara_local_footer_hook() {
    if (!defined('Totara')) {
        return;
    }
    echo '</td></tr></table>';
}

/**
 * resets the customised sticky blocks settings.  designed to be called from /totara/core/db/upgrade.php
 *
 * @param bool   $remove   dictates whether to remove existing sticky blocks
 * @param string $path     path to the stickyblocks definition file
 *
 * @return bool
 */
function totara_reset_stickyblocks($remove=false, $path='totara/core') {
    global $CFG, $DB;

    if ($remove) {
        // remove existing.  we only remove from the custom pagetypes format_learning and my-collaboration
        $DB->delete_records('block_pinned', array('pagetype' => 'format_learning'));
    }

    // get the sticky block object
    $filepath = $CFG->dirroot .  '/' . $path . '/stickyblocks.php';
    if (!file_exists($filepath)) {
        debugging("Local caps reassignment called with invalid path $path");
        return false;
    }
    require_once($filepath);
    $blocks = get_custom_stickyblocks();
    if (!isset($blocks)) {
        return true; // nothing to do.
    }

    foreach($blocks as $block) {

        // check for existing record
        $id = $DB->get_field('block_pinned', 'id', array('blockid' => $block->blockid, 'pagetype' => $block->pagetype));

        if (empty($id)) {
            // if not there then insert a new record
            $DB->insert_record('block_pinned', $block);
        } else {
            // if there then just update the relevant settings
            $block->id = $id;
            $DB->update_record('block_pinned', $block);
        }
    }

    return true;

}


/**
 * Determines whether the block instance is a dashlet, on a dashboard page
 * @return boolean
 **/
function instance_is_dashlet($dashlet) {
    return ($dashlet->instance->pagetype == 'totara-dashboard' && $dashlet->instance->position == 'c');
}


/**
 * returns role of user in dashlet page
 *
 * @param int $pageid
 * @return string rolename
 */
function get_dashlet_role($pageid) {
    global $DB;
    // get Role of user in this page.
    $sql = "SELECT r.shortname
            FROM {dashb} d
            INNER JOIN {dashb_instance} di ON d.id = di.dashb_id
            INNER JOIN {role} r on d.roleid = r.id
            WHERE di.id = ?";       // The pageid is the dashb instance id
    $role = $DB->get_field_sql($sql, array($pageid));
    return $role;
}

// date_parse_from_format implementation for PHP<5.3 written by Joe Brewster
// http://www.brewsterware.com/strptime-for-windows.html
// platform-independent implementation for parsing date inputs in the user's locale format
// to get around strptime (not available on PHP for Windows) and date_parse_from_format (only available on PHP 5.3>)
// NB: should not be called directly - used internally by totara_date_parse_from_format

if (!function_exists('date_parse_from_format')) {
    function date_parse_from_format($format, $date) {
        $returnArray = array('hour' => 0, 'minute' => 0, 'second' => 0,
                            'month' => 0, 'day' => 0, 'year' => 0);
        $dateArray = array();
        // array of valid date codes with keys for the return array as the values
        $validDateTimeCode = array('Y' => 'year', 'y' => 'year',
                                    'm' => 'month', 'n' => 'month',
                                    'd' => 'day', 'j' => 'day',
                                    'H' => 'hour', 'G' => 'hour',
                                    'i' => 'minute', 's' => 'second');
        /* create an array of valid keys for the return array
         * in the order that they appear in $format
        */
        for ($i = 0 ; $i <= strlen($format) - 1 ; $i++) {
            $char = substr($format, $i, 1);
            if (array_key_exists($char, $validDateTimeCode)) {
                $dateArray[$validDateTimeCode[$char]] = '';
            }
        }
        // create array of reg ex things for each date part
        $regExArray = array('.' => '\.', // escape the period
        // parse d first so we dont mangle the reg ex
        // day
                            'd' => '(\d{2})',
        // year
                            'Y' => '(\d{4})',
                            'y' => '(\d{2})',
        // month
                            'm' => '(\d{2})',
                            'n' => '(\d{1,2})',
        // day
                            'j' => '(\d{1,2})',
        // hour
                            'H' => '(\d{2})',
                            'G' => '(\d{1,2})',
        // minutes
                            'i' => '(\d{2})',
        // seconds
                            's' => '(\d{2})');
        // create a full reg ex string to parse the date with
        $regEx = str_replace(array_keys($regExArray),
        array_values($regExArray),
        $format);
        // Parse the date
        preg_match("#$regEx#", $date, $matches);
        // some checks...
        if (!is_array($matches) || $matches[0] != $date || sizeof($dateArray) != (sizeof($matches) - 1)) {
            return $returnArray;
        }
        // an iterator for the $matches array
        $i = 1;
        foreach ($dateArray AS $key => $value) {
            $dateArray[$key] = $matches[$i++];
            if (array_key_exists($key, $returnArray)) {
                $returnArray[$key] = $dateArray[$key];
            }
        }
        return $returnArray;
    }
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
    $timezone = get_user_timezone_offset($CFG->timezone);
    $dateArray = array();
    $dateArray = date_parse_from_format($format, $date);
    if (is_array($dateArray)) {
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
            $strsearch = get_string('searchx', 'moodle', $categoryname);
        } else {
            $strsearch = get_string('search');
        }
    } else {
        if ($type == 'course') {
            $strsearch = get_string('searchallcourses');
        } elseif ($type == 'program') {
            $strsearch = get_string('searchallprograms');
        } elseif ($type == 'category') {
            $strsearch = get_string('searchallcategories');
        } else {
            $strsearch = get_string('search');
            $type = '';
        }
    }

    $renderer = $PAGE->get_renderer('totara_core');
    $output = $renderer->print_totara_search($action, $type, $category, $strsearch, $value);

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
 * @param object $user User to use to localize string
 * @param string $identifier The key identifier for the localized string
 * @param string $module The module where the key identifier is stored.
 * @param mixed $a An object, string or number that can be used within translation strings
 * @param array $extralocations An array of strings with other locations to look for string files
 * @return string The localized string.
 *
 */
function get_string_in_user_lang($user, $identifier, $module='', $a=NULL, $extralocations=NULL) {
    global $USER;

    // $USER language not defined - just use current user's language
    if (!isset($USER->lang)) {
        return get_string($identifier, $module, $a, $extralocations);
    }

    // Store lang
    $original_lang = $USER->lang;

    // Set lang
    $USER->lang = $user->lang;

    $string = get_string($identifier, $module, $a, $extralocations);

    $USER->lang = $original_lang;

    return $string;
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
            $sql = ' CAST(' . $fieldname . ' AS DECIMAL) ';
            break;
        case 'mssql':
        case 'postgres':
            $sql = ' CAST(' . $fieldname . ' AS FLOAT) ';
            break;
            $sql = ' CAST(' . $fieldname . ' AS VARCHAR(20)) ';
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
        // skip this bit during testing as we don't have all the required tables for role assignments
        if (!$unittest) {
            // Delete role assignment if there was a manager but it changed
            if ($old_managerid && $managerchanged) {
                role_unassign(null, null, null, null, null, $assignment->reportstoid);
            }
            // Create new role assignment if there is now and a manager but it changed
            if ($assignment->managerid && $managerchanged) {
                // Get context
                $context = context_user($assignment->userid);
                // Get manager role id
                $roleid = $CFG->managerroleid;
                // Assign manager to user
                $raid = role_assign(
                    $roleid,
                    $assignment->managerid,
                    null,
                    $context->id,
                    (!$assignment->timevalidfrom ? 0 : $assignment->timevalidfrom),
                    (!$assignment->timevalidto ? 0 : $assignment->timevalidto)
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
 * Returns an array of class strings to add to each navigation tab
 *
 * Strings are empty unless the page should be shown as 'selected'. Keys
 * are the tab names from $navstructure array
 *
 * @param array $navstructure Multi-dimensional array of the tab structure
 * @param array $navmatches URL matches for each tab name
 *
 * @return array Array of class strings to add to menu items
 */
function totara_get_selected_navs($navstructure, $navmatches) {
    global $CFG;
    $page_url = substr(qualified_me(), strlen($CFG->wwwroot));

    $selected = null;
    foreach ($navmatches as $pagename => $partialurls) {
        if(is_array($partialurls)) {
            foreach($partialurls as $partialurl) {
                if(strncmp($page_url, $partialurl,
                strlen($partialurl)) == 0) {
                    $selected = $pagename;
                }
            }
        } else {
            if(strncmp($page_url, $partialurls,
            strlen($partialurls)) == 0) {
                $selected = $pagename;
            }
        }
    }

    // now work out if any primary items should be selected
    $primary_selected = null;
    $secondary_selected = null;
    foreach($navstructure as $primary => $secondaries) {
        // this is a primary item
        if($selected == $primary) {
            $primary_selected = $primary;
            $secondary_selected = null;
        }
        // this is a secondary item, find which primary
        // item it belongs to
        if(in_array($selected, $secondaries)) {
            $primary_selected = $primary;
            $secondary_selected = $selected;
        }
        // otherwise, none set
    }
    return array($primary_selected, $secondary_selected);
}
