<?php

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
