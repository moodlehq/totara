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
 * Strings for component 'tool_bloglevelupgrade', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_bloglevelupgrade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bloglevelupgradedescription'] = '<p>A portált nemrégen Moodle 2.0-ra frissítették.</p>
<p>A blog láthatósága a 2.0 változatban egyszerűsödött, de az Ön portálja továbbra is régi típusú láthatóságot használ. Ahhoz, hogy portálján megőrizze a blogüzenetek kurzusalapú vagy csoportalapú láthatóságát, le kell futtatnia az alábbi frissítési kódot, mellyel minden blogüzenettel rendelkező felhasználót tartalmazó kurzusában létrejön egy külön blogszerű fórum, melybe ezek a blogüzenetek bemásolódnak.</p>
<p>Ezt követően portálszinten a blogokat a rendszer kikapcsolja. A folyamat során a blogüzenetek nem törlődnek.</p>
<p>A kód lefuttatásához látogasson el a <a href="{$a->fixurl}">blogszintű frissítés oldalára</a>.</p>';
$string['bloglevelupgradeinfo'] = 'A blog láthatósága a 2.0 változatban egyszerűsödött, de az Ön portálja továbbra is régi típusú láthatóságot használ. Ahhoz, hogy portálján megőrizze a blogüzenetek kurzusalapú vagy csoportalapú láthatóságát, le kell futtatnia az alábbi frissítési kódot, mellyel minden blogüzenettel rendelkező felhasználót tartalmazó kurzusában létrejön egy külön blogszerű fórum, melybe ezek a blogüzenetek bemásolódnak.
Ezt követően portálszinten a blogokat a rendszer kikapcsolja. A folyamat során a blogüzenetek nem törlődnek.';
$string['bloglevelupgradeprogress'] = 'Átalakítás folyamatban: {$a->userscount} felhasználó ellenőrizve, {$a->blogcount} üzenet átalakítva.';
$string['pluginname'] = 'Blog láthatóságának frissítése';
