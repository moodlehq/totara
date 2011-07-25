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
 * Handling new comments from non-js comments interface
 */
require_once('../../config.php');
require_once($CFG->dirroot . '/local/comment/lib.php');

$contextid = optional_param('contextid', SYSCONTEXTID, PARAM_INT);
list($context, $course, $cm) = get_context_info_array($contextid);

require_login($course, true, $cm);
require_sesskey();

$action    = optional_param('action',    '',     PARAM_ALPHA);
$area      = optional_param('area',      '',     PARAM_TEXT);
$commentid = optional_param('commentid', -1,     PARAM_INT);
$content   = optional_param('content',   '',     PARAM_RAW);
$itemid    = optional_param('itemid',    '',     PARAM_INT);
$returnurl = optional_param('returnurl', '',     PARAM_URL);
$component = optional_param('component', '', PARAM_TEXT);

$cmt = new stdClass();
$cmt->contextid = $contextid;
$cmt->courseid  = !empty($course) ? $course->id : SITEID;
$cmt->area      = $area;
$cmt->itemid    = $itemid;
$cmt->component = $component;
$comment = new comment($cmt);

switch ($action) {
case 'add':
    $cmt = $comment->add($content);
    if (!empty($cmt) && is_object($cmt)) {
        redirect($returnurl);
    }
    break;
default:
    exit;
}
