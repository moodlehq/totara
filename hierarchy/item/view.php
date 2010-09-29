<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');
require($CFG->libdir.'/filelib.php');

// Get data
$type        = required_param('type', PARAM_SAFEDIR);
$id          = required_param('id', PARAM_INT);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
$shortprefix = hierarchy::get_short_prefix($type);

// Confirm the type exists
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php')) {
    require_once($CFG->dirroot.'/hierarchy/type/'.$type.'/lib.php');
} else {
    error('Hierarchy type '.$type.' does not exist');
}

///
/// Setup / loading data
///

$hierarchy = new $type();
if(!$item = $hierarchy->get_item($id)){
    error('This ' . $type . ' item does not exist');
}
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
if ($editingon) {
    $compfw = optional_param('framework', get_field_sql("SELECT id FROM {$CFG->prefix}comp_framework WHERE visible=1 ORDER BY sortorder ASC"), PARAM_INT);
    $setupitem = new stdClass;
    $setupitem->id = $item->id;
    $setupitem->frameworkid = $compfw;

    $hierarchy->hierarchy_page_setup('item/view', $setupitem);

    unset($setupitem);
}

// Display page header
$pagetitle = format_string($depth->fullname.' - '.$item->fullname);
$navlinks[] = array('name' => get_string('manage'.$type,$type), 'link'=> $CFG->wwwroot.'/hierarchy/index.php?type='.$type.'&frameworkid='.$framework->id, 'type'=>'title');
$navlinks[] = array('name' => $item->shortname, 'link'=> '', 'type'=>'title');

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

?>
<table class="generalbox viewhierarchyitem">
<tbody>
<?php

    // Related data
    $data = $hierarchy->get_item_data($item);

    // Custom fields
    $sql = "SELECT cdif.fullname, cdid.data, cdif.datatype
            FROM {$CFG->prefix}{$shortprefix}_depth_info_data cdid
            JOIN {$CFG->prefix}{$shortprefix}_depth_info_field cdif ON cdid.fieldid=cdif.id
            WHERE cdid.{$type}id={$item->id}";

    if ($cfdata = get_records_sql($sql)) {
        $strfile = get_string('file');
        foreach ($cfdata as $cf) {
            if($cf->datatype == 'file' && !empty($cf->data)){
                $icon = mimeinfo("icon", $cf->data);
                $data[] = array(
                    'title' => $cf->fullname,
                    'value' => "<a href=\"{$CFG->wwwroot}/file.php/1/{$cf->data}\"/><img src=\"{$CFG->pixpath}/f/{$icon}\" class=\"icon\" alt=\"{$strfile}\" />{$cf->data}</a>"
                );
            }
            else{
                $data[] = array(
                    'title' => $cf->fullname,
                    'value' => $cf->data
                );
            }
        }
    }

    $oddeven = 1;

    foreach ($data as $ditem) {

        // Check if empty
        if (!strlen($ditem['value'])) {
            continue;
        }

        $oddeven = ++$oddeven % 2;

        echo '<tr class="r'.$oddeven.'">';
        echo '<th class="header">'.format_string($ditem['title']).'</th>';
        echo '<td class="cell">'.$ditem['value'].'</td>';
        echo '</tr>'.PHP_EOL;
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
