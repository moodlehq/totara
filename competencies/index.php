<?php

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');

// Setup page and check permissions
admin_externalpage_setup('competencymanage');
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);

// Load framework
// If no framework id supplied, use default
if ($frameworkid == 0) {
    // TODO grab default.. e.g. get_record('competency_framework', 'default', 1)
    if (!$framework = get_record('competency_framework', 'id', 1)) {
        error('Default competency framework does not exist');
    }

    $frameworkid = $framework->id;
} else {
    if (!$framework = get_record('competency_framework', 'id', $frameworkid)) {
        error('Competency framework does not exist');
    }
}

// Get competency depths
$depths = get_records('competency_depth', 'frameworkid', $framework->id);

// TODO: link to add depth form
if (!$depths) {
    error('No competency depths exist');
}

// Get competencies for this page
$competencies = get_records('competency', 'frameworkid', $framework->id);

// See if user can edit competencies
$can_edit = has_capability('moodle/local:updatecompetencies', $sitecontext);


// If competencies found
if ($competencies) {

    // Create display table
    $table = new stdclass();
    $table->class = 'generalbox editcompetencies';
    $table->width = '95%';

    // Setup column headers
    $table->head = array();

    foreach ($depths as $depth) {
        $table->head[] = $depth->fullname;
    }

    $table->head[] = get_string('evidenceitems', 'competencies');

    // Add edit column
    if ($can_edit) {
        $table->head[] = get_string('edit');
    }

    // Add rows to table
    foreach ($competencies as $competency) {
        $row = array();
        $row[] = "<a href=\"$CFG->wwwroot/competencies/view.php?id=$competency->id\">$competency->fullname</a>";
        $row[] = 0;

        // Add edit link
        if ($can_edit) {
            $buttons = array();
            $buttons[] = '<a href="'.$CFG->wwwroot.'/competencies/edit.php?id='.$competency->id.'">edit</a>';

            // If competency not in the top depth, can move to another parent as same depth
            if (false) {
                $buttons[] = 'Move';
            }

            $row[] = implode($buttons, '');
        };

        $table->data[] = $row;
    }
}


// Display page
admin_externalpage_print_header();

print '<p>Framework selector</p>';

if ($competencies) {
        #print_paging_bar($usercount, $page, $perpage,
    #    "user.php?sort=$sort&amp;dir=$dir&amp;perpage=$perpage&amp;");
    #
    print_table($table);

        #print_paging_bar($usercount, $page, $perpage,
    #    "user.php?sort=$sort&amp;dir=$dir&amp;perpage=$perpage&amp;");
} else {
    if ($enableframeworks) {
        $nocompetencies = get_string('nocompetenciesinframework', 'competencies');
    } else {
        $nocompetencies = get_string('nocompetencies', 'competencies');
    }

    // Print "no competencies" notice
    print_heading($nocompetencies);
}

// Editing buttons
if (has_capability('moodle/local:createcompetencies', $sitecontext)) {
    echo '<div class="buttons">';

    // Print button to add a depth level
    $options = array('frameworkid' => $framework->id);
    print_single_button($CFG->wwwroot.'/competencies/depthlevel.php', $options, get_string('adddepthlevel', 'competencies'), 'get');

    // Print button for creating new competency
    $options = array('framework' => $framework->id);
    print_single_button($CFG->wwwroot.'/competencies/edit.php', $options, get_string('addnewcompetency', 'competencies'), 'get');

    echo '</div>';
}

print_footer();
