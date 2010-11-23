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
 * @subpackage totara
 * @author     Piers Harding
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * Displays collaborative features for the current user
 *
 */

    require_once('../../config.php');
    require_once($CFG->dirroot.'/local/reportbuilder/lib.php');
    require_once($CFG->dirroot.'/local/reportheading/lib.php');

    // initialise jquery requirements
    require_once($CFG->dirroot.'/local/js/lib/setup.php');

    require_login();

    global $SESSION,$USER;

    $format = optional_param('format', '',PARAM_TEXT); //export format
    $roleid = optional_param('roleid', null,PARAM_INT); //roleid limiter

    // default to current user
    $id = $USER->id;

    $context = get_context_instance(CONTEXT_SYSTEM);
    // users can only view their own and their staff's pages
    // or if they are an admin
    if ($USER->id != $id && !totara_is_manager($id) && !has_capability('moodle/site:doanything',$context)) {
        error('You cannot view this page');
    }
    $strheading = get_string('reminders', 'local_totara_msg');

    $embed = new object();
    $embed->source = 'totaramessages';
    $embed->fullname = $strheading;
    $embed->filters = array(
        array(
                'type' => 'user',
                'value' => 'fullname',
                'advanced' => 1,
            ),
        array(
                'type' => 'message_values',
                'value' => 'msgtype',
                'advanced' => 0,
            ),
        array(
                'type' => 'message_values',
                'value' => 'msgstatus',
                'advanced' => 1,
            ),
        array(
                'type' => 'message_values',
                'value' => 'statement',
                'advanced' => 1,
            ),
        array(
                'type' => 'message_values',
                'value' => 'sent',
                'advanced' => 1,
            ),
    );
    $embed->columns = array(
        array(
            'type' => 'message_values',
            'value' => 'msgstatus',
            'heading' => 'Status',
        ),
        array(
            'type' => 'message_values',
            'value' => 'msgtype',
            'heading' => 'Type',
        ),
        array(
            'type' => 'user',
            'value' => 'namelink',
            'heading' => 'Name',
        ),
        array(
            'type' => 'message_values',
            'value' => 'statement',
            'heading' => 'Details',
        ),
            array(
            'type' => 'message_values',
            'value' => 'sent',
            'heading' => 'Sent',
        ),
            array(
            'type' => 'message_values',
            'value' => 'reminder_links',
//            'heading' => 'Actions &nbsp;',
            'heading' =>
                         '<div id="totara_msg_selects" style="display: none;">'.
                         '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 1); return false;">all</a>/'.
                         '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 0); return false;">none</a>',
//                         '</div><noscript>Actions</noscript>',
        ),
//            array(
//            'type' => 'message_values',
//            'value' => 'checkbox',
//            'heading' => '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 1); return false;">all</a>/'.
//                         '<a href="" onclick="jqCheckAll(\'totara_messages\', \'totara_message\', 0); return false;">none</a>',
//        ),
    );
    $embed->contentmode = 0;
    $embed->embeddedparams = array(
        // show report for a specific user - see hardcoded filters
        'userid' => $id,
        'name' => '\'totara_reminder\'',
    );
    if ($roleid) {
        $embed->embeddedparams['roleid'] = $roleid;
    }

    $shortname = 'reminders';
    $report = new reportbuilder(null, $shortname, $embed);
    $report->defaultsortcolumn = 'message_values_sent';
    $report->defaultsortorder = 3;

    if($format!='') {
        $report->export_data($format);
        die;
    }
    $report->include_js();
    $js['dismissmsg'] = $CFG->wwwroot.'/local/reportbuilder/confirm.js.php';
    require_js(array_values($js));

    ///
    /// Display the page
    ///
    print_header($strheading, $strheading, build_navigation($strheading));
    echo '<h1>'.$strheading.'</h1>';

    // display table here
    $fullname = $report->fullname;
    $countfiltered = $report->get_filtered_count();
    $countall = $report->get_full_count();

    // display heading including filtering stats
    if($countfiltered == $countall) {
        print_heading("$countall records.");
    } else {
        print_heading("$countfiltered/$countall records shown.");
    }

    if (empty($report->description)) {
        $report->description = get_string('reminder_description', 'local_totara_msg');
    }

    print $report->print_description();

    $report->display_search();

    if($countfiltered>0) {
        print $report->showhide_button();
        print totara_msg_checkbox_all_none();
        print '<form id="totara_messages" name="totara_messages" action="'.$CFG->wwwroot.'/local/totara_msg/action.php" method="post">';
        $report->display_table();
//        print $report->edit_button();
        print totara_msg_action_button('dismiss');
        print totara_msg_action_button('accept');
        print totara_msg_action_button('reject');

        $out = print_box_start('generalbox', 'totara_msg_actions', true);
        $out .= '<input type="hidden" name="returnto" value="'.$FULLME.'"/>';
        $out .= "<center><table><tr>";
        $out .= '<td>';
        $out .= get_string('withselected','local_totara_msg');
        $out .= '<noscript>';
        $out .= get_string('noscript','local_totara_msg');
        $out .= '</noscript>';
        $out .= '</td>';
        $out .= '<td>';
        $out .= '<input type="submit" name="accept" id="totara-accept" value="'. get_string('accept','local_totara_msg') .'" style="display:none;"/>';
        $out .= '</td>';
        $out .= '<td>';
        $out .= '<input type="submit" name="reject" id="totara-reject" value="'. get_string('reject','local_totara_msg') .'" style="display:none;"/>';
        $out .= '</td>';
        $out .= '<td>';
        $out .= '<input type="submit" name="dismiss" id="totara-dismiss" value="'. get_string('dismiss','local_totara_msg') .'" style="display:none;"/>';
        $out .= '</td>';
        $out .= "<tr></table></center>";
        $out .= '<script type="text/javascript">$(function() { (function() { $(\'#totara_msg_selects\').css(\'display\',\'block\');})();});</script>';
        $out .= print_box_end(true);
        print $out;
        print "</form>";
        // export button
        $report->export_select();
    }
   print_footer();

?>
