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
 * Strings for component 'local_amos', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   local_amos
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['about'] = '<p>Az AMOS mozaikszó, jelentése Automated Manipulation Of Strings (Szövegek automatikus kezelése). Az AMOS a Moodle szövegeinek és előzményeknek a központi adattára. Nyomon követi a Moodle programkódjába bekerülő angol szövegeket, egybefogja a fordításaikat, valamint kezeli a közös fordítási feladatokat és előállítja a Moodle szerverein használandó nyelvi csomagokat.</p> <p>További részletekért lásd az <a href="http://docs.moodle.org/en/AMOS">AMOS dokumentációját</a>.</p>';
$string['amos'] = 'AMOS -- a Moodle fordítóeszköze';
$string['amos:commit'] = 'Előkészített szövegek rögzítése a fő adattárban.';
$string['amos:execute'] = 'A megadott AMOScript lefuttatása';
$string['amos:importfile'] = 'Szövegek importálása feltöltött állományból.';
$string['amos:manage'] = 'Az AMOS-portál kezelése';
$string['amos:stage'] = 'Az AMOS fordítóeszköz használata és a szövegek leadása';
$string['amos:stash'] = 'A leadott szövegek tárolása gyűjtőfájlban';
$string['amos:usegoogle'] = 'A Google-fordító használata';
$string['commitbutton'] = 'Rögzítés';
$string['commitmessage'] = 'Rögzítéshez kapcsolódó üzenet';
$string['commitstage'] = 'Előkészített szövegek rögzítése';
$string['commitstage_help'] = 'Előkészített fordítások végleges tárolása az AMOS adattárában. A szövegtár rögzítése előtt automatikus törlésre és frissítésre kerül sor.';
$string['committableall'] = 'minden nyelv';
$string['committablenone'] = 'nincs elérhető nyelv - forduljon az AMOS vezetőjéhez.';
$string['componentsall'] = 'Mind';
$string['componentsnone'] = 'Egy sem';
$string['componentsstandard'] = 'Standard';
$string['confirmaction'] = 'A leadás nem vonható vissza! Folytatja?';
$string['contribaccept'] = 'Elfogadás';
$string['contribactions'] = 'Hozzájárulás a fordításhoz';
$string['contribactions_help'] = 'Jogosultságától és a munkafolyamatba való bekapcsolódásától függően az alábbi tevékenységeket hajthatja végre:
* Alkalmaz - átmásolja a leadott fordítást az Ön tárolójába, de nem módosítja a kapcsolódó bejegyzést
* Hozzárendel - beállítja a leadott fordításért és annak beépítéséért felelős személyt
* Visszavon - törli a leadott fordításért felelős személyt
* Ellenőriz - a leadott fordításért Önt állítja be felelős személynek, a fordítást \'Ellenőrzés folyamatban\' állapotba állítja és átmásolja a leadott fordítást az Ön tárolójába
* Elfogad - a leadott fordítást elfogadottként jelöli meg
* Elutasít - a leadott fordítást elutasítottként jelöli meg; megjegyzésben indokolja meg.
A fordító e-mailben értesítést kap, ha a leadott fordítás állapota módosul.';
$string['contribapply'] = 'Alkalmaz';
$string['contribassignee'] = 'Jelölt';
$string['contribassigneenone'] = '-';
$string['contribassigntome'] = 'Nekem ad';
$string['contribauthor'] = 'Szerző';
$string['contribclosedno'] = 'Ellenőrzött fordítások elrejtése';
$string['contribclosedyes'] = 'Ellenőrzött fordítások megjelenítése';
$string['contribcomponents'] = 'Összetevők';
$string['contribid'] = 'Azonosító';
$string['contribincomingnone'] = 'Nem érkezett fordítás';
$string['contribincomingsome'] = 'Beérkezett fordítások ({$a})';
$string['contriblanguage'] = 'Nyelv';
$string['contribreject'] = 'Elutasít';
$string['contribresign'] = 'Visszavon';
$string['contribstaged'] = 'Szövegtárba leadott <a href="contrib.php?id={$a->id}">#{$a->id}</a> azonosítójú fordítás {$a->author} részéről';
$string['contribstagedinfo'] = 'Szövegtárba leadott fordítás';
$string['contribstagedinfo_help'] = 'A szövegtár leadott szövegeket tartalmaz. A nyelvi csomag kezelőjének át kell nézni és vagy el kell fogadni (ha beépíthetők) vagy el kell vetni (ha kihagyandók) a hivatalos nyelvi csomagba/csomagból.';
$string['contribstartreview'] = 'Ellenőriz';
$string['contribstatus'] = 'Állapot';
$string['contribstatus0'] = 'Új';
$string['contribstatus10'] = 'Ellenőrzés folyamatban';
$string['contribstatus20'] = 'Elutasítva';
$string['contribstatus30'] = 'Elfogadva';
$string['contribstatus_help'] = 'Egy leadott fordítás munkafolyamata az alábbi:
* Új - a fordítást leadták, de még nem ellenőrizték
* Ellenőrzés folyamatban - a leadott fordítást egy nyelvi csomagért felelős megkapta és ellenőrzésre eltárolta
* Elutasítva - a nyelvi csomagért felelős elutasította a fordítást és feltehetőleg indoklást fűzött hozzá
* Elfogadva - a nyelvi csomagért felelős elfogadta a fordítást';
$string['contribstrings'] = 'Szövegek';
$string['contribstringseq'] = '{$a->orig} új';
$string['contribstringsnone'] = '{$a->orig} (már mindet tartalmazza a nyelvi csomag)';
$string['contribstringssome'] = '{$a->orig} ({$a->same} közülük frissebb fordítással rendelkezik)';
$string['contribsubject'] = 'Tárgy';
$string['contribsubmittednone'] = 'Nincs leadott fordítás';
$string['contribsubmittedsome'] = 'Leadott fordításai';
$string['contribtimemodified'] = 'Módosult';
$string['contributions'] = 'Leadott fordítások';
$string['diff'] = 'Összehasonlítás';
$string['diffaction'] = 'Különbség esetén';
$string['diffaction1'] = 'Mindkét fordítás szövegtárba helyezése a megfelelő fejlesztési verzióban';
$string['diffaction2'] = 'Az  újabb fordítás szövegtárba helyezése mindkét fejlesztési verzióhoz';
$string['diffmode'] = 'Szövegek szövegtárba helyezése, ha';
$string['diffmode1'] = 'Az angol szöveg módosult, de a fordítása nem';
$string['diffmode2'] = 'Az angol szöveg nem módosult, de a fordítása igen';
$string['diffmode3'] = 'Az angol szöveg vagy annak fordítása (de csak az egyikük) módosult';
$string['diffmode4'] = 'Az angol szöveg és annak fordítása módosult';
$string['diffprogress'] = 'A kiválasztott ágak összehasonlítása';
$string['diffprogressdone'] = 'Összesen {$a} különbség fedezhető fel';
$string['diffstaged'] = 'kül.';
$string['diffstrings'] = 'Két ág szövegeinek összehasonlítása';
$string['diffstrings_help'] = 'Ezzel két kiválasztott ág szövegeit hasonlítja össze. Ha eltérés fedezhető föl, mindkét verzió szövegtárba kerül. Ellenőrzéshez és javításhoz használja a "Szövegtárba helyezett szövegek szerkesztése" funkciót.';
$string['diffversions'] = 'Verziók';
$string['emailacceptbody'] = '{$a->assignee}  nyelvi csomagért felelős elfogadta  #{$a->id} {$a->subject} fordítását.

