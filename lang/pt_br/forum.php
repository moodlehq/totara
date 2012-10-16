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
 * Strings for component 'forum', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   forum
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addanewdiscussion'] = 'Acrescentar um novo tópico de discussão';
$string['addanewquestion'] = 'Acrescentar uma nova questão';
$string['addanewtopic'] = 'Acrescentar um novo tópico';
$string['advancedsearch'] = 'Busca avançada';
$string['allforums'] = 'Todos os fóruns';
$string['allowdiscussions'] = 'Um {$a} pode enviar mensagens a este fórum?';
$string['allowsallsubscribe'] = 'Neste fórum cada um escolhe se fazer ou não a assinatura';
$string['allowsdiscussions'] = 'Neste fórum todos os participantes podem iniciar novas discussões.';
$string['allsubscribe'] = 'Fazer assinatura em todos os fóruns';
$string['allunsubscribe'] = 'Cancelar assinatura em todos os fóruns';
$string['alreadyfirstpost'] = 'Este já é a primeira mensagem da discussão';
$string['anyfile'] = 'Qualquer arquivo';
$string['attachment'] = 'Anexo';
$string['attachment_help'] = 'Opcionalmente, pode anexar um ou mais arquivos para uma mensagem do fórum. Se você anexar uma imagem, ela será exibida após a mensagem.';
$string['attachmentnopost'] = 'Você não pode exportar anexos sem o ID do post';
$string['attachments'] = 'Anexos';
$string['blockafter'] = 'Limite de mensagens para bloqueio';
$string['blockafter_help'] = '<p>O conceito de limite do envio de mensagens é muito simples.
Os usuários serão impedidos de enviar mensagens depois de atingir um número de mensagens enviadas num dado período. Eles receberão avisos quando se aproximarem deste limite.</p>

<p>Configurando o limite para enviar avisos como 0 (zero) estes avisos são desabilitados.
Configurando o limite de mensagens enviadas como 0 (zero) o bloqueio é desabilitado.
Se o bloqueio estiver desabilitado, os avisos serão automaticamente desativados.</p>

<p> Nenhuma destas configuraços afetará o envio de mensagens pelos professores</p>';
$string['blockperiod'] = 'Duração do bloqueio';
$string['blockperioddisabled'] = 'Não bloquear';
$string['blockperiod_help'] = '<p>O conceito de limite do envio de mensagens é muito simples.
Os usuários serão impedidos de enviar mensagens depois de atingir um número de mensagens enviadas num dado período. Eles receberão avisos quando se aproximarem deste limite.</p>

<p>Configurando o limite para enviar avisos como 0 (zero) estes avisos são desabilitados.
Configurando o limite de mensagens enviadas como 0 (zero) o bloqueio é desabilitado.
Se o bloqueio estiver desabilitado, os avisos serão automaticamente desativados.</p>

