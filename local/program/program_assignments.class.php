<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
*/

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

define('ASSIGNTYPE_ORGANISATION', 1);
define('ASSIGNTYPE_POSITION', 2);
define('ASSIGNTYPE_COHORT', 3);
define('ASSIGNTYPE_MANAGER', 4);
define('ASSIGNTYPE_INDIVIDUAL', 5);

global $ASSIGNMENT_CATEGORY_CLASSNAMES;

$ASSIGNMENT_CATEGORY_CLASSNAMES = array(
    ASSIGNTYPE_ORGANISATION => 'organisations_category',
    ASSIGNTYPE_POSITION     => 'positions_category',
    ASSIGNTYPE_COHORT       => 'cohorts_category',
    ASSIGNTYPE_MANAGER      => 'managers_category',
    ASSIGNTYPE_INDIVIDUAL   => 'individuals_category'
);

define('COMPLETION_EVENT_NONE',0);
define('COMPLETION_EVENT_FIRST_LOGIN',1);
define('COMPLETION_EVENT_POSITION_START_DATE',2);
define('COMPLETION_EVENT_PROGRAM_COMPLETION',3);
define('COMPLETION_EVENT_COURSE_COMPLETION',4);
define('COMPLETION_EVENT_PROFILE_FIELD_DATE',5);

global $COMPLETION_EVENTS_CLASSNAMES;

$COMPLETION_EVENTS_CLASSNAMES = array(
    COMPLETION_EVENT_FIRST_LOGIN            => 'prog_assigment_completion_first_login',
    COMPLETION_EVENT_POSITION_START_DATE    => 'prog_assigment_completion_position_start_date',
    COMPLETION_EVENT_PROGRAM_COMPLETION     => 'prog_assigment_completion_program_completion',
    COMPLETION_EVENT_COURSE_COMPLETION      => 'prog_assigment_completion_course_completion',
    COMPLETION_EVENT_PROFILE_FIELD_DATE     => 'prog_assigment_completion_profile_field_date',
);

/**
 * Class representing the program assignments
 */
class prog_assignments {

    protected $assignments;

    function __construct($programid) {
        $this->programid = $programid;
        $this->init_assignments($programid);
    }

    /**
     * Resets the assignments property so that it contains only the assignments
     * that are currently stored in the database. This is necessary after
     * assignments are updated
     *
     * @param int $programid
     */
    public function init_assignments($programid) {
        $this->assignments = array();
        if($assignments = get_records('prog_assignment', 'programid', $programid)) {
            $this->assignments = $assignments;
        }
    }

    public function get_assignments() {
        return $this->assignments;
    }

    public static function factory($assignmenttype) {
        global $ASSIGNMENT_CATEGORY_CLASSNAMES;

        if( ! array_key_exists($assignmenttype, $ASSIGNMENT_CATEGORY_CLASSNAMES)) {
            throw new Exception('Assignment category type not found');
        }

        if (class_exists($ASSIGNMENT_CATEGORY_CLASSNAMES[$assignmenttype])) {
            $classname = $ASSIGNMENT_CATEGORY_CLASSNAMES[$assignmenttype];
            return new $classname();
        } else {
            throw new Exception('Assignment category class not found');
        }
    }

    /**
     * Deletes all the assignments and user assignments for this program
     *
     * @return bool Success
     */
    public function delete() {

        begin_sql();

        // delete all user assignments
        $result = delete_records('prog_user_assignment', 'programid', $this->programid);

        // delete all configured assignments
        if ($result) {
            $result = $result && delete_records('prog_assignment', 'programid', $this->programid);
        }

        if ($result) {
            commit_sql();
        } else {
            rollback_sql();
        }

        return $result;
    }

    /**
     * Returns the number of assignments found for the current program
     *
     * @return array of object
     */
    public function count_user_assignments() {
        return count_records('prog_user_assignment', 'programid', $this->programid);
    }

    /**
     * Returns an HTML string suitable for displaying as the label for the
     * assignments in the program overview form
     *
     * @return string
     */
    public function display_form_label() {
        $out = '';
        $out .= get_string('instructions:assignments1', 'local_program');
        return $out;
    }

    /**
     * Returns an HTML string suitable for displaying as the element body
     * for the assignments in the program overview form
     *
     * @return string
     */
    public function display_form_element() {
        global $ASSIGNMENT_CATEGORY_CLASSNAMES;

        $emptyarray = array(
            'typecount' => 0,
            'users'     => 0
        );

        $assignmentdata = array(
            ASSIGNTYPE_ORGANISATION => $emptyarray,
            ASSIGNTYPE_POSITION => $emptyarray,
            ASSIGNTYPE_COHORT => $emptyarray,
            ASSIGNTYPE_MANAGER => $emptyarray,
            ASSIGNTYPE_INDIVIDUAL => $emptyarray,
        );

        $out = '';

        if(count($this->assignments)) {

            $usertotal = 0;

            foreach($this->assignments as $assignment) {
                $assignmentob = prog_assignments::factory($assignment->assignmenttype);

                $assignmentdata[$assignment->assignmenttype]['typecount']++;

                $users = $assignmentob->get_affected_users_by_assignment($assignment);
                $usercount = count($users);
                if($users) {
                    $assignmentdata[$assignment->assignmenttype]['users'] += $usercount;
                }
                $usertotal += $usercount;
            }

            $table = new stdClass();
            $table->head = array(
                get_string('overview', 'local_program'),
                get_string('numlearners', 'local_program')
            );
            $table->data = array();

            $categoryrow = 0;
            foreach($assignmentdata as $categorytype => $data) {
                $categoryclassname = $ASSIGNMENT_CATEGORY_CLASSNAMES[$categorytype];

                $styleclass = ($categoryrow % 2 == 0) ? 'even' : 'odd';

                $row = array();
                $row[] = $data['typecount'].' '.get_string($categoryclassname, 'local_program');
                $row[] = $data['users'];

                $table->data[] = $row;
                $table->rowclass[] = $styleclass;

                $categoryrow++;
            }
            $helpbutton = helpbutton('totalassignments', get_string('totalassignments', 'local_program'), 'local_program', true, false, '', true);
            $table->data[] = array(
                '<strong>'.get_string('totalassignments', 'local_program').' '.$helpbutton.'</strong>',
                '<strong>'.$usertotal.'</strong>',
            );
            $table->rowclass[] = 'total';

            $out .= print_table($table, true);

        } else {
            $out .= get_string('noprogramassignments', 'local_program');
        }

        return $out;
    }

