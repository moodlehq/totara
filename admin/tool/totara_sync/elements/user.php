<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage totara_sync
 */

require_once($CFG->dirroot.'/admin/tool/totara_sync/elements/classes/element.class.php');
require_once($CFG->dirroot.'/totara/customfield/fieldlib.php');
require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');

class totara_sync_element_user extends totara_sync_element {

    function get_name() {
        return 'user';
    }

    function has_config() {
        return true;
    }

    function config_form(&$mform) {
        $mform->addElement('selectyesno', 'sourceallrecords', get_string('sourceallrecords', 'tool_totara_sync'));
        $mform->addElement('static', 'sourceallrecordsdesc', '', get_string('sourceallrecordsdesc', 'tool_totara_sync'));
        $options = array('' => get_string('keep', 'tool_totara_sync'),
            'delete' => get_string('delete', 'tool_totara_sync'));
        $mform->addElement('select', 'removeuser', get_string('removeusers', 'tool_totara_sync'), $options);
        $mform->addElement('static', 'removeuserdesc', '', get_string('removeusersdesc', 'tool_totara_sync'));
    }

    function config_save($data) {
        $this->set_config('removeuser', $data->removeuser);
        $this->set_config('sourceallrecords', $data->sourceallrecords);
    }

    function sync() {
        global $DB, $CFG;

        $this->addlog(get_string('syncstarted', 'tool_totara_sync'), 'info', 'usersync');

        if (!$synctable = $this->get_source_sync_table()) {
            throw new totara_sync_exception('user', 'usersync', 'couldnotgetsourcetable');
        }

        if (!$synctable_clone = $this->get_source_sync_table_clone($synctable)) {
            throw new totara_sync_exception('user', 'usersync', 'couldnotcreateclonetable');
        }

        if (!$this->check_sanity($synctable, $synctable_clone)) {
            throw new totara_sync_exception('user', 'usersync', 'sanitycheckfailed');
        }

        ///
        /// delete obsolete users
        ///
        if (!empty($this->config->removeuser) && $this->config->removeuser == 'delete') {
            if (empty($this->config->sourceallrecords)) {
                // Get records with "deleted" flag set
                $sql = "SELECT u.id, u.idnumber, u.auth
                         FROM {{$synctable}} s
                   INNER JOIN {user} u ON (s.idnumber = u.idnumber)
                        WHERE u.totarasync=1 AND u.deleted = 0 AND s.deleted = 1";
            } else {
                // All records provided by source - get missing user records
                $sql = "SELECT u.id, u.idnumber, u.auth
                          FROM {user} u
               LEFT OUTER JOIN {{$synctable}} s ON (u.idnumber=s.idnumber)
                         WHERE u.totarasync=1 AND s.idnumber IS NULL AND u.deleted=0";
            }

            if ($rs = $DB->get_recordset_sql($sql)) {
                foreach ($rs as $user) {
                    // remove user
                    try {
                        delete_user($DB->get_record('user', array('id' => $user->id)));
                        $this->addlog(get_string('deleteduserx', 'tool_totara_sync', $user->idnumber),
                            'info', 'deleteuser');
                    } catch (Exception $e) {
                        throw new totara_sync_exception('user', 'deleteuser',
                            'cannotdeleteuserx', $user->idnumber, $e->getMessage());
                    }
                }
                $rs->close();
            }
        }

        if (isset($this->config->sourceallrecords) && $this->config->sourceallrecords == 0) {
            // Remove the deleted records from the sync table
            // This ensures that our create/update queries runs smoothly
            $DB->execute("DELETE FROM {{$synctable}} WHERE deleted = 1");
        }


        ///
        /// create missing accounts
        ///
        $sql = "SELECT s.*
                  FROM {{$synctable}} s
       LEFT OUTER JOIN {user} u ON (s.idnumber=u.idnumber)
                 WHERE (u.idnumber IS NULL)";
        if ($rs = $DB->get_recordset_sql($sql)) {
            foreach ($rs as $suser) {
                 try {
                     $this->create_user($suser, $synctable);
                     $this->addlog(get_string('createduserx', 'tool_totara_sync', $suser->idnumber),
                         'info', 'createuser');
                 } catch (Exception $e) {
                     throw new totara_sync_exception('user', 'createuser',
                         'cannotcreateuserx', $suser->idnumber, $e->getMessage());
                 }
            }
            $rs->close(); // free mem
        }

        ///
        /// update existing accounts
        ///
        $sql = "SELECT s.*, u.id AS uid
                  FROM {user} u
            INNER JOIN {{$synctable}} s ON (u.idnumber=s.idnumber)
                 WHERE u.totarasync=1
                   AND (s.timemodified = 0 OR u.timemodified != s.timemodified)";  // if no timemodified, always update
        if ($rs = $DB->get_recordset_sql($sql)) {
            foreach ($rs as $suser) {
                $user = $DB->get_record('user', array('id' => $suser->uid));
                if (!empty($user->deleted)) {
                    // Revive previously-deleted user
                    if (undelete_user($user)) {
                        $user->deleted = 0;

                        // tag the revived user for new password generation (if applicable)
                        $userauth = get_auth_plugin($user->auth);
                        if ($userauth->can_change_password()) {
                            set_user_preference('auth_forcepasswordchange', 1, $user->id);
                            set_user_preference('create_password',          1, $user->id);
                        }
                        unset($userauth);

                        $this->addlog(get_string('reviveduserx', 'tool_totara_sync', $suser->idnumber), 'info', 'updateusers');
                    } else {
                        $this->addlog(get_string('cannotreviveuserx', 'tool_totara_sync', $suser->idnumber), 'warn', 'updateusers');
                    }
                }

                $transaction = $DB->start_delegated_transaction();

                // update user
                $this->set_sync_user_fields($user, $suser);

                try {
                    $DB->update_record('user', $user);
                } catch (dml_exception $e) {
                    $transaction->rollback($e);
                    throw new totara_sync_exception('user', 'updateusers', 'cannotupdateuserx',
                        $user->idnumber, $e->getMessage());
                }

                // update user password
                if (isset($suser->password)) {
                    $userauth = get_auth_plugin($user->auth);
                    if ($userauth->can_change_password()) {
                        if (!$userauth->user_update_password($user, $suser->password)) {
                            $this->addlog(get_string('cannotsetuserpassword', 'tool_totara_sync', $user->idnumber), 'warn', 'updateusers');
                        }
                    } else {
                        $this->addlog(get_string('cannotsetuserpasswordnoauthsupport', 'tool_totara_sync', $user->idnumber), 'warn', 'updateusers');
                    }
                    unset($userauth);
                }

                // update user assignment data
                $this->sync_user_assignments($user, $suser);

                // update custom field data
                if ($customfields = json_decode($suser->customfields)) {
                    require_once($CFG->dirroot.'/user/profile/lib.php');
                    foreach ($customfields as $name => $value) {
                        $profile = str_replace('customfield_', 'profile_field_', $name);
                        $user->{$profile} = $value;
                    }
                    profile_save_data($user);
                }

                $this->addlog(get_string('updateduserx', 'tool_totara_sync', $suser->idnumber), 'info', 'updateusers');

                $transaction->allow_commit();
            }
            $rs->close();
            unset($user, $pos_assignment, $posdata); // free memory

        }

        $this->get_source()->drop_temp_table();
        $this->addlog(get_string('syncfinished', 'tool_totara_sync'), 'info', 'usersync');
    }

