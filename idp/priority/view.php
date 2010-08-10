<?php

require_once('../../config.php');
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
// Set default value
$default = optional_param('default', 0, PARAM_INT);
// Page setup and check permissions
admin_externalpage_setup('idppriorities');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:manageidppriorities', $sitecontext);

if (!$priority = get_record('idp_tmpl_priority_scale', 'id', $id)) {
    error('Competency priority ID was incorrect');
}

// Cache user capabilities
$can_edit = has_capability('moodle/local:manageidppriorities', $sitecontext);

// Cache text
$str_edit = get_string('edit');
$str_delete = get_string('delete');
$str_moveup = get_string('moveup');
$str_movedown = get_string('movedown');
$str_changeto = get_string('changeto', 'idp');
$str_set = get_string('set', 'idp');


///
/// Process any actions
///

if ($can_edit) {
    /// Move a value up or down
    if ((!empty($moveup) or !empty($movedown))) {

        // Can't reorder a scale that's in use
        if ( priority_scale_is_used($priority->id) ) {
            $returnurl = "{$CFG->wwwroot}/idp/priority/view.php?id={$priority->id}";
            print_error('error:noreorderpriorityinuse', 'idp', $returnurl);
        }

        $move = NULL;
        $swap = NULL;

        // Get value to move, and value to replace
        if (!empty($moveup)) {
            $move = get_record('idp_tmpl_priority_scal_val', 'id', $moveup);
            $resultset = get_records_sql("
                SELECT *
                FROM {$CFG->prefix}idp_tmpl_priority_scal_val
                WHERE
                    priorityscaleid = {$priority->id}
                    AND sortorder < {$move->sortorder}
                ORDER BY sortorder DESC", 0, 1
            );
            if ( $resultset && count($resultset) ){
                $swap = reset($resultset);
                unset($resultset);
            }
        } else {
            $move = get_record('idp_tmpl_priority_scal_val', 'id', $movedown);
            $resultset = get_records_sql("
                SELECT *
                FROM {$CFG->prefix}idp_tmpl_priority_scal_val
                WHERE
                    priorityscaleid = {$priority->id}
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
            if (!(    set_field('idp_tmpl_priority_scal_val', 'sortorder', $move->sortorder, 'id', $swap->id)
                   && set_field('idp_tmpl_priority_scal_val', 'sortorder', $swap->sortorder, 'id', $move->id)
                )) {
                error('Could not update that priority scale value!');
            }
            commit_sql();
        }
    }

    // Handle default setting
    if ($default) {

        $value = max($proficient, $default);

        // Check value exists
        if (!get_record('idp_tmpl_priority_scal_val', 'id', $value)) {
            error('Incorrect priority scale value id supplied');
        }

        // Update
        $s = new object();
        $s->id = $priority->id;
        $s->defaultid = $default;

        if (!update_record('idp_tmpl_priority_scale', $s)) {
            error('Could not update priority scale');
        } else {
            // Fetch the update scale record so it'll show up to the user.
            $priority = get_record('idp_tmpl_priority_scale', 'id', $id);
        }
    }
}

///
/// Display page
///

// Load values
$values = get_records('idp_tmpl_priority_scal_val', 'priorityscaleid', $priority->id, 'sortorder');

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("priorityscales", 'idp'),
                    'link'=>"{$CFG->wwwroot}/idp/priority/index.php",
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($priority->name), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

// Display info about scale
print_heading(format_string($priority->name), 'left', 1);
echo '<p>'.format_string($priority->description, FORMAT_HTML).'</p>';

// Display priority scale values
if ($values) {
    if ($can_edit){
        echo "<form id=\"compscaledefaultprofform\" action=\"{$CFG->wwwroot}/idp/priority/view.php?id={$id}\" method=\"POST\">\n";
        echo "<input type=\"hidden\" name=\"id\" value=\"{$id}\" />\n";
    }
    $table = new object();
    $table->class = 'generaltable';
    $table->data = array();

    // Headers
    $table->head = array(get_string('name'));
    $table->align = array('left');

    if ($can_edit) {
        $table->head[] = get_string('defaultvalue', 'idp').' '.
            helpbutton('idp/priority/default', 'Help with Default Value', 'moodle', true, false, '', true);
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
            if ($value->id == $priority->defaultid) {
                $row[] = '<input type="radio" name="default" value="'.$value->id.'" checked="checked" />';
            }
            else {
                $row[] = '<input type="radio" name="default" value="'.$value->id.'" />';
            }

            $buttons[] = "<a href=\"{$CFG->wwwroot}/idp/priority/editvalue.php?id={$value->id}\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

            $buttons[] = "<a href=\"{$CFG->wwwroot}/idp/priority/deletevalue.php?id={$value->id}\" title=\"$str_delete\">".
                "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";

            // If value can be moved up
            if ($count > 1) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/idp/priority/view.php?id={$priority->id}&moveup={$value->id}\" title=\"$str_moveup\">".
                             "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
            } else {
                $buttons[] = $spacer;
            }

            // If value can be moved down
            if ($count < $numvalues) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/idp/priority/view.php?id={$priority->id}&movedown={$value->id}\" title=\"$str_movedown\">".
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

    print_heading(get_string('scales', 'idp'));

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
        $('form#priorityscaledefaultprofform table.generaltable tr.lastrow').remove();
    });
</script>
<?php
    }
} else {
    echo '<br /><div>'.get_string('nopriorityscalevalues','idp').'</div><br />';

}

// Navigation / editing buttons
echo '<div class="buttons">';

// Print button for creating new priority scale value
if ($can_edit) {
    $options = array('priorityscaleid' => $priority->id);
    print_single_button($CFG->wwwroot.'/idp/priority/editvalue.php', $options, get_string('addnewpriorityvalue', 'idp'), 'get');
}

echo '</div>';

/// and proper footer
print_footer();
