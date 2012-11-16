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
 * Strings for component 'enrol_authorize', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_authorize
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminacceptccs'] = 'Milyen hitelkártyafajtákat fogad el?';
$string['adminaccepts'] = 'Válassza ki az engedélyezett fizetési módokat és azok típusait';
$string['adminauthorizeccapture'] = 'Megrendelés ellenőrzése és az ütemezett leemelés beállításai';
$string['adminauthorizeemail'] = 'E-mail küldésének beállításai';
$string['adminauthorizesettings'] = 'Az authorize.net kereskedői fiók beállításai';
$string['adminauthorizewide'] = 'Általános beállítások';
$string['adminconfighttps'] = 'Gondoskodjon arról, hogy az Adminisztráció >> Beállítások >> Változók >> Biztonság >> loginhttps pontján a "<a href="{$a->url}"> loginhttps BE legyen kapcsolva</a>, hogy használhassa ezt a segédprogramot.';
$string['adminconfighttpsgo'] = 'A segédprogram beállításához térjen át a <a href="{$a->url}">biztonságos oldal</a>ra.';
$string['admincronsetup'] = 'A cron.php karbantartó kód legalább 24 órája nem futott le. Az ütemezett leemelés használatához be kell kapcsolnia a Cront.<br />Állítsa be a cront megfelelően, vagy ismét szüntesse meg az an_review bejelölését.<br />Az ütemezett leemelés kikapcsolásakor az ügyleteket törli a rendszer, ha 30 napon belül nem ellenőrzi őket.<br />Ellenőrizze az an_review-t és az an_capture_day mezőbe írjon \'0\'-t,ha 30 napon belül kézzel kíván fizetéseket elfogadni/elutasítani.';
$string['adminemailexpiredsort'] = 'Ha a tanárok e-mailben értesülnek a lejáró folyamatban lévő megrendelések számáról, melyik legyen fontos?';
$string['adminemailexpiredsortcount'] = 'A megrendelések száma';
$string['adminemailexpiredsortsum'] = 'A teljes összeg';
$string['adminemailexpsetting'] = '(0 = e-mail küldésének kikapcsolása, alap = 2, max. = 5)<br />(Kézi leemelés beállításai e-mail küldéséhez: cron= bekapcsolva, an_review= bejelölve, an_capture_day= 0, an_emailexpired=1-5)';
$string['adminhelpcapturetitle'] = 'Ütemezett leemelés napja';
$string['adminhelpreviewtitle'] = 'Rendelés ellenőrzése';
$string['adminneworder'] = 'Tisztelt Rendszergazda! Új folyamatban lévő megrendelést kapott: Megrendelés azonosítója: {$a->orderid} Ügylet azonosítója: {$a->orderid}  Felhasználó: {$a->user} Kurzus: {$a->course} Összeg: {$a->amount} KÉZI LEEMELÉS BEKAPCSOLVA?: {$a->acstatus} Ha a kézi leemelés be van kapcsolva, akkor a bankkártyáról való leemelés időpontja {$a->captureon}, melyet követően a felhasználót be kell íratni a kurzusba; ellenkező esetben lejár {$a->expireon} időpontban, melyet követően már nem emelhető le. Lehetősége van a tanulót beiratkoztató fizetés elfogadására/elutasítására az alábbi ugrópontot követve: {$a->url}';
$string['adminnewordersubject'] = '{$a->course}; Új folyamatban lévő megrendelés: {$a->orderid}';
$string['adminpendingorders'] = 'Az ütemezett leemelést kikapcsolta.<br />Az összes {$a->count} \'Jóváhagyott/Folyamatban lévő leemelés\' megjelölésű ügyletet bejelölés híján törli a rendszer.<br />Fizetések elfogadásához/elutasításához térjen át a <a href=\'{$a->url}\'>Fizetések kezelése</a> oldalra.';
$string['adminteachermanagepay'] = 'A tanárok kezelhetik a kurzussal kapcsolatos befizetéseket.';
$string['allpendingorders'] = 'Az összes folyamatban lévő megrendelés';
$string['amount'] = 'Összeg';
$string['anauthcode'] = 'Hitelesítési kód beszerzése';
$string['anauthcodedesc'] = 'Ha a felhasználó hitelkártyája az internetről közvetlenül nem olvasható le, szerezzen be hitelesítési kódot telefonon az ügyfél bankjától.';
$string['anavs'] = 'Címellenőrző rendszer';
$string['anavsdesc'] = 'Jelölje be, ha saját authorize.Net kereskedői fiókjában aktiválta a címellenőrző rendszert (AVS). Ehhez a felhasználónak címadatokra (utca, házszám, ország, irányítószám stb.) van szüksége a fizetési űrlap kitöltése során.';
$string['ancaptureday'] = 'Leemelés napja';
$string['ancapturedaydesc'] = 'Automatikus leemelés a hitelkártyáról, kivéve, ha egy tanár vagy rendszergazda a rendelést megadott számú napon belül felül nem vizsgálja. A CRON LEGYEN BEKAPCSOLVA! <br />(A 0 nap az ütemezett leemelést kikapcsolja, emellett a tanár vagy a rendszergazda a rendelést csak kézi úton vizsgálhatja felül. Ha az ütemezett leemelést kikapcsolja, vagy ha 30 napon belül nem vizsgálja felül. az ügylet törlődik.)';
$string['anemailexpired'] = 'Értesítés lejáratról';
$string['anemailexpireddesc'] = 'Ez a kézi leemelés esetén hasznos. A rendszergazdák megadott számú nappal a folyamatban lévő rendelések lejárata előtt értesítést kapnak.';
$string['anemailexpiredteacher'] = 'Értesítés lejáratról - tanárnak';
$string['anemailexpiredteacherdesc'] = 'Ha bekapcsolta a kézi leemelést (l. fent) és a tanárok kezelhetik a fizetéseket, akkor ők is értesülhetnek a függőben lévő rendelések lejáratáról. Ez esetben minden kurzusoktató e-mailben értesítést kap a függőben lévő, lejáró rendelések számáról.';
$string['anlogin'] = 'Authorize.net: felhasználónév';
$string['anpassword'] = 'Authorize.net: jelszó';
$string['anreferer'] = 'Hivatkozás';
$string['anrefererdesc'] = 'Adja meg itt az URL-hivatkozást, ha ezt beállítja az authorize.net fiókjában. Ezzel a webkérésben egy "Referer: URL" sor továbbítódik.';
$string['anreview'] = 'Felülvizsgálat';
$string['anreviewdesc'] = 'Rendelés felülvizsgálata a hitelkártya feldolgozása előtt.';
$string['antestmode'] = 'Teszt üzemmód';
$string['antestmodedesc'] = 'Ügyletek végrehajtása tesztelési üzemmódban (pénzleemelésre nem kerül sor)';
$string['antrankey'] = 'Authorize.net: ügyletkulcs';
$string['approvedreview'] = 'Jóváhagyott ellenőrzés';
$string['authcaptured'] = 'Engedélyezve / Leemelve';
$string['authcode'] = 'Jóváhagyási kód';
$string['authorize:config'] = 'Az Authorize.net beiratkozási példányainak beállítása';
$string['authorize:manage'] = 'Beiratkozott felhasználók kezelése';
$string['authorize:managepayments'] = 'Fizetések kezelése';
$string['authorize:unenrol'] = 'Felhasználók kiiratkoztatása a kurzusból';
$string['authorize:unenrolself'] = 'Önmaga kiiratkoztatása a kurzusból';
$string['authorize:uploadcsv'] = 'CSV-állomány feltöltése';
$string['authorizedpendingcapture'] = 'Jóváhagyott/Folyamatban lévő leemelés';
$string['authorizeerror'] = 'Authorize.net hiba: {$a}';
$string['avsa'] = 'A cím (utca) egyezik, az irányítószám nem';
$string['avsb'] = 'Címadatok nincsenek megadva';
$string['avse'] = 'Címellenőrzési rendszerhiba';
$string['avsg'] = 'Nem USA-beli kártyát kiállító bank';
$string['avsn'] = 'A cím (utca) és az irányítószám nem egyezik';
$string['avsp'] = 'A címellenőrzési rendszer nem alkalmazható';
$string['avsr'] = 'Próbálja újra - A rendszer nem elérhető vagy időtúllépés történt';
$string['avsresult'] = 'A címellenőrzési rendszer eredménye: {$a}';
$string['avss'] = 'A szolgáltatást a kibocsátó nem támogatja';
$string['avsu'] = 'A címadatok nem elérhetők';
$string['avsw'] = 'A 9 számjegyes irányítószám egyezik, a cím (utca) nem';
$string['avsx'] = 'A cím (utca) és a 9 számjegyes irányítószám egyezik';
$string['avsy'] = 'A cím (utca) és az 5 számjegyes irányítószám egyezik';
$string['avsz'] = 'Az 5 számjegyes irányítószám egyezik, a cím (utca) nem';
$string['canbecredit'] = 'Nem téríthető vissza:  {$a->upto}';
$string['cancelled'] = 'Törölve';
$string['capture'] = 'Leemelés';
$string['capturedpendingsettle'] = 'Leemelve / Kiegyenlítés folyamatban';
$string['capturedsettled'] = 'Leemelve / Kiegyenlítve';
$string['captureyes'] = 'A hitelkártyát megterheljük és a tanulót beiratkoztatjuk. Biztosan ezt akarja?';
$string['cccity'] = 'Város';
$string['ccexpire'] = 'Lejárat dátuma';
$string['ccexpired'] = 'A hitelkártya lejárt';
$string['ccinvalid'] = 'Érvénytelen kártyaszám';
$string['cclastfour'] = 'Hitelkártyán az utolsó négy';
$string['ccno'] = 'Hitelkártya száma';
$string['ccstate'] = 'Állam';
$string['cctype'] = 'Hitelkártya típusa';
$string['ccvv'] = 'Kártyaellenőrzés';
$string['ccvvhelp'] = 'Lásd a kártya túloldalán (utolsó 3 számjegy)';
$string['choosemethod'] = 'Adja meg a kurzus beiratkozási kódját, ha ismeri;<br />ellenkező esetben fizetnie kell a kurzus elvégzéséért.';
$string['chooseone'] = 'Az alábbi két mezőt vagy az egyiket töltse ki. A jelszó nem látszik.';
$string['cost'] = 'Költség';
$string['costdefaultdesc'] = 'Ezen alapköltség használatához a kurzusköltség mezőben a <strong>kurzusbeállításoknál adjon meg -1-et</strong>.';
$string['currency'] = 'Pénznem';
$string['cutofftime'] = 'Megszüntetési idő';
$string['cutofftimedesc'] = 'Ügylet megszüntetésének ideje. Mikor kerül sor az utolsó ügylet rendezésére?';
$string['dataentered'] = 'Adat rögzítve';
$string['delete'] = 'Megsemmisítés';
$string['description'] = 'Az Authorize.net modullal térítéses kurzusok hozhatók létre. Itt adható meg (1) a portálra globálisan érvényes költség, valamint (2) az egyes kurzusokhoz egyenként beállítható költség. A kurzusköltség felülírja a portálköltséget.';
$string['echeckabacode'] = 'Bank ABA-száma';
$string['echeckaccnum'] = 'Bankszámla száma';
$string['echeckacctype'] = 'Bankszámla típusa';
$string['echeckbankname'] = 'Bank neve';
$string['echeckbusinesschecking'] = 'Ügyletellenőrzés';
$string['echeckchecking'] = 'Ellenőrzés';
$string['echeckfirslasttname'] = 'Bankszámla-tulajdonos';
$string['echecksavings'] = 'Megtakarítások';
$string['enrolenddate'] = 'Lezárási időpont';
$string['enrolenddaterror'] = 'A beiratkozás lezárási időpontja nem lehet hamarabb, mint a kezdési időpont.';
$string['enrolname'] = 'Authorize.net fizetési kapu';
$string['enrolperiod'] = 'Beiratkozási időszak';
$string['enrolstartdate'] = 'Kezdési időpont';
$string['expired'] = 'Lejárt';
$string['expiremonth'] = 'Lejárat hónapja';
$string['expireyear'] = 'Lejárat éve';
$string['firstnameoncard'] = 'Kártyán szereplő keresztnév';
$string['haveauthcode'] = 'Már van hitelesítési kódom';
$string['howmuch'] = 'Mennyi?';
$string['httpsrequired'] = 'Sajnos kérését jelenleg nem tudjuk feldolgozni. A portált nem lehetett megfelelő módon beállítani. Ne adja meg a hitelkártyaszámát, ha a böngésző alján nem jelenik meg egy sárga lakat. Ez azt jelzi, hogy az ügyfél és a kiszolgáló között minden adat továbbítása kódoltan történik. Így a két számítógép közötti kapcsolat adatforgalma védve van, és hitelkártyája számát nem lehet az interneten keresztül levenni.';
$string['invalidaba'] = 'Érvénytelen ABA-szám';
$string['invalidaccnum'] = 'Érvénytelen számlaszám';
$string['invalidacctype'] = 'Érvénytelen számlatípus';
$string['isbusinesschecking'] = 'Ügyletellenőrzés?';
$string['lastnameoncard'] = 'Kártyán szereplő vezetéknév';
$string['logindesc'] = 'Ezt az opciót be kell kapcsolni.  A Rendszergazda >> Változók >> Biztonság részben ellenőrizze, be van-e kapcsolva a <a href="{$a->url}">loginhttps</a> opció. Ennek bekapcsolásakor a Moodle csak a belépési és a fizetési oldalon használ biztonságos https-csatlakozást.';
$string['logininfo'] = 'Beállítás során a felhasználói nevet kell megadnia, majd a megfelelő mezőben vagy az ügyletkódot, vagy a jelszót. Biztonsági okokból ajánlott az ügyletkód megadása.';
$string['messageprovider:authorize_enrolment'] = 'Az Authorize.Net beiratkozási üzenetei';
$string['methodcc'] = 'Hitelkártya';
$string['methodccdesc'] = 'Hitelkártya és elfogadott típusok kiválasztása alább';
$string['methodecheck'] = 'eCheck (ACH)';
$string['methodecheckdesc'] = 'eCheck és elfogadott típusok kiválasztása alább';
$string['missingaba'] = 'Nincs megadva ABA-szám';
$string['missingaddress'] = 'Nincs megadva cím';
$string['missingbankname'] = 'Nincs megadva banknév';
$string['missingcc'] = 'Nincs megadva kártyaszám';
$string['missingccauthcode'] = 'Nincs megadva hitelesítési kód';
$string['missingccexpiremonth'] = 'Nincs megadva a lejárati hónap';
$string['missingccexpireyear'] = 'Nincs megadva a lejárati év';
$string['missingcctype'] = 'Nincs megadva kártyatípus';
$string['missingcvv'] = 'Nincs megadva ellenőrző szám';
$string['missingzip'] = 'Nincs megadva irányítószám';
$string['mypaymentsonly'] = 'Csak a befizetéseim látsszanak';
$string['nameoncard'] = 'Kártyán szereplő név';
$string['new'] = 'Új';
$string['nocost'] = 'A kurzusba való Authorize.Net-en keresztüli beiratkozáshoz nincs társítva költség';
$string['noreturns'] = 'Nincs visszatérítés!';
$string['notsettled'] = 'Nincs kiegyenlítve';
$string['orderdetails'] = 'Rendelés részletei';
$string['orderid'] = 'Rendelésazonosító';
$string['paymentmanagement'] = 'Fizetés kezelése';
$string['paymentmethod'] = 'Fizetési mód';
$string['paymentpending'] = 'Ezen kurzushoz tartozó fizetésének rendezése ezzel a rendelési számmal folyamatban: {$a->orderid}. Lásd a <a href="{$a->url}">Fizetési részleteket</a>.';
$string['pendingecheckemail'] = 'Tisztelt Igazgató Úr! Jelenleg {$a->count} e-csekk nincs befizetve, a tanulók beiratkozásához csv formátumú állományt kell feltöltenie.  Kattintson az ugrópontra és olvassa el az oldalon megjelenő súgót: {$a->url}';
$string['pendingechecksubject'] = '{$a->course}: be nem fizetett e-csekk ({$a->count})';
$string['pendingordersemail'] = 'Tisztelt Rendszergazda! A {$a->course}" kurzus {$a->pending} ügylete lejár, ha {$a->days} napon belül nem fogadja el a fizetést.  Ez egy figyelmeztető üzenet, mert nem kapcsolta be az ütemezett leemelést. Vagyis a befizetést kézzel kell elfogadnia vagy elutasítania. Folyamatban lévő befizetés elfogadásához/elutasításához térjen át ide: {$a->url} Ütemezett leemelés bekapcsolásához nem kap további figyelmeztető e-mailt, térjen át ide: {$a->enrolurl}';
$string['pendingordersemailteacher'] = 'Tisztelt Tanár Úr! A {$a->course}" kurzus {$a->currency} {$a->sumcost} összegű {$a->pending} ügylete lejár, ha {$a->days} napon belül nem fogadja el a fizetést. A fizetést kézi úton kell elfogadnia vagy elutasítania, mert a rendszergazda nem kapcsolta be az ütemezett leemelést.  {$a->url}';
$string['pendingorderssubject'] = 'FIGYELEM: {$a->course} {$a->pending} rendelése {$a->days} napon belül lejár.';
$string['pluginname'] = 'Authorize.Net';
$string['reason11'] = 'Az ügyletet kétszer továbbították.';
$string['reason13'] = 'A bonyolító belépési azonosítója érvénytelen vagy a fiókja ki van kapcsolva.';
$string['reason16'] = 'Az ügylet nem található.';
$string['reason17'] = 'A bonyolító nem fogadja el ezt a fajta kártyát.';
$string['reason245'] = 'Ezt az eCheck-típust nem használhatja, ha a fizetést teljesítő átjáró fizetési űrlapját használja.';
$string['reason246'] = 'Ezt az eCheck-típust nem használhatja.';
$string['reason27'] = 'Az ügylet eredménye a címellenőrzési rendszerben egyezés hiányát mutatja. A megadott cím és a kártya tulajdonosának számlázási címe nem egyezik.';
$string['reason28'] = 'A bonyolító nem fogadja el ezt a fajta kártyát.';
$string['reason30'] = 'A feldolgozó beállítása érvénytelen. Forduljon a kereskedő szolgáltatójához.';
$string['reason39'] = 'A megadott pénznemkód érvénytelen vagy nem támogatott, a bonyolító számára nem engedélyezett, vagy nincs hozzá megadva árfolyam.';
$string['reason43'] = 'A kereskedő nem megfelelően lett beállítva a feldolgozónál. Forduljon a kereskedő szolgáltatójához.';
$string['reason44'] = 'Az ügylet elutasítva. A kártyakód szűrője hibás!';
$string['reason45'] = 'Az ügylet elutasítva. A kártyakód/címellenőrzési rendszer szűrője hibás!';
$string['reason47'] = 'A befizetéshez kért összeg nem lehet nagyobb az eredetileg engedélyezett összegnél.';
$string['reason5'] = 'Érvényes összeget adjon meg.';
$string['reason50'] = 'Az ügylet szerinti befizetés folyamatban van, az összeg nem téríthető vissza.';
$string['reason51'] = 'Az ügylettel kapcsolatos jóváírások összege nagyobb az eredeti ügyleti összegnél.';
$string['reason54'] = 'Az adott ügylet nem felel meg a jóváíráshoz szükséges feltételeknek.';
$string['reason55'] = 'Az adott ügyleti jóváírások összege meghaladná az eredeti terhelési összeget.';
$string['reason56'] = 'Ez a bonyolító csak eCheck (ACH) ügyleteket fogad el; semmilyen hitelkártyaügyletet nem fogad el.';
$string['refund'] = 'Visszatérítés';
$string['refunded'] = 'Visszatérítve';
$string['returns'] = 'Visszajáró';
$string['reviewfailed'] = 'Az ellenőrzés sikertelen';
$string['reviewnotify'] = 'Fizetését ellenőrizzük. Néhány napon belül e-mail üzenetet kap a tanárától.';
$string['sendpaymentbutton'] = 'Fizetés elküldése';
$string['settled'] = 'Kiegyenlítve';
$string['settlementdate'] = 'Kiegyenlítés dátuma';
$string['shopper'] = 'Vásárló';
$string['status'] = 'Beiratkozás engedélyezése Autorize.net-en keresztül';
$string['subvoidyes'] = 'A visszatérített {$a->transid} ügylet törölve lesz és {$a->amount} összeget jóváírunk a számláján. Biztosan ezt akarja?';
$string['tested'] = 'Ellenőrizve';
$string['testmode'] = '[TESZTMÓD]';
$string['testwarning'] = 'A leemelés/törlés/jóváírás tesztmódban üzemel ugyan, de az adatbázisba nem került rekord, vagy nem lett frissítve.';
$string['transid'] = 'Ügyletazonosító';
$string['underreview'] = 'Ellenőrzés folyamatban';
$string['unenrolselfconfirm'] = 'Biztosan leadja a(z) "{$a}" kurzust?';
$string['unenrolstudent'] = 'A tanulót kiiratkoztatja?';
$string['uploadcsv'] = 'CSV-állomány feltöltése';
$string['usingccmethod'] = 'Beiratkozás <a href="{$a->url}">hitelkártyával</a>';
$string['usingecheckmethod'] = 'Beiratkozás <a href="{$a->url}">eCheck</a> segítségével';
$string['verifyaccount'] = 'Az Authorize.net kereskedői számla ellenőrzése';
$string['verifyaccountresult'] = 'Ellenőrzés eredménye: {$a}';
$string['void'] = 'Érvénytelen';
$string['voidyes'] = 'Az ügyletet töröljük. Biztosan ezt akarja?';
$string['welcometocoursesemail'] = 'Tisztelt Tanuló! Köszönjük befizetését. Ezen kurzusokra iratkozott be: {$a->courses} Megtekintheti fizetési adatait és szerkesztheti profilját:
{$a->paymenturl}
{$a->profileurl}';
$string['youcantdo'] = 'Ezt a lépést nem teheti meg: {$a->action}';
$string['zipcode'] = 'Irányítószám';
