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
 * Strings for component 'lesson', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   lesson
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Kontrola dostępu';
$string['actionaftercorrectanswer'] = 'Po poprawnej odpowiedzi';
$string['actionaftercorrectanswer_help'] = '**Reakcja na poprawną odpowiedĽ**</p>
Domyślnym trybem jest przejście do strony wskazanej w linku. W większości przypadków system przejdzie
do Następnej Strony lekcji.
Jednakże lekcja może być także zorganizowana jako lekcja typu *Flash Card*.
W tym wariancie student po przedstawieniu mu pewnych informacji (co jest fakultatywne)
będzie mógł odpowiedzieć na losowe pytanie. Nie ma w tym wariancie ustalonego początku ani końca.
W tym typie lekcji jest tylko zestaw \*Kart\* wyświetlanych losowo jedna po drugiej.
Ta opcja oferuje dwa dalsze podobne warianty zachowania się systemu. Opcja "Nigdy nie pokazuj tej
samej strony dwuktronie"
nigdy nie pokaże tej samej strony dwa razy (nawet jeśli student **nie** odpowiedział na pytanie poprawnie).
Druga opcja "Umożliw wielokrotne przeglądanie stron z błędną odpowiedzią" pozwala na przeglądanie już wyświetlonych stron tylko
gdy student błędnie odpowiedział na pytanie na danej stronie.
W każdym z powyższych wariantów lekcji typu Flash Card nauczyciel może użyć albo wszystkich stron (kart) albo losowo
dobranego podzbioru zagadnień poprzez odpowiednie użycie paramateru "Ilość stron (kart) do wyświetlenia"';
$string['actions'] = 'Akcje';
$string['activitylink'] = 'Link do składowej';
$string['activitylink_help'] = '# Łącze czynności
Menu rozwijane zawiera wszystkie czynności danego kursu. Jeśli któraś zostanie wybrana, łącze do tej czynności zostanie wyświetlone na końcu lekcji.';
$string['activitylinkname'] = 'Idź do:{$a}';
$string['addabranchtable'] = 'Wstaw tabelę rozgałęzień';
$string['addanendofbranch'] = 'Wstaw Koniec Tabeli Wątków';
$string['addanewpage'] = 'Dodaj nową stronę';
$string['addaquestionpage'] = 'Wstaw stronę pytań';
$string['addaquestionpagehere'] = 'Dodaj stronę z pytaniem';
$string['addcluster'] = 'Wstaw klaster';
$string['addedabranchtable'] = 'Dodano tabelę wątków';
$string['addedanendofbranch'] = 'Dodano Koniec Tabeli Wątków';
$string['addedaquestionpage'] = 'Dodano  Stronę Pytań';
$string['addedcluster'] = 'Dodano klaster';
$string['addedendofcluster'] = 'Dodano koniec klastra';
$string['addendofcluster'] = 'Wstaw koniec klastra';
$string['addpage'] = 'Dodaj stronę';
$string['anchortitle'] = 'Start głównej zawartości';
$string['and'] = 'i';
$string['answer'] = 'Odpowiedź';
$string['answeredcorrectly'] = 'Odpowiedź poprawna';
$string['answersfornumerical'] = 'Odpowiedzi dla numerycznych pytań powinny odpowiadać wartościom Minimum i Maximum';
$string['arrangebuttonshorizontally'] = 'Uporządkować wątki poziomo?';
$string['attempt'] = 'Podejście: {$a}';
$string['attempts'] = 'Podejścia';
$string['attemptsdeleted'] = 'Usunięte podejścia';
$string['attemptsremaining'] = 'Pozostało Ci {$a} podejść';
$string['available'] = 'Dostępne od';
$string['averagescore'] = 'Średnia liczba punktów';
$string['averagetime'] = 'Średni czas';
$string['branch'] = 'Zawartość';
$string['branchtable'] = 'Tabela Wątków';
$string['cancel'] = 'Anuluj';
$string['cannotfindanswer'] = 'Błąd: nie znaleziono odpowiedzi';
$string['cannotfindattempt'] = 'Błąd: nie znaleziono podejść';
$string['cannotfindfirstgrade'] = 'Błąd: nie znaleziono ocen';
$string['cannotfindfirstpage'] = 'Nie można znaleźć pierwszej strony';
$string['cannotfindgrade'] = 'Błąd: nie znaleziono ocen';
$string['cannotfindnewestgrade'] = 'Błąd: nie znaleziono najnowszych ocen';
$string['cannotfindnextpage'] = 'Kopia zapasowa lekcji: Nie znaleziono następnej strony!';
$string['cannotfindpages'] = 'Nie znaleziono stron z lekcjami';
$string['cannotfinduser'] = 'Błąd: nie znaleziono użytkowników';
$string['canretake'] = 'Powtórzenie lekcji';
$string['casesensitive'] = 'Użyj wyrażeń regularnych';
$string['casesensitive_help'] = 'Niektóre z typów pytań mogą być rozszerzone poprzez wybór opcji pytania za pomocą okienka wyboru (checkbox).
Uwagi poniższe odnoszą się do następujących typów pytań:
1.**Wielokrotny wybór** To wariant pytań wielokrotnego wyboru zwany
**"Wiele dobrych odpowiedzi"**. Jeśli opcja ta zostanie wybrana
wówczas student musi wskazać wszystki poprawne odpowiedzi w ramach zestawu odpowiedzi.
Pytanie może podpowiedzieć studentowi ile odpowiedzi jest poprawnych n.p. Wskaż dwóch prezedyentów
USA z poniższej listy. Liczba właściwych odpowiedzi może być minimalnie 1 i maksymalnie tyle
ile jest odpowiedzi do zakreślenia. W klasycznym pytaniu wielokrotnego wyboru student wybiera tylko
jedną dobrą odpowiedĽ i tym różni się od tego typu pytań ten wariant.
2.**Krótka odpowiedĽ** Domyślnie system ignoruje wielkość liter w odpowiedziach. Jeśli Opcja pytania
zostania wybrana, wówczas system będzie sprawdzał użycie liter.
Inne typy pytań nie wykorzystują Opcji pytań.';
$string['checkbranchtable'] = 'Sprawdź Tabelę Wątków';
$string['checkedthisone'] = 'Sprawdzono';
$string['checknavigation'] = 'Sprawdź nawigację';
$string['checkquestion'] = 'Sprawdź pytanie';
$string['classstats'] = 'Statystyka klasy';
$string['clicktodownload'] = 'Kliknij na link, aby pobrać plik.';
$string['clicktopost'] = 'Kliknij tutaj, żeby wysłać swoją ocenę na listę najwyżej ocenionych.';
$string['clusterjump'] = 'Nie widziane pytanie w obrębie klastra';
$string['clustertitle'] = 'Nazwa klastra';
$string['collapsed'] = 'Skrócony';
$string['comments'] = 'Twój komentarz';
$string['completed'] = 'Skończono';
$string['completederror'] = 'Zakończ lekcje';
$string['completethefollowingconditions'] = 'W celu kontynuacji lekcji <b>{$a}</b> musisz zakończyć otwarte wątki.';
$string['conditionsfordependency'] = 'Warunki ochrony';
$string['confirmdelete'] = 'Usuń stronę';
$string['confirmdeletionofthispage'] = 'Potwierdź usunięcie tej strony';
$string['congratulations'] = 'Gratulacje - koniec lekcji';
$string['continue'] = 'Kontynuuj';
$string['continuetoanswer'] = 'Kontynuuj zmianę odpowiedzi';
$string['correctanswerjump'] = 'Popraw odpowiedź';
$string['correctanswerscore'] = 'Popraw punkty za odpowiedź';
$string['correctresponse'] = 'Popraw odpowiedź';
$string['credit'] = 'Ocena';
$string['customscoring'] = 'Punktacja za pytanie';
$string['customscoring_help'] = 'Pozwala ustalać liczbę punktów dla każdej odpowiedzi. Odpowiedzi mogą mieć negatywne albo pozytywne wartości. Importowane pytania automatycznie będą miały ustawiane 1 punkt dla poprawnych odpowiedzi i 0 dla nieprawidłowych, można to zmienić po skończeniu importowania.';
$string['deadline'] = 'Termin końcowy';
$string['defaultessayresponse'] = 'Twój esej będzie oceniony przez prowadzącego';
$string['deleteallattempts'] = 'Usuń wszystkie podejścia do lekcji';
$string['deletedefaults'] = 'Usuń {$a} x lekcji domyślnie';
$string['deletedpage'] = 'Usuń stronę';
$string['deleting'] = 'Usuwanie';
$string['deletingpage'] = 'Usuwanie strony: {$a}';
$string['dependencyon'] = 'W zależności od';
$string['description'] = 'Opis';
$string['detailedstats'] = 'Usuń statystykę';
$string['didnotanswerquestion'] = 'Nie odpowiedziałeś na pytanie';
$string['didnotreceivecredit'] = 'Nie otrzymałeś oceny.';
$string['displaydefaultfeedback'] = 'Wyświetl domyślną informację zwrotną';
$string['displayhighscores'] = 'Wyświetl listę najwyżej ocenionych';
$string['displayinleftmenu'] = 'Wyświetlić w lewym menu';
$string['displayleftif'] = 'Wyświetla tylko jeżeli ma wynik większy niż';
$string['displayleftmenu'] = 'Wyświetl lewe menu';
$string['displayleftmenu_help'] = 'Będzie pokazywać listę stron (Tablice wątków ) w lekcji. Nie będzie pokazywane domyślnie ( można wybierać co ma być pokazane).';
$string['displayofgrade'] = 'Wyświetl ocenę studentowi';
$string['displayreview'] = 'Wyświetl przycisk zmian';
$string['displayreview_help'] = 'Po niepoprawnej odpowiedzi będzie wyświetlony przycisk, pozwalający na zmianę odpowiedzi. Przycisk nie wyświetli się w przypadku pytania typu essej.';
$string['displayscorewithessays'] = 'Otrzymałeś {$a->score} z {$a->tempmaxgrade} za pytania oceniane automatycznie. Twój {$a->essayquestions} essej zostanie oceniony i punktu zosatną dodane</br> do oceny końcowej później. <br/><br/> Twoja aktualna ocena bez oceny z esseju jest {$a->score} z {$a->grade}';
$string['displayscorewithoutessays'] = 'Liczba Twoich punktów jest {$a->score} (z {$a->grade})';
$string['edit'] = 'Edytuj';
$string['editingquestionpage'] = 'Edytuj {$a} stronę pytań';
$string['editlessonsettings'] = 'Edytuj ustawienia lekcji';
$string['editpage'] = 'Edytuj zawartość strony';
$string['editpagecontent'] = 'Edytuj opis';
$string['email'] = 'e-mail';
$string['emailallgradedessays'] = 'Wyślij wszystkim oceny za esej';
$string['emailgradedessays'] = 'Wyślij ocenę za esej';
$string['emailsuccess'] = 'Wysłano e-mail';
$string['emptypassword'] = 'Hasło nie może być puste';
$string['endofbranch'] = 'Koniec wątka';
$string['endofcluster'] = 'Koniec klastra';
$string['endofclustertitle'] = 'Koniec klastra';
$string['endoflesson'] = 'Koniec lekcji';
$string['enteredthis'] = 'Wprowadzono';
$string['entername'] = 'Wprowadź nick, pod którym chcesz być na liście najwyżej ocenionych';
$string['enterpassword'] = 'Wprowadź hasło:';
$string['eolstudentoutoftime'] = 'Uwaga: Czas lekcji minął. Twoja ostatnia odpowiedź nie będzie się liczyła jeżeli została wysłana po czasie';
$string['eolstudentoutoftimenoanswers'] = 'Nie odpowiedziałeś na żadne pytanie. Otrzymujesz 0 z tej lekcji.';
$string['essay'] = 'Essej';
$string['essayemailmessage'] = '<p>Monit próby:<blockquote>{$a->question}</blockquote></p><p>Twoja odpowiedź:<blockquote><em>{$a->response}</em></blockquote></p><p>Komentarze {$a->teacher}:<blockquote><em>{$a->comment}</em></blockquote></p><p>Masz {$a->earned} z {$a->outof} za to pytanie próby.</p><p>Twoja ocena za lekcję została zmieniona na {$a->newgrade}&#37;.</p>';
$string['essayemailsubject'] = 'Twoja ocena za {$a} pytanie';
$string['essays'] = 'Eseje';
$string['essayscore'] = 'Punkty za esej';
$string['fileformat'] = 'Format pliku';
$string['finish'] = 'Koniec';
$string['firstanswershould'] = 'Pierwsza odpowiedź powinna przenieść do "odpowiedniej" strony';
$string['firstwrong'] = 'Niestety nie otrzymasz punktów, dlatego że odpowiedź nie była poprawna. Czy chcesz odpowiadać dalej bez otrzymania punktów?';
$string['flowcontrol'] = 'Kontrola przebiegu lekcji';
$string['full'] = 'Rozszerzony';
$string['general'] = 'Ogólne';
$string['gotoendoflesson'] = 'Przejdź do końca lekcji';
$string['grade'] = 'Ocena';
$string['gradebetterthan'] = 'Ocena wyższa niż (%)';
$string['gradebetterthanerror'] = 'Uzyskaj wynik lepszy niż {$a} %';
$string['gradeessay'] = 'Oceny za essej ({$a->notgradedcount} nieocenionych {$a->notsentcount} niewysłanych)';
$string['gradeis'] = 'Ocena: {$a}';
$string['gradeoptions'] = 'Opcje oceniania';
$string['handlingofretakes'] = 'Ocenianie wielu podejść';
$string['handlingofretakes_help'] = 'Jeśli student może robić poprawki, nauczyciel może wybrać jako ocenę końcową średnią z wszystkich prób lub najlepszy wynik.
Opcja ta może być zmieniona w dowolnym momencie.';
$string['havenotgradedyet'] = 'Jeszcze nie oceniono';
$string['here'] = 'tutaj';
$string['highscore'] = 'Najwyższa ocena';
$string['highscores'] = 'Najwyższe oceny';
$string['hightime'] = 'Najdłuższy czas';
$string['importcount'] = 'Importuj {$a} pytań';
$string['importppt'] = 'Importuj pokaz slajdów';
$string['importppt_help'] = 'Ta funkcja umożliwia import prezentacji PowerPoint 2003 (zapisanej w postaci strony sieci Web i skompresowanej do pliku zip) do lekcji.';
$string['importquestions'] = 'Importuj pytania';
$string['importquestions_help'] = 'Ta funkcja pozwala Ci zaimportować pytania z zewnętrznego pliku tekstowego, przesłanego na serwer za pomocą formularza.
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

