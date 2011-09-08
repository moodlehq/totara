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
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot.'/local/plan/lib.php');

class dp_objective_component extends dp_base_component {

    public static $permissions = array(
        'updateobjective' => true,
        //'commenton' => false,
        'setpriority' => false,
        'setduedate' => false,
        'setproficiency' => false
    );


    /**
     * Constructor, set default name
     *
     * @access  public
     * @param   object  $plan
     * @return  void
     */
    public function __construct($plan) {
        parent::__construct($plan);
        $this->defaultname = get_string('objectives', 'local_plan');
    }


    /**
     * Initialize settings for the component
     *
     * @access  public
     * @param   array   $settings
     * @return  void
     */
    public function initialize_settings(&$settings) {
        if ($objectivesettings = get_record('dp_objective_settings', 'templateid', $this->plan->templateid)) {
            $settings[$this->component.'_duedatemode'] = $objectivesettings->duedatemode;
            $settings[$this->component.'_prioritymode'] = $objectivesettings->prioritymode;
            $settings[$this->component.'_priorityscale'] = $objectivesettings->priorityscale;
            $settings[$this->component.'_objectivescale'] = $objectivesettings->objectivescale;
        }
    }


    /**
     * Get list of items assigned to plan
     *
     * Optionally, filtered by status
     *
     * @access  public
     * @param   mixed   $approved   (optional)
     * @param   string  $orderby    (optional)
     * @param   int     $limitfrom  (optional)
     * @param   int     $limitnum   (optional)
     * @return  array
     */
    public function get_assigned_items($approved = null, $orderby='', $limitfrom='', $limitnum='') {
        global $CFG;

        // Generate where clause
        $where = "a.planid = {$this->plan->id}";
        if ($approved !== null) {
            if (is_array($approved)) {
                $approved = implode(', ', $approved);
            }
            $where .= " AND a.approved IN ({$approved})";
        }

        // Generate order by clause
        if ($orderby) {
            $orderby = "ORDER BY $orderby";
        }

        // Generate status code
        $status = "LEFT JOIN {$CFG->prefix}dp_objective_scale_value osv ON a.scalevalueid = osv.id ";

        $assigned = get_records_sql(
            "
            SELECT
                a.*,
                a.scalevalueid AS progress,
                a.fullname AS name,
                CASE WHEN linkedcourses.count IS NULL
                    THEN 0 ELSE linkedcourses.count
                END AS linkedcourses,
                osv.achieved
            FROM
                {$CFG->prefix}dp_plan_objective a
            LEFT JOIN
                (SELECT itemid2 AS assignid,
                    count(id) AS count
                    FROM {$CFG->prefix}dp_plan_component_relation
                    WHERE component2='objective' AND
                        component1='course'
                    GROUP BY itemid2) linkedcourses
                ON linkedcourses.assignid = a.id
            $status
            WHERE
                $where
                $orderby
            ",
            $limitfrom,
            $limitnum
        );

        if (!$assigned) {
            $assigned = array();
        }

        return $assigned;
    }


    /**
     * Process an action
     *
     * General component actions can come in here
     *
     * @access  public
     * @return  void
     */
    public function process_action_hook() {
        // Put any relevant actions that should be performed
        // on this component in here
    }


    /**
     * Code to load the JS for the picker
     *
     * @access  public
     * @return  void
     */
    public function setup_picker() {
        global $CFG;

        // If we are showing dialog
        if ($this->can_update_items()) {
            // Setup lightbox
            local_js(array(
                TOTARA_JS_DIALOG,
                TOTARA_JS_TREEVIEW
            ));

            require_js(array(
                $CFG->wwwroot.'/local/plan/component.js.php?planid='.$this->plan->id.'&amp;component=objective&amp;viewas='.$this->plan->viewas,
            ));
        }
    }


