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
 * Strings for component 'workshop', language 'nl', branch 'MOODLE_22_STABLE'
 *
 * @package   workshop
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Toegangscontrole';
$string['aggregategrades'] = 'Cijfers herrekenen';
$string['aggregation'] = 'Cijferaggregatie';
$string['allocate'] = 'Inzendingen toewijzen';
$string['allocatedetails'] = 'verwacht: {$a->expected}<br />ingestuurd: {$a->submitted}<br />toe te wijzen: {$a->allocate}';
$string['allocation'] = 'Inzending toewijzen';
$string['allocationdone'] = 'Toewijzing klaar';
$string['allocationerror'] = 'Toewijzingsfout';
$string['allsubmissions'] = 'Alle inzendingen';
$string['alreadygraded'] = 'Al beoordeeld';
$string['areainstructauthors'] = 'Instructies voor insturen';
$string['areainstructreviewers'] = 'Instructies voor evaluatie';
$string['areasubmissionattachment'] = 'Bijlagen van de inzending';
$string['areasubmissioncontent'] = 'Teksten van de inzending';
$string['assess'] = 'Evalueer';
$string['assessedexample'] = 'Ingestuurd evaluatievoorbeeld';
$string['assessedsubmission'] = 'Geëvalueerde inzending';
$string['assessingexample'] = 'Evalueer voorbeeldinzending';
$string['assessingsubmission'] = 'Evalueer inzending';
$string['assessment'] = 'Evaluatie';
$string['assessmentby'] = 'door <a href="{$a->url}">{$a->name}</a>';
$string['assessmentbyfullname'] = 'Evaluatie door {$a}';
$string['assessmentbyyourself'] = 'Jouw evaluatie';
$string['assessmentdeleted'] = 'Evaluatie niet meer toegewezen';
$string['assessmentend'] = 'Deadline voor evaluatie';
$string['assessmentenddatetime'] = 'Beoordelingsdeadline: {$a->daydatetime} ({$a->distanceday})';
$string['assessmentendevent'] = '{$a} (beoordelingsdeadline)';
$string['assessmentform'] = 'Evaluatievorm';
$string['assessmentofsubmission'] = '<a href="{$a->assessmenturl}">Beoordeling</a> van <a href="{$a->submissionurl}">{$a->submissiontitle}</a>';
$string['assessmentreference'] = 'Referentiebeoordeling';
$string['assessmentreferenceconflict'] = 'Het is niet mogelijk om een voorbeeldtaak te beoordelen waarvoor je een referentiebeoordeling hebt voorzien.';
$string['assessmentreferenceneeded'] = 'Je moet deze voorbeeldinzending beoordelen om een referentiebeoordeling te maken. Klik op de "Ga verder"-knop om de inzending te beoordelen.';
$string['assessmentsettings'] = 'Beoordelingsinstellingen';
$string['assessmentstart'] = 'Open voor beoordeling vanaf';
$string['assessmentstartdatetime'] = 'Open voor beoordeling van {$a->daydatetime} ({$a->distanceday})';
$string['assessmentstartevent'] = '{$a} (gaat open voor beoordeling)';
$string['assessmentweight'] = 'Weging evaluatie';
$string['assignedassessments'] = 'Toegewezen inzendingen om te beoordelen';
$string['assignedassessmentsnone'] = 'Je hebt geen inzending toegewezen om te evalueren';
$string['backtoeditform'] = 'Terug naar bewerkscherm';
$string['byfullname'] = 'door <a href="{$a->url}">{$a->name}</a>';
$string['calculategradinggrades'] = 'Bereken beoordelingscijfers';
$string['calculategradinggradesdetails'] = 'verwacht: {$a->expected}<br />berekend: {$a->calculated}';
$string['calculatesubmissiongrades'] = 'Bereken de inzendingscijfers';
$string['calculatesubmissiongradesdetails'] = 'verwacht: {$a->expected}<br />berekend: {$a->calculated}';
$string['chooseuser'] = 'Kies gebruiker...';
$string['clearaggregatedgrades'] = 'Maak alle geaggregeerde cijfers leeg';
$string['clearaggregatedgrades_help'] = 'De geaggreerde cijfers voor inzending en cijfers voor beoordeling zullen gereset worden. Je kunt deze cijfers opnieuw laten berekenen in de beoordelingsfase.';
$string['clearaggregatedgradesconfirm'] = 'Ben je er zeker van dat je alle berekende cijfers voor inzendingen en beoordelingen wil wissen?';
$string['clearassessments'] = 'Beoordelingen leegmaken';
$string['clearassessments_help'] = 'De berekende cijfers voor insturen en cijfers voor beoordeling zullen gereset worden. De informatie over hoe de beoordelingsformulieren gevuld zijn, wordt behouden, maar alle beoordelaars moeten het beoordelingsformulier opnieuw openen en bewaren om de gegeven cijfers te laten herberekenen';
$string['clearassessmentsconfirm'] = 'Ben je er zeker van dat je alle beoordelingscijfers wil wissen? Je kunt deze informatie niet terughalen - beoordelaars zullen de toegewezen taken opnieuw moeten beoordelen.';
$string['configexamplesmode'] = 'Standaardmodus voor de beoordeling van voorbeeldtaken in Workshops';
$string['configgrade'] = 'Standaard maximumcijfer voor een taak in Workshop';
$string['configgradedecimals'] = 'Standaard maximum aantal decimalen bij het tonen van cijfers';
$string['configgradinggrade'] = 'Standaard maximumcijfer voor een beoordeling in Workshops';
$string['configmaxbytes'] = 'Standaard maximum bestandsgrootte voor taken voor alle Workshops op de site (ook afhankelijk van cursuslimieten en andere lokale instellingen)';
$string['configstrategy'] = 'Standaard beoordelingsstrategie voor Workshops';
$string['createsubmission'] = 'Insturen';
$string['daysago'] = '{$a} dagen geleden';
$string['daysleft'] = '{$a} dagen resterend';
$string['daystoday'] = 'vandaag';
$string['daystomorrow'] = 'morgen';
$string['daysyesterday'] = 'gisteren';
$string['deadlinesignored'] = 'Tijdsbeperkingen gelden niet voor jou';
$string['editassessmentform'] = 'Bewerk beoordelingsformulier';
$string['editassessmentformstrategy'] = 'Bewerk beoordelingsformulier ({$a})';
$string['editingassessmentform'] = 'Beoordelingsformulier  bewerken';
$string['editingsubmission'] = 'Inzending bewerken';
$string['editsubmission'] = 'Bewerk inzending';
$string['err_multiplesubmissions'] = 'Terwijl je op deze pagina aan het werken was, is er een nieuwe versie van de taak bewaard. Meerdere inzendingen per gebruiker zijn niet toegestaan.';
$string['err_removegrademappings'] = 'Kan de ongebruikte cijferkoppelingen niet verwijderen';
$string['evaluategradeswait'] = 'Wacht tot de beoordelingen geëvalueerd zijn en tot de cijfers berekend zijn.';
$string['evaluation'] = 'Evaluatie van de beoordeling';
$string['evaluationmethod'] = 'Methode voor de evaluatie van de beoordeling';
$string['evaluationmethod_help'] = 'De beoordelingsevaluatiemethode bepaalt hoe de cijfers voor de beoordeling berekend worden. Er is op dit ogenblik slechts één optie - vergelijking met de beste beoordeling.';
$string['example'] = 'Voorbeeldtaak';
$string['exampleadd'] = 'Voeg een voorbeeldtaak toe';
$string['exampleassess'] = 'Beoordeel voorbeeldtaak';
$string['exampleassessments'] = 'Te beoordelen voorbeeldtaak';
$string['exampleassesstask'] = 'Beoordeel voorbeeldtaken';
$string['exampleassesstaskdetails'] = 'verwacht: {$a->expected}<br />beoordeeld: {$a->assessed}';
$string['examplecomparing'] = 'Beoordelingen van voorbeeldtaak vergelijken';
$string['exampledelete'] = 'Verwijder voorbeeld';
$string['exampledeleteconfirm'] = 'Weet je zeker dat je volgende voorbeeldtaak wil verwijderen? Klik op de \'Ga verder\'-knop om de inzending te verwijderen.';
$string['exampleedit'] = 'Bewerk voorbeeld';
$string['exampleediting'] = 'Voorbeeld bewerken';
$string['exampleneedassessed'] = 'Je moet eerst alle voorbeeldtaken beoordelen';
$string['exampleneedsubmission'] = 'Je moet eerst je eigen werk insturen en alle voorbeeldtaken beoordelen';
$string['examplesbeforeassessment'] = 'Er zijn voorbeelden ter beschikking nadat je je eigen taak ingestuurd hebt en die voorbeelden moeten beoordeeld worden voor je zelf aan peer-beoordeling kunt doen.';
$string['examplesbeforesubmission'] = 'De voorbeelden moeten beoordeeld worden voor je  eigen taak';
$string['examplesmode'] = 'Modus voor de beoordeling van voorbeeldtaken';
$string['examplesubmissions'] = 'Voorbeeldinzendingen';
$string['examplesvoluntary'] = 'Het beoordelen van een voorbeeldtaak is op vrijwillige basis';
$string['feedbackauthor'] = 'Feedback voor de auteur';
$string['feedbackby'] = 'Feedback door {$a}';
$string['feedbackreviewer'] = 'Feedback voor de beoordeler';
$string['formataggregatedgrade'] = '{$a->grade}';
$string['formataggregatedgradeover'] = '<del>{$a->grade}</del><br /><ins>{$a->over}</ins>';
$string['formatpeergrade'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span>';
$string['formatpeergradeover'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span>';
$string['formatpeergradeoverweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span> @ <span class="weight">{$a->weight}</span>';
$string['formatpeergradeweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span> @ <span class="weight">{$a->weight}</span>';
$string['givengrades'] = 'Gegeven cijfers';
$string['gradecalculated'] = 'Berekende cijfers voor de taak';
$string['gradedecimals'] = 'Aantal decimalen in cijfers';
$string['gradegivento'] = '&gt;';
$string['gradeinfo'] = 'Cijfer: {$a->received} op {$a->max}';
$string['gradeitemassessment'] = '{$a->workshopname} (Beoordeling)';
$string['gradeitemsubmission'] = '{$a->workshopname} (taak)';
$string['gradeover'] = 'Cijfer voor taak overschrijven';
$string['gradereceivedfrom'] = '&lt;';
$string['gradesreport'] = 'Workshop cijfer rapport';
$string['gradinggrade'] = 'Cijfer voor evaluatie';
$string['gradinggrade_help'] = 'Deze instelling bepaalt het maximum cijfer dat kan behaald worden voor de beoordeling van een taak.';
$string['gradinggradecalculated'] = 'Berekend cijfer voor beoordeling';
$string['gradinggradeof'] = 'Cijfer voor beoordeling (van {$a})';
$string['gradinggradeover'] = 'Overschrijf cijfer voor beoordeling';
$string['gradingsettings'] = 'Beoordelingsinstellingen';
$string['iamsure'] = 'Ja, ik ben zeker';
$string['info'] = 'Info';
$string['instructauthors'] = 'Instructies voor taak';
$string['instructreviewers'] = 'Instructies voor beoordeling';
$string['introduction'] = 'Inleiding';
$string['latesubmissions'] = 'Te laat afgegeven';
$string['latesubmissions_desc'] = 'Taken aanvaarden na de deadline';
$string['latesubmissions_help'] = 'Indien ingeschakeld kunnen taken ingestuurd worden na de deadline of tijdens de beoordelingsfase. Te laat ingestuurde taken kunnen niet meer bewerkt worden.';
$string['latesubmissionsallowed'] = 'Te laat afgeven toegestaan';
$string['maxbytes'] = 'Maximum bestandsgrootte';
$string['modulename'] = 'Workshop';
$string['modulenameplural'] = 'Workshops';
$string['mysubmission'] = 'Mijn inzending';
$string['nattachments'] = 'Maximum aantal bijlagen bij een taak';
$string['noexamples'] = 'Nog geen voorbeeldtaken in deze workshop';
$string['noexamplesformready'] = 'Je moet het beoordelingsformulier maken voor je voorbeeldtaken kunt insturen.';
$string['nogradeyet'] = 'Nog geen cijfer';
$string['nosubmissionfound'] = 'Nog geen inzending gevonden voor deze gebruiker';
$string['nosubmissions'] = 'Nog geen inzendingen in deze workshop';
$string['notassessed'] = 'Nog niet beoordeeld';
$string['nothingtoreview'] = 'Niets om te beoordelen';
$string['notoverridden'] = 'Niet overschreven';
$string['noworkshops'] = 'Er zijn geen workshops in deze cursus';
$string['noyoursubmission'] = 'Je hebt nog geen werk ingestuurd';
$string['nullgrade'] = '-';
$string['page-mod-workshop-x'] = 'Elke pagina van de Workshop';
$string['participant'] = 'Deelnemer';
$string['participantrevierof'] = 'Deelnemer is beoordeler van';
$string['participantreviewedby'] = 'Deelnemer is beoordeeld door';
$string['phaseassessment'] = 'Evaluatiefase';
$string['phaseclosed'] = 'Gesloten';
$string['phaseevaluation'] = 'Evaluatie van de beoordeling fase';
$string['phasesetup'] = 'Opstartfase';
$string['phasesubmission'] = 'Inzendingsfase';
$string['pluginadministration'] = 'Beheer workshop';
$string['pluginname'] = 'Workshop';
$string['prepareexamples'] = 'Voorbeeldinzending voorbereiden';
$string['previewassessmentform'] = 'Voorbeeld';
$string['publishedsubmissions'] = 'Gepubliceerde taken';
$string['publishsubmission'] = 'Publiceer taak';
$string['publishsubmission_help'] = 'Gepubliceerde taken zijn beschikbaar voor anderen wanneer de workshop gesloten is.';
$string['reassess'] = 'Evalueer opnieuw';
$string['receivedgrades'] = 'Behaalde cijfers';
$string['recentassessments'] = 'Workshop beoordelingen:';
$string['recentsubmissions'] = 'Workshop taken:';
$string['saveandclose'] = 'Bewaar en sluit';
$string['saveandcontinue'] = 'Bewaar en ga verder met beoordelen';
$string['saveandpreview'] = 'Bewaar en bekijk voorbeeld';
$string['selfassessmentdisabled'] = 'Zelfevaluatie uitgeschakeld';
$string['someuserswosubmission'] = 'Er is minstens één deelnemer die zijn taak nog niet heeft ingestuurd';
$string['sortasc'] = 'Oplopend sorteren';
$string['sortdesc'] = 'Omgekeerd sorteren';
$string['strategy'] = 'Beoordelingsstrategie';
$string['strategy_help'] = 'De beoordelingsstrategie bepaalt het gebruikte beoordelingsformulier en de methode voor het beoordelen van inzendingen;
Er zijn 4 opties:
* Cumulatief beoordelen - er worden commentaren en een cijfer gegeven volgens gespecificeerde aspecten van de taak
* Commentaren - er worden commentaren gegeven volgens bepaalde aspecten van de taak, maar er wordt geen cijfer gegeven.
* Aantal fouten - er wordt commentaar en een ja/nee beoordeling gegeven over een reeks statements
* Rubric - er wordt een beoordeling op een schaal gegeven volgens opgegeven criteria';
$string['strategyhaschanged'] = 'De beoordelingsstrategie van de workshop is gewijzigd nadat het formulier geopend was om te bewerken;';
$string['submission'] = 'Inzending';
$string['submissionattachment'] = 'Bijlage';
$string['submissionby'] = 'Taak van {$a}';
$string['submissioncontent'] = 'Taakinhoud';
$string['submissionend'] = 'Deadline voor het insturen';
$string['submissionenddatetime'] = 'Deadline voor taak: {$a->daydatetime} ({$a->distanceday})';
$string['submissionendevent'] = '{$a} (instuurdeadline)';
$string['submissiongrade'] = 'Cijfer voor taak';
$string['submissiongrade_help'] = 'Deze instelling bepaalt het maximum cijfer dat behaald kan worden voor een ingestuurde taak.';
$string['submissiongradeof'] = 'Cijfer voor taak (op {$a}';
$string['submissionsettings'] = 'Taak instellingen';
$string['submissionstart'] = 'Inzenden kan vanaf';
$string['submissionstartdatetime'] = 'Taak afgeven open vanaf {$a->daydatetime} ({$a->distanceday})';
$string['submissionstartevent'] = '{$a} (opent voor insturen)';
$string['submissiontitle'] = 'Titel';
$string['subplugintype_workshopallocation'] = 'Toewijzingsmethode voor taken';
$string['subplugintype_workshopallocation_plural'] = 'Toewijzingsmethodes';
$string['subplugintype_workshopeval'] = 'Methode voor de evaluatie van de beoordeling';
$string['subplugintype_workshopeval_plural'] = 'Methodes voor de evaluatie van de beoordeling';
$string['subplugintype_workshopform'] = 'Beoordelingsstrategie';
$string['subplugintype_workshopform_plural'] = 'Beoordelingsstrategieën';
$string['switchingphase'] = 'Schakelfase';
$string['switchphase'] = 'Schakelfase';
$string['switchphase10info'] = 'Je staat op het punt om de workshop  over te schakelen op de <strong>Instellingsfase</strong>. In deze fase kunnen gebruikers hun inzendingen of hun beoordelingen niet wijzigen. Leraren kunnen deze fase gebruiken om  de instellingen van de workshop te wijzigen, de beoordeligsstrategie aan te passen of de beoordelingsformulieren bij te sturen.';
$string['switchphase20info'] = 'Je gaat de Workshop naar de <strong>Insturen fase</strong> schakelen. Leerlingen kunnen gedurende deze fase hun werk insturen (binnen de instuur data, indien ingesteld). Leraren kunnen taken toewijzen voor peer beoordeling.';
$string['switchphase30info'] = 'Je gaat de Workshop in de <strong>Beoordelingsfase</strong> schakelen. In deze fase kunnen beoordelaars de taken beoordelen die ze toegewezen gekregen hebben (binnen de beoordelings data indien ingesteld).';
$string['switchphase40info'] = 'Je gaat de Workshop in de <strong>Evaluatiecijfers fase</strong> schakelen. In deze fase kunnen gebruikers hun taak en hun beoordelingen niet meer wijzigen. Leraren kunnen in deze fase de evaluatietools gebruiken om een eindcijfer te berekenen en om feedback aan de leerlingen en beoordelaars te geven.';
$string['switchphase50info'] = 'Je gaat de Workshop sluiten. Hierdoor zullen de berekende cijfers in het cijferboek verschijnen. Leerlingen kunnen dan hun taken en de beoordelingen ervan bekijken .';
$string['taskassesspeers'] = 'Evalueer anderen';
$string['taskassesspeersdetails'] = 'totaal: {$a->total}<br />te doen: {$a->todo}';
$string['taskassessself'] = 'Evalueer jezelf';
$string['taskinstructauthors'] = 'Geef instructies voor de taak';
$string['taskinstructreviewers'] = 'Geef instructies voor de beoordeling';
$string['taskintro'] = 'Geef een inleiding voor de Workshop';
$string['tasksubmit'] = 'Stuur je werk in';
$string['toolbox'] = 'Gereedschapskist voor de Workshop';
$string['undersetup'] = 'De Workshop wordt nu klaargemaakt. Wacht tot die naar de volgende fase geschakeld is.';
$string['useexamples'] = 'Voorbeeldtaken';
$string['useexamples_desc'] = 'Er worden voorbeeldtaken voorzien om het beoordelen te oefenen';
$string['useexamples_help'] = 'Indien ingeschakeld kunnen gebruikers een of meer voorbeeldtaken beoordelen en hun beoordeling vergelijken met een referentiebeoordeling. Het cijfer wordt niet gebruikt voor de berekening van de beoordeling.';
$string['usepeerassessment'] = 'Peer-evaluatie';
$string['usepeerassessment_desc'] = 'Leerlingen kunnen het werk van anderen beoordelen';
$string['usepeerassessment_help'] = 'Indien ingeschakeld kan een gebruiker taken van andere gebruikers toegewezen krijgen om te beoordelen en zal die gebruiker een cijfer krijgen voor die beoordeling, naast het cijfer dat die krijgt voor zijn eigen taak.';
$string['userdatecreated'] = 'ingestuurd op <span>{$a}</span>';
$string['userdatemodified'] = 'gewijzigd op <span>{$a}</span>';
$string['userplan'] = 'Workshop planner';
$string['userplan_help'] = 'De Workshop planner toont alle fasen van de activiteit en toont een lijst van taken per fase. De huidige fase is gemarkeerd en het voltooien van een taak wordt gemarkeerd met een vinkje.';
$string['useselfassessment'] = 'Zelfevaluatie';
$string['useselfassessment_desc'] = 'Leerlingen mogen hun eigen werk evalueren';
$string['useselfassessment_help'] = 'Indien ingeschakeld kan een gebruiker zijn eigen taak toegewezen krijgen om te beoordelen en zal die gebruiker een cijfer krijgen voor die beoordeling naast het cijfer dat die krijgt voor zijn eigen taak.';
$string['weightinfo'] = 'Weging: {$a}';
$string['withoutsubmission'] = 'Beoordelaar zonder eigen inzending';
$string['workshop:allocate'] = 'Taken toewijzen voor beoordeling';
$string['workshop:editdimensions'] = 'Bewerk beoordelingsformulieren';
$string['workshop:ignoredeadlines'] = 'Negeer tijdsbeperkingen';
$string['workshop:manageexamples'] = 'Beheer voorbeeldtaken';
$string['workshop:overridegrades'] = 'Overschrijf de berekende cijfers';
$string['workshop:peerassess'] = 'Peerevaluatie';
$string['workshop:publishsubmissions'] = 'Publiceer taken';
$string['workshop:submit'] = 'Stuur in';
$string['workshop:switchphase'] = 'Wijzig fase';
$string['workshop:view'] = 'Bekijk Workshop';
$string['workshop:viewallassessments'] = 'Bekijk alle beoordelingen';
$string['workshop:viewallsubmissions'] = 'Bekijk alle taken';
$string['workshop:viewauthornames'] = 'Bekijk de namen';
$string['workshop:viewauthorpublished'] = 'Bekijk de namen van de gepubliceerde taken';
$string['workshop:viewpublishedsubmissions'] = 'Bekijk gepubliceerde taken';
$string['workshop:viewreviewernames'] = 'Bekijk de namen van de beoordelaars';
$string['workshopfeatures'] = 'Mogelijkheden Workshop';
$string['workshopname'] = 'Workshop naam';
$string['yourassessment'] = 'Jouw beoordeling';
$string['yoursubmission'] = 'Jouw taak';
