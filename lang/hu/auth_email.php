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
 * Strings for component 'auth_email', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_emaildescription'] = 'Az e-mail megerősítése az alapvető hitelesítési mód. A felhasználó feliratkozásakor kiválaszt egy felhasználónevet és egy jelszót, majd kap egy megerősítő e-mailt az e-mail címére. Ebben van egy biztonságos ugrópont, melyet elérve megerősítheti fiókját. A későbbi belépések során a Moodle már csak a felhasználónevet és jelszót ellenőrzi az adatbázisban tárolt értékek alapján.';
$string['auth_emailnoemail'] = 'Nem sikerült Önnek e-mailt küldeni!';
$string['auth_emailrecaptcha'] = 'Látható/hallható űrlapelemet ad hozzá a belépési oldalhoz önmagukat e-mailben regisztráló felhasználók esetén. Ezzel megvédi portálját a levélszeméttől és indokolttá teszi az adott lépést. A részleteket lásd: http://recaptcha.net/learnmore.html. <br /><em>Szükséges a PHP cURL-bővítménye.</em>';
$string['auth_emailrecaptcha_key'] = 'A reCAPTCHA-elem bekapcsolása';
$string['auth_emailsettings'] = 'Beállítások';
$string['pluginname'] = 'E-mail alapú önregisztráció';
