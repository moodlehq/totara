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
 * Strings for component 'assignment', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   assignment
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addsubmission'] = 'Adicionar apresentação';
$string['allowdeleting'] = 'Permitir cancelamento';
$string['allowdeleting_help'] = '<p>Se habilitado, os participantes podem excluir arquivos enviados a qualquer momento, antes de serem avaliados.</p>';
$string['allowmaxfiles'] = 'Número máximo de arquivos carregados';
$string['allowmaxfiles_help'] = '<p>Número máximo de arquivos que cada participante pode carregar.
Esse número não é mostrado aos estudantes automaticamente. Escreva o número de arquivos permitidos na descrição da tarefa.</p>';
$string['allownotes'] = 'Permitir notas';
$string['allownotes_help'] = '<p>Se habilitada, os participantes podem fazer anotações na área de texto.
É semelhante ao recurso texto online.</p>

<p>Esta caixa de texto pode ser usada para comunicação com quem avalia a tarefa, para registrar a descrição do progresso da tarefa ou para qualquer outra atividade escrita.</p>';
$string['allowresubmit'] = 'Permitir novo envio';
$string['allowresubmit_help'] = '<P>A configuração padrão proibe um aluno de enviar novamente a mesma tarefa depois que ela foi avaliada.</P>

<P>Se você ativar esta opção, os alunos poderão enviar novas versões da mesma tarefa mesmo depois que ela for avaliada. Isto é útil quando o professor quer encorajar os alunos a melhorarem os resultados ou quando é previsto um processo de avaliação iterativo, com sucessivas revisões.</P>

<P>Esta opção não é útil nas Tarefas Offline</P>';
$string['alreadygraded'] = 'A sua tarefa já foi avaliada. Não é possível enviar outros documentos.';
$string['assignmentdetails'] = 'Detalhes da tarefa';
$string['assignment:exportownsubmission'] = 'Exportar a própria apresentação';
$string['assignment:exportsubmission'] = 'Exportar envio';
$string['assignment:grade'] = 'Avaliar tarefa';
$string['assignmentmail'] = '{$a->teacher} escreveu comentários sobre a seguinte tarefa que você apresentou: \'{$a->assignment}\'

Leia os comentários anexos à tarefa:

{$a->url}';
$string['assignmentmailhtml'] = '{$a->teacher} escreveu comentários sobre a seguinte tarefa que você apresentou: \'<i>{$a->assignment}</i>\'<br /><br />
Leia os <a href="{$a->url}">comentários anexos à tarefa</a>.';
$string['assignmentmailsmall'] = '{$a->teacher} publicou alguns comentários em sua tarefa apresentada para \'{$a->assignment}\'. Você pode visualizar estes comentários incluídos em sua tarefa apresentada';
$string['assignmentname'] = 'Nome da tarefa';
$string['assignmentsubmission'] = 'Apresentações de tarefa';
$string['assignment:submit'] = 'Enviar tarefa';
$string['assignmenttype'] = 'Tipo de tarefa';
$string['assignment:view'] = 'Ver tarefa';
$string['availabledate'] = 'Disponível a partir de';
$string['cannotdeletefiles'] = 'Erro: os arquivos não foram apagados';
$string['cannotviewassignment'] = 'Você não pode ver esta tarefa';
$string['comment'] = 'Comentário';
$string['commentinline'] = 'Comentário inserido na frase';
$string['commentinline_help'] = '<p>Se esta opção for selecionada, o envio original será copiado no campo de comentário para que seja mais fácil fazer comentários no texto durante a avaliação (talvez usando uma cor diferente) ou para editar o texto original.</p>';
$string['configitemstocount'] = 'Tipo de elemento a ser considerado como envio em tarefas online.';
$string['configmaxbytes'] = 'Maior tamanho definido para todas as tarefas do site (sujeita aos limites do curso e às configurações locais).';
$string['configshowrecentsubmissions'] = 'Todos podem ver listas de novos envios no relatório de atividades recentes';
$string['confirmdeletefile'] = 'Tem certeza que quer cancelar este arquivo?
<br /><strong>{$a}</strong>';
$string['coursemisconf'] = 'O curso está configurado incorretamente';
$string['currentgrade'] = 'Nota atual no livro de notas';
$string['deleteallsubmissions'] = 'Excluir todos os arquivos enviados';
$string['deletefilefailed'] = 'Não foi cancelado o arquivo';
$string['description'] = 'Descrição';
$string['downloadall'] = 'Fazer o download de todas as tarefas como um arquivo ZIP';
$string['draft'] = 'Esboço';
$string['due'] = 'Atribuição de tarefa';
$string['duedate'] = 'Data de entrega';
$string['duedateno'] = 'Nenhuma data de entrega';
$string['early'] = '{$a} antecipado';
$string['editmysubmission'] = 'Editar o documento enviado';
$string['editthesefiles'] = 'Editar estes arquivos';
$string['editthisfile'] = 'Atualizar este arquivo';
$string['emailstudents'] = 'Avisos por email para cursistas';
$string['emailteachermail'] = '{$a->username} atualizou a sua tarefa \'{$a->assignment}\' em {$a->timeupdated}

