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
