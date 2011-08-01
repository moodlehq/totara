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
require_once($CFG->dirroot . '/local/dialogs/search_form.php');
require_once($CFG->dirroot . '/local/dialogs/dialog_content_hierarchy.class.php');

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

$strsearch = get_string('search');
#$stritemplural = get_string($type . 'plural', $type);
$strqueryerror = get_string('queryerror', 'hierarchy');

// Trim whitespace off seach query
$query = urldecode(trim($query));

// Search form
// Data
$hidden = array();

// Create form
$mform = new dialog_search_form($CFG->wwwroot. '/local/program/search.php',
    compact('hidden', 'query'));

// Display form
$mform->display();

// Display results
if (strlen($query)) {

    // extract quoted strings from query
    $keywords = prog_search_parse_keywords($query);

    $fields = "
        SELECT
            p.id,
            p.fullname
    ";

    $count = 'SELECT COUNT(*)';

    $from = "
        FROM
            {$CFG->prefix}prog p
    ";

    $order = ' ORDER BY p.sortorder ASC';

    // Match search terms
    $where = prog_search_get_keyword_where_clause($keywords);

    // Don't allow hidden programs to be selected unless permissions allow it
    $context = get_context_instance(CONTEXT_SYSTEM);
    if ( ! has_capability('local/program:viewhiddenprograms', $context)) {
        $where .= ' AND p.visible=1';
    }

    $total = count_records_sql($count . $from . $where);
    $start = $page * HIERARCHY_SEARCH_NUM_PER_PAGE;
    if ($total) {
        if($results = get_records_sql($fields . $from . $where .
            $order, $start, HIERARCHY_SEARCH_NUM_PER_PAGE)) {

            $data = array('query' => urlencode(stripslashes($query)));

            $url = new moodle_url($CFG->wwwroot . '/local/program/search.php', $data);
            print '<div class="search-paging">';
            print print_paging_bar($total, $page, HIERARCHY_SEARCH_NUM_PER_PAGE, $url, 'page', false, true, 5);
            print '</div>';

            // Generate some treeview data
            $dialog = new totara_dialog_content();
            $dialog->items = array();
            $dialog->parent_items = array();

            foreach($results as $result) {
                $item = new object();
                $item->id = $result->id;
                $item->fullname = $result->fullname;

                $dialog->items[$item->id] = $item;
            }

            echo $dialog->generate_treeview();

        } else {
            // if count succeeds, query shouldn't fail
            // must be something wrong with query
            print $strqueryerror;
        }
    } else {
        $params = new object();
        $params->query = stripslashes($query);
        $errorstr = 'noresultsfor';
        print '<p class="message">' . get_string($errorstr, 'hierarchy', $params). '</p>';
    }
} else {
    print '<br />';
}


/**
 * Parse a query into individual keywords, treating quoted phrases one item
 *
 * Pairs of matching double or single quotes are treated as a single keyword.
 *
 * @param string $query Text from user search field
 *
 * @return array Array of individual keywords parsed from input string
 */
function prog_search_parse_keywords($query) {
    // query arrives with quotes escaped, but quotes have special meaning
    // within a query. Strip out slashes, then re-add any that are left
    // after parsing done (to protect against SQL injection)
    $query = stripslashes($query);

    $out = array();
    // break query down into quoted and unquoted sections
    $split_quoted = preg_split('/(\'[^\']+\')|("[^"]+")/', $query, 0,
        PREG_SPLIT_DELIM_CAPTURE);
    foreach($split_quoted as $item) {
        // strip quotes from quoted strings but leave spaces
        if(preg_match('/^(["\'])(.*)\\1$/', trim($item), $matches)) {
            $out[] = addslashes($matches[2]);
        } else {
            // split unquoted text on whitespace
            $keyword = addslashes_recursive(preg_split('/\s/', $item, 0,
                PREG_SPLIT_NO_EMPTY));
            $out = array_merge($out, $keyword);
        }
    }
    return $out;
}


/**
 * Return an SQL WHERE clause to search for the given keywords
 *
 * @param array $keywords Array of strings to search for
 *
 * @return string SQL WHERE clause to match the keywords provided
 */
function prog_search_get_keyword_where_clause($keywords) {

    // fields to search
    $fields = array('p.fullname', 'p.shortname');

    $queries = array();
    foreach($keywords as $keyword) {
        $matches = array();
        foreach($fields as $field) {
            $matches[] = $field . ' ' . sql_ilike() . " '%" . $keyword . "%'";
        }
        // look for each keyword in any field
        $queries[] = '(' . implode(' OR ', $matches) . ')';
    }
    // all keywords must be found in at least one field
    return ' WHERE ' . implode(' AND ', $queries);
}
