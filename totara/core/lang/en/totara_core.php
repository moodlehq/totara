<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @package totara
 * @subpackage totara_core
 *
 * totara_core specific language strings.
 * these should be called like get_string('key', 'totara_core');
 */

$string['pluginname'] = 'Totara core';
$string['totaraversion'] = 'Totara Version';

// Assignment class strings.
$string['assigngroup'] = 'Assign User Group';
$string['assignincludechildren'] = ' and all below';
$string['assignedvia'] = 'Assigned Via';
$string['error:assignmentprefixnotfound'] = 'Assignment class for group type {$a} not found';
$string['error:assignmentbadparameters'] = 'Bad parameter array passed to dialog set_parameters';
$string['error:assignmentmoduleinstancelocked'] = 'You cannot make changes to an assignment module instance which is locked';
$string['error:assignmentgroupnotallowed'] = 'You cannot assign groups of type {$a->grouptype} to {$a->module}';
$string['error:assigntablenotexist'] = 'Assignment table {$a} does not exist!';
$string['error:assigncannotdeletegrouptypex'] = 'You cannot delete groups of type {$a}';

// Datatable language strings.
$string['datatable:sEmptyTable'] = 'No data available in table';
$string['datatable:sInfo'] = 'Showing _START_ to _END_ of _TOTAL_ entries';
$string['datatable:sInfoEmpty'] = 'Showing 0 to 0 of 0 entries';
$string['datatable:sInfoFiltered'] = '(filtered from _MAX_ total entries)';
$string['datatable:sInfoPostFix'] = '';
$string['datatable:sInfoThousands'] = ',';
$string['datatable:sLengthMenu'] = 'Show _MENU_ entries';
$string['datatable:sLoadingRecords'] = 'Loading...';
$string['datatable:sProcessing'] = 'Processing...';
$string['datatable:sSearch'] = 'Search:';
$string['datatable:sZeroRecords'] = 'No matching records found';
$string['datatable:oPaginate:sFirst'] = 'First';
$string['datatable:oPaginate:sLast'] = 'Last';
$string['datatable:oPaginate:sNext'] = 'Next';
$string['datatable:oPaginate:sPrevious'] = 'Previous';

//Totara-only strings removed from Moodle plugins
$string['notimplementedtotara'] = 'Sorry, this feature is only implemented on MySQL, MSSQL and PostgreSQL databases.';
$string['remotetotaralangnotavailable'] = 'Because Totara can not connect to download.totaralms.com, we are unable to do language pack installation automatically. Please download the appropriate zip file(s) from http://download.totaralms.com/lang/T{$a->totaraversion}/, copy them to your {$a->langdir} directory and unzip them manually.';
$string['cannotdownloadtotaralanguageupdatelist'] = 'Cannot download list of language updates from download.totaralms.com';
$string['unexpected_installer_result'] = 'Unspecified component install error: {$a}';
$string['pluginnamewithkey'] = 'Self enrolment with key';
$string['siteregistrationemailbody'] = 'Site {$a} was not able to register itself automatically. Access to push data to our registrations site is probably blocked by a firewall.';
$string['totarabuild'] = 'Totara build number';
$string['debugstatus'] = 'Debug status';
$string['totararegistration'] = 'Totara Registration';
$string['totararegistrationinfo'] = '<p>This page configures registration updates which are sent to totaralms.com.
These updates allow Totara to know what versions of Totaralms and support software you are running.
This information will allow Totara to better examine and resolve any support issues you face in the future.</p>
<p>This information will be securely transmitted and held in confidence.</p>';
$string['totararelease'] = 'Totara release identifier';
$string['totaraversion'] = 'Totara version number';
$string['configforcelogintotara'] = 'Normally, the entire site is only available to logged in users. If you would like to make the front page and the course listings (but not the course contents) available without logging in, then you should uncheck this setting.';
//date picker variables
$string['datepickerdisplayformat'] = 'dd/mm/yy'; //how the datepicker displays the date, see jQuery documentation
$string['datepickerplaceholder'] = 'dd/mm/yyyy'; //how the datepicker placeholder hint displays the default
$string['datepickerparseformat'] = 'd/m/Y'; //how php parses the datepicker dates to a timestamp (in totara_date_parse_from_format)
$string['datepickerregexjs'] = '[0-3][0-9]/(0|1)[0-9]/[0-9]{4}';
$string['datepickerregexphp'] = '/^(0?[1-9]|[12][0-9]|3[01])\/(0?[1-9]|1[0-2])\/(\d{4})$/';
$string['datepickerphpuserdate'] = '%d/%m/%Y';
$string['strftimedateshortmonth'] = '%d %b %Y';
$string['csvdateformat'] = 'CSV Import date format';
$string['csvdateformatdefault'] = 'd/m/Y';
$string['csvdateformatconfig'] = 'Date format to be used in CSV imports like user uploads with date custom profile fields, or Totara Sync.

