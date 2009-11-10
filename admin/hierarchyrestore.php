<?php //$Id$
//This script is used to configure and execute the hierarchy restore process.

//Define some globals for all the script

require_once ("../config.php");
require_once ("$CFG->libdir/xmlize.php");
require_once ("$CFG->dirroot/backup/lib.php");
require_once ("$CFG->dirroot/backup/restorelib.php");
require_once ("$CFG->libdir/adminlib.php");
require_once ("$CFG->dirroot/hierarchy/lib.php");
require_once ("hierarchyrestore_forms.php");

$file = optional_param('file');


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

//Print header
$navlinks[] = array('name' => $stradministration, 'link' => "$CFG->wwwroot/$CFG->admin/index.php", 'type' => 'misc');
$navlinks[] = array('name' => $strhierarchyrestore, 'link' => null, 'type' => 'misc');
$navigation = build_navigation($navlinks);

print_header("$site->shortname: $strhierarchyrestore", $site->fullname, $navigation);

//Print form
print_heading(format_string("$strhierarchyrestore"));

if(!$file) {
    $hierarchyrestoredir = "$CFG->dataroot/hierarchies";
    $filelist = array();
    $dir = opendir($hierarchyrestoredir);
    while (false !== ($file = readdir($dir))) {
        if ($file == "." || $file == ".." || substr($file, -4) != ".zip") {
            continue;
        }
        $filelist[$file] = $file;
    }
    closedir($dir);
    if(count($filelist) == 0) {
        print "No files found to restore from. ".get_string('pickfilehelp','hierarchy',$hierarchyrestoredir);
    }
    else {
        // print form
        $pickfile = new hierarchyrestore_pickfile_form(null, compact('filelist'));
        $pickfile->display();
    }
    print_footer();
    exit;
}



print "Examining file \"$file\"";
$errorstr = '';
$contents = '';
$usercount = '';
$status = hierarchyrestore_precheck($file,$contents, $usercount, $errorstr);

if (!$status || $contents=='') {
    error("An error occured $errorstr");
}

$chooseitems = new hierarchyrestore_chooseitems_form(null, compact('contents','usercount'));
$chooseitems->display();

//Print footer
print_footer();


function hierarchyrestore_precheck($file, &$contents, &$usercount, &$errorstr) {
    global $CFG, $SESSION;

    //Prepend dataroot to variable to have the absolute path
    $file = $CFG->dataroot."/hierarchies/".$file;

    if (!defined('RESTORE_SILENTLY')) {
        //Start the main table
        echo "<table cellpadding=\"5\">";
        echo "<tr><td>";

        //Start the mail ul
        echo "<ul>";
    }

    //Check the file exists
    if (!is_file($file)) {
        if (!defined('RESTORE_SILENTLY')) {
            error ("File not exists ($file)");
        } else {
            $errorstr = "File not exists ($file)";
            return false;
        }
    }

    //Check the file name ends with .zip
    if (!substr($file,-4) == ".zip") {
        if (!defined('RESTORE_SILENTLY')) {
            error ("File has an incorrect extension");
        } else {
            $errorstr = 'File has an incorrect extension';
            return false;
        }
    }

    //Now calculate the unique_code for this restore
    $backup_unique_code = time();

    //Now check and create the backup dir (if it doesn't exist)
    if (!defined('RESTORE_SILENTLY')) {
        echo "<li>".get_string("creatingtemporarystructures").'</li>';
    }
    $status = check_and_create_backup_dir($backup_unique_code);
    //Empty dir
    if ($status) {
        $status = clear_backup_dir($backup_unique_code);
    }

    //Now delete old data and directories under dataroot/temp/backup
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("deletingolddata").'</li>';
        }
        $status = backup_delete_old_data();
    }

    //Now copy he zip file to dataroot/temp/backup/backup_unique_code
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("copyingzipfile").'</li>';
        }
        if (! $status = backup_copy_file($file,$CFG->dataroot."/temp/backup/".$backup_unique_code."/".basename($file))) {
            if (!defined('RESTORE_SILENTLY')) {
                notify("Error copying backup file. Invalid name or bad perms.");
            } else {
                $errorstr = "Error copying backup file. Invalid name or bad perms";
                return false;
            }
        }
    }

    //Now unzip the file
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("unzippingbackup").'</li>';
        }
        if (! $status = restore_unzip ($CFG->dataroot."/temp/backup/".$backup_unique_code."/".basename($file))) {
            if (!defined('RESTORE_SILENTLY')) {
                notify("Error unzipping backup file. Invalid zip file.");
            } else {
                $errorstr = "Error unzipping backup file. Invalid zip file.";
                return false;
            }
        }
    }

    //Now check for the moodle.xml file
    if ($status) {
        $xml_file  = $CFG->dataroot."/temp/backup/".$backup_unique_code."/moodle.xml";
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("checkingbackup").'</li>';
        }
        if (! $status = restore_check_moodle_file ($xml_file)) {
            if (!is_file($xml_file)) {
                $errorstr = 'Error checking backup file. moodle.xml not found at root level of zip file.';
            } else {
                $errorstr = 'Error checking backup file. moodle.xml is incorrect or corrupted.';
            }
            if (!defined('RESTORE_SILENTLY')) {
                notify($errorstr);
            } else {
                return false;
            }
        }
    }

    $info = "";

    //Now read the whole xml file into a big array
    if ($status) {
        if (!defined('RESTORE_SILENTLY')) {
            echo "<li>".get_string("readinginfofrombackup").'</li>';
        }
        //Reading info from file
        $xml = file_get_contents($xml_file);
        $info = xmlize($xml);

   }

    if (!defined('RESTORE_SILENTLY')) {
        //End the main ul
        echo "</ul>\n";

        //End the main table
        echo "</td></tr>";
        echo "</table>";
    }

    /*
    // debugging xml array
    traverse_xmlize($info); 
    print_object($GLOBALS['traverse_array']);
    $GLOBALS['traverse_array'] ='';
     */
    if(isset($info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'])) {
        $hierarchies = $info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'];
    } else {
        $errorstr = 'No hierarchies found';
        return false;
    }

    // check if backup includes user data
    if(isset($info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'])) {
        $users = $info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'];
        $usercount = count($users);
    }
    else {
        $usercount = 0;
    }

   //print_object($info);

    // loop through XML and create array of hierarchies, frameworks and item counts
    // to be used to build the selection form
    $contents = array();
    foreach($hierarchies as $hierarchy) {
        $name = $hierarchy['#']['NAME']['0']['#'];
        $contents[$name] = array();
        if(isset($hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'])) {
            $frameworks = $hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];
            foreach($frameworks AS $framework) {
                $fullname = $framework['#']['FULLNAME']['0']['#'];
                $id = $framework['#']['ID']['0']['#'];
                $contents[$name][$id] = new object();
                $contents[$name][$id]->fullname = $fullname;
                $itemnameplural = strtoupper(get_string($name.'plural',$name));
                $itemname = strtoupper(get_string($name, $name));
                if(isset($framework['#'][$itemnameplural]['0']['#'][$itemname])) {
                    $items = $framework['#'][$itemnameplural]['0']['#'][$itemname];
                    $contents[$name][$id]->itemcount = count($items);
                } else {
                    $contents[$name][$id]->itemcount = 0;
                }

            }
        }
    }

    if (!$status) {
        if (!defined('RESTORE_SILENTLY')) {
            error ("An error has ocurred");
        } else {
            $errorstr = "An error has occured"; // helpful! :P
            return false;
        }
    }
    return true;
}

