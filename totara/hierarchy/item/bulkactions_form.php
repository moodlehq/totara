<?php

require_once($CFG->dirroot.'/lib/formslib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

class item_bulkaction_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG, $SESSION;

        $mform =& $this->_form;

        $prefix = $this->_customdata['prefix'];
        $frameworkid = $this->_customdata['frameworkid'];
        $framework = $this->_customdata['framework'];
        $action = $this->_customdata['action'];
        $shortprefix = hierarchy::get_short_prefix($prefix);
        $apage = $this->_customdata['apage'];
        $spage = $this->_customdata['spage'];
        $displayed_available_items = $this->_customdata['displayed_available_items'];
        $displayed_selected_items = $this->_customdata['displayed_selected_items'];
        $all_selected_item_ids = $this->_customdata['all_selected_item_ids'];
        $all_disabled_item_ids = $this->_customdata['all_disabled_item_ids'];
        $count_available_items = $this->_customdata['count_available_items'];
        $count_selected_items = $this->_customdata['count_selected_items'];
        $searchterm = $this->_customdata['searchterm'];

        $hierarchy = new $prefix();
        $hierarchy->frameworkid = $frameworkid;

        $items     = $hierarchy->get_items();
        $types   = $hierarchy->get_types();

        // pass params to next page
        $mform->addElement('hidden', 'prefix', $prefix);
        $mform->setType('prefix', PARAM_ALPHA);
        $mform->addElement('hidden', 'frameworkid', $frameworkid);
        $mform->setType('frameworkid', PARAM_INT);
        $mform->addElement('hidden', 'action', $action);
        $mform->setType('action', PARAM_ALPHA);
        $mform->addElement('hidden', 'spage', $spage);
        $mform->setType('spage', PARAM_INT);
        $mform->addElement('hidden', 'apage', $apage);
        $mform->setType('apage', PARAM_INT);

        // warning when a parent and its descendent are both selected
        // this shouldn't really be possible as unneeded children are also removed from the list
        // at the time the items are added
        if (count($all_selected_item_ids) != count($hierarchy->get_items_excluding_children($all_selected_item_ids))) {
            $message = get_string('parentchildselectedwarning' . $action, 'hierarchy');
            $mform->addElement('html', print_container($message, true, 'hierarchy-bulk-'.$action.'-warning', '', true));
        }

        $available_str = get_string('availablex', 'hierarchy', get_string($prefix . 'plural', $prefix));
        $selected_str = get_string('selectedx', 'hierarchy', get_string($prefix . 'plural', $prefix));

        // the main 'bulk actions' form is formatted using HTML, and the renderers
        // overridden to get rid of all of formslib's default formatting
        $mform->addElement('html', "
<table id=\"hierarchy-bulk-actions-form\">
    <tr>
        <th class=\"available-column\">
        $available_str
        </th>
        <th class=\"action-column\">&nbsp;</th>
        <th class=\"selected-column\">
        $selected_str
        </th>
    </tr>
    <tr>
        <td class=\"available-column\">");

        $mform->addElement('text', 'search', '',
            array('placeholder' => get_string('searchavailable', 'hierarchy')));
        $mform->setDefault('search', stripslashes($searchterm));
        $mform->setType('search', PARAM_TEXT);
        $mform->addElement('submit', 'submitsearch', get_string('search'));
        if (strlen(trim($searchterm)) != 0) {
            $mform->addElement('submit', 'clearsearch', get_string('showall'));
        }

        $mform->addElement('html', '
        </td>
        <td class="action-column">&nbsp;</td>
        <td class="selected-column">');

        $remove_attr = array('class' => 'removebutton');
        if ($count_selected_items == 0) {
            $remove_attr['disabled'] = 'disabled';
        }
        $mform->addElement('submit', 'remove_all_items',
            get_string('clearselection', 'hierarchy'), $remove_attr);

        $mform->addElement('html', '</td>
    </tr>');

        $apaging = print_paging_bar($count_available_items, $apage, HIERARCHY_BULK_AVAILABLE_PER_PAGE, $CFG->wwwroot . '/hierarchy/item/bulkactions.php?prefix='.$prefix.'&amp;action='.$action.'&amp;frameworkid='.$frameworkid.'&amp;spage='.$spage.'&amp;', 'apage', false, true, 5);

        $spaging = print_paging_bar($count_selected_items, $spage, HIERARCHY_BULK_SELECTED_PER_PAGE, $CFG->wwwroot . '/hierarchy/item/bulkactions.php?prefix='.$prefix.'&amp;action='.$action.'&amp;frameworkid='.$frameworkid.'&amp;apage='.$apage.'&amp;', 'spage', false, true, 5);

        // only show the paging row if necessary
        if ($apaging != '' || $spaging != '') {

            $mform->addElement('html', "
    <tr>
        <td class=\"available-column\">
        $apaging
        </td>
        <td class=\"action-column\">&nbsp;</td>
        <td class=\"selected-column\">
        $spaging
        </td>
    </tr>");
        }

        $mform->addElement('html', '
    <tr>
        <td class="available-column">');
        // build the select options manually to allow for disabled options
        $select =& $mform->createElement('select', 'available', '', array(),
            array('multiple' => 'multiple', 'size' => 25, 'class' => 'itemslist', 'width' => 200));
        if ($displayed_available_items) {
            foreach ($displayed_available_items as $id => $name) {
                $attr = in_array($id, $all_disabled_item_ids) ?
                    array('disabled' => 'disabled') : array();
                $select->addOption($name, $id, $attr);
            }
        } else {
            $select->addOption(get_string('noxfound', 'hierarchy',
                strtolower(get_string($prefix.'plural', $prefix))), '',
                array('disabled' => 'disabled'));
        }
        $mform->addElement($select);
        $mform->setType('available', PARAM_INT);

        $mform->addElement('html', '
        </td>
        <td class="action-column">');

        $add_attr = array();
        if ($count_selected_items == $count_available_items) {
            $add_attr['disabled'] = 'disabled';
        }
        $mform->addElement('submit', 'add_items', get_string('add') . ' >', $add_attr);

        $mform->addElement('submit', 'remove_items', '< ' . get_string('remove'), $remove_attr);
        $mform->addElement('html', '
        </td>
        <td class="selected-column">');

        $mform->addElement('select', 'selected', '',  $displayed_selected_items,
            array('multiple' => 'multiple', 'size' => 25, 'class' => 'itemslist', 'width' => 200));
        $mform->setType('selected', PARAM_INT);

        $mform->addElement('html', '
        </td>
    </tr>
</table>');

        switch ($action) {
        case 'delete':
            $mform->addElement('submit', 'deletebutton',
                get_string('deleteselectedx', 'hierarchy',
                strtolower(get_string($prefix.'plural', $prefix))));
            break;
        case 'move':
            $movearray = array();

            $options = $hierarchy->get_parent_list($items);
            $movearray[] =& $mform->createElement('select', 'newparent', '',
                $options, totara_select_width_limiter());
            $mform->setType('newparent', PARAM_INT);
            $movearray[] =& $mform->createElement('submit', 'movebutton', get_string('move'));
            $mform->addGroup($movearray, 'movegroup',
                get_string('moveselectedxto', 'hierarchy',
                strtolower(get_string($prefix.'plural', $prefix))), ' ', false);
            break;
        default:
            // this shouldn't happen
            print_error('error:unknownaction', 'hierarchy');
        }

        // change default render template for bulk action form elements
        $elements = array('available', 'add_items', 'add_all_items', 'remove_items',
            'remove_all_items', 'selected', 'search', 'submitsearch', 'clearsearch', 'deletebutton');
        $renderer =& $mform->defaultRenderer();
        $elementtemplate = '{element}';
        foreach ($elements as $element) {
            $renderer->setElementTemplate($elementtemplate, $element);
        }
    }

}
