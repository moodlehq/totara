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
 * Strings for component 'grades', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   grades
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activities'] = 'Atividades';
$string['addcategory'] = 'Adicionar categoria';
$string['addcategoryerror'] = 'Não foi possível adicionar a categoria';
$string['addexceptionerror'] = 'Erro durante a adição de exceção para userid:gradeitem';
$string['addfeedback'] = 'Adicionar feedback';
$string['addgradeletter'] = 'Adicionar uma letra de nota';
$string['addidnumbers'] = 'Adicionar números de identificação';
$string['additem'] = 'Adicionar item de nota';
$string['addoutcome'] = 'Adicione um resultado';
$string['addoutcomeitem'] = 'Adicionar item de resultado da aprendizagem';
$string['addscale'] = 'Adicionar uma escala';
$string['aggregateextracreditmean'] = 'Média das notas (com pontos extras)';
$string['aggregatemax'] = 'Maior nota';
$string['aggregatemean'] = 'Média das notas';
$string['aggregatemedian'] = 'Mediana das notas';
$string['aggregatemin'] = 'Menor nota';
$string['aggregatemode'] = 'Moda das notas';
$string['aggregateonlygraded'] = 'Agregar somente notas dadas';
$string['aggregateonlygraded_help'] = 'Notas não informadas ou são tratadas como notas mínimas ou não são incluídas na agregação.';
$string['aggregateoutcomes'] = 'Incluir resultado da aprendizagem na agregação';
$string['aggregateoutcomes_help'] = 'A inclusão de resultados de aprendizagem em agregações pode conduzir a nota final diferente da desejada, de forma que você tem a opção de incluí-los ou deixá-los de fora.';
$string['aggregatesonly'] = 'Somente agregados';
$string['aggregatesubcats'] = 'Agregar incluindo subcategorias';
$string['aggregatesubcats_help'] = 'A agregação normalmente é feita apenas com descendentes imediatos, mas é também possível agregar notas de todas as subcategorias, excluindo outras notas agregadas.';
$string['aggregatesum'] = 'Soma das notas';
$string['aggregateweightedmean'] = 'Média ponderada das notas';
$string['aggregateweightedmean2'] = 'Média ponderada simples das notas';
$string['aggregation'] = 'Agregação';
$string['aggregation_help'] = 'Esse menu lhe permite escolher a estratégia de agregação a ser utilizada para calcular a média final de cada participante para esta categoria. As diferentes opções são explicadas abaixo.
As notas são inicialmente convertidas para valores percentuais (intervalo de 0 a 1, chamado de normalização), sendo então agregadas utilizando uma das funções abaixo e, finalmente, convertidas para o intervalo associado ao item de nota (entre a *Nota Mínima* e a *Nota Máxima*).
**Importante**: Uma nota vazia é simplesmente uma entrada ausente no livro de notas, podendo significar muitas coisas distintas. Por exemplo, poderia significar que um participante ainda não enviou uma tarefa, ou um envio de tarefas ainda não corrigido pelo professor, ou uma nota que foi apagada manualmente pelo administrador do livro de notas. Cuidado, portanto, ao interpretar essas notas em branco.

