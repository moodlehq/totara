<?php
/**
 * local/plan/objectivescales/lib.php
 *
 * Library of functions related to idp priorities.
 *
 * @copyright Catalyst IT Limited
 * @author Alastair Munro
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package totara
 */

/**
 * A function to determine whether a priority is in use or not. (In this context,
 * "in use" means that if we change this priority or its values, it'll cause
 * the data in the database to become corrupt)
 *
 * @param <type> $priorityid
 * @return boolean
 */
function dp_objective_scale_is_used($scaleid) {
    // TODO: Figure out if the scale is used
    return false;
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
    $can_edit = has_capability('moodle/local:manageidppriorities', $sitecontext);
    $can_delete = has_capability('moodle/local:manageidppriorities', $sitecontext);

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
        foreach($objectives as $objective) {
            $line = array();
            $line[] = "<a href=\"$CFG->wwwroot/local/plan/objectivescales/view.php?id={$objective->id}\">".format_string($objective->name)."</a>";
            if ( dp_objective_scale_is_used( $objective->id ) ) {
                $line[] = get_string('yes');
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
                    $buttons[] = "<a title=\"$strdelete\" href=\"$CFG->wwwroot/local/plan/objectivescales/index.php?delete=$objective->id\"><img".
                                " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
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
?>
