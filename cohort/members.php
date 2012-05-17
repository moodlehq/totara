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

/*
SCANMSG re-add once reportbuilder merged
require_once($CFG->dirroot.'/totara/reportbuilder/lib.php');
*/
$id = optional_param('id', null, PARAM_INT);

admin_externalpage_setup('cohorts');

$context = context_system::instance();
require_capability('moodle/cohort:manage', $context);

if (isset($id)) {
    $cohort = $DB->get_record('cohort',array('id' => $id));
    if (!$cohort) {
        print_error('error:doesnotexist', 'cohort');
    }
}
/*
SCANMSG re-add once reportbuilder merged
$report = reportbuilder_get_embedded_report('cohort_members', array('cohortid' => $id));
*/
$strheading = get_string('editcohort', 'totara_cohort');

echo $OUTPUT->header();

if (isset($id)) {
    echo $OUTPUT->heading(format_string($cohort->name));
    $currenttab = 'viewmembers';
    require_once('tabs.php');
}

/*
SCANMSG re-add once reportbuilder merged
$report->display_search();

$report->display_table();
*/
echo $OUTPUT->footer();
