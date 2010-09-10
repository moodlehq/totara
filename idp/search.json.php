<?php

require_once('../config.php');
require_once('lib.php');
require_once('HTML/AJAX/JSON.php');

json_headers();

$sessionkey = required_param('sessionkey', PARAM_RAW); // Session key
$searchterms = required_param('searchterms', PARAM_NOTAGS); // Terms to search for
$curriculumcode = required_param('curriculum', PARAM_ALPHA); // Curriculum to limit search to
$revisionid = optional_param('revid', 0, PARAM_INT); // Revision associated with this search (if any)

$error = 0;
$errormsg = '';

// Check session key
if (!confirm_sesskey($sessionkey)) {
    $error = 1;
    $errormsg = get_string('invalidsesskey', 'error');
}

$data = '';
if (0 == $error) {
    if (!empty($searchterms)) {
        $data = search_objectives($searchterms, $curriculumcode, $revisionid);
    }
}

$json = new HTML_AJAX_JSON();

$value = array('error' => $error, 'errormsg' => "$errormsg",
               'data' => "$data");

$output = $json->encode($value);
print($output);

?>
