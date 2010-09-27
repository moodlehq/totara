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
 * @copyright  Totara Learning Solutions Limited
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package    totara
 * @subpackage local
 *
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/local/totara.php');

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

    totara_reset_frontpage_blocks();
    totara_add_guide_block_to_adminpages();

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
 *  * Resize an image to fit within the given rectange, maintaing aspect ratio
 *
 * @param string Path to image
 * @param string Destination file - without file extention
 * @param int Width to resize to
 * @param int Height to resize to
 * @param string Force image to this format
 *
 * @global $CFG
 * @return string Path to new file else false
 */
function resize_image($originalfile, $destination, $newwidth, $newheight, $forcetype = false) {
    global $CFG;

    require_once($CFG->libdir.'/gdlib.php');

    if(!(is_file($originalfile))) {
        return false;
    }

    if (empty($CFG->gdversion)) {
        return false;
    }

    $imageinfo = GetImageSize($originalfile);
    if (empty($imageinfo)) {
        return false;
    }

    $image = new stdClass;

    $image->width  = $imageinfo[0];
    $image->height = $imageinfo[1];
    $image->type   = $imageinfo[2];

    $ratiosrc = $image->width / $image->height;

    if ($newwidth/$newheight > $ratiosrc) {
        $newwidth = $newheight * $ratiosrc;
    } else {
        $newheight = $newwidth / $ratiosrc;
    }

    switch ($image->type) {
    case IMAGETYPE_GIF:
        if (function_exists('ImageCreateFromGIF')) {
            $im = ImageCreateFromGIF($originalfile);
            $outputformat = 'png';
        } else {
            notice('GIF not supported on this server');
            return false;
        }
        break;
    case IMAGETYPE_JPEG:
        if (function_exists('ImageCreateFromJPEG')) {
            $im = ImageCreateFromJPEG($originalfile);
            $outputformat = 'jpeg';
        } else {
            notice('JPEG not supported on this server');
            return false;
        }
        break;
    case IMAGETYPE_PNG:
        if (function_exists('ImageCreateFromPNG')) {
            $im = ImageCreateFromPNG($originalfile);
            $outputformat = 'png';
        } else {
            notice('PNG not supported on this server');
            return false;
        }
        break;
    default:
        return false;
    }

    if ($forcetype) {
        $outputformat = $forcetype;
    }

    $destname = $destination.'.'.$outputformat;

    if (function_exists('ImageCreateTrueColor') and $CFG->gdversion >= 2) {
        $im1 = ImageCreateTrueColor($newwidth,$newheight);
    } else {
        $im1 = ImageCreate($newwidth, $newheight);
    }
    ImageCopyBicubic($im1, $im, 0, 0, 0, 0, $newwidth, $newheight, $image->width, $image->height);

    switch($outputformat) {
    case 'jpeg':
        imagejpeg($im1, $destname, 90);
        break;
    case 'png':
        imagepng($im1, $destname, 9);
        break;
    default:
        return false;
    }
    return $destname;
}


/**
 * Get list of stock course icons
 *
 * @return array
 */
function local_get_stock_icons($type) {
    global $CFG;
    $icons = array('none' => get_string('none', 'local'));

    if ($path = local_get_stock_icon_dir($type)) {
        $d = dir($path.'/large');
        while(($icon = $d->read()) !== false) {
            if (is_file($path.'/large/'.$icon)) {

                $icons[$icon] = ucwords(strtr($icon, array('_' => ' ', '-' => ' ', '.png' => '')));
            }
        }
        $d->close();
    }
    return($icons);
}


/**
 * Return the path to the course icon directory
 *
 * @global $CFG
 * @return string
 */
function local_get_stock_icon_dir($type) {
    global $CFG;

    if ($type == 'course') {
        $dir = 'courseicons';
    } elseif ($type == 'coursecategory') {
        $dir = 'coursecategoryicons';
    } else {
        return(false);
    }

    if (is_dir($CFG->themedir.'/'.$CFG->theme.'/'.$dir)) {
        return($CFG->themedir.'/'.$CFG->theme.'/'.$dir);
    } else if (is_dir($CFG->themedir.'/standard/'.$dir)) {
        return($CFG->themedir.'/standard/'.$dir);
    }
    else {
        return(false);
    }
}




/**
 * Update course icon
 *
 * @param object $course Course object
 * @param object $data Formslib form data
 * @param object $mform Moodle form
 * @global $CFG
 */
function local_update_course_icon($course, $data, &$mform) {
    global $CFG;

    $updatecourse = new stdClass;
    $updatecourse->id = $course->id;

    if ($data->icon == 'none') {
        $updatecourse->icon = '';
    } else {
        $updatecourse->icon = $data->icon;
    }

    update_record('course', $updatecourse);
}


/**
 * hook to add extra sticky-able page types.
 */
