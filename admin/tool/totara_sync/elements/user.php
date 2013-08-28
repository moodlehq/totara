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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage totara_sync
 */

require_once($CFG->dirroot.'/admin/tool/totara_sync/elements/classes/element.class.php');
require_once($CFG->dirroot.'/totara/customfield/fieldlib.php');
require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');

class totara_sync_element_user extends totara_sync_element {

    protected $customfieldsdb = array();

    function get_name() {
        return 'user';
    }

    function has_config() {
        return true;
    }

    /**
     * Set customfieldsdb property with menu of choices options
     */
    function set_customfieldsdb() {
        global $DB;

        $rs = $DB->get_recordset('user_info_field', array('datatype' => 'menu'), '', 'shortname, param1');
        if ($rs->valid()) {
            foreach ($rs as $r) {
                $this->customfieldsdb['customfield_'.$r->shortname] = array_map('strtolower', explode("\n", $r->param1));
            }
        }
        $rs->close();
    }

    function config_form(&$mform) {
        $mform->addElement('selectyesno', 'sourceallrecords', get_string('sourceallrecords', 'tool_totara_sync'));
        $mform->addElement('static', 'sourceallrecordsdesc', '', get_string('sourceallrecordsdesc', 'tool_totara_sync'));
        $options = array('' => get_string('keep', 'tool_totara_sync'), 'delete' => get_string('delete', 'tool_totara_sync'));
        $mform->addElement('select', 'removeuser', get_string('removeusers', 'tool_totara_sync'), $options);
        $mform->addElement('static', 'removeuserdesc', '', get_string('removeusersdesc', 'tool_totara_sync'));
        $mform->addElement('selectyesno', 'allowduplicatedemails', get_string('allowduplicatedemails', 'tool_totara_sync'));
        $mform->addElement('static', 'allowduplicatedemailsdesc', '', get_string('allowduplicatedemailsdesc', 'tool_totara_sync'));
    }

    function config_save($data) {
        $this->set_config('removeuser', $data->removeuser);
        $this->set_config('sourceallrecords', $data->sourceallrecords);
        $this->set_config('allowduplicatedemails', $data->allowduplicatedemails);
        if (!empty($data->source_user)) {
            $source = $this->get_source($data->source_user);
            // Build link to source config
            $url = new moodle_url('/admin/tool/totara_sync/admin/sourcesettings.php', array('element' => $this->get_name(), 'source' => $source->get_name()));
            if ($source->has_config()) {
                // Set import_deleted and warn if necessary
                $import_deleted_new = ($data->sourceallrecords == 0) ? '1' : '0';
                $import_deleted_old = $source->get_config('import_deleted');
                if ($import_deleted_new != $import_deleted_old) {
                    $source->set_config('import_deleted', $import_deleted_new);
                    totara_set_notification(get_string('checkuserconfig', 'tool_totara_sync', $url->out()), null, array('class'=>'notifynotice'));
                }
            }
        }
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

        $this->set_customfieldsdb();

        $this->set_customfieldsdb();

        ///
        /// Delete obsolete users
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
                    // Remove user
                    try {
                        delete_user($DB->get_record('user', array('id' => $user->id)));
                        $this->addlog(get_string('deleteduserx', 'tool_totara_sync', $user->idnumber), 'info', 'deleteuser');
                    } catch (Exception $e) {
                        throw new totara_sync_exception('user', 'deleteuser', 'cannotdeleteuserx', $user->idnumber, $e->getMessage());
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

        $issane = $this->check_sanity($synctable, $synctable_clone);

        ///
        /// Create missing accounts
        ///
        $sql = "SELECT s.*
                  FROM {{$synctable}} s
       LEFT OUTER JOIN {user} u ON (s.idnumber=u.idnumber)
                 WHERE (u.idnumber IS NULL)";
        if ($rs = $DB->get_recordset_sql($sql)) {
            foreach ($rs as $suser) {
                try {
                    $this->create_user($suser);
                    $this->addlog(get_string('createduserx', 'tool_totara_sync', $suser->idnumber), 'info', 'createuser');
                } catch (Exception $e) {
                    $this->addlog(get_string('cannotcreateuserx', 'tool_totara_sync', $suser->idnumber), 'error', 'createuser');
                }
            }
            $rs->close(); // free mem
        }

        ///
        /// Update existing accounts
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

                        // Tag the revived user for new password generation (if applicable)
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

                // Update user
                $this->set_sync_user_fields($user, $suser);

                try {
                    $DB->update_record('user', $user);
                } catch (dml_exception $e) {
                    $transaction->rollback($e);
                    throw new totara_sync_exception('user', 'updateusers', 'cannotupdateuserx', $user->idnumber, $e->getMessage());
                }

                // Update user password
                if (isset($suser->password) && trim($suser->password) !== '') {
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

                // Update user assignment data
                $this->sync_user_assignments($user, $suser);

                // Update custom field data
                if ($customfields = json_decode($suser->customfields)) {
                    require_once($CFG->dirroot.'/user/profile/lib.php');
                    foreach ($customfields as $name => $value) {
                        $profile = str_replace('customfield_', 'profile_field_', $name);
                        $user->{$profile} = (isset($this->customfieldsdb[$name])) ? array_search(strtolower($value), $this->customfieldsdb[$name]) : $value;
                    }
                    profile_save_data($user);
                }

                $this->addlog(get_string('updateduserx', 'tool_totara_sync', $suser->idnumber), 'info', 'updateusers');

                $transaction->allow_commit();

                events_trigger('user_updated', $user);
            }
            $rs->close();
            unset($user, $pos_assignment, $posdata); // free memory

        }

        $this->get_source()->drop_table();
        $this->addlog(get_string('syncfinished', 'tool_totara_sync'), 'info', 'usersync');

        return $issane;
    }

