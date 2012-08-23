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
 * Strings for component 'hotpot', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   hotpot
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['abandoned'] = 'Abandonada';
$string['activitycloses'] = 'Fecha atividade';
$string['activitygrade'] = 'Nota da atividade';
$string['activityopens'] = 'Abre atividade';
$string['added'] = 'Adicionado';
$string['addquizchain'] = 'Acrescentar série de atividades';
$string['addquizchain_help'] = 'Todas as questões em um conjunto ou cadeia de questões/testes devem ser adicionados?

**Não**
: Apenas uma questão será adicionada ao curso

**Sim**
: Se o arquivo-fonte é um arquivo de **Questões**, ele é tratado como o início de uma conjunto de questões e todos as questões da cadeia serão adicionadas ao curso com configurações idênticas. Cada questão deve ter um link para o arquivo seguinte na cadeia.

Se o arquivo de origem é uma **pasta**, todas as questões reconhecíveis na pasta serão adicionadas ao curso para formar uma cadeia de questões com especificações idênticas.

Se o arquivo de origem é um **arquivo unitário**, como um arquivo externo de Hot Potatoes ou index.html, questões contidas no arquivo serão adicionadas ao curso como uma cadeia de questões com configurações idênticas.';
$string['allowreview'] = 'Permitir revisão';
$string['allowreview_help'] = 'Se habilitado, os alunos poderão revisar suas tentativas de quiz depois do quiz estar fechado.';
$string['analysisreport'] = 'Análise do item';
$string['attemptlimit'] = 'Limite de tentativas';
$string['attemptlimit_help'] = 'O número máximo de tentativas que um estudante pode ter nesta atividade HotPot';
$string['attemptnumber'] = 'Número de tentativas';
$string['attempts'] = 'Tentativas';
$string['attemptscore'] = 'Pontuação da tentativa';
$string['attemptsunlimited'] = 'Tentativas ilimitadas';
$string['average'] = 'Média';
$string['averagescore'] = 'Pontuação média';
$string['cacherecords'] = 'Registros do cache do HotPot';
$string['canrestartquiz'] = 'Seus resultados até agora serão salvos e você pode refazer "{$a}" mais tarde';
$string['canrestartunit'] = 'Seus resultados até agora serão salvos, mas se você quiser refazer essa atividade novamente mais tarde, você terá que começar desde o início.';
$string['canresumequiz'] = 'Seus resultados serão salvos até aqui e você poderá continuar "{$a}" mais tarde';
$string['checks'] = 'Controles';
$string['checksomeboxes'] = 'Por favor marque algumas caixas';
$string['clearcache'] = 'Limpar cache HotPot';
$string['cleardetails'] = 'Limpar detalhes HotPot';
$string['clearedcache'] = 'O cache Hotpotatoes foi limpo';
$string['cleareddetails'] = 'Os detalhes Hotpotatoes foram limpos';
$string['clickreporting'] = 'Habilitar relatório de clicks';
$string['clickreporting_help'] = 'Se habilitado, um registro separado é mantido cada vez que uma "dica", "pista" ou botão "Verificação" é clicado. Isso permite que o professor tenha um relatório detalhado do estado do questionário a cada clique. Caso contrário, apenas um registro por tentativa na questão é mantido.';
$string['clicktrailreport'] = 'Trilha de cliques';
$string['closed'] = 'Esta atividade foi fechada';
$string['clues'] = 'Indícios';
$string['completed'] = 'Completado';
$string['configenablecache'] = 'Manter um cache dos questionários do HotPot pode acelerar drasticamente a entrega de questionários aos alunos.';
$string['configenablecron'] = 'Especificar as horas no seu fuso-horário nas quais o script cron do HotPotatoes deve executar';
$string['configenablemymoodle'] = 'Esta configuração controla se os HotPots são listados no MyMoodle ou não';
$string['configenableobfuscate'] = 'Esconder o código javascript para inserir players de mídia torna mais difícil determinar o nome do arquivo de mídia e descobrir o que o arquivo contém.';
$string['configenableswf'] = 'Permitir a incorporação de arquivos SWF em atividades Hotpot. Se ativada, esta definição substitui filter_mediaplugin_enable_swf.';
$string['configfile'] = 'Arquivo de configuração';
$string['configframeheight'] = 'Quando um teste é exibido dentro de um frame, este valor é a altura (em pixels) do quadro superior, que contém a barra de navegação do Moodle .';
$string['configlocation'] = 'Localização do arquivo de configuração';
$string['configlockframe'] = 'Caso esta configuração esteja habilitada, então o frame de navegação, caso utilizado, será bloqueado impedindo a utilização da barra de rolagem, redimensionando e não terá borda.';
$string['configmaxeventlength'] = 'Se um HotPot tem uma data especificada  tanto para ser aberto quanto para ser fechado, e a diferença entre as duas datas  é maior do que o número de dias aqui especificado, então serão adicionados dois eventos separados ao calendário do curso. Para períodos mais curtos, ou quando apenas um momento for especificado, apenas um evento do calendário será adicionado. Se não houver qualquer especificação de tempo, nenhum evento será adicionado ao calendário.';
$string['configstoredetails'] = 'Se essa configuração estiver ativada, então o código XML  dos detalhes  de tentativas feitas nos questionários de HotPot serão armazenados na tabela hotpot_details. Isto permite que as tentativas dos questionários sejam reclassificadas no futuro para refletir as mudanças no sistema de pontuação do questionário HotPot. No entanto, ativar esta opção em um ambiente muito utilizado fará com que a tabela hotpot_details cresça muito rapidamente.';
$string['confirmdeleteattempts'] = 'Deseja realmente excluir estas tentativas?';
$string['confirmstop'] = 'Tem certeza que deseja navegar para fora desta página?';
$string['correct'] = 'Certo';
$string['couldnotinsertsubmissionform'] = 'Não foi possível inserir formulário de submissão';
$string['delay1'] = 'Atraso 1';
$string['delay1_help'] = 'Intervalo mínimo entre a primeira e segunda tentativa.';
$string['delay1summary'] = 'Espaço de tempo entre primeira e segunda tentativas';
$string['delay2'] = 'Atraso 2';
$string['delay2_help'] = 'Intervalo mínimo entre tentativas depois da segunda tentativa.';
$string['delay2summary'] = 'Espaço de tempo entre últimas tentativas';
$string['delay3'] = 'Atraso 3';
$string['delay3afterok'] = 'Esperar até os estudantes clicarem em OK';
$string['delay3disable'] = 'Não continuar automaticamente';
$string['delay3_help'] = 'Esta configuração especifica o tempo decorrido entre o término do questionário e o retorno do controle da tela para o Moodle.

