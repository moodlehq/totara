<?php

require_once($CFG->dirroot . '/local/plan/development_plan.class.php');
require_once($CFG->dirroot . '/local/plan/roles.class.php');
require_once($CFG->dirroot . '/local/plan/components.class.php');
require_once($CFG->dirroot . '/local/plan/workflows.class.php');
require_once($CFG->libdir . '/tablelib.php');

// plan status values
define('DP_PLAN_STATUS_UNAPPROVED', 10);
define('DP_PLAN_STATUS_DECLINED', 30);
define('DP_PLAN_STATUS_APPROVED', 50);
define('DP_PLAN_STATUS_COMPLETE', 100);

// permission values
define('DP_PERMISSION_DENY', 10);
define('DP_PERMISSION_REQUEST', 30);
define('DP_PERMISSION_ALLOW', 50);
define('DP_PERMISSION_APPROVE', 70);

// due date modes
define('DP_DUEDATES_NONE', 0);
define('DP_DUEDATES_OPTIONAL', 1);
define('DP_DUEDATES_REQUIRED', 2);

// priority modes
define('DP_PRIORITY_NONE', 0);
define('DP_PRIORITY_OPTIONAL', 1);
define('DP_PRIORITY_REQUIRED', 2);

// maximum number of priority options
define('DP_MAX_PRIORITY_OPTIONS', 5);

// approval
define('DP_APPROVAL_DECLINED',          10);
define('DP_APPROVAL_UNAPPROVED',        20);
define('DP_APPROVAL_APPROVED',          50);
define('DP_APPROVAL_REQUEST_REMOVAL',   60);

//Plan notices
define('DEVELOPMENT_PLAN_UNKNOWN_BUTTON_CLICKED', 1);
define('DEVELOPMENT_PLAN_GENERAL_CONFIRM_UPDATE', 2);
define('DEVELOPMENT_PLAN_GENERAL_FAILED_UPDATE', 3);
/*define('', 4);
define('', 5);
define('', 6);
define('', 7);
define('', 8);
define('', 9);
define('', 10);*/


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
);

// note that new templates will default to the first workflow in this list
global $DP_AVAILABLE_WORKFLOWS;
$DP_AVAILABLE_WORKFLOWS = array(
    'userdriven',
    'managerdriven',
);

function dp_get_plans($userid, $statuses=array(DP_PLAN_STATUS_APPROVED)) {
    if (is_array($statuses)) {
        $statuses = implode(',', $statuses);
    }
    return get_records_select('dp_plan', "userid = {$userid} AND status IN ({$statuses})");
}

//Used to create a timestamp from a string
function dp_convert_userdate($datestring) {
    // Check for DD/MM/YYYY
    if (preg_match('|(\d{1,2})/(\d{1,2})/(\d{4})|', $datestring, $matches)) {
        return mktime(0,0,0,$matches[2], $matches[1], $matches[3]);
    }
    return strtotime($datestring);
}

// Priority Scale methods
function dp_get_priorities() {
    return get_records('dp_priority_scale', '', '', 'sortorder');
}

function dp_get_priority_scale_values_menu($idpid=0) {
    global $CFG;

    $sql = "SELECT val.id, val.name FROM {$CFG->prefix}idp_tmpl_priority_scal_val val
            JOIN {$CFG->prefix}idp_tmpl_priority_scale ps ON val.priorityscaleid=ps.id
            JOIN {$CFG->prefix}idp_tmpl_priority_assign pa ON ps.id=pa.priorityscaleid
            JOIN {$CFG->prefix}idp_template temp ON pa.templateid=temp.id
            JOIN {$CFG->prefix}idp i ON temp.id=i.templateid ";
    if (!empty($idpid)) {
        $sql .= " WHERE i.id={$idpid} ORDER BY val.sortorder ASC";
    }

    $priorities = get_records_sql($sql);

    return is_array($priorities) ? $priorities : array();
}

