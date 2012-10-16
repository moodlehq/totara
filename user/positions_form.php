<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage totara_hierarchy
 */

require_once($CFG->dirroot.'/lib/formslib.php');

class user_position_assignment_form extends moodleform {

    // Define the form
    function definition () {
        global $CFG, $DB, $OUTPUT, $COURSE, $POSITION_TYPES;

        $mform =& $this->_form;
        $type = $this->_customdata['type'];
        $pa = $this->_customdata['position_assignment'];
        $editoroptions = $this->_customdata['editoroptions'];
        $can_edit = $this->_customdata['can_edit'];
        $nojs = $this->_customdata['nojs'];

        // Check if an aspirational position
        $aspirational = false;
        if (isset($POSITION_TYPES[POSITION_TYPE_ASPIRATIONAL]) && $type == $POSITION_TYPES[POSITION_TYPE_ASPIRATIONAL]) {
            $aspirational = true;
        }

        // Get position title
        $position_title = '';
        if ($pa->positionid) {
            $position_title = $DB->get_field('pos', 'fullname', array('id' => $pa->positionid));
        }

        // Get organisation title
        $organisation_title = '';
        if ($pa->organisationid) {
            $organisation_title = $DB->get_field('org', 'fullname', array('id' => $pa->organisationid));
        }

        // Get manager title
        $manager_title = '';
        $manager_id = 0;
        if ($pa->reportstoid) {
            $manager = $DB->get_record_sql(
                "SELECT
                    u.id,
                    u.firstname,
                    u.lastname,
                    ra.id AS ra
                 FROM
                    {user} u
                 INNER JOIN
                    {role_assignments} ra
                     ON u.id = ra.userid
                 WHERE
                    ra.id = ?",
                 array($pa->reportstoid));

            if ($manager) {
                $manager_title = fullname($manager);
                $manager_id = $manager->id;
            }
        }

        // Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        if (!$nojs) {
            $mform->addElement('html', html_writer::tag('noscript', html_writer::tag('p', get_string('formrequiresjs', 'totara_hierarchy') .
                html_writer::link(new moodle_url(qualified_me(), array('nojs' => '1')), get_string('clickfornonjsform', 'totara_hierarchy')))));
        }
        $mform->addElement('header', 'general', get_string('type'.$type, 'totara_hierarchy'));

        if (!$aspirational) {
            $mform->addElement('text', 'fullname', get_string('titlefullname', 'totara_hierarchy'));
            $mform->setType('fullname', PARAM_TEXT);
            $mform->addHelpButton('fullname', 'titlefullname', 'totara_hierarchy');

            $mform->addElement('text', 'shortname', get_string('titleshortname', 'totara_hierarchy'));
            $mform->setType('shortname', PARAM_TEXT);
            $mform->addHelpButton('shortname', 'titleshortname', 'totara_hierarchy');

            $mform->addElement('editor', 'description_editor', get_string('pos_description', 'totara_core'), null, $editoroptions);
            $mform->setType('description_editor', PARAM_CLEANHTML);
            $mform->addHelpButton('description_editor', 'pos_description', 'totara_core');
        }

