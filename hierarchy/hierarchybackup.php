<?php //$Id$
//This script is used to configure and execute the hierarchy backup process.

//Define some globals for all the script

require_once ('../config.php');
require_once ($CFG->dirroot . '/backup/lib.php');
require_once ($CFG->dirroot . '/backup/backuplib.php');
require_once ($CFG->dirroot . '/hierarchy/lib.php');
require_once ($CFG->dirroot . '/hierarchy/backuplib.php');
require_once ($CFG->libdir . '/adminlib.php');
require_once ('hierarchybackup_forms.php');

admin_externalpage_setup('hierarchybackup');

require_login();
if (!has_capability('moodle/site:backup', get_context_instance(CONTEXT_SYSTEM))) {
    error("You need the moodle/site:backup capability to use this page.", "$CFG->wwwroot/login/index.php");
}

//Check necessary functions exists. Thanks to gregb@crowncollege.edu
backup_required_functions();

//Check backup_version
$linkto = $CFG->wwwroot . '/hierarchy/hierarchybackup.php';
upgrade_backup_db($linkto);

// define strings
$strhierarchybackup = get_string('hierarchybackup','hierarchy');
$stradministration = get_string('administration');

//Adjust some php variables to the execution of this script
@ini_set("max_execution_time","3000");
raise_memory_limit("192M");

// check each hierarchy type for a backup script to determine
// which will be included in backup
$hlist = array();
// this also include()s hierarchy specific backup functions
$hlist = get_backup_list();

$frameworks = new object();
$items = new object();
foreach ($hlist AS $index => $hname) {
    $hlib = "$CFG->dirroot/hierarchy/type/$hname/lib.php";
    if(!file_exists($hlib)) {
        error_log("Could not backup $hname because hierarchy/type/$hname/lib.php does not exist");
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

    if(!$frameworks->$hname) {
        continue;
    }

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

$selectform = new hierarchybackup_select_form('hierarchybackup_execute.php',
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

admin_externalpage_print_header();

//Print form
print_heading(format_string("$strhierarchybackup"));

if (!$fromform) {
    $selectform->display();
}

//Print footer
print_footer();


