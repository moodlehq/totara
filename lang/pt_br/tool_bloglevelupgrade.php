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
 * Strings for component 'tool_bloglevelupgrade', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_bloglevelupgrade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bloglevelupgradedescription'] = '<p>Este site foi atualizado recentemente para o  Moodle 2.0.</p>
<p>A visualização do Blog foi simplificada no 2.0, mas o seu site ainda usa uma das formas antigas de visualização </p>
<p>Para preservar a visualização dos textos incluidos nos blogs de cursos ou de grupos em seu site, você precisa executar o script a seguir, que irá criar um forum especial do tipo "blog" em cada curso em que os usuários tenham feito alguma postagem e irá copiar todas os textos do blog no forum especial. </p> <p>Os blogs então serão inteiramente removidos em nível de site. Nenhum texto existente em blogs será apagado no processo.</p>
<p>Você poderá executar o script visitando <a href="{$a->fixurl}">a página de atualização dos blogs</a>.</p>';
$string['bloglevelupgradeinfo'] = 'A visibilidade dos blogs foi simplificada no 2.0, mas seu site ainda usa uma das formas antigas de visibilidade. Para preservar a visibilidade por grupo ou por curso dos textos incluidos nos blogs em seu site, o seguinte script de atualização irá criar um fórum especial do tipo "blog" em cada curso em que os participantes tenham feito alguma postagem e irá copiar todas os textos do blog neste fórum especial. Os blogs então serão inteiramente desabilitados em nível de site. Nenhum texto existente em blogs será excluído no processo.';
$string['bloglevelupgradeprogress'] = 'Evolução da conversão:
{$a->userscount} usuários revistos,{$a->blogcount} entradas convertidas.';
$string['pluginname'] = 'Atualização da visibilidade dos blogs';
