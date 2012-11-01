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
 * Strings for component 'repository', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   repository
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessiblefilepicker'] = 'Elérhető fájlválasztó';
$string['activaterep'] = 'Aktív adattárak';
$string['activerepository'] = 'Elérhető adattár-segédprogramok';
$string['activitybackup'] = 'Tevékenység biztonsági mentése';
$string['add'] = 'Hozzáadás';
$string['addfile'] = 'Hozzáadás...';
$string['addplugin'] = 'Adattár-segédprogram hozzáadása';
$string['allowexternallinks'] = 'Külső ugrópontok engedélyezése';
$string['areacategoryintro'] = 'Kategória bevezetője';
$string['areacourseintro'] = 'Kurzus bevezetője';
$string['areamainfile'] = 'Fő állomány';
$string['arearoot'] = 'Rendszer';
$string['areauserbackup'] = 'Felhasználó biztonsági mentése';
$string['areauserdraft'] = 'Vázlatok';
$string['areauserpersonal'] = 'Magánállományok';
$string['areauserprofile'] = 'Profil';
$string['attachedfiles'] = 'Csatolt állományok';
$string['attachment'] = 'Csatolt állomány';
$string['author'] = 'Szerző';
$string['automatedbackup'] = 'Automatikus biztonsági mentések';
$string['back'] = '&laquo; Vissza';
$string['backtodraftfiles'] = '&laquo; Vissza a vázlatkezelőhöz';
$string['cachecleared'] = 'A gyorsítótárba helyezett állományok törlődtek';
$string['cacheexpire'] = 'A gyorsítótár lejárata';
$string['cannotaccessparentwin'] = 'Ha a szülőablak HTTPS-en keresztül érhető el, akkor a window.opener objektum nem elérhető, így adattárát nem lehet automatikusan frissíteni, de a folyamat már elkezdődött. Térjen vissza a fájlválasztáshoz és ismételten válassza ki az adattárat, a dolog működni fog.';
$string['cannotdelete'] = 'Az állomány nem törölhető.';
$string['cannotdownload'] = 'Az állomány nem tölthető le.';
$string['cannotdownloaddir'] = 'A mappa nem tölthető le.';
$string['cannotinitplugin'] = 'A plugin_init meghívása nem sikerült.';
$string['choosealink'] = 'Válasszon ugrópontot...';
$string['chooselicense'] = 'Válasszon licencet';
$string['cleancache'] = 'A gyorsítótárba helyezett állományaim törlése';
$string['close'] = 'Bezárás';
$string['commonrepositorysettings'] = 'Közös adattár beállításai';
$string['configallowexternallinks'] = 'Ezzel minden felhasználó eldöntheti, hogy a külső média bemásolódjon-e a Moodle-ba. Kikapcsolt állapotban a média mindig bemásolódik a Moodle-ba (a globális adatépség és biztonság érdekében ez általában a legjobb megoldás). Bekapcsolása esetén a felhasználók minden egyes alkalommal dönthetnek, ha valamely szöveghez médiumot adnak hozzá.';
$string['configcacheexpire'] = 'Az állománylistázás helyi gyorsítótárba helyezésének időtartama (másodpercben) külső adattárak böngészése közben.';
$string['configsaved'] = 'Beállítások elmentve!';
$string['confirmdelete'] = 'Biztosan törli ezt az adattárat -{$a} ?';
$string['confirmdeletefile'] = 'Biztosan törli ezt az állományt?';
$string['confirmremove'] = 'Biztosan törli ezt az adattár-segédprogramot, annak beállításait és <strong style=color:red>összes példányát</strong> - {$a}?';
$string['copying'] = 'Másolás';
$string['coursebackup'] = 'Kurzus biztonsági mentései';
$string['create'] = 'Létrehozás';
$string['createfolderfail'] = 'A mappa létrehozása nem sikerült.';
$string['createfoldersuccess'] = 'A mappa létrehozása sikerült.';
$string['createinstance'] = 'Adattárpéldány létrehozása';
$string['createrepository'] = 'Adattár létrehozása';
$string['createxxinstance'] = '"{$a}" előfordulás létrehozása';
$string['date'] = 'Dátum';
$string['deleted'] = 'Adattár törölve';
$string['deleterepository'] = 'Adattár törlése';
$string['disabled'] = 'Kikapcsolva';
$string['download'] = 'Letöltés';
$string['downloadfolder'] = 'Összes letöltése';
$string['downloadsucc'] = 'Az állomány letöltése sikerült.';
$string['draftareanofiles'] = 'Nem tölthető le, mert nincsenek csatolt állományok';
$string['editrepositoryinstance'] = 'Adattárpéldány szerkesztése';
$string['emptylist'] = 'Üres lista';
$string['emptytype'] = 'Az adattártípus nem hozható létre: a típus neve üres.';
$string['enablecourseinstances'] = 'Kurzusadattár kurzushoz való hozzáadásának engedélyezése a felhasználók számára';
$string['enableuserinstances'] = 'Kurzusadattár felhasználói környezethez való hozzáadásának engedélyezése a felhasználók számára';
$string['enter'] = 'Belépés';
$string['entername'] = 'Adja meg a mappa nevét.';
$string['enternewname'] = 'Adja meg az új állomány nevét.';
$string['error'] = 'Ismeretlen hiba történt!';
$string['errornotyourfile'] = 'Nem választhat olyan állományt, amelyet nem Ön adott hozzá.';
$string['errorpostmaxsize'] = 'A feltöltött állomány meghaladhatja a php.ini fájlban megadott post_max_size értékét.';
$string['erroruniquename'] = 'Az adattár példányának egyedi névvel kell rendelkezni.';
$string['existingrepository'] = 'Az adattár már létezik.';
$string['federatedsearch'] = 'Mélységi keresés';
$string['fileexists'] = 'Az adott állománynév már használatban van, válasszon egy másikat.';
$string['fileexistsdialog_editor'] = 'A szerkesztendő szöveghez már csatoltak ilyen névvel állományt.';
$string['fileexistsdialog_filemanager'] = 'Ilyen névvel már csatoltak állományt.';
$string['fileexistsdialogheader'] = 'Az állomány létezik.';
$string['filename'] = 'Állománynév';
$string['filenotnull'] = 'Válasszon ki egy feltöltendő állományt.';
$string['filepicker'] = 'Állományválasztó';
$string['filesaved'] = 'Az állomány elmentve';
$string['filesizenull'] = 'Az állományméretet nem lehet meghatározni.';
$string['getfile'] = 'Az állomány kiválasztása';
$string['hidden'] = 'Rejtett';
$string['iconview'] = 'Megtekintés ikonként';
$string['instance'] = 'példány';
$string['instancedeleted'] = 'Példány törölve';
$string['instances'] = 'Adattárpéldányok';
$string['instancesforcourses'] = '{$a} egész kurzuson belüli előfordulása(i)';
$string['instancesforsite'] = '{$a} egész portálon belüli előfordulása(i)';
$string['instancesforusers'] = '{$a} felhasználói magánpéldánya(i)';
$string['invalidfiletype'] = '{$a} típusú állomány nem fogadható el.';
$string['invalidjson'] = 'Érvénytelen JSON-szöveg';
$string['invalidplugin'] = 'Érvénytelen {$a} adattár-segédprogram';
$string['invalidrepositoryid'] = 'Érvénytelen adattár-azonosító';
$string['isactive'] = 'Aktív?';
$string['keyword'] = 'Kulcsszó';
$string['linkexternal'] = 'Külső csatolása';
$string['listview'] = 'Megtekintés listaként';
$string['loading'] = 'Betöltés...';
$string['login'] = 'Belépés';
$string['logout'] = 'Kilépés';
$string['manage'] = 'Adattárak kezelése';
$string['manageurl'] = 'Kezelés';
$string['manageuserrepository'] = 'Egyedi adattárak kezelése';
$string['moving'] = 'Áthelyezés';
$string['noenter'] = 'Nincs megadva semmi';
$string['nofilesattached'] = 'Nincs csatolva állomány';
$string['nofilesavailable'] = 'Nincs elérhető állomány';
$string['nomorefiles'] = 'Több állományt nem csatolhat.';
$string['nopathselected'] = 'Nincs kiválasztva célútvonal (a fa csomópontjára kattintva válassza ki).';
$string['nopermissiontoaccess'] = 'Nincs engedély az adattárhoz';
$string['norepositoriesavailable'] = 'Egyik aktuális adattára sem szolgáltat a kért formában állományokat.';
$string['norepositoriesexternalavailable'] = 'Egyik aktuális adattára sem szolgáltat külső állományokat.';
$string['noresult'] = 'Nincs ilyen eredmény';
$string['notyourinstances'] = 'Más adattárpéldányait nem tekintheti meg/szerkesztheti.';
$string['off'] = 'Be van kapcsolva, de rejtett';
$string['on'] = 'Be van kapcsolva és látható';
$string['openpicker'] = 'Állományválasztó megnyitása';
$string['operation'] = 'Művelet';
$string['overwrite'] = 'Felülírás';
$string['personalrepositories'] = 'Elérhető adattárak';
$string['plugin'] = 'Adattár-segédprogramok';
$string['pluginerror'] = 'Hibák vannak az adattár-segédprogramban.';
$string['pluginname'] = 'Az adattár-segédprogram neve';
$string['pluginnamehelp'] = 'Ha üresen hagyja, az alapértelmezett nevet használja a rendszer.';
$string['popup'] = 'A belépéshez kattintson a "Belépés" gombra.';
$string['popupblockeddownload'] = 'A letöltési ablak blokkolva van. Engedélyezze a felugró ablakot és próbálja meg újra.';
$string['preview'] = 'Előkép';
$string['readonlyinstance'] = 'Csak olvasható példányt nem szerkeszthet/törölhet';
$string['refresh'] = 'Frissítés';
$string['refreshnonjsfilepicker'] = 'Zárja be az ablakot és frissítse a nem javascript fáljválasztót.';
$string['removed'] = 'Az adattár törölve.';
$string['renameto'] = 'Átnevezés';
$string['repositories'] = 'Adattárak';
$string['repository'] = 'Adattár';
$string['repositorycourse'] = 'Kurzusadattárak';
$string['repositoryerror'] = 'A távoli adattár hibát jelzett: {$a}';
$string['save'] = 'Mentés';
$string['saveas'] = 'Mentés másként';
$string['saved'] = 'Elmentve';
$string['saving'] = 'Mentés';
$string['search'] = 'Keresés';
$string['searching'] = 'Hol keres?';
$string['sectionbackup'] = 'Terület biztonsági mentései';
$string['select'] = 'Kiválasztás';
$string['setmainfile'] = 'Fő állomány beállítása';
$string['settings'] = 'Beállítások';
$string['setupdefaultplugins'] = 'Alapbeállítás szerinti adattár-segédprogramok beállítása';
$string['siteinstances'] = 'A portál adattárpéldányai';
$string['size'] = 'Méret';
$string['submit'] = 'Leadás';
$string['sync'] = 'Szinkronizálás';
$string['thumbview'] = 'Megtekintés ikonként';
$string['title'] = 'Válasszon állományt...';
$string['typenotvisible'] = 'A típus nem látható.';
$string['unzipped'] = 'A kibontás sikerült.';
$string['upload'] = 'Állomány feltöltése';
$string['uploading'] = 'Feltöltés...';
$string['uploadsucc'] = 'Az állomány feltöltése sikerült.';
$string['usenonjsfilemanager'] = 'Az állománykezelő megnyitása új ablakban';
$string['usenonjsfilepicker'] = 'Az állományválasztó megnyitása új ablakban';
$string['usercontextrepositorydisabled'] = 'Felhasználói környezetben nem szerkesztheti ezt az adattárat.';
$string['wrongcontext'] = 'A környezethez nem férhet hozzá.';
$string['xhtmlerror'] = 'Valószínűleg szigorú fejlécű XHTML-t használ. Ebben az üzemmódban egyes YUI-alkotóelemek nem működnek, ezért Moodle-ban kapcsolja ki.';
$string['ziped'] = 'A mappa tömörítése sikerült.';
