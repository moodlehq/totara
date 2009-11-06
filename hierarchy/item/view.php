<?php

require_once('../../config.php');
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

// Use type file override if it exists
if (file_exists($CFG->dirroot.'/hierarchy/type/'.$type.'/item/view.php')) {
    include($CFG->dirroot.'/hierarchy/type/'.$type.'/item/view.php');
    die;
}

require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/lib.php');

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
    $navbaritem = '';
}

// Make this page appear under the manage items admin menu
admin_externalpage_setup($type.'manage', $navbaritem);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:view'.$type, $sitecontext);

// Cache user capabilities
$can_edit = has_capability('moodle/local:update'.$type, $sitecontext);


///
/// Display page
///

// Display page header
admin_externalpage_print_header();

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
<table class="generalbox view<?php echo $type ?>" cellpadding="5" cellspacing="1">
<tbody>
    <tr>
        <th class="header" width="200"><?php echo get_string('fullnameview', $type, $depthstr) ?></th>
        <td class="cell" width="400"><?php echo format_string($item->fullname) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('idnumberview', $type, $depthstr) ?></th>
        <td class="cell"><?php echo format_string($item->idnumber) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('descriptionview', $type, $depthstr) ?></th>
        <td class="cell"><?php echo format_text($item->description, FORMAT_HTML) ?></td>
    </tr>

<?php

$sql = "SELECT cdif.fullname, cdid.data
        FROM {$CFG->prefix}{$type}_depth_info_data cdid
        JOIN {$CFG->prefix}{$type}_depth_info_field cdif ON cdid.fieldid=cdif.id
        WHERE cdid.{$type}id={$item->id}";

if ($cfdata = get_records_sql($sql)) {
    foreach ($cfdata as $cf) {
        echo "
    <tr>
        <th class=\"header\">$cf->fullname</th>
        <td class=\"cell\">$cf->data</td>
    </tr>
";
    }
}

?>
</tbody>
</table>
<?php

echo '<div class="buttons">';

$options = array('type'=>$type,'frameworkid' => $framework->id);
print_single_button(
    $CFG->wwwroot.'/hierarchy/index.php',
    $options,
    get_string('returntoframework', $type),
    'get'
);

echo '</div>';

/// and proper footer
print_footer();
