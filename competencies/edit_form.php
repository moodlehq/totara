<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->libdir.'/hierarchylib.php');

class competency_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        // Get all competencies in this framework that we can use
        // as parents
        $item = $this->_customdata['competency'];
        $spage = $this->_customdata['spage'];
        $hierarchy = new hierarchy();
        $hierarchy->prefix = 'competency';
        $framework = $hierachy->get_framework($item->id);
        $items = $hiearchy->get_items();
        
        $competencies = get_records('competency', 'frameworkid', $competency->frameworkid, 'sortorder');

        // Get max depth level
        end($depths);
        $max_depth = current($depths)->id;

        // Get items current depth level
        $depthlevel = 0;
        if ($item->id) {
            $depthlevel = $depths[$item->depthid]->depthlevel;
        }

        $parents = array();

        // Add top as an option if adding a new item, or current parent is Top
        if (!$item->id || $item->parentid == 0) {
            $parents[0] = 'Top';
        }

        if ($items) {
            // Cache breadcrumbs
            $breadcrumbs = array();

            foreach ($items as $parent) {
                // Do not show items at the deepest depth
                if ($parent->depthid == $max_depth) {
                    continue;
                }

                // Do not show this item as a possible parent
                if ($parent->id == $item->id) {
                    continue;
                }

                // If we are editing a item, do not allow to alter the level of the parent
                if ($item->id) {
                    if ($depths[$parent->depthid]->depthlevel != ($depthlevel - 1)) {
                        continue;
                    }
                }

                // Grab parents and append this title
                $breadcrumbs = array_slice($breadcrumbs, 0, ($depths[$parent->depthid]->depthlevel - 1));
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
                {$CFG->prefix}{$hierarchy->prefix}_scale_values v,
                {$CFG->prefix}{$hierarchy->prefix}_scale_assignments a,
                {$CFG->prefix}{$hierarchy->prefix}_scale s
            WHERE
                a.frameworkid = {$item->frameworkid}
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
        if ($item->id) {
            $mform->addElement('hidden', 'depthid', $item->depthid);
            customfield_definition($mform, $item->id, $hierarchy->prefix, $item->depthid, $hierarchy->prefix.'_depth');
        }

        $this->add_action_buttons();
    }

    function definition_after_data() {

        $mform =& $this->_form;
        $itemid = $mform->getElementValue('id');

        if ($item = get_record('competency', 'id', $itemid)) {

            customfield_definition_after_data($mform, $item->id, 'competency', $item->depthid, 'competency_depth');

        }

    }

    function validation($itemnew, $files) {

        global $CFG;
        $errors = parent::validation($itemnew, $files);

        $itemnew = (object)$itemnew;
        $item    = get_record('competency', 'id', $itemnew->id);

        /// Check custom fields
        $errors += customfield_validation($itemnew, 'competency', 'competency_depth');

        return $errors;
    }

}
