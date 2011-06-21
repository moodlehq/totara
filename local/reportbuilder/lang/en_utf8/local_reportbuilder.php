<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage reportbuilder 
 */

// Report Builder
$string['access'] = 'Access';
$string['accessbyrole'] = 'Restrict access by role';
$string['accessbyrole'] = 'Restrict access by role';
$string['accesscontrols'] = 'Access Controls';
$string['activities'] = 'Activities';
$string['activitygroupdesc'] = 'Activity groups let you define sets of activites for the purpose of site-wide reporting.';
$string['activitygroupingx'] = 'Activity grouping \'$a\'';
$string['activitygroups'] = 'Activity groups';
$string['addanothercolumn'] = 'Add another column...';
$string['addanotherfilter'] = 'Add another filter...';
$string['addedscheduledreport'] = 'Added new scheduled report';
$string['addscheduledreport'] = 'Add scheduled report';
$string['advanced'] = 'Advanced?';
$string['alldata'] = 'All data';
$string['allofthefollowing'] = 'All of the following';
$string['allreports'] = 'All Reports';
$string['allscheduledreports'] = 'All scheduled reports';
$string['and'] = ' and ';
$string['anycontext'] = 'Users may have role in any context';
$string['anyofthefollowing'] = 'Any of the following';
$string['ascending'] = 'Ascending (A to Z, 1 to 9)';
$string['assignedactivities'] = 'Assigned activities';
$string['at'] = 'at';
$string['badcolumns'] = 'Invalid columns';
$string['badcolumnsdesc'] = 'The following columns have been included in this report, but do not exist in the report\'s source. This can occur if the source changes on disk after reports have been generated. To fix, either restore the previous source file, or delete the columns from this report.';
$string['backtoallgroups'] = 'Back to all groups';
$string['baseactivity'] = 'Base activity';
$string['basedon'] = 'Group based on';
$string['baseitem'] = 'Base item';
$string['baseitemdesc'] = 'The aggregated data available to this group is based on the questions in the activity \'<a href=\"{$a->url}\">{$a->activity}</a>\'.';
$string['both'] = 'Both';
$string['bydateenable'] = 'Show records based on the record date';
$string['bytrainerenable'] = 'Show records by trainer';
$string['byuserenable'] = 'Show records by user';
$string['choosecomp'] = 'Choose Competency...';
$string['chooseorg'] = 'Choose Organisation...';
$string['choosepos'] = 'Choose Position...';
$string['clearform'] = 'Clear';
$string['column'] = 'Column';
$string['column_deleted'] = 'Column deleted';
$string['column_moved'] = 'Column moved';
$string['column_vis_updated'] = 'Column visibility updated';
$string['columns'] = 'Columns';
$string['columns_updated'] = 'Columns updated';
$string['competency_evidence'] = 'Competency Evidence';
$string['completedorgenable'] = 'Show records completed in the user\'s organisation';
$string['content'] = 'Content';
$string['contentcontrols'] = 'Content Controls';
$string['context'] = 'Context';
$string['course_completion'] = 'Course Completion';
$string['coursetagenable'] = 'Show records by course tag';
$string['createasavedsearch'] = 'Create a saved search';
$string['createreport'] = 'Create report';
$string['csvformat'] = 'text format';
$string['currentfinancial'] = 'The current financial year';
$string['currentorgenable'] = 'Show records from staff in the user\'s organisation';
$string['currentposenable'] = 'Show records from staff in the user\'s position';
$string['currentsearchparams'] = 'Settings to be saved';
$string['daily'] = 'Daily';
$string['defaultsortcolumn'] = 'Default column';
$string['defaultsortorder'] = 'Default order';
$string['delete'] = 'Delete';
$string['deletecheckschedulereport'] = 'Are you sure you would like to delete this scheduled report?';
$string['deletedscheduledreport'] = 'Successfully deleted Scheduled Report \'$a\'';
$string['deletereport'] = 'Report Deleted';
$string['descending'] = 'Descending (Z to A, 9 to 1)';
$string['disabled'] = 'Disabled?';
$string['editreport'] = 'Edit Report \'$a\'';
$string['editscheduledreport'] = 'Edit Scheduled Report';
$string['editthisreport'] = 'Edit this report';
$string['embedded'] = 'Embedded';
$string['embeddedaccessnotes'] = '<strong>Warning:</strong> Embedded reports may have their own access restrictions applied to the page they are embedded into. They may ignore the settings below, or they may apply them as well as their own restrictions.';
$string['embeddedcontentnotes'] = '<strong>Warning:</strong> Embedded reports may have further content restrictions applied via <em>embedded parameters</em>. These can further limit the content that is shown in the report';
$string['embeddedreports'] = 'Embedded Reports';
$string['error:addscheduledreport'] = 'Error adding new Scheduled Report';
$string['error:bad_sesskey'] = 'There was an error because the session key did not match';
$string['error:column_not_deleted'] = 'There was a problem deleting that column';
$string['error:column_not_moved'] = 'There was a problem moving that column';
$string['error:column_vis_not_updated'] = 'Column visibility could not be updated';
$string['error:columns_not_updated'] = 'There was a problem updating the columns.';
$string['error:couldnotcreatenewreport'] = 'Could not create new report';
$string['error:couldnotsavesearch'] = 'Could not save search';
$string['error:couldnotupdateglobalsettings'] = 'There was an error while updating the global settings';
$string['error:couldnotupdatereport'] = 'Could not update report';
$string['error:failedtoremovetempfile'] = 'Failed to remove temporary report export file';
$string['error:filter_not_deleted'] = 'There was a problem deleting that filter';
$string['error:filter_not_moved'] = 'There was a problem moving that filter';
$string['error:filters_not_updated'] = 'There was a problem updating the filters';
$string['error:grouphasreports'] = 'You cannot delete a group that is being used by reports.';
$string['error:groupnotcreated'] = 'Group could not be created';
$string['error:groupnotcreatedinitfail'] = 'Group could not be created - failed to initialize tables!';
$string['error:groupnotcreatedpreproc'] = 'Group could not be created - preprocessor not found!';
$string['error:groupnotdeleted'] = 'Group could not be deleted';
$string['error:invalidreportid'] = 'Invalid report ID';
$string['error:invalidreportscheduleid'] = 'Invalid scheduled report ID';
$string['error:invaliduserid'] = 'Invalid user ID';
$string['error:mustselectsource'] = 'You must pick a source for the report';
$string['error:nocolumns'] = 'No columns found. Ask your developer to add column options to the \'$a\' source.';
$string['error:nocolumnsdefined'] = 'No columns have been defined for this report. Ask you site administrator to add some columns.';
$string['error:nocontentrestrictions'] = 'No content restrictions are available for this source. To use restrictions, ask your developer to add the necessary code to the \'$a\' source.';
$string['error:nopermissionsforscheduledreport'] = 'Scheduled Report Error: User $a->userid is not capable of viewing report $a->reportid.';
$string['error:norolesfound'] = 'No roles found';
$string['error:nosavedsearches'] = 'This report does not yet have any saved searches';
$string['error:nosources'] ='No sources found. You must have at least one source before you can add reports. Ask your developer to add the necessary files to the codebase.';
$string['error:savedsearchnotdeleted'] = 'Saved search could not be deleted';
$string['error:unknownbuttonclicked'] = 'Unknown button clicked';
$string['error:updatescheduledreport'] = 'Error updating Scheduled Report';
$string['error:propertyxmustbesetiny'] = 'Property \"{$a->property}\" must be set in class \"{$a->class}\"';
$string['error:joinxusedmorethanonceiny'] = 'Join name \"{$a->join}\" used more than once in source \"{$a->source}\"';
$string['error:joinxisreservediny'] = 'Join name \"{$a->join}\" in source \"{$a->source}\" is an SQL reserved word. Please rename the join';
$string['error:joinxhasdependencyyinz'] = 'Join name \"{$a->join}\" contains a dependency \"{$a->dependency}\" that does not exist in the joinlist for source \"{$a->source}\"';
$string['error:joinsfortypexandvalueynotfoundinz'] = 'Joins for columns with type \"{$a->type}\" and value \"{$a->value}\" not found in source \"{$a->source}\"';
$string['error:columnoptiontypexandvalueynotfoundinz'] = 'Column option with type \"{$a->type}\" and value \"{$a->value}\" not found in source \"{$a->source}\"';
$string['error:filteroptiontypexandvalueynotfoundinz'] = 'Filter option with type \"{$a->type}\" and value \"{$a->value}\" not found in source \"{$a->source}\"';
$string['error:joinsforfiltertypexandvalueynotfoundinz'] = 'Joins for filter with type \"{$a->type}\" and value \"{$a->value}\" not found in source \"{$a->source}\"';
$string['error:invalidsavedsearchid'] = 'Invalid saved search ID';
$string['excludecoursetags'] = 'Exclude records tagged with';
$string['export'] = 'Export';
$string['exportcsv'] = 'Export in text format';
$string['exportfusion'] = 'Export to Google Fusion';
$string['exportods'] = 'Export in ODS format';
$string['exportoptions'] = 'Report Export options';
$string['exportproblem'] = 'There was a problem downloading the file';
$string['exportxls'] = 'Export in Excel format';
$string['filter'] = 'Filter';
$string['filter_deleted']=  'Filter deleted';
$string['filter_moved'] = 'Filter moved';
$string['filters'] = 'Filters';
$string['filters_updated'] = 'Filters updated';
$string['format'] = 'Format';
$string['globalsettings'] = 'Global settings';
$string['globalsettingsupdated'] = 'Global settings updated';
$string['groupconfirmdelete'] = 'Are you sure you want to delete this group?';
$string['groupcontents'] = 'This group currently contains {$a->count} feedback activities tagged with the <strong>\'{$a->tag}\'</strong> official tag:';
$string['groupdeleted'] = 'Group deleted.';
$string['groupname'] = 'Group name';
$string['grouptag'] = 'Group tag';
$string['heading'] = 'Heading';
$string['help:columnsdesc'] = 'The choices below determine which columns appear in the report and how those columns are labelled.';
$string['help:restrictionoptions'] = 'The checkboxes below determine who has access to this report, and which records they are able to view. If no options are checked no results are visible. Click the help icon for more information';
$string['help:searchdesc'] = 'The choices below determine which options appear in the search box at the top of the report.';
$string['hidden'] = 'Hide in My Reports';
$string['includechildorgs'] = 'Include records from child organisations';
$string['includechildpos'] = 'Include records from child positions';
$string['includecoursetags'] = 'Include records tagged with';
$string['includeemptydates'] = 'Include record if date is missing';
$string['includerecordsfrom'] = 'Include records from';
$string['includetrainerrecords'] = 'Include records from particular trainers';
$string['includeuserrecords'] = 'Include records from particular users';
$string['is'] = 'is';
$string['isbelow'] = 'is below';
$string['isnt'] = 'isn\'t';
$string['isnttaggedwith'] = 'isn\'t tagged with';
$string['istaggedwith'] = 'is tagged with';
$string['last30days'] = 'The last 30 days';
$string['lastchecked'] = 'Last process date';
$string['lastfinancial'] = 'The previous financial year';
$string['manageactivitygroups'] = 'Manage activity groups';
$string['managereports'] = 'Manage reports';
$string['monthly'] = 'Monthly';
$string['movedown'] = 'Move Down';
$string['moveup'] = 'Move Up';
$string['myreports'] = 'My Reports';
$string['name'] = 'Name';
$string['newgroup'] = 'Create a new activity group';
$string['newreport'] = 'New Report';
$string['newreportcreated'] = 'New report created. Click settings to edit filters and columns';
$string['next30days'] = 'The next 30 days';
$string['nocolumnsyet'] = 'No columns have been created yet - add them by selecting a column name in the pulldown below.';
$string['nocontentrestriction'] = 'Show all records';
$string['nodeletereport'] = 'Report could not be deleted';
$string['noembeddedreports'] = 'There are no embedded reports. Embedded reports are reports that are hard-coded directly into a page. Typically they will be set up by your site developer.';
$string['nofiltersyet'] = 'No search fields have been created yet - add them by selecting a search term in the pulldown below.';
$string['nogroups'] = 'There are currently no activity groups';
$string['noheadingcolumnsdefined'] = 'No heading columns defined';
$string['noneselected'] = 'None selected';
$string['nopermission'] = 'You do not have permission to view this page';
$string['noreloadreport'] = 'Report settings could not be reset';
$string['noemptycols'] = 'You must include a column heading';
$string['norepeatcols'] = 'You cannot include the same column more than once';
$string['norepeatfilters'] = 'You cannot include the same filter more than once';
$string['noreports'] = 'No reports have been created. You can create a report using the form below.';
$string['noreportscount'] = 'No reports using this group';
$string['norestriction'] = 'All users can view this report';
$string['norestriction'] = 'All users can view this report';
$string['norestrictionsfound'] = 'No restrictions found. Ask your developer to add restrictions to /local/reportbuilder/sources/$a/restrictionoptions.php';
$string['noresultsfound'] = 'No results found';
$string['noscheduledreports'] = 'There are no scheduled reports';
$string['noshortnameorid'] = 'Invalid report id or shortname';
$string['notags'] = 'No official tags exist. You must create one or more official tags to base your groups on.';
$string['notset'] = 'Course Not Set';
$string['notyetchecked'] = 'Not yet processed';
$string['nouserreports'] = 'You do not have any reports. Report access is configured by your site administrator. If you are expecting to see a report, ask them to check the access permissions on the report.';
$string['occurredafter'] = 'occurred after';
$string['occurredbefore'] = 'occurred before';
$string['occurredprevfinancialyear'] = 'occurred in the previous financial year';
$string['occurredthisfinancialyear'] = 'occurred in this finanicial year';
$string['odsformat'] = 'ODS format';
$string['on'] = 'on';
$string['onlydisplayrecordsfor'] = 'Only display records for';
$string['onthe'] = 'on the';
$string['options'] = 'Options';
$string['options'] = 'Options';
$string['or'] = ' or ';
$string['orsuborg'] = '(or a sub organisation)';
$string['orsubpos'] = '(or a sub position)';
$string['publicallyavailable'] = 'Let other users view';
$string['recordsperpage'] = 'Number of records per page';
$string['refreshdataforthisgroup'] = 'Refresh data for this group';
$string['reloadreport'] = 'Report settings have been reset';
$string['report'] = 'Report';
$string['report:completiondate'] = 'Completion date';
$string['report:coursetitle'] = 'Course title';
$string['report:enddate'] = 'End date';
$string['report:learner'] = 'Learner';
$string['report:learningrecords'] = 'Learning records';
$string['report:nodata'] = 'There is no available data for that combination of criteria, start date and end date';
$string['report:organisation'] = 'Office';
$string['report:startdate'] = 'Start date';
$string['reportbuilder'] = 'Report builder';
$string['reportbuilder:managereports'] = 'Create, edit and delete report builder reports';
$string['reportbuilderglobalsettings'] = 'Report Builder Global Settings';
$string['reportcolumns'] = 'Report Columns';
$string['reportconfirmdelete'] = 'Are you sure you want to delete this report?';
$string['reportconfirmreload'] = 'This is an embedded report so you cannot delete it (that must be done by your site developer). You can choose to reset the report settings to their original values. Do you want to continue?';
$string['reportcontents'] = 'This report contains records matching the following criteria:';
$string['reportcount'] = '$a report(s) based on this group:';
$string['reportname'] = 'Report Name';
$string['reports'] = 'Reports';
$string['reportsettings'] = 'Report Settings';
$string['reportsettings'] = 'Report Settings';
$string['reportshortname'] = 'Short Name';
$string['reportsto'] = 'reports to';
$string['reporttitle'] = 'Report Title';
$string['reporttype'] = 'Report type';
$string['reportupdated'] = 'Report Updated';
$string['restoredefaults'] = 'Restore Default Settings';
$string['restrictaccess'] = 'Restrict access';
$string['restrictaccess'] = 'Restrict access';
$string['restrictcontent'] = 'Report content';
$string['restriction'] = 'Restriction';
$string['restrictionswarning'] = '<strong>Warning:</strong> If none of these boxes are checked, all users will be able to view all available records from this source.';
$string['roleswithaccess'] = 'Roles with permission to view this report';
$string['savedsearch'] = 'Saved Search';
$string['savedsearchconfirmdelete'] = 'Are you sure you want to delete this saved search?';
$string['savedsearchdeleted'] = 'Saved search deleted';
$string['savedsearchdesc'] = 'By giving this search a name you will be able to easily access it later or save it to your bookmarks.';
$string['savedsearches'] = 'Saved Searches';
$string['savedsearchmessage'] = 'Only the data matching the \'$a\' search is included.';
$string['savesearch'] = 'Save this search';
$string['schedule'] = 'Schedule';
$string['scheduledaily'] = 'Daily';
$string['scheduledreports'] = 'Scheduled Reports';
$string['scheduledreportmessage'] = 'Attached is a copy of the \'$a->reportname\' report in $a->exporttype. $a->savedtext

