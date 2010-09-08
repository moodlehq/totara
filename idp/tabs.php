<?php

$id = required_param('id', PARAM_INT);
$type = optional_param('type', 'competencies', PARAM_ALPHA);
$edit = optional_param('edit', 'off', PARAM_TEXT);

$defaultframeworkid = get_field_sql("SELECT id FROM {$CFG->prefix}comp_framework ORDER BY sortorder ASC");
$frameworkid = optional_param('framework', $defaultframeworkid, PARAM_INT);

if (!isset($currenttab)) {
    $currenttab = 'competencies';
}

$toprow = array();
$secondrow = array();
$activated = array();
$inactive = array();

$frameworks = get_records('comp_framework', '', '', 'sortorder');
$toprow[] = new tabobject('competencies', $CFG->wwwroot.'/idp/revision.php?id='.$id.'&edit='.$edit.'&type=competencies', get_string('competencies', 'competency'));

if(substr($currenttab, 0, 12) == 'competencies'){
    if($frameworks){
        foreach($frameworks as $framework){
            $secondrow[] = new tabobject('competencies'.$framework->id, $CFG->wwwroot.'/idp/revision.php?id='.$id.'&edit='.$edit.'&type='.$type.'&framework='.$framework->id, $framework->fullname);
        }

        if(substr($currenttab, 0, 12) == 'competencies'){
            $comptab = substr($currenttab, 12);
            $activated[] = 'competencies'.$comptab;
        }
    }
    $currenttab = 'competencies';
}

$toprow[] = new tabobject('comptemplates', $CFG->wwwroot.'/idp/revision.php?id='.$id.'&edit='.$edit.'&type=comptemplates', get_string('competencytemplates', 'competency'));
if(substr($currenttab, 0, 13) == 'comptemplates'){
    if($frameworks){
        foreach($frameworks as $framework){
            $secondrow[] = new tabobject('comptemplates'.$framework->id, $CFG->wwwroot.'/idp/revision.php?id='.$id.'&edit='.$edit.'&type='.$type.'&framework='.$framework->id, $framework->fullname);
        }
        if(substr($currenttab, 0, 13) == 'comptemplates'){
            $templatetab = substr($currenttab, 13);
            $activated[] = 'comptemplates'.$templatetab;
        }
    }
    $currenttab = 'comptemplates';
}

$toprow[] = new tabobject('courses', $CFG->wwwroot.'/idp/revision.php?id='.$id.'&edit='.$edit.'&type=courses', get_string('courses'));
if(substr($currenttab, 0, 7) == 'courses'){
    $currenttab = 'courses';
}

$tabs = array($toprow, $secondrow);

// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);

?>
