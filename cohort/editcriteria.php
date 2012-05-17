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
 * @author Jake Salmon <jake.salmon@kineo.com>
 * @package totara
 * @subpackage cohort
 */

require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/cohort/lib.php');
require_once($CFG->dirroot.'/totara/core/js/lib/setup.php');
require_once($CFG->dirroot.'/totara/hierarchy/prefix/position/lib.php');
require_once($CFG->dirroot.'/cohort/editcriteria_form.php');

$id      = required_param('id', PARAM_INT);
$cohort  = $DB->get_record('cohort',array('id' => $id));
$context = context_system::instance();

admin_externalpage_setup('cohorts');

require_capability('moodle/cohort:manage', $context);

if (!$cohort) {
    print_error('error:cohordoesnotexist', 'cohort', '', $id);
}
if ($cohort->cohorttype == cohort::TYPE_STATIC) {
    print_error('error:staticcannotsetcriteria', 'cohort');
}
if (cohort_criteria_already_set($cohort->id)) {
    print_error('error:dynamiccritalreadyapplied', 'cohort', '', $cohort->name);
}

// Setup custom javascript
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW
));

$PAGE->requires->strings_for_js(array('cancel','continue'), 'moodle');
$PAGE->requires->strings_for_js(array('chooseposition','chooseorganisation'), 'totara_hierarchy');
$PAGE->requires->string_for_js('confirmdynamiccohortcreation', 'totara_cohort');
$display_selected_position = json_encode(dialog_display_currently_selected(get_string('selected', 'totara_hierarchy'), 'position'));
$display_selected_organisation = json_encode(dialog_display_currently_selected(get_string('currentlyselected', 'totara_core'), 'organisation'));
$args = array('args'=>'{"display_selected_position":'.$display_selected_position.',"display_selected_organisation":'.$display_selected_organisation.'}');
$jsmodule = array(
        'name' => 'totara_cohort',
        'fullpath' => '/totara/core/js/cohort.js',
        'requires' => array('json'));
$PAGE->requires->js_init_call('M.totara_cohort.init', $args, false, $jsmodule);

$returnurl = new moodle_url('/cohort/index.php');

$editcriteriaform = new cohort_editcriteria_form(null, array('data'=>$cohort));

if ($data = $editcriteriaform->get_data()) {

    $criteria = new stdClass();
    $criteria->cohortid = $cohort->id;
    $criteria->profilefield = $data->profilefield;
    $criteria->profilefieldvalues = $data->profilefieldvalues;
    $criteria->positionid = $data->positionid;
    $criteria->positionincludechildren = isset($data->positionincludechildren) ? $data->positionincludechildren : 0;
    $criteria->organisationid = $data->organisationid;
    $criteria->orgincludechildren = isset($data->orgincludechildren) ? $data->orgincludechildren : 0;

    cohort_add_dynamic_cohort($criteria);
    totara_set_notification(get_string('successfullyaddedcohort','totara_cohort'), $returnurl, array('class' => 'notifysuccess'));
}

echo $OUTPUT->header();

$strheading = get_string('dynamiccohortcriteria', 'totara_cohort');

echo $OUTPUT->heading($strheading);

$editcriteriaform->display();

echo $OUTPUT->footer();
