<?php
/**
 * local/plan/priorityscales/lib.php
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
function dp_priority_scale_is_used($scaleid) {
    //TODO: Figure out if the scale is used
    return false;
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
            $count++;
            $line = array();

            $title = "<a href=\"$CFG->wwwroot/local/plan/priorityscales/view.php?id={$priority->id}\">".format_string($priority->name)."</a>";
            if ($count==1){
                $title .= ' ('.get_string('default').')';
            }
            $line[] = $title;

            if ( dp_priority_scale_is_used( $priority->id ) ) {
                $line[] = get_string('yes');
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
                    $buttons[] = "<a title=\"$strdelete\" href=\"$CFG->wwwroot/local/plan/priorityscales/index.php?delete=$priority->id\"><img".
                                " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
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
