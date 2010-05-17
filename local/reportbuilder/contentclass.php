<?php

abstract class content_base {
    /*
     * All sub classes must define the following functions
     */
    abstract function sql_restriction($field, $options);
    abstract function human_restriction($title, $options);
    abstract function form_template(&$mform, $settings);
}

class current_org extends content_base {
    function sql_restriction($field, $options) {
        global $CFG,$USER;
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

        $userid = $USER->id;
        // get the user's organisationid (for primary position)
        $orgid = get_field('pos_assignment','organisationid','userid',$userid, 'type', 1);
        // no results if they don't have one
        if(empty($orgid)) {
            return 'FALSE';
        }

        if($options['recursive']) {
            // get list of organisations to find users for
            $hierarchy = new organisation();
            $children = $hierarchy->get_item_descendants($orgid);
            $olist = array();
            foreach($children as $child) {
                $olist[] = "'{$child->id}'";
            }
        } else {
            $olist = array($orgid);
        }

        // return users who are in an organisation in that list
        $users = get_records_select('pos_assignment',"organisationid IN (".implode(',',$olist).")",'','userid');
        $ulist = array();
        foreach ($users as $user) {
            $ulist[] = $user->userid;
        }
        return $field.' IN ('. implode(',',$ulist). ')';
    }

    function human_restriction($title, $options) {
        global $USER;
        $userid = $USER->id;
        $orgid = get_field('pos_assignment', 'organisationid', 'userid', $userid, 'type', 1);
        $orgname = get_field('org','fullname','id', $orgid);
        $children = $options['recursive'] ? ' '.get_string('orsuborg','local') : '';
        return $title . ' ' . get_string('is','local') .' "'.$orgname.'"'.$children;
    }

    function form_template(&$mform, $settings) {

        $enable = isset($settings['current_org']['enable']) ? $settings['current_org']['enable'] : 0;
        $recursive = isset($settings['current_org']['recursive']) ? $settings['current_org']['recursive'] : 0;
        $mform->addElement('header', 'current_org_header', get_string('showbycurrentorg','local'));
        $mform->addElement('checkbox', 'current_org_enable', '', get_string('currentorgenable','local'));
        $mform->setDefault('current_org_enable', $enable);
        $mform->disabledIf('current_org_enable','contentenabled', 'eq', 0);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'current_org_recursive', '', get_string('yes'), 1);
        $radiogroup[] =& $mform->createElement('radio', 'current_org_recursive', '', get_string('no'), 0);
        $mform->addGroup($radiogroup, 'current_org_recursive_group', get_string('includechildorgs','local'), '<br />', false);
        $mform->setDefault('current_org_recursive', $recursive);
        $mform->disabledIf('current_org_recursive_group','contentenabled', 'eq', 0);
        $mform->disabledIf('current_org_recursive_group','current_org_enable', 'notchecked');
        $mform->setHelpButton('current_org_header', array('reportbuildercurrentorg',get_string('showbycurrentorg','local'),'moodle'));
    }
}

class completed_org extends content_base {
    function sql_restriction($field, $options) {
        global $CFG,$USER;
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

        $userid = $USER->id;
        // get the user's organisationid (for primary position)
        $orgid = get_field('pos_assignment','organisationid','userid',$userid, 'type', 1);
        // no results if they don't have one
        if(empty($orgid)) {
            return 'FALSE';
        }
        if($options['recursive']) {
            // get list of organisations to match against
            $hierarchy = new organisation();
            $children = $hierarchy->get_item_descendants($orgid);
            $olist = array();
            foreach($children as $child) {
                $olist[] = "'{$child->id}'";
            }
            return $field.' IN ('. implode(',',$olist).')';
        } else {
            // just the users organisation
            return $field.' = '. $orgid;
        }
    }

    function human_restriction($title, $options) {
        global $USER;
        $userid = $USER->id;
        $orgid = get_field('pos_assignment', 'organisationid','userid',$userid,'type', 1);
        if(empty($orgid)) {
            return $title .' '. get_string('is','local') . ' "UNASSIGNED"';
        }
        $orgname = get_field('org','fullname','id',$orgid);
        $children = $options['recursive'] ? ' '.get_string('orsuborg','local') : '';
        return $title . ' '. get_string('is','local') . ' "'. $orgname.'"'.$children;
    }

    function form_template(&$mform, $settings) {
        $enable = isset($settings['completed_org']['enable']) ? $settings['completed_org']['enable'] : 0;
        $recursive = isset($settings['completed_org']['recursive']) ? $settings['completed_org']['recursive'] : 0;
        $mform->addElement('header', 'completed_org_header', get_string('showbycompletedorg','local'));
        $mform->addElement('checkbox', 'completed_org_enable', '', get_string('completedorgenable','local'));
        $mform->setDefault('completed_org_enable', $enable);
        $mform->disabledIf('completed_org_enable','contentenabled', 'eq', 0);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'completed_org_recursive', '', get_string('yes'), 1);
        $radiogroup[] =& $mform->createElement('radio', 'completed_org_recursive', '', get_string('no'), 0);
        $mform->addGroup($radiogroup, 'completed_org_recursive_group', get_string('includechildorgs','local'), '<br />', false);
        $mform->setDefault('completed_org_recursive', $recursive);
        $mform->disabledIf('completed_org_recursive_group','contentenabled', 'eq', 0);
        $mform->disabledIf('completed_org_recursive_group','completed_org_enable', 'notchecked');
        $mform->setHelpButton('completed_org_header', array('reportbuildercompletedorg',get_string('showbycompletedorg','local'),'moodle'));
    }
}

