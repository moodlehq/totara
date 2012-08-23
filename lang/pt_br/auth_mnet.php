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
 * Strings for component 'auth_mnet', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_mnet_auto_add_remote_users'] = 'Quando marcado como Sim, um registro local do usuário é criado automaticamente quando o usuário remoto logar pelo primeira vez.';
$string['auth_mnetdescription'] = 'Usuários são autenticados de acordo com a rede de confiança definida nas configurações de rede do seu Moodle.';
$string['auth_mnet_roamin'] = 'Os usuários desse host podem passar para seu site.';
$string['auth_mnet_roamout'] = 'Seus usuários podem passar para esses hosts';
$string['auth_mnet_rpc_negotiation_timeout'] = 'O tempo máximo de esperar em segundos para autenticação pelo transporte XMLRPC.';
$string['auto_add_remote_users'] = 'Adicionar usuários remotos automaticamente';
$string['pluginname'] = 'Autenticação MNet';
$string['rpc_negotiation_timeout'] = 'Tempo de espera da negociação RPC';
$string['sso_idp_description'] = 'Publique este serviço para que seus usuários possam visitar o site {$a} sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>subscrever</strong> o SSO ( Provedor de Serviço) em {$a}.</li></ul><br />Subscreva este serviço para permitir aos usuários autenticados em {$a} o acesso ao seu site sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>publicar</strong> o SSO (Provedor de serviço) para {$a}.</li></ul><br />';
$string['sso_idp_name'] = 'SSO (Provedor de Identidade)';
$string['sso_mnet_login_refused'] = 'Usuário {$a->user} não tem permissão para autenticar-se a partir de {$a->host}.';
$string['sso_sp_description'] = 'Publicar este serviço para permitir que usuários autenticados de {$a} tenham acesso ao seu site sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>subscrever</strong> o serviço SSO (Provedor de Identidade) em {$a}.</li></ul><br />Subscreva este serviço para permitir que seus usuários visitem o site {$a} sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>publicar</strong> o serviço SSO (Provedor de Identidade) em {$a}.</li></ul><br />';
$string['sso_sp_name'] = 'SSO (Provedor do Serviço)';
