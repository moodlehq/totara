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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @author Aaron Barnes
 * @package totara
 * @subpackage totara_plan
 */

/**
 * Page containing dependency search results
 *
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/totara/core/dialogs/search_form.php');
require_once($CFG->dirroot . '/totara/core/dialogs/dialog_content_hierarchy.class.php');
require_once($CFG->dirroot . '/totara/core/searchlib.php');

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
$strqueryerror = get_string('queryerror', 'totara_hierarchy');
$context = context_system::instance();
$PAGE->set_context($context);
// Trim whitespace off seach query
$query = urldecode(trim($query));

// Search form
// Data
$hidden = array();

// Create form
$mform = new dialog_search_form($CFG->wwwroot. '/totara/plan/components/course/course_search.php',
    compact('hidden', 'query'));

// Display form
$mform->display();

// Display results
if (strlen($query)) {

    // extract quoted strings from query
    $keywords = totara_search_parse_keywords($query);

    $fields = "
        SELECT
            c.id,
            c.fullname
    ";

    $count = 'SELECT COUNT(*)';

    $from = "
        FROM
            {course} c
    ";

    $order = ' ORDER BY c.sortorder ASC';

    // Match search terms
    list($searchsql, $params) = totara_search_get_keyword_where_clause($keywords, array('c.fullname', 'c.shortname'));
    $where = ' WHERE ' . $searchsql;
    // Only show courses with completion enabled
    $where .= "
        AND c.id <> ?
        AND c.visible = 1
    ";
    $params[] = SITEID;
    $total = $DB->count_records_sql($count . $from . $where, $params);
    $start = $page * HIERARCHY_SEARCH_NUM_PER_PAGE;
    if ($total) {
        if ($results = $DB->get_records_sql($fields . $from . $where .
            $order, $params, $start, HIERARCHY_SEARCH_NUM_PER_PAGE)) {

            $data = array('query' => urlencode(stripslashes($query)));

            $url = new moodle_url('course_search.php', $data);

            $pagingbar = new paging_bar($total, $page, HIERARCHY_SEARCH_NUM_PER_PAGE, $url);
            $pagingbar->pagevar = 'page';
            $output = $OUTPUT->render($pagingbar);
            print $OUTPUT->container($output, "search-paging");

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
        print html_writer::tag('p', get_string($errorstr, 'totara_core', $params), array('class' => "message"));
    }
} else {
    print html_writer::empty_tag('br');
}
