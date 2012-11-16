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
 * Strings for component 'certificate', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = 'Dodaj inną opcję powiązanej czynności';
$string['addlinktitle'] = 'Kliknij, aby dodać inną opcję powiązanej czynności';
$string['awarded'] = 'Przyznane';
$string['awardedto'] = 'Przyznane dla';
$string['back'] = 'Z powrotem';
$string['border'] = 'Obramowanie';
$string['borderblack'] = 'Czarny';
$string['borderblue'] = 'Niebieski';
$string['borderbrown'] = 'Brązowy';
$string['bordercolor'] = 'Linie ramki';
$string['bordergreen'] = 'Zielony';
$string['borderlines'] = 'Linie';
$string['borderstyle'] = 'Obraz ramki';
$string['certificate'] = 'Weryfikacja kodu certyfikatu:';
$string['certificate:manage'] = 'Zarządzaj Certyfikatem';
$string['certificate:printteacher'] = 'Wydrukuj wykładowcę';
$string['certificate:student'] = 'Pobierz certyfikat';
$string['certificate:view'] = 'Zobacz certyfikat';
$string['certificatename'] = 'Nazwa certyfikatu';
$string['certificatereport'] = 'Raport o certyfikatach';
$string['certificatesfor'] = 'Certyfikaty dla';
$string['certificatetype'] = 'Typ certyfikatu';
$string['certify'] = 'Zaświadcza się, że';
$string['code'] = 'Kod';
$string['course'] = 'dla';
$string['coursegrade'] = 'Ocena kursu';
$string['coursename'] = 'Kurs';
$string['credithours'] = 'Godziny kredytu';
$string['customtext'] = 'Tekst niestandardowy';
$string['date'] = 'Dnia';
$string['datefmt'] = 'Format daty';
$string['datefmt_help'] = '**Drukuj datę**

Wybierz format daty do wydrukowania daty na certyfikacie.';
$string['datehelp'] = 'Data';
$string['delivery_help'] = '**Dostawa**

Wybierz tutaj sposób otrzymywania certyfikatów przez uczestników.
**Otwórz w przeglądarce:** Otwiera certyfikat w nowym oknie przeglądarki.
**Wymuszaj pobranie:** Otwiera okno pobierania pliku przeglądarki. **(Uwaga: **Program Internet Explorer nie obsługuje opcji otwierania z okna pobierania. Najpierw należy wybrać opcję Zapisz.)
**Wyślij certyfikat pocztą elektroniczną:** Wybranie tej opcji powoduje wysłanie do uczestnika certyfikatu jako załącznika do wiadomości e-mail.
Po otrzymaniu certyfikatu przez uczestnika, w razie ponownego kliknięcia łącza certyfikatu, zostanie wyświetlona data otrzymania własnego certyfikatu i uczestnik będzie mógł obejrzeć otrzymany certyfikat.';
$string['designoptions'] = 'Opcje projektu';
$string['download'] = 'Wymuszaj pobieranie';
$string['emailcertificate'] = 'Adres e-mail (trzeba również wybrać zapis!)';
$string['emailothers'] = 'Wyślij wiadomość e-mail do innych';
$string['emailothers_help'] = '**Alerty w wiadomościach e-mail dla innych**

Wprowadź tutaj rozdzielone przecinkami adresy e-mail tych osób, które powinny zostać powiadomione krótką wiadomością e-mail zawsze, gdy uczestnik otrzyma certyfikat.';
$string['emailstudenttext'] = 'Dołączono certyfikat dla {$a->course}.';
$string['emailteachermail'] = '{$a->student} otrzymał swój certyfikat: \'{$a->certificate}\' dla {$a->course}.';
$string['emailteachermailhtml'] = '{$a->student} otrzymał swój certyfikat: \'<i>{$a->certificate}</i>\' dla {$a->course}.

Możesz go przejrzeć tutaj:

<a href="{$a->url}">Certificate Report</a>.';
$string['emailteachers'] = 'Wyślij wiadomość e-mail do wykładowców';
$string['emailteachers_help'] = '**Alerty w wiadomościach e-mail dla wykładowców**

W przypadku włączenia tej opcji wykładowcy zostaną powiadomieni krótką wiadomością e-mail zawsze, gdy uczestnik otrzyma certyfikat.';
$string['entercode'] = 'Wprowadź kod certyfikatu w celu weryfikacji:';
$string['getcertificate'] = 'Pobierz certyfikat';
$string['grade'] = 'Ocena';
$string['gradedate'] = 'Data oceny';
$string['gradefmt_help'] = '**Format oceny**

W przypadku wybrania opcji drukowania oceny na certyfikacie będą dostępne trzy formaty:

**Ocena procentowa:** Drukuje ocenę jako wartość procentową.**
Ocena punktowa: **Drukuje wartość punktową oceny.
**Ocena literowa:** Drukuje wartość procentową oceny jako literę. Wartości ocen literowych można dostosować w pliku type/certificate.php.';
$string['gradeletter'] = 'Litera oceny';
$string['gradepercent'] = 'Ocena procentowa';
$string['gradepoints'] = 'Ocena punktowa';
$string['incompletemessage'] = 'Aby pobrać certyfikat, musisz najpierw wykonać wszystkie wymagane czynności. Wróć do kursu, aby wykonać prace kursowe.';
$string['intro'] = 'Wprowadzenie';
$string['issued'] = 'Wydany';
$string['issueoptions'] = 'Opcje wydania';
$string['lockingoptions'] = 'opcje blokowania';
$string['modulename'] = 'Certyfikat';
$string['modulenameplural'] = 'Certyfikaty';
$string['mycertificates'] = 'Moje certyfikaty';
$string['nocertificates'] = 'Brak certyfikatów';
$string['nocertificatesreceived'] = 'nie otrzymał żadnych certyfikatów kursów.';
$string['nogrades'] = 'Brak dostępnych ocen';
$string['notapplicable'] = 'N/D';
$string['notfound'] = 'Nie można sprawdzić numeru certyfikatu.';
$string['notissued'] = 'Nie otrzymano';
$string['notissuedyet'] = 'Jeszcze nie wystawiono';
$string['notreceived'] = 'Nie otrzymujesz tego certyfikatu';
$string['openbrowser'] = 'Otwórz w nowym oknie';
$string['opendownload'] = 'Kliknij przycisk poniżej, aby zapisać swój certyfikat na komputerze.';
$string['openemail'] = 'Kliknij przycisk poniżej a Twój certyfikat zostanie wysłany jako załącznik do wiadomości e-mail.';
$string['openwindow'] = 'kliknij przycisk poniżej, aby otworzyć certyfikat w nowym oknie przeglądarki.';
$string['or'] = 'lub';
$string['pluginadministration'] = 'Administracja Certyfikatem';
$string['pluginname'] = 'Certyfikat';
$string['printdate'] = 'Data wydruku';
$string['printdate_help'] = '**Drukuj datę**

Jest to data, która zostanie wydrukowana w przypadku wybrania opcji drukowania daty. W przypadku wybrania daty zakończenia kursu należy włączyć zakres dat i ustawić datę zakończenia kursu w ustawieniach kursu. Jeśli data zakończenia kursu nie jest ustawiona, zostanie wydrukowana data otrzymania. Można również wybrać wydruk daty oceny czynności. Jeśli certyfikat zostanie wystawiony przed oceną tej czynności, zostanie wydrukowana data otrzymania.
Należy zauważyć, że po wydrukowaniu daty na certyfikacie nie można jej zmienić, chyba że zostanie dostosowany plik type/certificate.php.';
$string['printerfriendly'] = 'Strona przeznaczona do wydruku';
$string['printgrade'] = 'Drukuj ocenę';
$string['printhours'] = 'Drukuj godziny kredytu';
$string['printhours_help'] = '**Drukuj godziny kredytu**

Wprowadź tutaj liczbę godzin kredytu do wydrukowania na certyfikacie.';
$string['printnumber_help'] = '**Drukowanie numeru kodu**

Na certyfikacie można wydrukować unikalny 10-znakowy kod skłądający się z losowych liter i cyfr. Ten numer można następnie zweryfikować, porównując go z numerem kodu wyświetlanym w raporcie wykładowcy "Wyświetl wystawione certyfikaty".';
$string['printoutcome'] = 'Drukuj wynik';
$string['printseal'] = 'Obraz pieczęci lub logo';
$string['printsignature'] = 'Obraz podpisu';
$string['printteacher'] = 'Drukuj nazwisko nauczyciela(i)';
$string['printteacher_help'] = '**Drukuj wykładowcę**

Aby wydrukować nazwisko wykładowcy na certyfikacie, należy ustawić rolę wykładowcy na poziomie modułu. Należy to zrobić, na przykład, wtedy, gdy na kursie był więcej niż jeden wykładowca lub na kursie został uzyskany więcej niż jeden certyfikat i na każdym certyfikacie ma zostać wydrukowane inne nazwisko wykładowcy. Kliknij, aby edytować certyfikat, a następnie kliknij kartę Role przypisane lokalnie. Następnie przypisz rolę wykładowcy (edycja wykładowców) do certyfikatu (nie MUSI to być wykładowca na kursie -- tę rolę można przypisać komukolwiek). Ta nazwiska zostaną wydrukowane na certyfikacie jako wykładowcy.';
$string['printwmark'] = 'Obraz znaku wodnego';
$string['receivedcerts'] = 'Otrzymane certyfikaty';
$string['receiveddate'] = 'Data otrzymania';
$string['report'] = 'Raport';
$string['reportcert_help'] = '**Raportuj certyfikat**

W przypadku ustawienia tej opcji na Tak w raportach certyfikatów użytkownika zostanie pokazana data otrzymania certyfikatu, numer kodu i nazwa kursu. W przypadku wybrania opcji drukowania oceny na tym certyfikacie zostanie ona również pokazana w raporcie certyfikatu.';
$string['reviewcertificate'] = 'Przejrzyj certyfikat';
$string['savecert'] = 'Zapisz Certyfikaty';
$string['sigline'] = 'linia';
$string['statement'] = 'ukończył(a) kurs';
$string['textoptions'] = 'Opcje tekstu';
$string['to'] = 'Przyznany';
$string['validate'] = 'Weryfikuj';
$string['verifycertificate'] = 'Weryfikuj certyfikat';
$string['viewcertificateviews'] = 'Wyświetl {$a} wystawionych certyfikatów';
$string['viewed'] = 'Otrzymujesz ten certyfikat w dniu:';
$string['viewtranscript'] = 'Wyświetl certyfikaty';
