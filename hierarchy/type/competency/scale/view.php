<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');


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

// Page setup and check permissions
admin_externalpage_setup('competencyscales');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:viewcompetency', $sitecontext);

if (!$scale = get_record('competency_scale', 'id', $id)) {
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
            $returnurl = "{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}";
            print_error('error:noreorderscaleinuse', 'hierarchy', $returnurl);
        }

        $move = NULL;
        $swap = NULL;

        // Get value to move, and value to replace
        if (!empty($moveup)) {
            $move = get_record('competency_scale_values', 'id', $moveup);
            $resultset = get_records_sql("
                SELECT *
                FROM {$CFG->prefix}competency_scale_values
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
            $move = get_record('competency_scale_values', 'id', $movedown);
            $resultset = get_records_sql("
                SELECT *
                FROM {$CFG->prefix}competency_scale_values
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
            if (!(    set_field('competency_scale_values', 'sortorder', $move->sortorder, 'id', $swap->id)
                   && set_field('competency_scale_values', 'sortorder', $swap->sortorder, 'id', $move->id)
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
        if (!get_record('competency_scale_values', 'id', $value)) {
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

        if (!update_record('competency_scale', $s)) {
            error('Could not update competency scale');
        }
    }
}

///
/// Display page
///

// Load values
$values = get_records('competency_scale_values', 'scaleid', $scale->id, 'sortorder');


admin_externalpage_print_header();

// Display info about scale
print_heading(get_string('competencyscalename', 'competency', $scale->name));

if (strlen(trim($scale->description))) {

?>
<table class="generalbox boxaligncenter viewcompetency" cellpadding="5" cellspacing="1">
<tbody>
    <tr>
        <th class="header"><?php echo get_string('description') ?></th>
        <td class="cell"><?php echo format_text($scale->description, FORMAT_HTML) ?></td>
    </tr>
</tbody>
</table>
<?php

}

// Display scale values
if ($values) {
    $table = new object();
    $table->class = 'generalbox';
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
                $row[] = $str_set;
            }
            else {
                $row[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}&default={$value->id}\" title=\"$str_changeto\">".
                            $str_changeto."</a>";
            }

            // Is this the proficient value?
            if ($value->id == $scale->proficient) {
                $row[] = $str_set;
            }
            else {
                $row[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}&proficient={$value->id}\" title=\"$str_changeto\">".
                            $str_changeto."</a>";
            }

            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/editvalue.php?id={$value->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/deletevalue.php?id={$value->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";

            // If value can be moved up
            if ($count > 1) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}&moveup={$value->id}\" title=\"$str_moveup\">".
                             "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
            } else {
                $buttons[] = $spacer;
            }

            // If value can be moved down
            if ($count < $numvalues) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/scale/view.php?id={$scale->id}&movedown={$value->id}\" title=\"$str_movedown\">".
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

    print_heading(get_string('scalevalues', 'competency'));
    print_table($table);
} else {
    echo '<br /><div>'.get_string('noscalevalues','competency').'</div><br />';

}

// Navigation / editing buttons
echo '<div class="buttons">';

// Print button for creating new scale value
if ($can_edit) {
    $options = array('scaleid' => $scale->id);
    print_single_button($CFG->wwwroot.'/hierarchy/type/competency/scale/editvalue.php', $options, get_string('addnewscalevalue', 'competency'), 'get');
}

print_single_button($CFG->wwwroot.'/hierarchy/type/competency/scale/index.php', array(), get_string('returntocompetencyscales', 'competency'), 'get');

echo '</div>';

/// and proper footer
print_footer();
