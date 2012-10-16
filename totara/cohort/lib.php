<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage cohort
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}
require_once($CFG->dirroot . '/totara/message/messagelib.php');
require_once($CFG->dirroot . '/cohort/lib.php');
require_once($CFG->dirroot . '/totara/program/program_assignments.class.php');

define('COHORT_ALERT_NONE', 0);
define('COHORT_ALERT_AFFECTED', 1);
define('COHORT_ALERT_ALL', 2);

define('COHORT_COL_STATUS_ACTIVE', 0);
define('COHORT_COL_STATUS_DRAFT_UNCHANGED', 10);
define('COHORT_COL_STATUS_DRAFT_CHANGED', 20);
define('COHORT_COL_STATUS_OBSOLETE', 30);

define('COHORT_MEMBER_SELECTOR_MAX_ROWS', 1000);


global $COHORT_ALERT;
$COHORT_ALERT = array(
    COHORT_ALERT_NONE => get_string('alertmembersnone', 'totara_cohort'),
    COHORT_ALERT_AFFECTED => get_string('alertmembersaffected', 'totara_cohort'),
    COHORT_ALERT_ALL => get_string('alertmembersall', 'totara_cohort'),
);

define('COHORT_ASSN_ITEMTYPE_COURSE', 50);
define('COHORT_ASSN_ITEMTYPE_PROGRAM', 45);
global $COHORT_ASSN_ITEMTYPES;
$COHORT_ASSN_ITEMTYPES = array(
    COHORT_ASSN_ITEMTYPE_COURSE => 'course',
    COHORT_ASSN_ITEMTYPE_PROGRAM => 'program'
);

// this will be extended when we add visible learning and/or other tabs
define ('COHORT_ASSN_VALUE_ENROLLED', 30);
global $COHORT_ASSN_VALUES;
$COHORT_ASSN_VALUES = array(
    COHORT_ASSN_VALUE_ENROLLED => 'enrolled'
);

/**
 * This function is called automatically when the totara cohort module is installed.
 *
 * @return bool Success
 */
function totara_cohort_install() {
    global $CFG, $DB;
    return true;
}

/**
 * Run the totara_cohort cron
 */
function totara_cohort_cron() {
    global $CFG;
    require_once($CFG->dirroot . '/totara/cohort/cron.php');
    tcohort_cron();
}


/**
 * Add or update a cohort association
 * @param $cohortid
 * @param $instanceid course/program id
 * @param $instancetype COHORT_ASSN_ITEMTYPE_COURSE, COHORT_ASSN_ITEMTYPE_PROGRAM, etc.
 * @return boolean
 */
function totara_cohort_add_association($cohortid, $instanceid, $instancetype) {
    global $CFG, $DB, $COHORT_ASSN_ITEMTYPES;

    if (!array_key_exists($instancetype, $COHORT_ASSN_ITEMTYPES)) {
        return false;
    }

    switch ($instancetype) {
        case COHORT_ASSN_ITEMTYPE_COURSE:
            $courseassociations = array_map(
                function($assoc) {
                    return $assoc->instanceid;
                },
                totara_cohort_get_associations($cohortid, COHORT_ASSN_ITEMTYPE_COURSE)
            );
            if (in_array($instanceid, $courseassociations)) {
                return true;
            }
            if (!$course = $DB->get_record('course', array('id' => $instanceid))) {
                return false;
            }
            // Add a cohort enrol instance to the course
            $enrolplugin = enrol_get_plugin('cohort');
            $assid = $enrolplugin->add_instance($course, array('customint1' => $cohortid, 'roleid' => $CFG->learnerroleid));
            return $assid;
            break;
        case COHORT_ASSN_ITEMTYPE_PROGRAM:
            $progassociations = array_map(
                function($assoc) {
                    return $assoc->instanceid;
                },
                totara_cohort_get_associations($cohortid, COHORT_ASSN_ITEMTYPE_PROGRAM)
            );
            if (in_array($instanceid, $progassociations)) {
                return true;
            }
            if (!$program = $DB->get_record('prog', array('id' => $instanceid))) {
                return false;
            }
            // Add program assignment
            $todb = new stdClass;
            $todb->programid = $instanceid;
            $todb->assignmenttype = ASSIGNTYPE_COHORT;
            $todb->assignmenttypeid = $cohortid;
            $assid = $DB->insert_record('prog_assignment', $todb);
            return $assid;
            break;
        default:
            break;
    }

    return true;
}

/**
 * Delete a cohort association
 * @param $cohortid
 * @param $assid
 * @param $asstype
 */
