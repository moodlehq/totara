<?php
    require_once('../config.php');
    require_once($CFG->libdir.'/adminlib.php');
    require_once($CFG->dirroot.'/hierarchy/lib.php');

    ///
    /// Setup / loading data
    ///

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    // Get params
    $type        = optional_param('type', -1, PARAM_SAFEDIR);
    //$frameworkid = optional_param('frameworkid', -1, PARAM_SAFEDIR);
    $depthid     = optional_param('depthid', -1, PARAM_SAFEDIR);
    $edit        = optional_param('edit', -1, PARAM_BOOL);

    if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
        require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
        $hierarchy = new $type();
        $depth = $hierarchy->get_depth_by_id($depthid);
    } else {
        // don't error, just echo!
        error('error:depthnotfound', 'hierarchy', $type);
    }

    // Cache user capabilities  //TODO: use right capabilities!!!
    $can_add = has_capability('moodle/local:create'.$type.'frameworks', $sitecontext);
    $can_edit = has_capability('moodle/local:update'.$type.'frameworks', $sitecontext);
    $can_delete = has_capability('moodle/local:delete'.$type.'frameworks', $sitecontext);

    if ($can_add || $can_edit || $can_delete) {
        $navbaritem = $hierarchy->get_editing_button($edit, array('depthid'=>$depthid));
        $editingon = !empty($USER->{$type.'editing'});
    } else {
        $navbaritem = '';
        $editingon = false;
    }

    // Setup page and check permissions
    admin_externalpage_setup($type.'frameworkmanage', $navbaritem, array('type'=>$type));  //TODO: fix

///
/// Load data for depth details
///

// Get depths for this page
$categories = $hierarchy->get_custom_field_categories($depthid);

///
/// Generate / display page
///
$str_edit     = get_string('edit');
$str_delete   = get_string('delete');


if ($categories) {
    // Create display table
    $table = new stdclass();
    $table->class = 'generaltable edit'.$type;
    $table->width = '95%';

    // Setup column headers
    $table->head = array(get_string('name', $type), get_string('competencycustomfields', $type));
    $table->align = array('left', 'center');

    // Add edit column
    if ($editingon && $can_edit) {
        $table->head[] = get_string('edit');
        $table->align[] = 'left';
    }

    // Add rows to table
    $rowcount = 1;
    foreach ($categories as $category) {
        $row = array();

        $cssclass = '';

        $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/customfield/index.php?type={$type}&subtype=depth&depthid={$depth->id}&categoryid={$category->id}\">{$category->name}</a>";
        $row[] = $category->custom_field_count;

        // Add edit link
        $buttons = array();
        if ($editingon && $can_edit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/customfield/index.php?type={$type}&subtype=depth&id={$category->id}&depthid={$depthid}&action=editcategory\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
        }
        if ($editingon && $can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/customfield/index.php?type={$type}&subtype=depth&id={$category->id}&depthid={$depthid}&action=deletecategory\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }
        if ($buttons) {
            $row[] = implode($buttons, ' ');
        }

        $table->data[] = $row;
    }
} else {
    echo "<p>No custom field categories found</p>";
}

// Display page
admin_externalpage_print_header();

print_heading($depth->fullname, 'left', 1);
echo "<p>{$depth->description}</p>";

// Display Depths
print_heading(get_string('customfieldcategories', 'customfields'));
if ($categories) {
    print_table($table);
} else {
    print_heading(get_string('noframeworks', $type)); //TODO: fix
}
// Depth Add button
if ($can_add) {
    echo '<div class="buttons">';

    // Print button for creating new framework
    print_single_button($CFG->wwwroot.'/customfield/index.php', 
        array('type'=>$type, 'subtype'=>'depth', 'depthid'=>$depthid, 'action'=>'editcategory'), 
        get_string('createcustomfieldcategory', 'customfields'), 'get');

    echo '</div>';
}

print_footer();
