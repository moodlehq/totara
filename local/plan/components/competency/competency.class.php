<?php
class dp_competency_component extends dp_base_component {
    public static $permissions = array(
        'updatecompetency' => true,
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
            $settings[$this->component.'_autoassignorg'] = $competencysettings->autoassignorg;
            $settings[$this->component.'_autoassignpos'] = $competencysettings->autoassignpos;
        }
    }

    /**
     * Can the logged in user update items in this plan
     *
     * Returns false if they cannot, or a constant detailing their
     * exact permissions if they can
     *
     * @access  public
     * @return  false|int
     */
    public function can_update_items() {
        // Get permissions
        $plancompleted = $this->plan->status == DP_PLAN_STATUS_COMPLETE;
        $updateitem = (int) $this->get_setting('updatecompetency');

        // If plan complete, or user cannot edit/request items, no point showing picker
        if ($plancompleted || !in_array($updateitem, array(DP_PERMISSION_ALLOW, DP_PERMISSION_REQUEST, DP_PERMISSION_APPROVE))) {
            return false;
        }

        return $updateitem;
    }


    /**
     * Return markup for javascript competency picker
     *
     * @access  public
     * @return  string
     */
    public function display_picker() {

        if (!$permission = $this->can_update_items()) {
            return '';
        }

        // Decide on button text
        if ($permission >= DP_PERMISSION_ALLOW) {
            $btntext = get_string('addremovecompetencies', 'local_plan');
        } else {
            $btntext = get_string('updaterequestedcompetencies', 'local_plan');
        }

        $html  = '<div class="buttons">';
        $html .= '<div class="singlebutton dp-plan-assign-button">';
        /*
        <form action="<?php echo $CFG->wwwroot ?>/hierarchy/type/<?php echo $this->prefix ?>/related/find.php?id=<?php echo $item->id ?>&amp;frameworkid=<?php echo $item->frameworkid ?>" method="get">
         */
        $html .= '<div>';
        $html .= '<script type="text/javascript">var plan_id = '.$this->plan->id.';</script>';
        $html .= '<input type="submit" id="show-competency-dialog" value="'.$btntext.'" />';
        /*
    <input type="hidden" name="id" value="<?php echo $item->id ?>">
    <input type="hidden" name="nojs" value="1">
    <input type="hidden" name="returnurl" value="<?php echo qualified_me(); ?>">
    <input type="hidden" name="s" value="<?php echo sesskey(); ?>">
    <input type="hidden" name="frameworkid" value="<?php echo $item->frameworkid ?>">
</div>
</form>
         */
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }


    /**
     * Get list of items assigned to plan
     *
     * @access  public
     * @return  array
     */
    public function get_assigned_items() {
        global $CFG;

        $assigned = get_records_sql(
            "
            SELECT
                c.id,
                a.planid,
                a.competencyid,
                a.id AS itemid,
                c.fullname,
                a.approved
            FROM
                {$CFG->prefix}dp_plan_competency_assign a
            INNER JOIN
                {$CFG->prefix}comp c
             ON c.id = a.competencyid
            WHERE
                a.planid = {$this->plan->id}
            "
        );

        if (!$assigned) {
            $assigned = array();
        }

        return $assigned;
    }

    /**
     * Get count items items assigned to plan
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
                {$CFG->prefix}dp_plan_competency_assign a
            INNER JOIN
                {$CFG->prefix}comp c
             ON c.id = a.competencyid
            WHERE
                a.planid = {$this->plan->id}
            "
        );

        if (!$count) {
            $count = 0;
        }

        return $count;
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
            $this->get_setting('updatecompetency') == DP_PERMISSION_APPROVE;
        $canremovecomps = !$plancompleted &&
            $this->get_setting('updatecompetency') == DP_PERMISSION_ALLOW;

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
            return '<span class="noitems-assigncompetencies">'.get_string('nocompetencies', 'local_plan').'</span>';
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

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->sortable(true);
        $table->no_sorting('status');
        $table->no_sorting('actions');
        $table->setup();
        $table->pagesize(20, $count);
        $sort = $table->get_sql_sort();
        $sort = ($sort=='') ? '' : ' ORDER BY ' . $sort;

        // get all proficiency values for this plan's user
        if(!$proficiencies = $this->get_proficiencies($this->plan->userid)) {
            $proficiencies = array();
        }

        // get the scale values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        if($records = get_recordset_sql($select.$from.$where.$sort,
            $table->get_page_start(),
            $table->get_page_size())) {

            while($ca = rs_fetch_next_record($records)) {
                $proficient = $this->is_proficient($ca, $proficiencies);
                $approved = dp_is_approved($ca->approved);

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

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
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
        $approved = dp_is_approved($ca->approved);

        $class = ($approved) ? '' : ' class="dimmed"';
        return '<a' . $class . ' href="'.$CFG->wwwroot.'/local/plan/components/' .
            $this->component . '/view.php?id=' . $this->plan->id .
            '&amp;itemid=' . $ca->id . '">' . $ca->fullname . '</a>';
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
        $out .= '<table border="0">';
        if($priorityenabled) {
            $out .= '<tr><th>';
            $out .= get_string('priority', 'local_plan') . ':';
            $out .= '</td><th>';
            $out .= $this->display_priority_as_text($item->priority,
                $item->priorityname, $priorityvalues);
            $out .= '</td></tr>';
        }
        if($duedateenabled) {
            $out .= '<tr><th>';
            $out .= get_string('duedate', 'local_plan') . ':';
            $out .= '</th><td>';
            $out .= $this->display_duedate_as_text($item->duedate);
            $out .= '<br />';
            $out .= $this->display_duedate_highlight_info($item->duedate);
            $out .= '</td></tr>';
        }
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
        $canapprovecomps = ($this->get_setting('updatecompetency') == DP_PERMISSION_APPROVE);
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
                $this->plan->set_status_unapproved_if_declined();
                totara_set_notification(get_string('competenciesupdated','local_plan'), $currenturl, array('style'=>'notifysuccess'));
            } else {
                rollback_sql();
                totara_set_notification(get_string('error:competenciesupdated','local_plan'), $currenturl);
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

                    $this->plan->set_status_unapproved_if_declined();
                    totara_set_notification(get_string('approvalremindersent','local_plan'), $redirecturl->out(), array('style' => 'notifysuccess'));

                    //@todo set event/notification?
                }
                break;
            default:
                break;
        }

    }


    function remove_competency_assignment($caid) {
        $canremovecompetency = ($this->get_setting('updatecompetency') == DP_PERMISSION_ALLOW);
        // need permission to remove this competency
        if(!$canremovecompetency) {
            return false;
        }

        return delete_records('dp_plan_competency_assign', 'id', $caid);
    }

    /**
     * Assign a new item to this component of the plan
     *
     * @access  public
     * @param   $itemid     integer
     * @return  void
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
        if ($permission == DP_PERMISSION_ALLOW) {
            $item->approved = DP_APPROVAL_APPROVED;
        }
        else { # $permission == DP_PERMISSION_REQUEST
            $item->approved = DP_APPROVAL_UNAPPROVED;
        }

        return insert_record('dp_plan_competency_assign', $item);
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