You can also view this report online at:

$a->reporturl

You are scheduled to receive this report $a->schedule.
To delete or update your scheduled report settings, visit:

$a->scheduledreportsindex';
$string['scheduledreportsettings'] = 'Scheduled report settings';
$string['schedulemonthly'] = 'Monthly';
$string['schedulenotset'] = 'Schedule not set';
$string['scheduleweekly'] = 'Weekly';
$string['search'] = 'Search';
$string['searchby'] = 'Search by';
$string['searchfield'] = 'Search Field';
$string['searchname'] = 'Search Name';
$string['searchoptions'] = 'Report Search Options';
$string['selectsource'] = 'Select a source...';
$string['settings'] = 'Settings';
$string['shortnametaken'] = 'That shortname is already in use';
$string['showbasedonx'] = 'Show records based on $a';
$string['showbycompletedorg'] = 'Show by completed organisation';
$string['showbycoursetag'] = 'Show by course tag';
$string['showbycurrentorg'] = 'Show by current organisation';
$string['showbycurrentpos'] = 'Show by current position';
$string['showbydate'] = 'Show by date';
$string['showbytrainer'] = 'Show by trainer';
$string['showbyuser'] = 'Show by user';
$string['showbyx'] = 'Show by $a';
$string['showhidecolumns'] = 'Show/Hide Columns';
$string['showing'] = 'Showing';
$string['showrecordsinposandbelow'] = 'Staff at or below the user\'s position';
$string['showrecordsinpos'] = 'Just staff in the user\'s position';
$string['showrecordsbelowposonly'] = 'Just staff below the user\'s position';
$string['showrecordsinorgandbelow'] = 'Staff at or below the user\'s organisation';
$string['showrecordsinorg'] = 'Just staff in the user\'s organisation';
$string['showrecordsbeloworgonly'] = 'Just staff below the user\'s organisation';
$string['sorting'] = 'Sorting';
$string['source'] = 'Source';
$string['systemcontext'] = 'Users must have role in the system context';
$string['thefuture'] = 'The future';
$string['thepast'] = 'The past';
$string['trainerownrecords'] = 'Show records where the user is the trainer';
$string['trainerstaffrecords'] = 'Records where one of the user\'s direct reports is the trainer';
$string['type'] = 'Type';
$string['uniquename'] = 'Unique Name';
$string['updatescheduledreport'] = 'Successfully updated Scheduled Report';
$string['usergenerated'] = 'User generated';
$string['usergeneratedreports'] = 'User generated Reports';
$string['userownrecords'] = 'A user\'s own records';
$string['userstaffrecords'] = 'Records for user\'s direct reports';
$string['value'] = 'Value';
$string['viewreport'] = 'View This Report';
$string['viewsavedsearch'] = 'View a saved search...';
$string['weekly'] = 'Weekly';
$string['withcontentrestrictionall'] = 'Show records matching <b>all</b> of the checked criteria below';
$string['withcontentrestrictionany'] = 'Show records matching <b>any</b> of the checked criteria below';
$string['withrestriction'] = 'Only certain users can view this report (see below)';
$string['withrestriction'] = 'Only certain users can view this report (see below)';
$string['xlsformat'] = 'Excel format';
$string['xofyrecord'] = '{$a->filtered} of {$a->unfiltered} record shown';
$string['xofyrecords'] = '{$a->filtered} of {$a->unfiltered} records shown';
$string['xrecord'] = '$a record shown';
$string['xrecords'] = '$a records shown';

