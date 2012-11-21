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

require_once($CFG->dirroot . '/user/selector/lib.php');
require_once($CFG->dirroot.'/totara/cohort/lib.php');
require_once($CFG->dirroot.'/totara/cohort/rules/lib.php');

/**
 * Add new cohort.
 *
 * @param  object $cohort
 * @param bolean $addcollections indicate whether to add initial ruleset collections
 * @return int
 */
function cohort_add_cohort($cohort, $addcollections=true) {
    global $DB, $USER;

    if (!isset($cohort->name)) {
        throw new coding_exception(get_string('error:missingcohortname', 'totara_cohort'));
    }
    if (!isset($cohort->idnumber)) {
        $cohort->idnumber = NULL;
    }
    if (!isset($cohort->description)) {
        $cohort->description = $DB->sql_empty();
    }
    if (!isset($cohort->descriptionformat)) {
        $cohort->descriptionformat = FORMAT_HTML;
    }
    if (empty($cohort->component)) {
        $cohort->component = '';
    }
    //todo: Fix this :)
    $cohort->active = 1;

    $cohort->timecreated = time();
    $cohort->timemodified = $cohort->timecreated;
    $cohort->modifierid = $USER->id;

    $cohort->id = $DB->insert_record('cohort', $cohort);

    totara_cohort_increment_automatic_id($cohort->idnumber);

    if ($addcollections) {
        // Add initial collections
        $rulecol = new stdClass();
        $rulecol->cohortid = $cohort->id;
        $rulecol->status = COHORT_COL_STATUS_ACTIVE;
        $rulecol->timecreated = $rulecol->timemodified = $cohort->timecreated;
        $rulecol->modifierid = $USER->id;
        $activecolid = $DB->insert_record('cohort_rule_collections', $rulecol);

        unset($rulecol->id);
        $rulecol->status = COHORT_COL_STATUS_DRAFT_UNCHANGED;
        $draftcolid = $DB->insert_record('cohort_rule_collections', $rulecol);

        // Update cohort with new collections
        $cohortupdate = new stdClass;
        $cohortupdate->id = $cohort->id;
        $cohortupdate->activecollectionid = $cohort->activecollectionid = $activecolid;
        $cohortupdate->draftcollectionid = $cohort->draftcollectionid = $draftcolid;
        $DB->update_record('cohort', $cohortupdate);
    }

    events_trigger('cohort_added', $cohort);

    return $cohort->id;
}

/**
 * Update existing cohort.
 * @param  object $cohort
 * @return void
 */
function cohort_update_cohort($cohort) {
    global $DB, $USER;
    if (property_exists($cohort, 'component') and empty($cohort->component)) {
        // prevent NULLs
        $cohort->component = '';
    }
    if (isset($cohort->startdate) && empty($cohort->startdate)) {
        $cohort->startdate = null;
    }
    if (isset($cohort->enddate) && empty($cohort->enddate)) {
        $cohort->enddate = null;
    }

    //todo: Fix this :)
    $cohort->active = 1;

    $cohort->timemodified = time();
    $cohort->modifierid = $USER->id;
    $DB->update_record('cohort', $cohort);

    events_trigger('cohort_updated', $cohort);
}

/**
 * Delete cohort.
 * @param  object $cohort
 * @return void
 */
function cohort_delete_cohort($cohort) {
    global $DB;

    if ($cohort->component) {
        // TODO: add component delete callback
    }
    $transaction = $DB->start_delegated_transaction();
    $DB->delete_records('cohort_members', array('cohortid' => $cohort->id));
    $DB->delete_records('cohort', array('id' => $cohort->id));

    $collections = $DB->get_records('cohort_rule_collections', array('cohortid' => $cohort->id));

    foreach ($collections as $collection) {
        // Delete all rulesets, all the rules of each ruleset, and all the params of each rule
        $rulesets = $DB->get_records('cohort_rulesets', array('rulecollectionid' => $collection->id));
        if ($rulesets) {
            foreach ($rulesets as $ruleset) {
                $rules = $DB->get_records('cohort_rules', array('rulesetid' => $ruleset->id));
                if ($rules) {
                    foreach ($rules as $rule) {
                        $DB->delete_records('cohort_rule_params', array('ruleid' => $rule->id));
                    }
                    $DB->delete_records('cohort_rules', array('rulesetid' => $ruleset->id));
                }
            }
        }
        $DB->delete_records('cohort_rulesets', array('rulecollectionid' => $collection->id));
    }
    $DB->delete_records('cohort_rule_collections', array('cohortid' => $cohort->id));

    //delete associations
    $associations = totara_cohort_get_associations($cohort->id);
    foreach ($associations as $ass) {
        totara_cohort_delete_association($cohort->id, $ass->id, $ass->type);
    }

    $transaction->allow_commit();

    events_trigger('cohort_deleted', $cohort);
}

