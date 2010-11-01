<?php

require_once('../../config.php');
require_once('../lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$type   = required_param('type', PARAM_SAFEDIR);
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
    $hierarchy = new $type();
} else {
    error('error:hierarchytypenotfound', 'hierarchy', $type);
}

// Setup page and check permissions
admin_externalpage_setup($type.'frameworkmanage','',array('type'=>$type));

require_capability('moodle/local:delete'.$type.'frameworks', $sitecontext);

$framework = $hierarchy->get_framework($id);

///
/// Display page
///
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$type}frameworks", $type),
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}",
                    'type'=>'misc');
$navlinks[] = array('name'=>get_string('deleteframework', $type, format_string($framework->fullname)), 'link'=>'', 'type'=>'misc');


admin_externalpage_print_header('', $navlinks);

if (!$delete) {
    $strdelete = get_string('deletecheckframework', $type, format_string($framework->fullname));

    print_heading(get_string('deleteframework', $type, format_string($framework->fullname)), 'left', 1);

    notice_yesno("$strdelete<br /><br />",
                 "{$CFG->wwwroot}/hierarchy/framework/delete.php?type={$type}&id={$framework->id}&amp;delete=".md5($framework->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}");

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

// Log
add_to_log(SITEID, 'hierarchy', $type . ' framework delete', "hierarchy/framework/index.php?type={$type}", "$framework->fullname (ID $framework->id)");

$hierarchy->delete_framework();

print_heading(get_string('deletedframework', $type, format_string($framework->fullname)));
print_continue("{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}");
print_footer();
