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
 * Strings for component 'tool_unittest', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_unittest
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addconfigprefix'] = 'Aggiungi prefisso al file config';
$string['all'] = 'TUTTI';
$string['codecoverageanalysis'] = 'Esegui analisi di code coverage';
$string['codecoveragecompletereport'] = '(visualizza il report dell\'analisi)';
$string['codecoveragedisabled'] = 'In questo server non è possibile abilitare il code coverage (manca l\'estensione xdebug)';
$string['codecoveragelatestdetails'] = '(al {$a->date} su {$a->files} l\'analisi è al {$a->percentage})';
$string['codecoveragelatestreport'] = 'visualizza il report di code coverage più recente';
$string['confignonwritable'] = 'Il file config.php non è scrivibile dal web server. Cambia i suoi attributi, o modificalo con un account abilitato. e aggiungi la seguente riga prima del tag di chiusura del php:

$CFG->unittestprefix = \'tst_\' // Change tst_ to a prefix of your choice, different from $CFG->prefix';
$string['coveredlines'] = 'Linee analizzate';
$string['coveredpercentage'] = 'Code coverage complessivo';
$string['dbtest'] = 'Functional DB test';
$string['deletingnoninsertedrecord'] = 'Tentativo di eliminazione di un record che non è stato inserito da queste unità di test (id {$a->id} in tabella {$a->table}).';
$string['deletingnoninsertedrecords'] = 'Tentativo di eliminazione di record che non sono stati inseriti da queste unità di test (da tabella {$a->table}).';
$string['droptesttables'] = 'Elimina tabelle di test';
$string['exception'] = 'Eccezione';
$string['executablelines'] = 'Linee eseguibili';
$string['fail'] = 'Non superato';
$string['ignorefile'] = 'Ignora i test nel file';
$string['ignorethisfile'] = 'Riesegui i test ignorando questo file di test.';
$string['installtesttables'] = 'Installa tabelle di test';
$string['moodleunittests'] = 'Moodle unit test: {$a}';
$string['notice'] = 'Nota';
$string['onlytest'] = 'Esegui i test solamente in';
$string['othertestpages'] = 'Altre pagine di test';
$string['pass'] = 'Superato';
$string['pathdoesnotexist'] = 'Il percorso \'{$a}\' non esiste';
$string['pluginname'] = 'Unit test';
$string['prefix'] = 'Prefisso tabelle di test';
$string['prefixnotset'] = 'Il prefisso della tabella di test non è configurato. Riempi e invia questo form  per aggiungerlo al file config.php.';
$string['reinstalltesttables'] = 'Reinstalla tabelle di test';
$string['retest'] = 'Riesegui i test';
$string['retestonlythisfile'] = 'Riesegui solo questo file di test.';
$string['runall'] = 'Esegui i test da tutti i file di test';
$string['runat'] = 'Eseguito il {$a}.';
$string['runonlyfile'] = 'Esegui solo i test in questo file';
$string['runonlyfolder'] = 'Esegui solo i test in questa cartella';
$string['runtests'] = 'Esegui test';
$string['rununittests'] = 'Esegui unit test';
$string['showpasses'] = 'Mostra sia test superati sia test non superati';
$string['showsearch'] = 'Mostra la ricerca dei file di test';
$string['skip'] = 'Salta';
$string['stacktrace'] = 'Traccia dello stack:';
$string['summary'] = '{$a->run}/{$a->total} test completi: <strong>{$a->passes}</strong> superati, <strong>{$a->fails}</strong> non superati<strong>{$a->exceptions}</strong> eccezioni.';
$string['tablesnotsetup'] = 'Le tabelle per l\'unità di test non sono ancora state create. Le vuoi creare adesso?';
$string['testdboperations'] = 'Operazioni di test del Database';
$string['testtablescsvfileunwritable'] = 'Il file CSV per le tabelle di test non è scrivibile ({$a->filename})';
$string['testtablesneedupgrade'] = 'Le tabelle di DB per il test devono essere aggiornate. Vuoi procedere con l\'aggiornamento adesso?';
$string['testtablesok'] = 'Le tabelle di DB per il test sono state correttamente installate.';
$string['thorough'] = 'Esegui un test completo (può durare a lungo)';
$string['timetakes'] = 'Tempo impiegato: {$a}.';
$string['totallines'] = 'Linee totali';
$string['uncaughtexception'] = 'Eccezione non prevista [{$a->getMessage()}] in [{$a->getFile()}:{$a->getLine()}] TEST INTERROTTO.';
$string['uncoveredlines'] = 'Linee non analizzate';
$string['unittest:execute'] = 'Eseguire unit test';
$string['unittestprefixsetting'] = 'Prefisso test: <strong>{$a->unittestprefix}</strong> (Aggiorna config.php per modificarlo).';
$string['unittests'] = 'Unit test';
$string['updatingnoninsertedrecord'] = 'Tentativo di modifica di un record non ancora inserito da questi test (id {$a->id} in tabella {$a->table}).';
$string['version'] = 'Utilizzato <a href="http://sourceforge.net/projects/simpletest/">SimpleTest</a> versione {$a}.';
