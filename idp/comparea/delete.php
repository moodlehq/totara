<?php
require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('../lib.php');

/// Setup / loading data
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Setup page and check permissions
admin_externalpage_setup('idppriorities');

//require_capability('moodle/local:manageidppriorities', $sitecontext);

if (!$competencyarea = get_record('idp_comp_area', 'id', $id)) {
    error('IDP competency area ID was incorrect');
}

/// Display page
admin_externalpage_print_header();

$returnurl = "{$CFG->wwwroot}/idp/settings/index.php";
$deleteurl = "{$CFG->wwwroot}/idp/comparea/delete.php?id={$competencyarea->id}&amp;delete=".md5($competencyarea->timemodified)."&amp;sesskey={$USER->sesskey}";

if (!$delete) {
    $strdelete = get_string('deletecheckcomparea', 'idp');
    notice_yesno(
        "{$strdelete}<br /><br />".format_string($scale->name),
        $deleteurl,
        $returnurl
    );

    print_footer();
    exit;
}

/// Delete competency scale
if ($delete != md5($competencyarea->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'idpcomparea', 'delete', "index.php?id=$competencyarea->id", "$competencyarea->fullname (ID $competencyarea->id)");

// Delete assignment of frameworks to area
delete_records('idp_comp_area_fw', 'areaid', $competencyarea->id);
// Delete scale values
delete_records('idp_comp_area', 'id', $competencyarea->id);

echo '<p>'.get_string('deletedcomparea', 'idp', format_string($competencyarea->fullname)).'</p>';
print_continue($returnurl);
print_footer();
