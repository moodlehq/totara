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
 * Strings for component 'group', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   group
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addgroup'] = 'Adicionar usuário ao grupo';
$string['addgroupstogrouping'] = 'Adicionar grupo ao agrupamento';
$string['addgroupstogroupings'] = 'Adicionar/remover grupos';
$string['adduserstogroup'] = 'Adicionar/remover usuários';
$string['allocateby'] = 'Distribuir membros';
$string['anygrouping'] = '[Qualquer agrupamento]';
$string['autocreategroups'] = 'Criar grupos automaticamente';
$string['backtogroupings'] = 'Voltar aos agrupamentos';
$string['backtogroups'] = 'Voltar aos grupos';
$string['badnamingscheme'] = 'Deve conter exatamente um \'@\' ou um \'#\'';
$string['byfirstname'] = 'Alfabeticamente por primeiro nome, último nome';
$string['byidnumber'] = 'Alfabeticamente por número ID';
$string['bylastname'] = 'Alfabeticamente por último nome, primeiro nome';
$string['createautomaticgrouping'] = 'Criar agrupamento automático';
$string['creategroup'] = 'Criar grupo';
$string['creategrouping'] = 'Criar agrupamento';
$string['creategroupinselectedgrouping'] = 'Criar grupo no agrupamento';
$string['createingrouping'] = 'Criar no agrupamento';
$string['createorphangroup'] = 'Criar grupo órfão';
$string['databaseupgradegroups'] = 'A versão dos grupos agora é {$a}';
$string['defaultgrouping'] = 'Agrupamento padrão';
$string['defaultgroupingname'] = 'Agrupamento';
$string['defaultgroupname'] = 'Grupo';
$string['deleteallgroupings'] = 'Excluir todos os agrupamentos';
$string['deleteallgroups'] = 'Excluir todos os grupos';
$string['deletegroupconfirm'] = 'Tem certeza que quer excluir o grupo \'{$a}\'?';
$string['deletegrouping'] = 'Excluir agrupamento';
$string['deletegroupingconfirm'] = 'Tem certeza que quer excluir o agrupamento \'{$a}\'? (Grupos no agrupamento não são excluídos.)';
$string['deletegroupsconfirm'] = 'Tem certeza que quer excluir os seguintes grupos?';
$string['deleteselectedgroup'] = 'Excluir grupo selecionado';
$string['editgroupingsettings'] = 'Editar configurações de agrupamentos';
$string['editgroupsettings'] = 'Editar configurações de grupos';
$string['enrolmentkey'] = 'Código de inscrição';
$string['enrolmentkey_help'] = 'Uma senha de inscrição permite que o acesso ao curso seja restrito apenas àqueles que conhecem a senha. Se uma senha de acesso para um grupo é especificada, então o aluno que se inscreve no curso usando-a também passa a fazer parte desse grupo.';
$string['erroraddremoveuser'] = 'Erro ao adicionar/remover usuário {$a} no grupo';
$string['erroreditgroup'] = 'Erro ao criar/atualizar grupo {$a}';
$string['erroreditgrouping'] = 'Erro ao criar/atualizar agrupamento {$a}';
$string['errorinvalidgroup'] = 'Erro, grupo inválido: {$a}';
$string['errorselectone'] = 'Selecionar um grupo antes de escolher esta opção';
$string['errorselectsome'] = 'Selecionar um ou mais grupos antes de escolher esta opção';
$string['evenallocation'] = 'Nota: Para distribuir os membros em modo homogeneo, o atual número de membros por grupo difere do número especificado.';
$string['existingmembers'] = 'Membros existentes: {$a}';
$string['filtergroups'] = 'Filtrar grupos por:';
$string['group'] = 'Grupo';
$string['groupaddedsuccesfully'] = 'Grupo {$a} adicionado com sucesso';
$string['groupby'] = 'Especificar';
$string['groupdescription'] = 'Descrição do grupo';
$string['groupinfo'] = 'Informações sobre o grupo selecionado';
$string['groupinfomembers'] = 'Informações sobre os membros selecionados';
$string['groupinfopeople'] = 'Informações sobre as pessoas selecionadas';
$string['grouping'] = 'Agrupamento';
$string['groupingdescription'] = 'Descrição do agrupamento';
$string['grouping_help'] = 'O agrupamento é uma coleção de grupos dentro de um curso. Se um agrupamento é selecionado, os alunos associados aos grupos desse agrupamento poderão trabalhar juntos.';
$string['groupingname'] = 'Nome do agrupamento';
$string['groupingnameexists'] = 'O nome do agrupamento \'{$a}\' já existe nesse curso, por favor escolha outro.';
$string['groupings'] = 'Agrupamentos';
$string['groupingsonly'] = 'Apenas agrupamentos';
$string['groupmember'] = 'Membro do grupo';
$string['groupmemberdesc'] = 'Função padrão de um membro de um grupo';
$string['groupmembers'] = 'Membros do grupo';
$string['groupmembersonly'] = 'Disponível apenas para membros do grupo';
$string['groupmembersonlyerror'] = 'Sinto muito, você precisa ser membro de pelo menos um grupo incluído nessa atividade.';
$string['groupmembersonly_help'] = 'Se esta caixa de seleção for marcada, a atividade (ou recurso) estará disponível para os alunos pertencentes aos grupos dentro do agrupamento selecionado.';
$string['groupmemberssee'] = 'Ver membros do grupo';
$string['groupmembersselected'] = 'Membros do grupo selecionado';
$string['groupmode'] = 'Modalidade grupo';
$string['groupmodeforce'] = 'Forçar modalidade grupo';
$string['groupmodeforce_help'] = 'Se o modo de grupo é forçado, então o modo de grupo do curso é aplicado a todas as atividades do curso. Configurações do modo de grupo de cada atividade serão ignoradas.';
$string['groupmode_help'] = 'Esta configuração possui 3 opções:

* Nenhum grupo - Não há sub-grupos, todos fazem parte de uma grande comunidade
* Grupos separados - Cada membro de grupo pode ver apenas seu próprio grupos, os outros são invisíveis
* Grupos visíveis - Cada membro do grupo trabalha no seu próprio grupo mas pode também ver outros grupos

O tipo de grupo definido no nível do curso é o padrão para todas as atividades do curso. Cada atividade que suporta grupos pode também definir seu próprio tipo de grupo mas, se o tipo de grupo é forçado no nível do curso, o tipo de grupo para cada atividade é ignorado.';
$string['groupmy'] = 'Meu grupo';
$string['groupname'] = 'Nome do grupo';
$string['groupnameexists'] = 'O nome de grupo \'{$a}\' já existe nesse curso, por favor escolha outro.';
$string['groupnotamember'] = 'Sinto muito, você não é membro desse grupo';
$string['groups'] = 'Grupos';
$string['groupscount'] = 'Grupos ({$a})';
$string['groupsgroupings'] = 'Grupos &amp; agrupamentos';
$string['groupsinselectedgrouping'] = 'Grupos em:';
$string['groupsnone'] = 'Nenhum grupo';
$string['groupsonly'] = 'Apenas grupos';
$string['groupspreview'] = 'Prévia dos grupos';
$string['groupsseparate'] = 'Grupos separados';
$string['groupsvisible'] = 'Grupos visíveis';
$string['grouptemplate'] = 'Grupo @';
$string['hidepicture'] = 'Esconder imagem';
$string['importgroups'] = 'Importar grupos';
$string['importgroups_help'] = 'Grupos podem ser importados a partir de um arquivo de texto. O formato de arquivo deve ser da seguinte forma:

* Cada linha do arquivo deve conter apenas um registro
* Cada registro é uma série de dados separados por vírgulas
* O primeiro registro deve conter a lista de nomes de campos, definindo o formato do resto do arquivo
* Um campo obrigatório é o nome do grupo (groupname)
* Campos opcionais são descrição (description), código de inscrição (enrolmentkey), imagem (picture), ocultar imagem (hidepicture)';
$string['javascriptrequired'] = 'Essa página precisa de javascript para ser ativada.';
$string['members'] = 'Membros por grupo';
$string['membersofselectedgroup'] = 'Membros de:';
$string['namingscheme'] = 'Esquema de nomes';
$string['namingscheme_help'] = 'O símbolo de arroba (@) pode ser usado para criar grupos com nomes que contenham letras. Por exemplo, o Grupo @ irá gerar grupos, denominados Grupo A, Grupo B, Grupo C, ...

