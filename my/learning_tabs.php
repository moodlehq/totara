<?php
if(empty($id)) {
    error('You cannot call this script in that way');
}
if (!isset($currenttab)) {
    $currenttab = '';
}

$tabs = array();
$row = array();
$activated = array();
$inactive = array();

$row[] = new tabobject('competency_evidence', "$CFG->wwwroot/local/plan/record/courses.php?userid=$id",
                           get_string('competencies', 'competency'));
$row[] = new tabobject('course_completions', "$CFG->wwwroot/my/coursecompletions.php?id=$id",
                           get_string('courses'));
$tabs[] = $row;

$activated[] = $currenttab;
print_tabs($tabs, $currenttab);

