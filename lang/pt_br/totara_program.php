<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Strings for component 'totara_program', language 'pt_br', branch 'totara-2.2'
 * @package totara
 * @subpackage totara_program
 */

$string['action'] = 'Ação';
$string['addcohortstoprogram'] = 'Adicionar grupos ao programa';
$string['addcohorttoprogram'] = 'Adicionar grupo ao programa';
$string['addcompetency'] = 'Adicionar competência';
$string['addcourse'] = 'Adicionar curso';
$string['addcourses'] = 'Adicionar cursos';
$string['addindividualstoprogram'] = 'Adicionar indivíduos para o programa';
$string['addindividualtoprogram'] = 'Adicionar indivíduo para o programa';
$string['addmanagerstoprogram'] = 'Adicionar gerente para o programa';
$string['addmanagertoprogram'] = 'Adicionar gerente para o programa';
$string['addnew'] = 'Adicionar um novo';
$string['addnewprogram'] = 'Adicionar um novo programa';
$string['addorganisationstoprogram'] = 'Adicionar organizações ao programa';
$string['addorganisationtoprogram'] = 'Adicionar organização ao programa';
$string['addorremovecourses'] = 'Adicionar/remover cursos';
$string['addpositiontoprogram'] = 'Adicionar posição ao programa';
$string['addprogramcontent_help'] = '# Adicionar conteúdo do programa
Ao adicionar as configurações do curso, você poderá construir o caminho de aprendizagem do programa. Uma vez que que as configurações sejam adicionadas, as relações entre elas poderão ser definidas. As configurações poderão ser criadas ao adicionar os cursos manualmente, selecionando uma competência pré-definida ou configurar um simples curso com repetição.
Uma vez que o número de configurações tenham sido criadas, os dividores de configuração serão empregados para permitir a criação de sequências (ex. dependências) entre cada configuração. Um exemplo de programa com quatro configurações de curso definidas poderão ter dependências conforme a seguir:
* A partir da configuração de um, o aluno deve completar um curso (cursoA ou cursoB) antes de prosseguir para a configuração dois.
* A partir da configuração dois, o aluno deve completar todos os cursos (cursoC, cursoD e cursoE) antes de prosseguir para a configuração três ou configurar o quatro.
* A partir da confoguração três, o aluno deve completar um curso (cursoE) ou todos os cursos a partir da configuração quatro (cursoF e cursoG).
Uma vez que o caminho de aprendizagem esteja completo, o aluno concluiu o programa.
As configurações poderão ser criadas ao adicionar:
## Configuração dos cursos
Permite a criação de múltiplos ajustes de cursos com dependências.
## Competência
Permite a criação de múltiplas configurações de cursos a partir de uma evidência de compet~encia pré-definida. Quando a competência for utilizada para criar uma configuração, esta se tornará rígida e não poderá ser mudada.
## Curso único
Força a permissão de um único curso com repetição.
Uma vez que a configuração dos cursos ou a competência for escolhida, o curso único com repetição será removido da lista.';
$string['affectedusercount'] = 'Número de alunos afetados por estas mudanças:';
$string['allbelow'] = 'Tudo abaixo';
$string['allbelowlower'] = 'tudo abaixo';
$string['allcompletiontimeunknownissues'] = 'Tempo completo das questões desconhecidas';
$string['allcourses'] = 'Todos os cursos';
$string['allcoursesfrom'] = 'todos os cursos de';
$string['allcurrentlyassignedissues'] = 'Todas as questões atualmente atribuídas';
$string['allextensionrequestissues'] = 'Todas as questões de solicitação de prorrogação';
$string['alllearners'] = 'Todos os alunos';
$string['allowedtimeforprogramaslearner'] = 'Você está autorizado {$a->num} {$a->periodstr} a completar este programa.';
$string['allowedtimeforprogramasmanager'] = '{$a->fullname} está autorizado {$a->num} {$a->periodstr} a completar este programa.';
$string['allowedtimeforprogramviewing'] = 'O aluno está autorizado {$a->num} {$a->periodstr} a completar este programa.';
$string['allowtimeforprogram'] = 'Autorizar {$a->num} {$a->periodstr} a completar este programa.';
$string['allowtimeforset'] = 'Autorizar {$a->num} {$a->periodstr} a completar esta configuração.';
$string['alltimeallowanceissues'] = 'Questões mais relacionadas a desconto';
$string['and'] = 'e';
$string['anothercourse'] = 'outro curso';
$string['areyousuredeletemessage'] = 'Tem certeza que deseja apagar esta mensagem?';
$string['assignmentcriterialearner'] = 'Você deve terminar este programa com base nos critérios a seguir:';
$string['assignmentcriteriamanager'] = 'O estudante deve terminar este programa com base nos critérios a seguir:';
$string['assignments'] = 'Tarefas';
$string['availability'] = 'Disponibilidade';
$string['availablefrom'] = 'Disponível de';
$string['availabletostudents'] = 'Disponível para estudantes';
$string['availabletostudentsnot'] = 'Não está disponível para os estudantes';
$string['availableuntil'] = 'Disponível até';
$string['backtoallextrequests'] = 'Voltar para todas as solicitações de prorrogação';
$string['beforecourseends'] = 'antes do curso terminar';
$string['browsecategories'] = 'Navegar pelas categorias';
$string['cancel'] = 'Cancelar';
$string['cancelprogramblurb'] = 'Ao cancelar, você removerá quaisquer mudanças não salvas';
$string['cancelprogrammanagement'] = 'Limpar as mudanças não salvadas';
$string['category'] = 'Categoria';
$string['changecourse'] = 'Mudar curso';
$string['checkprogramdelete'] = 'Tem certeza que deseja apagar este programa e todos os itens relacionados?';
$string['chooseicon'] = 'Escolher imagem para inserir';
$string['chooseitem'] = 'Escolher item';
$string['choseautomaticallydetermine'] = 'Você escolheu em permitir que o sistema automaticamente determine um tempo de estrutura realístico para o término do programa';
$string['chosedenyextensionexception'] = 'Você escolheu rejeitar a solicitação de prorrogação selecionada';
$string['chosedismissexception'] = 'Você escolheu rejeitar esta exceção';
$string['chosegrantextensionexception'] = 'Você escolheu em conceder as solicitações de prorrogação selecionadas';
$string['choseoverrideexception'] = 'Você escolheu substituir a exceção e continuar com a tarefa';
$string['cohort'] = 'Grupo';
$string['cohortname'] = 'Nome do grupo';
$string['cohorts'] = 'Grupos';
$string['cohorts_category'] = 'grupo(s)';
$string['competency'] = 'Competência';
$string['competencycourseset_help'] = '# Configuração de competência do curso
Esta configuração foi criada a partir de uma competência pré-definida.
Quando uma competência for usada para criar uma configuração, esta se tornará rígida e não poderá ser mudada. Os cursos dentro da configuração não poderão ser editados. Se os cursos dentro desta configuração precisarem ser modificados, uma configuração manual de cursos deverá ser criada e os cursos adicionados individualmente.
As opções do operador dentro da configuração da competência do curso (\'um curso\' ou \'todos os cursos\') são determinadas pelas configurações da competência pré-definida.';
$string['complete'] = 'Completo';
$string['completeallcourses'] = 'Todos os cursos nesta configuração deverão estar concluídos (a menos que seja uma configuração opcional)';
$string['completeanycourse'] = 'Qualquer curso desta configuração deve estar concluído';
$string['completeby'] = 'Completo por';
$string['completebytime'] = 'Completo por {$a}';
$string['completewithin'] = 'Completo dentro';
$string['completewithinevent'] = 'Completar no {$a->num} {$a->period} de {$a->event} {$a->instance}';
$string['completioncriteria'] = 'Critério do término';
$string['completiondate'] = 'Data de término';
$string['completionstatus'] = 'Situação';
$string['completiontimeunknown'] = 'Período do término desconhecido';
$string['completiontype_help'] = '# Tipo de conclusão
As opções do operador (\'O aluno deve concluir\') dentro da configuração são \'um curso\', significando OU ou \'todos os cursos\', significando E. A ideia é manter o fluxo humanamente legível. Dependendo da opção escolhida, o texto na frente dos cursos mudará automaticamente.';
$string['confirmassignmentchanges'] = 'Confirmar as mudanças nas tarefas';
$string['confirmcontentchanges'] = 'Confirmar as mudanças de conteúdo';
$string['confirmmessagechanges'] = 'Confirmar as mudanças';
$string['confirmresolution'] = 'Confirmar resolução da questão';
$string['content'] = 'Conteúdo';
$string['contentupdatednotsaved'] = 'Atualização do conteúdo do programa (ainda não foi salvo)';
$string['continue'] = 'Continuar';
$string['couldnotinsertnewrecord'] = 'Impossível de inserir um novo registro';
$string['course'] = 'Curso';
$string['coursecompletion'] = 'Término do curso';
$string['coursecreation_help'] = '# Criação do curso
A criação do curso define quando o curso deveria ser copiado e recriado.
Isso influenciará na data inicial e final especificada nas configurações do curso.';
$string['coursename'] = 'Nome do curso';
$string['coursenamelink'] = 'Nome do curso';
$string['courses'] = 'Cursos';
$string['coursesetcompleted'] = 'Configuração do curso completa';
$string['coursesetcompletedmessage_help'] = '# Mensagem de conclusão da configuração do curso
Esta mensagem será enviada quando a configuração do curso estiver concluída.';
$string['coursesetdue'] = 'Configuração do vencimento do curso';
$string['coursesetduemessage_help'] = '# Mensagem do prazo da configuração do curso
Esta mensagem será enviada em um período específico antes do prazo da configuração do curso terminar.';
$string['coursesetoverdue'] = 'Configuração do atraso do curso';
$string['coursesetoverduemessage_help'] = '# Mensagem de vencimento da configuração do curso
Esta mensagem será enviada em um período específico após a configuração do curso atingir o prazo.';
$string['createandnext'] = 'Criar e ir para a próxima etapa';
$string['createandreturn'] = 'Criar e retornar para substituir';
$string['createcourse'] = 'Criar um curso';
$string['createnewprogram'] = 'Criar um novo programa';
$string['createprogram'] = 'Criar um programa';
$string['currentduedate'] = 'Prazo atual';
$string['currenticon'] = 'Ícone atual';
$string['currentlyassigned'] = 'Atualmente inscrito';
$string['days'] = 'Dia(s)';
$string['daysremaining'] = '{$a} restante de dias';
$string['defaultenrolmentmessage_message'] = 'Você agora está inscrito no programa %programfullname%.';
$string['defaultenrolmentmessage_subject'] = 'Você foi inscrito no programa %programfullname%';
$string['defaultexceptionreportmessage_message'] = 'Há exceções no programa %programfullname% que precisam ser resolvidas.';
$string['defaultexceptionreportmessage_subject'] = 'As exceções necessitam de atenção no programa %programfullname%';
$string['defaultprogramfullname'] = 'Nome completo do programa 101';
$string['defaultprogramshortname'] = 'P101';
$string['delete'] = 'Apagar';
$string['deletecourse'] = 'Apagar curso';
$string['deleteprogram'] = 'Apagar programa "{$a}"';
$string['deleteprogrambutton'] = 'Apagar programa';
$string['deny'] = 'Negar';
$string['denyextensionrequest'] = 'Solicitação de prorrogação negada';
$string['description'] = 'Descrição';
$string['details'] = 'Detalhes';
$string['directteam'] = 'Time direto';
$string['dismissandtakenoaction'] = 'Liberar e não realizar a ação';
$string['duedate'] = 'Data de pagamento';
$string['duedatenotset'] = 'Sem prazo configurado';
$string['duestatus'] = 'Pagamento/Situação';
$string['editassignments'] = 'Editar tarefas';
$string['editcontent'] = 'Editar conteúdo';
$string['editmessages'] = 'Editar mensagens';
$string['editprogramassignments'] = 'Editar as tarefas do programa';
$string['editprogramcontent'] = 'Editar o conteúdo do programa';
$string['editprogramdetails'] = 'Editar os detalhes do programa';
$string['editprogrammessages'] = 'Editar as mensagens do programa';
$string['editprogramroleassignments'] = 'Editar as tarefas de função do programa';
$string['editprograms'] = 'Adicionar/editar programas';
$string['endnote'] = 'Nota de término do programa';
$string['enrolmentmessage_help'] = '# Mensagem de inscrição
Esta mensagem será enviada quando o usuário for automaticamente designado para um programa.';
$string['error:availibileuntilearlierthanfrom'] = 'Disponível até a uma data que não poderá anteceder a esta data';
$string['error:badcheckvariable'] = 'A variável de verificação estava errada - tentar novamente';
$string['error:cannotrequestextnotuser'] = 'Você não pode solicitar uma prorrogação para outro usuário';
$string['error:couldnotloadextension'] = 'Erro, não foi possível carregar a prorrogação';
$string['error:coursecreation_nonzero'] = 'A criação do curso deve ser maior que zero dias antes do término do curso';
$string['error:courses_endenroldate'] = 'Você deve determinar uma data final de inscrição para este curso, se você desejar a periodicidade deste';
$string['error:courses_nocourses'] = 'As configurações do curso deve conter ao menos um curso.';
$string['error:deleteset'] = 'Impossível apagar a configuração. A configuração não foi encontrada.';
$string['error:failedsendextensiondenyalert'] = 'Erro, falha em alertar o usuário da prorrogação negada';
$string['error:failedsendextensiongrantalert'] = 'Erro, falha ao alertar o usuário da concessão da prorrogação';
$string['error:failedtofindmanagerrole'] = 'Impossível encontrar a função com gerente de nome curto';
$string['error:failedtofindstudentrole'] = 'Impossível encontrar a função com estudante de nome curto';
$string['error:failedtofinduser'] = 'Falha em encontrar o usuário com id {$a}';
$string['error:failedupdateextension'] = 'Erro, falha ao atualizar o programa com novo prazo';
$string['error:inaccessible'] = 'Você atualmente não pode acessar este programa';
$string['error:invaliddate'] = 'Os dados não são válidos';
$string['error:invalidid'] = 'Este é um id inválido do programa';
$string['error:invalidshortname'] = 'Este é um nome curto de programa inválido';
$string['error:mainmessage_empty'] = 'É necessário uma mensagem';
$string['error:messagesubject_empty'] = 'É necessário o título da mensagem';
$string['error:nopermissions'] = 'Você não tem permissão necessária para realizar esta ação';
$string['error:noprogramcompletionfound'] = 'Nenhum registro completo do programa foi encontrado';
$string['error:notusersmanager'] = 'Você não é o gerente do usuário que solicitou esta prorrogação';
$string['error:processingextrequest'] = 'Ocorreu um erro ao processar a solicitação de prorrogação';
$string['error:recurrence_nonzero'] = 'Periodicidade devr ser maior que zero';
$string['error:setunableaddcompetency'] = 'Impossível adicionar a competência para configuração. A configuração ou competência não foi encontrada.';
$string['error:setunabletoaddcourse'] = 'Impossível adicionar o curso para configuração. A configuração ou o curso não foi encontrado.';
$string['error:setunabletodeletecourse'] = 'Impossível apagar o curso a partir da configuração {$a}';
$string['error:setupprogcontent'] = 'Impossível configurar o conteúdo do programa';
$string['error:timeallowednum_nonzero'] = 'Permissão de tempo deve ser maior que zero';
$string['error:unabletoaddset'] = 'Impossível de adicionar nova configuração. Tipo de configuração não reconhecido.';
$string['error:unabletosetupprogcontent'] = 'Impossível de configurar o conteúdo do programa';
$string['error:updateextensionstatus'] = 'Erro, falha na atualização da situação da prorrogação';
$string['errorsinform'] = 'Há erros neste formulário. Revise a lista abaixo e acerte quaisquer erros antes de salvar.';
$string['eventnotfound'] = 'O evento da tarefa do programa com id {$a} não foi encontrado';
$string['exceptionreportmessage_help'] = '# Mensagem do relatório de exceção
Esta mensagem será enviada pelo administrador do site quando novas exceções forem adicionadas ao relatório de exceção do programa.';
$string['exceptions'] = 'Relatório de Exceção ({$a})';
$string['exceptionsreport'] = 'Relatório de exceções';
$string['extenduntil'] = 'Prorrogação até';
$string['extensionbeforenow'] = 'Não pode pedir prorrogação que anteceda a data atual';
$string['extensiondate'] = 'Data da prorrogação';
$string['extensiondenied'] = 'Prorrogação negada';
$string['extensiondeniedmessage'] = 'Sua solicitação por uma prorrogação foi negada.';
$string['extensionearlierthanduedate'] = 'Impossível a solicitação de prorrogação que anteceda o prazo do programa.';
$string['extensiongranted'] = 'Prorrogação concedida';
$string['extensiongrantedmessage'] = 'Você obteve uma prorrogação até {$a}.';
$string['extensionrequest'] = 'Solicitar prorrogação';
$string['extensionrequestfailed'] = 'Falha na solicitação de prorrogação. Tente novamente.';
$string['extensionrequestfailed:nomanager'] = 'A solicitação de prorrogação não foi enviada. O gerente não foi encontrado';
$string['extensionrequestmessage'] = '<p>Um usuário solicitou uma prorrogação para o programa <em>{$a->programfullname}</em>. Os detalhes da solicitação são:</p><ul><li>Data: {$a->extensiondatestr}</li><li>Razão: {$a->extensionreason}</li></ul>';
$string['extensionrequestmessage_help'] = '# Mensagem de solicitação de prorrogação
Esta mensagem será enviada ao gerente do aluno quando for realizada uma solicitação de prorrogação do programa.';
$string['extensionrequestnotsent'] = 'A solicitação de prorrogação não pode ser enviada. Tente novamente.';
$string['extensionrequestsent'] = 'Solicitação de prorrogação enviada com sucesso';
$string['extensions'] = 'Prorrogações';
$string['failedtoresolve'] = 'Falha ao determinar as exceções a seguir';
$string['findprograms'] = 'Procurar Programas';
$string['firstlogin'] = 'Primeiro login';
$string['for'] = 'Para';
$string['fullname'] = 'Nome completo';
$string['grant'] = 'Conceder';
$string['grantdeny'] = 'Conceder/Negar';
$string['grantextensionrequest'] = 'Conceder solicitação de prorrogação';
$string['header:hash'] = '#';
$string['header:id'] = 'ID';
$string['header:issue'] = 'Questão';
$string['header:learners'] = 'Alunos';
$string['hours'] = 'Hora(s)';
$string['icon'] = 'Ícone';
$string['idnumberprogram'] = 'ID';
$string['incomplete'] = 'Incompleto';
$string['individualname'] = 'Nome individual';
$string['individuals'] = 'Indivíduos';
$string['individuals_category'] = 'indivíduo(s)';
$string['instructions:assignments1'] = 'As categorias poderão ser utilizadas para atribuir ao programa as configurações dos alunos.';
$string['instructions:messages1'] = 'Configurar eventos e lembrar os triggers associados com o programa.';
$string['instructions:programassignments'] = 'Inscrever alunos em massa e configurar critério completo fixo ou relativo  <br />(Inscrever alunos por organização, posição, grupo, hierarquia ou individual)';
$string['instructions:programcontent'] = 'Definir o conteúdo do programa através das configurações dos cursos e/ou das competências';
$string['instructions:programdetails'] = 'Definir o nome do programa, a disponibilidade e a descrição';
$string['instructions:programexceptions'] = 'Resolver rapidamente as questões das tarefas ao selecionar o "tipo" e alicar uma "ação"';
$string['instructions:programmessages'] = 'Definir as mensagens do programa e os lembretes conforme solicitado';
$string['label:competencyname'] = 'Nome da competência';
$string['label:coursecreation'] = 'Quando criar um novo curso';
$string['label:learnermustcomplete'] = 'O aluno deve terminar';
$string['label:message'] = 'Mensagem';
$string['label:nextsetoperator'] = 'Próximo operador de configuração';
$string['label:noticeformanager'] = 'Notícia para o gerente';
$string['label:recurcreation'] = 'Criação do curso';
$string['label:recurrence'] = 'Periodicidade';
$string['label:sendnoticetomanager'] = 'Enviar notícia para o gerente';
$string['label:setname'] = 'Nome da configuração';
$string['label:subject'] = 'Título';
$string['label:timeallowance'] = 'Tempo permitido';
$string['label:trigger'] = 'Trigger';
$string['launchcourse'] = 'Início do curso';
$string['launchprogram'] = 'Início do programa';
$string['learnerenrolled'] = 'Aluno inscrito';
$string['learnerfollowup'] = 'Acompanhamento do aluno';
$string['learnerfollowupmessage_help'] = '# Mensagem de acompanhamento
Esta mensagem será enviada ao estudante em um período específico depois que o programa estiver concluído.';
$string['learnersassigned'] = '{$a->total} aluno(s) inscrito(s). {$a->assignments} aluno(s) ativo(s), {$a->exceptions} com exceções';
$string['learnersselected'] = 'alunos selecionados';
$string['learnerunenrolled'] = 'Cancelamento da matrícula do aluno';
$string['legend:courseset'] = 'Configuração do curso {$a}';
$string['legend:coursesetcompletedmessage'] = 'MENSAGEM DE TÉRMINO DA CONFIGURAÇÃO DO CURSO';
$string['legend:coursesetduemessage'] = 'MENSAGEM DE VENCIMENTO DA CONFIGURAÇÃO DO CURSO';
$string['legend:coursesetoverduemessage'] = 'MENSAGEM DE ATRASO DA CONFIGURAÇÃO DO CURSO';
$string['legend:enrolmentmessage'] = 'MENSAGEM DE INSCRIÇÃO';
$string['legend:exceptionreportmessage'] = 'MENSAGEM DO RELATÓRIO DE EXCEÇÃO';
$string['legend:extensionrequestmessage'] = 'MENSAGEM DA SOLICITAÇÃO DE PRORROGAÇÃO';
$string['legend:learnerfollowupmessage'] = 'MENSAGEM DE ACOMPANHAMENTO DO ALUNO';
$string['legend:programcompletedmessage'] = 'MENSAGEM DE TÉRMINO DO PROGRAMA';
$string['legend:programduemessage'] = 'MENSAGEM DE VENCIMENTO DO PROGRAMA';
$string['legend:programoverduemessage'] = 'MENSAGEM DE SUBSTITUIÇÃO DO PROGRAMA';
$string['legend:recurringcourseset'] = 'Configuração da periodicidade do curso';
$string['legend:unenrolmentmessage'] = 'MENSAGEM DE CANCELAMENTO DA INSCRIÇÃO';
$string['mainmessage_help'] = '# Corpo da mensagem
O corpo da mensagem será exibido para enviar mensagens aos destinatários em seu painel.
O corpo da mensagem poderá conter variáveis que serão substituídas quando a mensagem for enviada.';
$string['manageextensionrequests'] = 'Visualizar o relatório de exceção para conceder ou negar as solicitações de prorrogação';
$string['manageextensions'] = 'Gerenciar prorrogações';
$string['managementhierarchy'] = 'Hierarquia do gerenciamento';
$string['managermessage_help'] = '# Notícia para o gerente
Se a caixa de diálogo \'Enviar uma notícia para o gerente\' estiver marcada, junto com a mensagem de envio ao gerente poderá também ser enviada uma notificação a qual poderá ser especificada neste campo.
A notícia para o gerente pode conter variáveis que serão substituídas quando a mensagem for enviada.';
$string['managername'] = 'Gerenciar nomes';
$string['managers_category'] = 'gerenciamento do time';
$string['mandatory'] = 'Obrigatório';
$string['messages'] = 'Mensagens';
$string['messagesubject_help'] = '# Título da mensagem
O título da mensagem será exibido para os destinatários das mensagens em seu painel. Max 255 caracteres.
O título poderá conter variáveis as quais serão substituídas quando a mensagem for enviada.';
$string['missingshortname'] = 'Falta o nome curto';
$string['months'] = 'Meses';
$string['movedown'] = 'Mover para baixo';
$string['moveselectedprogramsto'] = 'Mover os programas selecionados para...';
$string['moveup'] = 'Mover para cima';
$string['multicourseset_help'] = '# Configuração dos cursos
Esta é uma configuração de cursos escolhidos individualmente a partir do catálogo do curso.
Você poderá definir o nome da configuração, seja o Aluno completando um ou todos os cursos e a permissão do tempo geral para completar a configuração.';
$string['nocourses'] = 'Sem cursos';
$string['noduedate'] = 'Nenhuma data de vencimento';
$string['noextensions'] = 'Você não possui equipe com solicitações de prorrogação pendentes';
$string['noprogramassignments'] = 'O programa não contém quaisquer tarefas';
$string['noprogramcontent'] = 'O programa não contém qualquer conteúdo';
$string['noprogramexceptions'] = 'Sem exceções';
$string['noprogrammessages'] = 'O programa não contém quaisquer mensagens';
$string['noprograms'] = 'Sem programas';
$string['noprogramsfound'] = 'Nenhum programa foi encontrado com as palavras \'{$a}\'';
$string['noprogramsyet'] = 'Sem programas nesta categoria';
$string['norequiredlearning'] = 'Sem aprendizado necessário';
$string['notavailable'] = 'Indisponível';
$string['notifymanager_help'] = '# Enviar notícia para o gerente
Marque nesta caixa de diálogo se você também desejar enviar uma notícia ao gerente destinatário da mensagem.';
$string['notmanager'] = 'Você não é gerente';
$string['nouserextensions'] = '{$a} não tem nenhuma solicitação de prorrogação pendente';
$string['novalidprograms'] = 'Sem programas válidos';
$string['numlearners'] = '# estudantes';
$string['of'] = 'de';
$string['ok'] = 'Ok';
$string['onecourse'] = 'Um curso';
$string['onecoursesfrom'] = 'um curso de';
$string['onedayremaining'] = 'Resta 1 dia';
$string['or'] = 'ou';
$string['organisationname'] = 'Nome da organização';
$string['organisations'] = 'Organizações';
$string['organisations_category'] = 'organização(ões)';
$string['orviewprograms'] = 'ou visualizar programas nesa categoria ({$a})';
$string['overrideandaddprogram'] = 'Substituir e adicionar programa';
$string['overview'] = 'Substituir';
$string['pendingextension'] = 'Você atualmente possui uma solicitação de prorrogação pendente';
$string['pleaseentervaliddate'] = 'Entre com uma data válida no formato {$a}.';
$string['pleaseentervalidreason'] = 'Entrar com uma razão válida';
$string['pleaseentervalidunit'] = 'Entre com uma unidade válida entre 0 e 999';
$string['pleasepickaninstance'] = 'Escolher um item';
$string['pleasesetcompletiontimes'] = 'Configurar tempo de término para todos os itens.';
$string['positions'] = 'Posições';
$string['positions_category'] = 'posição(ões)';
$string['positionsname'] = 'Nome das posições';
$string['positionstartdate'] = 'Data de início da posição';
$string['profilefielddate'] = 'Data do campo perfil';
$string['prog_courseset_completed_message'] = 'Mensagem completa da configuração do curso';
$string['prog_courseset_due_message'] = 'Mensagem de vencimento da configuração do curso';
$string['prog_courseset_overdue_message'] = 'Mensagem de atraso da configuração do curso';
$string['prog_enrolment_message'] = 'Mensagem de matrícula';
$string['prog_exception_report_message'] = 'Mensagem do relatório de exceção';
$string['prog_extension_request_message'] = 'Mensagem de solicitação de prorrogação';
$string['prog_learner_followup_message'] = 'Mensagem de acompanhamento do aluno';
$string['prog_program_completed_message'] = 'Mensagem completa do programa';
$string['prog_program_due_message'] = 'Mensagem de vencimento do programa';
$string['prog_program_overdue_message'] = 'Mensagem de atraso do programa';
$string['prog_unenrolment_message'] = 'Mensagem de cancelamento de inscrição';
$string['prognamelinkedicon'] = 'Nome do programa e ícone relacionado';
$string['program'] = 'Programa';
$string['program:accessanyprogram'] = 'Acessar qualquer programa';
$string['program:configureassignments'] = 'Configurar as tarefas do programa';
$string['program:configurecontent'] = 'Configurar o conteúdo do programa';
$string['program:configuremessages'] = 'Configurar as mensagens do programa';
$string['program:configureprogram'] = 'Configurar os programas';
$string['program:createprogram'] = 'Criar os programas';
$string['program:handleexceptions'] = 'Administrar as exceções do programa';
$string['program:manageextensions'] = 'Gerenciar prorrogações';
$string['program:viewhiddenprograms'] = 'Visualizar os programas ocultos';
$string['program:viewprogram'] = 'Visualizar programas';
$string['programassignments'] = 'Tarefas do programa';
$string['programassignmentssaved'] = 'As tarefas do programa foram salvadas com sucesso';
$string['programavailability_help'] = '# Disponibilidade do programa
Esta opção permite com que você "esconda" o seu programa completamente.
Ele não aparecerá em nenhuma lista de programa, exceto para os administradores.
Mesmo que os estudantes tentem acessar o programa diretamente pela URL, eles não terão permissão para acessar.
Se você configurar as datas \'Disponível a partir de\' e \'Disponível até\', os estudantes serão capazes de encontrar e entrar no programa durante o período especificado pelas datas, mas serão avisados do acesso fora destas datas.';
$string['programcategory_help'] = '# Categorias do programa/curso
Seu administrador Moodle pode ter configurado várias categorias de curso/programa.
Por exemplo, "Ciência", "Humanidades", "Saúde Pública" etc
Escolha o mais aplicável para o seu programa. Esta escolha afetará onde o seu programa for exibido na lista do programa e poderá tornar mais fácil para os estudantes encontrarem o seu programa.';
$string['programcompleted'] = 'Programa completo';
$string['programcompletedmessage_help'] = '# Mensagem de programa completo
Esta mensagem será enviada quando o programa estiver completo.';
$string['programcompletion'] = 'Término do programa';
$string['programcontent'] = 'Conteúdo do programa';
$string['programcontentsaved'] = 'Conteúdo do programa salvo com sucesso';
$string['programcreatefail'] = 'O programa não foi criado. Razão: "{$a}"';
$string['programcreatesuccess'] = 'Criação do programa com sucesso';
$string['programdeletefail'] = 'Não foi possível apagar o programa "{$a}"';
$string['programdeletesuccess'] = 'Programa apagado com sucesso "{$a}"';
$string['programdetails'] = 'Detalhes do programa';
$string['programdetailssaved'] = 'Detalhes do programa salvadas com sucesso';
$string['programdue'] = 'Vencimento do programa';
$string['programduedate'] = 'Prazo de vencimento do programa';
$string['programduemessage_help'] = '# Mensagem de vencimento do programa
Esta mensagem será enviada em período específico antes do vencimento do programa.';
$string['programends'] = 'Término do programa';
$string['programexceptions'] = 'Exceções do programa';
$string['programfullname_help'] = '# Nome completo do programa
O nome completo do programa será exibido no topo da tela e na lista do programa.';
$string['programicon'] = 'Ícone do programa';
$string['programid'] = 'Id do programa';
$string['programidnotfound'] = 'O programa não existe para o ID: {$a}';
$string['programidnumber'] = 'Número Id do programa';
$string['programidnumber_help'] = '# Número ID do Programa
O número ID é somente utilizado quando relacionar este curso em contrapartida aos sistemas externos - ele nunca é exibido dentro do Moodle. Se você tiver um nome de código oficial para este programa então use-o aqui... do contrário você poderá deixá-lo em branco.';
$string['programlive'] = 'Cuidado: O programa é ao vivo';
$string['programmandatory'] = 'Programa obrigatório';
$string['programmessages'] = 'Mensagens do programa';
$string['programmessagessaved'] = 'Mensagens salvadas do programa';
$string['programmessagessavedsuccessfully'] = 'Mensagens salvadas do programa com sucesso';
$string['programname'] = 'Nome do programa';
$string['programnotavailable'] = 'O programa não está disponível para estudantes';
$string['programnotcurrentlyavailable'] = 'Este programa não está atualmente disponível para estudantes';
$string['programnotlive'] = 'O programa não é ao vivo';
$string['programoverdue'] = 'Substituição do programa';
$string['programoverduemessage_help'] = '# Mensagem de programa vencido
Esta mensagem será enviada em um período específico depois que o programa estiver vencido.';
$string['programrecurring'] = 'Periodicidade do programa';
$string['programs'] = 'Programas';
$string['programscomplete'] = 'Programas completo';
$string['programshortname'] = 'Nome curto do programa';
$string['programshortname_help'] = '# Nome curto do programa
O nome curto do programa será utilizado em vários locais quando o nome completo não for apropriado (como na linha do título da mensagem de alerta).';
$string['programsinthiscategory'] = 'Programas nesta categoria ({$a})';
$string['programsmovedout'] = 'Os programas se mudaram de {$a}';
$string['programupdatecancelled'] = 'Atualização do programa cancelada';
$string['programupdatefail'] = 'Atualização do programa falhou';
$string['programupdatesuccess'] = 'Atualização do programa com sucesso';
$string['programvisibility_help'] = '# Visibilidade do programa
Se o programa estiver visível, ele aparecerá na lista do programa e na busca de resultados e os estudantes serão capazes de visualizar os conteúdos do programa.
Se o programa não estiver visível, ele não aparecerá na listagem do programa ou na busca de resultados, mas o programa ainda será exibido nos planejamentos de aprendizagem de quaisquer estudantes que estejam inscritos no programa e estes poderão ainda acessar o programa se conhecerem a URL deste.';
$string['progress'] = 'Progresso';
$string['reason'] = 'Razão da prorrogação';
$string['reasonforextension'] = 'Razão para a prorrogação';
$string['recurrence_help'] = '# Recorrência
Recorrência define o período de tempo quando o curso de recorrência deve ser repetido. A recorrência pode ser especificada pelo número de dias, semanas ou meses.';
$string['recurring'] = 'Repetindo';
$string['recurringcourse'] = 'Repetindo o curso';
$string['recurringcourse_help'] = '# Curso de recorrência
Exibe o curso de recorrência selecionado.
Somente um curso poderá ser escolhido para a recorrência. Para mudar o curso, selecione um novo curso a partir do menu suspenso e clique em "Mudar Curso" para salvar a mudança.';
$string['recurringcourseset_help'] = '# Configuração do curso de recorrência
A configuração do curso de recorrência somente permite a seleção de um único curso. Múltiplos cursos a partir das configurações do curso e as competências não poderão ser definidos.';
$string['recurringprogramhistory'] = 'Histórico de registro para repetição do programa {$a}';
$string['recurringprogramhistoryfor'] = 'Registro histórico para {$a->username} para programa de repetição {$a->progname}';
$string['recurringprograms'] = 'Repetindo os programas';
$string['repeatevery'] = 'Repetir a cada';
$string['requestextension'] = 'Solicitar uma prorrogação';
$string['requiredlearning'] = 'Aprendizagem necessária';
$string['requiredlearninginstructions'] = 'Seu aprendizado necessário é mostrado abaixo.';
$string['requiredlearninginstructionsuser'] = 'O aprendizado necessário de {$a} é mostrado abaixo.';
$string['returntoprogram'] = 'Retornar para o programa';
$string['rolprogramsourcename'] = 'Registro do Aprendizado: Programas';
$string['saveallchanges'] = 'Salvar todas as alterações';
$string['saveprogram'] = 'Salvar o programa';
$string['searchforindividual'] = 'Busca pelo indivíduo por nome ou ID';
$string['searchprograms'] = 'Buscar os programas';
$string['select'] = 'Selecionar';
$string['selectcompetency'] = 'Selecionar uma competência...';
$string['selectcourse'] = 'Selecionar um curso...';
$string['setcompletion'] = 'Término da configuração';
$string['setfixedcompletiondate'] = 'Configurar a data fixa de término';
$string['setlabel_help'] = '# Etiqueta de configuração do curso
Utilize a etiqueta de configuração do curso para descrever o agrupamento dos cursos dentro da configuração.
O objetivo é tornar cada configuração legível e ajudar os Alunos na compreensão do caminho do aprendizado. Por exemplo, a primeira configuração dos cursos deveria ser chamada "Fase Um - Indução" e a segunda configuração de cursos "Fase Dois - Saúde & Segurança".';
$string['setofcourses'] = 'Configuração dos cursos';
$string['setrealistictimeallowance'] = 'Configurar uma permissão de tempo realística';
$string['settimerelativetoevent'] = 'Configurar o tempo relacionado ao evento';
$string['shortname'] = 'Nome curto';
$string['showingresults'] = 'Mostrar resultados {$a->from} - {$a->to} de {$a->total}';
$string['source'] = 'Fonte';
$string['startdate'] = 'Data de início';
$string['status'] = 'Situação';
$string['successfullyresolvedexceptions'] = 'Exceções resolvidas com sucesso';
$string['summary'] = 'Sumário';
$string['then'] = 'em seguida';
$string['therearenoprogramstodisplay'] = 'Não há programas a serem exibidos.';
$string['thisactioncannotbeundone'] = 'Esta ação não poderá ser desfeita';
$string['thiswillaffect'] = 'Isto afetará os alunos {$a}';
$string['timeallowance'] = 'Permissão de tempo';
$string['timeallowance_help'] = '# Permissão de tempo
Configura a quantidade de tempo permitida para completar os cursos dentro da configuração. Isto é uma indicação geral do tempo transcorrido da configuração, não o tempo real que se leva para completar o curso. O tempo real para completar o curso poderá ser configurado no nível do curso.';
$string['toprogram'] = 'para programar';
$string['tosaveassignments'] = 'Para salvar todas as mudanças das tarefas, clique em \'Salvar todas as mudanças\'. Para editar as mudanças de tarefas, clique em \'Editar tarefas\'. As tarefas salvas não poderão ser desfeitas.';
$string['tosavecontent'] = 'Para salvar as mudanças de conteúdo clique \'Salvar todas as mudanças\'. Para editar as mudanças de conteúdo, clique em \'Editar conteúdo\'. Ao salvar as mudanças de conteúdo, estas não poderão ser desfeitas.';
$string['tosavemessages'] = 'Para salvar todas as mudanças das mensagens, clique em \'Salvar todas as mudanças\'. Para editar as mudanças das mensagens clique em \'Editar as mensagens\'. Ao salvar as mudanças das mensagens, estas não poderão ser desfeitas.';
$string['total'] = 'Total';
$string['totalassignments'] = 'Total de tarefas potenciais';
$string['totalassignments_help'] = '# Tarefas totais
O número total de tarefas que são exibidas na página de tarefas do programa e na página de visualização representa o número total de alunos em todas as categorias atribuídas e não ao número de alunos atualmente atribuídos no programa.
Se um aluno pertencer a uma organização que for atribuída ao programa e também mantiver uma posição que estiver atribuída ao programa, então o aluno será contado em cada categoria (mas será atribuído ao programa somente uma vez).';
$string['trigger_help'] = '# Trigger
O tempo do trigger determina quando a mensagem será enviada em relação ao evento descrito (ex. 4 semanas após o programa estiver completo).';
$string['type'] = 'Tipo';
$string['unenrolment'] = 'Cancelar inscrição';
$string['unenrolmentmessage_help'] = '# Mensagem de cancelamento da inscrição
Esta mensagem será enviada quando um usuário tiver cancelado sua inscrição do programa.';
$string['unknownexception'] = 'Exceção desconhecida';
$string['unknownusersrequiredlearning'] = 'Aprendizado Necessário do Usuário Desconhecido';
$string['unresolvedexceptions'] = '{$a} questões não solucionadas';
$string['untitledset'] = 'Configuração sem título';
$string['update'] = 'Atualizar';
$string['updateextensionfailall'] = 'Falha ao atualizar todas as prorrogações';
$string['updateextensionfailcount'] = 'Falha ao atualizar a prorrogação {$a}';
$string['updateextensions'] = 'Atualizar as Prorrogações';
$string['updateextensionsuccess'] = 'Todas as prorrogações atualizadas com sucesso';
$string['userid'] = 'ID do Usuário';
$string['variablesubstitution_help'] = '# Substituição da variável
Nas mensagens do programa, determinadas variáveis poderão ser isneridas no título e/ou corpo da mensagem de maneira que eles sejam substituídos com valores reais quando a mensagem for enviada. As variáveis deverão ser inseridas no texto exatamente conforme mostradas abaixo. As variáveis a seguir poderão ser utilizadas:
%programfullname%
: Isto será substituído pelo nome completo do programa
%setlabel%
: Isto será substituído pela etiqueta de configuração do curso (isto somente será substituído se a mensagem estiver relacionada a configuração do curso';
$string['viewallprograms'] = 'Visualizar todos os programas';
$string['viewallrequiredlearning'] = 'Visualizar todos';
$string['viewexceptions'] = 'Visualizar o relatório de exceção para resolver as questões.';
$string['viewinguserextrequests'] = 'Visualizar as solicitações de prorrogação para {$a}';
$string['viewingxusersprogram'] = 'Você está visualizando <a href="{$a->wwwroot}/user/view.php?id={$a->id}">{$a->fullname}\'s</a> o progresso neste programa.';
$string['viewprogram'] = 'Visualizar programa';
$string['viewprogramassignments'] = 'Visualizar as tarefas do programa';
$string['viewprogramdetails'] = 'Visualizar os detalhes do programa';
$string['viewrecurringprogramhistory'] = 'Visualizar histórico';
$string['visible'] = 'Visível';
$string['weeks'] = 'Semana(s)';
$string['xlearnerscurrentlyenrolled'] = 'Há {$a} alunos inscritos neste programa.';
$string['xsrequiredlearning'] = 'Aprendizado Necessário de {$a}';
$string['years'] = 'Ano(s)';
$string['youareviewingxsrequiredlearning'] = 'Você está visualizando <a href="{$a->site}/user/view.php?id={$a->userid}">{$a->name}\'s</a> aprendizado obrigatório.';
$string['youhaveadded'] = 'Você adicionou {$a->itemnames} para este programa<br />
<br />
<strong>Isto inscreverá {$a->affectedusers} usuários ao programa</strong><br />
<br />
Esta mudança será aplicada uma vez que o botão \'Salvar todas as mudanças\' seja clicado na tela principal das tarefas do programa';
$string['youhavemadefollowingchanges'] = 'Você realizou as mudanças a seguir neste programa';
$string['youhaveremoved'] = 'Você removeu {$a->itemname} deste programa<br />
<br />
<strong>Isto irá cancelar a inscrição {$a->affectedusers} dos usuários a partir do programa</strong><br />
<br />
Esta mudança será aplicada quando o botão \'Salvar todas as mudanças\' for clicado na tela principal de tarefas do programa';
$string['youhaveunsavedchanges'] = 'Você tem mudanças que não foram salvas.';
$string['youmustcompletebeforeproceedingtolearner'] = 'Você deve completar {$a->mustcomplete} antes de prosseguir em completar {$a->proceedto}';
$string['youmustcompletebeforeproceedingtomanager'] = 'complete {$a->mustcomplete} antes de prosseguir em completar {$a->proceedto}';
$string['youmustcompletebeforeproceedingtoviewing'] = 'Um aluno deve completar {$a->mustcomplete} antes de prosseguir em completar {$a->proceedto}';
$string['youmustcompleteorlearner'] = 'Você deve completar {$a}';
$string['youmustcompleteormanager'] = 'deve terminar {$a}';
$string['youmustcompleteorviewing'] = 'O estudante deve terminar {$a}';
$string['z:incompleterecurringprogrammessage'] = 'O curso em um programa repetido que esteja inscrito chegou ao seu término, mas você não concluiu o curso. Este curso deve ser concluído a fim de atingir as exigências do programa.';
$string['z:incompleterecurringprogramsubject'] = 'Curso repetido incompleto';