**Usar tempo específico (em segundos) **
: O controle será devolvido ao Moodle após o número especificado de segundos.

**Usar as configurações de fonte / modelo de arquivo**
: O controle será devolvido ao Moodle após o número de segundos especificado no arquivo de origem ou nos arquivos de modelo para esse formato de saída.

**Espere até o aluno clicar em OK **
: O controle será devolvido ao Moodle após o aluno clicar no botão OK na mensagem de conclusão do questionário.

**Não continuar automaticamente**
: O controle não será devolvido ao Moodle após o teste ser concluído. O estudante estará livre para navegar para fora da página de teste.

Nota: os resultados do questionário retornam sempre para  Moodle tão logo o questionário é preenchido ou abandonado, independentemente dessa configuração.';
$string['delay3specific'] = 'Utilize tempo específico (em segundos)';
$string['delay3summary'] = 'Espaço de tempo ao final da quiz';
$string['delay3template'] = 'Usar configurações em arquivo fonte/modelo';
$string['deleteallattempts'] = 'Apagar todas as tentativas';
$string['deleteattempts'] = 'Tentativas de deleção';
$string['detailsrecords'] = 'Registro de detalhes Hotpotatoes';
$string['d_index'] = 'Índice de discriminação';
$string['duration'] = 'Duração';
$string['enablecache'] = 'Habilita chache Hotpotatoes';
$string['enablecron'] = 'Habilita cron Hotpotatoes';
$string['enablemymoodle'] = 'Exibe HotPot no meu moodle';
$string['enableobfuscate'] = 'Habilitar ofuscação do código do reprodutor de media';
$string['enableswf'] = 'Permitir incorporar arquivos SWF em atividades Hotpotatoes';
$string['entry_attempts'] = 'Tentativas';
$string['entrycm'] = 'Atividades prévias';
$string['entrycmcourse'] = 'Atividade prévia neste curso';
$string['entrycm_help'] = 'Esta configuração especifica uma atividade Moodle e uma classificação mínima para esta atividade a qual deve ser completada antes que este Quizport possa ser iniciado.

O professor pode selecionar uma atividade específica, ou uma das seguintes configurações de uso geral:

* Atividade prévia neste curso
* Atividade prévia nesta seção
* HotPot anterior neste curso
* HotPot anterior nesta seção';
$string['entrycmsection'] = 'Atividade prévia nesta seção de curso';
$string['entrycompletionwarning'] = 'Antes de iniciar esta atividade, você precisa olha o {$a}.';
$string['entry_dates'] = 'Datas';
$string['entrygrade'] = 'Nota da atividade anterior';
$string['entrygradewarning'] = 'Você não pode iniciar esta atividade até que atinja a marca de {$a->entrygrade}% em {$a->entryactivity}. Atualmente seu aproveitamento para aquela atividade é de {$a->usergrade}%';
$string['entry_grading'] = 'Nota';
$string['entryhotpotcourse'] = 'Atividade Hotpotatoes anterior neste curso';
$string['entryhotpotsection'] = 'Atividade Hotpotatoes anterior nesta seção de curso';
$string['entryoptions'] = 'Opções de item de página';
$string['entryoptions_help'] = 'Estas caixas de seleção permitem habilitar e desbilitar a exibição de itens na página inicial do HotPots.

**Nome da Unidade como título**
: Se marcado, o nome da unidade será exibido como o título da página de entrada.

**Classificando**
: Se marcado, a informação de classificação do HotPots será exibida na página de entrada.

**Datas**
: Se marcado, datas de abertura e fechamento do Hotpots serão exibidas na página de entrada.

**Tentativas**
: Se marcado, uma tabela com detalhes de tentativas anteriores de um usuário neste HotPot será exibida na página de entrada. As tentativas que podem ser retomadas terão um botão “Retomar” exibido na coluna da direita.';
$string['entrypage'] = 'Exibir página inicial';
$string['entrypagehdr'] = 'Página inicial';
$string['entrypage_help'] = 'Os estudantes devem visualizar uma página inicial antes de iniciar a atividade HotPot?

**Sim**
: Os estudantes receberão uma página de entrada antes de iniciar o HotPot. O conteúdo da página de entrada é determinado pela opções do Hotpot para criação da página de entrada.

**Não **
: Os alunos não verão uma página de entrada, e o HotPot iniciará imediatamente.

Nota: uma página de entrada é sempre apresentada para o professor, a fim de fornecer acesso aos relatórios e editar a página de questionários.';
$string['entrytext'] = 'Texto da página inicial';
$string['entry_title'] = 'Nome de unidade como título';
$string['exit_areyouok'] = 'Olá, você está ainda aqui ?';
$string['exit_attemptscore'] = 'Seu aproveitamento para aquela tentativa foi {$a}';
$string['exitcm'] = 'Próxima atividade';
$string['exitcmcourse'] = 'Próxima atividade neste curso';
$string['exitcm_help'] = 'Esta configuração especifica uma atividade Moodle para ser feita após a conclusão deste questionário.

O professor pode selecionar uma atividade específica, ou uma das seguintes configurações de uso geral:

* Próxima atividade neste curso
* Próxima atividade nesta seção
* HotPot seguinte neste curso
* Próximo HotPot  nesta seção

Se outras opções de saída de página estiverem desativadas, o aluno irá direto para a próxima atividade. Caso contrário, será mostrado ao aluno um link para levá-lo para a atividade seguinte, quando ele estiver pronto.';
$string['exitcmsection'] = 'Próxima atividade nesta seção de curso';
$string['exit_course'] = 'Curso';
$string['exit_course_text'] = 'Retornar à página principal do curso';
$string['exit_encouragement'] = 'encorajamento';
$string['exit_excellent'] = 'Excelente!';
$string['exit_feedback'] = 'Sair da página de feedback';
$string['exit_feedback_help'] = 'Estas opções permitem habilitr e desabilitar a exibição de itens de comentários na página de saída de um HotPot.

 **Nome da unidade como título**
: Se marcado, o nome da unidade será exibido como o título da página de saída.

 **Incentivo**
: Se marcado, algum comentário de incentivo será exibido na página de saída. O incentivo dependerá do grau alcançado no HotPot:
: **> 90% **: Excelente!
: **%> 60%**: Muito Bom!
: **%> 0%**: Boa tentativa
: ** = 0%**: Você está bem?

**Pontuação da tentativa para a unidade**
: Se marcado, a nota para a tentativa da unidade que acaba de ser concluída será exibida na página de saída.

**Nota da Unidade **
: Se marcado a nota obtida no HotPot será exibido na página de saída.