    /**
     * Returns html for the dropdown of different completion events
     *
     * @global array $COMPLETION_EVENTS_CLASSNAMES
     * @param string $name
     * @return string
     */
    public static function get_completion_events_dropdown($name="eventtype") {
        global $COMPLETION_EVENTS_CLASSNAMES;

        // The javascript part of this element was initially factored out
        // and added using jQuery when the page was loaded but this didn't work
        // in IE8 so it was added in here instead.
        $out = '<select class="'.$name.'" id="'.$name.'" name="'.$name.'" onchange="handle_completion_selection(this.options[this.selectedIndex].value);">';
        foreach ($COMPLETION_EVENTS_CLASSNAMES as $class) {
            $event = new $class();
            $out .= '<option value="'. $event->get_id() .'">'. $event->get_name() .'</option>';
        }
        $out .= '</select>';

        $out .= '<script type="text/javascript">';
        $out .= prog_assignments::get_completion_events_script($name);
        $out .= '</script>';

        return $out;
    }

    /**
     * Returns the script to be run when a specific completion event is chosen
     *
     * @global array $COMPLETION_EVENTS_CLASSNAMES
     * @param string $name
     * @return string
     */
    public static function get_completion_events_script($name="eventtype") {
        global $COMPLETION_EVENTS_CLASSNAMES;

        $out = '';

        $out .= "
            function handle_completion_selection(eventId) {
        ";

        // Get the script that should be run if we select a specific event
        foreach ($COMPLETION_EVENTS_CLASSNAMES as $class) {
            $event = new $class();
            $out .= "if (eventId == ". $event->get_id() .") { " . $event->get_script() . " }";
        }

        $out .= "
            };
        ";

        return $out;
    }

    public static function get_confirmation_template() {

        $table = new stdClass();
        $table->head = array('','added','removed');
        $table->data = array();
        global $ASSIGNMENT_CATEGORY_CLASSNAMES;
        foreach ($ASSIGNMENT_CATEGORY_CLASSNAMES as $classname) {
            $category = new $classname();
            $spanAdded = '<span class="added_'.$category->id.'">0</span>';
            $spanRemoved = '<span class="removed_'.$category->id.'">0</span>';
            $table->data[] = array($category->name,$spanAdded,$spanRemoved);
        }

        $spanTotalAdded = '<strong><span class="total_added">0</span></strong>';
        $spanTotalRemoved = '<strong><span class="total_removed">0</span></strong>';
        $table->data[] = array('<strong>'.get_string('total').'</strong>',$spanTotalAdded,$spanTotalRemoved);

        $tableHTML = print_table($table, true);
        // Strip new lines as they screw up the JS
        $order   = array("\r\n", "\n", "\r");
        $table = str_replace($order, '', $tableHTML);

        $data = array();
        $data['html'] = '<div>' . get_string('youhavemadefollowingchanges','local_program') . '<br /><br />' . $tableHTML . '<br />' . get_string('tosaveassignments','local_program') . '</div>';

        return json_encode($data);
    }
}

/**
 * Abstract class for a cateogry which appears on the program assignments screen.
 */
abstract class prog_assignment_category {
    public $id;
    public $name = '';
    public $table = '';
    protected $buttonname = '';
    protected $headers = array(); // array of headers as strings?
    protected $data = array(); // array of arrays of strings (html)

