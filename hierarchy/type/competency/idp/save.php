<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');


///
/// Setup / loading data
///

// Revision id
$revisionid = required_param('id', PARAM_INT);

// Courses to add
$rowcount = required_param('rowcount', PARAM_SEQUENCE);

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/idp/save.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Setup hierarchy object
$hierarchy = new competency();
$str_remove = get_string('remove');

///
/// Add competencies
///

// Parse input
$add = explode(',', $add);
$time = time();

foreach ($add as $addition) {
    // Check id
    if (!is_numeric($addition)) {
        error('Supplied bad data - non numeric id');
    }

    // Load competency
    $competency = $hierarchy->get_item($addition);

    // Load framework
    $framework = $hierarchy->get_framework($competency->frameworkid);

    // Add idp competency
    $idpcompetency = new Object();
    $idpcompetency->revision = $revisionid;
    $idpcompetency->competency = $competency->id;
    $idpcompetency->ctime = time();

    insert_record('idp_revision_competency', $idpcompetency);

    // Return html
    echo '<tr class=r'.$rowcount.'>';
    echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$hierarchy->prefix}&id={$framework->id}\">{$framework->fullname}</a></td>";
    echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$competency->id}\">{$competency->fullname}</a></td>";
    echo "<td></td>";
    echo "<td></td>";

//    if ($editingon) {
        echo "<td style=\"text-align: center;\">";

        echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/idp/remove.php?id={$competency->id}&revision={$revisionid}\" title=\"$str_remove\">".
             "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

        echo "</td>";
//    }

    echo '</tr>'.PHP_EOL;
    $rowcount = ($rowcount + 1) % 2;
}
