<?php // $Id$

/**
 * Abstract base content class to be extended to create report builder
 * content restrictions. This file also contains some core content restrictions
 * that can be used by any report builder source
 *
 * Defines the properties and methods required by content restrictions
 *
 * @copyright Totara Learning Solutions Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */
abstract class rb_base_content {
    /*
     * All sub classes must define the following functions
     */
    abstract function sql_restriction($field, $reportid);
    abstract function text_restriction($title, $reportid);
    abstract function form_template(&$mform, $reportid);
    abstract function form_process($reportid, $fromform);

}

///////////////////////////////////////////////////////////////////////////


/**
 * Restrict content by a position ID
 *
 * Pass in an integer that represents the position ID
 */
class rb_current_pos_content extends rb_base_content {
    /**
     * Generate the SQL to apply this content restriction
     *
     * @param string $field SQL field to apply the restriction against
     * @param integer $reportid ID of the report
     *
     * @return string SQL snippet to be used in a WHERE clause
     */
    function sql_restriction($field, $reportid) {
        global $CFG, $USER;
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $userid = $USER->id;
        // get the user's positionid (for primary position)
        $posid = get_field('pos_assignment', 'positionid', 'userid', $userid,
            'type', 1);
        // no results if they don't have one
        if(empty($posid)) {
            return 'FALSE';
        }

        if($settings['recursive']) {
            // get list of positions to find users for
            $hierarchy = new position();
            $children = $hierarchy->get_item_descendants($posid);
            $plist = array();
            foreach($children as $child) {
                $plist[] = "'{$child->id}'";
            }
        } else {
            $plist = array($posid);
        }

        // return users who are in a position in that list
        $users = get_records_select('pos_assignment',
            "positionid IN (" . implode(',', $plist) . ")", '', 'userid');
        $ulist = array();
        foreach ($users as $user) {
            $ulist[] = $user->userid;
        }
        return $field.' IN ('. implode(',',$ulist). ')';
    }

    /**
     * Generate a human-readable text string describing the restriction
     *
     * @param string $title Name of the field being restricted
     * @param integer $reportid ID of the report
     *
     * @return string Human readable description of the restriction
     */
    function text_restriction($title, $reportid) {
        global $USER;
        $userid = $USER->id;

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $posid = get_field('pos_assignment', 'positionid',
            'userid', $userid, 'type', 1);
        $posname = get_field('pos','fullname','id', $posid);
        $children = $settings['recursive'] ?
            ' ' . get_string('orsubpos','local_reportbuilder') : '';
        return $title . ' ' . get_string('is','local_reportbuilder') .' "' . $posname . '"' .
            $children;
    }

    /**
     * Adds form elements required for this content restriction's settings page
     *
     * @param object &$mform Moodle form object to modify (passed by reference)
     * @param integer $reportid ID of the report being adjusted
     */
    function form_template(&$mform, $reportid) {
        // get current settings
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $recursive = reportbuilder::get_setting($reportid, $type, 'recursive');

        $mform->addElement('header', 'current_pos_header',
            get_string('showbycurrentpos','local_reportbuilder'));
        $mform->addElement('checkbox', 'current_pos_enable', '',
            get_string('currentposenable','local_reportbuilder'));
        $mform->setDefault('current_pos_enable', $enable);
        $mform->disabledIf('current_pos_enable','contentenabled', 'eq', 0);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'current_pos_recursive',
            '', get_string('yes'), 1);
        $radiogroup[] =& $mform->createElement('radio', 'current_pos_recursive',
            '', get_string('no'), 0);
        $mform->addGroup($radiogroup, 'current_pos_recursive_group',
            get_string('includechildpos','local_reportbuilder'), '<br />', false);
        $mform->setDefault('current_pos_recursive', $recursive);
        $mform->disabledIf('current_pos_recursive_group', 'contentenabled',
            'eq', 0);
        $mform->disabledIf('current_pos_recursive_group', 'current_pos_enable',
            'notchecked');
        $mform->setHelpButton('current_pos_header',
            array('reportbuildercurrentpos',
            get_string('showbycurrentpos', 'local_reportbuilder'), 'local_reportbuilder'));
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
        $status = true;
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);

        // enable checkbox option
        $enable = (isset($fromform->current_pos_enable) &&
            $fromform->current_pos_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        // recursive radio option
        $recursive = isset($fromform->current_pos_recursive) ?
            $fromform->current_pos_recursive : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'recursive', $recursive);

        return $status;
    }
}



