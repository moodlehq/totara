<?php

class dp_course_component extends dp_base_component {

    public static $permissions = array(
        'updatecourse' => true,
        //'commenton' => false,
        'setpriority' => false,
        'setduedate' => false,
        'setcompletionstatus' => false,
    );


    /**
     * Initialize settings for the component
     *
     * @access  public
     * @param   array   $settings
     * @return  void
     */
    public function initialize_settings(&$settings) {
        if ($coursesettings = get_record('dp_course_settings', 'templateid', $this->plan->templateid)) {
            $settings[$this->component.'_duedatemode'] = $coursesettings->duedatemode;
            $settings[$this->component.'_prioritymode'] = $coursesettings->prioritymode;
            $settings[$this->component.'_priorityscale'] = $coursesettings->priorityscale;
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
                a.courseid,
                a.id AS itemid,
                c.fullname,
                a.approved
            FROM
                {$CFG->prefix}dp_plan_course_assign a
            INNER JOIN
                {$CFG->prefix}course c
             ON c.id = a.courseid
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

        if($this->plan->is_complete()) {
            // Use the 'snapshot' status value
            $completion_field = 'a.completionstatus AS coursecompletion,';
            // save same value again with a new alias so the column
            // can be sorted
            $completion_field .= 'a.completionstatus AS progress,';
            $completion_joins = '';
        } else {
            // Use the 'live' status value
            $completion_field = 'cc.status AS coursecompletion,';
            // save same value again with a new alias so the column
            // can be sorted
            $completion_field .= 'a.completionstatus AS progress,';
            $completion_joins = "LEFT JOIN
                {$CFG->prefix}course_completions cc
                ON ( cc.course = a.courseid
                AND cc.userid = {$this->plan->userid} )";
        }

        $assigned = get_records_sql(
            "
            SELECT
                a.*,
                $completion_field
                c.fullname,
                c.fullname AS name,
                c.icon
            FROM
                {$CFG->prefix}dp_plan_course_assign a
                $completion_joins
            INNER JOIN
                {$CFG->prefix}course c
             ON c.id = a.courseid
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

        $delete = optional_param('d', 0, PARAM_INT); // course assignment id to delete
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
                totara_set_notification(get_string('canremoveitem','local_plan'), $currenturl, array('style' => 'notifysuccess'));

            } else {
                print_error('error:couldnotunassignitem', 'local_plan');
            }
        }
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
                $CFG->wwwroot.'/local/plan/components/course/find.js.php?planid='.$this->plan->id.'&amp;viewas='.$this->plan->viewas
            ));
        }
    }


    /**
     * Code to run after page header is display
     *
     * @access  public
     * @return  void
     */
    public function post_header_hook() {

        $delete = optional_param('d', 0, PARAM_INT); // course assignment id to delete
        $currenturl = $this->get_url();

        if ($delete) {
            notice_yesno(get_string('confirmitemdelete','local_plan'), $currenturl.'&amp;d='.$delete.'&amp;confirm=1&amp;sesskey='.sesskey(), $currenturl);
            print_footer();
            die();
        }
    }


    /**
     * Assign a new item to this plan
     *
     * @access  public
     * @param   $itemid     integer
     * @return  added item's name
     */
    public function assign_new_item($itemid) {

        // Get approval value for new item
        if (!$permission = $this->can_update_items()) {
            print_error('error:cannotupdatecourses', 'local_plan');
        }

        $item = new object();
        $item->planid = $this->plan->id;
        $item->courseid = $itemid;
        $item->priority = null;
        $item->duedate = null;
        $item->completionstatus = null;
        $item->grade = null;

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

        return insert_record('dp_plan_course_assign', $item) ? get_field('course', 'fullname',  'id', $itemid) : false;
    }


    /**
     * Displays a list of linked courses
     *
     * @param  array  $list  the list of linked courses
     * @return false|string  $out  the table to display
     */
    function display_linked_courses($list) {
        global $CFG;

        if(!is_array($list)|| count($list) == 0) {
            return false;
        }

        $showduedates = ($this->get_setting('duedatemode') == DP_DUEDATES_OPTIONAL ||
            $this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED);
        $showpriorities =
            ($this->get_setting('prioritymode') == DP_PRIORITY_OPTIONAL ||
            $this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;

        $select = 'SELECT ca.*, c.fullname, c.icon, psv.name AS priorityname ';

        // get courses assigned to this plan
        // and related details
        $from = "FROM {$CFG->prefix}dp_plan_course_assign ca
                LEFT JOIN
                    {$CFG->prefix}course c ON c.id = ca.courseid
                LEFT JOIN
                    {$CFG->prefix}dp_priority_scale_value psv
                    ON (ca.priority = psv.id
                    AND psv.priorityscaleid = $priorityscaleid) ";
        $where = "WHERE ca.id IN (" . implode(',', $list) . ")
            AND ca.approved = ".DP_APPROVAL_APPROVED;

        $sort = "ORDER BY c.fullname";

        $tableheaders = array(
            get_string('coursename','local_plan'),
        );
        $tablecolumns = array(
            'fullname',
        );

        if($showpriorities) {
            $tableheaders[] = get_string('priority', 'local_plan');
            $tablecolumns[] = 'priority';
        }

        if($showduedates) {
            $tableheaders[] = get_string('duedate', 'local_plan');
            $tablecolumns[] = 'duedate';
        }

        $tableheaders[] = get_string('progress','local_plan');
        $tablecolumns[] = 'progress';

        $table = new flexible_table('linkedcourselist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->setup();

        if ($records = get_recordset_sql($select.$from.$where.$sort)) {
            // get the scale values used for competencies in this plan
            $priorityvalues = get_records('dp_priority_scale_value',
                'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

            while($ca = rs_fetch_next_record($records)) {
                $row = array();
                $row[] = $this->display_item_name($ca);

                if($showpriorities) {
                    $row[] = $this->display_priority_as_text($ca->priority, $ca->priorityname, $priorityvalues);
                }

                if($showduedates) {
                    $row[] = $this->display_duedate_as_text($ca->duedate);
                }

                $row[] = $this->display_status_as_progress_bar($ca);

                $table->add_data($row);
            }

            rs_close($records);

            // return instead of outputing table contents
            ob_start();
            $table->print_html();
            $out = ob_get_contents();
            ob_end_clean();

            return $out;
        }

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

        if($approved) {
            $class = '';
            $launch = '<a href="' . $CFG->wwwroot .
                '/course/view.php?id=' . $item->courseid . '">' .
                '<div class="plan-launch-course-button"><img src="' . $CFG->pixpath . '/launch-course.png" width="56" height="18" alt="' . get_string('launchcourse', 'local_plan') . '" /></a></div>';
        } else {
            $class = ' class="dimmed"';
            $launch = '';
        }
        return '<img class="course_icon" src="' .
            $CFG->wwwroot . '/local/icon.php?icon=' . $item->icon .
            '&amp;id=' . $item->courseid .
            '&amp;size=small&amp;type=course" alt="' . format_string($item->fullname).
            '"><a' . $class .' href="' . $CFG->wwwroot .
            '/local/plan/components/' . $this->component.'/view.php?id=' .
            $this->plan->id . '&amp;itemid=' . $item->id . '">' . $item->fullname .
            '</a>'. $launch;
    }


    /**
     * Display details for a single course
     *
     * @param integer $caid ID of the course assignment (not the course id)
     * @return string HTML string to display the course information
     */
    function display_course_detail($caid) {
        global $CFG;

        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;
        $priorityenabled = $this->get_setting('prioritymode') != DP_PRIORITY_NONE;
        $duedateenabled = $this->get_setting('duedatemode') != DP_DUEDATES_NONE;

        $sql = 'SELECT ca.*, course.*, psv.name AS priorityname ' .
            "FROM {$CFG->prefix}dp_plan_course_assign ca
                LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                    ON (ca.priority = psv.id
                    AND psv.priorityscaleid = {$priorityscaleid})
                LEFT JOIN {$CFG->prefix}course course ON course.id = ca.courseid
            WHERE ca.id = $caid";
        $item = get_record_sql($sql);

        if(!$item) {
            return get_string('coursenotfound', 'local_plan');
        }

        $out = '';

        // get the priority values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        $icon = "<img class=\"course_icon\" src=\"{$CFG->wwwroot}/local/icon.php?icon={$item->icon}&amp;id={$item->courseid}&amp;size=small&amp;type=course\" alt=\"{$item->fullname}\">";
        $out .= '<h3>' . $icon . $item->fullname . '</h3>';
        $out .= '<table border="0" class="planiteminfobox">';
        $out .= "<tr>";
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
            $out .= '<br />';
            $out .= $this->display_duedate_highlight_info($item->duedate);
            $out .= '</td>';
        }
        if ($progressbar = $this->display_status_as_progress_bar($item)) {
            unset($completionstatus);
            $out .= '<td><table border="0"><tr><td style="border:0px;">';
            $out .= get_string('progress', 'local_plan').': </td><td style="border:0px;">'.$progressbar;
            $out .= '</td></tr></table></td>';
        }
        $out .= "</tr>";
        $out .= '</table>';
        $out .= '<p>' . $item->summary . '</p>';
        $out .= '<p><a href="' . $CFG->wwwroot . '/course/view.php?id=' . $item->courseid . '">' . get_string('launchcourse', 'local_plan') . '</a></p>';

        return $out;
    }


    /**
     * Displays an items status as a progress bar
     *
     * @param object $ca the item to check
     * @return string $out display markup
     */
    function display_status_as_progress_bar($ca) {
        // get the completion string, if there is a record
        $completionstatus = $this->get_item_completion_status($ca);

        $plancompleted = $this->plan->is_complete();
        $canupdatecoursestatus = $this->get_setting('setcompletionstatus') == DP_PERMISSION_ALLOW;
        $out = '';

        // don't print a status bar if there is no completion record
        if($completionstatus !== false) {
            $completionstring = $completionstatus == '' ?
                get_string('notyetstarted','completion') :
                get_string($completionstatus, 'completion');
            $out .= "<span class=\"coursecompletionstatus\">
                <span class=\"completion-{$completionstatus}\" title=\"{$completionstring}\"></span>
                </span>";
        }

        return $out;
    }


    /**
     * Check if an item is complete
     *
     * @access  protected
     * @param   object  $item
     * @return  boolean
     */
    protected function is_item_complete($item) {
        global $CFG;
        require_once($CFG->dirroot . '/lib/completion/completion_completion.php');
        return in_array($item->coursecompletion, array(COMPLETION_STATUS_COMPLETE, COMPLETION_STATUS_COMPLETEVIARPL));
    }


    /**
     * Get an items completion status
     *
     * @access  public
     * @param   object  $item
     * @return  string|false
     */
    public function get_item_completion_status($item) {
        global $CFG, $COMPLETION_STATUS;
        // needed to access completion status codes
        require_once($CFG->dirroot . '/lib/completion/completion_completion.php');

        // get the completion string, if there is a record
        if (array_key_exists($item->coursecompletion,
            $COMPLETION_STATUS)) {
            return $COMPLETION_STATUS[$item->coursecompletion];
        } else {
            // No completion record
            return false;
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
        $canapprovecourses = ($this->get_setting('updatecourse') == DP_PERMISSION_APPROVE);
        $duedates = optional_param('duedate_course', array(), PARAM_TEXT);
        $priorities = optional_param('priorities_course', array(), PARAM_TEXT);
        $approvals = optional_param('approve_course', array(), PARAM_INT);
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
        if (!empty($approvals) && $canapprovecourses) {
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
            $oldrecords = get_records_list('dp_plan_course_assign', 'id', implode(',', array_keys($stored_records)));

            $updates = '';
            $approvals = array();
            begin_sql();
            foreach($stored_records as $itemid => $record) {
                // Update the record
                $status = $status & update_record('dp_plan_course_assign', $record);
            }

            if ($status) {
                commit_sql();

                // Process update alerts
                foreach($stored_records as $itemid => $record) {
                    // Record the updates for later use
                    $course = get_record('course', 'id', $oldrecords[$itemid]->courseid);
                    $courseheader = '<p><strong>'.format_string($course->fullname).": </strong><br>";
                    $courseprinted = false;
                    if (!empty($record->priority) && $oldrecords[$itemid]->priority != $record->priority) {
                        $oldpriority = get_field('dp_priority_scale_value', 'name', 'id', $oldrecords[$itemid]->priority);
                        $newpriority = get_field('dp_priority_scale_value', 'name', 'id', $record->priority);
                        $updates .= $courseheader;
                        $courseprinted = true;
                        $updates .= get_string('priority', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                                (object)array('before'=>$oldpriority, 'after'=>$newpriority))."<br>";
                    }
                    if (!empty($record->duedate) && $oldrecords[$itemid]->duedate != $record->duedate) {
                        $updates .= $courseprinted ? '' : $courseheader;
                        $courseprinted = true;
                        $updates .= get_string('duedate', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>empty($oldrecords[$itemid]->duedate) ? '' :
                                userdate($oldrecords[$itemid]->duedate, '%e %h %Y', $CFG->timezone, false),
                            'after'=>userdate($record->duedate, '%e %h %Y', $CFG->timezone, false)))."<br>";
                    }
                    if (!empty($record->approved) && $oldrecords[$itemid]->approved != $record->approved) {
                        $approval = new object();
                        $text = $courseheader;
                        $text .= get_string('approval', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>dp_get_approval_status_from_code($oldrecords[$itemid]->approved),
                            'after'=>dp_get_approval_status_from_code($record->approved)))."<br>";
                        $approval->text = $text;
                        $approval->itemname = $course->fullname;
                        $approval->before = $oldrecords[$itemid]->approved;
                        $approval->after = $record->approved;
                        $approvals[] = $approval;

                    }
                    $updates .= $courseprinted ? '</p>' : '';
                }  // foreach

                if ($this->plan->status != DP_PLAN_STATUS_UNAPPROVED && count($approvals)>0) {
                    foreach($approvals as $approval) {
                        $this->send_component_approval_alert($approval);
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
                    totara_set_notification(get_string('coursesupdated','local_plan').$issuesnotification, $currenturl, array('style'=>'notifysuccess'));
                } else {
                    totara_set_notification(get_string('coursesnotupdated','local_plan'), $currenturl);
                }
            }
        }

        if ($this->plan->reviewing_pending) {
            return null;
        }

        redirect($currenturl);
    }


    /**
     * Unassign an item from a plan
     *
     * @access  public
     * @return  boolean
     */
    public function unassign_item($item) {
        // Run parent method
        $result = parent::unassign_item($item);

        // Delete mappings
        if ($result) {
            $result = delete_records('dp_plan_component_relation', 'component1', 'course', 'itemid1', $item->id);
            $result = $result && delete_records('dp_plan_component_relation', 'component2', 'course', 'itemid2', $item->id);
        }

        return $result;
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
     * Display progress for an item in a list
     *
     * @access protected
     * @param object $item the item to check
     * @return string the item status
     */
    protected function display_list_item_progress($item) {
        return $this->is_item_approved($item->approved) ? $this->display_status_as_progress_bar($item) : '';
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

        // Get permissions
        $cansetcompletion = !$this->plan->is_complete() && $this->get_setting('setcompletionstatus') >= DP_PERMISSION_ALLOW;
        $approved = $this->is_item_approved($item->approved);

        // Actions
        if ($this->can_delete_item($item)) {
            $currenturl = $this->get_url();
            $strdelete = get_string('delete', 'local_plan');
            $delete = '<a href="'.$currenturl.'&amp;d='.$item->id.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';
            $markup .= $delete;
        }

        if ($cansetcompletion && $approved) {
            $strrpl = get_string('addrpl', 'local_plan');
            $proficient = '<a href="'.$CFG->wwwroot.'/local/plan/components/course/rpl.php?id='.$this->plan->id.'&courseid='.$item->courseid.'" title="'.$strrpl.'">
                <img src="'.$CFG->pixpath.'/t/ranges.gif" class="iconsmall" alt="'.$strrpl.'" /></a>';
            $markup .= $proficient;
        }

        return $markup;
    }

}
