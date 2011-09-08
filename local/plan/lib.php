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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @author Chris Wharton <chrisw@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once($CFG->dirroot . '/local/plan/development_plan.class.php');
require_once($CFG->dirroot . '/local/plan/role.class.php');
require_once($CFG->dirroot . '/local/plan/component.class.php');
require_once($CFG->dirroot . '/local/plan/workflow.class.php');
require_once($CFG->dirroot . '/local/program/lib.php'); // needed to display required learning in plans menu
require_once($CFG->libdir . '/tablelib.php');

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

// Plan status values
define('DP_PLAN_STATUS_UNAPPROVED', 10);
define('DP_PLAN_STATUS_APPROVED', 50);
define('DP_PLAN_STATUS_COMPLETE', 100);

// Permission values
define('DP_PERMISSION_DENY', 10);
define('DP_PERMISSION_REQUEST', 30);
define('DP_PERMISSION_ALLOW', 50);
define('DP_PERMISSION_APPROVE', 70);

// Due date modes
define('DP_DUEDATES_NONE', 0);
define('DP_DUEDATES_OPTIONAL', 1);
define('DP_DUEDATES_REQUIRED', 2);

// Priority modes
define('DP_PRIORITY_NONE', 0);
define('DP_PRIORITY_OPTIONAL', 1);
define('DP_PRIORITY_REQUIRED', 2);

// Maximum number of priority options
define('DP_MAX_PRIORITY_OPTIONS', 5);

//// Plan item Approval status (Note that you should usually check *Plan status* as well as item status)
// Item was added to an approved plan, but declined by manager
define('DP_APPROVAL_DECLINED',          10);
// Item was added to an approved plan by a user with "Request" permission
define('DP_APPROVAL_UNAPPROVED',        20);
// Item was added to an approved plan by a user with "Request" permission, and a
// request for approval was sent to their manager
define('DP_APPROVAL_REQUESTED',         30);
// Item was added to an Unapproved plan, or added to an Approved plan by a user
// with Allow or Approve permission
define('DP_APPROVAL_APPROVED',          50);

// Plan notices
define('DEVELOPMENT_PLAN_GENERAL_CONFIRM_UPDATE', 2);
define('DEVELOPMENT_PLAN_GENERAL_FAILED_UPDATE', 3);

// Plan reasons
define('DP_PLAN_REASON_CREATE', 10);
define('DP_PLAN_REASON_MANUAL_APPROVE', 20);
define('DP_PLAN_REASON_MANUAL_COMPLETE', 40);
define('DP_PLAN_REASON_AUTO_COMPLETE_DATE', 50);
define('DP_PLAN_REASON_AUTO_COMPLETE_ITEMS', 60);
define('DP_PLAN_REASON_MANUAL_REACTIVATE', 80);

// Types of competency evidence items
define('PLAN_LINKTYPE_MANDATORY', 1);
define('PLAN_LINKTYPE_OPTIONAL', 0);

// roles available to development plans
// each must have a class definition in
// local/plan/roles/[ROLE]/[ROLE].class.php
global $DP_AVAILABLE_ROLES;
$DP_AVAILABLE_ROLES = array(
    'learner',
    'manager',
);

global $DP_AVAILABLE_COMPONENTS;
$DP_AVAILABLE_COMPONENTS = array(
    'course',
    'competency',
    'objective',
    'program',
);

// note that new templates will default to the first workflow in this list
global $DP_AVAILABLE_WORKFLOWS;
$DP_AVAILABLE_WORKFLOWS = array(
    'basic',
    'userdriven',
    'managerdriven',
);

global $PLAN_AVAILABLE_LINKTYPES;
$PLAN_AVAILABLE_LINKTYPES = array(
    PLAN_LINKTYPE_MANDATORY,
    PLAN_LINKTYPE_OPTIONAL
);

/**
 * Can logged in user view user's plans
 *
 * @access  public
 * @param   int     $ownerid   Plan's owner
 * @return  boolean
 */
function dp_can_view_users_plans($ownerid) {
    global $USER;

    if (!isloggedin()) {
        return false;
    }

    $systemcontext = get_system_context();

    // Check plan templates exist
    static $templateexists;
    if (!isset($templateexists)) {
        $templateexists = (bool) count_records('dp_template');
    }

    if (!$templateexists) {
        return false;
    }

    // If the user can view any plans
    if (has_capability('local/plan:accessanyplan', $systemcontext)) {
        return true;
    }

    // If the user cannot view any plans
    if (!has_capability('local/plan:accessplan', $systemcontext)) {
        return false;
    }

    // If this is the current user's own plans
    if ($ownerid == $USER->id) {
        return true;
    }

    // If this user is their manager
    if (totara_is_manager($ownerid)) {
        return true;
    }

    return false;
}


/**
 * Return plans for a user with a specific status
 *
 * @access  public
 * @param   int     $userid     Owner of plans
 * @param   array   $statuses   Plan statuses
 * @return  array|false
 */
function dp_get_plans($userid, $statuses=array(DP_PLAN_STATUS_APPROVED)) {
    if (is_array($statuses)) {
        $statuses = implode(',', $statuses);
    }
    return get_records_select('dp_plan', "userid = {$userid} AND status IN ({$statuses})");
}

/**
 * Used to create a timestamp from a string
 *
 * @access  public
 * @param   string  $datestring  string to be parsed
 * @return  int|false
 */
function dp_convert_userdate($datestring) {
    // Check for DD/MM/YYYY
    if (preg_match('|(\d{1,2})/(\d{1,2})/(\d{4})|', $datestring, $matches)) {
        return mktime(0,0,0,$matches[2], $matches[1], $matches[3]);
    }
    return strtotime($datestring);
}

/**
 * Gets Priorities
 *
 * @access  public
 * @return  array|false  a recordset object
 */
