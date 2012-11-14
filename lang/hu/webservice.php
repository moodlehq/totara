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
 * Strings for component 'webservice', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   webservice
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessexception'] = 'Hozzáférés-szabályozási kivétel';
$string['accesstofunctionnotallowed'] = 'A(z)  {$a}() függvény használata nem megengedett. Ellenőrizze, nincs-e bekapcsolva olyan szolgáltatás, amely a függvényt használja. A szolgáltatás beállításaiban ha a szolgáltatás korlátozott, ellenőrizze, szerepel-e a listában a felhasználó. Ellenőrizze a szolgáltatás beállításaiban azt is, hogy nincs-e IP-korlátozás vagy előírt képesség a szolgáltatás igénybevételéhez.';
$string['actwebserviceshhdr'] = 'Aktív webszolgáltatási protokollok';
$string['addaservice'] = 'Szolgáltatás hozzáadása';
$string['addcapabilitytousers'] = 'Felhasználók lehetőségeinek ellenőrzése';
$string['addcapabilitytousersdescription'] = 'A webszolgáltatások használatához a felhasználóknak kétféle képességgel kell
rendelkezni. Ezek: \'/webservice:createtoken\' és a webszolgáltatási protokolloknak megfelelő képesség (\'webservice/rest:use\', \'webservice/soap:use\', ...). Ennek egyik beállítási módja, ha létrehoz egy új webszolgáltatási szerepet, és valamilyen webszolgáltatási protokolloknak megfelelő képességeket. Ezt rendszerszintű szerepként rendelje hozzá a webszolgáltatás felhasználójához.';
$string['addfunction'] = 'Feladat hozzáadása';
$string['addfunctionhelp'] = 'Válassza ki a szolgáltatáshoz hozzáadandó feladatot.';
$string['addfunctions'] = 'Funkciók hozzáadása';
$string['addfunctionsdescription'] = 'A z újonnan létrehozott szolgáltatáshoz válassza ki a szükséges funkciókat.';
$string['addrequiredcapability'] = 'Előírt képesség hozzárendelése/leválasztása';
$string['addservice'] = 'Új szolgáltatás hozzáadása: {$a->name} (azonosító: {$a->id})';
$string['addservicefunction'] = 'Funkciók hozzáadása a(z) "{$a}" szolgáltatáshoz';
$string['allusers'] = 'Minden felhasználó';
$string['amftestclient'] = 'AMF-teszt kliensgépe';
$string['apiexplorer'] = 'API explorer';
$string['apiexplorernotavalaible'] = 'Az API explorer még nem elérhető.';
$string['arguments'] = 'Argumentumok';
$string['authmethod'] = 'Hitelesítési módszer';
$string['cannotcreatetoken'] = 'Nincs engedélye a szolgáltatáshoz kapcsolódó webszolgáltatási jel létrehozásához {$a}.';
$string['cannotgetcoursecontents'] = 'A kurzustartalom nem elérhető.';
$string['checkusercapability'] = 'Felhasználó lehetőségeinek ellenőrzése';
$string['checkusercapabilitydescription'] = 'A felhasználóknak a megfelelő képességekkel (pl. webservice/rest:use, webservice/soap:use) kell rendelkezni.  Ezt rendszerszintű szerepként rendelje hozzá a webszolgáltatás felhasználójához.';
$string['configwebserviceplugins'] = 'Biztonsági okokból csak a használt protokollokat kapcsolja be.';
$string['context'] = 'Környezet';
$string['createservicedescription'] = 'A szolgáltatás webszolgáltatási funkciók adott készlete. Az új szolgáltatás eléréséhez biztosítson hozzáférést a felhasználó számára. A <strong>Szolgáltatás hozzáadása</strong> oldalon jelölje be a \'Bekapcsolás\' és az \'Engedéllyel rendelkezők\' mezőt. Válassza ki a \'Nincs előírt képesség\' pontot.';
$string['createserviceforusersdescription'] = 'A szolgáltatás webszolgáltatási funkciók adott készlete. Az új szolgáltatás eléréséhez biztosítson hozzáférést a felhasználó számára. A <strong>Szolgáltatás hozzáadása</strong> oldalon jelölje be a \'Bekapcsolás\' mezőt, az \'Engedéllyel rendelkezők\' mezőt pedig ne jelölje be. Válassza ki a \'Nincs előírt képesség\' pontot.';
$string['createtoken'] = 'Jel létrehozása';
$string['createtokenforuser'] = 'Jel létrehozása felhasználó számára';
$string['createtokenforuserauto'] = 'Felhasználói jel automatikus létrehozása';
$string['createtokenforuserdescription'] = 'A webszolgáltatás felhasználójának hozzon létre egy jelet.';
$string['createuser'] = 'Konkrét felhasználó létrehozása';
$string['createuserdescription'] = 'A Moodle-t vezérlő rendszer számára egy webszolgáltatás-felhasználóra van szükség.';
$string['default'] = 'Alapesetben "{$a}"';
$string['deleteaservice'] = 'Szolgáltatás törlése';
$string['deleteservice'] = 'A szolgáltatás törlése: {$a->name} (azonosító: {$a->id})';
$string['deleteserviceconfirm'] = 'A szolgáltatás törlésekor törli a hozzá kapcsolódó jelet is. Biztosan törli a külső "{$a}" szolgáltatást?';
$string['deletetokenconfirm'] = 'Biztosan törli <strong>{$a->user}</strong> felhasználó <strong>{$a->service}</strong> szolgáltatáshoz kapcsolódó jelét?';
$string['disabledwarning'] = 'Minden webszolgáltatási protokoll ki van kapcsolva, a "Webszolgáltatások bekapcsolása" a  Részletes funkciók alatt érhető el.';
$string['doc'] = 'Dokumentáció';
$string['docaccessrefused'] = 'Ezen jel dokumentációját nem tekintheti meg';
$string['documentation'] = 'webszolgáltatás dokumentációja';
$string['downloadfiles'] = 'Letölthetők állományok.';
$string['downloadfiles_help'] = 'Bekapcsolása esetén a felhasználók biztonsági kulcsukkal állományokat tölthetnek le. Persze csak azokat, amelyeket a portál engedélyez számukra.';
$string['editaservice'] = 'A szolgáltatás szerkesztése';
$string['editservice'] = 'A szolgáltatás szerkesztése: {$a->name} (azonosító: {$a->id})';
$string['enabled'] = 'Bekapcsolva';
$string['enabledirectdownload'] = 'A külső szolgáltatás beállításainál a webszolgáltatás állományletöltését be kell kapcsolni.';
$string['enabledocumentation'] = 'Fejlesztői dokumentáció engedélyezése';
$string['enabledocumentationdescription'] = 'A bekapcsolt  protokollokhoz elérhető a webszolgáltatások részletes dokumentációja.';
$string['enablemobilewsoverview'] = 'Térjen át az {$a->manageservicelink} adminisztrációs oldalra, ellenőrizze a "{$a->enablemobileservice}" beállítást és kattintson a Mentés pontra. Ezzel létrejön minden beállítás és a portál felhasználói használhatják a hivatalos Moodle alkalmazást. A jelenlegi állapot: {$a->wsmobilestatus}';
$string['enableprotocols'] = 'Protokollok bekapcsolása';
$string['enableprotocolsdescription'] = 'Legalább egy protokollt be kell kapcsolni. A biztonság érdekében csak a használandó  protokollokat kapcsolja be.';
$string['enablews'] = 'Webszolgáltatások bekapcsolása';
$string['enablewsdescription'] = 'A webszolgáltatásokat a Részletes funkciók alatt be kell kapcsolni';
$string['entertoken'] = 'Biztonsági kulcs/jel megadása:';
$string['error'] = 'Hiba: {$a}';
$string['errorcatcontextnotvalid'] = 'A (kategóriaazonosító:{$a->catid}) kategóriakörnyezetben nem futtathat funkciókat. Ezt a környezeti hibaüzenetet kapta: {$a->message}';
$string['errorcodes'] = 'Hibaüzenet';
$string['errorcoursecontextnotvalid'] = 'A (kurzusazonosító:{$a->courseid}) kurzuskörnyezetben nem futtathat funkciókat. Ezt a környezeti hibaüzenetet kapta: {$a->message}';
$string['errorinvalidparam'] = 'Érvénytelen "{$a}" paraméter.';
$string['errornotemptydefaultparamarray'] = 'A(z) \'{$a}\' nevű webszolgáltatást leíró paraméter egy egy vagy több elemből álló struktúra. Alapesetben lehet üres tömb. Ellenőrizze a webszolgáltatás leírását.';
$string['erroroptionalparamarray'] = 'A(z) \'{$a}\' nevű webszolgáltatást leíró paraméter egy egy vagy több elemből álló struktúra. VALUE_OPTIONAL formában nem állítható be. Ellenőrizze a webszolgáltatás leírását.';
$string['execute'] = 'Végrehajtás';
$string['executewarnign'] = 'VIGYÁZAT:  a Végrehajtás lenyomásakor adatbázisa módosulni fog, a változásokat pedig nem lehet automatikusan érvényteleníteni!';
$string['externalservice'] = 'Külső szolgáltatás';
$string['externalservicefunctions'] = 'Külső szolgáltatás feladatai';
$string['externalservices'] = 'Külső szolgáltatások';
$string['externalserviceusers'] = 'Külső szolgáltatást használók';
$string['failedtolog'] = 'Nem készült napló';
$string['filenameexist'] = 'Az állománynév {$a} már létezik.';
$string['forbiddenwsuser'] = 'Visszaigazolatlan, törölt, felfüggesztett vagy vendég felhasználóhoz nem hozható létre jel.';
$string['function'] = 'Feladat';
$string['functions'] = 'Feladatok';
$string['generalstructure'] = 'Általános struktúra';
$string['information'] = 'Információ';
$string['installexistingserviceshortnameerror'] = '"{$a}" rövid névvel már létezik webszolgáltatás, ezen a néven másik webszolgáltatást nem lehet telepíteni/frissíteni.';
$string['installserviceshortnameerror'] = 'Kódolási hiba: "{$a}" szolgáltatás rövid neve csak számokból, betűkből, valamint _-.. jelekből állhat.';
$string['invalidextparam'] = 'Érvénytelen külső {$a} interfészparaméter';
$string['invalidextresponse'] = 'Érvénytelen külső {$a} interfészválasz';
$string['invalidiptoken'] = 'Érvénytelen jel - IP-je nincs támogatva';
$string['invalidtimedtoken'] = 'Érvénytelen jel - a jel lejárt';
$string['invalidtoken'] = 'Érvénytelen jel - nincs meg a jel';
$string['invalidtokensession'] = 'Érvénytelen végrehajtási jel - a végrehajtás nincs meg vagy lejárt';
$string['iprestriction'] = 'IP-korlátozás';
$string['iprestriction_help'] = 'A felhasználónak a webszolgáltatást a felsorolt IP-kről kell elérni.';
$string['key'] = 'Kulcs';
$string['keyshelp'] = 'A kulcsokkal külső alkalmazásokból érheti el Moodle-fiókját.';
$string['manageprotocols'] = 'Protokollok kezelése';
$string['managetokens'] = 'Lexikális elemek kezelése';
$string['missingcaps'] = 'Hiányzó képességek';
$string['missingcaps_help'] = 'Azon képességek felsorolása, amelyek a szolgáltatás funkcióihoz kellenek, de a felhasználó nem rendelkezik velük. A szolgáltatás igénybevételéhez adja hozzá a képességeket a felhasználóhoz.';
$string['missingpassword'] = 'Hiányzik a jelszó';
$string['missingrequiredcapability'] = '{$a} képességre van szükség.';
$string['missingusername'] = 'Hiányzik a felhasználónév';
$string['missingversionfile'] = 'Kódolási hiba: {$a} összetevőhöz hiányzik a version.php állomány';
$string['mobilewsdisabled'] = 'Kikapcsolva';
$string['mobilewsenabled'] = 'Bekapcsolva';
$string['nofunctions'] = 'A szoplgáltatásnak nincsenek funkciói';
$string['norequiredcapability'] = 'Nincs előírt képesség';
$string['notoken'] = 'Még nem hozott létre lexikális elemet.';
$string['onesystemcontrolling'] = 'A Moodle vezérlésének engedélyezése egy külső rendszer számára';
$string['onesystemcontrollingdescription'] = 'Az alábbiak szerint beállíthat egy Moodle-webszolgáltatást egy külső rendszerhez, amely a Moodle-t vezérli. Ezzel beállíthat egy jel- (biztonsági kulcs-) hitelesítési módot is.';
$string['operation'] = 'Művelet';
$string['optional'] = 'Választható';
$string['passwordisexpired'] = 'A jelszó lejárt.';
$string['phpparam'] = 'XML-RPC (PHP-struktúra)';
$string['phpresponse'] = 'XML-RPC (PHP-struktúra)';
$string['postrestparam'] = 'PHP-kód REST-hez (POST-kérés)';
$string['potusers'] = 'Jogosulatlan felhasználók';
$string['potusersmatching'] = 'Egyező jogosulatlan felhasználók';
$string['print'] = 'Az összes nyomtatása';
$string['protocol'] = 'Protokoll';
$string['protocolnotallowed'] = 'Nem használhatja a(z) {$a} protokollt (hiányzó képesség: webservice/{$a}:használat)';
$string['removefunction'] = 'Eltávolítás';
$string['removefunctionconfirm'] = 'Eltávolítja a(z) "{$a->function}" feladatot a(z) "{$a->service}" szolgáltatásból?';
$string['requireauthentication'] = 'Ez a metódus xxx engedéllyel rendelkező hitelesítést ír elő.';
$string['required'] = 'Előírt';
$string['requiredcapability'] = 'Előírt képesség';
$string['requiredcapability_help'] = 'Beállítása esetén csak az előírt képességgel rendelkező felhasználók vehetik igénybe a szolgáltatást.';
$string['requiredcaps'] = 'Előírt képességek';
$string['resettokenconfirm'] = 'Biztosan visszaállítja <strong>{$a->user}</strong> webszolgáltatási kulcsát <strong>{$a->service}</strong> szolgáltatás esetén?';
$string['resettokenconfirmsimple'] = 'Biztosan visszaállítja a kulcsot? A régi kulcshoz tartozó ugrópontok nem fognak működni.';
$string['response'] = 'Válasz';
$string['restcode'] = 'REST';
$string['restexception'] = 'REST';
$string['restoredaccountresetpassword'] = 'Jel beszerzése előtt helyreállított fiók esetén ismét be kell állítani a jelszót.';
$string['restparam'] = 'REST (POST-paraméterek)';
$string['restrictedusers'] = 'Csak jogosult felhasználók';
$string['restrictedusers_help'] = 'Itt állítja be, hogy a webszolgáltatási jel létrehozásához engedéllyel rendelkezők biztonsági kulcsok oldalán állíthatnak-e elő jelet a szolgáltatáshoz, vagy csak az erre jogosultak tehetik ezt meg.';
$string['securitykey'] = 'Biztonsági kulcs (jel)';
$string['securitykeys'] = 'Biztonsági kulcsok';
$string['selectauthorisedusers'] = 'Engedéllyel rendelkezők kiválasztása';
$string['selectedcapability'] = 'Kiválasztott';
$string['selectedcapabilitydoesntexit'] = 'A beállított előírt képesség ({$a}) már nem létezik. Módosítsa és mentse el a változtatásokat.';
$string['selectservice'] = 'Szolgáltatás kiválasztása';
$string['selectspecificuser'] = 'Konkrét felhasználó kiválasztása';
$string['selectspecificuserdescription'] = 'A webszolgáltatás felhasználójának jogosult felhasználóként való hozzáadása.';
$string['service'] = 'Szolgáltatás';
$string['servicehelpexplanation'] = 'A szolgáltatás funkciók készlete. A szolgáltatást igénybe veheti minden felhasználó, vagy  csak meghatározott felhasználók.';
$string['servicename'] = 'Szolgáltatás neve';
$string['servicenotavailable'] = 'A webszolgáltatás nem érhető el (nem létezik vagy ki van kapcsolva).';
$string['servicesbuiltin'] = 'Beépített szolgáltatások';
$string['servicescustom'] = 'Egyedi szolgáltatások';
$string['serviceusers'] = 'Jogosult felhasználók';
$string['serviceusersettings'] = 'Felhasználói beállítások';
$string['serviceusersmatching'] = 'Egyező jogosult felhasználók';
$string['serviceuserssettings'] = 'Jogosult felhasználók beállításainak módosítása';
$string['simpleauthlog'] = 'Belépés egyszerű hitelesítéssel';
$string['step'] = 'Lépés';
$string['testauserwithtestclientdescription'] = 'A szolgáltatás külső elérését szimulálja a webszolgáltatás tesztügyfele segítségével. Áttérés előtt lépjen be mint moodle/webservice:createtoken képességgel rendelkező felhasználó, a biztonsági kulcsot (jelet) a "Profilom" beállításaiból szerezze be. Ezt a jelet fogja tesztügyfélként használni. A tesztügyfél alatt jelhitelesítéssel válasszon ki egy bekapcsolt protokollt is. <strong>Vigyázat: a tesztelendő funkciók VÉGREHAJTÓDNAK, ügyeljen arra, hogy mit fog tesztelni!!!</strong>';
$string['testclient'] = 'Webszolgáltatást tesztelő kliens';
$string['testclientdescription'] = '* A webszolgáltatás tesztügyfele <strong>ÉLESBEN</strong> végrehajtja a <strong>FUNKCIÓKAT</strong>. Ismeretlen funkciót ne teszteljen! <br/>* A webszolgáltatás összes létező funkciója még nincs beépítve a tesztügyfélbe. <br/>* Annak ellenőrzésére, hogy egy felhasználó bizonyos funkciókat nem tud elérni, kipróbálhat olyan funkciókat, amelyeket nem engedélyezett.<br/>* Egyértelműbb hibaüzenetekhez állítsa a hibaszűrést <strong>{$a->mode}</strong> módra itt: {$a->atag}<br/>* Térjen át ide: {$a->amfatag}.';
$string['testwithtestclient'] = 'A szolgáltatás tesztelése';
$string['testwithtestclientdescription'] = 'A szolgáltatás külső elérését szimulálja a webszolgáltatás tesztügyfele segítségével. Használjon bekapcsolt protokollt jelhitelesítéssel. <strong>Vigyázat: a tesztelendő funkciók VÉGREHAJTÓDNAK, ügyeljen arra, hogy mit fog tesztelni!!!</strong>';
$string['token'] = 'Lexikális elem';
$string['tokenauthlog'] = 'Jelhitelesítés';
$string['tokencreatedbyadmin'] = 'Csak rendszergazda (*) állíthatja vissza';
$string['tokencreator'] = 'Jelelőállító';
$string['unknownoptionkey'] = 'Ismeretlen opciókulcs ({$a})';
$string['updateusersettings'] = 'Frissítés';
$string['userasclients'] = 'Felhasználók mint jellel rendelkező ügyfelek';
$string['userasclientsdescription'] = 'Az alábbi módon állíthatja be a Moodle-webszolgáltatást ügyfél felhasználók számára. Eközben beállíthatja az ajánlott jel- (biztonsági kulcs-) hitelesítési módszert is. Ez esetben a felhasználó jelét a biztonsági kulcsok oldalán a Profilom beállításaiból állítja elő.';
$string['usermissingcaps'] = 'Hiányzó képességek: {$a}.';
$string['usernameorid'] = 'Felhasználónév/-azonosító';
$string['usernameorid_help'] = 'Adjon meg egy felhasználónevet vagy -azonosítót.';
$string['usernameoridnousererror'] = 'Ezzel a felhasználónévvel/-azonosítóval nincs felhasználó';
$string['usernameoridoccurenceerror'] = 'Ezzel a felhasználónévvel több felhasználó található. Adja meg a felhasználói azonosítót.';
$string['usernotallowed'] = 'A szolgáltatást a felhasználó nem veheti igénybe. Először engedélyezze az engedéllyel rendelkező felhasználókat kezelő {$a} oldalon.';
$string['usersettingssaved'] = 'Felhasználói beállítások elmentve';
$string['validuntil'] = 'Érvényességi idő';
$string['validuntil_help'] = 'Beállítása esetén a szolgáltatás a felhasználó részére ezen időpont után kikapcsol.';
$string['webservice'] = 'Webszolgáltatás';
$string['webservices'] = 'Webszolgáltatások';
$string['webservicesoverview'] = 'Áttekintés';
$string['webservicetokens'] = 'Webszolgáltatás lexikális elemei';
$string['wrongusernamepassword'] = 'Hibás felhasználónév vagy jelszó';
$string['wsaccessuserdeleted'] = '{$a} törölt felhasználónév miatt a webszolgáltatás elérése visszautasítva';
$string['wsaccessuserexpired'] = '{$a} lejárt jelszavas felhasználónév miatt a webszolgáltatás elérése visszautasítva';
$string['wsaccessusernologin'] = '{$a} be nem jelentkezett hitelesítési felhasználónév miatt a webszolgáltatás elérése visszautasítva';
$string['wsaccessusersuspended'] = '{$a} felfüggesztettt felhasználónév miatt a webszolgáltatás elérése visszautasítva';
$string['wsaccessuserunconfirmed'] = '{$a} visszaigazolatlan felhasználónév miatt a webszolgáltatás elérése visszautasítva';
$string['wsauthmissing'] = 'Hiányzik a webszolgáltatás hitelesítési segédprogramja';
$string['wsauthnotenabled'] = 'A webszolgáltatás hitelesítési segédprogramja ki van kapcsolva';
$string['wsclientdoc'] = 'A Moodle-webszolgáltatás ügyfél-dokumentációja';
$string['wsdocapi'] = 'Az alkalmazás dokumentációja';
$string['wsdocumentation'] = 'Webszolgáltatás dokumentációja';
$string['wsdocumentationdisable'] = 'A webszolgáltatás dokumentációja ki van kapcsolva';
$string['wsdocumentationintro'] = 'Alább látható a <b>{$a}</b> felhasználónévhez elérhető webszolgáltatások felsorolása.<br/>Kliens létrehozásához olvassa el a <a href="http://docs.moodle.org/en/Development:Creating_a_web_service_and_a_web_service_function#Create_your_own_client">Moodle dokumentációját</a>.';
$string['wsdocumentationlogin'] = 'Adja meg webszolgáltatási felhasználónevét és jelszavát.';
$string['wspassword'] = 'Webszolgáltatási jelszó';
$string['wsusername'] = 'Webszolgáltatási felhasználónév';