    /**
     * Prints out the actualy html for the category, by looking at the headers
     * and data which should have been set by sub class
     *
     * @param bool $return
     * @return string html
     */
    function display($return = false) {

        $categoryclassstr = strtolower(str_replace(' ', '', $this->name));

        $html = '<fieldset class="assignment_category '.$categoryclassstr.'" id="category-'. $this->id.'" >';
        $html .= '<legend>'. $this->name .'</legend>';

        $html .= '<table>';
        $html .= '<tbody>';

        $html .= '<tr>';
        $colcount = 0;

        // Add the headers
        foreach ($this->headers as $header) {
            $headerclassstr = strtolower(str_replace(' ', '', $header));
            $headerclassstr = strtolower(str_replace('#', '', $headerclassstr));
            $html .= '<th class="'.$headerclassstr.' col'.$colcount.'">'.$header.'</th>';
            $colcount++;
        }
        $html .= '</tr>';

        // And the main data
        if ( ! empty($this->data)) {
            foreach ($this->data as $row) {
                $html .= '<tr>';
                $colcount = 0;
                foreach ($row as $cell) {
                    $html .= '<td class="col'.$colcount.'">'.$cell.'</td>';
                    $colcount++;
                }
                $html .= '</tr>';
            }
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Add a button for adding new items to the category
        $html .= '<button id="add-assignment-' . $this->id . '" >'. $this->buttonname .'</button>';
        $html .= '<div class="total_user_count">'. get_string('total','local_program') .': <span class="user_count">0</span></div>';
        $html .= '</fieldset>';

        if ($return) {
            return $html;
        }
        echo $html;
    }

    /**
     * Checks whether this category has any items by looking
     * @return int
     */
    function has_items() {
        return count($this->data);
    }

    /**
     * Builds the table that appears for this category by filling $this->headers
     * and $this->data
     *
     * @param string $prefix
     * @param int $programid
     */
    abstract function build_table($prefix, $programid);

    /**
     * Builds a single row by looking at the passed in item
     *
     * @param object $item
     */
    abstract function build_row($item);

    /**
     * Returns any javascript that should be loaded to be used by the category
     *
     * @access  public
     * @param   int     $programid
     */
    abstract function get_js($programid);

    /**
     * Gets the number of affected users
     */
    abstract function user_affected_count($item);

    /**
     * Gets the affected users for the given item record
     *
     * @param object $item An object containing data about the assignment
     */
    abstract function get_affected_users($item);

    /**
     * Retrives an array of all the users affected by an assignment based on the
     * assignment record
     *
     * @param object $assignment The db record from 'prog_assignment' for this assignment
     */
    abstract function get_affected_users_by_assignment($assignment);

    /**
     * Updates the assignments by looking at the post data
     */
    function update_assignments($data) {
        global $CFG;

        // Store list of seen ids
        $seenids = array();

        // If theres inputs for this category
        if (isset($data->item[$this->id])) {

            // Get the list of item ids
            $itemids = array_keys($data->item[$this->id]);
            $seenids = $itemids;

            $inserts = array();

            // Get a list of assignments
            $sql = "SELECT p.assignmenttypeid as hashkey, p.* FROM {$CFG->prefix}prog_assignment p WHERE programid = $data->id AND assignmenttype = $this->id";
            $assignment_hashmap = get_records_sql($sql);

            foreach ($itemids as $itemid) {
                $object = isset($assignment_hashmap[$itemid]) ? $assignment_hashmap[$itemid] : false;
                if ($object !== false) {
                    $original_object = clone $object;
                }

                if (!$object) {
                    $object = new stdClass(); //same for all cats
                    $object->programid = $data->id; //same for all cats
                    $object->assignmenttype = $this->id;
                    $object->assignmenttypeid = $itemid;
                }

                // Let the inheriting object deal with the include children field as it's specific to them
                $object->includechildren = $this->get_includechildren($data, $object);

                // Get the completion time
                $object->completiontime = $data->completiontime[$this->id][$itemid];

                if (empty($object->completiontime)) {
                    // No completion time set.. :/ Skip for now
                    continue;
                }

                $object->completionevent = $data->completionevent[$this->id][$itemid];

                $object->completioninstance = $data->completioninstance[$this->id][$itemid];
                if (empty($object->completioninstance)) {
                    $object->completioninstance = 0;
                }

                if ($object->completionevent == COMPLETION_EVENT_NONE) {
                    $datepattern = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{4})$/';
                    if (preg_match($datepattern, $object->completiontime, $matches) == 0) {
                        continue;
                    }

                    list($day, $month, $year) = explode('/', $object->completiontime);
                    $object->completiontime = $month.'/'.$day.'/'.$year;
                    $object->completiontime = strtotime($object->completiontime);
                }
                else {
                    $parts = explode(' ',$object->completiontime);
                    if (!isset($parts[0]) || !isset($parts[1])) {
                        continue;
                    }
                    $num = $parts[0];
                    $period = $parts[1];
                    $object->completiontime = program_utilities::duration_implode($num, $period);
                }

                if (isset($object->id)) {
                    // Check if we actually need an update..
                    if ($original_object->includechildren != $object->includechildren ||
                        $original_object->completiontime != $object->completiontime ||
                        $original_object->completionevent != $object->completionevent) {

                        update_record('prog_assignment', $object);
                    }
                }
                else {
                    $inserts[] = "($object->programid, $object->assignmenttype, $object->assignmenttypeid, $object->includechildren, $object->completiontime, $object->completionevent, $object->completioninstance)";
                }
            }

            // Execute inserts
            if (count($inserts) > 0) {
                $sql = "INSERT INTO {$CFG->prefix}prog_assignment (programid, assignmenttype, assignmenttypeid, includechildren, completiontime, completionevent, completioninstance) VALUES " . implode(', ', $inserts);

                execute_sql($sql, false);
            }
        }

        // Delete any records which exist in the prog_assignment table but that
        // weren't submitted just now. Also delete any existing exceptions that
        // related to the assignment being deleted
        $where = "programid = $data->id AND assignmenttype = $this->id";
        if (count($seenids) > 0) {
            $where .= " AND assignmenttypeid NOT IN (". implode(',', $seenids) .")";
        }
        if ($assignments_to_delete = get_records_select('prog_assignment', $where)) {
            foreach($assignments_to_delete as $assignment_to_delete) {
                prog_exceptions_manager::delete_exceptions_by_assignment($assignment_to_delete->id);
            }
            delete_records_select('prog_assignment', $where);
        }
    }

    /**
     * Gets the include children part from the post data
     * @param <type> $data
     * @param <type> $object
     */
    abstract function get_includechildren($data, $object);

    function get_completion($item) {

        $completion_string = get_string('setcompletion', 'local_program');

        if (!isset($item->completiontime)) {
            $item->completiontime = '';
        }

        if (!isset($item->completionevent)) {
            $item->completionevent = 0;
        }

        if (!isset($item->completioninstance)) {
            $item->completioninstance = 0;
        }

        if ($item->completiontime != '') {
            if ($item->completionevent == COMPLETION_EVENT_NONE) {
                // Completiontime must be a timestamp

                // Print a date
                $item->completiontime = trim(userdate($item->completiontime,'%d/%m/%Y'));
                $completion_string = self::build_completion_string($item->completiontime, $item->completionevent, $item->completioninstance);
            }
            else {
                $parts = program_utilities::duration_explode($item->completiontime);
                $item->completiontime = $parts->num . ' ' . $parts->period;
                $completion_string = self::build_completion_string($item->completiontime, $item->completionevent, $item->completioninstance);
            }
        }

        $html = '<input type="hidden" name="completiontime['.$this->id.']['.$item->id.']" value="'. $item->completiontime .'" />';
        $html .= '<input type="hidden" name="completionevent['.$this->id.']['.$item->id.']" value="'. $item->completionevent .'" />';
        $html .= '<input type="hidden" name="completioninstance['.$this->id.']['.$item->id.']" value="'. $item->completioninstance .'" />';
        $html .= '<a href="#" class="completionlink">' . format_string($completion_string) . '</a>';

        return $html;
    }

