<?php

require_once "$CFG->dirroot/lib/formslib.php";

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

class totara_competency_evidence_form extends moodleform {

    function definition()
    {
        global $CFG;

        $mform =& $this->_form;

        $competencyid = isset($this->_customdata['competencyid']) ? $this->_customdata['competencyid'] : 0;
        $positionid = isset($this->_customdata['positionid']) ? $this->_customdata['positionid'] : 0;
        $organisationid = isset($this->_customdata['organisationid']) ? $this->_customdata['organisationid'] : 0;
        $nojs = $this->_customdata['nojs'];
        $id = $this->_customdata['id'];
        $evidenceid = $this->_customdata['evidenceid'];
        $editing = !empty($evidenceid) ? true : false;

        if($editing) {
            // Get the evidence record
            $ce = get_record('comp_evidence', 'id', $evidenceid);

            // get id and userid from competency evidence object
            $userid = $ce->userid;

            // Get position title
            $position_title = '';
            if ($ce->positionid) {
                $position_title = get_field('pos', 'fullname', 'id', $ce->positionid);
            }
            // Get organisation title
            $organisation_title = '';
            if ($ce->organisationid) {
                $organisation_title = get_field('org', 'fullname', 'id', $ce->organisationid);
            }

        } else {
            // for new record, userid must also be passed to form
            $userid = $this->_customdata['userid'];
            $id = $this->_customdata['id'];
            $position_assignment = new position_assignment(
                array(
                    'userid'    => $userid,
                    'type'      => POSITION_TYPE_PRIMARY
                )
            );

            // repopulate if set but validation failed
            if (!empty($positionid)) {
                $position_title = get_field('pos', 'fullname', 'id', $positionid);
            } else {
                $position_title = !empty($position_assignment->fullname) ? $position_assignment->fullname : '';
            }
            if (!empty($organisationid)) {
                $organisation_title = get_field('org', 'fullname', 'id', $organisationid);
            } else {
                $organisation_title = get_field('org', 'fullname', 'id', $position_assignment->organisationid);
            }
            $competency_title = ($competencyid != 0) ?
                get_field('comp', 'fullname', 'id', $competencyid) : '';
        }

        $mform->addElement('hidden', 'evidenceid', $evidenceid);
        $mform->setType('evidenceid', PARAM_INT);

        if(!$nojs && $competencyid == 0) {
            // replace previous return url with a new url
            // submitting the form won't return the user to
            // the record of learning page if JS is ofe
            $murl = new moodle_url(qualified_me());
            $mform->addElement('html','<noscript><p>This form requires Javascript to be enabled.
                <a href="'.$murl->out(false,array('nojs'=>1)).'">'.get_string('clickfornonjsform','competency').'</a>.</p></noscript>');
        }

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('static', 'user', get_string('participant','local'));
        $mform->setHelpButton('user',array('competencyevidenceuser',get_string('participant','local'),'moodle'));
        $mform->addElement('hidden', 'userid', $userid);
        $mform->setType('userid', PARAM_INT);
        $mform->addRule('userid', null, 'required');
        $mform->addRule('userid', null, 'numeric');
        $mform->addElement('hidden', 'id', $id);
        $mform->addElement('hidden', 'evidenceid', $evidenceid);
        $mform->setType('userid', PARAM_INT);


        if($editing) {
            $mform->addElement('hidden', 'competencyid', $ce->competencyid);
            $mform->setType('competencyid', PARAM_INT);
            $mform->addElement('static', 'compname', get_string('competency','competency'));
            $mform->setHelpButton('compname',array('competencyevidencecompetency',get_string('competency','competency'),'moodle'));
        } else {
            if($nojs) {
                $mform->addElement('static','assigncompetency',get_string('assigncompetency','competency'),'<div id="competencytitle">'.htmlentities($competency_title).'</div><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/assign/find.php?nojs=1&amp;s='.sesskey().'&amp;returnurl='.$newreturn.'&amp;userid='.$userid.'">'.get_string('assigncompetency','competency').'</a>.');
                $mform->addElement('hidden', 'competencyid');
                $mform->setType('competencyid', PARAM_INT);
                $mform->setDefault('competencyid', $competencyid);
            } else {
                // competency selector
                $mform->addElement('static', 'competencyselector', get_string('competency', 'competency'), '<span id="competencytitle">'.htmlentities($competency_title).'</span>');
                $mform->addElement('hidden', 'competencyid');
                $mform->setType('competencyid', PARAM_INT);
                $mform->setDefault('competencyid', $competencyid);
                $mform->setHelpButton('competencyselector',array('competencyevidencecompetency',get_string('assigncompetency','competency'),'moodle'));
            }

        }
        $mform->addRule('competencyid',null,'required');
        $mform->addRule('competencyid',null,'numeric');

        if($assessorroleid = get_field('role','id','shortname','assessor')) {
            $sql = "SELECT DISTINCT u.id,".sql_fullname('u.firstname','u.lastname')." AS name
                FROM {$CFG->prefix}role_assignments ra
                JOIN {$CFG->prefix}user u ON ra.userid = u.id
                WHERE roleid=$assessorroleid
                ORDER BY ".sql_fullname('u.firstname','u.lastname');
            $selectoptions = get_records_sql_menu($sql);
        } else {
            // no assessor role
            $selectoptions = false;
        }
        if($selectoptions) {
            $selector = array(0 => get_string('selectanassessor','local'));
            $mform->addElement('select', 'assessorid', get_string('assessor','local'), $selector + $selectoptions);
            $mform->setType('assessorid', PARAM_INT);
            $mform->setHelpButton('assessorid',array('competencyevidenceassessor',get_string('assessor','local'),'moodle'));
        } else {
            // if assessorid set but no assessor roles defined, this should pass the current value
            $mform->addElement('hidden', 'assessorid','');
            $mform->setType('assessorid', PARAM_INT);
            $mform->addElement('static', 'assessoriderror', get_string('assessor','local'), get_string('noassessors','local'));
            $mform->setHelpButton('assessoriderror',array('competencyevidenceassessor',get_string('assessor','local'),'moodle'));
        }

        $mform->addElement('text', 'assessorname', get_string('assessorname','local'));
        $mform->setType('assessorname', PARAM_TEXT);
        $mform->setHelpButton('assessorname',array('competencyevidenceassessorname',get_string('assessorname','local'),'moodle'));
        $mform->addElement('text', 'assessmenttype', get_string('assessmenttype','local'));
        $mform->setType('assessmenttype', PARAM_TEXT);
        $mform->setHelpButton('assessmenttype',array('competencyevidenceassessmenttype',get_string('assessmenttype','local'),'moodle'));

        if(!empty($ce)) {
            // editing existing competency evidence item
            // get id of the scale referred to by the evidence's proficiency
            $scaleid = get_field('comp_scale_values','scaleid','id',$ce->proficiency);
            $selectoptions = get_records_menu('comp_scale_values','scaleid',$scaleid,'sortorder');
            $mform->addElement('select', 'proficiency', get_string('status','local_plan'), $selectoptions);
        } else if ($competencyid != 0) {
            // competency set but validation failed. Refill scale options
            $frameworkid = get_field('comp','frameworkid','id',$competencyid);
            $scaleid = get_field('comp_scale_assignments','scaleid','frameworkid',$frameworkid);
            $selectoptions = get_records_menu('comp_scale_values','scaleid',$scaleid,'sortorder');
            $mform->addElement('select', 'proficiency', get_string('status', 'local_plan'), $selectoptions);
            $mform->setType('proficiency', PARAM_INT);
        } else {
            // new competency evidence item
            // create a placeholder element to be filled when competency is selected
            $mform->addElement('select', 'proficiency', get_string('status', 'local_plan'), array(get_string('firstselectcompetency','local')));
            $mform->setType('proficiency', PARAM_INT);
            $mform->disabledIf('proficiency','competencyid','eq',0);
        }
        $mform->setHelpButton('proficiency', array('competencyevidencestatus', get_string('status', 'local_plan'), 'local_plan'));
        $mform->addRule('proficiency',null,'required');
        $mform->addRule('proficiency',get_string('err_required','form'),'nonzero');


        if($nojs) {
            $allpositions = get_records_menu('pos','','','frameworkid,sortorder','id,fullname');
            $mform->addElement('select','positionid', get_string('chooseposition','position'), array(0 => get_string('chooseposition','position')) + $allpositions);
        } else {
            // position selector
            $mform->addElement('static', 'positionselector', get_string('positionatcompletion', 'local'),
                '
                <span id="positiontitle">'.htmlentities($position_title).'</span>
                <input type="button" value="'.get_string('chooseposition', 'position').'" id="show-position-dialog" />
                ');
            $mform->setHelpButton('positionselector',array('competencyevidenceposition',get_string('positionatcompletion','local'),'moodle'));

            $mform->addElement('hidden', 'positionid');
            $mform->setType('positionid', PARAM_INT);
            $mform->addRule('positionid', null, 'numeric');

            // Set default pos to user's current primary position
            $mform->setDefault('positionid', !empty($position_assignment->positionid) ? $position_assignment->positionid : 0);
        }

        if($nojs) {
            $allorgs = get_records_menu('org','','','frameworkid,sortorder','id,fullname');
            $mform->addElement('select','organisationid', get_string('chooseorganisation','organisation'), array(0 => get_string('chooseorganisation','organisation')) + $allorgs);
        } else {
            // organisation selector
            $mform->addElement('static', 'organisationselector', get_string('organisationatcompletion', 'local'),
                '
                <span id="organisationtitle">'.htmlentities($organisation_title).'</span>
                <input type="button" value="'.get_string('chooseorganisation', 'organisation').'" id="show-organisation-dialog" />
                ');
            $mform->setHelpButton('organisationselector',array('competencyevidenceorganisation',get_string('organisationatcompletion','local'),'moodle'));
            $mform->addElement('hidden', 'organisationid');
            $mform->setType('organisationid', PARAM_INT);
            $mform->setDefault('organisationid', !empty($position_assignment->organisationid) ? $position_assignment->organisationid : 0);
            $mform->addRule('organisationid', null, 'numeric');
        }

        $mform->addElement('date_selector', 'timemodified', get_string('timecompleted','local'));
        $mform->setHelpButton('timemodified',array('competencyevidencetimecompleted',get_string('timecompleted','local'),'moodle'));

        $this->add_action_buttons();
    }

/*    function validation($data) {
        $errors = array();
        $editing = isset($this->_customdata['competencyevidence']);
        if(!$editing) {
            if( $existing = get_record('comp_evidence','userid',$data['userid'], 'competencyid', $data['competencyid'])) {
                $errors['competencyselector'] = get_string('error:compevidencealreadyexists','competency', $existing->id);
            }
        }
        return $errors;
}*/

}
