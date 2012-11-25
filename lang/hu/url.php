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
 * Strings for component 'url', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   url
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['chooseavariable'] = 'Válasszon egy változót...';
$string['clicktoopen'] = 'A tananyag megnyitásához kattintson erre: {$a}.';
$string['configdisplayoptions'] = 'Válassza ki az elérendő opciókat; a létező beállítások nem módosulnak. Több mező kiválasztásához nyomja le a CTRL-billentyűt.';
$string['configframesize'] = 'Ha egy weboldal vagy egy feltöltött állomány keretben jelenik meg, ez az érték a felső (navigációt tartalmazó) keret magassága (képpontban).';
$string['configrolesinparams'] = 'Kapcsolja be, ha az elérhető paraméterváltozók között szerepeltetni kíván honosított szerepneveket.';
$string['configsecretphrase'] = 'Ezzel a titkos kifejezéssel paraméterként kódolt értéket továbbíthat egyes szerverekhez. A kód az adott felhasználó IP-címének és a titkos kifejezésnek az egyesítésével létrejövő md5 érték, vagyis kód = md5(IP.titkoskifejezés). Ne feledje, hogy a megoldás nem teljesen megbízható, mivel az IP-címek változhatnak és gyakran több gép között oszlanak meg.';
$string['contentheader'] = 'Tartalom';
$string['displayoptions'] = 'Elérhető megjelenítési lehetőségek';
$string['displayselect'] = 'Megjelenítés';
$string['displayselect_help'] = 'Ez a beállítás, továbbá az állomány típusa és a böngészőben a beágyazás engedélyezése szabja meg az állomány megjelenését. Az alábbi lehetőségek közül választhat:
* Automatikus - Az adott állomány típusához automatikusan kiválasztja a legjobb megjelenítést
* Beágyazás - Az állomány az oldalon a navigációs sáv alatt leírásával és az esetleges blokkokkal együtt jelenik meg
* Letöltés előírása - A felhasználót az állomány letöltésére szólítja föl
* Megnyitás - A böngésző ablakában csak az állomány jelenik meg
* Előugró ablakban - Az állomány új böngészőablakban, menük vagy címsor nélkül jelenik meg
* Keretben - Az állomány a navigációs sáv alatt egy keretben jelenik meg
* Új ablakban - Az állomány új böngészőablakban, menükkel és címsorral jelenik meg\';';
$string['displayselectexplain'] = 'Válassza ki a megjelenítés típusát. Nem minden típus használható minden URL-lel.';
$string['externalurl'] = 'Külső URL';
$string['framesize'] = 'Keret magassága';
$string['invalidstoredurl'] = 'A forrás nem jeleníthető meg. Érvénytelen URL';
$string['invalidurl'] = 'A megadott URL érvénytelen.';
$string['modulename'] = 'URL';
$string['modulenameplural'] = 'URL-ek';
$string['neverseen'] = 'Nem létező';
$string['optionsheader'] = 'Lehetőségek';
$string['page-mod-url-x'] = 'Bármely URL-modul oldala';
$string['parameterinfo'] = '&amp;paraméter=változó';
$string['parametersheader'] = 'Paraméterek';
$string['parametersheader_help'] = 'Az URL egyes belső Moodle-változókkal automatikusan kiegészülhet. Az egyes szövegmezőkbe paraméterként írja be a nevét, majd válassza ki a megfelelő szükséges változót.';
$string['pluginadministration'] = 'URL kezelése';
$string['pluginname'] = 'URL';
$string['popupheight'] = 'Felugró ablak magassága (képpontban)';
$string['popupheightexplain'] = 'A felugró ablakok alapmagasságát határozza meg.';
$string['popupwidth'] = 'Felugró ablak szélessége (képpontban)';
$string['popupwidthexplain'] = 'A felugró ablakok alapszélességét határozza meg.';
$string['printheading'] = 'URL nevének megjelenítése';
$string['printheadingexplain'] = 'Az URL neve a tartalom fölött jelenjen meg? Egyes megjelenítési típusok esetén az URL neve akkor sem jelenik meg, ha be van kapcsolva.';
$string['printintro'] = 'URL-leírás megjelenítése';
$string['printintroexplain'] = 'Az URL leírása a tartalom alatt jelenjen meg? Egyes megjelenítési típusok esetén a forrás neve akkor sem jelenik meg, ha be van kapcsolva.';
$string['rolesinparams'] = 'A szerepnevek jelenjenek meg a paraméterek között';
$string['serverurl'] = 'Szerver URL-je';
$string['url:view'] = 'URL megtekintése';
