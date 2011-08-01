<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Cohort related management functions, this file needs to be included manually.
 *
 * @package    core
 * @subpackage cohort
 * @copyright  2010 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('backported_lib.php');

/**
 * Add new cohort.
 *
 * @param  object $cohort
 * @return int
 */
function cohort_add_cohort($cohort) {

    if (!isset($cohort->name)) {
        throw new Exception('Missing cohort name in cohort_add_cohort().');
    }
    if (!isset($cohort->idnumber)) {
        $cohort->idnumber = NULL;
    }
    if (!isset($cohort->description)) {
        $cohort->description = sql_empty();
    }
    if (!isset($cohort->descriptionformat)) {
        $cohort->descriptionformat = FORMAT_HTML;
    }
    if (empty($cohort->component)) {
        $cohort->component = '';
    }
    if (!isset($cohort->timecreated)) {
        $cohort->timecreated = time();
    }
    if (!isset($cohort->timemodified)) {
        $cohort->timemodified = $cohort->timecreated;
    }

    $cohort->id = insert_record('cohort', $cohort);

    events_trigger('cohort_added', $cohort);

    return $cohort->id;
}

/**
 * Update existing cohort.
 * @param  object $cohort
 * @return void
 */
function cohort_update_cohort($cohort) {
    if (isset($cohort->component) and empty($cohort->component)) {
        $cohort->component = NULL;
    }
    $cohort->timemodified = time();
    update_record('cohort', $cohort);

    events_trigger('cohort_updated', $cohort);
}

/**
 * Delete cohort.
 * @param  object $cohort
 * @return void
 */
function cohort_delete_cohort($cohort) {
    if ($cohort->component) {
        // TODO: add component delete callback
    }

    $result = true;
    begin_sql();

    $result = $result && delete_records('cohort_members', 'cohortid', $cohort->id) != false;

    if ($result) {
	$result = $result && delete_records('cohort_criteria', 'cohortid', $cohort->id) != false;
    }

    if ($result) {
	$result = $result && delete_records('cohort', 'id', $cohort->id) != false;
    }

    if ($result) {
	commit_sql();
	events_trigger('cohort_deleted', $cohort);
    }
    else {
	rollback_sql();
    }

    return $result;
}

/**
 * Remove cohort member
 * @param  int $cohortid
 * @param  int $userid
 * @return void
 */
function cohort_add_member($cohortid, $userid) {
    $record = new stdClass();
    $record->cohortid  = $cohortid;
    $record->userid    = $userid;
    $record->timeadded = time();
    insert_record('cohort_members', $record);

    events_trigger('cohort_member_added', (object)array('cohortid'=>$cohortid, 'userid'=>$userid));
}

/**
 * Add cohort member
 * @param  int $cohortid
 * @param  int $userid
 * @return void
 */
function cohort_remove_member($cohortid, $userid) {

    delete_records('cohort_members','cohortid',$cohortid,'userid',$userid);

    events_trigger('cohort_member_removed', (object)array('cohortid'=>$cohortid, 'userid'=>$userid));
}

/**
 * Checks whether the given cohort (id) has had its critera set already
 * @param int $cohortid
 * @return boolean success
 */
function cohort_criteria_already_set($cohortid) {
    return record_exists('cohort_criteria', 'cohortid', $cohortid);
}

/**
 * Checks whether a criteria is valid (by having at least one thing set)
 * @param object $criteria
 * @return boolean
 */
function cohort_criteria_is_valid($criteria) {
    if (!empty($criteria->profilefield) || !empty($criteria->positionid) || !empty($criteria->organisationid)) {
	return true;
    }
    return false;
}

/**
 * Creates a dynamic cohort.
 * The cohort will have already been created, but this will be used to set the
 * criteria and do any funky bits.
 * @param <type> $criteria
 */
function cohort_add_dynamic_cohort($criteria) {
    if (!isset($criteria->cohortid)) {
        throw new Exception('Missing cohort id in cohort_add_dynamic_cohort()');
    }

    if (record_exists('cohort_criteria', 'cohortid', $criteria->cohortid)) {
	throw new Exception('Dynamic criteria already set for cohort in cohort_add_dynamic_cohort()');
    }

    $criteria->profilefieldvalues = addslashes($criteria->profilefieldvalues);

    $criteriaid = insert_record('cohort_criteria', $criteria);

    $cohort = get_record('cohort','id',$criteria->cohortid);
    cohort_housekeep_dynamic_cohort($cohort);
}

/**
 * Looks at every dynamic cohort and sorts it out
 */
