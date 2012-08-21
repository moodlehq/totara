<?php
//required for unit tests
$string['sortthreadview'] = 'Sort Thread';

$string['andchildren'] = ' (and children)';
$string['availablex'] = 'Available {$a}';
$string['selectedx'] = 'Selected {$a}';
$string['bulkaddfailed'] = 'There was a problem adding those items to the hierarchy';
$string['bulkaddsuccess'] = '{$a} items were successfully added to the hierarchy';
$string['bulkactions'] = 'Bulk actions';
$string['clearselection'] = 'Clear selection';
$string['children'] = 'children';
$string['child'] = 'child';
$string['description'] = 'Description';
$string['chooseevidencetype'] = 'Choose an evidence type';
$string['reloadpage'] = ' ~~~RELOAD PAGE~~~ ';
// duplication required to make help buttons work
$string['competencyframeworkfullname'] = 'Full Name';
$string['competencyframeworkscale'] = 'Competency Framework Scale';
$string['competencyaggregationmethod'] = 'Aggregation Method';
$string['competencyscaledescription'] = 'Description';
$string['competencyscaleassign'] = 'Assign Competency Scale';
$string['competencyscalevaluename'] = 'Competency Scale Value Name';
$string['competencyscalevalueidnumber'] = 'Competency Scale Value ID Number';
$string['competencyscalevaluenumeric'] = 'Competency Scale Numeric Value';
$string['addposition'] = 'Add Position';
$string['addorganisation'] = 'Add Organisation';
$string['addcompetency'] = 'Add Competency';
$string['positiontypedescription'] = 'Position Type Description';
$string['organisationtypedescription'] = 'Organisation Type Description';
$string['competencytypedescription'] = 'Competency Type Description';
$string['competencyscalescalename'] = 'Name';
$string['competencyscalescalevalues'] = 'Values';
$string['positiondescription'] = 'Description';
$string['organisationdescription'] = 'Description';
$string['competencydescription'] = 'Description';
$string['error:unknownaction'] = 'Unknown action';
$string['error:unknownbuttonclicked'] = 'Unknown button clicked';
$string['error:nonedeleted'] = 'None of the selected {$a} could be deleted';
$string['error:somedeleted'] = 'Only {$a->actually_deleted} of a possible {$a->marked_for_deletion} {$a->items} could be deleted';
$string['error:failedbulkmove'] = 'There was a problem moving those items';
$string['xitemsmoved'] = '{$a->num} {$a->items} and all children have been moved';
$string['xitemsdeleted'] = '{$a->num} {$a->items} and all children have been deleted';
$string['xandychildren'] = '{$a->item} (and {$a->num} children)';
$string['xandychild'] = '{$a->item} (and {$a->num} child)';
$string['customfields'] = 'Custom fields';
$string['datainx'] = 'Data in {$a}:';
$string['confirmmoveitems'] = 'Are you sure you want to move {$a->num} {$a->items} into "{$a->parentname}"?<br /><br />Any children of the {$a->items} being moved will also be relocated at the same time.';
$string['deletethisdata'] = 'Delete this data';
$string['deleteselectedx'] = 'Delete selected {$a}';
$string['moveselectedxto'] = 'Move selected {$a} to: ';
$string['depths'] = 'Depths';
$string['depth'] = 'Depth {$a}';
$string['enternamesoneperline'] = 'Enter {$a} names (one per line)';
$string['error:couldnotupgradehierarchyduetobaddata'] = 'Could not upgrade hierarchy due to bad data ({$a})';
$string['error:hierarchyprefixnotfound'] = 'Hierarchy prefix {$a} not found';
$string['displayoptions'] = 'Display Options';
$string['error:hierarchytypenotfound'] = 'Hierarchy type {$a} not found';
$string['export'] = 'Export';
$string['exportxls'] = 'Export in Excel Format';
$string['exportcsv'] = 'Export in CSV format';
$string['exporttext'] = 'Export in text format';
$string['exportods'] = 'Export in ODS format';
$string['exportexcel'] = 'Export in Excel format';
$string['hidecustomfields'] = 'Hide Custom Fields';
$string['showdisplayoptions'] = 'Show Display Options';
$string['showitemfullname'] = 'Show Item Fullname';
$string['showdepthfullname'] = 'Show Depth Fullname';
$string['hidedetails'] = 'Hide details';
$string['hidden'] = 'Hidden';
$string['hierarchies'] = 'Hierarchies';
$string['showdetails'] = 'Show details';
$string['hierarchybackup'] = 'Hierarchy Backup';
$string['hierarchyrestore'] = 'Hierarchy Restore';
$string['pluginname'] = 'Hierarchies';
$string['restore'] = 'Restore';
$string['assign'] = 'Assign';
$string['cancelwithoutassigning'] = 'Cancel without assigning';
$string['additionaloptions'] = 'Additional Options';
$string['pickfilehelp'] = 'If the file you want to restore is not available, make sure that the hierarchy backup .zip file is saved in {$a} and that permissions are correctly set.';
$string['error:norestorefiles'] = 'No files found to restore from. {$a}';
$string['pickfileone'] = 'One file found. Would you like to restore the file {$a}?';
$string['pickfilemultiple'] = 'Pick a file to restore';
$string['error:restoreerror'] = 'An error occurred during the restore process: {$a}';
$string['error:nodeletescaleinuse'] = 'You cannot delete a scale that is in use. To delete this scale, it must not be assigned to any framework.';
$string['error:noreorderscaleinuse'] = 'You cannot reorder a scale that is in use. To reorder this scale, it must not be assigned to any framework.';
$string['error:nodeletescalevalueinuse'] = 'You cannot delete a scale value from a scale that is in use. To delete this scale value, the scale must not be assigned to any framework.';
$string['restoreusers'] = '{$a} Users found to restore.';
$string['restorenousers'] = 'No Users found to restore.';
$string['restoreusersanddata'] = 'Restore users and user data';
$string['selectframeworks'] = 'Select which frameworks to restore';
$string['settingsupdated'] = 'Settings updated';
$string['top'] = 'Top';
$string['pickaframework'] = 'Pick a framework';
$string['parentchildselectedwarningdelete'] = 'Note: you have selected an item and also selected one of that item\'s children. Deleting an item will automatically delete all of its children. If you want to keep an item\'s children, move them before deleting the item.';
$string['parentchildselectedwarningmove'] = 'Warning: you have selected to move an item and also one or more of that item\'s children. When you move an item all it\'s children will automatically be moved with it.';
$string['allframeworks'] = 'All frameworks';
$string['error:deletedepthcheckvariable'] = 'The check variable was wrong - try again';
$string['deletecheckdepth'] = 'Are you absolutely sure you want to completely delete this depth level?';
$string['deletedepthnotdeepest'] = 'This depth level cannot be deleted because there are depth levels below it in this framework.';
$string['deletedepthhaschildren'] = 'This depth level cannot be deleted because there are items at this depth level.';
$string['deletedepthnosuchdepth'] = 'Bad depth level id. Please try again.';
$string['deleteddepth'] = 'The depth level {$a} has been deleted.';
$string['error:checkvariable'] = 'The check variable was wrong - try again';
$string['error:couldnotmoveitem'] = 'Could not move that {$a}. There was an error updating the database.';
$string['error:couldnotmoveitemnopeer'] = 'Could not move that {$a}, no adjacent item at same depth level to swap with.';
$string['error:badsortorder'] = 'Could not move that {$a}, there is something wrong with the sort orders.';
$string['error:noframeworksfound'] = 'No {$a} frameworks with one or more depth levels found.';
$string['error:noitemsselected'] = 'No items selected';
$string['frameworkdoesntexist'] = 'The {$a} framework doesn\'t exist';
$string['switchframework'] = 'Switch framework: ';
$string['filterframework'] = 'Filter by framework: ';
$string['showingxofyforsearchz'] = 'Showing {$a->filteredcount} of {$a->allcount} for search "{$a->query}".';
$string['noresultsforsearchx'] = 'No results found for search "{$a}"';
$string['clearsearch'] = 'Clear search';
$string['searchavailable'] = 'Search available items';
$string['selecteditems'] = 'Selected items';
$string['selected'] = 'Selected';
$string['nocustomfields'] = 'No custom fields';
$string['nodata'] = 'No custom field data';
$string['nopathfoundforid'] = 'No path found for {$a->prefix} id {$a->id}';
$string['nopermviewhiddenframeworks'] = 'You do not have permission to view hidden frameworks';
$string['noresultsfor'] = 'No results found for "{$a->query}".';
$string['noresultsforinframework'] = 'No results found for "{$a->query}" in framework "{$a->framework}".';
$string['noxfound'] = 'No {$a} found';
$string['queryerror'] = 'Query error. No results found.';
$string['confirmproceed'] = 'Are you sure you want to proceed?';
$string['missingframeworkname'] = 'Missing framework name';
$string['missingtypename'] = 'Missing type name';

