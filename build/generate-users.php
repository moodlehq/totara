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
$todb->email = 'learner@example.com';
$todb->city = 'Wellington';
$todb->country = 'NZ';
$todb->password = 'f806b2e4648312e7ca9eab9f132fe4b4';

$todb->username = 'learner';
$todb->firstname = 'Reginald';
$todb->lastname = 'Hulsman';
insert_record('user', $todb);

$todb->username = 'manager';
$todb->firstname = 'Test';
$todb->lastname = 'Manager';
insert_record('user', $todb);

$todb->username = 'trainer';
$todb->firstname = 'Test';
$todb->lastname = 'Trainer';
insert_record('user', $todb);

