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
 * Strings for component 'enrol_self', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_self
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['customwelcomemessage'] = 'Tervetuloviesti';
$string['defaultrole'] = 'Oletusrooli';
$string['defaultrole_desc'] = 'Valitse rooli, joka annetaan käyttäjille itserekisteröinnin yhteydessä';
$string['editenrolment'] = 'Muokkaa rekisteröitymistä';
$string['enrolenddate'] = 'Päättyy';
$string['enrolenddate_help'] = 'Jos aktivoituna, käyttäjät voivat itserekisteröityä vain tähän päivään asti.';
$string['enrolenddaterror'] = 'Rekisteröitymisjakson loppumisaika ei voi olla ennen alkamisaikaa';
$string['enrolme'] = 'Lisää minut kurssialueelle';
$string['enrolperiod'] = 'Rekisteröitymisen kesto';
$string['enrolperiod_desc'] = 'Kurssille rekisteröitymisajan oletuskesto (sekuntia). Jos asetuksena käyttää nollaa (0), kurssillaoloaika on oletuksena rajoittamaton.';
$string['enrolperiod_help'] = 'Kurssillaolon voimassaolo siitä hetkestä lähtien, kun käyttäjä lisää itsensä tai lisäät käyttäjän kurssialueelle. Jos asetus ei ole käytössä, kurssillaoloaika on rajoittamaton.';
$string['enrolstartdate'] = 'Alkaa';
$string['enrolstartdate_help'] = 'Jos tämä on aktivoitu, käyttäjät voivat liittyä kurssialueelle vain tästä päivästä lähtien.';
$string['groupkey'] = 'Käytä ryhmäavaimia';
$string['groupkey_desc'] = 'Käytä oletuksena ryhmäavaimia.';
$string['groupkey_help'] = 'Sen lisäksi, että kurssiavaimen avulla osallistuja voi liittää itsensä kurssille, ryhmäavaimen käyttö lisää käyttäjät automaattisesti tiettyyn ryhmään kurssialueelle liittymisen yhteydessä.
Kun haluat käyttää ryhmäavaimia, määrittele kurssiasetuksiin kurssiavain JA kunkin ryhmän asetuksiin oma ryhmäavain.';
$string['longtimenosee'] = 'Poista passiiviset käyttäjät kun';
$string['longtimenosee_help'] = 'Jos käyttäjät eivät ole käyneet kurssilla pitkään aikaan, heidät kirjataan automaattisesti pois. Tämä parametri määrittelee tuon aikarajan.';
$string['maxenrolled'] = 'Osallistujamäärän yläraja';
$string['maxenrolled_help'] = 'Tämä asetus määrittelee, kuinka monta käyttäjää voi korkeintaan lisätä itsensä kurssille käyttäen itserekisteröitymistä. 0 tarkoittaa ettei rajaa ole.';
$string['maxenrolledreached'] = 'Itserekisteröitymistä käyttävien osallistujien maksimimäärä oli jo saavutettu.';
$string['nopassword'] = 'Kurssiavainta ei vaadita.';
$string['password'] = 'Kurssiavain';
$string['password_help'] = 'Kurssiavaimella voit rajoittaa kurssille pääsyn vain niihin, jotka tietävät avaimen.
Jos kenttä jätetään tyhjäksi, kuka tahansa voi liittyä kurssille.
Jos kurssiavain on määritelty, kaikkien kurssille liittyvien täytyy antaa avain. Huomaa, että käyttäjien täytyy antaa avain vain KERRAN eli silloin kun he liittyvät kurssialueelle.';
$string['passwordinvalid'] = 'Väärä kurssiavain, yritä uudelleen.';
$string['passwordinvalidhint'] = 'Tarjottu kurssiavain ei kelpaa, yritä uudelleen<br />
(Vihje - se alkaa näin: \'{$a}\')';
$string['pluginname'] = 'Itserekisteröityminen';
$string['pluginname_desc'] = 'Itserekisteröitymislisäosa antaa käyttäjien päättää, mille kurssialueille he haluavat rekisteröityä. Kurssialueet saattavat olla kurssiavaimella suojattuja.';
$string['requirepassword'] = 'Vaadi kurssiavain';
$string['requirepassword_desc'] = 'Vaadi uusilla kurssialueilla kurssiavain ja estä kurssiavaimen poisto olemassa olevilta kurssialueilta.';
$string['role'] = 'Määritä rooli';
$string['self:config'] = 'Määritä itserekisteröitymisen asetukset';
$string['self:manage'] = 'Osallistujien hallinnointi';
$string['self:unenrol'] = 'Poista käyttäjiä kurssilta';
$string['self:unenrolself'] = 'Itsensä poistaminen kurssialueelta';
$string['sendcoursewelcomemessage'] = 'Lähetä kurssin tervetuloviesti';
$string['sendcoursewelcomemessage_help'] = 'Jos käytössä, käyttäjät saavat tervetuloviestin sähköpostilla kurssialueelle liittyessään.';
$string['showhint'] = 'Näytä vihje';
$string['showhint_desc'] = 'Näytä ensimmäinen kirjain vierailija-avaimesta.';
$string['status'] = 'Salli itserekisteröityminen';
$string['status_desc'] = 'Salli oletuksena osallistujien itse liittyä kurssialueelle';
$string['status_help'] = 'Tämä asetus määrittelee voivatko käyttäjät kirjata itsensä kurssille (sekä pois kurssilta jos heillä on tarvittavat oikeudet).';
$string['unenrol'] = 'Poista käyttäjä';
$string['unenrolselfconfirm'] = 'Haluatko todella poistua kurssalueelta "{$a}"?';
$string['unenroluser'] = 'Haluatko todella kirjata käyttäjän "{$a->user}" pois kurssilta "{$a->course}"?';
$string['usepasswordpolicy'] = 'Käytä salasanakäytäntöä';
$string['usepasswordpolicy_desc'] = 'Käytä kurssiavaimille salasanojen vakiokäytäntöä.';
$string['welcometocourse'] = 'Tervetuloa kurssille {$a}';
$string['welcometocoursetext'] = 'Tervetuloa kurssille {$a->coursename}!

Ensimmäiseksi sinun kannattaa muokata käyttäjätietojasi, jotta muut voivat tutustua sinuun:

{$a->profileurl}';
