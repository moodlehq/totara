<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas 
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
 * @author Peter Bulmer <peterb@catalyst.net.nz>
 * @package totara
 * @subpackage plan 
 */

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/dialogs/dialog_content_linked_courses.class.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

require_login();

///
/// Setup / loading data
///

$planid = required_param('planid', PARAM_INT);
$objectiveid = required_param('objectiveid', PARAM_INT);

///
/// Load plan
///
require_capability('local/plan:accessplan', get_system_context());

$plan = new development_plan($planid);
$component = $plan->get_component('objective');
$linkedcourses = $component->get_linked_components($objectiveid, 'course');
$selected = array();
if (!empty($linkedcourses)) {
    $sql = "SELECT ca.id, c.fullname, c.sortorder
            FROM {$CFG->prefix}dp_plan_course_assign ca
            INNER JOIN {$CFG->prefix}course c ON ca.courseid = c.id
            WHERE ca.id IN (".implode(',', $linkedcourses).')
            ORDER BY c.fullname, c.sortorder';
    $courses = get_records_sql($sql);
    if (!empty($courses)) {
        $selected = $courses;
    }
}
// Access control check
if (!$permission = $component->can_update_items()) {
    print_error('error:cannotupdatecourses', 'local_plan');
}


///
/// Setup dialog
///

// Load dialog content generator
$dialog = new totara_dialog_linked_courses_content_courses();

// Set type to multiple
$dialog->type = totara_dialog_content::TYPE_CHOICE_MULTI;
$dialog->selected_title = 'currentlyselected';

// Add data
$dialog->load_courses($planid);

// Set selected items
$dialog->selected_items = $selected;

// Display page
echo $dialog->generate_markup();
