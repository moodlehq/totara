<?php

# Help titles
$string['help:list0'] = 'How to Measure Objectives';
$string['help:list1'] = 'How to Meet Objectives';

# admin settings
$string['admin:submittedtext'] = 'Email notification text for IDP submissions';
$string['admin:submittedtextdesc'] = 'Configure the email notification text for when a IDP gets submitted.  These emails go to designated managers.  There are a few placeholders you can use which will be replaced with the appropriate text before the email goes out:  {{traineename}} - the name of the trainee who has submitted the plan, {{recipientname}} - the name of the email recipient, and {{link}} - the link to view the submitted plan.';
$string['admin:submittedtextdefault'] = 'Hi {{recipientname}},

A new IDP has been submitted for a trainee you are supervising, {{traineename}}.

Please click on the following link to view this plan:

{{link}}';

$string['admin:completedtext'] = 'Email notification text for IDP evaluations';
$string['admin:completedtextdesc'] = 'Configure the email notification text for when a IDP self-evaluated is submitted.  These emails go to designated managers.  There are a few placeholders you can use which will be replaced with the appropriate text before the email goes out:  {{traineename}} - the name of the trainee who has completed the self-evaluation, {{recipientname}} - the name of the email recipient, and {{link}} - the link to view the completed self-evaluation.';
$string['admin:completedtextdefault'] = 'Hi {{recipientname}},

A new IDP self-evaluation has been submitted by a trainee you are supervising, {{traineename}}.

Please click on the following link to view this evaluation:

{{link}}';

$string['admin:traineecommentedtext'] = 'Email notification text for IDP comments by trainees';
$string['admin:traineecommentedtextdesc'] = 'Configure the email notification text for when a trainee comments on their own plan.  These emails go to designated managers.  There are a few placeholders you can use which will be replaced with the appropriate text before the email goes out: {{traineename}} - the name of the trainee who has commented on their plan, {{planname}} - the name of the IDP, {{recipientname}} - the name of the email recipient, and {{link}} - the link to view the plan with comments.';
$string['admin:traineecommentedtextdefault'] = 'Hi {{recipientname}},

A trainee, {{traineename}}, has written a new comment on their IDP {{planname}}.

Please click on the following link to review this plan and comment in return:

{{link}}

The comment follows:';

$string['admin:managercommentedtext'] = 'Email notification text for IDP comments by managers';
$string['admin:managercommentedtextdesc'] = 'Configure the email notification text for when a managers comments on a trainee\'s IDP.  These emails go to the trainees.  There are a few placeholders you can use which will be replaced with the appropriate text before the email goes out: {{managername}} - the name of the managers who has commented on the plan, {{planname}} - the name of the plan, {{recipientname}} - the name of the email recipient, and {{link}} - the link to view the plan with comments.';
$string['admin:managercommentedtextdefault'] = 'Hi {{recipientname}},

One of your managers, {{managername}}, has commented on your IDP: {{planname}}.

Please click on the following link to review this comment and make your own comment in return:

{{link}}

The comment follows:';

$string['admin:approvedtext'] = 'Email notification text for IDP approvals';
$string['admin:approvedtextdesc'] = 'Configure the email notification text for when a manager (or admin) approves a trainee\'s IDP.  These emails go to the trainees.  There are a few placeholders you can use which will be replaced with the appropriate text before the email goes out: {{managername}} - the name of the manager (or admin) who has commented on the plan, {{onbehalfof}} - this will be replaced with \'on behalf of {{managername}}\' in the case that the plan was approved \'on behalf of\', {{recipientname}} - the name of the email recipient, {{duedate}} - the deadline for the submission of the self-evaluation, and {{link}} - the link to view the IDP.';

$string['admin:approvedtextdefault'] = 'Hi {{recipientname}},

Your IDP has been approved by {{managername}}{{onbehalfof}}.

Please click on the following link to review it:

{{link}}

Note that you will need to submit a self-evaluation for this plan by {{duedate}}.
';

$string['admin:approvedonbehalftext'] = 'Email notification text for IDP approvals on behalf of another user';
$string['admin:approvedonbehalftextdesc'] = 'Configure the email notification text for when a manager (or admin) approves a trainee\'s IDP on behalf of another manager.  These emails go to the manager on whose behalf the plan was approved..  There are a few placeholders you can use which will be replaced with the appropriate text before the email goes out: {{managername}} - the name of the manager (or admin) who has commented on the plan, {{traineename}} - this will be replaced with the trainee\'s name, {{recipientname}} - the name of the email recipient, {{planname}} - the name of the plan in question, {{duedate}} - the deadline for the submission of the self-evaluation, and {{link}} - the link to view the IDP.';