<p> Nenhuma destas configuraços afetará o envio de mensagens pelos professores</p>';
$string['blogforum'] = 'Fórum padrão exibido em um formato de blog';
$string['bynameondate'] = 'por {$a->name} - {$a->date}';
$string['cannotadd'] = 'Não é possível adicionar a discussão a este fórum.';
$string['cannotadddiscussion'] = 'Apenas os participantes inscritos nos grupos podem escrever mensagens neste fórum';
$string['cannotadddiscussionall'] = 'Você não tem permissão para abrir um novo tópico de discussão para todos os participantes.';
$string['cannotaddsubscriber'] = 'Não foi possível adicionar assinante com identificação {$a} a este fórum!';
$string['cannotaddteacherforumto'] = 'Não foi possível converter o exemplo do fórum de professore à secão 0 do curso';
$string['cannotcreatediscussion'] = 'Não foi possível criar uma nova discussão';
$string['cannotcreateinstanceforteacher'] = 'Não foi possível criar um novo exemplo de módulo de curso para o fórum de professore';
$string['cannotdeleteforummodule'] = 'Você não pode excluir o módulo de fórum.';
$string['cannotdeletepost'] = 'Você não pode excluir esta mensagem!';
$string['cannoteditposts'] = 'Não é permitido eliminar as menssagens de outras pessoas';
$string['cannotfinddiscussion'] = 'Não foi possível encontrar a discussão neste fórum';
$string['cannotfindfirstpost'] = 'Não foi possível encontrar a primeira menssagem neste fórum.';
$string['cannotfindorcreateforum'] = 'Não foi possível encontrar o criar un fórum principal de noticias nete site.';
$string['cannotfindparentpost'] = 'Não foi possível encontrar a categoría superior da mensagem {$a}';
$string['cannotmovefromsingleforum'] = 'Não foi possível mover um debate a partir de um fórum de debate simples';
$string['cannotmovenotvisible'] = 'Fórum não visível';
$string['cannotmovetonotexist'] = 'Não foi possível mover nada a esse fórum. Ele não existe!';
$string['cannotmovetonotfound'] = 'Fórum de destino não foi encontrado neste curso.';
$string['cannotmovetosingleforum'] = 'Não é possível mover a discussão para um fórum de discussão única simples';
$string['cannotpurgecachedrss'] = 'Não foi possível limpar feeds RSS em cache para a fonte e / ou fórum de destino (s) - verificar file permissionsforums';
$string['cannotremovesubscriber'] = 'Não foi possível remover assinante com id {$a} deste fórum!';
$string['cannotreply'] = 'Não se pode responder a esta menssagem';
$string['cannotsplit'] = 'Os debates a este fórum não podem ser divididos';
$string['cannotsubscribe'] = 'Lamento, mas você deve ser membro do grupo para subscrevê-lo. ';
$string['cannottrack'] = 'Não é possível parar de rastrear este fórum.';
$string['cannotunsubscribe'] = 'Não foi possível desligar sua assinatura deste fórum';
$string['cannotupdatepost'] = 'Você não pode atualizar esta mensagem.';
$string['cannotviewpostyet'] = 'Você ainda não pode ler as perguntas dos outros participantes desta discussão porque você ainda não publicou a sua';
$string['cannotviewusersposts'] = 'Não há posts deste usuário que você seja capaz de visualizar.';
$string['cleanreadtime'] = 'Quando marcar as mensagens antigas como lidas';
$string['completiondiscussions'] = 'O usuário deve criar discussões';
$string['completiondiscussionsgroup'] = 'Requer discussões';
$string['completiondiscussionshelp'] = 'discussões necessárias para completar';
$string['completionposts'] = 'O estudante precisa enviar mensagem oara discussão ou resposta.';
$string['completionpostsgroup'] = 'Requer mensagens.';
$string['completionpostshelp'] = 'discussões necessárias ou respostas para completar';
$string['completionreplies'] = 'O usuário deve enviar réplicas';
$string['completionrepliesgroup'] = 'Requer réplicas';
$string['completionreplieshelp'] = 'Respostas necessárias para completar';
$string['configcleanreadtime'] = 'Hora do dia em que as mensagens antigas serão apagadas da tabela \'lidas\'.';
$string['configdigestmailtime'] = 'Quem escolher esta opção receberá todas as mensagens do fórum agrupadas em um sumário diário. Esta opção controla a hora do dia em que a mensagem diária é enviada (o primeiro cron depois deste horário fará o envio).';
$string['configdisplaymode'] = 'Modalidade de visualização das discussões predefinida, se uma outra não for configurada.';
$string['configenablerssfeeds'] = 'Esta opção ativa a possibilidade de gerar alimentadores RSS nos fóruns. É necessário configurar cada fórum para que sejam gerados os feeds correspondentes.';
$string['configenabletimedposts'] = 'Escolher \'sim\' para permitir a configuração de períodos de exibição de novas discussões (funcionalidade ainda em fase de testes)';
$string['configlongpost'] = 'Todas as mensagens maiores que esta dimensão (sem contar o html) são consideradas longas.';
$string['configmanydiscussions'] = 'Número máximo de discussões mostrado em um fórum, por página.';
$string['configmaxattachments'] = 'Número máximo padrão de anexos permitido por mensagem';
$string['configmaxbytes'] = 'Tamanho máximo predefinido dos anexos de todos os fóruns do site (sujeito aos limites dos cursos e outras configurações locais)';
$string['configoldpostdays'] = 'Número de dias passados antes que qualquer mensagem seja considerada lida.';
$string['configreplytouser'] = 'Quando as mensagens dos fóruns são enviadas aos usuários via email devem conter o endereço do autor para que seja possível responder via email diretamente a ele sem passar pelo fórum? Mesmo quando a opção escolhida for "sim" os usuários terão a possibilidade de mudar o perfil pessoal deles para manter o endereço de email escondido.';
$string['configshortpost'] = 'Todas as mensagens menores que esta dimensão (sem contar o html) são consideradas curtas.';
$string['configtrackreadposts'] = 'Escolha \'sim\' se você quiser monitorar as mensagens lidas/não lidas de cada usuário.';
$string['configusermarksread'] = 'Se \'sim\',o usuário terá que marcar as mensagens lidas manualmente. Se \'não\', a mensagem acessada será marcada automaticamente.';
$string['confirmsubscribe'] = 'Você deseja realmente assinar o fórum  \'{$a}\'?';
$string['confirmunsubscribe'] = 'Você deseja realmente cancelar assinatura do forum \'{$a}\'?';
$string['couldnotadd'] = 'Não foi possível publicar a sua mensagem. Infelizmente a causa do erro não foi identificada.';
$string['couldnotdeletereplies'] = 'Não é possível excluir esta mensagem porque já existem respostas.';
$string['couldnotupdate'] = 'Não foi possível atualizar a sua mensagem. Infelizmente a causa do erro não foi identificada.';
$string['delete'] = 'Excluir';
$string['deleteddiscussion'] = 'A discussão foi apagada';
$string['deletedpost'] = 'A mensagem foi apagada';
$string['deletedposts'] = 'Estas mensagens foram apagadas';
$string['deletesure'] = 'Você tem certeza que quer excluir esta mensagem?';
$string['deletesureplural'] = 'Tem certeza que quer excluir esta mensagem e todas as respostas? ({$a} mensagens)';
$string['digestmailheader'] = 'Este é o compêndio diário das novas mensagens dos fóruns de {$a->sitename}. Você pode mudar as suas preferências em relação às cópias das mensagens do fórum recebidas via email na seguinte página do site {$a->userprefs}.';
$string['digestmailprefs'] = 'O seu perfil';
$string['digestmailsubject'] = '{$a}: digest das mensagens do fórum';
$string['digestmailtime'] = 'Horário de envio do resumo de emails';
$string['digestsentusers'] = 'Digests enviados a {$a} usuários.';
$string['disallowsubscribe'] = 'Assinaturas não permitidas';
$string['disallowsubscribeteacher'] = 'Assinaturas são autorizadas apenas para professores';
$string['discussion'] = 'Tópico';
$string['discussionmoved'] = 'Esta discussão foi transferida para \'{$a}\'.';
$string['discussionmovedpost'] = 'Esta discussão foi transferida <a href="{$a->discusshref}">aqui</a> no fórum <a href="{$a->forumhref}">{$a->forumname}</a>';
$string['discussionname'] = 'Título';
$string['discussions'] = 'Tópicos';
$string['discussionsstartedby'] = 'Discussões iniciadas por {$a}';
$string['discussionsstartedbyrecent'] = 'Discussões iniciadas recentemente por {$a}';
$string['discussionsstartedbyuserincourse'] = 'Os debates começaram por {$a->fullname} em {$a->coursename}';
$string['discussthistopic'] = 'Discutir este tópico';
$string['displayend'] = 'Fim da visualização';
$string['displayend_help'] = '<p>Você pode escolher se seu fórum é acessível a partir de uma determinada data, expira depois
de um determinado período ou é visualizado em um determinado período.</p>

