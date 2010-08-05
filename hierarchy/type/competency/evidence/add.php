<?php

require_once('../../../../config.php');
require_once($CFG->dirroot.'/hierarchy/type/position/lib.php');
require_once($CFG->dirroot.'/hierarchy/type/competency/lib.php');
require_once($CFG->dirroot.'/local/js/lib/setup.php');
require_once('competency_evidence_form.php');
require_once('evidence.php');
///
/// Setup / loading data
///

$userid = required_param('userid', PARAM_INT);
$returnurl = optional_param('returnurl', $CFG->wwwroot, PARAM_TEXT);
$proficiency = optional_param('proficiency', null, PARAM_INT);
$s = optional_param('s', null, PARAM_TEXT);
$competencyid = optional_param('competencyid', 0, PARAM_INT);
$positionid = optional_param('positionid', 0, PARAM_INT);
$organisationid = optional_param('organisationid', 0, PARAM_INT);

$nojs = optional_param('nojs', 0, PARAM_INT);

if($u = get_record('user','id',$userid)) {
    $toform = new object();
    $toform->user = $u->firstname.' '.$u->lastname;
} else {
    error('error:usernotfound','local');
}

// only redirect back if we are sure that's where they came from
if($s != sesskey()) {
    $returnurl = $CFG->wwwroot;
}

// Check perms
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

$mform =& new totara_competency_evidence_form(null, compact('id','competencyid','positionid',
    'organisationid','userid','user','returnurl','s','nojs'));
if ($mform->is_cancelled()) {
    redirect($returnurl);
}
if($fromform = $mform->get_data()) { // Form submitted
    if (empty($fromform->submitbutton)) {
        print_error('error:unknownbuttonclicked', 'local', $returnurl);
    }

    $todb = new competency_evidence(
        array(
            'competencyid'  => $fromform->competencyid,
            'userid'        => $fromform->userid
        )
    );

    if ($todb->id) {
        print_error('error:evidencealreadyexists', 'local', $returnurl);
    }

    $todb->positionid = $fromform->positionid != 0 ? $fromform->positionid : null;
    $todb->organisationid = $fromform->organisationid != 0 ? $fromform->organisationid : null;
    $todb->assessorid = $fromform->assessorid != 0 ? $fromform->assessorid : null;
    $todb->assessorname = $fromform->assessorname;
    $todb->assessmenttype = $fromform->assessmenttype;
    $todb->manual = 1;
    $todb->reaggregate = time();

    // proficiency not obtained by get_data() because form element is populated
    // via javascript after page load. Get via optional POST parameter instead.
    if (!$proficiency) {
        print_error('error:noproficiencysupplied', 'local', $returnurl);
    }

    $todb->update_proficiency($proficiency);

    if ($todb->id) {
        redirect($returnurl);
    } else {
        redirect($returnurl, get_string('recordnotcreated','local'));
    }

} else {
    $mform->set_data($toform);
}

///
/// Display page
///

$type = 'competency';
$hierarchy = new $type();
$hierarchy->hierarchy_page_setup('item/add');

$pagetitle = format_string(get_string('addcompetencyevidence','local'));
$navlinks[] = array('name' => get_string('addcompetencyevidence','local'), 'link'=> '', 'type'=>'title');
$navigation = build_navigation($navlinks);

print_header_simple($pagetitle, '', $navigation, '', null, true, null);

print '<h2>'.get_string('addcompetencyevidence', 'local').'</h2>';

$mform->display();

print_footer();

