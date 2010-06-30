<?php
    require_once('../../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/hierarchy/lib.php');

    ///
    /// Setup / loading data
    ///

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    // Get params
    $type        = optional_param('type', -1, PARAM_SAFEDIR);
    $frameworkid = optional_param('frameworkid', -1, PARAM_SAFEDIR);
    $edit        = optional_param('edit', -1, PARAM_BOOL);

    if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
        require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
        $hierarchy = new $type();
        $framework = $hierarchy->get_framework($frameworkid);
    } else {
        error('error:depthnotfound', 'hierarchy', $type);
    }

    // Cache user capabilities
    $can_add = has_capability('moodle/local:create'.$type.'frameworks', $sitecontext);
    $can_edit = has_capability('moodle/local:update'.$type.'frameworks', $sitecontext);
    $can_delete = has_capability('moodle/local:delete'.$type.'frameworks', $sitecontext);

    if ($can_add || $can_edit || $can_delete) {
        $navbaritem = $hierarchy->get_editing_button($edit, array('frameworkid'=>$frameworkid));
        $editingon = !empty($USER->{$type.'editing'});
    } else {
        $navbaritem = '';
        $editingon = false;
    }

    // Setup page and check permissions
    admin_externalpage_setup($type.'frameworkmanage', $navbaritem, array('type'=>$type));

///
/// Load data for depth details
///

// Get depths for this page
$depths = $hierarchy->get_depths(array('custom_field_count' => 1, 'item_count'=>1));
///
/// Generate / display page
///
$str_edit     = get_string('edit');
$str_delete   = get_string('delete');


if ($depths) {
    // Create display table
    $table = new stdclass();
    $table->class = 'generaltable edit'.$type;
    $table->width = '95%';

    // Setup column headers
    $table->head = array(get_string('name', $type),
        get_string($type . 'plural', $type),
        get_string("{$type}customfields", $type));
    $table->align = array('left', 'center');

    // Add edit column
    if ($editingon && $can_edit) {
        $table->head[] = get_string('edit');
        $table->align[] = 'left';
    }

    // Add rows to table
    $rowcount = 1;
    foreach ($depths as $depth) {
        $row = array();

        $cssclass = '';

        $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/customfield/custom_field_categories.php?type={$type}&frameworkid={$framework->id}&depthid={$depth->id}\">{$depth->fullname}</a>";
        $row[] = $depth->item_count;
        $row[] = $depth->custom_field_count;

        // Add edit link
        $buttons = array();
        if ($editingon && $can_edit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/depth/edit.php?type={$type}&frameworkid={$frameworkid}&id={$depth->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
        }
        if ($editingon && $can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/depth/delete.php?type={$type}&frameworkid={$frameworkid}&id={$depth->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }
        if ($buttons) {
            $row[] = implode($buttons, ' ');
        }

        $table->data[] = $row;
    }
}

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("{$type}frameworks", $type), 
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}", 
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($framework->fullname), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

print_heading($framework->fullname, 'left', 1);
echo "<p>{$framework->description}</p>";

// Display Depths
print_heading(get_string('depthlevels', $type));
if ($depths) {
    print_table($table);
} else {
    echo "<p>".get_string('nodepthlevels', $type)."</p>";
}
// Depth Add button
if ($can_add) {
    echo '<div class="buttons">';

    // Print button for creating new framework
    print_single_button($CFG->wwwroot.'/hierarchy/depth/edit.php', array('type'=>$type, 'frameworkid'=>$frameworkid, 'spage'=>0), get_string('adddepthlevel', $type), 'get');

    echo '</div>';
}

// Display templates
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/template/lib.php')) {
    include($CFG->dirroot.'/hierarchy/type/'.$type.'/template/lib.php');
    $templates = $hierarchy->get_templates();
    
    call_user_func("{$type}_template_display_table", $templates, $frameworkid);
} 

print_footer();