Para acessar a nova versão:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->username} atualizou a sua tarefa <i>\'{$a->assignment}\' em{$a->timeupdated} </i><br /><br />
Esta pode ser acessada <a href="{$a->url}">no site</a>.';
$string['emailteachers'] = 'Avisos por email aos professores';
$string['emailteachers_help'] = '<p>Se habilitado, os professores serão avisados através de mensagens breves por correio
   eletrônico sempre que os estudantes enviare um novo documento ou atualizarem um documento enviado.</p>

<p>Sómente os professores que são autorizados a avaliar um envio em particular são
   notificados. Assim, por exemplo, se o curso usa grupos separados, então os professores
   associados a um grupo particular não irão receber nenhum aviso sobre estudantes de outros
   grupos.</p>

<p>Para atividades offline, evidentemente, nenhuma mensagem será enviada, já
   que os estudantes não enviam documentos.</p>';
$string['emptysubmission'] = 'Você ainda não enviou nada';
$string['enablenotification'] = 'Enviar notificação via email';
$string['enablenotification_help'] = '<p>Ativando isto, os estudantes serão notificados por email sobre suas notas e feedback.</p>

<p>Sua preferência pessoal é salva e será aplicada a todas tarefas enviadas que você avaliar.</p>';
$string['errornosubmissions'] = 'Não existem submissões para download.';
$string['existingfiledeleted'] = 'Este arquivo foi cancelado: {$a}';
$string['failedupdatefeedback'] = 'Falhou a atualização do feedback da tarefa do usuário {$a}';
$string['feedback'] = 'Feedback';
$string['feedbackfromteacher'] = 'Comentário de {$a}';
$string['feedbackupdated'] = 'Feedback das tarefas de {$a} pessoas atualizado';
$string['finalize'] = 'Evitar atualizações do envio';
$string['finalizeerror'] = 'Erro: este envio não foi completado';
$string['graded'] = 'Avaliado';
$string['guestnosubmit'] = 'Sinto muito, visitantes não podem enviar tarefas. Faça o login ou inscreva-se antes de enviar a tarefa.';
$string['guestnoupload'] = 'Visitantes não podem enviar documentos';
$string['helpoffline'] = '<p>Isto é útil quando a tarefa é realizada fora do Moodle, em outro endereço web ou em presença.</p><p>Os estudante podem ler uma descrição da tarefa, mas não podem enviar documentos. A avaliação das tarefas e a notificação dos estudantes é sempre ativa e pode ser utilizada.</p>';
$string['helponline'] = '<p>Este tipo de tarefa prevê o uso do editor de textos para escrever diretamente no Moodle. Os professores podem avaliar as tarefas, adicionar comentários ou efetuar mudanças.</p>
<p>(este tipo de tarefa substitui o módulo Diário das versões anteriores de Moodle.)</p>';
$string['helpupload'] = '<p>Este tipo de tarefa permite a cada participante um ou mais arquivos de qualquer tipo.</p>
<p>Exemplos de formato de arquivo são os textos Word, imagens, web sites em arquivo zip, ou outros documentos que você indicar.</p>
<p>Este tipo também permite ao professor o envio de um ou mais arquivos de resposta em qualquer formato.</p>';
$string['helpuploadsingle'] = '<p>Este tipo de tarefa prevê que cada estudante envie um documento ao servidor, no formato que for desejado, como Word, imagens, coleções de documentos em arquivo zip, etc.</p>';
$string['hideintro'] = 'Esconder descrição antes da data de abertura';
$string['hideintro_help'] = '<p>Se habilitado, a descrição da tarefa não é visualizada antes da data de abertura.</p>';
$string['invalidassignment'] = 'Tarefa inválida';
$string['invalidfileandsubmissionid'] = 'Arquivo não enviado ou ID do envio inválido';
$string['invalidid'] = 'ID da tarefa inválido';
$string['invalidsubmissionid'] = 'ID do envio inválido';
$string['invalidtype'] = 'Tipo de tarefa inválido';
$string['invaliduserid'] = 'ID de usuário inválido';
$string['itemstocount'] = 'Contar';
$string['lastgrade'] = 'Última nota';
$string['late'] = '{$a} atrasado';
$string['maximumgrade'] = 'Nota máxima';
$string['maximumsize'] = 'Tamanho máximo';
$string['maxpublishstate'] = 'Visiblidade máxima para a entrada antes da data programada.';
$string['messageprovider:assignment_updates'] = 'Notificações de Atribuição';
$string['modulename'] = 'Tarefa';
$string['modulename_help'] = '<p><img alt="" src="<?php echo $CFG->wwwroot?>/mod/assignment/icon.gif" />&nbsp;<b>Tarefas</b></p>
<div class="indent">
Uma tarefa consiste na descrição ou enunciado de uma atividade a ser desenvolvida pelo participante, que pode ser enviada em formato digital ao servidor do curso utilizando a plataforma.  Alguns exemplos: redações, projetos, relatórios, imagens, etc. Este módulo inclui a possibilidade de descrever tarefas a serem realizadas offline - na sala de aula por exemplo - e de publicar o resultado da avaliação.
</div>';
$string['modulenameplural'] = 'Tarefas';
$string['newsubmissions'] = 'Tarefas apresentadas';
$string['noassignments'] = 'Ainda não há nenhuma tarefa';
$string['noattempts'] = 'Nenhuma tentativa nesta tarefa';
$string['noblogs'] = 'Você não tem entradas no blog para apresentar.';
$string['nofiles'] = 'Nenhum arquivo enviado';
$string['nofilesyet'] = 'Nenhum arquivo enviado ainda';
$string['nomoresubmissions'] = 'Não é possível enviar outros documentos.';
$string['norequiregrading'] = 'Não existem tarefas que requerm notas';
$string['nosubmisson'] = 'Nenhuma tarefa enviada';
$string['notavailableyet'] = 'Esta tarefa ainda não pode ser acessada..<br /> As instruções serão disponíveis aqui a partir da seguinte data:';
$string['notes'] = 'Notas';
$string['notesempty'] = 'Nenhum item';
$string['notesupdateerror'] = 'Erro durante a atualização das notas';
$string['notgradedyet'] = 'Ainda não avaliada';
$string['notsubmittedyet'] = 'Ainda não apresentadas';
$string['onceassignmentsent'] = 'Depois de enviar a tarefa para avaliação não será possível excluir ou anexar documentos.';
$string['operation'] = 'Operação';
$string['optionalsettings'] = 'Configurações opcionais';
$string['overwritewarning'] = 'Atenção: a nova transferência de arquivo vai SUBSTITUIR a tarefa arquivada atualmente';
$string['page-mod-assignment-submissions'] = 'Página de envio de tarefa';
$string['page-mod-assignment-view'] = 'Página principal da tarefa';
$string['page-mod-assignment-x'] = 'Qualquer página de tarefa';
$string['pagesize'] = 'Envios mostrados por página';
$string['pluginadministration'] = 'Administração de tarefas';
$string['pluginname'] = 'Tarefa';
$string['popupinnewwindow'] = 'Abrir uma janela popup';
$string['preventlate'] = 'Impedir envio atrasado';
$string['quickgrade'] = 'Permitir avaliação veloz';
$string['quickgrade_help'] = '<p>Com a Avaliação Rápida ativada, você pode avaliar rapidamente diversos envios na
   mesma página.</p>