// types
$string['type'] = 'Type';
// duplication required to make help buttons work
$string['positiontype'] = 'Type';
$string['organisationtype'] = 'Type';
$string['competencytype'] = 'Type';
$string['unclassified'] = 'Unclassified';
$string['reclassifyingfromxtoybulk'] = 'Re-classifying {$a->num} {$a->items} from "{$a->from}" to "{$a->to}"';
$string['reclassifyingfromxtoyitem'] = 'Re-classifying "{$a->name}" from "{$a->from}" to "{$a->to}"';
$string['reclassifyitems'] = 'Re-classify items';
$string['reclassifyitemsanddelete'] = 'Re-classify items and delete data';
$string['reclassifyitemsandtransfer'] = 'Re-classify items and transfer/delete data';
$string['currenttype'] = 'Current type';
$string['bulktypechanges'] = 'Bulk re-classification';
$string['bulktypechangesdesc'] = 'Re-classify of all items from the type: ';
$string['reclassify1of2bulk'] = 'Re-classifying {$a->num} {$a->items} - step 1 of 2';
$string['reclassify1of2item'] = 'Re-classifying "{$a->name}" - step 1 of 2';
$string['reclassify1of2desc'] = 'Select the new type.';
$string['reclassifytransferdata'] = 'You will have the opportunity to transfer custom field data in step 2.';
$string['reclassifysuccessbulk'] = '{$a->num} {$a->items} reclassified from "{$a->from}" to "{$a->to}"';
$string['reclassifysuccessitem'] = '"{$a->name}" has been reclassified from "{$a->from}" to "{$a->to}"';
$string['choosewhattodowithdata'] = 'Choose what you would like to do with the custom field data:';
$string['changetype'] = 'Change type';
$string['transfertox'] = 'Transfer to {$a}';
$string['error:cannotconvertfieldfromxtoy'] = '"{$a->from}" fields cannot be converted to "{$a->to}" fields.';
$string['error:cannotmoveparentintochild'] = 'You cannot move "{$a->item}" into its own child "{$a->newparent}"';
$string['error:invalidparentformove'] = 'The location you are moving the item(s) to doesn\'t exist';
$string['error:alreadyassigned'] = 'You have already assigned data to this field.';
$string['error:nonefoundbulk'] = 'There are no items of that type to convert';
$string['error:nonefounditem'] = 'The item does not appear to belong to the specified type';
$string['error:invaliditemid'] = 'Invalid item ID';
$string['error:couldnotreclassifybulk'] = 'There was a problem reclassifying items from "{$a->from}" to "{$a->to}"';
$string['error:couldnotreclassifyitem'] = 'There was a problem reclassifying that item from "{$a->from}" to "{$a->to}"';
$string['newtype'] = 'New type';
$string['showtypefullname'] = 'Show Type Fullname';
$string['alltypes'] = 'All types';
$string['deletetypenosuchtype'] = 'Bad type id. Please try again.';
$string['deletedtype'] = 'The type "{$a}" has been deleted.';
$string['confirmtypechange'] = 'Reclassify items and transfer/delete data';
$string['error:typenotfound'] = 'The {$a} type could not be found';
$string['deletedataconfirmproceed'] = 'Since the new class has no custom fields, this will delete all the data related to the following custom fields:{$a}If you wish to transfer the data to the new type, create the appropriate custom fields in the new type before re-classifying. Are you sure you want to proceed?';
$string['error:deletetypecheckvariable'] = 'The check variable was wrong - try again';
$string['deletechecktype'] = 'Are you absolutely sure you want to delete this type?';

