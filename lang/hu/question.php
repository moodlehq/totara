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
 * Strings for component 'question', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Lépés';
$string['addanotherhint'] = 'Másik tipp hozzáadása';
$string['addcategory'] = 'Kategória hozzáadása';
$string['adminreport'] = 'Jelentés a kérdéseinek adatbázisával kapcsolatos esetleges problémákról.';
$string['answer'] = 'Válasz';
$string['answersaved'] = 'A válasz elmentve';
$string['attemptfinished'] = 'A próbálkozás véget ért';
$string['attemptfinishedsubmitting'] = 'A próbálkozás véget ért, leadás';
$string['availableq'] = 'Elérhető?';
$string['badbase'] = 'Hibás alap a **: {$a}** előtt';
$string['behaviour'] = 'Viselkedés';
$string['behaviourbeingused'] = 'Alkalmazott viselkedés: {$a}';
$string['broken'] = 'Az ugrópont "hibás", mert nem létező állományra mutat.';
$string['byandon'] = 'leadta {$a->user} ekkor: {$a->time}';
$string['cannotcopybackup'] = 'A biztonsági mentés állománya nem másolható';
$string['cannotcreate'] = 'Nem hozható létre új tétel a question_attempts táblázatban';
$string['cannotcreatepath'] = 'Nem hozható létre a(z) {$a} útvonal';
$string['cannotdeletebehaviourinuse'] = 'Nem törölheti a(z) {$a} viselkedést, mert a kérdéssel kapcsolatos próbálkozások használják.';
$string['cannotdeletecate'] = 'A kategóriát nem törölheti, mert az az adott környezetben az alapkategória.';
$string['cannotdeletemissingbehaviour'] = 'A hiányzó viselkedést nem távolíthatja el, a rendszernek szüksége van rá.';
$string['cannotdeletemissingqtype'] = 'A hiányzó kérdéstípus nem törölhető. A rendszernek szüksége van rá.';
$string['cannotdeleteneededbehaviour'] = 'Nem törölheti a(z) {$a} kérdésviselkedést, mert egyéb, rá épülő viselkedések használják.';
$string['cannotdeleteqtypeinuse'] = 'A \'{$a}\' kérdéstípus nem törölhető. A kérdésbankban vannak ilyen típusú kérdések.';
$string['cannotdeleteqtypeneeded'] = 'A \'{$a}\' kérdéstípus nem törölhető. Léteznek egyéb, ezzel összefüggő telepített kérdéstípusok.';
$string['cannotenable'] = 'A(z) {$a} kérdéstípus közvetlenül nem hozható létre.';
$string['cannotenablebehaviour'] = 'A(z) {$a} kérdésviselkedés közvetlenül nem használható, csak belső használatra szolgál.';
$string['cannotfindcate'] = 'Nincs meg a kategóriarekord.';
$string['cannotfindquestionfile'] = 'Nincs meg a tömörített állományban a kérdés adatállománya';
$string['cannotgetdsfordependent'] = 'Függő kérdéshez nem érhető el a megadott adatkészlet! (kérdés: {$a->id}, adatkészletelem:  {$a->item})';
$string['cannotgetdsforquestion'] = 'Számításos kérdéshez nem érhető el a megadott adatkészlet ! (kérdés: {$a})';
$string['cannothidequestion'] = 'Nem lehetett elrejteni a kérdést.';
$string['cannotimportformat'] = 'Ebben a formában még nem lehet importálni!';
$string['cannotinsertquestion'] = 'Az új kérdést nem sikerült beszúrni';
$string['cannotinsertquestioncatecontext'] = 'Nem lehetett beszúrni az új {$a->cat} kérdéskategóriát, érvénytelen {$a->ctx} környezetazonosító';
$string['cannotloadquestion'] = 'Nem lehetett kérdést betölteni.';
$string['cannotmovequestion'] = 'Ezzel a kóddal nem helyezhet át olyan kérdéseket, amelyekhez különböző területekről származó állományok kapcsolódnak.';
$string['cannotopenforwriting'] = 'Nem nyitható meg írásra a(z) {$a}';
$string['cannotpreview'] = 'Ezeket a kérdéseket nem tekintheti meg előre!';
$string['cannotread'] = 'Importálási fájl nem olvasható (vagy üres)';
$string['cannotretrieveqcat'] = 'A kérdéskategória elérése nem sikerült.';
$string['cannotunhidequestion'] = 'A kérdést nem sikerült megjeleníteni.';
$string['cannotunzip'] = 'A tömörített állományt nem sikerült kicsomagolni.';
$string['cannotwriteto'] = 'Az exportált kérdéseket nem lehet a(z) {$a} állományba írni';
$string['category'] = 'Kategória';
$string['categorycurrent'] = 'Mostani kategória';
$string['categorycurrentuse'] = 'Ezen kategória használata';
$string['categorydoesnotexist'] = 'A kategória nem létezik';
$string['categoryinfo'] = 'Kategóriáról szóló tájékoztató';
$string['categorymove'] = 'A(z) \'{$a->name}\' kategória {$a->count} kérdést tartalmaz (egy részük lehet régi, rejtett, de még néhány tesztben előfordul). Válassza ki, melyik kategóriába kerüljenek át.';
$string['categorymoveto'] = 'Mentés ezen kategória alatt';
$string['categorynamecantbeblank'] = 'A kategórianév nem lehet üres.';
$string['changeoptions'] = 'Beállítások módosítása';
$string['changepublishstatuscat'] = '<a href="{$a->caturl}">kategória megosztási állapota "{$a->name}"</a> a(z) "{$a->coursename}" kurzusban {$a->changefrom} helyett {$a->changeto} lesz.';
$string['check'] = 'Ellenőrzés';
$string['chooseqtypetoadd'] = 'Válassza ki a hozzáadandó kérdéstípust.';
$string['clearwrongparts'] = 'HIbás válaszok törlése';
$string['clickflag'] = 'A kérdés megjelölése';
$string['clicktoflag'] = 'A kérdés megjelölése későbbi hivatkozáshoz';
$string['clicktounflag'] = 'A kérdés megjelölésének törlése';
$string['clickunflag'] = 'A kérdés megjelölésének törlése';
$string['closepreview'] = 'Előnézet bezárása';
$string['combinedfeedback'] = 'Egyesített visszajelzés';
$string['comment'] = 'Megjegyzés';
$string['commented'] = 'A megjegyzést írta: {$a}';
$string['commentormark'] = 'Megjegyzés készítése vagy jegy felülírása';
$string['comments'] = 'Megjegyzések';
$string['commentx'] = 'Megjegyzés: {$a}';
$string['complete'] = 'Kész';
$string['contexterror'] = 'Nem kerülhet ide, ha nem egy kategóriát helyez át egy másik környezetbe.';
$string['copy'] = '{$a} másolása és ugrópontok módosítása.';
$string['correct'] = 'Helyes';
$string['correctfeedback'] = 'Minden helyes válasz esetén';
$string['created'] = 'Létrehozva';
$string['createdby'] = 'Létrehozta';
$string['createdmodifiedheader'] = 'Létrehozva/utoljára mentve';
$string['createnewquestion'] = 'Új kérdés létrehozása...';
$string['cwrqpfs'] = 'Véletlen kérdések alkategóriák kérdéseiből választva.';
$string['cwrqpfsinfo'] = '<p>A Moodle 1.9-re frissítés során a kérdéskategóriákat különféle környezetekre fogjuk bontani. Portálján néhány kérdés és kérdéskategória megosztását módosítani kell. Erre azon ritka esetekben lesz szükség, amikor egy tesztben egy vagy több \'véletlen\' kérdés megosztott és megosztatlan kategóriákból vegyesen kerül ki (mint ezen a portálon is). Ez olyankor fordul elő, amikor egy \'véletlen\' kérdés úgy van beállítva, hogy különböző megosztású alkategóriákból kerül a felettes kategóriába, ahol a véletlen kérdés létrejön. A felettes kategóriába választott \'véletlen\' kérdések közül az alábbiak kategóriájának a megosztása fog módosulni a felettes kategória megosztásának megfelelően a Moodle 1.9-re való frissítés során. Az érintett kérdések tovább működnek az adott tesztekben, amíg el nem távolítja őket.</p>';
$string['cwrqpfsnoprob'] = 'Portálján egy kérdéskategóriát sem érint a \'Véletlen kérdések alkategóriák kérdéseiből való választása\' probléma.';
$string['decimalplacesingrades'] = 'Tizedeshelyek a pontokban';
$string['defaultfor'] = '{$a} alapbeállítása';
$string['defaultinfofor'] = '\'{$a}\' környezet megosztott kérdéseinek alapkategóriája';
$string['defaultmark'] = 'Alapjegy';
$string['deletebehaviourareyousure'] = '{$a} viselkedés törlése: megerősíti?';
$string['deletebehaviourareyousuremessage'] = 'A(z) {$a} kérdésviselkedést teljes egészében törölni fogja. Ezzel a kérdésviselkedéssel kapcsolatos összes adatbázisban rögzített adatot is törli. BIZTOSAN ezt akarja?';
$string['deletecoursecategorywithquestions'] = 'A kérdésbank ezen kurzuskategóriához kapcsolódó kérdéseket tartalmaz. Ha folytatja, akkor törli őket. Először helyezze át őket a kérdésbank felületének segítségével.';
$string['deleteqtypeareyousure'] = 'Biztosan törli a(z)\'{$a}\' kérdéstípust?';
$string['deleteqtypeareyousuremessage'] = 'Teljesen törölni fogja a(z)\'{$a}\' kérdéstípust. Biztosan eltávolítja?';
$string['deletequestioncheck'] = 'Biztosan törli a(z) \'{$a}\'-t?';
$string['deletequestionscheck'] = 'Biztosan törli az alábbi kérdéseket?

