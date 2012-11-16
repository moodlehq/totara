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
 * Strings for component 'auth_shibboleth', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_shibboleth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_shib_auth_method'] = 'Nazwa metody uwierzytelniania';
$string['auth_shib_changepasswordurl'] = 'URL do zmiany hasła użytkownika';
$string['auth_shib_convert_data'] = 'Modyfikacja danych API';
$string['auth_shib_convert_data_description'] = 'Możesz używać tego API aby dalej modyfikować dane dostarczone przez Shibboleth. <a href="../auth/shibboleth/README.txt" target="_blank">Przeczytaj</a>  w którym są dalsze instrukcje';
$string['auth_shib_convert_data_warning'] = 'Ten plik nie istnieje albo serwer sieci nie może go odczytać';
$string['auth_shib_instructions'] = 'Użyj aby dostać się przez Shibboleth, jeśli twoja instytucja go używa. Jeśli nie, użyj normalnego pokazanego tu loginu.';
$string['auth_shib_instructions_help'] = 'Tutaj należy zamieścić odpowiednie instrukcje dla użytkowników, tłumaczące Shibboleth. Zostaną one zamieszczone na stronie logowania w sekcji instrukcje. Instrukcja musi zawierać link do"**{$a}**", na który użytkownicy klikają, gdy chcą się zalogować';
$string['auth_shib_only'] = 'Tylko Shibboleth';
$string['auth_shib_only_description'] = 'Sprawdź tę opcję, jeśli należy wprowadzić potwierdzenie Shibboleth';
$string['auth_shib_username_description'] = 'Nazwa serwera sieci w  środowisku Shibboleth, który będzie używany jako nazwa Moodle';
$string['auth_shibboleth_errormsg'] = 'Proszę wybrać organizację, której jesteś członkiem!';
$string['auth_shibboleth_login'] = 'Login Shibboleth';
$string['auth_shibboleth_login_long'] = 'Zaloguj się do Moodle poprzez Shibboleth';
$string['auth_shibboleth_manual_login'] = 'Login manualny';
$string['auth_shibboleth_select_member'] = 'Jestem członkiem...';
$string['auth_shibboleth_select_organization'] = 'W przypadku uwierzytelniania za pomocą Shibboleth, proszę wybrać organizację z listy rozwijanej:';
$string['auth_shibbolethdescription'] = 'Używając tej metody można tworzyć i autoryzować użytkowników poprzez <a href="http://shibboleth.internet2.edu/" target="_blank">Shibboleth</a>. <br> W celu zapoznania się jak ustawić Twój Moodle za pomocą Shibboleth <a href="../auth/shibboleth/README.txt" target="_blank">czytaj tutaj</a>.';
$string['pluginname'] = 'Shibboleth';
$string['shib_no_attributes_error'] = 'Wydaje się, że masz dostęp do Shibboleth, ale Moodle nie otrzymał żadnych danych użytkownika. Proszę sprawdzić, czy do właściciela serwera, na którym działa Moodle zostały dostarczone dane identyfikacji, albo poinformować administratora serwera.';
$string['shib_not_all_attributes_error'] = 'Moodle potrzebuje pewnych atrybutów Shibboleth, które w twoim wypadku nie istnieją. Te atrybuty to: {$a}<br /> Prosimy poinformować administratora serwera albo dostarczyciela tożsamości.';
$string['shib_not_set_up_error'] = 'Potwierdzenie Shibboleth nie zostało ustawione poprawnie, ponieważ nie ma na tej stronie zmiennych dla środowiska Shibboleth. Proszę <a href="README.txt">przeczytać</a>, gdzie są dalsze instrukcje albo skontaktować się z zarządzającym siecią tego Moodle.';
