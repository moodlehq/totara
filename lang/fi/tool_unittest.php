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
 * Strings for component 'tool_unittest', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_unittest
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addconfigprefix'] = 'Lisää etuliite config-tiedostoon';
$string['all'] = 'KAIKKI';
$string['codecoverageanalysis'] = 'Suorita koodin kattavuusanalyysi.';
$string['codecoveragecompletereport'] = '(näytä täysi raportti koodin kattavuudesta)';
$string['codecoveragedisabled'] = 'Ei voida ottaa käyttöön koodin kattavuutta tällä palvelimella (puuttuva xdebug-laajennus).';
$string['codecoveragelatestdetails'] = '(pvm: {$a->date}, tiedostoja: {$a->files}, kattavuusprosentti: {$a->percentage})';
$string['codecoveragelatestreport'] = 'näytä viimeisin täysi raportti koodin kattavuudesta';
$string['confignonwritable'] = 'Tiedosto config.php ei ole palvelimen kirjoitettavissa. Muuta sen oikeuksia tai muokkaa sitä soveltuvalla käyttäjätilillä ja lisää seuraava rivi ennen php:n sulkutageja:

$CFG->unittestprefix = \'tst_\' // Change tst_ to a prefix of your choice, different from $CFG->prefix';
$string['coveredlines'] = 'Katetut rivit';
$string['coveredpercentage'] = 'Koodin kokonaiskattavuus';
$string['dbtest'] = 'Funktionaaliset tietokantatestit';
$string['deletingnoninsertedrecord'] = 'Yritetään poistaa merkintää, jota nämä yksikkötestit eivät lisänneet (id {$a->id} taulussa {$a->table}).';
$string['deletingnoninsertedrecords'] = 'Yritetään poistaa merkintöjä, joita nämä yksikkötestit eivät lisänneet (taulusta {$a->table}).';
$string['droptesttables'] = 'Poista testitaulut';
$string['exception'] = 'Poikkeus';
$string['executablelines'] = 'Suoritettavat rivit';
$string['fail'] = 'Epäonnistui';
$string['ignorefile'] = 'Älä huomioi testejä tiedostossa';
$string['ignorethisfile'] = 'Suorita testit uudelleen huomioimatta tätä testitiedostoa';
$string['installtesttables'] = 'Asenna testitaulut';
$string['moodleunittests'] = 'Moodle testit: {$a}';
$string['notice'] = 'Huomaa';
$string['onlytest'] = 'Suorita vain testit';
$string['othertestpages'] = 'Muut testisivut';
$string['pass'] = 'Onnistui';
$string['pathdoesnotexist'] = 'Polkua {$a} ei ole';
$string['pluginname'] = 'Yksikkötestit';
$string['prefix'] = 'Yksikkötestitaulujen etuliite';
$string['prefixnotset'] = 'Tietokannan yksikkötestitaulun etuliitettä ei ole määritelty. Täytä ja lähetä tämä lomake lisätäksesi se tiedostoon config.php.';
$string['reinstalltesttables'] = 'Asenna testitaulut uudelleen';
$string['retest'] = 'Suorita testit uudelleen';
$string['retestonlythisfile'] = 'Suorita vain tämä testi uudelleen.';
$string['runall'] = 'Suorita kaikki testit uudelleen.';
$string['runat'] = 'Suorita testi klo {$a}';
$string['runonlyfile'] = 'Suorita testit tastä tiedostosta';
$string['runonlyfolder'] = 'Suorita testit tastä hakemistosta';
$string['runtests'] = 'Suorita testit';
$string['rununittests'] = 'Suorita testit';
$string['showpasses'] = 'Näytä myös onnistuneet testit';
$string['showsearch'] = 'Näytä testitiedostojen haku';
$string['skip'] = 'Ohita';
$string['stacktrace'] = 'Jäljitys';
$string['summary'] = '{$a->run}/{$a->total} testit valmiit: <strong>{$a->passes}</strong> menee läpi, <strong>{$a->fails}</strong> ei mene läpi ja <strong>{$a->exceptions}</strong> poikkeukset.';
$string['tablesnotsetup'] = 'Yksikkötestitauluja ei ole vielä rakennettu. Haluatko rakentaa ne nyt?';
$string['testdboperations'] = 'Testaa tietokannan toimintoja';
$string['testtablescsvfileunwritable'] = 'Testitaulujen CSV-tiedosto ei ole kirjoitettavissa ({$a->filename})';
$string['testtablesneedupgrade'] = 'Tietokannan testitaulut pitää päivittää. Haluatko jatkaa päivityksellä nyt?';
$string['testtablesok'] = 'Tietokannan testitaulut asennettiin onnistuneesti.';
$string['thorough'] = 'Suorita perusteelliset testit (vie aikaa)';
$string['timetakes'] = 'Kulunut aika: {$a}';
$string['totallines'] = 'Rivien määrä';
$string['uncaughtexception'] = 'Poikkeus[{$a->getMessage()}] in [{$a->getFile()}:{$a->getLine()}]TESTIT KESKEYTETTY.';
$string['uncoveredlines'] = 'Kattamattomat rivit';
$string['unittest:execute'] = 'Suorita yksikkötestit';
$string['unittestprefixsetting'] = 'Yksikkötestien etuliite: <strong>{$a->unittestprefix}</strong> (Muokkaa config.php:tä vaihtaaksesi tätä).';
$string['unittests'] = 'Testit';
$string['updatingnoninsertedrecord'] = 'Yritetään päivittää merkintää, jota tämä yksikkötestit eivät lisänneet (id {$a->id} taulussa {$a->table}).';
$string['version'] = 'Käytetään <a href="http://sourceforge.net/projects/simpletest/">SimpleTest</a> versiota {$a}.';
