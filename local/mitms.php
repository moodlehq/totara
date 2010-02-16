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
                    <a href="'.$CFG->wwwroot.'/plan/index.php" title="'.get_string('developmentplan','local').'">
                    <img src="'. $CFG->wwwroot.'/pix/i/idp.png" width="32" height="32" /></a>
                </td>
                <td align="left" valign="center">
                    <span style="font-size: small"><a href="'.$CFG->wwwroot.'/plan/index.php">' . get_string('developmentplan', 'local') . '</a></span>
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
                    <span style="font-size: small"><a href="'.$CFG->wwwroot.'/blocks/facetoface/mysignups.php">'.get_string('bookings','local').'</a></span>
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
    $returnstr .= '
     </ul>
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
    $context = get_context_instance(CONTEXT_SYSTEM);
    $managerroleid = get_field('role','id','shortname','manager');

    // return count of users with this user as manager
    $sql = "SELECT COUNT(*)
        FROM {$CFG->prefix}role_assignments ra
        LEFT JOIN {$CFG->prefix}context c
          ON c.id=ra.contextid
        JOIN {$CFG->prefix}user u
          ON u.id=c.instanceid
        WHERE ra.roleid={$managerroleid}
          AND ra.userid={$USER->id}
          AND c.contextlevel=30";

    $teammembers = count_records_sql($sql);
    if (!empty($teammembers) && $teammembers > 0 && has_capability('moodle/local:viewstaffreports',$context)) {
        $returnstr = '
         <table>
             <tr>
                 <td align="left">
                     <a href="'.$CFG->wwwroot.'/my/team.php"><img src="'.$CFG->wwwroot.'/pix/i/teammember.png" width="32" height="32"></a>
                 </td>
                 <td align="left">
                     <a href="'.$CFG->wwwroot.'/my/team.php">View My Team</a> ('.$teammembers.' staff)
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
        // go through each restriction looking for capabilities
        $restrictions = unserialize($report->restriction);
        $hascap = false;
        if($restrictions && is_array($restrictions)) {
            foreach($restrictions as $restriction) {
                $cap = $restriction['capability'];
                // need at least one of listed capabilities
                if(has_capability($cap,$context)) {
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
