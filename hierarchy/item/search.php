<?php // $Id$

/**
 * Page containing hierarchy item search results
 *
 * @copyright Totara Learning Solution Limited
 * @author Simon Coggins
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 * @subpackage dialog
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once($CFG->libdir . '/formslib.php');
require_once($CFG->dirroot . '/hierarchy/lib.php');
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

// these vars provided by build_search_interface initially, but
// come from the form when it has been submitted
if(!isset($type)) {
    $type = required_param('type', PARAM_ALPHA); // type of hierarchy
}
if(!isset($select)) {
    $select = optional_param('select', true, PARAM_BOOL); // show framework selector?
}
if(!isset($frameworkid)) {
    $frameworkid = optional_param('frameworkid', 0, PARAM_INT); // specify framework to search
}
if(!isset($disabledlist)) {
    $disabledlist = unserialize(stripslashes(optional_param('disabledlist', '', PARAM_TEXT))); // items to disable
}
if (!isset($templates)) {
    $templates = optional_param('templates', false, PARAM_BOOL); // search templates only
}

$query = optional_param('query', null, PARAM_TEXT); // search query
$page = optional_param('page', 0, PARAM_INT); // results page number

$strsearch = get_string('search');
$stritemplural = get_string($type . 'plural', $type);
$strqueryerror = get_string('queryerror', 'hierarchy');

// Confirm the type exists
if (file_exists($CFG->dirroot.'/hierarchy/type/' . $type . '/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/' . $type . '/lib.php');
} else {
    print_error('error:hierarchytypenotfound', 'hierarchy', '', $type);
}

$shortprefix = hierarchy::get_short_prefix($type);
$hierarchy = new $type();

// Trim whitespace off seach query
$query = urldecode(trim($query));

// Search form
// Data
$disabledarray = $disabledlist;
$disabledlist = serialize($disabledlist);
$hidden = compact('type', 'select', 'templates', 'disabledlist');

// Create form
$mform = new dialog_search_form($CFG->wwwroot. '/hierarchy/item/search.php',
    compact('hidden', 'query', 'frameworkid', 'shortprefix'));

// Display form
$mform->display();

// Display results
if (strlen($query)) {

    // extract quoted strings from query
    $keywords = hierarchy_search_parse_keywords($query);

    $fields = 'SELECT id,fullname';
    $count = 'SELECT COUNT(*)';
    $from = " FROM {$CFG->prefix}{$shortprefix}";
    $order = ' ORDER BY frameworkid,sortorder';

    // If searching templates, change tables
    if ($templates) {
        $from .= '_template';
        $order = ' ORDER BY fullname';
    }

    // match search terms
    $where = hierarchy_search_get_keyword_where_clause($keywords);

    // restrict by framework if required
    if($frameworkid) {
        $where .= " AND frameworkid=$frameworkid";
    }

    // don't show hidden items
    $where .= ' AND visible=1';

    $total = count_records_sql($count . $from . $where);
    $start = $page * HIERARCHY_SEARCH_NUM_PER_PAGE;

    if($total) {
        if($results = get_records_sql($fields . $from . $where .
            $order, $start, HIERARCHY_SEARCH_NUM_PER_PAGE)) {

            $data = array('type' => $type,
                    'frameworkid' => $frameworkid,
                    'select' => $select,
                    'query' => urlencode(stripslashes($query)),
                    'disabledlist' => serialize($disabledlist),
                    'templates' => $templates,
            );
            $url = new moodle_url($CFG->wwwroot . '/hierarchy/item/search.php', $data);
            print '<div class="search-paging">';
            print print_paging_bar($total, $page, HIERARCHY_SEARCH_NUM_PER_PAGE, $url, 'page', false, true, 5);
            print '</div>';

            $addbutton_html = '<img src="'.$CFG->pixpath.'/t/add.gif" class="addbutton" />';

            // Generate some treeview data
            $dialog = new totara_dialog_content_hierarchy($type, $frameworkid);
            $dialog->items = array();
            $dialog->parent_items = array();
            $dialog->disabled_items = $disabledarray;

            foreach($results as $result) {
                $title = hierarchy_search_get_path($hierarchy, $result->id);

                $item = new object();
                $item->id = $result->id;
                $item->fullname = $result->fullname;
                $item->hover = $title;

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
        if($frameworkid) {
            $errorstr = 'noresultsforinframework';
            $params->framework = get_field($shortprefix . '_framework',
                'fullname', 'id', $frameworkid);
        } else {
            $errorstr = 'noresultsfor';
        }
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
function hierarchy_search_parse_keywords($query) {
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
function hierarchy_search_get_keyword_where_clause($keywords) {

    // fields to search
    $fields = array('fullname', 'shortname', 'description');

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


/**
 * Returns the name of the item, preceeded by all parent nodes that lead to it
 *
 * @param object $hierarchy Hierarchy object that this item belongs to
 * @param integer $id ID of the hierarchy item to generate path for
 *
 * @return string Text string containing ordered path to this item in hierarchy
 */
function hierarchy_search_get_path($hierarchy, $id) {
    $path = '';

    // this gives all items in path, but not in order
    $members = $hierarchy->get_item_lineage($id);

    // find order by starting from parent id of 0 (top
    // of tree) and working down

    // prevent infinite loop in case of bad members list
    $escape = 0;

    // start at top of tree
    $parentid = 0;
    while(count($members) && $escape < 100) {
        foreach($members as $key => $member) {
            if($member->parentid == $parentid) {
                // add to path
                if($parentid) {
                    // include ' > ' before name except on top element
                    $path .= ' &gt; ';
                }
                $path .= $member->fullname;
                // now update parent id and
                // unset this element
                $parentid = $member->id;
                unset($members[$key]);
            }
        }
        $escape++;
    }

    return $path;
}

