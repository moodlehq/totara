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
$toprow[] = new tabobject('competencies', $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type=position&comptype=competencies', get_string('competencies', 'competency'));

$assignedcounts = get_records_sql_menu("SELECT comp.frameworkid, COUNT(*)
                                        FROM {$CFG->prefix}pos_competencies poscomp
                                        INNER JOIN {$CFG->prefix}comp comp
                                        ON poscomp.competencyid=comp.id
                                        WHERE poscomp.positionid={$id}
                                        GROUP BY comp.frameworkid");

if(substr($currenttab, 0, 12) == 'competencies'){
/*    if($frameworks){
        foreach($frameworks as $framework){
            $count = isset($assignedcounts[$framework->id]) ? $assignedcounts[$framework->id] : 0;
            $secondrow[] = new tabobject('competencies'.$framework->id, $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type='.$type.'&framework='.$framework->id.'&comptype='.$comptype, $framework->fullname.'('.$count.')');
        }

        if(substr($currenttab, 0, 12) == 'competencies'){
            $comptab = substr($currenttab, 12);
            $activated[] = 'competencies'.$comptab;
        }
} */
    $currenttab = 'competencies';
}

/*$toprow[] = new tabobject('comptemplates', $CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&edit='.$edit.'&type=position&comptype=comptemplates', get_string('competencytemplates', 'competency'));
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

$tabs = array($toprow, $secondrow);

print_heading(get_string('assignedcompetencies', 'competency'));
// print out tabs
print_tabs($tabs, $currenttab, $inactive, $activated);

// print out the competency framework selector
$fwoptions = array();
echo '<div class="frameworkpicker">';
if (!empty($frameworks)) {
    foreach ($frameworks as $fw) {
        $count = isset($assignedcounts[$fw->id]) ? $assignedcounts[$fw->id] : 0;
        $fwoptions[$fw->id] = $fw->fullname . " ({$count})";
    }
    $fwoptions = count($fwoptions) > 1 ? array(0 => get_string('all')) + $fwoptions : $fwoptions;
    echo '<div style="text-align: right">';
    popup_form($CFG->wwwroot.'/hierarchy/item/view.php?id='.$id.'&amp;edit='.$edit.'&amp;type='.$type.'&amp;framework=', $fwoptions, 'switchframework', $fid, '', '', '', false, 'self', get_string('filterframework', 'hierarchy'));
    echo '</div>';
} else {
    echo get_string('noframeworks', 'competency');
}
echo '</div>';

?>