$string['mandatory'] = 'Mandatory';
$string['optional'] = 'Optional';
$string['achieved'] = 'Achieved';
$string['addassignedcompetencies'] = 'Assign competencies';
$string['assigncompetencies'] = 'Assign competencies';
$string['assigncompetency'] = 'Assign competency';
$string['assigncompetencytemplate'] = 'Assign competency template';
$string['addassignedcompetencytemplates'] = 'Assign competency templates';
$string['addcourseevidencetocompetencies'] = 'Add course evidence to competencies';
$string['addcourseevidencetocompetency'] = 'Add course evidence to competency';
$string['allcompetencyscales'] = 'All competency scales';
$string['assigncoursecompletiontocompetencies'] = 'Assign course completion to competencies';
$string['assigncoursecompletiontocompetency'] = 'Assign course completion to competency';
$string['assigncoursecompletion'] = 'Assign course completion';
$string['assigncoursecompletions'] = 'Assign course completions';
$string['adddepthlevel'] = 'Add a new depth level';
$string['addnewcompetency'] = 'Add new competency';
$string['bulkdeletecompetency'] = 'Bulk delete competencies';
$string['bulkmovecompetency'] = 'Bulk move competencies';
$string['addmultiplenewcompetency'] = 'Add multiple competencies';
$string['competencyaddnewframework'] = 'Add new competency framework';
$string['addnewtemplate'] = 'Add new competency template';
$string['addnewscalevalue'] = 'Add new scale value';
$string['assignedonly'] = 'Assigned but not used';
$string['assignrelatedcompetencies'] = 'Assign related competencies';
$string['aggregationmethod'] = 'Aggregation method';
$string['aggregationmethod1'] = 'All';
$string['aggregationmethod2'] = 'Any';
$string['aggregationmethod3'] = 'Off';
$string['aggregationmethod4'] = 'Unit';
$string['aggregationmethod5'] = 'Fraction';
$string['aggregationmethod6'] = 'Sum of weighted';
$string['aggregationmethod7'] = 'Average of weighted';
$string['aggregationmethodview'] = '{$a} aggregation method';
$string['assigncompetencies'] = 'Assign competencies';
$string['assigncompetencytemplates'] = 'Assign competency templates';
$string['assignedcompetencies'] = 'Assigned Competencies';
$string['assignedcompetencytemplates'] = 'Assigned competency templates';
$string['assignedcompetenciesandtemplates'] = 'Assigned Competencies and Competency Templates';
$string['assignnewcompetency'] = 'Assign new competency';
$string['assignnewevidenceitem'] = 'Assign new evidence item';
$string['competencybacktoallframeworks'] = 'Back to all competency frameworks';
$string['cannotupdatedisplaysettings'] = 'Could not update display settings';
$string['changeto'] = 'Change to';
$string['formrequiresjs'] = 'This form requires Javascript to be enabled.';
$string['clickfornonjsform'] = 'Click here for a non-javascript version of this form';
$string['competencies'] = 'Competencies';
$string['competencytemplates'] = 'Competency templates';
$string['competencydepthlevelview'] = 'Competency depth level view';
$string['competencydepthcustomfields'] = 'Competency depth custom fields';
$string['competenciesusedincourse'] = 'Competencies used in course';
$string['competency'] = 'Competency';
$string['competencyevidence'] = 'Competency evidence';
$string['competencyplural'] = 'Competencies';
$string['competencyaddnew'] = 'Add a new competency';
$string['competencycustomfields'] = 'Custom fields';
$string['competencyframeworkmanage'] = 'Manage frameworks';
$string['competencyframework'] = 'Competency Framework';
$string['competencyframeworks'] = 'Competency Frameworks';
$string['competencyframeworkview'] = 'View framework';
$string['competencymanage'] = 'Manage competencies';
$string['competencyscale'] = 'Competency scale';
$string['competencyscaleassign'] = 'Competency scale';
$string['competencyscaleinuse'] = 'This scale is in use (i.e. users have competencies marked with values from this scale). Scale values cannot be created, re-ordered or deleted to preserve data integrity. You can still rename scale values but this may confuse users when their proficiency changes without warning.';
$string['competencyscales'] = 'Competency scales';
$string['competencyscalesgeneral'] = 'Competency Scale'; // for help button
$string['competencyframeworkgeneral'] = 'Competency Framework';
$string['scales'] = 'Scales';
$string['scalex'] = 'Scale "{$a}"';
$string['noscalesdefined'] = 'No scales defined';
$string['competencytemplatemanage'] = 'Manage templates';
$string['competencytemplates'] = 'Competency templates';
$string['couldnotdeletescalevalue'] = 'There was a problem deleting that scale value';
$string['createdon'] = 'Created on';
$string['createnewcompetency'] = 'Create a new competency';
$string['competencyscaledefault'] = 'Default value';
$string['competencydeletecheck'] = 'Are you absolutely sure you want to completely delete this competency, all its children and the data they contain?';
$string['competencydeletecheck11'] = 'Are you sure you want to delete the competency "{$a}"?
<br /><br />
This will remove the following data:<br />
- The "{$a}" competency';
$string['competencydeletecheckwithchildren'] = 'Are you sure you want to delete the competency "{$a->itemname}" and its {$a->children_string}?
<br /><br />
This will remove the following data: <br />
- The "{$a->itemname}" competency and its {$a->childcount} {$a->children_string}';
$string['competencydeletemulticheckwithchildren'] = 'Are you sure you want to delete {$a->num} competency/competencies and {$a->childcount} {$a->children_string}?
<br /><br />
This will remove the following data: <br />
- The {$a->num} competency/competencies and {$a->childcount} {$a->children_string}';
$string['deleteincludexcustomfields'] = '- {$a} custom field record(s)';
$string['deleteincludexuserstatusrecords'] = '- {$a} user status record(s)';
$string['deleteincludexevidence'] = '- {$a} item(s) of evidence';
$string['deleteincludexrelatedcompetencies'] = '- {$a} link(s) to related competencies';
$string['deletecheckframework'] = 'Are you sure you want to delete the framework "{$a}"?';
$string['deletecheckscale'] = 'Are you absolutely sure you want to completely delete this competency scale?';
$string['deletecheckscalevalue'] = 'Are you absolutely sure you want to delete this competency scale value?';
$string['deletechecktemplate'] = 'Are you absolutely sure you want to delete this competency template?';
$string['addedcompetency'] = 'The competency "{$a}" has been added';
$string['error:addcompetency'] = 'There was a problem adding the competency "{$a}"';
$string['deletedcompetency'] = 'The competency {$a} and its children have been completely deleted.';
$string['updatedcompetency'] = 'The competency "{$a}" has been updated';
$string['error:updatecompetency'] = 'There was a problem updating the competency "{$a}"';
$string['deletedcompetencyscale'] = 'The competency scale "{$a}" has been completely deleted.';
$string['deletedcompetencyscalevalue'] = 'The competency scale value "{$a}" has been deleted.';
$string['deleteframework'] = 'Delete {$a}';
$string['competencyaddedframework'] = 'The competency framework "{$a}" has been added';
$string['competencydeletedframework'] = 'The competency framework "{$a}" and its data have been completely deleted.';
$string['competencyerror:deletedframework'] = 'Error deleting competency framework "{$a}" and its data.';
$string['error:onescalevaluemustbeproficient'] = 'At least one scale value must be marked as proficient at all times. Set another scale value to proficent before unchecking this value.';
$string['error:couldnotdeletescale'] = 'There was a problem deleting the competency scale "{$a}"';
$string['error:nodeletecompetencyscalevaluedefault'] = 'You cannot delete that scale value because it is the default';
$string['error:nodeletecompetencyscalevalueonlyprof'] = 'You cannot delete that scale value because it is the only proficient value in this scale. Mark another value as proficient before deleting';
$string['error:nodeletecompetencyscaleinuse'] = 'You cannot delete that competency scale because it is in use';
$string['error:nodeletecompetencyscaleassigned'] = 'You cannot delete that competency scale because it is already assigned to one or more frameworks';
$string['deletedtemplate'] = 'The competency template {$a} and its data have been completely deleted.';
$string['depthlevel'] = 'Depth level';
$string['depthlevels'] = 'Depth levels';
$string['deletedepth'] = 'Delete {$a}';
$string['descriptionview'] = 'Description';
$string['selectcompetency'] = 'Select competency';
$string['selectedcompetencies'] = 'Selected competencies:';
$string['selectacompetencyframework'] = 'Select a competency framework';
$string['clicktoassign'] = 'Click the assign button to select a competency.';
$string['clicktoassigntemplate'] = 'Click the assign button to select a competency template.';
$string['clicktoviewchildren'] = 'Click competency name to view child competencies (if present).';
$string['deletecompetency'] = 'Delete competency';
$string['editcompetency'] = 'Edit competency';
$string['editdepthlevel'] = 'Edit depth level';
$string['editgeneric'] = 'Edit {$a}';
$string['competencyeditframework'] = 'Edit competency framework';
$string['editscalevalue'] = 'Edit scale value';
$string['notescalevalueentry'] = 'One value per line - from most competent to least';
$string['edittemplate'] = 'Edit competency template';
$string['error:compevidencealreadyexists'] = 'This user already has competency evidence for the chosen competency. You can <a href=\'edit.php?id={$a}\'>edit the existing competency</a>, or add a different one.';
$string['error:evidencealreadyexists'] = 'Could not create new competency evidence because a record already exists for that user and competency';
$string['evidence'] = 'Evidence';
$string['evidenceactivitycompletion'] = 'activity completion';
$string['competencyevidencecount'] = 'Evidence items';
$string['evidencecoursecompletion'] = 'course completion';
$string['evidencecoursegrade'] = 'course grade';
$string['evidenceitemremovecheck'] = 'Are you absolutely sure you want to remove this evidence item from "{$a}"?';
$string['evidenceitems'] = 'Evidence items';
$string['competencyfeatureplural'] = 'Competencies';
$string['competencyframework'] = 'Competency framework';
$string['competencyframeworks'] = 'Competency frameworks';
$string['competencyfullname'] = 'Competency full name';
$string['fullnamedepth'] = 'Depth level full name';
$string['fullnameview'] = 'Full name';
$string['fullnameframework'] = 'Fullname';
$string['fullnametemplate'] = 'Template full name';
$string['competencyidnumber'] = 'Competency ID number';
$string['positionframeworkidnumber'] = 'ID Number';
$string['organisationframeworkidnumber'] = 'ID Number';
$string['competencyframeworkidnumber'] = 'ID Number';
$string['idnumberview'] = 'ID Number';
$string['includecompetencyevidence'] = 'Include competency evidence';
$string['invalidevidencetype'] = 'Invalid evidence type';
$string['invalidnumeric'] = 'Numerical value must be numerical (or not set)';
$string['itemstoadd'] = 'Items to add';
$string['linktoscalevalues'] = '<a href="view.php?id={$a}&amp;type=competency">Click here</a> to view/edit the scale values for this competency scale.';
$string['linktoscalevalues11'] = '<a href="view.php?id={$a}&amp;prefix=competency">Click here</a> to view/edit the scale values for this competency scale.';
$string['locatecompetency'] = 'Locate competency';
$string['locatecompetencytemplate'] = 'Locate competency template';
$string['managecompetencies'] = 'Manage competencies';
$string['managecompetency'] = 'Manage competencies';
$string['missingscale'] = 'Missing scale';
$string['missingfullname'] = 'Missing competency full name';
$string['missingfullnamedepth'] = 'Missing depth level full name';
$string['missingfullnameframework'] = 'Missing framework full name';
$string['missingfullnametemplate'] = 'Missing template full name';
$string['competencymissingname'] = 'Missing competency name';
$string['competencymissingnameframework'] = 'Missing competency framework name';
$string['competencymissingnametype'] = 'Missing competency type name';
$string['missingnametemplate'] = 'Missing template name';
$string['missingscalevaluename'] = 'Missing scale value name';
$string['competencymissingshortname'] = 'Missing competency short name';
$string['missingshortnamedepth'] = 'Missing depth level short name';
$string['missingshortnameframework'] = 'Missing framework short name';
$string['missingshortnametemplate'] = 'Missing template short name';
$string['name'] = 'Name';
$string['noassignedcompetencies'] = 'No competencies assigned';
$string['noassignedcompetencytemplates'] = 'No competency templates assigned';
$string['noassignedcompetenciestotemplate'] = 'No competencies assigned to this template';
$string['nochildcompetencies'] = 'No child competencies';
$string['nochildcompetenciesfound'] = 'No child competencies found';
$string['nocoursesincat'] = 'No courses found in that category';
$string['nocompetenciesinframework'] = 'No competencies in this framework';
$string['nocompetency'] = 'No competencies defined';
$string['nocompetencyscales'] = 'You must define at least one competency scale with values before you can define a competency framework.';
$string['nocoursecompetencies'] = 'No course competencies';
$string['nodepthlevels'] = 'No depth levels in this framework';
$string['noevidenceitems'] = 'No evidence items setup for this competency';
$string['noevidencetypesavailable'] = 'No evidence types available in this course';
$string['competencynoframeworks'] = 'No competency frameworks defined';
$string['competencynoframeworkssetup'] = 'There are no competency frameworks setup for this site.';
$string['nonsensicalproficientvalues'] = 'Warning: You have proficient values below non-proficient values in this scale. Remember that your scale should be ordered from most proficient at the top, to least proficient at the bottom.';
$string['norelatedcompetencies'] = 'No related competencies';
$string['noscalevalues'] = 'There are no scale values defined for this scale.';
$string['notemplateinframework'] = 'No competency templates defined in this framework';
$string['notemplate'] = 'No competency templates defined';
$string['numericalvalue'] = 'Numerical value';
$string['options'] = 'Options';
$string['parent'] = 'Parent';
// duplication required to make help buttons work
$string['competencyevidenceuser'] = 'Competency Evidence User';
$string['competencyevidencecompetency'] = 'Evidence Competency';
$string['competencyevidenceassessor'] = 'Evidence Assessor';
$string['competencyevidenceassessorname'] = 'Evidence Assessor Name';
$string['competencyevidenceassessmenttype'] = 'Assessment Type';
$string['competencyevidenceposition'] = 'Evidence Position';
$string['competencyevidenceorganisation'] = 'Evidence Organisation';
$string['competencyevidencetimecompleted'] = 'Time Evidence Completed';
$string['addcompetencyevidence'] = 'Add Competency Evidence';
$string['organisationparent'] = 'Parent';
$string['positionparent'] = 'Parent';
$string['competencyparent'] = 'Parent';
$string['positions'] = 'Positions';
$string['proficiency'] = 'Proficiency';
$string['competencyscaleproficient'] = 'Proficient value';
$string['proficientvaluefrozen'] = 'You cannot change this setting because the scale is in use';
$string['proficientvaluefrozenonlyprof'] = 'You cannot change this setting because the scale must have at least one proficient value at all times';
$string['relatedcompetencies'] = 'Related Competencies';
$string['relateditemremovecheck'] = 'Are you absolutely sure you want to remove this competency relationship?';
$string['removedcompetencyevidenceitem'] = 'The <i>{$a}</i> evidence item and its data have been removed';
$string['removedcompetencyrelateditem'] = 'The competency <i>{$a}</i> is no longer related to this competency';
$string['removedcompetencytemplatecompetency'] = 'The competency <i>{$a}</i> is no longer assigned to this template';
$string['competencyreturntoframework'] = 'Return to competency framework';
$string['scaleadded'] = 'Competency scale "{$a}" added';
$string['scalescustomcreate'] = 'Add a new competency scale';
$string['scaleupdated'] = 'Competency scale "{$a}" updated';
$string['scaledeleted'] = 'Competency scale "{$a}" deleted';
$string['scaledefaultupdated'] = 'The scale\'s default value has been updated';
$string['competencyscalevalueidnumber'] = 'Scale value ID number';
$string['competencyscalevaluename'] = 'Scale value name';
$string['competencyscalevaluedescription'] = 'Description';
$string['competencyscalevaluenumericalvalue'] = 'Scale value numerical value';
$string['scalevalues'] = 'Scale values';
$string['scalevalueupdated'] = 'Competency scale value "{$a}" has been updated';
$string['scalevalueadded'] = 'Competency scale value "{$a}" has been added';
$string['selectcategoryandcourse'] = 'Select a course category then choose a course to pick evidence items from:';
$string['selectedcompetencytemplates'] = 'Selected competency templates:';
$string['set'] = 'Set';
$string['competencyshortname'] = 'Competency short name';
$string['shortnamedepth'] = 'Depth level short name';
$string['shortnameframework'] = 'Shortname';
$string['shortnametemplate'] = 'Template short name';
$string['shortnameview'] = 'Short name';
$string['template'] = 'Competency template';
$string['templatecompetencyremovecheck'] = 'Are you absolutely sure you want to unassign this competency from this template?';
$string['unknownbuttonclicked'] = 'Unknown button clicked';
$string['weight'] = 'Weight';
$string['currentlyselected'] = 'Currently selected';
$string['competencyerror:dialognotreeitems'] = 'No competencies in this framework';
$string['error:dialognolinkedcourseitems'] = 'There are no competencies in this framework with linked courses assigned to them';
$string['globalsettings'] = 'Global settings';
$string['useresourcelevelevidence'] = 'Use resource-level evidence';
$string['linkcourses'] = 'Link courses';
$string['competent'] = 'Competent';
$string['competentwithsupervision'] = 'Competent with supervision';
$string['notcompetent'] = 'Not competent';
$string['error:scaledetails'] = 'Error getting scale details.';
$string['competencytypes'] = 'Competency types';
$string['addtype'] = 'Add a new type';
$string['competencytypeview'] = 'Competency type view';
$string['competencytypecustomfields'] = 'Competency type custom fields';
$string['competencydeletedtype'] = 'The competency type "{$a}" has been completely deleted.';
$string['competencyupdatedframework'] = 'The competency framework "{$a}" has been updated';
$string['competencyupdatetype'] = 'The competency type "{$a}" has been updated';
$string['competencyerror:updatetype'] = 'Error updating competency type "{$a}"';
$string['competencycreatetype'] = 'The competency type "{$a}" has been created';
$string['competencyerror:createtype'] = 'Error creating completency type "{$a}"';
$string['competencyerror:deletedtype'] = 'Error deleting competency type "{$a}".';
$string['types'] = 'Types';
$string['competencynotypes'] = 'No competency types';
$string['deletetype'] = 'Delete type "{$a}"';
$string['edittype'] = 'Edit type';
$string['fullnametype'] = 'Type full name';
$string['managecompetencytypes'] = 'Manage types';
$string['missingfullnametype'] = 'Missing type full name';
$string['missingshortnametype'] = 'Missing type short name';
$string['notypelevels'] = 'No types in this framework';
$string['shortnametype'] = 'Type short name';
$string['organisation'] = 'Organisation';
$string['organisationplural'] = 'Organisations';
$string['addneworganisation'] = 'Add new organisation';
$string['addmultipleneworganisation'] = 'Add multiple organisations';
$string['organisationaddnewframework'] = 'Add new organisation framework';
$string['chooseorganisation'] = 'Choose organisation';
$string['organisations'] = 'Organisations';
$string['organisationaddnew'] = 'Add a new organisation';
$string['organisationbacktoallframeworks'] = 'Back to all organisation frameworks';
$string['bulkdeleteorganisation'] = 'Bulk delete organisations';
$string['bulkmoveorganisation'] = 'Bulk move organisations';
$string['organisationcustomfields'] = 'Custom fields';
$string['organisationframeworks'] = 'Organisation frameworks';
$string['organisationframework'] = 'Organisation Framework';
$string['organisationframeworks'] = 'Organisation Frameworks';
$string['organisationframeworkmanage'] = 'Manage frameworks';
$string['organisationmanage'] = 'Manage organisations';
$string['organisationdeletecheck'] = 'Are you sure you want to delete this organisation, all its children and the data they contain?';
$string['organisationdeletecheck11'] = 'Are you sure you want to delete the organisation "{$a}"?
<br /><br />
This will remove the following data:<br />
- The "{$a}" organisation';
$string['organisationdeletecheckwithchildren'] = 'Are you sure you want to delete the organisation "{$a->itemname}" and its {$a->children_string}?
<br /><br />
This will remove the following data: <br />
- The "{$a->itemname}" organisation and its {$a->childcount} {$a->children_string}';
$string['organisationdeletemulticheckwithchildren'] = 'Are you sure you want to delete {$a->num} organisation(s) and {$a->childcount} {$a->children_string}?
<br /><br />
This will remove the following data: <br />
- The {$a->num} organisation(s) and {$a->childcount} {$a->children_string}';
$string['organisationdeleteincludexposassignments'] = '- {$a} assignment(s) to this organisation (user\'s assigned to this organisation will be unassigned)';
$string['organisationdeleteincludexlinkedcompetencies'] = '- {$a} link(s) to competencies';
$string['deletedorganisation'] = 'The organisation "{$a}" and its children have been completely deleted';
$string['addedorganisation'] = 'The organisation "{$a}" has been added';
$string['error:addorganisation'] = 'There was a problem adding the organisation "{$a}"';
$string['updatedorganisation'] = 'The organisation "{$a}" has been updated';
$string['error:updateorganisation'] = 'There was a problem updating the organisation "{$a}"';
$string['organisationaddedframework'] = 'The organisation framework "{$a}" has been added';
$string['organisationdeletedframework'] = 'The organisation framework "{$a}" and its data have been completely deleted';
$string['organisationupdatedframework'] = 'The organisation framework "{$a}" has been updated';
$string['organisationerror:deletedframework'] = 'Error deleting organisation framework "{$a}" and its data.';
$string['deleteorganisation'] = 'Delete organisation';
$string['editorganisation'] = 'Edit organisation';
$string['organisationeditframework'] = 'Edit organisation framework';
$string['organisationfeatureplural'] = 'Organisations';
$string['organisationframework'] = 'Organisation framework';
$string['organisationfullname'] = 'Organisation full name';
$string['organisationidnumber'] = 'Organisation ID number';
$string['manageorganisations'] = 'Manage organisations';
$string['manageorganisation'] = 'Manage organisations';
$string['organisationmissingshortname'] = 'Missing organisation short name';
$string['organisationmissingname'] = 'Missing organisation name';
$string['organisationmissingnameframework'] = 'Missing organisation framework name';
$string['organisationmissingnametype'] = 'Missing organisation type name';
$string['nochildorganisations'] = 'No child organisations defined';
$string['noorganisation'] = 'No organisations defined';
$string['noorganisationsinframework'] = 'No organisations in this framework';
$string['organisationnoframeworks'] = 'No organisation frameworks available';
$string['organisationnoframeworkssetup'] = 'There are no organisation frameworks setup for this site.';
$string['organisationdepthcustomfields'] = 'Organisation depth custom fields';
$string['organisationreturntoframework'] = 'Return to organisation framework';
$string['organisationshortname'] = 'Organisation short name';
$string['nounassignedcompetencies'] = 'No unassigned competencies';
$string['nounassignedcompetencytemplates'] = 'No unassigned competency templates';
$string['competencyassigndeletecheck'] = 'Are you sure you would like to remove this competency assignment?';
$string['organisationdeletedassignedcompetency'] = 'Competency successfully unassigned from this organisation';
$string['organisationerror:deleteassignedcompetency'] = 'Error unassigning competency from this organisation';
$string['organisationerror:dialognotreeitems'] = 'No organisations in this framework';
$string['manageorganisationtypes'] = 'Manage types';
$string['organisationdeletedtype'] = 'The organisation type "{$a}" has been completely deleted';
$string['organisationupdatetype'] = 'The organisation type "{$a}" has been updated';
$string['organisationerror:updatetype'] = 'Error updating organisation type "{$a}"';
$string['organisationcreatetype'] = 'The organisation type "{$a}" has been created';
$string['organisationerror:createtype'] = 'Error creating organisation type "{$a}"';
$string['organisationerror:deletedtype'] = 'Error deleting organisation type "{$a}".';
$string['edittypelevel'] = 'Edit type';
$string['organisationnotypes'] = 'No organisation types';
$string['organisationtypecustomfields'] = 'Organisation type custom fields';
$string['organisationtypes'] = 'Organisation types';
$string['addnewposition'] = 'Add new position';
$string['addmultiplenewposition'] = 'Add multiple positions';
$string['positionaddnewframework'] = 'Add new position framework';
$string['choosemanager'] = 'Choose manager';
$string['chooseposition'] = 'Choose position';
$string['position'] = 'Position';
$string['positionplural'] = 'Positions';
$string['positionaddnew'] = 'Add a new position';
$string['positionbulkaction'] = 'Bulk actions';
$string['positionbacktoallframeworks'] = 'Back to all position frameworks';
$string['bulkdeleteposition'] = 'Bulk delete positions';
$string['bulkmoveposition'] = 'Bulk move positions';
$string['positionframeworks'] = 'Frameworks';
$string['positionframework'] = 'Position framework';
$string['positionframeworks'] = 'Position frameworks';
$string['positionframeworkmanage'] = 'Manage frameworks';
$string['positionmanage'] = 'Manage positions';
$string['positioncustomfields'] = 'Custom fields';
$string['positiondepthcustomfields'] = 'Position depth custom fields';
$string['positiondeletecheck'] = 'Are you sure you want to delete this position, all its children and the data they contain?';
$string['positiondeletecheck11'] = 'Are you sure you want to delete the position "{$a}"?
<br /><br />
This will remove the following data:<br />
- The "{$a}" position';
$string['positiondeletecheckwithchildren'] = 'Are you sure you want to delete the position "{$a->itemname}" and its {$a->children_string}?
<br /><br />
This will remove the following data: <br />
- The "{$a->itemname}" position and its {$a->childcount} {$a->children_string}';
$string['positiondeletemulticheckwithchildren'] = 'Are you sure you want to delete {$a->num} position(s) and {$a->childcount} {$a->children_string}?
<br /><br />
This will remove the following data: <br />
- The {$a->num} position(s) and {$a->childcount} {$a->children_string}';
$string['positiondeleteincludexposassignments'] = '- {$a} assignment to this position (user\'s assigned to this position will be unassigned)';
$string['positiondeleteincludexlinkedcompetencies'] = '- {$a} links to competencies';
$string['addedposition'] = 'The position "{$a}" has been added';
$string['error:addposition'] = 'There was a problem adding the position "{$a}"';
$string['deletedposition'] = 'The position {$a} and it\'s children have been completely deleted';
$string['updatedposition'] = 'The position "{$a}" has been updated';
$string['error:updateposition'] = 'There was a problem updating the position "{$a}"';
$string['error:noposenabled'] = 'No position types enabled';
$string['error:postypenotenabled'] = 'Position type not enabled';
$string['positiondeletedassignedcompetency'] = 'Competency unassigned successfully from this position';
$string['positionerror:deleteassignedcompetency'] = 'Error unassigning competency from this position';
$string['deletedposition'] = 'The position {$a} and its children have been completely deleted';
$string['positionaddedframework'] = 'The position framework "{$a}" has been added';
$string['positiondeletedframework'] = 'The position framework "{$a}" and its data have been completely deleted';
$string['positionupdatedframework'] = 'The position framework "{$a}" has been updated';
$string['positionerror:deletedframework'] = 'Error deleting position framework "{$a}" and its data.';
$string['positionsenabled'] = 'Positions enabled';
$string['positionsenabled_help'] = $string['reportbuilderexportoptions_help'] = '
**Positions enabled settings** allows a user with the appropriate permissions to specify the positions that are available in the system.