{$a}';
$string['deletingbehaviour'] = '\'{$a}\' kérdésviselkedés törlése';
$string['deletingqtype'] = 'A(z)\'{$a}\' kérdéstípus törlése';
$string['didnotmatchanyanswer'] = '[Nem egyezett egy válasszal sem]';
$string['disabled'] = 'Kikapcsolva';
$string['disterror'] = 'A(z) {$a} szétosztás hibákat okozott';
$string['donothing'] = 'Ne másoljon vagy helyezzen át állományokat, és ne módosítson ugrópontokat.';
$string['editcategories'] = 'Kategóriák szerkesztése';
$string['editcategories_help'] = 'Egyetlen hosszú felsorolás helyett kérdéseit tárolhatja kategóriákba és alkategóriákba rendezve.
Minden kategóriának van egy környezete, amely megadja, a kategórián belül hol használhatók a kérdések.
* Tevékenység környezete - A kérdések csak a tevékenységmodulon belül érhetők el.
* Kurzus környezete - A kérdések a kurzuson belüli összes tevékenységmodulban elérhetők
* Kurzuskategória környezete - A kérdések a kurzuskategórián belüli összes tevékenységmodulban és kurzusban elérhetők
* Rendszer környezete - A kérdések a portál összes kurzusában és tevékenységében elérhetők
A kategóriák véletlen kérdések esetén is használhatók, mivel a kérdések kiválasztására egy konkrét kategóriából kerül sor.';
$string['editcategory'] = 'Kategória szerkesztése';
$string['editingcategory'] = 'Kategória szerkesztése';
$string['editingquestion'] = 'Kérdés szerkesztése';
$string['editquestion'] = 'Kérdés szerkesztése';
$string['editquestions'] = 'Kérdések szerkesztése';
$string['editthiscategory'] = 'Kategória szerkesztése';
$string['emptyxml'] = 'Ismeretlen hiba – üres az imsmanifest.xml';
$string['enabled'] = 'Bekapcsolva';
$string['erroraccessingcontext'] = 'Hiba a környezet elérése során';
$string['errordeletingquestionsfromcategory'] = 'Hiba történt a(z) {$a} kategóriába tartozó kérdések törlése során.';
$string['errorduringpost'] = 'Hiba történt utófeldolgozás közben!';
$string['errorduringpre'] = 'Hiba történt előfeldolgozás közben!';
$string['errorduringproc'] = 'Hiba történt feldolgozás közben!';
$string['errorduringregrade'] = 'Nem pontozható újra a(z) {$a->qid}, áttérés {$a->stateid} állapotba.';
$string['errorfilecannotbecopied'] = 'Hiba: a(z) {$a} állomány nem másolható.';
$string['errorfilecannotbemoved'] = 'Hiba: a(z) {$a} állomány nem helyezhető át.';
$string['errorfileschanged'] = 'Hiba: az űrlapkérdésekhez kapcsolt állományok az űrlap megjelenítése óta módosultak.';
$string['errormanualgradeoutofrange'] = 'A(z) {$a->grade} pontszám  {$a->name} kérdés esetén nem esik 0 és {$a->maxgrade} közé. A pontszám és a megjegyzés mentésére nem került sor.';
$string['errormovingquestions'] = 'Hiba történt a(z) {$a} azonosítójú kérdések áthelyezése közben.';
$string['errorpostprocess'] = 'Utófeldolgozás közben hiba történt!';
$string['errorpreprocess'] = 'Előfeldolgozás közben hiba történt!';
$string['errorprocess'] = 'Feldolgozás közben hiba történt!';
$string['errorprocessingresponses'] = 'Hiba történt válaszainak feldolgozása közben ({$a}). A Tovább gombra kattintva térhet vissza az előző oldalra és próbálkozhat ismét.';
$string['errorsavingcomment'] = 'Hiba történt az adatbázis {$a->name} kérdéséhez tartozó megjegyzés mentése közben.';
$string['errorsavingflags'] = 'Hiba a megjelölt állapot mentése közben';
$string['errorupdatingattempt'] = 'Hiba történt az adatbázis {$a->id} azonosítójú próbálkozásának frissítése közben';
$string['exportcategory'] = 'Kategória exportálása';
$string['exportcategory_help'] = '**Exportálási kategória**
A **Kategória:** a lenyíló menüből választhatja ki, mely kategóriából jöjjenek az exportált kérdések.
Egyes importálási formátumok (GIFT és XML) esetén a kategória bekerülhet az írott állományba, így a kategóriák (választhatóan) importáláskor újból előállíthatók. Ezen adatok hozzáadásához jelölje be a **Kategória kiírása állományba ** négyzetet. Ennek kiválasztása esetén beépítheti a kategória környezetét is, ha bejelöli a **Környezet kiírása állományba** négyzetet. A Moodle régebbi változataival való kompatibilitáshoz szüntesse meg a környezet kiválasztását.';
$string['exporterror'] = 'Hiba történt exportálás közben!';
$string['exportfilename'] = 'teszt';
$string['exportnameformat'] = '%É%h%n-%Ó%P';
$string['exportquestions'] = 'Kérdések exportálása állományba';
$string['exportquestions_help'] = 'Ezzel a funkcióval kérdések egész kategóriáját exportálhatjuk egy szöveges állományba.
Ne feledje, hogy egy sor fájlformátum esetén bizonyos információk elvesznek, ha exportálja a kérdéseket. Ennek az az oka, hogy számos formátum nem rendelkezik az összes olyan jellemzővel, amellyel a Moodle kérdései fel vannak ruházva. Nem várhatjuk el, hogy a kérdések exportálása és importálása után azok majd azonosak is lesznek. Ráadásul előfordulhat, hogy egyes kérdéstípusokat egyáltalán nem lehet exportálni. Ajánlatos az exportált adatokat ellenőrizni, mielőtt konkrét előállítási környezetben használná őket.
Egy sor állományformátumot támogat a rendszer. Az egyes súgóállományokban és a [Moodle Docs](http://docs.moodle.org/en/question/import) -ban megtalálja a részleteket.

Az importálási és exportálási formák külön használható programforrások. Más opcionális formátumokat találhat a modulok és segédprogramok adatbázisában.';
$string['feedback'] = 'Visszajelzés';
$string['filecantmovefrom'] = 'A kérdésállományokat nem helyezheti át, mert nincs meg a jogosultsága az állományok eltávolításához';
$string['filecantmoveto'] = 'A kérdésállományokat nem helyezheti át és nem másolhatja, mert nincs meg az állományok hozzáadásához a jogosultsága';
$string['fileformat'] = 'Állományforma';
$string['filesareacourse'] = 'a kurzusállományok területe';
$string['filesareasite'] = 'a portálállományok területe';
$string['filestomove'] = 'Állományok áthelyezése/másolása ide: {$a}?';
$string['fillincorrect'] = 'Töltse ki a helyes válaszokat.';
$string['flagged'] = 'Megjelölve';
$string['flagthisquestion'] = 'Megjelöli a kérdést';
$string['formquestionnotinids'] = 'Az űrlapon kérdésazonosítóval nem rendelkező kérdés szerepelt';
$string['fractionsnomax'] = 'Valamelyik válasz pontszámának 100%-nak kell lenni a kérdés teljes pontozhatósága érdekében.';
$string['generalfeedback'] = 'Általános visszajelzés';
$string['generalfeedback_help'] = 'Az általános visszajelzést a tanulók a kérdésre adott válasz nyomán látják. A kérdéstípustól és az adott választól függően más-más visszajelzés helyett az általános visszajelzés szövege minden tanuló esetén azonos.
Az általános visszajelzés használható a kérdés témájának vagy egy további uigrópontnak a megadására, ha netán a kérdést nem értették meg.';
$string['getcategoryfromfile'] = 'Kategória átvétele állományból';
$string['getcontextfromfile'] = 'Környezet átvétele állományból';
$string['hidden'] = 'Rejtett';
$string['hintn'] = '{}. tipp';
$string['hinttext'] = 'Tipp szövege';
$string['howquestionsbehave'] = 'A kérdések viselkedése';
$string['howquestionsbehave_help'] = 'A tanulók a teszt kérdéseivel különböző módokon kommunikálhatnak. Például: a tanár minden kérdésre választ kérhet a teljes teszt leadása, bármilyen osztályozás vagy egy visszajelzés megjelenítése előtt. Erre "halasztott visszajelzés" üzemmódban nyílik lehetőség. Másik megoldásként a tanulóknak minden választ azonnal be kell küldeni azért, hogy azonnal visszajelzést kapjanak, és ha a válaszuk egyből nem sikerült, kevesebb pontért ismét próbálkozhatnak. Ez az "interaktív üzemmód többszöri prüóbálkozással".';
$string['ignorebroken'] = 'Hibás ugrópontok kihagyása';
$string['importcategory'] = 'Kategória importálása';
$string['importcategory_help'] = 'A **Kategória:** lenyíló ablakból választható ki, mely kategóriába kerüljenek az importált kérdések.
Egyes importálási formátumok (GIFT és XML) esetén a kategória megadható az importálandó állományon belül.
Ehhez be kell jelölnie a **Kategória átvétele állományból** négyzetet. Ha nem, a kérdések az állományban lévő esetleges utasításoktól függetlenül a kiválasztott kategóriába kerülnek. A Moodle-ból exportált formátumokban szerepelhet a kategória szövegébe beépített kategóriakörnyezet. Az alapkörnyezet használatához szüntesse meg a **Környezet átvétele állományból** bejelölését.
Ha a kategóriák az importálandó állományon belül vannak megadva, de még nem léteznek, a rendszer létrehozza őket.';
$string['importerror'] = 'Hiba történt az importált adatok feldolgozása közben.';
$string['importerrorquestion'] = 'HIba történt a kérdés importálása közben.';
$string['importfromcoursefiles'] = '... vagy válasszon ki egy importálandó állományt.';
$string['importfromupload'] = 'Válasszon ki egy feltöltendő állományt...';
$string['importingquestions'] = '{$a} kérdés importálása állományból';
$string['importparseerror'] = 'Hiba történt az importált állomány feldolgozása közben. Kérdések importálására nem került sor. Az esetleges jó kérdések importálásához állítsa a \'Hiba esetén leállás\' pontot \'Nem\'-re.';
$string['importquestions'] = 'Kérdések importálása állományból';
$string['importquestions_help'] = 'Ezzel különféle formájú kérdéseket importálhat szöveges állományon keresztül. Ügyeljen arra, hogy a kódolásuk UTF-8 legyen!';
$string['importwrongfiletype'] = 'A kiválasztott állomány ({$a->actualtype}) típusa nem felel meg az importálási formához elvártnak ({$a->expectedtype}).';
$string['impossiblechar'] = 'Az elfogadhatatlan {$a} karaktert a rendszer zárójelként észleli';
$string['includesubcategories'] = 'Alkategóriák kérdései is jelenjenek meg.';
$string['incorrect'] = 'Hibás';
$string['incorrectfeedback'] = 'Hibás válasz esetén';
$string['information'] = 'Információ';
$string['invalidanswer'] = 'Hiányos válasz';
$string['invalidarg'] = 'Nincs megadva érvényes argumentum, vagy hibás a szerver beállítása.';
$string['invalidcategoryidforparent'] = 'Felettes kategóriához érvénytelen kategóriaazonosító!';
$string['invalidcategoryidtomove'] = 'Áthelyezéshez érvénytelen kategóriaazonosító!';
$string['invalidconfirm'] = 'A megerősítő szöveg hibás volt.';
$string['invalidcontextinhasanyquestions'] = 'Érvénytelen környezetet kapott a question_context_has_any_questions.';
$string['invalidpenalty'] = 'Érvénytelen büntetőpont';
$string['invalidwizardpage'] = 'Hibás, vagy nincs megadva varázslóoldal!';
$string['lastmodifiedby'] = 'Utoljára módosította';
$string['linkedfiledoesntexist'] = 'A(z) {$a} kapcsolt állomány nem létezik';
$string['makechildof'] = 'Legyen {$a} leszármazottja';
$string['makecopy'] = 'Másolat készítése';
$string['maketoplevelitem'] = 'Áthelyezés felső szintre';
$string['manualgradeoutofrange'] = 'A pontszám az érvényes tartományon kívül esik.';
$string['manuallygraded'] = 'Kézi pontozással {$a->mark}, megjegyzéssel {$a->comment}';
$string['mark'] = 'Osztályzat';
$string['markedoutof'] = 'leosztályozva';
$string['markedoutofmax'] = '{$a} közül leosztályozva';
$string['markoutofmax'] = '{$a->mark} közül {$a->max} leosztályozva';
$string['marks'] = 'Osztályzatok';
$string['matcherror'] = 'A pontok és a pontozási lehetőségek nem egyeznek - a kérdés kihagyva';
$string['matchgrades'] = 'Pontok egyeztetése';
$string['matchgrades_help'] = 'Az importált pontoknak meg **kell** felelni az érvényes pontszámok valamelyik rögzített értékének az alábbiak szerint...
* 100%
* 90%
* 80%
* 75%
* 70%
* 66.666%
* 60%
* 50%
* 40%
* 33,333
* 30%
* 25%
* 20%
* 16,666%
* 14,2857
* 12,5%
* 11,111%
* 10%
* 5%
* 0%

A fenti felsorolás negatív értékei úgyszintén megengedettek.
Ehhez a kapcsolóhoz kétféle beállítás létezik. Ezek határozzák meg azt, hogy az importálási rutin miként kezeli a fenti felsorolásnak **pontosan**
meg nem feleltethető értékeket.

\* **|Hiba, ha a pontszám nincs felsorolva**
Ha egy kérdés a felsorolásban nem szereplő értéket tartalmaz, hibajelzés jelenik meg és a kérdés importálása elmarad.
\* **|Legközelebbi pontszám, ha a pontszám nincs felsorolva**
Ha a rendszer a felsorolásban nem szereplő pontszámra bukkan, a pontszámot a felsorolásban legközelebbi értéknek felelteti meg.

*Megjegyzés: egyes egyedi importálási formátumok közvetlenül az adatbázisba írnak és kihagyják ezt az ellenőrzést.*';
$string['matchgradeserror'] = 'Hiba, ha a pont nincs felsorolva';
$string['matchgradesnearest'] = 'Legközlebbi, ha a pont nincs felsorolva';
$string['missingcourseorcmid'] = 'Kurzusazonosító vagy cmid szükséges a print_questionhez.';
$string['missingcourseorcmidtolink'] = 'A get_question_edit_link-hez courseid vagy cmid megadása szükséges.';
$string['missingimportantcode'] = 'A kérdéstípusból fontos kód hiányzik: {$a}.';
$string['missingoption'] = 'A(z) {$a} kitöltő kérdéshez nincsenek meg a választási lehetőségek';
$string['modified'] = 'Utoljára mentve';
$string['move'] = 'Áthelyezés innen: {$a}, és az ugrópontok módosítása.';
$string['movecategory'] = 'Kategória áthelyezése';
$string['movedquestionsandcategories'] = 'Kérdések és kérdéskategóriák áthelyezésére került sor {$a->oldplace} helyről {$a->newplace} helyre.';
$string['movelinksonly'] = 'Csak az ugrópontok hivatkozásának módosítása az állományok érintetlenül hagyásával.';
$string['moveq'] = 'Kérdés(ek) áthelyezése';
$string['moveqtoanothercontext'] = 'Kérdés áthelyezése másik környezetbe.';
$string['moveto'] = 'Áthelyezés >>';
$string['movingcategory'] = 'Kategória áthelyezése';
$string['movingcategoryandfiles'] = 'Biztosan áthelyezi a(z) {$a->name} kategóriát az alatta lévőkkel együtt "{$a->contextto}" környezetébe? A(z) {$a->fromareaname} területről való kérdésekhez {$a->urlcount} kapcsolt állományt találtunk, ezek vagy másolatuk átkerüljön a(z) {$a->toareaname} területre?';
$string['movingcategorynofiles'] = 'Biztosan áthelyezi a(z) "{$a->name}" kategóriát és az alatta lévőket a(z) "{$a->contextto}" környezetbe?';
$string['movingquestions'] = 'Kérdések és esetleges állományok áthelyezése';
$string['movingquestionsandfiles'] = 'Biztosan áthelyezi a(z) {$a->questions} kérdés(eke)t a(z) "{$a->tocontext}" környezetbe? A(z) {$a->fromareaname} területről való kérdésekhez {$a->urlcount} kapcsolt állományt találtunk, ezek vagy másolatuk átkerüljön a(z) {$a->toareaname} területre??';
$string['movingquestionsnofiles'] = 'Biztosan áthelyezi a(z) {$a->questions} kérdés(eke)t a(z) "{$a->tocontext}" környezetbe? A(z) {$a->fromareaname} területről való kérdés(ek)hez nincs hozzákapcsolt állomány.';
$string['needtochoosecat'] = 'A kérdés áthelyezéséhez válasszon egy kategóriát, vagy nyomja meg a \'Mégse\' gombot.';
$string['nocate'] = 'Nincs {$a} kategória!';
$string['nopermissionadd'] = 'Itt nem adhat hozzá kérdéseket.';
$string['nopermissionmove'] = 'Nincs engedélye kérdések áthelyezésére. Mentse el a kérdést ezen kategória alá, vagy mentse el új kérdésként.';
$string['noprobs'] = 'Kérdéseinek adatbázisa rendben van.';
$string['noquestions'] = 'Nincs exportálható kérdés. Ellenőrizze, hogy az exportálandó kategória tartalmaz-e kérdéseket.';
$string['noquestionsinfile'] = 'Az importálási állományban nincsenek kérdések';
$string['noresponse'] = '[Nincs válasz]';
$string['notanswered'] = 'Nincs rá válasz';
$string['notenoughanswers'] = 'Ehhez a kérdéstípushoz legalább {$a} választ kell megadni.';
$string['notenoughdatatoeditaquestion'] = 'Nem adott meg sem kérdésazonosítót, sem kategóriaazonosítót kérdéstípussal.';
$string['notenoughdatatomovequestions'] = 'Az áthelyezendő kérdések azonosítóit meg kell adnia.';
$string['notflagged'] = 'Nincs megjelölve';
$string['notgraded'] = 'Nincs lepontozva';
$string['notshown'] = 'Nem jelenik meg';
$string['notyetanswered'] = 'Még nincs rá válasz';
$string['notyourpreview'] = 'Az előnézet nem az Öné!';
$string['novirtualquestiontype'] = 'A(z) {$a} kérdéstípushoz nincs virtuális kérdés';
$string['numqas'] = 'A kérdésekkel még nem próbálkoztak';
$string['numquestions'] = 'Kérdésszám';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} rejtett)';
$string['options'] = 'Beállítások';
$string['page-question-category'] = 'Kérdéskategória oldala';
$string['page-question-edit'] = 'Kérdésszerkesztő oldal';
$string['page-question-export'] = 'Kérdésexportálás oldala';
$string['page-question-import'] = 'Kérdésimportálás oldala';
$string['page-question-x'] = 'Tetszőleges kérdésoldal';
$string['parent'] = 'Fentebbi';
$string['parentcategory'] = 'Felettes kategória';
$string['parentcategory_help'] = 'A felettes kategória az a kategória, amely alá az új kerül. A \'Fent\' azt jelenti, hogy a kategória semmilyen egyéb kategória alá nem tartozik. Általában több kategóriához tartozó környezet látható, ezek vastag betűkkel jelennek meg. Mindegyik környezetnek legalább egy kategóriát kell tartalmazni.';
$string['parenthesisinproperclose'] = 'A ** előtt a zárójel hibásan fejeződik be {$a}** esetén';
$string['parenthesisinproperstart'] = 'A ** előtt a zárójel hibásan indul {$a}** esetén';
$string['parsingquestions'] = 'Kérdések feldolgozása az importált állományból';
$string['partiallycorrect'] = 'Részben helyes';
$string['partiallycorrectfeedback'] = 'Részben helyes válasz esetén';
$string['penaltyfactor'] = 'Büntetési tényező';
$string['penaltyfactor_help'] = 'Megadhatja, hogy az elért pontok közül mennyied rész legyen levonva az egyes rossz válaszokért. Ennek csak akkor van jelentősége, ha a teszt adaptív módban üzemel és a tanuló újból próbálkozhat. A büntetési tényező egy 0 és 1 közötti szám. Az 1 azt jelenti, hogy a tanulónak már az első válasznál helyesen kell felelnie ahhoz, hogy egyáltalán pontot kapjon. 0 esetén a tanuló tetszése szerinti alkalommal próbálkozhat, mégis a teljes pontszámot kapja.';
$string['penaltyforeachincorrecttry'] = 'Levonás egy-egy helytelen próbálkozásért';
$string['penaltyforeachincorrecttry_help'] = 'Ha kérdéseit \'Interaktív többszöri próbálkozással\' vagy \'Adaptív üzemmód\' mellett futtatja és a tanuló többször próbálkozhat a kérdés helyes megválaszolása érdekében, akkor ez a beállítás szabályozza a levonásokat egy-egy hibás válasz esetén.
A levonás a kérdés összpontszámának százalékos aránya, így he egy kérdés három pontot ér és a levonás 0,333333, a tanuló az első helyes próbálkozására 3, a másodikra 2, a harmadikra 1 pontot kap.';
$string['permissionedit'] = 'Kérdés szerkesztése';
$string['permissionmove'] = 'Kérdés áthelyezése';
$string['permissionsaveasnew'] = 'Mentés új kérdésként';
$string['permissionto'] = 'Van engedélye erre:';
$string['previewquestion'] = '{$a} kérdés előnézete';
$string['published'] = 'megosztva';
$string['qbehaviourdeletefiles'] = 'A \'{$a->behaviour}\' kérdéskezeléshez kapcsolódó összes adat törlődött az adatbázisból. A törlés befejezéséhez (és az újratelepülés megelőzéséhez) törölje a könyvtárat {$a->directory} szerveréről.';
$string['qtypedeletefiles'] = 'A(z) \'{$a->qtype}\' kérdéstípushoz kapcsolódó összes adat törlődött az adatbázisból. A törlés befejezéséhez (és a kérdéstípus visszatelepülésének megakadályozásához) szerveréről törölnie kell ezt a könyvtárat: {$a->directory}.';
$string['qtypeveryshort'] = 'T';
$string['questionaffected'] = 'A(z) <a href="{$a->qurl}">kérdés "{$a->name}" ({$a->qtype})</a> ebben a kérdéskategóriában szerepel, de használja a(z) <a href="{$a->qurl}">teszt "{$a->quizname}"</a> egy másik kurzusban "{$a->coursename}".';
$string['questionbank'] = 'Kérdésbank';
$string['questionbehaviouradminsetting'] = 'A kérdéskezelés beállításai';
$string['questionbehavioursdisabled'] = 'Kikapcsolandó kérdéskezelés';
$string['questionbehavioursdisabledexplained'] = 'Vesszővel elválasztva sorolja fel azokat a kezelési módokat, amelyeket nem kíván megjeleníteni a lenyíló menüben.';
$string['questionbehavioursorder'] = 'Kérdéskezelési sorrend';
$string['questionbehavioursorderexplained'] = 'Vesszővel elválasztva sorolja fel a kezelési módokat a lenyíló menüben megjeleníteni kívánt sorrendben.';
$string['questioncategory'] = 'Kérdéskategória';
$string['questioncatsfor'] = 'Kérdéskategóriák ehhez: \'{$a}\'';
$string['questiondoesnotexist'] = 'A kérdés nem létezik';
$string['questionidmismatch'] = 'A kérdésazonosítók nem egyeznek';
$string['questionname'] = 'A kérdés neve';
$string['questionno'] = '{$a}. kérdés';
$string['questions'] = 'Kérdések';
$string['questionsaveerror'] = 'Hiba történt kérdés mentése közben - ({$a})';
$string['questionsinuse'] = '(* A csillaggal megjelölt kérdések már szerepelnek valamelyik tesztben. Ezek a kérdések csak a kategórialistából törlődnek, a tesztekből nem.)';
$string['questionsmovedto'] = 'Használatban lévő kérdéseket helyezett át "{$a}" alá a felettes kurzuskategóriában.';
$string['questionsrescuedfrom'] = 'Kérdések mentése {$a} környezetből.';
$string['questionsrescuedfrominfo'] = 'Ezekről a kérdésekről (melyek egy része lehet rejtett) mentés készült a(z) {$a} környezet törlésekor, mert egyes tesztekben vagy más tevékenységekben továbbra is szerepelnek.';
$string['questiontext'] = 'Kérdés szövege';
$string['questiontype'] = 'A kérdés típusa';
$string['questionuse'] = 'Kérdés használata ezen tevékenység során';
$string['questionvariant'] = 'Kérdésváltozat';
$string['questionx'] = '{$a} kérdés';
$string['requiresgrading'] = 'Pontozandó';
$string['responsehistory'] = 'Válasz előzménye';
$string['restart'] = 'Újraindítás';
$string['restartwiththeseoptions'] = 'Újraindítás ezekkel a beállításokkal';
$string['reviewresponse'] = 'Válasz átnézése';
$string['rightanswer'] = 'Helyes válasz';
$string['saved'] = 'Mentve: {$a}';
$string['saveflags'] = 'A jelölők állapotának mentése';
$string['selectacategory'] = 'Kategória kiválasztása:';
$string['selectaqtypefordescription'] = 'A leírás megtekintéséhez válasszon ki egy kérdéstípust.';
$string['selectcategoryabove'] = 'Fentről kategória kiválasztása';
$string['selectquestionsforbulk'] = 'A csoportos intézkedésekhez válasszon ki kérdéseket.';
$string['settingsformultipletries'] = 'Többszöri próbálkozás beállításai';
$string['shareincontext'] = 'Megosztás {$a} környezetében';
$string['showhidden'] = 'A régi kérdések is jelenjenek meg';
$string['showmarkandmax'] = 'Osztályzat és max. megjelenítése';
$string['showmaxmarkonly'] = 'Csak a max. osztályzat megjelenítése';
$string['shown'] = 'Megjelenítve';
$string['shownumpartscorrect'] = 'Helyes válaszok számának megjelenítése';
$string['shownumpartscorrectwhenfinished'] = 'Helyes válaszok számának megjelenítése a kérdés befejezése után';
$string['showquestiontext'] = 'A kérdés szövegének megjelenítése a kérdéslistában';
$string['specificfeedback'] = 'Egyedi visszajelzés';
$string['started'] = 'Elkezdődött';
$string['state'] = 'Állapot';
$string['step'] = 'Lépés';
$string['stoponerror'] = 'Hiba esetén leállás';
$string['stoponerror_help'] = 'Ez a beállítás szabja meg, hogy az importálás hiba esetén megszakadjon-e, így a kérdések importálása elmarad, vagy kimaradjanak a hibát tartalmazó kérdések, de az érvényes importálása megtörténjen.';
$string['submissionoutofsequence'] = 'Sikertelen hozzáférés. Tesztkérdések megoldása közben ne használja a Vissza gombot.';
$string['submissionoutofsequencefriendlymessage'] = 'A megadott adatok kívül lesnek az elfogadható tartományokon. Ez a böngésző Előre és Vissza gombjainak használata során fordulhat elő, melyeket teszt közben nem használhat. Akkor is ez történik, ha az oldal betöltése közben kattint valamire. A folytatáshoz kattintson a <strong>Tovább</strong> gombra.';
$string['submit'] = 'Leadás';
$string['submitandfinish'] = 'Leadás és befejezés';
$string['submitted'] = 'Leadás: {$a}';
$string['tofilecategory'] = 'Kategória kiírása állományba';
$string['tofilecontext'] = 'Környezet kiírása állományba';
$string['uninstallbehaviour'] = 'A kérdéskezelési mód eltávolítása';
$string['uninstallqtype'] = 'A kérdéstípus eltávolítása.';
$string['unknown'] = 'ismeretlen';
$string['unknownbehaviour'] = 'Ismeretlen kezelési mód: {$a}.';
$string['unknownquestion'] = 'Ismeretlen kérdés: {$a}.';
$string['unknownquestioncatregory'] = 'Ismeretlen kérdéskategória: {$a}.';
$string['unknownquestiontype'] = 'Ismeretlen kérdéstípus: {$a}.';
$string['unknowntolerance'] = 'Ismeretlen {$a} toleranciatípus';
$string['unpublished'] = 'nincs megosztva';
$string['upgradeproblemcategoryloop'] = 'Gond volt a kérdéskategóriák frissítésével. A kategóriafa hurkot tartalmaz. Az érintett kategóriaazonosítók: {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'A(z) {$a->name} ({$a->id}) kérdéskategória frissítése nem sikerült.';
$string['upgradeproblemunknowncategory'] = 'Gond volt a kérdéskategóriák frissítésével. A(z) {$a->id} kategória nem létező {$a->parent} felettes kategóriára hivatkozik. A hiba kijavításához módosult a felettes kategória.';
$string['whethercorrect'] = 'Ha helyes';
$string['withselected'] = 'A kiválasztottal';
$string['wrongprefix'] = 'Hibás formájú {$a} névelőtag';
$string['xoutofmax'] = '{$a->mark} közül {$a->max}';
$string['yougotnright'] = 'Jól választott ki: {$a->num}.';
$string['youmustselectaqtype'] = 'Válasszon kérdéstípust!';
$string['yourfileshoulddownload'] = 'Exportállományának letöltése hamarosan elkezdődik. Ha mégsem, kattintson <a href="{$a}">ide</a>.';