The date format should be compatible with the formats defined in the <a target="_blank" href="http://www.php.net/manual/en/datetime.createfromformat.php">PHP DateTime class</a>

Examples:
<ul>
<li>d/m/Y if the dates in the CSV are of the form 21/03/2012</li>
<li>d/m/y if the dates in the CSV have 2-digit years 21/03/12</li>
<li>m/d/Y if the dates in the CSV are in US form 03/21/2012</li>
<li>Y-m-d if the dates in the CSV are in ISO form 2012-03-21</li>
</ul>';

$string['core:createcoursecustomfield'] = 'Create a course custom field';
$string['core:updatecoursecustomfield'] = 'Update a course custom field';
$string['core:deletecoursecustomfield'] = 'Delete a course custom field';
$string['xpercent'] = '{$a}%';
$string['xpercentcomplete'] = '{$a} % complete';
$string['xofy'] = '{$a->count} / {$a->total}';
$string['numberofactiveusers'] = '{$a} users have logged in to this site in the last year';
$string['lasterroroccuredat'] = 'Last error occured at {$a}';
$string['downloaderrorlog'] = 'Download error log';
$string['totaracopyright'] = '<p class="totara-copyright"><a href="http://www.totaralms.com">TotaraLMS</a> is a distribution of Moodle. A "distro" or distribution is a ready-made extended version of the standard product with its own particular focus and vision. Totara is specifically designed for the requirements of corporate, industry and vocational training in contrast to standard Moodle\'s traditional educational setting.</p><p class="totara-copyright"><a href="http://www.totaralms.com">TotaraLMS</a> extensions are Copyright &copy; 2010 onwards, Totara Learning Solutions Limited.</p>';
$string['totaralogo'] = 'Totara Logo';
$string['totaramenu'] = 'Totara Menu';
$string['requiresjs'] = 'This {$a} requires Javascript to be enabled.';
$string['error:cannotupgradefromtotara'] = 'You cannot upgrade to Totara 2.4 from this version of Totara. Please upgrade to Totara 2.2.13 or greater first.';
$string['error:cannotupgradefrommoodle'] = 'You cannot upgrade to Totara 2.4 from a Moodle version prior to 2.2.7. Please upgrade to Totara 2.2.13+ or Moodle 2.2.7+ first.';
$string['error:autoupdatedisabled'] = 'Automatic checking for Moodle updates is currently disabled in Totara';

// Course categories
$string['assessments'] = 'Assessments';
$string['bookings'] = 'Bookings';
$string['browse'] = 'Browse';
$string['browsecategories'] = 'Browse Categories';
$string['couldntreaddataforblockid'] = 'Could not read data for blockid={$a}';
$string['couldntreaddataforcourseid'] = 'Could not ready data for courseid={$a}';
$string['developmentplan'] = 'Development Planner';
$string['elementlibrary'] = 'Element Library';
$string['errorfindingcategory'] = 'Error finding the category';
$string['errorfindingprogram'] = 'Error finding the program';
$string['mydevelopmentplans'] = 'My development plans';
$string['learningplans'] = 'Learning Plans';
$string['mylearning'] = 'My Learning';
$string['myprofile'] = 'My Profile';
$string['myrecordoflearning'] = 'My Record of Learning';
$string['recordoflearningfor'] = 'Record of Learning for ';
$string['notapplicable'] = 'Not applicable';
$string['notavailable'] = 'Not available';
$string['progdoesntbelongcat'] = 'The program doesn\'t belong to this category';
$string['recordoflearning'] = 'Record of Learning';
$string['searchx'] = 'Search {$a}';
$string['searchcourses'] = 'Search Courses';
$string['findcourses'] = 'Find Courses';
$string['viewmyteam'] = 'View My Team';

