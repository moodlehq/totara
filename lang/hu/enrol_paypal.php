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
 * Strings for component 'enrol_paypal', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_paypal
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Szerep hozzárendelése';
$string['businessemail'] = 'PayPal munkahelyi e-mail';
$string['businessemail_desc'] = 'Munkahelyi PayPal-fiókjának  e-mail címe';
$string['cost'] = 'Beiratkozási költség';
$string['costerror'] = 'A beiratkozási költség nem számjegy';
$string['costorkey'] = 'Válasszon az alábbi beiratkozási módok közül.';
$string['currency'] = 'Pénznem';
$string['defaultrole'] = 'Alapvető szerep-hozzárendelés';
$string['defaultrole_desc'] = 'Válassza ki a felhasználókhoz hozzárendelendő szerepeket PayPal beiratkozások idejére';
$string['enrolenddate'] = 'Végső időpont';
$string['enrolenddate_help'] = 'Bekapcsolása esetén a felhasználók csak ezen időpontig iratkoztathatók be.';
$string['enrolenddaterror'] = 'A végső beiratkozási időpont nem előzheti meg a kezdő időpontot';
$string['enrolperiod'] = 'Beiratkozási időszak';
$string['enrolperiod_desc'] = 'Az alapbeállítás szerinti beiratkozási időszak (másodpercben). 0 megadása esetén a beiratkozási időszak alapesetben korlátlan.';
$string['enrolperiod_help'] = 'A beiratkozási időszak alapértelmezett hossza a felhasználó beíratásától kezdve. Kikapcsolása esetén beiratkozási időszak alapesetben korlátlan lesz.';
$string['enrolstartdate'] = 'Kezdő időpont';
$string['enrolstartdate_help'] = 'Bekapcsolása esetén a felhasználók csak ezen időponttól iratkozhatnak be.';
$string['mailadmins'] = 'Rendszergazda értesítése';
$string['mailstudents'] = 'Tanulók értesítése';
$string['mailteachers'] = 'Tanárok értesítése';
$string['messageprovider:paypal_enrolment'] = 'A PayPal beiratkozási üzenetei';
$string['nocost'] = 'A kurzus felvételéhez nincs hozzákapcsolva költség!';
$string['paypal:config'] = 'PayPal beiratkoztatási példányok beállítása';
$string['paypal:manage'] = 'Beiratkozott felhasználók kezelése';
$string['paypal:unenrol'] = 'Felhasználók kiiratkoztatása a kurzusból';
$string['paypal:unenrolself'] = 'Kurzus leadása';
$string['paypalaccepted'] = 'PayPal-lel való fizetést elfogadunk';
$string['pluginname'] = 'PayPal';
$string['pluginname_desc'] = 'A PayPal modullal fizetős kurzusokat hozhat létre. ha egy kurzus költsége nulla, a tanulóknak nem kell fizetni a belépésért. Alapbeállításként itt kell megadni az egész portálra érvényes költséget, majd ezt követően egyenként kell beállítani a kurzusokat. A kurzusköltség felülírja a portálköltséget.';
$string['sendpaymentbutton'] = 'Fizetés küldése Paypal-lel';
$string['status'] = 'PayPal beiratkozások engedélyezése';
$string['status_desc'] = 'Felhasználók számára alaphelyzetben beiratkozások engedélyezése PayPal segítségével';
$string['unenrolselfconfirm'] = 'Biztosan leadja a(z) "{$a}" kurzust?';
