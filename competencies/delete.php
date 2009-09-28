<?php

require_once('../config.php');
require_once('./lib.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Setup page and check permissions
admin_externalpage_setup('competencymanage');

require_capability('moodle/local:deletecompetencies', $sitecontext);

if (!$competency = get_record('competency', 'id', $id)) {
    error('Competency ID was incorrect');
}


///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheck', 'competencies');

    notice_yesno("$strdelete<br /><br />" . format_string($competency->fullname),
                 "{$CFG->wwwroot}/competencies/delete.php?id={$competency->id}&amp;delete=".md5($competency->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/competencies/index.php?frameworkid={$competency->frameworkid}");

    print_footer();
    exit;
}


///
/// Delete competency
///

if ($delete != md5($competency->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'competencies', 'delete', "view.php?id=$competency->id", "$competency->fullname (ID $competency->id)");

competency_delete($competency);

print_heading(get_string('deletedcompetency', 'competencies', format_string($competency->fullname)));
print_continue("{$CFG->wwwroot}/competencies/index.php?frameworkid=$competency->frameworkid");
print_footer();
