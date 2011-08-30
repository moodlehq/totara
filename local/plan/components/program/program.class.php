<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage plan
 */

require_once($CFG->dirroot.'/local/program/lib.php');

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

class dp_program_component extends dp_base_component {

    public static $permissions = array(
        'updateprogram' => true,
        'setpriority' => false,
        'setduedate' => false,
    );

    /**
     * Initialize settings for the component
     *
     * @access  public
     * @param   array   $settings
     * @return  void
     */
    public function initialize_settings(&$settings) {
        if ($programsettings = get_record('dp_program_settings', 'templateid', $this->plan->templateid)) {
            $settings[$this->component.'_duedatemode'] = $programsettings->duedatemode;
            $settings[$this->component.'_prioritymode'] = $programsettings->prioritymode;
            $settings[$this->component.'_priorityscale'] = $programsettings->priorityscale;
        }
    }

    /**
     * Get a single assigned item
     *
     * @access  public
     * @return  object|false
     */
    public function get_assigned_item($itemid) {
        global $CFG;

        $assigned = get_record_sql(
            "
            SELECT
                a.id,
                a.planid,
                a.programid,
                a.id AS itemid,
                p.fullname,
                a.approved
            FROM
                {$CFG->prefix}dp_plan_program_assign a
            INNER JOIN
                {$CFG->prefix}prog p
             ON p.id = a.programid
            WHERE
                a.planid = {$this->plan->id}
            AND a.id = {$itemid}
            "
        );

        return $assigned;
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
        $where = "p.visible = 1 AND a.planid = {$this->plan->id}";
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

        $completion_field = 'pc.status AS programcompletion,';
        // save same value again with a new alias so the column
        // can be sorted
        $completion_field .= 'pc.status AS progress,';
        $completion_joins = "LEFT JOIN
            {$CFG->prefix}prog_completion pc
            ON ( pc.programid = a.programid
            AND pc.userid = {$this->plan->userid}
            AND pc.coursesetid = 0)";

        $assigned = get_records_sql(
            "
            SELECT
                a.*,
                $completion_field
                p.fullname,
                p.fullname AS name,
                p.icon
            FROM
                {$CFG->prefix}dp_plan_program_assign a
                $completion_joins
            INNER JOIN
                {$CFG->prefix}prog p
             ON p.id = a.programid
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

        $delete = optional_param('d', 0, PARAM_INT); // program assignment id to delete
        $confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

        $currenturl = $this->get_url();

        if ($delete && $confirm) {
            if (!confirm_sesskey()) {
                totara_set_notification(get_string('confirmsesskeybad', 'error'), $currenturl);
            }

            // Load item
            if (!$deleteitem = $this->get_assigned_item($delete)) {
                print_error('error:couldnotfindassigneditem', 'local_plan');
            }

            // Unassign item
            if ($this->unassign_item($deleteitem)) {
                add_to_log(SITEID, 'plan', 'removed program', "component.php?id={$this->plan->id}&amp;c=program", "{$deleteitem->fullname} (ID:{$deleteitem->id})");
                totara_set_notification(get_string('canremoveitem','local_plan'), $currenturl, array('style' => 'notifysuccess'));
            } else {
                print_error('error:couldnotunassignitem', 'local_plan');
            }
        }
    }

    /**
     * Process component's settings update
     *
     * @access  public
     * @return  void
     */
    public function process_settings_update() {
        // @todo validation notices, including preventing empty due dates
        // if duedatemode is required
        // @todo consider handling differently - currently all updates must
        // work or nothing is changed - is that the best way?
        global $CFG;

        if (!confirm_sesskey()) {
            return 0;
        }
        $cansetduedates = ($this->get_setting('setduedate') == DP_PERMISSION_ALLOW);
        $cansetpriorities = ($this->get_setting('setpriority') == DP_PERMISSION_ALLOW);
        $canapproveprograms = ($this->get_setting('updateprogram') == DP_PERMISSION_APPROVE);
        $duedates = optional_param('duedate_program', array(), PARAM_TEXT);
        $priorities = optional_param('priorities_program', array(), PARAM_TEXT);
        $approvals = optional_param('approve_program', array(), PARAM_INT);
        $currenturl = qualified_me();
        $stored_records = array();

        if(!empty($duedates) && $cansetduedates) {
            $badduedates = array();  // Record naughty duedates
            foreach($duedates as $id => $duedate) {
                // allow empty due dates
                if($duedate == '' || $duedate == 'dd/mm/yy') {
                    // set all empty due dates to the plan due date
                    // if they are required
                    if ($this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED) {
                        $duedateout = $this->plan->enddate;
                        $badduedates[] = $id;
                    } else {
                        $duedateout = null;
                    }
                } else {
                    $datepattern = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{2})$/';
                    if (preg_match($datepattern, $duedate, $matches) == 0) {
                        // skip badly formatted date strings
                        $badduedates[] = $id;
                        continue;
                    }
                    $day = $matches[1];
                    $mon = $matches[2];
                    $year = $matches[3];

                    $duedateout = mktime(0, 0, 0, $mon, $day, $year);
                }

                $todb = new object();
                $todb->id = $id;
                $todb->duedate = $duedateout;
                $stored_records[$id] = $todb;
            }
        }

        if(!empty($priorities)) {
            foreach($priorities as $pid => $priority) {
                $priority = (int) $priority;
                if(array_key_exists($pid, $stored_records)) {
                    // add to the existing update object
                    $stored_records[$pid]->priority = $priority;
                } else {
                    // create a new update object
                    $todb = new object();
                    $todb->id = $pid;
                    $todb->priority = $priority;
                    $stored_records[$pid] = $todb;
                }
            }
        }

        if (!empty($approvals) && $canapproveprograms) {
            // Update approvals
            foreach ($approvals as $id => $approval) {
                if (!$approval) {
                    continue;
                }
                $approval = (int) $approval;
                if(array_key_exists($id, $stored_records)) {
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
        if (!empty($stored_records)) {
            $oldrecords = get_records_list('dp_plan_program_assign', 'id', implode(',', array_keys($stored_records)));

            $updates = '';
            $approvals = array();
            begin_sql();
            foreach($stored_records as $itemid => $record) {
                // Update the record
                $status = $status & update_record('dp_plan_program_assign', $record);

                // update the due date for the program completion record
                if (isset($record->duedate)) {
                    if ($prog_plan = get_record('dp_plan_program_assign', 'id', $record->id)) {
                        $program = new program($prog_plan->programid);
                        $completionsettings = array(
                            'timedue' => $record->duedate
                        );

                        $status = $status & $program->update_program_complete($this->plan->userid, $completionsettings);
                    }
                }
            }

            if ($status) {
                commit_sql();

                // Process update alerts
                foreach($stored_records as $itemid => $record) {
                    // Record the updates for later use
                    $program = get_record('prog', 'id', $oldrecords[$itemid]->programid);
                    $programheader = '<p><strong>'.format_string($program->fullname).": </strong><br>";
                    $programprinted = false;
                    if (!empty($record->priority) && $oldrecords[$itemid]->priority != $record->priority) {
                        $oldpriority = get_field('dp_priority_scale_value', 'name', 'id', $oldrecords[$itemid]->priority);
                        $newpriority = get_field('dp_priority_scale_value', 'name', 'id', $record->priority);
                        $updates .= $programheader;
                        $programprinted = true;
                        $updates .= get_string('priority', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                                (object)array('before'=>$oldpriority, 'after'=>$newpriority))."<br>";
                    }
                    if (!empty($record->duedate) && $oldrecords[$itemid]->duedate != $record->duedate) {
                        $updates .= $programprinted ? '' : $programheader;
                        $programprinted = true;
                        $updates .= get_string('duedate', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>empty($oldrecords[$itemid]->duedate) ? '' :
                                userdate($oldrecords[$itemid]->duedate, '%e %h %Y', $CFG->timezone, false),
                            'after'=>userdate($record->duedate, '%e %h %Y', $CFG->timezone, false)))."<br>";
                    }
                    if (!empty($record->approved) && $oldrecords[$itemid]->approved != $record->approved) {
                        $approval = new object();
                        $text = $programheader;
                        $text .= get_string('approval', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>dp_get_approval_status_from_code($oldrecords[$itemid]->approved),
                            'after'=>dp_get_approval_status_from_code($record->approved)))."<br>";
                        $approval->text = $text;
                        $approval->itemname = $program->fullname;
                        $approval->before = $oldrecords[$itemid]->approved;
                        $approval->after = $record->approved;
                        $approvals[] = $approval;

                    }
                    $updates .= $programprinted ? '</p>' : '';
                }  // foreach

                if ($this->plan->status != DP_PLAN_STATUS_UNAPPROVED && count($approvals)>0) {
                    foreach($approvals as $approval) {
                        $this->send_component_approval_alert($approval);

                        $action = ($approval->after == DP_APPROVAL_APPROVED) ? 'approved' : 'declined';
                        add_to_log(SITEID, 'plan', "{$action} program", "component.php?id={$this->plan->id}&amp;c=program", $approval->itemname);
                    }
                }

                // Send update alert
                if ($this->plan->status != DP_PLAN_STATUS_UNAPPROVED && strlen($updates)) {
                    $this->send_component_update_alert($updates);
                }

            } else {
                rollback_sql();
            }

            $currenturl = new moodle_url($currenturl);
            $currenturl->remove_params('badduedates');
            if (!empty($badduedates)) {
                $currenturl->params(array('badduedates'=>implode(',', $badduedates)));
            }
            $currenturl = $currenturl->out();

            if ($this->plan->reviewing_pending) {
                return $status;
            }
            else {
                if ($status) {
                    $issuesnotification = '';
                    if (!empty($badduedates)) {
                        $issuesnotification .= $this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED ?
                            '<br>'.get_string('noteduedateswrongformatorrequired', 'local_plan') : '<br>'.get_string('noteduedateswrongformat', 'local_plan');
                    }
                    totara_set_notification(get_string('programsupdated','local_plan').$issuesnotification, $currenturl, array('style'=>'notifysuccess'));
                } else {
                    totara_set_notification(get_string('programsnotupdated','local_plan'), $currenturl);
                }
            }
        }

        if ($this->plan->reviewing_pending) {
            return null;
        }

        redirect($currenturl);
    }

    /**
     * Returns true if any programs use the scale given
     *
     * @param integer $scaleid
     * return boolean
     */
    public static function is_priority_scale_used($scaleid) {
        global $CFG;
        $sql = "
            SELECT pa.id
            FROM {$CFG->prefix}dp_plan_program_assign pa
            LEFT JOIN
                {$CFG->prefix}dp_priority_scale_value psv
            ON pa.priority = psv.id
            WHERE psv.priorityscaleid = {$scaleid}";
        return record_exists_sql($sql);
    }

    /**
     * Code to run before after header is displayed
     *
     * @access  public
     * @return  void
     */
    public function post_header_hook() {
        $delete = optional_param('d', 0, PARAM_INT); // program assignment id to delete
        $currenturl = $this->get_url();

        if ($delete) {
            notice_yesno(get_string('confirmitemdelete','local_plan'), $currenturl.'&amp;d='.$delete.'&amp;confirm=1&amp;sesskey='.sesskey(), $currenturl);
            print_footer();
            die();
        }
    }

    /**
     * Assign a new program item to this plan
     *
     * @access  public
     * @param   $itemid     integer
     * @return  added item's name
     */
    public function assign_new_item($itemid) {

        // Get approval value for new item
        if (!$permission = $this->can_update_items()) {
            print_error('error:cannotupdateprograms', 'local_plan');
        }

        $item = new object();
        $item->planid = $this->plan->id;
        $item->programid = $itemid;
        $item->priority = null;
        $item->duedate = null;
        $programname = get_field('prog', 'fullname',  'id', $itemid);
        // Check required values for priority/due data
        if ($this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED) {
            $item->priority = $this->get_default_priority();
        }

        if ($this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED) {
            $item->duedate = $this->plan->enddate;
        }

        // Set approved status
        if ( $permission >= DP_PERMISSION_ALLOW ) {
            $item->approved = DP_APPROVAL_APPROVED;
        }
        else { # $permission == DP_PERMISSION_REQUEST
            $item->approved = DP_APPROVAL_UNAPPROVED;
        }

        add_to_log(SITEID, 'plan', 'added program', "component.php?id={$this->plan->id}&amp;c=program", $programname);

        $insert_result = insert_record('dp_plan_program_assign', $item) ? $programname : false;

        // create a completion record for this program for this plan's user to
        // record when the program was started and when it is due
        if ($insert_result !== false) {
            $program = new program($item->programid);
            $completionsettings = array(
                'status'        => STATUS_PROGRAM_INCOMPLETE,
                'timestarted'   => time(),
                'timedue'       => $item->duedate !== null ? $item->duedate : 0
            );

            $program->update_program_complete($this->plan->userid, $completionsettings);

        }
        return $insert_result;
    }

    /**
     * First calls the parent method to unassign the program from the learning
     * plan then, if successful, deletes the completion
     *
     * @access  public
     * @return  boolean
     */
    public function unassign_item($item) {
        $userid = $this->plan->userid;

        // first unassign the program from the plan
        if ($result = parent::unassign_item($item)) {

            // create a new program instance
            $program = new program($item->programid);

            // check that the program is not also part of the user's required learning
            if ($program->assigned_to_users_required_learning($userid)) {
                return $result;
            }

            // check that the program is not assigned to any other learning plans
            if ($program->assigned_to_users_non_required_learning($userid)) {
                return $result;
            }

            // check that the program is not complete (don't delete the history record if the program has already been completed)
            if ( ! $program->is_program_complete($userid)) {
                $result = $program->delete_completion_record($userid);
            }
            return $result;
        }
        return $result;
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

            // Get course picker
            require_js(array(
                $CFG->wwwroot.'/local/plan/component.js.php?planid='.$this->plan->id.'&amp;component=program&amp;viewas='.$this->plan->viewas,
                $CFG->wwwroot.'/local/plan/components/program/find.js.php'
            ));
        }
    }

