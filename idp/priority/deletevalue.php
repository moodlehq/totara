<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Setup page and check permissions
admin_externalpage_setup('idppriorities');

require_capability('moodle/local:manageidppriorities', $sitecontext);

if (!$value = get_record('idp_tmpl_priority_scal_val', 'id', $id)) {
    error('Priority scale value ID was incorrect');
}


///
/// Display page
///

admin_externalpage_print_header();

$returnurl = "{$CFG->wwwroot}/idp/priority/view.php?id={$value->priorityscaleid}";
$deleteurl = "{$CFG->wwwroot}/idp/priority/deletevalue.php?id={$value->id}&amp;delete=".md5($value->timemodified)."&amp;sesskey={$USER->sesskey}";

// Can't delete if the scale is in use
if ( priority_scale_is_used($value->priorityscaleid) ) {
    print_error('error:nodeletepriorityvalueinuse', 'idp', $returnurl);
}

if (!$delete) {
    $strdelete = get_string('deletecheckpriorityvalue', 'idp');

    notice_yesno(
        "{$strdelete}<br /><br />" . format_string($value->name),
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}


///
/// Delete competency scale
///

if ($delete != md5($value->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'priorityscalesvalu', 'delete', "view.php?id=$value->priorityscaleid", "$value->name (ID $value->id)");

delete_records('idp_tmpl_priority_scal_val', 'id', $value->id);

print_heading(get_string('deletedpriorityscalevalue', 'idp', format_string($value->name)));
print_continue($returnurl);
print_footer();
