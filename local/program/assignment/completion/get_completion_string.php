<?php

require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.php');
require_once($CFG->dirroot.'/local/program/lib.php');

require_login();

$completiontime = required_param('completiontime', PARAM_TEXT);
$completionevent = required_param('completionevent', PARAM_INT);
$completioninstance = required_param('completioninstance', PARAM_INT);

$string = prog_assignment_category::build_completion_string($completiontime, $completionevent, $completioninstance);
if (trim($string) == '') {
    echo 'error';
}
else {
    echo $string;
}