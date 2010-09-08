<?php

require_once('../../../../config.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once('competency_evidence_form.php');
require_once('evidence.php');

///
/// Setup / loading data
///

// competency id
$id = required_param('id', PARAM_INT);
$returnurl = optional_param('returnurl', $CFG->wwwroot, PARAM_TEXT);
$s = optional_param('s', null, PARAM_TEXT);
$competencyid = optional_param('competencyid', 0, PARAM_INT);
$positionid = optional_param('positionid', 0, PARAM_INT);
$organisationid = optional_param('organisationid', 0, PARAM_INT);
$nojs = optional_param('nojs', 0, PARAM_INT);

// only redirect back if we are sure that's where they came from
if($s != sesskey()) {
    $returnurl = $CFG->wwwroot;
}

// Check perms
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if (!$competencyevidence = get_record('comp_evidence', 'id', $id)) {
    error('Competency Evidence ID was incorrect');
}

if (!$competency = get_record('comp', 'id', $competencyevidence->competencyid)) {
    error('Competency ID was incorrect');
}

// Load framework
if (!$framework = get_record('comp_framework', 'id', $competency->frameworkid)) {
    error('Competency framework could not be found');
}

// Load depth
if (!$depth = get_record('comp_depth', 'id', $competency->depthid)) {
    error('Competency depth could not be found');
}

$mform =& new totara_competency_evidence_form(null, compact('id','competencyid','positionid',
    'organisationid','competencyevidence','returnurl','s','nojs'));
if ($mform->is_cancelled()) {
    redirect($returnurl);
}

if($fromform = $mform->get_data()) { // Form submitted
    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    $todb = new competency_evidence(
        array(
            'id'            => $fromform->id,
            'competencyid'  => $fromform->competencyid,
            'userid'        => $fromform->userid
        )
    );

    if (!$todb->id) {
        print_error('error:evidencecouldnotbefound', 'local', $returnurl);
    }

    $todb->positionid = $fromform->positionid != 0 ? $fromform->positionid : null;
    $todb->organisationid = $fromform->organisationid != 0 ? $fromform->organisationid : null;
    $todb->assessorid = $fromform->assessorid != 0 ? $fromform->assessorid : null;
    $todb->assessorname = $fromform->assessorname ? $fromform->assessorname : '';
    $todb->assessmenttype = $fromform->assessmenttype ? $fromform->assessmenttype : '';
    $todb->manual = 1;

    $todb->update_proficiency($fromform->proficiency);

    if ($todb->id) {
        redirect($returnurl);
    } else {
        redirect($returnurl, get_string('recordnotupdated','local'));
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
local_js(array(
    TOTARA_JS_DIALOG,
    TOTARA_JS_TREEVIEW,
    TOTARA_JS_DATEPICKER
));

require_js(array(
        $CFG->wwwroot.'/local/js/position.user.js.php',
));


$pagetitle = format_string(get_string('editcompetencyevidence','local'));
$navlinks[] = array('name' => get_string('editcompetencyevidence','local'), 'link'=> '', 'type'=>'title');
$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, null);

print '<h2>'.get_string('editcompetencyevidence', 'local').'</h2>';

$mform->display();

print_footer();

