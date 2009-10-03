<?php

require_once('../config.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);

// Make this page appear under the manage competencies admin item
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competencies/edit.php');

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
if (!$depth = get_record('competency_depth', 'frameworkid', $framework->id, 'depthlevel', $competency->depthid)) {
    error('Competency depth could not be found');
}

// Cache user capabilities
$can_edit_comp = has_capability('moodle/local:updatecompetencies', $sitecontext);


///
/// Display page
///

/// Display page header
admin_externalpage_print_header();

print_heading("{$depth->fullname} - {$competency->fullname}");

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


// Navigation / editing buttons
echo '<div class="buttons">';

// Print button for creating new competency
/*if ($can_add_comp) {
    $options = array('frameworkid' => $framework->id);
    print_single_button($CFG->wwwroot.'/competencies/edit.php', $options, get_string('addnewcompetency', 'competencies'), 'get');
}

// Print button to add a depth level
if ($can_add_depth) {
    $options = array('frameworkid' => $framework->id);
    print_single_button($CFG->wwwroot.'/competencies/depthlevel.php', $options, get_string('adddepthlevel', 'competencies'), 'get');
}*/

$options = array('frameworkid' => $framework->id);
print_single_button($CFG->wwwroot.'/competencies/index.php', $options, get_string('returntocompetencies', 'competencies'), 'get');

echo '</div>';

/// and proper footer
print_footer();
