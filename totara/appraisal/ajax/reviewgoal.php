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

const GOAL_PERSONAL = 1;
const GOAL_COMPANY = 2;

$sytemcontext = context_system::instance();
$PAGE->set_context($sytemcontext);

$id = required_param('id', PARAM_INT);
$roleassignmentid = required_param('answerid', PARAM_INT);
$formprefix = required_param('formprefix', PARAM_ALPHANUMEXT);
// We have to use raw here to preserve the p in front of personal goal ids
$goalitems = optional_param('update', null, PARAM_RAW);
$subjectid = optional_param('subjectid', 0, PARAM_INT);

$goals = explode(',', $goalitems);
$personal_idlist = array();
$company_idlist = array();
foreach ($goals as $goalid) {
    if (strpos($goalid, 'p') !== false) {
        $personal_idlist[] = ltrim($goalid, 'p');
    } else {
        $company_idlist[] = $goalid;
    }
}

$renderer = $PAGE->get_renderer('totara_appraisal');

if (!empty($personal_idlist)) {
    list($personal_itemssql, $personal_params) = $DB->get_in_or_equal($personal_idlist);
    $new_personal_items = $DB->get_records_select('goal_personal', 'id ' . $personal_itemssql, $personal_params);
} else {
    $new_personal_items = array();
}

if (!empty($company_idlist)) {
    list($company_itemssql, $company_params) = $DB->get_in_or_equal($company_idlist);
    $new_company_items = $DB->get_records_select('goal', 'id ' . $company_itemssql, $company_params);
} else {
    $new_company_items = array();
}

// Add records to table for new items

foreach ($new_company_items as $item) {
    $review_qstn_todb = new stdClass();
    $review_qstn_todb->appraisalquestfieldid = $id;
    $review_qstn_todb->appraisalroleassignmentid = $roleassignmentid;
    $review_qstn_todb->scope = GOAL_COMPANY;
    $review_qstn_todb->itemid = $item->id;

    $DB->insert_record('appraisal_review_data', $review_qstn_todb);
}

foreach ($new_personal_items as $item) {
    $review_qstn_todb = new stdClass();
    $review_qstn_todb->appraisalquestfieldid = $id;
    $review_qstn_todb->appraisalroleassignmentid = $roleassignmentid;
    $review_qstn_todb->scope = GOAL_PERSONAL;
    $review_qstn_todb->itemid = $item->id;

    $DB->insert_record('appraisal_review_data', $review_qstn_todb);
}

// Get full list of company goals
$sql = 'SELECT questdata.*, g.fullname FROM {appraisal_review_data} questdata
    JOIN {goal} g ON
    questdata.itemid = g.id
    WHERE
    questdata.appraisalquestfieldid = ?
    AND
    questdata.appraisalroleassignmentid = ?
    AND
    questdata.scope = ?';
$company_items = $DB->get_records_sql($sql, array($id, $roleassignmentid, GOAL_COMPANY));


$sql = 'SELECT questdata.*, pg.name as fullname FROM {appraisal_review_data} questdata
    JOIN {goal_personal} pg ON
    questdata.itemid = pg.id
    WHERE
    questdata.appraisalquestfieldid = ?
    AND
    questdata.appraisalroleassignmentid = ?
    AND
    questdata.scope = ?';
$personal_items = $DB->get_records_sql($sql, array($id, $roleassignmentid, GOAL_PERSONAL));

$items = array_merge($company_items, $personal_items);

echo $renderer->display_review_items($items, $formprefix);
