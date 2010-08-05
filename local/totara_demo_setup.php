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

// if demo data not wanted continue with installation
if(isset($submit) && $submit == 'no') {
    // set flag and continue
    set_config('totara_demo_setup',$submit);
    redirect($CFG->wwwroot.'/admin/index.php');
    exit;
}

if(isset($submit) && $submit == 'yes') {
    set_config('totara_demo_setup',$submit);

    // functions used by demo import scripts
    require_once($CFG->dirroot.'/local/totara_demo_loadfuncs.php');

    // include demo data scripts from local/demodata directory
    $defaultdir = $CFG->dirroot.'/local/demodata';
    $includes = array();
    if (is_dir($defaultdir)) {
        if ($dh = opendir($defaultdir)) {
            $timenow = time();
            while (($file = readdir($dh)) !== false) {
                // exclude directories
                if (is_dir($file)) {
                    continue;
                }
                // not a php file
                if (substr($file, -4) != '.php') {
                    continue;
                }
                // not a demo file
                if (substr($file, 0, 10) != 'load_demo_') {
                    continue;
                }
                // include default data file
                $includes[] = $defaultdir.'/'.$file;
            }
        }
    }

    print_box_start();

    // sort so order of includes is known
    sort($includes);
    foreach($includes as $include) {
        include($include);
    }

    print_continue($CFG->wwwroot.'/admin/index.php');

    print_box_end();
} else {


    admin_externalpage_setup('adminnotifications');
    $strheader = get_string('installingdemodata','local');
    $navigation = build_navigation(array(array('name'=>$strheader, 'link'=>null, 'type'=>'misc')));
    print_header($strheader, $strheader, $navigation);

    notice_yesno(get_string('installdemoquestion','local'),me(),me(),array('submit'=>'yes'),array('submit'=>'no'));

    print_footer();
}



