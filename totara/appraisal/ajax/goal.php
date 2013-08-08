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
require_once($CFG->dirroot.'/totara/core/dialogs/dialog_content_goals.class.php');

$PAGE->set_context(get_system_context());
require_login();

$questionid = required_param('id', PARAM_INT);
$roleassignmentid = required_param('answerid', PARAM_INT);

$frameworkid = optional_param('frameworkid', -1, PARAM_INT);

// Only return generated tree html
$treeonly = optional_param('treeonly', false, PARAM_BOOL);

// should we show hidden frameworks?
$showhidden = optional_param('showhidden', false, PARAM_BOOL);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_LOCALURL);
$s = optional_param('s', '', PARAM_TEXT);

// Get list of already selected items
$sql = 'SELECT g.id, g.fullname
        FROM
          {appraisal_review_data} review_data
        JOIN {goal} g
          ON review_data.itemid = g.id
        WHERE
            review_data.appraisalquestfieldid = ?
            AND review_data.appraisalroleassignmentid = ?
            AND review_data.scope = 2';

$company_selected = $DB->get_records_sql($sql, array($questionid, $roleassignmentid));

$sql = 'SELECT pg.id, pg.name as fullname
        FROM
          {appraisal_review_data} review_data
        JOIN {goal_personal} pg
          ON review_data.itemid = pg.id
        WHERE
            review_data.appraisalquestfieldid = ?
            AND review_data.appraisalroleassignmentid = ?
            AND review_data.scope = 1';
$personal_selected = $DB->get_records_sql($sql, array($questionid, $roleassignmentid));

$alreadyselected = array();
foreach ($personal_selected as $p) {
    $p->id = 'personal_' . $p->id;
    $alreadyselected[$p->id] = $p;
}

// We have to loop through company items too because
// array_merge messes up the array keys
foreach ($company_selected as $c) {
    $alreadyselected[$c->id] = $c;
}

// Disaply page
if (!$nojs) {
    // Load dialog content generator
    $dialog = new totara_dialog_content_goals($frameworkid);

    $dialog->show_treeview_only = $treeonly;

    $dialog->load_items();

    // Set title
    $dialog->selected_title = 'itemstoadd';
    $dialog->disabled_items = $alreadyselected;
    // Addition url parameters

    echo $dialog->generate_markup();
}
