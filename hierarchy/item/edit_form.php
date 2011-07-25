<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

class item_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        $prefix = $this->_customdata['prefix'];
        $shortprefix = hierarchy::get_short_prefix($prefix);
        $item = $this->_customdata['item'];
        $page = $this->_customdata['page'];
        $dialog = !empty($this->_customdata['dialog']);

        $this->hierarchy = $hierarchy = new $prefix();

        $framework = $hierarchy->get_framework($item->frameworkid);
        $items     = $hierarchy->get_items();
        $types   = $hierarchy->get_types();
        $type   = $hierarchy->get_type_by_id($item->typeid);
        $typename = ($type) ? $type->fullname : get_string('unclassified', 'hierarchy');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'prefix', $prefix);
        $mform->setType('prefix', PARAM_ALPHA);
        $mform->addElement('hidden', 'frameworkid');
        $mform->setType('frameworkid', PARAM_INT);
        $mform->addElement('hidden', 'visible');
        $mform->setType('visible', PARAM_INT);
        $mform->addElement('hidden', 'sortorder');
        $mform->setType('sortorder', PARAM_INT);
        $mform->addElement('hidden', 'page', $page);
        $mform->setType('page', PARAM_INT);
        $mform->addElement('hidden', 'evidencecount');
        $mform->setType('evidencecount', PARAM_INT);
        $mform->addElement('hidden', 'proficiencyexpected');
        $mform->setType('proficiencyexpected', PARAM_INT);

        $mform->addElement('text', 'framework', get_string('framework', $prefix));
        $mform->hardFreeze('framework');

        $parents = $hierarchy->get_parent_list($items, $item);
        // If we only have one possible parent, it must be the top level, so hide the
        // pulldown
        if (count($parents) <= 1) {
            $mform->addElement('hidden', 'parentid', 0);
        } else {
            $mform->addElement('select', 'parentid', get_string('parent', $prefix), $parents, totara_select_width_limiter());
            $mform->setHelpButton('parentid', array($prefix.'parent', get_string('parent', $prefix)), true);
        }

        $mform->addElement('text', 'fullname', get_string('name'), 'maxlength="254" size="50"');
        $mform->addRule('fullname', get_string('missingname', $prefix), 'required', null);
        $mform->setType('fullname', PARAM_MULTILANG);

        if (HIERARCHY_DISPLAY_SHORTNAMES) {
            $mform->addElement('text', 'shortname', get_string('shortname', $prefix), 'maxlength="100" size="20"');
            $mform->setHelpButton('shortname', array($prefix.'shortname', get_string('shortname', $prefix)), true);
            $mform->addRule('shortname', get_string('missingshortname', $prefix), 'required', null);
            $mform->setType('shortname', PARAM_MULTILANG);
        }

        $mform->addElement('text', 'idnumber', get_string('idnumber', $prefix), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array($prefix.'idnumber', get_string('idnumber', $prefix)), true);
        $mform->setType('idnumber', PARAM_CLEAN);

        // If we are in a dialog, hide the htmleditor. It messes with the jquery code
        if (!$dialog) {
            $mform->addElement('htmleditor', 'description', get_string('description'));
            $mform->setHelpButton('description', array($prefix.'description', get_string('description')), true);
            $mform->setType('description', PARAM_CLEAN);
        }

        if ($item->id && $item->typeid != 0) {

            $group = array();
            // display current type (static)
            $group[] = $mform->createElement('static', 'type', '');
            // and provide a button for changing type
            $group[] = $mform->createElement('submit', 'changetype', get_string('changetype', 'hierarchy'));
            $mform->addGroup($group, 'typegroup', get_string('type', $prefix), array(' &nbsp; '), false);

            $mform->setDefault('type', $typename);
            $mform->setHelpButton('typegroup', array($prefix.'type', get_string('type', $prefix)), true);

            // store the actual type ID
            $mform->addElement('hidden', 'typeid', $item->typeid);

        } else if ($types) {
            // new item
            // show type picker if there are choices
            $select = array('0'=> '');
            foreach ($types as $type) {
                $select[$type->id] = $type->fullname;
            }
            $mform->addElement('select', 'typeid', get_string('type', $prefix), $select, totara_select_width_limiter());
            $mform->setHelpButton('typeid', array($prefix.'type', get_string('type', $prefix)), true);
        } else {
            // new item
            // but no types exist
            // default to 'unclassified'
            $mform->addElement('hidden', 'typeid', '0');
        }

        /// Next show the custom fields if we're editing an existing items (otherwise we don't know the typeid)
        if ($item->id && $item->typeid != 0) {
            customfield_definition($mform, $item->id, $prefix, $item->typeid, $shortprefix.'_type');
        }

        // See if any hierarchy specific form definition exists
        $hierarchy->add_additional_item_form_fields($mform);

        $this->add_action_buttons();
    }

    function definition_after_data() {

        $mform =& $this->_form;
        $itemid = $mform->getElementValue('id');
        $prefix   = $mform->getElementValue('prefix');
        $shortprefix = hierarchy::get_short_prefix($prefix);

        if ($item = get_record($shortprefix, 'id', $itemid)) {

            customfield_definition_after_data($mform, $item->id, $prefix, $item->typeid, $shortprefix.'_type');

        }

    }

    function validation($itemnew, $files) {

        global $CFG;
        $errors = parent::validation($itemnew, $files);

        $itemnew = (object)$itemnew;
        $item    = get_record(hierarchy::get_short_prefix($itemnew->prefix), 'id', $itemnew->id);
        $shortprefix = hierarchy::get_short_prefix($itemnew->prefix);

        if ($itemnew->id) {
            /// Check custom fields
            $errors += customfield_validation($itemnew, $itemnew->prefix, $shortprefix.'_type');
        }

        return $errors;
    }

}
