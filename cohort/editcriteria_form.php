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
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage cohort
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once($CFG->dirroot . '/lib/formslib.php');

class cohort_editcriteria_form extends moodleform {

    /**
     * Define the cohort edit form
     */
    public function definition() {
        global $OUTPUT;

        $mform = $this->_form;
        $cohort = $this->_customdata['data'];

        $mform->addElement('static', 'name', get_string('name', 'totara_cohort'),$cohort->name);
        $mform->addElement('static', 'idnumber', get_string('idnumber', 'totara_cohort'),$cohort->idnumber);
        $mform->addElement('static', 'description', get_string('description', 'totara_cohort'),$cohort->description);

        // Criteria subgroup html
        $html = $OUTPUT->container_start('fitem') . $OUTPUT->container(get_string('criteria','totara_cohort') .
            html_writer::tag('p', get_string('criteriaoptional','totara_cohort'), array('class' => 'criteria_description')), 'fitemtitle') .
            $OUTPUT->container_start('felement');
        $mform->addElement('html', $html);

        // Profile field
        $userprofilefields = $this->get_user_profile_field_options();
        $mform->addElement('html', $OUTPUT->container_start('criteria_section grey'));
        $mform->addElement('select', 'profilefield', get_string('userprofilefield', 'totara_cohort'), $userprofilefields);
        $mform->addElement('text', 'profilefieldvalues', get_string('profilefieldvalues', 'totara_cohort'), 'maxlength="254" size="50"');
        $mform->addElement('html', $OUTPUT->container_end());
        $mform->addHelpButton('profilefieldvalues', 'profilefieldvalues', 'totara_cohort');

        // Position
        $mform->addElement('html', $OUTPUT->container_start('criteria_section'));
        $mform->addElement('static', 'roleselector',get_string('position', 'totara_hierarchy'),
            html_writer::tag('span', '', array('id' => 'positiontitle')) .
            html_writer::empty_tag('input', array('type' => 'button', 'value' => get_string('chooseposition', 'totara_hierarchy'), 'id' => 'show-position-dialog'))
        );

        $mform->addElement('checkbox', 'positionincludechildren', get_string('positionincludechildren', 'totara_cohort'));
        $mform->addElement('html', $OUTPUT->container_end());
        $mform->setType('positionincludechildren', PARAM_BOOL);
        $mform->addHelpButton('positionincludechildren', 'positionincludechildren', 'totara_cohort');

        $mform->addElement('hidden', 'positionid');
        $mform->setType('positionid', PARAM_INT);
        $mform->setDefault('positionid', 0);

        // Organisation
        $mform->addElement('html', $OUTPUT->container_start('criteria_section grey'));
        $mform->addElement('static', 'organisationselector', get_string('organisation', 'totara_cohort'),
            html_writer::tag('span', '', array('id' => 'organisationtitle')) .
            html_writer::empty_tag('input', array('type' => 'button', 'value' => get_string('chooseorganisation', 'totara_hierarchy'), 'id' => 'show-organisation-dialog'))
        );

        $mform->addElement('checkbox', 'orgincludechildren', get_string('positionincludechildren', 'totara_cohort'));
        $mform->addElement('html', $OUTPUT->container_end());
        $mform->setType('orgincludechildren', PARAM_BOOL);
        $mform->addHelpButton('orgincludechildren', 'orgincludechildren', 'totara_cohort');

        $mform->addElement('hidden', 'organisationid');
        $mform->setType('organisationid', PARAM_INT);
        $mform->setDefault('organisationid', 0);

        // End the criteria subgroup html
        $html = $OUTPUT->container_end() . $OUTPUT->container_end();
        $mform->addElement('html', $html);

        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('hidden', 'cohortname', $cohort->name);

        $this->add_action_buttons(false, get_string('createdynamiccohort', 'totara_cohort'));

        $this->set_data($cohort);
    }

    public function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);

        // Double check the profile field is valid
        $validprofilefields = $this->get_user_profile_field_options();
        if (!isset($data['profilefield'])) {
            $errors['profilefield'] = get_string('notvalidprofilefield', 'totara_cohort');
        }

        if (empty($data['profilefieldvalues'])) {
            $data['profilefield'] = '';
        }

        if (empty($data['profilefield']) &&
            empty($data['positionid']) &&
            empty($data['organisationid'])) {
                totara_set_notification(get_string('mustselectonecriteria', 'totara_cohort'));
                $errors['form'] = 'hack to force form invalidation'; // is there a better solution?
            }

        return $errors;
    }

    private function get_user_profile_field_options() {
        global $DB;

        $options = array();
        $options[''] = get_string('none');

        // Add the main user profile fields
        $options['username'] = get_string('username');
        $options['firstname'] = get_string('firstname');
        $options['lastname'] = get_string('lastname');
        $options['email'] = get_string('email');
        $options['city'] = get_string('city');
        $options['country'] = get_string('country');
        $options['institution'] = get_string('institution');
        $options['department'] = get_string('department');

        // Add the custom profile fields
        $records = $DB->get_records('user_info_field');
        if (!empty($records)) {
            foreach ($records as $record) {
                $options['customfield' . $record->id] = $record->name;
            }
        }
        return $options;
    }
}
