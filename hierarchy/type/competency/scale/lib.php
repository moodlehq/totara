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
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package MITMS
 */

/**
 * A function to determine whether a scale is in use or not. (In this context,
 * "in use" means that if we change this scale or its values, it'll cause
 * the data in the database to become corrupt)
 *
 * @param <type> $scaleid
 * @return boolean
 */
function competency_scale_is_used( $scaleid ){
    global $CFG;

    // Inner join the framework table to ignore any
    // old scale assignments from when deleting a
    // competency framework didn't delete related assignments
    $sql = "
        SELECT
            a.id
        FROM
            {$CFG->prefix}comp_scale_assignments a
        INNER JOIN
            {$CFG->prefix}comp_framework f
         ON f.id = a.frameworkid
        WHERE
            a.scaleid = {$scaleid}
    ";

    return (boolean) count_records_sql($sql);
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
            $table->align[] = array('center');
            $table->size[] = array('10%');
        }

        $table->data = array();
        foreach($scales as $scale) {
            $line = array();
            $line[] = "<a href=\"$CFG->wwwroot/hierarchy/type/competency/scale/view.php?id={$scale->id}&amp;type=competency\">".format_string($scale->name)."</a>";
            if ( competency_scale_is_used( $scale->id ) ) {
                $line[] = get_string('yes');
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
                    $buttons[] = "<a title=\"$strdelete\" href=\"$CFG->wwwroot/hierarchy/type/competency/scale/delete.php?id=$scale->id&amp;type=competency\"><img".
                                " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
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
    echo '</div>';
}

?>