<p>Desmarque a opção "Desabilitar" para ativar a exibição da data inicial e/ou final.</p>

<p>Note que os usuários com poderes de Administrador verão as mensagens antes da data de publicação e depois da data de expiração.</p>';
$string['displaymode'] = 'Modo de visualização';
$string['displayperiod'] = 'Período de exibição';
$string['displaystart'] = 'Início da visualização';
$string['displaystart_help'] = '<p>Você pode escolher se seu fórum é acessível a partir de uma determinada data, expira depois
de um determinado período ou é visualizado em um determinado período.</p>

<p>Desmarque a opção "Desabilitar" para ativar a exibição da data inicial e/ou final.</p>

<p>Note que os usuários com poderes de Administrador verão as mensagens antes da data de publicação e depois da data de expiração.</p>';
$string['eachuserforum'] = 'Cada usuário inicia apenas UM NOVO tópico';
$string['edit'] = 'Editar';
$string['editedby'] = 'Editado por {$a->name} - {$a->date}';
$string['editing'] = 'Edição';
$string['emptymessage'] = 'A sua mensagem não foi enviada. Normalmente isto acontece quando a mensagem ou o campo assunto estão em branco ou quando o anexo é grande demais.';
$string['erroremptymessage'] = 'A mensagem não pode ser vazia.';
$string['erroremptysubject'] = 'O assunto da mensagem não pode ser vazio';
$string['errorenrolmentrequired'] = 'Você precisa estar inscrito neste curso para acessar este conteúdo';
$string['errorwhiledelete'] = 'Ocorreu um erro ao se eliminar o registro';
$string['everyonecanchoose'] = 'Todos podem fazer a assinatura';
$string['everyonecannowchoose'] = 'Agora todos podem fazer a assinatura';
$string['everyoneisnowsubscribed'] = 'Agora todos são assinantes deste fórum';
$string['everyoneissubscribed'] = 'Todos são assinantes deste fórum';
$string['existingsubscribers'] = 'Assinantes';
$string['exportdiscussion'] = 'Exportar todo o debate';
$string['forcessubscribe'] = 'Todos os usuários deste fórum são assinantes';
$string['forum'] = 'Fórum';
$string['forum:addnews'] = 'Acrescentar notícia';
$string['forum:addquestion'] = 'Adicionar questão';
$string['forumauthorhidden'] = 'Autor (oculto)';
$string['forumblockingalmosttoomanyposts'] = 'Você está atingindo o limite máximo de mensagens. Você publicou {$a->numposts} vezes nos últimos {$a->blockperiod} e o limite é de {$a->blockafter} mensagens.';
$string['forumbodyhidden'] = 'Você não pode ver esta mensagem provavelmente porque ainda não publicou nada nesta discussão.';
$string['forum:createattachment'] = 'Criar anexos';
$string['forum:deleteanypost'] = 'Cancelar todas as mensagens (sempre)';
$string['forum:deleteownpost'] = 'Cancelar as próprias mensagens (com limite de tempo)';
$string['forum:editanypost'] = 'Editar qualquer mensagem';
$string['forum:exportdiscussion'] = 'Exportar todo o debate';
$string['forum:exportownpost'] = 'Exportar a própria mensagem';
$string['forum:exportpost'] = 'Exportar mensagem';
$string['forumintro'] = 'Introdução ao Fórum';
$string['forum:managesubscriptions'] = 'Gerenciar assinaturas';
$string['forum:movediscussions'] = 'Mover discussões';
$string['forumname'] = 'Nome do Fórum';
$string['forumposts'] = 'Mensagens do fórum';
$string['forum:postwithoutthrottling'] = 'Isento de limite de mensagem';
$string['forum:rate'] = 'Avaliar mensagens';
$string['forum:replynews'] = 'Responder às notícias';
$string['forum:replypost'] = 'Responder às mensagens';
$string['forums'] = 'Fóruns';
$string['forum:splitdiscussions'] = 'Separar discussões';
$string['forum:startdiscussion'] = 'Iniciar novas discussões';
$string['forumsubjecthidden'] = 'Assunto (oculto)';
$string['forum:throttlingapplies'] = 'Controle de fluxo de banda é aplicável';
$string['forumtracked'] = 'As mensagens não lidas são evidenciadas';
$string['forumtrackednot'] = 'As mensagens não lidas não são evidenciadas';
$string['forumtype'] = 'Tipo de Fórum';
$string['forumtype_help'] = '<P>Os fóruns podem ter as seguintes características:</p>

