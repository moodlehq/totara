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
 * Strings for component 'webservice', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   webservice
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessexception'] = 'Wyjątek w kontroli dostępu';
$string['actwebserviceshhdr'] = 'Aktywne protokoły usług sieciowych';
$string['addaservice'] = 'Dodaj usługę';
$string['addcapabilitytousers'] = 'Sprawdź możliwości użytkowników';
$string['addfunction'] = 'Dodaj funkcję';
$string['addfunctions'] = 'Dodaj funkcje';
$string['addservice'] = 'Dodaj nową usługę: {$a->name} (id: {$a->id})';
$string['addservicefunction'] = 'Dodaj funkcje do usługi "{$a}"';
$string['allusers'] = 'Wszyscy użytkownicy';
$string['arguments'] = 'Argumenty';
$string['authmethod'] = 'Metoda uwierzytelniania';
$string['checkusercapability'] = 'Sprawdź możliwości użytkownika';
$string['configwebserviceplugins'] = 'Ze względów bezpieczeństwa, tylko protokoły, które są używane, powinny być włączone.';
$string['context'] = 'Kontekst';
$string['createtoken'] = 'Utwórz token';
$string['createtokenforuser'] = 'Utwórz token dla użytkownika';
$string['createtokenforuserauto'] = 'Utwórz automatycznie token dla użytkownika';
$string['createtokenforuserdescription'] = 'Utwórz token dla użytkownika usługi sieciowej.';
$string['default'] = 'Domyślnie dla "{$a}"';
$string['deleteservice'] = 'Usuń usługę: {$a->name} (id: {$a->id})';
$string['deleteserviceconfirm'] = 'Usunięcie usługi spowoduje usunięcie powiązanych z nią tokenów. Czy na pewno chcesz usunąć zewnętrzną usługę "{$a}"?';
$string['deletetokenconfirm'] = 'Czy na pewno chcesz usunąć token usługi sieciowej użytkownikowi <strong>{$a->user}</strong>dla usługi <strong>{$a->service}</strong>?';
$string['disabledwarning'] = 'Wszystkie protokoły usług internetowych są wyłączone. "Włączenie Usług internetowych" jest możliwe w dziale: Zaawansowane funkcje.';
$string['doc'] = 'Dokumentacja';
$string['docaccessrefused'] = 'Nie masz uprawnień, aby zobaczyć dokumentacją dla tego tokenu';
$string['documentation'] = 'dokumentacja usług sieciowych';
$string['editaservice'] = 'Edytuj usługę';
$string['editservice'] = 'Edytuj usługę: {$a->name} (id: {$a->id})';
$string['enabled'] = 'Włączone';
$string['enabledocumentation'] = 'Włącz dokumentację deweloperską';
$string['enableprotocols'] = 'Włącz protokoły';
$string['enableprotocolsdescription'] = 'Co najmniej jeden protokół powinien być włączony. Ze względów bezpieczeństwa tylko protokoły, które mają być użyte, powinny być włączone.';
$string['enablews'] = 'Włącz usługi sieciowe';
$string['enablewsdescription'] = 'Usługi sieciowe muszą być włączone w dziale "Zaawansowane funkcje"';
$string['error'] = 'Błąd: {$a}';
$string['errorcodes'] = 'Błąd wiadomości';
$string['errorinvalidparam'] = 'Parametr "{$a}" jest nieprawidłowy.';
$string['execute'] = 'Wykonaj';
$string['executewarnign'] = 'UWAGA: Po naciśnięciu przycisku Wykonaj, bazy danych zostaną zmienione i zmiany nie będą mogły być przywrócone automatycznie!';
$string['externalservice'] = 'Usługi zewnętrzne';
$string['externalservicefunctions'] = 'Funkcje usługi zewnętrznej';
$string['externalservices'] = 'Usługi zewnętrzne';
$string['externalserviceusers'] = 'Użytkownicy usługi zewnętrznej';
$string['filenameexist'] = 'Nazwa pliku już istnieje: {$a}';
$string['function'] = 'Funkcja';
$string['functions'] = 'Funkcje';
$string['generalstructure'] = 'Ogólna struktura';
$string['information'] = 'Informacja';
$string['invalidiptoken'] = 'Nieprawidłowy token - twój IP nie jest obsługiwany';
$string['invalidtimedtoken'] = 'Nieprawidłowy token - token wygasł';
$string['invalidtoken'] = 'Nieprawidłowy token - token nieodnaleziony';
$string['iprestriction'] = 'Ograniczenia adresów IP';
$string['key'] = 'Klucz';
$string['manageprotocols'] = 'Zarządzaj protokołami';
$string['managetokens'] = 'Zarządzaj tokenami';
$string['missingpassword'] = 'Brak hasła';
$string['missingusername'] = 'Brak nazwy użytkownika';
$string['mobilewsdisabled'] = 'Wyłączone';
$string['mobilewsenabled'] = 'Włączone';
$string['nofunctions'] = 'Ta usługa ta nie ma funkcji.';
$string['notoken'] = 'Lista tokenów jest pusta.';
$string['operation'] = 'Operacja';
$string['optional'] = 'Opcjonalny(e)';
$string['passwordisexpired'] = 'Hasło wygasło.';
$string['phpparam'] = 'XML-RPC (struktura PHP)';
$string['phpresponse'] = 'XML-RPC (struktura PHP)';
$string['potusers'] = 'Nieautoryzowani użytkownicy';
$string['print'] = 'Drukuj wszystko';
$string['protocol'] = 'Protokół';
$string['removefunction'] = 'Usuń';
$string['removefunctionconfirm'] = 'Czy na pewno chcesz usunąć funkcję "{$a->function}" z usługi "{$a->service}"?';
$string['required'] = 'Wymagane';
$string['response'] = 'Odpowiedź';
$string['restrictedusers'] = 'Tylko uwierzytelnieni użytkownicy';
$string['securitykeys'] = 'Klucze zabezpieczeń';
$string['selectauthorisedusers'] = 'Wybierz uwierzytelnionych użytkowników';
$string['selectservice'] = 'Wybierz usługę';
$string['service'] = 'Usługa';
$string['servicehelpexplanation'] = 'Usługa jest zbiorem funkcji. Usługa może być dostępna dla wszystkich użytkowników lub tylko dla określonych.';
$string['servicename'] = 'Nazwa usługi';
$string['serviceusersettings'] = 'Ustawienia użytkownika';
$string['step'] = 'Krok';
$string['testwithtestclient'] = 'Test usługi';
$string['token'] = 'Token';
$string['tokenauthlog'] = 'Token uwierzytelniania';
$string['tokencreator'] = 'Twórca';
$string['updateusersettings'] = 'Aktualizuj';
$string['userasclients'] = 'Użytkownicy, jako klienci z tokenem';
$string['usernameorid'] = 'Nazwa użytkownika / identyfikator';
$string['usernameorid_help'] = 'Wprowadź nazwę użytkownika lub identyfikator.';
$string['usernameoridnousererror'] = 'Nie znaleziono użytkowników o zadanej nazwie / identyfikatorze.';
$string['usernameoridoccurenceerror'] = 'Znaleziono więcej niż jednego użytkownika o zadanej nazwie. Proszę wprowadzić jego  identyfikator.';
$string['usersettingssaved'] = 'Ustawienia użytkownika zostały zapisane';
$string['validuntil'] = 'Ważne do';
$string['validuntil_help'] = 'Jeśli jest ustawione, usługa będzie dezaktywowana po tej dacie dla tego użytkownika.';
$string['webservice'] = 'Usługa sieciowa';
$string['webservices'] = 'Usługi sieciowe';
$string['webservicesoverview'] = 'Przegląd';
$string['webservicetokens'] = 'Tokeny usług sieciowych';
$string['wrongusernamepassword'] = 'Nieprawidłowy login lub hasło';
$string['wsauthmissing'] = 'Brakuje modułu uwierzytelniania usługi sieciowej.';
$string['wsauthnotenabled'] = 'Moduł uwierzytelniania usługi sieciowej jest wyłączony.';
$string['wsdocapi'] = 'Dokumentacja API';
$string['wsdocumentationdisable'] = 'Dokumentacja usług sieciowych jest wyłączona.';
$string['wsdocumentationintro'] = 'Przed utworzeniem klienta, radzimy przeczytać {$a->doclink}';
$string['wspassword'] = 'Hasło usługi sieciowej';
$string['wsusername'] = 'Użytkownik usługi sieciowej';
