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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once('../../../../config.php');
require_once($CFG->dirroot.'/local/plan/lib.php');

require_login();

///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);

// Updated course lists
$idlist = optional_param('update', null, PARAM_SEQUENCE);
if ($idlist == null) {
    $idlist = array();
}
else {
    $idlist = explode(',', $idlist);
}

$plan = new development_plan($id);
$componentname = 'competency';
$component = $plan->get_component($componentname);

// Basic access control checks
if (!$component->can_update_items()) {
    print_error('error:cannotupdateitems', 'local_plan');
}

// get array of competencies already assigned
$assigned = $component->get_assigned_items();
$assigned_ids = array();
foreach($assigned as $item) {
    $assigned_ids[] = $item->competencyid;
}

// see what's changed
$comps_added = array_diff($idlist, $assigned_ids);
$comps_removed = array_diff($assigned_ids, $idlist);

// get linked courses for newly added competencies
$evidence = $component->get_course_evidence_items($comps_added);

// if no linked courses in new competencies, skip this page and
// move directly on to handling them
if (count($evidence) == 0) {
    print 'NOCOURSES:'.implode(',', $idlist);
    die;
}

// get names of competencies with linked courses
$compnames = get_records_select_menu('comp', 'id IN (' . implode(',', $idlist) . ')', 'id', 'id,fullname');

// display a form to allow the user to select required linked courses
print '<h2>' . get_string('confirmlinkedcourses', 'local_plan') . '</h2>';
print '<p>' . get_string('confirmlinkedcoursesdesc', 'local_plan') . '</p>';
print '<form>';
print '<input type="hidden" name="id" value="' . $id . '" />';
print '<input type="hidden" name="update" value="' . implode(',', $idlist) . '" />';

foreach ($evidence as $compid => $linkedcourses) {
    print get_string('competency', 'competency') . ' '. format_string($compnames[$compid]) . '":<br />';

    foreach ($linkedcourses as $linkedcourse) {
        if ($plan->get_component('course')->is_item_assigned($linkedcourse->courseid)) {
            $message = ' ('.get_string('alreadyassignedtoplan', 'local_plan').')';
        } else {
            $message = '';
        }

        if ($linkedcourse->linktype == PLAN_LINKTYPE_MANDATORY) {
            print '<input type="checkbox" checked="checked" disabled="disabled" value="1"> ';
            print '<input type="hidden" name="linkedcourses['.$compid.']['.$linkedcourse->courseid.']" value="1" />';
            print '<input type="hidden" name="mandatory['.$compid.']['.$linkedcourse->courseid.']" value="1" />';
            print format_string($linkedcourse->fullname) . $message .'<br />';
        } else {
            print '<input type="checkbox" checked="checked" name="linkedcourses[' . $compid . '][' . $linkedcourse->courseid . ']" value="1"> ';
            print format_string($linkedcourse->fullname) . $message . '<br />';
        }
    }
}
print '</form>';
