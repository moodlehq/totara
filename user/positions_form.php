<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/idp/lib.php');

class user_position_assignment_form extends moodleform {

    // Define the form
    function definition () {
        global $CFG, $COURSE, $POSITION_TYPES;

        $mform =& $this->_form;
        $type = $this->_customdata['type'];
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
            $position_title = get_field('pos', 'fullname', 'id', $pa->positionid);
        }

        // Get organisation title
        $organisation_title = '';
        if ($pa->organisationid) {
            $organisation_title = get_field('org', 'fullname', 'id', $pa->organisationid);
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
                <a href="'.qualified_me().'&amp;nojs=1">'.get_string('clickfornonjsform','position').'</a>.</p></noscript>');
        }
        $mform->addElement('header', 'general', get_string('type'.$type, 'position'));

        if (!$aspirational) {
            $mform->addElement('text', 'fullname', get_string('titlefullname', 'position'));
            $mform->setType('fullname', PARAM_TEXT);
            $mform->setHelpButton('fullname', array('userpositionfullname', get_string('titlefullname', 'position')), true);

            $mform->addElement('text', 'shortname', get_string('titleshortname', 'position'));
            $mform->setType('shortname', PARAM_TEXT);
            $mform->setHelpButton('shortname', array('userpositionshortname', get_string('titleshortname', 'position')), true);

            $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'35'));
            $mform->setType('description', PARAM_RAW);
            $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        }

        if($nojs) {
            $allpositions = get_records_menu('pos','','','frameworkid,sortorder','id,fullname');
            $mform->addElement('select','positionid', get_string('chooseposition','position'), $allpositions);
            $mform->setHelpButton('positionid', array('userpositionposition', get_string('chooseposition', 'position')), true);
        } else {
            $mform->addElement('static', 'positionselector', get_string('position', 'position'),
                '<span id="positiontitle">'.htmlentities($position_title).'</span>
                '.
                ($can_edit ? '<input type="button" value="'.get_string('chooseposition', 'position').'" id="show-position-dialog" />' : '')
            );
            $mform->addElement('hidden', 'positionid');
            $mform->setType('positionid', PARAM_INT);
            $mform->setDefault('positionid', 0);
            $mform->setHelpButton('positionselector', array('userpositionposition', get_string('chooseposition', 'position')), true);
        }
        if (!$aspirational) {
            if($nojs) {
                $allorgs = get_records_menu('org','','','frameworkid,sortorder','id,fullname');
                if (is_array($allorgs) && !empty($allorgs) ){
                    $mform->addElement('select','organisationid', get_string('chooseorganisation','organisation'),
                        array(0 => get_string('chooseorganisation','organisation')) + $allorgs);
                } else {
                    $mform->addElement('static', 'organisationid', get_string('chooseorganisation','organisation'), get_string('noorganisation','organisation') );
                }
                $mform->setHelpButton('organisationid', array('userpositionorganisation', get_string('chooseorganisation', 'organisation')), true);
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
                $mform->setHelpButton('organisationselector', array('userpositionorganisation', get_string('chooseorganisation', 'organisation')), true);
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
                if ( is_array($allmanagers) && !empty($allmanagers) ){
                    $mform->addElement('select', 'managerid', get_string('choosemanager','position'),
                        array(0 => get_string('choosemanager','position')) + $allmanagers);
                    $mform->setDefault('managerid', $manager_id);
                } else {
                    $mform->addElement('static','managerid',get_string('choosemanager','position'), get_string('nomanagersavailable','position'));
                }
                $mform->setHelpButton('managerid', array('userpositionmanager', get_string('choosemanager', 'position')), true);
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
                $mform->setHelpButton('managerselector', array('userpositionmanager', get_string('choosemanager', 'position')), true);
            }

            $group = array();
            $group[] = $mform->createElement('text', 'timevalidfrom', get_string('startdate', 'position'));
            $group[] = $mform->createElement('static', 'timevalidfrom_hint', '', get_string('startdatehint', 'position'));
            $mform->addGroup($group, 'timevalidfrom_group', get_string('startdate', 'position'), array(' '), false);
            $mform->setType('timevalidfrom', PARAM_TEXT);
            $mform->setDefault('timevalidfrom','dd/mm/yy');
            $mform->setHelpButton('timevalidfrom_group', array('userpositionstartdate', get_string('startdate', 'position')), true);

            $group = array();
            $group[] = $mform->createElement('text', 'timevalidto', get_string('finishdate', 'position'));
            $group[] = $mform->createElement('static', 'timevalidto_hint', '', get_string('finishdatehint', 'position'));
            $mform->addGroup($group, 'timevalidto_group', get_string('finishdate', 'position'), array(' '), false);
            $mform->setType('timevalidto', PARAM_TEXT);
            $mform->setDefault('timevalidto','dd/mm/yy');
            $mform->setHelpButton('managerselector', array('userpositionmanager', get_string('choosemanager', 'position')), true);
            $mform->setHelpButton('timevalidto_group', array('userpositionfinishdate', get_string('finishdate', 'position')), true);

            $rule1['timevalidfrom'][] = array('Enter a valid date','regex' ,'/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');
            $mform->addGroupRule('timevalidfrom_group', $rule1);
            $rule2['timevalidto'][] = array('Enter a valid date','regex' ,'/^(0[1-9]|[12][0-9]|3[01])[- \/.](0[1-9]|1[012])[- \/.](19|20)\d\d$/');
            $mform->addGroupRule('timevalidto_group', $rule2);
        }

        $this->add_action_buttons(true, get_string('updateposition', 'position'));
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
                $mform->setDefault('timevalidfrom', date('d/m/Y', $timevalidfromdateint));
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
                $mform->setDefault('timevalidto', date('d/m/Y', $timevalidtodateint));
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
