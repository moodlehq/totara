<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/evidenceitem/lib.php');

///
/// Setup / loading data
///

// course id
$id = required_param('id', PARAM_INT);
// competency id
$competency_id = required_param('competency', PARAM_INT);

// No javascript parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);

// string of params needed in non-js url strings
$urlparams = 'nojs='.$nojs.'&amp;returnurl='.urlencode($returnurl).'&amp;s='.$s;

// Check perms
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/edit.php');

$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if($nojs) {
    admin_externalpage_print_header();
}

// Load course
if (!$course = get_record('course', 'id', $id)) {
    error('Course ID was incorrect');
}
echo '<h3>'.$course->fullname.'</h3>';


comp_evitem_print_course_evitems($course, $competency_id, "{$CFG->wwwroot}/hierarchy/prefix/competency/evidenceitem/add.php?competency={$competency_id}&{$urlparams}" );


if($nojs) {
    print_footer();
}
