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
 * Strings for component 'scorm', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   scorm
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activation'] = 'Aktivering';
$string['activityloading'] = 'Du kommer automatiskt att bli vidarekopplad till aktiviteten i';
$string['activitypleasewait'] = 'Aktiviteten laddas, var snäll och vänta...';
$string['advanced'] = 'Avancerad';
$string['allowapidebug'] = 'Aktivera debugging och spårning av API (ställ in "fånga in"-maskaren med apidebugmask)';
$string['allowtypeexternal'] = 'Aktivera paket av extern typ';
$string['allowtypeimsrepository'] = 'Aktivera typen IMS-paket';
$string['allowtypelocalsync'] = 'Aktivera nedladdad pakettyp';
$string['apidebugmask'] = '"Fånga in"-maskare för API  - använd ett enkelt regex på <username>:<activityname> t ex admin:.* det kommer att debugga endast för admin användare';
$string['areacontent'] = 'Innehållsfiler';
$string['areapackage'] = 'Paketfil';
$string['asset'] = 'Tillgång';
$string['assetlaunched'] = 'Tillgång - visad';
$string['attempt'] = 'försök';
$string['attempt1'] = '1 försök';
$string['attempts'] = 'Försök';
$string['attemptsx'] = '{$a} försök';
$string['attr_error'] = 'Olämpligt värde för attributet ({$a->attr}) i taggen {$a->tag}.';
$string['autocontinue'] = 'Fortsätt automatiskt';
$string['autocontinue_help'] = '**Fortsätt automatiskt**
Om "Fortsätt automatiskt" är aktiverat (Ja) så kommer nästa tillgängliga SCORM att automatiskt startas när den föregående är slutförd.
Om detta inte är aktiverat (Nej) måste användaren själv använda knappen "Fortsätt" för att gå vidare.';
$string['autocontinuedesc'] = 'Det här alternativet anger standard för automatisk fortsättning för aktiviteten.';
$string['averageattempt'] = 'Medel av försök';
$string['badmanifest'] = 'Några fel med manifestet: se loggarna över fel';
$string['badpackage'] = 'Det angivna paketet/manifestet är inte giltigt. Kontrollera det och försök igen.';
$string['browse'] = 'Bläddra';
$string['browsed'] = 'Genombläddrad';
$string['browsemode'] = 'Läge för förhandsgranskning';
$string['browserepository'] = 'Bläddra i arkivet';
$string['cannotfindsco'] = 'Det gick inte att hitta någon SCO.';
$string['chooseapacket'] = 'Välj eller uppdatera ett SCORM-paket';
$string['completed'] = 'Slutfört';
$string['completionscorerequired'] = 'Kräv minimumpoäng';
$string['completionstatus_completed'] = 'Färdig';
$string['completionstatus_failed'] = 'Misslyckades';
$string['completionstatus_passed'] = 'Godkänd';
$string['completionstatusrequired'] = 'Kräv status';
$string['confirmloosetracks'] = 'Varning! Paketet verkar ha blivit ändrat eller modifierat. Om strukturen på paketet har ändrats så kan vissa användares spår komma att gå förlorade under uppdateringsprocessen.';
$string['contents'] = 'Innehåll';
$string['coursepacket'] = 'Kurspaket';
$string['coursestruct'] = 'Struktur på kurs';
$string['currentwindow'] = 'Aktuellt fönster';
$string['datadir'] = 'Fel i filsystemet: det går inte att skapa en datakatalog för kursen';
$string['deleteallattempts'] = 'Ta bort alla fösök på SCORM';
$string['deleteattemptcheck'] = 'Är Du helt säker på att Du vill ta bort de här försöken helt och hållet?';
$string['details'] = 'Detaljerad SCO spårning';
$string['directories'] = 'Visa katalogens länkar';
$string['display'] = 'Visa';
$string['displayattemptstatus'] = 'Visa status angående försök';
$string['displayattemptstatus_help'] = 'Om detta är aktiverat så kommer resultat och betyg för försök att visas på "outline"-sidan för SCORM.';
$string['displayattemptstatusdesc'] = 'Det här alternativet anger hur status angående försök ska visas.';
$string['displaycoursestructure'] = 'Visa kursens struktur på ingångssidan';
$string['displaycoursestructure_help'] = 'Om detta är aktiverat så kommer tabellen över innehåll att visas på "outline"-sidan för SCORM.';
$string['displaycoursestructuredesc'] = 'Det här alternativet anger hur(uvida) kursstrukturen ska visas på ingångssidan (eller inte).';
$string['displaydesc'] = 'Det här alternativet anger huruvida paketet för en viss aktivitet ska ska visas eller inte.';
$string['domxml'] = 'DOMXML externt bibliotek';
$string['duedate'] = 'Sista inskickningsdatum';
$string['element'] = 'Element';
$string['enter'] = 'Mata in';
$string['entercourse'] = 'Mata in en SCORM-kurs';
$string['errorlogs'] = 'Logg över fel';
$string['everyday'] = 'Varje dag';
$string['everytime'] = 'Varje gång som det används';
$string['exceededmaxattempts'] = 'Du har redan använt samtliga tillåtna försök.';
$string['exit'] = 'Avsluta SCORM-kurs';
$string['exitactivity'] = 'Avsluta aktivitet';
$string['expired'] = 'Den här aktiviteten är tyvärr avslutad den {$a} och den är inte längre tillgänglig';
$string['external'] = 'Tajming för uppdatering av externa paket';
$string['failed'] = 'Det fungerade inte';
$string['finishscorm'] = 'Om Du är färdig med visningen av den här resursen, {$a}';
$string['finishscormlinkname'] = 'klicka här för att återgå till kurssidan';
$string['firstaccess'] = 'Första tillfället att använda';
$string['firstattempt'] = 'Första försöket';
$string['forcecompleted'] = 'Framtvinga ett fullföljande';
$string['forcecompleteddesc'] = 'Det här alternativet anger huruvida framtvingande av fullföljande ska gälla eller inte';
$string['forcejavascript'] = 'Tvinga användarna att aktivera JavaScript';
$string['forcenewattempt'] = 'Framtvinga ett nytt försök';
$string['forcenewattemptdesc'] = 'Det här alternativet anger vad som ska gälla angående framtvingande av nytt försök.';
$string['found'] = 'Manifestet hittades';
$string['frameheight'] = 'Det här alternativet ställer in höjden på ramen på en SCO';
$string['framewidth'] = 'Den här inställningen avgör standardbredden på en SCO-ram';
$string['fullscreen'] = 'Fyll hela skärmen';
$string['general'] = 'Allmänna data';
$string['gradeaverage'] = 'Medelbetyg/omdöme';
$string['gradeforattempt'] = 'Betyg/omdöme för försök';
$string['gradehighest'] = 'Högsta betyg/omdöme';
$string['grademethod'] = 'Metod för betyg/omdömen';
$string['grademethod_help'] = 'De resultat av en SCORM/AICC aktivitet som visas på sidan för betyg kan graderas med många olika mått:
* Lärobjekt - Antalet genomförda/godkända lärobjekt för aktiviteten. Maxvärdet är det totala antalet lärobjekt.
* Högsta betyget - Det högsta resultat som har uppnåtts av användare i alla godkända lärobjekt.
* Medelbetyg - Medelvärdet av alla resultat.
* Sammanlagt betyg - Alla resultat läggs ihop.';
$string['grademethoddesc'] = 'Det här alternativet anger vilken metod för betygssättning som ska gälla för en aktivitet.';
$string['gradescoes'] = 'Lärobjekt';
$string['gradesum'] = 'Summera betyg/omdöme(n)';
$string['height'] = 'Höjd';
$string['hidden'] = 'Dold';
$string['hidebrowse'] = 'Dölj knappen för förhandsgranskning';
$string['hidebrowsedesc'] = 'Det här alternativet anger huruvida läget för förhandsgranskning ska aktiveras eller inte.';
$string['hideexit'] = 'Dölj länken \'avsluta\'';
$string['hidenav'] = 'Dölj knapparna för navigation';
$string['hidenavdesc'] = 'Det här alternativet anger huruvida knapparna för navigation ska visas eller inte.';
$string['hidereview'] = 'Dölj knappen \'Visa igen\'';
$string['hidetoc'] = 'Visa inte kursstrukturen i spelarens fönster';
$string['hidetocdesc'] = 'Det här alternativet anger huruvida kursstrukturen (Innehållet) ska visas i SCORM-spelaren eller inte.';
$string['highestattempt'] = 'Högsta försöket';
$string['identifier'] = 'Identifierare för fråga';
$string['incomplete'] = 'Inte komplett';
$string['info'] = 'Info';
$string['interactions'] = 'Interaktioner';
$string['last'] = 'Senaste åtkomst den';
$string['lastaccess'] = 'Senaste tillfället att använda';
$string['lastattempt'] = 'Senaste försöket';
$string['lastattemptlock'] = 'Lås efter det sista försöket';
$string['lastattemptlockdesc'] = 'Det här alternativet anger standardvärdet för låsningen efter det avslutande försöket.';
$string['location'] = 'Visa en rad som visar placeringen';
$string['max'] = 'Max resultat';
$string['maximumattempts'] = 'Antal försök';
$string['maximumattempts_help'] = 'Här anger du det antal försök som användarna får göra
Det fungerar bara med SCORM1.2- och AICC-paket. SCORM2004 har ett eget sätt att definiera max antal försök.';
$string['maximumattemptsdesc'] = 'Denna inställning sätter standard för maximalt antal försök för en aktivitet';
$string['maximumgradedesc'] = 'Det här alternativet anger maxbetyget för en aktivitet.';
$string['menubar'] = 'Visa menyraden';
$string['min'] = 'Min resultat';
$string['missing_attribute'] = 'Saknat attribut {$a->attr} i taggen {$a->tag}';
$string['missing_tag'] = 'Saknad tagg {$a->tag}';
$string['missingparam'] = 'Ett element som är obligatoriskt saknas eller felaktigt.';
$string['mode'] = 'Läge';
$string['modulename'] = 'Scormpaket';
$string['modulenameplural'] = 'Scormpaket (flera)';
$string['navigation'] = 'Navigation';
$string['newattempt'] = 'Påbörja ett nytt försök';
$string['next'] = 'Fortsätt';
$string['no_attributes'] = 'Taggen {$a->tag} måste ha attribut';
$string['no_children'] = 'Taggen {$a->tag} måste ha barn';
$string['noactivity'] = 'Inget att rapportera';
$string['noattemptsallowed'] = 'Antal tillåtna försök';
$string['noattemptsmade'] = 'Antal försök som Du har genomfört';
$string['nolimit'] = 'Obegränsade försök';
$string['nomanifest'] = 'Kunde inte hitta manifest';
$string['noprerequisites'] = 'Du har tyvärr inte uppnått tillräckligt många av förkunskapskraven för att få tillgång till det här lärobjektet.';
$string['noreports'] = 'Ingen rapport att visa';
$string['normal'] = 'Normal';
$string['noscriptnoscorm'] = 'Din webbläsare stödjer inte javaskript eller så är javaskript inte aktiverat. Därför är det inte säkert att data från det här SCORM-paketet kommer att spelas upp eller sparas på ett korrekt sätt.';
$string['not_corr_type'] = 'Felaktig matchning av datatyp för taggen  {$a->tag}';
$string['notattempted'] = 'Inget försök';
$string['objectives'] = 'Mål';
$string['optallstudents'] = 'alla användare';
$string['optattemptsonly'] = 'endast användare som gjort försök';
$string['options'] = 'Alternativ (inte tillgängliga i alla typer av webbläsare)';
$string['optnoattemptsonly'] = 'Endast användare som inte har gjort några försök';
$string['organization'] = 'Organisation';
$string['organizations'] = 'Organisationer';
$string['othersettings'] = 'Kompletterande inställningar';
$string['othertracks'] = 'Andra spår';
$string['package'] = 'Paketfil';
$string['package_help'] = '**Paketfiler**
Paketet är en specifik fil med ett **zip** (eller pif) som filnamnstillägg och som innehåller giltiga filer som definierar kurser av typen AICC eller SCORM.
Ett **SCORM** paket måste innehålla en fil med namnet **imsmanifest.xml** som ska ligga i roten på den zippade filen. Imsmanifestet innehåller en beskrivning av SCORM-kursens struktur, placeringen av resurser och många andra saker.
Ett **AICC**-paket definieras av åtskilliga filer (mellan 4 och 7) med definierade filnamnstillägg.
Här kan Du se vad filnamnstilläggen betyder:
* CRS - \'Course Description file\' - fil som beskriver kursen (obligatorisk)
* AU - \'Assignable Unit file\' (obligatorisk)
* DES - \'Descriptor file\' (obligatorisk)
* CST - \'Course Structure file\' - fil som beskriver kursens struktur (obligatorisk)
* ORE - \'Objective Relationship file\' - fil för relationer mellan mål(valfritt)
* PRE - \'Prerequisites file\' - fil för förkunskaper (valfritt)
* CMP - \'Completition Requirements file\' - fil som innehåller krav på fullföljande (valfritt)';
$string['packagedir'] = 'Fel i filsystemet: det går inte att skapa en katalog för paketet';
$string['packagefile'] = 'Ingen paketfil har angivits';
$string['packageurl'] = 'URL';
$string['pagesize'] = 'Storlek på sida';
$string['passed'] = 'Genomförd';
$string['php5'] = 'PHP 5 (DOMXML ursprungligt (native) bibliotek)';
$string['pluginadministration'] = 'Administration av SCORM/AICC';
$string['pluginname'] = 'SCORM-paket';
$string['popup'] = 'Öppna den aktuella SCO i ett nytt fönster';
$string['popupmenu'] = 'I en nedrulllningsmeny';
$string['popupopen'] = 'Öppna paketet i ett nytt fönster';
$string['position_error'] = '{$a->tag} taggen kan inte vara "child" till {$a->parent} taggen';
$string['preferencespage'] = 'Preferenser endast för denna sida';
$string['preferencesuser'] = 'Preferenser för den här rapporten';
$string['prev'] = 'Föregående';
$string['raw'] = 'Råa data för resultat';
$string['regular'] = 'Normalt manifest';
$string['report'] = 'Rapport';
$string['reportcountattempts'] = '{$a->nbresults} resultat ({$a->nbusers} users)';
$string['resizable'] = 'Tillåt användaren att ändra storleken på fönstret';
$string['result'] = 'Resultat';
$string['results'] = 'Resultat';
$string['review'] = 'Visa igen';
$string['reviewmode'] = 'Läge för granskning';
$string['scoes'] = 'Lärobjekt';
$string['score'] = 'Resultat';
$string['scorm:deleteresponses'] = 'Ta bort försök med SCORM';
$string['scorm:savetrack'] = 'Spara spårning';
$string['scorm:skipview'] = 'Hoppa över översikten';
$string['scorm:viewreport'] = 'Visa rapporter';
$string['scorm:viewscores'] = 'Visa resultat';
$string['scormclose'] = 'Tills';
$string['scormcourse'] = 'Lärokurs';
$string['scormloggingoff'] = 'Loggning av API är avaktiverat';
$string['scormloggingon'] = 'Loggning av API är aktiverat';
$string['scormopen'] = 'Öppen';
$string['scormresponsedeleted'] = 'Tog bort försök  av användare';
$string['scormtype'] = 'Typ';
$string['scrollbars'] = 'Tillåt användaren att rulla fönstret';
$string['selectall'] = 'Välj alla';
$string['selectnone'] = 'Avmarkera alla';
$string['show'] = 'Visa';
$string['sided'] = 'På sidan';
$string['skipview'] = 'Student kan hoppa över sidan som visar innehållets struktur';
$string['skipview_help'] = 'Om du lägger till ett paket med bara ett lärobjekt i så kan du välja att automatiskt hoppa över sidan som visar strukturen på innehållet när användare klickar på en SCORM-aktivitet på kursens sida.
Du kan välja:

* Hoppa **Aldrig** över sidan som visar strukturen på innehållet.
* hoppa över sidan som visar strukturen på innehållet endast **Vid första visningen** (den första gången som användaren visar SCORM-paketet).
* Hoppa **Alltid** över sidan som visar strukturen på innehållet.';
$string['skipviewdesc'] = 'Denna inställning sätter standard för när innehållsstrukturen för en sida skall hoppas över';
$string['slashargs'] = 'VARNING: slash-argument är inaktiverade på denna site och saker kanske inte fungerar som väntat!';
$string['stagesize'] = 'Storlek på ram/fönster';
$string['stagesize_help'] = 'De här två inställningarna definierar höjden och bredden på ramen för lärobjektet.';
$string['started'] = 'Storlek på scen';
$string['status'] = 'Status';
$string['statusbar'] = 'Visa statusraden';
$string['student_response'] = 'Svarsreaktion';
$string['suspended'] = 'Avstängd';
$string['syntax'] = 'Syntaxfel';
$string['tag_error'] = 'Okänd tagg ({$a->tag}) med detta innehåll: {$a->value}';
$string['time'] = 'Tid';
$string['title'] = 'Titel';
$string['toc'] = 'Innehåll';
$string['too_many_attributes'] = 'Taggen {$a->tag} har för många attribut';
$string['too_many_children'] = 'Taggen {$a->tag} har för många barn';
$string['toolbar'] = 'Visa verktygsraden';
$string['totaltime'] = 'Tid';
$string['trackingloose'] = 'VARNING: spårningsdata till detta SCORM-paket kommer att försvinna!';
$string['type'] = 'Typ';
$string['unziperror'] = 'Ett fel inträffade i samband med att paketet skulle packas upp.';
$string['updatefreq'] = 'Intervall då automatisk uppdatering ska ske';
$string['updatefreqdesc'] = 'Denna inställning sätter standard auto-uppdateringsfrekvens för en aktivitet';
$string['validateascorm'] = 'Validera ett SCORM-paket';
$string['validation'] = 'Resultat av validering';
$string['validationtype'] = 'Den här inställningen innebär att  DOMXML-biblioteket används för att validera SCORM-manifesten. Om Du inte vet hur du ska göra så behåll det markerade valet.';
$string['value'] = 'Värde';
$string['versionwarning'] = 'Den här versionen av manifestet är äldre än 1.3, varning vid {$a->tag} taggen';
$string['viewallreports'] = 'Visa rapporter för {$a} försök';
$string['viewalluserreports'] = 'Visa rapporter för {$a} användare';
$string['whatgrade'] = 'Bedömning/betygssättning av försök';
$string['whatgrade_help'] = 'När du tillåter att användare att göra flera försök så kan du välja hur du ska använda resultatet av försöken när de ska infogas i betygskatalogen.';
$string['whatgradedesc'] = 'Denna inställnings sätter standard för antal betygsförsök';
$string['width'] = 'Bredd';
$string['window'] = 'ram/fönster';
