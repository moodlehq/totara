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
 * Strings for component 'enrol_manual', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_manual
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['alterstatus'] = 'Állapot megváltoztatása';
$string['altertimeend'] = 'Befejezési időpont megváltoztatása';
$string['altertimestart'] = 'Kezdési időpont megváltoztatása';
$string['assignrole'] = 'Szerep hozzárendelése';
$string['confirmbulkdeleteenrolment'] = 'Biztosan törli ezeket a felhasználói beiratkozásokat?';
$string['defaultperiod'] = 'Alapbeállítás szerinti beiratkozási időszak';
$string['defaultperiod_desc'] = 'Az alapbeállítás szerinti beiratkozási időszak beállítása (másodpercben). 0 megadása esetén a beiratkozási időszak alapesetben korlátlan.';
$string['defaultperiod_help'] = 'A beiratkozási időszak alapértelmezett hossza a felhasználó beiratkozásától kezdve. Kikapcsolása esetén beiratkozási időszak alapesetben korlátlan lesz.';
$string['deleteselectedusers'] = 'A kiválasztott felhasználói beiratkozások törlése';
$string['editenrolment'] = 'Beiratkozás szerkesztése';
$string['editselectedusers'] = 'A kiválasztott felhasználói beiratkozások szerkesztése';
$string['enrolledincourserole'] = 'A(z) "{$a->course}" kurzusba felvéve mint "{$a->role}"';
$string['enrolusers'] = 'Felhasználók beiratkoztatása';
$string['manual:config'] = 'Kézi beiratkoztatási példányok beállítása';
$string['manual:enrol'] = 'Felhasználók beiratkoztatása';
$string['manual:manage'] = 'Felhasználói beiratkozások kezelése';
$string['manual:unenrol'] = 'Felhasználók kiiratkoztatása a kurzusból';
$string['manual:unenrolself'] = 'Kurzus leadása';
$string['pluginname'] = 'Kézi beiratkozások';
$string['pluginname_desc'] = 'A kézi beiratkozások segédprogramjával a felhasználók a kurzusadminisztráció beállításain keresztül kézileg iratkoztathatók be megfelelő jogosultságú személy, pl. tanár által. A segédprogramot célszerű bekapcsolni, mert más beiratkozási segédprogramoknak,
pl. az önbeíratási segédprogramnak szükségük van rá.';
$string['status'] = 'Kézi beiratkozások bekapcsolása';
$string['status_desc'] = 'Belsőleg beiratkozottak számára engedélyezi a kurzushoz való hozzáférést. Többnyire célszerű bekapcsolni.';
$string['status_help'] = 'Ez a beállítás rögzíti, hogy megfelelő jogosultságú személy, pl. tanár kézzel a kurzusadminisztráció beállításain keresztül iratkoztathat-e be felhasználókat.';
$string['statusdisabled'] = 'Kikapcsolva';
$string['statusenabled'] = 'Bekapcsolva';
$string['unenrol'] = 'Felhasználó kiiratkoztatása';
$string['unenrolselectedusers'] = 'A kiválasztott felhasználók kiiratkoztatása';
$string['unenrolselfconfirm'] = 'Biztosan leadja a(z) "{$a}" kurzust?';
$string['unenroluser'] = 'Biztosan kiiratkoztatja "{$a->user}" felhasználót a(z) "{$a->course}" kurzusból?';
$string['unenrolusers'] = 'Felhasználók kiiratkoztatása';
$string['wscannotenrol'] = 'A segédprogrammal {$a->courseid} azonosítóval rendelkező kurzusba nem lehet kézi úton felhasználót beiratkoztatni.';
$string['wsnoinstance'] = 'A kézi beiratkozási segédprogram {$a->courseid} azonosítóval rendelkező kurzus esetén ki van kapcsolva vagy nem létezik.';
$string['wsusercannotassign'] = '({$a->courseid}) azonosítóval rendelkező kurzus esetén ({$a->userid}) felhasználóhoz nem rendelheti hozzá a(z) ({$a->roleid}) szerepet.';
