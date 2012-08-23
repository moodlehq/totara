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
 * Strings for component 'enrol_ldap', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Atribuindo papel \'{$a->role_shortname}\' ao usuário \'{$a->user_username}\' no curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['assignrolefailed'] = 'Erro ao atribuir função papel \'{$a->role_shortname}\' para o usuário \'{$a->user_username}\' no curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['autocreate'] = 'Podem ser criados cursos automaticamente quando existem inscrições em cursos ainda inexistentes.';
$string['autocreate_key'] = 'Criar automaticamente';
$string['autocreation_settings'] = 'Parâmetros de criação automática de cursos';
$string['bind_dn'] = 'Se você quiser usar o bind-user para buscar usuários, indicá-lo aqui. Algo como \'cn=ldapuser,ou=public,o=org\'';
$string['bind_dn_key'] = 'Nome distinto do usuário do bind';
$string['bind_pw'] = 'Password para o bind-user';
$string['bind_pw_key'] = 'Senha';
$string['bind_settings'] = 'Configurações de bind';
$string['cannotcreatecourse'] = 'Não é possível criar curso: faltam dados necessários no registro do LDAP!';
$string['category'] = 'Categoria para cursos criados automaticamente';
$string['category_key'] = 'Categoria';
$string['contexts'] = 'contextos LDAP';
$string['couldnotfinduser'] = 'Não foi possível encontrar o usuário \'{$a}\', pulando';
$string['course_fullname'] = 'Opcional: campo LDAP que define o nome completo';
$string['course_fullname_key'] = 'Nome completo';
$string['course_idnumber'] = 'Mapa ao identificador único em LDAP, normalmente <em>cn</em> ou <em>uid</em>. É recomendável o bloqueio do valor quando é ativada a criação automática de cursos.';
$string['course_idnumber_key'] = 'ID number';
$string['coursenotexistskip'] = 'Curso \'{$a}\', não exite e a criação automática está desabilitada, pulando';
$string['course_search_sub'] = 'Pesquisar membros de grupos nos subcontextos';
$string['course_search_sub_key'] = 'Buscar subcontextos';
$string['course_settings'] = 'Configuração da Inscrição em Cursos';
$string['course_shortname'] = 'Opcional: campo LDAP que define o nome breve';
$string['course_shortname_key'] = 'Nome curto';
$string['course_summary'] = 'Opcional: campo LDAP que define o sumário';
$string['course_summary_key'] = 'Sumário';
$string['createcourseextid'] = 'CRIAR Usuário inscrito em curso inexistente \'{$a->courseextid}\'';
$string['createnotcourseextid'] = 'Usuário inscrito em um curso não existente \'{$a->courseextid}\'';
$string['creatingcourse'] = 'Criando curso \'{$a}\'...';
$string['editlock'] = 'Bloquear valor';
$string['emptyenrolment'] = 'Inscrição vazia para o papel \'{$a->role_shortname}\' no curso \'{$a->course_shortname}\'';
$string['enrolname'] = 'LDAP';
$string['enroluser'] = 'Inscrever usuário \'{$a->user_username}\' no curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['enroluserenable'] = 'Habilitada inscrição para usuário \'{$a->user_username}\' no curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['explodegroupusertypenotsupported'] = 'ldap_explode_group() não suporta o tipo de usuário selecionado: {$a}';
$string['extcourseidinvalid'] = 'O ID de curso externo é inválido!';
$string['extremovedsuspend'] = 'Desabilitada inscrição para usuário \'{$a->user_username}\' no curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extremovedsuspendnoroles'] = 'Desabilitada a inscrição e papéis removidos do usuário \'{$a->user_username}\' no curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extremovedunenrol'] = 'Desinscrever usuário \'{$a->user_username}\' do curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['failed'] = 'Falhou!';
$string['general_options'] = 'Opções gerais';
$string['group_memberofattribute'] = 'Nome do atributo que especifica a quais grupos um determinado usuário ou grupo pertence (por exemplo, memberOf, groupMembership, etc)';
$string['group_memberofattribute_key'] = 'Atributo \'membro de\'';
$string['host_url'] = 'Definir o host LDAP em formato URL como \'ldap://ldap.myorg.com/\'
ou \'ldaps://ldap.myorg.com/\'';
$string['host_url_key'] = 'Host URL';
$string['idnumber_attribute'] = 'Se os membros do grupo contém nomes distintos, especifique o mesmo atributo que você usou para o mapeamento do \'ID Number\' do usuário nas configurações de autenticação LDAP';
$string['idnumber_attribute_key'] = 'Atributo ID number';
$string['ldap_encoding'] = 'Especifique a codificação utilizada pelo servidor LDAP. Normalmente utf-8. MS AD v2 usa codificação padrão da plataforma como cp1252, cp1250 etc.';
$string['ldap_encoding_key'] = 'Codificação do LDAP';
$string['ldap:manage'] = 'Gerenciar instâncias de inscrição via LDAP';
$string['memberattribute'] = 'atributo de membro LDAP';
$string['memberattribute_isdn'] = 'Se os membros do grupo contém nomes distintos, você precisa especificá-lo aqui. Se isso acontecer, você também precisa informar as configurações restantes desta seção';
$string['memberattribute_isdn_key'] = 'Atributos de membro usa dn';
$string['nested_groups'] = 'Você deseja usar grupos aninhados (grupos de grupos) para inscrições?';
$string['nested_groups_key'] = 'Grupos aninhados';
$string['nested_groups_settings'] = 'Configurações de grupos aninhados';
$string['nosuchrole'] = 'Papel inexistente: \'{$a}\'';
$string['objectclass'] = 'objectClass usado para buscar cursos. Normalmente é \'posixGroup\'.';
$string['objectclass_key'] = 'Classe Object';
$string['ok'] = 'OK!';
$string['opt_deref'] = 'Se os membros do grupo contém nomes distintos, especificar como aliases são tratados durante a pesquisa. Selecione um dos seguintes valores: \'Não\' (LDAP_DEREF_NEVER) ou \'Sim\' (LDAP_DEREF_ALWAYS)';
$string['opt_deref_key'] = 'ADereference aliases';
$string['phpldap_noextension'] = '<em>O módulo LDAP do PHP parece não estar presente. Por favor, verifique se está instalado e habilitado se você quiser usar este plugin de inscrição.</em>';
$string['pluginname'] = 'Inscrições LDAP';
$string['pluginname_desc'] = '<p>Você pode usar um server LDAP para controlar as inscrições. Se presume que o ramo LDAP contenha grupos mapeados em relação aos cursos e que cada um destes grupos/cursos terá itens que identificam membros mapeados em relação aos estudantes.</p>
<p>Se presume que os cursos sejam definidos como grupos em LDAP, com cada grupo contendo campos múltiplos que identificam os membros (<em>member</em> ou <em>memberUid</em>) e que contém uma identificação unívoca do usuário </p>';
$string['pluginnotenabled'] = 'Plugin desabilitado!';
$string['role_mapping'] = '<p> Para cada papel que você deseja atribuir a partir do LDAP, você precisa especificar a lista de contextos onde os papéis dos grupos do curso estão localizados. Separe contextos diferentes,   com \';\'. </ P> Você também precisa especificar o atributo que seu servidor LDAP utiliza para manter os membros de um grupo. Geralmente \'membro\' ou \'memberUid\' </ p>';
$string['role_mapping_key'] = 'Mapear papéis do LDAP';
$string['roles'] = 'Mapeamento de papéis';
$string['server_settings'] = 'Configurações do servidor LDAP';
$string['synccourserole'] = '== Sincronizando o curso \'{$a->idnumber}\' para o papel \'{$a->role_shortname}\'';
$string['template'] = 'Opcional: cursos criados automaticamente podem copiar as suas configurações a partir de um modelo de curso';
$string['template_key'] = 'Modelo';
$string['unassignrole'] = 'Remover atribuição\'{$a->role_shortname}\' de usuário \'{$a->user_username}\' do curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['unassignrolefailed'] = 'Falha ao definir atribuição \'{$a->role_shortname}\' para usuário \'{$a->user_username}\' para o curso \'{$a->course_shortname}\' (id {$a->course_id})';
$string['unassignroleid'] = 'Removendo atribuição do papel com id \'{$a->role_id}\' do usuário com id \'{$a->user_id}\'';
$string['updatelocal'] = 'Atualizar dados locais';
$string['user_attribute'] = 'Se os membros do grupo contém nomes distintos, especificar o atributo usado para nomear / pesquisar usuários. Se você estiver usando a autenticação LDAP, este valor deve corresponder ao atributo especificado no mapeamento do "ID Number" no plugin de autenticação LDAP';
$string['user_attribute_key'] = 'Atributo número ID';
$string['user_contexts'] = 'Se os membros do grupo contém nomes distintos, especificar a lista de contextos onde os usuários estão localizados. Separe contextos diferentes com \';\'. Por exemplo: "ou = usuários, o = org; ou = outros, o = org \'';
$string['user_contexts_key'] = 'Contextos';
$string['user_search_sub'] = 'Se os membros do grupo contém nomes distintos, especificar se a busca de usuários é feita em subcontextos também';
$string['user_search_sub_key'] = 'Buscar subcontextos';
$string['user_settings'] = 'Configurações de pesquisa de usuário';
$string['user_type'] = 'Se os membros do grupo contém nomes distintos, especificar como os usuários são armazenadas no LDAP';
$string['user_type_key'] = 'Tipo de usuário';
$string['version'] = 'A versão de protocolo LDAP que o seu servidor está usando';
$string['version_key'] = 'Versão';