    public static function build_completion_string($completiontime, $completionevent, $completioninstance) {
        global $COMPLETION_EVENTS_CLASSNAMES, $TIMEALLOWANCESTRINGS;

        if (isset($COMPLETION_EVENTS_CLASSNAMES[$completionevent])) {
            $eventobject = new $COMPLETION_EVENTS_CLASSNAMES[$completionevent];

            // $completiontime comes in the form '1 2' where 1 is the num and 2 is the period

            $parts = explode(' ',$completiontime);

            if (!isset($parts[0]) || !isset($parts[1])) {
                return '';
            }

            $a->num = $parts[0];
            if (isset($TIMEALLOWANCESTRINGS[$parts[1]])) {
                $a->period = $TIMEALLOWANCESTRINGS[$parts[1]];
            }
            else {
                return '';
            }
            $a->event = $eventobject->get_completion_string();
            $a->instance = $eventobject->get_item_name($completioninstance);

            if (!empty($a->instance)) {
                $a->instance = "'$a->instance'";
            }

            return get_string('completewithinevent','local_program',$a);
        }
        else {
            $datepattern = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{4})$/';
            if (preg_match($datepattern, $completiontime, $matches) == 0) {
                return '';
            }
            else {
                return get_string('completebytime','local_program',$completiontime);
            }
        }
    }

    static function get_categories() {
        $tempcategories = array(
            new organisations_category(),
            new positions_category(),
            new cohorts_category(),
            new managers_category(),
            new individuals_category(),
        );
        $categories = array();
        foreach ($tempcategories as $category) {
            $categories[$category->id] = $category;
        }
        return $categories;
    }
}

class organisations_category extends prog_assignment_category {


    function __construct() {
        $this->id = ASSIGNTYPE_ORGANISATION;
        $this->name = get_string('organisations','local_program');
        $this->buttonname = get_string('addorganisationtoprogram','local_program');
    }

    function build_table($prefix, $programid) {
        global $CFG;

        $this->headers = array(
            get_string('organisationname','local_program'),
            get_string('allbelow','local_program'),
            get_string('complete','local_program'),
            get_string('numlearners','local_program')
        );

        // Go to the database and gets the assignments
        $items = get_records_sql(
            "SELECT org.id, org.fullname, org.path, prog_assignment.includechildren, prog_assignment.completiontime, prog_assignment.completionevent, prog_assignment.completioninstance
	    FROM {$prefix}prog_assignment prog_assignment
	    INNER JOIN {$prefix}org org on org.id = prog_assignment.assignmenttypeid
	    WHERE prog_assignment.programid = $programid
	    AND prog_assignment.assignmenttype = $this->id");

        // Convert these into html
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->data[] = $this->build_row($item);
            }
        }
    }

    function get_item($itemid) {
        return get_record('org','id',$itemid);
    }

    function build_row($item) {
        global $CFG;

        if (is_int($item)) {
            $item = $this->get_item($item);
        }

        $checked = (isset($item->includechildren) && $item->includechildren == 1) ? 'checked="checked"' : '';

        $row = array();
        $row[] = '<div class="item">'.format_string($item->fullname).'<a href="#" class="deletelink">'.'<img src="'.$CFG->pixpath.'/t/delete.gif"'.' /></a></div><input type="hidden" name="item['.$this->id.']['.$item->id.']" value="1"/>';
        $row[] = '<input type="checkbox" name="includechildren['.$this->id.']['.$item->id.']" '. $checked .' />';
        $row[] = $this->get_completion($item);
        $row[] = $this->user_affected_count($item);

        return $row;
    }

    /**
     * Returns a count of all the users who are assigned to an organisation
     *
     * @global object $CFG
     * @param object $item The organisation record
     * @return int
     */
    function user_affected_count($item) {
        return $this->get_affected_users($item, true);
    }

    /**
     * Returns an array of records containing all the users who are assigned
     * to an organisation
     *
     * @global object $CFG
     * @param object $item The assignment record
     * @return array|false
     */
    function get_affected_users($item, $count=false) {
        global $CFG;

        $where = "pa.organisationid = $item->id";
        if (isset($item->includechildren) && $item->includechildren == 1 && isset($item->path)) {
            $children = get_records_select('org', "path LIKE '$item->path/%'", '', 'id');
            $children = $children == false ? array() : array_keys($children);
            $children[] = $item->id;
            $where = 'pa.organisationid IN ('. implode(',', $children) .')';
        }

        $select = $count ? 'COUNT(u.id)' : 'u.id';

        $sql = "SELECT $select
                FROM {$CFG->prefix}pos_assignment AS pa
                INNER JOIN {$CFG->prefix}user AS u ON pa.userid=u.id
                WHERE $where
                AND u.deleted=0";

        if ($count) {
            $num = count_records_sql($sql);
            return !$num ? 0 : $num;
        }
        else {
            return get_records_sql($sql);
        }
    }

    function get_affected_users_by_assignment($assignment) {
        global $CFG;

        // Query to retrieves the data required to determine the number of users
        //affected by an assignment
        $sql = "SELECT org.id,
                        org.fullname,
                        org.path,
                        prog_assignment.includechildren,
                        prog_assignment.completiontime,
                        prog_assignment.completionevent,
                        prog_assignment.completioninstance
                FROM {$CFG->prefix}prog_assignment prog_assignment
                INNER JOIN {$CFG->prefix}org org ON org.id = prog_assignment.assignmenttypeid
                WHERE prog_assignment.id = $assignment->id";

        if ($item = get_record_sql($sql)) {
            return $this->get_affected_users($item);
        } else {
            return false;
        }

    }

    function get_includechildren($data, $object) {
        if (!isset($data->includechildren)
            || !isset($data->includechildren[$this->id])
            || !isset($data->includechildren[$this->id][$object->assignmenttypeid])) {

            return 0;
        }
        return 1;
    }

    function get_js($programid) {
        global $CFG;

        return "
            (function() {
                var id = {$this->id};
                var programid = {$programid};
                var title = '". get_string('addorganisationtoprogram','local_program') ."';
                program_assignment.add_category(new category(id, 'organisations', 'find_hierarchy.php?type=organisation&table=org&programid='+programid, title));
            })();
        ";
    }
}

