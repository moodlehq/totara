<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

class competency_edit_form extends item_edit_form {

    // Load data for the form
    function definition_hierarchy_specific() {
        global $CFG;

        $mform =& $this->_form;
        $item = $this->_customdata['item'];

        // Get all aggregation methods
        global $COMP_AGGREGATION;
        $aggregations = array();
        foreach ($COMP_AGGREGATION as $title => $key) {
            $aggregations[$key] = get_string('aggregationmethod'.$key, 'competency');
        }

        // Get all available scales and their values
        $scales_raw = get_records_sql("
            SELECT
                v.id AS vid,
                s.id AS sid,
                s.name AS scale,
                v.name AS value
            FROM
                {$CFG->prefix}{$this->hierarchy->prefix}_scale_values v,
                {$CFG->prefix}{$this->hierarchy->prefix}_scale_assignments a,
                {$CFG->prefix}{$this->hierarchy->prefix}_scale s
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

        $mform->addElement('select', 'aggregationmethod', get_string('aggregationmethod', 'competency'), $aggregations);
        $mform->setHelpButton('aggregationmethod', array('competencyaggregationmethod', get_string('aggregationmethod', 'competency')), true);
        $mform->addRule('aggregationmethod', get_string('aggregationmethod', 'competency'), 'required', null, 'client');

        if (count($scales)) {
            $mform->addElement('select', 'scaleid', get_string('scale'), $scales);
            $mform->setHelpButton('scaleid', array('competencyscale', get_string('scale')), true);
            $mform->addRule('scaleid', get_string('scale'), 'required', null, 'client');
            if (count($scales) == 1) {
                $keys = array_keys($scales);
                $mform->setDefault('scaleid', $keys[0]);
                $mform->hardFreeze('scaleid');
            }
        }
    }
}
