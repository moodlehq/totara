<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Strings for component 'totara_program', language 'pl', branch 'totara-2.2'
 * @package totara
 * @subpackage totara_program
 */

$string['action'] = 'Czynność';
$string['addcohortstoprogram'] = 'Dodaj generacje do programu';
$string['addcohorttoprogram'] = 'Dodaj generację do programu';
$string['addcompetency'] = 'Dodaj kompetencję';
$string['addcourse'] = 'Dodaj kurs';
$string['addcourses'] = 'Dodaj kursy';
$string['added'] = 'Dodano';
$string['addindividualstoprogram'] = 'Dodaj osoby do programu';
$string['addindividualtoprogram'] = 'Dodaj osobę do programu';
$string['addmanagerstoprogram'] = 'Dodaj kierowników do programu';
$string['addmanagertoprogram'] = 'Dodaj kierownika do programu';
$string['addnew'] = 'Dodaj nowy';
$string['addnewprogram'] = 'Dodaj nowy program';
$string['addorganisationstoprogram'] = 'Dodaj organizacje do programu';
$string['addorganisationtoprogram'] = 'Dodaj organizację do programu';
$string['addorremovecourses'] = 'Dodaj/usuń kursy';
$string['addpositiontoprogram'] = 'Dodaj stanowisko do programu';
$string['addprogramcontent_help'] = '# Dodaj zawartość programu
Dodając zestawy kursów, można zbudować ścieżkę nauki programu. Po dodaniu zestawów można zdefiniować relacje między nimi. Zestawy można tworzyć, ręcznie dodając kursy, wybierając wstępnie zdefiniowaną kompetencję lub konfigurując pojedynczy kurs z powtórzeniami.
Po utworzeniu pewnej liczby zestawów stosuje się rozdzielacze zestawów w celu umożliwienia tworzenia sekwencji (tj. zależności) poszczególnych zestawów. Przykładowy program ze zdefiniowanymi czterema zestawami kursów ma następujące zależności:
* Z zestawu pierwszego uczestnik musi ukończyć jeden kurs (kursA lub kursB) przed przejściem do zestawu drugiego.
* Z zestawu drugiego uczestnik musi ukończyć wszystkie kursy (kursC i kursD i kursE) przed przejściem do zestawu trzeciego lub czwartego.
* Z zestawu trzeciego uczestnik musi ukończyć jeden kurs (kursE) lub wszystkie kursy z zestawu czwartego (kursF i kursG).
Po ukończeniu ścieżki nauki uczestnik kończy program.
Zestawy można utworzyć, dodając:
## Zestaw kursów
Umożliwia tworzenie wielu zestawów kursów z zależnościami.
## Kompetencję
Umożliwia tworzenie wielu zestawów kursów na podstawie wstępnie zdefiniowanego dowodu kompetencji. Jeśli do stworzenia zestawu zostanie użyta kompetencja, stanie się ona sztywna i nie można będzie jej zmienić.
## Pojedynczy kurs
Wymusza dopuszczenie pojedynczego kursu z powtórzeniami.
Po wybraniu zestawu kursów lub kompetencji pojedynczy kurs z powtórzeniami zostanie usunięty z listy.';
$string['affectedusercount'] = 'Liczba uczestników, których dotyczą te zmiany:';
$string['afterprogramiscompleted'] = 'Po ukończeniu programu';
$string['afterprogramisdue'] = 'Po terminie programu';
$string['aftersetisdue'] = 'Po terminie zestawu';
$string['allbelow'] = 'Wszystko poniższe';
$string['allbelowlower'] = 'wszystko poniższe';
$string['allcompletiontimeunknownissues'] = 'Wszystkie nieznane problemy czasu ukończenia';
$string['allcourses'] = 'Wszystkie kursy';
$string['allcoursesfrom'] = 'wszystkie kursy z';
$string['allcurrentlyassignedissues'] = 'Wszystkie obecnie przypisane problemy';
$string['allextensionrequestissues'] = 'Wszystkie problemy żądania rozszerzenia';
$string['alllearners'] = 'Wszyscy uczestnicy';
$string['allowedtimeforprogramaslearner'] = 'Zostało {$a->num} {$a->periodstr} do ukończenia tego programu.';
$string['allowedtimeforprogramasmanager'] = '{$a->fullname} pozostało {$a->num} {$a->periodstr} do ukończenia tego programu.';
$string['allowedtimeforprogramviewing'] = 'Uczestnikowi pozostało {$a->num} {$a->periodstr} do ukończenia tego programu.';
$string['allowtimeforprogram'] = 'Pozostaw {$a->num} {$a->periodstr} na ukończenie tego programu.';
$string['allowtimeforset'] = 'Pozostaw {$a->num} {$a->periodstr} na ukończenie tego zestawu.';
$string['alltimeallowanceissues'] = 'Wszystkie problemy z dostępnością czasu';
$string['and'] = 'i';
$string['anothercourse'] = 'inny kurs';
$string['areyousuredeletemessage'] = 'Czy na pewno chcesz usunąć tę wiadomość?';
$string['assignedasindividual'] = 'Przypisano jako osobę.';
$string['assignmentcriterialearner'] = 'Musisz ukończyć ten program w ramach następujących kryteriów:';
$string['assignmentcriteriamanager'] = 'Uczestnik musi ukończyć ten program w ramach następujących kryteriów:';
$string['assignments'] = 'Przypisania';
$string['availability'] = 'Dostępność';
$string['availablefrom'] = 'Dostępne od';
$string['availabletostudents'] = 'Dostępne dla uczestników';
$string['availabletostudentsnot'] = 'Niedostępne dla uczestników';
$string['availableuntil'] = 'Dostępne do';
$string['backtoallextrequests'] = 'Powrót do wszystkich żądań rozszerzenia';
$string['beforecourseends'] = 'przed zakończeniem kursu';
$string['beforeprogramisdue'] = 'Przed terminem realizacji programu';
$string['beforesetisdue'] = 'Przed terminem realizacji zestawu';
$string['browsecategories'] = 'Przeglądaj kategorie';
$string['cancel'] = 'Anuluj';
$string['cancelprogramblurb'] = 'Anulowanie usunie wszystkie niezapisane zmiany';
$string['cancelprogrammanagement'] = 'Wyczyść niezapisane zmiany';
$string['category'] = 'Kategoria';
$string['changecourse'] = 'Zmień kurs';
$string['checkprogramdelete'] = 'Czy na pewno chcesz usunąć ten program i wszystkie powiązane z nim elementy?';
$string['chooseicon'] = 'Wybierz, jaką ikonę chcesz wstawić';
$string['chooseitem'] = 'Wybierz pozycję';
$string['choseautomaticallydetermine'] = 'Wybrano zezwolenie na automatyczne określanie przez system realistycznych ram czasowych ukończenia tego programu';
$string['chosedenyextensionexception'] = 'Wybrano odrzucenie wybranych żądań rozszerzenia';
$string['chosedismissexception'] = 'Wybrano odrzucenie tego wyjątku';
$string['chosegrantextensionexception'] = 'Wybrano przyznanie następujących żądań rozszerzenia';
$string['choseoverrideexception'] = 'Wybrano zastąpienie wyjątku i kontynuowanie przypisywania';
$string['cohort'] = 'Generacja';
$string['cohortname'] = 'Nazwa generacji';
$string['cohorts'] = 'Generacje';
$string['cohorts_category'] = 'generacje';
$string['competency'] = 'Kompetencja';
$string['competencycourseset_help'] = '# Zestaw kursów dla kompetencji
Ten zestaw został utworzony na podstawie wstępnie zdefiniowanej kompetencji.
W przypadku użycia kompetencji do utworzenia zestawu staje się ona sztywna i nie można jej zmienić. Kursów w ramach zestawu nie można edytować. Jeśli kursy w ramach zestawu muszą zostać zmodyfikowane, należy utworzyć ręczny zestaw kursów i dodawać kursy oddzielnie.
Opcje operatora w ramach zestawu kursów dla kompetencji (\'jeden kurs\' lub \'wszystkie kursy\') są określane przez wstępnie zdefiniowane ustawienia kompetencji.';
$string['complete'] = 'Ukończone';
$string['completeallcourses'] = 'Wszystkie kursy w tym zestawie muszą zostać ukończone (chyba że jest to zestaw opcjonalny).';
$string['completeanycourse'] = 'Każdy kurs w tym zestawie musi zostać ukończony.';
$string['completeby'] = 'Ukończyć do';
$string['completebytime'] = 'Ukończyć do {$a}';
$string['completewithin'] = 'Ukończyć w ciągu';
$string['completewithinevent'] = 'Ukończyć w ciągu {$a->num} {$a->period} od {$a->event} {$a->instance}';
$string['completioncriteria'] = 'Kryteria ukończenia';
$string['completiondate'] = 'Data ukończenia';
$string['completionofcourse'] = 'ukończenie kursu';
$string['completionofprogram'] = 'ukończenie programu';
$string['completionstatus'] = 'Stan';
$string['completiontimeunknown'] = 'Nieznany czas ukończenia';
$string['completiontype_help'] = '# Typ ukończenia
Opcje operatora (\'Uczestnik musi ukończyć\') w ramach zestawu to \'jeden kurs\', co oznacza LUB, albo \'wszystkie kursy\', co oznacza I. Pomysł polega na zachowaniu czytelności przepływu dla człowieka. W zależności od wybranej opcji tekst na początku kursów zostanie automatycznie zmieniony.';
$string['confirmassignmentchanges'] = 'Potwierdź zmiany przypisania';
$string['confirmcontentchanges'] = 'Potwierdź zmiany zawartości';
$string['confirmmessagechanges'] = 'Potwierdź zmiany wiadomości';
$string['confirmresolution'] = 'Potwierdź rozwiązanie problemu';
$string['content'] = 'Zawartość';
$string['contentupdatednotsaved'] = 'Zaktualizowano zawartość programu (jeszcze niezapisaną)';
$string['continue'] = 'Kontynuuj';
$string['couldnotinsertnewrecord'] = 'Nie można wstawić nowego rekordu';
$string['course'] = 'Kurs';
$string['coursecompletion'] = 'Ukończenie kursu';
$string['coursecreation_help'] = '# Tworzenie kursu
Tworzenie kursu definiuje, kiedy kurs powinien zostać skopiowany i odtworzony.
Jest to oparte na dacie rozpoczęcia i zakończenia określonej w ustawieniach kursu.';
$string['coursename'] = 'Nazwa kursu';
$string['coursenamelink'] = 'Nazwa kursu';
$string['courses'] = 'Kursy';
$string['coursesetcompleted'] = 'Ukończono zestaw kursów';
$string['coursesetcompletedmessage_help'] = '# Komunikat o ukończeniu zestawu kursów
Ten komunikat zostanie wysłany zawsze, gdy zestaw kursów zostanie ukończony.';
$string['coursesetdue'] = 'Zestaw kursów do realizacji';
$string['coursesetduemessage_help'] = '# Komunikat o terminie zestawu kursów
Ten komunikat zostanie wysłany w określonym czasie przed terminem zestawu kursów.';
$string['coursesetoverdue'] = 'Zaległy zestaw kursów';
$string['coursesetoverduemessage_help'] = '# Komunikat o zaległym zestawie kursów
Ten komunikat zostanie wysłany w określonym czasie po terminie zestawu kursów.';
$string['createandnext'] = 'Utwórz i przejdź do następnego kroku';
$string['createandreturn'] = 'Utwórz i wróć do przeglądu';
$string['createcourse'] = 'Utwórz kurs';
$string['createnewprogram'] = 'Utwórz nowy program';
$string['createprogram'] = 'Utwórz program';
$string['currentduedate'] = 'Bieżąca data realizacji';
$string['currenticon'] = 'Bieżąca ikona';
$string['currentlyassigned'] = 'Aktualnie przypisane';
$string['dateinprofilefield'] = 'data w polu profilu';
$string['days'] = 'Dni';
$string['daysremaining'] = 'Pozostało {$a} dni';
$string['defaultenrolmentmessage_message'] = 'Masz teraz rejestrację w programie %programfullname%.';
$string['defaultenrolmentmessage_subject'] = 'Masz teraz rejestrację w programie %programfullname%.';
$string['defaultexceptionreportmessage_message'] = 'W programie %programfullname% istnieją wyjątki, które trzeba rozstrzygnąć.';
$string['defaultexceptionreportmessage_subject'] = 'Wyjątki wymagają uwagi w programie %programfullname%';
$string['defaultprogramfullname'] = 'Pełna nazwa programu 101';
$string['defaultprogramshortname'] = 'P101';
$string['delete'] = 'Usuń';
$string['deletecourse'] = 'Usuń kurs';
$string['deleteprogram'] = 'Usuń program "{$a}"';
$string['deleteprogrambutton'] = 'Usuń program';
$string['deny'] = 'Odmów';
$string['denyextensionrequest'] = 'Odmów żądaniu rozszerzenia';
$string['description'] = 'Opis';
$string['details'] = 'Szczegóły';
$string['directteam'] = 'bezpośredni zespół';
$string['dismissandtakenoaction'] = 'Odrzuć i nic nie rób';
$string['duedate'] = 'Termin realizacji';
$string['duedatenotset'] = 'Nie ustawiono terminu realizacji';
$string['duestatus'] = 'Termin/stan';
$string['editassignments'] = 'Edytuj przypisania';
$string['editcontent'] = 'Edytuj zawartość';
$string['editmessages'] = 'Edytuj wiadomości';
$string['editprogramassignments'] = 'Edytuj przypisania programu';
$string['editprogramcontent'] = 'Edytuj zawartość programu';
$string['editprogramdetails'] = 'Edytuj szczegóły programu';
$string['editprogrammessages'] = 'Edytuj wiadomości programu';
$string['editprogramroleassignments'] = 'Edytuj przypisania ról programu';
$string['editprograms'] = 'Dodaj/edytuj programy';
$string['endnote'] = 'Uwaga końcowa programu';
$string['enrolmentmessage_help'] = '# Komunikat o rejestracji
Ten komunikat zostanie wysłany zawsze, gdy użytkownik zostanie automatycznie przypisany do programu.';
$string['error:availibileuntilearlierthanfrom'] = 'Data dostępne do nie może być wcześniejsza niż data od';
$string['error:badcheckvariable'] = 'Zmienna sprawdzenia była nieprawidłowa - ponów próbę';
$string['error:cannotrequestextnotuser'] = 'Nie możesz żądać rozszerzenia za innego użytkownika';
$string['error:couldnotloadextension'] = 'Błąd - nie można załadować rozszerzenia.';
$string['error:coursecreation_nonzero'] = 'Utworzenie kursu musi nastąpić więcej niż zero dni przed zakończeniem kursu';
$string['error:courses_endenroldate'] = 'Musisz ustawić datę zakończenia rejestracji dla tego kursu, jeśli chcesz, aby się powtarzał';
$string['error:courses_nocourses'] = 'Zestawy kursów muszą zawierać przynajmniej jeden kurs.';
$string['error:deleteset'] = 'Nie można usunąć zestawu. Nie znaleziono zestawu.';
$string['error:failedsendextensiondenyalert'] = 'Błąd - nie można powiadomić użytkownika o odrzuconym rozszerzeniu';
$string['error:failedsendextensiongrantalert'] = 'Błąd - nie można powiadomić użytkownika o przyznanym rozszerzeniu';
$string['error:failedtofindmanagerrole'] = 'Nie można znaleźć roli o nazwie skróconej kierownik';
$string['error:failedtofindstudentrole'] = 'Nie można znaleźć roli o nazwie skróconej uczestnik';
$string['error:failedtofinduser'] = 'Nie można znaleźć użytkownika o ID {$a}';
$string['error:failedupdateextension'] = 'Błąd - nie można zaktualizować programu nowym terminem realizacji';
$string['error:inaccessible'] = 'Nie możesz obecnie uzyskać dostępu do tego programu';
$string['error:invaliddate'] = 'Data jest niepoprawna';
$string['error:invalidid'] = 'To niepoprawny ID programu';
$string['error:invalidshortname'] = 'To niepoprawna nazwa skrócona programu';
$string['error:invaliduser'] = 'Błąd - niepoprawny użytkownik';
$string['error:mainmessage_empty'] = 'Wymagana jest wiadomość';
$string['error:messagesubject_empty'] = 'Wymagany jest temat wiadomości';
$string['error:nopermissions'] = 'Nie masz niezbędnych uprawnień do wykonania tej czynności';
$string['error:noprogramcompletionfound'] = 'Nie znaleziono rekordu ukończenia programu';
$string['error:notusersmanager'] = 'Nie jesteś kierownikiem użytkownika, który zażądał tego rozszerzenia';
$string['error:processingextrequest'] = 'Wystąpił błąd podczas przetwarzania żądania rozszerzenia';
$string['error:recurrence_nonzero'] = 'Cykl musi być większy od zera';
$string['error:setunableaddcompetency'] = 'Nie można dodać kompetencji do zestawu. Nie znaleziono zestawu lub kompetencji.';
$string['error:setunabletoaddcourse'] = 'Nie można dodać kursu do zestawu. Nie znaleziono zestawu lub kursu.';
$string['error:setunabletodeletecourse'] = 'Nie można usunąc kursu z zestawu {$a}';
$string['error:setupprogcontent'] = 'Nie można skonfigurować zawartości programu.';
$string['error:timeallowednum_nonzero'] = 'Dopuszczalny czas musi być większy od zera.';
$string['error:unabletoaddset'] = 'Nie można dodać nowego zestawu. Nie rozpoznano typu zestawu.';
$string['error:unabletosetupprogcontent'] = 'Nie można skonfigurować zawartości programu.';
$string['error:updateextensionstatus'] = 'Błąd - nie można zaktualizować stanu rozszerzenia';
$string['errorsinform'] = 'W tym formularzu są błędy. Przejrzyj poniższą listę i napraw wszelkie błędy przed zapisaniem.';
$string['eventnotfound'] = 'Nie można znaleźć zdarzenia przypisania programu o ID {$a}';
$string['exceptionreportmessage_help'] = '# Komunikat raportu o wyjątku
Ten komunikat zostanie wysłany do administratora witryny zawsze, gdy do raportu o wyjątkach programu zostaną dodane nowe wyjątki.';
$string['exceptions'] = 'Raport o wyjątkach {$a}';
$string['exceptionsreport'] = 'Raport o wyjątkach';
$string['extenduntil'] = 'Rozszerz do';
$string['extensionbeforenow'] = 'Nie można żądać rozszerzenia wcześniejszego niż data bieżąca';
$string['extensiondate'] = 'Data rozszerzenia';
$string['extensiondenied'] = 'Odmówiono rozszerzenia';
$string['extensiondeniedmessage'] = 'Twoje żądanie rozszerzenia zostało odrzucone.';
$string['extensionearlierthanduedate'] = 'Nie można żądać rozszerzenia wcześniejszego od terminu realizacji bieżącego programu';
$string['extensiongranted'] = 'Przyznano rozszerzenie';
$string['extensiongrantedmessage'] = 'Przyznano rozszerzenie do {$a}.';
$string['extensionrequest'] = 'Żądanie rozszerzenia';
$string['extensionrequestfailed'] = 'Niepowodzenie żądania rozszerzenia. Ponów próbę.';
$string['extensionrequestfailed:nomanager'] = 'Żądanie rozszerzenia nie zostało wysłane. Nie można znaleźć kierownika';
$string['extensionrequestmessage'] = '<p>Użytkownik zażądał rozszerzenia dla programu <em>{$a->programfullname}</em>. Szczegóły rozszerzenia to:</p><ul><li>Data: {$a->extensiondatestr}</li><li>Przyczyna: {$a->extensionreason}</li></ul>';
$string['extensionrequestmessage_help'] = '# Komunikat żądania rozszerzenia
Ten komunikat zostanie wysłany do kierownika uczestnika zawsze, gdy zostanie zgłoszone żądanie rozszerzenia programu.';
$string['extensionrequestnotsent'] = 'NIE można wysłać żądania rozszerzenia. Ponów próbę.';
$string['extensionrequestsent'] = 'Pomyślnie wysłano żądanie rozszerzenia';
$string['extensions'] = 'Rozszerzenia';
$string['failedtoresolve'] = 'Nie można rozwiązać następujących wyjątków';
$string['findprograms'] = 'Znajdź programy';
$string['firstlogin'] = 'Pierwsze logowanie';
$string['for'] = 'Dla';
$string['fullname'] = 'Pełna nazwa';
$string['grant'] = 'Przyznaj';
$string['grantdeny'] = 'Przyznaj/odmów';
$string['grantextensionrequest'] = 'Przyznaj zgłoszenie rozszerzenia';
$string['header:hash'] = 'nr';
$string['header:id'] = 'ID';
$string['header:issue'] = 'Problem';
$string['header:learners'] = 'Uczestnicy';
$string['holdposof'] = 'Utrzymaj stanowisko dla \'{$a}\'';
$string['hours'] = 'Godziny';
$string['icon'] = 'Ikona';
$string['idnumberprogram'] = 'ID';
$string['incomplete'] = 'Nieukończone';
$string['individualname'] = 'Nazwa osoby';
$string['individuals'] = 'Osoby';
$string['individuals_category'] = 'osoby';
$string['instructions:assignments1'] = 'kategorii można użyć do przypisania programu do zestawów uczestników.';
$string['instructions:messages1'] = 'Skonfiguruj wyzwalacze zdarzenia i przypomnienia powiązane z programem.';
$string['instructions:programassignments'] = 'Masowo przypisz uczestników i ustaw stałe lub względne kryteria ukończenia <br />(Przypisz uczestników wg organizacji, stanowiska, generacji, hierarchii lub osoby)';
$string['instructions:programcontent'] = 'Zdefiniuj zawartość programu, dodając zestawy kursów i/lub kompetencji';
$string['instructions:programdetails'] = 'Zdefiniuj nazwę, dostępność i opis programu';
$string['instructions:programexceptions'] = 'Szybko rozwiąż problemy z przypisaniem, wybierając opcję Typ i stosując czynność';
$string['instructions:programmessages'] = 'Zdefiniuj wiadomości i przypomnienia programu w zależności od potrzeb';
$string['label:competencyname'] = 'Nazwa kompetencji';
$string['label:coursecreation'] = 'Kiedy utworzyć nowy kurs';
$string['label:learnermustcomplete'] = 'Uczestnik musi ukończyć';
$string['label:message'] = 'Wiadomość';
$string['label:nextsetoperator'] = 'Następny operator zestawu';
$string['label:noticeformanager'] = 'Uwaga dla kierownika';
$string['label:recurcreation'] = 'Tworzenie kursu';
$string['label:recurrence'] = 'Cykl';
$string['label:sendnoticetomanager'] = 'Wyślij uwagę do kierownika';
$string['label:setname'] = 'Nazwa zestawu';
$string['label:subject'] = 'Temat';
$string['label:timeallowance'] = 'Dopuszczalny czas';
$string['label:trigger'] = 'Wyzwalacz';
$string['launchcourse'] = 'Uruchom kurs';
$string['launchprogram'] = 'Uruchom program';
$string['learnerenrolled'] = 'Uczestnik zapisany';
$string['learnerfollowup'] = 'Kontynuacja uczestnika';
$string['learnerfollowupmessage_help'] = '# Komunikat monitowania
Ten komunikat zostanie wysłany do uczestnika w określonym czasie po ukończeniu programu.';
$string['learnersassigned'] = 'Przypisano {$a->total} uczestników. {$a->assignments} uczestników jest aktywnych z {$a->exceptions} wyjątkami';
$string['learnersselected'] = 'wybrano uczestników';
$string['learnerunenrolled'] = 'Anulowano rejestrację uczestnika';
$string['legend:courseset'] = 'Zestaw kursów {$a}';
$string['legend:coursesetcompletedmessage'] = 'WIADOMOŚĆ O UKOŃCZENIU ZESTAWU KRUSÓW';
$string['legend:coursesetduemessage'] = 'WIADOMOŚĆ O TERMINIE ZESTAWU KURSÓW';
$string['legend:coursesetoverduemessage'] = 'WIADOMOŚĆ O OPÓŹNIENIU ZESTAWU KURSÓW';
$string['legend:enrolmentmessage'] = 'WIADOMOŚĆ O REJESTRACJI';
$string['legend:exceptionreportmessage'] = 'WIADOMOŚĆ O RAPORCIE O WYJĄTKACH';
$string['legend:extensionrequestmessage'] = 'WIADOMOŚĆ O ŻĄDANIU ROZSZERZENIA';
$string['legend:learnerfollowupmessage'] = 'WIADOMOŚĆ O KONTYNUACJI UCZESTNIKA';
$string['legend:programcompletedmessage'] = 'WIADOMOŚĆ O UKOŃCZENIU PROGRAMU';
$string['legend:programduemessage'] = 'WIADOMOŚĆ O TERMINIE PROGRAMU';
$string['legend:programoverduemessage'] = 'WIADOMOŚĆ O OPÓŹNIENIU PROGRAMU';
$string['legend:recurringcourseset'] = 'Cykliczny zestaw kursów';
$string['legend:unenrolmentmessage'] = 'WIADOMOŚĆ O ANULOWANIU REJESTRACJI';
$string['mainmessage_help'] = '# Treść komunikatu
Treść komunikatu zostanie wyświetlona odbiorcom komunikatu na ich pulpitach.
Treść komunikatu może zawierać zmienne, które zostaną zastąpione w chwili wysyłania komunikatu.';
$string['manageextensionrequests'] = 'Wyświetl raport o wyjątkach, aby przyznać lub odmówić żądania rozszerzenia';
$string['manageextensions'] = 'Zarządzaj rozszerzeniami';
$string['managementhierarchy'] = 'Hierarchia zarządzania';
$string['managermessage_help'] = '# Informacja dla kierownika
W przypadku zaznaczenia pola \'Wyślij informacje do kierownika\' kierownik odbiorcy komunikatu również otrzyma powiadomienie, które można określić w tym polu.
Informacja dla kierownika może zawierać zmienne, które zostaną zastąpione w chwili wysyłania komunikatu.';
$string['managername'] = 'Nazwisko kierownika';
$string['managers_category'] = 'zespoły zarządzające';
$string['mandatory'] = 'Obowiązkowe';
$string['memberofcohort'] = 'Członek generacji \'{$a}\'.';
$string['memberoforg'] = 'Członek organizacji \'{$a}\'.';
$string['messages'] = 'Wiadomości';
$string['messagesubject_help'] = '# Temat komunikatu
Temat komunikatu, któy zostanie wyświetlony dla odbiorców komunikatu na ich pulpitach. Maksymalnie 255 znaków.
Temat może zawierać zmienne, które zostaną zastąpione w chwili wysyłania komunikatu.';
$string['missingshortname'] = 'Brak krótkiej nazwy';
$string['months'] = 'Miesiące';
$string['movedown'] = 'Przenieś w dół';
$string['moveselectedprogramsto'] = 'Przenieś wybrane programy do...';
$string['moveup'] = 'Przenieś w górę';
$string['multicourseset_help'] = '# Zestaw kursów
Jest to zestaw kursów wybranych indywidualnie z katalogu kursów.
Można zdefiniować nazwę zestawu, to, czy uczestnik musi ukończyć jeden lub wszystkie kursy oraz ogólne ramy czasowe ukończenia zestawu.';
$string['nocoursecontent'] = 'Brak zawartości kursu.';
$string['nocourses'] = 'Brak kursów';
$string['noduedate'] = 'Brak terminu';
$string['noextensions'] = 'Nie masz personelu z oczekującymi żądaniami rozszerzenia';
$string['noprogramassignments'] = 'Program nie zawiera żadnych przypisań';
$string['noprogramcontent'] = 'Program nie zawiera żadnej treści';
$string['noprogramexceptions'] = 'Brak wyjątków';
$string['noprogrammessages'] = 'Program nie zawiera żadnych wiadomości';
$string['noprograms'] = 'Brak programów';
$string['noprogramsfound'] = 'Nie znaleziono programów zawierających słowa \'{$a}\'';
$string['noprogramsyet'] = 'Brak programów w tej kategorii';
$string['norequiredlearning'] = 'Brak wymaganej nauki';
$string['notavailable'] = 'Niedostępne';
$string['notifymanager_help'] = '# Wyślij informację do kierownika
Zaznacz to pole, jeśli należy wysłać informację również do kierownika odbiorcy komunikatu.';
$string['notmanager'] = 'Nie jesteś kierownikiem';
$string['nouserextensions'] = '{$a} nie ma żadnych oczekujących żądań rozszerzenia';
$string['novalidprograms'] = 'Brak poprawnych programów';
$string['numlearners'] = 'liczba uczestników';
$string['of'] = 'z';
$string['ok'] = 'OK';
$string['onecourse'] = 'Jeden kurs';
$string['onecoursesfrom'] = 'jeden kurs z';
$string['onedayremaining'] = 'Pozostał 1 dzień';
$string['or'] = 'lub';
$string['organisationname'] = 'Nazwa organizacji';
$string['organisations'] = 'Organizacje';
$string['organisations_category'] = 'organizacje';
$string['orviewprograms'] = 'lub wyświetl programy w tej kategorii ({$a})';
$string['overrideandaddprogram'] = 'Zastąp i dodaj program';
$string['overview'] = 'Przegląd';
$string['partofteam'] = 'Część zespołu \'{$a}\'';
$string['pendingextension'] = 'Obecnie masz oczekujące żądania rozszerzenia';
$string['pleaseentervaliddate'] = 'Podaj poprawną datę w formacie dd/mm/rrrr';
$string['pleaseentervalidreason'] = 'Podaj poprawną przyczynę';
$string['pleaseentervalidunit'] = 'Podaj poprawną jednostkę z zakresu od 0 do 999';
$string['pleasepickaninstance'] = 'Wybierz element';
$string['pleasesetcompletiontimes'] = 'Ustaw czasy ukończenia dla wszystkich elementów';
$string['positions'] = 'Pozycje';
$string['positions_category'] = 'pozycje';
$string['positionsname'] = 'Nazwa pozycji';
$string['positionstartdate'] = 'Data rozpoczęcia pozycji';
$string['profilefielddate'] = 'Data pola profilu';
$string['prog_courseset_completed_message'] = 'Wiadomość o ukończeniu zestawu kursów';
$string['prog_courseset_due_message'] = 'Wiadomość o terminie zestawu kursów';
$string['prog_courseset_overdue_message'] = 'Wiadomość o opóźnieniu zestawu kursów';
$string['prog_enrolment_message'] = 'Wiadomość o rejestracji';
$string['prog_exception_report_message'] = 'Wiadomość o raporcie o wyjątkach';
$string['prog_extension_request_message'] = 'Wiadomość o żądaniu rozszerzenia';
$string['prog_learner_followup_message'] = 'Wiadomość o kontynuacji uczestnika';
$string['prog_program_completed_message'] = 'Wiadomość o ukończeniu programu';
$string['prog_program_due_message'] = 'Wiadomość o terminie programu';
$string['prog_program_overdue_message'] = 'Wiadomość o opóźnieniu programu';
$string['prog_unenrolment_message'] = 'Wiadomość o anulowaniu rejestracji';
$string['prognamelinkedicon'] = 'Nazwa programu i powiązana ikona';
$string['program'] = 'Program';
$string['program:accessanyprogram'] = 'Dostęp do dowolnego programu';
$string['program:configureassignments'] = 'Konfiguruj przypisania programu';
$string['program:configurecontent'] = 'Konfiguruj zawartość programu';
$string['program:configuremessages'] = 'Konfiguruj wiadomości programu';
$string['program:configureprogram'] = 'Konfiguruj programy';
$string['program:createprogram'] = 'Utwórz programy';
$string['program:handleexceptions'] = 'Obsłuż wyjątki programu';
$string['program:manageextensions'] = 'Zarządzaj rozszerzeniami';
$string['program:viewhiddenprograms'] = 'Wyświetl ukryte programy';
$string['program:viewprogram'] = 'Wyświetl programy';
$string['programassignments'] = 'Przypisania programu';
$string['programassignmentssaved'] = 'Pomyślnie zapisano przypisania programu';
$string['programavailability_help'] = '# Dostępność programu
Ta opcja umożliwia całkowite ukrycie swojego programu.
Nie pojawi się on na żadnych listach programów, chyba że dla administratorów.
Nawet, jeśli uczestnicy będą próbować uzyskać bezpośredni dostęp do adresu URL programu, nie będą oni mogli tam wejść.
W przypadku ustawienia dat \'Dostępne od\' i \'Dostępne do\' uczestnicy będą mogli znaleźć i przejść do programu w okresie określonym przez te daty, ale nie będą mogli tego zrobić poza tym okresem.';
$string['programcategory_help'] = '# Kategorie programu/kursu
Administrator systemu Moodle mógł skonfigurować kilka kategorii programów/kursów.
Na przykład "Nauka", "Humanistyczne", "Zdrowie publiczne" itd.
Wybierz najbardziej odpowiadającą swojemu programowi. Ten wybór będzie wpływał na miejsce wyświetlenia programu na liście programów i ułatwi uczestnikom znalezienie programu.';
$string['programcompleted'] = 'Ukończono program';
$string['programcompletedmessage_help'] = '# Komunikat o ukończeniu programu
Ten komunikat jest wysyłany zawsze, gdy program zostanie ukończony.';
$string['programcompletion'] = 'Ukończenie programu';
$string['programcontent'] = 'Zawartość programu';
$string['programcontentsaved'] = 'Pomyślnie zapisano zawartość programu';
$string['programcreatefail'] = 'Nie można utworzyć programu. Przyczyna: "{$a}"';
$string['programcreatesuccess'] = 'Pomyślnie utworzono program';
$string['programdeletefail'] = 'Nie można usunąć programu "{$a}"';
$string['programdeletesuccess'] = 'Pomyślnie usunięto program "{$a}"';
$string['programdetails'] = 'Szczegóły programu';
$string['programdetailssaved'] = 'Pomyślnie zapisano szczegóły programu';
$string['programdue'] = 'Termin programu';
$string['programduedate'] = 'Termin realizacji programu';
$string['programduemessage_help'] = '# Komunikat o terminie programu
Ten komunikat zostanie wysłany w określonym czasie przed upływem terminu programu.';
$string['programends'] = 'Zakończenie programu';
$string['programexceptions'] = 'Wyjątki programu';
$string['programfullname_help'] = '# Pełna nazwa programu
Pełna nazwa programu jest wyświetlana u góry ekranu i na listach programu.';
$string['programicon'] = 'Ikona programu';
$string['programid'] = 'ID programu';
$string['programidnotfound'] = 'Program nie istnieje dla ID: {$a}';
$string['programidnumber'] = 'Numer ID programu';
$string['programidnumber_help'] = '# Numer ID programu
Numer ID programu jest używany tylko podczas dopasowywania kursu do systemów zewnętrznych - nie jest on nigdy wyświetlany w systemie Moodle. Jeśli masz oficjalną nazwę kodową tego programu, użyj jej tutaj ... w przeciwnym razie pole może pozostać puste.';
$string['programlive'] = 'Przestroga: Program jest w użyciu';
$string['programmandatory'] = 'Obowiązkowy program';
$string['programmessages'] = 'Komunikaty programu';
$string['programmessagessaved'] = 'Zapisano komunikaty programu';
$string['programmessagessavedsuccessfully'] = 'Pomyślnie zapisano komunikaty programu';
$string['programname'] = 'Nazwa programu';
$string['programnotavailable'] = 'Program jest niedostępny dla uczestników';
$string['programnotcurrentlyavailable'] = 'Ten program jest obecnie niedostępny dla uczestników';
$string['programnotlive'] = 'Program nie jest używany';
$string['programoverdue'] = 'Opóźniony program';
$string['programoverduemessage_help'] = '# Komunikat o przeterminowaniu programu
Ten komunikat zostanie wysłany w określonym czasie po upływie terminu programu.';
$string['programrecurring'] = 'Cykl programu';
$string['programs'] = 'Programy';
$string['programscomplete'] = 'Ukończone programy';
$string['programshortname'] = 'Nazwa skrócona programu';
$string['programshortname_help'] = '# Nazwa skrócona programu
Nazwa skrócona programu będzie używana w kilku miejscach, gdzie pełna nazwa jest nieodpowiednia (np. w wierszu tematu komunikatu alarmowego).';
$string['programsinthiscategory'] = 'Programy w tej kategorii ({$a})';
$string['programsmovedout'] = 'Programy przeniesione poza {$a}';
$string['programsummary'] = 'Podsumowanie programu';
$string['programupdatecancelled'] = 'Anulowano aktualizację programu';
$string['programupdatefail'] = 'Niepowodzenie aktualizacji programu';
$string['programupdatesuccess'] = 'Pomyślnie zaktualizowano program';
$string['programvisibility_help'] = '# Widoczność programu
Jeśli program jest widoczny, będzie on występował na listach programów i w wynikach wyszukiwania zaś uczestnicy będą mogli zobaczyć jego zawartość.
Jeśli program jest niewidoczny, nie będzie on występował na listach programów ani w wynikach wyszukiwania, ale będzie nadal wyświetlany w planach nauki wszystkich uczestników, którzy zostali przypisani do programu, zaś uczestnicy będą nadal mieli dostęp do programu o ile będą znać jego adres URL.';
$string['progress'] = 'Postęp';
$string['reason'] = 'Przyczyna rozszerzenia';
$string['reasonforextension'] = 'Przyczyna rozszerzenia';
$string['recurrence_help'] = '# Cykl
Cykl definiuje okres, gdy kurs cykliczny musi zostać powtórzony. Cykl można określić za pomocą dowolnej liczby dni, tygodni lub miesięcy.';
$string['recurring'] = 'Cykl';
$string['recurringcourse'] = 'Kurs cykliczny';
$string['recurringcourse_help'] = '# Kurs cykliczny
Wyświetla wybrany kurs cykliczny.
Tylko jeden kurs może zostać wybrany jako cykliczny. Aby zmienić kurs, wybierz nowy kurs z menu rozwijanego, a następnie kliknij przycisk "Zmień kurs" w celu zapisania zmiany.';
$string['recurringcourseset_help'] = '# Zestaw kursów cyklicznych
Zestaw kursów cyklicznych umożliwia wybranie tylko jednego kursu. Nie można zdefiniować wielu kursów z zestawów kursów i kompetencji.';
$string['recurringprogramhistory'] = 'Rekord historii programu cyklicznego {$a}';
$string['recurringprogramhistoryfor'] = 'Rekord historii dla {$a->username} dla programu cyklicznego {$a->progname}';
$string['recurringprograms'] = 'Programy cykliczne';
$string['removed'] = 'Usunięto';
$string['repeatevery'] = 'Powtarzaj co';
$string['requestextension'] = 'Żądaj rozszerzenia';
$string['requiredlearning'] = 'Wymagana nauka';
$string['requiredlearninginstructions'] = 'Wymagana nauka została pokazana poniżej.';
$string['requiredlearninginstructionsuser'] = 'Wymagana nauka dla {$a} została pokazana poniżej.';
$string['returntoprogram'] = 'Powrót do programu';
$string['rolprogramsourcename'] = 'Rekord nauki: Programy';
$string['saveallchanges'] = 'Zapisz wszystkie zmiany';
$string['saveprogram'] = 'Zapisz program';
$string['searchforindividual'] = 'Wyszukaj osobę według nazwiska lub ID';
$string['searchprograms'] = 'Wyszukaj programy';
$string['select'] = 'Wybierz';
$string['selectcompetency'] = 'Wybierz kompetencję...';
$string['selectcourse'] = 'Wybierz kurs...';
$string['setcompletion'] = 'Ustaw ukończenie';
$string['setfixedcompletiondate'] = 'Ustaw stałą datę ukończenia';
$string['setlabel_help'] = '# Etykieta zestawu kursów
Etykieta zestawu kursów służy do opisu grupowania kursów w ramach zestawu.
Ma to na celu zwiększenie czytelności każdego zestawu i pomóc uczestnikom zrozumieć ścieżkę nauki. Na przykład pierwszy zestaw kursów może mieć nazwę "Faza pierwsza - Wstęp", a drugi zestaw kursów - "Faza druga - Zdrowie i bezpieczeństwo".';
$string['setofcourses'] = 'Zestaw kursów';
$string['setrealistictimeallowance'] = 'Ustaw realistyczny czas dopuszczalny';
$string['settimerelativetoevent'] = 'Ustaw czas względem zdarzenia';
$string['shortname'] = 'Nazwa skrócona';
$string['showingresults'] = 'Wyświetlanie wyników {$a->from} - {$a->to} z {$a->total}';
$string['source'] = 'Źródło';
$string['startdate'] = 'Data rozpoczęcia';
$string['startinposition'] = 'rozpocznij od pozycji';
$string['status'] = 'Stan';
$string['successfullyresolvedexceptions'] = 'Pomyślnie rozwiązano wyjątki';
$string['summary'] = 'Streszczenie';
$string['then'] = 'potem';
$string['therearenoprogramstodisplay'] = 'Brak programów do wyświetlenia.';
$string['thisactioncannotbeundone'] = 'Tej czynności nie można wycofać';
$string['thiswillaffect'] = 'Będzie to miało wpływ na {$a} uczestników';
$string['timeallowance'] = 'Dopuszczalny czas';
$string['timeallowance_help'] = '# Dopuszczalny czas
Określa dopuszczalną ilość czasu na ukończenie kursu w ramach zestawu. Jest to ogólny wskaźnik upływu czasu do zakończenia zestawu, a nie rzeczywisty czas poświęcony na ukończenie kursu. Rzeczywisty czas na ukończenie kursu można ustawić na poziomie kursu.';
$string['toprogram'] = 'do programu';
$string['tosaveassignments'] = 'Aby zapisać wszystkie zmiany przypisań, kliknij przycisk Zapisz wszystkie zmiany. Aby zmodyfikować zmiany przypisań, kliknij przycisk Edytuj przypisania. Nie można wycofać zapisu przypisań.';
$string['tosavecontent'] = 'Aby zapisać wszystkie zmiany zawartości, kliknij przycisk Zapisz wszystkie zmiany. Aby zmodyfikować zmiany zawartości, kliknij przycisk Edytuj zawartość. Nie można wycofać zapisu zmian zawartości.';
$string['tosavemessages'] = 'Aby zapisać wszystkie zmiany wiadomości, kliknij przycisk Zapisz wszystkie zmiany. Aby zmodyfikować zmiany wiadomości, kliknij przycisk Edytuj wiadomości. Nie można wycofać zapisu zmian wiadomości.';
$string['total'] = 'Łącznie';
$string['totalassignments'] = 'Łącznie potencjalnych przypisań';
$string['totalassignments_help'] = '# Przypisania łącznie
Łączna liczba przypisań wyświetlana na stronie przypisań programu i stronie przeglądu reprezentuje łączną liczbę uczestników we wszystkich przypisanych kategoriach, a nie liczbę uczestników aktualnie przypisanych do programu.
Jeśli uczestnik należy do organizacji przypisanej do programu i zajmuje również stanowisko przypisane do programu, wtedy będzie on liczony w każdej kategorii (ale zostanie tylko raz przypisany do programu).';
$string['trigger_help'] = '# Wyzwalacz
Czas wyzwolenia określa, kiedy zostanie wysłany komunikat związany z opisanym zdarzeniem (np. 4 tygodnie po ukończeniu programu).';
$string['type'] = 'Typ';
$string['unenrolment'] = 'Anulowanie rejestracji';
$string['unenrolmentmessage_help'] = '# Komunikat o wyrejestrowaniu
Ten komunikat zostanie wysłany zawsze, gdy użytkownik zostanie wyrejestrowany z programu.';
$string['unknownexception'] = 'Nieznany wyjątek';
$string['unknownusersrequiredlearning'] = 'Nieznana wymagana nauka użytkownika';
$string['unresolvedexceptions'] = '{$a} nierozwiązanych problemów';
$string['untitledset'] = 'Zestaw bez tytułu';
$string['update'] = 'Aktualizuj';
$string['updateextensionfailall'] = 'Nie można zaktualizować wszystkich rozszerzeń';
$string['updateextensionfailcount'] = 'Nie można zaktualizować {$a} rozszerzeń';
$string['updateextensions'] = 'Aktualizuj rozszerzenia';
$string['updateextensionsuccess'] = 'Pomyślnie zaktualizowano wszystkie rozszerzenia';
$string['userid'] = 'ID użytkownika';
$string['variablesubstitution_help'] = '# Zastępowanie zmiennych
W komunikatach programu można wstawiać pewne zmienne do tematu i/lub treści komunikatu po to, aby zastąpić je wartościami rzeczywistymi w chwili wysyłania komunikatu. Zmienne powinny być wstawiane do tekstu dokładnie w sposób pokazany poniżej. Można użyć następujących zmiennych:
%programfullname%
: Zostanie ona zastępiona przez pełną nazwę programu
%setlabel%
: Zostanie ona zastąpiona przez etykietę zestawu kursów (zostanie ona zastąpiona tylko, jeśli komunikat dotyczy zestawu kursów)';
$string['viewallprograms'] = 'Wyświetl wszystkie programy';
$string['viewallrequiredlearning'] = 'Wyświetl wszystko';
$string['viewexceptions'] = 'Wyświetl raport o wyjątkach, aby usunąć problemy.';
$string['viewinguserextrequests'] = 'Wyświetlanie żądań rozszerzenia dla {$a}';
$string['viewingxusersprogram'] = 'Wyświetlasz postęp <a href="{$a->wwwroot}/user/view.php?id={$a->id}">{$a->fullname}\'s</a> w tym programie.';
$string['viewprogram'] = 'Wyświetl program';
$string['viewprogramassignments'] = 'Wyświetl przypisania programu';
$string['viewprogramdetails'] = 'Wyświetl szczegóły programu';
$string['viewrecurringprogramhistory'] = 'Wyświetl historię';
$string['visible'] = 'Widoczne';
$string['weeks'] = 'Tygodnie';
$string['xlearnerscurrentlyenrolled'] = 'Istnieje {$a} uczestników obecnie zapisanych na ten program.';
$string['xsrequiredlearning'] = 'Wymagana nauka {$a}';
$string['years'] = 'Rok (lata)';
$string['youareviewingxsrequiredlearning'] = 'Wyświetlasz wymaganą naukę <a href="{$a->site}/user/view.php?id={$a->userid}">{$a->name}\'s</a>.';
$string['youhaveadded'] = 'Dodano {$a->itemnames} do tego programu<br />
<br />
<strong>Spowoduje to przypisanie {$a->affectedusers} użytkowników do programu</strong><br />
<br />
Ta zamiana zostanie zastosowana po kliknięciu przycisku Zapisz wszystkie zmiany na głównym ekranie przypisań programu';
$string['youhavemadefollowingchanges'] = 'W tym programie zostały dokonane następujące zmiany';
$string['youhaveremoved'] = 'Usunięto {$a->itemname} z tego programu<br />
<br />
<strong>Spowoduje to anulowanie przypisania {$a->affectedusers} użytkowników do programu</strong><br />
<br />
Ta zamiana zostanie zastosowana po kliknięciu przycisku Zapisz wszystkie zmiany na głównym ekranie przypisań programu';
$string['youhaveunsavedchanges'] = 'Masz niezapisane zmiany.';
$string['youmustcompletebeforeproceedingtolearner'] = 'Musisz ukończyć {$a->mustcomplete} przed przejściem do ukończenia {$a->proceedto}';
$string['youmustcompletebeforeproceedingtomanager'] = 'musisz ukończyć {$a->mustcomplete} przed przejściem do ukończenia {$a->proceedto}';
$string['youmustcompletebeforeproceedingtoviewing'] = 'Uczestnik musi ukończyć {$a->mustcomplete} przed przejściem do ukończenia {$a->proceedto}';
$string['youmustcompleteorlearner'] = 'Musisz ukończyć {$a}';
$string['youmustcompleteormanager'] = 'musisz ukończyć {$a}';
$string['youmustcompleteorviewing'] = 'Uczestnik musi ukończyć {$a}';
$string['z:incompleterecurringprogrammessage'] = 'Kurs w programie cyklicznym, na który masz rejestrację, osiągnął datę ukończenia, ale kurs nie został przez Ciebie ukończony. Musisz ukończyć ten kurs, aby spełnić wymagania programu.';
$string['z:incompleterecurringprogramsubject'] = 'Niekompletny kurs cykliczny';