<P><B>Discussão simples</B> - é um único tópico em uma única página. Normalmente é usado para organizar discussões breves com foco em um tema preciso.</p>

<P><B>Fórum geral</B> - é um  fórum aberto, onde todos os participantes podem iniciar um novo tópico de discussão quando quiserem.</p>

<P><B>Cada usuário inicia apenas UM NOVO tópico</B> - cada participante pode abrir apenas um novo tópico de discussão, mas todos podem responder livremente as mensagens, sem limites de quantidades. Este formato é usado, por exemplo, nas atividades em que cada participante apresenta um tema a ser discutido e atua como moderador da discussão deste tema.</P>

<p><b>Fórum Perguntas e Respostas</b> - neste fórum um estudante pode ler as mensagens de outros sómente após a publicação de sua mensagem. Depois disto pode também responder às mensagens do grupo. isto permite que a primeira mensagem de cada estudante seja original e independente.</p>';
$string['forum:viewallratings'] = 'Ver todas as qualificações emitidas pelos usuários';
$string['forum:viewanyrating'] = 'Ver todas as avaliações de todos os alunos';
$string['forum:viewdiscussion'] = 'Ver discussões';
$string['forum:viewhiddentimedposts'] = 'Ver mensagens escondidas';
$string['forum:viewqandawithoutposting'] = 'Ver sempre mensagens Q e A';
$string['forum:viewrating'] = 'Ver as suas avaliações';
$string['forum:viewsubscribers'] = 'Ver assinantes';
$string['generalforum'] = 'Fórum geral';
$string['generalforums'] = 'Fóruns gerais';
$string['inforum'] = 'em {$a}';
$string['introblog'] = 'As mensagens deste fórum foram copiadas aqui automaticamente a partir dos blogs dos usuarios deste curso uma vez que essas entradas de blog não mais estão disponíveis.';
$string['intronews'] = 'Notícias e avisos';
$string['introsocial'] = 'Um fórum para conversar sobre tudo o que você quiser';
$string['introteacher'] = 'Um fórum reservado aos professores';
$string['invalidaccess'] = 'Esta página não foi acessada corretamente';
$string['invaliddiscussionid'] = 'A identificação da discussão é incorreta ou já não existe mais';
$string['invalidforcesubscribe'] = 'Modo de assinatura forçada inválida';
$string['invalidforumid'] = 'A identificação do fórum foi incorreta';
$string['invalidparentpostid'] = 'Identificação da mensagem superior incorreta';
$string['invalidpostid'] = 'Identificação de mensagem inválida - {$a}';
$string['lastpost'] = 'Última mensagem';
$string['learningforums'] = 'Fóruns para atividades de aprendizagem';
$string['longpost'] = 'Mensagem longa';
$string['mailnow'] = 'Enviar email em seguida';
$string['manydiscussions'] = 'Discussões por página';
$string['markalldread'] = 'Marcar todas as mensagens desta discussão como lidas';
$string['markallread'] = 'Marcar todas as mensagens deste fórum como lidas';
$string['markread'] = 'Marcar como lida';
$string['markreadbutton'] = 'Marcar como<br />lida';
$string['markunread'] = 'Marcar como não lida';
$string['markunreadbutton'] = 'Marcar como<br />não lida';
$string['maxattachments'] = 'Número máximo de arquivos anexados';
$string['maxattachments_help'] = 'Este ajuste determina p número máximo de arquivos que se podem anexar a uma mensagem do fórum';
$string['maxattachmentsize'] = 'Tamanho máximo do anexo';
$string['maxattachmentsize_help'] = '<P>É possível definir a dimensão máxima dos anexos das mensagens do fórum.</p>