class positions_category extends prog_assignment_category {

    function __construct() {
        $this->id = ASSIGNTYPE_POSITION;
        $this->name = get_string('positions','local_program');
        $this->buttonname = get_string('addpositiontoprogram','local_program');
    }

    function build_table($prefix, $programid) {
        $this->headers = array(
            get_string('positionsname','local_program'),
            get_string('allbelow','local_program'),
            get_string('complete','local_program'),
            get_string('numlearners','local_program')
        );

        // Go to the database and gets the assignments
        $items = get_records_sql(
            "SELECT pos.id, pos.fullname, pos.path, prog_assignment.includechildren, prog_assignment.completiontime, prog_assignment.completionevent, prog_assignment.completioninstance
	    FROM {$prefix}prog_assignment prog_assignment
	    INNER JOIN {$prefix}pos pos on pos.id = prog_assignment.assignmenttypeid
	    WHERE prog_assignment.programid = $programid
	    AND prog_assignment.assignmenttype = $this->id");

        // Convert these into html
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->data[] = $this->build_row($item);
            }
        }
    }

    function get_item($itemid) {
        return get_record('pos','id',$itemid);
    }

    function build_row($item) {
        global $CFG;

        if (is_int($item)) {
            $item = $this->get_item($item);
        }

        $checked = (isset($item->includechildren) && $item->includechildren == 1) ? 'checked="checked"' : '';

        $row = array();
        $row[] = '<div class="item">'.format_string($item->fullname).'<a href="#" class="deletelink">'.'<img src="'.$CFG->pixpath.'/t/delete.gif"'.' /></a></div><input type="hidden" name="item['.$this->id.']['.$item->id.']" value="1"/>';
        $row[] = '<input type="checkbox" name="includechildren['.$this->id.']['.$item->id.']" '. $checked .' />';
        $row[] = $this->get_completion($item);
        $row[] = $this->user_affected_count($item);

        return $row;
    }

    /**
     * Returns a count of all the users who are assigned to a position
     *
     * @global object $CFG
     * @param object $item The organisation record
     * @return int
     */
    function user_affected_count($item) {
        return $this->get_affected_users($item, true);
    }

    /**
     * Returns an array of records containing all the users who are assigned
     * to a position
     *
     * @global object $CFG
     * @param object $assignment The assignment record
     * @return array|false
     */
    function get_affected_users($item, $count=false) {
        global $CFG;

        $where = "pa.positionid = $item->id";
        if (isset($item->includechildren) && $item->includechildren == 1 && isset($item->path)) {
            $children = get_records_select('pos', "path LIKE '$item->path/%'", '', 'id');
            $children = $children == false ? array() : array_keys($children);
            $children[] = $item->id;
            $where = 'pa.positionid IN ('. implode(',', $children) .')';
        }

        $select = $count ? 'COUNT(u.id)' : 'u.id';

        $sql = "SELECT $select
                FROM {$CFG->prefix}pos_assignment AS pa
                INNER JOIN {$CFG->prefix}user AS u ON pa.userid=u.id
                WHERE $where
                AND u.deleted=0";

        if ($count) {
            $num = count_records_sql($sql);
            return !$num ? 0 : $num;
        }
        else {
            return get_records_sql($sql);
        }
    }

    function get_affected_users_by_assignment($assignment) {
        global $CFG;

        // Query to retrieves the data required to determine the number of users
        //affected by an assignment
        $sql = "SELECT pos.id,
                        pos.fullname,
                        pos.path,
                        prog_assignment.includechildren,
                        prog_assignment.completiontime,
                        prog_assignment.completionevent,
                        prog_assignment.completioninstance
                FROM {$CFG->prefix}prog_assignment prog_assignment
                INNER JOIN {$CFG->prefix}pos pos on pos.id = prog_assignment.assignmenttypeid
                WHERE prog_assignment.id = $assignment->id";

        if ($item = get_record_sql($sql)) {
            return $this->get_affected_users($item);
        } else {
            return false;
        }

    }

    function get_includechildren($data, $object) {
        if (!isset($data->includechildren)
            || !isset($data->includechildren[$this->id])
            || !isset($data->includechildren[$this->id][$object->assignmenttypeid])) {

            return 0;
        }
        return 1;
    }

    function get_js($programid) {
        global $CFG;

        return "
            (function() {
                var id = {$this->id};
                var programid = {$programid};
                var title = '". get_string('addpositiontoprogram','local_program') ."';
                program_assignment.add_category(new category(id, 'positions', 'find_hierarchy.php?type=position&table=pos&programid='+programid, title));
            })();
        ";
    }
}

class cohorts_category extends prog_assignment_category {

    function __construct() {
        $this->id = ASSIGNTYPE_COHORT;
        $this->name = get_string('cohort','local_program');
        $this->buttonname = get_string('addcohorttoprogram','local_program');
    }

