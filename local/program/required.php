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

$learnerid = optional_param('userid', $USER->id, PARAM_INT); // show required learning for this user
$programid = optional_param('id', 0, PARAM_INT);
$extensionrequest = optional_param('extrequest', false, PARAM_BOOL);

//
/// Permission checks
//
if (!prog_can_view_users_required_learning($learnerid)) {
    print_error('error:nopermissions', 'local_program');
}

// Check if we are viewing the required learning as a manager or a learner
if ($learnerid != $USER->id) {
    $role = 'manager';
} else {
    $role = 'learner';
}

if ($programid) {
    $program = new program($programid);
    if (!$program->is_accessible($USER)) {
        $program->display_access_error();
    }

    // A string to contain the HTML to display the extension request form if required
    $extensionrequest_html = '';

    // Generate the HTML for a form to request an extension or process an extension request
    if($extensionrequest) {

        $extensiondate = optional_param('extdate', false, PARAM_TEXT);
        $extensionreason = optional_param('extreason', false, PARAM_TEXT);

        if($extensiondate && $extensionreason) {

            if( ! $manager = totara_get_manager($USER->id)) {
                totara_set_notification(get_string('extensionrequestfailed:nomanager', 'local_program'), 'required.php?id='.$program->id.'&amp;userid='.$learnerid);
            } else {

                $timearray = explode('/', $extensiondate);
                $day = $timearray[0];
                $month = $timearray[1];
                $year = $timearray[2];
                $extensiontime = mktime(0, 0, 0, $month, $day, $year);

                $exceptionsmanager = $program->get_exceptionsmanager();

                $exceptiondata = array(
                    'extensiondate'         => $extensiontime,
                    'extensiondatestr'      => $extensiondate,
                    'extensionreason'       => $extensionreason,
                    'programfullname'       => format_string($program->fullname)
                );

                if($exceptionsmanager->raise_exception(EXCEPTIONTYPE_EXTENSION_REQUEST, $learnerid, 0, time(), $exceptiondata)) {

                    $extension_message = new prog_extension_request_message($program->id);
                    $managermessagedata = $extension_message->get_manager_message_data();
                    $managermessagedata->subject = get_string('extensionrequest', 'local_program');
                    $managermessagedata->fullmessage = stripslashes(get_string('extensionrequestmessage', 'local_program', (object)$exceptiondata));

                    if( $extension_message->send_message($manager, $USER)) {
                        totara_set_notification(get_string('extensionrequestsent', 'local_program'), 'required.php?id='.$program->id.'&amp;userid='.$learnerid, array('style' => 'notifysuccess'));
                    } else {
                        totara_set_notification(get_string('extensionrequestnotsent', 'local_program'), 'required.php?id='.$program->id.'&amp;userid='.$learnerid);
                    }

                } else {
                    totara_set_notification(get_string('extensionrequestfailed', 'local_program'), 'required.php?id='.$program->id.'&amp;userid='.$learnerid);
                }
            }

        } else {
            $extensionrequest_html = '<form method="post" action="">';
            $extensionrequest_html .= '<label>Date (dd/mm/yyyy):</label> ';
            $extensionrequest_html .= '<input type="text" name="extdate" value="" />';
            $extensionrequest_html .= '<label>Reason:</label> ';
            $extensionrequest_html .= '<input type="text" name="extreason" value="" />';
            $extensionrequest_html .= '<input type="hidden" name="id" value="'.$program->id.'" />';
            $extensionrequest_html .= '<input type="hidden" name="userid" value="'.$learnerid.'" />';
            $extensionrequest_html .= '<input type="hidden" name="extrequest" value="1" />';
            $extensionrequest_html .= '<input type="submit" name="submit" value="Request extension" />';
            $extensionrequest_html .= '</form>';
        }

    }

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
    $program = new program($programid);
    if (!$program->is_accessible($USER)) {
        $program->display_access_error();
    }

    $heading = $program->fullname;
    $pagetitle = format_string(get_string('program', 'local_program').': '.$heading);
    $navlinks = array();
    prog_get_required_learning_base_navlinks($navlinks, $learnerid);
    $navlinks[] = array('name' => $heading, 'link'=> '', 'type'=>'title');
    $navigation = build_navigation($navlinks);

    print_header_simple($pagetitle, '', $navigation, '', null, true, '');

    echo dp_display_plans_menu($learnerid, 0 , $role, 'courses', 'none', true, $program->id, true);

    // Program page content
    print_container_start(false, '', 'program-content');

    print_heading($heading);

    echo $extensionrequest_html;

    echo $program->display($learnerid);

    print_container_end();

    print_footer();


} else {
    //
    // Display program list
    //

    $heading = get_string('requiredlearning', 'local_program');
    $pagetitle = format_string(get_string('requiredlearning','local_program'));
    $navlinks = array();
    prog_get_required_learning_base_navlinks($navlinks, $learnerid);
    $navigation = build_navigation($navlinks);
    print_header($heading, $pagetitle, $navigation);

    // Plan menu
    echo dp_display_plans_menu($learnerid, 0, $role, 'courses', 'none');

    // Required learning page content
    print_container_start(false, '', 'required-learning');

    if($learnerid != $USER->id) {
        echo prog_display_user_message_box($learnerid);
    }

    print_heading($heading);

    print_container_start(false, '', 'required-learning-description');

    if($learnerid == $USER->id) {
        $requiredlearninginstructions = '<div class="instructional_text">' . get_string('requiredlearninginstructions', 'local_program') . '</div>';
        add_to_log(SITEID, 'program', 'view required', "required.php?userid={$learnerid}");
    } else {
        $user = get_record('user', 'id', $learnerid);
        $userfullname = fullname($user);
        $requiredlearninginstructions = '<div class="instructional_text">' . get_string('requiredlearninginstructionsuser', 'local_program', $userfullname) . '</div>';
        add_to_log(SITEID, 'program', 'view required', "required.php?userid={$learnerid}", $userfullname);
    }

    echo $requiredlearninginstructions;

    echo '<div style="clear:both;"></div>';
    print_container_end();

    print_container_start(false, '', 'required-learning-list');

    $requiredlearninghtml = prog_display_programs($learnerid);

    if (empty($requiredlearninghtml)) {
        echo get_string('norequiredlearning', 'local_program');
    } else {
        echo $requiredlearninghtml;
    }

    print_container_end();
    print_container_end();
    print_footer();
}
