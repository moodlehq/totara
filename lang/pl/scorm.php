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
 * Strings for component 'scorm', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   scorm
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activation'] = 'Aktywacja';
$string['activityloading'] = 'Automatycznie zostaniesz przeniesiony do aktywności w';
$string['activitypleasewait'] = 'Ładowanie, proszę czekać...';
$string['advanced'] = 'Zaawansowane';
$string['aicchacpkeepsessiondata'] = 'Dane sesji AICC HACP';
$string['aicchacpkeepsessiondata_desc'] = 'Czas w dniach przechowywanie zewnętrznych danych sesji AICC HACP (duża wartość ustawienia zapełni tabelę starymi danymi, ale może być przydatne podczas debugowania)';
$string['aicchacptimeout'] = 'Limit czasu AICC HACP';
$string['aicchacptimeout_desc'] = 'Czas w minutach, przez który zewnętrzna sesja AICC HACP może pozostać otwarta';
$string['allowtypeaicchacp'] = 'Włącz zewnętrzne AICC HACP';
$string['allowtypeaicchacp_desc'] = 'W przypadku włączenia umożliwia zewnętrzną komunikację AICC HACP bez wymagania logowania użytkownika dla żądań ogłoszeń z zewnętrznego pakietu AICC';
$string['areapackage'] = 'Pakiet plików';
$string['asset'] = 'Kapitał';
$string['assetlaunched'] = 'Kapitał - przejrzany';
$string['attempt'] = 'Próba';
$string['attempt1'] = '1 próba';
$string['attempts'] = 'Próby';
$string['attemptsx'] = '{$a} prób';
$string['attr_error'] = 'Nieprawidłowa wartość atrybutu ({$a->attr}) w tagu {$a->tag}.';
$string['autocontinue'] = 'Automatyczna kontynuacja';
$string['autocontinue_help'] = '**Auto-Kontynuacja**
Jeżeli automatyczna kontynuacja jest ustawiona na "tak", wtedy SCO wywołuje metodę "close communication", automatycznie następny SCO będzie dostępny.
Jeżeli jest ustawione "Nie", uzytkownik musi użyć przycisku "kontynuuj" żeby kontynuować.';
$string['autocontinuedesc'] = 'To ustawienie włącza aktywność automatycznej kontynuacji';
$string['averageattempt'] = 'Średnia prób';
$string['badmanifest'] = 'Błedy manifestów: zobacz logi błędów';
$string['badpackage'] = 'Podany pakiet/manifest nie jest właściwy. Sprawdź i spróbuj ponownie.';
$string['browse'] = 'Przeglądaj';
$string['browsed'] = 'Przeglądane';
$string['browsemode'] = 'Tryb przeglądania';
$string['browserepository'] = 'Przeglądaj repozytorium';
$string['cannotfindsco'] = 'Nie można znaleźć SCO';
$string['chooseapacket'] = 'Wybierz lub uaktualnij pakiet SCORMa';
$string['completed'] = 'Zakończone';
$string['completionscorerequired'] = 'Wymagaj wyniku minimalnego';
$string['completionstatus_completed'] = 'Ukończone';
$string['completionstatus_failed'] = 'Niezaliczone';
$string['completionstatus_help'] = '# Ukończenie czynności: wymagaj stanu
Zaznaczenie jednego lub więcej stanów będzie wymagało, aby użytkownik uzyskał przynajmniej jeden z zaznaczonych stanów w celu zaznaczenia wykonania tej czynności SCORM, oraz wszelkich innych wymagań ukończenia czynności.';
$string['completionstatus_passed'] = 'Zaliczone';
$string['completionstatusrequired'] = 'Wymagaj stanu';
$string['confirmloosetracks'] = 'UWAGA: Ten pakiet wydaje się być zmienionym lub zmodyfikowanym. Jeśli struktura tego pakietu uległa zmianie, niektóre informacje o użyciu pakietu przez użytkowników mogą zostać utracone.';
$string['contents'] = 'Zawartość';
$string['coursepacket'] = 'Pakiet kursu';
$string['coursestruct'] = 'Struktura kursu';
$string['currentwindow'] = 'Bieżące okno';
$string['datadir'] = 'Błąd systemu plików: Nie można utworzyć folderu z danymi kursu.';
$string['deleteallattempts'] = 'Wykazuj wszystkie użycia SCORM';
$string['deleteattemptcheck'] = 'Czy jesteś absolutnie pewien, że chcesz całkowicie usunąć te podejścia?';
$string['deleteuserattemptcheck'] = 'Czy jesteś absolutnie pewien, że chcesz całkowicie usunąć wszystkie twoje podejścia?';
$string['details'] = 'Szcegóły SCO';
$string['directories'] = 'Pokaż łącze do katalogu';
$string['disabled'] = 'Wyłączony';
$string['display'] = 'Pokaż';
$string['displayattemptstatus'] = 'wyświetl status podejść';
$string['displayattemptstatus_help'] = 'Jeśli opcja jest włączona, wyniki i oceny dla próby są wyświetlane na stronie SCORM.';
$string['displaycoursestructure'] = 'Wyświetl strukturę kursu przy wejściu na stronę';
$string['displaydesc'] = 'To ustawienie włącza pokazywanie pakietu dla aktywności';
$string['displaysettings'] = 'Wyświetl ustawienia';
$string['domxml'] = 'Zewnętrzna biblioteka DOMXML';
$string['duedate'] = 'Termin oddania';
$string['element'] = 'element';
$string['enter'] = 'Wpisz';
$string['entercourse'] = 'Wpisz kurs SCORMa';
$string['errorlogs'] = 'Logi błędów';
$string['everyday'] = 'Każdy dzień';
$string['everytime'] = 'Każdy użyty czas';
$string['exceededmaxattempts'] = 'Osiągnąłeś maksymalną liczbę podejść.';
$string['exit'] = 'Wyjście';
$string['exitactivity'] = 'Wyjdź z aktywności';
$string['expired'] = 'Niestety, ta aktywność została zamknięta {$a} i nie jest już dostępna';
$string['external'] = 'Aktualizuj synchronizację pakietów zewnętrznych';
$string['failed'] = 'Nieudane';
$string['finishscorm'] = 'Jeśli zakończono przeglądanie tego zasobu, {$a}';
$string['finishscormlinkname'] = 'kliknij tu, aby wrócić do strony kursu';
$string['firstaccess'] = 'Pierwszy dostęp';
$string['firstattempt'] = 'Pierwsza próba';
$string['forcejavascript'] = 'Zmuś użytkowników do włączenia JavaScript';
$string['forcejavascriptmessage'] = 'JavaScript jest wymagana do wyświetlenia tego obiektu, włącz obsługę JavaScript w przeglądarce i spróbuj ponownie.';
$string['forcenewattempt'] = 'Wymuś nowe podejścia';
$string['found'] = 'Znaleziono manifest';
$string['frameheight'] = 'Ustaw domyślną wysokość ramki SCO';
$string['framewidth'] = 'Ustaw domyślną szerokość ramki SCO';
$string['fullscreen'] = 'Wyświetl na całym ekranie';
$string['general'] = 'Dane ogólne';
$string['gradeaverage'] = 'Średnia ocena';
$string['gradehighest'] = 'Najwyższa ocena';
$string['grademethod'] = 'Metoda oceniania';
$string['grademethod_help'] = '**Metody oceniania**
Wynik czynności SCORM/AICC pokazany na stronach ocen może być przedstawiony w kilku trybach:
**Sytuacja SCO**
Ten tryb pokazuje liczbę zakończonych/zdanych SCOes dla czynności. Wartością maksymalną jest ilość SCO.
**Najlepsza ocena**
Strona ocenianie wyświetla najwyższy wynik uzyskanych przez uczestników we wszystkich zdanych SCOes.
**Ocena przeciętna**
Jeśli wybierasz ten tryb Moodle określi średnią wszystkich wyników.
**Ocena zsumowana**
W tym trybie wszystkie wyniki zostaną zsumowane.