/**
 * Restrict content by an organisation ID
 *
 * Pass in an integer that represents the organisation ID
 */
class rb_current_org_content extends rb_base_content {
    /**
     * Generate the SQL to apply this content restriction
     *
     * @param string $field SQL field to apply the restriction against
     * @param integer $reportid ID of the report
     *
     * @return string SQL snippet to be used in a WHERE clause
     */
    function sql_restriction($field, $reportid) {
        global $CFG, $USER;
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $userid = $USER->id;
        // get the user's organisationid (for primary position)
        $orgid = get_field('pos_assignment', 'organisationid', 'userid', $userid,
            'type', 1);
        // no results if they don't have one
        if(empty($orgid)) {
            return 'FALSE';
        }

        if($settings['recursive']) {
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
        $users = get_records_select('pos_assignment',
            "organisationid IN (" . implode(',', $olist) . ")", '', 'userid');
        $ulist = array();
        foreach ($users as $user) {
            $ulist[] = $user->userid;
        }
        return $field.' IN ('. implode(',',$ulist). ')';
    }

    /**
     * Generate a human-readable text string describing the restriction
     *
     * @param string $title Name of the field being restricted
     * @param integer $reportid ID of the report
     *
     * @return string Human readable description of the restriction
     */
    function text_restriction($title, $reportid) {
        global $USER;
        $userid = $USER->id;

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $orgid = get_field('pos_assignment', 'organisationid',
            'userid', $userid, 'type', 1);
        $orgname = get_field('org','fullname','id', $orgid);
        $children = $settings['recursive'] ?
            ' ' . get_string('orsuborg','local_reportbuilder') : '';
        return $title . ' ' . get_string('is','local_reportbuilder') .' "' . $orgname . '"' .
            $children;
    }


    /**
     * Adds form elements required for this content restriction's settings page
     *
     * @param object &$mform Moodle form object to modify (passed by reference)
     * @param integer $reportid ID of the report being adjusted
     */
    function form_template(&$mform, $reportid) {
        // get current settings
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $recursive = reportbuilder::get_setting($reportid, $type, 'recursive');

        $mform->addElement('header', 'current_org_header',
            get_string('showbycurrentorg','local_reportbuilder'));
        $mform->addElement('checkbox', 'current_org_enable', '',
            get_string('currentorgenable','local_reportbuilder'));
        $mform->setDefault('current_org_enable', $enable);
        $mform->disabledIf('current_org_enable','contentenabled', 'eq', 0);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'current_org_recursive',
            '', get_string('yes'), 1);
        $radiogroup[] =& $mform->createElement('radio', 'current_org_recursive',
            '', get_string('no'), 0);
        $mform->addGroup($radiogroup, 'current_org_recursive_group',
            get_string('includechildorgs','local_reportbuilder'), '<br />', false);
        $mform->setDefault('current_org_recursive', $recursive);
        $mform->disabledIf('current_org_recursive_group', 'contentenabled',
            'eq', 0);
        $mform->disabledIf('current_org_recursive_group', 'current_org_enable',
            'notchecked');
        $mform->setHelpButton('current_org_header',
            array('reportbuildercurrentorg',
            get_string('showbycurrentorg', 'local_reportbuilder'), 'local_reportbuilder'));
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
        $status = true;
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);

        // enable checkbox option
        $enable = (isset($fromform->current_org_enable) &&
            $fromform->current_org_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        // recursive radio option
        $recursive = isset($fromform->current_org_recursive) ?
            $fromform->current_org_recursive : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'recursive', $recursive);

        return $status;
    }
}


/*
 * Restrict content by an organisation at time of completion
 *
 * Pass in an integer that represents an organisation ID
 */
