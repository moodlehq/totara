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
 * Library of functions related to Learning Plan priorities.
 */

require_once($CFG->dirroot . '/local/plan/lib.php');

/**
 * Determine whether an priority scale is assigned to any components of
 * any plan templates
 *
 * There is a less strict version of this function:
 * {@link dp_priority_scale_is_used()} which tells you if the scale
 * values are actually assigned.
 *
 * @param int $scaleid The scale to check
 * @return boolean
 */
function dp_priority_scale_is_assigned($scaleid) {
    global $CFG;
    global $DP_AVAILABLE_COMPONENTS;

    $count = 0;
    foreach ( $DP_AVAILABLE_COMPONENTS as $c ){
        $count += count_records("dp_{$c}_settings", 'priorityscale', $scaleid);
    }
    return $count > 0 ? true : false;
}


/**
 * Determine whether a scale is in use or not.
 *
 * "in use" means that items are assigned any of the scale's values.
 * Therefore if we delete this scale or alter its values, it'll cause
 * the data in the database to become corrupt
 *
 * There is an even stricter version of this function:
 * {@link dp_priority_scale_is_assigned()} which tells you if the scale
 * even is assigned to any components of any plan templates.
 *
 * @param int $scaleid The scale to check
 * @return boolean
 */
function dp_priority_scale_is_used($scaleid) {
    global $CFG, $DP_AVAILABLE_COMPONENTS;

    $used = false;
    foreach($DP_AVAILABLE_COMPONENTS as $component) {
        // @todo look at how done elsewhere (more error checking)
        $component_class = "dp_{$component}_component";
        require_once($CFG->dirroot . "/local/plan/components/{$component}/{$component}.class.php");
        $used = $used || $component_class::is_priority_scale_used($scaleid);
    }
    return $used;
}


/**
 * A function to display a table list of competency scales
 * @param array $scales the scales to display in the table
 * @return html
 */
function dp_priority_display_table($priorities, $editingon=0) {
    global $CFG;

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    // Cache permissions
    $can_edit = has_capability('local/plan:managepriorityscales', $sitecontext);
    $can_delete = has_capability('local/plan:managepriorityscales', $sitecontext);

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

    if ($priorities) {
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
        $numvalues = count($priorities);
        foreach($priorities as $priority) {
            $scale_used = dp_priority_scale_is_used($priority->id);
            $scale_assigned = dp_priority_scale_is_assigned($priority->id);
            $count++;
            $line = array();

            $title = "<a href=\"$CFG->wwwroot/local/plan/priorityscales/view.php?id={$priority->id}\">".format_string($priority->name)."</a>";
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
                    $buttons[] = "<a title=\"$stredit\" href=\"$CFG->wwwroot/local/plan/priorityscales/edit.php?id=$priority->id\"><img".
                        " src=\"$CFG->pixpath/t/edit.gif\" class=\"iconsmall\" alt=\"$stredit\" /></a> ";
                }

                if ($can_delete) {
                    if($scale_used) {
                        $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeletepriorityscaleinuse', 'local_plan') . "\" title=\"" . get_string('error:nodeletepriorityscaleinuse', 'local_plan') . "\" /></a>";
                    } else if ($scale_assigned) {
                        $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeletepriorityscaleassigned', 'local_plan') . "\" title=\"" . get_string('error:nodeletepriorityscaleassigned', 'local_plan') . "\" /></a>";
                    } else {
                        $buttons[] = "<a title=\"$strdelete\" href=\"$CFG->wwwroot/local/plan/priorityscales/index.php?delete=$priority->id\"><img".
                            " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
                    }
                }
                // If value can be moved up
                if ($can_edit && $count > 1) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/priorityscales/index.php?moveup={$priority->id}\" title=\"$str_moveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$str_moveup\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }

                // If value can be moved down
                if ($can_edit && $count < $numvalues) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/local/plan/priorityscales/index.php?movedown={$priority->id}\" title=\"$str_movedown\">".
                        "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$str_movedown\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }
                $line[] = implode($buttons, ' ');
            }

            $table->data[] = $line;
        }
    }
    print_heading(get_string('priorityscales', 'local_plan'));

    if ($priorities) {
        print_table($table);
    } else {
        echo '<p>'.get_string('noprioritiesdefined', 'local_plan').'</p>';
    }

    echo '<div class="buttons">';
    print_single_button("$CFG->wwwroot/local/plan/priorityscales/edit.php", null, get_string('priorityscalecreate', 'local_plan'));
    echo '</div>';
}

/**
 * Gets the default priority scale (the one with the lowest sortorder)
 *
 * @return object the priority
 */
function dp_priority_default_scale(){
    if (!$priority = get_records('dp_priority_scale', '','', 'sortorder', '*', '', 1)) {;
        return false;
    }

    return reset($priority);
}

/**
 * Gets the id of the default priority scale (the one with the lowest sortorder)
 *
 * @return object the priority
 */
function dp_priority_default_scale_id(){
    $priority = dp_priority_default_scale();
    if ( $priority && isset($priority->id) ){
        return $priority->id;
    } else {
        return false;
    }
}

?>
