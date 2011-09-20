<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_mnet_auto_add_remote_users'] = 'Quando marcado como Sim, um registro local do usuário é criado automaticamente quando o usuário remoto logar pelo primeira vez.';
$string['auth_mnet_roamin'] = 'Os usuários desse host podem passar para seu site.';
$string['auth_mnet_roamout'] = 'Seus usuários podem passar para esses hosts';
$string['auth_mnet_rpc_negotiation_timeout'] = 'O tempo máximo de esperar em segundos para autenticação pelo transporte XMLRPC.';
$string['auth_mnetdescription'] = 'Usuários são autenticados de acordo com a rede de confiança definida nas configurações de rede do seu Moodle.';
$string['auth_mnettitle'] = 'Autenticação da rede Moodle';
$string['auto_add_remote_users'] = 'Adicionar usuários remotos automaticamente';
$string['rpc_negotiation_timeout'] = 'Tempo de espera da negociação RPC';
$string['sso_idp_description'] = 'Publique este serviço para que seus usuários possam visitar o site $a sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>subscrever</strong> o SSO ( Provedor de Serviço) em $a.</li></ul><br />Subscreva este serviço para permitir aos usuários autenticados em $a o acesso ao seu site sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>publicar</strong> o SSO (Provedor de serviço) para $a.</li></ul><br />';
$string['sso_idp_name'] = 'SSO (Provedor de Identidade)';
$string['sso_mnet_login_refused'] = 'Nome de Usuário $a[0] não tem permissão para logar a partir de $a[1].';
$string['sso_sp_description'] = 'Publicar este serviço para permitir que usuários autenticados de $a tenham acesso ao seu site sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>subscrever</strong> o serviço SSO (Provedor de Identidade) em $a.</li></ul><br />Subscreva este serviço para permitir que seus usuários visitem o site $a sem ter que logar novamente. <ul><li><em>Dependência</em>: Você deve também <strong>publicar</strong> o serviço SSO (Provedor de Identidade) em $a.</li></ul><br />';
$string['sso_sp_name'] = 'SSO (Provedor do Serviço)';

?>
