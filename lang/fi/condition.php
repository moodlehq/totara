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
 * Strings for component 'condition', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'Lisää {no} aktiviteettiehtoa lomakkeeseen';
$string['addgrades'] = 'Lisää {no} arvosanaehtoa lomakkeeseen';
$string['availabilityconditions'] = 'Rajoita pääsy';
$string['availablefrom'] = 'Salli pääsy alkaen';
$string['availablefrom_help'] = 'Avoinna alkaen/saakka -päivämäärät määrittävät koska opiskelijat pääsevät aktiviteettiin kurssisivulla olevasta linkistä.
Ero aktiviteetin avoinna alkaen/saakka -päivämäärien ja saatavuusasetusten välillä on se, että aikarajojen ulkopuolella jälkimmäinen asetus antaa opiskelijoiden nähdä aktiviteetin kuvauksen, kun taas aktiviteetin avoinna alkaen/saakka -päivämäärät estävät pääsyn kokonaan.';
$string['availableuntil'] = 'Salli pääsy saakka';
$string['badavailabledates'] = 'Virheelliset päivämäärät. Jos asetat molemmat päivämäärät, \'avoinna alkaen\' -päivämäärän täytyy olla ennen \'avoinna saakka\' -päivämäärää.';
$string['badgradelimits'] = 'Jos asetat arvosanalle sekä ylä- että alarajan, täytyy ylärajan olla korkeampi kuin alarajan.';
$string['completion_complete'] = 'merkittävä suoritetuksi';
$string['completion_fail'] = 'suoritettava hylätyllä arvosanalla';
$string['completion_incomplete'] = 'ei saa olla merkitty suoritetuksi';
$string['completion_pass'] = 'suoritettava hyväksytyllä arvosanalla';
$string['completioncondition'] = 'Aktiviteetin suoritusehdot';
$string['completioncondition_help'] = 'Tämä asetus määrittelee aktiviteettien suoritus -ehdot, joiden täytyy täyttyä ennen tähän aktiviteettiin pääsyä. Huomaa että kurssisuoritusten seurannan täytyy olla asetettu ennen kuin aktiviteetin suoritus -ehtoa voidaan asettaa.
Haluttaessa voidaan asettaa useita aktiviteetin suoritus -ehtoja. Tässä tapauksessa KAIKKIEN ehtojen pitää täyttyä ennen kuin aktiviteettin pääsee.';
$string['configenableavailability'] = 'Jos sallittu, voit määritellä julkaisuehdot (perustuen päivämäärään, arvosanaan tai suoritukseen) jotka määrittelevät onko aktiviteetti saatavilla.';
$string['enableavailability'] = 'Salli ehdollinen julkaisu';
$string['grade_atleast'] = 'oltava vähintään';
$string['grade_upto'] = 'ja vähemmän kuin';
$string['gradecondition'] = 'Arvosanan ehto';
$string['gradecondition_help'] = 'Tämä asetus määrittelee arvosanaehdot, joiden pitää täyttyä ennen aktiviteettiin pääsyä.
Haluttaessa voidaan asettaa useita arvosanaehtoja. Tässä tapauksessa KAIKKIEN arvosanaehtojen pitää täyttyä ennen kuin aktiviteettin pääsee.';
$string['gradeitembutnolimits'] = 'Sinun täytyy antaa ylä- tai alaraja, tai molemmat.';
$string['gradelimitsbutnoitem'] = 'Sinun täytyy valita arvosanakohde.';
$string['gradesmustbenumeric'] = 'Minimi ja maksimi arvosanojen täytyy olla numeerisia (tai tyhjiä).';
$string['none'] = '(ei mitään)';
$string['notavailableyet'] = 'Ei vielä saatavilla';
$string['requires_completion_0'] = 'Ei saatavilla ellei aktiviteetti <strong>{$a}</strong> ole keskeneräinen.';
$string['requires_completion_1'] = 'Ei saatavilla kunnes aktiviteetti <strong>{$a}</strong> on merkitty suoritetuksi.';
$string['requires_completion_2'] = 'Ei saatavilla kunnes aktiviteetti <strong>{$a}</strong> on suoritettu ja läpäisty.';
$string['requires_completion_3'] = 'Ei saatavilla kunnes aktiviteetti <strong>{$a}</strong> on suoritettu ja hylätty.';
$string['requires_date'] = 'Saatavilla {$a} lähtien.';
$string['requires_date_before'] = 'Saatavilla {$a} saakka.';
$string['requires_date_both'] = 'Saatavilla {$a->from} lähtien {$a->until} saakka.';
$string['requires_date_both_single_day'] = 'Saatavilla {$a}.';
$string['requires_grade_any'] = 'Ei saatavilla kunnes sinulla on arvosana <strong>{$a}</strong>:ssa.';
$string['requires_grade_max'] = 'Ei saatavilla ellet saa kelvollista tulosta aktiviteetissa <strong>{$a}</strong>.';
$string['requires_grade_min'] = 'Ei saatavilla ellet saa vaadittua arvosanaa aktiviteetissa: <strong>{$a}</strong>.';
$string['requires_grade_range'] = 'Ei saatavilla ellet saa tiettyä arvosanaa aktiviteetissa <strong>{$a}</strong>.';
$string['showavailability'] = 'Muulloin kuin aktiviteettiin pääsyn aikana';
$string['showavailability_hide'] = 'Piilota aktiviteetti kokonaan';
$string['showavailability_show'] = 'Näytä aktiviteetti harmaana pääsyvaatimusten kanssa';
$string['userrestriction_hidden'] = 'Estetty (kokonaan piilossa, ei viestiä): &lsquo;{$a}&rsquo;';
$string['userrestriction_visible'] = 'Estetty: &lsquo;{$a}&rsquo;';
