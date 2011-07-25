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
// Set default value
$default = optional_param('default', 0, PARAM_INT);
$prefix = required_param ('prefix', PARAM_ALPHA);
// Page setup and check permissions
admin_externalpage_setup($prefix.'manage');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:viewcompetency', $sitecontext);

if (!$scale = get_record('comp_scale', 'id', $id)) {
    error('Competency scale ID was incorrect');
}

// Cache user capabilities
$can_edit = has_capability('moodle/local:updatecompetency', $sitecontext);

$scale_used = competency_scale_is_used($id);

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
            $returnurl = "{$CFG->wwwroot}/hierarchy/prefix/competency/scale/view.php?id={$scale->id}&amp;prefix=competency";
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

    // Handle default settings
    if ($default) {

        // Check value exists
        if (!get_record('comp_scale_values', 'id', $default)) {
            error('Incorrect scale value id supplied');
        }

        // Update
        $s = new object();
        $s->id = $scale->id;

        if ($default) {
            $s->defaultid = $default;
        }

        if (!update_record('comp_scale', $s)) {
            error('Could not update competency scale');
        } else {
            // Fetch the update scale record so it'll show up to the user.
            $scale = get_record('comp_scale', 'id', $id);
            totara_set_notification(get_string('scaledefaultupdated', 'competency'), null, array('style' => 'notifysuccess'));
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
                    'link'=>"{$CFG->wwwroot}/hierarchy/framework/index.php?prefix=competency",
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($scale->name), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

print_single_button($CFG->wwwroot . '/hierarchy/framework/index.php', array('prefix' => 'competency'), get_string('allcompetencyscales', 'competency'));

// Display info about scale
print_heading(get_string('scalex', 'competency', format_string($scale->name)), '', 1);
echo '<p>'.format_string($scale->description, FORMAT_HTML).'</p>';

// Display warning if scale is in use
if($scale_used) {
    print_container(get_string('competencyscaleinuse', 'competency'), true, 'notifysuccess');
}


// Display warning if proficient values don't make sense
$maxprof = get_field('comp_scale_values', 'MAX(sortorder)', 'proficient', 1, 'scaleid', $scale->id);
$minnoneprof = get_field('comp_scale_values', 'MIN(sortorder)', 'proficient', 0, 'scaleid', $scale->id);
if(isset($maxprof) && isset($minnoneprof) && $maxprof > $minnoneprof) {
    print_container(get_string('nonsensicalproficientvalues', 'competency'), true, 'notifyproblem');
}


// Display scale values
if ($values) {
    if ($can_edit){
        echo "<form id=\"compscaledefaultprofform\" action=\"{$CFG->wwwroot}/hierarchy/prefix/competency/scale/view.php?id={$id}&amp;prefix=competency\" method=\"POST\">\n";
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
    // get ID of the proficient scale value, if there is only one
    $onlyprof = competency_scale_only_proficient_value($scale->id);
    foreach ($values as $value) {
        $count++;

        $row = array();
        $row[] = format_string($value->name);

        $buttons = array();
        if ($can_edit) {

            // Is this the default value?
            $disabled = ($numvalues == 1) ? ' disabled="disabled"' : '';
            if ($value->id == $scale->defaultid) {
                $row[] = '<input type="radio" name="default" value="'.$value->id.'" checked="checked" ' . $disabled . ' />';
            }
            else {
                $row[] = '<input type="radio" name="default" value="'.$value->id.'" ' . $disabled . ' />';
            }

            // Is this the proficient value?
            if ($value->proficient) {
                $row[] = get_string('yes');
            }
            else {
                $row[] = get_string('no');
            }

            $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/prefix/competency/scale/editvalue.php?id={$value->id}&amp;prefix=competency\" title=\"$str_edit\">".
                "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

            if (!$scale_used) {
                /// prevent deleting default value
                if($value->id == $scale->defaultid) {
                    $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeletecompetencyscalevaluedefault', 'competency') . "\" title=\"" . get_string('error:nodeletecompetencyscalevaluedefault', 'competency') . "\" /></a>";
                // prevent deleting last proficient value
                } else if ($value->id == $onlyprof) {
                    $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeletecompetencyscalevalueonlyprof', 'competency') . "\" title=\"" . get_string('error:nodeletecompetencyscalevalueonlyprof', 'competency') . "\" /></a>";
                } else {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/prefix/competency/scale/deletevalue.php?id={$value->id}&amp;prefix=competency\" title=\"$str_delete\">".
                        "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
                }
            }

            // If value can be moved up
            if ($count > 1 && !$scale_used) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/prefix/competency/scale/view.php?id={$scale->id}&moveup={$value->id}&amp;prefix=competency\" title=\"$str_moveup\">".
                             "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
            } else {
                $buttons[] = $spacer;
            }

            // If value can be moved down
            if ($count < $numvalues && !$scale_used) {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/hierarchy/prefix/competency/scale/view.php?id={$scale->id}&movedown={$value->id}&amp;prefix=competency\" title=\"$str_movedown\">".
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

    if ($can_edit && $numvalues != 1){
        $row = array();
        $row[] = '';
        $row[] = '<input type="submit" value="Update" />';
        $row[] = '';
        $row[] = '';
        $table->data[] = $row;
    }
    print_table($table);
    if ($can_edit){
        echo "</form>\n";
    }
} else {
    echo '<br /><div>'.get_string('noscalevalues','competency').'</div><br />';

}

// Navigation / editing buttons
echo '<div class="buttons">';

// Print button for creating new scale value
if ($can_edit && !$scale_used) {
    $options = array('scaleid' => $scale->id, 'prefix' => 'competency');
    print_single_button($CFG->wwwroot.'/hierarchy/prefix/competency/scale/editvalue.php', $options, get_string('addnewscalevalue', 'competency'), 'get');
}

echo '</div>';

/// and proper footer
print_footer();
