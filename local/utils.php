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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage utils
 */

/*
 * This file contains general purpose utility functions
 */


/**
 * Pop N items off the beginning of $items and return them as an array
 *
 * @param array &$items Array of items (passed by reference)
 * @param integer $number Number of items to remove from the start of $items
 *
 * @return array Array of $number items from $items, or false if $items is empty
 */
function totara_pop_n(&$items, $number) {
    if (count($items) == 0) {
        // none left, return false
        return false;
    } else if (count($items) < $number) {
        // return all remaining items
        $return = $items;
        $items = array();
        return $return;
    } else {
        // return the first N and shorten $items
        $return = array_slice($items, 0, $number, true);
        $items = array_slice($items, $number, null, true);
        return $return;
    }
}


/**
 * Return the proper SQL to compare a field to multiple items
 *
 * By default it uses IN but can be negated (to NOT IN) using the 3rd argument
 *
 * The output from this is safe for Oracle, which has a limit of 1000 items in an
 * IN () call.
 *
 * @param string $field The field to compare against
 * @param array $items Array of items. If text they must already be quoted.
 * @param boolean $negate Return code for NOT IN () instead of IN ()
 *
 * @return string The SQL needed to compare $field to the items in $items
 */
function sql_sequence($field, $items, $negate = false) {
    global $CFG;

    if (!is_array($items) || count($items) == 0) {
        return ($negate) ? '1=1' : '1=0';
    }

    $not = $negate ? 'NOT' : '';
    if ($CFG->dbfamily != 'oracle' || $count($items <= 1000)) {
        return " $field $not IN (" . implode(',', $items) . ') ';
    }

    $out = array();
    while ($some_items = totara_pop_n($items, 1000)) {
        $out[] =" $field $not IN (" . implode(',', $items) . ') ';
    }

    $operator = $negate ? ' AND ' : ' OR ';
    return '(' . implode($operator, $out) . ')';
}



/**
 * Check if a specified language string already exists
 *
 * The arguments are the same as those given to get_string() with the
 * exception of $a which is not required
 *
 * @param string $identifier The key identifier for the language string
 * @param string $module Module where the key identifier is stored
 * @param array $extralocations Array of strings with other locations
 *                              to check for the string
 *
 * @return boolean True if string exists
 */
function check_string($identifier, $module='', $extralocations=null) {
    $result = @get_string($identifier, $module, null, $extralocations);

    if($result == '[[' . $identifier . ']]') {
        return false;
    } else {
        return true;
    }
}


/**
 * Returns an attribute variable used to limit the width of a pulldown
 *
 * This code is required to fix limited width pulldowns in IE. The
 * if(document.all) condition limits the javascript to only affect IE.
 *
 * @return array Array of the correct format to be used by a 'select'
 *               form element
 */
function totara_select_width_limiter() {
    return array(
        'class' => 'totara-limited-width',
        'onMouseDown'=>"if (document.all) this.className='totara-expanded-width';",
        'onBlur'=>"if (document.all) this.className='totara-limited-width';",
        'onChange'=>"if (document.all) this.className='totara-limited-width';"
    );
}

/**
 * Helper function to group a set of records, keyed by a particular field
 *
 * Returns and associative array where the keys are unique values of the grouped
 * field and the values are arrays of objects that contain the grouped key
 *
 * @param object $rs A recordset as returned by get_recordset() or similar functions
 * @param string $field Name of the field to group by. Must be a field in $rs
 *
 * @return array|false Associative array of results or false if none found or $field invalid
 */
function totara_group_records($rs, $field) {
    if(!$rs) {
        return false;
    }
    $out = array();
    while ($row = rs_fetch_next_record($rs)) {
        // $field must exist in recordset
        if (!isset($row->$field)) {
            return false;
        }
        if (array_key_exists($row->$field, $out)) {
            $out[$row->$field][] = $row;
        } else {
            $out[$row->$field] = array($row);
        }
    }
    return $out;
}
