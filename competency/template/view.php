<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competency/lib.php');

///
/// Setup / loading data
///

$id          = required_param('id', PARAM_INT);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

$hierarchy         = new competency();
$item              = $hierarchy->get_template($id);
$framework         = $hierarchy->get_framework($item->frameworkid);

// Cache user capabilities
$can_edit_item   = has_capability('moodle/local:update'.$hierarchy->prefix.'template', $sitecontext);

if ($can_edit_item) {
    $options = array('id' => $item->id);
    $navbaritem = $hierarchy->get_editing_button($edit, $options);
    $editingon = !empty($USER->{$hierarchy->prefix.'editing'});
} else {
    $navbaritem = '';
}

// Load required javascript libraries
require_js(
    array(
        $CFG->wwwroot.'/local/js/jquery-1.3.2.min.js',
        'yui_yahoo',
        'yui_dom',
        'yui_event',
        'yui_element',
        'yui_animation',
        'yui_connection',
        'yui_container',
        'yui_json',
    )
);

// Make this page appear under the manage items admin menu
admin_externalpage_setup($hierarchy->prefix.'templatemanage', $navbaritem);

?>
    <link rel="stylesheet" href="<?php echo $CFG->wwwroot ?>/local/js/jquery.treeview.css" type="text/css" />
<?php

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:view'.$hierarchy->prefix, $sitecontext);


///
/// Display page
///

/// Display page header
admin_externalpage_print_header();

$heading = "{$framework->fullname} - {$item->fullname}";

// If editing on, add edit icon
if ($editingon) {
    $str_edit = get_string('edit');
    $str_delete = get_string('delete');

    $heading .= " <a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/template/edit.php?id={$item->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
}

print_heading($heading);

$depthstr = get_string('template', $hierarchy->prefix);

?>
<table class="generalbox view<?php echo $hierarchy->prefix ?>" cellpadding="5" cellspacing="1">
<tbody>
    <tr>
        <th class="header" width="200"><?php echo get_string('fullnameview', $hierarchy->prefix, $depthstr) ?></th>
        <td class="cell" width="400"><?php echo format_string($item->fullname) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('descriptionview', $hierarchy->prefix, $depthstr) ?></th>
        <td class="cell"><?php echo format_text($item->description, FORMAT_HTML) ?></td>
    </tr>
</tbody>
</table>

<?php

// Navigation / editing buttons
echo '<div class="buttons">';

$options = array('frameworkid' => $framework->id);
print_single_button(
    $CFG->wwwroot.'/'.$hierarchy->prefix.'/template/index.php',
    $options,
    get_string('returntotemplates', $hierarchy->prefix),
    'get'
);

echo '</div>';

/// and proper footer
print_footer();
