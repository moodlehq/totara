<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage totara_sync
 */
$string['pluginname'] = 'Totara sync';

$string['sync'] = 'Sync';
$string['totarasync'] = 'Totara sync';
$string['totarasync_help'] = 'Enabling Totara syncing will cause the element to be updated/deleted (synced) from an external source (if configured).
See the Sync settings in the Administration menu.';
$string['totara_sync:manage'] = 'Manage Totara sync';
$string['totara_sync:setfileaccess'] = 'Set Totara sync file access';
$string['totara_sync:manageuser'] = 'Manage Totara sync users';
$string['totara_sync:manageorg'] = 'Manage Totara sync organisations';
$string['totara_sync:managepos'] = 'Manage Totara sync positions';
$string['totara_sync:uploaduser'] = 'Upload Totara sync users';
$string['totara_sync:uploadorg'] = 'Upload Totara sync organisations';
$string['totara_sync:uploadpos'] = 'Upload Totara sync positions';
$string['settingssaved'] = 'Settings saved';
$string['elementenabled'] = 'Element enabled';
$string['elementdisabled'] = 'Element disabled';
$string['filesdir'] = 'Files directory';
$string['fileaccess'] = 'File Access';
$string['fileaccess_directory'] = 'Directory Check';
$string['fileaccess_upload'] = 'Upload Files';
$string['uploadsuccess'] = 'Sync files uploaded successfully';
$string['uploaderror'] = 'The was a problem with uploading the file(s)...';
$string['uploadaccessdenied'] = 'Your Totara Sync configuration is set to look for files in a server directory not use uploaded files. To change this go {$a}';
$string['uploadaccessdeniedlink'] = 'here';
$string['couldnotmakedirsforx'] = 'Could not make necessary directories for {$a}';
$string['note:syncfilepending'] = 'NOTE: A pending sync file exists. Uploading another file now will overwrite the pending one.';
$string['placeholderposition'] = 'Placeholder position';
//
// Elements
//
$string['element'] = 'Element';
$string['elements'] = 'Elements';
$string['elementnotfound'] = 'Element not found';
$string['manageelements'] = 'Manage elements';
$string['managesyncelements'] = 'Manage sync elements';
$string['noenabledelements'] = 'No enabled elements';
$string['elementxnotfound'] = 'Element {$a} not found';

// Hierarchy items
$string['displayname:org'] = 'Organisation';
$string['settings:org'] = 'Organisation element settings';
$string['displayname:pos'] = 'Position';
$string['settings:pos'] = 'Position element settings';
$string['removeitems'] = 'Remove items';
$string['removeitemsdesc'] = 'Specify what to do with internal items during sync when item was removed from source.';

// User
$string['displayname:user'] = 'User';
$string['settings:user'] = 'User element settings';
$string['removeusers'] = 'Remove users';
$string['removeusersdesc'] = 'Specify what to do with internal user accounts during sync when user was removed from source. Users are automatically revived if they reappear in source.';
$string['keep'] = 'Keep';
$string['delete'] = 'Delete';
$string['deleted'] = 'Deleted';
$string['sourceallrecords'] = 'Source contains all records';
$string['sourceallrecordsdesc'] = 'Does the source provide all sync records, everytime <strong>OR</strong> are only records that need to be updated/deleted provided? If "No" (only records to be updated/deleted), then the source must use the <strong>"delete" flag</strong>.';


///
/// Sources
///
$string['source'] = 'Source';
$string['sources'] = 'Sources';
$string['sourcenotfound'] = 'Source not found';
$string['sourcesettings'] = 'Source settings';
$string['configuresource'] = 'Configure source';
$string['nosources'] = 'No sources';
$string['filedetails'] = 'File details';
$string['nameandloc'] = 'Name and location';
$string['fieldmappings'] = 'Field mappings';
$string['uploadsyncfiles'] = 'Upload sync files';
$string['sourcedoesnotusefiles'] = 'Source does not use files';
$string['nosourceconfig'] = 'No source configuration';
$string['uploadfilelink'] = 'Files can be uploaded <a href=\'{$a}\'>here</a>';

// Hierarchy items
$string['displayname:totara_sync_source_org_csv'] = 'CSV';
$string['displayname:totara_sync_source_pos_csv'] = 'CSV';
$string['settings:totara_sync_source_org_csv'] = 'Organisation - CSV source settings';
$string['settings:totara_sync_source_pos_csv'] = 'Position - CSV source settings';

// User
$string['displayname:totara_sync_source_user_csv'] = 'CSV';
$string['settings:totara_sync_source_user_csv'] = 'User - CSV source settings';
$string['importfields'] = 'Fields to import';
$string['firstname'] = 'Firstname';
$string['lastname'] = 'Lastname';
$string['email'] = 'Email';
$string['city'] = 'City';
$string['country'] = 'Country';
$string['timezone'] = 'Timezone';
$string['lang'] = 'Language';
$string['description'] = 'Description';
$string['url'] = 'URL';
$string['institution'] = 'Institution';
$string['department'] = 'Department';
$string['phone1'] = 'Phone 1';
$string['phone2'] = 'Phone 2';
$string['address'] = 'Address';
$string['orgidnumber'] = 'Organisation';
$string['postitle'] = 'Position title';
$string['posidnumber'] = 'Position';
$string['manageridnumber'] = 'Manager';
$string['auth'] = 'Auth';
$string['password'] = 'Password';
$string['customfields'] = 'Custom fields';
$string['csvimportfilestructinfo'] = 'The current config requires a CSV file with the following structure:<br><pre>{$a}<br>...<br>...<br>...</pre>';


