<?php
/**
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    totara
 * @subpackage dashboard
 * @author     Eugene Venter <eugene@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  Totara Learning Solutions Limited
 *
 * The main library for the dashboard module.
 */

class Dashboard {
    public $data;
    public $userid;
    public $instance;
    public $type;

    function __construct($shortname, $userid, $type='user') {
        if (!$this->data = get_record('dashb', 'shortname', $shortname)) {
            print_error('Dashboard not found...');
        }
        $this->userid = $userid;
        if (!$this->instance = $this->get_instance()) {
            print_error('Could not get dashboard instance...');
        }

        $this->set_type($type);
    }

    /**
     * Gets and sets the instance
     */
    function get_instance($instanceid=null) {
        if (!empty($instanceid)) {
            $this->instance = get_record_select('dashb_instance', 'id', $instanceid);
        } elseif ($instance=get_record('dashb_instance', 'userid', $this->userid, 'dashb_id', $this->data->id)) {
            // Return personalised instance
            $this->instance = $instance;
        } else {
            // Get default dashboard instance
            $this->instance = $this->get_default_instance();
        }

        return $this->instance;
    }

    function get_default_instance() {
        return get_record('dashb_instance', 'userid', 0, 'dashb_id', $this->data->id);
    }

    function set_personal_instance() {

        if ($instance=get_record('dashb_instance', 'userid', $this->userid, 'dashb_id', $this->data->id)) {
            $this->instance = $instance;
            return $this->instance;
        }

        // Get default instance and instance dashlets for role
        if (!$instanceclone=$this->get_default_instance()) {
            print_error('Could not create personal dashboard instance - No default instance defined');
        }
        $instancedashletsclone = get_records('dashb_instance_dashlet', 'dashb_instance_id', $instanceclone->id);

        // Insert data
        begin_sql();

        unset($instanceclone->id);
        $instanceclone->userid = $this->userid;
        if (!$instanceclone->id = insert_record('dashb_instance', $instanceclone)) {
            print_error('Could not create personal dashboard instance - could not insert instance');
        }

        // Set the new dashboard instance
        $this->instance = $instanceclone;

        if (!empty($instancedashletsclone)) {
            foreach ($instancedashletsclone as $dc) {
                // Set the new instance id
                $dc->dashb_instance_id = $this->instance->id;

                $blockid = get_field('block_instance', 'blockid', 'id', $dc->block_instance_id);

                // Create new block instance
                if ($binstanceid = $this->add_block_instance($blockid)) {
                    $dc->block_instance_id = $binstanceid;

                    // Finally insert dashlet
                    if (!insert_record('dashb_instance_dashlet', $dc)) {
                        print_error('Could not insert dashlets...');
                    }
                }
            }
        }
        commit_sql();

        return $this->instance->id;
    }

    function get_instance_dashlets($col=0, $orderby='col, pos') {
        global $CFG;

        $sql = "SELECT did.*, b.id AS blockid, b.name AS blockname,
                    (SELECT COUNT(pos) FROM {$CFG->prefix}dashb_instance_dashlet did2
                    WHERE did2.dashb_instance_id = {$this->instance->id} AND did2.col = did.col)
                    AS poscount
                FROM {$CFG->prefix}dashb_instance_dashlet did
                INNER JOIN {$CFG->prefix}block_instance bi ON did.block_instance_id = bi.id
                INNER JOIN {$CFG->prefix}block b ON bi.blockid = b.id
                WHERE did.dashb_instance_id = {$this->instance->id}";
        if (!empty($col)) {
            $sql .= " AND did.col = {$col}";
        }

        $sql .= " ORDER BY {$orderby}";

        $dashlets = get_records_sql($sql);
        return empty($dashlets) ? array() : $dashlets;
    }

