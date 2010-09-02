<?php //$Id$
//This script is used to configure and execute the hierarchy restore process.

//Define some globals for all the script

require_once ("../config.php");
require_once ("$CFG->libdir/xmlize.php");
require_once ("$CFG->dirroot/backup/lib.php");
require_once ("$CFG->dirroot/backup/restorelib.php");
require_once ("$CFG->libdir/adminlib.php");
require_once ("$CFG->dirroot/hierarchy/lib.php");
require_once ("$CFG->dirroot/hierarchy/backuplib.php");
require_once ("$CFG->dirroot/hierarchy/restorelib.php");
require_once ("hierarchyrestore_forms.php");

admin_externalpage_setup('hierarchybackup');

require_login();
if (!has_capability('moodle/site:backup', get_context_instance(CONTEXT_SYSTEM))) {
    error("You need the moodle/site:backup capability to use this page.", "$CFG->wwwroot/login/index.php");
}

global $restore;

$file = optional_param('file');
$action = optional_param('action', null);
$cancel = optional_param('cancel', null);
$hierarchy = optional_param('hierarchy', null);
$options = optional_param('options', null);
$backup_unique_code = optional_param('backup_unique_code', null);
$inc_users = optional_param('inc_users', null);
$tobackup = optional_param('tobackup', null);


//TODO does restore process use any of the session vars defined in backup/restore.php L41-56
// if so we may need to unset them here?

//Check necessary functions exists. Thanks to gregb@crowncollege.edu
backup_required_functions();

//Check backup_version
$linkto = $CFG->wwwroot . '/hierarchy/hierarchyrestore.php';
upgrade_backup_db($linkto);

// define strings
$strhierarchyrestore = get_string('hierarchyrestore','hierarchy');
$stradministration = get_string('administration');

//Adjust some php variables to the execution of this script
@ini_set("max_execution_time","3000");
raise_memory_limit("192M");

// if an error occurs go back to the first page
$returnurl = $CFG->wwwroot . '/hierarchy/hierarchyrestore.php';

// redirect to first page if cancel button pressed
if(isset($cancel)) {
    redirect($returnurl);
}

admin_externalpage_print_header();

//Print form
print_heading(format_string("$strhierarchyrestore"));

