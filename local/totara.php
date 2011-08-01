<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @subpackage local
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
        print_error('error:notificationsparamtypewrong', 'local');
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
    global $CFG;

    // first delete pre-set ones
    execute_sql('DELETE FROM ' . $CFG->prefix . 'block_instance
        WHERE pageid = ' . SITEID . "
        AND pagetype = 'course-view'"
    );

    // build new block array
    $blocks = array(
        (object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'admin_tree'),
            'pageid'   => SITEID,
            'pagetype' => 'course-view',
            'position' => 'l',
            'weight'   => 1,
            'visible'  => 1,
            'configdata' => '',
        ),
        (object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'messages'),
            'pageid'   => SITEID,
            'pagetype' => 'course-view',
            'position' => 'r',
            'weight'   => 1,
            'visible'  => 1,
            'configdata' => '',
        ),
        (object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'calendar_month'),
            'pageid'   => SITEID,
            'pagetype' => 'course-view',
            'position' => 'r',
            'weight'   => 2,
            'visible'  => 1,
            'configdata' => '',
        ),
        /*(object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'guides'),
            'pageid'   => SITEID,
            'pagetype' => 'course-view',
            'position' => 'r',
            'weight'   => 3,
            'visible'  => 1,
            'configdata' => '',
        ),*/
    );

    // insert blocks
    foreach ($blocks as $b) {
        insert_record('block_instance', $b);
    }

    return 1;

}


/**
 * Returns markup for displaying a progress bar for a user's course progress
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
    global $CFG, $COMPLETION_STATUS;

    if (!isset($status) || !array_key_exists($status, $COMPLETION_STATUS)) {
        return '';
    }

    $statusstring = $COMPLETION_STATUS[$status];
    $status = get_string($statusstring, 'completion');

    // Display progress bar
    $content = "<span class=\"coursecompletionstatus\">";
    $content .= "<span class=\"completion-$statusstring\" title=\"$status\"></span></span>";

    // Check if user has permissions to see details
    if (completion_can_view_data($userid, $courseid)) {
        $content = "<a href=\"{$CFG->wwwroot}/blocks/completionstatus/details.php?course={$courseid}&user={$userid}\">{$content}</a>";
    }

    return $content;
}


/**
 * adds guides block on the site admin pages.  designed to be called from local_postinst
 *
 * @return bool
 */
function totara_add_guide_block_to_adminpages() {
    global $CFG;

        $b = (object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'guides'),
            'pageid'   => 0,
            'pagetype' => 'admin',
            'position' => 'l',
            'weight'   => 1,
            'visible'  => 1,
            'configdata' => '',
        );
    insert_record('block_instance', $b);

}

/**
* print out the Totara My Learning nav section
*/
function totara_print_my_learning_nav($return=false) {
    global $CFG, $USER;

    $usercontext = get_context_instance(CONTEXT_USER, $USER->id);
    $returnstr = '
        <table>
    ';
    if (has_capability('local/plan:accessplan', $usercontext)) {
        $returnstr .= '
            <tr>
                <td align="left">
                    <center><a href="'.$CFG->wwwroot.'/local/plan/index.php" title="'.get_string('developmentplan','local').'">
                    <img src="'. $CFG->pixpath.'/i/idp.png" alt="'.get_string('developmentplan', 'local').'" /></a></center>

                </td>
                <td align="left">
                    <span style="font-size: small"><a href="'.$CFG->wwwroot.'/local/plan/index.php">' . get_string('developmentplan', 'local') . '</a></span>
                </td>
            </tr>
        ';
    }
    $returnstr .= '
        <tr>
            <td align="left">
                <center><a href="'.$CFG->wwwroot.'/blocks/facetoface/mysignups.php" title="'.get_string('bookings','local').'">
                <img src="'.$CFG->pixpath.'/i/bookings.png" alt="'.get_string('bookings', 'local').'" /></a></center>
            </td>
            <td align="left">
                <span style="font-size: small"><a href="'.$CFG->wwwroot.'/my/bookings.php?userid='.$USER->id.'">'.get_string('bookings','local').'</a></span>
            </td>
        </tr>';
    if(get_config(NULL, 'idp_showlearnrec')==2){
        $returnstr .= '<tr>
            <td align="left">
                <center><a href="'.$CFG->wwwroot.'/local/plan/record/courses.php?userid='.$USER->id.'" title="'.get_string('recordoflearning', 'local').'">
                <img src="' . $CFG->pixpath . '/i/rol.png" alt="'.get_string('recordoflearning', 'local').'" /></a></center>
            </td>
            <td align="left">
                <span style="font-size: small"><a href="'.$CFG->wwwroot.'/local/plan/record/courses.php?userid='.$USER->id.'">'.get_string('recordoflearning','local').'</a></span>
            </td>
        </tr>';
    }
    $returnstr .= '</table>';

    if ($return) {
        return $returnstr;
    }
    echo $returnstr;
}

