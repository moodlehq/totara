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
 * Strings for component 'assignment', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   assignment
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addsubmission'] = 'Dodaj zadanie';
$string['allowdeleting'] = 'Zezwalaj na kasowanie przesłanych plików';
$string['allowdeleting_help'] = 'Jeśli opcja jest włączona, studenci mogą usunąć przesłane pliki w dowolnym czasie przed wystawieniem oceny.';
$string['allowmaxfiles'] = 'Maksymalna liczba plików, które można przesłać';
$string['allowmaxfiles_help'] = 'Maksymalna liczba plików, które mogą być przesłane. Jako, że ta liczba nie jest nigdzie wyświetlana, sugeruję podać ją w opisie zadania.';
$string['allownotes'] = 'Zezwalaj na zamieszczanie przypisów do oddawanego zadania';
$string['allownotes_help'] = 'Jeśli opcja jest włączona, studenci mogą wprowadzić uwagi w polu tekstowym, tak jak zadaniu typu online.';
$string['allowresubmit'] = 'Zezwalaj na ponowne przesłanie';
$string['allowresubmit_help'] = '<P ALIGN=CENTER>**Powtórne przesyłanie rozwiązań**</P>
Ustawienie domyślne nie pozwala studentom na powtórne przesyłanie rozwiązania po wystawieniu oceny przez prowadzącego
Jeżeli włączysz tę opcje, studenci będą mogli ponownie przesyłać rozwiązania, do Twojej oceny, po tym jak już wystawisz ocenę za dane zadanie. Może to być przydatne jeżeli zamierzasz zachęcić studentów do lepszej pracy poprzez powtarzanie zadania aż do skutku.
Opcja ta oczywiście nie dotyczy zadań wykonywanych w trybie off-line.';
$string['alreadygraded'] = 'Twoje zadanie zostało już ocenione więc ponowne przesłanie go nie jest możliwe.';
$string['assignment:exportownsubmission'] = 'Eksportuj własne zadania';
$string['assignment:exportsubmission'] = 'Eksportuj zadania';
$string['assignment:grade'] = 'Oceń zadanie';
$string['assignment:submit'] = 'Zgłoś zadanie';
$string['assignment:view'] = 'Zobacz zadanie';
$string['assignmentdetails'] = 'Szczegóły zadania';
$string['assignmentmail'] = '{$a->teacher} przesłał informację zwrotną do Twojego zadania \'{$a->assignment}\'

Informację zwrotną znajdziesz jako załącznik do zadania:

{$a->url}';
$string['assignmentmailhtml'] = '{$a->teacher} zamieścił informację zwrotną do oddanego zadania \'<i>{$a->assignment}</i>\'<br /><br />
Znajdziesz ją jako załącznik do <a href="{$a->url}">oddanego zadania</a>.';
$string['assignmentmailsmall'] = '{$a->teacher} zamieścił informację zwrotną do oddanego zadania \'<i>{$a->assignment}</i>\'<br /><br />
Znajdziesz ją jako załącznik do <a href="{$a->url}">oddanego zadania</a>.';
$string['assignmentname'] = 'Nazwa zadania';
$string['assignmenttype'] = 'Typ zadania';
$string['availabledate'] = 'Dostępne od';
$string['cannotdeletefiles'] = 'Wystąpił błąd. Pliki nie mogą zostać usunięte.';
$string['cannotviewassignment'] = 'Nie możesz zobaczyć tego zadania';
$string['comment'] = 'Komentarz';
$string['commentinline'] = 'Komentarz wewnątrzliniowy';
$string['commentinline_help'] = '# Wbudowany komentarz
W przypadku wybrania tej opcji oryginalne przesłanie zostanie skopiowane do pola komentarza opinii podczas oceny, co ułatwi wprowadzanie komentarzy wbudowanych (być może za pomocą innego koloru) lub edycję oryginalnego tekstu.';
$string['configitemstocount'] = 'Co ma być traktowane jako oddane zadanie w zadaniu online.';
$string['configmaxbytes'] = 'Standardowy dopuszczalny rozmiar zadania dla wszystkich zadań (zależy od limitów w kursach i innych lokalnych ustawień)';
$string['configshowrecentsubmissions'] = 'Każdy może zobaczyć powiadomienia o przesłanych zadaniach w ostatnich raportach aktywności.';
$string['confirmdeletefile'] = 'Czy na pewno chcesz skasować plik?<br /><strong>{$a}</strong>';
$string['coursemisconf'] = 'Kurs jest niepoprawnie skonfigurowany';
$string['currentgrade'] = 'Bieżąca ocena w dzienniku ocen';
$string['deleteallsubmissions'] = 'Usuń wszystkie przesłane zadania';
$string['deletefilefailed'] = 'Skasowanie pliku nie powiodło się';
$string['description'] = 'Opis';
$string['downloadall'] = 'Pobierz wszystkie zadania jako archiwum  zip';
$string['draft'] = 'Wersja robocza';
$string['duedate'] = 'Termin oddania';
$string['duedateno'] = 'Brak terminu oddania';
$string['early'] = '{$a} wcześniej';
$string['editmysubmission'] = 'Edytuj moje zadanie';
$string['editthesefiles'] = 'Edytuj te pliki';
$string['editthisfile'] = 'Aktualizuj te pliki';
$string['emailstudents'] = 'Wyślij powiadomienie do studentów';
$string['emailteachermail'] = '{$a->username} uaktualnił oddane zadanie \'{$a->assignment}\' o {$a->timeupdated}

