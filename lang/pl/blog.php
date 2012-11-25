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
 * Strings for component 'blog', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   blog
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addnewentry'] = 'Dodaj nowy wpis';
$string['addnewexternalblog'] = 'Rejestruj na zewnętrznym blogu';
$string['assocdescription'] = 'Jeśli piszesz o kursie i / lub modułach aktywności, zaznacz je tutaj.';
$string['associated'] = 'Powiązane {$a}';
$string['associatewithcourse'] = 'Blog o kursie {$a->coursename}';
$string['associatewithmodule'] = 'Blog o {$a->modtype}: {$a->modname}';
$string['association'] = 'Skojarzenie';
$string['associations'] = 'Skojarzenia';
$string['autotags'] = 'Dodaj te tagi';
$string['autotags_help'] = 'Wpisz jeden lub więcej lokalnych tagów (oddzielonych przecinkami), które chcesz automatycznie dodać do każdego wpisu na blogu, skopiowanego z zewnętrznego blogu do blogu lokalnego.';
$string['backupblogshelp'] = 'Jeśli zaznaczysz tą opcję blog będzie włączany do automatycznych kopii zapasowych strony';
$string['blockexternalstitle'] = 'Zewnętrzne blogi';
$string['blocktitle'] = 'Tytuł bloku tagów bloga';
$string['blog'] = 'Blog';
$string['blogaboutthis'] = 'Blog o {$a->type}';
$string['blogaboutthiscourse'] = 'Dodaj wpis o tym kursie';
$string['blogaboutthismodule'] = 'Dodaj wpis o {$a}';
$string['blogdeleteconfirm'] = 'Usunąć ten blog?';
$string['blogdisable'] = 'Blogowanie jest wyłączone!';
$string['blogentries'] = 'Wpisy w blogu';
$string['blogentriesabout'] = 'Wpisy w blogu o {$a}';
$string['blogentriesbygroupaboutcourse'] = 'Wpisy w blogu o {$a->course} utworzone przez {$a->group}';
$string['blogentriesbygroupaboutmodule'] = 'Wpisy w blogu o {$a->mod} utworzone przez {$a->group}';
$string['blogentriesbyuseraboutcourse'] = 'Wpisy w blogu o {$a->course} utworzone przez {$a->user}';
$string['blogentriesbyuseraboutmodule'] = 'Wpisy w blogu o {$a->mod} utworzone przez {$a->user}';
$string['blogentrybyuser'] = 'Wpis na blogu utworzony przez {$a}';
$string['blogpreferences'] = 'Preferencje bloga';
$string['blogs'] = 'Blogi';
$string['blogscourse'] = 'Blogi kursu';
$string['blogssite'] = 'Blogi strony';
$string['blogtags'] = 'Tagi bloga';
$string['cannotviewcourseblog'] = 'Nie masz wymaganych uprawnień do oglądania blogów w tym kursie';
$string['cannotviewcourseorgroupblog'] = 'Nie masz wymaganych uprawnień do oglądania blogów w tym kursie/grupie';
$string['cannotviewsiteblog'] = 'Nie masz wymaganych uprawnień do oglądania wszystkich stron blogów';
$string['cannotviewuserblog'] = 'Nie masz wymaganych uprawnień do odczytu blogów użytkowników';
$string['configexternalblogcrontime'] = 'Jak często Moodle ma sprawdzać zewnętrzne blogi w poszukiwaniu nowych wpisów?';
$string['configmaxexternalblogsperuser'] = 'Liczba zewnętrznych blogów, które każdy użytkownik może podłączyć do swojego bloga w Moodle.';
$string['configuseblogassociations'] = 'Włącz powiązanie wpisów blogów z kursami i modułami kursu.';
$string['courseblog'] = 'Blog kursu: {$a}';
$string['courseblogdisable'] = 'Blogi kursu nie są włączone';
$string['courseblogs'] = 'Użytkownicy mogą wyświetlać tylko blogi dla osób współdzielących kurs';
$string['deleteblogassociations'] = 'Usuń powiązanie blogów';
$string['deleteexternalblog'] = 'Wyrejestruj ten zewnętrzny blog';
$string['deleteotagswarn'] = 'Czy na pewno chcesz usunąć te(n) tag(i) <br />z wpisów w blogu oraz z systemu?';
$string['description'] = 'Opis';
$string['description_help'] = 'Wpisz zdanie lub dwa podsumowujące zawartość zewnętrznego blogu. (Jeśli opis nie zostanie wprowadzony, użyty zostanie opis zarejestrowany w zewnętrznym blogu).';
$string['disableblogs'] = 'Wyłącz całkowicie system blogów';
$string['donothaveblog'] = 'Nie masz własnego bloga, przykro nam.';
$string['editentry'] = 'Edytuj wpis na blogu';
$string['editexternalblog'] = 'Edytuj ten zewnętrzny blog';
$string['emptybody'] = 'Treść wpisu w blogu nie może być pusta';
$string['emptyrssfeed'] = 'Podany adres URL nie wskazuje na właściwy kanał RSS';
$string['emptytitle'] = 'Tytuł wpisu w blogu nie może być pusty';
$string['emptyurl'] = 'Musisz podać adres URL na właściwy kanał RSS';
$string['entrybody'] = 'Treść wpisu w blogu';
$string['entrybodyonlydesc'] = 'Opis wpisu';
$string['entryerrornotyours'] = 'To nie jest twój wpis';
$string['entrysaved'] = 'Wpis został zapisany';
$string['entrytitle'] = 'Tytuł wpisu';
$string['entryupdated'] = 'Uaktualniono wpis blogu';
$string['externalblogcrontime'] = 'Harmonogram crona zewnętrznego blogu';
$string['externalblogdeleteconfirm'] = 'Wyrejestrować ten zewnętrzny blog?';
$string['externalblogdeleted'] = 'Zewnętrzny blog wyrejestrowany';
$string['externalblogs'] = 'Zewnętrzne blogi';
$string['feedisinvalid'] = 'Ten kanał jest nieprawidłowy';
$string['feedisvalid'] = 'Ten kanał jest prawidłowy';
$string['filtertags'] = 'Filtruj tagi';
$string['groupblog'] = 'Blog grupy: {$a}';
$string['groupblogdisable'] = 'Grupowanie blogu nie jest włączone';
$string['groupblogs'] = 'Użytkownicy mogą wyświetlać tylko blogi osób współdzielących grupę';
$string['incorrectblogfilter'] = 'Określono nieprawidłowy typ filtru blogu';
$string['intro'] = 'Ten strumień RSS został wygenerowany automatycznie z jednego lub wielu blogów';
$string['invalidgroupid'] = 'Niepoprawny identyfikator grupy';
$string['invalidurl'] = 'Ten adres URL jest nieosiągalny';
$string['linktooriginalentry'] = 'Link do oryginalnego wpisu na blogu';
$string['maxexternalblogsperuser'] = 'Maksymalna ilość zewnętrznych blogów na jednego użytkownika';
$string['mustassociatecourse'] = 'Jeśli publikujesz dla członków kursu lub grupy, musisz skojarzyć kurs z tym wpisem';
$string['name'] = 'Nazwa';
$string['name_help'] = 'Wprowadź opis dla zewnętrznego blogu. (Jeśli opis nie zostanie wprowadzony, użyta zostanie nazwa zewnętrznego blogu).';
$string['noentriesyet'] = 'Brak widocznych wpisów w tym miejscu';
$string['noguestpost'] = 'Goście nie mogą pisać w blogach!';
$string['nopermissionstodeleteentry'] = 'Brak ci uprawnień niezbędnych do usunięcia tego wpisu na blogu';
$string['norighttodeletetag'] = 'Nie masz praw do usunięcia tego tagu - {$a}';
$string['nosuchentry'] = 'Nie ma takiego wpisu na blogu';
$string['notallowedtoedit'] = 'Nie możesz edytować tego wpisu';
$string['numberofentries'] = 'Wpisy: {$a}';
$string['numberoftags'] = 'Liczba Tagów do wyświetlenia';
$string['pagesize'] = 'Liczba wpisów blogu na stronie';
$string['permalink'] = 'Link bezpośredni';
$string['personalblogs'] = 'Użytkownicy mogą wyświetlać tylko własny blog';
$string['preferences'] = 'Ustawienia';
$string['publishto'] = 'Opublikuj do';
$string['publishto_help'] = 'Dostępne są 3 opcje:
* Wpis prywatny (szkic) - tylko ty i administrator może zobaczyć wpis
* Wpis widoczny dla wszystkich - każdy kto jest zarejestrowany w tym serwisie może przeczytać wpis
* Wpis widoczny dla wszystkich na świecie - każdy, włączając gości, może zobaczyć ten wpis';
$string['publishtocourse'] = 'Użytkownicy współdzielący kurs z tobą';
$string['publishtocourseassoc'] = 'Członkowie skojarzonego kursu';
$string['publishtocourseassocparam'] = 'Członkowie {$a}';
$string['publishtogroup'] = 'Użytkownicy współdzielący z Tobą grupę';
$string['publishtogroupassoc'] = 'Członkowie Twojej grupy w skojarzonym kursie';
$string['publishtogroupassocparam'] = 'Członkowie Twojej grupy w {$a}';
$string['publishtonoone'] = 'Wpis prywatny (szkic)';
$string['publishtosite'] = 'Wpis widoczny dla wszystkich';
$string['publishtoworld'] = 'Wpis widoczny dla wszystkich na świecie';
$string['readfirst'] = 'Przeczytaj to najpierw';
$string['relatedblogentries'] = 'Podobne wpisy na blogu';
$string['retrievedfrom'] = 'Źródło';
$string['searchterm'] = 'Szukaj: {$a}';
$string['settingsupdatederror'] = 'Wystąpił błąd, ustawienia preferencji bloga nie mogły zostać uaktualnione';
$string['siteblog'] = 'Blog witryny: {$a}';
$string['siteblogdisable'] = 'Blog strony nie jest włączony';
$string['siteblogs'] = 'Wszyscy użytkownicy witryny mogą wyświetlać wszystkie wpisy blogu';
$string['tagdatelastused'] = 'Znacznik daty był ostatnio użyty';
$string['tagparam'] = 'Tagi: {$a}';
$string['tags'] = 'Tagi';
$string['tagsort'] = 'Sortuj listę tagów według';
$string['tagtext'] = 'Tekst tagu';
$string['timefetched'] = 'Czas ostatniej synchronizacji';
$string['timewithin'] = 'Wyświetl tagi używane w ciągu tej liczby dni';
$string['updateentrywithid'] = 'Uaktualnianie wpisu';
$string['url'] = 'Adres URL';
$string['url_help'] = 'Wpisz adres URL kanału RSS dla zewnętrznego blogu.';
$string['useblogassociations'] = 'Włącz powiązanie  blogu';
$string['useexternalblogs'] = 'Włącz zewnętrzne blogi';
$string['userblog'] = 'Blog użytkownika: {$a}';
$string['userblogentries'] = 'Wpisy w blogu dokonane przez {$a}';
$string['valid'] = 'Ważny';
$string['viewallblogentries'] = 'Wszystkie wpisy a tym {$a}';
$string['viewallmodentries'] = 'Zobacz wszystkie wpisy na ten temat {$a->type}';
$string['viewallmyentries'] = 'Zobacz wszystkie moje wpisy';
$string['viewblogentries'] = 'Wpisy na ten temat {$a->type}';
$string['viewblogsfor'] = 'Zobacz wszystkie wpisy dla ...';
$string['viewcourseblogs'] = 'Wyświetl wszystkie wpisy dla tego kursu';
$string['viewentriesbyuseraboutcourse'] = 'Wyświetl wszystkie wpisy o tym kursie stworzone przez  {$a}';
$string['viewgroupblogs'] = 'Zobacz wpisy dla grupy ...';
$string['viewgroupentries'] = 'Wpisy grupy';
$string['viewmodblogs'] = 'Zobacz wpisy dla modułu ...';
$string['viewmodentries'] = 'Wpisy modułu';
$string['viewmyentries'] = 'Moje wpisy';
$string['viewmyentriesaboutcourse'] = 'Wyświetl wszystkie moje wpisy o tym kursie';
$string['viewmyentriesaboutmodule'] = 'Wyświetl wszystkie moje wpisy o {$a}';
$string['viewsiteentries'] = 'Wyświetl wszystkie wpisy';
$string['viewuserentries'] = 'Wyświetl wszystkie wpisy stworzone przez {$a}';
$string['worldblogs'] = 'Wszyscy mogą czytać wpisy ustawione jako dostępne dla świata';
$string['wrongpostid'] = 'Błędne id postu blogu';
