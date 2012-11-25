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
 * Strings for component 'chat', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['ajax'] = 'Versão usando Ajax';
$string['autoscroll'] = 'Rolagem automática';
$string['beep'] = 'bip';
$string['cantlogin'] = 'Não foi possível logar na sala de chat';
$string['chat:chat'] = 'Acessar o chat';
$string['chat:deletelog'] = 'Excluir logs do chat';
$string['chat:exportparticipatedsession'] = 'Exportar sessão de chat em que você tenha participado';
$string['chat:exportsession'] = 'Exportar qualquer sessão de chat';
$string['chat:readlog'] = 'Ler logs do chat';
$string['chat:talk'] = 'Bater papo no chat';
$string['chatintro'] = 'Introdução';
$string['chatname'] = 'Nome desta sala';
$string['chatreport'] = 'Sessões de chat';
$string['chattime'] = 'Data do próximo chat';
$string['configmethod'] = 'O método de chat ajax fornece uma interface de chat baseada em Ajax, que contata o servidor regularmente para atualização. O método de chat normal envolve os clientes em contato constante com o servidor para atualizações. Este não requer configuração e funciona em todos os lugares, mas pode criar uma grande carga sobre o servidor com muitos usuários. Utilizar um servidor daemon requer um acesso shell no Unix, mas resulta em um ambiente de chat rápido e escalável.';
$string['confignormalupdatemode'] = 'Normalmente a atualização das salas de chat são eficientes quando se utiliza <em>Keep-Alive</em> em HTTP 1.1 mas isto não reduz a sobrecarga do servidor. O melhor método consiste no uso da estratégia <em>Stream</em> para comunicar as atualizações aos usuários. Este método oferece maior escalabilidade, como o método chatd, mas não é compatível com alguns tipos de servidor.';
$string['configoldping'] = 'Depois de quanto tempo de silêncio do usuário temos que considerar que abandonou a sala (em segundos)?';
$string['configrefreshroom'] = 'Qual é o intervalo de atualização da sala do chat (em segundos)? Um intervalo breve faz com que a chat pareça mais veloz mas isto pode aumentar muito a carga de trabalho do servidor quando muitas pessoas estiverem participando. Se você estiver usando atualizações <em>Stream</em>, você pode aumentar a freqüência de atualização escolhendo, por exemplo, o valor 2.';
$string['configrefreshuserlist'] = 'De quanto em quanto tempo a lista dos usuários tem que ser atualizada (em segundos)?';
$string['configserverhost'] = 'O hostname do computador que hospeda o servidor daemon';
$string['configserverip'] = 'O endereço IP correspondente ao hostname acima';
$string['configservermax'] = 'Número máximo de clientes permitido';
$string['configserverport'] = 'Porta do servidor a ser usada pelo daemon';
$string['currentchats'] = 'Sessões de chat ativas';
$string['currentusers'] = 'Usuários atuais';
$string['deletesession'] = 'Excluir esta sessão';
$string['deletesessionsure'] = 'Confirmar a exclusão desta sessão?';
$string['donotusechattime'] = 'Não publicar os horários dos chats';
$string['enterchat'] = 'Clique aqui para entrar no chat agora';
$string['entermessage'] = 'Digite sua mensagem';
$string['errornousers'] = 'Não foi encontrado nenhum usuário!';
$string['explaingeneralconfig'] = 'Estas configurações estão sempre ativas';
$string['explainmethoddaemon'] = 'Estas configurações são importantes apenas se você selecionou o método "server daemon"';
$string['explainmethodnormal'] = 'Estas configurações são importantes apenas se você selecionou o método "normal"';
$string['generalconfig'] = 'Configuração geral';
$string['idle'] = 'Idle';
$string['inputarea'] = 'Área de entrada de dados';
$string['invalidid'] = 'Sala de chat não foi encontrada!';
$string['list_all_sessions'] = 'Mostrar todas as sessões.';
$string['list_complete_sessions'] = 'Mostrar apenas sessões completas.';
$string['listing_all_sessions'] = 'Mostrando todas as sessões.';
$string['messagebeepseveryone'] = '{$a}';
$string['messagebeepsyou'] = '{$a} está bipando você!';
$string['messageenter'] = '{$a} entrou no chat';
$string['messageexit'] = '{$a} abandonou este chat';
$string['messages'] = 'Mensagens';
$string['messageyoubeep'] = 'Você chamou {$a}';
$string['method'] = 'Método do Chat';
$string['methodajax'] = 'Método ajax';
$string['methoddaemon'] = 'Servidor chat daemon';
$string['methodnormal'] = 'Método normal';
$string['modulename'] = 'Chat';
$string['modulename_help'] = 'O módulo “chat” permite que os participantes tenham uma discussão síncrona, em tempo real, através da web. Esta é uma maneira útil de se obter diferentes visões em relação ao tema a ser discutido - utilizar uma sala de chat é bastante diferente dos fóruns assíncronos.';
$string['modulenameplural'] = 'Chats';
$string['neverdeletemessages'] = 'Nunca excluir as mensagens';
$string['nextsession'] = 'Próxima sessão programada';
$string['no_complete_sessions_found'] = 'Nenhuma sessão completa encontrada.';
$string['nochat'] = 'Nenhum chat encontrado';
$string['noguests'] = 'O chat não pode ser acessado por visitantes';
$string['nomessages'] = 'Nenhuma mensagem ainda';
$string['nopermissiontoseethechatlog'] = 'Você não tem permissão para ver os logs do chat.';
$string['normalkeepalive'] = 'KeepAlive';
$string['normalstream'] = 'Stream';
$string['noscheduledsession'] = 'Nenhuma sessão planejada';
$string['notallowenter'] = 'Você não tem permissão para entrar nesta sala';
$string['notlogged'] = 'Você não está autenticado!';
$string['oldping'] = 'Tempo para disconecção';
$string['page-mod-chat-x'] = 'Qualquer página de chat';
$string['pastchats'] = 'Sessões encerradas';
$string['pluginadministration'] = 'Administração do chat';
$string['pluginname'] = 'Chat';
$string['refreshroom'] = 'Recarregar o texto';
$string['refreshuserlist'] = 'Recarregar a lista de usuários';
$string['removemessages'] = 'Remover todas as mensagens';
$string['repeatdaily'] = 'Na mesma hora todos os dias';
$string['repeatnone'] = 'Não repetir - publicar apenas o horário especifico';
$string['repeattimes'] = 'Repetir sessões';
$string['repeatweekly'] = 'No mesmo horário cada semana';
$string['saidto'] = 'disse para';
$string['savemessages'] = 'Salvar as sessões encerradas';
$string['seesession'] = 'Ver esta sessão';
$string['send'] = 'Enviar';
$string['sending'] = 'Enviando';
$string['serverhost'] = 'Nome do servidor';
$string['serverip'] = 'IP do servidor';
$string['servermax'] = 'Máximo de usuários';
$string['serverport'] = 'Porta do Servidor';
$string['sessions'] = 'Sessões de chat';
$string['sessionstart'] = 'A sessão de chat irá começar em {$a}';
$string['strftimemessage'] = '%H:%M';
$string['studentseereports'] = 'Todos podem ver as sessões encerradas';
$string['studentseereports_help'] = 'Se for definido como não, somente os usuários que possuirem a permissão mod/chat:readlog serão capazes de ver as logs de chats';
$string['talk'] = 'Falar';
$string['updatemethod'] = 'Método de atualização';
$string['updaterate'] = 'porcentagem de atualização:';
$string['userlist'] = 'Lista de usuários';
$string['usingchat'] = 'Usando chat';
$string['usingchat_help'] = 'O módulo Chat tem alguns alguns instrumentos que facilitam o bate-papo.

**Carinhas**
: Todas as carinhas (emoticons) que você usa nos editores de texto podem ser utilizadas no chat.
**Links**
: Endereços web são automaticamente transformados em links
**Emoções**
: Você pode iniciar uma frase com "/me" or ":" para representar emoções. Por exemplo, se o seu nome é Kim e você digita ":laughs!" or "/me laughs!" todos vão ler "Kim laughs!"
**Bips**
: Você pode tocar um som para outras pessoas clicando o link "beep" ao lado do nome delas. Escrevendo "beep all", todas as pessoas vão ouvir o bip.
**HTML**
: Você pode usar código html para inserir imagens no texto do chat e mudar a cor e o tamanho das letras.';
$string['viewreport'] = 'Ver sessões encerradas';
