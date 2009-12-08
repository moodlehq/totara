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
    set_config('theme', 'mitms');
    $db->debug = $CFG->debug;

    // set default course categories
    $course_cat = new stdclass();
    $course_cat->name = get_string('induction', 'local');
    $course_cat->description ='';
    $course_cat->parent = 0;
    $course_cat->sortorder = 999;
    $course_cat->coursecount = 0;
    $course_cat->visible = 1;
    $course_cat->timemodified = time();
    $course_cat->depth = 1;
    $course_cat->path = "/2";
    $course_cat->theme = '';
    $catid1 = insert_record('course_categories', $course_cat);
    $catcontext = get_context_instance(CONTEXT_COURSECAT, $catid);
    mark_context_dirty($catcontext->path);

    $course_cat->name = get_string('leadership', 'local');
    $course_cat->sortorder = 999;
    $course_cat->visible = 1;
    $course_cat->path = "/3";
    $catid2 = insert_record('course_categories', $course_cat);
    $catcontext = get_context_instance(CONTEXT_COURSECAT, $lptempid);
    mark_context_dirty($catcontext->path);

    fix_course_sortorder(); //set paths correctly.

    // silent course restores:
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->dirroot.'/backup/lib.php');
    require_once($CFG->dirroot.'/backup/restorelib.php');

   if (file_exists($CFG->dirroot.'/local/defaultcoursebackups/inductioncourse.zip')) {
        $course = new StdClass;
        $course->fullname  = get_string('induction','local');
        $course->shortname = get_string('induction','local');
        $course->category = $catid1;
        if ($newcourse = create_course($course)) {
        import_backup_file_silently($CFG->dirroot.'/local/defaultcoursebackups/backup-presentation_skills-20091124-1116.zip', $newcourse->id, true, false, array(), RESTORETO_NEW_COURSE);
        }
    }

    // set up frontpage
    set_config('frontpage', '');
    set_config('frontpageloggedin', '');
    set_config('allowvisiblecoursesinhiddencategories', '1');

    rebuild_course_cache(SITEID);

    return true;

}


