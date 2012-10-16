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
 * Strings for component 'qtype_randomsamatch', language 'es', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_randomsamatch
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addingrandomsamatch'] = 'Agregando una pregunta de emparejamiento de respuesta corta aleatoria';
$string['editingrandomsamatch'] = 'Editando una pregunta de emparejamiento de respuesta corta aleatoria';
$string['nosaincategory'] = 'No existen preguntas de respuesta corta en la categoría elegida \'{$a->catname}\'. Elija una categoría diferente e incluya algunas preguntas en ella.';
$string['notenoughsaincategory'] = '{$a->nosaquestions} preguntas de respuesta corta en la categoría elegida \'{$a->catname}\'. Elija una categoría diferente, incluya algunas preguntas en ella o reduzca la cantidad de preguntas seleccionadas.';
$string['randomsamatch'] = 'Pregunta de emparejamiento de respuesta corta aleatoria';
$string['randomsamatch_help'] = 'Desde la perspectiva del estudiante, esta se parece a una pregunta de emparejamiento. La diferencia es que la lista de nombres o estamentos (preguntas) para emparejar sem presentan aleatoriamente a partir de las preguntas de respuesta corta de la categoría actual.
Debería haber un número suficiente de preguntas cortas sin usar en la categoría, si no, se mostrará un mensaje de error.';
$string['randomsamatchsummary'] = 'Es similar a la pregunta de emparejamiento, pero se crea aleatoriamente a partir de las preguntas de respuesta corta de una categoría particular.';
