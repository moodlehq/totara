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
 * Strings for component 'chat', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['ajax'] = 'Ajax-változat';
$string['autoscroll'] = 'Automatikus görgetés';
$string['beep'] = 'hangjelzés';
$string['cantlogin'] = 'Nem lehetett bejelentkezni a csevegőszobába!!';
$string['chat:chat'] = 'Belépés egy csevegőszobába';
$string['chat:deletelog'] = 'Csevegésnaplók törlése';
$string['chat:exportparticipatedsession'] = 'Csevegéseinek exportálása';
$string['chat:exportsession'] = 'Bármely csevegés exportálása';
$string['chat:readlog'] = 'Csevegésnaplók elolvasása';
$string['chat:talk'] = 'Beszélgetés csevegéssel';
$string['chatintro'] = 'Bevezető szöveg';
$string['chatname'] = 'A csevegőszoba neve';
$string['chatreport'] = 'Csevegések';
$string['chattime'] = 'A következő csevegés időpontja';
$string['configmethod'] = 'Ajax alapú szokásos csevegés során a kliensprogramok rendszeresen a szerverhez fordulnak frissítésért. Semmilyen beállítást nem igényel és mindenhol működik, de sok csevegő esetén jelentősen megterheli a szervert. Szerverdémon használata során a unix héjszintű elérésére van szükség, az eredmény viszont egy gyors és skálázható csevegési környezet.';
$string['confignormalupdatemode'] = 'A csevegőszoba frissítéseit megfelelően támogatja a HTTP 1.1 Keep-Alive funkciója, ennek ellenére meglehetősen leterheli a szervert. A frissítések felhasználókhoz való eljuttatására alkalmasabb módszer a Stream használata. A Stream sokkal hatékonyabb (hasonló a chatd módszerhez), de előfordulhat, hogy használatát szervere nem támogatja.';
$string['configoldping'] = 'Mennyi ideig tartó hallgatás után kell egy felhasználót kilépettnek tekinteni (másodpercben)? Ez csak egy felső határ, mert a lekapcsolódás gyorsan érzékelhető. Alacsonyabb értékek jobban megterhelik a szervert. Ha a szokásos módszert használja, soha ne állítsa ezt az értéket alacsonyabbra, mint a chat_refresh_room idejének kétszerese.';
$string['configrefreshroom'] = 'Milyen gyakran legyen frissítve a csevegőszoba (másodpercben)? Alacsony értékre állítva a csevegőszoba gyorsabbnak látszik, azonban nagyobb terhelést jelenthet a szervernek, ha egyszerre sokan csevegnek. Ha <em>Stream</em> frissítést használ, kiválaszthat egy magasabb frissítési gyakoriságot - próbálkozzék 2-vel.';
$string['configrefreshuserlist'] = 'Milyen gyakran legyen frissítve a felhasználók listája (mp-ben)?';
$string['configserverhost'] = 'A szerverdémont tartalmazó számítógép gazdaneve';
$string['configserverip'] = 'A fenti gazdanévnek megfelelő numerikus IP-cím';
$string['configservermax'] = 'Csevegők maximálisan megengedett száma';
$string['configserverport'] = 'A szerveren a démonnal használandó port';
$string['currentchats'] = 'Folyamatban lévő csevegések';
$string['currentusers'] = 'Mostani felhasználók';
$string['deletesession'] = 'Csevegés törlése';
$string['deletesessionsure'] = 'Biztosan törölni akarja ezt a csevegést?';
$string['donotusechattime'] = 'Ne jelenjen meg a csevegések ideje';
$string['enterchat'] = 'Kattintson ide a csevegésbe való bekapcsolódáshoz';
$string['errornousers'] = 'Nincsenek felhasználók!';
$string['explaingeneralconfig'] = 'Ezek a beállítások <strong>mindig</strong>  érvényesek';
$string['explainmethoddaemon'] = 'Ezek a beállítások csak akkor számítanak, ha a chat_method számára "csevegő szerverdémon"-t választott';
$string['explainmethodnormal'] = 'Ezek a beállítások csak akkor számítanak, ha a chat_method számára "Szokásos módszer"-t választott';
$string['generalconfig'] = 'Általános beállítás';
$string['idle'] = 'Tétlen';
$string['inputarea'] = 'Adatbevitel területe';
$string['invalidid'] = 'Nem található a csevegőszoba!';
$string['list_all_sessions'] = 'Az összes kurzusrész felsorolása';
$string['list_complete_sessions'] = 'Csak a befejezett kurzusrészek felsorolása';
$string['listing_all_sessions'] = 'Az összes kurzusrész felsorolása folyamatban';
$string['messagebeepseveryone'] = '{$a} mindenkit csönget!';
$string['messagebeepsyou'] = '{$a} most csöngetett Önnek!';
$string['messageenter'] = '{$a} most lépett be a csevegésbe';
$string['messageexit'] = '{$a} most lépett ki a csevegésből';
$string['messages'] = 'Üzenetek';
$string['messageyoubeep'] = '{$a} csengetett';
$string['method'] = 'Csevegési módszer';
$string['methodajax'] = 'Ajax módszer';
$string['methoddaemon'] = 'Csevegés szerverdémona';
$string['methodnormal'] = 'Szokásos módszer';
$string['modulename'] = 'Csevegés';
$string['modulename_help'] = 'A csevegési modul segítségével a résztvevők valós időben a wreben keresztül szinkrón beszélgetést folytathatnak. A csevegőszoba egészen más megvitatási lehetőségeket kínál, mint az aszinkrón fórumok.';
$string['modulenameplural'] = 'Csevegések';
$string['neverdeletemessages'] = 'Az üzenetek soha ne törlődjenek';
$string['nextsession'] = 'A következő előjegyzett csevegés';
$string['no_complete_sessions_found'] = 'Nincsenek befejezett kurzusrészek.';
$string['nochat'] = 'Nincs csevegés';
$string['noguests'] = 'A csevegésbe vendégek nem kapcsolódhatnak be';
$string['nomessages'] = 'Még nincs üzenet';
$string['nopermissiontoseethechatlog'] = 'A csevegési naplók megtekintéséhez nincs engedélye.';
$string['normalkeepalive'] = 'KeepAlive';
$string['normalstream'] = 'Stream';
$string['noscheduledsession'] = 'Nincs előjegyzett csevegés';
$string['notallowenter'] = 'Nem léphet be a csevegőszobába!';
$string['notlogged'] = 'Nincs bejelentkezve!';
$string['oldping'] = 'Szétkapcsolás időtúllépés miatt';
$string['page-mod-chat-x'] = 'Bármely csevegő moduloldal';
$string['pastchats'] = 'Korábbi csevegések';
$string['pluginadministration'] = 'Csevegés kezelése';
$string['pluginname'] = 'Csevegés';
$string['refreshroom'] = 'Frissítési idő';
$string['refreshuserlist'] = 'Felhasználói lista frissítése';
$string['removemessages'] = 'Az összes üzenet törlése';
$string['repeatdaily'] = 'Minden nap ugyanakkor';
$string['repeatnone'] = 'Nincs ismétlés - csak a megadott időpont közzététele';
$string['repeattimes'] = 'Csevegések ismétlése';
$string['repeatweekly'] = 'Minden héten ugyanakkor';
$string['saidto'] = 'mondta';
$string['savemessages'] = 'Korábbi csevegések mentése';
$string['seesession'] = 'A csevegés megtekintése';
$string['send'] = 'Elküld';
$string['sending'] = 'Küldés';
$string['serverhost'] = 'Szerver neve';
$string['serverip'] = 'Szerver ip-címe';
$string['servermax'] = 'Max. felhasználó';
$string['serverport'] = 'Szerver portja';
$string['sessions'] = 'Csevegések';
$string['sessionstart'] = 'A csevegés kezdete: {$a}';
$string['strftimemessage'] = '%Ó.%P';
$string['studentseereports'] = 'A korábbi csevegéseket mindenki megtekintheti';
$string['studentseereports_help'] = 'Nem-re állítva csak a mod/chat:readlog képességgel rendelkezők nézhetik meg a csevegési naplókat.';
$string['talk'] = 'Beszéljen';
$string['updatemethod'] = 'Frissítés módszere';
$string['updaterate'] = 'Értékelés frissítése:';
$string['userlist'] = 'Felhasználók felsorolása';
$string['usingchat'] = 'A csevegés használata';
$string['usingchat_help'] = 'A csevegésre használt modul tartalmaz néhány olyan vonást, amely révén a csevegés valamelyest kellemesebbé tehető.

**Emotikonok**
: Bármely érzelmet kifejező kép (emotikon), amelyet a Moodle-ban máshol használhat, itt is begépelhető és megfelelő módon megjeleníthető.
Például, :-) 
**Hivatkozások**
: Az internetes címek automatikusan hivatkozásokká alakulnak át.
**Érzelem kifejezése**
: Érzelem kifejezéséhez használható az "/én" vagy ":" sorkezdet.
Például ha a felhasználó neve Kati és azt gépeli be, hogy
":nevet!" vagy "/én nevetek!", akkor a kijelzés mindenki előtt "Kati nevet!" alakban lesz látható.
**Hangjelzések**
: Ha valakinek a neve mellett lévő "hangjelző" hivatkozásra kattint,
az illetőhöz hangjelzést tud küldeni. Ha egyszerre minden embernek szeretne hangjelzést küldeni egy
csevegés során, gépelje be a "beep all" [hangjelzés mindenkinek] utasítást.
**HTML**
: Ha valamelyest járatos a HTML-ben, kódot illeszthet a szövegbe, mellyel képet szúrhat be,
hangot játszhat le és különféle színű és méretű szövegeket
jeleníthet meg.
';
$string['viewreport'] = 'Korábbi csevegések megtekintése';
