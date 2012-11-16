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
 * Strings for component 'enrol', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actenrolshhdr'] = 'Elérhető kurzusfelvételi segédprogramok';
$string['addinstance'] = 'Módszer hozzáadása';
$string['ajaxnext25'] = 'Következő 25...';
$string['ajaxoneuserfound'] = '1 felhasználót találtam';
$string['ajaxxusersfound'] = '{$a} felhasználót találtam';
$string['assignnotpermitted'] = 'Ebben a kurzusban nem jogosult vagy nem tud szerepeket hozzárendelni.';
$string['bulkuseroperation'] = 'Egyesített felhasználói művelet';
$string['configenrolplugins'] = 'Válassza ki az összes szükséges segédprogramot és rendezze el őket a helyes sorrendben.';
$string['custominstancename'] = 'Egyedi előfordulás neve';
$string['defaultenrol'] = 'Előfordulás hozzáadása új kurzusokhoz';
$string['defaultenrol_desc'] = 'Ezt a segédprogramot alaphelyzetben minden új kurzushoz hozzáadhatja';
$string['deleteinstanceconfirm'] = 'Biztosan törli a "{$a->name}" nevű,  {$a->users} beiratkozott tanulót számláló beiratkozási segédprogramot?';
$string['durationdays'] = '{$a} nap';
$string['enrol'] = 'Beírat';
$string['enrolcandidates'] = 'Be nem iratkozott felhasználók';
$string['enrolcandidatesmatching'] = 'Megfelelő be nem iratkozott felhasználók';
$string['enrolcohort'] = 'Beiratkozottak felvétele';
$string['enrolcohortusers'] = 'Felhasználók beíratása';
$string['enrollednewusers'] = 'Sikeresen beiratkoztatott ({$a}) új felhasználót';
$string['enrolledusers'] = 'Beiratkozott felhasználók';
$string['enrolledusersmatching'] = 'Megfelelő beiratkozott felhasználók';
$string['enrolme'] = 'Felveszem ezt a kurzust';
$string['enrolmentinstances'] = 'Beiratkozási módszerek';
$string['enrolmentnew'] = 'Új beiratkozás itt: {$a}';
$string['enrolmentnewuser'] = '{$a->user} felvette ezt a kurzust: "{$a->course}"';
$string['enrolmentoptions'] = 'Beiratkozási lehetőségek';
$string['enrolments'] = 'Beiratkozások';
$string['enrolnotpermitted'] = 'Ebben a kurzusban nem jogosult vagy nem tud beiratkoztatni.';
$string['enrolperiod'] = 'Beiratkozási időszak';
$string['enroltimeend'] = 'Beiratkozás véget ér';
$string['enroltimestart'] = 'Beiratkozás kezdete';
$string['enrolusage'] = 'Előfordulások / beiratkozások';
$string['enrolusers'] = 'Felhasználók beiratkoztatása';
$string['errajaxfailedenrol'] = 'Felhasználók beiratkoztatása sikertelen';
$string['errajaxsearch'] = 'Hiba felhasználók keresése közben';
$string['erroreditenrolment'] = 'Hiba történt a felhasználói beiratkozások szerkesztése közben';
$string['errorenrolcohort'] = 'Hiba a beiratkozottak szinkronizált kurzusba való beíratása közben';
$string['errorenrolcohortusers'] = 'Hiba beiratkozottak kurzusba való beíratása közben';
$string['errorwithbulkoperation'] = 'Hiba történt az egyesített beiratkozások módosításának feldolgozása közben';
$string['extremovedaction'] = 'Külső kiiratkoztatási lépés';
$string['extremovedaction_help'] = 'Válassza ki a végrehajtandó tevékenységet, ha a felhasználó beiratkozása eltűnik a külső beiratkoztatási állományból. A kiiratkoztatás során egyes felhasználói adatok és beállítások törlődnek a kurzusból.';
$string['extremovedkeep'] = 'Felhasználók beiratkozásának megtartása';
$string['extremovedsuspend'] = 'Kurzusfelvétel kikapcsolása';
$string['extremovedsuspendnoroles'] = 'Kurzusfelvétel kikapcsolása és szerepek eltávolítása';
$string['extremovedunenrol'] = 'Felhasználó kiiratkoztatása a kurzusból';
$string['finishenrollingusers'] = 'Felhasználók beiratkoztatásának befejezése';
$string['invalidenrolinstance'] = 'Beiratkoztatás érvénytelen előfordulása';
$string['invalidrole'] = 'Érvénytelen szerep';
$string['manageenrols'] = 'Beiratkozási segédprogramok kezelése';
$string['manageinstance'] = 'Kezelés';
$string['nochange'] = 'Nincs változás';
$string['noexistingparticipants'] = 'Nincs résztvevő';
$string['noguestaccess'] = 'A kurzusba vendégek nem léphetnek be, próbáljon meg bejelentkezni.';
$string['none'] = 'Nincs';
$string['notenrollable'] = 'Ezt a kurzust nem veheti fel.';
$string['notenrolledusers'] = 'Más felhasználók';
$string['otheruserdesc'] = 'Az alábbi felhasználók nem vették fel a kurzust, de öröklött vagy hozzárendelt szereppel rendelkeznek.';
$string['participationactive'] = 'Aktív';
$string['participationstatus'] = 'Állapot';
$string['participationsuspended'] = 'Felfüggesztve';
$string['periodend'] = '{$}-ig';
$string['periodstart'] = 'kezdete: {$}';
$string['periodstartend'] = '{$a->start}-tól/-től {$a->end}-ig';
$string['recovergrades'] = 'A felhasználó korábbi osztályzatainak visszanyerése, ha lehetséges';
$string['rolefromcategory'] = '{$a->role} (Kurzuskategóriából örökölte)';
$string['rolefrommetacourse'] = '{$a->role} (Felettes kategóriából örökölte)';
$string['rolefromsystem'] = '{$a->role} (Portálszinten hozzárendelve)';
$string['rolefromthiscourse'] = '{$a->role} (A kurzusban lett hozzárendelve)';
$string['startdatetoday'] = 'Ma';
$string['synced'] = 'Szinkronizálva';
$string['totalenrolledusers'] = '{$a} beiratkozott felhasználó';
$string['totalotherusers'] = '{$a} egyéb felhasználó';
$string['unassignnotpermitted'] = 'Ebben a kurzusban nem jogosult hozzárendelt szerepeket törölni.';
$string['unenrol'] = 'Kiiratkoztatás';
$string['unenrolconfirm'] = 'Biztosan kiiratkoztatja "{$a->user}" felhasználót a(z) "{$a->course}" kurzusból?';
$string['unenrolme'] = 'Leadom a(z) {$a} kurzust';
$string['unenrolnotpermitted'] = 'Ebből a kurzusból nem jogosult vagy nem tud kiiratkoztatni.';
$string['unenrolroleusers'] = 'Felhasználók kiiratkoztatása';
$string['uninstallconfirm'] = 'Teljesen törölni fogja a(z) \'{$a}\' beiratkozási segédprogramot. Ezzel együtt törölni fogja az adott beiratkozási típussal kapcsolatban az adatbázisban tárolt összes adatot. BIZTOSAN folytatja?';
$string['uninstalldeletefiles'] = 'A(z) \'{$a->plugin}\' beiratkozási segédprogramhoz kapcsolódó összes adatot törölte az adatbázisból. A törlés befejezéséhez (és a segédprogram újratelepülésének megelőzéséhez) törölje ezt a könyvtárat a szerveréről: {$a->directory}.';
$string['unknowajaxaction'] = 'Ismeretlen tevékenység kérése';
$string['unlimitedduration'] = 'Korlátlan';
$string['usersearch'] = 'Keresés';
$string['withselectedusers'] = 'A kiválasztott felhasználókkal';