// column and filter titles used by add_* methods

// add courses
$string['coursename'] = 'Course Name';
$string['coursenamelinked'] = 'Course Name (linked to course page)';
$string['coursenamelinkedicon'] = 'Course Name (linked to course page with icon)';
$string['courseicon'] = 'Course Icon';
$string['courseshortname'] = 'Course Shortname';
$string['courseidnumber'] = 'Course ID Number';
$string['courseid'] = 'Course ID';
$string['coursestartdate'] = 'Course Start Date';
$string['coursenameandsummary'] = 'Course Name and Summary';
$string['coursecategory'] = 'Course Category';
$string['coursecategoryid'] = 'Course Category ID';
$string['coursecategorylinked'] = 'Course Category (linked to category)';
$string['coursecategorylinkedicon'] = 'Course Category (linked to category with icon)';
$string['category'] = 'Category';

// add users
$string['userfullname'] = 'User\'s Fullname';
$string['usernamelink'] = 'User\'s Fullname (linked to profile)';
$string['usernamelinkicon'] = 'User\'s Fullname (linked to profile with icon)';
$string['userlastlogin'] = 'User Last Login';
$string['userfirstname'] = 'User First Name';
$string['userlastname'] = 'User Last Name';
$string['username'] = 'Username';
$string['useridnumber'] = 'User ID Number';
$string['userphone'] = 'User\'s Phone number';
$string['userinstitution'] = 'User\'s Institution';
$string['userdepartment'] = 'User\'s Department';
$string['useraddress'] = 'User\'s Address';
$string['usercity'] = 'User\'s City';
$string['usercountry'] = 'User\'s Country';
$string['userid'] = 'User ID';