/**
 * Somehow deal with cohorts when deleting course category,
 * we can not just delete them because they might be used in enrol
 * plugins or referenced in external systems.
 * @param  object $category
 * @return void
 */
function cohort_delete_category($category) {
    global $DB;
    // TODO: make sure that cohorts are really, really not used anywhere and delete, for now just move to parent or system context

    $oldcontext = get_context_instance(CONTEXT_COURSECAT, $category->id, MUST_EXIST);

    if ($category->parent and $parent = $DB->get_record('course_categories', array('id'=>$category->parent))) {
        $parentcontext = get_context_instance(CONTEXT_COURSECAT, $parent->id, MUST_EXIST);
        $sql = "UPDATE {cohort} SET contextid = :newcontext WHERE contextid = :oldcontext";
        $params = array('oldcontext'=>$oldcontext->id, 'newcontext'=>$parentcontext->id);
    } else {
        $syscontext = get_context_instance(CONTEXT_SYSTEM);
        $sql = "UPDATE {cohort} SET contextid = :newcontext WHERE contextid = :oldcontext";
        $params = array('oldcontext'=>$oldcontext->id, 'newcontext'=>$syscontext->id);
    }

    $DB->execute($sql, $params);
}

/**
 * Add cohort member
 * @param  int $cohortid
 * @param  int $userid
 * @return void
 */
function cohort_add_member($cohortid, $userid) {
    global $DB;
    $record = new stdClass();
    $record->cohortid  = $cohortid;
    $record->userid    = $userid;
    $record->timeadded = time();
    $DB->insert_record('cohort_members', $record);

    events_trigger('cohort_member_added', (object)array('cohortid'=>$cohortid, 'userid'=>$userid));
}

/**
 * Remove cohort member
 * @param  int $cohortid
 * @param  int $userid
 * @return void
 */
function cohort_remove_member($cohortid, $userid) {
    global $DB;
    $DB->delete_records('cohort_members', array('cohortid'=>$cohortid, 'userid'=>$userid));

    events_trigger('cohort_member_removed', (object)array('cohortid'=>$cohortid, 'userid'=>$userid));
}

/**
 * Returns list of visible cohorts in course.
 *
 * @param  object $course
 * @param  bool $enrolled true means include only cohorts with enrolled users
 * @return array
 */
function cohort_get_visible_list($course) {
    global $DB, $USER;

    $context = get_context_instance(CONTEXT_COURSE, $course->id, MUST_EXIST);
    list($esql, $params) = get_enrolled_sql($context);
    $parentsql = get_related_contexts_string($context);

    $sql = "SELECT c.id, c.name, c.idnumber, COUNT(u.id) AS cnt
              FROM {cohort} c
              JOIN {cohort_members} cm ON cm.cohortid = c.id
              JOIN ($esql) u ON u.id = cm.userid
             WHERE c.contextid $parentsql
          GROUP BY c.id, c.name, c.idnumber
            HAVING COUNT(u.id) > 0
          ORDER BY c.name, c.idnumber";
    $params['ctx'] = $context->id;

    $cohorts = $DB->get_records_sql($sql, $params);

    foreach ($cohorts as $cid=>$cohort) {
        $cohorts[$cid] = format_string($cohort->name);
        if ($cohort->idnumber) {
            $cohorts[$cid] .= ' (' . $cohort->cnt . ')';
        }
    }

    return $cohorts;
}