class rb_completed_org_content extends rb_base_content {
    /**
     * Generate the SQL to apply this content restriction
     *
     * @param string $field SQL field to apply the restriction against
     * @param integer $reportid ID of the report
     *
     * @return string SQL snippet to be used in a WHERE clause
     */
    function sql_restriction($field, $reportid) {
        global $CFG,$USER;
        require_once($CFG->dirroot.'/hierarchy/lib.php');
        require_once($CFG->dirroot.'/hierarchy/type/organisation/lib.php');

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $userid = $USER->id;
        // get the user's organisationid (for primary position)
        $orgid = get_field('pos_assignment','organisationid','userid',$userid,
            'type', 1);
        // no results if they don't have one
        if(empty($orgid)) {
            return 'FALSE';
        }
        if($settings['recursive']) {
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

    /**
     * Generate a human-readable text string describing the restriction
     *
     * @param string $title Name of the field being restricted
     * @param integer $reportid ID of the report
     *
     * @return string Human readable description of the restriction
     */
    function text_restriction($title, $reportid) {
        global $USER;
        $userid = $USER->id;

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $orgid = get_field('pos_assignment', 'organisationid',
            'userid', $userid, 'type', 1);
        if(empty($orgid)) {
            return $title . ' ' . get_string('is','local_reportbuilder') . ' "UNASSIGNED"';
        }
        $orgname = get_field('org','fullname','id', $orgid);
        $children = $settings['recursive']
            ? ' ' . get_string('orsuborg','local_reportbuilder') : '';
        return $title . ' ' . get_string('is','local_reportbuilder') . ' "' . $orgname . '"' .
            $children;
    }


    /**
     * Adds form elements required for this content restriction's settings page
     *
     * @param object &$mform Moodle form object to modify (passed by reference)
     * @param integer $reportid ID of the report being adjusted
     */
    function form_template(&$mform, $reportid) {
        // get current settings
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $recursive = reportbuilder::get_setting($reportid, $type, 'recursive');

        $mform->addElement('header', 'completed_org_header',
            get_string('showbycompletedorg', 'local_reportbuilder'));
        $mform->addElement('checkbox', 'completed_org_enable', '',
            get_string('completedorgenable', 'local_reportbuilder'));
        $mform->setDefault('completed_org_enable', $enable);
        $mform->disabledIf('completed_org_enable','contentenabled', 'eq', 0);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'completed_org_recursive',
            '', get_string('yes'), 1);
        $radiogroup[] =& $mform->createElement('radio', 'completed_org_recursive',
            '', get_string('no'), 0);
        $mform->addGroup($radiogroup, 'completed_org_recursive_group',
            get_string('includechildorgs','local_reportbuilder'), '<br />', false);
        $mform->setDefault('completed_org_recursive', $recursive);
        $mform->disabledIf('completed_org_recursive_group','contentenabled',
            'eq', 0);
        $mform->disabledIf('completed_org_recursive_group',
            'completed_org_enable', 'notchecked');
        $mform->setHelpButton('completed_org_header',
            array('reportbuildercompletedorg',
            get_string('showbycompletedorg', 'local_reportbuilder'), 'local_reportbuilder'));
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
        $status = true;
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);

        // enable checkbox option
        $enable = (isset($fromform->completed_org_enable) &&
            $fromform->completed_org_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        // recursive radio option
        $recursive = isset($fromform->completed_org_recursive) ?
            $fromform->completed_org_recursive : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'recursive', $recursive);

        return $status;
    }
}


/*
 * Restrict content by a particular user or group of users
 *
 * Pass in an integer that represents a user's moodle id
 */
class rb_user_content extends rb_base_content {
    /**
     * Generate the SQL to apply this content restriction
     *
     * @param string $field SQL field to apply the restriction against
     * @param integer $reportid ID of the report
     *
     * @return string SQL snippet to be used in a WHERE clause
     */
    function sql_restriction($field, $reportid) {
        global $USER;

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $who = isset($settings['who']) ? $settings['who'] : null;
        if($who == 'own') {
            // show own records
            return $field . ' = ' . $USER->id;
        } else if ($who == 'reports') {
            // show staff records
            if($staff = totara_get_staff()) {
                return $field . ' IN (' . implode(',', $staff) .')';
            } else {
                return 'FALSE';
            }
        } else if ($who == 'ownandreports') {
            // show own and staff records
            if($staff = totara_get_staff()) {
                return $field . ' IN (' . $USER->id . ',' .
                    implode(',', $staff) . ')';
            } else {
                return $field . ' = ' . $USER->id;
            }
        } else {
            // anything unexpected
            return 'FALSE';
        }
    }

