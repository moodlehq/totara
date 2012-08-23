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
 * Strings for component 'qformat_xml', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   qformat_xml
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['invalidxml'] = 'Virheellinen XML-tiedosto - odotettiin merkkijonoa (käytä CDATA:a?)';
$string['pluginname'] = 'Moodle XML-muoto';
$string['pluginname_help'] = 'Tämä on Moodle-spesifi muoto kysymysten tuontiin ja vientiin.';
$string['truefalseimporterror'] = '<b>Varoitus</b>: Tosi/epätosi kysymystä \'{$a->questiontext}\' ei voitu tuoda oikein. Ei ollut selvää onko oikea vastaus tosi vai epätosi. Kysymys tuotiin olettaen että vastaus on \'{$a->answer}\'. Jos tämä ei ole oikein, sinun pitää muokata kysymystä.';
$string['unsupportedexport'] = 'XML-vienti ei tue kysymystyyppiä {$a}';
$string['xmlimportnoname'] = 'Puuttuva kysymyksen nimi XML-tiedostossa.';
$string['xmlimportnoquestion'] = 'Puuttuva kysymysteksti XML-tiedostossa';
$string['xmltypeunsupported'] = 'XML-tuonti ei tue kysymystyyppiä {$a}';