$string['admin:approvedonbehalftextdefault'] = 'Hi {{recipientname}},

The IDP: \'{{planname}}\' -- belonging to {{traineename}} -- has been approved by {{managername}} on your behalf.

Please click on the following link to review it:

{{link}}

Note that you will need to submit a self-evaluation for this plan by {{duedate}}.

Please contact a site administrator if you had not requested this approval.
';

#Settings page
$string['generalsettings'] = 'General Settings';
$string['adminsettings'] = 'Admin Settings';

$string['setting:startdate'] = 'Start date for all users';
$string['setting:configstartdate'] = '';

$string['setting:enddate'] = 'End date for all users';
$string['setting:configenddate'] = '';

$string['setting:competencyaddfromposition'] = 'Add Competencies from positions';
$string['setting:configcompetencyaddfromposition'] = '';

$string['setting:length'] = 'Lenth of IDP';
$string['setting:configlength'] = 'The Length of Individual Development Plan for all users in days.';

$string['setting:autonewcreation'] = 'Automatic new creation';
$string['setting:configautonewcreation'] = 'Automatically create new IDP when the current one expires';

$string['setting:manyidpperuser'] = 'More than one at once per user';
$string['setting:configmanyidpperuser'] = 'Allow more than one IDP per user at any given time';

$string['setting:approval'] = 'Approval Required';
$string['setting:configapproval'] = '';

$string['setting:items'] = 'Items';
$string['setting:configitems'] = '';

$string['setting:duedates'] = 'Due dates for items';
$string['setting:configduedates'] = '';
$string['setting:duedateno'] = 'No';
$string['setting:duedateopt'] = 'Optional';
$string['setting:duedatereq'] = 'Required';

$string['setting:priorities'] = 'Priorities for items';
$string['setting:configpriorities'] = '';

$string['setting:objectives'] = 'Objectives';
$string['setting:configobjectives'] = '';

$string['setting:enableeval'] = 'Enable evaluations';
$string['setting:configenableeval'] = '';

$string['setting:showgap'] = 'Show gap analysis';
$string['setting:configshowgap'] = '';

$string['setting:showlearnrec'] = 'Show record of learning';
$string['setting:configshowlearnrec'] = '';

# Errors
$string['error:badstartdate'] = 'Invalid format for the starting date of the training period.  Enter the date in the DD/MM/YYYY format.';
$string['error:badenddate'] = 'Invalid format for the end date of the training period.  Enter the date in the DD/MM/YYYY format.';
$string['error:cannotcreateplan'] = 'Unknown error while attempting to create a new plan.';
$string['error:cannotevaluateplan'] = 'You cannot evaluate someone else\'s IDP.';
$string['error:cannotrenameplan'] = 'You can only rename plans which have not been submitted or have been withdrawn.';
$string['error:cannotcloneplan'] = 'Unknown error while attempting to clone plan.';
$string['error:cannotupdateclonedplan'] = 'There was a problem while attempting to update cloned plan';
$string['error:endbeforestart'] = 'The end date cannot come before the start date.';
$string['error:evaluationsubmissionerror'] = 'Could not submit the self-evaluation. Did you rate all objectives?';
$string['error:invalidaction'] = 'Invalid Action: $a';
$string['error:invalidplanid'] = 'Invalid Plan ID';
$string['error:nomanager'] = 'There is no Manager set for this user -- please report this to your site administrator';
$string['error:noobjectivestoevaluate'] = 'There are no learning objectives to evaluate in this curriculum.';
$string['error:norejectreason'] = 'You must provide a reason for rejecting this IDP.';
$string['error:nousercurriculum'] = 'No curriculum has been specified in the profile data for this user. Contact the site administrator.';
$string['error:planalreadyevaluated'] = 'A self-evaluation has already been submitted for this IDP.';
$string['error:plannotapproved'] = 'You cannot evaluate this plan because it has not yet been approved.';
$string['error:plannotempty'] = 'You can only delete empty plans, and this plan is not empty.';
$string['error:plannotsubmitted'] = 'You can only delete empty plans which have never been submitted.';
$string['error:plannotyours'] = 'You do not have access to this plan because it is not your plan.';
$string['error:revisionnotvisible'] = 'This revision is not visible to you.';
$string['error:revisioncantbecommented'] = 'This revision can\'t be commented on, because it hasn\'t been submitted yet.';
$string['error:removalfailed'] = 'Removal failed.';

