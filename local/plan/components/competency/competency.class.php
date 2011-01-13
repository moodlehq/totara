<?php

require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');

class dp_competency_component extends dp_base_component {

    public static $permissions = array(
        'updatecompetency' => true,
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
        $this->defaultname = get_string('competencies', 'local_plan');
    }


    /**
     * Initialize settings for the component
     *
     * @access  public
     * @param   array   $settings
     * @return  void
     */
    public function initialize_settings(&$settings) {
        if ($competencysettings = get_record('dp_competency_settings', 'templateid', $this->plan->templateid)) {
            $settings[$this->component.'_duedatemode'] = $competencysettings->duedatemode;
            $settings[$this->component.'_prioritymode'] = $competencysettings->prioritymode;
            $settings[$this->component.'_priorityscale'] = $competencysettings->priorityscale;
            $settings[$this->component.'_autoassignorg'] = $competencysettings->autoassignorg;
            $settings[$this->component.'_autoassignpos'] = $competencysettings->autoassignpos;
        }
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
                a.id,
                a.planid,
                a.competencyid,
                c.fullname,
                a.approved
            FROM
                {$CFG->prefix}dp_plan_competency_assign a
            INNER JOIN
                {$CFG->prefix}comp c
             ON c.id = a.competencyid
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
     * Process an action
     *
     * General component actions can come in here
     *
     * @access  public
     * @return  void
     */
    public function process_action_hook() {
        $delete = optional_param('d', 0, PARAM_INT); // competency assignment id to delete
        $confirm = optional_param('confirm', 0, PARAM_INT); // confirm delete

        $currenturl = $this->get_url();

        if ($delete && $confirm) {
            if(!confirm_sesskey()) {
                totara_set_notification(get_string('confirmsesskeybad', 'error'), $currenturl);
            }
            if($this->remove_competency_assignment($delete)) {
                totara_set_notification(get_string('canremoveitem','local_plan'), $currenturl, array('style' => 'notifysuccess'));
            } else {
                totara_set_notification(get_string('cannotremoveitem', 'local_plan'), $currenturl);
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
                $CFG->wwwroot.'/local/plan/components/competency/find.js.php'
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

        if($delete) {
            notice_yesno(get_string('confirmitemdelete','local_plan'), $currenturl.'&amp;d='.$delete.'&amp;confirm=1&amp;sesskey='.sesskey(), $currenturl);
            print_footer();
            die();
        }
    }


    /**
     * Return markup to display competency items in a table
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
        $canapprovecomps = !$plancompleted &&
            $this->get_setting('updatecompetency') == DP_PERMISSION_APPROVE;
        $canremovecomps = !$plancompleted &&
            $this->get_setting('updatecompetency') >= DP_PERMISSION_ALLOW;
        $canrequestcomps = !$plancompleted &&
            $this->get_setting('updatecompetency') == DP_PERMISSION_REQUEST;
        $cansetproficiency = !$plancompleted &&
            $this->get_setting('setproficiency') >= DP_PERMISSION_ALLOW;

        $count = 'SELECT COUNT(*) ';
        $select = 'SELECT ca.*, c.fullname, csv.name ' . sql_as() .
            ' status, csv.sortorder ' . sql_as() . ' profsort, psv.name ' .
            sql_as() . ' priorityname ';

        // get competencies assigned to this plan
        $from = "FROM {$CFG->prefix}dp_plan_competency_assign ca
                LEFT JOIN
                {$CFG->prefix}comp c ON c.id = ca.competencyid ";
        if ($this->plan->status == DP_PLAN_STATUS_COMPLETE) {
            // Use the 'snapshot' status value
            $from .= "LEFT JOIN {$CFG->prefix}comp_scale_values csv ON ca.scalevalueid = csv.id ";
        } else {
            // Use the 'live' status value
            $from .= "LEFT JOIN {$CFG->prefix}comp_evidence ce
                    ON ca.competencyid = ce.competencyid
                    AND ce.userid = {$this->plan->userid}
                LEFT JOIN {$CFG->prefix}comp_scale_values csv
                    ON ce.proficiency = csv.id ";
        }
            $from .= "LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                    ON (ca.priority = psv.id
                    AND psv.priorityscaleid = {$priorityscaleid}) ";

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
            return '<span class="noitems-assigncompetencies">'.get_string('nocompetencies', 'local_plan').'</span>';
        }

        $tableheaders = array(
            get_string('competency','local_plan'),
            get_string('status', 'local_plan'),
        );
        $tablecolumns = array(
            'c.fullname',
            'profsort',
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
            //$tableheaders[] = get_string('status','local_plan');
            $tableheaders[] = '';  // don't show a status header
            $tablecolumns[] = 'status';
        }

        $tableheaders[] = get_string('actions', 'local_plan');
        $tablecolumns[] = 'actions';

        $table = new flexible_table('competencylist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->sortable(true);
        $table->no_sorting('status');
        $table->no_sorting('actions');
        $table->setup();
        $table->pagesize(20, $count);
        $sort = $table->get_sql_sort();
        $sort = ($sort=='') ? '' : ' ORDER BY ' . $sort;

        // get all proficiency values for this plan's user
        if(!$proficiencies = competency::get_proficiencies($this->plan->userid)) {
            $proficiencies = array();
        }


        if($records = get_recordset_sql($select.$from.$where.$sort,
            $table->get_page_start(),
            $table->get_page_size())) {

            while($ca = rs_fetch_next_record($records)) {
                $proficient = $this->is_proficient($ca, $proficiencies);
                $approved = $this->is_item_approved($ca->approved);

                $row = array();
                $row[] = $this->display_item_name($ca);

                $row[] = $approved ? $this->display_status($ca) : '';

                if($showpriorities) {
                    $row[] = $this->display_priority($ca, $priorityscaleid);
                }

                if($showduedates) {
                    $row[] = $this->display_duedate($ca->id, $ca->duedate, null);
                }

                if(!$plancompleted) {
                    $status = '';
                    if($approved) {
                        if(!$proficient) {
                            $status = $this->display_duedate_highlight_info($ca->duedate);
                        }
                    } else {
                        $status = $this->display_approval($ca, $canapprovecomps);
                    }
                    $row[] = $status;
                }

                $actions = '';

                if ($canremovecomps ||
                    ($canrequestcomps && (in_array($ca->approved, array(DP_APPROVAL_UNAPPROVED, DP_APPROVAL_DECLINED))))) {
                    $currenturl = $this->get_url();
                    $strdelete = get_string('delete', 'local_plan');
                    $delete = '<a href="'.$currenturl.'&amp;d='.$ca->id.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';

                    $actions .= $delete;
                }

                if($cansetproficiency && $approved) {
                    $straddevidence = get_string('addevidence', 'local_plan');
                    $proficient = '<a href="'.$CFG->wwwroot.'/local/plan/components/competency/add_evidence.php?userid='.$this->plan->userid.'&planid='.$this->plan->id.'&competencyid='.$ca->competencyid.'">
                        <img src="'.$CFG->pixpath.'/t/ranges.gif" class="iconsmall" alt="'.$straddevidence.'" /></a>';
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


    function display_linked_competencies($list) {
        global $CFG;

        if(!is_array($list) || count($list) == 0) {
            return false;
        }

        $showduedates = ($this->get_setting('duedatemode') == DP_DUEDATES_OPTIONAL ||
            $this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED);
        $showpriorities =
            ($this->get_setting('prioritymode') == DP_PRIORITY_OPTIONAL ||
            $this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;

        $select = 'SELECT ca.*, c.fullname, csv.name ' . sql_as() .
            ' status, csv.sortorder ' . sql_as() . ' profsort, psv.name ' .
            sql_as() . ' priorityname ';

        // get competencies assigned to this plan
        $from = "FROM {$CFG->prefix}dp_plan_competency_assign ca
                LEFT JOIN
                {$CFG->prefix}comp c ON c.id = ca.competencyid ";
        if ($this->plan->status == DP_PLAN_STATUS_COMPLETE) {
            // Use the 'snapshot' status value
            $from .= "LEFT JOIN {$CFG->prefix}comp_scale_values csv ON ca.scalevalueid = csv.id ";
        } else {
            // Use the 'live' status value
            $from .= "LEFT JOIN {$CFG->prefix}comp_evidence ce
                    ON ca.competencyid = ce.competencyid
                    AND ce.userid = {$this->plan->userid}
                LEFT JOIN {$CFG->prefix}comp_scale_values csv
                    ON ce.proficiency = csv.id ";
        }
            $from .= "LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                    ON (ca.priority = psv.id
                    AND psv.priorityscaleid = {$priorityscaleid}) ";

        $where = "WHERE ca.id IN (" . implode(',', $list) . ")
            AND ca.approved=1 ";

        $sort = "ORDER BY c.fullname";

        $tableheaders = array(
            get_string('name','local_plan'),
            get_string('proficiency', 'local_plan'),
        );
        $tablecolumns = array(
            'fullname',
            'proficiency',
        );

        if($showpriorities) {
            $tableheaders[] = get_string('priority', 'local_plan');
            $tablecolumns[] = 'priority';
        }

        if($showduedates) {
            $tableheaders[] = get_string('duedate', 'local_plan');
            $tablecolumns[] = 'duedate';
        }

        $table = new flexible_table('linkedcompetencylist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->setup();

        // get all proficiency values for this plan's user
        $proficiencies = competency::get_proficiencies($this->plan->userid);

        // get the scale values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        if($records = get_recordset_sql($select.$from.$where.$sort)) {

            while($ca = rs_fetch_next_record($records)) {
                $proficient = $this->is_proficient($ca, $proficiencies);

                $row = array();
                $row[] = $this->display_item_name($ca);

                $row[] = $this->display_status($ca);

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

    function is_proficient($ca, $proficiencies) {
        $compid = $ca->competencyid;
        // no record
        if(!array_key_exists($compid, $proficiencies)) {
            return false;
        }
        // something wrong with get_proficiencies()
        if(!isset($proficiencies[$compid]->isproficient)) {
            return false;
        }
        return $proficiencies[$compid]->isproficient;
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

        $class = ($approved) ? '' : ' class="dimmed"';
        return '<a' . $class . ' href="'.$CFG->wwwroot.'/local/plan/components/' .
            $this->component . '/view.php?id=' . $this->plan->id .
            '&amp;itemid=' . $item->id . '">' . $item->fullname . '</a>';
    }


    /**
     * Display details for a single competency
     *
     * @param integer $caid ID of the competency assignment (not the competency id)
     *
     * @return string HTML string to display the competency information
     */
    function display_competency_detail($caid) {
        global $CFG;

        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;

        $priorityenabled = $this->get_setting('prioritymode') != DP_PRIORITY_NONE;
        $duedateenabled = $this->get_setting('duedatemode') != DP_DUEDATES_NONE;

        // get competency assignment and competency details
        $sql = 'SELECT ca.*, comp.*, psv.name ' . sql_as() . ' priorityname ' .
            "FROM {$CFG->prefix}dp_plan_competency_assign ca
                LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                    ON (ca.priority = psv.id
                    AND psv.priorityscaleid = {$priorityscaleid})
                LEFT JOIN {$CFG->prefix}comp comp ON comp.id = ca.competencyid
                WHERE ca.id = $caid";
        $item = get_record_sql($sql);

        if(!$item) {
            return get_string('error:competencynotfound','local_plan');
        }

        $out = '';

        // get the priority values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        // @todo add competency icon
        $out .= '<h3>' . $item->fullname . '</h3>';
        $out .= '<table border="0" class="planiteminfobox">';
        $out .= '<tr>';
        if($priorityenabled && !empty($item->priority)) {
            $out .= "<td>";
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
        $out .= "</tr>";
        $out .= '</table>';
        $out .= '<p>' . $item->description . '</p>';

        return $out;
    }


    function display_status($ca) {
        global $CFG;

        // @todo: add colors and stuff?
        return format_string($ca->status);
    }


    /**
     * Process component's settings update
     *
     * @access  public
     * @return  void
     */
    public function process_settings_update() {
        global $CFG;

        if (!confirm_sesskey()) {
            return 0;
        }
        // @todo validation notices, including preventing empty due dates
        // if duedatemode is required
        $cansetduedates = ($this->get_setting('setduedate') == DP_PERMISSION_ALLOW);
        $cansetpriorities = ($this->get_setting('setpriority') == DP_PERMISSION_ALLOW);
        $canapprovecomps = ($this->get_setting('updatecompetency') == DP_PERMISSION_APPROVE);
        $duedates = optional_param('duedate_competency', array(), PARAM_TEXT);
        $priorities = optional_param('priorities_competency', array(), PARAM_INT);
        $approvals = optional_param('approve_competency', array(), PARAM_INT);
        $currenturl = qualified_me();
        $stored_records = array();

        $status = true;
        if(!empty($duedates) && $cansetduedates) {
            // Update duedates
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

        if(!empty($priorities) && $cansetpriorities) {
            foreach($priorities as $id => $priority) {
                $priority = (int) $priority;
                if(array_key_exists($id, $stored_records)) {
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

        if (!empty($approvals) && $canapprovecomps) {
            // Update approvals
            foreach ($approvals as $id => $approval) {
                if (!$approval) {
                    continue;
                }
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
            $oldrecords = get_records_list('dp_plan_competency_assign', 'id', implode(',', array_keys($stored_records)));
            $updates = '';
            begin_sql();
            foreach($stored_records as $itemid => $record) {
                // Update the record
                $status = $status & update_record('dp_plan_competency_assign', $record);
            }

            if ($status) {
                commit_sql();

                // Process update notifications
                foreach($stored_records as $itemid => $record) {
                    $competency = get_record('comp', 'id', $oldrecords[$itemid]->competencyid);
                    $compheader = '<p><strong>'.format_string($competency->fullname).": </strong><br>";
                    $compprinted = false;
                    if (!empty($record->priority) && $oldrecords[$itemid]->priority != $record->priority) {
                        $oldpriority = get_field('dp_priority_scale_value', 'name', 'id', $oldrecords[$itemid]->priority);
                        $newpriority = get_field('dp_priority_scale_value', 'name', 'id', $record->priority);
                        $updates .= $compheader;
                        $compprinted = true;
                        $updates .= get_string('priority', 'local_plan').' - '.get_string('changedfromxtoy',
                            'local_plan', (object)array('before'=>$oldpriority, 'after'=>$newpriority))."<br>";
                    }
                    if (!empty($record->duedate) && $oldrecords[$itemid]->duedate != $record->duedate) {
                        $updates .= $compprinted ? '' : $compheader;
                        $compprinted = true;
                        $updates .= get_string('duedate', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                                (object)array('before'=>empty($oldrecords[$itemid]->duedate) ? '' :
                                    userdate($oldrecords[$itemid]->duedate, '%e %h %Y', $CFG->timezone, false),
                                'after'=>userdate($record->duedate, '%e %h %Y', $CFG->timezone, false)))."<br>";
                    }
                    if (!empty($record->approved) && $oldrecords[$itemid]->approved != $record->approved) {
                        $updates .= $compprinted ? '' : $compheader;
                        $compprinted = true;
                        $updates .= get_string('approval', 'local_plan').' - '.
                            get_string('changedfromxtoy', 'local_plan',
                            (object)array('before'=>dp_get_approval_status_from_code($oldrecords[$itemid]->approved), 
                            'after'=>dp_get_approval_status_from_code($record->approved)))."<br>";
                    }
                    // TODO: proficiencies ??
                    $updates .= $compprinted ? '</p>' : '';
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
                    totara_set_notification(get_string('competenciesupdated','local_plan'), $currenturl, array('style'=>'notifysuccess'));
                } else {
                    totara_set_notification(get_string('error:competenciesupdated','local_plan'), $currenturl);
                }
            }
        }

        if ($this->plan->reviewing_pending) {
            return null;
        }

        redirect($currenturl);
    }


    function remove_competency_assignment($caid) {
        // Load item
        $item = get_record('dp_plan_competency_assign', 'id', $caid);

        if (!$item) {
            return false;
        }

        $item->itemid = $item->id;
        return $this->unassign_item($item);
    }

    /**
     * Assign a new item to this component of the plan
     *
     * @access  public
     * @param   $itemid     integer
     * @return  added item's name
     */
    public function assign_new_item($itemid) {

        // Get approval value for new item
        if (!$permission = $this->can_update_items()) {
            print_error('error:cannotupdatecompetencies', 'local_plan');
        }

        $item = new object();
        $item->planid = $this->plan->id;
        $item->competencyid = $itemid;
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
        if ($permission >= DP_PERMISSION_ALLOW ) {
            $item->approved = DP_APPROVAL_APPROVED;
        }
        else { # $permission == DP_PERMISSION_REQUEST
            $item->approved = DP_APPROVAL_UNAPPROVED;
        }

        return insert_record('dp_plan_competency_assign', $item) ? get_field('comp', 'fullname', 'id', $itemid) : false;
    }



    function assign_competencies($competencies) {
        // Get all currently-assigned competencies
        $assigned = get_records('dp_plan_competency_assign', 'planid', $this->plan->id, '', 'competencyid');
        $assigned = !empty($assigned) ? array_keys($assigned) : array();
        foreach ($competencies as $c) {
            if (in_array($c->id, $assigned)) {
                // Don't assign duplicate competencies
                continue;
            }

            // Assign competency item
            if (!$this->assign_new_item($c->id)) {
                return false;
            }
        }

        return true;
    }

    function assign_from_pos() {
        global $CFG;

        require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
        // Get primary position
        $position_assignment = new position_assignment(
            array(
                'userid'    => $this->plan->userid,
                'type'      => POSITION_TYPE_PRIMARY
            )
        );
        if (empty($position_assignment->positionid)) {
            // No position assigned to the primary position, so just go away
            return true;
        }
        $position = new position();
        if ($competencies = $position->get_assigned_competencies($position_assignment->positionid)) {
            return $this->assign_competencies($competencies);
        }

        return true;
    }

    function assign_from_org() {
        global $CFG;

        require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
        // Get primary position
        $position_assignment = new position_assignment(
            array(
                'userid'    => $this->plan->userid,
                'type'      => POSITION_TYPE_PRIMARY
            )
        );
        if (empty($position_assignment->organisationid)) {
            // No organisation assigned to the primary position, so just go away
            return true;
        }

        require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');
        $org = new organisation();
        if ($competencies = $org->get_assigned_competencies($position_assignment->positionid)) {
            return $this->assign_competencies($competencies);
        }

        return true;
    }
}