function dp_get_priority_default_scale_value($idpid) {
    global $CFG;
    $sql = "SELECT val.* FROM {$CFG->prefix}dp_priority_scale_value val
            JOIN {$CFG->prefix}dp_priority_scale ps ON val.id=ps.defaultid
            JOIN {$CFG->prefix}dp_priority_assign pa ON ps.id=pa.priorityscaleid
            JOIN {$CFG->prefix}idp_template temp ON pa.templateid=temp.id
            JOIN {$CFG->prefix}idp i ON temp.id=i.templateid
            WHERE i.id = {$idpid}";

     return get_record_sql($sql);
}

// Objective Scale methods
function dp_get_objectives() {
    return get_records('dp_objective_scale', '', '', 'sortorder');
}

function dp_get_objective_scale_values_menu($idpid=0) {
    global $CFG;

    $sql = "SELECT val.id, val.name FROM {$CFG->prefix}idp_tmpl_priority_scal_val val
            JOIN {$CFG->prefix}idp_tmpl_priority_scale ps ON val.priorityscaleid=ps.id
            JOIN {$CFG->prefix}idp_tmpl_priority_assign pa ON ps.id=pa.priorityscaleid
            JOIN {$CFG->prefix}idp_template temp ON pa.templateid=temp.id
            JOIN {$CFG->prefix}idp i ON temp.id=i.templateid ";
    if (!empty($idpid)) {
        $sql .= " WHERE i.id={$idpid} ORDER BY val.sortorder ASC";
    }

    $priorities = get_records_sql($sql);

    return is_array($priorities) ? $priorities : array();
}

function dp_get_objective_default_scale_value($idpid) {
    global $CFG;
    $sql = "SELECT val.* FROM {$CFG->prefix}dp_priority_scale_value val
            JOIN {$CFG->prefix}dp_priority_scale ps ON val.id=ps.defaultid
            JOIN {$CFG->prefix}dp_priority_assign pa ON ps.id=pa.priorityscaleid
            JOIN {$CFG->prefix}idp_template temp ON pa.templateid=temp.id
            JOIN {$CFG->prefix}idp i ON temp.id=i.templateid
            WHERE i.id = {$idpid}";

     return get_record_sql($sql);
}


/**
 * Return a list of user IDs of users who can receive notification emails
//TODO: remove _2 from method once old IDP is removed
 */
function dp_get_notification_receivers_2($contextuser, $type) {
    global $USER;

    $receivers = array();

    $users = get_users_by_capability($contextuser, "local/plan:receive{$type}notifications");
    if ($users and count($users) > 0) {
        foreach ($users as $key => $user) {
            if ($user->id != $USER->id) {
                $receivers[] = $user->id;
            }
        }
    }

    return $receivers;
}

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

function dp_add_permissions_table_row(&$form, $name, $label, $requestable){
    $form->addElement('html', '<tr><td id="action">'.$label);
    $form->addElement('html', '</td><td id="learner">');
    dp_add_permissions_select($form, $name.'learner', $requestable);
    $form->addElement('html', '</td><td id="manager">');
    dp_add_permissions_select($form, $name.'manager', $requestable);
    $form->addElement('html', '</td></tr>');
}


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
                $compname = $configsetting ? $configsetting : get_string($parts[1].'_defaultname', 'local_plan');
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
                $compname = $configsetting ? $configsetting : get_string($parts[1].'_defaultname', 'local_plan');
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

                case 'autoassignpos':
                    $tablerow[] = $values['before'] == 0 ? get_string('no') : get_string('yes');
                    $tablerow[] = $values['after'] == 0 ? get_string('no') : get_string('yes');
                    break;

                case 'autoassignorg':
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
 * Returns an plan approval picker using the specified name and selected option
 *
 * @param string $name The value to enter in the form element's name attribute
 * @param string $selected Value of the option that should be selected
 * @param bool $choose If true, picker contains a 'Choose' option
 *
 * @return string HTML to generate the picker
 */
function dp_display_approval_options($name, $selected=DP_APPROVAL_UNAPPROVED, $choose=true) {
    if($choose) {
        $choosestr = 'choose';
        $chooseval = DP_APPROVAL_UNAPPROVED;
    } else {
        $choosestr = null;
        $chooseval = null;
    }
    $options = array(
        DP_APPROVAL_APPROVED => get_string('approve', 'local_plan'),
        DP_APPROVAL_DECLINED => get_string('decline', 'local_plan'),
    );
    return choose_from_menu($options, $name, $selected, $choosestr, '', $chooseval, true);
}

