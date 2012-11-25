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
 * Strings for component 'rating', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   rating
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aggregateavg'] = 'Arviointien keskiarvo';
$string['aggregatecount'] = 'Arviointien määrä';
$string['aggregatemax'] = 'Arviointimaksimi';
$string['aggregatemin'] = 'Arviointiminimi';
$string['aggregatenone'] = 'Arviointi ei käytössä';
$string['aggregatesum'] = 'Arviointien summa';
$string['aggregatetype'] = 'Arviointien käyttöperiaate';
$string['aggregatetype_help'] = '## Opiskelijan työskentelyn vaikutus arvosanaan
Tämä ominaisuus määrittelee, millä tavalla aktiviteettien arvioinneista muodostetaan lopullinen arvosana. Vaihtoehtoja ovat:
\* **|Arviointien keskiarvo**: Osallistujan kaikkien arviointien keskiarvo.
\* **|Arviointien lukumäärä**: Osallistujan tuottamien, arviointikohteiden lukumäärästä tulee lopullinen arvosana. Huomaa, että kertynyt pistemäärä ei voi ylittää aktiviteetille määriteltyä maksimipistemäärää, ja yksittäiselle arviointikohteelle annetuilla pisteillä ei ole merkitystä.
\* **|Korkein arviointi**: Korkein osallistujan saama pistemäärä tai arvosana kaikista aktiviteeteista tulee lopulliseksi arvosanaksi. Tämä vaihtoehto on käyttökelpoinen, jos haluaa korostaa osallistujien parasta työskentelyä ja mahdollistaa korkealaatuisen työskentelyn ohella kevyemmänkin osallistumisen.
\* **|Heikoin arviointi**: Osallistujan kaikista aktiviteeteista saama heikoin pistemäärä tai arvosana tulee lopulliseksi arvosanaksi. Tämä vaihtoehto suosii kulttuuria, joka vaatii korkeaa laatua kaikilta tuotoksilta.
\* **|Pisteiden summa**: Osallistujan kaikista aktiviteeteista saamat pisteet lasketaan yhteen lopulliseksi pistemääräksi. Huomaa, että summa ei voi ylittää aktiviteetin maksimipistemäärää.

Huomaa, että jos arviointi ei ole aktiviteetissa ollenkaan käytössä, ko. aktiviteetista ei tule saraketta arviointikirjaan.';
$string['allowratings'] = 'Salli kohteiden arviointi?';
$string['allratingsforitem'] = 'Kaikki palautetut arvioinnit';
$string['capabilitychecknotavailable'] = 'Kykyjen tarkistus ei saatavilla kunnes aktiviteetti on tallennettu';
$string['couldnotdeleteratings'] = 'Valitettavasti kohdetta ei voida poistaa koska sillä on arvioita';
$string['norate'] = 'Kohteiden arviointi ei ole sallittu!';
$string['noratings'] = 'Ei palautettuja arvioita';
$string['noviewanyrate'] = 'Voit katsella vain tekemiesi kohteiden tuloksia';
$string['noviewrate'] = 'Sinulla ei ole kykyä kohteiden arvioiden katseluun';
$string['rate'] = 'Arvioi';
$string['ratepermissiondenied'] = 'Sinulla ei ole lupaa tämän kohteen arviointiin';
$string['rating'] = 'Arviointi';
$string['ratinginvalid'] = 'Arviointi on virheellinen';
$string['ratings'] = 'Arvioinnit';
$string['ratingtime'] = 'Rajoita arviointeja kohteisiin, joiden päivämäärät ovat raja-arvoissa:';
$string['rolewarning'] = 'Roolit, joilla on lupa antaa arvioita';
$string['rolewarning_help'] = 'Antaakseen arvioita käyttäjällä täytyy olla kyky moodle/rating:rate sekä mahdolliset moduulikohtaiset kyvyt. Käyttäjien, joilla on seuraavat roolit, pitäisi pystyä arvioimaan kohteita. Roolilistaa voidaan muuttaa asetuslohkon oikeudet-linkin kautta.';