// display page based on action parameter
if($action == 'selectoptions') {
    // file picked, examine and pick restore options

    print "Examining file \"$file\""; //todo get_string
    //Now calculate the unique_code for this restore
    $backup_unique_code = time();

    $errorstr = '';
    $info = hierarchyrestore_precheck($file, $backup_unique_code, $errorstr);

    if (!$info || $errorstr != '') {
        print_error('error:restoreerror','hierarchy', $returnurl, $errorstr);
    }

    // Now we have the backup as an array, look through for content
    // to determine how to display the form
    $contents = get_backup_contents($info, $backup_unique_code, $errorstr);
    if($contents === false) {
        print_error('error:restoreerror','hierarchy', $returnurl, $errorstr);
    }
    // display the form to let user pick what to restore
    $chooseitems = new hierarchyrestore_chooseitems_form(null, compact('contents'));
    $chooseitems->display();

    //Print footer
    print_footer();
    exit;


} else if ($action == 'confirm') {
    // TODO get_string
    print "<h1>Confirm Restore </h1>";
    print "<p>Are you sure you want to restore the following data. This operation cannot be undone.</p>";

    //Reading info from file
    $xml_file  = $CFG->dataroot."/temp/backup/".$backup_unique_code."/moodle.xml";
    $xml = file_get_contents($xml_file);
    $info = xmlize($xml);

    print "<h2>Users</h2>";
    if($inc_users) {
        $matches = match_users($info,$backup_unique_code);
        if($matches) {
            print $matches;
        } else {
            print 'No users';
        }
    }
    else {
        print 'Users not being restored';
    }

    if(!is_array($hierarchy) || count($hierarchy) == 0) {
        print 'No hierarchies';
        print_footer();
        exit;
    }
    foreach ($hierarchy AS $hname => $inc_frameworks) {
        //$inc_frameworks = array_keys($frameworks);
        print '<h2>'.get_string($hname.'plural',$hname).'</h2>';

        $hbackupfile = "$CFG->dirroot/hierarchy/type/$hname/backuplib.php";
        if(file_exists($hbackupfile)) {
            include_once($hbackupfile);
        }
        $getitemtagfunc = $hname.'_get_item_tag';
        if(function_exists($getitemtagfunc)) {
            $pluraltag = $getitemtagfunc(true);
            $singletag = $getitemtagfunc();
        } else {
            // try to guess tag name using name
            $pluraltag = strtoupper($hname.'s');
            $singletag = strtoupper($hname);
        }

        if(isset($info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY']['0']['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'])) {
            $frameworks = $info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY']['0']['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];
        }

        $tempitems = 'hbackup_temp_items';
        $status = create_temp_items_table($tempitems);
        // delete records with same unique code to avoid duplicates
        delete_records($tempitems, 'backup_unique_code', $backup_unique_code);

        foreach ($frameworks AS $framework) {
            if(isset($framework['#']['ID']['0']['#'])) {
                $fwid = $framework['#']['ID']['0']['#'];
                $fwname = $framework['#']['FULLNAME']['0']['#'];
            }
            if (isset($inc_frameworks[$fwid]) && $inc_frameworks[$fwid] == 1) {
                print "Matching framework \"$fwname\":<br />";


                print match_items($framework, $hname, $fwid, $tempitems, $backup_unique_code);
            }
        }
    }
    print_single_button($CFG->wwwroot.'/hierarchy/hierarchyrestore.php', array('action'=> 'execute', 'tobackup'=>serialize($hierarchy), 'options'=>serialize($options), 'backup_unique_code'=>$backup_unique_code, 'inc_users'=>$inc_users), 'Restore hierarchies', 'post');
    print_footer();
    exit;

} else if ($action == 'execute') {

    if(isset($tobackup)) {
        $tobackup = unserialize(stripslashes($tobackup));
    } else {
        $tobackup = array();
    }
    if(isset($options)) {
        $options = unserialize(stripslashes($options));
    } else {
        $options = array();
    }

    //Reading info from file
    $xml_file  = $CFG->dataroot."/temp/backup/".$backup_unique_code."/moodle.xml";
    $xml = file_get_contents($xml_file);
    $info = xmlize($xml);

    // need to set a global pref to fool backup_encode_absolute_links()
    // copy any existing prefs to temporary variable and restore afterwards
    $savedrestore = $restore;
    $restore->course_id = 1;
    $restore->mods = array();
    $restore->backup_unique_code = $backup_unique_code;
    $restore->users = 0;
    // restore user data
    if($inc_users) {
        print '<h2>Restoring Users</h2>';
        echo get_string("creatingusers")."<br />";
        if (!$status = restore_create_users($restore,$xml_file)) {
            $errorstr = "Could not restore users.";
            return false;
        }
    }

    if(isset($info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'])) {
        $hierarchies = $info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'];
    } else {
        $hierarchies = array();
    }
    foreach ($hierarchies AS $hierarchy) {
        $hname = $hierarchy['#']['NAME']['0']['#'];
        print '<h2>Restoring '.get_string($hname.'plural',$hname).'</h2>';
        $restorefile = "$CFG->dirroot/hierarchy/type/$hname/restorelib.php";
        $restorefunc = $hname.'_restore';
        $hoptions = isset($options[$hname]) ? $options[$hname] : null;
        if(isset($tobackup[$hname])){
            $fwtobackup = $tobackup[$hname];
        }
        else {
            $fwtobackup = array();
        }

        if(file_exists($restorefile)) {
            include_once($restorefile);
            if(function_exists($restorefunc)) {
                $restorefunc($hierarchy, $fwtobackup, $hoptions, $backup_unique_code);
            } else {
                print "Function $restorefunc not found";
            }
        } else {
            print "No restorelib.php file found in hiearchy/type/$hname";
        }
    }
    // restore any global preferences setting
    $restore = $savedrestore;

   print_footer();
    exit;
} else {
    // first call to page - display list of zip files to pick from
    $hierarchyrestoredir = "$CFG->dataroot/hierarchies";
    $filelist = hierarchyrestore_get_backup_files($hierarchyrestoredir);

    if(!$filelist || count($filelist) == 0) {
        print_error('error:norestorefiles','hierarchy', '', get_string('pickfilehelp','hierarchy',$hierarchyrestoredir));
    }
    else {
        // print file picker form
        $pickfile = new hierarchyrestore_pickfile_form(null, compact('filelist'));
        $pickfile->display();
    }
    print_footer();
    exit;
}