    /**
     * Create a user
     *
     * @param stdClass $suser escaped sync user object
     *
     * @return boolean true if successful
     * @throws totara_sync_exception
     */
    function create_user($suser) {
        global $CFG, $DB;

        $transaction = $DB->start_delegated_transaction();

        // Prep a few params
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
            if (!isset($suser->password) || trim($suser->password) === '') {
                // Tag for password generation
                set_user_preference('auth_forcepasswordchange', 1, $user->id);
                set_user_preference('create_password',          1, $user->id);
            } else {
                // Set user password
                if (!$userauth->user_update_password($user, $suser->password)) {
                    $this->addlog(get_string('cannotsetuserpassword', 'tool_totara_sync', $user->idnumber), 'warn', 'createusers');
                }
            }
        }
        unset($userauth);

        // Create user assignments
        try {
            $this->sync_user_assignments($user, $suser);
        } catch (Exception $e) {
            $transaction->rollback($e);
            throw new totara_sync_exception('user', 'syncuserassignments', 'cannotcreateuserassignments', $user->idnumber, $e->getMessage());
        }

        // Add custom field data
        if ($customfields = json_decode($suser->customfields)) {
            require_once($CFG->dirroot.'/user/profile/lib.php');
            foreach ($customfields as $name => $value) {
                $profile = str_replace('customfield_', 'profile_field_', $name);
                $user->{$profile} = (isset($this->customfieldsdb[$name])) ? array_search(strtolower($value), $this->customfieldsdb[$name]) : $value;
            }
            profile_save_data($user);
        }

        $transaction->allow_commit();

        events_trigger('user_created', $user);

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

