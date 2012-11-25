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
 * Strings for component 'tool_uploaduser', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_uploaduser
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowdeletes'] = 'Zezwól na usuwanie';
$string['allowrenames'] = 'Dopuść zmiany nazw';
$string['csvdelimiter'] = 'Separator pola pliku CSV';
$string['defaultvalues'] = 'Domyślne wartości';
$string['deleteerrors'] = 'Usuń błędy';
$string['encoding'] = 'Szyfrowanie';
$string['errors'] = 'Błędy';
$string['nochanges'] = 'Bez zmian';
$string['renameerrors'] = 'Przemianowane błędy';
$string['requiredtemplate'] = 'Wymagane. Możesz użyć następującej składni: %l = nazwisko (lastname), %f = imię (firstname), %u = nazwa użytkownika (username). Zobacz w helpie szczegółowe przykłady.';
$string['rowpreviewnum'] = 'Podgląd wierszy';
$string['uploadpicture_cannotmovezip'] = 'Nie można przenieść pliku zip do katalogu tymczasowego.';
$string['uploadpicture_cannotprocessdir'] = 'Nie można przetworzyć rozpakowanych plików.';
$string['uploadpicture_cannotsave'] = 'Nie można zapisać obrazu dla użytkownika {$a}. Sprawdź oryginalny obraz.';
$string['uploadpicture_cannotunzip'] = 'Nie można odpakować archiwum z obrazami';
$string['uploadpicture_invalidfilename'] = 'Plik obrazu {$a} posiada niewłaściwe znaki w swojej nazwie. Pominięto.';
$string['uploadpicture_overwrite'] = 'Nadpisać istniejący obraz użytkownika?';
$string['uploadpicture_userfield'] = 'Wybierz atrybut użytkownika odpowiadający nazwom obrazów:';
$string['uploadpicture_usernotfound'] = 'Użytkownik z \'{$a->userfield}\' o wartości  \'{$a->uservalue}\' nie istnieje. Pominięto.';
$string['uploadpicture_userskipped'] = 'Pominięto użytkownika {$a} który już posiada obraz.';
$string['uploadpicture_userupdated'] = 'Uaktualniono obraz dla użytkownika {$a}.';
$string['uploadpictures'] = 'Wysyłanie obrazów użytkowników';
$string['uploadpictures_help'] = 'Zdjęcia użytkowników mogą być przesłane jako skompresowany plik zip zawierający wiele plików graficznych. Pliki graficzne powinny być nazwane następująco: wybrany-użytkownik-atrybut.rozszerzenie, na przykład user1234.jpg dla użytkownika o nazwie user1234.';
$string['uploadusers'] = 'Prześlij użytkowników';
$string['uploadusers_help'] = 'Po pierwsze zwróć uwagę, że ** zwykle nie ma potrzeby importowania wszystkich użytkowników.**.
Aby zminimalizować nakład pracy zobacz czy można zastosować inne formy identyfikacji użytkowników, które nie wymagają
żmudnej, manualnej pracy jak n.p. łączenie się z zewnętrzną bazą danych bądĽ pozwolenie na stworzenie użytkownikom
własnych kont.
Jeśli jesteś pewien, że chcesz zaimportować konta użytkowników z pliku tekstowego, musisz odpowiednio sformatować
ten plik:

* Jeden rekord na jednej linii
* Każdy rekord zawiera dane oddzielone od siebie przecinkami
* Pierwszy rekord zawiera listę pól. Ten rekord definiuje format całego pliku.
>
> **Obowiązkowe pola:** muszą być zawarte w pierwszym rekordzie i określone dla każdego użytkownika
>
>
> username, password, firstname, lastname, email
>
> **Domyślne pola:** te są już opcjonalne - jeśli nie są zawarte, wówczas wartości te będą pobrane od
> głównego administratora.
>
>
> institution, department, city, country, lang, auth, timezone
>
>
> **Opcjonalne pola: ** te wartości są zupełnie opcjonalne. Nazwy przedmiotów mogą być skrócone.
>
>
> idnumber, icq, phone1, phone2, address, url, description, mailformat, maildisplay, htmleditor, autosubscribe, course1, course2, course3, course4, course5, group1, group2, group3, group4, group5
>
>
>
* Przecinki powinny być zakodowane jako , - skrypt automatycznie odczyte ten znak jako przecinek.
* Dla pól Fałsz/Prawda używaj 0 dla fałsz i 1 dla prawda.
* Zauważ: Jeśli użytkownik jest już zapisany w bazie danych Moodle, skrypt odnajdzie numer użytkownika w indeksie bazy danych
i zapisze tego studenta na jakikolwiek z wymienionych kursów bez aktualizowania czy zmiany innych danych.

Oto przykład pliku do importu:
username, password, firstname, lastname, email, lang, idnumber, maildisplay, course1, group1
jonest, verysecret, Tom, Jones, jonest@someplace.edu, en, 3663737, 1, Intro101
reznort, somesecret, Trent, Reznor, reznort@someplace.edu, en_us, 6736733, 0, Advanced202';
$string['uploaduserspreview'] = 'Załaduj podgląd użytkowników';
$string['uploadusersresult'] = 'Załaduj rezultaty użytkowników';
$string['useraccountupdated'] = 'Użytkownik uaktualniony';
$string['userdeleted'] = 'Użytkownik usunięty';
$string['userrenamed'] = 'Użytkownicy ze zmieniąną nazwą';
$string['userscreated'] = 'Użytkownicy utworzeni';
$string['usersdeleted'] = 'Użytkownicy skasowani';
$string['usersrenamed'] = 'Użytkownicy ze zmieniąną nazwą';
$string['usersskipped'] = 'Użytkownicy pominięci';
$string['usersupdated'] = 'Użytkownicy uaktualnieni';
$string['usersweakpassword'] = 'Użytkownicy posiadający za słabe hasła';
$string['uubulk'] = 'Wybierz do wielokrotnych operacji';
$string['uubulkall'] = 'Wszyscy użytkownicy';
$string['uubulknew'] = 'Nowi użytkownicy';
$string['uubulkupdated'] = 'Uaktualnieni użytkownicy';
$string['uucsvline'] = 'Linia CSV';
$string['uulegacy1role'] = '(Domyślnie Student)typeN=1';
$string['uulegacy2role'] = '(Domyślnie Nauczyciel)typeN=2';
$string['uulegacy3role'] = '(Domyślnie Nauczyciel bez prawa edycji)typeN=3';
$string['uunoemailduplicates'] = 'Zapobiegaj duplikowaniu adresów email';
$string['uuoptype'] = 'Typ wysyłania';
$string['uuoptype_addinc'] = 'Dodaj wszystkich, dodaj numer do nazwy użytkownika jeśli jest to konieczne';
$string['uuoptype_addnew'] = 'Dodaj nowego i pomiń istniejących użytkowników';
$string['uuoptype_addupdate'] = 'Dodaj nowego i uaktualnij istniejących użytkowników';
$string['uuoptype_update'] = 'Uaktualnij tylko istniejących użytkowników';
$string['uupasswordcron'] = 'Wygenerowano w cronie';
$string['uupasswordnew'] = 'Hasło nowego użytkownika';
$string['uupasswordold'] = 'Hasło istniejącego użytkownika';
$string['uustandardusernames'] = 'Ujednolicona nazwa użytkownika';
$string['uuupdatefromfile'] = 'Nadpisz plikiem';
$string['uuupdatetype'] = 'Dodatkowe informacje na temat istniejącego użytkownika';
