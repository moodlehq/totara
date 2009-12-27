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

    $returnstr = '
     <ul id="mitms-nav">
       <li><a href="' . $CFG->wwwroot . '">' . get_string('developmentplan', 'local') . '</a></li>
       <li><a href="' . $CFG->wwwroot . '">' . get_string('bookings', 'local') . '</a></li>
       <li><a href="' . $CFG->wwwroot . '/my/records.php">' . get_string('history', 'local') . '</a></li>
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
