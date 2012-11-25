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
 * Strings for component 'assignment', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   assignment
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addsubmission'] = 'Leadott munka hozzáadása';
$string['allowdeleting'] = 'Törlés engedélyezése';
$string['allowdeleting_help'] = 'Bekapcsolása esetén a résztvevők pontozás előtt bármikor törölhetnek
feltöltött állományokat.';
$string['allowmaxfiles'] = 'Feltöltött állományok maximális száma';
$string['allowmaxfiles_help'] = 'Az egyes résztvevők által feltölthető állományok maximális száma. A számot a tanulók nem látják, ezért a szükséges állományszámot a feladatleírásban kell megadni.';
$string['allownotes'] = 'Megjegyzések engedélyezése';
$string['allownotes_help'] = 'Bekapcsolása esetén a résztvevők megjegyzéseket írhatnak egy szöveges mezőbe.
Hasonló az online szöveges feladathoz.
A szövegmező alkalmas az értékelővel való kapcsolattartásra, a feladat
folyamatának leírására vagy bármely egyéb írásbeli tevékenység végrehajtására.';
$string['allowresubmit'] = 'Ismételt leadás engedélyezése';
$string['allowresubmit_help'] = 'Alaphelyzetben a tanulók nem adhatják le ismételten a feladatukat,
ha a tanár már lepontozta őket.
Ha ezt az opciót bekapcsolja, a tanulók pontozás után is újból
leadhatják a feladatot (újbóli lepontozás céljából). Ez olyankor lehet
hasznos, ha a tanár arra kívánja ösztönözni a tanulókat, hogy egy ismétléses
folyamat révén fejlődést érjenek el.
Egyértelmű, hogy az ilyen opció irreleváns offline feladat esetén.';
$string['alreadygraded'] = 'Feladatának pontozása már megtörtént, újbóli leadásra nincs lehetőség.';
$string['assignment:exportownsubmission'] = 'Saját leadás exportálása';
$string['assignment:exportsubmission'] = 'Leadás exportálása';
$string['assignment:grade'] = 'Feladat pontozása';
$string['assignment:submit'] = 'Feladat leadása';
$string['assignment:view'] = 'Feladat megtekintése';
$string['assignmentdetails'] = 'Feladat részletei';
$string['assignmentmail'] = '{$a->teacher} véleményezte a(z) \'{$a->assignment}\' feladatot. A vélemény a feladathoz csatolva megtekinthető itt: {$a->url}';
$string['assignmentmailhtml'] = '{$a->teacher} véleményezte a(z) \'{$a->assignment}\' feladatot.<br /><br />A vélemény a <a href="{$a->url}">leadott feladathoz csatolva</a> megtekinthető.';
$string['assignmentmailsmall'] = '{$a->teacher} tanér visszajelzést küldött \'{$a->assignment}\' feladatához. A leadott munkához mellékelve jelenik meg.';
$string['assignmentname'] = 'Feladat neve';
$string['assignmentsubmission'] = 'Leadott feladatok';
$string['assignmenttype'] = 'Feladat típusa';
$string['availabledate'] = 'Elérhető ekkortól:';
$string['cannotdeletefiles'] = 'Hiba történt, az állományokat nem lehetett törölni';
$string['cannotviewassignment'] = 'Ezt a feladatot nem tekintheti meg';
$string['comment'] = 'Megjegyzés';
$string['commentinline'] = 'Sorközi megjegyzés';
$string['commentinline_help'] = 'Kiválasztása esetén pontozás során az eredeti leadott munka a visszajelzési
megjegyzések mezőjébe másolódik, így könnyebb (esetleg más színnel)
sorközi megjegyzésekkel ellátni, illetve az eredeti szöveget szerkeszteni.';
$string['configitemstocount'] = 'Online feladatokban a tanulói leadott munkákhoz megszámolandó elemek típusa.';
$string['configmaxbytes'] = 'Az adott portálon az összes feladat maximális mérete alaphelyzetben (a kurzustól és egyéb helyi beállításoktól függően).';
$string['configshowrecentsubmissions'] = 'A tevékenységekről szóló utóbbi jelentésekben bárki megtekintheti a leadott munkákkal kapcsolatos értesítéseket.';
$string['confirmdeletefile'] = 'Biztosan törölni akarja ezt az állományt <br /><strong>{$a}</strong>?';
$string['coursemisconf'] = 'A kurzus hibásan van konfigurálva';
$string['currentgrade'] = 'Aktuális osztályzat az osztályozónaplóban';
$string['deleteallsubmissions'] = 'Az összes leadott munka törlése';
$string['deletefilefailed'] = 'Az állomány törlése nem sikerült.';
$string['description'] = 'Leírás';
$string['downloadall'] = 'Az összes feladat letöltése tömörített állományban';
$string['draft'] = 'Piszkozat';
$string['due'] = 'Feladat határideje';
$string['duedate'] = 'Határidő';
$string['duedateno'] = 'Nincs határidő';
$string['early'] = '{$a} korai';
$string['editmysubmission'] = 'Leadott munkám szerkesztése';
$string['editthesefiles'] = 'Az állományok szerkesztése';
$string['editthisfile'] = 'Az állomány frissítése';
$string['emailstudents'] = 'Figyelmeztetések elküldése a tanulóknak e-mailben';
$string['emailteachermail'] = '{$a->username} {$a->timeupdated}  időpontban frissítette a(z) {$a->assignment}  feladathoz leadott munkáját. Itt érhető el: {$a->url}';
$string['emailteachermailhtml'] = '{$a->username} {$a->timeupdated}  időpontban frissítette a(z) <i>\'{$a->assignment}\'</i><br /><br /> feladathoz leadott munkáját.<br></br>Elérhető a(z) <a href="{$a->url}"> weboldalon</a>.';
$string['emailteachers'] = 'Tanárok figyelmeztetése e-mailben';
$string['emailteachers_help'] = 'Bekapcsolása esetén a tanárok rövid e-mailben értesítést kapnak, ha a tanulók feladatot
adnak le vagy frissítenek.
Csak az adott munkát osztályozni képes tanárok kapnak figyelmeztetést.
Ha egy kurzus csoportokra van bontva, az adott csoporthoz beosztott tanárok nem kapnak értesítést más csoportok tanulóiról.
Offline tevékenységek esetén természetesen nem történik e-mailek küldése,
mivel a tanulók soha nem adnak le anyagot.';
$string['emptysubmission'] = 'Még semmit nem adott le';
$string['enablenotification'] = 'Meglévő fájl törölve: {$a}';
$string['enablenotification_help'] = 'Bekapcsolása esetén a tanulók e-mailben kapnak értesítést pontjaikról és a visszajelzésekről.
Személyes beállításait a rendszer elmenti és minden Ön által pontozott leadott munka esetén alkalmazza.';
$string['errornosubmissions'] = 'Nincs letölthető leadott munka';
$string['existingfiledeleted'] = 'Meglévő fájl törölve: {$a}';
$string['failedupdatefeedback'] = '{$a} felhasználó leadott munkájához a visszajelzés frissítése nem sikerült';
$string['feedback'] = 'Visszajelzés';
$string['feedbackfromteacher'] = 'Visszajelzés {$a} részéről';
$string['feedbackupdated'] = 'A leadott munkára adott visszajelzés frissítve {$a} számára';
$string['finalize'] = 'Leadott munka frissítésének megakadályozása';
$string['finalizeerror'] = 'Hiba történt, a leadott munkát nem lehetett lezárni';
$string['graded'] = 'Pontozott';
$string['guestnosubmit'] = 'Vendégek nem adhatnak le feladatokat. A válasz leadása előtt be kell jelentkeznie vagy regisztráltatnia kell magát.';
$string['guestnoupload'] = 'Vendégek nem tölthetnek fel állományokat.';
$string['helpoffline'] = '<p>Ez akkor hasznos, amikor a feladat végrehajtása a Moodle-on kívül történik. Erre sor kerülhet valahol máshol a weben, illetve tantermi órán.</p><p>A tanulók látják a feladat leírását, de nem tudnak állományokat feltölteni. A pontozás a szokásos módon történik, a tanulók pontjaikról értesítést kapnak.</p>';
$string['helponline'] = '<p>Ezen feladattípus esetén a felhasználók szokásos szerkesztőjükkel szerkesztenek szöveget. A tanárok online pontozhatnak, sőt, sorközi megjegyzéseket tehetnek, illetve módosíthatják a szöveget. (A Moodle régebbi változataiban ez a feladattípus a régi naplómodullal volt azonos.)</p>';
$string['helpupload'] = 'Ezen feladattípus esetén minden résztvevő tetszőleges formátumú és számú állományt feltölthet. Ezek lehetnek Word-dokumentumok, képek, tömörített weboldalak, bármi, amit le szeretne adatni velük.
Emellett több tanuló által adott válasz is feltölthető. A válaszok állományait leadás előtt is fel lehet tölteni, így megoldható, hogy az egyes résztvevők más-más állományon dolgozzanak.
A résztvevők megjegyzéseket írhatnak a leadott állományokhoz, előrehaladásuk adott állapotához, illetve tetszőleges szöveget fűzhetnek hozzájuk.
Az ilyen feladatok leadását a résztvevőknek kézzel kell befejezni. A pillanatnyi állapotot bármikor megtekintheti, a befejezetlen feladatok Piszkozat megjelölést kapnak. A pontozatlan feladat visszaállítható piszkozati állapotba.';
$string['helpuploadsingle'] = '<p>Ezen feladattípus esetén a résztvevők egyetlen, tetszőleges típusú állományt tölthetnek fel. Ez lehet egy Word-állomány, egy kép, egy tömörített honlap, bármi, amit a tanár előír.</p>';
$string['hideintro'] = 'Leírás elrejtése az elérhetőség időpontjáig';
$string['hideintro_help'] = 'Bekapcsolása esetén a feladatleírás a kezdési időpont előtt rejtve marad.';
$string['invalidassignment'] = 'Érvénytelen feladat';
$string['invalidfileandsubmissionid'] = 'Hiányzó állomány vagy leadott munka';
$string['invalidid'] = 'Érvénytelen feladatazonosító';
$string['invalidsubmissionid'] = 'Érvénytelen leadott munkához tartozó azonosító';
$string['invalidtype'] = 'Érvénytelen feladattípus';
$string['invaliduserid'] = 'Érvénytelen felhasználói azonosító';
$string['itemstocount'] = 'Szám';
$string['lastgrade'] = 'Utolsó osztályzat';
$string['late'] = '{$a} kései';
$string['maximumgrade'] = 'Maximális pont';
$string['maximumsize'] = 'Maximális méret';
$string['maxpublishstate'] = 'Blogüzenet maximális láthatósága leadási idő előtt';
$string['messageprovider:assignment_updates'] = 'Feladathoz kapcsolódó értesítések';
$string['modulename'] = 'Feladat';
$string['modulename_help'] = 'A feladatokkal a tanár a tanulót (tetszőleges formájú) digitális tartalom
elkészítésére és leadására kérheti, melyet a szerveren keresztül
tölthet föl a rendszerbe. Jellegzetes feladatként megemlíthető az esszé, a projekt, a jelentés stb.
Ez a modul magában foglalja a pontozási eszközöket is.';
$string['modulenameplural'] = 'Feladatok';
$string['newsubmissions'] = 'Feladatok leadva';
$string['noassignments'] = 'Még nincsenek feladatok';
$string['noattempts'] = 'Ezzel a feladattal még nem próbálkoztak';
$string['noblogs'] = 'Nincs beküldendő blogüzenete!';
$string['nofiles'] = 'Nem adott le állományokat';
$string['nofilesyet'] = 'Még nem adott le állományokat';
$string['nomoresubmissions'] = 'Nem lehet több munkát leadni.';
$string['norequiregrading'] = 'Nincs pontozást igénylő feladat.';
$string['nosubmisson'] = 'Nincs leadva feladat.';
$string['notavailableyet'] = 'Ez a feladat még nem elérhető.<br></br>A feladattal kapcsolatos utasítások az alább megadott időpontban lesznek itt megtekinthetők.';
$string['notes'] = 'Megjegyzések';
$string['notesempty'] = 'Nincs bejegyzés';
$string['notesupdateerror'] = 'Hiba a megjegyzések frissítése közben';
$string['notgradedyet'] = 'Még nincs pontozva';
$string['notsubmittedyet'] = 'Még nincs leadva';
$string['onceassignmentsent'] = 'Ha a feladatot beküldi értékelésre, többé nem törölhet vagy mellékelhet állomány(oka)t. Folytatja?';
$string['operation'] = 'Művelet';
$string['optionalsettings'] = 'Választható beállítások';
$string['overwritewarning'] = 'Vigyázat: az újrafeltöltés FELÜLÍRJA a most leadott munkát';
$string['page-mod-assignment-submissions'] = 'Feladat modul leadás oldala';
$string['page-mod-assignment-view'] = 'Feladat modul fő oldala';
$string['page-mod-assignment-x'] = 'Feladat modul tetszőleges oldala';
$string['pagesize'] = 'Oldalanként látható leadott munkák száma';
$string['pluginadministration'] = 'Feladat kezelése';
$string['pluginname'] = 'Feladat';
$string['popupinnewwindow'] = 'Megnyitás előugró ablakban';
$string['preventlate'] = 'Kései leadások megakadályozása';
$string['quickgrade'] = 'Gyors pontozás engedélyezése';
$string['quickgrade_help'] = 'Bekapcsolt gyors pontozás esetén egy oldalon több feladatot gyorsan leosztályozhat.
A pontok és megjegyzések módosítása után nyomja meg a Mentés gombot az adott oldal összes módosításának mentéséhez.
A jobb oldalon lévő szokásos pontozási gombok továbbra is használhatók, ha több helyre van szüksége.
A gyors pontozáshoz használt beállításait a rendszer elmenti és minden kurzus minden feladatánál ezt fogja használni.';
$string['requiregrading'] = 'Pontozás előírása';
$string['responsefiles'] = 'Tanulók által adott válaszok állományai';
$string['reviewed'] = 'Ellenőrizve';
$string['saveallfeedback'] = 'Minden visszajelzésem mentése';
$string['selectblog'] = 'Válassza ki a beküldendő blogüzenetet.';
$string['sendformarking'] = 'Beküldés értékelésre';
$string['showrecentsubmissions'] = 'Legutóbbi leadott munkák megjelenítése';
$string['submission'] = 'Leadott munka';
$string['submissiondraft'] = 'Leadott munka piszkozata';
$string['submissionfeedback'] = 'Leadott munkára adott visszajelzés';
$string['submissions'] = 'Leadott munkák';
$string['submissionsaved'] = 'A módosítások mentése megtörtént';
$string['submissionsnotgraded'] = '{$a} leadott munka nincs pontozva';
$string['submitassignment'] = 'Ezzel az űrlappal küldje be feladatát';
$string['submitedformarking'] = 'A feladatot már beküldte értékelésre, ezért nem frissíthető';
$string['submitformarking'] = 'Végső leadott munka a feladat értékelésére';
$string['submitted'] = 'Leadva';
$string['submittedfiles'] = 'Leadott állományok';
$string['subplugintype_assignment'] = 'Feladat típusa';
$string['subplugintype_assignment_plural'] = 'Feladattípusok';
$string['trackdrafts'] = 'A Beküldés osztályozásra bekapcsolása';
$string['trackdrafts_help'] = 'Az "Elküldés osztályozásra" gombbal a felhasználók jelezhetik a pontozók számára, hogy végeztek egy feladattal. A pontozók eldönthetik, hogy a feladatot visszaminősítik-e piszkozattá (ha pl. azon tovább kell még dolgozni).';
$string['typeblog'] = 'Blogüzenet';
$string['typeoffline'] = 'Offline tevékenység';
$string['typeonline'] = 'Online szöveg';
$string['typeupload'] = 'Állományok továbbfejlesztett feltöltése';
$string['typeuploadsingle'] = 'Egyetlen állomány feltöltése';
$string['unfinalize'] = 'Visszaállítás piszkozattá';
$string['unfinalize_help'] = 'Ha visszatér a piszkozathoz, a tanuló tovább módosíthat feladatán.';
$string['unfinalizeerror'] = 'Hiba történt, a leadott munkát nem lehetett visszaalakítani piszkozattá';
$string['uploadafile'] = 'Egy állomány feltöltése';
$string['uploadbadname'] = 'Az állománynév hibás karaktereket tartalmaz, ezért nem tölthető fel';
$string['uploadedfiles'] = 'feltöltött állományok';
$string['uploaderror'] = 'Az állomány szerverre mentése közben hiba történt';
$string['uploadfailnoupdate'] = 'A feltöltés rendben, de nem lehet frissíteni a leadott munkát!';
$string['uploadfiles'] = 'Állományok feltöltése';
$string['uploadfiletoobig'] = 'Az állomány túl nagy (a korlát {$a} bájt)';
$string['uploadnofilefound'] = 'Nem található állomány - biztosan kiválasztott egyet feltöltésre?';
$string['uploadnotregistered'] = 'A(z) \'{$a}\' feltöltése sikerült, de a leadott munka nincs regisztrálva!';
$string['uploadsuccess'] = 'A(z) \'{$a}\' feltöltése sikerült';
$string['usermisconf'] = 'A felhasználó hibásan van konfigurálva';
$string['usernosubmit'] = 'Ön nem adhat le feladatot.';
$string['viewfeedback'] = 'A feladat pontjainak és a visszajelzéseknek a megtekintése';
$string['viewmysubmission'] = 'Beküldött anyagaim megtekintése';
$string['viewsubmissions'] = '{$a} leadott feladat megtekintése';
$string['yoursubmission'] = 'Leadott munkája';