Além disso, se o método de classificação da unidade for a nota mais elevada, será emitida uma mensagem para informar ao estudante se a tentativa mais recente foi igual ou melhor do que a sua anterior.';
$string['exit_goodtry'] = 'Boa Tentativa!';
$string['exitgrade'] = 'Pontuação da próxima atividade';
$string['exit_grades'] = 'Notas';
$string['exit_grades_text'] = 'Veja suas notas nesse curso até agora';
$string['exithotpotcourse'] = 'Próximo HotPot neste curso';
$string['exit_hotpotgrade'] = 'Sua nota para esta atividade é {$a}';
$string['exit_hotpotgrade_average'] = 'Sua nota média até agora para esta atividade é {$a}';
$string['exit_hotpotgrade_highest'] = 'Sua nota mais alta até agora para esta atividade é {$a}';
$string['exit_hotpotgrade_highest_equal'] = 'Você igualou sua melhor tentativa anterior para esta atividade!';
$string['exit_hotpotgrade_highest_previous'] = 'Sua maior nota anterior para esta atividade é {$a}';
$string['exit_hotpotgrade_highest_zero'] = 'Você não marcou mais que {$a} nesta atividade ainda';
$string['exithotpotsection'] = 'Próximo HotPot nesta seção de curso';
$string['exit_index'] = 'Índice';
$string['exit_index_text'] = 'Ir para o índice das atividades';
$string['exit_links'] = 'Sair da página de links';
$string['exit_links_help'] = 'Estas opções ativam e desativam a exibição de certos links de navegação na página de saída de um HotPot .

 ** Repetir** : Se forem permitidas tentativas múltiplas neste HotPot e o estudante ainda tem algumas tentativas restantes, um link para permitir que o aluno repita o HotPot será exibido

 ** Índice ** : Se marcado, um link para a página de índice do HotPot será exibido.

 ** Curso ** : Se marcado, um link para a página do curso do Moodle será exibido.

 ** Notas **  : Se marcado, um link para o livro de notas do Moodle será exibido.';
$string['exit_next'] = 'Próximo';
$string['exit_next_text'] = 'Tentar a próxima tentativa';
$string['exit_noscore'] = 'Você completou com sucesso esta atividade!';
$string['exitoptions'] = 'opções da página de saída';
$string['exitpage'] = 'Exibir página de saída';
$string['exitpagehdr'] = 'Página de saída';
$string['exitpage_help'] = 'Deverá ser exibida uma página de saída após o teste HotPot ser concluído?

** Sim ** : Os alunos receberão uma página de saída quando o HotPot for concluído. O conteúdo da página de saída será determinado pelas configurações de retorno e links da página de saída do HotPot.
** Não ** : Não será exibida uma página de saída para os alunos. Em vez disso, eles poderão seguir imediatamente para a próxima atividade ou retornar à página do curso Moodle.';
$string['exit_retry'] = 'Tentar novamente';
$string['exit_retry_text'] = 'Tentar novamente esta atividade';
$string['exittext'] = 'Texto de saída da página';
$string['exit_welldone'] = 'Muito bom !';
$string['exit_whatnext_0'] = 'O que gostaria de fazer a seguir?';
$string['exit_whatnext_1'] = 'Escolha seu destino ...';
$string['exit_whatnext_default'] = 'Por favor escolha um dos seguintes:';
$string['feedbackdiscuss'] = 'Discutir este questionário em um fórum';
$string['feedbackformmail'] = 'Formulário de feedback';
$string['feedbackmoodleforum'] = 'Fórum Moodle';
$string['feedbackmoodlemessaging'] = 'Mensagens Moodle';
$string['feedbacknone'] = 'Nenhum';
$string['feedbacksendmessage'] = 'Enviar uma mensagem para seu instrutor';
$string['feedbackwebpage'] = 'Página Web';
$string['firstattempt'] = 'Primeira tentativa';
$string['forceplugins'] = 'Forçar plugins de multimeios';
$string['forceplugins_help'] = 'Se ativado, players de mídia compatíveis do Moodle irão reproduzir arquivos como avi, mpeg, mpg, mp3 mov e wmv. Caso contrário, o Moodle não irá alterar as configurações dos players de mídia no questionário.';
$string['frameheight'] = 'Altura do frame';
$string['giveup'] = 'Desistir';
$string['grademethod'] = 'Método de classificação';
$string['grademethod_help'] = 'Esta configuração define como a nota de uma atividade do HotPot é calculada a partir da pontuação das tentativas.
**  Maior pontuação ** : A nota será definida para a pontuação mais alta para uma tentativa desta atividade HotPot.

** Pontuação Média ** : A nota será definida pela pontuação média das tentativas desta atividade HotPot.

**  Primeira tentativa ** : A nota será definida pela pontuação da primeira tentativa desta atividade HotPot.

