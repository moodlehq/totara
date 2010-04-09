<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/idp/lib.php');

class user_position_assignment_form extends moodleform {

    // Define the form
    function definition () {
        global $CFG, $COURSE, $POSITION_TYPES;

        $mform =& $this->_form;
        $type = $this->_customdata['type'];
        $user = $this->_customdata['user'];
        $pa = $this->_customdata['position_assignment'];
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
            $position_title = get_field('position', 'fullname', 'id', $pa->positionid);
        }

        // Get organisation title
        $organisation_title = '';
        if ($pa->organisationid) {
            $organisation_title = get_field('organisation', 'fullname', 'id', $pa->organisationid);
        }

        // Get manager title
        $manager_title = '';
        $manager_id = 0;
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
                $manager_id = $manager->id;
            }
        }

        // Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);

        if(!$nojs) {
            $mform->addElement('html','<noscript><p>This form requires Javascript to be enabled.
                <a href="'.qualified_me().'&amp;nojs=1">Click here for a none javascript version of this form</a>.</p></noscript>');
        }
        $mform->addElement('header', 'general', get_string('type'.$type, 'position'));

        if (!$aspirational) {
            $mform->addElement('text', 'fullname', get_string('titlefullname', 'position'));
            $mform->setType('fullname', PARAM_TEXT);
            $mform->addElement('text', 'shortname', get_string('titleshortname', 'position'));
            $mform->setType('shortname', PARAM_TEXT);

            $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'35'));
            $mform->setType('description', PARAM_RAW);
        }

        if($nojs) {
            $allpositions = get_records_menu('position','','','frameworkid,sortorder','id,fullname');
            $mform->addElement('select','positionid', get_string('chooseposition','position'), $allpositions);
        } else {
            $mform->addElement('static', 'positionselector', get_string('position', 'position'),
                '
                    <script type ="text/javascript"> var user_id = '.$user->id.'; </script>
                    <span id="positiontitle">'.htmlentities($position_title).'</span>
                '.
                ($can_edit ? '<input type="button" value="'.get_string('chooseposition', 'position').'" id="show-position-dialog" />' : '')
            );
            $mform->addElement('hidden', 'positionid');
            $mform->setType('positionid', PARAM_INT);
            $mform->setDefault('positionid', 0);
        }
        if (!$aspirational) {
            if($nojs) {
                $allorgs = get_records_menu('organisation','','','frameworkid,sortorder','id,fullname');
                $mform->addElement('select','organisationid', get_string('chooseorganisation','organisation'),
                    array(0 => get_string('chooseorganisation','organisation')) + $allorgs);
            } else {
                $mform->addElement('static', 'organisationselector', get_string('organisation', 'position'),
                    '
                        <span id="organisationtitle">'.htmlentities($organisation_title).'</span>
                    '.
                    ($can_edit ? '<input type="button" value="'.get_string('chooseorganisation', 'organisation').'" id="show-organisation-dialog" />' : '')
                );

                $mform->addElement('hidden', 'organisationid');
                $mform->setType('organisationid', PARAM_INT);
                $mform->setDefault('organisationid', 0);
            }

            if($nojs) {
             $allmanagers = get_records_sql_menu("
                    SELECT
                        u.id,
                        ".sql_fullname('u.firstname', 'u.lastname')." AS fullname,
                        ra.id AS ra
                    FROM
                        {$CFG->prefix}user u
                    INNER JOIN
                        {$CFG->prefix}role_assignments ra
                     ON u.id = ra.userid
                    INNER JOIN
                        {$CFG->prefix}role r
                     ON ra.roleid = r.id
                    WHERE
                        r.shortname = 'manager'
                    ORDER BY
                        u.firstname,
                        u.lastname");
             $mform->addElement('select', 'managerid', get_string('choosemanager','position'),
                array(0 => get_string('choosemanager','position')) + $allmanagers);
                $mform->setDefault('managerid', $manager_id);
            } else {
                $mform->addElement('static', 'managerselector', get_string('manager', 'position'),
                    '
                        <span id="managertitle">'.htmlentities($manager_title).'</span>
                    '.
                    ($can_edit ? '<input type="button" value="'.get_string('choosemanager', 'position').'" id="show-manager-dialog" />' : '')
                );
                $mform->addElement('hidden', 'managerid');
                $mform->setType('managerid', PARAM_INT);
                $mform->setDefault('managerid', $manager_id);
            }

            $mform->addElement('text', 'timevalidfrom', get_string('startdate', 'position'));
            $mform->setType('timevalidfrom', PARAM_TEXT);
            $mform->setDefault('timevalidfrom','dd/mm/yy');
            $mform->addElement('text', 'timevalidto', get_string('finishdate', 'position'));
            $mform->setType('timevalidto', PARAM_TEXT);
            $mform->setDefault('timevalidto','dd/mm/yy');
        }

        $this->add_action_buttons(true, get_string('updateposition', 'position'));
    }

    function definition_after_data() {
        $mform =& $this->_form;

        // Fix odd date values
        if (!$mform->elementExists('timevalidfrom')) {
            return;
        }

        if (!(int) $mform->getElementValue('timevalidfrom')) {
            $mform->setDefault('timevalidfrom', '');
        }
        else {
            $mform->setDefault('timevalidfrom', date('d/m/Y', (int) $mform->getElementValue('timevalidfrom')));
        }

        if (!(int) $mform->getElementValue('timevalidto')) {
            $mform->setDefault('timevalidto', '');
        }
        else {
            $mform->setDefault('timevalidto', date('d/m/Y', (int) $mform->getElementValue('timevalidto')));
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

            // Otherwise check if empty
            if (!$element->getValue()) {
                $mform->removeElement($element->getName());
            }
        }
    }

    function validation($data, $files) {

        $mform =& $this->_form;

        $result = array();

        $timevalidfromstr = isset($data['timevalidfrom'])?$data['timevalidfrom']:'';
        $timevalidfrom = convert_userdate( $timevalidfromstr );
        $timevalidtostr = isset($data['timevalidto'])?$data['timevalidto']:'';
        $timevalidto = convert_userdate( $timevalidtostr );

        // Enforce valid dates
        if ( false === $timevalidfrom && $timevalidfromstr !== 'dd/mm/yy' && $timevalidfromstr !== '' ){
            $result['timevalidfrom'] = get_string('error:dateformat','position');
        }
        if ( false === $timevalidto && $timevalidtostr !== 'dd/mm/yy' && $timevalidtostr !== '' ){
            $result['timevalidto'] = get_string('error:dateformat','position');
        }

        // Enforce start date before finish date
        if ( $timevalidfrom > $timevalidto && $timevalidfrom !== false && $timevalidto !== false ){
            $errstr = get_string('error:startafterfinish','position');
            $result['timevalidfrom'] = $errstr;
            $result['timevalidto'] = $errstr;
            unset($errstr);
        }

        // Check that a position was set
        if (!$mform->getElement('positionid')->getValue()) {
            $result['positionid'] = get_string('error:positionnotset', 'position');
        }
        
        return $result;
    }
}
