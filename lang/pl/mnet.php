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
 * Strings for component 'mnet', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['RPC_HTTPS_SELF_SIGNED'] = 'HTTPS (podpis własny)';
$string['RPC_HTTPS_VERIFIED'] = 'HTTPS (podpisane)';
$string['RPC_HTTP_PLAINTEXT'] = 'HTTP niezaszyfrowane';
$string['RPC_HTTP_SELF_SIGNED'] = 'HTTP (podpis własny)';
$string['RPC_HTTP_VERIFIED'] = 'HTTP (podpisane)';
$string['aboutyourhost'] = 'O twoim serwerze';
$string['accesslevel'] = 'Poziom dostępu';
$string['addhost'] = 'Dodaj hosta';
$string['addnewhost'] = 'Dodaj nowego hosta';
$string['addtoacl'] = 'Dodaj do kontroli dostępu';
$string['allhosts_no_options'] = 'Podczas przeglądania wielu hostów nie są dostępne żadne opcje';
$string['allow'] = 'Zezwalaj';
$string['authfail_nosessionexists'] = 'Niepowodzenie autoryzacji: sesja mnet nie istnieje.';
$string['authfail_sessiontimedout'] = 'Niepowodzenie autoryzacji: upłynął limit czasu sesji mnet.';
$string['authfail_usermismatch'] = 'Niepowodzenie autoryzacji: niezgodność użytkownika.';
$string['authmnetdisabled'] = 'Wtyczka autoryzacji MNet jest <strong>wyłączona</strong>.';
$string['badcert'] = 'To nie jest poprawny certyfikat.';
$string['couldnotgetcert'] = 'Nie znaleziono certyfikatu w <br />{$a}. <br />Host może być nieczynny lub niepoprawnie skonfigurowany.';
$string['couldnotmatchcert'] = 'To nie jest zgodne z certyfikatem aktualnie publikowanym przez serwer internetowy.';
$string['courses'] = 'kursy';
$string['courseson'] = 'kursy o';
$string['current_transport'] = 'Bieżący transport';
$string['currentkey'] = 'Bieżący klucz publiczny';
$string['databaseerror'] = 'Nie można zapisać szczegółów do bazy danych.';
$string['deleteaserver'] = 'Usuwanie serwera';
$string['deletehost'] = 'Usuń host';
$string['deletekeycheck'] = 'Czy masz absolutną pewność, że chcesz usunąć ten klucz?';
$string['deleteoutoftime'] = '60-sekundowe okno na usunięcie tego klucza wygasło. Zacznij od nowa.';
$string['deleteuserrecord'] = 'SSO ACL: usuń rekord dla użytkownika \'{$a->user}\' z {$a->host}.';
$string['deletewrongkeyvalue'] = 'Wystąpił błąd. Jeśli nie była podejmowana próba usunięcia klucza SSL serwera, być może jesteś przedmiotem złośliwego ataku. Nie podjęto żadnych działań.';
$string['deny'] = 'Odmów';
$string['description'] = 'Opis';
$string['duplicate_usernames'] = 'Nie powiodło się tworzenie indeksu dla kolumn "mnethostid" i "username" w tabeli użytkownika.<br />Może to nastąpić, gdy istnieją <a href="{$a}" target="_blank">zduplikowane nazwy użytkownika w tabeli użytkowników</a>.<br />Aktualizacja powinna pomimo to zakończyć się pomyślnie. Kliknij powyższe łącze, a w nowym oknie zostaną wyświetlone instrukcje usuwania tego problemu. Możesz z nich skorzystać na koniec aktualizacji.<br />';
$string['enabled_for_all'] = '(Ta usługa została włączona dla wszystkich hostów.)';
$string['enterausername'] = 'Wprowadź nazwę użytkownika lub listę użytkowników rozdzielaną przecinkami.';
$string['error7020'] = 'Ten błąd zazwyczaj występuje, gdy witryna zdalna utworzyła rekord dla użytkownika z niepoprawną wartością wwwroot, na przykład http://twojawitryna.com zamiast http://www.twojawitryna.com. Skontaktuj się z administratorem zdalnej witryny i podaj mu wartość wwwroot (określoną w plik config.php), prosząc o aktualizację zdalnego rekordu dla Twojego hosta.';
$string['error7022'] = 'Wiadomość wysłana do zdalnej witryna była poprawnie zaszyfrowana, ale nie była podpisana. Jest to bardzo nieoczekiwane, należy więc prawdopodobnie zgłosić błąd, jeśli wystąpi (podając jak najwięcej informacji o wersjach produktu Moodle, których to dotyczy, itd.';
$string['error7023'] = 'Zdalna witryna próbowała odszyfrować wiadomość za pomocą wszystkich kluczy zarejestrowanych dla tej witryny. Żaden nie pasował. Możesz usunąć ten problem, ręcznie podając klucz witrynie zdalnej. Najprawdopodobniej to nie wystąpi, chyba że komunikacja ze zdalną witryną nie była nawiązywana przez kilka miesięcy.';
$string['error7024'] = 'Do witryny zdalnej została wysłana niezaszyfrowana wiadomość, ale witryna zdalna nie akceptuje niezaszyfrowanych wiadomości z tej witryny. Jest to bardzo nieoczekiwane, należy więc prawdopodobnie zgłosić błąd, jeśli wystąpi (podając jak najwięcej informacji o wersjach produktu Moodle, których to dotyczy, itd.';
$string['error7026'] = 'Klucz, którym została podpisana wiadomość, różni się od klucza, który zdalny host ma dla tego serwera. Ponadto zdalny host próbował pobrać bieżący klucz, ale skończyło się to niepowodzeniem. Ręcznie przekaż klucz do zdalnego hosta i ponów próbę.';
$string['error709'] = 'Witryna zdalna nie może uzyskać od tej witryny klucza SSL.';
$string['expired'] = 'Ten klucz straił ważność w dniu';
$string['expires'] = 'Ważny do';
$string['expireyourkey'] = 'Usuń ten klucz';
$string['expireyourkeyexplain'] = 'Produkt Moodle dokonuje automatycznej rotacji kluczy co 28 dni (domyślnie), ale istnieje opcja <em>ręcznego</em> unieważnienia klucza w dowolnej chwili. Przydaje się to tylko, gdy można sądzić, że klucz przestał być bezpieczny. Zamiennik zostanie natychmiast wygenerowany automatycznie.<br />Usunięcie tego klucza uniemożliwi innym witrynom Moodles komunikację z tą witryną dopóki nie skontaktujesz się ręcznie z każdym administratorem i nie podasz nowego klucza.';
$string['exportfields'] = 'Pola do eksportu';
$string['failedaclwrite'] = 'Nie można dokonać zapisu na listę kontroli dostępu MNET dla użytkownika \'{$a}\'.';
$string['findlogin'] = 'Znajdź logowanie';
$string['forbidden-function'] = 'Ta funkcja nie została włączona dla RPC.';
$string['forbidden-transport'] = 'Metoda transportu, której próbujesz użyć, jest niedozwolona.';
$string['forcesavechanges'] = 'Wymuszaj zapis zmian';
$string['helpnetworksettings'] = 'Konfiguruj komunikację między witrynami Moodle';
$string['hidelocal'] = 'Ukryj lokalnych użytkowników';
$string['hideremote'] = 'Ukryj zdalnych użytkowników';
$string['host'] = 'host';
$string['hostcoursenotfound'] = 'Nie znaleziono hosta lub kursu';
$string['hostdeleted'] = 'OK – usunięto host';
$string['hostexists'] = 'Istnieje już rekord dla tego hosta i wdrożenia produktu Moodle z ID {$a}.<br />Kliknij przycisk <em>Kontynuuj</em>, aby eytować ten rekord.';
$string['hostname'] = 'Nazwa hosta';
$string['hostnamehelp'] = 'W pełni kwalifikowana nazwa domeny hosta zdalnego, np. www.przyklad.com';
$string['hostnotconfiguredforsso'] = 'Ten serwer nie jest skonfigurowany dla zdalnego logowania.';
$string['hostsettings'] = 'Ustawienia hosta';
$string['http_self_signed_help'] = 'Zezwalaj na połączenia z użyciem samodzielnie podpisanego certyfikatu DIY SSL na hoście zdalnym.';
$string['http_verified_help'] = 'Zezwalaj na połączenia z użyciem zweryfikowanego certyfikatu SSL w PHP na hoście zdalnym, ale przez protokół http (nie https).';
$string['https_self_signed_help'] = 'Zezwalaj na połączenia z użyciem samodzielnie podpisanego certyfikatu DYI SSL w PHP na hoście zdalnym przez protokół http.';
$string['https_verified_help'] = 'Zezwalaj na połączenia z użyciem zwewryfikowanego certyfikatu SSL na hoście zdalnym.';
$string['id'] = 'ID';
$string['idhelp'] = 'Ta wartość jest przypisywana automatycznie i nie można jej zmienić';
$string['invalidaccessparam'] = 'Niepoprawny parametr dostępu.';
$string['invalidactionparam'] = 'Niepoprawny parametr czynności.';
$string['invalidhost'] = 'Musisz podać poprawny identyfikator hosta';
$string['invalidpubkey'] = 'Ten klucz nie jest poprawnym kluczem SSL.';
$string['invalidurl'] = 'Niepoprawny parametr adresu URL.';
$string['ipaddress'] = 'Adres IP';
$string['is_in_range'] = 'Adres IP &nbsp;<code>{$a}</code>&nbsp; reprezentuje poprawnego zaufanego hosta.';
$string['ispublished'] = 'Produkt Moodle {$a} włączył tę usługę dla użytkownika.';
$string['issubscribed'] = 'Produkt Moodle {$a} subskrybuje tę usługę na tym hoście.';
$string['keydeleted'] = 'Twój klucz został pomyślnie usunięty i zastąpiony.';
$string['keymismatch'] = 'Klucz publiczny utrzymywany dla tego hosta równi się od aktualnie publikowanego klucza publicznego.';
$string['last_connect_time'] = 'Czas ostatniego połączenia';
$string['last_connect_time_help'] = 'Czas ostatniego podłączenia z tym hostem.';
$string['last_transport_help'] = 'Transport używany podczas ostatniego połączenia z tym hostem.';
$string['loginlinkmnetuser'] = '<br />Jeśli zdalnie używasz sieci Moodle i możesz <a href="{$a}">potwierdzić tutaj swój adres e-mail</a>, możesz zostać przekierowany do swojej strony logowania.<br />';
$string['logs'] = 'dzienniki';
$string['mnet'] = 'Sieć Moodle';
$string['mnet_concatenate_strings'] = 'Połącz do 3 ciągów i zwróć wynik';
$string['mnet_session_prohibited'] = 'Użytkownicy tego serwera macierzystego nie mają obecnie prawa do mobilnego łączenia się z {$a}.';
$string['mnetdisabled'] = 'Sieć Moodle jest <strong>wyłączona</strong>.';
$string['mnetidprovider'] = 'Dostawca ID MNET';
$string['mnetidproviderdesc'] = 'Tego narzędzia można użyć do odtworzenia łącza służącego do logowania, jeśli możesz podać poprawny adres e-mail zgodny z nazwą użytkownika, pod którą wcześniej miała miejsce próba logowania.';
$string['mnetidprovidermsg'] = 'Powinna być możliwość zalogowania do dostawcy {$a}.';
$string['mnetidprovidernotfound'] = 'Niestety nie można znaleźć dalszych informacji.';
$string['mnetlog'] = 'Dzienniki';
$string['mnetpeers'] = 'Współpracownicy';
$string['mnetservices'] = 'Usługi';
$string['mnetsettings'] = 'Ustawienia sieci Moodle';
$string['moodle_home_help'] = 'Ścieżka do strony głównej Moodle na hoście zdalnym, np. /moodle/.';
$string['net'] = 'Sieć';
$string['networksettings'] = 'Ustawienia sieci';
$string['never'] = 'Nigdy';
$string['noaclentries'] = 'Brak wpisów na liście kontroli dostępu SSO';
$string['nocurl'] = 'Nie zainstalowano biblioteki cURL PHP';
$string['nolocaluser'] = 'Dla użytkownika zdalnego nie istnieje rekord lokalny.';
$string['nomodifyacl'] = 'Nie masz uprawnień do modyfikacji listy kontroli dostępu MNET.';
$string['nonmatchingcert'] = 'Przedmiot certyfikatu: <br /><em>{$a->subject}</em><br />nie jest zgodny z hostem, z którego pochodzi:<br /><em>{$a->host}</em>.';
$string['nopubkey'] = 'Wystąpił problem z odtwarzaniem klucza publicznego.<br />Może host nie obsługuje sieci Moodle lub klucz jest niepoprawny.';
$string['nosite'] = 'Nie można znaleźć kursu na poziomie witryny';
$string['nosuchfile'] = 'Plik/funkcja {$a} nie istnieje.';
$string['nosuchfunction'] = 'Nie można znaleźć funkcji lub funkcja zabroniona dla RPC.';
$string['nosuchmodule'] = 'Funkcja została niepoprawnie zaadresowana i nie można jej zlokalizować. Użyj formatu mod/nazwamodulu/lib/nazwafunkcji.';
$string['nosuchpublickey'] = 'Nie można uzyskać klucza publicznego do weryfikacji podpisu.';
$string['nosuchservice'] = 'Usługa RPC nie działa na tym hoście.';
$string['nosuchtransport'] = 'Nie istnieje transport z takim ID.';
$string['notBASE64'] = 'Ciąg nie jest w formacie kodowania Base64. Nie może on być poprawnym kluczem.';
$string['notPEM'] = 'Klucz nie jest w formacie PEM. Nie będzie działał.';
$string['not_in_range'] = 'Adres IP &nbsp;<code>{$a}</code>&nbsp; nie reprezentuje poprawnego zaufanego hosta.';
$string['notpermittedtojump'] = 'Nie masz uprawnień do rozpoczynania zdalnej sesji z tego koncentratora Moodle.';
$string['notpermittedtojumpas'] = 'Nie możesz rozpocząć sesji zdalnej dopóki logowanie odbyło się na danych innego użytkownika.';
$string['notpermittedtoland'] = 'Nie masz uprawnień do rozpoczęcia sesji zdalnej.';
$string['off'] = 'Wyłączony';
$string['on'] = 'Włączony';
$string['options'] = 'Opcje';
$string['permittedtransports'] = 'Dopuszczalne transporty';
$string['phperror'] = 'wewnętrzny błąd PHP uniemożliwił realizację zgłoszenia.';
$string['postrequired'] = 'Funkcja usuwania wymaga żądania POST.';
$string['profileexportfields'] = 'Pola do wysłania';
$string['profilefields'] = 'Pola profilu';
$string['profileimportfields'] = 'Pola do importu';
$string['promiscuous'] = 'Różnorodne';
$string['publickey'] = 'Klucz publiczny';
$string['publickey_help'] = 'Klucz publiczny jest automatycznie pobierany z serwera zdalnego.';
$string['publish'] = 'Publikuj';
$string['reallydeleteserver'] = 'Czy jesteś pewien, że chcesz usunąć serwer?';
$string['receivedwarnings'] = 'Odebrano następujące ostrzeżenia';
$string['recordnoexists'] = 'Rekord nie istnieje.';
$string['reenableserver'] = 'Nie – wybierz tę opcję, aby ponownie włączyć serwer.';
$string['registerallhosts'] = 'zarejestruj wszystkie hosty (<em>tryb koncentratora</em>)';
$string['registerallhostsexplain'] = 'Możesz wybrać automatyczną rejestrację wszystkich hostów próbujących się połączyć.\nOznacza to, że dla każdej witryny Moodle łączącej się z tym serwerem i żądającej klucza publicznego na liście hostów zostanie wyświetlony rekord.<br />Poniżej masz opcję konfiguracji usług dla wszystkich hostów, a po włączeniu tam pewnych usług możesz świadczyć usługi każdemu serwerowi Moodle bez różnicy.';
$string['remotecourses'] = 'Zdalne kursy';
$string['remotehost'] = 'Zdalny host';
$string['remotehosts'] = 'Zdalne hosty';
$string['requiresopenssl'] = 'Sieć wymaga rozszerzenia OpenSSL';
$string['restore'] = 'Przywróć';
$string['returnvalue'] = 'Zwróć wartość';
$string['reviewhostdetails'] = 'Przejrzyj szczegóły hosta';
$string['reviewhostservices'] = 'Przejrzyj usługi hosta';
$string['selectaccesslevel'] = 'Wybierz poziom dostępu z listy.';
$string['selectahost'] = 'Wybierz zdalnego hosta Moodle.';
$string['serviceswepublish'] = 'Usługi publikowana na {$a}.';
$string['serviceswesubscribeto'] = 'Subskrybowane usługi na {$a}.';
$string['settings'] = 'Ustawienia';
$string['showlocal'] = 'Pokaż użytkowników lokalnych';
$string['showremote'] = 'Pokaż użytkowników zdalnych';
$string['ssl_acl_allow'] = 'SSO ACL: Akceptuj użytkownika {$a->user} z {$a->host}';
$string['ssl_acl_deny'] = 'SSO ACL: Odrzuć użytkownika {$a->user} z {$a->host}';
$string['ssoaccesscontrol'] = 'Kontrola dostępu SSO';
$string['ssoacldescr'] = 'Użyj tej strony, aby przyznać/odmówić dostępu do konkretnych użytkowników ze zdalnych hostów sieci Moodle. Jest to przydatne w razie oferowania usług SSO użytkownikom zdalnym. Aby kontrolować zdolność użytkowników <em>lokalnych</em> do mobilnego dostępu do innych hostów sieci Moodle, użyj systemu ról do nadania im uprawnienia <em>mnetlogintoremote</em>.';
$string['ssoaclneeds'] = 'Aby ta funkcja działała, musi być włączona sieć Moodle oraz wtyczka uwierzytelniania sieci Moodle i funkcja automatycznego dodawania użytkowników.';
$string['strict'] = 'Ściśle';
$string['subscribe'] = 'Subskrybuj';
$string['system'] = 'System';
$string['testtrustedhosts'] = 'Testuj adres';
$string['testtrustedhostsexplain'] = 'Podaj adres IP, aby sprawdzić, czy jest to zaufany host.';
$string['transport_help'] = 'Te opcje są dwustronne, więc możesz zmusić zdalnego hosta do używania podpisanego certyfikatu SSL tylko, jeśli ten serwer również ma podpisany certyfikat SSL.';
$string['trustedhosts'] = 'Hosty XML-RPC';
$string['trustedhostsexplain'] = '<p>Mechanizm zaufanych hostów umożliwia konkretnym komputerom wykonywanie odwołań z użyciem XML-RPC do dowolnej części interfejsu API Moodle. Umożliwia to skryptom kontrolę zachowania Moodle i może być bardzo  niebezpieczną opcją w razie włączenia. Jeśli nie masz pewności, nie włączaj jej.</p>\n<p><strong>Nie</strong> jest ona niezbędna w sieci Moodle.</p>\n<p>Aby ją włączyć, podaj listę adresów IP lub sieci, po jednym w wierszu.\nKlika przykładów:</p>Host lokalny:<br />127.0.0.1<br />Host lokalny (z blokadą sieci):<br />127.0.0.1/32<br />Tylko host o adresie IP 192.168.0.7:<br />192.168.0.7/32<br />Dowolny host o adresie IP z zakresu od 192.168.0.1 do 192.168.0.255:<br />192.168.0.0/24<br />Jakikolwiek host:<br />192.168.0.0/0<br />Oczywiście ostatni przykład <strong>nie</strong> jest konfiguracją zalecaną.';
$string['turnitoff'] = 'Wyłącz';
$string['turniton'] = 'Włącz';
$string['type'] = 'Typ';
$string['unknown'] = 'Nieznany';
$string['unknownerror'] = 'Podczas negocjacji wystąpił nieznany błąd.';
$string['usercannotchangepassword'] = 'Nie możesz tutaj zmienić hasła, ponieważ jesteś użytkownikiem zdalnym.';
$string['userchangepasswordlink'] = '<br /> Musisz mieć możliwość zmiany hasła u swojego <a href="{$a->wwwroot}/login/change_password.php">{$a->dostawcy} opisu</a>.';
$string['usersareonline'] = 'Ostrzeżenie: {$a} użytkowników z tego serwera jest aktualnie zalogowanych na tej witrynie.';
$string['validated_by'] = 'Jest sprawdzane przez sieć: &nbsp;<code>{$a}</code>';
$string['verifysignature-error'] = 'Niepowodzenie weryfikacji podpisu. Wystąpił błąd.';
$string['verifysignature-invalid'] = 'Niepowodzenie weryfikacji podpisu. Wygląda na to, że ten łądunek nie został podpisany przez Ciebie.';
$string['version'] = 'Wersja';
$string['warning'] = 'Ostrzeżenie';
$string['wrong-ip'] = 'Adres IP nie jest zgodny z zarejestrowanym adresem.';
$string['xmlrpc-missing'] = 'Aby móc używać tej funkcji, w kompilacji PHP musisz mieć zainstalowaną funkcję XML-RPC.';
$string['yourhost'] = 'Twój host';
$string['yourpeers'] = 'Twoi współpracownicy';
