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
 * Strings for component 'bulkusers', language 'es', branch 'MOODLE_22_STABLE'
 *
 * @package   bulkusers
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addall'] = 'Agregar todos';
$string['addsel'] = 'Agregar a la selección';
$string['allfilteredusers'] = 'Todos filtrados ({$a->count}/{$a->total})';
$string['allselectedusers'] = 'Todos seleccionados ({$a->count}/{$a->total})';
$string['allusers'] = 'Todos los usuarios ({$a})';
$string['available'] = 'Disponible';
$string['confirmmessage'] = '¿Realmente desea enviar el mensaje a todos los usuarios?<br />{$a}';
$string['nofilteredusers'] = 'No se han encontrado usuarios (0/{$a})';
$string['noselectedusers'] = 'No hay usuarios seleccionados';
$string['removeall'] = 'Eliminar todos';
$string['removesel'] = 'Eliminar de la selección';
$string['selected'] = 'Seleccionados';
$string['selectedlist'] = 'Lista de usuarios seleccionados...';
$string['selectedlist_help'] = '## Lista de usuarios seleccionados...

* Agregar usuarios seleccionados disponibles: Agrega a los usuarios seleccionados de la lista disponible (a la izquierda) a la lista seleccionada (a la derecha).
* Agregar todos los usuarios disponibles: Agrega a todos los usuarios de la lista disponible (a la izquierda) a la lista seleccionada (a la derecha).
* Eliminar usuarios seleccionados: Elimina a los usuarios seleccionados de la lista seleccionada (a la derecha).
* Eliminar todos los usuarios disponibles: Elimina a todos los usuarios de la lista disponible (a la izquierda) de la lista seleccionada (a la derecha).
* Limpiar usuarios seleccionados: Borra a los usuarios seleccionados de la lista seleccionada (a la derecha).
* Limpiar todos los usuarios: Borra a todos los usuarios de la lista seleccionada (a la derecha).';
$string['users'] = 'Usuarios';
$string['users_help'] = '## Listas de usuarios
La lista **disponible** contiene a los usuarios que han superado los filtros activos. Por ejemplo, si la sección de filtros activos contienen sólo un filtro para los usuarios cuyo país es España, entonces la lista disponible contendrá únicamente a los usuarios que hayan señalado España como su país en la página de perfil.
La lista **seleccionada** contiene a los usuarios que han sido agregados a la lista por usted, utilizando los botones de la sección *Lista de usuarios seleccionados...*. Cuando se pulsa el botón \*Ir\* en *Con los usuarios seleccionados...*, la operación seleccionada en esta sección se llevará a cabo sobre los usuarios de esta lista.';
$string['usersfound'] = '{$a} usuario(s) encontrado(s).';
$string['usersinlist'] = 'Usuarios en lista';
$string['usersselected'] = '{$a} usuario(s) seleccionado(s).';
