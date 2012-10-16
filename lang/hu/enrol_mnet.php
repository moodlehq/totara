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
 * Strings for component 'enrol_mnet', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['error_multiplehost'] = 'Ezen a gazdagépen már létezik az MNet beiratkozási segédprogram egy példánya. Gazdagépenként csak egy példány és/vagy \'Összes gazdagép\' esetén csak egy példány engedélyezett.';
$string['instancename'] = 'Beiratkozási módszer neve';
$string['instancename_help'] = 'Ha kívánja, átnevezheti az MNet beiratkozási módszer ezen példányát. Ha üresen hagyja a mezőt, a rendszer az alapbeállított példánynevet használja, mely a távoli gazdagép nevét és a felhasználóihoz rendelt szerepet tartalmazza.';
$string['mnet_enrol_description'] = 'A szolgáltatás közzétételével engedélyezheti a(z) {$a} rendszergazdáinak, hogy a szerverén létrehozott kurzusokba beírassák tanulóikat.<br /><ul><li><em>Függőség</em>: fel is kell <strong>iratkoznia</strong> a(z) {$a} SSO (azonosítási szolgáltató) szolgáltatására.</li><li><em>Függőség</em>: közzé is kell tennie a(z) {$a} SSO (szolgáltató) szolgáltatását.</li></ul><br />Fel is kell iratkoznia erre a szolgáltatásra ahhoz, hogy tanulóit be tudja iratkoztatni {$a} kurzusaiba.<br /><br /><ul><li><em>Függőség</em>: fel is kell <strong>iratkoznia</strong> a(z) {$a} SSO (szolgáltató) szolgáltatására.</li><li><em>Függőség</em>: közzé is kell tennie a(z) {$a} SSO (azonosítási szolgáltató) szolgáltatását.</li></ul><br />';
$string['mnet_enrol_name'] = 'Távoli beiratkoztatási szolgáltatás';
$string['pluginname'] = 'Távoli MNet beiratkoztatások';
$string['pluginname_desc'] = 'Engedélyezi a távoli MNet gazdagépnek, hogy felhasználóit kurzusainkba iratkoztassa be.';
$string['remotesubscriber'] = 'Távoli gazdagép';
$string['remotesubscriber_help'] = 'Az \'Összes gazdagép\' kiválasztásával tegye elérhetővé a kurzust minden más MNet-gépen, amely részére a távoli beiratkoztatási szolgáltatást kínáljuk. Vagy válasszon ki egyetlen gazdagépet, ha a kurzust csak annak felhasználói számára kívánja elérhetővé tenni.';
$string['remotesubscribersall'] = 'Összes gazdagép';
$string['roleforremoteusers'] = 'Felhasználóik szerepe';
$string['roleforremoteusers_help'] = 'Milyen szerepet kapnak a kiválasztott gazdagéptől a távoli felhasználók?';
