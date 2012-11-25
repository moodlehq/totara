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
 * Strings for component 'enrol_self', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_self
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['customwelcomemessage'] = 'Egyedi üdvözlés';
$string['defaultrole'] = 'Alapbeállított szerep-hozzárendelés';
$string['defaultrole_desc'] = 'Válassza ki azt a szerepet, amelyet a felhasználók saját beiratkozás esetén megkapnak.';
$string['editenrolment'] = 'Beiratkozás szerkesztése';
$string['enrolenddate'] = 'Befejezési időpont';
$string['enrolenddate_help'] = 'Bekapcsolása esetén a felhasználók csak ezen időpontig iratkozhatnak be.';
$string['enrolenddaterror'] = 'A beiratkozás befejezési időpontja nem lehet korábban, mint a kezdési időpont';
$string['enrolme'] = 'Iratkoztasson be';
$string['enrolperiod'] = 'Beiratkozási időszak';
$string['enrolperiod_desc'] = 'Az alapbeállítás szerinti beiratkozási időszak hossza (másodpercben). 0 megadása esetén a beiratkozási időszak alapesetben korlátlan.';
$string['enrolperiod_help'] = 'A beiratkozási időszak alapértelmezett hossza a felhasználó beiratkozásától kezdve. Kikapcsolása esetén beiratkozási időszak alapesetben korlátlan lesz.';
$string['enrolstartdate'] = 'Kezdési időpont';
$string['enrolstartdate_help'] = 'Bekapcsolása esetén a felhasználók csak ezen időponttól iratkozhatnak be.';
$string['groupkey'] = 'Csoportos beiratkozási kulcs használata';
$string['groupkey_desc'] = 'Csoportos beiratkozási kulcs használata alapesetben.';
$string['groupkey_help'] = 'A kurzus elérésének kulcs ismeretéhez kötésén túl a csoportos beiratkozási kulcs használata esetén a felhasználók automatikusan egy csoportba kerülnek, amikor felvesznek egy kurzust.
A csoportos beiratkozási kulcs használatához a kurzusbeállítások között meg kell adni egy beiratkozási kulcsot, a csoportbeállítások között pedig egy csoportos beiratkozási kulcsot.';
$string['longtimenosee'] = 'Tétlenségi kiiratkoztatás időtartama';
$string['longtimenosee_help'] = 'Ha egy felhasználó hosszú ideig nem lép be a kurzusba, automatikusan kiiratkoztatja a rendszer. Ez a paraméter határozza meg ennek időtartamát.';
$string['maxenrolled'] = 'Max. beiratkozott felhasználó';
$string['maxenrolled_help'] = 'Saját beiratkozású felhasználók max. száma. A 0 korlátlant jelent.';
$string['maxenrolledreached'] = 'A saját beiratkozású felhasználók max. számát elérte.';
$string['nopassword'] = 'Beiratkozási kulcsra nincs szükség';
$string['password'] = 'Beiratkozási kulcs';
$string['password_help'] = 'A beiratkozási kulccsal csak azok léphetnek be a kurzusba, akik ismerik azt.
Ha a mező üres, bárki beiratkozhat.
Ha van megadva beiratkozási kulcs, azt bármely kurzust fölvevőnek meg kell adnia. Ugyanakkor a beiratkozási kulcsot CSAK EGYSZER, a beiratkozáskor kell megadni.';
$string['passwordinvalid'] = 'Hibás beiratkozási kulcs, próbálja meg újra.';
$string['passwordinvalidhint'] = 'Ez a beiratkozási kulcs hibás, próbálja újra (Segítségül: kezdete \'{$a}\')';
$string['pluginname'] = 'Saját beiratkozás';
$string['pluginname_desc'] = 'A saját beiratkozás segédprogramjával a felhasználók megválasztják, melyik kurzusokat kívánják fölvenni. A kurzust beiratkozási kulcs védheti. Belsőleg a beiratkozást egy kézi beiratkozási segédprogram végzi, melyet az adott kurzusban be kell kapcsolni.';
$string['requirepassword'] = 'Beiratkozási kulcs előírása';
$string['requirepassword_desc'] = 'Új kurzusokhoz beiratkozási kulcs előírása és meglévő kurzusok esetén a beiratkozási kulcs eltávolításának megakadályozása';
$string['role'] = 'Alapesetben hozzárendelt szerep';
$string['self:config'] = 'Saját beiratkozási példányok beállítása';
$string['self:manage'] = 'Beiratkozott felhasználók kezelése';
$string['self:unenrol'] = 'Felhasználók kiiratkoztatása a kurzusból';
$string['self:unenrolself'] = 'Kurzus leadása';
$string['sendcoursewelcomemessage'] = 'Küldjön a kurzusba belépéshez üdvözlő üzenetet.';
$string['sendcoursewelcomemessage_help'] = 'Bekapcsolása esetén a felhasználók üdvözlő üzenetet kapnak, ha egy kurzusba beiratkoznak.';
$string['showhint'] = 'Tipp megjelenítése';
$string['showhint_desc'] = 'Vendég belépési kulcsából az első betű megjelenítése';
$string['status'] = 'Saját beiratkozás engedélyezése';
$string['status_desc'] = 'Felhasználóknak alapesetben saját kurzusfelvétel engedélyezése';
$string['status_help'] = 'Ez a beállítás szabja meg, hogy egy felhasználó önállóan felvehet-e (és a megfelelő engedély birtokában leadhat-e) egy kurzust.';
$string['unenrol'] = 'Felhasználó kiiratkoztatása';
$string['unenrolselfconfirm'] = 'Biztosan leadja a(z) "{$a}" kurzust?';
$string['unenroluser'] = 'Biztosan kiiratkoztatja "{$a->user}" felhasználót ebből a kurzusból: "{$a->course}"?';
$string['usepasswordpolicy'] = 'Jelszóeljárás használata';
$string['usepasswordpolicy_desc'] = 'Standard jelszóeljárás használata beiratkozási kulcsok esetén';
$string['welcometocourse'] = 'Üdvözöljük itt: {$a}';
$string['welcometocoursetext'] = 'Üdvözöljük {$a->coursename} kurzusunkban! Ha még nem tette meg, állítsa be felhasználói profilját, hogy többet megtudjunk Önről: {$a->profileurl}';