function dp_display_plans($userid, $statuses=array(DP_PLAN_STATUS_APPROVED), $cols=array('duedate', 'progress', 'completed')) {
    global $CFG;

    $statuses = is_array($statuses) ? implode(',', $statuses) : $statuses;
    $cols = is_array($cols) ? $cols : array($cols);

    // Construct sql query
    $count = 'SELECT COUNT(*) ';
    $select = "SELECT p.*,
        (SELECT timemodified FROM {$CFG->prefix}dp_plan_history ph WHERE ph.planid = p.id ORDER BY id DESC LIMIT 1)
        AS timemodified ";
    $from = "FROM {$CFG->prefix}dp_plan p ";
    $where = "WHERE userid = {$userid} AND status IN ({$statuses}) ";
    $count = count_records_sql($count.$from.$where);

    // Set up table
    $tablename = str_replace(',', '-', $statuses);
    $tablename = 'plans-list-'.$tablename;
    $tableheaders = array();
    $tablecols = array('p,name');

    // Determine what the first column should be
    if (in_array('activeplans', $cols)) {
	$tableheaders[] = get_string('activeplans', 'local_plan');
    }
    else if (in_array('completedplans', $cols)) {
	$tableheaders[] = get_string('completedplans', 'local_plan');
    }
    else {
	$tableheaders[] = get_string('plan', 'local_plan');
    }

    if (in_array('duedate', $cols)) {
        $tableheaders[] = get_string('duedate', 'local_plan');
        $tablecols[] = 'p.enddate';
    }
    if (in_array('progress', $cols)) {
        $tableheaders[] = get_string('progress', 'local_plan');
        $tablecols[] = 'p.status';
    }
    if (in_array('completed', $cols)) {
        $tableheaders[] = get_string('completed', 'local_plan');
        $tablecols[] = 'p.timemodified';
    }

    // Actions
    $tableheaders[] = '';
    $tablecols[] = 'actioncontrols';

    $table = new flexible_table($tablename);
    $table->define_headers($tableheaders);
    $table->define_columns($tablecols);
    $table->set_attribute('class', 'logtable generalbox');
    $table->set_attribute('width', '97%');
    //$table->column_style('actioncontrols', 'width', '70px');
    $table->sortable(true);
    $table->setup();
    $table->pagesize(5, $count);
    $sort = $table->get_sql_sort();
    $sort = empty($sort) ? '' : ' ORDER BY '.$sort;

    // Add table data
    $plans = get_records_sql($select.$from.$where.$sort, $table->get_page_start(), $table->get_page_size());
    if (!$plans) {
	return;
    }
    foreach ($plans as $p) {
	    $plan = new development_plan($p->id);
	    $row = array();
	    $row[] = $plan->display_summary_widget();
	    if (in_array('duedate', $cols)) {
		$row[] = $plan->display_enddate();
	    }
	    if (in_array('progress', $cols)) {
		$row[] = $plan->display_progress();
	    }
	    if (in_array('completed', $cols)) {
		$row[] = $plan->display_completeddate();
	    }
	    $row[] = $plan->display_actions();

	    $table->add_data($row);
    }

    ob_start();
    $table->print_html();
    $out = ob_get_contents();
    ob_end_clean();

    return $out;
}

