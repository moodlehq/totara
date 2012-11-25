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
 * Strings for component 'dbtransfer', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   dbtransfer
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['checkingsourcetables'] = 'Sprawdzenie struktury tabeli źródłowej';
$string['copyingtable'] = 'Kopiowanie tabeli {$a}';
$string['copyingtables'] = 'Kopiowanie zawartości tabeli';
$string['creatingtargettables'] = 'Tworzenie tabel w docelowej bazie danych';
$string['dbexport'] = 'Eksport bazy danych';
$string['dbtransfer'] = 'Transfer bazy danych';
$string['differenttableexception'] = 'Struktura tabeli {$a} nie pasuje.';
$string['done'] = 'Wykonano';
$string['exportschemaexception'] = 'Aktualna struktura bazy danych nie pasuje do wszystkich plików install.xml. <br /> {$a}';
$string['importschemaexception'] = 'Aktualna struktura bazy danych nie pasuje do wszystkich plików install.xml. <br /> {$a}';
$string['importversionmismatchexception'] = 'Obecna wersja {$a->currentver} nie pasuje do wersji wyeksportowanej {$a->schemaver}.';
$string['malformedxmlexception'] = 'Znaleziono błędy XML, nie można kontynuować.';
$string['unknowntableexception'] = 'Znaleziono nieznana tabelę: {$a} w pliku eksportu.';
