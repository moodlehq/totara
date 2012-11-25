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
 * Strings for component 'certificate', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = 'Másik kapcsolódó tevékenység lehetőségének hozzáadása';
$string['addlinktitle'] = 'Másik kapcsolódó tevékenység lehetőségének hozzáadásához kattintson ide';
$string['areaintro'] = 'Bizonyítvány bevezetője';
$string['awarded'] = 'Adományozó';
$string['awardedto'] = 'Adományozott';
$string['back'] = 'Vissza';
$string['border'] = 'Szegély';
$string['borderblack'] = 'Fekete';
$string['borderblue'] = 'Kék';
$string['borderbrown'] = 'Barna';
$string['bordercolor'] = 'Szegélyvonalak';
$string['bordercolor_help'] = 'Mivel a képek erősen megnövelik a PDF méretét, szegélykép helyett használhat szegélyvonalakat (a Szegélyképet ekkor állítsa Nincs értékre). A Szegélyvonalak segítségével a kiválasztott színben három vonalból álló tetszetős szegélyvonal kerül a nyomatra.';
$string['bordergreen'] = 'Zöld';
$string['borderlines'] = 'Vonalak';
$string['borderstyle'] = 'Szegélykép';
$string['borderstyle_help'] = 'A Szegélykép segítségével a certificate/pix/borders mappából szegélyképet választhat a bizonyítványhoz. Ellenkező esetben válassza a Nincs szegély lehetőséget.';
$string['certificate'] = 'Bizonyítványkód ellenőrzése';
$string['certificate:manage'] = 'Bizonyítvány kezelése';
$string['certificate:printteacher'] = 'Tanár nevének noymtatása';
$string['certificate:student'] = 'Bizonyítvány átvétele';
$string['certificate:view'] = 'Bizonyítvány megtekintése';
$string['certificatename'] = 'Bizonyítvány megnevezése';
$string['certificatereport'] = 'Bizonyítványokról szóló jelentés';
$string['certificatesfor'] = 'Bizonyítvány témaköre';
$string['certificatetype'] = 'Bizonyítvány típusa';
$string['certificatetype_help'] = 'Itt adja meg a bizonyítvány elrendezését. A bizonyítványtípus mappája négy alapértelmezett bizonyítványt tartalmaz: Az A4-es beágyazott betűs nyomatok A4 méretű papíron jelennek meg beágyazott betűtípussal. Az A4-es nem beágyazott betűs nyomatok beágyazott betűtípusok nélkül jelennek meg. A Letter beágyazott betűs nyomatok Letter méretű papíron jelennek meg beágyazott betűtípussal. A Letter nem beágyazott betűs nyomatok beágyazott betűtípusok nélkül készülnek.
A nem beágyazott típusok Helvetica és Times betűtípust használnak. Ha úgy gondolja, hogy a felhasználók számítógépén nem lesznek meg ezek a betűtípusok, vagy ha a használt nyelvben vannak olyan karakterek vagy szimbólumok, amelyek nem kapnak helyet a Helvetica és a Times betűtípusban, akkor válasszon beágyazott típust. Beágyazott típusokat használ a Dejavusans és a Dejavuserif. Ezekkel a PDF-fájlok meglehetősen terjedelmesek lesznek, így használatuk csak indokolt esertben ajánlott.
Új típusokhoz mappákat hozhat létre a bizonyítvány/típus mappában. A mappa nevét és új nyelvek esetén az esetleges új szöveget hozzá kell adni a bizonyítvány nyelvi állományához.';
$string['certify'] = 'Ezennel tanúsítjuk, hogy';
$string['code'] = 'Kód';
$string['completiondate'] = 'Kurzus teljesítése';
$string['course'] = 'Témakör';
$string['coursegrade'] = 'Kurzusosztályzat';
$string['coursename'] = 'Kurzus';
$string['credithours'] = 'Kreditóra';
$string['customtext'] = 'Egyedi szöveg';
$string['date'] = 'Dátum';
$string['datefmt'] = 'Dátumforma';
$string['datefmt_help'] = 'Válasszon dátumformát a bizonyítványra nyomtatáshoz, vagy válassza az utolsó elemet, ha a dátumot a felhasználó nyelvének megfelelő formában kívánja kinyomtatni.';
$string['datehelp'] = 'Dátum';
$string['deletissuedcertificates'] = 'Kiállított bizonyítványok törlése';
$string['delivery'] = 'Kézbesítés';
$string['delivery_help'] = 'Itt adja meg, hogyan kapják meg a tanulók a bizonyítványt.
Böngészőben megnyitva: megnyitja a bizonyítványt egy új böngészőablakban. Letöltés előírása: megnyitja a böngésző fájlletöltő ablakát.
Bizonyítvány e-mailben: a tanuló a bizonyítványt e-mail mellékleteként kapja meg. Miután a felhasználó megkapta a bizonyítványt, a kurzus kezdőoldalán a bizonyítványra kattintva megnézheti, mikort kapta a bizonyítványt, és ellenőrizheti annak tartalmát.';
$string['designoptions'] = 'Kialakítási lehetőségek';
$string['download'] = 'Letöltés előírása';
$string['emailcertificate'] = 'E-mail (a Mentést is ki kell választani!)';
$string['emailothers'] = 'E-mail másoknak';
$string['emailothers_help'] = 'Vesszőkkel elválasztva adja meg, kiket kell e-mailben értesíteni, ha a tanulók bizonyítványt kapnak.';
$string['emailstudenttext'] = '{$a->course}.kurzushoz kapcsolódóan mellékeljük bizonyítványát.';
$string['emailteachermail'] = '{$a->student} bizonyítványt kapott: \'{$a->certificate}\' a(z) {$a->course} kurzus keretében. Itt ellenőrizheti: {$a->url}';
$string['emailteachermailhtml'] = '{$a->student} bizonyítványt kapott: \'<i>{$a->certificate}</i>\' a(z) {$a->course} kurzus keretében. Itt ellenőrizheti: <a href="{$a->url}">Bizonyítványról szóló jelentés</a>.';
$string['emailteachers'] = 'E-mail a tanároknak';
$string['emailteachers_help'] = 'Bekapcsolása esetén a tanárok e-mailben értesítést kapnak, ha a tanulók bizonyítványt kapnak.';
$string['entercode'] = 'Ellenőrzéshez adja meg a bizonyítvány kódját:';
$string['getcertificate'] = 'Vegye át bizonyítványát';
$string['grade'] = 'Osztályzat';
$string['gradedate'] = 'Osztályzat dátuma';
$string['gradefmt'] = 'Osztályzat formája';
$string['gradefmt_help'] = 'Ha a bizonyítványra osztályzatot nyomtat, három forma közül választhat:
Százalék: az osztályzat százalékként jelenik meg. Pontszám: az osztályzat pontértékként jelenik meg. Betű: az osztályzat betűként jelenik meg.';
$string['gradeletter'] = 'Betű';
$string['gradepercent'] = 'Százalék';
$string['gradepoints'] = 'Pontszám';
$string['incompletemessage'] = 'A bizonyítvány letöltéséhez hajtsa végre az összes előírt tevékenységet. A kurzusmunka teljesítéséhez térjen vissza kurzusához.';
$string['intro'] = 'Bevezető';
$string['issued'] = 'Kiállító';
$string['issueddate'] = 'Kiállítás kelte';
$string['issueoptions'] = 'Kiállításhoz kapcsolódó lehetőségek';
$string['landscape'] = 'Fekvő';
$string['lastviewed'] = 'Utoljára ezt a bizonytványt ezen időpontban kapta meg:';
$string['letter'] = 'Betű';
$string['lockingoptions'] = 'Zárolási lehetőségek';
$string['modulename'] = 'Bizonyítvány';
$string['modulenameplural'] = 'Bizonyítványok';
$string['mycertificates'] = 'Bizonyítványaim';
$string['nocertificates'] = 'Nincsenek bizonyítványok';
$string['nocertificatesissued'] = 'Nincsenek kiállított bizonyítványok';
$string['nocertificatesreceived'] = 'még nem kapott kurzusbizonyítványt';
$string['nogrades'] = 'Nincs osztályzat';
$string['notapplicable'] = 'Nem vonatkozik rá';
$string['notfound'] = 'A bizonyítvány számát nem lehetett ellenőrizni.';
$string['notissued'] = 'Nincs kiállítva';
$string['notissuedyet'] = 'Még nincs kiállítva';
$string['notreceived'] = 'A bizonyítványt nem kapta meg';
$string['openbrowser'] = 'Megnyitás új ablakban';
$string['opendownload'] = 'Az alábbi gombra kattintva mentse el a bizonyítványt a számítógépére.';
$string['openemail'] = 'Az alábbi gombra kattintva a bizonyítvány e-mail mellékletként érkezik a számítógépére.';
$string['openwindow'] = 'Az alábbi gombra kattintva nyissa meg a bizonyítványt egy új böngészőablakban.';
$string['or'] = 'Vagy';
$string['orientation'] = 'Tájolás';
$string['orientation_help'] = 'Álló vagy fekvő tájolású legyen a bizonyítvány?';
$string['pluginadministration'] = 'Bizonyítvánnyal kapcsolatos ügyintézés';
$string['pluginname'] = 'Bizonyítvány';
$string['portrait'] = 'Álló';
$string['printdate'] = 'Nyomtatási dátum';
$string['printdate_help'] = 'Ez a dátum jelenik meg Nyomtatási dátum kiválasztása esetén. Ha a kurzus teljesítésének dátumát választotta, de a tanuló még nem végezte el a kurzust, akkor a nyomaton az átvétel dátuma jelenik meg. Választhatja valamely tevékenység leosztályozásának a dátumát is. Ha a bizonyítványt ez előtt állítják ki, azon az átvétel dátuma jelenik meg.';
$string['printerfriendly'] = 'Nyomtatóbarát oldal';
$string['printgrade'] = 'Osztályzat nyomtatása';
$string['printgrade_help'] = 'A kurzus osztályozási tételei közül bármelyiket kiválaszthatja az osztályozónaplóból való kinyomtatásra. A tételek a naplóban való megjelenés sorrendjében vannak felsorolva. Az osztályzat formáját válassza ki alább.';
$string['printhours'] = 'Kreditórák nyomtatása';
$string['printhours_help'] = 'Itt adja meg a bizonyítványra nyomtatandó kreditórák számát.';
$string['printnumber'] = 'Kód nyomtatása';
$string['printnumber_help'] = 'Egy egyedi, 10 jegyű, véletlenszerű betűkből és számokból előálló kódot nyomtathat a bizonyítványra. Ezt ellenőrzésképpen egybevetheti a bizonyítványokról szóló jelentésben szereplő kóddal.';
$string['printoutcome'] = 'Eredmény nyomtatása';
$string['printoutcome_help'] = 'Tetszőleges kurzuseredményt kiválaszthat a bizonyítványra nyomtatáshoz. Például: Feladat. Eredménye: Haladó.';
$string['printseal'] = 'Pecsét vagy logó';
$string['printseal_help'] = 'Ezzel a certificate/pix/seals mappából pecsétet vagy logót nyomtathat a bizonyítványra. Alapesetben ez a bizonyítvány jobb alsó sarkába kerül.';
$string['printsignature'] = 'Aláírás képe';
$string['printsignature_help'] = 'Ezzel a certificate/pix/signatures mappából egy aláírást vagy egy aláírásra szolgáló vonalat nyomtathat a bizonyítványra. Alapesetben ez a bizonyítvány bal alsó sarkába kerül';
$string['printteacher'] = 'Tanár(ok) nevének nyomtatása';
$string['printteacher_help'] = 'A tanár nevének a bizonyítványon való feltüntetéséhez modulszinten állítsa be a tanári szerepet. Ezt akkor hajtsa végre, ha vagy több tanár tartja a tanfolyamot, vagy ha a bizonyítványokra más-más tanár nevét kívánja rányomtatni. Először kattintson a bizonyítvány szerkesztéséhez, majd kattinson a Helyileg hozzárendelt szerepek fülre. Ezután a Tanár szerepét (szerkesztő tanár) rendelje hozzá a bizonyítványhoz (a tanár NEM szükségszerűen a kurzust oktató tanár - a szerepet bárkihez hozzárendelheti). Ekkor a tanárhoz tartozó bizonyítványokon meg fog jelenni a tanár neve.';
$string['printwmark'] = 'Vízjel';
$string['printwmark_help'] = 'A bizonyítvány hátterében vízjelet helyezhet el. A vízjel halványan megjelenő grafika, például logó, pecsét, címer vagy szöveg.';
$string['receivedcerts'] = 'Átvett bizonyítványok';
$string['receiveddate'] = 'Átvétel dátuma';
$string['removecert'] = 'Törölt kiállított bizonyítványok';
$string['report'] = 'Jelentés';
$string['reportcert'] = 'Bizonyítványokkal kapcsolatos jelentés';
$string['reportcert_help'] = 'Igen választása esetén a bizonyítvány átvételének napja, kódszáma és a kurzus neve megjelenik a felhasználó bizonyítvánnyal kapcsolatos jelentésében. Ha osztályzatot kíván a bizonyítványon feltüntetni, akkor az is megjelenik a felhasználó bizonyítvánnyal kapcsolatos jelentésében.';
$string['reviewcertificate'] = 'Bizonyítványának ellenőrzése';
$string['savecert'] = 'Bizonyítványok mentése';
$string['savecert_help'] = 'Ha ezt választja, az egyes felhasználók bizonyítványairól pdf-fájl készül a kurzus moddata mappájában. A bizonyítvánnyal kapcsolatos jelentésben ugrópont jelenik meg az egyes felhasználók elmentett bizonyítványához.';
$string['sigline'] = 'vonal';
$string['statement'] = 'elvégezte a kurzust';
$string['summaryofattempts'] = 'Korábban átvett bizonyítványok összegzése';
$string['textoptions'] = 'Szöveges lehetőségek';
$string['title'] = 'BIZONYÍTVÁNY';
$string['to'] = 'Adományozott';
$string['typeA4_embedded'] = 'beágyazott A4';
$string['typeA4_non_embedded'] = 'nem beágyazott A4';
$string['typeletter_embedded'] = 'beágyazott Letter';
$string['typeletter_non_embedded'] = 'nem beágyazott Letter';
$string['userdateformat'] = 'Dátumforma a felhasználó nyelvén';
$string['validate'] = 'Ellenőrzés';
$string['verifycertificate'] = 'Bizonyítvány ellenőrzése';
$string['viewcertificateviews'] = '{$a} kiállított bizonyítvány megtekintése';
$string['viewed'] = 'Bizonyítványának átvételi dátuma:';
$string['viewtranscript'] = 'Bizonyítványok megtekintése';
