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
 * Strings for component 'enrol_authorize', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_authorize
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminacceptccs'] = 'Który typ karty kredytowej będzie akceptowany?';
$string['adminauthorizewide'] = 'Ustawienia główne';
$string['admincronsetup'] = 'Skrypt zarządzania cron.php nie został uruchomiony przez ostatnie 24 godziny. <br />Cron musi być ustawiony jeśli chcesz używać właściwości autoprzechwytywania. <br />Jeśli wyłączysz funkcję autoprzechwytywania, transakcje będą unieważnianie chyba że przeglądniesz je w ciągu 30 dni. <br />Sprawdź an_review i wprowadź zero w pole an_capture_day <br /> jeśli chcesz ręcznie akceptować/odrzucać płatności w ciągu 30 dni.';
$string['anlogin'] = 'Nazwa użytkownika';
$string['anpassword'] = 'Hasło';
$string['anreferer'] = 'Zdefiniuj URL polecający (URL Referer), jeśli masz to ustawione w twoim koncie authorize.net.  Spowoduje to wysyłanie linii "Referer: URL" razem z żądaniem HTTP.';
$string['antestmode'] = 'Uruchom testową transakcję (pieniądze nie będą pobrane)';
$string['antrankey'] = 'Klucz transakcji';
$string['authcode'] = 'Kod autoryzacji';
$string['authorize:manage'] = 'Zarządzaj zapisanymi użytkownikami';
$string['authorize:managepayments'] = 'Zarządzaj płatnościami';
$string['authorize:unenrol'] = 'Wypisz użytkowników z kursu';
$string['authorize:unenrolself'] = 'Wypisz się z kursu';
$string['authorize:uploadcsv'] = 'Prześlij plik CSV';
$string['cancelled'] = 'Anulowano';
$string['cccity'] = 'Miasto';
$string['ccexpire'] = 'Data ważności';
$string['ccexpired'] = 'Data ważności karty kredytowej';
$string['ccinvalid'] = 'Niepoprawny numer karty';
$string['ccno'] = 'Numer karty kredytowej';
$string['cctype'] = 'Typ karty kredytowej';
$string['ccvv'] = 'Sprawdzenie karty';
$string['ccvvhelp'] = 'Sprawdź 3 ostatnie cyfry na odwrocie Twojej karty';
$string['choosemethod'] = 'Jeżeli znasz kurs dostępu do kursu to wprowadź go, w przeciwnym wypadku musisz zapłacić za ten kurs.';
$string['chooseone'] = 'Wypełnij jedno lub oba z następnych pól';
$string['currency'] = 'Waluta';
$string['delete'] = 'Usuń';
$string['description'] = 'Authorize.net moduł pozwala ustwawiać zapłatę za kurs przez dostawcę CC. Jeżeli koszt jakiegoś kursu jest zero to studenci nie są wzywani do zapłaty za wejście. Tutaj jest koszt wejścia na strony ustawiony jako domyślny, można ustawić koszt wejścia na każdy kurs w ustawieniach kursu. Koszt kursu unieważnia koszt strony.';
$string['echeckaccnum'] = 'Numer konta bankowego';
$string['echeckacctype'] = 'Typ rachunku bankowego';
$string['echeckbankname'] = 'Nazwa banku';
$string['echeckfirslasttname'] = 'Właściciel konta bankowego';
$string['enrolenddate'] = 'Data końcowa';
$string['enrolname'] = 'Karta Kredytowa brama';
$string['enrolstartdate'] = 'Data początkowa';
$string['expired'] = 'Wygasła';
$string['expiremonth'] = 'Miesiąc ważności';
$string['expireyear'] = 'Rok ważności';
$string['firstnameoncard'] = 'Imię na karcie';
$string['haveauthcode'] = 'Mam już kod autoryzacji';
$string['howmuch'] = 'Ile?';
$string['httpsrequired'] = 'Z przykrością stwierdzamy, iż Twoja sugestia nie może być przeprowadzona prawidłowo. To ustawienie strony nie może być przeprowadzone poprawnie.
<br /><br />
Proszę nie wprowadzać numeru swojej karty kredytowej do czasu pojawienia się żółtej kłódki na dole przeglądarki. Oznacza to, iż wszelkie dane przesyłane pomiędzy klientem a serwerem będą kodowane. A więc informacja przesyłana podczas transakcji pomiędzy dwoma komputerami jest chroniona  a numer Twojej karty kredytowej nie zostanie ujawniony w internecie';
$string['invalidaba'] = 'Niepoprawny numer ABA';
$string['invalidaccnum'] = 'Niepoprawny numer konta';
$string['invalidacctype'] = 'Nieprawidłowy typ konta';
$string['lastnameoncard'] = 'Nazwisko na karcie';
$string['logindesc'] = 'Możesz ustawić opcje <a href="{$a->url}">loginhttps</a> w zmienne/ bezpieczeństwo.
Włączając to Moodle będzi używał połączenia z użyciem protokołu https dla stron ogowania i zapłaty.';
$string['methodcc'] = 'Karta kredytowa';
$string['missingaba'] = 'Brakuje numeru ABA';
$string['missingaddress'] = 'Brakuje adresu';
$string['missingbankname'] = 'Brakuje nazwy banku';
$string['missingcc'] = 'Brakuje numeru karty';
$string['missingccauthcode'] = 'Brak kodu autoryzacji';
$string['missingccexpiremonth'] = 'Brak miesiąca ważności';
$string['missingccexpireyear'] = 'Brak roku ważności';
$string['missingcctype'] = 'Brak typu karty';
$string['missingcvv'] = 'Brak numeru weryfikacji';
$string['missingzip'] = 'Brakuje kodu pocztowego';
$string['mypaymentsonly'] = 'Pokaż tylko moje płatności';
$string['nameoncard'] = 'Nazwa karty';
$string['new'] = 'Nowy';
$string['orderdetails'] = 'Szczegóły zamówienia';
$string['paymentmanagement'] = 'Zarządzanie płatnościami';
$string['paymentmethod'] = 'Sposób płatności';
$string['paymentpending'] = 'Twoja płatność jest w trakcie oczekiwania dla Twojego kursu z poniższym numerem porządkowym. {$a->orderid}';
$string['reviewnotify'] = 'Twoja płatność będzie zweryfikowana w ciągu kilku dni oczekuj e-maila od swojego nauczyciela';
$string['sendpaymentbutton'] = 'Wyślij zapłatę';
$string['tested'] = 'Sprawdzony';
$string['transid'] = 'Numer transakcji';
$string['unenrolselfconfirm'] = 'Czy na pewno chcesz wypisać się z kursu "{$a}"?';
$string['unenrolstudent'] = 'Wypisać studentów?';
$string['uploadcsv'] = 'Załaduj plik CSV';
$string['usingccmethod'] = 'Zapisy wykorzystujące <a href="{$a->url}"><strong>kartę kredytową</strong></a>';
$string['usingecheckmethod'] = 'Zapisy wykorzystujące <a href="{$a->url}"><strong>eCheck</strong></a>';
$string['verifyaccountresult'] = '<b>Wynik weryfikacji:</b> {$a}';
$string['voidyes'] = 'Transakcja zostanie anulowana. Czy jesteś pewien(a)?';
$string['welcometocoursesemail'] = 'Szanowny {$a->name},

Dziękujemy za wykonanie płatności. Zostałeś zapisany na następujące kursy:

{$a->courses}

Możesz zobaczyć szczegół swojej płatności lub edytować swój profil:
{$a->paymenturl}
{$a->profileurl}';
$string['zipcode'] = 'kod pocztowy';