        // If we have no position info at all we do not need to set a position
        if (!isset($suser->postitle) && empty($suser->posidnumber) && !isset($suser->posstartdate)
            && !isset($suser->posenddate) && empty($suser->orgidnumber) && empty($suser->manageridnumber)) {
            return false;
        }
        $posdata = new stdClass;
        $posdata->fullname = $pos_assignment->fullname;
        $posdata->shortname = $pos_assignment->shortname;
        $posdata->positionid = $pos_assignment->positionid;
        $posdata->organisationid = $pos_assignment->organisationid;
        $posdata->managerid = $pos_assignment->managerid;
        if (isset($suser->postitle)) {
            $posdata->fullname = $suser->postitle;
            $posdata->shortname = empty($suser->postitleshortname) ? $suser->postitle : $suser->postitleshortname;
        }
        if (isset($suser->posidnumber)) {
            if (empty($suser->posidnumber)) {
                // Reset values.
                $posdata->positionid = 0;
            } else {
                $pos = $DB->get_record('pos', array('idnumber' => $suser->posidnumber));
                $posdata->positionid = $pos->id;
            }
        }
        if (isset($suser->posstartdate)) {
            if (empty($suser->posstartdate)) {
                $posdata->timevalidfrom = null;
            } else {
                $posdata->timevalidfrom = $suser->posstartdate;
            }
        }
        if (isset($suser->posenddate)) {
            if (empty($suser->posenddate)) {
                $posdata->timevalidto = null;
            } else {
                $posdata->timevalidto = $suser->posenddate;
            }
        }
        if (isset($suser->orgidnumber)) {
            if (empty($suser->orgidnumber)) {
                $posdata->organisationid = 0;
            } else {
                $posdata->organisationid = $DB->get_field('org', 'id', array('idnumber' => $suser->orgidnumber));
            }
        }
        if (isset($suser->manageridnumber)) {
            if (empty($suser->manageridnumber)) {
                $posdata->managerid = null;
            } else {
                try {
                    $posdata->managerid = $DB->get_field('user', 'id', array('idnumber' => $suser->manageridnumber, 'deleted' => 0), MUST_EXIST);
                } catch (dml_missing_record_exception $e) {
                    $posdata->managerid = null;
                }
            }
        }

        position_assignment::set_properties($pos_assignment, $posdata);

        $pos_assignment->managerid = $posdata->managerid;
        assign_user_position($pos_assignment);

