<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
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
 * Replaces lang/[lang]/local.php from 1.1 series
 */

$string['pluginname'] = 'Totara core';

$string['core:createcoursecustomfield'] = 'Create a course custom field';
$string['core:updatecoursecustomfield'] = 'Update a course custom field';
$string['core:deletecoursecustomfield'] = 'Delete a course custom field';
$string['xpercentcomplete'] = '{$a} % complete';
$string['numberofactiveusers'] = '{$a} users have logged in to this site in the last year';
$string['lasterroroccuredat'] = 'Last error occured at {$a}';
$string['downloaderrorlog'] = 'Download error log';
$string['totaracopyright'] = '<p class="totara-copyright"><a href="http://www.totaralms.com">TotaraLMS</a> is a distribution of Moodle. A "distro" or distribution is a ready-made extended version of the standard product with its own particular focus and vision. Totara is specifically designed for the requirements of corporate, industry and vocational training in contrast to standard Moodle\'s traditional educational setting.</p><p class="totara-copyright"><a href="http://www.totaralms.com">TotaraLMS</a> extensions are Copyright &copy; 2010 onwards, Totara Learning Solutions Limited.</p>';
$string['totaralogo'] = 'Totara Logo';
// Course categories
$string['assessments'] = 'Assessments';
$string['bookings'] = 'Bookings';
$string['browse'] = 'Browse';
$string['browsecategories'] = 'Browse Categories';
$string['developmentplan'] = 'Development Planner';
$string['findcourses'] = 'Find Courses';
$string['mydevelopmentplans'] = 'My development plans';
$string['learningplans'] = 'Learning Plans';
$string['mylearning'] = 'My Learning';
$string['myprofile'] = 'My Profile';
$string['myrecordoflearning'] = 'My Record of Learning';
$string['recordoflearningfor'] = 'Record of Learning for ';
$string['notapplicable'] = 'Not applicable';
$string['notavailable'] = 'Not available';
$string['recordoflearning'] = 'Record of Learning';
$string['searchcourses'] = 'Search Courses';
$string['findcourses'] = 'Find Courses';
$string['viewmyteam'] = 'View My Team';

// My Course Completions block
$string['courseprogress']='Course progress';
$string['courseprogresshelp']='This specifies if the course progress block appears on the homepage';
$string['mycoursecompletions'] = 'My Course Completions';
$string['notenrolled'] = '<i>You are not currently enrolled in any courses.</i>';
$string['completed'] = 'Completed';
$string['enrolled'] = 'Enrolled';
$string['started'] = 'Started';

// Hierarchy
$string['hierarchies'] = 'Hierarchies';
$string['framework'] = 'Framework';
$string['template'] = 'Template';
$string['type'] = 'Type';

// Report Headings
$string['reportheading'] = 'Report heading block';
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
$string['editcompetencyevidence'] = 'Edit Competency Evidence Record';
$string['addcompetencyevidence'] = 'Add Competency Evidence Record';
$string['error:usernotfound'] = 'User not found';
$string['addforthisuser'] = 'Add new competency evidence for this user';
$string['selectaproficiency'] = 'Select a proficiency...';
$string['recordnotcreated'] = 'Record could not be created';
$string['recordnotupdated'] = 'Record could not be updated';
$string['selectanassessor'] = 'Select an assessor...';
$string['noassessors'] = 'No assessors found';
$string['firstselectcompetency'] = 'First select a competency';
$string['selectcompetency'] = 'Select a competency';
$string['deletecompetencyevidence'] = 'Delete Competency Evidence';
$string['confirmdeletece'] = 'Are you sure you want to delete this competency evidence record?';
$string['couldnotdeletece'] = 'Could not delete that competency evidence record.';
$string['alreadyselected'] = '(already selected)';

// Installation and Demo data
$string['totaraupgradefrom10'] = 'You cannot upgrade directly to {$a->attemptedversion} from {$a->currentversion}. Please upgrade to at least {$a->required} before attempting the upgrade to {$a->attemptedversion}.';
$string['moodlecore'] = 'Moodle core';
$string['totaracore'] = 'Totara core';
$string['totarapre11'] = 'Totara (pre version 1.1)';
$string['installingdemodata'] = 'Installing Demo Data';
$string['installdemoquestion'] = 'Do you want to include demo data with this installation?<br /><br />(This will take a long time.)';
$string['performinglocalpostinst'] = 'Local Post-installation setup';
$string['localpostinstfailed'] = 'There was a problem setting up local modifications to this installation.';
$string['totara11requiredupgradeversion'] = 'Totara 1.1.13';

// Report Headings
$string['reportheadings'] = 'Report Headings';
$string['myreports'] = 'My Reports';
$string['addanothercolumn'] = 'Add another column...';
$string['error:couldnotupdatereport'] = 'Could not update report';
$string['myteam'] = 'My Team';
$string['teammembers'] = 'Team Members';
$string['calendar'] = 'Calendar';
$string['myteaminstructionaltext'] = 'Choose a team member from the table on the right.';

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

//Course and Category icons
$string['icon'] = 'Icon';
$string['none'] = 'None';
$string['currenticon'] = 'Current icon';
$string['courseicon'] = 'Course icon';
$string['coursecategoryicon'] = 'Category icon';
$string['typeicon'] = 'Type icon';
$string['position_typeicon'] = 'Position type icon';
$string['competency_typeicon'] = 'Competency type icon';
$string['organisation_typeicon'] = 'Organisation type icon';

//Errors
$string['error:norolesfound'] = 'No roles found';
$string['error:notificationsparamtypewrong'] = 'Incorrect param type sent to Totara notifications';
$string['error:unknownbuttonclicked'] = 'Unknown button clicked';
$string['error:categoryidincorrect'] = 'Category ID was incorrect';
$string['error:dashboardnotfound'] = 'Cannot fully initialize page - could not retrieve dashboard details';
$string['error:duplicaterecordsfound'] = '{$a->count} duplicate record(s) found in the {$a->tablename} table...fixing (see error log for details)';
$string['error:duplicaterecordsdeleted'] = 'Duplicate {$a} record deleted: ';
//My Team strings
$string['teammembers_text'] = 'All members of your teams are show below.';
$string['nostaffassigned'] = 'You currently do not have a team.';
$string['numberofstaff'] = '({$a} staff)';
//Course Types
$string['coursetype'] = 'Course Type';
$string['elearning'] = 'E-learning';
$string['blended'] = 'Blended';
$string['facetoface'] = 'Face-to-face';

?>
