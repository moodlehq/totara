<?php

/**
 * Get the number of visible items in or below the selected categories
 *
 * This function counts the number of items within a set of categories, only including
 * items that are visible to the user.
 *
 * By default returns the course count, but will work for programs too.
 *
 * We need to jump through some hoops to do this efficiently:
 *
 * - To avoid having to do it recursively it relies on the context
 *   path to find courses within a category
 *
 * - To avoid having to check capabilities for every item it only
 *   checks hidden courses, and only if user isn't a siteadmin
 *
 * @param integer|array $categoryids ID or IDs of the category/categories to fetch
 * @param boolean $countcourses If true count number of courses, otherwise count programs
 *
 * @return integer|array Associative array, where keys are the sub-category IDs and value is the count. If $categoryids is a single integer, just returns the count as an integer
 */
function totara_get_category_item_count($categoryids, $countcourses = true) {
    global $CFG, $USER, $DB;

    list($insql, $params) = $DB->get_in_or_equal(is_array($categoryids) ? $categoryids : array($categoryids));

    if (!$categories = $DB->get_records_select('course_categories', "id $insql", $params)) {
        // no categories
        return array();
    }

    // what items are we counting, courses or programs?
    if ($countcourses) {
        $itemcap = 'moodle/course:viewhiddencourses';
        $itemtable = "{course}";
        $itemcontext = CONTEXT_COURSE;
    } else {
        $itemcap = 'totara/program:viewhiddenprograms';
        $itemtable = "{prog}";
        $itemcontext = CONTEXT_PROGRAM;
    }

    list($insql, $inparams) = $DB->get_in_or_equal(array_keys($categories), SQL_PARAMS_NAMED);
    $sql = "SELECT instanceid, path
              FROM {context}
             WHERE contextlevel = :contextlvl
               AND instanceid {$insql}
             ORDER BY depth DESC";
    $params = array('contextlvl' => CONTEXT_COURSECAT);
    $params = array_merge($params, $inparams);
    // save the context paths of all the categories

    $contextpaths = $DB->get_records_sql_menu($sql, $params);

    // builds a WHERE snippet that matches any items inside the sub-category
    // this won't match the category itself (because of the trailing slash),
    // but that's okay as we're only interested in the items inside
    $contextwhere = array(); $contextparams = array();
    foreach ($contextpaths as $path) {
        $contextwhere[] = $DB->sql_like('cx.path','?');
        $contextparams[] = $path . '/%';
    }

    $sql = "SELECT i.id as itemid, i.visible, cx.path
              FROM {context} cx
              JOIN {$itemtable} i
                ON i.id = cx.instanceid AND contextlevel = ?
             WHERE (" . implode(' OR ', $contextwhere) . ")";
    $params = array($itemcontext);
    $params = array_merge($params, $contextparams);

    // get all items inside all the categories
    if (!$items = $DB->get_records_sql($sql, $params)) {
        // Sub-categories are all empty.
        if (is_array($categoryids)) {
            return array();
        }
        return 0;
    }

    $results = array();
    foreach ($items as $item) {
        // check individual permission
        //get contextobj - use a switch in case this gets even more complicated in future with a third type
        switch ($itemcontext) {
            case CONTEXT_COURSE:
                $contextobj = context_course::instance($item->itemid);
                break;
            case CONTEXT_PROGRAM:
                $contextobj = context_program::instance($item->itemid);
                break;
        }
        if (!$item->visible && !has_capability($itemcap, $contextobj)) {
            continue;
        }

        // we need to check if programs are available to students before
        // displaying them in search, unless the user is an admin
        if (!$countcourses && !is_siteadmin($USER->id)) {

            $program = new program($item->itemid);
            if (!$program->is_accessible()) {
                continue;
            }
        }

        // now we need to figure out which sub-category each item
        // is a member of
        foreach ($contextpaths as $categoryid => $contextpath) {
            // it's a member if the beginning of the contextpath's
            // match
            if (substr($item->path, 0, strlen($contextpath.'/')) ==
                $contextpath.'/') {
                if (array_key_exists($categoryid, $results)) {
                    $results[$categoryid]++;
                } else {
                    $results[$categoryid] = 1;
                }
                break;
            }
        }
    }

    if (is_array($categoryids)) {
        return $results;
    } else {
        return current($results);
    }

}

/**
 * Sorts a pair of objects based on the itemcount property (high to low)
 *
 * @param object $a The first object
 * @param object $b The second object
 * @return integer Returns 1/0/-1 depending on the relative values of the objects itemcount property
 */
function totara_course_cmp_by_count($a, $b) {
    if ($a->itemcount < $b->itemcount) {
        return +1;
    } else if ($a->itemcount > $b->itemcount) {
        return -1;
    } else {
        return 0;
    }
}
