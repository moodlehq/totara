<?php

require_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.php');
require_once($CFG->dirroot.'/local/program/lib.php');
require_once($CFG->dirroot.'/lib/pear/HTML/AJAX/JSON.php');

require_login();

$cat = required_param('cat', PARAM_TEXT); // The category name, such as positions, organisations
$itemid = required_param('itemid', PARAM_INT);
$includechildren = required_param('include', PARAM_INT);

$classname = "{$cat}_category";

if (class_exists($classname)) {
    $category = new $classname();

    $item = $category->get_item(intval($itemid));

    $item->includechildren = $includechildren;

    $users = $category->user_affected_count($item, true);

    $data = array(
        'name'  => $item->fullname,
        'count'	    => $users,
    );
    echo json_encode($data);
}