    /**
     * Generate a human-readable text string describing the restriction
     *
     * @param string $title Name of the field being restricted
     * @param integer $reportid ID of the report
     *
     * @return string Human readable description of the restriction
     */
    function text_restriction($title, $reportid) {
        global $USER;

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $user = get_record('user','id',$USER->id);
        switch ($settings['who']) {
        case 'own':
            return $title . ' ' . get_string('is','local_reportbuilder') . ' "' .
                fullname($user) . '"';
        case 'reports':
            return $title . ' ' . get_string('reportsto','local_reportbuilder') . ' "' .
                fullname($user) . '"';
        case 'ownandreports':
            return $title . ' ' . get_string('is','local_reportbuilder') . ' "' .
                fullname($user) . '"' . get_string('or','local_reportbuilder') .
                get_string('reportsto','local_reportbuilder') . ' "' . fullname($user) . '"';
        default:
            return $title . ' is NOT FOUND';
        }
    }


    /**
     * Adds form elements required for this content restriction's settings page
     *
     * @param object &$mform Moodle form object to modify (passed by reference)
     * @param integer $reportid ID of the report being adjusted
     */
    function form_template(&$mform, $reportid) {

        // get current settings
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $who = reportbuilder::get_setting($reportid, $type, 'who');

        $mform->addElement('header', 'user_header', get_string('showbyuser',
            'local_reportbuilder'));
        $mform->addElement('checkbox', 'user_enable', '',
            get_string('byuserenable', 'local_reportbuilder'));
        $mform->disabledIf('user_enable', 'contentenabled', 'eq', 0);
        $mform->setDefault('user_enable', $enable);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'user_who', '',
            get_string('userownrecords', 'local_reportbuilder'), 'own');
        $radiogroup[] =& $mform->createElement('radio', 'user_who', '',
            get_string('userstaffrecords', 'local_reportbuilder'), 'reports');
        $radiogroup[] =& $mform->createElement('radio', 'user_who', '',
            get_string('both', 'local_reportbuilder'), 'ownandreports');
        $mform->addGroup($radiogroup, 'user_who_group',
            get_string('includeuserrecords', 'local_reportbuilder'), '<br />', false);
        $mform->setDefault('user_who', $who);
        $mform->disabledIf('user_who_group','contentenabled', 'eq', 0);
        $mform->disabledIf('user_who_group','user_enable', 'notchecked');
        $mform->setHelpButton('user_header', array('reportbuilderuser',
            get_string('showbyuser', 'local_reportbuilder'), 'local_reportbuilder'));
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
        $status = true;
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);

        // enable checkbox option
        $enable = (isset($fromform->user_enable) &&
            $fromform->user_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        // who radio option
        $who = isset($fromform->user_who) ?
            $fromform->user_who : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'who', $who);

        return $status;
    }
}


/*
 * Restrict content by a particular date
 *
 * Pass in an integer that contains a unix timestamp
 */
