<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/course/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/setup.php');
require_once('edit_form.php');
///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$type = optional_param('type', -1, PARAM_INT);

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

$mform =& new mitms_competency_evidence_form(null, compact('id','competencyevidence'));
if($fromform = $mform->get_data()) { // Form submitted
    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'facetoface', $returnurl);
    }
    // process then redirect

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
print_r($competencyevidence);

$mform->display();

print_footer();

?>


