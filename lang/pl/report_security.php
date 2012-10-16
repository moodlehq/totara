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
 * Strings for component 'report_security', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   report_security
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['check_configrw_name'] = 'Zapisywalny config.php';
$string['check_configrw_ok'] = 'config.php nie może być modyfikowany przez skrypty PHP.';
$string['check_configrw_warning'] = 'Skrypt PHP może modyfikować plik config.php.';
$string['check_defaultuserrole_error'] = 'Domyślna rola "{$a}" użytkownika jest niepoprawnie zdefiniowana!';
$string['check_defaultuserrole_name'] = 'Domyślna rola dla wszystkich użytkowników';
$string['check_defaultuserrole_notset'] = 'Domyślna rola nie jest ustawiona.';
$string['check_defaultuserrole_ok'] = 'Domyślna rola dla wszystkich użytkowników jest zdefiniowana poprawnie.';
$string['check_displayerrors_details'] = '<p>Włączanie ustawienia PHP: <code>display_errors</ code> nie jest zalecane na stronach komercyjnych, ponieważ komunikaty o błędach mogą ujawnić poufne informacje o twoim serwerze.</p>';
$string['check_displayerrors_error'] = 'Ustawienie PHP wyświetlające błędy jest włączone. Zaleca się, aby było ono wyłączone.';
$string['check_displayerrors_name'] = 'Wyświetlanie błędów PHP';
$string['check_displayerrors_ok'] = 'Wyświetlanie błędów PHP wyłączone.';
$string['check_emailchangeconfirmation_error'] = 'Użytkownicy mogą wprowadzić dowolny adres e-mail.';
$string['check_emailchangeconfirmation_info'] = 'Użytkownicy mogą wprowadzić adresy e-mail tylko z dozwolonych domen.';
$string['check_emailchangeconfirmation_name'] = 'Potwierdzenie zmiany adresu e-mail';
$string['check_emailchangeconfirmation_ok'] = 'Potwierdzenie zmiany adresu e-mail w profilu użytkownika.';
$string['check_embed_details'] = '<p>Nieograniczone umieszczanie/zagnieżdżanie obiektów jest bardzo niebezpieczne -  każdy zarejestrowany użytkownik może przypuścić atak typu XSS w stosunku do innych użytkowników serwera. Ta opcja powinna być wyłączona na serwerach/stronach komercyjnych.</p>';
$string['check_embed_name'] = 'Zezwól na znaczniki EMBED i OBJECT';
$string['check_embed_ok'] = 'Nieograniczone osadzanie obiektów nie jest dozwolone.';
$string['check_frontpagerole_error'] = 'Wykryto niepoprawnie zdefiniowaną rolę strony głównej:  "{$a}"';
$string['check_frontpagerole_name'] = 'Rola strony głównej';
$string['check_frontpagerole_notset'] = 'Rola strony głównej nie jest jeszcze zdefiniowana';
$string['check_frontpagerole_ok'] = 'Rola strony głównej jest zdefiniowana poprawnie.';
$string['check_globals_details'] = '<p>Opcja "Rejestruj zmienne globalne" jest uważane za bardzo niebezpieczne ustawienie PHP.</p>
<p><code>register_globals=off</code> musi zostać ustawione w konfiguracji PHP. To ustawienie może być kontrolowane poprzez edycję <code>php.ini</code>, konfigurację Apache/IIS lub pliku <code>.htaccess</code>.</p>';
$string['check_globals_error'] = 'Opcja "Rejestruj zmienne globalne" musi być wyłączona. Proszę natychmiast skorygować ustawienia PHP serwera!';
$string['check_globals_name'] = 'Rejestruj zmienne globalne';
$string['check_globals_ok'] = 'Opcja "Rejestruj zmienne globalne" jest wyłączona.';
$string['check_google_details'] = '<p>Ustawienie "Otwórz dla Google" umożliwia silnikowi wyszukiwania Google wejść na kurs z wykorzystaniem konta gość. Nie ma sensu włączać tego ustawienia, jeżeli logowanie dla gości jest zabronione</p>';
$string['check_google_name'] = 'Otwórz dla Google';
$string['check_google_ok'] = 'Dostęp do modułu wyszukiwania nie jest aktywny.';
$string['check_guestrole_error'] = 'Rola gościa "{$a}" jest niepoprawnie zdefiniowana!';
$string['check_guestrole_name'] = 'Rola gościa';
$string['check_guestrole_notset'] = 'Rola gościa nie jest ustawiona.';
$string['check_guestrole_ok'] = 'Rola gościa jest zdefiniowana poprawnie.';
$string['check_mediafilterswf_details'] = '<p>Automatyczne umieszczanie/zagnieżdżanie plików swf jest bardzo niebezpieczne -  każdy zarejestrowany użytkownik może przypuścić atak typu XSS w stosunku do innych użytkowników serwera. Ta opcja powinna być wyłączona na serwerach/stronach komercyjnych.</p>';
$string['check_mediafilterswf_error'] = 'Filtr flash media  jest aktywny - to jest bardzo niebezpieczne dla większości serwerów.';
$string['check_mediafilterswf_name'] = 'Włącz filtr .swf';
$string['check_mediafilterswf_ok'] = 'Filtr flash media nie jest aktywny.';
$string['check_noauth_details'] = '<p>Moduł <em>"Brak uwierzytelniania"</em> nie jest przeznaczony dla stron komercyjnych. Proszę go wyłączyć, chyba że jest to deweloperska strona testowa.</p>';
$string['check_noauth_error'] = 'Moduł "Brak uwierzytelniania" nie może być na stronach komercyjnych.';
$string['check_noauth_name'] = 'Brak uwierzytelniania';
$string['check_noauth_ok'] = 'Moduł "Brak uwierzytelniania" jest wyłączony.';
$string['check_openprofiles_details'] = 'Otwarte profile użytkowników mogą być wykorzystywane przez spamerów. Zaleca się włączenie dwóch opcji <code>Zmuś użytkowników do logowania na profile</code> oraz <code>Zmuś użytkowników do  zalogowania się</code>.</p>';
$string['check_openprofiles_error'] = 'Każdy może przeglądać profile użytkowników bez logowania się.';
$string['check_openprofiles_name'] = 'Otwórz profile użytkownika';
$string['check_openprofiles_ok'] = 'Przed wyświetleniem profili użytkowników wymagane jest logowanie.';
$string['check_passwordpolicy_details'] = 'Jest zalecane, aby polityka haseł była ustawiona, ponieważ odgadnięcie hasła użytkownika jest najprostszym sposobem na uzyskanie nieautoryzowanego dostępu.
Nie należy nakładać zbyt rygorystycznych wymogów, ponieważ może to spowodować, iż użytkownicy nie będą w stanie zapamiętać swoich haseł i będą je zapisywać.';
$string['check_passwordpolicy_error'] = 'Zasady hasła nie są ustawione.';
$string['check_passwordpolicy_name'] = 'Zasada hasła';
$string['check_passwordpolicy_ok'] = 'Zasady hasła włączone.';
$string['check_riskadmin_detailsok'] = '<p>Proszę zweryfikować poniższą listę administratorów:</p>{$a}';
$string['check_riskadmin_name'] = 'Administratorzy';
$string['check_riskadmin_ok'] = 'Znaleziono {$a} administratorów serwera.';
$string['check_riskbackup_editoverride'] = '<a href="{$a->url}">{$a->name} w {$a->contextname}</a>';
$string['check_riskbackup_editrole'] = '<a href="{$a->url}">{$a->name}</a>';
$string['check_riskbackup_name'] = 'Backup danych użytkownika';
$string['check_riskbackup_unassign'] = '<a href="{$a->url}">{$a->fullname} ({$a->email}) w {$a->contextname}</a>';
$string['check_unsecuredataroot_details'] = '<p>Katalog główny (dataroot) nie może być dostępny z poziomu strony web. Najlepszym sposobem, aby upewnić się, że ten folder nie jest dostępny, jest użyć katalogu z poza publicznym miejscem na strony, tj. (inny niż: www czy httdoc)</p>
<p>Jeżeli przeniesiesz Katalog główny (dataroot), musisz zaktualizować ustawienie <code>$CFG->dataroot</code> w pliku config.php</p>';
$string['check_unsecuredataroot_error'] = 'Twój katalog główny (dataroot) <code>{$a}</code> jest w złej lokalizacji i jest dostępny z internetu!';
$string['check_unsecuredataroot_name'] = 'Niezabezpieczony główny folder danych';
$string['check_unsecuredataroot_ok'] = 'Katalog główny (dataroot) nie może być dostępny z internetu.';
$string['check_unsecuredataroot_warning'] = 'Twój katalog główny (dataroot) <code>{$a}</code> jest w złej lokalizacji i może być dostępny z internetu.';
$string['configuration'] = 'Konfiguracja';
$string['description'] = 'Opis';
$string['details'] = 'Szczegóły';
$string['issue'] = 'Pozycja';
$string['pluginname'] = 'Przegląd zabezpieczeń';
$string['security:view'] = 'Pokaż raport bezpieczeństwa';
$string['status'] = 'Status';
$string['statuscritical'] = 'Krytyczne';
$string['statusinfo'] = 'Informacje';
$string['statusok'] = 'OK';
$string['statusserious'] = 'Poważne';
$string['statuswarning'] = 'Ostrzeżenia';
$string['timewarning'] = 'Przetwarzanie danych może zająć dużo czasu, bądź cierpliwy...';