[Więcej o formacie GIFT](help.php?file=formatgift.html&module=quiz)

**Format Aiken**
Format Akien to bardzo prosty sposób tworzenia pytań wielokrotnego wyboru używając łatwego dla człowieka formatu. Oto przykład:
Jaka jest poprawna odpowiedĽ na to pytanie?
A. Czy to ta odpowiedĽ?
B. A może ta?
C. A może jednak ta?
D. Czy jednak może ta?
ANSWER: D

[Więcej o formacie "Aiken"](help.php?file=formataiken.html&module=quiz)

**Brakujące słowo**
Format ten obsługuje jedynie pytania wielokrotnego wyboru. Kaza odpowiedź jest oddzielona tylką (~). Poprawna odpowiedź jest poprzedzona znakiem równości (=). Oto przykład:
Bedąc jeszcze niemowlęciami, gdy tylko rozpoczniemy poznawać własne ciało, stajemy się studentami {=anatomii i fizjologii ~prawa ~psychologii}.

[Więcej o formacie "Brakujące słowo"](help.php?file=formatmissingword.html&module=quiz)

**AON**
Jest to inna wersja formatu "Brakujące słowo". W AON po zaimportowaniu
pytań, wszystkie pytania typu krótkie odpowiedzi są konwertowane po 4 na raz w pytania typu dopasuj odpowiedź.
Dodatkowo odpowiedzi pytań wielokrotnego wyboru są losowo wymieszane.
Format ten jest nazwany na czejść organizacji, która wspierała stworzenie wielu cech quizu.