// add positions
$string['usersorgid'] = 'User\'s Organisation ID';
$string['usersorgpathids'] = 'User\'s Organisation Path IDs';
$string['usersorgname'] = 'User\'s Organisation Name';
$string['usersposid'] = 'User\'s Position ID';
$string['userspospathids'] = 'User\'s Position Path IDs';
$string['userspos'] = 'User\'s Position';
$string['usersjobtitle'] = 'User\'s Job Title';
$string['participantscurrentorgbasic'] = 'Participant\'s Current Organisation (basic)';
$string['participantscurrentorg'] = 'Participant\'s Current Organisation';
$string['participantscurrentposbasic'] = 'Participant\'s Current Position (basic)';
$string['participantscurrentpos'] = 'Participant\'s Current Position';

// add manager info
$string['usersmanagername'] = 'User\'s Manager Name';
$string['managername'] = 'Manager\'s Name';

// add course tag fields
$string['coursetagids'] = 'Course Tag IDs';
$string['taggedx'] = 'Tagged \'{$a}\'';

// course type icon
$string['coursetypeicon'] = 'Type';

// common column types, as strings
// you can override these in individual source lang files if you want
$string['type_user'] = 'User';
$string['type_user_profile'] = 'User Profile';
$string['type_course'] = 'Course';
$string['type_course_custom_fields'] = 'Course Custom Fields';
$string['type_course_category'] = 'Category';
$string['type_tags'] = 'Tags';
