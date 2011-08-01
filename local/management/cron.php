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
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage management
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');

class manager {
    public $id;
    public $children = array();
    public $maxdepth = 1;
    public $parent;
    public function __construct($id) {
        $this->id = $id;
    }
    public function addChild($child) {
        $child->parent = $this;
        $this->children[] = $child;

        $this->updateMaxdepth($child->maxdepth);
    }

    public function updateMaxdepth($maxdepth) {
        // Update our
        if ($this->maxdepth < $maxdepth + 1) {
            $this->maxdepth = $maxdepth + 1;
        }


        if ($this->parent != null) {
            $this->parent->updateMaxdepth($this->maxdepth);
        }
    }

    public function hasChildren() {
        return count($this->children) > 0;
    }
}

function management_cron() {
    global $CFG;

    mtrace("Updating the local management heirarchy...");

    // Build the management hierarchy
    $sql = "SELECT pa.*
            FROM {$CFG->prefix}pos_assignment AS pa
            INNER JOIN {$CFG->prefix}user AS u ON pa.userid = u.id AND u.deleted = 0
            WHERE pa.type = 1"; // pa.type = primary position
    $pos_assignments = get_records_sql($sql);

    // General list of managers
    $managers = array();

    $top_manager = new manager(0);
    $managers[0] = $top_manager;

    foreach ($pos_assignments as $assignment) {
        if (!isset($managers[$assignment->userid])) {
            $managers[$assignment->userid] = new manager($assignment->userid);
        }

        if (empty($assignment->reportstoid)) {
            $assignment->reportstoid = 0;
        }
        else {
            // Lookup the managers id
            $assignment->reportstoid = get_field('role_assignments', 'userid', 'id', $assignment->reportstoid);
        }

        if (!isset($managers[$assignment->reportstoid])) {
            $managers[$assignment->reportstoid] = new manager($assignment->reportstoid);
        }

        // Get the user ids of the chain of parents, starting from the manager
        $ids = get_ids_in_chain($managers[$assignment->reportstoid]);

        // See if the user is in the chain of managers!
        if (in_array($managers[$assignment->userid]->id, $ids)) {
            $error = "ERROR: making user_$assignment->reportstoid the manager of user_$assignment->userid would cause a circular reference! ";
            echo $error;
        }
        else {
            $managers[$assignment->reportstoid]->addChild($managers[$assignment->userid]);
        }
    }

    // Drop all existing records from the table
    execute_sql("TRUNCATE {$CFG->prefix}manager CASCADE", false);
    execute_sql("SELECT setval('{$CFG->prefix}manager_id_seq', 1, false)", false);

    $sortorder = 1;

    // For each top level manager..
    foreach ($top_manager->children as $child) {
        recursive_insert($child, $path='', $sortorder);
    }

    return true;
}

function get_ids_in_chain($user,$ids=array()) {
    $ids[] = $user->id;
    if ($user->parent != null) {
        return get_ids_in_chain($user->parent,$ids);
    }
    return $ids;
}

function recursive_insert($manager, $path, &$sortorder) {
    global $CFG;

    if ($manager->hasChildren()) {
        $path .= "/$manager->id";
        $object = new stdClass();
        $object->userid = $manager->id;
        $object->parentid = ($manager->parent == null) ? 0 : $manager->parent->id;
        $object->path = $path;
        $object->type = 1; //Hard code to use the Primary position assignments
        $object->sortorder = $sortorder;
        insert_record('manager', $object);

        $sortorder++;

        if (!empty($manager->children)) {
            foreach ($manager->children as $child) {
                recursive_insert($child, $path, $sortorder);
            }
        }
    }
}