    /**
     * Generates a flexibletable of details for all the specified linked objectives
     * of a component
     *
     * @global object $CFG
     * @param array $list of objective ids
     * @return string
     */
    function display_linked_objectives($list) {
        global $CFG;

        if(!is_array($list) || count($list) == 0) {
            return false;
        }

        $showduedates = ($this->get_setting('duedatemode') == DP_DUEDATES_OPTIONAL ||
            $this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED);
        $showpriorities = ($this->get_setting('prioritymode') == DP_PRIORITY_OPTIONAL ||
            $this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;

        $objectivename = get_string('objective', 'local_plan');

        // Get data
        $select = 'SELECT po.*, po.fullname AS objname,
            osv.name AS proficiency, psv.name AS priorityname ';
        $from = "FROM {$CFG->prefix}dp_plan_objective po
            LEFT JOIN {$CFG->prefix}dp_objective_scale_value osv ON po.scalevalueid = osv.id
            LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                ON po.priority = psv.id AND psv.priorityscaleid = {$priorityscaleid} ";
        $where = 'WHERE po.id IN ('.implode(',', $list).') ';
        $sort = "ORDER BY po.fullname ";
        if (!$records = get_recordset_sql($select.$from.$where.$sort)) {
            return false;
        }

        // get the scale values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        // Set up table
        $tableheaders = array(
            get_string('name'),
            get_string('status', 'local_plan'),
        );
        $tablecolumns = array(
            'fullname',
            'proficiency',
        );

        if($showpriorities) {
            $tableheaders[] = get_string('priority', 'local_plan');
            $tablecolumns[] = 'priorityname';
        }

        if($showduedates) {
            $tableheaders[] = get_string('duedate', 'local_plan');
            $tablecolumns[] = 'duedate';
        }

        $table = new flexible_table('linkedobjectivelist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->setup();

        while ($o = rs_fetch_next_record($records)) {
            $row = array();
            $row[] = $this->display_item_name($o);
            $row[] = $o->proficiency;
            if($showpriorities) {
                $row[] = $this->display_priority_as_text($o->priority, $o->priorityname, $priorityvalues);
            }
            if($showduedates) {
                $row[] = $this->display_duedate_as_text($o->duedate);
            }

            $table->add_data($row);
        }

        // return instead of outputing table contents
        ob_start();
        $table->print_html();
        $out = ob_get_contents();
        ob_end_clean();

        return $out;
    }


    /**
     * Display item's name
     *
     * @access  public
     * @param   object  $item
     * @return  string
     */
    function display_item_name($item) {
        global $CFG;
        $approved = $this->is_item_approved($item->approved);

        $class = ($approved) ? '' : ' class="dimmed"';

        $icon = $this->determine_item_icon($item);
        return '<img class="objective_state_icon" src="' .
            $CFG->wwwroot . '/local/icon/icon.php?icon=' . $icon .
            '&amp;size=small&amp;type=msg" alt="' . $item->fullname.
            '"><a' . $class .' href="' . $CFG->wwwroot .
            '/local/plan/components/' . $this->component.'/view.php?id=' .
            $this->plan->id . '&amp;itemid=' . $item->id . '">' . $item->fullname .
            '</a>';
    }


    /**
     * Display the items related icon
     *
     * @param object $item the item being checked
     * @return string
     */
    function determine_item_icon($item) {
        // @todo in future the item state will determine the icon
        return "objective-regular";
    }


    /**
     * Create a form object for the data in an objective
     * @global object $CFG
     * @param int $objectiveid
     * @return plan_objective_edit_form
     */
    function objective_form($objectiveid=null) {
        global $CFG;
        require_once($CFG->dirroot.'/local/plan/components/objective/edit_form.php');
        $customdata = array(
            'plan' => $this->plan,
            'objective' => $this
        );
        if ( empty($objectiveid) ){
            return new plan_objective_edit_form( null, $customdata );
        } else {

            if (!$objective = get_record('dp_plan_objective', 'id', $objectiveid)){
                error(get_string('error:objectiveidincorrect', 'local_plan'));
            }
            $objective->itemid = $objective->id;
            $objective->id = $objective->planid;
            unset($objective->planid);

            $mform = new plan_objective_edit_form(
                    null,
                    array(
                        'plan'=>$this->plan,
                        'objective'=>$this,
                        'objectiveid'=>$objectiveid
                    )
            );
            $mform->set_data($objective);
            return $mform;
        }
    }


    /**
     * Process component's settings update
     *
     * @access  public
     * @param   bool    $ajax   Is an AJAX request (optional)
     * @return  void
     */
    public function process_settings_update($ajax = false) {
        global $CFG;

        if (!confirm_sesskey()) {
            return 0;
        }
        // @todo validation notices, including preventing empty due dates
        // if duedatemode is required
        $cansetduedates = ($this->get_setting('setduedate') == DP_PERMISSION_ALLOW);
        $cansetpriorities = ($this->get_setting('setpriority') == DP_PERMISSION_ALLOW);
        $cansetprofs = ($this->get_setting('setproficiency') == DP_PERMISSION_ALLOW);
        $canapprovecomps = ($this->get_setting('updateobjective') == DP_PERMISSION_APPROVE);
        $duedates = optional_param('duedate_objective', array(), PARAM_TEXT);
        $priorities = optional_param('priorities_objective', array(), PARAM_INT);
        $proficiencies = optional_param('proficiencies', array(), PARAM_INT);
        $approvals = optional_param('approve_objective', array(), PARAM_INT);
        $currenturl = qualified_me();
        $stored_records = array();
        $currentuser = $this->plan->userid;

        $status = true;
        if (!empty($duedates) && $cansetduedates) {
            // Update duedates
            foreach ($duedates as $id => $duedate) {
                // allow empty due dates
                if ($duedate == '' || $duedate == 'dd/mm/yy') {
                    if ($this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED) {
                        $duedateout = $this->plan->enddate;
                    } else {
                        $duedateout = null;
                    }
                } else {
                    $datepattern = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{2})$/';
                    if (preg_match($datepattern, $duedate, $matches) == 0) {
                        // skip badly formatted date strings
                        continue;
                    }
                    $day = $matches[1];
                    $mon = $matches[2];
                    $year = $matches[3];

                    $duedateout = make_timestamp($year, $mon, $day);
                }
                $todb = new object();
                $todb->id = $id;
                $todb->duedate = $duedateout;
                $stored_records[$id] = $todb;
            }
        }

        if (!empty($priorities) && $cansetpriorities) {
            foreach ($priorities as $id => $priority) {
                $priority = (int) $priority;
                if (array_key_exists($id, $stored_records)) {
                    // add to the existing update object
                    $stored_records[$id]->priority = $priority;
                } else {
                    // create a new update object
                    $todb = new object();
                    $todb->id = $id;
                    $todb->priority = $priority;
                    $stored_records[$id] = $todb;
                }
            }
        }

        if (!empty($proficiencies) && $cansetprofs) {
            foreach ($proficiencies as $id => $proficiency){
                $proficiency = (int) $proficiency;
                if (array_key_exists($id, $stored_records) ){
                    // add to the existing update object
                    $stored_records[$id]->scalevalueid = $proficiency;
                } else {
                    // Create a new update object
                    $todb = new stdClass();
                    $todb->id = $id;
                    $todb->scalevalueid = $proficiency;
                    $stored_records[$id] = $todb;
                }
                $count = count_records('block_totara_stats', 'userid', $currentuser, 'eventtype', STATS_EVENT_OBJ_ACHIEVED, 'data2', $id);
                $scalevalue = get_record('dp_objective_scale_value', 'id', $proficiency);
                if (empty($scalevalue)) {
                    error(get_string('error:priorityscalevalueidincorrect','local_plan'));
                    // checks objective can only be achieved once.
                } else if ($scalevalue->achieved == 1 && $count < 1) {
                    totara_stats_add_event(time(), $currentuser, STATS_EVENT_OBJ_ACHIEVED, '', $id);
                    // checks objective exists for removal
                } else if ($scalevalue->achieved == 0 && $count > 0) {
                    totara_stats_remove_event($currentuser, STATS_EVENT_OBJ_ACHIEVED, $id);
                }
            }
        }

        if (!empty($approvals) && $canapprovecomps) {
            // Update approvals
            foreach ($approvals as $id => $approval) {
                if (!$approval) {
                    continue;
                }
                if (array_key_exists($id, $stored_records)) {
                    // add to the existing update object
                    $stored_records[$id]->approved = $approval;
                } else {
                    // create a new update object
                    $todb = new object();
                    $todb->id = $id;
                    $todb->approved = $approval;
                    $stored_records[$id] = $todb;
                }
            }
        }
        $status = true;

        // save before snapshot of objectives

        if (!empty($stored_records)) {
            $orig_objectives = get_records_list('dp_plan_objective', 'id', implode(',', array_keys($stored_records)));
            begin_sql();

            foreach ($stored_records as $itemid => $record) {
                $record = addslashes_recursive($record);
                $status = $status & update_record('dp_plan_objective', $record);

                if (isset($record->scalevalueid)) {
                    $scale_value_record = get_record('dp_objective_scale_value', 'id', $record->scalevalueid);
                    if ($scale_value_record->achieved == 1) {
                        dp_plan_item_updated($currentuser, 'objective', $id);
                    }
                }
            }
            if ($status) {
                commit_sql();

                // Process update alerts
                $updates = '';
                $approvals = null;
                $objheader = '<p><strong>'.format_string($orig_objectives[$itemid]->fullname).": </strong><br>";
                $objprinted = false;
                foreach($stored_records as $itemid => $record) {
                    // priority may have been updated
                    if (!empty($record->priority) && array_key_exists($itemid, $orig_objectives) &&
                        $record->priority != $orig_objectives[$itemid]->priority) {

                        $oldpriority = get_field('dp_priority_scale_value', 'name', 'id',
                            $orig_objectives[$itemid]->priority);
                        $newpriority = get_field('dp_priority_scale_value', 'name', 'id', $record->priority);
                        $updates .= $objheader;
                        $objprinted = true;
                        $updates .= get_string('priority', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>$oldpriority, 'after'=>$newpriority))."<br>";
                    }

                    // duedate may have been updated
                    if (!empty($record->duedate) && array_key_exists($itemid, $orig_objectives) &&
                        $record->duedate != $orig_objectives[$itemid]->duedate) {

                        $updates .= $objprinted ? '' : $objheader;
                        $objprinted = true;
                        $updates .= get_string('duedate', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>empty($orig_objectives[$itemid]->duedate) ? '' :
                                userdate($orig_objectives[$itemid]->duedate, '%e %h %Y', $CFG->timezone, false),
                                'after'=>userdate($record->duedate, '%e %h %Y', $CFG->timezone, false)))."<br>";
                    }

                    // proficiency may have been updated
                    if (!empty($record->scalevalueid) && array_key_exists($itemid, $orig_objectives) &&
                        $record->scalevalueid != $orig_objectives[$itemid]->scalevalueid) {

                        $oldprof = get_field('dp_objective_scale_value', 'name', 'id',
                            $orig_objectives[$itemid]->scalevalueid);
                        $newprof = get_field('dp_objective_scale_value', 'name', 'id', $record->scalevalueid);
                        $updates .= $objprinted ? '' : $objheader;
                        $objprinted = true;
                        $updates .= get_string('status', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>$oldprof, 'after'=>$newprof))."<br>";
                    }

                    // approval status change
                    if (!empty($record->approved) && array_key_exists($itemid, $orig_objectives) &&
                        $record->approved != $orig_objectives[$itemid]->approved) {

                        $approval = new object();
                        $text = $objheader;
                        $text .= get_string('approval', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>dp_get_approval_status_from_code($orig_objectives[$itemid]->approved),
                            'after'=>dp_get_approval_status_from_code($record->approved)))."<br>";
                        $approval->text = $text;
                        $approval->itemname = $orig_objectives[$itemid]->fullname;
                        $approval->before = $orig_objectives[$itemid]->approved;
                        $approval->after = $record->approved;
                        $approvals[] = $approval;

                    }
                }  // foreach

