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

/**
 * local/plan/objectivescales/lib.php
 *
 * Library of functions related to Objective priorities.
 */


/**
 * Determine whether an objective scale is assigned to any plan templates
 *
 * There is a less strict version of this function:
 * {@link dp_objective_scale_is_used()} which tells you if the scale
 * values are actually assigned.
 *
 * @param int $scaleid The scale to check
 * @return boolean
 */
function dp_objective_scale_is_assigned($scaleid) {
    return record_exists('dp_objective_settings', 'objectivescale', $scaleid);
}

/**
 * Determine whether a scale is in use or not.
 *
 * "in use" means that items are assigned any of the scale's values.
 * Therefore if we delete this scale or alter its values, it'll cause
 * the data in the database to become corrupt
 *
 * There is an even stricter version of this function:
 * {@link dp_objective_scale_is_assigned()} which tells you if the scale
 * even is assigned to any plan templates.
 *
 * @param int $scaleid The scale to check
 * @return boolean
 */
function dp_objective_scale_is_used($scaleid) {
    global $CFG;

    $sql = "SELECT
                o.id
            FROM
                {$CFG->prefix}dp_plan_objective o
            LEFT JOIN
                {$CFG->prefix}dp_objective_scale_value osv
            ON osv.id = o.scalevalueid
            WHERE osv.objscaleid = {$scaleid}
    ";

    return record_exists_sql($sql);
}

/**
 * A function to display a table list of competency scales
 * @param array $scales the scales to display in the table
 * @return html
 */
function dp_objective_display_table($objectives, $editingon=0) {
    global $CFG;

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    // Cache permissions
    $can_edit = has_capability('local/plan:manageobjectivescales', $sitecontext);
    $can_delete = has_capability('local/plan:manageobjectivescales', $sitecontext);

    // Make sure user has capability to edit
    if (!(($can_edit || $can_delete) && $editingon)) {
        $editingon = 0;
    }

    $stredit = get_string('edit');
    $strdelete = get_string('delete');
    $stroptions = get_string('options','local');
    $str_moveup = get_string('moveup');
    $str_movedown = get_string('movedown');
    ///
    /// Build page
    ///

    if ($objectives) {
        $table = new stdClass();
        $table->head  = array(get_string('scale'), get_string('used'));
        $table->size = array('70%', '20%');
        $table->align = array('left', 'center');
        $table->width = '95%';
        if ($editingon) {
            $table->head[] = $stroptions;
            $table->align[] = array('center');
            $table->size[] = array('10%');
        }

        $table->data = array();
        $spacer = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" />";
        $count = 0;
        $numvalues = count($objectives);
        foreach($objectives as $objective) {
            $scale_used = dp_objective_scale_is_used($objective->id);
            $scale_assigned = dp_objective_scale_is_assigned($objective->id);
            $count++;
            $line = array();

            $title = "<a href=\"$CFG->wwwroot/local/plan/objectivescales/view.php?id={$objective->id}\">".format_string($objective->name)."</a>";
            if ($count==1){
                $title .= ' ('.get_string('default').')';
            }
            $line[] = $title;

            if ($scale_used) {
                $line[] = get_string('yes');
            } else if ($scale_assigned) {
                $line[] = get_string('assignedonly', 'local_plan');
            } else {
                $line[] = get_string('no');
            }

            $buttons = array();
            if ($editingon) {
                if ($can_edit) {
                    $buttons[] = "<a title=\"$stredit\" href=\"$CFG->wwwroot/local/plan/objectivescales/edit.php?id=$objective->id\"><img".
                        " src=\"$CFG->pixpath/t/edit.gif\" class=\"iconsmall\" alt=\"$stredit\" /></a> ";
                }

                if ($can_delete) {
                    if($scale_used) {
                        $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeleteobjectivescaleinuse', 'local_plan') . "\" title=\"" . get_string('error:nodeleteobjectivescaleinuse', 'local_plan') . "\" /></a>";
                    } else if ($scale_assigned) {
                        $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeleteobjectivescaleassigned', 'local_plan') . "\" title=\"" . get_string('error:nodeleteobjectivescaleassigned', 'local_plan') . "\" /></a>";
                    } else {
                        $buttons[] = "<a title=\"$strdelete\" href=\"$CFG->wwwroot/local/plan/objectivescales/index.php?delete=$objective->id\"><img".
                                " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
                    }
                }

                // If value can be moved up
                if ($can_edit && $count > 1) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/objectivescales/index.php?moveup={$objective->id}\" title=\"$str_moveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }

                // If value can be moved down
                if ($can_edit && $count < $numvalues) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/objectivescales/index.php?movedown={$objective->id}\" title=\"$str_movedown\">".
                        "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }
                $line[] = implode($buttons, ' ');
            }

            $table->data[] = $line;
        }
    }
    print_heading(get_string('objectivescales', 'local_plan'));

    if ($objectives) {
        print_table($table);
    } else {
        echo '<p>'.get_string('noobjectivesdefined', 'local_plan').'</p>';
    }

    echo '<div class="buttons">';
    print_single_button("$CFG->wwwroot/local/plan/objectivescales/edit.php", null, get_string('objectivesscalecreate', 'local_plan'));
    echo '</div>';
}

/**
 * Gets the id of the default objective scale (the one with the lowest sortorder)
 *
 * @return object the objective
 */
function dp_objective_default_scale(){
    if (!$objective = get_records('dp_objective_scale', '','', 'sortorder', '*', '', 1)) {;
        return false;
    }

    return reset($objective);
}

/**
 * Gets the id of the default objective scale (the one with the lowest sortorder)
 *
 * @return object the objective
 */
function dp_objective_default_scale_id(){
    $objective = dp_objective_default_scale();
    if ( $objective && isset($objective->id) ){
        return $objective->id;
    } else {
        return false;
    }
}

?>
