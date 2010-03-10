<?php

/**
 * Display the competencies box for an IDP
 * todo: move this into plan/lib.php
 *
 * @param db_record $revision from the idp_revision table
 * @param array $competencies
 * @param boolean $editingon
 */
function print_idp_competencies_view( $revision, $competencies, $editingon ){

    global $CFG;

    // Display competencies
    print_heading(get_string('competencies', 'competency'));
    $str_remove = get_string('remove');

?>
    <table id="list-idp-competencies" class="generalbox planitems boxaligncenter">
    <tr>
        <th class="framework" scope="col">
            <?php echo get_string('framework', 'local') ?>
        </th>

        <th class="name" scope="col">
            <?php echo get_string('competency', 'competency'); ?>
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
    <?php

        // # cols varies
        $cols = $editingon ? 5 : 4;

$rowcount=0;

    if ($competencies) {

        foreach ($competencies as $competency) {

        echo '<tr class=r'.$rowcount.'>';
            echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/index.php?type=competency&frameworkid={$competency->fid}\">{$competency->framework}</a></td>";
            echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$competency->id}\">{$competency->fullname}</a></td>";
            echo '<td>'.$competency->status.'</td>';
            echo '<td width="25%">';
            $duedatestr = $competency->duedate == NULL ? '' : date('d/m/Y', $competency->duedate );
            if ($editingon) {
                echo '<input size="10" maxlength="10" type="text" value="'.$duedatestr.'" name="compduedate['.$competency->id.']" id="compduedate'.$competency->id.'"/>';
            } else {
                // todo: make this work
                echo $duedatestr;
            }
            echo '</td>';

            if ($editingon) {
                echo '<td class="options">';

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/idp/remove.php?id={$competency->id}&revision={$revision->id}\" title=\"$str_remove\">".
                     "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

                echo '</td>';
            }

            echo '</tr>';
        $rowcount = ($rowcount + 1) % 2;
        }

    } else {
        echo '<tr class="noitems"><td colspan="'.$cols.'"><i>'.get_string('emptyplancompetencies', 'idp').'</i></td></tr>';
    }

        echo '</table>';

        // Add competencies button
        if ($editingon) {

    ?>
    <table class="generalbox planbuttons boxaligncenter">
        <tr class="noitems" colspan="<?php echo $cols ?>">
            <td>
                <div class="singlebutton">
                <form action="<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/idp/add.php?id=<?php echo $revision->id ?>" method="get">
                <input type="submit" id="show-idpcompetency-dialog" value="<?php echo get_string('addfromframeworks', 'idp') ?>" />
                <input type="submit" id="" value="<?php echo get_string('addfrompositions', 'idp') ?>" />
                </form></div>
            </td>
        </tr>
    </table>
<script type="text/javascript">
<!-- //
var idp_competency_row_count = <?php echo $rowcount ?>

$(function() {
    $('[id^=compduedate]').datepicker(
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