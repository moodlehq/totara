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
 * Local stuff for cohort enrolment plugin.
 *
 * @package    enrol
 * @subpackage cohort
 * @copyright  2010 Petr Skoda {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/enrol/locallib.php');
require_once($CFG->dirroot . '/totara/cohort/lib.php');


/**
 * Event handler for cohort enrolment plugin.
 *
 * We try to keep everything in sync via listening to events,
 * it may fail sometimes, so we always do a full sync in cron too.
 */
class enrol_cohort_handler {
    public function member_added($ca) {
        global $DB;

        if (!enrol_is_enabled('cohort')) {
            return true;
        }

        // does anything want to sync with this parent?
        //TODO: add join to role table to make sure that roleid actually exists
        if (!$enrols = $DB->get_records('enrol', array('customint1'=>$ca->cohortid, 'enrol'=>'cohort'), 'id ASC')) {
            return true;
        }

        $plugin = enrol_get_plugin('cohort');
        foreach ($enrols as $enrol) {
            // no problem if already enrolled
            $plugin->enrol_user($enrol, $ca->userid, $enrol->roleid);
        }

        return true;
    }

    public function member_removed($ca) {
        global $DB;

        // does anything want to sync with this parent?
        if (!$enrols = $DB->get_records('enrol', array('customint1'=>$ca->cohortid, 'enrol'=>'cohort'), 'id ASC')) {
            return true;
        }

        $plugin = enrol_get_plugin('cohort');
        foreach ($enrols as $enrol) {
            // no problem if already enrolled
            $plugin->unenrol_user($enrol, $ca->userid);
        }

        return true;
    }

    public function deleted($cohort) {
        global $DB;

        // does anything want to sync with this parent?
        if (!$enrols = $DB->get_records('enrol', array('customint1'=>$cohort->id, 'enrol'=>'cohort'), 'id ASC')) {
            return true;
        }

        $plugin = enrol_get_plugin('cohort');
        foreach ($enrols as $enrol) {
            $plugin->delete_instance($enrol);
        }

        return true;
    }
}

/**
 * Sync all cohort course links.
 * @param int $courseid one course, empty mean all
 * @param bool $mtrace show debug output
 * @return void
 */
function enrol_cohort_sync($courseid = NULL, $mtrace=false) {
    global $CFG, $DB;

    // unfortunately this may take a long time
    @set_time_limit(0); //if this fails during upgrade we can continue from cron, no big deal

    if ($mtrace) {
        mtrace('removing user memberships of deleted users...');
    }
    totara_cohort_clean_deleted_users();

    // first make sure dynamic cohort members are up to date
    if (empty($courseid)) {
        $dcohorts = $DB->get_records('cohort', array('cohorttype' => cohort::TYPE_DYNAMIC), 'idnumber');
    } else {
        // only update members of cohorts that is associated with this course
        $dcohorts = totara_cohort_get_course_cohorts($courseid, cohort::TYPE_DYNAMIC);
    }
    if ($mtrace) {
        mtrace('updating dynamic cohort members...');
    }
    foreach ($dcohorts as $cohort) {
        $active = totara_cohort_is_active($cohort);
        if (!$active) {
            if ($mtrace) {
                mtrace("inactive cohort {$cohort->idnumber}");
                mtrace("start-date: " . ($cohort->startdate === null ? 'null' : userdate($cohort->startdate)));
                mtrace("end-date: " . ($cohort->enddate === null ? 'null:' : userdate($cohort->enddate)));
            }
            continue;
        }
        try {
            $timenow = time();
            if ($mtrace) {
                mtrace(date("H:i:s",$timenow)." updating {$cohort->idnumber} members...");
            }
            $result = totara_cohort_update_dynamic_cohort_members($cohort->id);
            if (is_array($result) && array_key_exists('add', $result) && array_key_exists('del', $result)) {
                if ($mtrace) {
                    mtrace("{$result['add']} members added; {$result['del']} members deleted");
                }
            } else {
                throw new Exception("error processing members: " . print_r($result, true));
            }
        } catch (Exception $e) {
            // log it
            if ($mtrace) {
                mtrace($e->getMessage());
            }
        }
    } // foreach


    if ($mtrace) {
        mtrace('updating cohort enrolments...');
    }
    $cohort = enrol_get_plugin('cohort');

    $onecourse = $courseid ? "AND e.courseid = :courseid" : "";

    // iterate through all not enrolled yet users
    if (enrol_is_enabled('cohort')) {
        $params = array();
        $onecourse = "";
        if (!empty($courseid)) {
            $params['courseid'] = $courseid;
            $onecourse = "AND e.courseid = :courseid";
        }

        // get enrol instances where peeps need to be enrolled
        $sql = "SELECT DISTINCT e.id
                  FROM {cohort_members} cm
                  JOIN {enrol} e ON (e.customint1 = cm.cohortid AND e.status = :statusenabled AND e.enrol = 'cohort' $onecourse)
             LEFT JOIN {user_enrolments} ue ON (ue.enrolid = e.id AND ue.userid = cm.userid)
                 WHERE ue.id IS NULL";
        $params['statusenabled'] = ENROL_INSTANCE_ENABLED;
        $rseids = $DB->get_recordset_sql($sql, $params);

        // enrol the necessary users in the enrol instances
        foreach ($rseids as $enrol) {
            $sql = "SELECT DISTINCT cm.userid
                      FROM {cohort_members} cm
                      JOIN {enrol} e ON (e.customint1 = cm.cohortid AND e.status = :statusenabled AND e.enrol = 'cohort' $onecourse)
                 LEFT JOIN {user_enrolments} ue ON (ue.enrolid = e.id AND ue.userid = cm.userid)
                     WHERE e.id = :enrolid AND ue.id IS NULL";
            $params['enrolid'] = $enrol->id;
            $rsuserids = $DB->get_recordset_sql($sql, $params);

            $enrolinstance = $DB->get_record('enrol', array('id' => $enrol->id));

            $uecount = 0;
            $ue = array();
            foreach ($rsuserids as $u) {
                $ue[] = $u;
                $uecount++;
                if ($uecount == BATCH_INSERT_MAX_ROW_COUNT) {
                    // bulk enrol in batches
                    $cohort->enrol_user_bulk($enrolinstance, $ue, $enrolinstance->roleid);
                    $uecount = 0;
                    $ue = array();
                }
            }
            if (!empty($ue)) {
                // enrol remaining batch
                $cohort->enrol_user_bulk($enrolinstance, $ue, $enrolinstance->roleid);
                unset($ue);
            }

            $rsuserids->close();
        }
        $rseids->close();
    }

    // get enrol instances where peeps need to be unenrolled
    $sql = "SELECT DISTINCT e.id
              FROM {user_enrolments} ue
              JOIN {enrol} e ON (e.id = ue.enrolid AND e.enrol = 'cohort' $onecourse)
         LEFT JOIN {cohort_members} cm ON (cm.cohortid  = e.customint1 AND cm.userid = ue.userid)
             WHERE cm.id IS NULL";
    $params = array();
    if (!empty($courseid)) {
        $params['courseid'] = $courseid;
    }
    $rseids = $DB->get_recordset_sql($sql, $params);

    // unenrol the necessary users from the enrol instances
    foreach ($rseids as $enrol) {
        // unenrol as necessary - ignore enabled flag, we want to get rid of all
        $sql = "SELECT DISTINCT ue.userid
                  FROM {user_enrolments} ue
                  JOIN {enrol} e ON (e.id = ue.enrolid AND e.enrol = 'cohort' $onecourse)
             LEFT JOIN {cohort_members} cm ON (cm.cohortid  = e.customint1 AND cm.userid = ue.userid)
                 WHERE e.id = :enrolid AND cm.id IS NULL";
        $params['enrolid'] = $enrol->id;
        $rsuserids = $DB->get_recordset_sql($sql, $params);

        $enrolinstance = $DB->get_record('enrol', array('id' => $enrol->id));

        $uuecount = 0;
        $uue = array();
        foreach ($rsuserids as $u) {
            $uue[] = $u->userid;
            $uuecount++;
            if ($uuecount == BATCH_INSERT_MAX_ROW_COUNT) {
                // bulk unenrol in batches
                $cohort->unenrol_user_bulk($enrolinstance, $uue);
                $uuecount = 0;
                $uue = array();
            }
        }
        if (!empty($uue)) {
            // enrol remaining batch
            $cohort->unenrol_user_bulk($enrolinstance, $uue);
            unset($uue);
        }

        $rsuserids->close();
    }
    $rseids->close();

    // remove unwanted roles - include ignored roles and disabled plugins too
    $onecourse = $courseid ? "AND e.courseid = :courseid" : "";
    $sql = "SELECT ra.roleid, ra.userid, ra.contextid, ra.itemid
              FROM {role_assignments} ra
              JOIN {context} c ON (c.id = ra.contextid AND c.contextlevel = :coursecontext)
              JOIN {enrol} e ON (e.id = ra.itemid AND e.enrol = 'cohort' $onecourse)
         LEFT JOIN {user_enrolments} ue ON (ue.enrolid = e.id AND ue.userid = ra.userid)
             WHERE ra.component = 'enrol_cohort' AND ue.id IS NULL";
    $params = array('coursecontext' => CONTEXT_COURSE, 'courseid' => $courseid);

    $rs = $DB->get_recordset_sql($sql, $params);
    foreach ($rs as $ra) {
        role_unassign($ra->roleid, $ra->userid, $ra->contextid, 'enrol_cohort', $ra->itemid);
    }
    $rs->close();

    // Program cohort memberships will be handled by the programs cron ;)

    // Delete any stale memberships due to deleted cohort(s)
    if ($mtrace) {
        mtrace('removing user memberships for deleted cohorts...');
    }
    totara_cohort_delete_stale_memberships();
}

/**
 * Enrols all of the users in a cohort through a manual plugin instance.
 *
 * In order for this to succeed the course must contain a valid manual
 * enrolment plugin instance that the user has permission to enrol users through.
 *
 * @global moodle_database $DB
 * @param course_enrolment_manager $manager
 * @param int $cohortid
 * @param int $roleid
 * @return int
 */
function enrol_cohort_enrol_all_users(course_enrolment_manager $manager, $cohortid, $roleid) {
    global $DB;
    $context = $manager->get_context();
    require_capability('moodle/course:enrolconfig', $context);

    $instance = false;
    $instances = $manager->get_enrolment_instances();
    foreach ($instances as $i) {
        if ($i->enrol == 'manual') {
            $instance = $i;
            break;
        }
    }
    $plugin = enrol_get_plugin('manual');
    if (!$instance || !$plugin || !$plugin->allow_enrol($instance) || !has_capability('enrol/'.$plugin->get_name().':enrol', $context)) {
        return false;
    }
    $sql = "SELECT com.userid
              FROM {cohort_members} com
         LEFT JOIN (
                SELECT *
                FROM {user_enrolments} ue
                WHERE ue.enrolid = :enrolid
                 ) ue ON ue.userid=com.userid
             WHERE com.cohortid = :cohortid AND ue.id IS NULL";
    $params = array('cohortid' => $cohortid, 'enrolid' => $instance->id);
    $rs = $DB->get_recordset_sql($sql, $params);
    $count = 0;
    foreach ($rs as $user) {
        $count++;
        $plugin->enrol_user($instance, $user->userid, $roleid);
    }
    $rs->close();
    return $count;
}

/**
 * Gets all the cohorts the user is able to view.
 *
 * @global moodle_database $DB
 * @param course_enrolment_manager $manager
 * @return array
 */
function enrol_cohort_get_cohorts(course_enrolment_manager $manager) {
    global $DB;
    $context = $manager->get_context();
    $cohorts = array();
    $instances = $manager->get_enrolment_instances();
    $enrolled = array();
    foreach ($instances as $instance) {
        if ($instance->enrol == 'cohort') {
            $enrolled[] = $instance->customint1;
        }
    }
    list($sqlparents, $params) = $DB->get_in_or_equal(get_parent_contexts($context));
    $sql = "SELECT id, name, contextid
              FROM {cohort}
             WHERE contextid $sqlparents
          ORDER BY name ASC";
    $rs = $DB->get_recordset_sql($sql, $params);
    foreach ($rs as $c) {
        $context = get_context_instance_by_id($c->contextid);
        if (!has_capability('moodle/cohort:view', $context)) {
            continue;
        }
        $cohorts[$c->id] = array(
            'cohortid'=>$c->id,
            'name'=>format_string($c->name),
            'users'=>$DB->count_records('cohort_members', array('cohortid'=>$c->id)),
            'enrolled'=>in_array($c->id, $enrolled)
        );
    }
    $rs->close();
    return $cohorts;
}

/**
 * Check if cohort exists and user is allowed to enrol it
 *
 * @global moodle_database $DB
 * @param int $cohortid Cohort ID
 * @return boolean
 */
function enrol_cohort_can_view_cohort($cohortid) {
    global $DB;
    $cohort = $DB->get_record('cohort', array('id' => $cohortid), 'id, contextid');
    if ($cohort) {
        $context = get_context_instance_by_id($cohort->contextid);
        if (has_capability('moodle/cohort:view', $context)) {
            return true;
        }
    }
    return false;
}

/**
 * Gets cohorts the user is able to view.
 *
 * @global moodle_database $DB
 * @param course_enrolment_manager $manager
 * @param int $offset limit output from
 * @param int $limit items to output per load
 * @param string $search search string
 * @return array    Array(more => bool, offset => int, cohorts => array)
 */
function enrol_cohort_search_cohorts(course_enrolment_manager $manager, $offset = 0, $limit = 25, $search = '') {
    global $DB;
    $context = $manager->get_context();
    $cohorts = array();
    $instances = $manager->get_enrolment_instances();
    $enrolled = array();
    foreach ($instances as $instance) {
        if ($instance->enrol == 'cohort') {
            $enrolled[] = $instance->customint1;
        }
    }

    list($sqlparents, $params) = $DB->get_in_or_equal(get_parent_contexts($context));

    // Add some additional sensible conditions
    $tests = array('contextid ' . $sqlparents);

    // Modify the quesry to perform the search if requred
    if (!empty($search)) {
        $conditions = array(
            'name',
            'idnumber',
            'description'
        );
        $searchparam = '%' . $search . '%';
        foreach ($conditions as $key=>$condition) {
            $conditions[$key] = $DB->sql_like($condition,"?", false);
            $params[] = $searchparam;
        }
        $tests[] = '(' . implode(' OR ', $conditions) . ')';
    }
    $wherecondition = implode(' AND ', $tests);

    $fields = 'SELECT id, name, contextid, description';
    $countfields = 'SELECT COUNT(1)';
    $sql = " FROM {cohort}
             WHERE $wherecondition";
    $order = ' ORDER BY name ASC';
    $rs = $DB->get_recordset_sql($fields . $sql . $order, $params, $offset);

    // Produce the output respecting parameters
    foreach ($rs as $c) {
        // Track offset
        $offset++;
        // Check capabilities
        $context = get_context_instance_by_id($c->contextid);
        if (!has_capability('moodle/cohort:view', $context)) {
            continue;
        }
        if ($limit === 0) {
            // we have reached the required number of items and know that there are more, exit now
            $offset--;
            break;
        }
        $cohorts[$c->id] = array(
            'cohortid'=>$c->id,
            'name'=>  shorten_text(format_string($c->name), 35),
            'users'=>$DB->count_records('cohort_members', array('cohortid'=>$c->id)),
            'enrolled'=>in_array($c->id, $enrolled)
        );
        // Count items
        $limit--;
    }
    $rs->close();
    return array('more' => !(bool)$limit, 'offset' => $offset, 'cohorts' => $cohorts);
}
