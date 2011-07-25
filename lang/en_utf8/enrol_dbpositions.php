<?php


$string['dbtype'] = 'Database type';
$string['dbhost'] = 'Server IP name or number';
$string['dbuser'] = 'Server user';
$string['dbpass'] = 'Server password';
$string['dbname'] = 'Database name';
$string['dbtable'] = 'Database table';
$string['useenroldatabase'] = 'Use the same settings for database connection as the Database enrolment plugin is using (You will still have to specify table name)';
$string['useauthdb'] = 'Use the same settings for database connection as the Database authentication plugin is using (You will still have to specify table name)';
$string['description'] = 'You can use a external database (of nearly any kind) to control your relationships between users. It is assumed your external database contains a field containing two user IDs, and a Role ID.  These are compared against fields that you choose in the local user and role tables';
$string['enrolname'] = 'External Database (Position assignments)';
$string['fullnamefield'] = 'The name of the field in the external database to be used as position assignment fullname.';
$string['localobjectuserfield'] = 'The name of the field in the user table that we are using to match entries in the remote database (eg idnumber). for the <i>staff member</i> role assignment';
$string['localorgfield'] = 'The name of the field in the organisations table that we are using to match entries in the remote database (eg idnumber).';
$string['localposfield'] = 'The name of the field in the positions table that we are using to match entries in the remote database (eg idnumber).';
$string['localsubjectuserfield'] = 'The name of the field in the user table that we are using to match entries in the remote database (eg idnumber). for the <i>manager</i> role assignment';
$string['postypefield'] = 'Position type field - The fieldname in the external table which describes which type of position is to be created - primary/secondary/aspirational.  If this is not specified, all rows are assumed to relate to primary position assignments.';
$string['remote_fields_mapping'] = 'Database field mapping';
$string['remoteorgfield'] = 'The name of the field in the remote table that we are using to match entries in the organisations database (eg team).';
$string['remoteposfield'] = 'The name of the field in the remote table that we are using to match entries in the positions table (eg position).';
$string['remotesubjectuserfield'] = 'The name of the field in the remote table that we are using to match entries in the user table for the <i>manager</i> role assignment';
$string['remoteobjectuserfield'] = 'The name of the field in the remote table that we are using to match entries in the user table for the <i>staff member</i> role assignment';
$string['roleshortname'] = 'The shortname of the role that should be assigned to the manager in the context of the staff member.';
$string['shortnamefield'] = 'The name of the field in the remote table to be used as position assignment shortname.';
$string['server_settings'] = 'External Database Server Settings';

?>

