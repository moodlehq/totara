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
 * Strings for component 'condition', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = '{no} tevékenységfeltétel hozzáadása az űrlaphoz';
$string['addgrades'] = '{no} pontozási feltétel hozzáadása az űrlaphoz';
$string['availabilityconditions'] = 'Elérhetőség korlátozása';
$string['availablefrom'] = 'Ekkortól érhető el';
$string['availablefrom_help'] = 'Az \'Ekkortól érhető el\' és az \'Eddig érhető el\' dátumokkal a kurzusoldalon lévő ugróponton keresztül eltüntethet vagy megjeleníthet egy tevékenységet.
Az elérési dátumok és a tevékenység elérhetősége közötti különbség az, hogy a beállított időpontokon túl ez utóbbi esetén a tanulók látják a tevékenység leírását, míg az elérési dátumok teljesen megakadályozzák a hozzáférést.';
$string['availableuntil'] = 'Eddig érhető el';
$string['badavailabledates'] = 'Érvénytelen dátumok. Ha mind a kettőt beállítja, akkor az elérhetőség kezdetének meg kell előznie az elérhetőség végét.';
$string['badgradelimits'] = 'Ha alsó és felső határértéket állít be, a felsőnek az alsónál magasabbnak kell lenni.';
$string['completion_complete'] = 'teljesítettként kell megjelölni';
$string['completion_fail'] = 'elégtelennel teljesítettként kell megjelölni';
$string['completion_incomplete'] = 'teljesítettként nem lehet megjelölni';
$string['completion_pass'] = 'megfelelően teljesítettként kell megjelölni';
$string['completioncondition'] = 'Tevékenység teljesítési feltétele';
$string['completioncondition_help'] = 'Ezzel határozza meg azokat a tevékenységteljesítési feltételeket, amelyeknek eleget téve a tevékenység elérhetővé válik. Először a teljesítés nyomon követését kell beállítani, ezután következhet a tevékenység teljesítésének feltétele.
Egyszerre több teljesítési feltételt is megadhat. A tevékenység eléréséhez minden feltételnek teljesülnie kell.';
$string['configenableavailability'] = 'Bekapcsolása esetén olyan (dátumon, osztályzaton vagy teljesítésen alapuló) feltételeket állíthat be, amelyek befolyásolják a tevékenység vagy
tananyag elérhetőségét.';
$string['enableavailability'] = 'Feltételes elérhetőség bekapcsolása';
$string['grade_atleast'] = 'minimálisan';
$string['grade_upto'] = 'vagy kevesebb';
$string['gradecondition'] = 'Osztályzathoz kapcsolódó feltétel';
$string['gradecondition_help'] = 'Ezzel határozza meg azokat az osztályozási feltételeket, amelyeknek eleget téve a tevékenység elérhetővé válik.
Egyszerre több osztályozási feltételt is megadhat. A tevékenység eléréséhez MINDEN osztályozási feltételnek teljesülnie kell.';
$string['gradeitembutnolimits'] = 'Adjon  meg egy alsó vagy egy felső határértéket, vagy mindkettőt.';
$string['gradelimitsbutnoitem'] = 'Válasszon pontozási tételt.';
$string['gradesmustbenumeric'] = 'A minimális és a maximális pontszám számjegyes (vagy hagyja üresen).';
$string['none'] = '(egy sem)';
$string['notavailableyet'] = 'Még nem érhető el';
$string['requires_completion_0'] = 'Amíg <strong>{$a}</strong> tevékenység nincs teljesítve, addig nem elérhető.';
$string['requires_completion_1'] = 'Amíg <strong>{$a}</strong> tevékenység nincs teljesítettként bejelölve, addig nem elérhető.';
$string['requires_completion_2'] = 'Amíg <strong>{$a}</strong> tevékenység nincs megfelelően teljesítve, addig nem elérhető.';
$string['requires_completion_3'] = 'Amíg <strong>{$a}</strong> tevékenység nincs elégtelennel teljesítve, addig nem elérhető.';
$string['requires_date'] = '{$a} időponttól érhető el.';
$string['requires_date_before'] = '{$a} időpontig érhető el.';
$string['requires_date_both'] = 'Elérhető {$a->from} és {$a->until} között.';
$string['requires_date_both_single_day'] = 'Elérhetőség időpontja: {$a}.';
$string['requires_grade_any'] = 'Csak <strong>{$a}</strong> osztályzata esetén lesz elérhető.';
$string['requires_grade_max'] = 'Csak <strong>{$a}</strong> megfelelő osztályzata esetén lesz elérhető.';
$string['requires_grade_min'] = 'Csak <strong>{$a}</strong> osztályzat megfelelő pontszámának elérésekor lesz elérhető.';
$string['requires_grade_range'] = 'Csak <strong>{$a}</strong> osztályzat konkrét pontszámának elérésekor lesz elérhető.';
$string['showavailability'] = 'Mielőtt a tevékenység elérhető';
$string['showavailability_hide'] = 'Tevékenység teljes elrejtése';
$string['showavailability_show'] = 'Tevékenység leszürkített kijelzése korlátozási információkkal';
$string['userrestriction_hidden'] = 'Korlátozva (teljesen elrejtve, üzenet nélkül): &lsquo;{$a}&rsquo;';
$string['userrestriction_visible'] = 'Korlátozva: &lsquo;{$a}&rsquo;';
