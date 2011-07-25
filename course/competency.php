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
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');
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
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW
));

require_js(array(
    $CFG->wwwroot.'/local/js/course.competency.js.php?id='.$course->id,
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


echo '<div id="coursecompetency-table-container">';
echo $hierarchy->print_linked_evidence_list($id);
echo '</div>';

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
    <form action="<?php echo $CFG->wwwroot ?>/hierarchy/prefix/competency/course/add.php?id=<?php echo $id ?>" method="get">
        <div>
            <?php if (!empty($CFG->competencyuseresourcelevelevidence)) { ?>
                <input type="submit" id="show-coursecompetency-dialog" value="<?php echo get_string('addcourseevidencetocompetency', 'competency'); ?>" />
            <?php } else { ?>
                <input type="submit" id="show-coursecompetency-dialog" value="<?php echo get_string('assigncoursecompletiontocompetency', 'competency'); ?>" />
            <?php } ?>
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