class rb_date_content extends rb_base_content {
    /**
     * Generate the SQL to apply this content restriction
     *
     * @param string $field SQL field to apply the restriction against
     * @param integer $reportid ID of the report
     *
     * @return string SQL snippet to be used in a WHERE clause
     */
    function sql_restriction($field, $reportid) {
        $now = time();

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        // option to include empty date fields
        $includenulls = (isset($settings['incnulls']) &&
                         $settings['incnulls']) ? " OR $field IS NULL " : '';

        switch ($settings['when']) {
        case 'past':
            return '(' . $field.' < '. $now . $includenulls . ')';
        case 'future':
            return '(' . $field.' > '. $now . $includenulls . ')';
        case 'last30days':
            return '( (' . $field . ' < ' . $now . ' AND ' . $field . ' > ' .
                ($now - 60*60*24*30) . ')' . $includenulls . ')';
        case 'next30days':
            return '( (' . $field . ' > ' . $now . ' AND ' . $field . ' < ' .
                ($now + 60*60*24*30) . ')' . $includenulls . ')';
        case 'currentfinancial':
            $required_year = date('Y', $now);
            $year_before = $required_year - 1;
            $year_after = $required_year + 1;
            if(date('z', $now) >= 181) { // date is on or after 1st July
                $start = mktime(0, 0, 0, 7, 1, $required_year);
                $end = mktime(0, 0, 0, 7, 1, $year_after);
            } else {
                $start = mktime(0, 0, 0, 7, 1, $year_before);
                $end = mktime(0, 0, 0, 7, 1, $required_year);
            }
            return '( (' . $field . ' >= ' . $start . ' AND ' . $field . ' < ' .
                $end . ')' . $includenulls . ')';
        case 'lastfinancial':
            $required_year = date('Y', $now) - 1;
            $year_before = $required_year - 1;
            $year_after = $required_year + 1;
            if(date('z', $now) >= 181) { // date is on or after 1st July
                $start = mktime(0, 0, 0, 7, 1, $required_year);
                $end = mktime(0, 0, 0, 7, 1, $year_after);
            } else {
                $start = mktime(0, 0, 0, 7, 1, $year_before);
                $end = mktime(0, 0, 0, 7, 1, $required_year);
            }
            return '( (' . $field . ' >= ' . $start . ' AND ' . $field . ' < ' .
                $end . ')' . $includenulls . ')';
        default:
            // no match
            return '(FALSE' . $includenulls . ')';
        }

    }

    /**
     * Generate a human-readable text string describing the restriction
     *
     * @param string $title Name of the field being restricted
     * @param integer $reportid ID of the report
     *
     * @return string Human readable description of the restriction
     */
    function text_restriction($title, $reportid) {

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        // option to include empty date fields
        $includenulls = (isset($settings['incnulls']) &&
                         $settings['incnulls']) ? " (or $title is empty)" : '';

        switch ($settings['when']) {
        case 'past':
            return $title . ' ' . get_string('occurredbefore', 'local_reportbuilder') . ' ' .
                userdate(time(), '%c'). $includenulls;
        case 'future':
            return $title . ' ' . get_string('occurredafter', 'local_reportbuilder') . ' ' .
                userdate(time(), '%c'). $includenulls;
        case 'last30days':
            return $title . ' ' . get_string('occurredafter','local_reportbuilder') . ' ' .
                userdate(time() - 60*60*24*30, '%c') . get_string('and','local_reportbuilder') .
                get_string('occurredbefore','local_reportbuilder') . userdate(time(),'%c') .
                $includenulls;

        case 'next30days':
            return $title . ' ' . get_string('occurredafter','local_reportbuilder') . ' ' .
                userdate(time(), '%c') . get_string('and', 'local_reportbuilder') .
                get_string('occurredbefore', 'local_reportbuilder') .
                userdate(time() + 60*60*24*30,'%c') . $includenulls;
        case 'currentfinancial':
            return $title . ' ' . get_string('occurredthisfinancialyear','local_reportbuilder') .
                $includenulls;
        case 'lastfinancial':
            return $title . ' ' . get_string('occurredprevfinancialyear','local_reportbuilder') .
                $includenulls;
        default:
            return 'Error with date content restriction';
        }
    }


