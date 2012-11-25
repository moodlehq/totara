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
 * Strings for component 'condition', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'Adicionar (não) condições de atividades ao formulário';
$string['addgrades'] = 'Adicionar (não) condições de avaliação ao formulário';
$string['availabilityconditions'] = 'Acesso restrito';
$string['availablefrom'] = 'Permitir o acesso de';
$string['availablefrom_help'] = 'As datas de acesso desde/até determinam quando os cursistas podem ter acesso às atividades pelas referências na página do curso.
A diferença entre as data de acesso deste/até e a configuração de data de disponibilidade da atividade é que fora das datas configuradas esta última opção permite que os cursistas vejam a descrição da atividade, enquanto as datas de acesso desde/até impede qualquer acesso.';
$string['availableuntil'] = 'Permitir o acesso até';
$string['badavailabledates'] = 'Datas inválidas. Se você definir ambas as datas, a data "Permitir acesso de " deve ser anterior à data "até".';
$string['badgradelimits'] = 'Caso você escolha um limite de nota alto e baixo, o limite alto deve ser maior que o limite baixo.';
$string['completion_complete'] = 'deve ser marcada como concluída';
$string['completion_fail'] = 'deve ser concluída com nota de reprovação';
$string['completion_incomplete'] = 'não deve ser marcada como concluída';
$string['completion_pass'] = 'deve ser concluída com nota de aprovação';
$string['completioncondition'] = 'Condição de conclusão de atividades';
$string['completioncondition_help'] = 'Esta configuração determina qualquer condição de completação de outras atividades que deva ser satisfeita para ter acesso a esta atividade. Note que antes deve ter sido habilitado o acompanhamento de completação de atividades.
Se desejado pode se estabelecer múltiplas condições de completação. Nesse caso, o acesso à atividade só será permitido quando TODAS as condições forem satisfeitas.';
$string['configenableavailability'] = 'Se habilitada, esta opção permite configurar condições que controlam quando é permitido o acesso a uma atividade, baseado em datas, notas ou completação de outras atividades.';
$string['enableavailability'] = 'Permitir o acesso condicional';
$string['grade_atleast'] = 'deve ser pelo menos';
$string['grade_upto'] = 'e menos de';
$string['gradecondition'] = 'Condição para a nota';
$string['gradecondition_help'] = 'Esta configuração determina qualquer condição de avaliação que tenha que ser satisfeita para ter acesso à atividade.
Podem ser estabelecidas condições de avaliação múltiplas. Nesse caso, a atividade só permitirá o acesso quando TODAS as condições de avaliação forem satisfeitas.';
$string['gradeitembutnolimits'] = 'Você deve escolher um limite alto ou baixo , ou ambos.';
$string['gradelimitsbutnoitem'] = 'Você deve escolher um item de nota';
$string['gradesmustbenumeric'] = 'As notas mínimas e máximas devem ser numéricas (ou vazias)';
$string['none'] = '(nenhum)';
$string['notavailableyet'] = 'Não disponível ainda';
$string['requires_completion_0'] = 'Não disponível a menos que a atividade <strong> {$a} </strong> seja completada.';
$string['requires_completion_1'] = 'Não disponível até que a atividade <strong>{$a}</strong> esteja marcada como concluída.';
$string['requires_completion_2'] = 'Não disponível até que a atividade <strong> {$a} </strong> seja completada e aprovada.';
$string['requires_completion_3'] = 'Não disponível a menos que a atividade <strong> {$a} </strong> seja realizada e não aprovada.';
$string['requires_date'] = 'Disponível a partir de {$a}.';
$string['requires_date_before'] = 'Disponível até {$a}.';
$string['requires_date_both'] = 'Disponível de {$a->from} até {$a->until}.';
$string['requires_date_both_single_day'] = 'Disponível em {$a}';
$string['requires_grade_any'] = 'Não disponível até que você tenha uma nota de <strong>{$a}</strong>';
$string['requires_grade_max'] = 'Não disponível a menos que você obtenha a nota necessária em <strong> {$a} </strong>.';
$string['requires_grade_min'] = 'Não disponível até que você atinja a nota necessária em <strong> {$a} </strong>.';
$string['requires_grade_range'] = 'Não está disponível a menos que você consiga uma pontuação particular em <strong>{$a}</strong>.';
$string['showavailability'] = 'Antes da atividade poder ser acessada';
$string['showavailability_hide'] = 'Ocultar atividade inteiramente';
$string['showavailability_show'] = 'Mostrar a atividade em cinza, com informação sobre a restrição';
$string['userrestriction_hidden'] = 'Restrito (completamente oculto, não é mostrada nenhuma mensagem): ‘{$a}’';
$string['userrestriction_visible'] = 'Acesso restrito: ‘{$a}’';
