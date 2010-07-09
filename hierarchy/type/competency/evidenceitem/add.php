<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/completionlib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once('HTML/AJAX/JSON.php');


///
/// Setup / loading data
///

// Competency id
$id = required_param('competency', PARAM_INT);
// Evidence type
$type = required_param('type', PARAM_TEXT);
// Evidence instance id
$instance = required_param('instance', PARAM_INT);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

// Load competency
if (!$competency = get_record('comp', 'id', $id)) {
    error('Competency ID was incorrect');
}

// Check type is available
$avail_types = array('coursecompletion', 'coursegrade', 'activitycompletion');

if (!in_array($type, $avail_types)) {
    die('type unavailable');
}

$data = new object();
$data->itemtype = $type;
$evidence = competency_evidence_type::factory($data);
$evidence->iteminstance = $instance;

$newevidenceid = $evidence->add($competency);

if($nojs) {
    // redirect for none JS version
    if($s == sesskey()) {
        $murl = new moodle_url($returnurl);
        $returnurl = $murl->out(false, array('nojs' => 1));
    } else {
        $returnurl = $CFG->wwwroot;
    }
    redirect($returnurl);
} else {
    // HTML to return for JS version

    // If $newevidenceid is false, it means the evidence item wasn't added, so
    // return nothing
    if ( $newevidenceid !== false ){

        echo '<tr>';
        echo '<td>'.$evidence->get_name().'</td>';
        echo '<td>'.$evidence->get_type().'</td>';
        echo '<td>'.$evidence->get_activity_type().'</td>';

        if (!empty($USER->competencyediting)) {

            $str_edit = get_string('edit');
            $str_remove = get_string('remove');

            echo "<td style=\"text-align: center;\">";

            echo "<a href=\"{$CFG->wwwroot}/hierarchy/type/competency/evidenceitem/remove.php?id={$evidence->id}\" title=\"$str_remove\">".
                 "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

            echo "</td>";
        }

        echo '</tr>';
    } else {
        echo '';
    }
}