    /**
     * Adds form elements required for this content restriction's settings page
     *
     * @param object &$mform Moodle form object to modify (passed by reference)
     * @param integer $reportid ID of the report being adjusted
     */
    function form_template(&$mform, $reportid) {
        // get current settings
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $when = reportbuilder::get_setting($reportid, $type, 'when');
        $incnulls = reportbuilder::get_setting($reportid, $type, 'incnulls');

        $mform->addElement('header', 'date_header', get_string('showbydate',
            'local_reportbuilder'));
        $mform->addElement('checkbox', 'date_enable', '',
            get_string('bydateenable', 'local_reportbuilder'));
        $mform->setDefault('date_enable', $enable);
        $mform->disabledIf('date_enable', 'contentenabled', 'eq', 0);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'date_when', '',
            get_string('thepast', 'local_reportbuilder'), 'past');
        $radiogroup[] =& $mform->createElement('radio', 'date_when', '',
            get_string('thefuture', 'local_reportbuilder'), 'future');
        $radiogroup[] =& $mform->createElement('radio', 'date_when', '',
            get_string('last30days', 'local_reportbuilder'), 'last30days');
        $radiogroup[] =& $mform->createElement('radio', 'date_when', '',
            get_string('next30days', 'local_reportbuilder'), 'next30days');
        $radiogroup[] =& $mform->createElement('radio', 'date_when', '',
            get_string('currentfinancial', 'local_reportbuilder'), 'currentfinancial');
        $radiogroup[] =& $mform->createElement('radio', 'date_when', '',
            get_string('lastfinancial', 'local_reportbuilder'), 'lastfinancial');
        $mform->addGroup($radiogroup, 'date_when_group',
            get_string('includerecordsfrom', 'local_reportbuilder'), '<br />', false);
        $mform->setDefault('date_when', $when);
        $mform->disabledIf('date_when_group', 'contentenabled', 'eq', 0);
        $mform->disabledIf('date_when_group', 'date_enable', 'notchecked');
        $mform->setHelpButton('date_header',
            array('reportbuilderdate',
            get_string('showbydate', 'local_reportbuilder'), 'local_reportbuilder'));

        $mform->addElement('checkbox', 'date_incnulls',
            get_string('includeemptydates', 'local_reportbuilder'));
        $mform->setDefault('date_incnulls', $incnulls);
        $mform->disabledIf('date_incnulls', 'date_enable', 'notchecked');
        $mform->disabledIf('date_incnulls', 'contentenabled', 'eq', 0);
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
        $status = true;
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);

        // enable checkbox option
        $enable = (isset($fromform->date_enable) &&
            $fromform->date_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        // when radio option
        $when = isset($fromform->date_when) ?
            $fromform->date_when : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'when', $when);

        // include nulls checkbox option
        $incnulls = (isset($fromform->date_incnulls) &&
            $fromform->date_incnulls) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'incnulls', $incnulls);

        return $status;
    }
}


/*
 * Restrict content by offical tags
 *
 * Pass in a column that contains a pipe '|' separated list of official tag ids
 */
class rb_course_tag_content extends rb_base_content {
    /**
     * Generate the SQL to apply this content restriction
     *
     * @param string $field SQL field to apply the restriction against
     * @param integer $reportid ID of the report
     *
     * @return string SQL snippet to be used in a WHERE clause
     */
    function sql_restriction($field, $reportid) {
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);

        $include_sql = array();
        $exclude_sql = array();

        // get arrays of included and excluded tags
        $settings = reportbuilder::get_all_settings($reportid, $type);
        $itags = ($settings['included']) ?
            explode('|', $settings['included']) : array();
        $etags = ($settings['excluded']) ?
            explode('|', $settings['excluded']) : array();
        $include_logic = (isset($settings['include_logic']) &&
            $settings['include_logic'] == 0) ? ' AND ' : ' OR ';
        $exclude_logic = (isset($settings['exclude_logic']) &&
            $settings['exclude_logic'] == 0) ? ' OR ' : ' AND ';

        // loop through current official tags
        $tags = get_records('tag', 'tagtype', 'official', 'name');
        if($tags) {
            foreach($tags as $tag) {
                // if found, add the SQL
                // we can't just use LIKE '%tag%' because we might get
                // partial number matches
                if(in_array($tag->id, $itags)) {
                    $include_sql[] = "($field LIKE '{$tag->id}' OR " .
                    "$field LIKE '{$tag->id}|%' OR " .
                    "$field LIKE '%|{$tag->id}' OR " .
                    "$field LIKE '%|{$tag->id}|%')\n";
                }
                if(in_array($tag->id, $etags)) {
                    $exclude_sql[] = "($field NOT LIKE '{$tag->id}' AND " .
                    "$field NOT LIKE '{$tag->id}|%' AND " .
                    "$field NOT LIKE '%|{$tag->id}' AND " .
                    "$field NOT LIKE '%|{$tag->id}|%')\n";
                }
            }
        }

