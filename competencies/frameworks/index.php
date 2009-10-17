<?php

    require_once('../../config.php');
    require_once('../lib.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->libdir.'/hierarchylib.php');

    ///
    /// Setup / loading data
    ///

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    // Get params
    $edit        = optional_param('edit', -1, PARAM_BOOL);
    $hide        = optional_param('hide', 0, PARAM_INT);
    $show        = optional_param('show', 0, PARAM_INT);
    $moveup      = optional_param('moveup', 0, PARAM_INT);
    $movedown    = optional_param('movedown', 0, PARAM_INT);

    // Cache user capabilities
    $can_add = has_capability('moodle/local:createcompetencyframeworks', $sitecontext);
    $can_edit = has_capability('moodle/local:updatecompetencyframeworks', $sitecontext);
    $can_delete = has_capability('moodle/local:deletecompetencyframeworks', $sitecontext);

    $hierarchy         = new hierarchy();
    $hierarchy->prefix = 'competency';

    if ($can_add || $can_edit || $can_delete) {
        $navbaritem = $hierarchy->get_editing_button($edit);
        $editingon = !empty($USER->{$hierarchy->prefix.'editing'});
    } else {
        $navbaritem = '';
    }

    // Setup page and check permissions
    admin_externalpage_setup($hierarchy->prefix.'frameworkmanage', $navbaritem);

    ///
    /// Process any actions
    ///

    if ($editingon) {
        // Hide or show a framework
        if ($hide or $show or $moveup or $movedown) {
            require_capability('moodle/local:updatecompetencies', $sitecontext);
            // Hide an item
            if ($hide) {
                $hierarchy->hide_framework($hide);
            } elseif ($show) {
                $hierarchy->show_framework($show);
            } elseif ($moveup) {
                $hierarchy->move_framework($moveup, true);
            } elseif ($movedown) {
                $hierarchy->move_framework($movedown, false);
            }
        }

    } // End of editing stuff

///
/// Load hierarchy frameworks after any changes
///

// Get frameworks for this page
$frameworks = $hierarchy->get_frameworks();

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
    $rowcount = 1;
    foreach ($frameworks as $framework) {
        $row = array();

        $cssclass = !$framework->visible ? 'class="dimmed"' : '';

        $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/competencies/index.php?frameworkid={$framework->id}\">{$framework->fullname}</a>";

        // Add edit link
        $buttons = array();
        if ($editingon && $can_edit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/frameworks/edit.php?id={$framework->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
            if ($framework->visible) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/frameworks/index.php?hide={$framework->id}\" title=\"$str_hide\">".
                    "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
            } else {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/frameworks/index.php?show={$framework->id}\" title=\"$str_show\">".
                    "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
            }
        }
        if ($editingon && $can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/frameworks/delete.php?id={$framework->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }
        if ($editingon && $can_edit) {
            if ($rowcount != 1) {
                $buttons[] = "<a href=\"index.php?moveup={$framework->id}\" title=\"$str_moveup\">".
                   "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a> ";
            }
            if ($rowcount != count($frameworks)) {
                $buttons[] = "<a href=\"index.php?movedown={$framework->id}\" title=\"$str_movedown\">".
                    "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
            }
            $rowcount++;
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

    // Print button for creating new framework
    print_single_button($CFG->wwwroot.'/competencies/frameworks/edit.php', array(), get_string('addnewframework', 'competencies'), 'get');

    echo '</div>';
}

print_footer();