function totara_cohort_delete_association($cohortid, $assid, $instancetype) {
    global $DB, $COHORT_ASSN_ITEMTYPES;

    if (!array_key_exists($instancetype, $COHORT_ASSN_ITEMTYPES)) {
        return false;
    }

    switch ($instancetype) {
        case COHORT_ASSN_ITEMTYPE_COURSE:
            // Get cohort enrol plugin instance
            $enrolinstance = $DB->get_record('enrol', array('id' => $assid));
            if (!empty($enrolinstance)) {
                $transaction = $DB->start_delegated_transaction();

                $enrolplugin = enrol_get_plugin('cohort');
                $enrolplugin->delete_instance($enrolinstance);  // this also unenrols peeps - no need to sync

                $transaction->allow_commit();
            }

            break;
        case COHORT_ASSN_ITEMTYPE_PROGRAM:
            if ($progassid = $DB->get_field('prog_assignment', 'id', array('id' => $assid))) {
                $transaction = $DB->start_delegated_transaction();

                prog_exceptions_manager::delete_exceptions_by_assignment($progassid);
                $DB->delete_records('prog_assignment', array('id' => $progassid));

                $transaction->allow_commit();
            }
            break;
        default:
            break;
    }

    return true;
}

/**
 * Returns enrolled learning items of a cohort
 *
 * @param int $cohortid
 * @param int $instancetype e.g COHORT_ASSN_ITEMTYPE_COURSE, COHORT_ASSN_ITEMTYPE_PROGRAM
 * @return array of db objects
 */