//Dialogs
$string['browse'] = 'Browse';
$string['currentlyselected'] = 'Currently selected';
$string['error:dialognotreeitems'] = 'No items available';
$string['error:morethanxitemsatthislevel'] = 'There are more than {$a} items at this level.';
$string['invalidsearchtable'] = 'Invalid search table';
$string['itemstoadd'] = 'Items to add';
$string['noresultsfor'] = 'No results found for "{$a->query}".';
$string['xresultsfory'] = '<strong>{$a->count}</strong> results found for "{$a->query}"';
$string['queryerror'] = 'Query error. No results found.';
$string['search'] = 'Search';
$string['trysearchinginstead'] = 'Try searching instead.';
// My Course Completions block
$string['courseprogress']='Course progress';
$string['courseprogresshelp']='This specifies if the course progress block appears on the homepage';
$string['mycoursecompletions'] = 'My Course Completions';
$string['notenrolled'] = '<em>You are not currently enrolled in any courses.</em>';
$string['completed'] = 'Completed';
$string['enrolled'] = 'Enrolled';
$string['started'] = 'Started';

// Hierarchy
$string['hierarchies'] = 'Hierarchies';
$string['framework'] = 'Framework';
$string['template'] = 'Template';
$string['type'] = 'Type';

// Report Headings
$string['headingcolumnsdescription'] = 'The fields below define which data appear in the Report Heading Block. This block contains information about a specific user, and can appear in many locations throughout the site.';
$string['editheading'] = 'Edit the Report Heading Block';
$string['headingmissingvalue'] = 'Value to display if no data found';
$string['reportedat'] = 'Reported at';
$string['notfound'] = 'Not found';
$string['managers'] = 'Manager\'s ';
$string['positionsarrow'] = 'Positions > ';
$string['organisationsarrow'] = 'Organisations > ';
$string['error:columntypenotfound'] = 'The column type \'{$a}\' was defined but is not a valid option. This can happen if you have deleted a custom field or hierarchy depth level. The best course of action is to delete this column by pressing the red cross to the right.';
$string['error:columntypenotfound11'] = 'The column type \'{$a}\' was defined but is not a valid option. This can happen if you have deleted a custom field or hierarchy type. The best course of action is to delete this column by pressing the red cross to the right.';
$string['error:couldnotcreatedefaultfields'] = 'Could not create default fields';

// Add/Edit competency evidence
$string['error:unknownbuttonclicked'] = 'Unknown Button Clicked';
$string['participant'] = 'Participant';
$string['assessor'] = 'Assessor';
$string['assessorname'] = 'Assessor Name';
$string['assessmenttype'] = 'Assessment Type';
$string['proficiency'] = 'Proficiency';
$string['positionatcompletion'] = 'Position at completion';
$string['organisationatcompletion'] = 'Organisation at completion';
$string['timecompleted'] = 'Time completed';
$string['error:usernotfound'] = 'User not found';
$string['selectaproficiency'] = 'Select a proficiency...';
$string['recordnotcreated'] = 'Record could not be created';
$string['recordnotupdated'] = 'Record could not be updated';
$string['selectanassessor'] = 'Select an assessor...';
$string['noassessors'] = 'No assessors found';
$string['alreadyselected'] = '(already selected)';

