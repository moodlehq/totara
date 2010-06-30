<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');
require_js(array(
    $CFG->wwwroot.'/local/js/lib/jquery-1.3.2.min.js',
));


///
/// Setup / loading data
///

// Competency scale id
$id = required_param('id', PARAM_INT);
// Move up / down
$moveup = optional_param('moveup', 0, PARAM_INT);
$movedown = optional_param('movedown', 0, PARAM_INT);
// Set proficient value
$proficient = optional_param('proficient', 0, PARAM_INT);
// Set default value
$default = optional_param('default', 0, PARAM_INT);
$type = required_param ('type', PARAM_TEXT);
// Page setup and check permissions
admin_externalpage_setup($type.'frameworkmanage');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:viewcompetency', $sitecontext);

if (!$scale = get_record('comp_scale', 'id', $id)) {
    error('Competency scale ID was incorrect');
}

// Cache user capabilities
$can_edit = has_capability('moodle/local:updatecompetency', $sitecontext);

// Cache text
$str_edit = get_string('edit');
$str_delete = get_string('delete');
$str_moveup = get_string('moveup');
$str_movedown = get_string('movedown');
$str_changeto = get_string('changeto', 'competency');
$str_set = get_string('set', 'competency');


///
/// Process any actions
///

if ($can_edit) {
    /// Move a value up or down
    if ((!empty($moveup) or !empty($movedown))) {

        // Can't reorder a scale that's in use
        if ( competency_scale_is_used($scale->id) ) {
            $returnurl = "{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}&amp;type=competency";
            print_error('error:noreorderscaleinuse', 'hierarchy', $returnurl);
        }

        $move = NULL;
        $swap = NULL;

        // Get value to move, and value to replace
        if (!empty($moveup)) {
            $move = get_record('comp_scale_values', 'id', $moveup);
            $resultset = get_records_sql("
                SELECT *
                FROM {$CFG->prefix}comp_scale_values
                WHERE
                    scaleid = {$scale->id}
                    AND sortorder < {$move->sortorder}
                ORDER BY sortorder DESC", 0, 1
            );
            if ( $resultset && count($resultset) ){
                $swap = reset($resultset);
                unset($resultset);
            }
        } else {
            $move = get_record('comp_scale_values', 'id', $movedown);
            $resultset = get_records_sql("
                SELECT *
                FROM {$CFG->prefix}comp_scale_values
                WHERE
                    scaleid = {$scale->id}
                    AND sortorder > {$move->sortorder}
                ORDER BY sortorder ASC", 0, 1
            );
            if ( $resultset && count($resultset) ){
                $swap = reset($resultset);
                unset($resultset);
            }
        }

        if ($swap && $move) {
            // Swap sortorders
            begin_sql();
            if (!(    set_field('comp_scale_values', 'sortorder', $move->sortorder, 'id', $swap->id)
                   && set_field('comp_scale_values', 'sortorder', $swap->sortorder, 'id', $move->id)
                )) {
                error('Could not update that scale value!');
            }
            commit_sql();
        }
    }

    // Handle proficient/default settings
    if ($proficient || $default) {

        $value = max($proficient, $default);

        // Check value exists
        if (!get_record('comp_scale_values', 'id', $value)) {
            error('Incorrect scale value id supplied');
        }

        // Update
        $s = new object();
        $s->id = $scale->id;

        if ($proficient) {
            $s->proficient = $proficient;
        }

        if ($default) {
            $s->defaultid = $default;
        }

        if (!update_record('comp_scale', $s)) {
            error('Could not update competency scale');
        } else {
            // Fetch the update scale record so it'll show up to the user.
            $scale = get_record('comp_scale', 'id', $id);
        }
    }
}

///
/// Display page
///

// Load values
$values = get_records('comp_scale_values', 'scaleid', $scale->id, 'sortorder');

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("competencyframeworks", 'competency'), 
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?type=competency", 
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($scale->name), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

