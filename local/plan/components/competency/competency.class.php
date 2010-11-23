<?php
class dp_competency_component extends dp_base_component {
    public static $permissions = array(
        'addcompetency' => true,
        'removecompetency' => true,
        'commenton' => false,
        'setpriority' => false,
        'setduedate' => false,
        'setproficiency' => true
    );

    function __construct($plan) {
        $this->component = 'competency';
        $this->defaultname = get_string('competencies', 'local_plan');

        parent::__construct($plan);
    }

    function initialize_settings(&$settings) {
        if($competencysettings = get_record('dp_competency_settings', 'templateid', $this->plan->templateid)) {
            $settings[$this->component.'_duedatemode'] = $competencysettings->duedatemode;
            $settings[$this->component.'_prioritymode'] = $competencysettings->prioritymode;
            $settings[$this->component.'_priorityscale'] = $competencysettings->priorityscale;
            $settings[$this->component.'_auto_assign_org'] = $competencysettings->auto_assign_org;
            $settings[$this->component.'_auto_assign_pos'] = $competencysettings->auto_assign_pos;
        }
    }

    static public function add_settings_form(&$mform, $id) {
        global $CFG, $DP_AVAILABLE_ROLES;

        $mform->addElement('header', 'competencysettings', get_string('competencysettings', 'local_plan'));

        if ($templatesettings = get_record('dp_competency_settings', 'templateid', $id)) {
            $defaultduedatesmode = $templatesettings->duedatemode;
            $defaultprioritymode = $templatesettings->prioritymode;
            $defaultpriorityscale = $templatesettings->priorityscale;
            $defaultautoassignpos = $templatesettings->autoassignpos;
            $defaultautoassignorg = $templatesettings->autoassignorg;
        } else {
            $defaultduedatesmode = null;
            $defaultprioritymode = null;
            $defaultpriorityscale = null;
            $defaultautoassignpos = null;
            $defaultautoassignorg = null;
        }
        // due date mode options
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'duedatemode', '', get_string('none', 'local_plan'), DP_DUEDATES_NONE);
        $radiogroup[] =& $mform->createElement('radio', 'duedatemode', '', get_string('optional', 'local_plan'), DP_DUEDATES_OPTIONAL);
        $radiogroup[] =& $mform->createElement('radio', 'duedatemode', '', get_string('required', 'local_plan'), DP_DUEDATES_REQUIRED);
        $mform->addGroup($radiogroup, 'duedategroup', get_string('duedates','local_plan'), '<br />', false);
        $mform->setDefault('duedatemode', $defaultduedatesmode);

