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

    ?>
    <table id="list-idpcompetencytemplate" class="generalbox planitems boxaligncenter">
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
                echo '<input size="10" maxlength="10" type="text" value="'.$duedatestr.'" name="comptempduedate['.$comptemp->id.']" id="comptempduedate'.$comptemp->id.'"/>';
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
        }

    } else {
        echo '<tr class="noitems-idpcompetencytemplate"><td colspan="'.$cols.'"><i>'.get_string('emptyplancompetencytemplates', 'idp').'</i></td></tr>';
    }

        echo '</tbody></table>';

        // Add competencies button
        if ($editingon) {

    ?>
    <table class="generalbox planbuttons boxaligncenter">
        <tr colspan="<?php echo $cols ?>">
            <td>
                <div class="singlebutton">
                <input type="submit" id="show-idpcompetencytemplate-dialog" value="<?php echo get_string('addfromframeworks', 'idp') ?>" />

        <?php
            // Only display add from position button if the user has positions assigned
            if ($haspositions) {
                echo '<input type="submit" id="show-idppositioncompetencytemplate-dialog" value="'.get_string('addfrompositions', 'idp').'" />';
            }
        ?>
                </div>
            </td>
        </tr>
    </table>
<script type="text/javascript">
<!-- //
var idp_competencytemplate_row_count = <?php echo $rowcount ?>

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
// -->
</script>
    <?php

        }
}
?>