function dp_display_plans_menu($userid, $selectedid=0, $role='learner') {
    global $CFG;

    $out = '<div id="dp-plans-menu">';

    if ($role == 'manager') {
	// Print out the All team members link
	$out .= print_heading(get_string('teammembers', 'local_plan'), 'left', 3, 'main', true);
	$class = $userid == 0 ? 'class="dp-menu-selected"' : '';
	$out .= "<ul><li {$class} ><a href=\"{$CFG->wwwroot}/my/teammembers.php\">";
	$out .= get_string('allteammembers', 'local_plan');
	$out .= "</a></li></ul>";
	if ($userid) {
	    // Display who we are currently viewing if appropriate
	    $out .= print_heading(get_string('currentlyviewing', 'local_plan'), 'left', 3, 'main', true);
	    // TODO: make this more efficient
	    $user = get_record('user','id',$userid);
	    $class = $selectedid == 0 ? 'class="dp-menu-selected"' : '';
	    $out .= "<ul><li {$class} ><a href=\"{$CFG->wwwroot}/local/plan/index.php?userid={$userid}\">{$user->firstname} {$user->lastname}</a></li></ul>";
	}
    }

    // Display active plans
    if ($plans = dp_get_plans($userid, array(DP_PLAN_STATUS_APPROVED, DP_PLAN_STATUS_UNAPPROVED))) {
	if ($role == 'manager') {
	    $out .= '<div class="dp-plans-menu-section"><h4 class="dp-plans-menu-sub-header">' . get_string('activeplans', 'local_plan') . '</h4>';
	}
	else {
	    $out .= print_heading(get_string('activeplans', 'local_plan'), 'left', 3, 'main', true);
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

    if ($plans = dp_get_plans($userid, DP_PLAN_STATUS_COMPLETE)) {
	if ($role == 'manager') {
	    $out .= '<div class="dp-plans-menu-section"><h4 class="dp-plans-menu-sub-header">' . get_string('completedplans', 'local_plan') . '</h4>';
	}
	else {
	    $out .= print_heading(get_string('completedplans', 'local_plan'), 'left', 3, 'main', true);
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

    $out .= '</div>';

    return $out;
}


function dp_display_add_plan_icon($userid) {
    global $CFG;

    $out = '';
    $href = "{$CFG->wwwroot}/local/plan/add.php?userid={$userid}";
    $title = get_string('createplan', 'local_plan');
    $out = '';
    $out .= '<span class="dp-add-plan-link">';
    $out .= '	<form action="'.$href.'" method="GET">';
    $out .= '		<input type="submit" value="'.$title.'"/>';
    $out .= '		<input type="hidden" name="userid" value="'.$userid.'"/>';
    $out .= '	<form>';
    $out .= '</span>';

    return $out;
}


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

function dp_plan_delete($planid) {
    $plan = new development_plan($planid);

    return $plan->delete();
}

function dp_get_first_template() {
    if (!$template = get_records('dp_template', '','', 'sortorder', '*', '', 1)) {;
        return false;
    }

    return reset($template);
}

function dp_get_template_permission($templateid, $component, $action, $role) {
    if ($permission = get_record_select('dp_permissions', "templateid={$templateid} AND role='{$role}' AND component='{$component}' AND action='{$action}'", 'value')) {
        return $permission->value;
    } else {
        return false;
    }
}


/**
 * Checks to see if an approval value is
 * approved or greater
 *
 * @access  public
 * @param   $value  integer  Approval constant e.g. DP_APPROVAL_*
 * @return  boolean
 */
function dp_is_approved($value) {
    return $value >= DP_APPROVAL_APPROVED;
}

/**
 * Return the id of the user's manager if it is
 * defined. Otherwise return false.
 *
 * @param integer $userid User ID of the staff member
 */
function dp_get_manager($userid) {
    global $CFG;
    $roleid = get_field('role','id','shortname', 'manager');

    if ($roleid) {
        $sql = "SELECT ra.userid AS managerid
            FROM {$CFG->prefix}pos_assignment pa
            LEFT JOIN {$CFG->prefix}role_assignments ra ON pa.reportstoid=ra.id
            WHERE pa.userid=$userid AND ra.roleid=$roleid AND pa.type=1"; // just use primary position for now
        $res = get_record_sql($sql);
        if($res && isset($res->managerid)) {
            return $res->managerid;
        } else {
            return false; // No manager set
        }
    }
    else {
        return false; // No manager role, can't do it
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
function dp_record_status_picker($pagename, $status) {
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

    // display status pulldown
    $out .= popup_form(
        $CFG->wwwroot . '/local/plan/record/' . $pagename . '.php?status=',
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
