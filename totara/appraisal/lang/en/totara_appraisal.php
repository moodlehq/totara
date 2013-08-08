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
 * totara_appraisal specific language strings.
 * these should be called like get_string('key', 'totara_appraisal');
 * Replaces lang/[lang]/local.php from 1.1 series
 *
 * @author Valerii Kuznetsov <valerii.kuznetsov@totaralms.com>
 * @author Ciaran Irvine <ciaran.irvine@totaralms.com>
 * @package totara
 * @subpackage totara_appraisal
 */
$string['activate'] = 'Activate';
$string['activatenow'] = 'Activate now';
$string['appraisal_activation'] = 'Appraisal activation';
$string['active'] = 'Active';
$string['activeappraisals'] = 'Active appraisals';
$string['addpage'] = 'Add new page';
$string['addstage'] = 'Add stage';
$string['ahead'] = 'Ahead';
$string['allappraisals'] = 'All Appraisals';
$string['allappraisalsfor'] = 'All Appraisals for {$a}';
$string['answer'] = 'Answer';
$string['appraisal:manageappraisals'] = 'Manage appraisals'; // TODO check.
$string['appraisal:viewstageroles'] = 'View stage roles'; // TODO check.
$string['appraisal:cloneappraisal'] = 'Clone appraisals'; // TODO check.
$string['appraisal:assignappraisaltogroup'] = 'Assign appraisal to group'; // TODO check.
$string['appraisal:viewassignedusers'] = 'View assigned users'; // TODO check.
$string['appraisal:managenotifications'] = 'Manage notifications'; // TODO check.
$string['appraisal:viewasrole'] = 'View as role'; // TODO check.
$string['appraisal:manageactivation'] = 'Manage activation of appraisal'; // TODO check.
$string['appraisal:managepageelements'] = 'Manage page elements'; // TODO check.
$string['appraisal:usebasicelements'] = 'Use basic elements'; // TODO check.
$string['appraisal:useadvancedelements'] = 'Use advanced elements'; // TODO check.
$string['appraisal:usereviewelements'] = 'Use review elements'; // TODO check.
$string['appraisal:useprofileelements'] = 'Use profile elements'; // TODO check.
$string['appraisal:manageelementroles'] = 'Manage element roles'; // TODO check.
$string['appraisal:viewelementroles'] = 'View element roles'; // TODO check.
$string['appraisal:printstaffappraisals'] = 'Print staff appraisals'; // TODO check.
$string['appraisal:viewownappraisals'] = 'View own appraisals'; // TODO check.
$string['appraisal:printownappraisals'] = 'Print own appraisals'; // TODO check.
$string['appraisal'] = 'Appraisal';
$string['appraisals'] = 'Appraisals';
$string['appraisalactivated'] = 'Appraisal {$a} activated';
$string['appraisalactivenochangesallowed'] = 'This appraisal is active, no changes can be made to learner assignments';
$string['appraisalcloned'] = 'Appraisal Cloned';
$string['appraisalclosed'] = 'Appraisal \'{$a}\' closed';
$string['appraisalclosedalertssent'] = 'Appraisal \'{$a}\' closed and alert have been sent';
$string['appraisalfixerrors'] = 'You must fix the following errors prior to appraisal activation:';
$string['appraisalhasstages'] = 'Appraisal has the following stages:';
$string['appraisalhistory'] = 'appraisal history';
$string['appraisalinvalid'] = 'Appraisal not ready for activation';
$string['appraisalinvalid:missingrole'] = 'Learner {$a->user} is missing their {$a->role}.';
$string['appraisalinvalid:pageempty'] = 'Page \'{$a}\' has no questions. All pages must have questions prior to activation';
$string['appraisalinvalid:roles'] = 'There is no role that can answer at least one question';
$string['appraisalinvalid:stagedue'] = 'Stage \'{$a}\' has invalid due date. It must be in the future';
$string['appraisalinvalid:stageempty'] = 'Stage \'{$a}\' has no pages. All stages must have pages prior to activation';
$string['appraisalinvalid:stagenoonecananswer'] = 'Stage \'{$a}\' has no questions that can be answered';
$string['appraisalinvalid:status'] = 'Cannot activate appraisal that is not draft';
$string['appraisalinvalid:learners'] = 'There are no assigned learners';
$string['appraisallastwarning'] = 'Activating this appraisal will disable changes to all stages, pages and questions,
    and will lock the list of assigned users. It will make the appraisal available to those users and send out any messages you
    have configured.';
