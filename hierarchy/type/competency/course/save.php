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
if (!empty($CFG->competencyuseresourcelevelevidence)) {
    // Only assigning one competency
    $idlist = required_param('competency', PARAM_INT);
    $idlist = array($idlist);
} else {
    // Competencies list
    $idlist = optional_param('update', null, PARAM_SEQUENCE);
    if ($idlist == null) {
        $idlist = array();
    }
    else {
        $idlist = explode(',', $idlist);
    }
}

// Evidence type
$type = required_param('type', PARAM_TEXT);
// Evidence instance id
$instance = required_param('instance', PARAM_INT);
// Id of the course to return to
$courseid = optional_param('course', 0, PARAM_INT);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// Indicates whether current related items, not in $relidlist, should be deleted
$deleteexisting = optional_param('deleteexisting', 0, PARAM_BOOL);

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);


$hierarchy = new competency();


///
/// Save the latest list
///
$rowclass = 'r1';
foreach ($idlist as $id) {
    // Load competency
    if (!$competency = $hierarchy->get_item($id)) {
        print_error('Competency ID was incorrect');
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
}

///
/// Delete removed items (if specified)
///
if ($deleteexisting) {

    $oldassigned = $hierarchy->get_course_evidence($courseid);
    $oldassigned = !empty($oldassigned) ? $oldassigned : array();

    $assignedcomps = array();
    foreach ($oldassigned as $i => $o) {
        // competencyid => evidenceitemid
        $assignedcomps[$o->id] = $i;
    }

    $removeditems = array_diff(array_keys($assignedcomps), $idlist);

    foreach ($removeditems as $ritem) {
        // Load competency
        if (!$competency = get_record('comp', 'id', $oldassigned[$assignedcomps[$ritem]]->id)) {
            print_rerror('Could not update items - competency ID was incorrect');
        }

        $item = competency_evidence_type::factory($assignedcomps[$ritem]);

        $item->delete($competency);
    }
}

if($nojs) {
    // redirect back to original page for none JS version
    if($s == sesskey()) {
        $murl = new moodle_url($returnurl);
        $returnurl = $murl->out(false, array('nojs' => 1));
    } else {
        $returnurl = $CFG->wwwroot;
    }
    redirect($returnurl);
} else {
    echo $hierarchy->print_linked_evidence_list($courseid);
}
