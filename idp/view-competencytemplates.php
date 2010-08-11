<?php
/**
 * Display the competency templates box for an IDP
 * todo: move this into idp/lib.php
 *
 * @param db_record $revision from the idp_revision table
 * @param array $competencytemplates
 * @param boolean $editingon (optional)
 * @param boolean $haspositions (optional)
 */
function print_idp_competency_templates_view( $revision, $competencytemplates, $editingon = false, $haspositions = false){

    global $CFG;

    // Display competencies
    print_heading(get_string('competencytemplates', 'competency'));
    $str_remove = get_string('remove');

    // Check permissions
    if ($editingon) {
        $addcomp = has_capability('moodle/local:idpaddcompetencytemplate', get_context_instance(CONTEXT_SYSTEM));
    }

    if ($editingon && $haspositions) {
        $addpos = has_capability('moodle/local:idpaddcompetencytemplatefrompos', get_context_instance(CONTEXT_SYSTEM));
    }
?>
    <table id="list-idpcompetencytemplate" class="generalbox planitems boxaligncenter list-idppositioncompetencytemplate">
    <thead>
    <tr>
        <th class="framework" scope="col">
            <?php echo get_string('framework', 'local') ?>
        </th>

        <th class="name" scope="col">
            <?php echo get_string('template', 'local'); ?>
        </th>

        <th class="status" scope="col">
            <?php echo get_string('status', 'idp') ?>
        </th>

        <th class="duedate" scope="col">
            <?php echo get_string('duedate', 'idp') ?>
        </th>

    <?php
        if ($editingon) {
    ?>
        <th class="options" scope="col">
            <?php echo get_string('options', 'competency') ?>
        </th>
    <?php
        }
    ?>
    </tr>
    </thead>
    <tbody>
    <?php

        // # cols varies
        $cols = $editingon ? 5 : 4;

$rowcount=0;

    if ($competencytemplates) {

        foreach ($competencytemplates as $comptemp) {

        echo '<tr class=r'.$rowcount.'>';
        echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/index.php?type=competency&frameworkid={$comptemp->fid}\">{$comptemp->framework}</a></td>";
        echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/view.php?id={$comptemp->id}\">{$comptemp->fullname}</a></td>";
            echo "<td></td>";
            echo '<td width="25%">';
            $duedatestr = $comptemp->duedate == NULL ? '' : date('d/m/Y', $comptemp->duedate );
            if ($editingon ){
                echo '<input size="10" maxlength="10" type="text" class="idpdate" value="'.$duedatestr.'" name="comptempduedate['.$comptemp->id.']" id="comptempduedate'.$comptemp->id.'"/>';
            } else {
                echo $duedatestr;
            }
            echo '</td>';

            if ($editingon) {
                echo '<td class="options">';

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/idp/remove.php?id={$comptemp->id}&revision={$revision->id}\" title=\"$str_remove\">".
                     "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

                echo '</td>';
            }

            echo '</tr>';
            $rowcount = ($rowcount + 1) % 2;

            $hierachy = new competency();
            if($competencies = idp_get_assigned_to_comptemplate($comptemp->id, $revision->userid)){
                foreach ($competencies as $comp){
                    echo '<tr>';
                    echo "<td colspan=2>$comp->competency</td>";
                    if(isset($comp->status)){
                        echo "<td>$comp->status</td>";
                    } else {
                        echo '<td></td>';
                    }
                    echo '<td><input size="10" maxlength="10" type="text" value="" class="idpdate" name="comptempitemduedate['.$comp->id.']" id="comptempitemduedate'.$comp->id.'"/></td>';
                    echo'</tr>';
                }
            }
        }

    } else {
        echo '<tr class="noitems-idpcompetencytemplate noitems-idppositioncompetencytemplate"><td colspan="'.$cols.'"><i>'.get_string('emptyplancompetencytemplates', 'idp').'</i></td></tr>';
    }

        echo '</tbody></table>';

        // Add competencies button
        if ($editingon) {

            if ($addcomp) {
    ?>
    <table class="generalbox planbuttons boxaligncenter">
        <tr colspan="<?php echo $cols ?>">
            <td>
                <div class="singlebutton">
                <input type="submit" id="show-idpcompetencytemplate-dialog" value="<?php echo get_string('addfromframeworks', 'idp') ?>" />
<?php
                echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find-template.php?id='.$revision->id .
                    '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfromframeworks','idp').'</a></noscript>';
            }

            // Only display add from position button if the user has positions assigned
            if ($haspositions && $addpos) {
                echo '<input type="submit" id="show-idppositioncompetencytemplate-dialog" value="'.get_string('addfrompositions', 'idp').'" />';
                echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find-position-template.php?id='.$revision->id .
                    '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfrompositions','idp').'</a></noscript>';
            }
        ?>
                <?php print helpbutton('idpaddcompetencytemplates', get_string('addcompetencytemplatestoplan', 'idp')); ?>
                </div>
            </td>
        </tr>
    </table>
<script type="text/javascript">
<!-- //
var idp_competencytemplate_row_count = <?php echo $rowcount ?>

