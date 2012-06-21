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
 * @author Eugene Venter <eugene@catalyst.net.nz>
 * @package totara
 * @subpackage totara_sync
 */
$string['pluginname'] = 'Totara sync';

$string['sync'] = 'Sync';
$string['totarasync'] = 'Totara sync';
$string['totara_sync:manage'] = 'Manage Totara sync process';
$string['settingssaved'] = 'Settings saved';
$string['elementenabled'] = 'Element enabled';
$string['elementdisabled'] = 'Element disabled';
$string['filesdir'] = 'Files directory';
$string['uploadsuccess'] = 'Sync files uploaded successfully';
$string['uploaderror'] = 'The was a problem with uploading the file(s)...';
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
$string['dataimportaborted'] = 'data import aborted';
$string['temptablecreatefail'] = 'error creating temp table';
$string['nocsvfilepath'] = 'no CSV filepath specified';
$string['nofilesdir'] = 'No sync files directory configured';
$string['xnotfound'] = '{$a} not found';
$string['nochangesskippingsync'] = 'no changes, skipping sync';
$string['cannotopenx'] = 'cannot open {$a}';
$string['csvnotvalidmissingfieldx'] = 'CSV file not valid, missing field "{$a}"';
$string['mappingforx'] = 'mapping for "{$a}"';
$string['couldnotimportallrecords'] = 'could not import all records';
$string['syncstarted'] = 'sync started';
$string['syncfinished'] = 'sync finished';
$string['couldnotgetsourcetable'] = 'could not get source table, aborting...';
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
$string['parentxnotexist'] = 'parent {$a} does not exist';
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
$string['nosourceforelement'] = 'no source set for element';
$string['nosourceconfigured'] = 'No source configured';
$string['duplicateuserswithidnumberx'] = 'Duplicate users with idnumber {$a->idnumber}';


///
/// Totara sync log report
///
$string['sourcetitle'] = 'Totara Sync Log';
$string['datetime'] = 'Date/Time';
$string['logtype'] = 'Log type';
$string['error'] = 'Error';
$string['info'] = 'Info';
$string['action'] = 'Action';
$string['info'] = 'Info';
?>
