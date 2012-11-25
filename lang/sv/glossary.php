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
 * Strings for component 'glossary', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   glossary
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcomment'] = 'Lägg till kommentarer';
$string['addentry'] = 'Lägg till bidrag';
$string['addingcomment'] = 'Lägg till en kommentar';
$string['alias'] = 'Nyckelord';
$string['aliases'] = 'Synonymer';
$string['aliases_help'] = 'Varje bidrag kan ha vara kopplat till en lista med synomymer (eller alias).
**Skriv in varje synonym (alias) på en ny rad** (inte separerad med komman).
De ord som används synonymt (alias) kan användas som alternativa sätt att referera till
bidraget.
Till exempel, om Du använder filtret för automatisk länkning av bidrag så kommer synonymerna att användas (liksom bidragets egentliga ledord) när det görs ett val att ord ska länka till detta bidrag.';
$string['allcategories'] = 'Alla kategorier';
$string['allentries'] = 'ALLA';
$string['allowcomments'] = 'Tillåt kommentarer till bidrag';
$string['allowcomments_help'] = 'Du kan ange om det ska vara tillåtet eller inte att kommentera
bidrag till ord- och begreppslistan.
Du kan välja om den egenskapen ska vara aktiverad eller inte.
Distanslärare kan alltid lägga till kommentarer till bidrag till ord- och begreppslistor.';
$string['allowduplicatedentries'] = 'Det är tillåtet med dubblerade bidrag';
$string['allowduplicatedentries_help'] = 'Du kan ange om det ska vara tillåtet eller inte att
lägga till dubletter av bidrag till den aktuella
ord- och begreppslistan.';
$string['allowprintview'] = 'Tillåt visning av utskrift';
$string['allowprintview_help'] = 'Studenter/elever/deltagare/lärande kan få tillåtelse att
använda förhandsgranskning för utskrift av ord- och begreppslista
Du kan välja om Du vill aktivera eller avaktivera detta alternativ
Distanslärare kan alltid använda förhandsgranskning för utskrift.';
$string['andmorenewentries'] = 'och ytterligare {$a} nya bidrag.';
$string['answer'] = 'Svar';
$string['approve'] = 'Godkänn';
$string['areyousuredelete'] = 'Är Du säker på att Du vill ta bort det här bidraget?';
$string['areyousuredeletecomment'] = 'Är Du säker på att Du vill ta bort den här  kommentaren?';
$string['areyousureexport'] = 'Är Du säker på att Du vill exportera det här bidraget till';
$string['ascending'] = '(stigande)';
$string['attachment'] = 'Bifogad fil';
$string['attachment_help'] = 'Som alternativ kan Du bifoga EN fil från Din dator
till varje enskilt bidrag i en ord- och begreppslista.
Denna fil laddas upp till servern och lagras tillsammans
med Ditt bidrag
Detta är användbart när Du vill visa en bild eller ett Word-dokument t.ex.
Denna fil kan vara i valfritt format men rekommendationen är ändå
att filen har ett namn med ett filtillägg på 3 tecken enligt standarden
för Internet som t.ex. .doc, .jpg osv.
Detta underlättar för dem som vill ladda ner och se Dina bilagor i sina
webbläsare.
Om Du redigerar om ett bidrag och bifogar en ny fil så kommer de tidigare
bilagorna till bidraget att ersättas med de nya.
Om Du redigerar om ett bidrag med en bilaga och lämnar detta utrymme
tomt så kommer den ursprungliga bilagan att bli kvar.';
$string['author'] = 'författare';
$string['authorview'] = 'Sök på författare';
$string['back'] = 'Tillbaka';
$string['cantinsertcat'] = 'Det går inte att lägga in en kategori';
$string['cantinsertrec'] = 'Det går inte att lägga in en post i databasen';
$string['cantinsertrel'] = 'Det går inte att lägga in ett bidrag till kategorin som bygger på relation';
$string['casesensitive'] = 'Det här bidraget gör <br />gör skillnad på stor och liten bokstav';
$string['casesensitive_help'] = 'Den här inställningen anger om ett bidrag ska vara sökbart
med exakt samma storlek på bokstäverna som det har för att
det ska länkas automatiskt.
Lägg märke till att detta alternativ inte begränsar det faktum
att ett begrepp kan vara inbäddat i ett annat. Använd alternativet
\'Matcha hela ord\' istället.';
$string['cat'] = 'kategori';
$string['categories'] = 'Kategorier';
$string['category'] = 'Kategori';
$string['categorydeleted'] = 'Borttagen kategori';
$string['categoryview'] = 'Efter kategori';
$string['changeto'] = 'ändra till {$a}';
$string['cnfallowcomments'] = 'Ange huruvida en ord- och begreppslista som standardval ska acceptera kommentarer på bidrag';
$string['cnfallowdupentries'] = 'Ange huruvida en ord- och begreppslista som standardval ska tillåta att man bidrar med dubbletter';
$string['cnfapprovalstatus'] = 'Ange huruvida ett bidrag av studenter/elever/deltagare/lärande som standardval ska accepteras eller ej.';
$string['cnfcasesensitive'] = 'Ange huruvida ett bidrag som standardval ska vara skiftlägeskänsligt när det länkas';
$string['cnfdefaulthook'] = 'Välj visning av standardurvalet när ord- och begreppslistan visas första gången';
$string['cnfdefaultmode'] = 'Välj visning av standardramen när ord- och begreppslistan visas första gången';
$string['cnffullmatch'] = 'Ange huruvida ett bidrag som standardval ska matcha stor/liten bokstav i måltexten när det länkas';
$string['cnflinkentry'] = 'Ange huruvida ett bidrag som standardval ska länkas automatiskt';
$string['cnflinkglossaries'] = 'Ange huruvida en ord- och begreppslista som standardval ska länkas automatiskt';
$string['cnfrelatedview'] = 'Välj visningsformat för automatisk länkning och bidrag';
$string['cnfshowgroup'] = 'Ange om grupp\'brytningen\' ska visas eller inte';
$string['cnfsortkey'] = 'Ange sorteringsnyckeln som standardval';
$string['cnfsortorder'] = 'Ange sorteringsordningen som standardval';
$string['cnfstudentcanpost'] = 'Ange huruvida studenterna/eleverna/deltagarna/de lärande som standardval ska kunna lägga in bidrag';
$string['comment'] = 'Kommentar';
$string['commentdeleted'] = 'Kommentaren har tagits bort';
$string['comments'] = 'Kommentarer';
$string['commentson'] = 'Kommentarer aktiverade';
$string['commentupdated'] = 'Kommentaren har uppdaterats';
$string['completionentries'] = 'Studenter/elever/deltagare/lärande måste lämna bidrag:';
$string['completionentriesgroup'] = 'Gör bidrag obligatoriska';
$string['concept'] = 'Begrepp';
$string['concepts'] = 'Begrepp';
$string['configenablerssfeeds'] = 'Den här omkopplaren kommer att aktivera RSS-inmatning för alla ord- och begreppslistor. Du  måste fortfarande aktivera inmatningarna manuellt i inställningarna för varje enskild ord- och begreppslista.';
$string['current'] = 'För närvarande sorterad {$a}';
$string['currentglossary'] = 'Aktuell ord- och begreppslista';
$string['date'] = 'datum';
$string['dateview'] = 'Bläddra enligt datum';
$string['defaultapproval'] = 'Standardval för godkännande';
$string['defaultapproval_help'] = 'Du kan ange om bidrag från studenter/elever/deltagare/lärande
ska vara automatiskt tillgängliga för alla eller om bidragen först ska
godkännas av (distans)läraren.';
$string['defaulthook'] = 'Förvald \'krok\'';
$string['defaultmode'] = 'Förvalt läge';
$string['defaultsortkey'] = 'Förvald nyckel för sortering';
$string['defaultsortorder'] = 'Förvald ordning för sortering';
$string['definition'] = 'Definition';
$string['definitions'] = 'Definitioner';
$string['deleteentry'] = 'Ta bort bidrag';
$string['deletenotenrolled'] = 'Ta bort bidrag gjorda av användare som inte är registrerade';
$string['deletingcomment'] = 'Tar bort kommentar';
$string['deletingnoneemptycategory'] = 'Om Du tar bort den här kaegorin så bidragen i den inte att tas bort - istället kommer de att markeras som inte-kategoriserade.';
$string['descending'] = '(fallande)';
$string['destination'] = 'Mål för importerade bidrag';
$string['destination_help'] = 'Du kan ange vart Du vill importera ett bidrag:
* **Den aktuella ord- och begreppslistan:** Detta kommer att lägga till de importerade bidragen till
den för tillfället öppna ord- och begreppslistan.
* **Ny ord- och begreppslista:** Detta kommer att skapa en ord- och begreppslista
som baseras på den information som som finns i den markerade importfilen och de nya bidragen kommer att infogas i den.';
$string['displayformat'] = 'Format för visning';
$string['displayformat_help'] = 'Systemet har tre inbyggda format för att visa bidrag.
Du kan skapa Ditt eget format om Du vill.
Standardinställningen innebär en ganska enkel
form av presentation. Det ser ut som en vanlig ordlista (ordboksartikel).
Det andra visningsformatet visar bidraget i ett forumliknande format,
utan data om författaren.
Och det tredje visar också bidraget i i ett forumliknande format,
men med data om författaren.
* * *
Om Du vill skapa Ditt eget format så ska Du skapa en .php-fil
och ge den ett nummer som namn. Titta efter i mod/glossary/format för att
få veta vilket det nästa numret bör vara.
Skapa sedan en funktion som Du kallar
**glossary\_print\_entry\_by\_format($course, $cm, $glossary,
$entry)** och fyll på med all Din kreativitet.
Det sista steget är att lägga in ett bidrag till varje språkpaket
som Du använder. Det kallar Du **displayformat[number]**,
och ger det en meningsfull beskrivning.';
$string['displayformatcontinuous'] = 'Fortlöpande men utan författare';
$string['displayformatdictionary'] = 'Enkel ordboksstil';
$string['displayformatencyclopedia'] = 'Encyklopedi';
$string['displayformatentrylist'] = 'Lista över bidrag';
$string['displayformatfaq'] = 'FAQ';
$string['displayformatfullwithauthor'] = 'Komplett med författare';
$string['displayformatfullwithoutauthor'] = 'Komplett utan författare';
$string['displayformats'] = 'Format för visning';
$string['displayformatssetup'] = 'Visa hur formaten har skapats';
$string['duplicateentry'] = 'Dubblerat bidrag';
$string['editalways'] = 'Redigera alltid';
$string['editalways_help'] = 'Det här alternativet låter Dig avgöra om studenterna/eleverna/deltagarna/de lärande
ska kunna redigera sina bidrag när som helst.
Du kan välja:
* **Ja:** Bidrag går alltid att redigera.
* **Nej:** Bidrag går bara att redigera inom den angivna tiden.';
$string['editcategories'] = 'Redigera kategorier';
$string['editentry'] = 'Redigera bidrag';
$string['editingcomment'] = 'Redigerar kommentar';
$string['entbypage'] = 'Bidrag visade per sida';
$string['entries'] = 'bidrag';
$string['entrieswithoutcategory'] = 'Bidrag utan kategori';
$string['entry'] = 'bidrag';
$string['entryalreadyexist'] = 'Bidraget finns redan';
$string['entryapproved'] = 'Det här bidraget har godkänts';
$string['entrydeleted'] = 'Bidraget är borttaget';
$string['entryexported'] = 'Bidraget har framgångsrikt exporterats';
$string['entryishidden'] = '(det här bidraget är f n dolt)';
$string['entryleveldefaultsettings'] = 'Standardval för inställningar på ingångsnivån';
$string['entrysaved'] = 'Det här bidraget har sparats';
$string['entryupdated'] = 'Det här bidraget har uppdaterats';
$string['entryusedynalink'] = 'Det här bidraget bör<br /> vara automatiskt länkat';
$string['entryusedynalink_help'] = 'Genom att aktivera det här alternativet så kommer bidraget automatiskt
att länkas närhelst begrepp, ord och fraser dyker någon annanstans i samma kurs.
Detta gäller för inlägg i forum, interna resurser, veckovisa sammanfattningar osv.
Om Du inte vill att en viss text ska länkas (i ett inlägg i ett forum t ex)
då bör Du lägga till och taggar runt texten.
För att Du ska kunna aktivera detta alternativ så måste automatisk länkning vara aktiverad på nivån ord- och begreppslista.';
$string['errcannoteditothers'] = 'Du kan inte redigera andra personers bidrag.';
$string['errconceptalreadyexists'] = 'Det här begreppet finns redan med. Det är inte tillåtet med dubbleringar i den här ord- och begreppslistan.';
$string['errdeltimeexpired'] = 'Du kan inte ta bort det här. Tiden har gått ut!';
$string['erredittimeexpired'] = 'Tiden för att redigera det här bidraget har gått ut.';
$string['errorparsingxml'] = 'Det uppstod fel när filen skulle parsas. Säkerställ att det är en giltig syntax för XML.';
$string['explainaddentry'] = 'Lägg till ett nytt bidrag till den aktuella ord- och begreppslistan.<br />\'Begrepp\' och \'definition\' är obligatoriska fält.';
$string['explainall'] = '<b>ALLA</b> kommer att visa alla bidrag på en sida';
$string['explainalphabet'] = 'Välj den sida Du vill söka efter<p>';
$string['explainexport'] = 'En fil har skapats.<br />Ladda ned den och spara den på ett säkert ställe. Du kan importera den när helst Du vill, i den här kursen eller i någon annan.';
$string['explainimport'] = 'Du måste ange vilken fil som ska importeras och villkoren för processen.<p>Skicka in Din förfrågan och titta på resultaten igen.</p>';
$string['explainspecial'] = 'Visa alla begrepp som inte börjar med en bokstav';
$string['exportedentry'] = 'Exporterat bidrag';
$string['exportentries'] = 'Exportera bidrag';
$string['exportentriestoxml'] = 'Exportera bidragen till en XML-fil';
$string['exportfile'] = 'Exportera bidrag till fil';
$string['exportglossary'] = 'Exportera ord- och begreppslista';
$string['exporttomainglossary'] = 'Exportera till den övergripande (förklarande) ord- och begreppslistan';
$string['filetoimport'] = 'Fil att importera';
$string['filetoimport_help'] = 'Markera den XML-fil på Din dator som innehåller de bidrag som Du vill importera.';
$string['fillfields'] = '\'Begrepp\' och definition\' är obligatoriska fält';
$string['filtername'] = 'Länka ord- och begreppslista automatiskt';
$string['fullmatch'] = 'Matcha hela ord bara<br /><small>när de är automatiskt länkade</small>';
$string['fullmatch_help'] = 'Om Du anger att ett bidrag kan länkas automatiskt
från andra resurser, så kommer bara de ord som
matchar detta bidrag fullständigt att länkas.
Om Du ställer in det här alternativet alltså.
Lägg märke till att det här alternativet inte
kräver att bokstäverna har samma storlek. Använd
istället alternativet \'Skiftlägeskänslig\' för det.';
$string['glossary:approve'] = 'Godkänn icke-godkända bidrag';
$string['glossary:comment'] = 'Skapa kommentarer';
$string['glossary:export'] = 'Exportera bidrag';
$string['glossary:exportentry'] = 'Exportera ett enskilt bidrag';
$string['glossary:exportownentry'] = 'Exportera ett enskilt eget bidrag';
$string['glossary:import'] = 'Importera bidrag';
$string['glossary:managecategories'] = 'Administrera kategorier';
$string['glossary:managecomments'] = 'Administrera kommentarer';
$string['glossary:manageentries'] = 'Administrera bidrag';
$string['glossary:rate'] = 'Bedöm/värdera inlägg';
$string['glossary:view'] = 'Visa ord-och begreppslista';
$string['glossary:viewallratings'] = 'Visa alla betyg/omdömen som har avgivits av individer';
$string['glossary:viewanyrating'] = 'Visa alla betyg/omdömen som någon har fått.';
$string['glossary:viewrating'] = 'Visa de sammanlagda bedömningar/värderingar som Du har fått';
$string['glossary:write'] = 'Skapa nya bidrag';
$string['glossaryleveldefaultsettings'] = 'Standardval för inställningar på den globala nivån';
$string['glossarytype'] = 'Typ av ord- och begreppslista';
$string['glossarytype_help'] = 'Systemet tillåter att bidrag exporteras till den övergripande
ord- och begreppslistan för kursen
från vilken sekundär ord- och begreppslista som helst.
För att göra detta bör Du ange vilken ord- och begreppslista det är
som är den övergripande.
OBS! Du kan bara ha en övergripande ord- och begreppslista per kurs.
Före Moodle 1.7, kunde bara (distans)lärare redigera den övergripande ord- och begreppslistan för kursen. I Moodle
1.7 och senare, kan du påverka detta med hjälp av att tilldela användare roller med utökade
rättigheter.';
$string['guestnoedit'] = 'Gäster har inte tillstånd att redigera ord- coh begreppslistor';
$string['importcategories'] = 'Importera kategorier';
$string['importedcategories'] = 'Importerade kategorier';
$string['importedentries'] = 'Importerade bidrag';
$string['importentries'] = 'Importera bidrag';
$string['importentriesfromxml'] = 'Importera bidrag från XML-fil';
$string['includegroupbreaks'] = 'Ta med gruppbrytningar';
$string['isglobal'] = 'Är det här en global ord- och begreppslista?';
$string['isglobal_help'] = 'Systemet med ord- och begreppslistor låter Dig definiera
begrepp som skulle kunna vara tillgängliga på hela
webbsajten. De beskrivs som globala.
Du behöver alltså ange vilken ord- och begreppslista som ska
vara global.
Du kan ha så många globala ord- och begreppslistor Du vill, och
de kan höra till vilken kurs som helst. Alla övriga regler är
giltiga även för den här typen.
Lägg märke till att endast administratörer kan
skapa globala ord- och begreppslistor.';
$string['letter'] = 'bokstav';
$string['linkcategory'] = 'Länka den här kategorin automatiskt';
$string['linkcategory_help'] = 'Du kan ange ifall Du vill att kategorierna ska vara
automatiskt länkade eller inte.
OBS! Länkning av kategorier baseras på skiftlägeskänslig, komplett matchning.';
$string['linking'] = 'Automatisk länkning';
$string['mainglossary'] = 'Den övergripande (förklarande) ord- och begreppslistan';
$string['maxtimehaspassed'] = 'Maxtiden för att redigera den här kommentaren har tyvärr gått ut ({$a})';
$string['modulename'] = 'Ord- och begreppslista';
$string['modulename_help'] = 'Modulen ord- och begreppslista gör det möjligt för deltagare att skapa och underhålla en lista över definitioner. Bidragen går att länka automatiskt varhelst de listade orden och fraserna uppträder i kursen.';
$string['modulenameplural'] = 'Ord- och begreppslistor';
$string['newentries'] = 'Nya bidrag till ord- och begreppslista';
$string['newglossary'] = 'Ny ord- och begreppslista';
$string['newglossarycreated'] = 'En ny ord- och begreppslista har skapats';
$string['newglossaryentries'] = 'Nya bidrag till ord- och begreppslistan';
$string['nocomment'] = 'Kunde inte hitta någon kommentar';
$string['nocomments'] = '(Det gick inte att hitta någon kommentar till det här bidraget)';
$string['noconceptfound'] = 'Det gick inte att hitta något begrepp eller definition';
$string['noentries'] = 'Hittade inga bidrag i den här sektionen';
$string['noentry'] = 'Hittade inget bidrag';
$string['nopermissiontodelcomment'] = 'Du kan inte ta bort andra användares kommentarer!';
$string['nopermissiontodelinglossary'] = 'Du kan inte lämna kommentarer i den här ord- och bergreppslistan!';
$string['nopermissiontoviewresult'] = 'Du kan bara söka resultat i Dina egna bidrag';
$string['notcategorised'] = 'Inte indelad i kategori';
$string['numberofentries'] = 'Antal bidrag';
$string['onebyline'] = '(en per rad)';
$string['pluginadministration'] = 'Administration av ord- och begreppslista';
$string['pluginname'] = 'Ord- och begreppslista';
$string['popupformat'] = 'Popup-format';
$string['printerfriendly'] = 'Utskriftsvänlig version';
$string['printviewnotallowed'] = 'Visning av utskrift är inte tillåten.';
$string['question'] = 'Fråga';
$string['rejectedentries'] = 'Bidrag som inte antagits';
$string['rejectionrpt'] = 'Rapport över icke antagna bidrag';
$string['resetglossaries'] = 'Ta bort bidrag från';
$string['resetglossariesall'] = 'Ta bort bidrag från alla ord- och begreppslistor';
$string['rssarticles'] = 'Antal aktuella RSS-artiklar';
$string['rssarticles_help'] = 'Det här alternativet gör det möjligt för Dig att markera det antal
artiklar som Du vill ta med i RSS-matningen.
Ett antal mellan 5 och 20 bör vara lagom för de flesta ord- och begreppslistor.
Öka detta antal om ord- och begreppslistan används mycket flitigt.';
$string['rsssubscriberss'] = 'Visa RSS-inmatningen för  \'{$a}\' koncept';
$string['rsstype'] = 'RSS-flöde för den här aktiviteten';
$string['rsstype_help'] = 'Det här alternativet låter Dig aktivera RSS-matningar till denna ord- och begreppslista.
Du kan välja mellan två sorters matningar:
* **Med författare:**Om Du använder detta, så kommer de genererade matningarna att ta med
namnet på författaren i varje artikel.
* **Utan författare:**Om Du använder detta, så kommer de genererade matningarna INTE att ta med
namnet på författaren i varje artikel.';
$string['searchindefinition'] = 'Sök i begrepp OCH definitioner?';
$string['secondaryglossary'] = 'sekundär ord- och begreppslista';
$string['showall'] = 'Visa länken \'ALLA\'';
$string['showall_help'] = 'Du kan standardisera de sätt man kan använda
för att söka sig igenom en ord- och begreppslista.
Att söka på kategorier och datum går alltid.
Du kan dock ange ytterligare tre alternativ:
**VISA SPECIAL**
Aktivera eller avaktivera sökning med hjälp av
specialtecken som @, #, etc.
**VISA ALFABETET**
Aktivera eller avaktivera sökning med hjälp av bokstäver.
**VISA ALLA**
Aktivera eller avaktivera sökning med hjälp av att
visa alla bidrag på en gång.';
$string['showalphabet'] = 'Visa alfabetet';
$string['showalphabet_help'] = 'Du kan standardisera de sätt man kan använda
för att söka sig igenom en ord- och begreppslista.
Att söka på kategorier och datum går alltid.
Du kan dock ange ytterligare tre alternativ:
**VISA SPECIAL**
Aktivera eller avaktivera sökning med hjälp av
specialtecken som @, #, etc.
**VISA ALFABETET**
Aktivera eller avaktivera sökning med hjälp av bokstäver.
**VISA ALLA**
Aktivera eller avaktivera sökning med hjälp av att
visa alla bidrag på en gång.';
$string['showspecial'] = 'Visa länken \'Special\'';
$string['showspecial_help'] = 'Du kan standardisera de sätt man kan använda
för att söka sig igenom en ord- och begreppslista.
Att söka på kategorier och datum går alltid.
Du kan dock ange ytterligare tre alternativ:
**VISA SPECIAL**
Aktivera eller avaktivera sökning med hjälp av
specialtecken som @, #, etc.
**VISA ALFABETET**
Aktivera eller avaktivera sökning med hjälp av bokstäver.
**VISA ALLA**
Aktivera eller avaktivera sökning med hjälp av att
visa alla bidrag på en gång.';
$string['sortby'] = 'Sortera efter';
$string['sortbycreation'] = 'Enligt datum för tillkomst';
$string['sortbylastupdate'] = 'Enligt senaste uppdateringen';
$string['sortchronogically'] = 'Sortera kronologiskt';
$string['special'] = 'Special';
$string['standardview'] = 'Standardvy';
$string['studentcanpost'] = 'Studenter/elever/deltagare/lärande kan lägga till bidrag';
$string['totalentries'] = 'Totalt antal bidrag';
$string['usedynalink'] = 'Länka bidrag automatiskt';
$string['usedynalink_help'] = '**Att automatiskt länka ord- och begreppslistor till andra moduler **
Om Du anger att en ord- och begreppslista ska länkas automatiskt så
kommer de berörda bidragen automatiskt att länkas närhelst de
dyker upp i andra resurser (forum, kommentarer osv)
Om Du inte vill att ett visst bidrag ska länkas
så bör Du bädda in det mellan taggarna och i HTML-(käll)koden.
Om det är en kategori som har hittats så kommer den också
att länkas. Lägg märke till att länkning av kategorier
är skiftlägeskänsligt.';
$string['waitingapproval'] = 'Väntar på att bli accepterad';
$string['warningstudentcapost'] = '(Gäller bara om det inte handlar om den övergripande ord- och  begreppslistan';
$string['withauthor'] = 'Begrepp med författare';
$string['withoutauthor'] = 'Begrepp utan författare';
$string['writtenby'] = 'Av';
$string['youarenottheauthor'] = 'Det är inte Du som har författat den här kommentaren och därför får Du inte redigera den.';