    function build_table($prefix, $programid) {
        $this->headers = array(
            get_string('cohortname','local_program'),
            get_string('source','local_program'),
            get_string('complete','local_program'),
            get_string('numlearners','local_program')
        );

        // Go to the database and gets the assignments
        $items = get_records_sql(
            "SELECT cohort.id, cohort.name as fullname, cohort.cohorttype, prog_assignment.completiontime, prog_assignment.completionevent, prog_assignment.completioninstance
	    FROM {$prefix}prog_assignment prog_assignment
	    INNER JOIN {$prefix}cohort cohort ON cohort.id = prog_assignment.assignmenttypeid
	    WHERE prog_assignment.programid = $programid
	    AND prog_assignment.assignmenttype = $this->id");

        // Convert these into html
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->data[] = $this->build_row($item);
            }
        }
    }

    function get_item($itemid) {
        return get_record('cohort','id',$itemid,'','','','','id, name as fullname, cohorttype');
    }

    function build_row($item) {
        global $CFG;

        if (is_int($item)) {
            $item = $this->get_item($item);
        }

        $row = array();
        $row[] = '<div class="item">'.format_string($item->fullname).'<a href="#" class="deletelink">'.'<img src="'.$CFG->pixpath.'/t/delete.gif"'.' /></a></div><input type="hidden" name="item['.$this->id.']['.$item->id.']" value="1"/>';
        $row[] = $item->cohorttype;
        $row[] = $this->get_completion($item);
        $row[] = $this->user_affected_count($item);

        return $row;
    }

    function user_affected_count($item) {
        return $this->get_affected_users($item, true);
    }

    function get_affected_users($item, $count=false) {
        global $CFG;
        $select = $count ? 'COUNT(u.id)' : 'u.id';
        $sql = "SELECT $select
                FROM {$CFG->prefix}cohort_members AS cm
                INNER JOIN {$CFG->prefix}user AS u ON cm.userid=u.id
                WHERE cm.cohortid = $item->id
                AND u.deleted=0";

        if ($count) {
            $num = count_records_sql($sql);
            return !$num ? 0 : $num;
        }
        else {
            return get_records_sql($sql);
        }
    }

    function get_affected_users_by_assignment($assignment) {
        $item = new stdClass();
        $item->id = $assignment->assignmenttypeid;
        return $this->get_affected_users($item);
    }

    /**
     * Unused by the cohorts category, so just return zero
     */
    function get_includechildren($data, $object) {
        return 0;
    }

    function get_js($programid) {
        global $CFG;

        return "
            (function() {
                var id = {$this->id};
                var programid = {$programid};
                var title = '". get_string('addcohorttoprogram','local_program') ."';
                program_assignment.add_category(new category(id, 'cohorts', 'find_cohort.php?programid='+programid, title));
            })();
        ";
    }
}

class managers_category extends prog_assignment_category {

    function __construct() {
        $this->id = ASSIGNTYPE_MANAGER;
        $this->name = get_string('managementhierarchy','local_program');
        $this->buttonname = get_string('addmanagertoprogram','local_program');
    }

    function build_table($prefix, $programid) {
        $this->headers = array(
            get_string('managername','local_program'),
            get_string('for','local_program'),
            get_string('complete','local_program'),
            get_string('numlearners','local_program')
        );

        // Go to the database and gets the assignments
        $items = get_records_sql(
            "SELECT u.id, " . sql_fullname('u.firstname', 'u.lastname') . " as fullname, m.path, prog_assignment.includechildren, prog_assignment.completiontime, prog_assignment.completionevent, prog_assignment.completioninstance
	    FROM {$prefix}prog_assignment prog_assignment
	    INNER JOIN {$prefix}user u ON u.id = prog_assignment.assignmenttypeid
            INNER JOIN {$prefix}manager m ON m.userid = u.id
	    WHERE prog_assignment.programid = $programid
	    AND prog_assignment.assignmenttype = $this->id");

        // Convert these into html
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->data[] = $this->build_row($item);
            }
        }
    }

    function get_item($itemid) {
        global $CFG;
        $sql = "SELECT u.id, " . sql_fullname('u.firstname', 'u.lastname') . " AS fullname, m.path
                FROM {$CFG->prefix}user AS u
                INNER JOIN {$CFG->prefix}manager AS m ON u.id = m.userid
                WHERE u.id = {$itemid}";
        return get_record_sql($sql);
    }

    function build_row($item) {
        global $CFG;

        if (is_int($item)) {
            $item = $this->get_item($item);
        }

        $selectedid = (isset($item->includechildren) && $item->includechildren == 1) ? 1 : 0;
        $options = array(
            0 => get_string('directteam','local_program'),
            1 => get_string('allbelowlower','local_program'));

        $optionhtml = '';
        foreach ($options as $id => $string) {
            $optionhtml .= '<option value="'. $id .'" '. (($id == $selectedid) ? 'selected="selected"' : '') .' >'. $string .'</option>';
        }

        $row = array();
        $row[] = '<div class="item">'.format_string($item->fullname).'<a href="#" class="deletelink">'.'<img src="'.$CFG->pixpath.'/t/delete.gif"'.' /></a></div><input type="hidden" name="item['.$this->id.']['.$item->id.']" value="1"/>';
        $row[] = '<select name="includechildren['.$this->id.']['.$item->id.']">'. $optionhtml .'</select>';
        $row[] = $this->get_completion($item);
        $row[] = $this->user_affected_count($item);

        return $row;
    }

    function user_affected_count($item) {
        return $this->get_affected_users($item, true);
    }

    function get_affected_users($item, $count=false) {
        global $CFG;

        $subquery = "SELECT ra.id FROM {$CFG->prefix}role_assignments ra WHERE ra.userid = $item->id"; // for a manager's direct team
        if (isset($item->includechildren) && $item->includechildren == 1 && isset($item->path)) {
            $children = get_records_select('manager', "path LIKE '$item->path/%'", '', 'userid');
            $children = $children == false ? array() : array_keys($children);
            $children[] = $item->id;
            $subquery = "SELECT ra.id FROM {$CFG->prefix}role_assignments ra WHERE ra.userid IN (". implode(',', $children) .")"; // for a manager's entire team
        }

        $select = $count ? 'COUNT(pa.userid) AS id' : 'pa.userid AS id';

        $sql = "SELECT $select
                FROM {$CFG->prefix}pos_assignment pa
                INNER JOIN {$CFG->prefix}user u ON (pa.userid = u.id AND u.deleted = 0)
                WHERE pa.reportstoid IN ($subquery)";

        if ($count) {
            $num = count_records_sql($sql);
            return !$num ? 0 : $num;
        }
        else {
            return get_records_sql($sql);
        }
    }

    function get_affected_users_by_assignment($assignment) {
        global $CFG;

        // Query to retrieves the data required to determine the number of users
        //affected by an assignment
        $sql = "SELECT u.id,
                        m.path,
                        prog_assignment.includechildren
                FROM {$CFG->prefix}prog_assignment prog_assignment
                INNER JOIN {$CFG->prefix}user u ON u.id = prog_assignment.assignmenttypeid
                INNER JOIN {$CFG->prefix}manager m ON m.userid = u.id
                WHERE prog_assignment.id = $assignment->id";

        if ($item = get_record_sql($sql)) {
            return $this->get_affected_users($item);
        } else {
            return false;
        }

    }

    function get_includechildren($data, $object) {
        return $data->includechildren[$this->id][$object->assignmenttypeid];
    }

    function get_js($programid) {
        global $CFG;

        return "
            (function() {
                var id = {$this->id};
                var programid = {$programid};
                var title = '". get_string('addmanagertoprogram','local_program') ."';
                var cat = new category(id, 'managers', 'find_manager.php?test=test', title);
                cat.dialog_additem.default_url = '{$CFG->wwwroot}/local/management/dialog.php?programid='+programid;
                program_assignment.add_category(cat);
            })();
        ";
    }
}

