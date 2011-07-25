<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/organisation/lib.php');


///
/// Params
///

// Competency id
$assignto = required_param('assignto', PARAM_INT);

// Framework id
$frameworkid = required_param('frameworkid', PARAM_INT);

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

// Indicates whether current related items, not in $add list, should be deleted
$deleteexisting = optional_param('deleteexisting', 0, PARAM_BOOL);

// Non JS parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Setup page
admin_externalpage_setup('organisationmanage');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updateorganisation', $sitecontext);

// Setup hierarchy objects
$competencies = new competency();
$organisations = new organisation();

// Load organisation
if (!$organisation = $organisations->get_item($assignto)) {
    error('Position could not be found');
}

// Currently assigned competencies
if (!$currentlyassigned = $organisations->get_assigned_competencies($assignto, $frameworkid)) {
    $currentlyassigned = array();
}


// Parse input
$add = $add ? explode(',', $add) : array();
$time = time();

///
/// Delete removed assignments (if specified)
///

if ($deleteexisting) {
    $removeditems = array_diff(array_keys($currentlyassigned), $add);

    foreach ($removeditems as $rid) {
        delete_records('org_competencies', 'organisationid', $organisation->id, 'competencyid', $rid);
        add_to_log(SITEID, 'organisation', 'delete competency assignment', "item/view.php?id={$assignto}&amp;prefix=organisation", "Organisation (ID $organisation->id)");
    }
}


///
/// Assign competencies
///

$str_remove = get_string('remove');

$rc = 0;
foreach ($add as $addition) {
    $rc = $rc == 0 ? 1 : 0;
    if (in_array($addition, array_keys($currentlyassigned))) {
        // Skip assignment
        continue;
    }
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // Load competency
    $related = $competencies->get_item($addition);

    // Load framework
    $framework = $competencies->get_framework($related->frameworkid);

    // Load types
    $types = $competencies->get_types();

    // Add relationship
    $relationship = new Object();
    $relationship->organisationid = $organisation->id;
    $relationship->competencyid = $related->id;
    $relationship->timecreated = $time;
    $relationship->usermodified = $USER->id;

    $relationship->id = insert_record('org_competencies', $relationship);
    add_to_log(SITEID, 'organisation', 'create competency assignment', "item/view.php?id={$assignto}&amp;prefix=organisation", "$related->fullname (ID $related->id)");
}

if($nojs) {
    // If JS disabled, redirect back to original page (only if session key matches)
    $url = ($s == sesskey()) ? $returnurl : $CFG->wwwroot;
    redirect($url);
} else {
    $organisations->display_extra_view_info($organisation, $frameworkid);
}