        // merge the include and exclude strings separately
        $includestr = implode($include_logic, $include_sql);
        $excludestr = implode($exclude_logic, $exclude_sql);

        // now merge together
        if($includestr && $excludestr) {
            return " ($includestr AND $excludestr) ";
        } else if ($includestr) {
            return " $includestr ";
        } else if ($excludestr) {
            return " $excludestr ";
        } else {
            return 'FALSE';
        }
    }

    /**
     * Generate a human-readable text string describing the restriction
     *
     * @param string $title Name of the field being restricted
     * @param integer $reportid ID of the report
     *
     * @return string Human readable description of the restriction
     */
    function text_restriction($title, $reportid) {
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $include_text = array();
        $exclude_text = array();

        $itags = ($settings['included']) ?
            explode('|', $settings['included']) : array();
        $etags = ($settings['excluded']) ?
            explode('|', $settings['excluded']) : array();
        $include_logic = (isset($settings['include_logic']) &&
            $settings['include_logic'] == 0) ? 'and' : 'or';
        $exclude_logic = (isset($settings['exclude_logic']) &&
            $settings['exclude_logic'] == 0) ? 'and' : 'or';

        $tags = get_records('tag', 'tagtype', 'official', 'name');
        if($tags) {
            foreach($tags as $tag) {
                if(in_array($tag->id, $itags)) {
                    $include_text[] = '"' . $tag->name . '"';
                }
                if(in_array($tag->id, $etags)) {
                    $exclude_text[] = '"' . $tag->name . '"';
                }
            }
        }

        if(count($include_text) > 0) {
            $includestr = $title . ' ' . get_string('istaggedwith', 'local_reportbuilder') .
                ' ' . implode(get_string($include_logic, 'local_reportbuilder'), $include_text);
        } else {
            $includestr = '';
        }
        if(count($exclude_text) > 0) {
            $excludestr = $title . ' ' . get_string('isnttaggedwith', 'local_reportbuilder') .
                ' ' . implode(get_string($exclude_logic, 'local_reportbuilder'), $exclude_text);
        } else {
            $excludestr = '';
        }

        if($includestr && $excludestr) {
            return $includestr . get_string('and','local_reportbuilder') . $excludestr;
        } else if ($includestr) {
            return $includestr;
        } else if ($excludestr) {
            return $excludestr;
        } else {
            return '';
        }

    }


    /**
     * Adds form elements required for this content restriction's settings page
     *
     * @param object &$mform Moodle form object to modify (passed by reference)
     * @param integer $reportid ID of the report being adjusted
     */
    function form_template(&$mform, $reportid) {

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $include_logic = reportbuilder::get_setting($reportid, $type, 'include_logic');
        $exclude_logic = reportbuilder::get_setting($reportid, $type, 'exclude_logic');
        $activeincludes = explode('|',
            reportbuilder::get_setting($reportid, $type, 'included'));
        $activeexcludes = explode('|',
            reportbuilder::get_setting($reportid, $type, 'excluded'));

        $mform->addElement('header', 'course_tag_header',
            get_string('showbycoursetag','local_reportbuilder'));
        $mform->setHelpButton('course_tag_header',
            array('reportbuildercoursetag',
            get_string('showbycoursetag', 'local_reportbuilder'), 'local_reportbuilder'));

        $mform->addElement('checkbox', 'course_tag_enable', '',
            get_string('coursetagenable','local_reportbuilder'));
        $mform->setDefault('course_tag_enable', $enable);
        $mform->disabledIf('course_tag_enable','contentenabled', 'eq', 0);

        $mform->addElement('html', '<br />');

        // include the following tags
        $checkgroup = array();
        $tags = get_records('tag', 'tagtype', 'official','name');
        if($tags) {
            $opts = array(1 => get_string('anyofthefollowing','local_reportbuilder'),
                          0 => get_string('allofthefollowing','local_reportbuilder'));
            $mform->addElement('select','course_tag_include_logic', get_string('includecoursetags','local_reportbuilder'), $opts);
            $mform->setDefault('course_tag_include_logic', $include_logic);
            $mform->disabledIf('course_tag_enable','contentenabled', 'eq', 0);
            foreach($tags as $tag) {
                $checkgroup[] =& $mform->createElement('checkbox',
                    'course_tag_include_option_' . $tag->id, '', $tag->name, 1);
                $mform->disabledIf('course_tag_include_option_' . $tag->id,
                    'course_tag_exclude_option_' . $tag->id, 'checked');
                if(in_array($tag->id, $activeincludes)) {
                    $mform->setDefault('course_tag_include_option_' . $tag->id, 1);
                }
            }
        }
        $mform->addGroup($checkgroup, 'course_tag_include_group',
            '', '<br />', false);
        $mform->disabledIf('course_tag_include_group', 'contentenabled', 'eq', 0);
        $mform->disabledIf('course_tag_include_group', 'course_tag_enable',
            'notchecked');

        $mform->addElement('html', '<br /><br />');

        // exclude the following tags
        $checkgroup = array();
        if($tags) {
            $opts = array(1 => get_string('anyofthefollowing','local_reportbuilder'),
                          0 => get_string('allofthefollowing','local_reportbuilder'));
            $mform->addElement('select','course_tag_exclude_logic', get_string('excludecoursetags','local_reportbuilder'), $opts);
            $mform->setDefault('course_tag_exclude_logic', $exclude_logic);
            $mform->disabledIf('course_tag_enable','contentenabled', 'eq', 0);
            foreach($tags as $tag) {
                $checkgroup[] =& $mform->createElement('checkbox',
                    'course_tag_exclude_option_' . $tag->id, '', $tag->name, 1);
                $mform->disabledIf('course_tag_exclude_option_' . $tag->id,
                    'course_tag_include_option_' . $tag->id, 'checked');
                if(in_array($tag->id, $activeexcludes)) {
                    $mform->setDefault('course_tag_exclude_option_' . $tag->id, 1);
                }
            }
        }
        $mform->addGroup($checkgroup, 'course_tag_exclude_group',
            '', '<br />', false);
        $mform->disabledIf('course_tag_exclude_group','contentenabled', 'eq', 0);
        $mform->disabledIf('course_tag_exclude_group','course_tag_enable',
            'notchecked');

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
        $status = true;
        // remove the rb_ from class
        $type = substr(get_class($this), 3);

        // enable checkbox option
        $enable = (isset($fromform->course_tag_enable) &&
            $fromform->course_tag_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        // include with any or all
        $includelogic = (isset($fromform->course_tag_include_logic) &&
            $fromform->course_tag_include_logic) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'include_logic', $includelogic);

        // exclude with any or all
        $excludelogic = (isset($fromform->course_tag_exclude_logic) &&
            $fromform->course_tag_exclude_logic) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'exclude_logic', $excludelogic);

        // tag settings
        $tags = get_records('tag', 'tagtype', 'official');
        if($tags) {
            $activeincludes = array();
            $activeexcludes = array();
            foreach($tags as $tag) {
                $includename = 'course_tag_include_option_' . $tag->id;
                $excludename = 'course_tag_exclude_option_' . $tag->id;

                // included tags
                if(isset($fromform->$includename)) {
                    if($fromform->$includename == 1) {
                        $activeincludes[] = $tag->id;
                    }
                }

                // excluded tags
                if(isset($fromform->$excludename)) {
                    if($fromform->$excludename == 1) {
                        $activeexcludes[] = $tag->id;
                    }
                }

            }

            // implode into string and update setting
            $status = $status && reportbuilder::update_setting($reportid,
                $type, 'included', implode('|', $activeincludes));

            // implode into string and update setting
            $status = $status && reportbuilder::update_setting($reportid,
                $type, 'excluded', implode('|', $activeexcludes));
        }
        return $status;
    }
}

// Include trainer content restriction
include_once($CFG->dirroot . '/local/reportbuilder/classes/rb_trainer_content.php');
