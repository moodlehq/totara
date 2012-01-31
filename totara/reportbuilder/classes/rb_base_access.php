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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */
/**
 * Abstract base access class to be extended to create report builder access restrictions.
 *
 * Defines the properties and methods required by access restrictions
 *
 * This file also contains some core access restrictions
 * that can be used by any report builder source
 */
abstract class rb_base_access {

    public $foruser;

    /*
     * @param integer $foruser User ID to determine access for
     *                         Typically this will be $USER->id, except
     *                         in the case of scheduled reports run by cron
     */
    function __construct($foruser=null) {
        $this->foruser = $foruser;
    }

    /*
     * All sub classes must define the following functions
     */
    abstract function access_restriction($reportid);
    abstract function form_template(&$mform, $reportid);
    abstract function form_process($reportid, $fromform);

} // end of rb_base_access class

class rb_role_access extends rb_base_access {

    /**
     * Check if the user has rights for a particular access restriction
     *
     * @param integer $reportid ID of the report to check access for
     *
     * @return boolean True if user has access rights
     */
    function access_restriction($reportid) {
        global $CFG;
        // return true if user has rights to access by role

        // remove the rb_ from class
        $type = substr(get_class($this), 3);
        $allowedroles = reportbuilder::get_setting($reportid, $type, 'activeroles');
        $contextsetting = reportbuilder::get_setting($reportid, $type, 'context');
        $userid = $this->foruser;

        if($contextsetting == 'any') {
            // find roles the user has in any context
            $userroles = get_records_sql_menu("SELECT DISTINCT roleid, 1
                FROM {$CFG->prefix}role_assignments
                WHERE userid = $userid");
            if(!$userroles) {
                $userroles = array();
            }
        } else {
            // only find roles the user has in the site context
            // default to this if not set
            $context = get_context_instance(CONTEXT_SYSTEM);
            $userroles = array();
            if($data = get_user_roles($context, $userid, false)) {
                foreach($data as $item) {
                    $userroles[$item->roleid] = 1;
                }
            }
        }

        // see if user has any allowed roles
        foreach(explode('|', $allowedroles) as $allowedrole) {
            if(array_key_exists($allowedrole, $userroles)) {
                return true;
            }
        }
        return false;
    }


    /**
     * Adds form elements required for this access restriction's settings page
     *
     * @param object &$mform Moodle form object to modify (passed by reference)
     * @param integer $reportid ID of the report being adjusted
     */
    function form_template(&$mform, $reportid) {
        // remove the rb_ from class
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $activeroles = explode('|',
            reportbuilder::get_setting($reportid, $type, 'activeroles'));
        $context = reportbuilder::get_setting($reportid, $type, 'context');

        // generate the check boxes for the access form
        $mform->addElement('header', 'accessbyroles', get_string('accessbyrole', 'local_reportbuilder'));

        //TODO replace with checkbox once there is more than one option
        $mform->addElement('hidden', 'role_enable', 1);

        if ($roles = get_records('role','','','sortorder')) {
            $contextoptions = array('site' => get_string('systemcontext','local_reportbuilder'), 'any' => get_string('anycontext','local_reportbuilder'));

            // set context for role-based access
            $mform->addElement('select','role_context', get_string('context', 'local_reportbuilder'), $contextoptions);
            $mform->setDefault('role_context', $context);
            $mform->disabledIf('role_context', 'accessenabled', 'eq', 0);
            $mform->setHelpButton('role_context', array('reportbuildercontext',get_string('context','local_reportbuilder'),'local_reportbuilder'));

            $rolesgroup = array();
            foreach($roles as $role) {
                $rolesgroup[] =& $mform->createElement('advcheckbox', "role_activeroles[{$role->id}]", '', $role->name, null, array(0, 1));
                if(in_array($role->id, $activeroles)) {
                    $mform->setDefault("role_activeroles[{$role->id}]", 1);
                }
            }
            $mform->addGroup($rolesgroup, 'roles', get_string('roleswithaccess','local_reportbuilder'), '<br />', false);
            $mform->disabledIf('roles', 'accessenabled', 'eq', 0);
            $mform->setHelpButton('roles', array('reportbuilderrolesaccess',get_string('roleswithaccess','local_reportbuilder'),'local_reportbuilder'));
        } else {
            $mform->addElement('html', '<p>'.get_string('error:norolesfound','local_reportbuilder').'</p>');
        }

    }

    /**
     * Processes the form elements created by {@link form_template()}
     *
     * @param integer $reportid ID of the report to process
     * @param object $fromform Moodle form data received via form submission
     *
     * @return boolean True if form was successfully processed
     */
    function form_process($reportid, $fromform) {
        // save the results of submitting the access form to
        // report_builder_settings
        $status = true;
        // remove the rb_ from class
        $type = substr(get_class($this), 3);

        // enable checkbox option
        // TODO not yet used as there is only one access criteria so far
        $enable = (isset($fromform->role_enable) &&
            $fromform->role_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        if(isset($fromform->role_context)) {
            $context = $fromform->role_context;
            $status = $status && reportbuilder::update_setting($reportid,
                $type, 'context', $context);
        }

        $activeroles = array();
        if(isset($fromform->role_activeroles)) {
            foreach($fromform->role_activeroles as $roleid => $setting) {
                if($setting == 1) {
                    $activeroles[] = $roleid;
                }
            }
            // implode into string and update setting
            $status = $status && reportbuilder::update_setting($reportid,
                $type, 'activeroles', implode('|', $activeroles));

        }
        return $status;
    }

} // end of rb_role_access
