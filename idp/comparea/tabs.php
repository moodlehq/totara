<?php

// assumes the report id variable has been set in the page

if (!isset($currenttab)) {
    $currenttab = 'general';
}

$tabs = array();
$row = array();
$activated = array();
$inactive = array();

$row[] = new tabobject('general',$CFG->wwwroot.'/idp/comparea/edit.php', get_string('general'));
/*$row[] = new tabobject('population',$CFG->wwwroot.'/idp/comparea/population.php', get_string('population','idp'));
$row[] = new tabobject('completedby',$CFG->wwwroot.'/idp/comparea/completed.php', get_string('completedby','idp'));
$row[] = new tabobject('commentby',$CFG->wwwroot.'/idp/comparea/comments.php', get_string('commentsby','idp'));
$row[] = new tabobject('duedates',$CFG->wwwroot.'/idp/comparea/duedates.php', get_string('duedates','idp'));*/
//$row[] = new tabobject('priorities',$CFG->wwwroot.'/idp/comparea/priority.php', get_string('priorities','idp'));

$tabs[] = $row;
$activated[] = $currenttab;

// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);