        if ($nojs) {
            $allpositions = $DB->get_records_menu('pos', null, 'frameworkid,sortthread', 'id,fullname');
            $mform->addElement('select','positionid', get_string('chooseposition','totara_hierarchy'), $allpositions);
            $mform->addHelpButton('positionid', 'chooseposition','totara_hierarchy');
        } else {
            $pos_class = strlen($position_title) ? 'nonempty' : '';
            $mform->addElement('static', 'positionselector', get_string('position', 'totara_hierarchy'),
                html_writer::empty_tag('img', array('class' => 'req', 'title' => 'Required field', 'alt' => 'Required field', 'src' => $OUTPUT->pix_url('/req'))) .
                html_writer::tag('span', format_string($position_title), array('class' => $pos_class, 'id' => 'positiontitle')).
                    ($can_edit ? html_writer::empty_tag('input', array('type' => 'button', 'value' => get_string('chooseposition', 'totara_hierarchy'), 'id' => 'show-position-dialog')) : '')
            );
            $mform->addElement('hidden', 'positionid');
            $mform->setType('positionid', PARAM_INT);
            $mform->setDefault('positionid', 0);
            if (!$aspirational) {
                $mform->addHelpButton('positionselector', 'chooseposition', 'totara_hierarchy');
            } else {
                $mform->addHelpButton('positionselector', 'useraspirationalposition', 'totara_hierarchy');
            }

        }
        if (!$aspirational) {
            if ($nojs) {
                $allorgs = $DB->get_records_menu('org', null, 'frameworkid,sortthread', 'id,fullname');
                if (is_array($allorgs) && !empty($allorgs) ){
                    $mform->addElement('select','organisationid', get_string('chooseorganisation','totara_hierarchy'),
                        array(0 => get_string('chooseorganisation','organisation')) + $allorgs);
                } else {
                    $mform->addElement('static', 'organisationid', get_string('chooseorganisation','totara_hierarchy'), get_string('noorganisation','totara_hierarchy') );
                }
                $mform->addHelpButton('organisationid', 'chooseorganisation', 'totara_hierarchy');
            } else {
                $org_class = strlen($organisation_title) ? 'nonempty' : '';
                $mform->addElement('static', 'organisationselector', get_string('organisation', 'totara_hierarchy'),
                    html_writer::tag('span', format_string($organisation_title), array('class' => $org_class, 'id' => 'organisationtitle')) .
                    ($can_edit ? html_writer::empty_tag('input', array('type' => 'button', 'value' => get_string('chooseorganisation', 'totara_hierarchy'), 'id' => 'show-organisation-dialog')) : '')
                );

                $mform->addElement('hidden', 'organisationid');
                $mform->setType('organisationid', PARAM_INT);
                $mform->setDefault('organisationid', 0);
                $mform->addHelpButton('organisationselector', 'chooseorganisation', 'totara_hierarchy');
            }

            if ($nojs) {
             $allmanagers = $DB->get_records_sql_menu("
                    SELECT
                        u.id,
                        " . $DB->sql_fullname('u.firstname', 'u.lastname') . " AS fullname
                    FROM
                        {user} u
                    ORDER BY
                        u.firstname,
                        u.lastname");
                if ( is_array($allmanagers) && !empty($allmanagers) ){
                    $mform->addElement('select', 'managerid', get_string('choosemanager','totara_hierarchy'),
                        array(0 => get_string('choosemanager','position')) + $allmanagers);
                    $mform->setDefault('managerid', $manager_id);
                } else {
                    $mform->addElement('static','managerid',get_string('choosemanager','totara_hierarchy'), get_string('error:dialognotreeitems', 'manager'));
                }
                $mform->addHelpButton('managerid', 'choosemanager', 'totara_hierarchy');
            } else {
                // Show manager
                // If we can edit, show button. Else show link to manager's profile
                if ($can_edit) {
                    $manager_class = strlen($manager_title) ? 'nonempty' : '';
                    $mform->addElement(
                        'static',
                        'managerselector',
                        get_string('manager', 'totara_hierarchy'),
                        html_writer::tag('span', format_string($manager_title), array('class' => $manager_class, 'id' => 'managertitle'))
                        . html_writer::empty_tag('input', array('type' => 'button', 'value' => get_string('choosemanager', 'totara_hierarchy'), 'id' => 'show-manager-dialog'))
                    );
                } else {
                    $mform->addElement(
                        'static',
                        'managerselector',
                        get_string('manager', 'totara_hierarchy'),
                        html_writer::tag('span', html_writer::link(new moodle_url('/user/view.php', array('id' => $manager_id)), format_string($manager_title)), array('id' => 'managertitle'))
                    );
                }

                $mform->addElement('hidden', 'managerid');
                $mform->setType('managerid', PARAM_INT);
                $mform->setDefault('managerid', $manager_id);
                $mform->addHelpButton('managerselector', 'choosemanager', 'totara_hierarchy');
            }

            $group = array();
            $group[] = $mform->createElement('text', 'timevalidfrom','', array('name'=>get_string('startdate', 'totara_hierarchy'),'placeholder' => get_string('datepickerplaceholder', 'totara_core')));
            $mform->addGroup($group, 'timevalidfrom_group', get_string('startdate', 'totara_hierarchy'), array(' '), false);
            $mform->setType('timevalidfrom', PARAM_TEXT);
            $mform->setDefault('timevalidfrom', get_string('datepickerdisplayformat','totara_core'));
            $mform->addHelpButton('timevalidfrom_group', 'startdate', 'totara_hierarchy');

            $group = array();
            $group[] = $mform->createElement('text', 'timevalidto', '', array('name'=>get_string('finishdate', 'totara_hierarchy'),'placeholder' => get_string('datepickerplaceholder', 'totara_core')));
            $mform->addGroup($group, 'timevalidto_group', get_string('finishdate', 'totara_hierarchy'), array(' '), false);
            $mform->setType('timevalidto', PARAM_TEXT);
            $mform->setDefault('timevalidto', get_string('datepickerdisplayformat','totara_core'));
            $mform->addHelpButton('managerselector', 'choosemanager', 'totara_hierarchy');
            $mform->addHelpButton('timevalidto_group', 'finishdate', 'totara_hierarchy');

            $rule1['timevalidfrom'][] = array(get_string('entervaliddate', 'totara_hierarchy'), 'regex' , get_string('datepickerregexphp', 'totara_core'));
            $mform->addGroupRule('timevalidfrom_group', $rule1);
            $rule2['timevalidto'][] = array(get_string('entervaliddate', 'totara_hierarchy'), 'regex' , get_string('datepickerregexphp', 'totara_core'));
            $mform->addGroupRule('timevalidto_group', $rule2);
        }

        $this->add_action_buttons(true, get_string('updateposition', 'totara_hierarchy'));
    }

