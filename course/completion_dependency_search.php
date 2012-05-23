<?php // $Id$

/**
 * Page containing dependency search results
 *
 * @copyright Totara Learning Solution Limited
 * @author Simon Coggins
 * @author Aaron Barnes
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage dialog
 */

require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once($CFG->libdir . '/formslib.php');
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

require_login();
$PAGE->set_context(context_system::instance());

$strsearch = get_string('search');
$strqueryerror = get_string('queryerror', 'totara_hierarchy');

// Trim whitespace off seach query
$query = urldecode(trim($query));

// Search form
// Data
$hidden = array();

// Create form
$mform = new dialog_search_form($CFG->wwwroot. '/course/completion_dependency_search.php',
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
    $fields = array('c.fullname', 'c.shortname');
    list($where, $params) = totara_search_get_keyword_where_clause($keywords, $fields);

    // Only show courses with completion enabled
    $where .= "
        AND c.enablecompletion = ?
        AND c.visible = 1
    ";
    $params[]= COMPLETION_ENABLED;

    $total = $DB->count_records_sql($count . $from . $where, $params);
    $start = $page * HIERARCHY_SEARCH_NUM_PER_PAGE;
    if ($total) {
        if ($results = $DB->get_records_sql($fields . $from . $where . $order, $params, $start, HIERARCHY_SEARCH_NUM_PER_PAGE)) {

            $data = array('query' => urlencode($query));

            $url = new moodle_url($CFG->wwwroot . '/course/completion_dependency_search.php', $data);
            $pagingbar = new paging_bar($total, $page, HIERARCHY_SEARCH_NUM_PER_PAGE, $url);
            $pagingbar->pagevar = 'page';
            $output = $OUTPUT->render($pagingbar);
            echo html_writer::tag('div',
                            $output,
                            array('class' => 'search-paging'));

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
            echo $strqueryerror;
        }
    } else {
        $params = new stdClass();
        $params->query = $query;
        $errorstr = 'noresultsfor';
        echo html_writer::tag('p', get_string($errorstr, 'totara_hierarchy', $params), array('class' => 'message'));
    }
} else {
    echo html_writer::empty_tag('br');
}
