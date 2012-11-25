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
 * Strings for component 'enrol_self', language 'en_us', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_self
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['defaultrole_desc'] = 'Select role which should be assigned to users during self enrollment';
$string['editenrolment'] = 'Edit enrollment';
$string['enrolenddaterror'] = 'Enrollment end date cannot be earlier than start date';
$string['enrolme'] = 'Enroll me';
$string['enrolperiod'] = 'Enrollment period';
$string['enrolperiod_desc'] = 'Default length of the enrollment period (in seconds).';
$string['enrolperiod_help'] = 'Length of time that the enrollment is valid, starting with the moment the user enrolls themselves. If disabled, the enrollment duration will be unlimited.';
$string['groupkey'] = 'Use group enrollment keys';
$string['groupkey_desc'] = 'Use group enrollment keys by default.';
$string['groupkey_help'] = 'In addition to restricting access to the course to only those who know the key, use of a group enrollment key means users are automatically added to the group when they enroll in the course. To use a group enrollment key, an enrollment key must be specified in the course settings as well as the group enrollment key in the group settings.';
$string['longtimenosee'] = 'Unenroll inactive after';
$string['longtimenosee_help'] = 'If users haven\'t accessed a course for a long time, then they are automatically unenrolled. This parameter specifies that time limit.';
$string['maxenrolled'] = 'Max enrolled users';
$string['maxenrolled_help'] = 'Specifies the maximum number of users that can self enroll. 0 means no limit.';
$string['maxenrolledreached'] = 'Maximum number of users allowed to self-enroll was already reached.';
$string['nopassword'] = 'No enrollment key required.';
$string['password'] = 'Enrollment key';
$string['password_help'] = 'An enrollment key enables access to the course to be restricted to only those who know the key. If the field is left blank, any user may enroll in the course. If an enrollment key is specified, any user attempting to enroll in the course will be required to supply the key. Note that a user only needs to supply the enrollment key ONCE, when they enroll in the course.';
$string['passwordinvalid'] = 'Incorrect enrollment key, please try again';
$string['passwordinvalidhint'] = 'That enrollment key was incorrect, please try again<br />
(Here\'s a hint - it starts with \'{$a}\')';
$string['pluginname'] = 'Self enrollment';
$string['pluginname_desc'] = 'The self enrollment plugin allows users to choose which courses they want to participate in. The courses may be protected by an enrollment key. Internally the enrollment is done via the manual enrollment plugin which has to be enabled in the same course.';
$string['requirepassword'] = 'Require enrollment key';
$string['requirepassword_desc'] = 'Require enrollment key in new courses and prevent removing of enrollment key from existing courses.';
$string['self:config'] = 'Configure self enroll instances';
$string['self:manage'] = 'Manage enrolled users';
$string['self:unenrol'] = 'Unenroll users from course';
$string['self:unenrolself'] = 'Unenroll self from the course';
$string['sendcoursewelcomemessage_help'] = 'If enabled, users receive a welcome message via email when they self-enroll in a course.';
$string['status'] = 'Allow self enrollments';
$string['status_desc'] = 'Allow users to self enroll into course by default.';
$string['status_help'] = 'This setting determines whether a user can enroll (and also unenroll if they have the appropriate permission) themselves from the course.';
$string['unenrol'] = 'Unenroll user';
$string['unenrolselfconfirm'] = 'Do you really want to unenroll yourself from course "{$a}"?';
$string['unenroluser'] = 'Do you really want to unenroll "{$a->user}" from course "{$a->course}"?';
$string['usepasswordpolicy_desc'] = 'Use standard password policy for enrollment keys.';
