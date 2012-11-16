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
 * Strings for component 'completion', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   completion
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['achievinggrade'] = 'Nota de aprovação';
$string['activities'] = 'Atividades';
$string['activitiescompleted'] = 'Atividades concluídas';
$string['activitycompletion'] = 'Conclusão de atividades';
$string['activityrpl'] = 'RPL da atividade';
$string['addcourseprerequisite'] = 'Acrescentar prerequisitos do curso';
$string['afterspecifieddate'] = 'Após data especificada';
$string['aggregateall'] = 'Tudo';
$string['aggregateany'] = 'Qualquer';
$string['aggregationmethod'] = 'Método de agregação';
$string['all'] = 'Todos';
$string['any'] = 'Qualquer';
$string['approval'] = 'Aprovação';
$string['badautocompletion'] = 'Quando selecionar conclusão automática deve também habilitar pelo menos um requisito (abaixo)';
$string['complete'] = 'Concluir';
$string['completed'] = 'Concluído';
$string['completedunlocked'] = 'Opções de conclusão desbloqueadas';
$string['completedunlockedtext'] = 'Quando gravar as mudanças, o estado de progresso realizado pelos cursistas será apagado. Se mudar de ideia, não grave os dados deste formulário.';
$string['completedwarning'] = 'Opções de conclusão bloqueadas';
$string['completedwarningtext'] = 'Um ou mais cursistas ({$a}) já marcaram esta atividade como concluída. Mudar os requisitos de conclusão apagará o estado de progresso e poderá causar confusão. Por isto as opções estão bloqueadas e não devem ser desbloqueadas a menos que seja absolutamente necessário.';
$string['completeviarpl'] = 'Concluir via rpl';
$string['completion'] = 'Acompanhamento de conclusão';
$string['completion-alt-auto-enabled'] = 'O sistema marca este item como completado de acordo com as condições: {$a}';
$string['completion-alt-auto-fail'] = 'Completado: {$a} (não obteve nota para aprovação)';
$string['completion-alt-auto-n'] = 'Não concluído(s): {$a}';
$string['completion-alt-auto-pass'] = 'Completado: {$a} (foi atingida a nota de aprovação)';
$string['completion-alt-auto-y'] = 'Concluído: {$a}';
$string['completion-alt-manual-enabled'] = 'Os alunos podem marcar manualmente este item como completado: {$a}';
$string['completion-alt-manual-n'] = 'Não concluído(s): {$a}. Selecione para marcar como concluído.';
$string['completion-alt-manual-y'] = 'Concluído(s): {$a}. Selecione para marcar como não concluído.';
$string['completion-fail'] = 'Concluído (não alcançar grau passagem)';
$string['completion-n'] = 'Não concluído(a)';
$string['completion-pass'] = 'Concluído (grau de passagem alcançado)';
$string['completion-title-manual-n'] = 'Marcar como concluído: {$a}';
$string['completion-title-manual-y'] = 'Marcar como não concluído: {$a}';
$string['completion-y'] = 'Concluído';
$string['completion_automatic'] = 'Mostrar atividade como concluída quando as condições forem satisfeitas';
$string['completion_help'] = 'Se habilitada, a conclusão de atividade é acompanhada, manual ou automaticamente, sob certas condições. Se desejado, podem ser configuradas múltiplas condições. Nesse caso, a atividade só será considerada concluída quando TODAS as condições forem satisfeitas.
Uma marca próximo ao nome da atividade na página do curso indica que ela foi concluída.';
$string['completion_manual'] = 'Os alunos podem marcar manualmente a atividade como concluída';
$string['completion_none'] = 'Não indicar a conclusão de atividade';
$string['completiondisabled'] = 'Desativado, não é exibido nas configurações de atividade';
$string['completionenabled'] = 'Habilitado, controlado pelo sistema de conclusão de curso e configuração de atividades';
$string['completionexpected'] = 'Espere conclusão em';
$string['completionexpected_help'] = 'Esta configuração especifica a data em que a atividade está prevista para ser concluída. A data não é mostrada aos alunos e só é exibida no relatório de conclusão da atividade.';
$string['completionicons'] = 'Caixa para marcar atividades como concluídas';
$string['completionicons_help'] = 'Uma marca próxima ao nome da atividade pode ser usada para indicar que a atividade foi concluída.
Se forem mostrados pontinhos, você pode clicar neles para marcar quando achar que já concluiu a atividade. (Se mudar de ideia é só clicar novamente). A marca é opcional e é só uma forma de acompanhar seu avanço no curso.
Se for mostrada uma caixa em branco, a marca aparecerá automaticamente quando você concluir a atividade de acordo com as condições estabelecidas pelo professor.';
$string['completionmenuitem'] = 'Completação';
$string['completionnotenabled'] = 'Rastreamento de conclusão não habilitado';
$string['completionnotenabledforcourse'] = 'Rastreamento de conclusão não habilitado para este curso';
$string['completionnotenabledforsite'] = 'Rastreamento de conclusão não habilitada para este site';
$string['completiononunenrolment'] = 'Conclusão quando desinscrever';
$string['completionsettingslocked'] = 'Configurações de conclusão bloqueadas';
$string['completionstartonenrol'] = 'Acompanhamento de Conclusão começa na inscrição';
$string['completionstartonenrolhelp'] = 'Comece a acompanhar o progresso do aluno na conclusão do curso após a inscrição nos cursos';
$string['completionusegrade'] = 'Requer nota';
$string['completionusegrade_desc'] = 'Estudante deve receber uma nota, para concluir essa atividade';
$string['completionusegrade_help'] = 'Se habilitado, a atividade será considerada concluída quando o cursista receber uma nota. Os ícones de aprovado ou reprovado podem ser exibidos se for fixada uma nota de aprovação para a atividade.';
$string['completionview'] = 'Requer visualização';
$string['completionview_desc'] = 'Aluno deve visualizar esta atividade para concluí-la';
$string['configenablecompletion'] = 'Quando habilitado, permite ligar o acompanhamento de conclusão de atividades no nível do curso.';
$string['configenablecourserpl'] = 'Quando ativado, o curso pode ser marcado como concluído atribuindo ao usuário um Registro de aprendizado prévio.';
$string['configenablemodulerpl'] = 'Quando ativado para um módulo, qualquer critério de Conclusão do curso para esse tipo de módulo pode ser marcado como concluído atribuindo ao usuário um Registro de aprendizado prévio.';
$string['confirmselfcompletion'] = 'Confirmar auto-conclusão';
$string['coursealreadycompleted'] = 'Você já concluiu este curso';
$string['coursecomplete'] = 'Curso concluído';
$string['coursecompleted'] = 'Curso concluído';
$string['coursegrade'] = 'Nota do curso';
$string['courseprerequisites'] = 'Pré-requisitos do curso';
$string['courserpl'] = 'RPL do curso';
$string['courserplorallcriteriagroups'] = 'RPL para curso ou <br/>todos os grupos de critérios';
$string['courserploranycriteriagroup'] = 'RPL para curso ou <br/>qualquer grupo de critérios';
$string['coursesavailable'] = 'Cursos disponíveis';
$string['coursesavailableexplaination'] = '<i>Critérios de conclusão do curso devem ser definidos para um curso para aparecer nesta lista</i>';
$string['criteria'] = 'Critérios';
$string['criteriagradenote'] = 'Por favor, note que atualizar a nota exigida aqui não vai atualizar o grau passagem atual curso.';
$string['criteriagroup'] = 'Grupo de critérios';
$string['criteriarequiredall'] = 'Todos os critérios abaixo são necessários';
$string['criteriarequiredany'] = 'Qualquer um dos critérios abaixo são necessários';
$string['csvdownload'] = 'Download em formato de planilha (UTF-8. csv)';
$string['datepassed'] = 'Data passada';
$string['days'] = 'Dias';
$string['daysafterenrolment'] = 'Dias após a inscrição';
$string['deletecoursecompletiondata'] = 'Excluir dados de conclusão de curso';
$string['deletedcourse'] = 'Curso excluído';
$string['dependencies'] = 'Dependências';
$string['dependenciescompleted'] = 'Dependências concluídas';
$string['durationafterenrolment'] = 'Duração após a inscrição';
$string['editcoursecompletionsettings'] = 'Editar configurações de conclusão do curso';
$string['enablecompletion'] = 'Ativar rastreamento de conclusão';
$string['enablecourserpl'] = 'Ativar RPL para cursos';
$string['enablemodulerpl'] = 'Ativar RPL para módulos';
$string['enrolmentduration'] = 'Dias restantes';
$string['err_noactivities'] = 'Informações de conclusão não estão ativadas para nenhuma atividade, de modo que nenhuma informação pode ser exibida. Você pode ativar informações de conclusão editando as configurações para uma atividade.';
$string['err_nocourses'] = 'O acompanhamento de conclusão de curso não está habilitado para nenhum outro curso e, por isto, nada pode ser mostrado. Você pode habilitar o acompanhamento de conclusão de curso nas configurações do curso.';
$string['err_nocriteria'] = 'Nenhum critério de conclusão do curso foi configurado para este curso';
$string['err_nograde'] = 'Não foi fixada uma nota de aprovação para este curso. Para habilitar estes critérios deve criar uma nota de aprovação para o curso.';
$string['err_noroles'] = 'Não há papéis com a permissão \'moodle/course:markcomplete\' neste curso. Este permissão pode ser acrescentada na definição dos papéis.';
$string['err_nousers'] = 'Não há cursistas neste curso ou grupo para os que possa ser mostrada a informação de progresso no curso. (Por padrão, a informação de progresso só é mostrada para os cursistas, assim, este erro será mostrado se não houver cursistas. Os administradores podem alterar esta opção nas telas de administração).';
$string['err_settingslocked'] = 'Um ou mais cursistas já cumpriram o critério, por isto a configuração está bloqueada. Desbloquear a configuração dos critérios apagará os dados de usuários e poderá causar confusão.';
$string['err_system'] = 'Ocorreu um erro interno no sistema de acompanhamento de tarefas concluidas. (Os administradores do ambiente podem habilitar a informação sobre falhas para ver mais detalhes).';
$string['error:rplsaredisabled'] = 'O Registro de aprendizado prévio foi desativado por um Administrador';
$string['excelcsvdownload'] = 'Download em formato compatível com Excel (. csv)';
$string['fraction'] = 'Fração';
$string['graderequired'] = 'Nota exigida';
$string['gradexrequired'] = '{$a} necessário';
$string['inprogress'] = 'Em andamento';
$string['manualcompletionby'] = 'Conclusão manual por';
$string['manualselfcompletion'] = 'Auto-conclusão manual';
$string['markcomplete'] = 'Marcar como concluído';
$string['markedcompleteby'] = 'Marcado como concluída por {$a}';
$string['markingyourselfcomplete'] = 'Marcar-se como concluído';
$string['moredetails'] = 'Mais detalhes';
$string['nocriteriaset'] = 'Não existem critérios de rastreamento de conclusão para este curso';
$string['notcompleted'] = 'Não concluído';
$string['notenroled'] = 'Você não está inscrito neste curso';
$string['notyetstarted'] = 'Não iniciado ainda';
$string['overallcriteriaaggregation'] = 'Tipo de critério global de agregação';
$string['pending'] = 'Pendentes';
$string['periodpostenrolment'] = 'Período de pós-inscrição';
$string['prerequisites'] = 'Pré-requisitos';
$string['prerequisitescompleted'] = 'Pre-requisitos atingidos';
$string['progress'] = 'Progresso do aluno';
$string['progress-title'] = '{$a->user}, {$a->activity}: {$a->state} {$a->date}';
$string['recognitionofpriorlearning'] = 'Reconhecimento de aprendizagem anterior';
$string['remainingenroledfortime'] = 'Permanecer matriculado por um período específico de tempo';
$string['remainingenroleduntildate'] = 'Permanecer matriculado até uma data especificada';
$string['reportpage'] = 'Exibindo usuários {$a->from} a {$a->to} de {$a->total}.';
$string['requiredcriteria'] = 'Critérios exigidos';
$string['restoringcompletiondata'] = 'Data para completar a escrita';
$string['rpl'] = 'RPL';
$string['saved'] = 'Salvo';
$string['seedetails'] = 'Ver detalhes';
$string['self'] = 'Auto';
$string['selfcompletion'] = 'Auto-completar';
$string['showinguser'] = 'Exibindo usuário';
$string['showrpl'] = 'Mostrar RPL';
$string['showrpls'] = 'Mostrar RPLs';
$string['unenrolingfromcourse'] = 'Cancelando inscrição no curso';
$string['unenrolment'] = 'Desinscrição';
$string['unit'] = 'Unidade';
$string['unlockcompletion'] = 'Desbloquear opções de conclusão';
$string['unlockcompletiondelete'] = 'Desbloquear opções de completação e apagar os dados de progresso dos usuários';
$string['usealternateselector'] = 'Usar o seletor de cursos alternativo';
$string['usernotenroled'] = 'Usuário não está inscrito neste curso';
$string['viewcoursereport'] = 'Ver relatório do curso';
$string['viewingactivity'] = 'Visualizando o {$a}';
$string['writingcompletiondata'] = 'Gravando os dados para completar';
$string['xdays'] = '{$a} dias';
$string['yourprogress'] = 'Seu progresso';
