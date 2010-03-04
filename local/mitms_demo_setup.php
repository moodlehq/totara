<?php

require_once('../config.php');
require_once($CFG->dirroot.'/lib/adminlib.php');
require_once($CFG->libdir.'/ddllib.php');

if(!$site = get_site()) {
    redirect($CFG->wwwroot.'/admin/index.php');
    exit;
}


// Security check
require_login(0, false);
$context = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/site:config', $context);

$submit = optional_param('submit',null,PARAM_TEXT);
if(isset($submit) && $submit == 'yes') {
    set_config('mitms_demo_setup',$submit);
    require_once($CFG->libdir.'/csvlib.class.php');
    import_users();
    setup_auth_db_plugin();
    // TODO auto run the sync script here

    // add demo data to site
    // u set up tables (in upgrade.php)
    // u import data into tables
    // u run auth plugin to sync users
    // - run enrol plugin to setup role assignments
    // - run modified enrol plugin or another script to do position assignments
    // Other stuff to go in:
    // - import course backup files silently w/ f2f data (what about users?)
    // - user/session/hierarchy custom fields
    // - session roles
    // - related competencies
    // - competencies/orgs/positions
    // - competency evidence
    redirect($CFG->wwwroot.'/admin/index.php');
} else if (isset($submit) && $submit == 'no') {
    // set flag and continue
    set_config('mitms_demo_setup',$submit);
    redirect($CFG->wwwrrot.'/admin/index.php');
} else {
    admin_externalpage_setup('adminnotifications');
    $strheader = get_string('installingdemodata');
    $navigation = build_navigation(array(array('name'=>$strheader, 'link'=>null, 'type'=>'misc')));
    print_header($strheader, $strheader, $navigation);
    notice_yesno('Do you want to include demo data?',me(),me(),array('submit'=>'yes'),array('submit'=>'no'));
    print_footer();
}

