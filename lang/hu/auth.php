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
 * Strings for component 'auth', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   auth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actauthhdr'] = 'Elérhető hitelesítési segédprogramok';
$string['alternatelogin'] = 'Ha itt URL-t ad meg, az lesz a portál bejelentkező oldala. Az oldalon egy űrlap található, melyen a tevékenység tulajdonságának beállítása a {$a}, továbbá a felhasználónév és a jelszó mezőket adja vissza.<br />Ügyeljen az URL pontos megadására, ellenkező esetben kizárhatja magát erről a portálról.<br />Az alapbeállítás szerinti bejelentkező oldal megtartásához hagyja a mezőt üresen.';
$string['alternateloginurl'] = 'Alternatív belépési URL';
$string['auth_changepasswordhelp'] = 'A jelszómódosítás súgója';
$string['auth_changepasswordhelp_expl'] = 'Megjeleníti a(z) {$a} jelszavukat elfelejtő felhasználók súgóját. Ez vagy a jelszó-módosítási URL-lel, vagy a Moodle belső jelszómódosításával együtt, vagy pedig helyette jelenik meg.';
$string['auth_changepasswordurl'] = 'URL-jelszó módosítása';
$string['auth_changepasswordurl_expl'] = 'Adja meg a {$a} jelszavukat elfelejtő felhasználóknak küldendő URL-t. Állítsa a <strong>Szokásos jelszómódosító oldal használata</strong> pontot <strong>Nem</strong>-re.';
$string['auth_changingemailaddress'] = 'E-mail címét {$a->oldemail} címről {$a->newemail} címre kívánja módosítani. Biztonsági okokból e-mail üzenetet küldünk az új címre. E-mail címét az abban az üzenetben elküldött URL megnyitását követően frissítjük.';
$string['auth_common_settings'] = 'Általános beállítások';
$string['auth_data_mapping'] = 'Adatok illesztése';
$string['auth_fieldlock'] = 'Zárolás';
$string['auth_fieldlock_expl'] = 'Zárolás: Bekapcsolásakor a felhasználók és a rendszergazdák a mezőt nem szerkeszthetik közvetlenül. Akkor jelölje be, ha az adatokat a külső hitelesítési rendszerben kezeli.';
$string['auth_fieldlocks'] = 'Felhasználómezők zárolása';
$string['auth_fieldlocks_help'] = 'A felhasználómezőket zárolhatja. Ez akkor hasznos, ha a rendszergazdák a felhasználói adatokat kézzel tartják karban a felhasználói rekordok szerkesztése vagy a \'Felhasználók feltöltése\' segítségével. A Moodle által használt mezők zárolásakor ne feledje el megadni az adatokat a felhasználók létrehozásakor - ellenkező esetben a felhasználók nem kerülnek bele a rendszerbe. A probléma elkerülésére a zárolást beállíthatja \'Üres állapotban zárolatlan\'-ra.';
$string['auth_invalidnewemailkey'] = 'Hiba: ha e-mail cím módosítását próbálta megerősíteni, hibásan másolhatta ki az Önnek e-mailben megküldött URL-t. Próbálja meg újból kimásolni és megismételni a megerősítést.';
$string['auth_multiplehosts'] = 'Több gazdagép VAGY cím adható meg (pl. host1.com;host2.com;host3.com vagy xxx.xxx.xxx.xxx;xxx.xxx.xxx.xxx)';
$string['auth_outofnewemailupdateattempts'] = 'E-mail címének frissítéséhez nincs több próbálkozási lehetősége. Frissítési kérelmét töröltük.';
$string['auth_passwordisexpired'] = 'Jelszava lejárt. Kívánja most módosítani?';
$string['auth_passwordwillexpire'] = 'Jelszava {$a} napon belül lejár. Kívánja most módosítani?';
$string['auth_remove_delete'] = 'Belső teljes törlése';
$string['auth_remove_keep'] = 'Megtartás belsőként';
$string['auth_remove_suspend'] = 'Belső felfüggesztése';
$string['auth_remove_user'] = 'Adja meg, mi történjék egy belső felhasználói fiókkal egyesített szinkronizálás során, ha a felhasználó a külső forrásból törölve lett. Csakis felfüggesztett felhasználók esetén automatikus az ismételt bekapcsolás, amennyiben újból megjelennek a külső forrásban.';
$string['auth_remove_user_key'] = 'Külső felhasználó törlése';
$string['auth_sync_script'] = 'Cron szinkronizációs kód';
$string['auth_updatelocal'] = 'Helyi adatok frissítése';
$string['auth_updatelocal_expl'] = 'Helyi adatok frissítése: bekapcsolása esetén a mező (külső hitelesítésből) mindannyiszor frissítve lesz, ahányszor a felhasználó bejelentkezik, vagy a felhasználók szinkronizálására kerül sor. A helyileg frissítendő mezőket zárolni kell.';
$string['auth_updateremote'] = 'Külső adatok frissítése';
$string['auth_updateremote_expl'] = 'Külső adatok frissítése: Bekapcsolása esetén a külső hitelesítés mindannyiszor frissítve lesz, ahányszor a felhasználói rekord frissítésére sor kerül. Szerkesztés engedélyezéséhez a mezők zárolását fel kell oldani.';
$string['auth_updateremote_ldap'] = 'Megjegyzés: külső LDAP-adatok frissítéséhez egy bind-user-hez be kell állítani a binddn és a bindpw értékét az összes felhasználói rekordra vonatkozó szerkesztési privilégiummal. Jelenleg nem őrzi meg a többértékű attribútumokat és frissítéskor a fölös értékeket eltávolítja.';
$string['auth_user_create'] = 'Felhasználó létrehozásának engedélyezése';
$string['auth_user_creation'] = 'Új (névtelen) felhasználók is létrehozhatnak új felhasználói azonosítót a külső hitelesítési forráson, e-mailes megerősítéssel. Ha ezt engedélyezi, ne feledje megadni a felhasználó létrehozásához a modul-specifikus lehetőségeket.';
$string['auth_usernameexists'] = 'A választott felhasználónév már létezik. Válasszon másikat.';
$string['authenticationoptions'] = 'Hitelesítési lehetőségek';
$string['authinstructions'] = 'Itt tájékoztathatja a felhasználókat arról, hogy milyen felhasználóneveket és jelszavakat használhatnak. Az itt megadott szöveg megjelenik a bejelentkező oldalon. Ha üresen hagyja, nem jelenik meg semmilyen tájékoztatás.';
$string['auto_add_remote_users'] = 'Távoli felhasználók automatikus hozzáadása';
$string['changepassword'] = 'Jelszó-módosítási URL';
$string['changepasswordhelp'] = 'Itt megadhat egy helyet, ahol a felhasználók visszakereshetik vagy módosíthatják felhasználónevüket/jelszavukat, ha elfelejtették. Ez egy gombon érhető el a bejelentkező oldalon és az adott felhasználó oldalán. Ha üresen hagyja, nem jelenik meg ilyen gomb.';
$string['chooseauthmethod'] = 'Válasszon egy hitelesítési eljárást';
$string['chooseauthmethod_help'] = 'Ezzel a menüvel módosíthatja az adott felhasználó hitelesítési módszerét.
Ne feledje, hogy ez nagy mértékben függ a portálhoz beállított hitelesítési módtól és a használt beállításoktól.
Hibás módosítás esetén a felhasználót kizárhatja a portálról, sőt, teljesen törölheti is. Ezért csak akkor használja, ha a következményekkel tisztában van.';
$string['createpasswordifneeded'] = 'Szükség esetén hozzon létre egy jelszót';
$string['emailchangecancel'] = 'E-mail cím módosításának törlése';
$string['emailchangepending'] = 'A módosítás folyamatban van. Nyissa meg a {$a->preference_newemail} címre kiküldött ugrópontot.';
$string['emailnowexists'] = 'Eredeti kérése óta a profiljához hozzáadandó e-mail címet már valaki máshoz rendeltük hozzá. Ezért e-mail címe módosítási kérelmét elutasítjuk, de próbálkozhat egy másik címmel.';
$string['emailupdate'] = 'E-mail cím frissítése';
$string['emailupdatemessage'] = 'Tisztelt {$a->fullname}!

