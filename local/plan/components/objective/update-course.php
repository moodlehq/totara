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
 * @author Aaron Barnes <aaronb@catalyst.net.nz>
 * @package totara
 * @subpackage plan 
 */

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

require_login();

///
/// Setup / loading data
///

// Plan id
$planid = required_param('planid', PARAM_INT);
$objectiveid = required_param('objectiveid', PARAM_INT);

// Updated course lists
$idlist = optional_param('update', null, PARAM_SEQUENCE);
if ($idlist == null) {
    $idlist = array();
}
else {
    $idlist = explode(',', $idlist);
}

require_capability('local/plan:accessplan', get_system_context());
$plan = new development_plan($planid);
$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$component = $plan->get_component('objective');

if ( !$component->can_update_items() ) {
    print_error('error:cannotupdateobjectives', 'local_plan');
}
if ( $plancompleted ){
    print_error('plancompleted', 'local_plan');
}

$component->update_linked_components($objectiveid, 'course', $idlist);
if($linkedcourses =
    $component->get_linked_components($objectiveid, 'course')) {
    echo $plan->get_component('course')->display_linked_courses($linkedcourses);
} else {
    $coursename = get_string('courseplural', 'local_plan');
    echo '<p class="noitems-assigncourse">' . get_string('nolinkedx', 'local_plan', $coursename). '</p>';
}
