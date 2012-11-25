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
 * Strings for component 'tool_unittest', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_unittest
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addconfigprefix'] = 'Előtag hozzáadása a konfigurációs fájlhoz';
$string['all'] = 'Mind';
$string['codecoverageanalysis'] = 'Kódkövetési elemzés végrehajtása';
$string['codecoveragecompletereport'] = '(teljes kódkövetési jelentés megtekintése)';
$string['codecoveragedisabled'] = 'A szerveren nem kapcsolható be a kódkövetés (hiányzik az xdebug kiegészítés).';
$string['codecoveragelatestdetails'] = '({$a->date} időpontban {$a->files} állomány {$a->percentage} százalékban történt kódkövetés)';
$string['codecoveragelatestreport'] = 'legutóbbi teljes kódkövetési jelentés megtekintése';
$string['confignonwritable'] = 'A webszerver nem tud a config.php fájlba írni. Módosítsa az engedélyt vagy szerkessze megfelelő felhasználói fiókból, és a lezáró php-címke elé írja be ezt a sort:

$CFG->unittestprefix = \'tst_\' // Change tst_ to a prefix of your choice, different from $CFG->prefix';
$string['coveredlines'] = 'Kódkövetési sor';
$string['coveredpercentage'] = 'Globális kódkövetés';
$string['dbtest'] = 'Funkcionális adatbázistesztek';
$string['deletingnoninsertedrecord'] = 'Olyan rekordot próbál törölni, amelyet nem ezek az egységfeladatok szúrtak be ({$a->id} azonosító a(z) {$a->table} táblában).';
$string['deletingnoninsertedrecords'] = 'Olyan rekordokat próbál törölni, amelyeket nem ezek az egységfeladatok szúrtak be (a(z) {$a->table} táblából).';
$string['droptesttables'] = 'Feladattáblák kihagyása';
$string['exception'] = 'Kivétel';
$string['executablelines'] = 'Végrehajtható sor';
$string['fail'] = 'Hiba';
$string['ignorefile'] = 'Az állományban lévő feladatok kihagyása';
$string['ignorethisfile'] = 'A feladatok újbóli végrehajtása ezen feladatállomány kihagyásával.';
$string['installtesttables'] = 'Feladattáblák telepítése';
$string['moodleunittests'] = 'Moodle-egység feladatai: {$a}';
$string['notice'] = 'Tájékoztatás';
$string['onlytest'] = 'Feladatok végrehajtása csakis';
$string['othertestpages'] = 'Egyéb tesztoldalak';
$string['pass'] = 'Sikerült';
$string['pathdoesnotexist'] = 'A(z) \'{$a}\' útvonal nem létezik.';
$string['pluginname'] = 'Egységtesztek';
$string['prefix'] = 'Egységfeladat tábláinak előtagja';
$string['prefixnotset'] = 'Nincs beállítva az egységfeladat adatbázistáblájának előtagja. A config.php-hez való hozzáadáshoz töltse ki és küldje be ezt az űrlapot.';
$string['reinstalltesttables'] = 'Feladattáblák újratelepítése';
$string['retest'] = 'A feladatok újbóli végrehajtása';
$string['retestonlythisfile'] = 'Csak ezen feladatállomány újbóli végrehajtása';
$string['runall'] = 'Minden feladatállomány feladatainak végrehajtása';
$string['runat'] = 'Végrehajtás ekkor: {$a}.';
$string['runonlyfile'] = 'Csak ezen feladatállományban lévő feladatok végrehajtása';
$string['runonlyfolder'] = 'Csak ezen mappában lévő feladatok végrehajtása';
$string['runtests'] = 'Feladatok végrehajtása';
$string['rununittests'] = 'Egységfeladatok végrehajtása';
$string['showpasses'] = 'Sikeres és sikertelen végrehajtások megjelenítése';
$string['showsearch'] = 'Feladatállományok keresésének megjelenítése';
$string['skip'] = 'Kihagyás';
$string['stacktrace'] = 'Veremfigyelés:';
$string['summary'] = '{$a->run}/{$a->total} feladateset kész: {$a->passes} sikerült, {$a->fails} nem sikerült és {$a->exceptions} kivétel.';
$string['tablesnotsetup'] = 'Az egységfeladat táblái még nem készültek el. Elkészíti őket most?';
$string['testdboperations'] = 'Feladat-adatbázis műveletei';
$string['testtablescsvfileunwritable'] = 'A feladattáblák CSV-fájl nem írható ({$a->filename}).';
$string['testtablesneedupgrade'] = 'A feladat-adatbázis tábláit frissíteni kell. Folytatja a frissítést?';
$string['testtablesok'] = 'A feladat-adatbázis tábláinak telepítése sikerült.';
$string['thorough'] = 'Alapos teszt végrehajtása (lassú lehet).';
$string['timetakes'] = 'Felhasznált idő: {$a}.';
$string['totallines'] = 'Sor összesen';
$string['uncaughtexception'] = 'Kihagyott kivétel [{$a->getMessage()}] a [{$a->getFile()}:{$a->getLine()}] sorban, FELADATOK ABBAHAGYÁSA.';
$string['uncoveredlines'] = 'Kódkövetésből kimaradt sor';
$string['unittest:execute'] = 'Egységellenőrzések végrehajtása';
$string['unittestprefixsetting'] = 'Egységfeladatok előtagja: <strong>{$a->unittestprefix}</strong> (A config.php szerkesztésével módosíthatja).';
$string['unittests'] = 'Egységfeladatok';
$string['updatingnoninsertedrecord'] = 'Olyan rekordot próbál törölni, amelyet nem ezek az egységfeladatok szúrtak be ({$a->id} azonosító a(z) {$a->table} táblában).';
$string['version'] = 'A <a href="http://sourceforge.net/projects/simpletest/">SimpleTest</a>  {$a} változatával.';
