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
 * Strings for component 'mnet', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['RPC_HTTPS_SELF_SIGNED'] = 'HTTPS (saját aláírású)';
$string['RPC_HTTPS_VERIFIED'] = 'HTTPS (aláírt)';
$string['RPC_HTTP_PLAINTEXT'] = 'kódolatlan HTTP';
$string['RPC_HTTP_SELF_SIGNED'] = 'HTTP (saját aláírású)';
$string['RPC_HTTP_VERIFIED'] = 'HTTP (aláírt)';
$string['aboutyourhost'] = 'Szerverének névjegye';
$string['accesslevel'] = 'Hozzáférési szint';
$string['addhost'] = 'Gazdagép hozzáadása';
$string['addnewhost'] = 'Új gazdagép hozzáadása';
$string['addtoacl'] = 'Hozzáadás a hozzáférés-vezérléshez';
$string['allhosts'] = 'Minden gazdagép';
$string['allhosts_no_options'] = 'Több gazdagép megtekintése esetén nincsenek választási lehetőségek';
$string['allow'] = 'Engedélyez';
$string['applicationtype'] = 'Alkalmazás típusa';
$string['authfail_nosessionexists'] = 'Hitelesítés sikertelen: az mnet-folyamat nem létezik.';
$string['authfail_sessiontimedout'] = 'Hitelesítés sikertelen: az mnet-folyamat ideje lejárt.';
$string['authfail_usermismatch'] = 'Hitelesítés sikertelen: a felhasználók nem egyeznek.';
$string['authmnetdisabled'] = 'A hálózati Moodle hitelesítési segédprogramja ki van kapcsolva.';
$string['badcert'] = 'A tanúsítvány nem érvényes.';
$string['certdetails'] = 'Hitelesítés adatai';
$string['configmnet'] = 'A Moodle-hálózat révén ez a szerver más szerverekkel vagy szolgáltatásokkal kommunikálhat.';
$string['couldnotgetcert'] = 'Nincs tanúsítvány itt: {$a}. Lehet, hogy a gazdagép nem működik vagy rosszul van konfigurálva.';
$string['couldnotmatchcert'] = 'A tanúsítvány nem egyezik a jelenleg a webszerver által kiadottal.';
$string['courses'] = 'kurzusok';
$string['courseson'] = 'kurzusok itt:';
$string['current_transport'] = 'Aktuális továbbítás';
$string['currentkey'] = 'Aktuális nyilvános kulcs';
$string['databaseerror'] = 'Nem lehetett adatokat írni az adatbázisba.';
$string['deleteaserver'] = 'Egy szerver törlése';
$string['deletedhostinfo'] = 'A gazdagépet törölték. Ha vissza akarja állítani, a törölt állapotot állítsa át "Nem"-re.';
$string['deletedhosts'] = '{$a} gazdagépek törlése';
$string['deletehost'] = 'Gazdagép törlése';
$string['deletekeycheck'] = 'Biztosan törli a kulcsot?';
$string['deleteoutoftime'] = 'A kulcs törlésére rendelkezésre álló 60 másodperc lejárt. Kezdje el újból.';
$string['deleteuserrecord'] = 'SSO ACL: \'{$a->user}\' felhasználó rekordjának törlése a(z) {$a->host} gazdagépről.';
$string['deletewrongkeyvalue'] = 'Hiba történt. Ha nem próbálta a szervere SSL-kulcsát törölni, előfordulhat, hogy rosszindulatú támadásnak esett áldozatul. Semmilyen intézkedésre nem került sor.';
$string['deny'] = 'Tilt';
$string['description'] = 'Leírás';
$string['duplicate_usernames'] = 'Nem sikerült táblázatában indexet létrehozni az "mnethostid" és a "username" oszlopokhoz. <br />Ez olyankor fordulhat elő, ha <a href="{$a}" target="_blank">dupla felhasználónevek szerepelnek felhasználói táblázatában</a>.<br />Ettől függetlenül frissítésének sikeresen kell lezajlania. A fenti ugrópontra kattintva új ablakban utasításokat talál a probléma kezelésével kapcsolatosan. Ezzel ráér foglalkozni a frissítés végén.';
$string['enabled_for_all'] = '(Ez a szolgáltatás minden gazdagép részére be van kapcsolva).';
$string['enterausername'] = 'Adjon meg egy felhasználónevet vagy felhasználónevek vesszővel elválasztott felsorolását.';
$string['error7020'] = 'Ez a hiba általában akkor fordul elő, ha a távoli portál létrehozott Önnek egy hibás wwwroot-tal rendelkező rekordot, pl. http://portalja.com a http://www.portalja.com helyett. Forduljon a (config.php-ben megadott) wwwroot-tal a távoli portál rendszergazdájához és kérje meg, hogy frissítse az Ön gazdagépére vonatkozó rekordját.';
$string['error7022'] = 'A távoli portálra küldött üzenete rendesen volt kódolva, de nem volt aláírva. Váratlan probléma; küldjön egy hibajelentést, ha ez előfordul (a lehető legtöbb információt adjon meg a Moodle adott változatáról stb.)';
$string['error7023'] = 'A távoli portál az Ön portáljára vonatkozó összes nála lévő kulccsal megpróbálta kikódolni üzenetét. Ez nem sikerült. Előfordulhat, hogy el tudja hárítani a problémát, ha kézzel újból kapcsolatot teremt a távoli portállal. Ez aligha fordul elő, hacsak a távoli portállal hónapokon át nem kommunikált.';
$string['error7024'] = 'A távoli portálra küldött üzenete nem volt kódolva, de az nem fogad kódolatlan adatokat a portáljáról. Váratlan probléma; küldjön egy hibajelentést, ha ez előfordul (a lehető legtöbb információt adjon meg a Moodle adott változatáról stb.)';
$string['error7026'] = 'Az üzenete aláírására használt kulcs eltér attól, amit a távoli gazdagép az Ön szerveréről tárol. A távoli gazdagép megpróbálta elérni mostani kulcsát, de sikertelenül. Kézzel lépjen kapcsolatba a távoli gazdagéppel és újra adja meg a kulcsot.';
$string['error709'] = 'A távoli portálnak nem sikerült SSL-kulcsot kapni Öntől.';
$string['expired'] = 'A kulcs lejárt ekkor';
$string['expires'] = 'Érvényesség lejárata';
$string['expireyourkey'] = 'Kulcs törlése';
$string['expireyourkeyexplain'] = 'A Moodle automatikusan (alapbeállításban) 28 naponként cseréli kulcsait, de
lehetősége van kézi úton bármikor érvényteleníteni a kulcsot. Ez csak akkor
bizonyul hasznosnak, ha biztos abban, hogy a kulcsot illetéktelenek
piszkálták. A rendszer azonnal automatikusan előállít egy másikat. A
kulcs törlése miatt más alkalmazásokkal nem fog tudni kommunikálni
mindaddig, amíg  kézzel az összes rendszergazdának meg nem adja új
kulcsát.';
$string['exportfields'] = 'Exportálandó mezők';
$string['failedaclwrite'] = 'Az MNET hozzáférés-vezérlési listához \'{$a}\' felhasználó esetén nem sikerült a hozzáírás.';
$string['findlogin'] = 'Belépés megkeresése';
$string['forbidden-function'] = 'Ez a funkció nincs bekapcsolva az RPC-hez.';
$string['forbidden-transport'] = 'A használni kívánt továbbítási módszer nincs engedélyezve.';
$string['forcesavechanges'] = 'Változások mentése kötelező';
$string['helpnetworksettings'] = 'Moodle-ok közötti kommunikáció beállítása';
$string['hidelocal'] = 'Helyi felhasználók elrejtése';
$string['hideremote'] = 'Távoli felhasználók elrejtése';
$string['host'] = 'gazdagép';
$string['hostcoursenotfound'] = 'Nincs gazdagép vagy kurzus';
$string['hostdeleted'] = 'Gazdagép törölve';
$string['hostexists'] = 'Ezzel a gazdagépnévvel már létezik rekord. A rekord szerkesztéséhez kattintson ide: {$a}.';
$string['hostlist'] = 'Hálózatba kötött gazdagépek felsorolása';
$string['hostname'] = 'Gazdagép neve';
$string['hostnamehelp'] = 'A távoli gazdagép teljesen érvényes doménneve, pl. www.pelda.com';
$string['hostnotconfiguredforsso'] = 'A szerver nincs távoli belépésre beállítva.';
$string['hostsettings'] = 'Gazdagép beállításai';
$string['http_self_signed_help'] = 'A távoli gazdagépen saját aláírású DIY SSL-tanúsítvánnyal való csatlakozások engedélyezése.';
$string['http_verified_help'] = 'A távoli gazdagépen PHP-ben ellenőrzött, de http-n (nem https-en) keresztüli, SSL-tanúsítvánnyal való csatlakozások engedélyezése.';
$string['https_self_signed_help'] = 'A távoli gazdagépen PHP-ben saját aláírású DIY SSL-tanúsítvánnyal való http-n keresztüli csatlakozások engedélyezése.';
$string['https_verified_help'] = 'A távoli gazdagépen ellenőrzött SSL-tanúsítvánnyal való csatlakozások engedélyezése.';
$string['id'] = 'Azonosító';
$string['idhelp'] = 'Az érték hozzárendelése automatikus és nem módosítható';
$string['importfields'] = 'Importálandó mezők';
$string['inspect'] = 'Vizsgálat';
$string['installnosuchfunction'] = 'Kódolási hiba! Valami egy mnet xmlrpc funkciót ({$a->method}) próbál egy ({$a->file}) fájlból telepíteni, amely nem található!';
$string['installnosuchmethod'] = 'Kódolási hiba! Valami egy mnet xmlrpc metódust ({$a->method}) próbál egy ({$a->class}) osztályra telepíteni, amely nem található!';
$string['installreflectionclasserror'] = 'Kódolási hiba! Az mnet ({$a->method}) metódus vizsgálata ({$a->class}) osztályban nem sikerült. Az eredeti hibaüzenet, ha netán segít, a következő: \'{$a->error}\'.';
$string['installreflectionfunctionerror'] = 'Kódolási hiba! Az mnet ({$a->method}) funkció vizsgálata ({$a->file}) fájlban nem sikerült. Az eredeti hibaüzenet, ha netán segít, a következő: \'{$a->error}\'.';
$string['invalidaccessparam'] = 'Érvénytelen hozzáférési paraméter.';
$string['invalidactionparam'] = 'Érvénytelen tevékenységparaméter.';
$string['invalidhost'] = 'Érvényes gazdagép-azonosítót kell megadnia';
$string['invalidpubkey'] = 'A kulcs nem érvényes SSL-kulcs ({$a}).';
$string['invalidurl'] = 'Érvénytelen URL-paraméter.';
$string['ipaddress'] = 'IP-cím';
$string['is_in_range'] = 'A(z) {$a} IP-cím egy érvényes és megbízható gazdagépé.';
$string['ispublished'] = '{$a} ezt a szolgáltatást bekapcsolta Önnek.';
$string['issubscribed'] = '{$a} feliratkozik gazdagépén erre a szolgáltatásra.';
$string['keydeleted'] = 'Kulcsának törlése és cseréje sikerült.';
$string['keymismatch'] = 'A gazdagéphez Önnél lévő nyilvános kulcs eltér az általa aktuálisan közreadott nyilvános kulcstól, amely a következő:';
$string['last_connect_time'] = 'Utolsó kapcsolódás időpontja';
$string['last_connect_time_help'] = 'A gazdagépre csatlakozásának utolsó időpontja.';
$string['last_transport_help'] = 'A gazdagépre való utolsó csatlakozása során használt továbbítás.';
$string['leavedefault'] = 'E helyett az alapbeállítások használata';
$string['listservices'] = 'Szolgáltatások felsorolása';
$string['loginlinkmnetuser'] = '<br />Ha Ön távoli hálózati Moodle-felhasználó és <a href="{$a}"> itt meg
tudja erősíteni e-mail címét</a>, akkor átkerülhet a belépési oldalra.
<br />';
$string['logs'] = 'naplók';
$string['managemnetpeers'] = 'Társgépek kezelése';
$string['method'] = 'Metódus';
$string['methodhelp'] = 'Segítség {$a} metódushoz';
$string['methodsavailableonhost'] = '{$a} elérhető metódusai';
$string['methodsavailableonhostinservice'] = '{$a->service} szolgáltatás {$a->host} gazdagépen elérhető metódusai';
$string['methodsignature'] = '{$a} aláírási metódusa';
$string['mnet'] = 'Hálózati Moodle';
$string['mnet_concatenate_strings'] = '(Legfeljebb) 3 szövegdarab összefűzése és az eredmény visszaadása';
$string['mnet_session_prohibited'] = 'Saját szerverének felhasználói jelenleg nem látogathatnak el ide: {$a}.';
$string['mnetdisabled'] = 'A hálózati Moodle ki van kapcsolva.';
$string['mnetidprovider'] = 'MNET-azonosító szolgáltatója';
$string['mnetidproviderdesc'] = 'Ezzel elérhet egy belépésre használható ugrópontot, ha helyes e-mail címet tud megadni, amely megegyezik a korábban belépésre használt felhasználónévvel.';
$string['mnetidprovidermsg'] = '{$a} szolgáltatójánál kell a belépést megejtenie';
$string['mnetidprovidernotfound'] = 'Nincs további információ.';
$string['mnetlog'] = 'Naplók';
$string['mnetpeers'] = 'Társgépek';
$string['mnetservices'] = 'Szolgáltatások';
$string['mnetsettings'] = 'A hálózati Moodle beállításai';
$string['moodle_home_help'] = 'Az útvonal a távoli gazdagépen futó hálózati Moodle alkalmazásának honlapjához, pl. /moodle/.';
$string['name'] = 'Név';
$string['net'] = 'Hálózati működtetés';
$string['networksettings'] = 'Hálózati beállítások';
$string['never'] = 'Soha';
$string['noaclentries'] = 'Nincs bejegyzés az SSO-hozzáférésvezérlési listán';
$string['noaddressforhost'] = 'A gazdagép nevét ({$a}) nem lehet azonosítani!';
$string['nocurl'] = 'A PHP cURL könyvtára nincs telepítve.';
$string['nolocaluser'] = 'Nincs és nem is hozható létre helyi rekord a távoli felhasználóhoz, mert a gazdagép automatikusan nem hoz létre felhasználókat.
Forduljon a rendszergazdához!';
$string['nomodifyacl'] = 'Nem módosíthatja a hálózati Moodle hozzáférés-vezérlési listáját.';
$string['nonmatchingcert'] = 'A tanúsítvány tárgya: <br /><em>{$a->subject}</em><br />;nem egyezik azzal a gazdagéppel, ahonnan érkezett: <br /><em>{$a->host}</em>.';
$string['nopubkey'] = 'A nyilvános kulcs elérése körül probléma adódott. Lehet, hogy a gazdagép nem engedélyezi a hálózati Moodle használatát, esetleg a kulcs érvénytelen lehet.';
$string['nosite'] = 'Nem található portálszintű kurzus';
$string['nosuchfile'] = 'A(z) {$a} állomány/függvény nem létezik.';
$string['nosuchfunction'] = 'A függvény nem található vagy tiltott az RPC-hez.';
$string['nosuchmodule'] = 'A függvény hibás címzésű vagy nem található. Használja a mod/modulename/lib/functionname formát.';
$string['nosuchpublickey'] = 'Nem érhető el nyilvános kulcs az aláírás-ellenőrzéshez.';
$string['nosuchservice'] = 'Az RPC-szolgáltatás ezen a gazdagépen nem működik.';
$string['nosuchtransport'] = 'Nincs ilyen azonosítójú továbbítás.';
$string['notBASE64'] = 'A szöveg formája nem base64 kódolású. Nem lehet érvényes a kulcs.';
$string['notPEM'] = 'A kulcs nem PEM-formájú. Nem fog működni.';
$string['not_in_range'] = 'A(z) {$a} IP-cím nem egy érvényes és megbízható gazdagépé.';
$string['notenoughidpinfo'] = 'Azonosítási szolgáltatója nem ad elég adatot fiókjának helyi létrehozásához vagy frissítéséhez.';
$string['notinxmlrpcserver'] = 'A távoli hálózati Moodle elérése nem az XMLRPC szerver futása közben történt';
$string['notmoodleapplication'] = 'FIGYELEM: Ez nem egy Moodle alkalmazás, ezért egyes vizsgáló metódusok esetleg nem megfelelően fognak működni.';
$string['notpermittedtojump'] = 'Nem indíthat távoli folyamatot erről a Moodle-szerverről.';
$string['notpermittedtojumpas'] = 'Ha másik felhasználóként van bejelentkezve, nem indíthat el távoli folyamatot.';
$string['notpermittedtoland'] = 'Nincs engedélye távoli folyamat elkezdéséhez.';
$string['off'] = 'Ki';
$string['on'] = 'Be';
$string['options'] = 'Beállítások';
$string['peerprofilefielddesc'] = 'Itt felülírhatja a küldési és importálási profilmezők globális beállításait új felhasználók létrehozásához.';
$string['permittedtransports'] = 'Engedélyezett továbbítások';
$string['phperror'] = 'Belső PHP-hiba miatt kérése nem teljesíthető.';
$string['position'] = 'Helyzet';
$string['postrequired'] = 'A törléshez POST-kérés szükséges.';
$string['profileexportfields'] = 'Küldendő mezők';
$string['profilefielddesc'] = 'Itt beállíthatja azon profilmezők listáját, amelyek küldése és fogadása felhasználói fiókok létrehozása vagy frissítése során a hálózati Moodle-on keresztül zajlik. Ezeket az egyes társhálózatok esetén egyenként felülírhatja. AZ alábbi mezők elküldése mindenkor megtörténik, választásra nincs lehetőség: {$a}.';
$string['profilefields'] = 'Profilmezők';
$string['profileimportfields'] = 'Importálandó mezők';
$string['promiscuous'] = 'Szabad';
$string['publickey'] = 'Nyilvános kulcs';
$string['publickey_help'] = 'A nyilvános kulcsot a távoli szerver automatikusan biztosítja.';
$string['publickeyrequired'] = 'Adjon meg egy nyilvános kulcsot.';
$string['publish'] = 'Közzététel';
$string['reallydeleteserver'] = 'Biztosan törli a szervert?';
$string['receivedwarnings'] = 'Az alábbi figyelmeztetések érkeztek';
$string['recordnoexists'] = 'Nem létezik ilyen rekord.';
$string['reenableserver'] = 'Nem - válassza ezt a lehetőséget a szerver újbóli bekapcsolásához.';
$string['registerallhosts'] = 'Az összes gazdagép regisztrálása (kevert mód)';
$string['registerallhostsexplain'] = 'Automatikusan regisztrálhatja az összes kapcsolódni próbáló gazdagépet. Ekkor egy rekord jelenik meg gazdagépeinek listáján minden olyan hálózati Moodle-portálhoz, amely Önhöz csatlakozik és nyilvános kulcsát kéri.<br />Beállíthatja az alábbiakban az \'Összes gazdagép\' részére a szolgáltatásokat, és némelyikük bekapcsolásával kivétel nélkül bármelyik távoli szervernek nyújthat szolgáltatást.';
$string['registerhostsoff'] = 'Az összes gazdagép regisztrálása jelenleg <b>ki van kapcsolva</b>';
$string['registerhostson'] = 'Az összes gazdagép regisztrálása jelenleg <b>be van kapcsolva</b>';
$string['remotecourses'] = 'Távoli kurzusok';
$string['remotehost'] = 'Távoli gazdagép';
$string['remotehosts'] = 'Távoli gazdagépek';
$string['remoteuserinfo'] = 'Távoli {$a->remotetype} felhasználói profil érkezett innen: <a href="{$a->remoteurl}">{$a->remotename}</a>';
$string['requiresopenssl'] = 'A hálózati működtetéshez OpenSSL-bővítményre van szükség';
$string['restore'] = 'Helyreállítás';
$string['returnvalue'] = 'Visszatérési érték';
$string['reviewhostdetails'] = 'Gazdagép adatainak ellenőrzése';
$string['reviewhostservices'] = 'Gazdagép szolgáltatásainak ellenőrzése';
$string['selectaccesslevel'] = 'A felsorolásból válasszon ki egy hozzáférési szintet.';
$string['selectahost'] = 'Válasszon ki egy távoli gazdagépet.';
$string['service'] = 'Szolgáltatás neve';
$string['serviceid'] = 'Szolgáltatás azonosítója';
$string['servicesavailableonhost'] = 'Szolgáltatás elérhető: {$a}';
$string['serviceswepublish'] = 'A(z) {$a} felé általunk nyújtott szolgáltatás.';
$string['serviceswesubscribeto'] = 'A(z) {$a}-n általunk igénybe vett szolgáltatás.';
$string['settings'] = 'Beállítások';
$string['showlocal'] = 'Helyi felhasználók megjelenítése';
$string['showremote'] = 'Távoli felhasználók megjelenítése';
$string['ssl_acl_allow'] = 'SSO ACL: {$a->user} felhasználó engedélyezése {$a->host} gazdagépről';
$string['ssl_acl_deny'] = 'SSO ACL: {$a->user} felhasználó tiltása {$a->host} gazdagépről';
$string['ssoaccesscontrol'] = 'SSO hozzáférés-vezérlés';
$string['ssoacldescr'] = 'Ezen az oldalon távoli hálózati Moodle-gazdagépek konkrét felhasználói részére biztosíthat/tilthat hozzáférést. Ez csak akkor működik, ha SSO-szolgáltatást kínál távoli felhasználók részére. A helyi felhasználók részére egyéb hálózati Moodle-gazdagépekre való ellátogatást a szereprendszer segítségével a mnetlogintoremote révén biztosíthat.';
$string['ssoaclneeds'] = 'Ahhoz, hogy ez a funkció működjék, be kell kapcsolnia a hálózati Moodle-t, emellett a hálózati Moodle hitelesítési segédprogramnak is bekapcsolt állapotban kell lenni.';
$string['strict'] = 'Szigorú';
$string['subscribe'] = 'Feliratkozás';
$string['system'] = 'Rendszer';
$string['testclient'] = 'Hálózati Moodle tesztelő kliense';
$string['testtrustedhosts'] = 'Cím ellenőrzése';
$string['testtrustedhostsexplain'] = 'A gazdagép megbízhatóságának ellenőrzésére adjon meg egy IP-címet.';
$string['theypublish'] = 'Közzétevők';
$string['theysubscribe'] = 'Feliratkozók';
$string['transport_help'] = 'Ezek a lehetőségek kölcsönösek, így egy távoli gazdagépen aláírt SSL-tanúsítvány használatát csak akkor írhatja elő, ha szervere szintén rendelkezik aláírt SSL-tanúsítvánnyal.';
$string['trustedhosts'] = 'XML-RPC-gazdagépek';
$string['trustedhostsexplain'] = 'A megbízható gazdagépeken alapuló mechanizmus révén meghatározott gépek eljárásokat hívhatnak meg XML-RPC-n keresztül a Moodle felületének bármely részéről.
Ezzel szabályozható a Moodle viselkedése, ezért bekapcsolása igen nagy veszélyekkel járhat. Ha kételye támad, ne kapcsolja be.
Erre a Moodle hálózati működtetéséhez nincs szükség. Bekapcsolásához adjon meg soronként egy-egy IP-címet vagy hálózatot. Például:
Helyi gazdagépe: 127.0.0.1 Helyi gazdagépe (hálózati blokkal):127.0.0.1/32 Csak a 192.168.0.7 IP-címmel rendelkező gazdagép: 192.168.0.7/32 Bármely 192.168.0.1 és 192.168.0.255 közötti IP-címmel rendelkező gazdagép: 192.168.0.0/24 Tetszőleges gazdagép:192.168.0.0/0 Nyilván ezen utóbbi példa használata nem egy ajánlott konfiguráció.';
$string['turnitoff'] = 'Kikapcsolás';
$string['turniton'] = 'Bekapcsolás';
$string['type'] = 'Típus';
$string['unknown'] = 'Ismeretlen';
$string['unknownerror'] = 'Ismeretlen eredetű hiba történt kapcsolatteremtés közben.';
$string['usercannotchangepassword'] = 'A jelszót nem módosíthatja itt, mivel Ön távoli felhasználó.';
$string['userchangepasswordlink'] = 'Jelszavát <a href="{$a->wwwroot}/login/change_password.php">{$a->description}</a> szolgáltatójánál módosíthatja.';
$string['usernotfullysetup'] = 'Felhasználói fiókja hiányos. Térjen vissza <a href="{$a}"> szolgáltatójához </a> és töltesse ki profilját. Ehhez esetleg ki-, majd be kell jelentkeznie.';
$string['usersareonline'] = 'Figyelmeztetés: {$a} felhasználó van bejelentkezve portáljára arról a szerverről.';
$string['validated_by'] = 'Érvényesítő hálózata:  {$a}';
$string['verifysignature-error'] = 'Hiba miatt az aláírás-ellenőrzés sikertelen.';
$string['verifysignature-invalid'] = 'Az aláírás-ellenőrzés sikertelen; az azonosítást feltehetőleg nem Ön írta alá.';
$string['version'] = 'Verzió';
$string['warning'] = 'Figyelmeztetés';
$string['wrong-ip'] = 'IP-címe a nálunk nyilvántartottal nem egyezik.';
$string['xmlrpc-missing'] = 'Ennek használatához az XML-RPC-nek telepítve kell lennie PHP-rendszerében.';
$string['yourhost'] = 'Gazdagépe';
$string['yourpeers'] = 'Társgépei';
