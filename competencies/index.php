<?php

require_once('../config.php');
require_once('./lib.php');
require_once($CFG->libdir.'/adminlib.php');

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$frameworkid = optional_param('frameworkid', 0, PARAM_INT);
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
admin_externalpage_setup('competencymanage', $navbaritem);

// Load framework
// If no framework id supplied, use default
if ($frameworkid == 0) {
    if (!$framework = get_record('competency_framework', 'isdefault', 1)) {
        error('Default competency framework does not exist');
    }

    $frameworkid = $framework->id;
} else {
    if (!$framework = get_record('competency_framework', 'id', $frameworkid)) {
        error('Competency framework does not exist');
    }
}


// Cache user capabilities
$can_add_comp = has_capability('moodle/local:createcompetencies', $sitecontext);
$can_edit_comp = has_capability('moodle/local:updatecompetencies', $sitecontext);
$can_delete_comp = has_capability('moodle/local:deletecompetencies', $sitecontext);
$can_add_depth = has_capability('moodle/local:createcompetencydepth', $sitecontext);
$can_edit_depth = has_capability('moodle/local:updatecompetencydepth', $sitecontext);


// Get competency depths
$depths = get_records('competency_depth', 'frameworkid', $framework->id, 'id');

// Link to add depth form
if (!$depths) {

    // Display page
    admin_externalpage_print_header();

    // Show framework selector
    $frameworks = get_records('competency_framework', 'visible', 1);

    if (count($frameworks) > 1) {
        $fwoptions = array();

        foreach ($frameworks as $fw) {
            $fwoptions[$fw->id] = $fw->fullname;
        }

        echo '<div class="frameworkpicker">';
        popup_form($CFG->wwwroot.'/competencies/index.php?frameworkid=', $fwoptions, 'switchframework', $framework->id, '');
        echo '</div>';
    }

    print_heading(get_string('nodepthlevels', 'competencies'));

    // Print button to add a depth level
    if ($can_add_depth) {
        echo '<div class="buttons">';

        $options = array('frameworkid' => $framework->id);
        print_single_button($CFG->wwwroot.'/competencies/depthlevel.php', $options, get_string('adddepthlevel', 'competencies'), 'get');

        echo '</div>';
    }

    print_footer();
    exit();
}


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
/// Load competencies after any changes
///

// Get competencies for this page
$competencies = get_records('competency', 'frameworkid', $framework->id, 'sortorder');


///
/// Generate / display page
///
$str_edit         = get_string('edit');
$str_delete       = get_string('delete');
$str_moveup       = get_string('moveup');
$str_movedown     = get_string('movedown');
$str_hide         = get_string('hide');
$str_show         = get_string('show');
$str_customfields = get_string('customfields', 'customfields');

// Create display table
$table = new stdclass();
$table->class = 'generalbox editcompetencies';
$table->width = '95%';

// Setup column headers
$table->head = array();
$table->align = array();

foreach ($depths as $depth) {
    $header = $depth->fullname;

    if ($editingon && $can_edit_depth) {
        $header .= "<a href=\"{$CFG->wwwroot}/competencies/depthlevel.php?id={$depth->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a> ".
            "<a href=\"{$CFG->wwwroot}/competencies/depth/customfields/index.php?depth={$depth->id}\" title=\"$str_customfields\">".
            "<img src=\"{$CFG->pixpath}/t/customfields.gif\" class=\"iconsmall\" alt=\"$str_customfields\" /></a></a>";
    }

    $table->head[] = $header;
    $table->align[] = 'left';
}

$table->head[] = get_string('evidenceitems', 'competencies');
$table->align[] = 'center';

// If we have competencies, add edit col and rows of data
if ($competencies) {

    // Add edit column
    if ($editingon && $can_edit_comp) {
        $table->head[] = get_string('edit');
        $table->align[] = 'center';
    }

    // Add rows to table
    foreach ($competencies as $competency) {
        $row = array();

        $cssclass = !$competency->visible ? 'class="dimmed"' : '';

        foreach ($depths as $depth) {
            if ($depth->depthlevel == $competency->depthid) {
                $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/competencies/view.php?id={$competency->id}\">{$competency->fullname}</a>";
            } else {
                $row[] = '';
            }
        }

        // Evidence items
        $row[] = 0;

        // Add edit link
        $buttons = array();
        if ($editingon && $can_edit_comp) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/edit.php?id={$competency->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

            if ($competency->visible) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/index.php?hide={$competency->id}\" title=\"$str_hide\">".
                    "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
            } else {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/index.php?show={$competency->id}\" title=\"$str_show\">".
                    "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
            }
        }

        if ($editingon && $can_delete_comp) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/delete.php?id={$competency->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }

        // If competency not in the top depth, can move to another parent as same depth
        if (false) {
            $buttons[] = 'Move';
        }

        if ($buttons) {
            $row[] = implode($buttons, ' ');
        }

        $table->data[] = $row;
    }
} else {
    // If no competencies, add a message
    $table->data[] = array('<i>'.get_string('nocompetenciesinframework', 'competencies').'</i>');
}


// Display page
admin_externalpage_print_header();


// Show framework selector
$frameworks = get_records('competency_framework', 'visible', 1);

if (count($frameworks) > 1) {
    $fwoptions = array();

    foreach ($frameworks as $fw) {
        $fwoptions[$fw->id] = $fw->fullname;
    }

    echo '<div class="frameworkpicker">';
    popup_form($CFG->wwwroot.'/competencies/index.php?frameworkid=', $fwoptions, 'switchframework', $framework->id, '');
    echo '</div>';
}

#print_paging_bar($usercount, $page, $perpage,
#    "user.php?sort=$sort&amp;dir=$dir&amp;perpage=$perpage&amp;");
#
print_table($table);

#print_paging_bar($usercount, $page, $perpage,
#    "user.php?sort=$sort&amp;dir=$dir&amp;perpage=$perpage&amp;");


// Editing buttons
if ($can_add_comp || $can_add_depth) {
    echo '<div class="buttons">';

    // Print button for creating new competency
    if ($can_add_comp) {
        $options = array('frameworkid' => $framework->id);
        print_single_button($CFG->wwwroot.'/competencies/edit.php', $options, get_string('addnewcompetency', 'competencies'), 'get');
    }

    // Print button to add a depth level
    if ($can_add_depth) {
        $options = array('frameworkid' => $framework->id);
        print_single_button($CFG->wwwroot.'/competencies/depthlevel.php', $options, get_string('adddepthlevel', 'competencies'), 'get');
    }


    echo '</div>';
}

print_footer();
