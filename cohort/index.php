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
require($CFG->dirroot.'/cohort/lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');

$contextid = optional_param('contextid', 0, PARAM_INT);
$page = optional_param('page', 0, PARAM_INT);
$searchquery  = optional_param('search', '', PARAM_RAW);
$format = optional_param('format', '', PARAM_TEXT); //export format
$debug = optional_param('debug', false, PARAM_BOOL); //report debug

require_login();

if ($contextid) {
    $context = get_context_instance_by_id($contextid, MUST_EXIST);
} else {
    $context = get_context_instance(CONTEXT_SYSTEM);
}

if ($context->contextlevel != CONTEXT_COURSECAT and $context->contextlevel != CONTEXT_SYSTEM) {
    print_error('invalidcontext');
}

$category = null;
if ($context->contextlevel == CONTEXT_COURSECAT) {
    $category = $DB->get_record('course_categories', array('id'=>$context->instanceid), '*', MUST_EXIST);
}

$manager = has_capability('moodle/cohort:manage', $context);
$canassign = has_capability('moodle/cohort:assign', $context);
if (!$manager) {
    require_capability('moodle/cohort:view', $context);
}

$strcohorts = get_string('cohorts', 'cohort');

if ($category) {
    $PAGE->set_pagelayout('report');
    $PAGE->set_context($context);
    $PAGE->set_url('/cohort/index.php', array('contextid'=>$context->id));
    $PAGE->set_title($strcohorts);
    $PAGE->set_heading($COURSE->fullname);
} else {
    admin_externalpage_setup('cohorts', '', null, '', array('pagelayout'=>'report'));
}
$report = reportbuilder_get_embedded_report('cohort_admin');
if(!empty($format)) {
    $report->export_data($format);
    die;
}
echo $OUTPUT->header();
if($debug) {
    $report->debug($debug);
}

echo $OUTPUT->heading(get_string('cohortsin', 'cohort', print_context_name($context)));

$report->display_search();


$report->display_table();

$output = $PAGE->get_renderer('totara_reportbuilder');
$output->export_select($report->_id);
if ($manager) {
    echo $OUTPUT->single_button(new moodle_url('/cohort/edit.php', array('contextid'=>$context->id)), get_string('add'));
}

echo $OUTPUT->footer();
