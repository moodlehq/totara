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
 * Strings for component 'dbtransfer', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   dbtransfer
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['checkingsourcetables'] = 'Forrástábla szerkezetének ellenőrzése';
$string['copyingtable'] = '{$a} tábla másolása';
$string['copyingtables'] = 'Táblatartalmak másolása';
$string['creatingtargettables'] = 'Táblák létrehozása a céladatbázisban';
$string['dbexport'] = 'Adatbázis exportálása';
$string['dbtransfer'] = 'Adatbázis-átvitel';
$string['differenttableexception'] = 'A(z) {$a} táblázat szerkezete eltérő.';
$string['done'] = 'Kész';
$string['exportschemaexception'] = 'A jelenlegi adatbázis-szerkezet nem egyezik az összes install.xml állománnyal.<br /> {$a}';
$string['importschemaexception'] = 'A jelenlegi adatbázis-szerkezet nem egyezik az összes install.xml állománnyal.<br /> {$a}';
$string['importversionmismatchexception'] = 'A jelenlegi {$a->currentver} verzió nem egyezik az exportált {$a->schemaver} verzióval.';
$string['malformedxmlexception'] = 'Hibás XML, folytatás nem lehetséges.';
$string['unknowntableexception'] = 'Az exportált állományban ismeretlen {$a} táblázat fordul elő.';
