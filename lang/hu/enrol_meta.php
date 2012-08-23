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
 * Strings for component 'enrol_meta', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_meta
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['linkedcourse'] = 'Kurzus kapcsolása';
$string['meta:config'] = 'Egyesített beiratkozási példányok beállítása';
$string['meta:selectaslinked'] = 'Kurzus kiválasztása egyesített kapcsolásúként';
$string['meta:unenrol'] = 'Felfüggesztett felhasználók kiiratkoztatása';
$string['nosyncroleids'] = 'Szinkronizálatlan szerepek';
$string['nosyncroleids_desc'] = 'Alapesetben minden kurzusszintű szerep-hozzárendelést illetően a fő kurzus és az alkurzusok között végbemegy a szinkronizálás. Az itt kiválasztott szerepek kimaradnak a szinkronizálásból. Az aktuális szerepek frissítésére a cron következő lefuttatásakor kerül sor.';
$string['pluginname'] = 'Kurzus egyesített kapcsolása';
$string['pluginname_desc'] = 'A kurzus összekapcsolt beiratkozási segédprogramja két külön kurzusban szinkronizálja a beiratkozásokat és a szerepeket.';
$string['syncall'] = 'Az összes beiratkozott felhasználó szinkronizálása';
$string['syncall_desc'] = 'Bekapcsolása esetén sor kerül az összes beiratkozott felhasználó szinkronizálására, még akkor is, ha a fő kurzusban nincs szerep hozzájuk rendelve. Kikapcsolásakor csak azok a felhasználók veszik föl az alkurzust, akik legalább egy szinkronizált szereppel rendelkeznek-';
