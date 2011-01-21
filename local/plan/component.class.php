<?php


/**
 * Flag for dp_base_component::can_update_settings()
 */
define('LP_CHECK_ITEMS_EXIST', true);


abstract class dp_base_component {

    /**
     * Component name
     *
     * @access  public
     * @var     string
     */
    public $component;


    /**
     * Reference to the plan object
     *
     * @access  public
     * @var     object
     */
    protected $plan;


    /**
     * Constructor, add reference to plan object and
     * check required properties are set
     *
     * @access  public
     * @param   object  $plan
     * @return  void
     */
    public function __construct($plan) {
        $this->plan = $plan;

        // Calculate component name from class name
        if (!preg_match('/^dp_([a-z]+)_component$/', get_class($this), $matches)) {
            throw new Exception('Classname incorrectly formatted');
        }

        $this->component = $matches[1];

        // Check that child classes implement required properties
        $properties = array(
            'component',
            'permissions',
        );
        foreach($properties as $property) {
            if (!property_exists($this, $property) && !property_exists(get_class($this), $property)) {
                $string_properties = new object();
                $string_properties->property = $property;
                $string_properties->class = get_class($this);
                throw new Exception(get_string('error:propertymustbeset', 'local_plan', $string_properties));
            }
        }
    }


    /**
     * Initialize settings for the component
     *
     * @access  public
     * @param   array   $settings
     * @return  void
     */
    public function initialize_settings(&$settings) {
        // override this method in child classes to add component-specific
        // settings to plan's setting property
    }


    /**
     * Get setting value
     *
     * @access  public
     * @param   string  $key    Setting name
     * @return  mixed
     */
    public function get_setting($key) {
        return $this->plan->get_component_setting($this->component, $key);
    }


    /**
     * Can the logged in user update items in this component
     *
     * Returns false if they cannot, or a constant detailing their
     * exact permissions if they can
     *
     * @access  public
     * @return  false|int
     */
    public function can_update_items() {
        // Check plan is active
        if ($this->plan->is_complete()) {
            return false;
        }

        // Get permission
        $updateitem = $this->get_setting('update'.$this->component);

        // If user cannot edit/request items, no point showing picker
        if (!in_array($updateitem, array(DP_PERMISSION_ALLOW, DP_PERMISSION_REQUEST, DP_PERMISSION_APPROVE))) {
            return false;
        }

        // If the plan is in a draft state, skip the approval process
        if (!$this->plan->is_active()) {
            return DP_PERMISSION_ALLOW;
        }

        return $updateitem;
    }