/**
* print out the Totara My Team nav section
*/
function totara_print_my_team_nav($return=false) {
    global $CFG, $USER;

    $returnstr = '';

    $managerroleid = get_field('role','id','shortname','manager');

    // return users with this user as manager
    $teammembers = totara_get_staff();

    if (!empty($teammembers) && count($teammembers) > 0) {
        $returnstr = '
         <table>
             <tr>
                 <td align="left">
                     <a href="'.$CFG->wwwroot.'/my/teammembers.php"><img src="'.$CFG->wwwroot.'/pix/i/teammembers.png" width="32" height="32" alt="'.get_string('viewmyteam','local').'" /></a>
                 </td>
                 <td align="left">
                     <a href="'.$CFG->wwwroot.'/my/teammembers.php">'.get_string('viewmyteam','local').'</a><br />('.count($teammembers).' staff)
                 </td>
             </tr>
         </table>
        ';
    }
    return $returnstr;

}

function totara_print_report_manager($return=false) {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    $reports = get_records('report_builder','','','fullname');
    if (!is_array($reports)){
        $reports = array();
    }
    $context = get_context_instance(CONTEXT_SYSTEM);

    $rows = array();
    $counter = 0;
    foreach ($reports as $report) {
        // show reports user has permission to view, that are not hidden
        if(reportbuilder::is_capable($report->id) && !$report->hidden) {
            $viewurl = reportbuilder_get_report_url($report);
            $class = ($counter % 2) ? 'noshade' : 'shade';
            $counter++;
            $row = '
            <tr class="'.$class.'">
                <td class="icon" align="left">
                    <a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$report->id.'" title="'.$report->fullname.'">
                    <img src="'.$CFG->pixpath.'/i/reports.png" width="32" height="32" /></a>
                </td>
                <td class="text" align="left">
                    <span style="font-size: small;"><a href="'.$viewurl.'">'.$report->fullname.'</a>
                ';


            // if admin with edit mode on show settings button too
            if(has_capability('moodle/local:admin',$context) && isset($USER->editing) && $USER->editing) {
                $row .= '<a href="'.$CFG->wwwroot.'/local/reportbuilder/general.php?id='.$report->id.'">'.
                    '<img src="'.$CFG->pixpath.'/t/edit.gif" alt="'.get_string('settings','local').'"></a>';
            }
            $row .= '</span>
                </td>
            </tr>
            ';
            $rows[] = $row;
        }
    }

    // if there are any rows print them
    $returnstr = '';
    if(count($rows)>0) {
        $returnstr = '<table class="reportmanager">';
        $returnstr .= implode("\n",$rows);
        $returnstr .= '</table>';
    } else {
        $returnstr = get_string('nouserreports', 'local_reportbuilder');
    }

    if ($return) {
        return $returnstr;
    }
    echo $returnstr;
}