class individuals_category extends prog_assignment_category {

    function __construct() {
        $this->id = ASSIGNTYPE_INDIVIDUAL;
        $this->name = get_string('individuals','local_program');
        $this->buttonname = get_string('addindividualtoprogram','local_program');
    }

    function build_table($prefix, $programid) {
        $this->headers = array(
            get_string('individualname','local_program'),
            get_string('userid','local_program'),
            get_string('complete','local_program')
        );

        // Go to the database and gets the assignments
        $items = get_records_sql(
            "SELECT individual.id, " . sql_fullname('individual.firstname', 'individual.lastname') . " as fullname, prog_assignment.completiontime, prog_assignment.completionevent, prog_assignment.completioninstance
	    FROM {$prefix}prog_assignment prog_assignment
	    INNER JOIN {$prefix}user individual ON individual.id = prog_assignment.assignmenttypeid
	    WHERE prog_assignment.programid = $programid
	    AND prog_assignment.assignmenttype = $this->id");

        // Convert these into html
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->data[] = $this->build_row($item);
            }
        }
    }

    function get_item($itemid) {
        global $CFG;

        return get_record_select('user',"id = $itemid",'id, ' . sql_fullname('firstname', 'lastname') . ' as fullname');
    }

    function build_row($item) {
        global $CFG;

        if (is_int($item)) {
            $item = $this->get_item($item);
        }

        $row = array();
        $row[] = '<div class="item">'.format_string($item->fullname).'<a href="#" class="deletelink">'.'<img src="'.$CFG->pixpath.'/t/delete.gif"'.' /></a></div><input type="hidden" name="item['.$this->id.']['.$item->id.']" value="1"/>';
        $row[] = $item->id;
        $row[] = $this->get_completion($item);

        return $row;
    }

    function user_affected_count($item) {
        return 1;
    }

    function get_affected_users($item) {
        $user = (object)array('id'=>$item->assignmenttypeid);
        return array($user);
    }

    function get_affected_users_by_assignment($assignment) {
        return $this->get_affected_users($assignment);
    }

    function get_includechildren($data, $object) {
        return 0;
    }

    function get_js($programid) {
        global $CFG;

        return "
            (function() {
                var id = {$this->id};
                var programid = {$programid};
                var title = '". get_string('addindividualtoprogram','local_program') ."';
                program_assignment.add_category(new category(id, 'individuals', 'find_individual.php?programid='+programid, title));
            })();
        ";
    }
}

class user_assignment {
    public $userid, $assignment, $timedue;

    public function __construct($userid,$assignment,$timedue) {
        $this->userid = $userid;
        $this->assignment = $assignment;
        $this->timedue = $timedue;
    }

    // See which assignment has an earlier due date
    public function update($assignment, $timedue) {
        if (empty($assignment->completiontime)) {
            return;
        }

        // Todo: Implement the completion event bits
        // For now, lets just compare the completion time

        if ($timedue < $this->timedue) {
            $this->assignment = $assignment;
        }
    }
}

abstract class prog_assignment_completion_type {
    abstract public function get_id();
    abstract public function get_name();
    abstract public function get_script();
    abstract public function get_item_name($instanceid);
    abstract public function get_completion_string();
    abstract public function get_timestamp($userid,$instanceid);
}

class prog_assigment_completion_first_login extends prog_assignment_completion_type {
    private $timestamps;
    public function __construct() {
        $this->timestamps = get_records_select('user','','','id, firstaccess, lastaccess');
    }
    public function get_id() {
        return COMPLETION_EVENT_FIRST_LOGIN;
    }
    public function get_name() {
        return get_string('firstlogin','local_program');
    }
    public function get_script() {
        return "
            totaraDialogs['completionevent'].clear();
        ";
    }
    public function get_item_name($instanceid) {
        return '';
    }
    public function get_completion_string() {
        return 'first login';
    }
    public function get_timestamp($userid,$instanceid) {
        if (!isset($this->timestamps[$userid . '-' . $instanceid])) {
            return false;
        }

        $firstaccess = $this->timestamps[$userid]->firstaccess;
        if (empty($firstaccess)) {
            $firstaccess = $this->timestamps[$userid]->lastaccess;
        }
        return $firstaccess;
    }
}