function dp_get_priorities() {
    return get_records('dp_priority_scale', '', '', 'sortorder');
}


/**
 * Gets learning plan objectives
 *
 * @access public
 * @return array|false  a recordset object
 */
function dp_get_objectives() {
    return get_records('dp_objective_scale', '', '', 'sortorder');
}


/**
 * Get a list of user IDs of users who can receive alert emails
 *
 * @access  public
 * @param   object       $contextuser  context object
 * @param   string       $type         type of user
 * @return array|false  $receivers    the users which receive the alert
 */
function dp_get_alert_receivers($contextuser, $type) {
    global $USER;

    $receivers = array();

    $users = get_users_by_capability($contextuser, "local/plan:receive{$type}alerts");
    if ($users and count($users) > 0) {
        foreach ($users as $key => $user) {
            if ($user->id != $USER->id) {
                $receivers[] = $user->id;
            }
        }
    }

    return $receivers;
}

/**
 * Adds permission selector to the form
 *
 * @access  public
 * @param   object  $form  the form object
 * @param   string  $name  the form element name
 * @param   boolean $requestable
 */
function dp_add_permissions_select(&$form, $name, $requestable){
    $select_options = array();

    $select_options[DP_PERMISSION_ALLOW] = get_string('allow', 'local_plan');
    $select_options[DP_PERMISSION_DENY] = get_string('deny', 'local_plan');

    if($requestable) {
        $select_options[DP_PERMISSION_REQUEST] = get_string('request', 'local_plan');
        $select_options[DP_PERMISSION_APPROVE] = get_string('approve', 'local_plan');
    }

    $form->addElement('select', $name, null, $select_options);
}

/**
 * Adds perissions table row to the form
 *
 * @access  public
 * @param   object  $form  the form object
 * @param   string  $name  the form element name
 * @param   string  $label the form element label
 * @param   boolean $requestable
 */
function dp_add_permissions_table_row(&$form, $name, $label, $requestable){
    $form->addElement('html', '<tr><td id="action">'.$label);
    $form->addElement('html', '</td><td id="learner">');
    dp_add_permissions_select($form, $name.'learner', $requestable);
    $form->addElement('html', '</td><td id="manager">');
    dp_add_permissions_select($form, $name.'manager', $requestable);
    $form->addElement('html', '</td></tr>');
}

/**
 * Prints the workflow settings table
 *
 * @access public
 * @param  array  $diff_array holds the workflow setting values
 * @return string $return     the text data to be displayed
 */
function dp_print_workflow_diff($diff_array) {
    $columns[] = 'component';
    $headers[] = get_string('component', 'local_plan');
    $columns[] = 'setting';
    $headers[] = get_string('setting', 'local_plan');
    $columns[] = 'role';
    $headers[] = get_string('role', 'local_plan');
    $columns[] = 'before';
    $headers[] = get_string('before', 'local_plan');
    $columns[] = 'after';
    $headers[] = get_string('after', 'local_plan');

    $table = new flexible_table('Templates');
    $table->define_columns($columns);
    $table->define_headers($headers);
    $return = '<p><h3>Changes</h3><table><tr><th>Setting</th><th>Before</th><th>After</th>';

    $table->setup();

    $permission_options = array(DP_PERMISSION_ALLOW => get_string('allow', 'local_plan'),
        DP_PERMISSION_DENY => get_string('deny', 'local_plan'),
        DP_PERMISSION_REQUEST => get_string('request', 'local_plan'),
        DP_PERMISSION_APPROVE => get_string('approve', 'local_plan')
    );

    $duedate_options = array(DP_DUEDATES_NONE => get_string('none'),
        DP_DUEDATES_OPTIONAL => get_string('optional', 'local_plan'),
        DP_DUEDATES_REQUIRED => get_string('required', 'local_plan')
    );

    $priority_options = array(DP_PRIORITY_NONE => get_string('none'),
        DP_PRIORITY_OPTIONAL => get_string('optional', 'local_plan'),
        DP_PRIORITY_REQUIRED => get_string('required', 'local_plan')
    );

    foreach($diff_array as $item => $values) {
        $parts = explode('_', $item);
        $tablerow = array();

        if($parts[0] == 'perm'){
            if($parts[1] != 'plan'){
                $configsetting = get_config(null, 'dp_'.$parts[1]);
                $compname = $configsetting ? $configsetting : get_string($parts[1], 'local_plan');
                $tablerow[] = $compname;
            } else {
                $tablerow[] = get_string($parts[1], 'local_plan');
            }
            $tablerow[] = get_string($parts[2], 'local_plan');
            $tablerow[] = get_string($parts[3], 'local_plan');
            $tablerow[] = $permission_options[$values['before']];
            $tablerow[] = $permission_options[$values['after']];
        } else {
            if($parts[1] != 'plan'){
                $configsetting = get_config(null, 'dp_'.$parts[1]);
                $compname = $configsetting ? $configsetting : get_string($parts[1], 'local_plan');
                $tablerow[] = $compname;
            } else {
                $tablerow[] = get_string($parts[1], 'local_plan');
            }
            $tablerow[] = get_string($parts[2], 'local_plan');
            $tablerow[] = get_string('na', 'local_plan');
            switch($parts[2]) {
                case 'duedatemode':
                    $tablerow[] = $duedate_options[$values['before']];
                    $tablerow[] = $duedate_options[$values['after']];
                    break;

                case 'prioritymode':
                    $tablerow[] = $priority_options[$values['before']];
                    $tablerow[] = $priority_options[$values['after']];
                    break;

                case 'priorityscale':
                    $tablerow[] = $values['before'];
                    $tablerow[] = $values['after'];
                    break;

                case 'objectivescale':
                    $tablerow[] = $values['before'];
                    $tablerow[] = $values['after'];
                    break;

                case 'autoassignpos':
                    $tablerow[] = $values['before'] == 0 ? get_string('no') : get_string('yes');
                    $tablerow[] = $values['after'] == 0 ? get_string('no') : get_string('yes');
                    break;

                case 'autoassignorg':
                    $tablerow[] = $values['before'] == 0 ? get_string('no') : get_string('yes');
                    $tablerow[] = $values['after'] == 0 ? get_string('no') : get_string('yes');
                    break;

                case 'includecompleted':
                    $tablerow[] = $values['before'] == 0 ? get_string('no') : get_string('yes');
                    $tablerow[] = $values['after'] == 0 ? get_string('no') : get_string('yes');
                    break;

                case 'autoassigncourses':
                    $tablerow[] = $values['before'] == 0 ? get_string('no') : get_string('yes');
                    $tablerow[] = $values['after'] == 0 ? get_string('no') : get_string('yes');
                    break;
            }
        }

        $table->add_data($tablerow);
    }

    ob_start();
    $table->print_html();
    echo '<br />';
    $return = ob_get_contents();
    ob_end_clean();

    return $return;
}


