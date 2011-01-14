<?php

$coursename = get_config(null, 'dp_course');
$coursename = $coursename ?
    $coursename : get_string('courseplural', 'local_plan');

$competencyname = get_config(null, 'dp_competency');
$competencyname = $competencyname ?
    $competencyname : get_string('competencyplural', 'local_plan');

$objectivename = get_config(null, 'dp_objective');
$objectivename = $objectivename ?
    $objectivename : get_string('objectiveplural', 'local_plan');

// tab bar
$tabs = array();
$row = array();

// overview tab
$row[] = new tabobject(
    'courses',
    $CFG->wwwroot . '/local/plan/record/courses.php?' . $userstr .
    'status=' . $planstatus,
    "{$ustatus} " . $coursename
);
$row[] = new tabobject(
    'competencies',
    $CFG->wwwroot . '/local/plan/record/competencies.php?' . $userstr .
    'status=' . $planstatus,
    "{$ustatus} " . $competencyname
);
$row[] = new tabobject(
    'objectives',
    $CFG->wwwroot . '/local/plan/record/objectives.php?' . $userstr .
    'status=' . $planstatus,
    "{$ustatus} " . $objectivename
);
$tabs[] = $row;

echo print_tabs($tabs, $currenttab, null, null, true);
