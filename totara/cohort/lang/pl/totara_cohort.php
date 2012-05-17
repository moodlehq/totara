<?php
// totara_cohort.php - created with Totara langimport script version 1.1

$string['abouttocreate'] = 'Zamierzasz utworzyć nową generację o nazwie "{$a}"';
$string['addcohort'] = 'Utwórz nową generację';
$string['anycohort'] = 'Dowolny';
$string['assign'] = 'Przypisz';
$string['assignmemberstocohort'] = 'Przypisz członków do generacji';
$string['assignto'] = 'Członkowie generacji "{$a}"';
$string['backtocohorts'] = 'Powrót do generacji';
$string['cannoteditcohort'] = 'Tej generacji nie można edytować po utworzeniu';
$string['childrenincluded'] = 'łącznie z obiektami podrzędnymi';
$string['clear'] = 'Wyczyść';
$string['cohort'] = 'Generacja';
$string['cohort:assign'] = 'Przypisz członków generacji';
$string['cohort:manage'] = 'Zarządzaj generacjami';
$string['cohort:view'] = 'Użyj generacji i wyświetl członków';
$string['cohortmembers'] = 'Członkowie generacji';
$string['cohorts'] = 'Generacje';
$string['cohortsin'] = 'Dosępne generacje';
$string['component'] = 'Źródło';
$string['confirmdynamiccohortcreation'] = 'Potwierdź tworzenie generacji dynamicznej';
$string['createdynamiccohort'] = 'Utwórz generację dynamiczną';
$string['createnewcohort'] = 'Utwórz nową generację';
$string['criteria'] = 'Kryteria';
$string['criteriaoptional'] = 'Wszystkie kryteria są opcjonalne, ale należy wybrać przynajmniej jedną opcję.';
$string['currentusers'] = 'Bieżący użytkownicy';
$string['currentusersmatching'] = 'Bieżący użytkownicy zgodni z';
$string['delcohort'] = 'Usuń generację';
$string['delconfirm'] = 'Czy naprawdę chcesz usunąć generację \'{$a}\'?';
$string['deletethiscohort'] = 'Usuń tę generację';
$string['description'] = 'Opis';
$string['duplicateidnumber'] = 'Generacja o takim samym numerze ID już istnieje';
$string['dynamic'] = 'Dynamiczne';
$string['dynamiccohortcriteria'] = 'Kryteria generacji dynamicznej';
$string['dynamiccohortcriterialower'] = 'Kryteria generacji dynamicznej';
$string['editcohort'] = 'Edytuj generację';
$string['editdetails'] = 'Edytuj szczegóły';
$string['editmembers'] = 'Edytuj członków';
$string['failedtodeleted'] = 'Nie można usunąć generacji';
$string['idnumber'] = 'ID';
$string['includechildren'] = 'Dołącz obiekty podrzędne';
$string['members'] = 'Członkowie';
$string['memberscount'] = 'Wielkość';
$string['mustselectonecriteria'] = 'Musisz wybrać przynajmniej jedno kryterium';
$string['name'] = 'Nazwa';
$string['nocomponent'] = 'Utworzone ręcznie';
$string['nocriteriaset'] = '(nie ustawiono kryteriów, usuń tę generację)';
$string['notvalidprofilefield'] = 'Wybierz pole poprawnego profilu';
$string['organisation'] = 'Organizacja';
$string['overview'] = 'Przegląd';
$string['pleasesearchmore'] = 'Sprecyzuj wyszukiwanie';
$string['pleaseusesearch'] = 'Użyj wyszukiwania';
$string['position'] = 'Stanowisko';
$string['potusers'] = 'Potencjalni użytkownicy';
$string['potusersmatching'] = 'Potencjalni zgodni użytkownicy';
$string['role'] = 'Rola';
$string['selectfromcohort'] = 'Wybierz członków z generacji';
$string['set'] = 'Ustaw';
$string['successfullyaddedcohort'] = 'Pomyślnie dodano generację';
$string['successfullydeleted'] = 'Pomyślnie usunięto generację';
$string['successfullyupdated'] = 'Pomyślnie zaktualizowano generację';
$string['thiscohortwillhave'] = 'Ta generacja będzie miała w tym momencie {$a} członków';
$string['toomanyusersmatchsearch'] = 'Za dużo użytkowników odpowiada wyszukiwaniu';
$string['toomanyuserstoshow'] = 'Istnieje za dużo użytkowników do wyświetlenia';
$string['type'] = 'Typ';
$string['userprofilefield'] = 'Pole profilu użytkownika';
$string['values'] = 'Wartości';
$string['viewmembers'] = 'Wyświetl członków';
$string['type_help'] = '<h1>Typ generacji</h1>

<p>Typ generacji może być \'stały\' lub \'dynamiczny\'.</p>
<p>Generacje stałe to wstępnie zdefiniowane listy użytkowników ręcznie utworzone przez twórcę generacji. Twórca może dodawać i usuwać użytkowników, ale w przeciwnym razie lista jest statyczna.</p>
<p>Generacje dynamiczne są określane przez regułę lub zestaw reguł, zaś użytkownicy włączeni do generacji będą dynamicznie aktualizowani tak, aby uwzględniać użytkowników zgodnych z tymi regułami (i usuwać użytkowników, którzy już do nich nie pasują).</p>
<p>Członków generacji stałej można zmienić w dowolnej chwili, ale reguły definiujące generację dynamiczną nie mogą zostać zmienione po zapisaniu generacji.</p>';
$string['profilefieldvalues_help'] = '<h1>Wartości pola profilu generacji</h1>

<p>W razie wybrania tej opcji członkowie generacji dynamicznej zostaną wybrani na podstawie zgodności pola profilu użytkownika z konkretną wartością.</p>
<p>Wartością może być pojedynczy ciąg tekstowy lub rozdzielana przecinkami lista kilku ciągów tekstowych. Jeśli zostanie podana lista rozdzielana przecinkami, do generacji zostaną włączeni użytkownicy mający zgodność z dowolnym oddzielnym ciągiem.</p>';
$string['positionincludechildren_help'] = '<h1>Generacja zawiera stanowiska podrzędne</h1>

<p>Jeśli jest zaznaczone pole \'Uwzględnij obiekty podrzędne\', wszyscy użytkownicy na wybranym stanowisku i wszelkie stanowiska poniżej wybranego stanowiska w hierarchii zostaną włączone do tej generacji.</p>
<p>Jeśli pole \'Uwzględnij obiekty podrzędne\' nie jest wybrane, do generacji zostaną przypisani tylko użytkownicy z przypisanym dokładnie wybranym stanowiskiem.</p>';
$string['orgincludechildren_help'] = '<h1>Generacja zawiera organizacje podrzędne</h1>

<p>Jeśli jest zaznaczone pole wyboru \'Uwzględniaj obiekty podrzędne\', wszyscy użytkownicy w wybranej organizacji i wszystkie organizacje poniżej wybranej organizacji w hierarchii zostaną uwzględnione w tej generacji.</p>
<p>Jeśli pole \'Uwzględniaj obiekty podrzędne\' nie jest zaznaczone, do generacji zostaną wybrani tylko użytkownicy, którzy zostali przypisani dokładnie do wybranej organizacji.</p>';

?>