class prog_assigment_completion_position_start_date extends prog_assignment_completion_type {
    private $names, $timestamps;
    public function __construct() {
        $this->names = get_records_select('pos','','','id, fullname');
        $this->timestamps = get_records_select('prog_pos_assignment','type = 1','',sql_concat('userid',"'-'",'positionid') . ' as hash, timeassigned');
    }
    public function get_id() {
        return COMPLETION_EVENT_POSITION_START_DATE;
    }
    public function get_name() {
        return get_string('positionstartdate','local_program');
    }
    public function get_script() {
        global $CFG;

        return "
            totaraDialogs['completionevent'].set_to_none();
            totaraDialogs['completionevent'].default_url = '$CFG->wwwroot/local/program/assignment/completion/find_position.php?';
            totaraDialogs['completionevent'].open();

            $('#instancetitle').unbind('click').click(function() {
                handle_completion_selection(". $this->get_id() .");
                return false;
            });
        ";
    }
    public function get_item_name($instanceid) {
        return $this->names[$instanceid]->fullname;
    }
    public function get_completion_string() {
        return 'starting in position';
    }
    public function get_timestamp($userid,$instanceid) {
        if (isset($this->timestamps[$userid . '-' . $instanceid])) {
            return $this->timestamps[$userid . '-' . $instanceid]->timeassigned;
        }
        return false;
    }
}

class prog_assigment_completion_program_completion extends prog_assignment_completion_type {
    private $names, $timestamps;
    public function __construct() {
        $this->names = get_records_select('prog','','','id, fullname');
        $this->timestamps = get_records_select('prog_completion','','',sql_concat('userid',"'-'",'programid') . ' as hash, timecompleted');
    }
    public function get_id() {
        return COMPLETION_EVENT_PROGRAM_COMPLETION;
    }
    public function get_name() {
        return get_string('programcompletion','local_program');
    }
    public function get_script() {
        global $CFG;

        return "
            totaraDialogs['completionevent'].set_to_none();
            totaraDialogs['completionevent'].default_url = '$CFG->wwwroot/local/program/assignment/completion/find_program.php?';
            totaraDialogs['completionevent'].open();

            $('#instancetitle').unbind('click').click(function() {
                handle_completion_selection(". $this->get_id() .");
                return false;
            });

            $('.folder').removeClass('clickable').addClass('unclickable');
        ";
    }
    public function get_item_name($instanceid) {
        return $this->names[$instanceid]->fullname;
    }
    public function get_completion_string() {
        return 'completion of program';
    }
    public function get_timestamp($userid,$instanceid) {
        if (isset($this->timestamps[$userid . '-' . $instanceid])) {
            return $this->timestamps[$userid . '-' . $instanceid]->timecompleted;
        }
        return false;
    }
}

class prog_assigment_completion_course_completion extends prog_assignment_completion_type {
    private $names, $timestamps;
    public function __construct() {
        $this->names = get_records_select('course','','','id, fullname');
        $this->timestamps = get_records_select('course_completions','','',sql_concat('userid',"'-'",'course') . ' as hash, timecompleted');
    }
    public function get_id() {
        return COMPLETION_EVENT_COURSE_COMPLETION;
    }
    public function get_name() {
        return get_string('coursecompletion','local_program');
    }
    public function get_script() {
        global $CFG;

        return "
            totaraDialogs['completionevent'].set_to_none();
            totaraDialogs['completionevent'].default_url = '$CFG->wwwroot/local/program/assignment/completion/find_course.php?';
            totaraDialogs['completionevent'].open();

            $('#instancetitle').unbind('click').click(function() {
                handle_completion_selection(". $this->get_id() .");
                return false;
            });

            $('.folder').removeClass('clickable').addClass('unclickable');
        ";
    }
    public function get_item_name($instanceid) {
        return $this->names[$instanceid]->fullname;
    }
    public function get_completion_string() {
        return 'completion of course';
    }
    public function get_timestamp($userid,$instanceid) {
        if (isset($this->timestamps[$userid . '-' . $instanceid])) {
            return $this->timestamps[$userid . '-' . $instanceid]->timecompleted;
        }
        return false;
    }
}

class prog_assigment_completion_profile_field_date extends prog_assignment_completion_type {
    private $names, $timestamps;
    public function __construct() {
        $this->names = get_records_select('user_info_field','','','id, name');
        $this->timestamps = get_records_select('user_info_data','','',sql_concat('userid',"'-'",'fieldid') . ' as hash, data');
    }
    public function get_id() {
        return COMPLETION_EVENT_PROFILE_FIELD_DATE;
    }
    public function get_name() {
        return get_string('profilefielddate','local_program');
    }
    public function get_script() {
        global $CFG;

        return "
            totaraDialogs['completionevent'].set_to_none();
            totaraDialogs['completionevent'].default_url = '$CFG->wwwroot/local/program/assignment/completion/find_profile_field.php?';
            totaraDialogs['completionevent'].open();

            $('#instancetitle').unbind('click').click(function() {
                handle_completion_selection(". $this->get_id() .");
                return false;
            });
        ";
    }
    public function get_item_name($instanceid) {
        return $this->names[$instanceid]->name;
    }
    public function get_completion_string() {
        return 'date in profile field';
    }
    public function get_timestamp($userid,$instanceid) {
        if (!isset($this->timestamps[$userid . '-' . $instanceid])) {
            return false;
        }

        $date = $this->timestamps[$userid . '-' . $instanceid]->data;
        $date = trim($date);

        if (empty($date)) {
            return false;
        }

        // Check if the profile field contains a date in UNIX timestamp form..
        $timestamppattern = '/^[1-9]+$/';
        if (preg_match($timestamppattern, $date, $matches) > 0) {
            return $date;
        }

        // Check if the profile field contains a date in the form dd/mm/yyyy...
        $datepattern = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{4})$/';
        if (preg_match($datepattern, $date, $matches) > 0) {
            list($day, $month, $year) = explode('/', $date);
            $date = $month.'/'.$day.'/'.$year;
            return strtotime($date);
        }

        // Last ditch attempt, try using strtotime to convert the string into a timestamp..
        $result = strtotime($date);
        if ($result != false) {
            return $result;
        }

        // Else we couldn't match a date, so return false
        return false;
    }
}
