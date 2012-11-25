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
 * Strings for component 'certificate', language 'de', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = 'Add another linked activity option';
$string['addlinktitle'] = 'Click to add another linked activity option';
$string['awarded'] = 'Zertifikat erstellt';
$string['awardedto'] = 'Zertifikat erstellt für';
$string['back'] = 'Back';
$string['border'] = 'Rahmen';
$string['borderblack'] = 'Schwarz';
$string['borderblue'] = 'Blau';
$string['borderbrown'] = 'Brown';
$string['bordercolor'] = 'Rahmenfarbe';
$string['bordergreen'] = 'Grün';
$string['borderlines'] = 'Linien';
$string['borderstyle'] = 'Rahmentyp';
$string['certificate'] = 'Verification for certificate code:';
$string['certificate:manage'] = 'Manage Certificate';
$string['certificate:printteacher'] = 'Print Teacher';
$string['certificate:student'] = 'Get Certificate';
$string['certificate:view'] = 'View Certificate';
$string['certificatename'] = 'Certificate Name';
$string['certificatereport'] = 'Certificates Report';
$string['certificatesfor'] = 'Certificates for';
$string['certificatetype'] = 'Zertifikatsformat';
$string['code'] = 'Code';
$string['course'] = 'For';
$string['coursegrade'] = 'Kursbewertung';
$string['coursename'] = 'Course';
$string['credithours'] = 'Credit Hours';
$string['customtext'] = 'Custom Text';
$string['date'] = 'On';
$string['datefmt_help'] = 'Wenn Sie ein Datum mit ausdrucken wollen, können Sie hier das Datumsformat wählen.';
$string['datehelp'] = 'Datum';
$string['delivery_help'] = 'Wählen Sie wie das Zertifikat angezeigt werden soll.
**In einem neuen Fenster anzeigen:** Öffnet das Zertifikat in einem neuen Browserfenster.
**Download:** Öffnet ein Download-Fenster. **(Anmerkung: **Der Internet Explorer unterstützt die Funktion des direkten Öffnens nicht. Die Datei muß erst gespeichert werden.)
**E-Mail:** Das Zertifikat wird per E-Mail als Dateianhang versandt.
Wenn die Teilnehmer/innen ihre Zertifikate erhalten haben können Sie auch später noch einmal das Zertifikat abfordern. Dabei wird als Datum das Datum der ersten Erstellung gedruckt.';
$string['designoptions'] = 'Design Options';
$string['download'] = 'Download';
$string['emailcertificate'] = 'E-Mail-Dateianhang';
$string['emailstudenttext'] = 'Im Anhang finden Sie Ihr Zertifikat zum Kurs \'{$a->course}\'.';
$string['emailteachermail'] = '{$a->student} hat das \'{$a->certificate}\' für den Kurs \'{$a->course}\' erhalten.';
$string['emailteachermailhtml'] = '{$a->student} hat das \'<i>{$a->certificate}</i>\' für den Kurs \'{$a->course}\' erhalten.

You can review it here:

<a href="{$a->url}">Certificate Report</a>.';
$string['emailteachers'] = 'E-Mail an Trainer/innen';
$string['emailteachers_help'] = 'Die Trainer/innen erhalten eine kurze E-Mailnachricht wenn für Teilnehmer/innen ein Zertifikat erstellt wurde, wenn Sie diese Funktion aktivieren.';
$string['entercode'] = 'Zertifikatscode für Verifizierung eingeben:';
$string['getcertificate'] = 'Hier erhalten Sie Ihr Zertifikat';
$string['grade'] = 'Bewertung';
$string['gradedate'] = 'Bewertungsdatum';
$string['gradefmt_help'] = '**Format der Bewertung**

Wählen Sie zwischen drei verschiedenen Formaten für die Bewertung:

**Prozentwert:** Druckt die Bewertung als Prozentwert.**
Punkte: **Druckt den Punktwert.
**Buchstabennote:** Wandelt den Prozentwert in eine Buchstabennote um. Die Werte können angepasst werden unter type/certificate.php.';
$string['gradeletter'] = 'Note';
$string['gradepercent'] = 'Prozentwert als Note';
$string['gradepoints'] = 'Punkte als Note';
$string['incompletemessage'] = 'In order to download your certificate, you must first complete all required activities. Please return to the course to complete your coursework.';
$string['intro'] = 'Einleitung';
$string['issued'] = 'ausgestellt';
$string['issueoptions'] = 'Issue Options';
$string['lockingoptions'] = 'Locking Options';
$string['modulename'] = 'Zertifikat';
$string['modulenameplural'] = 'Zertifikate';
$string['mycertificates'] = 'My Certificates';
$string['nocertificatesreceived'] = 'has not received any course certificates.';
$string['nogrades'] = 'Keine Bewertungen vorhanden';
$string['notapplicable'] = 'N/A';
$string['notfound'] = 'The certificate number could not be validated.';
$string['notissued'] = 'Nicht ausgestellt';
$string['notissuedyet'] = 'Bisher noch nicht ausgestellt';
$string['notreceived'] = 'Sie haben das Zertifikat noch nicht erhalten';
$string['openbrowser'] = 'In einem neuen Fenster anzeigen';
$string['opendownload'] = 'Klicken Sie den Button, um das Zertifikat auf dem PC zu speichern.';
$string['openemail'] = 'Klicken Sie den Button. Das Zertifikat wird Ihnen per E-Mail zugesandt.';
$string['openwindow'] = 'Klicken Sie den Button, um das Zertifikat in einem neuen Fenster zu öffnen.';
$string['printdate'] = 'Datum drucken';
$string['printdate_help'] = '**Datumsdruck**

Dieses Datum wird auf dem Zertifikat gedruckt, wenn die Datumsdruckfunktion aktiv ist: Datum des Kursendes (muß in den Einstellungen definiert sein und die Option "Abschalten" muß deaktiviert sein)
Nachdem ein Zertifikat erstellt wurde kann diese Einstellung nur umgestellt werden wenn zugleich ein anderer Zertifikatstyp gewählt wird.';
$string['printerfriendly'] = 'Druckerfreundliche Seite';
$string['printgrade'] = 'Bewertung drucken';
$string['printhours'] = 'Print Credit Hours';
$string['printhours_help'] = '**Print Credit Hours**

Enter here the number of credit hours to be printed on the certificate.';
$string['printnumber_help'] = '**Code drucken**

Ein einmaliger 10-stelliger Code aus Buchstaben und Zahlen kann auf dem Zertifikat ausgedruckt werden. Damit kann die Echtheit des Zertifikats geprüft werden.';
$string['printoutcome'] = 'Ergebnis drucken';
$string['printseal'] = 'Stempel/Siegel drucken';
$string['printsignature'] = 'Unterschrift drucken';
$string['printteacher'] = 'Name  Trainer/in drucken';
$string['printteacher_help'] = '**Name des Trainers drucken**

Auf dem Zertifikat können bis zu drei Trainer/innen namentlich mit ausgedruckt werden. Wenn mehr als drei Personen als Trainer/innen eingesetzt sind werden nur die ersten drei in der im System eingetragenen Reihenfolge gedruckt.';
$string['printwmark'] = 'Wasserzeichen drucken';
$string['receivedcerts'] = 'Erstellte Zertifikate';
$string['receiveddate'] = 'Ausstellungsdatum';
$string['report'] = 'Bericht';
$string['reportcert_help'] = '**Report Certificate**

If you choose yes here, then this certificate\'s date received, code number, and the course name will be shown on the user certificate reports. If you choose to print a grade on this certificate, then that grade will also be shown on the certificate report.';
$string['reviewcertificate'] = 'Zertifikat aufrufen';
$string['sigline'] = 'Linie';
$string['textoptions'] = 'Text Options';
$string['to'] = 'Awarded to';
$string['validate'] = 'Prüfen';
$string['verifycertificate'] = 'Zertifikat abrufen';
$string['viewcertificateviews'] = '{$a} erstellte Zertifikate anzeigen';
$string['viewed'] = 'Dieses Zertifikat wurde für Sie erstellt am:';
$string['viewtranscript'] = 'View Certificates';