**Blackboard**
Ten moduł potrafi importować pytania zapisane w formacie eksportowym Blackboard. Opiera się on o funkcje XML.
[Więcej o formacie "Blackboard"](help.php?file=formatblackboard.html&module=quiz)

** CTM ("Course Test Manager")**
Moduł ten pozwala importować pytania stworzone przy pomocy programu Course Test Manager. Pliki CTM są zapisane w formacie Microsoft Access, więc sposób importowanie zależny jest od tego, czy Moodle działa na Windows czy na Unixie.

W przypadku Windows możesz po prostu zaimportować plik z bazą danych pytań tak, jak każdy inny plik.
W przypadku Linuxa musisz włączyć maszynę windows w tej samej sieci z zainstalowaną bazą CTM oraz programeme ODBC Socket Server, który prześle dane w formacie XML do Moodle.
Przeczytaj plik pomocy zanim zaczniesz importować w tym formacie.

[Więcej o formacie "CTM"](help.php?file=formatctm.html&module=quiz)

**Własny format**
Jeśli masz swój własny format, możesz go uzywać, jeśli odpowiednio zmodyfikujesz mod/quiz/format/custom.php
Liczba niezbędnego nowego kodu jest dosyć niewielka - tylko tyle aby
przetworzyć tekst na pytanie.
[Więcej o Własnym formacie](help.php?file=formatcustom.html&module=quiz)

