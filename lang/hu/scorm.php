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
 * Strings for component 'scorm', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   scorm
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activation'] = 'Bekapcsolás';
$string['activityloading'] = 'Automatikusan átkerül ehhez a tevékenységhez:';
$string['activitypleasewait'] = 'Tevékenység betöltése folyamatban, várjon...';
$string['adminsettings'] = 'A rendszergazda beállításai';
$string['advanced'] = 'Paraméterek';
$string['aicchacpkeepsessiondata'] = 'Az AICC HACP folyamat adatai';
$string['aicchacpkeepsessiondata_desc'] = 'A külső AICC HACP folyamat adatainak megőrzési időtartama napokban';
$string['aicchacptimeout'] = 'Az AICC HACP lejárata';
$string['aicchacptimeout_desc'] = 'A külső AICC HACP folyamat nyitva tartásának időtartama percekben';
$string['allowapidebug'] = 'API hibaszűrésének és nyomon követésének bekapcsolása (az elemzési maszkot állítsa be az apidebugmask segítségével)';
$string['allowtypeaicchacp'] = 'Külső AICC HACP folyamat bekapcsolása';
$string['allowtypeaicchacp_desc'] = 'Bekapcsolása esetén a AICC HACP részére külső kommunikációt engedélyez a külső AICC HACP csomagból felhasználói bejelentkezés nélküli kérések leadásához.';
$string['allowtypeexternal'] = 'Külső csomagtípus bekapcsolása';
$string['allowtypeexternalaicc'] = 'Közvetlen AICC URL bekapcsolása';
$string['allowtypeexternalaicc_desc'] = 'Bekapcsolása esetén közvetlen URL-t engedélyez egy egyszerű AICC-csomaghoz.';
$string['allowtypeimsrepository'] = 'IMS csomagtípus bekapcsolása';
$string['allowtypelocalsync'] = 'Letöltött csomagtípus bekapcsolása';
$string['apidebugmask'] = 'API hibaszűrésének elemzési maszkja - egyszerű regex használata a <username>:<activityname> esetén, pl. az admin:. * csak a rendszerhasználókra végez hibaszűrést';
$string['areacontent'] = 'Tartalomfájlok';
$string['areapackage'] = 'Csomagfájlok';
$string['asset'] = 'Tudáselem';
$string['assetlaunched'] = 'Tudáselem - megtekintve';
$string['attempt'] = 'Próbálkozás';
$string['attempt1'] = '1. próbálkozás';
$string['attempts'] = 'Próbálkozások';
$string['attemptsx'] = '{$a} próbálkozás';
$string['attr_error'] = 'Hibás érték a(z) {$a->tag} elem attribútumánál ({$a->attr}).';
$string['autocontinue'] = 'Automatikus folytatás';
$string['autocontinue_help'] = 'Ha az automatikus folytatás be van kapcsolva, a SCO "kommunikáció lezárása" metódus
meghívásakor automatikusan elindul a következő meglévő SCO.
Kikapcsolása esetén a folytatáshoz a tanulónak meg kell nyomnia a "Tovább" gombot.';
$string['autocontinuedesc'] = 'Ez állítja be a tevékenységhez az alapbeállítás szerinti automatikus folytatást.';
$string['averageattempt'] = 'Próbálkozások átlaga';
$string['badmanifest'] = 'Hibás tananyagleírás: lásd a hibanaplót';
$string['badpackage'] = 'A megadott csomag/tananyagleírás érvénytelen. Ellenőrizze és próbálja meg újra.';
$string['browse'] = 'Előzetes megtekintés';
$string['browsed'] = 'Böngészés megtörtént';
$string['browsemode'] = 'Előzetes megtekintés üzemmódja';
$string['browserepository'] = 'Adattár böngészése';
$string['cannotfindsco'] = 'Nincs meg a SCO';
$string['chooseapacket'] = 'SCORM-csomag kiválasztása vagy frissítése';
$string['completed'] = 'Kész';
$string['completionscorerequired'] = 'Kötelező minimum pontszám';
$string['completionstatus_completed'] = 'Teljesítve';
$string['completionstatus_failed'] = 'Sikertelen';
$string['completionstatus_passed'] = 'Sikeres';
$string['completionstatusrequired'] = 'Elvárt állapot';
$string['confirmloosetracks'] = 'FIGYELEM: A csomagot módosították. Ha megváltozott a csomag szerkezete, egyes felhasználói nyomkövetések elveszhetnek a frissítés során.';
$string['contents'] = 'Tartalom';
$string['coursepacket'] = 'Kurzuscsomag';
$string['coursestruct'] = 'Kurzusszerkezet';
$string['currentwindow'] = 'Ez az ablak';
$string['datadir'] = 'A fájlrendszer hibája: nem lehet létrehozni a kurzusadatok könyvtárát';
$string['defaultdisplaysettings'] = 'Megjelenítési alapbeállítások';
$string['defaultgradesettings'] = 'Pontozási alapbeállítások';
$string['defaultothersettings'] = 'Egyéb alapbeállítások';
$string['deleteallattempts'] = 'Összes SCORM-próbálkozás törlése';
$string['deleteattemptcheck'] = 'Biztosan végérvényesen törli a próbálkozásokat?';
$string['deleteuserattemptcheck'] = 'Biztosan törölni kíván minden próbálkozást?';
$string['details'] = 'SCO nyomon követésének részletei';
$string['directories'] = 'Könyvtárkapcsolatok megjelenítése';
$string['disabled'] = 'Kikapcsolva';
$string['display'] = 'Csomag megjelenítése';
$string['displayattemptstatus'] = 'Próbálkozás állapotának megjelenítése';
$string['displayattemptstatus_help'] = 'A próbálkozási állapot megjelenítésével szabályozható, hogy egy tanuló SCORM-próbálkozásainak az állapota megjelenjen-e a SCORM leíró oldalán.
Az állapot megjeleníti a próbálkozásokat, a pontszámokat és az osztályozónaplóba rögzített osztályzatot.';
$string['displayattemptstatusdesc'] = 'Ezzel állítja be a próbálkozás állapotának megjelenítéséhez az alapértéket.';
$string['displaycoursestructure'] = 'Kurzusstruktúra megjelenítése a belépési oldalon';
$string['displaycoursestructure_help'] = 'A kurzusszerkezet megjelenítésével szabályozható, hogy a SCORM-tartalomjegyzék látsszon-e a SCORM leíró oldalán.';
$string['displaycoursestructuredesc'] = 'Ezzel állítja be a belépési oldalon a kurzusszerkezet megjelenítéséhez az alapértéket.';
$string['displaydesc'] = 'Ezzel állítja be, hogy egy tevékenységhez a csomag megjelenjen-e.';
$string['displaysettings'] = 'Megjelenítési beállítások';
$string['domxml'] = 'DOMXML külső könyvtár';
$string['duedate'] = 'Határidő';
$string['element'] = 'Elem';
$string['elementdefinition'] = 'Elem meghatározása';
$string['enter'] = 'Belépés';
$string['entercourse'] = 'Belépés a kurzusba';
$string['errorlogs'] = 'Hibanapló';
$string['everyday'] = 'Naponta';
$string['everytime'] = 'Amikor használatos';
$string['exceededmaxattempts'] = 'Elérte a próbálkozások maximális számát.';
$string['exit'] = 'Kilépés a kurzusból';
$string['exitactivity'] = 'Kilépés a tevékenységből';
$string['expired'] = 'Ez a tevékenység {$a} időpontban lezárult és már nem érhető el.';
$string['external'] = 'Külső csomagok időzítésének frissítése';
$string['failed'] = 'Nem sikerült';
$string['finishscorm'] = 'Ha végzett a tananyag megtekintésével, {$a}';
$string['finishscormlinkname'] = 'ide kattintva térjen vissza a kurzusoldalra.';
$string['firstaccess'] = 'Első hozzáférés';
$string['firstattempt'] = 'Első próbálkozás';
$string['forcecompleted'] = 'Befejezés előírása';
$string['forcecompleted_help'] = 'Befejezés előírása esetén az adott próbálkozás kötelezően "befejezett" állapotba kerül cmi.core.score.raw esetén, s mint ilyen, csak SCORM 1.2 csomagok esetén releváns.
Ez akkor hasznos, ha a SCORM-csomag ellenőrző vagy böngésző üzemmódban helytelenül kezeli az újrapróbálkozást, vagy más okból hibásan állítja be a befejezés állapotát.';
$string['forcecompleteddesc'] = 'Ezzel állítja be a befejezés előírásához az alapértéket.';
$string['forcejavascript'] = 'JavaScript bekapcsolásának előírása';
$string['forcejavascript_desc'] = 'Bekapcsolása esetén (ajánlott!) megakadályozza SCORM-objektumok elérését, ha a felhasználó böngészőjében a JavaScript nem használható/ki van kapcsolva. Ilyenkor a felhasználó megtekintheti a SCORM-ot, de az alkalmazással való kommunikáció nem fog működni és az osztályzatokkal kapcsolatos információk mentésére sem kerül sor';
$string['forcejavascriptmessage'] = 'Az objektum megtekintéséhez böngészőjében kapcsolja be a JavaScript használatát, majd próbálja meg újra.';
$string['forcenewattempt'] = 'Új próbálkozás előírása';
$string['forcenewattempt_help'] = 'Új próbálkozás előírása esetén a SCORM-csomag minden egyes elérése egy új próbálkozásnak számít.';
$string['forcenewattemptdesc'] = 'Ezzel állítja be a új próbálkozás előírásához az alapértéket.';
$string['found'] = 'Tananyagleírás megvan';
$string['frameheight'] = 'Ezzel állítja be a keret vagy ablak alapmagasságát.';
$string['framewidth'] = 'Ezzel állítja be a keret vagy ablak alapszélességét.';
$string['fullscreen'] = 'Teljes képernyő kitöltése';
$string['general'] = 'Általános adatok';
$string['gradeaverage'] = 'Átlagpont';
$string['gradeforattempt'] = 'Próbálkozásra adott pont';
$string['gradehighest'] = 'Legmagasabb pont';
$string['grademethod'] = 'Pontozási módszer';
$string['grademethod_help'] = 'A pontozási módszer szabja meg, miként állapítja meg a tevékenységhez kapcsolódó egyetlen próbálkozásra adott pontot.
4 pontozási módszer létezik:
* Tanulási objektumok - Jelzi a tevékenység során teljesített tanulási objektumok számát
* Legmagasabb pont - A tanulók által az összes teljesített tanulási objektumra kapott legmagasabb pont
* Átlagpont - Az összes pontszám átlaga
* Összegzett pont - Az összes pontszám összege';
$string['grademethoddesc'] = 'Ezzel állítja be egy tevékenység alapvető pontozási módszerét.';
$string['gradereported'] = 'Jelentett pontszám';
$string['gradescoes'] = 'Tudásegységek';
$string['gradesettings'] = 'Pontozási beállítások';
$string['gradesum'] = 'Összes pont';
$string['height'] = 'Magasság';
$string['hidden'] = 'Rejtve';
$string['hidebrowse'] = 'Előzetes megtekintés kikapcsolása';
$string['hidebrowse_help'] = 'Ha ez a lehetőség Igen-re van beállítva, az Előnézet gomb a SCORM/AICC csomag tevékenységének nézetéből rejtve marad.
A tanuló választhatja a tevékenység előnézeti (böngésző módban) való megtekintését vagy próbálkozhat vele normál módban.
Amikor egy tanulási objektumot előnézet (böngésző) módban sajátít el, erre az ikon utal.';
$string['hidebrowsedesc'] = 'Ezzel állítja be, hogy az előzetes megtekintés alaphelyzetben bekapcsolt vagy kikapcsolt állapotban legyen-e.';
$string['hideexit'] = 'Kilépő ugrópont elrejtése';
$string['hidenav'] = 'Navigációs gombok elrejtése';
$string['hidenavdesc'] = 'Ezzel állítja be, hogy a navigációs gombok alaphelyzetben látsszanak-e, vagy rejtve legyenek.';
$string['hidereview'] = 'Ellenőrző gomb elrejtése';
$string['hidetoc'] = 'Kurzusszerkezet megjelenítése a lejátszóban';
$string['hidetoc_help'] = 'Ezzel állítja be, hogy a tartalomjegyzék miként jelenjen meg a SCORM-lejátszóban';
$string['hidetocdesc'] = 'Ezzel állítja be, hogy a kurzusszerkezet (tartalomjegyzék) alaphelyzetben látsszon, avagy rejtve legyen.';
$string['highestattempt'] = 'Legjobb próbálkozás';
$string['identifier'] = 'Kérdésazonosító';
$string['incomplete'] = 'Nem teljes';
$string['info'] = 'Infó';
$string['interactions'] = 'Interakciók';
$string['interactionscorrectcount'] = 'A kérdésre adott helyes válaszok száma';
$string['interactionsid'] = 'Elemazonosító';
$string['interactionslatency'] = 'A tanuló válaszadási lehetőségének megnyílása és az első válasz között eltelt idő';
$string['interactionslearnerresponse'] = 'Tanuló válasza';
$string['interactionspattern'] = 'Helyes válasz mintája';
$string['interactionsresponse'] = 'Tanulói válasz';
$string['interactionsresult'] = 'A tanulói válaszon és a helyes eredményen alapuló eredmény';
$string['interactionsscoremax'] = 'Nyers pontszám maximális értéke a tartományban';
$string['interactionsscoremin'] = 'Nyers pontszám minimális értéke a tartományban';
$string['interactionsscoreraw'] = 'A min. és max. értékkel behatárolt tartományra vetített tanulói teljesítményt tükröző szám';
$string['interactionssuspenddata'] = 'Hely biztosítása a tanulói bekapcsolódások közötti adattároláshoz és -előhíváshoz';
$string['interactionstime'] = 'A próbálkozás megkezdésének időpontja';
$string['interactionstype'] = 'Kérdésfajta';
$string['interactionsweight'] = 'Az elemhez rendelt súly';
$string['invalidactivity'] = 'Hibás SCORM-tevékenység';
$string['invalidhacpsession'] = 'Érvénytelen HACP-folyamat';
$string['invalidmanifestresource'] = 'FIGYELEM: az alábbi tananyagok szerepelnek kimutatásában, de nem találhatók';
$string['invalidurl'] = 'Érvénytelen URL-t adott meg';
$string['last'] = 'Utolsó hozzáférés időpontja';
$string['lastaccess'] = 'Utolsó hozzáférés';
$string['lastattempt'] = 'Utolsó befejezett próbálkozás';
$string['lastattemptlock'] = 'Lezárás az utolsó próbálkozás után';
$string['lastattemptlock_help'] = 'Ezzel bekapcsolja a SCORM-lejátszó lezárását, ha a tanuló a rendelkezésére álló összes próbálkozást kihasználta.
A tanuló továbbra is ellátogathat a kurzust leíró oldalra és (ha be van kapcsolva) megtekintheti a próbálkozások állapotára vonatkozó információkat, de nem választhatja az "Enter" gombot a lejátszó elindítására.';
$string['lastattemptlockdesc'] = 'Ezzel állítja be az utolsó próbálkozás utáni lezárás alapértékét.';
$string['location'] = 'Helysáv megjelenítése';
$string['max'] = 'Max. pontszám';
$string['maximumattempts'] = 'Próbálkozások száma';
$string['maximumattempts_help'] = 'Itt adhatja meg a próbálkozások megengedett számát.
Csak SCORM 1.2 és AICC csomaggal működik. A SCORM 2004 a próbálkozások maximális számának megadására saját eljárást használ.';
$string['maximumattemptsdesc'] = 'Ezzel állítja be egy tevékenység próbálkozásainak alapértelmezett maximális számát.';
$string['maximumgradedesc'] = 'Ezzel állítja be egy tevékenység pontjainak alapértelmezett maximális számát.';
$string['menubar'] = 'Menüsáv megjelenítése';
$string['min'] = 'Min. pontszám';
$string['missing_attribute'] = 'Hiányzó {$a->attr} attribútum a(z) {$a->tag} címkében';
$string['missing_tag'] = 'Hiányzó {$a->tag} címke';
$string['missingparam'] = 'Egy paraméter hiányzik vagy hibás';
$string['mode'] = 'Leggyakoribb';
$string['modulename'] = 'SCORM-csomag';
$string['modulename_help'] = 'A SCORM és az AICC olyan specifikációk gyűjteménye, amelyek nyomán webes tananyagok válnak elérhetővé, egymással együtt használhatókká és újrefelhasználhatókká. A SCORM/AICC modullal SCORM/AICC csomagokat illeszthet a kurzusba.';
$string['modulenameplural'] = 'SCORM/AICC csomagok';
$string['navigation'] = 'Navigáció';
$string['newattempt'] = 'Új próbálkozás elkezdése';
$string['next'] = 'Tovább';
$string['no_attributes'] = 'A(z) {$a->tag} címkének attribútumokkal kell rendelkezni';
$string['no_children'] = 'A(z) {$a->tag} címkének alcímkékkel kell rendelkezni';
$string['noactivity'] = 'Nincs jelentenivaló';
$string['noattemptsallowed'] = 'Engedélyezett próbálkozások száma';
$string['noattemptsmade'] = 'Próbálkozásainak száma';
$string['nolimit'] = 'Korlátlan számú próbálkozás';
$string['nomanifest'] = 'A tananyagleíró állomány nem található';
$string['noprerequisites'] = 'Nem teljesített elegendő előfeltételt ezen tanulási objektum felvételéhez';
$string['noreports'] = 'Nincs megjeleníthető jelentés';
$string['normal'] = 'Szokásos';
$string['noscriptnoscorm'] = 'Böngészője nem támogatja a javascript használatát, vagy annak támogatása ki van kapcsolva. A SCORM-csomag lejátszásával vagy az adatok mentésével gondok lehetnek.';
$string['not_corr_type'] = 'A(z) {$a->tag} címke típusa nem egyezik';
$string['notattempted'] = 'Nem oldották meg';
$string['notopenyet'] = 'A tevékenység {$a} időpontig nem érhető el.';
$string['objectives'] = 'Célok';
$string['optallstudents'] = 'minden felhasználó';
$string['optattemptsonly'] = 'csak a próbálkozó felhasználók';
$string['options'] = 'Lehetőségek (egyes böngészők nem engedélyezik)';
$string['optionsadv'] = 'Lehetőségek (részletes)';
$string['optionsadv_desc'] = 'Bejelölése esetén az ablakhoz kapcsolódó lehetőségek az űrlapon részletes lehetőségekként lesznek beállítva';
$string['optnoattemptsonly'] = 'csak a nem próbálkozó felhasználók';
$string['organization'] = 'Szervezet';
$string['organizations'] = 'Szervezetek';
$string['othersettings'] = 'Egyéb beállítások';
$string['othertracks'] = 'Egyéb útvonalak';
$string['package'] = 'Csomagállomány';
$string['package_help'] = 'A csomag olyan zip (vagy pif) kiterjesztésű állomány, amely érvényes AICC- vagy SCORM-kurzusdefiníciós állományokat tartalmaz.';
$string['packagedir'] = 'Fájlrendszerbeli hiba: nem lehet létrehozni a csomag könyvtárát';
$string['packagefile'] = 'Nincs megadva csomagállomány';
$string['packageurl'] = 'URL';
$string['packageurl_help'] = 'Ezzel a beállítással URL-t adhat meg a SCORM-csomaghoz egy állomány állományválasztóval való kiválasztása helyett.';
$string['page-mod-scorm-x'] = 'Bármely SCORM-modul oldala';
$string['pagesize'] = 'Oldal mérete';
$string['passed'] = 'Sikerült';
$string['php5'] = 'PHP 5 (DOMXML eredeti könyvtára)';
$string['pluginadministration'] = 'SCORM/AICC kezelése';
$string['pluginname'] = 'SCORM-csomag';
$string['popup'] = 'Új ablak';
$string['popupmenu'] = 'Lenyíló menüben';
$string['popupopen'] = 'Egy csomag megnyitása új ablakban';
$string['popupsblocked'] = 'Az előugró ablakok tiltva vannak, ezért a SCORM-modul nem játszható le. Újrakezdés előtt ellenőrizze böngészője beállításait.';
$string['position_error'] = 'A(z) {$a->tag} címke nem lehet a(z) {$a->parent} címke részeleme';
$string['preferencespage'] = 'Beállítások csak ehhez az oldalhoz';
$string['preferencesuser'] = 'Beállítások ehhez a jelentéshez';
$string['prev'] = 'Előző';
$string['raw'] = 'Nyers pontszám';
$string['regular'] = 'Szabványos tananyagleírás';
$string['report'] = 'Jelentés';
$string['reportcountallattempts'] = '{$a->nbattempts} próbálkozás {$a->nbusers} felhasználó esetén {$a->nbresults} eredmény közül';
$string['reportcountattempts'] = '{$a->nbresults} eredmény ({$a->nbusers} felhasználó)';
$string['reports'] = 'Jelentések';
$string['resizable'] = 'Ablakméretezés engedélyezése';
$string['result'] = 'Eredmény';
$string['results'] = 'Eredmények';
$string['review'] = 'Ellenőrzés';
$string['reviewmode'] = 'Ellenőrző üzemmód';
$string['scoes'] = 'Tudásegységek';
$string['score'] = 'Pontszám';
$string['scorm:deleteownresponses'] = 'Saját próbálkozások törlése';
$string['scorm:deleteresponses'] = 'SCORM-próbálkozások törlése';
$string['scorm:savetrack'] = 'Nyomkövetések mentése';
$string['scorm:skipview'] = 'Áttekintés kihagyása';
$string['scorm:viewreport'] = 'Jelentések megtekintése';
$string['scorm:viewscores'] = 'Pontszámok megtekintése';
$string['scormclose'] = 'Eddig';
$string['scormcourse'] = 'SCORM-kurzus';
$string['scormloggingoff'] = 'API naplózása kikapcsolva';
$string['scormloggingon'] = 'API naplózása bekapcsolva';
$string['scormopen'] = 'Nyitva';
$string['scormresponsedeleted'] = 'Törölt felhasználói próbálkozások';
$string['scormtype'] = 'Típus';
$string['scormtype_help'] = 'Ez szabja meg, hogy kerüljön a csomag a kurzusba. Legfeljebb 4 lehetőség közül választhat:
* Feltöltött csomag - Lehetővé teszi SCORM-csomag kiválasztását az állományválasztón keresztül
* Külső SCORM-jegyzékfájl - Lehetővé teszi imsmanifest.xml URL megadását. Megjegyzés: ha az URL-nek az Ön portáljáétól eltérő a doménneve, akkor jobb megoldás a "Letöltött csomag", mert ellenkező esetben nem kerül sor a pontok mentésére.
* Letöltött csomag - Lehetővé teszi csomag URL-jének megadását. A csomagot kibontja és helyben elmenti, a külső SCORM-csomag frissítésekor pedig frissíti.
* Helyi IMS-tartalom adattára - Lehetővé teszi csomag kiválasztását egy IMS-adattárból
* Külső AICC URL-je - ez az URL egy egyedi AICC-tevékenység elindításához való URL. Ez esetben egy látszólagos csomag jön létre hozzá.';
$string['scrollbars'] = 'Ablakgörgetés engedélyezése';
$string['selectall'] = 'Az összes kijelölése';
$string['selectnone'] = 'Összes kijelölés törlése';
$string['show'] = 'Megjelenítés';
$string['sided'] = 'Oldalra';
$string['skipview'] = 'A tanuló kihagyja a tartalmi struktúra oldalát';
$string['skipview_help'] = 'Ha csak egy tanulási objektumot tartalmazó csomagot ad a tananyaghoz, beállíthatja a tartalmi szerkezet oldalának automatikus átugrását, ha a felhasználók a kurzusoldalon a SCORM-tevékenyégre kattintanak.
Választható beállítások:
\* **|Soha** ne ugorja át a tartalmi szerkezet oldalát
\* **|Első eléréskor** csakis az első megtekintéskor ugorja át a tartalmi szerkezet oldalát
\* **|Mindig** ugorja át a tartalmi szerkezet oldalát';
$string['skipviewdesc'] = 'Ezzel állítja be, hogy egy oldalon mikor maradjon ki a tartalomszerkezet';
$string['slashargs'] = 'VIGYÁZAT: a portálon a perjeles argumentumok ki vannak kapcsolva és az objektumok viselkedése szokatlan lehet!';
$string['stagesize'] = 'Keret/ablak mérete';
$string['stagesize_help'] = 'Ezen két beállítás határozza meg a tanulási objektum keretének/ablakának a magasságát és szélességét.';
$string['started'] = 'Kezdés ideje';
$string['status'] = 'Állapot';
$string['statusbar'] = 'Állapotsor megjelenítése';
$string['student_response'] = 'Tanuló válasza';
$string['subplugintype_scormreport'] = 'Jelentés';
$string['subplugintype_scormreport_plural'] = 'Jelentések';
$string['suspended'] = 'Felfüggesztve';
$string['syntax'] = 'Szintaktikus hiba';
$string['tag_error'] = 'Ismeretlen címke ({$a->tag}) ezzel a tartalommal: {$a->value}';
$string['time'] = 'Idő';
$string['timerestrict'] = 'Válaszadás korlátozása ezen időtartamra';
$string['title'] = 'Cím';
$string['toc'] = 'Tartalomjegyzék';
$string['too_many_attributes'] = 'A(z) {$a->tag} címkének túl sok az attribútuma';
$string['too_many_children'] = 'A(z) {$a->tag} címkének túl sok az alcímkéje';
$string['toolbar'] = 'Eszköztár megjelenítése';
$string['totaltime'] = 'Idő';
$string['trackingloose'] = 'FIGYELEM: Ezen Scorm-csomag követési adatai elvesznek!';
$string['type'] = 'Típus';
$string['typeaiccurl'] = 'Külső AICC URL-je';
$string['typeexternal'] = 'Külső SCORM-jegyzékfájl';
$string['typeimsrepository'] = 'Helyi IMS tartalomtára';
$string['typelocal'] = 'Feltöltött csomag';
$string['typelocalsync'] = 'Letöltött csomag';
$string['unziperror'] = 'Hiba történt kicsomagolás közben';
$string['updatefreq'] = 'Automatikus frissítés gyakorisága';
$string['updatefreq_help'] = 'Ezzel a külső csomag automatikusan letölthető és frissíthető.';
$string['updatefreqdesc'] = 'Ezzel állítja be egy tevékenység alapértelmezett automatikus frissítését.';
$string['validateascorm'] = 'Scorm-csomag érvényesítése';
$string['validation'] = 'Érvényesítés eredménye';
$string['validationtype'] = 'Ez a preferencia beállítja a Scorm tananyagleírásának érvényesítéséhez használt DOMXML-könyvtárat. Ha bizonytalan, hagyja meg a kiválasztást.';
$string['value'] = 'Érték';
$string['versionwarning'] = 'A tananyagleírás régebbi az 1.3 változatnál, figyelmeztetés a {$a->tag} címkénél';
$string['viewallreports'] = '{$a} próbálkozás jelentéseinek megtekintése';
$string['viewalluserreports'] = '{$a} felhasználó jelentéseinek megtekintése';
$string['whatgrade'] = 'Próbálkozások pontozása';
$string['whatgrade_help'] = 'Ha többszöri próbálkozást engedélyez, kiválaszthatja, hogy a legmagasabb, az átlag, az első vagy az utolsó próbálkozás kerüljön-e az osztályozónaplóba.
Többszöri próbálkozás kezelése
* Új próbálkozás a tartalomszerkezet oldalán a Belépés gomb fölötti jelölőnégyzettel indítható, így csak akkor engedélyezze azon oldal elérését, ha többszöri próbálkozásra akar lehetőséget adni.
* Nem minden SCORM.csomag kezeli az új próbálkozásokat megfelelően. Ha logikailag nem úgy épül föl, lehetővé teheti adott próbálkozás felülírását akkor is, ha az "kész van" vagy "sikerült".
* A "Teljesítés előírása", az "Új próbálkozás előírása" és a "Lezárás utolsó próbálkozás után" beállításával további lehetőségeket használhat ki többszöri próbálkozások esetén.';
$string['whatgradedesc'] = 'Ezzel állítja be a próbálkozások alapértelmezett pontozását.';
$string['width'] = 'Szélesség';
$string['window'] = 'Ablak';
