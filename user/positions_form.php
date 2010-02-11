<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class user_position_assignment_form extends moodleform {

    // Define the form
    function definition () {
        global $CFG, $COURSE, $POSITION_TYPES;

        $mform =& $this->_form;
        $type = $this->_customdata['type'];
        $user = $this->_customdata['user'];
        $pa = $this->_customdata['position_assignment'];

        // Check if an aspirational position
        $aspirational = false;
        if ($type == $POSITION_TYPES[POSITION_TYPE_ASPIRATIONAL]) {
            $aspirational = true;
        }

        // Get position title
        $position_title = '';
        if ($pa->positionid) {
            $position_title = get_field('position', 'fullname', 'id', $pa->positionid);
        }

        // Get organisation title
        $organisation_title = '';
        if ($pa->organisationid) {
            $organisation_title = get_field('organisation', 'fullname', 'id', $pa->organisationid);
        }

        // Get manager title
        $manager_title = '';
        if ($pa->reportstoid) {
            $manager = get_record_sql(
                "
                    SELECT
                        u.id,        
                        u.firstname,
                        u.lastname,
                        ra.id AS ra
                    FROM
                        {$CFG->prefix}user u
                    INNER JOIN
                        {$CFG->prefix}role_assignments ra
                     ON u.id = ra.userid
                    WHERE
                        ra.id = {$pa->reportstoid}
                "
            );

            if ($manager) {
                $manager_title = fullname($manager);
            }
        }

        // Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        $mform->addElement('header', 'general', get_string('type'.$type, 'position'));

        if (!$aspirational) {
            $mform->addElement('text', 'fullname', get_string('titlefullname', 'position'));
            $mform->addElement('text', 'shortname', get_string('titleshortname', 'position'));

            $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'35'));
            $mform->setType('description', PARAM_RAW);
        }

        $mform->addElement('static', 'positionselector', get_string('position', 'position'),
            '
                <script type ="text/javascript"> var user_id = '.$user->id.'; </script>
                <span id="positiontitle">'.htmlentities($position_title).'</span>
                <input type="button" value="'.get_string('chooseposition', 'position').'" id="show-position-dialog" />
            '
        );
        $mform->addElement('hidden', 'positionid');
        $mform->setDefault('positionid', 0);

        if (!$aspirational) {
            $mform->addElement('static', 'organisationselector', get_string('organisation', 'position'),
                '
                    <span id="organisationtitle">'.htmlentities($organisation_title).'</span>
                    <input type="button" value="'.get_string('chooseorganisation', 'organisation').'" id="show-organisation-dialog" />
                '
            );
            $mform->addElement('hidden', 'organisationid');
            $mform->setDefault('organisationid', 0);

            $mform->addElement('static', 'managerselector', get_string('manager', 'position'),
                '
                    <span id="managertitle">'.htmlentities($manager_title).'</span>
                    <input type="button" value="'.get_string('choosemanager', 'position').'" id="show-manager-dialog" />
                '
            );
            $mform->addElement('hidden', 'managerid');
            $mform->setDefault('managerid', 0);

            $mform->addElement('text', 'timevalidfrom', get_string('startdate', 'position'));
            $mform->addElement('text', 'timevalidto', get_string('finishdate', 'position'));
        }

        $this->add_action_buttons(true, get_string('updateposition', 'position'));
    }

    function definition_after_data() {
        $mform =& $this->_form;

        // Fix odd date values
        if (!$mform->elementExists('timevalidfrom')) {
            return;
        }

        if (!$mform->getElementValue('timevalidfrom')) {
            $mform->setDefault('timevalidfrom', '');
        }
        else {
            $mform->setDefault('timevalidfrom', date('d/m/Y', $mform->getElementValue('timevalidfrom')));
        }

        if (!$mform->getElementValue('timevalidto')) {
            $mform->setDefault('timevalidto', '');
        }
        else {
            $mform->setDefault('timevalidto', date('d/m/Y', $mform->getElementValue('timevalidto')));
        }
    }
}