    /**
     * Check if item is "complete" or "finished"
     *
     * @access  public
     * @param   object  $item
     * @return  boolean
     */
    protected function is_item_complete($item) {
        return in_array($item->programcompletion, array(STATUS_PROGRAM_COMPLETE));
    }

    /*********************************************************************************************
     *
     * Display methods
     *
     ********************************************************************************************/

    /**
     * Display progress for an item in a list
     *
     * @access protected
     * @param object $item the item to check
     * @return string the item status
     */
    protected function display_list_item_progress($item) {
        $program = new program($item->programid);
        return $this->is_item_approved($item->approved) ? $program->display_progress($this->plan->userid) : get_string('unapproved', 'local_plan');
    }

    /**
     * Get headers for a list
     *
     * @return array $headers
     */
    function get_list_headers() {
        $headers = parent::get_list_headers();

        foreach ($headers->headers as $i=>$h) {
            if ($h == get_string('status', 'local_plan')) {
                // Replace 'Status' header with 'Progress'
                $headers->headers[$i] = get_string('progress', 'local_plan');
                break;
            }
        }
        return $headers;
    }


    /**
     * Display an items available actions
     *
     * @access protected
     * @param object $item the item being checked
     * @return string $markup the display markup
     */
    protected function display_list_item_actions($item) {
        global $CFG;

        $markup = '';

        // Actions
        if ($this->can_delete_item($item)) {
            $currenturl = $this->get_url();
            $strdelete = get_string('delete', 'local_plan');
            $delete = '<a href="'.$currenturl.'&amp;d='.$item->id.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';
            $markup .= $delete;
        }
        return $markup;
    }

