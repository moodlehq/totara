<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Cohort related management functions, this file needs to be included manually.
 *
 * @package    core
 * @subpackage cohort
 * @copyright  2010 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/cohort/lib.php');
require_once($CFG->dirroot.'/cohort/edit_form.php');

$id        = optional_param('id', 0, PARAM_INT);

admin_externalpage_setup('cohorts');

$context = get_context_instance(CONTEXT_SYSTEM);
if ($id) {
    $cohort = get_record('cohort','id',$id);
} else {
    $cohort = new stdClass();
    $cohort->id          = 0;
    $cohort->contextid   = $context->id;
    $cohort->name        = '';
    $cohort->description = '';
    $cohort->cohorttype	 = 1;
}

require_capability('local/cohort:manage', $context);

$returnurl = new moodle_url($CFG->wwwroot .'/cohort/index.php');


if (!empty($cohort->component)) {
    // we can not manually edit cohorts that were created by external systems, sorry
    redirect($returnurl);
}


if ($cohort->id) {
    // edit existing
    $strheading = get_string('editcohort', 'local_cohort');
} else {
    // add new
    $strheading = get_string('addcohort', 'local_cohort');
}



$editform = new cohort_edit_form(null, array('data'=>$cohort));

if ($editform->is_cancelled()) {
    redirect($returnurl->out());

} else if ($data = $editform->get_data()) {
    if ($data->id) {
        cohort_update_cohort($data);

        // Updated
        $url = new moodle_url($CFG->wwwroot .'/cohort/view.php', array('id'=>$data->id));
        totara_set_notification(get_string('successfullyupdated','local_cohort'), $url->out(), array('style'=>'notifysuccess'));

    } else {
        $cohortid = cohort_add_cohort($data);
        if ($data->cohorttype == cohort::TYPE_STATIC) {
            $url = new moodle_url($CFG->wwwroot .'/cohort/assign.php', array('id'=>$cohortid));
            redirect($url->out());
        }
        else {
            $url = new moodle_url($CFG->wwwroot .'/cohort/editcriteria.php', array('id'=>$cohortid));
            redirect($url->out());
        }
    }
}



admin_externalpage_print_header();


if ($cohort->id != false) {
    print_heading(format_string($cohort->name));
    $currenttab = 'edit';
    require_once('tabs.php');
}
else {
    print_heading($strheading);
}

$editform->display();

admin_externalpage_print_footer();
