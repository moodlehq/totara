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
 * Strings for component 'auth_db', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_db
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_dbcantconnect'] = 'Não foi possível conectar ao banco de dados da autenticação especificada.';
$string['auth_dbchangepasswordurl_key'] = 'Página para mudança de senha';
$string['auth_dbdebugauthdb'] = 'Eliminar erros do ADOdb';
$string['auth_dbdebugauthdbhelp'] = 'Eliminar erros de conexão para banco de dados externo do ADOdb - use quando ocorrer a abertura de uma página vazia durante o início de uma sessão. Inapropriado para sites de produção.';
$string['auth_dbdeleteuser'] = 'Usuário apagado {$a->name} id {$a->id}';
$string['auth_dbdeleteusererror'] = 'Erro ao excluir usuário {$a}';
$string['auth_dbdescription'] = 'Este método usa uma tabela de uma base de dados externa para verificar se usuário e senha informados são válidos. Se a conta for nova, a informação de outros campos também será copiada para o Moodle.';
$string['auth_dbextencoding'] = 'Codificação do BD externo';
$string['auth_dbextencodinghelp'] = 'Codificação utilizada no banco de dados externo';
$string['auth_dbextrafields'] = 'Estes campos são opcionais. Pode-se optar por preencher alguns dos campos do usuário no Moodle com informação de <b>campos da base de dados externa</b> especificados aqui.<br />Deixando estes campos em branco, serão usados valores predefinidos.<br />Nos dois casos, o usuário poderá editar todos estes campos quando tiver entrado no sistema.';
$string['auth_dbfieldpass'] = 'Nome do campo que contém as senhas';
$string['auth_dbfieldpass_key'] = 'Campo de senha';
$string['auth_dbfielduser'] = 'Nome do campo que contém os "usernames"';
$string['auth_dbfielduser_key'] = 'Campo "username"';
$string['auth_dbhost'] = 'Computador que hospeda o servidor da base de dados.';
$string['auth_dbhost_key'] = 'Host';
$string['auth_dbinsertuser'] = 'Usuário inserido {$a->name} id {$a->id}';
$string['auth_dbinsertusererror'] = 'Erro ao inserir usuário {$a}';
$string['auth_dbname'] = 'Nome da base de dados';
$string['auth_dbname_key'] = 'Nome do BD';
$string['auth_dbpass'] = 'Senha correspondente ao usuário acima';
$string['auth_dbpass_key'] = 'Senha';
$string['auth_dbpasstype'] = '<p>Especifique o formato do campo "password" está usando. Hash MD5 é útil para conexões com outras aplicações web como PostNuke.</p><p>Use "interno" se você quiser que o banco de dados externo gerencie "usernames" e endereços de email mas que o Moodle gerencie as senha. Se você utilizar "interno" você <i>deve</i> informar um campo "email" populado no banco de dados externo e você deve executar admin/cron.php e auth/db/cli/sync_users.php regularmente. O Moodle enviará um email para novos usuários com uma senha temporária';
$string['auth_dbpasstype_key'] = 'Formato de senha';
$string['auth_dbreviveduser'] = 'Usuário {$a->name} id {$a->id} reativado';
$string['auth_dbrevivedusererror'] = 'Erro ao reativar usuário {$a}';
$string['auth_dbsetupsql'] = 'Comando SQL para setup';
$string['auth_dbsetupsqlhelp'] = 'Comando SQL para um setup especial do banco de dados, geralmente usado para configurar a codificação da comunicação - exemplo para MySQL e PostgreSQL: <em>SET NAMES \'utf8\'</em>';
$string['auth_dbsuspenduser'] = 'Usuário suspenso {$a->name} id {$a->id}';
$string['auth_dbsuspendusererror'] = 'Erro ao suspender usuário {$a}';
$string['auth_dbsybasequoting'] = 'Usar aspas sybase';
$string['auth_dbsybasequotinghelp'] = 'Estilo de aspas sybase - necessário no Oracle, MS SQL e alguns bancos de dados. Não use no MySQL!';
$string['auth_dbtable'] = 'Nome da tabela na base de dados';
$string['auth_dbtable_key'] = 'Tabela';
$string['auth_dbtype'] = 'O tipo de banco de dados (veja <a href="http://phplens.com/adodb/supported.databases.html" target="_blank">ADOdb documentation</a> para mais detalhes)';
$string['auth_dbtype_key'] = 'Banco de dados';
$string['auth_dbupdatinguser'] = 'Atualizando usuário {$a->name} id {$a->id}';
$string['auth_dbuser'] = 'Usuário com permissão de leitura da base de dados';
$string['auth_dbuser_key'] = 'Usuário do BD';
$string['auth_dbusernotexist'] = 'Não é possível atualizar usuário que não existe: {$a}';
$string['auth_dbuserstoadd'] = 'Entradas de usuário a acrescentar: {$a}';
$string['auth_dbuserstoremove'] = 'Entradas de usuário a remover: {$a}';
$string['pluginname'] = 'Use um banco de dados externo';