// Installation and Demo data
$string['totaraunsupportedupgradepath'] = 'You cannot upgrade directly to {$a->attemptedversion} from {$a->currentversion}. Please upgrade to at least {$a->required} before attempting the upgrade to {$a->attemptedversion}.';
$string['moodlecore'] = 'Moodle core';
$string['totaracore'] = 'Totara core';
$string['installingdemodata'] = 'Installing Demo Data';
$string['installdemoquestion'] = 'Do you want to include demo data with this installation?<br /><br />(This will take a long time.)';
$string['performinglocalpostinst'] = 'Local Post-installation setup';
$string['localpostinstfailed'] = 'There was a problem setting up local modifications to this installation.';
$string['totararequiredupgradeversion'] = 'Totara 2.2.13';
$string['poweredby'] = 'Powered by TotaraLMS';
$string['cliupgradesure'] = 'Your Totara files have been changed, and you are about to automatically upgrade your server from this version:
<br /><br /><strong>{$a->oldversion}</strong>
<br /><br />to this version: <br /><br />
<strong>{$a->newversion}</strong> <br /><br />
Once you do this you can not go back again. <br /><br />
Please note that this process can take a long time. <br /><br />
Are you sure you want to upgrade this server to this version?';

$string['myreports'] = 'My Reports';
$string['addanothercolumn'] = 'Add another column...';
$string['error:couldnotupdatereport'] = 'Could not update report';
$string['myteam'] = 'My Team';
$string['myteamsettings'] = 'My team settings';
$string['teammembers'] = 'Team Members';
$string['calendar'] = 'Calendar';
$string['myteaminstructionaltext'] = 'Choose a team member from the table on the right.';
$string['error:staffmanagerroleexists'] = 'A role "staffmanager" already exists. This role must be renamed before the upgrade can proceed.';
$string['error:importtimezonesfailed'] = 'Failed to update timezone information.';
$string['importtimezonessuccess'] = 'Timezone information updated from source {$a}.';
$string['importtimezonesskipped'] = 'Skipped updating timezone information.';
// Course competencies
$string['returntocourse'] = 'Return to the course';

// Face-to-face
$string['alllearningrecords'] = 'All Learning Records';
$string['allf2fbookings'] = 'All Face to Face Bookings';
$string['learningrecords'] = 'Learning Records';
$string['f2fbookings'] = 'Face to Face Bookings';
$string['allteammembers'] = 'All Team Members';
$string['mycoursecompletions'] = 'My Course Completions';
$string['coursecompletionsfor'] = 'Course Completions for ';
$string['mybookings'] = 'My Bookings';
$string['mypastbookings'] = 'My Past Bookings';
$string['myfuturebookings'] = 'My Future Bookings';
$string['bookingsfor'] = 'Bookings for ';
$string['pastbookingsfor'] = 'Past Bookings for ';
$string['tab:futurebookings'] = 'Future Bookings';
$string['tab:pastbookings'] = 'Past Bookings';
$string['allmycourses'] = 'All My Courses';
$string['completed'] = 'Completed';
$string['inprogress'] = 'In Progress';
$string['startdate'] = 'Start Date';

// Table strings
$string['options'] = 'Options';
$string['report'] = 'Report';
$string['moveup'] = 'Move Up';
$string['movedown'] = 'Move Down';
$string['delete'] = 'Delete';
$string['column'] = 'Column';
$string['heading'] = 'Heading';
$string['settings'] = 'Settings';

//Icon Strings
$string['icon'] = 'Icon';
$string['none'] = 'None';
$string['currenticon'] = 'Current icon';
$string['courseicon'] = 'Course icon';
$string['programicon'] = 'Program icon';
$string['coursecategoryicon'] = 'Category icon';
$string['typeicon'] = 'Type icon';
$string['position_typeicon'] = 'Position type icon';
$string['competency_typeicon'] = 'Competency type icon';
$string['organisation_typeicon'] = 'Organisation type icon';