function local_get_sticky_pagetypes() {
    return array(
        // not using a constant here because we're doing funky overrides to PAGE_COURSE_VIEW in the learning path format
        // and it clobbers the page mapping having them both defined at the same time
        'Totara' => array(
            'id' => 'Totara',
            'lib' => '/local/lib.php',
            'name' => 'Totara'
        ),
    );
}


/*
 * Update course icon
 *
 * @param object $course Course object
 * @param object $data Formslib form data
 * @param object $mform Moodle form
 * @global $CFG
 */
function local_update_coursecategory_icon($coursecategory, $data, &$mform) {
    global $CFG;

    $site = get_site();

    $updatecoursecat = new stdClass;
    $updatecoursecat->id = $coursecategory->id;

    if ($data->icon == 'custom') {
        //Move icon to course
        $updatecoursecat->icon = 'custom';

        $dest = $CFG->dataroot.'/'.$site->id.'/icons/coursecategory/';
        make_upload_directory($dest);
        $mform->save_files($dest);

        if ($filename =  $mform->get_new_filename()) {
            resize_image($dest.$filename, $dest.'large', 64, 64, 'png');
            resize_image($dest.$filename, $dest.'small', 16, 16, 'png');
            unlink($dest.$filename);
        }

    } elseif ($data->icon == 'none') {
        $updatecoursecat->icon = '';
    } else {
        $updatecoursecat->icon = $data->icon;
    }
    update_record('course_categories', $updatecoursecat);
}


/**
 * Send icon data
 *
 * @param int $courseid Course id
 * @param string $courseicon Name of icon to send
 * @param string $size Icon size to send
 * @global $CFG
 */
function local_output_course_icon($courseid, $courseicon, $size='large') {
    global $CFG;

    $icondir = local_get_stock_icon_dir('course');
    $iconname = 'default.png';
    $icon = $icondir.'/'.$size.'/default.png';

    if ($courseicon == 'custom') {
        if (is_file($CFG->dataroot.'/'.$courseid.'/icons/'.$size.'.png')) {
            $icon = $CFG->dataroot.'/'.$courseid.'/icons/'.$size.'.png';
            $iconname = 'customicon.png';
        }
    } else {
        if (is_file($icondir.'/'.$size.'/'.$courseicon)) {
            $icon = $icondir.'/'.$size.'/'.$courseicon;
            $iconname = $courseicon;
        }
    }
    send_file($icon, $iconname);
}


/**
 * Send course cateogry icon data
 *
 * @param string $courseicon Name of icon to send
 * @param string $size Icon size to send
 * @global $CFG
 */
function local_output_coursecategory_icon($iconname, $size='large') {
    global $CFG;

    $site = get_site();

    $icondir = local_get_stock_icon_dir('coursecategory');
    $iconpath = 'default.png';
    $icon = $icondir.'/'.$size.'/default.png';

    if ($iconname == 'custom') {
        if (is_file($CFG->dataroot.'/'.$site->id.'/icons/coursecategory/'.$size.'.png')) {
            $icon = $CFG->dataroot.'/'.$site->id.'/icons/coursecategory/'.$size.'.png';
            $iconpath = 'customicon.png';
        }
    } else {
        if (is_file($icondir.'/'.$size.'/'.$iconname)) {
            $icon = $icondir.'/'.$size.'/'.$iconname;
        }
        $iconpath = $iconname;
    }
    send_file($icon, $iconname);
}



/**
 * Return img tag to a course icon
 *
 * @param object $course Course object
 * @param string $size Size of icon set to use
 * @global $CFG
 * @global $COURSE
 * @return string img tag
 */
function local_course_icon_tag($course=null, $size='large') {
    global $CFG, $COURSE;
    if (!isset($course)) {
        $course = $COURSE;
    }
    else {
        if (!isset($course->icon)) {
            $course->icon = get_field('course', 'icon', 'id', $course->id);
        }
    }
    return '<img src="'.$CFG->wwwroot.'/local/icon.php?id='.$course->id.'&amp;icon='.$course->icon.'&amp;size='.$size.'&type=course" alt="'.$course->shortname.'" class="course_icon" />';
}

/**
 * Return img tag to a course category icon
 *
 * @param object $coursecat Course category object
 * @param string $size Size of icon set to use
 * @global $CFG
 * @global $COURSE
 * @return string img tag
 */
function local_coursecategory_icon_tag($coursecat, $size='large') {
    global $CFG;
    if (!isset($coursecat)) {
        $coursecat->icon = get_field('course_categories', 'icon', 'id', $coursecat);
    }
    return '<img src="'.$CFG->wwwroot.'/local/icon.php?icon='.$coursecat->icon.'&amp;size='.$size.'&type=coursecategory" class="course_icon" />';
}

/**
 * Determine if the current request is an ajax request
 *
 * @param array $server A $_SERVER array
 * @return boolean
 */
function is_ajax_request($server) {
    return (isset($server['HTTP_X_REQUESTED_WITH']) && strtolower($server['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}


?>
