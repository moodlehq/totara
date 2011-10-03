<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_dbcantconnect'] = 'Não foi possível conectar ao banco de dados da autenticação especificada.';
$string['auth_dbchangepasswordurl_key'] = 'Página para mudança de senha';
$string['auth_dbdebugauthdb'] = 'Eliminar erros do ADOdb';
$string['auth_dbdebugauthdbhelp'] = 'Eliminar erros de conexão para banco de dados externo do ADOdb - use quando ocorrer a abertura de uma página vazia durante o início de uma sessão. Inapropriado para sites de produção.';
$string['auth_dbdeleteuser'] = 'Usuário apagado $a[0] id $a[1]';
$string['auth_dbdeleteusererror'] = 'Erro ao deletar o usuário $a';
$string['auth_dbdescription'] = 'Este método usa uma tabela de uma base de dados externa para verificar se a senha e o nome do usuário são válidos. Se a conta for nova, a informação de outros campos também deve ser copiada no Moodle.';
$string['auth_dbextencoding'] = 'Codificação do BD externo';
$string['auth_dbextencodinghelp'] = 'Codificação utilizada no banco de dados externo';
$string['auth_dbextrafields'] = 'Estes campos são opcionais. Pode-se optar por preencher alguns dos campos do usuário no Moodle com informação de <b>campos da base de dados externa</b> especificados aqui.<br />Deixando estes campos em branco, serão usados valores predefinidos.<br />Nos dois casos, o usuário poderá editar todos estes campos quando tiver entrado no sistema.';
$string['auth_dbfieldpass'] = 'Nome do campo que contém as senhas';
$string['auth_dbfieldpass_key'] = 'Campo de senha';
$string['auth_dbfielduser'] = 'Nome do campo que contém os nomes de usuários';
$string['auth_dbfielduser_key'] = 'Campo para nome de usuário';
$string['auth_dbhost'] = 'Computador que hospeda o servidor da base de dados.';
$string['auth_dbhost_key'] = 'Host';
$string['auth_dbinsertuser'] = 'Usuário inserido $a[0] id $a[1]';
$string['auth_dbinsertusererror'] = 'Erro ao inserir usuário $a';
$string['auth_dbname'] = 'Nome da base de dados';
$string['auth_dbname_key'] = 'Nome do BD';
$string['auth_dbpass'] = 'Senha correspondente ao usuário acima';
$string['auth_dbpass_key'] = 'Senha';
$string['auth_dbpasstype'] = 'Indique o formato usado no campo de senhas. A codificação MD5 é útil na conexão com outras aplicações web comuns como PostNuke.';
$string['auth_dbpasstype_key'] = 'Formato de senha';
$string['auth_dbreviveduser'] = 'Usuário $a[0] id $a[1] reativado';
$string['auth_dbrevivedusererror'] = 'Erro ao reativar usuário $a';
$string['auth_dbsetupsql'] = 'Comando SQL para setup';
$string['auth_dbsetupsqlhelp'] = 'Comando SQL para um setup especial do banco de dados, geralmente usado para configurar a codificação da comunicação - exemplo para MySQL e PostgreSQL: <em>SET NAMES \'utf8\'</em>';
$string['auth_dbsuspenduser'] = 'Usuário suspenso $a[0] id $a[1]';
$string['auth_dbsuspendusererror'] = 'Erro ao suspender usuário $a';
$string['auth_dbsybasequoting'] = 'Usar aspas sybase';
$string['auth_dbsybasequotinghelp'] = 'Estilo de aspas sybase - necessário no Oracle, MS SQL e alguns bancos de dados. Não use no MySQL!';
$string['auth_dbtable'] = 'Nome da tabela na base de dados';
$string['auth_dbtable_key'] = 'Tabela';
$string['auth_dbtitle'] = 'Use um banco de dados externo';
$string['auth_dbtype'] = 'O tipo de banco de dados (veja <a href=\"../lib/adodb/readme.htm#drivers\"> Documentação do ADOdb</a> para mais detalhes)';
$string['auth_dbtype_key'] = 'Banco de dados';
$string['auth_dbupdatinguser'] = 'Atualizando usuário $a[0] id $a[1]';
$string['auth_dbuser'] = 'Nome de usuário com permissão de leitura da base de dados';
$string['auth_dbuser_key'] = 'Usuário do BD';
$string['auth_dbusernotexist'] = 'Não é possível atualizar usuário que não existe: $a';
$string['auth_dbuserstoadd'] = 'Entradas de usuário a acrescentar: $a';
$string['auth_dbuserstoremove'] = 'Entradas de usuário a remover: $a';