<?php

    require_once('../../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/hierarchy/lib.php');

    hierarchy::support_old_url_syntax();

    ///
    /// Setup / loading data
    ///

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    // Get params
    $prefix        = required_param('prefix', PARAM_ALPHA);
    $edit        = optional_param('edit', -1, PARAM_BOOL);
    $hide        = optional_param('hide', 0, PARAM_INT);
    $show        = optional_param('show', 0, PARAM_INT);
    $moveup      = optional_param('moveup', 0, PARAM_INT);
    $movedown    = optional_param('movedown', 0, PARAM_INT);

    $hierarchy = hierarchy::load_hierarchy($prefix);

    // Cache user capabilities
    $can_add = has_capability('moodle/local:create'.$prefix.'frameworks', $sitecontext);
    $can_edit = has_capability('moodle/local:update'.$prefix.'frameworks', $sitecontext);
    $can_delete = has_capability('moodle/local:delete'.$prefix.'frameworks', $sitecontext);

    // Setup page and check permissions
    admin_externalpage_setup($prefix.'manage', '', array('prefix'=>$prefix));

    ///
    /// Process any actions
    ///

    if ($can_edit) {
        // Hide or show a framework
        if ($hide or $show or $moveup or $movedown) {
            require_capability('moodle/local:update'.$prefix.'frameworks', $sitecontext);
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
$frameworks = $hierarchy->get_frameworks(array('item_count'=>1));

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
    $table->class = 'generaltable edit'.$prefix;

    // Setup column headers
    $table->head = array(get_string('name', $prefix), get_string($prefix.'plural', $prefix));

    // Add edit column
    if ($can_edit || $can_delete) {
        $table->head[] = get_string('actions');
    }

    // Add rows to table
    $rowcount = 1;
    foreach ($frameworks as $framework) {
        $row = array();

        $cssclass = !$framework->visible ? 'class="dimmed"' : '';
        $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/hierarchy/index.php?prefix={$prefix}&amp;frameworkid={$framework->id}\">{$framework->fullname}</a>";
        $row[] = "<span {$cssclass}>{$framework->item_count}</span>";

        // Add edit link
        $buttons = array();
        if ($can_edit || $can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/framework/edit.php?prefix={$prefix}&id={$framework->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
            if ($framework->visible) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}&hide={$framework->id}\" title=\"$str_hide\">".
                    "<img src=\"{$CFG->pixpath}/t/hide.gif\" class=\"iconsmall\" alt=\"$str_hide\" /></a>";
            } else {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/framework/index.php?prefix={$prefix}&show={$framework->id}\" title=\"$str_show\">".
                    "<img src=\"{$CFG->pixpath}/t/show.gif\" class=\"iconsmall\" alt=\"$str_show\" /></a>";
            }
        }
        if ($can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/framework/delete.php?prefix={$prefix}&id={$framework->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }
        if ($can_edit) {
            if ($rowcount != 1) {
                $buttons[] = "<a href=\"index.php?prefix={$prefix}&moveup={$framework->id}\" title=\"$str_moveup\">".
                   "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a> ";
            } else {
                $buttons[] = "<img src=\"{$CFG->pixpath}/spacer.gif\"  class=\"iconsmall\"  alt=\"\" /> ";
            }
            if ($rowcount != count($frameworks)) {
                $buttons[] = "<a href=\"index.php?prefix={$prefix}&movedown={$framework->id}\" title=\"$str_movedown\">".
                    "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
            } else {
                $buttons[] = "<img src=\"{$CFG->pixpath}/spacer.gif\"  class=\"iconsmall\"  alt=\"\" /> ";
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

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$prefix}frameworks", $prefix), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

print_heading(get_string($prefix.'frameworks', $prefix) . ' ' . helpbutton($prefix.'frameworks', get_string($prefix.'framework', $prefix), 'moodle', true, false, '', true), 'left', 1);

// Editing buttons
if ($can_add) {
    echo '<div class="hierarchy-index-buttons">';

    // Print button for creating new framework
    print_single_button($CFG->wwwroot.'/hierarchy/framework/edit.php?prefix='.$prefix, array('prefix'=>$prefix), get_string('addnewframework', $prefix), 'get');

    echo '</div>';
}



if ($frameworks) {
    print_table($table);
} else {
    echo '<p>'.get_string('noframeworks', $prefix).'</p><br>';
}


// Display scales
if (file_exists($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/scale/lib.php')) {
    include($CFG->dirroot.'/hierarchy/prefix/'.$prefix.'/scale/lib.php');
    $scales = $hierarchy->get_scales();
    call_user_func("{$prefix}_scale_display_table", $scales, $can_edit);
}
add_to_log(SITEID, $prefix, 'view framework', "framework/index.php?prefix={$prefix}", '');
print_footer();
