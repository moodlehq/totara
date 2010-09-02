<?php
require_once('../config.php');
require_once('hierarchybackup_forms.php');
require_once($CFG->dirroot . '/backup/backuplib.php');
require_once($CFG->dirroot . '/backup/lib.php');
require_once ($CFG->libdir . '/adminlib.php');
//TODO print headers etc

admin_externalpage_setup('hierarchybackup');

require_login();
if (!has_capability('moodle/site:backup', get_context_instance(CONTEXT_SYSTEM))) {
    error("You need the moodle/site:backup capability to use this page.", "$CFG->wwwroot/login/index.php");
}

global $preferences;

//Adjust some php variables to the execution of this script
@ini_set("max_execution_time","3000");
raise_memory_limit("192M");

$selectsubmit = required_param('submitbutton');
$frameworks = optional_param('frameworks', null, PARAM_BOOL);
$userdata = optional_param('userdata', null, PARAM_BOOL);
$backupfilename = required_param('backupfilename', PARAM_TEXT);

$status = true;

admin_externalpage_print_header();

if(!is_array($frameworks)) {
    print_error('No frameworks selected');
}

print '<h2>Backing up hierarchies</h2>';
print '<ul>';

// setup and open backup file
$backup_unique_code = time();
if (!defined('BACKUP_SILENTLY')) {
    echo "<li>".get_string("creatingtemporarystructures").'</li>';
}
$status = $status && check_and_create_backup_dir($backup_unique_code);
if(!$status) {
    print_error('Backup directory not present');
}

$status = $status && clear_backup_dir($backup_unique_code);
if(!$status) {
    print_error('Backup directory could not be emptied');
}

//Delete old_entries from backup tables
if (!defined('BACKUP_SILENTLY')) {
    echo "<li>".get_string("deletingolddata").'</li>';
}

$status = $status && backup_delete_old_data();
if (!$status) {
    print_error('An error occurred deleting old backup data');
}

if (!defined('BACKUP_SILENTLY')) {
    echo "<li>".get_string("creatingxmlfile");
    //Begin a new list to xml contents
    echo "<ul>";
    echo "<li>".get_string("writingheader").'</li>';
}
$bf = backup_open_xml($backup_unique_code);
if(!$bf) {
    print_error('Could not open backup file');
}

// need to set a global pref to fool backup_encode_absolute_links()
// copy any existing prefs to temporary variable and restore afterwards
$savedprefs = $preferences;
$preferences->backup_course = 1;
$preferences->mods = array();

// backup user data using standard moodle backup functions
if($userdata) {

    if (!defined('BACKUP_SILENTLY')) {
        echo "<li>".get_string("writinguserinfo").'</li>';
    }

   // this writes the userids to the backup table. Args provided does backup of all users for all courses
    $status = $status && user_check_backup(1, $backup_unique_code, 0, false, false);
    if (!$status) {
        print_error('An error occurred while preparing to back up user info');
    }
    $userprefs = new object();
    $userprefs->backup_unique_code = $backup_unique_code;
    // back up the users
    // COURSE tags required to put USER tags at right level for restore
    fwrite ($bf,start_tag("COURSE",1,true));
    $status = $status && backup_user_info($bf, $userprefs);
    fwrite ($bf,end_tag("COURSE",1,true));

    if (!$status) {
        print_error('Could not backup user data');
    }
}

fwrite($bf, start_tag('HIERARCHIES',1,true));

// for each type of hierarchy selected to backup run backup script
foreach($frameworks AS $hname => $fwid) {
    if (!defined('BACKUP_SILENTLY')) {
        print "<li>Backing up $hname hierarchy</li>";
        print '<ul>';
    }
    $hframeworks = $frameworks[$hname];
    if(!is_array($hframeworks)) {
        if(!defined('BACKUP_SILENTLY')) {
            print '<li>No frameworks found - skipping</li>';
        }
        continue;
    }

    $hbackupfile = "$CFG->dirroot/hierarchy/type/$hname/backuplib.php";
    $hbackup = $hname.'_backup';
    $getoptionsfunc = $hname.'_options';

    if(!file_exists($hbackupfile)) {
        if(!defined('BACKUP_SILENTLY')) {
            print '<li>Backup file not found - skipping</li>';
        }
        continue;
    }
    include_once($hbackupfile);
    if(!function_exists($hbackup)) {
        if(!defined('BACKUP_SILENTLY')) {
            print '<li>Backup function not found - skipping</li>';
        }
        continue;
    }
    $options = new object();
    if(function_exists($getoptionsfunc)) {
        $extraoptions = $getoptionsfunc();
        foreach($extraoptions as $extraoption) {
            $name = $extraoption['name'];
            $format = $extraoption['format'];
            $options->$name = optional_param($name, null, $format);
        }
    }
    $options->inc_users = $userdata;

    $backup_file = "{$hname}_backup";
    $status = $status && $backup_file($bf, $hframeworks, $options);
    if(!defined('BACKUP_SILENTLY')) {
        print '</ul>';
    }
}

fwrite($bf, end_tag('HIERARCHIES',1,true));

if($bf) {
    backup_close_xml($bf);
}

// restore any global preferences setting
$preferences = $savedprefs;

//End xml contents (close ul)
if (!defined('BACKUP_SILENTLY')) {
    echo "</ul></li>";
}


if (!defined('BACKUP_SILENTLY')) {
    echo "<li>".get_string("zippingbackup").'</li>';
}

// create directory if it doesn't exist
$backupdir = $CFG->dataroot . '/hierarchies';
if(!is_dir($backupdir)) {
    mkdir($backupdir);
}

$zipprefs = new object();
$zipprefs->backup_unique_code = $backup_unique_code;
$zipprefs->backup_name = $backupfilename;
// save to hierarchies directory at same level as courses
$zipprefs->backup_destination = $backupdir;
$status = $status && backup_zip($zipprefs);

if(!$status) {
    print_error('Error while zipping the backup');
}

if (!defined('BACKUP_SILENTLY')) {
    echo "<li>".get_string("copyingzipfile").'</li>';
}

$status = $status && copy_zip_to_course_dir($zipprefs);

if(!$status) {
    print_error('Error while copying the zip file to hierarchies directory');
}

if (!defined('BACKUP_SILENTLY')) {
    echo "<li>".get_string("cleaningtempdata").'</li>';
}

$status = $status && clean_temp_data($zipprefs);

if(!$status) {
    print_error('Error while cleaning up temporary data');
}

if (!defined('BACKUP_SILENTLY')) {
    print '</ul>';
    print '<p>'.get_string('backupfinished').'</p>';
    print '<p>Backup file saved to: ' . $backupdir . '/' . $backupfilename . '</p>';
}


print_footer();

