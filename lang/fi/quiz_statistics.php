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
 * Strings for component 'quiz_statistics', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   quiz_statistics
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actualresponse'] = 'Varsinainen vastaus';
$string['allattempts'] = 'kaikki suorituskerrat';
$string['allattemptsavg'] = 'Kaikkien suorituskertojen arvosanojen keskiarvo';
$string['allattemptscount'] = 'Arvioitujen suorituskertojen kokonaismäärä';
$string['analysisofresponses'] = 'Vastausanalyysi';
$string['analysisofresponsesfor'] = 'Vastausanalyysi kohteelle {$a}.';
$string['attempts'] = 'Suorituskerrat';
$string['attemptsall'] = 'kaikki suorituskerrat';
$string['attemptsfirst'] = 'ensimmäinen suorituskerta';
$string['backtoquizreport'] = 'Takaisin tilastoraportin pääsivulle';
$string['calculatefrom'] = 'Laske tilastot kohteesta';
$string['cic'] = 'Sisäisen johdonmukaisuuden kerroin (kohteelle {$a})';
$string['completestatsfilename'] = 'täydelliset tilastot';
$string['count'] = 'Laske';
$string['coursename'] = 'Kurssin nimi';
$string['detailedanalysis'] = 'Yksityiskohtaisempi analyysi tämän kysymyksen vastauksista';
$string['discrimination_index'] = 'Diskriminointi-indeksi';
$string['discriminative_efficiency'] = 'Diskriminoinnin tehokkuus';
$string['downloadeverything'] = 'Lataa täysi raportti';
$string['duration'] = 'Avaa';
$string['effective_weight'] = 'Painokerroin';
$string['errordeleting'] = 'Virhe poistettaessa vanhoja {$a} tietoja.';
$string['erroritemappearsmorethanoncewithdifferentweight'] = 'Kysymys ({$a}) esiintyy useammin kuin kerran eri painokertoimella eri testin osissa. Tilastoraportti ei tue tällä hetkellä tällaista ja saattaa tehdä tämän kysymyksen tilastoista epäluotettavia.';
$string['errormedian'] = 'Virhe noudettaessa mediaani';
$string['errorpowerquestions'] = 'Virhe noudettaessa tietoja kysymysten arvosanojen varianssin laskemiseen';
$string['errorpowers'] = 'Virhe noudettaessa tietoja tentin arvosanojen varianssin laskemiseen';
$string['errorrandom'] = 'Virhe haettaessa tietoa';
$string['errorratio'] = 'Virheellinen suhde (kohteelle {$a})';
$string['errorstatisticsquestions'] = 'Virhe noudettaessa tietoja kysymysten arvosanojen tilastojen laskemiseen';
$string['facility'] = 'Facility-indeksi';
$string['firstattempts'] = 'ensimmäiset suorituskerrat';
$string['firstattemptsavg'] = 'Ensimmäisten suorituskertojen arvosanojen keskiarvo';
$string['firstattemptscount'] = 'Arvioitujen ensimmäisten suorituskertojen määrä';
$string['frequency'] = 'Tiheys';
$string['intended_weight'] = 'Tarkoitettu paino';
$string['kurtosis'] = 'Pisteiden jakaantumisen kurtoosi (kohteelle {$a})';
$string['lastcalculated'] = 'Viimeksi laskettu {$a->lastcalculated} sitten. Sen jälkeen on ollut {$a->count} suorituskertaa.';
$string['median'] = 'Arvosanan mediaani (kohteelle {$a})';
$string['modelresponse'] = 'Mallivastaus';
$string['negcovar'] = 'Negatiivinen arvosanan kovarianssi sekä suorituskerran kokonaisarvosana';
$string['negcovar_help'] = 'Tämän kysymyksen arvosana näille suorituskerroille on painottunut päinvastaiseen suuntaan kuin koko suorituskerran yleisarvosana. Tämä tarkoittaa, että suorituskerran yleisarvosana on tyypillisesti keskiarvon alapuolla, kun tämän kysymyksen arvosana on keskiarvon yläpuolella, ja päin vastoin.
Kysymyksen painotuksen laskemiseen ei voi käyttää perusyhtälöä. Muiden kysymysten tehollinen paino on on myös näiden kysymysten tehollinen paino, jos korostetuille kysymyksille, joilla siis on käänteinen painotus, annetaan maksimiarvosanaksi 0.
Jos muokkaat tenttiä ja annat näille kysymyksille maksimiarvosanaksi 0, näiden kysymysten tehollinen paino on 0 ja todellisten tehokkaiden kysymysten painoksi tulee kuten laskettu nyt.';
$string['nostudentsingroup'] = 'Tässä ryhmässä ei ole vielä opiskelijoita';
$string['optiongrade'] = 'Osakrediitti';
$string['pluginname'] = 'Tilastot';
$string['position'] = 'Asema';
$string['positions'] = 'Asema(t)';
$string['questioninformation'] = 'Kysymystiedot';
$string['questionname'] = 'Kysymyksen nimi';
$string['questionnumber'] = 'Kys.#';
$string['questionstatistics'] = 'Kysymystilastot';
$string['questionstatsfilename'] = 'kysymystilastot';
$string['questiontype'] = 'Kysymystyyppi';
$string['quizinformation'] = 'Tentin tiedot';
$string['quizname'] = 'Tentin nimi';
$string['quizoverallstatistics'] = 'Tentin yleistilastot';
$string['quizstructureanalysis'] = 'Tentin rakenneanalyysi';
$string['random_guess_score'] = 'Satunnaisen arvauksen pisteet';
$string['recalculatenow'] = 'Uudelleenlaske nyt';
$string['response'] = 'Vastaus';
$string['skewness'] = 'Pisteiden jakaantumisen vinous (kohteelle {$a})';
$string['standarddeviation'] = 'Keskihajonta (kohteelle {$a})';
$string['standarddeviationq'] = 'Keskihajonta';
$string['standarderror'] = 'Keskivirhe (kohteelle {$a})';
$string['statistics'] = 'Tilastot';
$string['statistics:componentname'] = 'Tentin tilastoraportti';
$string['statistics:view'] = 'Näytä tilastoraportti';
$string['statisticsreport'] = 'Tilastoraportti';
$string['statisticsreportgraph'] = 'Tilastot kysymysten sijainneille';
$string['statsfor'] = 'Tentin tilastot (kohteelle {$a})';
