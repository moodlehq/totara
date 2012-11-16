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
 * Strings for component 'tool_unittest', language 'nl', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_unittest
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addconfigprefix'] = 'Voeg een prefix toe aan het configuratiebestand';
$string['all'] = 'ALLE';
$string['codecoverageanalysis'] = 'Voer inbegrepen codeanalyse uit';
$string['codecoveragecompletereport'] = '(bekijk volledig coderapport';
$string['codecoveragedisabled'] = 'Kan inbegrepen code niet inschakelen op deze server (xdebug-extentie ontbreekt).';
$string['codecoveragelatestdetails'] = '(op {$a->date}, met {$a->files} bestanden, {$a->percentage} inbegrepen)';
$string['codecoveragelatestreport'] = 'Bekijk het laatste volledig coderapport';
$string['confignonwritable'] = 'Het bestand config.php is niet beschrijfbaar door de webserver. Ofwel moet je de rechten  veranderen, ofwel moet je het bewerken met de juiste gebruikersaccount en volgende lijn toevoegen voor de afsluitende php-tag:

$CFG->unittestprefix = \'tst_\' // Change tst_ to a prefix of your choice, different from $CFG->prefix';
$string['coveredlines'] = 'Inbegrepen lijnen';
$string['coveredpercentage'] = 'Algemeen inbegrepen coderapport';
$string['dbtest'] = 'Functionele DB-testen';
$string['deletingnoninsertedrecord'] = 'Een record geprobeerd te verwijderen die niet toegevoegd was door deze unit test (id {$a->id} in tabel {$a->table}).';
$string['deletingnoninsertedrecords'] = 'Records proberen te verwijderen die niet toegevoegd waren door deze unit test (uit tabel {$a->table}).';
$string['droptesttables'] = 'Verwijder testtabellen';
$string['exception'] = 'Uitzondering';
$string['executablelines'] = 'Uitvoerbare lijnen';
$string['fail'] = 'Mislukt';
$string['ignorefile'] = 'Negeer testen in het bestand';
$string['ignorethisfile'] = 'Test opnieuw en negeer dit testbestand';
$string['installtesttables'] = 'Installeer testtabellen';
$string['moodleunittests'] = 'Moodle unit testen: {$a}';
$string['notice'] = 'Opmerking';
$string['onlytest'] = 'Laat testen alleen lopen in';
$string['othertestpages'] = 'Andere testpagina\'s';
$string['pass'] = 'Gelukt';
$string['pathdoesnotexist'] = 'Het pad \'{$a}\' bestaat niet.';
$string['pluginname'] = 'Unit testen';
$string['prefix'] = 'Voorvoegsel voor unit testtabellen';
$string['prefixnotset'] = 'Het unit testtabellenprefix is niet geconfigureerd. Vul dit formulier in om het toe te voegen aan config.php';
$string['reinstalltesttables'] = 'Herinstalleer testtabellen';
$string['retest'] = 'Doe de testen opnieuw';
$string['retestonlythisfile'] = 'Doe de testen opnieuw met dit testbestand';
$string['runall'] = 'Doe de testen opnieuw met alle testbestanden';
$string['runat'] = 'Doe de test op {$a}';
$string['runonlyfile'] = 'Doe enkel de testen in dit bestand';
$string['runonlyfolder'] = 'Doe enkel de testen in deze map';
$string['runtests'] = 'Doe de testen';
$string['rununittests'] = 'Doe de unit testen';
$string['showpasses'] = 'Toon zowel gelukt als mislukt';
$string['showsearch'] = 'Toon het zoeken naar testbestanden';
$string['skip'] = 'Overslaan';
$string['stacktrace'] = 'Stack trace:';
$string['summary'] = '{$a->run}/{$a->total} testen volledig: <strong>{$a->passes}</strong> gelukt, <strong>{$a->fails}</strong> mislukt en <strong>{$a->exceptions}</strong> uitzonderingen';
$string['tablesnotsetup'] = 'Unit testtabellen zijn nog niet opgebouwd. Wil je dat nu doen?';
$string['testdboperations'] = 'Test databankoperaties';
$string['testtablescsvfileunwritable'] = 'Het CSV-bestand van de testtabellen is niet beschrijfbaar ({$a->filename})';
$string['testtablesneedupgrade'] = 'De testtabellen moeten geüpgraded worden. Wil je nu verder gaan met die upgrade?';
$string['testtablesok'] = 'De testtabellen zijn met succes geïnstalleerd.';
$string['thorough'] = 'Doorloop een grondige test (kan traag zijn).';
$string['timetakes'] = 'Tijdsduur: {$a}.';
$string['totallines'] = 'Totaal aantal lijnen';
$string['uncaughtexception'] = 'Onverwachte uitzondering [{$a->getMessage()}] in [{$a->getFile()}:{$a->getLine()}] TEST ONDERBROKEN.';
$string['uncoveredlines'] = 'Niet inbegrepen lijnen';
$string['unittest:execute'] = 'Unit testen uitvoeren';
$string['unittestprefixsetting'] = 'Unit test prefix: <strong>{$a->unittestprefix}</strong> (Bewerk config.php om dit te wijzigen).';
$string['unittests'] = 'Unit testen';
$string['updatingnoninsertedrecord'] = 'Een record geprobeerd te updaten die niet toegevoegd was door deze unit test (id {$a->id} in tabel {$a->table}).';
$string['version'] = 'We gebruiken <a href="http://sourceforge.net/projects/simpletest/">SimpleTest</a> version {$a}.';
