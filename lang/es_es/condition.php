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
 * Strings for component 'condition', language 'es_es', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'Agregar {no} condiciones de actividad al formulario';
$string['addgrades'] = 'Agregar {no} condiciones de calificación al formulario';
$string['availabilityconditions'] = 'Restringir disponibilidad';
$string['availablefrom'] = 'Sólo está disponible en';
$string['availableuntil'] = 'Sólo está disponible al final';
$string['badavailabledates'] = 'Fechas no válidas. Si se ajustan ambas fechas, la fecha \'disponible desde\' debería ser anterior a la fecha \'hasta\'.';
$string['completion_complete'] = 'debe marcarse como completada';
$string['completion_fail'] = 'debe estar completa con calificación de suspenso';
$string['completion_incomplete'] = 'no debe estar marcada como completa';
$string['completion_pass'] = 'debe estar completa con calificación de aprobado';
$string['completioncondition'] = 'Condición de finalización de actividad';
$string['configenableavailability'] = 'Si se activa, esta opción le permite fijar las condiciones (basadas en la fecha, la calificación o el grado de finalización) que controlan si una actividad está disponible.';
$string['enableavailability'] = 'Habilitar acceso condicional';
$string['grade_atleast'] = 'debe ser al menos';
$string['grade_upto'] = 'y menos que';
$string['gradecondition'] = 'Condición de calificación';
$string['help_conditiondates'] = 'fechas disponibles';
$string['help_showavailability'] = 'visualización de las actividades disponibles';
$string['none'] = '(ninguna)';
$string['notavailableyet'] = 'Aún no disponible';
$string['requires_completion_0'] = 'No disponible a menos que la actividad <strong>{$a}</strong> esté incompleta.';
$string['requires_completion_1'] = 'No disponible hasta que la actividad <strong>{$a}</strong> esté marcada como completa.';
$string['requires_completion_2'] = 'No disponible a menos que la actividad <strong>{$a}</strong> esté completa y aprobada.';
$string['requires_completion_3'] = 'No disponible a menos que la actividad <strong>{$a}</strong> esté completa y suspensa.';
$string['requires_date'] = 'Disponible desde {$a}.';
$string['requires_date_before'] = 'Disponible hasta {$a}.';
$string['requires_date_both'] = 'Disponible desde {$a->from} hasta {$a->until}.';
$string['requires_grade_any'] = 'No disponible hasta que usted tenga una calificación en <strong>{$a}</strong>.';
$string['requires_grade_max'] = 'No disponible a menos que usted consiga una calificación apropiada en <strong>{$a}</strong>.';
$string['requires_grade_min'] = 'No disponible hasta que se alcance la puntuación mínima <strong>{$a}</strong>.';
$string['requires_grade_range'] = 'No disponible hasta que se alcance la puntuación establecida en la actividad <strong>{$a}</strong>.';
$string['showavailability'] = 'Está disponible antes de la actividad';
$string['showavailability_hide'] = 'Ocultar completamente la actividad';
$string['showavailability_show'] = 'Mostrar actividad en gris, sin información de restricción';
$string['userrestriction_hidden'] = 'Restringido (completamente oculto, no mensaje): &lsquo;{$a}&rsquo;';
$string['userrestriction_visible'] = 'Restringido: &lsquo;{$a}&rsquo;';
