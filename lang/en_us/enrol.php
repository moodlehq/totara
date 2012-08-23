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
 * Strings for component 'enrol', language 'en_us', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actenrolshhdr'] = 'Available course enrollment plugins';
$string['deleteinstanceconfirm'] = 'Do you really want to delete enroll plugin instance "{$a->name}" with {$a->users} enrolled users?';
$string['enrol'] = 'Enroll';
$string['enrolcandidates'] = 'Not enrolled users
';
$string['enrolcandidatesmatching'] = 'Matching not enrolled users
';
$string['enrolcohort'] = 'Enroll cohort';
$string['enrolcohortusers'] = 'Enroll users';
$string['enrollednewusers'] = 'Successfully enrolled {$a} new users';
$string['enrolledusers'] = 'Enrolled users';
$string['enrolledusersmatching'] = 'Matching enrolled users
';
$string['enrolme'] = 'Enroll me in this course';
$string['enrolmentinstances'] = 'Enrollment methods';
$string['enrolmentnew'] = 'New enrollment in {$a}';
$string['enrolmentnewuser'] = '{$a->user} has enrolled in course "{$a->course}"';
$string['enrolmentoptions'] = 'Enrollment options';
$string['enrolments'] = 'Enrollments';
$string['enrolnotpermitted'] = 'You do not have permission or are not allowed to enroll someone in this course';
$string['enrolperiod'] = 'Enrollment duration';
$string['enroltimeend'] = 'Enrollment ends';
$string['enroltimestart'] = 'Enrollment starts';
$string['enrolusage'] = 'Instances / enrollments';
$string['enrolusers'] = 'Enroll users';
$string['errajaxfailedenrol'] = 'Failed to enroll user';
$string['erroreditenrolment'] = 'An error occurred while trying to edit a users enrollment
';
$string['errorenrolcohort'] = 'Error creating cohort sync enrollment instance in this course.';
$string['errorenrolcohortusers'] = 'Error enrolling cohort members in this course.
';
$string['errorwithbulkoperation'] = 'There was an error while processing your bulk enrollment change.
';
$string['extremovedaction'] = 'External unenroll action';
$string['extremovedaction_help'] = 'Select action to carry out when user enrollment disappears from external enrollment source. Please note that some user data and settings are purged from course during course unenrollment.';
$string['extremovedkeep'] = 'Keep user enrolled';
$string['extremovedsuspend'] = 'Disable course enrollment';
$string['extremovedsuspendnoroles'] = 'Disable course enrollment and remove roles';
$string['extremovedunenrol'] = 'Unenroll user from course';
$string['finishenrollingusers'] = 'Finish enrolling users
';
$string['invalidenrolinstance'] = 'Invalid enrollment instance';
$string['manageenrols'] = 'Manage enroll plugins';
$string['notenrollable'] = 'You can not enroll yourself in this course.';
$string['otheruserdesc'] = 'The following users are not enrolled in this course but do have roles, inherited or assigned within it.
';
$string['totalenrolledusers'] = '{$a} enrolled users';
$string['unenrol'] = 'Unenroll';
$string['unenrolconfirm'] = 'Do you really want to unenroll user "{$a->user}" from course "{$a->course}"?';
$string['unenrolme'] = 'Unenroll me from {$a}';
$string['unenrolnotpermitted'] = 'You do not have permission or can not unenroll this user from this course.';
$string['unenrolroleusers'] = 'Unenroll users';
$string['uninstallconfirm'] = 'You are about to completely delete the enroll plugin \'{$a}\'. This will completely delete everything in the database associated with this enrollment type. Are you SURE you want to continue?';
$string['uninstalldeletefiles'] = 'All data associated with the enroll plugin \'{$a->plugin}\' has been deleted from the database. To complete the deletion (and prevent the plugin re-installing itself), you should now delete this directory from your server: {$a->directory}';
