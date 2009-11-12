<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

// Competency id
$id = required_param('id', PARAM_INT);

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/related/save.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load competency
if (!$competency = $hierarchy->get_item($id)) {
    error('Competency could not be found');
}

// Check if user is editing
$editingon = false;
if (!empty($USER->competencyediting)) {
    $str_remove = get_string('remove');
    $editingon = true;
}


///
/// Add related competencies
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
    $related = $hierarchy->get_item($addition);

    // Load framework
    $framework = $hierarchy->get_framework($related->frameworkid);

    // Load depths
    $depths = $hierarchy->get_depths();

    // Add relationship
    $relationship = new Object();
    $relationship->id1 = $competency->id;
    $relationship->id2 = $related->id;

    insert_record('competency_relations', $relationship);

    // Return html
    echo '<tr>';
    echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$hierarchy->prefix}&id={$framework->id}\">{$framework->fullname}</a></td>";
    echo '<td>'.$depths[$related->depthid]->fullname.'</td>';
    echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$related->id}\">{$related->fullname}</a></td>";

    if ($editingon) {
        echo "<td style=\"text-align: center;\">";

        echo "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/related/remove.php?id={$related->id}\" title=\"$str_remove\">".
             "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

        echo "</td>";
    }

    echo '</tr>'.PHP_EOL;
}