function totara_print_scheduled_reports($return=false) {
    global $CFG, $USER, $REPORT_BUILDER_EXPORT_OPTIONS, $REPORT_BUILDER_SCHEDULE_OPTIONS, $CALENDARDAYS;
    $REPORT_BUILDER_SCHEDULE_CODES = array_flip($REPORT_BUILDER_SCHEDULE_OPTIONS);

    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once($CFG->dirroot.'/calendar/lib.php');
    require_once($CFG->dirroot.'/local/reportbuilder/scheduled_forms.php');


    $sql = "SELECT rbs.*, rb.fullname
            FROM {$CFG->prefix}report_builder_schedule rbs
            JOIN {$CFG->prefix}report_builder rb
            ON rbs.reportid=rb.id
            WHERE rbs.userid={$USER->id}";

    if($scheduledreports = get_records_sql($sql)){
        $columns[] = 'reportname';
        $headers[] = get_string('reportname', 'local_reportbuilder');
        $columns[] = 'data';
        $headers[] = get_string('savedsearch', 'local_reportbuilder');
        $columns[] = 'format';
        $headers[] = get_string('format', 'local_reportbuilder');
        $columns[] = 'schedule';
        $headers[] = get_string('schedule', 'local_reportbuilder');

        $columns[] = 'options';
        $headers[] = get_string('options', 'local');

        $shortname = 'scheduled_reports';
        $table = new flexible_table($shortname);
        $table->define_columns($columns);
        $table->define_headers($headers);
        $table->set_attribute('class', 'scheduled-reports generalbox');
        $table->column_class('options', 'options');

        $table->setup();
        $dateformat = ($USER->lang == 'en_utf8') ? 'jS' : 'j';

        foreach($scheduledreports as $sched) {
            if(isset($sched->frequency) && isset($sched->schedule)){
                $schedule = '';

                switch($REPORT_BUILDER_SCHEDULE_CODES[$sched->frequency]){
                case 'daily':
                    $schedule .= get_string('daily', 'local_reportbuilder') . ' ' .  get_string('at', 'local_reportbuilder') . ' ';
                    $schedule .= strftime('%l:%M%P' ,mktime($sched->schedule,0,0));
                    break;
                case 'weekly':
                    $schedule .= get_string('weekly', 'local_reportbuilder') . ' ' . get_string('on', 'local_reportbuilder') . ' ';
                    $schedule .= get_string($CALENDARDAYS[$sched->schedule], 'calendar');
                    break;
                case 'monthly':
                    $schedule .= get_string('monthly', 'local_reportbuilder') . ' ' . get_string('onthe', 'local_reportbuilder') . ' ';
                    $schedule .= date($dateformat ,mktime(0,0,0,0,$sched->schedule));
                    break;
                }
            }
            else {
                $schedule = get_string('schedulenotset', 'local_reportbuilder');
            }

            foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
                // bitwise operator to see if option bit is set
                if($sched->format == $code) {
                    $format = get_string($option . 'format','local_reportbuilder');
                }
            }

            $data = '';
            if($sched->savedsearchid!=0){
                $data .= get_field('report_builder_saved', 'name', 'id', $sched->savedsearchid);
            }
            else {
                $data .= get_string('alldata', 'local_reportbuilder');
            }

            $tablerow = array();
            $tablerow[] = $sched->fullname;
            $tablerow[] = $data;
            $tablerow[] = $format;
            $tablerow[] = $schedule;

            $tablerow[] = '<a href="'.$CFG->wwwroot.'/local/reportbuilder/scheduled.php?id='.$sched->id .'" title="'.get_string('edit').
                '"><img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.get_string('edit').'" /></a>'. ' ' .
                '<a href="'.$CFG->wwwroot.'/local/reportbuilder/deletescheduled.php?id='.$sched->id.'" title="'.get_string('delete').
                '"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.get_string('delete').'" /></a>';

            $table->add_data($tablerow);
        }

        $table->print_html();
    }
    else {
        echo get_string('noscheduledreports', 'local_reportbuilder') . '<br /><br />';
    }

    $mform = new scheduled_reports_add_form($CFG->wwwroot . '/local/reportbuilder/scheduled.php', array());
    $mform->display();

}