When no options are selected, the position functionality will be disabled completely.';
$string['positionsettings'] = 'Position settings';
$string['deleteposition'] = 'Delete position';
$string['editposition'] = 'Edit position';
$string['positioneditframework'] = 'Edit position framework';
$string['positionfeatureplural'] = 'Positions';
$string['finishdate'] = 'Finish date';
$string['positionframework'] = 'Position framework';
$string['positionfullname'] = 'Position full name';
$string['positionidnumber'] = 'Position ID number';
$string['positionframeworkdescription'] = 'Description';
$string['organisationframeworkdescription'] = 'Description';
$string['competencyframeworkdescription'] = 'Description';
$string['manager'] = 'Manager';
$string['managepositions'] = 'Manage positions';
$string['manageposition'] = 'Manage positions';
$string['positionmissingname'] = 'Missing position name';
$string['positionmissingnameframework'] = 'Missing position framework name';
$string['positionmissingnametype'] = 'Missing position type name';
$string['positionmissingshortname'] = 'Missing position short name';
$string['nocompetenciesassignedtoposition'] = 'No competencies assigned to position';
$string['nopositionsinframework'] = 'No positions in this framework';
$string['positionnoframeworks'] = 'No position frameworks available';
$string['positionnoframeworkssetup'] = 'There are no position frameworks setup for this site.';
$string['nopositionsassigned'] = 'No positions currently assigned to this user';
$string['noposition'] = 'No positions defined';
$string['nopositionset'] = 'No position set';
$string['position'] = 'Position';
$string['positionhistory'] = 'Position history';
$string['positionsaved'] = 'Position saved.';
$string['positionreturntoframework'] = 'Return to position framework';
$string['positionshortname'] = 'Position short name';
$string['startdate'] = 'Start date';
$string['titlefullname'] = 'Title (fullname)';
$string['titleshortname'] = 'Title (shortname)';
$string['typeprimary'] = 'Primary position';
$string['typesecondary'] = 'Secondary position';
$string['typeaspirational'] = 'Aspirational position';
$string['updateposition'] = 'Update position';
$string['error:dateformat'] = 'Please enter a date in the format {$a}.';
$string['error:startafterfinish'] = 'Start date must not be later than finish date';
$string['entervaliddate'] = 'Enter a valid date';
$string['positionerror:dialognotreeitems'] = 'No positions in this framework';
$string['error:positionnotset'] = 'A position has not been set for this user';
$string['error:userownmanager'] = 'A user cannot be assigned as their own manager';
$string['managepositiontypes'] = 'Manage types';
$string['positiontypecustomfields'] = 'Position type custom fields';
$string['positiondeletedtype'] = 'The position type "{$a}" has been completely deleted';
$string['positionupdatetype'] = 'The position type "{$a}" has been updated';
$string['positionerror:updatetype'] = 'Error updating position type "{$a}"';
$string['positioncreatetype'] = 'The position type "{$a}" has been created';
$string['positionerror:createtype'] = 'Error creating position type "{$a}"';
$string['positionerror:deletedtype'] = 'Error deleting position type "{$a}".';
$string['positionnotypes'] = 'No position types';
$string['positiontypes'] = 'Position types';
$string['useraspirationalposition'] = 'Aspirational Position';
//Help strings
$string['titlefullname_help'] = 'This is the full name of the position (job role) title';
$string['titleshortname_help'] = 'This is the short name of the position (job role) title and can be used for display purposes. ';
$string['chooseposition_help'] = 'Click **Choose position** to select the correct position (job role) for the user. This is useful for reporting purposes.';
$string['useraspirationalposition_help'] = 'This is the target position the user will be progressing towards. Click **Choose position** to select the user\'s aspirational position from position framework(s) set up.';
$string['chooseorganisation_help'] = 'Click **Choose organisation** to select where the user works in the organisation. This will be useful for reporting purposes.';
$string['choosemanager_help'] = 'Click **Choose manager** to select the user\'s manager.

