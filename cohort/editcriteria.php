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

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/cohort/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once($CFG->dirroot.'/hierarchy/prefix/position/lib.php');
require_once($CFG->dirroot.'/cohort/editcriteria_form.php');

$id        = required_param('id', PARAM_INT);
$cohort = get_record('cohort','id',$id);
$context = get_context_instance(CONTEXT_SYSTEM);

admin_externalpage_setup('cohorts');

require_capability('local/cohort:manage', $context);

if (!$cohort) {
    error("Cohort with id $id does not exist");
}
if ($cohort->cohorttype == cohort::TYPE_STATIC) {
    error("Cannot set criteria for static cohorts");
}
if (cohort_criteria_already_set($cohort->id)) {
    error("Dynamic cohort '{$cohort->name}' already has criteria applied");
}

// Setup custom javascript
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW,
    TOTARA_JS_DATEPICKER
));

require_js(
    array(
        $CFG->wwwroot.'/local/js/cohort.js.php',
    )
);

$returnurl = new moodle_url($CFG->wwwroot .'/cohort/index.php');

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

    try {
        cohort_add_dynamic_cohort($criteria);
        totara_set_notification(get_string('successfullyaddedcohort','local_cohort'), $returnurl->out() , array('style' => 'notifysuccess'));
    }
    catch ( Exception $e ){
        totara_set_notification($e->getMessage(), $returnurl->out());
    }
}

admin_externalpage_print_header();

$strheading = get_string('dynamiccohortcriteria', 'local_cohort');

print_heading($strheading);

$editcriteriaform->display();

admin_externalpage_print_footer();
