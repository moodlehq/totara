<?php

require_once($CFG->libdir.'/tablelib.php');
require_once('lib.php');

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
    if(get_config(NULL, 'idp_priorities')==2){
        echo '<th class="priorities" scope="col">';
        echo get_string('priority', 'idp');
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
    if ($competencies) {
        foreach ($competencies as $competency) {
        echo '<tr>';
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
            if(get_config(NULL, 'idp_priorities')==2) {
                echo '<td width="25%" class="c4">';
                $priorities = idp_get_priority_scale_values_menu($revision->idp);
                if ($editingon) {
                    echo '<select class="idppriority" name="comppriority['.$competency->id.']" id="comppriority'.$competency->id.'">';
                    foreach($priorities as $priority){
                        if($priority->id == $competency->priority)
                            echo '<option value="'.$priority->id.'" selected="selected">'.$priority->name.'</option>';
                        else
                            echo '<option value="'.$priority->id.'">'.$priority->name.'</option>';
                    }
                    echo '</select>';
                }
                else {
                    $priority = get_field('idp_tmpl_priority_scal_val', 'name', 'id', $competency->priority);
                    if($priority)
                        echo $priority;
                    else
                        echo 'No priority';

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

/**
 * Display the competencies box for an IDP
 *
 * @param db_record $revision from the idp_revision table
 * @param array $competencies
 * @param boolean $editingon (optional)
 * @param boolean $haspositions (optional)
 * @param int $page page to display
 * @param int $perpage number of results perpage
 * @param int $total total results for page calculation
 */
function print_idp_competencies_view_flex($revision, $competencies, $editingon = false, $haspositions = false, $page, $perpage, $total) {
    global $CFG, $SESSION, $USER;
    $sort = optional_param('sort');

    $addcomp = false;
    $addpos = false;
    $update = false;
    //Check permissions
    if ($editingon) {
        $addcomp = has_capability('moodle/local:idpaddcompetency', get_context_instance(CONTEXT_SYSTEM));
        $update = has_capability('moodle/local:updatecompetency', get_context_instance(CONTEXT_SYSTEM));
    }

    if ($editingon && $haspositions) {
        $addpos = has_capability('moodle/local:idpaddcompetencyfrompos', get_context_instance(CONTEXT_SYSTEM));
    }

    $str_remove = get_string('remove');
    $shortname = 'comptable';
    $priorities = idp_get_priority_scale_values_menu($revision->idp);
    $columns = array();
    $headers = array();

    $columns[] = 'competency';
    $headers[] = get_string('competency', 'competency');
    $columns[] = 'status';
    $headers[] = get_string('status', 'idp');

    if(get_config(NULL, 'idp_duedates')!=0) {
        $columns[] = 'duedate';
        $headers[] = get_string('duedate', 'idp');
    }
    if(get_config(NULL, 'idp_priorities')==2 && (!empty($priorities))){
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
    $table->set_attribute('id', 'list-idpcompetency');
    $table->set_attribute('class', 'generalbox idp-'.$shortname);
    $table->column_class('options', 'options');
    $table->column_class('competency', 'competency');

    $table->setup();
    $table->pagesize($perpage, $total);

    if ($competencies) {
        foreach ($competencies as $competency) {
            $tablerow = array();
            $tablerow[] = "<a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$competency->id}\">{$competency->fullname}</a>";
            $statuscell = (isset($competency->status)?$competency->status:'<font color="gray">Not assessed</font>');
            $context = get_context_instance(CONTEXT_SYSTEM);
            $editstr = trim(get_string('edit'));
            $deletestr = trim(get_string('delete'));
            $addstr = trim(get_string('add'));
            if (($USER->id == $revision->userid && $update) || totara_is_manager($revision->userid) || has_capability('moodle/site:doanything',$context)){
                if (isset($competency->ceid)){
                    $editlink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/edit.php?id='.$competency->ceid.'&amp;s='.sesskey().
                        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$editstr.
                        '"><img src="'.$CFG->pixpath.'/t/edit.gif" class="iconsmall" alt="'.$editstr.'" /></a>';
                    $statuscell .= $editlink;
                    $deletelink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/delete.php?id='.$competency->ceid.'&amp;s='.sesskey().
                        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$deletestr.
                        '"><img src="'.$CFG->pixpath.'/t/delete.gif" class="iconsmall" alt="'.$deletestr.'" /></a>';
                    $statuscell .= $deletelink;
                }
                else{
                    $addlink = '<a href="'.$CFG->wwwroot.'/hierarchy/type/competency/evidence/add.php?userid='.$revision->userid.'&amp;competencyid='.$competency->id.'&amp;s='.sesskey().
                        '&amp;returnurl='.urlencode(qualified_me()).'" title="'.$addstr.
                        '"><img src="'.$CFG->pixpath.'/t/add.gif" class="iconsmall" alt="'.$addstr.'" /></a>';
                    $statuscell .= $addlink;
                }
            }
            $tablerow[] = $statuscell;

            if(get_config(NULL, 'idp_duedates')!=0){
                $duedatecell = '';
                $duedatestr = $competency->duedate == NULL ? '' : date('d/m/Y', $competency->duedate );
                if ($editingon && $update) {
                    $duedatecell .= '<input size="10" maxlength="10" type="text" class="idpdate" value="'.$duedatestr.'" name="compduedate['.$competency->id.']" id="compduedate'.$competency->id.'"/>';
                } else {
                    if((($competency->duedate <= strtotime("+1 week")) && ($competency->duedate >= strtotime("now")))  && (($competency->proficiency != $competency->proficientlevel) || !$competency->proficiency)){
                        $duedatecell .= '<font color="red">'.$duedatestr.'</font>';
                    }
                    else if(($competency->duedate <= strtotime("+1 week")) && (($competency->proficiency != $competency->proficientlevel) || !$competency->proficiency)){
                        $duedatecell .= '<font color="red"><b>'.$duedatestr.'</b></font>';
                    }
                    else {
                        $duedatecell .= $duedatestr;
                    }
                }
                $tablerow[] = $duedatecell;
            }
            if(get_config(NULL, 'idp_priorities')==2 && (!empty($priorities))){
                if ($editingon && $update) {
                    $prioritycell = '<select class="idppriority" name="comppriority['.$competency->id.']" id="comppriority'.$competency->id.'"/>';
                    $prioritycell .= '<option value=0>'. get_string('notspecifiedpriority', 'idp') . '</option>';
                    foreach($priorities as $priority){
                        if($priority->id == $competency->priority)
                            $prioritycell .= '<option value="'.$priority->id.'" selected="selected">'.$priority->name.'</option>';
                        else
                            $prioritycell .= '<option value="'.$priority->id.'">'.$priority->name.'</option>';
                    }
                    $prioritycell .= '</select>';
                    $tablerow[] = $prioritycell;
                }
                else {
                    $priority = get_field('idp_tmpl_priority_scal_val', 'name', 'id', $competency->priority);
                    if($priority)
                        $tablerow[] = $priority;
                    else
                        $tablerow[] = 'No priority';
                }
            }

            if ($editingon) {
                $tablerow[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/idp/remove.php?id={$competency->id}&revision={$revision->id}\" title=\"$str_remove\">".
                    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
            }
            $table->add_data($tablerow);
        }
        $table->print_html();
    }
    else {
        echo '<i>'.get_string('emptyplancompetenciesframework', 'idp').'</i>';
    }

    if ($editingon) {
        if ($addcomp) {
            echo '<br><input type="submit" id="show-idpcompetency-dialog" value="'.get_string('addfromframeworks', 'idp') .'" />';
            echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find.php?id='.$revision->id .
                '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfromframeworks','idp').'</a></noscript>';

            if ($haspositions && $addpos) {
                echo '<input type="submit" id="show-idppositioncompetency-dialog" value="'.get_string('addfrompositions', 'idp').'" />';
                echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/competency/idp/find-position.php?id='.$revision->id .
                    '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfrompositions','idp').'</a></noscript>';
            }

            print helpbutton('idpaddcompetencies', get_string('addcompetenciestoplan', 'idp'));
        }
    }

    echo "<script type=\"text/javascript\">
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
    </script>";
}
?>