If the name you are looking for does not appear in the list, a site administrator will need to ensure that the user has been assigned to the "Manager" role.';
$string['startdate_help'] = 'Click the calendar icon to select the date the user started in that position.';
$string['finishdate_help'] = 'Click the calendar icon to select the date the user finished in that position.';

$string['fullnametype_help'] = 'Type full name';
$string['positiontypedescription_help'] = 'A longer text description of the position type';
$string['organisationtypedescription_help'] = 'A longer text description of the organisation type';
$string['competencytypedescription_help'] = 'A longer text description of the competency type';
$string['organisationframeworkfullname_help'] = 'The framework full name is the complete title of the framework.';
$string['organisationframeworkdescription_help'] = 'The framework description is a text field for storing additional information about the framework. It is displayed on the manage organisations page, just above the table of organisations.';
$string['organisationframeworkidnumber_help'] = 'The framework ID number is a unique number that can be used to represent the framework.</h1>';
$string['organisationframeworkshortname_help'] = 'The framework short name is a quick reference to the framework\'s full name and can be used for display purposes.';
$string['organisationfullname_help'] = 'Organisation full name is the complete title of the organisation.';
$string['organisationframework_help'] = '**Organisation framework** is the name of the framework where you define your organisation.';
$string['organisationframeworks_help'] = 'An **Organisational Framework** is set up to hold the organisational structure of your organisation.

