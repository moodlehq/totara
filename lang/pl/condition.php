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
 * Strings for component 'condition', language 'pl', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'Dodaj {no} warunki czynności do formularza';
$string['addgrades'] = 'Dodaj {no} warunek(ki) ocen do formularza';
$string['availabilityconditions'] = 'Ogranicz dostęp';
$string['availablefrom'] = 'Zezwól na dostęp z';
$string['availableuntil'] = 'Zezwalaj na dostęp do';
$string['badavailabledates'] = 'Niepoprawne daty. W przypadku ustawienia obu dat data "dostępny od" powinna być wcześniejsza niż data "do".';
$string['completion_complete'] = 'musi być oznaczone jako ukończone';
$string['completion_fail'] = 'musi być zakończone z oceną negatywną';
$string['completion_incomplete'] = 'nie może być oznaczone jako ukończone';
$string['completion_pass'] = 'musi być zakończone z oceną pozytywną';
$string['completioncondition'] = 'Warunek ukończenia czynności';
$string['configenableavailability'] = 'Gdy opcja jest włączona, umożliwia na ustawienie warunków (w oparciu o datę, ocenę lub ukończenie) dostępu do aktywności.';
$string['enableavailability'] = 'Włącz dostęp warunkowy';
$string['grade_atleast'] = 'mysi być co najmniej';
$string['grade_upto'] = 'i mniej niż';
$string['gradecondition'] = 'Warunki ocen';
$string['gradecondition_help'] = 'To ustawienie określa dowolne warunki dla ocen, które muszą być spełnione w celu uzyskania dostępu do tej aktywności.
W razie potrzeby mogą być ustawione wielokrotne warunki. W takim przypadku aktywność będzie dostępna tylko po spełnieniu WSZYSTKICH warunków.';
$string['none'] = '(żaden)';
$string['notavailableyet'] = 'Jeszcze nie dostepny';
$string['requires_completion_0'] = 'Niedostępne o ile czynność <strong>{$a}</strong> jest nieukończona.';
$string['requires_completion_1'] = 'Niedostępne dopóki aktywność <strong>{$a}</strong> nie zostanie oznaczona jako zakończona.';
$string['requires_completion_2'] = 'Niedostępne dopóki czynność <strong>{$a}</strong> jest ukończona i zaliczona.';
$string['requires_completion_3'] = 'Niedostępne dopóki czynność <strong>{$a}</strong> jest ukończona i niezaliczona.';
$string['requires_date'] = 'Dostępny od {$a}.';
$string['requires_date_before'] = 'Dostępny do {$a}.';
$string['requires_date_both'] = 'Dostępny od {$a->from} do {$a->until}.';
$string['requires_date_both_single_day'] = 'Dostępne na {$a}.';
$string['requires_grade_any'] = 'Niedostępne dopóki nie będziesz miał(a) oceny w <strong>{$a}</strong>.';
$string['requires_grade_max'] = 'Niedostępne chyba, że osiągniesz wymaganą punktację w <strong>{$a}</strong>.';
$string['requires_grade_min'] = 'Niedostępne dopóki nie osiągniesz wymaganej punktacji w <strong>{$a}</strong>.';
$string['requires_grade_range'] = 'Niedostępne, chyba że masz określony wynik w <strong>{$a}.</strong>';
$string['showavailability'] = 'Przed dostępem aktywność może być';
$string['showavailability_hide'] = 'Ukryj całkowicie aktywność';
$string['showavailability_show'] = 'Pokaż aktywność oznaczoną na szaro z informacją o ograniczeniach';
$string['userrestriction_hidden'] = 'Ograniczony (całkowicie ukryty, brak wiadomości): &lsquo;{$a}&rsquo;';
$string['userrestriction_visible'] = 'Ograniczony: &lsquo;{$a}&rsquo;';
