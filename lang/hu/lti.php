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
 * Strings for component 'lti', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   lti
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accept'] = 'Elfogadás';
$string['accept_grades'] = 'Osztályzatok elfogadása az eszköztől';
$string['accept_grades_admin'] = 'Osztályzatok elfogadása az eszköztől';
$string['accept_grades_admin_help'] = 'Adja meg, hogy az eszköz gazdája az effajta eszközhöz kapcsolódóan hozzáadhat, frissíthet, beolvashat és törölhet-e osztályzatokat.
Vannak eszközgazdák, akik támogatják az eszközzel végzett tevékenységek során szerzett osztályzatok Moodle-ba való visszaírását, ily módon növelve az eszköz rendszerbe integrálását.';
$string['accept_grades_help'] = 'Adja meg, hogy az eszköz gazdája csak az effajta külső eszközhöz kapcsolódóan adhat-e hozzá, frissíthet, olvashat be és törölhet osztályzatokat.
Vannak eszközgazdák, akik támogatják az eszközzel végzett tevékenységek során szerzett osztályzatok Moodle-ba való visszaírását, ily módon növelve az eszköz rendszerbe integrálását.
Ezt a beállítást az eszköz konfigurálása fölülírhatja.';
$string['action'] = 'Lépés';
$string['active'] = 'Aktív';
$string['activity'] = 'Tevékenység';
$string['addnewapp'] = 'Külső alkalmazás bekapcsolása';
$string['addserver'] = 'Új megbízható szerver hozzáadása';
$string['addtype'] = 'Külső eszköz beállításának hozzáadása';
$string['allow'] = 'Engedélyez';
$string['allowinstructorcustom'] = 'Oktatók számára egyedi paraméterek hozzáadásának engedélyezése';
$string['allowsetting'] = 'Eszköz számára 8K beállítás Moodle-ban való tárolásának engedélyezése';
$string['always'] = 'Mindig';
$string['automatic'] = 'Automatikus, az indító URL alapján';
$string['baseurl'] = 'alap-URL';
$string['basiclti'] = 'LTI';
$string['basiclti_base_string'] = 'LTI OAuth alapszöveg';
$string['basiclti_endpoint'] = 'LTI indítása végpont';
$string['basiclti_in_new_window'] = 'Tevékenysége új ablakban nyílt meg.';
$string['basiclti_parameters'] = 'LTI indítási paraméterei';
$string['basicltiactivities'] = 'LTI-tevékenységek';
$string['basicltifieldset'] = 'Egyéni példa mezőhalmaza';
$string['basicltiintro'] = 'Tevékenységleírás';
$string['basicltiname'] = 'Tevékenységnév';
$string['basicltisettings'] = 'Alapvető LTI-beállítások';
$string['cannot_delete'] = 'Az eszköz beállításait nem törölheti.';
$string['cannot_edit'] = 'Az eszköz beállításait nem szerkesztheti.';
$string['comment'] = 'Megjegyzés';
$string['configpassword'] = 'Távoli eszköz alapértelmezett jelszava';
$string['configpreferheight'] = 'Alapértelmezett egyéni magasság';
$string['configpreferwidget'] = 'Segédeszköz beállítása alapértelmezett indításként';
$string['configpreferwidth'] = 'Alapértelmezett egyéni szélesség';
$string['configresourceurl'] = 'Alapértelmezett forrás-URL';
$string['configtoolurl'] = 'Alapértelmezett távoli eszközhöz tartozó URL';
$string['configtypes'] = 'LTI-alkalmazások bekapcsolása';
$string['course_tool_types'] = 'Kurzuseszközök fajtái';
$string['courseid'] = 'Kurzusazonosító szám';
$string['coursemisconf'] = 'A kurzus beállítása hibás';
$string['createdon'] = 'Létrehozás dátuma';
$string['curllibrarymissing'] = 'Az LTI használatához telepíteni kell a PHP Curl könyvtárat';
$string['custom'] = 'Egyedi paraméterek';
$string['custom_config'] = 'Egyedi eszközbeállítás használata';
$string['custom_help'] = 'Az egyéni paraméterek az eszközt rendelkezésre bocsátó által használt beállítások. Egyéni paraméterekkel lehet pl. a tőle származó konkrét tananyagot megjeleníteni.
Ellenkező értelmű utasítás hiányában célszerű a mezőt változatlanul hagyni.';
$string['custominstr'] = 'Egyéni paraméterek';
$string['debuglaunch'] = 'Hibakeresési lehetőség';
$string['debuglaunchoff'] = 'Szokásos indítás';
$string['debuglaunchon'] = 'Hibakeresés indítása';
$string['default'] = 'Alapértelmezett';
$string['default_launch_container'] = 'Alapértelmezett indítási tároló';
$string['default_launch_container_help'] = 'Az indítási tároló befolyásolja az eszköz megjelenítését kurzusból való indítása esetén. Egyes indítási tárolók nagyobb képernyőterületet használnak, mások esetén inkább a Moodle-lal való integráltság kerül előtérbe.
* **Alapértelmezett** - Az eszközbeállítás szerinti indítási tároló használata.
* **Beágyazás** - Az eszköz a legtöbb tevékenységtípushoz hasonlóan a meglévő Moodle-ablakban jelenik meg.
* **Beágyazás blokkok nélkül** - Az eszköz csak az oldal tetején a navigációs eszközökkel, a meglévő Moodle-ablakban jelenik meg.
* **Új ablak** - Az eszköz új ablakban jelenik meg, elfoglalva az összes rendelkezésre álló területet.
A böngészőtől függően egy új fület vagy egy előugró ablakot nyit meg.
Előfordulhat, hogy a böngésző megakadályozza új ablak megnyitását.';
$string['delegate'] = 'Oktatóhoz irányít';
$string['delete'] = 'Törlés';
$string['delete_confirmation'] = 'Biztosan törölni kívánja a külső eszköz beállítását?';
$string['deletetype'] = 'Külső eszköz beállításának törlése';
$string['display_description'] = 'Indításkor a tevékenység leírásának megjelenítése';
$string['display_description_help'] = 'Kiválasztása esetén a (fent megadott) tevékenység leírása az eszközt biztosító tartalma fölött jelenik meg.
A leírás választhatóan további utasításokat tartalmazhat az eszközt elindítók számára.
A leírás nem jelenik meg, ha az eszközt indítási tárolója új ablakban jelenik meg.';
$string['display_name'] = 'A tevékenység nevének megjelenítése indításkor';
$string['display_name_help'] = 'Kiválasztása esetén a (fent megadott) tevékenység leírása az eszközt biztosító tartalma fölött jelenik meg.
A címet ő is megjelenítheti. Ezzel előzhető meg a cím kétszeri kijelzése.
A leírás nem jelenik meg, ha az eszközt indítási tárolója új ablakban jelenik meg.';
$string['domain_mismatch'] = 'Az indítási URL doménje nem egyezik az eszköz beállításával.';
$string['donot'] = 'Ne küldje el';
$string['donotaccept'] = 'Ne fogadja el';
$string['donotallow'] = 'Ne engedélyezze';
$string['edittype'] = 'Külső eszköz beállításának szerkesztése';
$string['embed'] = 'Beágyazás';
$string['embed_no_blocks'] = 'Beágyazás blokkok nélkül';
$string['enableemailnotification'] = 'Értesítések küldése';
$string['enableemailnotification_help'] = 'Bekapcsolása esetén a tanulók e-mailben értesítést kapnak az eszközzel kapcsolatos leadott munkáik osztályozásáról';
$string['errormisconfig'] = 'Hibás eszközbeállítás. Kérje meg a Moodle-rendszergazdát, hogy javítsa ki.';
$string['extensions'] = 'LTI-bővítményszolgáltatások';
$string['external_tool_type'] = 'Külső eszköz típusa';
$string['external_tool_type_help'] = 'Az eszközbeállítás fő célja biztonságos kommunikációs csatorna kialakítása a Moodle és az eszköz szolgáltatója között. Emellett lehetővé teszi alapbeállítások létrehozását és az eszköz által biztosított egyéb szolgáltatások bekapcsolását.
* **Automatikus, indítási URL-en alapuló** - Ez a beállítás használandó szinte minde esetben. A Moodle az indítási URL alapján kiválasztja az eszköz legmegfelelőbb beállítását. A rendszergazda által vagy a kurzuson belül beállított eszköz használatát feltételezi. Az indítási URL megadása esetén a Moodle visszajelez, hogy felismerte-e. Ha nem ismeri fel az indítási URL-t, akkor az eszközbeállítást kézzel kell elvégezni.
* **Adott eszköztípus** - Az adott eszköztípus kiválasztásával a Moodle számára előírhatja a külső eszköz szolgáltatójával való kommunikáció során használandó eszközbeállítást. Ha az indítási URL nem az eszköz szolgáltatójáé, figyelmeztetés jelenik meg. Egyes esetekben nem szükséges adott eszköztípushoz indítási URL-t is megadni (ha az indítás az eszköz szolgáltatóján belül egy konkrét tananyagot vesz célba).
* **Egyedi beállítás** - Az adott előfordulás egyedi beállításához jelenítse meg a Részletes lehetőségeket és adja meg a fogyasztókulcsot és a megosztott titkos jelet. Ha nem rendelkezik ezekkel, kérhet egyet az eszköz szolgáltatójától. Nem minden eszköz igényel fogyasztókulcsot és megosztott titkos jelet.
### Eszköztípus szerkesztése
A Külső eszköztípus lenyíló lista után három ikon érhető el:
* **Hozzáadás** - Kurzusszintű eszközbeállítás létrehozása. A kurzusban előforduló összes külső eszköz használhatja az eszközbeállítást.
* **Szerkesztés** - A lenyíló listáról válasszon ki egy kurzusszintű eszköztípust, majd kattintson az ikonra. Az eszközbeállítás részleteit szerkesztheti.
* **Törlés** - Törli a kiválasztott kurzusszintű eszköztípust.';
$string['external_tool_types'] = 'Külső eszköz típusai';
$string['failedtoconnect'] = 'A Moodle nem tudott kapcsolatot teremteni a(z) "{$a}" rendszerrel.';
$string['filter_basiclti_configlink'] = 'Állítsa be kedvenc portáljait és azok jelszavait.';
$string['filter_basiclti_password'] = 'Jelszó megadása kötelező';
$string['filterconfig'] = 'LTI-adminisztráció';
$string['filtername'] = 'LTI';
$string['fixexistingconf'] = 'A hibás beállítás helyett használjon egy létezőt.';
$string['fixnew'] = 'Új beállítás';
$string['fixnewconf'] = 'A hibás beállítás helyett adjon meg egy újat.';
$string['fixold'] = 'Létező használata';
$string['force_ssl'] = 'SSL előírása';
$string['force_ssl_help'] = 'Kiválasztása esetén az ezen eszközszolgáltatóhoz érkező kezdeményezésekkel SSL-t kell használni.
Emellett az eszközszolgáltatótól érkező minden webszolgáltatási kérelem is SSL-t fog használni.
Használata esetén győződjön meg arrólk, hogy mind a Moodle, mind az eszközszolgáltató támogatja az SSL-t.';
$string['forced_help'] = 'Ezt a beállítást egy kurzus- vagy portálszintű eszköz beállítása írja elő.';
$string['global_tool_types'] = 'Globális eszköztípusok';
$string['grading'] = 'Pontozás útvonala';
$string['icon_url'] = 'Ikonos URL';
$string['icon_url_help'] = 'Ikonos URL esetén a tevékenységhez tartozó kurzuslistában az ikon módosítható. Alapbeállítás szerinti LTI-ikon helyett megadhat egy olyat, amely utal a tevékenység típusára.';
$string['id'] = 'azonosító';
$string['imsroleadmin'] = 'Oktatói rendszergazda';
$string['imsroleinstructor'] = 'Oktató';
$string['imsrolelearner'] = 'Tanuló';
$string['invalidid'] = 'Hibás LTI-azonosító';
$string['launch_in_moodle'] = 'Eszköz indítása a Moddle-ban';
$string['launch_in_popup'] = 'Eszköz indítása előugró ablakban';
$string['launch_url'] = 'Indítási URL';
$string['launch_url_help'] = 'Az indítási URL a külső eszköz webcíme, mely egyéb információkat is tartalmazhat, pl. a megjelenítendő tananyagot. Ha nem tudja pontosan, hogyan kell megadni az indítási URL-t, forduljon az eszközszolgáltatóhoz.
Ha kiválasztott egy konkrét eszközfajtát, előfordulhat, hogy nem kell megadnia indítási URL-t. Ilyen fordulhat elő például, ha az eszköz ugrópontja csak az eszközszolgáltató rendszerébe való bekapcsolódáshoz szükséges, de nem egy konkrét tananyag eléréséhez.';
$string['launchinpopup'] = 'Tároló indítása';
$string['launchinpopup_help'] = 'Az indítási tároló befolyásolja az eszköz kurzusból való indításakori megjelenését. Egyes indítási tárolók több területet engedélyeznek az eszköz számára, míg mások jobban egybeépülnek a Moodle környezetével.
* **Alapbeállítás** - Az eszköz beállítása szerinti indítási tároló használata.
* **Beágyazás** - Az eszköz a meglévő Moodle-ablakban jelenik meg a többi tevékenységtípus többségéhez hasonlóan.
* **Beágyazás blokkok nélkül** - Az eszköz a meglévő Moodle-ablakban jelenik meg, az oldal tetején a csak a navigációs kezelőszervekkel.
* **Új ablak** - Az eszköz egy új ablakban jelenik meg, a rendelkezésre álló területet teljes egészében kitöltve.
A böngészőtől függően új fülön vagy előbukkanó ablakban jelenik meg.
Elképzelhető, hogy a böngésző nem engedélyezi az új ablak megjelenését.';
$string['launchoptions'] = 'Indítási lehetőségek';
$string['lti'] = 'LTI';
$string['lti:addcoursetool'] = 'LTI-tevékenységek pontozása';
$string['lti:grade'] = 'LTI-tevékenységek pontozása';
$string['lti:manage'] = 'LTI-tevékenységek szerkesztése';
$string['lti:requesttooladd'] = 'Eszköz beküldése a rendszergazdáknak beállítás céljából';
$string['lti:view'] = 'LTI-tevékenységek megtekintése';
$string['lti_administration'] = 'LTI-adminisztráció';
$string['lti_errormsg'] = 'Az eszköztől a következő hibaüzenet érkezett: "{$a}"';
$string['lti_launch_error'] = 'Hiba a külső eszköz indítása közben';
$string['lti_launch_error_tool_request'] = 'Ha egy rendszergazdától szeretné kérni az eszköz beállítását, kattintson a(z) [pontra] ({$a->admin_request_url}).';
$string['lti_launch_error_unsigned_help'] = 'Ezt a hibát előidézheti egy hiányzó vásárlói kulcs és az eszközszolgáltatóhoz kapcsolódó megosztott kód.
Ha rendelkezik vásárlói kulccsal és az eszközszolgáltatóhoz kapcsolódó megosztott kóddal, megadhatja őket a külső eszközpéldány szerkesztése közben.';
$string['lti_tool_request_added'] = 'Az eszköz-beállítási kérelem leadása sikerült. Előfordulhat, hogy a beállítás elvégzéséhez rendszergazdához kell fordulnia.';
$string['lti_tool_request_existing'] = 'Az eszköz tartományához más adtak le eszközbeállítást.';
$string['main_admin'] = 'Általános súgó';
$string['main_admin_help'] = 'Külső eszközökkel a Moodle felhasználói gond nélkül kapcsolódhatnak távoli gépeken lévő tananyagokhoz. Egy speciális indítási protokollnak köszönhetően a távoli eszköz általános adatokhoz jut a kapcsolatot kezdeményező felhasználóról. Ilyen például az intézmény neve, a kurzusazonosító, a felhasználó azonosítója, neve vagy e-mail címe. Az oldalon felsorolt eszközök három csoportra különülnek el:
* **Aktív** - Ezeket az eszközszolgáltatókat rendszergazda hagyta jóvá és állította be. A Moodle ezen példányán bármely kurzusban használhatók. Ha fogyasztókulcsot és megosztott titkos jelet ad meg, megbízhatónak feltételezett kapcsolat létesül a Moodle ezen példánya és a távoli eszköz között, ami biztonságos kommunikációs csatornát nyit meg.
* **Függő** - Ezek az eszközszolgáltatók csomagimportálás révén kerültek be, de rendszergazda általi beállításukra még nem került sor. Ettől függetlenül az oktatók használhatják ezeket az eszközöket, ha rendelkeznek fogyasztókulccsal és megosztott titkos jellel, illetve ha ezek egyike sincs előírva.
* **Elutasított** - Ezeket az eszközszolgáltatókat egy rendszergazda a Moodle adott teljes példánya számára nem kívánja hozzáférhetővé tenni. Ettől függetlenül az oktatók használhatják ezeket az eszközöket, ha rendelkeznek fogyasztókulccsal és megosztott titkos jellel, illetve ha ezek egyike sincs előírva.';
$string['miscellaneous'] = 'Egyéb';
$string['misconfiguredtools'] = 'Hibásan beállított eszközpéldányok fordulnak elő.';
$string['missingparameterserror'] = 'Hibásan beállított oldal: "{$a}"';
$string['module_class_type'] = 'A Moodle modultípusa';
$string['modulename'] = 'Külső eszköz';
$string['modulename_help'] = 'Külső eszközökkel a Moodle felhasználói más portálokon lévő tananyagokkal és tevékenységekkel léphetnek kapcsolatba. Ilyen lehet egy új tevékenységfajta megjelenése vagy tananyagok elérhetővé válása valamely kiadónál.
A külső eszköz egy példányának beállításához egy LTI-t (tanulási eszközök együttműködését) támogató eszközszolgáltatóra van szükség. Ha talál ilyet, tőle megkaphatja a beállításhoz szükséges adatokat. Emellett használhatja a portál rendszergazdája által beállított eszközöket is.
A külső eszköz eltér az URL-en keresztül elérhető tananyagtól, amennyiben:
* **Környezetét ismeri** - A külső eszköz adatokhoz jut a kapcsolatot kezdeményező felhasználóról. Ilyen például az intézmény neve, a kurzusazonosító, a felhasználó azonosítója, neve stb.
* **Beépül** - A külső eszköz támogatja a tevékenységgel összefüggő osztályzatok olvasását, frissítését és törlését. A jövőben további beépülési lehetőségek megjelenése várható..
* **Biztonságos** - Megbízhatónak feltételezett kapcsolat létesül az eszközszolgáltató és a Moodle ezen példánya között, ami biztonságos kommunikációs csatornát nyit meg közöttük.';
$string['modulenameplural'] = 'alapvető ltik';
$string['modulenamepluralformatted'] = 'LTI-példányok';
$string['never'] = 'Soha';
$string['new_window'] = 'Új ablak';
$string['no_lti_configured'] = 'Nincs beállítva külső eszköz';
$string['no_lti_pending'] = 'Nincs beállításra váró külső eszköz';
$string['no_lti_rejected'] = 'Nincs elutasított külső eszköz';
$string['noattempts'] = 'Ezen eszközpéldányon nem történt próbálkozás';
$string['noltis'] = 'Nincsenek lti-példányok';
$string['noservers'] = 'Nincs szerver';
$string['notypes'] = 'Jelenleg a Moodle-ban nincs beállítva LTI-eszköz. Hozzáadáshoz kattintson a Telepítés pontra.';
$string['noviewusers'] = 'Nincs az eszköz használatára jogosult felhasználó.';
$string['optionalsettings'] = 'Választható beállítások';
$string['organization'] = 'Szervezet adatai';
$string['organizationdescr'] = 'Szervezet leírása';
$string['organizationid'] = 'Szervezet azonosítója';
$string['organizationid_help'] = 'Egyedi azonosító a Moodle adott példányához. Általában a szervezet DNS-neve.
Ha a mező üresen marad, a Moodle-portál gazdagépének a neve lesz az alapbeállítás.';
$string['organizationurl'] = 'Szervezet URL-je';
$string['organizationurl_help'] = 'A Moodle adott példányának alap-URL-je.
Ha a mező üresen marad, a portál beállítása szerinti érték lesz az alapbeállítás.';
$string['pagesize'] = 'Leadott munkák száma oldalanként';
$string['password'] = 'Megosztott titkos jel';
$string['password_admin'] = 'Megosztott titkos jel';
$string['password_admin_help'] = 'A megosztott titkos jel egyfajta jelszó az eszköz eléréséhez. Az eszközszolgáltatótól kapott fogyasztókulccsal együtt kell megadni.
Előfordulhat, hogy a Moodle részéről biztonságos kommunikációt elő nem író és kiegészítő szolgáltatásokat (pl. jelentés az osztályozásról) nem kínáló eszközök nem írják elő megosztott titkos jel használatát.';
$string['password_help'] = 'Előre beállított eszközök esetén itt nem szükséges megosztott titkos jelet megadni, mivel a megosztott titkos jel megadására a beállítás közben kerül sor.
Ezt a mezőt egy még be nem állított eszközszolgáltatóhoz való kapcsolat létrehozásához kell kitölteni.
Ha az eszközszolgáltatót a kurzus során többször igénybe veszi, akkor kapóra jöhet egy kurzuseszköz-beállítás.
A megosztott titkos jel egyfajta jelszó az eszköz eléréséhez. Az eszközszolgáltatótól kapott fogyasztókulccsal együtt kell megadni.
Előfordulhat, hogy a Moodle részéről biztonságos kommunikációt elő nem író és kiegészítő szolgáltatásokat (pl. jelentés az osztályozásról) nem kínáló eszközök nem írják elő megosztott titkos jel használatát.';
$string['pending'] = 'Függőben';
$string['pluginadministration'] = 'LTI-adminisztráció';
$string['pluginname'] = 'LTI';
$string['preferheight'] = 'Választott magasság';
$string['preferwidget'] = 'Választott eszközindítás';
$string['preferwidth'] = 'Választott szélesség';
$string['press_to_submit'] = 'Nyomja le a tevékenység elindításához';
$string['privacy'] = 'Magántitok';
$string['quickgrade'] = 'Gyors pontozás engedélyezése';
$string['quickgrade_help'] = 'Bekapcsolása esetén több eszköz pontozható egyetlen oldalon. Adja meg a pontokat és fűzzön hozzájuk megjegyzéseket, majd az összes módosítás mentéséhez kattintson az "Összes visszajelzés mentése" pontra.';
$string['redirect'] = 'Átirányítása másodperceken belül megtörténik. Ha mégsem, nyomja meg a gombot.';
$string['reject'] = 'Elutasítás';
$string['rejected'] = 'ElutasítVA';
$string['resource'] = 'Tananyag';
$string['resourcekey'] = 'Fogyasztókulcs';
$string['resourcekey_admin'] = 'Fogyasztókulcs';
$string['resourcekey_admin_help'] = 'A fogyasztókulcs egyfajta felhasználónév az eszköz eléréséhez. Az eszközszolgáltatót azon Moodle-portál egyedi azonosítására használja, amelyről a felhasználók elindították az eszközt.
A fogyasztókulcsot az eszközszolgáltató adja meg;annak módja eszközszolgáltatónként változik. Lehet automatikus folyamat, és lehet az eszközszolgáltatóval folytatott párbeszéd eredménye.
Előfordulhat, hogy a Moodle részéről biztonságos kommunikációt elő nem író és kiegészítő szolgáltatásokat (pl. jelentés az osztályozásról) nem kínáló eszközök nem írják elő megosztott titkos jel használatát.';
$string['resourcekey_help'] = 'Előre beállított eszközök esetén itt nem szükséges tananyagkulcsot megadni, mivel a fogyasztókulcs megadására a beállítás közben kerül sor.
Ezt a mezőt egy még be nem állított eszközszolgáltatóhoz való kapcsolat létrehozásához kell kitölteni.
Ha az eszközszolgáltatót a kurzus során többször igénybe veszi, akkor kapóra jöhet egy kurzuseszköz-beállítás.
A fogyasztókulcs egyfajta felhasználónév az eszköz eléréséhez. Az eszközszolgáltatót azon Moodle-portál egyedi azonosítására használja, amelyről a felhasználók elindították az eszközt.
A fogyasztókulcsot az eszközszolgáltató adja meg;annak módja eszközszolgáltatónként változik. Lehet automatikus folyamat, és lehet az eszközszolgáltatóval folytatott párbeszéd eredménye.
Előfordulhat, hogy a Moodle részéről biztonságos kommunikációt elő nem író és kiegészítő szolgáltatásokat (pl. jelentés az osztályozásról) nem kínáló eszközök nem írják elő megosztott titkos jel használatát.';
$string['resourceurl'] = 'Tananyag URL-je';
$string['return_to_course'] = 'A kurzushoz való visszatéréshez kattintson ide: <a href="{$a->link}" target="_top">here</a>.';
$string['saveallfeedback'] = 'Minden visszajelzésem elmentése';
$string['secure_icon_url'] = 'Biztonságos ikon-URL';
$string['secure_icon_url_help'] = 'Hasonló az Ikonos URL-hez, csak akkor használatos, amikor a felhasználó a Moodle-t biztonságos SSL-en keresztül éri el. A mező célja annak megelőzése, hogy a böngésző figyelmeztesse a felhasználót, ha az oldalt SSL-en keresztül éri el, de nem megbízható képet kíván megjeleníteni.';
$string['secure_launch_url'] = 'Biztonságos indítás URL-je';
$string['secure_launch_url_help'] = 'Hasonló az indítási URL-hez, csak akkor használatos, amikor biztonságos elérésre van szükség. A Moodle a biztonságos indítási URL-t választja, ha a portált SSL-en keresztül érik el, vagy ha az eszköz beállítása mindenkor SSL-t ír elő.
Az indítási URL-t https-hez beállítva előírható az SSL-en keresztüli indítás, a mező pedig üresen maradhat.';
$string['send'] = 'Küldés';
$string['setdefault'] = 'Alapérték beállítása az oktatóhoz delegálás esetére';
$string['setupbox'] = 'LTI-eszközbeállító';
$string['setupoptions'] = 'Beállítási lehetőségek';
$string['share_email'] = 'Indító e-mailjének megosztása az eszközzel';
$string['share_email_admin'] = 'Indító e-mailjének megosztása az eszközzel';
$string['share_email_admin_help'] = 'Adja meg, hogy az eszközt elindító felhasználó e-mail címét megosztja-e az eszközszolgáltatóval.
Az eszközszolgáltatónak szüksége lehet az indítók e-mail címére akár a felületen azonos névvel rendelkező más felhasználóktól való megkülönböztetés, akár felhasználóknak az eszközön belüli tevékenysége alapján való e-mail küldése végett.';
$string['share_email_help'] = 'Adja meg, hogy az eszközt elindító felhasználó e-mail címét megosztja-e az eszközszolgáltatóval.
Az eszközszolgáltatónak szüksége lehet az indítók e-mail címére akár a felületen azonos névvel rendelkező más felhasználóktól való megkülönböztetés, akár felhasználóknak az eszközön belüli tevékenysége alapján való e-mail küldése végett.
Ne feledje, hogy ezt a beállítást az eszköz beállítása felülírhatja.';
$string['share_name'] = 'Indító nevének megosztása az eszközzel';
$string['share_name_admin'] = 'Indító nevének megosztása az eszközzel';
$string['share_name_admin_help'] = 'Adja meg, hogy az eszközt elindító felhasználó teljes nevét megosztja-e az eszközszolgáltatóval.
Az eszközszolgáltatónak szüksége lehet az indítók nevére ahhoz, hogy az eszközön belül értelmes tájékoztatást jeleníthessen meg.';
$string['share_name_help'] = 'Adja meg, hogy az eszközt elindító felhasználó teljes nevét megosztja-e az eszközszolgáltatóval.
Az eszközszolgáltatónak szüksége lehet az indítók nevére ahhoz, hogy az eszközön belül értelmes tájékoztatást jeleníthessen meg
Ne feledje, hogy ezt a beállítást az eszköz beállítása felülírhatja.';
$string['share_roster'] = 'Kurzus névjegyzékéhez való hozzáférés engedélyezése az eszköz számára';
$string['share_roster_admin'] = 'Az eszköz hozzáférhet a kurzus névjegyzékéhez';
$string['share_roster_admin_help'] = 'Adja meg, hogy az eszköz hozzáférhet-e az azt elindító eszközfajta kurzusait felvett felhasználók névjegyzékéhez.';
$string['share_roster_help'] = 'Adja meg, hogy az eszköz hozzáférhet-e a kurzust felvett felhasználók névjegyzékéhez.
Ne feledje, hogy ezt a beállítást az eszköz beállítása felülírhatja.';
$string['show_in_course'] = 'Eszközpéldányok létrehozása során az eszköztípus megjelenítése';
$string['show_in_course_help'] = 'Kiválasztása esetén ez az eszközbeállítás jelenik meg a "Külső eszközfajta" lenyíló menüben, amikor az oktatók a kurzusaikban külső eszközöket állítanak be.
Általában ezt nem szükséges kiválasztani. Az oktatók használhatják az indítási URL szerinti eszközbeállítást az eszköz alap-URL-jével összekapcsolva, ami egyben a javasolt módszer.
Ezt kizárólag akkor kell kiválasztani, ha az eszközbeállítást egyszeri bejelentkezéshez szánják. Például amikor az eszközszolgáltatóhoz érkező összes indítás a felhasználót csak egy céloldalra vagy egy konkrét tananyaghoz érkezteti.';
$string['size'] = 'Méretadatok';
$string['submission'] = 'Leadás';
$string['toggle_debug_data'] = 'Hibakeresési adatok ki-/bekapcsolása';
$string['tool_config_not_found'] = 'Ehhez az URL-hez nincs eszközbeállítás';
$string['tool_settings'] = 'Eszközbeállítások';
$string['toolsetup'] = 'Külső eszköz beállítása';
$string['toolurl'] = 'Eszköz alap-URL-je';
$string['toolurl_help'] = 'Az eszköz alap-URL-je az eszköz indítási URL-jét kapcsolja össze a helyes eszközbeállítással. Az URL előtt a http(s) használata nem kötelező.
Emellett az eszköz alap-URL-je az eszköz indítási URL-jeként használatos, ha a külső eszköz példányában nincs megadva indítási URL.
| **Alap-URL** | **Kapcsolatok** |
||
| tool.com | tool.com, tool.com/quizzes, tool.com/quizzes/quiz.php?id=10, www.tool.com/quizzes |
| www.tool.com/quizzes | tool.com/quizzes, tool.com/quizzes/take.php?id=10, www.tool.com/quizzes |
| quiz.tool.com | quiz.tool.com, quiz.tool.com/take.php?id=10 |
Ha azonos domén esetén két eltérő eszközbeállítás létezik, a specifikusabb kapcsolat (egyezés) használatára kerül sor.';
$string['typename'] = 'Eszköz neve';
$string['typename_help'] = 'Az eszköz neve az eszközszolgáltatót azonosítja a Moodle-ban. A megadott nevet az oktatók a kurzusokon belül a külső eszköz hozzáadása során látják.';
$string['types'] = 'Típusok';
$string['update'] = 'Frissítés';
$string['using_tool_configuration'] = 'Eszközbeállítás használata';
$string['validurl'] = 'Az érvényes URL kezdete http(s)://';
$string['viewsubmissions'] = 'A leadások és a pontozó képernyő megtekintése';