///
/// Log messages
///
$string['temptableprepfail'] = 'temp table preparation failed';
$string['temptablecreatefail'] = 'error creating temp table';
$string['nocsvfilepath'] = 'no CSV filepath specified';
$string['nofilesdir'] = 'No sync files directory configured';
$string['nofiletosync'] = 'No file to sync (file path: {$a})';
$string['nofileuploaded'] = 'No file was uploaded for {$a} sync';
$string['nochangesskippingsync'] = 'no changes, skipping sync';
$string['cannotopenx'] = 'cannot open {$a}';
$string['cannotreadx'] = 'cannot read {$a}';
$string['csvnotvalidmissingfieldx'] = 'CSV file not valid, missing field "{$a}"';
$string['csvnotvalidmissingfieldxmappingx'] = 'CSV file not valid, missing field "{$a->field}" (mapping for "{$a->mapping}")';
$string['couldnotimportallrecords'] = 'could not import all records';
$string['syncstarted'] = 'sync started';
$string['syncfinished'] = 'sync finished';
$string['couldnotgetsourcetable'] = 'could not get source table, aborting...';
$string['couldnotcreateclonetable'] = 'could not create clone table, aborting...';
$string['sanitycheckfailed'] = 'sanity check failed, aborting...';
$string['cannotdeletex'] = 'cannot delete {$a} (might already be deleted)';
$string['deletedx'] = 'deleted {$a}';
$string['frameworkxnotfound'] = 'framework {$a} not found...';
$string['parentxnotfound'] = 'parent {$a} not found...';
$string['cannotsyncitemparent'] = 'cannot sync item\'s parent {$a}';
$string['cannotcreatex'] = 'cannot create {$a}';
$string['cannotcreatedirx'] = 'cannot create directory: {$a}';
$string['createdx'] = 'created {$a}';
$string['cannotupdatex'] = 'cannot update {$a}';
$string['updatedx'] = 'updated {$a}';
$string['frameworkxnotexist'] = 'framework {$a} does not exist';
$string['parentxnotexistinfile'] = 'parent {$a} does not exist in sync file';
$string['typexnotexist'] = 'type {$a} does not exist';
$string['circularreferror'] = 'circular reference error between items {$a->naughtynodes}';
$string['customfieldsnotype'] = 'custom fields specified, but no type {$a}';
$string['typexnotfound'] = 'type {$a} not found...';
$string['customfieldnotexist'] = 'custom field {$a->shortname} does not exist (type:{$a->typeidnumber})';
$string['cannotdeleteuserx'] = 'cannot delete user {$a}';
$string['deleteduserx'] = 'deleted user {$a}';
$string['syncaborted'] = 'sync aborted';
$string['cannotupdateuserx'] = 'cannot update user {$a}';
$string['cannotsetuserpassword'] = 'cannot set user password (user:{$a})';
$string['cannotsetuserpasswordnoauthsupport'] = 'cannot set user password (user:{$a}), auth plugin does not support password changes';
$string['updateduserx'] = 'updated user {$a}';
$string['reviveduserx'] = 'revived user {$a}';
$string['cannotreviveuserx'] = 'cannot revive user {$a}';
$string['cannotfindmanagerxforusery'] = 'cannot find manager {$a->manageridnumber} for user {$a->idnumber}';
$string['cannotcreatemanagerxforusery'] = 'cannot create manager {$a->manageridnumber} for user {$a->idnumber}';
$string['cannotcreateuserassignments'] = 'cannot createa user assignments (user: {$a})';
$string['createduserx'] = 'created user {$a}';
$string['cannotcreateuserx'] = 'cannot create user {$a}';
$string['orgxnotexist'] = 'org {$a} does not exist';
$string['posxnotexist'] = 'pos {$a} does not exist';
$string['managerxnotexist'] = 'manager {$a} does not exist';
$string['nosourceconfigured'] = 'No source configured, please set configuration <a href=\'{$a}\'>here</a>';
$string['duplicateuserswithidnumberx'] = 'Duplicate users with idnumber {$a->idnumber}';
$string['duplicateidnumberx'] = 'Duplicate idnumber {$a}';
$string['fieldcountmismatch'] = 'Skipping row {$a->rownum} in CSV file - {$a->fieldcount} fields found but {$a->headercount} fields expected';
$string['nosynctablemethodforsourcex'] = 'Source {$a} has no get_sync_table method. This needs to be fixed by a programmer.';
$string['sourcefilexnotfound'] = 'Source file {$a} not found.';
$string['sourceclassxnotfound'] = 'Source class {$a} not found. This must be fixed by a programmer.';
$string['nosourceenabled'] = 'No source enabled for this element.';


///
/// Totara sync log reports
///
$string['synclog'] = 'Sync log';
$string['sourcetitle'] = 'Totara Sync Log';
$string['datetime'] = 'Date/Time';
$string['logtype'] = 'Log type';
$string['error'] = 'Error';
$string['info'] = 'Info';
$string['warn'] = 'Warning';
$string['action'] = 'Action';
$string['info'] = 'Info';
$string['id'] = 'ID';
$string['datetime'] = 'Date/Time';
$string['element'] = 'Element';
$string['logtype'] = 'Logtype';
$string['action'] = 'Action';
$string['info'] = 'Info';

///
/// Totara sync help strings
///
$string['country_help'] = "This should be formatted within the CSV as the 2 character code of the country.
    For example 'New Zealand' should be 'NZ'";
$string['fileaccess_help'] = '**Directory**: This option allows you to specify a directory on the server to be checked for sync files automatically

**Upload**: This option requires you to upload files via the \'upload sync files\' page under sources in site administration';
?>
