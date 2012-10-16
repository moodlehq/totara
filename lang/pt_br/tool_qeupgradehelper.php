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
 * Strings for component 'tool_qeupgradehelper', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_qeupgradehelper
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Ação';
$string['alreadydone'] = 'Tudo já foi convertido';
$string['areyousure'] = 'Tem certeza?';
$string['areyousuremessage'] = 'Você quer prosseguir atualizando todas as {$a->numtoconvert} tentativas deste questionário \'{$a->name}\' no curso {$a->shortname}?';
$string['areyousureresetmessage'] = 'Questionário \'{$a->name}\' no curso {$a->shortname} tem {$a->totalattempts} tentativas, das quais {$a->convertedattempts} foram atualizadas a partir do sistema antigo. Dessas, {$a->resettableattempts} podem ter o upgrade desfeito para uma futura conversão. Você quer prosseguir?';
$string['attemptstoconvert'] = 'Tentativas necessitando conversão';
$string['backtoindex'] = 'Voltar à página inicial';
$string['conversioncomplete'] = 'Conversão completa';
$string['convertattempts'] = 'Converter tentativas';
$string['convertedattempts'] = 'Tentativas convertidas';
$string['convertquiz'] = 'Converter tentativas...';
$string['cronenabled'] = 'Cron habilitado';
$string['croninstructions'] = 'Vocẽ pode habilitar o cron para completar automaticamente a atualização com atualizações parciais. O cron irá rodar em horas configuradas do dia (de acordo com a hora local do servidor). Cada vez que o cron rodar, serão processadas um número de tentativas até o Tempo limite configurado. então o processo é interrompido até o próxima vez. Mesmo que você tenha configurado o cron, este não fará nada até que seja detectado que o upgrade para o 2.1 seja terminado.';
$string['cronprocesingtime'] = 'Tempo de processamento do cron';
$string['cronsetup'] = 'Configurar cron';
$string['cronsetup_desc'] = 'Você pode configura o cron para completar a atualização das tentativas do questionário automaticamente.';
$string['cronstarthour'] = 'Hora de início';
$string['cronstophour'] = 'Hora de fim';
$string['extracttestcase'] = 'Remover caso teste';
$string['extracttestcase_desc'] = 'Usa dados de exemplo da base de dados para criar teste unitários que pode ser usados para testar a atualização.';
$string['gotoindex'] = 'Voltar para a lista de questionários que podem ser atualizados';
$string['gotoquizreport'] = 'Ir para o relatório deste questionário para checar a atualização';
$string['gotoresetlink'] = 'Ir para a lista de questionários que podem ser reconfigurados';
$string['includedintheupgrade'] = 'Incluídos na atualização?';
$string['invalidquizid'] = 'Id de questionário inválido. Ou o questionário não existe ou não possui tentativas a converter.';
$string['listpreupgrade'] = 'Listar questionários e tentativas';
$string['listpreupgrade_desc'] = 'Isto mostrará um relatório de todos os questionários do sistema e quantas tentativas eles tem. Isso te dará uma ideia geral da atualização a ser feita.';
$string['listpreupgradeintro'] = 'Estes são os números de tentativas que serão processadas quando você atualizar seu site. Algumas dezenas de milhar não são um problema. Se você tem muito mais do que isso, você precisará pensar quanto tempo a atualização vai levar.';
$string['listtodo'] = 'Lista questionários com atualização pendente';
$string['listtodo_desc'] = 'Aqui você verá um relatório de todos os questionário do sistema (se houver algum) que possui(em) tentativa(s) que precisa(m) ser atualizada(s) para a nova infra-estrutura de questões.';
$string['listtodointro'] = 'Estes são todos os questionários com dados de tentativas que ainda precisam ser convertidos. Você pode pode converter as tentativas clicando no link.';
$string['listupgraded'] = 'Listar questionários já convertidos que podem ser revertidos';
$string['listupgraded_desc'] = 'Aqui você verá um relatório de todos os questionários do sistema cujas tentativas foram migradas mas que ainda possuem dados no formato antigo, assim você pode reverter e refazer a migração.';
$string['listupgradedintro'] = 'Estes são todos os questionários que possuem tentativas que foram migradas mas os dados antigos continuam lá, assim você pode reverter a migração e refazer o processo.';
$string['noquizattempts'] = 'Seu site não tem tentativas de questionário.';
$string['nothingupgradedyet'] = 'Nenhuma tentativa migrada pode ser revertida';
$string['notupgradedsiterequired'] = 'Esta rotina só funciona antes que o site ser atualizado.';
$string['numberofattempts'] = 'Número de tentativas em questionários';
$string['oldsitedetected'] = 'Este parece ser um site que ainda não foi atualizado para incluir a nova infra-estrutura de questões.';
$string['outof'] = '{$a->some} de um total de {$a->total}';
$string['pluginname'] = 'Ajuda para atualização de questões';
$string['pretendupgrade'] = 'Faça um ensaio da atualização de tnetativas';
$string['pretendupgrade_desc'] = 'A migração faz três coisas: Carrega os dados existentes da base de dados; os transforma; então escreve os dados transformados na base novamente. Esta rotina ira testar as primeiras duas partes do processo.';
$string['questionsessions'] = 'Seções de questão';
$string['quizid'] = 'Id do questionário';
$string['quizupgrade'] = 'Status de atualização do questionário';
$string['quizzesthatcanbereset'] = 'Os seguintes questionários possuem tentativas convertidas que podem ser revertidas';
$string['quizzestobeupgraded'] = 'Todos os questionários com tentativas';
$string['quizzeswithunconverted'] = 'Os seguintes questionários possuem tentativas que precisam ser convertidas';
$string['resetcomplete'] = 'Reversão completa';
$string['resetquiz'] = 'Reverter tentativas...';
$string['resettingquizattempts'] = 'Revertendo tentativas do questionário';
$string['resettingquizattemptsprogress'] = 'Revertendo tentativa {$a->done} / {$a->outof}';
$string['upgradedsitedetected'] = 'Este parece ser um site que foi atualizado para incluir a nova infra-estrutura de questões.';
$string['upgradedsiterequired'] = 'Esta rotina só pode ser usada depois da atualização do site.';
$string['upgradingquizattempts'] = 'Atualizando tentativas para o questionário \'{$a->name}\' no curso {$a->shortname}';
$string['veryoldattemtps'] = 'Seu site tem {$a} tentativas de questionários que nunca foram completamente migradas do Moodle 1.4 para o Moodle 1.5. Estas tentativas serão tratadas antes da migração principal. Você terá que levar em conta o tempo extra necessário para esta operação.';
