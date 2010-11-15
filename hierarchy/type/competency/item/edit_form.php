<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');

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

        // Get the name of the framework's scale. (Note this code expects there
        // to be only one scale per framework, even though the DB structure
        // allows there to be multiple since we're using a go-between table)
        $scaledesc = get_field_sql("
            select s.name
            from
                {$CFG->prefix}{$this->hierarchy->shortprefix}_scale s,
                {$CFG->prefix}{$this->hierarchy->shortprefix}_scale_assignments a
            where
                a.frameworkid = {$item->frameworkid}
                and a.scaleid = s.id
        ");

        $mform->addElement('select', 'aggregationmethod', get_string('aggregationmethod', 'competency'), $aggregations);
        $mform->setHelpButton('aggregationmethod', array('competencyaggregationmethod', get_string('aggregationmethod', 'competency')), true);
        $mform->addRule('aggregationmethod', get_string('aggregationmethod', 'competency'), 'required', null);

        $mform->addElement('static', 'scalename', get_string('scale'), ($scaledesc)?$scaledesc:get_string('none'));

        $mform->setHelpButton('scalename', array('competencyscale', get_string('scale')), true);
    }
}
