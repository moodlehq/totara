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
 * Strings for component 'auth_db', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_db
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_dbcantconnect'] = 'Nie można połączyć się z podaną bazą danych';
$string['auth_dbchangepasswordurl_key'] = 'URL strony do zmiany hasła użytkownika.';
$string['auth_dbdeleteuser'] = 'Usunięty użytkownik: {$a->name} id {$a->id}';
$string['auth_dbdeleteusererror'] = 'Wystąpił błąd podczas usuwania użytkownika {$a}';
$string['auth_dbdescription'] = 'Metoda ta wykorzystuje tabelę zewnętrznej bazy danych dla sprawdzenia czy podana nazwa użytkownika i hasło są poprawne. W przypadku nowego konta, informacje z innych pól również mogą zostać skopiowane do Moodle.';
$string['auth_dbextrafields'] = 'Te pola są opcjonalne. Możesz wstępnie wypełnić niektóre pola dotyczące użytkownika informacją z <b>pól zewnętrznej bazy danych</b>, które tutaj określasz. <br />Jeżeli nic w tym miejscu nie wpiszesz, użyte zostaną wartości domyślne. <br /> W obu przypadkach, użytkownik będzie mógł dokonać edycji tych pól po zalogowaniu';
$string['auth_dbfieldpass'] = 'Nazwa pola zawierającego hasła';
$string['auth_dbfieldpass_key'] = 'Pole hasła';
$string['auth_dbfielduser'] = 'Nazwa pola zawierającego nazwy użytkowników';
$string['auth_dbfielduser_key'] = 'Pole nazwy użytkownika';
$string['auth_dbhost'] = 'Komputer będący hostem serwera bazy danych.';
$string['auth_dbhost_key'] = 'Host';
$string['auth_dbinsertuser'] = 'Dodany użytkownik: {$a->name} id {$a->id}';
$string['auth_dbinsertusererror'] = 'Błąd podczas wstawiania użytkownika {$a}';
$string['auth_dbname'] = 'Nazwa bazy danych';
$string['auth_dbname_key'] = 'Nazwa bazy danych';
$string['auth_dbpass'] = 'Hasło dla powyższej nazwy użytkownika';
$string['auth_dbpass_key'] = 'Hasło';
$string['auth_dbpasstype'] = 'Określ format stosowany przez pole hasła. Kodowanie MD5 przydatne jest przy łączeniu się z innymi popularnymi aplikacjami sieci WWW, takimi jak PostNuke';
$string['auth_dbpasstype_key'] = 'Format hasła';
$string['auth_dbsuspenduser'] = 'Zawieszony użytkownik {$a->name} / {$a->id}';
$string['auth_dbtable'] = 'Nazwa tabeli w bazie danych';
$string['auth_dbtable_key'] = 'Tabela';
$string['auth_dbtype'] = 'Rodzaj bazy danych (szczegółowe informacje: <a href"=../lib/adodb/readme.htm#drivers">ADOdb documentation</a>';
$string['auth_dbtype_key'] = 'Baza danych';
$string['auth_dbupdatinguser'] = 'Zaktualizowany użytkownik: {$a->name} id {$a->id}';
$string['auth_dbuser'] = 'Nazwa użytkownika mającego prawo dostępu do odczytu z bazy';
$string['auth_dbuser_key'] = 'Użytkownik bazy danych';
$string['auth_dbusernotexist'] = 'Nie można zaktualizować nieistniejącego użytkownika: {$a}';
$string['auth_dbuserstoadd'] = 'Wpisy użytkownika do dodania: {$a}';
$string['auth_dbuserstoremove'] = 'Wpisy użytkownika do usunięcia: {$a}';
$string['pluginname'] = 'Korzystaj z zewnętrznej bazy danych';
