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
        $spage = $this->_customdata['spage'];
        $competencies = get_records('competency', 'frameworkid', $competency->frameworkid, 'sortorder');
        $depthlevels = get_records('competency_depth', 'frameworkid', $competency->frameworkid, 'depthlevel');

        // Get max depth level
        end($depthlevels);
        $max_depth = current($depthlevels)->id;

        // Get competencies current depth level
        $depthlevel = 0;
        if ($competency->id) {
            $depthlevel = $depthlevels[$competency->depthid]->depthlevel;
        }

        $parents = array();

        // Add top as an option if adding a new competency, or current parent is Top
        if (!$competency->id || $competency->parentid == 0) {
            $parents[0] = 'Top';
        }

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

                // If we are editing a competency, do not allow to alter the level of the parent
                if ($competency->id) {
                    if ($depthlevels[$parent->depthid]->depthlevel != ($depthlevel - 1)) {
                        continue;
                    }
                }

                // Grab parents and append this title
                $breadcrumbs = array_slice($breadcrumbs, 0, ($depthlevels[$parent->depthid]->depthlevel - 1));
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

        // Get all available scales and their values
        $scales_raw = get_records_sql("
            SELECT
                v.id AS vid,
                s.id AS sid,
                s.name AS scale,
                v.name AS value
            FROM
                {$CFG->prefix}competency_scale_values v,
                {$CFG->prefix}competency_scale_assignments a,
                {$CFG->prefix}competency_scale s
            WHERE
                a.frameworkid = {$competency->frameworkid}
            AND a.scaleid = s.id
            AND s.id = v.scaleid
        ");

        $scales = array();
        $values = array();
        if ($scales_raw) {
            foreach ($scales_raw as $value) {
                if (!isset($scales[$value->sid])) {
                    $scales[$value->sid] = $value->scale;
                    $values[$value->sid] = array();
                }

                $values[$value->sid][$value->vid] = $value->value;
            }
        }

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->addElement('hidden', 'frameworkid');
        $mform->addElement('hidden', 'visible');
        $mform->addElement('hidden', 'sortorder');
        $mform->addElement('hidden', 'spage', $spage);

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

        $mform->addElement('select', 'scaleid', get_string('scale'), $scales);
        $mform->setHelpButton('scaleid', array('competencyscale', get_string('scale')), true);
        $mform->addRule('scaleid', get_string('scale'), 'required', null, 'client');
        if (count($scales) == 1) {
            $keys = array_keys($scales);
            var_dump($scales);
            var_dump($keys);
            $mform->setDefault('scaleid', $keys[0]);
            $mform->hardFreeze('scaleid');
        }

#        $mform->addElement('select', 'aggregationmethod', get_string('aggregationmethod', 'competencies'), $aggregations);
#        $mform->setHelpButton('aggregationmethod', array('competencyaggregationmethod', get_string('aggregationmethod', 'competencies')), true);
#        $mform->addRule('aggregationmethod', get_string('aggregationmethod', 'competencies'), 'required', null, 'client');

        /// Next show the custom fields if we're editing an existing competency (otherwise we don't know the depthid)
        if ($competency->id) {
            $mform->addElement('hidden', 'depthid', $competency->depthid);
            customfield_definition($mform, $competency->id, 'competency', $competency->depthid, 'competency_depth');
        }

        $this->add_action_buttons();
    }

    function definition_after_data() {

        $mform =& $this->_form;
        $competencyid = $mform->getElementValue('id');

        if ($competency = get_record('competency', 'id', $competencyid)) {

            customfield_definition_after_data($mform, $competency->id, 'competency', $competency->depthid, 'competency_depth');

        }

    }

    function validation($competencynew, $files) {

        global $CFG;
        $errors = parent::validation($competencynew, $files);

        $competencynew = (object)$competencynew;
        $competency    = get_record('competency', 'id', $competencynew->id);

        /// Check custom fields
        $errors += customfield_validation($competencynew, 'competency', 'competency_depth');

        return $errors;
    }

}
