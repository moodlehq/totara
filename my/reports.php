<?php

/**
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    moodle
 * @subpackage totara
 * @author     Simon Coggins <simonc@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * Displays current users reports and scheduled reports
 *
 */

require_once('../config.php');
require_once($CFG->libdir.'/blocklib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once($CFG->dirroot.'/tag/lib.php');

require_login();

define('DEFAULT_PAGE_SIZE', 20);
define('SHOW_ALL_PAGE_SIZE', 5000);

global $SESSION,$USER;
$strheading = get_string('myreports', 'local');

$PAGE = page_create_object('Totara', $USER->id);

// see which reports exist in db and add columns for them to table
// these reports should have the "userid" url parameter enabled to allow
// viewing of individual reports
$staff_records = get_field('report_builder','id','shortname','staff_learning_records');
$staff_f2f = get_field('report_builder','id','shortname','staff_facetoface_sessions');

$PAGE->print_header($strheading, $strheading);


echo '<h1>'.$strheading.'</h1>';
print_container_start(false, '', 'myreports_section');
totara_print_report_manager();
print_container_end();

if(get_reports()){
    print_container_start(false, '', 'scheduledreports_section');
    print_container_start(false, '', 'scheduledreports_section_inner');
    echo '<br /><a name="scheduled"></a><h1>'.get_string('scheduledreports', 'local_reportbuilder').'</h1>';

    totara_print_scheduled_reports();
    print_container_end();
    print_container_end();
}

print_footer();

?>
