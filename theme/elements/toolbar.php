<?php

require_once(dirname(__FILE__) . '/../../config.php');
require_once($CFG->libdir . '/totaratablelib.php');

$strheading = 'Element Library: Totara Toolbar';
$url = new moodle_url('/theme/elements/toolbar.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url($url);
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

require_login();
echo $OUTPUT->header();

echo $OUTPUT->heading($strheading);

$table = new totara_table('uniqueid');
$table->attributes = array('width' => '100%', 'class' => 'generaltable');

$table->define_headers(array('Name', 'Options'));
$table->define_columns(array('name', 'options'));
$table->define_baseurl($url);

$table->add_toolbar_content('Top left is the default spot if no position given');

// add content to the same section twice and they should sit along side each other
$table->add_toolbar_content('<input type="text" size="10" placeholder="Search..." />', 'left', 'top', 1);
$table->add_toolbar_content('<div>2nd toolbar item<br />Across multiple lines</div>', 'left', 'top', 1);
$table->add_toolbar_content('3rd toolbar, floats and centres', 'left', 'top', 1);

// example with form elements via renderers
$select = $OUTPUT->single_select($PAGE->url, 'test', array(1=>'test',2=>'test 2'));
$table->add_toolbar_content($select, 'right', 'top', 1);
$button = $OUTPUT->single_button($PAGE->url, 'My Button');
$table->add_toolbar_content($button, 'right', 'top', 1);

// a bottom toolbar
$table->add_toolbar_content('Bottom Right', 'right', 'bottom');
$table->add_toolbar_content('Bottom Left', 'left', 'bottom');

$table->setup();

$data = array(
    array(
        'a name',
        'some options'
    ),
    array(
        'This is the name of a field',
        'some options'
    ),
);
foreach ($data as $row) {
    $table->add_data($row);
}

echo $table->print_html();

echo $OUTPUT->footer();
