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
 * Strings for component 'enrol_self', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_self
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['customwelcomemessage'] = 'Zwyczajna wiadomość powitalna';
$string['enrolenddate'] = 'Data końcowa';
$string['enrolenddaterror'] = 'Data końcowa zapisów na kurs nie może być wcześniejsza niż data rozpoczęcia kursu';
$string['enrolme'] = 'Zapisz mnie';
$string['enrolstartdate'] = 'Data początkowa';
$string['longtimenosee_help'] = 'Jeśli użytkownicy nie mają dostępu do kursu przez długi czas to są automatycznie z niego wypisywani. Ten parametr określa limit czasowy tego terminu.';
$string['maxenrolled'] = 'Maksymalna ilość zapisanych użytkowników';
$string['maxenrolled_help'] = 'Określ maksymalną liczbę użytkowników, którzy mogą się zapisać samodzielnie. 0 oznacza brak limitu.';
$string['maxenrolledreached'] = 'Maksymalna liczba użytkowników uprawnionych do samodzielnych zapisów została już osiągnięta.';
$string['passwordinvalid'] = 'Nieprawidłowy klucz dostępu, spróbuj ponownie';
$string['passwordinvalidhint'] = 'Podany klucz dostępu do kursu nie jest poprawny, spróbuj ponownie<br />(wskazówka: klucz zaczyna się na \'{$a}\')';
$string['pluginname'] = 'Rejestracja samodzielna';
$string['requirepassword'] = 'Wymagaj klucza dostępu do kursu';
$string['role'] = 'Przypisz role';
$string['self:manage'] = 'Zarządzaj zapisanymi użytkownikami';
$string['self:unenrol'] = 'Wypisz użytkowników z kursu';
$string['self:unenrolself'] = 'Wypisz się z kursu';
$string['sendcoursewelcomemessage'] = 'Wysyłaj powitania nowym użytkownikom kursów.';
$string['sendcoursewelcomemessage_help'] = 'Jeśli włączysz, użytkownicy będą otrzymywali powitania przez email w momencie samodzielnego zapisania się do kursu.';
$string['showhint'] = 'Pokaż podpowiedź';
$string['showhint_desc'] = 'Pokaż pierwszą literę klucza dostępu gościa.';
$string['status'] = 'Zezwól na samodzielną rejestrację';
$string['status_desc'] = 'Zezwalaj użytkownikom na samodzielne zapisy na kurs.';
$string['status_help'] = 'To ustawienie określa, czy użytkownik może zapisać się na kurs (a także wypisać z kursu jeśli posiada odpowiednie uprawnienia).';
$string['unenrol'] = 'Wypisz użytkownika';
$string['unenrolselfconfirm'] = 'Czy na pewno chcesz wypisać się z kursu "{$a}"?';
$string['unenroluser'] = 'Czy na pewno chcesz wypisać "{$a->user}" z kursu "{$a->course}"?';
$string['usepasswordpolicy'] = 'Użyj zasady hasła';
$string['usepasswordpolicy_desc'] = 'Użyj standardowych zasad haseł dla kluczy rejestracji.';
$string['welcometocourse'] = 'Witaj w {$a}';
$string['welcometocoursetext'] = 'Witaj w kursie {$a->coursename}!

Jedną z pierwszych rzeczy, którą możesz zrobić, jest zmodyfikowanie swojego profilu, aby inni mogli dowiedzieć się więcej o Tobie:

{$a->profileurl}';