$string['appraisalupdated'] = 'Appraisal Updated';
$string['asroleappraiser'] = 'As Appraiser';
$string['asrolelearner'] = 'My Appraisals';
$string['asrolemanager'] = 'As Manager';
$string['asroleteamlead'] = 'As Manager\'s Manager';
$string['assigncurrentgroups'] = 'Assigned Groups';
$string['assigncurrentusers'] = 'Assigned Learners';
$string['assigngroup'] = 'Assign Learner Group To Appraisal';
$string['assigngrouptypename'] = 'Assignment Type';
$string['assignincludechildren'] = 'Include Child Groups?';
$string['assignments'] = 'Assignments';
$string['assignnumusers'] = 'Learners';
$string['assignsourcename'] = 'Assigned Group';
$string['backtoappraisal'] = 'Back to appraisal';
$string['changessaved'] = 'Changes saved';
$string['close'] = 'Close';
$string['closeappraisal'] = 'Close appraisal';
$string['closed'] = 'Closed';
$string['closealertadminbody'] = '<p>The following staff, whose appraisals you are involved in, will no longer be able to complete this appraisal:</p>
        <p>{$a->staff}</p>
        <p>Message from the administrator follows:</p><p>{$a->alerttitle}</p><p>{$a->alertbody}</p>';
$string['closealertbody'] = 'Alert body';
$string['closealertbodydefault'] = '<p>An administrator has closed your appraisal "{$a->name}".</p>
        <p>You no longer need to complete this appraisal.</p>';
