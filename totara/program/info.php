<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
    print_error(get_string('error:noprogramid', 'totara_program'));
}

if ($name) {
    if (!$program = $DB->get_record("prog", array("shortname" => $name))) {
        print_error('error:invalidshortname','totara_program');
    }
} else {
    if (!$program = $DB->get_record("prog", array("id" => $id))) {
        print_error('error:invalidid','totara_program');
    }
}

$site = get_site();

if ($CFG->forcelogin) {
    require_login();
}

$context = context_program::instance($program->id);
if ((!$program->visible) && !has_capability('totara/program:viewhiddenprograms', $context)) {
    print_error('programhidden', '', $CFG->wwwroot .'/');
}

$PAGE->set_title(get_string("summaryof", "", $program->fullname));
echo $OUTPUT->header();

echo $OUTPUT->heading(format_string($program->fullname) . html_writer::empty_tag('br') . '(' . format_string($program->shortname) . ')');

echo $OUTPUT->box_start('generalbox info');

echo filter_text(text_to_html($program->summary),$program->id);

echo $OUTPUT->box_end();

echo html_writer::empty_tag('br');

echo $OUTPUT->close_window_button();

echo $OUTPUT->footer();

?>
