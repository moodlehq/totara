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
require_once($CFG->dirroot.'/local/reportbuilder/lib.php');

$id        = optional_param('id', null, PARAM_INT);

admin_externalpage_setup('cohorts');

$context = get_context_instance(CONTEXT_SYSTEM);
require_capability('local/cohort:manage', $context);

if (isset($id)) {
    $cohort = get_record('cohort','id',$id);
    if (!$cohort) {
        error('Cohort with this id does not exist');
    }
}

$report = reportbuilder_get_embedded_report('cohort_members',array('cohortid' => $id));

$strheading = get_string('editcohort', 'local_cohort');

admin_externalpage_print_header();

if (isset($id)) {
    print_heading(format_string($cohort->name));

    $currenttab = 'viewmembers';
    require_once('tabs.php');
}

$report->display_search();

$report->display_table();

admin_externalpage_print_footer();
