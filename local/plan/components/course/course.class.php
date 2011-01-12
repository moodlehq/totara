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
                c.id,
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
     * @return  array
     */
    public function get_assigned_items($approved = null) {
        global $CFG;

        // Generate where clause
        $where = "a.planid = {$this->plan->id}";
        if ($approved !== null) {
            if (is_array($approved)) {
                $approved = implode(', ', $approved);
            }
            $where .= " AND a.approved IN ({$approved})";
        }

        $assigned = get_records_sql(
            "
            SELECT
                c.id,
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
                $where
            "
        );

        if (!$assigned) {
            $assigned = array();
        }

        return $assigned;
    }


    /**
     * Get list of items assigned to plan
     *
     * @access  public
     * @return  array
     */
    public function get_assigned_items_count() {
        global $CFG;

        $count = count_records_sql(
            "
            SELECT *
            FROM
                {$CFG->prefix}dp_plan_course_assign a
            INNER JOIN
                {$CFG->prefix}course c
             ON c.id = a.courseid
            WHERE
                a.planid = {$this->plan->id}
            "
        );

        if (!$count) {
            $count = 0;
        }

        return $count;
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
     * Code to run before page header is displayed
     *
     * @access  public
     * @return  void
     */
    public function pre_header_hook() {
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
                $CFG->wwwroot.'/local/plan/components/course/find.js.php'
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
     * Return markup to display course items in a table
     *
     * Optionally restrict results by approval status
     *
     * @access  public
     * @param   mixed   $restrict   Array or integer (optional)
     * @return  string
     */
    public function display_list($restrict = null) {
        global $CFG;

        $showduedates = ($this->get_setting('duedatemode') == DP_DUEDATES_OPTIONAL ||
            $this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED);
        $showpriorities =
            ($this->get_setting('prioritymode') == DP_PRIORITY_OPTIONAL ||
            $this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;

        $plancompleted = $this->plan->status == DP_PLAN_STATUS_COMPLETE;
        $canrequestcourses = !$plancompleted &&
            $this->get_setting('updatecourse') == DP_PERMISSION_REQUEST;
        $canapprovecourses = !$plancompleted &&
            $this->get_setting('updatecourse') == DP_PERMISSION_APPROVE;
        $canremovecourses = !$plancompleted &&
            $this->get_setting('updatecourse') >= DP_PERMISSION_ALLOW;
        $cansetcompletion = !$plancompleted &&
            $this->get_setting('setcompletionstatus') >= DP_PERMISSION_ALLOW;

        // @todo fix sorting of status column to account for course
        // completion - may need status column in course completions table
        // reenable sorting on progress column when working
        $count = 'SELECT COUNT(*) ';
        $select = 'SELECT ca.*, c.fullname, c.icon, psv.name ' . sql_as() . ' priorityname ';

        // get courses assigned to this plan
        // and related details
        $from = "FROM {$CFG->prefix}dp_plan_course_assign ca
                LEFT JOIN
                    {$CFG->prefix}course c ON c.id = ca.courseid
                LEFT JOIN
                    {$CFG->prefix}dp_priority_scale_value psv
                    ON (ca.priority = psv.id
                    AND psv.priorityscaleid = $priorityscaleid) ";
        $where = "WHERE ca.planid = {$this->plan->id}";

        // Check if restricting by approval status
        if (isset($restrict)) {
            if (is_array($restrict)) {
                $restrict = implode(', ', $restrict);
            }
            $where .= " AND ca.approved IN ({$restrict})";
        }

        $count = count_records_sql($count.$from.$where);
        if (!$count) {
            return '<span class="noitems-assigncourses">'.get_string('nocourses', 'local_plan').'</span>';
        }

        $tableheaders = array(
            get_string('coursename','local_plan'),
            get_string('progress','local_plan'),
        );
        $tablecolumns = array(
            'c.fullname',
            'progress',
        );

        if($showpriorities) {
            $tableheaders[] = get_string('priority', 'local_plan');
            $tablecolumns[] = 'ca.priority';
        }

        if($showduedates) {
            $tableheaders[] = get_string('duedate', 'local_plan');
            $tablecolumns[] = 'ca.duedate';
        }

        if(!$plancompleted) {
            $tableheaders[] = get_string('status','local_plan');
            $tablecolumns[] = 'status';
        }

        $tableheaders[] = get_string('actions', 'local_plan');
        $tablecolumns[] = 'actions';

        $table = new flexible_table('courselist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->sortable(true);
        $table->no_sorting('progress');
        $table->no_sorting('status');
        $table->no_sorting('actions');
        $table->setup();
        $table->pagesize(20, $count);
        $sort = $table->get_sql_sort();
        $sort = ($sort=='') ? '' : ' ORDER BY ' . $sort;

        // get all course completions for this plan's user
        $completions = completion_info::get_all_courses($this->plan->userid);

        if ($records = get_recordset_sql($select.$from.$where.$sort,
            $table->get_page_start(),
            $table->get_page_size())) {

            while ($ca = rs_fetch_next_record($records)) {
                $completionstatus = $this->get_completion_status($ca, $completions);
                $completed = (substr($completionstatus, 0, 8) == 'complete');
                $approved = dp_is_approved($ca->approved);

                $row = array();
                $row[] = $this->display_course_name($ca);

                $row[] = $approved ? $this->display_status_as_progress_bar($ca, $completionstatus) : '';

                if ($showpriorities) {
                    $row[] = $this->display_priority($ca, $priorityscaleid);
                }

                if ($showduedates) {
                    $row[] = $this->display_duedate($ca->id, $ca->duedate);
                }

                if (!$plancompleted) {
                    $status = '';
                    if ($approved) {
                        if (!$completed) {
                            $status = $this->display_duedate_highlight_info($ca->duedate);
                        }
                    } else {
                        $status = $this->display_approval($ca, $canapprovecourses);
                    }
                    $row[] = $status;
                }

                $actions = '';

                if ($canremovecourses ||
                    ($canrequestcourses && (in_array($ca->approved, array(DP_APPROVAL_UNAPPROVED, DP_APPROVAL_DECLINED))))) {
                    $currenturl = $this->get_url();
                    $strdelete = get_string('delete', 'local_plan');
                    $delete = '<a href="'.$currenturl.'&amp;d='.$ca->id.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';

                    $actions .= $delete;
                }

                if($cansetcompletion && $approved) {
                    $strrpl = get_string('addrpl', 'local_plan');
                    $proficient = '<a href="'.$CFG->wwwroot.'/local/plan/components/course/rpl.php?planid='.$this->plan->id.'&courseid='.$ca->courseid.'">
                        <img src="'.$CFG->pixpath.'/t/ranges.gif" class="iconsmall" alt="'.$strrpl.'" /></a>';
                    $actions .= $proficient;
                }

                $row[] = $actions;

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

        $select = 'SELECT ca.*, c.fullname, c.icon, psv.name ' . sql_as() . ' priorityname ';

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
            get_string('name','local_plan'),
            get_string('progress','local_plan'),
        );
        $tablecolumns = array(
            'fullname',
            'progress',
        );

        if($showpriorities) {
            $tableheaders[] = get_string('priority', 'local_plan');
            $tablecolumns[] = 'priority';
        }

        if($showduedates) {
            $tableheaders[] = get_string('duedate', 'local_plan');
            $tablecolumns[] = 'duedate';
        }

        $table = new flexible_table('linkedcourselist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->setup();

        // get all course completions for this plan's user
        $completions = completion_info::get_all_courses($this->plan->userid);

        if($records = get_recordset_sql($select.$from.$where.$sort)) {
            // get the scale values used for competencies in this plan
            $priorityvalues = get_records('dp_priority_scale_value',
                'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

            while($ca = rs_fetch_next_record($records)) {
                $completionstatus = $this->get_completion_status($ca, $completions);
                $completed = (substr($completionstatus, 0, 8) == 'complete');

                $row = array();
                $row[] = $this->display_course_name($ca);

                $row[] = $this->display_status_as_progress_bar($ca, $completionstatus);

                if($showpriorities) {
                    $row[] = $this->display_priority_as_text($ca->priority, $ca->priorityname, $priorityvalues);
                }

                if($showduedates) {
                    $row[] = $this->display_duedate_as_text($ca->duedate);
                }

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


    function display_course_name($ca) {
        global $CFG;
        $approved = dp_is_approved($ca->approved);

        if($approved) {
            $class = '';
            $launch = '<a href="' . $CFG->wwwroot .
                '/course/view.php?id=' . $ca->courseid . '">' .
                '<div class="plan-launch-course-button"><img src="' . $CFG->pixpath . '/launch-course.png" width="56" height="18" alt="' . get_string('launchcourse', 'local_plan') . '" /></a></div>';
        } else {
            $class = ' class="dimmed"';
            $launch = '';
        }
        return '<img class="course_icon" src="' .
            $CFG->wwwroot . '/local/icon.php?icon=' . $ca->icon .
            '&amp;id=' . $ca->courseid .
            '&amp;size=small&amp;type=course" alt="' . $ca->fullname.
            '"><a' . $class .' href="' . $CFG->wwwroot .
            '/local/plan/components/' . $this->component.'/view.php?id=' .
            $this->plan->id . '&amp;itemid=' . $ca->id . '">' . $ca->fullname .
            '</a>'. $launch;
    }

    function display_course_detail($caid) {
        global $CFG;

        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;
        $priorityenabled = $this->get_setting('prioritymode') != DP_PRIORITY_NONE;
        $duedateenabled = $this->get_setting('duedatemode') != DP_DUEDATES_NONE;

        $sql = 'SELECT ca.*, course.*, psv.name ' . sql_as() . ' priorityname ' .
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
        $completions = completion_info::get_all_courses($this->plan->userid);
        $completionstatus = $this->get_completion_status($item, $completions);
        if ($progressbar = $this->display_status_as_progress_bar($item, $completionstatus)) {
            unset($completions, $completionstatus);
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

    function display_status_as_progress_bar($ca, $completionstatus) {
        global $CFG;
        // @todo Move this into the single course page?
        $plancompleted = $this->plan->status == DP_PLAN_STATUS_COMPLETE;
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

        // @todo let users with permission edit the completion status
        // as long as the plan is not complete
        /*
        if(!$plancompleted && $canupdatecoursestatus) {
            $strassess = 'Assess';
            $out .= '<a href="'.$CFG->wwwroot.'/local/plan/components/course/assess.php?id='.$this->plan->id.'&amp;itemid='.$ca->id.'" title="'.$strassess.'"><img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$strassess.'" /></a>';
        }
         */
        return $out;
    }

    function get_completion_status($ca, $completions) {
        // use value stored in dp_plan_course_assign if plan is already complete
        if($this->plan->status == DP_PLAN_STATUS_COMPLETE) {
            return $ca->completionstatus;
        }
        // otherwise look up 'live' value from course completions table
        if(array_key_exists($ca->courseid, $completions)) {
            return completion_completion::get_status($completions[$ca->courseid]);
        } else {
            // no completion record
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
            foreach($duedates as $id => $duedate) {
                // allow empty due dates
                if($duedate == '' || $duedate == 'dd/mm/yy') {
                    $duedateout = null;
                } else {
                    $datepattern = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{2})$/';
                    if (preg_match($datepattern, $duedate, $matches) == 0) {
                        // skip badly formatted date strings
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
            begin_sql();
            foreach($stored_records as $itemid => $record) {
                // Update the record
                $status = $status & update_record('dp_plan_course_assign', $record);
            }

            if ($status) {
                commit_sql();

                // Process update notifications
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
                        $updates .= $courseprinted ? '' : $courseheader;
                        $courseprinted = true;
                        $updates .= get_string('approval', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>dp_get_approval_status_from_code($oldrecords[$itemid]->approved),
                                'after'=>dp_get_approval_status_from_code($record->approved)))."<br>";
                    }
                    $updates .= $courseprinted ? '</p>' : '';
                }  // foreach

                // Send update notification
                if ($this->plan->status != DP_PLAN_STATUS_UNAPPROVED && strlen($updates)) {
                    $this->send_component_update_notification($updates);
                }
            } else {
                rollback_sql();
            }

            if ($this->plan->reviewing_pending) {
                return $status;
            }
            else {
                if ($status) {
                    totara_set_notification(get_string('coursesupdated','local_plan'), $currenturl, array('style'=>'notifysuccess'));
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
            $result = delete_records('dp_plan_component_relation', 'component1', 'course', 'itemid1', $item->itemid);
            $result = $result && delete_records('dp_plan_component_relation', 'component2', 'course', 'itemid2', $item->itemid);
        }

        return $result;
    }
}
