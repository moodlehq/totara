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
 * Strings for component 'enrol_flatfile', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_flatfile
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['filelockedmail'] = 'Tiedostoa, jota käytetään kurssi rekisteröitymisiin, ei voida poistaa. Tämä saattaa tarkoittaa sitä, että tiedoston komennot suoritetaan useamman kerran. Ongelmien välttämiseksi korjaa tiedosto-oikeudet niin, että cron-toiminto voi poistaa tiedoston.';
$string['filelockedmailsubject'] = 'Virhe rekisteröitymistiedostossa';
$string['location'] = 'Tiedoston sijainti';
$string['mailadmin'] = 'Ilmoita ylläpitäjälle';
$string['mailstudents'] = 'Ilmoita opiskelijoille sähköpostilla';
$string['mailteachers'] = 'Ilmoita opettajille sähköpostilla';
$string['mapping'] = 'Tiedoston mappaus';
$string['pluginname'] = 'CSV-tiedosto';
$string['pluginname_desc'] = 'Tämä metodi tarkastaa ja käsittelee toistuvasti erityisesti muotoiltuja tekstitiedostoja määrittelemässäsi kohteessa.
Tiedosto on pilkuilla erotettu tiedosto, jossa oletetaan olevan neljä tai kuusi kenttää jokaisella rivillä:
<pre class="informationbox">
* operation, role, idnumber(user), idnumber(course) [, starttime, endtime] jossa:
* operation = add | del
* rooli = student | teacher | teacheredit
* idnumber(user) = idnumber user-taulussa HUOM. ei id
* idnumber(course) = idnumber course-taulussa HUOM. ei id
* starttime = aloitusaika (sekunteina 1.1.1970 jälkeen) - valinnainen
* endtime = loppumisaika (sekunteina 1.1.1970 jälkeen) - valinnainen
</pre>
Tiedosto saattaisi näyttää tältä:
<pre class="informationbox">
add, student, 5, CF101
add, teacher, 6, CF101
add, teacheredit, 7, CF101
del, student, 8, CF101
del, student, 17, CF101
add, student, 21, CF101, 1091115000, 1091215000
</pre>';
