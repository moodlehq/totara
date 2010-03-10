<?php

require_once "$CFG->dirroot/lib/formslib.php";

class mitms_competency_evidence_form extends moodleform {

    function definition()
    {
        global $CFG;

        $mform =& $this->_form;

        $ce = $this->_customdata['competencyevidence'];
        $editing = isset($ce); // if competency evidence passed to form, we are editing

        if($editing) {
            // get id and userid from competency evidence object
            $userid = $ce->userid;
            $id = $ce->id;

            // Get position title
            $position_title = '';
            if ($ce->positionid) {
                $position_title = get_field('position', 'fullname', 'id', $ce->positionid);
            }
            // Get organisation title
            $organisation_title = '';
            if ($ce->organisationid) {
                $organisation_title = get_field('organisation', 'fullname', 'id', $ce->organisationid);
            }

        } else {
            // for new record, userid must also be passed to form
            $userid = $this->_customdata['userid'];
            $id = null;
        }

        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('static', 'user', get_string('participant','local'));
        if($editing) {
            $mform->addElement('static', 'compname', get_string('competency','competency'));
        } else {
            // js competency picker here
        }
        $assessorroleid = get_field('role','id','shortname','assessor');
        $sql = "SELECT DISTINCT u.id,".sql_fullname('u.firstname','u.lastname')." AS name
            FROM {$CFG->prefix}role_assignments ra
            JOIN {$CFG->prefix}user u ON ra.userid = u.id
            WHERE roleid=$assessorroleid
            ORDER BY ".sql_fullname('u.firstname','u.lastname');
        $selectoptions = get_records_sql_menu($sql);
        if($selectoptions) {
            array_unshift($selectoptions,'Select an assessor...');
            $mform->addElement('select', 'assessorid', get_string('assessor','local'), $selectoptions);
        } else {
            // if assessorid set but no assessor roles defined, this should pass the current value
            $mform->addElement('hidden', 'assessorid','');
            $mform->addElement('static', 'assessoriderror', get_string('assessor','local'), 'No assessors found');
        }

        $mform->addElement('text', 'assessorname', get_string('assessorname','local'));
        $mform->addElement('text', 'assessmenttype', get_string('assessmenttype','local'));

        if(isset($ce)) {
            // editing existing competency evidence item
            // get id of the scale referred to by the evidence's proficiency
            $scaleid = get_field('competency_scale_values','scaleid','id',$ce->proficiency);
            $selectoptions = get_records_menu('competency_scale_values','scaleid',$scaleid,'sortorder');
            $mform->addElement('select', 'proficiency',get_string('proficiency','local'), $selectoptions);
        } else {
            // new competency evidence item
            // create a placeholder element to be filled when competency is selected
            $mform->addElement('static', 'proficiency',get_string('proficiency','local'), 'First select a competency');
        }
        // position selector
        $mform->addElement('static', 'positionselector', get_string('position', 'position'),
            '
            <script type ="text/javascript"> var user_id = '.$userid.'; </script>
            <span id="positiontitle">'.htmlentities($position_title).'</span>
            <input type="button" value="'.get_string('chooseposition', 'position').'" id="show-position-dialog" />
            ');
        $mform->addElement('hidden', 'positionid');
        $mform->setDefault('positionid', 0);

        // organisation selector
        $mform->addElement('static', 'organisationselector', get_string('organisation', 'position'),
            '
            <span id="organisationtitle">'.htmlentities($organisation_title).'</span>
            <input type="button" value="'.get_string('chooseorganisation', 'organisation').'" id="show-organisation-dialog" />
            ');
        $mform->addElement('hidden', 'organisationid');
        $mform->setDefault('organisationid', 0);

        $mform->addElement('date_selector', 'timemodified', get_string('timecompleted','local'));
        $this->add_action_buttons();
    }
/*
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
    }*/

}
