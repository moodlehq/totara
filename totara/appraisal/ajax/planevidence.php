<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2013 Totara Learning Solutions LTD
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
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair.munro@totaralms.com>
 * @package totara
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content_plan_evidence.class.php');

$PAGE->set_context(get_system_context());
require_login();

$questionid = required_param('id', PARAM_INT);
$roleassignmentid = required_param('answerid', PARAM_INT);

// Plan id
$planid = optional_param('planid', 0, PARAM_INT);

// Question subject id (userid)
$subjectid = required_param('subjectid', PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);

// should we show hidden frameworks?
$showhidden = optional_param('showhidden', false, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_LOCALURL);
$s = optional_param('s', '', PARAM_TEXT);

// Get list of already selected items
$sql = 'SELECT pe.id, pe.name as fullname
        FROM
          {appraisal_review_data} review_data
        JOIN {dp_plan_evidence} pe
            ON review_data.itemid = pe.id
        JOIN {dp_plan_evidence_relation} per
            ON pe.id = per.evidenceid
        WHERE
            review_data.appraisalquestfieldid = ?
        AND review_data.appraisalroleassignmentid = ?
        AND per.planid = ?';
$alreadyselected = $DB->get_records_sql($sql, array($questionid, $roleassignmentid, $planid));

// Disaply page
if (!$nojs) {
    // Load dialog content generator
    $dialog = new totara_dialog_content_plan_evidence('evidence', $planid, $showhidden, $subjectid);

    $dialog->show_treeview_only = $treeonly;

    $dialog->load_items();

    $dialog->lang_file = 'totara_appraisal';
    $dialog->string_nothingtodisplay = 'error:dialognotreeitemsplanevidence';

    // Set title
    $dialog->selected_title = 'itemstoadd';
    $dialog->disabled_items = $alreadyselected;
    // Addition url parameters
    $dialog->urlparams = array('planid' => $planid);

    echo $dialog->generate_markup();
}
