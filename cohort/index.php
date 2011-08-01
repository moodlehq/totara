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
require_once('lib.php');

admin_externalpage_setup('cohorts');

$context = get_context_instance(CONTEXT_SYSTEM);
$manager = has_capability('local/cohort:manage', $context);
if (!$manager) {
    require_capability('local/cohort:view', $context);
}

$strcohorts = get_string('cohorts', 'local_cohort');

admin_externalpage_print_header();

print_heading(get_string('cohortsin', 'local_cohort'));

$cohorts = get_records('cohort');

$data = array();
$rowclass = array();
if (!empty($cohorts)) {
    foreach($cohorts as $cohort) {
	$line = array();

	// If this is a dynamic cohort with no criteria set, then add a message to tell the user
	$nameextra = '';
	if ($cohort->cohorttype == cohort::TYPE_DYNAMIC) {
	    $criteria = get_record('cohort_criteria','cohortid',$cohort->id);
	    if (!$criteria || !cohort_criteria_is_valid($criteria)) {
		$nameextra = ' <span class="error">'. get_string('nocriteriaset','local_cohort') .'</span>';
	    }
	}

	$line[] = '<a href="view.php?id='.$cohort->id.'">' .format_string($cohort->name) . '</a>' . $nameextra;
	$line[] = $cohort->idnumber;

	$line[] = count_records('cohort_members', 'cohortid', $cohort->id);

	if ($cohort->cohorttype == cohort::TYPE_DYNAMIC) {
	    $line[] = get_string('dynamic', 'local_cohort');
	} else {
	    $line[] = get_string('set', 'local_cohort');
	}


	$data[] = $line;
    }
}
$table = new stdClass();
$table->head  = array(get_string('name', 'local_cohort'), get_string('idnumber', 'local_cohort'),
                      get_string('memberscount', 'local_cohort'), get_string('type', 'local_cohort'));
$table->size  = array('70%', '10%', '10%', '10%');
$table->align = array('left', 'left', 'left', 'left');
$table->width = '80%';
$table->data  = $data;
$table->rowclass = $rowclass;
print_table($table);

if ($manager) {
    print_single_button($CFG->wwwroot . '/cohort/edit.php', array(), get_string('createnewcohort','local_cohort'));
}

admin_externalpage_print_footer();