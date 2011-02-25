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
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @package totara
 * @subpackage plan 
 */

/**
 * A page to handle editing an objective in a plan.
 */

require_once('../../../../config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');
require_once($CFG->dirroot . '/local/plan/components/objective/edit_form.php');

require_login();

///
/// Load parameters
///
$planid = required_param('id', PARAM_INT);
$objectiveid = optional_param('itemid', null, PARAM_INT); // Objective id; 0 if creating a new objective
$deleteflag = optional_param('d', false, PARAM_BOOL);
$deleteyes = optional_param('deleteyes', false, PARAM_BOOL);
$deleteno = optional_param('deleteno', null, PARAM_TEXT);
if ( $deleteno == null ){
    $deleteno = false;
} else {
    $deleteno = true;
}

///
/// Load data
///
$plan = new development_plan($planid);
$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$componentname = 'objective';
$component = $plan->get_component($componentname);
if ( $objectiveid == null ){
    $objective = new stdClass();
    $objective->itemid = 0;
    $action = 'add';
} else {
    if (!$objective = get_record('dp_plan_objective', 'id', $objectiveid)){
        error(get_string('error:objectiveidincorrect', 'local_plan'));
    }
    $objective->itemid = $objective->id;
    $objective->id = $objective->planid;
    unset($objective->planid);

    if ( $deleteflag ){
        $action = 'delete';
    } else {
        $action = 'edit';
    }
}

$objallurl = $component->get_url();
if ( $objectiveid ){
    $objviewurl = "{$CFG->wwwroot}/local/plan/components/objective/view.php?id={$planid}&amp;itemid={$objectiveid}";
} else {
    $objviewurl = $objallurl;
}


///
/// Permissions check
///
require_capability('local/plan:accessplan', get_system_context());
if ( !$component->can_update_items() ) {
    print_error('error:cannotupdateobjectives', 'local_plan');
}
if ( $plancompleted ){
    print_error('plancompleted', 'local_plan');
}

$mform = $component->objective_form( $objectiveid );
$mform->set_data($objective);

if ( $deleteyes ){
    require_sesskey();
    if ( !$component->delete_objective($objectiveid) ){
        print_error('error:objectivedeleted', 'local_plan');
    } else {
        totara_set_notification(get_string('objectivedeleted', 'local_plan'), $objallurl, array('style'=>'notifysuccess'));
    }
} elseif ( $deleteno ) {
    redirect($objallurl);

} elseif ( $mform->is_cancelled () ){

    if ( $action == 'add' ){
        redirect($objallurl);
    } else {
        redirect($objviewurl);
    }

} if ( $data = $mform->get_data()) {
    // A New objective
    if (empty($data->itemid)){

        $result = $component->create_objective(
                $data->fullname,
                isset($data->description)?$data->description:null,
                isset($data->priority)?$data->priority:null,
                isset($data->duedate)?$data->duedate:null
        );
        if (!$result){
            print_error('error:objectiveupdated', 'local_plan');
        } else {
            totara_set_notification(get_string('objectivecreated', 'local_plan'), $objviewurl, array('style'=>'notifysuccess'));
        }
    } else {

        $record = new stdClass();
        $record->id = $data->itemid;
        $record->planid = $data->id;
        $record->fullname = $data->fullname;
        $record->description = $data->description;
        $record->priority = isset($data->priority)?$data->priority:null;
        $record->duedate = isset($data->duedate)?$data->duedate:null;
        $record->scalevalueid = $data->scalevalueid;
        $record->approved = $component->approval_status_after_update();

        if (!update_record('dp_plan_objective', $record)) {
            print_error('error:objectiveupdated', 'local_plan');
        } else {
            // Only send notificaitons when plan not draft
            if ($plan->status != DP_PLAN_STATUS_UNAPPROVED) {
                // Check for changes and send alerts accordingly
                $updated = false;
                foreach (array('fullname', 'description', 'priority', 'duedate', 'approved') as $attribute) {
                    if ($record->$attribute != $objective->$attribute) {
                        $updated = $attribute;
                        break;
                    }
                }
                // updated?
                if ($updated) {
                    $component->send_edit_alert($record, $updated);
                }
                // status?
                if ($record->scalevalueid != $objective->scalevalueid) {
                    $component->send_status_alert($record);
                }
            }

            // now - back to the screen notifications ...
            totara_set_notification(get_string('objectiveupdated', 'local_plan'), $objviewurl, array('style'=>'notifysuccess'));
        }

    }
}

///
/// Display page
///
$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan','local_plan').': '.$fullname);
$navlinks = array();
dp_get_plan_base_navlinks($navlinks, $plan->userid);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$planid, 'type'=>'title');
$navlinks[] = array('name' => get_string($component->component, 'local_plan'), 'link' => '', 'type' => 'title');
$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

// Plan menu
echo dp_display_plans_menu($plan->userid,$plan->id,$plan->role);

// Plan page content
print_container_start(false, '', 'dp-plan-content');
print $plan->display_plan_message_box();
print_heading($fullname);
print $plan->display_tabs($componentname);
switch($action){
    case 'add':
        print_heading(get_string('addnewobjective','local_plan'));
        print $component->display_back_to_index_link();
        $mform->display();
        break;
    case 'delete':
        print_heading(get_string('deleteobjective', 'local_plan'));
        print $component->display_back_to_index_link();
        $component->display_objective_detail($objectiveid);
        notice_yesno(
                get_string('deleteobjectiveareyousure', 'local_plan'),
                $CFG->wwwroot.'/local/plan/components/objective/edit.php',
                $CFG->wwwroot.'/local/plan/components/objective/edit.php',
                array('id'=>$planid, 'itemid'=>$objectiveid, 'deleteyes'=>'Yes', 'sesskey'=>sesskey()),
                array('id'=>$planid, 'itemid'=>$objectiveid, 'deleteno'=>'No')
        );
        break;
    case 'edit':
        print_heading(get_string('editobjective', 'local_plan'));
        print $component->display_back_to_index_link();
        $mform->display();
        break;
}

print_container_end();
print_footer();
