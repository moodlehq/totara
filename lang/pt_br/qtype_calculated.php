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
 * Strings for component 'qtype_calculated', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_calculated
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['additem'] = 'Adicionar item';
$string['addmoreanswerblanks'] = 'Adicionar outra resposta vazia';
$string['addmoreunitblanks'] = 'Espaços em branco para mais {$a} unidades';
$string['addsets'] = 'Adicionar conjunto(s)';
$string['answerhdr'] = 'Resposta';
$string['answerstoleranceparam'] = ' Parâmetros de tolerância de respostas ';
$string['answerwithtolerance'] = '{$a->answer} (±{$a->tolerance} {$a->tolerancetype})';
$string['anyvalue'] = 'Qualquer valor';
$string['atleastoneanswer'] = 'Você precisa fornecer no mínimo uma resposta.';
$string['atleastonerealdataset'] = 'Deve haver pelo menos um conjunto de dados reais no texto da pergunta';
$string['atleastonewildcard'] = 'Deve haver pelo menos um curinga na fórmula de resposta ou texto da pergunta';
$string['calcdistribution'] = 'Distribuição';
$string['calclength'] = 'Casas decimais';
$string['calcmax'] = 'Máximo';
$string['calcmin'] = 'Mínimo';
$string['choosedatasetproperties'] = 'Escolha propriedades curingas de conjunto de dados (<em>dataset</em>)';
$string['choosedatasetproperties_help'] = 'Um conjunto de dados (<em>dataset</em>) é um conjunto de valores inseridos no lugar de um curinga. Você pode criar um conjunto de dados privados de uma questão específica, ou um conjunto de dados compartilhado que pode ser usado para outras questões de cálculo na categoria.';
$string['correctanswerformula'] = 'Fórmula de resposta correta';
$string['correctanswershows'] = 'Mostrar respostas certas';
$string['correctanswershowsformat'] = 'Formato';
$string['correctfeedback'] = 'Para qualquer resposta correta';
$string['dataitemdefined'] = 'disponível com {$a} valores numéricos já definidos';
$string['datasetrole'] = 'Os curingas <strong>{x..}</strong> serão substituídos por um valor numérico de seu conjunto de dados';
$string['decimals'] = 'com {$a}';
$string['deleteitem'] = 'Excluir item';
$string['deletelastitem'] = 'Excluir último item';
$string['editdatasets'] = 'Editar os conjuntos de dados curingas';
$string['editdatasets_help'] = 'Os valores curinga podem ser criados digitando-se um número em cada campo de curinga e, em seguida, clicando-se no botão \'adicionar\'. Para gerar automaticamente 10 ou mais valores, selecione o número de valores necessários antes de clicar no botão \'adicionar\'. Uma distribuição uniforme significa que todos os valores entre os limites têm igual probabilidade de ser gerado; uma distribuição loguniforme significa que os valores mais próximos ao limite inferior são mais prováveis.';
$string['existingcategory1'] = 'Usará um conjunto compartilhado de dados já existente';
$string['existingcategory2'] = 'um arquivo de um conjunto já existente de arquivos que são usados também por outras questões nesta categoria';
$string['existingcategory3'] = 'um link de um conjunto já existente de links que são também utilizados por outras questões nesta categoria';
$string['forceregeneration'] = 'forçar re-geração';
$string['forceregenerationall'] = 'forçar re-geração com todos os curingas';
$string['forceregenerationshared'] = 'forçar re-geração apenas de curingas não compartilhados';
$string['functiontakesatleasttwo'] = 'A função {$a} precisa ter pelo menos dois argumentos';
$string['functiontakesnoargs'] = 'A função {$a} não toma nenhum argumento';
$string['functiontakesonearg'] = 'A função {$a} precisa de, exatamente um argumento';
$string['functiontakesoneortwoargs'] = 'A função {$a} precisa ter um ou dois argumentos';
$string['functiontakestwoargs'] = 'A função {$a} precisa de, exatamente, dois argumentos';
$string['generatevalue'] = 'Gerar um novo valor entre';
$string['getnextnow'] = 'Obter um novo "Item a adicionar" agora';
$string['hexanotallowed'] = 'Conjunto de dados <strong>{$a->name}</strong> no formato format do valor {$a->valor} não é permitido.';
$string['illegalformulasyntax'] = 'Sintaxe de fórmula ilagal inicada com \'[$a}\'';
$string['incorrectfeedback'] = 'Para qualquer resposta incorreta';
$string['itemno'] = 'Item {$a}';
$string['itemscount'] = 'Itens<br />Resultado';
$string['itemtoadd'] = 'Item a adicionar';
$string['keptcategory1'] = 'Usará o mesmo conjunto compartilhado de dados já existente, como antes';
$string['keptcategory2'] = 'um arquivo da mesma categoria conjunto reutilizável de arquivos como antes';
$string['keptcategory3'] = 'um link a partir do conjunto mesma categoria reutilizável de links como antes';
$string['keptlocal1'] = 'Usará o mesmo conjunto de dados privados já existente, como antes';
$string['keptlocal2'] = 'um arquivo a partir do conjunto mesma questão privada de arquivos como antes';
$string['keptlocal3'] = 'um link a partir do conjunto mesma questão privada de links como antes';
$string['loguniform'] = 'Loguniforme';
$string['loguniformbit'] = 'digitos, de uma distribuição loguniforme';
$string['makecopynextpage'] = 'Próxima página (nova questão)';
$string['mandatoryhdr'] = 'Caracteres curingas obrigatórios presentes nas respostas';
$string['max'] = 'Máximo';
$string['min'] = 'Mínimo';
$string['minmax'] = 'Faixa de valores';
$string['missingformula'] = 'Formula faltante';
$string['missingname'] = 'Nome de questão faltante';
$string['missingquestiontext'] = 'Texto da questão faltante';
$string['mustbenumeric'] = 'Você deve inserir um número aqui.';
$string['mustenteraformulaorstar'] = 'Você precisa digitar uma fórmula ou \'*\'.';
$string['mustnotbenumeric'] = 'Isto não pode ser um número.';
$string['newcategory1'] = 'Usará um novo conjunto de dados compartilhado';
$string['newcategory2'] = 'um arquivo de um novo conjunto de ficheiros que podem também ser utilizados por outras questões nesta categoria';
$string['newcategory3'] = 'uma ligação de um novo conjunto de ligações que podem também ser utilizados por outras questões nesta categoria';
$string['newlocal1'] = 'Usará um novo conjunto de dados privado';
$string['newlocal2'] = 'um arquivo de um novo conjunto de arquivos que será usado apenas por esta questão';
$string['newlocal3'] = 'um link de um novo conjunto de links que só serão usados por esta pergunta';
$string['newsetwildcardvalues'] = 'novo(s) conjunto(s) de valor(es) curinga(s)';
$string['nextitemtoadd'] = 'Próximo "item a acrescentar"';
$string['nextpage'] = 'Próxima página';
$string['nocoherencequestionsdatyasetcategory'] = 'Para a identificação de questão {$a->qid}, a identificação da categoria {$a->qcat} não é identica com o curinga compartilhado {$a->name} com a identificação da categoria {$a->sharedcat}. Editar a pergunta.';
$string['nocommaallowed'] = 'A vírgula (,) não poder ser utilizada. Utilize ponto (.), como em 0.013 ou em 1.3e-2';
$string['nodataset'] = 'nada - isto não é um caractere curinga';
$string['nosharedwildcard'] = 'Nenhum caractere curinga compartilhado nesta categoria';
$string['notvalidnumber'] = 'O valor do curinga não é um valor válido.';
$string['oneanswertrueansweroutsidelimits'] = 'Pelo menos uma resposta correta está fora dos limites de valor real. <br /> Modificar as configurações de tolerância de respostas disponíveis como \'Parâmetros avançados\'.';
$string['param'] = 'Parâmetro {<strong>{$a}</strong>}';
$string['partiallycorrectfeedback'] = 'Para qualquer resposra parcialmente correta';
$string['pluginname'] = 'Calculado';
$string['pluginnameadding'] = 'Adicionar uma pergunta calculada';
$string['pluginnameediting'] = 'Editando uma pergunta calculada';
$string['pluginname_help'] = 'Perguntas calculadas permitem questões numéricas individuais a serem criadas usando curingas em chaves que são substituídos com valores individuais quando o questionário é preenchido. Por exemplo, a pergunta "Qual é a área de um retângulo de comprimento {l} e largura {w}?" teria fórmula resposta correta "{l}*{W}" (onde * denota a multiplicação).';
$string['pluginnamesummary'] = 'As perguntas calculadas são como perguntas numéricas, mas com os números utilizados sorteados a partir de um conjunto quando o questionário é preenchido.';
$string['possiblehdr'] = 'Possíveis caracteres curingas presentes somente no texto da questão';
$string['questiondatasets'] = 'Conjunto de dados de questão';
$string['questiondatasets_help'] = 'Conjunto de dados de questão de curingas que serão utilizados em cada pergunta individual.';
$string['questionstoredname'] = 'Nome memorizado da pergunta';
$string['replacewithrandom'] = 'Substitua com um valor aleatório';
$string['reuseifpossible'] = 'reutilizar valor prévio se disponível';
$string['setno'] = 'Conjunto {$a}';
$string['setwildcardvalues'] = 'Conjunto de valores curingas';
$string['sharedwildcard'] = 'Curinga compartilhado <strong>{$a}</strong>';
$string['sharedwildcardname'] = 'Curinga compartilhado';
$string['sharedwildcards'] = 'Curingas compartilhados';
$string['showitems'] = 'Exibir';
$string['significantfigures'] = 'com {$a}';
$string['significantfiguresformat'] = 'algarismos significativos';
$string['synchronize'] = 'Sincronizar os dados de conjuntos compartilhados com outras perguntas do questionário.';
$string['synchronizeno'] = 'Não sincronizar';
$string['synchronizeyes'] = 'Sincronizar';
$string['synchronizeyesdisplay'] = 'Sincronizar e exibir o nome dos conjuntos de dados compartilhados como prefixo do nome da pergunta';
$string['tolerance'] = 'Tolerância &plusmn;';
$string['trueanswerinsidelimits'] = 'Resposta certa: {$a->correct} limites internos de valores verdadeiros {$a->true}';
$string['trueansweroutsidelimits'] = '<span class="error">ERRO Resposta certa: {$a->correct} limites externos de valores verdadeiros {$a->true}</span>';
$string['uniform'] = 'Uniforme';
$string['uniformbit'] = 'Decimais, a partir de distribuição uniforme';
$string['unsupportedformulafunction'] = 'A função {$a} não é suportada';
$string['updatecategory'] = 'Atualizar a categoria';
$string['updatedatasetparam'] = 'Atualizar os parâmetros dos conjuntos de dados';
$string['updatetolerancesparam'] = 'Atualizar os as tolerãncias dos parâmetros das respostas';
$string['updatewildcardvalues'] = 'Atualizar os valores curingas';
$string['useadvance'] = 'Utilize o botão \'avançar\' para ver os erros';
$string['usedinquestion'] = 'Usado na questão';
$string['wildcard'] = 'Curinga {<strong>{$a}</strong>}';
$string['wildcardparam'] = 'Parâmetros de curingas utilizados para gerar os valores';
$string['wildcardrole'] = 'Os curinga <strong>{x..}</strong> serão substituídos por um valor numérico para gerar valores';
$string['wildcards'] = 'Valores {a}...{z}';
$string['wildcardvalues'] = 'Valor(es) curinga(s)';
$string['wildcardvaluesgenerated'] = 'Valor(es) curinga(s) gerado(s)';
$string['youmustaddatleastoneitem'] = 'Vocè precisa adicionar, ao menos, um conjunto de dados antes de gravar esta pergunta.';
$string['youmustaddatleastonevalue'] = 'Vocè precisa adicionar, ao menos, um conjunto de curinga antes de gravar esta pergunta.';
$string['youmustenteramultiplierhere'] = 'Você deve inserir um multiplicador aqui.';
$string['zerosignificantfiguresnotallowed'] = 'A resposta correta não pode conter nenhuma figura significante!';