    /**
     * Create a user
     *
     * @param stdClass $suser escaped sync user object
     * @param string $synctable sync table name
     *
     * @return boolean true if successful
     * @throws totara_sync_exception
     */
    function create_user($suser, $synctable) {
        global $CFG, $DB;

        $transaction = $DB->start_delegated_transaction();

        if ($DB->record_exists('user', array('idnumber' => $suser->idnumber))) {
            // Record might have been created recursively
            return true;
        }

        // prep a few params
        $user = new stdClass;
        $user->username = strtolower($suser->username);  // usernames always lowercase in moodle
        $user->idnumber = $suser->idnumber;
        $user->confirmed = 1;
        $user->totarasync = 1;
        $user->mnethostid = $CFG->mnet_localhost_id;
        $user->lang = $CFG->lang;
        $this->set_sync_user_fields($user, $suser);

        try {
            $user->id = $DB->insert_record('user', $user);  // insert user
        } catch (Exception $e) {
            $transaction->rollback($e);
            throw new totara_sync_exception('user', 'createusers', 'cannotcreateuserx', $user->idnumber);
        }

        $userauth = get_auth_plugin($user->auth);
        if ($userauth->can_change_password()) {
            if (!isset($suser->password)) {
                // tag for password generation
                set_user_preference('auth_forcepasswordchange', 1, $user->id);
                set_user_preference('create_password',          1, $user->id);
            } else {
                // set user password
                if (!$userauth->user_update_password($user, $suser->password)) {
                    $this->addlog(get_string('cannotsetuserpassword', 'tool_totara_sync', $user->idnumber), 'warn', 'createusers');
                }
            }
        }
        unset($userauth);

        // ensure user's manager exists
        if (!empty($suser->manageridnumber) && !$DB->record_exists('user', array('idnumber' => $suser->manageridnumber))) {
            // Create user's manager first (recursive)
            $sql = "SELECT *
                      FROM {{$synctable}}
                     WHERE idnumber = ? ";

            if (!$smanager = $DB->get_record_sql($sql, array($suser->manageridnumber))) {
                $exception = new totara_sync_exception('user', 'createusers', 'cannotfindmanagerxforusery',
                    (object)array('manageridnumber' => $suser->manageridnumber,
                    'idnumber' => $suser->idnumber));
                $transaction->rollback($exception);
                throw $exception;
            }

            try {
                $this->create_user($smanager, $synctable);
            } catch (totara_sync_exception $e) {
                $transaction->rollback($e);
                throw new totara_sync_exception('user', 'createusers', 'cannotcreatemanagerxforusery',
                    (object)array('manageridnumber' => $suser->manageridnumber,
                    'idnumber' => $suser->idnumber), $e->getMessage());
            }
        }

        // create user assignments
        try {
            $this->sync_user_assignments($user, $suser);
        } catch (Exception $e) {
            $transaction->rollback($e);
            throw new totara_sync_exception('user', 'syncuserassignments',
                'cannotcreateuserassignments', $user->idnumber, $e->getMessage());
        }

        // add custom field data
        if ($customfields = json_decode($suser->customfields)) {
            require_once($CFG->dirroot.'/user/profile/lib.php');
            foreach ($customfields as $name => $value) {
                $profile = str_replace('customfield_', 'profile_field_', $name);
                $user->{$profile} = $value;
            }
            profile_save_data($user);
        }

        $this->addlog(get_string('createduserx', 'tool_totara_sync', $user->idnumber), 'info', 'createusers');

        $transaction->allow_commit();

        return true;
    }

