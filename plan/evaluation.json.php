<?php

require_once('../../config.php');
require_once('lib.php');
require_once('HTML/AJAX/JSON.php');

json_headers();

$sessionkey = required_param('sessionkey', PARAM_RAW); // Session key
$action = required_param('action', PARAM_ALPHA); // Action code

$revid = optional_param('revisionid', 0, PARAM_INT); // Revision ID
$objectiveid = optional_param('objectiveid', 0, PARAM_INT); // Learning Objective ID
$curriculumcode = optional_param('curriculum', '', PARAM_ALPHA); // Curriculum code
$roid = optional_param('roid', 0, PARAM_INT); // Revision Objective ID
$grade = optional_param('grade', 0, PARAM_INT); // Grade for the Revision Objective

$error = 0;
$errormsg = '';

if (!confirm_sesskey($sessionkey)) {
    $error = 7;
    $errormsg = 'Bad session key';
}

$data = '';
if (0 == $error) {
    if ('addobj' == $action or 'deleteobj' == $action) {
        if (0 == $revid) {
            $error = 1;
            $errormsg = 'Revisionid cannot be 0.';
        }
        elseif (0 == $objectiveid) {
            $error = 2;
            $errormsg = 'Objectiveid cannot be 0.';
        }
        else {
            if (objective_ajax_action($objectiveid, $revid, $action, 1)) {
                $data = curriculum_evaluations($curriculumcode, $revid);
            }
            else {
                $error = 3;
                $errormsg = "Could not perform $action with objective=$objectiveid and revision=$revid.";
            }
        }
    }
    elseif ('gradeobj' == $action) {
        if (0 == $roid) {
            $error = 4;
            $errormsg = 'Revision Objective ID cannot be 0.';
        }
        else {
            idp_grade_objective($roid, $grade);
        }
    }
}

$json = new HTML_AJAX_JSON();

$value = array('error' => $error, 'errormsg' => "$errormsg",
               'rev' => $revid, 'objectiveid'=> $objectiveid,
               'data' => $data, 'action' => $action);

$output = $json->encode($value);
print($output);

?>
