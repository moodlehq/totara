<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');


///
/// Setup / loading data
///

// Plan id
$id = required_param('id', PARAM_INT);

// Competencies to add
$add = required_param('add', PARAM_SEQUENCE);

// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/hierarchy/course/idp/save.php');

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

    // Add idp course
    $idpcourse = new Object();
    $idpcourse->revision = $id;
    $idpcourse->course = $addition;
    $idpcourse->ctime = time();

    insert_record('idp_revision_course', $idpcourse);

    // Return html
    echo '<tr>';
    echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/framework/index.php?type={$hierarchy->prefix}&id={$framework->id}\">{$framework->fullname}</a></td>";
    echo "<td><a href=\"{$CFG->wwwroot}/hierarchy/item/view.php?type={$hierarchy->prefix}&id={$competency->id}\">{$competency->fullname}</a></td>";

//    if ($editingon) {
        echo "<td style=\"text-align: center;\">";

        echo "<a href=\"{$CFG->wwwroot}/{$hierarchy->prefix}/competency/remove.php?id={$competency->id}\" title=\"$str_remove\">".
             "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

        echo "</td>";
//    }

    echo '</tr>'.PHP_EOL;
}
