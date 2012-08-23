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
 * Strings for component 'dbtransfer', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   dbtransfer
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['checkingsourcetables'] = 'Tarkastetaan lähdetaulun rakennetta';
$string['copyingtable'] = 'Kopioidaan taulu {$a}';
$string['copyingtables'] = 'Kopioidaan taulun sisältö';
$string['creatingtargettables'] = 'Luodaan taulut kohteen tietokantaan';
$string['dbexport'] = 'Tietokannan vienti';
$string['dbtransfer'] = 'Tietokannan siirto';
$string['differenttableexception'] = 'Taulun {$a} rakenne ei täsmää.';
$string['done'] = 'Valmis';
$string['exportschemaexception'] = 'Nykyisen tietokannan rakenne ei täsmää kaikkiin install.xml tiedostoihin. <br /> {$a}';
$string['importschemaexception'] = 'Nykyisen tietokannan rakenne ei täsmää kaikkiin install.xml tiedostoihin. <br /> {$a}';
$string['importversionmismatchexception'] = 'Nykyinen versio {$a->currentver} ei täsmää vietyyn versioon {$a->schemaver}.';
$string['malformedxmlexception'] = 'Löydettiin virheellistä XML:ää, ei voida jatkaa.';
$string['unknowntableexception'] = 'Viedystä tiedostosta löydettiin tuntematon taulu {$a}.';