** Última tentativa ** : A nota será definida pela pontuação da tentativa mais recente nesta atividade HotPot.';
$string['gradeweighting'] = 'Grau de ponderação';
$string['gradeweighting_help'] = 'Notas para esta atividade HotPot serão normalizadas para este número no livro de notas do Moodle.';
$string['highestscore'] = 'Nota mais alta';
$string['hints'] = 'Dicas';
$string['hotpot:addinstance'] = 'Acrescenta uma nova atividade HotPot';
$string['hotpot:attempt'] = 'Tentar atividade';
$string['hotpot:deleteallattempts'] = 'Deletar qualquer tentativa de uma atividade Hotpotatoes';
$string['hotpot:deletemyattempts'] = 'Deletar suas proprias tentativas de atividades Hotpotatoes';
$string['hotpot:ignoretimelimits'] = 'Ignorar limite de tempo na atividade HotPot';
$string['hotpot:manage'] = 'Alterar configurações da atividade HotPot';
$string['hotpotname'] = 'Nome da atividade HotPot';
$string['hotpot:preview'] = 'Pré-visualizar uma atividade Hotpotatoes';
$string['hotpot:reviewallattempts'] = 'Visualizar qualquer tentativa de usuário a uma atividade Hotpotatoes';
$string['hotpot:reviewmyattempts'] = 'Ver sua(s) própria(s) tentativas na atividade HotPot';
$string['hotpot:view'] = 'Ver atividade';
$string['ignored'] = 'Ignorado';
$string['inprogress'] = 'em andamento';
$string['isgreaterthan'] = 'é maior que';
$string['islessthan'] = 'é menor que';
$string['lastaccess'] = 'Último acesso';
$string['lastattempt'] = 'Última tentativa';
$string['lockframe'] = 'Bloquear frame';
$string['maxeventlength'] = 'Número máximo de dias para um evento único no calendário';
$string['mediafilter_hotpot'] = 'Filtro de mídia do HotPot';
$string['mediafilter_moodle'] = 'Filtro padrão de mídia do Moodle';
$string['migratingfiles'] = 'Migrando arquivos de questionário do Hot Potatoes';
$string['missingsourcetype'] = 'Tipo de fonte faltante no registro do HotPot';
$string['modulename'] = 'Atividade Hot Potatoes';
$string['modulename_help'] = 'O módulo HotPot permite aos professores distribuirem materiais de aprendizagem  interativos  aos seus alunos via Moodle e visualizar relatórios sobre as respostas e resultados obtidos pelo alunos . Uma atividade HotPot única consiste em uma página de entrada opcional, um exercício de aprendizagem único, e uma página de saída opcional. O exercício de aprendizagem pode ser uma página web estática ou uma página web interativa que oferece aos estudantes recursos de texto, áudio e visuais e registra suas respostas. O exercício de aprendizagem é criado no computador do professor, utilizando software de autoria e, em seguida, enviado para o Moodle. A atividade HotPot do Moodle, pode trabalhar com exercícios criados com os seguintes softwares de autoria:

* Hot Potatoes (versão 6)
* Qedoc
* Xerte
* iSpring
* Qualquer editor HTML';
$string['modulenameplural'] = 'Atividades Hot Potatoes';
$string['nameadd'] = 'Nome';
$string['nameadd_help'] = 'O nome pode ser um texto específico informado pelo professor ou pode ser gerado automaticamente.

** Obter a partir de arquivo fonte ** : O nome será extraído do arquivo de origem.

** Use nome do arquivo fonte ** : O nome do arquivo fonte será usado como nome.

** Use caminho do arquivo fonte ** : O caminho do arquivo fonte será usado como o nome. Todas as barras no caminho do arquivo serão substituídas por espaços.

** Texto específico ** : O texto específico inserido pelo professor será usado como o nome.';
$string['nameedit'] = 'Nome';
$string['nameedit_help'] = 'O texto específico que será exibido aos estudantes';
$string['navigation'] = 'Navegação';
$string['navigation_embed'] = 'Página web incorporada';
$string['navigation_frame'] = 'Frame de navegação do Moodle';
$string['navigation_give_up'] = 'Um botão "Desistir"';
$string['navigation_help'] = 'Esta configuração especifica a navegação utilizada nas questões:

**Barra de navegação Moodle**
:A barra de navegação irá aparecer na mesma janela das questões no topo da página

**Frame de navegação Moodle**
:A barra de navegação será exibida em uma janela separada no topo das questões

**Página web incorporada**
:A barra de navegação Moodle será exibida junto às questões Hot Potatoes incorporada na janela

**Ajudas originais da navegação**
:As questões serão exibidas junto aos botões de navegação

**Um botão Give Up**
: As questões serão exibidas com um simples botão "Give Up" no topo da página

