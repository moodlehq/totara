<?php

require_once('../../config.php');
require_once('../lib.php');
require_once($CFG->libdir.'/adminlib.php');

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$competencyedit = optional_param('competencyedit', -1, PARAM_BOOL);
$hide = optional_param('hide', 0, PARAM_INT);
$show = optional_param('show', 0, PARAM_INT);
$moveup = optional_param('moveup', 0, PARAM_INT);
$movedown = optional_param('movedown', 0, PARAM_INT);

// Handle editing toggling
if (update_competency_button()) {
    if ($competencyedit !== -1) {
        $USER->competencyediting = $competencyedit;
    }
    $editingon = !empty($USER->competencyediting);
    $navbaritem = update_competency_button(); // Must call this again after updating the state.
} else {
    $navbaritem = '';
    $editingon = false;
}

// Setup page and check permissions
admin_externalpage_setup('competencyframeworkmanage', $navbaritem);

// Cache user capabilities
$can_add = has_capability('moodle/local:createcompetencyframeworks', $sitecontext);
$can_edit = has_capability('moodle/local:updatecompetencyframeworks', $sitecontext);
$can_delete = has_capability('moodle/local:deletecompetencyframeworks', $sitecontext);


///
/// Process any actions
///

if ($editingon) {
    // Hide or show a competency
    if ((!empty($hide) or !empty($show))) {
        require_capability('moodle/local:updatecompetencies', $sitecontext);

        if (!empty($hide)) {
            $competency = get_record('competency', 'id', $hide);
            $visible = 0;
        } else {
            $competency = get_record('competency', 'id', $show);
            $visible = 1;
        }

        if ($competency) {
            if (!set_field('competency', 'visible', $visible, 'id', $competency->id)) {
                notify('Could not update that competency!');
            }
        }
    }

    /// Reorder a competency
    if ((!empty($moveup) or !empty($movedown))) {
        require_capability('moodle/local:updatecompetencies', $sitecontext);
        $movecourse = NULL;
        $swapcourse = NULL;

        // ensure the course order has no gaps and isn't at 0
        fix_course_sortorder($category->id);

        // we are going to need to know the range
        $max = get_record_sql('SELECT MAX(sortorder) AS max, 1
                FROM ' . $CFG->prefix . 'course WHERE category=' . $category->id);
        $max = $max->max + 100;

        if (!empty($moveup)) {
            $movecourse = get_record('course', 'id', $moveup);
            $swapcourse = get_record('course', 'category',  $category->id,
                    'sortorder', $movecourse->sortorder - 1);
        } else {
            $movecourse = get_record('course', 'id', $movedown);
            $swapcourse = get_record('course', 'category',  $category->id,
                    'sortorder', $movecourse->sortorder + 1);
        }

        if ($swapcourse and $movecourse) {
            // Renumber everything for robustness
            begin_sql();
            if (!(    set_field('course', 'sortorder', $max, 'id', $swapcourse->id)
                   && set_field('course', 'sortorder', $swapcourse->sortorder, 'id', $movecourse->id)
                   && set_field('course', 'sortorder', $movecourse->sortorder, 'id', $swapcourse->id)
                )) {
                notify('Could not update that course!');
            }
            commit_sql();
        }
    }

} // End of editing stuff


///
/// Load competency frameworks after any changes
///

// Get frameworks for this page
$frameworks = get_records('competency_framework', '', '', 'sortorder');


///
/// Generate / display page
///
$str_edit     = get_string('edit');
$str_delete   = get_string('delete');
$str_moveup   = get_string('moveup');
$str_movedown = get_string('movedown');
$str_hide     = get_string('hide');
$str_show     = get_string('show');

if ($frameworks) {

    // Create display table
    $table = new stdclass();
    $table->class = 'generalbox editcompetencies';
    $table->width = '95%';

    // Setup column headers
    $table->head = array();
    $table->align = array();
    $table->head[] = get_string('framework', 'competencies');
    $table->align[] = 'left';

    // Add edit column
    if ($editingon && $can_edit) {
        $table->head[] = get_string('edit');
        $table->align[] = 'center';
    }

    // Add rows to table
    foreach ($frameworks as $framework) {
        $row = array();

        $cssclass = !$framework->visible ? 'class="dimmed"' : '';

        $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/competencies/index.php?frameworkid={$framework->id}\">{$framework->fullname}</a>";

        // Add edit link
        $buttons = array();
        if ($editingon && $can_edit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/frameworks/edit.php?id={$framework->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
/*
            if ($framework->visible) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/index.php?hide={$framework->id}\" title=\"$str_hide\">".
                    "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
            } else {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/index.php?show={$framework->id}\" title=\"$str_show\">".
                    "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
            }
*/
        }

        if ($editingon && $can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/frameworks/delete.php?id={$framework->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }

        if ($buttons) {
            $row[] = implode($buttons, ' ');
        }

        $table->data[] = $row;
    }
}


// Display page
admin_externalpage_print_header();

if ($frameworks) {
    print_table($table);
} else {
    print_heading(get_string('noframeworks', 'competencies'));
}


// Editing buttons
if ($can_add) {
    echo '<div class="buttons">';

    // Print button for creating new competency framework
    print_single_button($CFG->wwwroot.'/competencies/frameworks/edit.php', array(), get_string('addnewframework', 'competencies'), 'get');

    echo '</div>';
}

print_footer();
