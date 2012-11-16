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
 * Strings for component 'chat', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['ajax'] = 'Wersja wykorzystująca Ajax';
$string['autoscroll'] = 'Przewijaj automatycznie';
$string['beep'] = 'rozmawia';
$string['cantlogin'] = 'Nie udało się zalogować do czat-roomu!!';
$string['chat:chat'] = 'Rozmawiaj na czacie';
$string['chat:deletelog'] = 'Usuń logi czatu';
$string['chat:exportparticipatedsession'] = 'Eksportuj sesję czatu, w której brałeś udział';
$string['chat:exportsession'] = 'Eksportuj dowolne sesje czatu';
$string['chat:readlog'] = 'Czytaj logi czatu';
$string['chat:talk'] = 'Rozmowa na czacie';
$string['chatintro'] = 'Wstęp';
$string['chatname'] = 'Nazwa chatroomu';
$string['chatreport'] = 'Sesje czatu';
$string['chattime'] = 'Czas następnego czatu';
$string['configmethod'] = 'Normalna metoda tworzenia czatu wymaga, aby użytkownicy regularnie łączyli się z serwerem, aby zaktualizować dyskusję. Nie wymaga to dodatkowej konfiguracji i działa wszędzie. Niestety duża liczba czatujących osób generuje duże obciążenie serwera. Używanie tzw. demona wymaga dostępu do powłoki Unixa, ale daje szybkie i skalowalne środowisko czatu.';
$string['confignormalupdatemode'] = 'Uaktualnianie chat-roomów zazwyczaj obsługuje sie wydajnie używając funkcji <em>keep-alive</em> w Http 1.1, ale to mimo wszystko obciąża serwer. Bardziej zaawansowaną metodą jest używanie <em>Stream</em> aby przesyłać uaktualnienie użytkownikom. Używanie <em>Stream</em> jest znacznie lepsze, ale może nie być zainstalowane na Twoim serwerze.';
$string['configoldping'] = 'Po jakim czasie braku aktywności ma uważać się, że użytkownik opuścił czat?';
$string['configrefreshroom'] = 'Jak często czat ma być odświeżany? (w sekundach). Ustawienie niskiej wartości spowoduje szybsze działanie, może jednak obciążać serwer, kiedy wiele osób rozmawia';
$string['configrefreshuserlist'] = 'Jak często ma być odświeżana lista użytkowników? (w sekundach)';
$string['configserverhost'] = 'Host komputera, na którym jest zainstalowany demon';
$string['configserverip'] = 'Adres IP, który wskazuje powyższy host';
$string['configservermax'] = 'Maksymalna liczba uczestników';
$string['configserverport'] = 'Port używany przez demona';
$string['currentchats'] = 'Aktywne sesje czatu';
$string['currentusers'] = 'Bieżący użytkownicy';
$string['deletesession'] = 'Usuń sesję';
$string['deletesessionsure'] = 'Jesteś pewien/a że chcesz usunąć tą sesję?';
$string['donotusechattime'] = 'Nie pokazuj czasów czatu';
$string['enterchat'] = 'Naciśnij tu, aby wejść na czat';
$string['errornousers'] = 'Nie znaleziono żadnych użytkowników!';
$string['explaingeneralconfig'] = 'Te ustawienia <strong>zawsze</strong> mają znaczenie';
$string['explainmethoddaemon'] = 'Te ustawienia są ważne <strong>tylko</strong>, jeśli wybrałeś demona do obsługi czatu.';
$string['explainmethodnormal'] = 'Te ustawienia są ważne <strong>tylko</strong>, jeśli wybrałeś normalną metodą obsługi czatu.';
$string['generalconfig'] = 'Podstawowa konfiguracja';
$string['idle'] = 'Bezczynny';
$string['inputarea'] = 'Obszar wprowadzania';
$string['invalidid'] = 'Nie znaleziono tego czat-roomu!';
$string['list_all_sessions'] = 'Lista wszystkich sesji.';
$string['list_complete_sessions'] = 'Lista zakończonych sesji.';
$string['listing_all_sessions'] = 'Lista wszystkich sesji.';
$string['messagebeepseveryone'] = '{$a} rozmawia ze wszstkimi';
$string['messagebeepsyou'] = '{$a} właśnie do Ciebie napisał';
$string['messageenter'] = '{$a} właśnie wszedł na czat';
$string['messageexit'] = '{$a} opuścił czat';
$string['messages'] = 'Wiadomości';
$string['messageyoubeep'] = 'Zostałeś wypikany {$a}';
$string['method'] = 'Metoda czatu';
$string['methodajax'] = 'Metoda Ajax';
$string['methoddaemon'] = 'Demon czatu';
$string['methodnormal'] = 'Normalna metoda';
$string['modulename'] = 'Czat';
$string['modulenameplural'] = 'Czaty';
$string['neverdeletemessages'] = 'Nigdy nie usuwaj wiadomości';
$string['nextsession'] = 'Następna zaplanowana sesja';
$string['no_complete_sessions_found'] = 'Nie znaleziono kompletnych sesji.';
$string['nochat'] = 'Nie znaleziono czatu.';
$string['noguests'] = 'Czat jest zamknięty dla gości';
$string['nomessages'] = 'Brak wiadomości';
$string['nopermissiontoseethechatlog'] = 'Nie masz uprawnień do oglądania logów czatu.';
$string['normalkeepalive'] = 'Utrzymuj';
$string['normalstream'] = 'Strumień';
$string['noscheduledsession'] = 'Nie ma zaplanowanych sesji.';
$string['notallowenter'] = 'Nie posiadasz uprawnień, aby wejść  do tego czat-roomu.';
$string['notlogged'] = 'Nie jesteś zalogowany!';
$string['oldping'] = 'Opóźnienie do rozłączenia';
$string['pastchats'] = 'Poprzednie sesje czatu';
$string['pluginadministration'] = 'Administracja czatem';
$string['pluginname'] = 'Czat';
$string['refreshroom'] = 'Odśwież pokój';
$string['refreshuserlist'] = 'Odśwież listę użytkowników';
$string['removemessages'] = 'Usuń wszystkie wiadomości';
$string['repeatdaily'] = 'Codziennie w tym samym czasie';
$string['repeatnone'] = 'Nie powtarzaj - jedynie określony czas';
$string['repeattimes'] = 'Powtórz sesje';
$string['repeatweekly'] = 'Co tydzień w tym samym czasie';
$string['saidto'] = 'powiedział do';
$string['savemessages'] = 'Zachowaj minione sesje';
$string['seesession'] = 'Zobacz sesję';
$string['send'] = 'Wyślij';
$string['sending'] = 'Wysyłanie';
$string['serverhost'] = 'Nazwa serwera';
$string['serverip'] = 'IP serwera';
$string['servermax'] = 'Maksymalna liczba użytkowników';
$string['serverport'] = 'Port serwera';
$string['sessions'] = 'Sesje czat';
$string['sessionstart'] = 'Sesja czatu rozpocznie się za:  {$a}';
$string['strftimemessage'] = '%H:%M';
$string['studentseereports'] = 'Każdy może oglądać minione sesje';
$string['talk'] = 'Dyskusja';
$string['updatemethod'] = 'Metoda aktualizacji';
$string['userlist'] = 'Lista użytkowników';
$string['usingchat'] = 'Korzystanie z czatu';
$string['usingchat_help'] = 'Moduł Czat posiada pewne cechy, aby nieco umilić rozmowy.

**Emotikony**
: Dowolne emotikony, które mogą zostać wprowadzone gdziekolwiek indziej w Moodle, mogą zostać
wprowadzone także tu i zostaną wyświetlone poprawnie. Na przykład, :-) 
**Linki**
: Adresy internetowe zostaną zamienione na linki automatycznie.
**Stan ducha**
: Możesz rozpocząć linię z "/me" lub ":", aby okazać swój stan ducha. Na przykład, jeżeli Twoje imię to Jan i
wpiszesz ":śmieje się!" lub "/me śmieje się!", wszyscy zobaczą "Jan śmieje się!"
**Bzyczenie**
: Możesz wysłać dĽwięk do innych ludzi naciskając na link "bzzz" obok ich imienia. Użytecznym
skrótem, aby wysłać bzyczenie do wszystkich ludzi na czacie jednocześnie jest "beep all".
**HTML**
: Jeśli znasz nieco kod HTML, możesz używać go w swym tekście, aby wprowadzać obrazy, odgrywać dĽwięki
lub odpowiednio formatować tekst.';
$string['viewreport'] = 'Zobacz minione sesje czat';
