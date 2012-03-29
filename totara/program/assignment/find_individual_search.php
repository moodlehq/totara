<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
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
 * @package totara
 * @subpackage program
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/totara/core/dialogs/search_form.php');
require_once($CFG->dirroot . '/totara/core/dialogs/dialog_content_hierarchy.class.php');
require_once("{$CFG->dirroot}/totara/program/lib.php");
require_once($CFG->dirroot . '/totara/core/searchlib.php');

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

$PAGE->set_context(get_system_context());
require_login();

$programid = required_param('programid', PARAM_INT);

// Get program id and check capabilities
$programid = required_param('programid', PARAM_INT);
require_capability('totara/program:configureassignments', program_get_context($programid));

/**
 * How many search results to show before paginating
 *
 * @var integer
 */
define('HIERARCHY_SEARCH_NUM_PER_PAGE', 50);

$query = optional_param('query', null, PARAM_TEXT); // search query
$page = optional_param('page', 0, PARAM_INT); // results page number

$strsearch = get_string('search');
#$stritemplural = get_string($type . 'plural', $type);
$strqueryerror = get_string('queryerror', 'totara_hierarchy');

// Trim whitespace off seach query
$query = urldecode(trim($query));

// Search form
// Data
$hidden = array();

// Create form
$formurl = "{$CFG->wwwroot}/totara/program/assignment/find_individual_search.php?programid={$programid}";
$mform = new dialog_search_form($formurl, compact('hidden', 'query'));

// Display form
$mform->display();

// Display results
if (strlen($query)) {

    // extract quoted strings from query
    $keywords = totara_search_parse_keywords($query);
    $params = array();
    $fields = array('u.firstname', 'u.lastname');
    $select = "SELECT u.id, ".$DB->sql_fullname('u.firstname', 'u.lastname')." as fullname ";

    $count = 'SELECT COUNT(*) ';

    $from = "FROM {user} u ";

    $order = '';

    // Get search sql and params
    list($searchsql, $params) = totara_search_get_keyword_where_clause($keywords, $fields);

    // Only show managers
    $where = " WHERE {$searchsql} AND deleted = 0";

    $total = $DB->count_records_sql($count . $from . $where, $params);
    $start = $page * HIERARCHY_SEARCH_NUM_PER_PAGE;
    if ($total) {
        $results = $DB->get_records_sql($select . $from . $where .
            $order, $params, $start, HIERARCHY_SEARCH_NUM_PER_PAGE);

        $data = array('query' => urlencode($query), 'programid' => $programid);

        $url = new moodle_url('/totara/program/assignment/find_individual_search.php', $data);
        echo html_writer::start_tag('div', array('class' => 'search-paging'));
        $pagingbar = new paging_bar($total, $page, HIERARCHY_SEARCH_NUM_PER_PAGE, $url);
        echo $OUTPUT->render($pagingbar);
        echo html_writer::end_tag('div');

        // Generate some treeview data
        $dialog = new totara_dialog_content();
        $dialog->items = array();
        $dialog->parent_items = array();

        foreach ($results as $result) {
            $item = new stdClass();
            $item->id = $result->id;
            $item->fullname = $result->fullname;
            $dialog->items[$item->id] = $item;
        }

        echo $dialog->generate_treeview();
    } else {
        $obj = new stdClass();
        $obj->query = $query;
        $errorstr = 'noresultsfor';
        echo html_writer::start_tag('p', array('class' => 'message')) . get_string($errorstr, 'totara_hierarchy', $obj). html_writer::end_tag('p');
    }
} else {
    echo html_writer::empty_tag('br');
}
