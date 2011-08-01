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
 * Displays external information about a program
 */

require_once(dirname(dirname(dirname(__FILE__))) . '/config.php');
require_once('lib.php');

$id   = optional_param('id', false, PARAM_INT); // Program id
$name = optional_param('name', false, PARAM_TEXT); // Program short name

if (!$id and !$name) {
    error("Must specify program id or short name");
}

if ($name) {
    if (! $program = get_record("prog", "shortname", $name) ) {
        print_error('error:invalidshortname','local_program');
    }
} else {
    if (! $program = get_record("prog", "id", $id) ) {
        print_error('error:invalidid','local_program');
    }
}

$site = get_site();

if ($CFG->forcelogin) {
    require_login();
}

$context = get_context_instance(CONTEXT_PROGRAM, $program->id);
if (( ! $program->visible) && !has_capability('local/program:viewhiddenprograms', $context)) {
    print_error('programhidden', '', $CFG->wwwroot .'/');
}

print_header(get_string("summaryof", "", $program->fullname));

print_heading(format_string($program->fullname) . '<br />(' . format_string($program->shortname) . ')');

print_box_start('generalbox info');

echo filter_text(text_to_html($program->summary),$program->id);

print_box_end();

echo "<br />";

close_window_button();

print_footer();

?>
