<?php

/*
 * Generate default users for cucumber tests
 *
 * Run after CLI upgrade via build/build.sh
 *
 */
require_once(dirname(dirname(__FILE__)).'/config.php');

$todb = new object();
$todb->auth = 'manual';
$todb->confirmed = 1;
$todb->policyagreed = 1;
$todb->deleted = 0;
$todb->city = 'Wellington';
$todb->country = 'NZ';
$todb->mnethostid = 1;
$todb->password = 'f806b2e4648312e7ca9eab9f132fe4b4';

$todb->username = 'learner';
$todb->email = 'learner@example.com';
$todb->firstname = 'Reginald';
$todb->lastname = 'Hulsman';
if (!record_exists('user', 'username', 'learner')) {
    insert_record('user', $todb);
}

$todb->username = 'manager';
$todb->email = 'manager@example.com';
$todb->firstname = 'Test';
$todb->lastname = 'Manager';
if (!record_exists('user', 'username', 'manager')) {
    insert_record('user', $todb);
}

$todb->username = 'trainer';
$todb->email = 'trainer@example.com';
$todb->firstname = 'Test';
$todb->lastname = 'Trainer';
if (!record_exists('user', 'username', 'trainer')) {
    insert_record('user', $todb);
}