Tworzymy już nowe formaty: WebCT, IMS QTI i cokolwiek jeszcze zapragną członkowie społeczności Moodle!';
$string['insertedpage'] = 'Wstaw stronę';
$string['invalidfile'] = 'Niepoprawny plik';
$string['invalidpageid'] = 'Nieprawidłowy identyfikator strony';
$string['jump'] = 'Przejdź';
$string['jumps'] = 'Przejścia';
$string['jumps_help'] = 'Każda odpowiedĽ zawiera link PrzejdĽ do. Po wybraniu odpowiedzi, studentowi zostanie
przedstawiona strona z informacją zwrotną. Po tym student widzi link PrzejdĽ do. Link może być
relatywny lub absolutny. Relatywne linki to: **Ta strona** i **Następna strona**.
**Ta strona** prowadzi raz jeszcze do strony którą ogląda student. **Następna strona**
prowadzi do następnej strony w logicznym układzie stron. Link absolutny z drugiej strony zawiera
zawsze tytuł strony.
Zauważ, że relatywny link **Następna strona** może wskazać różne strony jeśli zmieniany był
porządek stron. Z drugiej strony linki opierające sie na **tytule**
zawsze odwołują się do określonej strony.';
$string['jumpsto'] = 'Przejścia do <em>{$a}</em>';
$string['leftduringtimed'] = 'Czas lekcji minął.<br/> Kliknij \'Kontynuuj\', żeby zacząć lekcję od nowa.';
$string['leftduringtimednoretake'] = 'Czas lekcji minął <br/> nie możesz powtórzyć lekcji.';
$string['lesson:edit'] = 'Edytuj lekcję';
$string['lesson:manage'] = 'Zarządzaj lekcją';
$string['lessonattempted'] = 'Próby lekcji';
$string['lessonclosed'] = 'Ta lekcja zakończyła się {$a}';
$string['lessoncloses'] = 'Lekcja zakończona';
$string['lessoncloseson'] = 'Ta lekcja zakończy się {$a}';
$string['lessonformating'] = 'Formatuj lekcje';
$string['lessonmenu'] = 'Menu lekcji';
$string['lessonnotready'] = 'Ta lekcja nie jest gotowa do rozwiązania. Prosze skontaktować się ze swoim {$a}.';
$string['lessonnotready2'] = 'Ta lekcja nie jest gotowa do nauki.';
$string['lessonopen'] = 'Lekcja rozpocznie się {$a}.';
$string['lessonopens'] = 'Lekcja rozpoczęta';
$string['lessonpagelinkingbroken'] = 'Nie znaleziono strony startowej. Link do strony z lekcją musi być niepoprawny. Prosze skontaktować się z administratorem.';
$string['lessonstats'] = 'Statystyka lekcji';
$string['linkedmedia'] = 'Połączone media';
$string['loginfail'] = 'Błąd logowania, spróbuj ponownie';
$string['lowscore'] = 'Najniższa ocena';
$string['lowtime'] = 'Najkrótszy czas';
$string['manualgrading'] = 'Oceń eseje';
$string['matchesanswer'] = 'Układ z odpowiedzią';
$string['matching'] = 'Dopasowywanie';
$string['matchingpair'] = 'Dopasuj pary {$a}';
$string['maxgrade'] = 'Maksymalna ocena';
$string['maxgrade_help'] = 'To maksymalna ocena, która może być przyznana na danej lekcji. Wartość ta
waha się między 0 i 100% i może być zmieniona w każdej chwili podczas trwania
lekcji. Zmiana ta będzie natychmiast widoczna na stronie i odpowiednio wpłynie
na oceny studentów.';
$string['maxhighscores'] = 'Liczba pozycji na liście najlepiej ocenionych';
$string['maximumnumberofanswersbranches'] = 'Maksymalna liczba odpowiedzi/przejść';
$string['maximumnumberofanswersbranches_help'] = 'Ten parametr określa maksymalną liczbę odpowiedzi, którą może zasugerować nauczyciel. Domyślna wartość to 4, ale
jeśli używane są tylko pytania typu PRAWDA/FAŁSZ wówczas sensownym byłoby ustawienie tej wartości na 2.
Można bezpieczenie zmieniać ten parametr bez względu na zmieniającą się zawartość lekcji.';
$string['maximumnumberofattempts'] = 'Maksymalna liczba podejść';
$string['maximumnumberofattempts_help'] = 'Ten parametr określa maksymalną liczbę podejść do odpowiadania na **jakiekolwiek** z pytań lekcyjnych.
W przypadku pytań, które nie zawierają odpowiedzi, wartość ta stanowi "wentyl bezpieczeństwa", który
i tak pozwoli przejść do następnej strony.
Domyślna wartość wynosi 5. Niższa wartość może zniechęcić studenta do przemyślenia pytań. Z kolei zbyt wysoka
wartość może skutkować frustracją. Ustawienie tego parametru na 1 daje studentowi tylko jedną szansę by odpowiedzieć
na pytanie.
Parametr ten ma globalny zasięg i znajduje zastosowanie do wszystkich pytań lekcyjnych bez względu na ich typ.
Parametr ten nie dotyczy nauczyciela. W tym sensie, nauczyciel może próbować wielokrotnie odpowiadać na pytania.
Założeniem jest bowiem, że nauczyciel zna odpowiedzi na pytania!';
$string['maximumnumberofattemptsreached'] = 'Osiągnięto maksymalny rozmiar próby - przejdź do następnej strony';
$string['maxtime'] = 'Limit czasu (minuty)';
$string['maxtimewarning'] = 'Zostało {$a} minut do końca lekcji';
$string['mediaclose'] = 'Pokaż przycisk zamknij:';
$string['mediafile'] = 'Wstaw wyskakujące okienko z plikiem lub stroną WWW';
$string['mediafile_help'] = '# Podręczny plik lub strona internetowa
Spowoduje to utworzenie na początku lekcji okna podręcznego z plikiem (na przykład: plikiem mp3) lub stroną internetową. Ponadto na każdej stronie lekcji zostanie wyświetlone łącze, które ponownie otworzy okno podręczne w razie potrzeby.
Opcjonalnie u dołu okna podręcznego zostanie wyświetlony przycisk "Zamknij okno", a ponadto można będzie ustawić wysokość i szerokość okna.
Obsługiwane zagnieżdżone typy plików:
* MP3
* Media Player
* Quicktime
* Realmedia
* HTML
* Zwykły tekst
* GIF
* JPEG
* PNG
Wszystkie pozostałe typy plików będą domyślnie powiązane z łączem do pobrania.';
$string['mediafilepopup'] = 'Kliknij tutaj w celu zobaczenia pliku medialnego tej lekcji';
$string['mediaheight'] = 'Wysokość okna:';
$string['mediawidth'] = 'Szerokość:';
$string['minimumnumberofquestions'] = 'Minimalna liczba pytań';
$string['minimumnumberofquestions_help'] = 'Gdy lekcja zawiera jedną lub więcej Tabelę Wątków, nauczyciel musi ustalić ten parametr. Jego wartość ustala dolny limit liczby pytań widocznych gdy ocena jest obliczana. Nie wymusza to na studentach odpowiadania na zbyt wiele pytań.
Jeśli wybierzesz np. 20, system upewni się, że ocena zostanie wystawiona dopiero, gdy student zobaczy **przynajmniej** tą liczbę pytań. Bez tego parametru student, który odpowiedziałby np. na wszystkie 5 pytań jednego wątku, otrzymałby 100% oceny. Z parametrem ustawionym na 20, ocena ta wyniosłaby 25%.
Jeśli ten parametr jest w użyciu, opis lekcji powinien zawierać tekst w rodzaju:
> W tej lekcji oczekuje się od Ciebie podejścia do przynajmniej n pytań. Możesz przejść więcej, jeśli chcesz. Jeśli jednak podejdziesz do mniej
> niż n pytań, Twoja ocena zostanie policzona tak, jakbyś podszedł do n pytań i nie odpowiedział na brakujące.
>
Oczywiście "n" zamieniasz na wybrany parametr.
Gdy ustawisz ten parametr, student będzie wiedział do ilu pytań podszedł i ile mu jeszcze zostało.';
$string['missingname'] = 'Podaj nick';
$string['modattempts'] = 'Pozwól studentom zmieniać odpowiedzi';
$string['modattempts_help'] = 'Można pozwolić studentowi wracać do poprzednich pytań aby mógł dokonać zmian';
$string['modattemptsnoteacher'] = 'Tylko student może zmieniać pracę.';
$string['modulename'] = 'Lekcja';
$string['modulename_help'] = '<IMG VALIGN=absmiddle SRC="wwwroot?>/mod/lesson/icon.gif"> **Lekcja**
Lekcja pozwala na przedstawienie treści w interesujący sposób na wielu stronach.
Każda strona zwykle kończy się pytaniem i kilkoma odpowiedziami. W zależności od
postępów studenta, albo idzie on do przodu z materiałem, albo jest cofany.
Nawigacja lekcji może być albo uproszczona ale może też być dużo bardziej
skomplikowana w zależności od struktury materiału lekcyjnego.';
$string['modulenameplural'] = 'Lekcje';
$string['move'] = 'Przenieś stronę';
$string['movedpage'] = 'Przesunięto stronę';
$string['movepagehere'] = 'Przesuń stronę tutaj';
$string['moving'] = 'Przesuwanie strony: {$a}';
$string['multianswer'] = 'Wiele odpowiedzi';
$string['multianswer_help'] = 'Niektóre z typów pytań mogą być rozszerzone poprzez wybór opcji pytania za pomocą okienka wyboru (checkbox).
Uwagi poniższe odnoszą się do następujących typów pytań:
1.**Wielokrotny wybór** To wariant pytań wielokrotnego wyboru zwany
**"Wiele dobrych odpowiedzi"**. Jeśli opcja ta zostanie wybrana
wówczas student musi wskazać wszystki poprawne odpowiedzi w ramach zestawu odpowiedzi.
Pytanie może podpowiedzieć studentowi ile odpowiedzi jest poprawnych n.p. Wskaż dwóch prezedyentów
USA z poniższej listy. Liczba właściwych odpowiedzi może być minimalnie 1 i maksymalnie tyle
ile jest odpowiedzi do zakreślenia. W klasycznym pytaniu wielokrotnego wyboru student wybiera tylko
jedną dobrą odpowiedĽ i tym różni się od tego typu pytań ten wariant.
2.**Krótka odpowiedĽ** Domyślnie system ignoruje wielkość liter w odpowiedziach. Jeśli Opcja pytania
zostania wybrana, wówczas system będzie sprawdzał użycie liter.
Inne typy pytań nie wykorzystują Opcji pytań.';
$string['multichoice'] = 'Wybór wielokrotny';
$string['multipleanswer'] = 'Wielokrotne odpowiedzi';
$string['nameapproved'] = 'Wprowadzono nazwę';
$string['namereject'] = 'Nazwa wprowadzona przez Ciebie jest na liście słów zakazanych. Wprowadź inną nazwę.';
$string['new'] = 'nowa';
$string['nextpage'] = 'Następna strona';
$string['noanswer'] = 'Brak odpowiedzi';
$string['noattemptrecordsfound'] = 'Brak prób: nie przyznano oceny';
$string['nobranchtablefound'] = 'Nie znaleziono tabeli rozgałęzień';
$string['nocommentyet'] = 'Brak komentarzy';
$string['nocoursemods'] = 'Nie znaleziono aktywności';
$string['nocredit'] = 'Bez oceny';
$string['nodeadline'] = 'Brak ostatecznego terminu';
$string['noessayquestionsfound'] = 'W tej lekcji nie odnaleziono pytań typu \'esej\'';
$string['nohighscores'] = 'Brak punktów';
$string['nolessonattempts'] = 'Nikt jeszcze nie rozwiązał lekcji';
$string['nooneansweredcorrectly'] = 'Brak poprawnych odpowiedzi';
$string['nooneansweredthisquestion'] = 'Brak odpowiedzi na to pytanie';
$string['noonecheckedthis'] = 'Nic nie zaznaczono';
$string['nooneenteredthis'] = 'Nic nie wprowadzono';
$string['noonehasanswered'] = 'Nikt nie odpowiedział jeszcze na pytanie \'esej\'';
$string['noretake'] = 'Nie można powtórnie przejrzeć lekcji.';
$string['normal'] = 'Normalnie - idź zgodnie z trybem lekcji';
$string['notcompleted'] = 'Niekompletne';
$string['notdefined'] = 'Brak definicji';
$string['nothighscore'] = 'Nie znalazłeś się na liście {$a} najwyżej ocenionych';
$string['notitle'] = 'Brak tytułu';
$string['numberofcorrectanswers'] = 'Ilość poprawnych odpowiedzi: {$a}';
$string['numberofcorrectmatches'] = 'Ilość poprawnych połączeń: {$a}';
$string['numberofpagestoshow'] = 'Ilość stron (kart) do wyświetlenia';
$string['numberofpagestoshow_help'] = 'Ten parametr stosuje się tylko do lekcji typu Flash Card. Domyślna wartość to 0, co oznacza, że wszystkie
strony (karty) są widoczne. Wskazanie liczby wyższej niż 0 wyświetli żądaną liczbę stron. Po wyświetleniu
żądanej liczby stron, nastąpi zakończenie lekcji i student zobaczy swoją ocenę.
Jeśli ten parametr zostanie ustawiony na wartość wyższą niż
ilość stron danej lekcji, wówczas koniec lekcji nastąpi po pokazaniu wszystkich stron.';
$string['numberofpagesviewed'] = 'Ilość obejrzanych strony: {$a}';
$string['numberofpagesviewednotice'] = 'Liczba pytań odpowiedzianych: {$a->nquestions}; (powinieneś odpowiedzieć na przynajmniej {$a->minquestions})';
$string['numerical'] = 'Numeryczne';
$string['ongoing'] = 'Wyświetlaj bieżący wynik w trakcie rozwiązywania lekcji';
$string['ongoing_help'] = '# Bieżący wynik
Po włączeniu tej opcji na każdej stronie będzie wyświetlana bieżąca punktacja uczestnika uzyskana w porównaniu z ogólną liczbą punktów, które można było zdobyć. Przykład: uczestnik odpowiedział na czetry pytania za 5 punktów, z czego jedna odpowiedź była niepoprawna. Bieżący wynik będzie pokazywał, że uczestnik uzyskał 15/20 punktów.';
$string['ongoingcustom'] = 'Otrzymałeś dotąd {$a->score} punktów z {$a->currenthigh}';
$string['ongoingnormal'] = 'Odpowiedziałeś poprawnie na {$a->correct} z {$a->viewed} pytań';
$string['options'] = 'Opcje';
$string['or'] = 'lub';
$string['ordered'] = 'Poukładane';
$string['other'] = 'Inne';
$string['outof'] = 'Z {$a}';
$string['overview'] = 'Skrócony';
$string['overview_help'] = '1.Lekcja skada się z paru **stron**.
* Strona zawiera określoną **stroną** i kończy się **pytaniem**.
* Każda strona zawiera szereg **odpowiedzi**.
* Każda odpowiedĽ może zostać potwierdzona krótkim tekstem, który
zostanie wyświetlony jeśli dana odpowiedĽ zostanie wybrana.
Ten tekst nazywany jest **informacją zwrotną**.
* Z każdą odpowiedzią związany jest **link**. Link może przenieść studenta do określonego fragmentu danej strony,
następnej strony lub każdej innej strony czy na koniec lekcji.
* Domyślnie pierwsza strona przeniesie studenta do **następnej strony**.
Kolejne odpowiedzi również przeniosą studenta do tej strony.
\* **|Logiczny porządek** determinuje układ lekcji. Odnosi się to do porządku stron z
perspektywy nauczyciela. Porządek ten może być w każdej chwili zmieniony.
* Lekcja ma także **porządek nawigacji**. Ten termin odnosi się do układu stron
widzianego oczami studenta. Porządek ten determinowany jest przez przejścia do innych stron
zdefiniowane w odpowiedziach i może znacznie odbiegać od logicznego porządku.
(Jednakże gdy przejścia \*nie\* zostaną zmienione oba porządki pozostaną do siebie podobne.
Nauczyciel ma możliwość sprawdzenia porządku nawigacji.
* Odpowiedzi wyświetlane studentom są zawsze pomieszane. Tak więc pierwsza odpowiedĽ na ekranie
nauczyciela nie oznacza, że będzie to pierwsza odpowiedĽ na ekranie studenta. Tak więc przy wyświetlaniu
tego samego zestawu odpowiedzi, najprawdopodobniej pojawią się one w innym porządku.
* Ilość odpowiedzi może się różnić na kolejnych stronach. N.p. jedna strona może się kończyć pytaniami
typu PRAWDA/FAŁSZ a kolejne mogą zawierać po 4 odpowiedzi.
* Można zawrzeć stronę bez odpowiedzi. Studenci wówczas zobaczą link "Kontynuuj".
* Jeśli chodzi o ocenianie lekcji, odpowiedzi **poprawne** będą prowadziły do strony, która
będzie zawierać dalsze informacje.
**Złe** odpowiedzi będą prowadzić do tej samej strony lub do innej strony w logicznym układzie stron.
Tak więc jeśli linki do innych stron \*nie\* są zmienione, wówczas pierwsza odpowiedĽ
jest poprawną odpowiedzią.
* Pytania mogą mieć więcej niż jedną dobrą odpowiedĽ. Przykładowo, jeśli dwie odpowiedzi przeniosą studenta
do następnej strony, to oznacza, że obydwie odpowiedzi były poprawnymi odpowiedziami. W takim przypadku, można
też wyświetlić różne informacje zwrotne tym studentom.
* We widoku nauczyciela (podgląd widoku) poprawne odpowiedzi mogą być podkreślone.
* Aby przejsć do **końca lekcji** można albo kliknąć na taki link albo przejść do następnej strony z ostatniej
(logicznej) strony lekcji. Kiedy student dojdzie do ostatniej strony, wyświetli mu się ocena za lekcję. Ocena jest
stosunkiem licby poprawnych odpowiedzi do liczby stron pomnożonym przez ocenę za lekcję.
* Jeśli student \*nie\* dojdzie do końca lekcji, wówczas może one albo rozpocząć lekcję w miejscu w którym
ostatnio skończył bądĽ też może rozpocząć naukę od początku.
* Lekcja, która ma wybrany parametr pozwalający na powtarzanie, może być powtórzana w nieskończoność aż do uzyskania
najlepszej oceny.
</ol>';
$string['page'] = 'Strona: {$a}';
$string['page-mod-lesson-x'] = 'Na każdej stronie lekcji';
$string['pagecontents'] = 'Opis';
$string['pages'] = 'Strony';
$string['pagetitle'] = 'Tytuł strony';
$string['password'] = 'Hasło';
$string['passwordprotectedlesson'] = '{$a} jest chronione hasłem';
$string['pleasecheckoneanswer'] = 'Proszę sprawdź jedną odpowiedź';
$string['pleasecheckoneormoreanswers'] = 'Sprawdź jedną lub więcej odpowiedzi';
$string['pleaseenteryouranswerinthebox'] = 'Proszę wpisz swoją odpowiedź';
$string['pleasematchtheabovepairs'] = 'Połącz powyższe pary';
$string['pluginadministration'] = 'Administracja lekcją';
$string['pluginname'] = 'Lekcja';
$string['pointsearned'] = 'Zdobyte punkty';
$string['postsuccess'] = 'Przesłano';
$string['pptsuccessfullimport'] = 'Poprawnie zaimportowano strony z przesłanej Prezentacji PowerPoint.';
$string['practice'] = 'Lekcja ćwiczeniowa';
$string['practice_help'] = 'Jeżeli lekcja jest ustawiona jako praktyka, wtedy nie bedzie pokazywany dzienniczek ocen';
$string['preview'] = 'Podgląd';
$string['previewlesson'] = 'Podgląd {$a}';
$string['previouspage'] = 'Poprzednia strona';
$string['progressbar'] = 'Wskaźnik postępu';
$string['progressbar_help'] = '# Pasek postępu
Wyświetla postęp u dołu lekcji. Obecnie pasek postępu jest najdokładniejszy dla lekcji liniowej.
Podczas obliczania wartości procentowej ukończenia do postępu lekcji są zaliczane tabele gałęzi i strony pytań, na które udzielono poprawnych odpowiedzi. Podczas obliczania łącznej liczby stron w lekcji klastry i strony w klastrach liczą się jako jedna strona, a strony Koniec klastra i Koniec tabeli gałęzi są pomijane. Wszystkie inne strony są wliczane do łącznej liczby stron w lekcji.
Uwaga: domyślne style paska postępu nie są powalające ;). Wszystkie style (np.: kolory, obrazy tła itd.) paska postępu można zmodyfikować w pliku mod/lesson/styles.php.';
$string['progressbarteacherwarning'] = 'Pasek postępu nie jest wyświetlany dla  {$a}';
$string['progressbarteacherwarning2'] = 'Nie zobaczysz wskaźnika postępu, ponieważ możesz edytować tą lekcję.';
$string['qtype'] = 'Typ strony';
$string['question'] = 'Pytanie';
$string['questionoption'] = 'Opcja pytania';
$string['questiontype'] = 'Typ pytania';
$string['randombranch'] = 'losuj wątki';
$string['randompageinbranch'] = 'losuj pytania w obrębie wątku';
$string['rank'] = 'Pozycja';
$string['rawgrade'] = 'Nieprzetworzona ocena';
$string['receivedcredit'] = 'Otrzymany kredyt';
$string['redisplaypage'] = 'Ponownie wyświetl stronę';
$string['report'] = 'Raport';
$string['reports'] = 'Raporty';
$string['response'] = 'Informacja zwrotna';
$string['retakesallowed_help'] = 'Ten parametr determinuje czy student może powtórzyć lekcje czy nie.
Warto skorzystać z tej opcji, jeśli określona lekcja jest istotna dla całego kursu.
Wybór tego parametru powoduje, że **oceny** wyświetlone na stronie ocen, będą najlepszymi
ocenami uzyskanymi ze wszystkich podejść do danej lekcji. Jednakże, wybór opcji **Analiza pytań**
zawsze bierze pod uwagę tylko oceny za pierwsze podejście do pytania.
Domyślnie parametr ten ustawiony jest na **Tak**.';
$string['returnto'] = 'Powróć do {$a}';
$string['returntocourse'] = 'Powrót do kursu';
$string['review'] = 'Przegląd';
$string['reviewlesson'] = 'Przejrzyj ponownie lekcje';
$string['reviewquestionback'] = 'Tak, chcę spróbować ponownie';
$string['reviewquestioncontinue'] = 'Nie, chcę przejść do następnego pytania';
$string['sanitycheckfailed'] = 'Ta próba została usunięta!';
$string['savechanges'] = 'Zachowaj zmiany';
$string['savechangesandeol'] = 'Zachowaj wszystkie zmiany i przejdź na koniec lekcji';
$string['savepage'] = 'Zapisz stronę';
$string['score'] = 'Punkt';
$string['scores'] = 'Punkty';
$string['secondpluswrong'] = 'Niezupełnie. Chcesz spróbować ponownie?';
$string['selectaqtype'] = 'Wybierz typ pytania';
$string['shortanswer'] = 'Krótka odpowiedź';
$string['showanunansweredpage'] = 'Zezwól na wielokrotne przeglądanie stron z błędną odpowiedzią';
$string['showanunseenpage'] = 'Nigdy nie pokazuj tej samej strony dwukrotnie';
$string['singleanswer'] = 'Pojedyncza odpowiedź';
$string['skip'] = 'Pomiń nawigację';
$string['slideshow'] = 'Pokaz slajdów';
$string['slideshow_help'] = 'Można wyświetlić lekcję jako pokaz slajdów, z ustaloną wysokością, szerokościa i kolorem tła. Bazując na CSS pasek przewijania będzie wyświetlany wtedy gdy szerokość lub wysokość okna jest przewyższana przez zawartość strony.
Przyciski "Następny" i "Poprzedni" będą dostępne po lewej stronie wtedy gdy wybrana będzie opcja lewe menu. Inaczej będą umieszczone poniżej slajdu';
$string['slideshowbgcolor'] = 'Tło slajdów';
$string['slideshowheight'] = 'Wysokość slajdów';
$string['slideshowwidth'] = 'Szerokość slajdów';
$string['startlesson'] = 'Zacznij lekcję';
$string['studentattemptlesson'] = '{$a->lastname}, {$a->firstname} liczba prób {$a->attempt}';
$string['studentname'] = '{$a} nazwa studenta';
$string['studentoneminwarning'] = 'Ostrzeżenie: Została niecała minuta do końca lekcji.';
$string['studentresponse'] = 'odpowiedź {$a}';
$string['submit'] = 'Prześlij';
$string['submitname'] = 'Zatwierdź nazwę';
$string['teacherjumpwarning'] = 'Zaloguj się jako student, żeby przetestować przejścia';
$string['teacherongoingwarning'] = 'Wynik jest pokazywany tylko studentowi. Zaloguj się jako student.';
$string['teachertimerwarning'] = 'Licznik czasu działa tylko dla studentów, Aby przetestować, zaloguj się jako student.';
$string['thatsthecorrectanswer'] = 'To jest poprawna odpowiedź';
$string['thatsthewronganswer'] = 'To jest błędna odpowiedź';
$string['thefollowingpagesjumptothispage'] = 'Następujące strony prowadzą do tej strony';
$string['thispage'] = 'Ta strona';
$string['timeremaining'] = 'Pozostały czas';
$string['timespenterror'] = 'Poświęć tej lekcji przynajmniej {$a} minut';
$string['timespentminutes'] = 'Spędzony czas (w minutach)';
$string['timetaken'] = 'Łączny czas';
$string['topscorestitle'] = 'Lista {$a} najwyżej ocenionych podczas lekcji.';
$string['truefalse'] = 'Prawda / Fałsz';
$string['unseenpageinbranch'] = 'Nie pokazuj pytań w obrębie wątku';
$string['unsupportedqtype'] = 'Nie wspierany typ pytania ({$a})!';
$string['updatedpage'] = 'Uaktualniono stronę';
$string['updatefailed'] = 'Błąd';
$string['usemaximum'] = 'Użyj maksimum';
$string['usemean'] = 'Użyj średniej';
$string['usepassword'] = 'Chroń lekcje hasłem';
$string['usepassword_help'] = 'Można chronić dostęp do lekcji ustalając hasło dostępu. Osoby które nie znają hasła nie będą mogły przeglądać lekcji.';
$string['viewgrades'] = 'Pokaż oceny';
$string['viewhighscores'] = 'Pokaż listę najwyżej ocenionych';
$string['viewreports'] = 'Zobacz {$a->attempts} zakończonych podejść {$a->student}';
$string['viewreports2'] = 'Zobacz {$a} zakończonych prób';
$string['welldone'] = 'Dobrze zrobione!';
$string['whatdofirst'] = 'Co chcesz zrobić najpierw?';
$string['wronganswerjump'] = 'Skok po nieprawidłowej odpowiedzi';
$string['wronganswerscore'] = 'Punkty za nieprawidłową odpowiedź';
$string['wrongresponse'] = 'Zła odpowiedź';
$string['xattempts'] = '{$a} prób';
$string['youhaveseen'] = 'Widziałeś już więcej niż jedną stronę tej lekcji. <br />Czy chciałbyś zacząć od ostatniej strony, którą przeglądałeś?';
$string['youmadehighscore'] = 'Wprowadź na listę {$a} najwyżej ocenionych.';
$string['youranswer'] = 'Twoja odpowiedź';
$string['yourcurrentgradeis'] = 'Twoja aktualna ocena to {$a}';
$string['yourcurrentgradeisoutof'] = 'Masz obecnie {$a->grade} punktów z {$a->total}';
$string['youshouldview'] = 'Powinieneś odpowiedzieć na co najmniej: {$a}';