/**
 * Return markup for displaying a user's plans
 *
 * Optionally filter by plan status, and chose columns to display
 *
 * @access  public
 * @param   int     $userid     Plan owner
 * @param   array   $statuses   Plan status to filter by
 * @param   array   $cols       Columns to display
 * @return  string
 */
function dp_display_plans($userid, $statuses=array(DP_PLAN_STATUSAPPROVED), $cols=array('enddate', 'status', 'completed'), $firstcolheader='') {
    global $CFG, $USER;

    $statuses = is_array($statuses) ? implode(',', $statuses) : $statuses;
    $statuses_undrsc = str_replace(',', '_', $statuses);
    $cols = is_array($cols) ? $cols : array($cols);

    // Construct sql query
    $count = 'SELECT COUNT(*) ';
    $select = 'SELECT p.id, p.name AS "name_'.$statuses_undrsc.'"';
    foreach ($cols as $c) {
        if ($c == 'completed') {
            continue;
        }
        $select .= ", p.{$c} AS \"{$c}_{$statuses_undrsc}\"";
    }
    if (in_array('completed', $cols)) {
        $select .= ", phmax.timemodified
            AS \"timemodified_{$statuses_undrsc}\" ";
    }

    $from = "FROM {$CFG->prefix}dp_plan p ";
    $where = "WHERE userid = {$userid} AND status IN ({$statuses}) ";
    if (in_array('completed', $cols)) {
        $from .= "LEFT JOIN (SELECT planid, max(timemodified) as timemodified FROM {$CFG->prefix}dp_plan_history GROUP BY planid) phmax ON p.id=phmax.planid ";
    }
    $count = count_records_sql($count.$from.$where);

    // Set up table
    $tablename = 'plans-list-'.$statuses_undrsc;
    $tableheaders = array();
    $tablecols = array('name_'.$statuses_undrsc);

    // Determine what the first column header should be
    if (empty($firstcolheader)) {
        $tableheaders[] = get_string('plan', 'local_plan');
    } else {
        $tableheaders[] = $firstcolheader;
    }

    if (in_array('enddate', $cols)) {
        $tableheaders[] = get_string('duedate', 'local_plan');
        $tablecols[] = 'enddate_'.$statuses_undrsc;
    }
    if (in_array('status', $cols)) {
        $tableheaders[] = get_string('status', 'local_plan');
        $tablecols[] = 'status_'.$statuses_undrsc;
    }
    if (in_array('completed', $cols)) {
        $tableheaders[] = get_string('completed', 'local_plan');
        $tablecols[] = 'timemodified_'.$statuses_undrsc;
    }

    // Actions
    $tableheaders[] = '';
    $tablecols[] = 'actioncontrols';

    $baseurl = $CFG->wwwroot . '/local/plan/index.php';
    if($userid != $USER->id) {
        $baseurl .= '?userid=' . $userid;
    }

    $table = new flexible_table($tablename);
    $table->define_headers($tableheaders);
    $table->define_columns($tablecols);
    $table->define_baseurl($baseurl);
    $table->set_attribute('class', 'logtable generalbox');
    $table->set_attribute('width', '100%');
    $table->set_control_variables(array(
        TABLE_VAR_SORT    => 'tsort',
    ));
    $table->sortable(true);
    if (in_array('status', $cols)) {
        $table->no_sorting('status_'.$statuses_undrsc);
    }
    $table->setup();
    $table->pagesize(15, $count);
    $sort = $table->get_sql_sort();
    $sort = empty($sort) ? '' : ' ORDER BY '.$sort;

    // Add table data
    $plans = get_records_sql($select.$from.$where.$sort, $table->get_page_start(), $table->get_page_size());
    if (!$plans) {
        return;
    }
    foreach ($plans as $p) {
        $plan = new development_plan($p->id);
        if($plan->get_setting('view') == DP_PERMISSION_ALLOW){
            $row = array();
            $row[] = $plan->display_summary_widget();
            if (in_array('enddate', $cols)) {
                $row[] = $plan->display_enddate();
            }
            if (in_array('status', $cols)) {
                $row[] = $plan->display_progress();
            }
            if (in_array('completed', $cols)) {
                $row[] = $plan->display_completeddate();
            }
            $row[] = $plan->display_actions();

            $table->add_data($row);
        }
    }
    unset($plans);
    $table->hide_empty_cols();

    if(!empty($table->data)) {
        ob_start();
        $table->print_html();
        $out = ob_get_contents();
        ob_end_clean();
    } else {
        $out = '';
    }

    return $out;
}

