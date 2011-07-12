<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 * Copyright (C) 1999 onwards Martin Dougiamas
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Alastair Munro <alastair@catalyst.net.nz>
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage plan
 */

require_once('../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once('lib.php');

///
/// Setup / loading data
///

// Competency scale id
$id = required_param('id', PARAM_INT);
$moveup = optional_param('moveup', 0, PARAM_INT); // Move up
$movedown = optional_param('movedown', 0, PARAM_INT); // Move down
$default = optional_param('default', 0, PARAM_INT); // Set default value
$delete = optional_param('delete', 0, PARAM_INT); //Item to be deleted
$confirm = optional_param('confirm', 0, PARAM_INT); //Confirmation of delete

// Page setup and check permissions
admin_externalpage_setup('objectivescales');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('local/plan:manageobjectivescales', $sitecontext);

if (!$objective = get_record('dp_objective_scale', 'id', $id)) {
    error(get_string('error:objectivescaleidincorrect', 'local_plan'));
}

$scale_used = dp_objective_scale_is_used($id);

if($delete) {
    if(!$value = get_record('dp_objective_scale_value', 'id', $delete)) {
       print_error('error:invalidobjectivescalevalueid', 'local_plan');
    }

    if($scale_used) {
        print_error('error:nodeleteobjectivescalevalueinuse', 'local_plan');
    }

    if($value->id == $objective->defaultid) {
        print_error('error:nodeleteobjectivescalevaluedefault', 'local_plan');
    }

    if($confirm) {
        if (!confirm_sesskey()) {
            print_error('confirmsesskeybad', 'error');
        }

        begin_sql();
        if(!delete_records('dp_objective_scale_value', 'id', $delete)) {
            rollback_sql();
            totara_set_notification(get_string('error:deletedobjectivescalevalue', 'local_plan'), $CFG->wwwroot.'/local/plan/objectivescales/view.php?id='.$objective->id);
        }

        $sql = "UPDATE {$CFG->prefix}dp_objective_scale_value SET sortorder=sortorder-1 WHERE objscaleid={$objective->id} AND sortorder > {$value->sortorder}";
        if(!execute_sql($sql, false)) {
            rollback_sql();
            totara_set_notification(get_string('error:deletedobjectivescalevalue', 'local_plan'), $CFG->wwwroot.'/local/plan/objectivescales/view.php?id='.$objective->id);
        }

        commit_sql();
        totara_set_notification(get_string('deletedobjectivescalevalue', 'local_plan', format_string($objective->name)), $CFG->wwwroot.'/local/plan/objectivescales/view.php?id='.$objective->id, array('style' => 'notifysuccess'));

    } else {
        $returnurl = "{$CFG->wwwroot}/local/plan/objectivescales/view.php?id={$objective->id}";
        $deleteurl = "{$CFG->wwwroot}/local/plan/objectivescales/view.php?id={$objective->id}&amp;delete={$delete}&amp;confirm=1&amp;sesskey=" . sesskey();

        admin_externalpage_print_header();
        $strdelete = get_string('deletecheckobjectivevalue', 'local_plan');

        notice_yesno(
            "{$strdelete}<br /><br />".format_string($value->name),
            $deleteurl,
            $returnurl
        );

        print_footer();
        exit;
    }
}

// Cache text
$str_edit = get_string('edit');
$str_delete = get_string('delete');
$str_moveup = get_string('moveup');
$str_movedown = get_string('movedown');
$str_changeto = get_string('changeto', 'local_plan');
$str_set = get_string('set', 'local_plan');


///
/// Process any actions
///

/// Move a value up or down
if ((!empty($moveup) or !empty($movedown))) {

    // Can't reorder a scale that's in use
    if ( $scale_used ) {
        $returnurl = "{$CFG->wwwroot}/local/plan/objectivescales/view.php?id={$objective->id}";
        print_error('error:noreorderobjectiveinuse', 'local_plan', $returnurl);
    }

    $move = NULL;
    $swap = NULL;

    // Get value to move, and value to replace
    if (!empty($moveup)) {
        $move = get_record('dp_objective_scale_value', 'id', $moveup);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}dp_objective_scale_value
            WHERE
            objscaleid = {$objective->id}
            AND sortorder < {$move->sortorder}
            ORDER BY sortorder DESC", 0, 1
        );
        if ( $resultset && count($resultset) ){
            $swap = reset($resultset);
            unset($resultset);
        }
    } else {
        $move = get_record('dp_objective_scale_value', 'id', $movedown);
        $resultset = get_records_sql("
            SELECT *
            FROM {$CFG->prefix}dp_objective_scale_value
            WHERE
            objscaleid = {$objective->id}
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
        if (!(    set_field('dp_objective_scale_value', 'sortorder', $move->sortorder, 'id', $swap->id)
            && set_field('dp_objective_scale_value', 'sortorder', $swap->sortorder, 'id', $move->id)
        )) {
            error(get_string('error:updateobjectivescalevalue', 'local_plan'));
        }
        commit_sql();
    }
}

// Handle default setting
if ($default) {
    $value = $default;

    // Check value exists
    if (!get_record('dp_objective_scale_value', 'id', $value)) {
        error(get_string('error:objectivescalevalueidincorrect', 'local_plan'));
    }

    // Update
    $s = new object();
    $s->id = $objective->id;
    $s->defaultid = $default;

    if (!update_record('dp_objective_scale', $s)) {
        error(get_string('error:updateobjectivescale','local_plan'));
    } else {
        totara_set_notification(get_string('objectivescaledefaultupdated', 'local_plan'), null, array('style' => 'notifysuccess'));
        // Fetch the update scale record so it'll show up to the user.
        $objective = get_record('dp_objective_scale', 'id', $id);
    }
}


