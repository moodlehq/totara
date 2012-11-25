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
 * Strings for component 'question', language 'de', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Aktion';
$string['addanotherhint'] = 'Weiteren Hinweis hinzufügen';
$string['addcategory'] = 'Kategorie hinzufügen';
$string['adminreport'] = 'Bericht zu möglichen Problemen mit Ihrer Fragen-Datenbank';
$string['answer'] = 'Antwort';
$string['answersaved'] = 'Antwort gespeichert';
$string['attemptfinished'] = 'Versuch beendet';
$string['attemptfinishedsubmitting'] = 'Versuch abgeben';
$string['availableq'] = 'Verfügbar?';
$string['badbase'] = 'Schlechter Bezug vor **: {$a}**';
$string['behaviour'] = 'Verhalten';
$string['behaviourbeingused'] = 'Eingestelltes Verhalten: {$a}';
$string['broken'] = 'Dies ist ein ungültiger Link, der auf eine nicht existierende Datei zeigt.';
$string['byandon'] = 'von <em>{$a->user}</em> - <em>{$a->time}</em>';
$string['cannotcopybackup'] = 'Die Sicherungsdatei konnte nicht kopiert werden';
$string['cannotcreate'] = 'Es konnte kein Eintrag in der Datenbanktabelle für Testversuche (question_attempts) angelegt werden.';
$string['cannotcreatepath'] = 'Pfad {$a} konnte nicht erstellt werden';
$string['cannotdeletebehaviourinuse'] = 'Sie können das Verhalten {$a} nicht löschen; es wird aktiv genutzt.';
$string['cannotdeletecate'] = 'Kategorie konnte nicht gelöscht werden, weil sie für diesen Kontext die Standardkategorie darstellt.';
$string['cannotdeletemissingbehaviour'] = 'Sie können das fehlende Verhalten nicht löschen. Ees wird vom System benötigt.';
$string['cannotdeletemissingqtype'] = 'Sie dürfen den fehlenden Fragetyp nicht löschen. Er wird vom System benötigt.';
$string['cannotdeleteneededbehaviour'] = 'Frageverhalten {$a} kann nicht gelöscht werden. es wird von anderen Verhalten benötigt.';
$string['cannotdeleteqtypeinuse'] = 'Sie dürfen den Fragetyp \'{$a}\' nicht löschen. In der Fragedatenbank gibt es Fragen dieses Typs.';
$string['cannotdeleteqtypeneeded'] = 'Sie dürfen den Fragetyp \'{$a}\' nicht löschen. Andere installierte Fragetypen sind davon abgeleitet.';
$string['cannotenable'] = 'Fragetyp \'{$a}\' kann nicht direkt erstellt werden.';
$string['cannotenablebehaviour'] = 'Frageverhalten {$a} kann nicht unmittelbar genutzt werden. Es sit nur für den internen Gebrauch.';
$string['cannotfindcate'] = 'Kategoriedaten konnten nicht gefunden werden';
$string['cannotfindquestionfile'] = 'Die Fragendaten konnten nicht in der ZIP-Datei gefunden werden';
$string['cannotgetdsfordependent'] = 'Für diese datensetabhängige Frage kann das gewählte Datenset nicht aufgerufen werden! (Frage: {$a->id}, Datensetwert: {$a->item})';
$string['cannotgetdsforquestion'] = 'Ausgewähltes Datenset für berechnete Fragen nicht gefunden! (Frage:{$a})';
$string['cannothidequestion'] = 'Frage konnte nicht verborgen werden';
$string['cannotimportformat'] = 'Entschuldigung, aber der Import für dieses Format ist bisher nicht implementiert!';
$string['cannotinsertquestion'] = 'Neue Frage konnte nicht eingefügt werden!';
$string['cannotinsertquestioncatecontext'] = 'Neue Fragenkategorie {$a->cat} nicht eingefügt: ungültige Kontext-ID {$a->ctx}';
$string['cannotloadquestion'] = 'Frage konnte nicht geladen werden';
$string['cannotmovequestion'] = 'Mit dieser Funktionen können Sie keine Fragen verschieben in denen Dateien (Bilder) aus verschiedenen Bereichen eingebunden sind.';
$string['cannotopenforwriting'] = 'Öffnen zum Schreiben von {$a} nicht möglich.';
$string['cannotpreview'] = 'Keine Vorschau für diese Fragen möglich!';
$string['cannotread'] = 'Importdatei kann nicht geöffnet werden oder ist leer';
$string['cannotretrieveqcat'] = 'Fragekategorie konnte nicht aufgerufen werden';
$string['cannotunhidequestion'] = 'Frage konnte nicht sichtbar gemacht werden';
$string['cannotunzip'] = 'Datei konnte nicht entpackt werden.';
$string['cannotwriteto'] = 'Die exportierten Fragen können nicht nach "{$a}" gespeichert werden';
$string['category'] = 'Kategorie';
$string['categorycurrent'] = 'Aktuelle Kategorie';
$string['categorycurrentuse'] = 'Diese Kategorie benutzen';
$string['categorydoesnotexist'] = 'Diese Kategorie gibt es nicht';
$string['categoryinfo'] = 'Kategoriebeschreibung';
$string['categorymove'] = 'Die Kategorie \'{$a->name}\' enthält {$a->count} Fragen. Bitte wählen Sie eine andere Kategorie, um sie zu verschieben.';
$string['categorymoveto'] = 'In der Kategorie sichern';
$string['categorynamecantbeblank'] = 'Der Kategoriename kann nicht leer bleiben';
$string['changeoptions'] = 'Optionen ändern';
$string['changepublishstatuscat'] = 'Die <a href="{$a->caturl}">Kategorie "{$a->name}"</a> im Kurs "{$a->coursename}" wird ihren Freigabestatus von <strong>{$a->changefrom} nach {$a->changeto}</strong> ändern.';
$string['check'] = 'Prüfen';
$string['chooseqtypetoadd'] = 'Markieren Sie den gewünschten Fragetyp';
$string['clearwrongparts'] = 'Falsche Antworten löschen';
$string['clickflag'] = 'Frage markieren';
$string['clicktoflag'] = 'Klicken um die Frage zu markieren';
$string['clicktounflag'] = 'Markierung entfernen';
$string['clickunflag'] = 'Markierung entfernen';
$string['closepreview'] = 'Vorschau schließen';
$string['combinedfeedback'] = 'Kombiniertes Feedback';
$string['comment'] = 'Kommentar';
$string['commented'] = 'Kommentare: {$a}';
$string['commentormark'] = 'Kommentieren oder Punkte überschreiben';
$string['comments'] = 'Kommentare';
$string['commentx'] = 'Kommentar: {$a}';
$string['complete'] = 'Vollständig';
$string['contexterror'] = 'Diese Seite sollte nur angezeigt werden, wenn eine Kategorie in einen anderen Kontext verschoben wird.';
$string['copy'] = 'Aus {$a} kopieren und Links ändern.';
$string['correct'] = 'Richtig';
$string['correctfeedback'] = 'Für jede richtige Antwort';
$string['created'] = 'Erstellt';
$string['createdby'] = 'Erstellt von';
$string['createdmodifiedheader'] = 'Erstellt / Verändert';
$string['createnewquestion'] = 'Neue Frage erstellen...';
$string['cwrqpfs'] = 'Zufallsfragen, die Fragen aus der Unterkategorie auswählen.';
$string['cwrqpfsinfo'] = '<p>Beim Update auf Moodle 1.9 werden Kategorien, in denen Fragen abgelegt wurden, unterschiedlichen Kontexten zugeordnet. Bei einigen Kategorien kann es vorkommen, dass der Status der Freigabe dabei angepasst werden muss. Dies ist in dem seltenen Fall erforderlich, dass Sie die Funktion zufällig ausgewählte Fragen verwenden und diese aus Kategorien stammen, die sowohl nur in Ihem Kurs, als auch in anderen Kursen verwandt werden. Dies ist in diesem System der Fall. Die spassiert wenn auf unterschiedlichen Hierarchieebenen unterschiedliche Freigabewerte existieren.</p>
<p>In den folgenden Fragenkategorien wurde der Freigabestatus so angepasst, dass die übergeordnete Kategorie den gleichen Status erhält wie die Kategorie, in der Fragen zur Zufallsauswahl abgelegt sind. Die von dieser Änderung betroffenen Fragen können wie bisher in allen Tests weiter genutzt werden, bis sie aus den Tests entfernt werden.</p>';
$string['cwrqpfsnoprob'] = 'Es sind keine Fragekategorien von der Funktion "Zufallsfragenauswahl aus untergeordnete Kategorien" betroffen.';
$string['decimalplacesingrades'] = 'Dezimalstellen bei der Bewertung';
$string['defaultfor'] = 'Standard für {$a}';
$string['defaultinfofor'] = 'Standardkategorie für Fragen, die im Kontext \'{$a}\' freigegeben sind.';
$string['defaultmark'] = 'Erreichbare Punkte';
$string['deletebehaviourareyousure'] = '{$a} Verhalten löschen: sind sie sicher?';
$string['deletebehaviourareyousuremessage'] = 'Sie wollen das Frageverhalten {$a} löschen. Damit werden alle damit verknüpften Einträge in der Datenbank gelöscht. Wollen Sie dies fortsetzen?';
$string['deletecoursecategorywithquestions'] = 'In dieser Kurskategorie sind Fragen in der Testfragendatenbank hinterlegt. Wenn Sie nun fortfahren, werden diese gelöscht. Über die Testfragenverwaltung können diese  von Ihnen verschoben werden.';
$string['deleteqtypeareyousure'] = 'Sind Sie Sicher, dass Sie den Fragetyp \'{$a}\' löschen möchten?';
$string['deleteqtypeareyousuremessage'] = 'Sie sind dabei, den Fragetyp \'{$a}\' vollständig zu löschen. Sind Sie sicher, dass Sie ihn deinstallieren wollen?';
$string['deletequestioncheck'] = 'Sind Sie absolut sicher, die Sie \'{$a}\' löschen möchten?';
$string['deletequestionscheck'] = 'Sind Sie absolut sicher, dass Sie die folgenden Fragen löschen wollen? <br /> <br />{$a}';
$string['deletingbehaviour'] = '{$a} Frageverhalten löschen: sind Sie sicher?';
$string['deletingqtype'] = 'Fragetyp \'{$a}\' löschen';
$string['didnotmatchanyanswer'] = '[Passt zu keiner Antwort]';
$string['disabled'] = 'deaktiviert';
$string['disterror'] = 'Distribution {$a} verursacht Fehler.';
$string['donothing'] = 'Keine Dateien kopieren oder verschieben. Keine Links ändern.';
$string['editcategories'] = 'Kategorien bearbeiten';
$string['editcategories_help'] = 'Anstatt Fragen in einer einzigen langen Liste zu sammeln, können Sie Ihre Fragen strukturieren und in Fragenkategorien ablegen.
Jede Kategorie verfügt über einen Kontext, der festlegt wo die Fragen dieser Kategorie eingesetzt werden können.
* Aktivitätenkontext - Frage nur in der konkreten Aktivität einsetzbar
* Kurskontext _ Frage kann im gesamten kurs genutzt weden
* Kursbereichskontext - Frage kann in allen Kursen des Kursbereichs genutzt werden
* Systemkontext - Frage kann in allen Kursen genutzt werden.
Kategorien können auch als Container für Zufallsfragen genutzt werden.';
$string['editcategory'] = 'Kategorie bearbeiten';
$string['editingcategory'] = 'Kategorie bearbeiten';
$string['editingquestion'] = 'Frage bearbeiten';
$string['editquestion'] = 'Frage bearbeiten';
$string['editquestions'] = 'Fragen bearbeiten';
$string['editthiscategory'] = 'Diese Kategorie bearbeiten';
$string['emptyxml'] = 'Unbekannter Fehler- leere imsmanifest.xml-Datei.';
$string['enabled'] = 'aktiv';
$string['erroraccessingcontext'] = 'Kein Zugriff auf den Kontext';
$string['errordeletingquestionsfromcategory'] = 'Fehler beim Löschen von Fragen in der Kategorie {$a}.';
$string['errorduringpost'] = 'Fehler nach Prozessabschluss';
$string['errorduringpre'] = 'Fehler vor Prozessbeginn';
$string['errorduringproc'] = 'Fehler bei Prozessausführung';
$string['errorduringregrade'] = 'Frage {$a->qid} konnte nicht neu bewertet werden - Status: {$a->stateid}';
$string['errorfilecannotbecopied'] = 'Fehler: Datei {$a} kann nicht kopiert werden.';
$string['errorfilecannotbemoved'] = 'Fehler: Datei {$a} kann nicht verschoben werden.';
$string['errorfileschanged'] = 'Fehler: Dateien, die in Fragen verwendet werden, haben sich seit der letzten Anzeige geändert.';
$string['errormanualgradeoutofrange'] = 'Die Bewertung {$a->grade} für die Frage {$a->name} liegt nicht zwischen \'0\' und {$a->maxgrade}. Punkte und Kommentare wurde nicht gespeichert.';
$string['errormovingquestions'] = 'Fehler beim Verschieben von Fragen mit Ids {$a}.';
$string['errorpostprocess'] = 'Fehler beim Post-Processing';
$string['errorpreprocess'] = 'Fehler beim Pre-Processing';
$string['errorprocess'] = 'Fehler beim Processing';
$string['errorprocessingresponses'] = 'Während der Verarbeitung Ihrer Antworten ist ein Fehler aufgetreten ({$a}). Fortsetzen anklicken und von der Ausgangsseite erneut probieren.';
$string['errorsavingcomment'] = 'Fehler beim Speichern des Kommentars für Frage {$a->name}.';
$string['errorsavingflags'] = 'Fehler beim Speichern der Markierung';
$string['errorupdatingattempt'] = 'Fehler beim Speichern des Kommentars zu Frage {$a->id} in der Datenbank.';
$string['exportcategory'] = 'Kategorie exportieren';
$string['exportcategory_help'] = '## Export von Test-Kategorien
Das **Kategorie:** Drop-Down-Auswahlfeld wird genutzt, um die Kategorie auszuwählen in der die Fragen stehen, die exportiert werden sollen.
Einige Importformate (GIFT und XML Format) lassen es zu, dass die Kategorie in die Dateibezeichnung mit aufgenommen wird. Damit kann die Kategorie beim Import mit wiederhergestellt werden. In diesem Fall muss das Feld \'in Datei\' mit markiert werden.';
$string['exporterror'] = 'Fehler beim Export aufgetreten!';
$string['exportfilename'] = 'quiz';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['exportquestions'] = 'Fragen in Datei exportieren';
$string['exportquestions_help'] = '## Export von Fragen aus einer
Kategorie
Diese Funktion ermöglicht es, alle Fragen einer Kategorie
in eine Textdatei zu exportieren.
Beim Export und Import von Testfragen können nicht alle Fragetypen bei allen Formaten verarbeitet werden. Das liegt daran, dass nicht alle Formate alle Fragetypen unterstützen. Der Fragenumfang, der aus
einem Programm exportiert und in ein anderes
Programm importiert wird, muss also nicht identisch
sein. Prüfen Sie daher alle Fragen, bevor Sie sie in einem
Kurs verwenden.';
$string['feedback'] = 'Feedback';
$string['filecantmovefrom'] = 'Die Fragedateien können von Ihnen nicht verschoben werden. Sie verfügen nicht über ausreichende Rechte Sie von diesem Ort zu verschieben.';
$string['filecantmoveto'] = 'Die Fragedateien können von Ihnen nicht verschoben oder kopiert werden. Sie verfügen nicht über ausreichende Rechte Sie an diesen Ort zu verschieben.';
$string['fileformat'] = 'Dateiformat';
$string['filesareacourse'] = 'Dateibereich im Kurs';
$string['filesareasite'] = 'Dateibereich der Website';
$string['filestomove'] = 'Dateien nach {$a} kopieren / verschieben?';
$string['fillincorrect'] = 'Richtige Lösung';
$string['flagged'] = 'markiert';
$string['flagthisquestion'] = 'Diese Frage markieren';
$string['formquestionnotinids'] = 'Die angefragte Frage ist nicht in questionids vermerkt.';
$string['fractionsnomax'] = 'Eine der Antworten sollte mit 100% bewertet werden, um für die Beantwortung der Frage die volle Punktzahl bekommen zu können.';
$string['generalfeedback'] = 'Allgemeines Feedback';
$string['generalfeedback_help'] = 'Generelles Feedback wird Teilnehmer/innen nach der Beantwortung der Frage angezeigt. Es ist unabhängig von der Antwort, die jemand gegeben hat. Andere Feedbacks sind abhängig von der \'Richtigkeit\' der Antwort.
Das generelle Feedback kann verwandt werden, um Hinweise zum Wissensbereich zu geben, der mit Frage abgefragt wird. Links könnten zu weiteren Informationen führen, falls die Frage nicht verstanden wurde.';
$string['getcategoryfromfile'] = 'Kategorie aus Datei holen';
$string['getcontextfromfile'] = 'Kontext aus Datei holen';
$string['hidden'] = 'Verborgen';
$string['hintn'] = 'Hinweis {no}';
$string['hinttext'] = 'Verborgener Text';
$string['howquestionsbehave'] = 'Frageverhalten';
$string['howquestionsbehave_help'] = 'Fragen im Test können auf unterschiedliche Art und Weise angelegt sein. Sollen beispielsweise zuerst alle Fragen beantwortet und dann der gesamte Test abgegeben werden, bevor es eine Bewertung oder eine Rückmeldung gibt, wäre dies der Modus \'Spätere Auswertung\'. Alternativ könnte nach der Beantwortung jeder Frage eine \'Direkte Auswertung\' gegeben werden und -sofern die Frage nicht richtig beantwortet wurde - ein erneuter Versuch starten. Dieses Frageverhalten wäre der Modus \'Mehrfachbeantwortung (mit Hinweisen)\'.';
$string['ignorebroken'] = 'Ungültige Links ignorieren';
$string['importcategory'] = 'Importkategorien';
$string['importcategory_help'] = '## Import von Kategorien
Das **Kategorie:** Dropdown-Auswahlfeld ermöglicht Ihnen, die Kategorie auszuwählen in die die Fragen importiert werden sollen.
Bei einigen Importformaten (GIFT und XML-Format) kann die Importkategorie bereits in der Importdatei festgelegt werden. Um diese Option zu nutzen muss das Häkchen \'aus Datei\' gesetzt werden. Wenn hier keine Markierung erfolgt wird die ausgewählte Kategorie genutzt. Die Anweisung in der Importdatei wird dann ignoriert.
Falls in der Importdatei Kategorien definiert sind, die in Ihrem Kurs nicht existieren ,werden diese beim Import angelegt.';
$string['importerror'] = 'Fehler beim Import';
$string['importerrorquestion'] = 'Fehler beim Import der Frage';
$string['importfromcoursefiles'] = '... oder eine Datei zum Import auswählen.';
$string['importfromupload'] = 'Wählen Sie eine Datei zum Hochladen...';
$string['importingquestions'] = '{$a} Frage(n) werden aus der Datei importiert';
$string['importparseerror'] = 'Fehler beim Einlesen der Importdatei gefunden. Es wurden daher keine Fragen importiert. Zum Einlesen fehlerfreier Fragen setzen Sie die Einstellung \'Bei Fehler stoppen\' auf \'Nein\'.';
$string['importquestions'] = 'Fragen aus Datei importieren';
$string['importquestions_help'] = 'Die Funktion ermöglicht es Ihnen Fragen mit verschiedene Fragetypen aus eienr Textdatei zu importieren. Achtung: die Datei muss im UTF-8 Format codiert sein.';
$string['importwrongfiletype'] = 'Die Inhalte der Datei ({$a->actualtype}) passen nicht zum Format der gewählten Importdatei ({$a->expectedtype}).';
$string['impossiblechar'] = 'Unzulässiges Zeichen {$a} innerhalb der Klammern entdeckt';
$string['includesubcategories'] = 'Fragen aus Unterkategorien anzeigen';
$string['incorrect'] = 'Falsch';
$string['incorrectfeedback'] = 'Für jede falsche Antwort';
$string['information'] = 'Information';
$string['invalidanswer'] = 'Unvollständige Antwort';
$string['invalidarg'] = 'Ungültige Argumente oder falsche Serverkonfiguration';
$string['invalidcategoryidforparent'] = 'Ungültige Kategorien ID für übergeordnete Ebene';
$string['invalidcategoryidtomove'] = 'Ungültige Kategorien ID beim Verschieben';
$string['invalidconfirm'] = 'Falscher Bestätigungstext';
$string['invalidcontextinhasanyquestions'] = 'Ungültiger Kontext für question_context_has_any_questions.';
$string['invalidpenalty'] = 'Ungültige Abzüge';
$string['invalidwizardpage'] = 'Falsche oder keine Seite festgelegt!';
$string['lastmodifiedby'] = 'Zuletzt verändert von';
$string['linkedfiledoesntexist'] = 'Verbundene Datei {$a} existiert nicht';
$string['makechildof'] = 'Unterkategorie  von \'{$a}\' erzeugen';
$string['makecopy'] = 'Kopieren';
$string['maketoplevelitem'] = 'Nach ganz oben bewegen';
$string['manualgradeoutofrange'] = 'Dies Bewertung ist außerhalb des gültigen Bereichs';
$string['manuallygraded'] = 'Manuell bewertete Punkte {$a->mark} mit Kommentar: {$a->comment}';
$string['mark'] = 'Punkte';
$string['markedoutof'] = 'Erreichbare Punkte';
$string['markedoutofmax'] = 'Erreichbare Punkte: {$a}';
$string['markoutofmax'] = 'Erreichte Punkte {$a->mark} von {$a->max}';
$string['marks'] = 'Punkte';
$string['matcherror'] = 'Bewertungen passen nicht zu den Bewertungsoptionen - Fragen wurden übersprungen';
$string['matchgrades'] = 'Bewertungen abgleichen';
$string['matchgrades_help'] = '## Bewertungen zuordnen
Importierte Bewertungen **müssen** zu einer der gültigen Bewertungen passen, die in der folgenden Liste aufgeführt sind.

