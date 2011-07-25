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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Dongsheng Cai <dongsheng@moodle.com>
 * @package totara
 * @subpackage comment
 */

/*
 * Handling all ajax request for comments API
 */
define('AJAX_SCRIPT', true);

require_once('../../config.php');
require_once($CFG->dirroot . '/local/comment/lib.php');


// Needed for older versions of PHP io to utilise json_encode/json_decode
require_once($CFG->libdir.'/pear/HTML/AJAX/JSON.php');

$contextid = optional_param('contextid', SYSCONTEXTID, PARAM_INT);
list($context, $course, $cm) = get_context_info_array($contextid);

//$PAGE->set_context($context);
//$PAGE->set_url('/local/comment/comment_ajax.php');

$action = optional_param('action', '', PARAM_ALPHA);

if (!confirm_sesskey()) {
    $error = array('error'=>get_string('invalidsesskey'));
    die(json_encode($error));
}

if (!isloggedin()) {
    // display comments on front page without permission check
    if ($action == 'get') {
        if ($context->id == get_context_instance(CONTEXT_COURSE, SITEID)->id) {
            $ignore_permission = true;
        } else {
            // tell user to log in to view comments
            $ignore_permission = false;
            echo json_encode(array('error'=>'require_login'));
            die;
        }
    } else {
        // ignore request
        die;
    }
} else {
    $ignore_permission = false;
}

$area      = optional_param('area',      '', PARAM_TEXT);
$client_id = optional_param('client_id', '', PARAM_RAW);
$commentid = optional_param('commentid', -1, PARAM_INT);
$content   = optional_param('content',   '', PARAM_RAW);
$itemid    = optional_param('itemid',    '', PARAM_INT);
$page      = optional_param('page',      0,  PARAM_INT);
$commentsperpage = optional_param('commentsperpage', empty($CFG->commentsperpage) ? 15 : $CFG->commentsperpage,  PARAM_INT);
$component = optional_param('component', '',  PARAM_TEXT);

$ajax = optional_param('ajax', 1, PARAM_BOOL);

//echo $OUTPUT->header(); // send headers

// initialising comment object
if (!empty($client_id)) {
    $args = new stdClass();
    $args->context   = $context;
    $args->course    = $course;
    $args->cm        = $cm;
    $args->area      = $area;
    $args->itemid    = $itemid;
    $args->client_id = $client_id;
    $args->component = $component;
    $args->commentsperpage = $commentsperpage;
    // only for comments in frontpage
    $args->ignore_permission = $ignore_permission;
    $manager = new comment($args);
} else {
    die;
}

// process ajax request
switch ($action) {
    case 'add':
        $result = $manager->add($content);
        if (!empty($result) && is_object($result)) {
            $result->count = $manager->count();
            $result->client_id = $client_id;
            echo json_encode($result);
        }
        break;
    case 'delete':
        $result = $manager->delete($commentid);
        if ($result === true) {
            if ($ajax) {
                echo json_encode(array('client_id'=>$client_id, 'commentid'=>$commentid, 'count'=>$manager->count()));
            } else {
                redirect(get_referer($stripquery=false));
            }
        }
        break;
    case 'get':
    default:
        $result = array();
        $comments = $manager->get_comments($page);
        $result['list'] = $comments;
        $result['count'] = $manager->count();
        $result['pagination'] = $manager->get_pagination($page);
        $result['client_id']  = $client_id;
        echo json_encode($result);
}
