<?php
/**
 * A function to display a table list of competency areas
 * @param array $areas the competency areas to display in the table
 * @return html
 */
function comp_area_display_table($areas, $editingon=0, $templateid) {
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
    $strmoveup = get_string('moveup');
    $strmovedown = get_string('movedown');
    ///
    /// Build page
    ///

    if ($areas) {
        $table = new stdClass();
        $table->head  = array(get_string('name'), get_string('contents', 'idp'));
        $table->size = array('20%', '70%');
        $table->align = array('left', 'left');
        $table->width = '95%';
        if ($editingon) {
            $table->head[] = $stroptions;
            $table->align[] = array('center');
            $table->size[] = array('10%');
        }

        $table->data = array();
        $spacer = "<img src=\"{$CFG->wwwroot}/pix/spacer.gif\" class=\"iconsmall\" alt=\"\" />";
        $numvalues = count($areas);
        $count=0;
        foreach($areas as $area) {
            $count++;
            $line = array();
            $line[] = "<a href=\"$CFG->wwwroot/idp/comparea/edit.php?id={$area->id}\">".format_string($area->fullname)."</a>";

            if ($contents = get_comp_area_contents($area->id)) {
                $data = array();
                foreach($contents as $item){
                    $data[] = $item->name;
                }
                $line[] = implode('<br>', $data);
            } else {
                $line[] = '';
            }

            $buttons = array();
            if ($editingon) {
                if ($can_edit) {
                    $buttons[] = "<a title=\"$stredit\" href=\"$CFG->wwwroot/idp/comparea/edit.php?id=$area->id\"><img".
                        " src=\"$CFG->pixpath/t/edit.gif\" class=\"iconsmall\" alt=\"$stredit\" /></a> ";
                }

                if ($can_delete) {
                    $buttons[] = "<a title=\"$strdelete\" href=\"$CFG->wwwroot/idp/comparea/delete.php?id=$area->id\"><img".
                                " src=\"$CFG->pixpath/t/delete.gif\" class=\"iconsmall\" alt=\"$strdelete\" /></a> ";
                }

                // If value can be moved up
                if ($count > 1) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/idp/settings/index.php?id={$templateid}&moveup={$area->id}\" title=\"$strmoveup\">".
                        "<img src=\"{$CFG->pixpath}/t/up.gif\" class=\"iconsmall\" alt=\"$strmoveup\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }

                // If value can be moved down
                if ($count < $numvalues) {
                    $buttons[] = "<a href=\"{$CFG->wwwroot}/idp/settings/index.php?id={$templateid}&movedown={$area->id}\" title=\"$strmovedown\">".
                        "<img src=\"{$CFG->pixpath}/t/down.gif\" class=\"iconsmall\" alt=\"$strmovedown\" /></a>";
                } else {
                    $buttons[] = $spacer;
                }

                $line[] = implode($buttons, ' ');
            }
            $table->data[] = $line;
        }
    }

    print_heading(get_string('competencyareas', 'idp'));

    if ($areas) {
        print_table($table);
    } else {
        echo '<p>'.get_string('emptyplancompetencyareas', 'idp').'</p>';
    }

    echo '<div class="buttons">';
    print_single_button("$CFG->wwwroot/idp/comparea/edit.php", array('templateid' => $templateid), get_string('addcompetencyarea', 'idp'));
    echo '</div>';
}

function get_comp_area_contents ($areaid) {
    global $CFG;

    if($areaid){
        return $contents = get_records_sql('select fw.id, fw.fullname as name from '.$CFG->prefix.'idp_comp_area_fw ca JOIN '.$CFG->prefix.'comp_framework fw ON ca.frameworkid=fw.id WHERE ca.areaid='.$areaid);
    }
}
?>
