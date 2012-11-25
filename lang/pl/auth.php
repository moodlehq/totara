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
 * Strings for component 'auth', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   auth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actauthhdr'] = 'Dostępne wtyczki autoryzacji';
$string['alternatelogin'] = 'Jeżeli wprowadzisz tutaj adres URL, to będzie używany jako strona logowania do tego serwisu. Strona powinna zawierać formularz o właściwości action ustawionej na <strong>\'{$a}\'</strong> i zwracać pola <strong>username</strong> i <strong>password</strong>.<br />Bądź ostrożny nie wprowadzaj niepoprawnego URL bo możesz zablokować sobie wejście do tej strony.<br />Pozostaw pole puste żeby używać domyślnej strony logowania.';
$string['alternateloginurl'] = 'Alternatywny adres URL strony logowania';
$string['auth_changepasswordhelp'] = 'Zmień help nt. hasła';
$string['auth_changepasswordhelp_expl'] = '***Wyświetl help nt. straconego hasła użytkownikom, którzy stracili swoje {$a} hasło. To będzie wyświetlone wraz z, lub zamiast <strong>URL Zmiany Hasła</strong> lub zmianą hasła Internal Moodle ***';
$string['auth_changepasswordurl'] = '***URL zmiany hasła***';
$string['auth_changepasswordurl_expl'] = 'Określ url do przesłania użytkownikom, którzy stracili swoje {$a} hasło. Ustaw <strong>Użyj standardowej strony Zmiany Hasła</strong> na <strong>Nie</strong>.';
$string['auth_changingemailaddress'] = 'Zażądano zamiany adresu e-mail z {$a->oldemail} na {$a->newemail}. Ze względów bezpieczeństwa wysłaliśmy do Ciebie wiadomość pocztową na nowy adres, aby upewnić się, że należy on do Ciebie. Twój adres zostanie zaktualizowany jak tylko klikniesz link przesłany w wiadomości.';
$string['auth_common_settings'] = 'Ustawienia wspólne';
$string['auth_data_mapping'] = 'Mapuj dane';
$string['auth_fieldlock'] = 'Zablokowane wartość';
$string['auth_fieldlock_expl'] = '<p><b>Zablokowana wartość:</b>Jeżeli włączona, to będzie zapobiegać użytkownikom Moodla i administratorom edycje bespośrednio tego pola. Używaj tej opcji jeżeli zachowujecsz te dane w zewnętrznym systemie autoryzacji.';
$string['auth_fieldlocks'] = 'Zablokuj dane użytkownika';
$string['auth_fieldlocks_help'] = 'Możesz zablokować pola z danymi użytkownika. Jest to użyteczne, gdy dane są utrzymywane ręcznie przez administratora przez edycje profilu użytkownika lub uaktualniane/przesyłane przez użycie funkcjonalności "prześlij użytkowników". Jeżeli zablokujesz pola wymagane przez Moodle, upewnij się że dostarczasz tych danych podczas tworzenia konta użytkownika ; albo konta będą nie zdatne do użytku.
Uważaj ustawiając blokady, \'zablokowanie pustych\' może powodować problemy.';
$string['auth_invalidnewemailkey'] = 'Błąd: jeśli próbujesz potwierdzić zmianę adresu e-mail, mogłeś popełnić błąd podczas kopiowania adresu URL, który wysłaliśmy mailem. Proszę skopiować adres i spróbować ponownie.';
$string['auth_multiplehosts'] = 'Można wskazać więcej komputerów-hostów np. host1.com; host2.com; host3.com';
$string['auth_outofnewemailupdateattempts'] = 'Wykorzystałeś dozwoloną liczbę prób aktualizacji twojego adresu e-mail. Twoje żądanie aktualizacji zostało anulowane.';
$string['auth_passwordisexpired'] = 'Twoje hasło traci ważność. Chcesz teraz zmienić hasło?';
$string['auth_passwordwillexpire'] = 'Twoje hasło traci ważność za {$a} dni. Chcesz teraz zmienić hasło?';
$string['auth_remove_delete'] = 'Pełne usuwanie wewnętrzne';
$string['auth_remove_keep'] = 'Zachowaj wewnętrzne';
$string['auth_remove_suspend'] = 'Zawieś wewnętrzne';
$string['auth_remove_user'] = 'Określ, co robić z kontem użytkownika wewnętrznego podczas masowej synchronizacji, gdy użytkownik został usunięty ze źródła zewnętrznego. Tylko zawieszeni użytkownicy zostaną automatycznie sprawdzeni, gdy pojawią się oni ponownie w źródle zewnętrznym.';
$string['auth_remove_user_key'] = 'Usunięty użytkownik zewnętrzny';
$string['auth_sync_script'] = 'Skrypt synchronizacji Crona';
$string['auth_updatelocal'] = 'Lokalne uaktualnienie.';
$string['auth_updatelocal_expl'] = '<p><b>Lokalne uaktualnienie:</b> Jeśli zostanie włączone, pole będzie się uaktualniać (z wejścia zewnętrznego) za każdym razem, kiedy użytkownik się zaloguje albo kiedy się synchronizuje. Pola wybrane do uaktualnień lokalnych powinny być zamknięte.';
$string['auth_updateremote'] = 'Uaktualnienie zewnętrzne';
$string['auth_updateremote_expl'] = '<p><b>Uaktualnienie zewnętrzne: </b>Jeśli zostanie włączone, autoryzacja zewnętrzna będzie uaktualniania kiedy uaktualnia się konto użytkownika. Aby to umożliwić, pola powinny być otwarte.';
$string['auth_updateremote_ldap'] = '<p><b>Uwaga: </b>uaktualnienie zewnetrznętrznych danych LDAP wymaga, byś przypisał binddn I bindpw do użytkownika bind, który ma przywileje poprawiania kont użytkowników. Na razie nie zachowuje atrybutów wielowartościowych i podczas uaktualnienia będzie usuwał dodatkowe wartości </p>';
$string['auth_user_create'] = 'Włącz opcję tworzenia użytkowników';
$string['auth_user_creation'] = 'Nowi (anonimowi) użytkownicy mogą tworzyć konta użytkownika używając zewnętrznego źródła uwierzytelniania z potwierdzeniem pocztą elektroniczną. Jeżeli włączysz tę opcję, pamiętaj również o skonfigurowaniu związanych z modułami opcji tworzenia użytkowników.';
$string['auth_usernameexists'] = 'Wybrana nazwa użytkownika już istnieje - proszę wybrać inną.';
$string['authenticationoptions'] = 'Opcje uwierzytelniania';
$string['authinstructions'] = 'Możesz tutaj wprowadzić instrukcje dla Twoich użytkowników dotyczące nazwy użytkownika i hasła, których powinni używać. Tekst wpisany w tym miejscu pojawi się na stronie logowania. Jeżeli nic nie wpiszesz, nie zostaną wyświetlone żadne instrukcje.';
$string['auto_add_remote_users'] = 'Automatycznie dodawaj zdalnych użytkowników';
$string['changepassword'] = 'Adres URL gdzie można zmiany hasła';
$string['changepasswordhelp'] = 'Możesz tutaj określić miejsce, w którym Twoi użytkownicy mogą odzyskać lub zmienić swoja nazwę użytkownika/hasło, jeżeli ich zapomną. Wybranie tej opcji spowoduje wyświetlenie przycisku na stronie logowania i stronach użytkownika. Jeżeli nic nie wpiszesz, przycisk nie zostanie wyświetlony.';
$string['chooseauthmethod'] = 'Wybierz sposób uwierzytelniania';
$string['chooseauthmethod_help'] = 'Menu pozwala zmienić metodę uwierzytelniania dla danego użytkownika
Bądź świadomy że te ustawienia wpływają na metodę uwierzytelniania.
Nieprawidłowa zmiana mogłaby uniemożliwić rejestracje w systemi. Używaj to jeżeli wiesz dobrze co robisz';
$string['createpasswordifneeded'] = 'Utwórz hasło jeśli potrzebne';
$string['emailchangecancel'] = 'Porzuć zmianę adresu e-mail';
$string['emailchangepending'] = 'Zmiany w toku. Otwórz link wysłany do Ciebie {$a->preference_newemail}.';
$string['emailupdate'] = 'Aktualizacja adresu e-mail';
$string['emailupdatemessage'] = 'Witaj {$a->fullname},