function cohort_housekeep_all_dynamic_cohorts() {
    $cohorts = get_records('cohort', 'cohorttype', cohort::TYPE_DYNAMIC, '', 'id');
    if (!empty($cohorts)) {
        foreach ($cohorts as $cohort) {
            try {
                cohort_housekeep_dynamic_cohort($cohort);
            }
            catch (Exception $e) {
                // This function chooses to ignore exceptions and continue
            }
        }
    }
}

/**
 * Looks after a dynamic cohort
 * @param object $cohort
 */
function cohort_housekeep_dynamic_cohort($cohort) {
    // Check is dynamic
    if ($cohort->cohorttype != cohort::TYPE_DYNAMIC) {
        return;
    }

    // Get criteria record
    $criteria = get_record('cohort_criteria','cohortid',$cohort->id);

    // Check if criteria record exist
    if (!$criteria) {
        return;
    }

    // Ensure the criteria properties are valid
    $criteria = cohort_clean_criteria($criteria);

    // Add/remove users from this cohort as appropriate
    cohort_update_membership($criteria);
}

/**
 * Cleans the criteria record by checking that the parts are still valid
 * @param object $criteria
 */
function cohort_clean_criteria($criteria) {
    // Denotes whether the critera should be updated or not
    $update_required = false;

    // Check if this custom field still exists
    if (!empty($criteria->profilefield) && substr($criteria->profilefield, 0, 11) == 'customfield') {
        $custom_field_id = (int)substr($criteria->profilefield, 11);
        if (!record_exists('user_info_field', 'id', $custom_field_id)) {
            // If the profile field no longer exists then remove this bit of the criteria
            $criteria->profilefield = '';
            $criteria->profilefieldvalues = '';
            $update_required = true;
        }
    }

    // Check if the position still exists
    if (!empty($criteria->positionid)) {
        if (!record_exists('pos', 'id', $criteria->positionid)) {
            $criteria->positionid = 0;
            $criteria->positionincludechildren = 0;
            $update_required = true;
        }
    }

    // Check if the organisation still exists
    if (!empty($criteria->organisationid)) {
        if (!record_exists('org', 'id', $criteria->organisationid)) {
            $criteria->organisationid = 0;
            $criteria->orgincludechildren = 0;
            $update_required = true;
        }
    }

    // If anything has change, then update the criteria record
    if ($update_required) {
        update_record('cohort_criteria', $criteria);
    }

    return $criteria;
}

/**
 * Adds/removes users to a cohort by looking at the critera
 * @param object $criteria
 */
function cohort_update_membership($criteria) {
    global $CFG;

    $dynamic_cohort_users = dynamic_cohort_users::createFromCriteria($criteria);

    // List of desired user ids to be in this cohort
    $desired_members = $dynamic_cohort_users->get_user_ids();
    if ($desired_members == false)
	$desired_members = array();

    // List of actual user ids in this cohort currently
    $actual_members = get_records('cohort_members', 'cohortid', $criteria->cohortid, '', 'userid');
    if ($actual_members == false)
	$actual_members = array();
    else
	$actual_members = array_keys($actual_members);

    // Build a list of users to add to the cohort
    $users_to_add = array_diff($desired_members, $actual_members);

    // Build a list of users to remove from the cohort
    $users_to_remove = array_diff($actual_members, $desired_members);

    // Add users to cohort
    if (count($users_to_add) > 0) {
	$time = time();
	$sql = "INSERT INTO {$CFG->prefix}cohort_members (cohortid,userid,timeadded) VALUES ";
	$inserts = array();
	foreach ($users_to_add as $userid) {
	    $inserts[] = "($criteria->cohortid,$userid,$time)";
	}
	$sql .= implode(',', $inserts);
	$success = execute_sql($sql, false);
	if (!$success) {
	    throw new Exception("Failed to update cohort membership for Cohort $criteria->cohortid, please view logs for the SQL error");
	}

	// Trigger an event to let anyone know that the membership has changed
	$cohort = get_record('cohort','id',$criteria->cohortid);
	events_trigger('cohort_membership_changed',$cohort);
    }

    // Remove users from cohort
    if (count($users_to_remove) > 0) {
	$userids = '('. implode(',', $users_to_remove) .')';
	$sql = "DELETE FROM {$CFG->prefix}cohort_members WHERE cohortid = $criteria->cohortid AND userid IN $userids";
	$success = execute_sql($sql, false);
	if (!$success) {
	    throw new Exception("Failed to update cohort membership for Cohort $criteria->cohortid, please view logs for the SQL error");
	}

	// Trigger an event to let anyone know that the membership has changed
	$cohort = get_record('cohort','id',$criteria->cohortid);
	events_trigger('cohort_membership_changed',$cohort);
    }
}

