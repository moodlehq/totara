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
 * Strings for component 'auth_ldap', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_ldap_ad_create_req'] = 'Não foi possível criar uma nova conta no Active Directory. Certifique-se que todos os requerimentos foram verificados (conexão LDAPS, atribuições de privilégios aos usuários, etc.)';
$string['auth_ldap_attrcreators'] = 'Lista de grupos ou contextos cujos membros podem criar atributos. Separar mais de um grupo com \';\'. Geralmente algo como \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_attrcreators_key'] = 'Atribuir criadores';
$string['auth_ldap_auth_user_create_key'] = 'Criar usuários externamente';
$string['auth_ldap_bind_dn'] = 'Para usar o bind-user para procurar usuários, especifique o parâmetro aqui. Algo como \'cn=ldapuser,ou=public,o=org\'';
$string['auth_ldap_bind_dn_key'] = 'Nome Distinto';
$string['auth_ldap_bind_pw'] = 'Senha para o bind-user.';
$string['auth_ldap_bind_pw_key'] = 'Senha';
$string['auth_ldap_bind_settings'] = 'Configurações bind';
$string['auth_ldap_changepasswordurl_key'] = 'Página de mudança de senha';
$string['auth_ldap_contexts'] = 'Lista dos contextos onde os usuários estão localizados. Separe contextos diferentes com \';\'. Por exemplo: \'ou=users,o=org; ou=others,o=org\'';
$string['auth_ldap_contexts_key'] = 'Contextos';
$string['auth_ldap_create_context'] = 'Se você ativar a confirmação via correio eletrônico para a criação de usuário, indique o contexto em que os usuários são criados. Este contexto deve ser diverso de outros usuários para evitar problemas de segurança. Você não precisa adicionar este contexto ao ldap_context-variable, isto vai ser feito automaticamente.';
$string['auth_ldap_create_context_key'] = 'Contexto para novos usuários';
$string['auth_ldap_create_error'] = 'Erro ao criar usuário em LDAP';
$string['auth_ldap_creators'] = 'Lista dos grupos em que os membros tem permissão para criar novos cursos. Separe os grupos com \';\'. Por exemplo \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_creators_key'] = 'Criadores';
$string['auth_ldap_expiration_desc'] = 'Selecionar NO para desabilitar o controle de senhas expiradas ou LDAP para verificar a data de expiração da senha diretamente do LDAP';
$string['auth_ldap_expiration_key'] = 'Expiração';
$string['auth_ldap_expiration_warning_desc'] = 'Número de dias antes que o aviso de expiração da senha seja enviado';
$string['auth_ldap_expiration_warning_key'] = 'Aviso de expiração';
$string['auth_ldap_expireattr_desc'] = 'Opcional: ignora o atributo ldap que contém a data de expiração da senha asswordAxpirationTime';
$string['auth_ldap_expireattr_key'] = 'Atributo de expiração';
$string['auth_ldap_graceattr_desc'] = 'Opcional: Ignora atributo gracelogin';
$string['auth_ldap_gracelogin_key'] = 'Atributo do gracelogin';
$string['auth_ldap_gracelogins_desc'] = 'Ativa o suporte a LDAP gracelogin. Depois que a senha estiver expirada o usuário poderá fazer o login enquanto a contagem do gracelogin não for igual a 0. Uma mensagem será visualizada quando a senha expirar.';
$string['auth_ldap_gracelogins_key'] = 'Gracelogins';
$string['auth_ldap_groupecreators'] = 'Lista dos grupos em que os membros tem permissão para criar novos grupos. Separe os grupos com \';\'. Por exemplo \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_groupecreators_key'] = 'Criadores de grupos';
$string['auth_ldap_host_url'] = 'Especifique o servidor LDAP usando o URL como \'ldap://ldap.myorg.com/\' ou \'ldaps://ldap.myorg.com/\'';
$string['auth_ldap_host_url_key'] = 'URL do host';
$string['auth_ldap_ldap_encoding'] = 'Especifique a codificação usada pelo servidor LDAP. É mais provável utf-8. MS AD v2 usa codificações padrões de plataforma como cp1252, cp1250, etc.';
$string['auth_ldap_ldap_encoding_key'] = 'Codificação LDAP';
$string['auth_ldap_login_settings'] = 'Configurações de login';
$string['auth_ldap_memberattribute'] = 'Especifique o atributo do usuário quando pertence a um grupo. Normalmente o atributo é \'membro\'';
$string['auth_ldap_memberattribute_isdn'] = 'Opcional: Sobrepõe o valor dos atributos dos membros, ou 0 ou 1.';
$string['auth_ldap_memberattribute_isdn_key'] = 'O atributo do membro usa dn';
$string['auth_ldap_memberattribute_key'] = 'Atributo de membro';
$string['auth_ldap_no_mbstring'] = 'Você precisa da extensão mbstring para criar usuários no Active Directory.';
$string['auth_ldap_noconnect'] = 'LDAP - O módulo não conseguiu se conectar no servidor: {$a}';
$string['auth_ldap_noconnect_all'] = 'LDAP - O módulo não conseguiu se conectar nos servidores: {$a}';
$string['auth_ldap_noextension'] = '<em>O módulo LDAP para o PHP parece não estar presente. Por favor, certifique-se que ele está instalado e habilitado se você quiser usar este plugin de autenticação.</em>';
$string['auth_ldap_objectclass'] = 'O filtro usado para a busca de nomes dos usuários. Normalmente é definido algo semelhante a objectClass=posixAccount . O padrão objectClass=* retorna todos os objetos do LDAP.';
$string['auth_ldap_objectclass_key'] = 'Classe do objeto';
$string['auth_ldap_opt_deref'] = 'Determina como os aliases são tratados durante a busca. Escolha um dos seguintes valores:
"Não" (LDAP_DEREF_NEVER) or "Sim" (LDAP_DEREF_ALWAYS)';
$string['auth_ldap_opt_deref_key'] = 'Atalhos de referenciamento';
$string['auth_ldap_passtype'] = 'Especifique o formato das senhas criadas e alteradas no servidor LDAP.';
$string['auth_ldap_passtype_key'] = 'Formato de senha';
$string['auth_ldap_passwdexpire_settings'] = 'Configurações de expiração da senha LDAP';
$string['auth_ldap_preventpassindb'] = 'Selecionar SIM para impedir que as senhas sejam arquivadas no DB do Moodle';
$string['auth_ldap_preventpassindb_key'] = 'Esconder senhas';
$string['auth_ldap_search_sub'] = 'Inserir valor <> 0 se quiser procurar usuários nos sub-contextos.';
$string['auth_ldap_search_sub_key'] = 'Procurar por subcontextos';
$string['auth_ldap_server_settings'] = 'Configurações do servidor LDAP';
$string['auth_ldap_unsupportedusertype'] = 'auth: ldap user_create() não suporta o tipo de usuário (usertype) selecionado: {$a}';
$string['auth_ldap_update_userinfo'] = 'Atualizar os dados dos usuários (nome, sobrenome, endereço...) a partir do LDAP. Para informação sobre o mapeamento consulte /auth/ldap/attr_mappings.php';
$string['auth_ldap_user_attribute'] = 'O atributo usado para nomear/procurar usuários. Geralmente \'cn\'.';
$string['auth_ldap_user_attribute_key'] = 'Atributo de usuário';
$string['auth_ldap_user_exists'] = 'Usuário LDAP já existe';
$string['auth_ldap_user_settings'] = 'Configurações de busca de usuário';
$string['auth_ldap_user_type'] = 'Seleciona o modo de memorizar os usuários em LDAP. Esta configuração define também as características de expiração do login, grace logins e criação de usuários';
$string['auth_ldap_user_type_key'] = 'Tipo de usuário';
$string['auth_ldap_usertypeundefined'] = 'config.user_type não foi definido ou a função ldap_expirationtime2unix não suporta o tipo escolhido!';
$string['auth_ldap_usertypeundefined2'] = 'config.user_type não foi definido ou a função ldap_unixi2expirationtime não suporta o tipo escolhido!';
$string['auth_ldap_version'] = 'A versão do protocolo LDAP que o seu servidor usa.';
$string['auth_ldap_version_key'] = 'Versão';
$string['auth_ldapdescription'] = 'Este método faz a autenticação em um servidor LDAP externo. Se o usuário e a senha informados forem válidos, o Moodle cria um novo registro de usuário na sua base de dados. Este módulo pode ler atributos do usuário a partir do LDAP e preencher os valores desejados no Moodle. Nos logins seguintes serão verificados apenas o nome de usuário e a senha.';
$string['auth_ldapextrafields'] = 'Estes campos são opcionais. É possível optar por preencher campos de usuários com informação de <b>campos LDAP</b> especificados aqui.<br />Deixando estes campos em branco, serão usados valores predefinidos.<br />Nos dois casos, o usuário poderá editar todos estes campos quando tiver entrado no sistema.';
$string['auth_ldapnotinstalled'] = 'Não foi possível usar a autenticação LDAP. O módulo LDAP do PHP não foi instalado.';
$string['auth_ntlmsso'] = 'NTLM SSO';
$string['auth_ntlmsso_enabled'] = 'Marque sim para tentar uma inscrição única no domínio NTLM.
<strong>Nota:</strong> isso requer configurações adicionais no servidor web para que funcione. Veja <a href="http://docs.moodle.org/en/NTLM_authentication">http://docs.moodle.org/en/NTLM_authentication</a>';
$string['auth_ntlmsso_enabled_key'] = 'Ativar';
$string['auth_ntlmsso_ie_fastpath'] = 'Defina como “Sim” para habilitar o caminho rápido NTLM  SSO (ignora certos passos e só funciona se o navegador do cliente é o MS Internet Explorer)';
$string['auth_ntlmsso_ie_fastpath_key'] = 'Caminho mais rápido para o MS IE?';
$string['auth_ntlmsso_subnet'] = 'Se marcado, só haverá tentativas de SSO com clientes nessa sub-rede. Formato: xxx.xxx.xxx.xxx/bitmask. Separe múltiplas sub-redes com \',\' (vírgula).';
$string['auth_ntlmsso_subnet_key'] = 'Subnet';
$string['auth_ntlmsso_type'] = 'O método de autenticação configurado no servidor web para autenticar os usuários (na dúvida, escolha NTLM)';
$string['auth_ntlmsso_type_key'] = 'Tipo de autenticação';
$string['connectingldap'] = 'Conectando ao servidor LDAP...';
$string['creatingtemptable'] = 'Criando tabela temporária {$a}';
$string['didntfindexpiretime'] = 'password_expire() não encontrou o tempo de expiração.';
$string['didntgetusersfromldap'] = 'Nenhum usuário obtido do LDAP -- erro? -- sair';
$string['gotcountrecordsfromldap'] = 'Adquiridos {$a} registros do LDAP';
$string['morethanoneuser'] = 'Estranho! Mais de um registro de usuário encontrado no ldap. Somente o primeiro será utilizado.';
$string['needbcmath'] = 'Você precisa da extensão BCMath para usar a funcionalidade "grace logins" com o Active Directory (possibilidade de acessar determinado número de vezes após o prazo de expiração da senha).';
$string['needmbstring'] = 'Você precisa da extensão mbstring para alterar senhas no Active Directory';
$string['nodnforusername'] = 'Erro no user_update_password(). Nenhum DN para: {$a->username}';
$string['noemail'] = 'A tentativa de lhe enviar um email falhou!';
$string['notcalledfromserver'] = 'Não deve ser rodada a partir do servidor Web.';
$string['noupdatestobedone'] = 'Nenhuma atualização a ser feita';
$string['nouserentriestoremove'] = 'Nenhuma entrada de usuário a ser removida';
$string['nouserentriestorevive'] = 'Não há entradas do usuário a serem renovadas.';
$string['nouserstobeadded'] = 'Nenhum usuário a ser incluído';
$string['ntlmsso_attempting'] = 'Tentando inscrição única via NTLM';
$string['ntlmsso_failed'] = 'O login automático falhou, tente pela página normal...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO está desativado.';
$string['ntlmsso_unknowntype'] = 'Tipo de ntlmsso desconhecido!';
$string['pluginname'] = 'Use um servidor LDAP';
$string['pluginnotenabled'] = 'Plugin não está habilitado!';
$string['renamingnotallowed'] = 'Renomear usuário não é permitido no LDAP';
$string['rootdseerror'] = 'Erro consultando rootDSE do Active Directory';
$string['updatepasserror'] = 'Erro no user_update_password(). Código de erro: {$a->errno}; String do erro: {$a->errstring}';
$string['updatepasserrorexpire'] = 'Erro na user_update_password () ao ler tempo de expiração de senha. Código de erro: {$a->errno}; string de erro: {$a->errstring}';
$string['updatepasserrorexpiregrace'] = 'Erro na user_update_password () ao modificar tempo de expiração e/ou gracelogins. Código de erro: {$a->errno}; string de erro: {$a->errstring}';
$string['updateremfail'] = 'Erro ao atualizar registro LDAP. Código de erro: {$a->errno}; string de erro: {$a->errstring}<br/>Chave ({$a->key}) - valor moodle antigo: \'{$a->ouvalue}\'  novo valor: \'{$a->nuvalue}\'';
$string['updateremfailamb'] = 'Falha ao atualizar o LDAP com o campo ambíguo {$a->key}; valor moodle antigo: {$a->ouvalue}\', novo valor: \'{$a->nuvalue}\'';
$string['updateusernotfound'] = 'Não foi possível encontrar o usuário durante a atualização externa. Detalhes a seguir: base de pesquisa: \'{$a->userdn}\'; filtro de pesquisa: \'(objectClass=*)\'; atributos de pesquisa: {$a->attribs}';
$string['user_activatenotsupportusertype'] = 'auth: ldap user_activate() não suporta o tipo de usuário (usertype) selecionado: {$a}';
$string['user_disablenotsupportusertype'] = 'auth: ldap user_disable() não suporta o tipo de usuário (usertype) selecionado: {$a}';
$string['useracctctrlerror'] = 'Erro ao obter userAccountControl para {$a}';
$string['userentriestoadd'] = 'Entradas de usuário a serem adicionadas: {$a}';
$string['userentriestoremove'] = 'Entradas de usuário a serem removidas: {$a}';
$string['userentriestorevive'] = 'Entradas de usuário a serem reativadas: {$a}';
$string['userentriestoupdate'] = 'Entradas de usuário a serem atualizadas: {$a}';
$string['usernotfound'] = 'Usuário não encontrado no LDAP';
