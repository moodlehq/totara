<?php

require_once('../../config.php');
require_once($CFG->dirroot . '/local/plan/lib.php');

// Permissions
require_sesskey();
require_capability('moodle/local:updatecompetency', get_context_instance(CONTEXT_SYSTEM));

$compevid = required_param('c',PARAM_INT);
$linkval = required_param('t',PARAM_ALPHA);
$component = optional_param('type','course',PARAM_ALPHA);

if (!in_array($linkval, $PLAN_AVAILABLE_LINKTYPES)) {
    die(get_string('error:nosuchlinktype','local_plan'));
}

if ($component == 'course') {
    $todb = new stdClass();
    $todb->id = $compevid;
    $todb->linktype = $linkval;
    $result = update_record('comp_evidence_items', $todb);

} else if ($component == 'pos') {
    $todb = new stdClass();
    $todb->id = $compevid;
    $todb->linktype = $linkval;
    $result = update_record('pos_competencies', $todb);

} else if ($component == 'org') {
    $todb = new stdClass();
    $todb->id = $compevid;
    $todb->linktype = $linkval;
    $result = update_record('org_competencies', $todb);
}


if ($result) {
    echo "OK";
} else {
    echo get_string('error:updatinglinktype','local_plan');
}
