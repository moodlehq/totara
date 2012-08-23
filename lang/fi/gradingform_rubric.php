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
 * Strings for component 'gradingform_rubric', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   gradingform_rubric
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcriterion'] = 'Lisää arviointikriteeri';
$string['alwaysshowdefinition'] = 'Salli käyttäjien esikatsella moduulissa käytettyä arviointimatriisia (muuten matriisi tulee nähtäväksi vasta arvioinnin jälkeen)';
$string['backtoediting'] = 'Takaisin muokkaamaan';
$string['confirmdeletecriterion'] = 'Haluatko varmasti poistaa tämän arviointikriteerin?';
$string['confirmdeletelevel'] = 'Haluatko varmasti poistaa tämän arviointitason?';
$string['criterionaddlevel'] = 'Lisää arviointitaso';
$string['criteriondelete'] = 'Poista arviointikriteeri';
$string['criterionempty'] = 'Arviointikriteerin muokkaus';
$string['criterionmovedown'] = 'Siirrä alas';
$string['criterionmoveup'] = 'Siirrä ylös';
$string['definerubric'] = 'Määritä arviointimatriisi';
$string['description'] = 'Kuvaus';
$string['enableremarks'] = 'Arvioija saa lisätä sanallista palautetta kuhunkin arviointikriteeriin';
$string['err_mintwolevels'] = 'Kussakin arviointikriteerissä on oltava vähintään kaksi arviointitasoa';
$string['err_nocriteria'] = 'Arviointimatriisissa tulee olla vähintään yksi arviointikriteeri';
$string['err_nodefinition'] = 'Arvointitason kuvaus ei voi olla tyhjä';
$string['err_nodescription'] = 'Arviointikriteerin kuvaus ei voi olla tyhjä';
$string['err_scoreformat'] = 'Kunkin arviointitason pistemäärän on oltava oikeellinen, ei-negatiivinen luku';
$string['err_totalscore'] = 'Arviointimatriisin antamien pisteiden summan on oltava yli 0';
$string['gradingof'] = '{$a} arviointi';
$string['leveldelete'] = 'Poista arviointitaso';
$string['levelempty'] = 'Muokkaa arviointitasoa';
$string['name'] = 'Nimi';
$string['needregrademessage'] = 'Arviointimatriisia on muokattu tämän opiskelijan arvioinnin jälkeen. Ko. opiskelija ei voi nähdä arviointia ennen kuin tarkistat arviointikriteerit ja päivität arvosanan.';
$string['pluginname'] = 'Arviointimatriisi';
$string['previewrubric'] = 'Esikatsele arviointimatriisia';
$string['regrademessage1'] = 'Olet tallentamassa muutoksia arviointimatriisiin, jota on jo käytetty arviointiin. Kerro, onko jo annettuja arvosanoja tarpeen korjata. Jos näet tämän tekstin, arviointi piilotetaan opiskelijoilta kunnes olet korjannut heidän arvosanansa.';
$string['regrademessage5'] = 'Olet tallentamassa merkittäviä muutoksia arviointimatriisiin, jota jo on käytetty arviointiin. Arviointikirjaa ei muuteta, mutta arviointi piilotetaan opiskelijoilta kunnes olet korjannut heidän arvosanansa.';
$string['regradeoption0'] = 'Ei tarvitse arvioida uudelleen';
$string['regradeoption1'] = 'Arvioi uudelleen';
$string['restoredfromdraft'] = 'HUOM: Viimeisin tämän osallistujan arviointiyritys ei tallentunut oikein, joten arvosanoista on palautettu luonnokset. Jos haluat perua nämä muutokset, käytä alla olevaa Peru-painiketta.';
$string['rubric'] = 'Arviointimatriisi';
$string['rubricmapping'] = 'Pisteet arvosanojen yhdistämissäännöille';
$string['rubricmappingexplained'] = 'Tämän arviointimatriisin minimipistemäärä on <b>{$a->minscore}</b> ja se muutetaan tämän tehtävän alimmaksi arvosanaksi (joka on 0, jos ei muuta asteikkoa ole käytetty). Arvointimatriisin maksimipisteet  <b>{$a->maxscore}</b> muutetaan ylimmäksi arvosanaksi .<br />Välipisteet muutetaan arvosana-asteikolle vastaavasti ja pyöristetään lähimpään arvosanaan.<br /> Jos käytössä on (sanallisten) arvosanojen sijaan (numeerinen) asteikko, matriisin pisteet muutetaan asteikolle peräkkäisinä kokonaislukuina.';
$string['rubricnotcompleted'] = 'Valitse kullekin arviointikriteerille';
$string['rubricoptions'] = 'Arviointimatriisin asetukset';
$string['rubricstatus'] = 'Arviointimatriisin tilanne';
$string['save'] = 'Tallenna';
$string['saverubric'] = 'Tallenna arviointimatriisi valmiiksi käyttöön';
$string['saverubricdraft'] = 'Tallenna luonnoksena';
$string['scorepostfix'] = '{$a} pistettä';
$string['showdescriptionstudent'] = 'Näytä arviointimatriisin kuvaukset arvioitaville opiskelijoille';
$string['showdescriptionteacher'] = 'Näytä arviointimatriisin kuvaukset arvioinnin aikana';
$string['showremarksstudent'] = 'Näytä sanalliset kommentit arvioitaville opiskelijoille';
$string['showscorestudent'] = 'Näytä kunkin arviointitason pisteet arvioitaville opiskelijoille';
$string['showscoreteacher'] = 'Näytä kunkin arviointitason pisteet arvioinnin aikana';
$string['sortlevelsasc'] = 'Arviointitasojen lajittelujärjestys:';
$string['sortlevelsasc0'] = 'Pisteiden mukaan laskeva järjestys';
$string['sortlevelsasc1'] = 'Pisteiden mukaan nouseva järjestys';
