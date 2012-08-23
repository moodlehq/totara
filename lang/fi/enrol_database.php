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
 * Strings for component 'enrol_database', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_database
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['dbencoding'] = 'Tietokannan koodaus';
$string['dbhost'] = 'Tietokantapalvelimen isäntäkone';
$string['dbhost_desc'] = 'Kirjoita tietokantapalvelimen IP-osoite tai host-nimi';
$string['dbname'] = 'Käytettävä tietokanta';
$string['dbpass'] = 'Tietokannan salasana';
$string['dbsetupsql'] = 'Tietokannan asetuskomento';
$string['dbsetupsql_desc'] = 'SQL-komento erityisiin tietokannan asetuksiin, usein käytetty asettamaan merkistökoodaus - esimerkiksi MySQL:lle ja PostgreSQL:lle: <em>SET NAMES \'utf8\'</em>';
$string['dbsybasequoting'] = 'Käytä sybase-lainausmerkkejä';
$string['dbsybasequoting_desc'] = 'Sybase-tyylinen heittomerkkien käsittely - tarvitaan Oracle-, MS SQL- ja joillekin muille tietokannoille. Älä käytä MySQL:n kanssa!';
$string['dbtype'] = 'Tietokanta-ajuri';
$string['dbtype_desc'] = 'ADOdb tietokanta-ajurin nimi, ulkoisen tietokantamoottorin tyyppi';
$string['dbuser'] = 'Tietokannan käyttäjä';
$string['debugdb'] = 'Debuggaa ADOdb';
$string['debugdb_desc'] = 'Debuggaa ADOdb yhteys ulkoiseen tietokantaan - käytä kun kirjautumisen aikana tulee tyhjä sivu. Ei sopiva tuotannossa oleville sivustoille!';
$string['defaultcategory'] = 'Uuden kurssin oletuskategoria';
$string['defaultcategory_desc'] = 'Automaattisesti luotujen kurssien oletuskategoria. Käytetään kun uuden kategorian id:tä ei ole määritelty tai ei löydy.';
$string['defaultrole'] = 'Oletusrooli';
$string['defaultrole_desc'] = 'Rooli, joka annetaan oletuksena jos muuta roolia ei ole määritelty ulkoisessa taulukossa.';
$string['ignorehiddencourses'] = 'Ohita piilotetut kurssit';
$string['ignorehiddencourses_desc'] = 'Jos käytössä, käyttäjät eivät ole kirjautuneena kursseille, jotka eivät ole opiskelijoiden saatavilla.';
$string['localcoursefield'] = 'Paikallinen kurssi -tietokenttä';
$string['localrolefield'] = 'Paikallinen rooli -tietokenttä';
$string['localuserfield'] = 'Paikallinen käyttäjä -tietokenttä';
$string['newcoursecategory'] = 'Uusi kurssikategoria -id-kenttä';
$string['newcoursefullname'] = 'Uuden kurssin nimi -tietokenttä';
$string['newcourseidnumber'] = 'Uuden kurssin ID-numero -tietokenttä';
$string['newcourseshortname'] = 'Uuden kurssin lyhytnimi -tietokenttä';
$string['newcoursetable'] = 'Ulkoiset uudet kurssit -taulu';
$string['newcoursetable_desc'] = 'Määritä taulun nimi, joka sisältää listan kursseista, jotka pitäisi luoda automaattisesti. Tyhjä tarkoittaa ettei kursseja luoda.';
$string['pluginname'] = 'Ulkoinen tietokanta';
$string['pluginname_desc'] = 'Voit käyttää ulkoista tietokantaa (lähes minkä tahansa tyyppistä) hallitaksesi rekisteröitymisiäsi. Oletetaan että ulkoinen tietokantasi sisältää vähintään kentät, joissa on kurssi-ID sekä käyttäjä-ID. Näitä verrataan kenttiin, jotka valitset paikalliselta kurssilta ja käyttäjätauluista.';
$string['remotecoursefield'] = 'Ulkoinen kurssi -kenttä';
$string['remotecoursefield_desc'] = 'Ulkoisen taulun kentän nimi, jota käytetään yhdistämään merkinnät kurssitaulussa';
$string['remoteenroltable'] = 'Ulkoisen käyttäjän kirjautuminen -taulu';
$string['remoteenroltable_desc'] = 'Määritä taulun nimi, joka sisältää listan käyttäjien kirjautumisesta. Tyhjä tarkoittaa ettei käyttäjien kirjautumista synkronoida.';
$string['remoterolefield'] = 'Ulkoinen rooli -kenttä';
$string['remoterolefield_desc'] = 'Ulkoisen taulun kentän nimi, jota käytetään yhdistämään merkinnät roolitaulussa';
$string['remoteuserfield'] = 'Ulkoinen käyttäjä -kenttä';
$string['remoteuserfield_desc'] = 'Ulkoisen taulun kentän nimi, jota käytetään yhdistämään merkinnät käyttäjätaulussa';
$string['settingsheaderdb'] = 'Ulkoinen tietokantayhteys';
$string['settingsheaderlocal'] = 'Paikallisten kenttien kartoitus';
$string['settingsheadernewcourses'] = 'Uusien kurssien luonti';
$string['settingsheaderremote'] = 'Ulkoisen kirjautumisen synkronointi';
$string['templatecourse'] = 'Uuden kurssin mallipohja';
$string['templatecourse_desc'] = 'Valinnainen: automaattisesti luodut kurssit voivat kopioida asetuksensa mallipohja-kurssilta. Kirjoita tähän malli-kurssin lyhytnimi.';
