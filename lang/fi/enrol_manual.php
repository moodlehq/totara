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
 * Strings for component 'enrol_manual', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_manual
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['alterstatus'] = 'Muuta tilaa';
$string['altertimeend'] = 'Muuta loppumisaikaa';
$string['altertimestart'] = 'Muuta alkamisaikaa';
$string['assignrole'] = 'Määritä rooli';
$string['confirmbulkdeleteenrolment'] = 'Oletko varma että haluat poistaa nämä käyttäjien kirjautumiset?';
$string['defaultperiod'] = 'Kirjautumisen oletusaika';
$string['defaultperiod_desc'] = 'Kirjautumisen voimassaolon oletusaika (sekunteina). Jos asetettu nollaksi, kirjautumisen kesto on oletuksena päättymätön.';
$string['defaultperiod_help'] = 'Kirjautumisen voimassaolon oletusaika, alkaen siitä hetkestä kun käyttäjä kirjautuu kurssille. Jos estetty, kirjautumisen kesto on oletuksena päättymätön.';
$string['deleteselectedusers'] = 'Poista valitut osallistujat';
$string['editenrolment'] = 'Muokkaa kirjautumista';
$string['editselectedusers'] = 'Muokkaa valittuja osallistujatietoja';
$string['enrolledincourserole'] = 'Liitytty kursille "{$a->course}" roolissa"{$a->role}"';
$string['enrolusers'] = 'Lisää osallistujia';
$string['manual:config'] = 'Määritä asetukset käyttäjien lisäämiselle käsin';
$string['manual:enrol'] = 'Lisää osallistujia';
$string['manual:manage'] = 'Hallitse käyttäjien kirjautumisia';
$string['manual:unenrol'] = 'Poista käyttäjät kurssilta';
$string['manual:unenrolself'] = 'Kirjaudu pois kurssilta';
$string['pluginname'] = 'Osallistujien lisääminen';
$string['pluginname_desc'] = 'Käyttäjien lisäämis-lisäosalla käyttäjiä lisätään kurssialueelle käsin kurssialueen ylläpitoasetuksissa olevan linkin kautta riittävät oikeudet omaavan käyttäjän, kuten opettajan, toimesta. Lisäosan pitäisi normaalisti olla käytössä, koska jotkin toiset rekisteröitymislisäosat, kuten itserekisteröityminen, vaativat sen.';
$string['status'] = 'Aktivoi käyttäjien lisääminen käsin';
$string['status_desc'] = 'Salli kurssille pääsy sisäisesti kirjautuneille käyttäjille. Tämä pitäisi sallia useimmissa tapauksissa.';
$string['status_help'] = 'Tämä asetus määrittelee voidaanko käyttäjät kirjata manuaalisesti, kurssin ylläpitoasetuksissa olevan linkin kautta vai riittävät oikeudet omaavan käyttäjän, kuten opettajan, toimesta.';
$string['statusdisabled'] = 'Estetty';
$string['statusenabled'] = 'Sallittu';
$string['unenrol'] = 'Poista käyttäjä';
$string['unenrolselectedusers'] = 'Poista valitut käyttäjät';
$string['unenrolselfconfirm'] = 'Haluatko todella kirjautua pois kurssilta "{$a}"?';
$string['unenroluser'] = 'Haluatko todella kirjata käyttäjän "{$a->user}" pois kurssilta "{$a->course}"?';
$string['unenrolusers'] = 'Poista käyttäjiä';
$string['wscannotenrol'] = 'Plugin instanssi ei voi manuaalisesti kirjata käyttäjää kurssille id = {$a->courseid}';
$string['wsnoinstance'] = 'Manuaalista kirjautumisplugin instanssia ei ole tai se on otettu pois käytöstä kurssilla (id = {$a->courseid})';
$string['wsusercannotassign'] = 'Sinulla ei ole oikeutta antaa roolia ({$a->roleid}) tälle käyttäjälle ({$a->userid}) tällä kurssilla ({$a->courseid}).';
