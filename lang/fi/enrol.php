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
 * Strings for component 'enrol', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actenrolshhdr'] = 'Saatavilla olevat rekisteröitymislisäosat.';
$string['addinstance'] = 'Lisää rekisteröitymistapa';
$string['ajaxnext25'] = 'Seuraavat 25...';
$string['ajaxoneuserfound'] = '1 käyttäjä löytyi';
$string['ajaxxusersfound'] = '{$a} käyttäjää löytyi';
$string['assignnotpermitted'] = 'Sinulla ei ole oikeuksia lisätä käyttäjiä tälle kurssialueelle.';
$string['bulkuseroperation'] = 'Käyttäjien massatoiminnot';
$string['configenrolplugins'] = 'Valitse kaikki tarvittavat lisäosat ja järjestä ne tarkoituksenmukaiseen järjestykseen.';
$string['custominstancename'] = 'Rekisteröitymistavan nimi';
$string['defaultenrol'] = 'Lisää rekisteröitymistapa uusille kursseille';
$string['defaultenrol_desc'] = 'Tämä lisäosa voidaan lisätä oletusarvoisena kaikille uusille kurssialueille.';
$string['deleteinstanceconfirm'] = 'Haluatko varmasti poistaa rekisteröitymislisäosan instanssin "{$a->name}" jolla on {$a->users} rekisteröityneitä käyttäjiä?';
$string['durationdays'] = '{$a} päivää';
$string['enrol'] = 'Lisää';
$string['enrolcandidates'] = 'Ei rekisteröityneitä käyttäjiä';
$string['enrolcandidatesmatching'] = 'Ei täsmää rekisteröityneisiin käyttäjiin';
$string['enrolcohort'] = 'Rekisteröi kohortti';
$string['enrolcohortusers'] = 'Lisää osallistujia';
$string['enrollednewusers'] = 'Lisätty onnistuneesti {$a} uutta osallistujaa';
$string['enrolledusers'] = 'Osallistujat';
$string['enrolledusersmatching'] = 'Täsmää kurssialueen osallistujiin';
$string['enrolme'] = 'Lisää minut tälle kurssille';
$string['enrolmentinstances'] = 'Osallistujien lisäämistavat';
$string['enrolmentnew'] = 'Uusi osallistuja kurssille {$a}';
$string['enrolmentnewuser'] = '{$a->user} on liittynyt kurssille "{$a->course}"';
$string['enrolmentoptions'] = 'Kurssialueelle liittyminen';
$string['enrolments'] = 'Rekisteröitymiset';
$string['enrolnotpermitted'] = 'Sinulla ei ole oikeuksia lisätä muita käyttäjiä tälle kurssialueelle';
$string['enrolperiod'] = 'Kurssialueelle liittymisajan kesto';
$string['enroltimeend'] = 'Kurssialueelle liittyminen päättyy';
$string['enroltimestart'] = 'Kurssialueelle liittyminen alkaa';
$string['enrolusage'] = 'Instanssit / rekisteröitymiset';
$string['enrolusers'] = 'Lisää osallistujia';
$string['errajaxfailedenrol'] = 'Käyttäjää ei voitu lisätä';
$string['errajaxsearch'] = 'Käyttäjien hakemisessa tapahtui virhe';
$string['erroreditenrolment'] = 'Käyttäjän rekisteröitymisen muokkauksessa tapahtui virhe';
$string['errorenrolcohort'] = 'Kohortin rekisteröitymissynkronoinnin luomisessa tälle kurssialueelle tapahtui virhe.';
$string['errorenrolcohortusers'] = 'Virhe lisättäessä kohortin jäseniä kurssialueelle.';
$string['errorwithbulkoperation'] = 'Virhe käsiteltäessä massarekisteröitymisen muutosta.';
$string['extremovedaction'] = 'Ulkoinen kurssialueelta poistumistoiminto';
$string['extremovedaction_help'] = 'Valitse toiminto, joka suoritetaan kun käyttäjän kirjautuminen katoaa ulkoisesta rekisteröitymislähteestä. Ota huomioon, että jotkin käyttäjätiedot ja asetukset poistetaan kurssialueelta ulosrekisteröitymisen yhteydessä.';
$string['extremovedkeep'] = 'Pidä käyttäjä liittyneenä kurssialueelle';
$string['extremovedsuspend'] = 'Estä kurssialueelle liittyminen';
$string['extremovedsuspendnoroles'] = 'Estä kurssialueelle liittyminen ja poista roolit';
$string['extremovedunenrol'] = 'Poista käyttäjä kurssialueelta';
$string['finishenrollingusers'] = 'Lopeta osallistujien lisääminen';
$string['invalidenrolinstance'] = 'Epäkelpo rekisteröitymisinstanssi';
$string['invalidrole'] = 'Epäkelpo rooli';
$string['manageenrols'] = 'Hallinnoi rekisteröitymislisäosia';
$string['manageinstance'] = 'Hallinnoi';
$string['nochange'] = 'Ei muutosta';
$string['noexistingparticipants'] = 'Ei olemassa olevia osallistujia';
$string['noguestaccess'] = 'Vierailijat eivät pääse tälle kurssille. Kirjaudu sisään.';
$string['none'] = 'Ei yhtään';
$string['notenrollable'] = 'Et voi itse liittyä tälle kurssialueelle.';
$string['notenrolledusers'] = 'Muut käyttäjät';
$string['otheruserdesc'] = 'Seuraavat käyttäjät eivät ole rekisteröityneet tälle kurssialueelle, mutta heillä on siinä rooleja, perityneitä tai siellä annettuja.';
$string['participationactive'] = 'Aktiivinen';
$string['participationstatus'] = 'Tila';
$string['participationsuspended'] = 'Keskeytetty';
$string['periodend'] = '{$a} saakka';
$string['periodstart'] = 'alkaen {$a}';
$string['periodstartend'] = 'alkaen {$a->start}, {$a->end} saakka';
$string['recovergrades'] = 'Jos mahdollista, palauta käyttäjän vanhat arvosanat';
$string['rolefromcategory'] = '{$a->role} (periytynyt kurssikategoriasta)';
$string['rolefrommetacourse'] = '{$a->role} (periytynyt yläkurssilta)';
$string['rolefromsystem'] = '{$a->role} (annettu sivuston tasolla)';
$string['rolefromthiscourse'] = '{$a->role} (annettu tällä kurssilla)';
$string['startdatetoday'] = 'Tänään';
$string['synced'] = 'Synkronoitu';
$string['totalenrolledusers'] = '{$a} osallistujaa';
$string['totalotherusers'] = '{$a} muuta käyttäjää';
$string['unassignnotpermitted'] = 'Sinulla ei ole oikeuksia poistaa rooleja tältä kurssilta.';
$string['unenrol'] = 'Poista kurssilta';
$string['unenrolconfirm'] = 'Haluatko varmasti poistaa käyttäjän "{$a->user}"  kurssilta "{$a->course}"?';
$string['unenrolme'] = 'Poista minut kurssilta {$a}';
$string['unenrolnotpermitted'] = 'Sinulla ei ole oikeuksia poistaa tätä käyttäjää tältä kurssilta.';
$string['unenrolroleusers'] = 'Poista kayttäjiä kurssialueelta';
$string['uninstallconfirm'] = 'Olet poistamassa rekisteröitymislisäosaa \'{$a}\'. Toimenpide poistaa tietokannasta kaiken, mikä liittyy tähän rekisteröitymistyyppiin. Oletko varma, että haluat jatkaa?';
$string['uninstalldeletefiles'] = 'Kaikki data liittyen rekisteröitymislisäosaan \'{$a->plugin}\' on poistettu tietokannasta. Viimeistelläksesi poiston (ja estääksesi lisäosan automaattisen uudelleen-asentamisen), poista tämä hakemisto palvelimeltasi: {$a->directory}';
$string['unknowajaxaction'] = 'Tuntematon toiminto';
$string['unlimitedduration'] = 'Rajoittamaton';
$string['usersearch'] = 'Hae';
$string['withselectedusers'] = 'Valituille osallistujille';