<P>Os arquivos com dimensão superior àquela definida não serão transferidos ao servidor. Uma mensagem de erro será visualizada.</p>';
$string['maxtimehaspassed'] = 'Sinto muito, mas o prazo para editar esta mensagem ({$a})terminou!';
$string['message'] = 'Mensagem';
$string['messageprovider:digests'] = 'Compilação de fóruns assinados';
$string['messageprovider:posts'] = 'Mensagens de fóruns assinados';
$string['missingsearchterms'] = 'Os seguintes termos da busca se encontram apenas no código HTML desta mensagem:';
$string['modeflatnewestfirst'] = 'Mostrar respostas começando pela mais recente';
$string['modeflatoldestfirst'] = 'Mostrar respostas começando pela mais antiga';
$string['modenested'] = 'Mostrar respostas aninhadas';
$string['modethreaded'] = 'Listar respostas';
$string['modulename'] = 'Fórum';
$string['modulename_help'] = '<p><img alt="" src="<?php echo $CFG->wwwroot?>/mod/forum/icon.gif" />&nbsp;<b>Fóruns</b></p>
<div class="indent">
Esta atividade de discussão é importantíssima. Os Fóruns tem diversos tipos de estrutura e podem incluir a avaliação recíproca de cada mensagem. As mensagens são visualizadas em diversos formatos e podem incluir anexos. Os participantes do fórum tem a opção de receber cópias das novas mensagens via email (assinatura) e os professores, de enviar mensagens ao fórum com cópias via email a todos os participantes.
</div>';
$string['modulenameplural'] = 'Fóruns';
$string['more'] = 'mais';
$string['movedmarker'] = '(Movida)';
$string['movethisdiscussionto'] = 'Transfira esta discussão para ...';
$string['mustprovidediscussionorpost'] = 'Você deve propiciar uma identificação de discussão ou de mensagem para exportar.';
$string['namenews'] = 'Fórum de notícias';
$string['namenews_help'] = '<p>O fórum de notícias é um fórum especial que é automaticamente criado para cada curso e para a página principal do site e é um espaço para anúncios gerais. Só é possível ter um único fórum de notícias por curso.</p>

