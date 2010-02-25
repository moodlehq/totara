<?php

phprequire_once('../../config.php');
require_once('../lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id     = required_param('id', PARAM_INT);
$type   = required_param('type', PARAM_SAFEDIR);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
    $hierarchy = new $type();
} else {
    print_error('error:hierarchytypenotfound', 'hierarchy', $type);
}

// Setup page and check permissions
admin_externalpage_setup($type.'manage');

require_capability('moodle/local:delete'.$type.'depth', $sitecontext);

$depth = $hierarchy->get_depth_by_id($id);
$hierarchy->get_framework($depth->frameworkid);

$back_url = "{$CFG->wwwroot}/hierarchy/index.php?type={$type}&amp;frameworkid={$depth->frameworkid}";

///
/// Display page
///

admin_externalpage_print_header();

// User hasn't confirmed deletion yet
if (!$delete) {

    // Check whether the depth level even can be deleted
    $safetodelete = $hierarchy->is_safe_to_delete_depth($depth->id);

    // If safe, prompt for confirmation
    if ( $safetodelete === true ){
        $strdelete = get_string('deletecheckdepth', 'hierarchy');
        notice_yesno("$strdelete<br /><br />" . format_string($depth->fullname),
                     "{$CFG->wwwroot}/hierarchy/depth/delete.php?type={$type}&amp;id={$depth->id}&amp;delete=".md5($depth->timemodified)."&amp;sesskey={$USER->sesskey}",
                     $back_url);
    } else {
        notice( get_string($safetodelete, 'hierarchy'), $back_url);
    }
    print_footer();
    exit;
}


///
/// Delete depth level
///
if ($delete != md5($depth->timemodified)) {
    print_error('error:deletedepthcheckvariable','hierarchy');
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, $type.'depths', 'delete', $back_url, "$depth->fullname (ID $depth->id)");

$deleteresult = $hierarchy->delete_depth($depth->id);

if ( $deleteresult === true ){
    print_heading(get_string('deleteddepth', 'hierarchy', format_string($framework->fullname)));
    print_continue($back_url);
} else {
    notice( get_string($deleteresult, 'hierarchy'), $back_url);
}
print_footer();
