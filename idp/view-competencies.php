<?php

/**
 * Display the competencies box for an IDP
 *
 * @param db_record $revision from the idp_revision table
 * @param array $competencies
 * @param boolean $editingon (optional)
 * @param boolean $haspositions (optional)
 */
function print_idp_competencies_view($revision, $competencies, $editingon = false, $haspositions = false) {

    global $CFG,$USER;

    // Display competencies
    echo "<h2>".get_string('competencies', 'competency')."</h2>";
    //print_heading(get_string('competencies', 'competency'));
    $str_remove = get_string('remove');

    // Check permissions
    if ($editingon) {
        $addcomp = has_capability('moodle/local:idpaddcompetency', get_context_instance(CONTEXT_SYSTEM));
    }

    if ($editingon && $haspositions) {
        $addpos = has_capability('moodle/local:idpaddcompetencyfrompos', get_context_instance(CONTEXT_SYSTEM));
    }
?>
    <table id="list-idpcompetency" class="list-idppositioncompetency generalbox planitems boxaligncenter">
    <thead>
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
<?php
    if(get_config(NULL, 'idp_duedates')!=0){
        echo '<th class="duedate" scope="col">';
        echo get_string('duedate', 'idp');
        echo '</th>';
    }
?>


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

    if ($competencies) {

        foreach ($competencies as $competency) {

        echo '<tr class=r'.$rowcount.'>';
            echo "<td class=\"c0\"><a href=\"{$CFG->wwwroot}/hierarchy/index.php?type=competency&frameworkid={$competency->fid}\">{$competency->framework}</a></td>";
            echo "<td class=\"c1\"><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$competency->id}\">{$competency->fullname}</a></td>";
            echo '<td class="c2">'.(isset($competency->status)?$competency->status:'<font color="grey">Not assessed</font>');
            $context = get_context_instance(CONTEXT_SYSTEM);
            $editstr = trim(get_string('edit'));
            $deletestr = trim(get_string('delete'));
            $addstr = trim(get_string('add'));
            if (($USER->id == $revision->userid && has_capability('moodle/local:updatecompetency',$context)) || totara_is_manager($revision->userid) || has_capability('moodle/site:doanything',$context)){
                if (isset($competency->ceid)){
                    $editlink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/edit.php?id='.$competency->ceid.'&amp;s='.sesskey().
                        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$editstr.
                        '"><img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$editstr.'" /></a>';
                    echo $editlink;
                    $deletelink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/delete.php?id='.$competency->ceid.'&amp;s='.sesskey().
                        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$deletestr.
                        '"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$deletestr.'" /></a>';
                    echo $deletelink;
                }
                else{
                    $addlink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/add.php?userid='.$revision->userid.'&amp;competencyid='.$competency->id.'&amp;s='.sesskey().
                        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$addstr.
                        '"><img src="'.$CFG->pixpath.'/t/add.gif" class="iconsmall" alt="'.$addstr.'" /></a>';
                    echo $addlink;
                }
            }

            echo '</td>';
            if(get_config(NULL, 'idp_duedates')!=0){
                echo '<td width="25%" class="c3">';
                $duedatestr = $competency->duedate == NULL ? '' : date('d/m/Y', $competency->duedate );
                if ($editingon) {
                    echo '<input size="10" maxlength="10" type="text" class="idpdate" value="'.$duedatestr.'" name="compduedate['.$competency->id.']" id="compduedate'.$competency->id.'"/>';
                } else {
                    if((($competency->duedate <= strtotime("+1 week")) && ($competency->duedate >= strtotime("now")))  && (($competency->proficiency != $competency->proficientlevel) || !$competency->proficiency)){
                        echo '<font color="red">'.$duedatestr.'</font>';
                    }
                    else if(($competency->duedate <= strtotime("+1 week")) && (($competency->proficiency != $competency->proficientlevel) || !$competency->proficiency)){
                        echo '<font color="red"><b>'.$duedatestr.'</b></font>';
                    }
                    else {
                        echo $duedatestr;
                    }
                }
                echo '</td>';
            }

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
        echo '<tr class="noitems-idpcompetency noitems-idppositioncompetency"><td colspan="'.$cols.'"><i>'.get_string('emptyplancompetencies', 'idp').'</i></td></tr>';
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
                <input type="submit" id="show-idpcompetency-dialog" value="<?php echo get_string('addfromframeworks', 'idp') ?>" />
                <?php
                echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find.php?id='.$revision->id .
                    '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfromframeworks','idp').'</a></noscript>';
                ?>
    <?php
            }

            // Only display add from position button if the user has positions assigned
            if ($haspositions && $addpos) {
                echo '<input type="submit" id="show-idppositioncompetency-dialog" value="'.get_string('addfrompositions', 'idp').'" />';
                echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find-position.php?id='.$revision->id .
                    '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfrompositions','idp').'</a></noscript>';
            }
        ?>
                <?php print helpbutton('idpaddcompetencies', get_string('addcompetenciestoplan', 'idp')); ?>
                </div>
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
