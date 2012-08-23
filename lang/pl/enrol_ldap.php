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
 * Strings for component 'enrol_ldap', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Przydziel rolę \'{$a->role_shortname}\' użytkownikowi \'{$a->user_username}\' w kursie \'{$a->course_shortname}\' (id {$a->course_id})';
$string['autocreate'] = 'Kursy mogą być tworzone automatycznie jeżeli pojawia się zgłoszenie na kurs, który dotychczas nie istnieje w Moodle';
$string['autocreation_settings'] = 'Ustawinia automatycznego tworzenia kursów';
$string['bind_dn'] = 'Jeżeli chcesz używać bind-user do poszukiwania użytkowników, określ ich tutaj. Podobnie do \'cn=ldapuser,ou=public,o=org\'';
$string['bind_pw'] = 'Hasło dla bind-user';
$string['bind_pw_key'] = 'Hasło';
$string['category'] = 'Kategoria dla automatycznie tworzonych kursów';
$string['category_key'] = 'Kategoria';
$string['contexts'] = 'Kontekst LDAP';
$string['couldnotfinduser'] = 'Nie udało się odnaleźć użytkownika \'{$a}\', pomijam';
$string['course_fullname'] = 'Opcjonalne: Pole skąd LDAP ma pobierać pełną nazwę.';
$string['course_idnumber'] = 'Mapuj (odwzoruj) unikalny identyfikator w LDAP, przeważnie <em>cn</em> lub <em>uid</em>. Blokuj tę wartość jeżeli używasz automatycznego tworzenia kursów.';
$string['course_settings'] = 'Ustawienie zapisywania na kurs';
$string['course_shortname'] = 'Opcjonalne:Pole skąd LDAP ma pobierać nazwę skróconą';
$string['course_summary'] = 'Opcjonalne:Pole skąd LDAP ma pobierać opis';
$string['editlock'] = 'Blokuj wartość';
$string['enrolname'] = 'LDAP';
$string['enroluser'] = 'Zapisz użytkownika \'{$a->user_username}\' do kursu \'{$a->course_shortname}\' (id {$a->course_id})';
$string['enroluserenable'] = 'Włącz metodę zapisu dla użytkownika \'{$a->user_username}\' w kursie \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extremovedunenrol'] = 'Wypisz użytkownika \'{$a->user_username}\' z kursu \'{$a->course_shortname}\' (id {$a->course_id})';
$string['failed'] = 'Nie powiodło się!';
$string['general_options'] = 'Opcje ogólne';
$string['host_url'] = 'Określ URL hostu LDAP podobnie do: \'ldap://ldap.myorg.com/\'
lub \'ldaps://ldap.myorg.com/\'';
$string['ldap_encoding_key'] = 'kodowanie LDAP';
$string['memberattribute'] = 'Atrybut członka LDAP';
$string['objectclass'] = 'objectClass używany do szukania kursów. Przeważnie \'posixGroup\'.';
$string['ok'] = 'OK!';
$string['pluginname'] = 'zapisy LDAP';
$string['pluginname_desc'] = '<p>Możesz użyć serwera LDAP do kontroli zapisów.
Zakłada się że twoje drzewo LDAP zawiera grupy odwzorowujące kursy że każda z tych grup/kursów będzie miała wpisy członkowskie odwzorowujące studentów. </p>
Zakłada się, że kursy są zdefiniowane jako grupy w LDAPie, a każda z tych grup ma wiele pól czlonkowkich (<em>member</em> lub <em>memberUid</em>)  które zawierają unikatowy identyfikator użytkownika.
Aby wykorzystywać zapisy przez LDAP twoi użytkownicy <strong> muszą </strong> mieć ważne (aktualne, poprawne) pole idnumber. Grupy LDAP muszą mieć ten idnumber w polach członków aby użytkownik został zapisany na kurs.
To będzie działać poprawnie jeśli już korzystasz z autoryzacji LDAP.</p>
Zapisywanie będzie uaktualniane kiedy użytkownik zaloguje się. Można również uruchomić skrypt do synchronizacji zapisów. Zobacz w em>enrol/ldap/enrol_ldap_sync.php</em>.</p>
<p> Ta wtyczka może również tworzyć automatycznie nowe kursy, kiedy pojawiają się nowe grupy w LDAP. </p>';
$string['pluginnotenabled'] = 'Wtyczka nie jest włączona!';
$string['roles'] = 'Mapowanie roli';
$string['server_settings'] = 'Ustawienia sewera LDAP';
$string['synccourserole'] = '== Synchronizacja kursu \'{$a->idnumber}\' dla roli \'{$a->role_shortname}\'';
$string['template'] = 'Opcjonalnie: Auto-tworzenie kursów może kopiować ustawienia z wzorcowego kursu.';
$string['template_key'] = 'Szablon';
$string['updatelocal'] = 'Uaktualnij dane lokalne';
$string['version'] = 'Wersja protokołu LDAP zainstalowana na Twoim serwerze.';
$string['version_key'] = 'Wersja';