///
/// Display page
///

// Load values
$values = get_records('dp_objective_scale_value', 'objscaleid', $objective->id, 'sortorder');

$navlinks = array();    // Breadcrumbs
$navlinks[] = array('name'=>get_string("objectivescales", 'local_plan'),
                    'link'=>"{$CFG->wwwroot}/local/plan/objectivescales/index.php",
                    'type'=>'misc');
$navlinks[] = array('name'=>format_string($objective->name), 'link'=>'', 'type'=>'misc');

admin_externalpage_print_header('', $navlinks);

print_single_button($CFG->wwwroot . '/local/plan/objectivescales/index.php', null, get_string('allobjectivescales', 'local_plan'));

// Display info about scale
print_heading(get_string('objectivescalex', 'local_plan', format_string($objective->name)), '', 1);
echo '<p>'.format_string($objective->description, FORMAT_HTML).'</p>';

// Display warning if scale is in use
if($scale_used) {
    print_container(get_string('objectivescaleinuse', 'local_plan'), true, 'notifysuccess');
}

// Display warning if proficient values don't make sense
$max_achieved = get_field('dp_objective_scale_value', 'MAX(sortorder)', 'achieved', 1, 'objscaleid', $id);
$min_notachieved = get_field('dp_objective_scale_value', 'MIN(sortorder)', 'achieved', 0, 'objscaleid', $id);
if(isset($max_achieved) && isset($min_notachieved) && $max_achieved > $min_notachieved) {
    print_container(get_string('nonsensicalachievedvalues', 'local_plan'), true, 'notifyproblem');
}

// Display objective scale values
if ($values) {
    echo "<form id=\"objscaleupdateform\" action=\"{$CFG->wwwroot}/local/plan/objectivescales/view.php?id={$id}\" method=\"POST\">\n";
    echo "<input type=\"hidden\" name=\"id\" value=\"{$id}\" />\n";

    $table = new object();
    $table->class = 'generaltable';
    $table->data = array();

    // Headers
    $table->head = array(get_string('name'));
    $table->align = array('left');

    $table->head[] = get_string('defaultvalue', 'local_plan').' '.
        helpbutton('objectivescaledefault', 'Help with Default Value', 'local_plan', true, false, '', true);
    $table->align[] = 'center';

    $table->head[] = get_string('achieved', 'local_plan').' '.
        helpbutton('objectivescalevalueachieved', 'Help with Proficient Value', 'local_plan', true, false, '', true);
    $table->align[] = 'center';

    $table->head[] = get_string('edit');
    $table->align[] = 'center';

    $spacer = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" />";
    $numvalues = count($values);

    // Add rows to table
    $count = 0;
    foreach ($values as $value) {
        $count++;

        $row = array();
        $row[] = $value->name;

        $buttons = array();

        // Is this the default value?
        $disabled = ($numvalues == 1) ? ' disabled="disabled"' : '';
        if ($value->id == $objective->defaultid) {
            $row[] = '<input type="radio" name="default" value="'.$value->id.'" checked="checked" ' .
                $disabled . ' />';
        } else {
            $row[] = '<input type="radio" name="default" value="'.$value->id.'" ' . $disabled . ' />';
        }

        if ($value->achieved) {
            $row[] = get_string('yes');
        } else {
            $row[] = get_string('no');
        }

        $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/objectivescales/editvalue.php?id={$value->id}\" title=\"$str_edit\">".
            "<img src=\"{$CFG->pixpath}/t/edit.gif\" class=\"iconsmall\" alt=\"$str_edit\" /></a>";

        if(!$scale_used) {
            if($value->id == $objective->defaultid) {
                $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeleteobjectivescalevaluedefault', 'local_plan') . "\" title=\"" . get_string('error:nodeleteobjectivescalevaluedefault', 'local_plan') . "\" /></a>";
            } else {
                $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/objectivescales/view.php?id={$objective->id}&amp;delete={$value->id}\" title=\"$str_delete\">".
                    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_delete\" /></a>";
            }
        } else {
            $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeleteobjectivescalevalueinuse', 'local_plan') . "\" title=\"" . get_string('error:nodeleteobjectivescalevalueinuse', 'local_plan') . "\" /></a>";
        }

        // If value can be moved up
        if ($count > 1 && !$scale_used) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/objectivescales/view.php?id={$objective->id}&moveup={$value->id}\" title=\"$str_moveup\">".
                "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
        } else {
            $buttons[] = $spacer;
        }

        // If value can be moved down
        if ($count < $numvalues && !$scale_used) {
            $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/objectivescales/view.php?id={$objective->id}&movedown={$value->id}\" title=\"$str_movedown\">".
                "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
        } else {
            $buttons[] = $spacer;
        }

        $row[] = implode($buttons, ' ');

        $table->data[] = $row;
    }

    if($numvalues != 1) {
        $row = array();
        $row[] = '';
        $row[] = '<input type="submit" value="Update" />';
        $row[] = '';
        $row[] = '';
        $table->data[] = $row;
    }

    print_table($table);
    echo "</form>\n";

} else {
    echo '<br /><div>'.get_string('noobjectivescalevalues','local_plan').'</div><br />';

}

// Navigation / editing buttons
echo '<div class="buttons">';

// Print button for creating new objective scale value
if(!$scale_used) {
    $options = array('objscaleid' => $objective->id);
    print_single_button($CFG->wwwroot.'/local/plan/objectivescales/editvalue.php', $options, get_string('addnewobjectivevalue', 'local_plan'), 'get');
}

echo '</div>';

/// and proper footer
print_footer();
