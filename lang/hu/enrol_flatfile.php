<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'enrol_flatfile', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_flatfile
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['filelockedmail'] = 'AZ Ön által beiratkozásra használt szöveges állományt ({$a}) a cron folyamattal nem lehet törölni. Ez olyankor fordul elő, ha nem megfelelő engedélyek vannak hozzárendelve. Állítsa be az engedélyeket úgy, hogy a Moodle törölni tudja az állományt, ellenkező esetben megismétlődhet annak feldolgozása.';
$string['filelockedmailsubject'] = 'Lényeges hiba: beiratkozási állomány';
$string['location'] = 'Állomány helye';
$string['mailadmin'] = 'Rendszergazda értesítése e-mailben';
$string['mailstudents'] = 'Tanulók értesítése e-mailben';
$string['mailteachers'] = 'Tanárok értesítése e-mailben';
$string['mapping'] = 'Megfeleltetés egyszerű állomány alapján';
$string['messageprovider:flatfile_enrolment'] = 'Egyszerű állománnyal való beiratkozás üzenetei';
$string['pluginname'] = 'Egyszerű (CSV) állomány';
$string['pluginname_desc'] = 'Ez a módszer ismételten ellenőrzi és feldolgozza a megadott helyen lévő, speciális formázású szöveget.
A szöveg vesszőkkel elválasztott állomány, soronkét négy--hat mezővel:
<pre class="informationbox">
* operation, role, idnumber(user), idnumber(course) [, starttime,
endtime]
ahol:
* operation = add | del
* role = student | teacher | teacheredit
* idnumber(user) = idnumber in the user table NB not id
* idnumber(course) = idnumber in the course table NB not id
* starttime = start time (in seconds since epoch) - optional
* endtime = end time (in seconds since epoch) - optional
</pre>
Ez lehet például a következő:
<pre class="informationbox">
add, student, 5, CF101
add, teacher, 6, CF101
add, teacheredit, 7, CF101
del, student, 8, CF101
del, student, 17, CF101
add, student, 21, CF101, 1091115000, 1091215000
</pre>';
