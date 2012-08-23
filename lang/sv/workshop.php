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
 * Strings for component 'workshop', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   workshop
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allsubmissions'] = 'Alla inskickade uppgifter';
$string['alreadygraded'] = 'Redan bedömd/betygssatt';
$string['areainstructauthors'] = 'Instruktioner för inskickning av uppgifter';
$string['areainstructreviewers'] = 'Instruktioner för bedömning/värdering';
$string['assess'] = 'Bedöm/värdera/betygssätt';
$string['assessedexample'] = 'Inskickad exempeluppgift som är bedömd/värderad/betygssatt';
$string['assessedsubmission'] = 'Inskickad uppgift som är bedömd/värderad/betygssatt';
$string['assessingexample'] = 'Bedömer/värderar/betygssätter inskickad exempeluppgift';
$string['assessingsubmission'] = 'Bedömer/värderar/betygssätter inskickad uppgift';
$string['assessmentbyfullname'] = 'Bedömning/värdering/betygssättning av {$a}';
$string['assessmentbyyourself'] = 'Bedömning/värdering/betygssättning av dig själv';
$string['assessmentend'] = 'Sluttid för bedömningar/värderingar/betygssättningar';
$string['assessmentenddatetime'] = 'Sluttid för bedömningar/värderingar/betygssättningar:
{$a->daydatetime} ({$a->distanceday})';
$string['assessmentform'] = 'Formulär för bedömningar/värderingar/betygssättningar';
$string['assessmentofsubmission'] = '<a href="{$a->assessmenturl}">Bedömning/värdering/betygssättning</a> of <a href="{$a->submissionurl}">{$a->submissiontitle}</a>';
$string['assessmentreference'] = 'Referens för bedömning/värdering/betygssättning';
$string['assessmentsettings'] = 'Inställningar för bedömning/värdering/betygssättning';
$string['assessmentstart'] = 'Öppen för bedömningar/värderingar/betygssättningar från';
$string['assessmentstartdatetime'] = 'Öppen för bedömningar/värderingar/betygssättningar från  {$a->daydatetime} ({$a->distanceday})';
$string['backtoeditform'] = 'Tillbaka till formuläret för att redigera';
$string['byfullname'] = 'av <a href="{$a->url}">{$a->name}</a>';
$string['calculategradinggradesdetails'] = 'förväntat:  {$a->expected}<br />calculated: {$a->calculated}';
$string['calculatesubmissiongradesdetails'] = 'förväntat:  {$a->expected}<br />calculated: {$a->calculated}';
$string['chooseuser'] = 'Välj användare...';
$string['clearassessments'] = 'Töm bedömningar/värderingar/betyssättningar';
$string['createsubmission'] = 'Skicka in';
$string['daysago'] = 'för {$a} dagar sedan ';
$string['daystoday'] = 'idag';
$string['daystomorrow'] = 'imorgon';
$string['daysyesterday'] = 'igår';
$string['editassessmentform'] = 'Redigera formulär för bedömning/värdering/betygssättning';
$string['editingassessmentform'] = 'Redigerar formulär för bedömning/värdering/betygssättning';
$string['editingsubmission'] = 'Redigerar inskickad uppgiftslösning';
$string['editsubmission'] = 'Redigera inskickad uppgiftslösning';
$string['exampleassesstaskdetails'] = 'förväntad: {$a->expected}<br />assessed: {$a->assessed}';
$string['exampledelete'] = 'Ta bort exempel';
$string['exampleedit'] = 'Redigera exempel';
$string['exampleediting'] = 'Redigerar exempel';
$string['examplesubmissions'] = 'Prov på inskickade uppgiftslösningar';
$string['feedbackauthor'] = 'Återkoppling för författaren';
$string['feedbackreviewer'] = 'Återkoppling för recensenten/utvärderaren';
$string['formataggregatedgrade'] = '{$a->grade}';
$string['formataggregatedgradeover'] = '<del>{$a->grade}</del><br /><ins>{$a->over}</ins>';
$string['formatpeergrade'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span>';
$string['formatpeergradeover'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span>';
$string['formatpeergradeoverweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span> @ <span class="weight">{$a->weight}</span>';
$string['formatpeergradeweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span> @ <span class="weight">{$a->weight}</span>';
$string['gradedecimals'] = 'Antal decimaler i betyg/omdöme';
$string['gradegivento'] = '&gt;';
$string['gradeinfo'] = 'Betyg /omdöme: {$a->received} av {$a->max}';
$string['gradeitemassessment'] = '{$a->workshopname} (bedömning/värdering/betygssättning)';
$string['gradeitemsubmission'] = '{$a->workshopname} (inskickad uppgiftslösning)';
$string['gradereceivedfrom'] = '&lt;';
$string['gradinggrade'] = 'Betyg/omdöme för betygssättning/omdöme';
$string['iamsure'] = 'Ja, jag är säker';
$string['info'] = 'Info';
$string['instructauthors'] = 'Instruktioner för inskickning av uppgiftslösningar';
$string['instructreviewers'] = 'Instruktioner för bedömning/värdering/betygssättning';
$string['introduction'] = 'Introduktioon';
$string['latesubmissions'] = 'Sent inskickade uppgiftslösningar';
$string['latesubmissionsallowed'] = 'Sent inskickade uppgiftslösningar accepteras';
$string['latesubmissions_desc'] = 'Tillåt inskickning av uppgiftslösningar efter sluttiden.';
$string['maxbytes'] = 'Maximal filstorlek';
$string['modulename'] = 'Workshop';
$string['modulenameplural'] = 'Workshops';
$string['mysubmission'] = 'Min inskickade uppgiftslösning';
$string['nothingtoreview'] = 'Inget att granska';
$string['notoverridden'] = 'Ej överskriden';
$string['noworkshops'] = 'Det finns inga Workshops i den här kursen';
$string['noyoursubmission'] = 'Du har inte skickat in Ditt arbete ännu';
$string['nullgrade'] = '-';
$string['participant'] = 'Deltagare';
$string['participantrevierof'] = 'Deltagaren är utvärderare av ';
$string['participantreviewedby'] = 'Deltagaren utvärderas av ';
$string['phaseclosed'] = 'Stängd';
$string['pluginadministration'] = 'Administration av workshop';
$string['pluginname'] = 'Workshop';
$string['previewassessmentform'] = 'Förhandsgranska';
$string['publishedsubmissions'] = 'Inskickade uppgiftslösningar som har offentliggjorts';
$string['reassess'] = 'Bedöm/värdera/betygssätt igen';
$string['saveandclose'] = 'Spara och stäng';
$string['saveandcontinue'] = 'Spara och fortsätt att redigera';
$string['saveandpreview'] = 'Spara och förhandsgranska';
$string['sortasc'] = 'Stigande sortering';
$string['sortdesc'] = 'Fallande sortering';
$string['submission'] = 'Inskickad  uppgiftslösning';
$string['submissionattachment'] = 'Bilaga';
$string['submissionby'] = 'Inskickad uppgiftslösning av {$a}';
$string['submissionend'] = 'Sluttid för inskickning av uppgiftslösningar';
$string['submissionenddatetime'] = 'Sluttid för inskickning av uppgiftslösningar: {$a->daydatetime} ({$a->distanceday})';
$string['submissiongrade'] = '';
$string['submissionstart'] = 'Öppen för inskickning av uppgiftslösningar';
$string['submissionstartdatetime'] = 'Öppen för inskickning av uppgiftslösningar från {$a->daydatetime} ({$a->distanceday})';
$string['submissiontitle'] = 'Titel';
$string['taskassesspeersdetails'] = 'summa: {$a->total}<br />pending: {$a->todo}';
$string['taskassessself'] = 'Bedöm/värdera/betygssätt dig själv';
