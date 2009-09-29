<?php

require_once('../../config.php');
require_once('../lib.php');
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
admin_externalpage_setup('competencyframeworkmanage');

require_capability('moodle/local:deletecompetencyframeworks', $sitecontext);

if (!$framework = get_record('competency_framework', 'id', $id)) {
    error('Competency framework ID was incorrect');
}


///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('deletecheckframework', 'competencies');

    notice_yesno("$strdelete<br /><br />" . format_string($framework->fullname),
                 "{$CFG->wwwroot}/competencies/frameworks/delete.php?id={$framework->id}&amp;delete=".md5($framework->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/competencies/frameworks/index.php");

    print_footer();
    exit;
}


///
/// Delete competency framework
///

if ($delete != md5($framework->timemodified)) {
    error("The check variable was wrong - try again");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

add_to_log(SITEID, 'competencyframeworks', 'delete', "view.php?frameworkid=$framework->id", "$framework->fullname (ID $framework->id)");

competency_framework_delete($framework);

print_heading(get_string('deletedframework', 'competencies', format_string($framework->fullname)));
print_continue("{$CFG->wwwroot}/competencies/frameworks/index.php");
print_footer();