    /**
     * Display item's name
     *
     * @access  public
     * @param   object  $item
     * @return  string
     */
    public function display_item_name($item) {
        global $CFG;
        $approved = $this->is_item_approved($item->approved);
        $viewingasmanager = $this->plan->role == 'manager';

        $extraparams = '';
        if ($viewingasmanager) {
            $extraparams = '&amp;userid='.$this->plan->userid;
        }

        if($approved) {
            return '<img class="program_icon" src="' .
                $CFG->wwwroot . '/local/icon/icon.php?icon=' . $item->icon .
                '&amp;id=' . $item->programid .
                '&amp;size=small&amp;type=program" alt="' . format_string($item->fullname).
                '" /><a href="' . $CFG->wwwroot .
                '/local/plan/components/' . $this->component.'/view.php?id=' .
                $this->plan->id . '&amp;itemid=' . $item->id . $extraparams . '">' . $item->fullname .
                '</a>';
        } else {
            return '<img class="program_icon" src="' .
                $CFG->wwwroot . '/local/icon/icon.php?icon=' . $item->icon .
                '&amp;id=' . $item->programid .
                '&amp;size=small&amp;type=program" alt="' . format_string($item->fullname).
                '" />' . $item->fullname;
        }
    }

    /**
     * Display details for a single program
     *
     * @param integer $progassid ID of the program assignment (not the program id)
     * @return string HTML string to display the course information
     */
    function display_program_detail($progassid) {
        global $CFG;

        $sql = "SELECT pa.*, prog.*, pc.status AS programcompletion
                FROM {$CFG->prefix}dp_plan_program_assign pa
                LEFT JOIN {$CFG->prefix}prog prog ON prog.id = pa.programid
                LEFT JOIN {$CFG->prefix}prog_completion pc ON ( prog.id = pc.programid AND pc.userid = {$this->plan->userid} AND pc.coursesetid = 0)
                WHERE pa.id = $progassid";
        $item = get_record_sql($sql);

        if(!$item) {
            return get_string('programnotfound', 'local_plan');
        }

        $out = '';

        $icon = "<img class=\"course_icon\" src=\"{$CFG->wwwroot}/local/icon/icon.php?icon={$item->icon}&amp;id={$item->programid}&amp;size=small&amp;type=program\" alt=\"{$item->fullname}\">";
        $out .= '<h3>' . $icon . $item->fullname . '</h3>';

        $program = new program($item->id);

        $out .= $program->display($this->plan->userid);

        return $out;
    }