//Errors
$string['error:courseidincorrect'] = 'Course id is incorrect.';
$string['error:useridincorrect'] = 'User id is incorrect.';
$string['error:norolesfound'] = 'No roles found';
$string['error:notificationsparamtypewrong'] = 'Incorrect param type sent to Totara notifications';
$string['error:unknownbuttonclicked'] = 'Unknown button clicked';
$string['error:categoryidincorrect'] = 'Category ID was incorrect';
$string['error:dashboardnotfound'] = 'Cannot fully initialize page - could not retrieve dashboard details';
$string['error:duplicaterecordsfound'] = '{$a->count} duplicate record(s) found in the {$a->tablename} table...fixing (see error log for details)';
$string['error:duplicaterecordsdeleted'] = 'Duplicate {$a} record deleted: ';
$string['error:positionnotselected'] = 'Please select a position';
$string['error:organisationnotselected'] = 'Please select an organisation';
$string['error:managernotselected'] = 'Please select a manager';
$string['error:addpdroom-dialognotselected'] = 'Please select a room';
//My Team strings
$string['teammembers_text'] = 'All members of your teams are show below.';
$string['nostaffassigned'] = 'You currently do not have a team.';
$string['numberofstaff'] = '({$a} staff)';
//Course Types
$string['coursetype'] = 'Course Type';
$string['elearning'] = 'E-learning';
$string['blended'] = 'Blended';
$string['facetoface'] = 'Face-to-face';
//Button labels
$string['save'] = 'Save';

$string['pos_description'] = 'Description';
$string['pos_description_help'] = 'Description of the position';

$string['staffmanager'] = 'Staff Manager';
$string['sitemanager'] = 'Site Manager';

$string['coursecompletion'] = 'Course completion';

// User delete/undelete
$string['deleted'] = 'Deleted';
$string['undelete'] = 'Undelete';
$string['undeletecheckfull'] = 'Are you sure you want to undelete {$a}?';
$string['undeletedx'] = 'Undeleted {$a}';
$string['undeleteuser'] = 'Undelete User';
$string['undeleteusernoperm'] = 'You do not have the required permission to undelete a user';
$string['userdoesnotexist'] = 'User does not exist';
$string['cannotundeleteuser'] = 'Cannot undelete user';
$string['undeletednotx'] = 'Could not undelete {$a} !';
$string['core:seedeletedusers'] = 'See deleted users';
$string['core:undeleteuser'] = 'Undelete user';
$string['core:appearance'] = 'Configure site appearance settings';

$string['ampersand'] = 'and';

// Version check
$string['unsupported_branch_text'] = 'The version you are using ({$a})  is no longer supported. That means that bugs and security issues are no longer being fixed. You should upgrade to a supported version (such as [[CURRENT_MAJOR_VERSION]]) as soon as possible';
$string['old_release_text_singular'] = 'You are not using the most recent release available for this version. There is 1 new release available ';
$string['old_release_text_plural'] = 'You are not using the most recent release available for this version. There are [[ALLTYPES_COUNT]] new releases available ';
$string['old_release_security_text_singular'] = ' (including 1 new security release)';
$string['old_release_security_text_plural'] = ' (including [[SECURITY_COUNT]] new security releases)';
$string['supported_branch_text'] = 'You may want to consider upgrading from {$a} to the most recent version ([[CURRENT_MAJOR_VERSION]]) to benefit from the latest features';
$string['supported_branch_old_release_text'] = 'You may also want to consider upgrading from {$a} to the most recent version ([[CURRENT_MAJOR_VERSION]]) to benefit from the latest features';
$string['totarareleaselink'] = 'See the <a href="http://community.totaralms.com/mod/forum/view.php?id=819\" target=\"_blank\">release notes</a> for more details.';

// Temporary managers.
$string['xpositions'] = '{$a}\'s Positions';
$string['tempmanager'] = 'Temporary manager';
$string['choosetempmanager'] = 'Choose temporary manager';
$string['choosetempmanager_help'] = 'A temporary manager can be assigned. The assigned Temporary Manager will have the same rights as a normal manager, for the specified amount of time.

Click **Choose temporary manager** to select a temporary manager.

