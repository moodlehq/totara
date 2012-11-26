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
 * @package totara
 * @subpackage plan
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot . '/totara/plan/lib.php');
require_once($CFG->dirroot . '/totara/core/js/lib/setup.php');

require_login();

$id = required_param('id', PARAM_INT); // plan id
$caid = required_param('itemid', PARAM_INT); // competency assignment id
$action = optional_param('action', 'view', PARAM_TEXT);

$plan = new development_plan($id);

//Permissions check
$systemcontext = context_system::instance();
if (!has_capability('totara/plan:accessanyplan', $systemcontext) && ($plan->get_setting('view') < DP_PERMISSION_ALLOW)) {
        print_error('error:nopermissions', 'totara_plan');
}

// Check the item is in this plan
if (!$DB->record_exists('dp_plan_competency_assign', array('planid' => $plan->id, 'id' => $caid))) {
    print_error('error:itemnotinplan', 'totara_plan');
}

$PAGE->set_context($systemcontext);
$PAGE->set_url('/totara/plan/components/competency/view.php', array('id' => $id, 'itemid' => $caid));
$PAGE->set_pagelayout('noblocks');
$PAGE->set_totara_menu_selected('learningplans');

$plancompleted = $plan->status == DP_PLAN_STATUS_COMPLETE;
$componentname = 'competency';
$component = $plan->get_component($componentname);
$currenturl = new moodle_url('/totara/plan/components/competency/view.php', array('id' => $id, 'itemid' => $caid));
$coursesenabled = $plan->get_component('course')->get_setting('enabled');
$coursename = get_string('courseplural', 'totara_plan');
$canupdate = $component->can_update_items();

/// Javascript stuff
// If we are showing dialog
if ($canupdate) {
    // Setup lightbox
    local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW
    ));

    $PAGE->requires->string_for_js('save', 'totara_core');
    $PAGE->requires->string_for_js('cancel', 'moodle');
    $PAGE->requires->string_for_js('addlinkedcourses', 'totara_plan');

    // Get course picker
    $jsmodule = array(
        'name' => 'totara_plan_competency_find_course',
        'fullpath' => '/totara/plan/components/competency/find-course.js',
        'requires' => array('json'));
    $PAGE->requires->js_init_call('M.totara_plan_competency_find_course.init', array('args' => '{"plan_id":'.$id.', "competency_id":'.$caid.'}'), false, $jsmodule);
}

// Check if we are performing an action
if ($data = data_submitted() && $canupdate) {
    if ($action === 'removelinkedcourses' && !$plan->is_complete()) {
      $deletions = array();

        // Load existing list of linked courses
        $fullidlist = $component->get_linked_components($caid, 'course');

        // Grab all linked items for deletion
        $course_assigns = optional_param_array('delete_linked_course_assign', array(), PARAM_BOOL);
        if ($course_assigns) {
            foreach ($course_assigns as $linkedid => $delete) {
                if (!$delete) {
                    continue;
                }

                $deletions[] = $linkedid;
            }

            if ($fullidlist && $deletions) {
                $newidlist = array_diff($fullidlist, $deletions);
                $component->update_linked_components($caid, 'course', $newidlist);
            }
        }

        if ($deletions) {
            totara_set_notification(get_string('selectedlinkedcoursesremovedfromcompetency', 'totara_plan'), $currenturl, array('class' => 'notifysuccess'));
        } else {
            redirect($currenturl);
        }
        die();
    }
}

$fullname = $plan->name;
$pagetitle = format_string(get_string('learningplan', 'totara_plan').': '.$fullname);
$PAGE->set_title($pagetitle);
$PAGE->set_heading($pagetitle);
dp_get_plan_base_navlinks($plan->userid);
$PAGE->navbar->add($fullname, new moodle_url('/totara/plan/view.php', array('id' => $id)));
$PAGE->navbar->add(get_string($component->component, 'totara_plan'), new moodle_url($component->get_url()));
$PAGE->navbar->add(get_string('viewitem', 'totara_plan'));
$plan->print_header($componentname);

echo $component->display_back_to_index_link();

echo $component->display_competency_detail($caid);

if ($coursesenabled) {
    echo html_writer::empty_tag('br');
    echo $OUTPUT->heading(get_string('linkedx', 'totara_plan', $coursename), 3);
    echo $OUTPUT->container_start('', "dp-competency-courses-container");

    if ($linkedcourses = $component->get_linked_components($caid, 'course')) {
        $currenturl->param('action', 'removelinkedcourses');
        echo html_writer::start_tag('form', array('id' => "dp-component-update",  'action' => $currenturl->out(false), "method" => "POST"));
        echo $plan->get_component('course')->display_linked_courses($linkedcourses);
        if ($canupdate) {
            echo html_writer::empty_tag('input', array('type' => 'submit', 'value' => get_string('removeselected', 'totara_plan'), 'class' => 'plan-remove-selected'));
        }
        echo html_writer::end_tag('form');
    } else {
        echo html_writer::tag('p', get_string('nolinkedx', 'totara_plan', strtolower($coursename)), array('class' => 'noitems-assigncourses'));
    }
    echo $OUTPUT->container_end();

    if (!$plancompleted) {
        echo $component->display_course_picker($caid);
    }
}

// Comments
require_once($CFG->dirroot.'/comment/lib.php');
comment::init();
$options = new stdClass;
$options->area    = 'plan_competency_item';
$options->context = $systemcontext;
$options->itemid  = $caid;
$options->showcount = true;
$options->component = 'totara_plan';
$options->autostart = true;
$options->notoggle = true;
$comment = new comment($options);
echo $comment->output(true);

echo $OUTPUT->container_end();

echo $OUTPUT->footer();


?>
