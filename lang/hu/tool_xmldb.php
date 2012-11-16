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
 * Strings for component 'tool_xmldb', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_xmldb
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actual'] = 'Aktuális';
$string['aftertable'] = 'Táblázat után:';
$string['back'] = 'Vissza';
$string['backtomainview'] = 'Vissza a fő oldalra';
$string['binaryincorrectlength'] = 'Hibás hossz a bináris mezőnél';
$string['cannotuseidfield'] = 'Nem szúrható be az "id" mező. Ez egy automatikusan számozott oszlop';
$string['change'] = 'Módosítás';
$string['charincorrectlength'] = 'Hibás hossz a karaktermezőnél';
$string['check_bigints'] = 'Hibás egész számok keresése az adatbázisban';
$string['check_defaults'] = 'Nem egyező alapértékek keresése';
$string['check_foreign_keys'] = 'Külső kulcs miatti hiba keresése';
$string['check_indexes'] = 'Hiányzó adatbázisindexek keresése';
$string['check_oracle_semantics'] = 'Hibás hosszúságú szemantika ellenőrzése';
$string['checkbigints'] = 'Nagy egész számok ellenőrzése';
$string['checkdefaults'] = 'Alapbeállítások  ellenőrzése';
$string['checkforeignkeys'] = 'Külső kulcsok ellenőrzése';
$string['checkindexes'] = 'Indexek ellenőrzése';
$string['checkoraclesemantics'] = 'Szemantika ellenőrzése';
$string['completelogbelow'] = '(a keresés teljes naplózását lásd alább)';
$string['confirmcheckbigints'] = 'Ez a funkció <a href="http://tracker.moodle.org/browse/MDL-11038">esetlegesen hibás számjegymezőket fog vizsgálni</a> Moodle-szerverén, és automatikusan előállítja (de nem futtatja le!) azokat az SQL-parancsokat, amelyekkel ellenőrizheti, hogy adatbázisában minden egész számot helyesen definiált-e. Amikor a parancsok előálltak, a parancsokat átmásolhatja és biztonságosan lefuttathatja kedvenc SQL-interfészén (előtte azonban készítsen róluk biztonsági mentést). Ajánlatos a Moodle legfrissebb kiadását (1.8, 1.9, 2.x ...) használni a hibás egész számok kikeresése előtt. Ez a funkció semmilyen tevékenységet nem hajt végre az adatbázison (csak beolvassa), ezért bármikor biztonságosan futtatható.';
$string['confirmcheckdefaults'] = 'Ezzel nem egyező alapértékekre kereshet rá Moodle-szerverén, automatikusan előállíthatja (de nem hajthatja végre!) a frissítéshez szükséges SQL-utasításokat.<br /><br />Ha elkészültek, az utasításokat kimásolhatja és biztonságosan végrehajthatja kedvenc SQL-felületén. <br /><br />Mindenképpen ajánlott a legfrissebb Moodle-változatot (1.8, 1.9, 2.x ...) használni a nem egyező alapértékekre keresés előtt.<br /><br />Ennek során az adatbázison nem hajtódnak végre műveletek (csak beolvasás történik), így bármikor biztonságosan végrehajtható.';
$string['confirmcheckforeignkeys'] = 'Ezzel az install.xml meghatározásaiban lévő külső kulcsok esetleges érvénytelenségére kereshet rá. (A Moodle jelenleg nem állít elő az adatbázisban idegen kulcsokra vonatkozó megszorításokat, ezért fordulhatnak elő érvénytelen adatok.)<br /><br />
Mindenképpen ajánlott a legfrissebb Moodle-változatot (1.8, 1.9, 2.x ...) használni a hiányzó indexekre való keresés előtt.<br /><br />Ennek során az adatbázison nem hajtódnak végre műveletek (csak beolvasás történik), így bármikor biztonságosan végrehajtható.';
$string['confirmcheckindexes'] = 'Ezzel esetleg hiányzó indexekre kereshet rá Moodle-szerverén, automatikusan előállíthatja (de nem hajthatja végre!) a frissítéshez szükséges SQL-utasításokat. Ha elkészültek, az utasításokat kimásolhatja és biztonságosan végrehajthatja kedvenc SQL-felületén. Mindenképpen ajánlott a legfrissebb Moodle-változatot (1.8, 1.9, 2.x ...) használni a hiányzó indexekre keresés előtt. Ennek során az adatbázison nem hajtódnak végre műveletek (csak beolvasás történik), így bármikor biztonságosan végrehajtható.';
$string['confirmcheckoraclesemantics'] = 'Ezzel <a href="http://tracker.moodle.org/browse/MDL-29322">BYTE-szemantikát használó Oracle varchar2 oszlopokra</a> kereshet rá Moodle-szerverén, automatikusan előállíthatja (de nem hajthatja végre!) az oszlopok átalakításához szükséges SQL-utasításokat a CHAR-szemantika használatához (ami megfelelőbb az adatbázisok kompatibilitása és a hosszabb tartalom maximális hossza szempontjából).