$(function() {
    $('[id^=comptempduedate],[id^=comptempitemduedate]').datepicker(
        {
            dateFormat: 'dd/mm/yy',
            showOn: 'button',
            buttonImage: '../local/js/images/calendar.gif',
            buttonImageOnly: true
        }
    );
    });
// -->
</script>
    <?php
        }
}

function print_idp_competency_templates_view_flex( $revision, $competencytemplates, $editingon = false, $haspositions = false, $page, $perpage, $total){
    global $CFG, $SESSION, $USER;
    $ssort = optional_param('ssort');

    // Check permissions
    if ($editingon) {
        $addcomp = has_capability('moodle/local:idpaddcompetencytemplate', get_context_instance(CONTEXT_SYSTEM));
        $update = has_capability('moodle/local:updatecompetencytemplate', get_context_instance(CONTEXT_SYSTEM));
    }
    if ($editingon && $haspositions) {
        $addpos = has_capability('moodle/local:idpaddcompetencytemplatefrompos', get_context_instance(CONTEXT_SYSTEM));
    }

    $str_remove = get_string('remove');
    $shortname = 'comptemplate';
    $columns = array();
    $headers = array();

    $columns[] = 'competency';
    $headers[] = get_string('template', 'competency');

    if(get_config(NULL, 'idp_duedates')!=0){
        $columns[] = 'duedate';
        $headers[] = get_string('duedate', 'idp');
    }
    if(get_config(NULL, 'idp_priorities')==2){
        $columns[] = 'priority';
        $headers[] = get_string('priority', 'idp');
    }
    if($editingon){
        $columns[] = 'options';
        $headers[] = get_string('options', 'competency');
    }

    $table = new flexible_table($shortname);
    $table->define_columns($columns);
    $table->define_headers($headers);
    $table->set_attribute('id', 'list-idpcompetencytemplate');
    $table->set_attribute('class', 'generalbox idp-comptemplate');
    $table->column_class('options', 'options');
    $table->column_class('competency', 'competency');
    $table->column_class('status', 'status');

    $table->setup();
    $table->pagesize($perpage, count($competencytemplates));
    $table->add_data(NULL);

    $priorities = idp_get_priority_scale_values_menu($revision->idp);

    if ($competencytemplates) {
        foreach ($competencytemplates as $comptemp) {
            $tablerow = array();
            $tablerow[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/view.php?id={$comptemp->id}\">{$comptemp->fullname}</a>";

            if(get_config(NULL, 'idp_duedates')!=0){
                $duedatestr = $comptemp->duedate == NULL ? '' : date('d/m/Y', $comptemp->duedate );
                if ($editingon && $update){
                    $duedatecell = '<input size="10" maxlength="10" type="text" class="idpdate" value="'.$duedatestr.'" name="comptempduedate['.$comptemp->id.']" id="comptempduedate'.$comptemp->id.'"/>';
                } else {
                    $duedatecell = $duedatestr;
                }
                $tablerow[] = $duedatecell;
            }

            if(get_config(NULL, 'idp_priorities')==2) {
                if ($editingon && $update) {
                    $prioritycell = '<select class="idppriority" name="comppriority['.$comptemp->id.']" id="comppriority'.$comptemp->id.'"/>';
                    foreach($priorities as $priority){
                        if($priority->id == $comptemp->priority)
                            $prioritycell .= '<option value="'.$priority->id.'" selected="selected">'.$priority->name.'</option>';
                        else
                            $prioritycell .= '<option value="'.$priority->id.'">'.$priority->name.'</option>';
                    }
                    $prioritycell .= '</select>';
                    $tablerow[] = $prioritycell;
                }
                else {
                    $priority = get_field('idp_tmpl_priority_scal_val', 'name', 'id', $comptemp->priority);
                    if($priority)
                        $tablerow[] = $priority;
                    else
                        $tablerow[] = 'No priority';
                }
            }

            if ($editingon) {
                $tablerow[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/template/idp/remove.php?id={$comptemp->id}&revision={$revision->id}\" title=\"$str_remove\">".
                    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
            }
            $table->add_data($tablerow);
        }
        $table->print_html();
    }
    else {
        echo '<p><i>'.get_string('emptyplancompetencytemplatesframework', 'idp').'</i></p>';
    }

    if ($editingon) {
        if ($addcomp) {
            echo '<input type="submit" id="show-idpcompetencytemplate-dialog" value="'. get_string('addfromframeworks', 'idp') . '" />';
            echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find-template.php?id='.$revision->id .
                '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfromframeworks','idp').'</a></noscript>';

            // Only display add from position button if the user has positions assigned
            if ($haspositions && $addpos) {
                echo '<input type="submit" id="show-idppositioncompetencytemplate-dialog" value="'.get_string('addfrompositions', 'idp').'" />';
                echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find-position-template.php?id='.$revision->id .
                    '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfrompositions','idp').'</a></noscript>';
            }

            print helpbutton('idpaddcompetencytemplates', get_string('addcompetencytemplatestoplan', 'idp'));
        }
    }

    echo "<script type=\"text/javascript\">
        $(function() {
            $('[id^=comptempduedate]').datepicker(
                {
                dateFormat: 'dd/mm/yy',
                showOn: 'button',
                buttonImage: '../local/js/images/calendar.gif',
                buttonImageOnly: true
                }
            );
        });
    </script>";
}

?>
