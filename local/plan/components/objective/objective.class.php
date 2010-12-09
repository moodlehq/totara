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
            $settings[$this->component.'_objectivescale'] = $objectivesettings->objectivescale;
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
        if ($permission == DP_PERMISSION_ALLOW) {
            $btntext = get_string('addnewobjective', 'local_plan');
        } else {
            $btntext = get_string('updaterequestedobjectives', 'local_plan');
        }

        $html = '<div class="buttons">';
        $html .= print_single_button("{$CFG->wwwroot}/local/plan/components/objective/edit.php", array('id'=>$this->plan->id), $btntext, 'get', '_SELF', true);
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
                {$CFG->prefix}dp_plan_objective a
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
     * Add form elements to the advanced workflow template settings form
     * @global object $CFG
     * @global array $DP_AVAILABLE_ROLES
     * @param object $mform
     * @param int $id
     */
    static public function add_settings_form(&$mform, $id) {
        global $CFG, $DP_AVAILABLE_ROLES;

        $mform->addElement('header', 'objectivesettings', get_string('objectivesettings', 'local_plan'));

        if ($templatesettings = get_record('dp_objective_settings', 'templateid', $id)) {
            $defaultduedatesmode = $templatesettings->duedatemode;
            $defaultprioritymode = $templatesettings->prioritymode;
            $defaultpriorityscale = $templatesettings->priorityscale;
            $defaultobjectivescale = $templatesettings->objectivescale;
        } else {
            $defaultduedatesmode = null;
            $defaultprioritymode = null;
            $defaultpriorityscale = null;
            $defaultobjectivescale = $templatesettings->objectivescale;
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

        // objective scale selector
        $objectivemenu = array();
        if ($objectives = dp_get_objectives()){
            foreach ($objectives as $objective){
                $objectivemenu[$objective->id] = $objective->name;
            }
        }
        $mform->addElement('select', 'objectivescale', get_string('objectivescale', 'local_plan'), $objectivemenu);
        $mform->setDefault('objectivescale', $defaultobjectivescale);

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

    /**
     * Process the advanced workflow template settings form
     * @global object $CFG
     * @global array $DP_AVAILABLE_ROLES
     * @param object $fromform
     * @param int $id
     */
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
        $todb->objectivescale = $fromform->objectivescale;
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

        $as = sql_as();
        $count = 'SELECT COUNT(*) ';
        $select = "SELECT o.id, o.fullname {$as} objname, osv.name {$as} status, o.duedate, psv.id as priority, psv.name {$as} priorityname ";
        $select .= ", (select count(*) from {$CFG->prefix}dp_plan_component_relation pcr where pcr.component1='course' and pcr.component2='objective' and pcr.itemid2=o.id) {$as} numcourses ";
        // todo: Add evidence support
//        $select .= ", (select count(*) from {$CFG->prefix}dp_plan_relation pr where pr.itemtype1='evidence' and pr.itemtype2='objective' and pr.itemid2=o.id) {$as} numevidences ";

        // get objectives assigned to this plan
        $from = "FROM {$CFG->prefix}dp_plan_objective o ";
        $from .= "LEFT JOIN {$CFG->prefix}dp_objective_scale_value osv
                ON o.scalevalueid = osv.id ";
        $from .= "LEFT JOIN {$CFG->prefix}dp_priority_scale_value psv
                ON (o.priority = psv.id
                AND psv.priorityscaleid = {$priorityscaleid}) ";

        $where = "WHERE o.planid = {$this->plan->id} ";
 
        $count = count_records_sql($count.$from.$where);
        if (!$count) {
            return '<div class="noitems-assignobjectives">'.get_string('noobjectives', 'local_plan').'</div>';
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
        if ($showpriorities){
            $priorityvalues = get_records('dp_priority_scale_value',
                'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');
        }

        $records = get_recordset_sql(
                $select.$from.$where.$sort,
                $table->get_page_start(),
                $table->get_page_size()
        );
        if ( $records ){

            while($objective = rs_fetch_next_record($records)) {
                
                $row = array();
                $row[] = $this->display_objective_name($objective);
                $row[] = $objective->numcourses;
//                $row[] = $objective->numevidences;

                if($showpriorities) {
                    $row[] = $this->display_priority($objective, $priorityvalues);
                }

                if($showduedates) {
                    $row[] = $this->display_duedate($objective->id, $objective->duedate, null);
                }

                if(!$plancompleted) {
                    $row[] = format_string($objective->status);
                }

                if($canremoveobjectives) {
                    $deleteurl = $CFG->wwwroot
                        . '/local/plan/components/objective/edit.php?id='
                        . $this->plan->id
                        . '&itemid='
                        . $objective->id
                        . '&d=1';
                    $strdelete = get_string('delete', 'local_plan');
                    $row[] = '<a href="'.$deleteurl.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';
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
     * Generates a flexibletable of details for all the courses linked to the
     * objective
     *
     * @global object $CFG
     * @param int $objectiveid
     * @return string
     */
    function display_linked_courses($objectiveid) {
        global $CFG;

        $tableheaders = array(
            get_string('linkedx', 'local_plan', get_string('courses')),
        );
        $tablecolumns = array(
            'fullname',
        );

        $table = new flexible_table('linkedcourselist');
        $table->define_columns($tablecolumns);
        $table->define_headers($tableheaders);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->setup();

        $list = $this->get_linked_components($objectiveid, 'course');
        if(is_array($list) && count($list) > 0) {
            $sql = "select * from {$CFG->prefix}course c where c.id in (" . implode(',', $list) . ") order by c.fullname";
            $records = get_recordset_sql($sql);
            if ($records){

                while($ca = rs_fetch_next_record($records)) {

                    $row = array();
                    ob_start();
                    print_course($ca);
                    $row[] = ob_get_contents();
                    ob_end_clean();
                    $table->add_data($row);
                }

                rs_close($records);

            }
        } else {
            $table->add_data(array(get_string('nolinkedx', 'local_plan', get_string('courses'))));
        }
        // return instead of outputing table contents
        ob_start();
        $table->print_html();
        $out = ob_get_contents();
        ob_end_clean();

        return $out;
    }

    function display_objective_name($objective) {
        global $CFG;

        return '<a href="'.$CFG->wwwroot.'/local/plan/components/' .
            $this->component . '/view.php?id=' . $this->plan->id .
            '&amp;itemid=' . $objective->id . '">' . $objective->objname . '</a>';
    }


    /**
     * Print details of a single objective
     *
     * @param integer $objectiveid ID of the objective assignment (not the objective id)
     *
     * @return void
     */
    function objective_form($objectiveid=null, $action='view') {
        global $CFG;
        $customdata = array(
            'plan' => $this->plan,
            'objective' => $this,
            'action' => $action
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
                        'objectiveid'=>$objectiveid,
                        'action'=>$action
                    )
            );
            $mform->set_data($objective);
            return $mform;
        }
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
                $status = $status & update_record('dp_plan_objective', $record);
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

    function delete_objective($caid) {
        $canremoveobjective = ($this->get_setting('updateobjective') == DP_PERMISSION_ALLOW);
        // need permission to remove this objective
        if(!$canremoveobjective) {
            return false;
        }

        begin_sql();
        $result = delete_records('dp_plan_objective', 'id', $caid);
        $result = $result && delete_records('dp_plan_component_relation', 'component1', 'objective', 'itemid1', $caid);
        $result = $result && delete_records('dp_plan_component_relation', 'component2', 'objective', 'itemid2', $caid);
        commit_sql();

        return $result;
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


    /**
     * Create a new objective. Assumes that compatibility with duedaterequired
     * and priorityrequired has been taken care of.
     *
     * @param <type> $objective
     * @return <type>
     */
    public function create_objective($fullname, $shortname=null, $description=null, $priority=null, $duedate=null) {
        if ( !$this->can_update_items() ){
            return false;
        }

        $rec = new stdClass();
        $rec->planid = $this->plan->id;
        $rec->fullname = $fullname;
        $rec->shortname = $shortname;
        $rec->description = $description;
        $rec->priority = $priority;
        $rec->duedate = $duedate;
        $rec->scalevalueid = get_field('dp_objective_scale', 'defaultid', 'id', $this->get_setting('objectivescale'));
        $rec->approved = 0;

        return insert_record('dp_plan_objective', $rec);
    }

}
