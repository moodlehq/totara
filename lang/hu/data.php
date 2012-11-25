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
 * Strings for component 'data', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   data
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Művelet';
$string['add'] = 'Bejegyzés hozzáadása';
$string['addcomment'] = 'Megjegyzés hozzáadása';
$string['addentries'] = 'Bejegyzések hozzáadása';
$string['addtemplate'] = 'Sablon hozzáadása';
$string['advancedsearch'] = 'Részletes keresés';
$string['alttext'] = 'Alternatív szöveg';
$string['approve'] = 'Jóváhagy';
$string['approved'] = 'Jóváhagyva';
$string['ascending'] = 'Növekvő';
$string['asearchtemplate'] = 'Részletes keresés sablonja';
$string['atmaxentry'] = 'Elérte a megengedett bejegyzések maximális számát!';
$string['authorfirstname'] = 'Szerző keresztneve';
$string['authorlastname'] = 'Szerző vezetékneve';
$string['autogenallforms'] = 'Minden alapsablon előállítása';
$string['autolinkurl'] = 'URL automatikus kapcsolása';
$string['availablefromdate'] = 'Ekkortól érhető el:';
$string['availabletags'] = 'Meglévő címkék';
$string['availabletags_help'] = '**Rendelkezésre álló címkék**
A címkék olyan helykitöltők a sablonban, amelyeket mezők vagy más elemek, például egy szerkesztőikon vált fel a bejegyzések szerkesztése vagy megtekintése során.
A mezők [[fieldname]] formájúak. Az összes többi címke formája ##sometag##.
Csak a "Rendelkezésre álló címkék" listáján szereplő címkék használhatók az adott sablon esetén.';
$string['availabletodate'] = 'Eddig érhető el:';
$string['blank'] = 'Üres';
$string['buttons'] = 'Lépések';
$string['bynameondate'] = '{$a->name} írta {$a->date} időpontban';
$string['cancel'] = 'Mégse';
$string['cannotaccesspresentsother'] = 'Ön nem jogosult más felhasználók előzetes beállításainak elérésére';
$string['cannotadd'] = 'Nem lehet tételeket hozzáadni';
$string['cannotdeletepreset'] = 'Hiba egy előzetes beállítás törlése közben!';
$string['cannotoverwritepreset'] = 'Hiba a beállítás felülírása közben';
$string['cannotunziptopreset'] = 'Az előzetesen beállított könyvtárba nem lehetett kicsomagolni.';
$string['checkbox'] = 'Jelölőnégyzet';
$string['chooseexportfields'] = 'Válassza ki az exportálandó mezőket:';
$string['chooseexportformat'] = 'Válassza ki az exportálandó formát:';
$string['chooseorupload'] = 'Állomány kiválasztása';
$string['columns'] = 'oszlopok';
$string['comment'] = 'Megjegyzés';
$string['commentdeleted'] = 'Megjegyzés törölve';
$string['commentempty'] = 'A megjegyzés üres volt';
$string['comments'] = 'Megjegyzések';
$string['commentsaved'] = 'Megjegyzés elmentve';
$string['commentsn'] = '{$a} megjegyzés';
$string['commentsoff'] = 'A Megjegyzések szolgáltatás nincs bekapcsolva';
$string['configenablerssfeeds'] = 'Ezzel bekapcsolja az RSS-híreket minden adatbázis számára. Ettől függetlenül minden adatbázis beállításánál az üzeneteket kézzel kell beállítania.';
$string['confirmdeletefield'] = 'Kitörli a mezőt, biztosan ezt akarja tenni?';
$string['confirmdeleterecord'] = 'Biztosan törölni akarja ezt a bejegyzést?';
$string['csstemplate'] = 'CSS-sablon';
$string['csvfailed'] = 'A CSV-állományból nem sikerül kiolvasni a nyers adatokat.';
$string['csvfile'] = 'CSV-állomány';
$string['csvimport'] = 'CSV-állomány importálása';
$string['csvimport_help'] = '**Importálás CSV-fájlból**
A CSV a szöveges adatcsere elterjedt formája, jelentése: Comma Separated Values
(vesszővel elválasztott értékek).
A szükséges fájlformátum egyszerű szöveges állomány, első rekordként a
mezőneveket tartalmazza. Ezután következnek az adatok, soronként egy rekord.
A mezőhatároló alapértelmezésben a vessző, a mezőt záró határoló nincs
meghatározva (a mezőhatároló az a karakter, amely az egyes rekordokban az egyes mezőket körülveszi).
A rekordokat egymástól soremelés (a RETURN vagy ENTER billentyű lenyomása) választja el.
A tabulátorokat t, a soremelést n jelzi.
Minta:
név,magasság,testsúly
Kai,180 cm,80kg
Kim,170 cm,60kg
Koo,190 cm,20kg