/**
 * Displays the plan menu
 *
 * @access public
 * @param  int    $userid           the id of the current user
 * @param  int    $selectedid       the selected id
 * @param  string $role             the role of the user
 * @param  string $rolpage          the record of learning page (to keep track of which tab is selected)
 * @param  string $rolstatus        the record of learning status (to keep track of which menu item is selected)
 * @param  bool   $showrol          determines if the record of learning should be shown
 * @param  int    $selectedprogid   the selected program id
 * @param  bool   $showrequired     determines if the record of learning should be shown
 * @return string $out              the form to display
 */
function dp_display_plans_menu($userid, $selectedid=0, $role='learner', $rolpage='courses', $rolstatus='none', $showrol=true, $selectedprogid=0, $showrequired=true) {
    global $CFG;

    $out = '<div id="dp-plans-menu">';

    if ($role == 'manager') {
        // Print out the All team members link
        $out .= print_heading(get_string('teammembers', 'local_plan'), '', 3, 'main', true);
        $class = $userid == 0 ? 'class="dp-menu-selected"' : '';
        $out .= "<ul><li {$class} ><a href=\"{$CFG->wwwroot}/my/teammembers.php\">";
        $out .= get_string('allteammembers', 'local_plan');
        $out .= "</a></li></ul>";
        if ($userid) {
            // Display who we are currently viewing if appropriate
            $out .= print_heading(get_string('currentlyviewing', 'local_plan'), '', 3, 'main', true);
            // TODO: make this more efficient
            $user = get_record('user','id',$userid);
            $class = $selectedid == 0 ? 'class="dp-menu-selected"' : '';
            $out .= "<ul><li {$class} ><a href=\"{$CFG->wwwroot}/local/plan/index.php?userid={$userid}\">{$user->firstname} {$user->lastname}</a></li></ul>";
        }
    }

    // Display active plans
    if ($plans = dp_get_plans($userid, array(DP_PLAN_STATUS_APPROVED))) {
        if ($role == 'manager') {
            $out .= '<div class="dp-plans-menu-section"><h4 class="dp-plans-menu-sub-header">' . get_string('activeplans', 'local_plan') . '</h4>';
        }
        else {
            $out .= print_heading(get_string('activeplans', 'local_plan'), '', 3, 'main', true);
        }
            $out .= "<ul>";
            foreach ($plans as $p) {
                $class = $p->id == $selectedid ? 'class="dp-menu-selected"' : '';
                $out .= "<li {$class}><a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$p->id}\">{$p->name}</a></li>";
            }
            $out .= "</ul>";
        if ($role == 'manager') {
            $out .= "</div>";
        }
    }

    // Display unapproved plans
    if ($plans = dp_get_plans($userid, array(DP_PLAN_STATUS_UNAPPROVED))) {
        if ($role == 'manager') {
            $out .= '<div class="dp-plans-menu-section"><h4 class="dp-plans-menu-sub-header">' . get_string('unapprovedplans', 'local_plan') . '</h4>';
        }
        else {
            $out .= print_heading(get_string('unapprovedplans', 'local_plan'), '', 3, 'main', true);
        }
        $out .= "<ul>";
        foreach ($plans as $p) {
            $class = $p->id == $selectedid ? 'class="dp-menu-selected"' : '';
            $out .= "<li {$class}><a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$p->id}\">{$p->name}</a></li>";
        }
        $out .= "</ul>";
        if ($role == 'manager') {
            $out .= "</div>";
        }
    }

    // Display completed plans
    if ($plans = dp_get_plans($userid, DP_PLAN_STATUS_COMPLETE)) {
        if ($role == 'manager') {
            $out .= '<div class="dp-plans-menu-section"><h4 class="dp-plans-menu-sub-header">' . get_string('completedplans', 'local_plan') . '</h4>';
        }
        else {
            $out .= print_heading(get_string('completedplans', 'local_plan'), '', 3, 'main', true);
        }
            $out .= "<ul>";
            foreach ($plans as $p) {
                $class = $p->id == $selectedid ? 'class="dp-menu-selected"' : '';
                $out .= "<li {$class}><a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$p->id}\">{$p->name}</a></li>";
            }
            $out .= "</ul>";
        if ($role == 'manager') {
            $out .= "</div>";
        }
    }

    // Print Required Learning menu
    if ($showrequired) {
        if($programs = prog_get_required_programs($userid, ' ORDER BY fullname ASC ')) {
            if ($role == 'manager') {
                $extraparams = '&amp;userid='.$userid;
                $out .= '<div class="dp-plans-menu-section"><h4 class="dp-plans-menu-sub-header">' . get_string('requiredlearning', 'local_program') . '</h4>';
            }
            else {
                $extraparams = '';
                $out .= print_heading(get_string('requiredlearning', 'local_program'), '', 3, 'main', true);
            }
            $out .= "<ul>";
            $progcount = 1;
            $maxprogstodisplay = 5;
            foreach ($programs as $p) {
                if ($progcount > $maxprogstodisplay) {
                    $out .= "<li><a href=\"{$CFG->wwwroot}/local/program/required.php?{$extraparams}\">" . get_string('viewallrequiredlearning', 'local_program') . "</a></li>";
                    break;
                }
                $class = $p->id == $selectedprogid ? 'class="dp-menu-selected"' : '';
                $out .= "<li {$class}><a href=\"{$CFG->wwwroot}/local/program/required.php?id={$p->id}{$extraparams}\">{$p->fullname}</a></li>";
                $progcount++;
            }
            $out .= "</ul>";
            if ($role == 'manager') {
                $out .= "</div>";
            }
        }

    }

    // Print Record of Learning menu
    if ($showrol) {
        $out .= dp_record_status_menu($rolpage, $rolstatus, $userid);
    }

    $out .= '</div>';

    return $out;
}

/**
 * Display the add plan button
 *
 * @access public
 * @param  int    $userid the users id
 * @return string $out    the display code
 */
