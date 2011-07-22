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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage totara_msg 
 */

/**
 * Displays collaborative features for the current user
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
    $strheading = get_string('tasks', 'local_totara_msg');

    $shortname = 'tasks';
    $data = array(
        'userid' => $id,
    );
    if(isset($roleid)) {
        $data['roleid'] = $roleid;
    }
    if (!$report = reportbuilder_get_embedded_report($shortname, $data)) {
        print_error('error:couldnotgenerateembeddedreport', 'local_reportbuilder');
    }

    $report->defaultsortcolumn = 'message_values_sent';
    $report->defaultsortorder = 3;

    if($format!='') {
        add_to_log(SITEID, 'reportbuilder', 'export report', 'report.php?id='. $report->_id,
            $report->fullname);

        $report->export_data($format);
        die;
    }

    add_to_log(SITEID, 'reportbuilder', 'view report', 'report.php?id='. $report->_id,
        $report->fullname);

    $report->include_js();
    $js['dismissmsg'] = $CFG->wwwroot.'/local/reportbuilder/confirm.js.php';
    require_js(array_values($js));

    ///
    /// Display the page
    ///
    $referer = get_referer();
    $navlinks = array();
    if (strstr($referer, 'my/team.php')) {
        $backlink = "{$CFG->wwwroot}/my/team.php";
        $navlinks[] = array('name' => get_string('myteam', 'local').' '.get_string('dashboard', 'local_dashboard'),
            'link' => $backlink, 'type' => 'title');
    }
    if (strstr($referer, 'my/learning.php')) {
        $backlink = "{$CFG->wwwroot}/my/learning.php";
        $navlinks[] = array('name' => get_string('mylearning', 'local').' '.get_string('dashboard', 'local_dashboard'),
            'link' => $backlink, 'type' => 'title');
    }
    $navlinks[] = array('name' => $strheading, 'link' => '', 'type' => 'misc');
    $navigation = build_navigation($navlinks);

    print_header($strheading, $strheading, $navigation);
    echo '<h1>'.$strheading.'</h1>';
    if (!empty($backlink)) {
        echo "<p><a href=\"{$backlink}\"><< ".get_string('backtodashboard', 'local_dashboard').'</a></p>';
    }

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
        $report->description = get_string('task_description', 'local_totara_msg');
    }

    print $report->print_description();

    $report->display_search();

    if($countfiltered>0) {
        print $report->showhide_button();
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
        $out .= '<input type="submit" name="dismiss" id="totara-dismiss" disabled="true" value="'. get_string('dismiss','local_totara_msg') .'" style="display:none;"/>';
        $out .= '</td>';
        $out .= "</tr></table></center>";
        $out .= print_box_end(true);
        print $out;
        print "</form>";
        // export button
        $report->export_select();
        print totara_msg_checkbox_all_none();
    }
    print_footer();


print <<<HEREDOC
<script type="text/javascript">

    $(function() {
        $('#totara_messages input[type=checkbox]').bind('click', function() {
            if ($('form#totara_messages input[type=checkbox]:checked').length) {
                $('#totara-dismiss').attr('disabled', false);
            } else {
                $('#totara-dismiss').attr('disabled', true);
            }
        });
    });
</script>
HEREDOC;

?>
