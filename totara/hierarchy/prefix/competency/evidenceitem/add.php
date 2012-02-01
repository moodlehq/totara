<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');
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

// Indicates whether current related items, not in $relidlist, should be deleted
$deleteexisting = optional_param('deleteexisting', 0, PARAM_BOOL);

if (empty($CFG->competencyuseresourcelevelevidence)) {

    // Updated course lists
    $idlist = optional_param('update', null, PARAM_SEQUENCE);
    if ($idlist == null) {
        $idlist = array();
    }
    else {
        $idlist = explode(',', $idlist);
    }
}

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);
$can_edit = has_capability('moodle/local:updatecompetency', $sitecontext);

// Load competency
if (!$competency = get_record('comp', 'id', $id)) {
    error('Competency ID was incorrect');
}

// Check type is available
$avail_types = array('coursecompletion', 'coursegrade', 'activitycompletion');

if (!in_array($type, $avail_types)) {
    die('type unavailable');
}

if (!empty($CFG->competencyuseresourcelevelevidence)) {
    $data = new object();
    $data->itemtype = $type;
    $evidence = competency_evidence_type::factory($data);
    $evidence->iteminstance = $instance;

    $newevidenceid = $evidence->add($competency);
}

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
    ///
    /// Delete removed courses (if specified)
    ///
    if ($deleteexisting && !empty($idlist)) {

        $assigned = get_records('comp_evidence_items', 'competencyid', $id);
        $assigned = !empty($assigned) ? $assigned : array();

        foreach ($assigned as $ritem) {
            if (!in_array($ritem->iteminstance, $idlist)){
                $data = new object();
                $data->id = $ritem->id;
                $data->itemtype = $ritem->itemtype;
                $evidence = competency_evidence_type::factory($data);
                $evidence->iteminstance = $ritem->iteminstance;
                $evidence->delete($competency);
            }
        }
    }

    // HTML to return for JS version
    if (empty($CFG->competencyuseresourcelevelevidence)) {
        foreach ($idlist as $instance) {
            $data = new object();
            $data->itemtype = $type;
            $evidence = competency_evidence_type::factory($data);
            $evidence->iteminstance = $instance;

            $newevidenceid = $evidence->add($competency);
        }

        $editingon = 1;
        $evidence = get_records('comp_evidence_items', 'competencyid', $id);
        $str_edit = get_string('edit');
        $str_remove = get_string('remove');
        $item = $competency;

        require $CFG->dirroot.'/hierarchy/prefix/competency/view-evidence.html';

    } else {  //resource-level evidence functionality
        $out = '';
        // If $newevidenceid is false, it means the evidence item wasn't added, so
        // return nothing
        if ( $newevidenceid !== false ){

            $out .= '<tr>';
            $out .= '<td>'.$evidence->get_name().'</td>';
            $out .= '<td>'.$evidence->get_type().'</td>';
            $out .= '<td>'.$evidence->get_activity_type().'</td>';

            if ($can_edit) {

                $str_edit = get_string('edit');
                $str_remove = get_string('remove');

                $out .= "<td style=\"text-align: center;\">";

                $out .= "<a href=\"{$CFG->wwwroot}/hierarchy/prefix/competency/evidenceitem/remove.php?id={$evidence->id}\" title=\"$str_remove\">".
                     "<img src=\"{$CFG->pixpath}/t/delete.gif\" class=\"iconsmall\" alt=\"$str_remove\" /></a>";

                $out .= "</td>";
            }

            $out .= '</tr>';
        } else {
            $out .= '';
        }
        echo $out;
    }
}