/**
 * Get all the cohorts.
 *
 * @global moodle_database $DB
 * @param int $contextid
 * @param int $page number of the current page
 * @param int $perpage items per page
 * @param string $search search string
 * @return array    Array(totalcohorts => int, cohorts => array)
 */
function cohort_get_cohorts($contextid, $page = 0, $perpage = 25, $search = '') {
    global $DB;

    $cohorts = array();

    // Add some additional sensible conditions
    $tests = array();
    $params = array();
    if ($contextid) {
        $tests = array('contextid = ?');
        $params = array($contextid);
    }

    if (!empty($search)) {
        $conditions = array(
            'name',
            'idnumber',
            'description',
        );
        $searchparam = '%' . $DB->sql_like_escape($search) . '%';
        foreach ($conditions as $key => $condition) {
            $conditions[$key] = $DB->sql_like($condition, "?", false);
            $params[] = $searchparam;
        }
        $tests[] = '(' . implode(' OR ', $conditions) . ')';
    }
    $wherecondition = (empty($tests) ? '' : " WHERE " . implode(' AND ', $tests));

    $fields = 'SELECT *';
    $countfields = 'SELECT COUNT(1)';
    $sql = " FROM {cohort}
             $wherecondition";
    $order = ' ORDER BY name ASC';
    $totalcohorts = $DB->count_records_sql($countfields . $sql, $params);
    $cohorts = $DB->get_records_sql($fields . $sql . $order, $params, $page*$perpage, $perpage);

    return array('totalcohorts' => $totalcohorts, 'cohorts' => $cohorts);
}

/**
 * Print the tabs for an individual cohort
 * @param $currenttab string view, edit, viewmembers, editmembers, visiblelearning, enrolledlearning
 * @param $cohortid int
 * @param $cohorttype int
 */
function cohort_print_tabs($currenttab, $cohortid, $cohorttype, $cohort) {

    if ($cohort && totara_cohort_is_active($cohort)) {
        print html_writer::tag('div', '', array('class' => 'plan_box', 'style' => 'display:none;'));
    } else {
        if ($cohort->startdate && $cohort->startdate > time()) {
            $message = get_string('cohortmsgnotyetstarted', 'totara_cohort', userdate($cohort->startdate, get_string('strfdateshortmonth', 'langconfig')));
        }
        if ($cohort->enddate && $cohort->enddate < time()) {
            $message = get_string('cohortmsgalreadyended', 'totara_cohort', userdate($cohort->enddate, get_string('strfdateshortmonth', 'langconfig')));
        }
        print html_writer::tag('div', $message, array('class' => 'plan_box plan_box_action clearfix'));
    }

    // Setup the top row of tabs
    $inactive = NULL;
    $activetwo = NULL;
    $toprow = array();
    $systemcontext = context_system::instance();
    $canmanage = has_capability('moodle/cohort:manage', $systemcontext);
    $canmanagerules = has_capability('totara/cohort:managerules', $systemcontext);
    $canassign = has_capability('moodle/cohort:assign', $systemcontext);
    $canview = has_capability('moodle/cohort:view', $systemcontext);

    if ($canview) {

        $toprow[] = new tabobject('view', new moodle_url('/cohort/view.php', array('id' => $cohortid)),
                    get_string('overview','totara_cohort'));
    }

    if ($canmanage) {
        $toprow[] = new tabobject('edit', new moodle_url('/cohort/edit.php', array('id' => $cohortid)),
                    get_string('editdetails','totara_cohort'));
    }

    if ($canmanagerules && $cohorttype == cohort::TYPE_DYNAMIC) {
        $toprow[] = new tabobject(
            'editrules',
            new moodle_url('/totara/cohort/rules.php', array('id' => $cohortid)),
            get_string('editrules','totara_cohort')
        );
    }

    if ($canview) {
        $toprow[] = new tabobject('viewmembers', new moodle_url('/cohort/members.php', array('id' => $cohortid)),
            get_string('viewmembers','totara_cohort'));
    }

    if ($canassign && $cohorttype == cohort::TYPE_STATIC) {
        $toprow[] = new tabobject('editmembers', new moodle_url('/cohort/assign.php', array('id' => $cohortid)),
            get_string('editmembers','totara_cohort'));
    }

    if ($canview) {
        $toprow[] = new tabobject('enrolledlearning', new moodle_url('/totara/cohort/enrolledlearning.php', array('id' => $cohortid)),
            get_string('enrolledlearning', 'totara_cohort'));
    }

    $tabs = array($toprow);
    return print_tabs($tabs, $currenttab, $inactive, $activetwo, true);
}

