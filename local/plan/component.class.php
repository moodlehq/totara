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
     * Get items assigned to this component (if relevant - to be overridden by children classes)
     *
     * Optionally, filtered by status
     *
     * @access  public
     * @param   mixed   $approved   (optional)
     * @return  array
     */
    function get_assigned_items($approved = null) {
        return array();
    }


    function process_action($action) {
        // General component actions can come in here
        // Override this method in children for more specific actions
    }


    /**
     * Get all instances of $componentrequired linked to the specified item
     *
     * @todo doesn't current exclude unapproved items
     * that is currently handled inside display_linked_*() methods
     * but might be better to do it here?
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

        // Get currently assigned items
        $assigned = $this->get_assigned_items();
        $assigned_ids = array_keys($assigned);
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
                if (!isset($assigned[$itemid])) {
                    $newitem = $this->assign_new_item($itemid);
                    $updates .= get_string('addedx', 'local_plan', $newitem).'<br>';
                }

                // Remove from list to prevent deletion
                unset($assigned[$itemid]);
            }
        }

        // Remaining items to be deleted
        foreach ($assigned as $item) {
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

        // @todo implement $update_info to provide notifications with more details re component update

        $event = new stdClass;
        $userfrom = get_record('user', 'id', $USER->id);
        $event->userfrom = $userfrom;
        $event->contexturl = "{$CFG->wwwroot}/local/plan/components/{$this->component}/index.php?id={$this->plan->id}";
        $event->icon = $this->component.'-update.png';
        $a = new stdClass;
        $a->plan = "<a href=\"{$CFG->wwwroot}/local/plan/view.php?id={$this->plan->id}\" title=\"{$this->plan->name}\">{$this->plan->name}</a>";
        $a->component = $this->get_setting('name');
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
                'id', $item->itemid,
                'planid', $this->plan->id
            );
        }
        // Otherwise request removal
        else {
            $update = new object();
            $update->id = $item->itemid;
            $update->approved = DP_APPROVAL_REQUEST_REMOVAL;
            return update_record('dp_plan_'.$this->component.'_assign', $update);
        }
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

        $table = "dp_plan_{$this->component}_assign";

        $updated = array();
        foreach ($items as $item) {
            // Attempt to load item
            $record = get_record($table, 'id', $item->itemid);
            if (!$record) {
                continue;
            }

            // Attempt to update record
            $record->approved = DP_APPROVAL_REQUESTED;
            if (!update_record($table, $record)) {
                continue;
            }

            // Save in updated list
            $updated[] = $item;
        }

        return $updated;
    }


    /*********************************************************************************************
     *
     * Display methods
     *
     ********************************************************************************************/

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

    function display_priority($ca, $priorityscaleid) {
        $priorityvalues = get_records('dp_priority_scale_value',
            'priorityscaleid', $priorityscaleid, 'sortorder', 'id,name,sortorder');

        $plancompleted = ($this->plan->status == DP_PLAN_STATUS_COMPLETE);
        $cansetpriority = !$plancompleted && ($this->get_setting('setpriority') == DP_PERMISSION_ALLOW);
        $priorityenabled = $this->get_setting('prioritymode') != DP_PRIORITY_NONE;
        $priorityrequired = ($this->get_setting('prioritymode') == DP_PRIORITY_REQUIRED);
        $prioritydefaultid = (int)get_field('dp_priority_scale', 'defaultid', 'id', $priorityscaleid);
        $out = '';

        if(!$priorityenabled) {
            return $out;
        }

        if ($cansetpriority) {
            // show a pulldown menu of priority options
            $out .= $this->display_priority_picker("priorities_{$this->component}[{$ca->id}]", $ca->priority, $priorityvalues, $prioritydefaultid, $priorityrequired);
        } else {
            // just display priority if no permissions to set it
            $out .= $this->display_priority_as_text($ca->priority, $ca->priorityname, $priorityvalues);
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
        return '<p><a href="' . $CFG->wwwroot . '/local/plan/components/' .
            $this->component . '/index.php?id=' . $this->plan->id . '">' .
            get_string('backtoallx','local_plan', $this->get_setting('name')) .
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
            $out .= '<img src="'.$CFG->pixpath.'/i/risk_xss.gif" /> ';
            $out .= get_string('unapproved', 'local_plan');
            if ($canapprove) {
                $out .= ' '.$this->display_approval_options($obj, $approvalstatus);
            }
            break;
        case DP_APPROVAL_REQUESTED:
            // @todo create new icon instead of reusing XSS one
            $out .= '<img src="'.$CFG->pixpath.'/i/risk_xss.gif" /> ';
            $out .= '<span class="plan_highlight">' . get_string('pendingapproval', 'local_plan') . '</span><br />';
            if ($canapprove) {
                $out .= ' '.$this->display_approval_options($obj, $approvalstatus);
            }
            break;
        case DP_APPROVAL_REQUEST_REMOVAL:
            // @todo create new icon instead of reusing XSS one
            $out .= '<img src="'.$CFG->pixpath.'/i/risk_xss.gif" /> ';
            $out .= '<span class="plan_highlight">' . get_string('pendingremoval', 'local_plan') . '</span><br />';
            if ($canapprove) {
                $out .= 'show delete button';
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
        return "<a href=\"{$userfrom_link}\" title=\"$fromname\">$fromname</a> ";
    }

}
