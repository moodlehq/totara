<?php // $Id$
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * 
 * This program is free software; you can redistribute it and/or modify  
 * it under the terms of the GNU General Public License as published by  
 * the Free Software Foundation; either version 2 of the License, or     
 * (at your option) any later version.                                   
 *                                                                       
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage dialogs 
 */

/**
 * Page containing hierarchy item search form template
 */

defined('MOODLE_INTERNAL') || die();

class dialog_search_form extends moodleform {

    // Define the form
    function definition() {
        global $CFG;

        $mform =& $this->_form;

        // Hack to get around form namespacing
        static $formcounter = 1;
        $mform->updateAttributes(array('id' => 'mform_dialog_'.$formcounter));
        $formcounter++;

        // Search data
        $query = stripslashes($this->_customdata['query']);

        // Check if we are searching a hierarchy
        $hierarchy = false;
        if (!empty($this->_customdata['shortprefix'])) {
            $hierarchy = true;
            $frameworkid = $this->_customdata['frameworkid'];
            $shortprefix = $this->_customdata['shortprefix'];
            $showpicker = $this->_customdata['hidden']['select'];
        }

        // Pad search string to make it look nicer
        $strsearch = '    '.get_string('search').'    ';

        // Generic hidden values
        $mform->addElement('hidden', 'dialog_form_target', '#search-tab');
        $mform->addElement('hidden', 'search', 1);

        // Custom hidden values
        if (!empty($this->_customdata['hidden'])) {
            foreach ($this->_customdata['hidden'] as $key => $value) {
                $mform->addElement('hidden', $key);
                $mform->setDefault($key, $value);
            }
        }

        // If framework selector not shown, pass value as hidden field
        if ($hierarchy && !$showpicker) {
            $mform->addElement('hidden', 'frameworkid');
            $mform->setDefault('frameworkid', $frameworkid);
        }

        // Create actual form elements
        $searcharray = array();
        $searcharray[] =& $mform->createElement('static', 'tablestart', '', '<table id="dialog-search-table"><tbody><tr><td class="querybox">');

        // Query box
        $searcharray[] =& $mform->createElement('text', 'query', '',
            'maxlength="254"');
        $mform->setType('query', PARAM_TEXT);
        $mform->setDefault('query', $query);

        $searcharray[] =& $mform->createElement('static', 'tabledivider1', '', '</td><td>');

        // Show framework selector
        if ($hierarchy && $showpicker) {

            $options = array(0 => get_string('allframeworks', 'hierarchy')) +
                get_records_select_menu($shortprefix . '_framework', '', 'sortorder, fullname', 'id, fullname');

            $attr = array(
                'class' => 'totara-limited-width-150',
                'onMouseDown'=>"if(document.all) this.className='totara-expanded-width';",
                'onBlur'=>"if(document.all) this.className='totara-limited-width-150';",
                'onChange'=>"if(document.all) this.className='totara-limited-width-150';"
            );

            $searcharray[] =& $mform->createElement('select', 'frameworkid', '', $options, $attr);
            $mform->setDefault('frameworkid', $frameworkid);
            $searcharray[] =& $mform->createElement('static', 'tabledivider2', '', '</td><td>');
        }

        // Show search button
        $searcharray[] =& $mform->createElement('submit', 'submitbutton', $strsearch);
        $searcharray[] =& $mform->createElement('static', 'tableend', '', '</td></tr></tbody></table>');
        $mform->addGroup($searcharray, 'searchgroup', '', array(' '), false);

    }
}

