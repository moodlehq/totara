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
 * Strings for component 'debug', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   debug
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['authpluginnotfound'] = 'Plugin de autenticação {$a} não encontrado.';
$string['blocknotexist'] = 'Bloco {$a} não existe';
$string['cannotbenull'] = '{$a} não pode ser nulo!';
$string['cannotdowngrade'] = 'Não pode voltar {$a->plugin} da versão {$a->oldversion} para a versão {$a->newversion}.';
$string['cannotfindadmin'] = 'Não foi possível encontrar um usuário admin!';
$string['cannotinitpage'] = 'Não foi possível inciar por completo a página: inválido {$a->name} id {$a->id}';
$string['cannotsetuptable'] = '{$a} tabelas NÃO puderam ser configuradas com sucesso!';
$string['codingerror'] = 'Erro de codificação detectado e deve ser corrigido por um programador: {$a}';
$string['configmoodle'] = 'O Moodle ainda não foi configurado. Primeiro você precisa editar o config.php.';
$string['erroroccur'] = 'Um erro ocorreu durante este processo';
$string['invalidarraysize'] = 'Tamanho incorreto dos arrays nos parâmetros de {$a}';
$string['invalideventdata'] = 'Foram enviados dados do evento incorretos: {$a}';
$string['invalidparameter'] = 'Valor inválido de parâmetro detectado';
$string['invalidresponse'] = 'Valor inválido de resposta detectado';
$string['missingconfigversion'] = 'Tabela config não contém versão, impossível continuar, desculpe.';
$string['modulenotexist'] = 'Módulo {$a} não existe';
$string['morethanonerecordinfetch'] = 'Encontrado mais de um registro no fetch() !';
$string['mustbeoveride'] = 'O método abstrato {$a} deve ser sobrescrito.';
$string['noactivityname'] = 'Objeto de página derivado de  page_generic_activity , mas não define $this->activityname';
$string['noadminrole'] = 'Nenhuma função admin foi encontrada';
$string['noblocks'] = 'Nenhum bloco instalado!';
$string['nocate'] = 'Nenhuma categoria!';
$string['nomodules'] = 'Nenhum módulo encontrado!!';
$string['nopageclass'] = '{$a} importado, porém nenhuma classe de página foi encontrada';
$string['noreports'] = 'Nenhum relatório acessível';
$string['notables'] = 'Nenhuma tabela!';
$string['phpvaroff'] = 'A variável PHP do servidor \'{$a->name}\' deve estar desativada (Off) - {$a->link}';
$string['phpvaron'] = 'A variável PHP do servidor \'{$a->name}\' deve estar ativada (On) - {$a->link}';
$string['sessionmissing'] = 'Objeto {$a} não está presente na sessão';
$string['sqlrelyonobsoletetable'] = 'Esta consulta SQL faz referência em tabela(s) obsoleta(s) : {$a}! Seu código deve ser corrigido por um desenvolvedor.';
$string['withoutversion'] = 'O arquivo version.php principal não foi encontrado, não tem permissão de leitura ou está corrompido.';
$string['xmlizeunavailable'] = 'Função xmlize não está disponível';
