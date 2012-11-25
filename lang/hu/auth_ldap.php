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
 * Strings for component 'auth_ldap', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_ldap_ad_create_req'] = 'Az aktív könyvtárban nem hozható létre az új fiók. Ellenőrizze, minden feltétel teljesült-e (LDAPS-csatlakozás, felhasználó megfelelő jogokkal stb.)';
$string['auth_ldap_attrcreators'] = 'Azon csoportok vagy környezetek felsorolása, melyek tagjai attribútumokat hozhatnak létre. A csoportokat pontosvesszővel válassza el egymástól. Pl.: \'cn=teachers,ou=staff,o=myorg\'.';
$string['auth_ldap_attrcreators_key'] = 'Attribútumok létrehozói';
$string['auth_ldap_auth_user_create_key'] = 'Felhasználók külső létrehozása';
$string['auth_ldap_bind_dn'] = 'Ha felhasználók kereséséhez felhasználó-társítást kíván használni, adja meg itt. Pl.: \'cn=ldapuser,ou=public,o=org\'.';
$string['auth_ldap_bind_dn_key'] = 'Megkülönböztetett név';
$string['auth_ldap_bind_pw'] = 'Társított felhasználó jelszava';
$string['auth_ldap_bind_pw_key'] = 'Jelszó';
$string['auth_ldap_bind_settings'] = 'Beállítások társítása';
$string['auth_ldap_changepasswordurl_key'] = 'Jelszómódosító URL';
$string['auth_ldap_contexts'] = 'A felhasználók helye szerinti környezetek. Pontosvesszővel válassza el a környezeteket. Pl.: \'ou=users,o=org; ou=others,o=org\'.';
$string['auth_ldap_contexts_key'] = 'Környezetek';
$string['auth_ldap_create_context'] = 'Ha engedélyezi felhasználók létrehozását e-mailben való megerősítéssel, adja meg, mely környezetben jönnek létre a felhasználók. Biztonsági okokból ez a környezet térjen el a többi felhasználóétól. A környezetet nem kell hozzáadnia az ldap_context-variable változóhoz, a Moodle automatikusan ebből a környezetből keresi ki a felhasználókat.<br /><b>Vigyázat!</b> A felhasználók létrehozásához módosítania kell a user_create() metódust az auth/ldap/auth.php fájlban.
auth_ldap_create_context';
$string['auth_ldap_create_context_key'] = 'Új felhasználók környezete';
$string['auth_ldap_create_error'] = 'Hiba felhasználó LDAP-ban való létrehozása közben';
$string['auth_ldap_creators'] = 'Azon csoportok vagy környezetek felsorolása, melyek tagjai új kurzusokat hozhatnak létre. A csoportokat pontosvesszővel válassza el. Pl.: \'cn=teachers,ou=staff,o=myorg\'.';
$string['auth_ldap_creators_key'] = 'Létrehozók';
$string['auth_ldap_expiration_desc'] = 'A Nem kiválasztásával kapcsolhatja ki a lejárt jelszó LDAP-ellenőrzését ahhoz, hogy a jelszólejárati idő kiolvasása közvetlenül az LDAP-ból történjék.';
$string['auth_ldap_expiration_key'] = 'Lejárat';
$string['auth_ldap_expiration_warning_desc'] = 'A jelszó lejáratára figyelmeztetés hány nappal korábban történjék.';
$string['auth_ldap_expiration_warning_key'] = 'Lejáratra figyelmeztetés';
$string['auth_ldap_expireattr_desc'] = 'Opcionális: felülírja azt az ldap-attribútumot, amely a jelszólejárati időt tárolja';
$string['auth_ldap_expireattr_key'] = 'Lejárat attribútuma';
$string['auth_ldap_graceattr_desc'] = 'Opcionális: felülírja a késedelmes belépés attribútumát';
$string['auth_ldap_gracelogin_key'] = 'Késedelmes belépés attribútuma';
$string['auth_ldap_gracelogins_desc'] = 'Az LDAP késedelmes belépési támogatásának bekapcsolása. A jelszó lejárata után a felhasználó beléphet, amíg a késedelmes belépés számlálója 0. Bekapcsolásakor a beállítás megjeleníti a lejárt belépési üzenetet, ha a jelszó lejárt.';
$string['auth_ldap_gracelogins_key'] = 'Késedelmes belépések';
$string['auth_ldap_groupecreators'] = 'Azon csoportok vagy környezetek listája, melyek tagjai létrehozhatnak csoportokat. A csoportokat válassza el pontosvesszővel egymástól. Általában például: \'cn=teachers,ou=staff,o=myorg\'.';
$string['auth_ldap_groupecreators_key'] = 'Csoportok létrehozói';
$string['auth_ldap_host_url'] = 'LDAP-gazdagép megadása URL-szerűen, pl. \'ldap://ldap.myorg.com/\' vagy \'ldaps://ldap.myorg.com/\' formában. A hiba esetén szükséges támogatáshoz az egyes szervereket válassza el pontosvesszővel.';
$string['auth_ldap_host_url_key'] = 'Gazdagép URL-je';
$string['auth_ldap_ldap_encoding'] = 'Az LDAP-szerver által használt kódolás megadása. Feltehetőleg utf-8, de az MS AD v2 alapkódolásként használhatja pl. a cp1252, cp1250 stb. kódolást.';
$string['auth_ldap_ldap_encoding_key'] = 'LDAP-kódolás';
$string['auth_ldap_login_settings'] = 'Belépési beállítások';
$string['auth_ldap_memberattribute'] = 'Opcionális: felülírja a felhasználók adott csoporthoz tartozást jellemző attribútumát. Ez általában a \'member\' [tag].';
$string['auth_ldap_memberattribute_isdn'] = 'Opcionális: felülírja a tagi attribútumértékek, azaz a 0 vagy az 1 kezelését.';
$string['auth_ldap_memberattribute_isdn_key'] = 'A tag attribútuma dn-t használ.';
$string['auth_ldap_memberattribute_key'] = 'Tag attribútuma';
$string['auth_ldap_no_mbstring'] = 'Ha az aktív könyvtárban felhasználókat kíván létrehozni, az mbstring-bővítményre lesz szüksége.';
$string['auth_ldap_noconnect'] = 'Az LDAP-modul nem tud erre a szerverre csatlakozni: {$a}.';
$string['auth_ldap_noconnect_all'] = 'Az LDAP-modul nem tud semelyik szerverre csatlakozni: {$a}.';
$string['auth_ldap_noextension'] = 'A PHP LDAP-modulja feltehetőleg nem elérhető. Telepítse és kapcsolja be, ha a hitelesítési segédprogramot használni kívánja.';
$string['auth_ldap_objectclass'] = 'Opcionális: felülírja az ldap_user_type-on a felhasználók elnevezésére/keresésére használt objectClass-t. Rendszerint nem szükséges módosítania.';
$string['auth_ldap_objectclass_key'] = 'Objektumosztály';
$string['auth_ldap_opt_deref'] = 'Meghatározza, hogy kereséskor a neveket hogyan kezelje a rendszer. A következő értékek közül választhat: "Nem" (LDAP_DEREF_NEVER) vagy "Igen" (LDAP_DEREF_ALWAYS).';
$string['auth_ldap_opt_deref_key'] = 'Álnevek hivatkozásának megszüntetése';
$string['auth_ldap_passtype'] = 'Az új vagy módosult jelszavak formájának megadása az LDAP-szerveren.';
$string['auth_ldap_passtype_key'] = 'A jelszó formája';
$string['auth_ldap_passwdexpire_settings'] = 'Az LDAP-jelszó lejáratának beállításai';
$string['auth_ldap_preventpassindb'] = 'Igen választása esetén a jelszavak nem kerülnek bele a Moodle adatbázisába.';
$string['auth_ldap_preventpassindb_key'] = 'Jelszavak elrejtése';
$string['auth_ldap_search_sub'] = 'Felhasználók keresése alkörnyezetekben.';
$string['auth_ldap_search_sub_key'] = 'Keresés alkörnyezetekben';
$string['auth_ldap_server_settings'] = 'Az LDAP-szerver beállításai';
$string['auth_ldap_unsupportedusertype'] = 'az auth: ldap user_create() nem támogatja a kiválasztott {$a} felhasználótípust.';
$string['auth_ldap_update_userinfo'] = 'Felhasználói adatok (keresztnév, vezetéknév, cím...) frissítése az LDAP-ból a Moodle-ba. Az adatillesztési beállításokat módosítsa igény szerint.';
$string['auth_ldap_user_attribute'] = 'Opcionális: felülírja a felhasználók elnevezésére/keresésére használt attribútumot. Rendszerint \'cn\'.';
$string['auth_ldap_user_attribute_key'] = 'Felhasználói attribútum';
$string['auth_ldap_user_exists'] = 'Ez az LDAP felhasználói név már létezik.';
$string['auth_ldap_user_settings'] = 'Felhasználók keresési beállításai';
$string['auth_ldap_user_type'] = 'Válassza ki a felhasználók eltárolásának módját az LDAP-ben. Ugyancsak ezzel állítható be a belépések lejáratának, a késedelmes belépéseknek és a felhasználók létrehozásának a mikéntje.';
$string['auth_ldap_user_type_key'] = 'Felhasználó típusa';
$string['auth_ldap_usertypeundefined'] = 'A config.user_type nincs definiálva, vagy az ldap_expirationtime2unix függvény nem támogatja a kiválasztott típus használatát!';
$string['auth_ldap_usertypeundefined2'] = 'A config.user_type nincs definiálva, vagy az ldap_unixi2expirationtime függvény nem támogatja a kiválasztott típus használatát!';
$string['auth_ldap_version'] = 'A szerver által használt LDAP-protokoll verziója';
$string['auth_ldap_version_key'] = 'Verzió';
$string['auth_ldapdescription'] = 'Ez a módszer lehetőséget ad a jogosultság külső LDAP-szerverrel történő ellenőrzésére. Ha a megadott név és jelszó érvényes, a Moodle egy új felhasználót hoz létre az adatbázisában. Ez a modul képes kiolvasni a felhasználó adatait az LDAP-ból, és kitölti a kötelező mezőket a Moodle-ban. Következő belépéskor már csak a felhasználónév és a jelszó ellenőrzésére kerül sor.';
$string['auth_ldapextrafields'] = 'Ezek a mezők nem kötelezőek. Néhány felhasználói adatmezőt a Moodle előre kitölthet az itt megadott LDAP-mezők adataival. Ha ezeket a mezőket üresen hagyja, semmilyen adat nem kerül át az LDAP-ból, és a Moodle az alapértelmezett értékeket fogja használni. Mindkét esetben belépés után a felhasználó módosíthatja a mezők értékeit.';
$string['auth_ldapnotinstalled'] = 'Nem használható az LDAP-hitelesítés. A PHP LDAP-modulja nincs telepítve.';
$string['auth_ntlmsso'] = 'NTLM SSO';
$string['auth_ntlmsso_enabled'] = 'Állítsa igenre és próbálja meg az egyszeres belépést az NTLM-doménen. <strong>Figyelem:</strong> ehhez további beállítás szükséges a webszerveren, lásd: <a href="http://docs.moodle.org/en/NTLM_authentication">http://docs.moodle.org/en/NTLM_authentication</a>.';
$string['auth_ntlmsso_enabled_key'] = 'Bekapcsolás';
$string['auth_ntlmsso_ie_fastpath'] = 'Az NTLM SSO gyors útvonal bekapcsolásához állítsa Igen-re (kihagy egyes lépéseket és csak MS Internet Explorer esetén lép működésbe).';
$string['auth_ntlmsso_ie_fastpath_key'] = 'MS IE gyors útvonal?';
$string['auth_ntlmsso_subnet'] = 'Beállítása esetén az SSO-val való próbálkozást csak ezen alhálózat kliensgépeivel hajtja végre. Formája: xxx.xxx.xxx.xxx/bitmask. Az alhálózatokat vesszővel (,) válassza el.';
$string['auth_ntlmsso_subnet_key'] = 'Alhálózat';
$string['auth_ntlmsso_type'] = 'A felhasználók hitelesítésére a webszerveren beállított hitelesítési mód (kétely esetén válassza az NTLM-et)';
$string['auth_ntlmsso_type_key'] = 'Hitelesítési típus';
$string['connectingldap'] = 'Csatlakozás az LDAP-szerverhez...';
$string['creatingtemptable'] = 'Átmeneti {$a} tábla létrehozása';
$string['didntfindexpiretime'] = 'A password_expire() nem talált lejárati időt.';
$string['didntgetusersfromldap'] = 'Az LDAP nem szolgáltatott semmilyen felhasználót -- hiba? -- kilépés';
$string['gotcountrecordsfromldap'] = 'Az LDAP {$a} rekordot szolgáltatott';
$string['morethanoneuser'] = 'Furcsa! Az LDAP-ban egynél több felhasználói rekord szerepel. Csak az elsőt használjuk.';
$string['needbcmath'] = 'Az aktív könyvtárral késedelmes belépéshez a BCMath bővítményre van szüksége';
$string['needmbstring'] = 'Az aktív könyvtárral jelszómódosításhoz az mbstring bővítményre van szüksége';
$string['nodnforusername'] = 'Hiba a user_update_password() esetén. Nincs DN ehhez: {$a->username}';
$string['noemail'] = 'Nem sikerült Önnek e-mailt küldeni!';
$string['notcalledfromserver'] = 'A webszerverről nem szabad meghívni!';
$string['noupdatestobedone'] = 'Nincs frissítendő.';
$string['nouserentriestoremove'] = 'Nincs törlendő felhasználói bejegyzés';
$string['nouserentriestorevive'] = 'Nincs visszaállítandó felhasználói bejegyzés';
$string['nouserstobeadded'] = 'Nincs hozzáadandó felhasználó';
$string['ntlmsso_attempting'] = 'Egyszeres belépés megpróbálása NTLM-en keresztül...';
$string['ntlmsso_failed'] = 'Az automatikus belépés nem sikerült, próbálkozzék a szokásos belépési oldallal...';
$string['ntlmsso_isdisabled'] = 'Az NTLM SSO ki van kapcsolva.';
$string['ntlmsso_unknowntype'] = 'Ismeretlen típusú ntlmsso!';
$string['pluginname'] = 'LDAP-szerver';
$string['pluginnotenabled'] = 'A segédprogram nincs bekapcsolva!';
$string['renamingnotallowed'] = 'LDAP esetén a felhasználó átnevezése nem engedélyezett';
$string['rootdseerror'] = 'Hiba az aktív könyvtárhoz való rootDSE lekérdezése közben';
$string['updatepasserror'] = 'Hiba a user_update_password() esetén. Hiba kódja: {$a->errno}; hiba szövege: {$a->errstring}';
$string['updatepasserrorexpire'] = 'Hiba a user_update_password() esetén a jelszólejárati idő beolvasása közben. Hiba kódja: {$a->errno}; hiba szövege: {$a->errstring}';
$string['updatepasserrorexpiregrace'] = 'Hiba a user_update_password() esetén a lejárati idő és/vagy a késedelmes belépés módosítása közben. Hiba kódja: {$a->errno}; hiba szövege: {$a->errstring}';
$string['updateremfail'] = 'Hiba az LDAP-rekord frissítése közben. A hiba kódja: {$a->errno}; a hiba szövege: {$a->errstring}<br/>Kulcs ({$a->key}) - régi Moodle-érték: \'{$a->ouvalue}\' új érték: \'{$a->nuvalue}\'';
$string['updateremfailamb'] = 'Nem sikerült az LDAP frissítése kétértelmű {$a->key} mezővel; régi Moodle-érték: \'{$a->ouvalue}\' új érték: \'{$a->nuvalue}\'';
$string['updateusernotfound'] = 'Külső frissítés közben nem található a felhasználó. Részletek: a keresés alapja: \'{$a->userdn}\'; a keresés szűrője: \'(objectClass=*)\'; a keresés paraméterei: {$a->attribs}';
$string['user_activatenotsupportusertype'] = 'Az auth: ldap user_activate() nem támogatja ezt a felhasználótípust: {$a}';
$string['user_disablenotsupportusertype'] = 'Az auth: ldap user_disable() nem támogatja ezt a felhasználótípust: {$a}';
$string['useracctctrlerror'] = 'Hiba {$a} userAccountControl-jának megszerzése közben';
$string['userentriestoadd'] = 'Beszúrandó felhasználói bejegyzések: {$a}';
$string['userentriestoremove'] = 'Törlendő felhasználói bejegyzések: {$a}';
$string['userentriestorevive'] = 'Újból bekapcsolandó felhasználói bejegyzések: {$a}';
$string['userentriestoupdate'] = 'Frissítendő felhasználói bejegyzések: {$a}';
$string['usernotfound'] = 'A felhasználó nem található az LDAP-ben';
