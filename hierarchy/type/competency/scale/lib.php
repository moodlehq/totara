<?php
/**
 * competency/lib.php
 *
 * Library of functions related to competency scales.
 *
 * Note: Functions in this library should have names beginning with "competency_scale",
 * in order to avoid name collisions
 *
 * @copyright Catalyst IT Limited
 * @author Aaron Wells
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */

/**
 * Determine whether an competency scale is assigned to any frameworks
 *
 * There is a less strict version of this function:
 * {@link competency_scale_is_used()} which tells you if the scale
 * values are actually assigned.
 *
 * @param int $objectiveid
 * @return boolean
 */
function competency_scale_is_assigned($scaleid) {
    return record_exists('comp_scale_assignments', 'scaleid', $scaleid);
}


/**
 * Determine whether a scale is in use or not.
 *
 * "in use" means that items are assigned any of the scale's values.
 * Therefore if we delete this scale or alter its values, it'll cause
 * the data in the database to become corrupt
 *
 * There is an even stricter version of this function:
 * {@link competency_scale_is_assigned()} which tells you if the scale
 * even is assigned to any frameworks
 *
 * @param <type> $scaleid
 * @return boolean
 */
function competency_scale_is_used( $scaleid ){
    global $CFG;

    $sql = "SELECT
                ce.competencyid
            FROM
                {$CFG->prefix}comp_evidence ce
            LEFT JOIN {$CFG->prefix}comp_scale_values csv
              ON csv.id = ce.proficiency
            WHERE csv.scaleid = {$scaleid}";


    $sql2 = "SELECT
                pca.scalevalueid
             FROM
                {$CFG->prefix}dp_plan_competency_assign pca
             JOIN {$CFG->prefix}comp_scale_values csv
                ON pca.scalevalueid = csv.id
            WHERE
                csv.scaleid = {$scaleid}";

    return (record_exists_sql($sql) || record_exists_sql($sql2));
}


/**
 * Returns the ID of the scale value that is marked as proficient, if
 * there is only one. If there are none, or multiple it returns false
 *
 * @param integer $scaleid ID of the scale to check
 * @return integer|false The ID of the sole proficient scale value or false
 */
function competency_scale_only_proficient_value($scaleid) {
    global $CFG;
    $sql = "
        SELECT csv.id
        FROM {$CFG->prefix}comp_scale_values csv
        INNER JOIN (
            SELECT scaleid, SUM(proficient) AS sum
            FROM {$CFG->prefix}comp_scale_values
            GROUP BY scaleid
        ) count
        ON count.scaleid = csv.scaleid
        WHERE proficient = 1
            AND sum = 1
            AND csv.scaleid={$scaleid}";

    if($id = get_field_sql($sql)) {
        return $id;
    } else {
        return false;
    }
}


/**
 * Get competency scales available for use by frameworks
 *
 * @return  array|false
 */
function competency_scales_available() {
    global $CFG;

    $sql = "
        SELECT
            id,
            name
        FROM {$CFG->prefix}comp_scale scale
        WHERE EXISTS
        (
            SELECT
                1
            FROM
                {$CFG->prefix}comp_scale_values scaleval
            WHERE
                scaleval.scaleid = scale.id
        )
        ORDER BY
            name ASC
    ";

    return get_records_sql($sql);
}


/**
 * A function to display a table list of competency scales
 * @param array $scales the scales to display in the table
 * @return html
 */
function competency_scale_display_table($scales, $editingon=0) {
    global $CFG;

    $sitecontext = get_context_instance(CONTEXT_SYSTEM);

    // Cache permissions
    $can_edit = has_capability('moodle/local:updatecompetency', $sitecontext);
    $can_delete = has_capability('moodle/local:deletecompetency', $sitecontext);

    // Make sure user has capability to edit
    if (!(($can_edit || $can_delete) && $editingon)) {
        $editingon = 0;
    }

    $stredit = get_string('edit');
    $strdelete = get_string('delete');
    $stroptions = get_string('options','local');
    ///
    /// Build page
    ///

    if ($scales) {
        $table = new stdClass();
        $table->head  = array(get_string('scale'), get_string('used'));
        $table->size = array('70%', '20%');
        $table->align = array('left', 'center');
        $table->width = '95%';
        if ($editingon) {
            $table->head[] = $stroptions;
            $table->align[] = 'center';
            $table->size[] = '10%';
        }

        $table->data = array();
        foreach($scales as $scale) {
            $scale_used = competency_scale_is_used($scale->id);
            $scale_assigned = competency_scale_is_assigned($scale->id);
            $line = array();
            $line[] = "<a href=\"$CFG->wwwroot/hierarchy/type/competency/scale/view.php?id={$scale->id}&amp;type=competency\">".format_string($scale->name)."</a>";
            if ($scale_used) {
                $line[] = get_string('yes');
            } else if ($scale_assigned) {
                $line[] = get_string('assignedonly', 'competency');
            } else {
                $line[] = get_string('no');
            }

            $buttons = array();
            if ($editingon) {
                if ($can_edit) {
                    $buttons[] = "<a title=\"$stredit\" href=\"$CFG->wwwroot/hierarchy/type/competency/scale/edit.php?id=$scale->id&amp;type=competency\"><img".
                        " src=\"$CFG->pixpath/t/edit.gif\" class=\"iconsmall\" alt=\"$stredit\" /></a> ";
                }

                if ($can_delete) {
                    if($scale_used) {
                        $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeletecompetencyscaleinuse', 'competency') . "\" title=\"" . get_string('error:nodeletecompetencyscaleinuse', 'competency') . "\" /></a>";
                    } else if($scale_assigned) {
                        $buttons[] = "<img src=\"{$CFG->pixpath}/t/dismiss.gif\" class=\"iconsmall\" alt=\"" . get_string('error:nodeletecompetencyscaleassigned', 'competency') . "\" title=\"" . get_string('error:nodeletecompetencyscaleassigned', 'competency') . "\" /></a>";
                    } else {
                        $buttons[] = "<a title=\"$strdelete\" href=\"$CFG->wwwroot/hierarchy/type/competency/scale/delete.php?id=$scale->id&amp;type=competency\"><img".
                            " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
                    }
                }
                $line[] = implode($buttons, ' ');
            }

            $table->data[] = $line;
        }
    }

    print_heading(get_string('competencyscales', 'competency'));

    if ($scales) {
        print_table($table);
    } else {
        echo '<p>'.get_string('noscalesdefined', 'competency').'</p>';
    }

    echo '<div class="buttons">';
    print_single_button("$CFG->wwwroot/hierarchy/type/competency/scale/edit.php", array('type'=>'competency'), get_string('scalescustomcreate'));
    helpbutton('competencyscalesgeneral', get_string('competencyscales', 'competency'));
    echo '</div>';
}

?>
