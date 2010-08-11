<?php

// assumes the report id variable has been set in the page

$id = required_param('id', PARAM_INT);
$comptype = optional_param('comptype', 'competencies', PARAM_TEXT);
$type = required_param('type', PARAM_TEXT);
$edit = optional_param('edit', 'off', PARAM_TEXT);

if (!isset($currenttab)) {
    $currenttab = 'competencies';
}

$toprow = array();
$secondrow = array();
$activated = array();
$inactive = array();

$frameworks = get_records('comp_framework', '', '', 'sortorder');
$toprow[] = new tabobject('competencies', $CFG->wwwroot.'/hierarchy/item/view.php?id=1&edit=.'.$edit.'&type=position&comptype=competencies', get_string('competencies', 'competency'));

if(substr($currenttab, 0, 12) == 'competencies'){
    foreach($frameworks as $framework){
        $secondrow[] = new tabobject('competencies'.$framework->id, $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type='.$type.'&framework='.$framework->id.'&comptype='.$comptype, $framework->fullname);
    }

    if(substr($currenttab, 0, 12) == 'competencies'){
        $comptab = substr($currenttab, 12);
        $activated[] = 'competencies'.$comptab;
    }

    $currenttab = 'competencies';
}

$toprow[] = new tabobject('comptemplates', $CFG->wwwroot.'/hierarchy/item/view.php?id=1&edit='.$edit.'&type=position&comptype=comptemplates', get_string('competencytemplates', 'competency'));
if(substr($currenttab, 0, 13) == 'comptemplates'){
    foreach($frameworks as $framework){
        $secondrow[] = new tabobject('comptemplates'.$framework->id, $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type='.$type.'&framework='.$framework->id.'&comptype='.$comptype, $framework->fullname);
    }

    if(substr($currenttab, 0, 13) == 'comptemplates'){
        $templatetab = substr($currenttab, 13);
        $activated[] = 'comptemplates'.$templatetab;
    }

    $currenttab = 'comptemplates';
}

$tabs = array($toprow, $secondrow);

print_heading(get_string('assignedcompetenciesandtemplates', 'competency'));
// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);

?>
