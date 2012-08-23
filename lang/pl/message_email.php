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
 * Strings for component 'message_email', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   message_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowusermailcharset'] = 'Zezwalaj użytkownikom na dobór kodowania znaków';
$string['configallowusermailcharset'] = 'Włączając tą opcję zezwolisz użytkownikom na wybór własnej strony kodowej dla email-i';
$string['confignoreplyaddress'] = 'Emaile są czasami wysyłane w imieniu użytkownika (na przykład w obszarze forum). Adres e-mail który tutaj wpiszesz będzie używany jako adres "Wyjścia" w przypadkach gdy odbiorca nie powinien posiadać możliwości bezpośredniej odpowiedzi na konto użytkownika (na przykład gdy użytkownik wybierze opcję prywatności swojego adresu)';
$string['configsitemailcharset'] = 'Wszystkie e-maile wysyłane z tej strony będą kodowane w sposób zdefiniowany tutaj. Ale każdy użytkownik będzie mógł dostosować to jeżeli uaktywni się następne pole.';
$string['configsmtphosts'] = 'Nadaj pełną nazwę jednemu lub większej ilości lokalnych serwerów SMTP, które będą używane przez Moodle do wysłania maili (np. \'mail.a.com\' or \'mail.a.com;mail.b.com\'). Jeśli pozostawisz to miejsce pustym Moodle będzie używać domyślnej metody PHP do wysyłania maili';
$string['configsmtpmaxbulk'] = 'Maksymalna liczba wiadomości wysyłanych przez sesję SMTP. Grupowanie wiadomości może przyspieszyć wysyłanie wiadomości email. Wartość poniżej 2 wymusi tworzenie nowej sesji SMTP dla każdego email-a.';
$string['configsmtpuser'] = 'Jeśli ustawiłeś serwer SMTP powyżej i serwer wymaga uwierzytelnienia, wpisz tutaj nazwę konta i hasło.';
$string['email'] = 'Wyślij powiadomienia e-mail do';
$string['mailnewline'] = 'Nowa linia znaków w mail-u';
$string['noreplyaddress'] = 'Adres no-reply';
$string['pluginname'] = 'E-mail';
$string['sitemailcharset'] = 'Zbiór znaków';
$string['smtphosts'] = 'Nazwa serwera SMTP';
$string['smtpmaxbulk'] = 'limit sesji SMTP';
$string['smtppass'] = 'Hasło SMTP';
$string['smtpuser'] = 'Nazwa użytkownika SMTP';
