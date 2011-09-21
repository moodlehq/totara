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
 * @author Ben Lobo <ben@benlobo.co.uk>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->dirroot . '/local/program/lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');

require_login();

$userid = optional_param('userid', $USER->id, PARAM_INT); // show required learning for this user
$programid = optional_param('id', 0, PARAM_INT);

//
/// Permission checks
//
if (!prog_can_view_users_required_learning($userid)) {
    print_error('error:nopermissions', 'local_program');
}

// Check if we are viewing the required learning as a manager or a learner
if ($userid != $USER->id) {
    $role = 'manager';
} else {
    $role = 'learner';
}

if ($programid) {
    $program = new program($programid);
    if ($program->is_accessible()) {

        //Javascript include
        local_js(array(
            TOTARA_JS_DIALOG,
            TOTARA_JS_TREEVIEW
        ));

        // Get item pickers
        require_js(array(
            $CFG->wwwroot . '/local/program/view/program_view.js.php?id=' . $program->id
        ));


        ///
        /// Display
        ///

        $heading = $program->fullname;
        $pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
        $navlinks = array();
        prog_get_required_learning_base_navlinks($navlinks, $userid);
        $navlinks[] = array('name' => $heading, 'link'=> '', 'type'=>'title');
        $navigation = build_navigation($navlinks);

        print_header_simple($pagetitle, '', $navigation, '', null, true, '');

        echo dp_display_plans_menu($userid, 0 , $role, 'courses', 'none', true, $program->id, true);

        // Program page content
        print_container_start(false, '', 'program-content');

        print_heading($heading);

        echo $program->display($userid);

        print_container_end();

        print_footer();
    } else {
        // If the program is not accessible then print heading
        // and unavailiable message

        $heading = $program->fullname;
        $pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
        $navlinks = array();
        prog_get_required_learning_base_navlinks($navlinks, $userid);
        $navlinks[] = array('name' => $heading, 'link'=> '', 'type'=>'title');
        $navigation = build_navigation($navlinks);

        print_header_simple($pagetitle, '', $navigation, '', null, true, '');

        print_heading($heading);

        echo '<p>' . get_string('programnotcurrentlyavailable', 'local_program') . '</p>';

        print_footer();
    }
} else {
    //
    // Display program list
    //

    $heading = get_string('requiredlearning', 'local_program');
    $pagetitle = format_string(get_string('requiredlearning','local_program'));
    $navlinks = array();
    prog_get_required_learning_base_navlinks($navlinks, $userid);
    $navigation = build_navigation($navlinks);
    print_header($heading, $pagetitle, $navigation);

    // Plan menu
    echo dp_display_plans_menu($userid, 0, $role, 'courses', 'none');

    // Required learning page content
    print_container_start(false, '', 'required-learning');

    if($userid != $USER->id) {
        echo prog_display_user_message_box($userid);
    }

    print_heading($heading);

    print_container_start(false, '', 'required-learning-description');

    if($userid == $USER->id) {
        $requiredlearninginstructions = '<div class="instructional_text">' . get_string('requiredlearninginstructions', 'local_program') . '</div>';
        add_to_log(SITEID, 'program', 'view required', "required.php?userid={$userid}");
    } else {
        $user = get_record('user', 'id', $userid);
        $userfullname = fullname($user);
        $requiredlearninginstructions = '<div class="instructional_text">' . get_string('requiredlearninginstructionsuser', 'local_program', $userfullname) . '</div>';
        add_to_log(SITEID, 'program', 'view required', "required.php?userid={$userid}", $userfullname);
    }

    echo $requiredlearninginstructions;

    echo '<div style="clear:both;"></div>';
    print_container_end();

    print_container_start(false, '', 'required-learning-list');

    $requiredlearninghtml = prog_display_required_programs($userid);

    if (empty($requiredlearninghtml)) {
        echo get_string('norequiredlearning', 'local_program');
    } else {
        echo $requiredlearninghtml;
    }

    print_container_end();
    print_container_end();
    print_footer();
}
