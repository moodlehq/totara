<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Aaron Barnes <aaron.barnes@totaralms.com>
 * @package totara
 * @subpackage build
 *
 *
 * Generate default users for cucumber tests
 *
 * Run after CLI upgrade via build/build.sh
 *
 */
define('CLI_SCRIPT', true);
define('NO_OUTPUT_BUFFERING', true);

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
if (!$DB->record_exists('user', array('username' => 'learner'))) {
    $DB->insert_record('user', $todb);
}

$todb->username = 'manager';
$todb->email = 'manager@example.com';
$todb->firstname = 'Test';
$todb->lastname = 'Manager';
if (!$DB->record_exists('user', array('username' => 'manager'))) {
   $DB-> insert_record('user', $todb);
}

$todb->username = 'trainer';
$todb->email = 'trainer@example.com';
$todb->firstname = 'Test';
$todb->lastname = 'Trainer';
if (!$DB->record_exists('user', array('username' => 'trainer'))) {
    $DB->insert_record('user', $todb);
}
