<?php

require_once(dirname(__FILE__) . '/../../config.php');


$strheading = 'Element Library: Notifications';
$url = new moodle_url('/theme/elements/notifications.php');

// Start setting up the page
$params = array();
$PAGE->set_context(get_system_context());
$PAGE->set_url($url);
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

require_login();
echo $OUTPUT->header();

echo html_writer::link(new moodle_url('/theme/elements/'), '&laquo; Back to index');
echo $OUTPUT->heading($strheading);


echo $OUTPUT->notification('This is an error notification');

echo $OUTPUT->notification('This is a success notification', 'notifysuccess');

echo $OUTPUT->notification('This is a standard notification', 'notifymessage');

echo $OUTPUT->notification('This is a "notice" notification (should be yellow). We may want to style the "notice" class instead but that is used throughout moodle so just do this one for now.', 'notifynotice');

echo $OUTPUT->notification('This is a redirect message notification', 'redirectmessage');

echo $OUTPUT->error_text('This is an error generated using error_text(). We should style this the same as the error notification above by default.');

echo $OUTPUT->box('This is a notice box, with "generalbox" and "notice" classes. Used by moodle in various places including the confirm() renderer.', array('generalbox', 'notice'));

echo $OUTPUT->footer();
