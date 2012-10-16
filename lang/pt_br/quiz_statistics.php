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
 * Strings for component 'quiz_statistics', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   quiz_statistics
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actualresponse'] = 'Resposta atual';
$string['allattempts'] = 'todas as tentativas';
$string['allattemptsavg'] = 'Nota média de todas as tentativas';
$string['allattemptscount'] = 'Número total de tentativas avaliadas';
$string['analysisofresponses'] = 'Análise das respostas';
$string['analysisofresponsesfor'] = 'Análise das respostas para {$a}.';
$string['attempts'] = 'Tentativas';
$string['attemptsall'] = 'todas as tentativas';
$string['attemptsfirst'] = 'primeira tentativa';
$string['backtoquizreport'] = 'Retornar para a página principal de estatísticas.';
$string['calculatefrom'] = 'Calcular estatísticas de';
$string['cic'] = 'Coeficiente de consistência interna (para {$a})';
$string['completestatsfilename'] = 'Status';
$string['count'] = 'Número';
$string['coursename'] = 'Nome do curso';
$string['detailedanalysis'] = 'Análise mais detalhada das respostas para esta pergunta';
$string['discrimination_index'] = 'Índice de discriminação';
$string['discriminative_efficiency'] = 'Eficiência de discriminação';
$string['downloadeverything'] = 'Baixar relatório completo como';
$string['duration'] = 'Abrir para';
$string['effective_weight'] = 'Peso efetivo';
$string['errordeleting'] = 'Erro excluindo {$a} antigos registros.';
$string['erroritemappearsmorethanoncewithdifferentweight'] = 'A questão ({$a}) aparece mais uma vez com pesos diferentes em diferentes posições do teste. Isto não é suportado pelo relatório de estatísticas e poderá tornar as estatísticas para esta pergunta não confiáveis.';
$string['errormedian'] = 'Erro ao buscar mediana';
$string['errorpowerquestions'] = 'Erro ao buscar dados para calcular a variância para os graus de interrogação';
$string['errorpowers'] = 'Erro ao buscar dados para calcular variância para notas do questionário';
$string['errorrandom'] = 'Erro obtendo dados de sub-item';
$string['errorratio'] = 'Taxa de erro (para {$a})';
$string['errorstatisticsquestions'] = 'Erro ao buscar dados para calcular estatísticas para notas da questão';
$string['facility'] = 'Índice de facilidade';
$string['firstattempts'] = 'primeira tentativa';
$string['firstattemptsavg'] = 'Nota média das primeiras tentativas';
$string['firstattemptscount'] = 'Quantidade de primeiras tentativas avaliadas';
$string['frequency'] = 'Frequência';
$string['intended_weight'] = 'Peso planejado';
$string['kurtosis'] = 'Pontuação de distribuição curtose (para {$a})';
$string['lastcalculated'] = 'Último cálculo {$a->lastcalculated} anterior onde houve {$a->count} tentativas desde então.';
$string['median'] = 'Nota mediana (para {$a})';
$string['modelresponse'] = 'Resposta do modelo';
$string['negcovar'] = 'Covariância negativa da nota com a nota total da tentativa';
$string['negcovar_help'] = 'A nota desta pergunta para esse conjunto de tentativas no questionário varia de maneira oposta ao da nota de todas as tentativas. Isso significa qua a nota de todas as tentativas tende a estar abaixo da média quando a nota para esta pergunta está acima da média e vice-versa.

Nossa equação de peso efetivo da pergunta não pode ser calculado neste caso. Os cálculos de peso efetivo da pergunta para as outras questões neste questionário são o peso efetivo de pergunta para estas questões se as questões em destaque com uma covariância negativa é dada para uma avaliação máxima de zero.

Se você editar um questionário e atribuir a esta(s) pergunta(s) com covariância negativa um máximo grau de zero, então o peso efetivo para estas questões será zero e o peso efetivo da pergunta das outras perguntas serão calculados agora.';
$string['nostudentsingroup'] = 'Ainda não há estudantes no grupo';
$string['optiongrade'] = 'Crédito parcial';
$string['pluginname'] = 'Estatísticas';
$string['position'] = 'Posição';
$string['positions'] = 'Posição(ões)';
$string['questioninformation'] = 'Informação da pergunta';
$string['questionname'] = 'Nome da questão';
$string['questionnumber'] = 'Q#';
$string['questionstatistics'] = 'Estatísticas das perguntas';
$string['questionstatsfilename'] = 'Status da questão';
$string['questiontype'] = 'Tipo de questão';
$string['quizinformation'] = 'Informação do questionário';
$string['quizname'] = 'Nome do questionário';
$string['quizoverallstatistics'] = 'Teste estatísticas globais';
$string['quizstructureanalysis'] = 'Análise da estrutura do questionário';
$string['random_guess_score'] = 'Pontuação aleatória estimada';
$string['recalculatenow'] = 'Recalcular agora';
$string['response'] = 'Resposta';
$string['skewness'] = 'Assimetría da distribuição de puntuação (para {$a})';
$string['standarddeviation'] = 'Desvio padrão (para {$a})';
$string['standarddeviationq'] = 'Desvio padrão ';
$string['standarderror'] = 'Erro padrão (para {$a})';
$string['statistics'] = 'Estatísticas';
$string['statistics:componentname'] = 'Relatório de esteatíticas do questionário';
$string['statisticsreport'] = 'Relatório de estatísticas';
$string['statisticsreportgraph'] = 'Estatística das posições da pergunta ';
$string['statistics:view'] = 'Ver relatório de estatísticas';
$string['statsfor'] = 'Quiz de estatísticas (por {$a})';
