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
 * Strings for component 'auth_cas', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_cas
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesCAS'] = 'Usuários CAS';
$string['accesNOCAS'] = 'outros usuários';
$string['auth_cas_auth_user_create'] = 'Criar usuários externamente';
$string['auth_cas_baseuri'] = 'URI do servidor (nada se não existir uma baseUri))<br />Por exemplo, se o servidor responde a um endereço como host.domaine.fr/CAS/ então<br />cas_baseuri = CAS/';
$string['auth_cas_baseuri_key'] = 'Base URI';
$string['auth_cas_broken_password'] = 'Você não pode prosseguir sem alterar sua senha, contudo não existe nenhuma página disponível para alterá-la. Por favor, contate seu administrador do Moodle.';
$string['auth_cas_cantconnect'] = 'A parte LDAP do CAS-module não pode conectar ao servidor: {$a}';
$string['auth_cas_casversion'] = 'Versão do protocolo CAS';
$string['auth_cas_certificate_check'] = 'Selecione "sim" se você quiser validar o certificado do servidor';
$string['auth_cas_certificate_check_key'] = 'Validação de servidor';
$string['auth_cas_certificate_path'] = 'Caminho do arquivo da cadeia de CA (formato PEM) para validar o certificado do servidor';
$string['auth_cas_certificate_path_empty'] = 'Se você ativar a validação de servidor, você precisará especificar um caminho de certificado';
$string['auth_cas_certificate_path_key'] = 'Caminho do certificado';
$string['auth_cas_changepasswordurl'] = 'Página de mudança de senha';
$string['auth_cas_create_user'] = 'Ativar esta opção se você quiser inserir usuários autenticados pelo CAS no DB do Moodle. Caso contrário, apenas os usuários inseridos no DB do Moodle podem fazer o login.';
$string['auth_cas_create_user_key'] = 'Criar usuário';
$string['auth_casdescription'] = 'Este método usa um servidor CAS (Central Authentication Service) para autenticar os usuários em SSO (Single Sign On environment). Você também pode usar uma simples autenticação LDAP. Se um usuário e uma senha são válidos para o CAS, o Moodle cria um novo usuário no DB utilizando os atributos do LDAP se necerrário. Nos logins seguintes apenas o nome do usuário e a senha serão verificados.';
$string['auth_cas_enabled'] = 'Ative esta opção para utilizar a autenticação CAS.';
$string['auth_cas_hostname'] = 'Hostname do servidor CAS <br />ex.: host.domain.br';
$string['auth_cas_hostname_key'] = 'Hostname';
$string['auth_cas_invalidcaslogin'] = 'O seu login não foi autorizado';
$string['auth_cas_language'] = 'Selecione o idioma para as páginas de autenticação';
$string['auth_cas_language_key'] = 'Idioma';
$string['auth_cas_logincas'] = 'Acesso com conexão segura';
$string['auth_cas_logoutcas'] = 'Mude para \'sim\' se quiser fazer logout do CAS quando desconectar do Moodle';
$string['auth_cas_logoutcas_key'] = 'Sair do CAS';
$string['auth_cas_multiauth'] = 'Mude para \'sim\' se quiser ter multi-autenticação (CAS + outra autenticação)';
$string['auth_cas_multiauth_key'] = 'Multi-autenticação';
$string['auth_casnotinstalled'] = 'Não é possível utilizar a autenticação CAS. O módulo PHP LDAP não está instalado.';
$string['auth_cas_port'] = 'Porta do servidor CAS';
$string['auth_cas_port_key'] = 'Porta';
$string['auth_cas_proxycas'] = 'Mude para \'sim\' se quiser usar a modalidade proxy CASin';
$string['auth_cas_proxycas_key'] = 'Modalidade proxy';
$string['auth_cas_server_settings'] = 'Configuração do servidor CAS';
$string['auth_cas_text'] = 'Conexão segura';
$string['auth_cas_use_cas'] = 'Usar CAS';
$string['auth_cas_version'] = 'Versão do protocolo CAS';
$string['CASform'] = 'Escolha de autenticação';
$string['noldapserver'] = 'Nenhum servidor LDAP configurado para CAS! Sincronização desativada';
$string['pluginname'] = 'Usar um servidor (SSO) CAS';
