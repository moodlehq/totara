<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


require_once '../../config.php';
require_once $CFG->libdir.'/adminlib.php';

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Setup page and check permissions
admin_externalpage_setup('competencyscales');

// Load all scales
$scales = get_records('competency_scale', null, null, 'name');

// Cache permissions
$can_edit = has_capability('moodle/local:updatecompetencies', $sitecontext);
$can_delete = has_capability('moodle/local:deletecompetencies', $sitecontext);

$stredit = get_string('edit');
$strdelete = get_string('delete');

///
/// Build page
///

if ($scales) {
    $table = new stdClass();
    $table->head  = array(get_string('scale'), get_string('used'), $strdelete);
    $table->size = array('70%', '20%', '10%');
    $table->align = array('left', 'center', 'center');
    $table->width = '90%';

    $table->data = array();
    foreach($scales as $scale) {
        $line = array();
        $line[] = "<a href=\"$CFG->wwwroot/competencies/scale/view.php?id={$scale->id}\">".format_string($scale->name)."</a>";
        $line[] = get_string('no');

        $buttons = array();
        if ($can_edit) {
            $buttons[] = "<a title=\"$stredit\" href=\"edit.php?id=$scale->id\"><img".
                " src=\"$CFG->pixpath/t/edit.gif\" class=\"iconsmall\" alt=\"$stredit\" /></a> ";
        }

        if ($can_delete) {
            $buttons[] = "<a title=\"$strdelete\" href=\"delete.php?id=$scale->id\"><img".
                        " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
        }
        $line[] = implode($buttons, ' ');

        $table->data[] = $line;
    }
}

admin_externalpage_print_header();

print_heading(get_string('competencyscales', 'competencies'));

if ($scales) {
    print_table($table);
}

echo '<div class="buttons">';
print_single_button('edit.php', null, get_string('scalescustomcreate'));
echo '</div>';

admin_externalpage_print_footer();
