<?php

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}

// tab bar
$tabs = array();
$row = array();

// overview tab
$row[] = new tabobject(
    'courses',
    $CFG->wwwroot . '/local/plan/record/courses.php?' . $userstr .
    'status=' . $rolstatus,
    get_string($rolstatus.'courses', 'local_plan')
);
$row[] = new tabobject(
    'competencies',
    $CFG->wwwroot . '/local/plan/record/competencies.php?' . $userstr .
    'status=' . $rolstatus,
    get_string($rolstatus.'competencies', 'local_plan')
);
$row[] = new tabobject(
    'objectives',
    $CFG->wwwroot . '/local/plan/record/objectives.php?' . $userstr .
    'status=' . $rolstatus,
    get_string($rolstatus.'objectives', 'local_plan')
);
$tabs[] = $row;

echo print_tabs($tabs, $currenttab, null, null, true);