/**
 * Cohort assignment candidates
 */
class cohort_candidate_selector extends user_selector_base {
    protected $cohortid;

    public function __construct($name, $options) {
        $this->cohortid = $options['cohortid'];
        parent::__construct($name, $options);
    }

    /**
     * Candidate users
     * @param <type> $search
     * @return array
     */
    public function find_users($search) {
        global $DB;
        //by default wherecondition retrieves all users except the deleted, not confirmed and guest
        list($wherecondition, $params) = $this->search_sql($search, 'u');
        $params['cohortid'] = $this->cohortid;

        $fields      = 'SELECT ' . $this->required_fields_sql('u');
        $countfields = 'SELECT COUNT(1)';

        $sql = " FROM {user} u
            LEFT JOIN {cohort_members} cm ON (cm.userid = u.id AND cm.cohortid = :cohortid)
                WHERE cm.id IS NULL AND $wherecondition";

        $order = ' ORDER BY u.lastname ASC, u.firstname ASC';

        if (!$this->is_validating()) {
            $potentialmemberscount = $DB->count_records_sql($countfields . $sql, $params);
            if ($potentialmemberscount > COHORT_MEMBER_SELECTOR_MAX_ROWS) {
                return $this->too_many_results($search, $potentialmemberscount);
            }
        }

        $availableusers = $DB->get_records_sql($fields . $sql . $order, $params);

        if (empty($availableusers)) {
            return array();
        }


        if ($search) {
            $groupname = get_string('potusersmatching', 'cohort', $search);
        } else {
            $groupname = get_string('potusers', 'cohort');
        }

        return array($groupname => $availableusers);
    }

    protected function get_options() {
        $options = parent::get_options();
        $options['cohortid'] = $this->cohortid;
        $options['file'] = 'cohort/lib.php';
        return $options;
    }
}

/**
 * Cohort assignment candidates
 */
class cohort_existing_selector extends user_selector_base {
    protected $cohortid;

    public function __construct($name, $options) {
        $this->cohortid = $options['cohortid'];
        parent::__construct($name, $options);
    }

    /**
     * Candidate users
     * @param <type> $search
     * @return array
     */
    public function find_users($search) {
        global $DB;
        //by default wherecondition retrieves all users except the deleted, not confirmed and guest
        list($wherecondition, $params) = $this->search_sql($search, 'u');
        $params['cohortid'] = $this->cohortid;

        $fields      = 'SELECT ' . $this->required_fields_sql('u');
        $countfields = 'SELECT COUNT(1)';

        $sql = " FROM {user} u
                 JOIN {cohort_members} cm ON (cm.userid = u.id AND cm.cohortid = :cohortid)
                WHERE $wherecondition";

        $order = ' ORDER BY u.lastname ASC, u.firstname ASC';

        if (!$this->is_validating()) {
            $potentialmemberscount = $DB->count_records_sql($countfields . $sql, $params);
            if ($potentialmemberscount > COHORT_MEMBER_SELECTOR_MAX_ROWS) {
                return $this->too_many_results($search, $potentialmemberscount);
            }
        }

        $availableusers = $DB->get_records_sql($fields . $sql . $order, $params);

        if (empty($availableusers)) {
            return array();
        }


        if ($search) {
            $groupname = get_string('currentusersmatching', 'cohort', $search);
        } else {
            $groupname = get_string('currentusers', 'cohort');
        }

        return array($groupname => $availableusers);
    }

    protected function get_options() {
        $options = parent::get_options();
        $options['cohortid'] = $this->cohortid;
        $options['file'] = 'cohort/lib.php';
        return $options;
    }
}