<p>O bloco "Últimas Notícias" mostra as discussões mais recentes deste fórum especial (mesmo que se mude o nome dele). Por esta razão o fórum será recriado automaticamente pelo Moodle se o bloco Últimas Notícias está sendo usado.</p>';
$string['namesocial'] = 'Fórum social';
$string['nameteacher'] = 'Fórum dos professores';
$string['newforumposts'] = 'Novas mensagens no fórum';
$string['noattachments'] = 'Não há arquivos anexados a esta mensagem.';
$string['nodiscussions'] = 'Ainda não há nenhum tópico de discussão neste fórum';
$string['nodiscussionsstartedby'] = '{$a} não iniciou nenhuma discussão';
$string['nodiscussionsstartedbyyou'] = 'Você não iniciou nenhuma discussão ainda';
$string['noguestpost'] = 'Desculpe, visitantes não podem enviar mensagens.';
$string['noguesttracking'] = 'Sinto muito, os visitantes não podem definir opções de monitoramento.';
$string['nomorepostscontaining'] = 'Não foram encontradas outras mensagens que contenham \'{$a}\'';
$string['nonews'] = 'Nenhuma notícia publicada';
$string['noonecansubscribenow'] = 'Assinaturas não estão permitidas neste momento.';
$string['nopermissiontosubscribe'] = 'Você não tem permissão para ver os assinantes do fórum';
$string['nopermissiontoview'] = 'Você não tem permissão para ver esta mensagem';
$string['nopostforum'] = 'Sinto muito, você não pode escrever mensagnes neste fórum';
$string['noposts'] = 'Nenhuma mensagem';
$string['nopostscontaining'] = 'Não foi encontrada nenhuma mensagem com \'{$a}\'';
$string['nopostsmadebyuser'] = '{$a} não criou nenhuma mensagem';
$string['nopostsmadebyyou'] = 'Você não enviou nenhuma mensagem';
$string['noquestions'] = 'Ainda não há questões neste fórum';
$string['nosubscribers'] = 'Este fórum não tem nenhum assinante';
$string['notexists'] = 'O debate já não mais existe.';
$string['nothingnew'] = 'Nenhuma novidade em {$a}';
$string['notingroup'] = 'Sinto muito mas você precisa ser membro de um grupo para acessar este fórum';
$string['notinstalled'] = 'O módulo de fórum não está instalado.';
$string['notpartofdiscussion'] = 'Esta mensagem não é parte da discussão!';
$string['notrackforum'] = 'Não monitorar mensagens não lidas';
$string['noviewdiscussionspermission'] = 'Você não tem permissão para ver discussões neste fórum';
$string['nowallsubscribed'] = 'Assinatura ativada em todos os fóruns de {$a}';
$string['nowallunsubscribed'] = 'Nenuma assinatura nos fóruns de {$a}';
$string['nownotsubscribed'] = '{$a->name} não receberá cópias de \'{$a->forum}\' pelo correio eletrônico.';
$string['nownottracking'] = '{$a->name} não está mais monitorando \'{$a->forum}\'.';
$string['nowsubscribed'] = '{$a->name} receberá cópias de \'{$a->forum}\' via Email';
$string['nowtracking'] = '{$a->name} está monitorando \'{$a->forum}\'.';
$string['numposts'] = '{$a} mensagens';
$string['olderdiscussions'] = 'Discussões mais antigas';
$string['oldertopics'] = 'Tópicos antigos';
$string['oldpostdays'] = 'Ler após dias';
$string['openmode0'] = 'Não é permitido iniciar novas discussões, nem enviar respostas';
$string['openmode1'] = 'Não é permitido iniciar novas discussões, mas são permitidas respostas';
$string['openmode2'] = 'É permitido iniciar novas discussões e enviar respostas';
$string['overviewnumpostssince'] = 'mensagens desde o último acesso';
$string['overviewnumunread'] = '{$a} mensagens não lidas';
$string['page-mod-forum-discuss'] = 'Página do tópico de discussão do módulo fórum';
$string['page-mod-forum-view'] = 'Página principal do módulo Fórum';
$string['page-mod-forum-x'] = 'Qualquer página do módulo Fórum';
$string['parent'] = 'Mostrar principal';
$string['parentofthispost'] = 'Mensagem original';
$string['pluginadministration'] = 'Administração do fórum';
$string['pluginname'] = 'Fórum';
$string['postadded'] = 'A sua mensagem foi enviada com sucesso.<br />Você tem {$a} para fazer alterações.';
$string['postaddedsuccess'] = 'A sua mensagem foi publicada';
$string['postaddedtimeleft'] = 'Você pode modificar o texto apenas nos próximos {$a}.';
$string['postincontext'] = 'Veja esta mensagem em seu contexto';
$string['postmailinfo'] = 'Esta é a cópia de uma mensagem enviada ao fórum do website {$a}.
Clique o link abaixo para consultar as mensagens no site e participar das discussões:';
$string['postmailnow'] = '<p>Esta mensagem será enviada imediatamente para todos os assinantes deste fórum</p>';
$string['postrating1'] = 'Sobretudo saber destacado';
$string['postrating2'] = 'Destacado e conectado';
$string['postrating3'] = 'Sobretudo saber conectado';
$string['posts'] = 'Mensagens';
$string['postsmadebyuser'] = 'Mensagem enviada por {$a}';
$string['postsmadebyuserincourse'] = 'Mensagens criadas por {$a->fullname} em {$a->coursename}';
$string['posttoforum'] = 'Enviar mensagem ao fórum';
$string['postupdated'] = 'A sua mensagem foi atualizada';
$string['potentialsubscribers'] = 'Potenciais assinantes';
$string['processingdigest'] = 'Processando digest para o usuário {$a}';
$string['processingpost'] = 'Processando mensagem {$a}';
$string['prune'] = 'Interromper';
$string['prunedpost'] = 'Foi criada uma nova discussão com esta mensagem inicial';
$string['pruneheading'] = 'Interromper a mensagem e mover para uma nova discussão';
$string['qandaforum'] = 'Fórum P e R (perguntas e respostas)';
$string['qandanotify'] = 'Este é um fórum P e R (perguntas e respostas). Você poderá ler as respostas dadas por outros participantes a partir do momento em que publicar a sua resposta.';
$string['re'] = 'Re:';
$string['readtherest'] = 'Leia o resto deste tópico';
$string['replies'] = 'Comentários';
$string['repliesmany'] = '{$a} respostas até agora';
$string['repliesone'] = '{$a} resposta até agora';
$string['reply'] = 'Responder';
$string['replyforum'] = 'Responder ao fórum';
$string['replytouser'] = 'Usar endereço email na resposta';
$string['resetforums'] = 'Excluir as mensagens de';
$string['resetforumsall'] = 'Excluir todas as mensagens';
$string['resetsubscriptions'] = 'Excluir todas as assinaturas';
$string['resettrackprefs'] = 'Excluir todas as preferências de rastreamento dos fóruns';
$string['rssarticles'] = 'Número de artígos recientes RSS';
$string['rssarticles_help'] = '<P>Esta configuração permite a escolha do número de artigos a serem incluídos no alimentador RSS.</p>