You can set up multiple organisational frameworks. For example: set up a framework for subdivisions or subsidiaries of a business.';
$string['competencytype_help'] = 'Administrators can create and assign types of competencies. If a competency is assigned a type it inherits any custom fields that have been assigned to that type. This allows you to organise meta-data relating to your competencies and only show the fields that each sort of competency needs.';
$string['competencyshortname_help'] = 'Competency short name is the quick reference name of the competency and can be used for display purposes.';
$string['competencyscalevaluenumericalvalue_help'] = 'Scale value numerical value is the numerical value associated with the scale value.';
$string['competencyscalevaluedescription_help'] = 'A longer description of the competency scale value';
$string['competencytemplatefullname_help'] = 'Template full name is the complete title of the competency template being set up.';
$string['competencytemplategeneral_help'] = 'A **Competency Template** is a way of grouping competencies from one competency framework together.

When setting up a training event, for example an induction course, this could be linked to a competency template called \'new employee competencies\'; drawing automatically on a number of competencies, instead of repeatedly selecting the competencies one by one.';
$string['organisationidnumber_help'] = 'Organisation ID number is a unique number used to represent the organisation.';
$string['competencytemplateshortname_help'] = 'emplate short name is a quick reference name for the competency template and can be used for display purposes.';
$string['organisationdescription_help'] = 'A free-text field for providing more details about this organisation. This data is displayed when viewing the hieararchy listing, and the individual organisation page.';
$string['organisationparent_help'] = '**Parent organisation** allows you to manage parent/child relationships between organisations.