    /* formats: user, useredit, admin */
    function output() {
        global $USER;

        if ($this->type=='useredit') {
            // Ensure the user has a personal dashboard instance, before continuing
            $this->set_personal_instance();
        }

        print_container_start(false, 'dashboard');

        $dashlets = $this->get_instance_dashlets();
        // Order dashlets into columns
        $dashletsarr = array();
        foreach ($dashlets as $d) {
            $dashletsarr[$d->col][] = $d;
        }
        $dashlets = $dashletsarr;
        unset($dashletsarr);

        for ($col=1; $col<$this->instance->cols+1; $col++) {
            echo "<div class=\"dashboardcol\" style=\"width: {$this->instance->colwidth}px\">";
            if (!empty($dashlets[$col])) {
                foreach ($dashlets[$col] as $dlet) {
                    // Output dashlets

                    if ($this->type=='user' && empty($dlet->visible)) {
                        continue;
                    }

                    $instance = get_record('block_instance', 'id', $dlet->block_instance_id);
                    if (!$block = block_instance($dlet->blockname, $instance)) {
                        report_error('Dashlet class not found...');
                    }

                    $controls = array();
                    $controls['moveleft'] = ($dlet->col > 1);
                    $controls['moveright'] = ($dlet->col < $this->instance->cols);
                    $controls['moveup'] = ($dlet->pos > 0);
                    $controls['movedown'] = ($dlet->pos < $dlet->poscount-1);
                    $controls['configure'] = (!empty($dlet->configdata));
                    $controls['show'] = (!empty($dlet->visible));

                    if ($this->type=='useredit') {
                        $options = 0;
                        // The block can be configured if the block class either allows multiple instances,
                        // or if it specifically allows instance configuration (multiple instances override that one).
                        // It doesn't have anything to do with what the administrator has allowed for this block
                        // in the site admin options.
                        $options |= BLOCK_CONFIGURE * ($block->instance_allow_config());
                        $block->_add_dashlet_block_edit_controls($options);
                        $block->_add_dashlet_edit_controls($dlet->id, $controls, array('item'=>$this->data->shortname));
                    }

                    $block->_print_dashlet();

                }   //foreach
            }   //if

            // Show add functionality
            if ($this->type == 'useredit') {
                $this->print_available_dashlets_menu($col);
            }

            echo "</div>";  // dashboard col
        }   //for

        print_container_end();  // dashboard container
        echo "<div class=\"clearfix\"></div>";
    }

    function get_editing_button($edit=-1, $options=array()) {
        global $USER;

        if ($edit !== -1) {
            $USER->{$this->data->shortname.'dashbediting'} = $edit;
        }
        // Work out the appropriate action.
        if (empty($USER->{$this->data->shortname.'dashbediting'})) {
            $label = get_string('turneditingon');
            $edit = 'on';
        } else {
            $label = get_string('turneditingoff');
            $edit = 'off';
        }

        // Generate the button HTML.
        $options['edit'] = $edit;
        $options['type'] = $this->data->shortname;

        return print_single_button(qualified_me(), $options, $label, 'get', '', true);
    }

    function print_available_dashlets_menu($col=1) {
        global $USER;

        $dashlets = $this->get_available_dashlets();

        $menu = array();
        if (!empty($dashlets)) {
            $stradd    = get_string('addtocol', 'local_dashboard');
            foreach ($dashlets as $key=>$dlet) {
                $blockobject = block_instance($dlet);
                $menu[$key] = $blockobject->get_title();
            }
            asort($menu);

            $target=strip_querystring(me()).'?dashaction=add&amp;col='.$col.'&amp;sesskey='.$USER->sesskey.'&amp;item='.$this->data->shortname;
            popup_form($target.'&amp;dlet=', $menu, 'add_dashlet'.$col, '', $stradd .'...', '', '');
        }
    }

    function get_column_dashlets($colno) {
        $dashlets = get_records_select('dashb_instance_dashlet',
            "dashb_instance_id ={$this->instance->id} AND col={$colno}", 'pos');

        return $dashlets;
    }

    function dashlet_toggle_visibility($id) {
        if (!$dlet = get_record('dashb_instance_dashlet', 'id', $id)) {
            return;
        }

        $dlet->visible = empty($dlet->visible);

        update_record('dashb_instance_dashlet', $dlet);
    }

    function dashlet_add($id, $col=1) {
        $dlet = new stdClass;
        $dlet->dashb_instance_id = $this->instance->id;
        $dlet->col = $col;
        $dlet->block_instance_id = $id;
        if (count_records('dashb_instance_dashlet', 'dashb_instance_id', $this->instance->id, 'col', $col)) {
            $dlet->pos = get_field('dashb_instance_dashlet', 'MAX(pos)', 'dashb_instance_id', $this->instance->id, 'col', $col)+1;
        } else {
            // Start counting at 0
            $dlet->pos = 0;
        }

        return insert_record('dashb_instance_dashlet', $dlet);
    }

    function dashlet_delete($id) {
        $dlet = get_record('dashb_instance_dashlet', 'id', $id);

        begin_sql();

        // Delete dashlet
        if (!delete_records('dashb_instance_dashlet', 'id', $id)) {
            rollback_sql();
            return 0;
        }

        // Delete block instance
        $block_instance = get_record('block_instance', 'id', $dlet->block_instance_id);
        if (!blocks_delete_instance($block_instance)) {
            rollback_sql();
            return 0;
        }

        commit_sql();

        return 1;
    }

