<?php
require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/hierarchylib.php');
require_once($CFG->dirroot.'/competency/evidence/type/abstract.php');
require_once($CFG->dirroot.'/local/js/setup.php');


///
/// Setup / loading data
///

$id          = required_param('id', PARAM_INT);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

$hierarchy         = new hierarchy();
$hierarchy->prefix = 'competency';
$item              = $hierarchy->get_item($id);
$depth             = $hierarchy->get_depth_by_id($item->depthid);
$framework         = $hierarchy->get_framework($item->frameworkid);

// Load evidence items
$evidence = get_records('competency_evidence_items', 'competencyid', $item->id);


// Cache user capabilities
$can_add_item    = has_capability('moodle/local:create'.$hierarchy->prefix, $sitecontext);
$can_edit_item   = has_capability('moodle/local:update'.$hierarchy->prefix, $sitecontext);
$can_delete_item = has_capability('moodle/local:delete'.$hierarchy->prefix, $sitecontext);
$can_add_depth   = has_capability('moodle/local:create'.$hierarchy->prefix.'depth', $sitecontext);
$can_edit_depth  = has_capability('moodle/local:update'.$hierarchy->prefix.'depth', $sitecontext);

if ($can_edit_item || $can_delete_item || $can_add_depth || $can_edit_depth) {
    $options = array('id' => $item->id);
    $navbaritem = $hierarchy->get_editing_button($edit, $options);
    $editingon = !empty($USER->{$hierarchy->prefix.'editing'});
} else {
    $navbaritem = '';
}

// Make this page appear under the manage items admin menu
admin_externalpage_setup($hierarchy->prefix.'manage', $navbaritem);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:view'.$hierarchy->prefix, $sitecontext);

// Cache user capabilities
$can_edit = has_capability('moodle/local:update'.$hierarchy->prefix, $sitecontext);


///
/// Display page
///

setup_lightbox(array(MBE_JS_TREEVIEW));

require_js(array(
    $CFG->wwwroot.'/local/js/competency.evidence.js',
));

// Display page header
admin_externalpage_print_header();


$heading = "{$depth->fullname} - {$item->fullname}";

// If editing on, add edit icon
if ($editingon) {
    $str_edit = get_string('edit');
    $str_remove = get_string('remove');

    $heading .= " <a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/edit.php?id={$item->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
}

print_heading($heading);

$depthstr = $depth->fullname;

?>
<table class="generalbox view<?php echo $hierarchy->prefix ?>" cellpadding="5" cellspacing="1">
<tbody>
    <tr>
        <th class="header" width="200"><?php echo get_string('fullnameview', $hierarchy->prefix, $depthstr) ?></th>
        <td class="cell" width="400"><?php echo format_string($item->fullname) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('idnumberview', $hierarchy->prefix, $depthstr) ?></th>
        <td class="cell"><?php echo format_string($item->idnumber) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('descriptionview', $hierarchy->prefix, $depthstr) ?></th>
        <td class="cell"><?php echo format_text($item->description, FORMAT_HTML) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('aggregationmethodview', $hierarchy->prefix, $depthstr) ?></th>
        <td class="cell"><?php echo get_string('aggregationmethod'.$item->aggregationmethod, $hierarchy->prefix) ?></td>
    </tr>

<?php

$sql = "SELECT cdif.fullname, cdid.data
        FROM {$CFG->prefix}{$hierarchy->prefix}_depth_info_data cdid
        JOIN {$CFG->prefix}{$hierarchy->prefix}_depth_info_field cdif ON cdid.fieldid=cdif.id
        WHERE cdid.{$hierarchy->prefix}id={$item->id}";

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

// Display evidence items
print_heading(get_string('evidenceitems', $hierarchy->prefix));

?>
<table width="95%" cellpadding="5" cellspacing="1" class="generalbox edit<?php echo $hierarchy->prefix ?> boxaligncenter">
<tr>
    <th style="vertical-align:top; text-align: left; white-space:nowrap;" class="header c0" scope="col">
        <?php echo get_string('name'); ?>
    </th>

    <th style="vertical-align:top; text-align: left; white-space:nowrap;" class="header c1" scope="col">
        <?php echo get_string('type', $hierarchy->prefix); ?>
    </th>

    <th style="vertical-align:top; text-align:left; white-space:nowrap;" class="header c2" scope="col">
        <?php echo get_string('activity'); ?>
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

    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c5" scope="col">
        <?php echo get_string('achieved', $hierarchy->prefix); ?>
    </th>
</tr>
<?php

if ($evidence) {

    foreach ($evidence as $eitem) {

        $eitem = competency_evidence_type::factory($eitem);

        echo '<tr>';
        echo '<td>'.$eitem->get_name().'</td>';
        echo '<td>'.$eitem->get_type().'</td>';
        echo '<td>'.$eitem->get_activity_type().'</td>';

        if ($editingon) {
            echo "<td style=\"text-align: center;\">";

            echo "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/evidence/remove.php?id={$eitem->id}\" title=\"$str_remove\">".
                 "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
            
            echo "</td>";
        }

        echo '<td style="text-align: center">0</td>';
        echo '</tr>';
    }

} else {
    // # cols varies
    $cols = $editingon ? 5 : 4;
    echo '<tr class="noevidenceitems"><td colspan="'.$cols.'"><i>'.get_string('noevidenceitems', $hierarchy->prefix).'</i></td></tr>';
}

echo '</table>';


// Navigation / editing buttons
echo '<div class="buttons">';

// Display add evidence item button
if ($can_edit) {

?>

<script type="text/javascript">
    <!-- //
    var <?php echo $hierarchy->prefix ?>_id = '<?php echo $item->id ?>';
    // -->
</script>

<div class="singlebutton">
<form action="<?php echo $CFG->wwwroot ?>/<?php $hierarchy->prefix ?>/evidence/edit.php" method="get">
<div>
<input type="hidden" name="<?php echo $hierarchy->prefix ?>" value="<?php echo $item->id ?>" />
<input type="submit" id="show-evidence-dialog" value="<?php echo get_string('assignnewevidenceitem', $hierarchy->prefix) ?>" />
</div>
</form>
</div>

<?php

}

$options = array('frameworkid' => $framework->id);
print_single_button(
    $CFG->wwwroot.'/'.$hierarchy->prefix.'/index.php',
    $options,
    get_string('returntoframework', $hierarchy->prefix),
    'get'
);

echo '</div>';

/// and proper footer
print_footer();
