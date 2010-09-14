<?php
require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/customfield/indexlib.php');

///
/// Setup / loading data
///

$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Get params
$type        = optional_param('type', -1, PARAM_SAFEDIR);
$frameworkid = optional_param('frameworkid', -1, PARAM_SAFEDIR);
$depthid     = optional_param('depthid', 0, PARAM_SAFEDIR);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$action      = optional_param('action', '', PARAM_ALPHA);    // param for some action

if($type == 'course') {
    $tableprefix = 'course';
    $adminpagename = 'coursecustomfields';
    $strcustomfields = get_string('customfields', 'customfields');
} else {
    $shortprefix = hierarchy::get_short_prefix($type);
    $tableprefix = "{$shortprefix}_depth";

    if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
        require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
        $hierarchy = new $type();
        $depth = $hierarchy->get_depth_by_id($depthid);
        $framework = $hierarchy->get_framework($frameworkid);
    } else {
        // don't error, just echo!
        error('error:depthnotfound', 'hierarchy', $type);
    }
    $adminpagename = $type.'frameworkmanage';
    $strcustomfields = get_string("{$type}customfields", $type);
}

// Cache user capabilities
$can_add = has_capability('moodle/local:create'.$type.'customfield', $sitecontext);
$can_edit = has_capability('moodle/local:update'.$type.'customfield', $sitecontext);
$can_delete = has_capability('moodle/local:delete'.$type.'customfield', $sitecontext);

if ($can_add || $can_edit || $can_delete) {
    if($type == 'course') {
        $navbaritem = get_course_editing_button($edit);
        $editingon = !empty($USER->courseediting);
    } else {
        $navbaritem = $hierarchy->get_editing_button($edit, array('depthid'=>$depthid, 'frameworkid'=>$frameworkid));
        $editingon = !empty($USER->{$type.'editing'});
    }
} else {
    $navbaritem = '';
    $editingon = false;
}

// Setup page and check permissions
admin_externalpage_setup($adminpagename, $navbaritem, array('type'=>$type));

///
/// Perform actions first
///
switch ($action) {
    case 'deletecategory':
        require_capability('moodle/local:delete'.$type.'customfield', $sitecontext);
        $id      = required_param('categoryid', PARAM_INT);
        $confirm = optional_param('confirm', 0, PARAM_BOOL);

        if (data_submitted() and $confirm and confirm_sesskey()) {
            customfield_delete_category($id, $depthid, $tableprefix);
        }
        break;
    default:
}

///
/// Load data for depth details
///

if($type == 'course') {
    $categories = get_course_custom_field_categories();
} else {
    // Get depths for this page
    $categories = $hierarchy->get_custom_field_categories($depthid);
}

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
    $table->head = array(get_string('name'), $strcustomfields);
    $table->align = array('left', 'center');

    // Add edit column
    if ($editingon && $can_edit) {
        $table->head[] = get_string('edit');
        $table->align[] = 'left';
    }

    if($type == 'course') {
        $urlparams = "type={$type}";
    } else {
        $urlparams = "type={$type}&subtype=depth&frameworkid={$framework->id}&depthid={$depth->id}";
    }

    // Add rows to table
    $rowcount = 1;
    foreach ($categories as $category) {
        $row = array();

        $cssclass = '';

        $row[] = "<a $cssclass href=\"{$CFG->wwwroot}/customfield/index.php?{$urlparams}&amp;categoryid={$category->id}\">{$category->name}</a>";
        $row[] = $category->custom_field_count;

        // Add edit link
        $buttons = array();
        if ($editingon && $can_edit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/customfield/index.php?{$urlparams}&categoryid={$category->id}&action=editcategory\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
        }
        if ($editingon && $can_delete) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/customfield/index.php?{$urlparams}&categoryid={$category->id}&action=deletecategory\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
        }
        if ($buttons) {
            $row[] = implode($buttons, ' ');
        }

        $table->data[] = $row;
    }
}

if($type == 'course') {
    admin_externalpage_print_header();

} else {
    // Display page
    $navlinks = array();    // Breadcrumbs
    $navlinks[] = array('name'=>get_string("{$type}frameworks", $type),
                        'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$type}",
                        'type'=>'misc');    // Framework List
    $navlinks[] = array('name'=>format_string($framework->fullname),
                        'link'=>"{$CFG->wwwroot}/hierarchy/framework/view.php?type={$type}&frameworkid={$framework->id}",
                        'type'=>'misc');    // Framework View
    $navlinks[] = array('name'=>format_string($depth->fullname),
                        'link'=>'',
                        'type'=>'misc');    // Current page

    admin_externalpage_print_header('', $navlinks);

    print_heading($depth->fullname, 'left', 1);
    echo "<p>{$depth->description}</p>";
}

// Display Depths
print_heading(get_string('customfieldcategories', 'customfields'));
if ($categories) {
    print_table($table);
} else {
    echo '<p>'.get_string('nocustomfieldcategoriesdefined', 'customfields').'</p>';
}
// Depth Add button
if ($can_add) {
    echo '<div class="buttons">';

    $data = array('type' => $type, 'categoryid' => 0, 'action' => 'editcategory');
    if($type != 'course') {
        $data['subtype'] = 'depth';
        $data['frameworkid'] = $frameworkid;
        $data['depthid'] = $depthid;
    }
    // Print button for creating new custom field
    print_single_button($CFG->wwwroot.'/customfield/index.php',
        $data,
        get_string('createcustomfieldcategory', 'customfields'), 'get');

    echo '</div>';
}

print_footer();
