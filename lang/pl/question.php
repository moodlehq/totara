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
 * Strings for component 'question', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Akcja';
$string['addanotherhint'] = 'Dodaj kolejną podpowiedź';
$string['addcategory'] = 'Dodaj kategorię';
$string['adminreport'] = 'Raportuj o możliwych problemach w twojej bazie pytań.';
$string['answer'] = 'Odpowiedź';
$string['answersaved'] = 'Odpowiedź zapisana';
$string['attemptfinished'] = 'Próba zakończona';
$string['attemptfinishedsubmitting'] = 'Próba zakończona przesłaniem:';
$string['availableq'] = 'Dostępny?';
$string['behaviour'] = 'Zachowanie';
$string['behaviourbeingused'] = 'zachowanie użyte: {$a}';
$string['broken'] = 'To jest nieprawidłowe łącze, wskazuje na nieistniejący plik.';
$string['byandon'] = 'przez <em>{$a->user}</em> o <em>{$a->time}</em>';
$string['cannotcopybackup'] = 'Nie można skopiować pliku kopii zapasowej';
$string['cannotcreatepath'] = 'Nie udało się utworzyć ścieżki: {$a}';
$string['cannotdeleteqtypeinuse'] = 'Nie można usunąć pytania typu \'{$a}\'. W bazie pytań znajdują się pytania tego typu.';
$string['cannotdeleteqtypeneeded'] = 'Nie można usunąć pytanie typu \'{$a}\'. Istnieją inne rodzaje zainstalowanych pytań, które są od niego zależne.';
$string['cannotloadquestion'] = 'Nie można załadować pytania';
$string['cannotpreview'] = 'Nie można wyświetlić podglądu tego pytania!';
$string['cannotread'] = 'Nie można odczytać pliku do importu (lub plik jest pusty)';
$string['cannotunzip'] = 'Nie można rozpakować pliku.';
$string['categorycurrent'] = 'Bieżąca kategoria';
$string['categorycurrentuse'] = 'Użyj tej kategorii';
$string['categorydoesnotexist'] = 'Ta kategoria nie istnieje';
$string['categoryinfo'] = 'Informacje na temat kategorii';
$string['categorymove'] = 'Kategoria \'{$a->name}\' zawiera {$a->count} pytań. Wybierz kategorię, do której mają one zostać przeniesione';
$string['categorymoveto'] = 'Zapisz w kategorii';
$string['changepublishstatuscat'] = 'Status współdzielenia <a href="{$a->caturl}">Kategorii "{$a->name}"</a> z kursu "{$a->coursename}" zostanie zmieniony z <strong>{$a->changefrom} na {$a->changeto}</strong>.';
$string['chooseqtypetoadd'] = 'Wybierz rodzaj nowego pytania';
$string['copy'] = 'Skopiuj z {$a} i zmień łącza';
$string['created'] = 'Utworzony';
$string['createdby'] = 'Utworzony przez';
$string['createdmodifiedheader'] = 'Utworzony / ostatnio zapisany';
$string['createnewquestion'] = 'Utwórz nowe pytanie ...';
$string['cwrqpfs'] = 'Losowe pytania wybierające pytania z podkategorii.';
$string['cwrqpfsinfo'] = 'Podczas aktualizacji do Moodle 1.9 podzielimy kategorie pytań na różne konteksty. Status współdzielenia niektórych kategorii i pytań będzie musiał zostać zmieniony. Jest to konieczne w rzadkim przypadku, kiedy jedno lub więcej \'losowych\' pytań wybiera pytania z mieszanki kategorii współdzielonych i niewspółdzielonych (tak jak w przypadku tej strony). Zdarza się tak, kiedy \'losowe\' pytanie wybiera pytania z podkategorii i jedna lub więcej podkategorii ma status współdzielenia różny od kategorii nadrzędnej, w której zawiera się pytanie losowe.</p>
<p>Podczas aktualizacji do Moodle 1.9 status współdzielenia poniższych kategorii pytań (z których \'losowe\' pytania kategorii nadrzędnej wybierają pytania) zostanie zmieniony na taki, jaki jest status kategorii zawierającej pytanie losowe. Poniższe kategorie będą miały zmieniony status współdzielenia. Wszystkie pytania we wszystkich quizach będą nadal działać (dopóki ich nie usuniesz).</p>';
$string['cwrqpfsnoprob'] = 'Problem "losowych pytań wybierających pytania z podkategorii" nie dotyczy żadnego z istniejących pytań.';
$string['defaultfor'] = 'Domyślnie dla {$a}';
$string['defaultinfofor'] = 'Domyślna kategoria dla pytań współdzielonych w kontekście \'{$a}\'.';
$string['deleteqtypeareyousure'] = 'Czy na pewno chcesz usunąć pytanie typu \'{$a}\'?';
$string['deleteqtypeareyousuremessage'] = 'Zamierzasz całkowicie usunąć pytanie typu \'{$a}\'. Czy na pewno chcesz je odinstalować?';
$string['deletingqtype'] = 'Usuwanie pytania typu: \'{$a}\'';
$string['disabled'] = 'Wyłączone';
$string['donothing'] = 'Nie kopiuj, nie przenoś plików ani nie zmieniaj łączy.';
$string['editcategories'] = 'Edytuj kategorie';
$string['editingcategory'] = 'Edycja kategorii';
$string['editingquestion'] = 'Edycja pytania';
$string['editthiscategory'] = 'Edytuj tą kategorię';
$string['enabled'] = 'Włączony';
$string['erroraccessingcontext'] = 'Nie można uzyskać dostępu do kontekstu';
$string['errordeletingquestionsfromcategory'] = 'Błąd podczas usuwania pytań z kategorii {$a}.';
$string['errorfilecannotbecopied'] = 'Błąd podczas kopiowania pliku {$a}.';
$string['errorfilecannotbemoved'] = 'Błąd podczas przenoszenia pliku {$a}.';
$string['exportcategory'] = 'Eksportuj kategorię';
$string['exportfilename'] = 'quiz';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['exportquestions'] = 'Eksportuj pytania do pliku';
$string['exportquestions_help'] = '<P ALIGN=CENTER><B>Eksportowanie pytań danej kategorii</B></P>

<P>Ta funkcja eksportuje całą kategorię do pliku tekstowego.

<p>Zwracamy uwagę na to, że wiele formatów nie obsługuje wszystkich
informacji o pytaniach i te informacje zostaną utracone. Nie należy
się spodziewać, że wyeksportowanie kategorii i późniejsze zaimportowanie
da zestaw takich samych pytań. Ponadto niektóre typy pytań mogą się zupełnie nie wyeksportować, jeśli nie są obsługiwane w danym formacie.</p>

<P>Obecnie wspierane formaty to:</p>

<P><B>Format GIFT</B></P>
<ul>
<p>Format GIFT jest najbardziej wszechstronnym formatem. Został zaprojektowany jako prosta metoda dla nauczycieli tworzacych pytania jako plik tekstowy. GIFT obsługuje pytania Wielokrotnego wyboru, Prawda-Fałsz, Krótkie odpowiedzi, Dopasuj odpowiedź, Numeryczne jak i zadania typu "wstaw brakujące słowo".</p>

<p>Kilka typów pytań może być użyytych w jednym pliku tekstowym. Ponadto format ten zezwala na umieszczanie komentarzy, nazw pytań, informacji zwrotnych i ważenie ocen. </p>

<p>Oto kilka przykładów:</p>

<pre>
CzasNaE-Biznes to?{~codzienna gazeta ~książka =serwis www i e-zin}

CzasNaE-Biznes to {~codzienna gazeta ~książka =serwis www} o marketingu i biznesie.

CzasNaE-Biznes to codzienna gazeta.{FALSE}

CzasNaE-Biznes to?{=serwis www =e-zin}

Kiedy powstał CzasNaE-Biznes?{#2000}
</pre>

<p align=right><a href="help.php?file=formatgift.html&module=quiz">Więcej o formacie GIFT</a></p>
</ul>

<P>Tworzymy już nowe formaty: WebCT, IMS QTI i cokolwiek jeszcze zapragną członkowie społeczności Moodle! </p>';
$string['fileformat'] = 'Format pliku';
$string['filesareacourse'] = 'Obszar plików kursu';
$string['filesareasite'] = 'Obszar plików witryny';
$string['filestomove'] = 'Przenieść / skopiować pliki do {$a}?';
$string['fractionsnomax'] = 'Jedna z odpowiedzi powinna być warta 100%, aby można było otrzymać całą ocenę za to pytanie.';
$string['getcategoryfromfile'] = 'Pobierz kategorię z pliku';
$string['getcontextfromfile'] = 'Pobierz kontekst z pliku';
$string['ignorebroken'] = 'Ignoruj niedziałające łącza';
$string['importcategory'] = 'Import kategorii';
$string['importquestions'] = 'Importuj pytania z pliku';
$string['includesubcategories'] = 'Pokaż także pytania z podkategorii';
$string['lastmodifiedby'] = 'Ostatnio zmieniony przez';
$string['linkedfiledoesntexist'] = 'Powiązany plik {$a} nie istnieje';
$string['makechildof'] = 'Utwórz potomka \'{$a}\'';
$string['maketoplevelitem'] = 'Przesuń na poziom nadrzędny';
$string['matchgrades'] = 'Pasujący stopień';
$string['missingimportantcode'] = 'W pytaniu pojawił się błąd kodu: {$a}.';
$string['modified'] = 'Ostatnio zapisano';
$string['move'] = 'Przenieś z {$a} i zmień łącza';
$string['movecategory'] = 'Przenieś kategorię';
$string['movedquestionsandcategories'] = 'Przeniesione pytania i kategorie pytań z {$a->oldplace} do {$a->newplace}.';
$string['movelinksonly'] = 'Tylko zmień adres docelowy łączy, nie przesuwaj ani nie kopiuj plików.';
$string['moveq'] = 'Przesuń pytanie(a)';
$string['moveqtoanothercontext'] = 'Przesuń pytanie do innego kontekstu';
$string['moveto'] = 'Przenieś do >>';
$string['movingcategory'] = 'Przenoszenie kategorii';
$string['movingcategoryandfiles'] = 'Czy jesteś pewien, że chcesz przenieść kategorię {$a->name} ze wszystkimi podkategoriami do kontekstu "{$a->contextto}"?<br /> {$a->urlcount} plików jest powiązanych z pytaniami w {$a->fromareaname}. Czy chcesz skopiować lub przesunąć te pliki do {$a->toareaname}?';
$string['movingcategorynofiles'] = 'Czy jesteś pewien, że chcesz przesunąć kategorię "{$a->name}" wraz ze wszystkimi podkategoriami do kontekstu "{$a->contextto}"?';
$string['movingquestions'] = 'Przenoszenie pytań i plików';
$string['movingquestionsandfiles'] = 'Czy jesteś pewien, że chcesz przenieść pytanie(a) {$a->questions} do kontekstu <strong>"{$a->tocontext}"</strong>?<br /> <strong>{$a->urlcount} plików</strong> jest powiązanych z tym(i) pytaniem(ami) w {$a->fromareaname}. Czy chcesz skopiować lub przesunąć te pliki do {$a->toareaname}?';
$string['movingquestionsnofiles'] = 'Czy jesteś pewien, że chcesz przenieść pytanie(a) {$a->questions} do kontekstu <strong>"{$a->tocontext}"</strong>?<br /> <strong>Nie ma plików</strong> powiązanych z tymi pytaniami w {$a->fromareaname}.';
$string['needtochoosecat'] = 'Wybierz kategorię, do której przesunąć to pytanie lub wciśnij \'Anuluj\'.';
$string['nocate'] = 'Nie ma takiej kategorii: {$a}';
$string['nopermissionadd'] = 'Nie masz uprawnień do dodawania tutaj pytań.';
$string['nopermissionmove'] = 'Nie masz uprawnień do przeniesienia pytania tutaj. Musisz zapisać pytanie w tej kategorii lub zapisać je jako nowe pytanie.';
$string['noprobs'] = 'Nie wykryto błędów w bazie danych zapytań.';
$string['noquestionsinfile'] = 'Nie ma pytań w importowanym pliku';
$string['noresponse'] = '[Brak odpowiedzi]';
$string['notenoughanswers'] = 'Ten typ pytania wymaga co najmniej {$a} odpowiedzi';
$string['notenoughdatatoeditaquestion'] = 'Ani ID pytania ani ID kategorii i typ pytania nie zostały określone.';
$string['notenoughdatatomovequestions'] = 'Podaj id pytań, które chcesz przesunąć.';
$string['numquestions'] = 'Ilość pytań';
$string['numquestionsandhidden'] = '{$a->numquestions} (+  {$a->numhidden} ukrytych)';
$string['options'] = 'Opcje';
$string['parentcategory'] = 'Kategoria nadrzędna';
$string['penaltyfactor'] = 'Mnożnik kary';
$string['penaltyfactor_help'] = '<p>Możesz określić ile ma zostać odjęte za każdym razem od nieprawidłowej odpowiedzi. To działa tylko gdy quiz jest w trybie adaptacyjnym w którym student może wielekrotnie odpowiadać na pytanie. Współczynnik kary może być liczbą od 0 do 1. Współczynnik kary równy 1 oznacza że student musi udzielić poprawnej odpowiedzi za 1 razem. Współczynnik kary równy 0 oznacza ze student może próbować odpowiadać dowolną liczbę razy i wciąż dostanie maksymalną ilość punktów za pytanie. </p>';
$string['permissionedit'] = 'Edytuj to pytanie.';
$string['permissionmove'] = 'Przesuń to pytanie.';
$string['permissionsaveasnew'] = 'Zapisz to pytanie jako nowe.';
$string['permissionto'] = 'Masz uprawnienia do:';
$string['published'] = 'współdzielony';
$string['qtypeveryshort'] = 'T';
$string['questionaffected'] = '<a href="{$a->qurl}">Pytanie "{$a->name}" ({$a->qtype})</a> istnieje w tej kategorii pytań, ale także jest używane w <a href="{$a->qurl}">quizie "{$a->quizname}"</a> w innym kursie "{$a->coursename}".';
$string['questionbank'] = 'Baza pytań';
$string['questioncategory'] = 'Kategoria pytań';
$string['questioncatsfor'] = 'Kategorie pytań dla \'{$a}\'';
$string['questiondoesnotexist'] = 'To pytanie nie istnieje';
$string['questionname'] = 'Nazwa pytania';
$string['questiontext'] = 'Tekst pytania';
$string['questiontype'] = 'Typ pytania';
$string['questionuse'] = 'Użyj pytania w tej aktywności';
$string['selectacategory'] = 'Wybierz kategorię:';
$string['selectaqtypefordescription'] = 'Wybierz rodzaj pytania, aby zobaczyć jego opis.';
$string['selectcategoryabove'] = 'Wybierz jedną z powyższych kategorii';
$string['shareincontext'] = 'Udostępnij w kontekście {$a}';
$string['showhidden'] = 'Pokaż także stare pytania';
$string['showquestiontext'] = 'Pokaż tekst pytania na liście pytań';
$string['stoponerror'] = 'Zatrzymaj na błędzie';
$string['tofilecategory'] = 'Zapisz kategorię do pliku';
$string['tofilecontext'] = 'Zapisz kontekst do pliku';
$string['uninstallqtype'] = 'Odinstaluj ten typ pytania.';
$string['unknown'] = 'Nieznany';
$string['unknownquestiontype'] = 'Nieznany typ pytania: {$a}.';
$string['unpublished'] = 'nieudostępniony';
$string['youmustselectaqtype'] = 'Musisz wybrać typ pytania.';