function dp_display_add_plan_icon($userid) {
    global $CFG;

    $out = '';
    $href = "{$CFG->wwwroot}/local/plan/add.php?userid={$userid}";
    $title = get_string('createnewlearningplan', 'local_plan');
    $out = '';
    $out .= '<div class="dp-add-plan-link">';
    $out .= '	<form action="'.$href.'" method="GET">';
    $out .= '		<input type="submit" value="'.$title.'"/>';
    $out .= '		<input type="hidden" name="userid" value="'.$userid.'"/>';
    $out .= '	</form>';
    $out .= '</div>';

    return $out;
}

/**
 * Display the user message box
 *
 * @access public
 * @param  int    $planuser the id of the user
 * @return string $out      the display code
 */
function dp_display_user_message_box($planuser) {
    global $CFG;
    $user = get_record('user', 'id', $planuser);
    if(!$user) {
        return false;
    }

    $out = '<div class="plan_box plan_box_plain">';
    $out .= '<table border="0" width="100%"><tr><td width="50">';
    $out .= print_user_picture($user, 1, null, 0, true);
    $out .= '</td><td>';
    $a = new object();
    $a->name = fullname($user);
    $a->userid = $planuser;
    $a->site = $CFG->wwwroot;
    $out .= get_string('youareviewingxsplans', 'local_plan', $a);
    $out .= '</td></tr></table></div>';
    return $out;
}

/*
 * Deletes a plan
 *
 * @access public
 * @param  int    $planid  the id of the plan to be deleted
 * @return false|true
 */
function dp_plan_delete($planid) {
    $plan = new development_plan($planid);

    return $plan->delete();
}

/**
 * Gets the first template in the table
 *
 * @access public
 * @return false|true
 */
function dp_get_first_template() {
    if (!$template = get_records('dp_template', '','', 'sortorder', '*', '', 1)) {;
        return false;
    }

    return reset($template);
}

/**
 * Gets the template permission value
 *
 * @access public
 * @param  int    $templateid the id of the template
 * @param  string $component  the component type
 * @param  string $action     the action to perform
 * @param  string $role       the user role
 * @return false|int $permission->value
 */
function dp_get_template_permission($templateid, $component, $action, $role) {
    if ($permission = get_record_select('dp_permissions', "templateid={$templateid} AND role='{$role}' AND component='{$component}' AND action='{$action}'", 'value')) {
        return $permission->value;
    } else {
        return false;
    }
}

/**
 * Display a pulldown for filtering record of learning page
 *
 * @param string $pagename Name of the current page (filename without .php)
 * @param string $status The status for the current page
 *
 * @return string HTML to display the picker
 */
function dp_record_status_picker($pagename, $status, $userid=null) {
    global $CFG;
    $out = '';

    // generate options for status pulldown
    $options = array();
    $selected = null;
    foreach( array('all','active','completed') as $s ){
        if ( $status == $s ){
            $selected = $s;
        }
        $options[$s] = get_string($s . 'learning', 'local_plan');
    }

    $out .= '<div id="recordoflearning_statuspicker">';
    $out .= '<strong>' . get_string('filterbystatus', 'local_plan') .
        ':</strong>&nbsp;';

    // pass the userid if set
    $userstr = (isset($userid)) ? 'userid='.$userid.'&amp;' : '';

    // display status pulldown
    $out .= popup_form(
        $CFG->wwwroot . '/local/plan/record/' . $pagename . '.php?' . $userstr . 'status=',
        $options,
        'viewbystatus',
        $selected,
        null,
        '',
        '',
        true
    );
    $out .= '</div>';

    return $out;
}

/**
 * Display a menu for filtering record of learning page
 *
 * @param string $pagename Name of the current page (filename without .php)
 * @param string $status The status for the current page
 * @param int $userid The current users id
 *
 * @return string HTML to display the menu
 */

function dp_record_status_menu($pagename, $status, $userid=null) {
    global $CFG;

    // pass the userid if set
    $userstr = (isset($userid)) ? 'userid='.$userid.'&amp;' : '';

    $out = print_heading(get_string('recordoflearning', 'local'), '', 3, 'main', true);

    // generate options for menu display
    $filter = array();

    foreach( array('all','active','completed') as $s ){
        $filter[$s] = get_string($s . 'learning', 'local_plan');
        $class = $status == $s ? 'class="dp-menu-selected"' : '';

        $out .= "<ul><li {$class} ><a href=\"{$CFG->wwwroot}/local/plan/record/";
        $out .= $pagename . '.php?' . $userstr . 'status=' . $s;
        $out .= "\">" . $filter[$s];
        $out .= "</a></li></ul>";
    }
    return $out;
}

/**
 * Add lowest levels of breadcrumbs to plan
 *
 * Exact links added depends on if the plan belongs to the current
 * user or not.
 *
 * @param array &$navlinks The navlinks array to update (passed by reference)
 * @param integer $userid ID of the plan's owner
 *
 * @return boolean True if it is the user's own plan
 */
function dp_get_plan_base_navlinks(&$navlinks, $userid) {
    global $CFG, $USER;
    // the user is viewing their own plan
    if($userid == $USER->id) {
        $navlinks[] = array('name' => get_string('mylearning', 'local'), 'link' => $CFG->wwwroot . '/my/learning.php', 'type' => 'title');
        $navlinks[] = array('name' => get_string('learningplans','local_plan'), 'link'=> $CFG->wwwroot . '/local/plan/index.php', 'type'=>'title');
        return true;
    }

    // the user is viewing someone else's plan
    $user = get_record('user', 'id', $userid);
    if($user) {
        $navlinks[] = array('name' => get_string('myteam','local'), 'link'=> $CFG->wwwroot . '/my/team.php', 'type'=>'title');
        $navlinks[] = array('name' => get_string('teammembers','local'), 'link'=> $CFG->wwwroot . '/my/teammembers.php', 'type'=>'title');
        $navlinks[] = array('name' => get_string('xslearningplans','local_plan', fullname($user)), 'link'=> $CFG->wwwroot . '/local/plan/index.php?userid='.$userid, 'type'=>'title');
    } else {
        $navlinks[] = array('name' => get_string('unknownuserslearningplans','local_plan'), 'link'=> $CFG->wwwroot . '/local/plan/index.php?userid='.$userid, 'type'=>'title');
    }
}