/**
 * Cohort class which centrally stores a few bits of information about cohorts
 */
class cohort {
    const TYPE_STATIC = 1;
    const TYPE_DYNAMIC = 2;
    
    /**
     * Returns an array of the cohort types, used by the add/edit form
     * @return array
     */
    public static function getCohortTypes() {
	return array(
	    self::TYPE_STATIC => get_string('set','local_cohort'),
	    self::TYPE_DYNAMIC => get_string('dynamic','local_cohort')
	);
    }
}

/**
 * Cohort users class
 * You can pass in criteria and this class will build up SQL to get a list of
 * users. This is used to determine which users should be in the cohort.
 */
class dynamic_cohort_users {
    // SQL strings
    var $join_sql = '';
    var $where_sql = '';
    var $execute_query = true;

    function  __construct($profilefield, $profilefieldvalues, $positionid, $positionincludechildren, $organisationid, $orgincludechildren) {
	global $CFG;

	$joins = array();
	$wheres = array();

	// If no criteria is set then don't run any sql
	if (empty($profilefield) && empty($positionid) && empty($organisationid)) {
	    $this->execute_query = false;
	}


	// Build the SQL for this dynamic cohort.. going to be lengthy!

	// Profile field criteria
	if (!empty($profilefield)) {
	    if (empty($profilefieldvalues)) {
		throw new Exception('You must pass in profile field values if passing in a profile field');
	    }

	    // Create the IN statement for the where clause..
	    $values = explode(",",$profilefieldvalues);
	    foreach ($values as $key => $value) {
		$values[$key] = addslashes(strtolower(trim($value)));
	    }
	    $in = "('" . implode("','", $values) . "')";

	    // See if this is normal field or custom field
	    if (substr($profilefield, 0, 11) == 'customfield') {
		// Get the field id
		$custom_field_id = (int)substr($profilefield, 11);
		$joins[] = "INNER JOIN {$CFG->prefix}user_info_data customdata ON customdata.fieldid = $custom_field_id AND customdata.userid = auser.id";
		$wheres[] = "LOWER(customdata.data) IN $in";
	    }
	    else {
		$wheres[] = "LOWER(auser.{$profilefield}) IN $in";
	    }
	}
	

	// Position criteria
	if (!empty($positionid)) {
	    $joins[] = "INNER JOIN {$CFG->prefix}pos_assignment posassignment ON posassignment.userid = auser.id";
	    if ($positionincludechildren) {
		$path = get_field('pos', 'path', 'id', $positionid);
		$joins[] = "INNER JOIN {$CFG->prefix}pos pos ON pos.id = posassignment.positionid";
		$wheres[] = "(posassignment.positionid = $positionid OR pos.path LIKE '{$path}%')";
	    }
	    else {
		$wheres[] = "posassignment.positionid = $positionid";
	    }
	}

	if (!empty($organisationid)) {
	    $joins[] = "INNER JOIN {$CFG->prefix}pos_assignment orgassignment ON orgassignment.userid = auser.id";
	    if ($orgincludechildren) {
		$path = get_field('org', 'path', 'id', $organisationid);
		$joins[] = "INNER JOIN {$CFG->prefix}org org ON org.id = orgassignment.organisationid";
		$wheres[] = "(orgassignment.organisationid = $organisationid OR org.path LIKE '{$path}%')";
	    }
	    else {
		$wheres[] = "orgassignment.organisationid = $organisationid";
	    }
	}


	$this->join_sql = "FROM {$CFG->prefix}user auser ";
	$this->join_sql .= implode("\n", $joins);
	
	if (!empty($wheres)) {
	    $this->where_sql = "WHERE " . implode(" AND \n", $wheres);
	}
    }

    /**
     * Returns a count of users
     * @return int
     */
    function get_count() {
	if ($this->execute_query) {
	    $sql = "SELECT COUNT(*) $this->join_sql $this->where_sql";
	    return count_records_sql($sql);
	}
	return 0;
    }

    /**
     * Returns an array of user objects
     * @return array object
     */
    function get_users() {
	if ($this->execute_query) {
	    $sql = "SELECT auser.* $this->join_sql $this->where_sql";
	    return get_records_sql($sql);
	}
	return false;
    }

