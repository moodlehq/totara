<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Aaron Wells <aaronw@catalyst.net.nz>
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/totara/plan/lib.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');

require_login();

$id = required_param('id', PARAM_INT); // plan id
$progassid = required_param('itemid', PARAM_INT); // program assignment id

$plan = new development_plan($id);

//Permissions check
$systemcontext = context_system::instance();
if (!has_capability('totara/plan:accessanyplan', $systemcontext) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
        print_error('error:nopermissions', 'totara_plan');
}

// Check the item is in this plan
if (!$DB->record_exists('dp_plan_program_assign', array('planid' => $plan->id, 'id' => $progassid))) {
    print_error('error:itemnotinplan', 'totara_plan');
}

$PAGE->set_context($systemcontext);
$PAGE->set_url('/totara/plan/components/program/view.php', array('id' => $id, 'itemid' => $progassid));
$PAGE->set_pagelayout('noblocks');
$PAGE->set_totara_menu_selected('learningplans');

//Javascript include
local_js(array(
    TOTARA_JS_DIALOG,
));

// Get extension dialog content
if ($programid = $DB->get_field('dp_plan_program_assign', 'programid', array('id' => $progassid))) {
    $PAGE->requires->strings_for_js(array('pleaseentervaliddate', 'pleaseentervalidreason', 'extensionrequest', 'cancel', 'ok'), 'totara_program');
    $notify_html = trim($OUTPUT->notification(get_string("extensionrequestsent", "totara_program"), "notifysuccess"));
    $notify_html_fail = trim($OUTPUT->notification(get_string("extensionrequestnotsent", "totara_program"), null));
    $args = array('args'=>'{"id":'.$programid.', "userid":'.$USER->id.', "user_fullname":'.json_encode(fullname($USER)).', "notify_html_fail":"'.$notify_html_fail.'", "notify_html":"'.$notify_html.'"}');
    $jsmodule = array(
                 'name' => 'totara_programview',
                 'fullpath' => '/totara/program/view/program_view.js',
                 'requires' => array('json')
              );
    $PAGE->requires->js_init_call('M.totara_programview.init',$args, false, $jsmodule);
}

$componentname = 'program';
$component = $plan->get_component($componentname);

$currenturl = new moodle_url('/totara/plan/components/program/view.php', array('id' => $id, 'itemid' => $progassid));

$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan', 'totara_plan').': '.$fullname);

dp_get_plan_base_navlinks($plan->userid);
$PAGE->navbar->add($fullname, new moodle_url('/totara/plan/view.php', array('id' => $plan->id)));
$PAGE->navbar->add(get_string('viewitem', 'totara_plan'));


$plan->print_header($componentname);

print $component->display_back_to_index_link();

print $component->display_program_detail($progassid);


// Comments
require_once($CFG->dirroot.'/comment/lib.php');
comment::init();
$options = new stdClass;
$options->area    = 'plan_program_item';
$options->context = $systemcontext;
$options->itemid  = $progassid;
$options->showcount = true;
$options->component = 'totara_plan';
$options->autostart = true;
$options->notoggle = true;
$comment = new comment($options);
echo $comment->output(true);

echo $OUTPUT->container_end();

echo $OUTPUT->footer();


?>
