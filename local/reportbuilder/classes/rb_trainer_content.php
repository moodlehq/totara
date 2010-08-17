<?php

/**
 * Restrict content by a particular trainer or group of trainers
 * Pass in an integer that represents a trainer's moodle id
 *
 * @copyright Totara Learning Solutions Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */
class rb_trainer_content extends rb_base_content {
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
            if($staff = mitms_get_staff()) {
                return $field . ' IN (' . implode(',', $staff) .')';
            } else {
                return 'FALSE';
            }
        } else if ($who == 'ownandreports') {
            // show own and staff records
            if($staff = mitms_get_staff()) {
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

        $mform->addElement('header', 'trainer_header', get_string('showbytrainer',
            'local_reportbuilder'));
        $mform->addElement('checkbox', 'trainer_enable', '',
            get_string('bytrainerenable', 'local_reportbuilder'));
        $mform->disabledIf('trainer_enable', 'contentenabled', 'eq', 0);
        $mform->setDefault('trainer_enable', $enable);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'trainer_who', '',
            get_string('trainerownrecords', 'local_reportbuilder'), 'own');
        $radiogroup[] =& $mform->createElement('radio', 'trainer_who', '',
            get_string('trainerstaffrecords', 'local_reportbuilder'), 'reports');
        $radiogroup[] =& $mform->createElement('radio', 'trainer_who', '',
            get_string('both', 'local_reportbuilder'), 'ownandreports');
        $mform->addGroup($radiogroup, 'trainer_who_group',
            get_string('includetrainerrecords', 'local_reportbuilder'), '<br />', false);
        $mform->setDefault('trainer_who', $who);
        $mform->disabledIf('trainer_who_group','contentenabled', 'eq', 0);
        $mform->disabledIf('trainer_who_group','trainer_enable', 'notchecked');
        $mform->setHelpButton('trainer_header', array('reportbuildertrainer',
            get_string('showbytrainer', 'local_reportbuilder'), 'local_reportbuilder'));
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
        $enable = (isset($fromform->trainer_enable) &&
            $fromform->trainer_enable) ? 1 : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'enable', $enable);

        // who radio option
        $who = isset($fromform->trainer_who) ?
            $fromform->trainer_who : 0;
        $status = $status && reportbuilder::update_setting($reportid, $type,
            'who', $who);

        return $status;
    }

} // end of rb_trainer_content class