Zażądano zmiany Twojego adresu e-mail w Twoim koncie na {$a->site}. Otwórz poniższy link aby potwierdzić tą zmianę.

{$a->url}';
$string['emailupdatesuccess'] = 'Adres użytkownika <em>{$a->fullname}</em> został pomyślnie zaktualizowany <em>{$a->email}</em>.';
$string['emailupdatetitle'] = 'Potwierdzenie aktualizacji adresu e-mail na {$a->site}';
$string['enterthenumbersyouhear'] = 'Wpisz usłyszane numery';
$string['enterthewordsabove'] = 'Wpisz słowa powyżej';
$string['errormaxconsecutiveidentchars'] = 'Hasło musi mieć co najwyżej {$a} kolejnych, identycznych znaków.';
$string['errorminpassworddigits'] = 'Hasło musi zawierać co najmniej {$a} cyfr.';
$string['errorminpasswordlength'] = 'Hasło musi mieć długość co najmniej {$a} znaków.';
$string['errorminpasswordlower'] = 'Hasło musi zawierać co najmniej {$a} małych liter.';
$string['errorminpasswordnonalphanum'] = 'Hasło musi zawierać co najmniej {$a} znaków niealfanumerycznych.';
$string['errorminpasswordupper'] = 'Hasło musi zawierać co najmniej {$a} dużych liter.';
$string['errorpasswordupdate'] = 'Błąd przy zmianie hasła. Hasło nie zostało zmienione.';
$string['forcechangepassword'] = 'Wymuś zmianę hasła';
$string['forcechangepassword_help'] = 'Wymuś zmianę hasła przy następnym logowaniu do systemu Moodle.';
$string['forcechangepasswordfirst_help'] = 'Wymuś zmianę hasła przy pierwszym logowaniu do systemu Moodle.';
$string['forgottenpassword'] = 'W przypadku podania tutaj adresu URL zostanie on użyty jako strona odtwarzania utraconego hasła dla tej witryny. Jest to przeznaczone dla witryn, gdzie hasła są obsługiwane całkowicie poza produktem Moodle. Pozostaw to pole puste, aby użyć domyślnego odzyskiwania hasła.';
$string['forgottenpasswordurl'] = 'URL zapomnianego hasła';
$string['getanaudiocaptcha'] = 'Pobierz dźwiękowe CAPTCHA';
$string['getanimagecaptcha'] = 'Pobierz obraz CAPTCHA';
$string['getanothercaptcha'] = 'Wygeneruj inne CAPTCHA';
$string['guestloginbutton'] = 'Przycisk logowania jako gość';
$string['incorrectpleasetryagain'] = 'Niewłaściwe. Spróbuj jeszcze raz.';
$string['infilefield'] = 'Pole wymagane w pliku';
$string['informminpassworddigits'] = 'liczb co najmniej: {$a}';
$string['informminpasswordlength'] = 'znaków co najmniej: {$a}';
$string['informminpasswordlower'] = 'małych liter co najmniej: {$a}';
$string['informminpasswordnonalphanum'] = 'niestandardowych znaków co najmniej: {$a}';
$string['informminpasswordupper'] = 'dużych liter co najmniej: {$a}';
$string['informpasswordpolicy'] = 'Hasło musi mieć {$a}';
$string['instructions'] = 'Instrukcje';
$string['internal'] = 'Wewnętrzny';
$string['locked'] = 'Zablokowano';
$string['md5'] = 'Kodowanie MD5';
$string['nopasswordchange'] = 'Hasło nie może być zmienione.';
$string['nopasswordchangeforced'] = 'Nie możesz kontynuować bez zmiany hasła, jakkolwiek nie ma dostępnej strony do tej zmiany. Proszę skontaktować się z Administratorem Moodla.';
$string['noprofileedit'] = 'Profil nie może być  edytowany';
$string['ntlmsso_attempting'] = 'Trwa próba SSO za pomocą NTLM...';
$string['ntlmsso_failed'] = 'Automatyczne logowanie nie powiodło się, użyj tradycyjnej strony logowania ...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO jest wyłączone.';
$string['passwordhandling'] = 'Obsługa pola hasła';
$string['plaintext'] = 'Zwykły tekst';
$string['pluginnotenabled'] = 'Moduł uwierzytelniania {$a}\' nie jest włączony.';
$string['pluginnotinstalled'] = 'Moduł uwierzytelniania {$a}\' nie jest zainstalowany.';
$string['potentialidps'] = 'Zaloguj się używając swojego konta na:';
$string['recaptcha'] = 'reCAPTCHA';
$string['recaptcha_help'] = 'CAPTCHA jest zabezpieczeniem zapobiegającym nadużyciom ze strony automatycznych programów. Wystarczy wpisać słowa w polu, w podanej kolejności i oddzielone spacją.
Jeśli słowo jest nieczytelne, można spróbować pobrać kolejne słowo CAPTCHA lub wygenerować dźwiękowe CAPTCHA.';
$string['selfregistration'] = 'Samodzielna rejestracja';
$string['selfregistration_help'] = 'W przypadku wybrania wtyczki uwierzytelniania, takiej jak samodzielna rejestracja oparta na wiadomości e-mail, umożliwia ona potencjalnym użytkownikom zarejestrowanie się i utworzenie kont. Daje to spamerom możliwość utworzenia kont w celu wykorzystania do spamowania wątków na forum, wpisów blogów itd. W celu uniknięcia tego zagrożenia należy wyłączyć lub ograniczyć samodzielną rejestrację za pomocą ustawienia *Dozwolone domeny e-mail*.';
$string['sha1'] = 'Algorytm SHA-1';
$string['showguestlogin'] = 'Możesz ukryć bądź pokazać przycisk logowania jako gość';
$string['stdchangepassword'] = 'Użyj standardowej strony zmiany hasła';
$string['stdchangepassword_expl'] = 'Jeśli zewnętrzny system potwierdzający umożliwia zmiany hasła poprzez Moodle, ustaw to na TAK. To ustawienie nadpisuje „Zmień Hasło URL”';
$string['stdchangepassword_explldap'] = 'UWAGA: zaleca się, aby używać LDAP na tunelu kodowanym SSL (ldaps://), jeśli serwer LDAP jest zdalny.';
$string['suspended'] = 'Zawieszone konto';
$string['suspended_help'] = 'Zawieszony użytkownik nie może się logować lub korzystać z usług internetowych, a wszelkie wiadomości wychodzące są odrzucane.';
$string['unlocked'] = 'Odblokuj';
$string['unlockedifempty'] = 'Odblokuj jeżeli puste';
$string['update_never'] = 'Nigdy';
$string['update_oncreate'] = 'Po utworzeniu';
$string['update_onlogin'] = 'Po każdym logowaniu';
$string['update_onupdate'] = 'Po uaktualnieniu';