Média das notas
: A soma de todas as notas dividida pelo número de notas.
: T1 70/100, T2 20/80, T3 10/10, máximo da categoria 100:
\`(0.7 + 0.25 + 1.0)/3 = 0.65 --> 65/100\`
Média ponderada das notas
: Pode ser atribuído um peso para cada nota, o qual é, então, utilizado na agregação de média aritmética para definir a importância de cada item na média final.
: T1 70/100 peso 10, T2 20/80 peso 5, T3
10/10 peso 3, máximo da categoria 100:
\`(0.7*10 + 0.25*5 + 1.0*3)/18 = 0.625 --> 62.5/100\`
Média ponderada simples
: A diferença para a *Média Ponderada* é que o peso é calculado como *Nota máxima - Nota mínima*
para cada item. Uma tarefa de 100 pontos tem peso 100, enquanto que uma de 10 pontos tem peso 10.
: T1 70/100, T2 20/80, T3 10/10, máximo da categoria 100:
\`(0.7*100 + 0.25*80 + 1.0*10)/190 = 0.526 --> 52.6/100\`
Média das notas (com pontos extras)
: Média aritmética com pontuação extra. Uma estratégia de agregação antiga e ultrapassada, mantida aqui apenas por questões de compatibilidade com algumas atividades antigas.
Mediana das notas
: A nota do meio (ou a média de duas notas do meio, caso o número seja par), obtida após ordenação das notas. A vantagem sobre a média é que ela não é afetada por valores atípicos (notas que estão muito longe da média).
: T1 70/100, T2 20/80, T3 10/10, máximo da categoria 100:
\`median(0.7 ; 0.25 ; 1.0) = 0.7 --> 70/100\`
Menor nota
: O resultado é a menor nota após a normalização. É geralmente utilizada em combinação com *Agregar somente notas dadas*.
: T1 70/100, T2 20/80, T3 10/10, máximo da categoria 100:
\`min(0.7 ; 0.25 ; 1.0) = 0.25 --> 25/100\`
Maior nota
: O resultado é a maior nota após a normalização.
: T1 70/100, T2 20/80, T3 10/10, máximo da categoria 100:
\`max(0.7 ; 0.25 ; 1.0) = 1.0 --> 100/100\`
Moda das notas
: A moda é a nota que ocorre com mais frequência. É mais utilizado com notas não-númericas. A vantagem sobre a média é que ela não é afetada por valores atípicos (notas que estão muito longe da média). Entretanto, ele perde significado quando há mais de uma nota mais frequente (apenas uma será escolhida), ou quando todas as notas são distintas entre si.
: T1 70/100, T2 35/50, T3 20/80, T4 10/10, T5 7/10 máximo da categoria 100:
\`mode(0.7; 0.7; 0.25; 1.0; 0.7) = 0.7 --> 70/100\`
Soma das notas
: A soma de todos as nota. As escalas são ignoradas. Esse é o único tipo de agregação que não converte internamente as notas para percentagem (normalização). A *Nota Máxima* do item associado à categoria é calculada automaticamente como a soma dos máximos de todos os itens agregados.
: T1 70/100, T2 20/80, T3 10/10:
\`70 + 20 + 10 = 100/190\`';
$string['aggregationcoef'] = 'Coeficiente de agregação';
$string['aggregationcoefextra'] = 'Crédito extra';
$string['aggregationcoefextra_help'] = 'Se a agregação for \'Soma das notas\' ou \'Média ponderada simples\' e a caixa de crédito extra for marcada, a nota máxima do item não será acrescentada à nota máxima da categoria. Assim, será possível atingir a nota máxima da categoria (ou notas maiores que o máximo, se permitido pelo administrador do ambiente) sem ter nota máxima em todos os itens com nota.
Se a forma de agregação for \'Média das notas (com créditos extra)\' e o crédito extra for um valor maior que zero, o crédito extra será o fator pelo qual será multiplicada a nota, antes de somá-la ao total, depois de calcular a média.';
$string['aggregationcoefextrasum'] = 'Crédito extra';
$string['aggregationcoefextrasum_help'] = 'Quando a soma das notas é utilizada como estratégia de agregação, um item pode ser considerado crédito extra na categoria. Isto significa que a nota máxima do item não será adicionada à nota máxima da categoria mas a nota do item, sim. Por exemplo>
* Item 1 tem valor entre 0-100
* Item 2 tem valor entre 0-75
* Item 1 tem a opção "crédito extra" selecionada, Item 2 não.
* Os dois itens pertencem à categoria 1, que tem "soma das notas" como estratégia de agregação
* O total da Categoria 1\'s é entre 0-75
* Um estudante obtém a nota 20 no Item 1 e 70 no Item 2
* O total da Categoria 1 será 75/75 (20+70 = 90 mas o Item 1 é apenas um crédito extra e portanto aumenta o total até o máximo)';
$string['aggregationcoefextraweight'] = 'Peso do crédito extra';
$string['aggregationcoefextraweight_help'] = 'Um valor maior que 0 trata esta nota como crédito extra durante a agregação. O número é o fator de multiplicação da nota antes que seja somado às outras notas mas o item não será contado na divisão. Por exemplo:

* Item 1 é avaliado como 0-100 e o valor do "crédito extra" é 2
* Item 2 é avaliado como 0-100 e o valor do "crédito extra" é 0.0000
* Item 3 é avaliado como 0-100 e o valor do "crédito extra" é 0.0000
* Os 3 items pertencem à Categoria 1, que tem a estratégia de agregação "Média das notas (com crédito extra)"
* Um estudante obtém a nota 20 no Item 1, 40 no Item 2 e 70 no Item 3
* O total da Categoria 1 será 95/100 pois 20*2 + (40 + 70)/2 = 95';
$string['aggregationcoefweight'] = 'Peso do item';
$string['aggregationcoefweight_help'] = 'Peso aplicado a todas as avaliações neste item de avaliação durante a agregação com outros itens de avaliação.';
$string['aggregationposition'] = 'Posição de agregação';
$string['aggregationposition_help'] = 'Define a posição da coluna de total de agregação no relatório das avaliações.';
$string['aggregationsvisible'] = 'Tipos de agregação disponíveis';
$string['aggregationsvisiblehelp'] = 'Selecione os tipos de agregação que devem ser disponibilizados. Mantenha a tecla Ctrl pressionada para selecionar mais que um item.';
$string['allgrades'] = 'Todas as notas por categoria';
$string['allstudents'] = 'Todos os cursistas';
$string['allusers'] = 'Todos os usuários';
$string['autosort'] = 'Ordenação automática';
$string['availableidnumbers'] = 'Números de identificação disponíveis';
$string['average'] = 'Média';
$string['averagesdecimalpoints'] = 'Decimais em colunas de médias';
$string['averagesdecimalpoints_help'] = 'Especifica o número de casas decimais que serão usadas para mostrar cada coluna de média. Se Herança for selecionado, o tipo de apresentação de cada coluna será usado.';
$string['averagesdisplaytype'] = 'Tipo de exibição de colunas de médias';
$string['averagesdisplaytype_help'] = 'Especifica como mostrar a média das colunas. Caso haja herança, será usado o tipo de visualização para cada coluna.';
$string['backupwithoutgradebook'] = 'O <i>backup</i> não contém a configuração do Caderno de Notas';
$string['badgrade'] = 'Nota fornecida é inválida';
$string['badlyformattedscale'] = 'Por favor, insira uma lista de valores separados por vírgula (é necessário inserir pelo menos dois valores)';
$string['baduser'] = 'Usuário fornecido é inválido';
$string['bonuspoints'] = 'Bônus';
$string['bulkcheckboxes'] = 'Conjunto de caixas de marcação';
$string['calculatedgrade'] = 'Nota calculada';
$string['calculation'] = 'Cálculo';
$string['calculation_help'] = 'A nota final pode ser calculada usando uma fórmula, que deve começar com um sinal de igual (=) e pode usar os operadores matemáticos usuais, como \'max\', \'min\' e \'sum\' (soma). Se desejado, outros items de nota podem ser incluídos no cálculo, escrevendo os números de ID entre colchetes duplos. Exemplo: =sum([[327]];[[511]])';
$string['calculationadd'] = 'Adicionar cálculo';
$string['calculationedit'] = 'Editar cálculo';
$string['calculationsaved'] = 'Cálculo salvo';
$string['calculationview'] = 'Ver cálculo';
$string['cannotaccessgroup'] = 'Desculpe, mas não foi possível acessar as notas do grupo selecionado.';
$string['categories'] = 'Categorias';
$string['categoriesanditems'] = 'Categorias e itens';
$string['categoriesedit'] = 'Editar categorias e itens';
$string['category'] = 'Categoria';
$string['categoryedit'] = 'Editar categoria';
$string['categoryname'] = 'Nome da categoria';
$string['categorytotal'] = 'Total da categoria';
$string['categorytotalfull'] = '{$a->categoria}';
$string['categorytotalname'] = 'Nome total da categoria';
$string['changedefaults'] = 'Mudar padrões';
$string['changereportdefaults'] = 'Mudar os padrões de relatório';
$string['chooseaction'] = 'Escolher uma ação...';
$string['choosecategory'] = 'Selecionar Categoria';
$string['combo'] = 'Abas e menu dropdown';
$string['compact'] = 'Compactar';
$string['componentcontrolsvisibility'] = 'Se este item de avaliação está escondido é controlada pelas configurações de atividade.';
$string['contract'] = 'Compactar categoria';
$string['controls'] = 'Controles';
$string['courseavg'] = 'Média do curso';
$string['coursegradecategory'] = 'Categoria de notas do curso';
$string['coursegradedisplaytype'] = 'Tipo de exibição das notas do curso';
$string['coursegradedisplayupdated'] = 'O tipo de exibição das notas foi atualizado.';
$string['coursegradesettings'] = 'Configuração de notas do curso';
$string['coursename'] = 'Nome do curso';
$string['coursescales'] = 'Escalas do curso';
$string['coursesettings'] = 'Configurações do curso';
$string['coursesettingsexplanation'] = 'Configurações do curso determinam como o livro de notas aparece para todos os participantes do curso.';
$string['coursetotal'] = 'Total do curso';
$string['createcategory'] = 'Criar categoria';
$string['createcategoryerror'] = 'Não foi possível criar uma nova categoria';
$string['creatinggradebooksettings'] = 'Criando configurações do livro de notas';
$string['csv'] = 'CSV';
$string['currentparentaggregation'] = 'Agregação-pai atual';
$string['curveto'] = 'Curvar para';
$string['decimalpoints'] = 'Pontos decimais global';
$string['decimalpoints_help'] = 'Especifica o número de casas decimais mostradas em cada nota. Essa configuração não possui efeito nos cálculos de notas, que são feitos com uma exatidão de 5 casas decimais.';
$string['default'] = 'Padrão';
$string['defaultprev'] = 'Padrão ({$a})';
$string['deletecategory'] = 'Excluir Categoria';
$string['disablegradehistory'] = 'Desabilitar histórico de notas';
$string['disablegradehistory_help'] = 'Desativar histórico das mudanças no relatório de notas. Isso pode acelerar um pouco o servidor e conservar espaço no banco de dados.';
$string['displaylettergrade'] = 'Mostrar notas com letras';
$string['displaypercent'] = 'Mostrar porcentagens';
$string['displaypoints'] = 'Mostrar pontuação';
$string['displayweighted'] = 'Mostrar notas ponderadas';
$string['dropdown'] = 'Menu de opções';
$string['droplow'] = 'Descartar as menores';
$string['droplow_help'] = 'Se marcada, esta opção permite desconsiderar as X notas mais baixas, sendo X o valor escolhido para esta opção.';
$string['dropped'] = 'Descartadas';
$string['dropxlowest'] = 'Descartar  X  piores';
$string['dropxlowestwarning'] = 'Se você usar Descartar X Piores, o cálculo considera como igual o valor dos pontos atribuídos a todos os demais itens da categoria. Se os pontos atribuídos forem diferentes, o resultado será imprevisível.';
$string['duplicatescale'] = 'Escala duplicada';
$string['edit'] = 'Editar';
$string['editcalculation'] = 'Editar cálculo';
$string['editcalculationverbose'] = 'Editar cálculo para {$a->category} {$a->itemmodule}  {$a->itemname}';
$string['editfeedback'] = 'Editar avaliação';
$string['editgrade'] = 'Editar nota';
$string['editgradeletters'] = 'Editar letras';
$string['editoutcome'] = 'Editar resultado';
$string['editoutcomes'] = 'Editar resultado da aprendizagem';
$string['editscale'] = 'Editar escala';
$string['edittree'] = 'Categorias e itens';
$string['editverbose'] = 'Editar {$a->category}{$a->itemmodule} {$a->itemname}';
$string['enableajax'] = 'Habilitar AJAX';
$string['enableajax_help'] = 'Colocar uma camada de funcionalidade AJAX no relatório de notas, simplificando e acelerando operações comuns. Depende da ativação do javascript em nível do usuário.';
$string['enableoutcomes'] = 'Habilitar Resultado da aprendizagem';
$string['enableoutcomes_help'] = 'Suporte a resultados da aprendizagem. Significa que pode-se atribuir notas usando uma ou mais escalas ligadas a resultados. Ativando esta opção, é possível utilizar esse sistema especial de notas no site.';
$string['encoding'] = 'Codificação';
$string['errorcalculationnoequal'] = 'Fórmula deve começar com o sinal de igual (=1+2)';
$string['errorcalculationunknown'] = 'Fórmula inválida';
$string['errorgradevaluenonnumeric'] = 'Recebido valor não numérico para nota baixa ou alta';
$string['errornocalculationallowed'] = 'Cálculos não são permitidos para este item';
$string['errornocategorisedid'] = 'Impossível obter id sem categoria!';
$string['errornocourse'] = 'Impossível obter informações do curso';
$string['errorreprintheadersnonnumeric'] = 'Recebido valor não numérico para imprimir novamente os títulos';
$string['errorsavegrade'] = 'Desculpe, mas não foi possível salvar as notas.';
$string['errorupdatinggradecategoryaggregateonlygraded'] = 'Erro ao atualizar a configuração \'Agregar só notas não vazias\' da categoria de notas ID {$a->id}';
$string['errorupdatinggradecategoryaggregateoutcomes'] = 'Erro ao atualizar a configuração \'Incluir resultados na agregação\' na categoria de notas de ID {$a->id}';
$string['errorupdatinggradecategoryaggregatesubcats'] = 'Erro ao atualizar a configuração \'Agregar incluindo subcategorias\' na categoria de notas de ID {$a->id}';
$string['errorupdatinggradecategoryaggregation'] = 'Erro ao atualizar o tipo de agregação da categoria de notas de ID {$a->id}';
$string['errorupdatinggradeitemaggregationcoef'] = 'Erro ao atualizar o coeficiente de agregação (peso ou crédito extra) o item de nota de ID {$a->id}';
$string['excluded'] = 'Excluídos';
$string['excluded_help'] = 'Se -excluído- estiver ativado, esta nota será excluída de qualquer agregação feita por um item ou categoria de nota pai.';
$string['expand'] = 'Expandir categoria';
$string['export'] = 'Exportar';
$string['exportalloutcomes'] = 'Exportar todas as metas';
$string['exportfeedback'] = 'Incluir avaliação na exportação';
$string['exportplugins'] = 'Exportar plugins';
$string['exportsettings'] = 'Exportar configurações';
$string['exportto'] = 'Exportar para';
$string['extracreditwarning'] = 'Se todos os itens forem atribuídos a uma categoria com créditos adicionais, estes serão removidos do cálculo da avaliação. Não existe, neste caso, uma nota final total';
$string['feedback'] = 'Avaliação';
$string['feedback_help'] = 'Comentários adicionados à nota pelo professor. Eles podem ser gerais, personalizados ou um comentaŕio simples referente a um sistema interno de feedback.';
$string['feedbackadd'] = 'Adicionar feedback';
$string['feedbackedit'] = 'Editar feedback';
$string['feedbacksaved'] = 'Feedback salvo';
$string['feedbackview'] = 'Ver feedback';
$string['finalgrade'] = 'Média final';
$string['finalgrade_help'] = 'A média final (memorizada na cache) depois que todos os cálculos são realizados.';
$string['fixedstudents'] = 'Coluna estática de estudantes';
$string['fixedstudents_help'] = 'Permitir a rolagem horizontal da tela de notas sem perder de vista a coluna dos alunos, fazendo-a estática.';
$string['forceoff'] = 'Forçar: desativado';
$string['forceon'] = 'Forçar: ativado';
$string['forelementtypes'] = 'para o selecionado {$a}';
$string['forstudents'] = 'Para os cursistas';
$string['full'] = 'Completo';
$string['fullmode'] = 'Visão completa';
$string['fullview'] = 'Visão completa';
$string['generalsettings'] = 'Configurações gerais';
$string['grade'] = 'Nota';
$string['gradeadministration'] = 'Administração de notas';
$string['gradeanalysis'] = 'Análise de nota';
$string['gradebook'] = 'Livro de notas';
$string['gradebookhiddenerror'] = 'Atualmente o livro de notas está configurado para esconder tudo dos estudantes.';
$string['gradebookhistories'] = 'Histórico de notas';
$string['gradeboundary'] = 'Limite da letra de nota';
$string['gradeboundary_help'] = 'Limites percentuais sobre os quais serão atribuídos notas por letras (se o modo de exibição por Letras estiver sendo usado).';
$string['gradecategories'] = 'Categorias de notas';
$string['gradecategory'] = 'Categoria de nota';
$string['gradecategoryonmodform'] = 'Categoria de nota';
$string['gradecategoryonmodform_help'] = 'Esta configuração controla a categoria na qual as notas da atividade são postadas no livro de notas';
$string['gradecategorysettings'] = 'Configurações de categoria de nota';
$string['gradedisplay'] = 'Apresentar a nota';
$string['gradedisplaytype'] = 'Tipo de apresentação da nota';
$string['gradedisplaytype_help'] = 'Especifica como as notas serão mostradas no relatório de notas e nos relatórios do usuário. Notas podem ser mostradas na forma numérica, como percentagem (em relação às notas mínimas e máximas) ou como letras.';
$string['gradedon'] = 'Avaliado: {$a}';
$string['gradeexport'] = 'Exportação de notas';
$string['gradeexportdecimalpoints'] = 'Casas decimais das notas exportadas';
$string['gradeexportdecimalpoints_desc'] = 'O número de casas decimais mostrados na hora de exportar. Isso pode ser reconfigurado no momento.';
$string['gradeexportdisplaytype'] = 'Tipo de exibição das notas exportadas';
$string['gradeexportdisplaytype_desc'] = 'As notas podem ser mostradas na sua forma própria, como porcentagem (em relação às notas mínimas e máximas) ou como letras na hora de exportar. Isso pode ser reconfigurado nesse momento.';
$string['gradeforstudent'] = '{$a->student}<br />{$a->item}{$a->feedback}';
$string['gradehelp'] = 'Ajuda nas notas';
$string['gradehistorylifetime'] = 'Tempo de vida do histórico de notas';
$string['gradehistorylifetime_help'] = 'Isto especifica o intervalo de tempo pelo qual o histórico das alterações de nota deve ser mantidos. É recomendado que seja o maior possível. Se houver problemas de performance ou limites de espaço, tente um número menor.';
$string['gradeimport'] = 'Importação de notas';
$string['gradeitem'] = 'Item de nota';
$string['gradeitemaddusers'] = 'Excluir da avaliação';
$string['gradeitemadvanced'] = 'Opções avançadas de item de nota';
$string['gradeitemadvanced_help'] = 'Escolher todos os elementos que devem ser mostrados como disponíveis na edição de itens de nota.';
$string['gradeitemislocked'] = 'Essa atividade fica travada no livro de notas. Mudanças para as notas não são copiadas ao livro até que ele seja destravado.';
$string['gradeitemlocked'] = 'Avaliação travada';
$string['gradeitemmembersselected'] = 'Excluídos da avaliação';
$string['gradeitemnonmembers'] = 'Incluídos na Avaliação';
$string['gradeitemremovemembers'] = 'Incluir na Avaliação';
$string['gradeitems'] = 'Itens de avaliação';
$string['gradeitemsettings'] = 'Configurações de item de nota';
$string['gradeitemsinc'] = 'Itens de nota a serem inclusos';
$string['gradeletter'] = 'Letra de avaliação';
$string['gradeletter_help'] = 'Uma letra ou outro símbolo usado para representar um intervalo de notas.';
$string['gradeletternote'] = 'Para remover uma letra de avaliação basta esvaziar<br />uma das três áreas relativas àquela letra e clicar salvar';
$string['gradeletters'] = 'Letras de avaliação';
$string['gradelocked'] = 'Avaliação está travada';
$string['gradelong'] = '{$a->grade} / {$a->max}';
$string['grademax'] = 'Nota máxima';
$string['grademax_help'] = 'Ao usar um tipo numérico de nota, é possível determinar um máximo. A nota máxima de um item de nota baseado em atividades pode ser configurada na página de atualização de atividades.';
$string['grademin'] = 'Nota mínima';
$string['grademin_help'] = 'Ao usar um tipo numérico de nota, é possível determinar um valor mínimo.';
$string['gradeoutcomeitem'] = 'Item de resultado da aprendizagem';
$string['gradeoutcomes'] = 'Resultado da aprendizagem';
$string['gradeoutcomescourses'] = 'Resultado da aprendizagem de cursos';
$string['gradepass'] = 'Nota para aprovação';
$string['gradepass_help'] = 'Se um item tem uma nota que os usuários precisam igualar ou exceder para passar (atingir a suficiência), você deve defini-la aqui.';
$string['gradepreferences'] = 'Preferências de nota';
$string['gradepreferenceshelp'] = 'Ajuda para preferências de avaliação';
$string['gradepublishing'] = 'Habilitar publicar';
$string['gradepublishing_help'] = 'Permite publicação quando importar e exportar: Notas exportadas podem ser acessadas por uma URL, sem precisar logar no Moodle. Notas podem ser importadas através de uma URL (o que significa que o Moodle pode importar notas publicadas em outro Moodle). Por padrão somente administradores podem usar essa opção, por favor alerte os usuários antes de dar permissões, devido às aberturas de segurança (compartilhamento de Favoritos e aceleradores de download, restrições de IP, etc).';
$string['gradereport'] = 'Relatório de notas';
$string['graderreport'] = 'Relatório de notas';
$string['grades'] = 'Notas';
$string['gradesforuser'] = 'Notas para {$a->user}';
$string['gradesonly'] = 'Só notas';
$string['gradessettings'] = 'Configurações de notas';
$string['gradetype'] = 'Tipo de nota';
$string['gradetype_help'] = 'Especifica o tipo de nota usado: nenhuma (sem notas), numérico (permite configurações de máximo e mínimo), escala (permite configurações de escala) ou texto (somente feedback). Sómente as notas numéricas e as de escala podem ser agregadas. O tipo de nota para um item de nota baseado em atividades é configurado na página de atualizações das atividades.';
$string['gradeview'] = 'Mostrar nota';
$string['gradeweighthelp'] = 'Ajuda para peso de ponderação das notas';
$string['groupavg'] = 'Média do grupo';
$string['hidden'] = 'Oculto';
$string['hidden_help'] = 'Se marcado, as notas permanecerão ocultas para os cursistas. Se desejado, pode-se fixar uma data a partir da qual as notas ficarão visíveis, por exemplo, quando as avaliações forem concluídas.';
$string['hiddenasdate'] = 'Mostrar data de apresentação para notas ocultas';
$string['hiddenasdate_help'] = 'Se usuários não podem ver notas ocultas, mostrar data do envio em vez de \'-\'.';
$string['hiddenuntil'] = 'Oculto até';
$string['hiddenuntildate'] = 'Oculto até: {$a}';
$string['hideadvanced'] = 'Ocultar Características Avançadas';
$string['hideaverages'] = 'Ocultar médias';
$string['hidecalculations'] = 'Ocultar cálculos';
$string['hidecategory'] = 'Oculta';
$string['hideeyecons'] = 'Ocultar ícones mostrar/ocultar';
$string['hidefeedback'] = 'Ocultar feedback';
$string['hideforcedsettings'] = 'Ocultar configurações forçadas';
$string['hideforcedsettings_help'] = 'Não mostrar as definições forçadas na interface de usuário do caderno de notas.';
$string['hidegroups'] = 'Ocultar grupos';
$string['hidelocks'] = 'Ocultar travas';
$string['hidenooutcomes'] = 'Mostrar resultados da aprendizagem';
$string['hidequickfeedback'] = 'Ocultar o retorno rápido';
$string['hideranges'] = 'Ocultar intervalos';
$string['hidetotalifhiddenitems'] = 'Esconder totais caso contenha itens escondidos?';
$string['hidetotalifhiddenitems_help'] = 'Esta opção define se os totais que incluem itens com notas ocultas serão mostrados aos cursistas ou se serão substituidospor um hífen (-). Se exibido, o total pode ser calculado excluindo ou incluindo os itens ocultos.
Se os itens ocultos forem excluídos, o total será diferente do total visto pelo professor no relatório de notas, já que este sempre vê os totais calculados sobre todos os itens, visíveis ou ocultos. Se os itens ocultos forem incluídos, os cursistas poderão calcular os itens ocultos.';
$string['hidetotalshowexhiddenitems'] = 'Mostar totais excluindo itens escondidos';
$string['hidetotalshowinchiddenitems'] = 'Mostar totais incluindo itens escondidos';
$string['hideverbose'] = 'Ocultar {$a->category} {$a->itemmodule}  {$a->itemname}';
$string['highgradeascending'] = 'Ordem crescente por melhor nota';
$string['highgradedescending'] = 'Ordem decrescente por melhor nota';
$string['highgradeletter'] = 'Alta';
$string['identifier'] = 'Identificar usuário por';
$string['idnumbers'] = 'Números de ID';
$string['import'] = 'Importar';
$string['importcsv'] = 'Importar CSV';
$string['importcustom'] = 'Importar como resultados personalizados (somente nesse curso)';
$string['importerror'] = 'Um erro ocorreu, o script não foi chamado com os parâmetros corretos.';
$string['importfailed'] = 'Importação falhou';
$string['importfeedback'] = 'Importar feedback';
$string['importfile'] = 'Importar arquivo';
$string['importfilemissing'] = 'Nenhum arquivo foi recebido, volte ao formulário e envie um arquivo válido.';
$string['importfrom'] = 'Importar de';
$string['importoutcomenofile'] = 'O arquivo enviado está vazio ou corrompido. Por favor verifique se é um arquivo válido. O problema foi detectado na linha {$a}; isso ocorreu porque as linhas de dados (não todas as colunas da primeira linha), a linha principal, ou o arquivo importado tem o cabeçalho incompleto. Procure nos arquivos exportados por um exemplo de arquivo válido.';
$string['importoutcomes'] = 'Importar resultados da aprendizagem';
$string['importoutcomes_help'] = 'Os resultados podem ser importados de um arquivo CSV com o mesmo formato que o arquivo CSV em que são exportados resultados.';
$string['importoutcomesuccess'] = 'Meta "{$a->name}" importada com o ID #{$a->id}';
$string['importplugins'] = 'Importar plugins';
$string['importpreview'] = 'Importar amostra';
$string['importsettings'] = 'Importar configurações';
$string['importskippednomanagescale'] = 'Você não tem permissão para criar uma nova escala, então a meta "{$a}" não foi passada, já que necessitava dessa criação.';
$string['importskippedoutcome'] = 'Um resultado de nome "{$a}" já existe nesse contexto, então saltamos o que foi importado.';
$string['importstandard'] = 'Importar como resultados padrão';
$string['importsuccess'] = 'Notas importadas com sucesso';
$string['importxml'] = 'Importar XML';
$string['includescalesinaggregation'] = 'Incluir escalas na agregação';
$string['includescalesinaggregation_help'] = 'Você pode escolher se as escalas devem ser incluídas como números em todas as notas agregadas do site.
CUIDADO: alterar essa opção fará com que todas as notas sejam recalculadas.';
$string['incorrectcourseid'] = 'O ID do curso não era correto';
$string['incorrectcustomscale'] = '(Escala personalizada incorreta, por favor altere.)';
$string['incorrectminmax'] = 'O mínimo precisa ser menor que o máximo';
$string['inherit'] = 'Herdar';
$string['intersectioninfo'] = 'Informações sobre estudante/nota';
$string['item'] = 'Item';
$string['iteminfo'] = 'Informação do item';
$string['iteminfo_help'] = 'Um espaço para adicionar informações sobre o item. Esse texto não aparece em nenhum outro lugar.';
$string['itemname'] = 'Nome do Item';
$string['itemnamehelp'] = 'O nome do item, utilizado no módulo.';
$string['items'] = 'Itens';
$string['itemsedit'] = 'Editar item de nota';
$string['keephigh'] = 'Manter as maiores';
$string['keephigh_help'] = 'Se marcado, a opção vai manter as X maiores notas, sendo X o valor escolhido na opção';
$string['keymanager'] = 'Gerenciador de chaves';
$string['lessthanmin'] = 'A nota digitada para {$a->itemname} de {$a->username} é menor que o mínimo permitido';
$string['letter'] = 'Letra';
$string['lettergrade'] = 'Notas por letras';
$string['lettergradenonnumber'] = 'Avaliações baixas e/ou altas não numéricas';
$string['letterpercentage'] = 'Letra (porcentagem)';
$string['letterreal'] = 'Letra (real)';
$string['letters'] = 'Letras';
$string['linkedactivity'] = 'Atividade ligada';
$string['linkedactivity_help'] = 'Especifica uma atividade opcional ao qual esse item de nota está ligado. Isso é usado para medir a performance do estudante em critérios não avaliados pelas notas nas atividades.';
$string['linktoactivity'] = 'Referência para atividade {$a->name}';
$string['lock'] = 'Travar';
$string['locked'] = 'Travado';
$string['locked_help'] = 'Se marcado, as notas não podem mais ser atualizadas automaticamente pela atividade relacionada.';
$string['locktime'] = 'Travar depois de';
$string['locktimedate'] = 'Travado depois de: {$a}';
$string['lockverbose'] = 'Travar {$a->category}{$a->itemmodule} {$a->itemname}';
$string['lowest'] = 'Pior';
$string['lowgradeletter'] = 'Baixa';
$string['manualitem'] = 'Item manual';
$string['mapfrom'] = 'Mapear de';
$string['mappings'] = 'Mapeamento de itens de nota';
$string['mapto'] = 'Mapear para';
$string['max'] = 'Melhor';
$string['maxgrade'] = 'Nota máxima';
$string['meanall'] = 'Todas as notas';
$string['meangraded'] = 'Notas não vazias';
$string['meanselection'] = 'Notas selecionadas para colunas de médias';
$string['meanselection_help'] = 'Notas em branco devem ser incluídas na hora de calcular médias de cada coluna.';
$string['median'] = 'Mediana';
$string['min'] = 'Pior';
$string['missingscale'] = 'Uma escala deve ser escolhida';
$string['mode'] = 'Tendência';
$string['morethanmax'] = 'A nota digitada para {$a->itemname} de {$a->username} é maior que o máximo permitido.';
$string['moveselectedto'] = 'Mover itens selecionados para';
$string['movingelement'] = 'Movendo {$a}';
$string['multfactor'] = 'Multiplicador';
$string['multfactor_help'] = 'Fator pelo qual todas as notas desse item serão multiplicadas.';
$string['mypreferences'] = 'Minhas preferências';
$string['myreportpreferences'] = 'Minhas preferências para o quadro de notas';
$string['navmethod'] = 'Método de navegação';
$string['neverdeletehistory'] = 'Nunca remova o histórico de notas';
$string['newcategory'] = 'Nova categoria';
$string['newitem'] = 'Novo item de nota';
$string['newoutcomeitem'] = 'Novo item de resultados';
$string['no'] = 'Não';
$string['nocategories'] = 'Não foi possível encontrar ou adicionar categorias de nota neste curso';
$string['nocategoryname'] = 'Nenhum nome de categoria foi dado.';
$string['nocategoryview'] = 'Nenhuma categoria a ser mostrada por';
$string['nocourses'] = 'Ainda não existem cursos';
$string['noforce'] = 'Não forçar';
$string['nogradeletters'] = 'Não foi configurada nenhuma escala';
$string['nogradesreturned'] = 'Nenhuma avaliação calculada';
$string['noidnumber'] = 'Nenhum número de ID';
$string['nolettergrade'] = 'Não foram definidas as letras em';
$string['nomode'] = 'NA';
$string['nonnumericweight'] = 'Recebido valor não numérico para';
$string['nonunlockableverbose'] = 'A nota não pode ser destravada até que {$a->itemname} seja destravada.';
$string['nonweightedpct'] = 'não ponderada %';
$string['nooutcome'] = 'Nenhum resultado de aprendizagem';
$string['nooutcomes'] = 'Os itens de resultados devem apontar para o resultado de um curso, mas não há resultados para esse curso. Deseja acrescentar um?';
$string['nopublish'] = 'Não publicar';
$string['norolesdefined'] = 'Não há papéis definidos em Administração > Notas > Configuração Geral > Papéis de Avaliação';
$string['noscales'] = 'Os resultados devem apontar para uma escala de curso ou uma escala global, mas não há nenhuma. Deseja acrescentar uma?';
$string['noselectedcategories'] = 'nenhuma categoria foi selecionada.';
$string['noselecteditems'] = 'nenhum item foi selecionado.';
$string['notteachererror'] = 'Você deve ser um professor para fazer isto';
$string['nousersloaded'] = 'Não foram carregados usuários';
$string['numberofgrades'] = 'Número de notas';
$string['onascaleof'] = 'em uma escala de {$a->grademin} até {$a->grademax}';
$string['operations'] = 'Operações';
$string['options'] = 'Opções';
$string['outcome'] = 'Meta';
$string['outcome_help'] = 'Especificar o resultado que o item de nota vai representar no relatório de notas. Somente resultaods associados a esse curso e ao site podem ser usados.';
$string['outcomeassigntocourse'] = 'Atribuir um outro resultado para este curso';
$string['outcomecategory'] = 'Criar resultados na categoria';
$string['outcomecategorynew'] = 'Nova categoria';
$string['outcomeconfirmdelete'] = 'Voce tem certeza que deseja excluir a meta "{$a}"?';
$string['outcomecreate'] = 'Adicionar uma novo resultado';
$string['outcomedelete'] = 'Excluir resultado';
$string['outcomefullname'] = 'Nome completo';
$string['outcomeitem'] = 'Item de resultado da aprendizagem';
$string['outcomeitemsedit'] = 'Editar item de resultado da aprendizagem';
$string['outcomereport'] = 'Quadro de resultado da aprendizagem';
$string['outcomes'] = 'Resultado da aprendizagem';
$string['outcomescourse'] = 'Resultado da aprendizagem utilizados no curso';
$string['outcomescoursecustom'] = 'Utilizado o resultado escolhida (sem remoção)';
$string['outcomescoursenotused'] = 'Padrão não utilizado';
$string['outcomescourseused'] = 'Padrão utilizado (sem remoção)';
$string['outcomescustom'] = 'Resultados escolhidos';
$string['outcomeshortname'] = 'Nome breve';
$string['outcomesstandard'] = 'Resultados padrão';
$string['outcomesstandardavailable'] = 'Padrão de resultados disponível';
$string['outcomestandard'] = 'Resultado padrão';
$string['outcomestandard_help'] = 'Um Resultado padrão fica disponível a nível do site, para todos os cursos.';
$string['overallaverage'] = 'Média geral';
$string['overridden'] = 'Sobreposto';
$string['overridden_help'] = 'Quando ativado, a marca de sobreposição previne tentativas futuras de ajustar automaticamente o valor da nota. Isso é geralmente definido no relatório de notas, mas pode ser desativado ou ativado manualmente usando esse formulário.';
$string['overriddennotice'] = 'Sua nota final para esta atividade foi ajustada manualmente';
$string['overridesitedefaultgradedisplaytype'] = 'Sobrepor os padrões do site';
$string['overridesitedefaultgradedisplaytype_help'] = 'Marque essa opção para permitir a sobreposição de padrões na exibição de notas do relatório. Isso ativa os formulários, permitindo que você defina as letras de nota e os limites associados a elas.';
$string['parentcategory'] = 'Categoria pai';
$string['pctoftotalgrade'] = '% da nota total';
$string['percent'] = 'Percentual';
$string['percentage'] = 'Porcentagem';
$string['percentageletter'] = 'Porcentagem (letra)';
$string['percentagereal'] = 'Porcentagem (real)';
$string['percentascending'] = 'Ordem crescente por porcentagem';
$string['percentdescending'] = 'Ordem decrescente por porcentagem';
$string['percentshort'] = '%';
$string['plusfactor'] = 'Compensação';
$string['plusfactor_help'] = 'Fator que será somado a todas as notas desse item, depois que o multiplicador é aplicado.';
$string['points'] = 'pontos';
$string['pointsascending'] = 'Ordem crescente por pontuação';
$string['pointsdescending'] = 'Ordem decrescente por pontuação';
$string['positionfirst'] = 'Primeiro';
$string['positionlast'] = 'Último';
$string['preferences'] = 'Preferências';
$string['prefgeneral'] = 'Geral';
$string['prefletters'] = 'Letras de notas e limites';
$string['prefrows'] = 'Colunas especiais';
$string['prefshow'] = 'Mostrar/ocultar seletor';
$string['previewrows'] = 'Colunas para pré-visualização';
$string['profilereport'] = 'Relatório de perfil do usuário';
$string['profilereport_help'] = 'Relatório de notas no perfil do usuários.';
$string['publishing'] = 'Publicando';
$string['quickfeedback'] = 'Feedback rápido';
$string['quickgrading'] = 'Atribuição rápida de notas';
$string['quickgrading_help'] = 'A opção Notas Rápidas abre um campo de texto para cada célula de nota do relatório, permitindo a edição simultânea. Aí é só clicar no botão Atualizar e fazer todas as mudanças de uma vez.';
$string['range'] = 'Intervalo';
$string['rangedecimals'] = 'Casas decimais dos intervalos';
$string['rangedecimals_help'] = 'O número de pontos decimais mostrados no intervalo.';
$string['rangesdecimalpoints'] = 'Casas decimais mostradas nos intervalos';
$string['rangesdecimalpoints_help'] = 'Especifica o número de casas decimais a serem mostradas em cada intervalo. Essa configuração pode ser sobreposta pelos itens de nota.';
$string['rangesdisplaytype'] = 'Modo de exibição dos intervalos';
$string['rangesdisplaytype_help'] = 'Determina como mostrar os intervalos. Caso a herança esteja ativada, será usado o mesmo modo de exibição para cada coluna.';
$string['rank'] = 'Classificação';
$string['rawpct'] = 'Bruto %';
$string['real'] = 'Real';
$string['realletter'] = 'Real (letra)';
$string['realpercentage'] = 'Real (porcentagem)';
$string['regradeanyway'] = 'Recálculo obrigatório';
$string['removeallcoursegrades'] = 'Remova todas as notas';
$string['removeallcourseitems'] = 'Remova todos os itens e categorias';
$string['report'] = 'Relatório';
$string['reportdefault'] = 'Relatório padrão ({$a})';
$string['reportplugins'] = 'Plugins de relatório';
$string['reportsettings'] = 'Configurações dos relatórios de notas';
$string['reprintheaders'] = 'Mostrar novamente os cabeçalhos';
$string['respectingcurrentdata'] = 'deixando a configuração atual inalterada';
$string['rowpreviewnum'] = 'Colunas para pré-visualização';
$string['savechanges'] = 'Salvar mudanças';
$string['savepreferences'] = 'Salvar preferências';
$string['scaleconfirmdelete'] = 'Tem certeza que deseja excluir a escala "{$a}"?';
$string['scaledpct'] = 'ponderado %';
$string['seeallcoursegrades'] = 'Ver todas as notas de curso';
$string['selectalloroneuser'] = 'Ver todos ou apenas um usuário';
$string['selectauser'] = 'Selecionar um usuário';
$string['selectdestination'] = 'Escolher destino do(a) {$a}';
$string['separator'] = 'Separador';
$string['sepcomma'] = 'Vírgula';
$string['septab'] = 'Tabulação';
$string['setcategories'] = 'Definir categorias';
$string['setcategorieserror'] = 'É necessário definir categorias para o seu curso antes de atribuir pesos às mesmas.';
$string['setgradeletters'] = 'Definir letras de avaliação';
$string['setpreferences'] = 'Definir preferências';
$string['setting'] = 'Configuração';
$string['settings'] = 'Configurações';
$string['setweights'] = 'Definir pesos';
$string['showactivityicons'] = 'Mostrar ícones de atividades';
$string['showactivityicons_help'] = 'Mostrar ícones das atividades próximos aos respectivos nomes.';
$string['showallhidden'] = 'Mostrar ocultos';
$string['showallstudents'] = 'Mostrar todos os cursistas';
$string['showanalysisicon'] = 'Mostra ícone de análise de nota';
$string['showanalysisicon_desc'] = 'Mostra ou não o ícone de análise de nota por padrão. Se o módulo de atividade suportar, o ícone de análise de nota levará a uma página com uma explicação mais detalhada da nota e como ela foi obtida.';
$string['showanalysisicon_help'] = 'Caso este módulo de atividade suporte, o link de análise de nota levará para uma página com uma explicação mais detalhada da nota e como ela foi obtida.';
$string['showaverage'] = 'Exibir média';
$string['showaverage_help'] = 'Mostrar a coluna de média? Os alunos podem ser capazes de estimar as notas de outros alunos se a média é calculada a partir de um pequeno número de valores. Por motivos de desempenho a média é aproximada se ela depende de algum item oculto.';
$string['showaverages'] = 'Mostrar médias das colunas';
$string['showaverages_help'] = 'Mostrar a média de cada coluna.';
$string['showcalculations'] = 'Mostrar cálculos';
$string['showcalculations_help'] = 'Mostrar ícones da calculadora perto de cada item de nota e cada categoria, dicas para os itens calculados e um indicador visual para a coluna calculada.';
$string['showeyecons'] = 'Mostrar ícones mostrar/ocultar';
$string['showeyecons_help'] = 'Mostrar um ícone de exibir/ocultar perto de cada nota (controlando a visibilidade do usuário).';
$string['showfeedback'] = 'Mostrar feedback';
$string['showfeedback_help'] = 'Mostrar a coluna de feedback?';
$string['showgrade'] = 'Mostrar notas';
$string['showgrade_help'] = 'Mostrar a coluna de notas?';
$string['showgroups'] = 'Mostrar grupos';
$string['showhiddenitems'] = 'Mostrar itens ocultos';
$string['showhiddenitems_help'] = 'Selecionar se as notas ocultas serão totalmente invisíveis para os cursistas ou se eles poderão ver os nomes dos itens.
* Mostrar ocultas - Os nomes dos itens são visíveis mas as notas permanecem ocultas.
* Ocultas até - Os itens permanecem totalmente ocultos até a data fixada.
* Não mostrar - Os itens permanecem totalmente ocultos, nomes e notas.';
$string['showhiddenuntilonly'] = 'Somente ocultos até';
$string['showlettergrade'] = 'Exibir letras das notas';
$string['showlettergrade_help'] = 'Mostrar coluna de avaliação por letras?';
$string['showlocks'] = 'Mostrar travas';
$string['showlocks_help'] = 'Mostrar um ícone de Travar/Destravar perto de cada nota';
$string['shownohidden'] = 'Não mostrar';
$string['shownooutcomes'] = 'Oculte resultados da aprendizagem';
$string['shownumberofgrades'] = 'Mostrar número de notas nas médias';
$string['shownumberofgrades_help'] = 'Mostrar o número de notas utilizadas no cálculo da média em parênteses, por exemplo 45 (34).';
$string['showpercentage'] = 'Mostrar percentagem';
$string['showpercentage_help'] = 'Mostrar o valor percentual de cada item de avaliação?';
$string['showquickfeedback'] = 'Mostrar retorno rápido';
$string['showquickfeedback_help'] = 'Feedback Rápido abre um campo de texto para cada célula de nota do livro, permitindo que você edite o feedback de várias notas de uma vez. Então, você pode clicar no botão Atualizar e fazer todas as mudanças simultaneamente.';
$string['showrange'] = 'Exibir intervalos';
$string['showrange_help'] = 'Mostrar a coluna de intervalos?';
$string['showranges'] = 'Mostrar intervalos';
$string['showranges_help'] = 'Mostrar o intervalo de notas para cada coluna em uma linha adicional.';
$string['showrank'] = 'Mostrar classificação';
$string['showrank_help'] = 'Mostrar a posição do usuário em relação ao resto da sala, para cada item de avaliação?';
$string['showuserimage'] = 'Mostrar imagens do perfil do usuário';
$string['showuserimage_help'] = 'Mostrar a imagem do perfil do usuário próximo ao seu nome no relatório de notas.';
$string['showverbose'] = 'Mostrar {$a->category} {$a->itemmodule} {$a->itemname}';
$string['showweight'] = 'Mostrar pesos';
$string['showweight_help'] = 'Mostrar a coluna de pesos de notas?';
$string['simpleview'] = 'Visão simples';
$string['sitewide'] = 'Em todo o site';
$string['sort'] = 'Ordenar';
$string['sortasc'] = 'Ordem crescente';
$string['sortbyfirstname'] = 'Ordenar pelo primeiro nome';
$string['sortbylastname'] = 'Ordenar por sobrenome';
$string['sortdesc'] = 'Ordem Decrescente';
$string['standarddeviation'] = 'Desvio padrão';
$string['stats'] = 'Estatísticas';
$string['statslink'] = 'estat.';
$string['student'] = 'Estudante';
$string['studentsperpage'] = 'Estudantes por página';
$string['studentsperpage_help'] = 'O número de estudantes a ser mostrado por página no relatório de notas.';
$string['subcategory'] = 'Categoria normal';
$string['submissions'] = 'Envios';
$string['submittedon'] = 'Enviado(s): {$a}';
$string['switchtofullview'] = 'Mudar para visão completa';
$string['switchtosimpleview'] = 'Mudar para visão simples';
$string['tabs'] = 'Abas';
$string['topcategory'] = 'Super categoria';
$string['total'] = 'Total';
$string['totalweight100'] = 'O peso total é igual a 100';
$string['totalweightnot100'] = 'O peso total não é igual a 100';
$string['turnfeedbackoff'] = 'Desativar feedback';
$string['turnfeedbackon'] = 'Ativar feedback';
$string['typenone'] = 'Nenhum';
$string['typescale'] = 'Escala';
$string['typescale_help'] = 'Depois de selecionar um tipo de escala, escalas de avaliação de itens serão vísiveis na página de atualização de atividades.';
$string['typetext'] = 'Texto';
$string['typevalue'] = 'Valor';
$string['uncategorised'] = 'Não categorizados';
$string['unchangedgrade'] = 'Nota não alterada';
$string['unenrolledusersinimport'] = 'Essa importação incluiu as seguintes notas para usuários ainda não inscritos no curso: {$a}';
$string['unlimitedgrades'] = 'Notas ilimitadas';
$string['unlimitedgrades_help'] = 'Por padrão as notas são limitadas por valores máximos e mínimos do item de nota. Habilitar esta opção remove este limite e permite que notas acima de 100% sejam incluídas diretamente no livro de notas. É recomendado que esta opção seja habilitada num momento fora de pico, pois todas as notas serão recalculadas, o que deve resultar em uma alta carga do sistema.';
$string['unlock'] = 'Destravar';
$string['unlockverbose'] = 'Desbloquear {$a->category} : {$a->itemmodule} : {$a->itemname}';
$string['unused'] = 'Não usado';
$string['updatedgradesonly'] = 'Exportar novas ou apenas notas atualizadas';
$string['uploadgrades'] = 'Enviar notas';
$string['useadvanced'] = 'Usar Instrumentos Avançados';
$string['usedcourses'] = 'Cursos utilizados';
$string['usedgradeitem'] = 'Itens de nota utilizados';
$string['usenooutcome'] = 'Não usar resultados da aprendizagem';
$string['usenoscale'] = 'Não usar escalas';
$string['usepercent'] = 'Usar percentagens';
$string['user'] = 'Usuário';
$string['userenrolmentsuspended'] = 'Inscrição de usuário suspensa';
$string['usergrade'] = 'Usuário {$a->fullname} ({$a->useridnumber}) no item {$a->gradeidnumber}';
$string['userpreferences'] = 'Preferências de usuário';
$string['useweighted'] = 'Usar ponderações';
$string['verbosescales'] = 'Escalas não numéricas';
$string['viewbygroup'] = 'Grupo';
$string['viewgrades'] = 'Ver notas';
$string['warningexcludedsum'] = 'Atenção: exclusão de notas não é compatível com agregação do tipo soma.';
$string['weight'] = 'peso';
$string['weightcourse'] = 'Usar médias ponderadas nesse curso';
$string['weightedascending'] = 'Ordem crescente por percentagens ponderadas';
$string['weighteddescending'] = 'Ordem decrescente por percentagens ponderadas';
$string['weightedpct'] = 'ponderadas %';
$string['weightedpctcontribution'] = 'ponderadas % contribuição';
$string['weightorextracredit'] = 'Peso ou crédito extra';
$string['weights'] = 'Pesos';
$string['weightsedit'] = 'Editar pesos e créditos extras';
$string['weightuc'] = 'Peso';
$string['writinggradebookinfo'] = 'Escrevendo configurações do Livro de notas';
$string['xml'] = 'XML';
$string['yes'] = 'Sim';
$string['yourgrade'] = 'Sua nota';
