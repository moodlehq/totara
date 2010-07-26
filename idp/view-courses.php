<?php

/**
 * Display the courses box for an IDP
 * todo: move this into idp/lib.php
 *
 * @param db_record $revision from the idp_revision table
 * @param array $courses
 * @param boolean $editingon
 */
function print_idp_courses_view( $revision, $courses, $editingon=false){

    global $CFG;

    // Display competencies
    echo "<h2>".get_string('courses')."</h2>";
    //print_heading(get_string('courses'));
    $str_remove = get_string('remove');

    ?>
    <table id="list-idpcourse" class="generalbox planitems boxaligncenter viewcourses">
    <thead>
    <tr>
        <th class="framework" scope="col">
            <?php echo get_string('category') ?>
        </th>

        <th class="name" scope="col">
            <?php echo get_string('course'); ?>
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
            <?php echo get_string('options', 'idp') ?>
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

    if ($courses) {

        foreach ($courses as $course) {

            //$class = '';
            if(!isset($course->timestarted))
                $course->timestarted = 0;
            if(!isset($course->timeenrolled))
                $course->timeenrolled = 0;
            if(!isset($course->timecompleted))
                $course->timecompleted = 0;
            $statusstring = completion_completion::get_status($course);
            $status = get_string($statusstring, 'completion');

            echo '<tr class=r'.$rowcount.'>';
            echo "<td class=\"category\"><a href=\"{$CFG->wwwroot}/course/category.php?id={$course->ccid}\">{$course->category}</a></td>";
            echo "<td class=\"course\"><a href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">{$course->fullname}</a></td>";
            echo "<td class=\"status\"><span class=\"completion-$statusstring\" title=\"$status\">$status</span></td>";
            if(get_config(NULL, 'idp_duedates')!=0){
                echo '<td width="25%">';
                $duedatestr = $course->duedate == NULL ? '' : date('d/m/Y', $course->duedate );
                if ($editingon) {
                    echo '<input size="10" maxlength="10" type="text" class="idpdate" value="'.$duedatestr.'"name="courseduedate['.$course->id.']" id="courseduedate'.$course->id.'"/>';

                } else {
                    if ((($course->duedate <= strtotime("+1 week")) && ($course->duedate >= strtotime("now"))) && !$course->timecompleted){
                        echo '<font color="red">'.$duedatestr.'</font>';
                    }
                    else if ($course->duedate <= strtotime("+1 week") && !$course->timecompleted){
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

                echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/course/idp/remove.php?id={$course->id}&revision={$revision->id}\" title=\"$str_remove\">".
                    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

                echo '</td>';
            }

            echo '</tr>';
            $rowcount = ($rowcount + 1) % 2;
        }

    } else {
        echo '<tr class="noitems-idpcourse"><td colspan="'.$cols.'"><i>'.get_string('emptyplancourses', 'idp').'</i></td></tr>';
    }

    echo '</tbody></table>';

    // Add courses button
    if ($editingon) {

    ?>
    <table class="generalbox planbuttons boxaligncenter">
        <tr class="noitems" colspan="<?php echo $cols ?>">
            <td>
                <div class="singlebutton">
                <input type="submit" id="show-idpcourse-dialog" value="<?php echo get_string('addfromcategories', 'idp') ?>" />
<?php
                echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/course/idp/add.php?id='.$revision->id .
                    '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfromcategories','idp').'</a></noscript>';

?>
                <?php print helpbutton('idpaddcourses', get_string('addfromcategories', 'idp')); ?>
                </div>
            </td>
        </tr>
    </table>
<script type="text/javascript">
<!-- //
var idp_course_row_count = <?php echo $rowcount ?>

$(function() {
    $('[id^=courseduedate]').datepicker(
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
