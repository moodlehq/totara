<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

$id          = required_param('id', PARAM_INT);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

$hierarchy         = new competency();
$item              = $hierarchy->get_template($id);
$framework         = $hierarchy->get_framework($item->frameworkid);

// Get assigned competencies
$competencies = $hierarchy->get_assigned_to_template($id);

// Cache user capabilities
$can_edit   = has_capability('moodle/local:update'.$hierarchy->prefix.'template', $sitecontext);

if ($can_edit) {
    $options = array('id' => $item->id);
    $navbaritem = $hierarchy->get_editing_button($edit, $options);
    $editingon = !empty($USER->{$hierarchy->prefix.'editing'});
} else {
    $navbaritem = '';
}

// Make this page appear under the manage items admin menu
admin_externalpage_setup($hierarchy->prefix.'templatemanage', $navbaritem);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:view'.$hierarchy->prefix, $sitecontext);


///
/// Display page
///

// Run any hierarchy type specific code
$hierarchy->admin_page_setup($item, 'template/view');

/// Display page header
admin_externalpage_print_header();

$heading = "{$framework->fullname} - {$item->fullname}";

// If editing on, add edit icon
if ($editingon) {
    $str_edit = get_string('edit');
    $str_remove = get_string('remove');

    $heading .= " <a href=\"{$CFG->wwwroot}/hierarchy/type/{$hierarchy->prefix}/template/edit.php?id={$item->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
}

print_heading($heading);

$depthstr = get_string('template', $hierarchy->prefix);

?>
<table class="generalbox viewhierarchyitem" cellpadding="5" cellspacing="1">
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

///
/// Display assigned competencies
///
print_heading(get_string('assignedcompetencies', $hierarchy->prefix));

?>
<table width="95%" cellpadding="5" cellspacing="1" class="generalbox edit<?php echo $hierarchy->prefix ?> boxaligncenter">
<tr>
    <th style="vertical-align:top; text-align: left; white-space:nowrap;" class="header c0" scope="col">
        <?php echo get_string('depthlevel', $hierarchy->prefix); ?>
    </th>

    <th style="vertical-align:top; text-align: left; white-space:nowrap;" class="header c1" scope="col">
        <?php echo get_string('name'); ?>
    </th>

<?php
    if ($editingon) {
?>
    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c4" scope="col">
        <?php echo get_string('options', $hierarchy->prefix); ?>
    </th>
<?php
    }
?>
</tr>
<?php

if ($competencies) {

    foreach ($competencies as $competency) {

        echo '<tr>';
        echo '<td>'.$competency->depth.'</td>';
        echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$competency->id}\">{$competency->competency}</a></td>";

        if ($editingon) {
            echo "<td style=\"text-align: center;\">";

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/{$hierarchy->prefix}/template/remove_assignment.php?templateid={$item->id}&assignment={$competency->id}\" title=\"$str_remove\">".
    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

            echo "</td>";
        }

        echo '</tr>';
    }

} else {
    // # cols varies
    $cols = $editingon ? 3 : 2;
    echo '<tr class="noitems"><td colspan="'.$cols.'"><i>'.get_string('noassignedcompetencies', $hierarchy->prefix).'</i></td></tr>';
}

echo '</table>';


// Navigation / editing buttons
echo '<div class="buttons">';

// Display assign competency button
if ($can_edit) {

?>

<script type="text/javascript">
    <!-- //
    var <?php echo $hierarchy->prefix ?>_template_id = '<?php echo $item->id ?>';
    // -->
</script>

<div class="singlebutton">
<form action="<?php echo $CFG->wwwroot ?>/hierarchy/type/<?php echo $hierarchy->prefix ?>/template/assign_competency.php?templateid=<?php echo $item->id ?>" method="get">
<div>
<input type="submit" id="show-assignment-dialog" value="<?php echo get_string('assignnewcompetency', $hierarchy->prefix) ?>" />
</div>
</form>
</div>

<?php

}

// Return to template list
$options = array('frameworkid' => $framework->id);
print_single_button(
    $CFG->wwwroot.'/hierarchy/type/'.$hierarchy->prefix.'/template/index.php',
    $options,
    get_string('returntotemplates', $hierarchy->prefix),
    'get'
);

echo '</div>';

/// and proper footer
print_footer();
