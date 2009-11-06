<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competency/lib.php');


///
/// Setup / loading data
///

// Template id
$id = required_param('templateid', PARAM_INT);

// Competencies to assign
$assignments = required_param('assign', PARAM_SEQUENCE);

// Setup page
admin_externalpage_setup('competencytemplatemanage', '', array(), '', $CFG->wwwroot.'/competency/template/update_assignments.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetencytemplate', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();

// Load template
if (!$template = $hierarchy->get_template($id)) {
    error('Template ID was incorrect');
}

// Load framework
if (!$framework = $hierarchy->get_framework($template->frameworkid)) {
    error('Competency framework could not be found');
}

// Load depths
$depths = $hierarchy->get_depths();

// Check if user is editing
$editingon = false;
if (!empty($USER->competencyediting)) {
    $str_remove = get_string('remove');
    $editingon = true;
}


///
/// Assign competencies
///

// Parse assignments
$assignments = explode(',', $assignments);
$time = time();

foreach ($assignments as $assignment) {
    // Check id
    if (!is_numeric($assignment)) {
        error('Supplied bad data - non numeric assignment');
    }

    // Load competency
    $competency = $hierarchy->get_item($assignment);

    // Assign
    $assign = new Object();
    $assign->templateid = $template->id;
    $assign->type = 1;
    $assign->instanceid = $competency->id;
    $assign->timecreated = $time;
    $assign->usermodified = $USER->id;

    insert_record('competency_template_assignment', $assign);

    // Return html
    echo '<tr>';
    echo '<td>'.$depths[$competency->depthid]->fullname.'</td>';
    echo "<td><a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/view.php?id={$competency->id}\">{$competency->fullname}</a></td>";

    if ($editingon) {
        echo "<td style=\"text-align: center;\">";

        echo "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/template/remove_assignment.php?templateid={$template->id}&assignment={$competency->id}\" title=\"$str_remove\">".
"<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

        echo "</td>";
    }

    echo '</tr>'.PHP_EOL;
}

// Update competency count for template
$count = get_field('competency_template_assignment', 'COUNT(*)', 'templateid', $template->id);
$template->competencycount = (int) $count;

update_record('competency_template', $template);