<P>Um número entre 5 e 20 é adequado à maior parte dos fóruns.  Aumente este valor nos fóruns em que a atividade é frequente.</p>';
$string['rsssubscriberssdiscussions'] = 'RSS feed das discussões';
$string['rsssubscriberssposts'] = 'RSS feed dos posts';
$string['rsstype'] = 'RSS feed desta atividade';
$string['rsstype_help'] = '<P>Esta opção configura a ativação de alimentadores RSS no fórum.</p>

<P>É possível escolher entre dois tipos de alimentadores RSS:</p>

<UL>
<LI><B>Tópicos:</B> Os alimentadores RSS incluirão apenas a mensagem inicial dos novos tópicos de discussão do fórum.</li>

<LI><B>Mensagens:</B> Os alimentadores RSS incluirão todas as mensagens do fórum.</li>
</UL>';
$string['search'] = 'Buscar';
$string['searchdatefrom'] = 'As mensagens devem ser mais recentes que esta';
$string['searchdateto'] = 'As mensagens devem ser mais antigas que esta';
$string['searchforumintro'] = 'Por favor inserir os termos para a busca em um ou mais dos seguintes campos:';
$string['searchforums'] = 'Buscar no fórum';
$string['searchfullwords'] = 'Estas palavras devem ser consideradas como palavras completas';
$string['searchnotwords'] = 'Estas palavras não devem ser incluídas';
$string['searcholderposts'] = 'Buscar nas mensagens mais antigas...';
$string['searchphrase'] = 'Esta frase exata deve fazer parte da mensagem';
$string['searchresults'] = 'Resultados da busca';
$string['searchsubject'] = 'Estas palavras devem fazer parte do título';
$string['searchuser'] = 'Este nome deve corresponder ao autor';
$string['searchuserid'] = 'ID do autor';
$string['searchwhichforums'] = 'Escolher os fóruns para a busca';
$string['searchwords'] = 'Estas palavras podem ser contidas em qualquer lugar da mensagem';
$string['seeallposts'] = 'Ver todas as mensagens criadas por este usuário';
$string['shortpost'] = 'Mensagem breve';
$string['showsubscribers'] = 'Mostrar assinantes';
$string['singleforum'] = 'Uma única discussão simples';
$string['smallmessage'] = '{$a->user} enviou mensagem em {$a->forumname}';
$string['startedby'] = 'Autor';
$string['subject'] = 'Assunto';
$string['subscribe'] = 'Receber as mensagens via email';
$string['subscribeall'] = 'Inscrever todos os participantes neste fórum';
$string['subscribed'] = 'Assinante';
$string['subscribeenrolledonly'] = 'Lamento, apenas usuários registrados podem suscreverem-se nos fóruns para receber mensagens por correio eletrónico.';
$string['subscribenone'] = 'Cancelar a inscrição de todos os participantes deste fórum';
$string['subscribers'] = 'Assinantes';
$string['subscribersto'] = 'Assinantes de \'{$a}\'';
$string['subscribestart'] = 'Me mande cópias das mensagens deste fórum via Email';
$string['subscribestop'] = 'Não quero receber cópias das mensagens deste fórum via email';
$string['subscription'] = 'Assinatura';
$string['subscriptionauto'] = 'Assinatura automática';
$string['subscriptiondisabled'] = 'Assinatura desabilitada';
$string['subscriptionforced'] = 'Assinatura forçada';
$string['subscription_help'] = '<P>Um assinante é um usuário que recebe cópias de todas as mensagens de um fórum via email.
Estas mensagens são enviadas via email minutos após a redação no fórum.</p>

<P> Um fórum pode ser configurado para enviar cópias das mensagens via email a todos os participantes do curso. Este é o caso do fórum Ultimas Novidades. O envio de mensagens a todos os participantes é aconselhável nos fóruns de avisos organizativos e no início dos cursos, para que todos se familiarizem com esta possibilidade.</p>

<P>Quando o envio de mensagens não é obrigatório os participantes podem escolher se querem ou não receber cópias via email.</p>

<P>Para que um participante seja assinante de um fórum específico, deve clicar a frase "Receber as mensagens deste fórum via email", no início daquele fórum. Para cancelar o recebimento, uma vez que alguém é assinante, deve clicar a frase Suspender o recebimento de mensagens deste fórum via email.</p>

<p>Os participantes podem, ainda, escolher em suas páginas de edição de perfil, se querem que a assinatura seja automático nos fóruns aos quais este participante envia mensagens.</p>';
$string['subscriptionmode'] = 'Modo de assinatura';
$string['subscriptionmode_help'] = '<P>Um assinante é um usuário que recebe cópias de todas as mensagens de um fórum via email.
Estas mensagens são enviadas via email minutos após a redação no fórum.</p>

<P> Um fórum pode ser configurado para enviar cópias das mensagens via email a todos os participantes do curso. Este é o caso do fórum Ultimas Novidades. O envio de mensagens a todos os participantes é aconselhável nos fóruns de avisos organizativos e no início dos cursos, para que todos se familiarizem com esta possibilidade.</p>