    function definition_after_data() {
        $mform =& $this->_form;

        // Fix odd date values
        // Check if form is frozen
        if ($mform->elementExists('timevalidfrom_group')) {

            $groupfrom = $mform->getElement('timevalidfrom_group');
            $date = $groupfrom->getValue();
            $timevalidfromdateint = (int)$date["timevalidfrom"];

            if (!$timevalidfromdateint) {
                $mform->setDefault('timevalidfrom', '');
            }
            else {
                $mform->setDefault('timevalidfrom', date(get_string('datepickerparseformat', 'totara_core'), $timevalidfromdateint));
            }
        }

        if ($mform->elementExists('timevalidto_group')) {

            $groupto = $mform->getElement('timevalidto_group');
            $date2 = $groupto->getValue();
            $timevalidtodateint = (int)$date2["timevalidto"];

            if (!$timevalidtodateint) {
                $mform->setDefault('timevalidto', '');
            }
            else {
                $mform->setDefault('timevalidto', date(get_string('datepickerparseformat', 'totara_core'), $timevalidtodateint));
            }
        }
    }

    function freezeForm() {
        $mform =& $this->_form;

        // Freeze values
        $mform->hardFreezeAllVisibleExcept(array());

        // Hide elements with no values
        foreach (array_keys($mform->_elements) as $key) {

            $element =& $mform->_elements[$key];

            // Check static elements differently
            if ($element->getType() == 'static') {
                // Check if it is a js selector
                if (substr($element->getName(), -8) == 'selector') {
                    // Get id element
                    $elementid = $mform->getElement(substr($element->getName(), 0, -8).'id');

                    if (!$elementid || !$elementid->getValue()) {
                        $mform->removeElement($element->getName());
                    }

                    continue;
                }
            }

            // Get element value
            $value = $element->getValue();

            // Check groups
            // (matches date groups and action buttons)
            if (is_array($value)) {

                // If values are strings (e.g. buttons, or date format string), remove
                foreach ($value as $k => $v) {
                    if (!is_numeric($v)) {
                        $mform->removeElement($element->getName());
                        break;
                    }
                }
            }
            // Otherwise check if empty
            elseif (!$value) {
                $mform->removeElement($element->getName());
            }
        }
    }

    function validation($data, $files) {

        $mform =& $this->_form;

        $result = array();

        $timevalidfromstr = isset($data['timevalidfrom'])?$data['timevalidfrom']:'';
        $timevalidfrom = totara_date_parse_from_format(get_string('datepickerparseformat','totara_core'),$timevalidfromstr);
        $timevalidtostr = isset($data['timevalidto'])?$data['timevalidto']:'';
        $timevalidto = totara_date_parse_from_format(get_string('datepickerparseformat','totara_core'),$timevalidtostr);

        // Enforce valid dates
        if (false === $timevalidfrom && $timevalidfromstr !== get_string('datepickerdisplayformat','totara_core') && $timevalidfromstr !== '') {
            $result['timevalidfrom'] = get_string('error:dateformat','totara_hierarchy', get_string('datepickerplaceholder', 'totara_core'));
        }
        if (false === $timevalidto && $timevalidtostr !== get_string('datepickerdisplayformat','totara_core') && $timevalidtostr !== '') {
            $result['timevalidto'] = get_string('error:dateformat','totara_hierarchy', get_string('datepickerplaceholder', 'totara_core'));
        }

        // Enforce start date before finish date
        if ($timevalidfrom > $timevalidto && $timevalidfrom !== false && $timevalidto !== false && $timevalidtostr !== '') {
            $errstr = get_string('error:startafterfinish','totara_hierarchy');
            $result['timevalidfrom_group'] = $errstr;
            $result['timevalidto_group'] = $errstr;
            unset($errstr);
        }

        // Check that a position was set
        if (!$mform->getElement('positionid')->getValue()) {
            $result['positionselector'] = get_string('error:positionnotset', 'totara_hierarchy');
        }

        return $result;
    }
}
