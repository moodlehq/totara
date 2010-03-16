<?php
/**
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    moodle
 * @subpackage local
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  Catalyst IT Limited
 *
 * this file should be used for all mitms-specific methods
 * and will be included automatically in local/lib.php along
 * with other core libraries.
 *
 * functions should all start with the mitms_ prefix.
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

/**
 * resets the customised front page blocks.  designed to be called from local_postinst
 *
 * @return bool
 */
function mitms_reset_frontpage_blocks() {
    global $CFG;

    // first delete pre-set ones
    execute_sql('DELETE FROM ' . $CFG->prefix . 'block_instance
        WHERE pageid = ' . SITEID . "
        AND pagetype = 'course-view'"
    );

    // build new block array
    $blocks = array(
        (object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'mitms_my_learning_nav'),
            'pageid'   => SITEID,
            'pagetype' => 'course-view',
            'position' => 'l',
            'weight'   => 1,
            'visible'  => 1,
            'configdata' => '',
        ),
        (object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'mitms_my_performance_nav'),
            'pageid'   => SITEID,
            'pagetype' => 'course-view',
            'position' => 'l',
            'weight'   => 2,
            'visible'  => 1,
            'configdata' => '',
        ),
        (object)array(
            'blockid'  =>  get_field('block', 'id', 'name', 'admin_tree'),
            'pageid'   => SITEID,
            'pagetype' => 'course-view',
            'position' => 'l',
            'weight'   => 3,
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
    );

    // insert blocks
    foreach ($blocks as $b) {
        insert_record('block_instance', $b);
    }

    return 1;

}

/**
* print out the MITMS My Learning nav section
*/
function mitms_print_my_learning_nav($return=false) {
    global $CFG, $USER;

    $usercontext = get_context_instance(CONTEXT_USER, $USER->id);

    $returnstr = '
        <table>
    ';
    if (has_capability('moodle/local:viewownlist', $usercontext)) {
        $returnstr .= '
            <tr>
                <td align="left">
                    <a href="'.$CFG->wwwroot.'/idp/index.php" title="'.get_string('developmentplan','local').'">
                    <img src="'. $CFG->wwwroot.'/pix/i/idp.png" width="32" height="32" /></a>
                </td>
                <td align="left" valign="center">
                    <span style="font-size: small"><a href="'.$CFG->wwwroot.'/idp/index.php">' . get_string('developmentplan', 'local') . '</a></span>
                </td>
            </tr>
        ';
    }
    $returnstr .= '
            <tr>
                <td align="left">
                    <a href="'.$CFG->wwwroot.'/blocks/facetoface/mysignups.php" title=""><img src="'.$CFG->wwwroot.'/pix/i/bookings.png" width="32" height="32" /></a>
                </td>
                <td align="left" valign="center">
                    <span style="font-size: small"><a href="'.$CFG->wwwroot.'/my/bookings.php?id='.$USER->id.'">'.get_string('bookings','local').'</a></span>
                </td>
            </tr>
            <tr>
                <td align="left">
                    <a href="'.$CFG->wwwroot.'/my/records.php?id='.$USER->id.'" title=""><img src="' . $CFG->wwwroot . '/pix/i/rol.png" width="32" height="32" /></a>
                </td>
                <td align="left" valign="center">
                    <span style="font-size: small"><a href="'.$CFG->wwwroot.'/my/records.php?id='.$USER->id.'">'.get_string('recordoflearning','local').'</a></span>
                </td>
            </tr>
        </table>
    ';

    if ($return) {
        return $returnstr;
    }
    echo $returnstr;
}

/**
* print out the MITMS My Performance nav section
*/
function mitms_print_my_performance_nav($return=false) {
    global $CFG, $USER;

    $returnstr = '
     <ul id="mitms-nav">
       <li><a href="' . $CFG->wwwroot . '">' . get_string('goals', 'local') . '</a></li>
       <li><a href="' . $CFG->wwwroot . '">' . get_string('assessments', 'local') . '</a></li>
       <li><a href="' . $CFG->wwwroot . '">' . get_string('evaluations', 'local') . '</a></li>
    ';
    $returnstr .= '
     </ul>
    ';

    if ($return) {
        return $returnstr;
    }
    echo $returnstr;
}

