<?php
// Toggles the manual completion flag for a particular activity or course completion and the current
// user.

require_once('../config.php');
require_once($CFG->libdir.'/completionlib.php');

// Parameters
$cmid = optional_param('id', 0, PARAM_INT);
$courseid = optional_param('course', 0, PARAM_INT);
$confirm = optional_param('confirm', 0, PARAM_BOOL);

if (!$cmid && !$courseid) {
    print_error('invalidarguments');
}

// Process self completion
if ($courseid) {

    // Check user is logged in
    $course = get_record('course', 'id', $courseid);
    $context = get_context_instance(CONTEXT_COURSE, $course->id);
    require_login($course);

    $completion = new completion_info($course);

    // Check if we are marking a user complete via the completion report
    $user = optional_param('user', 0, PARAM_INT);
    $rolec = optional_param('rolec', 0, PARAM_INT);

    if ($user && $rolec) {
        require_sesskey();

        $criteria = completion_criteria::factory((object) array('id'=>$rolec, 'criteriatype'=>COMPLETION_CRITERIA_TYPE_ROLE));
        $criteria = completion_criteria_role::fetch(array('id' => $rolec));

        // Check the criteria exists
        if (!$criteria) {
            print_error('invalidarguments');
        }

        // Check the logged in user has this role
        $users = get_role_users($criteria->role, $context, true);
        if (!$users || !in_array($USER->id, array_keys($users))) {
            print_error('nopermissions');
        }

        $criteria_completions = $completion->get_completions($user, COMPLETION_CRITERIA_TYPE_ROLE);

        foreach ($criteria_completions as $criteria_completion) {
            if ($criteria_completion->criteriaid == $rolec) {
                $criteria->complete($criteria_completion);
                break;
            }
        }

        // Return to previous page
        if (!empty($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect('view.php?id='.$course->id);
        }

    } else {

        // Confirm with user
        if ($confirm && confirm_sesskey()) {
            $completion = $completion->get_completion($USER->id, COMPLETION_CRITERIA_TYPE_SELF);

            if (!$completion) {
                print_error('noselfcompletioncriteria', 'completion');
            }

            // Check if the user has already marked themselves as complete
            if ($completion->is_complete()) {
                print_error('useralreadymarkedcomplete', 'completion');
            }

            $completion->mark_complete();

            redirect($CFG->wwwroot.'/course/view.php?id='.$courseid);
            return;
        }

        $strconfirm = get_string('confirmselfcompletion', 'completion');
        print_header_simple($strconfirm, '', build_navigation(array(array('name' => $strconfirm, 'link' => '', 'type' => 'misc'))));
        notice_yesno($strconfirm, $CFG->wwwroot.'/course/togglecompletion.php?course='.$courseid.'&confirm=1&sesskey='.sesskey(), $CFG->wwwroot.'/course/view.php?id='.$courseid);
        print_simple_box_end();
        print_footer($course);
        exit;
    }
}

$targetstate=required_param('completionstate',PARAM_INT);
switch($targetstate) {
    case COMPLETION_COMPLETE:
    case COMPLETION_INCOMPLETE:
        break;
    default:
        print_error('unsupportedstate');
}
$fromajax=optional_param('fromajax',0,PARAM_INT);

function error_or_ajax($message) {
    global $fromajax;
    if($fromajax) {
        print get_string($message, 'error');
        exit;
    } else {
        print_error($message);
    }
}

// Get course-modules entry
if(!($cm = get_record('course_modules', 'id', $cmid))) {
    error_or_ajax('invalidactivityid');
}

if(!($course = get_record('course', 'id', $cm->course))) {
    error_or_ajax('invalidcourseid');
}

// Check user is logged in
require_login($course);

// Check completion state is manual
if($cm->completion!=COMPLETION_TRACKING_MANUAL) {
    error_or_ajax('cannotmanualctrack');
}

// Now change state
$completion=new completion_info($course);
$completion->update_state($cm,$targetstate);

// And redirect back to course
if($fromajax) {
    print 'OK';
} else {
    // In case of use in other areas of code we allow a 'backto' parameter,
    // otherwise go back to course page
    $backto=optional_param('backto','view.php?id='.$course->id,PARAM_URL);
    redirect($backto);
}
?>
