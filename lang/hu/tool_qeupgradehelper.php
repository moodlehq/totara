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
 * Strings for component 'tool_qeupgradehelper', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_qeupgradehelper
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Lépés';
$string['alreadydone'] = 'Már minden átalakítás megtörtént';
$string['areyousure'] = 'Biztos?';
$string['areyousuremessage'] = 'Folytatja az összes {$a->numtoconvert} próbálkozás frissítését \'{$a->name}\' teszt, {$a->shortname} kurzus esetén?';
$string['areyousureresetmessage'] = '\'{$a->name}\' tesztben {$a->shortname} kurzusban {$a->totalattempts} próbálkozás történt, ezek közül  a régi rendszerből {$a->convertedattempts} frissítésére került sor. Közülük {$a->resettableattempts} állítható vissza később végrehajtandó átalakítás céljából. Folytatja?';
$string['attemptstoconvert'] = 'Átalakítandó próbálkozások';
$string['backtoindex'] = 'Vissza a fő oldalra';
$string['conversioncomplete'] = 'Az átalakítás befejeződött';
$string['convertattempts'] = 'Próbálkozások átalakítása';
$string['convertedattempts'] = 'Átalakított próbálkozások';
$string['convertquiz'] = 'Próbálkozások átalakítása';
$string['cronenabled'] = 'A cron bekapcsolva';
$string['croninstructions'] = 'A cron bekapcsolásával a részbeni frissítés után automatikusan elvégezheti az átalakítást. A cron a (szerver helyi ideje szerinti) napon a beállított órák közötti időpontban fut le. Ilyenkor mindig feldolgoz egy sor próbálkozást az időkorláton belül, majd vár a cron következő futtatásáig. A cron beállítása esetén is csak akkor lép működésbe, ha észleli, hogy a 2.1-re frissítés megtörtént.';
$string['cronprocesingtime'] = 'Az egyes cron-futtatások feldolgozási ideje';
$string['cronsetup'] = 'A cron beállítása';
$string['cronsetup_desc'] = 'A cront beállíthatja úgy, hogy az egyes tesztek próbálkozásainak adatait automatikusan frissítse.';
$string['cronstarthour'] = 'Kezdési időpont órája';
$string['cronstophour'] = 'Befejezési időpont órája';
$string['extracttestcase'] = 'Tesztesetek előállítása';
$string['extracttestcase_desc'] = 'Az adatbázisból vett mintaadatok használata olyan egységtesztek létrehozásához, amelyekkel a firssítés ellenőrizhető.';
$string['gotoindex'] = 'Vissza a frissíthető tesztek felsorolásához.';
$string['gotoquizreport'] = 'Áttérés a teszt jelentéseihez a frissítés ellenőrzése céljából';
$string['gotoresetlink'] = 'Áttérés a visszaállítható tesztek felsorolásához.';
$string['includedintheupgrade'] = 'Szerepel a frissítésben?';
$string['invalidquizid'] = 'Érvénytelen tesztazonosító. Vagy a teszt nem létezik, vagy nincs hozzá átalakítandó próbálkozás.';
$string['listpreupgrade'] = 'Tesztek és próbálkozások felsorolása.';
$string['listpreupgrade_desc'] = 'Itt jelenik meg a rendszerben szereplő összes tesztről és a hozzájuk tartozó próbálkozások számáról készült jelentés. Ennek alapján megbecsülheti, mennyi frissítésre lesz szüksége.';
$string['listpreupgradeintro'] = 'Ez a portál frissítésekor feldolgozandó tesztpróbálkozások száma. Néhány tízezer nem gond, de ennél lényegesen nagyobb szám esetén számításba kell venni a feldolgozásra fordítandó időt';
$string['listtodo'] = 'A frissítésre váró tesztek felsorolása';
$string['listtodo_desc'] = 'Itt jelenik meg a rendszerben (esetleg) szereplő összes olyan tesztről készült jelentés, amelyek próbálkozásaihoz az új kérdésmotorra való áttéréshez firssítést kell végrehajtani.';
$string['listtodointro'] = 'Itt jelenik meg az összes olyan teszt, amelyek próbálkozásait még át kell alakítani. Az ugrópontra kattintva alapkíthatja át a próbálkozásokat.';
$string['listupgraded'] = 'A visszaállítható. már frissített tesztek felsorolása';
$string['listupgraded_desc'] = 'Itt jelenik meg a rendszerben szereplő összes olyan tesztről készült jelentés, amelyek esetén a próbálkozások frissítése már megtörtént, de még rendelkezésre állnak a régi adatok, így lehetséges a visszaállítás és a frissítés újbóli végrehajtása.';
$string['listupgradedintro'] = 'Ez az összes olyan teszt, amelyek esetén a próbálkozások frissítése már megtörtént, de még rendelkezésre állnak a régi próbálkozási adatok, így lehetséges a visszaállítás és a frissítés újbóli végrehajtása';
$string['noquizattempts'] = 'Portálján nincsenek tesztpróbálkozások!';
$string['nothingupgradedyet'] = 'Nincs visszaállítható. frissített próbálkozás';
$string['notupgradedsiterequired'] = 'A program csak a portál frissítése előtt futtatható le.';
$string['numberofattempts'] = 'Tesztpróbálkozások száma';
$string['oldsitedetected'] = 'Ez olyan portál, ahol még nem történt meg az új kérdésmotor használatához szükséges frissítés.';
$string['outof'] = '{$a->some} / {$a->total}';
$string['pluginname'] = 'Súgó a kérdésmotorra frissítéshez';
$string['pretendupgrade'] = 'A próbálkozások frissítésének próbaüzeme';
$string['pretendupgrade_desc'] = 'A frissítés három dolgot végez el: betölti az adatbázisból az adatokat, átalakítja őket, majd az átalakított adatokat kiírja az adatbázisba. A programkód a folyamat első két lépését hajtja végre.';
$string['questionsessions'] = 'Kérdéssel kapcsolatos folyamatok';
$string['quizid'] = 'Tesztazonosító';
$string['quizupgrade'] = 'A tesztfrissítés állapota';
$string['quizzesthatcanbereset'] = 'Az alábbi tesztekhez kapcsolódik átalakított, esetleg visszaállítható próbálkozás.';
$string['quizzestobeupgraded'] = 'Minden próbálkozással rendelkező teszt';
$string['quizzeswithunconverted'] = 'Az alábbi tesztekhez kapcsolódnak átalakítandó próbálkozások';
$string['resetcomplete'] = 'A visszaállítás befejeződött.';
$string['resetquiz'] = 'Próbálkozások visszaállítása...';
$string['resettingquizattempts'] = 'Tesztpróbálkozások visszaállítása';
$string['resettingquizattemptsprogress'] = '{$a->done} / {$a->outof}. próbálkozás visszaállítása';
$string['upgradedsitedetected'] = 'Ezen a portálon megtörtént az új kérdésmotor használatához szükséges frissítés.';
$string['upgradedsiterequired'] = 'A program csak a portál frissítése után futtatható le.';
$string['upgradingquizattempts'] = '{$a->shortname} kurzus \'{$a->name}\' tesztjéhez tartozó próbálkozások frissítése';
$string['veryoldattemtps'] = 'Portálján a Moodle 1.4-ről 1.5-re firissítésekor {$a} tesztpróbálkozás frissítésére nem került sor. Ezeket a rendszer az alapfrissítés előtt kezeli. Vegye figyelembe az ehhez szükséges plusz időt.';