/**
* print out the MITMS My Tools nav section
*/
function mitms_print_my_tools_nav($return=false) {
    global $CFG, $USER;

    $returnstr = '
     <ul id="mitms-nav">
    ';
    if (!isloggedin()) {
        $returnstr .= '
       <li><a href="' . $CFG->wwwroot . '/login/index.php">' . get_string('login') . '</a></li>
        ';
    } else {
        $returnstr .= '
       <li><a href="' . $CFG->wwwroot . '/login/logout.php">' . get_string('logout') . '</a></li>
        ';
    }
    $returnstr .= '
     </ul>
    ';

    if ($return) {
        return $returnstr;
    }
    echo $returnstr;
}

/**
* print out the MITMS My Team nav section
*/
function mitms_print_my_team_nav($return=false) {
    global $CFG, $USER;

    $returnstr = '';

    $managerroleid = get_field('role','id','shortname','manager');

    // return users with this user as manager
    $teammembers = mitms_get_staff();

    if (!empty($teammembers) && count($teammembers) > 0) {
        $returnstr = '
         <table>
             <tr>
                 <td align="left">
                     <a href="'.$CFG->wwwroot.'/my/team.php"><img src="'.$CFG->wwwroot.'/pix/i/teammembers.png" width="32" height="32" alt="'.get_string('viewmyteam','local').'" /></a>
                 </td>
                 <td align="left">
                     <a href="'.$CFG->wwwroot.'/my/team.php">'.get_string('viewmyteam','local').'</a><br />('.count($teammembers).' staff)
                 </td>
             </tr>
         </table>
        ';
    }
    return $returnstr;

}

