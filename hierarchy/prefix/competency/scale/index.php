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


require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../lib.php');
require_once('lib.php');

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Setup page and check permissions
admin_externalpage_setup('competencyscales');

///
/// Build page
///
admin_externalpage_print_header();

$hierarchy = new competency();
$scales = $hierarchy->get_scales();
if ($scales) {
    competency_scale_display_table($scales, $editingon=1);
} else {
    echo '<p>'.get_string('noscalesdefined', 'competency').'</p>';
}
admin_externalpage_print_footer();
