<?php
class dp_objective_component extends dp_base_component {
    public static $permissions = array(
        'updateobjective' => true,
        'commenton' => false,
        'setpriority' => false,
        'setduedate' => false,
        'setproficiency' => true
    );

    function __construct($plan) {
        $this->component = 'objective';
        $this->defaultname = get_string('objectives', 'local_plan');

        parent::__construct($plan);
    }

    function initialize_settings(&$settings) {
        if($objectivesettings = get_record('dp_objective_settings', 'templateid', $this->plan->templateid)) {
            $settings[$this->component.'_duedatemode'] = $objectivesettings->duedatemode;
            $settings[$this->component.'_prioritymode'] = $objectivesettings->prioritymode;
            $settings[$this->component.'_priorityscale'] = $objectivesettings->priorityscale;
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
        $updateitem = (int) $this->get_setting('updateobjective');

        // If plan complete, or user cannot edit/request items, no point showing picker
        if ($plancompleted || !in_array($updateitem, array(DP_PERMISSION_ALLOW, DP_PERMISSION_REQUEST))) {
            return false;
        }

        return $updateitem;
    }


    /**
     * Return markup for javascript course picker
     *
     * @access  public
     * @return  string
     */
    public function display_picker() {

        if (!$permission = $this->can_update_items()) {
            return '';
        }

        // Decide on button text
        if ($permission == DP_PERMISSION_ALLOW) {
            $btntext = get_string('addremoveobjectives', 'local_plan');
        } else {
            $btntext = get_string('updaterequestedobjectives', 'local_plan');
        }

        $html  = '<div class="buttons">';
        $html .= '<div class="singlebutton dp-plan-assign-button">';
        /*
        <form action="<?php echo $CFG->wwwroot ?>/hierarchy/type/<?php echo $this->prefix ?>/related/find.php?id=<?php echo $item->id ?>&amp;frameworkid=<?php echo $item->frameworkid ?>" method="get">
         */
        $html .= '<div>';
        $html .= '<script type="text/javascript">var plan_id = '.$this->plan->id.';</script>';
        $html .= '<input type="submit" id="show-objective-dialog" value="'.$btntext.'" />';
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
                obj.id,
                obj.planid,
                obj.fullname
            FROM
                {$CFG->prefix}dp_plan_objective obj
            WHERE
                obj.planid = {$this->plan->id}
            "
        );

        if (!$assigned) {
            $assigned = array();
        }

        return $assigned;
    }


