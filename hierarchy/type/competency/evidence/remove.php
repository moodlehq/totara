<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competency/lib.php');
require_once($CFG->dirroot.'/competency/evidence/type/abstract.php');


///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$id     = required_param('id', PARAM_INT);
// Delete confirmation hash
$delete = optional_param('delete', '', PARAM_ALPHANUM);

// Load data
$hierarchy         = new competency();
$item              = competency_evidence_type::factory($id);

// Load competency
if (!$competency = get_record('competency', 'id', $item->competencyid)) {
    error('Competency ID was incorrect');
}

// Check capabilities
require_capability('moodle/local:update'.$hierarchy->prefix, $sitecontext);

// Setup page and check permissions
admin_externalpage_setup($hierarchy->prefix.'manage');


///
/// Display page
///

admin_externalpage_print_header();

if (!$delete) {
    $strdelete = get_string('evidenceitemremovecheck', $hierarchy->prefix);

    notice_yesno("$strdelete<br /><br />" . format_string($item->get_name()),
                 "{$CFG->wwwroot}/{$hierarchy->prefix}/evidence/remove.php?id={$item->id}&amp;delete=".md5($item->timemodified)."&amp;sesskey={$USER->sesskey}",
                 "{$CFG->wwwroot}/{$hierarchy->prefix}/view.php?id={$item->competencyid}");

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

$item->delete($competency);

add_to_log(SITEID, $hierarchy->prefix.'evidence', 'delete', "view.php?id=$item->id", $item->get_name()." (ID $item->id)");

print_heading(get_string('removed'.$hierarchy->prefix.'evidenceitem', $hierarchy->prefix, format_string($item->get_name())));
print_continue("{$CFG->wwwroot}/{$hierarchy->prefix}/view.php?id={$item->competencyid}");
print_footer();
