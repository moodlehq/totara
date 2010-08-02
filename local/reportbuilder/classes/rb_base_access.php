<?php

abstract class rb_base_access {
    /*
     * All sub classes must define the following functions
     */
    abstract function access_restriction($reportid);
    abstract function form_template(&$mform, $reportid);
    abstract function form_process($reportid, $fromform);

} // end of rb_base_access class

class rb_role_access extends rb_base_access {

    function access_restriction($reportid) {
        global $CFG, $USER;
        // return true if user has rights to access by role

        // remove the rb_ from class
        $type = substr(get_class($this), 3);
        $allowedroles = reportbuilder::get_setting($reportid, $type, 'activeroles');
        $contextsetting = reportbuilder::get_setting($reportid, $type, 'context');

        if($contextsetting == 'any') {
            // find roles the user has in any context
            $userroles = get_records_sql_menu("SELECT DISTINCT roleid, 1
                FROM {$CFG->prefix}role_assignments
                WHERE userid = $USER->id");
            if(!$userroles) {
                $userroles = array();
            }
        } else {
            // only find roles the user has in the site context
            // default to this if not set
            $context = get_context_instance(CONTEXT_SYSTEM);
            $userroles = array();
            if($data = get_user_roles($context, 0, false)) {
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

    function form_template(&$mform, $reportid) {
        // remove the rb_ from class
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $activeroles = explode('|',
            reportbuilder::get_setting($reportid, $type, 'activeroles'));
        $context = reportbuilder::get_setting($reportid, $type, 'context');

        // generate the check boxes for the access form
        $mform->addElement('header', 'accessbyroles', get_string('accessbyrole', 'local'));

        //TODO replace with checkbox once there is more than one option
        $mform->addElement('hidden', 'role_enable', 1);

        if ($roles = get_records('role','','','sortorder')) {
            $contextoptions = array('site' => get_string('systemcontext','local'), 'any' => get_string('anycontext','local'));

            // set context for role-based access
            $mform->addElement('select','role_context', get_string('context', 'local'), $contextoptions);
            $mform->setDefault('role_context', $context);
            $mform->disabledIf('role_context', 'accessenabled', 'eq', 0);
            $mform->setHelpButton('role_context', array('reportbuildercontext',get_string('context','local'),'moodle'));

            $rolesgroup = array();
            foreach($roles as $role) {
                $rolesgroup[] =& $mform->createElement('advcheckbox', "role_activeroles[{$role->id}]", '', $role->name, null, array(0, 1));
                if(in_array($role->id, $activeroles)) {
                    $mform->setDefault("role_activeroles[{$role->id}]", 1);
                }
            }
            $mform->addGroup($rolesgroup, 'roles', get_string('roleswithaccess','local'), '<br />', false);
            $mform->disabledIf('roles', 'accessenabled', 'eq', 0);
            $mform->setHelpButton('roles', array('reportbuilderrolesaccess',get_string('roleswithaccess','local'),'moodle'));
        } else {
            $mform->addElement('html', '<p>'.get_string('error:norolesfound','local').'</p>');
        }

    }

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
