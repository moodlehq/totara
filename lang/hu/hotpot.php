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
 * Strings for component 'hotpot', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   hotpot
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['abandoned'] = 'Felhagyott vele';
$string['activitycloses'] = 'Tevékenység lezárul';
$string['activitygrade'] = 'Tevékenység pontszáma';
$string['activityopens'] = 'Tevékenység elérhetővé válik';
$string['added'] = 'Hozzáadva';
$string['addquizchain'] = 'Tesztsor hozzáadása';
$string['addquizchain_help'] = 'A tesztsor összes tesztját adja hozzá?
**Ne**
: csak egy tesztet ad hozzá a kurzushoz.
**Igen**
: Ha a forrásfájl egy **tesztfájl**, akkor azt a tesztsor kezdeteként kezeli és a benne szereplő összes tesztet azonos beállításokkal hozzáadja a kurzushoz. A tesztsor minden egyes tesztjét a következő tesztre mutató ugróponttal kell ellátni.
Ha a forrásfájl egy **mappa**, akkor a mappában felismert összes tesztet tesztsor formájában azonos beállításokkal hozzáadja a kurzushoz.
Ha a forrásfájl egy **egységfájl**, pl. egy Hot Potatoes tesztsorfájl vagy egy index.html fájl, akkor egy egységfájlban felsorolt összes tesztet tesztsor formájában azonos beállításokkal hozzáadja a kurzushoz.';
$string['allowreview'] = 'Ellenőrzés engedélyezése';
$string['allowreview_help'] = 'Bekapcsolása esetén a tanulók ellenőrizhetik tesztjük megoldását a teszt lezárása után.';
$string['analysisreport'] = 'Tételelemzés';
$string['attemptlimit'] = 'Próbálkozási korlát';
$string['attemptlimit_help'] = 'Azon próbálkozások maximális száma, ahányszor a tanuló az adott HotPot tevékenység esetén próbálkozhat.';
$string['attemptnumber'] = 'Próbálkozás száma';
$string['attempts'] = 'Próbálkozás';
$string['attemptscore'] = 'Próbálkozás pontszáma';
$string['attemptsunlimited'] = 'Korlátlan számú próbálkozás';
$string['average'] = 'Átlag';
$string['averagescore'] = 'Átlagpontszám';
$string['cacherecords'] = 'A HotPot gyorsítótáras bejegyzései';
$string['canrestartquiz'] = 'Eddigi eredményeit mentjük, a(z) "{$a}" megoldásával később újból próbálkozhat.';
$string['canrestartunit'] = 'Eddigi eredményeit mentjük, de ha később újra szeretne próbálkozni, akkor az elejétől kell kezdenie.';
$string['canresumequiz'] = 'Eddigi eredményeit mentjük, a(z) "{$a}" megoldását később folytathatja.';
$string['checks'] = 'Ellenőrzések';
$string['checksomeboxes'] = 'Jelöljön be néhány négyzetet';
$string['clearcache'] = 'A HotPot gyorsítótárának kiürítése';
$string['cleardetails'] = 'A HotPot részleteinek törlése';
$string['clearedcache'] = 'A HotPot gyorsítótárának kiürítése megtörtént';
$string['cleareddetails'] = 'A HotPot részleteinek törlése megtörtént.';
$string['clickreporting'] = 'Kattintásról készített jelentés bekapcsolása';
$string['clickreporting_help'] = 'Bekapcsolása esetén külön rekord tárolja, ha a "Tipp", "Rávezetés" vagy "Ellenőrzés" gombra kattintanak.
Ezzel a tanár igen részletes jelentést kap a teszt kattintásonkénti állapotáról. Ellenkező esetben
a tesztről próbálkozásonként egyetlen rekord készül.';
$string['clicktrailreport'] = 'Kattintson a nyomon követésre';
$string['closed'] = 'A tevékenység lezárult';
$string['clues'] = 'Rávezetések';
$string['completed'] = 'Kész';
$string['configenablecache'] = 'A HotPot tesztek gyorsítótárba helyezésével a tesztek sokkal gyorsabban eljutnak a tanulókhoz.';
$string['configenablecron'] = 'Adja meg időzónája szerint azon órákat, amikor a HotPot cron programkód lefuthat.';
$string['configenablemymoodle'] = 'Ezzel állítja be, hogy szerepeljen-e HotPot a Moodle-om oldalon, vagy sem.';
$string['configenableobfuscate'] = 'Ha a javascript programkódot médialejátszó beillesztéséhez módosítja, nehezebb lesz a médiaállomány nevét és tartalmát kikövetkeztetni.';
$string['configenableswf'] = 'SWFállományok HotPot tevékenységekbe ágyazásának engedélyezése. Bekapcsolása esetén felülírja a filter_mediaplugin_enable_swf beállítását.';
$string['configfile'] = 'Konfigurációs állomány';
$string['configframeheight'] = 'Ha egy teszt keretben jelenik meg,';
$string['configlocation'] = 'A konfigurációs állomány helye';
$string['configlockframe'] = 'Bekapcsolása esetén az esetleges navigációs keretet rögzíti, így azt nem lehet görgetni, átméretezni, és nem lesz szegélye sem.';
$string['configmaxeventlength'] = 'Ha valamely HotPot esetén nyitott és lezárt időhatár is meg van adva, akkor ha a kettő közötti napok különbsége nagyobb az itt megadottnál, a kurzusnaptárba két külön esemény fog bekerülni. Rövidebb időtartamok vagy csak egyetlen idő megadásakor a kurzusnaptárba csak egy esemény fog bekerülni. Ha nincs megadva idő, akkor a naptárban nem jelenik meg esemény.';
$string['configstoredetails'] = 'Bekapcsolása esetén a HotPot-tesztek próbálkozásainak nyers XML-adatai a hotpot_details táblázatba kerülnek. Ennek köszönhetően a későbbi próbálkozások újból osztályozhatóvá válnak a HotPot-teszt pontozási rendszerében bekövetkező változásoknak megfelelően. Nagy portálokon azonban a hotpot_details táblázat mérete igen gyorsan megnőhet.';
$string['confirmdeleteattempts'] = 'Biztosan törli a próbálkozásokat?';
$string['confirmstop'] = 'Biztosan elhagyja ezt az oldalt?';
$string['correct'] = 'Helyes';
$string['couldnotinsertsubmissionform'] = 'A leadási űrlap nem illeszthető be.';
$string['d_index'] = 'Megkülönböztetési index';
$string['delay1'] = '1. kivárás';
$string['delay1_help'] = 'Az első és a második próbálkozás közötti minimális kivárás';
$string['delay1summary'] = 'Az első és a második próbálkozás közötti idő';
$string['delay2'] = '2. kivárás';
$string['delay2_help'] = 'A második próbálkozást követő próbálkozások közötti minimális kivárás';
$string['delay2summary'] = 'A későbbi próbálkozások közötti idő';
$string['delay3'] = '3. kivárás';
$string['delay3_help'] = 'Ez állítja be a teszt befejezése és a megjelenítés vezérlésének Moodle részére való átadása közötti kivárás időtartamát.
**(Másodpercben) megadott idő használata**
: a vezérlés a megadott számú másodperc elteltével kerül vissza a Moodle-hoz.
**Forrás-/sablonállományban lévő beállítás használata**
: a vezérlés a forrásállományban vagy a megjelenítési forma sablonjaiban megadott számú másodperc elteltével kerül vissza a Moodle-hoz.
*Megvárja, amíg a tanuló a Rendben gombra kattint**
: a vezérlés a teszt befejezésekor megjelenő üzenetben szereplő Rendben gombra kattintással kerül vissza a Moodle-hoz.
**Ne folytatódjék automatikusan**
: a vezérlés a teszt befejezésekor nem kerül vissza a Moodle-hoz. A tanuló a tesztoldalról szabadon továbbléphet.
Megjegyzés: a teszteredményeket a Moodle annak befejezésekor vagy abbahagyásakor ezen beállítástól függetlenül haladéktalanul megkapja.';
$string['delay3afterok'] = 'Megvárja, amíg a tanuló a Rendben gombra kattint';
$string['delay3disable'] = 'Ne folytatódjék automatikusan';
$string['delay3specific'] = '(Másodpercben) megadott idő használata';
$string['delay3summary'] = 'Kivárás a teszt végén';
$string['delay3template'] = 'Forrás-/sablonállományban lévő beállítás használata';
$string['deleteallattempts'] = 'Az összes próbálkozás törlése';
$string['deleteattempts'] = 'Próbálkozások törlése';
$string['detailsrecords'] = 'HotPot adatok bejegyzései';
$string['duration'] = 'Időtartam';
$string['enablecache'] = 'A HotPot gyorsítótár bekapcsolása';
$string['enablecron'] = 'A HotPot cron bekapcsolása';
$string['enablemymoodle'] = 'HotPot megjelenítése a Moodle-omon';
$string['enableobfuscate'] = 'A médialejátszóhoz tartozó programkód módosításának engedélyezése';
$string['enableswf'] = 'SWF-állományok HotPot tevékenységekbe ágyazásának engedélyezése';
$string['entry_attempts'] = 'Próbálkozások';
$string['entry_dates'] = 'Dátumok';
$string['entry_grading'] = 'Pontozás';
$string['entry_title'] = 'Az egység neve címként';
$string['entrycm'] = 'Előző tevékenység';
$string['entrycm_help'] = 'Ez a beállítás egy Moodle tevékenységet határoz meg azon minimális pontszámmal együtt, amelyet ezen tesztfelület használata előtt el kell érni.
A tanár kiválaszthat egy tevékenységet vagy választhat az alábbi általános beállítások közül:
* Előző tevékenység ebben a kurzusban
* Előző tevékenység ebben a szakaszban
* Előző HotPot ebben a kurzusban
* Előző HotPot ebben a szakaszban';
$string['entrycmcourse'] = 'Előző tevékenység ebben a kurzusban';
$string['entrycmsection'] = 'Előző tevékenység ebben a kurzusszakaszban';
$string['entrycompletionwarning'] = 'A tevékenység megkezdése előtt tekintse meg ezt: {$a}.';
$string['entrygrade'] = 'Előző tevékenység pontszáma';
$string['entrygradewarning'] = 'A tevékenység megkezdése előtt {$a->entrygrade}% pontot kell elérnie {$a->entryactivity} tevékenység kapcsán. Jelenlegi eredménye {$a->usergrade}%.';
$string['entryhotpotcourse'] = 'Előző HotPot ebben a kurzusban';
$string['entryhotpotsection'] = 'Előző HotPot ebben a kurzuszakaszsban';
$string['entryoptions'] = 'Belépő oldali lehetőségek';
$string['entryoptions_help'] = 'A jelölőnégyzetekkel a HotPot belépő oldalán megjelenő lehetőségeket kapcsolhgatja be vagy ki.
**Az egység neve a cím**
: bejelölése esetén az egység neve lesz a belépő oldal címe.
**Pontozás**
: bejelölése esetén a HotPot pontozási adatai megjelennek a belépő oldalon.
**Dátumok**
: bejelölése esetén a HotPot megnyitási és lezárási időpontjai megjelennek a belépő oldalon.
**Próbálkozások**
: bejelölése esetén a tanuló adott HotPotra vonatkozó korábbi próbálkozásai megjelennek a belépő oldalon. A folytatható próbálkozások mellett jobbra egy Folytatás gomb jelenik meg.';
$string['entrypage'] = 'Belépő oldal megjelenítése';
$string['entrypage_help'] = 'Jelenjen meg egy belépő oldal a tanulók számára, mielőtt nekikezdenek a HotPot tevékenységnek?
**Igen**
: egy belépő oldal jelenik meg a tanulóknak, mielőtt nekikezdenek a HotPot tevékenységnek. Tartalmát a belépő oldali lehetőségek határozzák meg.
**Ne**
: nem jelenik meg belépő oldal a tanulóknak, azonnal nekikezdehetnek a HotPot tevékenységnek.
A tanár számára mindig megjelenik egy belépő oldal, melyről elérheti a jelentéseket és szerkesztheti a tesztoldalakat.';
$string['entrypagehdr'] = 'Belépő oldal';
$string['entrytext'] = 'A belépő oldal szövege';
$string['exit_areyouok'] = 'Itt van még?';
$string['exit_attemptscore'] = 'A próbálkozásra {$a} pontot kapott.';
$string['exit_course'] = 'Kurzus';
$string['exit_course_text'] = 'Visszatérés a fő kurzusoldalra';
$string['exit_encouragement'] = 'Biztatás';
$string['exit_excellent'] = 'Kiváló!';
$string['exit_feedback'] = 'Visszajelzés az oldal elhagyása esetén';
$string['exit_feedback_help'] = 'Itt állíthat be visszajelzést valamely HotPot oldal elhagyása esetére.
**Egység neve címként**
: bejelölése esetén a kilépő oldal címeként az egység neve jelenik meg.
**Biztatás**
: bejelölése esetén valamilyen biztatás jelenik meg a kilépő oldalon. Ennek szövege a HotPot eredménytől függ:
: **> 90%**: Kiváló!
: **> 60%**: Ügyes!
: **> 0%**: Nem rossz.
: **= 0%**: Minden rendben?
**Egységen belüli próbálkozások pontszáma**
: bejelölése esetén az éppen teljesített egységen belüli próbálkozások pontszáma jelenik meg a kilépő oldalon.
**Egységen pontszáma**
: bejelölése esetén a HotPot pontszám jelenik meg a kilépő oldalon.
Emellett az egység legmagasabb pontozási módszere esetén üzenet tájékoztat arról, hogy a legutóbbi próbálkozás az előzővel azonos vagy annál jobb lett-e.';
$string['exit_goodtry'] = 'Nem rossz.';
$string['exit_grades'] = 'Pontok';
$string['exit_grades_text'] = 'Tekintse meg a kurzusban elért eddigi pontjait.';
$string['exit_hotpotgrade'] = 'Erre a tevékenységra {$a} pontot kapott.';
$string['exit_hotpotgrade_average'] = 'Erre a tevékenységre átlagosan eddig {$a} pontot kapott';
$string['exit_hotpotgrade_highest'] = 'Erre a tevékenységre eddig maximálisan {$a} pontot kapott';
$string['exit_hotpotgrade_highest_equal'] = 'A korábbi legjobb eredményével azonosat produkált!';
$string['exit_hotpotgrade_highest_previous'] = 'Erre a tevékenységre korábban maximálisan {$a} pontot kapott';
$string['exit_hotpotgrade_highest_zero'] = 'Erre a tevékenységre meg nem ért el {$a} pontszámnál magasabb eredményt.';
$string['exit_index'] = 'Mutató';
$string['exit_index_text'] = 'Áttérés a tevékenységek mutatójához';
$string['exit_links'] = 'Kilépő oldal ugrópotnjai';
$string['exit_links_help'] = 'Itt állíthat be navigációs ugrópontokat valamely HotPot kilépő oldalához.
**Újrapróbálkozás**
: ha többszörös próbálkozás van beállítva és a tanulónak még van felhasználható lehetősége, megjelenik egy ugrópont a HotPot újbóli megoldásához.
**Mutató**
: bejelölése esetén ugrópont jelenik meg a HotPot tárgymutatójához.
**Kurzus**
: bejelölése esetén ugrópont jelenik meg az adott Moodle-kurzus oldalához.
**Pontok**
: bejelölése esetén ugrópont jelenik meg a Moodle osztályozónaplójához.';
$string['exit_next'] = 'Következő';
$string['exit_next_text'] = 'Próbálkozás a következő tevékenységgel.';
$string['exit_noscore'] = 'A tevékenységet sikeresen tejlesítette!';
$string['exit_retry'] = 'Újrapróbálkozás';
$string['exit_retry_text'] = 'A tevékenység megoldásának újbóli megpróbálása';
$string['exit_welldone'] = 'Ügyes!';
$string['exit_whatnext_0'] = 'Mit szeretne most tenni?';
$string['exit_whatnext_1'] = 'Válassza ki a célállomást!';
$string['exit_whatnext_default'] = 'Válasszon az alábbiak közül:';
$string['exitcm'] = 'Következő tevékenység';
$string['exitcm_help'] = 'Ez a beállítás egy Moodle tevékenységet határoz meg, melyre a tesztfelület használata után kerül sor.
A tanár kiválaszthat egy tevékenységet vagy választhat az alábbi általános beállítások közül:
* Soron következő tevékenység ebben a kurzusban
* Soron következő tevékenység ebben a szakaszban
* Soron következő HotPot ebben a kurzusban
* Soron következő HotPot ebben a szakaszban
Ha a többi oldalelhagyási lehetőség ki van kapcsolva, a tanuló közvetlenül a következő tevékenységre tér át. Ellenkező esetben egy ugrópont jelenik meg, amellyel a következő tevékenységre térhet át, ha elkészült.';
$string['exitcmcourse'] = 'A kurzusban a következő tevékenység';
$string['exitcmsection'] = 'Soron következő tevékenység ebben a kurzusszakaszban';
$string['exitgrade'] = 'Következő tevékenységre adott osztályzat';
$string['exithotpotcourse'] = 'A  kurzusban soron következő HotPot.';
$string['exithotpotsection'] = 'A kurzusszakaszban soron következő HotPot.';
$string['exitoptions'] = 'A kilépő oldalon megjelenő lehetőségek';
$string['exitpage'] = 'Kilépő oldal megjelenítése';
$string['exitpage_help'] = 'Jelenjen meg kilépő oldal a HotPot teszt befejezése után?
**Igen**
: a HotPot teszt befejezése után a tanulók kilépő oldalra kerülnek. Ennek tartalmát a HotPot kilépő oldali visszajelzése és ugrópontjai határozzák meg.
**Ne**
: a tanulók nem kerülnek kilépő oldalra, helyette vagy közvetlenül a következő tevékenységre, vagy a Moodle-kurzus oldalára kerülnek át.';
$string['exitpagehdr'] = 'Kilépő oldal';
$string['exittext'] = 'A kilépő oldalon megjelenő szöveg';
$string['feedbackdiscuss'] = 'A teszt megbeszélése fórum keretében';
$string['feedbackformmail'] = 'Visszajelzés űrlapja';
$string['feedbackmoodleforum'] = 'Moodle-fórum';
$string['feedbackmoodlemessaging'] = 'Moodle-üzenet';
$string['feedbacknone'] = 'Nincs';
$string['feedbacksendmessage'] = 'Üzenet küldése a z oktatónak';
$string['feedbackwebpage'] = 'Weboldal';
$string['firstattempt'] = 'Első próbálkozás';
$string['forceplugins'] = 'Média-segédprogramok használatának előírása';
$string['forceplugins_help'] = 'Bekapcsolása esetén az avi, mpeg, mpg, mp3, mov, wmv stb. médiaállományokat a Moodle-lal
kompatibilis médialejátszók játsszák le. Ellenkező esetben a Moodle nem módosítja a médialejátszók beállításait.';
$string['frameheight'] = 'Keretmagasság';
$string['giveup'] = 'Felad';
$string['grademethod'] = 'Pontozási módszer';
$string['grademethod_help'] = 'Ez a beállítás szabja meg a prbálkozásokon elért eredmény alapján kapott HotPot pontszám kiszámítását.
**Legmagasabb pontszám**
az osztályzat a próbálkozásra kapott legmagasabb pontszámon alapul.
**Átlagpontszám**
az osztályzat a próbálkozások átlagpontszámán alapul.
**Első próbálkozás**
az osztályzat az első próbálkozásra kapott pontszámon alapul.
**Utolsó próbálkozás**
az osztályzat az utolsó próbálkozásra kapott pontszámon alapul.';
$string['gradeweighting'] = 'Osztályozó súlyozás';
$string['gradeweighting_help'] = 'A HotPot-tevékenységre kapott osztályzat a Moodle osztályozónaplójában ehhez a számhoz arányul';
$string['highestscore'] = 'Legmagasabb pontszhám';
$string['hints'] = 'Tippek';
$string['hotpot:addinstance'] = 'Új HotPot-tevékenység hozzáadása';
$string['hotpot:attempt'] = 'Próbálkozás egy HotPot tevékenységgel és az eredmény leadása';
$string['hotpot:deleteallattempts'] = 'HotPot tevékenységgel kapcsolatos bármilyen próbálkozás törlése';
$string['hotpot:deletemyattempts'] = 'HotPot tevékenységgel kapcsolatos saját  próbálkozások törlése';
$string['hotpot:ignoretimelimits'] = 'HotPot tevékenységgel kapcsolatos időkorlátok figyelmen kívül hagyása';
$string['hotpot:manage'] = 'HotPot tevékenységgel kapcsolatos beállítások módosítása';
$string['hotpot:preview'] = 'HotPot tevékenység előnézete';
$string['hotpot:reviewallattempts'] = 'HotPot tevékenységgel kapcsolatos bármilyen próbálkozás megtekintése';
$string['hotpot:reviewmyattempts'] = 'HotPot tevékenységgel kapcsolatos saját próbálkozások megtekintése';
$string['hotpot:view'] = 'Egy HotPot tevékenység kezdőoldalának megtekintése';
$string['hotpotname'] = 'HotPot tevékenység neve';
$string['ignored'] = 'Kihagyva';
$string['inprogress'] = 'Folyamatban';
$string['isgreaterthan'] = 'nagyobb mint';
$string['islessthan'] = 'kisebb mint';
$string['lastaccess'] = 'Utolsó hozzáférés';
$string['lastattempt'] = 'Utolsó próbálkozás';
$string['lockframe'] = 'Keret rögzítése';
$string['maxeventlength'] = 'Egyetlen naptári eseményhez kapcsolható napok maximális száma';
$string['mediafilter_hotpot'] = 'HotPot médiaszűrő';
$string['mediafilter_moodle'] = 'Standard Moodle médiaszűrők';
$string['migratingfiles'] = 'Hot Potatoes tesztállományok átköltöztetése';
$string['missingsourcetype'] = 'A HotPot bejegyzésből hiányzik a forrástípus';
$string['modulename'] = 'HotPot';
$string['modulename_help'] = 'A HotPot modullal a tanár interaktív tananyagokat juttathat el a tanulókhoz a Moodle-on keresztül, és megtekintheti válaszaikat és eredményeiket.
Egy HotPot-tevékenység választható belépő oldalból, egy e-learning gyakorlatból és egy opcionális kilépési oldalból áll. A gyakorlat lehet statikus weboldal vagy interaktív weboldal, amely szöveges, hallható vagy látható utasításokat ad, és rögzíti a tanulók válaszait. A gyakorlatot a tanár szerkesztő programmal hozza létre a számítógépén, majd feltölti a Moodle-ba.
A HotPot-tevékenység az alábbi szerkesztőkkel készült gyakorlatokat tudja kezelni:
* Hot Potatoes (6-os verzió)
* Qedoc
* Xerte
* iSpring
* bármilyen HTML-szerkesztő';
$string['modulenameplural'] = 'HotPot tesztek';
$string['nameadd'] = 'Név';
$string['nameadd_help'] = 'A név lehet tanár által megadott vagy automatikusan előállított név.
**Forrásállományból**
: a név a forrásállományból jön elő.
**Forrásállomány nevéből**
: a név a forrásállomány nevéből áll elő.
**Forrásállomány útvonalából**
: a név a forrásállomány útvonalából áll elő. A perjelek helyén szóköz szerepel.
**Megadott szövegből**
: a név a ftanár által megadott szövegből áll elő.';
$string['nameedit'] = 'Név';
$string['nameedit_help'] = 'A tanulók számára megjelenő szöveg';
$string['navigation'] = 'Navigálás';
$string['navigation_embed'] = 'Beágyazott weboldal';
$string['navigation_frame'] = 'A Moodle navigálási kerete';
$string['navigation_give_up'] = 'Csak egy &quot;Feladás&quot; gomb';
$string['navigation_help'] = 'Itt adja meg a tesztben navigálás mikéntjét:
**Moodle navigációs sáv **
: A Moodle navigációs sávja a teszttel azonos ablakban, az oldal tetején jelenik meg
**Moodle navigációs keret**
: A Moodle navigációs sávja a teszt tetején, külön keretben jelenik meg
**Beágyazott weboldal**
: A Moodle navigációs sávja a teszttel azonos ablakban jelenik meg, a teszt az ablakba van beágyazva
**Eredeti navigációs gombok**
: A teszt a tesztben esetlegesen megadott navigációs gombokkal jelenik meg.
**Egyetlen "Feladom" gomb**
: A teszt az oldal tetején egy "Feladom" gombbal jelenik meg.
**Semmi**
: A teszt navigációs eszközök nélkül jelenik meg. Így ha minden kérdést helyesen válaszoltak meg, a "Jöjjön a következő teszt?" beállítástól függően a Moodle vagy visszatér a kurzusoldalra, vagy megjeleníti a következő tesztet.';
$string['navigation_moodle'] = 'A Moodle szokásos navigációs sávjai (fent és oldalt)';
$string['navigation_none'] = 'Egy sem';
$string['navigation_original'] = 'Eredeti navigációs eszközök';
$string['navigation_topbar'] = 'A Moodle navigációs sávja csak fent (oldalt nincsenek sávok)';
$string['noactivity'] = 'Nincs tevékenység';
$string['nohotpots'] = 'Nem található HotPot';
$string['nomoreattempts'] = 'Ezen tevékenység esetén nincs több próbálkozási lehetősége';
$string['noresponses'] = 'Nincs információ az egyes kérdésekről és válaszokról.';
$string['noreview'] = 'A teszttel kapcsolatos próbálkozások részleteit nem tekintheti meg.';
$string['noreviewafterclose'] = 'A teszt lezárult. A teszttel kapcsolatos próbálkozások részleteit már nem tekintheti meg.';
$string['noreviewbeforeclose'] = 'A teszttel kapcsolatos próbálkozások részleteit {$a} időpontig nem tekintheti meg.';
$string['nosourcefilesettings'] = 'A HotPot hiányolja a forrásfájllal kapcsolatos adatokat.';
$string['notavailable'] = 'A tevékenységbe jelenleg nem kapcsolódhat be.';
$string['outputformat'] = 'Kimeneti forma';
$string['outputformat_best'] = 'legjobb';
$string['outputformat_help'] = 'A megjelenítési forma írja elő, miként jelenjen meg a tartalom a tanulók számára.
Az elérhető megjelenítési formák a forrásfájl típusától függenek. Némelyiknek csak egy megjelenítési formája van, más fáljokhoz több is tartozhat.
A "legjobb" a tanuló böngészője szerinti legjobb forma az adott tartalom megjelenítéséhez.';
$string['outputformat_hp_6_jcloze_html'] = 'JCloze HP6 html';
$string['outputformat_hp_6_jcloze_xml_anctscan'] = 'JCloze HP6 xml-ből: ANCT-Scan';
$string['outputformat_hp_6_jcloze_xml_dropdown'] = 'JCloze HP6 xml-ből lenyíló';
$string['outputformat_hp_6_jcloze_xml_findit_a'] = 'JCloze HP6 xml-ből FindIt (a)';
$string['outputformat_hp_6_jcloze_xml_findit_b'] = 'JCloze HP6 xml-ből FindIt (b)';
$string['outputformat_hp_6_jcloze_xml_jgloss'] = 'JCloze HP6 xml-ből JGloss';
$string['outputformat_hp_6_jcloze_xml_v6'] = 'HP6 xml-ből JCloze';
$string['outputformat_hp_6_jcloze_xml_v6_autoadvance'] = 'HP6 xml-ből JCloze (automatikus továbblépéssel)';
$string['outputformat_hp_6_jcross_html'] = 'html-ből JCross (v6)';
$string['outputformat_hp_6_jcross_xml_v6'] = 'xml-ből JCross (v6)';
$string['outputformat_hp_6_jmatch_html'] = 'html-ből JMatch (v6)';
$string['outputformat_hp_6_jmatch_xml_flashcard'] = 'xml-ből JMatch (flashcard)';
$string['outputformat_hp_6_jmatch_xml_jmemori'] = 'xml-ből JMemori';
$string['outputformat_hp_6_jmatch_xml_v6'] = 'xml-ből JMatch  (v6)';
$string['outputformat_hp_6_jmatch_xml_v6_plus'] = 'xml-ből JMatch  (v6+)';
$string['outputformat_hp_6_jmix_html'] = 'html-ből JMix (v6)';
$string['outputformat_hp_6_jmix_xml_v6'] = 'xml-ből JMix (v6)';
$string['outputformat_hp_6_jmix_xml_v6_plus'] = 'xml-ből JMix (v6+)';
$string['outputformat_hp_6_jmix_xml_v6_plus_deluxe'] = 'xml-ből JMix (v6+ előtaggal, utótaggal, eltérítővel))';
$string['outputformat_hp_6_jmix_xml_v6_plus_keypress'] = 'xml-ből JMix (v6+ gombnyomással)';
$string['outputformat_hp_6_jquiz_html'] = 'html-ből  JQuiz (v6)';
$string['outputformat_hp_6_jquiz_xml_v6'] = 'xml-ből  JQuiz (v6)';
$string['outputformat_hp_6_jquiz_xml_v6_autoadvance'] = 'xml-ből  JQuiz (v6) (automatikus továbblépéssel)';
$string['outputformat_hp_6_jquiz_xml_v6_exam'] = 'xml-ből  JQuiz (v6) (Vizsga)';
$string['outputformat_hp_6_rhubarb_html'] = 'html-ből Rhubarb (v6)';
$string['outputformat_hp_6_rhubarb_xml'] = 'xml-ből Rhubarb (v6)';
$string['outputformat_hp_6_sequitur_html'] = 'html-ből Sequitur (v6)';
$string['outputformat_hp_6_sequitur_html_incremental'] = 'html-ből Sequitur (v6), növekményes pontozással';
$string['outputformat_hp_6_sequitur_xml'] = 'xml-ből Sequitur (v6)';
$string['outputformat_hp_6_sequitur_xml_incremental'] = 'xml-l-ből Sequitur (v6), növekményes pontozással';
$string['outputformat_html_ispring'] = 'iSpring HTML';
$string['outputformat_html_xerte'] = 'Xerte HTML';
$string['outputformat_html_xhtml'] = 'Standard HTML';
$string['outputformat_qedoc'] = 'Qedoc-állomány';
$string['overviewreport'] = 'Áttekintés';
$string['penalties'] = 'Büntetések';
$string['percent'] = 'Százalék';
$string['pluginadministration'] = 'HotPot-adminisztráció';
$string['pluginname'] = 'Hot Potatoes modul';
$string['pressoktocontinue'] = 'Továbblépéshez nyomja meg a Rendben gombot, a Mégse lenyomásakor az adott oldalon marad.';
$string['questionshort'] = 'K-{$a}';
$string['quizname_help'] = 'a Teszt nevéhez tartozó súgó';
$string['quizzes'] = 'Tesztek';
$string['removegradeitem'] = 'Pontozási tétel törlése';
$string['removegradeitem_help'] = 'Törlendő a tevékenységhez tartozó pontozási tétel?
**Nem**
: a tevékenységhez tartozó pontozási tétel megőrződik az osztályozónaplóban.
**Igen**
: Ha az adott HotPot esetén a maximális pont vagy a súlyozás nullára van állítva, akkor a tevékenységhez tartozó pontozási tétel törlődik az osztályozónaplóból.
.';
$string['responsesreport'] = 'Válaszok';
$string['score'] = 'Pontszám';
$string['scoresreport'] = 'Pontok';
$string['selectattempts'] = 'Próbálkozások kiválasztása';
$string['showerrormessage'] = 'HotPot hiba: {$a}';
$string['sourcefile'] = 'Forrásfájl neve';
$string['sourcefile_help'] = 'Ez a beállítás szabja meg, melyik állományban van a tanulók számára megjelenítendő tartalom.
A forrásállomány rendszerint a Moodle-on kívül készül, mely aztán felkerül az adott Moodle-kurzus állományai közé.
Ez lehet html-állomány vagy másmilyen, szerkesztőprogrammal (pl. Hot Potatoes vagy Qedoc) készített állomány.
A forrásállomány megadható a Moodle-kurzus állományaihozvezetú mappa és útvonal megjelölésével, vagy lehet egy http:// vagy https:// kezdetű URL.
Qedoc esetén a forrásállomány a Qedoc-szerverre feltöltött Qedoc-modulk URL-je.
* pl. http://www.qedoc.net/library/ABCDE_123.zip
* A Qedoc-modulok feltöltéséről l.: \[Qedoc documentation: Uploading\_modules\](http://www.qedoc.org/en/index.php?title=Uploading\_modules)';
$string['sourcefilenotfound'] = 'A forrásfájl nem található (vagy üres): {$a}';
$string['status'] = 'Állapot';
$string['stopbutton'] = 'Leállító gomb megjelenítése';
$string['stopbutton_help'] = 'Bekapcsolása esetén a tesztbe egy leállító gomb kerül.
Ha a tanuló rákattint, az addigi eredményeket a Moodle megkapja, a próbálkozás pedig "felhagyott" állapotba kerül.
A leállító gombon megjelenő szöveg a Moodle nyelvi csomagjaiban előre beállított szöveg, vagy a tanár által megadott szöveg lesz.';
$string['stopbutton_langpack'] = 'Nyelvi csomagból';
$string['stopbutton_specific'] = 'Megadott szöveg használata';
$string['stoptext'] = 'A leállító gomb szövege';
$string['storedetails'] = 'Store the raw XML details A HotPot teszten végrehajtott próbálkozások tárolása nyers XML-adatok formájában';
$string['studentfeedback'] = 'Tanulói visszajelzés';
$string['studentfeedback_help'] = 'Bekapcsolása esetén egy előugró visszajelzési ablakhoz vezető ugrópont jelenik meg, ha a tanuló az "Ellenőrzés" gombra kattint. A visszajelzési ablakból a tanuló négyféleképpen küldhet visszajelzést a tanárnak:
**Weboldalról**
: szükséges hozzá a weboldal URL-je, pl.
http://myserver.com/feedbackform.html
**Visszajelzési űrlappal**
: szükséges hozzá az űrlapot feldolgozó kód URL-je, pl.
http://myserver.com/cgi-bin/formmail.pl
**Moodle-fórumból**
: megjelenik a kurzushoz tartozó fórummutató
**Moodle-üzenettel**
: megjelenik a Moodle azonnali üzenetküldő ablaka. Több tanár esetén a tanulónak előbb ki kell választania a tanárt, mielőtt az ablak megjelenik.';
$string['submits'] = 'Leadott munkák';
$string['subplugintype_hotpotattempt'] = 'Kimeneti forma';
$string['subplugintype_hotpotattempt_plural'] = 'Kimeneti formák';
$string['subplugintype_hotpotreport'] = 'Jelentés';
$string['subplugintype_hotpotreport_plural'] = 'Jelentés';
$string['subplugintype_hotpotsource'] = 'Forrásállomány';
$string['subplugintype_hotpotsource_plural'] = 'Forrásállomány';
$string['textsourcefile'] = 'Forrásfájlból';
$string['textsourcefilename'] = 'Használandó forrásállomány neve';
$string['textsourcefilepath'] = 'Használandó forrásállomány útvonala';
$string['textsourcequiz'] = 'Tesztből';
$string['textsourcespecific'] = 'Megadott szöveg';
$string['timeclose'] = 'Elérhető eddig';
$string['timedout'] = 'Lejárt';
$string['timelimit'] = 'Időkorlát';
$string['timelimit_help'] = 'Ez a beállítás szabja meg egy próbálkozás maximális időtartamát.
**A forrás-/sablonállomány beállításainak használata**
: ehhez a kimeneti formához az időkorlát a forrás-/sablonállományból jön elő.
**Megadott idő haszálata**
: A HotPot tesztbeállító oldlaán szereplő időkorlát lesz a próbálkozás maximális időtartama. Ez a beállítás felülírja a forrás-/konfigurációs-/sablon-állományban megadottat.
**Kikapcsolás**
: a teszthez kapcsolódó próbálkozásoknak nincs időkorlátja.
A próbálkozás újrakezdésekor az időmérő onnan folytatódik, ahol a próbálkozást korábban megszakították.';
$string['timelimitexpired'] = 'A próbálkozáshoz tartozó időkorlát lejárt.';
$string['timelimitspecific'] = 'Megadott idő használata';
$string['timelimitsummary'] = 'Időkorlát egy próbálkozáshoz';
$string['timelimittemplate'] = 'A forrás-/sablonfájl beállításainak használata';
$string['timeopen'] = 'Elérhető ekkortól';
$string['timeopenclose'] = 'Megnyitási és lezárási időpontok';
$string['timeopenclose_help'] = 'Megadhatja, mikortól meddig legyen elérhető a teszt';
$string['title'] = 'Cím';
$string['title_help'] = 'Ez a beállítás szabja meg a weboldalon megjelenő címet.
**HotPot tevékenység neve**
: a weboldal címében a HotPot tevékenység jelenik meg.
**Forrásállományból**
: a weboldalon esetlegesen megjelenő cím a forrásállományban megadott cím lesz.
**A forrásállomány neve**
: a mappanevek nélküli forrásállománynév lesz a weboldalon megjelenő cím.
**Útvonal nevével együtt**
: a forrásállománynév a mappanevekkel együtt lesz a weboldalon megjelenő cím..';
$string['unitname_help'] = 'egység nevéhez tartozó súgó';
$string['updated'] = 'Frissítve';
$string['usefilters'] = 'Szűrőhasználat';
$string['usefilters_help'] = 'Bekapcsolása esetén a tartalom megjelenítés előtt áthalad a Moodle szűrőin.';
$string['useglossary'] = 'Szójegyzék használata';
$string['useglossary_help'] = 'Bekapcsolása esetén a tartalom megjelenítés előtt áthalad a Moodle automatikus szójegyzék-kapcsoló szűrőjén.
A beállítás felülírja a portáladminisztrációs oldalon az automatikus szójegyzék-kapcsoló ki-be kapcsolását.';
$string['usemediafilter'] = 'Médiumszűrő használata';
$string['usemediafilter_help'] = 'Ezzel állítja be a használandó médiaszűrőt.
**Semmilyen**
: a tartalom semmilyen médiaszűrőn nem halad át.
**A Moodle standard médiaszűrői**
: a tartalom a Moodle standard médiaszűrőin halad át. Ezek a szűrők hang- és filmállományok gyakori típusaira keresnek rá, majd a fellelteket áétadják a megfelelő médialejátszónak.
**HotPot médiaszűrő**
: a tartalom szűrőkön nem halad át a szögletes zárójelek között megadott ugrópontokra, képekre, hangokra és filmekre rákeresve. A szögletes zárójelek használata:
\`[url lejátszó magassága]\` **url**
: a médiaállományhoz vezető útvonal
**lejátszó** (választható) : a beszúrandó lejátszó neve. Alapesetben a "moodle". A HotPot modul standard változata az alábbi lejátszókat kínálja még föl:
: **dew**: mp3-lejátszó :
**dyer**: Bernard Dyer mp3-lejátszója
: **hbs**: a Half-Baked Software mp3-lejátszója
: **image**: kép beszúrása a weboldalba
: **link**: ugrópont beszúrása egy másik weboldalhoz
**width** (választható) : a lejátszó szélessége
**height** (választható) : a lejátszó magassága. Kihagyása esetén megegyezik a szélességével. **lehetőségek** (választható)
: a lejátszóhoz továbbítandó lehetőségek vesszővel elválasztott felsorolása. Ezek lehetnek ki-be kapcsolók, vagy egy név--rték pár
: **name=érték
: **name="érték szóközökkel"';
$string['utilitiesindex'] = 'HotPot segédeszközök mutatója';
$string['viewreports'] = '{$a} felhasználóhoz tartozó jelentés megtekintése';
$string['views'] = 'Nézetek';
$string['weighting'] = 'Súlyozás';
$string['wrong'] = 'Hibás';
$string['zeroduration'] = 'Nincs időtartam';
$string['zeroscore'] = 'Nulla pont';
