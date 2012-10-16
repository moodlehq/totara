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
 * Strings for component 'enrol_mnet', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['error_multiplehost'] = 'Jokin instanssi MNet-kirjautumispluginista on jo olemassa tälle isäntäkoneelle. Vain yksi instanssi yhdelle isäntäkoneelle ja/tai yksi instanssi \'Kaikille isäntäkoneille\' sallitaan.';
$string['instancename'] = 'Kirjautumismetodin nimi';
$string['instancename_help'] = 'Voit vaihtoehtoisesti uudelleennimetä tämän instanssin MNet-kirjautumismetodista. Jos jätät tämän kentän tyhjäksi, käytetään instanssin oletusnimeä sisältäen etäisäntäkoneen nimi sekä käyttäjille annettu rooli siellä.';
$string['mnet_enrol_description'] = 'Julkaise tämä palvelu salliaksesi ylläpitäjien kohteessa {$a} kirjata oppilaansa palvelimellesi luomillesi kursseille.<br/><ul><li><em>Riippuvuus</em>: Sinun täytyy myös <strong>julkaista</strong> SSO (Palvelun Tarjoaja) -palvelu kohteelle {$a}.</li><li><em>Riippuvuus</em>: Sinun täytyy myös <strong>tilata</strong> SSO (Identiteetin Tarjoaja) -palvelu kohteesta {$a}.</li></ul><br/>Tilaa tämä palvelu, jotta voit kirjata opiskelijasi kursseille kohteessa {$a}.<br/><ul><li><em>Riippuvuus</em>: Sinun täytyy myös <strong>tilata</strong> SSO (Palvelun Tarjoaja) -palvelu kohteesta {$a}.</li><li><em>Riippuvuus</em>: Sinun täytyy myös <strong>julkaista</strong> SSO (Identiteetin Tarjoaja) -palvelu kohteelle {$a}.</li></ul><br/>';
$string['mnet_enrol_name'] = 'Etäkirjautumispalvelu';
$string['pluginname'] = 'MNet etäkirjautumiset';
$string['pluginname_desc'] = 'Sallii etä- MNet isäntäkoneen kirjata käyttäjänsä meidän kursseille.';
$string['remotesubscriber'] = 'Etäisäntäkone';
$string['remotesubscriber_help'] = 'Valitse \'Kaikki isäntäkoneet\' avataksesi tämän kurssin kaikille MNet vertaiskäyttäjille, joille tarjoamme etäkirjautumispalvelun. Tai valitse yksittäinen isäntäkone antaaksesi pääsyn kurssille vain heidän käyttäjilleen.';
$string['remotesubscribersall'] = 'Kaikki isäntäkoneet';
$string['roleforremoteusers'] = 'Rooli heidän käyttäjilleen';
$string['roleforremoteusers_help'] = 'Minkä roolin etäkäyttäjät valitusta isäntäkoneesta saavat.';