$string['closealerttitle'] = 'Alert title';
$string['closealerttitledefault'] = 'Appraisal "{$a->name}" has been closed by an administrator';
$string['closesendalert'] = 'Send alert to affected users';
$string['closeusersincomplete'] = '{$a} users have not yet completed this appraisal. Closing will prevent them continuing with their appraisal. This cannot be undone.';
$string['closedon'] = 'This appraisal was cancelled on {$a}';
$string['complete'] = 'Complete';
$string['completeby'] = 'Complete by';
$string['completebydate'] = 'Complete by <br>{$a}';
$string['completebystage_help'] = 'Leave the dates empty if you don\'t know them yet, but note that the appraisal can\'t be activate without them';
$string['completed'] = 'Completed';
$string['completedon'] = 'This appraisal was completed on {$a}';
$string['completestage'] = 'Complete Stage';
$string['confirmactivateappraisal'] = 'Do you really want to activate this appraisal?';
$string['confirmcloseappraisal'] = 'Do you really want to close this appraisal?';
$string['confirmdeleteappraisal'] = 'Do you really want to remove this appraisal?';
$string['confirmdeletemessage'] = 'Do you really want to remove this message?';
$string['confirmdeletepage'] = 'Do you really want to remove this page?';
$string['confirmdeletestage'] = 'Do you really want to remove this stage?';
$string['confirmdeletequestion'] = 'Do you really want to remove this question?';
$string['confirmdeleteitem'] = 'Are you sure you want to delete this item?';
$string['content'] = 'Content';
$string['continue'] = 'Continue';
$string['createappraisal'] = 'Create appraisal';
$string['createappraisalheading'] = 'Create a new appraisal';
$string['createpageheading'] = 'Create a new page';
$string['dateend'] = 'End date';
$string['datestart'] = 'Start date';
$string['delete'] = 'Delete';
$string['deleteappraisals'] = 'Delete \'{$a}\' appraisal';
$string['deletepage'] = 'Delete \'{$a}\' page';
$string['deletestage'] = 'Delete \'{$a}\' stage';
$string['deletedappraisal'] = 'Appraisal deleted';
$string['deletedpage'] = 'Page deleted';
$string['deletedstage'] = 'Stage deleted';
$string['description'] = 'Description';
$string['description_help'] = 'When a appraisal description is created the information displays after appraisal name';
$string['descriptionstage'] = 'Description';
$string['descriptionstage_help'] = 'When a description is created the information displays after appraisal stage name';
$string['downloadnow'] = 'Download now';
$string['draft'] = 'Draft';
$string['editpageheading'] = 'Edit page';
$string['editstageheading'] = 'Edit stage';
$string['error:cannotaccessappraisal'] = 'You do not have the capabilities required to access this appraisal';
$string['error:appraisalisactive'] = 'Appraisal cannot be removed if it is active';
$string['error:appraisalmustdraft'] = 'Parts of appraisal cannot be removed after appraisal activation';
$string['error:appraisalnotdraft'] = 'Appraisal must be in \'Draft\' or \'Closed\' state to be modified';
$string['error:beforedisabled'] = 'This type of event cannot be predicted';
$string['error:cannotchangestatus'] = 'Current status {$a->oldstatus} cannot be changed to {$a->newstatus}';
$string['error:completebyinvalid'] = 'The complete by date must be in the future';
$string['error:cannotdelete'] = 'The item could not be deleted. Please make sure it still exists.';
$string['error:dateformat'] = 'Please enter a date in the format {$a}.';
$string['error:dialognotreeitemsplancourses'] = 'There are no courses in this plan';
$string['error:dialognotreeitemsplancompetencies'] = 'There are no competencies in this plan';
$string['error:dialognotreeitemsplanobjectives'] = 'There are no objectives in this plan';
$string['error:dialognotreeitemsplanprograms'] = 'There are no programs in this plan';
$string['error:dialognotreeitemsplanevidence'] = 'There is no linked evidence in this plan';
$string['error:messagetitleyrequired'] = 'Message title is required';
$string['error:messagebodyrequired'] = 'Message body is required';
$string['error:nopermissions'] = 'You do not have permissions to perform that action';
$string['error:pagenotfound'] = 'Page not found';
$string['error:stagenotfound'] = 'Stage not found';
$string['error:submitteddatainvalid'] = 'There were problems with the data you submitted';
$string['error:movestagenopages'] = 'The stage that the question is being moved to contains no pages';
$string['error:subjecthasnoappraisals'] = 'User has no appraisals';
$string['error:numberrequired'] = 'Number greater than zero is required';
$string['error:unknownbuttonclicked'] = 'Unknown button clicked';
$string['error:writerequired'] = 'At least one role must have write access';
$string['error:viewrequired'] = 'At least one role must have visibility access';
$string['error:rolemessage'] = 'At least one role should be selected to receive message';
$string['event'] = 'Event';
$string['eventactivation'] = 'Appraisal Activation';
$string['eventafter'] = '{$a->delta} {$a->period} after event';
$string['eventbefore'] = '{$a->delta} {$a->period} before event';
$string['eventmessagetitle'] = 'Message title';
$string['eventmessagebody'] = 'Message body';
$string['eventmessageroletitle'] = '{$a} message title';
$string['eventmessagerolebody'] = '{$a} message body';
$string['eventrecipients'] = 'Recipients';
$string['eventsendroleall'] = 'Send same message to all roles';
$string['eventsendroleeach'] = 'Send different message for each role';
$string['eventsendstagecompleted'] = 'Only send to people if their stage is';
$string['eventstageiscomplete'] = 'complete';
$string['eventstageisincomplete'] = 'incomplete';
$string['eventstage'] = '{$a} Stage';
$string['eventstagecomplete'] = 'Upon completion';
$string['eventstagedue'] = 'Complete by date';
$string['eventtimeafter'] = 'Send after';
$string['eventtimebefore'] = 'Send before';
$string['eventtimenow'] = 'Send immediately when event happens';
$string['eventtiming'] = 'Timing';
$string['finished'] = 'Finished';
$string['inactiveappraisals'] = 'Inactive appraisals';
$string['incomplete'] = 'Incomplete';
$string['inprogress'] = 'In progress';
$string['immediate'] = 'Immediate';
$string['itemstoadd'] = 'Items to add';
$string['latestappraisal'] = 'Latest Appraisal';
$string['latestappraisals'] = 'Latest Appraisals';
$string['latestappraisalfor'] = 'Latest Appraisal for {$a}';
$string['latestappraisalsfor'] = 'Latest Appraisals for {$a}';
$string['learners'] = 'Learners';
$string['leavespace'] = 'Leave space on print-out to write comments';
$string['locks'] = 'Lock stage after completion';
$string['locks_help'] = 'Locking a stage after completion means the user\'s own answers are no longer editable';
$string['lockwhencompleted'] = 'Lock stage when completed';
$string['manageactivation'] = 'Manage {$a}\'s activation'; // TODO unused?
$string['manageappraisals'] = 'Manage appraisals';
$string['managestage'] = 'Manage {$a}\'s content';
$string['messagecreate'] = 'Create Message';
$string['messagedeleted'] = 'Message deleted';
$string['messageedit'] = 'Edit Message';
$string['messages'] = 'Messages';
$string['messagesheading'] = 'Messages';
$string['messagetitle'] = 'Title';
$string['messageevent'] = 'Event';
$string['messagetiming'] = 'Timing';
$string['messagerecipients'] = 'Recipients';
$string['messagesaved'] = 'Message saved';
$string['metrics'] = 'Metrics';
$string['metricreportforx'] = '{$a} metric report: ';
$string['myappraisals'] = 'My Appraisals';
$string['myteamappraisals'] = 'My Team\'s Appraisals';
$string['name'] = 'Name';
$string['name_help'] = 'This is the name that will appear at the top of your appraisal forms and reports';
$string['namestage'] = 'Name';
$string['namestage_help'] = 'This is the name that will appear at the top of your appraisal stages';
$string['next'] = 'Next';
$string['noappraisals'] = 'No appraisals have been created.';
$string['noappraisalsactive'] = 'No appraisals are active.';
$string['noappraisalsinactive'] = 'No appraisals are inactive.';
$string['noassignments'] = 'No current user assignments';
$string['nomessages'] = 'No messages have been added.';
$string['none'] = '-';
$string['nopagestoview'] = 'There are no pages available at this time.';
$string['nostages'] = 'No stages have been created.';
$string['ontarget'] = 'On target';
$string['options'] = 'Options';
$string['overdue'] = 'Overdue';
$string['pagename'] = 'Page: {$a}';
$string['pagedefaultname'] = 'New Page';
$string['pageupdated'] = 'Page updated';
$string['periodchoose'] = 'How much earlier/later?';
$string['perioddays'] = 'days';
$string['periodmonths'] = 'months';
$string['periodweeks'] = 'weeks';
$string['permissions'] = 'Permissions';
$string['preview'] = 'Preview';
$string['previewdeprecated'] = 'Preview {$a->appraisal}:{$a->stage}:{$a->page} as {$a->role}';
$string['previewingappraisal'] = 'Previewing "{$a->appraisalname}" as {$a->rolename}';
$string['previewinfo'] = 'This window displays how the appraisal will appear to a user with the "{$a}" role, including which stages, pages and questions will be visible.';
$string['previewappraisal'] = 'Preview appraisal';
$string['previewappraisalas'] = 'Preview appraisal as:';
$string['previewusername'] = 'Preview User';
$string['print'] = 'Print';
$string['printnow'] = 'Print now';
$string['printyourappraisal'] = 'Print your appraisal';
$string['progresssaved'] = 'Progress saved';
$string['pluginname'] = 'Totara Appraisals';
$string['reportappraisals'] = 'Reports';
$string['required'] = 'Required';
$string['reviewyourlpcompetencies'] = 'Review your learning plan competencies';
$string['reviewyourlpprograms'] = 'Review your learning plan programs';
$string['reviewyourlpevidence'] = 'Review your learning plan evidence';
$string['reviewyourlpobjectives'] = 'Review your learning plan objectives';
$string['role'] = 'Role';
$string['role_answer_roleappraiser'] = 'Appraiser\'s answer';
$string['role_answer_rolelearner'] = 'Learner\'s answer';
$string['role_answer_rolemanager'] = 'Manager\'s answer';
$string['role_answer_roleteamlead'] = 'Manager\'s Manager\'s answer';
$string['role_answer_you'] = 'Your answer';
$string['roleaccessnotice'] = 'If a role cannot answer or view other\'s answers then the question is not shown to that role';
$string['roleadministrator'] = 'Administrator';
$string['roleappraiser'] = 'Appraiser';
$string['roleall'] = 'All';
$string['rolelearner'] = 'Learner';
$string['rolemanager'] = 'Manager';
$string['roleteamlead'] = 'Manager\'s Manager';
$string['rolecompleteyou'] = ' You must complete this stage';
$string['rolecompleteyour'] = ' Your {$a} must complete this stage';
$string['rolecompleteuser'] = ' {$a} must complete this stage';
$string['rolecompleteusers'] = ' {$a->username}\'s {$a->rolename} must complete this stage';
$string['rolescananswer'] = 'Roles that can answer';
$string['rolescananswer_help'] = 'These are the roles that can answer at least one question on a page within this stage.';
$string['rolescanview'] = 'Roles that can view';
$string['rolescanview_help'] = 'These are the roles that can view at least one other person\'s answer but cannot answer any questions themselves.';
$string['savechanges'] = 'Save changes';
$string['savepdfsnapshot'] = 'Save PDF Snapshot';
$string['saveprogress'] = 'Save progress';
$string['sameaspreceding'] = 'Same as preceding question';
$string['selectquestiontype'] = 'Select type of content...';
$string['settings'] = 'Settings';
$string['appraisal_stage_completion'] = 'Stage completion';
$string['sectioninclude'] = 'Choose which sections to include';
$string['snapshotdialogtitle'] = 'Save PDF Snapshot';
$string['snapshotdone'] = 'A snapshot of your appraisal has been saved. You can view it by going to {$a->link}';
$string['snapshotgeneration'] = 'Saving snapshot... Please wait.';
$string['snapshotname'] = 'Snapshot {$a->time}';
$string['stagecompleted'] = 'You have completed this stage';
$string['stage_due'] = 'Stage due';
$string['stageheader'] = 'Stage name';
$string['stageupdated'] = 'Stage updated';
$string['stagename'] = 'Stage: {$a}';
$string['stages'] = 'Stages';
$string['start'] = 'Start';
$string['status'] = 'Status';
$string['statusat'] = 'Status:';
$string['statusreportforx'] = '{$a} status report: ';
$string['temporarypage'] = 'Temporary page';
$string['unavailable'] = 'Unavailable';
$string['view'] = 'View';
$string['viewother'] = 'View other role\'s answers';
$string['viewreport'] = 'View report';
$string['visibleto'] = 'Visible to:';
$string['visibility'] = 'Visisbility';
$string['questupdated'] = 'Page content updated';
$string['unrecognizedaction'] = 'Unrecognized action';
$string['youareprintingxsappraisal'] = '<strong>{$a->rolename}\'s version of <a href="{$a->site}/user/view.php?id={$a->userid}">{$a->name}\'s</a> appraisal.</strong>';
$string['youareviewingxsappraisal'] = '<strong>You are viewing <a href="{$a->site}/user/view.php?id={$a->userid}">{$a->name}\'s</a> appraisal.</strong>';
