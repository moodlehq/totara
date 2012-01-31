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
 * Library for handling basic search queries
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage local
 */

/**
 * Parse a query into individual keywords, treating quoted phrases one item
 *
 * Pairs of matching double or single quotes are treated as a single keyword.
 *
 * @param string $query Text from user search field
 *
 * @return array Array of individual keywords parsed from input string
 */
function local_search_parse_keywords($query) {
    // query arrives with quotes escaped, but quotes have special meaning
    // within a query. Strip out slashes, then re-add any that are left
    // after parsing done (to protect against SQL injection)
    $query = stripslashes(trim($query));

    $out = array();
    // break query down into quoted and unquoted sections
    $split_quoted = preg_split('/(\'[^\']+\')|("[^"]+")/', $query, 0,
        PREG_SPLIT_DELIM_CAPTURE);
    foreach ($split_quoted as $item) {
        // strip quotes from quoted strings but leave spaces
        if (preg_match('/^(["\'])(.*)\\1$/', trim($item), $matches)) {
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
 * @param array $fields Array of SQL fields to search against
 *
 * @return string SQL WHERE clause to match the keywords provided
 */
function local_search_get_keyword_where_clause($keywords, $fields) {

    $queries = array();
    foreach ($keywords as $keyword) {
        $matches = array();
        foreach ($fields as $field) {
            $matches[] = $field . ' ' . sql_ilike() . " '%" . $keyword . "%'";
        }
        // look for each keyword in any field
        $queries[] = '(' . implode(' OR ', $matches) . ')';
    }
    // all keywords must be found in at least one field
    return implode(' AND ', $queries);
}
