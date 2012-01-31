<?php
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
 * @author Piers Harding <piers@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

/**
 * Formslib template for generating an export report form
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

require_once "$CFG->dirroot/lib/formslib.php";

class report_builder_export_form extends moodleform {

    /**
     * Definition of the export report form
     */
    function definition() {
        global $REPORT_BUILDER_EXPORT_OPTIONS;
        $mform =& $this->_form;

        $exportoptions = get_config('reportbuilder', 'exportoptions');
        $select = array();
        $oauthenabled = get_config('local_oauth', 'oauthenabled');
        $sitecontext = get_context_instance(CONTEXT_SYSTEM);
        $oauthcap = has_capability('local/oauth:negotiate', $sitecontext);
        foreach($REPORT_BUILDER_EXPORT_OPTIONS as $option => $code) {
            // specific checks for fusion tables export
            if ($option == 'fusion' && (!$oauthenabled || !$oauthcap)) {
                continue;
            }
            // bitwise operator to see if option bit is set
            if(($exportoptions & $code) == $code) {
                $select[$option] = get_string('export'.$option,'local_reportbuilder');
            }
        }
        if(count($select) == 0) {
            // no export options - don't show form
            return false;
        } else if (count($select) == 1) {
            // no options - show a button
            $mform->addElement('hidden', 'format', key($select));
            $mform->addElement('submit', 'export', current($select));
        } else {
            // show pulldown menu
            $group=array();
            $group[] =& $mform->createElement('select','format', null, $select);
            $group[] =& $mform->createElement('submit', 'export', get_string('export','local_reportbuilder'));
            $mform->addGroup($group, 'exportgroup', '', array(' '), false);
        }

    }

}