    /**
     * Sync a user's position assignments
     *
     * @return boolean true on success
     */
    function sync_user_assignments($user, $suser) {
        global $DB;

        $pos_assignment = new position_assignment(array(
            'userid' => $user->id,
            'type' => POSITION_TYPE_PRIMARY
        ));

        $posdata = new stdClass;
        $posdata->fullname = get_string('placeholderposition', 'tool_totara_sync');
        $posdata->shortname = 'PP';
        $posdata->positionid = 0;
        $posdata->organisationid = 0;
        $posdata->managerid = 0;
        if (isset($suser->postitle)) {
            $posdata->fullname = $suser->postitle;
            $posdata->shortname = empty($suser->postitleshortname) ? $suser->postitle : $suser->postitleshortname;
        }
        if (!empty($suser->posidnumber)) {
            $pos = $DB->get_record('pos', array('idnumber' => $suser->posidnumber));
            $posdata->positionid = $pos->id;

            if (!isset($suser->postitle)) {
                // set title and shortname based on position
                $posdata->fullname = $pos->fullname;
                $posdata->shortname = $pos->shortname;
            }
        }
        if (!empty($suser->orgidnumber)) {
            $posdata->organisationid = $DB->get_field('org', 'id', array('idnumber' => $suser->orgidnumber));
        }
        $posdata->managerid = null;
        if (!empty($suser->manageridnumber)) {
            $posdata->managerid = $DB->get_field('user', 'id', array('idnumber' => $suser->manageridnumber));
        }

        position_assignment::set_properties($pos_assignment, $posdata);

        $pos_assignment->managerid = $posdata->managerid;
        assign_user_position($pos_assignment);

        return true;
    }

    function set_sync_user_fields(&$user, $suser) {
        if (isset($suser->username)) {
            $user->username = strtolower($suser->username);  // usernames always lowercase in moodle
        }
        if (isset($suser->firstname)) {
            $user->firstname = $suser->firstname;
        }
        if (isset($suser->lastname)) {
            $user->lastname = $suser->lastname;
        }
        if (isset($suser->email)) {
            $user->email = $suser->email;
        }
        if (isset($suser->city)) {
            $user->city = $suser->city;
        }
        if (isset($suser->country)) {
            $user->country = strtoupper($suser->country);
        }
        if (isset($suser->timezone)) {
            $user->timezone = $suser->timezone;
        }
        if (isset($suser->lang)) {
            $user->lang = $suser->lang;
        }
        if (isset($suser->description)) {
            $user->description = $suser->description;
        }
        if (isset($suser->url)) {
            $user->url = $suser->url;
        }
        if (isset($suser->institution)) {
            $user->institution = $suser->institution;
        }
        if (isset($suser->department)) {
            $user->department = $suser->department;
        }
        if (isset($suser->phone1)) {
            $user->phone1 = $suser->phone1;
        }
        if (isset($suser->phone2)) {
            $user->phone2 = $suser->phone2;
        }
        if (isset($suser->address)) {
            $user->address = $suser->address;
        }
        if (isset($suser->timemodified)) {
            $user->timemodified = empty($suser->timemodified) ? time() : $suser->timemodified;
        }
        $user->auth = isset($suser->auth) ? $suser->auth : 'manual';
    }

