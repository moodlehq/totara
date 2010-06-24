<?php

require_once('../../../../config.php');
require_once('lib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


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

// Check if user is editing
$editingon = false;
if (!empty($USER->competencyediting)) {
    $str_remove = get_string('remove');
    $editingon = true;
}

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

        echo " ~~~RELOAD PAGE~~~ ";  // Indicate that a page reload is required
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

    // Load depths
    $depths = $hierarchy->get_depths();

    // Add relationship
    $relationship = new Object();
    $relationship->id1 = $competency->id;
    $relationship->id2 = $related->id;

    insert_record('comp_relations', $relationship);

    if(!$nojs) {
        // Return html
        echo '<tr>';
        echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/index.php?type={$hierarchy->prefix}&frameworkid={$framework->id}\">{$framework->fullname}</a></td>";
        echo '<td>'.$depths[$related->depthid]->fullname.'</td>';
        echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$related->id}\">{$related->fullname}</a></td>";

        if ($editingon) {
            echo "<td style=\"text-align: center;\">";

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/related/remove.php?id={$competency->id}&related={$related->id}\" title=\"$str_remove\">".
                 "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

            echo "</td>";
        }

        echo '</tr>'.PHP_EOL;
    }
}

if($nojs) {
    // If JS disabled, redirect back to original page (only if session key matches)
    $url = ($s == sesskey()) ? $returnurl : $CFG->wwwroot;
    redirect($url);
}