// enables and configures the auth db plugin to use the mdl_demo_users
// table to sync from
function setup_auth_db_plugin() {
    global $CFG;

    if(is_enabled_auth('db')) {
        print "DB Auth already configured!";
        return false;
    }

    // get list of enabled plugins
    get_enabled_auth_plugins(true); //fix the list
    if(empty($CFG->auth)) {
        $authsenabled = array();
    } else {
        $authsenabled = explode(',', $CFG->auth);
    }
    // enable db auth
    if(!in_array('db', $authsenabled)) {
        $authsenabled[] = 'db';
        set_config('auth', implode(',', $authsenabled));
    }

    // get db config from CFG
    $regexps = array(
        'dbuser' => "/user='([^']*)'/",
        'dbpass' => "/password='([^']*)'/",
        'dbname' => "/dbname='([^']*)'/",
        'dbhost' => "/dbhost='([^']*)'/",
    );
    foreach($regexps as $field => $regexp) {
        if(preg_match($regexp, $CFG->dbhost, $matches)) {
            $$field = $matches[1];
        }
    }

    if(!isset($dbuser)) {
        // return if db info not known
        print "Could not find user in dbhost string";
        return false;
    }

    if(!isset($dbpass)) {
        // return if db info not known
        print "Could not find password in dbhost string";
        return false;
    }
    if(!isset($dbname)) {
        // return if db info not known
        print "Could not find db name in dbhost string";
        return false;
    }
    // assume localhost if none set
    if(!isset($dbhost)) {
        $dbhost = 'localhost';
    }

    // take a guess at what quoting should be
    if($CFG->dbfamily== 'mssql' || $CFG->dbfamily == 'oracle') {
        $sybase = 1;
    } else {
        $sybase = 0;
    }
    $dbtype = $CFG->dbtype;
    // config to sync users from mdl_demo_users
    set_config('host', $dbhost, 'auth/db');
    set_config('name', $dbname, 'auth/db');
    set_config('type', $dbtype, 'auth/db');
    set_config('sybasequoting', $sybase, 'auth/db');
    set_config('user', $dbuser, 'auth/db');
    set_config('pass', $dbpass, 'auth/db');
    set_config('table', $CFG->prefix.'demo_users', 'auth/db');
    set_config('fielduser', 'username', 'auth/db');
    set_config('fieldpass', '', 'auth/db');
    set_config('passtype', 'internal', 'auth/db');
    set_config('extencoding', 'utf-8', 'auth/db'); // assume UTF-8
    set_config('setupsql', '', 'auth/db');
    set_config('debugauthdb', '0', 'auth/db');
    set_config('removeuser', '0', 'auth/db');
    set_config('changepasswordurl', '', 'auth/db');
    set_config('field_map_firstname', 'firstname', 'auth/db');
    set_config('field_updatelocal_firstname', 'oncreate', 'auth/db');
    set_config('field_updateremote_firstname', '0', 'auth/db');
    set_config('field_lock_firstname', 'unlocked', 'auth/db');
    set_config('field_map_lastname', 'lastname', 'auth/db');
    set_config('field_updatelocal_lastname', 'oncreate', 'auth/db');
    set_config('field_updateremote_lastname', '0', 'auth/db');
    set_config('field_lock_lastname', 'unlocked', 'auth/db');
    set_config('field_map_email', 'email', 'auth/db');
    set_config('field_updatelocal_email', 'oncreate', 'auth/db');
    set_config('field_updateremote_email', '0', 'auth/db');
    set_config('field_lock_email', 'unlocked', 'auth/db');
/*
    // only set if they exist in mdl_demo_users
    set_config('field_map_city', 'city', 'auth/db');
    set_config('field_updatelocal_city', 'oncreate', 'auth/db');
    set_config('field_updateremote_city', '0', 'auth/db');
    set_config('field_lock_city', 'unlocked', 'auth/db');
    set_config('field_map_country', 'country', 'auth/db');
    set_config('field_updatelocal_country', 'oncreate', 'auth/db');
    set_config('field_updateremote_country', '0', 'auth/db');
    set_config('field_lock_country', 'unlocked', 'auth/db');
    set_config('field_map_lang', 'lang', 'auth/db');
    set_config('field_updatelocal_lang', 'oncreate', 'auth/db');
    set_config('field_updateremote_lang', '0', 'auth/db');
    set_config('field_lock_lang', 'unlocked', 'auth/db');
    set_config('field_map_description', 'description', 'auth/db');
    set_config('field_updatelocal_description', 'oncreate', 'auth/db');
    set_config('field_updateremote_description', '0', 'auth/db');
    set_config('field_lock_description', 'unlocked', 'auth/db');
    set_config('field_map_url', 'url', 'auth/db');
    set_config('field_updatelocal_url', 'oncreate', 'auth/db');
    set_config('field_updateremote_url', '0', 'auth/db');
    set_config('field_lock_url', 'unlocked', 'auth/db');
 */
    set_config('field_map_idnumber', 'idnumber', 'auth/db');
    set_config('field_updatelocal_idnumber', 'oncreate', 'auth/db');
    set_config('field_updateremote_idnumber', '0', 'auth/db');
    set_config('field_lock_idnumber', 'unlocked', 'auth/db');
    /*
    set_config('field_map_institution', 'institution', 'auth/db');
    set_config('field_updatelocal_institution', 'oncreate', 'auth/db');
    set_config('field_updateremote_institution', '0', 'auth/db');
    set_config('field_lock_institution', 'unlocked', 'auth/db');
    set_config('field_map_department', 'department', 'auth/db');
    set_config('field_updatelocal_department', 'oncreate', 'auth/db');
    set_config('field_updateremote_department', '0', 'auth/db');
    set_config('field_lock_department', 'unlocked', 'auth/db');
    set_config('field_map_phone1', 'phone1', 'auth/db');
    set_config('field_updatelocal_phone1', 'oncreate', 'auth/db');
    set_config('field_updateremote_phone1', '0', 'auth/db');
    set_config('field_lock_phone1', 'unlocked', 'auth/db');
    set_config('field_map_phone2', 'phone2', 'auth/db');
    set_config('field_updatelocal_phone2', 'oncreate', 'auth/db');
    set_config('field_updateremote_phone2', '0', 'auth/db');
    set_config('field_lock_phone2', 'unlocked', 'auth/db');
    set_config('field_map_address', 'address', 'auth/db');
    set_config('field_updatelocal_address', 'oncreate', 'auth/db');
    set_config('field_updateremote_address', '0', 'auth/db');
    set_config('field_lock_address', 'unlocked', 'auth/db');
     */

    // run the sync script to get the users
    //include($CFG->dirroot.'/auth/db/auth_db_sync_users.php');

}

// import users from local/demodata/users.csv to mdl_demo_users table
// first row of csv provides table field names
function import_users() {
    global $CFG;
    $iid = csv_import_reader::get_new_iid('demousers');
    $csv = new csv_import_reader($iid, 'demousers');
    $encoding = 'UTF-8';
    $delimiter = 'cfg';
    $content = file_get_contents($CFG->dirroot.'/local/demodata/users.csv');
    $readcount = $csv->load_csv_content($content, $encoding, $delimiter);
    $table = new XMLDBTable('demo_users');
    if($readcount) {
        $columns = $csv->get_columns();
        $csv->init();
        while($line = $csv->next()) {
            $todb = new object();
            foreach($columns as $index => $column) {
                $field = new XMLDBField($column);
                if(field_exists($table,$field) && $column != 'id') {
                    $todb->$column = $line[$index];
                }
            }
            if(!insert_record('demo_users',$todb)) {
                print "Error inserting users";
            }
        }
        $csv->close();
    } else {
        return false;
    }
    return true;
}
