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
 * Strings for component 'cohort', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package    moodlecore
 * @subpackage cohort
 * @copyright  2010 Petr Skoda (info@skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Totara Cohorts';
$string['addcohort'] = 'Create New Cohort';
$string['anycohort'] = 'Any';
$string['assign'] = 'Assign';
$string['assignto'] = 'Cohort \'{$a}\' members';
$string['backtocohorts'] = 'Back to cohorts';
$string['cohort'] = 'Cohort';
$string['cohorts'] = 'Cohorts';
$string['cohortsin'] = 'Available Cohorts';
$string['cohort:assign'] = 'Assign cohort members';
$string['cohort:manage'] = 'Manage cohorts';
$string['cohort:view'] = 'Use cohorts and view members';
$string['component'] = 'Source';
$string['currentusers'] = 'Current users';
$string['currentusersmatching'] = 'Current users matching';
$string['delcohort'] = 'Delete cohort';
$string['delconfirm'] = 'Do you really want to delete cohort \'{$a}\'?';
$string['description'] = 'Description';
$string['duplicateidnumber'] = 'Cohort with the same ID number already exists';
$string['editcohort'] = 'Edit cohort';
$string['idnumber'] = 'ID';
$string['memberscount'] = 'Size';
$string['name'] = 'Name';
$string['nocomponent'] = 'Created manually';
$string['potusers'] = 'Potential users';
$string['potusersmatching'] = 'Potential matching users';
$string['selectfromcohort'] = 'Select members from cohort';
$string['type'] = 'Type';
$string['dynamiccohortcriteria'] = 'Dynamic Cohort Criteria';
$string['dynamiccohortcriterialower'] = 'Dynamic cohort criteria';
$string['userprofilefield'] = 'User profile field';
$string['criteria'] = 'Criteria';
$string['profilefieldvalues'] = 'Values';
$string['role'] = 'Role';
$string['positionincludechildren'] = 'Include children';
$string['orgincludechildren'] = 'Include children';
$string['orgincludechildren_title'] = 'Include children';
$string['organisation'] = 'Organisation';
$string['assignmemberstocohort'] = 'Assign members to cohort';
$string['createnewcohort'] = 'Create new cohort';
$string['createdynamiccohort'] = 'Create dynamic cohort';
$string['confirmdynamiccohortcreation'] = 'Confirm Dynamic Cohort Creation';
$string['abouttocreate'] = 'You are about to create a new cohort called "{$a}"';
$string['thiscohortwillhave'] = 'This cohort will have {$a} members at this point in time';
$string['cannoteditcohort'] = 'This cohort can not be edited once created';
$string['dynamic'] = 'Dynamic';
$string['set'] = 'Set';
$string['criteriaoptional'] = 'All criteria is optional but you have to select at least one option.';
$string['notvalidprofilefield'] = 'Please select a valid profile field';
$string['mustselectonecriteria'] = 'You must select at least one criteria';
$string['nocriteriaset'] = '(no criteria set, delete this cohort)';
$string['overview'] = 'Overview';
$string['editdetails'] = 'Edit details';
$string['viewmembers'] = 'View members';
$string['editmembers'] = 'Edit members';
$string['members'] = 'Members';
$string['deletethiscohort'] = 'Delete this cohort';
$string['successfullyupdated'] = 'Successfully updated cohort';
$string['cohortmembers'] = 'Cohort members';
$string['position'] = 'Position';
$string['organisation'] = 'Organisation';
$string['childrenincluded'] = 'children included';
$string['clear'] = 'Clear';
$string['toomanyuserstoshow'] = 'There are too many users to show';
$string['pleaseusesearch'] = 'Please use the search';
$string['pleasesearchmore'] = 'Please refine the search';
$string['toomanyusersmatchsearch'] = 'Too many users match the search';
$string['successfullyaddedcohort'] = 'Successfully added cohort';
$string['clear'] = 'Clear';
$string['successfullydeleted'] = 'Successfully deleted cohort';
$string['failedtodeleted'] = 'Failed to delete cohort';

$string['missingcohortid'] = 'Missing cohort id in cohort_add_dynamic_cohort()';
$string['dynamiccriteriasetalready'] = 'Dynamic criteria already set for cohort in cohort_add_dynamic_cohort()';
$string['failedtoupdate'] = 'Failed to update cohort membership for Cohort {$a}, please view logs for the SQL error';
$string['profilefieldvaluesrequired'] = 'You must pass in profile field values if passing in a profile field';
/* help strings */
$string['type_help'] = '<h1>Cohort type</h1>

<p>The cohort type can be \'set\' or \'dynamic\'.</p>
<p>Set cohorts are a predefined list of users, manually created by the cohort creator. The creator can add or remove users but otherwise the list is static.</p>
<p>Dynamic cohorts are determined by a rule or set of rules, and the users included in the cohort will dynamically update to include users who match those rules (and remove users who no longer match).</p>
<p>The memebers of a set cohort can be changed at any time, but the rules that define a dynamic cohort cannot be changed once the cohort has been saved.</p>';
$string['profilefieldvalues_help'] = '<h1>Cohort profile field values</h1>

<p>If selected, the members of the dynamic cohort will be chosen based on those which have a user profile field matching a particular value.</p>
<p>The values can be a single text string or a comma-separated list of several text strings. If a comma-separated list is provided, users who match any of the individual strings will be included in the cohort.</p>
';
$string['positionincludechildren_help'] = '<h1>Cohort include child positions</h1>

<p>If the \'Include children\' checkbox is ticked then all users in the selected position, and any position below the selected position in the hierarchy will be included in this cohort.</p>
<p>If \'Include children\' is not selected, only users that are assigned the exact position selected will be assigned to the cohort.</p>
';
$string['orgincludechildren_help'] = '<h1>Cohort include child organisations</h1>

<p>If the \'Include children\' checkbox is ticked then all users in the selected organisation, and any organisation below the selected organisation in the hierarchy will be included in this cohort.</p>
<p>If \'Include children\' is not selected, only users that are assigned the exact organisation selected will be assigned to the cohort.</p>
';
