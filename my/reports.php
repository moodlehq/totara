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

require_once(dirname(dirname(__FILE__)) . '/config.php');
require_once($CFG->dirroot . '/totara/reportbuilder/lib.php');

require_login();

$strheading = get_string('myreports', 'totara_core');

$PAGE->set_context(context_system::instance());
$PAGE->set_title($strheading);
$PAGE->set_url(new moodle_url('/my/reports.php'));
$PAGE->navbar->add($strheading);

$output = $PAGE->get_renderer('totara_reportbuilder');

echo $output->header();

add_to_log(SITEID, 'my', 'reports', 'reports.php');

echo $output->heading($strheading, 1);

echo $output->container_start(null, 'myreports_section');
echo totara_print_report_manager();
echo $output->container_end();

if (reportbuilder_get_reports()){
    echo $output->container_start(null, 'scheduledreports_section');
    echo $output->container_start(null, 'scheduledreports_section_inner');
    echo html_writer::empty_tag('br');
    echo html_writer::tag('a', '', array('name' => 'scheduled'));
    echo $output->heading(get_string('scheduledreports', 'totara_reportbuilder'), 1);

    totara_print_scheduled_reports();
    echo $output->container_end();
    echo $output->container_end();
}

echo $output->footer();

?>
