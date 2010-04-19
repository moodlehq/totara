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

// Non JS parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

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

$str_remove = get_string('remove');

foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // Load competency
    $related = $competencies->get_template($addition);

    // Load framework
    $framework = $competencies->get_framework($related->frameworkid);

    // Add relationship
    $relationship = new Object();
    $relationship->positionid = $position->id;
    $relationship->templateid = $related->id;
    $relationship->timecreated = $time;
    $relationship->usermodified = $USER->id;

    $relationship->id = insert_record('pos_competencies', $relationship);

    if($nojs) {
        // If JS disabled, redirect back to original page (only if session key matches)
        $url = ($s == sesskey()) ? $returnurl : $CFG->wwwroot;
        redirect($url);
    } else {

        // Return html
        echo '<tr class="r1">';

        echo '<td class="cell c0">';
        echo "<a href=\"{$CFG->wwwroot}/hierarchy/index.php?type=competency&frameworkid={$framework->id}\">{$framework->fullname}</a>";
        echo '</td>';

        echo '<td class="cell c1">';
        echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/view.php?id={$related->id}\">{$related->fullname}</a>";
        echo '</td>';

        echo '<td class="cell c2">';
        echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/position/assigncompetency/remove.php?id={$relationship->id}&position={$position->id}\" title=\"$str_remove\">".
             "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
        echo '</td>';

        echo '</tr>'.PHP_EOL;
    }
}
