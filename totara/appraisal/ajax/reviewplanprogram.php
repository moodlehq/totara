<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 * @subpackage totara_core
 */

define('AJAX_SCRIPT', true);
require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once(dirname(dirname(__FILE__)) . '/lib.php');

$sytemcontext = context_system::instance();
$PAGE->set_context($sytemcontext);

$id = required_param('id', PARAM_INT);
$roleassignmentid = required_param('answerid', PARAM_INT);
$formprefix = required_param('formprefix', PARAM_ALPHANUMEXT);
$subjectid = optional_param('subjectid', 0, PARAM_INT);

$planitems = optional_param('update', null, PARAM_SEQUENCE);
if (!$planitems) {
    $idlist = array();
} else {
    $idlist = explode(',', $planitems);
}

$renderer = $PAGE->get_renderer('totara_appraisal');

list($itemssql, $params) = $DB->get_in_or_equal($idlist);

// Add records to table for new items
$new_items = $DB->get_records_select('dp_plan_program_assign', 'id ' . $itemssql, $params);

$question = new appraisal_question($id);
$page = new appraisal_page($question->appraisalstagepageid);
$stage = new appraisal_stage($page->appraisalstageid);
$appraisal = new appraisal($stage->appraisalid);
$roles = $question->get_roles_involved(appraisal::ACCESS_CANANSWER);

$sql = 'SELECT ara.id, appraisalrole FROM {appraisal_role_assignment} ara JOIN
            {appraisal_user_assignment} aua ON ara.appraisaluserassignmentid = aua.id
            WHERE aua.appraisalid = ?
            AND aua.userid = ?';
$role_assignment_ids = $DB->get_records_sql($sql, array($appraisal->id, $subjectid));

foreach ($new_items as $item) {
    foreach ($role_assignment_ids as $assignmentid => $roletype) {
        $review_qstn_todb = new stdClass();
        $review_qstn_todb->appraisalquestfieldid = $id;
        $review_qstn_todb->appraisalroleassignmentid = $assignmentid;
        $review_qstn_todb->itemid = $item->id;

        $DB->insert_record('appraisal_review_data', $review_qstn_todb);
    }
}

// Get full list of review items
$sql = 'SELECT questdata.*, p.fullname FROM {appraisal_review_data} questdata
    JOIN {dp_plan_program_assign} ppa ON
    questdata.itemid = ppa.id
    JOIN {prog} p ON
    p.id = ppa.programid
    WHERE
    questdata.appraisalquestfieldid = ?
    AND
    questdata.appraisalroleassignmentid = ?';
$items = $DB->get_records_sql($sql, array($id, $roleassignmentid));

echo $renderer->display_review_items($items, $formprefix);
