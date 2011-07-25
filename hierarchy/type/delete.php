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
$id     = required_param('id', PARAM_INT);
$prefix = required_param('prefix', PARAM_ALPHA);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

$hierarchy = hierarchy::load_hierarchy($prefix);

// Setup page and check permissions
admin_externalpage_setup($prefix.'typemanage');

require_capability('moodle/local:delete'.$prefix.'type', $sitecontext);

$type = $hierarchy->get_type_by_id($id);

$back_url = "{$CFG->wwwroot}/hierarchy/type/index.php?prefix={$prefix}";

///
/// Display page
///

// User hasn't confirmed deletion yet
if (!$delete) {
    admin_externalpage_print_header();
    print_heading(get_string('deletetype', $prefix, format_string($type->fullname)), 'left', 1);

    $strdelete = get_string('deletechecktype', 'hierarchy');
    notice_yesno("$strdelete<br /><br />",
        "{$CFG->wwwroot}/hierarchy/type/delete.php?prefix={$prefix}&amp;id={$type->id}&amp;delete=".md5($type->timemodified)."&amp;sesskey={$USER->sesskey}",
        $back_url);

    print_footer();
    exit;
}


///
/// Delete type
///

if ($delete != md5($type->timemodified)) {
    print_error('error:deletetypecheckvariable','hierarchy');
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

$deleteresult = $hierarchy->delete_type($type->id);

if ($deleteresult === true) {
    add_to_log(SITEID, $prefix, 'delete type', "type/index.php?prefix={$prefix}", "$type->fullname (ID $type->id)");
    totara_set_notification(get_string('deletedtype', $prefix, $type->fullname), "{$CFG->wwwroot}/hierarchy/type/index.php?prefix={$prefix}", array('style'=>'notifysuccess'));
} else {
    totara_set_notification(get_string('error:deletedtype', $prefix, $type->fullname), "{$CFG->wwwroot}/hierarchy/type/index.php?prefix={$prefix}");
}

