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
 * Strings for component 'enrol_mnet', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['error_multiplehost'] = 'Algumas instâncias de inscrição MNet já existem para este servidor. Apenas uma instãncia por servidor  e/ou uma instância para todos "Todos servidores" é permitida';
$string['instancename'] = 'Nome do método de inscrição';
$string['instancename_help'] = 'Você pode opcionalmente renomear esta instância do método de inscrição  MNET. Caso deixar este campo vazio, a instância padrão o nome padrão será utilizado, contendo o nome do servidor remoto e o papel associado para este usuário.';
$string['mnet_enrol_description'] = 'Publique este serviço para permitir que administradores de {$a} inscrevam estudantes em cursos que você criou no seu servidor.<br/><ul><li><em>Dependência</em>: Você deve também <strong>publicar</strong> o serviço SSO (Provedor de Serviço) para {$a}.</li><li><em>Dependência</em>: Você deve também <strong>subscrever</strong> no serviço SSO (Provedor de Identidade) em {$a}.</li></ul><br/>Subscrever este serviço para ser capaz de inscrever seus alunos em cursos em {$a}.<br/><ul><li><em>Dependência</em>: Você deve também <strong>subscrever</strong> o serviço SSO (Provedor de Serviço) em {$a}.</li><li><em>Dependência</em>: Você deve também <strong>publicar</strong> o serviço SSO (Provedor de Identidade) em {$a}.</li></ul><br/>';
$string['mnet_enrol_name'] = 'Cadastramento na Rede Moodle';
$string['pluginname'] = 'Inscrições remotas MNet';
$string['pluginname_desc'] = 'Permite que servidores MNet remotos inscrevam seus usuários nos seus cursos.';
$string['remotesubscriber'] = 'Servidores remotos';
$string['remotesubscriber_help'] = 'Selecione "Todos os servidores" para abrir este curso para todos os pares MNET que esteja oferecendo ao serviço de inscrições remotas. Ou escolha um único provedor para tornar este curso disponível para seus usuários apenas.';
$string['remotesubscribersall'] = 'Todos os servidores';
$string['roleforremoteusers'] = 'Papel para os usuários';
$string['roleforremoteusers_help'] = 'Qual papel será associado ao usuário remoto a partir do servidor selecionado.';
