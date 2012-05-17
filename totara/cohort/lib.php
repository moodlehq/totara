<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @subpackage cohort
 */

/**
 * This function is called automatically when the local cohort module is installed.
 *
 * @return bool Success
 */
function totara_cohort_install() {
    global $CFG, $DB;
    return true;
}

/**
 * Update dynamic cohorts
 *
 * @return  void
 */
function totara_cohort_cron() {
    global $DB;

    mtrace("Updating dynamic cohorts...");

    // Get all dynamic cohorts
    $cohorts = $DB->get_records('cohort', array('cohorttype' => cohort::TYPE_DYNAMIC));

    if (!empty($cohorts)) {
        // Update the membership for the cohorts
        foreach ($cohorts as $cohort) {
            try {
                cohort_housekeep_dynamic_cohort($cohort);
            }
            catch (Exception $e) {
                // Log it
                mtrace($e->getMessage());
            }
        }
    }

    return true;
}

/**
 * Checks whether the given cohort (id) has had its critera set already
 * @param int $cohortid
 * @return boolean success
 */
function cohort_criteria_already_set($cohortid) {
    global $DB;

    return $DB->record_exists('cohort_criteria', array('cohortid' => $cohortid));
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
    global $DB;

    if (!isset($criteria->cohortid)) {
        throw new Exception(get_string('missingcohortid', 'totara_cohort'));
    }

    if ($DB->record_exists('cohort_criteria', array('cohortid' => $criteria->cohortid))) {
    throw new Exception(get_string('dynamiccriteriasetalready', 'totara_cohort'));
    }

    $DB->insert_record('cohort_criteria', $criteria);

    $cohort = $DB->get_record('cohort', array('id' => $criteria->cohortid));
    cohort_housekeep_dynamic_cohort($cohort);
}

/**
 * Looks at every dynamic cohort and sorts it out
 */
function cohort_housekeep_all_dynamic_cohorts() {
    global $DB;

    $cohorts = $DB->get_records('cohort', array('cohorttype' => cohort::TYPE_DYNAMIC), '', 'id');
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
    global $DB;

    // Check is dynamic
    if ($cohort->cohorttype != cohort::TYPE_DYNAMIC) {
        return;
    }

    // Get criteria record
    $criteria = $DB->get_record('cohort_criteria', array('cohortid' => $cohort->id));

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
    global $DB;

    // Denotes whether the critera should be updated or not
    $update_required = false;

    // Check if this custom field still exists
    if (!empty($criteria->profilefield) && substr($criteria->profilefield, 0, 11) == 'customfield') {
        $custom_field_id = (int)substr($criteria->profilefield, 11);
        if (!$DB->record_exists('user_info_field', array('id' => $custom_field_id))) {
            // If the profile field no longer exists then remove this bit of the criteria
            $criteria->profilefield = '';
            $criteria->profilefieldvalues = '';
            $update_required = true;
        }
    }

    // Check if the position still exists
    if (!empty($criteria->positionid)) {
        if (!$DB->record_exists('pos', array('id' => $criteria->positionid))) {
            $criteria->positionid = 0;
            $criteria->positionincludechildren = 0;
            $update_required = true;
        }
    }

    // Check if the organisation still exists
    if (!empty($criteria->organisationid)) {
        if (!$DB->record_exists('org', array('id' => $criteria->organisationid))) {
            $criteria->organisationid = 0;
            $criteria->orgincludechildren = 0;
            $update_required = true;
        }
    }

    // If anything has change, then update the criteria record
    if ($update_required) {
        $DB->update_record('cohort_criteria', $criteria);
    }

    return $criteria;
}

/**
 * Adds/removes users to a cohort by looking at the critera
 * @param object $criteria
 */
