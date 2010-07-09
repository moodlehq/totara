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
admin_externalpage_setup($hierarchy->prefix.'frameworkmanage', $navbaritem);

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:view'.$hierarchy->prefix, $sitecontext);


///
/// Display page
///

// Run any hierarchy type specific code
$hierarchy->hierarchy_page_setup('template/view');

/// Display page header
$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("competencyframeworks", 'competency'), 
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type=competency", 
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($framework->fullname), 
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/view.php?type=competency&frameworkid={$framework->id}", 
                    'type'=>'misc');    // Framework View    
$navlinks[] = array('name'=>format_string($item->fullname), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

$heading = "{$item->fullname}";

// If editing on, add edit icon
if ($editingon) {
    $str_edit = get_string('edit');
    $str_remove = get_string('remove');

    $heading .= " <a href=\"{$CFG->wwwroot}/hierarchy/type/{$hierarchy->prefix}/template/edit.php?id={$item->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";
}

print_heading($heading, 'left', 1);

$depthstr = get_string('template', $hierarchy->prefix);

echo '<p>'.format_text($item->description, FORMAT_HTML).'</p>';


///
/// Display assigned competencies
///
print_heading(get_string('assignedcompetencies', $hierarchy->prefix));

if ($competencies) {
    $table = new object();
    $table->id = 'list-assignment';
    $table->class = 'generaltable';
    $table->data = array();

    // Headers
    $table->head = array(get_string('name'), get_string('depthlevel', $hierarchy->prefix));
    $table->align = array('left', 'left');
    if ($editingon) {
        $table->head[] = get_string('options', $hierarchy->prefix);
        $table->align[] = 'center';
    }

    foreach ($competencies as $competency) {
        $row = array();
        $row[] = $competency->competency;        
        $row[] = $competency->depth;        
        if ($editingon) {

            $row[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/{$hierarchy->prefix}/template/remove_assignment.php?templateid={$item->id}&assignment={$competency->id}\" title=\"$str_remove\">".
    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

        }

        $table->data[] = $row;
    }
    print_table($table);    
} else {
    // # cols varies TODO
    //$cols = $editingon ? 3 : 2;
    echo '<p>'.get_string('noassignedcompetenciestotemplate', $hierarchy->prefix).'</p>';
    //echo '<tr class="noitems-assignment"><td colspan="'.$cols.'"><i>'.get_string('noassignedcompetenciestotemplate', $hierarchy->prefix).'</i></td></tr>';
}

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

<br>
<div class="singlebutton">
<form action="<?php echo $CFG->wwwroot ?>/hierarchy/type/<?php echo $hierarchy->prefix ?>/template/find_competency.php?templateid=<?php echo $item->id ?>" method="get">
<div>
<input type="submit" id="show-assignment-dialog" value="<?php echo get_string('assignnewcompetency', $hierarchy->prefix) ?>" />
<input type="hidden" name="templateid" value="<?php echo $item->id ?>">
<input type="hidden" name="nojs" value="1">
<input type="hidden" name="returnurl" value="<?php echo qualified_me(); ?>">
<input type="hidden" name="s" value="<?php echo sesskey(); ?>">
<input type="hidden" name="frameworkid" value="<?php echo $item->frameworkid ?>">
</div>
</form>
</div>

<?php

}
/*
// Return to template list
$options = array('frameworkid' => $framework->id);
print_single_button(
    $CFG->wwwroot.'/hierarchy/type/'.$hierarchy->prefix.'/template/index.php',
    $options,
    get_string('returntotemplates', $hierarchy->prefix),
    'get'
);
*/
echo '</div>';

/// and proper footer
print_footer();
