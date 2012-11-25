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
 * Strings for component 'qformat_xml', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   qformat_xml
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['invalidxml'] = 'Érvénytelen xml-állomány - szövegnek kell szerepelnie (CDATA használata?)';
$string['pluginname'] = 'Moodle XM forma';
$string['pluginname_help'] = 'Ez a Moodle-specifikus tesztkérdések exportálására és importálására használatos.';
$string['truefalseimporterror'] = '<b>Vigyázat!</b>: Nem sikerült a(z) \'{$a->questiontext}\' igaz/hamis kérdést megfelelően importálni. Nem egyértelmű, a helyes válasz az igaz vagy a hamis. A kérdés importálása során a(z) \'{$a->answer}\' választ vettük alapul. Ha ez helytelen, szerkessze át a kérdést.';
$string['unsupportedexport'] = 'Az xml-ben való exportálás nem támogatja a(z) {$a} kérdéstípust.';
$string['xmlimportnoname'] = 'Nincs kérdésnév az XML-állományban.';
$string['xmlimportnoquestion'] = 'Nincs kérdésszöveg az XML-állományban.';
$string['xmltypeunsupported'] = 'A(z) {$a} is nem támogatott kérdéstípus XML-importálás esetén';
