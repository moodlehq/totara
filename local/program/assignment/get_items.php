<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/program/lib.php');
require_once($CFG->dirroot.'/lib/pear/HTML/AJAX/JSON.php');
require_login();

$catid = required_param('catid', PARAM_INT); // Id of the category, as specified in the class definition
$progid = required_param('progid', PARAM_INT); // Id of the program record

// Check capabilities
require_capability('local/program:configureassignments', program_get_context($progid));

// Categories
$categories = array(
    new organisations_category(),
    new positions_category(),
    new cohorts_category(),
    new managers_category(),
    new individuals_category(),
);

// Find the matching category
foreach ($categories as $category) {
    if ($category->id == $catid) {
        $category->build_table($CFG->prefix, $progid);

        // Get the html and javascript
        $html = $category->display(true);
        $html .= '<script type="text/javascript">' . $category->get_js($progid) . '</script>';

        $data = array(
            'html'  => $html
        );
        echo json_encode($data);
        die();
    }
}
