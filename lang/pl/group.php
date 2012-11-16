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
 * Strings for component 'group', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   group
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addgroup'] = 'Dodaj użytkownika do grupy';
$string['addgroupstogrouping'] = 'Dodaj grupę do grupy nadrzędnej';
$string['addgroupstogroupings'] = 'Dodaj/Usuń grupy';
$string['adduserstogroup'] = 'Dodaj/Usuń użytkowników';
$string['allocateby'] = 'Przypisz do grup';
$string['anygrouping'] = 'Jakiekolwiek grupy nadrzędne';
$string['autocreategroups'] = 'Automatyczne tworzenie grup';
$string['backtogroupings'] = 'Powrót do grup nadrzędnych';
$string['backtogroups'] = 'Powrót do grup';
$string['badnamingscheme'] = 'Musi zawierać dokładnie jeden znak "@" lub jeden "#".';
$string['byfirstname'] = 'Alfabetycznie według Imię Nazwisko';
$string['byidnumber'] = 'Alfabetycznie według numeru ID';
$string['bylastname'] = 'Alfabetycznie według Nazwisko Imię';
$string['createautomaticgrouping'] = 'Stwórz automatyczne grupy nadrzędne';
$string['creategroup'] = 'Utwórz grupę';
$string['creategrouping'] = 'Utwórz grupę nadrzędną';
$string['creategroupinselectedgrouping'] = 'Utwórz grupę w grupie nadrzędnej';
$string['createingrouping'] = 'Utwórz w grupie nadrzędnej';
$string['createorphangroup'] = 'Utwórz oddzielną grupę';
$string['databaseupgradegroups'] = 'Grupy w wersji {$a}';
$string['defaultgrouping'] = 'Domyślna grupa nadrzędna';
$string['defaultgroupingname'] = 'Grupy nadrzędne';
$string['defaultgroupname'] = 'Grupa';
$string['deleteallgroupings'] = 'Usuń wszystkie grupy nadrzędne';
$string['deleteallgroups'] = 'Usuń wszystkie grupy';
$string['deletegroupconfirm'] = 'Czy masz całkowitą pewność, że chcesz usunąć grupę \'{$a}\'?';
$string['deletegrouping'] = 'Usuń grupę nadrzędną';
$string['deletegroupingconfirm'] = 'Czy masz całkowitą pewność, że chcesz usunąć grupę nadrzędną \'{$a}\'? (Grupy będące wewnątrz nie będą usunięte)';
$string['deletegroupsconfirm'] = 'Czy masz całkowitą pewność, że chcesz usunąć te grupy?';
$string['deleteselectedgroup'] = 'Usuń wybraną grupę';
$string['editgroupingsettings'] = 'Modyfikuj ustawienia grupy nadrzędnej';
$string['editgroupsettings'] = 'Modyfikuj ustawienia grupy';
$string['enrolmentkey'] = 'Klucz dostępu do kursu';
$string['erroraddremoveuser'] = 'Błąd podczas dodawania/usuwania użytkownika {$a} do grupy';
$string['erroreditgroup'] = 'Błąd podczas tworzenia/aktualizacji grupy {$a}';
$string['erroreditgrouping'] = 'Błąd podczas tworzenia/aktualizacji grupy nadrzędnej {$a}';
$string['errorinvalidgroup'] = 'Błąd, niewłaściwa grupa {$a}';
$string['errorselectone'] = 'Wybierz jedną grupę zanim użyjesz tej opcji';
$string['errorselectsome'] = 'Wybierz jedną lub więcej grup zanim użyjesz tej opcji';
$string['evenallocation'] = 'Uwaga: Aby ilość członków w grupie została dobrana tak, grupy były równoliczne.';
$string['existingmembers'] = 'Istniejący użytkownicy: {$a}';
$string['filtergroups'] = 'Filtruj grupy według:';
$string['group'] = 'Grupa';
$string['groupaddedsuccesfully'] = 'Grupa {$a} dodana.';
$string['groupby'] = 'Określ';
$string['groupdescription'] = 'Informacje o grupie';
$string['groupinfo'] = 'Informacja o wybranej grupie';
$string['groupinfomembers'] = 'Informacje o wybranych użytkownikach';
$string['groupinfopeople'] = 'Informacje o wybranych osobach';
$string['grouping'] = 'Grupy nadrzędne';
$string['groupingdescription'] = 'Opis grupy nadrzędnej';
$string['groupingname'] = 'Nazwa grupy nadrzędnej';
$string['groupingnameexists'] = 'Nazwa grupy nadrzędnej\'{$a}\' już istnieje w tym kursie. proszę wybrać inną';
$string['groupings'] = 'Grupy nadrzędne';
$string['groupingsonly'] = 'Tylko grupy nadrzędne';
$string['groupmember'] = 'Członek grupy';
$string['groupmemberdesc'] = 'Standardowa rola dla członka grupy';
$string['groupmembers'] = 'Członkowie grupy';
$string['groupmembersonly'] = 'Dostępne tylko dla członków grupy';
$string['groupmembersonlyerror'] = 'Niestety, musisz być członkiem przynajmniej jednej z grup użytej w tej aktywności.';
$string['groupmemberssee'] = 'Zobacz członków grupy';
$string['groupmembersselected'] = 'Członkowie wybranych grup';
$string['groupmode'] = 'Tryb grup';
$string['groupmode_help'] = 'Są trzy ustawienia dla grup:
* brak grup
* osobne grupy - każda grupa widzi tylko siebie, reszta jest niewidzialna
* widoczne grupy - każda grupa pracuje w swoich ramach, ale widzi także inne grupy


