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
 * Strings for component 'backup', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   backup
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['autoactivedescription'] = 'Döntse el, legyen-e automatikus biztonsági mentés. Ha a kézit választja, az automatikus biztonsági mentés csak az automatikus biztonsági mentési CLI-kódon keresztül.lesz elérhető. Ezt vagy kézi úton a parancssorból, vagy a cronon keresztül használhatja.';
$string['autoactivedisabled'] = 'Kikapcsolva';
$string['autoactiveenabled'] = 'Bekapcsolva';
$string['autoactivemanual'] = 'Kézi';
$string['automatedbackupschedule'] = 'Ütemezés';
$string['automatedbackupschedulehelp'] = 'Válassza ki, mely napokon kerüljön sorra az automatikus biztonsági mentés.';
$string['automatedbackupsinactive'] = 'A portál rendszergazdája nem kapcsolta be az automatikus biztonsági mentést.';
$string['automatedbackupstatus'] = 'Az automatikus biztonsági mentés állapota';
$string['automatedsettings'] = 'Az automatikus biztonsági mentés beállításai';
$string['automatedsetup'] = 'Az automatikus biztonsági mentés beállítása';
$string['automatedstorage'] = 'Az automatikus biztonsági mentés tárolása';
$string['automatedstoragehelp'] = 'Válassza ki az automatikus biztonsági mentés tárolásának helyét.';
$string['backupactivity'] = 'Biztonsági mentéshez kapcsolódó tevékenység: {$a}';
$string['backupcourse'] = 'Biztonsági mentés erről a kurzusról: {$a}';
$string['backupcoursedetails'] = 'A kurzus adatai';
$string['backupcoursesection'] = 'Fejezet: {$a}';
$string['backupcoursesections'] = 'Kurzusfejezetek';
$string['backupdate'] = 'Teljesítés dátuma';
$string['backupdetails'] = 'A biztonsági mentés részletei';
$string['backupdetailsnonstandardinfo'] = 'A kiválasztott állomány nem a Moodle szokásos biztonsági mentési állománya. A helyreállítási folyamat megpróbálja először átalakítani a szokásos formába, majd helyreállítani az állományt.';
$string['backupformat'] = 'Forma';
$string['backupformatimscc1'] = 'IMS Common Cartridge 1.0';
$string['backupformatimscc11'] = 'IMS Common Cartridge 1.1';
$string['backupformatmoodle1'] = 'Moodle 1';
$string['backupformatmoodle2'] = 'Moodle 2';
$string['backupformatunknown'] = 'Ismeretlen forma';
$string['backupmode'] = 'Mód';
$string['backupmode10'] = 'Általános';
$string['backupmode20'] = 'Importálás';
$string['backupmode30'] = 'Elosztó';
$string['backupmode40'] = 'Ugyanaz a portál';
$string['backupmode50'] = 'Automatikus';
$string['backupmode60'] = 'Átalakított';
$string['backupsection'] = 'Biztonsági mentés erről a kurzusfejezetről: {$a}';
$string['backupsettings'] = 'A biztonsági mentés beállításai';
$string['backupsitedetails'] = 'Portál adatai';
$string['backupstage16action'] = 'Tovább';
$string['backupstage1action'] = 'Következő';
$string['backupstage2action'] = 'Következő';
$string['backupstage4action'] = 'Biztonsági mentés végrehajtása';
$string['backupstage8action'] = 'Tovább';
$string['backuptype'] = 'Típus';
$string['backuptypeactivity'] = 'Tevékenység';
$string['backuptypecourse'] = 'Kurzus';
$string['backuptypesection'] = 'Rész';
$string['backupversion'] = 'Biztonsági mentés verziója';
$string['cannotfindassignablerole'] = 'A biztonsági mentés állományában lévő {$a} szerep az Ön által hozzárendelhető szerepek egyikével sem azonosítható.';
$string['choosefilefromactivitybackup'] = 'Tevékenység biztonsági mentésének területe';
$string['choosefilefromactivitybackup_help'] = 'Amikor a tevékenységekről biztonsági mentés készül, ide kerülnek annak állományai';
$string['choosefilefromautomatedbackup'] = 'Automatikus biztonsági mentések';
$string['choosefilefromautomatedbackup_help'] = 'Az automatikus biztonsági mentéseket tartalmazza';
$string['choosefilefromcoursebackup'] = 'A kurzus biztonsági mentésének területe';
$string['choosefilefromcoursebackup_help'] = 'Ha alapbeállításokkal készít kurzusokról biztonsági mentést, annak állományai ide kerülnek majd';
$string['choosefilefromuserbackup'] = 'Saját biztonsági mentések területe';
$string['choosefilefromuserbackup_help'] = 'Ha bejelölt "Felhasználói adatok elrejtése" beállítással készít kurzusokról biztonsági mentést, annak állományai ide kerülnek majd';
$string['configgeneralactivities'] = 'Alapbeállításban adja meg a biztonsági mentésben rögzítendő tevékenységeket.';
$string['configgeneralanonymize'] = 'Bejelölése esetén alaphelyzetben minden felhasználói adatot elrejt';
$string['configgeneralblocks'] = 'Alapbeállításban adja meg a biztonsági mentésben rögzítendő blokkokat.';
$string['configgeneralcomments'] = 'Alapbeállításban adja meg a biztonsági mentésben rögzítendő megjegyzéseket.';
$string['configgeneralfilters'] = 'Alapbeállításban adja meg a biztonsági mentésben rögzítendő szűrőket.';
$string['configgeneralhistories'] = 'Alapbeállításban adja meg a biztonsági mentésben rögzítendő felhasználói előzményeket.';
$string['configgenerallogs'] = 'Bejelölése esetén alaphelyzetben a naplók bekerülnek a biztonsági mentésbe.';
$string['configgeneralroleassignments'] = 'Bejelölése esetén alaphelyzetben a szerep-hozzárendelések is bekerülnek a biztonsági mentésbe.';
$string['configgeneralusers'] = 'Bejelölése esetén alaphelyzetben a felhasználók is bekerülnek a biztonsági mentésbe.';
$string['configgeneraluserscompletion'] = 'Bejelölése esetén alaphelyzetben a felhasználói teljesítés adatai is bekerülnek a biztonsági mentésbe.';
$string['configloglifetime'] = 'Itt adja meg a biztonsági mentések megőrizendő naplózásának időtartamát. Az ennél régebbi naplókat a rendszer automatikusan törli. Lehetőleg rövid időt állítson be, mert ez a naplózás igen terjedelmesre duzzadhat.';
$string['confirmcancel'] = 'Biztonsági mentés törlése';
$string['confirmcancelno'] = 'Marad';
$string['confirmcancelquestion'] = 'Biztosan törli? Ezzel minden megadott adat elvész.';
$string['confirmcancelyes'] = 'Törlés';
$string['confirmnewcoursecontinue'] = 'Figyelmeztetés új kurzusra';
$string['confirmnewcoursecontinuequestion'] = 'A kurzus-helyreállítási folyamat során ideiglenes (rejtett) kurzus jön létre. A folyamat megszakításához kattintson a Mégse gombra. A helyreállítás alatt ne zárja be a böngészőt.';
$string['coursecategory'] = 'A visszaállítandó kurzusok kategóriája';
$string['courseid'] = 'Eredeti azonosító';
$string['coursesettings'] = 'Kurzusbeállítások';
$string['coursetitle'] = 'Cím';
$string['currentstage1'] = 'Kezdő beállítások';
$string['currentstage16'] = 'Kész';
$string['currentstage2'] = 'Sémabeállítások';
$string['currentstage4'] = 'Megerősítés és ellenőrzés';
$string['currentstage8'] = 'Biztonsági mentés végrehajtása';
$string['dependenciesenforced'] = 'Megoldatlan függőségek miatt beállításai módosultak';
$string['enterasearch'] = 'Adjon meg egy keresést.';
$string['error_block_for_module_not_found'] = 'Egyedüli blokkpéldány (azonosítója: {$a->bid}) fordul elő a kurzusmodulban (azonosítója: {$a->mid}). A blokkról nem készül biztonsági másolat.';
$string['error_course_module_not_found'] = 'Egyedüli blokkpéldány (azonosítója: {$a->bid}) fordul elő. A blokkról nem készül biztonsági másolat.';
$string['errorfilenamemustbezip'] = 'A megadandó állománynak tömörítettnek és .zip kiterjesztésűnek kell lenni';
$string['errorfilenamerequired'] = 'A biztonsági mentéshez érvényes állománynevet kell megadnia';
$string['errorinvalidformat'] = 'Ismeretlen formájú biztonsági mentés';
$string['errorinvalidformatinfo'] = 'A kiválasztott állomány nem a Moodle szokásos biztonsági mentési állománya, helyreállítása nem lehetséges.';
$string['errorminbackup20version'] = 'A biztonsági mentés állománya a Moodle biztonsági mentésének egy fejlesztési változatával ({$a->backup}) készült. A minimálisan használandó változat: {$a->min}. A visszaállítás nem sikerült.';
$string['errorrestorefrontpage'] = 'A kezdőoldalra való visszaállítás nem engedélyezett.';
$string['executionsuccess'] = 'A biztonsági mentés állományának létrehozása sikerült.';
$string['filename'] = 'Állománynév';
$string['generalactivities'] = 'Tevékenységekkel együtt';
$string['generalanonymize'] = 'Adatok elrejtése';
$string['generalbackdefaults'] = 'A biztonsági mentés általános alapbeállításai';
$string['generalblocks'] = 'Blokkokkal együtt';
$string['generalcomments'] = 'Megjegyzésekkel együtt';
$string['generalfilters'] = 'Szűrőkkel együtt';
$string['generalgradehistories'] = 'Előzményekkel együtt';
$string['generalhistories'] = 'Előzményekkel együtt';
$string['generallogs'] = 'Naplókkal együtt';
$string['generalroleassignments'] = 'Szerep-hozzárendelésekkel együtt';
$string['generalsettings'] = 'Biztonsági mentések általános beállításai';
$string['generalusers'] = 'Felhasználókkal együtt';
$string['generaluserscompletion'] = 'A felhasználói teljesítés adataival együtt';
$string['importbackupstage16action'] = 'Tovább';
$string['importbackupstage1action'] = 'Következő';
$string['importbackupstage2action'] = 'Következő';
$string['importbackupstage4action'] = 'Importálás végrehajtása';
$string['importbackupstage8action'] = 'Tovább';
$string['importcurrentstage0'] = 'Kurzusválasztás';
$string['importcurrentstage1'] = 'Kezdő beállítások';
$string['importcurrentstage16'] = 'Kész';
$string['importcurrentstage2'] = 'Sémabeállítások';
$string['importcurrentstage4'] = 'Megerősítés és ellenőrzés';
$string['importcurrentstage8'] = 'Importálás végrehajtása';
$string['importfile'] = 'Biztonsági mentés állományának importálása';
$string['importsuccess'] = 'Az importálás kész. A Tovább gombra kattintva térhet vissza a kurzushoz';
$string['includeactivities'] = 'Hozzávesz:';
$string['includeditems'] = 'Hozzávett tételek:';
$string['includesection'] = '{$a} fejezet';
$string['includeuserinfo'] = 'Felhasználói adatok';
$string['locked'] = 'Zárolva';
$string['lockedbyconfig'] = 'A biztonsági mentés alapbeállításai zárolták ezt a beállítást';
$string['lockedbyhierarchy'] = 'Függőségek révén zárolva';
$string['lockedbypermission'] = 'Nincs kellő jogosultsága a beállítás módosításához';
$string['loglifetime'] = 'Naplók megőrizendők';
$string['managefiles'] = 'Biztonsági mentés állományainak kezelése';
$string['moodleversion'] = 'Moodle-verzió';
$string['moreresults'] = 'Túl sok a találat, adjon meg egy konkrétabb keresést.';
$string['nomatchingcourses'] = 'Nincs megjeleníthető kurzus';
$string['norestoreoptions'] = 'A visszaállításhoz nincs kategória vagy kurzus.';
$string['originalwwwroot'] = 'A biztonsági mentés URL-je';
$string['previousstage'] = 'Előző';
$string['qcategory2coursefallback'] = 'Az eredetileg a biztonsági mentés állományában a rendszer/kurzuskategória környezetében lévő "{$a->name}" kérdéskategória visszaállítás során a kurzuskörnyezetben jön létre';
$string['qcategorycannotberestored'] = 'A(z) "{$a->name}" kérdéskategória visszaállítás során nem hozható létre';
$string['question2coursefallback'] = 'Az eredetileg a biztonsági mentés állományában a rendszer/kurzuskategória környezetében lévő "{$a->name}" kérdéskategória visszaállítás során a kurzuskörnyezetben jön létre';
$string['questionegorycannotberestored'] = 'A(z) "{$a->name}" kérdések visszaállítás során nem hozhatók létre';
$string['restoreactivity'] = 'Tevékenység visszaállítása';
$string['restorecourse'] = 'Kurzus visszaállítása';
$string['restorecoursesettings'] = 'Kurzusbeállítások';
$string['restoreexecutionsuccess'] = 'A kurzusok visszaállítása sikerült, a Tovább gombra kattintva tekintheti meg a  visszaállított kurzust.';
$string['restorenewcoursefullname'] = 'Új kurzusnév';
$string['restorenewcourseshortname'] = 'Új rövid kurzusnév';
$string['restorenewcoursestartdate'] = 'Új kezdési időpont';
$string['restorerolemappings'] = 'Szerep-hozzárendelések visszaállítása';
$string['restorerootsettings'] = 'Beállítások visszaállítása';
$string['restoresection'] = 'Fejezet visszaállítása';
$string['restorestage1'] = 'Megerősítés';
$string['restorestage16'] = 'Ellenőrzés';
$string['restorestage16action'] = 'Visszaállítás végrehajtása';
$string['restorestage1action'] = 'Következő';
$string['restorestage2'] = 'Cél';
$string['restorestage2action'] = 'Következő';
$string['restorestage32'] = 'Feldolgozás';
$string['restorestage32action'] = 'Tovább';
$string['restorestage4'] = 'Beállítások';
$string['restorestage4action'] = 'Következő';
$string['restorestage64'] = 'Kész';
$string['restorestage64action'] = 'Tovább';
$string['restorestage8'] = 'Séma';
$string['restorestage8action'] = 'Következő';
$string['restoretarget'] = 'Cél visszaállítása';
$string['restoretocourse'] = 'Visszaállítás ebbe a kurzusba:';
$string['restoretocurrentcourse'] = 'Visszaállítás ebbe a kurzusba:';
$string['restoretocurrentcourseadding'] = 'A kurzus biztonsági mentésének egyesítése ezzel a kurzussal';
$string['restoretocurrentcoursedeleting'] = 'A kurzus tartalmának törlése, azután visszaállítás';
$string['restoretoexistingcourse'] = 'Visszaállítás egy létező kurzusba';
$string['restoretoexistingcourseadding'] = 'A kurzus biztonsági mentésének egyesítése egy létező kurzussal';
$string['restoretoexistingcoursedeleting'] = 'A létező kurzus tartalmának törlése, azután visszaállítás';
$string['restoretonewcourse'] = 'Visszaállítás új kurzusként';
$string['restoringcourse'] = 'A kurzus-visszaállítás folyamatban';
$string['restoringcourseshortname'] = 'Visszaállítás';
$string['rootsettingactivities'] = 'Tevékenységekkel együtt';
$string['rootsettinganonymize'] = 'Felhasználói adatok elrejtése';
$string['rootsettingblocks'] = 'Blokkokkal együtt';
$string['rootsettingcalendarevents'] = 'Naptári események szerepeltetése';
$string['rootsettingcomments'] = 'Megjegyzésekkel együtt';
$string['rootsettingfilters'] = 'Szűrőkkel együtt';
$string['rootsettinggradehistories'] = 'Pontozási előzményekkel együtt';
$string['rootsettingimscc1'] = 'Átalakítás IMS Common Cartridge 1.0 formára';
$string['rootsettingimscc11'] = 'Átalakítás IMS Common Cartridge 1.1 formára';
$string['rootsettinglogs'] = 'Kurzusnaplókkal együtt';
$string['rootsettingroleassignments'] = 'Felhasználói szerep-hozzárendelésekkel együtt';
$string['rootsettings'] = 'A biztonsági mentés beállításai';
$string['rootsettingusers'] = 'Beiratkozott felhasználókkal együtt';
$string['rootsettinguserscompletion'] = 'A felhasználói teljesítés adataival együtt';
$string['sectionactivities'] = 'Tevékenységek';
$string['sectioninc'] = 'A biztonsági mentés része (nincs felhasználói adat)';
$string['sectionincanduser'] = 'A biztonsági mentés része felhasználói adatokkal együtt';
$string['selectacategory'] = 'Válasszon kategóriát';
$string['selectacourse'] = 'Válasszon kurzust';
$string['setting_course_fullname'] = 'Kurzusnév';
$string['setting_course_shortname'] = 'Rövid kurzusnév';
$string['setting_course_startdate'] = 'Kurzus kezdési időpontja';
$string['setting_keep_groups_and_groupings'] = 'Aktuális csoportok és csoportosítások megőrzése';
$string['setting_keep_roles_and_enrolments'] = 'Aktuális szerepek és beiratkozások megőrzése';
$string['setting_overwriteconf'] = 'Kurzusbeállítás felülírása';
$string['storagecourseandexternal'] = 'A kurzus biztonsági mentési állományainak területe és a megadott könyvtár';
$string['storagecourseonly'] = 'A kurzus biztonsági mentési állományainak területe';
$string['storageexternalonly'] = 'Megadott könyvtár az automatikus biztonsági mentésekhez';
$string['totalcategorysearchresults'] = 'Összes kategória: {$a}';
$string['totalcoursesearchresults'] = 'Összes kurzus: {$a}';
