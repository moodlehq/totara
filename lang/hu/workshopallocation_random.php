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
 * Strings for component 'workshopallocation_random', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   workshopallocation_random
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addselfassessment'] = 'Önértékelések hozzáadása';
$string['allocationaddeddetail'] = 'Új értékelést kell elvégezni: <strong>{$a->reviewername}</strong> a(z) <strong>{$a->authorname}</strong> értékelője';
$string['allocationdeallocategraded'] = 'A már pontozott értékelés nem rendelhető hozzá máshoz: értékelte <strong>{$a->reviewername}</strong>, leadott munka szerzője: <strong>{$a->authorname}</strong>';
$string['allocationreuseddetail'] = 'Újrahasznált értékelés: <strong>{$a->reviewername}</strong> megmarad <strong>{$a->authorname}</strong> értékelőjének.';
$string['allocationsettings'] = 'Hozzárendelési beállítások';
$string['assessmentdeleteddetail'] = 'Értékelés hozzárendelésének megszüntetése: <strong>{$a->reviewername}</strong> már nem a(z) <strong>{$a->authorname}</strong> értékelője';
$string['assesswosubmission'] = 'A résztvevők leadott munka nélkül is értékelhetnek';
$string['confignumofreviews'] = 'Véletlenszerűen hozzárendelt leadott munkák száma alapesetben';
$string['excludesamegroup'] = 'Azonos csoportbeli társak általi ellenőrzés megakadályozása';
$string['noallocationtoadd'] = 'Nincs hozzáadandó hozzárendelés';
$string['nogroupusers'] = 'Figyelem: ha a műhelymunka \'látható csoportok\' vagy \'külön csoportok\' üzemmódban van, akkor a felhasználóknak legalább az egyik csoportba KELL tartozni ahhoz, hogy ez az eszköz csoporttársi értékelést rendelhessen hozzájuk. A csoportba nem tartozók új önértékelést hajthatnak végre, illetve törölhetik meglévő értékeléseiket.
A következő felhasználóknak jelenleg nincs csoportja:  {$a}';
$string['numofdeallocatedassessment'] = '{$a} értékelés hozzárendelésének megszüntetése';
$string['numofrandomlyallocatedsubmissions'] = '{$a} leadott munka véletlenszerűen hozzárendelve';
$string['numofreviews'] = 'Értékelések száma';
$string['numofselfallocatedsubmissions'] = '{$a} leadott munka saját hozzárendelése';
$string['numperauthor'] = 'leadott munkánként';
$string['numperreviewer'] = 'értékelőnként';
$string['pluginname'] = 'Véletlenszerű hozzárendelés';
$string['randomallocationdone'] = 'Véletlenszerű hozzárendelés kész';
$string['removecurrentallocations'] = 'Mostani hozzárendelések törlése';
$string['resultnomorepeers'] = 'Nincs több csoporttárs';
$string['resultnomorepeersingroup'] = 'Nincs több csoporttárs ebben a csoportban';
$string['resultnotenoughpeers'] = 'Nincs elegendő csoporttárs';
$string['resultnumperauthor'] = 'Szerzőnként {$a} ellenőrzés hozzárendelése';
$string['resultnumperreviewer'] = 'Érrtékelőnként {$a} értékelés hozzárendelése';
$string['stats'] = 'Mostani hozzárendelések statisztikája';