function mitms_print_report_manager($return=false) {
    global $CFG,$USER;
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    $reports = get_records('report_builder');
    $context = get_context_instance(CONTEXT_SYSTEM);

    $rows = array();
    foreach ($reports as $report) {
        $options = get_source_data($report->source,'restrictionoptions');
        // go through each restriction looking for capabilities
        $restrictions = unserialize($report->restriction);
        $hascap = false;
        if($restrictions && is_array($restrictions)) {
            foreach($restrictions as $restriction) {
                if(isset($options) && is_array($options)) {
                    $info = false;
                    foreach($options as $option) {
                        if($option['name'] == $restriction) {
                            $info = $option;
                        }
                    }
                }
                if(!$info) {
                    continue;
                }
                $cap = (isset($info['capability'])) ? $info['capability'] : null;
                // allow if no capability set, or if user has the capability
                if(!isset($cap) || has_capability($cap,$context)) {
                    $hascap = true;
                }
            }
        }
        // show reports user has permission to view, that are not hidden
        if($hascap && !$report->hidden) {
            $row = '
            <tr>
                <td align="left">
                    <a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$report->id.'" title="'.$report->fullname.'">
                    <img src="'.$CFG->wwwroot.'/pix/i/reports.png" width="32" height="32" /></a>
                </td>
                <td align="left" valign="center">
                    <span style="font-size: small;"><a href="'.$CFG->wwwroot.'/local/reportbuilder/report.php?id='.$report->id.'">'.$report->fullname.'</a>
                ';


            // if admin with edit mode on show settings button too
            if(has_capability('moodle/local:admin',$context) && isset($USER->editing) && $USER->editing) {
                $row .= '<a href="'.$CFG->wwwroot.'/local/reportbuilder/settings.php?id='.$report->id.'">'.
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
        $returnstr = '<table>';
        $returnstr .= implode("\n",$rows);
        $returnstr .= '</table>';
    }

    if ($return) {
        return $returnstr;
    }
    echo $returnstr;
}

function mitms_print_my_current_courses() {
    global $CFG,$USER;
    $content = '';
    $sql = "SELECT c.id, c.fullname, cc.timestarted, cc.timecompleted
        FROM {$CFG->prefix}course_completions cc
        LEFT JOIN {$CFG->prefix}course c ON cc.course=c.id
        WHERE userid = {$USER->id} AND cc.timestarted IS NOT NULL
        ORDER BY cc.timestarted DESC,cc.timecompleted DESC LIMIT 5";
    $data = array();
    if($courses = get_records_sql($sql)) {
        $content .= '<table class="centerblock">
            <tr><th class="course">'.get_string('course').'</th>'.
            '<th class="status">'.get_string('status').'</th>'.
            '<th class="startdate">'.get_string('startdate','local').'</th>'.
            '<th class="completeddate">'.get_string('completeddate','local').'</th></tr>';
        foreach($courses as $course) {
            $id = $course->id;
            $name = $course->fullname;
            $completed = $course->timecompleted;
            $started = $course->timestarted;
            $status = isset($completed) ? get_string('completed','local') : get_string('inprogress','local');
            $completeddate = isset($completed) ? userdate($completed, '%e %b %y') : null;
            $starteddate = isset($started) ? userdate($started, '%e %b %y') : null;
            $content .= "<tr><td class=\"course\"><a href=\"{$CFG->wwwroot}/course/view.php?id={$id}\" title=\"$name\">$name</a></td>";
            $content .=     "<td class=\"status\">$status</td><td class=\"startdate\">$starteddate</td><td class=\"completeddate\">$completeddate</td></tr>\n";
        }
        $content .= "</table>\n";
        $content .= '<div class="mycourses"><a href="'.$CFG->wwwroot.'/my/coursecompletions.php?id='.$USER->id.'">'.get_string('allmycourses','local').'</a></div>';
    }

    if (empty($content)) {
        $content = get_string('nocurrentcourses','local');
    }
    echo '<div class="mycurrentcourses">';
    echo '<div class="header"><div class="title"><h2>'.get_string('mycurrentcourses','local').'</h2></div></div><div class="content">';
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
function mitms_print_user_profile_field($userid=null, $fieldshortname=null) {
    $sql = "SELECT uid.data
            FROM mdl_user_info_data uid
            JOIN mdl_user_info_field uif
              ON uif.id=uid.fieldid
            WHERE uif.shortname='{$fieldshortname}'
            AND uid.userid='{$userid}'
            ";
    return get_field_sql($sql);
}

/**
 * @param int $userid ID of user
 * @param int $managerid ID of a potential manager to check
 * @return boolean true if user $userid is managed by user $managerid
 *
 * If managerid is not set, uses the current user
**/
function mitms_is_manager($userid, $managerid=null) {
    global $USER;
    if(!isset($managerid)) {
        $managerid = $USER->id;
    }
    $context = get_context_instance(CONTEXT_USER,$userid);
    $managerroleid = get_field('role','id','shortname','manager');

    // if a record exists, they are a manager to the user
    if(get_record('role_assignments','roleid',$managerroleid,'contextid',$context->id, 'userid', $managerid)) {
        return true;
    } else {
        return false;
    }

}

/**
 * @param int $userid ID of a user to get the staff of
 * @return array Array of userids of staff who are managed by user $userid, or false if none
 *
 * if $userid is not set, returns staff of current user
**/
function mitms_get_staff($userid=null) {
    global $USER,$CFG;

    if(!isset($userid)) {
        $userid = $USER->id;
    }
    $managerroleid = get_field('role','id','shortname','manager');

    // return users with this user as manager
    $sql = "SELECT c.instanceid as userid
        FROM {$CFG->prefix}role_assignments ra
        LEFT JOIN {$CFG->prefix}context c
          ON c.id=ra.contextid
        JOIN {$CFG->prefix}user u
          ON u.id=c.instanceid
        WHERE ra.roleid={$managerroleid}
          AND ra.userid={$userid}
          AND c.contextlevel=30";

    // no matches
    if(!$res = get_records_sql($sql)) {
        return false;
    }

    $staff = array();
    if(is_array($res)) {
        foreach($res as $record) {
            $staff[] = $record->userid;
        }
    }

    return $staff;
}

/**
* hacked page lib that gets used on any page that doesn't have one.
* really just exists to fulfil requirements and allow stickyblocks
*/
class mitms_page_class_hack extends page_base {
    function get_type() {
        return 'MITMS';
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
            return array('pt' => 'MITMS');
        }
    }

    function print_header($title, $morenavlinks=NULL) {
        $nav = build_navigation($morenavlinks);
        print_header($title, $title, $nav);
    }
}
page_map_class('MITMS', 'mitms_page_class_hack');

/**
* local footer hook. nothing yet but this could print right blocks
*/
function mitms_local_footer_hook() {
    if (!defined('MITMS_HEADER_OVERRIDDEN')) {
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
function mitms_reset_stickyblocks($remove=false, $path='local') {
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