/**
 * Gets the approval status, given the approval code (e.g 50)
 *
 * @access public
 * @param  int    $code   the status code
 * @return string $status the plan approval status
 */
function dp_get_approval_status_from_code($code) {
    switch ($code) {
        case DP_APPROVAL_DECLINED:
            $status = get_string('declined', 'local_plan');
            break;
        case DP_APPROVAL_UNAPPROVED:
            $status = get_string('unapproved', 'local_plan');
            break;
        case DP_APPROVAL_REQUESTED:
            $status = get_string('pendingapproval', 'local_plan');
            break;
        case DP_APPROVAL_APPROVED:
            $status = get_string('approved', 'local_plan');
            break;
        default:
            $status = get_string('unknown', 'local_plan');
            break;
    }

    return $status;
}


/**
 * Create a new template based on a template object
 *
 * @param string $templatename Name for the template
 * @param integer $enddate Unix timestamp of template enddate
 *
 * @return integer|false ID of new template or false if unsuccessful
 */
function dp_create_template($templatename, $enddate, &$error) {
    global $CFG;

    begin_sql();

    $todb = new object();
    $todb->fullname = $templatename;
    $todb->enddate = dp_convert_userdate($enddate);
    $sortorder = get_field('dp_template', 'MAX(sortorder)', '', '') + 1;
    $todb->sortorder = $sortorder;
    $todb->visible = 1;
    // by default use first listed workflow
    global $DP_AVAILABLE_WORKFLOWS;
    reset($DP_AVAILABLE_WORKFLOWS);
    $workflow = current($DP_AVAILABLE_WORKFLOWS);
    $todb->workflow = $workflow;

    if(!$newtemplateid = insert_record('dp_template', $todb)) {
        rollback_sql();
        $error = get_string('error:newdptemplate', 'local_plan');
        return false;
    }

    global $DP_AVAILABLE_COMPONENTS;
    foreach($DP_AVAILABLE_COMPONENTS as $component){
        $classfile = $CFG->dirroot .
            "/local/plan/components/{$component}/{$component}.class.php";
        if(!is_readable($classfile)) {
            $string_properties = new object();
            $string_properties->classfile = $classfile;
            $string_properties->component = $component;
            rollback_sql();
            $error = get_string('noclassfileforcomponent', 'local_plan', $string_properties);
            return false;
        }
        include_once($classfile);

        // check class exists
        $class = "dp_{$component}_component";
        if(!class_exists($class)) {
            $string_properties = new object();
            $string_properties->class = $class;
            $string_properties->component = $component;
            rollback_sql();
            $error = get_string('noclassforcomponent', 'local_plan', $string_properties);
            return false;
        }

        $cn = new object();
        $cn->templateid = $newtemplateid;
        $cn->component = $component;
        $cn->enabled = 1;
        $sortorder = get_field_sql("SELECT max(sortorder) FROM {$CFG->prefix}dp_component_settings");
        $cn->sortorder = $sortorder + 1;

        if(!$componentsettingid = insert_record('dp_component_settings', $cn)){
            rollback_sql();
            $error = get_string('error:createcomponents', 'local_plan');
            return false;
        }
    }

    $classfile = $CFG->dirroot . "/local/plan/workflows/{$workflow}/{$workflow}.class.php";
    if(!is_readable($classfile)) {
        $string_properties = new object();
        $string_properties->classfile = $classfile;
        $string_properties->workflow = $workflow;
        rollback_sql();
        $error = get_string('noclassfileforworkflow', 'local_plan', $string_properties);
        return false;
    }
    include_once($classfile);

    // check class exists
    $class = "dp_{$workflow}_workflow";
    if(!class_exists($class)) {
        $string_properties = new object();
        $string_properties->class = $classfile;
        $string_properties->workflow = $workflow;
        rollback_sql();
        $error = get_string('noclassforworkflow','local_plan', $string_properties);
        return false;
    }

    // create an instance and save as a property for easy access
    $workflow_class = new $class();
    if(!$workflow_class->copy_to_db($newtemplateid)) {
        rollback_sql();
        $error = get_string('error:newdptemplate', 'local_plan');
        return false;
    }

    commit_sql();
    return $newtemplateid;
}


/**
 * Find all plans a specified item is part of
 *
 * @param int $userid ID of the user updating the item
 * @param string $component Name of the component (eg. course, competency, objective)
 * @param int $componentid ID of the component item (eg. competencyid, objectiveid)
 *
 */
function dp_plan_item_updated($userid, $component, $componentid) {
    global $CFG;
    // Include component class file
    $component_include = $CFG->dirroot . '/local/plan/components/' . $component . '/' . $component . '.class.php';
    if (file_exists($component_include)) {
        require_once($component_include);
    }
    $plans = call_user_func("dp_{$component}_component::get_plans_containing_item", $componentid, $userid);
    dp_plan_check_plan_complete($plans);
}

/**
 * Checks if any of the plans is complete and if the auto completion by plans option is set
 * then the plan is completed
 *
 * @param array $plans list of plans to be checked
 *
 */
function dp_plan_check_plan_complete($plans) {
    if ($plans) {
        foreach ($plans as $planid) {
            $plan = new development_plan($planid);
            if ($plan->is_plan_complete() && $plan->get_setting('autobyitems') && $plan->is_active()) {
                $plan->set_status(DP_PLAN_STATUS_COMPLETE, DP_PLAN_REASON_AUTO_COMPLETE_ITEMS);
            }
        }
    }
}


