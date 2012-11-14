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
 * Strings for component 'portfolio', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activeexport'] = 'Aktív exportálás feloldása';
$string['activeportfolios'] = 'Aktív portfóliók';
$string['addalltoportfolio'] = 'Az összes portfólióba exportálása';
$string['addnewportfolio'] = 'Új portfólió hozzáadása';
$string['addtoportfolio'] = 'Exportálás portfóióba';
$string['alreadyalt'] = 'Az exportálás már folyamatban van - kattintson ide az átvitel feloldásához.';
$string['alreadyexporting'] = 'Ebben a folyamatban már van aktív portfólió-exportálása. Előbb fejezze be vagy érvénytelenítse. Folytatja? (A Nem érvényteleníti).';
$string['availableformats'] = 'Használható exportálási formátumok';
$string['callbackclassinvalid'] = 'A megadott visszahívási osztály érvénytelen vagy nem része a portfolio_caller hierarchiának';
$string['callercouldnotpackage'] = 'Adatait nem sikerült exportáláshoz összecsomagolni.';
$string['cannotsetvisible'] = 'Nem állítható láthatóra - téves beállítás miatt a segédprogram ki van iktatva.';
$string['commonportfoliosettings'] = 'Közös portfolió beállításaió';
$string['commonsettingsdesc'] = '<p>Az, hogy az átvitel \'mérsékelt\' vagy \'hosszú\' időt vesz-e igénybe, attól függ, hogy a felhasználó ki tudja-e várni, amíg az befejeződik.</p><p>A \'mérsékelt\' küszöbérték alatti átvitel a felhasználó megkérdezése nélkül végrehajtódik, \'mérsékelt\' és \'hosszú\' esetén lehetőségük van az átvitelre, de figyelmeztetést kapnak annak esetleg elhúzódó jellegéről.</p><p>Emellett egyes portfólió-segédprogramok figyelmen kívül hagyhatják a választási lehetőséget és előírhatják az összes átvitel beütemezését.</p>';
$string['configexport'] = 'Exportált adatok beállítása';
$string['configplugin'] = 'A portfólió segédprogramjának beállítása';
$string['configure'] = 'Beállítás';
$string['confirmcancel'] = 'Biztosan törli az exportálást?';
$string['confirmexport'] = 'Erősítse meg az exportálást.';
$string['confirmsummary'] = 'Exportálásának összegzése';
$string['continuetoportfolio'] = 'Áttérés a portfóliójára';
$string['deleteportfolio'] = 'A portfólió adott példányának törlése';
$string['destination'] = 'Cél';
$string['disabled'] = 'A portfólió-exportálás ezen a portálon nincs bekapcsolva.';
$string['disabledinstance'] = 'Kikapcsolva';
$string['displayarea'] = 'Az exportálás területe';
$string['displayexpiry'] = 'Átvitel lejárata';
$string['displayinfo'] = 'Exportálási adatok';
$string['dontwait'] = 'Ne várjon!';
$string['enabled'] = 'Portfóliók bekapcsolása';
$string['enableddesc'] = 'Ezzel engedélyezi rendszergazdák számára távoli rendszerek beállítását úgy, hogy oda felhasználók tartalmakat exportálhassanak.';
$string['err_uniquename'] = 'A portfólió nevének (segédprogramonként) egyedinek kell lenni.';
$string['exportalreadyfinished'] = 'A portfólió exportálása véget ért!';
$string['exportalreadyfinisheddesc'] = 'A portfólió exportálása véget ért!';
$string['exportcomplete'] = 'A portfólió exportálása kész!';
$string['exportedpreviously'] = 'Korábbi exportálások';
$string['exportexceptionnoexporter'] = 'Aktív folyamat mellett portfolio_export_exception hiba jelentkezett, de nem volt exportált objektum';
$string['exportexpired'] = 'A portfólió exportálása lejárt.';
$string['exportexpireddesc'] = 'Valamilyen adatok exportálásának megismétlésével vagy üres exportálással próbálkozott. Ennek helyes végrehajtásához térjen vissza az eredeti helyre és kezdjen neki újból. Ilyesmi előfordul, ha egy exportálás után a Vissza gombot használja, vagy ha érvénytelen URL-t jelöl meg könyvjelzőnek.';
$string['exporting'] = 'Exportálás portfólióba';
$string['exportingcontentfrom'] = 'Tartalom exportáláss innen: {$a}.';
$string['exportingcontentto'] = 'Tartalom exportálása ide: {$a}';
$string['exportqueued'] = 'A portfólió exportálása átvitelhez sikeresen beütemezve.';
$string['exportqueuedforced'] = 'A portfólió exportálása átvitelhez sikeresen beütemezve (a távoli rendszer elindította a beütemezett átviteleket).';
$string['failedtopackage'] = 'Nincs csomagolandó állomány.';
$string['failedtosendpackage'] = 'Adatait nem lehetetett a kiválasztott portfóliórendszerbe küldeni!';
$string['filedenied'] = 'Ezen állományhoz a hozzáférés megtagadva.';
$string['filenotfound'] = 'Nem található az állomány';
$string['fileoutputnotsupported'] = 'Ez a forma nem támogatja az állománykimenet újraírását.';
$string['format_document'] = 'Dokumentum';
$string['format_file'] = 'Állomány';
$string['format_image'] = 'Kép';
$string['format_leap2a'] = 'LEAP2A típusú portfólió';
$string['format_mbkp'] = 'Moodle biztonsági mentés formátuma';
$string['format_pdf'] = 'PDF';
$string['format_plainhtml'] = 'HTML';
$string['format_presentation'] = 'Bemutató';
$string['format_richhtml'] = 'HTML csatolt melléklettel';
$string['format_spreadsheet'] = 'Számolótábla';
$string['format_text'] = 'Egyszerű szöveg';
$string['format_video'] = 'Videó';
$string['hidden'] = 'Rejtett';
$string['highdbsizethreshold'] = 'Hosszú adatbázis-átvitel';
$string['highdbsizethresholddesc'] = 'Azon adatbázisrekordok száma, mely fölött az átvitel hosszúnak minősül';
$string['highfilesizethreshold'] = 'Hosszú állományátvitel';
$string['highfilesizethresholddesc'] = 'Az az állományméret, amely fölött az átvitel hosszúnak minősül';
$string['insanebody'] = 'Jó napot! Ezt az üzenetet a(z) {$a->sitename} rendszergazdájaként kapja.
Hibás beállítás miatt néhány portfólió-segédprogram automatikusan ki lett kapcsolva. Ezekbe a portfóliókba a felhasználók most nem exportálhatnak tartalmat. A kikapcsolt portfólió-segédprogramok:
{$a->textlist}
Ezt mielőbb ki kell javítani, ehhez látogasson el ide: {$a->fixurl}.';
$string['insanebodyhtml'] = '<p>Jó napot! Ezt az üzenetet a(z) {$a->sitename} rendszergazdájaként kapja.</p>
{$a->htmllist}
<p>Ezt mielőbb ki kell javítani, ehhez látogasson el <a href="{$a->fixurl}">a portfólióbeállítási oldalakra</a>.</p>';
$string['insanebodysmall'] = 'Jó napot! Ezt az üzenetet a(z) {$a->sitename} rendszergazdájaként kapja.
Hibás beállítás miatt néhány portfólió-segédprogram automatikusan ki lett kapcsolva. Ezekbe a portfóliókba a felhasználók most nem exportálhatnak tartalmat. Ezt mielőbb ki kell javítani, ehhez látogasson el ide: {$a->fixurl}.';
$string['insanesubject'] = 'Néhány portfólió-segédprogram automatikusan ki lett kapcsolva.';
$string['instancedeleted'] = 'A portfólió törlése sikerült.';
$string['instanceismisconfigured'] = 'Az adott portfólió tévesen van beállítva, kihagyva. A hiba: {$a}.';
$string['instancenotdelete'] = 'A portfólió törlése nem sikerült.';
$string['instancenotsaved'] = 'A portfólió mentése nem sikerült.';
$string['instancesaved'] = 'A portfólió mentése sikerült.';
$string['invalidaddformat'] = 'A portfolio_add_button érvénytelen formátumú adatot kapott. ({$a}) PORTFOLIO_ADD_XXX típusúnak kell lennie.';
$string['invalidbuttonproperty'] = 'Nincs meg a portfolio_button tulajdonsága ({$a})';
$string['invalidconfigproperty'] = 'Nem található a beállítási tulajdonság ({$a->property} / {$a->class}).';
$string['invalidexportproperty'] = 'Nem található az exportálás-beállítási tulajdonság ({$a->property} / {$a->class})';
$string['invalidfileareaargs'] = 'Érvénytelen állományterületre vonatkozó argumentumokat kapott a set_file_and_format_data - elengedhetetlen részei a contextid, a component, a filearea és az itemid.';
$string['invalidformat'] = 'Valaminek az exportálása érvénytelen formátumban történik: {$a}.';
$string['invalidinstance'] = 'Az adott portfólió nem található.';
$string['invalidpreparepackagefile'] = 'Érvénytelen eljáráshívás prepare_package_file esetén: vagy egy, vagy több állományt kell beállítani.';
$string['invalidproperty'] = 'Az adott tulajdonság nem található ({$a->property} / {$a->class}).';
$string['invalidsha1file'] = 'Érvénytelen eljáráshívás get_sha1_file : vagy egy, vagy több állományt kell beállítani.';
$string['invalidtempid'] = 'Érvénytelen exportálási azonosító. Lehet, hogy lejárt.';
$string['invaliduserproperty'] = 'Nem található a felhasználó-beállítási tulajdonság ({$a->property} / {$a->class})';
$string['leap2a_emptyselection'] = 'Nincs kiválasztva előírt érték';
$string['leap2a_entryalreadyexists'] = 'Olyan azonosítójú ({$a}) Leap2A bejegyzést próbált hozzáadni, amely már létezik ebben a hírben';
$string['leap2a_feedtitle'] = 'Leap2A exportálása Moodle alól {$a} részére';
$string['leap2a_filecontent'] = 'Leap2A bejegyzés tartalmát próbálta egy állományba beállítani ahelyett, hogy annak alosztályát használta volna';
$string['leap2a_invalidentryfield'] = 'Nem létező vagy közvetlenül nem beállítható bejegyzésmezőt ({$a}) próbált beállítani';
$string['leap2a_invalidentryid'] = 'Nem létező  azonosítójú bejegyzést ({$a}) próbált elérni';
$string['leap2a_missingfield'] = 'Szükséges Leap2A {$a} bejegyzésmező hiányzik';
$string['leap2a_nonexistantlink'] = 'Egy Leap2A bejegyzés ({$a->from}) megpróbált egy nem létező ({$a->to}) bejegyzéshez {$a->rel} révén kapcsolódni';
$string['leap2a_overwritingselection'] = 'Egy bejegyzés ({$a}) eredeti típusának fölülírása a make_selection kiválasztásával';
$string['leap2a_selflink'] = 'Egy Leap2A bejegyzés ({$a->id}) megpróbált önmagához {$a->rel} révén kapcsolódni';
$string['logs'] = 'Átviteli naplók';
$string['logsummary'] = 'Korábbi sikeres átvitelek';
$string['manageportfolios'] = 'Portfóliók kezelése';
$string['manageyourportfolios'] = 'Portfólióinak kezelése';
$string['mimecheckfail'] = 'A beépülő {$a->plugin} portfólió-segédprogram nem támogatja a(z) {$a->mimetype} mime-típust';
$string['missingcallbackarg'] = 'Hiányzó visszahívási {$a->arg} argumentum {$a->class} osztály esetén';
$string['moderatedbsizethreshold'] = 'Mérsékelt méretű átviteli adatbázis';
$string['moderatedbsizethresholddesc'] = 'Azon adatbázisrekordok száma, mely fölött az átvitel mérsékelten hosszúnak minősül';
$string['moderatefilesizethreshold'] = 'Mérsékelt méretű átviteli állomány';
$string['moderatefilesizethresholddesc'] = 'Azon állományméret, amely fölött az átvitel mérsékelten hosszúnak minősül';
$string['multipleinstancesdisallowed'] = 'Próbáljon új példányt létrehozni azon beépülő segédprogramból, amely a több példányt ({$a}) nem engedélyezte.';
$string['mustsetcallbackoptions'] = 'A visszahívási opciókat be kell állítania a portfolio_add_button konstruktorban, vagy használnia kell a set_callback_options metódust.';
$string['noavailableplugins'] = 'Az exportáláshoz nincs portfóliója.';
$string['nocallbackclass'] = 'Nincs meg a használandó visszahívási osztály ({$a})';
$string['nocallbackfile'] = 'Az exportáláshoz használt modulban valami hibás - nincs meg a szükséges állomány ({$a}).';
$string['noclassbeforeformats'] = 'Állítsa be a visszahívási osztályt, mielőtt meghívja a portfolio_button alatt a set_formats eljárást.';
$string['nocommonformats'] = 'A létező portfólió-segédprogramok és a {$a->location} forráshely formátumai nem egyeznek (támogatott formátumok: {$a->formats}).';
$string['noinstanceyet'] = 'Nincs kiválasztva';
$string['nologs'] = 'Nincs megjeleníthető napló!';
$string['nomultipleexports'] = 'A portfólió segédprogramja ({$a->plugin}) nem támogatja egyszerre több exportálás végrehajtását. Előbb <a href="{$a->link}">fejezze be a mostanit</a>, majd próbálja meg újra.';
$string['nonprimative'] = 'A portfolio_add_button visszatérő argumentumként nem primitív értéket kapott. Folytatás elutasítva. A kulcs {$a->key}, az érték {$a->value} volt.';
$string['nopermissions'] = 'Nincs engedélye ezen területről állományok exportálásához.';
$string['notexportable'] = 'Az exportálni kívánt tartalom nem exportálható.';
$string['notimplemented'] = 'Az exportálandó tartalom formátuma még nem használható ({$a}).';
$string['notyetselected'] = 'Még nincs kiválasztva';
$string['notyours'] = 'Olyan portfólió exportálását próbálja újraindítani, amely nem az Öné!';
$string['nouploaddirectory'] = 'Nem lehetett létrehozni ideiglenes könyvtárat adatainak elhelyezéséhez.';
$string['off'] = 'Bekapcsolva, de rejtett';
$string['on'] = 'Bekapcsolva és látható';
$string['plugin'] = 'Portfólió-segédprogram';
$string['plugincouldnotpackage'] = 'Nem sikerült adatait exportáláshoz becsomagolni.';
$string['pluginismisconfigured'] = 'A portfólió-segédprogram beállítása hibás, kihagyva. A hiba: {$a}.';
$string['portfolio'] = 'Portfólió';
$string['portfolios'] = 'Portfóliók';
$string['queuesummary'] = 'Jelenleg beütemezett átvitelek';
$string['returntowhereyouwere'] = 'Vissza a korábbi pontra';
$string['save'] = 'Mentés';
$string['selectedformat'] = 'Kiválasztott exportálási formátum';
$string['selectedwait'] = 'Úgy döntött, hogy várakozik?';
$string['selectplugin'] = 'Portfólió-segédprogram kiválasztása exportáláshoz';
$string['singleinstancenomultiallowed'] = 'Csak egy példányban áll rendelkezésre a portfólió-segédprogram, és nem támogatja folyamatonként egyszerre több exportálás végrehajtását, a mostani folyamatban pedig már zajlik egy exportálás ezzel a segédprogrammal!';
$string['somepluginsdisabled'] = 'Egyes portfólió-segédprogramok ki vannak kapcsolva hibás beállítás miatt, vagy mert egyébre támaszkodnak, ami:';
$string['sure'] = 'Biztosan törlendő a(z) \'{$a}\'? Visszaállítására nem lesz mód.';
$string['thirdpartyexception'] = 'Külső kivételhiba történt a portfólió exportálása közben ({$a}). A hibát sikerült most kiküszöbölni, de gondoskodjon teljes elhárításáról.';
$string['transfertime'] = 'Átviteli idő';
$string['unknownplugin'] = 'Ismeretlen (esetleg a rendszergazda idő közben eltávolította)';
$string['wait'] = 'Várakozás';
$string['wanttowait_high'] = 'Nem ajánlott az átvitel végét kivárni, de megteheti, ha bizonyosan tudja, mit tesz voltaképpen.';
$string['wanttowait_moderate'] = 'Kivárja az átvitel végét? Ez percekig is eltarthat.';
