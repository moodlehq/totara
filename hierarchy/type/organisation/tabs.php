<?php

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
$toprow[] = new tabobject('competencies', $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type=organisation&comptype=competencies', get_string('competencies', 'competency'));

$assignedcounts = get_records_sql_menu("SELECT comp.frameworkid, COUNT(*) from {$CFG->prefix}org_competencies orgcomp JOIN {$CFG->prefix}comp comp ON orgcomp.competencyid=comp.id where orgcomp.organisationid={$id} GROUP BY comp.frameworkid");


if(substr($currenttab, 0, 12) == 'competencies'){
    /*
    if($frameworks){
        foreach($frameworks as $framework){
            $count = isset($assignedcounts[$framework->id]) ? $assignedcounts[$framework->id] : 0;
            $secondrow[] = new tabobject('competencies'.$framework->id, $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type='.$type.'&framework='.$framework->id.'&comptype='.$comptype, $framework->fullname.'('.$count.')');
        }

        if(substr($currenttab, 0, 12) == 'competencies'){
            $comptab = substr($currenttab, 12);
            $activated[] = 'competencies'.$comptab;
        }
    }
    */
    $currenttab = 'competencies';
}


/*$toprow[] = new tabobject('comptemplates', $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type=organisation&comptype=comptemplates', get_string('competencytemplates', 'competency'));
if(substr($currenttab, 0, 13) == 'comptemplates'){
    if($frameworks){
        foreach($frameworks as $framework){
            $secondrow[] = new tabobject('comptemplates'.$framework->id, $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type='.$type.'&framework='.$framework->id.'&comptype='.$comptype, $framework->fullname);
        }

        if(substr($currenttab, 0, 13) == 'comptemplates'){
            $templatetab = substr($currenttab, 13);
            $activated[] = 'comptemplates'.$templatetab;
        }
    }
    $currenttab = 'comptemplates';
}*/

$tabs = array($toprow);

print_heading(get_string('assignedcompetencies', 'competency'));
// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);

// print out the competency framework selector
$fwoptions = array();
echo '<div class="frameworkpicker">';
foreach ($frameworks as $fw) {
    $fwoptions[$fw->id] = $fw->fullname;
}
popup_form($CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&amp;edit='.$edit.'&amp;type='.$type.'&amp;framework=', $fwoptions, 'switchframework', $fid, '', '', '', false, 'self', get_string('switchframework', 'hierarchy'));
echo '</div>';

?>