    /**
     * Returns an array of user ids
     * @return array int
     */
    function get_user_ids() {
	if ($this->execute_query) {
	    $sql = "SELECT auser.id $this->join_sql $this->where_sql";
	    $records = get_records_sql($sql);
	    if ($records == false) {
		return false;
	    }
	    return array_keys($records);
	}
	return array();
    }

    /**
     * Creates an dynamic_cohort_users object from a criteria object
     * @param object $criteria
     * @return dynamic_cohort_users
     */
    public static function createFromCriteria($criteria) {
	return new dynamic_cohort_users(
		$criteria->profilefield,
		$criteria->profilefieldvalues,
		$criteria->positionid,
		$criteria->positionincludechildren,
		$criteria->organisationid,
		$criteria->orgincludechildren);
    }
}

/******************************************************************************
 * Cohort event handlers, called from /local/db/events.php
 ******************************************************************************/

/**
 * Event handler for when a user custom profiler field is deleted.
 * @global object $CFG
 * @param object $profilefield
 * @return boolean
 */
function cohort_profilefield_deleted_handler($profilefield) {
    global $CFG;

    // Get all cohorts which use this custom profile field
    $sql = "
	SELECT cohort.* FROM {$CFG->prefix}cohort cohort
	INNER JOIN {$CFG->prefix}cohort_criteria cri ON cri.cohortid = cohort.id
	WHERE cri.profilefield LIKE " . sql_concat("'customfield'",$profilefield->id);
    $cohorts = get_records_sql($sql);

    // Update any cohorts that were found
    if (!empty($cohorts)) {
	foreach ($cohorts as $cohort) {
	    cohort_housekeep_dynamic_cohort($cohort);
	}
    }
    return true;
}

/**
 * Event handler for when a position is updated or deleted
 *
 * Cohorts that have this position directly attached to them, and cohorts which
 * are attached to a parent of this position are effected.
 *
 * @global object $CFG
 * @param object $position
 * @return boolean
 */
function cohort_position_updated_handler($position) {
    global $CFG;

    // We will check the path of the position to determine what other positions/cohorts are effected
    // If this position has changed parent then check the old path for affected cohorts too
    $check_old_path_sql = '';
    if (isset($position->oldpath)) {
	$check_old_path_sql = " OR '{$position->oldpath}' LIKE " . sql_concat("pos.path","'%'");
    }

    // Get cohorts that use this position or a parent of this position
    $sql = "
	SELECT cohort.* FROM {$CFG->prefix}cohort cohort
	INNER JOIN {$CFG->prefix}cohort_criteria cri ON cri.cohortid = cohort.id
	LEFT JOIN {$CFG->prefix}pos pos on pos.id = cri.positionid
	WHERE cri.positionid = {$position->id} OR
	(
	    cri.positionincludechildren = 1
	    AND
	    ('{$position->path}' LIKE " . sql_concat("pos.path","'%'") . " $check_old_path_sql)
	)";

    $cohorts = get_records_sql($sql);
    // Update any cohorts that were found
    if (!empty($cohorts)) {
	foreach ($cohorts as $cohort) {
	    cohort_housekeep_dynamic_cohort($cohort);
	}
    }
    return true;
}

/**
 * Event handler for when an organisation is updated
 *
 * Cohorts that have this organisation directly attached to them, and cohorts which
 * are attached to a parent of this organisation are effected.
 *
 * @global object $CFG
 * @param object $organisation
 * @return boolean
 */
function cohort_organisation_updated_handler($organisation) {
    global $CFG;

    // We will check the path of the organisation to determine what other organisation/cohorts are effected
    // If this organisation has changed parent then check the old path for affected cohorts too
    $check_old_path_sql = '';
    if (isset($organisation->oldpath)) {
	$check_old_path_sql = " OR '{$organisation->oldpath}' LIKE " . sql_concat("org.path","'%'");
    }

    // Get cohorts that use this organisation or a parent of this organisation
    $sql = "
	SELECT cohort.* FROM {$CFG->prefix}cohort cohort
	INNER JOIN {$CFG->prefix}cohort_criteria cri ON cri.cohortid = cohort.id
	LEFT JOIN {$CFG->prefix}org org on org.id = cri.organisationid
	WHERE cri.organisationid = {$organisation->id} OR
	(
	    cri.orgincludechildren = 1
	    AND
	    ('{$organisation->path}' LIKE " . sql_concat("org.path","'%'") . " $check_old_path_sql)
	)";

    $cohorts = get_records_sql($sql);
    // Update any cohorts that are found
    if (!empty($cohorts)) {
	foreach ($cohorts as $cohort) {
	    cohort_housekeep_dynamic_cohort($cohort);
	}
    }

    return true;
}
