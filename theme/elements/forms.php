<?php

require_once(dirname(__FILE__) . '/../../config.php');

$strheading = 'Element Library: Forms';
$url = new moodle_url('/theme/elements/forms.php');

// Start setting up the page
$params = array();
$PAGE->set_context(get_system_context());
$PAGE->set_url($url);
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

require_login();
echo $OUTPUT->header();

echo $OUTPUT->heading($strheading);

echo $OUTPUT->box_start();
echo $OUTPUT->container('Examples of different types of stand-alone form elements (without using formslib).');
echo $OUTPUT->container_start();

echo 'TODO';

echo $OUTPUT->container_end();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
