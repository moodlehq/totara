<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simon.coggins@totaralms.com>
 * @package totara
 * @subpackage totara_hierarchy
 */

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../lib.php');
require_once('lib.php');

///
/// Setup / loading data
///

$sitecontext = context_system::instance();

// Setup page and check permissions
admin_externalpage_setup('competencyscales');

///
/// Build page
///
echo $OUTPUT->header();

$hierarchy = new competency();
$scales = $hierarchy->get_scales();
if ($scales) {
    competency_scale_display_table($scales, $editingon=1);
} else {
    echo html_writer::tag('p', get_string('noscalesdefined', 'totara_hierarchy'));
}
echo $OUTPUT->footer();