# Other strings
$string['addbutton'] = 'Add competency to plan';
$string['addcomment'] = 'Add a comment:';
$string['addfromframeworks'] = 'Add from frameworks';
$string['addcoursestoplan'] = 'Add courses to plan';
$string['addcompetenciestoplan'] = 'Add competencies to plan';
$string['addcompetencytemplatestoplan'] = 'Add competency templates to plan';
$string['addfrompositions'] = 'Add from positions';
$string['addfromcategories'] = 'Add from categories';
$string['additembutton'] = 'Add';
$string['additionalobjectives'] = 'Add additional Learning Objectives';
$string['adminnotifications'] = 'IDP email notifications';
$string['allcomments'] = 'All comments:';
$string['allcommentsonthisrevision'] = 'Comments on this revision:';
$string['allrevisions'] = 'All revisions:';
$string['approvalerror'] = 'Cannot approve IDP';
$string['approved'] = 'Approved';
$string['approvedondate'] = 'Approved on $a';
$string['approveplan'] = 'Approve this plan';
$string['approving'] = 'Approving IDP';
$string['approvingexplanation1'] = 'Here are the contents of the IDP you are about to approve:';
$string['approvingexplanation2'] = 'Click the <b>approve</b> button once you are ready to send this plan back to the trainee as approved.  Otherwise, click the <b>cancel</b> button.';
$string['approvingtitle'] = 'Review IDP \"$a\"';
$string['backtoeditbutton'] = 'Back to edit';
$string['backlearningplans'] = 'Back to IDPs';
$string['backtotoplink'] = 'Back to top';
$string['byuser'] = 'by $a';
$string['cancel'] = 'Cancel';
$string['cloneplan'] = 'Clone plan';
$string['cloneplanbreadcrumb'] = 'Clone IDP';
$string['cloneplantitle'] = 'Clone IDP';
$string['cloneplanbutton'] = 'Clone this plan';
$string['column:name'] = 'Name';
$string['column:role'] = 'Role';
$string['column:view'] = 'View';
$string['column:comment'] = 'Comment';
$string['column:approve'] = 'Approve';
$string['column:firstname'] = 'Given Name';
$string['column:lastname'] = 'Surname';
$string['column:submissiontime'] = 'Submission Date';
$string['column:approvaltime'] = 'Status';
$string['column:planname'] = 'Plan name';
$string['column:mtime'] = 'Last modified';
$string['column:status'] = 'Status';
$string['commentonplan'] = 'Comment on this plan';
$string['completed'] = 'Completed';
$string['completedon'] = 'Completed on $a';
$string['confirmrejectbutton'] = 'Send request and comments';
$string['confirmsubmitbutton'] = 'Confirm and send';
$string['confirmwithdrawbutton'] = 'Withdraw';
$string['createdon'] = 'Created on:';
$string['createnewplan'] = 'Create a new plan';
$string['createplan'] = 'Create plan';
$string['createplanbreadcrumb'] = 'Create IDP';
$string['createplantitle'] = 'Create IDP';
$string['currentstatus'] = 'Current status:';
$string['currentset'] = 'Set Current';
$string['currentplan'] = 'Current plan';
$string['curriculum_A'] = 'Adult Internal Medicine';
$string['curriculum_P'] = 'Paediatrics and Child Health';
$string['curriculum_Q'] = 'Professional Qualities Curriculum';
$string['curriculum_A_title'] = 'Adult Internal Medicine &mdash; Basic Training Curriculum';
$string['curriculum_P_title'] = 'Paediatrics and Child Health &mdash; Basic Training Curriculum';
$string['curriculum_Q_title'] = 'Professional Qualities Curriculum';
$string['defaultplanname'] = 'My IDP';
$string['deleteplanbutton'] = 'Delete this plan';
$string['deleteitembutton'] = 'Delete this item from the list';
$string['disclaimer'] = 'New plan disclaimer';
$string['dragheretoassign'] = 'Drag here to assign';
$string['duedate'] = 'Due date';
$string['edititembutton'] = 'Edit or rename this item';
$string['editlatestrevision'] = 'Edit latest revision of this plan';
$string['emailnotificationfromname'] = 'IDP Module';
$string['emailnotificationfooter'] = 'Please do not reply to this email, use the IDP online instead';
$string['emailsubjectcompleted'] = 'IDP has been evaluated';
$string['emailsubjecttraineecommented'] = 'New trainee comment on IDP';
$string['emailsubjectmanagercommented'] = 'New manager comment on your IDP';
$string['emailsubjectsubmitted'] = 'New IDP submitted';
$string['emailsubjectapproved'] = 'Your IDP has been approved';
$string['emailsubjectapprovedonbehalf'] = 'A IDP was approved on your behalf';
$string['emptyplancompetencies'] = 'This IDP does not have any competencies yet.';
$string['emptyplancompetencytemplates'] = 'This IDP does not have any competency templates yet.';
$string['emptyplancourses'] = 'This IDP does not have any courses yet.';
$string['enablefavourites'] = 'Enable favourites';
$string['enablesearch'] = 'Enable search';
$string['enddate'] = 'End date';
$string['evaluateplan'] = 'Evaluate plan';
$string['evaluation'] = 'Evaluation';
$string['evaluationsummary'] = 'Self-Evaluation Summary';
$string['evaluationsummarytitle'] = 'Self-Evaluation Summary';
$string['evaluationtitle'] = 'Self-Evaluation of IDP \"$a\"';
$string['exporttopdf'] = 'Export to PDF';
$string['extracommentsheading'] = 'Additional Comments (optional)';
$string['extraselfevaluationcommentsheading'] = 'Additional Self-Evaluation Comments';
$string['filter'] = 'Filter:';
$string['hideapprovedplans'] = 'Hide approved plans';
$string['howtomeasureobjectives'] = 'Progress Indicators';
$string['howtomeetobjectives'] = 'Learning Activities';
$string['idp'] = 'Individual Development Plan';
$string['idps'] = 'Individual Development Plans';
$string['inrevision'] = 'In revision';
$string['lastevaluatedcolumn'] = 'Last Evaluated';
$string['lastchanged'] = 'Last changed';
$string['lastmodifiedon'] = 'Last modified on:';
$string['learningobjectivescolumn'] = 'Learning Objectives';
$string['learningplanapproval'] = 'IDP Approval';
$string['list0explanation1'] = 'Explain how you can demonstrate progress in achieving these objectives.';
$string['list1explanation1'] = 'List the potential learning opportunities and activities which would allow you to acquire the learning objectives you have identified above.';
$string['list0explanation2'] = 'List each item separately by clicking ADD after you have entered the item.';
$string['list1explanation2'] = 'List each item separately by clicking ADD after you have entered the item.';
$string['list0description'] = 'How can I demonstrate progress in achieving these objectives?';
$string['list1description'] = 'List the potential learning opportunities and activities which would allow you to acquire the learning objectives you have identified above.';
$string['list0heading'] = 'Key Progress Indicators';
$string['list1heading'] = 'Target Learning Activities';
$string['locatecourse'] = 'Locate course';
$string['lpname'] = 'IDPner name';
$string['nextaction'] = 'Next action:';
$string['nofavourites'] = 'You do not have any favourites.  Add some by clicking on the \"star\" button next to any Learning Objective.';
$string['noneyet'] = 'none yet';
$string['noobjectivesindomain'] = 'You have not added any objectives from this domain. Use the collapsing tree below to pick the ones you wish to add to this table.';
$string['noplans'] = 'No IDPs found.';
$string['noplansubmittedorapproved'] = 'None of this user\'s IDPs are ready to approve or comment upon.';
$string['noplansblockerror'] = 'No IDPner activity was found for this course.  Please speak to your site administrator about this problem.';
$string['norevisions'] = 'No revisions found for this IDP.';
$string['nosearchresults'] = 'This search did not return any Learning Objectives.';
$string['nothingyet'] = 'nothing yet';
$string['notrainees'] = 'No trainees were found.';
$string['notsubmitted'] = 'Not yet submitted';
$string['objectiveheading'] = 'What are the competencies that need to be acquired?';
$string['objectiveexplanation'] = 'Expand the following items in this curriculum and add them to your IDP using the $a button.';
$string['onbehalfofuser'] = 'on behalf of $a';
$string['onbehalfofexplanation'] = 'Approve this plan on behalf of:';
$string['ondate'] = 'on $a';
$string['onlycreatorsubmit'] = 'Only the creator of the plan can submit it';
$string['onlycreatorwithdraw'] = 'Only the creator of the plan can withdraw it';
$string['otherinformation'] = 'Other Information';
$string['options'] = 'Options';
$string['overdue'] = 'Overdue for evaluation';
$string['pendingapproval'] = 'Pending approval';
$string['personaldetailsheading'] = 'Personal Details';
$string['plangrade0'] = 'Not attempted';
$string['plangrade1'] = 'Needs Considerable Attention';
$string['plangrade2'] = 'Needs Attention';
$string['plangrade3'] = 'Satisfactory';
$string['plangrade4'] = 'Excellent';
$string['plannameexplanation1'] = 'Please enter a name for your IDP:';
$string['plannameexplanation2'] = '(This name will be shown in your list of IDPs.)';
$string['previewtitle'] = 'Review IDP \"$a\"';
$string['previewobjectivesuffix'] = 'Target Learning Objectives';
$string['printableview'] = 'Printable view';
$string['printviewbutton'] = 'Print View';
$string['learningplan'] = 'IDP';
$string['learningplanplural'] = 'IDPs';
$string['rejectexplanation'] = 'Enter a reason for rejecting this plan and requesting a new revision. <b>These comments will be sent to the trainee.</b>';
$string['rejecting'] = 'Requesting a Revision';
$string['rejectionerror'] = 'A new revision could not be requested';
$string['rejectplan'] = 'Request Revision';
$string['rejecttitle'] = 'Reject IDP \"$a\"';
$string['renameplan'] = 'Rename plan';
$string['renameplanbreadcrumb'] = 'Rename IDP';
$string['renameplantitle'] = 'Rename IDP';
$string['removefromplanbutton'] = 'Remove from plan';
$string['renameplanbutton'] = 'Rename this plan';
$string['revisionedittitle'] = 'Edit IDP \"$a\"';
$string['revisionviewtitle'] = 'View IDP \"$a\"';
$string['savecontinuelaterbutton'] = 'Save and continue later';
$string['searchresults'] = 'Search results';
$string['searchforusers'] = 'Search for users';
$string['selfevaluationdueby'] = 'Self-evaluation due by $a';
$string['showapprovedplans'] = 'Show approved plans';
$string['startdate'] = 'Start date';
$string['starttoenddates'] = '$a->start to $a->end';
$string['status'] = 'Status';
$string['submissiondate'] = 'Submission Date';
$string['submissionerror'] = 'Plan could not be submitted';
$string['submitevaluation'] = 'Submit Evaluation';
$string['submitexplanation1'] = 'Please take a moment to review the contents of the IDP you created.';
$string['submitexplanation2'] = 'Click the <b>confirm and send</b> button once you are ready to send this plan for your manager for approval.  If you need to make changes, click the <b>back to edit</b> button.';
$string['submitplan'] = 'Submit this plan';
$string['submitting'] = 'Submitting IDP';
$string['submitted'] = 'Submitted';
$string['submittedon'] = 'Submitted on $a';
$string['manager'] = 'Manager';
$string['manageroverviewtitle'] = 'Manager Overview';
$string['themeorobjectivecolumn'] = 'Theme / Learning Objective';
$string['themescolumn'] = 'Themes';
$string['to'] = 'to';
$string['myidps'] = 'My IDPs';
$string['idpsfor'] = 'IDPs for $a';
$string['trainingperiod'] = 'Training Period:';
$string['trainingperiodexplanation'] = 'Enter a training period to display along with the given name.  Note that the training period must be <b> within the financial year </b>(July 1 - June 30).';
$string['usersaid'] = '$a said';
$string['userstrainees'] = '$a\'s trainees';
$string['viewlatestrevision'] = 'View latest revision of this plan';
$string['viewsummary'] = 'View Summary';
$string['withdrawerror'] = 'Plan could not be withdrawn';
$string['withdrawexplanation1'] = 'If you withdraw this IDP, it will no longer be waiting for your manager\'s approval. Instead, you will be able to edit a new copy of this plan and submit it again.';
$string['withdrawexplanation2'] = 'In some cases, it may not be possible to withdraw a submitted plan.';
$string['withdrawing'] = 'Withdrawing IDP';
$string['withdrawn'] = 'Withdrawn';
$string['withdrawnon'] = 'Withdrawn on $a';
$string['withdrawplan'] = 'Withdraw IDP';
$string['withdrawtitle'] = 'Withdraw IDP \"$a\"';
$string['yourlearningplans'] = 'Your IDPs:';
$string['yourtrainees'] = 'Your trainees';

$string['notapprovedyet'] = 'This plan hasn\'t been approved yet and can\'t be exported to PDF';
?>
