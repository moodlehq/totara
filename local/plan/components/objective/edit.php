<?php
/**
 * A page to handle editing an objective in a plan.
 *
 * @copyright Totara Learning Solutions Limited
 * @author Aaron G. Wells <aaronw@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage reportbuilder
 */

require_once('../../../../config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');
require_once($CFG->dirroot . '/local/js/lib/setup.php');
require_once($CFG->dirroot . '/local/plan/components/objective/edit_form.php');


///
/// Load parameters
///
$planid = required_param('id', PARAM_INT);
$objectiveid = optional_param('itemid', 0, PARAM_INT); // Objective id; 0 if creating a new objective

///
/// Load data
///
$plan = new development_plan($planid);
$componentname = 'objective';
$component = $plan->get_component($componentname);
if ( $objectiveid == 0 ){
    $objective = new stdClass();
    $objective->itemid = 0;
} else {
    if (!$objective = get_record('dp_plan_objective', 'id', $objectiveid)){
        error(get_string('error:objectiveidincorrect', 'local_plan'));
    }
    $objective->itemid = $objective->id;
    $objective->id = $objective->planid;
    unset($objective->planid);
}

///
/// Permissions check
///
require_capability('local/plan:accessplan', get_system_context());
if ( !$component->can_update_items() ) {
    print_error('error:cannotupdateobjectives', 'local_plan');
}

$mform = new plan_objective_edit_form(
        null,
        array(
            'plan'=>$plan,
            'objective'=>$component,
            'action'=>'edit'
        )
);
$mform->set_data($objective);

//
// If cancelled
//
if ($mform->is_cancelled()){
    redirect("{$CFG->wwwroot}/local/plan/components/objective/index.php?id={$planid}");
} else if ( $data = $mform->get_data()) {
    // A New objective
    if (empty($data->itemid)){

        $result = $component->create_objective(
                $data->fullname,
                isset($data->shortname)?$data->description:null,
                isset($data->description)?$data->description:null,
                isset($data->priority)?$data->priority:null,
                isset($data->duedate)?$data->duedate:null
        );
        if (!$result){
            print_error("Was unable to create new objective");
        } else {
            redirect("{$CFG->wwwroot}/local/plan/components/objective/view.php?id={$planid}&itemid={$result}");
        }
    }
}

///
/// Display page
///
$fullname = $plan->name;
$pagetitle = format_string(get_string('developmentplan','local_plan').': '.$fullname);
$navlinks = array();
$plan->get_plan_base_navlinks($navlinks);
$navlinks[] = array('name' => $fullname, 'link'=> $CFG->wwwroot . '/local/plan/view.php?id='.$planid, 'type'=>'title');
$navlinks[] = array('name' => $component->get_setting('name'), 'link' => '', 'type' => 'title');
$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, '');

// Plan menu
echo dp_display_plans_menu($plan->userid);

// Plan page content
print_container_start(false, '', 'dp-plan-content');

print $plan->display_plan_message_box();

print_heading($fullname);
print $plan->display_tabs($componentname);

print_heading(get_string('addnewobjective','local_plan'));

$mform->display();

print_container_end();
print_footer();
