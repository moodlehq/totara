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
 * Strings for component 'feedback', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   feedback
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add_item'] = 'Adicionar pergunta a atividade';
$string['add_items'] = 'Adicionar pergunta a atividade';
$string['add_pagebreak'] = 'Adicionar uma quebra de página';
$string['adjustment'] = 'Ajuste';
$string['after_submit'] = 'Após submissão';
$string['allowfullanonymous'] = 'Permitir anônimo';
$string['analysis'] = 'Análise';
$string['anonymous'] = 'Anônimo';
$string['anonymous_edit'] = 'Gravar nomes de usuários';
$string['anonymous_entries'] = 'Entradas anônimas';
$string['anonymous_user'] = 'Usuário anônimo';
$string['append_new_items'] = 'Juntar novos itens';
$string['autonumbering'] = 'Números automáticos';
$string['autonumbering_help'] = 'Permitir ou inibir números automáticos em cada questão';
$string['average'] = 'Média';
$string['bold'] = 'Negrito';
$string['cancel_moving'] = 'Cancelar movimento';
$string['cannotmapfeedback'] = 'Problema no banco de dados, incapaz de mapear o gabarito para o curso';
$string['cannotsavetempl'] = 'Não é mermitido salvar modelos';
$string['cannotunmap'] = 'Problema da base de dados. Não é possível desmapear.';
$string['captcha'] = 'Captcha';
$string['captchanotset'] = 'Captcha não está configurado';
$string['check'] = 'Múltipla escolha - múltiplas respostas';
$string['check_values'] = 'Possíveis respostas';
$string['checkbox'] = 'Múltipla escolha - permite múltiplas respostas (check boxes)';
$string['choosefile'] = 'Escolha um arquivo';
$string['chosen_feedback_response'] = 'Escolha a resposta';
$string['complete_the_form'] = 'Responda as questões';
$string['completed'] = 'terminado';
$string['completed_feedbacks'] = 'Respostas submetidas';
$string['completionsubmit'] = 'Ver como completada se as respostas foram submetidas';
$string['configallowfullanonymous'] = 'Se esta opção for \'sim\' então a pesquisa poderá ser completada sem precisar de autenticação. Isso afeta apenas as pesquisas na página inicial.';
$string['confirmdeleteentry'] = 'Você tem a certeza que deseja apagar esta entrada?';
$string['confirmdeleteitem'] = 'Você tem a certeza que deseja apagar este elemento?';
$string['confirmdeletetemplate'] = 'Você tem certeza que deseja excluir este template?';
$string['confirmusetemplate'] = 'Você tem certeza que deseja utilizar este template?';
$string['continue_the_form'] = 'Continue o foemulário';
$string['count_of_nums'] = 'Contagem de números';
$string['courseid'] = 'ID do curso';
$string['creating_templates'] = 'Salvar estas perguntas em um novo template';
$string['delete_entry'] = 'Apagar entrada';
$string['delete_item'] = 'Excluir questão';
$string['delete_old_items'] = 'Apagar todos os itens';
$string['delete_template'] = 'Excluir template';
$string['delete_templates'] = 'Excluir template...';
$string['depending'] = 'Itens dependentes';
$string['depending_help'] = 'Itens dependentes possibilitam mostrar itens que dependendem de valores de outros itens.
**Aque está um exemplo:**
* Inicialmente crie um item do qual outros itens dependem de um valor.
* Na sequência, adicione uma nova página..
* Na sequencia adicione o item dependente do valor apresentado no iem anterior.
* Escolha \'Item dependente\' no formulário de criação de um item e indique o valor na caixa de texto.