class user extends content_base {
    function sql_restriction($field, $options) {
        global $USER;
        $who = isset($options['who']) ? $options['who'] : null;
        if($who == 'own') {
            // show own records
            return $field.' = '.$USER->id;
        } else if ($who == 'reports') {
            // show staff records
            if($staff = mitms_get_staff()) {
                return $field.' IN ('. implode(',', $staff).')';
            } else {
                return 'FALSE';
            }
        } else if ($who == 'ownandreports') {
            // show own and staff records
            if($staff = mitms_get_staff()) {
                return $field.' IN ('. $USER->id.','. implode(',', $staff).')';
            } else {
                return $field.' = '.$USER->id;
            }
        } else {
            // anything unexpected
            return 'FALSE';
        }
    }

    function human_restriction($title, $options) {
        global $USER;
        $user = get_record('user','id',$USER->id);
        switch ($options['who']) {
        case 'own':
            return $title.' '.get_string('is','local').' "'.fullname($user).'"';
        case 'reports':
            return $title.' '.get_string('reportsto','local').' "'.fullname($user).'"';
        case 'ownandreports':
            return $title.' '.get_string('is','local').' "'.fullname($user).'"'.get_string('or','local').get_string('reportsto','local').' "'.fullname($user).'"';
        default:
            return $title.' is NOT FOUND';
        }
    }

    function form_template(&$mform, $settings) {
        $enable = isset($settings['user']['enable']) ? $settings['user']['enable'] : 0;
        $who = isset($settings['user']['who']) ? $settings['user']['who'] : 1;
        $mform->addElement('header', 'user_header', get_string('showbyuser','local'));
        $mform->addElement('checkbox', 'user_enable', '', get_string('byuserenable','local'));
        $mform->disabledIf('user_enable','contentenabled', 'eq', 0);
        $mform->setDefault('user_enable', $enable);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'user_who', '', get_string('userownrecords','local'), 'own');
        $radiogroup[] =& $mform->createElement('radio', 'user_who', '', get_string('userstaffrecords','local'), 'reports');
        $radiogroup[] =& $mform->createElement('radio', 'user_who', '', get_string('both','local'), 'ownandreports');
        $mform->addGroup($radiogroup, 'user_who_group', get_string('includeuserrecords','local'), '<br />', false);
        $mform->setDefault('user_who', $who);
        $mform->disabledIf('user_who_group','contentenabled', 'eq', 0);
        $mform->disabledIf('user_who_group','user_enable', 'notchecked');
        $mform->setHelpButton('user_header', array('reportbuilderuser',get_string('showbyuser','local'),'moodle'));
    }
}

class thedate extends content_base {

    function sql_restriction($field, $options) {
        $now = time();
        switch ($options['when']) {
        case 'past':
            return $field.' < '. $now;
        case 'future':
            return $field.' > '. $now;
        case 'last30days':
            return '(' . $field . ' < ' . $now . ' AND ' . $field. ' > '. ($now - 60*60*24*30) . ')';
        case 'next30days':
            return '(' . $field . ' > '. $now . ' AND ' . $field. ' < '. ($now + 60*60*24*30) . ')';
        default:
            // no match
            return 'FALSE';
        }

    }

    function human_restriction($title, $options) {
        switch ($options['when']) {
        case 'past':
            return $title.' '.get_string('occurredbefore','local').' '.userdate(time(), '%c');
        case 'future':
            return $title.' '.get_string('occurredafter','local').' '.userdate(time(), '%c');
        case 'last30days':
            return $title.' '.get_string('occurredafter','local').' '.userdate(time() - 60*60*24*30, '%c'). get_string('and','local') . get_string('occurredbefore','local') . userdate(time(),'%c');

        case 'next30days':
            return $title.' '.get_string('occurredafter','local').' '.userdate(time(), '%c'). get_string('and','local') . get_string('occurredbefore','local') . userdate(time() + 60*60*24*30,'%c');
        default:
            return 'Error with date content restriction';
        }
    }

    function form_template(&$mform, $settings) {
        $enable = isset($settings['thedate']['enable']) ? $settings['thedate']['enable'] : 0;
        $when = isset($settings['thedate']['when']) ? $settings['thedate']['when'] : 'past';
        $mform->addElement('header', 'thedate_header', get_string('showbydate','local'));
        $mform->addElement('checkbox', 'thedate_enable', '', get_string('bydateenable','local'));
        $mform->setDefault('thedate_enable', $enable);
        $mform->disabledIf('thedate_enable', 'contentenabled', 'eq', 0);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'thedate_when', '', get_string('thepast','local'), 'past');
        $radiogroup[] =& $mform->createElement('radio', 'thedate_when', '', get_string('thefuture','local'), 'future');
        $radiogroup[] =& $mform->createElement('radio', 'thedate_when', '', get_string('last30days','local'), 'last30days');
        $radiogroup[] =& $mform->createElement('radio', 'thedate_when', '', get_string('next30days','local'), 'next30days');
        $mform->addGroup($radiogroup, 'thedate_when_group', get_string('includerecordsfrom','local'), '<br />', false);
        $mform->setDefault('thedate_when', $when);
        $mform->disabledIf('thedate_when_group','contentenabled', 'eq', 0);
        $mform->disabledIf('thedate_when_group','thedate_enable', 'notchecked');
        $mform->setHelpButton('thedate_header', array('reportbuilderdate',get_string('showbydate','local'),'moodle'));
    }

}
