<?php

/**
 * Functions required for hierarchy backup and restore functionality
 *
**/

/**
 * Requirements to enable back up functionality for a specific hierarchy:
 *
 * 1- Must have a directory called hierarchy/prefix/[hname]/ where [hname] is
 *    the name of the hiearchy to be backed up (same as prefix).
 *
 * 2- Must have a file called hierarchy/prefix/[hname]/backuplib.php
 *
 * 3- backuplib.php must include a function called [hname]_backup(), which
 *    is the function that initialises the backup for that hierarchy
 *
 * 4- Must have a file called hierarchy/prefix/[hname]/lib.php
 *
 * 5- The lib.php file must define a class called [hname]
 *
 * 6- The class must include the following methods:
 *    - get_frameworks()
 *    - get_framework()
 *    - get_items()
 *    These methods can be defined in the [hname] class, or if [hname]
 *    extends hierarchy, they will be automatically inherited
 *
 * 7- To actually be able to backup a hierarchy, there must be at least
 *    one framework in the [hname]_framework table
 *
 * 8- For the form to look nice you need language strings.
 *    Create a language file for the hierarchy in:
 *    lang/en_utf8/[hname].php
 *    and other language directories if needed
 *
 *    Then set language strings in [hname].php for this hierarchy. In
 *    particular you will need these strings:
 *    - [hname]
 *    - [hname]plural
 *
 * 9- If you want to include hierarchy specific options for the backup
 *    and restore process, you need to create a function called
 *    [hname]_options() in hierarchy/prefix/[hname]/backuplib.php
 *    This function returns an array of options, where each option
 *    is an array containing certain info about that option:
 *
 *    $options['optionname'] = array('name' => 'name_here', // this is the input name for the form element
 *                                   'type' => 'formslib form type', // e.g. 'selectyesno'
 *                                   'label' => 'Text label for option', // you probably want to use get_string here
 *                                   'default' => 'Default field value',
 *                                   'format' => 'formslib type', // e.g. PARAM_BOOL
 *                                   'tag' => 'tag name' // used to determine if an option was included
 *                                                       // in a particular backup. Pick a tag that will
 *                                                       // only exist if the option was set
 *                                   );
 *
 *    See hierarchy/prefix/competency/backuplib.php for an example of usage
 *
 *10- The function [hname]_backup() must have three arguments:
 *    $bf which is a file buffer to write backup output to
 *    $frameworks which is an array with keys equal to the IDs of the frameworks
 *      to backup and values of 1 (include in backup) or 0 (exclude from backup)
 *    $options which is an array of options as specified by the [hname]_options()
 *      function (keys will match the 'name' element in the options array, values
 *      will be whatever the user selected).
 *
 *    See hierachy/prefix/competency/backuplib.php for an example of how to write
 *    this function
 *
 *11- The hierarchy/prefix/[hname]/backuplib.php should contain a function called
 *    [hname]_get_item_tag(), which returns the singular of the item's tag name,
 *    or if called with an optional first argument set to true, returns the
 *    plural of the item's tag name. This is used to name the item XML tags within
 *    the backup file and access them when restoring.
 *
**/

/**
 * Returns array of hierarchy names to be backed up based on existence of the
 * required files and functions
 *
 * Note this function also includes() the backuplib.php file for the specified
 * hierarchy in order to check for required functions.
 *
 * @return array Array of hierarchy prefixes that can be backed up
 **/
function get_backup_list() {
    global $CFG;

    // get list of hierarchies from directories in hierarchy/prefix/
    $prefixdir = "$CFG->dirroot/hierarchy/prefix";
    $hierarchies = array();
    $dir = opendir($prefixdir);
    while (false !== ($file = readdir($dir))) {
        if ($file == "." || $file == ".." || !is_dir($prefixdir."/".$file)) {
            continue;
        }
        $hierarchies[] = $file;
    }

    if(!is_array($hierarchies) || count($hierarchies) < 1) {
        return false;
    }

    // exclude hierarchy directories without a backuplib.php
    $hlist = array();
    foreach($hierarchies AS $hname) {
        $hbackupfile = "$CFG->dirroot/hierarchy/prefix/$hname/backuplib.php";
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


