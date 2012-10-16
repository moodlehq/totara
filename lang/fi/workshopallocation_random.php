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
 * Strings for component 'workshopallocation_random', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   workshopallocation_random
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addselfassessment'] = 'Lisää itsearviointi';
$string['allocationaddeddetail'] = 'Uusi vertaisarviointi tehtäväksi: <strong>{$a->reviewername}</strong> arvioi osallistujan <strong>{$a->authorname} työtä</strong>';
$string['allocationdeallocategraded'] = 'Tätä jo arvioidun työn vertaisarviointivuoroa ei voida poistaa: arvioija <strong>{$a->reviewername}</strong>, työn tekijä: <strong>{$a->authorname}</strong>';
$string['allocationreuseddetail'] = 'Säilytetty vertaisarviointivuoro: <strong>{$a->reviewername}</strong> säilyi arvioijana osallistujalle <strong>{$a->authorname}</strong>';
$string['allocationsettings'] = 'Vertaisarviointivuorojen jakoon liittyvät asetukset';
$string['assessmentdeleteddetail'] = 'Poistettu vertaisarviointivuoro: <strong>{$a->reviewername}</strong> ei ole enää arvioija osallistujalle <strong>{$a->authorname}</strong>';
$string['assesswosubmission'] = 'Osallistujat saavat vertaisarvioida vaikka eivät olisi itse palauttaneet työtään';
$string['confignumofreviews'] = 'Satunnaisesti jaettavien vertaisarviointivuorojen oletusmäärä';
$string['excludesamegroup'] = 'Ei vertaisarviointeja saman ryhmän jäseniltä';
$string['noallocationtoadd'] = 'Ei lisättäviä vertaisarviointivuoroja';
$string['nogroupusers'] = '<p>HUOM: jos työpajassa käytetään Näkyviä tai Erillisiä ryhmiä, osallistujien <em>täytyy olla vähintään yhdessä ryhmässä</em>, että heille jaetaan vertaisarviointivuoroja! Osallistujille, jotka eivät ole yhdessäkään ryhmässä, voidaan silti antaa itsearviointeja ja heiltä voidaan poistaa olemassa olevia arviointeja.</p> <p>Nämä käyttäjät eivät ole tällä hetkellä yhdessäkään ryhmässä: {$a}</p>';
$string['numofdeallocatedassessment'] = 'Poistetaan vuorot {$a} kpl vertaisarvioinnista';
$string['numofrandomlyallocatedsubmissions'] = 'Jaetaan vertaisarviointivuorot satunnaisesti {$a} työlle';
$string['numofreviews'] = 'Annettujen vertaisarviointien määrä';
$string['numofselfallocatedsubmissions'] = 'Annetaan osallistujien itse valita arvioitavaksi {$a} työtä';
$string['numperauthor'] = 'per palautettu työ';
$string['numperreviewer'] = 'per arvioija';
$string['pluginname'] = 'Satunnainen arviointivuorojen jako';
$string['randomallocationdone'] = 'Satunnainen arviointivuorojen jako valmis';
$string['removecurrentallocations'] = 'Poista jaetut arviointivuorot';
$string['resultnomorepeers'] = 'Ei enempää vertaisia saatavilla';
$string['resultnomorepeersingroup'] = 'Ei enempää vertaisia tässä erillisessä ryhmässä';
$string['resultnotenoughpeers'] = 'Ei riittävästi vertaisia saatavilla';
$string['resultnumperauthor'] = 'Tavoitteena jakaa {$a} vertaisarvioijaa kullekin tekijälle';
$string['resultnumperreviewer'] = 'Tavoitteena jakaa {$a} vertaisarviointia kullekin arvioijalle';
$string['stats'] = 'Vertaisarviointivuorojen tilastot';
