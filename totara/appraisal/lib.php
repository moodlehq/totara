<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @package totara
 * @subpackage totara_appraisal
 */
require_once($CFG->dirroot.'/totara/core/lib.php');
require_once($CFG->dirroot.'/totara/question/lib.php');
require_once($CFG->dirroot.'/totara/appraisal/lib/assign/lib.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

class appraisal {
    /**
     * Appraisal Roles
     */
    const ROLE_LEARNER = 1;
    const ROLE_MANAGER = 2;
    const ROLE_TEAM_LEAD = 4;
    const ROLE_APPRAISER = 8;
    const ROLE_ADMINISTRATOR = 16; // Reserved. Not used for now.

    /**
     * Appraisal Access modifiers for roles
     */
    const ACCESS_CANVIEWOTHER = 1;
    const ACCESS_CANANSWER = 2;
    const ACCESS_MUSTANSWER = 6; // Includes appraisal::ACCESS_CANANSWER.

    /**
     * Appraisal status
     */
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_CLOSED = 2;
    const STATUS_COMPLETED = 3;

    /**
     * Appraisal id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * Status
     *
     * @var int
     */
    private $status = self::STATUS_DRAFT;

    /**
     * Appraisal activatied at timestamp
     *
     * @var int
     */
    protected $timestarted = null;

    /**
     * Appraisal closed or completed at timestamp
     *
     * @var int
     */
    protected $timefinished = null;

    /**
     * Appraisal name
     *
     * @var string
     */
    public $name = '';

    /**
     * Appraisal description
     *
     * @var string
     */
    public $description = '';

    /**
     * Create instance of appraisal
     *
     * @param int $id
     */
    public function __construct($id = 0) {
        if ($id) {
            $this->id = $id;
            $this->load();
        }
    }


    /**
     * Allow read access to restricted properties
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (in_array($name, array('id', 'status', 'timestarted', 'timefinished'))) {
            return $this->$name;
        }
    }


    /**
     * Set appraisal properties
     *
     * @param stdClass $todb
     * @return $this
     */
    public function set(stdClass $todb) {
        if (isset($todb->name)) {
            $this->name = $todb->name;
        }
        if (isset($todb->description)) {
            $this->description = $todb->description;
        }
        return $this;
    }


    /**
     * Get stdClass with appraisal properties
     *
     * @return stdClass
     */
    public function get() {
        $obj = new stdClass();
        $obj->name = $this->name;
        $obj->description = $this->description;
        $obj->timestarted = $this->timestarted;
        $obj->timefinished = $this->timefinished;
        $obj->status = $this->status;
        $obj->id = $this->id;

        return $obj;
    }


    /**
     * Saves current appraisal properties
     *
     * @param bool $override update the record even if it is not draft (allows changing status)
     * @return $this
     */
    public function save($override = false) {
        global $DB;

        $todb = $this->get();

        if ($this->id > 0) {
            if (!($override || self::is_draft($todb->id))) {
                throw new appraisal_exception('Cannot make changes to active appraisal');
            }

            $todb->id = $this->id;
            $DB->update_record('appraisal', $todb);
        } else {
            $this->id = $DB->insert_record('appraisal', $todb);
        }
        // Refresh data.
        $this->load($this->id);
        return $this;
    }


    /**
     * Reload appraisal properties from DB
     *
     * @return $this
     */
    public function load() {
        global $DB;
        $appraisal = $DB->get_record('appraisal', array('id' => $this->id));
        if (!$appraisal) {
            throw new appraisal_exception('Cannot load appraisal', 1);
        }
        $this->name = $appraisal->name;
        $this->description = $appraisal->description;
        $this->status = $appraisal->status;
        $this->timestarted = $appraisal->timestarted;
        $this->timefinished = $appraisal->timefinished;
        return $this;
    }


    /**
     * Set current status of appraisal
     *
     * @param int $status appraisal::STATUS_*
     */
    public function set_status($newstatus) {
        $allowedstatus = array(
            self::STATUS_ACTIVE => array(self::STATUS_CLOSED, self::STATUS_COMPLETED),
            self::STATUS_CLOSED => array(),
            self::STATUS_DRAFT => array(self::STATUS_ACTIVE),
            self::STATUS_COMPLETED => array()
        );
        if (!in_array($newstatus, $allowedstatus[$this->status])) {
            $a = new stdClass();
            $a->oldstatus = self::display_status($this->status);
            $a->newstatus = self::display_status($newstatus);
            throw new appraisal_exception(get_string('error:cannotchangestatus', 'totara_appraisal', $a));
        } else {
            $this->status = $newstatus;
            if ($newstatus == self::STATUS_COMPLETED || $newstatus == self::STATUS_CLOSED) {
                $this->timefinished = time();
            } else if ($newstatus == self::STATUS_ACTIVE) {
                $this->timefinished = null;
            }
            $this->save(true);
        }
    }


    /**
     * Activate or reactivate appraisal
     * This function doesn't check if appraisal is valid
     *
     * @param int $time set time of activation (default: current server time). This is only indication, activation is instant.
     */
    public function activate($time = 0) {
        global $DB;

        if (!self::is_draft($this->id)) {
            throw new appraisal_exception('Cannot make changes to active appraisal');
        }

        $assign = new totara_assign_appraisal('appraisal', $this);
        $assign->store_user_assignments();

        $this->create_answers_table();

        if (!$this->timestarted) {
            $time = ($time > 0) ? $time : time();
            $this->timestarted = $time;
        }

        // Set all users active stage id to first stage.
        $stages = appraisal_stage::get_stages($this->id);
        $DB->set_field('appraisal_user_assignment', 'activestageid', reset($stages)->id, array('appraisalid' => $this->id));

        $this->set_status(self::STATUS_ACTIVE);
        events_trigger('appraisal_activation', $this);
    }


    /**
     * Check if it is possible to activate appraisal
     *
     * @param int $time Estimate if appraisal is valid on given time (by default: current server time)
     * @return array with errors / empty if no errors
     */
    public function validate($time = null) {
        global $DB;

        if (is_null($time)) {
            $time = time();
        }
        $err = array();

        if (!in_array($this->status, array(self::STATUS_DRAFT))) {
            $err['roles'] = get_string('appraisalinvalid:status');
        }

        // Check that at least one role can answer at least on one question (this implies check on exstance of page and stage).
        $rolescananswer = $this->get_roles_involved(self::ACCESS_CANANSWER);
        if (empty($rolescananswer)) {
            $err['roles'] = get_string('appraisalinvalid:roles', 'totara_appraisal');
        }

        // Check that some learners are assigned.
        $assign = new totara_assign_appraisal('appraisal', $this);
        $learners = $assign->get_current_users();
        if (empty($learners)) {
            $err['learners'] = get_string('appraisalinvalid:learners','totara_appraisal');
        } else {

            // Check that all learners have managers/teamleads/appraisers as required.
            $rolesinvolved = $this->get_roles_involved();
            $allroles = $this->get_roles();
            $a = new stdClass();
            foreach ($learners as $learner) {

                foreach ($rolesinvolved as $role) {
                    $missing = false;
                    switch ($role) {
                        case appraisal::ROLE_MANAGER:
                            if (!totara_get_manager($learner->id)) {
                                $missing = true;
                            }
                            break;
                        case appraisal::ROLE_TEAM_LEAD:
                            if (!totara_get_teamleader($learner->id)) {
                                $missing = true;
                            }
                            break;
                        case appraisal::ROLE_APPRAISER:
                            if (!totara_get_appraiser($learner->id)) {
                                $missing = true;
                            }
                            break;
                        case appraisal::ROLE_LEARNER:
                            // We don't need to verify that the user exists.
                            break;
                    }

                    if ($missing) {
                        // Could pass list of usernames for users who are missing related role.
                        $user = $DB->get_record('user', array('id' => $learner->id), '*', MUST_EXIST);
                        $a->user = fullname($user);
                        $a->role = get_string($allroles[$role], 'totara_appraisal');
                        $err['missingrole' . $allroles[$role] . $learner->id] =
                            get_string('appraisalinvalid:missingrole', 'totara_appraisal', $a);
                    }
                }
            }
        }

        // Check that all stages are valid.
        $stages = appraisal_stage::fetch_appraisal($this->id);
        foreach ($stages as $stage) {
            $checkstage = new appraisal_stage($stage->id);
            $err += $checkstage->validate($time);
        }
        return $err;
    }


    /**
     * Close the appraisal.
     * Will send alerts to affected users if required.
     *
     * @param object $formdata
     */
    public function close($formdata) {
        global $DB;

        if (isset($formdata->sendalert) && $formdata->sendalert) {
            $alert = new stdClass();
            $alert->userfrom = generate_email_supportuser();
            $alert->fullmessageformat = FORMAT_HTML;
            $formdata->alertbody = $formdata->alertbody_editor['text'];

            // Send message to learners.
            $alert->subject = $formdata->alerttitle;
            $alert->fullmessage = $formdata->alertbody;
            $alert->fullmessagehtml = $alert->fullmessage;

            $learners = $DB->get_records('appraisal_user_assignment',
                    array('appraisalid' => $formdata->id, 'timecompleted' => null), null, 'userid AS id');

            foreach ($learners as $learner) {
                $alert->userto = $learner;
                tm_alert_send($alert);
            }

            // Send message to role users (other than learners, and only one message per user).
            $alert->subject = get_string('closealerttitledefault', 'totara_appraisal', $this);

            // Find all users in roles that are not learner, who have a learner who is not finished.
            $sql = 'SELECT ara.userid AS id,
                           ' . sql_group_concat($DB->sql_fullname('user.firstname', 'user.lastname')) . ' AS staff
                      FROM {appraisal_user_assignment} aua
                      JOIN {appraisal_role_assignment} ara
                        ON aua.id = ara.appraisaluserassignmentid
                      JOIN {user} user
                        ON aua.userid = user.id
                     WHERE aua.timecompleted IS NULL
                       AND aua.appraisalid = ?
                       AND ara.appraisalrole != ?
                     GROUP BY ara.userid';

            $roleusers = $DB->get_records_sql($sql, array($formdata->id, self::ROLE_LEARNER));

            foreach ($roleusers as $roleuser) {
                $formdata->staff = $roleuser->staff;
                $alert->fullmessage = get_string('closealertadminbody', 'totara_appraisal', $formdata);
                $alert->fullmessagehtml = $alert->fullmessage;
                $alert->userto = $roleuser;
                tm_alert_send($alert);
            }
        }

        $this->set_status(self::STATUS_CLOSED);
    }


    /**
     * Save answers on appraisal.
     *
     * @param stdClass $formdata
     * @param object $userassignment
     * @param object $roleassignment
     * @param bool $updateprogress false if we just want to save the data without trying to update the progress.
     * @return bool true if answers accepted
     */
    public function save_answers(stdClass $formdata, $userassignment, $roleassignment, $updateprogress = true) {
        global $DB;
        $pageid = $formdata->pageid;
        $page = new appraisal_page($pageid);
        $stage = new appraisal_stage($page->appraisalstageid);

        if (!$roleassignment) {
            return false;
        }

        // Get data to save.
        if ($stage->is_locked($userassignment, $roleassignment)) {
            return false;
        }
        $answers = $page->answers_export($formdata, $roleassignment);
        // Save.
        $questdata = $DB->get_record('appraisal_quest_data_'.$this->id, array('appraisalroleassignmentid' => $roleassignment->id));
        if (!$questdata) {
            $answers->appraisalroleassignmentid = $roleassignment->id;
            $DB->insert_record('appraisal_quest_data_'.$this->id, $answers);
        } else {
            $answers_array = get_object_vars($answers); //Create an array so we can check if its empty
            if (!empty($answers_array)) {
                $answers->id = $questdata->id;
                // This db call fails if there are no answers found (page with only info, no user input)
                $DB->update_record('appraisal_quest_data_'.$this->id, $answers);
            }
        }

        if ($updateprogress) {
            // Check if page is valid and user wants to go to next page.
            if (($formdata->submitaction == 'next') || ($formdata->submitaction == 'completestage')) {
                // Mark the page as complete for the given role.
                $roleisfinishedstage = $page->complete_for_role($roleassignment);
            }

            // Check if user wants to complete the stage.
            if (($formdata->submitaction == 'completestage') && $roleisfinishedstage) {
                // Mark the stage as complete for the given role.
                $stage->complete_for_role($roleassignment);
            }
        }

        return true;
    }


    /**
     * Get exisitng answers for current appraisal role assignment
     * @param stdClass $roleassignment
     * @return type description
     */
    public function get_answers(stdClass $roleassignment) {
        global $DB;
        $questdata = $DB->get_record('appraisal_quest_data_'.$this->id, array('appraisalroleassignmentid' => $roleassignment->id));
        if ($questdata) {
            return $this->import_answers($questdata, $roleassignment);
        }
        return null;
    }


    /**
     * Import answer
     * @param stdClass $questdata
     * @param stdClass $roleassignment
     * @return stdClass
     */
    public function import_answers(stdClass $questdata, stdClass $roleassignment) {
        $questionsrs = appraisal_question::fetch_appraisal($this->id);
        $questionman = appraisal_question::get_manager($roleassignment->subjectid, $roleassignment->id);
        $answers = new stdClass();
        foreach ($questionsrs as $questionrecord) {
            $question = $questionman->get_element($questionrecord);
            $answers = $question->set_as_db($questdata)->get_as_form($answers, true);
        }
        return $answers;
    }


    /**
     * Is appraisal locked for data entry.
     *
     * @param object $userassignment
     * @return bool
     */
    public function is_locked($userassignment = null) {
        // We don't check for STATUS_DRAFT because we don't want it locked while previewing.
        if (($this->status == self::STATUS_CLOSED) || ($this->status == self::STATUS_COMPLETED)) {
            return true;
        }
        return isset($userassignment) && isset($userassignment->timecompleted);
    }


    /**
     * Mark the appraisal as complete for the given user.
     * Then check if all users are complete and if so then mark this appraisal as complete.
     *
     * @param int $subjectid
     */
    public function complete_for_user($subjectid) {
        global $DB;

        // Mark the user as complete for this appraisal.
        $DB->set_field('appraisal_user_assignment', 'timecompleted', time(),
                array('userid' => $subjectid, 'appraisalid' => $this->id));

        // Check if all users are complete.
        $unfinished = $DB->count_records('appraisal_user_assignment',
                array('appraisalid' => $this->id, 'timecompleted' => null));
        if (!$unfinished) {
            // Mark this appraisal as complete.
            $this->complete();
        }
    }


    /**
     * Mark this appraisal as complete.
     */
    public function complete() {
        $this->set_status(self::STATUS_COMPLETED);
    }


    /**
     * Get appraisal role assignment for assigned subject user and user giving answers in the given role.
     * If previewing then create a template role assignment object.
     *
     * @param int $subjectid
     * @param int $userid of the role user
     * @param int $role
     * @param bool $preview
     * @return object role assignment record
     */
    public function get_role_assignment($subjectid, $userid, $role, $preview = false) {
        global $DB;

        if ($preview) {
            $roleassignment = new stdClass();
            $roleassignment->id = $role;
            $roleassignment->appraisaluserassignmentid = 0;
            $roleassignment->userid = $userid;
            $roleassignment->appraisalrole = $role;
            $roleassignment->activepageid = 0;
            $roleassignment->subjectid = $subjectid;
            return $roleassignment;
        }

        $sql = 'SELECT ara.id, ara.activepageid, ara.appraisalrole, ara.userid, ara.appraisaluserassignmentid,
                       aua.userid AS subjectid
                FROM {appraisal_role_assignment} ara
                JOIN {appraisal_user_assignment} aua
                  ON ara.appraisaluserassignmentid = aua.id
               WHERE aua.appraisalid = ?
                 AND aua.userid = ?
                 AND ara.userid = ?
                 AND ara.appraisalrole = ?';
        $roleassignment = $DB->get_record_sql($sql, array($this->id, $subjectid, $userid, $role));
        return $roleassignment;
    }


    /**
     * Checks if the role user has permission to view this appraisal for this subject.
     */
    public function can_access($roleassignment) {
        // TODO view staff appraisals capability can be extended here.
        return (bool)$roleassignment;
    }


    /**
     * Get appraisal role assignments for assigned subject user.
     * If previewing then create a template role assignment objects.
     * If not previewing then the records must exist.
     *
     * @param int $subjectid
     * @param bool $preview
     * @return array as role => stdClass role assignment record
     */
    public function get_all_assignments($subjectid, $preview = false) {
        global $USER, $DB;

        $assignments = array();
        if ($preview) {
            $roles = self::get_roles();
            foreach ($roles as $role => $name) {
                $assignments[$role] = $this->get_role_assignment($subjectid, $USER->id, $role, $preview);
            }
        } else {
            $sql = 'SELECT ara.appraisalrole, ara.id, ara.userid, ara.appraisaluserassignmentid, aua.userid AS subjectid
                    FROM {appraisal_role_assignment} ara
                    JOIN {appraisal_user_assignment} aua
                      ON ara.appraisaluserassignmentid = aua.id
                   WHERE aua.appraisalid = ?
                     AND aua.userid = ?';
            $assignments = $DB->get_records_sql($sql, array($this->id, $subjectid));
        }
        return $assignments;
    }


    /**
     * Return array of roles involved in current appraisal
     *
     * @param int $rights count only roles that have certain rights
     * @return array of appraisalrole
     */
    public function get_roles_involved($rights = 0) {
        global $DB;

        $sqlrights ='';
        $params = array($this->id);
        if ($rights > 0) {
            $sqlrights = ' AND (aqfr.rights & ? ) = ? ';
            $params[] = $rights;
            $params[] = $rights;
        }
        $sql = "SELECT DISTINCT aqfr.appraisalrole
                  FROM {appraisal_stage} ast
                  LEFT JOIN {appraisal_stage_page} asp
                    ON asp.appraisalstageid = ast.id
                  LEFT JOIN {appraisal_quest_field} aqf
                    ON aqf.appraisalstagepageid = asp.id
                  LEFT JOIN {appraisal_quest_field_role} aqfr
                    ON aqfr.appraisalquestfieldid = aqf.id AND aqfr.rights > 0
                 WHERE ast.appraisalid = ? {$sqlrights}
                 ORDER BY aqfr.appraisalrole";
        $rolesrecords = $DB->get_records_sql($sql, $params);

        $out = array();
        foreach ($rolesrecords as $rolerecord) {
            $out[$rolerecord->appraisalrole] = 1;
        }
        return array_keys($out);
    }


    /**
     * Create answers table
     */
    private function create_answers_table() {
        global $DB;

        if ($this->id < 1) {
            throw new appraisal_exception('Appraisal must be saved before creating answers table', 4);
        }

        $tablename = 'appraisal_quest_data_'.$this->id;
        $table = new xmldb_table($tablename);

        // Appraisal specific fields/keys/indexes.
        $xmldb = array();
        $xmldb[] = new xmldb_field('id', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, XMLDB_NOTNULL, XMLDB_SEQUENCE);
        $xmldb[] = new xmldb_field('timecompleted', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, null, null, 0);
        $xmldb[] = new xmldb_field('appraisalroleassignmentid', XMLDB_TYPE_INTEGER, 10, XMLDB_UNSIGNED, XMLDB_NOTNULL);
        // Appraisal keys.
        $xmldb[] = new xmldb_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $xmldb[] = new xmldb_key('apprquestdata_approlass'.$this->id.'_fk', XMLDB_KEY_FOREIGN, array('appraisalroleassignmentid'),
            'appraisal_role_assignment', array('id'));

        // Question specific fields/keys/indexes.
        $questions = appraisal_question::fetch_appraisal($this->id);
        $questionman = appraisal_question::get_manager();
        $questxmldb = $questionman->get_xmldb($questions);
        $allfields = array_merge($xmldb, $questxmldb);

        foreach ($allfields as $field) {
            if ($field instanceof xmldb_field) {
                $table->addField($field);
            } else if ($field instanceof xmldb_key) {
                $table->addKey($field);
            } else if ($field instanceof xmldb_index) {
                $table->addIndex($field);
            }
        }

        $dbman = $DB->get_manager();
        $dbman->create_table($table);
    }


    /**
     * Save snapshot
     *
     * @param string $filepath snapshot /path/filename.pdf
     * @param int $roleassignmentid snapshot role assignment id
     * @param int $time timestamp
     */
    public function save_snapshot($filepath, $roleassignmentid, $time = 0) {
        global $DB, $USER;
        if (!$time) {
            $time = time();
        }
        // Put file into storage.
        $context = context_system::instance();
        $fs = get_file_storage();
        $filename = basename($filepath);

        $meta = array('contextid' => $context->id, 'component' => 'totara_appraisal', 'filearea' => 'snapshot_'.$this->id,
            'itemid' => $roleassignmentid, 'filepath' => '/', 'filename' => $filename, 'timecreated' => $time,
            'userid' => $USER->id);
        $file = $fs->create_file_from_pathname($meta, $filepath);

        return moodle_url::make_pluginfile_url($context->id, 'totara_appraisal', 'snapshot_'.$this->id, $roleassignmentid, '/',
                    $file->get_filename(), true);
    }

    /**
     * Get list of all snapshots
     *
     * @param int $appraisalid
     * @param int $roleassignmentid snapshot role assignment id
     * @return array of stdClass snapshotdata
     */
    public static function list_snapshots($appraisalid, $roleassignmentid) {
        $roleassignmentid = ($roleassignmentid) ? $roleassignmentid : false;

        $fs = get_file_storage();
        $context = context_system::instance();

        $files = $fs->get_area_files($context->id, 'totara_appraisal', 'snapshot_'.$appraisalid, $roleassignmentid, 'timecreated',
                false);

        $snapshots = array();
        foreach ($files as $file) {
            $snapshot = new stdClass();
            $snapshot->url = moodle_url::make_pluginfile_url($context->id, 'totara_appraisal', 'snapshot_'.$appraisalid,
                    $roleassignmentid, '/', $file->get_filename(), true);
            $snapshot->filename = $file->get_filename();
            $snapshot->time = userdate($file->get_timecreated(), get_string('strftimedatetimeshort', 'langconfig'));
            $snapshots[] = $snapshot;

        }
        return $snapshots;
    }
    /**
     * Delete all snapshots related to appraisal
     *
     * @param int $id
     * @return stdClass
     */
    public function delete_all_snapshots() {
        global $DB;
        $context = context_system::instance();
        $fs = get_file_storage();
        $fs->delete_area_files($context->id, 'totara_appraisal', 'snapshot_', $this->id);
    }

    /**
     * Delete the whole appraisal
     */
    public function delete() {
        global $DB;

        // Set status to draft so that is_locked will return false and thus allow deletion.
        // We don't use appraisal->set_status() because it normally doesn't allow changing to draft status.
        $this->status = self::STATUS_DRAFT;
        $this->save(true);

        // Remove question data table.
        sql_drop_table_if_exists('{appraisal_quest_data_' . $this->id . '}');

        // Remove assignments.
        $assign = new totara_assign_appraisal('appraisal', $this);
        $assign->delete();

        // Remove all stages.
        $stages = appraisal_stage::fetch_appraisal($this->id);
        foreach ($stages as $stage) {
            appraisal_stage::delete($stage->id);
        }

        // Remove event messages.
        appraisal_message::delete_appraisal($this->id);

        // Remove snapshots
        $this->delete_all_snapshots();
        // Remove appraisal.
        $DB->delete_records('appraisal', array('id' => $this->id));
    }


    /**
     * Check if appraisal is in draft state
     *
     * @param mixed $appraisal appraisal.id or instance of appraisal
     * @return bool
     */
    public static function is_draft($appraisal) {
        if (is_numeric($appraisal)) {
            $appraisal = new appraisal($appraisal);
        }
        if (!($appraisal instanceof appraisal)) {
            throw new appraisal_exception('Appraisal object not found', 2);
        }
        return ($appraisal->status == self::STATUS_DRAFT);
    }


    /**
     * Get all individual roles supported by system (except two: 'Administrator' is reserved, 'All' is not a role.)
     *
     * @return array(appraisal::ROLE_* => 'display name', ...)
     */
    public static function get_roles() {
        $roles = array(
            self::ROLE_LEARNER => 'rolelearner',
            self::ROLE_MANAGER => 'rolemanager',
            self::ROLE_TEAM_LEAD => 'roleteamlead',
            self::ROLE_APPRAISER => 'roleappraiser'
            );
        return $roles;
    }


    /**
     * Get the user assignment record.
     * If previewing then create a template user assignment object.
     *
     * @param int $userid
     * @param bool $preview
     * @return object user assignment record
     */
    public function get_user_assignment($userid, $preview = false) {
        global $DB;

        if ($preview) {
            $userassignment = new stdClass();
            $userassignment->id = 0;
            $userassignment->userid = $userid;
            $userassignment->appraisalid = $this->id;
            $userassignment->assignedvia = 'Preview';
            $userassignment->activestageid = null;
            $userassignment->timecompleted = null;
            return $userassignment;
        }

        $userassignment = $DB->get_record('appraisal_user_assignment', array('userid' => $userid, 'appraisalid' => $this->id));
        return $userassignment;
    }


    /**
     * Get status name
     *
     * @param int $status
     * @return string
     */
    public static function display_status($status) {
        $result = '';
        switch ($status) {
            case self::STATUS_ACTIVE:
                $result = get_string('active', 'totara_appraisal');
                break;
            case self::STATUS_DRAFT:
                $result = get_string('draft', 'totara_appraisal');
                break;
            case self::STATUS_CLOSED:
                $result = get_string('closed', 'totara_appraisal');
                break;
            case self::STATUS_COMPLETED:
                $result = get_string('completed', 'totara_appraisal');
                break;
        }
        return $result;
    }


    /**
     * Get active appraisals assigned to user (where user is a subject of appraisal)
     *
     * @param string $fields Fields list
     * @param int $userid
     * @return array of stdClass
     */
    public static function fetch_own($fields = '', $userid = null) {
        global $DB, $USER;

        if (!$userid) {
            $userid = $USER->id;
        }

        if ($fields == '') {
            $fields = 'a.*';
        }

        $sql = "SELECT {$fields}
                FROM {appraisal} a LEFT JOIN {appraisal_user_assignment} aua ON (aua.appraisalid = a.id)
                WHERE (a.status = ? OR a.status = ?) AND aua.userid = ?";
        $appraisals = $DB->get_records_sql($sql, array(self::STATUS_ACTIVE, self::STATUS_COMPLETED, $userid));
        return $appraisals;
    }


    /**
     * Get active appraisals assigned to user for answering/reviewing
     *
     * @param string $fields Fields list
     * @param int $userid
     * @return array of stdClass
     */
    public static function fetch_staff($fields = '', $userid = null) {
        global $DB, $USER;

        if (!$userid) {
            $userid = $USER->id;
        }

        if ($fields == '') {
            $fields = 'a.*';
        }

        $sql = "SELECT DISTINCT {$fields}
                  FROM {appraisal} a
                  JOIN {appraisal_user_assignment} aua
                    ON aua.appraisalid = a.id
                  JOIN {appraisal_role_assignment} ara
                    ON ara.appraisaluserassignmentid = aua.id
                 WHERE (a.status = ? OR a.status = ?)
                   AND ara.userid = ?";
        $appraisals = $DB->get_records_sql($sql, array(self::STATUS_ACTIVE, self::STATUS_COMPLETED, $userid));
        return $appraisals;
    }


    /**
     * Get all appraisals
     *
     * @param string $fields Fields list
     * @return array of stdClass
     */
    public static function fetch_all($fields = '*') {
        global $DB;
        $appraisals = $DB->get_records('appraisal', null, '', $fields);
        return $appraisals;
    }


    /**
     * Count user own appraisals
     *
     * @param int $userid
     * @return int
     */
    public static function count_own($userid = null) {
        $appraisals = self::fetch_own('count(*) AS cnt', $userid);
        return count($appraisals) ? current($appraisals)->cnt : 0;
    }


    /**
     * Count user staff appraisals
     *
     * @param int $userid
     * @return int
     */
    public static function count_staff($userid = null) {
        $appraisals = self::fetch_staff('count(*) AS cnt', $userid);
        return count($appraisals) ? current($appraisals)->cnt : 0;
    }


    /**
     * Count all appraisals
     *
     * @return int
     */
    public static function count_all() {
        $appraisals = self::fetch_all('count(*) AS cnt');
        return count($appraisals) ? current($appraisals)->cnt : 0;
    }


    /**
     * Check if user has access at least to one existant appraisal (own, staff or any if admin)
     *
     * @param int $userid
     * @return bool
     */
    public static function has_appraisal($userid = null) {
        global $USER;

        if (!$userid) {
            $userid = $USER->id;
        }

        return self::count_own($userid) || self::count_staff($userid);
    }


    /**
     * Check if user has access at least to one appraisal as a learner.
     *
     * @param int $userid
     * @return bool
     */
    public static function has_own_appraisal($userid = null) {
        global $USER;

        if (!$userid) {
            $userid = $USER->id;
        }

        return self::count_own($userid);
    }


    /**
     * Get the latest appraisal for the given subject.
     * Note: Prioritises active over inactive.
     *
     * @param int $subjectid
     */
    public static function get_latest($subjectid) {
        global $DB;

        $sql = "SELECT aua.appraisalid, aua.timecompleted, app.timestarted
                  FROM {appraisal_user_assignment} aua
                  JOIN {appraisal} app
                    ON aua.appraisalid = app.id
                 WHERE aua.userid = ?
              ORDER BY aua.timecompleted, app.timestarted DESC";
        $results = $DB->get_records_sql($sql, array($subjectid));

        if (!$results) {
            throw new moodle_exception('error:subjecthasnoappraisals');
        }
        return new appraisal(reset($results)->appraisalid);
    }


    /**
     * Get list of appraisals with their start dates and due dates.
     * Those that the subject has not completed and are active are listed first.
     *
     * @param int $subjectid
     * @param int $role
     * @param array $status
     * @return array
     */
    public static function get_user_appraisals($subjectid, $role, $status = array()) {
        global $DB, $USER;
        $params = array($USER->id, $role);
        $sql = 'SELECT ' . $DB->sql_concat(sql_cast2char('a.id'), "'_'", sql_cast2char('aua.userid')) . ' AS uniqueid,
                       a.id, aua.userid, a.name, a.timestarted, a.status, MAX(ast.timedue) AS timedue, aua.timecompleted,
                       ara.id as roleassignmentid
                  FROM {appraisal} a
                  JOIN {appraisal_user_assignment} aua
                    ON (aua.appraisalid = a.id)
                  JOIN {appraisal_role_assignment} ara
                    ON (ara.appraisaluserassignmentid = aua.id)
                  LEFT JOIN {appraisal_stage} ast ON (ast.appraisalid = a.id)
                 WHERE ara.userid = ?
                   AND ara.appraisalrole = ?';
        if ($subjectid != $USER->id) {
            $sql .= ' AND aua.userid = ?';
            $params[] = $subjectid;
        }
        if ($status) {
            list($sqlstatus, $paramstatus) = $DB->get_in_or_equal($status);
            $sql .= ' AND a.status ' . $sqlstatus;
            $params = array_merge($params, $paramstatus);
        }
        $sql .= ' GROUP BY a.id, aua.userid, a.name, a.timestarted, a.status, aua.timecompleted, ara.id
                  ORDER BY CASE WHEN aua.timecompleted IS NULL AND a.status = ? THEN 0 ELSE 1 END, a.timestarted DESC';
        $params[] = self::STATUS_ACTIVE;
        $appraisals = $DB->get_records_sql($sql, $params);
        return $appraisals;
    }


    /**
     * Get array of appraisals with their start dates and number of learners
     *
     * @return array
     */
    public static function get_manage_list() {
        global $DB;

        $sql = 'SELECT a.id, a.name, a.timestarted, a.status, COUNT(aua.id) as lnum
                FROM {appraisal} a
                LEFT JOIN {appraisal_user_assignment} aua ON (aua.appraisalid = a.id)
                GROUP BY a.id, a.name, a.timestarted, a.status
                ORDER BY a.status, a.timestarted DESC, a.name, a.id';
        $appraisals = $DB->get_records_sql($sql);

        foreach ($appraisals as $appraisal) {
            if ($appraisal->status == self::STATUS_DRAFT) {
                $assign = new totara_assign_appraisal('appraisal', new appraisal($appraisal->id));
                $appraisal->lnum = $assign->get_current_users(null, null, null, true);
            }
        }
        return $appraisals;
    }


    /**
     * Clone appraisal
     *
     * @param int $appraisalid
     * @param int $daysoffset number of days to add to each stage time due.
     * @return
     */
    public static function duplicate_appraisal($appraisalid, $daysoffset = 0) {
        global $DB;

        // Clone the appraisal and set it to draft.
        $appraisal = new appraisal($appraisalid);
        $appraisal->id = 0;
        $appraisal->status = self::STATUS_DRAFT;
        $appraisal->timestarted = null;
        $appraisal->timefinished = null;
        $newappraisal = $appraisal->save();

        // Clone stages (which will clone pages and questions).
        $stages = $DB->get_records('appraisal_stage', array('appraisalid' => $appraisalid));
        foreach ($stages as $stagerecord) {
            $stage = new appraisal_stage($stagerecord->id);

            $stage->duplicate($newappraisal->id, $daysoffset);
        }

        // Clone assigned groups (since the new appraisal is draft, we don't need to clone user or role assignments).
        $assign = new totara_assign_appraisal('appraisal', new appraisal($appraisalid));
        $assign->duplicate($newappraisal);

        // Clone events.
        appraisal_message::duplicate_appraisal($appraisalid, $newappraisal->id);

        return $newappraisal;
    }


    /**
     * Build all appraisal components according given definition
     * Used in example appraisal preparation and testing
     *
     * @param array $def definition
     * @return appraisal
     */
    public static function build(array $def) {
        $appraisal = new appraisal();
        $appraisal->name = $def['name'];
        $appraisal->description = isset($def['description']) ? $def['description'] : '';
        $appraisal->save();

        if (isset($def['stages'])) {
            foreach ($def['stages'] as $stage) {
                appraisal_stage::build($stage, $appraisal->id);
            }
        }
        return $appraisal;
    }


    /**
     * Get list of active appraisals with additional statistics.
     *
     * @return array
     */
    public static function get_active_with_stats() {
        global $DB;

        $sql = 'SELECT app.*,
                       userstotal.userstotal,
                       userscomplete.userscomplete,
                       usersoverdue.usersoverdue
                  FROM {appraisal} app
                  LEFT JOIN (SELECT COUNT(aua.userid) AS userstotal, aua.appraisalid
                               FROM {appraisal_user_assignment} aua
                              GROUP BY aua.appraisalid) userstotal
                    ON app.id = userstotal.appraisalid
                  LEFT JOIN (SELECT COUNT(aua.userid) AS userscomplete, aua.appraisalid
                               FROM {appraisal_user_assignment} aua
                              WHERE aua.timecompleted IS NOT NULL
                              GROUP BY aua.appraisalid) userscomplete
                    ON app.id = userscomplete.appraisalid
                  LEFT JOIN (SELECT COUNT(aua.userid) AS usersoverdue, ast.appraisalid
                               FROM {appraisal_user_assignment} aua
                               JOIN {appraisal_stage} ast
                                 ON aua.activestageid = ast.id
                              WHERE aua.timecompleted IS NULL
                                AND ast.timedue < ?
                              GROUP BY ast.appraisalid) usersoverdue
                    ON app.id = usersoverdue.appraisalid
                 WHERE app.status = ?';
        $appraisals = $DB->get_records_sql($sql, array(time(), self::STATUS_ACTIVE));

        return $appraisals;
    }


    /**
     * Get list of inactive appraisals with additional statistics.
     *
     * @return array
     */
    public static function get_inactive_with_stats() {
        global $DB;

        $sql = 'SELECT app.id, app.name, app.status, app.timefinished,
                       COUNT(aua.timecompleted) AS userscomplete, COUNT(aua.id) AS userstotal
                  FROM {appraisal} app
                  JOIN {appraisal_user_assignment} aua
                    ON app.id = aua.appraisalid
                 WHERE app.status IN (?, ?)
                 GROUP BY app.id, app.name, app.status, app.timefinished';

        return $DB->get_records_sql($sql, array(self::STATUS_CLOSED, self::STATUS_COMPLETED));
    }

}


/**
 * Stage within appraisal
 */
class appraisal_stage {
    /**
     * Appraisal stage id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * Appraisal id that this stage is related to
     *
     * @var type
     */
    public $appraisalid = null;

    /**
     * Stage name
     *
     * @var string
     */
    public $name = '';

    /**
     * Stage description
     *
     * @var string
     */
    public $description = '';

    /**
     * Completion date
     *
     * @var int
     */
    public $timedue = null;

    /**
     * Roles lock on complete settings
     * Key is appraisal::ROLE_* code, value 1/0
     *
     * @var array of roles objects
     */
    protected $locks = array();

    /**
     * Create instance of appraisal stage
     *
     * @param int $id
     */
    public function __construct($id = 0) {
        if ($id) {
            $this->id = $id;
            $this->load();
        }
    }


    /**
     * Allow read access to restricted properties
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (in_array($name, array('id'))) {
            return $this->$name;
        }
    }


    /**
     * Set stage properties
     *
     * @param stdClass $todb
     * @return $this
     */
    public function set(stdClass $todb) {
        if (is_null($this->appraisalid) && isset($todb->appraisalid)) {
            $this->appraisalid = $todb->appraisalid;
        }
        if (isset($todb->name)) {
            $this->name = $todb->name;
        }
        if (isset($todb->description)) {
            $this->description = $todb->description;
        }
        if (isset($todb->timedue)) {
            $this->timedue = $todb->timedue;
        }
        // Set roles that should be locked on stage completion.
        if (isset($todb->locks)) {
            $roles = appraisal::get_roles();
            foreach ($roles as $role => $rolename) {
                if (isset($todb->locks[$role])) {
                    $this->locks[$role] = $todb->locks[$role];
                }
            }
        }
        return $this;
    }


    /**
     * Get stdClass with stage properties
     *
     * @return stdClass
     */
    public function get() {
        $obj = new stdClass();
        $obj->id = $this->id;
        $obj->appraisalid = $this->appraisalid;
        $obj->name = $this->name;
        $obj->description = $this->description;
        $obj->timedue = $this->timedue;

        // Get roles that should be locked on stage completion.
        $obj->locks = $this->locks;

        return $obj;
    }


    /**
     * Saves current stage properties
     *
     * @return $this
     */
    public function save() {
        global $DB;

        $todb = $this->get();

        if ($todb->appraisalid < 1) {
            throw new appraisal_exception('Stage must belong to an appraisal', 12);
        }

        if (!appraisal::is_draft($todb->appraisalid)) {
            throw new appraisal_exception('Cannot change stage of active appraisal');
        }

        if (!$todb->timedue) {
            $todb->timedue = null;
        }
        if ($this->id > 0) {
            $todb->id = $this->id;
            $DB->update_record('appraisal_stage', $todb);
        } else {
            $this->id = $DB->insert_record('appraisal_stage', $todb);
        }
        // Save roles that should be locked on stage completion.
        $this->save_locks();
        // Refresh data.
        $this->load($this->id);
        return $this;
    }


    /**
     * Reload appraisal stage properties from DB
     *
     * @return $this
     */
    public function load() {
        global $DB;
        $stage = $DB->get_record('appraisal_stage', array('id' => $this->id));
        if (!$stage) {
            throw new appraisal_exception('Cannot load appraisal stage', 11);
        }
        $this->appraisalid = $stage->appraisalid;
        $this->name = $stage->name;
        $this->description = $stage->description;
        $this->timedue = $stage->timedue;
        $this->load_locks();
        return $this;
    }


    /**
     * Clone an appraisal stage
     *
     * @param int $appraisalid The new appraisal id to assign to stage
     * @param int number of days to add to time due.
     * @return appraisal_stage
     */
    public function duplicate($appraisalid, $daysoffset = 0) {
        global $DB;

        // Get pages for current stage.
        $pages = $DB->get_records('appraisal_stage_page', array('appraisalstageid' => $this->id), 'sortorder');

        // Clone stage.
        $srcstageid = $this->id;
        $this->id = 0;
        $this->appraisalid = $appraisalid;
        $this->timedue += $daysoffset * 24 * 60 * 60;
        $newstage = $this->save();

        // Clone pages
        foreach ($pages as $pagerecord) {
            $page = new appraisal_page($pagerecord->id);
            $page->duplicate($newstage->id);
        }

        // Clone events.
        appraisal_message::duplicate_stage($srcstageid, $newstage->id, $appraisalid);

        return $newstage;
    }


    /**
     * Load stage roles permissions/settings from DB
     *
     * @return $this
     */
    protected function load_locks() {
        global $DB;

        $rolesdb = $DB->get_records('appraisal_stage_role_setting', array('appraisalstageid' => $this->id));
        $this->locks = array();
        if ($rolesdb) {
            foreach ($rolesdb as $role) {
                $this->locks[$role->appraisalrole] = $role->locked;
            }
        }

        return $this;
    }


    /**
     * Save locks for roles
     *
     * @return $this
     */
    protected function save_locks() {
        global $DB;

        if (!appraisal::is_draft($this->appraisalid)) {
            throw new appraisal_exception('Cannot change stage of active appraisal');
        }

        $roles = appraisal::get_roles();
        foreach ($roles as $role => $rolename) {
            if (isset($this->locks[$role]) && $this->locks[$role] > 0) {
                $dbrole = $DB->get_record('appraisal_stage_role_setting',
                        array('appraisalstageid' => $this->id, 'appraisalrole' => $role));
                if (!$dbrole) {
                    $dbrole = new stdClass();
                    $dbrole->appraisalstageid = $this->id;
                    $dbrole->appraisalrole = $role;
                    $dbrole->locked = $this->locks[$role];
                    $DB->insert_record('appraisal_stage_role_setting', $dbrole);
                } else if ($dbrole->locked != $this->locks[$role]) {
                    $dbrole->locked = $this->locks[$role];
                    $DB->update_record('appraisal_stage_role_setting', $dbrole);
                }
            } else {
                $DB->delete_records('appraisal_stage_role_setting',
                        array('appraisalstageid' => $this->id, 'appraisalrole' => $role));
            }
        }

        return $this;
    }


    /**
     * Validate stage for activation
     *
     * @param int $time Estimate if appraisal is valid on given time (by default: current server time)
     * @return array with errors / empty if no errors
     */
    public function validate($time = null) {
        if (is_null($time)) {
            $time = time();
        }

        $err = array();
        if (empty($this->timedue) || ($this->timedue > 0 && $this->timedue < $time)) {
                $err['stagedue'.$this->id] = get_string('appraisalinvalid:stagedue', 'totara_appraisal', $this->name);
        }

        // Check that stage has at least one page.
        $pages = appraisal_page::fetch_stage($this->id);
        if (empty($pages)) {
            $err['stageempty' . $this->id] = get_string('appraisalinvalid:stageempty', 'totara_appraisal', $this->name);
        }

        $rolesinvolved = $this->get_roles_involved(appraisal::ACCESS_CANANSWER);
        if (empty($rolesinvolved)) {
            $err['stagenocananswer' . $this->id] =
                    get_string('appraisalinvalid:stagenoonecananswer', 'totara_appraisal', $this->name);
        }

        // Validate each page.
        foreach ($pages as $pagerecord) {
            $page = new appraisal_page($pagerecord->id);
            $err += $page->validate();
        }

        return $err;
    }


    /**
     * Is this stage completed (for all roles or by a certain role user).
     * Stage completed - all roles have done it.
     * Stage completed by role - all required answers are answered and user confirmed that stage is completed.
     * Note: If the specified role is not required to answer questions in this stage then this function will return true.
     *
     * @param object $userassignment
     * @param object $roleassignment
     * @return bool
     */
    public function is_completed($userassignment, $roleassignment = null) {
        global $DB;

        // Check if the appraisal is completed for this user.
        if (isset($userassignment->timecompleted)) {
            return true;
        }

        // Check if stage is completed for this user.
        $stages = self::get_stages($this->appraisalid);
        if ($stages[$userassignment->activestageid]->timedue > $this->timedue) {
            return true;
        }

        // If we do not specifiy a role user then the stage is not complete for the user.
        if (!isset($roleassignment)) {
            return false;
        }

        // Check if the role user can answer some questions.
        if ($this->can_be_answered($roleassignment->appraisalrole)) {
            // Check if they have submitted stage data.
            return $DB->record_exists('appraisal_stage_data',
                    array('appraisalroleassignmentid' => $roleassignment->id, 'appraisalstageid' => $this->id));
        } else {
            // The role user is not required to answer any questions, so they are not incomplete.
            return true;
        }
    }


    /**
     * Is appraisal stage locked for the subject and user in the given role
     * Stage considered locked if it's completed and "appraisal is locked after completing" setting enabled.
     *
     * @param object $userassignment
     * @param object $roleassignment
     * @return bool
     */
    public function is_locked($userassignment, $roleassignment) {
        $appraisal = new appraisal($this->appraisalid);
        if ($appraisal->is_locked($userassignment)) {
            return true;
        }
        return (isset($this->locks[$roleassignment->appraisalrole]) && $this->locks[$roleassignment->appraisalrole] &&
                ($this->is_completed($userassignment, $roleassignment)) && ($userassignment->activestageid != $this->id));
    }


    /**
     * Is appraisal stage overdue
     *
     * @param int $time time of check
     * @return bool
     */
    public function is_overdue($time = 0) {
        if (!$time) {
            $time = time();
        }
        if (!$this->timedue) {
            return false;
        }
        return ($time > $this->timedue);
    }


    /**
     * Tests if a role may answer on this stage (if the role has at least one editable question).
     *
     * @return bool
     */
    public function can_be_answered($role) {
        return array_key_exists($role, $this->get_may_answer());
    }


    /**
     * Get roles that may answer on page (roles that have at least one editable question).
     *
     * @return array
     */
    public function get_may_answer() {
        global $DB;

        $sql = 'SELECT DISTINCT aqfr.appraisalrole
                  FROM {appraisal_stage_page} asp
                  LEFT JOIN {appraisal_quest_field} aqf
                    ON aqf.appraisalstagepageid = asp.id
                  LEFT JOIN {appraisal_quest_field_role} aqfr
                    ON aqfr.appraisalquestfieldid = aqf.id
                   AND aqfr.rights > 0
                 WHERE asp.appraisalstageid  = ?
                   AND (aqfr.rights & ? ) = ?';
        $roles = $DB->get_recordset_sql($sql, array($this->id, appraisal::ACCESS_CANANSWER, appraisal::ACCESS_CANANSWER));

        $out = array();
        $strroles = appraisal::get_roles();
        foreach ($roles as $role) {
            $out[$role->appraisalrole] = get_string($strroles[$role->appraisalrole], 'totara_appraisal');
        }

        return $out;
    }


    /**
     * Mark this stage as complete for the given role.
     * Then check if all involved roles are complete and if so then mark the stage as complete.
     *
     * @param object $roleassignment
     */
    public function complete_for_role($roleassignment) {
        global $DB;

        if (!$DB->record_exists('appraisal_stage_data',
                array('appraisalroleassignmentid' => $roleassignment->id, 'appraisalstageid' => $this->id))) {
            // Mark the role as complete.
            $stage_data = new stdClass();
            $stage_data->appraisalroleassignmentid = $roleassignment->id;
            $stage_data->timecompleted = time();
            $stage_data->appraisalstageid = $this->id;
            $DB->insert_record('appraisal_stage_data', $stage_data);

            // Check if all involved roles are complete for this user and stage.
            $rolescompletion = $this->get_completion($roleassignment->subjectid, appraisal::ACCESS_CANANSWER);
            $complete = true;
            foreach ($rolescompletion as $rolecompletion) {
                if (!isset($rolecompletion->timecompleted)) {
                    $complete = false;
                    break;
                }
            }
            if ($complete) {
                // Mark this stage as complete for this user.
                $this->complete_for_user($roleassignment->subjectid);
            }
        }
    }


    /**
     * Mark this stage as complete for the given user.
     * Then check if this is the last stage of the appraisal and if so then mark the user as complete.
     *
     * @param int $subjectid
     */
    public function complete_for_user($subjectid) {
        global $DB;

        // Mark the user as complete for this stage.
        $stages = self::get_list($this->appraisalid);
        $nextstageid = null;
        $currentstage = reset($stages);
        for ($i = 0; $i < count($stages) - 1; $i++) {
            if ($currentstage->id == $this->id) {
                $currentstage = next($stages);
                $nextstageid = $currentstage->id;
                break;
            }
            $currentstage = next($stages);
        }

        // Check if this was the last stage for this user.
        if (!empty($nextstageid)) {
            $DB->set_field('appraisal_user_assignment', 'activestageid', $nextstageid,
                array('userid' => $subjectid, 'appraisalid' => $this->appraisalid));
        } else {
            // Mark the appraisal as complete for the given user.
            $appraisal = new appraisal($this->appraisalid);
            $appraisal->complete_for_user($subjectid);
        }
        events_trigger('appraisal_stage_completion', $this);
    }


    /**
     * Get all roles involved in this stage.
     *
     * @param int $rights Only if they have the specified rights.
     * @return array
     */
    public function get_roles_involved($rights = 0) {
        global $DB;

        $sqlrights = 'aqfr.rights > 0';
        $params = array();
        if ($rights > 0) {
            $sqlrights = '(aqfr.rights & ? ) = ?';
            $params[] = $rights;
            $params[] = $rights;
        }

        $sql = "SELECT DISTINCT aqfr.appraisalrole
                  FROM {appraisal_stage_page} asp
                  LEFT JOIN {appraisal_quest_field} aqf
                    ON aqf.appraisalstagepageid = asp.id
                  JOIN {appraisal_quest_field_role} aqfr
                    ON aqfr.appraisalquestfieldid = aqf.id
                   AND {$sqlrights}
                 WHERE asp.appraisalstageid = ?
                 ORDER BY aqfr.appraisalrole";
        $params[] = $this->id;
        return $DB->get_records_sql($sql, $params);
    }


    /**
     * Get completion data for all roles involved in this stage, for the given user.
     *
     * @param int $subjectid
     * @param int $rights Only if they have the specified rights.
     * @return array
     */
    public function get_completion($subjectid, $rights = 0) {
        global $DB;

        $roles = $this->get_roles_involved($rights);

        $sql = 'SELECT ara.appraisalrole, ara.userid, ara.activepageid, asd.timecompleted
                  FROM {appraisal_role_assignment} ara
                  JOIN {appraisal_user_assignment} aua
                    ON ara.appraisaluserassignmentid = aua.id
                  LEFT JOIN (SELECT * FROM {appraisal_stage_data}
                              WHERE appraisalstageid = ?) asd
                    ON ara.id = asd.appraisalroleassignmentid
                 WHERE aua.userid = ?
                   AND aua.appraisalid = ?
                 ORDER BY ara.appraisalrole';
        $completiondata = $DB->get_records_sql($sql, array($this->id, $subjectid, $this->appraisalid));
        return array_intersect_key($completiondata, $roles);
    }


    /**
     * Return active/in progress stage
     * Only one stage is active at a time, subsequent stages are not available until the previous one is completed
     *
     * @param int $appraisalid
     * @param object $userassignment
     * @return appraisal_stage or null if all stages completed
     */
    public static function get_active($appraisalid, $userassignment) {
        $stagesrs = self::fetch_appraisal($appraisalid);
        foreach ($stagesrs as $stagerecord) {
            $stage = new appraisal_stage($stagerecord->id);
            if (!$stage->is_completed($userassignment)) {
                return $stage;
            }
        }
        return null;
    }


    /**
     * Get list of stages with involved roles (only roles that have questions to answer are involved)
     *
     * @param int $appraisalid
     * @return array of stdClass
     */
    public static function get_list($appraisalid) {
        global $DB;

        $sql = 'SELECT ast.id as stageid, ast.name, ast.description, ast.timedue, aspqfr.appraisalrole, ast.appraisalid
                  FROM {appraisal_stage} ast
                  LEFT JOIN
                    (SELECT DISTINCT asp.appraisalstageid, aqfr.appraisalrole
                       FROM {appraisal_stage_page} asp
                       JOIN {appraisal_quest_field} aqf
                         ON aqf.appraisalstagepageid = asp.id
                       JOIN {appraisal_quest_field_role} aqfr
                         ON aqfr.appraisalquestfieldid = aqf.id AND (aqfr.rights & ? ) = ?) aspqfr
                    ON aspqfr.appraisalstageid = ast.id
                 WHERE ast.appraisalid = ?
                 ORDER BY ast.timedue, ast.id, aspqfr.appraisalrole';
        $params = array(appraisal::ACCESS_CANANSWER, appraisal::ACCESS_CANANSWER, $appraisalid);
        $stages = $DB->get_recordset_sql($sql, $params);

        $groupedstages = array();
        foreach ($stages as $stage) {
            if (!isset($groupedstages[$stage->stageid])) {
                $outstage = new stdClass();
                $outstage->id = $stage->stageid;
                $outstage->appraisalid = $stage->appraisalid;
                $outstage->name = $stage->name;
                $outstage->description = $stage->description;
                $outstage->timedue = $stage->timedue;
                $groupedstages[$stage->stageid] = $outstage;
                $groupedstages[$stage->stageid]->roles = array();
            }
            if ($stage->appraisalrole) {
                $groupedstages[$stage->stageid]->roles[$stage->appraisalrole] = 1;
            }
        }
        return $groupedstages;
    }


    /**
     * Get list of appraisal stages that the roles have rights to.
     * By default all stages where a role can read or write at least on one question will be returned.
     *
     * @param int $appraisalid
     * @param array $roles
     * @param int $rights appraisal::ACCESS_* Clarify on certain rights
     * @return array of stdClass
     */
    public static function get_stages($appraisalid, $roles = array(), $rights = 0) {
        global $DB;

        // Take user role(s).
        if (!empty($roles)) {
            list($sqlroles, $paramroles) = $DB->get_in_or_equal($roles);
        } else {
            $paramroles = array();
        }

        $sqlrights = 'aqfr.rights > 0';
        $paramrights = array();
        if ($rights > 0) {
            $sqlrights = '(aqfr.rights & ? ) = ?';
            $paramrights[] = $rights;
            $paramrights[] = $rights;
        }

        $sql = 'SELECT DISTINCT ast.id, ast.timedue FROM {appraisal_stage} ast
                  LEFT JOIN {appraisal_stage_page} asp ON (asp.appraisalstageid = ast.id)
                  LEFT JOIN {appraisal_quest_field} aqf ON (aqf.appraisalstagepageid = asp.id)
                  LEFT JOIN {appraisal_quest_field_role} aqfr ON (aqfr.appraisalquestfieldid = aqf.id)
                 WHERE ast.appraisalid = ?';

        if (!empty($roles)) {
            $sql .= ' AND aqfr.appraisalrole ' . $sqlroles;
        }

        $sql .= ' AND ' . $sqlrights . '
                 ORDER BY ast.timedue, ast.id';

        $params = array_merge(array($appraisalid), $paramroles, $paramrights);
        $stagesrs = $DB->get_records_sql($sql, $params);

        $stages = array();
        foreach ($stagesrs as $stagerecord) {
            $stages[$stagerecord->id] = new appraisal_stage($stagerecord->id);
        }

        return $stages;
    }


    /**
     * Get list of all appraisal stages for all appraisals. Used for report builder.
     *
     * @return array of stdClass
     */
    public static function get_all_stages() {
        global $DB;

        $sql = 'SELECT ast.id, ast.appraisalid, ast.timedue, ast.name AS stagename, app.name AS appraisalname, app.timestarted
                  FROM {appraisal_stage} ast
                  JOIN {appraisal} app
                    ON ast.appraisalid = app.id
                 ORDER BY app.timestarted DESC, ast.timedue';

        return $DB->get_records_sql($sql);
    }


    /**
     * Fetch all appraisal stages
     *
     * @param int $appraisalid
     * @return array of stdClass
     */
    public static function fetch_appraisal($appraisalid) {
        global $DB;
        $stages = $DB->get_records('appraisal_stage', array('appraisalid' => $appraisalid), 'timedue, id');
        return $stages;
    }


    /**
     * Remove stage if possible
     *
     * @param int $stageid
     * @return bool
     */
    public static function delete($stageid) {
        global $DB;

        $stage = new appraisal_stage($stageid);
        if (!appraisal::is_draft($stage->appraisalid)) {
            return false;
        }

        // Remove all questions custom data.
        $pages = appraisal_page::fetch_stage($stageid);
        foreach ($pages as $page) {
            appraisal_page::delete($page->id);
        }

        // Remove event messages.
        appraisal_message::delete_stage($stageid);

        $DB->delete_records('appraisal_stage_role_setting', array('appraisalstageid' => $stageid));
        $DB->delete_records('appraisal_stage', array('id' => $stageid));
        return true;
    }


    /**
     * Build stage and related pages, questions according given definition
     * @param array $def
     * @param int $appraisalid
     * @return appraisal_stage
     */
    public static function build(array $def, $appraisalid) {
        $stage = new appraisal_stage();
        $stage->appraisalid = $appraisalid;
        $stage->name = $def['name'];
        $stage->description = isset($def['description']) ? $def['description'] : '';
        $stage->timedue = isset($def['timedue']) ? $def['timedue'] : '';
        $stage->locks = isset($def['locks']) ? $def['locks'] : array();
        $stage->save();
        if (isset($def['pages'])) {
            foreach ($def['pages'] as $page) {
                appraisal_page::build($page, $stage->id);
            }
        }
        return $stage;
    }
}


/**
 * Pages within stages
 */
class appraisal_page {

    /**
     * If active page id is set to this then it indicates that all pages in the current stage are complete.
     */
    const ACTIVEPAGECOMPLETEDID = -1;

    /**
     * Appraisal stage id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * Appraisal stageid that this page is related to
     *
     * @var type
     */
    public $appraisalstageid = null;

    /**
     * Stage name
     *
     * @var string
     */
    public $name = '';

    /**
     * Stage position
     *
     * @var int
     */
    public $sortorder = 0;

    /**
     * Create instance of appraisal page
     *
     * @param int $id
     */
    public function __construct($id = 0) {
        if ($id) {
            $this->id = $id;
            $this->load();
        }
    }


    /**
     * Allow read access to restricted properties
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (in_array($name, array('id'))) {
            return $this->$name;
        }
    }


    /**
     * Get stdClass with page properties
     *
     * @return stdClass
     */
    public function get() {
        $obj = new stdClass();
        $obj->id = $this->id;
        $obj->appraisalstageid = $this->appraisalstageid;
        $obj->name = $this->name;
        $obj->sortorder = $this->sortorder;
        return $obj;
    }


    /**
     * Set page properties
     *
     * @param stdClass $todb
     * @return $this
     */
    public function set(stdClass $todb) {
        if (is_null($this->appraisalstageid) && isset($todb->appraisalstageid)) {
            $this->appraisalstageid = $todb->appraisalstageid;
        }
        if (isset($todb->name)) {
            $this->name = $todb->name;
        }
        if (isset($todb->sortorder)) {
            $this->sortorder = $todb->sortorder;
        }
        return $this;
    }


    /**
     * Saves current page properties
     *
     * @return $this
     */
    public function save() {
        global $DB;

        $todb = $this->get();

        if ($todb->appraisalstageid < 1) {
            throw new appraisal_exception('Page must belong to a stage', 22);
        }

        $stage = new appraisal_stage($todb->appraisalstageid);
        if (!appraisal::is_draft($stage->appraisalid)) {
            throw new appraisal_exception('Cannot change page of active appraisal');
        }

        // Put default name.
        if (!$todb->name) {
            $todb->name = get_string('pagedefaultname', 'totara_appraisal');
        }

        if ($this->id > 0) {
            $todb->id = $this->id;
            $DB->update_record('appraisal_stage_page', $todb);
        } else {
            $sql = 'SELECT sortorder
                    FROM {appraisal_stage_page}
                    WHERE appraisalstageid = ?
                    ORDER BY sortorder DESC';
            $neworder = $DB->get_record_sql($sql, array($todb->appraisalstageid), IGNORE_MULTIPLE);
            if (!$neworder) {
                $order = 0;
            } else {
                $order = $neworder->sortorder + 1;
            }
            $todb->sortorder = $order;
            $this->id = $DB->insert_record('appraisal_stage_page', $todb);
        }
        // Refresh data.
        $this->load($this->id);
        return $this;
    }


    /**
     * Reload appraisal page properties from DB
     *
     * @return $this
     */
    public function load() {
        global $DB;
        $page = $DB->get_record('appraisal_stage_page', array('id' => $this->id));
        if (!$page) {
            throw new appraisal_exception('Cannot load appraisal page', 21);
        }
        $this->appraisalstageid = $page->appraisalstageid;
        $this->name = $page->name;
        $this->sortorder = $page->sortorder;
        return $this;
    }


    /**
     * Set page relation to a stage
     *
     * @param int $appraisalstageid
     */
    public function set_stage($appraisalstageid) {
        $this->appraisalstageid = $appraisalstageid;
    }


    /**
     * Clone a stage page given a new appriasal stage id
     * to associate it with
     *
     * @param int $appraisalstageid
     * @return appraisal_page
     */
    public function duplicate($appraisalstageid) {
        global $DB;

        // Get questions for current page
        $questions = $DB->get_records('appraisal_quest_field', array('appraisalstagepageid' => $this->id), 'sortorder');

        // Duplicate page
        $this->appraisalstageid = $appraisalstageid;
        $this->id = 0;
        $newpage = $this->save();

        // Duplicate questions in the page
        foreach ($questions as $q) {
            $question = new appraisal_question($q->id);
            $question->duplicate($newpage->id);
        }

        return $newpage;
    }


    /**
     * Validate page for activation.
     *
     * @return array Errors that were found.
     */
    public function validate() {
        $err = array();
        // Page must have at least one question.
        $questions = appraisal_question::fetch_page($this->id);
        if (empty($questions)) {
            $err['page'.$this->id] =  get_string('appraisalinvalid:pageempty', 'totara_appraisal', $this->name);
        }
        return $err;
    }


    /**
     * Move page to another stage
     *
     * @param int $stageid
     */
    public function move($stageid) {
        $this->appraisalstageid = $stageid;
        $this->save();
    }


    /**
     * Prepare answers on questions related to page for saving to db
     *
     * @param stdClass $formdata
     * @param stdClass $roleassignment role assignment record
     * @return stdClass fields related to page
     */
    public function answers_export(stdClass $formdata, stdClass $roleassignment) {
        $subjectid = $roleassignment->subjectid;
        $questionman = appraisal_question::get_manager($subjectid, $roleassignment->id);
        $questionrs = appraisal_question::fetch_page_role($this->id, $roleassignment->appraisalrole);
        $answers = new stdClass();
        foreach ($questionrs as $questionrecord) {
            $element = $questionman->get_element($questionrecord);
            // If a user isn't required to answer a question don't try and set form as it doesn't exist
            if (($questionrecord->rights & appraisal::ACCESS_CANANSWER) == appraisal::ACCESS_CANANSWER) {
                $answers = $element->set_as_form($formdata)->get_as_db($answers);
            }
        }
        return $answers;
    }


    /**
     * Prepare answers on questions from db to put into form/display
     *
     * @param stdClass $fromdb
     * @param stdClass $roleassignment role assignment record
     * @return stdClass fields related to page
     */
    public function answers_import(stdClass $fromdb, stdClass $roleassignment) {
        $subjectid = $roleassignment->subjectid;
        $questionman = appraisal_question::get_manager($subjectid, $roleassignment->id);
        $questionrs = appraisal_question::fetch_page_role($this->id, $roleassignment->appraisalrole);
        $answers = new stdClass();
        foreach ($questionrs as $questionrecord) {
            $element = $questionman->get_element($questionrecord);
            $answers = $element->set_as_db($fromdb)->get_as_form($answers, true);
        }
        return $answers;
    }


    /**
     * Mark this page as complete for the given role.
     *
     * @param object $roleassingment
     * $@return bool True if this was the last page of the stage for this role.
     */
    public function complete_for_role($roleassignment) {
        global $DB;

        // If we're currently on this page then go to the next.
        if (!$roleassignment->activepageid || ($roleassignment->activepageid == $this->id)) {
            $pages = self::get_applicable_pages($this->appraisalstageid, $roleassignment->appraisalrole, 0, false);
            $nextpage = reset($pages);
            for ($i = 0; $i < count($pages); $i++) {
                if ($nextpage->id == $this->id) {
                    $nextpage = next($pages);
                    break;
                }
                $nextpage = next($pages);
            }
            if ($nextpage) {
                $roleassignment->activepageid = $nextpage->id;
                $DB->set_field('appraisal_role_assignment', 'activepageid', $roleassignment->activepageid,
                        array('id' => $roleassignment->id));
            } else {
                $DB->set_field('appraisal_role_assignment', 'activepageid', null,
                        array('id' => $roleassignment->id));
                return true;
            }
        }
        return false;
    }


    /**
     * Is page completed for the subject and the user in the given role.
     * Page considered completed if the role user has a higher activepage->sortorder or the stage is completed
     * or the user is not required to complete the stage.
     *
     * @param object $userassignment
     * @param object $roleassignment
     * @return bool
     */
    public function is_completed($userassignment, $roleassignment) {
        // If the stage is completed for this user then the page must be completed for this user.
        $stage = new appraisal_stage($this->appraisalstageid);
        if ($stage->is_completed($userassignment, $roleassignment)) {
            return true;
        }

        // If this stage is not active then it must be a future stage (past stages have already been dealt with).
        if ($userassignment->activestageid != $this->appraisalstageid) {
            return false;
        }

        // If the user can't answer any questions on this page then we return true (indicating we're not waiting for answers).
        if (!$stage->can_be_answered($roleassignment->appraisalrole)) {
            return true;
        }

        // If active page id is not set then the role user is on the first page of the active stage.
        if (empty($roleassignment->activepageid)) {
            return false;
        }

        // Compare the activepage to this page.
        $rolesactivepage = new appraisal_page($roleassignment->activepageid);
        return ($this->sortorder < $rolesactivepage->sortorder);
    }


    /**
     * Is page locked for the subject and the user in the given role.
     * Page considered locked if it's stage is locked.
     *
     * @param object $userassignment
     * @param object $roleassignment
     * @return boolen
     */
    public function is_locked($userassignment, $roleassignment) {
        $stage = new appraisal_stage($this->appraisalstageid);
        return ($stage->is_locked($userassignment, $roleassignment));
    }


    /**
     * Tests if a role may answer on this page (if the role has at least one editable question).
     *
     * @param int $role
     * @return bool
     */
    public function can_be_answered($role) {
        $rolesmustanswer = $this->get_may_answer();
        return array_key_exists($role, $rolesmustanswer);
    }


    /**
     * Get roles that may answer on page (roles that have at least one editable question).
     *
     * @return array of int
     */
    public function get_may_answer() {
        global $DB;
        $sql = 'SELECT DISTINCT aqfr.appraisalrole
                  FROM {appraisal_stage_page} asp
                  LEFT JOIN {appraisal_quest_field} aqf
                    ON aqf.appraisalstagepageid = asp.id
                  LEFT JOIN {appraisal_quest_field_role} aqfr
                    ON aqfr.appraisalquestfieldid = aqf.id
                   AND aqfr.rights > 0
                 WHERE asp.id = ?
                   AND (aqfr.rights & ? ) = ?';
        return $DB->get_records_sql($sql, array($this->id, appraisal::ACCESS_CANANSWER, appraisal::ACCESS_CANANSWER));
    }


    /**
     * Get list of pages
     *
     * @param int $stageid
     * @return array of stdClass
     */
    public static function get_list($stageid) {
        global $DB;

        $sql = 'SELECT asp.id, asp.name
                FROM {appraisal_stage_page} asp
                WHERE asp.appraisalstageid = ?
                ORDER BY asp.sortorder';

        return $DB->get_records_sql($sql, array($stageid));
    }


    /**
     * Fetch pages from stage
     *
     * @param int $stageid
     * @return array of stdClass
     */
    public static function fetch_stage($stageid) {
        global $DB;

        $sql = 'SELECT *
                FROM {appraisal_stage_page} asp
                WHERE asp.appraisalstageid = ?
                ORDER BY asp.sortorder';
        return $DB->get_records_sql($sql, array($stageid));
    }


    /**
     * Get list of pages that the role has rights to.
     * Notes: By default, all stages where the role can read or write at least one question will be returned.
     * By default, this returns all pages from all stages up to and including the specified stage.
     *
     * @param int $stageid
     * @param int $role
     * @param int $rights appraisal::ACCESS_* Clarify on certain rights
     * @param int $includepreviouspages if false then only return pages from the given stage, not including previous pages
     * @return array of stdClass
     */
    public static function get_applicable_pages($stageid, $role, $rights = 0, $includepreviouspages = true) {
        global $DB;

        $sqlrights = 'aqfr.rights > 0';
        $paramrights = array();
        if ($rights > 0) {
            $sqlrights = '(aqfr.rights & ? ) = ?';
            $paramrights[] = $rights;
            $paramrights[] = $rights;
        }

        if ($includepreviouspages) {
            $thisstage = new appraisal_stage($stageid);
            $allstages = appraisal_stage::get_stages($thisstage->appraisalid);
            $includestageids = array();
            foreach ($allstages as $stage) {
                $includestageids[] = $stage->id;
                if ($thisstage->id == $stage->id) {
                    break;
                }
            }
            if (empty($includestageids)) {
                return array();
            }
            list($sqlstageids, $paramsstageids) = $DB->get_in_or_equal($includestageids);
        } else {
            $sqlstageids = ' = ? ';
            $paramsstageids = array($stageid);
        }

        $sql = "SELECT DISTINCT ap.*, ast.timedue
                  FROM {appraisal_stage_page} ap
                  JOIN {appraisal_stage} ast
                    ON ap.appraisalstageid = ast.id
                  JOIN {appraisal_quest_field} aqf
                    ON aqf.appraisalstagepageid = ap.id
                  JOIN {appraisal_quest_field_role} aqfr
                    ON aqfr.appraisalquestfieldid = aqf.id
                 WHERE ap.appraisalstageid {$sqlstageids}
                   AND aqfr.appraisalrole = ? AND {$sqlrights}
                 ORDER BY ast.timedue, ap.sortorder";
        $params = array_merge($paramsstageids, array($role), $paramrights);
        $pagesrs = $DB->get_records_sql($sql, $params);

        // Process each appraisal.
        $pages = array();
        foreach ($pagesrs as $pagerecord) {
            $pages[$pagerecord->id] = new appraisal_page($pagerecord->id);
        }
        return $pages;
    }


    /**
     * Change relative position of page within same stage
     *
     * @param int $pageid
     * @param int $pos starts with 0
     */
    public static function reorder($pageid, $pos) {
        $page = new appraisal_page($pageid);
        $stage = new appraisal_stage($page->appraisalstageid);
        if (!appraisal::is_draft($stage->appraisalid)) {
            throw new appraisal_exception('Cannot change page of active appraisal');
        }

        db_reorder($pageid, $pos, 'appraisal_stage_page', 'appraisalstageid');
    }


    /**
     * Remove page if possible
     *
     * @param int $pageid
     * @return bool true if deleted
     */
    public static function delete($pageid) {
        global $DB;

        $page = new appraisal_page($pageid);
        $stage = new appraisal_stage($page->appraisalstageid);
        if (!appraisal::is_draft($stage->appraisalid)) {
            return false;
        }

        $questions = appraisal_question::fetch_page($pageid);
        foreach ($questions as $quest) {
            appraisal_question::delete($quest->id);
        }

        $DB->delete_records('appraisal_stage_page', array('id' => $page->id));
        return true;
    }


    /**
     * Build page and related questions according given definition
     * @param array $def
     * @param int $stageid
     * @return object
     */
    public static function build(array $def, $stageid) {
        $page = new appraisal_page();
        $page->appraisalstageid = $stageid;
        $page->name = $def['name'];
        $page->save();
        if (isset($def['questions'])) {
            foreach ($def['questions'] as $quest) {
                appraisal_question::build($quest, $page->id);
            }
        }
        return $page;
    }
}


/**
 * Questions and forms (page content)
 */
class appraisal_question {

    /**
     * Appraisal stage id
     *
     * @var int
     */
    protected $id = 0;

    /**
     * Appraisal stageid that this page is related to
     *
     * @var type
     */
    public $appraisalstagepageid = null;

    /**
     * Stage name
     *
     * @var string
     */
    public $name = '';

    /**
     * Stage position
     *
     * @var int
     */
    public $sortorder = 0;

    /**
     * Question element instance
     * @var question_base
     */
    protected $element = null;

    /**
     * Roles access
     * Key is appraisal::ROLE_* code, value BITMASK of appraisal::ACCESS_*
     *
     * @var array of roles objects
     */
    protected $roles = array();

    /**
     * Create question instance
     *
     * @param int $id
     * @param stdClass $roleassignment
     */
    public function __construct($id = 0, stdClass $roleassignment = null) {
        if ($id) {
            $this->id = $id;
            $this->load($roleassignment);
        }
    }


    /**
     * Get read-only access to restricted properies
     * @param string $name
     */
    public function __get($name) {
        if (in_array($name, array('id', 'roles', 'elements'))) {
            return $this->$name;
        }
    }


    /**
     * Set question properties from form
     *
     * @param stdClass $todb
     * @return $this
     */
    public function set(stdClass $todb) {
        if (is_null($this->appraisalstagepageid) && isset($todb->appraisalstagepageid)) {
            $this->appraisalstagepageid = $todb->appraisalstagepageid;
        }

        if (isset($todb->name)) {
            $this->name = $todb->name;
        }

        if (isset($todb->sortorder)) {
            $this->sortorder = $todb->sortorder;
        }

        $this->get_element()->define_set($todb);
        $this->get_element()->define_export($todb);

        // Set roles that should be locked on stage completion.
        if (isset($todb->roles)) {
            $roles = appraisal::get_roles();
            foreach ($roles as $role => $rolename) {
                if (isset($todb->roles[$role])) {
                    if (is_numeric($todb->roles[$role])) {
                        $this->roles[$role] = $todb->roles[$role];
                    } else if (is_array($todb->roles[$role])) {
                        $this->roles[$role] = 0;
                        foreach ($todb->roles[$role] as $access => $isgranted) {
                            if ($isgranted) {
                                $this->roles[$role] |= $access;
                            }
                        }
                    }
                }
            }
        }
        return $this;
    }

    /**
     * Get stdClass with question properties
     *
     * @param $isform destination is form (otherwise db)
     * @return stdClass
     */
    public function get($isform = false) {
        // Get element settings.

        $obj = new stdClass;
        if ($isform) {
            $this->element->define_get($obj);
        } else {
            $this->element->define_export($obj);
        }
        $obj->id = $this->id;
        $obj->appraisalstagepageid = $this->appraisalstagepageid;
        $obj->name = $this->name;
        $obj->sortorder = $this->sortorder;

        // Get roles access.
        $obj->roles = $this->roles;
        return $obj;
    }


    /**
     * Save question to database
     *
     * @return appraisal_question
     */
    public function save() {
        global $DB;

        $todb = $this->get();
        if ($todb->appraisalstagepageid < 1) {
            throw new appraisal_exception('Question must belong to an appraisal page', 32);
        }

        $page = new appraisal_page($todb->appraisalstagepageid);
        $stage = new appraisal_stage($page->appraisalstageid);
        if (!appraisal::is_draft($stage->appraisalid)) {
            throw new appraisal_exception('Cannot change question of active appraisal');
        }

        if ($this->id > 0) {
            $todb->id = $this->id;
            $DB->update_record('appraisal_quest_field', $todb);
        } else {
            $sql = 'SELECT sortorder
                    FROM {appraisal_quest_field}
                    WHERE appraisalstagepageid = ?
                    ORDER BY sortorder DESC';
            $neworder = $DB->get_record_sql($sql, array($todb->appraisalstagepageid), IGNORE_MULTIPLE);
            if (!$neworder) {
                $order = 0;
            } else {
                $order = $neworder->sortorder + 1;
            }
            $todb->sortorder = $order;
            $this->id = $DB->insert_record('appraisal_quest_field', $todb);
        }

        // Save roles access for quesiton.
        $this->save_roles();

        return $this;
    }


    /**
     * Load quesiton from database
     *
     * @param stdClass $roleassignment
     * @return appraisal_question $this
     */
    public function load(stdClass $roleassignment = null) {
        global $DB;

        // Load data.
        $quest = $DB->get_record('appraisal_quest_field', array('id' => $this->id));
        if (!$quest) {
            throw new appraisal_exception('Cannot load quest field', 31);
        }

        $this->id = $quest->id;
        $this->name = $quest->name;
        $this->appraisalstagepageid = $quest->appraisalstagepageid;
        $this->sortorder = $quest->sortorder;

        if ($roleassignment) {
            $question = self::get_manager($roleassignment->subjectid, $roleassignment->id);
        } else {
            $question = self::get_manager();
        }

        $this->attach_element($question->get_element($quest));
        $this->load_roles();
    }


    /**
     * Save roles permissions
     *
     * @return appraisal_question $this
     */
    protected function save_roles() {
        global $DB;

        $page = new appraisal_page($this->appraisalstagepageid);
        $stage = new appraisal_stage($page->appraisalstageid);
        if (!appraisal::is_draft($stage->appraisalid)) {
            throw new appraisal_exception('Cannot change question of active appraisal');
        }

        $roles = appraisal::get_roles();
        foreach ($roles as $role => $rolename) {
            if (isset($this->roles[$role]) && $this->roles[$role] > 0) {
                $dbrole = $DB->get_record('appraisal_quest_field_role',
                        array('appraisalquestfieldid' => $this->id, 'appraisalrole' => $role));

                if (!$dbrole) {
                    $dbrole = new stdClass();
                    $dbrole->appraisalquestfieldid = $this->id;
                    $dbrole->appraisalrole = $role;
                    $dbrole->rights = $this->roles[$role];
                    $DB->insert_record('appraisal_quest_field_role', $dbrole);
                } else if ($dbrole->rights != $this->roles[$role]) {
                    $dbrole->rights = $this->roles[$role];
                    $DB->update_record('appraisal_quest_field_role', $dbrole);
                }
            } else {
                $DB->delete_records('appraisal_quest_field_role',
                        array('appraisalquestfieldid' => $this->id, 'appraisalrole' => $role));
            }
        }
        return $this;
    }


    /**
     * Load stage roles permissions/settings from DB
     *
     * @return appraisal_question $this
     */
    protected function load_roles() {
        global $DB;

        $rolesdb = $DB->get_records('appraisal_quest_field_role', array('appraisalquestfieldid' => $this->id));

        $this->roles = array();

        if ($rolesdb) {
            foreach ($rolesdb as $role) {
                $this->roles[$role->appraisalrole] = $role->rights;
            }
        }

        return $this;
    }


    /**
     * Attach customfiled2 element to question
     *
     * @param question_base $elem
     */
    public function attach_element(question_base $elem) {
        $this->element = $elem;
    }


    /**
     * Get attached element instane
     *
     * @return question_base
     */
    public function get_element($roleid = null) {
        return $this->element;
    }


    /**
     * Move question to another page
     *
     * @param int $pageid
     */
    public function move($pageid) {
        $this->appraisalstagepageid = $pageid;
        $this->save();

        // Reorder to put question at top
        appraisal_question::reorder($this->id, 0);
    }


    /**
     * Duplicate a question given a new page id to duplicate onto
     *
     * @param int $pageid
     * @return appraisal_question
     */
    public function duplicate($pageid) {
        $this->appraisalstagepageid = $pageid;
        // Saving original element.
        $oldelement = $this->get_element();
        $this->id = 0;
        $newquestion = $this->save();

        $element = $newquestion->get_element();
        $element->duplicate($oldelement);

        return $newquestion;
    }


    /**
     * Check if user can view others answer for current assignment and question
     *
     * @param int $roleassignmentid roleassignmentid that gave answer on question
     * @param int $userid User that want to see answer
     * @return bool
     */
    public function user_can_view($roleassignmentid, $userid) {
        global $DB;

        $sql = "SELECT ara2.appraisalrole
                FROM {appraisal_user_assignment} aua
                LEFT JOIN {appraisal_role_assignment} ara ON (aua.id = ara.appraisaluserassignmentid)
                LEFT JOIN {appraisal_role_assignment} ara2 ON (aua.id = ara2.appraisaluserassignmentid)
                WHERE ara.id = ? AND ara2.userid = ?";
        $assignments = $DB->get_records_sql($sql, array($roleassignmentid, $userid));

        foreach ($assignments as $assignment) {
            if ($this->roles[$assignment->appraisalrole] && appraisal::ACCESS_CANVIEWOTHER  == appraisal::ACCESS_CANVIEWOTHER) {
                return true;
            }
        }

        return false;
    }


    /**
     * Return array of roles involved in current question
     *
     * @param int $rights count only roles that have certain rights
     * @return array of appraisalrole
     */
    public function get_roles_involved($rights = 0) {
        global $DB;

        $sqlrights ='';
        $params = array($this->id);
        if ($rights > 0) {
            $sqlrights = ' AND (aqfr.rights & ? ) = ? ';
            $params[] = $rights;
            $params[] = $rights;
        }
        $sql = "SELECT DISTINCT aqfr.appraisalrole
                  FROM {appraisal_stage} ast
                  LEFT JOIN {appraisal_stage_page} asp
                    ON asp.appraisalstageid = ast.id
                  LEFT JOIN {appraisal_quest_field} aqf
                    ON aqf.appraisalstagepageid = asp.id
                  LEFT JOIN {appraisal_quest_field_role} aqfr
                    ON aqfr.appraisalquestfieldid = aqf.id AND aqfr.rights > 0
                 WHERE aqf.id = ? {$sqlrights}
                 ORDER BY aqfr.appraisalrole";
        $rolesrecords = $DB->get_records_sql($sql, $params);

        $out = array();
        foreach ($rolesrecords as $rolerecord) {
            $out[$rolerecord->appraisalrole] = 1;
        }
        return array_keys($out);
    }


    /**
     * Return instance of question manager
     * @param int $subjectid
     * @param int $roleassignmentid role assignment of the user who is answering
     * @return type
     */
    public static function get_manager($subjectid = 0, $roleassignmentid = 0) {
        return new question('appraisal', $subjectid, 'appraisalroleassignmentid', $roleassignmentid);
    }


    /**
     * Get all questions of the page
     *
     * @param int $pageid
     * @return array
     */
    public static function fetch_page($pageid) {
        global $DB;

        return $DB->get_records('appraisal_quest_field', array('appraisalstagepageid' => $pageid), 'sortorder');
    }


    /**
     * Get all questions from page for role
     *
     * @param int $pageid
     * @param array
     */
    public static function fetch_page_role($pageid, $role) {
        global $DB;

        $sql = 'SELECT aqf.*, aqfr.rights
                  FROM {appraisal_quest_field} aqf, {appraisal_quest_field_role} aqfr
                 WHERE appraisalstagepageid = ?
                   AND aqf.id = aqfr.appraisalquestfieldid
                   AND appraisalrole = ?
                   AND rights > 0
                 ORDER BY aqf.sortorder';
        return $DB->get_records_sql($sql, array($pageid, $role));
    }


    /**
     * Get all questions of appraisal, restricted by options.
     *
     * @param int $appraisalid
     * @param int $role only questions this role is involved with (can see or answer)
     * @param int $rights only questions that roles have the specified rights to
     * @param int $datatypes only questions that have one of the specified datatypes
     * @return array
     */
    public static function fetch_appraisal($appraisalid, $role = null, $rights = null, $datatypes = array()) {
        global $DB;

        $params = array();

        $rrjoinsql = '';
        if (isset($role) || isset($rights)) {
            $rrjoinsql .= 'JOIN (SELECT DISTINCT appraisalquestfieldid
                                   FROM {appraisal_quest_field_role}
                                  WHERE 1=1';
            if (isset($role)) {
                $rrjoinsql .= ' AND appraisalrole = ?';
                $params[] = $role;
            }
            if (isset($rights)) {
                $rrjoinsql .= ' AND (rights & ?) = ?';
                $params[] = $rights;
                $params[] = $rights;
            }
            $rrjoinsql .= ') aqfr ON aqf.id = aqfr.appraisalquestfieldid';
        }

        $params[] = $appraisalid;

        $datatypessql = '';
        if (!empty($datatypes)) {
            list($sqldatatypes, $paramsdatatypes) = $DB->get_in_or_equal($datatypes);
            $datatypessql = 'AND aqf.datatype ' . $sqldatatypes;
            $params = array_merge($params, $paramsdatatypes);
        }

        $sql = "SELECT aqf.*, asp.appraisalstageid, asp.sortorder AS pagesortorder, ast.timedue AS stagetimedue
                  FROM {appraisal_quest_field} aqf
                  JOIN {appraisal_stage_page} asp
                    ON aqf.appraisalstagepageid = asp.id
                  JOIN {appraisal_stage} ast
                    ON asp.appraisalstageid = ast.id
                       {$rrjoinsql}
                 WHERE ast.appraisalid = ? {$datatypessql}
                 ORDER BY ast.timedue, asp.appraisalstageid, asp.sortorder, aqf.sortorder";

        return $DB->get_records_sql($sql, $params);
    }


    /**
     * Get list of questions
     *
     * @param int $pageid
     * @return array of stdClass
     */
    public static function get_list($pageid) {
        global $DB;

        $sql = 'SELECT aqf.id, aqf.name, aqf.datatype
                FROM {appraisal_quest_field} aqf
                WHERE aqf.appraisalstagepageid = ?
                ORDER BY aqf.sortorder';
        return $DB->get_records_sql($sql, array($pageid));
    }


    /**
     * Change relative position of question within same page
     *
     * @param int $id
     * @param int $pos starts with 0
     */
    public static function reorder($questionid, $pos) {
        $question = new appraisal_question($questionid);
        $page = new appraisal_page($question->appraisalstagepageid);
        $stage = new appraisal_stage($page->appraisalstageid);
        if (!appraisal::is_draft($stage->appraisalid)) {
            throw new appraisal_exception('Cannot change page of active appraisal');
        }

        db_reorder($questionid, $pos, 'appraisal_quest_field', 'appraisalstagepageid');
    }


    /**
     * Remove question if possible
     *
     * @param int $questid
     * @return bool true if successful
     */
    public static function delete($questid) {
        global $DB;
        $question = new appraisal_question($questid);

        $page = new appraisal_page($question->appraisalstagepageid);
        $stage = new appraisal_stage($page->appraisalstageid);
        // We need to be sure that all relations to appraisal answers are cleaned.
        if (!appraisal::is_draft($stage->appraisalid)) {
            return false;
        }

        try {
            $questionman = self::get_manager();
            $element = $questionman->get_element($question);
            $element->delete();
        } catch (Exception $e) {
            // Delete even if element was badly broken.
        }
        $DB->delete_records('appraisal_quest_field_role', array('appraisalquestfieldid' => $question->id));
        $DB->delete_records('appraisal_quest_field', array('id' => $question->id));
        return true;
    }


    /**
     * Build questions according given definition
     * @param array $def
     * @param int $stageid
     * @return appraisal_question
     */
    public static function build(array $def, $pageid) {
        $quest = new appraisal_question();
        $quest->appraisalstagepageid = $pageid;
        $quest->name = $def['name'];
        $quest->roles = $def['roles'];

        $questman = self::get_manager();
        $elem = $questman->get_element($def['datatype']);
        $elem->define_import((object)$def);
        $quest->attach_element($elem);
        $quest->save();
        return $quest;
    }
}


/**
 * Exceptions related to appraisal
 */
class appraisal_exception extends Exception {
}


/**
 * Appraisal event notification
 */
class appraisal_message {
    /**
     * Event types for stages
     */
    const EVENT_APPRAISAL_ACTIVATION = 'appraisal_activation';
    const EVENT_STAGE_COMPLETE = 'appraisal_stage_completion';
    const EVENT_STAGE_DUE = 'stage_due';

    /**
     * Period types for messages before/after event
     */
    const PERIOD_DAY = 1;
    const PERIOD_WEEK = 2;
    const PERIOD_MONTH = 3;
    /**
     * Event id
     * @var int
     */
    protected $id = 0;
    /**
     * Appraisal id for appraisal activation event
     * @var int
     */
    protected $appraisalid = 0;

    /**
     * Stage if for stage complete and stage due events
     * @var type
     */
    protected $stageid = 0;

    /**
     * Event type
     * @var string
     */
    protected $type = '';

    /**
     * Time before/after event
     * @var int
     */
    protected $delta = 0;

    /**
     * Period of time before/after event
     * @var int
     */
    protected $deltaperiod = 0;

    /**
     * Roles that will receive message on event
     * @var array
     */
    protected $roles = array();

    /**
     * Messages to be sent
     *
     * @var array of stdClass (appraisal_event_message rows)
     */
    protected $messages = array();

    /**
     * Restrictions of sending message according stage
     * @var int
     */
    protected $stageiscompleted = 0;

    /**
     * Event was triggered
     * @var int
     */
    protected $triggered = 0;

    /**
     * Event was triggered during load
     * @var int
     */
    protected $wastriggered = 0;

    /**
     * Time scheduled - when to trigger postponed event (only if it's not immediate).
     * @var int
     */
    protected $timescheduled = 0;

    /**
     * Create instance appraisal notification
     */
    public function __construct($id = 0) {
        if ($id) {
            $this->load($id);
        }
    }


    /**
     * Read-only access to properties
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }


    /**
     * Set event type to appraisal activation
     *
     * @param type $appraisalid
     */
    public function event_appraisal($appraisalid) {
        $this->appraisalid = $appraisalid;
        $this->stageid = 0;
        $this->type = self::EVENT_APPRAISAL_ACTIVATION;
    }


    /**
     * Set event type to stage complete/due
     *
     * @param int $stageid
     * @param string $type appraisal_message::EVENT_STAGE_*
     */
    public function event_stage($stageid, $type) {
        if (!in_array($type, array(self::EVENT_STAGE_COMPLETE, self::EVENT_STAGE_DUE))) {
            throw new appraisal_exception('Unknown event type');
        }
        $stage = new appraisal_stage($stageid);
        $this->appraisalid = $stage->appraisalid;
        $this->stageid = $stageid;
        $this->type = $type;
    }


    /**
     * Set period before/after event it should be run
     *
     * @param type $delta
     * @param type $period
     */
    public function set_delta($delta, $period) {
        if ($delta != 0) {
            if (!in_array($period, array(self::PERIOD_DAY, self::PERIOD_WEEK, self::PERIOD_MONTH))) {
                throw new appraisal_exception('Unknown period before/after event');
            }
        }
        $this->delta = $delta;
        $this->deltaperiod = $period;
    }


    /**
     * Set roles that should receive message events
     *
     * @param array $roles of int
     * @param int $stageiscompleted -1 - only incomplete, 0 - all, 1 - only complete
     */
    public function set_roles(array $roles, $stageiscompleted) {
        $this->roles = $roles;
        $this->stageiscompleted = $stageiscompleted;
    }


    /**
     * Set messages that should be send for each role (0 - for all roles)
     * @param int $role
     * @param string $title
     * @param string $body
     */
    public function set_message($role, $title, $body) {
        if ($role == 0) {
            $keep = isset($this->messages[0]) ? $this->messages[0] : null;
            $this->messages = array();
            $this->messages[0] = $keep;
        } else {
            unset($this->messages[0]);
        }
        if (!isset($this->messages[$role])) {
            $this->messages[$role] = new stdClass();
        }
        $this->messages[$role]->name = $title;
        $this->messages[$role]->content = $body;
    }


    /**
     * Save message event
     */
    public function save() {
        global $DB;
        if ($this->wastriggered && $this->triggered) {
            throw new appraisal_exception('Cannot change event that was triggered');
        }
        if (empty($this->roles)) {
            throw new appraisal_exception('Roles must be defined');
        }
        $eventdb = new stdClass();
        $eventdb->id = $this->id;
        $eventdb->appraisalid = $this->appraisalid;
        $eventdb->appraisalstageid = $this->stageid;
        $eventdb->event = $this->type;
        $eventdb->delta = $this->delta;
        $eventdb->deltaperiod = $this->deltaperiod;
        $eventdb->stageiscompleted = $this->stageiscompleted;
        $eventdb->triggered = $this->triggered;
        $eventdb->timescheduled = $this->timescheduled;

        $transaction = $DB->start_delegated_transaction();
        if ($eventdb->id > 0) {
            $DB->update_record('appraisal_event', $eventdb);
        } else {
            $this->id = $DB->insert_record('appraisal_event', $eventdb);
            $eventdb->id = $this->id;
        }

        self::clean_messages($eventdb->id);
        foreach ($this->messages as $message) {
            $message->appraisaleventid = $eventdb->id;
            $message->id = $DB->insert_record('appraisal_event_message', $message);
        }
        try {
            foreach ($this->roles as $role) {
                $roledb = new stdClass();
                $messageid = isset($this->messages[0]) ? $this->messages[0]->id : $this->messages[$role]->id;
                if (!$messageid) {
                    throw new appraisal_exception('Role must have a message');
                }
                $roledb->appraisaleventmessageid = $messageid;
                $roledb->appraisalrole = $role;
                $DB->insert_record('appraisal_event_rcpt', $roledb);
            }
        } catch (Exception $e) {
            $transaction->rollback($e);
            throw $e;
        }
        $transaction->allow_commit();
    }


    /**
     * Load event message from database
     *
     * @param int $id
     */
    public function load($id) {
        global $DB;
        $this->id = $id;
        $eventdb = $DB->get_record('appraisal_event', array('id' => $id), '*', MUST_EXIST);
        $this->appraisalid = $eventdb->appraisalid;
        $this->stageid = $eventdb->appraisalstageid;
        $this->type = $eventdb->event;
        $this->delta = $eventdb->delta;
        $this->deltaperiod = $eventdb->deltaperiod;
        $this->stageiscompleted = $eventdb->stageiscompleted;
        $this->triggered = $eventdb->triggered;
        $this->wastriggered = $eventdb->triggered;
        $this->timescheduled = $eventdb->timescheduled;
        $messages = $DB->get_records('appraisal_event_message', array('appraisaleventid' => $id));
        $ids = array_keys($messages);
        list($msgids, $msgparams) = $DB->get_in_or_equal($ids);
        $rcptsql = 'SELECT * FROM {appraisal_event_rcpt} WHERE appraisaleventmessageid '. $msgids;
        $rcpts = $DB->get_records_sql($rcptsql, $msgparams);
        $this->messages = array();
        $this->roles = array();
        $allsame = true;
        $firstmsgid = current($rcpts)->appraisaleventmessageid;
        foreach ($rcpts as $rcpt) {
            if ($firstmsgid != $rcpt->appraisaleventmessageid) {
                $allsame = false;
            }
            $this->messages[$rcpt->appraisalrole] = $messages[$rcpt->appraisaleventmessageid];
            $this->roles[] = $rcpt->appraisalrole;
        }
        if ($allsame) {
            $this->messages = array($messages[$rcpt->appraisaleventmessageid]);
        }
    }


    /**
     * Reset event if it was triggered
     */
    public function reset() {
        $this->triggered = false;
    }


    /**
     * Schedule event to send message at time (it doesn't affect immediate messages)
     *
     * @param int $time server time
     */
    public function schedule($time) {
        $this->timescheduled = $time;
    }


    /**
     * Get messages sending time based on given time and event settings
     *
     * @param int $basetime time when scheduled event (should) happen
     * @return int time when messages should be sent
     */
    public function get_schedule_from($basetime) {
        $multiplier = 0;
        switch ($this->deltaperiod) {
            case self::PERIOD_DAY:
                $multiplier = 86400;
                break;
            case self::PERIOD_WEEK:
                $multiplier = 604800;
                break;
            case self::PERIOD_MONTH:
                $multiplier = 2592000;
                break;
        }
        if ($this->type == self::EVENT_STAGE_DUE) {
            $stage = new appraisal_stage($this->stageid);
            $basetime = $stage->timedue;
        }
        $delta = $this->delta * $multiplier;
        return $basetime + $delta;
    }


    /**
     * Is current time is time for sending messages (or if it's immediate)
     *
     * @param int $time
     * @return bool
     */
    public function is_time($time) {
        return ($this->timescheduled > 0 && $this->timescheduled < $time || $this->delta == 0);
    }


    /**
     * Is this event immediate to send message
     *
     * @return bool
     */
    public function is_immediate() {
        return $this->delta == 0;
    }


    /**
     * Send messages to recepients
     *
     * @return bool if attempt was successfull
     */
    public function send() {
        global $DB, $CFG;
        if ($this->triggered) {
            return false;
        }
        $learners = $DB->get_records('appraisal_user_assignment', array('appraisalid' => $this->appraisalid));
        $sentaddress = array();
        foreach ($learners as $learner) {
            $params = array('appraisaluserassignmentid' => $learner->id);
            $assignedroles = $DB->get_records('appraisal_role_assignment', $params, '', 'appraisalrole, userid');
            foreach ($this->roles as $role) {
                if (isset($assignedroles[$role])) {
                    // Send only if complete/incomplete.
                    if ($this->type == self::EVENT_STAGE_DUE && $this->stageiscompleted != 0) {
                        // Get stage completion.
                        $stage = new appraisal_stage($this->stageid);
                        $complete = $stage->is_completed($learner, $assignedroles[$role]);
                        // Skip completed if set "only to incompleted" and contra versa.
                        if ($this->stageiscompleted == 1 && !$complete ||
                            $this->stageiscompleted == -1 && $complete) {
                            continue;
                        }
                    }

                    $message = $this->get_message($role);
                    $rcptuserid = $assignedroles[$role]->userid;
                    $rcpt = $DB->get_record('user', array('id' => $rcptuserid));
                    $fromaddress = $CFG->noreplyaddress;
                    if (!isset($sentaddress[$rcpt->email]) || !in_array($message->id, $sentaddress[$rcpt->email])) {
                        email_to_user($rcpt, $fromaddress, $message->name, $message->content);

                        if (!isset($sentaddress[$rcpt->email])) {
                            $sentaddress[$rcpt->email] = array();
                        }
                        $sentaddress[$rcpt->email][] = $message->id;
                    }
                }
            }
        }
        $this->triggered = 1;
        $this->save();
        return true;
    }


    /**
     * Get message prepared for role
     *
     * @param int $role
     * @return stdClass
     */
    public function get_message($role) {
        if (isset($this->messages[$role])) {
            return $this->messages[$role];
        } else if (isset($this->messages[0])) {
            return $this->messages[0];
        }
        return null;
    }


    /**
     * List of messages related to appraisal
     *
     * @param int $appraisalid
     * @return array
     */
    public static function get_list($appraisalid) {
        global $DB;
        $msgrs = $DB->get_records('appraisal_event', array('appraisalid' => $appraisalid), 'id');
        $messages = array();
        foreach ($msgrs as $msgdata) {
            $messages[] = new appraisal_message($msgdata->id);
        }
        return $messages;
    }


    /**
     * Render name by taking message title
     *
     * @return string
     */
    public function get_display_name() {
        $strname = current($this->messages)->title;
        return $strname;
    }


    /**
     * Clean messages for the event
     *
     * @param int $id event id
     */
    protected static function clean_messages($id) {
        global $DB;
        $messages = $DB->get_records('appraisal_event_message', array('appraisaleventid' => $id), 'id');
        foreach ($messages as $message) {
            $DB->delete_records('appraisal_event_rcpt', array('appraisaleventmessageid' => $message->id));
        }
        $DB->delete_records('appraisal_event_message', array('appraisaleventid' => $id));
    }


    /**
     * Delete message
     *
     * @param int $id
     */
    public static function delete($id) {
        global $DB;
        self::clean_messages($id);
        $DB->delete_records('appraisal_event', array('id' => $id));
    }


    /**
     * Delete all event messages related to the stage
     * @param int $stageid
     */
    public static function delete_stage($stageid) {
        global $DB;
        $events = $DB->get_records('appraisal_event', array('appraisalstageid' => $stageid), 'id');
        foreach ($events as $event) {
            self::delete($event->id);
        }
    }


    /**
     * Delete all event messages related to the stage
     *
     * @param int $appraisalid
     */
    public static function delete_appraisal($appraisalid) {
        global $DB;
        $messages = $DB->get_records('appraisal_event', array('appraisalid' => $appraisalid), 'id');
        foreach ($messages as $message) {
            self::delete($message->id);
        }
    }


    /**
     * Make copy of all events for appraisal. Stages will not be duplicated.
     *
     * @param int $srcappraisalid Initial appraisal id
     * @param int $appraisalid Destination appraisal id
     */
    public static function duplicate_appraisal($srcappraisalid, $appraisalid) {
        global $DB;
        $sql = "SELECT id FROM {appraisal_event} WHERE appraisalid = ? AND (appraisalstageid = 0 OR appraisalstageid IS NULL)";
        $events = $DB->get_records_sql($sql, array($srcappraisalid));
        foreach ($events as $eventdata) {
            $event = new appraisal_message($eventdata->id);
            $event->id = 0;
            $event->appraisalid = $appraisalid;
            $event->timescheduled = 0;
            $event->triggered = 0;
            foreach ($event->messages as $message) {
                $message->id = 0;
            }
            $event->save();
        }
    }


    /**
     * Make copy of all events for stage
     *
     * @param int $srcstageid initial stage id
     * @param int $srcstageid destination stage id
     * @param int $appraisalid destination appraisal id
     */
    public static function duplicate_stage($srcstageid, $stageid, $appraisalid) {
        global $DB;
        $events = $DB->get_records('appraisal_event', array('appraisalstageid' => $srcstageid), '', 'id');
        foreach ($events as $eventdata) {
            $event = new appraisal_message($eventdata->id);
            $event->id = 0;
            $event->appraisalid = $appraisalid;
            $event->stageid = $stageid;
            $event->timescheduled = 0;
            $event->triggered = 0;
            foreach ($event->messages as $message) {
                $message->id = 0;
            }
            $event->save();
        }
    }
}


/**
 * Listener for appraisal specific events
 * This class registered as listener in /totara/event/listeners.php
 */
class appraisal_event_handler {
    /**
     * Activation message handler
     * If message is not immediate - add sheduled event
     * Also process stage_due as technically it's not an event but scheduled action
     *
     * @param appraisal $appraisal
     * @param int $time current time (server time will be used if not set)
     */
    public static function appraisal_activation($appraisal, $time = 0) {
        global $DB;
        if (!$time) {
            $time = time();
        }
        $appraisalid = $appraisal->id;
        $sql = "SELECT id FROM {appraisal_event} WHERE triggered = 0 AND event IN (?, ?) AND appraisalid = ?";
        $params = array(appraisal_message::EVENT_APPRAISAL_ACTIVATION, appraisal_message::EVENT_STAGE_DUE, $appraisalid);
        $events = $DB->get_records_sql($sql, $params);
        foreach ($events as $id => $eventdata) {
            $eventmessage = new appraisal_message($id);
            self::process_event($eventmessage, $time);
        }
    }


    /**
     * Stage complete message handler
     *
     * @param stdClass $event
     */
    public static function appraisal_stage_completed($stage, $time = 0) {
        global $DB;
        if (!$time) {
            $time = time();
        }
        $stageid = $stage->id;
        $sql = "SELECT id FROM {appraisal_event} WHERE triggered = 0 AND event = ? AND appraisalstageid = ?";
        $params = array(appraisal_message::EVENT_STAGE_COMPLETE, $stageid);
        $events = $DB->get_records_sql($sql, $params);
        foreach ($events as $id => $eventdata) {
            self::process_event(new appraisal_message($id), $time);
        }
    }


    /**
     * Send or schedule messages according time and settings
     *
     * @param appraisal_message $event
     * @param int $time
     */
    protected static function process_event(appraisal_message $event, $time) {
        if ($event->is_immediate()) {
            $event->send();
        } else {
            $event->schedule($event->get_schedule_from($time));
            $event->save();
        }
    }


    /**
     * Get's all scheduled untriggered messages and send's them
     *
     * @param int $time current time
     */
    public static function send_scheduled($time) {
        global $DB;
        $sql = "SELECT ae.id
                FROM {appraisal_event} ae JOIN {appraisal} a ON (ae.appraisalid = a.id)
                WHERE a.status = ? AND timescheduled > 0 AND triggered = 0";
        $events = $DB->get_records_sql($sql, array(appraisal::STATUS_ACTIVE));
        foreach ($events as $id => $eventdata) {
            $event = new appraisal_message($id);
            if ($event->is_time($time)) {
                $event->send();
            }
        }
    }
}


/**
 * Serves the folder files.
 *
 * @package  mod_folder
 * @category files
 * @param stdClass $course course object
 * @param stdClass $cm course module
 * @param stdClass $context context object
 * @param string $filearea file area
 * @param array $args extra arguments
 * @param bool $forcedownload whether or not force download
 * @param array $options additional options affecting the file serving
 * @return bool false if file not found, does not return if found - just send the file
 */
function totara_appraisal_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options=array()) {
    global $USER, $DB;

    $issnapshot = (strpos($filearea, 'snapshot') !== false);
    if ($issnapshot) {
        $itemid = $role = (int)array_shift($args);
        // Todo: Check role.
    } else {
        if (strpos($filearea, 'quest_fixedimage') === 0) {
            $questionid = (int)str_replace('quest_fixedimage_', '', $filearea);
            $filearea = 'quest_fixedimage';
            $itemid = $assignmentid = (int)array_shift($args);
        } else {
            $questionid = (int)str_replace('quest_', '', $filearea);
            $itemid = $assignmentid = (int)array_shift($args);
            // Check that current user can view this file.
        }

        if (!$question = new appraisal_question($questionid)) {
            send_file_not_found();
        }

        // TODO: Permissions checks and display of read-only question files
        // Cannot use assignmentid as it is not known when the question is created
        // also cannot use itemid as it is also not know until after creation

        /*if (!$question->user_can_view($assignmentid, $USER->id)) {
            send_file_not_found();
        }*/
    }
    $filename = array_shift($args);
    $fs = get_file_storage();

    if (!$file = $fs->get_file($context->id, 'totara_appraisal', $filearea, $itemid, '/', $filename)) {
        send_file_not_found();
    }
    session_get_instance()->write_close();
    send_stored_file($file, 60*60, 0, $forcedownload, $options);
}
