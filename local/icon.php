<?php
/**
 * Send an icon file
 */
require('../config.php');
require_once($CFG->libdir.'/filelib.php');

$id     = optional_param('id', 0, PARAM_INT);
$type   = required_param('type', PARAM_TEXT);
$icon   = required_param('icon', PARAM_FILE);
$size   = optional_param('size', 'large', PARAM_TEXT);

if ($size != 'large') {
    $size = 'small';
}

if ($type == 'course') {
    local_output_course_icon($id, $icon, $size);
} else {
    local_output_coursecategory_icon($icon, $size);
}
?>
