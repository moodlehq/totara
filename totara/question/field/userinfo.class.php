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
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage totara_question
 */

global $CFG;
require_once($CFG->dirroot .'/user/profile/lib.php');

class question_userinfo extends question_base{

    private $info_fields = array();

    public function __construct($definition, $prefix, $subjectid = 0, $answerfield = '', $answerid = 0) {
        global $DB;

        $this->info_fields = array(
            'profile_fullname' => get_string('fullnameuser'),
            'profile_emailaddress' => get_string('email'),
            'profile_phone' => get_string('phone'),
            'profile_mobile' => get_string('phone2'),
            'profile_address' => get_string('address'),
            'profile_managername' => get_string('managername', 'totara_question'),
            'profile_position' => get_string('position', 'totara_cohort'),
            'profile_organisation' => get_string('organisation', 'totara_cohort')
        );

        if ($categories = $DB->get_records('user_info_category', null, 'sortorder ASC')) {
            foreach ($categories as $category) {
                $fields = $DB->get_records('user_info_field', array('categoryid' => $category->id), 'sortorder ASC');
                foreach ($fields as $field) {

                    $this->info_fields['profile_field_' . $field->shortname] = $field->name;
                }
            }
        }

        parent::__construct($definition, $prefix, $subjectid, $answerfield, $answerid);
    }


    public function get_info() {
        return array('group' => question::GROUP_OTHER, 'title' => get_string('questiontypeuserinfo', 'totara_question'));
    }

    /**
     * Add database fields definition that represent current customfield
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function get_xmldb() {
        $fields = array();
        return $fields;
    }


    /**
     * Add database fields definition that represent current question
     *
     * @see question_base::get_xmldb()
     * @return array()
     */
    public function define_get(stdClass $toform) {
        if (!isset($toform)) {
            $toform = new stdClass();
        }

        $options = isset($this->param1) ? $this->param1 : array();

        foreach ($options as $field => $value) {
            $toform->$field = $value;
        }

        return $toform;
    }


    /**
     * Set values from configuration form
     *
     * @param stdClass $fromform
     * @return stdClass $fromform
     */
    public function define_set(stdClass $fromform) {
        $options = array();

        foreach ($fromform as $field => $value) {
            if (substr($field, 0, 7) == 'profile') {
                $options[$field] = $value;
            }
        }

        $this->param1 = $options;

        return $this;
    }


    /**
     * Customfield specific settings elements
     *
     * @param MoodleQuickForm $form
     */
    protected function define_form(MoodleQuickForm $form) {
        $form->addelement('static', 'infotodisp', 'Information to display');

        foreach ($this->info_fields as $field => $fieldname) {
            $form->addElement('advcheckbox', $field, $fieldname);
        }
    }


    /**
     * Add form elements that represent current field
     *
     * @see question_base::edit_form()
     * @param MoodleQuickForm $form Form to alter
     */
    public function edit_form(MoodleQuickForm $form) {
    }


    /**
     * Add form elements related to questions to form for user answers
     * Default implementation for first mapped field.
     * Override for all other cases.
     *
     * @param MoodleQuickForm $form
     */
    public function edit_display(MoodleQuickForm $form) {
        global $DB, $CFG;

        $user = $DB->get_record('user', array('id' => $this->subjectid));

        $settings = $this->param1;

        // Open an html div to contain all the values, so that we can style them all together.
        $form->addElement('html', '<div class="userinfo">');
        foreach ($this->info_fields as $field => $fieldname) {
            if (isset($settings[$field]) && $settings[$field]) {
                switch ($field) {
                    case 'profile_fullname':
                        $form->addElement('static', $this->get_prefix_form(), $fieldname, fullname($user));
                        break;
                    case 'profile_emailaddress':
                        $form->addElement('static', $this->get_prefix_form(), $fieldname, $user->email);
                        break;
                    case 'profile_phone':
                        $form->addElement('static', $this->get_prefix_form(), $fieldname, $user->phone1);
                        break;
                    case 'profile_mobile':
                        $form->addElement('static', $this->get_prefix_form(), $fieldname, $user->phone2);
                        break;
                    case 'profile_address':
                        $form->addElement('static', $this->get_prefix_form(), $fieldname, $user->address);
                        break;
                    case 'profile_managername':
                        if ($manager = totara_get_manager($user->id)) {
                            $form->addElement('static', $this->get_prefix_form(), $fieldname, fullname($manager));
                        }
                        break;
                    case 'profile_position':
                        $query = 'SELECT pos.fullname
                            FROM {pos} pos
                            JOIN {pos_assignment} pa
                            ON pos.id = pa.positionid
                            WHERE pa.userid = ?';
                        $position = $DB->get_record_sql($query, array($user->id));
                        $fullname = ($position) ? $position->fullname : '';
                        $form->addElement('static', $this->get_prefix_form(), $fieldname, $fullname);
                        break;
                    case 'profile_organisation':
                        $query = 'SELECT org.fullname
                            FROM {org} org
                            JOIN {pos_assignment} pa
                            ON org.id = pa.organisationid
                            WHERE pa.userid = ?';
                        $organisation = $DB->get_record_sql($query, array($user->id));
                        $fullname = ($organisation) ? $organisation->fullname : '';
                        $form->addElement('static', $this->get_prefix_form(), $fieldname, $fullname);
                        break;
                    default:
                        // Use default to display custom fields
                        if (substr($field, 0, 13) == 'profile_field') {
                            $shortname = substr($field, 14);
                            $customfield = $DB->get_record('user_info_field', array('shortname' => $shortname));

                            require_once($CFG->dirroot.'/user/profile/field/'.$customfield->datatype.'/field.class.php');
                            $classname = 'profile_field_' . $customfield->datatype;
                            $formfield = new $classname($customfield->id, $user->id);

                            $form->addElement('static', $this->get_prefix_form(), $fieldname, $formfield->display_data());
                        }
                        break;
                }
            }
        }
        // Make sure we close the container.
        $form->addElement('html', '</div>');
    }


    /**
     * Does this element have any editable form fields, or it's view only (informational or static) element
     *
     * @see question_base::has_editable()
     * @return bool
     */
    public function has_editable() {
        return false;
    }


    public function define_import(stdClass $fromdb) {
        $result = parent::define_import($fromdb);

        $info = $this->get_info();
        $this->name = $info['title'];

        return $result;
    }

}