**A estrutura deve ser como a seguir:**
1. Item pergunta: Você tem um carro? Resposta: sim/não
2. Quebra de páginak
3. Item pergunta: Qual é a cor de seu carro?
(este item depende da resposta \'sim\' ao item 1)
4. Item perguna: Por que você não tem um carro?
(este item depende da resposta \'não ao item 1)
5. ...outros itens
Somente isto. Divirta-se';
$string['dependitem'] = 'Item dependente';
$string['dependvalue'] = 'Vapor dependente';
$string['description'] = 'Descrição';
$string['do_not_analyse_empty_submits'] = 'Não analisar submissões vazias';
$string['drop_feedback'] = 'Remover deste curso';
$string['dropdown'] = 'Múltipla escolha - resposta única (\'dropdown list\')';
$string['dropdown_values'] = 'Respostas';
$string['dropdownlist'] = 'Múltipla escolha - resposta única (\'dropdown\')';
$string['dropdownrated'] = 'Lista dropdown (rateada)';
$string['edit_item'] = 'Editar questão';
$string['edit_items'] = 'Editar questões';
$string['email_notification'] = 'Enviar notificação por e-mail';
$string['emailnotification'] = 'Notificação por e-mail';
$string['emailnotification_help'] = 'Se ativado, os administradores receberão notificações de submissões';
$string['emailteachermail'] = '{$a->username} respondeu a atividade: \'{$a->feedback}\'

Você pode vê-la aqui:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->username} respondeu a atividade: <i>\'{$a->feedback}\'</i><br /><br />
Você pode vê-la aqui: <a href="{$a->url}">here</a>.';
$string['entries_saved'] = 'Suas respostas foram gravadas. Obrigado';
$string['export_questions'] = 'Exportar perguntas';
$string['export_to_excel'] = 'Exportar para o Excel';
$string['feedback:complete'] = 'Completar a pesquisa';
$string['feedback:createprivatetemplate'] = 'Criar um modelo privado';
$string['feedback:createpublictemplate'] = 'Criar um modelo público';
$string['feedback:deletesubmissions'] = 'Apagar submissões completadas';
$string['feedback:deletetemplate'] = 'Excluir template';
$string['feedback:edititems'] = 'Editar itens';
$string['feedback:mapcourse'] = 'Mapear cursos para pesquisas globais';
$string['feedback:receivemail'] = 'Receber um email de notificação';
$string['feedback:view'] = 'Ver uma pesquisa';
$string['feedback:viewanalysepage'] = 'Ver a página de análise após a submissão';
$string['feedback:viewreports'] = 'Ver ralatórios';
$string['feedback_is_not_for_anonymous'] = 'A pesquisa não é para anônimos';
$string['feedback_is_not_open'] = 'A pesquisa não está aberta';
$string['feedback_options'] = 'Opções de pesquisa';
$string['feedbackclose'] = 'Fechar a pesquisa em';
$string['feedbackcloses'] = 'Feedback fecha';
$string['feedbackopen'] = 'Abrir a pesquisa em';
$string['feedbackopens'] = 'Feedback abre';
$string['file'] = 'Arquivo';
$string['filter_by_course'] = 'Filtrar por curso';
$string['handling_error'] = 'Ocorreu erro na ação de processar o módulo de pesquisa';
$string['hide_no_select_option'] = 'Esconder a opção \'Não selecionado\'';
$string['horizontal'] = 'horizontal';
$string['import_questions'] = 'Importar questões';
$string['import_successfully'] = 'Importação bem sucedida';
$string['importfromthisfile'] = 'Importar a partir do arquivo';
$string['info'] = 'Informação';
$string['infotype'] = 'Tipo de informação';
$string['insufficient_responses'] = 'Respostas insuficientes';
$string['insufficient_responses_for_this_group'] = 'Há respostas insuficientes para este grupo';
$string['insufficient_responses_help'] = 'Há respostas insuficientes para este grupo.
Para manter a pesquisa anônima precisam-se, ao menos, duas respostas.';
$string['item_label'] = 'Rótulo';
$string['item_name'] = 'Questão';
$string['items_are_required'] = 'As questões com asterísco (*) exigem resposta.';
$string['label'] = 'Rótulo';
$string['line_values'] = 'Avaliação';
$string['mapcourse'] = 'Mapear pesquisas para os cursos';
$string['mapcourse_help'] = 'Por padrão, os formulários de pesquisa criados em sua página inicial estão disponíveis em todo o site e estarão disponíveis em todos os cursos usando o bloco de comentários. Você pode forçar a disponibilização do formulário de pesquisa, tornando-a um bloco aderente ou limitar os cursos em que um formulário será exibido pelo mapeamento para cursos específicos.';
$string['mapcourseinfo'] = 'Esta é uma pesquisa no nível do site que está disponível para todos os cursos usando o bloco de comentários. No entanto,você pode mapear os cursos disponíveis para mapeá-los. Localize o curso e mapei-o para esta pesquisa.';
$string['mapcoursenone'] = 'Nenhum curso foi mapeado. A pesquisa estará disponível a todos os cursos.';
$string['mapcourses'] = 'Mapear pesquisa para os cursos';
$string['mapcourses_help'] = 'Após ter selecionado o(s) curso(s) relevante(s) para a pesquisa, você pode associá-lo(s) com usando este mapa de curso(s). Vários cursos podem ser selecionados mantendo pressionada a tecla Ctrl (ou Apple, no Mac) e clicando nos nomes dos cursos. Um curso pode ser dissociada de uma pesquisa a qualquer momento.';
$string['mappedcourses'] = 'Cursos mapeados';
$string['max_args_exceeded'] = 'Máximo 6 argumentos podem ser manipulados, muitos argumentos para';
$string['maximal'] = 'máximo';
$string['messageprovider:message'] = 'Lembrete de feedback';
$string['messageprovider:submission'] = 'Notificações de pesquisa';
$string['mode'] = 'Modo';
$string['modulename'] = 'Pesquisa';
$string['modulename_help'] = 'Os módulos de pesquisa possibilitam a criação de inquéritos (\'survey\') personalizados';
$string['modulenameplural'] = 'Pesquisa';
$string['move_here'] = 'Mover aqui';
$string['move_item'] = 'Mover esta questão';
$string['movedown_item'] = 'Mover a questão para baixo';
$string['moveup_item'] = 'Mover esta questão para cima';
$string['multichoice'] = 'Múltipla escolha';
$string['multichoice_values'] = 'Valores de múltipla escolha';
$string['multichoicerated'] = 'Múltiplas escolhas (rateadas)';
$string['multichoicetype'] = 'Tipos de múltipla escolha';
$string['multiple_submit'] = 'Múltiplas submissões';
$string['multiplesubmit'] = 'Múltiplas submissões';
$string['multiplesubmit_help'] = 'Se for possível a pesquisa para anônimos, os usuários poderão submetê-las ilimitadas vezes.';
$string['name'] = 'Nome';
$string['name_required'] = 'O nome é exigido';
$string['next_page'] = 'Próxima página';
$string['no_handler'] = 'Nenhuma ação de manipulação para';
$string['no_itemlabel'] = 'Sem rótulo';
$string['no_itemname'] = 'Sem nome do item';
$string['no_items_available_yet'] = 'Nenhuma pergunta foi ainda configurada';
$string['no_templates_available_yet'] = 'Nenhum modelo já está disponível';
$string['non_anonymous'] = 'O nome do usuário será registrado e mostrado com as respostas';
$string['non_anonymous_entries'] = 'entradas não anônimas';
$string['non_respondents_students'] = 'estudantes não respondentes';
$string['not_completed_yet'] = 'Ainda não foi completada';
$string['not_selected'] = 'Não selecionado';
$string['not_started'] = 'não iniciado';
$string['notavailable'] = 'esta pesquisa não está disponível';
$string['numeric'] = 'Resposta numérica';
$string['numeric_range_from'] = 'Valor de';
$string['numeric_range_to'] = 'Valor até';
$string['of'] = 'de';
$string['oldvaluespreserved'] = 'Todas as perguntas antigas e valores atribuídos serão preservados';
$string['oldvalueswillbedeleted'] = 'As questões atuais e todas as respectivas respostas do usuário serão excluídas';
$string['only_one_captcha_allowed'] = 'Apenas um \'captcha\' é permitido em uma pesquisa';
$string['overview'] = 'Visão geral';
$string['page'] = 'Página';
$string['page-mod-feedback-x'] = 'Qualquer página de modulo de feedback';
$string['page_after_submit'] = 'Página após submissão';
$string['pagebreak'] = 'Quebra de página';
$string['parameters_missing'] = 'Parâmetros em falta';
$string['picture'] = 'Figura';
$string['picture_file_list'] = 'Lista de figuras';
$string['picture_values'] = 'Escolha uma ou mais<br />figuras na lista de arquivos:';
$string['pluginadministration'] = 'Administração da pesquisa';
$string['pluginname'] = 'Pesquisa';
$string['position'] = 'Posição';
$string['preview'] = 'Previsão';
$string['preview_help'] = 'Na previsão você pode alterar a ordem das perguntas.';
$string['previous_page'] = 'Página anterior';
$string['public'] = 'Público';
$string['question'] = 'Questão';
$string['questions'] = 'Questões';
$string['radio'] = 'Múltipla escolha - resposta única';
$string['radio_values'] = 'Respostas';
$string['radiobutton'] = 'Múltipla escolha - resposta única (botões rádio)';
$string['radiobutton_rated'] = 'Radiobutton (nominal)';
$string['radiorated'] = 'Botão rádio (rateado)';
$string['ready_feedbacks'] = 'Feedbacks prontos';
$string['relateditemsdeleted'] = 'Todos as respostas de seus usuários para esta pergunta também serão apagadas.';
$string['required'] = 'Exigido';
$string['resetting_data'] = 'Reset das respostas da pesquisa';
$string['resetting_feedbacks'] = 'Ressetando pesquisas';
$string['response_nr'] = 'Resposta numérica';
$string['responses'] = 'Respostas';
$string['responsetime'] = 'Tempo de resposta';
$string['save_as_new_item'] = 'Salvar como nova questão';
$string['save_as_new_template'] = 'Salvar como novo template';
$string['save_entries'] = 'Submeter as suas respostas';
$string['save_item'] = 'Salvar questão';
$string['saving_failed'] = 'Falha ao salvar';
$string['saving_failed_because_missing_or_false_values'] = 'Falha ao tentar salvar devido a valores não informados ou incorretos';
$string['search_course'] = 'Buscar curso';
$string['searchcourses'] = 'Buscar cursos';
$string['searchcourses_help'] = 'Procure pelo(s) código(s) ou nome(s) do(s) curso(s) que você deseja associar a esta pesquisa.';
$string['selected_dump'] = 'Os índices selecionados da variável $SESSION estão mostrados abaixo:';
$string['send'] = 'enviar';
$string['send_message'] = 'enviar mansagem';
$string['separator_decimal'] = ',';
$string['separator_thousand'] = '.';
$string['show_all'] = 'Mostrar tudo';
$string['show_analysepage_after_submit'] = 'Mostrar a página de análise após a submissão';
$string['show_entries'] = 'Mostrar respostas';
$string['show_entry'] = 'Mostrar resposta';
$string['show_nonrespondents'] = 'Mostrar não respondentes';
$string['site_after_submit'] = 'Site após submissão';
$string['sort_by_course'] = 'Ordenar por curso';
$string['start'] = 'Início';
$string['started'] = 'iniciado';
$string['stop'] = 'Fim';
$string['subject'] = 'Assunto';
$string['switch_group'] = 'Comutar grupo';
$string['switch_item_to_not_required'] = 'Comutar para: resposta não exigida';
$string['switch_item_to_required'] = 'Comutar para: resposta exigida';
$string['template'] = 'Modelo';
$string['template_saved'] = 'Modelo gravado';
$string['templates'] = 'Modelos';
$string['textarea'] = 'Resposta de texto longo';
$string['textarea_height'] = 'Número de linhas';
$string['textarea_width'] = 'Largura';
$string['textfield'] = 'resposta de texto curto';
$string['textfield_maxlength'] = 'Caracteres máximos aceitos';
$string['textfield_size'] = 'largura do campo de exto';
$string['there_are_no_settings_for_recaptcha'] = 'O \'captcha\' não foi configurado';
$string['this_feedback_is_already_submitted'] = 'Você já terminou esta atividade.';
$string['timeclose'] = 'Tempo para fechar';
$string['timeclose_help'] = 'Você pode especificar períodos nos quais a pesquisa é acessível para resposta às perguntas. Se a caixa não estiver marcada, não haverá limite definido.';
$string['timeopen'] = 'tempo para abrir';
$string['timeopen_help'] = 'Você pode especificar períodos nos quais a pesquisa é acessível para resposta às perguntas. Se a caixa não estiver marcada, não haverá limite definido.';
$string['typemissing'] = 'valor \'tipo\' perdido';
$string['update_item'] = 'Gravar modificações da pergunta';
$string['url_for_continue'] = 'URL para o botão \'continuar\'';
$string['url_for_continue_button'] = 'URL para o botão \'continuar\'';
$string['url_for_continue_help'] = 'Por padrão, após uma pesquisa ter sido submetida o objetivo do botão \'continuar\' é a página do curso. Aqui você pode definir uma outra URL de destino para esse botão.';
$string['use_one_line_for_each_value'] = '<br/>Use uma linha para cada resposta!';
$string['use_this_template'] = 'Utilizar este template';
$string['using_templates'] = 'Utilizar um template';
$string['vertical'] = 'vertical';
$string['viewcompleted'] = 'pesquisas completas';
$string['viewcompleted_help'] = 'Você pode ver formulários de completo de pesquisa, pesquisáveis por curso e / ou por pergunta.
As respostas podem ser exportadas para o Excel.';
