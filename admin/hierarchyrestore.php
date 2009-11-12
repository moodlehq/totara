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

$file = optional_param('file');
$action = optional_param('action', null);
$cancel = optional_param('cancel', null);
$hierarchy = optional_param('hierarchy', null);
$options = optional_param('options', null);
$backup_unique_code = optional_param('backup_unique_code', null);
$inc_users = optional_param('inc_users', null);

require_login();
if (!has_capability('moodle/site:backup', get_context_instance(CONTEXT_SYSTEM))) {
    error("You need to be an admin user to use this page.", "$CFG->wwwroot/login/index.php");
}

//TODO does restore process use any of the session vars defined in backup/restore.php L41-56
// if so we may need to unset them here?

//Check site
if (!$site = get_site()) {
    error("Site not found!");
}

//Check necessary functions exists. Thanks to gregb@crowncollege.edu
backup_required_functions();

//Check backup_version
$linkto = "$CFG->wwwroot/$CFG->admin/hierarchyrestore.php";
upgrade_backup_db($linkto);

// define strings
$strhierarchyrestore = get_string('hierarchyrestore','hierarchy');
$stradministration = get_string('administration');

//Adjust some php variables to the execution of this script
@ini_set("max_execution_time","3000");
raise_memory_limit("192M");

// if an error occurs go back to the first page
$returnurl = "$CFG->wwwroot/admin/hierarchyrestore.php";

// redirect to first page if cancel button pressed
if(isset($cancel)) {
    redirect($returnurl);
}

//Print header
$navlinks[] = array('name' => $stradministration, 'link' => "$CFG->wwwroot/$CFG->admin/index.php", 'type' => 'misc');
$navlinks[] = array('name' => $strhierarchyrestore, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);

print_header("$site->shortname: $strhierarchyrestore", $site->fullname, $navigation);

//Print form
print_heading(format_string("$strhierarchyrestore"));

// display page based on action parameter
if($action == 'selectoptions') {
    // file picked, examine and pick restore options

    print "Examining file \"$file\"";
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



    // get contents here

    $chooseitems = new hierarchyrestore_chooseitems_form(null, compact('contents'));
    $chooseitems->display();

    //Print footer
    print_footer();
    exit;


} else if ($action == 'execute') {
    // do the actual restore
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
        $pluraltag = strtoupper(get_string($hname.'plural',$hname));
        $singletag = strtoupper(get_string($hname, $hname));
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
            if (array_key_exists($fwid, $inc_frameworks)) {
                print "Matching framework \"$fwname\":<br />";


                print match_items($framework, $hname, $fwid, $tempitems, $backup_unique_code);
            }
        }
    }


    print_footer();

} else {
    // first call to page - display list of zip files to pick from
    $hierarchyrestoredir = "$CFG->dataroot/hierarchies";
    $filelist = hierarchyrestore_get_backup_list($hierarchyrestoredir);

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



