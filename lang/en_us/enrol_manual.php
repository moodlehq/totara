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

/**
 * Strings for component 'enrol_manual', language 'en_us', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_manual
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['confirmbulkdeleteenrolment'] = 'Are you sure you want to delete these users enrollments?';
$string['defaultperiod'] = 'Default enrollment period';
$string['defaultperiod_desc'] = 'Default length of the default enrollment period setting (in seconds).';
$string['deleteselectedusers'] = 'Delete selected user enrollments';
$string['editenrolment'] = 'Edit enrollment';
$string['editselectedusers'] = 'Edit selected user enrollments';
$string['enrolledincourserole'] = 'Enrolled in "{$a->course}" as "{$a->role}"';
$string['enrolusers'] = 'Enroll users';
$string['manual:config'] = 'Configure manual enroll instances';
$string['manual:enrol'] = 'Enroll users';
$string['manual:manage'] = 'Manage user enrollments';
$string['manual:unenrol'] = 'Unenroll users from the course';
$string['manual:unenrolself'] = 'Unenroll self from the course';
$string['pluginname'] = 'Manual enrollments';
$string['pluginname_desc'] = 'The manual enrollments plugin allows users to be enrolled manually via a link in the course administration settings, by a user with appropriate permissions such as a teacher. The plugin should normally be enabled, since certain other enrollment plugins, such as self enrollment, require it.';
$string['status'] = 'Enable manual enrollments';
$string['status_desc'] = 'Allow course access of internally enrolled users. This should be kept enabled in most cases.';
$string['status_help'] = 'This setting determines whether users can be enrolled manually, via a link in the course administration settings, by a user with appropriate permissions such as a teacher.';
$string['unenrol'] = 'Unenroll user';
$string['unenrolselectedusers'] = 'Unenroll selected users';
$string['unenrolselfconfirm'] = 'Do you really want to unenroll yourself from course "{$a}"?';
$string['unenroluser'] = 'Do you really want to unenroll "{$a->user}" from course "{$a->course}"?';
$string['unenrolusers'] = 'Unenroll users';
$string['wscannotenrol'] = 'Plugin instance cannot manually enroll a user in the course id = {$a->courseid}';
$string['wsnoinstance'] = 'Manual enrollment plugin instance doesn\'t exist or is disabled for the course (id = {$a->courseid})';
