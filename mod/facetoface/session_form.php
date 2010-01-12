<?php

require_once "$CFG->dirroot/lib/formslib.php";
require_once 'lib.php';

class mod_facetoface_session_form extends moodleform {

    function definition()
    {
        global $CFG;

        $mform =& $this->_form;

        $mform->addElement('hidden', 'id', $this->_customdata['id']);
        $mform->addElement('hidden', 'f', $this->_customdata['f']);
        $mform->addElement('hidden', 's', $this->_customdata['s']);
        $mform->addElement('hidden', 'c', $this->_customdata['c']);

        $mform->addElement('header', 'general', get_string('general', 'form'));

        // Show all custom fields
        $customfields = $this->_customdata['customfields'];
        foreach ($customfields as $field) {
            $fieldname = "custom_$field->shortname";

            $options = array();
            foreach (explode(CUSTOMFIELD_DELIMITTER, $field->possiblevalues) as $value) {
                $v = trim($value);
                if (!empty($v)) {
                    $options[$v] = $v;
                }
            }

            switch ($field->type) {
            case CUSTOMFIELD_TYPE_TEXT:
                $mform->addElement('text', $fieldname, $field->name);
                break;
            case CUSTOMFIELD_TYPE_SELECT:
                $mform->addElement('select', $fieldname, $field->name, $options);
                break;
            case CUSTOMFIELD_TYPE_MULTISELECT:
                $select = &$mform->addElement('select', $fieldname, $field->name, $options);
                $select->setMultiple(true);
                break;
            default:
                error_log("facetoface: invalid field type for custom field ID $field->id");
                continue;
            }

            $mform->setType($fieldname, PARAM_TEXT);
            $mform->setDefault($fieldname, $field->defaultvalue);
            if ($field->required) {
                $mform->addRule($fieldname, null, 'required', null, 'client');
            }
        }

        $mform->addElement('selectyesno', 'datetimeknown', get_string('sessiondatetimeknown', 'facetoface'));
        $mform->addRule('datetimeknown', null, 'required', null, 'client');
        $mform->setDefault('datetimeknown', false);
        $mform->setHelpButton('datetimeknown', array('sessiondatetimeknown', get_string('sessiondatetimeknown', 'facetoface'), 'facetoface'));

        $repeatarray = array();
        $repeatarray[] = &$mform->createElement('hidden', 'sessiondateid', 0);
        $repeatarray[] = &$mform->createElement('date_time_selector', 'timestart', get_string('timestart', 'facetoface'));
        $repeatarray[] = &$mform->createElement('date_time_selector', 'timefinish', get_string('timefinish', 'facetoface'));
        $checkboxelement = &$mform->createElement('checkbox', 'datedelete', '', get_string('dateremove', 'facetoface'));
        unset($checkboxelement->_attributes['id']); // necessary until MDL-20441 is fixed
        $repeatarray[] = $checkboxelement;
        $repeatarray[] = &$mform->createElement('html', '<br/>'); // spacer

        $repeatcount = $this->_customdata['nbdays'];

        $repeatoptions = array();
        $repeatoptions['timestart']['disabledif'] = array('datetimeknown', 'eq', 0);
        $repeatoptions['timefinish']['disabledif'] = array('datetimeknown', 'eq', 0);
        $mform->setType('timestart', PARAM_INT);
        $mform->setType('timefinish', PARAM_INT);

        $this->repeat_elements($repeatarray, $repeatcount, $repeatoptions, 'date_repeats', 'date_add_fields',
                               1, get_string('dateadd', 'facetoface'), true);

        $mform->addElement('text', 'capacity', get_string('capacity', 'facetoface'), 'size="5"');
        $mform->addRule('capacity', null, 'required', null, 'client');
        $mform->setType('capacity', PARAM_INT);
        $mform->setDefault('capacity', 10);
        $mform->setHelpButton('capacity', array('capacity', get_string('capacity', 'facetoface'), 'facetoface'));

        $mform->addElement('checkbox', 'allowoverbook', get_string('allowoverbook', 'facetoface'));
        $mform->setHelpButton('allowoverbook', array('allowoverbook', get_string('allowoverbook', 'facetoface'), 'facetoface'));

        $mform->addElement('text', 'duration', get_string('duration', 'facetoface'), 'size="5"');
        $mform->setType('duration', PARAM_TEXT);
        $mform->setHelpButton('duration', array('duration', get_string('duration', 'facetoface'), 'facetoface'));

        if (!get_config(NULL, 'facetoface_hidecost')) {
            $mform->addElement('text', 'normalcost', get_string('normalcost', 'facetoface'), 'size="5"');
            $mform->setType('normalcost', PARAM_TEXT);
            $mform->setHelpButton('normalcost', array('normalcost', get_string('normalcost', 'facetoface'), 'facetoface'));

            if (!get_config(NULL, 'facetoface_hidediscount')) {
                $mform->addElement('text', 'discountcost', get_string('discountcost', 'facetoface'), 'size="5"');
                $mform->setType('discountcost', PARAM_TEXT);
                $mform->setHelpButton('discountcost', array('discountcost', get_string('discountcost', 'facetoface'), 'facetoface'));
            }
        }

        $mform->addElement('htmleditor', 'details', get_string('details', 'facetoface'), '');
        $mform->setType('details', PARAM_RAW);
        $mform->setHelpButton('details', array('details', get_string('details', 'facetoface'), 'facetoface'));

        // Choose users for trainer roles
        $rolenames = facetoface_get_trainer_roles();

        if ($rolenames) {
            // Get current trainers
            $current_trainers = facetoface_get_trainers($this->_customdata['s']);

            // Loop through all selected roles
            $header_shown = false;
            foreach ($rolenames as $role => $rolename) {
                $rolename = $rolename->name;

                // Get course context
                $context = get_context_instance(CONTEXT_COURSE, $this->_customdata['course']->id);

                // Attempt to load users with this role in this course
                $rs = get_recordset_sql("
                    SELECT
                        u.id,
                        u.firstname,
                        u.lastname
                    FROM
                        {$CFG->prefix}role_assignments ra
                    LEFT JOIN
                        {$CFG->prefix}user u
                      ON ra.userid = u.id
                    WHERE
                        contextid = {$context->id}
                    AND roleid = {$role}
                ");

                if (!$rs) {
                    continue;
                }

                $choices = array();
                while ($roleuser = rs_fetch_next_record($rs)) {
                    $choices[$roleuser->id] = fullname($roleuser);
                }
                rs_close($rs);

                // Show header (if haven't already)
                if (!$header_shown) {
                    $mform->addElement('header', 'trainerroles', get_string('sessionroles', 'facetoface'));
                    $header_shown = true;
                }

                // If only a few, use checkboxes
                if (count($choices) < 4) {
                    foreach ($choices as $cid => $choice) {
                        $mform->addElement('advcheckbox', 'trainerrole['.$role.']['.$cid.']', $rolename, $choice, null, array('', $cid));
                        $mform->setType('trainerrole['.$role.']['.$cid.']', PARAM_INT);
                    }
                } else {
                    $mform->addElement('select', 'trainerrole['.$role.']', $rolename, $choices, array('multiple' => 'multiple'));
                    $mform->setType('trainerrole['.$role.']', PARAM_SEQUENCE);
                }

                // Select current trainers
                if ($current_trainers) {
                    foreach ($current_trainers as $role => $trainers) {
                        $t = array();
                        foreach ($trainers as $trainer) {
                            $t[] = $trainer->id;
                            $mform->setDefault('trainerrole['.$role.']['.$trainer->id.']', $trainer->id);
                        }

                        $mform->setDefault('trainerrole['.$role.']', implode(',', $t));
                    }
                }
            }
        }

        $this->add_action_buttons();
    }

    function validation($data, $files)
    {
        $errors = parent::validation($data, $files);

        if (!empty($data['datetimeknown'])) {
            $datefound = false;
            for ($i = 0; $i < $data['date_repeats']; $i++) {
                if (empty($data['datedelete'][$i])) {
                    $datefound = true;
                    break;
                }
            }

            if (!$datefound) {
                $errors['datetimeknown'] = get_string('validation:needatleastonedate', 'facetoface');
            }
        }

        return $errors;
    }
}
