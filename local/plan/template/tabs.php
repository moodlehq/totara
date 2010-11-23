<?php

$id = required_param('id', PARAM_INT);
$edit = optional_param('edit', 'off', PARAM_TEXT);

if (!isset($currenttab)) {
    $currenttab = 'competencies';
}

$toprow = array();
$secondrow = array();
$activated = array();
$inactive = array();

// General Tab
$toprow[] = new tabobject('general', $CFG->wwwroot.'/local/plan/template/general.php?id='.$id, get_string('general', 'local_plan'));
if(substr($currenttab, 0, 7) == 'general'){
    $activated[] = 'general';
}

// Components Tab
$toprow[] = new tabobject('components', $CFG->wwwroot.'/local/plan/template/components.php?id='.$id, get_string('components', 'local_plan'));
if(substr($currenttab, 0, 10) == 'components'){
    $activated[] = 'components';
}

// Workflow Tab
$toprow[] = new tabobject('workflow', $CFG->wwwroot.'/local/plan/template/workflow.php?id='.$id, get_string('workflow', 'local_plan'));
if(substr($currenttab, 0, 8) == 'workflow'){
    $activated[] = 'workflow';
}
if($currenttab == 'workflowplan') {
    $secondrow[] = new tabobject('advancedworkflow', $CFG->wwwroot.'/local/plan/template/advancedworkflow.php?component=plan&amp;id='.$id, get_string('plan', 'local_plan'));
    // add one tab per active component
    if($components) {
        foreach($components as $component) {
            if(!$component->enabled) {
                continue;
            }
            $configsetting = get_config(null, 'dp_'.$component->component);
            $compname = $configsetting ? $configsetting : get_string($component->component.'_defaultname', 'local_plan');
            $secondrow[] = new tabobject('workflow'.$component->component, $CFG->wwwroot.'/local/plan/template/advancedworkflow.php?component='.$component->component.'&amp;id='.$id, $compname);
        }
    }
}

$tabs = array($toprow, $secondrow);

// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);

?>
