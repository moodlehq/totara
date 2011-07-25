<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

hierarchy::support_old_url_syntax();

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$prefix   = required_param('prefix', PARAM_ALPHA);
$shortprefix = hierarchy::get_short_prefix($prefix);
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);
$page  = optional_param('page', 0, PARAM_INT);

$hierarchy = hierarchy::load_hierarchy($prefix);

$item = $hierarchy->get_item($id);
if (!$item) {
    add_to_log(SITEID, $prefix, 'delete item fail', "index.php?id={$framework->id}&amp;prefix={$prefix}", "invalid hierarchy item id (ID $id)");
    error('No item with that ID.');
}
// Load framework
if (!$framework = get_record($shortprefix.'_framework', 'id', $item->frameworkid)) {
    error($prefix.' framework ID was incorrect');
}

require_capability('moodle/local:delete'.$prefix, $sitecontext);

// Setup page and check permissions
admin_externalpage_setup($prefix.'manage','',array('prefix'=>$prefix));

if (!$delete) {
    ///
    /// Display page
    ///
    $navlinks = array();    // Breadcrumbs
    $navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>$CFG->wwwroot . '/hierarchy/framework/index.php?prefix='.$prefix, 'type'=>'misc');
    $navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/index.php?prefix='.$prefix.'&amp;frameworkid='.$framework->id, 'type'=>'misc');
    $navlinks[] = array('name'=>format_string($item->fullname), 'link'=>$CFG->wwwroot . '/hierarchy/item/view.php?prefix='.$prefix.'&amp;id='.$item->id, 'type'=>'misc');
    $navlinks[] = array('name'=>get_string('delete'.$prefix, $prefix), 'link'=>'', 'type'=>'title');

    admin_externalpage_print_header('', $navlinks);

    $strdelete = $hierarchy->get_delete_message($item->id);

    notice_yesno($strdelete,
                 "{$CFG->wwwroot}/hierarchy/item/delete.php?prefix={$prefix}&id={$item->id}&amp;delete=".md5($item->timemodified)."&amp;sesskey={$USER->sesskey}&amp;page={$page}",
                 "{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&frameworkid={$item->frameworkid}");

    print_footer();
    exit;
}


///
/// Delete
///
if ($delete != md5($item->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

if ($hierarchy->delete_framework_item($item->id)) {

    add_to_log(SITEID, $prefix, 'delete item', "index.php?id={$framework->id}&amp;prefix={$prefix}", "$item->fullname (ID $item->id)");
    totara_set_notification(get_string('deleted'.$prefix, $prefix, format_string($item->fullname)),
        "{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&frameworkid={$item->frameworkid}&page={$page}",
        array('style' => 'notifysuccess'));
} else {
    totara_set_notification(get_string('error:deletedframework', $prefix, format_string($item->fullname)),
        "{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&frameworkid={$item->frameworkid}&page={$page}");
}

