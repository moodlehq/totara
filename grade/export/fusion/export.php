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

require_once '../../../config.php';
require_once $CFG->dirroot.'/grade/export/lib.php';
require_once 'grade_export_fusion.php';
require_once '../../../local/oauth/fusionlib.php';

$id                = required_param('id', PARAM_INT); // course id
$groupid           = optional_param('groupid', 0, PARAM_INT);
$itemids           = required_param('itemids', PARAM_RAW);
$export_feedback   = optional_param('export_feedback', 0, PARAM_BOOL);
$separator         = optional_param('separator', 'comma', PARAM_ALPHA);
$updatedgradesonly = optional_param('updatedgradesonly', false, PARAM_BOOL);
$displaytype       = optional_param('displaytype', $CFG->grade_export_displaytype, PARAM_INT);
$decimalpoints     = optional_param('decimalpoints', $CFG->grade_export_decimalpoints, PARAM_INT);
$tablename         = required_param('tablename', PARAM_RAW); // proposed table name

if (!$course = get_record('course', 'id', $id)) {
    print_error('nocourseid');
}

require_login($course);
$context = get_context_instance(CONTEXT_COURSE, $id);

require_capability('moodle/grade:export', $context);
require_capability('gradeexport/fusion:view', $context);

if (groups_get_course_groupmode($COURSE) == SEPARATEGROUPS and !has_capability('moodle/site:accessallgroups', $context)) {
    if (!groups_is_member($groupid, $USER->id)) {
        print_error('cannotaccessgroup', 'grades');
    }
}

// check OAuth
$oauth = new local_oauth_fusion();
// parameters to preserve
$preserve = array(
                   'id' => $id,
                   'groupid' => $groupid,
                   'itemids' => $itemids,
                   'export_feedback' => $export_feedback,
                   'separator' => $separator,
                   'updatedgradesonly' => $updatedgradesonly,
                   'displaytype' => $displaytype,
                   'decimalpoints' => $decimalpoints,
                   'tablename' => $tablename,
            );
try {
    if (!$oauth->authenticate($preserve)) {
        print_grade_page_head($COURSE->id, 'export', 'fusion', get_string('exportto', 'grades') . ' ' . get_string('modulename', 'gradeexport_fusion'));
        print_errror(get_string('authfailed', 'local_oauth'));
    }
}
catch (local_oauth_exception $e) {
    // clean it down
    $oauth->wipe_auth();

    // try again
    $oauth = new local_oauth_fusion();
    if (!$oauth->authenticate($preserve)) {
        print_error(get_string('authfailed', 'local_oauth'));
    }
}


// print all the exported data here
$export = new grade_export_fusion($course, $groupid, $itemids, $export_feedback, $updatedgradesonly, $displaytype, $decimalpoints, $separator, $tablename);
$export->set_table($tablename);
$export->export_grades($oauth);


