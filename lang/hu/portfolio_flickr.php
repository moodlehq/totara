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
 * Strings for component 'portfolio_flickr', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio_flickr
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey'] = 'API-kulcs';
$string['contenttype'] = 'Tartalomtípusok';
$string['err_noapikey'] = 'Nincs API-kulcs.';
$string['err_noapikey_help'] = 'A segédprogramhoz nincs beállítva API-kulcs. Beszerezhet egyet a Flickr szolgálatási weboldaláról.';
$string['hidefrompublicsearches'] = 'Elrejti a képeket a nyilvános keresések elől?';
$string['isfamily'] = 'A család láthatja';
$string['isfriend'] = 'A barátok láthatják';
$string['ispublic'] = 'Nyilvános (bárki láthatja)';
$string['moderate'] = 'Mérsékelt';
$string['noauthtoken'] = 'A folyamat során használandó hitelesítési jel nem érhető el.';
$string['other'] = 'Rajz, illusztráció, CGI és más, nem fénykép jellegű képek';
$string['photo'] = 'Fényképek';
$string['pluginname'] = 'Flickr.com';
$string['restricted'] = 'Korlátozott';
$string['safe'] = 'Biztonságos';
$string['safetylevel'] = 'Biztonsági szint';
$string['screenshot'] = 'Képernyőképek';
$string['set'] = 'Készlet';
$string['setupinfo'] = 'Beállítási utasítások';
$string['setupinfodetails'] = 'API-kulcs beszerzéséhez lépjen be a Flickrre és <a href="{$a->applyurl}">kérjen új kulcsot</a>. Ha elkészült az új kulcs és a titkos szöveg, kövesse az oldalon az \'Edit auth flow for this app\' ugrópontot. Az \'App Type\' esetén válassza a \'Web Application\' pontot. A \'Callback URL\' mezőbe írja be ezt: <br /><code>{$a->callbackurl}</code><br />Választhatóan leírást és logót adhat meg Moodle-portáljáról. Ezeket az értékeket később a Flickr-kérelmeit felsoroló <a href="{$a->keysurl}">oldalon</a> állíthatja be.';
$string['sharedsecret'] = 'Titkos szöveg';
$string['title'] = 'Cím';
$string['uploadfailed'] = 'A  flickr.com: {$a} tárhelyre a képfeltöltés nem sikerült.';
