<?php

require_once('../../../../config.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

$hierarchy = new competency();

// Setup page and check permissions
admin_externalpage_setup($hierarchy->prefix.'frameworkmanage');

require_capability('moodle/local:delete'.$hierarchy->prefix.'template', $sitecontext);

$template = $hierarchy->get_template($id);

///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletechecktemplate', $hierarchy->prefix);

    notice_yesno("$strdelete<br /><br />" . format_string($template->fullname),
                 "{$CFG->wwwroot}/hierarchy/type/{$hierarchy->prefix}/template/delete.php?id={$template->id}&amp;delete=".md5($template->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/hierarchy/framework/view.php?type=competency&frameworkid={$template->frameworkid}");

    print_footer();
    exit;
}


///
/// Delete template
///

if ($delete != md5($template->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, $hierarchy->prefix.'template', 'delete', "view.php?id=$template->id", "$template->fullname (ID $template->id)");

$hierarchy->delete_template($id);

print_heading(get_string('deletedtemplate', $hierarchy->prefix, format_string($template->fullname)));
print_continue("{$CFG->wwwroot}/hierarchy/framework/view.php?type=competency&frameworkid={$template->frameworkid}");
print_footer();