<P>Quando o envio de mensagens não é obrigatório os participantes podem escolher se querem ou não receber cópias via email.</p>

<P>Para que um participante seja assinante de um fórum específico, deve clicar a frase Receber as mensagens deste fórum via email, no início daquele fórum. Para cancelar o recebimento, uma vez que alguém é assinante, deve clicar a frase Suspender o recebimento de mensagens deste fórum via email.</p>

<p>Os participantes podem, ainda, escolher em suas páginas de edição de perfil, se querem que a assinatura seja automática, nos fóruns aos quais este participante envia mensagens.</p>

<p>Se você escolher a opção Sim, inicialmente, os usuários serão inscritos inicialmente mas podem cancelar a assinatura. Se você escolher "Sim, sempre" a assinatura não poderá ser cancelada.
</p>

<p>Atenção: se você modificar a opção de Sim, inicialmente, para Não em um fórum ativo, isto não cancela a assinatura de quem já está inscrito. Afeta apenas os novos usuários. A mesma regra se aplica à operação inversa.</p>';
$string['subscriptionoptional'] = 'Assinatura opcional';
$string['subscriptions'] = 'Assinaturas';
$string['thisforumisthrottled'] = 'Neste fórum o número de mensagens que você pode publicar é limitado a {$a->blockafter} mensagens no período de {$a->blockperiod}';
$string['timedposts'] = 'Mensagens com tempo definido';
$string['timestartenderror'] = 'A data final não pode ser anterior à data inicial';
$string['trackforum'] = 'Monitorar mensagens não lidas';
$string['tracking'] = 'Monitorar';
$string['trackingoff'] = 'Desativar';
$string['trackingon'] = 'Ativar';
$string['trackingoptional'] = 'Opcional';
$string['trackingtype'] = 'Monitorar a leitura deste fórum?';
$string['trackingtype_help'] = '<p>Se a opção \'monitorar leitura\' dos fóruns estiver ativada, os usuários podem monitorar as mensagens lidas e não-lidas em fóruns e discussões. O moderador pode escolher se forçar um tipo de monitoramento no fórum.
</p>

<p>Existem três escolhas para essa configuração:</p>
<ul>
<li> Opcional [padrão]: O estudante pode escolher se monitorar ou não
o fórum a seu critério.</li>

<li>Ativar: Monitoramento sempre ativo.</li>

<li>Desativar: Monitoramento sempre desativado.</li>

</ul>';
$string['unread'] = 'Não lida';
$string['unreadposts'] = 'Mensagens não lidas';
$string['unreadpostsnumber'] = '{$a} mensagens não lidas';
$string['unreadpostsone'] = '1 mensagem não lida';
$string['unsubscribe'] = 'Suspender o recebimento de mensagens deste fórum via email';
$string['unsubscribeall'] = 'Suspender o recebimento de mensagens de todos os fóruns via email';
$string['unsubscribeallconfirm'] = 'Você é assinante de {$a} foruns. Você quer anular todas as assinaturas e a opção de assinatura automática?';
$string['unsubscribealldone'] = 'Todas as suas assinaturas foram removidas, mas você ainda pode receber notificações de fóruns configurados com assinatura obrigatória. Se você não deseja receber qualquer e-mail deste site, por favor altere seu perfil desativando seu endereço de e-mail.';
$string['unsubscribeallempty'] = 'Sinto muito mas você não é assinante de nenhum fórum. Se você não deseja receber qualquer e-mail deste site, por favor altere seu perfil desativando seu endereço de e-mail.';
$string['unsubscribed'] = 'Cancelado o recebimento de cópias das mensagens via email';
$string['unsubscribeshort'] = 'Cancelar assinatura';
$string['usermarksread'] = 'Marcar como lido manualmente';
$string['viewalldiscussions'] = 'Ver todas as discussões';
$string['warnafter'] = 'Limite de mensagem para aviso';
$string['warnafter_help'] = '<p>O conceito de limite do envio de mensagens é muito simples.
Os usuários serão impedidos de enviar mensagens depois de atingir um número de mensagens enviadas num dado período. Eles receberão avisos quando se aproximarem deste limite.</p>

<p>Configurando o limite para enviar avisos como 0 (zero) estes avisos são desabilitados.
Configurando o limite de mensagens enviadas como 0 (zero) o bloqueio é desabilitado.
Se o bloqueio estiver desabilitado, os avisos serão automaticamente desativados.</p>

<p> Nenhuma destas configuraços afetará o envio de mensagens pelos professores</p>';
$string['warnformorepost'] = 'Atenção! Existe mais do que uma discussão neste fórum - usando a mais recente';
$string['yournewquestion'] = 'A sua nova pergunta';
$string['yournewtopic'] = 'Novo tópico de discussão';
$string['yourreply'] = 'A sua resposta';