function cohort_update_membership($criteria) {
    global $CFG, $DB;

    $dynamic_cohort_users = dynamic_cohort_users::createFromCriteria($criteria);

    // List of desired user ids to be in this cohort
    $desired_members = $dynamic_cohort_users->get_user_ids();
    if ($desired_members == false) {
        $desired_members = array();
    }

    // List of actual user ids in this cohort currently
    $actual_members = $DB->get_records('cohort_members', array('cohortid' => $criteria->cohortid), '', 'userid');
    if ($actual_members == false) {
        $actual_members = array();
    } else {
        $actual_members = array_keys($actual_members);
    }

    // Build a list of users to add to the cohort
    $users_to_add = array_diff($desired_members, $actual_members);

    // Build a list of users to remove from the cohort
    $users_to_remove = array_diff($actual_members, $desired_members);

    // Add users to cohort
    if (count($users_to_add) > 0) {
        $time = time();
        $params = array();
        $sql = "INSERT INTO {cohort_members} (cohortid,userid,timeadded) VALUES ";
        $inserts = array();
        foreach ($users_to_add as $userid) {
            $inserts[] = "(?, ?, ?)";
            $params = array_merge($params, array($criteria->cohortid, $userid, $time));
        }
        $sql .= implode(',', $inserts);
        $success = $DB->execute($sql, $params);
        if (!$success) {
            throw new Exception(get_string('failedtoupdate', 'totara_cohort', $criteria->cohortid));
        }

        // Trigger an event to let anyone know that the membership has changed
        $cohort = $DB->get_record('cohort', array('id' => $criteria->cohortid));
        events_trigger('cohort_membership_changed',$cohort);
    }

    // Remove users from cohort
    if (count($users_to_remove) > 0) {
        list($insql, $inparams) = $DB->get_in_or_equal($users_to_remove);
        $sql = "DELETE FROM {cohort_members} WHERE cohortid = ? AND userid $insql";
        $params = array($criteria->cohortid);
        $params = array_merge($params, $inparams);
        try {
            $DB->execute($sql, $params);
        } catch (Exception $e) {
            throw new Exception(get_string('failedtoupdate', 'totara_cohort', $criteria->cohortid));
        }
        // Trigger an event to let anyone know that the membership has changed
        $cohort = $DB->get_record('cohort', array('id' => $criteria->cohortid));
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
            self::TYPE_STATIC => get_string('set', 'totara_cohort'),
            self::TYPE_DYNAMIC => get_string('dynamic', 'totara_cohort')
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
    var $where_params = array();
    var $execute_query = true;

    function  __construct($profilefield, $profilefieldvalues, $positionid, $positionincludechildren, $organisationid, $orgincludechildren) {
        global $DB;

        $joins = array();
        $wheres = array();
        $whereparams = array();

        // If no criteria is set then don't run any sql
        if (empty($profilefield) && empty($positionid) && empty($organisationid)) {
            $this->execute_query = false;
        }

        // Build the SQL for this dynamic cohort.. going to be lengthy!

        // Profile field criteria
        if (!empty($profilefield)) {
            if (empty($profilefieldvalues)) {
                throw new Exception(get_string('profilefieldvaluesrequired', 'totara_cohort'));
            }

            // Create the IN statement for the where clause..
            $values = explode(",",$profilefieldvalues);
            foreach ($values as $key => $value) {
                $values[$key] = strtolower(trim($value));
            }
            list($insql, $inparams) = $DB->get_in_or_equal($values);

            // See if this is normal field or custom field
            if (substr($profilefield, 0, 11) == 'customfield') {
                // Get the field id
                $custom_field_id = (int)substr($profilefield, 11);
                $joins[] = "INNER JOIN {user_info_data} customdata ON customdata.fieldid = ? AND customdata.userid = auser.id";
                $whereparams[] = $custom_field_id;
                $wheres[] = "LOWER(customdata.data) $insql";
                $whereparams = array_merge($whereparams, $inparams);
            } else {
                $wheres[] = "LOWER(auser.{$profilefield}) $insql";
                $whereparams = array_merge($whereparams, $inparams);
            }
        }


        // Position criteria
        if (!empty($positionid)) {
            $joins[] = "INNER JOIN {pos_assignment} posassignment ON posassignment.userid = auser.id";
            if ($positionincludechildren) {
                $path = $DB->get_field('pos', 'path', array('id' => $positionid));
                $joins[] = "INNER JOIN {pos} pos ON pos.id = posassignment.positionid";
                $pos_like_sql = $DB->sql_like('pos.path', '?');
                $wheres[] = "(posassignment.positionid = ? OR {$pos_like_sql})";
                $whereparams = array_merge($whereparams, array($positionid, $path . '%'));
            }
            else {
                $wheres[] = "posassignment.positionid = ?";
                $whereparams[] = $positionid;
            }
        }

        if (!empty($organisationid)) {
            $joins[] = "INNER JOIN {pos_assignment} orgassignment ON orgassignment.userid = auser.id";
            if ($orgincludechildren) {
                $path = $DB->get_field('org', 'path', array('id' => $organisationid));
                $joins[] = "INNER JOIN {org} org ON org.id = orgassignment.organisationid";
                $org_like_sql = $DB->sql_like('org.path', '?');
                $wheres[] = "(orgassignment.organisationid = ? OR {$org_like_sql})";
                $whereparams = array_merge($whereparams, array($organisationid, $path . '%'));
            }
            else {
                $wheres[] = "orgassignment.organisationid = ?";
                $whereparams[] = $organisationid;
            }
        }


        $this->join_sql = "FROM {user} auser ";
        $this->join_sql .= implode("\n", $joins);

        if (!empty($wheres)) {
            $this->where_sql = "WHERE " . implode(" AND \n", $wheres);
            $this->where_params = $whereparams;
        }
    }

    /**
     * Returns a count of users
     * @return int
     */
    function get_count() {
        global $DB;

        if ($this->execute_query) {
            $sql = "SELECT COUNT(*) $this->join_sql $this->where_sql";
            return $DB->count_records_sql($sql, $this->where_params);
        }
        return 0;
    }

    /**
     * Returns an array of user objects
     * @return array object
     */
    function get_users() {
        global $DB;

        if ($this->execute_query) {
            $sql = "SELECT auser.* $this->join_sql $this->where_sql";
            return $DB->get_records_sql($sql, $this->where_params);
        }
        return false;
    }

    /**
     * Returns an array of user ids
     * @return array int
     */
    function get_user_ids() {
        global $DB;

    if ($this->execute_query) {
        $sql = "SELECT auser.id $this->join_sql $this->where_sql";
        $records = $DB->get_records_sql($sql, $this->where_params);
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
    global $CFG, $DB;

    // Get all cohorts which use this custom profile field
    $like_sql = $DB->sql_like('cri.profilefield', '?');
    $sql = "
        SELECT cohort.* FROM {cohort} cohort
        INNER JOIN {cohort_criteria} cri ON cri.cohortid = cohort.id
        WHERE {$like_sql}";
    $cohorts = $DB->get_records_sql($sql, array($DB->sql_concat('customfield', $profilefield->id)));

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
    global $CFG, $DB;

    // We will check the path of the position to determine what other positions/cohorts are effected
    // If this position has changed parent then check the old path for affected cohorts too
    $check_old_path_sql = '';
    $params = array();

    // Get cohorts that use this position or a parent of this position

    $sql = "
        SELECT cohort.* FROM {cohort} cohort
        INNER JOIN {cohort_criteria} cri ON cri.cohortid = cohort.id
        LEFT JOIN {pos} pos on pos.id = cri.positionid
        WHERE cri.positionid = ? OR
        (
            cri.positionincludechildren = 1
            AND";
    $params[] = $position->id;
    $path_like_sql = $DB->sql_like("{$position->path}", '?');
    $params[] = $DB->sql_concat("pos.path","'%'");
    $sql .= " ($path_like_sql";

    if (isset($position->oldpath)) {
        $old_path_like_sql = $DB->sql_like("{$position->oldpath}", '?');
        $check_old_path_sql = " OR $old_path_like_sql";
        $params[] = $DB->sql_concat("pos.path","'%'");
    }
    $sql .= $check_old_path_sql . "))";
    $cohorts = $DB->get_records_sql($sql, $params);
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
    global $CFG, $DB;

    // We will check the path of the organisation to determine what other organisation/cohorts are effected
    // If this organisation has changed parent then check the old path for affected cohorts too
    $check_old_path_sql = '';
    $params = array();

    // Get cohorts that use this organisation or a parent of this organisation
    $sql = "
        SELECT cohort.* FROM {cohort} cohort
        INNER JOIN {cohort_criteria} cri ON cri.cohortid = cohort.id
        LEFT JOIN {org} org on org.id = cri.organisationid
        WHERE cri.organisationid = ? OR
        (
            cri.orgincludechildren = 1
            AND";
    $params[] = $organisation->id;
    $path_like_sql = $DB->sql_like("{organisation->path}", '?');
    $params[] = $DB->sql_concat("org.path","'%'");
    $sql .= " ($path_like_sql";
    if (isset($organisation->oldpath)) {
        $old_path_like_sql = $DB->sql_like("{$organisation->oldpath}", '?');
        $check_old_path_sql = " OR $old_path_like_sql";
        $params[] = $DB->sql_concat("org.path","'%'");
    }
    $sql .= $check_old_path_sql . "))";

    $cohorts = $DB->get_records_sql($sql, $params);
    // Update any cohorts that are found
    if (!empty($cohorts)) {
        foreach ($cohorts as $cohort) {
            cohort_housekeep_dynamic_cohort($cohort);
        }
    }

    return true;
}

?>
