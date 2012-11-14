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
 * Strings for component 'error', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   error
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['alreadyloggedin'] = 'Du är redan inloggad som {$a} så Du måste logga ut innan Du kan logga in som en annan användare.';
$string['blockcannotconfig'] = 'Det här blocket stöder inte global konfiguration';
$string['blockcannotinistantiate'] = 'Svårigheter med att instantiera objekt av typ block';
$string['blockdoesnotexist'] = 'Det finns inget sådant här block';
$string['blockdoesnotexistonpage'] = 'Det här blocket (id={$a->instanceid}) finns inte på den här sidan ({$a->url}).';
$string['blocknameconflict'] = 'Namnkonflikt: blocket {$a->name} har samma titel som ett befintligt block: {$a->conflict}!';
$string['cannotaddcoursemodule'] = 'Det gick inte att lägga till en ny kursmodul';
$string['cannotaddcoursemoduletosection'] = 'Det gick inte att lägga till den nya kursen till den sektionen.';
$string['cannotaddnewmodule'] = 'Det gick inte att lägga till en ny modul {$a}';
$string['cannotaddthisblocktype'] = 'Du kan inte lägga till ett {$a} block till den här sidan.';
$string['cannotassignrole'] = 'Det går inte att tilldela en roll i kurs';
$string['cannotassignrolehere'] = 'Du får inte tilldela den här rollen (id = {$a->roleid}) i det här sammanhanget ({$a->context})';
$string['cannotassignselfasparent'] = 'Det går inte att tilldela "self" som förälder!';
$string['cannotcallscript'] = 'Du kan inte anropa det här skriptet på det här sättet.';
$string['cannotcallusgetselecteduser'] = 'Du kan inte anropa user_selector::get_selected_user om multi select är "true".';
$string['cannotcreatecategory'] = 'Kategorin fogades inte in';
$string['cannotcreatelangdir'] = 'Det går inte att skapa en lang-katalog';
$string['cannotcreateorfindstructs'] = 'Fel i sb m sökning eller skapande av sektionsstrukturer för den här kursen';
$string['cannotcreatetempdir'] = 'Det går inte att skapa en temp-katalog';
$string['cannotcustomisefiltersblockuser'] = 'Du kan inte standardisera inställningar för filter i sammanhangen för användare eller block';
$string['cannotdeletecategorycourse'] = 'Det gick inte att ta bort kursen {$a}.';
$string['cannotdeletecategoryquestions'] = 'Det gick inte att ta bort frågor från kategorin {$a}.';
$string['cannotdeletecourse'] = 'Du har inte tillstånd att ta bort den här kursen.';
$string['cannotdeletecustomfield'] = 'Fel i sb m borttagande av standardiserade fältdata';
$string['cannotdeletefile'] = 'Det går inte att ta bort den här filen';
$string['cannotdeleterolewithid'] = 'Det gick inte att ta bort rollen med ID {$a}';
$string['cannotdeletethisrole'] = 'Du kan inte ta bort den här rollen eftersom den används av systemet eller så är det den sista rollen med kapaciteter för en administratör.';
$string['cannotdownloadcomponents'] = 'Det går inte att ladda ner komponenter';
$string['cannotdownloadlanguageupdatelist'] = 'Det går inte att ladda ner en lista över uppdateringar av språk från moodle.org';
$string['cannotdownloadzipfile'] = 'Det går inte att ladda ner ZIP-fil.';
$string['cannoteditsiteform'] = 'Du kan inte redigera kursen på webbplatsnivå med hjälp av det här formuläret';
$string['cannotedityourprofile'] = 'Du kan tyvärr inte redigera Din egen profil.';
$string['cannotfindcategory'] = 'Det går inte att hitta kategoripost från databasen genom ID - {$a}';
$string['cannotfindcomponent'] = 'Det går inte att hitta komponent';
$string['cannotfindcourse'] = 'Det går inte att hitta kurs';
$string['cannotfindgradeitem'] = 'Det går inte att hitta grade-item';
$string['cannotfindteacher'] = 'Det går inte att hitta (distans)lärare';
$string['cannotfinduser'] = 'Det går inte att hitta någon användare vid namn "{$a}"';
$string['cannotgradeuser'] = 'Det går inte att sätta betyg på den här användaren';
$string['cannothaveparentcate'] = 'En kurskategori kan inte ha "förälder"!';
$string['cannotimport'] = 'Fel vid import';
$string['cannotimportformat'] = 'Funktionen att importera det här formatet är tyvärr ännu inte implementerad!';
$string['cannotimportgrade'] = 'Fel vid import av betyg/omdöme';
$string['cannotinsertgrade'] = 'Det går inte att foga in en betygskomponent utan kursID!';
$string['cannotinsertrecord'] = 'Du kan inte infoga det nya post-ID {$a}';
$string['cannotmailconfirm'] = 'Fel i sb m att e-post om bekräftelse av ändring av lösenord skickades ut';
$string['cannotmanualctrack'] = 'Den här aktiviteten erbjuder inte manuell spårning av fullföljande';
$string['cannotmapfield'] = 'En kollision vid kartläggning har upptäckts - två fält leder till samma betygskomponent {$a}';
$string['cannotmoverolewithid'] = 'Det går inte att flytta rollen med ID {$a}';
$string['cannotnetgeo'] = 'Det går inte att ansluta till NeoGeo-servern hos http://netgeo.caida.org. Var snäll och kontrollera inställningarna för proxy eller ännu bättre - installera datafilen MaxMind GeoLite City';
$string['cannotopencsv'] = 'Det går inte att öppna CSV-filen';
$string['cannotopenfile'] = 'Det går inte att öppna filen ({$a})';
$string['cannotopenzip'] = 'Det går inte att öppna zip-filen, förmodligen är det en zip-tilläggsbugg på 64bit os';
$string['cannotoverridebaserole'] = 'Det går inte att överskrida de grundläggande rollkapaciteterna';
$string['cannotoverriderolehere'] = 'Du har inte tillstånd att överskrida den här rollen (id = {$a->roleid}) i det här sammanhanget ({$a->context})';
$string['cannotreadfile'] = 'Det går inte att läsa filen {$a}';
$string['cannotreadtmpfile'] = 'Fel vid läsning av en temporär fil';
$string['cannotreaduploadfile'] = 'Det gick inte att läsa den uppladdade filen';
$string['cannotresetguestpwd'] = 'Du kan inte återställa lösenordet för gäster';
$string['cannotresetmail'] = 'Fel i sb m återställande av lösenord och e-post till Dig';
$string['cannotrestore'] = 'Ett fel har uppstått och det gick inte att fullfölja återställningen';
$string['cannotsavemd5file'] = 'Det går inte att spara md5-fil';
$string['cannotsavezipfile'] = 'Det går inte att spara ZIP-fil';
$string['cannotsetparentforcatoritem'] = 'Det går inte att ställa in "förälder" för kategori eller kurskomponent!';
$string['cannotsetpassword'] = 'Det gick inte att ställa in lösenord för användare!';
$string['cannotunassigncap'] = 'Det gick inte att ta bort tilldelningen av en utgången kapacitet {$a->cap} från rollen {$a->role}';
$string['cannotunzipfile'] = 'Det går inte att packa upp fil';
$string['cannotupdatemod'] = 'Det gick inte att uppdatera {$a}';
$string['cannotupdatepasswordonextauth'] = 'Uppdateringen av lösenordet på den externa autentiseringen misslyckades: {$a}. Kontrollera serverloggarna för mer detaljer.';
$string['cannotupdateprofile'] = 'Fel vid uppdatering av post för användare';
$string['cannotupdaterecord'] = 'Du kan inte uppdatera post-ID {$a}';
$string['cannotupdateuseronexauth'] = 'Uppdateringen av användardata på den externa autentiseringen {$a} misslyckades. Se serverloggarna för mer detaljer.';
$string['cannotuploadfile'] = 'Fel när den uppladdade filen skulle behandlas';
$string['cannotusepage2'] = 'Du får tyvärr inte använda den här sidan';
$string['cannotviewprofile'] = 'Du kan inte visa den här användarens profil.';
$string['cannotviewreport'] = 'Du kan inte visa den här rapporten';
$string['componentisuptodate'] = 'Komponenten är av en aktuell version';
$string['confirmsesskeybad'] = 'Beklagar, men det gick inte att bekräfta Din nyckel för sessionen vilket är nödvändigt för att fullfölja den här handlingen. Det här är en säkerhetsåtgärd för att förebygga att viktiga funktioner utförs på felaktiga eller illasinnade sätt i Ditt namn. Var snäll och kontrollera noga att Du verkligen vill fullfölja detta.';
$string['couldnotassignrole'] = 'Ett allvarligt men odefinierat fel inträffade när en roll skulle tilldelas till Dig.';
$string['countriesphpempty'] = 'Fel: Filen countries.php i language pack {$a} är tom eller saknas';
$string['coursedoesnotbelongtocategory'] = 'Kursen tillhör inte den här kategorin';
$string['coursegroupunknown'] = 'Den kurs som hör till grupp {$a} har inte angivits';
$string['courseidnotfound'] = 'Det finns inget sådant kursID';
$string['coursemisconf'] = 'Kursen är konfigurerad på fel sätt';
$string['csvcolumnduplicates'] = 'Vi har upptäckt dubbletter av kolumner';
$string['csvemptyfile'] = 'CSV-filen är tom';
$string['csvfewcolumns'] = 'Det finns inte tillräckligt med kolumner, var snäll och verifiera inställningen för begränsningar.';
$string['csvweirdcolumns'] = 'Ogiltigt format för CSV-fil - antalet kolumner är inte konstant.';
$string['dbupdatefailed'] = 'Uppdatering av databasen misslyckades';
$string['ddlfieldalreadyexists'] = 'Fältet "{$a}" finns redan';
$string['ddltablealreadyexists'] = 'Tabellen "{$a}" finns redan';
$string['ddltablenotexist'] = 'Tabellen "{$a}" finns inte';
$string['ddlxmlfileerror'] = 'Det fanns fel i XML-databasfilen';
$string['dmlreadexception'] = 'Fel vid läsning av databas';
$string['dmltransactionexception'] = 'Fel vid överföring till databas';
$string['dmlwriteexception'] = 'Fel i sb m att data skulle skrivas till databas';
$string['downloadedfilecheckfailed'] = 'Det gick inte att kontrollera den nedladdade filen';
$string['duplicateusername'] = 'Dubblerat användarnamn - hoppar över posten';
$string['error'] = 'Det uppstod ett fel';
$string['errorcleaningdirectory'] = 'Fel i samband med rensning av katalogen "{$a}"';
$string['errorcopyingfiles'] = 'Fel i samband med kopiering av filer';
$string['errorcreatingdirectory'] = 'Fel i samband med skapandet av katalogen  "{$a}"';
$string['errorcreatingfile'] = 'Fel i samband med skapandet av filen  "{$a}"';
$string['errorfetchingrssfeed'] = 'Det uppstod ett fel i sb m hämtning av RSS-inflöde';
$string['erroronline'] = 'Fel på rad {$a}';
$string['errorreadingfile'] = 'Fel i samband med läsningen av filen  "{$a}"';
$string['errorsavingrequest'] = 'Ett fel uppstod när din förfrågan skulle sparas.';
$string['errorunzippingfiles'] = 'Fel i samband med att filer skulle packas upp';
$string['expiredkey'] = 'Utgången nyckel';
$string['fieldrequired'] = '\'{$a}\' är ett obligatoriskt fält';
$string['fileexists'] = 'Det finns en sådan fil';
$string['filenotfound'] = 'Den efterfrågade filen kan tyvärr inte skapas';
$string['filenotreadable'] = 'Det går inte att läsa filen';
$string['filternotenabled'] = 'Filter är inte aktiverat!';
$string['forumblockingtoomanyposts'] = 'Du har överskridit det maximalt tillåtna antalet inlägg som gäller för det här forumet.';
$string['generalexceptionmessage'] = 'Undantag - {$a}';
$string['groupalready'] = 'Användaren tillhör redan grupp {$a}';
$string['groupexistforcourse'] = 'Det finns redan en grupp "{$a}" i den här kursen.';
$string['groupnotaddederror'] = 'Grupp "{$a}" har inte lagts till';
$string['groupunknown'] = 'Grupp {$a} är inte kopplad till den angivna kursen';
$string['groupusernotmember'] = 'Användaren är inte medlem av denna grupp.';
$string['guestnoeditprofile'] = 'Gästanvändare kan inte redigera sin profil';
$string['guestnoeditprofileother'] = 'Gästanvändarens profil går inte att redigera';
$string['guestsarenotallowed'] = 'En gästanvändare kan inte göra detta';
$string['invalidadminsettingname'] = 'Ogiltiga admin-inställningar ({$a})';
$string['invalidcategory'] = 'Felaktig kategori!';
$string['invalidcategoryid'] = 'Felaktig ID för kategori!';
$string['invalidcomment'] = 'Felaktig kommentar';
$string['invalidconfirmdata'] = 'Felaktiga data för bekräftelse';
$string['invalidcontext'] = 'Ogiltigt sammanhang';
$string['invalidcourse'] = 'Ogiltig kurs';
$string['invalidcourseid'] = 'Du försöker att använda ett ogiltigt kurs-ID ({$a})';
$string['invalidcourselevel'] = 'Felaktig nivå på sammanhang';
$string['invalidcoursemodule'] = 'Ogiltig ID för kursmodul';
$string['invalidcoursenameshort'] = 'Ogiltigt kortnamn för kurs';
$string['invaliddata'] = 'De data som har skickats in är ogiltiga';
$string['invalidelementid'] = 'Felaktigt ID för "element"!';
$string['invalidentry'] = 'Detta är inte ett giltig inmatning!';
$string['invalidfieldname'] = '\'{$a}\' är inte ett giltigt fältnamn';
$string['invalidfiletype'] = '\'{$a}\' är inte en giltig filtyp';
$string['invalidformdata'] = 'Felaktiga data i formulär';
$string['invalidfunction'] = 'Felaktig funktion';
$string['invalidgradeitemid'] = 'Felaktig id för betygs"element"';
$string['invalidgradeitmeid'] = 'Felaktig id för betygs"element"';
$string['invalidgroupid'] = 'Ett felaktig gruppID har angivits';
$string['invalidipformat'] = 'Ogiltigt format för IP-adress';
$string['invaliditemid'] = 'Felaktigt ID för komponent "item"';
$string['invalidkey'] = 'Felaktig nyckel';
$string['invalidmd5'] = 'Kontrollvariabeln var felaktig - försök igen';
$string['invalidmode'] = 'Ogiltigt läge ({$a})';
$string['invalidnum'] = 'Ogiltigt numeriskt värde';
$string['invalidoutcome'] = 'Felaktig ID för resultat';
$string['invalidpagesize'] = 'Ogiltig storlek för sida';
$string['invalidpasswordpolicy'] = 'Ogiltig policy för lösenord';
$string['invalidrequest'] = 'Ogiltig förfågan';
$string['invalidrole'] = 'Ogiltig roll';
$string['invalidroleid'] = 'Ogiltig ID för roll';
$string['invalidscaleid'] = 'Ogiltig ID för skala';
$string['invalidsesskey'] = 'Felaktig sesskey angiven. Formuläret inte accepterat!';
$string['invalidshortname'] = 'Detta är ett ogiltigt kortnamn för kurs';
$string['invalidurl'] = 'Ogiltig url';
$string['invaliduser'] = 'Ogiltig användare';
$string['invaliduserid'] = 'Ogiltigt ID för användare';
$string['invalidxmlfile'] = '\'{$a}\' är inte en giltig XML-fil';
$string['iplookupfailed'] = 'Det går inte att hitta någon information om den här IP-adressen {$a}.';
$string['iplookupprivate'] = 'Det går inte att visa sökning av privat IP-adress.';
$string['listcantmovedown'] = 'Det gick inte att flytta ner komponenten, den är den sista av sina jämlikar på samma nivå.';
$string['listcantmoveleft'] = 'Det gick inte att flytta komponenten åt vänster, den har ingen förälder.';
$string['listcantmoveright'] = 'Det gick inte att flytta ner komponenten åt höger, det finns ingen jämlike på samma nivå att göra om till ett barn. Flytta det nedanför en annan jämlik på samma nivå - sedan kan du flytta den åt höger.';
$string['listcantmoveup'] = 'Det gick inte att flytta upp komponenten, den är den första av sina jämlikar på samma nivå.';
$string['listnochildren'] = 'Det gick inte att hitta några barn till komponenten';
$string['listnoitem'] = 'Det gick inte att hitta komponenten';
$string['listnopeers'] = 'Det gick inte att hitta några jämikar på samma nivå till komponenten';
$string['listupdatefail'] = 'DB-operationen misslyckades när listans hierarki skulle redigeras.';
$string['loginasnoenrol'] = 'Du kan inte använda \'registrera\' eller \'avregistrera\' när Du är i en session för \'logga in som\' för kurs.';
$string['loginasonecourse'] = 'Du har inte tillträde till den här kursen.<br/ > Du måste avsluta sessionen \'Logga in som\' innan Du kan få tillträde till någon annan kurs.';
$string['missingfield'] = 'Fältet "{$a}" saknas';
$string['missingrequiredfield'] = 'Det saknas några obligatoriska fält';
$string['modulemissingcode'] = 'Modulen {$a} saknar den kod som behövs för den här  funktionen.';
$string['mustbeteacher'] = 'Du måste vara (distans)lärare för få tillgång till den här sidan.';
$string['nocategorydelete'] = 'Kategori \'{$a}\' kan inte raderas!';
$string['nocontext'] = 'Den där kursen är tyvärr inte ett giltigt sammanhang.';
$string['noinstances'] = 'Det finns inga instanser av {$a} i den här kursen!';
$string['nologinas'] = 'Du har inte tillstånd att logga in som den användaren.';
$string['nonmeaningfulcontent'] = 'Inget meningsfullt innehåll';
$string['noparticipatorycms'] = 'Du har tyvärr inga deltagande kursmoduler att rapportera om.';
$string['nopermissions'] = 'Du har tyvärr f.n. inte tillstånd att göra detta ({$a})';
$string['nostatstodisplay'] = 'Det finns ingen tillgänglig data att visa';
$string['notavailable'] = 'Detta är inte tillgängligt f.n.';
$string['onlyadmins'] = 'Det är bara administratörer som kan göra detta.';
$string['onlyeditingteachers'] = 'Det är bara lärare som kan göra det.';
$string['onlyeditown'] = 'Du kan bara redigera Din egen information.';
$string['pagenotexist'] = 'Ett ovanligt fel inträffade (ett försök att nå en sida som inte finns).';
$string['pleasereport'] = 'Om Du har tid, var då snäll och låt oss få veta när felet uppträdde.';
$string['pluginrequirementsnotmet'] = 'Det gick inte att installera "{$a->pluginname}" ({$a->pluginversion}). Den kräver en nyare version av Moodle. Du använder f.n. {$a->currentmoodle} och Du behöver {$a->requiremoodle} .';
$string['processingstops'] = 'Processandet upphör här.  De återstående posterna har inte ändrats.';
$string['remotedownloaderror'] = 'Nedladdningen av en komponent till din server misslyckades, var snäll och verifiera inställningar för proxy. <br /><br />Du måste ladda ner <a href="{$a->url}">{$a->url}</a> filen manuellt, kopiera den till "{$a->dest}" på din server och packa upp den där.';
$string['remotedownloadnotallowed'] = 'De är inte tillåtet att ladda upp komponenter till Din server (allow_url_fopen är avaktiverad). Du måste ladda ner filen <a href="{$a->url}">{$a->url}</a> manuellt, kopiera den till "{$a->dest}" på Din server och packa upp den där.';
$string['restorechecksumfailed'] = 'Några problem hände vid återställning av information lagrad i din session. Vänligen kontrollera din PHP-minne / DB storleksgränser. Återställning stoppas.';
$string['restricteduser'] = 'Ditt nuvarande konto "{$a}" tillåter tyvärr inte detta.';
$string['scheduledbackupsdisabled'] = 'Schemalagda säkerhetskopieringar har avaktiverats av den administrerar servern,';
$string['sendmessage'] = 'Skicka meddelande';
$string['sessionerroruser'] = 'Tiden för Din session har tagit slut eller stötte på ett fel. Var snäll och logga in igen.';
$string['sessionerroruser2'] = 'Ett fel på servernivå som påverkar Din session för inloggning har upptäckts. Var snäll och logga in igen och starta om Din webbläsare.';
$string['sessionipnomatch'] = 'Beklagar, men Ditt IP-nummer tycks ha ändrats sedan Du först loggade in. Det här är en säkerhetsåtgärd för att förebygga att \'crackers\' stjäl Din identitet medan Du är inloggad på den här webbplatsen. Vanliga användare bör inte få se detta meddelande - var snäll och be administratören för Din webbplats om hjälp.';
$string['socksnotsupported'] = 'SOCKS5 proxy stöds inte i PHP4';
$string['statscatchupmode'] = 'Statistiken håller f.n på att uppdateras. Hittills har {$a->daysdone} dagar behandlats och  {$a->dayspending} återstår att behandla. Du kan snart komma tillbaka och kontrollera detta igen!';
$string['tagnotfound'] = 'Den specificerade etiketten gick inte att hitta i databasen.';
$string['unicodeupgradeerror'] = 'Din databas är tyvärr ännu inte i Unicode och den här versionen av Moodle kan inte överföra Din databas till Unicode. Var snäll och uppgradera till Moodle 1.7.x först och genomför övergången till Unicode  via sidan för administration. Därefter bör Du kunna överföra databasen till Moodle {$a}.';
$string['unknowncourse'] = 'Okänd kurs som kallas "{$a}"';
$string['unknowncourseidnumber'] = 'Okänt kurs-id "{$a}"';
$string['unknowncourserequest'] = 'Okänd kursförfågan';
$string['unknowngroup'] = 'Okänd grupp "{$a}"';
$string['unknownrole'] = 'Okänd roll "{$a}"';
$string['unknownuseraction'] = 'Jag förstår tyvärr inte denna handling från användarens sida.';
$string['userautherror'] = 'Okänd plugin för autenticering';
$string['userauthunsupported'] = 'Denna plugin för autenticering stödjs inte här.';
$string['useremailduplicate'] = 'Dublett av adress';
$string['usernotaddederror'] = 'Användaren har inte lagts till, detta p.g. a. ett okänt fel.';
$string['usernotaddedregistered'] = 'Användaren har inte lagts till eftersom denne/a redan är registrerad';
$string['usernotavailable'] = 'Detaljerna kring denne användare är inte tillgängliga för Dig.';
$string['usernotdeletederror'] = 'Användaren togs inte bort - okänt fel';
$string['usernotdeletedmissing'] = 'Användaren togs inte bort - det gick inte att hitta användarnamnet.';
$string['usernotdeletedoff'] = 'Användaren har inte tagits bort - det är inte tillåtet att ta bort';
$string['usernotrenamedadmin'] = 'Det går inte att byta namn på ett konto för administratörer';
$string['usernotrenamedexists'] = 'Användarnamnet har inte ändrats eftersom det angivna namnet redan används.';
$string['usernotrenamedmissing'] = 'Användarnamnet har inte ändrats eftersom det inte gick att hitta det gamla namnet.';
$string['usernotrenamedoff'] = 'Användarens namn har inte bytts ut - det är inte tillåtet att ta byta namn.';
$string['usernotupdatedadmin'] = 'Det går inte att uppdatera ett konto för administratörer';
$string['usernotupdatederror'] = 'Användaren har inte uppdaterats - okänt fel';
$string['usernotupdatednotexists'] = 'Användare har inte uppdaterats - den finns inte';
$string['wrongdestpath'] = 'Fel sökväg';
$string['wrongsourcebase'] = 'Fel bas-URL till källan';
$string['wrongzipfilename'] = 'Fel namn på ZIP-filen';
$string['youcannotdeletecategory'] = 'Du kan inte radera kategorin \'{$a}\' för du kan varken radera innehållet eller flytta det.';