If the name you are looking for does not appear in the list, it might be that the user does not have the necessary rights to act as a temporary manager.';
$string['tempmanagerexpiry'] = 'Temporary manager expiry date';
$string['tempmanagerexpiry_help'] = 'Click the calendar icon to select the date the temporary manager will expire.';
$string['core:delegateownmanager'] = 'Assign a temporary manager to yourself';
$string['core:delegateusersmanager'] = 'Assign a temporary manager to other users';
$string['tempmanagers'] = 'Temporary managers';
$string['enabletempmanagers'] = 'Enable temporary managers';
$string['enabletempmanagersdesc'] = 'Enable functionality that allows for assigning a temporary manager to a user. Disabling this will cause all current temporary managers to be unassigned on next cron run.';
$string['tempmanagerrestrictselection'] = 'Temporary manager selection';
$string['tempmanagerrestrictselectiondesc'] = 'Determine which users will be available in the temporary manager selection dialog. Selecting \'Only staff managers\' will remove any assigned temporary managers who don\'t have the \'staff manager\' role on the next cron run.';
$string['tempmanagerselectionallusers'] = 'All users';
$string['tempmanagerselectiononlymanagers'] = 'Only staff managers';
$string['tempmanagerexpirydays'] = 'Temporary manager expiry days';
$string['tempmanagerexpirydaysdesc'] = 'Set a default temporary manager expiry period (in days).';
$string['unassignall'] = 'Unassign all';
$string['error:tempmanagernotset'] = 'Temporary manager needs to be set';
$string['error:tempmanagernotselected'] = 'No temporary manager selected';
$string['error:tempmanagerexpirynotset'] = 'An expiry date for the temporary manager needs to be set';
$string['error:datenotinfuture'] = 'The date needs to be in the future';
$string['manager(s)'] = 'Manager(s)';
$string['tempmanagersupporttext'] = ' Note, only current team managers can be selected.';
$string['tempmanagerassignmsgstaffsubject'] = '{$a->tempmanager} is now your temporary manager';
$string['tempmanagerassignmsgmgrsubject'] = '{$a->tempmanager} is now temporary manager for {$a->staffmember}';
$string['tempmanagerassignmsgtmpmgrsubject'] = 'You are now {$a->staffmember}\'s temporary manager';
$string['tempmanagerassignmsgmgr'] = '{$a->tempmanager} has been assigned as temporary manager to {$a->staffmember} (one of your team members).<br>Temporary manager expiry: {$a->expirytime}.<br>View details <a href="{$a->url}">here</a>.';
$string['tempmanagerassignmsgtmpmgr'] = 'You have been assigned as temporary manager to {$a->staffmember}.<br>Temporary manager expiry: {$a->expirytime}.<br>View details <a href="{$a->url}">here</a>.';
$string['tempmanagerassignmsgstaff'] = '{$a->tempmanager} has been assigned as temporary manager to you.<br>Temporary manager expiry: {$a->expirytime}.<br>View details <a href="{$a->url}">here</a>.';

$string['tempmanagerexpiryupdatemsgstaffsubject'] = 'Expiry date updated for your temporary manager';
$string['tempmanagerexpiryupdatemsgmgrsubject'] = 'Expiry date updated for {$a->staffmember}\'s temporary manager';
$string['tempmanagerexpiryupdatemsgtmpmgrsubject'] = 'Temporary manager expiry updated for {$a->staffmember}';
$string['tempmanagerexpiryupdatemsgmgr'] = 'The expiry date for {$a->staffmember}\'s temporary manager ({$a->tempmanager}) has been updated to {$a->expirytime}.<br>View details <a href="{$a->url}">here</a>.';
$string['tempmanagerexpiryupdatemsgtmpmgr'] = 'Your expiry date as temporary manager for {$a->staffmember} has been updated to {$a->expirytime}.<br>View details <a href="{$a->url}">here</a>.';
$string['tempmanagerexpiryupdatemsgstaff'] = 'The expiry date for {$a->tempmanager} (your temporary manager) has been updated to {$a->expirytime}.<br>View details <a href="{$a->url}">here</a>.';

$string['managecertifications'] = 'Manage certifications';
$string['archivecompletionrecords'] = 'Archive completion records';
$string['uploadcompletionrecords'] = 'Upload completion records';
$string['modulearchive'] = 'Activity archives';
