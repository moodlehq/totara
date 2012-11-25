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
 * Strings for component 'plagiarism_turnitin', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   plagiarism_turnitin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminlogin'] = 'Bejelentkezés a Turnitin alá rendszergazdaként';
$string['compareinstitution'] = 'Leadott fájlok és beadott dolgozatok összehasonlítása intézményen belül';
$string['compareinstitution_help'] = 'Csak akkor érhető el, ha egyedi csomópontot állított be/vásárolt. Ha bizonytalan, állítsa "Nem"-re.';
$string['compareinternet'] = 'Leadott fájlok összehasonlítása az internettel';
$string['compareinternet_help'] = 'Ezzel összehasonlíthatja a leadott munkákat azon internetes tartalmakkal, amelyeket a Turnitin jelenleg nyomon követ.';
$string['comparejournals'] = 'Leadott fájlok összehasonlítása folyóraitokkal, közleményekkel.';
$string['comparejournals_help'] = 'Ezzel összehasonlíthatja a leadott munkákat azon folyóraitokkal, közleményekkel, amelyeket a Turnitin jelenleg nyomon követ.';
$string['comparestudents'] = 'Leadott fájlok összehasonlítása más tanulók állományaival';
$string['comparestudents_help'] = 'Ezzel összehasonlíthatja a leadott munkákat más tanulók állományaival';
$string['configdefault'] = 'Ez az alapbeállítás a feladatok létrehozására való oldalon. Csakis plagiarism/turnitin:enableturnitin jogosultsággal rendelkező felhasználók módosíthatják a beállítást egyéni feladatra.';
$string['configusetiimodule'] = 'Turnitin-leadás bekapcsolása';
$string['defaultsdesc'] = 'Ha egy tevékenységmodulban bekapcsolja a Turnitint, az alábbiak lesznek az alapbeállítások.';
$string['defaultupdated'] = 'A Turnitin alapbeállításai frissítve.';
$string['draftsubmit'] = 'Mikor kell a fájlt a Turnitinba leadni?';
$string['excludebiblio'] = 'A szakirodalom kihagyása';
$string['excludebiblio_help'] = 'A szakirodalom az eredetiségi jelentés megtekintésekor ki-be kapcsolható. Ez a beállítás az első fájl leadása után nem módosítható.';
$string['excludematches'] = 'Csekély egyezések kihagyása';
$string['excludematches_help'] = 'A csekély mértékű egyezéseket százalék vagy szószám alapján kihagyhatja - az alábbi négyzetben válassza ki, melyiket kívánja használni.';
$string['excludequoted'] = 'Idézet kihagyása';
$string['excludequoted_help'] = 'Az idézetek az eredetiségi jelentés megtekintésekor ki-be kapcsolhatók. Ez a beállítás az első fájl leadása után nem módosítható.';
$string['file'] = 'Állomány';
$string['filedeleted'] = 'Az állomány a sorból törölve';
$string['fileresubmitted'] = 'Az állomány újbóli leadásra besorolva';
$string['module'] = 'Modul';
$string['name'] = 'Név';
$string['percentage'] = 'Százalék';
$string['pluginname'] = 'Turnitin plágium-ellenőrző segédprogram';
$string['reportgen'] = 'Mikor készüljenek eredetiségi jelentések?';
$string['reportgen_help'] = 'Ezzel adhatja meg, hogy mikor készüljenek el az eredetiségi jelentések';
$string['reportgenduedate'] = 'Határidőre';
$string['reportgenimmediate'] = 'Haladéktalanul (az első jelentés a végső)';
$string['reportgenimmediateoverwrite'] = 'Haladéktalanul (a jelentések felülírhatók)';
$string['resubmit'] = 'Újbóli leadás';
$string['savedconfigfailure'] = 'Nem sikerül csatlakoztatni/hitelesíteni a Turnitint - lehet, hogy rossz titkos kulcs/felhasználó azonosító párt használ, vagy a szerver nem tud az alkalmazással összekapcsolódni.';
$string['savedconfigsuccess'] = 'A Turnitin-beállítások elmentve, a tanári fiók létrejött';
$string['showstudentsreport'] = 'A hasonlósági jelentés megmutatása a tanulónak';
$string['showstudentsreport_help'] = 'A hasonlósági jelentés lebontva jeleníti meg a leadott munka azon részeit, amelyeket átvettek, valamint azt a helyet, ahol a Turnitin először észlelte ezt a tartalmat.';
$string['showstudentsscore'] = 'Hasonlósági arány megmutatása a tanulónak';
$string['showstudentsscore_help'] = 'A hasonlósági arány a leadott munkának az a százaléka, amely más tartalmakkal egyezik - a magas arány rendszerint rosszat jelent.';
$string['showwhenclosed'] = 'A tevékenység lezárásakor';
$string['similarity'] = 'Hasonlóság';
$string['status'] = 'Állapot';
$string['studentdisclosure'] = 'Tanulói nyilvánosságra hozatal';
$string['studentdisclosure_help'] = 'A szöveget az állományfeltöltő oldalon minden tanuló látja';
$string['studentdisclosuredefault'] = 'Minden feltöltött állományt megvizsgál a Turnitin.com plágium-ellenőrzője';
$string['submitondraft'] = 'Állomány leadása az első feltöltés alkalmával';
$string['submitonfinal'] = 'Állomány leadása, amikor a tanuló osztályozásra küldi be';
$string['teacherlogin'] = 'Bejelentkezés a Turnitin alá tanárként';
$string['tii'] = 'Turnitin';
$string['tiiaccountid'] = 'Turnitin felhasználói azonosító';
$string['tiiaccountid_help'] = 'Ez a felhasználói azonosítója, melyet a Turnitin.com-tól kapott';
$string['tiiapi'] = 'Turnitin alkalmazás';
$string['tiiapi_help'] = 'Ez a Turnitin alkalmazás címe - többnyire https://api.turnitin.com/api.asp';
$string['tiiconfigerror'] = 'Portál-beállítási hiba történt az állomány Turnitinhez küldése közben.';
$string['tiiemailprefix'] = 'Tanulói e-mail előtagja';
$string['tiiemailprefix_help'] = 'Állítsa be ezt, ha nem akarja, hogy a tanulók bejelentkezzenek a turnitin.com portálra és teljes jelentéseket tekintsenek meg.';
$string['tiienablegrademark'] = 'A Grademark (kísérleti) bekapcsolása';
$string['tiienablegrademark_help'] = 'A Grademark a Turnitin egyik választható funkciója. Használatához fel kell vennie a Turnitin-szolgáltatások közé. Bekapcsolása esetén a leadott oldalak lassan jelennek meg.';
$string['tiierror'] = 'TII-hiba';
$string['tiierror1007'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert túl nagy.';
$string['tiierror1008'] = 'Hiba történt a fájl Turnitinhez küldése közben.-';
$string['tiierror1009'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert nem támogatja a típusát. Érvényes állományformák: MS Word, Acrobat PDF, Postscript, egyszerű szöveg, HTML, WordPerfect és Rich Text.';
$string['tiierror1010'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert 100-nál kevesebb nem nyomtatható karaktert tartalmaz.';
$string['tiierror1011'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert hibás a formája és szóközök vannak a betűk között.';
$string['tiierror1012'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert hossza meghaladja a megengedettet.';
$string['tiierror1013'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert 20-nál kevesebb szót tartalmaz.';
$string['tiierror1020'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert nem támogatott karaktereket tartalmaz.';
$string['tiierror1023'] = 'A Turnitin nem tudta feldolgozni a pdf-fájlt, mert jelszóval védett és képeket tartalmaz.';
$string['tiierror1024'] = 'A Turnitin nem tudta feldolgozni a fájlt, mert nem felel meg az érvényes dolgozat feltételeinek.';
$string['tiierrorpaperfail'] = 'A Turnitin nem tudta feldolgozni a fájlt.';
$string['tiierrorpending'] = 'A fájl vár a Turnitinhez való leadásra.';
$string['tiiexplain'] = 'A Turnitin kereskedelmi termék, a szolgáltatásra elő kell fizetni. További információk: <a href="http://docs.moodle.org/en/Turnitin_administration">http://docs.moodle.org/en/Turnitin_administration</a>';
$string['tiiexplainerrors'] = 'AZ oldalon szerepelnek azok a Turnitinhez leadott fájlok, amelyek hibásként vannak megjelölve. A hibakódokat és leírásukat lásd: :<a href="http://docs.moodle.org/en/Turnitin_errors">docs.moodle.org/en/Turnitin_errors</a><br/>Az állományok visszaállítása után a cron megpróbálja ismét leadni őket a Turnitinhez.<br/>Törlésük esetén viszont nem lehet őket ismételten leadni, ezért eltűnnek a tanárok és a tanulók elől a hibák is.';
$string['tiisecretkey'] = 'Titkos Turnitin-kulcs';
$string['tiisecretkey_help'] = 'Ennek beszerzéséhez jelentkezzen be a Turnitin.com alá portálja rendszergazdájaként.';
$string['tiisenduseremail'] = 'Felhasználói e-mail elküldése';
$string['tiisenduseremail_help'] = 'E-mail küldése a TII-rendszerben létrehozott összes felhasználónak olyan ugrópointtal, amelyről ideiglenes jelszóval be tudnak jelentkezni a www.turnitin.com portálra.';
$string['turnitin'] = 'Turnitin';
$string['turnitin:enable'] = 'Tanár számára a Turnitin ki-be kapcsolásának engedélyezése adott modulon belül.';
$string['turnitin:viewfullreport'] = 'Tanár számára a Turnitintól kapott teljes jelentés megtekintésének engedélyezése';
$string['turnitin:viewsimilarityscore'] = 'Tanár számára a Turnitintól kapott hasonlósági pont megtekintésének engedélyezése';
$string['turnitin_attemptcodes'] = 'Hibakódok automatikus újbóli leadáshoz';
$string['turnitin_attemptcodes_help'] = 'Olyan hibakódok, amilyeneket a Turnitin 2. próbálkozásra általában elfogad (a mező módosítása a szervert tovább terhelheti)';
$string['turnitin_attempts'] = 'Újrapróbálkozások száma';
$string['turnitin_attempts_help'] = 'A megadott kódok Turnitinnek való újbóli leadásának a száma. 1 újrapróbálkozás azt jelenti, hogy a megadott hibakódok leadására kétszer kerül sor.';
$string['turnitin_institutionnode'] = 'Intézményi csomópont bekapcsolása';
$string['turnitin_institutionnode_help'] = 'Ha a fiókjához intézményi csomópontot állított be, ennek bekapcsolásával választhatja ki a csomópontot feladatok létrehozása során. MEGJEGYZÉS: ha nincs intézményi csomópontja, ennek bekapcsolása esetén a dolgozat leadása nem fog sikerülni.';
$string['turnitindefaults'] = 'A Turnitin alapbeállításai';
$string['turnitinerrors'] = 'Turnitin-hibák';
$string['useturnitin'] = 'A Turnitin bekapcsolása';
$string['wordcount'] = 'Szószám';
