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
 * Strings for component 'portfolio_mahara', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio_mahara
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enableleap2a'] = 'Leap2a portfólió-támogatás bekapcsolása (kell hozzá a Mahara 1.3 vagy későbbi változata)';
$string['err_invalidhost'] = 'Érvénytelen hálózati Moodle-gazdagép.';
$string['err_invalidhost_help'] = 'A segédprogram hibás beállítás miatt érvénytelen (vagy törölt) hálózati Moodle-gazdagépre mutat. A segédprogram közzétett SSO IDP-vel, valamint előjegyzett SSO_SP-vel és előjegyzett és közzétett portfólióval rendelkező hálózati Moodle-társszerverekre támaszkodik.';
$string['err_networkingoff'] = 'A Moodle-hálózat ki van kapcsolva.';
$string['err_networkingoff_help'] = 'A Moodle-hálózat teljesen ki van kapcsolva. A segédprogram beállítása előtt kapcsolja be. A segédprogram minden példánya a hiba elhárításáig láthatatlanra van állítva - kézzel kell ismét láthatóra állítania őket. Csak ezután lesznek használhatók.';
$string['err_nomnetauth'] = 'A hálózati Moodle hitelesítési segédprogramja ki van kapcsolva';
$string['err_nomnetauth_help'] = 'A hálózati Moodle hitelesítési segédprogramja ki van kapcsolva, a szolgáltatás viszont igényli.';
$string['err_nomnethosts'] = 'A hálózati Moodle-lal működik együtt.';
$string['err_nomnethosts_help'] = 'A segédprogram a hálózati Moodle társrendszereivel, közzétett SSO IDP, valamint előjegyzett SSO SP, előjegyzett és közzétett portfólió szolgáltatások esetén, továbbá a hálózati Moodle hitelesítési segédprogramjával működik együtt. A segédprogram minden példánya a hiba elhárításáig rejtve marad. Kézzel kell ismét láthatóvá tennie őket.';
$string['failedtojump'] = 'Nem sikerült elindítani a távoli szerverrel való kommunikációt.';
$string['failedtoping'] = 'Nem sikerült elindítani a távoli szerverrel való kommunikációt: {$a}.';
$string['mnet_nofile'] = 'Az átviteli objektumban nincs meg az állomány - furcsa hiba';
$string['mnet_nofilecontents'] = 'Az átviteli objektumban megvan az állomány, de nem elérhető a tartalom - furcsa hiba: {$a}.';
$string['mnet_noid'] = 'A jelhez nincs meg az átviteli rekord.';
$string['mnet_notoken'] = 'Az átvitelhez nincs meg a jel.';
$string['mnet_wronghost'] = 'A jelhez a távoli gazdagép nem találja az átviteli rekordot.';
$string['mnethost'] = 'Hálózati Moodle-gazdagép';
$string['pf_description'] = 'Lehetővé teszi felhasználók számára, hogy a gazdagépre Moodle-tartalmat továbbítsanak<br />Jegyezze elő ezt a szolgáltatást, hogy portálján felhasználói tartalmakat továbbíthassanak ide:  {$a}.<br /><ul><li><em>Függőség</em>: emellett <strong>közzé kell tennie</strong> {$a} számára az SSO (azonosító) szolgáltatást.</li><li><em>Függőség</em>: emellett <strong>elő kell jegyeznie</strong> {$a} SSO (szolgáltató) szolgáltatását</li><li><em>Függőség</em>: A hálózati Moodle hitelesítési segédprogramját is be kell kapcsolnia.</li></ul>.<br />';
$string['pf_name'] = 'Portfólió-szolgáltatások';
$string['pluginname'] = 'Mahara ePortfolio';
$string['senddisallowed'] = 'Most nem küldhet át állományokat a Maharába.';
$string['url'] = 'URL';
