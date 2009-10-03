<?php

require_once($CFG->dirroot.'/lib/formslib.php');

class competency_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        // Get all competencies in this framework that we can use
        // as parents
        $competency = $this->_customdata['competency'];
        $competencies = get_records('competency', 'frameworkid', $competency->frameworkid, 'sortorder');
        $depthid = get_field_select('competency_depth', 'id', "frameworkid=$competency->frameworkid and depthlevel=$competency->depthid");
        $max_depth = get_field('competency_depth', 'MAX(depthlevel)', 'frameworkid', $competency->frameworkid);

        $parents = array(
            0   => 'Top',
        );

        if ($competencies) {
            // Cache breadcrumbs
            $breadcrumbs = array();

            foreach ($competencies as $parent) {
                // Do not show competencies at the deepest depth
                if ($parent->depthid == $max_depth) {
                    continue;
                }

                // Do not show this competency as a possible parent
                if ($parent->id == $competency->id) {
                    continue;
                }

                // Grab parents and append this title
                $breadcrumbs = array_slice($breadcrumbs, 0, $parent->depthid);
                $breadcrumbs[] = $parent->fullname;

                // Make display text
                $display = implode(' / ', $breadcrumbs);
                $parents[$parent->id] = $display;
            }
        }

        // Get all aggregation methods
        global $COMP_AGGREGATION;
        $aggregations = array();
        foreach ($COMP_AGGREGATION as $title => $key) {
            $aggregations[$key] = get_string('aggregationmethod'.$key, 'competencies');
        }

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'frameworkid');
        $mform->addElement('hidden', 'visible');
        $mform->addElement('hidden', 'sortorder');

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'framework', get_string('framework', 'competencies'));
        $mform->setHelpButton('framework', array('competencyframework', get_string('framework', 'competencies')), true);
        $mform->hardFreeze('framework');

        $mform->addElement('select', 'parentid', get_string('parent', 'competencies'), $parents);
        $mform->setHelpButton('parentid', array('competencyparent', get_string('parent', 'competencies')), true);
        // If we only have a "Top" placeholder parentid, lock it
        if (count($parents) <= 1) {
            $mform->setDefault('parentid', 0);
            $mform->hardFreeze('parentid');
        }

        $mform->addElement('text', 'fullname', get_string('fullname', 'competencies'), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array('competencyfullname', get_string('fullname', 'competencies')), true);
        $mform->addRule('fullname', get_string('missingfullname', 'competencies'), 'required', null, 'client');
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortname', 'competencies'), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array('competencyshortname', get_string('shortname', 'competencies')), true);
        $mform->addRule('shortname', get_string('missingshortname', 'competencies'), 'required', null, 'client');
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('idnumber', 'competencies'), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array('competencyidnumber', get_string('idnumber', 'competencies')), true);
        $mform->setType('idnumber', PARAM_RAW);

        $mform->addElement('htmleditor', 'description', get_string('description'), array('rows'=> '10', 'cols'=>'65'));
        $mform->setHelpButton('description', array('text', get_string('helptext')), true);
        $mform->setType('description', PARAM_RAW);

        $mform->addElement('select', 'aggregationmethod', get_string('aggregationmethod', 'competencies'), $aggregations);
        $mform->setHelpButton('aggregationmethod', array('competencyaggregationmethod', get_string('aggregationmethod', 'competencies')), true);
        $mform->addRule('aggregationmethod', get_string('aggregationmethod', 'competencies'), 'required', null, 'client');

        /// Next show the custom fields if we're editing an existing competency (otherwise we don't know the depthid)
        if ($competency->id) {
            customfield_definition($mform, $competency->id, 'competency', $depthid, 'competency_depth');
        }

        $this->add_action_buttons();
    }
}