    function dashlet_move_vertical($id, $direction) {
        if (!$dlet = get_record('dashb_instance_dashlet', 'id', $id)) {
            return;
        }

        $column_dashlets = $this->get_column_dashlets($dlet->col);
        $column_dashlets = array_keys($column_dashlets);
        $itemkey = array_search($dlet->id, $column_dashlets);

        switch ($direction) {
            case 'up':
                if (isset($column_dashlets[$itemkey-1])) {
                    $olditem = $column_dashlets[$itemkey-1];
                    $column_dashlets[$itemkey-1] = $column_dashlets[$itemkey];
                    $column_dashlets[$itemkey] = $olditem;
                }
                break;
            case 'down':
                if (isset($column_dashlets[$itemkey+1])) {
                    $olditem = $column_dashlets[$itemkey+1];
                    $column_dashlets[$itemkey+1] = $column_dashlets[$itemkey];
                    $column_dashlets[$itemkey] = $olditem;
                }
                break;
            default:
                break;
        }

        $this->reorder_dashlets($column_dashlets, 'pos');
    }

    function dashlet_move_horizontal($id, $direction) {
        if (!$dlet = get_record('dashb_instance_dashlet', 'id', $id)) {
            return;
        }

        $prevcol = $dlet->col;
        switch ($direction) {
            case 'left':
                if ($dlet->col > 1) {
                    $dlet->col--;
                    set_field('dashb_instance_dashlet', 'col', $dlet->col, 'id', $id);
                }
                break;
            case 'right':
                if ($dlet->col < $this->instance->cols) {
                    $dlet->col++;
                    set_field('dashb_instance_dashlet', 'col', $dlet->col, 'id', $id);
                }
                break;
            default:
                break;
        }

        // Re-arrange dashlets of previous column
        if ($column_dashlets = $this->get_column_dashlets($prevcol)) {
            $column_dashlets = array_keys($column_dashlets);
            $this->reorder_dashlets($column_dashlets, 'pos');
        }

        // Re-arrange dashlets in new column
        $column_dashlets = $this->get_column_dashlets($dlet->col);
        $column_dashlets = array_keys($column_dashlets);
        $this->reorder_dashlets($column_dashlets, 'pos');
    }

    function reorder_dashlets($dashlets, $field) {
        foreach ($dashlets as $key=>$d) {
            if (!set_field('dashb_instance_dashlet', $field, $key, 'id', $d)) {
                print_error('dashletreorderfail');
            }
        }
    }

    function get_available_dashlets() {
        global $CFG;

        $dashlets = array();

        $blocks = get_records('block', 'visible', 1);

        foreach ($blocks as $block) {
            $dfilepath = "{$CFG->dirroot}/blocks/{$block->name}/dashlet_roles.txt";
            if (file_exists($dfilepath) && $roles = array_map('rtrim',file($dfilepath))) {
                if (in_array($this->data->roleid, $roles)) {
                    $dashlets[$block->id] = $block->name;
                }
            }
        }
        //TODO: don't return dashlets already on the dashboard, not allowing multiple instances

        return $dashlets;
    }

    function is_using_default_instance() {
        return (empty($this->instance->userid));
    }

    function set_type($type) {
        $valid_types = array('user', 'useredit');

        if (!in_array($type, $valid_types)) {
            print_error('Invalid type...');
        }

        $this->type = $type;
    }

    function add_block_instance($blockid, $page=0) {
        global $CFG;

        $page = empty($page) ? page_create_object('totara-dashboard', $this->instance->id) : $page;

        // Add a new instance of this block, if allowed
        $block = blocks_get_record($blockid);

        if(empty($block) || !$block->visible) {
            // Only allow adding if the block exists and is enabled
            return 0;
        }

        if(!$block->multiple) {
            $current_dashlets = $this->get_instance_dashlets();
            foreach ($current_dashlets as $dlet) {
                if ($dlet->blockid == $blockid) {
                    // If no multiples are allowed and we already have one, return now
                    return 0;
                }
            }
        }

        if(!block_method_result($block->name, 'user_can_addto', $page)) {
            // If the block doesn't want to be added...
            return 0;
        }

        $newinstance = new stdClass;
        $newinstance->blockid    = $blockid;
        $newinstance->pageid = $page->get_id();
        $newinstance->pagetype   = $page->get_type();
        $newinstance->position   = BLOCK_POS_CENTER;

        // Calculate the weight - we need to save the weight, for multiple instances' sake
        $sql = 'SELECT 1, max(weight) + 1 AS nextfree FROM '. $CFG->prefix .'block_instance WHERE pageid = '.
        $page->get_id()
        .' AND pagetype = \''. $page->get_type() .'\' AND position = \'c\'';
        $weight = get_record_sql($sql);
        $newinstance->weight     = empty($weight->nextfree) ? 0 : $weight->nextfree;

        $newinstance->visible    = 1;
        $newinstance->configdata = '';
        $newinstance->id = insert_record('block_instance', $newinstance);

        // If the new instance was created, allow it to do additional setup
        if($newinstance && ($obj = block_instance($block->name, $newinstance))) {
            // Return value ignored
            $obj->instance_create();
        }

        return $newinstance->id;
    }


}   // End dashboard class