                // Send update alert
                if ($this->plan->status != DP_PLAN_STATUS_UNAPPROVED && strlen($updates)) {
                    $this->send_component_update_alert($updates);
                }

                if ($this->plan->status != DP_PLAN_STATUS_UNAPPROVED && count($approvals)>0) {
                    foreach($approvals as $approval) {
                        $this->send_component_approval_alert($approval);

                        $action = ($approval->after == DP_APPROVAL_APPROVED) ? 'approved' : 'declined';
                        add_to_log(SITEID, 'plan', "{$action} objective", "component.php?id={$this->plan->id}&amp;c=objective", $approval->itemname);
                    }
                }
            } else {
                rollback_sql();
            }

            if ($this->plan->reviewing_pending) {
                return $status;
            } elseif (!$ajax) {
                if ($status) {
                    totara_set_notification(get_string('objectivesupdated','local_plan'), $currenturl, array('style'=>'notifysuccess'));
                } else {
                    totara_set_notification(get_string('objectivesnotupdated','local_plan'), $currenturl);
                }
            }
        }

        if ($this->plan->reviewing_pending) {
            return null;
        }

        // Do not redirect if ajax request
        if (!$ajax) {
            redirect($currenturl);
        }
    }


    /**
     * Returns true if any objectives use the scale given
     *
     * @param integer $scaleid
     * return boolean
     */
    public static function is_priority_scale_used($scaleid) {
        global $CFG;
        $sql = "
            SELECT o.id
            FROM {$CFG->prefix}dp_plan_objective o
            LEFT JOIN
                {$CFG->prefix}dp_priority_scale_value psv
            ON o.priority = psv.id
            WHERE psv.priorityscaleid = {$scaleid}";
        return record_exists_sql($sql);
    }


    /**
     * Completely delete an objective
     * @param int $caid
     * @return boolean success or failure
     */
    function delete_objective($caid) {
        global $USER;
        // need permission to remove this objective
        if (!$this->can_update_items()) {
            return false;
        }

        // store objective details for alerts
        $objective = get_record('dp_plan_objective', 'id', $caid);

        begin_sql();
        $result = delete_records('dp_plan_objective', 'id', $caid);
        $result = $result && delete_records('dp_plan_component_relation', 'component1', 'objective', 'itemid1', $caid);
        $result = $result && delete_records('dp_plan_component_relation', 'component2', 'objective', 'itemid2', $caid);
        commit_sql();

        // are we OK? then send the alerts
        if ($result) {
            add_to_log(SITEID, 'plan', 'deleted objective', "component.php?id={$this->plan->id}&amp;c=objective", "{$objective->fullname} (ID:{$caid})");
            $this->send_deletion_alert($objective);
            dp_plan_check_plan_complete(array($this->plan->id));
        }

        return $result;
    }

    /**
     * Create a new objective. (Does not check for permissions)
     *
     * @param string $fullname Name of the objective
     * @param string $description A description of the objective (optional)
     * @param int $priority The objective's priority scale value (optional)
     * @param int $duedate The objective's due date (optional)
     * @param int $scalevalueid The objective's objective scale value (optional)
     *
     * @return boolean True on success
     */
    public function create_objective($fullname, $description=null, $priority=null, $duedate=null, $scalevalueid=null) {
        global $USER;
        if ( !$this->can_update_items() ){
            return false;
        }

        $rec = new stdClass();
        $rec->planid = $this->plan->id;
        $rec->fullname = $fullname;
        $rec->description = $description;
        $rec->priority = $priority;
        $rec->duedate = $duedate;
        $rec->scalevalueid = $scalevalueid ? $scalevalueid : get_field('dp_objective_scale', 'defaultid', 'id', $this->get_setting('objectivescale'));
        $rec->approved = $this->approval_status_after_update();

        if($result = insert_record('dp_plan_objective', $rec)) {
            $this->send_creation_alert($result, $fullname);
            add_to_log(SITEID, 'plan', 'added objective', "component.php?id={$rec->planid}&amp;c=objective", $rec->fullname);
            dp_plan_item_updated($USER->id, 'objective', $result);
        }

        return $result;
    }

    /**
     * send objective deletion alert
     * @param object $objective Objective details
     * @return nothing
     */
    function send_deletion_alert($objective) {
        global $USER, $CFG;
        require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

        $event = new stdClass;
        $userfrom = get_record('user', 'id', $USER->id);
        $event->userfrom = $userfrom;
        $event->contexturl = "{$CFG->wwwroot}/local/plan/view.php?id={$this->plan->id}";
        $event->icon = 'objective-remove';
        $a = new stdClass;
        $a->objective = $objective->fullname;
        $a->userfrom = $this->current_user_link();
        $a->plan = "<a href=\"{$event->contexturl}\" title=\"{$this->plan->name}\">{$this->plan->name}</a>";

        // did they delete it themselves?
        if ($USER->id == $this->plan->userid) {
            // don't bother if the plan is not active
            if ($this->plan->is_active()) {
                // notify their manager
                if ($manager = totara_get_manager($this->plan->userid)) {
                    $event->userto = $manager;
                    $event->subject = get_string('objectivedeleteshortmanager', 'local_plan', $this->current_user_link());
                    $event->fullmessage = get_string('objectivedeletelongmanager', 'local_plan', $a);
                    $event->roleid = get_field('role','id', 'shortname', 'manager');
                    tm_alert_send($event);
                }
            }
        }
        // notify user that someone else did it
        else {
            $userto = get_record('user', 'id', $this->plan->userid);
            $event->userto = $userto;
            $event->subject = get_string('objectivedeleteshortlearner', 'local_plan', $a->objective);
            $event->fullmessage = get_string('objectivedeletelonglearner', 'local_plan', $a);
            tm_alert_send($event);
        }
    }

    /**
     * send objective creation alert
     * @param int $objid Objective Id
     * @param string $fullname the title of the objective
     * @return nothing
     */
    function send_creation_alert($objid, $fullname) {
        global $USER, $CFG;
        require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

        $event = new stdClass;
        $userfrom = get_record('user', 'id', $USER->id);
        $event->userfrom = $userfrom;
        $event->contexturl = "{$CFG->wwwroot}/local/plan/components/objective/view.php?id={$this->plan->id}&itemid={$objid}";
        $event->icon = 'objective-add';
        $a = new stdClass;
        $a->objective = "<a href=\"{$event->contexturl}\">".stripslashes($fullname)."</a>";
        $a->plan = "<a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$this->plan->id}\" title=\"{$this->plan->name}\">{$this->plan->name}</a>";
        $a->userfrom = $this->current_user_link();

        // did they create it themselves?
        if ($USER->id == $this->plan->userid) {
            // don't bother if the plan is not active
            if ($this->plan->is_active()) {
                // notify their manager
                if ($manager = totara_get_manager($this->plan->userid)) {
                    $event->userto = $manager;
                    $event->subject = get_string('objectivenewshortmanager', 'local_plan', $this->current_user_link());
                    $event->fullmessage = get_string('objectivenewlongmanager', 'local_plan', $a);
                    $event->roleid = get_field('role','id', 'shortname', 'manager');
                    tm_alert_send($event);
                }
            }
        }
        // notify user that someone else did it
        else {
            $userto = get_record('user', 'id', $this->plan->userid);
            $event->userto = $userto;
            $event->subject = get_string('objectivenewshortlearner', 'local_plan', $fullname);
            $event->fullmessage = get_string('objectivenewlonglearner', 'local_plan', $a);
            tm_alert_send($event);
        }
    }


    /**
     * send objective edit alert
     * @param object $objective Objective record
     * @param string $field field updated
     * @return nothing
     */
    function send_edit_alert($objective, $field) {
        global $USER, $CFG;
        require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

        $event = new stdClass;
        $userfrom = get_record('user', 'id', $USER->id);
        $event->userfrom = $userfrom;
        $event->contexturl = "{$CFG->wwwroot}/local/plan/components/objective/view.php?id={$this->plan->id}&itemid={$objective->id}";
        $event->icon = 'objective-update';
        $a = new stdClass;
        $a->objective = "<a href=\"{$event->contexturl}\">{$objective->fullname}</a>";
        $a->plan = "<a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$this->plan->id}\" title=\"{$this->plan->name}\">{$this->plan->name}</a>";
        $a->field = get_string('objective'.$field, 'local_plan');
        $a->userfrom = $this->current_user_link();

        // did they edit it themselves?
        if ($USER->id == $this->plan->userid) {
            // don't bother if the plan is not active
            if ($this->plan->is_active()) {
                // notify their manager
                if ($manager = totara_get_manager($this->plan->userid)) {
                    $event->userto = $manager;
                    $event->subject = get_string('objectiveeditshortmanager', 'local_plan', $this->current_user_link());
                    $event->fullmessage = get_string('objectiveeditlongmanager', 'local_plan', $a);
                    $event->roleid = get_field('role','id', 'shortname', 'manager');
                    tm_alert_send($event);
                }
            }
        }
        // notify user that someone else did it
        else {
            $userto = get_record('user', 'id', $this->plan->userid);
            $event->userto = $userto;
            $event->subject = get_string('objectiveeditshortlearner', 'local_plan', $a->objective);
            $event->fullmessage = get_string('objectiveeditlonglearner', 'local_plan', $a);
            tm_alert_send($event);
        }
    }

    /**
     * send objective status alert
     *
     * handles both complete and incomplete
     *
     * @param object $objective Objective record
     * @return nothing
     */
    function send_status_alert($objective) {
        global $USER, $CFG;
        require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

        // determined achieved/non-achieved status
        $achieved = get_field('dp_objective_scale_value', 'achieved', 'id', $objective->scalevalueid);
        $status = ($achieved ? 'complete' : 'incomplete');

        // build event message
        $event = new stdClass;
        $userfrom = get_record('user', 'id', $USER->id);
        $event->userfrom = $userfrom;
        $event->contexturl = "{$CFG->wwwroot}/local/plan/components/objective/view.php?id={$this->plan->id}&itemid={$objective->id}";
        $event->icon = 'objective-'.($status == 'complete' ? 'complete' : 'fail');
        $a = new stdClass;
        $a->objective = "<a href=\"{$event->contexturl}\">{$objective->fullname}</a>";
        $a->plan = "<a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$this->plan->id}\" title=\"{$this->plan->name}\">{$this->plan->name}</a>";
        $a->userfrom = $this->current_user_link();

        // did they complete it themselves?
        if ($USER->id == $this->plan->userid) {
            // don't bother if the plan is not active
            if ($this->plan->is_active()) {
                // notify their manager
                if ($manager = totara_get_manager($this->plan->userid)) {
                    $event->userto = $manager;
                    $event->subject = get_string('objective'.$status.'shortmanager', 'local_plan', $this->current_user_link());
                    $event->fullmessage = get_string('objective'.$status.'longmanager', 'local_plan', $a);
                    $event->roleid = get_field('role','id', 'shortname', 'manager');
                    tm_alert_send($event);
                }
            }
        }
        // notify user that someone else did it
        else {
            $userto = get_record('user', 'id', $this->plan->userid);
            $event->userto = $userto;
            $event->subject = get_string('objective'.$status.'shortlearner', 'local_plan', $a->objective);
            $event->fullmessage = get_string('objective'.$status.'longlearner', 'local_plan', $a);
            tm_alert_send($event);
        }
    }

    /**
     * Update instances of $componentupdatetype linked to the specified compoent,
     * delete links in db which aren't needed, and add links missing from db
     * which are needed
     *
     * specialised from super class to allow the hooking of alerts
     *
     * @param integer $thiscompoentid Identifies the component on one end of the link
     * @param string $componentupdatetype: the type of components on the other end of the links
     * @param array $componentids array of component ids that should be on the other end of the links in db
     *
     * @return void
     */
    function update_linked_components($thiscomponentid, $componentupdatetype, $componentids) {

        parent::update_linked_components($thiscomponentid, $componentupdatetype, $componentids);

        if ($componentupdatetype == 'course') {
            $objective = get_record('dp_plan_objective', 'id', $thiscomponentid);
            $this->send_edit_alert($objective, 'course');
        }

    }


    /**
     * Return just the "approval" field for an objective
     * @param int $caid
     * return int
     */
    public function get_approval($caid){
        return get_field('dp_plan_objective', 'approved', 'id', $caid);
    }

    /**
     * Indicates what the objective's approval status should be if the approval
     * is updated.
     * @return int (or false on failure)
     */
    public function approval_status_after_update( ){
        $perm = $this->can_update_items();
        if ( $perm == DP_PERMISSION_REQUEST ){
            return DP_APPROVAL_UNAPPROVED;
        }
        if ( in_array( $perm, array( DP_PERMISSION_ALLOW, DP_PERMISSION_APPROVE ) ) ){
            return DP_APPROVAL_APPROVED;
        }

        // In case something went wrong, fall back to unapproved status
        return DP_APPROVAL_UNAPPROVED;
    }


    /**
     * Indicates whether an update will revoke the "approved" status of the
     * component
     * @param <type> $caid
     * @return boolean
     */
    public function will_an_update_revoke_approval( $caid ){
        // If the resource is already approved, and the user has only REQUEST
        // permission, then it will revoke the approved status. Otherwise,
        // no change.
        if (
                $this->can_update_items() == DP_PERMISSION_REQUEST
                && $this->get_approval($caid) != DP_APPROVAL_UNAPPROVED
        ){
            return true;
        } else {
            return false;
        }
    }


    /**
     * Check if an item is complete
     *
     * @access  protected
     * @param   object  $item
     * @return  boolean
     */
    protected function is_item_complete($item) {
        return (bool) $item->achieved;
    }


    /**
     * Return the name of the component items table
     *
     * Overrides base class because objectives named differently
     *
     * @return string Name of the table containing item assignments
     */
    public function get_component_table_name() {
        return "dp_plan_objective";
    }


    /*********************************************************************************************
     *
     * Display methods
     *
     ********************************************************************************************/

    /**
     * Display an items progress status
     *
     * @access protected
     * @param object $item the item being checked
     * @return string the items status
     */
    protected function display_list_item_progress($item) {
        return $this->display_proficiency($item);
    }


    /**
     * Display an items available actions
     *
     * @access protected
     * @param object $item the item being checked
     * @return string $markup the display html
     */
    protected function display_list_item_actions($item) {
        global $CFG;

        $markup = '';

        if ($this->can_delete_item($item)) {
            $deleteurl = $CFG->wwwroot
                . '/local/plan/components/objective/edit.php?id='
                . $this->plan->id
                . '&itemid='
                . $item->id
                . '&d=1';
            $strdelete = get_string('delete', 'local_plan');
            $markup .= '<a href="'.$deleteurl.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';
        }

        return $markup;
    }


    /**
     * Return markup for javascript course picker
     *
     * @access public
     * @global object $CFG
     * @return string
     */
    public function display_picker() {
        global $CFG;

        if (!$permission = $this->can_update_items()) {
            return '';
        }

        // Decide on button text
        if ($permission >= DP_PERMISSION_ALLOW) {
            $btntext = get_string('addnewobjective', 'local_plan');
        } else {
            $btntext = get_string('requestednewobjective', 'local_plan');
        }

        $html = '<div class="buttons plan-add-item-button-wrapper">';
        $html .= print_single_button("{$CFG->wwwroot}/local/plan/components/objective/edit.php", array('id'=>$this->plan->id), $btntext, 'get', '_SELF', true);
        $html .= '</div>';

        return $html;
    }


    /*
     * Return markup for javascript course picker
     * objectiveid integer - the id of the objective for which selected& available courses should be displayed
     * @access  public
     * @return  string
     */
    public function display_course_picker($objectiveid) {

        if (!$permission = $this->can_update_items()) {
            return '';
        }

        $btntext = get_string('addlinkedcourses', 'local_plan');

        $html  = '<div class="buttons">';
        $html .= '<div class="singlebutton dp-plan-assign-button">';
        $html .= '<div>';
        $html .= '<script type="text/javascript">var objective_id = ' . $objectiveid . ';';
        $html .= 'var plan_id = ' . $this->plan->id . ';</script>';
        $html .= '<input type="submit" id="show-course-dialog" value="' . $btntext . '" />';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }


    /**
     * Print details about an objective
     * @global object $CFG
     * @param int $objectiveid
     * @return void
     */
    public function display_objective_detail($objectiveid){
        global $CFG;

        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;
        $objectivescaleid = $this->get_setting('objectivescale');
        $priorityenabled = $this->get_setting('prioritymode') != DP_PRIORITY_NONE;
        $duedateenabled = $this->get_setting('duedatemode') != DP_DUEDATES_NONE;
        $requiresapproval = $this->get_setting('updateobjective') == DP_PERMISSION_REQUEST;

        $sql = <<<SQL
            select
                o.id,
                o.fullname,
                o.description,
                o.approved,
                o.duedate,
                o.priority,
                psv.name AS priorityname,
                osv.name AS profname,
                osv.achieved
            from
                {$CFG->prefix}dp_plan_objective o
                left join {$CFG->prefix}dp_objective_scale_value osv on (o.scalevalueid=osv.id and osv.objscaleid={$objectivescaleid})
                left join {$CFG->prefix}dp_priority_scale_value psv on (o.priority=psv.id and psv.priorityscaleid={$priorityscaleid})
            where
                o.id={$objectiveid}
SQL;
        $item = get_record_sql($sql);

        if(!$item) {
            return get_string('error:objectivenotfound','local_plan');
        }

        $out = '';

        // get the priority values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        $out .= "<table><tr><td>";
        $icon = $this->determine_item_icon($item);
        $icon = "<img class=\"objective_state_icon\" src=\"{$CFG->wwwroot}/local/icon/icon.php?icon={$icon}&amp;size=small&amp;type=msg\" alt=\"{$item->fullname}\">";
        $out .= '<h3>' . $icon . $item->fullname . '</h3>';
        $out .= "</td></tr></table>";

        $plancompleted = $this->plan->status == DP_PLAN_STATUS_COMPLETE;

        if ( !$plancompleted && ($canupdate = $this->can_update_items()) ){

            if ( $this->will_an_update_revoke_approval( $objectiveid ) ){
                $buttonlabel = get_string('editdetailswithapproval', 'local_plan');
            } else {
                $buttonlabel = get_string('editdetails', 'local_plan');
            }
            $out .= '<div class="add-linked-course">' . print_single_button(
                "{$CFG->wwwroot}/local/plan/components/objective/edit.php",
                array('id'=>$this->plan->id, 'itemid'=>$objectiveid),
                $buttonlabel,
                null,
                null,
                true
            ) . '</div>';
        }

        $out .= "<table border=\"0\" class=\"planiteminfobox\">\n";
        $out .= "<tr>\n";
        if($priorityenabled && !empty($item->priority)) {
            $out .= '<td>';
            $out .= get_string('priority', 'local_plan') . ': ';
            $out .= $this->display_priority_as_text($item->priority,
                $item->priorityname, $priorityvalues);
            $out .= '</td>';
        }
        if($duedateenabled && !empty($item->duedate)) {
            $out .= '<td>';
            $out .= get_string('duedate', 'local_plan') . ': ';
            $out .= $this->display_duedate_as_text($item->duedate);
            if ( !$item->achieved ){
                $out .= '<br />';
                $out .= $this->display_duedate_highlight_info($item->duedate);
            }
            $out .= '</td>';
        }
        if (!empty($item->profname)) {
            $out .= "  <td>" . get_string('status', 'local_plan') .": \n";
            $out .= "  {$item->profname}</td>\n";
        }

        if ($requiresapproval){
            $out .= "  <td>" . get_string('status') .": \n";
            $out .= $this->display_approval($item, false, false)."</td>\n";
        }
        $out .= '</table>';
        $out .= "  <p>{$item->description}</p>\n";

        print $out;
    }


    /**
     * Display a proficiency (or the dropdown menu for it)
     * @param object $ca The current objective
     * @return string
     */
    function display_proficiency($ca) {
        global $CFG;

        // Get the proficiency values for this plan
        static $proficiencyvalues;
        if (!isset($proficiencyvalues)) {
            $proficiencyvalues = get_records('dp_objective_scale_value', 'objscaleid', $this->get_setting('objectivescale'), 'sortorder','id,name,achieved');
        }

        $plancompleted = ($this->plan->status == DP_PLAN_STATUS_COMPLETE);
        $cansetprof = $this->get_setting('setproficiency') == DP_PERMISSION_ALLOW;

        $selected = $ca->scalevalueid;

        if (!$plancompleted && $cansetprof) {
            // Show the menu
            $options = array();
            foreach ($proficiencyvalues as $id => $val) {
                $options[$id] = $val->name;
            }

            return choose_from_menu(
                $options,
                "proficiencies[{$ca->id}]",
                $selected,
                null,
                '',
                null,
                true
            );

        } else {
            // They can't change the setting, so show it as-is
            $out = format_string($proficiencyvalues[$selected]->name);
            if ($proficiencyvalues[$selected]->achieved) {
                $out = '<b>'.$out.'</b>';
            }
            return $out;
        }
    }

    function can_update_settings_extra($can) {
        $can['setproficiency'] = $this->get_setting('setproficiency') >= DP_PERMISSION_ALLOW;
        return $can;
    }


    /*
     * Return data about objective progress within this plan
     *
     * @return mixed Object containing stats, or false if no progress stats available
     *
     * Object should contain the following properties:
     *    $progress->complete => Integer count of number of items completed
     *    $progress->total => Integer count of total number of items in this plan
     *    $progress->text => String description of completion (for use in tooltip)
     */
    public function progress_stats() {

        // array of all objective scale value ids that are 'achieved'
        $achieved_scale_values = get_records('dp_objective_scale_value', 'achieved', '1', '', 'id');
        $achieved_ids = ($achieved_scale_values) ? array_keys($achieved_scale_values) : array();

        $completedcount = 0;
        // Get courses assigned to this plan
        if ($objectives = $this->get_assigned_items()) {
            foreach ($objectives as $o) {
                if ($o->approved != DP_APPROVAL_APPROVED) {
                    continue;
                }

                // Determine proficiency
                $scalevalueid = $o->scalevalueid;
                if (empty($scalevalueid)) {
                    continue;
                }

                if (in_array($scalevalueid, $achieved_ids)) {
                    $completedcount++;
                }
            }
        }
        $progress_str = "{$completedcount}/" . count($objectives) . " " .
            get_string('objectivesmet', 'local_plan') . "\n";

        $progress = new object();
        $progress->complete = $completedcount;
        $progress->total = count($objectives);
        $progress->text = $progress_str;

        return $progress;
    }


    /**
     * Reactivates objective when re-activating a plan (stub to satisfy abstract method)
     *
     * @return bool $success
     */
    public function reactivate_items() {
        return true;
    }


    /**
     * Gets all plans containing specified objective
     *
     * @param int $objectiveid
     * @param int $userid
     * @return array|false $plans ids of plans with specified objective
     */
    public static function get_plans_containing_item($objectiveid, $userid) {
        global $CFG;
        $sql = "SELECT DISTINCT
                planid
            FROM
                {$CFG->prefix}dp_plan_objective obj
            JOIN
                {$CFG->prefix}dp_plan p
              ON
                obj.planid = p.id
            WHERE
                p.userid = {$userid}";

        if (!$plans = get_records_sql($sql)) {
            // There are no plans with this objective
            return false;
        }

        return array_keys($plans);
    }
}

