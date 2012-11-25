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
 * Strings for component 'workshop', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   workshop
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Kontrola dostępu';
$string['aggregategrades'] = 'Przelicz oceny';
$string['aggregation'] = 'Zestawienie ocen';
$string['allsubmissions'] = 'Wszystkie rozwiązania';
$string['alreadygraded'] = 'Już oceniono';
$string['assess'] = 'Oceń';
$string['assessment'] = 'Ocena';
$string['assessmentby'] = 'przez <a href="{$a->url}">{$a->name}</a>';
$string['assessmentbyfullname'] = 'Ocenione przez {$a}';
$string['assessmentbyyourself'] = 'Twoja ocena';
$string['assessmentend'] = 'Koniec fazy oceniania prac';
$string['assessmentenddatetime'] = 'Końcowy termin przesyłania prac: {$a->daydatetime} ({$a->distanceday})';
$string['assessmentendevent'] = '{$a} (ostateczny termin oceniania)';
$string['assessmentofsubmission'] = '<a href="{$a->assessmenturl}">Ocena</a> of <a href="{$a->submissionurl}">{$a->submissiontitle}</a>';
$string['assessmentstart'] = 'Początek fazy oceniania prac';
$string['assessmentstartevent'] = 'Początek fazy oceniania prac dla {$a}';
$string['byfullname'] = 'przez <a href="{$a->url}">{$a->name}</a>';
$string['chooseuser'] = 'Wybierz użytkownika ...';
$string['clearaggregatedgrades'] = 'Wyczyść wszystkie zagregowane oceny';
$string['createsubmission'] = 'Wyślij';
$string['daysago'] = 'pozostało dni: {$a}';
$string['daysleft'] = 'Pozostało dni {$a}';
$string['daystoday'] = 'dziś';
$string['daystomorrow'] = 'jutro';
$string['daysyesterday'] = 'wczoraj';
$string['editingsubmission'] = 'Edycja pracy';
$string['editsubmission'] = 'Edytuj pracę';
$string['exampledelete'] = 'Usuń przykład';
$string['exampleedit'] = 'Edytuj przykład';
$string['exampleediting'] = 'Edytowanie przykładu';
$string['examplesubmissions'] = 'Przykładowa praca';
$string['feedbackauthor'] = 'Informacja zwrotna dla autora';
$string['feedbackreviewer'] = 'Informacja zwrotna dla recenzenta';
$string['formataggregatedgrade'] = '{$a->grade}';
$string['formataggregatedgradeover'] = '<del>{$a->grade}</del><br /><ins>{$a->over}</ins>';
$string['formatpeergrade'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span>';
$string['formatpeergradeover'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span>';
$string['formatpeergradeoverweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span> @ <span class="weight">{$a->weight}</span>';
$string['formatpeergradeweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span> @ <span class="weight">{$a->weight}</span>';
$string['givengrades'] = 'Wystawiono oceny';
$string['gradedecimals'] = 'Miejsca dziesiętne w ocenach';
$string['gradegivento'] = '&gt;';
$string['gradeinfo'] = 'Ocena: {$a->received} / {$a->max}';
$string['gradereceivedfrom'] = '&lt;';
$string['gradinggrade'] = 'Stopniuj stopnie';
$string['gradinggrade_help'] = '# Stopień za oceny Studenta
Jest to maksymalny stopień jaki można dać studentom za otrzymane oceny podczas pracy. Jest to stopień wystawiony za ich oceny. Stopnie są obliczane w module warsztaty porównanie oceny z "najlepszą" oceną za te samo zadanie. "Najlepszą" oceną jest ta która jest najbliższa średniej wszystkich ocen.(Może być średnia ważona, jeżeli prowadzący ustawi wagi większe niż jeden). Jeżeli jest tylko jedna ocena za zadanie to jest ona wzięta jako najlepsza. Jeżeli są dwie oceny za zadanie, obie są uważane za "najlepsze". Tylko gdy jest trzy lub więcej ocen moduł liczy między nimi różnice.
Ten stopień czasem jest nazywany "stopniowaniem stopni" i \***|nie jest \***|maksymalnym stopieniem dawanym za pracę, ten jest nazwany "stopień za zadanie".
Stopień studenta z warsztatu jest sumą tego stopnia i stopnia za zadanie/zadania. Jeżeli maksymalny stopień dla Studenckich ocen jest 20 i maksymalny stopień za zadanie jest do 80, to maksymalny stopień dla warsztatu jest 100
Ta wartość może być zmieniana w każdej chwili i stopnie zostaną przeliczone.';
$string['gradingsettings'] = 'Ustawienia oceniania';
$string['iamsure'] = 'Tak, jestem pewien(a)';
$string['info'] = 'Informacja';
$string['introduction'] = 'Wprowadzenie';
$string['latesubmissions_desc'] = 'Zezwól na przesłanie prac po terminie końcowym';
$string['maxbytes'] = 'Maksymalny rozmiar pliku';
$string['modulename'] = 'Warsztaty';
$string['modulenameplural'] = 'Warsztaty';
$string['mysubmission'] = 'Moje prace';
$string['noexamples'] = 'W tych warsztatach jeszcze nie ma przykładów';
$string['nogradeyet'] = 'Jeszcze nie ocenione';
$string['notassessed'] = 'Jeszcze nie ocenione';
$string['noworkshops'] = 'W tym kursie nie ma warsztatów';
$string['noyoursubmission'] = 'Jeszcze nie przesłałeś swojej pracy';
$string['nullgrade'] = '-';
$string['participant'] = 'Uczestnik';
$string['phaseclosed'] = 'Zamknięty';
$string['pluginadministration'] = 'Administracja warsztatami';
$string['pluginname'] = 'Warsztaty';
$string['previewassessmentform'] = 'Podgląd';
$string['reassess'] = 'Oceń ponownie';
$string['recentassessments'] = 'Ocena warsztatów:';
$string['saveandclose'] = 'Zapisz i zamknij';
$string['saveandcontinue'] = 'Zapisz i kontynuuj edycję';
$string['saveandpreview'] = 'Zapisz i zobacz';
$string['sortasc'] = 'Sortowanie rosnąco';
$string['sortdesc'] = 'Sortowanie malejąco';
$string['strategy'] = 'Strategia oceniania';
$string['submission'] = 'Praca';
$string['submissionattachment'] = 'Załącznik';
$string['submissionby'] = 'Praca wykonana przez {$a}';
$string['submissioncontent'] = 'Zawartość pracy';
$string['submissionend'] = 'Koniec fazy nadsyłania prac';
$string['submissionenddatetime'] = 'Ostateczny termin nadsyłania prac: {$a->daydatetime} ({$a->distanceday})';
$string['submissionendevent'] = '{$a} (ostateczny termin przesyłania prac)';
$string['submissionstart'] = 'Start zadania';
$string['submissionstartevent'] = 'Start zadania dla {$a}';
$string['submissiontitle'] = 'Tytuł';
$string['subplugintype_workshopform'] = 'Strategia oceniania';
$string['subplugintype_workshopform_plural'] = 'Strategie oceniania';
$string['taskassesspeersdetails'] = 'ogółem: {$a-> total} <br /> do wykonania: {$a->todo}';
$string['taskassessself'] = 'Oceń się samodzielnie';
$string['taskintro'] = 'Ustaw wprowadzenie do warsztatów';
$string['tasksubmit'] = 'Wyślij swoją pracę';
$string['toolbox'] = 'Przybornik warsztatowy';
$string['undersetup'] = 'Warsztaty są obecnie konfigurowane. Proszę czekać, aż zostaną przełączone do kolejnej fazy.';
$string['useexamples'] = 'Użyj przykłady';
$string['usepeerassessment_desc'] = 'Studenci mogą mieć dostęp do prac innych';
$string['userdatecreated'] = 'wysłano <span>{$a}</span>';
$string['userdatemodified'] = 'zmodyfikowano <span>{$a}</span>';
$string['useselfassessment'] = 'Użyj samooceny';
$string['weightinfo'] = 'Waga: {$a}';
$string['workshop:submit'] = 'Zatwierdź / wyślij';
$string['workshop:switchphase'] = 'Zmień fazę';
$string['workshop:view'] = 'Zobacz warsztaty';
$string['workshop:viewallassessments'] = 'Zobacz wszystkie oceny';
$string['workshop:viewallsubmissions'] = 'Zobacz wszystkie prace';
$string['workshop:viewauthornames'] = 'Zobacz nazwiska autorów';
$string['workshop:viewauthorpublished'] = 'Zobacz autorów opublikowanych prac';
$string['workshop:viewpublishedsubmissions'] = 'Zobacz opublikowane prace';
$string['workshop:viewreviewernames'] = 'Zobacz nazwiska recenzentów';
$string['workshopname'] = 'Nazwa warsztatów';
$string['yourassessment'] = 'Twoje prace';
$string['yoursubmission'] = 'Twoje prace';