///
/// Comments callback functions
///

function plan_comment_permissions($details) {
    $planid = 0;

    switch ($details->commentarea) {
        case 'plan-overview' :
            $planid = $details->itemid;
            break;
        case 'plan-course-item':
            $planid = get_field('dp_plan_course_assign', 'planid', 'id', $details->itemid);
            break;
        case 'plan-competency-item':
            $planid = get_field('dp_plan_competency_assign', 'planid', 'id', $details->itemid);
            break;
        case 'plan-objective-item':
            $planid = get_field('dp_plan_objective', 'planid', 'id', $details->itemid);
            break;
        case 'plan-program-item':
            $planid = get_field('dp_plan_program_assign', 'planid', 'id', $details->itemid);
        default:
            break;

    }

    if (!$planid) {
        return array('post' => false, 'view' => false);
    }

    $plan = new development_plan($planid);

    if(!has_capability('local/plan:accessanyplan', $details->context) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
        return array('post' => false, 'view' => false);
    } else {
        return array('post' => true, 'view' => true);
    }
}

function plan_comment_template() {
    $template = <<<EOD
<div class="comment-userpicture">___picture___</div>
<div class="comment-content">
    <span class="comment-user-name">___name___</span>
    ___content___
    <div class="comment-datetime">___time___</div>
</div>
<div class="comment-footer"></div>
EOD;

    return $template;
}

function plan_comment_add($comment) {
    global $CFG;

    /// Get the right message data
    $commentuser = get_record('user', 'id', $comment->userid);
    switch ($comment->commentarea) {
        case 'plan-overview':
            $plan = get_record('dp_plan', 'id', $comment->itemid);

            $msgobj = new stdClass;
            $msgobj->plan = $plan->name;
            $msgobj->planowner = fullname(get_record('user', 'id', $plan->userid));
            $msgobj->comment = format_text($comment->content);
            $msgobj->commentby = fullname($commentuser);
            $msgobj->commentdate = userdate($comment->timecreated);

            $subject = get_string('commentmsg:planoverview', 'local_plan', $msgobj);
            $fullmsg = get_string('commentmsg:planoverviewdetail', 'local_plan', $msgobj);
            $contexturl = $CFG->wwwroot.'/local/plan/view.php?id='.$plan->id.'#comments';
            $contexturlname = $plan->name;
            $icon = 'elearning-newcomment';
            break;
        case 'plan-course-item':
            $sql = "SELECT ca.id, ca.planid, c.fullname
                FROM {$CFG->prefix}dp_plan_course_assign ca
                INNER JOIN {$CFG->prefix}course c ON ca.courseid = c.id
                WHERE ca.id = {$comment->itemid}";
            if (!$record = get_record_sql($sql)) {
                print_error('commenterror:itemnotfound', 'local_plan');
            }
            $plan = get_record('dp_plan', 'id', $record->planid);

            $msgobj = new stdClass;
            $msgobj->plan = $plan->name;
            $msgobj->planowner = fullname(get_record('user', 'id', $plan->userid));
            $msgobj->component = get_string('course', 'local_plan');
            $msgobj->componentname = $record->fullname;
            $msgobj->comment = format_text($comment->content);
            $msgobj->commentby = fullname($commentuser);
            $msgobj->commentdate = userdate($comment->timecreated);
            $subject = get_string('commentmsg:componentitem', 'local_plan', $msgobj);
            $fullmsg = get_string('commentmsg:componentitemdetail', 'local_plan', $msgobj);

            $contexturl = $CFG->wwwroot.'/local/plan/components/course/view.php?id='.$plan->id.'&amp;itemid='.$comment->itemid.'#comments';
            $contexturlname = $record->fullname;
            $icon = 'course-newcomment';
            break;
        case 'plan-competency-item':
            $sql = "SELECT ca.id, ca.planid, c.fullname
                FROM {$CFG->prefix}dp_plan_competency_assign ca
                INNER JOIN {$CFG->prefix}comp c ON ca.competencyid = c.id
                WHERE ca.id = {$comment->itemid}";
            if (!$record = get_record_sql($sql)) {
                print_error('commenterror:itemnotfound', 'local_plan');
            }
            $plan = get_record('dp_plan', 'id', $record->planid);

            $msgobj = new stdClass;
            $msgobj->plan = $plan->name;
            $msgobj->planowner = fullname(get_record('user', 'id', $plan->userid));
            $msgobj->component = get_string('competency', 'local_plan');
            $msgobj->componentname = $record->fullname;
            $msgobj->comment = format_text($comment->content);
            $msgobj->commentby = fullname($commentuser);
            $msgobj->commentdate = userdate($comment->timecreated);
            $subject = get_string('commentmsg:componentitem', 'local_plan', $msgobj);
            $fullmsg = get_string('commentmsg:componentitemdetail', 'local_plan', $msgobj);

            $contexturl = $CFG->wwwroot.'/local/plan/components/competency/view.php?id='.$plan->id.'&amp;itemid='.$comment->itemid.'#comments';
            $contexturlname = $record->fullname;
            $icon = 'competency-newcomment';
            break;
        case 'plan-objective-item':
            if (!$record = get_record('dp_plan_objective', 'id', $comment->itemid)) {
                print_error('commenterror:itemnotfound', 'local_plan');
            }
            $plan = get_record('dp_plan', 'id', $record->planid);

            $msgobj = new stdClass;
            $msgobj->plan = $plan->name;
            $msgobj->planowner = fullname(get_record('user', 'id', $plan->userid));
            $msgobj->component = get_string('objective', 'local_plan');
            $msgobj->componentname = $record->fullname;
            $msgobj->comment = format_text($comment->content);
            $msgobj->commentby = fullname($commentuser);
            $msgobj->commentdate = userdate($comment->timecreated);
            $subject = get_string('commentmsg:componentitem', 'local_plan', $msgobj);
            $fullmsg = get_string('commentmsg:componentitemdetail', 'local_plan', $msgobj);

            $contexturl = $CFG->wwwroot.'/local/plan/components/objective/view.php?id='.$plan->id.'&amp;itemid='.$comment->itemid.'#comments';
            $contexturlname = $record->fullname;
            $icon = 'objective-newcomment';
            break;
        case 'plan-program-item':
            $sql = "SELECT pa.id, pa.planid, p.fullname
                FROM {$CFG->prefix}dp_plan_program_assign pa
                INNER JOIN {$CFG->prefix}prog p ON pa.programid = p.id
                WHERE pa.id = {$comment->itemid}";
            if (!$record = get_record_sql($sql)) {
                print_error('comment_error:itemnotfound', 'local_plan');
            }
            $plan = get_record('dp_plan', 'id', $record->planid);

            $msgobj = new stdClass;
            $msgobj->plan = $plan->name;
            $msgobj->planowner = fullname(get_record('user', 'id', $plan->userid));
            $msgobj->component = get_string('program', 'local_plan');
            $msgobj->componentname = $record->fullname;
            $msgobj->comment = format_text($comment->content);
            $msgobj->commentby = fullname($commentuser);
            $msgobj->commentdate = userdate($comment->timecreated);
            $subject = get_string('commentmsg:componentitem', 'local_plan', $msgobj);
            $fullmsg = get_string('commentmsg:componentitemdetail', 'local_plan', $msgobj);

            $contexturl = $CFG->wwwroot.'/local/plan/components/program/view.php?id='.$plan->id.'&amp;itemid='.$comment->itemid.'#comments';
            $contexturlname = $record->fullname;
            $icon = 'program-newcomment';

            break;
        default:
            print_error('commenterror:unsupportedcomment', 'local_plan');
            break;
    }

    /// Get subscribers
    $subscribers = get_records_select('comments', "commentarea = '{$comment->commentarea}' AND itemid = {$comment->itemid} AND userid != {$comment->userid}", '', 'DISTINCT userid');
    $subscribers = !empty($subscribers) ? array_keys($subscribers) : array();
    $subscriberkeys = array();
    foreach ($subscribers as $s) {
        $subscriberkeys[$s] = $s;
    }
    $subscribers = $subscriberkeys;
    unset($subscriberkeys);

    $manager = totara_get_manager($plan->userid);
    $learner = get_record('user', 'id', $plan->userid);
    if ($comment->userid == $learner->id) {
        // Make sure manager is added to subscriber list
        if (!empty($manager)) {
            $subscribers[$manager->id] = $manager->id;
        }
    } elseif (!empty($manager) && $comment->userid == $manager->id) {
        // Make sure learner is added to subscriber list
        $subscribers[$learner->id] = $learner->id;
    } else {
        // Other commenter, so ensure learner and manager are added
        $subscribers[$learner->id] = $learner->id;
        if (!empty($manager)) {
            $subscribers[$manager->id] = $manager->id;
        }
    }

    /// Send message
    require_once($CFG->dirroot.'/local/totara_msg/eventdata.class.php');
    require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');
    $result = true;
    foreach ($subscribers as $sid) {
        $userto = get_record('user', 'id', $sid);
        $event = new stdClass;
        $event->userfrom = $commentuser;
        $event->userto = $userto;
        $event->contexturl = $contexturl;
        $event->contexturlname = $contexturlname;
        if (!empty($manager) && $sid == $manager->id) {
            $event->roleid = get_field('role', 'id', 'shortname', 'manager');
        }
        $event->icon = $icon;
        $event->subject = $subject;
        $event->fullmessage = format_text_email($fullmsg, FORMAT_HTML);
        $event->fullmessagehtml = $fullmsg;
        $event->fullmessageformat = FORMAT_HTML;

        $result = $result && tm_alert_send($event);
    }

    return $result;
}


