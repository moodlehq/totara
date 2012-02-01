<?php

require_once('../../../../config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->dirroot.'/hierarchy/prefix/competency/lib.php');

// None JS page only
// return to the form with the competency set

// Non JS parameters
$nojs = optional_param('nojs', false, PARAM_BOOL);
$returnurl = optional_param('returnurl', '', PARAM_TEXT);
$s = optional_param('s', '', PARAM_TEXT);
$add = required_param('add',PARAM_SEQUENCE);
// Setup page
admin_externalpage_setup('competencymanage', '', array(), '', $CFG->wwwroot.'/competency/evidence/save.php');

// Check permissions
$sitecontext = get_context_instance(CONTEXT_SYSTEM);
require_capability('moodle/local:updatecompetency', $sitecontext);

if($s == sesskey()) {
    $murl = new moodle_url($returnurl);
    $returnurl = $murl->out(false, array('nojs' => 1, 'competencyid' => $add));
} else {
    $returnurl = $CFG->wwwroot;
}
redirect($returnurl);
