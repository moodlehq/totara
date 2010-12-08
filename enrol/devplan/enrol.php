<?php  // $Id$
       // Implements all the main code for the DevPlan plugin

require_once("$CFG->dirroot/enrol/enrol.class.php");


class enrolment_plugin_devplan {


/// Override the base print_entry() function
function print_entry($course) {
    global $CFG, $USER, $SESSION;


    $strloginto = get_string("loginto", "", $course->shortname);
    $strcourses = get_string("courses");

    $teacher = get_teacher($course->id);

    $navlinks = array();
    $navlinks[] = array('name' => $strcourses, 'link' => "$CFG->wwwroot/course", 'type' => 'misc');
    $navlinks[] = array('name' => $strloginto, 'link' => null, 'type' => 'misc');
    $navigation = build_navigation($navlinks);

    require_login();
    if ($USER->username == 'guest') { // force login only for guest user, not real users with guest role
        //people logged in as a guest of the site don't have a devplan, so they are not allowed to enrol
        $errorstring = get_string('guestnoenrol', 'enrol_devplan');
        print_error($errorstring);
        exit(0);
    }
    print_header($strloginto, $course->fullname, $navigation);
    print_course($course, "80%");
    print_simple_box_start("center");

    // * Take the user id & check their dp_plan status is DP_PLAN_STATUS_APPROVED with course assign approved
    $sql = 'SELECT dpp.id, dpp.status as planstatus, dppca.approved as courseapproval ' .
            'FROM ' . $CFG->prefix . 'dp_plan dpp' .
            ' INNER JOIN ' . $CFG->prefix . 'dp_plan_course_assign dppca on dppca.planid = dpp.id ' .
            'WHERE dppca.courseid = ' . $course->id .
            ' AND dpp.userid = ' . $USER->id;
    $devplan = get_record_sql($sql);
    if (!empty($devplan->planstatus) && !empty($devplan->courseapproval)) {
        require_once($CFG->dirroot . '/local/plan/lib.php');
        if (($devplan->planstatus == DP_PLAN_STATUS_APPROVED) && ($devplan->courseapproval == DP_APPROVAL_APPROVED)) {
            enrol_into_course($course, $USER, 'manual');
            load_all_capabilities();
            if (!empty($SESSION->wantsurl)) {
                $destination = $SESSION->wantsurl;
                unset($SESSION->wantsurl);
            } else {
                $destination = "$CFG->wwwroot/course/view.php?id=$course->id";
            }
            $message = get_string('nowenrolled', 'enrol_devplan', $course->fullname);
            $message .= '<br />' . get_string('redirectedsoon', 'enrol_devplan');
            print '<div class="plan_box plan_box_plain">' . $message . '</div>';
            redirect($destination, '', 1);
        }
    } else {
        // this isn't an approved course in their development plan or development plan isn't approved
        $message = 'You are not currently permitted to enrol in this course.<br />' .
                'To enrol you must have this course listed and fully approved in your ' .
                '<a href="' . $CFG->wwwroot . '/local/plan/index.php?userid=' . $USER->id . '">development plan</a>.<br />';
        if (!empty($course->guest)) {
            $destination = $CFG->wwwroot . '/course/view.php?id=' . $course->id;
            $message .= get_string('guestaccess', 'enrol_devplan', $destination);
        } else {
            $destination = $CFG->wwwroot;
        }
        print '<div class="plan_box plan_box_action">' . $message . '</div>';
        redirect($destination,'',5);
    }

    print_simple_box_end();

    print_footer();
    return 0;
}




/**
* Returns the relevant icons for a course
*
* @param    course  the current course, as an object
*/
function get_access_icons($course) {
    $str = '';
    return $str;
}


function config_form($frm) {
    global $CFG;
    include("$CFG->dirroot/enrol/devplan/config.html");
}

function process_config($config) {
    return true;
}
} // end of class definition
?>
