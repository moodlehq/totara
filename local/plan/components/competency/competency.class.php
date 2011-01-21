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
        if ($this->plan->is_complete()) {
            // Use the 'snapshot' status value
            $status = "LEFT JOIN {$CFG->prefix}comp_scale_values csv ON a.scalevalueid = csv.id ";
        } else {
            // Use the 'live' status value
            $status = "
                LEFT JOIN
                    {$CFG->prefix}comp_evidence ce
                 ON a.competencyid = ce.competencyid
                AND ce.userid = {$this->plan->userid}
                LEFT JOIN
                    {$CFG->prefix}comp_scale_values csv
                 ON ce.proficiency = csv.id";
        }

        $assigned = get_records_sql(
            "
            SELECT
                a.*,
                c.fullname,
                c.fullname AS name,
                CASE WHEN linkedcourses.count IS NULL
                    THEN 0 ELSE linkedcourses.count
                END AS linkedcourses,
                csv.name AS status,
                csv.sortorder AS profsort
            FROM
                {$CFG->prefix}dp_plan_competency_assign a
            INNER JOIN
                {$CFG->prefix}comp c
                ON c.id = a.competencyid
            LEFT JOIN
                (SELECT itemid1 " . sql_as() . " assignid,
                    count(id) " . sql_as() . " count
                    FROM {$CFG->prefix}dp_plan_component_relation
                    WHERE component1='competency' AND
                        component2='course'
                    GROUP BY itemid1) linkedcourses
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
     * Get course evidence items associated with required competencies
     *
     * Looks up the evidence items assigned to each competency and
     * finds any with a type of 'coursecompletion', if found, returns
     * an array of the course information.
     *
     * This is used to determine the default 'linked courses' that
     * should be added to the plan when this competency is added.
     *
     * @param array $competencies Array of competency IDs
     *
     * @return array Array of objects, keyed on the competency ids provided. Each element contains an object containing course id and name
     */
    function get_course_evidence_items($competencies) {
        global $CFG;
        // for access to evidence item type constants
        require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');

        // invalid input
        if(!is_array($competencies)) {
            return false;
        }

        // no competencies, return empty array
        if(count($competencies) == 0) {
            return array();
        }

        $sql = 'SELECT cei.id, cei.competencyid, cei.iteminstance ' .
            sql_as() . " courseid, c.fullname
            FROM {$CFG->prefix}comp_evidence_items cei
            LEFT JOIN {$CFG->prefix}course c ON
                cei.iteminstance = c.id
            WHERE cei.itemtype = '" .
                COMPETENCY_EVIDENCE_TYPE_COURSE_COMPLETION ."' AND
                cei.competencyid IN (" .
            implode(',', $competencies) . ')';
        $records = get_records_sql($sql);

        // restructure into 2d array for easy access
        $out = array();
        if($records) {
            foreach($records as $record) {
                $compid = $record->competencyid;

                if(!array_key_exists($compid, $out)) {
                    // start an array
                    $out[$compid] = array($record);
                } else {
                    // append to array
                    $out[$compid][] = $record;
                }
            }
        }
        return $out;
    }

    function display_approval_list($pendingitems) {
        $competencies = array();
        foreach($pendingitems as $item) {
            $competencies[] = $item->competencyid;
        }
        $evidence = $this->get_course_evidence_items($competencies);

        $table = new object();
        $table->class = 'generaltable learning-plan-pending-approval-table';
        $table->data = array();
        foreach($pendingitems as $item) {
            $row = array();
            // @todo write abstracted display_item_name() and use here
            $name = $item->fullname;

            // if there is competency evidence, display it below the
            // competency with checkboxes and a description
            if(array_key_exists($item->competencyid, $evidence)) {
                // @todo lang string
                $name .= '<br /><div class="related-courses"><strong>Include related courses:</strong>';
                foreach($evidence[$item->competencyid] as $course) {
                    if($this->plan->get_component('course')->is_item_assigned($course->courseid)) {
                        $message = ' (' .
                            get_string('alreadyassignedtoplan', 'local_plan'). ')';
                    } else {
                        $message = '';
                    }
                    $name .= '<br />' .
                        // @todo add code to disable unless
                        // pulldown set to approve
                        '<input type="checkbox" checked="checked" name="linkedcourses[' . $item->id . '][' . $course->courseid . ']" value="1"> ' .
                        $course->fullname . $message;
                }
                $name .= '</div>';
            }

            $row[] = $name;
                ;
            $row[] = $this->display_approval_options($item, $item->approved);
            $table->data[] = $row;
        }
        return print_table($table, true);
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
            AND ca.approved=" . DP_APPROVAL_APPROVED . ' ';

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

        // get the scale values used for competencies in this plan
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        if($records = get_recordset_sql($select.$from.$where.$sort)) {

            while($ca = rs_fetch_next_record($records)) {
                $proficient = $this->is_item_complete($ca);

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


    /**
     * Check if an item is complete
     *
     * @access  protected
     * @param   object  $item
     * @return  boolean
     */
    protected function is_item_complete($item) {

        // Get proficiencies
        if (!$proficiencies = competency::get_proficiencies($this->plan->userid)) {
            $proficiencies = array();
        }

        // If no record
        if (!array_key_exists($item->competencyid, $proficiencies)) {
            return false;
        }

        // Something wrong with get_proficiencies()
        if (!isset($proficiencies[$item->competencyid]->isproficient)) {
            return false;
        }

        return $proficiencies[$item->competencyid]->isproficient;
    }


    /**
     * Get item's proficiency value
     *
     * @access  public
     * @param   object  $item
     * @return  string
     */
    private function get_item_proficiency($item) {

        // Get proficiencies
        if (!$proficiencies = competency::get_proficiencies($this->plan->userid)) {
            $proficiencies = array();
        }

        // If no record
        if (!array_key_exists($item->id, $proficiencies)) {
            return false;
        }

        // Something wrong with get_proficiencies()
        if (!isset($proficiencies[$item->id]->isproficient)) {
            return false;
        }

        return $proficiencies[$item->id]->proficiency;
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
        $icon = $this->determine_item_icon($item);
        return '<img class="competency_state_icon" src="' .
            $CFG->wwwroot . '/local/icon.php?icon=' . $icon .
            '&amp;size=small&amp;type=msg" alt="' . $item->fullname.
            '"><a' . $class .' href="' . $CFG->wwwroot .
            '/local/plan/components/' . $this->component.'/view.php?id=' .
            $this->plan->id . '&amp;itemid=' . $item->id . '">' . $item->fullname .
            '</a>';
    }

    function determine_item_icon($item) {
        // @todo in future the item state will determine the icon
        return "competency-regular";
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

        $icon = $this->determine_item_icon($item);
        $icon = "<img class=\"competency_state_icon\" src=\"{$CFG->wwwroot}/local/icon.php?icon={$icon}&amp;size=small&amp;type=msg\" alt=\"{$item->fullname}\">";
        $out .= '<h3>' . $icon . $item->fullname . '</h3>';
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


    public function display_status($item) {
        // @todo: add colors and stuff?
        return format_string($item->status);
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
        $linkedcourses = optional_param('linkedcourses', array(), PARAM_INT);
        $currenturl = qualified_me();
        $stored_records = array();

        $status = true;
        if(!empty($duedates) && $cansetduedates) {
            // Update duedates
            foreach($duedates as $id => $duedate) {
                // allow empty due dates
                if($duedate == '' || $duedate == 'dd/mm/yy') {
                    // set all empty due dates to the plan due date
                    // if they are required
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
                // if the record was updated check for linked courses
                if(isset($record->approved) && $record->approved == DP_APPROVAL_APPROVED) {
                    if(isset($linkedcourses[$record->id]) &&
                        is_array($linkedcourses[$record->id])) {
                        //   add the linked courses
                        foreach($linkedcourses[$record->id] as $course => $unused) {
                            // add course if it's not already in this plan
                            // @todo what if course is assigned but not approved?
                            if(!$this->plan->get_component('course')->is_item_assigned($course)) {
                                $this->plan->get_component('course')->assign_new_item($course);
                            }
                            // now we need to grab the assignment ID
                            $assignmentid = get_field('dp_plan_course_assign',
                                'id', 'planid', $this->plan->id, 'courseid', $course);
                            if(!$assignmentid) {
                                // something went wrong trying to assign the course
                                // don't attempt to create a relation
                                $status = false;
                                continue;
                            }
                            // create relation
                            $this->plan->add_component_relation('competency', $record->id, 'course', $assignmentid);

                        }
                    }
                }
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


    protected function display_list_item_progress($item) {
        return $this->is_item_approved($item->approved) ? $this->display_status($item) : '';
    }


    protected function display_list_item_actions($item) {
        global $CFG;

        $markup = '';

        // Get permissions
        $cansetproficiency = !$this->plan->is_complete() && $this->get_setting('setproficiency') >= DP_PERMISSION_ALLOW;
        $approved = $this->is_item_approved($item->approved);

        if ($this->can_delete_item($item)) {
            $currenturl = $this->get_url();
            $strdelete = get_string('delete', 'local_plan');
            $delete = '<a href="'.$currenturl.'&amp;d='.$item->id.'" title="'.$strdelete.'"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$strdelete.'" /></a>';

            $markup .= $delete;
        }

        if ($cansetproficiency && $approved) {
            $straddevidence = get_string('addevidence', 'local_plan');
            $proficient = '<a href="'.$CFG->wwwroot.'/local/plan/components/competency/add_evidence.php?userid='.$this->plan->userid.'&amp;id='.$this->plan->id.'&amp;competencyid='.$item->competencyid.'"
                title="'.$straddevidence.'">
                <img src="'.$CFG->pixpath.'/t/ranges.gif" class="iconsmall" alt="'.$straddevidence.'" /></a>';
            $markup .= $proficient;
        }

        return $markup;
    }


    /*
     * Return markup for javascript course picker
     * competencyid integer - the id of the competency for which selected& available courses should be displayed
     * @access  public
     * @return  string
     */
    public function display_course_picker($competencyid) {

        if (!$permission = $this->can_update_items()) {
            return '';
        }

        $coursename = get_string('courseplural', 'local_plan');
        $btntext = get_string('updatelinkedx', 'local_plan', $coursename);

        $html  = '<div class="buttons">';
        $html .= '<div class="singlebutton dp-plan-assign-button">';
        $html .= '<div>';
        $html .= '<script type="text/javascript">var competency_id = ' . $competencyid . ';';
        $html .= 'var plan_id = ' . $this->plan->id . ';</script>';
        $html .= '<input type="submit" id="show-course-dialog" value="' . $btntext . '" />';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }



}
