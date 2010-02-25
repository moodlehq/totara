<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');


///
/// Params
///

// Competency id
$assignto = required_param('assignto', PARAM_INT);

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

// Setup page
admin_externalpage_setup('positionmanage');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updateposition', $sitecontext);

// Setup hierarchy objects
$competencies = new competency();
$positions = new position();

// Load position
if (!$position = $positions->get_item($assignto)) {
    error('Position could not be found');
}


///
/// Assign competencies
///

// Parse input
$add = explode(',', $add);
$time = time();

foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // Load competency
    $related = $competencies->get_item($addition);

    // Load framework
    $framework = $competencies->get_framework($related->frameworkid);

    // Load depths
    $depths = $competencies->get_depths();

    // Add relationship
    $relationship = new Object();
    $relationship->positionid = $position->id;
    $relationship->competencyid = $related->id;
    $relationship->timecreated = $time;
    $relationship->usermodified = $USER->id;

    insert_record('position_competencies', $relationship);

    // Return html
    echo '<tr class="r1">';

    echo '<td class="cell c0">';
    echo "<a href=\"{$CFG->wwwroot}/hierarchy/index.php?type=competency&frameworkid={$framework->id}\">{$framework->fullname}</a>";
    echo '</td>';

    echo '<td class="cell c1">';
    echo format_string($depths[$related->depthid]->fullname);
    echo '</td>';

    echo '<td class="cell c2">';
    echo "<a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$related->id}\">{$related->fullname}</a>";
    echo '</td>';

    echo '<td class="cell c3">';
    echo "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/related/remove.php?id={$related->id}\" title=\"$str_remove\">".
         "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
    echo '</td>';

    echo '</tr>'.PHP_EOL;
}
