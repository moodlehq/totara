<?php

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/hierarchylib.php');

///
/// Setup / loading data
///

// competency id
$id          = required_param('id', PARAM_INT);
$edit        = optional_param('edit', -1, PARAM_BOOL);
$sitecontext = get_context_instance(CONTEXT_SYSTEM);

$hierarchy         = new hierarchy();
$hierarchy->prefix = 'competency';
$item              = $hierarchy->get_item_by_id($id);
$depth             = $hierarchy->get_depth_by_id($item->depthid);
$framework         = $hierarchy->get_framework($item->frameworkid);

// Cache user capabilities
$can_add_item    = has_capability('moodle/local:createcompetencies', $sitecontext);
$can_edit_item   = has_capability('moodle/local:updatecompetencies', $sitecontext);
$can_delete_item = has_capability('moodle/local:deletecompetencies', $sitecontext);
$can_add_depth   = has_capability('moodle/local:createcompetencydepth', $sitecontext);
$can_edit_depth  = has_capability('moodle/local:updatecompetencydepth', $sitecontext);

if ($can_edit_item || $can_delete_item || $can_add_depth || $can_edit_depth) {
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

?>
    <link rel="stylesheet" href="<?php echo $CFG->wwwroot ?>/local/js/jquery.treeview.css" type="text/css" />
<?php

// Make this page appear under the manage items admin menu
admin_externalpage_setup($hierarchy->prefix.'manage', $navbaritem);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:viewcompetencies', $sitecontext);

// Cache user capabilities
$can_edit_comp = has_capability('moodle/local:updatecompetencies', $sitecontext);


///
/// Display page
///

/// Display page header
admin_externalpage_print_header();

// Make sure page specific javascript is loaded
$js = array(
    $CFG->wwwroot.'/local/js/jquery.treeview.min.js',
    $CFG->wwwroot.'/local/js/competencies.js',
    $CFG->wwwroot.'/local/js/evidence.js',
);
require_js($js);

$heading = "{$depth->fullname} - {$item->fullname}";

// If editing on, add edit icon
if ($editingon) {
    $str_edit = get_string('edit');
    $heading .= " <a href=\"{$CFG->wwwroot}/competencies/edit.php?id={$item->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
}

print_heading($heading);

$depthstr = $depth->fullname;

?>
<table class="generalbox view<?php echo $hierarchy->prefix ?>" cellpadding="5" cellspacing="1">
<tbody>
    <tr>
        <th class="header" width="200"><?php echo get_string('fullnameview', 'competencies', $depthstr) ?></th>
        <td class="cell" width="400"><?php echo format_string($item->fullname) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('idnumberview', 'competencies', $depthstr) ?></th>
        <td class="cell"><?php echo format_string($item->idnumber) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('descriptionview', 'competencies', $depthstr) ?></th>
        <td class="cell"><?php echo format_text($item->description, FORMAT_HTML) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('aggregationmethodview', 'competencies', $depthstr) ?></th>
        <td class="cell"><?php echo get_string('aggregationmethod'.$item->aggregationmethod, 'competencies') ?></td>
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
print_heading(get_string('evidenceitems', 'competencies'));

?>
<table width="95%" cellpadding="5" cellspacing="1" class="generalbox editcompetencies boxaligncenter">
<tr>
    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c0" scope="col">
        <?php echo get_string('name'); ?>
    </th>

    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c1" scope="col">
        <?php echo get_string('type', 'competencies'); ?>
    </th>

    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c2" scope="col">
        <?php echo get_string('activity'); ?>
    </th>

    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c3" scope="col">
        <?php echo get_string('weight', 'competencies'); ?>
    </th>

<?php
    if ($editingon) {
?>
    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c4" scope="col">
        <?php echo get_string('edit'); ?>
    </th>
<?php
    }
?>

    <th style="vertical-align:top; text-align:center; white-space:nowrap;" class="header c5" scope="col">
        <?php echo get_string('achieved', 'competencies'); ?>
    </th>
</tr>
<?php

$evidence = array();


if ($evidence) {


} else {
    // # cols varies
    $cols = $editingon ? 6 : 5;
    echo '<tr><td colspan="'.$cols.'"><i>'.get_string('noevidenceitems', 'competencies').'</i></td></tr>';
}

echo '</table>';


// Navigation / editing buttons
echo '<div class="buttons">';

// Display add evidence item button
if ($editingon && $can_edit_comp) {

?>

<script type="text/javascript">
    <!-- //
    var <?php echo $hierarchy->prefix ?>_id = '<?php echo $item->id ?>';
    // -->
</script>

<div class="singlebutton">
<form action="<?php echo $CFG->wwwroot ?>/competencies/evidence/edit.php" method="get">
<div>
<input type="hidden" name="<?php echo $hierarchy->prefix ?>" value="<?php echo $item->id ?>" />
<input type="submit" id="show-evidence-dialog" value="<?php echo get_string('addnewevidenceitem', 'competencies') ?>" />
</div>
</form>
</div>

<?php

}

$options = array('frameworkid' => $framework->id);
print_single_button(
    $CFG->wwwroot.'/competencies/index.php',
    $options,
    get_string('returntocompetencies', 'competencies'),
    'get'
);

echo '</div>';

/// and proper footer
print_footer();
