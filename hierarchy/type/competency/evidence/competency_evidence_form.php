<?php

require_once "$CFG->dirroot/lib/formslib.php";

class mitms_competency_evidence_form extends moodleform {

    function definition()
    {
        global $CFG;

        $mform =& $this->_form;

        $s = $this->_customdata['s'];
        $returnurl = $this->_customdata['returnurl'];
        $editing = isset($this->_customdata['competencyevidence']); // if competency evidence passed to form, we are editing
        $ce = $editing ? $this->_customdata['competencyevidence'] : null;
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
            $position_title = '';
            $organisation_title = '';
        }

        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('hidden', 's', $s);
        $mform->addElement('hidden', 'returnurl', $returnurl);

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('static', 'user', get_string('participant','local'));
        $mform->addElement('hidden', 'userid', $userid);
        $mform->addRule('userid', null, 'required');
        $mform->addRule('userid', null, 'numeric');

        if($editing) {
            $mform->addElement('hidden', 'competencyid', $ce->competencyid);
            $mform->addElement('static', 'compname', get_string('competency','competency'));
        } else {

            // competency selector
            $mform->addElement('static', 'competencyselector', get_string('competency', 'competency'),
                '
                <script type ="text/javascript"> var user_id = '.$userid.'; </script>
                <span id="competencytitle"></span>
                <input type="button" value="'.get_string('selectcompetency', 'local').'" id="show-competency-dialog" />
                ');
            $mform->addElement('hidden', 'competencyid');
            $mform->setDefault('competencyid', 0);

        }
        $mform->addRule('competencyid',null,'required');
        $mform->addRule('competencyid',null,'numeric');

        $assessorroleid = get_field('role','id','shortname','assessor');
        $sql = "SELECT DISTINCT u.id,".sql_fullname('u.firstname','u.lastname')." AS name
            FROM {$CFG->prefix}role_assignments ra
            JOIN {$CFG->prefix}user u ON ra.userid = u.id
            WHERE roleid=$assessorroleid
            ORDER BY ".sql_fullname('u.firstname','u.lastname');
        $selectoptions = get_records_sql_menu($sql);
        if($selectoptions) {
            $selector = array(0 => get_string('selectanassessor','local'));
            $mform->addElement('select', 'assessorid', get_string('assessor','local'), $selector + $selectoptions);
        } else {
            // if assessorid set but no assessor roles defined, this should pass the current value
            $mform->addElement('hidden', 'assessorid','');
            $mform->addElement('static', 'assessoriderror', get_string('assessor','local'), get_string('noassessors','local'));
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
            $mform->addElement('select', 'proficiency',get_string('proficiency','local'), array(get_string('firstselectcompetency','local')));
            $mform->disabledIf('proficiency','competencyid','eq',0);
        }
        $mform->addRule('proficiency',null,'required');
        $mform->addRule('proficiency',get_string('err_required','form'),'nonzero');

        // position selector
        $mform->addElement('static', 'positionselector', get_string('positionatcompletion', 'local'),
            '
            <script type ="text/javascript"> var user_id = '.$userid.'; </script>
            <span id="positiontitle">'.htmlentities($position_title).'</span>
            <input type="button" value="'.get_string('chooseposition', 'position').'" id="show-position-dialog" />
            ');
        $mform->addElement('hidden', 'positionid');
        $mform->setDefault('positionid', 0);
        $mform->addRule('positionid', null, 'numeric');

        // organisation selector
        $mform->addElement('static', 'organisationselector', get_string('organisationatcompletion', 'local'),
            '
            <span id="organisationtitle">'.htmlentities($organisation_title).'</span>
            <input type="button" value="'.get_string('chooseorganisation', 'organisation').'" id="show-organisation-dialog" />
            ');
        $mform->addElement('hidden', 'organisationid');
        $mform->setDefault('organisationid', 0);
        $mform->addRule('organisationid', null, 'numeric');

        $mform->addElement('date_selector', 'timemodified', get_string('timecompleted','local'));

        $this->add_action_buttons();
    }

}