Zadanie jest dostępne tutaj:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->username} uaktualnił oddane zadanie \'{$a->assignment}\' o {$a->timeupdated}</i><br /><br />

Zadanie <a href="{$a->url}">jest dostępne na stronie</a>.';
$string['emailteachers'] = 'Wyślij powiadomienie do nauczycieli';
$string['emailteachers_help'] = 'Jeżeli włączony, wtedy nauczyciele są alarmowani krótkim mailem kiedykolwiek studenci dodadzą lub uaktualnią zadanie.
Tylko nauczyciele którzy mają możliwość oceniania poszczególnych argumentacji są powiadamiani.
Więc dla przykładu, jeżeli na kursie jest kilka oddzielnych grup, wtedy nauczyciele wymagają od poszczególnych grup aby nie otrzymywać żadnych powiadomień o studentach z innych grup.
Dla ćwiczeń nie w sieci, oczywiście, email nie jest wysyłany i studenci nie potwierdzają niczego.';
$string['emptysubmission'] = 'Jeszcze nie oddałeś zadania';
$string['enablenotification'] = 'Przesłać e-maile z powiadomieniami';
$string['enablenotification_help'] = 'Jeśli opcja jest włączona studenci będą otrzymywać informację pocztą elektroniczną, jeśli ich zadania zostały ocenione.';
$string['errornosubmissions'] = 'Brak zadań do pobrania';
$string['existingfiledeleted'] = 'Plik został usunięty: {$a}';
$string['failedupdatefeedback'] = 'Nie powiodło się uaktualnienie informacji zwrotnej do zadania użytkownika {$a}';
$string['feedback'] = 'Informacja zwrotna';
$string['feedbackfromteacher'] = 'Informacja zwrotna od {$a}';
$string['feedbackupdated'] = 'Uaktualnienie informacji zwrotnych do {$a} oddanych zadań';
$string['finalize'] = 'Nie ma więcej przesłanych zadań';
$string['finalizeerror'] = 'Wystąpił błąd. Przesłanie zadania nie mogło zostać zakończone.';
$string['graded'] = 'Ocenione';
$string['guestnosubmit'] = 'Goście nie mają uprawnień, by oddawać zadania. Należy zalogować się / zarejestrować, by oddać zadanie';
$string['guestnoupload'] = 'Goście nie mają uprawnień, by przesyłać pliki';
$string['helpoffline'] = '<p>Ta opcja jest przydatna, gdy zadanie wykonywane jest poza Moodle, w internecie bądź podczas spotkania face-to-face.</p><p>Studenci widzą opis zadania, lecz nie mogą przesłać pliku ani zamieścić tekstu. Jak w innych typach zadania, studenci otrzymują powiadomienie o wystawionych ocenach.</p>';
$string['helponline'] = '<p>Ten typ zadania wymaga od użytkownika edycji tekstu przy użyciu standardowych narzędzi edycji. Nauczyciele mogą oceniać zadania online, a także dodawać komentarze śródliniowe i wprowadzać zmiany.</p><p>
(Osoby znające poprzednie wersje Moodle zauważą, że ten typ Zadania działa w ten sam sposób, co dawny moduł Dziennik.)';
$string['helpupload'] = '<p>Ten typ zadania pozwala każdemu uczestnikowi załadować jeden lub więcej plików w dowolnym formacie.
Mogą to być pliki tekstowe, obrazki, spakowana strona internetowa lub pliki innych formatów.</p>
<p>Ten typ zadania umożliwia też przesłanie wielu plików - można je przesyłać przed ostatecznym oddaniem zadania, dzięki czemu nauczyciele mogą zadać uczestnikom kursu analizę prac innych osób przed ich ocenieniem.</p>
<p> Uczestnicy mogą opisywać przesłane pliki, określać stan zaawansowania pracy lub zamieszczać inne informacje.</p>
<p>Oddanie tego typu zadania musi zostać ręcznie sfinalizowane przez uczestnika. Pliki są dostępne do wglądu przed ostatecznym oddaniem zadania - nieskończone wersje zadania są oznaczone jako Szkic. Można też zastąpić każde nieocenione zadanie zamieszczonym wcześniej szkicem.</p>';
$string['helpuploadsingle'] = '<p>Ten typ zadania pozwala każdemu uczestnikowi kursu przesłać jeden plik dowolnego typu.</p> <p>Może to być dokument tekstowy, zdjęcie lub plik zarchiwizowany.</p>';
$string['hideintro'] = 'Ukryj opis przed udostępnieniem zadania';
$string['hideintro_help'] = 'Jeśli opcja jest włączona, opis zadania jest ukryty przed datą rozpoczęcia "dostępny od".
Wyświetlana jest tylko nazwa zadania.';
$string['invalidassignment'] = 'niepoprawne zadanie';
$string['invalidid'] = 'identyfikator zadania był niepoprawny';
$string['invalidtype'] = 'Niepoprawny typ zadania';
$string['invaliduserid'] = 'Nieprawidłowy identyfikator użytkownika';
$string['itemstocount'] = 'Liczba';
$string['lastgrade'] = 'Ostatnia ocena';
$string['late'] = '{$a} po terminie';
$string['maximumgrade'] = 'Maksymalna ocena';
$string['maximumsize'] = 'Maksymalny rozmiar';
$string['modulename'] = 'Zadanie';
$string['modulename_help'] = '<IMG VALIGN=absmiddle SRC="wwwroot?>/mod/assignment/icon.gif"> **Zadania**
Zadania umożliwiają prowadzącemu określenie pracy, które studenci mają wykonać w formie elektronicznej (w dowolnym formacie) i przesłać na serwer. Typowe zadania to wypracowania, projekty, raporty itp. Moduł ten posiada funkcje umożliwiające wystawianie ocen.';
$string['modulenameplural'] = 'Zadania';
$string['newsubmissions'] = 'Oddane zadania';
$string['noassignments'] = 'Nie zamieszczono jeszcze żadnych zadań';
$string['noattempts'] = 'Nikt jeszcze nie oddał zadania';
$string['nofiles'] = 'Żaden plik nie został przesłany';
$string['nofilesyet'] = 'Żaden plik nie został przesłany';
$string['nomoresubmissions'] = 'Dalsze przesłanie plików nie jest możliwe';
$string['notavailableyet'] = 'Przepraszamy, to zadanie jeszcze nie jest dostępne.<br />Instrukcje do zadania zostaną wyświetlone w dniu podanym poniżej.';
$string['notes'] = 'Notatki';
$string['notesempty'] = 'Brak wpisu';
$string['notesupdateerror'] = 'Błąd podczas aktualizacji notatki';
$string['notgradedyet'] = 'Jeszcze nie ocenione';
$string['notsubmittedyet'] = 'Jeszcze nie oddane';
$string['onceassignmentsent'] = 'Po wysłaniu zadania do oceny, nie będzie możliwości skasowania lub dołączenia plików. Czy chcesz kontynuować?';
$string['operation'] = 'Operacja';
$string['optionalsettings'] = 'Ustawienia dodatkowe';
$string['overwritewarning'] = 'Uwaga! Ponowne przesłanie pliku usunie poprzednio przesłany plik';
$string['pagesize'] = 'Liczba zadań wyświetlanych na jednej stronie';
$string['pluginadministration'] = 'Zarządzanie zadaniem';
$string['pluginname'] = 'Zadanie';
$string['popupinnewwindow'] = 'Otwórz w wyskakującym oknie';
$string['preventlate'] = 'Zapobiegaj przesyłaniu zadań po terminie';
$string['quickgrade'] = 'Zezwól na szybkie ocenianie';
$string['quickgrade_help'] = 'Z włączoną opcją szybkiego oceniania możesz szybko oceniać wielokrotne zadania na jednej stronie.
Po prostu zmień oceny i komentarze oraz użyj przycisku Save na dole w celu jednoczesnego zastosowania wszystkich swoich zmian na stronie.
Przyciski zwykłego oceniania (na prawo) działają ciągle na wypadek jeśli będziesz potrzebował więcej miejsca.
Twoje preferencje szybkiego oceniania są zachowane i będą zastosowane do wszystkich zadań we wszystkich kursach.';
$string['requiregrading'] = 'Wymagające oceny';
$string['responsefiles'] = 'Pliki odpowiedzi';
$string['reviewed'] = 'Przejrzane';
$string['saveallfeedback'] = 'Zachowaj moją informację zwrotną';
$string['sendformarking'] = 'Wyślij do oceny';
$string['showrecentsubmissions'] = 'Pokaż ostatnio przesłane zadania';
$string['submission'] = 'Oddane zadanie';
$string['submissiondraft'] = 'Wersja robocza oddawanego zadania';
$string['submissionfeedback'] = 'Informacja zwrotna do oddanych zadań';
$string['submissions'] = 'Oddane zadania';
$string['submissionsaved'] = 'Zmiany zostały zachowane';
$string['submissionsnotgraded'] = '{$a} nieocenionych zadań';
$string['submitassignment'] = 'Oddaj zadanie przy użyciu formularza';
$string['submitedformarking'] = 'Zadanie zostało już zgłoszone do oceny i nie może być zaktualizowane.';
$string['submitformarking'] = 'Ostateczne zgłoszenie do oceny zadania';
$string['submitted'] = 'Oddane';
$string['submittedfiles'] = 'Przesłane pliki';
$string['subplugintype_assignment'] = 'Typ zadania';
$string['subplugintype_assignment_plural'] = 'Typy zadań';
$string['trackdrafts'] = 'Włącz funkcję \'Wyślij do oceny\'';
$string['trackdrafts_help'] = '# Wyślij do oceny
Przycisk Wyślij do oceny umożliwia użytkownikom poinformowanie oceniających o tym, że ukończyli oni pracę nad przypisanym zadaniem. Oceniający mogą przywrócić przypisane zadanie do stanu wersji roboczej (na przykład, jeśli wymaga ono dalszej pracy).';
$string['typeoffline'] = 'Zadanie offline';
$string['typeonline'] = 'Tekst online';
$string['typeupload'] = 'Zaawansowane ładowanie plików';
$string['typeuploadsingle'] = 'Prześlij plik';
$string['unfinalize'] = 'Powrót do wersji roboczej';
$string['unfinalizeerror'] = 'Wystąpił błąd i ta przesyłka nie może został przywrócona do wersji roboczej';
$string['uploadafile'] = 'Prześlij plik';
$string['uploadbadname'] = 'Nazwa pliku zawiera znaki, które nie pozwalają go przesłać';
$string['uploadedfiles'] = 'Przesłane pliki';
$string['uploaderror'] = 'Wystąpił błąd podczas zapisywania pliku na serwerze';
$string['uploadfailnoupdate'] = 'Plik został przesłany, lecz nie udało się zapisać faktu przesłania pliku';
$string['uploadfiles'] = 'Prześlij pliki';
$string['uploadfiletoobig'] = 'Zbyt duży plik (max. rozmiar pliku to {$a} bajtów)';
$string['uploadnofilefound'] = 'Nie odnaleziono żadnego pliku - czy zaznaczyłeś plik przed przesyłaniem?';
$string['uploadnotregistered'] = '\'{$a}\' został przesłany poprawnie, ale fakt ten nie został zarejestrowany';
$string['uploadsuccess'] = '\'{$a}\' został przesłany';
$string['usernosubmit'] = 'Nie masz uprawnień do przesłania zadania.';
$string['viewfeedback'] = 'Oglądaj oceny i informacje zwrotne zadania';
$string['viewmysubmission'] = 'Pokaż moje zadania';
$string['viewsubmissions'] = 'Oglądaj {$a} oddanych zadań';
$string['yoursubmission'] = 'Twoje przesłane zadanie';
