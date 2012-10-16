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
 * Strings for component 'rating', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   rating
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aggregateavg'] = 'Média das avaliações';
$string['aggregatecount'] = 'Contagem das avaliações';
$string['aggregatemax'] = 'Avaliação máxima';
$string['aggregatemin'] = 'Avaliação mínima';
$string['aggregatenone'] = 'Nenhuma avaliação';
$string['aggregatesum'] = 'Soma das avaliações';
$string['aggregatetype'] = 'Tipo agregado';
$string['aggregatetype_help'] = 'O tipo de agregação define como as avaliações são combinadas para forma a nota final no livro de notas.

*Média das avaliações - A média das notas
*Contágem das avaliações - O número de itens avaliados geram a nota final. Note que o total não pode exceder a nota máxima para a atividade.
*Máxima - A melhor avaliação se torna a nota final
*Mínimo - A pior avaliação se torana a nota final
*Soma - Todas as notas juntas. Note que o total não pode exceder a nota máxima para a atividade.

Se "Nenhuma avaliação" estiver selecionado, a atividade não aparecerá no livro de notas.';
$string['allowratings'] = 'Permitir que os itens sejam avaliados?';
$string['allratingsforitem'] = 'Todas as avaliações enviadas';
$string['capabilitychecknotavailable'] = 'Verificação de permissão não disponível até que a atividade seja salva';
$string['couldnotdeleteratings'] = 'Lamentamos, isto não pode ser deletado pois já foi avaliado.';
$string['norate'] = 'Avaliação dos itens não permitida!';
$string['noratings'] = 'Nenhuma avaliação enviada';
$string['noviewanyrate'] = 'Você só pode ver os resultados dos itens que você fez';
$string['noviewrate'] = 'Você não tem a capacidade para visualizar avaliações de itens';
$string['rate'] = 'Avaliar';
$string['ratepermissiondenied'] = 'Você não tem permissão para avaliar este item';
$string['rating'] = 'Avaliação';
$string['ratinginvalid'] = 'Avaliação é inválida';
$string['ratings'] = 'Avaliações';
$string['ratingtime'] = 'Permitir avaliações apenas para os itens com datas neste intervalo:';
$string['rolewarning'] = 'Funções com permissão para avaliar';
$string['rolewarning_help'] = 'Para submeter avaliações, usuários necessitam a capaciadade moodle/rating:rate e qualquer capacidade especifica do módulo. Aos usuários que possuem os seguintes papéis deve ser possível avaliar itens. A lista de papéis deve ser alterada através do link de permissões no bloco de configurações';
