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
 * Strings for component 'condition', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'Lägg till {no} villkor för aktivitet i formuläret';
$string['addgrades'] = 'Lägg till {no} villkor för betyg/omdömen i formuläret';
$string['availabilityconditions'] = 'Begränsa tillgänglighet';
$string['availablefrom'] = 'Tillgänglig fr o m';
$string['availableuntil'] = 'Tillgänglig t o m';
$string['badavailabledates'] = 'Ogiltiga datum. Om du registrerar två datum måste "tillgänglig från" vara innan "till"-datum.';
$string['completion_complete'] = 'måste vara markerad som fullföljd';
$string['completion_fail'] = 'måste vara färdig med underkänt betyg';
$string['completion_incomplete'] = 'behöver inte vara markerad som fullföljd';
$string['completion_pass'] = 'måste vara fullföljd och godkänd';
$string['completioncondition'] = 'Villkor för fullflöljande av villkor';
$string['configenableavailability'] = 'När aktiverad, kan du ange villkor (baserat på datum, betyg, eller slutförande) som styr om en aktivitet är tillgänglig.';
$string['enableavailability'] = 'Aktivera villkorad tillgänglighet';
$string['grade_atleast'] = 'måste vara åtminstone';
$string['grade_upto'] = 'och mindre än';
$string['gradecondition'] = 'Villkor för betyg/omdöme';
$string['none'] = '(none)';
$string['notavailableyet'] = 'Inte tillgänglig ännu';
$string['requires_completion_0'] = 'Inte tillgänglig om aktiviteten <strong>{$a}</strong> inte är slutförd.';
$string['requires_completion_1'] = 'Inte tillgänglig förrän aktiviteten <strong>{$a}</strong> är markerad färdig.';
$string['requires_completion_2'] = 'Inte tillgänglig förrän aktiviteten <strong>{$a}</strong> är färdig och godkänd.';
$string['requires_completion_3'] = 'Inte tillgänglig om inte aktiviteten <strong>{$a}</strong> är färdig och misslyckad.';
$string['requires_date'] = 'Tillgänglig fr o m {$a}';
$string['requires_date_before'] = 'Tillgänglig t o m {$a}';
$string['requires_date_both'] = 'Tillgänglig fr o m {$a->from} t o m
{$a->until}.';
$string['requires_grade_any'] = 'Inte tillgänglig tills du har ett betyg i <strong>{$a}</strong>.';
$string['requires_grade_max'] = 'Inte tillgängligt om du inte får ett tillräckligt poäng på <strong>{$a}</strong>.';
$string['requires_grade_min'] = 'Inte tillgänglig förrän du har fått det poäng som krävs på <strong>{$a}</strong>.';
$string['requires_grade_range'] = 'Inte tillgängligt om du inte får ett speciellt på på <strong>{$a}</strong>.';
$string['showavailability'] = 'Innan aktiviteten är tillgänglig';
$string['showavailability_hide'] = 'Dölj denna aktivitet helt och hållet';
$string['showavailability_show'] = 'Visa aktivitet utgråad med begränsad information';
$string['userrestriction_hidden'] = 'Begränsad tillgång (helt dold, gömd, inget meddelande): ‘{$a}’';
$string['userrestriction_visible'] = 'Begränsad tillgång: ‘{$a}’';