Select the **Parent organisation** from the dropdown menu. Select **Top** if you want the organisation to sit at the top level of the hierarchy.

If you change the parent organisation of an item it will move to sit below its new parent, and all of its children will move with it.

**Note:** to set up parent/child relationships you need to have at least one other item in the framework. Otherwise the option will not appear.';
$string['positionfullname_help'] = '**Position full name** is the complete job title.';
$string['positionframeworkshortname_help'] = 'The framework short name is a quick reference to the framework’s full name and can be used for display purposes.';
$string['positionidnumber_help'] = '**Position ID number** is a unique number used to represent the position. This is an optional field.';
$string['positionparent_help'] = '**Parent position** allows you to manage parent/child relationships between positions.

Select the **Parent position** from the dropdown menu. Select **Top** if you want the position to sit at the top level of the hierarchy.

If you change the parent position of an item it will move to sit below its new parent, and all of its children will move with it.

**Note:** to set up parent/child relationships you need to have at least one other item in the framework. Otherwise the option will not appear.';
$string['positiontype_help'] = 'Administrators can create and assign types of positions. If a position is assigned a type it inherits any custom fields that have been assigned to that type. This allows you to organise meta-data relating to your positions and only show the fields that each sort of position needs.';
$string['positionshortname_help'] = '**Position short name** is the quick reference name of the job title and can be used for display purposes.';
$string['positionframeworks_help'] = 'A **Position framework** is used to set up and hold the different positions in the organisation.

You can set up multiple positions\' taxonomies (frameworks) within an organisation.';
$string['positionframeworkidnumber_help'] = 'The Framework ID number is a unique number that can be used to represent the framework.';
$string['organisationtype_help'] = 'Administrators can create and assign types of organisations. If an organisation is assigned a type it inherits any custom fields that have been assigned to that type. This allows you to organise meta-data relating to your organisations and only show the fields that each sort of organisation needs.';
$string['organisationshortname_help'] = 'Organsation short name is a quick reference name for the organsation and can be used for display purposes.';
$string['positiondescription_help'] = 'A free-text field for providing more details about this position. This data is displayed when viewing the hieararchy listing, and the individual position page.';
$string['positionframework_help'] = '**Position Framework** is a specific framework for setting up a list of positions (job roles). You can have multiple position frameworks (lists).';
$string['positionframeworkfullname_help'] = 'The framework full name is the complete title of the framework.';
$string['positionframeworkdescription_help'] = 'The framework description is a text field for storing additional information about the framework. It is displayed on the manage positions page, just above the table of positions.';
$string['competencyscalevaluename_help'] = '**Scale value name** is the name of the competency scale value you are adding or editing.

A scale value is used to define a learner’s progress for a competency. You can add as many scale values as required.

**Note:** remember to set the Default and Proficient value settings.';
$string['competencyscalesgeneral_help'] = '**Competency scales** enable you to define the criteria by which a competency can be measured. For example, a scale might have three values \'competent, competent with supervision, not competent\'.

You must have a competency scale set up before you set up a competency framework, or any competencies.';
$string['competencyevidenceproficiency_help'] = 'This field records whether or not the user is deemed to be proficient at the assigned competency. The options that appear in the pulldown depend on the competency scale assigned to the chosen competency, so the competency must be selected before this field can be modified. A proficiency must be set to add or update a competency evidence record.';
$string['competencyevidenceposition_help'] = 'This option records the position the user was in at the time they completed the item of competency evidence. In most cases this will be the same as the user\'s current role. As users change roles over time this allows a record to be kept of the role they were in at time of completion. This is an optional field.';
$string['competencyevidencetimecompleted_help'] = 'A record of when the competency evidence was completed.';
$string['competencyevidenceuser_help'] = 'The user whom this item of competency evidence is assigned. It is not possible to reassign an item of competency evidence to a different user. If you have sufficient permissions you can create a new item of competency evidence for a user by clicking the button on the user\'s My Records page. You can also edit evidence for that user by finding the record in the report and clicking the edit icon.';
$string['competencyframeworkdescription_help'] = 'The framework description is a text field for storing additional information about the framework. It is displayed on the manage competencies page, just above the table of competencies.';
$string['competencyframework_help'] = 'Competencies are grouped or categorised and stored in a ‘Competency framework’. Once a competency framework is set up, competencies can be set up within it.';
$string['competencyevidenceorganisation_help'] = 'This option records the organisation the user was in at the time they completed the item of competency evidence. In most cases this will be the same as the user\'s current organisation. As users change organisation over time this allows a record to be kept of where they were in at time of completion. This is an optional field.';
$string['competencyevidencecompetency_help'] = 'The competency to be assigned to the user. If you are editing an existing item of competency evidence, this cannot be changed. You can however create a new item of competency evidence (if you have permission to do so) by visiting the user\'s My Records page and clicking the \'Add competencyevidence\' button.

When creating a new competency evidence item you can choose between adding evidence for an existing competency or creating a new competency. If you choose \'Select a competency\' a popup will allow you to pick from the existing competencies. If you choose \'Create a new competency\' a form will appear where you can choose a framework and define the new competency.

Note that you cannot create two competency evidence items that refer to the same user and competency. If you try to do this you will be provided with a link to edit the original record or choose a different competency.';
$string['competencydescription_help'] = 'A free-text field for providing more details about this competency. This data is displayed when viewing the hieararchy listing, and the individual competency page.';
$string['competencyaggregationmethod_help'] = 'The aggregation method sets how the system will calculate the competency achievement.

If the aggregation method is set to All then all the child competencies will have to be achieved for the parent competency to be declared achieved.

If the aggregation method is set to Any then only one of the child competencies needs to be met to successfully achieve the parent competency.

If the aggregation method is set to Off then automatic achievement will be deactivated for this competency. (It may still be marked achieved manually.)';
$string['competencyevidenceassessmenttype_help'] = 'The assessment type field is a free text field for any additional information about the assessment of this competency. Contents may vary and the field is optional.';
$string['competencyevidenceassessor_help'] = 'You can select an assessor, which is a user who assessed that the current user proficient in the current competency. Assessor is an optional field so leave the pulldown on the \'Select an assessor...\' option if you do not want to assign an assessor.

The pulldown lists all moodle users who are in the assessor role. If the user you wish to add is missing or no options are shown then you will need to ask an administrator to add that user to the assessor role.';
$string['competencyevidenceassessorname_help'] = 'The Assessor Name field refers to the name of the organisation that did the assessment of the user for this competency. It is an optional field so can be left blank.';
$string['competencyscalevalueidnumber_help'] = 'Scale ID number is a unique number used to represent the scale value.';
$string['competencyframeworkfullname_help'] = 'The framework full name is the complete title of the framework.';
$string['competencyscaleassign_help'] = 'A Competency scales defines the criteria by which a competency can be measured. This is the name of scale the value is being added to.';
$string['competencyscale_help'] = '**Scale** is the name of the Competency Scale that is used in the competency framework.