* 100%
* 90%
* 80%
* 75%
* 70%
* 66.666%
* 60%
* 50%
* 40%
* 33.333
* 30%
* 25%
* 20%
* 16.666%
* 14.2857
* 12.5%
* 11.111%
* 10%
* 5%
* 0%

Negative Werte zu der obigen Liste sind auch zulässig.
Es gibt hierfür zwei Einstellungen. Sie legen fest, wie mit Werten umgegangen werden soll, die nicht **exakt** mit den obigen Werten übereinstimmen.

\* **|Fehlermeldung, wenn Bewertung nicht in der Liste enthalten ist**
Wenn die Frage eine Bewertung enthält, die nicht in der Liste steht, wird die Frage beim Import zurückgewiesen und ein Fehler angezeigt.
\* **|Nächstliegenden Wert aus der Liste eintragen**
Wenn ein Wert beim Import nicht gefunden wird, wird er ersetzt durch den nächstliegenden Wert aus der Liste.

*Anmerkung: Einige Importfunktionen schreiben ihre Daten direkt in die Datenbank und können diese Prüfung umgehen.*';
$string['matchgradeserror'] = 'Fehler wenn Bewertung nicht gelistet';
$string['matchgradesnearest'] = 'Nächstliegende Bewertung verwenden';
$string['missingcourseorcmid'] = 'courseid oder cmid muss für print_question  angegeben werden';
$string['missingcourseorcmidtolink'] = 'courseid oder cmid erforderlich, um get_question_edit_link anzuzeigen.';
$string['missingimportantcode'] = 'Für diesem Fragetyp fehlt wichtiger Code: {$a}.';
$string['missingoption'] = 'In der Lückentext-Frage {$a} fehlen Optionen.';
$string['modified'] = 'Verändert';
$string['move'] = 'Aus {$a} verschieben und Links ändern.';
$string['movecategory'] = 'Kategorie verschieben';
$string['movedquestionsandcategories'] = 'Fragen und Fragenkategorien wurden von {$a->oldplace} nach {$a->newplace} verschoben.';
$string['movelinksonly'] = 'Verändert die Angabe auf die Links verweisen. Verschiebt oder kopiert keine Dateien.';
$string['moveq'] = 'Frage(n) verschieben';
$string['moveqtoanothercontext'] = 'Frage in einen anderen Kontext verschieben';
$string['moveto'] = 'Verschieben nach >>';
$string['movingcategory'] = 'Kategorie wird verschoben';
$string['movingcategoryandfiles'] = 'Sind Sie sicher, dass Sie die Kategorie {$a->name} und alle Unterkategorien in den Kontext  "{$a->contextto}" verschieben wollen?<br/> Wir haben {$a->urlcount} Dateien entdeckt, auf die in den Fragen aus {$a->fromareaname} verlinkt wird. Wollen Sie diese nach {$a->toareaname} verschieben oder kopieren?';
$string['movingcategorynofiles'] = 'Sind Sie sicher, dass Sie die Kategorie "{$a->name}" und alle Unterkategorien in den Kontext "{$a->contextto}" verschieben wollen?';
$string['movingquestions'] = 'Fragen und Dateien werden verschoben';
$string['movingquestionsandfiles'] = 'Sind Sie sicher, dass Sie die Frage(n) {$a->questions} in den Kontext <strong>"{$a->tocontext}"</strong> verschieben wollen?<br/>In Frage(n) in {$a->fromareaname} wird auf <strong>{$a->urlcount} Dateien</strong> verlinkt. Wollen Sie diese Dateien nach {$a->toareaname} kopieren oder verschieben?';
$string['movingquestionsnofiles'] = 'Sind Sie sicher, dass Sie die Frage(n) {$a->questions} in den Kontext <strong>"{$a->tocontext}"</strong> verschieben wollen?<br/>In keiner Frage in {$a->fromareaname} wird auf <strong> Dateien</strong> verlinkt.';
$string['needtochoosecat'] = 'Sie müssen eine Kategorie auswählen, um diese Frage zu verschieben. Oder Sie drücken "Abbrechen".';
$string['nocate'] = 'Keine solche Kategorie: {$a}!';
$string['nopermissionadd'] = 'Sie haben keine Berechtigung, um hier Fragen hinzuzufügen.';
$string['nopermissionmove'] = 'Sie haben keine Berechtigung die Fragen zu verschieben. Speichern Sie die Frage in dieser Kategorie oder als neue Frage.';
$string['noprobs'] = 'Es wurden keine Probleme in Ihrer Fragen-Datenbank gefunden.';
$string['noquestions'] = 'Es wurden keine Fragen gefunden, die exportiert werden könnten. Stellen Sie sicher, dass Sie eine Kategorie ausgewählt haben, die auch Fragen enthält.';
$string['noquestionsinfile'] = 'In der Importdatei sind keine Fragen enthalten.';
$string['noresponse'] = '[Keine Antwort]';
$string['notanswered'] = 'Nicht beantwortet';
$string['notenoughanswers'] = 'Dieser Fragetyp erfordert mindestens {$a} Antworten.';
$string['notenoughdatatoeditaquestion'] = 'Weder eine Frage-ID, noch Kategorie-ID oder Fragetyp sind angegeben.';
$string['notenoughdatatomovequestions'] = 'Sie müssen die Frage-ID der Fragen angeben, die Sie verschieben wollen.';
$string['notflagged'] = 'nicht markiert';
$string['notgraded'] = 'Nicht bewertet';
$string['notshown'] = 'Nicht anzeigen';
$string['notyetanswered'] = 'Bisher nicht beantwortet';
$string['notyourpreview'] = 'Diese Vorschau ist nicht für Sie gedacht';
$string['novirtualquestiontype'] = 'Kein virtueller Fragetyp für Fragetyp {$a} vorhanden';
$string['numqas'] = 'Anzahl der Versuche';
$string['numquestions'] = 'Fragenanzahl';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} verborgene)';
$string['options'] = 'Optionen';
$string['orphanedquestionscategory'] = 'Fragen aus gelöschten Kategorien gespeichert';
$string['page-question-category'] = 'Jede Fragenkategorieseite';
$string['page-question-edit'] = 'Jede Fragenbearbeitungsseite';
$string['page-question-export'] = 'Jede Fragen-Exportseite';
$string['page-question-import'] = 'Jede Fragen-Importseite';
$string['page-question-x'] = 'Jede Fragenseite';
$string['parent'] = 'Übergeordnet';
$string['parentcategory'] = 'Übergeordnete Kategorie';
$string['parentcategory_help'] = '## Hierarchieebenen für Fragenkategorien
Fragenkategorien können hierarchisch strukturiert werden. Eine Kategorie kann eine oder mehrere Unterkategorien enthalten. Sie ist dann für jede dieser Unterkategorien die übergeordnete Kategorie. Es gibt eine spezielle Hierarchiebene "Oben": Das ist die oberste Hierarchieebene, alle Kategorien in dieser Ebene haben keine übergeordneten Kategorien.
Normalerweise sehen Sie verschiedene Kontexte von Fragenkategorien. Beachten Sie, dass jeder Kontext seine eigene Hierarchie von Fragenkategorien enthält. Weiterführende Informationen zu Kontexten von Fragenkategorien finden Sie unten. Wenn Sie nicht mehrere Kontexte von Fragenkategorien sehen, kann das daran liegen, dass Sie keine Berechtigung haben, auf andere Kontexte zuzugreifen.
Wenn es in einem Kontext nur eine Fragenkategorie gibt, können Sie diese nicht verschieben, da jeder Kontext mindestens eine Fragenkategorie enthalten muss.
Siehe auch:
* [Fragenkategorien] (help.php?module=question&file=categories.html)
* [Kontexte von Fragenkategorien] (help.php?module=question&file=categorycontexts.html)
* [Berechtigungen für Fragen] (help.php?module=question&file=permissions.html)
';
$string['parenthesisinproperclose'] = 'Die Klammer vor ** ist nicht richtig geschlossen bei {$a}**';
$string['parenthesisinproperstart'] = 'Die Klammer vor ** ist nicht richtig geöffnet bei {$a}**';
$string['parsingquestions'] = 'Fragen aus Importdatei einlesen';
$string['partiallycorrect'] = 'Teilweise richtig';
$string['partiallycorrectfeedback'] = 'Für jede teilrichtige Antwort';
$string['penaltyfactor'] = 'Abzugsfaktor';
$string['penaltyfactor_help'] = '## Höhe des Punktabzugs
Legen Sie fest, welcher Anteil an der erreichbaren Punktzahl für jede falsche Antwort abgezogen wird. Diese Funktion ist nur dann bedeutsam, wenn der adaptive Modus eingeschaltet ist. Der Wert sollte zwischen 0 und 1 liegen. Der Wert "1" bedeutet: Nur bei einer richtigen Antwort im ersten Versuch gibt es Punkte. Der Wert "=" bedeutet: Bei jedem Versuch - auch dem wiederholten - kann die volle Punktzahl erreicht werden. Der Wert "0,1" bedeutet: Beim zweiten Versuch werden für die richtige Antwort nur 90 % der maximal erreichbaren Punktzahl des ersten Versuchs gewertet.';
$string['penaltyforeachincorrecttry'] = 'Abzug für jeden falschen Versuch';
$string['penaltyforeachincorrecttry_help'] = 'Sofern der Test im Modus \'Mehrfachbeantwortung (mit Hinweisen)\' oder im Modus \'Mehrfachbeantwortung (mit Abzügen)\' durchgeführt wird, bei dem die Teilnehmer/innen mehrere Versuche zur richtigen Beantwortung haben, kontrolliert diese Option die Höhe des Abzugs für jeden falschen Versuch.
Der Abzug wird dabei als Prozentzahl zur erreichbaren Punktzahl angegeben: Gäbe es beispielsweise 3 Punkte und der Abzug wäre 0.3333333, würde eine richtige Antwort im ersten Versuch mit 3 Punkten gewertet, im zweiten Versuch mit 2 Punkten und im dritten Versuch nur noch mit 1 Punkt.';
$string['permissionedit'] = 'Diese Frage bearbeiten';
$string['permissionmove'] = 'Diese Frage verschieben';
$string['permissionsaveasnew'] = 'Diese Frage  als neue Frage speichern';
$string['permissionto'] = 'Sie besitzen Berechtigungen für :';
$string['previewquestion'] = 'Vorschau Frage {$a}';
$string['published'] = 'Freigegeben';
$string['qbehaviourdeletefiles'] = 'Alle Daten in Verbindung mit dem Frageverhalten \'{$a->behaviour}\' wurden in der Datenbank gelöscht. Zum Abschluss des Löschvorgangs und um zu verhindern, dass sich das Frageverhalten erneut installiert, sollten Sie nun noch das Serververzeichnis {$a->directory} löschen.';
$string['qtypedeletefiles'] = 'Alle Daten, die mit dem Fragetyp \'{$a->qtype}\' verbunden sind, wurden aus der Datenbank gelöscht. Um die Löschung abzuschließen (und eine automatische Wiederinstallation des Fragetyps zu verhindern), sollten Sie jetzt noch das Verzeichnis \'{$a->directory}\' von Ihrem Server entfernen.';
$string['qtypeveryshort'] = 'T';
$string['questionaffected'] = '<a href="{$a->qurl}">Die Frage "{$a->name}" ({$a->qtype})</a> gehört zu dieser Fragenkategorie. Sie wird aber auch im <a href="{$a->qurl}">Test "{$a->quizname}"</a> innerhalb des Kurses "{$a->coursename}" benutzt.';
$string['questionbank'] = 'Fragensammlung';
$string['questionbehaviouradminsetting'] = 'Einstellungen zum Frageverhalten';
$string['questionbehavioursdisabled'] = 'Frageverhalten deaktivieren';
$string['questionbehavioursdisabledexplained'] = 'Geben Sie eine Liste der Frageverhalten ein, die nicht im Dropdownmneu erscheinen sollen. Mehrere Werte werden durch ein Komma getrennt.';
$string['questionbehavioursorder'] = 'Frageverhalten-Reihenfolge';
$string['questionbehavioursorderexplained'] = 'Geben Sie eine Liste mit den Frageverhalten in der gewünschten Reihenfolge der Darstellung ein. Werte durch Kommas trennen.';
$string['questioncategory'] = 'Fragenkategorie';
$string['questioncatsfor'] = 'Fragenkategorien für \'{$a}\'';
$string['questiondoesnotexist'] = 'Diese Frage gibt es nicht';
$string['questionidmismatch'] = 'Frage-IDs können nicht zugeordnet werden';
$string['questionname'] = 'Fragetitel';
$string['questionno'] = 'Frage {$a}';
$string['questions'] = 'Fragen';
$string['questionsaveerror'] = 'Fehler beim Speichern der Frage aufgetreten - ({$a})';
$string['questionsinuse'] = '(*Fragen, die mit einem Sternchen versehen sind, werden in Tests eingesetzt. Die Fragen werden nicht aus dem Test gelöscht, jedoch in der Kategorienliste nicht angezeigt. )';
$string['questionsmovedto'] = 'In Gebrauch befindliche Fragen wurden nach "{$a}" in der Kategorie verschoben.';
$string['questionsrescuedfrom'] = 'Fragen aus Kontext {$a} gespeichert.';
$string['questionsrescuedfrominfo'] = 'Diese Fragen (einige mögen verborgen sein) wurden gespeichert als der Kontext {$a} gelöscht wurde, da sie in Tests oder anderen Aktivitäten in Gebrauch sind.';
$string['questiontext'] = 'Fragetext';
$string['questiontype'] = 'Fragetyp';
$string['questionuse'] = 'Frage in dieser Aktivität benutzen';
$string['questionvariant'] = 'Fragevariante';
$string['questionx'] = 'Frage {$a}';
$string['requiresgrading'] = 'Bewertung notwendig';
$string['responsehistory'] = 'Antworten-Rückblick';
$string['restart'] = 'Nochmal beginnen';
$string['restartwiththeseoptions'] = 'Nochmal mit diesen Optionen beginnen';
$string['reviewresponse'] = 'Antworten einsehen';
$string['rightanswer'] = 'Richtige Antwort';
$string['saved'] = 'Gespeichert: {$a}';
$string['saveflags'] = 'Den Status der Markierungen speichern';
$string['selectacategory'] = 'Eine Kategorie wählen:';
$string['selectaqtypefordescription'] = 'Wählen Sie einen Fragetypus um seine Beschreibung zu sehen.';
$string['selectcategoryabove'] = 'Wählen Sie oben eine Kategorie';
$string['selectquestionsforbulk'] = 'Mehrere Fragen auswählen';
$string['settingsformultipletries'] = 'Einstellungen für Mehrfachversuche';
$string['shareincontext'] = 'Im Kontext von {$a} freigeben';
$string['showhidden'] = 'Auch alte Fragen anzeigen';
$string['showmarkandmax'] = 'Punkte und Maximum zeigen';
$string['showmaxmarkonly'] = 'Zeige nur Punkte';
$string['shown'] = 'Anzeigen';
$string['shownumpartscorrect'] = 'Zeige die Anzahl der korrekten Antworten';
$string['shownumpartscorrectwhenfinished'] = 'Anzahl der richtigen Antworten anzeigen, sobald die Frage beendet ist';
$string['showquestiontext'] = 'Fragetext in der Frageliste anzeigen';
$string['specificfeedback'] = 'Spezifisches Feedback';
$string['started'] = 'Begonnen';
$string['state'] = 'Status';
$string['step'] = 'Schritt';
$string['stoponerror'] = 'Bei Fehler anhalten';
$string['stoponerror_help'] = 'Die Einstellung legt fest, ob der Importprozess gestoppt werden soll, wenn ein Fehler entdeckt wird. In dem Fall wird keine Frage importiert. Andernfalls werden korrekte Fragen importiert, fehlerhafte ignoriert.';
$string['submissionoutofsequence'] = 'Benutzen Sie nicht den Zurück-Button, wenn Sie Fragen bearbeiten.';
$string['submissionoutofsequencefriendlymessage'] = 'Sie haben Daten außerhalb der vorgesehenen Reihenfolge eingegeben. Dies kann passieren wenn Sie die Browserfunktion \'Vor\' und \'Zurück\' benutzen. Bitte verwenden Sie nicht die Browserfunktionen, um im Test zwischen Seiten zu wechseln. Dies ist auch möglich, wenn Sie etwas anklicken während die Seite noch geladen wird. Verwenden Sie nur die Taste <strong>Weiter</strong>.';
$string['submit'] = 'Abgabe';
$string['submitandfinish'] = 'Absenden und beenden';
$string['submitted'] = 'Absenden: {$a}';
$string['tofilecategory'] = 'Kategorie in eine Datei schreiben';
$string['tofilecontext'] = 'Kontext in eine Datei schreiben';
$string['uninstallbehaviour'] = 'Frageverhalten deinstallieren';
$string['uninstallqtype'] = 'Diesen Fragetyp deinstallieren';
$string['unknown'] = 'Unbekannt';
$string['unknownbehaviour'] = 'Unbekanntes Verhalten: {$a}.';
$string['unknownquestion'] = 'Unbekannte Frage: {$a}';
$string['unknownquestioncatregory'] = 'Unbekannte Fragekategorie: {$a}';
$string['unknownquestiontype'] = 'Unbekannter Fragetyp: {$a}';
$string['unknowntolerance'] = 'Unbekannter Toleranztyp: {$a}';
$string['unpublished'] = 'Nicht freigegeben';
$string['upgradeproblemcategoryloop'] = 'Bei der Aktualisierung der Fragenkategorien wurde ein Problem erkannt. Es wurde eine Schleife (Wiederholung) im Kategorien-Baum entdeckt. Es handelt sich hierbei um die Kategorie mit der ID {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'Die Fragenkategorie {$a->name} ({$a->id}) konnte nicht aktualisiert werden.';
$string['upgradeproblemunknowncategory'] = 'Bei der Aktualisierung der Fragenkategorien wurde ein Problem erkannt. Kategorie {$a->id} bezieht sich auf die Vorgänger-Kategorie, die nicht existiert. Die Vorgänger-Kategorie wurde geändert um das Problem zu beheben.';
$string['whethercorrect'] = 'Ob richtig';
$string['withselected'] = 'Mit Auswahl';
$string['wrongprefix'] = 'Falsch formatiertes Präfix-Wort';
$string['xoutofmax'] = '{$a->mark} von {$a->max}';
$string['yougotnright'] = 'Sie haben {$a->num} richtig ausgewählt';
$string['youmustselectaqtype'] = 'Wählen Sie zunächst einen Fragetyp aus';
$string['yourfileshoulddownload'] = 'Der Download Ihrer Exportdatei sollte in Kürze beginnen. Falls nicht, dann klicken Sie  <a href="{$a}">hier</a>.';
