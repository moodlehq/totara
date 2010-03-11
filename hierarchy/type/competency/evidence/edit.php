<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/setup.php');
require_once('competency_evidence_form.php');
///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$type = optional_param('type', -1, PARAM_INT);
$returnurl = optional_param('returnurl', $CFG->wwwroot, PARAM_TEXT);
$s = optional_param('s', null, PARAM_TEXT);

// only redirect back if we are sure that's where they came from
if($s != sesskey()) {
    $returnurl = $CFG->wwwroot;
}

// Check perms
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if (!$competencyevidence = get_record('competency_evidence', 'id', $id)) {
    error('Competency Evidence ID was incorrect');
}

if (!$competency = get_record('competency', 'id', $competencyevidence->competencyid)) {
    error('Competency ID was incorrect');
}

// Load framework
if (!$framework = get_record('competency_framework', 'id', $competency->frameworkid)) {
    error('Competency framework could not be found');
}

// Load depth
if (!$depth = get_record('competency_depth', 'id', $competency->depthid)) {
    error('Competency depth could not be found');
}

$mform =& new mitms_competency_evidence_form(null, compact('id','competencyevidence','returnurl','s'));
if($fromform = $mform->get_data()) { // Form submitted
    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'facetoface', $returnurl);
    }

    $todb = new object();
    $todb->id = $fromform->id;
    // don't include userid or competencyid as form won't change them
    $todb->positionid = $fromform->positionid;
    $todb->organisationid = $fromform->organisationid;
    $todb->assessorid = $fromform->assessorid;
    $todb->assessorname = $fromform->assessorname;
    $todb->assessmenttype = $fromform->assessmenttype;
    $todb->proficiency = $fromform->proficiency;
    $todb->timemodified = $fromform->timemodified;
    if(update_record('competency_evidence',$todb)) {
        redirect($returnurl);
    } else {
        redirect($returnurl, 'Record could not be updated');
    }

} else if ($competencyevidence != null) { // editing form
    $u = get_record('user','id',$competencyevidence->userid);
    $competencyevidence->user = $u->firstname.' '.$u->lastname;
    $competencyevidence->compname = $competency->fullname;
    $mform->set_data($competencyevidence);
}

///
/// Display page
///

// Setup custom javascript
setup_lightbox(array(MBE_JS_TREEVIEW, MBE_JS_ADVANCED));
require_js(
    array(
        $CFG->wwwroot.'/local/js/lib/ui.datepicker.js',
        $CFG->wwwroot.'/local/js/position.user.js.php',
    )
);

$CFG->stylesheets[] = $CFG->wwwroot.'/local/js/lib/ui-lightness/jquery-ui-1.7.2.custom.css';


print_header();

print '<h2>'.get_string('editcompetencyevidence', 'competency').'</h2>';

$mform->display();

print_footer();

?>


