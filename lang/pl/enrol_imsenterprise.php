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
 * Strings for component 'enrol_imsenterprise', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_imsenterprise
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['basicsettings'] = 'Podstawowe ustawienia';
$string['createnewcategories'] = 'Utwórz nową (ukryta) kategorię kursu, jeżeli nie odnaleziono jej w Moodle';
$string['createnewcategories_desc'] = '<p> Jeśli &lt;org&gt;&lt;orgunit&gt; element jest prezentowany na kursie przychodzących danych, zawartość będzie użyta do sprecyzowania kategorii jeśli kurs będzie stworzony satysfakcjonująco.</p>
<p>Program wspomagający nie będzie klasyfikowany na istniejącym kursie.</p>
<p>Jeśli nie istnieje kategoria z pożądaną nazwą wtedy będzie stworzona ukryta kategoria.</p>';
$string['createnewcourses'] = 'Utwórz nowe (ukryte) kursy, jeżeli nie odnaleziono ich w Moodle';
$string['createnewcourses_desc'] = '<p>Enterprise IMS wpisuje program wspomagający I może stworzyć nowe kursy dla wszystkich znalezionych w IMS danych ale nie w bazie Moodle, jeżeli to miejscie jest aktywne.</p>
<p>Kursy są w pierwszej kolejności pytane przez ich "numery id" – pole alfanumeryczne w kursie tabel Moodle , które może precyzować kod używając do identyfikacji kursu system informacji studenta (na przykład). Jeśli nie jest znaleziony, tabela kursu jest szukana poprzez "krótki opis", który w Moodle jest krótkim kursem identyfikującym jako wyświetlony w *okruszku** itp. (W niektórych systemach te dwa pola mogą być identyczne). Tylko jeśli to szukanie zawiedzie program wspomagający może opcjonalnie stworzyć nowy kurs.</p>
<p>Wszystkie nowo-wygenerowane kursy są ukrywane w momencie stworzenia.. Jest to robione w celu zapobiegania ciekawości studentów w kompletnie pustych kursach kiedy nauczyciel może być nieświadomy.</p>';
$string['fixcaseusernames'] = 'Zmień nazwę użytkownika na małe litery';
$string['location'] = 'Lokalizacja plików';
$string['mailadmins'] = 'Powiadom administratora poprzez e-mail';
$string['miscsettings'] = 'Różne';
$string['roles'] = 'Role';