function totara_print_my_courses() {
    global $CFG,$USER;
    $content = '';
    $courses = completion_info::get_all_courses($USER->id, 10);

    if ($courses) {
        $content .= '<table class="centerblock">
            <tr><th class="course">'.get_string('course').'</th>'.
            '<th class="status">'.get_string('status').'</th>'.
            '<th class="enroldate">'.get_string('enrolled', 'local').'</th>'.
            '<th class="startdate">'.get_string('started','local').'</th>'.
            '<th class="completeddate">'.get_string('completed','local').'</th></tr>';

        foreach($courses as $course) {
            $id = $course->course;
            $name = $course->name;
            $enrolled = $course->timeenrolled;
            $completed = $course->timecompleted;

            $starteddate = '';
            if ($course->timestarted != 0) {
                $starteddate = userdate($course->timestarted, '%e %b %y');
            }
            $enroldate = isset($enrolled) && $enrolled != 0 ? userdate($enrolled, '%e %b %y') : null;
            $completeddate = isset($completed) && $completed != 0 ? userdate($completed, '%e %b %y') : null;
            // Display deleted courses as unknown
            if ($name != '') {
                $content .= "<tr><td class=\"course\"><a href=\"{$CFG->wwwroot}/course/view.php?id={$id}\" title=\"$name\">$name</a></td>";
            } else {
                $content .= "<tr><td class=\"course\">" . get_string('deletedcourse', 'completion') . "</td>";
            }

            $status = array_key_exists($id, $courses) ? $courses[$id]->status : COMPLETION_STATUS_NOTYETSTARTED;
            $completion = totara_display_course_progress_icon($USER->id, $course->course, $status);

            $content .=     "<td class=\"status\">{$completion}</td><td class=\"enroldate\">$enroldate</td>";
            $content .=     "<td class=\"startdate\">$starteddate</td><td class=\"completeddate\">$completeddate</td></tr>\n";
        }
        $content .= "</table>\n";
        $content .= '<div class="allmycourses"><a href="'.$CFG->wwwroot.'/local/plan/record/courses.php?userid='.$USER->id.'">'.get_string('allmycourses','local').'</a></div>';
    }

    if (empty($content)) {
        $content = '<span class="noenrollments">'.get_string('notenrolled','local').'</span>';
    }
    echo '<div class="mycourses">';
    echo '<div class="header"><div class="title"><h2>'.get_string('mycoursecompletions','local').'</h2></div></div><div class="content">';
    echo $content;
    echo '</div></div>';
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
    global $CFG;
    $sql = "SELECT uid.data
            FROM {$CFG->prefix}user_info_data uid
            JOIN {$CFG->prefix}user_info_field uif
              ON uif.id=uid.fieldid
            WHERE uif.shortname='{$fieldshortname}'
            AND uid.userid='{$userid}'
            ";
    return get_field_sql($sql);
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
    global $CFG, $USER;

    $userid = (int) $userid;

    if (!isset($managerid)) {
        // Use logged in user as default
        $managerid = $USER->id;
    }

    require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');

    if ($postype) {
        $postypewhere = "AND pa.type = {$postype}";
    } else {
        $postypewhere = '';
    }

    $sql = "SELECT DISTINCT u.id
        FROM
            {$CFG->prefix}pos_assignment pa
            INNER JOIN {$CFG->prefix}role_assignments ra ON pa.reportstoid = ra.id
            INNER JOIN {$CFG->prefix}user u ON ra.userid = u.id
        WHERE
            ra.userid = {$managerid} AND pa.userid = {$userid}
            {$postypewhere}";

    return record_exists_sql($sql);
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
    global $CFG, $USER;
    require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');
    $postype = ($postype === null) ? POSITION_TYPE_PRIMARY : (int) $postype;

    $userid = !empty($userid) ? (int) $userid : $USER->id;
    $sql = "SELECT DISTINCT u.id
        FROM
            {$CFG->prefix}pos_assignment pa
            INNER JOIN {$CFG->prefix}user u ON pa.userid = u.id
            INNER JOIN {$CFG->prefix}role_assignments ra ON pa.reportstoid = ra.id
        WHERE
            ra.userid = {$userid}
            AND pa.type = {$postype}";

    if(!$res = get_records_sql($sql)) {
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
    global $CFG;
    require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');
    $postype = ($postype === null) ? POSITION_TYPE_PRIMARY : (int) $postype;

    $userid = (int) $userid;
    $sql = "SELECT u.*
        FROM
            {$CFG->prefix}pos_assignment pa
            INNER JOIN {$CFG->prefix}role_assignments ra ON pa.reportstoid = ra.id
            INNER JOIN {$CFG->prefix}user u ON ra.userid = u.id
        WHERE
            pa.userid = {$userid}
            AND pa.type = {$postype}";

    //Return a manager if they have one otherwise false
    return get_record_sql($sql);
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
        $nav = build_navigation($morenavlinks);
        print_header($title, $title, $nav);
    }
}
page_map_class('Totara', 'totara_page_class_hack');