    function check_sanity($synctable, $synctable_clone) {
        global $DB;

        $elname = $this->get_name();

        // Get a row from the sync table, so we can check field existence
        if (!$syncfields = $DB->get_record_sql("SELECT * FROM {{$synctable}}", null, IGNORE_MULTIPLE)) {
            // nothing to check
            return true;
        }

        /// Check for duplicate idnumbers
        if (isset($syncfields->idnumber)) {
            $sql = "SELECT s.idnumber
                      FROM {{$synctable}} s
                  GROUP BY s.idnumber
                    HAVING count(s.idnumber) > 1";
            $rs = $DB->get_recordset_sql($sql);
            if ($rs->valid()) {
                foreach ($rs as $r) {
                    $this->addlog(get_string('duplicateuserswithidnumberx', 'tool_totara_sync', $r), 'error', 'checksanity');
                }
                $rs->close();
                return false;
            }
        }

        /// Check orgs
        if (isset($syncfields->orgidnumber)) {
            $sql = "SELECT DISTINCT(s.orgidnumber)
                      FROM {{$synctable}} s
           LEFT OUTER JOIN {org} o ON s.orgidnumber = o.idnumber
                     WHERE s.orgidnumber IS NOT NULL
                       AND s.orgidnumber != ''
                       AND o.idnumber IS NULL";
            if (empty($this->config->sourceallrecords)) {
                // Avoid users that will be deleted
                $sql .= ' AND s.deleted = 0';
            }
            $rs = $DB->get_recordset_sql($sql);
            if ($rs->valid()) {
                foreach ($rs as $r) {
                    $this->addlog(get_string('orgxnotexist', 'tool_totara_sync', $r->orgidnumber), 'error', 'checksanity');
                }
                $rs->close();
                return false;
            }
        }

        /// Check positions
        if (isset($syncfields->posidnumber)) {
            $sql = "SELECT DISTINCT(s.posidnumber)
                      FROM {{$synctable}} s
           LEFT OUTER JOIN {pos} p
                        ON s.posidnumber = p.idnumber
                     WHERE s.posidnumber IS NOT NULL
                       AND s.posidnumber != ''
                       AND p.idnumber IS NULL";
            if (empty($this->config->sourceallrecords)) {
                // Avoid users that will be deleted
                $sql .= ' AND s.deleted = 0';
            }

            $rs = $DB->get_recordset_sql($sql);
            if ($rs->valid()) {
                foreach ($rs as $r) {
                    $this->addlog(get_string('posxnotexist', 'tool_totara_sync', $r->posidnumber), 'error', 'checksanity');
                }
                $rs->close();
                return false;
            }
        }

        /// Check managers
        if (isset($syncfields->manageridnumber)) {
            $sql = "SELECT DISTINCT(s.manageridnumber)
                      FROM {{$synctable}} s
           LEFT OUTER JOIN {user} u
                        ON s.manageridnumber = u.idnumber
                     WHERE s.manageridnumber IS NOT NULL
                       AND s.manageridnumber != ''
                       AND u.idnumber IS NULL
                       AND s.manageridnumber NOT IN
                           (SELECT idnumber FROM {{$synctable_clone}})";
            $rs = $DB->get_recordset_sql($sql);

            if ($rs->valid()) {
                foreach ($rs as $r) {
                    $this->addlog(get_string('managerxnotexist', 'tool_totara_sync', $r->manageridnumber), 'error', 'checksanity');
                }
                $rs->close();
                return false;
            }
        }

        // Get all user records to be created/updated - exclude removed/unmodified users
        /*
        $sql = "SELECT s.*
            FROM {{$synctable}} s
            WHERE s.idnumber NOT IN
                (SELECT uu.idnumber
                FROM {user} uu
                LEFT OUTER JOIN {{$synctable}} ss ON (uu.idnumber = ss.idnumber)
                WHERE ss.idnumber IS NULL
                OR ss.timemodified = uu.timemodified)";
        $rs = $DB->get_recordset_sql($sql);

        foreach ($rs as $r) {
            /// Check custom fields
            if ($customfields = json_decode($r->customfields, true)) {
                $customfields = array_keys($customfields);
                foreach ($customfields as $c) {
                    $shortname = str_replace('customfield_', '', $c);
                    if (!$DB->record_exists('user_info_field', array('shortname' => $shortname))) {
                        $this->addlog("custom field {$shortname} does not exist", 'error', 'checksanity');
                        return false;
                    }
                }
            }
        }
        $rs->close();
        */

        return true;
    }
}
