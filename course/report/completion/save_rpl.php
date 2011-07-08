<?php
/**
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
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage completion
 */

    require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');

    ///
    /// Parameters
    ///
    $type       = required_param('type', PARAM_RAW);
    $course_id  = required_param('course', PARAM_INT);
    $user_id    = required_param('user', PARAM_INT);
    $rpl        = optional_param('rpl', '', PARAM_RAW);

    // Non-js stuff
    $redirect   = optional_param('redirect', false, PARAM_BOOL);
    $sort       = optional_param('sort', '', PARAM_RAW);
    $start      = optional_param('start', '', PARAM_RAW);

    ///
    /// Load data
    ///
    if (!$course = get_record('course', 'id', $course_id)) {
        error('Course does not exist');
    }

    if (!$user = get_record('user', 'id', $user_id)) {
        error('User does not exist');
    }

    // Completion info object
    $info = new completion_info($course);

    // Get completion object
    $params = array(
        'userid'    => $user->id,
        'course'    => $course->id
    );

    // Completion
    if ($type == 'course') {
        // Load course completion
        $completion = new completion_completion($params);

    } elseif (is_numeric($type)) {
        // Load activity completion
        $params['criteriaid'] = (int)$type;
        $completion = new completion_criteria_completion($params);

    } else {
        error('Invalid type');
    }


    ///
    /// Check permissions
    ///
    require_login($course);

    $context = get_context_instance(CONTEXT_COURSE, $course->id);
    require_capability('coursereport/progress:view', $context);


    ///
    /// Check RPL is enabled
    ///
    if ($type == 'course') {
        $rpl_enabled = $CFG->enablecourserpl;
    } else {
        $criteria = $completion->get_criteria();
        $rpl_enabled = completion_module_rpl_enabled($criteria->module);
    }

    if (!$rpl_enabled) {
        print_error('error:rplsaredisabled', 'completion');
    }


    ///
    /// Complete user
    ///

    // Complete
    if (strlen($rpl)) {
        $completion->rpl = addslashes($rpl);
        $completion->mark_complete();

    // If no RPL, uncomplete user, and let aggregation do its thing
    } else {
        $completion->delete();
    }


    // Redirect, if requested (not an ajax request)
    if ($redirect) {
        header('Location: '.$CFG->wwwroot.'/course/report/completion/index.php?course='.$course_id.'&sort='.$sort.'&start='.$start);
        exit();
    }
