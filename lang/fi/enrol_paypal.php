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
 * Strings for component 'enrol_paypal', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_paypal
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Määritä rooli';
$string['businessemail'] = 'PayPal yrityssähköposti';
$string['businessemail_desc'] = 'Yrityksesi PayPal-tilin sähköposti';
$string['cost'] = 'Kirjautumishinta';
$string['costerror'] = 'Kirjautumishinta ei ole numeerinen';
$string['costorkey'] = 'Valitse jokin seuraavista kirjautumistavoista:';
$string['currency'] = 'Valuutta';
$string['defaultrole'] = 'Oletusrooli';
$string['defaultrole_desc'] = 'Valitse rooli joka asetetaan käyttäjille PayPal-kirjautumisessa';
$string['enrolenddate'] = 'Loppumispäivä';
$string['enrolenddate_help'] = 'Jos asetettu, käyttäjät voivat olla kirjautuneena vain tähän päivämäärään saakka';
$string['enrolenddaterror'] = 'Kirjautumisen loppumispäivä ei voi olla aiemmin kuin aloituspäivä';
$string['enrolperiod'] = 'Kirjautumisen kesto';
$string['enrolperiod_desc'] = 'Kirjautumisen voimassaolon oletuskesto (sekuntia). Jos nolla, kirjautumisen kesto on oletuksena rajoittamaton.';
$string['enrolperiod_help'] = 'Kirjautumisen voimassaolo siitä hetkestä lähtien, kun käyttäjä kirjautuu ensimmäisen kerran. Jos ei asetettu, kirjautumisen kesto on rajoittamaton.';
$string['enrolstartdate'] = 'Aloituspäivä';
$string['enrolstartdate_help'] = 'Jos asetettu, käyttäjät voivat kirjautua vain tästä päivästä eteenpäin.';
$string['mailadmins'] = 'Ilmoita ylläpitäjälle';
$string['mailstudents'] = 'Ilmoita opiskelijoille';
$string['mailteachers'] = 'Ilmoita opettajille';
$string['nocost'] = 'Tälle kurssille kirjautumiseen ei liity maksua!';
$string['paypal:config'] = 'Määritä PayPal-kirjautumisen asetukset';
$string['paypal:manage'] = 'Hallitse kirjautuneita käyttäjiä';
$string['paypal:unenrol'] = 'Poista käyttäjän ilmoittautuminen kurssilta';
$string['paypal:unenrolself'] = 'Kirjaudu pois kurssilta';
$string['paypalaccepted'] = 'PayPal maksu hyväksytty';
$string['pluginname'] = 'PayPal';
$string['pluginname_desc'] = 'PayPal-moduuli sallii sinun järjestää maksullisia kursseja. Jos hinta millekään kurssille on nolla, opiskelijoilta ei pyydetä maksua kyseiselle kurssille pääsystä. Asetuksissa on oletuskurssihinta, joka asetetaan koko sivustolle, sekä erikseen kurssikohtainen asetus. Kurssikohtainen hinta syrjäyttää oletuskurssihinnan.';
$string['sendpaymentbutton'] = 'Lähetä maksu PayPalin kautta';
$string['status'] = 'Salli PayPal-kirjautumiset';
$string['status_desc'] = 'Salli oletuksena käyttäjien kirjautua kurssille käyttäen PayPalia.';
$string['unenrolselfconfirm'] = 'Haluatko todella kirjautua pois kurssilta "{$a}"?';