Funkcje autokontynuacji
Jak pokazać/ukryć przycisk trybu przeglądania
Metody oceniania w kursie SCORM
Wartość Maksymalnej oceny w kursie SCORM
Definiowanie wielkości ramki jako SCO
Co to jest pakiet SCORM/AICC';
$string['grademethoddesc'] = 'Ta preferencja ustawia domyślną metodę oceny dla czynności';
$string['gradescoes'] = 'Sytuacja Scoes';
$string['gradesum'] = 'Zsumuj oceny';
$string['height'] = 'Wysokość';
$string['hidden'] = 'Ukryty';
$string['hidebrowse'] = 'Wyłącz tryb pokazu wstępnego';
$string['hidebrowse_help'] = '# Ukryj przycisk Podgląd
Jeśli ta opcja jest ustawiona na Tak, przycisk Podgląd zostanie ukryty na stronie widoku czynności pakietu SCORM/AICC.
Uczestnik może wybrać podgląd (tryb przeglądania) czynności lub próby w trybie normalnym.
Gdy obiekt nauki zostanie ukończony w trybie podglądu (przeglądania), zostanie on oznaczony ikoną przeglądu';
$string['hidebrowsedesc'] = 'Ta preferencja ustawia wartość domyślną lub to, czy włączyć, czy też wyłączyć tryb podglądu';
$string['hideexit'] = 'Ukryj link do wyjścia';
$string['hidenav'] = 'Ukryj przyciski nawigacji';
$string['hidenavdesc'] = 'Ta preferencja ustawia wartość domyślną lub to, czy pokazać, czy też ukryć przyciski nawigacji';
$string['hidereview'] = 'Ukryj przycisk cofania';
$string['hidetoc'] = 'Pokaż strukturę kursu (TOC)';
$string['hidetocdesc'] = 'Ta preferencja ustawia wartość domyślną lub to, czy pokazać, czy też ukryć wyświetlanie struktury kursu (TOC)';
$string['highestattempt'] = 'Najwyższa próba';
$string['identifier'] = 'Identyfikator pytania';
$string['incomplete'] = 'Niepełne';
$string['info'] = 'Informacja';
$string['interactions'] = 'Interakcja';
$string['interactionstype'] = 'Typ pytania';
$string['invalidactivity'] = 'Aktywność SCORM jest niepoprawna';
$string['invalidurl'] = 'Podano niepoprawny adres URL dla czynności Bezpośredni adres URL';
$string['last'] = 'Ostatni dostęp włączony';
$string['lastaccess'] = 'Ostatni dostęp';
$string['lastattempt'] = 'Ostatnia próba';
$string['lastattemptlock'] = 'Zablokuj po ostatniej próbie';
$string['location'] = 'Pokaż pasek pozucji';
$string['max'] = 'Maksymalna punktacja';
$string['maximumattempts'] = 'Liczba prób';
$string['maximumattemptsdesc'] = 'Ta preferencja ustawia domyślną liczbę maksymalną prób dla czynności';
$string['maximumgradedesc'] = 'To ustawienie przydziela maksymalną, domyślną ocenę dla aktywności.';
$string['menubar'] = 'Pokaż pasek menu';
$string['min'] = 'Min punkty';
$string['missing_attribute'] = 'Brakuje atrybutu {$a->attr} w tagu {$a->tag}';
$string['missing_tag'] = 'Brakuje tagu {$a->tag}';
$string['missingparam'] = 'Wymagane jest pominięte lub brakuje';
$string['mode'] = 'Tryb';
$string['modulename'] = 'Pakiet SCORM';
$string['modulenameplural'] = 'Pakiety SCORM';
$string['navigation'] = 'Nawigacja';
$string['newattempt'] = 'Rozpocznij nową próbę';
$string['next'] = 'Kontynuuj';
$string['no_attributes'] = 'Tag {$a->tag} musi mieć atrybuty';
$string['no_children'] = 'Tag {$a->tag} musi mieć \'dzieci\'';
$string['noactivity'] = 'Utwórz raport';
$string['noattemptsallowed'] = 'Liczba dozwolonych prób';
$string['noattemptsmade'] = 'Liczba wykonanych podejść';
$string['nolimit'] = 'Nieograniczone próby';
$string['nomanifest'] = 'Nie znaleziono manifestu';
$string['noprerequisites'] = 'Niestety nie masz odpowiednich praw dostępu do tego przedmiotu.';
$string['noreports'] = 'Brak raportu do wyświetlenia';
$string['normal'] = 'Normalne';
$string['noscriptnoscorm'] = 'Twoja przedlądarka nie wspomaga javascript lub obsługa java script została wyłączona. Nie można zapisać';
$string['not_corr_type'] = 'Błąd typu w tagu {$a->tag}';
$string['notattempted'] = 'Nie próbowano';
$string['notopenyet'] = 'Niestety, ta aktywność jest niedostępna do  {$a}';
$string['objectives'] = 'Cele';
$string['optallstudents'] = 'wszyscy użytkownicy';
$string['options'] = 'Opcje';
$string['optionsadv'] = 'Opcje (zaawansowane)';
$string['organization'] = 'Organizacja';
$string['organizations'] = 'Organizacje';
$string['othersettings'] = 'Dodatkowe ustawienia';
$string['othertracks'] = 'Inne drogi';
$string['package'] = 'Plik pakietu';
$string['package_help'] = '**Plik pakietu**
Pakiet jest plikiem z rozszerzeniem **zip** (lub pif) i zawiera pliki definicji kursu AICC lub SCORM.
Pakiet **SCORM** musi zawierać w sobie pliki o nazwie **imsmanifest.xml** który definiuje strukturę kursu SCORM, lokalizację zasobów i wiele innych rzeczy.
Pakiet **AICC** jest określany przez kilka plików (od 4 do 7) z określonymi rozszerzeniami. Poniżej znajdziesz oznaczenia rozszerzeń:
* CRS – Plik Opisu Kursu
* AU – Plik Jednostki Zadaniowej
* DES – Plik Opisowy
* CST – Plik Struktury Kursu
* ORE – Plik Zależności Obiektywnych (opcjonalny)
* PRE – Plik Założeń Wstępnych (opcjonalny)
* CMP – Plik Wymogu Ukończenia (opcjonalny)
</ul>';
$string['packagedir'] = 'Błąd systemu plików: Nie można utworzyć folderu dla pakietu';
$string['packagefile'] = 'Nie wskazano pliku';
$string['packageurl'] = 'adres URL';
$string['pagesize'] = 'Rozmiar strony';
$string['passed'] = 'Udane';
$string['php5'] = 'PHP5 (natywna biblioteka DOMXML)';
$string['pluginadministration'] = 'Administracja SCORM/AICC';
$string['pluginname'] = 'Pakiet SCORM';
$string['popup'] = 'Otwórz w nowym oknie';
$string['popupmenu'] = 'Przesuń menu na dół';
$string['popupopen'] = 'Otwórz w nowym oknie';
$string['position_error'] = 'Tag {$a->tag} nie może być \'dzieckiem\' {$a->parent}';
$string['preferencespage'] = 'Preferencje tylko dla bieżącej strony';
$string['preferencesuser'] = 'Preferencje tylko dla tego raportu';
$string['prev'] = 'Poprzednie';
$string['raw'] = 'Surowe punkty';
$string['regular'] = 'Regularny manifest';
$string['report'] = 'Raport';
$string['reports'] = 'Raporty';
$string['resizable'] = 'Pozwól zmieniać rozmiar okna';
$string['result'] = 'Wynik';
$string['results'] = 'Wyniki';
$string['review'] = 'Przegląd';
$string['reviewmode'] = 'Tryb przeglądu';
$string['scoes'] = 'Wyniki';
$string['score'] = 'Wynik';
$string['scorm:deleteownresponses'] = 'Usuń własne próby';
$string['scorm:deleteresponses'] = 'Usuń próby SCORM';
$string['scorm:savetrack'] = 'Zapisz ścieżkę';
$string['scorm:skipview'] = 'Pomiń wprowadzenie';
$string['scorm:viewreport'] = 'Zobacz raport';
$string['scorm:viewscores'] = 'Zobacz wyniki';
$string['scormclose'] = 'Do';
$string['scormcourse'] = 'Kurs SCORM';
$string['scormloggingoff'] = 'Logowanie API jest wyłączone';
$string['scormloggingon'] = 'Logowanie API jest włączone';
$string['scormopen'] = 'Od';
$string['scormresponsedeleted'] = 'Usunięte próby użytkownika';
$string['scormtype'] = 'Typ';
$string['scrollbars'] = 'Włącz pasek przewijania w oknie';
$string['selectall'] = 'Zaznacz wszystko';
$string['selectnone'] = 'Odznacz wszystko';
$string['show'] = 'Pokaż';
$string['sided'] = 'Z boku';
$string['skipview'] = 'Uczestnik pominął zawartość strony struktury';
$string['skipview_help'] = '# Uczestnik pomija stronę struktury zawartości
W przypadku dodania pakietu zawierającego tylko jeden obiekt nauki można wybrać automatyczne pomijanie strony struktury zawartości, gdy użytkownik kliknie czynność SCORM na stronie kursu.
Można wybrać:
\* **|Nigdy** pomiń stronę struktury zawartości
\* **|Pierwszy dostęp** tylko za pierwszym razem pomiń stronę struktury zawartości
\* **|Zawsze** pomiń stronę struktury zawartości';
$string['skipviewdesc'] = 'Ta preferencja określa, kiedy domyślnie ma zostać pominięta struktura zawartości strony';
$string['slashargs'] = 'OSTRZEŻENIE: argumenty z ukośnikiem są wyłączone w tej witrynie i obiekty mogą nie działać zgodnie z oczekiwaniami!';
$string['stagesize'] = 'Rozmiar ramki/okna';
$string['stagesize_help'] = '# Rozmiar
Te dwa ustawienia określają wysokość i szerokość ramki/okna obiektów nauki.';
$string['started'] = 'Rozpoczęte o';
$string['status'] = 'Stan';
$string['statusbar'] = 'Pokaż pasek stanu';
$string['student_response'] = 'odpowiedź';
$string['subplugintype_scormreport'] = 'Raport';
$string['subplugintype_scormreport_plural'] = 'Raporty';
$string['suspended'] = 'Zawieszone';
$string['syntax'] = 'Błąd składni';
$string['tag_error'] = 'Nieznany tag ({$a->tag}) w treści: {$a->value}';
$string['time'] = 'Czas';
$string['timerestrict'] = 'Ogranicz możliwość odpowiedzi w czasie';
$string['title'] = 'Tytuł';
$string['toc'] = 'Spis treści';
$string['too_many_attributes'] = 'Tag {$a->tag} ma za wiele atrybutów';
$string['too_many_children'] = 'Tag {$a->tag} ma za wiele \'dzieci\'';
$string['toolbar'] = 'Pokaż pasek narzędzi';
$string['totaltime'] = 'Czas (suma)';
$string['trackingloose'] = 'OSTRZEŻENIE: Dane dotyczące monitorowania tego pakietu SCORMa zostaną utracone!';
$string['type'] = 'Typ';
$string['typelocal'] = 'Przesłany pakiet';
$string['typelocalsync'] = 'Pobrany pakiet';
$string['unziperror'] = 'Wystąpił błąd podczas rozpakowywania pakietu';
$string['updatefreq'] = 'Częstotliwość automatycznej aktualizacji';
$string['updatefreqdesc'] = 'Ta preferencja ustawia domyślną częstotliwość automatycznej aktualizacji czynności';
$string['validateascorm'] = 'Autoryzuj pakiet SCORMa';
$string['validation'] = 'Wynik autoryzacji';
$string['validationtype'] = 'Wybierz bibliotekę DOMXML, która będzie autoryzowała Manifest SCORM. Jeśli się na tym nie znasz, pozostaw wartość obecnie wybraną.';
$string['value'] = 'Wartość';
$string['versionwarning'] = 'Wersja manifestu jest starsza niż 1.3, ostrzeżenie w tagu {$a->tag}';
$string['viewallreports'] = 'Przejrzyj raportu dla {$a} prób';
$string['viewalluserreports'] = 'Przejrzyj raporty dla {$a} studentów';
$string['whatgrade'] = 'Oceń próby';
$string['whatgrade_help'] = '# Ocenianie prób
W przypadku udostępnienia użytkownikom wielu prób można określić sposób wykorzystywania wynikowej liczby prób w dzienniku ocen.';
$string['whatgradedesc'] = 'Ta preferencja ustawia domyślne ocenianie prób';
$string['width'] = 'Szerokość';
$string['window'] = 'Okno';