O símbolo de cerquilha (#) pode ser usado para criar grupos com nomes que contenham números. Por exemplo, o Grupo # irá gerar grupos, denominados Grupo 1, Grupo 2, Grupo 3, ...';
$string['newgrouping'] = 'Novo agrupamento';
$string['newpicture'] = 'Nova imagem';
$string['newpicture_help'] = '<P>Você pode transferir uma foto do seu computador para este servidor. Esta imagem será usada em algumas páginas para identificá-lo.</p>
<P>A imagem ideal é um retrato que mostre seu rosto de perto mas você pode usar outras imagens, se preferir.</p>
<P>A imagem deve ser em formato JPG ou PNG (o nome do arquivo termina em .jpg ou .png).</p>
<P>Você pode obter uma imagem usando um destes 4 métodos:</p>

<OL>
<LI>Usando uma máquina fotográfica digital. As fotos terão, provavelmente, o formato adequado.</li>
<LI>Usando um scanner para digitalizar uma fotografia impressa. Selecione, como formato de arquivo, JPG ou PNG.</li>
<LI>Para obter uma imagem "artística", crie um desenho com o seu software preferido.</li>
<LI>Como última opção, você pode obter imagens prontas em diversos endereços Web como <A TARGET=google HREF="http://images.google.com/">http://images.google.com</A>. Para transferir a imagem para o seu computador, selecione-a e utilize o botão direito do mouse para ativar, no menu, o item "salvar imagem" (o texto varia em função do navegador).</li>
</OL>

<P>Para transferir a imagem para o servidor do curso, clique o botão "Procurar" nesta página de edição e selecione a imagem no diretório do seu computador.</p>
<P>ATENÇÃO: Arquivos com tamanho maior que o indicado não serão aceitos.</p>
<P>Enfim, clique o botão "Atualizar Perfil" no fim do formulário. A imagem será redimensionada a um quadrado de 100X100 pixels.</p>
<P>Quando você retornar à página do seu perfil, se a nova imagem não for visualizada, use o botão do navegador para atualizar a página.</p>';
$string['noallocation'] = 'Nenhum membro inserido';
$string['nogroups'] = 'Ainda não há grupos definidos nesse curso';
$string['nogroupsassigned'] = 'Nenhum grupo atribuído';
$string['nopermissionforcreation'] = 'Impossível criar grupo "{$a}", pois você não tem as permissões necessárias';
$string['nosmallgroups'] = 'Evitar o último grupo pequeno';
$string['notingrouping'] = '[Grupos que não estão em nenhum agrupamento]';
$string['nousersinrole'] = 'Não há usuários possíveis no papel selecionado';
$string['number'] = 'Número de grupos/membros';
$string['numgroups'] = 'Número de grupos';
$string['nummembers'] = 'Membros por grupo';
$string['overview'] = 'Visão geral';
$string['potentialmembers'] = 'Membros potenciais: {$a}';
$string['potentialmembs'] = 'Membros em potencial';
$string['printerfriendly'] = 'Versão para impressão';
$string['random'] = 'Aleatoriamente';
$string['removefromgroup'] = 'Remover usuário do grupo {$a}';
$string['removefromgroupconfirm'] = 'Você deseja realmente remover o usuário "{$a->user}" do grupo "{$a->group}"?';
$string['removegroupfromselectedgrouping'] = 'Remover grupo do agrupamento';
$string['removegroupingsmembers'] = 'Remover todos os grupos dos agrupamentos';
$string['removegroupsmembers'] = 'Remover todos os membros do grupo';
$string['removeselectedusers'] = 'Remover usuários selecionados';
$string['selectfromrole'] = 'Selecionar membros do papel';
$string['showgroupsingrouping'] = 'Mostrar grupos nos agrupamentos';
$string['showmembersforgroup'] = 'Mostrar membros do grupo';
$string['toomanygroups'] = 'Usuários insuficientes para preencher o número de grupos - há apenas {$a} usuários no papel escolhido.';
$string['usercount'] = 'Número de usuários';
$string['usercounttotal'] = 'Número de usuários ({$a})';
$string['usergroupmembership'] = 'Grupos do usuário selecionado:';
