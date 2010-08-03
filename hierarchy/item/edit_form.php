<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

class item_edit_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        // Get all items in this framework that we can use
        // as parents
        $type = $this->_customdata['type'];
        $shortprefix = hierarchy::get_short_prefix($type);
        $item = $this->_customdata['item'];
        $spage = $this->_customdata['spage'];
        $dialog = !empty($this->_customdata['dialog']);

        $this->hierarchy = $hierarchy = new $type();

        $framework = $hierarchy->get_framework($item->frameworkid);
        $items     = $hierarchy->get_items();
        $depths    = $hierarchy->get_depths();

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

        $strgeneral  = get_string('general');

        /// Add some extra hidden fields
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $mform->addElement('hidden', 'type', $type);
        $mform->setType('type', PARAM_SAFEDIR);
        $mform->addElement('hidden', 'frameworkid');
        $mform->setType('frameworkid', PARAM_INT);
        $mform->addElement('hidden', 'visible');
        $mform->setType('visible', PARAM_INT);
        $mform->addElement('hidden', 'sortorder');
        $mform->setType('sortorder', PARAM_INT);
        $mform->addElement('hidden', 'spage', $spage);
        $mform->setType('spage', PARAM_INT);

        /// Print the required moodle fields first
        $mform->addElement('header', 'moodle', $strgeneral);

        $mform->addElement('text', 'framework', get_string('framework', $type));
        $mform->setHelpButton('framework', array($type.'framework', get_string('framework', $type)), true);
        $mform->hardFreeze('framework');

        $mform->addElement('select', 'parentid', get_string('parent', $type), $parents);
        $mform->setHelpButton('parentid', array($type.'parent', get_string('parent', $type)), true);
        // If we only have a "Top" placeholder parentid, lock it
        if (count($parents) <= 1) {
            $mform->setDefault('parentid', 0);
            $mform->hardFreeze('parentid');
        }

        $mform->addElement('text', 'fullname', get_string('fullname', $type), 'maxlength="254" size="50"');
        $mform->setHelpButton('fullname', array($type.'fullname', get_string('fullname', $type)), true);
        $mform->addRule('fullname', get_string('missingfullname', $type), 'required', null);
        $mform->setType('fullname', PARAM_MULTILANG);

        $mform->addElement('text', 'shortname', get_string('shortname', $type), 'maxlength="100" size="20"');
        $mform->setHelpButton('shortname', array($type.'shortname', get_string('shortname', $type)), true);
        $mform->addRule('shortname', get_string('missingshortname', $type), 'required', null);
        $mform->setType('shortname', PARAM_MULTILANG);

        $mform->addElement('text', 'idnumber', get_string('idnumber', $type), 'maxlength="100"  size="10"');
        $mform->setHelpButton('idnumber', array($type.'idnumber', get_string('idnumber', $type)), true);
        $mform->setType('idnumber', PARAM_CLEAN);

        // If we are in a dialog, hide the htmleditor. It messes with the jquery code
        if (!$dialog) {
            $mform->addElement('htmleditor', 'description', get_string('description'));
            $mform->setHelpButton('description', array('text', get_string('helptext')), true);
            $mform->setType('description', PARAM_CLEAN);
        }

        /// Next show the custom fields if we're editing an existing items (otherwise we don't know the depthid)
        if ($item->id) {
            $mform->addElement('hidden', 'depthid', $item->depthid);
            $mform->setType('depthid', PARAM_INT);
            customfield_definition($mform, $item->id, $type, $item->depthid, $shortprefix.'_depth');
        }

        // See if any hierarchy specific form definition exists
        if (method_exists($this, 'definition_hierarchy_specific')) {
            $this->definition_hierarchy_specific();
        }

        $this->add_action_buttons();
    }

    function definition_after_data() {

        $mform =& $this->_form;
        $itemid = $mform->getElementValue('id');
        $type   = $mform->getElementValue('type');
        $shortprefix = hierarchy::get_short_prefix($type);

        if ($item = get_record($shortprefix, 'id', $itemid)) {

            customfield_definition_after_data($mform, $item->id, $type, $item->depthid, $shortprefix.'_depth');

        }

    }

    function validation($itemnew, $files) {

        global $CFG;
        $errors = parent::validation($itemnew, $files);

        $itemnew = (object)$itemnew;
        $item    = get_record(hierarchy::get_short_prefix($itemnew->type), 'id', $itemnew->id);
        $shortprefix = hierarchy::get_short_prefix($itemnew->type);

        if ($itemnew->id) {
            /// Check custom fields
            $errors += customfield_validation($itemnew, $itemnew->type, $shortprefix.'_depth');
        }

        return $errors;
    }

}