/**
 * Update an assigned competency with an evidence with a default proficiency
 *
 * @access  public
 * @param   int     $competencyid
 * @param   int     $userid
 * @param   object  $component
 * @return  bool
 */
function plan_mark_competency_default($competencyid, $userid, $component) {
    global $CFG;

    if (count_records('comp_evidence', 'userid', $userid, 'competencyid', $competencyid)) {
        return;
    }

    // Identify the "default" value for this scale value
    $sql = "
        SELECT
            scale.defaultid
        FROM
            {$CFG->prefix}comp comp
        INNER JOIN
            {$CFG->prefix}comp_scale_assignments scaleasn
         ON scaleasn.frameworkid = comp.frameworkid
        INNER JOIN
            {$CFG->prefix}comp_scale scale
         ON scale.id = scaleasn.scaleid
        WHERE
            comp.id = {$competencyid}
    ";

    $records = get_records_sql($sql);

    // If no value, just keep on walking
    if (!$records) {
        return;
    }

    $rec = array_pop($records);
    $default = $rec->defaultid;
    require_once($CFG->dirroot.'/hierarchy/prefix/competency/evidence/lib.php');

    $details = new object();
    $details->assessmenttype = get_string('automateddefault', 'local_plan');
    hierarchy_add_competency_evidence($competencyid, $userid, $default, $component, $details, true, false);
}


/**
 * Set "default" evidence for all the competencies in the plan when it changes to active status
 *
 * @access  public
 * @param   object  $plan
 * @return  void
 */
function plan_activate_plan($plan) {
    $component = $plan->get_component('competency');
    $items = $component->get_assigned_items(DP_APPROVAL_APPROVED);
    foreach ($items as $compasn) {
        if (!$compasn->profscalevalueid) {
            plan_mark_competency_default($compasn->competencyid, $plan->userid, $component);
        }
    }
}