Ha elkészültek, az utasításokat kimásolhatja és biztonságosan végrehajthatja kedvenc SQL-felületén (előtte ne felejtsen el biztonsági másolatot készíteni róluk).

Mindenképpen ajánlott a legfrissebb Moodle-változatot 2.2, 2.3, 2.x ...) használni a BYTE-szemantikás keresés előtt.

Ennek során az adatbázison nem hajtódnak végre műveletek (csak beolvasás történik), így bármikor biztonságosan végrehajtható.';
$string['confirmdeletefield'] = 'Biztosan törölni akarja ezt a mezőt:';
$string['confirmdeleteindex'] = 'Biztosan törölni akarja ezt az indexet:';
$string['confirmdeletekey'] = 'Biztosan törölni akarja ezt a kulcsot:';
$string['confirmdeletetable'] = 'Biztosan törölni akarja ezt a táblázatot:';
$string['confirmdeletexmlfile'] = 'Biztosan törölni akarja ezt az állományt:';
$string['confirmrevertchanges'] = 'Biztosan vissza akarja állítani az ezen végrehajtott változtatásokat:';
$string['create'] = 'Létrehozás';
$string['createtable'] = 'Táblázat létrehozása:';
$string['defaultincorrect'] = 'Hibás alapbeállítás';
$string['delete'] = 'Törlés';
$string['delete_field'] = 'Mező törlése';
$string['delete_index'] = 'Index törlése';
$string['delete_key'] = 'Kulcs törlése';
$string['delete_table'] = 'Táblázat törlése';
$string['delete_xml_file'] = 'XML-állomány törlése';
$string['doc'] = 'Dokumentum';
$string['docindex'] = 'Index a dokumentációhoz:';
$string['documentationintro'] = 'A dokumentáció az XMLDB-adatbázis definíciójából automatikusan áll elő. Csak angol nyelven érhető el.';
$string['down'] = 'Le';
$string['duplicate'] = 'Másodpéldány';
$string['duplicatefieldname'] = 'Ezzel a névvel már szerepel mező';
$string['duplicatefieldsused'] = 'Ismétlődő mezők fordulnak elő';
$string['duplicatekeyname'] = 'Ezzel a névvel már szerepel kulcs';
$string['duplicatetablename'] = 'Ezzel a névvel már szerepel táblázat';
$string['edit'] = 'Szerkesztés';
$string['edit_field'] = 'Mező szerkesztése';
$string['edit_field_save'] = 'Mező mentése';
$string['edit_index'] = 'Index szerkesztése';
$string['edit_index_save'] = 'Index mentése';
$string['edit_key'] = 'Kulcs szerkesztése';
$string['edit_key_save'] = 'Kulcs mentése';
$string['edit_table'] = 'Táblázat szerkesztése';
$string['edit_table_save'] = 'Táblázat mentése';
$string['edit_xml_file'] = 'XML-állomány szerkesztése';
$string['enumvaluesincorrect'] = 'Hibás értékek felsoroló mezőhöz';
$string['expected'] = 'Kitöltendő';
$string['extensionrequired'] = 'Ehhez  \'{$a}\' PHP-bővítményre van szükség. Telepítse, ha használni kívánja.';
$string['field'] = 'Mező';
$string['fieldnameempty'] = 'Névmező üres';
$string['fields'] = 'Mezők';
$string['fieldsnotintable'] = 'A táblázatban nem szerepel a mező';
$string['fieldsusedinindex'] = 'A mező mutatóként szerepel';
$string['fieldsusedinkey'] = 'Ez a mező kulcsként használatos.';
$string['filenotwriteable'] = 'Az állomány nem írható';
$string['fkviolationdetails'] = 'A(z) {$a->tablename} táblában a(z) {$a->keyname} külső kulcs hibája {$a->numrows} közül {$a->numviolations} alkalommal.';
$string['float2numbernote'] = 'Megjegyzés: noha az XMLDB 100%-ban támogatja a "lebegőszámos" mezőket, ajánlatos áttérni a "számjegyes" mezőkre.';
$string['floatincorrectdecimals'] = 'Hibás számú tizedes jegy a lebegőpontos mezőhöz';
$string['floatincorrectlength'] = 'Hibás hossz a lebegőpontos mezőhöz';
$string['generate_all_documentation'] = 'A teljes dokumentáció';
$string['generate_documentation'] = 'Dokumentáció';
$string['gotolastused'] = 'Áttérés az utoljára használt mezőre';
$string['incorrectfieldname'] = 'Hibás név';
$string['incorrectkeyname'] = 'Hibás kulcsnév';
$string['incorrecttablename'] = 'Hibás táblanév';
$string['index'] = 'Index';
$string['indexes'] = 'Indexek';
$string['integerincorrectlength'] = 'Hibás hossz az egészszám-mezőhöz';
$string['key'] = 'Kulcs';
$string['keynameempty'] = 'A kulcsnév nem lehet üres';
$string['keys'] = 'Kulcsok';
$string['listreservedwords'] = 'Fenntartott szavak felsorolása (a <a href="http://docs.moodle.org/en/XMLDB_reserved_words" target="_blank">XMLDB_reserved_words</a> frissítéséhez)';
$string['load'] = 'Betöltés';
$string['main_view'] = 'Fő nézet';
$string['masterprimaryuniqueordernomatch'] = 'Az idegen kulcsok mezőit ugyanabban a sorrendben kell felsorolni, mint a hivatkozott táblában szereplő UNIQUE KEY alatt.';
$string['missing'] = 'Hiányzik';
$string['missingindexes'] = 'Indexek hiányoznak';
$string['mustselectonefield'] = 'A mezőhöz kapcsolódó tevékenységek megtekintéséhez válasszon ki egy mezőt!';
$string['mustselectoneindex'] = 'Az indexhez kapcsolódó tevékenységek megtekintéséhez válasszon ki egy indexet!';
$string['mustselectonekey'] = 'A kulcsokhoz kapcsolódó tevékenységek megtekintéséhez válasszon ki egy kulcsot!';
$string['mysqlextracheckbigints'] = 'A MySQL alatt rákeres a helytelen előjelű nagy egész számokra is, így előállítja az összes kijavításához szükséges SQL-t.';
$string['new_table_from_mysql'] = 'Új táblázat MySQL-ből';
$string['newfield'] = 'Új mező';
$string['newindex'] = 'Új index';
$string['newkey'] = 'Új kulcs';
$string['newtable'] = 'Új táblázat';
$string['newtablefrommysql'] = 'Új MySQL-táblázat';
$string['nofieldsspecified'] = 'Nincs megadva mező';
$string['nomasterprimaryuniquefound'] = 'Az idegen kulcsok által hivatkozott oszlopo(ka)t a hivatkozott táblában szereplő elsődleges vagy egyedi kulcsnak tartalmaznia kell. Az, hogy az oszlop egyedi indexben szerepel, nem elegendő.';
$string['nomissingindexesfound'] = 'Nincsenek hiányzó indexek, adatbázisán nincs szükség egyéb művelet végrehajtására.';
$string['noreffieldsspecified'] = 'Nincs megadva referenciamező';
$string['noreftablespecified'] = 'Nincs meg a megadott referenciatábla.';
$string['noviolatedforeignkeysfound'] = 'Nincs külső kulcshoz kapcsolódó hiba';
$string['nowrongdefaultsfound'] = 'Nincsenek nem egyező alapértékek, adatbázisán semmi egyebet nem kell végrehajtani.';
$string['nowrongintsfound'] = 'Nincsenek hibás egész számok, adatbázisával nincs több teendő.';
$string['nowrongoraclesemanticsfound'] = 'Nincsenek BYTE-szemantikát használó Oracle-oszlopok, adatbázisával nincs több teendő.';
$string['numberincorrectdecimals'] = 'Hibás tizedes szám a számmezőhöz';
$string['numberincorrectlength'] = 'Hibás hossz a számmezőhöz';
$string['pendingchanges'] = 'Megjegyzés: módosította az állományt. Bármikor elmentheti.';
$string['pendingchangescannotbesaved'] = 'Módosította ugyan az állományt, de nem menthető el. Ellenőrizze, hogy a webszerver számára a könyvtár és benne az "install.xml" írható-e.';
$string['pendingchangescannotbesavedreload'] = 'Módosította ugyan az állományt, de nem menthető el. Ellenőrizze, hogy a webszerver számára a könyvtár és benne az "install.xml" írható-e. Ezután töltse be újra az oldalt és mentse el a módosításokat.';
$string['pluginname'] = 'XMLDB-szerkesztő';
$string['primarykeyonlyallownotnullfields'] = 'Az elsődleges kulcs nem lehet nulla.';
$string['reserved'] = 'Fenntartott';
$string['reservedwords'] = 'Fenntartott szavak';
$string['revert'] = 'Visszaállítás';
$string['revert_changes'] = 'Módosítások visszaállítása';
$string['save'] = 'Mentés';
$string['searchresults'] = 'Keresési eredmények';
$string['selectaction'] = 'Lépés kiválasztása:';
$string['selectdb'] = 'Adatbázis kiválasztása:';
$string['selectfieldkeyindex'] = 'Mező/kulcs/index kiválasztása:';
$string['selectonecommand'] = 'A PHP-kód megtekintéséhez válasszon egy lépést a felsorolásból';
$string['selectonefieldkeyindex'] = 'A PHP-kód megtekintéséhez válasszon egy mezőt/kulcsot/indexet a felsorolásból';
$string['selecttable'] = 'Tábla kiválasztása:';
$string['table'] = 'Tábla';
$string['tablenameempty'] = 'A táblanév nem lehet üres';
$string['tables'] = 'Táblák';
$string['textincorrectlength'] = 'Hibás hossz a szövegmezőhöz';
$string['unload'] = 'Kirakás';
$string['up'] = 'Fel';
$string['view'] = 'Nézet';
$string['view_reserved_words'] = 'Fenntartott szavak megtekintése';
$string['view_structure_php'] = 'PHP-struktúra megtekintése';
$string['view_structure_sql'] = 'SQL-struktúra megtekintése';
$string['view_table_php'] = 'PHP-táblázat megtekintése';
$string['view_table_sql'] = 'SQL-táblázat megtekintése';
$string['viewedited'] = 'Szerkesztett állapot megtekintése';
$string['vieworiginal'] = 'Eredeti megtekintése';
$string['viewphpcode'] = 'PHP-kód megtekintése';
$string['viewsqlcode'] = 'SQL-kód megtekintése';
$string['viewxml'] = 'XML';
$string['violatedforeignkeys'] = 'Hibás külső kulcs';
$string['violatedforeignkeysfound'] = 'Hibás külső kulcsok';
$string['violations'] = 'Hibák';
$string['wrong'] = 'Hibás';
$string['wrongdefaults'] = 'Hibás alapértékek fordulnak elő';
$string['wrongints'] = 'Hibás egész számok';
$string['wronglengthforenum'] = 'Hibás hossz felsoroló mezőhöz';
$string['wrongnumberofreffields'] = 'Hibás számú referenciamező.';
$string['wrongoraclesemantics'] = 'Hibás Oracle BYTE-szemantika';
$string['wrongreservedwords'] = 'Jelenlegi fenntartott szavak <br />(ne feledje, hogy a táblanevek nem fontosak $CFG->prefix használata esetén)';
$string['yesmissingindexesfound'] = 'Adatbázisából indexek hiányoznak. Itt találja ezek adatait és azokat az SQL-parancsokat, amelyekkel kedvenc SQL-felületén létrehozhatja őket (előtte ne felejtsen el biztonsági mentést készíteni adatbázisáról).<br /><br />Ezután mindenképpen futtassa le ismét ezt a segédprogramot annak ellenőrzésére, hogy nem hiányoznak-e további indexek.';
$string['yeswrongdefaultsfound'] = 'Adatbázisában nem egyező alapértékek fordulnak elő. Itt találja ezek adatait és azokat az SQL-parancsokat, amelyekkel kedvenc SQL-felületén kiküszöbölheti őket (előtte ne felejtsen el biztonsági mentést készíteni adatbázisáról).<br /><br />Ezután mindenképpen futtassa le ismét ezt a segédprogramot annak ellenőrzésére, hogy nincsenek-e további nem egyező alapértékek.';
$string['yeswrongintsfound'] = 'Adatbázisában hibás egész számok fordulnak elő. Itt láthatók a részletek és azok az SQL-parancsok, amelyeket kedvenc SQL-interfészével le kell futtatnia a létrehozásukhoz (előtte ne feledjen el biztonsági mentést készíteni adatairól).<br /><br />Ezt követően ajánlatos ismét lefuttatni a kódot és ellenőrizni, nem maradtak-e hibás egész számok.';
$string['yeswrongoraclesemanticsfound'] = 'Adatbázisában BYTE-szemantikát használó Oracle-oszlopok fordulnak elő. Itt láthatók a részletek és azok az SQL-parancsok, amelyeket kedvenc SQL-interfészével le kell futtatnia a létrehozásukhoz (előtte ne feledjen el biztonsági mentést készíteni adatairól).<br /><br />Ezt követően ajánlatos ismét lefuttatni a kódot és ellenőrizni, nem maradtak-e hibás szemantika.';
