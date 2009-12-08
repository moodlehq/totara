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
    $course_cat->sortorder = 2;
    $course_cat->coursecount = 0;
    $course_cat->visible = 1;
    $course_cat->timemodified = time();
    $course_cat->depth = 1;
    $course_cat->path = "''";
    $course_cat->theme = '';
    $catid1 = insert_record('course_categories', $course_cat);
    $catcontext = get_context_instance(CONTEXT_COURSECAT, $catid);
    mark_context_dirty($catcontext->path);

    $course_cat->name = get_string('leadership', 'local');
    $course_cat->sortorder = 3;
    $course_cat->visible = 1;
    $catid2 = insert_record('course_categories', $course_cat);
    $catcontext = get_context_instance(CONTEXT_COURSECAT, $lptempid);
    mark_context_dirty($catcontext->path);

    fix_course_sortorder(); //set paths correctly.

    // silent course restores:
    require_once($CFG->dirroot.'/course/lib.php');
    require_once($CFG->dirroot.'/backup/lib.php');
    require_once($CFG->dirroot.'/backup/restorelib.php');

    $zips = get_course_backups($CFG->dirroot.'/local/defaultcoursebackups');

    foreach($zips as $zip) {
        if(file_exists($zip['filename'])) {
            $course = new StdClass;
            $course->fullname = $zip['fullname'];
            $course->shortname = $zip['shortname'];
            $course->category = 1; // Miscellaneous
            print "Trying to create course \"{$zip['fullname']}\" ({$zip['shortname']}) ID={$zip['courseid']}\n";
            // check if the ID we want to use is already a course
            if(course_exists($zip['courseid'])) {
                print "Error: Course ID already in use. Not restoring course";
            } else {
                if ($newcourse = create_course($course)) {
                    // rewrite the courseid that is created to use 
                    // the one we want. If that ID is already in use, 
                    // prints an error and returns false
                    //if(rewrite_course_id($newcourse->id, $zip['courseid'])) {
                        import_backup_file_silently($zip['filename'], $zip['courseid'], true, false, array(), RESTORETO_NEW_COURSE);
                    //}
                }
            }
        }
    }



    /*
    if (file_exists($CFG->dirroot.'/local/defaultcoursebackups/inductioncourse.zip')) {
        $course = new StdClass;
        $course->fullname  = get_string('induction','local');
        $course->shortname = get_string('induction','local');
        $course->category = $catid1;
        if ($newcourse = create_course($course)) {
        import_backup_file_silently($CFG->dirroot.'/local/defaultcoursebackups/backup-presentation_skills-20091124-1116.zip', $newcourse->id, true, false, array(), RESTORETO_NEW_COURSE);
        }
    }
     */
    // set up frontpage
    set_config('frontpage', '');
    set_config('frontpageloggedin', '');
    set_config('allowvisiblecoursesinhiddencategories', '1');

    rebuild_course_cache(SITEID);

    return true;

}

function rewrite_course_id($oldid, $newid) {
    set_field('course','id',$newid,'id',$oldid);
    set_field('course_sections','id',$newid,'id',$oldid);

    return true;
}


function course_exists($id) {
    if(get_record('course','id', $id)) {
        return true;
    } else {
        return false;
    }
}




/**
 * Given a directory, returns an array of course zip files which match
 * the format [shortname]===[fullname]===[courseid].zip
 * 
 * Components are parse and returned as associative array. If no matching
 * zip files found, returns an empty array
 *
 * @param string $backupdir Directory to search
 * @return array Associative array of filename, shortname, fullname, courseid 
**/
function get_course_backups($backupdir) {

    $ret = array();
    if (is_dir($backupdir)) {
        if ($dh = opendir($backupdir)) {
            while (($file = readdir($dh)) !== false) {
                // exclude directories
                if (is_dir($file)) {
                    continue;
                }
                // not a zip
                if (substr($file, -4) != '.zip') {
                    continue;
                }

                // remove .zip extension
                $filename = substr($file, 0, -4);

                // split name
                list($shortname, $fullname, $courseid) = explode("===", $filename);

                // filename isn't in expected format of:
                // [shortname]===[fullname]===[courseid].zip
                if(!$shortname || !$fullname || !$courseid) {
                    continue;
                }
                $row = array();
                $row['filename'] = $backupdir."/".$file;
                $row['shortname'] = $shortname;
                $row['fullname'] = $fullname;
                $row['courseid'] = (int) $courseid;
                $ret[] = $row;
            }
            closedir($dh);
        }
    }
    return $ret;

}