    /*
     * Return data about program progress within this plan
     *
     * @return mixed Object containing stats, or false if no progress stats available
     *
     * Object should contain the following properties:
     *    $progress->complete => Integer count of number of items completed
     *    $progress->total => Integer count of total number of items in this plan
     *    $progress->text => String description of completion (for use in tooltip)
     */
    public function progress_stats() {

        $completedcount = 0;
        $completionsum = 0;
        $inprogresscount = 0;
        // Get programs assigned to this plan
        if ($programs = $this->get_assigned_items()) {
            foreach ($programs as $p) {
                if ($p->approved != DP_APPROVAL_APPROVED) {
                    continue;
                }
                // Determine program completion
                $prog = new program($p->programid);
                if (!$prog) {
                    continue;
                }

                if ($prog->is_program_complete($this->plan->userid)) {
                    $completionsum ++;
                    $completedcount++;
                }

                if ($prog->is_program_inprogress($this->plan->userid)) {
                    $inprogresscount ++;
                }
            }
        }

        $progress_str = "{$completedcount}/" . count($programs) . " " .
            get_string('programscomplete', 'local_program') . ", {$inprogresscount} " .
            get_string('inprogress', 'local_plan') . "\n";

        $progress = new object();
        $progress->complete = $completionsum;
        $progress->total = count($programs);
        $progress->text = $progress_str;

        return $progress;
    }


    /**
     * Gets all plans containing specified program
     *
     * @param int $programid
     * @param int $userid
     * @return array|false $plans ids of plans with specified program
     */
    public static function get_plans_containing_item($programid, $userid) {
        global $CFG;
        $sql = "SELECT DISTINCT
                planid
            FROM
                {$CFG->prefix}dp_plan_program_assign pa
            JOIN
                {$CFG->prefix}dp_plan p
              ON
                pa.planid = p.id
            WHERE
                pa.programid = {$programid}
            AND
                p.userid = {$userid}";

        if (!$plans = get_records_sql($sql)) {
            // There are no plans with this program
            return false;
        }

        return array_keys($plans);
    }

    /**
     * Reactivates item when re-activating a plan
     *
     * @return bool $success
     */
    public function reactivate_items() {
        // TODO
        return true;
    }
}
