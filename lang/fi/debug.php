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
 * Strings for component 'debug', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   debug
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['authpluginnotfound'] = 'Autentikaatiomoduulia {$a} ei löydy.';
$string['blocknotexist'] = '{$a} moduulia ei ole olemassa.';
$string['cannotbenull'] = '{$a} ei saa olla tyhjä!';
$string['cannotdowngrade'] = 'Ei voida alentaa {$a->plugin} versiosta {$a->oldversion} uuteen {$a->newversion}.';
$string['cannotfindadmin'] = 'Ylläpitäjää ei löydy!';
$string['cannotinitpage'] = 'Ei voida alustaa sivua: epäkelpo {$a->name} id {$a->id}';
$string['cannotsetuptable'] = '{$a} tauluja ei voitu asettaa onnistuneesti!';
$string['codingerror'] = 'Koodivirhe havaittu, ohjelmoijan pitää korjata se: {$a}';
$string['configmoodle'] = 'Moodlea ei ole vielä konfiguroitu. Sinun pitää muokata config.php:ta ensin.';
$string['erroroccur'] = 'Prosessin aikana tapahtui virhe.';
$string['invalidarraysize'] = 'Taulukoiden koko on väärä {$a}:ssa.';
$string['invalideventdata'] = 'Väärnlaista tapahtumatietoa syötetty: {$a}';
$string['invalidparameter'] = 'Epäkelpoja parametrien arvoja havaittu, toiminto ei voi jatkua.';
$string['invalidresponse'] = 'Epäkelpoja vastausarvoja havaittu, toiminto ei voi jatkua.';
$string['missingconfigversion'] = 'Config-taulussa ei ole versiota, ei voida jatkaa.';
$string['modulenotexist'] = '{$a} moduulia ei ole olemassa.';
$string['morethanonerecordinfetch'] = 'Löydettiin enemmän kuin yksi tietue fetch():ssa!';
$string['mustbeoveride'] = 'Abstrakti metodi {$a} pitää syrjäyttää.';
$string['noactivityname'] = 'Sivun objekti johdetaan page_generic_activitysta, mutta se ei määritellyt $this->activityname :a.';
$string['noadminrole'] = 'Ylläpitäjän roolia ei löydetty';
$string['noblocks'] = 'Ei lohkoja asennettuna!';
$string['nocate'] = 'Ei kategorioita!';
$string['nomodules'] = 'Moduuleita ei löytynyt!';
$string['nopageclass'] = 'Importoitiin {$a} mutta ei löydetty sivun luokkia.';
$string['noreports'] = 'Ei raportteja saatavissa';
$string['notables'] = 'Ei tauluja!';
$string['phpvaroff'] = 'PHP-serverin muuttuja \'{$a->name}\' pitäisi olla pois päältä - {$a->link}';
$string['phpvaron'] = 'PHP-serverin muuttuja \'{$a->name}\' ei ole päällä - {$a->link}';
$string['sessionmissing'] = '{$a} objekti puuttuu sessiosta.';
$string['sqlrelyonobsoletetable'] = 'Tämä SQL riippuu vanhentuneista tauluista:
{$a}! Ohjelmoijan pitää korjata koodi.';
$string['withoutversion'] = 'Tiedosto version.php puuttuu, ei ole luettavissa tai on korruptoitunut.';
$string['xmlizeunavailable'] = 'xmlize-funktiot eivät ole saatavilla';
