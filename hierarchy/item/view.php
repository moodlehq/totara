<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');

// Get data
$type        = required_param('type', PARAM_SAFEDIR);
$id          = required_param('id', PARAM_INT);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

// Confirm the type exists
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    include($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
} else {
    error('Hierarchy type '.$type.' does not exist');
}



///
/// Setup / loading data
///

$hierarchy = new $type();
$item      = $hierarchy->get_item($id);
$depth     = $hierarchy->get_depth_by_id($item->depthid);
$framework = $hierarchy->get_framework($item->frameworkid);

// Cache user capabilities
$can_add_item    = has_capability('moodle/local:create'.$type, $sitecontext);
$can_edit_item   = has_capability('moodle/local:update'.$type, $sitecontext);
$can_delete_item = has_capability('moodle/local:delete'.$type, $sitecontext);
$can_add_depth   = has_capability('moodle/local:create'.$type.'depth', $sitecontext);
$can_edit_depth  = has_capability('moodle/local:update'.$type.'depth', $sitecontext);

if ($can_edit_item || $can_delete_item || $can_add_depth || $can_edit_depth) {
    $options = array('id' => $item->id);
    $navbaritem = $hierarchy->get_editing_button($edit, $options);
    $editingon = !empty($USER->{$type.'editing'});
} else {
    $editingon = false;
    $navbaritem = '';
}

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:view'.$type, $sitecontext);

// Cache user capabilities
$can_edit = has_capability('moodle/local:update'.$type, $sitecontext);


///
/// Display page
///

// Run any hierarchy type specific code
$hierarchy->hierarchy_page_setup('item/view');

// Display page header
$pagetitle = format_string($depth->fullname.' - '.$item->fullname);
$navlinks[] = array('name' => get_string('competency','competency'), 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $depth->fullname, 'link'=> '', 'type'=>'title');
$navlinks[] = array('name' => $item->fullname, 'link'=> '', 'type'=>'title');

$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, $navbaritem);


$heading = "{$depth->fullname} - {$item->fullname}";

// If editing on, add edit icon
if ($editingon) {
    $str_edit = get_string('edit');
    $str_remove = get_string('remove');

    $heading .= " <a href=\"{$CFG->wwwroot}/hierarchy/item/edit.php?type={$type}&frameworkid=$framework->id&id={$item->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
}

print_heading($heading);

$depthstr = $depth->fullname;

?>
<table class="generalbox viewhierarchyitem">
<tbody>
<?php

    // Related data
    $rdata = array('fullname', 'idnumber', 'description');

    foreach ($rdata as $datatype) {

        // Check if empty
        if (!strlen($item->$datatype)) {
            continue;
        }

        echo '<tr>';
        echo '<th class="header">'.get_string($datatype.'view', $type, $depthstr).'</th>';
        echo '<td class="cell">'.format_string($item->$datatype).'</td>';
        echo '</tr>'.PHP_EOL;
    }

    // Custom fields
    $sql = "SELECT cdif.fullname, cdid.data
            FROM {$CFG->prefix}{$type}_depth_info_data cdid
            JOIN {$CFG->prefix}{$type}_depth_info_field cdif ON cdid.fieldid=cdif.id
            WHERE cdid.{$type}id={$item->id}";

    if ($cfdata = get_records_sql($sql)) {

        // Loop through
        foreach ($cfdata as $cf) {

            if (!strlen($cf->data)) {
                continue;
            }

            echo '<tr>';
            echo '<th class="header">'.format_string($cf->fullname).'</th>';
            echo '<td class="cell">'.format_string($cf->data).'</td>';
            echo '</tr>'.PHP_EOL;
        }
    }

?>
</tbody>
</table>
<?php

// Print extra info
$hierarchy->display_extra_view_info($item);

if($can_edit) {
    echo '<div class="buttons">';

    $options = array('type'=>$type,'frameworkid' => $framework->id);
    print_single_button(
        $CFG->wwwroot.'/hierarchy/index.php',
        $options,
        get_string('returntoframework', $type),
        'get'
    );

    echo '</div>';
}
/// and proper footer
print_footer();
