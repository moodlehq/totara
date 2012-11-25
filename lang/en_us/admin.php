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
 * Strings for component 'admin', language 'en_us', branch 'MOODLE_22_STABLE'
 *
 * @package   admin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['availablelicenses'] = 'Available licenses';
$string['backgroundcolour'] = 'Transparent color';
$string['configallowunenroll'] = 'If this is set \'Yes\', then students are allowed to unenroll themselves from courses whenever they like. Otherwise they are not allowed, and this process will be solely controlled by the teachers and administrators.';
$string['configdefaultcourseroleid'] = 'Users who enroll in a course will be automatically assigned this role.';
$string['configenrolmentplugins'] = 'Please choose the enrollment plugins you wish to use. Don\'t forget to configure the settings properly.<br /><br />You have to indicate which plugins are enabled, and <strong>one</strong> plugin can be set as the default plugin for <em>interactive</em> enrollment. To disable interactive enrollment, set "enrollable" to "No" in required courses.';
$string['confignavcourselimit'] = 'Limits the number of courses shown to the user when they are either not logged in or are not enrolled in any courses.';
$string['confignavshowcategories'] = 'Show course categories in the navigation bar and navigation blocks. This does not occur with courses the user is currently enrolled in, they will still be listed under mycourses without categories.';
$string['confignonmetacoursesyncroleids'] = 'By default all role assignments from child courses are synchronized to metacourses. Roles that are selected here will not be included in the synchronization process.';
$string['configprofilesforenrolledusersonly'] = 'To prevent misuse by spammers, profile descriptions of users who are not yet enrolled in any course are hidden. New users must enroll in at least one course before they can add a profile description.';
$string['configsendcoursewelcomemessage'] = 'If enabled, users receive a welcome message via email when they self-enroll in a course.';
$string['configsessioncookie'] = 'This setting customizes the name of the cookie used for Totara sessions. This is optional, and only useful to avoid cookies being confused when there is more than one copy of Totara running within the same web site.';
$string['configsessioncookiedomain'] = 'This allows you to change the domain that the Totara cookies are available from. This is useful for Totara customizations (e.g. authentication or enrollment plugins) that need to share Totara session information with a web application on another subdomain. <strong>WARNING: it is strongly recommended to leave this setting at the default (empty) - an incorrect value will prevent all logins to the site.</strong>';
$string['configsitedefaultlicense'] = 'Default site license';
$string['configsitedefaultlicensehelp'] = 'The default license for publishing content on this site';
$string['configstatscatdepth'] = 'Statistics code uses simplified course enrollment logic, overrides are ignored and there is a maximum number of verified parent course categories. Number 0 means detect only direct role assignments on site and course level, 1 means detect also role assignments in parent category of course, etc. Higher numbers result in much higher database server load during stats processing.';
$string['configstatsuserthreshold'] = 'Show course categories in the navigation bar and navigation blocks. This does not occur with courses the user is currently enrolled in, they will still be listed under mycourses without categories.';
$string['creatornewroleid_help'] = 'Show course categories in the navigation bar and navigation blocks. This does not occur with courses the user is currently enrolled in, they will still be listed under mycourses without categories.';
$string['datarootsecurityerror'] = '<p><strong>SECURITY WARNING!</strong></p><p>Your dataroot directory is in the wrong location and is exposed to the web. This means that all your private files are available to anyone in the world, and some of them could be used by a cracker to obtain unauthorized administrative access to your site!</p>
<p>You <em>must</em> move dataroot directory ({$a}) to a new location that is not within your public web directory, and update the <code>\$CFG->dataroot</code> setting in your config.php accordingly.</p>';
$string['enrolinstancedefaults'] = 'Enrollment instance defaults';
$string['enrolinstancedefaults_desc'] = 'Default enrollment settings in new courses.';
$string['enrolmentkey_help'] = '# Course Enrollment Key
A course enrollment key is what keeps unwanted people out of your course.
If you leave this blank, then anyone who has created a Moodle username on this site will be able to enroll in your course simply by going in to it.
If you put something here, then students who are trying to get in for the FIRST TIME ONLY will be asked to supply this word or phrase.
The idea is that you will supply the key to authorized people using another means like private email, snail mail, on the phone or even verbally in a face to face class.
If this password "gets out" and you have unwanted people enrolling, you can unenroll them (see their user profile page) and change this key. Any legitimate students who have already enrolled will not be affected, but the unwanted people won\'t be able to get back in.';
$string['enrolmultipleusers'] = 'Enroll the users';
$string['groupenrolmentkeypolicy'] = 'Group enrollment key policy';
$string['groupenrolmentkeypolicy_desc'] = 'Turning this on will make Moodle check group enrollment keys against a valid password policy.';
$string['guestaccess_help'] = '# Guest Access
You have the choice of allowing "guests" into your course.
People can log in as guests using the "Login as a guest" button on the login screen.
Guests ALWAYS have "read-only" access - meaning they can\'t leave any posts or otherwise mess up the course for real students.
This can be handy when you want to let a colleague in to look around at your work, or to let students see a course before they have decided to enroll.
Note that you have a choice between two types of guest access: with the enrollment key or without. If you choose to allow guests who have the key, then the guest will need to provide the current enrollment key EVERY TIME they log in (unlike students who only need to do it once). This lets you restrict your guests. If you choose to allow guests without a key, then anyone can get straight into your course.';
$string['guestroleid_help'] = 'This role is automatically assigned to the guest user. It is also temporarily assigned to not enrolled users that enter the course via guest enrollment plugin.';
$string['helpweekenddays'] = 'Which days of the week are treated as "weekend" and shown with a different color?';
$string['licensesettings'] = 'License settings';
$string['managelicenses'] = 'Manage licenses';
$string['manageqbehaviours'] = 'Manage question behaviors';
$string['nonmetacoursesyncroleids'] = 'Roles that are not synchronized to metacourses';
$string['orgname'] = 'Organization name';
$string['orgnamehelp'] = 'The name of your organization.';
$string['profilesforenrolledusersonly'] = 'Profiles for enrolled users only';
$string['questionbehaviours'] = 'Question behaviors';
$string['requiredentrieschanged'] = '<strong>IMPORTANT - PLEASE READ<br/>(This warning message will only be displayed during this upgrade)</strong><br/>Due to a bug fix, the behavior of database activities using the \'Required entries\' and \'Required entries before viewing settings\' settings will change. A more detailed explanation of the changes can be read on <a href="http://moodle.org/mod/forum/discuss.php?d=110928" target="_blank">the database module forum</a>. The expected behavior of these settings can also be read on <a href="http://docs.moodle.org/en/Adding/editing_a_database#Required_entries" target="_blank">Moodle Docs</a>.';
$string['riskconfig'] = 'Users could change site configuration and behavior';
