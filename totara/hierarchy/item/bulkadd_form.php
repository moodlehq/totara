<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

class item_bulkadd_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $prefix = $this->_customdata['prefix'];
        $shortprefix = hierarchy::get_short_prefix($prefix);
        $page = $this->_customdata['page'];
        $frameworkid = $this->_customdata['frameworkid'];

        $hierarchy = new $prefix();

        $framework = $hierarchy->get_framework($frameworkid);
        $items     = $hierarchy->get_items();
        $types   = $hierarchy->get_types();

        $parents = array();

        // Add top as an option
        $parents[0] = get_string('top', 'hierarchy');

        if ($items) {
            // Cache breadcrumbs
            $breadcrumbs = array();

            foreach ($items as $parent) {

                // Grab parents and append this title
                $breadcrumbs = array_slice($breadcrumbs, 0, ($parent->depthlevel - 1));
                $breadcrumbs[] = $parent->fullname;

                // Make display text
                $display = implode(' / ', $breadcrumbs);
                $parents[$parent->id] = $display;
            }
        }

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'prefix', $prefix);
        $mform->setType('prefix', PARAM_SAFEDIR);
        $mform->addElement('hidden', 'frameworkid', $frameworkid);
        $mform->setType('frameworkid', PARAM_INT);
        $mform->addElement('hidden', 'page', $page);
        $mform->setType('page', PARAM_INT);

        $mform->addElement('static', 'framework', get_string('framework', $prefix), $framework->fullname);

        $mform->addElement('select', 'parentid', get_string('parent', $prefix), $parents, totara_select_width_limiter());
        $mform->addRule('parentid', null, 'required');
        $mform->setType('parentid', PARAM_INT);
        $mform->setHelpButton('parentid', array($prefix.'parent', get_string('parent', $prefix)), true);

        if ($types) {
            // new item
            // show type picker if there are choices
            $select = array('0'=> '');
            foreach ($types as $type) {
                $select[$type->id] = $type->fullname;
            }
            $mform->addElement('select', 'typeid', get_string('type', $prefix), $select);
            $mform->setHelpButton('typeid', array($prefix.'type', get_string('type', $prefix)), true);
        } else {
            // new item
            // but no types exist
            // default to 'unclassified'
            $mform->addElement('hidden', 'typeid', '0');
        }


        $mform->addElement('textarea', 'itemnames', get_string('enternamesoneperline', 'hierarchy', get_string($prefix, $prefix)), 'rows="15" cols="50"');
        $mform->addRule('itemnames', null, 'required');
        $mform->setType('itemnames', PARAM_TEXT);

        // See if any hierarchy specific form definition exists
        $hierarchy->add_additional_item_form_fields($mform);

        $this->add_action_buttons();
    }

}
