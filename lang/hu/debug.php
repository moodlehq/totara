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
 * Strings for component 'debug', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   debug
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['authpluginnotfound'] = 'Nem található a(z) {$a} hitelesítési segédprogram.';
$string['blocknotexist'] = 'A(z) {$a} blokk nem létezik.';
$string['cannotbenull'] = 'A(z) {$a} nem lehet nulla!';
$string['cannotdowngrade'] = 'Nem lehet visszaváltani {$a->oldversion} verzióról {$a->newversion} verzióra.';
$string['cannotfindadmin'] = 'Nem található rendszergazda-felhasználó!';
$string['cannotinitpage'] = 'Az oldal inicializálása nem teljesen sikerült:  érvénytelen {$a->name} és {$a->id} azonosító';
$string['cannotsetuptable'] = 'A(z) {$a} táblázatokat  nem sikerült létrehozni!';
$string['codingerror'] = 'Kódolási hiba történt, melyet programozónak kell kijavítania: {$a}.';
$string['configmoodle'] = 'Még nincs beállítva a Moodle. ELőbb szerkessze meg a config.php állományt.';
$string['erroroccur'] = 'Hiba történt a folyamat során.';
$string['invalidarraysize'] = 'Hibás tömbméret a(z) {$a} paramétereiben';
$string['invalideventdata'] = 'Hibás eseményadatot adott meg: {$a}.';
$string['invalidparameter'] = 'Érvénytelen paraméterérték';
$string['invalidresponse'] = 'Érvénytelen válaszérték';
$string['missingconfigversion'] = 'A konfigurációs táblázatban nem szerepel a verzió, nem lehet továbblépni.';
$string['modulenotexist'] = 'A(z) {$a} modul nem létezik';
$string['morethanonerecordinfetch'] = 'A fetch() egynél több rekordot tartalmaz!';
$string['mustbeoveride'] = 'Az absztrakt {$a} metódust felül kell írni.';
$string['noactivityname'] = 'A page_generic_activity-ből előállt az oldalobjektum, de nem definiálta a(z) $this->activityname tevékenységet.';
$string['noadminrole'] = 'Nincs rendszergazda-szerep.';
$string['noblocks'] = 'Nincsenek telepítve blokkok!';
$string['nocate'] = 'Nincsenek kategóriák!';
$string['nomodules'] = 'Nincsenek modulok!';
$string['nopageclass'] = 'A(z) {$a} importálása megtörtént, de nincsenek oldalosztályok!';
$string['noreports'] = 'Nem érhetők el jelentések!';
$string['notables'] = 'Nincsenek táblázatok!';
$string['phpvaroff'] = 'A PHP-szerver \'{$a->name}\' változóját ki kell kapcsolni - {$a->link}';
$string['phpvaron'] = 'A PHP-szerver \'{$a->name}\' változója \'{$a->name}\' nincs bekapcsolva - {$a->link}';
$string['sessionmissing'] = 'A(z) {$a} objektum hiányzik.';
$string['sqlrelyonobsoletetable'] = 'Ez az SQL elavult {$a} táblázato(ko)n alapszik! Programkódját egy fejlesztővel kell kijavíttatnia!';
$string['withoutversion'] = 'A fő version.php állomány hiányzik, nem olvasható vagy sérült.';
$string['xmlizeunavailable'] = 'Nem érhetők el az xmlize-függvények!';
