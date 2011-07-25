<?php

require_once('../../config.php');
require_once('../lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

hierarchy::support_old_url_syntax();

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$prefix   = required_param('prefix', PARAM_SAFEDIR);
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

$hierarchy = hierarchy::load_hierarchy($prefix);

// Setup page and check permissions
admin_externalpage_setup($prefix.'manage','',array('prefix'=>$prefix));

require_capability('moodle/local:delete'.$prefix.'frameworks', $sitecontext);

$framework = $hierarchy->get_framework($id);

///
/// Display page
///
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix),
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}",
                    'type'=>'misc');
$navlinks[] = array('name'=>get_string('deleteframework', $prefix, format_string($framework->fullname)), 'link'=>'', 'type'=>'misc');

if (!$delete) {
    admin_externalpage_print_header('', $navlinks);
    $strdelete = get_string('deletecheckframework', $prefix, format_string($framework->fullname));

    print_heading(get_string('deleteframework', $prefix, format_string($framework->fullname)), '', 1);

    notice_yesno("$strdelete<br /><br />",
                 "{$CFG->wwwroot}/hierarchy/framework/delete.php?prefix={$prefix}&id={$framework->id}&amp;delete=".md5($framework->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}");

    print_footer();
    exit;
}


///
/// Delete framework
///

if ($delete != md5($framework->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

if($hierarchy->delete_framework()) {
    // Log
    add_to_log(SITEID, $prefix, 'framework delete', "framework/index.php?prefix={$prefix}", "$framework->fullname (ID $framework->id)");
    totara_set_notification(get_string('deletedframework', $prefix, $framework->fullname), "{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}", array('style'=>'notifysuccess'));
} else {
    totara_set_notification(get_string('error:deletedframework', $prefix, $framework->fullname), "{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}");
}

print_footer();
