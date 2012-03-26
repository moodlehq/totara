<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_hierarchy
 */

/**
 * Page containing manager search results
 *
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/totara/core/searchlib.php');
require_once($CFG->dirroot . '/totara/core/dialogs/search_form.php');
require_once($CFG->dirroot . '/totara/core/dialogs/dialog_content_hierarchy.class.php');

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
$userid = optional_param('userid', -1, PARAM_INT); // user being assigned a manager

$strsearch = get_string('search');
$strqueryerror = get_string('queryerror', 'totara_hierarchy');

// Trim whitespace off seach query
$query = urldecode(trim($query));

// Search form
// Data
$hidden = array();

// Grab data from dialog object (if applicable)
if (isset($this) && isset($this->customdata['current_user'])) {
    $hidden['userid'] = $this->customdata['current_user'];
} else if ($userid) {
    $hidden['userid'] = $userid;
}

// Create form
$mform = new dialog_search_form($CFG->wwwroot . '/totara/hierarchy/prefix/position/assign/manager_search.php',
    compact('hidden', 'query'));

// Display form
$mform->display();

// Display results
if (strlen($query)) {

    // extract quoted strings from query
    $keywords = totara_search_parse_keywords($query);

    $fields = "SELECT u.id, ".$DB->sql_fullname('u.firstname', 'u.lastname')." AS fullname";

    $count = 'SELECT COUNT(u.id)';

    $from = " FROM {user} u";

    $order = ' ORDER BY u.firstname, u.lastname';

    // Match search terms
    list($where_sql, $where_params) = user_search_get_keyword_where_clause($keywords);
    $where .= " AND u.id <> ?";
    $params = array_merge($where_params, array($userid));

    $total = $DB->count_records_sql($count . $from . $where, $params);
    $start = $page * HIERARCHY_SEARCH_NUM_PER_PAGE;

    if ($total) {
        if ($results = $DB->get_records_sql($fields . $from . $where .
            $order, array($userid), $start, HIERARCHY_SEARCH_NUM_PER_PAGE)) {

            echo html_writer::tag('div', $OUTPUT->paging_bar($total, $page, HIERARCHY_SEARCH_NUM_PER_PAGE,
                    new moodle_url('prefix/position/assign/manager_search.php', array('query' => urlencode(stripslashes($query)))),
                    'page'), array('class' => "search-paging"));

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
            // if count succeeds, query shouldn't fail
            // must be something wrong with query
            print $strqueryerror;
        }
    } else {
        $params = new stdClass();
        $params->query = stripslashes($query);
        $errorstr = 'noresultsfor';
        print html_writer::tag('p', get_string($errorstr, 'totara_hierarchy', $params), array('class' => 'message'));
    }
} else {
    print html_writer::empty_tag('br');
}



/**
 * Return an SQL WHERE clause to search for the given keywords
 *
 * @param array $keywords Array of strings to search for
 *
 * @return array Array of SQL WHERE clause and parameters array to match the keywords provided
 */
function user_search_get_keyword_where_clause($keywords) {
    global $DB;

    // fields to search
    $fields = array($DB->sql_fullname('u.firstname', 'u.lastname'));

    // all keywords must be found in at least one field
    list($keyword_sql, $keyword_params) = totara_search_get_keyword_where_clause($keywords, $fields);

    // exclude deleted users and guest user
    $returnsql = " WHERE $keyword_sql AND u.deleted = ? AND u.id != ?";
    $returnparams = array_merge($keyword_params, array(0, guest_user()));

    return array($returnsql, $returnparams);
}