**Nenhum**
:As questões serão exibidas sem nenhuma ajuda de navegação todas as questões serão respondidas corretamente, dependendo da configuração "Exibir nova questão", Moodle irá retornar a página do curso ou a próxima questão.';
$string['navigation_moodle'] = 'Barra de navegação Moodle padrão (topo e lateral)';
$string['navigation_none'] = 'Nenhum';
$string['navigation_original'] = 'Ajudas de navegação originais';
$string['navigation_topbar'] = 'Barra de navegação ao topo do Moodle apenas (sem barras laterais)';
$string['noactivity'] = 'Nenhuma atividade';
$string['nohotpots'] = 'Não foram encontrados Hotpotatoes';
$string['nomoreattempts'] = 'Lamentamos, você não tem mais tentativas sobrando para esta atividade';
$string['noresponses'] = 'Nenhuma informação encontrada sobre questões e respostas individuais.';
$string['noreview'] = 'Desculpe, você não tem permissão para ver os detalhes dessa tentativa do exercício.';
$string['noreviewafterclose'] = 'Lamentamos, este questionário foi fechado. Você não possui permissão para visualizar detalhes desta tentativa';
$string['noreviewbeforeclose'] = 'Desculpe, você não tem permissão para ver os detalhes dessa tentativa do exercício até
{$a}';
$string['nosourcefilesettings'] = 'No registro do HotPot está faltando a informação sobre o arquivo fonte.';
$string['notavailable'] = 'Lamentamos, esta atividade não está atualmente disponível para você.';
$string['outputformat'] = 'Formato de publicação';
$string['outputformat_best'] = 'melhor';
$string['outputformat_help'] = 'Esta configuração especifica o formato de apresentação do questionário.

* Best - O melhor formato para o navegador
* v6+ - Formato "drag and drop" para navegadores v6+
* v6 - Formato para navegadores v6';
$string['outputformat_hp_6_jcloze_html'] = 'Html JCloze HP6 : Standard';
$string['outputformat_hp_6_jcloze_xml_anctscan'] = 'JCloze a partir de HP6 xml: ANCT-Scan';
$string['outputformat_hp_6_jcloze_xml_dropdown'] = 'JCloze a partir de HP6 xml: Rottmeier DropDown';
$string['outputformat_hp_6_jcloze_xml_findit_a'] = 'JCloze a partir de HP6 xml: Rottmeier FindIt (a)';
$string['outputformat_hp_6_jcloze_xml_findit_b'] = 'JCloze a partir de HP6 xml: Rottmeier FindIt (b)';
$string['outputformat_hp_6_jcloze_xml_jgloss'] = 'JCloze a partir de HP6 xml: Rottmeier JGloss';
$string['outputformat_hp_6_jcloze_xml_v6'] = 'JCloze a partir de HP6 xml: Standard';
$string['outputformat_hp_6_jcloze_xml_v6_autoadvance'] = 'JCloze (v6) a partir de HP6 xml (Auto-avanço)';
$string['outputformat_hp_6_jcross_html'] = 'JCross HP6 html';
$string['outputformat_hp_6_jcross_xml_v6'] = 'JCross a partir de HP6 xml';
$string['outputformat_hp_6_jmatch_html'] = 'JMatch a partir de html';
$string['outputformat_hp_6_jmatch_xml_flashcard'] = 'JMatch a partir de HP6 xml: Flashcard';
$string['outputformat_hp_6_jmatch_xml_jmemori'] = 'JMatch a partir de  HP6 xml: Rottmeier JMemori';
$string['outputformat_hp_6_jmatch_xml_v6'] = 'JMatch (v6) a partir de xml';
$string['outputformat_hp_6_jmatch_xml_v6_plus'] = 'JMatch (v6+) a partir de xml';
$string['outputformat_hp_6_jmix_html'] = 'JMix (v6) a partir de html';
$string['outputformat_hp_6_jmix_xml_v6'] = 'JMix (v6) a partir de xml';
$string['outputformat_hp_6_jmix_xml_v6_plus'] = 'JMix (v6+) a partir de xml';
$string['outputformat_hp_6_jmix_xml_v6_plus_deluxe'] = 'JMix (v6 + com prefixo, sufixo  com distratores) a partir de xml';
$string['outputformat_hp_6_jmix_xml_v6_plus_keypress'] = 'JMix (v6+ com pressionamento de tecla) a partir do  xml';
$string['outputformat_hp_6_jquiz_html'] = 'Html Jquiz HP6';
$string['outputformat_hp_6_jquiz_xml_v6'] = 'JQuiz (v6) a partir do xml';
$string['outputformat_hp_6_jquiz_xml_v6_autoadvance'] = 'JQuiz (v6) a partir do xml (Auto-avanço)';
$string['outputformat_hp_6_jquiz_xml_v6_exam'] = 'JQuiz (v6) a partir de xml (Exame)';
$string['outputformat_hp_6_rhubarb_html'] = 'Rhubarb (v6) a partir de html';
$string['outputformat_hp_6_rhubarb_xml'] = 'Rhubarb (v6) a partir de html';
$string['outputformat_hp_6_sequitur_html'] = 'Sequitur (v6) a partir de html';
$string['outputformat_hp_6_sequitur_html_incremental'] = 'Sequitur (v6) a partir de html, pontuação incremental';
$string['outputformat_hp_6_sequitur_xml'] = 'Sequitur (v6) a partir de html';
$string['outputformat_hp_6_sequitur_xml_incremental'] = 'Sequitur (v6) a partir de html, pontuação incremental';
$string['outputformat_html_ispring'] = 'Arquivo iSpring HTML';
$string['outputformat_html_xerte'] = 'Arquivo Xerte HTML';
$string['outputformat_html_xhtml'] = 'Arquivo padrão HTML';
$string['outputformat_qedoc'] = 'Arquivo Qedoc';
$string['overviewreport'] = 'Visão geral';
$string['penalties'] = 'Penalidades';
$string['percent'] = 'Percentual';
$string['pluginadministration'] = 'Administração HotPot';
$string['pluginname'] = 'Atividade Hot Potatoes';
$string['pressoktocontinue'] = 'Pressione OK para continuar, ou cancelar para ficar na mesma página';
$string['questionshort'] = 'Q-$a';
$string['quizname_help'] = 'Texto de ajuda para o nome do questionário';
$string['quizzes'] = 'Questionários';
$string['removegradeitem'] = 'Excluir item';
$string['removegradeitem_help'] = 'O item de avaliação para esta atividade deve ser removido?

