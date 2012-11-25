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
 * Strings for component 'grades', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   grades
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activities'] = 'Tevékenységek';
$string['addcategory'] = 'Kategória hozzáadása';
$string['addcategoryerror'] = 'Kategória hozzáadása nem sikerült.';
$string['addexceptionerror'] = 'Hiba userid:gradeitem-hez való kivétel hozzáadása közben';
$string['addfeedback'] = 'Visszajelzés hozzáadása';
$string['addgradeletter'] = 'Pontozási betű hozzáadása';
$string['addidnumbers'] = 'Azonosítószámok hozzáadása';
$string['additem'] = 'Pontozási tétel hozzáadása';
$string['addoutcome'] = 'Eredmény hozzáadása';
$string['addoutcomeitem'] = 'Eredményelem hozzáadása';
$string['addscale'] = 'Skála hozzáadása';
$string['aggregateextracreditmean'] = 'Átlagpontszám (külön kreditekkel)';
$string['aggregatemax'] = 'Legmagasabb pont';
$string['aggregatemean'] = 'Átlagpontszám';
$string['aggregatemedian'] = 'Pontok középértéke';
$string['aggregatemin'] = 'Legalacsonyabb pont';
$string['aggregatemode'] = 'Leggyakoribb pont';
$string['aggregateonlygraded'] = 'Csak a nem üres pontok összegzése';
$string['aggregateonlygraded_help'] = 'A nem létező pontokat vagy minimális pontokként kezeli, vagy kihagyja az összesítésből.';
$string['aggregateoutcomes'] = 'Eredmények szerepeltetése az összegzésben';
$string['aggregateoutcomes_help'] = 'Ha az eredményeket beleveszi az összesítésbe, ezzel nem állhat elő a kívánt globális pont, ezért választhat: beleveszi vagy kihagyja őket.';
$string['aggregatesonly'] = 'Csak az összegzések';
$string['aggregatesubcats'] = 'Összegzés alkategóriákkal együtt';
$string['aggregatesubcats_help'] = 'Az összesítés általában csak a közvetlen alkategóriákkal történik, de lehetőség van az összes alkategóriában lévő pontok összesítésére, a többi összesített pont kirekesztésével.';
$string['aggregatesum'] = 'Összes pont';
$string['aggregateweightedmean'] = 'Pontok súlyozott átlaga';
$string['aggregateweightedmean2'] = 'Pontok egyszerű súlyozott átlaga';
$string['aggregation'] = 'Összegzés';
$string['aggregation_help'] = 'Az összesítés szabja meg, hogy egy kategória esetén az osztályzatok miként kombinálódnak.
* Osztályzatok átlaga - Az összes pont összege a pontok számával elosztva.
* Osztályzatok felezőértéke - Méret szerint rendezett osztályzatok esetén a középső osztályzat
* Legalacsonyabb osztályzat
* Legmagasabb osztályzat
* Osztályzatok módusza - A módusz a leggyakrabban előforduló osztályzat
* Osztályzatok összege - Az összes osztályzatérték összege. A skálaosztályzatokat a rendszer figyelmen kívül hagyja.';
$string['aggregationcoef'] = 'Összegzési együttható';
$string['aggregationcoefextra'] = 'Külön kreditpont';
$string['aggregationcoefextra_help'] = '## A pontösszeg szerinti összesítéshez
A pontösszeg szerinti összesítés alkalmazása esetén a pontozási tétel lehet az adott kategóriához tartozó plusz kreditpont.
Vagyis a kategória összes maximális pontjához nem a pontozási tételre adott maximális pont adódik hozzá, hanem a tételre adott pont. Íme egy példa:

* Az 1. tétel 0-100 pontozású.
* A 2. tétel 0-75 pontozású.
* Az 1. tételnél a "Plusz kreditpontként működik" jelölőnégyzet be van jelölve, szemben a 2. tétellel.
* Mindkét tétel az 1. kategóriához tartozik, amely a pontösszeg szerinti összesítést alkalmazza.
* Az 1. kategóriához tartozó összesen 0-75 pontozású lesz.
* Egy tanuló 20 pontot kap az 1. és 70-et a 2. tételre.
* A tanuló esetén az 1. kategóriához tartozó összesen 75/75 lesz (20+70 = 90, de az 1. tétel csak plusz kreditpontként működik,
így annak összesenje eléri a maximumot).

## Pontok súlyozott átlaga esetén (plusz kreditpont)
Összesítés során egy 0-nál nagyobb érték esetén a pontozási tételre adott pontokat a rendszer plusz kreditpontként kezeli.
A szám az a tényező, amellyel a pontértéket meg kell szorozni, mielőtt hozzáadódik az összes pont összegéhez,
de maga a tétel kimarad az osztásból. Pl.:

* Az 1. tétel 0-100 pontozású, plusz kreditpontjának értéke 2.
* A 2. tétel 0-100 pontozású, plusz kreditpontjának értéke megmarad 0.0000.
* A 3. tétel 0-100 pontozású, plusz kreditpontjának értéke megmarad 0.0000.
* Mindhárom tétel az 1. kategóriához tartozik, amely a pontok súlyozott átlagát alkalmazza (plusz kreditpontokkal).
* Egy tanuló 20 pontot kap az 1., 40-et a 2. és 70-et a 3. tételre.
* A tanuló esetén az 1. kategóriához tartozó összesen 95/100 lesz, mivel 20*2 + (40 + 70)/2 = 95.';
$string['aggregationcoefextrasum'] = 'Külön kreditpont';
$string['aggregationcoefextrasum_help'] = 'Ha a Pluszpont négyzet be van jelölve, a pontozási tétel maximális pontja nem adódik hozzá a kategória maximális pontjához. Így a kategórián belül a maximális pont (vagy, ha a rendszergazda engedélyezi, a maximális fölötti pont) anélkül érhető el, hogy minden pontozási tétel esetén meglenne a maximális pont.';
$string['aggregationcoefextraweight'] = 'Külön kreditpont súlya';
$string['aggregationcoefextraweight_help'] = 'A 0-nál nagyobb érték ezen pontozási tétel pontjait összegzés során külön kreditpontként kezeli. A szám az a tényező, amellyel a pontérték megszorzódik, mielőtt az összes pont összegéhez hozzáadódik, de maga a tétel az osztásba nem számít bele. Például:

* Az 1. tétel pontja 0-100, "külön kreditpont" értéke pedig 2
* A 2. tétel pontja 0-100, "külön kreditpont" értéke pedig 0,0000 marad
* A 3. tétel pontja 0-100, "külön kreditpont" értéke pedig 0,0000 marad
* Mindhárom tétel az 1. kategóriába tartozik, melynek "Pontátlaga (külön kreditpontokkal együtt)" jelenti összegzési stratégiáját
* Egy tanuló az 1. tételre 20 pontot, a 2.-ra 40-et, a 3.-ra 70-et kap
* A tanuló 1. kategóriára kapott pontja összesen 95/100 lesz, mivel 20*2 + (40 + 70)/2 = 95';
$string['aggregationcoefweight'] = 'Tétel súlya';
$string['aggregationcoefweight_help'] = 'Az egyéb pontozási tételekkel való összegzés során a jelen pontozási tétel összes pontjára alkalmazott súly.';
$string['aggregationposition'] = 'Összegzési pozíció';
$string['aggregationposition_help'] = 'Meghatározza az összegzés összege oszlopának a helyzetét a jelentésben az összegezendő pontokhoz viszonyítva.';
$string['aggregationsvisible'] = 'Használható összegzési típusok';
$string['aggregationsvisiblehelp'] = 'Válassza ki az összes használandó összegzési típust. Több elem kiválasztásához nyomja le a Ctrl-billentyűt.';
$string['allgrades'] = 'Kategóriánként az összes pont';
$string['allstudents'] = 'Minden tanuló';
$string['allusers'] = 'Minden felhasználó';
$string['autosort'] = 'Automatikus rendezés';
$string['availableidnumbers'] = 'Használható azonosítószámok';
$string['average'] = 'Átlag';
$string['averagesdecimalpoints'] = 'Oszlopátlagok tizedesjegyei';
$string['averagesdecimalpoints_help'] = 'Meghatározza, hány tizedesjegy jelenjen meg az egyes oszlopátlagok esetén. Az Öröklés kiválasztása esetén az egyes oszlopok megjelenítési típusa lesz használatos.';
$string['averagesdisplaytype'] = 'Oszlopátlagok megjelenítésének típusa';
$string['averagesdisplaytype_help'] = 'Meghatározza, hogyan jelenjen meg átlag az egyes oszlopok esetén. Az Öröklés kiválasztása esetén az egyes oszlopok megjelenítési típusa lesz használatos.';
$string['backupwithoutgradebook'] = 'A biztonsági mentés nem tartalmazza az osztályozónapló beállítását';
$string['badgrade'] = 'A megadott pont érvénytelen';
$string['badlyformattedscale'] = 'Adjon meg egy vesszőkkel elválasztott értéklistát (legalább két értékkel).';
$string['baduser'] = 'A megadott felhasználó érvénytelen';
$string['bonuspoints'] = 'Jutalompontok';
$string['bulkcheckboxes'] = 'Vegyes jelölőnégyzetek';
$string['calculatedgrade'] = 'Számított pont';
$string['calculation'] = 'Számítás';
$string['calculation_help'] = 'A pontszámítás az osztályzat meghatározására használt képlet. A képlet egyenlőségjellel (=) kezdődik, és szokásos matematikai műveletjeleket -- pl. max, min és sum -- tartalmazhat. Szükség esetén egyéb pontozási tételek illeszthetők a számításba: ehhez kettős szögletes zárójelben adja meg az azonosítószámokat.';
$string['calculationadd'] = 'Számítás hozzáadása';
$string['calculationedit'] = 'Számítás szerkesztése';
$string['calculationsaved'] = 'Számítás elmentve';
$string['calculationview'] = 'Számítás megtekintése';
$string['cannotaccessgroup'] = 'A kiválasztott csoport pontjai nem érhetők el.';
$string['categories'] = 'Kategóriák';
$string['categoriesanditems'] = 'Kategóriák és elemek';
$string['categoriesedit'] = 'Kategóriák és elemek szerkesztése';
$string['category'] = 'Kategória';
$string['categoryedit'] = 'Kategória szerkesztése';
$string['categoryname'] = 'Kategória neve';
$string['categorytotal'] = 'Kategória összes pontszáma';
$string['categorytotalfull'] = '{$a->category} összesen';
$string['categorytotalname'] = 'Kategória összegzésének neve';
$string['changedefaults'] = 'Alapbeállítások módosítása';
$string['changereportdefaults'] = 'Jelentés alapbeállításainak módosítása';
$string['chooseaction'] = 'Válasszon egy lépést ...';
$string['choosecategory'] = 'Kategória kiválasztása';
$string['combo'] = 'Tabulátorok és lenyíló menü';
$string['compact'] = 'Tömör';
$string['contract'] = 'Szerződéskategória';
$string['controls'] = 'Vezérlőelemek';
$string['courseavg'] = 'Kurzusátlag';
$string['coursegradecategory'] = 'Kurzuspontok kategóriája';
$string['coursegradedisplaytype'] = 'Kurzuspontok megjelenítési típusa';
$string['coursegradedisplayupdated'] = 'A kurzuspontok megjelenítési típusának frissítése megtörtént.';
$string['coursegradesettings'] = 'Kurzuspontok beállításai';
$string['coursename'] = 'Kurzus neve';
$string['coursescales'] = 'Kurzusskálák';
$string['coursesettings'] = 'Kurzus beállításai';
$string['coursesettingsexplanation'] = 'A kurzus beállításaitól függ, miként jelenik meg a kurzus résztvevői számára az osztályozónapló.';
$string['coursetotal'] = 'Kurzus összegezve';
$string['createcategory'] = 'Kategória létrehozása';
$string['createcategoryerror'] = 'Új kategória létrehozása nem sikerült';
$string['creatinggradebooksettings'] = 'Osztályozónapló beállításainak létrehozása';
$string['csv'] = 'CSV';
$string['currentparentaggregation'] = 'Jelenlegi szülők egyesítése';
$string['curveto'] = 'Görbe';
$string['decimalpoints'] = 'Összes tizedesjegy';
$string['decimalpoints_help'] = 'Megadja, hány tizedeshely jelenjen meg az egyes pontoknál. A beállításnak a számításokra nincs hatása, azok 5 tizedesnyi pontossággal állnak elő.';
$string['default'] = 'Alapbeállítás';
$string['defaultprev'] = 'Alapbeállítás ({$a})';
$string['deletecategory'] = 'Kategória törlése';
$string['disablegradehistory'] = 'Pont előzményeinek kikapcsolása';
$string['disablegradehistory_help'] = 'A pontokhoz kapcsolódó táblázatokban végrehajtott módosítások nyomon követésének kikapcsolása. Ezzel kissé felgyorsítható a szerver működése és hely takarítható meg az adatbázisban.';
$string['displaylettergrade'] = 'Pontozó betűk megjelenítése';
$string['displaypercent'] = 'Kijelzés százalékkal';
$string['displaypoints'] = 'Kijelzés pontokkal';
$string['displayweighted'] = 'Kijelzés súlyozott pontokkal';
$string['dropdown'] = 'Lenyíló menü';
$string['droplow'] = 'A legalacsonyabb kihagyása';
$string['droplow_help'] = 'Beállítása esetén kihagyja a legalacsonyabb X pontot, ahol is az X az adott opcióhoz kiválasztott értéket jelenti.';
$string['dropped'] = 'Kihagyva';
$string['dropxlowest'] = 'Legalacsonyabb X kihagyása';
$string['dropxlowestwarning'] = 'Megjegyzés: a legalacsonyabb X kihagyása esetén a pontozás abból indul ki, hogy minden kategóriában a tételek azonos pontértékkel rendelkeznek. Ha eltérnek, az eredmény megjósolhatatlanná válik.';
$string['duplicatescale'] = 'Ismétlődő skála';
$string['edit'] = 'Szerkesztés';
$string['editcalculation'] = 'Kalkuláció szerkesztése';
$string['editcalculationverbose'] = '{$a->category} {$a->itemmodule}{$a->itemname} számítás szerkesztése';
$string['editfeedback'] = 'Visszajelzés szerkesztése';
$string['editgrade'] = 'Pont szerkesztése';
$string['editgradeletters'] = 'Pontozó betűk szerkesztése';
$string['editoutcome'] = 'Eredmény szerkesztése';
$string['editoutcomes'] = 'Eredmények szerkesztése';
$string['editscale'] = 'Kategóriák és elemek';
$string['edittree'] = 'Kategóriák és tételek';
$string['editverbose'] = 'A(z) {$a->category} {$a->itemmodule} {$a->itemname} szerkesztése';
$string['enableajax'] = 'Az AJAX bekapcsolása';
$string['enableajax_help'] = 'A pontozói jelentést AJAX-funkciókkal egészíti ki, így az általános műveletek egyszerűbben és gyorsabban hajthatók végre. Attól függ, hogy a javascript a felhasználó böngészőjében be van-e kapcsolva.';
$string['enableoutcomes'] = 'Eredmények bekapcsolása';
$string['enableoutcomes_help'] = 'Az eredmények (más néven kompetenciák, célok, szabványok vagy kritériumok) támogatása azt jelenti, hogy az ismeretek egy vagy több eredménymegállapításhoz kötött skálához kapcsolhatók. Az eredmények bekapcsolása esetén az ilyen speciális pontozás elérhetővé válik az egész portálon.';
$string['encoding'] = 'Kódolás';
$string['errorcalculationnoequal'] = 'A képletnek egyenlőségjellel kell kezdődnie (=1+2)';
$string['errorcalculationunknown'] = 'Hibás képlet';
$string['errorgradevaluenonnumeric'] = 'Nem számjegyes alacsony vagy magas pont érkezett erre';
$string['errornocalculationallowed'] = 'Ezen tétel esetén számítás nem alkalmazható';
$string['errornocategorisedid'] = 'Nincs kategorizálatlan azonosító!';
$string['errornocourse'] = 'Nincs kurzusinformáció';
$string['errorreprintheadersnonnumeric'] = 'Újranyomtatási fejléchez nem számjegyes érték érkezett';
$string['errorsavegrade'] = 'A pontot nem lehetett elmenteni.';
$string['errorupdatinggradecategoryaggregateonlygraded'] = 'Hiba a(z) {$a->id} pontozási kategóriaazonosító "Csak a nem üres pontok összegzése" beállításának frissítése közben';
$string['errorupdatinggradecategoryaggregateoutcomes'] = 'Hiba a(z) {$a->id} pontozási kategóriaazonosító "Eredmények beillesztése az összegzésbe" beállításának frissítése közben';
$string['errorupdatinggradecategoryaggregatesubcats'] = 'Hiba a(z) {$a->id} pontozási kategóriaazonosító "Alkategóriák összegzése" beállításának frissítése közben';
$string['errorupdatinggradecategoryaggregation'] = 'Hiba a(z) {$a->id} pontozási kategóriaazonosító összegzési típusának frissítése közben';
$string['errorupdatinggradeitemaggregationcoef'] = 'Hiba a(z) {$a->id} pontozási kategóriaazonosító összegzési együtthatójának (súly vagy külön kreditpont) frissítése közben';
$string['excluded'] = 'Kizárva';
$string['excluded_help'] = 'Ha a -kimarad- be van kapcsolva, a pont kimarad minden összegzésből, amelyet bármely felette lévő pontozási tétel vagy kategória végrehajt.';
$string['expand'] = 'Kategória kiterjesztése';
$string['export'] = 'Exportálás';
$string['exportalloutcomes'] = 'Minden eredmény exportálása';
$string['exportfeedback'] = 'Visszajelzés beillesztése az exportálásba';
$string['exportplugins'] = 'Segédprogramok exportálása';
$string['exportsettings'] = 'Beállítások exportálása';
$string['exportto'] = 'Exportálás helye';
$string['extracreditwarning'] = 'Megjegyzés: ha egy kategória minden tétele külön kreditponttal szerepel, akkor kimaradnak a pontszámításból, mert nem születik összegzett pontszám';
$string['feedback'] = 'Visszajelzés';
$string['feedback_help'] = 'A tanár által a pontokhoz fűzött megjegyzések. Lehet részletes, személyre szóló visszajelzés vagy egy egyszerű kód, amely a visszajelzés belső rendszerére utal.';
$string['feedbackadd'] = 'Visszajelzés hozzáadása';
$string['feedbackedit'] = 'Visszajelzés szerkesztése';
$string['feedbacksaved'] = 'Visszajelzés elmentve';
$string['feedbackview'] = 'Visszajelzés megtekintése';
$string['finalgrade'] = 'Végső pontszám';
$string['finalgrade_help'] = 'Az a (gyorsítótárban előálló) végső pont, amely az összes számítás elvégzése után jön létre.';
$string['fixedstudents'] = 'Statikus tanulói oszlop';
$string['fixedstudents_help'] = 'A pontok vízszintesen görgethetők, a statikus tanulói oszlop folyamatosan látható marad.';
$string['forceoff'] = 'Előírás: Ki';
$string['forceon'] = 'Előírás: Be';
$string['forelementtypes'] = 'a kiválasztott {$a} részére';
$string['forstudents'] = 'Tanulóknak';
$string['full'] = 'Teljes';
$string['fullmode'] = 'Teljes nézet';
$string['fullview'] = 'Teljes nézet';
$string['generalsettings'] = 'Általános beállítások';
$string['grade'] = 'Pont';
$string['gradeadministration'] = 'Osztályozás kezelése';
$string['gradeanalysis'] = 'Pontszámok elemzése';
$string['gradebook'] = 'Osztályozónapló';
$string['gradebookhiddenerror'] = 'Az osztályozónapló a mostani beállításban mindent elrejt a tanulók elől.';
$string['gradebookhistories'] = 'Pont előzményei';
$string['gradeboundary'] = 'Betűpontozás határértéke';
$string['gradeboundary_help'] = 'Százalékos határ, mely fölött a pontok pontozási betűt kapnak (ha a pontozási betű megjelenítése be van kapcsolva).';
$string['gradecategories'] = 'Pontozási kategóriák';
$string['gradecategory'] = 'Pontozási kategória';
$string['gradecategoryonmodform'] = 'Pontozási kategória';
$string['gradecategoryonmodform_help'] = 'Ez a beállítás szabályozza azt a kategóriát, amelyikbe ezen tevékenység pontjai az osztályozónaplóba bekerülnek.';
$string['gradecategorysettings'] = 'Pontozási kategória beállításai';
$string['gradedisplay'] = 'Pont megjelenítése';
$string['gradedisplaytype'] = 'Pont megjelenítésének típusa';
$string['gradedisplaytype_help'] = 'Megadja, miként jelenjenek meg az osztályzatok az osztályozónaplóban és a felhasználói jelentésben. A osztályzatok megjelenhetnek
* Valós - tényleges osztályzatok,
* Százalékok,
* Betű formájában. - A betűk vagy szavak osztályzatok tartományát jelölik.';
$string['gradedon'] = 'Pontozott {$a}';
$string['gradeexport'] = 'Pontexportálás';
$string['gradeexportdecimalpoints'] = 'Pontexportálás tizedesjegyei';
$string['gradeexportdecimalpoints_desc'] = 'Az exportáláshoz megjelenítendő tizedesjegyek száma. Exportálás közben ez felülírható.';
$string['gradeexportdisplaytype'] = 'Pontexportálás megjelenítésének típusa';
$string['gradeexportdisplaytype_desc'] = 'A pontok exportálása során megjelenhetnek valós pontszámok, (a minimális és maximális pontszámhoz viszonyított) százalékok vagy betűk (A, B, C stb.) formájában. Exportálás közben ez felülírható.';
$string['gradeforstudent'] = '{$a->student}<br />{$a->item}{$a->feedback}';
$string['gradehelp'] = 'Súgó a pontozáshoz';
$string['gradehistorylifetime'] = 'Pont előzményeinek őrzési ideje';
$string['gradehistorylifetime_help'] = 'Megadja, mennyi ideig kívánja a változásokat megőrizni a pontokhoz kapcsolódó táblázatokban. Ajánlott minél hosszabb ideig megőrizni. Ha teljesítmény vagy tárhely terén problémába ütközik, próbálkozzék egy alacsonyabb értékkel.';
$string['gradeimport'] = 'Pontimportálás';
$string['gradeitem'] = 'Pontozási tétel';
$string['gradeitemaddusers'] = 'Pontozásból kizárni';
$string['gradeitemadvanced'] = 'További pontozási lehetőségek';
$string['gradeitemadvanced_help'] = 'Pontozási tételek szerkesztése során válassza ki az összes továbbiként megjelenítendő elemet.';
$string['gradeitemislocked'] = 'Ez a tevékenység az osztályozónaplóban zárolva van. Feloldásáig az osztályzatok módosítása nem kerül bele az osztályozónaplóba.';
$string['gradeitemlocked'] = 'Pontozás zárolva';
$string['gradeitemmembersselected'] = 'Pontozásból kizárva';
$string['gradeitemnonmembers'] = 'Pontozásban szerepeltetve';
$string['gradeitemremovemembers'] = 'Pontozásban szerepeltetni';
$string['gradeitems'] = 'Pontozási tételek';
$string['gradeitemsettings'] = 'Pontozási tétel beállításai';
$string['gradeitemsinc'] = 'Szerepeltetendő pontozási tételek';
$string['gradeletter'] = 'Pontozó betű';
$string['gradeletter_help'] = 'Olyan betű vagy szimbólum, amely egy ponttartományt reprezentál.';
$string['gradeletternote'] = 'Betűvel megadott pont törléséhez a betűhöz tartozó három szövegterület valamelyikét törölje, és kattintson a Beküldés gombra.';
$string['gradeletters'] = 'Pontozó betűk';
$string['gradelocked'] = 'Pont zárolva';
$string['gradelong'] = '{$a->grade} / {$a->max}';
$string['grademax'] = 'Maximális pont';
$string['grademax_help'] = 'Érték szerinti ponttípus használata esetén beállítható egy maximális pont. Tevékenység-alapú pontozási tétel legmagasabb pontját a tevékenységet frissítő oldalon lehet beállítani.';
$string['grademin'] = 'Minimális pont';
$string['grademin_help'] = 'Érték szerinti ponttípus használata esetén beállítható egy minimális pont.';
$string['gradeoutcomeitem'] = 'Pontozási eredménytétel';
$string['gradeoutcomes'] = 'Eredmények';
$string['gradeoutcomescourses'] = 'Kurzus eredményei';
$string['gradepass'] = 'Pont a teljesítéshez';
$string['gradepass_help'] = 'Ha egy tételhez olyan pont kapcsolódik, amelyet a felhasználóknak el kell érni vagy meg kell haladni a tétel teljesítéséhez, akkor azt itt állíthatja be.';
$string['gradepreferences'] = 'Pontozási beállítások';
$string['gradepreferenceshelp'] = 'Súgó a pontozási beállításokhoz';
$string['gradepublishing'] = 'Közzététel bekapcsolása';
$string['gradepublishing_help'] = 'Exportáláshoz és importáláshoz kapcsolja be a közzétételt: az exportált pontok egy URL-ről érhetők el anélkül, hogy a Moodle-portálra be kellene jelentkezni. A pontok ezen URL-ről importálhatók (tehát egy Moodle-portál importálni tud egy másik portálon közzétett pontokat). Alapesetben csak a rendszergazdák használhatják. Az egyéb szerepekhez szükséges készségek hozzáadása előtt a felhasználókat fel kell világosítani (könyvjelzőmegosztás és letöltésgyorsítók veszélyei, IP-korlátozások stb.).';
$string['gradereport'] = 'Pontozási jelentés';
$string['graderreport'] = 'Pontozói jelentés';
$string['grades'] = 'Pontok';
$string['gradesforuser'] = '{$a->user} pontjai';
$string['gradesonly'] = 'Csak pontok';
$string['gradessettings'] = 'Pontbeállítások';
$string['gradetype'] = 'Pont típusa';
$string['gradetype_help'] = 'Megadja a használandó pont típusát: nincs (nem lehet pontozni), érték (bekapcsolja a maximális és minimális pont beállítását), skála (bekapcsolja a skála beállítását) vagy szöveg (csak visszajelzés). Csak értéken és skálán alapuló pontokat lehet összegezni. Tevékenység-alapú pontozási tétel ponttípusa a tevékenységet frissítő oldalon állítható be.';
$string['gradeview'] = 'Pont megtekintése';
$string['gradeweighthelp'] = 'Súgó a pontozás súlyozásához';
$string['groupavg'] = 'Csoportátlag';
$string['hidden'] = 'Rejtve';
$string['hidden_help'] = 'Bejelölése esetén a tanulók a pontokat nem látják. Szükség esetén beállítható egy elrejtési időtartam, így a pontok a pontozás befejezése után jelenhetnek meg.';
$string['hiddenasdate'] = 'Rejtett pontoknál leadás dátumának megjelenítése';
$string['hiddenasdate_help'] = 'Ha a felhasználó nem láthatja a rejtett pontokat, a \'-\' helyett jelenjen meg a leadás dátuma.';
$string['hiddenuntil'] = 'Rejtve eddig';
$string['hiddenuntildate'] = 'Rejtve eddig: {$a}';
$string['hideadvanced'] = 'Részletes funkciók elrejtése';
$string['hideaverages'] = 'Átlagok elrejtése';
$string['hidecalculations'] = 'Számítások elrejtése';
$string['hidecategory'] = 'Rejtett';
$string['hideeyecons'] = 'Elrejtés/Felfedés ikonok elrejtése';
$string['hidefeedback'] = 'Visszajelzés elrejtése';
$string['hideforcedsettings'] = 'Előírt beállítások elrejtése';
$string['hideforcedsettings_help'] = 'Előírt beállítások elrejtése a pontozási felületen.';
$string['hidegroups'] = 'Csoportok elrejtése';
$string['hidelocks'] = 'Zárolások elrejtése';
$string['hidenooutcomes'] = 'Eredmények megjelenítése';
$string['hidequickfeedback'] = 'Gyors visszajelzés elrejtése';
$string['hideranges'] = 'Tartományok elrejtése';
$string['hidetotalifhiddenitems'] = 'Összesítések elrejtése, ha azok rejtett tételeket tartalmaznak.';
$string['hidetotalifhiddenitems_help'] = 'Itt adható meg, hogy a rejtett tételeket tartalmazó összesítéseket látják-e a tanulók, vagy kötőjel (-) jelenjen meg helyükön. Megjelenítés esetén az összesítésben választhatóan szerepelhetnek a rejtett tételek. Az összesítést a pontozási jelentésben a tanár másként fogja látni, mivel ő mindig az összes tétellel számított összesítést látja. Ha a rejtett tételek is szerepelnek, akkor a tanulók kiszámíthatják a rejtett tételeket.';
$string['hidetotalshowexhiddenitems'] = 'Összesítés megjelenítése rejtett tételek nélkül';
$string['hidetotalshowinchiddenitems'] = 'Összesítés megjelenítése rejtett tételekkel együtt';
$string['hideverbose'] = '{$a->category} {$a->itemmodule} {$a->itemname} elrejtése';
$string['highgradeascending'] = 'Növekvő rendezés';
$string['highgradedescending'] = 'Csökkenő rendezés';
$string['highgradeletter'] = 'Magas';
$string['identifier'] = 'Felhasználó azonosítási szempontja';
$string['idnumbers'] = 'Azonosítószámok';
$string['import'] = 'Importálás';
$string['importcsv'] = 'CSV importálása';
$string['importcustom'] = 'Importálás egyéni eredményként (csak ezen kurzus esetén)';
$string['importerror'] = 'Hiba, a kód meghívása nem a megfelelő paraméterekkel  történt.';
$string['importfailed'] = 'Sikertelen importálás';
$string['importfeedback'] = 'Importálási visszajelzés';
$string['importfile'] = 'Állomány importálása';
$string['importfilemissing'] = 'Állomány importálására nem kerül sor, térjen vissza az űrlaphoz és töltsön föl egy érvényes állományt.';
$string['importfrom'] = 'Importálás helye';
$string['importoutcomenofile'] = 'A feltöltött állomány üres vagy hibás. Ellenőrizze, érvényes-e az állomány. A probléma a(z) {$a} soron jelentkezett; az az oka, hogy az adatsorok nem rendelkeznek annyi oszloppal, amennyivel az első sor (a fejléc), vagy az importált állományhoz nincsenek meg a szükséges fejlécek. Az exportált állomány alapján ellenőrizheti, hogy néz ki egy érvényes fejléccel rendelkező állomány.';
$string['importoutcomes'] = 'Eredmények importálása';
$string['importoutcomes_help'] = 'Eredmények importálhatók az exportált eredményekkel azonos formájú csv-állományokból.';
$string['importoutcomesuccess'] = 'Importálási eredmény #{$a->id} azonosítójú "{$a->name}" esetén';
$string['importplugins'] = 'Segédprogramok importálása';
$string['importpreview'] = 'Nyomtatási kép importálása';
$string['importsettings'] = 'Beállítások importálása';
$string['importskippednomanagescale'] = 'Nem jogosult új skála felvételére, ezért a(z) "{$a}" eredmény kimaradt, mivel ahhoz új skálát kellett volna fölvenni';
$string['importskippedoutcome'] = 'Ebben a környezetben már létezik "{$a}" rövid nevű eredmény, az importált állományban lévő ezért kimaradt.';
$string['importstandard'] = 'Importálás standard eredményekként';
$string['importsuccess'] = 'A pont importálása sikerült';
$string['importxml'] = 'XML importálása';
$string['includescalesinaggregation'] = 'Skálák szerepeltetése az összegzésben';
$string['includescalesinaggregation_help'] = 'Módosíthatja azt, hogy a skálák számokként bekerüljenek-e minden kurzus minden osztályozónaplójának minden összegzett osztályzatába. VIGYÁZAT: ezen beállítás módosítása esetén minden összegzett osztályzatot újraszámol a rendszer.';
$string['incorrectcourseid'] = 'Hibás volt a kurzusazonosító';
$string['incorrectcustomscale'] = '(Hibás egyéni tartomány, módosítsa.)';
$string['incorrectminmax'] = 'A minimumnak a maximumnál kisebbnek kell lennie';
$string['inherit'] = 'Örököl';
$string['intersectioninfo'] = 'Információ a tanuló/pontszám tekintetében';
$string['item'] = 'Tétel';
$string['iteminfo'] = 'Tétel adatai';
$string['iteminfo_help'] = 'A tétellel kapcsolatos adatok rögzítésére szolgáló hely. A megadott szöveg sehol máshol nem jelenik meg.';
$string['itemname'] = 'Tétel neve';
$string['itemnamehelp'] = 'A tétel modulból származó neve.';
$string['items'] = 'Tételek';
$string['itemsedit'] = 'Pontozási tétel szerkesztése';
$string['keephigh'] = 'A legmagasabb megtartása';
$string['keephigh_help'] = 'Bekapcsolása esetén csak a legmagasabb X pontot tartja meg, ahol az X a kiválasztott érték.';
$string['keymanager'] = 'Kulcs kezelője';
$string['lessthanmin'] = 'A(z) {$a->itemname} {$a->username} esetén megadott pont nagyobb a maximálisan megengedettnél';
$string['letter'] = 'Betű';
$string['lettergrade'] = 'Betűpontozás';
$string['lettergradenonnumber'] = 'Az alacsony és/vagy magas pont nem számjegyes volt';
$string['letterpercentage'] = 'Betű (százalék)';
$string['letterreal'] = 'Betű (valós)';
$string['letters'] = 'Betűk';
$string['linkedactivity'] = 'Kapcsolt tevékenység';
$string['linkedactivity_help'] = 'Meghatároz egy opcionális tevékenységet, amelyhez ez az eredménytétel kapcsolódik. Ezzel mérhető a tanulói teljesítmény olyan kritériumok alapján, amelyeket a tevékenységhez tartozó pont nem értékel.';
$string['linktoactivity'] = 'Kapcsolás a(z) {$a->name} tevékenységhez';
$string['lock'] = 'Zárolás';
$string['locked'] = 'Zárolt';
$string['locked_help'] = 'Bejelölése esetén a pontokat a kapcsolódó tevékenység a továbbiakban nem fogja tudni automatikusan frissíteni.';
$string['locktime'] = 'Ezután zárolandó';
$string['locktimedate'] = 'Ezután zárolandó: {$a}';
$string['lockverbose'] = '{$a->category} {$a->itemmodule} {$a->itemname} zárolása';
$string['lowest'] = 'Legalacsonyabb';
$string['lowgradeletter'] = 'Alacsony';
$string['manualitem'] = 'Kézi tétel';
$string['mapfrom'] = 'Illesztés innen';
$string['mappings'] = 'Pontozási tétel illesztései';
$string['mapto'] = 'Illesztés ehhez';
$string['max'] = 'Legmagasabb';
$string['maxgrade'] = 'Max. pont';
$string['meanall'] = 'Az összes pont';
$string['meangraded'] = 'Nem üres pontok';
$string['meanselection'] = 'Oszlopátlagokhoz kiválasztott pontok';
$string['meanselection_help'] = 'Válassza ki az oszlopátlagokban megjelenő pontok típusát. A pont nélküli cellák kimaradhatnak vagy 0-nak számíthatnak (alapbeállítás).';
$string['median'] = 'Középérték';
$string['min'] = 'Legalacsonyabb';
$string['missingscale'] = 'Skálát kell kiválasztani';
$string['mode'] = 'Leggyakoribb';
$string['morethanmax'] = 'A(z) {$a->itemname} esetén {$a->username} részére beírt pont nagyobb, mint a megengedett legmagasabb';
$string['moveselectedto'] = 'A kiválasztott elemek áthelyezése ide:';
$string['movingelement'] = '{$a} áthelyezése';
$string['multfactor'] = 'Szorzó';
$string['multfactor_help'] = 'Az a tényező, amellyel a pontozási tétel összes pontját meg kell szorozni.';
$string['mypreferences'] = 'Beállításaim';
$string['myreportpreferences'] = 'Jelentéseim beállításai';
$string['navmethod'] = 'Böngészési mód';
$string['neverdeletehistory'] = 'Soha ne törölje az előzményt';
$string['newcategory'] = 'Új kategória';
$string['newitem'] = 'Új pontozási elem';
$string['newoutcomeitem'] = 'Új eredményelem';
$string['no'] = 'Nem';
$string['nocategories'] = 'A kurzushoz nincs, vagy nem lehetett hozzáadni pontkategóriát';
$string['nocategoryname'] = 'Nincs megadva kategórianév.';
$string['nocategoryview'] = 'Nincs megtekinthető kategória';
$string['nocourses'] = 'Még nincsenek kurzusok';
$string['noforce'] = 'Ne írja elő';
$string['nogradeletters'] = 'Nincs beállítva pontozó betű';
$string['nogradesreturned'] = 'Nincs kapott pont';
$string['noidnumber'] = 'Nincs azonosítószám';
$string['nolettergrade'] = 'Nincs pontozó betű ehhez';
$string['nomode'] = 'Nem érvényes';
$string['nonnumericweight'] = 'Nem számjegyes érték érkezett ehhez';
$string['nonunlockableverbose'] = 'A pont nem oldható fel, amíg a(z) {$a->itemname} fel van oldva.';
$string['nonweightedpct'] = 'súlyozatlan %';
$string['nooutcome'] = 'Nincs eredmény';
$string['nooutcomes'] = 'Az eredménytételeket kurzuseredményhez kell kötni, de a kurzusban nincsenek eredmények. Hozzáad egyet?';
$string['nopublish'] = 'Ne tegye közzé';
$string['norolesdefined'] = 'Nincs szerep megadva a Rendszergazda > Pontok > Általános beállítások > Pontozott szerepek esetén';
$string['noscales'] = 'Az eredményeket kurzusskálához vagy globális skálához kell kötni, de a kurzusban nincsenek ilyenek. Hozzáad egyet?';
$string['noselectedcategories'] = 'nem voltak kiválasztva kategóriák.';
$string['noselecteditems'] = 'nem voltak kiválasztva tételek.';
$string['notteachererror'] = 'Ennek a használatához tanárnak kell lennie.';
$string['nousersloaded'] = 'Nincs betöltve felhasználó';
$string['numberofgrades'] = 'Pontok száma';
$string['onascaleof'] = '{$a->grademin} és {$a->grademax} közötti skálán';
$string['operations'] = 'Műveletek';
$string['options'] = 'Lehetőségek';
$string['outcome'] = 'Eredmény';
$string['outcome_help'] = 'Ezen pontozási tétel eredménye.';
$string['outcomeassigntocourse'] = 'Másik eredmény hozzárendelése a kurzushoz';
$string['outcomecategory'] = 'Kategória eredményeinek létrehozása';
$string['outcomecategorynew'] = 'Új kategória';
$string['outcomeconfirmdelete'] = 'Biztosan törli a(z) "{$a}" eredményt?';
$string['outcomecreate'] = 'Új eredmény hozzáadása';
$string['outcomedelete'] = 'Eredmény törlése';
$string['outcomefullname'] = 'Teljes név';
$string['outcomeitem'] = 'Eredménytétel';
$string['outcomeitemsedit'] = 'Eredménytétel szerkesztése';
$string['outcomereport'] = 'Eredményről szóló jelentés';
$string['outcomes'] = 'Eredmények';
$string['outcomescourse'] = 'Kurzusban használt eredmények';
$string['outcomescoursecustom'] = 'Testre szabott (nem mozgatható)';
$string['outcomescoursenotused'] = 'Standard nincs használatban';
$string['outcomescourseused'] = 'Standard használatos (nem mozgatható)';
$string['outcomescustom'] = 'Testre szabott eredmények';
$string['outcomeshortname'] = 'Rövid név';
$string['outcomesstandard'] = 'Standard eredmények';
$string['outcomesstandardavailable'] = 'Elérhető standard eredmények';
$string['outcomestandard'] = 'Standard eredmény';
$string['outcomestandard_help'] = 'A standard eredmény az egész portálon minden kurzus számára elérhető.';
$string['overallaverage'] = 'Globális átlag';
$string['overridden'] = 'Felülírva';
$string['overridden_help'] = 'Bekapcsolása esetén a felülírt címkével megakadályozható minden későbbi próbálkozás a pontérték automatikus módosítására. A címkét gyakran az osztályozónapló belülről állítja, de ezen űrlapelem segítségével kézi úton ki-be kapcsolható.';
$string['overriddennotice'] = 'A tevékenységgel kapcsolatos végső pontja kézzel módosítva lett.';
$string['overridesitedefaultgradedisplaytype'] = 'Portál alapbeállításainak felülírása';
$string['overridesitedefaultgradedisplaytype_help'] = 'Ezen jelölőnégyzet bejelölésével kapcsolhatja be a portálon az osztályozónaplóban megjelenő pontok kijelzésének alapbeállításait. Ezzel űrlapelemeket kapcsol be, melyekkel tetszése szerint határozhat meg pontozó betűket és ponthatárokat.';
$string['parentcategory'] = 'Szülőkategória';
$string['pctoftotalgrade'] = '%-a az összpontszámnak';
$string['percent'] = 'Százalék';
$string['percentage'] = 'Százalék';
$string['percentageletter'] = 'Százalék (betű)';
$string['percentagereal'] = 'Százalék (valós)';
$string['percentascending'] = 'Rendezés növekvő százalék szerint';
$string['percentdescending'] = 'Rendezés csökkenő százalék szerint';
$string['percentshort'] = '%';
$string['plusfactor'] = 'Eltolás';
$string['plusfactor_help'] = 'Az a szám, amely a szorzó alkalmazása után a jelen pontozási tétel minden pontjához hozzáadódik.';
$string['points'] = 'pont';
$string['pointsascending'] = 'Rendezés növekvő pontok szerint';
$string['pointsdescending'] = 'Rendezés csökkenő pontok szerint';
$string['positionfirst'] = 'Első';
$string['positionlast'] = 'Utolsó';
$string['preferences'] = 'Beállítások';
$string['prefgeneral'] = 'Általános';
$string['prefletters'] = 'Pontozó betűk és határértékek';
$string['prefrows'] = 'Speciális sorok';
$string['prefshow'] = 'Mutatás/elrejtés váltogatása';
$string['previewrows'] = 'Sorok nyomtatási képe';
$string['profilereport'] = 'Felhasználói profilról szóló jelentés';
$string['profilereport_help'] = 'A felhasználó profiloldalán használatos pontozói jelentés.';
$string['publishing'] = 'Közzététel';
$string['quickfeedback'] = 'Gyors visszajelzés';
$string['quickgrading'] = 'Gyors pontozás';
$string['quickgrading_help'] = 'Gyors pontozás során az osztályozó jelentés minden pontcellájába bekerül egy szövegmező, ahol egyszerre szerkeszthet több pontot is. Ezután a Frissítés gombra kattintva egyszerre hajthatja végre az összes módosítást, így nem kell egyenként sort keríteni erre.';
$string['range'] = 'Tartomány';
$string['rangedecimals'] = 'Tartomány tizedesjegyei';
$string['rangedecimals_help'] = 'Tartományhoz kijelzendő tizedesjegyek száma';
$string['rangesdecimalpoints'] = 'Tartományon belül látható tizedesjegyek';
$string['rangesdecimalpoints_help'] = 'Megadja az egyes tartományokhoz a megjelenítendő tizedesjegyek számát. A beállítás pontozási tételenként felülírható.';
$string['rangesdisplaytype'] = 'Tartomány megjelenítésének típusa';
$string['rangesdisplaytype_help'] = 'Megadja az egyes tartományok megjelenítésének módját. Az Öröklés kiválasztása esetén az egyes oszlopok megjelenítési típusa lesz használatos.';
$string['rank'] = 'Sorrend';
$string['rawpct'] = 'Nyers %';
$string['real'] = 'Valós';
$string['realletter'] = 'Valós (betű)';
$string['realpercentage'] = 'Valós (százalék)';
$string['regradeanyway'] = 'Újrapontozás mindenképpen';
$string['removeallcoursegrades'] = 'Összes pont törlése';
$string['removeallcourseitems'] = 'Összes elem és kategória törlése';
$string['report'] = 'Jelentés';
$string['reportdefault'] = 'Jelentés alapbeállítása ({$a})';
$string['reportplugins'] = 'Jelentés segédprogramjai';
$string['reportsettings'] = 'Jelentés beállításai';
$string['reprintheaders'] = 'Fejlécek újranyomtatása';
$string['respectingcurrentdata'] = 'a jelenlegi beállítás változatlanul hagyása';
$string['rowpreviewnum'] = 'Sorok előnézete';
$string['savechanges'] = 'Módosítások mentése';
$string['savepreferences'] = 'Beállítások mentése';
$string['scaleconfirmdelete'] = 'Biztosan törli "{$a}" skáláját?';
$string['scaledpct'] = 'Léptékes %';
$string['seeallcoursegrades'] = 'Lásd az összes kurzuspontot';
$string['selectalloroneuser'] = 'Az összes vagy egy felhasználó kiválasztása';
$string['selectauser'] = 'Válasszon ki egy felhasználót';
$string['selectdestination'] = '{$a} célállomásának kiválasztása';
$string['separator'] = 'Elválasztó';
$string['sepcomma'] = 'Vessző';
$string['septab'] = 'Tabulátor';
$string['setcategories'] = 'Kategóriák beállítása';
$string['setcategorieserror'] = 'Súlyok hozzáadása előtt kategóriákat kell a kurzusához beállítania.';
$string['setgradeletters'] = 'Pontozó betűk beállítása';
$string['setpreferences'] = 'Preferenciák beállítása';
$string['setting'] = 'Beállítás';
$string['settings'] = 'Beállítások';
$string['setweights'] = 'Súlyok beállítása';
$string['showactivityicons'] = 'Tevékenységikonok megjelenítése';
$string['showactivityicons_help'] = 'Megjelenjenek-e a tevékenységikonok a tevékenységek neve mellett?';
$string['showallhidden'] = 'Az összes rejtett megjelenítése';
$string['showallstudents'] = 'Minden tanuló megjelenítése';
$string['showanalysisicon'] = 'A Pontszámok elemzése ikon megjelenítése';
$string['showanalysisicon_desc'] = 'A Pontszámok elemzése ikon megjelenítésének bekapcsolása. Ha a tevékenységmodul támogatja, a Pontszámok elemzése ikon a pontszámok és elérésük részletesebb kifejtését tartalmazó oldalra viszi a felhasználót.';
$string['showanalysisicon_help'] = 'Ha a tevékenységmodul támogatja, a Pontszámok elemzése ikon a pontszámok és elérésük részletesebb kifejtését tartalmazó oldalra viszi a felhasználót.';
$string['showaverage'] = 'Átlag kijelzése';
$string['showaverage_help'] = 'Megjelenjen-e az átlagok oszlopa? Ha az átlag kiszámítása csak néhány pont alapján történik, a tanulók megbecsülhetik a többiek pontszámát. A teljesítmény érdekében az átlag közelítőleges, ha rejtett elemeken alapszik.';
$string['showaverages'] = 'Oszlopátlagok megjelenítése';
$string['showaverages_help'] = 'Oszlopátlagok megjelenítése a pontozói jelentésben.';
$string['showcalculations'] = 'Számítások megjelenítése';
$string['showcalculations_help'] = 'Megjelenjen-e egy kalkulátorikon az egyes pontozási tételek és kategóriák mellett, elemleírásokkal a kiszámított tételek fölött és egy látható kijelzéssel, mely mutatja, hogy az oszlop kiszámítása folyamatban van.';
$string['showeyecons'] = 'Megjelenítő/elrejtő ikonok kijelzése';
$string['showeyecons_help'] = 'Az egyes pontok mellett megjelenjen-e egy Mutat/Elrejt ikon (a felhasználói láthatóság beállításához).';
$string['showfeedback'] = 'Visszajelzés megjelenítése';
$string['showfeedback_help'] = 'Megjelenjen-e a visszajelzések oszlopa?';
$string['showgrade'] = 'Pontok kijelzése';
$string['showgrade_help'] = 'Megjelenjen-e a pontok oszlopa?';
$string['showgroups'] = 'Csoportok megjelenítése';
$string['showhiddenitems'] = 'Rejtett tételek megjelenítése';
$string['showhiddenitems_help'] = 'Teljesen rejtve legyenek-e a rejtett pontozási tételek, vagy nevük megjelenjen-e a tanulók számára.
* Rejtettek megjelenítése - A rejtett pontozási tételek neve látható, de a tanulói pontok nem
* Rejtve csak eddig - A pontozási tételek a "rejtve eddig" alatt beállított időpontig nem láthatók, utána a teljes tétel látszik
* Nem látszik - A rejtett pontozási tételek egyáltalán nem láthatók';
$string['showhiddenuntilonly'] = 'Rejtve csak eddig';
$string['showlettergrade'] = 'Osztályzat kijelzése betűkkel';
$string['showlettergrade_help'] = 'Megjelenjen-e a betűvel kifejezett osztályzatok oszlopa?';
$string['showlocks'] = 'Zárak megjelenítése';
$string['showlocks_help'] = 'Legyen-e Lezár/Felold ikon az egyes pontok mellett?';
$string['shownohidden'] = 'Nem látszik';
$string['shownooutcomes'] = 'Eredmények elrejtése';
$string['shownumberofgrades'] = 'Pontok számának feltüntetése az átlagokban';
$string['shownumberofgrades_help'] = 'Az egyes összegzett pontok kijelzése az egyes átlagok mellett zárójelben. Például: 45 (34).';
$string['showpercentage'] = 'Százalék megjelenítése';
$string['showpercentage_help'] = 'Megjelenjen-e az egyes pontozási tételek százalékos értéke?';
$string['showquickfeedback'] = 'Gyors visszajelzés megjelenítése';
$string['showquickfeedback_help'] = 'A gyors visszajelzés a pontozói jelentés minden cellájába beszúr egy szövegbeviteli mezőt, így egyszerre sok pont visszajelzését tudja szerkeszteni. Ezután a Frissítés gombra kattintva az összes módosítást egyszerre végezheti el ahelyett, hogy egyesével hajtaná őket végre.';
$string['showrange'] = 'Tartományok kijelzése';
$string['showrange_help'] = 'Megjelenjen-e tartományok oszlopa?';
$string['showranges'] = 'Tartományok megjelenítése';
$string['showranges_help'] = 'A pontozói jelentésben megjelenít egy sort az egyes pontozási tételek lehetséges tartományával.';
$string['showrank'] = 'Besorolás mutatása';
$string['showrank_help'] = 'Megjelenjen-e a tanuló helyzete az osztályhoz viszonyítva az egyes pontozási tételek esetén?';
$string['showuserimage'] = 'Felhasználói profilképek megjelenítése';
$string['showuserimage_help'] = 'A pontozói jelentésben megjelenjen-e a felhasználó neve mellett a profilképe?';
$string['showverbose'] = '{$a->category} {$a->itemmodule} {$a->itemname} megjelenítése';
$string['showweight'] = 'Súlyozások kijelzése';
$string['showweight_help'] = 'Megjelenjen-e a pontozási súlyok oszlopa?';
$string['simpleview'] = 'Egyszerű nézet';
$string['sitewide'] = 'Egész portálra kiterjedő';
$string['sort'] = 'rendez';
$string['sortasc'] = 'Rendezés növekvő sorrendben';
$string['sortbyfirstname'] = 'Keresztnév szerinti rendezés';
$string['sortbylastname'] = 'Vezetéknév szerinti rendezés';
$string['sortdesc'] = 'Rendezés csökkenő sorrendben';
$string['standarddeviation'] = 'Szórás';
$string['stats'] = 'Statisztika';
$string['statslink'] = 'Statisztikák';
$string['student'] = 'Tanuló';
$string['studentsperpage'] = 'Tanuló oldalanként';
$string['studentsperpage_help'] = 'A pontozói jelentésben oldalanként megjelenítendő tanulók száma.';
$string['subcategory'] = 'Szokásos kategória';
$string['submissions'] = 'Leadott munkák';
$string['submittedon'] = 'Leadva:';
$string['switchtofullview'] = 'Váltás teljes nézetre';
$string['switchtosimpleview'] = 'Váltás egyszerű nézetre';
$string['tabs'] = 'Tabulátorok';
$string['topcategory'] = 'Felettes kategória';
$string['total'] = 'Összesen';
$string['totalweight100'] = 'Az összsúly 100-zal egyenlő';
$string['totalweightnot100'] = 'Az összsúly nem egyenlő 100-zal';
$string['turnfeedbackoff'] = 'Visszajelzés kikapcsolása';
$string['turnfeedbackon'] = 'Visszajelzés bekapcsolása';
$string['typenone'] = 'Nincs';
$string['typescale'] = 'Skála';
$string['typescale_help'] = 'Skálázó pontozás használata esetén kiválaszthat egy skálát. Tevékenységalapú pontozási tételhez a skála a tevékenységet frissítő oldalról választható ki.';
$string['typetext'] = 'Szöveg';
$string['typevalue'] = 'Érték';
$string['uncategorised'] = 'Nincs kategorizálva';
$string['unchangedgrade'] = 'A pont nem módosult';
$string['unenrolledusersinimport'] = 'Az importálás az alábbi pontokat eredményezte a kurzusba be nem iratkozott felhasználók esetén: {$a}';
$string['unlimitedgrades'] = 'Korlátlan pontszámok';
$string['unlimitedgrades_help'] = 'Alapesetben a pontokat a pontozási tétel maximális és minimális értéke határolja be. Ezzel a beállítással megszünteti a korlátot és 100% fölötti pontokat rögzíthet közvetlenül az osztályozónaplóban. Ajánlatos csak nyugalmasabb időszakban bekapcsolni, mivel minden pontot újraszámol a rendszer, ami megterhelheti a szervert.';
$string['unlock'] = 'Zár feloldása';
$string['unlockverbose'] = '{$a->category} {$a->itemmodule} {$a->itemname} feloldása';
$string['unused'] = 'Nem használatos';
$string['updatedgradesonly'] = 'Csak új vagy frissített pontok exportálása';
$string['uploadgrades'] = 'Pontok feltöltése';
$string['useadvanced'] = 'Részletes funkciók használata';
$string['usedcourses'] = 'Használatban lévő kurzusok';
$string['usedgradeitem'] = 'Használatban lévő pontozási tétel';
$string['usenooutcome'] = 'Nem használ eredményt';
$string['usenoscale'] = 'Nem használ skálát';
$string['usepercent'] = 'Százalék használata';
$string['user'] = 'Felhasználó';
$string['userenrolmentsuspended'] = 'A beiratkozás szünetel.';
$string['usergrade'] = '{$a->fullname} ({$a->useridnumber}) felhasználó {$a->gradeidnumber} tétel esetén';
$string['userpreferences'] = 'Felhasználói beállítások';
$string['useweighted'] = 'Súlyozás használata';
$string['verbosescales'] = 'Szöveges skálák';
$string['viewbygroup'] = 'Csoport';
$string['viewgrades'] = 'Pontok kijelzése';
$string['warningexcludedsum'] = 'Figyelmeztetés: a pontok kizárása nem egyeztethető össze az összesítéssel.';
$string['weight'] = 'súly';
$string['weightcourse'] = 'Súlyozott pontok használata a kurzushoz';
$string['weightedascending'] = 'Növekvő súlyozott százalék szerinti rendezés';
$string['weighteddescending'] = 'Csökkenő súlyozott százalék szerinti rendezés';
$string['weightedpct'] = 'súlyozott %';
$string['weightedpctcontribution'] = 'súlyozott %-os hozzájárulás';
$string['weightorextracredit'] = 'Súly vagy külön kreditpont';
$string['weights'] = 'Súlyok';
$string['weightsedit'] = 'Súlyok és külön kreditpontok szerkesztése';
$string['weightuc'] = 'Súly';
$string['writinggradebookinfo'] = 'Osztályozónapló beállításainak írása';
$string['xml'] = 'XML';
$string['yes'] = 'Igen';
$string['yourgrade'] = 'Pontja';
