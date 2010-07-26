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
 * this file should be used for all tao-specific methods
 * and will be included automatically in setup.php along
 * with other core libraries.
 *
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/local/mitms.php');

function local_postinst() {

    global $db, $CFG;
    $olddebug = $db->debug;
    set_config('theme', 'totara');
    set_config("langmenu", 0);
    $db->debug = $CFG->debug;

    /// Insert default records
    $defaultdir = $CFG->dirroot.'/local/db/default';
    $includes = array();
    if (is_dir($defaultdir)) {
        if ($dh = opendir($defaultdir)) {
            $timenow = time();
            while (($file = readdir($dh)) !== false) {
                // exclude directories
                if (is_dir($file)) {
                    continue;
                }
                // not a php file
                if (substr($file, -4) != '.php') {
                    continue;
                }
                // include default data file
                $includes[] = $CFG->dirroot.'/local/db/default/'.$file;
            }
        }
    }
    // sort so order of includes is known
    sort($includes);
    foreach($includes as $include) {
        include($include);
    }

    mitms_reset_frontpage_blocks();
    mitms_add_guide_block_to_adminpages();

    // set up frontpage
    set_config('frontpage', '');
    set_config('frontpageloggedin', '');
    set_config('allowvisiblecoursesinhiddencategories', '1');

    rebuild_course_cache(SITEID);

    // ensure page scrolls right to bottom when debugging on
    print "<div></div>";
    return true;

}

/**
* hook to add extra sticky-able page types.
*/
function local_get_sticky_pagetypes() {
    return array(
    // not using a constant here because we're doing funky overrides to PAGE_COURSE_VIEW in the learning path format
    // and it clobbers the page mapping having them both defined at the same time
        'MITMS' => array(
            'id' => 'MITMS',
            'lib' => '/local/lib.php',
            'name' => 'MITMS'
        ),
    );
}