// Display info about scale
print_heading(format_string($scale->name), 'left', 1);
echo '<p>'.format_string($scale->description, FORMAT_HTML).'</p>';

// Display scale values
if ($values) {
    if ($can_edit){
        echo "<form id=\"compscaledefaultprofform\" action=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$id}&amp;type=competency\" method=\"POST\">\n";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$id}\" />\n";
    }
    $table = new object();
    $table->class = 'generaltable';
    $table->data = array();

    // Headers
    $table->head = array(get_string('name'));
    $table->align = array('left');

    if ($can_edit) {
        $table->head[] = get_string('defaultvalue', 'competency').' '.
            helpbutton('competency/scale/default', 'Help with Default Value', 'moodle', true, false, '', true);
        $table->align[] = 'center';

        $table->head[] = get_string('proficientvalue', 'competency').' '.
            helpbutton('competency/scale/proficient', 'Help with Proficient Value', 'moodle', true, false, '', true);
        $table->align[] = 'center';

        $table->head[] = get_string('edit');
        $table->align[] = 'center';
    }

    $spacer = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" />";
    $numvalues = count($values);

    // Add rows to table
    $count = 0;
    foreach ($values as $value) {
        $count++;

        $row = array();
        $row[] = $value->name;

        $buttons = array();
        if ($can_edit) {

            // Is this the default value?
            if ($value->id == $scale->defaultid) {
                $row[] = '<input type="radio" name="default" value="'.$value->id.'" checked="checked" />';
            }
            else {
                $row[] = '<input type="radio" name="default" value="'.$value->id.'" />';
            }

            // Is this the proficient value?
            if ($value->id == $scale->proficient) {
                $row[] = '<input type="radio" name="proficient" value="'.$value->id.'" checked="checked" />';
            }
            else {
                $row[] = '<input type="radio" name="proficient" value="'.$value->id.'" />';
            }

            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/editvalue.php?id={$value->id}&amp;type=competency\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/deletevalue.php?id={$value->id}&amp;type=competency\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";

            // If value can be moved up
            if ($count > 1) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}&moveup={$value->id}&amp;type=competency\" title=\"$str_moveup\">".
                             "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
            } else {
                $buttons[] = $spacer;
            }

            // If value can be moved down
            if ($count < $numvalues) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}&movedown={$value->id}&amp;type=competency\" title=\"$str_movedown\">".
                             "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
            } else {
                $buttons[] = $spacer;
            }
        }

        if ($can_edit) {
            $row[] = implode($buttons, ' ');
        }

        $table->data[] = $row;
    }

    print_heading(get_string('scales', 'competency'));

    if ($can_edit ){
        $row = array();
        $row[] = '';
        $row[] = '<noscript><input type="submit" value="Update" /></noscript>';
        $row[] = '<noscript><input type="submit" value="Update" /></noscript>';
        $row[] = '';
        $table->data[] = $row;
    }
    print_table($table);
    if ($can_edit){
        echo "</form>\n";
        ?>
<script type="text/javascript">
    $("#compscaledefaultprofform input:radio").change(
        function(eventObject){
            $("#compscaledefaultprofform").submit();
        }
    );

    // On page load, remove last row in table (it's for non-js users only)
    $(function() {
        $('form#compscaledefaultprofform table.generaltable tr.lastrow').remove();
    });
</script>
<?php
    }
} else {
    echo '<br /><div>'.get_string('noscalevalues','competency').'</div><br />';

}

// Navigation / editing buttons
echo '<div class="buttons">';

// Print button for creating new scale value
if ($can_edit) {
    $options = array('scaleid' => $scale->id, 'type' => 'competency');
    print_single_button($CFG->wwwroot.'/hierarchy/type/competency/scale/editvalue.php', $options, get_string('addnewscalevalue', 'competency'), 'get');
}

echo '</div>';

/// and proper footer
print_footer();