The competency scale is set in the competency framework. Only one competency scale can be used in each framework.

A new competency scale can be set up under Hierarchies/Competencies/Manage Frameworks in the \'Site Administration\' menu.';
$string['competencyscaledefault_help'] = 'The **Default Value** is automatically assigned to a user when they have not yet demonstrated the proficiency required by the competency\'s specified evidence item(s) (course/activity completion, or passing course/activity grade).';
$string['competencyscaleproficient_help'] = 'Proficient values provide a way for the system to track if a user is \'competent\' in a particular competency. This is used to show progress in learning plans and only show overdue notices for incomplete competencies.
A user is considered \'competent\' if the scale value set has \'proficent\' checked. You can have multiple scale values set to proficient, but you must have at least one scale value marked as proficient. The proficient value is edited by editing the scale value.

The lowest scale value that is marked as proficient is automatically given to any user who has demonstrated the proficiency required by the competency\'s specified evidence item(s) (e.g., course/activity completion, passing course/activity grade).';
$string['competencyscalescalevalues_help'] = 'Enter values for the competency scale (one per line), in order from most competent to least competent. For example:

<p class="indent">
  <i> Competent<br /> Competent with Supervision<br /> Not Competent<br /> </i>
</p>';
$string['competencyscalescalename_help'] = 'The name of the Competency Scale that will be used by Competency frameworks.';
$string['competencyframeworkgeneral_help'] = '**Competency Frameworks** are set up to hold the skills, knowledge and behavioural competencies you expect staff to achieve.

Competencies may be grouped under different kinds of framework. For example, one framework could hold all industry national competency standards (taken from an industry body), while another framework could hold specific competencies set up in-house.

Before you set up a competency framework you must have a **Competency Scale** set up.';
$string['competencyparent_help'] = '**Parent competency** allows you to manage parent/child relationships between competencies.

Select the **Parent competency** from the dropdown menu. Select **Top** if you want the competency to sit at the top level of the hierarchy.

If you change the parent competency of an item it will move to sit below its new parent, and all of its children will move with it.

**Note:** to set up parent/child relationships you need to have at least one other item in the framework. Otherwise the option will not appear.';
$string['competencyframeworks_help'] = '**Competency Frameworks** are set up to hold the skills, knowledge and behavioural competencies you expect staff to achieve.

Competencies may be grouped under different kinds of framework. For example, one framework could hold all industry national competency standards (taken from an industry body), while another framework could hold specific competencies set up in-house.

Before you set up a competency framework you must have a **Competency Scale** set up.';
$string['competencyframeworkidnumber_help'] = 'The framework ID number is a unique number that can be used to represent the framework.</h1>';
$string['competencyidnumber_help'] = 'Competency ID number is a unique number used to represent the competency.';
$string['competencyframeworkscale_help'] = 'Competency scales enable you to define the criteria by which a competency can be measured. For example, a scale might have three values ‘competent, competent with supervision, not competent’.

The first step is to use the Competency scales option to add a new scale, then to add the scale values which are used to define a learner’s progress for a competency. You can add as many values as you wish. Note also the Default and Proficient value settings.';
$string['competencyframeworkshortname_help'] = 'The framework short name is a quick reference to the framework\'s full name and can be used for display purposes.';
$string['competencyfullname_help'] = 'Competency full name is the complete title of the competency.';

$string['hierarchy:viewcompetency'] = 'View a competency';
$string['hierarchy:createcompetency'] = 'Create a competency';
$string['hierarchy:updatecompetency'] = 'Update a competency';
$string['hierarchy:deletecompetency'] = 'Delete a competency';
$string['hierarchy:createcompetencydepth'] = 'Create a competency depth';
$string['hierarchy:updatecompetencydepth'] = 'Update a competency depth';
$string['hierarchy:deletecompetencydepth'] = 'Delete a comptency depth';
$string['hierarchy:createcompetencytype'] = 'Create a competency type';
$string['hierarchy:updatecompetencytype'] = 'Update a competency type';
$string['hierarchy:deletecompetencytype'] = 'Delete a comptency type';
$string['hierarchy:createcompetencyframeworks'] = 'Create a competency framework';
$string['hierarchy:updatecompetencyframeworks'] = 'Update a competency framework';
$string['hierarchy:deletecompetencyframeworks'] = 'Delete a competency framework';
$string['hierarchy:createcompetencytemplate'] = 'Create a competency template';
$string['hierarchy:updatecompetencytemplate'] = 'Update a competency template';
$string['hierarchy:deletecompetencytemplate'] = 'Delete a competency template';
$string['hierarchy:createcompetencycustomfield'] = 'Create a competency custom field';
$string['hierarchy:updatecompetencycustomfield'] = 'Update a competency custom field';
$string['hierarchy:deletecompetencycustomfield'] = 'Delete a competency custom field';
$string['hierarchy:assignselfposition'] = 'Assign self position';
$string['hierarchy:assignuserposition'] = 'Assign user position';
$string['hierarchy:viewposition'] = 'View a position';
$string['hierarchy:createposition'] = 'Create a position';
$string['hierarchy:updateposition'] = 'Update a position';
$string['hierarchy:deleteposition'] = 'Delete a position';
$string['hierarchy:createpositiondepth'] = 'Create a position depth';
$string['hierarchy:updatepositiondepth'] = 'Update a position depth';
$string['hierarchy:deletepositiondepth'] = 'Delete a position depth';
$string['hierarchy:createpositiontype'] = 'Create a position type';
$string['hierarchy:updatepositiontype'] = 'Update a position type';
$string['hierarchy:deletepositiontype'] = 'Delete a position type';
$string['hierarchy:createpositionframeworks'] = 'Create a position framework';
$string['hierarchy:updatepositionframeworks'] = 'Update a position framework';
$string['hierarchy:deletepositionframeworks'] = 'Delete a position framework';
$string['hierarchy:createpositioncustomfield'] = 'Create a position custom field';
$string['hierarchy:updatepositioncustomfield'] = 'Update a position custom field';
$string['hierarchy:deletepositioncustomfield'] = 'Delete a position custom field';
$string['hierarchy:vieworganisation'] = 'View an organisation';
$string['hierarchy:createorganisation'] = 'Create an organisation';
$string['hierarchy:updateorganisation'] = 'Update an organisation';
$string['hierarchy:deleteorganisation'] = 'Delete an organisation';
$string['hierarchy:createorganisationdepth'] = 'Create an organisational depth';
$string['hierarchy:updateorganisationdepth'] = 'Update an organisational depth';
$string['hierarchy:deleteorganisationdepth'] = 'Delete an organisational depth';
$string['hierarchy:createorganisationtype'] = 'Create an organisational type';
$string['hierarchy:updateorganisationtype'] = 'Update an organisational type';
$string['hierarchy:deleteorganisationtype'] = 'Delete an organisational type';
$string['hierarchy:createorganisationframeworks'] = 'Create an organisational framework';
$string['hierarchy:updateorganisationframeworks'] = 'Update an organisational framework';
$string['hierarchy:deleteorganisationframeworks'] = 'Delete an organisational framework';
$string['hierarchy:createorganisationcustomfield'] = 'Create an organisation custom field';
$string['hierarchy:updateorganisationcustomfield'] = 'Update an organisation custom field';
$string['hierarchy:deleteorganisationcustomfield'] = 'Delete an organisation custom field';
$string['hierarchy:createcoursecustomfield'] = 'Create a course custom field';
$string['hierarchy:updatecoursecustomfield'] = 'Update a course custom field';
$string['hierarchy:deletecoursecustomfield'] = 'Delete a course custom field';


