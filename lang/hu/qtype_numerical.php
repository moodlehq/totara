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
 * Strings for component 'qtype_numerical', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_numerical
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acceptederror'] = 'Elfogadott hiba';
$string['addmoreanswerblanks'] = 'Hely további {no} válaszhoz';
$string['addmoreunitblanks'] = 'Hely további {no} egység számára';
$string['answermustbenumberorstar'] = 'A válasz szám, pl. -1.234 vagy 3e8, illetve \'*\' lehet.';
$string['answerno'] = '{$a} válasz';
$string['decfractionofquestiongrade'] = 'A kérdésre adott pont tizedesrésze (0-1)';
$string['decfractionofresponsegrade'] = 'A válaszra adott pont tizedesrésze (0-1)';
$string['decimalformat'] = 'tizedesek';
$string['editableunittext'] = 'Szövegbeviteli elem';
$string['errornomultiplier'] = 'Ehhez az egységhez meg kell adnia egy szorzót.';
$string['errorrepeatedunit'] = 'Két egységnek nem lehet azonos a neve.';
$string['geometric'] = 'Mértani';
$string['invalidnumber'] = 'Adjon meg egy érvényes számot.';
$string['invalidnumbernounit'] = 'Adjon meg egy érvényes számot. A válasza ne tartalmazzon mértékegységet.';
$string['invalidnumericanswer'] = 'Megadott válaszainak egyike érvénytelen számot tartalmaz.';
$string['invalidnumerictolerance'] = 'Megadott értékhatárainak egyike érvénytelen számot tartalmaz.';
$string['leftexample'] = 'BAL értéke, pl. 1.00 $ vagy 1.00 £.';
$string['manynumerical'] = 'Az egységek megadása választható. Használata esetén a választ pontozás előtt 1. egységre alakítja át.';
$string['multiplier'] = 'Szorzó';
$string['nominal'] = 'Nevező';
$string['noneditableunittext'] = '1. egység NEM szerkeszthető szövege';
$string['nonvalidcharactersinnumber'] = 'ÉRVÉNYTELEN karakterek vannak a számjegyben';
$string['notenoughanswers'] = 'Legalább egy választ meg kell adnia.';
$string['nounitdisplay'] = 'Egység pontozása nélkül';
$string['numericalmultiplier'] = 'Szorzó';
$string['numericalmultiplier_help'] = 'A szorzó az a tényező, amellyel a helyes számjegyes választ meg kell szorozni.
Az első egység (1. egység) alapszorzója az 1. Így a helyes számjegyes válasz az 5500, az 1. egységnél beállított egység a W lesz, alapszorzója 1, a helyes válasz pedig 5500 W.
Ha a kW egységet 0,001 szorzóval adja hozzá, a helyes válasz 5,5 kW lesz. Vagyis mind az 5500 W, mind az 5,5 kW válasz helyes lesz.
Ügyeljen arra, hogy a szorzás vonatkozik az elfogadott hibára is, így a megengedett 100 W hiba 0,1 kW hibának felel meg.';
$string['oneunitshown'] = 'Az 1. egység a válasznégyzet mellett automatikusan megjelenik';
$string['onlynumerical'] = 'Csak számérték pontozására kerül sor, egységek egyáltalán nem szerepeltethetők!';
$string['pleaseenterananswer'] = 'Adjon meg egy választ.';
$string['pleaseenteranswerwithoutthousandssep'] = 'Adjon meg egy választ az ezreseket elválasztó ({$a}) jel nélkül.';
$string['pluginname'] = 'Számjegyes';
$string['pluginname_help'] = 'A tanuló szemszögéből a számjegyes kérdés megegyezik a kiegészítendő kérdéssel. A különbség az, hogy a számjegyesek esetén elfogadható hiba vehető figyelembe. Így egy adott tartományon belül több válasz egyetlen válaszként vehető figyelembe. Ha pl. a válasz 10 és az elfogadható hiba 2, akkor a 8 és 12 közé eső válaszok mindegyikét helyesként fogadja el a rendszer.';
$string['pluginnameadding'] = 'Számjegyes kérdés hozzáadása';
$string['pluginnameediting'] = 'Számjegyes kérdés szerkesztése';
$string['pluginnamesummary'] = 'Számjegyes, esetleg egységeket tartalmazó választ tesz lehetővé, melynek pontozása különféle mintaválaszokkal való összehasonlítás alapján, esetleg tűréshatárokkal pontozható.';
$string['relative'] = 'Relatív';
$string['rightexample'] = 'JOBB értéke, pl. 1.00 cm vagy 1.00 km';
$string['selectunit'] = 'Válasszon egy egységet';
$string['selectunits'] = 'Egységek kiválasztása';
$string['studentunitanswer'] = 'Egységhez tartozó bemenet:';
$string['tolerancetype'] = 'Határérték típusa';
$string['unit'] = 'Mértékegység';
$string['unitappliedpenalty'] = 'Ezek a jegyek {$a} levonást jelentenek a hibás egységért';
$string['unitchoice'] = 'Feleletválasztós eset';
$string['unitedit'] = 'Egység szerkesztése';
$string['unitgraded'] = 'Az egységet meg kell adni, és pontozására sor kerül.';
$string['unithandling'] = 'Mértékegység kezelése';
$string['unithdr'] = '{$a} egység';
$string['unitincorrect'] = 'Nem megfelelő mértékegységet adott meg.';
$string['unitmandatory'] = 'Kötelező';
$string['unitmandatory_help'] = '* A válasz pontozása a beírt egység felhasználásával történik.
* Az egységre levonás jár, ha az egységmező üres.';
$string['unitnotselected'] = 'Nincs kiválasztva egység';
$string['unitonerequired'] = 'Adjon meg legalább egy mértékegységet.';
$string['unitoptional'] = 'Választható egység';
$string['unitoptional_help'] = '* Ha az egységmező nem üres, a válasz pontozása ezen egység felhasználásával történik.
* Ha az egység rosszul van megadva vagy ismeretlen, a válasz érvénytelennek minősül.';
$string['unitpenalty'] = 'Levonás a hibás egységért';
$string['unitpenalty_help'] = 'Levonásra kerül sor, ha
* Az Egységválasz elemében hibás egységnév szerepel vagy
* Az értékbeviteli mezőben egység szerepel';
$string['unitposition'] = 'Egység helyzete';
$string['unitselect'] = 'lenyíló menü';
$string['validnumberformats'] = 'Érvényes számformátumok';
$string['validnumberformats_help'] = '* reguláris számok 13500.67 : 13 500.67 : 13500,67: 13 500,67
* ha az ezreseket , választja el, \*mindig\* . legyen a tizedesjel, pl. 13,500.67 : 13,500.
* kitevő, pl. 1.350067 * 10<sup>4</sup> használja az 1.350067 E4 : 1.350067 E04 alakot';
$string['validnumbers'] = '13500.67 : 13 500.67 : 13,500.67 : 13500,67: 13 500,67 : 1.350067 E4 : 1.350067 E04';
