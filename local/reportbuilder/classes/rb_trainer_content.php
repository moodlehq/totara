<?php

/*
 * Restrict content by a particular trainer or group of trainers
 * Pass in an integer that represents a trainer's moodle id
 */
class rb_trainer_content extends rb_base_content {
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

    function text_restriction($title, $reportid) {
        global $USER;

        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $settings = reportbuilder::get_all_settings($reportid, $type);

        $user = get_record('user','id',$USER->id);
        switch ($settings['who']) {
        case 'own':
            return $title . ' ' . get_string('is','local') . ' "' .
                fullname($user) . '"';
        case 'reports':
            return $title . ' ' . get_string('reportsto','local') . ' "' .
                fullname($user) . '"';
        case 'ownandreports':
            return $title . ' ' . get_string('is','local') . ' "' .
                fullname($user) . '"' . get_string('or','local') .
                get_string('reportsto','local') . ' "' . fullname($user) . '"';
        default:
            return $title . ' is NOT FOUND';
        }
    }

    function form_template(&$mform, $reportid) {

        // get current settings
        // remove rb_ from start of classname
        $type = substr(get_class($this), 3);
        $enable = reportbuilder::get_setting($reportid, $type, 'enable');
        $who = reportbuilder::get_setting($reportid, $type, 'who');

        $mform->addElement('header', 'trainer_header', get_string('showbytrainer',
            'local'));
        $mform->addElement('checkbox', 'trainer_enable', '',
            get_string('bytrainerenable', 'local'));
        $mform->disabledIf('trainer_enable', 'contentenabled', 'eq', 0);
        $mform->setDefault('trainer_enable', $enable);
        $radiogroup = array();
        $radiogroup[] =& $mform->createElement('radio', 'trainer_who', '',
            get_string('trainerownrecords', 'local'), 'own');
        $radiogroup[] =& $mform->createElement('radio', 'trainer_who', '',
            get_string('trainerstaffrecords', 'local'), 'reports');
        $radiogroup[] =& $mform->createElement('radio', 'trainer_who', '',
            get_string('both', 'local'), 'ownandreports');
        $mform->addGroup($radiogroup, 'trainer_who_group',
            get_string('includetrainerrecords', 'local'), '<br />', false);
        $mform->setDefault('trainer_who', $who);
        $mform->disabledIf('trainer_who_group','contentenabled', 'eq', 0);
        $mform->disabledIf('trainer_who_group','trainer_enable', 'notchecked');
        $mform->setHelpButton('trainer_header', array('reportbuildertrainer',
            get_string('showbytrainer', 'local'), 'moodle'));
    }

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
}