        return true;
    }

    function set_sync_user_fields(&$user, $suser) {
        global $CFG;

        $fields = array('address', 'city', 'country', 'department', 'description',
            'email', 'firstname', 'institution', 'lang', 'lastname', 'phone1', 'phone2',
            'timemodified', 'timezone', 'url', 'username', 'suspended');

        $requiredfields = array('username', 'firstname', 'lastname', 'email');

        foreach ($fields as $field) {
            if (isset($suser->$field)) {
                if (!in_array($field, $requiredfields) || trim($suser->$field) !== '') {
                    // Not an empty required field - other fields are allowed to be empty
                    // Handle exceptions first
                    switch ($field) {
                        case 'username':
                            // Must be lower case
                            $user->$field = strtolower($suser->$field);
                            break;
                        case 'country':
                            if (!empty($suser->$field)) {
                                // Must be upper case
                                $user->$field = strtoupper($suser->$field);
                            } else if (empty($user->$field) && isset($CFG->country) && !empty($CFG->country)) {
                                // Sync and target are both empty - so use the default country
                                $user->$field = $CFG->country;
                            }
                            break;
                        case 'city':
                            if (!empty($suser->$field)) {
                                $user->$field = $suser->$field;
                            } else if (empty($user->$field) && isset($CFG->defaultcity) && !empty($CFG->defaultcity)) {
                                // Sync and target are both empty - So use the default city
                                $user->$field = $CFG->defaultcity;
                            }
                            break;
                        case 'timemodified':
                            // Default to now
                            $user->$field = empty($suser->$field) ? time() : $suser->$field;
                            break;
                        default:
                            $user->$field = $suser->$field;
                    }
                }
            }
        }

        $user->auth = isset($suser->auth) ? $suser->auth : 'manual';
    }

    /**
     * Check if the data contains invalid values
     *
     * @param string $synctable sync table name
     * @param string $synctable_clone sync clone table name
     *
     * @return boolean true if the data is valid, false otherwise
     */
    function check_sanity($synctable, $synctable_clone) {
        global $DB;

        $invalidids = array();

        // Get a row from the sync table, so we can check field existence
        if (!$syncfields = $DB->get_record_sql("SELECT * FROM {{$synctable}}", null, IGNORE_MULTIPLE)) {
            return; // nothing to check
        }

        // Get duplicated idnumbers
        $badids = $this->get_duplicated_values($synctable, $synctable_clone, 'idnumber', 'duplicateuserswithidnumberx');
        $invalidids = array_merge($invalidids, $badids);

        // Get duplicated usernames
        $badids = $this->get_duplicated_values($synctable, $synctable_clone, 'username', 'duplicateuserswithusernamex');
        $invalidids = array_merge($invalidids, $badids);
        // Check usernames against the DB to avoid saving repeated values
        $badids = $this->check_values_in_db($synctable, 'username', 'duplicateusernamexdb');
        $invalidids = array_merge($invalidids, $badids);

        if (isset($syncfields->email) && !$this->config->allowduplicatedemails) {
            // Get duplicated emails
            $badids = $this->get_duplicated_values($synctable, $synctable_clone, 'email', 'duplicateuserswithemailx');
            $invalidids = array_merge($invalidids, $badids);
            // Check emails against the DB to avoid saving repeated values
            $badids = $this->check_values_in_db($synctable, 'email', 'duplicateusersemailxdb');
            $invalidids = array_merge($invalidids, $badids);
        }

        // Get invalid positions
        if (isset($syncfields->posidnumber)) {
            $badids = $this->get_invalid_org_pos($synctable, 'pos', 'posidnumber', 'posxnotexist');
            $invalidids = array_merge($invalidids, $badids);
        }

        // Get invalid orgs
        if (isset($syncfields->orgidnumber)) {
            $badids = $this->get_invalid_org_pos($synctable, 'org', 'orgidnumber', 'orgxnotexist');
            $invalidids = array_merge($invalidids, $badids);
        }

        // Get invalid managers
        if (isset($syncfields->manageridnumber)) {
            $badids = $this->get_invalid_managers($synctable, $synctable_clone);
            $invalidids = array_merge($invalidids, $badids);
        }

        // Get invalid options (in case of menu of choices)
        if ($syncfields->customfields != '[]') {
            $badids = $this->validate_menu_of_choices($synctable);
            $invalidids = array_merge($invalidids, $badids);
        }

        if (count($invalidids)) {
            list($badids, $params) = $DB->get_in_or_equal($invalidids);
            $DB->execute("DELETE FROM {{$synctable}} WHERE id $badids", $params);
        }

        return !$invalidids;
    }

    /**
     * Get duplicated values for a specific field
     *
     * @param string $synctable sync table name
     * @param string $synctable_clone sync clone table name
     * @param string $field field name
     * @param string $identifier for logging messages
     *
     * @return array with invalid ids from synctable for duplicated values
     */
    function get_duplicated_values($synctable, $synctable_clone, $field, $identifier) {
        global $DB;

        $params = array();
        $invalidids = array();
        $extracondition = '';
        if (empty($this->config->sourceallrecords)) {
            $extracondition = "WHERE deleted = ?";
            $params[0] = 0;
        }
        $sql = "SELECT id, idnumber, $field
                  FROM {{$synctable}}
                 WHERE $field IN (SELECT $field FROM {{$synctable_clone}} $extracondition GROUP BY $field HAVING count($field) > 1)";
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $r) {
            $this->addlog(get_string($identifier, 'tool_totara_sync', $r), 'error', 'checksanity');
            $invalidids[] = $r->id;
        }
        $rs->close();

        return $invalidids;
    }

    /**
     * Get invalid organisations or positions
     *
     * @param string $synctable sync table name
     * @param string $table table name (org or pos)
     * @param string $field field name
     * @param string $identifier for logging messages
     *
     * @return array with invalid ids from synctable for organisations or positions that do not exist in the database
     */
    function get_invalid_org_pos($synctable, $table, $field, $identifier) {
        global $DB;

        $params = array();
        $invalidids = array();
        $sql = "SELECT s.id, s.idnumber, s.$field
                  FROM {{$synctable}} s
       LEFT OUTER JOIN {{$table}} t ON s.$field = t.idnumber
                 WHERE s.$field IS NOT NULL
                   AND s.$field != ''
                   AND t.idnumber IS NULL";
        if (empty($this->config->sourceallrecords)) {
            $sql .= ' AND s.deleted = ?'; // avoid users that will be deleted
            $params[0] = 0;
        }
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $r) {
            $this->addlog(get_string($identifier, 'tool_totara_sync', $r), 'error', 'checksanity');
            $invalidids[] = $r->id;
        }
        $rs->close();

        return $invalidids;
    }

    /**
     * Get invalid managers
     *
     * @param string $synctable sync table name
     * @param string $synctable_clone sync clone table name
     *
     * @return array with invalid ids from synctable for managers that do not exist in synctable nor in the database
     */
    function get_invalid_managers($synctable, $synctable_clone) {
        global $DB;

        $params = array();
        $invalidids = array();
        $sql = "SELECT s.id, s.idnumber, s.manageridnumber
                  FROM {{$synctable}} s
       LEFT OUTER JOIN {user} u
                    ON s.manageridnumber = u.idnumber
                 WHERE s.manageridnumber IS NOT NULL
                   AND s.manageridnumber != ''
                   AND u.idnumber IS NULL
                   AND s.manageridnumber NOT IN
                       (SELECT idnumber FROM {{$synctable_clone}})";
        if (empty($this->config->sourceallrecords)) {
            $sql .= ' AND s.deleted = ?'; // avoid users that will be deleted
            $params[0] = 0;
        }
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $r) {
            $this->addlog(get_string('managerxnotexist', 'tool_totara_sync', $r), 'error', 'checksanity');
            $invalidids[] = $r->id;
        }
        $rs->close();

        return $invalidids;
    }

    /**
     * Ensure options from menu of choices are valid
     *
     * @param string $synctable sync table name
     *
     * @return array with invalid ids from synctable for options that do not exist in the database
     */
    function validate_menu_of_choices($synctable) {
        global $DB;

        $params = empty($this->config->sourceallrecords) ? array('deleted' => 0) : array();
        $invalidids = array();
        $rs = $DB->get_recordset($synctable, $params, '', 'id, idnumber, customfields');
        foreach ($rs as $r) {
            $customfields = json_decode($r->customfields, true);
            if (!empty($customfields)) {
                foreach ($customfields as $name => $value) {
                    if (!isset($this->customfieldsdb[$name])) {
                        // Not a menu of choices.
                        continue;
                    }
                    if (trim($value) == '') {
                        // No value provided, this is okay.
                        continue;
                    }
                    // Check menu value matches one of the available options.
                    if (!in_array(strtolower($value), $this->customfieldsdb[$name])) {
                        $this->addlog(get_string('optionxnotexist', 'tool_totara_sync', (object)array('idnumber' => $r->idnumber, 'option' => $value, 'fieldname' => $name)), 'error', 'checksanity');
                        $invalidids[] = $r->id;
                        break;
                    }
                }
            }
        }
        $rs->close();

        return $invalidids;
    }

    /**
     * Avoid saving values from synctable that already exist in the database
     *
     * @param string $synctable sync table name
     * @param string $field field name
     * @param string $identifier for logging messages
     *
     * @return array with invalid ids from synctable for usernames or emails that are already registered in the database
     */
    function check_values_in_db($synctable, $field, $identifier) {
        global $DB;

        $params = array();
        $invalidids = array();
        $sql = "SELECT s.id, s.idnumber, s.$field
                  FROM {{$synctable}} s
            INNER JOIN {user} u ON s.idnumber <> u.idnumber
                   AND s.$field = u.$field";
        if (empty($this->config->sourceallrecords)) {
            $sql .= ' AND s.deleted = ?'; // avoid users that will be deleted
            $params[0] = 0;
        }
        $rs = $DB->get_recordset_sql($sql, $params);
        foreach ($rs as $r) {
            $this->addlog(get_string($identifier, 'tool_totara_sync', $r), 'error', 'checksanity');
            $invalidids[] = $r->id;
        }
        $rs->close();

        return $invalidids;
    }
}
