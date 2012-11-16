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
 * Strings for component 'glossary', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   glossary
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcomment'] = 'Dodaj komentarz';
$string['addentry'] = 'Dodaj pojęcie';
$string['addingcomment'] = 'Dodaj komentarz';
$string['alias'] = 'Słowa kluczowe';
$string['aliases'] = 'Słowo kluczowe';
$string['aliases_help'] = 'Słownik umożliwia zapisanie aliasu czyli alternatywnej nazwy dla każdego terminu.
** Wprawadż aliasy w nowej linii ** (nie używaj przecinków).
Alias moze być używany jak alternatywna nazwa do hasła. Na przykład, jeżeli używacie w słowniku auto-linkowania alias będzie używany (główne hasło też) jako link do tego hasła';
$string['allcategories'] = 'Wszystkie kategorie';
$string['allentries'] = 'Wszystkie';
$string['allowcomments'] = 'Pozwól komentować wpisy';
$string['allowcomments_help'] = 'Można umożliwić komentowanie wpisów do słownika pojęć lub też funkcję tą wyłączyć.';
$string['allowduplicatedentries'] = 'Pozwól na wielokrotne definiowanie tego samego pojęcia';
$string['allowduplicatedentries_help'] = '<p align=center>**Wielokrotne definicje**</p>
Jeżeli włączysz tą funkcję wówczas określony termin będzie mógł mieć wiele definicji.';
$string['allowprintview'] = 'Pozwól drukować słownik';
$string['allowprintview_help'] = 'Można pozwolić lub zabronić studentom wydruk słownika
Można włączyć lub wyłączyć tę funkcję dla studentów.
Prowadzący zawsze ma możliwość drukowania.';
$string['andmorenewentries'] = 'i {$a} nowych wpisów.';
$string['answer'] = 'Odpowiedź';
$string['approve'] = 'Potwierdź';
$string['areyousuredelete'] = 'Czy na pewno chcesz usunąć ten wpis?';
$string['areyousuredeletecomment'] = 'Czy na pewno chcesz usunąć ten komentarz?';
$string['areyousureexport'] = 'Czy na pewno chcesz wyeksportować ten wpis do';
$string['ascending'] = 'Wzrastająco';
$string['attachment'] = 'Załącznik';
$string['attachment_help'] = 'Możesz załączyć jeden plik do hasła w słowniku. Plik będzie przesłany na serwer i przechowywany razem z hasłem w słowniku
Plik może być dowolnego typu, najlepiej jednak żeby plik używał standardowego 3-literowego rozszerzenia. To ułatwi innym pobranie i oglądanie załącznika.';
$string['author'] = 'Autor';
$string['authorview'] = 'Szukaj według autora';
$string['back'] = 'Powrót';
$string['cantinsertcat'] = 'Nie można wstawić tej kategorii';
$string['cantinsertrec'] = 'Nie można wstawić rekordu';
$string['cantinsertrel'] = 'Nie można wstawić relacji kategoria-wpis';
$string['casesensitive'] = 'Ten wpis inaczej traktuje duże i małe litery';
$string['casesensitive_help'] = '<P ALIGN=CENTER>**Małe i duże litery a łączenie pojęć**</P>
Ten parametr defniuje czy pojęcie do którego się odwołujemy musi zaczynać się z dużej
lub małej litery, aby automatyczne łączenie pojęć było możliwe. Chodzi o to czy musi być zgodność
z pomiędzy pierwszą literą danego terminu w tekście i słowniku.
Dla przykładu, jeśli włączymy tą funkcję, wówczas termin "html" w tekście NIE zostanie automatycznie
polączony z terminem "HTML" w słowniku.';
$string['cat'] = 'Kat.';
$string['categories'] = 'Kategorie';
$string['category'] = 'Kategoria';
$string['categorydeleted'] = 'Usunięta kategoria';
$string['categoryview'] = 'Szukaj według kategorii';
$string['changeto'] = 'Zmień na {$a}';
$string['cnfallowcomments'] = 'Określ, czy słownik pojęć domyślnie akceptuje komentarze.';
$string['cnfallowdupentries'] = 'Określ, czy słownik pojęć domyślnie pozwoli na podwójne definicje.';
$string['cnfapprovalstatus'] = 'Określ, czy wpis dokonany przez studenta będzie domyślnie zatwierdzany.';
$string['cnfcasesensitive'] = 'Określ, czy nowy wpis, który jest automatycznie linkowany, jest domyślnie wrażliwy na duże i małe litery.';
$string['cnfdefaulthook'] = 'Określ domyślne zaznaczenie, kiedy słownik będzie otwarty po raz pierwszy.';
$string['cnfdefaultmode'] = 'Wybierz domyślną ramkę, która się pojawi, gdy słownik pojęć będzie po raz pierwszy uruchomiony.';
$string['cnffullmatch'] = 'Określ, czy wpis, który jest automatycznie linkowany, ma dokładnie odpowiadać wyrazowi docelowemu.';
$string['cnflinkentry'] = 'Określ, czy wpis domyślnie powinien być automatycznie połączony z docelowym wyrazem.';
$string['cnflinkglossaries'] = 'Określ, czy słownik pojęć powinien być automatycznie łączony z innymi wpisami.';
$string['cnfrelatedview'] = 'Wybierz format wyświetlenia wpisów dla automatycznego łączenia pojęć i wyświetlenia wpisu';
$string['cnfshowgroup'] = 'Określ, czy przerwa powinna być widoczna czy nie';
$string['cnfsortkey'] = 'Wybierz domyślny klucz sortowania';
$string['cnfsortorder'] = 'Wybierz domyślny sposób sortowania';
$string['cnfstudentcanpost'] = 'Określ, czy studenci mogą wprowadzać nowe pojęcia.';
$string['comment'] = 'Komentarz';
$string['commentdeleted'] = 'Komentarz został usunięty.';
$string['comments'] = 'Komentarze';
$string['commentson'] = 'Komentarze na';
$string['commentupdated'] = 'Komentarz został uaktualniony';
$string['completionentries'] = 'Student musi tworzyć wpisy:';
$string['completionentriesgroup'] = 'Wymagaj wpisów';
$string['concept'] = 'Termin';
$string['concepts'] = 'Terminy';
$string['configenablerssfeeds'] = 'Umożliwia użycie kanałów RSS dla wszystkich słowników pojęć. Musisz jednak i tak włączyć obsługę kanałów dla każdego słownika.';
$string['current'] = 'Obecnie posortowane wg {$a}';
$string['currentglossary'] = 'Aktualny słownik pojęć';
$string['date'] = 'data';
$string['dateview'] = 'Szukaj według daty';
$string['defaultapproval'] = 'Automatycznie aprobuj wpisy definicji przez studentów';
$string['defaultapproval_help'] = 'Możesz wybrać czy wpisy dokonane przez studentów będą automatycznie publikowane w sieci Web
czy też będą musiały być najpierw zatwierdzone przez nauczyciela.';
$string['defaulthook'] = 'Domyślny punkt zaczepienia';
$string['defaultmode'] = 'Domyślny tryb';
$string['defaultsortkey'] = 'Domyślne sortowanie';
$string['defaultsortorder'] = 'Domyślny porządek sortowania';
$string['definition'] = 'Definicja';
$string['definitions'] = 'Definicje';
$string['deleteentry'] = 'Usuń wpis';
$string['deletenotenrolled'] = 'Usuń wpisy według niezapisanych użytkowników';
$string['deletingcomment'] = 'Usuwanie komentarza';
$string['deletingnoneemptycategory'] = 'Usunięcie tej kategorii nie usunie pojęć należących do tej kategorii. Zostaną one oznaczone jako \'nieskategoryzowane\'.';
$string['descending'] = '(malejące)';
$string['destination'] = 'Importuj do';
$string['destination_help'] = 'Definicje możesz zaimportować do następujących słowników:
* **|Aktualnie otwarty słownik:** Nowe definicje zostaną dołączone do danego słownika.
* **|Nowy słownik:** Nowy słownik zostanie utworzony w oparciu o plik XML i importowane pojęcia.';
$string['displayformat'] = 'Format słownika';
$string['displayformat_help'] = '<P ALIGN=CENTER>**Wygląd słownika**</P>
Ten parametr określa sposób w jaki definicje zostaną zaprezentowane w słowniku. Możliwe są następujące sposoby prezentacji:
>
>
> **Prosty słownik**:
>
> : Przypomina klasyczny słownik. Autorzy nie są uwidocznieni a załączniki schowane są za linkami.
>
> **Ciągły**:
>
> : Pokazuje terminy jeden po drugim bez żadnych przerw oprócz edycyjnych ikon.
>
> **Pełen z autorami**:
>
> : Pokazuje terminy wraz z danymi autora w sposób podobny do forum. Załączniki schowane sa za linkami.
>
> **Pełen bez autorów**:
>
> : Format podobny do poprzedniego z tym, że nie zawiera informacji o autorach.
>
> **Encyklopedia**:
>
> : Taki jak "Ciągły z autorami" ale załączniki są wyświetlone w tekście.
>
> **Często zadawane pytania (FAQ)**:
>
> : Użyteczny przy wyświetlaniu "Często zadawanych pytań (FAQ). Automatycznie kategoryzuje terminy definiowane i definicje jako pytania i odpowiedzi.
>
>
>
>
>
* * *
Administratorzy Moodle\'a mogą utworzyć nowe formy wyświetlenia słownika:
1.SprawdĽ zawratość katalogu mod/glossary/formats .... Powinny tam być ponumerowane pliki odpowiadające dostępnym formatom słownika.
* Skopiuj jeden z tych plików i nadaj jemu nową nazwę tj. numer N (zwróć uwagę, że 0 i 1 są zarezerwowane).
* Dokonaj edycji tego pliku w/g własnego uznania (musisz jednak trochę znać PHP).
* Następnie, dopisz w każdym pakiecie językowym jakiego używasz **displayformatN**, i nadaj mu krótką ale logiczną nazwę.
';
$string['displayformatcontinuous'] = 'Ciągły bez autora';
$string['displayformatdictionary'] = 'Prosty styl słownika';
$string['displayformatencyclopedia'] = 'Encyklopedia';
$string['displayformatentrylist'] = 'Lista wpisów';
$string['displayformatfaq'] = 'FAQ';
$string['displayformatfullwithauthor'] = 'Pełny z autorami';
$string['displayformatfullwithoutauthor'] = 'Pełny bez autorów';
$string['displayformats'] = 'Dostępne formaty wyglądu';
$string['displayformatssetup'] = 'Wyświetl ustawienia formatów';
$string['duplicatecategory'] = 'Duplikuj kategorie';
$string['duplicateentry'] = 'Podwójne definicje';
$string['editalways'] = 'Zawsze można edytować';
$string['editalways_help'] = '<P ALIGN=CENTER>**Zawsze edytowalne**</P>
Opcja ta pozwala Ci ustalić, czy wpisy są zawsze edytowalne.
Możesz wybrać
* **Tak:** Wpisy są zawsze edytowalne.
* **Nie:** Wpisy są edytowalne tylko przez określony czas po ich stworzeniu.';
$string['editcategories'] = 'Edytuj kategorie';
$string['editentry'] = 'Edytuj wpis';
$string['editingcomment'] = 'Edytuj komentarz';
$string['entbypage'] = 'Wyświetl podaną ilość pojęć na stronie';
$string['entries'] = 'Pojęcia';
$string['entrieswithoutcategory'] = 'Pojęcia nieskategoryzowane';
$string['entry'] = 'Pojęcie';
$string['entryalreadyexist'] = 'Pojęcie już istnieje';
$string['entryapproved'] = 'Wpis został zaaprobowany';
$string['entrydeleted'] = 'Wpis został usunięty';
$string['entryexported'] = 'Wpis został wyeksportowany';
$string['entryishidden'] = '(ten wpis jest aktualnie ukryty)';
$string['entryleveldefaultsettings'] = 'Domyślne ustawienia wejściowe';
$string['entrysaved'] = 'Hasło zostało zapisane';
$string['entryupdated'] = 'Hasło zostało uaktualnione';
$string['entryusedynalink'] = 'Ten wpis powinien zostać automatycznie połączony z innymi wpisami w systemie';
$string['entryusedynalink_help'] = 'Włącznie tej opcji spowoduje automatyczne linkowanie każdego użycia danego
terminu w treści składowych kursu.
Jeśli nie chcesz aby w treści składowej dane słowo nie został zlinkowane do
wpisu w słowniku, umieść je w znacznikach i
Aby móc włączyć tą opcję, linkowanie musi być włączone w opcjach słownika.';
$string['errcannoteditothers'] = 'Nie możesz edytować pojęć innych użytkowników';
$string['errconceptalreadyexists'] = 'Definicja tego pojęcia już istnieje. Ten słownik nie zezwala na duplikowanie pojęć.';
$string['errdeltimeexpired'] = 'Nie możesz tego usunąć. Czas minął!';
$string['erredittimeexpired'] = 'Czas edycji tego pojęcia upłynął.';
$string['errorparsingxml'] = 'Wystąpiły błędy podczas analizy pliku. Upewnij się, że ma on poprawną składnię XML.';
$string['explainaddentry'] = 'Dodaj nowe pojęcie do tego słownika pojęć.<br />Pola: Termin i Definicja muszą zostać wypełnione.';
$string['explainall'] = 'Wyświetl wszystkie pojęcia na jednej stronie';
$string['explainalphabet'] = 'Wyszukaj pojęcia używając tego indeksu';
$string['explainexport'] = 'Plik został stworzony.<br />Ściągnij go i zachowaj w bezpiecznym miejscu. Możesz go zaimportować w ramach tego czy innego kursu.';
$string['explainimport'] = 'Musisz wskazać plik, który chcesz importować i zdefiniować kryteria.<p>Wyślij swoje żądanie i sprawdź wynik.';
$string['explainspecial'] = 'Pokaż pojęcia, które nie zaczynają się od litery';
$string['exportedentry'] = 'Wyeksportowany plik';
$string['exportentries'] = 'Eksportuj pojęcia';
$string['exportentriestoxml'] = 'Eksportuj pojęcia do pliku XML';
$string['exportfile'] = 'Eksportuj pojęcia do pliku';
$string['exportglossary'] = 'Eksportuj słownik pojęć';
$string['exporttomainglossary'] = 'Eksportuj do głównego słownika pojęć';
$string['filetoimport'] = 'Plik do importu';
$string['filetoimport_help'] = 'Wybierz plik XML zawierający definicje, które chcesz zaimportować';
$string['fillfields'] = 'Pola: Termin i Definicja muszą zostać wypełnione';
$string['filtername'] = 'Automatyczne linkowanie pojęć';
$string['fullmatch'] = 'Szukaj tylko wyrazów tak jak zostały wpisane<br /><small>(jeśli zostały automatycznie połączone)</small>';
$string['fullmatch_help'] = 'Jeżeli zostało wybrane automatyczne łączenie pojęć, wówczas włączenie tego parametru spowoduje,
że tylko całe wyrazy będą łączone.
Na przykład, słownikowy termin "kolor" nie utworzy linku do wyrazu "kolorowy" w tekście.';
$string['glossary:approve'] = 'Aprobuj niezatwierdzone wpisy';
$string['glossary:comment'] = 'Twórz komentarze';
$string['glossary:export'] = 'Eksportuj pojęcia';
$string['glossary:exportentry'] = 'Eksport pojedynczego wpisu';
$string['glossary:exportownentry'] = 'Eksport własnego pojedynczego wpisu';
$string['glossary:import'] = 'Importuj pojęcia';
$string['glossary:managecategories'] = 'Zarządzaj kategoriami';
$string['glossary:managecomments'] = 'Zarządzaj komentarzami';
$string['glossary:manageentries'] = 'Zarządzaj wpisami';
$string['glossary:rate'] = 'Oceń wpisy';
$string['glossary:view'] = 'Oglądaj słownik';
$string['glossary:viewrating'] = 'Oglądaj oceny';
$string['glossary:write'] = 'Twórz nowe pojęcia';
$string['glossaryleveldefaultsettings'] = 'Domyślne ustawienia słownika';
$string['glossarytype'] = 'Typ słownika pojęć';
$string['glossarytype_help'] = 'System pozwala na wyeksportowanie zawratości jakiegokolwiek tymczsowego słownika do głównego słownika kursu.
Aby móc to zrobić musisz najpierw określić, który słownik jest słownikiem głównym.
Uwaga: W ramach jednego kursu można zbudować tylko jeden słownik główny. Tylko nauczyciele mogą aktualizować ten słownik.';
$string['guestnoedit'] = 'Goście nie mogą edytować słowników';
$string['importcategories'] = 'Importuj kategorie';
$string['importedcategories'] = 'Zaimportowano kategorie';
$string['importedentries'] = 'Zaimportowano wpisy';
$string['importentries'] = 'Importuj pojęcia';
$string['importentriesfromxml'] = 'Importuj pojęcia z pliku XML';
$string['includegroupbreaks'] = 'Uwzględnij przerwy grup';
$string['isglobal'] = 'Czy to jest globalny słownik pojęć?';
$string['isglobal_help'] = 'Możesz utworzyć słownik, który będzie dostępny dla całej strony internetowej (globalny słownik).
Aby to zrobić, musisz zadeklarować, który słownik jest słownikiem globalnym.
Możesz mieć tyle słowników globalnych ile chcesz. Słowniki te mogą być wykorzystywane w dowolnym kursie. Inne zasady mają takie same zastosowanie do globalnych słowników.
Uwaga: Tylko administratorzy mogą utworzyć globalne słowniki.';
$string['letter'] = 'litera';
$string['linkcategory'] = 'Automatycznie łącz tę kategorię';
$string['linkcategory_help'] = 'Można automatycznie łączyć nie tylko definicje ale także kategorie definicji.
Uwaga: Poprawność łączenia kategorii jest zależna od wielkości liter.';
$string['linking'] = 'Automatyczne linkowanie';
$string['mainglossary'] = 'Główny słownik pojęć';
$string['maxtimehaspassed'] = 'Maksymalny czas przeznaczony na edycję tego komentarza ({$a}) minął!';
$string['modulename'] = 'Słownik pojęć';
$string['modulenameplural'] = 'Słowniki pojęć';
$string['newentries'] = 'Nowe wpisy w słowniku';
$string['newglossary'] = 'Nowy słownik pojęć';
$string['newglossarycreated'] = 'Nowy słownik pojęć został utworzony';
$string['newglossaryentries'] = 'Nowe pojęcia w słowniku:';
$string['nocomment'] = 'Nie znaleziono żadnych komentarzy';
$string['nocomments'] = '(Nie znaleziono żadnych komentarzy dotyczących tego wpisu)';
$string['noconceptfound'] = 'Nie znaleziono żadnych terminów ani definicji';
$string['noentries'] = 'Nie znaleziono żadnych pojęć w tej sekcji';
$string['noentry'] = 'Nie znaleziono żadnych pojęć';
$string['notapproved'] = 'wpis do słownika nie został jeszcze zatwierdzony';
$string['notcategorised'] = 'Nieskategoryzowane';
$string['numberofentries'] = 'Ilość pojęć';
$string['onebyline'] = '(jedno na linię)';
$string['pluginadministration'] = 'Administracja słownikiem';
$string['pluginname'] = 'Słownik pojęć';
$string['popupformat'] = 'Format okna podręcznego';
$string['printerfriendly'] = 'Wersja do wydruku';
$string['printviewnotallowed'] = 'Nie pozwalaj na drukowanie słownika';
$string['question'] = 'Pytanie';
$string['rejectedentries'] = 'Odrzuć wpisy';
$string['rejectionrpt'] = 'Raport odrzuceń';
$string['resetglossaries'] = 'Usuń wpisy z';
$string['resetglossariesall'] = 'Usuń wszystkie wpisy';
$string['rssarticles_help'] = 'Ta opcja pozawala ustalić liczbę artykułów w RSS Feed.
Liczba pomiędzy 5 a 20 jest zwykle odpowiednia. Zwiększ ją, jesli słownik jest często aktualizowany.';
$string['rsssubscriberss'] = 'Pokaż kanał RSS dla {$a} terminów';
$string['rsstype'] = 'Kanał RSS dla tej aktywności';
$string['rsstype_help'] = 'Opjca ta pozwala włączyć RSS feeds w tym słowniku.
Możesz wybrać jedną z dwóch możliwości:
* **Z autorem:** W tej opcji autor wpisu będzie podany.
* **Bez autora:** W tej opcji autor wpisu nie bedzie podany.';
$string['searchindefinition'] = 'Przeszukaj cały tekst';
$string['secondaryglossary'] = 'Pomocniczy słownik pojęć';
$string['showall'] = 'Pokaż link „Wszystkie”';
$string['showall_help'] = 'Można zindywidualizować sposób w jaki użytkownik będzie przeglądał słownik pojęć.
Wyszukiwanie według kategorii lub daty wpisu jest zawsze dostępne, ale można jeszcze dodać następujące 3 opcje:
**Pokaż link "Specjalne":** Umożliwia wyszukiwanie używając nietypowych znaków n.p. @, #, etc.
**Pokaż link "Alfabet":** Umożliwia wyszukiwanie pojęć według liter.
**Pokaż link "Wszystkie":** Umożliwia pokazanie wszystkich definicji od razu.';
$string['showalphabet'] = 'Pokaż litery alfabetu';
$string['showalphabet_help'] = 'Można zindywidualizować sposób w jaki użytkownik będzie przeglądał słownik pojęć.
Wyszukiwanie według kategorii lub daty wpisu jest zawsze dostępne, ale można jeszcze dodać następujące 3 opcje:
**Pokaż link "Specjalne":** Umożliwia wyszukiwanie używając nietypowych znaków n.p. @, #, etc.
**Pokaż link "Alfabet":** Umożliwia wyszukiwanie pojęć według liter.
**Pokaż link "Wszystkie":** Umożliwia pokazanie wszystkich definicji od razu.';
$string['showspecial'] = 'Pokaż link „Specjalne”';
$string['showspecial_help'] = 'Można zindywidualizować sposób w jaki użytkownik będzie przeglądał słownik pojęć.
Wyszukiwanie według kategorii lub daty wpisu jest zawsze dostępne, ale można jeszcze dodać następujące 3 opcje:
**Pokaż link "Specjalne":** Umożliwia wyszukiwanie używając nietypowych znaków n.p. @, #, etc.
**Pokaż link "Alfabet":** Umożliwia wyszukiwanie pojęć według liter.
**Pokaż link "Wszystkie":** Umożliwia pokazanie wszystkich definicji od razu.';
$string['sortby'] = 'Posortuj według';
$string['sortbycreation'] = 'Według daty utworzenia';
$string['sortbylastupdate'] = 'Według ostatniej aktualizacji';
$string['sortchronogically'] = 'Posortuj chronologicznie';
$string['special'] = 'Specjalne';
$string['standardview'] = 'Szukaj według alfabetu';
$string['studentcanpost'] = 'Studenci mogą dodawać nowe pojęcia';
$string['totalentries'] = 'Ilość wpisów';
$string['usedynalink'] = 'Automatycznie łącz wpisane pojęcia';
$string['usedynalink_help'] = 'Ta opcja umożliwia połączenie jakiekolwiek definicji w slowniku pojęć z definiowanym terminem, gdy takowy pojawi się
w którejkolwiek aktywności dostępnej w ramach danego kursu n.p. forum, wewnętrznych zasobów, podsumowań tygodnia, dzienników itd.

Jeśli nie chcesz by określony termin występujący w tekście n.p. forum nie został połączony, dodaj tagi i wokół tekstu
Zauważ, że nazwy kategorii są także łączone.';
$string['waitingapproval'] = 'Oczekiwanie potwierdzenia';
$string['warningstudentcapost'] = '(Dotyczy tylko sytuacji, gdy słownik pojęć nie jest słownikiem głównym)';
$string['withauthor'] = 'Terminy z autorem';
$string['withoutauthor'] = 'Terminy bez autora';
$string['writtenby'] = 'przez';
$string['youarenottheauthor'] = 'Nie jesteś autorem tego wpisu, więc nie możesz go edytować.';