Figyelmeztetés: előfordulhat, hogy a rendszer nem támogatja az összes mezőtípust.';
$string['csvwithselecteddelimiter'] = '<acronym title="Vesszővel elválasztott értékek">CSV</acronym>-szöveg kiválasztott határolóval:';
$string['data:approve'] = 'Jóvá nem hagyott bejegyzések jóváhagyása';
$string['data:comment'] = 'Megjegyzések írása';
$string['data:exportallentries'] = 'Összes adatbázis-bejegyzés exportálása';
$string['data:exportentry'] = 'Egyetlen adatbázis-bejegyzés exportálása';
$string['data:exportownentry'] = 'Saját adatbázis-bejegyzés exportálása';
$string['data:managecomments'] = 'Megjegyzések kezelése';
$string['data:manageentries'] = 'Bejegyzések kezelése';
$string['data:managetemplates'] = 'Sablonok kezelése';
$string['data:manageuserpresets'] = 'Összes előzetes sablonbeállítás kezelése';
$string['data:rate'] = 'Bejegyzések értékelése';
$string['data:readentry'] = 'Bejegyzések olvasása';
$string['data:viewallratings'] = 'Egyének összes nyers értékelésének megtekintése';
$string['data:viewalluserpresets'] = 'Minden felhasználó előzetes beállításainak megtekintése';
$string['data:viewanyrating'] = 'Bárki összes értékelésének megtekintése';
$string['data:viewentry'] = 'Bejegyzések megtekintése';
$string['data:viewrating'] = 'Összes kapott értékelés megtekintése';
$string['data:writeentry'] = 'Fogalmak írása';
$string['date'] = 'Dátum';
$string['dateentered'] = 'Rögzítés dátuma';
$string['defaultfielddelimiter'] = '(alapbeállítás szerint a vessző)';
$string['defaultfieldenclosure'] = '(alapbeállítás szerint semmi)';
$string['defaultsortfield'] = 'Alapbeállítás szerinti válogatási mező';
$string['delete'] = 'Törlés';
$string['deleteallentries'] = 'Az összes bejegyzés törlése';
$string['deletecomment'] = 'Biztosan törölni akarja ezt a megjegyzést?';
$string['deleted'] = 'törölve';
$string['deletefield'] = 'Meglévő mező törlése';
$string['deletenotenrolled'] = 'Be nem iratkozott felhasználók bejegyzéseinek törlése';
$string['deletewarning'] = 'Biztosan törli ezt az előzetes beállítást?';
$string['descending'] = 'Csökkenő';
$string['directorynotapreset'] = '{$a->directory} nem egy előre beállított tétel: a hiányzó állományok: {$a->missing_files}';
$string['download'] = 'Letöltés';
$string['edit'] = 'Szerkesztés';
$string['editcomment'] = 'Megjegyzés szerkesztése';
$string['editentry'] = 'Bejegyzés szerkesztése';
$string['editordisable'] = 'Szerkesztő kikapcsolása';
$string['editorenable'] = 'Szerkesztő bekapcsolása';
$string['emptyadd'] = 'A Hozzáadás sablon üres, alapbeállítás szerinti űrlap készül...';
$string['emptyaddform'] = 'Nem töltött ki egy mezőt sem!';
$string['entries'] = 'Bejegyzések';
$string['entrieslefttoadd'] = 'A tevékenység befejezéséhez {$a->entriesleft} további tételt kell hozzáadnia.';
$string['entrieslefttoaddtoview'] = 'Még {$a->entrieslefttoview} bejegyzést kell hozzáadnia, mielőtt megtekintheti más résztvevők bejegyzéseit.';
$string['entry'] = 'Fogalom';
$string['entrysaved'] = 'A bejegyzés elmentése megtörtént';
$string['errormustbeteacher'] = 'Az oldal használatához tanárnak kell lennie!';
$string['errorpresetexists'] = 'Ez a kiválasztott névvel már be van állítva.';
$string['example'] = 'Minta-adatbázismodul';
$string['excel'] = 'Excel';
$string['expired'] = 'A tevékenység {$a} időpontban lezárult és már nem érhető el.';
$string['export'] = 'Exportálás';
$string['exportaszip'] = 'Exportálás tömörítve';
$string['exportaszip_help'] = '**Exportálás tömörített állományként**
A sablonokat számítógépére mentheti, melyeket a későbbiek folyamán az
importálás tömörített állományból funkcióval egy másik adatbázisba tölthet fel.';
$string['exportedtozip'] = 'Exportálva ideiglenes ... tömörített állományba';
$string['exportentries'] = 'Fogalmak exportálása';
$string['exportownentries'] = 'Csak a saját tételeit exportálja? ({$a->mine}/{$a->all})';
$string['failedpresetdelete'] = 'Hiba egy előre beállított tétel törlése közben!';
$string['fieldadded'] = 'Mező hozzáadva';
$string['fieldallowautolink'] = 'Automatikus kapcsolás engedélyezése';
$string['fielddeleted'] = 'Mező törölve';
$string['fielddelimiter'] = 'Mezőhatároló';
$string['fielddescription'] = 'Mezőleírás';
$string['fieldenclosure'] = 'Mezőhatárolás';
$string['fieldheight'] = 'Magasság';
$string['fieldheightlistview'] = 'Magasság felsorolási nézetben';
$string['fieldheightsingleview'] = 'Magasság egyszeres nézetben';
$string['fieldids'] = 'Mezőazonosítók';
$string['fieldmappings'] = 'Mezőillesztések';
$string['fieldmappings_help'] = '**Mezőmásolás**
Ez a menü lehetővé teszi adatok megőrzését a meglévő adatbázisból.
Egy adott mező adatainak a megőrzéséhez át kell őket másolni egy új mezőbe, ahol
majd megjelennek. Bármely mező akár üresen is hagyható, így nem másolódik bele semmilyen információ.
Az új mezőbe át nem másolt régi mező adataival együtt elvész.
Csak azonos típusú mezők másolhatók, így minden lenyíló
ablakban más-más mezők szerepelnek. Ügyeljen arra, hogy egy régi mezőt csakis egy új mezőbe másoljon át.';
$string['fieldname'] = 'Mezőnév';
$string['fieldnotmatched'] = 'Állományának alábbi mezői nem szerepelnek az adatbázisban: {$a}';
$string['fieldoptions'] = 'Választási lehetőségek (soronként egy)';
$string['fields'] = 'Mezők';
$string['fieldupdated'] = 'Mező frissítve';
$string['fieldwidth'] = 'Szélesség';
$string['fieldwidthlistview'] = 'Szélesség felsorolási nézetben';
$string['fieldwidthsingleview'] = 'Szélesség egyszeres nézetben';
$string['file'] = 'Állomány';
$string['fileencoding'] = 'Kódolás';
$string['filesnotgenerated'] = 'Nem minden állomány jött létre: {$a}';
$string['filtername'] = 'Adatbázis automatikus kapcsolása';
$string['footer'] = 'Lábléc';
$string['forcelinkname'] = 'Kapcsolat kötelező neve';
$string['foundnorecords'] = 'Nincsenek rekordok (<a href="{$a->reseturl}">Szűrők visszaállítása</a>)';
$string['foundrecords'] = 'Vannak rekordok: {$a->num}/{$a->max} (<a href="{$a->reseturl}">Szűrők visszaállítása</a>)';
$string['fromfile'] = 'Importálás tömörített állományból';
$string['fromfile_help'] = 'Az exportálási funkcióval számítógépre mentett előzetes beállítások feltöltésére szolgál.';
$string['generateerror'] = 'Nem minden állomány jött létre!';
$string['header'] = 'Fejléc';
$string['headeraddtemplate'] = 'Fogalmak szerkesztésénél megadja a felületet';
$string['headerasearchtemplate'] = 'Meghatározza a részletes keresési felületet';
$string['headercsstemplate'] = 'Más sablonokhoz megadja a helyi CSS-t';
$string['headerjstemplate'] = 'Testre szabott javascript meghatározása a többi sablonhoz';
$string['headerlisttemplate'] = 'Többszörös fogalmakhoz megadja a böngésző felületet';
$string['headerrsstemplate'] = 'Megadja a bejegyzések megjelenését RSS-üzenetekben';
$string['headersingletemplate'] = 'Egyetlen fogalomhoz megadja a böngésző felületet';
$string['importentries'] = 'Fogalmak importálása';
$string['importsuccess'] = 'Az előzetes beállítási tétel alkalmazása sikerült.';
$string['insufficiententries'] = 'több fogalom szükséges az adatbázis megtekintéséhez';
$string['intro'] = 'Bevezetés';
$string['invalidaccess'] = 'Az oldal elérése hibásan történt';
$string['invalidfieldid'] = 'Hibás mezőazonosító';
$string['invalidfieldname'] = 'Válasszon másik nevet a mezőhöz';
$string['invalidfieldtype'] = 'Hibás mezőtípus';
$string['invalidid'] = 'Hibás adatazonosító';
$string['invalidpreset'] = 'A(z) {$a} nem előzetes beállítás.';
$string['invalidrecord'] = 'Hibás rekord';
$string['invalidurl'] = 'A megadott URL nem érvényes';
$string['jstemplate'] = 'Javascript-sablon';
$string['latitude'] = 'Szélesség';
$string['latlong'] = 'Szélesség/hosszúság';
$string['latlongdownloadallhint'] = 'Minden bejegyzéshez ugrópont letöltése KML-ként';
$string['latlongkmllabelling'] = 'Hogyan címkézhetők az elemek a KML-állományokban (Google Earth)';
$string['latlonglinkservicesdisplayed'] = 'Megjelenítendő kapcsolási szolgáltatások';
$string['latlongotherfields'] = 'Egyéb mezők';
$string['list'] = 'Felsorolás megtekintése';
$string['listtemplate'] = 'Listasablon';
$string['longitude'] = 'Hosszúság';
$string['mapexistingfield'] = 'Illesztés erre: {$a}';
$string['mapnewfield'] = 'Új mező létrehozása';
$string['mappingwarning'] = 'Minden új mezőhöz nem illesztett régi mező elvész, adatai pedig törlődnek.';
$string['maxentries'] = 'Bejegyzések maximális száma';
$string['maxentries_help'] = '**Maximális fogalomszám**
A tevékenységhez egy résztvevő által leadható fogalmak maximális száma.';
$string['maxsize'] = 'Maximális méret';
$string['menu'] = 'Menü';
$string['menuchoose'] = 'Választás...';
$string['missingdata'] = 'A mezőosztályhoz adatazonosítót vagy objektumot kell megadni';
$string['missingfield'] = 'Programozói hiba: mezőosztály meghatározásakor mezőt és/vagy adatot kell megadnia.';
$string['modulename'] = 'Adatbázis';
$string['modulename_help'] = 'Az adatbázis-tevékenységi modullal a résztvevők tételrekordokat hozhatnak létre, tarthatnak fenn és kereshetnek végig. A tételek formája és szerkezete szinte tetszőleges, ideértve a képeket, állományokat, URL-eket, számokat, szövegeket stb.';
$string['modulenameplural'] = 'Adatbázisok';
$string['more'] = 'Tovább';
$string['moreurl'] = 'Több URL';
$string['movezipfailed'] = 'A tömörített állomány nem helyezhető át';
$string['multientry'] = 'Ismétlődő fogalom';
$string['multimenu'] = 'Menü (többszörös választás)';
$string['multipletags'] = 'Többszörös címke! A sablon nincs elmentve';
$string['namecheckbox'] = 'Jelölőnégyzet mezője';
$string['namedate'] = 'Dátummező';
$string['namefile'] = 'Állománymező';
$string['namelatlong'] = 'Szélesség/hosszúság-mező';
$string['namemenu'] = 'Menümező';
$string['namemultimenu'] = 'Többszörös választás menümezője';
$string['namenumber'] = 'Számmező';
$string['namepicture'] = 'Képmező';
$string['nameradiobutton'] = 'Rádiógombmező';
$string['nametext'] = 'Szövegmező';
$string['nametextarea'] = 'Szövegnégyzet mezője';
$string['nameurl'] = 'URL-mező';
$string['newentry'] = 'Új bejegyzés';
$string['newfield'] = 'Új mező létrehozása';
$string['newfield_help'] = '**Mezők**
Ezen a képernyőn mezőket hozhat létre, melyek adatbázisa részét fogják képezni.
Az egyes mezőkben különféle típusú adatok rögzíthetők más-más felülettel.';
$string['noaccess'] = 'Ehhez az oldalhoz nem férhet hozzá';
$string['nodefinedfields'] = 'Az új előre beállított tételhez nincsenek megadva mezők!';
$string['nofieldcontent'] = 'A mező tartalma nem található';
$string['nofieldindatabase'] = 'Az adatbázishoz nincsenek megadva mezők.';
$string['nolisttemplate'] = 'Nincs meghatározva listasablon';
$string['nomatch'] = 'Nincs egyező fogalom!';
$string['nomaximum'] = 'Nincs maximum';
$string['norecords'] = 'Nincsenek bejegyzések az adatbázisban';
$string['nosingletemplate'] = 'Nincs meghatározva egyszeres sablon';
$string['notapproved'] = 'A bejegyzés még nincs jóváhagyva.';
$string['notinjectivemap'] = 'Nem injektív leképezés';
$string['notopenyet'] = 'A tevékenység {$a} időpontig nem elérhető.';
$string['number'] = 'Szám';
$string['numberrssarticles'] = 'RSS-cikkek';
$string['numnotapproved'] = 'Folyamatban';
$string['numrecords'] = '{$a} bejegyzés';
$string['ods'] = '<acronym title="OpenDocument számolótábla">ODS</acronym> (OpenOffice)';
$string['optionaldescription'] = 'Rövid leírás (opcionális)';
$string['optionalfilename'] = 'Állománynév (opcionális)';
$string['other'] = 'Más';
$string['overrwritedesc'] = 'Írja felül a beállított értéket, ha már létezik.';
$string['overwrite'] = 'Felülírás';
$string['overwritesettings'] = 'A jelenlegi beállítások felülírása';
$string['page-mod-data-x'] = 'Bármely adatbázis-tevékenységel kapcsolatos moduloldal';
$string['pagesize'] = 'Oldalankénti bejegyzés';
$string['participants'] = 'Résztvevők';
$string['picture'] = 'Kép';
$string['pleaseaddsome'] = 'Hozzon létre néhányat alább, illetve a kezdéshez <a href="{$a}">válasszon egy előre megadott készletet</a>.';
$string['pluginadministration'] = 'Adatbázis-tevékenység kezelése';
$string['pluginname'] = 'Adatbázis';
$string['portfolionotfile'] = 'Állomány helyett portfólióba való exportálás (csakis csv és leap2a)';
$string['presetinfo'] = 'Ha előzetes beállításként elmenti, akkor a sablont közzéteszi. Így más felhasználók is használhatják adatbázisaikban.';
$string['presets'] = 'Előzetes beállítások';
$string['radiobutton'] = 'Rádiógombok';
$string['recordapproved'] = 'Bejegyzés jóváhagyva';
$string['recorddeleted'] = 'Bejegyzés törölve';
$string['recordsnotsaved'] = 'Nem került sor bejegyzés elmentésére. Ellenőrizze a feltöltött állomány formáját.';
$string['recordssaved'] = 'bejegyzés elmentve';
$string['requireapproval'] = 'Legyen jóváhagyás?';
$string['requireapproval_help'] = '**Jóváhagyással**
Jóvá kell a tanárnak hagyni a fogalmakat, mielőtt azt a többi tanuló láthatja? Ez a funkció hasznos lehet potenciálisan bántó vagy helytelen tartalmak kiszűréséhez.';
$string['requiredentries'] = 'Előírt fogalmak';
$string['requiredentries_help'] = '**Fogalmak szükséges száma**
Egy résztvevő által leadandó fogalmak száma. A felhasználók figyelmeztető üzenetet látnak, ha nem adják le a kellő számú fogalmat.
A tevékenység mindaddig nem tekinthető teljesítettnek, ameddig a felhasználó a szükséges számú fogalmat le nem adta.';
$string['requiredentriestoview'] = 'Megtekintéshez szükséges fogalmak';
$string['requiredentriestoview_help'] = '**Megtekintés előtt szükséges fogalmak száma**
Egy résztvevő által leadandó fogalmak száma, mielőtt megnézhetnek bármely fogalmat
ezen adatbázishoz kapcsolódó tevékenység során.';
$string['resetsettings'] = 'Szűrők visszaállítása';
$string['resettemplate'] = 'Sablon visszaállítása';
$string['resizingimages'] = 'Miniatűr képek átméretezése';
$string['rows'] = 'sorok';
$string['rssglobaldisabled'] = 'Kikapcsolva. Lásd a portál beállítási változóit.';
$string['rsstemplate'] = 'RSS-sablon';
$string['rsstitletemplate'] = 'RSS-címsablon';
$string['save'] = 'Mentés';
$string['saveandadd'] = 'Mentés és egy másik hozzáadása';
$string['saveandview'] = 'Mentés és megtekintés';
$string['saveaspreset'] = 'Mentés előzetes beállításként';
$string['saveaspreset_help'] = '**Mentés előzetes beállításként**
Ezzel a meglévő sablonokat előzetes beállításként menti el, melyeket
a portálon bárki megtekinthet és használhat. Az előzetes beállítás
megjelenik az előzetes beállítások felsorolásában. Eltávolítása bármikor lehetséges.';
$string['savesettings'] = 'Beállítások mentése';
$string['savesuccess'] = 'A mentés sikerült. Előzetes beállítása az egész portálon elérhető lesz.';
$string['savetemplate'] = 'Sablon mentése';
$string['search'] = 'Keresés';
$string['selectedrequired'] = 'Minden kiválasztott szükséges';
$string['showall'] = 'Minden tétel megjelenítése';
$string['single'] = 'Egyetlen megtekintése';
$string['singletemplate'] = 'Egyszeres sablon';
$string['subplugintype_datafield'] = 'Adatbázis mezőjének típusa';
$string['subplugintype_datafield_plural'] = 'Adatbázis mezőjének típusai';
$string['subplugintype_datapreset'] = 'Előre megadott';
$string['subplugintype_datapreset_plural'] = 'Előzetes beállítások';
$string['teachersandstudents'] = '{$a->teachers} és {$a->students}';
$string['templates'] = 'Sablonok';
$string['templatesaved'] = 'Sablon elmentve';
$string['text'] = 'Szöveg';
$string['textarea'] = 'Szövegnégyzet';
$string['timeadded'] = 'Időpont hozzáadva';
$string['timemodified'] = 'Időpont módosult';
$string['todatabase'] = 'ehhez az adatbázishoz';
$string['type'] = 'Mezőtípus';
$string['undefinedprocessactionmethod'] = 'Nincs megadva műveletmódszer a Data_Preset-ben a(z) "{$a}" művelet kezeléséhez.';
$string['unsupportedexport'] = 'A(z) ({$a->fieldtype}) nem exportálható.';
$string['updatefield'] = 'Meglévő mező frissítése';
$string['uploadfile'] = 'Állomány feltöltése';
$string['uploadrecords'] = 'Bejegyzések feltöltése állományból';
$string['uploadrecords_help'] = 'A fogalmak feltölthetők szöveges állományból. Ennek formátuma a következő:
* Minden sorban egy rekord szerepel
* Minden rekord vesszőkkel (vagy egyéb határolókkal) elválasztott adatsorból áll
* Az első rekord tartalmazza az állomány többi részhét meghatározó mezőnevek felsorolását.
A mezőhatároló az egyes rekordok mezőit egymástól elválasztó karakter. Általában nem szükséges megadni.';
$string['url'] = 'URL';
$string['usestandard'] = 'Előzetes beállítás használata';
$string['usestandard_help'] = '**Használat előzetes beállításként**
Az egész portálon elérhető sablont használja.
Ha az előzetes beállítást a könyvtárba a \'Mentés előzetes beállításként\'
funkcióval mentette el, akkor törölheti is.';
$string['viewfromdate'] = 'Megtekinthető ekkortól';
$string['viewtodate'] = 'Megtekinthető eddig';
$string['wrongdataid'] = 'Hibás adatazonosítót adott meg';
