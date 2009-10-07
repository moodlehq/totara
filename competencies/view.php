<?php

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/competencies/lib.php');


///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$competencyedit = optional_param('competencyedit', -1, PARAM_BOOL);

// Handle editing toggling
$options = array('id' => $id);
if (update_competency_button()) {
    if ($competencyedit !== -1) {
        $USER->competencyediting = $competencyedit;
    }
    $editingon = !empty($USER->competencyediting);
    $navbaritem = update_competency_button($options); // Must call this again after updating the state.
} else {
    $navbaritem = '';
    $editingon = false;
}

// Make this page appear under the manage competencies admin item
admin_externalpage_setup('competencymanage', $navbaritem);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:viewcompetencies', $sitecontext);

if (!$competency = get_record('competency', 'id', $id)) {
    error('Competency ID was incorrect');
}

// Load framework
if (!$framework = get_record('competency_framework', 'id', $competency->frameworkid)) {
    error('Competency framework could not be found');
}

// Load depth
if (!$depth = get_record('competency_depth', 'id', $competency->depthid)) {
    error('Competency depth could not be found');
}

// Cache user capabilities
$can_edit_comp = has_capability('moodle/local:updatecompetencies', $sitecontext);


///
/// Display page
///

/// Display page header
admin_externalpage_print_header();

$heading = "{$depth->fullname} - {$competency->fullname}";

// If editing on, add edit icon
if ($editingon) {
    $str_edit = get_string('edit');
    $heading .= " <a href=\"{$CFG->wwwroot}/competencies/edit.php?id={$competency->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
}

print_heading($heading);

$depthstr = $depth->fullname;

?>
<table class="generalbox viewcompetency" cellpadding="5" cellspacing="1">
<tbody>
    <tr>
        <th class="header" width="200"><?php echo get_string('fullnameview', 'competencies', $depthstr) ?></th>
        <td class="cell" width="400"><?php echo format_string($competency->fullname) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('idnumberview', 'competencies', $depthstr) ?></th>
        <td class="cell"><?php echo format_string($competency->idnumber) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('descriptionview', 'competencies', $depthstr) ?></th>
        <td class="cell"><?php echo format_text($competency->description, FORMAT_HTML) ?></td>
    </tr>
    <tr>
        <th class="header"><?php echo get_string('aggregationmethodview', 'competencies', $depthstr) ?></th>
        <td class="cell"><?php echo get_string('aggregationmethod'.$competency->aggregationmethod, 'competencies') ?></td>
    </tr>

<?php

$sql = "SELECT cdif.fullname, cdid.data
        FROM {$CFG->prefix}competency_depth_info_data cdid
        JOIN {$CFG->prefix}competency_depth_info_field cdif ON cdid.fieldid=cdif.id
        WHERE cdid.competencyid=$competency->id";

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
    $options = array('competency' => $competency->id);
    print_single_button(
        $CFG->wwwroot.'/competencies/evidence/edit.php',
        $options,
        get_string('addnewevidenceitem', 'competencies'),
        'get'
    );
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
