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
 * Strings for component 'plagiarism_turnitin', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   plagiarism_turnitin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['compareinstitution_help'] = 'Esta opção está disponível apenas caso tenha configurado/adquirido um nodo personalizado. Isto deve estar configurado como "Não" caso não tenha certeza.';
$string['compareinternet_help'] = 'Esta opção permite que dados submetidos sejam comparados com conteúdo na internet o qual o serviço Turnitim indexa.';
$string['comparejournals_help'] = 'Esta opção permite que submissões sejam comparadas com Jornais, periódicos e publicações que Turnitin atualmente indexa';
$string['comparestudents_help'] = 'Esta opção permite que submissões sejam comparadas com a de outros arquivos de estudantes';
$string['excludebiblio_help'] = 'Materiais bibliográficos também podem ser incluídos e excluídos na visualização do relatório de originalidade. Esta configuração não pode ser modificada depois que o primeiro arquivo for enviado.';
$string['reportgen_help'] = 'Esta opção permite selecionar quando o Relatório de Originalidade deve ser gerado.';
$string['studentdisclosuredefault'] = 'Todos os arquivos serão enviados ao serviço de detecção de plágio Turnitin.com';
$string['studentdisclosure_help'] = 'Este texto será exibido para todos os estudantes na página de envio de arquivos.';
$string['submitondraft'] = 'Enviar arquivo quando o primeiro for enviado';
$string['submitonfinal'] = 'Envie arquivo quando o estudante enviar para apontamento';
$string['teacherlogin'] = 'Acessar Turnitin como professor';
$string['tii'] = 'Turnitin';
$string['tiiaccountid'] = 'ID da conta Turnitin';
$string['tiiaccountid_help'] = 'Este e seu ID de sua conta conforme providenciado de Turnitin.com';
$string['tiiapi'] = 'API Turnitin';
$string['tiiapi_help'] = 'Este é seu endereço da API Turnitin - usualmente https://api.turnitin.com/api.asp';
$string['tiiconfigerror'] = 'Um erro de configuração ocorreu ao tentar enviar este arquivo ao Turnitin';
$string['tiiemailprefix'] = 'Prefixo do email do estudante';
$string['tiiemailprefix_help'] = 'Você deve configurar isto se não deseja que estudantes acessem turnitin.com site e visualizem relatórios completos';
$string['tiisecretkey'] = 'Chave secreta Turnitin';
$string['tiisecretkey_help'] = 'Acesse Turnitin.com como o administrador do site para obter isto.';
$string['tiisenduseremail'] = 'Enviar email ao usuário';
$string['tiisenduseremail_help'] = 'Envia e-mail para cada estudante criado no sistema TII com um link permitindo acesso a www.turnitin.com com uma senha temporária.';
$string['turnitin'] = 'Turnitin';
$string['turnitin_attemptcodes_help'] = 'Código de erros que Turnitin usualmente aceita em uma segunda tentativa (Mudanças neste campo podem causar eventual excesso de tráfego no seu servidor)';
$string['turnitin_attempts'] = 'Número de novas tentativas';
$string['turnitindefaults'] = 'Padrões Turnitin';
$string['turnitinerrors'] = 'Erros Turnitin';
$string['useturnitin'] = 'Habilitar Turnitin';
