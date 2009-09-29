<?php


/**
 * Competency aggregation methods
 *
 * These are mapped to lang strings in the competency lang file
 * with the key as a suffix e.g. for ALL, 'aggregationmethod1'
 */
$COMP_AGGREGATION = array(
    'ALL'       => 1,
    'ANY'       => 2,
    'UNIT'      => 3,
    'FRACTION'  => 4,
    'SUM'       => 5,
    'AVERAGE'   => 6,
);


/**
 * Prints the turn editing on/off button on competencies/index.php
 *
 * @return string HTML of the editing button, or empty string, if this user is not allowed
 *      to see it.
 */
function update_competency_button() {
    global $CFG, $USER;

    // Check permissions.
    $sitecontext = get_context_instance(CONTEXT_SYSTEM);
    $capabilities = array(
        'moodle/local:updatecompetencies',
        'moodle/local:deletecompetencies',
        'moodle/local:createcompetencydepth',
        'moodle/local:updatecompetencydepth',
    );

    if (!has_any_capability($capabilities, $sitecontext)) {
        return '';
    }

    // Work out the appropriate action.
    if (!empty($USER->competencyediting)) {
        $label = get_string('turneditingoff');
        $edit = 'off';
    } else {
        $label = get_string('turneditingon');
        $edit = 'on';
    }

    // Generate the button HTML.
    $options = array('competencyedit' => $edit);
    return print_single_button("{$CFG->wwwroot}/competencies/index.php", $options,
            $label, 'get', '', true);
}


/**
 * Recursively called function for deleting competencies and their children
 *
 * @param   object  $competency
 * @return  void
 */
function competency_delete($competency) {

    // Delete all child competencies
    $children = get_records('competency', 'parentid', $competency->id);

    if ($children) {
        // Call this function recursively
        foreach ($children as $child) {
            competency_delete($child);
        }
    }

    // Finally delete this competency
    delete_records('competency', 'id', $competency->id);
}


/**
 * Delete competency framework and it's competencies
 *
 * @param   object  $framework
 * @return  void
 */
function competency_framework_delete($framework) {

    // Delete all competencies
    $children = get_records_select('competency', "frameworkid = {$framework->id} AND parentid = 0");

    if ($children) {
        // Call competency_delete() function recursively
        foreach ($children as $child) {
            competency_delete($child);
        }
    }

    // Finally delete this competency framework
    delete_records('competency_framework', 'id', $framework->id);
}
