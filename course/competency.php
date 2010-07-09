<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com     //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

// View/add course competencies

require_once('../config.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');

// Get paramaters
$id = required_param('id', PARAM_INT);                  // course id

/// basic access control checks
if (!$id) {
    require_login();
    print_error('needcourseid');
}

// Courses only
if($id == SITEID){
    // don't allow editing of 'site course' using this from
    print_error('cannoteditsiteform');
}

if (!$course = get_record('course', 'id', $id)) {
    print_error('invalidcourseid');
}

$hierarchy = new competency();

$context = get_context_instance(CONTEXT_SYSTEM);

require_login($course->id);
require_capability('moodle/local:viewcompetency', $context);

// Can edit?
$can_edit = has_capability('moodle/local:updatecompetency', $context);


local_js(array(
    MBE_JS_DIALOG,
    MBE_JS_TREEVIEW
));

require_js(array(
    $CFG->wwwroot.'/local/js/course.competency.js.php',
));

$strcompetenciesusedincourse = get_string("competenciesusedincourse", 'competency');
$navlinks = array();

$navlinks[] = array('name' => $strcompetenciesusedincourse,
                    'link' => null,
                    'type' => 'misc');
$title = $strcompetenciesusedincourse;
$fullname = $course->fullname;

$navigation = build_navigation($navlinks);
print_header($title, $fullname, $navigation);
print_heading($strcompetenciesusedincourse);

?>
<script type="text/javascript">
    var course_id = '<?php echo $course->id ?>';
</script>

<table width="95%" cellpadding="5" cellspacing="1" id="list-coursecompetency" class="generalbox editcompetency boxaligncenter">
<tr>
    <th style="vertical-align:top; text-align: left; white-space:nowrap;" class="header c0" scope="col">
        <?php echo get_string('framework', 'competency'); ?>
    </th>

    <th style="vertical-align:top; text-align: left; white-space:nowrap;" class="header c1" scope="col">
        <?php echo get_string('depthlevel', 'competency'); ?>
    </th>

    <th style="vertical-align:top; text-align:left; white-space:nowrap;" class="header c2" scope="col">
        <?php echo get_string('name'); ?>
    </th>

    <th style="vertical-align:top; text-align:left; white-space:nowrap;" class="header c3" scope="col">
        <?php echo get_string('evidence', 'competency'); ?>
    </th>

<?php
    if ($can_edit) {
?>
    <th style="vertical-align:top; text-align:left; white-space:nowrap;" class="header c4" scope="col">
        <?php echo get_string('options', 'competency'); ?>
    </th>
<?php
    } // if ($can_edit)
?>
</tr>
<?php

// Get any competencies used in this course
$competencies = $hierarchy->get_course_evidence($course->id);
$oddeven = 0;
if ($competencies) {

    $str_remove = get_string('remove');

    $activities = array();

    foreach ($competencies as $competency) {

        echo '<tr class="r' . $oddeven . '">';
        echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/index.php?type=competency&frameworkid={$competency->fid}\">{$competency->framework}</a></td>";
        echo '<td>'.$competency->depth.'</td>';
        echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type=competency&id={$competency->id}\">{$competency->fullname}</a></td>";
        echo '<td>';

        // Create evidence object
        $evidence = new object();
        $evidence->id = $competency->evidenceid;
        $evidence->itemtype = $competency->evidencetype;
        $evidence->iteminstance = $competency->evidenceinstance;
        $evidence->itemmodule = $competency->evidencemodule;

        $evidence = competency_evidence_type::factory($evidence);

        echo $evidence->get_type();
        if ($evidence->itemtype == 'activitycompletion') {
            echo ' - '.$evidence->get_name();
        }

        echo '</td>';

        // Options column
        if ($can_edit) {
            echo '<td align="center">';
            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/evidenceitem/remove.php?id={$evidence->id}&course={$id}\" title=\"$str_remove\">".
                 "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";
            echo '</td>';
        }

        echo '</tr>';

        // for row striping
        $oddeven = $oddeven ? 0 : 1;
    }

} else {

    $cols = 4;
    echo '<tr class="noitems-coursecompetency"><td colspan="'.$cols.'"><i>'.get_string('nocoursecompetencies', 'competency').'</i></td></tr>';
}

echo '</table>';

if ($can_edit) {

    // Add course competencies button
?>

<div class="buttons">

<script type="text/javascript">
    <!-- //
    var course_id = '<?php echo $course->id ?>';
    // -->
</script>

<div class="singlebutton centerbutton">
    <form action="<?php echo $CFG->wwwroot ?>/hierarchy/type/competency/course/add.php?id=<?php echo $id ?>" method="get">
        <div>
            <input type="submit" id="show-coursecompetency-dialog" value="<?php echo get_string('addcourseevidencetocompetency', 'competency') ?>" />
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <input type="hidden" name="nojs" value="1">
            <input type="hidden" name="returnurl" value="<?php echo qualified_me(); ?>">
            <input type="hidden" name="s" value="<?php echo sesskey(); ?>">
        </div>
    </form>
</div>

</div>

<?php

}

echo '<br /><div class="buttons"><div class="centerbutton">';

$options = array('id'=>$id);
print_single_button(
    $CFG->wwwroot.'/course/view.php',
    $options,
    get_string('returntocourse', 'local'),
    'get'
);

echo '</div></div>';

print_footer($course);

?>