    /**
     * Can the logged in user update settings for items in this component
     *
     * Returns false if they cannot, or an array detailing their
     * exact permissions if they can
     *
     * Optionally check if there are any items they can update also, and if
     * there are none return false
     *
     * @access  public
     * @param   boolean     $checkexists (optional)
     * @return  false|int
     */
    public function can_update_settings($checkexists = LP_CHECK_ITEMS_EXIST) {
        // Check plan is active
        if ($this->plan->is_complete()) {
            return false;
        }

        // Get permissions
        $can = array();
        $can['setduedate'] = $this->get_setting('setduedate') == DP_PERMISSION_ALLOW;
        $can['setpriority'] = $this->get_setting('setpriority') == DP_PERMISSION_ALLOW;
        $can['approve'.$this->component] = $this->get_setting('update'.$this->component) == DP_PERMISSION_APPROVE;

        // If user has no permissions, return false
        if (!count($can)) {
            return false;
        }

        // If checkexists set, check for items
        if ($checkexists && !$this->get_assigned_items()) {
            return false;
        }

        // Otherwise, return permissions the user does have
        return $can;
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
    abstract public function get_assigned_items($approved = null, $orderby='', $limitfrom='', $limitnum='');


    /**
     * Get count of items assigned to plan
     *
     * Optionally, filtered by status
     *
     * @access  public
     * @param   mixed   $approved   (optional)
     * @return  integer
     */
    public function count_assigned_items($approved = null) {
        global $CFG;

        // Generate where clause
        $where = "a.planid = {$this->plan->id}";
        if ($approved !== null) {
            if (is_array($approved)) {
                $approved = implode(', ', $approved);
            }
            $where .= " AND a.approved IN ({$approved})";
        }

        $tablename = $this->get_component_table_name();

        $count = count_records_sql(
            "
            SELECT
                COUNT(a.id)
            FROM
                {$CFG->prefix}{$tablename} a
            WHERE
                $where
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
    abstract public function process_action_hook();


    /**
     * Process component's settings update
     *
     * @access  public
     * @return  void
     */
    abstract public function process_settings_update();


    /**
     * Code to run before after header is displayed
     *
     * @access  public
     * @return  void
     */
    public function post_header_hook() {}


    /**
     * Code to load the JS for the picker
     *
     * @access  public
     * @return  void
     */
    public function setup_picker() {}


    /**
     * Get url for component tab
     *
     * @access  public
     * @return  string
     */
    public function get_url() {
        global $CFG;
        return "{$CFG->wwwroot}/local/plan/component.php?id={$this->plan->id}&amp;c={$this->component}";
    }


    /**
     * Return markup to display component's assigned items in a table
     *
     * Optionally restrict results by approval status
     *
     * @access  public
     * @param   mixed   $restrict   Array or integer (optional)
     * @return  string
     */
    public function display_list($restrict = null) {
        global $CFG;

        // Plural
        $plural = strtolower(get_string($this->component.'plural', 'local_plan'));

        // If no items, return message instead of table
        if (!$count = $this->count_assigned_items($restrict)) {
            // Generate plural lang key
            return '<span class="noitems-assign'.$plural.'">'.get_string('no'.$plural, 'local_plan').'</span>';
        }

        // Get table headers/columns
        $headers = $this->get_list_headers();

        // Generate table
        $table = new flexible_table($this->component.'list');
        $table->define_columns($headers->columns);
        $table->define_headers($headers->headers);

        $table->set_attribute('class', 'logtable generalbox dp-plan-component-items');
        $table->sortable(true);
        $table->no_sorting('progress');
        $table->no_sorting('status');
        $table->no_sorting('actions');
        $table->setup();
        $table->pagesize(20, $count);

        // Load items for table
        $page_start = $table->get_page_start();
        $page_size = $table->get_page_size();
        $sort = $table->get_sql_sort();
        $items = $this->get_assigned_items($restrict, $sort, $page_start, $page_size);

        // Loop through items
        foreach ($items as $item) {
            $row = $this->display_list_row($headers->columns, $item);
            $table->add_data($row);
        }

        $table->hide_empty_cols();

        // Return instead of outputting table contents
        ob_start();
        $table->print_html();
        $out = ob_get_contents();
        ob_end_clean();

        return $out;
    }


    /**
     * Get column headers array
     *
     * @access  protected
     * @return  object
     */
    protected function get_list_headers() {
        // Get plan / component data
        $plancompleted = $this->plan->is_complete();

        // Get display options
        $optreq = array(DP_DUEDATES_OPTIONAL, DP_DUEDATES_REQUIRED);
        $showduedates = in_array($this->get_setting('duedatemode'), $optreq);
        $showpriorities = in_array($this->get_setting('prioritymode'), $optreq);

        // Generate table headers
        $tableheaders = array(
            get_string($this->component.'name', 'local_plan'),
            get_string('status', 'local_plan'),
        );

        $tablecolumns = array(
            'name',
            'progress',
        );

        if($this->component == 'competency' || $this->component == 'objective') {
            $tableheaders[] = get_string('courses');
            $tablecolumns[] = 'linkedcourses';
        }

        if ($showpriorities) {
            $tableheaders[] = get_string('priority', 'local_plan');
            $tablecolumns[] = 'priority';
        }

        if ($showduedates) {
            $tableheaders[] = get_string('duedate', 'local_plan');
            $tablecolumns[] = 'duedate';
        }

        if (!$plancompleted) {
            //$tableheaders[] = get_string('status','local_plan');
            $tableheaders[] = '';  // don't show status header
            $tablecolumns[] = 'status';
        }

        $tableheaders[] = get_string('actions', 'local_plan');
        $tablecolumns[] = 'actions';

        $return = new object();
        $return->headers = $tableheaders;
        $return->columns = $tablecolumns;

        return $return;
    }


    /**
     * Display row in item list
     *
     * @access  protected
     * @param   $cols   array
     * @param   $item   object
     * @return  array   $row
     */
    protected function display_list_row($cols, $item) {

        // Generate markup
        $row = array();

        foreach ($cols as $col) {
            $method = "display_list_item_{$col}";
            $row[] = $this->$method($item);
        }

        return $row;
    }


    /**
     * Display items from this component that require approval
     *
     * Override within component class to add additional information
     * to approval confirmation
     */
    public function display_approval_list($pendingitems) {
        $table = new object();
        $table->class = 'generaltable learning-plan-pending-approval-table';
        $table->data = array();
        foreach($pendingitems as $item) {
            $row = array();
            // @todo write abstracted display_item_name() and use here
            $row[] = $item->fullname;
            $row[] = $this->display_approval_options($item, $item->approved);
            $table->data[] = $row;
        }
        return print_table($table, true);
    }


    /**
     * Get all instances of $componentrequired linked to the specified item
     *
     * @todo doesn't current exclude unapproved items
     * that is currently handled inside display_linked_*() methods
     * but might be better to do it here?
     *
     * @todo refactor to reuse {@link get_relation_array()}
     *
     * @param integer $id Identifies the item to get linked items for
     * @param string $componentrequired Get linked items of this type
     *
     * @return array Array of IDs of all linked items, or false
     */
    function get_linked_components($id, $componentrequired) {
        global $CFG;
        // name of the current component
        $thiscomponent = $this->component;

        // component relations are stored alphabetically
        // first component is in component1
        // Figure out which order to perform query
        switch (strcmp($thiscomponent, $componentrequired)) {
        case -1:
            $matchedcomp = 'component1';
            $matchedid = 'itemid1';
            $searchedcomp = 'component2';
            $searchedid = 'itemid2';
            break;
        case 1:
            $matchedcomp = 'component2';
            $matchedid = 'itemid2';
            $searchedcomp = 'component1';
            $searchedid = 'itemid1';
            break;
        case 0:
        default:
            // linking within the same component not supported
            return false;
        }

        // find all matching relations
        $sql = "SELECT id, $searchedid " . sql_as() . " itemid
            FROM {$CFG->prefix}dp_plan_component_relation
            WHERE $matchedcomp = '$thiscomponent' AND
                $matchedid = $id AND
                $searchedcomp = '$componentrequired'";
        // return an array of IDs
        if($result = get_records_sql($sql)) {
            $out = array();
            foreach($result as $item) {
                $out[] = $item->itemid;
            }
            return $out;
        } else {
            // no matches
            return false;
        }
    }


    /**
     * Update instances of $componentupdatetype linked to the specified compoent,
     * delete links in db which aren't needed, and add links missing from db
     * which are needed
     *
     * @todo refactor to reuse {@link get_relation_array()}
     *
     * @param integer $thiscompoentid Identifies the component on one end of the link
     * @param string $componentupdatetype: the type of components on the other end of the links
     * @param array $componentids array of component ids that should be on the other end of the links in db
     *
     * @return void
     */
    function update_linked_components($thiscomponentid, $componentupdatetype, $componentids) {
        global $CFG;
        // name of the current component
        $thiscomponent = $this->component;

        // component relations are stored alphabetically
        // first component is in component1
        // Figure out which order to perform query
        switch (strcmp($thiscomponent, $componentupdatetype)) {
        case -1:
            $matchedcomp = 'component1';
            $matchedid = 'itemid1';
            $searchedcomp = 'component2';
            $searchedid = 'itemid2';
            $thiscomponentfirst = true;
            break;
        case 1:
            $matchedcomp = 'component2';
            $matchedid = 'itemid2';
            $searchedcomp = 'component1';
            $searchedid = 'itemid1';
            $thiscomponentfirst = false;
            break;
        case 0:
        default:
            // linking within the same component not supported
            return false;
        }

        // find all matching relations in db
        $sql = "SELECT id, $searchedid " . sql_as() . " itemid
            FROM {$CFG->prefix}dp_plan_component_relation
            WHERE $matchedcomp = '$thiscomponent' AND
                $matchedid = $thiscomponentid AND
                $searchedcomp = '$componentupdatetype'";
        if($result = get_records_sql($sql)) {
            $dbcomponentids = array();
            foreach($result as $item) {
                $position = array_search($item->itemid, $componentids);
                if ($position === false) {
                    //Item in db isn't in the array of items to keep - delete from db:
                    delete_records('dp_plan_component_relation', 'id', $item->id);
                } else {
                    //Item in array of items to keep is already in db - delete from keep array
                    unset($componentids[$position]);
                }
            }
        }
        if (!empty($componentids)) {
            // There are still required compoent links that are not already in the database:
            $relation->component1 = $thiscomponentfirst ? $thiscomponent : $componentupdatetype;
            $relation->component2 = $thiscomponentfirst ? $componentupdatetype : $thiscomponent;
            foreach ($componentids as $linkedcomponentid) {
                $relation->itemid1 = $thiscomponentfirst ? $thiscomponentid : $linkedcomponentid;
                $relation->itemid2 = $thiscomponentfirst ? $linkedcomponentid : $thiscomponentid;
                insert_record('dp_plan_component_relation', $relation);
            }
        }
    }


    /**
     * Count instances of $componentrequired linked to items of this component type
     *
     * @todo refactor to reuse {@link get_relation_array()}
     *
     * @param string $componentrequired Get linked items of this type
     * @return array Array of matches
     */
    function get_all_linked_components($componentrequired) {
        global $CFG;
        // name of the current component
        $thiscomponent = $this->component;

        // component relations are stored alphabetically
        // first component is in component1
        // Figure out which order to perform query
        switch (strcmp($thiscomponent, $componentrequired)) {
        case -1:
            $matchedcomp = 'component1';
            $matchedid = 'itemid1';
            $searchedcomp = 'component2';
            $searchedid = 'itemid2';
            break;
        case 1:
            $matchedcomp = 'component2';
            $matchedid = 'itemid2';
            $searchedcomp = 'component1';
            $searchedid = 'itemid1';
            break;
        case 0:
        default:
            // linking within the same component not supported
            return false;
        }

        // @todo doesn't current exclude unapproved items
        $sql = "SELECT $matchedid " . sql_as() . " id,
                COUNT($searchedid) " . sql_as() . " items
            FROM {$CFG->prefix}dp_plan_component_relation
            WHERE $matchedcomp = '$thiscomponent' AND
                  $searchedcomp = '$componentrequired'
            GROUP BY $matchedid";

        $results = get_records_sql($sql);
        $return = array();
        foreach($results as $result) {
            $return[$results->id] = $results->items;
        }

        return $return;
    }


    /**
     * Update assigned items
     *
     * @access  public
     * @param   $items  array   Array of item ids
     * @return  void
     */
    public function update_assigned_items($items) {
        $item_id_name = $this->component . 'id';

        // Get currently assigned items
        $assigned = $this->get_assigned_items();
        $assigned_ids = array();
        foreach($assigned as $item) {
            $assigned_ids[$item->$item_id_name] = $item->$item_id_name;
        }
        $sendnotification = (count(array_diff($items, $assigned_ids)) || count(array_diff($assigned_ids, $items)))
            && $this->plan->status != DP_PLAN_STATUS_UNAPPROVED;
        $updates = '';

        if ($items) {
            foreach ($items as $itemid) {

                // Validate id
                if (!is_numeric($itemid)) {
                    error(get_string('baddata','local_plan'));
                }

                // Check if not already assigned
                if (!isset($assigned_ids[$itemid])) {
                    $newitem = $this->assign_new_item($itemid);
                    $updates .= get_string('addedx', 'local_plan', $newitem).'<br>';
                }

                // Remove from list to prevent deletion
                unset($assigned_ids[$itemid]);
            }
        }

        // Remaining items to be deleted
        foreach ($assigned as $item) {
            if(!isset($assigned_ids[$item->$item_id_name])) {
                continue;
            }
            $this->unassign_item($item);
            $updates .= get_string('removedx', 'local_plan', $assigned[$item->id]->fullname).'<br>';
        }

        if ($sendnotification) {
            $this->send_component_update_notification($updates);
        }
    }


    function send_component_update_notification($update_info='') {
        global $USER, $CFG;
        require_once($CFG->dirroot.'/local/totara_msg/messagelib.php');

        $event = new stdClass;
        $userfrom = get_record('user', 'id', $USER->id);
        $event->userfrom = $userfrom;
        $event->contexturl = $this->get_url();
        $event->icon = $this->component.'-update';
        $a = new stdClass;
        $a->plan = "<a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$this->plan->id}\" title=\"{$this->plan->name}\">{$this->plan->name}</a>";
        $a->component = get_string($this->component.'plural', 'local_plan');
        $a->updates = $update_info;

        // did they edit it themselves?
        if ($USER->id == $this->plan->userid) {
            // notify their manager
            if ($this->plan->is_active()) {
                if ($manager = totara_get_manager($this->plan->userid)) {
                    $event->userto = $manager;
                    $a->user = $this->current_user_link();
                    $event->subject = get_string('componentupdateshortmanager', 'local_plan', $a);
                    $event->fullmessage = get_string('componentupdatelongmanager', 'local_plan', $a);
                    $event->roleid = get_field('role','id', 'shortname', 'manager');
                    tm_notification_send($event);
                }
            }
        } else {
            // notify user that someone else did it
            $userto = get_record('user', 'id', $this->plan->userid);
            $event->userto = $userto;
            $event->subject = get_string('componentupdateshortlearner', 'local_plan', $a->component);
            $event->fullmessage = get_string('componentupdatelonglearner', 'local_plan', $a);
            tm_notification_send($event);
        }
    }


    /**
     * Unassign an item from a plan
     *
     * @access  public
     * @return  boolean
     */
    public function unassign_item($item) {

        // Get approval value for new item
        if (!$permission = $this->can_update_items()) {
            print_error('error:cannotupdateitems', 'local_plan');
        }

        // If allowed, or assignment not yet approved, remove assignment
        if ($permission >= DP_PERMISSION_ALLOW || $item->approved == DP_APPROVAL_UNAPPROVED) {
            return delete_records(
                'dp_plan_'.$this->component.'_assign',
                'id', $item->id,
                'planid', $this->plan->id
            );
        }

        return false;
    }


    /**
     * Return default priority for this component, or null if nothing set
     *
     * @access  public
     * @return  int
     */
    public function get_default_priority() {
        if (!$comp = $this->plan->get_component($this->component)) {
            return null;
        }
        if ($comp->get_setting('prioritymode') != DP_PRIORITY_REQUIRED) {
            // Don't bother if priorities aren't required
            return null;
        }

        $scale = get_record('dp_priority_scale', 'id', $comp->get_setting('priorityscale'));

        return $scale ? $scale->defaultid : null;
    }


    /**
     * Make unassigned items requested
     *
     * @access  public
     * @param   array   $items  Unassigned items to update
     * @return  array
     */
    public function make_items_requested($items) {

        $table = $this->get_component_table_name();

        $updated = array();
        foreach ($items as $item) {
            // Attempt to load item
            $record = get_record($table, 'id', $item->id);
            if (!$record) {
                continue;
            }

            // Attempt to update record
            $record->approved = DP_APPROVAL_REQUESTED;
            $record = addslashes_recursive($record);
            if (!update_record($table, $record)) {
                continue;
            }

            // Save in updated list
            $updated[] = $item;
        }

        return $updated;
    }


    /**
     * Checks to see if an approval value is
     * approved or greater
     *
     * @access  public
     * @param   integer $value  Approval constant e.g. DP_APPROVAL_*
     * @return  boolean
     */
    public function is_item_approved($value) {
        return $value >= DP_APPROVAL_APPROVED;
    }


    /**
     * Check if item is "complete" or "finished"
     *
     * @access  public
     * @param   object  $item
     * @return  boolean
     */
    abstract protected function is_item_complete($item);


    /**
     * Returns true if the item is assigned to the current plan
     *
     * Only for use with assigned components (courses, competencies), not objectives. Assumes
     * a table 'dp_plan_[component]_assign' with a field of '[component]id'
     *
     * @param integer $itemid ID of the item being assigned (item id not assignment id)
     *
     * @return boolean true if is assigned
     */
    public function is_item_assigned($itemid) {
        $component = $this->component;
        $table = "dp_plan_{$component}_assign";
        $itemname = "{$component}id";
        return record_exists($table, 'planid', $this->plan->id, $itemname, $itemid);
    }


    /**
     * Check's if the logged in user can delete an item
     *
     * @access  public
     * @param   object  $item
     * @return  boolean
     */
    public function can_delete_item($item) {
        // Load permissions
        $canupdateitems = $this->can_update_items();

        // If user has full permissions (allow/approve)
        if ($canupdateitems >= DP_PERMISSION_ALLOW) {
            return true;
        }

        // Or if can't request items
        if ($canupdateitems != DP_PERMISSION_REQUEST) {
            return false;
        }

        // If can request, and item is not yet approved
        return in_array($item->approved, array(DP_APPROVAL_UNAPPROVED, DP_APPROVAL_DECLINED));
    }


    /**
     * Return the name of the component items table
     *
     * Override in subclass if component uses a different pattern
     *
     * @return string Name of the table containing item assignments
     */
    public function get_component_table_name() {
        return "dp_plan_{$this->component}_assign";
    }


    /**
     * Get priority values
     *
     * @access  public
     * @return  array
     */
    public function get_priority_values() {
        static $values;
        if (!isset($values[$this->component])) {
            $priorityscaleid = $this->get_setting('priorityscale') ? $this->get_setting('priorityscale') : -1;
            $v = get_records('dp_priority_scale_value', 'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

            if (!$v) {
                $v = array();
            }

            $values[$this->component] = $v;
        }

        return $values[$this->component];
    }


    /*********************************************************************************************
     *
     * Display methods
     *
     ********************************************************************************************/

    protected function display_list_item_name($item) {
        return $this->display_item_name($item);
    }


    protected function display_list_item_priority($item) {
        return $this->display_priority($item);
    }


    protected function display_list_item_duedate($item) {
        return $this->display_duedate($item->id, $item->duedate);
    }


    protected function display_list_item_status($item) {
        // If item already approved but not completed
        $approved = $this->is_item_approved($item->approved);
        $completed = $this->is_item_complete($item);
        $canapproveitems = $this->can_update_items() == DP_PERMISSION_APPROVE;

        if ($approved && !$completed) {
            return $this->display_duedate_highlight_info($item->duedate);
        } elseif (!$approved) {
            return $this->display_approval($item, $canapproveitems);
        }

        return '';
    }

    protected function display_list_item_linkedcourses($item) {
            return '<div class="centertext">' .
                $item->linkedcourses . '</div>';
    }

    abstract protected function display_list_item_progress($item);
    abstract protected function display_list_item_actions($item);


    /**
     * Display item's name
     *
     * @access  public
     * @param   object  $item
     * @return  string
     */
    abstract public function display_item_name($item);


    /**
     * Return markup for javascript assignment picker
     *
     * @access  public
     * @return  string
     */
    public function display_picker() {

        if (!$permission = $this->can_update_items()) {
            return '';
        }

        // Check for allow/approve permissions
        $canupdate = ($permission >= DP_PERMISSION_ALLOW ? 'true' : 'false');

        $html  = '<div class="buttons plan-add-item-button-wrapper">';
        $html .= '<div class="singlebutton dp-plan-assign-button">';
        $html .= '<div>';
        $html .= '<script type="text/javascript">';
        $html .= "var plan_id = {$this->plan->id};";
        $html .= "var comp_update_allowed = {$canupdate};";
        $html .= '</script>';
        $html .= '<input type="submit" class="plan-add-item-button" id="show-'.$this->component.'-dialog" value="'.get_string('addremove'.$this->component, 'local_plan').'" />';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }


    function display_duedate($itemid, $duedate) {
        $plancompleted = $this->plan->status == DP_PLAN_STATUS_COMPLETE;
        $cansetduedate = !$plancompleted && ($this->get_setting('setduedate') == DP_PERMISSION_ALLOW);

        $out = '';

        // only show a form if they have permission to change due dates
        if($cansetduedate) {
            $out .= $this->display_duedate_as_form($duedate, "duedate_{$this->component}[{$itemid}]");
        } else {
            $out .= $this->display_duedate_as_text($duedate);
        }

        return $out;

    }

    function display_duedate_as_form($duedate, $name) {
        global $CFG;
        $duedatestr = !empty($duedate) ?
            userdate($duedate, '%d/%m/%y', $CFG->timezone, false) : '';
        return '<input id="'.$name.'" type="text" name="'.$name.'" value="'. $duedatestr . '" size="8" maxlength="20"/>';
    }

    function display_duedate_as_text($duedate) {
        global $CFG;
        if (!empty($duedate)) {
            return userdate($duedate, '%e %h %Y', $CFG->timezone, false);
        } else {
            return '';
        }
    }

    function display_duedate_highlight_info($duedate) {
        $out = '';
        $now = time();
        if (!empty($duedate)) {
            if(($duedate < $now) && ($now - $duedate < 60*60*24)) {
                $out .= '<span class="plan_highlight">' . get_string('duetoday', 'local_plan') . '</span>';
            } else if($duedate < $now) {
                $out .= '<span class="plan_highlight">' . get_string('overdue', 'local_plan') . '</span>';
            } else if ($duedate - $now < 60*60*24*7) {
                $days = ceil(($duedate - $now)/(60*60*24));
                $out .= '<span class="plan_highlight">' . get_string('dueinxdays', 'local_plan', $days) . '</span>';
            }
        }
        return $out;
    }

    /**
     * Display priority as text or picker depending on permissions
     *
     * @access  public
     * @param   object  $item
     * @return  string
     */
    public function display_priority($item) {
        // Load priority values
        $priorityvalues = $this->get_priority_values();

        // Load permissions
        $plancompleted = $this->plan->is_complete();

        $cansetpriority = !$plancompleted && ($this->get_setting('setpriority') == DP_PERMISSION_ALLOW);
        $priorityenabled = $this->get_setting('prioritymode') != DP_PRIORITY_NONE;
        $priorityrequired = ($this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $prioritydefaultid = $this->get_default_priority();
        $out = '';

        if (!$priorityenabled) {
            return $out;
        }

        if (!empty($item->priority)) {
            $priorityname = $priorityvalues[$item->priority]->name;
        } else {
            $priorityname = '';
        }

        if ($cansetpriority) {
            // show a pulldown menu of priority options
            $out .= $this->display_priority_picker("priorities_{$this->component}[{$item->id}]", $item->priority, $priorityvalues, $prioritydefaultid, $priorityrequired);
        } else {
            // just display priority if no permissions to set it
            $out .= $this->display_priority_as_text($item->priority, $priorityname, $priorityvalues);
        }

        return $out;
    }


    function display_priority_picker($name, $priorityid, $priorityvalues, $prioritydefaultid, $priorityrequired=false) {

        if (!$priorityvalues) {
            return '';
        }

        $options = array();

        foreach($priorityvalues as $id => $val) {
            $options[$id] = $val->name;

            if($id == $prioritydefaultid) {
                $defaultchooseval = $id;
                $defaultchoose = $val->name;
            }
        }

        $choose = ($priorityrequired) ? $defaultchoose : get_string('none','local_plan');
        $chooseval = ($priorityrequired) ? $defaultchooseval : 0;


        return choose_from_menu($options, $name, $priorityid, $choose, '', $chooseval, true);

    }

    function display_priority_as_text($priorityid, $priorityname, $priorityvalues) {

        // class (for styling priorities) is of the format:
        // priorityXofY
        // theme only defines styles up to DP_MAX_PRIORITY_OPTIONS so limit
        // the highest values set to this range
        if ( $priorityid ){
            $class = 'priority' .
                min($priorityvalues[$priorityid]->sortorder, DP_MAX_PRIORITY_OPTIONS) .
                'of' .
                min(count($priorityvalues), DP_MAX_PRIORITY_OPTIONS);

            return '<span class="'.$class.'">'.$priorityname.'</span>';
        } else {
            return ' ';
        }
    }

    function display_back_to_index_link() {
        global $CFG;
        return '<p><a href="' . $CFG->wwwroot . '/local/plan/component.php?id='.$this->plan->id.
            '&c='.$this->component.'">'.
            get_string('backtoallx','local_plan', get_string("{$this->component}plural", 'local_plan')).
            '</a></p>';
    }

    /**
     * Display approval functionality for a component assignment
     *
     * @param $obj stdClass the assignment object
     * @param $canapprove boolean if approve/decline actions are allowed
     * @return $out string an html string
     */
    function display_approval($obj, $canapprove) {
        global $CFG;

        // Get data
        $id = $obj->id;
        $approvalstatus = $obj->approved;
        $murl = new moodle_url(qualified_me());
        $out = '';

        // If reviewing pending page, just returning picker
        if ($this->plan->reviewing_pending) {
            return $this->display_approval_options($obj, $approvalstatus);
        }

        switch($approvalstatus) {
        case DP_APPROVAL_DECLINED:
            $out .= '<span class="plan_highlight">' . get_string('declined', 'local_plan') . '</span>';
            break;
        case DP_APPROVAL_UNAPPROVED:
            $out .= '<img src="'.$CFG->pixpath.'/i/learning_plan_alert.gif" /> ';
            $out .= get_string('unapproved', 'local_plan');
            if ($canapprove) {
                $out .= ' '.$this->display_approval_options($obj, $approvalstatus);
            }
            break;
        case DP_APPROVAL_REQUESTED:
            $out .= '<span class="plan_highlight">' . get_string('pendingapproval', 'local_plan') . '</span><br />';
            if ($canapprove) {
                $out .= ' '.$this->display_approval_options($obj, $approvalstatus);
            }
            break;
        case DP_APPROVAL_APPROVED:
            $out .= get_string('approved', 'local_plan');
        }

        return $out;
    }

    /**
     * Display approval options for most components
     *
     * This method is overridded by competency subclass to show links instead
     *
     * @param stdClass $obj, The assignment object
     * @param integer $approvalstatus The currently selected approval status
     *
     * @return string The html for an approval picker
     */
    function display_approval_options($obj, $approvalstatus) {
        $name = "approve_{$this->component}[{$obj->id}]";
        return dp_display_approval_options($name, $approvalstatus);
    }

    /**
     * Construct the link for the current user
     * @return string user link
     */
    function current_user_link() {
        global $USER, $CFG;

        $userfrom_link = $CFG->wwwroot.'/user/view.php?id='.$USER->id;
        $fromname = fullname($USER);
        return "<a href=\"{$userfrom_link}\" title=\"$fromname\">$fromname</a>";
    }

}
