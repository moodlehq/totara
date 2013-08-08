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
 * @subpackage totara_feedback360
 *
 * totara_feedback360 specific language strings.
 * these should be called like get_string('key', 'totara_feedback360');
 */

$string['active'] = 'Active';
$string['activate'] = 'Activate';
$string['activatenow'] = '(Activate Now)';
$string['addsystemusers'] = 'Add user(s)';
$string['alreadyreplied'] = 'This user has already replied';
$string['answernow'] = 'Respond now';
$string['assigncurrentgroups'] = 'Assigned Groups';
$string['assigncurrentusers'] = 'Assigned Users';
$string['assignedtoxdraftusers'] = 'Assigned to {$a} draft user(s)';
$string['assignedtoxusers'] = 'Assigned to {$a} user(s)';
$string['assignincludechildren'] = 'Include Child Groups?';
$string['assigngroup'] = 'Assign Group to 360&deg; Feedback?';
$string['assigngrouptype'] = 'Assignment Type';
$string['assignments'] = 'Assignments';
$string['assignnumusers'] = 'Assigned Users';
$string['assignsourcename'] = 'Assigned Group';

$string['backtofeedback360'] = 'Back to feedback';
$string['byduedate'] = 'by {$a}';

$string['cancellationalert'] = '{$a->userfrom} has cancelled their feedback request "{$a->feedbackname}", you no longer need to respond.';
$string['cancellationemail'] = '{$a->userfrom} has cancelled their feedback request "{$a->feedbackname}", you no longer need to respond.';
$string['cancellationsubject'] = '{$a->userfrom} Feedback request cancellation';
$string['cancelrequest'] = 'Cancel Feedback Request';
$string['cancelrequestconfirm'] = 'Are you sure you want to cancel this feedback request?';
$string['cancelrequestcontinued'] = ' No further feedback will be accepted but all current replies will be kept.';
$string['cancelrequestsuccess'] = 'Request successfully cancelled';
$string['cancelusersemail'] = 'Cancel existing requests to these external users:';
$string['close'] = 'Close';
$string['closed'] = 'Closed';
$string['closenow'] = '(Close Now)';
$string['confirmactivatefeedback360'] = 'Are you sure you want to activate Feedback - {$a}';
$string['confirmclosefeedback360'] = 'Are you sure you want to close Feedback - {$a}';
$string['confirmdeletefeedback360'] = 'Are you sure you want to Delete Feedback - {$a}';
$string['confirmdeletequestion'] = 'Are you sure you want to delete quesiton - {$a}';
$string['completed'] = 'Completed';
$string['content'] = 'Content';
$string['contentupdated'] = 'Content updated';
$string['copy'] = 'Copy';
$string['createfeedback360'] = 'Create Feedback';
$string['createfeedback360heading'] = 'Create a new 360&deg; Feedback';

$string['delete'] = 'Delete';
$string['deletedfeedback360'] = 'Successfully Deleted Feedback';
$string['deletefeedback360s'] = 'Delete Feedback - {$a}';
$string['deletefeedback360questions'] = 'And all releated questions';
$string['deletefeedback360assignments'] = 'And all releated assignments';
$string['description'] = 'Description';
$string['description_help'] = 'When a feedback description is created the information displays after feedback name';
$string['draft'] = 'Draft';
$string['duedate'] = 'Due Date';
$string['duedate_help'] = 'The date requested users should reply by';

$string['emailrequestsexisting'] = 'Existing External Feedback Request(s)';
$string['emailrequestsnew'] = 'Add External Feedback Request(s)';
$string['emailrequestsnew_help'] = 'To request feedback from external users, enter one email address per line';
$string['emailrequeststr'] = '<p>{$a->fullname} has requested you fill in their feedback form. Please click the link below and fill in the displayed form:<p>
<p>{$a->link}</p>';
$string['emailrequeststralt'] = '{$a->fullname} has requested you fill in their feedback form. Please click go to the link below and fill in the displayed form:

{$a->url}';
$string['emailrequestsubject'] = 'Feedback request from {$a->fullname}';
$string['emailrequesturlmask'] = 'here';
$string['error:accessdenied'] = 'Access Denied, you do not have permission to view this page';
$string['error:activationconfirmation'] = 'Feedback is not ready to be activated';
$string['error:activationstatus'] = 'Cannot activate a Feedback that is neither draft or closed';
$string['error:cannotchangestatus'] = 'Current status {$a->oldstatus} cannot be changed to {$a->newstatus}';
$string['error:duedateformat'] = 'Due date is not in recognised format.';
$string['error:duedatepast'] = 'Due date is in the past, please select a value in the future.';
$string['error:emailformat'] = 'These emails do not match the expected format: ';
$string['error:emailduplicate'] = 'You have duplicate emails, please enter an email only once: ';
$string['error:emptyuserrequests'] = 'You have no recipients, please select a user or enter an email';
$string['error:respassignmentaccess'] = 'You do not have permission to access this page';
$string['error:requestdeletefailure'] = 'Failed to delete feedbackrequest, authentication failure';
$string['error:feedback360isactive'] = 'Feedback must be in \'Draft\' or \'Closed\' state to be removed';
$string['error:feedback360noteditable'] = 'Feedback can not be edited while in an \'Active\' state';
$string['error:feedbacknotactive'] = 'Feedback can not be edited unless the form is active';
$string['error:feedbacktablecreation'] = 'Feedback must be saved before creating answers table';
$string['error:learnersrequired'] = 'Feedback must be assigned to users';
$string['error:questionsrequired'] = 'Feedback must have at least one basic or review question';
$string['error:recipientsrequired'] = 'At least one group of recipients must be selected';
$string['error:newduedatebeforeold'] = 'The due date can not be set to an earlier date, please set it to a date equal to or after the existing due date.';
$string['error:noformselected'] = 'Error no feedback form selected. Please select a feedback form before continuing.';
$string['error:readonly'] = 'Cannot submit form in read only mode';
$string['error:unexpectedtype'] = 'The variable {$a} does not meet the expected type';
$string['error:unrecognisedaction'] = 'Trying to preform an unrecognised action: {$a}';
$string['error:previewpermissions'] = 'You do not have permission to preview this feedback';

$string['feedback360'] = '360&deg; Feedback';
$string['feedback360:managefeedback360'] = 'Manage Feedback'; // TODO check.
$string['feedback360:clonefeedback360'] = 'Clone Feedback'; // TODO check.
$string['feedback360:assignfeedback360togroup'] = 'Assign Feedback to group'; // TODO check.
$string['feedback360:viewassignedusers'] = 'View assigned users'; // TODO check.
$string['feedback360:manageactivation'] = 'Manage activation'; // TODO check.
$string['feedback360:managenotifications'] = 'Manage notifications'; // TODO check.
$string['feedback360:managepageelements'] = 'Manage page elements'; // TODO check.
$string['feedback360:usebasicelements'] = 'Use basic elements'; // TODO check.
$string['feedback360:useadvancedelements'] = 'Use advanced elements'; // TODO check.
$string['feedback360:useprofileelements'] = 'Use profile elements'; // TODO check.
$string['feedback360:viewstaffreceivedfeedback360'] = 'View staff received Feedbacks'; // TODO check.
$string['feedback360:viewownfeedback360'] = 'View own Feedback'; // TODO check.
$string['feedback360:requestfeedback360'] = 'Request Feedback'; // TODO check.
$string['feedback360aboutcolleagues'] = 'Give feedback about your colleagues';
$string['feedback360aboutuser'] = 'Feedback about {$a}';
$string['feedback360aboutyou'] = 'Feedback about you';
$string['feedback360activated'] = 'Successfully activated Feedback';
$string['feedback360activenochangesallowed'] = 'This feedback360 is active, no changes can be made to learner assignments';
$string['feedback360cloned'] = 'Successfully cloned Feedback';
$string['feedback360closed'] = 'Successfully closed Feedback';
$string['feedback360created'] = 'Successfully created Feedback';
$string['feedback360fixerrors'] = 'You must fix the following errors prior to feedback activation';
$string['feedback360notfound'] = 'Feedback form not found';
$string['feedback360selectform'] = 'Select the type of feedback you want to receive:';
$string['feedback360selectform_help'] = 'This is the form the users will have to fill in and submit as your feedback, click the preview link next to the name to see the form.';
$string['feedback360updated'] = 'Successfully updated Feedback';
$string['feedbacksubmitted'] = 'Feedback submitted';

$string['givefeedback'] = 'Give Feedback';

$string['invalidsesskey'] = 'The given session key is not valid. Please resend data again';

$string['loadfeedback360failure'] = 'Failed to load the feedback360';

$string['managefeedback360'] = 'Manage Feedback';
$string['managefeedback360s'] = 'Manage 360&deg; Feedbacks';
$string['manageuserrequests'] = 'Manage user requests';
$string['messages'] = 'Messages';
$string['myfeedback'] = 'My Feedback';

