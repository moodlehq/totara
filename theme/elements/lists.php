<?php

require_once(dirname(__FILE__) . '/../../config.php');


$strheading = 'Element Library: Lists';
$url = new moodle_url('/theme/elements/lists.php');

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
echo $OUTPUT->container('Currently lists have to be generated manually. See <a href="http://tracker.moodle.org/browse/MDL-31430">MDL-31430</a> for an attempt to get a new helper function into core.');

echo $OUTPUT->container_start();
echo $OUTPUT->heading('Unordered List', 3);
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'item one');
echo html_writer::tag('li', 'item two');
echo html_writer::tag('li', 'item three');
echo html_writer::tag('li', 'item four');
echo html_writer::tag('li', 'item five');
echo html_writer::end_tag('ul');

echo $OUTPUT->heading('Ordered List', 3);
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'item one');
echo html_writer::tag('li', 'item two');
echo html_writer::tag('li', 'item three');
echo html_writer::tag('li', 'item four');
echo html_writer::tag('li', 'item five');
echo html_writer::end_tag('ol');

echo $OUTPUT->heading('Nested unordered List', 3);
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'item one');
echo html_writer::tag('li', 'item two');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'item two point one');
echo html_writer::tag('li', 'item two point two');
echo html_writer::end_tag('ul');
echo html_writer::tag('li', 'item three');
echo html_writer::tag('li', 'item four');
echo html_writer::tag('li', 'item five');
echo html_writer::end_tag('ul');

echo $OUTPUT->heading('Nested ordered List', 3);
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'item one');
echo html_writer::tag('li', 'item two');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'item two point one');
echo html_writer::tag('li', 'item two point two');
echo html_writer::end_tag('ol');
echo html_writer::tag('li', 'item three');
echo html_writer::tag('li', 'item four');
echo html_writer::tag('li', 'item five');
echo html_writer::end_tag('ol');

echo $OUTPUT->heading('Deeply nested unordered List', 3);

echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 1');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 2');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 3');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 4');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 5');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 6');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 7');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 8');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 9');
echo html_writer::start_tag('ul');
echo html_writer::tag('li', 'level 10');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');
echo html_writer::end_tag('ul');

echo $OUTPUT->heading('Deeply nested ordered List', 3);

echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 1');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 2');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 3');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 4');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 5');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 6');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 7');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 8');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 9');
echo html_writer::start_tag('ol');
echo html_writer::tag('li', 'level 10');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');
echo html_writer::end_tag('ol');

echo $OUTPUT->container_end();

echo $OUTPUT->box_end();

echo $OUTPUT->footer();
