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
 * Strings for component 'quiz', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   quiz
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessnoticesheader'] = 'Możesz obejrzeć ten quiz, ale gdyby to była prawdziwa próba, zostałbyś zablokowany, ponieważ:';
$string['action'] = 'Akcja';
$string['adaptive'] = 'Tryb adaptacyjny';
$string['adaptive_help'] = '# Tryb dostosowania
Po wybraniu opcji Tak uczeń może odpowiadać wielokrotnie na pytanie nawet podczas tego samego podejścia do quizu. A więc np. jeśli odpowiedź ucznia zostanie zaznaczona jako niepoprawna, uczeń może spróbować ponownie. Jednakże każdorazowa pomyłka skutkuje odjęciem punktów( liczba odejmowanych punktów jest uzależniona od współczynnika kary, ustawionego w następnej opcji).
Ten tryb pozwala także dostosować pytania które mogą samoistnie zamieniać się w odpowiedzi. Tak definiuje pytania IMS QTI:
> Adaptator pozwala na zaadoptowanie wyglądu, wartości (Proces Odpowiedzi) lub ich obu w odpowiedzi na każdą próbę kandydata. Np. adaptator może pojawić się jako podpowiedź dla kandydata w postaci ramki do wprowadzania własnych notatek, otrzymawszy niezadowalającą odpowiedź prezentuje skutki pojedynczego wyboru i przyznaje kilka stopni w procesie dalszej identyfikacji poprawnej odpowiedzi. Adaptatory pozwalają autorom na tworzenie scenariuszy gotowych do użycia w nowo zaistniałych sytuacjach, które pomogą nakierować kandydatów w otrzymanych zadaniach, równocześnie nie sugerując odpowiedzi i dbając o obiektywizm wyniku.
W trybie adaptacyjnym dodatkowyprzycisk jest pokazywany dla każdego pytania. Jeśli uczeń naciśnie przycisk wówczas odpowiedź do poszczególnego pytania jest dodawana do wyniku i zaznaczenie zostaje wyświetlone. Jeśli pytanie jest pytaniem adaptacyjnym wówczas wyświetlone zostaje z nowym statusem, odpowiedź zostaje zaliczona i w wielu przypadkach uczeń zostanie poproszony o wprowadzenie innej odpowiedzi. W najprostszych pytaniach adaptacyjnych nowy status może różnić się tylko komentarzem i skłaniać ucznia by spróbował ponownie. W bardziej skomplikowanych pytaniach może różnić się treścią a nawet kolejnością.';
$string['addaquestion'] = 'Dodaj pytanie...';
$string['addarandomquestion'] = 'Dodaj losowe pytanie...';
$string['adddescriptionlabel'] = 'Dodaj opis / etykietę';
$string['addingquestion'] = 'Dodawanie pytania';
$string['addingquestions'] = 'Po prawej znajduje się baza pytań. Pytania przechowywane są w kategoriach w celu ułatwienia ich organizacji. Pytania mogą być wykorzystane nie tylko w dowolnym quizie wchodzącym w skład kursu, lecz również w innych kursach, jeśli zostaną opublikowane. <br /><br /> Po wybraniu lub utworzeniu kategorii, można tworzyć i edytować pytania. Każde z tych pytań można następnie dodać do quizu - lewa część strony.';
$string['addmoreoverallfeedbacks'] = 'Dodaj {no} pola odpowiedzi zwrotnej';
$string['addnewpagesafterselected'] = 'Dodaj nowe strony za zaznaczonym pytaniem';
$string['addnewquestionsqbank'] = 'Dodaj pytanie do kategorii {$a->catname}: {$a->link}';
$string['addpagehere'] = 'Dodaj tutaj stronę';
$string['addquestion'] = 'Dodaj pytanie';
$string['addquestions'] = 'Dodaj pytania';
$string['addquestionstoquiz'] = 'Dodaj pytania do tego quizu';
$string['addrandom'] = 'Dodaj {$a} losowe pytania';
$string['addrandom1'] = '<< Dodaj';
$string['addrandom2'] = 'pytania losowe';
$string['addrandomfromcategory'] = 'Dodaj losowe pytania z kategorii:';
$string['addrandomquestion'] = 'Dodaj losowe pytanie';
$string['addrandomquestiontoquiz'] = 'Dodaj losowe pytanie do quizu {$a}';
$string['addselectedtoquiz'] = 'Dodaj wybrane do quizu';
$string['addtoquiz'] = 'Dodaj do quizu';
$string['affectedstudents'] = 'Affected {$a}';
$string['aftereachquestion'] = 'Po dodaniu każde pytanie';
$string['afternquestions'] = 'Po dodaniu {$a} pytań';
$string['age'] = 'wiek';
$string['allattempts'] = 'Wszystkie podejścia';
$string['allinone'] = 'Bez ograniczeń';
$string['allowreview'] = 'Udostępnij przegląd';
$string['alreadysubmitted'] = 'Najprawdopodobniej zakończyłeś już to podejście do quizu';
$string['alternativeunits'] = 'Alternatywne jednostki';
$string['alwaysavailable'] = 'Zawsze dostępne';
$string['analysisoptions'] = 'Opcje analizy';
$string['analysistitle'] = 'Pozycje tablicy analizy';
$string['answer'] = 'Odpowiedź';
$string['answered'] = 'Udzielono odpowiedzi';
$string['answerhowmany'] = 'Jedna lub wiele odpowiedzi?';
$string['answers'] = 'Poprawne odpowiedzi';
$string['answersingleno'] = 'Odpowiedź wielokrotna jest dozwolona';
$string['answersingleyes'] = 'Wyłącznie jedna odpowiedź';
$string['answerswithacceptederrormarginmustbenumeric'] = 'Odpowiedzi z zaakceptowanym błędem muszą być numeryczne';
$string['answertoolong'] = 'Zbyt długa odpowiedź (maks. 255 znaków)';
$string['aon'] = 'Format AON';
$string['areyousureremoveselected'] = 'Czy na pewno chcesz usunąć wszystkie wybrane odpowiedzi?';
$string['asshownoneditscreen'] = 'Jak pokazano w oknie edycji';
$string['attempt'] = 'Próba {$a}';
$string['attemptalreadyclosed'] = 'Ta próba została już zakończona.';
$string['attemptclosed'] = 'Próba nie została jeszcze zakończona';
$string['attemptduration'] = 'Czas wykonania';
$string['attemptedon'] = 'Data rozwiązania';
$string['attempterror'] = 'Nie możesz podejść do próby w tym teście teraz, ponieważ: {$a}';
$string['attemptfirst'] = 'Pierwsze podejście';
$string['attemptincomplete'] = 'Podejście {$a} nie zostało zakończone';
$string['attemptlast'] = 'Ostatnie podejście';
$string['attemptnumber'] = 'Próba';
$string['attemptquiznow'] = 'Spróbuj teraz rozwiązać quiz';
$string['attempts'] = 'Podejścia';
$string['attemptsallowed'] = 'Dostępne podejścia';
$string['attemptsdeleted'] = 'Podejścia usunięte';
$string['attemptselection'] = 'Podejścia do analizy wybrane przez użytkownika';
$string['attemptsexist'] = 'Nie możesz dodawać ani usuwać pytań z quizu';
$string['attemptsnum'] = 'Podejść: {$a}';
$string['attemptsnumthisgroup'] = 'Podejść: {$a->total} ({$a->group} z tej grupy)';
$string['attemptsnumyourgroups'] = 'Podejść: {$a->total} ({$a->group} z twoich grup)';
$string['attemptsonly'] = 'Pokaż tylko studentów, którzy podeszli do quizu';
$string['attemptstillinprogress'] = 'Podejście jeszcze w toku';
$string['attemptsunlimited'] = 'Nielimitowana liczba podejść';
$string['back'] = 'Powrót do podglądu pytania';
$string['backtocourse'] = 'Powrót do kursu';
$string['backtoquestionlist'] = 'Wróć do listy pytań';
$string['backtoquiz'] = 'Powrót do edycji quizu';
$string['basicideasofquiz'] = 'Podstawowe zasady tworzenia quizu';
$string['bestgrade'] = 'Najlepsza ocena';
$string['bothattempts'] = 'Pokaż wszystkich studentów';
$string['browsersecurity'] = '';
$string['browsersecurity_help'] = '# Bezpieczeństwo przeglądarki
Ta opcja oferuje różne metody ograniczania sposobów \'oszukiwania\' przez studentów podczas rozwiązywania kwizu. Nie jest to jednak prosta kwestia i to, co w jednej sytuacji jest uważane za \'oszukiwanie\', w innej sytuacji może być tylko skutecznym sposobem korzystania z informatyki. (Na przykład możliwość szybkiego znajdowania odpowiedzi za pomocą wyszukiwarki.)
Należy również zauważyć, że nie jest to tylko problem technologii z rozwiązaniem technicznym. Oszukiwanie pojawiło się na długo przed komputerami i chociaż komputery łatwiej wykonują pewne czynności, takie jak kopiowanie i wklejanie, ułatwiają one również wykładowcom wykrywanie oszustw - na przykład za pomocą raportów z kwizów. Udostępniane tutaj opcje nie są nie do zepsucia i chociaż utrudniają one uczestnikom pewne formy oszukiwania, powodują również pewne niedogodności w rozwiązywaniu kwizów przez uczestników i nie są nie do zepsucia.
Należy również rozważyć inne sposoby utrudniania uczestnikom oszukiwanie podczas kwizu:
* Można użyć dużego banku pytań, z którego pytania są wybierane losowo, więc różni uczestnicy zobaczą różne, ale podobne pytania.
* Można użyć opcji mieszania odpowiedzi, więc poprawną odpowiedzią na pytanie 1 nie zawsze będzie opcja A.
* Można również zadać pytania wymagające od uczestników przeanalizowania podanych informacji, a nie tylko przywołania faktów.</p>
Mając na uwadze powyższe przestrogi, poniżej znajdziecie opis dostępnych opcji.
### Brak
Na drodze uczestników próbujących rozwiązać kwiz nie zostaną umieszczone żadne przeszkody.
### Pełnoekranowe okienko podręczne z pewnymi zabezpieczeniami JavaScript
Istnieje limit tego, co kwiz działający na serwerze internetowym może zrobić, aby ograniczyć to, co siedzący przed swoim komputerem uczestnik może zrobić podczas rozwiązywania kwizu. Jednak ta opcja robi to, co jest możliwe:
* Kwiz zostanie uruchomiony tylko, gdy uczestnik włączy w przeglądarce obsługę skryptów JavaScript.
* Kwiz jest wyświetlany jako pełnoekranowe okienko podręczne zakrywające wszystkie inne okna i niemające elementów sterujących nawigacją.
* Uczestnikom uniemożliwia się, na ile jest to możliwe, korzystanie z takich funkcji, jak kopiowanie i wklejanie.
### Wymagaj użycia bezpiecznej przeglądarki egzaminacyjnej
Ta opcja będzie wyświetlana tylko, gdy zostanie włączona przez administratora.
[Bezpieczna przeglądarka egzaminacyjna](http://www.safeexambrowser.org) to dostosowana przeglądarka internetowa, która musi zostać pobrana i zainstalowana na komputerze używanym przez uczestnika do rozwiązywania kwizu. Ograniczenia nakładane na uczestnika są podobne do stosowanych w przypadku okienka podręcznego, ale ponieważ bezpieczna przeglądarka egzaminacyjna to oprogramowanie działające na komputerze uczestnika, może ono dużo skuteczniej realizować zadanie ograniczania jego czynności. Jeśli wybierzesz tę opcję:
* Uczestnicy będą mogli rozwiązać kwiz tylko, jeśli używają bezpiecznej przeglądarki egzaminacyjnej.
* Okno przeglądarki zajmie cały ekran (bez żadnych elementów nawigacyjnych).
* Okna nie będzie można zamknąć do chwili przesłania testu.
* Klawisze skrótów, takie jak Win, Ctrl+Alt+Del, Alt+F4, F1, Ctrl+P, Printscreen, będą wyłączone.
* Wyłączone będzie kopiowanie i wklejanie oraz menu kontekstowe.
* Nie można będzie się przełączyć na inną aplikację.
* Zabronione będzie przechodzenie do innych witryn internetowych.';
$string['calculated'] = 'Obliczeniowe';
$string['calculatedquestion'] = 'Kalkulowane pytanie nie w linii {$a}. Pytanie zostanie zignorowane.';
$string['cannotcreatepath'] = 'Ścieżka nie może zostać utworzona ({$a})';
$string['cannoteditafterattempts'] = 'Nie można dodawać ani usuwać pytań (były już jakieś podejścia). ({$a})';
$string['cannotinsert'] = 'Nie można wstawić pytania';
$string['cannotinsertrandomquestion'] = 'Nie udało się wstawić nowego, losowo wybranego pytania!';
$string['cannotloadquestion'] = 'Nie udało się załadować opcji dla pytania';
$string['cannotopen'] = 'Nie można otworzyć pliku do exportu';
$string['cannotrestore'] = 'Nie udało się przywrócić sesji pytań';
$string['cannotreviewopen'] = 'Nie możesz przeglądać tego podejścia, jest ono nadal otwarte.';
$string['cannotwrite'] = 'Nie można zapisać pliku do eksportu ({$a})';
$string['caseno'] = 'Nie, wielkość liter jest nieważna';
$string['casesensitive'] = 'Uwzględnianie wielkości liter';
$string['caseyes'] = 'Tak, wielkość liter musi się zgadzać';
$string['categories'] = 'Kategorie';
$string['category'] = 'Kategoria';
$string['categoryadded'] = 'Kategoria \'{$a}\' została dodana';
$string['categorydeleted'] = 'Kategoria \'{$a}\' została usunięta';
$string['categorynoedit'] = 'Nie możesz edtować kategorii \'{$a}\'';
$string['categoryupdated'] = 'Kategoria została poprawnie pobrana';
$string['close'] = 'Zamknij okno';
$string['closebeforeopen'] = 'Nie można zmieniać quizu. Data zamknięcia jest wcześniejsza niż data otwarcia quizu.';
$string['closed'] = 'Zamknięty';
$string['closepreview'] = 'Zamknij podgląd';
$string['closereview'] = 'Zamknij przegląd';
$string['comment'] = 'Komentarz';
$string['commentorgrade'] = 'Skomentuj lub zmień ocenę';
$string['comments'] = 'Komentarze';
$string['completedon'] = 'Ukończono';
$string['configrequirepassword'] = 'Studenci muszą wpisać to hasło, zanim będą mogli rozpocząć quiz.';
$string['configrequiresubnet'] = 'Studenci mogą tylko próbować rozwiązać quiz z tych komputerów.';
$string['configreviewoptions'] = 'Opcje te kontrolują to, co użytkownicy mogą zobaczyć kiedy przeglądają próby quizu lub raport quizu.';
$string['configshowblocks'] = 'Pokaż bloki kursu podczas rozwiązywania quizu';
$string['configshowuserpicture'] = 'Pokaż na ekranie zdjęcie użytkownika  w czasie prób.';
$string['configtimelimitsec'] = 'Domyślny czas dla quizów w sekundach. 0 - oznacza brak limitu czasowego.';
$string['configurerandomquestion'] = 'Konfiguruj pytanie';
$string['confirmclose'] = 'Zakończenie podejścia. Jeżeli zakończysz to podejście, nie będziesz mógł zmienić swoich odpowiedzi.';
$string['confirmserverdelete'] = 'Czy na pewno chcesz usunąć serwer <b>{$a}</b> z listy?';
$string['confirmstartattemptlimit'] = 'Ten quiz ma ograniczoną liczbę podejść {$a}. Zaraz rozpoczniesz kolejne. Chcesz kontynuować?';
$string['confirmstartattempttimelimit'] = 'Ten quiz ma limit czasowy i jest ograniczony do {$a} podejść. Zaraz rozpoczniesz kolejne. Chcesz kontynuować?';
$string['confirmstarttimelimit'] = 'Ten quiz ma limit czasowy. Czy na pewno chcesz rozpocząć?';
$string['containercategorycreated'] = 'Do tej kategorii zostały przeniesione wszystkie dotychczasowe kategorie z przyczyn wyszczególnionych poniżej.';
$string['continueattemptquiz'] = 'Kontynuuj ostatnie podejście';
$string['continuepreview'] = 'Kontynuuj ostatni podgląd';
$string['copyingfrom'] = 'Utwórz kopię pytania \'{$a}\'';
$string['copyingquestion'] = 'Kopiowanie pytania';
$string['correct'] = 'Poprawnie';
$string['correctanswer'] = 'Poprawna odpowiedź';
$string['correctanswerformula'] = 'Poprawna formuła odpowiedzi';
$string['correctansweris'] = 'Poprawna odpowiedź: {$a}';
$string['correctanswerlength'] = 'Poprawna długość odpowiedzi';
$string['correctanswers'] = 'Poprawne odpowiedzi';
$string['correctanswershows'] = 'Pokaż poprawne odpowiedzi';
$string['corrresp'] = 'Właściwa odpowiedź';
$string['countdown'] = 'Odliczanie';
$string['countdownfinished'] = 'Quiz jest zamykany. Wyślij teraz swoje odpowiedzi.';
$string['countdowntenminutes'] = 'Quiz zostanie zamknięty za 10 minut';
$string['coursetestmanager'] = 'Format Menedżera Testów Kursu';
$string['createcategoryandaddrandomquestion'] = 'Utwórz kategorię i dodaj losowe pytanie';
$string['createfirst'] = 'Musisz utworzyć najpierw pytania \'krótka odpowiedź\'.';
$string['createmultiple'] = 'Utwórz wiele pytań';
$string['createnewquestion'] = 'Utwórz nowe pytanie';
$string['createquestionandadd'] = 'Utwórz nowe pytanie i dodaj je do quizu.';
$string['custom'] = 'Niestandardowy format';
$string['dataitemneed'] = 'Musisz dodać co najmniej jeden zestaw aby utworzyć prawidłowe pytanie.';
$string['datasetdefinitions'] = 'Zestawy wielokrotnego użytku dla kategorii {$a}';
$string['datasetnumber'] = 'Liczba';
$string['daysavailable'] = 'Dni dostępności';
$string['decimaldigits'] = 'Cyfry dziesiętne w ocenie';
$string['decimalplaces'] = 'Miejsca dziesiętne w ocenach';
$string['decimalplaces_help'] = 'Przez użycie tej opcji można wybierać liczbę punktów dziesiętnych pokazywanych w ocenie dla każdej próby';
$string['decimalplacesquestion'] = 'Miejsca dziesiętne w ocenie pytania';
$string['decimalpoints'] = 'Punkty dziesiętne';
$string['default'] = 'Domyślny';
$string['defaultgrade'] = 'Domyślna ocena za pytanie';
$string['defaultinfo'] = 'Domyślna kategoria pytań';
$string['delay1'] = 'Czas pomiędzy pierwszym a drugim podejściem';
$string['delay1st2nd'] = 'Wymuszone opóźnienie między 1 i 2 próbą';
$string['delay1st2nd_help'] = 'Jeśli opcja jest włączona, uczeń musi odczekać określony czas, zanim będzie mógł próbować rozwiązać quiz po raz drugi.';
$string['delay2'] = 'Czas pomiędzy kolejnymi podejściami';
$string['delaylater'] = 'Wymuszone opóźnienie między późniejszymi próbami';
$string['delaylater_help'] = 'Jeśli opcja jest włączona, uczeń musi odczekać określony czas, zanim będzie mógł próbować rozwiązać quiz po raz trzeci i kolejny raz.';
$string['deleteattemptcheck'] = 'Czy jesteś pewien, że chcesz usunąć te podejścia?';
$string['deleteselected'] = 'Usuń wybrane';
$string['deletingquestionattempts'] = 'Usuwanie podejść do pytania';
$string['description'] = 'Opis';
$string['disabled'] = 'Nieaktywny';
$string['displayoptions'] = 'Wyświetl opcje';
$string['download'] = 'Pobierz plik z kategoriami';
$string['downloadextra'] = '(Plik jest przechowywany w plikach kursu/katalogu quizu)';
$string['duplicateresponse'] = 'Ta próba jest zignorowana, ponieważ podałeś wcześniej równoważne odpowiedzi';
$string['eachattemptbuildsonthelast'] = 'Każda nowa próba na podstawie poprzedniej';
$string['eachattemptbuildsonthelast_help'] = 'Jeżeli dozwolone są wielokrotne próby, a ta opcja ustawiona jest na **Tak**, wtedy każda nowa próba już zawiera rozwiązania z poprzedniej próby. Pozwala to na uzupełnienie quizu w kilku podejściach.
Aby za każdą próbą pokazać nienaruszony quiz, wybierz **Nie** dla tego ustawienia.';
$string['editcategories'] = 'Edytuj kategorie';
$string['editcategory'] = 'Edytuj kategorię';
$string['editcatquestions'] = 'Edytuj pytania kategorii';
$string['editingquestion'] = 'Edycja pytania';
$string['editingquiz'] = 'Edycja quizu';
$string['editqcats'] = 'Edytuj kategorie pytań';
$string['editquestions'] = 'Edytuj pytania';
$string['editquiz'] = 'Edytuj quiz';
$string['editquizquestions'] = 'Edycja pytań quizu';
$string['emailconfirmbody'] = 'Drogi {$a->username},

Dziękuję za udzielenie odpowiedzi w quizie "{$a->quizname}" w kursie "{$a->coursename}" o {$a->submissiontime}.

Ten e-mail potwierdza prawidłowy odbiór pytań w systemie.

Quiz jest dostępny na {$a->quizurl}.';
$string['emailconfirmsmall'] = 'Dziękujemy za przesłanie odpowiedzi dot. \'{$a->quizname}\'';
$string['emailconfirmsubject'] = 'Potwierdzenie wysłania quizu: {$a->quizname}.';
$string['emailnotifybody'] = 'Drogi {$a->username},

{$a->studentname} ukończył quiz "{$a->quizname}" ({$a->quizurl}) w kursie "{$a->coursename}".

Możesz przejrzeć udzielone odpowiedzi na {$a->quizreviewurl}.';
$string['emailnotifysmall'] = '{$a->studentname} zakończył(a) {$a->quizname}';
$string['emailnotifysubject'] = '{$a->studentname} ukończył quiz {$a->quizname}.';
$string['empty'] = 'Puste';
$string['enabled'] = 'Włączone';
$string['erroraccessingreport'] = 'Nie masz dostępu do tego raportu';
$string['errorinquestion'] = 'Błąd w pytaniu';
$string['errormissingquestion'] = 'Błąd: System opuścił pytanie z ID {$a}';
$string['errornotnumbers'] = 'Błąd - odpowiedź musi być liczbą';
$string['essay'] = 'Dłuższa odpowiedź';
$string['essayquestions'] = 'Pytania';
$string['everynquestions'] = 'Wszystkie {$a} pytania';
$string['everyquestion'] = 'Każde pytanie';
$string['everythingon'] = 'Wszystko włączone';
$string['export'] = 'Eksport';
$string['exportcategory'] = 'eksport kategorii';
$string['exporterror'] = 'Błąd podczas eksportu';
$string['exportingquestions'] = 'pytania są wyeksportowane do pliku';
$string['exportname'] = 'Nazwa pliku';
$string['exportquestions'] = 'Wyeksportuj pytania do pliku';
$string['extraattemptrestrictions'] = 'Dodatkowe ograniczenia podejść do quizu';
$string['false'] = 'Fałsz';
$string['feedback'] = 'Informacja zwrotna';
$string['feedbackerrorboundaryformat'] = 'Granica oceny musi być wartością liczbową lub procentową. Wartość granicy 1 nie została rozpoznana.';
$string['feedbackerrorboundaryoutofrange'] = 'Granica oceny musi zawierać się w przedziale od 0% do 100%. Wartość granicy 1 jest poza zakresem.';
$string['feedbackerrorjunkinboundary'] = 'Musisz podać granice ocen bez przerw (luk).';
$string['feedbackerrorjunkinfeedback'] = 'Musisz wypełnić pola informacji zwrotnych bez przerw (luk).';
$string['feedbackerrororder'] = 'Granice ocen muszą być uporządkowane (najpierw najwyższa). Wartość wprowadzona w granicy {$a} nie pasuje do ciągu.';
$string['file'] = 'Plik';
$string['fileformat'] = 'Format pliku';
$string['fillcorrect'] = 'Wypełnij poprawnymi';
$string['filloutnumericalanswer'] = 'Musisz podać co najmniej jedną możliwą odpowiedź i tolerancję. Punktacja i informacja zwrotna zostanie określona na podstawie pierwszej pasującej odpowiedzi. Na końcu możesz podać informację zwrotną bez odpowiedzi. Zostanie ona pokazana uczniom, których odpowiedź nie została przewidziana.';
$string['filloutoneanswer'] = 'Musisz stworzyć przynajmniej jedną odpowiedź. Pola odpowiedzi pozostawione puste będą ignorowane';
$string['filloutthreequestions'] = 'Musisz wpisać przynajmniej trzy odpowiedzi. Pola odpowiedzi pozostawione puste będą ignorowane';
$string['fillouttwochoices'] = 'Musisz wpisać przynajmniej dwie odpowiedzi. Pola odpowiedzi pozostawione puste będą ignorowane';
$string['finishattemptdots'] = 'Zakończ próbę ...';
$string['finishreview'] = 'Zakończ ocenianie.';
$string['forceregeneration'] = 'wymuś regenerację';
$string['formatnotfound'] = 'Formatu importu/exportu {$a} nie znaleziono';
$string['formatnotimplemented'] = 'Format nie był poprawny, sprawdź wysłany raport błędów';
$string['formulaerror'] = 'Błąd formuły!';
$string['fractionsaddwrong'] = 'Wybrane odpowiedzi pozytywne nie sumują się do 100% <br />Teraz sumują się do {$a}% <br />Czy chcesz wrócić i poprawić pytanie?';
$string['fractionsnomax'] = 'Jedna z odpowiedzi powinna być warta 100% tak,<br />aby można było uzyskać maksymalną ocenę za to pytanie.<br />Czy chcesz wrócić i poprawić pytanie?';
$string['fromfile'] = 'z pliku:';
$string['functiondisabledbysecuremode'] = 'Ta funkcjonalność jest obecnie wyłączona';
$string['generalfeedback'] = 'Ogólna informacja zwrotna';
$string['generalfeedback_help'] = '# Ogólna opinia do pytania
Ogólna opinia do pytania to pewien tekst wyświetlany dla uczestnika po próbie odpowiedzi na pytanie. W odróżnieniu od opinii, która zależy od typu pytania i udzielonej przez uczestnika odpowiedzi, ten sam tekst opinii ogólnej będzie wyświtlany dla wszystkich uczestników.
Moment wyświetlenia opinii ogólnej dla uczestników można kontrolować za pomocą pól wyboru "Uczestnicy mogą przejrzeć:" w formularzu edycji kwizu.
Opinii ogólnej można użyć do przekazania uczestnikom informacji o tym, jaką wiedzę sprawdza pytanie, lub udostępnić łącze do dalszych informacji, jeśli nie zrozumieli pytań.';
$string['grade'] = 'Ocena';
$string['gradeall'] = 'Wszystkie oceny';
$string['gradeaverage'] = 'Średnia ocena';
$string['gradeboundary'] = 'Granica oceny';
$string['gradeessays'] = 'Ocena pytania \'Dłuższa odpowiedź\'';
$string['gradehighest'] = 'Najwyższa ocena';
$string['grademethod'] = 'Metoda oceniania';
$string['grademethod_help'] = 'Jeżeli dozwolone są wielokrotne próby rozwiązania quizu, to istnieją różne sposoby wykorzystania ocen za poszczególne próby do obliczenia ostatecznej oceny za rozwiązanie quizu.
**Ocena najwyższa**
Oceną ostateczną jest najwyższa (najlepsza) ocena spośród wszystkich ocen za poszczególne próby.

**Ocena średnia**
Oceną ostateczną jest średnia ocen za wszystkie próby.

**Ocena pierwsza**
Oceną ostateczną jest ocena za pierwszą próbę rozwiązania (inne próby są zignorowane).

**Ocena ostatnia**
Oceną ostateczną jest ocena przyznana za ostatnią próbę rozwiązania.
';
$string['gradesdeleted'] = 'Oceny quizu usunięte';
$string['gradesofar'] = '{$a->method}: {$a->mygrade} / {$a->quizgrade}';
$string['gradingdetails'] = 'Ocena dla tego zadania: {$a->raw}/{$a->max}.';
$string['gradingdetailsadjustment'] = 'Z poprzednimi karami to daje <strong>{$a->cur}/{$a->max}</strong>.';
$string['gradingdetailspenalty'] = 'To podejście otrzymuje karę {$a}.';
$string['gradingdetailszeropenalty'] = 'Nie dostałeś kary za to zadanie.';
$string['gradingmethod'] = 'Metoda oceniania: {$a}';
$string['groupsnone'] = 'Brak grup w tym kursie';
$string['guestsno'] = 'Goście nie mogą oglądać ani rozwiązywać quizów';
$string['hidebreaks'] = '';
$string['history'] = 'Historia odpowiedzi';
$string['howquestionsbehave_desc'] = 'Domyślne ustawienia dla zachowań pytań w quizie.';
$string['imagedisplay'] = 'Obrazek do wyświetlenia';
$string['import'] = 'Import';
$string['import_help'] = 'Ta funkcja pozwala Ci zaimportować pytania z zewnętrznego pliku tekstowego, przesłanego na serwer za pomocą formularza.
Import obsługuje kilka formatów.
**Format GIFT**
Format GIFT jest najbardziej wszechstronnym formatem. Został zaprojektowany jako prosta metoda dla nauczycieli tworzacych pytania jako plik tekstowy. GIFT obsługuje pytania Wielokrotnego wyboru, Prawda-Fałsz, Krótkie odpowiedzi, Dopasuj odpowiedź, Numeryczne jak i zadania typu "wstaw brakujące słowo".
Kilka typów pytań może być użyytych w jednym pliku tekstowym. Ponadto format ten zezwala na umieszczanie komentarzy, nazw pytań, informacji zwrotnych i ważenie ocen.
Oto kilka przykładów:
CzasNaE-Biznes to?{~codzienna gazeta ~książka =serwis www i e-zin}
CzasNaE-Biznes to {~codzienna gazeta ~książka =serwis www} o marketingu i biznesie.
CzasNaE-Biznes to codzienna gazeta.{FALSE}
CzasNaE-Biznes to?{=serwis www =e-zin}
Kiedy powstał CzasNaE-Biznes?{#2000}

**Format Aiken**
Format Akien to bardzo prosty sposób tworzenia pytań wielokrotnego wyboru używając łatwego dla człowieka formatu. Oto przykład:
Jaka jest poprawna odpowiedĽ na to pytanie?
A. Czy to ta odpowiedĽ?
B. A może ta?
C. A może jednak ta?
D. Czy jednak może ta?
ANSWER: D

**Brakujące słowo**
Format ten obsługuje jedynie pytania wielokrotnego wyboru. Kaza odpowiedź jest oddzielona tylką (~). Poprawna odpowiedź jest poprzedzona znakiem równości (=). Oto przykład:
> Bedąc jeszcze niemowlęciami, gdy tylko rozpoczniemy poznawać własne ciało, stajemy się studentami {=anatomii i fizjologii ~prawa ~psychologii}.
**AON**
Jest to inna wersja formatu "Brakujące słowo". W AON po zaimportowaniu pytań, wszystkie pytania typu krótkie odpowiedzi są konwertowane po 4 na raz w pytania typu dopasuj odpowiedź.
Dodatkowo odpowiedzi pytań wielokrotnego wyboru są losowo wymieszane.
Format ten jest nazwany na czejść organizacji, która wspierała stworzenie wielu cech quizu.
**Blackboard**
Ten moduł potrafi importować pytania zapisane w formacie eksportowym Blackboard. Opiera się on o funkcje XML.

** CTM ("Course Test Manager")**
Moduł ten pozwala importować pytania stworzone przy pomocy programu Course Test Manager. Pliki CTM są zapisane w formacie Microsoft Access, więc sposób importowanie zależny jest od tego, czy Moodle działa na Windows czy na Unixie.
W przypadku Windows możesz po prostu zaimportować plik z bazą danych pytań tak, jak każdy inny plik.
W przypadku Linuxa musisz włączyć maszynę windows w tej samej sieci z zainstalowaną bazą CTM oraz programeme ODBC Socket Server, który prześle dane w formacie XML do Moodle.
Przeczytaj plik pomocy zanim zaczniesz importować w tym formacie.

**Własny format**
Jeśli masz swój własny format, możesz go uzywać, jeśli odpowiednio zmodyfikujesz mod/quiz/format/custom.php
Liczba niezbędnego nowego kodu jest dosyć niewielka - tylko tyle aby przetworzyć tekst na pytanie.
Tworzymy już nowe formaty: WebCT, IMS QTI i cokolwiek jeszcze zapragną członkowie społeczności Moodle!';
$string['importcategory'] = 'importuj kategorię';
$string['importerror'] = 'Błąd podczas importu pliku';
$string['importfilearea'] = 'Importuj z pliku znajdującego się w plikach kursu';
$string['importfileupload'] = 'Import z pobranego pliku';
$string['importfromthisfile'] = 'Import z tego pliku';
$string['importingquestions'] = 'Importowanie {$a} pytań z pliku';
$string['importmax10error'] = 'Tu jest błąd w pytaniu. Nie można mieć więcej niż 10 odpowiedzi.';
$string['importmaxerror'] = 'W pytaniu występuje błąd. Zbyt dużo odpowiedzi.';
$string['importquestions'] = 'Importuj pytania z pliku';
$string['incorrect'] = 'Niepoprawnie';
$string['indivresp'] = 'Indywidualne odpowiedzi na dane pytanie';
$string['info'] = 'Informacja';
$string['infoshort'] = 'info';
$string['inprogress'] = 'W toku';
$string['introduction'] = 'Wprowadzenie';
$string['invalidcategory'] = 'ID kategorii jest niewłaściwe';
$string['invalidnumericanswer'] = 'Jedna z wprowadzonych odpowiedzi nie jest poprawną liczbą.';
$string['invalidnumerictolerance'] = 'Jedna z wprowadzonych tolerancji nie jest poprawną liczbą.';
$string['invalidquestionid'] = 'Nieprawidłowe id pytania';
$string['invalidquizid'] = 'Nieprawidłowe ID quizu';
$string['invalidsource'] = 'Dane źródło nie są prawidłowe';
$string['invalidsourcetype'] = 'Niepoprawne dane źródłowe';
$string['lastanswer'] = 'Twoja ostatnia odpowiedź to';
$string['layout'] = 'Wygląd';
$string['layoutshuffledandpaged'] = 'Ułóż pytania losowo, umieść {$a} pytań na stronę.';
$string['layoutshuffledsinglepage'] = 'Ułóż pytania losowo, wszystkie na jednej stronie.';
$string['link'] = 'Link';
$string['listitems'] = 'Lista pytań w quizie';
$string['literal'] = 'Znak';
$string['loadingquestionsfailed'] = 'Przesyłanie pytań zakończone niepowodzeniem: {$a}';
$string['makecopy'] = 'Zachowaj jako nowe pytanie';
$string['managetypes'] = 'Edytuj typy pytań i serwery';
$string['manualgrading'] = 'Ocenianie';
$string['mark'] = 'Zatwierdź';
$string['markall'] = 'Zatwierdź stronę';
$string['marks'] = 'Punkty';
$string['match'] = 'Dopasuj odpowiedź';
$string['matchanswer'] = 'Pasująca odpowiedź';
$string['matchanswerno'] = 'Pasująca odpowiedź {$a}';
$string['max'] = 'Max.';
$string['min'] = 'Min.';
$string['minutes'] = 'Minuty';
$string['missingcorrectanswer'] = 'Poprawna odpowiedź musi być określona';
$string['missingitemtypename'] = 'Pominięto nazwę';
$string['missingquestion'] = 'Pominięto opis pytania (linia {$a})';
$string['modulename'] = 'Quiz';
$string['modulenameplural'] = 'Quizy';
$string['moveselectedonpage'] = 'Przesuń zaznaczone pytania na stronę: {$a}';
$string['multichoice'] = 'Wielokrotny wybór';
$string['multipleanswers'] = 'Wybierz co najmniej jedną odpowiedź';
$string['multiplier'] = 'Mnożnik';
$string['name'] = 'Imię';
$string['navnojswarning'] = 'Uwaga: te linki nie zapiszą twoich odpowiedzi. Użyj następnego przycisku na dole strony.';
$string['neverallononepage'] = 'Nigdy, wszystkie pytania na jednej stronie';
$string['newattemptfail'] = 'Błąd: Nie można uruchomić na nowo quizu.';
$string['newpage'] = 'Nowa strona';
$string['newpage_help'] = 'Dla dłuższych quizów można podzielić quiz na strony. Przy wstawianiu pytania podział na strony będzie tworzony automatycznie zgodnie z tym ustawieniem. Można później ręcznie zmieniać granice strony.';
$string['newpageevery'] = 'Automatycznie rozpocznij nową stronę';
$string['noanswers'] = 'Nie wybrano odpowiedzi!';
$string['noattempts'] = 'Nie ma podejść do quizu';
$string['noattemptsfound'] = 'Nie znaleziono prób.';
$string['noattemptstoshow'] = 'Nie ma żadnych podejść do pokazania';
$string['nocategory'] = 'Nieprawidłowa lub nieokreślona kategoria';
$string['noclose'] = 'Brak daty zamknięcia';
$string['nocommentsyet'] = 'Nie ma jeszcze komentarzy';
$string['noconnection'] = 'Nie ma obecnie łączności z serwerem, który może sprawdzić te pytanie. Proszę skontaktować się z administratorem.';
$string['nodataset'] = 'nic - to nie jest wildcard';
$string['nodatasubmitted'] = 'Nie przesłano żadnych danych';
$string['noessayquestionsfound'] = 'Nie znaleziono ręcznie ocenionych pytań';
$string['nogradewarning'] = 'Kwiz nie jest oceniany, więc nie można ustawić ogólnej opinii różniących się oceną.';
$string['nomoreattempts'] = 'Dalsze podejścia nie są dostępne';
$string['none'] = 'Żaden';
$string['noopen'] = 'Brak daty otwarcia';
$string['nopossibledatasets'] = 'Brak zestawów';
$string['noquestionintext'] = 'Tekst pytania nie zawiera żadnych zamieszczonych pytań';
$string['noquestions'] = 'Nie dodano jeszcze żadnego pytania';
$string['noquestionsfound'] = 'Nie można znaleźć pytań';
$string['noquestionsinquiz'] = 'Brak pytań w tym quizie.';
$string['noquestionsnotinuse'] = 'To losowe pytanie nie może być użyte, odkąd jego kategoria jest pusta.';
$string['noquestionsonpage'] = 'Pusta strona';
$string['noresponse'] = 'Brak odpowiedzi';
$string['noreview'] = 'Nie możesz przeglądać tego quizu';
$string['noreviewattempt'] = 'Nie masz uprawnień do dokonania przeglądu tej próby.';
$string['noreviewshort'] = 'Niedozwolone';
$string['noreviewuntil'] = 'Nie możesz przeglądać tego quizu do {$a}';
$string['noreviewuntilshort'] = 'Dostępny {$a}';
$string['noscript'] = 'JavaScript musi być włączony aby można było kontynuować!';
$string['notavailabletostudents'] = 'Uwaga: Ten quiz jest obecnie niedostępny dla studentów.';
$string['notenoughrandomquestions'] = 'Niestety nie ma wystarczająco dużo pytań w kategorii {$a->category}, by utworzyć pytanie {$a->name} ({$a->id}).';
$string['notenoughsubquestions'] = 'Nie zdefiniowano wystarczającej liczby podpunktów pytań! <br /> Czy chcesz wrócić i poprawić pytanie?';
$string['notimedependentitems'] = 'Czynniki zależne czasowo nie są w tej chwili wspierane przez moduł quizu. Tak jak dla całości pracy ustaw limit czasu dla całego quizu. Chcesz wybrać inny czynnik (lub mimo to używać obecnego)?';
$string['notyetgraded'] = 'Jeszcze nie ocenione';
$string['notyetviewed'] = 'Jeszcze nie wyświetlany';
$string['notyourattempt'] = 'To nie jest Twoja próba!';
$string['noview'] = 'Zalogowany użytkownik nie może zobaczyć tego quizu';
$string['numattempts'] = '{$a->studentnum} {$a->studentstring} wykonał {$a->attemptnum} podejść';
$string['numattemptsmade'] = 'Ten quiz próbowano rozwiązać {$a} razy.';
$string['numberabbr'] = '#';
$string['numerical'] = 'Numeryczne';
$string['numquestionsx'] = 'Pytania:  {$a}';
$string['onlyteachersexport'] = 'Tylko nauczyciele może eksportować pytania';
$string['onlyteachersimport'] = 'Tylko nauczyciele z prawami edycji mogą importować pytania';
$string['onthispage'] = 'Ta strona';
$string['open'] = 'Nie udzielono odpowiedzi';
$string['openclosedatesupdated'] = 'Zaktualizowano daty rozpoczęcia i zakończenia quizu.';
$string['optional'] = 'opcjonalny';
$string['orderandpaging'] = 'Zmiana układu stron i porządkowanie';
$string['orderingquiz'] = 'Zmiana układu stron i porządkowanie';
$string['outof'] = '{$a->grade} z możliwych do uzyskania {$a->maxgrade}';
$string['outofpercent'] = '{$a->grade} przekracza maksimum okreslone na  {$a->maxgrade} ({$a->percent}%)';
$string['outofshort'] = '{$a->grade}/{$a->maxgrade}';
$string['overallfeedback'] = 'Całościowa informacja zwrotna';
$string['overallfeedback_help'] = '# Opinia ogólna
Opinia ogólna to tekst wyświetlany dla uczestnika po zakończeniu rozwiązywania kwizu. Wyświtlany tekst zależy od oceny uzyskanej przez uczestnika.
Na przykład w razie wprowadzenia:
Granica oceny: 100%
Opinia: Dobra robota
Granica oceny: 40%
Opinia: Jeszcze raz zapoznaj się z pracami z tego tygodnia
...
Granica oceny: 0%
Następnie uczestnicy, którzy uzyskali wynik w przedziale od 100% do 40%, zobaczą komunikat "Dobra robota", a uczestnicy, którzy uzyskają wynik w przedziale od 39,99% do 0% zobaczą inny komunikat. Czyli granice oceny definiują zakresy ocen, zaś każdy ciąg opinii jest wyświetlany dla ocen w odpowiednim zakresie.
Granice ocen można określić jako wartości procentowe, na przykład "31,41%", albo jako liczby, na przykład "7". Jeśli dany kwiz ma skalę ocen do 10, granica oceny równa 7 oznacza wynik 7/10 lub lepszy.';
$string['overdue'] = 'Zaległy';
$string['override'] = 'Zastąp';
$string['overridegroupeventname'] = '{$a->quiz} - {$a->group}';
$string['page-mod-quiz-edit'] = 'Edytuj stronę quizu';
$string['pagesize'] = 'Liczba podejść na stronę:';
$string['parent'] = 'Nadrzędny';
$string['parentcategory'] = 'Kategoria nadrzędna';
$string['parsingquestions'] = 'Przetwarzanie pytań z importowanego pliku.';
$string['partiallycorrect'] = 'Częściowo poprawnie';
$string['penalty'] = 'Kara';
$string['penaltyscheme'] = 'Zastosuj kary';
$string['penaltyscheme_help'] = 'Jeżeli quiz jest uruchomiaony w odpowiednim trybie student może spróbować ponownie rozwiązać quiz po tym jak źle odpowie. W tym przypadku można chciać nakładać kary dla złych odpowiedzi odejmowane od końcowej oceny za pytanie. Ilość sankcji karnej jest wybierana indywidualnie dla każdego pytania podczas tworzenia albo edycji pytania.
Ustawienie nie ma żadnego wpływu jeżeli quiz nie jest uruchomiony w odpowiednim trybie.';
$string['percentcorrect'] = 'Procent poprawnych odpowiedzi';
$string['pleaseclose'] = 'Żądanie zostało wykonane. Można już zamknąć okno.';
$string['pluginadministration'] = 'Administracja quizu';
$string['pluginname'] = 'Quiz';
$string['popup'] = 'Pokaż quiz w "bezpiecznym" oknie';
$string['popupblockerwarning'] = 'Być może będziesz musiał rozwiązać quiz w bezpiecznym oknie. Wyłącz blokadę okien wyskakujących.';
$string['popupnotice'] = 'Studenci będą widzieć ten quiz w "bezpiecznym" oknie';
$string['preview'] = 'Podgląd';
$string['previewquestion'] = 'Podgląd pytania';
$string['previewquiz'] = 'Podgląd {$a}';
$string['previewquiznow'] = 'Pokaż podgląd quizu';
$string['previous'] = 'Poprzedni stan';
$string['publish'] = 'Opublikuj';
$string['publishedit'] = 'Musisz mieć odpowiednie uprawnienia w kursie aby dodawać lub edytować pytania w tej kategorii';
$string['qbrief'] = 'Pyt. {$a}';
$string['qname'] = 'nazwa';
$string['qti'] = 'Format IMS QTI';
$string['qtypename'] = 'typ, nazwa';
$string['question'] = 'Pytanie';
$string['questionbankcontents'] = 'Zawartość bazy pytań';
$string['questionbehaviour'] = 'Zachowanie pytań';
$string['questioncats'] = 'Kategorie pytań';
$string['questiondeleted'] = 'To pytanie zostało usunięte. Skontaktuj się ze swoim nauczycielem';
$string['questioninuse'] = 'Pytanie \'{$a->questionname}\' jest używane w: <br />{$a->quiznames}<br />To pytanie nie zostanie usunięte z tych quizów, lecz tylko z listy kategorii.';
$string['questionname'] = 'Nazwa pytania';
$string['questionnonav'] = '<span class="accesshide">Pytanie </span>{$a->number}<span class="accesshide"> {$a->attributes}</span>';
$string['questionnonavinfo'] = '<span class="accesshide">Informacja</span>{$a->number}<span class="accesshide"> {$a->attributes}</span>';
$string['questionnotloaded'] = 'Pytanie {$a} nie zostało załadowane z bazy danych';
$string['questionorder'] = 'Kolejność pytań';
$string['questions'] = 'Pytania';
$string['questionsinclhidden'] = 'Pytania (również ukryte)';
$string['questionsinthisquiz'] = 'Pytania tego quizu';
$string['questionsperpage'] = 'Pytań na stronie';
$string['questionsperpagex'] = 'Pytań na stonę: {$a}';
$string['questiontext'] = 'Tekst pytania';
$string['questiontextisempty'] = '[Pusty tekst pytania]';
$string['questiontype'] = 'Pytanie typu {$a}';
$string['questiontypesetupoptions'] = 'Ustawienia dla typów pytań:';
$string['quiz:attempt'] = 'Rozwiąż quizy';
$string['quiz:deleteattempts'] = 'Usuń podejścia do quizów';
$string['quiz:emailconfirmsubmission'] = 'Potwierdź e-mailem po wysłaniu';
$string['quiz:emailnotifysubmission'] = 'Powiadom e-mailem o podejściach';
$string['quiz:grade'] = 'Oceniaj quizy ręcznie';
$string['quiz:ignoretimelimits'] = 'Ignoruje limit czasu w quizach';
$string['quiz:manage'] = 'Zarządzaj quizami';
$string['quiz:preview'] = 'Podgląd quizów';
$string['quiz:regrade'] = 'Oceń ponownie podejścia';
$string['quiz:reviewmyattempts'] = 'Zobacz swoje rozwiązania';
$string['quiz:view'] = 'Pokaż informacje o quizie';
$string['quiz:viewreports'] = 'Oglądaj raporty quizów';
$string['quizavailable'] = 'Quiz jest dostępny do: {$a}';
$string['quizclose'] = 'Zamknij quiz';
$string['quizclosed'] = 'Ten quiz został zamknięty {$a}';
$string['quizcloses'] = 'Quiz kończy się';
$string['quizcloseson'] = 'Ten quiz zakończy się {$a}';
$string['quizisclosed'] = 'Ten quiz jest zamknięty';
$string['quizisclosedwillopen'] = 'Quiz zamknięty (zostanie otwarty {$a})';
$string['quizisopen'] = 'Ten quiz jest otwarty';
$string['quizisopenwillclose'] = 'Quiz otwarty (do {$a})';
$string['quiznavigation'] = 'Nawigacja quizem';
$string['quizopen'] = 'Otwórz quiz';
$string['quizopenclose'] = 'Daty otwarcia i zamknięcia';
$string['quizopened'] = 'Ten quiz jest otwarty.';
$string['quizopenedon'] = 'Ten quiz zostanie otwarty {$a}';
$string['quizopens'] = 'Quiz się otwiera';
$string['quizopenwillclose'] = 'Ten quiz jest otwarty (zostanie zamknięty {$a})';
$string['quizsettings'] = 'Ustawienia quizu';
$string['quiztimer'] = 'Licznik czasu quizu';
$string['quizwillopen'] = 'Ten quiz zostanie otwarty {$a}';
$string['random'] = 'Pytanie wybierane losowo';
$string['randomcreate'] = 'Utwórz pytania wybierane losowo';
$string['randomfromcategory'] = 'Pytanie wybierane losowo z kategorii:';
$string['randomfromexistingcategory'] = 'Pytanie wybierane losowo z istniejącej kategorii';
$string['randomnosubcat'] = 'Pytania tylko z tej kategorii, z wyłączeniem subkategorii';
$string['randomquestionusinganewcategory'] = 'Pytanie wybierane losowo wykorzystujące nową kategorię';
$string['randomwithsubcat'] = 'Pytania z tej kategorii i jej podkategorii.';
$string['readytosend'] = 'Za chwilę twoje podejście do quizu zostanie przesłane do ocenienia. Czy chcesz kontynuować?';
$string['reattemptquiz'] = 'Ponownie rozwiąż quiz';
$string['recentlyaddedquestion'] = 'Ostatnio dodane pytanie!';
$string['recurse'] = 'Pokaż pytania z podkategorii';
$string['regrade'] = 'Ponownie oceń wszystkie próby';
$string['regradecomplete'] = 'Wszystkie próby zostały ponownie ocenione';
$string['regradecount'] = 'Zmieniono {$a->changed} z {$a->attempt} ocen';
$string['regradedisplayexplanation'] = 'Próby, które zostały zmienione podczas ponownego oceniania, są pokazane jako łącza';
$string['regradenotallowed'] = 'Nie masz uprawnień do ponownej oceny tego quizu.';
$string['regradingquestion'] = 'Oceń ponownie "{$a}"';
$string['regradingquiz'] = 'Oceń ponownie quiz "{$a}"';
$string['remove'] = 'Usuń';
$string['removeallquizattempts'] = 'Usuń wszystkie podejścia';
$string['removeemptypage'] = 'Usuń pustą stronę';
$string['removeselected'] = 'Usuń zaznaczone';
$string['rename'] = 'Zmień nazwę';
$string['renderingserverconnectfailed'] = 'Serwer {$a} jest niedostępny. Sprawdź, czy adres URL jest poprawny.';
$string['reorderquestions'] = 'Zmień kolejność pytań';
$string['reordertool'] = 'Pokaż narzędzia do reorganizacji';
$string['repaginate'] = 'Zmień układ stron na {$a} pytań na stronę';
$string['repaginatecommand'] = 'Zmień układ stron';
$string['repaginatenow'] = 'Zmień układ stron teraz';
$string['replace'] = 'Zastąp';
$string['replacementoptions'] = 'Zmień opcje';
$string['report'] = 'Raporty';
$string['reportanalysis'] = 'Pozycje analizy';
$string['reportfullstat'] = 'Szczegółowe statystyki';
$string['reportmulti_percent'] = 'Multi-Procenty*';
$string['reportmulti_q_x_student'] = 'Wybory wielu studentów';
$string['reportmulti_resp'] = 'Indywidualne odpowiedzi';
$string['reportnotfound'] = 'Nieznany raport ({$a})';
$string['reportoverview'] = 'Przegląd';
$string['reportregrade'] = 'Ponownie oceń próby';
$string['reportresponses'] = 'Szczegółowe odpowiedzi';
$string['reports'] = 'Raporty';
$string['reportsimplestat'] = 'Proste statystyki';
$string['requirepassword'] = 'Wymagane hasło';
$string['requirepassword_help'] = 'To pole jest opcjonalne
Jeśli wpiszesz tutaj hasło, studenci bedą musieli je podać aby
wypełnić quiz.';
$string['requiresubnet'] = 'Potrzebny adres sieci';
$string['requiresubnet_help'] = 'To pole jest opcjonalne.
Możesz ograniczyć dostęp do quizu do konkretnych studentów
łączących się za pomocą sieci LAN lub Internetu definiując listę oddzielonych przecinkami pełnych lub częściowych adresów IP.
Przykład: **192.168. , 231.54.211.0/20, 231.3.56.211**
Są dostępne trzy sposoby zapisu adresu IP (nie możesz używać
nazwy hostów czy domeny, tylko adresy IP):
1. Pełen adres IP, taki jak **192.168.10.1** który jest przypisany do jednego komputera lub do serwera proxy.
2. Częściowy adres, taki jak **192.168**, który wpuści wszystkie adresy zaczynające się od tych cyfr.
3. Zapis CIDR, taki jak **231.54.211.0/20**, który zezwala Ci na zdefiniowanie konkretnych podsieci.


Spacje są ignorowane.';
$string['response'] = 'Odpowiedź';
$string['responses'] = 'Udzielone odpowiedzi';
$string['results'] = 'Wyniki';
$string['reuseifpossible'] = 'ponownie użyj poprzednio skasowane';
$string['reverttodefaults'] = 'Przywróć domyślne ustawienia quizu';
$string['review'] = 'Przegląd';
$string['reviewafter'] = 'Pozwól przeglądać po zamknięciu quizu';
$string['reviewalways'] = 'Pozwól przeglądać w dowolnym momencie';
$string['reviewbefore'] = 'Pozwól przeglądać, gdy quiz jest otwarty';
$string['reviewclosed'] = 'Po zamknięciu quizu';
$string['reviewduring'] = 'Podczas próby';
$string['reviewimmediately'] = 'Natychmiast po próbie';
$string['reviewnever'] = 'Nigdy nie pozwalaj przeglądać';
$string['reviewofattempt'] = 'Przerzyj próbę {$a}';
$string['reviewofpreview'] = 'Przegląd podglądu';
$string['reviewopen'] = 'Później, gdy quiz jest wciąż otwarty';
$string['reviewoptions'] = 'Student może przeglądać';
$string['reviewoptionsheading'] = 'Opcje przeglądu';
$string['reviewresponse'] = 'Przejrzyj odpowiedzi';
$string['reviewresponsetoq'] = 'Przejrzyj odpowiedzi (pytanie {$a})';
$string['rqp'] = 'Obce (zdalne) pytanie';
$string['rqps'] = 'Obce (zdalne) pytania';
$string['save'] = 'Zapisz';
$string['saveandedit'] = 'Zapisz zmiany i edytuj pytania';
$string['savedfromdeletedcourse'] = 'Zachowany z usuniętego kursu "{$a}"';
$string['savegrades'] = 'Zapisz oceny';
$string['savemyanswers'] = 'Zapisz moje odpowiedzi';
$string['savenosubmit'] = 'Zapisz bez wysyłania rozwiązania';
$string['savequiz'] = 'Zapisz cały quiz';
$string['saving'] = 'Zapisywanie';
$string['score'] = 'Wynik';
$string['scores'] = 'Punkty';
$string['select'] = 'Wybierz';
$string['selectall'] = 'Wybierz wszystkie';
$string['selectcategory'] = 'Wybierz kategorię';
$string['selectedattempts'] = 'Wybrane podejścia...';
$string['selectnone'] = 'Odznacz wszystkie';
$string['selectquestiontype'] = '-- Wybierz typ pytania --';
$string['serveradded'] = 'Dodaj serwer';
$string['serveridentifier'] = 'Identyfikator';
$string['serverinfo'] = 'Informacje serwera';
$string['servers'] = 'Serwery';
$string['serverurl'] = 'Adres URL serwera';
$string['shortanswer'] = 'Krótka odpowiedź';
$string['show'] = 'Pokaż';
$string['showall'] = 'Pokaż wszystkie pytania na stronie';
$string['showblocks'] = 'Pokaż bloki kursu podczas rozwiązywania quizu';
$string['showbreaks'] = 'Pokaż granice strony';
$string['showcorrectanswer'] = 'Czy informacja zwrotna ma zawierać poprawne odpowiedzi?';
$string['showdetailedmarks'] = 'Pokaż szczegóły';
$string['showeachpage'] = 'Pokaż jedną stronę na raz';
$string['showfeedback'] = 'Wyświetlić informację zwrotną po udzieleniu odpowiedzi?';
$string['showinsecurepopup'] = 'Pokaż quiz w \'bezpiecznym\' oknie';
$string['shownoattempts'] = 'Pokaż studentów, którzy nie podeszli do quizu';
$string['shownoattemptsonly'] = 'Pokaż tylko tych studentów, którzy nie podeszli do quizu';
$string['showteacherattempts'] = 'Pokaż próby';
$string['showuserpicture'] = 'Pokaż zdjęcie użytkownika';
$string['shuffle'] = 'Zmień kolejność';
$string['shuffleanswers'] = 'Zmień kolejność odpowiedzi';
$string['shuffledrandomly'] = 'Ułóż losowo';
$string['shufflequestions'] = 'Zmień kolejność pytań';
$string['shufflewithin'] = 'Zmień kolejność wewnątrz pytania';
$string['shufflewithin_help'] = '# Mieszaj w ramach pytań
W przypadku włączenia tej opcji części tworzące poszczególne pytania zostaną losowo wymieszane przy każdej próbie rozwiązania kwizu przez uczestnika, zakładając że opcja ta jest również włączona w ustawieniach pytania.
Celem jest pewne utrudnienie uczestnikom ściągania od siebie.
Dotyczy to tylko pytań mających wiele części, takich jak pytania wielokrotnego wyboru lub zgodności. W przypadku pytań wielokrotnego wyboru kolejność odpowiedzi jest mieszana tylko, gdy ta opcja jest ustawiona na "Tak". W przypadku pytań zgodności odpowiedzi są zawsze mieszane, a to ustawienie kontroluje, czy dodatkowo zostanie wymieszana kolejność par pytanie-odpowiedź.
Ta opcja nie jest powiązana z użyciem pytań losowych.';
$string['singleanswer'] = 'Wybierz odpowiedź';
$string['sortage'] = 'Sortuj według wieku';
$string['sortalpha'] = 'Sortuj według nazwy';
$string['sortquestionsbyx'] = 'Sortuj pytania wg: {$a}';
$string['sortsubmit'] = 'Sortuj pytania';
$string['sorttypealpha'] = 'Sortuj według typu, nazwy';
$string['startagain'] = 'Zacznij od nowa';
$string['startattempt'] = 'Rozpocznij próbę';
$string['startedon'] = 'Rozpoczęto';
$string['status'] = 'Status';
$string['stoponerror'] = 'Zatrzymaj na błędzie';
$string['submitallandfinish'] = 'Zatwierdź wszystkie i zakończ';
$string['subneterror'] = 'Możesz podejść do quizu tylko z pewnych miejsc. Obecnie twój komputer nie znajduje się w takim miejscu.';
$string['subnetnotice'] = 'Możesz podejść do quizu tylko z pewnych miejsc. Obecnie twój komputer znajduje się w takim miejscu. Jako nauczyciel, możesz jednak dokonać podglądu quizu.';
$string['subplugintype_quiz'] = 'Raport';
$string['subplugintype_quiz_plural'] = 'Raporty';
$string['substitutedby'] = 'zastanie zastąpiony przez';
$string['summaryofattempt'] = 'Podsumowanie próby';
$string['summaryofattempts'] = 'Podsumowanie twoich poprzednich podejść';
$string['temporaryblocked'] = 'Tymczasowo nie możesz ponownie rozwiązać quizu. Będziesz miał taka możliwość za:';
$string['theattempt'] = 'Próba';
$string['time'] = 'Czas';
$string['timecompleted'] = 'Zakończono';
$string['timedelay'] = 'Nie możesz rozpocząć quizu, gdyż nie upłynął ustalony czas pomiędzy kolejnymi quizami';
$string['timeleft'] = 'Pozostały czas';
$string['timelimit'] = 'Limit czasu';
$string['timelimit_help'] = '**Ograniczenie czasowe**
Domyślnie quizy nie mają ograniczenia czasowego. Student więc ma tyle czasu ile mu potrzeba na wypełnienie quizu.
Jeśli ustalisz ograniczenie czasowe, Moodle robi kilka rzeczy aby
zapewnić jego przestrzeganie:

* Wymagana jest obsługa JS w przeglądarce - dzięki temu działa stoper.
* Na stronie pokazuje się stoper odliczający czas.
* Gdy czas dobiegnie końca, quiz jest automatycznie wysyłany z takimi odpowiedziami,
jakich udzielił do tej pory student.
* Jeśli studentowi udało się oszukać i poświęcił na quiz więcej niż 60 sekund ponad limit, otrzyma ocenę równą 0.';
$string['timelimitexeeded'] = 'Upłynął limit czasu!';
$string['timelimitmin'] = 'Limit czasu (w minutach)';
$string['timelimitsec'] = 'Limit czasu (w sekundach)';
$string['timestr'] = '%H:%M:%S na %d/%m/%y';
$string['timesup'] = 'Koniec czasu';
$string['timetaken'] = 'Wykorzystany czas';
$string['tofile'] = 'do pliku';
$string['tolerance'] = 'Tolerancja';
$string['toomanyrandom'] = 'Liczba potrzebnych pytań wybieranych losowo jest większa od liczby pytań w tej kategorii! ({$a})';
$string['top'] = 'Góra';
$string['totalquestionsinrandomqcategory'] = 'Łącznie {$a} pytań w kategorii.';
$string['true'] = 'Prawda';
$string['truefalse'] = 'Prawda/Fałsz';
$string['type'] = 'Typ';
$string['unfinished'] = 'otwórz';
$string['ungraded'] = 'nieocenione';
$string['unit'] = 'Jednostka';
$string['unknowntype'] = 'Nie można odnaleźć tego typu pytania w linii {$a}. Pytanie zostanie zignorowane.';
$string['unusedcategorydeleted'] = 'Kategoria została usunięta, gdyż, po usunięciu kursu jej pytania nie były wykorzystane.';
$string['updatesettings'] = 'Uaktualnij ustawienia quizu';
$string['upgradesure'] = '<div style="color: red;">Moduł quiz przeszedł szereg zmian. Uaktualnienie quizów nie zostało jeszcze dostatecznie sprawdzone. Dla bezpieczeństwa zalecamy zrobienie kopii zapasowych tabel z quizami przed przystąpieniem do uaktualnienia.</div>';
$string['url'] = 'URL';
$string['usedcategorymoved'] = 'Kategoria zostanie zachowana i przesunięta, ponieważ jej pytania są używane w innych kursach.';
$string['usersnone'] = 'Studenci nie mają dostępu do tego quizu';
$string['validate'] = 'Sprawdź';
$string['viewallanswers'] = 'Przeglądaj {$a} ukończonych quizów';
$string['viewallreports'] = 'Obejrzyj raporty dla {$a} podejść';
$string['warningmissingtype'] = '<p><b>Ten typ pytania nie jest jeszcze zainstalowany<br/>Poinformuj o tym Administratora Platformy Moodle.</b></p>';
$string['wheregrade'] = 'Gdzie jest moja ocena?';
$string['wildcard'] = 'Wildcard';
$string['windowclosing'] = 'To okno zostanie niedługo zamknięte';
$string['withsummary'] = 'wraz z ogólną statystyką';
$string['wronguse'] = 'Nie można wyświetlić strony';
$string['xhtml'] = 'Format XHTML';
$string['youneedtoenrol'] = 'Aby móc rozwiązywać ten quiz, musisz najpierw zapisać się do tego kursu.';
$string['yourfinalgradeis'] = 'Twoja końcowa ocena za ten quiz wynosi {$a}';