$string['name'] = 'Name';
$string['nameemail'] = 'Name/Email';
$string['name_help'] = 'This is the name that will appear at the top of your feedback forms and reports';
$string['newrequest'] = 'New Feedback Request';
$string['next'] = 'Next';
$string['noavailableforms'] = 'You have no unused forms available';
$string['nofeedback360requested'] = 'You have not requested any feedback yet';
$string['nofeedback360togive'] = 'You have not been requested to give any feedback yet';
$string['nofeedback360s'] = 'No feedbacks have been created';
$string['nogroupassignments'] = 'There are currently no groups assigned';
$string['notcompleted'] = 'Not Completed';
$string['nouserassignments'] = 'There are currently no users assigned';

$string['options'] = 'Options';
$string['overdue'] = 'Overdue';

$string['pending'] = '(pending)';
$string['pluginname'] = 'Totara Feedback';
$string['progresssaved'] = 'Progress saved';
$string['preview'] = 'Preview';
$string['previewencased'] = '(Preview)';
$string['previewheader'] = 'Previewing "{$a}"';
$string['previewsubheader'] = 'This shows the page as someone responding to a feedback request would view it.';

$string['recipient:email'] = 'External email addresses';
$string['recipient:anyuser'] = 'Any site user';
$string['recipient:linemanager'] = 'Their line manager';
$string['recipient:directreports'] = 'Their direct reports (managers only)';
$string['recipient:audiencies'] = 'Audiencies they are member of';
$string['recipient:samepos'] = 'People with the same position';
$string['recipient:sameorg'] = 'People with the same organisation';
$string['recipientdesc'] = 'Select groups of users the assignee can request feedback';
$string['recipients'] = 'Recipients';
$string['recipientsupdated'] = 'Recipients updated';
$string['remind'] = 'remind';
$string['reminderconfirm'] = 'This will send a reminder message to everyone you have requested feedback from that has yet to respond:';
$string['reminderssent'] = 'Reminders sent for {$a}';
$string['remindresponders'] = 'Send Feedback Reminders';
$string['reminderemailsubject'] = 'Reminder: {$a->requestername}\'s feedback request';
$string['reminderemailbody'] = 'This is to remind you that {$a->requestername} asked you to complete a feedback form about them {$a->timedue}, please click {$a->link} and complete the form.';
$string['reminderemailbodyalt'] = 'This is to remind you that {$a->requestername} asked you to complete a feedback form about them {$a->timedue}, please go to {$a->url} and complete the form.';
$string['removerequest'] = 'Delete Feedback Request';
$string['removerequestconfirm'] = 'Are you sure you want to remove the feedback request to {$a}?';
$string['responsecount'] = '{$a->responded} Responses (out of {$a->total})';
$string['response'] = 'Response';
$string['responses'] = 'Responses';
$string['request'] = 'Request';
$string['requestcreatedsuccessfully'] = 'Successfully created';
$string['requested'] = 'Requested: ';
$string['requestfeedback360'] = 'Request Feedback';
$string['requestfeedback360confirm'] = 'Are you sure that you want to...';
$string['requestfeedback360create'] = 'Create new feedback requests for:';
$string['requestfeedback360delete'] = 'Cancel existing requests for:';
$string['requestfeedback360keep'] = 'Send due date updates to:';
$string['requestuserssystem'] = 'Request Feedback from system users';
$string['requestuserssystemchoose'] = 'Choose the users who you would like to get feedback from:';
$string['requestusersemail'] = 'Request Feedback from external users';
$string['reviewnow'] = 'View your response';

$string['saveprogress'] = 'Save progress';
$string['settings'] = 'Settings';
$string['status'] = 'Status';
$string['statusat'] = 'Status: ';
$string['stop'] = 'stop';
$string['submitfeedback'] = 'Submit feedback';

$string['timedue'] = 'Due: ';

$string['update'] = 'Update';
$string['updatealert'] = '{$a->userfrom} has updated the due date of their feedback request "{$a->feedbackname}", you now have until {$a->timedue} to respond.';
$string['updateemail'] = '{$a->userfrom} has updated the due date of their feedback request "{$a->feedbackname}", you now have until {$a->timedue} to respond.';
$string['updatesubject'] = '{$a->userfrom} Feedback update';
$string['urlrequesturlmask'] = 'here';
$string['userassignmentnotfound'] = 'User assignment not found';
$string['userheaderfeedback'] = 'Feedback for {$a->username} <a href="{$a->site}/user/view.php?id={$a->userid}" target="_BLANK">View profile</a>';
$string['userheaderfeedbackwolinks'] = 'Feedback for {$a->username}';
$string['userownheaderfeedback'] = 'Feedback about you';

$string['validationfailed'] = 'Validation Failed';
$string['viewrequest'] = 'View Request';
$string['viewresponse'] = 'View Response';