A {$a->site} portálon lévő fiókjához tartozó e-mail cím módosítását kérte. A módosítás megerősítéséhez nyissa meg böngészőjében az alábbi URL-t.

{$a->url}';
$string['emailupdatesuccess'] = '<em>{$a->fullname}</em> felhasználó e-mail címének <em>{$a->email}</em> címre módosítása sikerült.';
$string['emailupdatetitle'] = 'A {$a->site} portálon az e-mail cím frissítésének megerősítése';
$string['enterthenumbersyouhear'] = 'Írja le a hallott számokat';
$string['enterthewordsabove'] = 'Írja le a fenti szavakat';
$string['errormaxconsecutiveidentchars'] = 'A jelszó legfeljebb {$a} azonos egymás utáni karaktert tartalmazhat.';
$string['errorminpassworddigits'] = 'A jelszó legalább {$a} számjegyet tartalmazzon.';
$string['errorminpasswordlength'] = 'A jelszó legalább {$a} karaktert tartalmazzon.';
$string['errorminpasswordlower'] = 'A jelszó legalább {$a} kisbetűt tartalmazzon.';
$string['errorminpasswordnonalphanum'] = 'A jelszó legalább {$a} nem-alfanumerikus karaktert tartalmazzon.';
$string['errorminpasswordupper'] = 'A jelszó legalább {$a} nagybetűt tartalmazzon.';
$string['errorpasswordupdate'] = 'Hiba a jelszó frissítése közben, a jelszó nem módosult';
$string['forcechangepassword'] = 'Jelszómódosítás előírása';
$string['forcechangepassword_help'] = 'Felhasználói jelszó módosításának előírása a Moodle-ba való következő belépéskor.';
$string['forcechangepasswordfirst_help'] = 'Felhasználói jelszó módosításának előírása a Moodle-ba való első belépéskor.';
$string['forgottenpassword'] = 'Ha itt URL-t ad meg, az lesz a portálhoz tartozó elveszett jelszavak visszaállításának az oldala. Olyan portálokon használandó, ahol a jelszavakat a Moodle-on kívül kezelik. Az alapbeállítás szerinti jelszó-visszaállítás használatához hagyja üresen.';
$string['forgottenpasswordurl'] = 'Elfelejtett jelszó-URL';
$string['getanaudiocaptcha'] = 'CAPTCHA-audió beszerzése';
$string['getanimagecaptcha'] = 'CAPTCHA-kép beszerzése';
$string['getanothercaptcha'] = 'Másik CAPTCHA beszerzése';
$string['guestloginbutton'] = 'Vendégkénti belépés gombja';
$string['incorrectpleasetryagain'] = 'Hibás, próbálja meg újra';
$string['infilefield'] = 'Az állományban szükséges mező';
$string['informminpassworddigits'] = 'legalább {$a} számjegy';
$string['informminpasswordlength'] = 'legalább {$a} karakter';
$string['informminpasswordlower'] = 'legalább {$a} kisbetű';
$string['informminpasswordnonalphanum'] = 'legalább {$a} nem alfanumerikus karakter';
$string['informminpasswordupper'] = 'legalább {$a} nagybetű';
$string['informpasswordpolicy'] = 'A jelszó kötelező eleme: {$a}';
$string['instructions'] = 'Utasítások';
$string['internal'] = 'Belső';
$string['locked'] = 'Zárolt';
$string['md5'] = 'MD5 titkosítás';
$string['nopasswordchange'] = 'A jelszó nem módosítható';
$string['nopasswordchangeforced'] = 'A továbblépéshez először módosítania kell a jelszavát, ehhez azonban nem áll rendelkezésre megfelelő oldal. Forduljon a Moodle rendszergazdájához.';
$string['noprofileedit'] = 'A profil nem szerkeszthető.';
$string['ntlmsso_attempting'] = 'Egyszeres belépés megpróbálása NTLM-en keresztül...';
$string['ntlmsso_failed'] = 'Az automatikus belépés nem sikerült, próbálkozzék a szokásos belépési oldallal...';
$string['ntlmsso_isdisabled'] = 'Az NTLM SSO ki van kapcsolva.';
$string['passwordhandling'] = 'Jelszómező kezelése';
$string['plaintext'] = 'Egyszerű szöveg';
$string['pluginnotenabled'] = 'A(z) \'{$a}\' hitelesítő segédprogram nincs bekapcsolva.';
$string['pluginnotinstalled'] = 'A(z) \'{$a}\' hitelesítő segédprogram nincs telepítve.';
$string['potentialidps'] = 'Lépjen be itteni fiókjával:';
$string['recaptcha'] = 'reCAPTCHA';
$string['recaptcha_help'] = 'A CAPTCHA az automatizált programokkal való visszaélés megakadályozására használatos. Írja be a négyzetben látható szavakat a megfelelő sorrendben, szóközzel elválasztva.
Ha nem biztos abban, hogy felismerte a szavakat, kérjen egy másik szöveget vagy egy hangos CAPTCHA-t.';
$string['selfregistration'] = 'Önregisztráció';
$string['selfregistration_help'] = 'Ha hitelesítő segédprogramot, például e-mail alapú önregisztrációt választ, akkor a potenciális felhasználók regisztrálhatják magukat és fiókokat hozhatnak létre. Ezzel a levélszemetet gyártók fiókokat hozhatnak létre fórumüzenetek és blogüzenetek levélszeméttel való megtöltéséhez. Ennek elkerülésére az önregisztrációt ki kell kapcsolni vagy az *Engedélyezett e-mail doménekre * kell korlátozni.';
$string['sha1'] = 'SHA-1 titkosítás';
$string['showguestlogin'] = 'Megjelenítheti vagy elrejtheti a bejelentkező oldalon a vendég belépésére való gombot.';
$string['stdchangepassword'] = 'Szokásos jelszó-módosítási oldal használata';
$string['stdchangepassword_expl'] = 'Ha a külső hitelesítési rendszer lehetővé teszi a jelszómódosítást a Moodle-on keresztül, akkor ezt állítsa Igen-re. Felülírja a \'Jelszó URL-jének módosítása\' beállítást.';
$string['stdchangepassword_explldap'] = 'MEGJEGYZÉS: Az LDAP-ot távoli LDAP-szerver esetén célszerű SSL-kódoláson (ldaps://) keresztül használni.';
$string['suspended'] = 'Felfüggesztett fiók';
$string['suspended_help'] = 'Felfüggesztett fiókból nem lehet belépni vagy webszolgáltatásokat használni. A kimenő üzeneteket a rendszer megsemmisíti.';
$string['unlocked'] = 'Zárolatlan';
$string['unlockedifempty'] = 'Üres állapotban zárolatlan';
$string['update_never'] = 'Soha';
$string['update_oncreate'] = 'Létrehozáskor';
$string['update_onlogin'] = 'Minden belépés alkalmával';
$string['update_onupdate'] = 'Frissítéskor';
$string['user_activatenotsupportusertype'] = 'auth: ldap user_activate() nem támogatja a kiválasztott {$a} felhasználótípust.';
$string['user_disablenotsupportusertype'] = 'auth: ldap user_disable() (még...) nem támogatja a kiválasztott felhasználótípust.';
