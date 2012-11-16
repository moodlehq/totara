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
 * Strings for component 'portfolio_boxnet', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio_boxnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey'] = 'API-kulcs (a Box.nettől szerezze be)';
$string['err_noapikey'] = 'Nincs API-kulcs.';
$string['err_noapikey_help'] = 'A segédprogramhoz nincs beállítva API-kulcs. Beszerezhet egyet az OpenBox fejlesztői weboldaláról.';
$string['existingfolder'] = 'Az állomány(ok) elhelyezésére szolgáló, létező könyvtár';
$string['folderclash'] = 'A létrehozni kívánt mappa már létezik!';
$string['foldercreatefailed'] = 'A box.neten nem sikerült létrehozni a célmappát.';
$string['folderlistfailed'] = 'A box.netről nem sikerült beolvasni a mappák listáját.';
$string['newfolder'] = 'Az állomány(ok) elhelyezésére szolgáló új mappa';
$string['noauthtoken'] = 'Nem sikerült a folyamatban használandó hitelesítő kódot beolvasni.';
$string['notarget'] = 'A feltöltéshez egy meglévő vagy egy új mappát kell megadnia.';
$string['noticket'] = 'A hitelesítési folyamat elkezdéséhez nem sikerült beolvasni a box.net jegyét.';
$string['password'] = 'Az Ön box.net jelszava (nem tárolódik)';
$string['pluginname'] = 'Box.net';
$string['sendfailed'] = 'Nem sikerült a tartalom elküldése  a box.net-hez: {$a}';
$string['setupinfo'] = 'Beállítási utasítások';
$string['setupinfodetails'] = 'API-kulcs beszerzéséhez lépjen be a Box.net portálra és látogasson el az <a href="{$a->servicesurl}">OpenBox development page</a> oldalra. A \'Developer Tools\' alatt válassza a \'Create new application\' pontot és hozzon létre egy új kérelmet Moodle-portálja számára. Az API-kulcs a kérelemszerkesztő űrlapon a \'Backend parameters\' alatt található. Az űrlapon a \'Redirect URL\' mezőt <br /><code>{$a->callbackurl}</code><br />formában töltse ki.<br />Választhatóan adatokat adhat meg Moodle-portáljáról. Ezeket az értékeket később a \'View my applications\' oldalon szerkesztheti.';
$string['sharedfolder'] = 'Osztott';
$string['sharefile'] = 'Megosztja az állományt?';
$string['sharefolder'] = 'Megosztja az új mappát?';
$string['targetfolder'] = 'Célmappa';
$string['tobecreated'] = 'Létrehozandó';
$string['username'] = 'Az Ön box.net felhasználóneve (nem tárolódik)';
