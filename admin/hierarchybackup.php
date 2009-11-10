<?php //$Id$
//This script is used to configure and execute the hierarchy backup process.

//Define some globals for all the script

require_once ("../config.php");
require_once ("../backup/lib.php");
require_once ("../backup/backuplib.php");
require_once ("$CFG->libdir/adminlib.php");
require_once ("$CFG->dirroot/hierarchy/lib.php");
require_once ("hierarchybackup_forms.php");

require_login();
if (!has_capability('moodle/site:backup', get_context_instance(CONTEXT_SYSTEM))) {
    error("You need to be an admin user to use this page.", "$CFG->wwwroot/login/index.php");
}

//Check site
if (!$site = get_site()) {
    error("Site not found!");
}

//Check necessary functions exists. Thanks to gregb@crowncollege.edu
backup_required_functions();

//Check backup_version
$linkto = "$CFG->wwwroot/$CFG->admin/hierarchybackup.php";
upgrade_backup_db($linkto);

// define strings
$strhierarchybackup = get_string('hierarchybackup','hierarchy');
$stradministration = get_string('administration');

//Adjust some php variables to the execution of this script
@ini_set("max_execution_time","3000");
raise_memory_limit("192M");

// TODO grab this automatically from directories in /hierarchy/type/
// TODO or from hierarchy table if we decide to create one
$hierarchies = array('competency','position','organisation');

// check each hierarchy type for a backup script to determine
// which will be included in backup
$hlist = array();
// this also include()s hierarchy specific backup functions
$hlist = get_backup_list();

$frameworks = new object();
$items = new object();
foreach ($hlist AS $index => $hname) {
    $hlib = "$CFG->dirroot/$hname/lib.php";
    if(!file_exists($hlib)) {
        error_log("Could not backup $hname because $hname/lib.php does not exist");
        unset($hlist[$index]);
        continue;
    }
    include_once($hlib);
    if(!class_exists($hname)) {
        error_log("Could not backup $hname because class $hname does not exist");
        unset($hlist[$index]);
        continue;
    }
    if(!method_exists($hname, 'get_frameworks')) {
        error_log("Could not backup $hname because class $hname does not have the method get_frameworks()");
        unset($hlist[$index]);
        continue;
    }
    if(!method_exists($hname, 'get_framework')) {
        error_log("Could not backup $hname because class $hname does not have the method get_framework()");
        unset($hlist[$index]);
        continue;
    }
    if(!method_exists($hname, 'get_items')) {
        error_log("Could not backup $hname because class $hname does not have the method get_items()");
        unset($hlist[$index]);
        continue;
    }
    $hierarchy = new $hname();
    $frameworks->$hname = $hierarchy->get_frameworks();
    // get the items for each framework
    foreach($frameworks->$hname AS $framework) {
        $fwid = $framework->id;
        $fwname = "framework$fwid";
        $fw = $hierarchy->get_framework($fwid);
        $hitems = $hierarchy->get_items();
        $items->$hname->$fwname->items = $hitems;
        if(is_array($hitems)) {
            $items->$hname->$fwname->items_count = count($hitems);
        } else {
            $items->$hname->$fwname->items_count = 0;
        }
    }

}

// TODO form logic here
$selectform = new hierarchybackup_select_form('hierarchybackup_execute.php', //?XDEBUG_SESSION_START=1',  // TODO remove xdebug
    compact('hlist','frameworks','items'));
if($selectform->is_cancelled()) {
    // TODO redirect
    print "Form cancelled - this should redirect";
    redirect();
}
else if ($fromform = $selectform->get_data()) {
    print "validation error";
} else {
    // first visit to page
} 

//Print header
$navlinks[] = array('name' => $stradministration, 'link' => "$CFG->wwwroot/$CFG->admin/index.php", 'type' => 'misc');
$navlinks[] = array('name' => $strhierarchybackup, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);

print_header("$site->shortname: $strhierarchybackup", $site->fullname, $navigation);

//Print form
print_heading(format_string("$strhierarchybackup"));

// TODO Display the form
if (!$fromform) {
    $selectform->display(); 
}
//Print footer
print_footer();

////////////////////

/**
 * Return array of hierarchy names to be backed up based on existence of the 
 * required files and functions
 *
 * @return array Array of hierarchy prefixes that can be backed up
**/
function get_backup_list() {
    global $CFG;

    // TODO grab this automatically from directories in /hierarchy/type/
    // TODO or from hierarchy table if we decide to create one
    $hierarchies = array('competency','position','organisation');

    if(!is_array($hierarchies)) {
        return false;
    }

    $hlist = array();
    foreach($hierarchies AS $hname) {
        // todo update path
        $hbackupfile = "$CFG->dirroot/$hname/backuplib.php";
        $hbackup = $hname."_backup";

        if(file_exists($hbackupfile)) {
            include_once($hbackupfile);
            if(function_exists($hbackup)) {
                $hlist[] = $hname;
            }
        }
    }
    return $hlist;
   
}
