<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot . '/local/program/lib.php');

$action = required_param('action', PARAM_INT);
$selectedexceptioncount = required_param('selectedexceptioncount', PARAM_INT);

$html = '<div style="text-align:center;">';
$html .= '<div>';
if ($action == SELECTIONACTION_NONE) {
    echo 'Please select an option';
    die();
}
else if ($action == SELECTIONACTION_AUTO_TIME_ALLOWANCE) {
    $html .= get_string('choseautomaticallydetermine','local_program');
}
else if ($action == SELECTIONACTION_OVERRIDE_EXCEPTION) {
    $html .= get_string('choseoverrideexception','local_program');
}
else if ($action == SELECTIONACTION_DISMISS_EXCEPTION) {
    $html .= get_string('chosedismissexception','local_program');
}
else if ($action == SELECTIONACTION_GRANT_EXTENSION_REQUEST) {
    $html .= get_string('chosegrantextensionexception','local_program');
}
else if ($action == SELECTIONACTION_DENY_EXTENSION_REQUEST) {
    $html .= get_string('chosedenyextensionexception','local_program');
}
$html .= '</div>';

$html .= '<div>' . get_string('thiswillaffect','local_program',$selectedexceptioncount) . '</div>';

$html .= '<div>' . get_string('thisactioncannotbeundone','local_program') . '</div>';

$html .= '</div>';

echo $html;