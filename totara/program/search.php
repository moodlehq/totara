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
 * @author Ben Lobo <ben.lobo@kineo.com>
 * @package totara
 * @subpackage program
 */

/**
 * Page containing search results
 *
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/totara/core/dialogs/search_form.php');
require_once($CFG->dirroot . '/totara/core/dialogs/dialog_content_hierarchy.class.php');
require_once($CFG->dirroot . '/totara/core/searchlib.php');
require_once($CFG->dirroot . '/totara/program/lib.php');

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

/**
 * How many search results to show before paginating
 *
 * @var integer
 */
define('HIERARCHY_SEARCH_NUM_PER_PAGE', 50);

$query = optional_param('query', null, PARAM_TEXT); // search query
$page = optional_param('page', 0, PARAM_INT); // results page number
$PAGE->set_context(context_system::instance());

$strsearch = get_string('search');

// Trim whitespace off seach query
$query = urldecode(trim($query));

// Search form
// Data
$hidden = array();

// Create form
$mform = new dialog_search_form($CFG->wwwroot. '/totara/program/search.php',
    compact('hidden', 'query'));

// Display form
$mform->display();

// Display results
if (strlen($query)) {
    $params = array();
    // extract quoted strings from query
    $keywords = totara_search_parse_keywords($query);
    $fields = "SELECT p.id, p.fullname";

    $count = 'SELECT COUNT(*)';

    $from = " FROM {prog} p";

    $order = ' ORDER BY p.sortorder ASC';


    list($where, $params) = totara_search_get_keyword_where_clause($keywords, array('p.fullname', 'p.shortname'));
    $where = ' WHERE ' . $where;
    // Don't allow hidden programs to be selected, even if the user
    // can usually see hidden programs, since we still don't want them
    // adding them to their plan
    $where .= ' AND p.visible=1';

    $total = $DB->count_records_sql($count . $from . $where, $params);
    $start = $page * HIERARCHY_SEARCH_NUM_PER_PAGE;
    if ($total) {
        $results = $DB->get_records_sql($fields . $from . $where .
            $order, $params, $start, HIERARCHY_SEARCH_NUM_PER_PAGE);

        $data = array('query' => urlencode($query));

        $url = new moodle_url('/totara/program/search.php', $data);
        echo html_writer::start_tag('div', array('class' => 'search-paging'));
        $pagingbar = new paging_bar($total, $page, HIERARCHY_SEARCH_NUM_PER_PAGE, $url);
        $pagingbar->pagevar = 'page';
        echo $OUTPUT->render($pagingbar);
        echo html_writer::end_tag('div');

        // Generate some treeview data
        $dialog = new totara_dialog_content();
        $dialog->items = array();
        $dialog->parent_items = array();

        foreach ($results as $result) {
            $prog = new program($result->id);
            if (!$prog->is_accessible()) {
                continue;
            }
            $item = new stdClass();
            $item->id = $result->id;
            $item->fullname = format_string($result->fullname);
            $dialog->items[$item->id] = $item;
        }
        echo $dialog->generate_treeview();

    } else {
        $obj = new stdClass();
        $obj->query = $query;
        $errorstr = 'noresultsfor';
        print html_writer::start_tag('p', get_string($errorstr, 'totara_hierarchy', $obj), array('class' => 'message'));
    }
} else {
    print html_writer::empty_tag('br');
}