        // priorities mode options
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'prioritymode', '', get_string('none', 'local_plan'), DP_PRIORITY_NONE);
        $radiogroup[] =& $mform->createElement('radio', 'prioritymode', '', get_string('optional', 'local_plan'), DP_PRIORITY_OPTIONAL);
        $radiogroup[] =& $mform->createElement('radio', 'prioritymode', '', get_string('required', 'local_plan'), DP_PRIORITY_REQUIRED);
        $mform->addGroup($radiogroup, 'prioritygroup', get_string('priorities','local_plan'), '<br />', false);
        $mform->setDefault('prioritymode', $defaultprioritymode);

        // priority scale selector
        $priorities = dp_get_priorities();
        $prioritymenu = array();
        foreach($priorities as $priority) {
            $prioritymenu[$priority->id] = $priority->name;
        }

        $mform->addElement('select', 'priorityscale', get_string('priorityscale', 'local_plan'), $prioritymenu);
        $mform->disabledIf('priorityscale', 'prioritymode', 'eq', DP_PRIORITY_NONE);
        $mform->setDefault('priorityscale', $defaultpriorityscale);

        // auto assign options
        $autoassigngroup = array();
        $autoassigngroup[] =& $mform->createElement('advcheckbox', 'autoassignpos', null, get_string('autoassignpos', 'local_plan'));
        $autoassigngroup[] =& $mform->createElement('advcheckbox', 'autoassignorg', null, get_string('autoassignorg', 'local_plan'));

        $mform->addGroup($autoassigngroup, 'autoassign', get_string('autoassign', 'local_plan'), array('<br />'), false);
        $mform->setDefault('autoassignpos', $defaultautoassignpos);
        $mform->setDefault('autoassignorg', $defaultautoassignorg);

        //Permissions
        $mform->addElement('header', 'competencypermissions', get_string('competencypermissions', 'local_plan'));

        $mform->addElement('html', '<div class="coursepermissionsform"><table><tr>'.
            '<th>'.get_string('action', 'local_plan').'</th>'.
            '<th>'.get_string('learner', 'local_plan').'</th>'.
            '<th>'.get_string('manager', 'local_plan').'</th></tr>');

        foreach(self::$permissions as $action => $requestable) {
            dp_add_permissions_table_row($mform, $action, get_string($action, 'local_plan'), $requestable);
        }

        foreach(self::$permissions as $action => $requestable) {
            foreach($DP_AVAILABLE_ROLES as $role){
                $sql = "SELECT value FROM {$CFG->prefix}dp_permissions WHERE role='$role' AND component='competency' AND action='{$action}'";
                $defaultvalue = get_field_sql($sql);
                $mform->setDefault($action.$role, $defaultvalue);
            }
        }
        $mform->addElement('html', '</table></div>');
    }

    static public function process_settings_form($fromform, $id) {
        global $CFG, $DP_AVAILABLE_ROLES;
        $currenturl = $CFG->wwwroot .
            '/local/plan/template/advancedworkflow.php?id=' . $id .
            '&amp;component=competency';

        begin_sql();
        $currentworkflow = get_field('dp_template', 'workflow', 'id', $id);
        if($currentworkflow != 'custom') {
            $template_update = new object();
            $template_update->id = $id;
            $template_update->workflow = 'custom';
            if(!update_record('dp_template', $template_update)){
                rollback_sql();
                totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
            }
        }

        $todb = new object();
        $todb->templateid = $id;
        $todb->duedatemode = $fromform->duedatemode;
        $todb->prioritymode = $fromform->prioritymode;
        if($fromform->prioritymode != DP_PRIORITY_NONE) {
            $todb->priorityscale = $fromform->priorityscale;
        }
        $todb->autoassignorg = $fromform->autoassignorg;
        $todb->autoassignpos = $fromform->autoassignpos;
        // @todo add scale info
        if($competencysettings = get_record('dp_competency_settings', 'templateid', $id)) {
            // update
            begin_sql();
            $todb->id = $competencysettings->id;
            if(!update_record('dp_competency_settings', $todb)) {
                rollback_sql();
                totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
            }
        } else {
            // insert
            begin_sql();
            if(!insert_record('dp_competency_settings', $todb)) {
                rollback_sql();
                totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
            }
        }


        foreach(self::$permissions as $action => $requestable) {
            foreach($DP_AVAILABLE_ROLES as $role) {
                $permission_todb = new object();
                $permission_todb->templateid = $id;
                $permission_todb->component = 'competency';
                $permission_todb->action = $action;
                $permission_todb->role = $role;
                $temp = $action . $role;
                $permission_todb->value = $fromform->$temp;

                $sql = "SELECT * FROM {$CFG->prefix}dp_permissions WHERE templateid={$id} AND component='competency' AND action='{$action}' AND role='{$role}'";

                if($permission_setting = get_record_sql($sql)){
                    //update
                    $permission_todb->id = $permission_setting->id;
                    if(!update_record('dp_permissions', $permission_todb)) {
                        rollback_sql();
                        totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
                    }
                } else {
                    //insert
                    if(!insert_record('dp_permissions', $permission_todb)) {
                        rollback_sql();
                        totara_set_notification(get_string('error:update_competency_settings','local_plan'), $currenturl);
                    }
                }
            }
        }

        commit_sql();
        totara_set_notification(get_string('update_competency_settings','local_plan'), $currenturl, array('style' => 'notifysuccess'));
    }

    function display_competency_list() {
        global $CFG;

        $showduedates = ($this->get_setting('duedatemode') == DP_DUEDATES_OPTIONAL ||
            $this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED);
        $showpriorities =
            ($this->get_setting('prioritymode') == DP_PRIORITY_OPTIONAL ||
            $this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;
        $plancompleted = $this->plan->status == DP_PLAN_STATUS_COMPLETE;
        $canapprovecomps = !$plancompleted &&
            $this->get_setting('addcompetency') == DP_PERMISSION_APPROVE;
        $canremovecomps = !$plancompleted &&
            $this->get_setting('removecompetency') == DP_PERMISSION_ALLOW;

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

        $count = count_records_sql($count.$from.$where);
        if (!$count) {
            return get_string('nocompetencies', 'local_plan');
        }

        $tableheaders = array(
            get_string('name','local_plan'),
            get_string('proficiency', 'local_plan'),
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
            $tableheaders[] = get_string('status','local_plan');
            $tablecolumns[] = 'status';
        }

        if($canremovecomps) {
            $tableheaders[] = get_string('actions', 'local_plan');
            $tablecolumns[] = 'actions';
        }

        $table = new flexible_table('competencylist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox');
        $table->sortable(true);
        $table->no_sorting('status');
        $table->no_sorting('actions');
        $table->setup();
        $table->pagesize(20, $count);
        $sort = $table->get_sql_sort();
        $sort = ($sort=='') ? '' : ' ORDER BY ' . $sort;

        // get all proficiency values for this plan's user
        $proficiencies = $this->get_proficiencies($this->plan->userid);

        // get the scale values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        if($records = get_recordset_sql($select.$from.$where.$sort,
            $table->get_page_start(),
            $table->get_page_size())) {

            while($ca = rs_fetch_next_record($records)) {
                $proficient = $this->is_proficient($ca, $proficiencies);
                $approved = $ca->approved == DP_APPROVAL_APPROVED;

                $row = array();
                $row[] = $this->display_competency_name($ca);

                $row[] = $approved ? $this->display_status($ca) : '';

                if($showpriorities) {
                    $row[] = $this->display_priority($ca, $priorityvalues);
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

                if($canremovecomps) {
                    $currenturl = $CFG->wwwroot .
                        '/local/plan/components/competency/index.php?id=' .
                        $this->plan->id;
                    $strdelete = get_string('delete', 'local_plan');
                    $row[] = '<a href="'.$currenturl.'&amp;d='.$ca->id.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';
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

        $table->set_attribute('class', 'logtable generalbox');
        $table->setup();

        // get all proficiency values for this plan's user
        $proficiencies = $this->get_proficiencies($this->plan->userid);

        // get the scale values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        if($records = get_recordset_sql($select.$from.$where.$sort)) {

            while($ca = rs_fetch_next_record($records)) {
                $proficient = $this->is_proficient($ca, $proficiencies);

                $row = array();
                $row[] = $this->display_competency_name($ca);

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
     * Returns an array of all competencies that a user has a comp_evidence
     * record for, keyed on the competencyid. Also returns the required
     * proficiency value and isproficient, which is 1 if the user meets the
     * proficiency and 0 otherwise
     *
     * @todo move this method into the competency libraries
     */
    function get_proficiencies($userid) {
        global $CFG;
        $sql = "SELECT ce.competencyid, ce.proficiency, cs.proficient,
                CASE WHEN ce.proficiency=cs.proficient THEN 1
                ELSE 0 END AS isproficient
            FROM {$CFG->prefix}comp_evidence ce
            LEFT JOIN {$CFG->prefix}comp c ON c.id=ce.competencyid
            LEFT JOIN {$CFG->prefix}comp_scale_assignments csa
                ON c.frameworkid = csa.frameworkid
            LEFT JOIN {$CFG->prefix}comp_scale cs ON cs.id=csa.scaleid
            WHERE ce.userid=$userid";
        return get_records_sql($sql);
    }

    function display_competency_name($ca) {
        global $CFG;
        $approved = ($ca->approved == DP_APPROVAL_APPROVED);

        $class = ($approved) ? '' : ' class="dimmed"';
        return '<a' . $class . ' href="'.$CFG->wwwroot.'/local/plan/components/' .
            $this->component . '/view.php?id=' . $this->plan->id .
            '&amp;itemid=' . $ca->id . '">' . $ca->fullname . '</a>';
    }


    function get_assigned_items() {
        return get_records('dp_plan_competency_assign', 'planid', $this->plan->id);
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
            return get_string('competencynotfound','local_plan');
        }

        $out = '';

        // get the priority values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        // @todo add competency icon
        $out .= '<h3>' . $item->fullname . '</h3>';
        $out .= '<table border="0">';
        $out .= '<tr><th>';
        $out .= get_string('priority', 'local_plan') . ':';
        $out .= '</td><th>';
        $out .= $this->display_priority_as_text($item->priority,
            $item->priorityname, $priorityvalues);
        $out .= '</td></tr>';
        $out .= '<tr><th>';
        $out .= get_string('duedate', 'local_plan') . ':';
        $out .= '</th><td>';
        $out .= $this->display_duedate_as_text($item->duedate);
        $out .= '<br />';
        $out .= $this->display_duedate_highlight_info($item->duedate);
        $out .= '</td></tr>';
        $out .= '</table>';
        $out .= '<p>' . $item->description . '</p>';

        return $out;
    }

    /**
     * Display approval options for competencies
     *
     * Overwrite base display_approval_options() method to show links instead of
     * pulldown menu. This is necessary because each competency must be
     * individually approved (to set evidence/assessor etc)
     *
     * @param stdClass $obj The assignment object
     * @param integer $approvalstatus The currently selected approval status
     * @return $out string an html string
     */
    function display_approval_options($obj, $approvalstatus) {
        global $CFG;
        // @todo link to relevant pages
        // @todo add icons
        return '<a href="' . $CFG->wwwroot . '/local/plan/components/' .
            $this->component . '/approval.php?id=' . $obj->planid . '&amp;itemid=' .
            $obj->id . '&amp;action=approve">' . get_string('approve','local_plan') . '</a> ' .
            '<a href="' . $CFG->wwwroot . '/local/plan/components/' .
            $this->component . '/approval.php?id=' . $obj->planid . '&amp;itemid=' .
            $obj->id . '&amp;action=decline">' . get_string('decline','local_plan') . '</a> ';
    }

    function display_status($ca) {
        global $CFG;

        // @todo: add colors and stuff?
        return format_string($ca->status);
    }

    function process_competency_settings_update() {
        if (!confirm_sesskey()) {
            return 0;
        }
        // @todo validation notices, including preventing empty due dates
        // if duedatemode is required
        $cansetduedates = ($this->get_setting('setduedate') == DP_PERMISSION_ALLOW);
        $cansetpriorities = ($this->get_setting('setpriority') == DP_PERMISSION_ALLOW);
        $canapprovecomps = ($this->get_setting('addcompetency') == DP_PERMISSION_APPROVE);
        $duedates = optional_param('duedate', array(), PARAM_TEXT);
        $priorities = optional_param('priorities', array(), PARAM_INT);
        $approvals = optional_param('approve', array(), PARAM_INT);
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
                if(array_key_exists($id, $stored_records)) {
                    // add to the existing update object
                    $stored_records[$id]->approved = $approval;
                } else {
                    // create a new update object
                    $todb = new object();
                    $todb->id = $id;
                    $todb->approved = $approved;
                    $stored_records[$id] = $todb;
                }
            }
        }
        $status = true;
        if (!empty($stored_records)) {
            begin_sql();
            foreach($stored_records as $itemid => $record) {
                $status = $status & update_record('dp_plan_competency_assign', $record);
            }
            if($status) {
                commit_sql();
                totara_set_notification(get_string('competenciesupdated','local_plan'), $currenturl, array('style'=>'notifysuccess'));
            } else {
                rollback_sql();
                totara_set_notification(get_string('competenciesnotupdated','local_plan'), $currenturl);
            }
        }

        redirect($currenturl);
    }

    function process_action($action) {
        global $CFG;

        switch ($action) {
            case 'remind' :
                $confirm = optional_param('confirm', false, PARAM_BOOL);
                $assignmentid = required_param('assignmentid', PARAM_INT);

                $redirecturl = new moodle_url(strip_querystring(qualified_me()));
                $redirecturl->param('id', $this->plan->id);

                // Get competency and assignment details
                $sql = "SELECT c.*, ca.*
                        FROM {$CFG->prefix}dp_plan_competency_assign ca
                        INNER JOIN {$CFG->prefix}comp c ON ca.competencyid = c.id
                        WHERE ca.id = {$assignmentid}";

                $comp_details = get_record_sql($sql);

                if (!$confirm) {
                    // Show confirmation message
                    print_header_simple();
                    $remindurl = new moodle_url(qualified_me());
                    $remindurl->param('confirm', 'true');
                    $strdelete = get_string('checksendapprovalreminder', 'local_plan');
                    notice_yesno(
                        "{$strdelete}<br /><br />".format_string($comp_details->fullname),
                        $remindurl->out(),
                        $redirecturl->out()
                    );

                    print_footer();
                    exit;
                } else {
                    // Get user's manager(s); email reminder
                    $managers = dp_get_notification_receivers_2(get_context_instance(CONTEXT_USER, $this->plan->userid), 'manager');
                    foreach ($managers as $manager) {
                        // @todo send email
                        //email_to_user($manager, $from, $subject, $bodycopy);
                    }
                    totara_set_notification(get_string('approvalremindersent','local_plan'), $redirecturl->out(), array('style' => 'notifysuccess'));

                    //@todo set event/notification?
                }
                break;
            default:
                break;
        }
    }


    function remove_competency_assignment($caid) {
        $canremovecompetency = ($this->get_setting('removecompetency') == DP_PERMISSION_ALLOW);
        // need permission to remove this competency
        if(!$canremovecompetency) {
            return false;
        }

        return delete_records('dp_plan_competency_assign', 'id', $caid);
    }

    function assign_competencies($competencies) {
        begin_sql();
        foreach ($competencies as $c) {
            $todb = new stdClass;
            $todb->planid = $this->plan->id;
            $todb->competencyid = $c->id;
            if (!insert_record('dp_plan_competency_assign', $todb)) {
                rollback_sql();
                return false;
            }
        }
        commit_sql();
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
    }
}