** Não ** : O item de avaliação para esta atividade não será removido do livro de notas do Moodle

**Sim ** : Se a nota máxima ou média ponderada para este HotPot for definida como zero, então a pontuação para  esta atividade será removida do livro de notas do Moodle';
$string['responsesreport'] = 'Respostas';
$string['score'] = 'Resultado';
$string['scoresreport'] = 'Pontuações';
$string['selectattempts'] = 'Selecionar tentativas';
$string['showerrormessage'] = 'Erros do HotPot: {$a}';
$string['sourcefile'] = 'Nome do arquivo fonte';
$string['sourcefile_help'] = 'Esta configuração especifica o arquivo que contém o conteúdo a ser mostrado para os alunos.
Normalmente, o arquivo fonte é criado fora do Moodle, e em seguida enviado para a área de arquivos de um curso de Moodle. Pode ser um arquivo HTML, ou outro tipo de arquivo que foi criado com algum software de autoria, tais como o Hot Potatoes ou Qedoc.

O arquivo fonte deve ser especificado como uma pasta e seu caminho na área de arquivos do curso Moodle , ou pode ser uma url começando com http:// ou https://

Para materiais Qedoc, o arquivo fonte deve ser a url de um módulo Qedoc que foi carregado para o servidor Qedoc.
* Por exemplo, http://www.qedoc.net/library/ABCDE_123.zip
* Para informações sobre como carregar módulos Qedoc ver: [documentação Qedoc: Uploading_modules] (http://www.qedoc.org/en/index.php?title=Uploading_modules)';
$string['sourcefilenotfound'] = 'Arquivo fonte não encontrado (ou vazio )> {$a}';
$string['status'] = 'Estado';
$string['stopbutton'] = 'Exibir botão parar';
$string['stopbutton_help'] = 'Caso esta configuração seja habilitada, um botão escrito pare será inserido no questionário.

Caso um estudante clique no botão pare, os resultados até o momento serão retornados ao Moodle e o status das tentativas será marcado como abandonado.

O texto que é exibido no botão pare pode ser uma das frases pré-existentes nos pacotes de linguagem, ou o professor pode especificar seu próprio texto para o botão.';
$string['stopbutton_langpack'] = 'A partir do pacote de linguagem';
$string['stopbutton_specific'] = 'Utilize texto específico';
$string['stoptext'] = 'Texto para botão parar';
$string['storedetails'] = 'Armazenar os detalhes XML em formato original das tentativas do quiz Hotpotatoes';
$string['studentfeedback'] = 'Feedback de alunos';
$string['studentfeedback_help'] = 'Se ativado, um link para uma janela pop-up de feedback será exibido sempre que os alunos clicarem sobre o botão "Verificar".
A janela de feedback permite aos estudantes para discutirem este teste com seu professor e colegas em uma das seguintes formas:

**Página Web ** : Requer URL da página web, por exemplo http://myserver.com/feedbackform.html

**Formulário de feedback ** : Requer URL do script do formulário, por exemplo http://myserver.com/cgi-bin/formmail.pl

**Fórum Moodle ** : O índice do fórum para o curso será exibido

**Mensagens Moodle ** : A janela de mensagens instantâneas do Moodle será exibida. Se o curso tiver vários professores, o aluno deverá selecionar um professor antes da janela de mensagens ser exibida.';
$string['submits'] = 'Envios';
$string['subplugintype_hotpotattempt'] = 'Formato de saída';
$string['subplugintype_hotpotattempt_plural'] = 'Formatos de saída';
$string['subplugintype_hotpotreport'] = 'Relatório';
$string['subplugintype_hotpotreport_plural'] = 'Relatórios';
$string['subplugintype_hotpotsource'] = 'Arquivo fonte';
$string['subplugintype_hotpotsource_plural'] = 'Arquivos fontes';
$string['textsourcefile'] = 'Trazer do arquivo fonte';
$string['textsourcefilename'] = 'Usar nome do arquivo';
$string['textsourcefilepath'] = 'Usar caminho do arquivo';
$string['textsourcequiz'] = 'Obter na atividade';
$string['textsourcespecific'] = 'Texto específico';
$string['timeclose'] = 'Disponível até';
$string['timedout'] = 'Tempo esgotado';
$string['timelimit'] = 'Limite de tempo';
$string['timelimitexpired'] = 'O limite de tempo para esta tentativa expirou';
$string['timelimitspecific'] = 'Utilize tempo específico';
$string['timelimitsummary'] = 'Limite de tempo para uma tentativa';
$string['timelimittemplate'] = 'Usar configurações no arquivo fonte/modelo';
$string['timeopen'] = 'Disponível a partir de';
$string['timeopenclose'] = 'Tempo para abertura e fechamento';
$string['timeopenclose_help'] = 'Você pode especificar momentos em que o questionário estará acessível para que pessoas façam tentativas. Antes do horário de abertura e depois do horário de fechamento este questionário não estará disponível.';
$string['title'] = 'Título';
$string['unitname_help'] = 'Texto de ajuda para unidade de nome';
$string['updated'] = 'Atualizado';
$string['usefilters'] = 'Utilize filtros';
$string['usefilters_help'] = 'Caso esta configuração seja habilitada, o conteúdo será passado através dos filtors do Moodle antes de serem enviados para o navegador.';
$string['useglossary'] = 'Utilize glossário';
$string['useglossary_help'] = 'Se essa configuração estiver habilitada, o conteúdo passará pelo filtro de Auto-linking do glossário do Moodle antes de ser enviado para o navegador.';
$string['usemediafilter'] = 'Usar filtro de mídia';
$string['usemediafilter_help'] = 'Esta configuração especifica o filtro de mídia a ser utilizado.

** Nenhum ** : O conteúdo não será passado através de quaisquer filtros de mídia.

** Filtros padrões de mídia do Moodle ** : O conteúdo passará pelos filtros padrões de mídia do Moodle. Estes filtros procuram por links para tipos comuns de arquivos de som e vídeo, e convertem esses links para tocadores (players) adequados.

** Filtro de mídia do HotPot  ** : O conteúdo passará por filtros que detectam links, imagens, sons e vídeos, que devem ser especificados usando uma notação de colchetes. Esta notação de colchetes tem a seguinte sintaxe: <code> [url do player com opções de  largura e altura] </code>

 ** url ** : URL relativa ou absoluta do arquivo de mídia

** Tocador (player) ** (opcional) : O nome do player a ser inserido. O valor padrão para esta configuração é "moodle". A versão padrão do módulo HotPot também oferece os seguintes players:

:**dew ** : um leitor de mp3
:**dyer ** : mp3 player por Bernard Dyer
:**Hbs ** : mp3 player de Half-Baked Software
:**image ** : inserir uma imagem na página web
:**link **: inserir um link para outra página web

** largura ** (opcional) : A largura necessária para o player

** altura ** (opcional) : A altura necessária para o player. Se for omitido este valor será definido como o mesmo da configuração de largura.

** opções ** (opcional) : Algumas opções de lista separada por vírgulas, para serem passados para o player. Cada opção pode ser uma chave simples do tipo ligado/desligado, ou um par de valores de determinados campos.
:** Nome = valor
:** Nome = "algum valor com espaços"';
$string['utilitiesindex'] = 'Índice de utilidades HotPot';
$string['viewreports'] = 'Visualizar relatórios para {$a} usuário(s)';
$string['views'] = 'Visualizações';
$string['weighting'] = 'Calculando o peso';
$string['wrong'] = 'Errado';
$string['zeroduration'] = 'Sem duração';
$string['zeroscore'] = 'Pontuação zero';
