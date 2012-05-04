<?php

/**
 * URL used as reference for form creation below:
 * http://docs.moodle.org/dev/lib/formslib.php_Form_Definition#definition.28.29
 *
 * Todo:
 *  - it would be useful to apply an incremental className to form groups, to ctrl
 *    spacing between stacked groups, eg; 'class="felement fgroup fgroup1"'
 **/

require_once(dirname(__FILE__) . '/../../config.php');

require_once($CFG->dirroot.'/lib/formslib.php');


$strheading = 'Element Library: Moodle Forms';
$url = new moodle_url('/theme/elements/moodleforms.php');

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
echo $OUTPUT->container('Examples of different types of form.');
echo $OUTPUT->container_start();

echo html_writer::alist(array(
    html_writer::link(new moodle_url('/theme/elements/mform_standard.php'), 'Standard form elements'),
    html_writer::link(new moodle_url('/theme/elements/mform_grouped.php'), 'Grouped form elements'),
    html_writer::link(new moodle_url('/theme/elements/mform_other.php'), 'Other form controls (e.g. advanced elements, required fields, etc) TODO'),
    html_writer::link(new moodle_url('/theme/elements/mform_custom.php'), 'Custom forms created by changing the default renderer TODO'),
));

echo $OUTPUT->container_end();
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
