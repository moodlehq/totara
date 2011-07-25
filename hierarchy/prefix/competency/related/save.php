<?php

require_once('../../../../config.php');
require_once('lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');


///
/// Setup / loading data
///

// Competency id
$compid = required_param('id', PARAM_INT);

// Competencies to relate
$relidlist = required_param('add', PARAM_SEQUENCE);

// Non JS parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Indicates whether current related items, not in $relidlist, should be deleted
$deleteexisting = optional_param('deleteexisting', 0, PARAM_BOOL);

// Get currently-related competencies
if (!$currentlyrelated = comp_relation_get_relations($compid)) {
    $currentlyrelated = array();
}

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/related/save.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load competency
if (!$competency = $hierarchy->get_item($compid)) {
    error('Competency could not be found');
}

$str_remove = get_string('remove');

// Parse input
$relidlist = $relidlist ? explode(',', $relidlist) : array();
$time = time();

///
/// Delete removed relationships (if specified)
///
if ($deleteexisting) {
    $removeditems = array_diff($currentlyrelated, $relidlist);
    
    foreach ($removeditems as $ritem) {
        delete_records('comp_relations', 'id1', $compid, 'id2', $ritem);
        delete_records('comp_relations', 'id2', $compid, 'id1', $ritem);
    }
}


///
/// Add related competencies
///

foreach ($relidlist as $relid) {
    // Check id
    if (!is_numeric($relid)) {
        error('Supplied bad data - non numeric id');
    }

    // Don't relate a competency to itself
    if ( $compid == $relid ){
        continue;
    }

    // Check to see if the relationship already exists.
    $alreadyrelated = get_records_select(
            'comp_relations',
            "(id1={$compid} and id2={$relid}) or (id1={$relid} and id2={$compid})",
            '',
            'id',
            0,
            1
    );
    if ( is_array($alreadyrelated) && count($alreadyrelated) > 0 ){
        continue;
    }

    // Load competency
    $related = $hierarchy->get_item($relid);

    // Load framework
    $framework = $hierarchy->get_framework($related->frameworkid);

    // Load type
    $types = $hierarchy->get_types();

    // Add relationship
    $relationship = new Object();
    $relationship->id1 = $competency->id;
    $relationship->id2 = $related->id;

    $relationship->id = insert_record('comp_relations', $relationship);
}

if($nojs) {
    // If JS disabled, redirect back to original page (only if session key matches)
    $url = ($s == sesskey()) ? $returnurl : $CFG->wwwroot;
    redirect($url);
} else {
    $hierarchy->display_extra_view_info($competency, 'related');
}
