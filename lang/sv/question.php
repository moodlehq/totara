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
 * Strings for component 'question', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminreport'] = 'Rapport över  möjliga problem i Din frågedatabas.';
$string['availableq'] = 'Tillgänglig?';
$string['badbase'] = 'Dålig grund före **:{$a}**';
$string['broken'] = 'Det här är en \'bruten\' länk, den pekar på en fil som inte finns.';
$string['byandon'] = 'av <em>{$a->user}</em> på <em>{$a->time}</em>';
$string['cannotcopybackup'] = 'Det gick inte att kopiera säkerhetskopian';
$string['cannotcreatepath'] = 'Det gick inte att skapa vägen: {$a}';
$string['cannotdeletecate'] = 'Du kan inte ta bort den här kategorin eftersom det är standardkategorin i det här sammanhanget.';
$string['cannotdeletemissingqtype'] = 'Du kan inte ta bort den saknade frågetypen. Den är nödvändig för systemet.';
$string['cannotdeleteqtypeinuse'] = 'Du kan inte ta bort frågetypen \'{$a}\'. Det finns frågor av den här typen i frågebanken.';
$string['cannotdeleteqtypeneeded'] = 'Du kan inte ta bort frågetypen \'{$a}\'. Det finns andra frågetyper installerade som är beroende av denna.';
$string['cannotenable'] = 'Det går inte att skapa frågetypen {$a} direkt.';
$string['cannotfindcate'] = 'Det gick inte att hitta posten för kategori';
$string['cannotfindquestionfile'] = 'Det gick inte att hitta datafilen för frågor i zip-filen';
$string['cannotgetdsfordependent'] = 'Det gick inte att hitta det angivna datasetet för en fråga som är beroende av dataset! (question: {$a->id}, datasetitem: {$a->item})';
$string['cannotgetdsforquestion'] = 'Det gick inte att hitta det angivna datasetet för en kalkylerad fråga! (question: {$a})';
$string['cannotimportformat'] = 'Import av det här formatet är tyvärr ännu inte implementerat!';
$string['cannotinsertquestioncatecontext'] = 'Det gick inte att foga in den nya kategorin {$a->cat} för frågor p g a ett ogiltigt \'contextid\' {$a->ctx}';
$string['cannotloadquestion'] = 'Det gick inte att ladda fråga';
$string['cannotmovequestion'] = 'Du kan inte använda det här skriptet för att flytta frågor som är associerade till filer från olika andra områden.';
$string['cannotopenforwriting'] = 'Det går inte att öppna för att skriva: {$a}';
$string['cannotpreview'] = 'Du kan inte förhandsgranska de här frågorna!';
$string['cannotread'] = 'Det går inte att läsa den importerade filen ({$a}) eller också är den tom';
$string['cannotretrieveqcat'] = 'Det gick att återhämta kategori för frågor';
$string['cannotunzip'] = 'Det gick inte att packa upp filen';
$string['cannotwriteto'] = 'Det går inte att skriva exporterade frågor till {$a}';
$string['categorycurrent'] = 'Aktuell kategori';
$string['categorycurrentuse'] = 'Använd den här kategorin';
$string['categorydoesnotexist'] = 'Den här kategorin finns inte.';
$string['categorymove'] = 'Denna kategori \'{$a->name}\' innehåller {$a->count} frågor.  Var vänlig välj en annan kategori att flytta dem till.';
$string['categorymoveto'] = 'Spara i kategori';
$string['changepublishstatuscat'] = '<a href="{$a->caturl}">Kategorin "{$a->name}"</a> i kursen "{$a->coursename}" kommer att få sin status för gemenskap ändrad från <strong>{$a->changefrom} till {$a->changeto}</strong>';
$string['chooseqtypetoadd'] = 'Välj en frågetyp som Du vill lägga till';
$string['clicktoflag'] = 'Klicka för att flagga den här frågan';
$string['clicktounflag'] = 'Klicka för att av-flagga den här frågan';
$string['contexterror'] = 'Du borde inte ha hamnat här om Du inte håller på att flytta en kategori från ett annat sammanhang';
$string['copy'] = 'Kopiera från {$a} och ändra länkar';
$string['created'] = 'Skapad';
$string['createdby'] = 'Skapad av';
$string['createdmodifiedheader'] = 'Skapad/Senast sparad';
$string['createnewquestion'] = 'Skapa en ny fråga';
$string['cwrqpfs'] = 'Slumpmässiga frågor som väljer frågor ur underkategorier.';
$string['cwrqpfsinfo'] = '<p>I samband med uppgraderingen till Moodle 1.9 kommer vi att fördela frågekategorier på olika sammanhang. En del frågekategorier och frågor på Din webbplats kommer att få sin status angående vad som är gemensamt ändrad. Detta är nödvändigt i det sällsynta fall där en eller fler slumpmässiga frågor i ett test har ställts in från en blandning av gemensamma och separata kategorier, så som är fallet på den här webbplatsen. Detta inträffar när en slumpmässig fråga är inställd till att välja ur underkategorier och en eller flera underkategorier har en annan status angående gemenskap än den föräldrakategori i vilken den slumpmässiga frågan har skapats.</p><p>De följande frågekategorierna, som slumpmässiga frågor i föräldrakategorier väljer frågor ur kommer i samband med uppgradering till Moodle 1.9 att få sin status ändrad till samma gemensamma status som kategorin med  den slumpmässiga frågan i. De följande kategorierna kommer att få sin status som gemensamma ändrad. De frågor som påverkas kommer att fortsätta att  fungera i alla befintliga test ända tills Du tar bort dem från dessa test.</p>';
$string['cwrqpfsnoprob'] = 'Inga frågekategorier på Din webbplats påverkas av funktionen \'Slumpmässiga frågor som väljer frågor ur underkategorier\'.';
$string['defaultfor'] = 'Förinställt standardvärde för {$a}';
$string['defaultinfofor'] = 'Det förinställda standardvärdet för frågor som är gemensamma i sammanhanget \'{$a}\'.';
$string['deletecoursecategorywithquestions'] = 'Det finns frågor i frågebanken associerad med denna kurs kategori. Om du fortsätter kommer de att raderas. Du kanske vill flytta dem först, med hjälp av gränssnittet för frågebanken.';
$string['deleteqtypeareyousure'] = 'Är Du säker på att Du vill ta bort frågetypen \'{$a}\'';
$string['deleteqtypeareyousuremessage'] = 'Du håller på att ta bort frågetypen \'{$a}\' helt och hållet. Är Du säker på att Du vill avinstallera den?';
$string['deletingqtype'] = 'Tar bort frågetypen\'{$a}\'';
$string['disabled'] = 'Avaktiverad';
$string['disterror'] = 'Distributionen {$a} förorsakade problem';
$string['donothing'] = 'Kopiera inte eller flytta filer eller ändra länkar.';
$string['editcategories'] = 'Redigera kategorier';
$string['editingcategory'] = 'Redigerar en kategori';
$string['editingquestion'] = 'Redigerar en fråga';
$string['editthiscategory'] = 'Redigera den här kategorin';
$string['emptyxml'] = 'Okänt fel - tomt imsmanifest.xml';
$string['enabled'] = 'Aktiverad';
$string['erroraccessingcontext'] = 'Det går inte att få tillgång till sammanhanget';
$string['errordeletingquestionsfromcategory'] = 'Fel i sb m borttagande av frågor från kategori {$a}';
$string['errorduringregrade'] = 'Det gick inte att regradera fråga {$a->qid} på väg till läget {$a->stateid}';
$string['errorfilecannotbecopied'] = 'Fel: Det går inte att kopiera filen {$a}.';
$string['errorfilecannotbemoved'] = 'Fel: Det går inte att flytta filen {$a}.';
$string['errorfileschanged'] = 'De fel-filer som har länkats till från frågor har ändrats sedan formuläret visades.';
$string['errormanualgradeoutofrange'] = 'Betyget/omdömet {$a->grade} ligger inte mellan 0 och {$a->maxgrade} för fråga {$a->name}. Resultatet och kommentaren har inte sparats.';
$string['errormovingquestions'] = 'Fel vid flyttning av frågor med id {$a}.';
$string['errorprocessingresponses'] = 'Ett fel uppstod vid behandling av dina svar.';
$string['errorsavingcomment'] = 'Fel vid sparande av kommentar för fråga {$a->name} i databasen.';
$string['errorupdatingattempt'] = 'Fel vid uppdatering av försök {$a->id} i databasen.';
$string['exportcategory'] = 'Kategori för export';
$string['exportcategory_help'] = '**Exportera kategori**
**Kategori:** nedrullningsmenyn kan Du använda för att
välja den kategori som innehåller de frågor som Du vill exportera.
Vissa format för import (GIFT and XML Format) tillåter att
kategorin tas med i den skrivna filen vilket (som alternativ)
gör det möjligt att återskapa kategorierna vid import.
För att dessa data ska tas med så måste Du markera kryssrutan
**Till fil**.';
$string['exportfilename'] = 'quiz';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['exportquestions_help'] = 'Den här funktionen gör det möjligt för Dig att exportera en komplett kategori av frågor till en textfil.
Lägg dock märke till att i många filformat är det så att viss information
försvinner när man exporterar frågorna. Det beror på att det finns många format som inte
stödjer alla de finesser som man kan använda i Moodle-frågor.
Du bör inte förvänta Dig att kunna exportera och importera frågor
samtidigt som Du bevarar dem i exakt samma format.
Vissa typer av frågor kanske inte går att exportera alls.
Du bör alltså testa exporterade frågor innan Du använder dem
i en skarp produktionsmiljö.
De format som f n stödjs är:
**GIFT-formatet**
* GIFT är det mest heltäckande import- och exportformatet som finns när det gäller att
exportera testfrågor av Moodle-typ till en textfil.
Man har utformat det så att det ska vara en enkel metod för lärare att skriva frågor som en textfil.
Det stödjer flervalsfrågor, frågor av typen Sant-Falskt, kortsvar, para-ihop och numeriska frågor.
Det stödjer även test av typen: Vilket är det ord som saknas? Lägg dock märke till att test med inbäddade svar f n
inte stödjs. Olika frågetyper kan blandas i en enda textfil. Formatet stödjer även kommentarer till rader,
namn på frågor och procentviktade betyg/omdömen.
Nedan kommer några exempel:
Vem är begravd i "Grant\'s tomb"?{~Grant ~Jefferson =ingen}
Grant är{~begravd =gravsatt ~lever} i "Grant\'s tomb".
Grant är begravd i "Grant\'s tomb".{FALSE}
Vem är begravd i "Grant\'s tomb"?{=ingen =ingen alls}
När föddes Ulysses S. Grant?{#1822}

**XML-format för Moodle**
Detta för Moodle specifika formatet exporterar testfrågor i ett enkelt XML-format. De kan sedan importeras till en annan kategori av frågor eller användas i någon annan process så som XSLT transformation. XML-formatet kommer att exportera bilder som är kopplade till frågor.
**IMS QTI 2.0**
Exporterar i standardformatet IMS QTI (version 2.0). Lägg märke till att detta skapar en grupp filer inne i en enskild \'zip\'-fil.
[Mer information om IMS QTI](http://www.imsglobal.org/question)
(extern webbplats i nytt fönster)
**XHTML**
Exporterar kategorin som en enskild sida med \'strict\' XHTML. Varje fråga får en klar position inom sina egna taggar. Om du vill använda den här sidan som-den-är så behöver du åtminstone redigera -taggen vid början av -sektionen för att tillhandahålla en lämplig åtgärd (t.ex. ett \'mailto\').
Import och export format är pluggbara resurser. Det kan finnas andra alternativa format i databasen för moduler och plugin-program.
Fler format kommer att tillkomma, vad helst annat som Moodle-användare kan komma att bidra med!';
$string['filecantmovefrom'] = 'Frågefilerna kan inte flyttas eftersom du inte har rättigheter att flytta filer från platsen du försöker att flytta från.';
$string['filecantmoveto'] = 'Frågefilerna kan inte flyttas eller kopieras eftersom du inte har rättigheter att lägga till filer till platsen du försöker att flytta till.';
$string['filesareacourse'] = 'arkiv för kursfiler';
$string['filesareasite'] = 'arkiv för filer på webbplatsnivå';
$string['filestomove'] = 'Flytta/kopiera filer till {$a}?';
$string['fractionsnomax'] = 'Ett av svaren bör ha ett resultat på 100% så att det blir möjligt att få komplett betyg för den här frågan.';
$string['getcategoryfromfile'] = 'Hämta kategori från fil';
$string['getcontextfromfile'] = 'Hämta sammanhang från fil';
$string['ignorebroken'] = 'Ta inte hänsyn till brutna länkar';
$string['invalidcontextinhasanyquestions'] = 'Felaktig kontext skickad till question_context_has_any_questions.';
$string['linkedfiledoesntexist'] = 'Den länkade filen {$a} finns inte.';
$string['makechildof'] = 'Gör om \'{$a}\'  till ett barn';
$string['maketoplevelitem'] = 'Flytta till översta positionen';
$string['missingimportantcode'] = 'Den här frågan saknar viktig kod: {$a}';
$string['modified'] = 'Senast sparad';
$string['move'] = 'Flytta från {$a} och byt länkar';
$string['movecategory'] = 'Flytta kategori';
$string['movedquestionsandcategories'] = 'Flyttade frågor och frågekategorier från {$a->oldplace} till {$a->newplace}.';
$string['movelinksonly'] = 'Ändra bara länkadresserna, flytta inte och kopiera inte filerna.';
$string['moveq'] = 'Flytta fråga/or';
$string['moveqtoanothercontext'] = 'Flytta fråga till ett annat sammanhang';
$string['movingcategory'] = 'Flyttar kategori';
$string['movingcategoryandfiles'] = 'Är Du säker på att Du vill flytta kategorin {$a->name} och alla barn-kategorier till sammanhanget för "{$a->contextto}"?<br />Vi har upptäckt {$a->urlcount} filer som är länkade från frågor i {$a->fromareaname}, skulle Du vilja kopiera eller flytta dessa till {$a->toareaname}?';
$string['movingcategorynofiles'] = 'Är Du säker på att Du vill flytta kategorin "{$a->name}" och alla barn-kategorier till sammanhanget för "{$a->contextto}"?';
$string['movingquestions'] = 'Flyttar frågor och alla typer av filer';
$string['movingquestionsandfiles'] = 'Är Du säker på att Du vill flytta frågorna  {$a->questions}till sammanhanget <strong>"{$a->tocontext}"</strong>?Vi har upptäckt <strong>{$a->urlcount} filer</strong> som är länkade från dessa frågor i {$a->fromareaname}, skulle Du vilja kopiera eller flytta dessa till {$a->toareaname}?';
$string['movingquestionsnofiles'] = 'Är Du säker på att Du vill flytta frågorna  {$a->questions}till sammanhanget <strong>"{$a->tocontext}"</strong>?<br /> Det finns  <strong>inga filer</strong> som är länkade från dessa frågor i {$a->fromareaname}.';
$string['needtochoosecat'] = 'Du måste välja en kategori för att flytta den här frågan eller klicka på \'Avbryt\'.';
$string['nopermissionadd'] = 'Du har inte tillstånd att lägga till frågor här.';
$string['nopermissionmove'] = 'Du har inte rättigheter att flytta frågor härifrån. Du måste spara frågan i denna kategori eller spara den som en ny fråga.';
$string['noprobs'] = 'Det fanns inga problem i Din databas för frågor.';
$string['noquestionsinfile'] = 'Det finns inga frågor i den importerade filen';
$string['notenoughdatatoeditaquestion'] = 'Varken ett fråge-id, en kategori-id eller frågetyp har angivits.';
$string['notenoughdatatomovequestions'] = 'Du måste ange fråge-id för de frågor som Du vill flytta.';
$string['numquestions'] = 'Inga frågor';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} hidden)';
$string['penaltyfactor'] = 'Avdragsfaktor';
$string['penaltyfactor_help'] = 'Du kan ange vilken del (fraktion) av det uppnådda resultatet som bör dras av för varje felaktigt svar. Det här är bara relevant om testet körs i adaptiv form så att studenten/eleven/deltagaren/den lärande har rätt att svara upprepade gånger på frågan. Faktorn för avdrag bör vara ett tal mellan 0 och 1. En faktor för avdrag på 1 betyder att studenten/eleven/deltagaren/den lärande måste svara rätt på frågan i sitt första svar för att överhuvudtaget få tilgodoräkna sig några poäng för frågan. En faktor för avdrag på 0 betyder att studenten/eleven/deltagaren/den lärande kan försöka hur många gånger som helst och ändå få högsta poäng.';
$string['permissionedit'] = 'Redigera den här frågan';
$string['permissionmove'] = 'Flytta den här frågan';
$string['permissionsaveasnew'] = 'Spara det här som en ny fråga';
$string['permissionto'] = 'Du har tillstånd att:';
$string['published'] = 'gemensam';
$string['questionaffected'] = '<a href="{$a->qurl}">Frågan "{$a->name}" ({$a->qtype})</a> finns i den här frågekategorin men den används även i <a href="{$a->qurl}">test "{$a->quizname}"</a> i en annan kurs "{$a->coursename}".';
$string['questionbank'] = 'Frågebank';
$string['questioncategory'] = 'Frågekategori';
$string['questioncatsfor'] = 'Frågekategorier för \'{$a}\'';
$string['questiondoesnotexist'] = 'Den här frågan finns inte.';
$string['questionsmovedto'] = 'Fråga som används flyttad till "{$a}" i överliggande kurskategori.';
$string['questionsrescuedfrom'] = 'Frågor sparade från kontext {$a}.';
$string['questionsrescuedfrominfo'] = 'Dessa frågor (av vilka några kan vara dolda) sparades när kontext {$a} raderades eftersom de fortfarande används av någon quiz eller aktivitet.';
$string['questionuse'] = 'Använd frågan i den här aktiviteten';
$string['selectcategoryabove'] = 'Välj en kategori ovan';
$string['shareincontext'] = 'Dela i sammanhanget för {$a}';
$string['tofilecategory'] = 'Skriv kategori till fil';
$string['tofilecontext'] = 'Skriv sammanhang till fil';
$string['uninstallqtype'] = 'Avinstallera den här frågetypen';
$string['unknown'] = 'Okänd';
$string['unknownquestiontype'] = 'Okänd frågetyp: {$a}';
$string['unpublished'] = 'Inte gemensam';
$string['upgradeproblemcategoryloop'] = 'Problem upptäckt vid uppgradering av frågekategorier. Det finns en loop i kategoriträdet. De påverkade kategoriid är {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'Kunde inte uppdatera frågekategori {$a->name} ({$a->id}).';
$string['upgradeproblemunknowncategory'] = 'Probelm hittat vid uppgradeing av frågekategorier. Kategori {$a->id} refererar till en övre {$a->parent}, som inte finns. Övre kategori ändrad för att lösa problemet.';
$string['yourfileshoulddownload'] = 'Din exportfil borde starta nedladdning strax. Om inte  <a href="{$a}">klicka här</a>. Övre ändrad för att lösa problemet.';
