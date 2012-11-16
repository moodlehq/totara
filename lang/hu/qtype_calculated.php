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
 * Strings for component 'qtype_calculated', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_calculated
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['additem'] = 'Tétel hozzáadása';
$string['addmoreanswerblanks'] = 'Másik válaszhely hozzáadása.';
$string['addmoreunitblanks'] = 'Helyek további {$a} egység számára';
$string['addsets'] = 'Készlet(ek) hozzáadása';
$string['answerhdr'] = 'Válasz';
$string['answerstoleranceparam'] = 'Válaszok toleranciaparaméterei';
$string['answerwithtolerance'] = '{$a->answer} (±{$a->tolerance} {$a->tolerancetype})';
$string['anyvalue'] = 'Tetszőleges érték';
$string['atleastoneanswer'] = 'Legalább egy választ meg kell adnia.';
$string['atleastonerealdataset'] = 'A kérdés szövegének legalább egy valós adatkészletet kell tartalmaznia';
$string['atleastonewildcard'] = 'A válasz képletének vagy a kérdés szövegének legalább egy helyettesítő karaktert kell tartalmaznia';
$string['calcdistribution'] = 'Megoszlás';
$string['calclength'] = 'Tizedeshelyek';
$string['calcmax'] = 'Maximum';
$string['calcmin'] = 'Minimum';
$string['choosedatasetproperties'] = 'A helyettesítő karakterekhez tartozó adatkészlet tulajdonságainak kiválasztása';
$string['choosedatasetproperties_help'] = 'Az adatkészlet olyan értékek készlete, amelyek a helyettesítő karakterek helyére kerülnek. Létrehozhat egy egyedi adatkészletet egy konkrét kérdéshez, vagy egy közös adatkészletet, amelyet a kategórián belül más számításos kérdésekhez is felhasználhat. tartozótulajdonságainak kiválasztása';
$string['correctanswerformula'] = 'Helyes válaszképlet';
$string['correctanswershows'] = 'A helyes válasz látszik';
$string['correctanswershowsformat'] = 'Forma';
$string['correctfeedback'] = 'Helyes válasz esetén';
$string['dataitemdefined'] = 'már meghatározott {$a} számjegyes értékekkel elérhető';
$string['datasetrole'] = 'A <strong>{x..}</strong> helyettesítő karaktereket egy adatkészletből vett számérték váltja föl';
$string['decimals'] = '{$a} használatával';
$string['deleteitem'] = 'Tétel törlése';
$string['deletelastitem'] = 'Az utolsó tétel törlése';
$string['editdatasets'] = 'Helyettesítő karakterek adatkészleteinek szerkesztése';
$string['editdatasets_help'] = 'Helyettesítő értékeket az egyes helyettesítő mezőkbe beírt számmal, majd a Hozzáadás gombra kattintással hozhat létre. 10 vagy több érték automatikus létrehozásához a Hozzáadás gombra kattintás előtt válassza ki a szükséges számértékeket. Egységes megoszlás esetén a határértékeken belül bármely érték azonos valószínűséggel áll elő. Egységes logaritmusos szórásból származó számjegyek esetén az alsó határértékhez közelítő értékek megjelenésének nagyobb a valószínűsége.';
$string['existingcategory1'] = 'már létező közös adatkészletet fog használni';
$string['existingcategory2'] = 'A kategórián belül más kérdésekben már használt állományok létező készletének egyik állománya';
$string['existingcategory3'] = 'A kategórián belül más kérdésekben már használt ugrópontok készletének egyik ugrópontja';
$string['forceregeneration'] = 'Újbóli előállítás előírása';
$string['forceregenerationall'] = 'Az összes helyettesítő karakter újbóli előállításának előírása';
$string['forceregenerationshared'] = 'Csak a nem közös helyettesítő karakterek újbóli előállításának előírása';
$string['functiontakesatleasttwo'] = 'A(z) {$a} függvénynek legalább két argumentummal kell rendelkezni.';
$string['functiontakesnoargs'] = 'A(z) {$a} függvényhez nem tartoznak argumentumok.';
$string['functiontakesonearg'] = 'A(z) {$a} függvénynek pontosan egy argumentummal kell rendelkezni.';
$string['functiontakesoneortwoargs'] = 'A(z) {$a} függvénynek egy vagy két argumentummal kell rendelkezni.';
$string['functiontakestwoargs'] = 'A(z) {$a} függvénynek pontosan két argumentummal kell rendelkezni.';
$string['generatevalue'] = 'Új érték előállítása ezen belül:';
$string['getnextnow'] = 'Új \'Hozzáadandó tétel\' elérése most';
$string['hexanotallowed'] = 'A(z) <strong>{$a->name}</strong> adatkészlet hexadecimális {$a->value} értéke nem megengedett';
$string['illegalformulasyntax'] = 'Hibás \'{$a}\' kezdetű képlet';
$string['incorrectfeedback'] = 'Bármely helytelen válasz esetén';
$string['itemno'] = '{$a} tétel';
$string['itemscount'] = 'Tétel<br />Szám';
$string['itemtoadd'] = 'Hozzáadandó tétel';
$string['keptcategory1'] = 'Ugyanazt a már létező közös adatkészletet fogja használni';
$string['keptcategory2'] = 'Ugyanazon korábbi kategóriába tartozó újrahasználható állománykészletéből egy állomány';
$string['keptcategory3'] = 'Ugyanazon korábbi kategóriába tartozó újrahasználható ugrópontkészletéből egy ugrópont';
$string['keptlocal1'] = 'Ugyanazt a már létező magánadatkészletet fogja használni';
$string['keptlocal2'] = 'Kérdések ugyanazon korábbi magán-állománykészletéből egy állomány';
$string['keptlocal3'] = 'Kérdések ugyanazon korábbi magán-ugrópontkészletéből egy ugrópont';
$string['loguniform'] = 'Egységes logaritmusos szórás';
$string['loguniformbit'] = 'logaritmikus-egyenletes eloszlás számjegyei';
$string['makecopynextpage'] = 'Következő oldal (új kérdés)';
$string['mandatoryhdr'] = 'Kötelező helyettesítők a válaszokban';
$string['max'] = 'Max.';
$string['min'] = 'Min.';
$string['minmax'] = 'Értéktartomány';
$string['missingformula'] = 'Nincs képlet';
$string['missingname'] = 'Nincs kérdésnév';
$string['missingquestiontext'] = 'Nincs kérdésszöveg';
$string['mustbenumeric'] = 'Itt egy számot kell megadnia.';
$string['mustenteraformulaorstar'] = 'Adjon meg egy képletet vagy írjon be \'*\'-ot.';
$string['mustnotbenumeric'] = 'Ez nem lehet szám.';
$string['newcategory1'] = 'Új közös adatkészletet fog használni';
$string['newcategory2'] = 'A kategórián belül más kérdésekben is használható állományok új készletének egyik állománya';
$string['newcategory3'] = 'A kategórián belül más kérdésekben is használható ugrópontok új készletének egyik ugrópontja';
$string['newlocal1'] = 'Új magánadatkészletet fog használni';
$string['newlocal2'] = 'Kizárólag a kérdésben használandó állományok új készletének egyik állománya';
$string['newlocal3'] = 'Kizárólag a kérdésben használandó ugrópontok új készletének egyik ugrópontja';
$string['newsetwildcardvalues'] = 'Helyettesítő karakterek értékeinek új készlete(i)';
$string['nextitemtoadd'] = 'Következő hozzáadandó tétel';
$string['nextpage'] = 'Következő oldal';
$string['nocoherencequestionsdatyasetcategory'] = 'A(z) {$a->qid} azonosítójú kérdés esetén a(z) {$a->qcat} kategóriaazonosító nem egyezik a közös {$a->name} helyettesítő karakter {$a->sharedcat} kategóriaazonosítójával. Szerkessze meg a kérdést.';
$string['nocommaallowed'] = 'Nem használhat vesszőt, használja a pontot, pl. 0.013 vagy 1.3e-2.';
$string['nodataset'] = 'semmi - ez nem helyettesítő karakter';
$string['nosharedwildcard'] = 'Nincs megosztott helyettesítő ebben a kategóriában';
$string['notvalidnumber'] = 'A helyettesítő karakter értéke nem érvényes szám.';
$string['oneanswertrueansweroutsidelimits'] = 'Legalább egy helyes válasz az igaz értékhatáron kívül esik.&lt;br
/&gt;Módosítsa a További paraméterek alatt a válaszok toleranciabeállításait.';
$string['param'] = '{&lt;strong&gt;{$a}&lt;/strong&gt;} paraméter';
$string['partiallycorrectfeedback'] = 'Bármely, részben helyes válasz esetén';
$string['pluginname'] = 'Számításos';
$string['pluginname_help'] = 'A számításos kérdésekkel kapcsos zárójelek közé tett helyettesítő karaktereket használó számjegyes kérdéseket hozhat létre, melyekben a teszt megoldása során a karaktereket egyedi értékek váltják fel. Például a "Mekkora a {h} hosszúságú és {s} szélességű téglalap területe?" kérdéshez a "{h}*{s}" képlet tartozik (ahol a * a szorzás jele).';
$string['pluginnameadding'] = 'Számításos kérdés hozzáadása';
$string['pluginnameediting'] = 'Számításos kérdés szerkesztése';
$string['pluginnamesummary'] = 'A számításos kérdés a számjegyes kérdéshez hasonlít, csak teszt közben a számok kiválasztása véletlenszerűen történik.';
$string['possiblehdr'] = 'Lehetséges helyettesítők csak a kérdés szövegében fordulnak elő';
$string['questiondatasets'] = 'Kérdések adatkészlete';
$string['questiondatasets_help'] = 'Azon helyettesítő karakterek kérdésekhez tartozó adatkészlete, amelyek az egyes kérdésekben fognak szerepelni';
$string['questionstoredname'] = 'Kérdés tárolt neve';
$string['replacewithrandom'] = 'Helyettesítés véletlen számmal';
$string['reuseifpossible'] = 'Előző érték újbóli felhasználása, ha van';
$string['setno'] = '{$a}. készlet';
$string['setwildcardvalues'] = 'helyettesítő karakterek értékeinek készlete(i)';
$string['sharedwildcard'] = 'Közös {<strong>{$a}</strong>} helyettesítő karakter';
$string['sharedwildcardname'] = 'Közös helyettesítő karakter';
$string['sharedwildcards'] = 'Közös helyettesítő karakterek';
$string['showitems'] = 'Megjelenítés';
$string['significantfigures'] = '{$a} használatával';
$string['significantfiguresformat'] = 'sziginifikáns számjegyek';
$string['synchronize'] = 'Közös adatkészletek adatainak szinkronizálása más tesztkérdésekkel';
$string['synchronizeno'] = 'Nincs szinkronizálás';
$string['synchronizeyes'] = 'Szinkronizálás';
$string['synchronizeyesdisplay'] = 'Közös adatkészletek nevének szinkronizálása és kérdésnév előtagjaként való megjelenítése';
$string['tolerance'] = 'Tűrés &plusmn;';
$string['trueanswerinsidelimits'] = 'Helyes válasz: {$a->correct} az igaz {$a->true} határértékein belül';
$string['trueansweroutsidelimits'] = '<span class="error">HIBA A helyes válasz: {$a->correct} az igaz {$a->true} határértékein kívül</span>';
$string['uniform'] = 'Egységes';
$string['uniformbit'] = 'legyenletes eloszlás tizedesei';
$string['unsupportedformulafunction'] = 'A(z) {$a} függvény használata nem támogatott';
$string['updatecategory'] = 'Kategória frissítése';
$string['updatedatasetparam'] = 'Adatkészletek paramétereinek frissítése';
$string['updatetolerancesparam'] = 'Válaszok toleranciaparamétereinek frissítése';
$string['updatewildcardvalues'] = 'Helyettesítő karakter(ek) értékeinek frissítése';
$string['useadvance'] = 'Hibák megjelenítése a Tovább gombbal';
$string['usedinquestion'] = 'Szerepel ebben a kérdésben';
$string['wildcard'] = '{&lt;strong&gt;{$a}&lt;/strong&gt;} helyettesítő karakter';
$string['wildcardparam'] = 'Értékek előállítására használt helyettesítő karakterek paraméterei';
$string['wildcardrole'] = 'A(z) &lt;strong&gt;{x..}&lt;/strong&gt; helyettesítő karakterek helyére az előállított értékekből kapott számérték kerül';
$string['wildcards'] = '{a}...{z} helyettesítő karakterek';
$string['wildcardvalues'] = 'Helyettesítő karakter(ek) értékei';
$string['wildcardvaluesgenerated'] = 'Helyettesítő karakter(ek) előállított értékei';
$string['youmustaddatleastoneitem'] = 'A kérdés mentése előtt legalább egy adatkészletelemet hozzá kell adnia.';
$string['youmustaddatleastonevalue'] = 'A kérdés mentése előtt a helyettesítő karakter(ek)ből legalább egy készletet hozzá kell adnia.';
$string['youmustenteramultiplierhere'] = 'Itt egy szorzót kell megadnia.';
$string['zerosignificantfiguresnotallowed'] = 'A helyes válasznak nem lehet nulla sziginifikáns számjegye';