További részletek: {$a->url}.';
$string['emailacceptsubject'] = '[leadott AMOS-fordítás] elfogadva';
$string['emailcontributionbody'] = '{$a->author} új  #{$a->id} {$a->subject} fordítást adott le.

További részletek: {$a->url}.';
$string['emailcontributionsubject'] = '[leadott AMOS-fordítás] Új fordítás leadva';
$string['emailrejectbody'] = '{$a->assignee}  nyelvi csomagért felelős elutasította #{$a->id} {$a->subject} fordítását.

További részletek: {$a->url}.';
$string['emailrejectsubject'] = '[leadott AMOS-fordítás] elutasítva';
$string['emailreviewbody'] = '{$a->assignee}  nyelvi csomagért felelős elkedzte #{$a->id} {$a->subject} fordításának ellenőrzését.

További részletek: {$a->url}.';
$string['emailreviewsubject'] = '[leadott AMOS-fordítás] ellenőrzés elkezdődött';
$string['err_exception'] = 'Hiba: {$a}';
$string['err_invalidlangcode'] = 'Érvénytelen nyelvkód';
$string['err_parser'] = 'Feldolgozási hiba: {$a}';
$string['filtercmp'] = 'Összetevők';
$string['filtercmp_desc'] = 'Ezen összetevők szövegeinek megjelenítése';
$string['filterlng'] = 'Nyelvek';
$string['filterlng_desc'] = 'Fordítások megjelenítése ezeken a nyelveken';
$string['filtermis'] = 'Egyéb';
$string['filtermis_desc'] = 'A megjelenítendő szövegekre vonatkozó egyéb megszorítások';
$string['filtermisfglo'] = 'csak az elavult szövegek';
$string['filtermisfhlp'] = 'csak a súgó szövegei';
$string['filtermisfmis'] = 'csak a hiányzó és az elavult szövegek';
$string['filtermisfstg'] = 'csak a tárolóba helyezett szövegek';
$string['filtermisfwog'] = 'az elavult szövegek nélkül';
$string['filtersid'] = 'Szöveg azonosítója';
$string['filtersid_desc'] = 'A szövegtömb kulcsa';
$string['filtersidpartial'] = 'részleges egyezés';
$string['filtertxt'] = 'Részszöveg';
$string['filtertxt_desc'] = 'A szövegben előforduló szövegrész';
$string['filtertxtcasesensitive'] = 'betűérzékeny';
$string['filtertxtregex'] = 'reguláris kifejezés';
$string['filterver'] = 'Verziók';
$string['filterver_desc'] = 'Ezen Moodle-verziók szövegeinek megjelenítése';
$string['found'] = 'Összesen: {$a->found} &nbsp;&nbsp;&nbsp; Hiányzik: {$a->missing} ({$a->missingonpage})';
$string['foundinfo'] = 'Összes szöveg';
$string['foundinfo_help'] = 'Megmutatja a fordítói táblázat sorainak számát, a hiányzó fordítások számát, valamint az adott oldalon előforduló, hiányzó fordítások számát,';
$string['gotofirst'] = 'áttérés ez első oldalra';
$string['gotoprevious'] = 'áttérés ez előző oldalra';
$string['greylisted'] = 'Elavult szövegek';
$string['greylisted_help'] = 'Korábbi fejlesztések miatt előfordul, hogy a Moodle nyelvi csomagjában használaton kívüli, de még nem törölt szövegek fordulnak elő. Ezek az \'elavult\' szövegek. Amikor egy elavult szövegről kiderül, hogy biztosan nincs rá szükség, akkor kikerül a nyelvi csomagból.
Ha olyan elavult szöveget talál, amely továbbra is megjelenik a Moodle--ban küldjön erről egy üzenetet a Translating Moodle fórumra. Az elavult szövegek kihagyásával számottevő fordítási időt takaríthat meg.';
$string['greylistedwarning'] = 'a szöveg elavult';
$string['importfile'] = 'Lefordított szövegek importálása állományból';
$string['importfile_help'] = 'Ha offline fordít szövegeket, ezzel az űrlappal helyezheti őket a szövegtárba.
Feltételek:
* Az állomány érvényes Moodle PHP szövegdefiníciós fájl legyen. Példákért tekintse meg a Moodle aktuális telepítésének \`/lang/en/\` könyvtárát.
* Az állomány neve ugyanaz legyen, mint az angol eredetié (pl. \`moodle.php\`, \`assignment.php\` vagy \`enrol_manual.php\`).
Az állományban szereplő összes szöveg bekerül az adott verzió és nyelv szövegtárába.';
$string['language'] = 'Nyelv';
$string['languages'] = 'Nyelvek';
$string['languagesall'] = 'Mind';
$string['languagesnone'] = 'Egy sem';
$string['log'] = 'Napló';
$string['logfilterbranch'] = 'Verziók';
$string['logfiltercommithash'] = 'bemenő tömb';
$string['logfiltercommitmsg'] = 'A rögzítéshez fűzött üzenet tartalma';
$string['logfiltercommits'] = 'A rögzítés szűrője';
$string['logfiltercommittedafter'] = 'Rögzítés ez után';
$string['logfiltercommittedbefore'] = 'Rögzítés ez előtt';
$string['logfiltercomponent'] = 'Összetevők';
$string['logfilterlang'] = 'Nyelvek';
$string['logfiltershow'] = 'Szűrt rögzítések és szövegek megjelenítése';
$string['logfiltersource'] = 'Forrás';
$string['logfiltersourceamos'] = 'amos (webalapú fordító)';
$string['logfiltersourcebot'] = 'bot (programkód ömlesztett műveletsora)';
$string['logfiltersourcecommitscript'] = 'commitscript (AMOScript a rögzítéshez fűzött üzenetben)';
$string['logfiltersourcefixdrift'] = 'fixdrift (rögzített AMOS-git drift)';
$string['logfiltersourcegit'] = 'git (a Moodle forráskódjának és az 1.x csomagoknak a git tükrözése)';
$string['logfiltersourcerevclean'] = 'revclean (fordított törlési folyamat)';
$string['logfilterstringid'] = 'Szövegazonosító';
$string['logfilterstrings'] = 'Szövegszűrő';
$string['logfilterusergrp'] = 'Rögzítésre leadó személy';
$string['logfilterusergrpor'] = 'vagy';
$string['maintainers'] = 'Felelős';
$string['markuptodate'] = 'A fordítás megjelölése elfogadottként';
$string['markuptodate_help'] = 'Az AMOS szerint a szöveg elavult lehet, mert az angol szöveget később módosították. Ellenőrizze a fordítást. Ha elfogadja, jelölje be a négyzetet. Ellenkező esetben szerkessze át.';
$string['merge'] = 'Egyesítés';
$string['mergestrings'] = 'Egyesítés másik területről való szöveggel';
$string['mergestrings_help'] = 'Ezzel az forrásterületről származó, le nem fordított szövegek a célterület szövegtárába kerülnek át. Az eszközzel a lefordított szöveget a csomag összes verziójába átmásolhatja. Az eszközt csak a nyelvi csomagért felelős fordítók használhatják.';
$string['newlanguage'] = 'Új nyelv';
$string['nodiffs'] = 'Nincs eltérés';
$string['nofiletoimport'] = 'Adja meg az importálandó állományt.';
$string['nologsfound'] = 'Nincs ilyen szöveg, módosítsa a szűrőt.';
$string['nostringsfound'] = 'Nincs ilyen szöveg';
$string['nostringsfoundonpage'] = 'Nincs szöveg a(z) {$a] oldalon';
$string['nostringtoimport'] = 'Az állományban nincs érvényes szöveg. Ellenőrizze a fájl nevét és formátumát.';
$string['nothingtomerge'] = 'A forrásterületen nincs új, a célterületről hiányzó, egyesítendő szöveg.';
$string['nothingtostage'] = 'A művelet nem adott vissza szövegtárba helyezhető szöveget.';
$string['numofcommitsabovelimit'] = '{$a->found} leadott szöveg felel meg a szűrőnek, {$a->limit} a legfrissebb';
$string['numofcommitsunderlimit'] = '{$a->found} leadott szöveg felel meg a szűrőnek.';
$string['numofmatchingstrings'] = '{$a->commits} módosítása közül {$a->strings}  felel meg a szövegszűrőnek';
$string['outdatednotcommitted'] = 'Elavult szöveg';
$string['outdatednotcommitted_help'] = 'Az AMOS szerint a szöveg elavult lehet, mert az angol szöveget később módosították. Ellenőrizze a fordítást.';
$string['outdatednotcommittedwarning'] = 'elavult';
$string['ownstashactions'] = 'Gyűjtőfájlhoz tartozó tevékenységek';
$string['ownstashactions_help'] = '* Alkalmaz - a gyűjtőfájlból a szövegtárba másolja a lefordított szövegeket, a gyűjtőfájl nem módosul. A meglévőket felülírja.
* Átvisz - a gyűjtőfájlból a szövegtárba helyezi át a lefordított szövegeket vagyis Alkalmaz és Elvet).
* Elvet - elveti az összes szövegtárba helyezett szöveget.
* Lead - megnyit egy űrlapot, amelyen a szövegtár benyújtható a nyelvi csomagért felelős fordítóhoz.';
$string['ownstashes'] = 'Az Ön gyűjtőfájljai';
$string['ownstashes_help'] = 'Az Ön gyűjtőfájljainak listája';
$string['ownstashesnone'] = 'Nincs gyűjtőfájlja';
$string['permalink'] = 'permalink';
$string['placeholder'] = 'Helyőrző';
$string['placeholder_help'] = 'A helyőrző a szövegben megjelenő utasítás, például: \`{$a}\` vagy \`{$a->valami}\`. A szöveg megjelenésekor a helyére érték kerül.
Ezeket a fordításban meg kell őrizni.';
$string['placeholderwarning'] = 'a szöveg helyőrzőt tartalmaz';
$string['pluginclasscore'] = 'Alapvető alrendszerek';
$string['pluginclassnonstandard'] = 'Nem szabványos segédprogramok';
$string['pluginclassstandard'] = 'Szabványos segédprogramok';
$string['pluginname'] = 'AMOS';
$string['presetcommitmessage'] = '{$a->author} által leadott #{$a->id} fordítás';
$string['presetcommitmessage2'] = '{$a->source} hiányzó szövegeinek egyesítése {$a->target} verzióval';
$string['presetcommitmessage3'] = 'A {$a->versiona} és {$a->versionb} verziók közötti eltérés kiküszöbölése';
$string['privileges'] = 'Jogosultságai';
$string['privilegesnone'] = 'A nyilvános információhoz csak olvasási jogosultsággal rendelkezik';
$string['propagate'] = 'Fordítások átvitele';
$string['propagate_help'] = 'A szövegtárban lévő fordításokat átviheti a kiválasztott fejlesztési verziókba. Az AMOS végigmegy a szövegtárban lévő fordításokon és megpróbálja átemelni őket a kiválasztott fejlesztési verziókba. Az átvitel nem hajtható végre, ha:
* a szöveg angol eredetije a forrásverzióban és a célverzióban eltér;
* a szöveg többször, más-más fordítással került a szövegtárba.';
$string['propagatednone'] = 'Nem került sor fordítások átvitelére';
$string['propagatedsome'] = '{$a} szövegtárban lévő fordítás átvitelére került sor.';
$string['propagaterun'] = 'Átvitel';
$string['requestactions'] = 'Tevékenység';
$string['requestactions_help'] = '* Alkalmaz - a lefordított szövegeket átmásolja a szövegtárba. A meglévőt felülírja.
* Elrejt - az átmásolandó szöveget elrejti.';
$string['savefilter'] = 'Szűrőbeállítások mentése';
$string['script'] = 'AMOScript';
$string['script_help'] = 'Az AMOScript a szövegtárolón végrehajtandó műveletek utasításainak készlete';
$string['scriptexecute'] = 'Végrehajtás és az eredmény szövegtárba helyezése';
$string['sourceversion'] = 'Forrásverzió';
$string['stage'] = 'Szövegtár';
$string['stageactions'] = 'Szövegtárhoz kapcsolódó tevékenységek';
$string['stageactions_help'] = '* Szövegtárba helyezett szöveg szerkesztése - módosítja a fordító szűrőbeállításait, így csak a szövegtárba helyezett szövegek lesznek láthatók.
* Nem rögzíthető szövegek eltávolítása - kiveszi a szövegtárból azokat a szövegeket, amelyek rögzítésére nincs jogosultsága. A szövegtár rögzítés előtt automatikusan kiürül.
* Frissítés - kiveszi a szövegtárból azokat a szövegeket, amelyek vagy nem változtak, vagy régebbiek az adattárban lévőknél. A szövegtár rögzítés előtt automatikusan frissítődik.
* Szövegtár ürítése - törli a szövegtárat, a szövegtárba leadott fordítások elvesznek.';
$string['stageedit'] = 'A szövegtár szerkesztése';
$string['stagelang'] = 'Nyelv';
$string['stageoriginal'] = 'Eredeti';
$string['stageprune'] = 'Nem rögzíthető szövegek eltávolítása';
$string['stagerebase'] = 'Frissítés';
$string['stagestring'] = 'Szöveg';
$string['stagestringsnocommit'] = 'A szövegtár {$a->staged} szöveget tartalmaz';
$string['stagestringsnone'] = 'A szövegtár nem tartalmaz szöveget';
$string['stagestringssome'] = 'A szövegtár {$a->staged} szöveget tartalmaz, ebből {$a->committable} a rögzíthető';
$string['stagesubmit'] = 'Leadás a fordításért felelős személynek';
$string['stagetranslation'] = 'Fordítás';
$string['stagetranslation_help'] = 'Megjeleníti a rögzítendő, szövegtárban lévő fordítást. A cella háttérszínének jelentése:
* Zöld - hozzáadott egy hiányzó fordítást, és most rögzítheti.
* Sárga - módosított egy szöveget, és most rögzítheti a változtatást.
* Kék - módosította a szöveget vagy hozzáadott egy hiányzó fordítást, de nem rögzítheti.
* Nincs szín - a szövegtárban lévő fordítás azonos a jelenlegivel, ezért rögzítésére nem kerül sor.';
$string['stageunstageall'] = 'Szövegtár ürítése';
$string['stashactions'] = 'Gyűjtőfájllal kapcsolatos tevékenységek';
$string['stashactions_help'] = 'A gyűjtőfájl az adott szövegtárat tükrözi. A gyűjtőfájlokat a nyelvi csomagba való integráláshoz le lehet adni a fordításért felelős személynek';
$string['stashapply'] = 'Alkalmaz';
$string['stashautosave'] = 'Automatikusan elmentett biztonsági gyűjtőfájl';
$string['stashautosave_help'] = 'Ez a gyűjtőfájl tartalmazza az adott szövegtár legfrissebb változatát. Biztonsági mentésként használhatja, ha pl. véletlenül törlődnek a szövegtárban lévő szövegek. Az \'Alkalmaz\' visszamásolja a gyűjtőfájlban lévő szövegeket a szövegtárba (az ott lévőket felülírja).';
$string['stashcomponents'] = '<span>Összetevők:</span> {$a}';
$string['stashdrop'] = 'Elvet';
$string['stashes'] = 'Gyűjtőfájlok';
$string['stashlanguages'] = '<span>Nyelvek:</span> {$a}';
$string['stashpop'] = 'Áthelyez';
$string['stashpush'] = 'A szövegtárban lévő szövegeket új gyűjtőfájlba helyezi át';
$string['stashstrings'] = '<span>Szövegek száma:</span> {$a}';
$string['stashsubmit'] = 'Benyújtás a fordításért felelős személynek';
$string['stashsubmitdetails'] = 'Benyújtás adatai';
$string['stashsubmitmessage'] = 'Üzenet';
$string['stashsubmitsubject'] = 'Tárgy';
$string['stashtitle'] = 'Gyűjtőfájl neve';
$string['stashtitledefault'] = 'WIP - {$a->time}';
$string['stringhistory'] = 'Előzmény';
$string['strings'] = 'Szövegek';
$string['submitting'] = 'Fordítás leadása';
$string['submitting_help'] = 'Elküldi a lefordított szövegeket a fordításért felelős személynek, aki beépíti azt a nyelvi csomagba. Az üzenetben tájékoztathatja őt a munka részleteiről és arról, miért szeretné a fordítását a nyelvi csomagba beépíteni.';
$string['targetversion'] = 'Célnyelvi változat';
$string['translatorlang'] = 'Nyelv';
$string['translatorlang_help'] = 'Megjeleníti a célnyelvi szöveg nyelvkódját. A **+-**-ra kattintva megtekintheti az adott szöveg időbeli alakulását.';
$string['translatororiginal'] = 'Eredeti';
$string['translatororiginal_help'] = 'Megjeleníti az eredeti angol szöveget. Alatta van egy ugrópont, amellyel a szöveget automatikusan lefordíthatja a Google Translate segítségével (ha a böngészője támogatja ezt, és be van kapcsolva a javascript).Emellett alul megjelenhetnek egyéb információk is, pl. az, hogy a szöveg helyőrzőt tartalmaz.';
$string['translatorstring'] = 'Szöveg';
$string['translatorstring_help'] = 'Megjeleníti a Moodle verzióját (változatát), a szövegazonosítót és az összetevőt, amelyhez a szöveg tartozik.';
$string['translatortool'] = 'Fordító';
$string['translatortranslation'] = 'Fordítás';
$string['translatortranslation_help'] = 'A szerkesztő megnyitásához kattintson a cellára. Írja be a fordítást, a fordítás szövegtárba helyezéséhez kattintson a cellán kívül. A cella háttérszínének jelentése:
* Zöld - a szöveg már le van fordítva, de a fordítást módosíthatjha.
* Sárga - a szöveg elavult lehet . Az angol változat módosulhatott a szöveg lefordítása után.
* Piros - a szöveg nincs lefordítva.
* Kék - módosította a fordítást, és az a szövegtárba került.
* Szürke - Az AMOS-szal nem fordítható. Például a korábbi 19.es Moodle szövegeit csak a korábbi CVS-en keresztül lehet szerkeszteni.
A nyelvi csomagot kezelők a leadható szövegek cellájának sarkában egy kis piros jelet látnak..';
$string['typecontrib'] = 'Nem szabványos segédprogramok';
$string['typecore'] = 'Alapvető alrendszerek';
$string['typestandard'] = 'Szabványos segédprogramok';
$string['unstage'] = 'Nem helyezi szövegtárba';
$string['unstageconfirm'] = 'Biztos?';
$string['unstaging'] = 'Nem helyezi szövegtárba';
$string['version'] = 'Verzió';
