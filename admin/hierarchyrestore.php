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
require_once ("hierarchyrestore_forms.php");

$file = optional_param('file');
$action = optional_param('action', null);

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

// display page based on action parameter
if($action == 'selectoptions') {
    // file picked, examine and pick restore options

    print "Examining file \"$file\"";
    $errorstr = '';
    $contents = '';
    $usercount = '';
    $status = hierarchyrestore_precheck($file, $contents, $errorstr);

    if (!$status || $contents=='') {
        error("An error occured $errorstr");
    }

    $chooseitems = new hierarchyrestore_chooseitems_form(null, compact('contents'));
    $chooseitems->display();

    //Print footer
    print_footer();
    exit;


} else if ($action == 'execute') {
    // do the actual restore
    print "Restore execute";
    print_footer();

} else {
    // first visit - display list of zip files to pick from
    $hierarchyrestoredir = "$CFG->dataroot/hierarchies";
    $filelist = hierarchyrestore_get_backup_list($hierarchyrestoredir);

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



function hierarchyrestore_get_backup_list($dir) {
    if(!is_dir($dir)) {
        return false;
    }
    $filelist = array();
    $dir = opendir($dir);
    while (false !== ($file = readdir($dir))) {
        if ($file == "." || $file == ".." || substr($file, -4) != ".zip") {
            continue;
        }
        $filelist[$file] = $file;
    }
    closedir($dir);

    return $filelist;

}



function hierarchyrestore_precheck($file, &$contents, &$errorstr) {
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

    // Now we have the backup as an array, look through for content
    // to determine how to display the form
    $contents = get_backup_contents($info, $errorstr);
    if($contents === false) {
        return false;
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


function array_key_exists_r($needle, $haystack) {
    $result = array_key_exists($needle, $haystack);
    if ($result) {
        return $result;
    }

    foreach ($haystack as $v) {
        if (is_array($v)) {
            $result = array_key_exists_r($needle, $v);
        }
        if ($result) return $result;
    }
    return $result;
}


function get_backup_contents($info, &$errorstr) {
    global $CFG;

    // check for hierarchies
    if(isset($info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'])) {
        $hierarchies = $info['MOODLE_BACKUP']['#']['HIERARCHIES']['0']['#']['HIERARCHY'];
    } else {
        $errorstr = 'No hierarchies found';
        return false;
    }

    $contents = new object();
    // check if backup includes user data
    if(isset($info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'])) {
        $users = $info['MOODLE_BACKUP']['#']['USERS']['0']['#']['USER'];
        $contents->options->usercount = count($users);
    }
    else {
        $contents->options->usercount = 0;
    }

    // loop through XML and create array of hierarchies, frameworks and item counts
    // to be used to build the selection form
    foreach($hierarchies as $hierarchy) {
        $name = $hierarchy['#']['NAME']['0']['#'];
        $contents->$name = new object();
        if(isset($hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'])) {
            $frameworks = $hierarchy['#']['FRAMEWORKS']['0']['#']['FRAMEWORK'];
            $contents->$name->frameworks = array();
            foreach($frameworks AS $framework) {
                $fullname = $framework['#']['FULLNAME']['0']['#'];
                $id = $framework['#']['ID']['0']['#'];
                $contents->$name->frameworks[$id] = new object();
                $contents->$name->frameworks[$id]->fullname = $fullname;
                $itemnameplural = strtoupper(get_string($name.'plural',$name));
                $itemname = strtoupper(get_string($name, $name));
                if(isset($framework['#'][$itemnameplural]['0']['#'][$itemname])) {
                    $items = $framework['#'][$itemnameplural]['0']['#'][$itemname];
                    $contents->$name->frameworks[$id]->itemcount = count($items);
                } else {
                    $contents->$name->frameworks[$id]->itemcount = 0;
                }

            }
        }

        // check to see if backup contains optional tags for this hierarchy
        $hbackupfile = "$CFG->dirroot/hierarchy/type/$name/backuplib.php";
        $optionsfunc = $name.'_options';
        if(file_exists($hbackupfile)) {
            include_once($hbackupfile);
            if(function_exists($optionsfunc)) {
                $options = $optionsfunc();
                foreach ($options AS $option) {
                    $opname = $option['name'];
                    $optag = $option['tag'];
                    $oplabel = $option['label'];
                    $opdefault = $option['default'];
                    // if optag is an array key, this option was included in backup
                    $contents->$name->options->$opname->exists = array_key_exists_r($optag, $hierarchy);
                    $contents->$name->options->$opname->label = $oplabel;
                    $contents->$name->options->$opname->default = $opdefault;
                }
            }
        }
    }

    return $contents;
}