Grupy można stworzyć na dwóch poziomach:

**1. Poziom kursu**
: Jest to domyślne ustawienie dla wszystkich aktywności w ramach danego kursu
**2. Poziom aktywności**
: Każda aktywność, która umożliwia grupową pracę pozwala określić tryb pracy w grupach.
Jeśli kurs wymusza pracę w grupach
wówczas ten parametr nie jest brany pod uwagę.</dd>
</dl>
[]: help.php?module=moodle&file=groupmodeforce.html';
$string['groupmodeforce'] = 'Wymuś istnienie grup';
$string['groupmy'] = 'Moja grupa';
$string['groupname'] = 'Nazwa grupy';
$string['groupnameexists'] = 'Nazwa grupy \'{$a}\' już istnieje w tym kursie, proszę wybrać inną.';
$string['groupnotamember'] = 'Niestety nie jesteś członkiem tej grupy';
$string['groups'] = 'Grupy';
$string['groupscount'] = 'Grupy ({$a})';
$string['groupsgroupings'] = 'Grupy &amp; grupy nadrzędne';
$string['groupsinselectedgrouping'] = 'Grupy w:';
$string['groupsnone'] = 'Brak grup';
$string['groupsonly'] = 'Tylko grupy';
$string['groupspreview'] = 'Podgląd grup';
$string['groupsseparate'] = 'Oddzielne grupy';
$string['groupsvisible'] = 'Widoczne grupy';
$string['grouptemplate'] = 'Grupa @';
$string['hidepicture'] = 'Ukryj zdjęcie';
$string['importgroups'] = 'Importuj grupy';
$string['javascriptrequired'] = 'Ta strona wymaga włączenia obsługi Javascriptu';
$string['members'] = 'Członków w grupie';
$string['membersofselectedgroup'] = 'Członkowie:';
$string['namingscheme'] = 'Schemat nazw';
$string['newgrouping'] = 'Nowa grupa nadrzędna';
$string['newpicture'] = 'Nowy obraz';
$string['newpicture_help'] = 'Możesz przesłać na ten serwer plik graficzny ze swojego komputera. Plik ten będzie Cię reprezentował w różnych miejscach.
Z podanego powyżej powodu najlepszym wizerunkiem będzie Twój portret z bliska, ale możesz wykorzystać dowolną inną grafikę.
Plik graficzny musi mieć format JPG lub PNG (tzn. jego nazwa powinna mieć rozszerzenie .jpg lub .png).
Są cztery sposoby uzyskania pliku graficznego:
1. Zdjęcia wykonane cyfrowym aparatem fotograficznym zapisane w Twoim komputerze najprawdopodobniej będą już we właściwym formacie.
2. Możesz zeskanować odbitkę fotograficzną - pamiętaj o zapisaniu pliku w formacie JPG lub PNG.
3. Jeżeli masz zdolności artystyczne, możesz sam zrobić rysunek używając programu do malowania.
4. Możesz "podkraść" plik graficzny z sieci WWW. [http://images.google.com](http://images.google.com) to znakomite miejsce do szukania grafiki. Po znalezieniu odpowiedniego pliku, kliknij prawym przyciskiem myszy i wybierz polecenie "Zapisz rysunek" z menu (procedura ta może się trochę różnić w zależności od komputera).

W celu przesłania pliku graficznego, kliknij przycisk "Przeglądaj" na niniejszej stronie edycji i wybierz odpowiedni plik z twardego dysku.
UWAGA: Upewnij się że plik ten nie przekracza podanego maksymalnego rozmiaru, w przeciwnym razie nie zostanie on przesłany.
Następnie kliknij "Aktualizuj mój profil" na dole ekranu - obraz zostanie przycięty i zmniejszony do rozmiaru 100 na 100 pikseli.
Gdy powrócisz na stronę profilu, być może nie zmieni się wygląd reprezentującej Cię grafiki. W takim przypadku kliknij w swojej przeglądarce przycisk "Odśwież".';
$string['noallocation'] = 'Nie przypisuj członków';
$string['nogroups'] = 'W tym kursie nie ma jeszcze grup';
$string['nogroupsassigned'] = 'Nie określono grup';
$string['nopermissionforcreation'] = 'Nie można utworzyć grupy "{$a}" ponieważ nie masz wymaganych uprawnień.';
$string['nosmallgroups'] = 'Zadbaj aby ostatnia grupa nie była mniejsza od pozostałych grup.';
$string['notingrouping'] = 'Nie jest w grupie nadrzędnej';
$string['nousersinrole'] = 'Brak odpowiednich użytkowników o wybranej roli';
$string['number'] = 'Liczba grup/członków';
$string['numgroups'] = 'Liczby grup';
$string['nummembers'] = 'Członków w grupie';
$string['overview'] = 'Podgląd';
$string['potentialmembers'] = 'Potencjalna liczba członków: {$a}';
$string['potentialmembs'] = 'Potencjalni członkowie';
$string['printerfriendly'] = 'Do wydruku';
$string['random'] = 'Losowo';
$string['removefromgroup'] = 'Usuń użytkownika z grupy {$a}';
$string['removefromgroupconfirm'] = 'Czy na pewno chcesz usunąć użytkownika "{$a->user}" z grupy "{$a->group}"?';
$string['removegroupfromselectedgrouping'] = 'Usuń grupę z grupy nadrzędnej';
$string['removegroupingsmembers'] = 'Usuń wszystkie grupy z grup nadrzędnych';
$string['removegroupsmembers'] = 'Usuń wszystkich członków grup';
$string['removeselectedusers'] = 'Usuń wskazanych użytkowników';
$string['selectfromrole'] = 'Przypisuj do grupy na podstawie roli';
$string['showgroupsingrouping'] = 'Pokaż grupy w grupie nadrzędnej';
$string['showmembersforgroup'] = 'Pokaż członków grupy';
$string['toomanygroups'] = 'Zbyt mało uczestników, aby utworzyć tyle grup - jest tylko {$a} użytkowników z wybraną rolą.';
$string['usercount'] = 'liczba członków';
$string['usercounttotal'] = 'liczba członków ({$a})';
$string['usergroupmembership'] = 'Użytkownik należy do:';
