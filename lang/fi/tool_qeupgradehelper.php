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
 * Strings for component 'tool_qeupgradehelper', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_qeupgradehelper
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Toiminto';
$string['alreadydone'] = 'Kaikki on jo muunnettu';
$string['areyousure'] = 'Oletko varma?';
$string['areyousuremessage'] = 'Haluatko päivittää kaikki {$a->numtoconvert} suorituskertaa tentissä \'{$a->name}\' kurssilla {$a->shortname}?';
$string['areyousureresetmessage'] = 'Tenttissä \'{$a->name}\' kurssilla {$a->shortname} on {$a->totalattempts} suoritusta, joista {$a->convertedattempts} päivitettiin vanhasta järjestelmästä. Niistä {$a->resettableattempts} voidaan palauttaa myöhemmin uudelleen konvertoitaviksi. Haluatko jatkaa palauttamista?';
$string['attemptstoconvert'] = 'Yriytykset, jotka täytyy muuntaa';
$string['backtoindex'] = 'Takaisin aloitussivulle';
$string['conversioncomplete'] = 'Muuntaminen valmis';
$string['convertattempts'] = 'Muunna suoritukset';
$string['convertedattempts'] = 'Muunnetut suoritukset';
$string['convertquiz'] = 'Muunna suoritukset...';
$string['cronenabled'] = 'Cron toiminnassa';
$string['croninstructions'] = 'Voit asettaa cronin päättämään päivityksen automaattisesti osittaisen päivityksen jälkeen. Cron ajetaan määriteltynä aikana (palvelimen paikallisen ajan mukaan). Joka kerta kun cron ajetaan, se yrittää suoritusta toistuvasti kunnes aikaa on kulunut Aikarajan verran. Sen jälkeen cron pysähtyy ja odottaa seuraavaa ajoa. Vaikka olisit asettanut cronin toimintaan, se ei tee mitään, jollei pääversion päivitystä versioon 2.1 ole suoritettu.';
$string['cronprocesingtime'] = 'Käsittelyaika jokaisessa cron-ajossa';
$string['cronsetup'] = 'Konfiguroi cron';
$string['cronsetup_desc'] = 'Voit asettaa cronin ajamaan tentin suoritusdatan päivityksen automaattisesti.';
$string['cronstarthour'] = 'Aloitustunti';
$string['cronstophour'] = 'Lopetustunti';
$string['extracttestcase'] = 'Poimi testitapaus';
$string['extracttestcase_desc'] = 'Käytä tietokannasta esimerkkidataa, jolla voidaan luoda yksikkötestejä, joilla voidaan testata päivitystä.';
$string['gotoindex'] = 'Takaisin päivitettävien tenttien listaan';
$string['gotoquizreport'] = 'Mene tämän tentin raportteihin tarkistaaksesi päivityksen';
$string['gotoresetlink'] = 'Mene palautettavien tenttien listaan';
$string['includedintheupgrade'] = 'Sisältyy päivitykseen?';
$string['invalidquizid'] = 'Virheellinen tentti-id. Joko tenttiä ei ole tai siinä ei ole muunnettavia suorituksia.';
$string['listpreupgrade'] = 'Listaa tentit ja suoritukset';
$string['listpreupgrade_desc'] = 'Tämä näyttää järjestelmän kaikki tentit sekä montako suoritusta niissä on. Tämä antaa sinulle käsityksen suoritettavan päivityksen laajuudesta.';
$string['listpreupgradeintro'] = 'Nämä ovat määrät tenttisuorituksia, jotka pitää käsitellä kun päivität sivustosi. Muutama kymmenen tuhatta ei ole ongelma. Jos määrä on paljon suurempi, sinun täytyy miettiä kauanko päivitys kestää.';
$string['listtodo'] = 'Listaa vielä päivitettävät tentit';
$string['listtodo_desc'] = 'Tämä näyttää raportin kaikista järjestelmän tenteistä (jos niitä on), joissa on suorituksia, jotka pitää vielä päivittää uuteen kysymysmoottoriin.';
$string['listtodointro'] = 'Nämä ovat ne tentit, joissa on suorituksia, jotka pitää vielä muuntaa. Voit muuntaa yritykset klikkaamalla linkkiä.';
$string['listupgraded'] = 'Listaa päivitetyt tentit, jotka voidaan palauttaa';
$string['listupgraded_desc'] = 'Tämä näyttää raportin kaikista järjestelmän tenteistä, joiden suoritukset on päivitetty, ja joissa vanha data on vielä tallessa niin, että päivitys voidaan palauttaa ja tehdä uudelleen.';
$string['listupgradedintro'] = 'Nämä ovat kaikki ne tentit, joissa on päivitettyjä suorituksia sekä vanhat suoritustiedot niin, että ne voidaan palauttaa ja päivittää uudelleen.';
$string['noquizattempts'] = 'Sivustollasi ei ole yhtään tenttisuorituksia!';
$string['nothingupgradedyet'] = 'Ei päivitettyjä suorituksia, jotka voitaisiin palauttaa';
$string['notupgradedsiterequired'] = 'Tämä skripti toimii ainoastaan ennen kuin sivusto on päivitetty.';
$string['numberofattempts'] = 'Tenttisuoritusten määrä';
$string['oldsitedetected'] = 'Tämä vaikuttaa olevan sivusto, jota ei vielä ole päivitetty uuteen kysymysmoottoriin.';
$string['outof'] = '{$a->some} kokonaismäärästä {$a->total}';
$string['pluginname'] = 'Kysymysmoottorin päivitysapuri';
$string['pretendupgrade'] = 'Korotusyritysten uudelleenarvioinnin esikatselu';
$string['pretendupgrade_desc'] = 'Päivitys tekee kolme asiaa: Lataa olemassa olevan datan tietokannasta; muuntaa sen; kirjoittaa muunnetun datan tietokantaan. Tämä skripti testaa prosessin kaksi ensimmäistä osaa.';
$string['questionsessions'] = 'Kysymyssessiot';
$string['quizid'] = 'Tentti-id';
$string['quizupgrade'] = 'Tentin päivityksen tila';
$string['quizzesthatcanbereset'] = 'Seuraavissa tenteissä on muunnettuja suorituksia, jotka voit mahdollisesti palauttaa';
$string['quizzestobeupgraded'] = 'Kaikki tentit, joissa on suorituksia';
$string['quizzeswithunconverted'] = 'Seuraavissa tenteissä on suorituksia, jotka täytyy muuntaa';
$string['resetcomplete'] = 'Palautus valmis';
$string['resetquiz'] = 'Palautusyritykset...';
$string['resettingquizattempts'] = 'Palautetaan tenttisuorituksia';
$string['resettingquizattemptsprogress'] = 'Palautetaan suoritusta {$a->done} / {$a->outof}';
$string['upgradedsitedetected'] = 'Tämä vaikuttaa olevan sivusto, joka on päivitetty uuteen kysymysmoottoriin.';
$string['upgradedsiterequired'] = 'Tämä skripti toimii vain kun sivusto on päivitetty.';
$string['upgradingquizattempts'] = 'Päivitetään suorituksia tentille \'{$a->name}\' kurssilla {$a->shortname}';
$string['veryoldattemtps'] = 'Sivustollasi on {$a} tenttisuoritusta, joita ei koskaan päivitetty loppuun saakka päivitettäessä Moodle versiosta 1.4 versioon 1.5. Nämä suoritukset käsitellään ennen pääpäivitystä. Sinun täytyy ottaa huomioon tähän menevä lisäaika.';