<p>Basta mudar a nota e os comentários e usar o botão Salvar no fim da página para gravar
   todas as mudanças.</p>

<p>Os botões de acesso à página de avaliação individual continuam ativos, caso você precise de mais espaço para escrever feedbacks.
   Suas preferências de Avaliação Rápida serão gravadas e aplicadas a todas as terefas, em todos os
   cursos.</p>';
$string['requiregrading'] = 'Requer pontuação (notas)';
$string['responsefiles'] = 'Arquivos de resposta';
$string['reviewed'] = 'Revisado';
$string['saveallfeedback'] = 'Gravar notas e comentários';
$string['selectblog'] = 'Selecione o item do blog a ser enviado';
$string['sendformarking'] = 'Enviar para avaliação';
$string['showrecentsubmissions'] = 'Mostrar envios recentes';
$string['submission'] = 'Envio de tarefas';
$string['submissiondraft'] = 'Esboço do documento';
$string['submissionfeedback'] = 'Feedback';
$string['submissions'] = 'Tarefas enviadas';
$string['submissionsaved'] = 'As suas mudanças foram efetuadas';
$string['submissionsnotgraded'] = '{$a} envios não avaliados';
$string['submitassignment'] = 'Envie a sua tarefa usando este formulário';
$string['submitedformarking'] = 'A tarefa já foi enviada para avaliação e não pode ser atualizada';
$string['submitformarking'] = 'Enviar tarefa para avaliação';
$string['submitted'] = 'Enviada';
$string['submittedfiles'] = 'Arquivos enviados';
$string['subplugintype_assignment'] = 'Tipo de tarefa';
$string['subplugintype_assignment_plural'] = 'Tipos de tarefa';
$string['trackdrafts'] = 'Habilitar Envio para Avaliação';
$string['trackdrafts_help'] = '<p>O botão "Enviar para avaliação" permite que os usuários comuniquem aos professores que eles terminaram uma tarefa. Os professores podem reverter o status do envio para rascunho (caso o trabalho precise ser melhorado, por exemplo).</p>';
$string['typeblog'] = 'Postagem em blog';
$string['typeoffline'] = 'Atividade offline';
$string['typeonline'] = 'Texto online';
$string['typeupload'] = 'Modalidade avançada de carregamento de arquivos';
$string['typeuploadsingle'] = 'Envio de  arquivo único';
$string['unfinalize'] = 'Reverter a esboço';
$string['unfinalizeerror'] = 'Erro: não foi possível reverter a esboço';
$string['unfinalize_help'] = 'Reverter para rascunho permite ao estudante fazer novas atualizações em sua tarefa';
$string['uploadafile'] = 'Enviar um arquivo';
$string['uploadbadname'] = 'O nome deste arquivo contém caracteres estranhos e não pode ser enviado';
$string['uploadedfiles'] = 'Arquivos enviados';
$string['uploaderror'] = 'Erro durante a gravação do arquivo no servidor';
$string['uploadfailnoupdate'] = 'O arquivo foi recebido, mas não foi possível atualizar a sua tarefa!';
$string['uploadfiles'] = 'Enviar arquivos';
$string['uploadfiletoobig'] = 'Infelizmente este arquivo é muito grande (o limite é de {$a} bytes)';
$string['uploadnofilefound'] = 'Não foi encontrado nenhum arquivo - você tem certeza que selecionou um arquivo para enviar?';
$string['uploadnotregistered'] = '\'{$a}\' foi recebido corretamente mas o envio não foi registrado!';
$string['uploadsuccess'] = '\'{$a}\' enviado com sucesso!';
$string['usermisconf'] = 'Configuração incorreta de usuário';
$string['usernosubmit'] = 'Sentimos muito, mas você não tem permissão para apresentar atribuições.
';
$string['viewfeedback'] = 'Ver  avaliação e feedback';
$string['viewmysubmission'] = 'Ver minha apresentação';
$string['viewsubmissions'] = 'Ver {$a} tarefas enviadas';
$string['yoursubmission'] = 'As suas tarefas';
