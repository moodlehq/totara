<?php

require_once('../../config.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

// Competency scale id
$id = required_param('id', PARAM_INT);
// Move up / down
$moveup = optional_param('moveup', 0, PARAM_INT);
$movedown = optional_param('movedown', 0, PARAM_INT);

// Page setup and check permissions
admin_externalpage_setup('competencyscales');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:viewcompetencies', $sitecontext);

if (!$scale = get_record('competency_scale', 'id', $id)) {
    error('Competency scale ID was incorrect');
}

// Cache user capabilities
$can_edit = has_capability('moodle/local:updatecompetencies', $sitecontext);

// Cache text
$str_edit = get_string('edit');
$str_delete = get_string('delete');
$str_moveup = get_string('moveup');
$str_movedown = get_string('movedown');


///
/// Process any actions
///

if ($can_edit) {
    /// Move a value up or down
    if ((!empty($moveup) or !empty($movedown))) {
        $move = NULL;
        $swap = NULL;

        // Get value to move, and value to replace
        if (!empty($moveup)) {
            $move = get_record('competency_scale_values', 'id', $moveup);
            $swap = get_record_sql("
                SELECT
                    *
                FROM
                    {$CFG->prefix}competency_scale_values
                WHERE
                    scaleid = {$scale->id}
                AND sortorder < {$move->sortorder}
                LIMIT 1", false, true
            );
        } else {
            $move = get_record('competency_scale_values', 'id', $movedown);
            $swap = get_record_sql("
                SELECT
                    *
                FROM
                    {$CFG->prefix}competency_scale_values
                WHERE
                    scaleid = {$scale->id}
                AND sortorder > {$move->sortorder}
                LIMIT 1", false, true
            );
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
}

///
/// Display page
///

// Load values
$values = get_records('competency_scale_values', 'scaleid', $scale->id, 'sortorder');


admin_externalpage_print_header();

// Display info about scale
print_heading($scale->name);

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
    $table->head = array(get_string('name'), get_string('idnumber'), get_string('numericalvalue', 'competencies'));
    $table->align = array('left', 'center', 'center');

    if ($can_edit) {
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
        $row[] = $value->idnumber;
        $row[] = $value->numeric;

        $buttons = array();
        if ($can_edit) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/scale/editvalue.php?id={$value->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

            $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/scale/deletevalue.php?id={$value->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";

            // If value can be moved up
            if ($count > 1) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/scale/view.php?id={$scale->id}&moveup={$value->id}\" title=\"$str_moveup\">".
                             "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
            } else {
                $buttons[] = $spacer;
            }

            // If value can be moved down
            if ($count < $numvalues) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/competencies/scale/view.php?id={$scale->id}&movedown={$value->id}\" title=\"$str_movedown\">".
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

    print_heading(get_string('scalevalues', 'competencies'));
    print_table($table);
}

// Navigation / editing buttons
echo '<div class="buttons">';

// Print button for creating new scale value
if ($can_edit) {
    $options = array('scaleid' => $scale->id);
    print_single_button($CFG->wwwroot.'/competencies/scale/editvalue.php', $options, get_string('addnewscalevalue', 'competencies'), 'get');
}

print_single_button($CFG->wwwroot.'/competencies/scale/index.php', array(), get_string('returntocompetencyscales', 'competencies'), 'get');

echo '</div>';

/// and proper footer
print_footer();