function totara_cohort_get_associations($cohortid, $instancetype=null) {
    global $DB;

    switch ($instancetype) {
        case COHORT_ASSN_ITEMTYPE_COURSE:
            // course associations
            $sql = "SELECT e.id, c.id AS instanceid, c.fullname, 'course' AS type
                FROM {enrol} e
                JOIN {course} c ON e.courseid = c.id
                WHERE enrol = 'cohort'
                AND customint1 = ?";
            $sqlparams = array($cohortid);

            break;
        case COHORT_ASSN_ITEMTYPE_PROGRAM:
            $sql = "SELECT pa.id, p.id AS instanceid, p.fullname, 'program' AS type
                FROM {prog_assignment} pa
                JOIN {prog} p ON pa.programid = p.id
                WHERE pa.assignmenttype = ?
                AND pa.assignmenttypeid = ?";
            $sqlparams = array(ASSIGNTYPE_COHORT, $cohortid);
            break;
        default:
            // return all associations. prefix ids to ensure uniqueness
            $sql = "SELECT " .$DB->sql_concat("'c'", 'c.id') . " AS instanceid, c.id, c.fullname AS fullname, 'course' AS type
                FROM {enrol} e
                JOIN {course} c ON e.courseid = c.id
                WHERE enrol = 'cohort'
                AND customint1 = ?

                UNION

                SELECT " . $DB->sql_concat("'p'", 'p.id') . " AS instanceid, p.id, p.fullname, 'program' AS type
                FROM {prog_assignment} pa
                JOIN {prog} p ON pa.programid = p.id
                WHERE pa.assignmenttype = ?
                AND pa.assignmenttypeid = ?";
            $sqlparams = array($cohortid, ASSIGNTYPE_COHORT, $cohortid);
            break;
    }

    return $DB->get_records_sql($sql, $sqlparams);
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

/******************************************************************************
 * Cohort event handlers, called from /totara/cohort/db/events.php
 ******************************************************************************/

/**
 * Event handler for when a user custom profiler field is deleted.
 * @global object $CFG
 * @param object $profilefield
 * @return boolean
 */
function cohort_profilefield_deleted_handler($profilefield) {
    global $DB;
    // todo: rewrite for new dynamic cohorts
    return true;
    /*
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
    return true;*/
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
    // todo: rewrite for new dynamic cohorts
    return true;
    /*
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
    $path_like_sql = $DB->sql_like('?', '?');
    $params[] = $position->path;
    $params[] = $DB->sql_concat("pos.path","'%'");
    $sql .= " ($path_like_sql";

    if (isset($position->oldpath)) {
        $old_path_like_sql = $DB->sql_like('?', '?');
        $params[] = $position->oldpath;
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
    return true;*/
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
    // todo: rewrite for new dynamic cohorts
    return true;
    /*
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
    $path_like_sql = $DB->sql_like('?', '?');
    $params[] = $organisation->path;
    $params[] = $DB->sql_concat("org.path","'%'");
    $sql .= " ($path_like_sql";
    if (isset($organisation->oldpath)) {
        $old_path_like_sql = $DB->sql_like('?', '?');
        $params[] = $organisation->oldpath;
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

    return true;*/
}


/**
 * Get the where clause for a dynamic cohort's query. The where clause will assume that
 * the "mdl_user" table has the alias "u".
 * @param $cohortid
 * @return string
 */
function totara_cohort_get_dynamic_cohort_whereclause($cohortid) {
    global $CFG, $COHORT_RULES_OP, $DB;
    require_once($CFG->dirroot.'/totara/cohort/rules/lib.php');

    $ruledefs = cohort_rules_list();

    $cohort = $DB->get_record('cohort', array('id'=>$cohortid));
    $rulesetoperator = $DB->get_field('cohort_rule_collections', 'rulesetoperator', array('id' => $cohort->activecollectionid));
    $rulesets = $DB->get_records('cohort_rulesets', array('rulecollectionid' => $cohort->activecollectionid), 'sortorder');
    $whereclause = new stdClass();
    if (empty($rulesets)) {
        // no rules, so no members!
        $whereclause->sql = '1 = 0';
        $whereclause->params = array();
        return $whereclause;
    }
    $whereclause->sql = (($rulesetoperator == COHORT_RULES_OP_AND) ? '1=1 ' : '1=0 ') . " \n";
    $whereclause->params = array();
    foreach ($rulesets as $ruleset) {
        $rules = $DB->get_records('cohort_rules', array('rulesetid' => $ruleset->id), 'sortorder');

        // Rulesets should never be empty, but if this one is, just skip it.
        if (!$rules) {
            continue;
        }

        // Add the operator that goes between rulesets
        $whereclause->sql .= '    ' . strtoupper($COHORT_RULES_OP[$rulesetoperator]) . ' ( ';
        $whereclause->sql .= (($ruleset->operator == COHORT_RULES_OP_AND) ? '1=1 ' : '1=0 ');
        $whereclause->sql .= "\n";

        foreach ($rules as $rulerec) {
            /* @var $rule cohort_rule_option */
            $rule = $ruledefs[$rulerec->ruletype][$rulerec->name];
            $sqlhandler = $rule->sqlhandler;
            $sqlhandler->fetch($rulerec->id);
            $snippet = $sqlhandler->get_sql_snippet();
            if (!empty($snippet->sql)) {
                $whereclause->sql .= "        " . strtoupper($COHORT_RULES_OP[$ruleset->operator]) . " {$snippet->sql} \n";
                $whereclause->params = array_merge($whereclause->params, $snippet->params);
            }
        }

        $whereclause->sql .= "    ) \n";
    }

    return $whereclause;
}


/**
 * Update the member list of this cohort (and consequently enrolments and stuff too)
 * @param int $cohortid
 * @param int $userid (optional) If set, only update this user
 * @param int $delaymessages (optional) If true, queue the messages for the cron. If false, send them now. Defaults to false.
 * @return mixed Change in number of members, or false for failure
 */
function totara_cohort_update_dynamic_cohort_members($cohortid, $userid=0, $delaymessages=false, $updatenested=true) {
    global $CFG, $DB;
    require_once($CFG->dirroot . '/totara/cohort/rules/lib.php');

    /// update necessary nested cohorts first (if any)
    if ($updatenested) {
        $nestedcohorts = totara_cohort_get_nested_dynamic_cohorts($cohortid);
        foreach ($nestedcohorts as $ncohortid) {
            totara_cohort_update_dynamic_cohort_members($ncohortid, $userid, $delaymessages, false);
        }
    }

    $beforecount = $DB->count_records('cohort_members', array('cohortid' => $cohortid));

    /// find members who should be added and deleted
    $sql = "
       SELECT userid AS id, MAX(inrules) AS addme, MAX(inmembers) AS deleteme
       FROM (
           SELECT u.id as userid, 1 AS inrules, 0 AS inmembers
           FROM {user} u
           WHERE u.username <> 'guest'
           and u.deleted = 0
           and u.confirmed = 1";
    $sqlparams = array();

    if ($userid) {
        $sql .= " AND u.id = :userid ";
        $sqlparams['userid'] = $userid;
    }

    $whereclause = totara_cohort_get_dynamic_cohort_whereclause($cohortid);
    if (empty($whereclause)) {
        // no whereclause, no members!
        return false;
    }
    $sql .= " AND ({$whereclause->sql})";

    $sql .= " UNION ALL
               SELECT cm.userid AS userid, 0 AS inrules, 1 AS inmembers
               FROM {cohort_members} cm
               WHERE cm.cohortid = :cohortid ";
    $sqlparams['cohortid'] = $cohortid;

    if ($userid) {
        $sql .= " AND cm.userid = :userid2 ";
        $sqlparams['userid2'] = $userid;
    }

    $sql .= "  ) q
       GROUP BY userid
       HAVING MAX(inrules) <> MAX(inmembers)
    ";

    $changedmembers = $DB->get_recordset_sql($sql, array_merge($sqlparams, $whereclause->params));
    if (!$changedmembers) {
        $changedmembers = array();
    }

    /// update memberships in batches
    $newmembers = array();
    $delmembers = array();
    $cmcount = 0;
    $numadd = 0;
    $numdel = 0;
    foreach ($changedmembers as $mem) {
        $cmcount++;
        if ($mem->addme) {
            $newmembers[$mem->id] = $mem;
        }
        if ($mem->deleteme) {
            $delmembers[$mem->id] = $mem;
        }
        if ($cmcount < 2000) {
            // continue to add records to current batches
            continue;
        }

        if (!empty($newmembers)) {
            $now = time();
            foreach ($newmembers as $i => $rec) {
                $newmembers[$i] = (object)array('cohortid' => $cohortid, 'userid' => $rec->id, 'timeadded' => $now);
            }
            $DB->insert_records_via_batch('cohort_members', $newmembers);
            totara_cohort_notify_add_users($cohortid, array_keys($newmembers), $delaymessages);
            $numadd += count($newmembers);
            unset($newmembers);
        }

        if (!empty($delmembers)) {
            $delids = array_keys($delmembers);
            unset($delmembers);
            list($sqlin, $params) = $DB->get_in_or_equal($delids, SQL_PARAMS_NAMED);
            $params['cohortid'] = $cohortid;
            $DB->delete_records_select(
                'cohort_members',
                "cohortid = :cohortid AND userid ".$sqlin, $params
            );
            totara_cohort_notify_del_users($cohortid, $delids, $delaymessages);
            $numdel += count($delids);
            unset($delids);
        }

        // reset stuff for next batch
        $newmembers = array();
        $delmembers = array();
        $cmcount = 0;
    }
    $changedmembers->close();
    unset($changedmembers);

    /// process leftover batches (if any)
    if (!empty($newmembers)) {
        $now = time();
        foreach ($newmembers as $i => $rec) {
            $newmembers[$i] = (object)array('cohortid' => $cohortid, 'userid' => $rec->id, 'timeadded' => $now);
        }
        $DB->insert_records_via_batch('cohort_members', $newmembers);
        totara_cohort_notify_add_users($cohortid, array_keys($newmembers), $delaymessages);
        $numadd += count($newmembers);
        unset($newmembers);
    }

    if (!empty($delmembers)) {
        $delids = array_keys($delmembers);
        unset($delmembers);
        list($sqlin, $params) = $DB->get_in_or_equal($delids, SQL_PARAMS_NAMED);
        $params['cohortid'] = $cohortid;
        $DB->delete_records_select(
            'cohort_members',
            "cohortid = :cohortid AND userid ".$sqlin, $params
        );
        totara_cohort_notify_del_users($cohortid, $delids, $delaymessages);
        $numdel += count($delids);
        unset($delids);
    }

    return array('add' => $numadd, 'del' => $numdel);
}

/**
 * Get all nested cohorts for the specified parent cohort
 *
 * @param int $cohortid the parent cohortid
 * @param array $current the current list of found nested cohortids (used by recursion)
 */
function totara_cohort_get_nested_dynamic_cohorts($cohortid, $current=array()) {
    global $DB;

    if (empty($current)) {
        $current = array($cohortid);
        $mastercohortid = $cohortid;
    }

    list($notinsql, $sqlparams) = $DB->get_in_or_equal($current, SQL_PARAMS_QM, 'param', false);
    array_unshift($sqlparams, $cohortid);

    $sql = "SELECT DISTINCT c.id
        FROM {cohort} c
        INNER JOIN {cohort_rule_params} crp ON c.id = " . $DB->sql_cast_char2int('crp.value') . "
            AND crp.name = 'cohortids'
        INNER JOIN {cohort_rules} cr ON crp.ruleid = cr.id
            AND cr.ruletype = 'cohort' AND cr.name = 'cohortmember'
        INNER JOIN {cohort_rulesets} crs ON cr.rulesetid = crs.id
        INNER JOIN {cohort_rule_collections} crc ON crs.rulecollectionid = crc.id
            AND crc.status = " . COHORT_COL_STATUS_ACTIVE . "
        WHERE crc.cohortid = ?
        AND c.id {$notinsql}
        AND c.cohorttype = " . cohort::TYPE_DYNAMIC;
    $cohorts = $DB->get_records_sql($sql, $sqlparams);
    $cohorts = array_keys($cohorts);

    $current = array_unique(array_merge($current, $cohorts));

    foreach ($cohorts as $ncohortid) {
        $current = array_merge($current, totara_cohort_get_nested_dynamic_cohorts($ncohortid, $current));
    }
    $current = array_unique($current);

    if (!empty($mastercohortid)) {
        // unset the top level cohortid
        foreach ($current as $i => $v) {
            if ($v == $mastercohortid) {
                unset($current[$i]);
                break;
            }
        }
    }

    return $current;
}


/**
 * Sends any cohort notifications that were stored in the queue table. (Called from the cohort cron)
 */
function totara_cohort_send_queued_notifications(){
    global $CFG, $DB;

    $sql = "SELECT " . $DB->sql_concat('cmq.cohortid', "'-'", 'cmq.action') . " AS id, cmq.cohortid, cmq.action, cohort.idnumber
              FROM {cohort_msg_queue} cmq
        INNER JOIN {cohort} cohort
                ON cohort.id = cmq.cohortid
             WHERE cmq.processed = 0
          GROUP BY cmq.cohortid, cmq.action, cohort.idnumber
          ORDER BY cohort.idnumber, cmq.action";

    $batchlist = $DB->get_records_sql($sql);
    if (empty($batchlist)) {
        return true;
    }

    foreach ($batchlist as $batch) {
        $timenow = time();
        mtrace(date("H:i:s", $timenow)."  Sending queued '{$batch->action}' messages for cohort '{$batch->idnumber}' (id:{$batch->cohortid}) ");

        // First flag the notices we're going to send, so that subsequent cron runs won't accidentally double-send them
        // if this takes a long time.
        $processtime = time();
        $sql = 'UPDATE {cohort_msg_queue} SET processed = ? WHERE cohortid = ? AND action = ? and processed = 0';
        $sqlparams = array($processtime, $batch->cohortid, $batch->action);
        $DB->execute($sql, $sqlparams);

        $sql = "SELECT userid
                  FROM {cohort_msg_queue}
                 WHERE cohortid = ?
                   AND action = ?
                   AND processed = ?
              GROUP BY userid";
        $msglist = $DB->get_records_sql($sql, array($batch->cohortid, $batch->action, $processtime));

        if (empty($msglist)) {
            continue;
        }

        $timenow = time();
        mtrace(date("H:i:s", $timenow)."    ... " . count($msglist) . ' queued to send out');
        totara_cohort_notify_users($batch->cohortid, array_keys($msglist), $batch->action);

        $DB->delete_records('cohort_msg_queue', array('cohortid' => $batch->cohortid, 'action' => $batch->action, 'processed' => $processtime));

        $timenow = time();
        mtrace(date("H:i:s", $timenow)."    ...sent!");
    }
}


function totara_cohort_clean_deleted_users() {
    global $DB;

    $DB->delete_records_select('cohort_members', "userid IN (SELECT id FROM {user} WHERE deleted = 1)");
}


/**
 * Returns the where clause snippet for determining if a cohort is currently active, based on its start and end dates
 * @param string $cohorttablealias (optional) SQL alias for the mdl_cohort table
 * @param int $now (optional) timestamp to use in the comparison (defaults to time())
 * @return string
 */
function totara_cohort_date_where_clause($cohorttablealias = null, $now = null) {
    if ($now === null) {
        $now = time();
    }

    if ($cohorttablealias === null) {
        $alias = '';
    } else {
        $alias = "{$cohorttablealias}.";
    }

    return "("
        ."({$alias}startdate IS NULL OR {$alias}startdate = 0 OR {$alias}startdate < {$now}) "
        ."and ({$alias}enddate IS NULL OR {$alias}enddate = 0 OR {$alias}enddate > {$now})"
        .")";
}


/**
 * Deletes records from cohort_members which have a cohortid that doesn't match
 * any existing cohort in the cohort table.
 */
function totara_cohort_delete_stale_memberships() {
    global $DB;

    // Delete invalid members
    return $DB->delete_records_select('cohort_members', "cohortid NOT IN (SELECT id FROM {cohort})");
}

/**
 * Make an exact copy of a currently existing cohort
 * @param $cohortid
 */
function totara_cohort_clone_cohort($oldcohortid) {
    global $CFG, $DB, $USER;

    $transaction = $DB->start_delegated_transaction();

    $newcohort = new stdClass();

    $oldcohort = $DB->get_record('cohort', array('id' => $oldcohortid));

    // Create the base cohort record
    $newcohort->contextid =         $oldcohort->contextid;
    $newcohort->name =              get_string('clonename', 'totara_cohort', $oldcohort->name);
    $newcohort->idnumber =          totara_cohort_next_automatic_id();
    if (!$newcohort->idnumber) {
        $newcohort->idnumber = $oldcohort->idnumber . '.1';
    }
    $newcohort->description =       $oldcohort->description;
    $newcohort->descriptionformat = $oldcohort->descriptionformat;
    $newcohort->component =         $oldcohort->component;
    $newcohort->cohorttype =        $oldcohort->cohorttype;
    $newcohort->visibility =        $oldcohort->visibility;
    $newcohort->alertmembers =      $oldcohort->alertmembers;
    $newcohort->startdate =         $oldcohort->startdate;
    $newcohort->enddate =           $oldcohort->enddate;

    $newcohort->id = cohort_add_cohort($newcohort, $addcollections=false);

    // Copy tags
    require_once($CFG->dirroot . '/tag/lib.php');
    $tags = tag_get_tags_array('cohort', $oldcohortid, 'official');
    if (!empty($tags)) {
        tag_set('cohort', $newcohort->id, $tags);
    }

    // Copy the learning items
    $oldlearningitems = totara_cohort_get_associations($oldcohortid);
    foreach ($oldlearningitems as $olditem) {
        totara_cohort_add_association($newcohort->id, $olditem->instanceid, $olditem->type);
    }
    unset($oldlearningitems);
    unset($olditem);
    unset($newitem);

    // Copy the member list
    $oldmembers = $DB->get_records('cohort_members', array('cohortid' => $oldcohortid));
    foreach ($oldmembers as $oldmember) {

        $newmember = new stdClass();
        $newmember->cohortid =  $newcohort->id;
        $newmember->userid =    $oldmember->userid;
        $newmember->timeadded = time();
        $DB->insert_record('cohort_members', $newmember);
    }
    unset($oldmembers);
    unset($oldmember);
    unset($newmember);

    // If the cohort is dynamic, copy over the rules
    if ($newcohort->cohorttype == cohort::TYPE_DYNAMIC) {
        // Clone active rule collection
        $activecollid = cohort_rules_clone_collection($oldcohort->activecollectionid);

        // Clone draft rule collection
        $draftcollid = cohort_rules_clone_collection($oldcohort->draftcollectionid);

        // Update new cohort's collections to created clones
        $todb = new stdClass;
        $todb->id = $newcohort->id;
        $todb->activecollectionid = $activecollid;
        $todb->draftcollectionid = $draftcollid;
        $DB->update_record('cohort', $todb);
    }

    $transaction->allow_commit();

    return $newcohort->id;
}

function totara_cohort_notify_add_users($cohortid, $adduserids, $delaymessages=false) {
    return totara_cohort_notify_users($cohortid, $adduserids, 'membersadded', $delaymessages);
}

function totara_cohort_notify_del_users($cohortid, $deluserids, $delaymessages=false) {
    return totara_cohort_notify_users($cohortid, $deluserids, 'membersremoved', $delaymessages);
}

/**
 * Send the notifications cohort members can receive when a user is added/removed from a cohort
 *
 * @param int $cohortid ID of cohort
 * @param array $userids Users beind addded/removed (NOT necessarily the message recipients!)
 * @param string $action "membersadded" or "membersremoved"
 * @param boolean $delaymessages True to queue messages for next cron run, false to send them now
 */
function totara_cohort_notify_users($cohortid, $userids, $action, $delaymessages=false) {
    global $CFG, $DB, $USER;

    if ($delaymessages) {
        // Don't send the messages now. Do a bulk insert to queue them for later sending
        if (!count($userids)) {
            return true;
        }
        $sql = "INSERT INTO {cohort_msg_queue} (cohortid, userid, action, processed, timecreated, timemodified, modifierid) VALUES (";
        $records = array();
        foreach ($userids as $userid) {
            $now = time();
            $records[] = "{$cohortid}, {$userid}, '{$action}', 0, {$now}, {$now}, {$USER->id}";
        }
        $sql .= implode('), (', $records);
        $sql .= ')';

        return $DB->execute($sql);
    }

    $cohort = $DB->get_record('cohort', array('id' => $cohortid), 'id, name, alertmembers');
    if ($cohort->alertmembers == COHORT_ALERT_NONE) {
        return true;
    }

    $memberlist = array();
    $users = $DB->get_records_select('user', 'id IN ('.implode(',', $userids).')', null, '', 'id, firstname, lastname');
    foreach ($users as $user) {
        $memberlist[] = fullname($user);
    }
    unset($users);
    sort($memberlist);

    $a = new stdClass();
    $a->cohortname = $cohort->name;
    $a->supportemail = $CFG->supportemail;
    $a->cohortmembers = implode("\n", $memberlist);
    $a->affectedcount = count($memberlist);
    unset($memberlist);

    //$fields = "u.id, u.username, u.firstname, u.lastname, u.maildisplay, u.mailformat, u.maildigest, u.emailstop, u.imagealt, u.email, u.city, u.country, u.lastaccess, u.lastlogin, u.picture, u.timezone, u.theme, u.lang, u.trackforums, u.mnethostid";
    $fields = "id, username, firstname, lastname, maildisplay, mailformat, maildigest, emailstop, imagealt, email, city, country, lastaccess, lastlogin, picture, timezone, theme, lang, trackforums, mnethostid";
    switch ($cohort->alertmembers) {
        case COHORT_ALERT_AFFECTED:
            $towho = 'toaffected';
            $tousers = $DB->get_records_select('user', 'id IN ('.implode(',', $userids).')', null, 'id', $fields);
            break;
        case COHORT_ALERT_ALL:
            $towho = 'toall';
            $tousers = $DB->get_records_select('user', "id IN (SELECT userid FROM {cohort_members} WHERE cohortid=?)", array($cohortid), 'id', $fields);
            break;
        default:
            return false;
    }

    $emailsubject = get_string("msg:{$action}_{$towho}_emailsubject", 'totara_cohort', $a);
    $emailbody = get_string("msg:{$action}_{$towho}_emailbody", 'totara_cohort', $a);
    $notice = get_string("msg:{$action}_{$towho}_notice", 'totara_cohort', $a);

    $eventdata = new stdClass();
    $eventdata->subject = $emailsubject;
    $eventdata->fullmessage = $notice;
    $eventdata->sendemail = TOTARA_MSG_EMAIL_NO;

    foreach ($tousers as $touser) {
        email_to_user($touser, $CFG->orgname, $emailsubject, $emailbody);

        $eventdata->userto = $touser;
        $eventdata->userfrom = $touser;
        tm_alert_send($eventdata);
    }

    return true;
}


/**
 * Returns whether or not this cohort should be considered active based on its start & end dates
 * @param $cohort object a row from the mdl_cohort table
 * @param int $now (optional) timestamp to use in the comparison (defaults to time())
 * @return bool
 */
function totara_cohort_is_active($cohort, $now = null){
    if ($now === null) {
        $now = time();
    }

    return
        (
            !$cohort->startdate || $cohort->startdate < $now
        ) && (
            !$cohort->enddate || $cohort->enddate > $now
        );
}


/**
 * Get the next suggested automatic id number.
 * NOTE: After using this function, make sure to call totara_cohort_increment_automatic_id
 * to "mark off" the id number you used.
 * @return str
 */
function totara_cohort_next_automatic_id() {
    global $CFG, $DB;

    // If these config variables aren't set just return null
    if (!isset($CFG->cohort_autoidformat) || !isset($CFG->cohort_lastautoidnumber)) {
        return '';
    }
    $idnum = (int) $CFG->cohort_lastautoidnumber;

    // If the autoid we generate is already in use, iterate to the next one.
    do {
        $idnum++;
        $idvalue = sprintf($CFG->cohort_autoidformat, $idnum);
    } while ($DB->record_exists('cohort', array('idnumber' => $idvalue)));

    return $idvalue;
}

/**
 * Increment the automatic id number counter from totara_cohort_next_automatic_id()
 * @param $idnumberused
 */
function totara_cohort_increment_automatic_id($idnumberused) {
    global $CFG;

    // Increment the cohort auto-id, if used
    if (isset($CFG->cohort_autoidformat) && isset($CFG->cohort_lastautoidnumber)) {
        // Check to see if the idnumber we used matches the autoidformat
        // Save the idnumber in the $idint variable if so
        if (
            sscanf($idnumberused, $CFG->cohort_autoidformat, $idint)
            && $idint > (int) $CFG->cohort_lastautoidnumber
        ) {
            set_config('cohort_lastautoidnumber', $idint);
        }
    }
}

/**
 * Generates the navlinks for a particular Moodle cohort
 *
 * @param $cohortid int (optional)
 * @param $cohortname str (optional)
 * @param $subpagetitle str (optional)
 * @return array suitable to pass as a $navlinks to Moodle lib functions
 */
function totara_cohort_navlinks($cohortid=false, $cohortname=false, $subpagetitle=false) {
    global $CFG, $PAGE;

    if ($cohortid && $cohortname) {
        $PAGE->navbar->add(s($cohortname), $CFG->wwwroot.'/cohort/view.php?id='.$cohortid);
    }
    if ($subpagetitle) {
        $PAGE->navbar->add(s($subpagetitle));
    }
}

/**
 * Returns a link showing the completion info for a given cohort in a program.
 * (used mainly by the cohort enrollment report)
 * @param $cohortid
 * @param $programid
 */
function totara_cohort_program_completion_link($cohortid, $programid){
    global $DB;
    $item = $DB->get_record('prog_assignment', array('assignmenttypeid' => $cohortid, 'programid' => $programid, 'assignmenttype' => ASSIGNTYPE_COHORT), 'assignmenttypeid as id, completiontime, completionevent, completioninstance');
    $cat = new cohorts_category();
    if (!$item) {
        $item = $cat->get_item($cohortid);
    }
    $html = $cat->get_completion($item);
    $html = '<input type="hidden" name="programid" value="'. $programid .'" />' . $html;
    return $html;
}

/**
 * Get cohorts associated with a certain course (excl programs)
 *
 * @param int $courseid course id
 * @param int $type the cohorttype e.g cohort::TYPE_DYNAMIC, cohort::TYPE_STATIC
 * @return object cohort database table records
 */
function totara_cohort_get_course_cohorts($courseid, $type=null, $fields='c.*') {
    global $DB;

    $sql = "SELECT {$fields}
        FROM {enrol} e
        JOIN {cohort} c ON e.customint1 = c.id
        WHERE e.enrol = 'cohort'
        AND e.courseid = ?";
    $sqlparams = array($courseid);

    if (!empty($type)) {
        $sql .= " AND c.cohorttype = ?";
        $sqlparams[] = $type;
    }

    return $DB->get_records_sql($sql, $sqlparams);
}


class totara_cohort_course_cohorts
{
    function build_table($courseid) {
        $this->headers = array(
            get_string('cohortname','totara_cohort'),
            get_string('type','totara_cohort'),
        );
        $this->headers[] = get_string('numlearners','totara_cohort');

        // Go to the database and gets the assignments
        $items = totara_cohort_get_course_cohorts($courseid, null,
            'c.id, c.name AS fullname, c.cohorttype');

        // Convert these into html
        if (!empty($items)) {
            foreach ($items as $item) {
                $this->data[] = $this->build_row($item);
            }
        }
    }

    function build_row($item) {
        global $OUTPUT;

        if (is_int($item)) {
            $item = $this->get_item($item);
        }

        $cohorttypes = cohort::getCohortTypes();
        $cohortstring = $cohorttypes[$item->cohorttype];

        $row = array();
        $row[] = html_writer::start_tag('div', array('id' => 'cohort-item-'.$item->id, 'class' => 'item')) .
                 format_string($item->fullname) .
                 html_writer::link('#', $OUTPUT->pix_icon('t/delete', get_string('delete'))
                     , array('title' => get_string('delete'), 'class'=>'coursecohortdeletelink')) .
                 html_writer::end_tag('div');

        $row[] = $cohortstring;
        $row[] = $this->user_affected_count($item);

        return $row;
    }

    function get_item($itemid) {
        global $DB;
        return $DB->get_record('cohort',array('id' => $itemid),'id, name as fullname, cohorttype');
    }

    function user_affected_count($item) {
        return $this->get_affected_users($item, 0, true);
    }

    function get_affected_users($item, $userid=0, $count=false) {
        global $DB;
        $select = $count ? 'COUNT(u.id)' : 'u.id';
        $params = array();
        $sql = "SELECT $select
                FROM {cohort_members} AS cm
                INNER JOIN {user} AS u ON cm.userid=u.id
                WHERE cm.cohortid = ?
                AND u.deleted=0";
        $params[] = $item->id;
        if ($userid) {
            $sql .= " AND u.id = ?";
            $params[] = $userid;
        }

        if ($count) {
            $num = $DB->count_records_sql($sql, $params);
            return !$num ? 0 : $num;
        } else {
            return $DB->get_records_sql($sql);
        }
    }

    /**
     * Prints out the actual html for the category, by looking at the headers
     * and data which should have been set by sub class
     *
     * @param bool $return
     * @return string html
     */
    function display($return = false) {


        $html = '<div id="course-cohort-assignments">
            <div id="assignment_categories" class="enrolled">
            <fieldset class="assignment_category cohorts">';

        $html .= '<table id="course-cohorts-table-enrolled">';
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

        $html .= '</fieldset></div></div>';

        if ($return) {
            return $html;
        }
        echo $html;
    }
}
//function called by moodlelib remove_course_contents()
function totara_cohort_delete_course($courseid, $showfeedback) {
    global $DB;

    // Locate all course rules and see whether they've got any rule params that are based on this course
    $courserules = $DB->get_records_select('cohort_rules', "name like 'course%'");
    if (!empty($courserules)) {
        $transaction = $DB->start_delegated_transaction();

        foreach ($courserules as $rule) {
            $DB->delete_records('cohort_rule_params', array('ruleid' => $rule->id, 'listofids' => $courseid));

            // Delete the rule if it has no params left after this
            if (!$DB->count_records('cohort_rule_params', array('ruleid' => $rule->id))) {
                $DB->delete_records('cohort_rules', array('id' => $rule->id));

                // Delete the rule's ruleset if it has no params left after this
                if (!$DB->count_records('cohort_rules', array('rulesetid' => $rule->rulesetid))) {
                    $DB->delete_records('cohort_rulesets', array('id' => $rule->rulesetid));
                }
            }
        }

        $transaction->allow_commit();
    }
}