    static public function add_settings_form(&$mform, $id) {
        global $CFG, $DP_AVAILABLE_ROLES;

        $mform->addElement('header', 'objectivesettings', get_string('objectivesettings', 'local_plan'));

        if ($templatesettings = get_record('dp_objective_settings', 'templateid', $id)) {
            $defaultduedatesmode = $templatesettings->duedatemode;
            $defaultprioritymode = $templatesettings->prioritymode;
            $defaultpriorityscale = $templatesettings->priorityscale;
        } else {
            $defaultduedatesmode = null;
            $defaultprioritymode = null;
            $defaultpriorityscale = null;
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
        $prioritymenu = array();
        if($priorities = dp_get_priorities()) {
            foreach($priorities as $priority) {
                $prioritymenu[$priority->id] = $priority->name;
            }
        }

        $mform->addElement('select', 'priorityscale', get_string('priorityscale', 'local_plan'), $prioritymenu);
        $mform->disabledIf('priorityscale', 'prioritymode', 'eq', DP_PRIORITY_NONE);
        $mform->setDefault('priorityscale', $defaultpriorityscale);

        //Permissions
        $mform->addElement('header', 'objectivepermissions', get_string('objectivepermissions', 'local_plan'));

        $mform->addElement('html', '<div class="coursepermissionsform"><table><tr>'.
            '<th>'.get_string('action', 'local_plan').'</th>'.
            '<th>'.get_string('learner', 'local_plan').'</th>'.
            '<th>'.get_string('manager', 'local_plan').'</th></tr>');

        foreach(self::$permissions as $action => $requestable) {
            dp_add_permissions_table_row($mform, $action, get_string($action, 'local_plan'), $requestable);
        }

        foreach(self::$permissions as $action => $requestable) {
            foreach($DP_AVAILABLE_ROLES as $role){
                $sql = "SELECT value FROM {$CFG->prefix}dp_permissions WHERE role='$role' AND component='objective' AND action='{$action}'";
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
            '&amp;component=objective';

        begin_sql();
        $currentworkflow = get_field('dp_template', 'workflow', 'id', $id);
        if($currentworkflow != 'custom') {
            $template_update = new object();
            $template_update->id = $id;
            $template_update->workflow = 'custom';
            if(!update_record('dp_template', $template_update)){
                rollback_sql();
                totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
            }
        }

        $todb = new object();
        $todb->templateid = $id;
        $todb->duedatemode = $fromform->duedatemode;
        $todb->prioritymode = $fromform->prioritymode;
        if($fromform->prioritymode != DP_PRIORITY_NONE) {
            $todb->priorityscale = $fromform->priorityscale;
        }
        // @todo add scale info
        if($objectivesettings = get_record('dp_objective_settings', 'templateid', $id)) {
            // update
            begin_sql();
            $todb->id = $objectivesettings->id;
            if(!update_record('dp_objective_settings', $todb)) {
                rollback_sql();
                totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
            }
        } else {
            // insert
            begin_sql();
            if(!insert_record('dp_objective_settings', $todb)) {
                rollback_sql();
                totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
            }
        }


        foreach(self::$permissions as $action => $requestable) {
            foreach($DP_AVAILABLE_ROLES as $role) {
                $permission_todb = new object();
                $permission_todb->templateid = $id;
                $permission_todb->component = 'objective';
                $permission_todb->action = $action;
                $permission_todb->role = $role;
                $temp = $action . $role;
                $permission_todb->value = $fromform->$temp;

                $sql = "SELECT * FROM {$CFG->prefix}dp_permissions WHERE templateid={$id} AND component='objective' AND action='{$action}' AND role='{$role}'";

                if($permission_setting = get_record_sql($sql)){
                    //update
                    $permission_todb->id = $permission_setting->id;
                    if(!update_record('dp_permissions', $permission_todb)) {
                        rollback_sql();
                        totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
                    }
                } else {
                    //insert
                    if(!insert_record('dp_permissions', $permission_todb)) {
                        rollback_sql();
                        totara_set_notification(get_string('error:update_objective_settings','local_plan'), $currenturl);
                    }
                }
            }
        }

        commit_sql();
        totara_set_notification(get_string('update_objective_settings','local_plan'), $currenturl, array('style' => 'notifysuccess'));
    }


    /**
     * Generates a flexibletable listing all the objectives in the current plan.
     * 
     * @global object $CFG
     * @return string
     */
    function display_objective_list() {
        global $CFG;

        $showduedates = ($this->get_setting('duedatemode') == DP_DUEDATES_OPTIONAL ||
            $this->get_setting('duedatemode') == DP_DUEDATES_REQUIRED);
        $showpriorities =
            ($this->get_setting('prioritymode') == DP_PRIORITY_OPTIONAL ||
            $this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;
        $plancompleted = $this->plan->status == DP_PLAN_STATUS_COMPLETE;
        $canapproveobjectives = !$plancompleted &&
            $this->get_setting('updateobjective') == DP_PERMISSION_APPROVE;
        $canremoveobjectives = !$plancompleted &&
            $this->get_setting('updateobjective') == DP_PERMISSION_ALLOW;

        $count = 'SELECT COUNT(*) ';
        $select = 'SELECT o.id, o.fullname '.sql_as().' objname, o.status, o.duedate, psv.id as priority, psv.name ' . sql_as() . ' priorityname ';
        $select .= ', sum(case when oa.itemtype=\'course\' then 1 else 0 end) ' . sql_as() . ' numcourses ';
// todo: Add evidence support
//        $select .= ', sum(case when oa.itemtype=\'evidence\' then 1 else 0 end) ' . sql_as() . ' numevidence ';
        $select .= ', sum(oa.approved) as numapproved ';

        // get objectives assigned to this plan
        $from = "FROM {$CFG->prefix}dp_plan_objective o
                LEFT JOIN
                {$CFG->prefix}dp_plan_objective_assign oa ON o.id = oa.objectiveid ";
        $from .= "LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                ON (o.priority = psv.id
                AND psv.priorityscaleid = {$priorityscaleid}) ";
        // todo: Roll in objective scale?

        $where = "WHERE o.planid = {$this->plan->id} ";
        $groupby = "GROUP BY o.id, o.fullname, o.status, o.duedate, psv.id, psv.name ";

        $count = count_records_sql($count.$from.$where);
        if (!$count) {
            return '<span class="noitems-assignobjectives">'.get_string('noobjectives', 'local_plan').'</span>';
        }

        $tableheaders = array(
            get_string('name','local_plan'),
            'Courses',
//            'Evidence',
        );
        $tablecolumns = array(
            'objname',
            'numcourses',
//            'numevidence',
        );

        if($showpriorities) {
            $tableheaders[] = get_string('priority', 'local_plan');
            $tablecolumns[] = 'o.priority';
        }

        if($showduedates) {
            $tableheaders[] = get_string('duedate', 'local_plan');
            $tablecolumns[] = 'o.duedate';
        }

        if(!$plancompleted) {
            $tableheaders[] = get_string('status','local_plan');
            $tablecolumns[] = 'o.status';
        }

        if($canremoveobjectives) {
            $tableheaders[] = get_string('actions', 'local_plan');
            $tablecolumns[] = 'actions';
        }

        $table = new flexible_table('objectivelist');
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

        // get all course completions for this plan's user
        $completions = completion_info::get_all_courses($this->plan->userid);

        // get the scale values used for objectives in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        if($records = get_recordset_sql($select.$from.$where.$groupby.$sort,
            $table->get_page_start(),
            $table->get_page_size())) {

            while($objective = rs_fetch_next_record($records)) {
                
                // Calculate completion status
                // Check if everything is approved
                if ( $objective->numcourses == 0 ){
                    $status = 'Not yet started';
                } else if ( $objective->numapproved <= $objective->numcourses ){
                    $status = 'Not yet approved';
                } else {

                    $objectivecourses = get_records_select(
                            'dp_plan_objective_assign',
                            "objectiveid={$objective->id} and itemtype='plan'",
                            'itemid',
                            'itemid, approved'
                    );
                    if ($objectivecourses) {
                        $numcompleted = 0;
                        $coursestatuses = array();
                        foreach( $objectivecourses as $course ){
                            if ( !$course->approved ){
                                $coursestatuses[] = 10;
                            } else {
                                switch( completion_completion::get_status($completions[$course->itemid]) ){
                                    case 'complete':
                                    case 'completeviarpl':
                                        $coursestatuses[] = 40;
                                        break;
                                    case 'inprogress':
                                        $coursestatuses[] = 30;
                                        break;
                                    case 'notyetstarted':
                                    default:
                                        $coursestatuses[] = 20;
                                        break;
                                }
                            }
                        }
                        switch( min($coursestatuses) ){
                            case 10:
                                $status = 'Not approved';
                                break;
                            case 30:
                                $status = get_string('inprogress', 'completion');
                                break;
                            case 40:
                                $status = get_string('complete', 'completion');
                                break;
                            case 20:
                            default:
                                $status = get_string('notyetstarted', 'completion');
                                break;
                        }
                    } else {
                        $status = get_string('notyetstarted', 'completion');
                    }
                }

                $row = array();
                $row[] = $this->display_objective_name($objective);
                $row[] = $objective->numcourses;
//                $row[] = $objective->numevidence;

                if($showpriorities) {
                    $row[] = $this->display_priority($objective, $priorityvalues);
                }

                if($showduedates) {
                    $row[] = $this->display_duedate($objective->id, $objective->duedate, null);
                }

                if(!$plancompleted) {
                    $row[] = $status;
                }

                if($canremoveobjectives) {
                    $currenturl = $CFG->wwwroot .
                        '/local/plan/components/objective/index.php?id=' .
                        $this->plan->id;
                    $strdelete = get_string('delete', 'local_plan');
                    $row[] = '<a href="'.$currenturl.'&amp;d='.$objective->id.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';
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

    /**
     * Generates a flexibletable of details for all the objectives whose IDs are in $list
     *
     * @global object $CFG
     * @param array $list an array of objective IDs
     * @return string
     */
    function display_linked_objectives($list) {
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

//        $select = 'SELECT ca.*, c.fullname, csv.name ' . sql_as() .
//            ' status, csv.sortorder ' . sql_as() . ' profsort, psv.name ' .
//            sql_as() . ' priorityname ';
        $select = 'select o.id, o.fullname, o.status, o.duedate, psv.id ' . sql_as() . ' priority, psv.name '. sql_as(). 'priorityname ';

        // get objectives assigned to this plan
        $from = "FROM {$CFG->prefix}dp_plan_objective_assign ca
                LEFT JOIN
                {$CFG->prefix}comp c ON c.id = ca.objectiveid ";
        if ($this->plan->status == DP_PLAN_STATUS_COMPLETE) {
            // Use the 'snapshot' status value
            $from .= "LEFT JOIN {$CFG->prefix}comp_scale_values csv ON ca.scalevalueid = csv.id ";
        } else {
            // Use the 'live' status value
            $from .= "LEFT JOIN {$CFG->prefix}comp_evidence ce
                    ON ca.objectiveid = ce.objectiveid
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

        $table = new flexible_table('linkedobjectivelist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->setup();

        // get the scale values used for objectives in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        if($records = get_recordset_sql($select.$from.$where.$groupby.$sort)) {

            while($ca = rs_fetch_next_record($records)) {

                $row = array();
                $row[] = $this->display_objective_name($ca);

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

    function display_objective_name($objective) {
        global $CFG;

        return '<a href="'.$CFG->wwwroot.'/local/plan/components/' .
            $this->component . '/view.php?id=' . $this->plan->id .
            '&amp;itemid=' . $objective->id . '">' . $objective->objname . '</a>';
    }


    /**
     * Display details for a single objective
     *
     * @param integer $caid ID of the objective assignment (not the objective id)
     *
     * @return string HTML string to display the objective information
     */
    function display_objective_detail($caid) {
        global $CFG;

        $priorityscaleid = ($this->get_setting('priorityscale')) ? $this->get_setting('priorityscale') : -1;

        $priorityenabled = $this->get_setting('prioritymode') != DP_PRIORITY_NONE;
        $duedateenabled = $this->get_setting('duedatemode') != DP_DUEDATES_NONE;

        // get objective assignment and objective details
        $sql = 'SELECT o.*, psv.name ' . sql_as() . ' priorityname ' .
            "FROM {$CFG->prefix}dp_plan_objective o
                LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                    ON (o.priority = psv.id
                    AND psv.priorityscaleid = {$priorityscaleid})
                WHERE o.id = $caid";
        $item = get_record_sql($sql);

        if(!$item) {
            return get_string('error:objectivenotfound','local_plan');
        }

        $out = '';

        // get the priority values used for objectives in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        // @todo add objective icon
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
     * Display approval options for objectives
     *
     * Overwrite base display_approval_options() method to show links instead of
     * pulldown menu. This is necessary because each objective must be
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

    function display_status($objective) {
        global $CFG;

        // @todo: add colors and stuff?
        return format_string($objective->status);
    }

    function process_objective_settings_update() {
        if (!confirm_sesskey()) {
            return 0;
        }
        // @todo validation notices, including preventing empty due dates
        // if duedatemode is required
        $cansetduedates = ($this->get_setting('setduedate') == DP_PERMISSION_ALLOW);
        $cansetpriorities = ($this->get_setting('setpriority') == DP_PERMISSION_ALLOW);
        $canapprovecomps = ($this->get_setting('updateobjective') == DP_PERMISSION_APPROVE);
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
                $status = $status & update_record('dp_plan_objective_assign', $record);
            }
            if($status) {
                commit_sql();
                $this->plan->set_status_unapproved_if_declined();
                totara_set_notification(get_string('objectivesupdated','local_plan'), $currenturl, array('style'=>'notifysuccess'));
            } else {
                rollback_sql();
                totara_set_notification(get_string('objectivesnotupdated','local_plan'), $currenturl);
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

                // Get objective and assignment details
                $sql = "SELECT c.*, ca.*
                        FROM {$CFG->prefix}dp_plan_objective_assign ca
                        INNER JOIN {$CFG->prefix}comp c ON ca.objectiveid = c.id
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


    function remove_objective_assignment($caid) {
        $canremoveobjective = ($this->get_setting('updateobjective') == DP_PERMISSION_ALLOW);
        // need permission to remove this objective
        if(!$canremoveobjective) {
            return false;
        }

        return delete_records('dp_plan_objective_assign', 'id', $caid);
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
            print_error('error:cannotupdateobjectives', 'local_plan');
        }

        $item = new object();
        $item->planid = $this->plan->id;
        $item->objectiveid = $itemid;
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

        return insert_record('dp_plan_objective_assign', $item);
    }



    function assign_objectives($objectives) {
        // Get all currently-assigned objectives
        $assigned = get_records('dp_plan_objective_assign', 'planid', $this->plan->id, '', 'objectiveid');
        $assigned = !empty($assigned) ? array_keys($assigned) : array();
        foreach ($objectives as $c) {
            if (in_array($c->id, $assigned)) {
                // Don't assign duplicate objectives
                continue;
            }

            // Assign objective item
            if (!$this->assign_new_item($c->id)) {
                return false;
            }
        }

        return true;
    }

}
