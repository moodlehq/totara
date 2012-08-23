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
 * Strings for component 'workshop', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   workshop
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Controle de acesso';
$string['aggregategrades'] = 'Notas re-calculadas';
$string['aggregation'] = 'Agregação de notas';
$string['allocate'] = 'Alocar envios';
$string['allocatedetails'] = 'esperado: {$a->expected}<br />enviado: {$a->submitted}<br /> alocado para: {$a->allocate}';
$string['allocation'] = 'Alocação de envio';
$string['allocationdone'] = 'Alocação concluída';
$string['allocationerror'] = 'Erro de alocação';
$string['allsubmissions'] = 'Todos os envios';
$string['alreadygraded'] = 'Já foi avaliada';
$string['areainstructauthors'] = 'Instruções para envio';
$string['areainstructreviewers'] = 'Instruções para avaliação';
$string['areasubmissionattachment'] = 'Anexos do envio';
$string['areasubmissioncontent'] = 'Textos enviados';
$string['assess'] = 'Avaliar';
$string['assessedexample'] = 'Exemplo enviado avaliado';
$string['assessedsubmission'] = 'Envio avaliado';
$string['assessingexample'] = 'Avaliação de exemplo enviado';
$string['assessingsubmission'] = 'Avaliação de envio';
$string['assessment'] = 'Avaliação';
$string['assessmentby'] = 'por <a href="{$a->url}">{$a->name}</a>';
$string['assessmentbyfullname'] = 'Avaliação por {$a}';
$string['assessmentbyyourself'] = 'Sua avaliação';
$string['assessmentdeleted'] = 'Avaliação desalocada';
$string['assessmentend'] = 'Prazo da avaliação';
$string['assessmentenddatetime'] = 'Prazo da avaliação: {$a->daydatetime} ({$a->distanceday})';
$string['assessmentendevent'] = '{$a}(data final para avaliação)';
$string['assessmentform'] = 'Formulário de avaliação';
$string['assessmentofsubmission'] = '<a href="{$a->assessmenturl}">Avaliação</a> de <a href="{$a->submissionurl}">{$a->submissiontitle}</a>';
$string['assessmentreference'] = 'Avaliação de referência';
$string['assessmentreferenceconflict'] = 'Não é possível avaliar um envio de exemplo para o qual você proveu uma referência de avaliação.';
$string['assessmentreferenceneeded'] = 'Você precisa avaliar esse envio de exemplo para fornecer uma referência de avaliação. Clique \'Continuar\' para avaliar o envio.';
$string['assessmentsettings'] = 'Configurações da avaliação';
$string['assessmentstart'] = 'Aberto a partir de';
$string['assessmentstartdatetime'] = 'Aberto para avaliação de {$a->daydatetime} ({$a->distanceday})';
$string['assessmentstartevent'] = '{$a} (abre para a avaliação)';
$string['assessmentweight'] = 'Peso da avaliação';
$string['assignedassessments'] = 'Tarefas designadas para avaliar';
$string['assignedassessmentsnone'] = 'Você não tem nenhuma apresentação designado para avaliar';
$string['backtoeditform'] = 'Voltar para formulário de edição';
$string['byfullname'] = 'por <a href="{$a->url}">{$a->name}</a>';
$string['calculategradinggrades'] = 'Calcular notas de avaliação';
$string['calculategradinggradesdetails'] = 'esperado: {$a->expected}<br />calculado: {$a->calculated}';
$string['calculatesubmissiongrades'] = 'Calcular notas de envios';
$string['calculatesubmissiongradesdetails'] = 'esperado: {$a->expected}<br />calculado: {$a->calculated}';
$string['chooseuser'] = 'Escolher usuário...';
$string['clearaggregatedgrades'] = 'Limpar todas as notas agregadas';
$string['clearaggregatedgradesconfirm'] = 'Tem certeza que deseja limpar as notas calculadas para a apresentação e as notas de avaliação?';
$string['clearaggregatedgrades_help'] = 'As notas agregados para a apresentação e notas de avaliação será zerado. Você pode voltar a calcular estas classes a partir do zero em fase de avaliação de classificação novamente.';
$string['clearassessments'] = 'Limpar avaliações';
$string['clearassessmentsconfirm'] = 'Tem certeza de que deseja apagar todos os graus de avaliação? Você não será capaz de obter as informações de volta em seu próprio país, os revisores terão de reavaliar os argumentos atribuídos.';
$string['clearassessments_help'] = 'As notas calculadas para a apresentação e notas de avaliação será zerado. As informações como as formas de avaliação são preenchidas ainda é mantida, mas a todos os revisores devem abrir o formulário de avaliação novamente e voltar a guardá-lo para obter as notas dadas calculado novamente.';
$string['configexamplesmode'] = 'O modo padrão de avaliação de exemplos de oficinas';
$string['configgrade'] = 'Grau máximo padrão para apresentação em seminários';
$string['configgradedecimals'] = 'Número padrão de dígitos que devem ser mostrados após o ponto decimal ao exibir notas.';
$string['configgradinggrade'] = 'Grau máximo padrão para a avaliação em oficinas';
$string['configmaxbytes'] = 'Padrão máximo de tamanho de arquivo apresentação para todos os workshops no site (sujeito a limites de cursos e outras configurações locais)';
$string['configstrategy'] = 'Estratégia padrão de classificação para as oficinas';
$string['createsubmission'] = 'Enviar';
$string['daysago'] = '{$a} dias atrás';
$string['daysleft'] = '{$a} dias passados';
$string['daystoday'] = 'hoje';
$string['daystomorrow'] = 'amanhã';
$string['daysyesterday'] = 'ontem';
$string['deadlinesignored'] = 'As restrições de tempo não se aplicam a você';
$string['editassessmentform'] = 'Editar formuário de avaliação';
$string['editassessmentformstrategy'] = 'Editar formuário de avaliação ({$a})';
$string['editingassessmentform'] = 'Ediçao de formuário de avaliação';
$string['editingsubmission'] = 'Ediçao de tarefa enviada';
$string['editsubmission'] = 'Editar tarefa enviada';
$string['err_multiplesubmissions'] = 'Ao editar esta forma, uma outra versão da apresentação foi salva. Submissões múltiplas por usuário não são permitidos.';
$string['err_removegrademappings'] = 'Não foi possível remover os mapeamentos grau não utilizados';
$string['evaluategradeswait'] = 'Por favor, aguarde até que as avaliações são avaliados e as notas são calculadas';
$string['evaluation'] = 'Avaliação de classificação';
$string['evaluationmethod'] = 'Método de avaliação de classificação';
$string['evaluationmethod_help'] = 'O método de avaliação de classificação determina como o grau de avaliação é calculado. Não há atualmente apenas uma opção - comparação com a melhor avaliação.';
$string['example'] = 'Exemplos de tarefa enviada';
$string['exampleadd'] = 'Adicionar exemplo de tarefa enviada';
$string['exampleassess'] = 'Avaliar exemplo de tarefa enviada';
$string['exampleassessments'] = 'Exemplos de tarefas enviadas para avaliar';
$string['exampleassesstask'] = 'Avaliar exemplos';
$string['exampleassesstaskdetails'] = 'esperado: {$a->expected} <br /> avaliados: {$a->assessed}';
$string['examplecomparing'] = 'Comparação de avaliações de exemplos de tarefas enviadas';
$string['exampledelete'] = 'Excluir example';
$string['exampledeleteconfirm'] = 'Tem certeza de que deseja excluir a submissão exemplo a seguir? Clique em &quot;Continuar&quot; botão para excluir a submissão.';
$string['exampleedit'] = 'Editar exemplos';
$string['exampleediting'] = 'Edição de exemplos';
$string['exampleneedassessed'] = 'Você tem que avaliar todos os exemplos tarefas enviadas primeiro';
$string['exampleneedsubmission'] = 'Você tem que enviar seu trabalho e avaliar todos os exemplos de tarefas enviadas primeiro';
$string['examplesbeforeassessment'] = 'Exemplos estão disponíveis depois de seu próprio envio e devem ser avaliados antes ';
$string['examplesbeforesubmission'] = 'Exemplo devem ser avaliados antes de seu próprio envio';
$string['examplesmode'] = 'Modo de avaliação de exemplos';
$string['examplesubmissions'] = 'Exemplos de tarefas enviadas';
$string['examplesvoluntary'] = 'Avaliação de exemplo de tarefa enviada é voluntária';
$string['feedbackauthor'] = 'Retorno para o autor';
$string['feedbackby'] = 'Comentários por {$a}';
$string['feedbackreviewer'] = 'Retorno para o crítico';
$string['formataggregatedgrade'] = '{$a->grade}';
$string['formataggregatedgradeover'] = '<del>{$a->grade}</del><br /><ins>{$a->over}</ins>';
$string['formatpeergrade'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span>';
$string['formatpeergradeover'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span>';
$string['formatpeergradeoverweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span> @ <span class="weight">{$a->weight}</span>';
$string['formatpeergradeweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span> @ <span class="weight">{$a->weight}</span>';
$string['givengrades'] = 'Notas dadas';
$string['gradecalculated'] = 'Nota calculada para envio';
$string['gradedecimals'] = 'Casas decimais nas notas';
$string['gradegivento'] = '&gt;';
$string['gradeinfo'] = 'Nota: {$a->received} de {$a->max}';
$string['gradeitemassessment'] = '{$a->workshopname} (avaliação)';
$string['gradeitemsubmission'] = '{$a->workshopname} (envio)';
$string['gradeover'] = 'Sobrescrever nota para envio';
$string['gradereceivedfrom'] = '&lt;';
$string['gradesreport'] = 'Relatório de notas do workshop';
$string['gradinggrade'] = 'Grade de Notas';
$string['gradinggradecalculated'] = 'Nota calculada para avaliação';
$string['gradinggrade_help'] = 'Esta configuração espeifica a nota máxima que pode ser obtida para uma avaliação de envio.';
$string['gradinggradeof'] = 'Nota para avaliação (de{$a})';
$string['gradinggradeover'] = 'Sobrescrever nota para avaliação';
$string['gradingsettings'] = 'Configurações de nota';
$string['iamsure'] = 'Sim, eu tenha certeza';
$string['info'] = 'Informação';
$string['instructauthors'] = 'Instruções para envio';
$string['instructreviewers'] = 'Instruções para avaliação';
$string['introduction'] = 'Introdução';
$string['latesubmissions'] = 'Envios atrasados';
$string['latesubmissionsallowed'] = 'Envios atrasados são permitidos';
$string['latesubmissions_desc'] = 'Aceitar envios após o prazo estipulado';
$string['latesubmissions_help'] = 'Se ativado, um autor pode apresentar seu trabalho após o prazo de submissões ou durante a fase de avaliação. A apresentação tardia não pode ser editado no entanto.';
$string['maxbytes'] = 'Tamanho máximo do arquivo';
$string['modulename'] = 'Laboratório de Avaliação';
$string['modulenameplural'] = 'Laboratórios de Avaliação';
$string['mysubmission'] = 'Meu envio';
$string['nattachments'] = 'Número máximo de anexos enviados';
$string['noexamples'] = 'Nenhum exemplo ainda neste workshop';
$string['noexamplesformready'] = 'Você deve definir o formulário de avaliação antes de prover os envios de exemplo';
$string['nogradeyet'] = 'Nenhuma nota ainda';
$string['nosubmissionfound'] = 'Nenhum envio encontrado para este usuário';
$string['nosubmissions'] = 'Nenhum envio neste workshop';
$string['notassessed'] = 'Nada avaliado ainda';
$string['nothingtoreview'] = 'Nada para o crítico';
$string['notoverridden'] = 'Não sobrescrito';
$string['noworkshops'] = 'Não existem workshops neste curso';
$string['noyoursubmission'] = 'Você não enviou seu trabalho ainda';
$string['nullgrade'] = '-';
$string['page-mod-workshop-x'] = 'Qualquer página módulo de oficina';
$string['participant'] = 'Participante';
$string['participantrevierof'] = 'Participante é crítico de';
$string['participantreviewedby'] = 'Participante é criticado por';
$string['phaseassessment'] = 'Fase de avaliação';
$string['phaseclosed'] = 'Encerrado';
$string['phaseevaluation'] = 'Fase de avaliação de classificação';
$string['phasesetup'] = 'Configurar fase';
$string['phasesubmission'] = 'Fase de envio';
$string['pluginadministration'] = 'Adminstração do workshop';
$string['pluginname'] = 'Laboratório de Avaliação';
$string['prepareexamples'] = 'Preparar exemplos de envios';
$string['previewassessmentform'] = 'Preview';
$string['publishedsubmissions'] = 'Documentos enviados publicados';
$string['publishsubmission'] = 'Publicar documentos enviados';
$string['publishsubmission_help'] = 'Envios publicados são disponíves a outros quando o workshop for fechado.';
$string['reassess'] = 'Reavaliar';
$string['receivedgrades'] = 'Notas recebidas';
$string['recentassessments'] = 'Avaliações do workshop:';
$string['recentsubmissions'] = 'Tarefas enviadas do workshop:';
$string['saveandclose'] = 'Salvar e sair';
$string['saveandcontinue'] = 'Salvar e continuar edição';
$string['saveandpreview'] = 'Salvar e pré-visualizar';
$string['selfassessmentdisabled'] = 'Auto-avaliação desativada';
$string['someuserswosubmission'] = 'Existe pelo menos um autor que ainda não enviou seu trabalho';
$string['sortasc'] = 'Ordenação crescente';
$string['sortdesc'] = 'Ordenação decrescente';
$string['strategy'] = 'Estratégia de classificação';
$string['strategyhaschanged'] = 'A estratégia de classificação oficina mudou desde que o formulário foi aberto para edição.';
$string['strategy_help'] = 'A estratégia de classificação determina a forma de avaliação utilizado e do método de submissões de classificação. Há 4 opções: * classificação Acumulativa - Comentários e uma série que sobre aspectos específicos * Comentários - são feitos comentários sobre aspectos específicos, mas nenhuma classe pode ser dada * Número de erros - Comentários e sim / avaliação não são dadas sobre afirmações específicas * Rubrica - A avaliação do nível é dado em relação aos critérios especificados';
$string['submission'] = 'Tarefa enviada';
$string['submissionattachment'] = 'Anexo';
$string['submissionby'] = 'Tarefa enviada por {$a}';
$string['submissioncontent'] = 'Conteúdo enviado';
$string['submissionend'] = 'Prazo dos envios';
$string['submissionenddatetime'] = 'Prazo dos envios: {$a->daydatetime} ({$a->distanceday})';
$string['submissionendevent'] = '{$a} (Prazo de envio)';
$string['submissiongrade'] = 'Nota para envio';
$string['submissiongrade_help'] = 'Esta configuração especifica a nota máxima que pode ser obtida pelos trabalhos enviados.';
$string['submissiongradeof'] = 'Notar para envio (de{$a})';
$string['submissionsettings'] = 'Configurações de envio';
$string['submissionstart'] = 'Início dos envios';
$string['submissionstartdatetime'] = 'Aberto para submissões de
{$a->daydatetime} ({$a->distanceday})';
$string['submissionstartevent'] = '{$a} (aberto para envios)';
$string['submissiontitle'] = 'Título';
$string['subplugintype_workshopallocation'] = 'Método de alocação de submissões';
$string['subplugintype_workshopallocation_plural'] = 'Métodos de alocação de submissões';
$string['subplugintype_workshopeval'] = 'Método de avaliação de classificação';
$string['subplugintype_workshopeval_plural'] = 'Métodos de avaliação de classificação';
$string['subplugintype_workshopform'] = 'Estratégia de classificação';
$string['subplugintype_workshopform_plural'] = 'Estratégias de classificação';
$string['switchingphase'] = 'Mudança de fase';
$string['switchphase'] = 'Mudar fase';
$string['switchphase10info'] = 'Você está prestes a mudar o workshop para <strong> fase de instalação</ strong>. Nesta fase, os usuários não podem modificar as suas submissões ou as suas avaliações. Os professores podem utilizar essa fase para alterar as configurações do workshop, modificar a estratégia de classificação dos formulários de ajustes de avaliação.';
$string['switchphase20info'] = 'Você está prestes a mudar o workshop para a  <strong> Fase de Submissão</ strong>. Os estudantes podem apresentar os seus trabalhos durante esta fase (dentro das datas de apresentação de acordo com o controle de acesso, se isso estiver definido). Os professores podem atribuir submissões para revisão por pares.';
$string['switchphase30info'] = 'Você está prestes a mudar o workshop para a <strong> Fase de Avaliação</ strong>. Nesta fase, os avaliadores podem analisar as submissões que lhes forem atribuídas (dentro das datas de avaliação de acordo com o controle de acesso, se estiver definido).';
$string['switchphase40info'] = 'Você está prestes a mudar o workshop para a <strong> Fase de Avaliação da Classificação </ strong>. Nesta fase, os usuários não podem modificar as suas submissões ou as suas avaliações. Os professores podem usar as ferramentas de avaliação de classificação para calcular as notas finais e fornecer feedback para revisores.';
$string['switchphase50info'] = 'Você está prestes a encerrar o workshop. A partir daí, será feito o cálculo das notas que aparecem no Livro de Notas. Os alunos podem ver as suas submissões e suas avaliações.';
$string['taskassesspeers'] = 'avaliar pares';
$string['taskassesspeersdetails'] = 'total: {$a->total}<br/>pendente: {$a->todo}';
$string['taskassessself'] = 'Avaliar você mesmo';
$string['taskinstructauthors'] = 'Prover instruções para envio';
$string['taskinstructreviewers'] = 'Prover instruções para avaliação';
$string['taskintro'] = 'Atribua a introdução do workshop';
$string['tasksubmit'] = 'Enviar seu trabalho';
$string['toolbox'] = 'Barra de ferramentas do workshop';
$string['undersetup'] = 'O workshop está sendo configurado. Por favor espere até que ele mude pra a próxima fase.';
$string['useexamples'] = 'Usar exemplos';
$string['useexamples_desc'] = 'Exemplos de submissões são fornecidos para a prática na avaliação';
$string['useexamples_help'] = 'Se habilitado, os usuários podem tentar avaliar um ou mais exemplos de submissão e comparar a sua avaliação com uma avaliação de referência. A nota não é computada na nota para avaliação.';
$string['usepeerassessment'] = 'Use avaliação de pares';
$string['usepeerassessment_desc'] = 'Alunos podem avaliar o trabalho dos outros';
$string['usepeerassessment_help'] = 'Se habilitado, um usuário pode receber submissões de outros usuários para avaliar e receberá uma nota como avaliador, além de uma nota para sua própria submissão.';
$string['userdatecreated'] = 'enviado em <span>{$a}</span>';
$string['userdatemodified'] = 'modificado em <span>{$a}</span>';
$string['userplan'] = 'Planejador do workshop';
$string['userplan_help'] = 'O planejador do workshop exibe todas as fases da atividade e relaciona as tarefas para cada fase. A fase atual é destacada e a conclusão da tarefa é indicado com um visto.';
$string['useselfassessment'] = 'Usar auto-avaliação';
$string['useselfassessment_desc'] = 'Alunos podem avaliar seus próprios trabalhos';
$string['useselfassessment_help'] = 'Se habilitado, um usuário pode ser receber a sua própria submissão para avaliar e receberá uma nota como avaliador, além de uma nota para a sua própria submissão.';
$string['weightinfo'] = 'Peso: {$a}';
$string['withoutsubmission'] = 'Crítico sem envio próprio';
$string['workshop:allocate'] = 'Alicar envios para crítico';
$string['workshop:editdimensions'] = 'Editar formuários de avaliação';
$string['workshopfeatures'] = 'Recursos do workshop';
$string['workshop:ignoredeadlines'] = 'Ignorar restrições de tempo';
$string['workshop:manageexamples'] = 'Gerenciar envios de exemplo';
$string['workshopname'] = 'Nome do workshop';
$string['workshop:overridegrades'] = 'Sobrescrever as notas calculadas';
$string['workshop:peerassess'] = 'Avaliar par';
$string['workshop:publishsubmissions'] = 'Publicar envios';
$string['workshop:submit'] = 'Enviar';
$string['workshop:switchphase'] = 'Mudar faser';
$string['workshop:view'] = 'Visualizar workshop';
$string['workshop:viewallassessments'] = 'Visualizar todas avaliações';
$string['workshop:viewallsubmissions'] = 'Visualizar todos envios';
$string['workshop:viewauthornames'] = 'Visualizar todos nomes de autores';
$string['workshop:viewauthorpublished'] = 'Visualizar autores de submissões publicadas';
$string['workshop:viewpublishedsubmissions'] = 'Visualizar todos os envios publicados';
$string['workshop:viewreviewernames'] = 'Visualizar todos nomes de críticos';
$string['yourassessment'] = 'A sua avaliação';
$string['yoursubmission'] = 'Seu envio';
