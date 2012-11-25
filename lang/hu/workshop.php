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
 * Strings for component 'workshop', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   workshop
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Hozzáférés szabályozása';
$string['aggregategrades'] = 'Pontok újraszámolása';
$string['aggregation'] = 'Pontok összegzése';
$string['allocate'] = 'Leadott munkák hozzárendelése';
$string['allocatedetails'] = 'elvárt: {$a->expected}<br />leadott: {$a->submitted}<br />hozzárendelendő: {$a->allocate}';
$string['allocation'] = 'Leadott munkák hozzárendelése';
$string['allocationdone'] = 'Hozzárendelés kész';
$string['allocationerror'] = 'Hozzárendelési hiba';
$string['allsubmissions'] = 'Minden leadott munka';
$string['alreadygraded'] = 'Már pontozták';
$string['areainstructauthors'] = 'Leadási tudnivalók';
$string['areainstructreviewers'] = 'Értékelési tudnivalók';
$string['areasubmissionattachment'] = 'Leadott munka csatolmányai';
$string['areasubmissioncontent'] = 'Leadott szövegek';
$string['assess'] = 'Értékelés';
$string['assessedexample'] = 'Értékelt leadott próbamunka';
$string['assessedsubmission'] = 'Értékelt leadott munka';
$string['assessingexample'] = 'Leadott próbamunka értékelése';
$string['assessingsubmission'] = 'Leadott munka értékelése';
$string['assessment'] = 'Értékelés';
$string['assessmentby'] = '<a href="{$a->url}">{$a->name}</a> értékelte';
$string['assessmentbyfullname'] = 'Értékelte {$a}';
$string['assessmentbyyourself'] = 'Saját értékelés';
$string['assessmentdeleted'] = 'Értékelés hozzárendelése törölve';
$string['assessmentend'] = 'Értékelés határideje';
$string['assessmentenddatetime'] = 'Értékelés határideje: {$a->daydatetime} ({$a->distanceday})';
$string['assessmentendevent'] = '{$a}  (értékelés határideje)';
$string['assessmentform'] = 'Értékelő űrlap';
$string['assessmentofsubmission'] = '<a href="{$a->submissionurl}">{$a->submissiontitle}</a> <a href="{$a->assessmenturl}">értékelése</a>';
$string['assessmentreference'] = 'Referenciaértékelés';
$string['assessmentreferenceconflict'] = 'Nem lehet olyan mintaleadást értékelni, amelyhez referenciaértékelést adott meg.';
$string['assessmentreferenceneeded'] = 'Referenciaértékeléshez értékelnie kell ezt a leadott próbamunkát. A leadott munka értékeléséhez kattintson a \'Tovább\' gombra.';
$string['assessmentsettings'] = 'Értékelési beállítások';
$string['assessmentstart'] = 'Értékelés elkezdése';
$string['assessmentstartdatetime'] = 'Értékelhető {$a->daydatetime} időponttól ({$a->distanceday})';
$string['assessmentstartevent'] = '{$a}  (értékelhetőségi időtartam)';
$string['assessmentweight'] = 'Értékelési súly';
$string['assignedassessments'] = 'Értékelendő hozzárendelt leadott munkák';
$string['assignedassessmentsnone'] = 'Önnek nincs értékelendő hozzárendelt leadott munkája';
$string['backtoeditform'] = 'Vissza az űrlap szerkesztéséhez';
$string['byfullname'] = 'név: <a href="{$a->url}">{$a->name}</a>';
$string['calculategradinggrades'] = 'Értékelési pontok kiszámítása';
$string['calculategradinggradesdetails'] = 'elvárt: {$a->expected}<br />kiszámított: {$a->calculated}';
$string['calculatesubmissiongrades'] = 'Leadott munkákra adott pontok kiszámítása';
$string['calculatesubmissiongradesdetails'] = 'elvárt: {$a->expected}<br />kiszámított: {$a->calculated}';
$string['chooseuser'] = 'Felhasználó kiválasztása...';
$string['clearaggregatedgrades'] = 'Minden összegzett pont törlése';
$string['clearaggregatedgrades_help'] = 'A leadott munkákra kiszámított összesített pontok és az értékelési pontok visszaállítódnak. A pontozási értékelési szakaszban újból elölről elkezdheti kiszámítani ezeket a pontokat.';
$string['clearaggregatedgradesconfirm'] = 'Biztosan törli a leadott munkákra kiszámított összesített pontokat és az értékelési pontokat?';
$string['clearassessments'] = 'Értékelések törlése';
$string['clearassessments_help'] = 'A leadott munkákra kiszámított összesített pontok és az értékelési pontok visszaállítódnak. Az értékelő űrlapok kitöltésére vonatkozó információk megőrződnek, de az értékelőknek újból meg kell nyitniuk az értékelő űrlapokat, majd a pontok újraszámításához ismét el kell őket menteniük.';
$string['clearassessmentsconfirm'] = 'Biztosan kitöröl minden értékelési pontot? Az adatokat egyedül nem fogja tudni visszaállítani, az értékelőknek újból értékelniük kell minden hozzárendelt leadott munkát.';
$string['configexamplesmode'] = 'Példaértékelés alapbeállítása a műhelymunkákban';
$string['configgrade'] = 'A műhelymunkákban leadott munka alapbeállítás szerinti maximális pontszáma';
$string['configgradedecimals'] = 'Pontok megjelenítése során hány számjegy jelenjen meg a tizedesjel után alapesetben?';
$string['configgradinggrade'] = 'A műhelymunkákban az értékelés alapbeállítás szerinti maximális pontszáma';
$string['configmaxbytes'] = 'A portál összes műhelymunkájában leadható munka alapbeállítás szerinti maximális mérete (a kurzuskorlátok és más helyi beállítások függvényében)';
$string['configstrategy'] = 'A műhelymunkákban az alapbeállítás szerinti pontozási stratégia';
$string['createsubmission'] = 'Leadás';
$string['daysago'] = '{$a} nappal ezelőtt';
$string['daysleft'] = '{$a} nap van hátra';
$string['daystoday'] = 'ma';
$string['daystomorrow'] = 'holnap';
$string['daysyesterday'] = 'tegnap';
$string['deadlinesignored'] = 'Az időkorlátozás Önre nem vonatkozik.';
$string['editassessmentform'] = 'Értékelő űrlap szerkesztése';
$string['editassessmentformstrategy'] = 'Értékelő űrlap szerkesztése ({$a})';
$string['editingassessmentform'] = 'Értékelő űrlap szerkesztése folyamatban';
$string['editingsubmission'] = 'Leadott munka szerkesztése';
$string['editsubmission'] = 'Leadott munka szerkesztése';
$string['err_multiplesubmissions'] = 'Az űrlap szerkesztése közben a leadott munka másik változatának mentésére került sor. Egy felhasználótól csak egy leadott munkára van lehetőség.';
$string['err_removegrademappings'] = 'Nem sikerül törölni a nem használt pontegyeztetéseket';
$string['evaluategradeswait'] = 'Várjon, amíg az értékelések elkészülnek és a pontok kiszámítása megtörténik';
$string['evaluation'] = 'Pontozásos értékelés';
$string['evaluationmethod'] = 'Pontozásos értékelés módszere';
$string['evaluationmethod_help'] = 'A pontozásos értékelés módszere szabja meg az értékelésre adott pont kiszámításának módját. Jelenleg csak egy lehetőség áll rendelkezésére - egybevetés a legjobb értékeléssel.';
$string['example'] = 'Leadott példamunka';
$string['exampleadd'] = 'Leadott példamunka hozzáadása';
$string['exampleassess'] = 'Leadott példamunka értékelése';
$string['exampleassessments'] = 'Értékelendő leadott példamunkák';
$string['exampleassesstask'] = 'Példák értékelése';
$string['exampleassesstaskdetails'] = 'elvárt: {$a->expected}<br />értékelt: {$a->assessed}';
$string['examplecomparing'] = 'Leadott példamunka-értékelések egybevetése';
$string['exampledelete'] = 'Példa törlése';
$string['exampledeleteconfirm'] = 'Biztosan törli a következő leadott példamunkát? A leadott munka törléséhez kattintson a \'Tovább\' gombra.';
$string['exampleedit'] = 'Példa szerkesztése';
$string['exampleediting'] = 'Példa szerkesztése folyamatban';
$string['exampleneedassessed'] = 'Először értékelnie kell az összes leadott példamunkát.';
$string['exampleneedsubmission'] = 'Először le kell adnia munkáját és értékelnie kell az összes leadott példamunkát.';
$string['examplesbeforeassessment'] = 'A példák a saját leadás után érhetők el, és értékelésükre még a csoporttársi értékelés előtt sort kell keríteni';
$string['examplesbeforesubmission'] = 'A példákat a saját munka leadása előtt értékelni kell.';
$string['examplesmode'] = 'A példaértékelés módja';
$string['examplesubmissions'] = 'Leadott példamunkák';
$string['examplesvoluntary'] = 'A leadott példamunkák értékelése önkéntes.';
$string['feedbackauthor'] = 'Visszajelzés a szerzőnek';
$string['feedbackby'] = '{$a} visszajezése';
$string['feedbackreviewer'] = 'Visszajelzés az ellenőrnek';
$string['formataggregatedgrade'] = '{$a->grade}';
$string['formataggregatedgradeover'] = '<del>{$a->grade}</del><br /><ins>{$a->over}</ins>';
$string['formatpeergrade'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span>';
$string['formatpeergradeover'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span>';
$string['formatpeergradeoverweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span> @ <span class="weight">{$a->weight}</span>';
$string['formatpeergradeweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span> @ <span class="weight">{$a->weight}</span>';
$string['givengrades'] = 'Adott pontok';
$string['gradecalculated'] = 'A leadott munkára adott kiszámított pont';
$string['gradedecimals'] = 'Pontok tizedeshelyei';
$string['gradegivento'] = '&gt;';
$string['gradeinfo'] = 'Pont: {$a->received} / {$a->max}';
$string['gradeitemassessment'] = '{$a->workshopname} (értékelés)';
$string['gradeitemsubmission'] = '{$a->workshopname} (leadott munka)';
$string['gradeover'] = 'Leadott munkára adott pont felülírása';
$string['gradereceivedfrom'] = '&lt;';
$string['gradesreport'] = 'Műhelymunka pontjairól szóló jelentés';
$string['gradinggrade'] = 'Értékelési pont';
$string['gradinggrade_help'] = 'Ez a beállítás adja meg a leadott munka értékeléséért kapható legmagasabb pontot.';
$string['gradinggradecalculated'] = 'Értékelés számított pontja';
$string['gradinggradeof'] = 'értékelési pont (/ {$a})';
$string['gradinggradeover'] = 'Értékelésre adott pont felülírása';
$string['gradingsettings'] = 'Osztályozási beállítások';
$string['iamsure'] = 'Igen, biztosan.';
$string['info'] = 'Infó';
$string['instructauthors'] = 'Utasítások a leadott munkához';
$string['instructreviewers'] = 'Utasítások az értékeléshez';
$string['introduction'] = 'Bevezetés';
$string['latesubmissions'] = 'Későn leadott munkák';
$string['latesubmissions_desc'] = 'Munkák határidő utáni leadásának engedélyezése';
$string['latesubmissions_help'] = 'Bekapcsolása esetén a szerzők munkájukat a leadási határidő után vagy az értékelési szakaszban is leadhatják. A későn leadott munkákat azonban nem lehet szerkeszteni.';
$string['latesubmissionsallowed'] = 'Későn leadott munkák megengedettek';
$string['maxbytes'] = 'Maximális állományméret';
$string['modulename'] = 'Műhelymunka';
$string['modulenameplural'] = 'Műhelymunkák';
$string['mysubmission'] = 'Leadott munkám';
$string['nattachments'] = 'Leadott munkák csatolmányainak maximális száma';
$string['noexamples'] = 'A műhelymunkában még nincs példa';
$string['noexamplesformready'] = 'Leadott példamunkák megadása előtt meg kell adnia az értékelési űrlapot';
$string['nogradeyet'] = 'Még nincs pont';
$string['nosubmissionfound'] = 'A felhasználóhoz nincs leadott munka';
$string['nosubmissions'] = 'A műhelymunkában még nincs leadott munka';
$string['notassessed'] = 'Még nincs értékelve';
$string['nothingtoreview'] = 'Nincs mit felülvizsgálni';
$string['notoverridden'] = 'Nincs felülírva';
$string['noworkshops'] = 'A kurzusban nincs műhelymunka';
$string['noyoursubmission'] = 'Még nem adta le munkáját.';
$string['nullgrade'] = '-';
$string['page-mod-workshop-x'] = 'Műhelymodul tetszőleges oldala';
$string['participant'] = 'Résztvevő';
$string['participantrevierof'] = 'A résztvevő ezt felülvizsgálja:';
$string['participantreviewedby'] = 'A résztvevőt ez felülvizsgálja:';
$string['phaseassessment'] = 'Értékelési szakasz';
$string['phaseclosed'] = 'Lezárva';
$string['phaseevaluation'] = 'Pontozásértékelési szakasz';
$string['phasesetup'] = 'Beállítási szakasz';
$string['phasesubmission'] = 'Leadási szakasz';
$string['pluginadministration'] = 'Műhelymunka adminisztrálása';
$string['pluginname'] = 'Műhelymunka';
$string['prepareexamples'] = 'Leadott példamunkák elkészítése';
$string['previewassessmentform'] = 'Előnézet';
$string['publishedsubmissions'] = 'Közzétett leadott munkák';
$string['publishsubmission'] = 'Leadott munka közzététele';
$string['publishsubmission_help'] = 'A közzétett leadott munkákat a többiek a műhelymunka lezárását követően érhetik el.';
$string['reassess'] = 'Újraértékelés';
$string['receivedgrades'] = 'Beérkezett pontok';
$string['recentassessments'] = 'Műhelymunka értékelései:';
$string['recentsubmissions'] = 'Műhelymunka leadott munkái:';
$string['saveandclose'] = 'Mentés és bezárás';
$string['saveandcontinue'] = 'Mentés és a szerkesztés folytatása';
$string['saveandpreview'] = 'Mentés és előzetes megtekintés';
$string['selfassessmentdisabled'] = 'Önértékelés kikapcsolva';
$string['someuserswosubmission'] = 'Legalább egy szerző még nem adta le munkáját';
$string['sortasc'] = 'Növekvő sorrendben';
$string['sortdesc'] = 'Csökkenő sorrendben';
$string['strategy'] = 'Pontozási stratégia';
$string['strategy_help'] = 'A pontozási stratégia határozza meg a használandó értékelő űrlapot és a leadott munkák pontozásának mikéntjét. 4 lehetőség közül választhat:
* Összegző pontozás - Meghatározott szempontok szerint és pontot tartalmaz
* Megjegyzések - Meghatározott szempontok szerint megjegyzéseket tartalmaz, de pontot nem
* Hibaszám - Megjegyzéseket és egy meghatározott szempontok szerint állításra vonatkozó igen/nem értékelést tartalmaz
* Rubrika - Meghatározott követelmények alapján szint szerinti értékelést tartalmaz';
$string['strategyhaschanged'] = 'A műhelymunka pontozási stratégiája az űrlap szerkesztésre való megnyitása óta módosult.';
$string['submission'] = 'Leadott munka';
$string['submissionattachment'] = 'Csatolmány';
$string['submissionby'] = 'Leadta: {$a}';
$string['submissioncontent'] = 'Leadott munka tartalma';
$string['submissionend'] = 'Leadott munkák határideje';
$string['submissionenddatetime'] = 'Leadott munkák határideje: {$a->daydatetime} ({$a->distanceday})';
$string['submissionendevent'] = '{$a}  (leadás határideje)';
$string['submissiongrade'] = 'Leadott munkára adott pont';
$string['submissiongrade_help'] = 'Ez a beállítás határozza meg a leadott munkára adható maximális pontszámot.';
$string['submissiongradeof'] = 'Leadott munkára adott pont (szerző: {$a})';
$string['submissionsettings'] = 'Leadott munka beállításai';
$string['submissionstart'] = 'Munkák leadásának kezdete';
$string['submissionstartdatetime'] = 'Leadható ekkortól:  {$a->daydatetime} ({$a->distanceday})';
$string['submissionstartevent'] = '{$a} (leadásra elérhető)';
$string['submissiontitle'] = 'Cím';
$string['subplugintype_workshopallocation'] = 'Leadások hozzárendelésének módja';
$string['subplugintype_workshopallocation_plural'] = 'Leadások hozzárendelésének módjai';
$string['subplugintype_workshopeval'] = 'Pontozásos értékelés módszere';
$string['subplugintype_workshopeval_plural'] = 'Pontértékelési módszerek';
$string['subplugintype_workshopform'] = 'Pontozási stratégia';
$string['subplugintype_workshopform_plural'] = 'Pontozási stratégiák';
$string['switchingphase'] = 'Átkapcsolási szakasz';
$string['switchphase'] = 'Szakasz átkapcsolása';
$string['switchphase10info'] = 'A műhelymunkát <strong>beállítási szakaszba</strong> fogja átkapcsolni. Ekkor a felhasználók nem módosíthatják leadott munkáikat vagy értékeléseiket. A tanárok ebben a szakaszban módosíthatják a műhelymunka beállításait és az értékelő űrlapok pontozási stratégiáját.';
$string['switchphase20info'] = 'A műhelymunkát <strong>leadási szakaszba</strong> fogja átkapcsolni. Ezalatt a tanulók leadhatják munkájukat (ha van beállítva, akkor a leadott munkához való hozzáférés időtartama alatt). A tanárok a leadott munkákat kioszthatják csoporttársak általi ellenőrzésre.';
$string['switchphase30info'] = 'A műhelymunkát <strong>értékelési szakaszba</strong> fogja átkapcsolni. Ezalatt az ellenőrök értékelhetik a nekik kiosztott munkákat (ha van beállítva, akkor az értékeléshez való hozzáférés időtartama alatt).';
$string['switchphase40info'] = 'A műhelymunkát <strong>pontozásértékelő szakaszba</strong> fogja átkapcsolni. Ezalatt a felhasználók nem módosíthatják leadott munkájukat vagy értékelésüket. A tanárok a pontozásértékelő eszközökkel kiszámíthatják a végső osztályzatot és visszajelzést küldhetnek az ellenőröknek.';
$string['switchphase50info'] = 'A műhelymunkát le fogja zárni. Ennek következtében a kiszámított végleges osztályzatok bekerülnek az osztályozónaplóba. A tanulók megtekinthetik leadott munkáikat és a leadott munkák értékelését.';
$string['taskassesspeers'] = 'Csoporttársak értékelése';
$string['taskassesspeersdetails'] = 'összesen: {$a->total}<br />függőben: {$a->todo}';
$string['taskassessself'] = 'Önértékelés';
$string['taskinstructauthors'] = 'Utasítások megadása a leadott munkákhoz';
$string['taskinstructreviewers'] = 'Utasítások megadása az értékeléshez';
$string['taskintro'] = 'Műhelymunka bevezetőjének beállítása';
$string['tasksubmit'] = 'Munkájának leadása';
$string['toolbox'] = 'A műhelymunka eszközkészlete';
$string['undersetup'] = 'A műhelymunka beállítása folyamatban. Várjon, amíg a rendszer átkapcsol a következő szakaszba.';
$string['useexamples'] = 'Példák használata';
$string['useexamples_desc'] = 'A leadott példamunkákkal gyakorlatot szerezhet az értékeléshez';
$string['useexamples_help'] = 'Bekapcsolása esetén a felhasználók próbálkozhatnak egy vagy több példamunka értékelésével, vagy értékelésüket egybevethetik a referenciaértékeléssel. A pont nem számít bele az értékelés pontszámába.';
$string['usepeerassessment'] = 'Csoporttársi értékelés használata';
$string['usepeerassessment_desc'] = 'A tanulók értékelhetik mások munkáját';
$string['usepeerassessment_help'] = 'Bekapcsolása esetén a felhasználók másoktól munkákat kaphatnak értékelésre, melyért a saját leadott munkájukra kapotton fölül pontot kapnak.';
$string['userdatecreated'] = 'leadás dátuma: <span>{$a}</span>';
$string['userdatemodified'] = 'módosítás dátuma: <span>{$a}</span>';
$string['userplan'] = 'Műhelymunka-tervező';
$string['userplan_help'] = 'A műhelymunka-tervezőn a tevékenység minden szakasza megjelenik a hozzájuk tartozó feladatok felsorolásával együtt. Az aktuális szakasz kiemelten látszik, a feladatok teljesítését pipa jelzi.';
$string['useselfassessment'] = 'Önértékelés használata';
$string['useselfassessment_desc'] = 'A tanulók értékelhetik saját munkájukat';
$string['useselfassessment_help'] = 'Bekapcsolása esetén a felhasználók saját leadott munkájukat kaphatják meg értékelésre, melyért a saját leadott munkájukra kapotton fölül pontot kapnak.';
$string['weightinfo'] = 'Súly: {$a}';
$string['withoutsubmission'] = 'Ellenőr saját leadott munka nélkül';
$string['workshop:allocate'] = 'Leadott munkák kiosztása ellenőrzésre';
$string['workshop:editdimensions'] = 'Értékelő űrlapok szerkesztése';
$string['workshop:ignoredeadlines'] = 'Az időkorlátozás figyelmen kívül hagyása';
$string['workshop:manageexamples'] = 'Leadott példamunkák kezelése';
$string['workshop:overridegrades'] = 'Kiszámított osztályzatok felülírása';
$string['workshop:peerassess'] = 'Csoporttársi értékelés';
$string['workshop:publishsubmissions'] = 'Leadott munkák közzététele';
$string['workshop:submit'] = 'Leadás';
$string['workshop:switchphase'] = 'Szakasz átkapcsolása';
$string['workshop:view'] = 'Műhelymunka megtekintése';
$string['workshop:viewallassessments'] = 'Az összes értékelés megtekintése';
$string['workshop:viewallsubmissions'] = 'Az összes leadott munka megtekintése';
$string['workshop:viewauthornames'] = 'Szerzők nevének megtekintése';
$string['workshop:viewauthorpublished'] = 'Közzétett leadott munkák szerzőinek megtekintése';
$string['workshop:viewpublishedsubmissions'] = 'Közzétett leadott munkák megtekintése';
$string['workshop:viewreviewernames'] = 'Ellenőrök nevének megtekintése';
$string['workshopfeatures'] = 'A műhelymunka jellemzői';
$string['workshopname'] = 'A műhelymunka neve';
$string['yourassessment'] = 'Értékelése';
$string['yoursubmission'] = 'Saját leadott munkája';