/**
* dashboard page lib
*/
class totara_dashboard_page_class extends page_base {
    private $dashb_instance;

    function init_full() {
        global $CFG;

        if ($this->full_init_done) {
            return;
        }

        // Get the dashboard details
        $sql = "SELECT di.*, d.shortname, d.title
                FROM {$CFG->prefix}dashb d
                INNER JOIN {$CFG->prefix}dashb_instance di ON d.id = di.dashb_id
                WHERE di.id = {$this->id}";
        if (!$this->dashb_instance = get_record_sql($sql)) {
            error('Cannot fully initialize page - could not retrieve dashboard details');
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
        $nav = build_navigation($morenavlinks);
        print_header($title, $title, $nav);
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
 * resets the customised sticky blocks settings.  designed to be called from /local/db/upgrade.php
 *
 * @param bool   $remove   dictates whether to remove existing sticky blocks
 * @param string $path     path to the stickyblocks definition file
 *
 * @return bool
 */
function totara_reset_stickyblocks($remove=false, $path='local') {
    global $CFG;

    if ($remove) {
        // remove existing.  we only remove from the custom pagetypes format_learning and my-collaboration
        delete_records('block_pinned', 'pagetype', 'format_learning');
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
        $id = get_field('block_pinned', 'id', 'blockid', $block->blockid, 'pagetype', $block->pagetype);

        if (empty($id)) {
            // if not there then insert a new record
            insert_record('block_pinned', $block);
        } else {
            // if there then just update the relevant settings
            $block->id = $id;
            update_record('block_pinned', $block);
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
    global $CFG;
    // get Role of user in this page.
    $sql = "SELECT r.shortname
            FROM {$CFG->prefix}dashb d
            INNER JOIN {$CFG->prefix}dashb_instance di ON d.id = di.dashb_id
            INNER JOIN {$CFG->prefix}role r on d.roleid = r.id
            WHERE di.id = {$pageid}";       // The pageid is the dashb instance id
    $role = get_field_sql($sql);
    return $role;
}


//Used to create a timestamp from a string
function totara_convert_userdate($datestring) {
    // Check for DD/MM/YYYY
    if (preg_match('|(\d{1,2})/(\d{1,2})/(\d{4})|', $datestring, $matches)) {
        return mktime(0,0,0,$matches[2], $matches[1], $matches[3]);
    }
    return strtotime($datestring);
}


function get_totara_menu($header=true) {
    global $CFG, $USER;
    include($CFG->dirroot.'/local/totara_menu.php');
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

    // Load errors from database
    $errors = get_records('errorlog');
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
 * @param   bool    $return     Return results rather than print
 * @param   string  $type       Type of results ('all', 'course', 'program', 'category')
 * @param   int     $category   Parent category (0 means all, -1 means global search)
 * @return  string|void
 */
function print_totara_search($value = '', $return = false, $type = 'all', $category = -1) {

    global $CFG;
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
        $categoryname = get_field('course_categories', 'name', 'id', $category);
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

    $output  = '<form id="searchtotara" action="'.$action.'" method="get">';
    $output .= '<fieldset class="coursesearchbox invisiblefieldset">';
    $output .= '<input type="hidden" name="viewtype" value="'.$type.'" />';
    $output .= '<input type="hidden" name="category" value="'.$category.'" />';
    $output .= '<input type="text" class="search-box" id="navsearchbox" size="20" name="search" alt="'.s($strsearch).'" value="'.s($value, true).'" placeholder="'.s($strsearch).'" />';
    $output .= '<input type="submit" value="'.get_string('go').'" />';
    $output .= '</fieldset></form>';

    if ($return) {
        return $output;
    }
    echo $output;
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
    global $CFG, $USER;

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
    return print_single_button(qualified_me(), $params, $label, 'get', '', true);
}