/***
 *** Public Library functions
 ***/
function local_dashboard_get_dashboards() {
    global $CFG;

    $sql = "SELECT d.*, r.name AS rolename,
            (SELECT COUNT(did.id) FROM {$CFG->prefix}dashb_instance_dashlet did
                WHERE dashb_instance_id = di.id AND did.visible=1) AS active_dashlets
            FROM {$CFG->prefix}dashb AS d
            INNER JOIN {$CFG->prefix}role AS r ON d.roleid = r.id
            INNER JOIN {$CFG->prefix}dashb_instance AS di ON d.id = di.dashb_id
            WHERE di.userid = 0";

    return get_records_sql($sql);
}

/**
 * Inserts a default set of dashboards into the database
 */
function local_dashboard_install() {

    $status = true;

    // create my learning dashboard
    if($learnerrole = get_field('role', 'id', 'shortname', 'student')) {
        begin_sql();
        // create dashboard
        $todb = new object();
        $todb->roleid = $learnerrole;
        $todb->shortname = 'mylearning';
        $todb->title = get_string('mylearning', 'local_dashboard');
        $dbid = insert_record('dashb', $todb);
        if(!$dbid) {
            $status = false;
        }

        // create default instance
        $todb = new object();
        $todb->dashb_id = $dbid;
        $todb->userid = 0;
        $todb->cols = 3;
        $todb->colwidth = 210;
        $dbiid = insert_record('dashb_instance', $todb);
        if(!$dbiid) {
            $status = false;
        }

        $dash = new Dashboard('mylearning', 0);

        // define the default blocks
        $blocks = array(
            array(
                'name' => 'quicklinks',
                'col' => 1,
                'pos' => 0,
            ),
            array(
                'name' => 'totara_notify',
                'col' => 2,
                'pos' => 0,
            ),
            array(
                'name' => 'totara_reminders',
                'col' => 3,
                'pos' => 0,
            ),
            array(
                'name' => 'recentlearning',
                'col' => 1,
                'pos' => 1,
            ),
        );
        // create an instance of each and add to dashboard
        foreach($blocks as $block) {
            $blockid = get_field('block', 'id', 'name', $block['name']);
            $block_instance_id = $dash->add_block_instance($blockid);
            $todb = new object();
            $todb->dashb_instance_id = $dbiid;
            $todb->block_instance_id = $block_instance_id;
            $todb->col = $block['col'];
            $todb->pos = $block['pos'];
            $todb->visible = 1;
            if(!insert_record('dashb_instance_dashlet', $todb)) {
                $status = false;
            }
        }

        // if all okay, commit
        if($status) {
            commit_sql();
        } else {
            rollback_sql();
        }
    }

    // create my team dashboard
    if($managerrole = get_field('role', 'id', 'shortname', 'manager')) {
        begin_sql();
        // create dashboard
        $todb = new object();
        $todb->roleid = $managerrole;
        $todb->shortname = 'myteam';
        $todb->title = get_string('myteam', 'local_dashboard');
        $dbid = insert_record('dashb', $todb);
        if(!$dbid) {
            $status = false;
        }

        // create default instance
        $todb = new object();
        $todb->dashb_id = $dbid;
        $todb->userid = 0;
        $todb->cols = 3;
        $todb->colwidth = 210;
        $dbiid = insert_record('dashb_instance', $todb);
        if(!$dbiid) {
            $status = false;
        }

        $dash = new Dashboard('myteam', 0);

        // define the default blocks
        $blocks = array(
            array(
                'name' => 'quicklinks',
                'col' => 1,
                'pos' => 0,
            ),
            array(
                'name' => 'totara_notify',
                'col' => 2,
                'pos' => 0,
            ),
            array(
                'name' => 'totara_reminders',
                'col' => 3,
                'pos' => 0,
            ),
            array(
                'name' => 'recentlearning',
                'col' => 1,
                'pos' => 1,
            ),
        );
        // create an instance of each and add to dashboard
        foreach($blocks as $block) {
            $blockid = get_field('block', 'id', 'name', $block['name']);
            $block_instance_id = $dash->add_block_instance($blockid);
            $todb = new object();
            $todb->dashb_instance_id = $dbiid;
            $todb->block_instance_id = $block_instance_id;
            $todb->col = $block['col'];
            $todb->pos = $block['pos'];
            $todb->visible = 1;
            if(!insert_record('dashb_instance_dashlet', $todb)) {
                $status = false;
            }
        }

        // if all okay, commit
        if($status) {
            commit_sql();
        } else {
            rollback_sql();
        }
    }
    return $status;
}
?>
