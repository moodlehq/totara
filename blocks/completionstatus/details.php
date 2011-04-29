<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Block for displayed logged in user's course completion status
 *
 * @package   moodlecore
 * @copyright 2009 Catalyst IT Ltd
 * @author    Aaron Barnes <aaronb@catalyst.net.nz>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once('../../config.php');


///
/// Load data
///
$id = required_param('course', PARAM_INT);
// User id
$userid = optional_param('user', 0, PARAM_INT);

// Load course
$course = get_record('course', 'id', $id);

// Load user
if ($userid) {
    if (!$user = get_record('user', 'id', $userid)) {
        error('User ID incorrect');
    }
} else {
    $user = $USER;
}


// Check permissions
if (!completion_can_view_data($user->id, $course->id)) {
    print_error('cannotviewreport', 'block_completionstatus');
}


// Load completion data
$info = new completion_info($course);

$returnurl = "{$CFG->wwwroot}/course/view.php?id={$id}";
if (!$info->is_enabled()) {
    print_error('completionnotenabled', 'completion', $returnurl);
}

// Load criteria to display
$completions = $info->get_completions($user->id);

// Check if this course has any criteria
if (empty($completions)) {
    print_error('err_nocriteria', 'completion', $returnurl);
}

// Check this user is enroled
if (!$info->is_tracked_user($user->id)) {
    if ($USER->id == $user->id) {
        print_error('notenroled', 'completion', $returnurl);
    }
    else {
        print_error('usernotenroled', 'completion', $returnurl);
    }
}


///
/// Display page
///

// Print header
$page = get_string('completionprogressdetails', 'block_completionstatus');
$title = format_string($course->fullname) . ': ' . $page;

$navlinks[] = array('name' => $page, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);

print_header($title, $title, $navigation);
print_heading($title);


// Display completion status
echo '<table class="generalbox boxaligncenter"><tbody>';

// If not display logged in user, show user name
if ($USER->id != $user->id) {
    echo '<tr><td colspan="2"><b>'.get_string('showinguser', 'completion').'</b>: ';
    echo '<a href="'.$CFG->wwwroot.'/user/view.php?id='.$user->id.'&course='.$course->id.'">'.fullname($user).'</a>';
    echo '</td></tr>';
}

echo '<tr><td colspan="2"><b>'.get_string('status').':</b> ';

// Is course complete?
$coursecomplete = $info->is_course_complete($user->id);

// Has this user completed any criteria?
$criteriacomplete = $info->count_course_user_data($user->id);

// Load course completion
$params = array(
    'userid' => $user->id,
    'course' => $course->id,
);
$ccompletion = new completion_completion($params);

if ($coursecomplete) {
    echo get_string('complete');

    // Check for RPL
    if (strlen($ccompletion->rpl)) {
        echo ' '.get_string('viarpl', 'completion');
    }

} else if (!$criteriacomplete && !$ccompletion->timestarted) {
    echo '<i>'.get_string('notyetstarted', 'completion').'</i>';
} else {
    echo '<i>'.get_string('inprogress','completion').'</i>';
}

echo '</td></tr>';

// Show RPL
if (isset($ccompletion) && strlen($ccompletion->rpl)) {
    echo '<tr><td colspan="2"><b>Course RPL:</b> '.format_string($ccompletion->rpl).'</td></tr>';
}

echo '<tr><td colspan="2"><b>'.get_string('required').':</b> ';

// Get overall aggregation method
$overall = $info->get_aggregation_method();

if ($overall == COMPLETION_AGGREGATION_ALL) {
    echo get_string('criteriarequiredall', 'completion');
} else {
    echo get_string('criteriarequiredany', 'completion');
}

echo '</td></tr></tbody></table>';

// Generate markup for criteria statuses
echo '<table class="generalbox logtable boxaligncenter" id="criteriastatus" width="100%"><tbody>';
echo '<tr class="ccheader">';
echo '<th class="c0 header" scope="col">'.get_string('criteriagroup', 'block_completionstatus').'</th>';
echo '<th class="c1 header" scope="col">'.get_string('criteria', 'completion').'</th>';
echo '<th class="c2 header" scope="col">'.get_string('requirement', 'block_completionstatus').'</th>';
echo '<th class="c3 header" scope="col">'.get_string('status').'</th>';
echo '<th class="c4 header" scope="col">'.get_string('complete').'</th>';
echo '<th class="c5 header" scope="col">'.get_string('completiondate', 'coursereport_completion').'</th>';
echo '</tr>';

// Save row data
$rows = array();

global $COMPLETION_CRITERIA_TYPES;

// Loop through course criteria
foreach ($completions as $completion) {
    $criteria = $completion->get_criteria();
    $complete = $completion->is_complete();

    $row = array();
    $row['type'] = $criteria->criteriatype;
    $row['title'] = $criteria->get_title();
    $row['status'] = $completion->get_status();
    $row['timecompleted'] = $completion->timecompleted;
    $row['details'] = $criteria->get_details($completion);
    $rows[] = $row;
}

// Print table
$last_type = '';
$agg_type = false;
$oddeven = 0;

foreach ($rows as $row) {

    echo '<tr class="r' . $oddeven . '">';

    // Criteria group
    echo '<td class="cell c0">';
    if ($last_type !== $row['details']['type']) {
        $last_type = $row['details']['type'];
        echo $last_type;

        // Reset agg type
        $agg_type = true;
    } else {
        // Display aggregation type
        if ($agg_type) {
            $agg = $info->get_aggregation_method($row['type']);

            echo '(<i>';

            if ($agg == COMPLETION_AGGREGATION_ALL) {
                echo strtolower(get_string('all', 'completion'));
            } else {
                echo strtolower(get_string('any', 'completion'));
            }

            echo '</i> '.strtolower(get_string('required')).')';
            $agg_type = false;
        }
    }
    echo '</td>';

    // Criteria title
    echo '<td class="cell c1">';
    echo $row['details']['criteria'];
    echo '</td>';

    // Requirement
    echo '<td class="cell c2">';
    echo $row['details']['requirement'];
    echo '</td>';

    // Status
    echo '<td class="cell c3">';
    echo $row['details']['status'];
    echo '</td>';

    // Is complete
    echo '<td class="cell c4">';
    echo ($row['status'] === 'Yes') ? 'Yes' : 'No';
    echo '</td>';

    // Completion data
    echo '<td class="cell c5">';
    if ($row['timecompleted']) {
        echo userdate($row['timecompleted'], '%e %B %G');
    } else {
        echo '-';
    }
    echo '</td>';
    echo '</tr>';
    // for row striping
    $oddeven = $oddeven ? 0 : 1;
}

echo '</tbody></table>';

print_footer($course);
