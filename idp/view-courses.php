<?php

require_once('lib.php');

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


function print_idp_courses_view_flex( $revision, $courses, $editingon=false, $page, $perpage, $total){
    global $CFG, $SESSION, $USER;
    $sort     = optional_param('sort');

    $addcourse = true;

    $str_remove = get_string('remove');
    $shortname = 'comptable';
    $columns = array();
    $headers = array();

    $columns[] = 'name';
    $headers[] = get_string('course');
    $columns[] = 'status';
    $headers[] = get_string('status', 'idp');

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
    $table->set_attribute('id', 'list-idpcourse');
    $table->set_attribute('class', 'generalbox idp-course');
    $table->define_columns($columns);
    $table->define_headers($headers);

    $table->setup();
    $table->pagesize($perpage, $total);
    $table->add_data(NULL);

    $priorities = idp_get_priority_scale_values_menu($revision->idp);

    if ($courses) {
        foreach ($courses as $course) {
            $tablerow = array();

            if(!isset($course->timestarted))
                $course->timestarted = 0;
            if(!isset($course->timeenrolled))
                $course->timeenrolled = 0;
            if(!isset($course->timecompleted))
                $course->timecompleted = 0;
            $statusstring = completion_completion::get_status($course);
            if(!$statusstring)
                $statusstring = 'notyetstarted';
            $status = get_string($statusstring, 'completion');

            $tablerow[] = "<a href=\"{$CFG->wwwroot}/course/view.php?id={$course->id}\">{$course->fullname}</a>";
            $tablerow[] = "<span class=\"completion-$statusstring\" title=\"$status\">$status</span>";
            if(get_config(NULL, 'idp_duedates')!=0){
                $duedatestr = $course->duedate == NULL ? '' : date('d/m/Y', $course->duedate );
                if ($editingon) {
                    $duedatecell = '<input size="10" maxlength="10" type="text" class="idpdate" value="'.$duedatestr.'"name="courseduedate['.$course->id.']" id="courseduedate'.$course->id.'"/>';
                } else {
                    if ((($course->duedate <= strtotime("+1 week")) && ($course->duedate >= strtotime("now"))) && !$course->timecompleted){
                        $duedatecell = '<font color="red">'.$duedatestr.'</font>';
                    }
                    else if ($course->duedate <= strtotime("+1 week") && !$course->timecompleted){
                        $duedatecell = '<font color="red"><b>'.$duedatestr.'</b></font>';
                    }
                    else {
                        $duedatecell = $duedatestr;
                    }
                }
                $tablerow[] = $duedatecell;
            }

            if(get_config(NULL, 'idp_priorities')==2) {
                if ($editingon) {
                    $prioritycell = '<select class="idppriority" name="comppriority['.$course->id.']" id="comppriority'.$course->id.'"/>';
                    foreach($priorities as $priority){
                        if($priority->id == $course->priority)
                            $prioritycell .= '<option value="'.$priority->id.'" selected="selected">'.$priority->name.'</option>';
                        else
                            $prioritycell .= '<option value="'.$priority->id.'">'.$priority->name.'</option>';
                    }
                    $prioritycell .= '</select>';
                    $tablerow[] = $prioritycell;
                }
                else {
                    $priority = get_field('idp_tmpl_priority_scal_val', 'name', 'id', $course->priority);
                    if($priority)
                        $tablerow[] = $priority;
                    else
                        $tablerow[] = 'No priority';
                }
            }

            if ($editingon) {
                $tablerow[] = "<a href=\"{$CFG->wwwroot}/hierarchy/type/course/idp/remove.php?id={$course->id}&revision={$revision->id}\" title=\"$str_remove\">".
                    "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
            }

            $table->add_data($tablerow);
        }
        $table->print_html();
    }
    else {
        echo '<i>'.get_string('emptyplancourses', 'idp').'</i>';
    }

    if($addcourse){
        echo '<br><input type="submit" id="show-idpcourse-dialog" value="' . get_string('addfromcategories', 'idp') . '" />';
        echo '<noscript><a href="'.$CFG->wwwroot.'/hierarchy/type/course/idp/add.php?id='.$revision->id .
            '&amp;nojs=1&amp;returnurl='.urlencode(qualified_me()).'&amp;s='.sesskey().'" class="noscript-button">'.get_string('addfromcategories','idp').'</a></noscript>';

        print helpbutton('idpaddcourses', get_string('addfromcategories', 'idp'));
    }

    echo "<script type=\"text/javascript\">
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
        </script>";
}
?>
