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
 * Strings for component 'tool_unittest', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_unittest
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addconfigprefix'] = 'Adicionar prefixo ao arquivo de configuração';
$string['all'] = 'TUDO';
$string['codecoverageanalysis'] = 'Realizar análise de cobertura de código.';
$string['codecoveragecompletereport'] = '(ver relatório de cobertura de código completo)';
$string['codecoveragedisabled'] = 'Não é possível permitir a cobertura de código neste servidor (falta a extensão xdebug)';
$string['codecoveragelatestdetails'] = '(Em {$a->date}, com arquivos {$a->files}, {$a->percentage} coberto)';
$string['codecoveragelatestreport'] = 'Exibir último relatório de cobertura de código completo';
$string['confignonwritable'] = 'O config.php arquivo não é gravável pelo servidor web. Altere suas permissões, ou editá-lo com a conta de usuário apropriado e adicionar a seguinte linha antes da tag de fechamento php: <br /> $ CFG-&gt; unittestprefix = \'tst_\' / Alterar / tst_ a um prefixo de sua escolha, diferente de $ CFG-&gt; prefix';
$string['coveredlines'] = 'Linhas cobertas';
$string['coveredpercentage'] = 'Cobertura de código global';
$string['dbtest'] = 'Testes funcionais de Banco de Dados';
$string['deletingnoninsertedrecord'] = 'Tentando apagar um registro que não foi inserida por esses testes de unidade (ID {$a->id} em {$a->table} tabela).';
$string['deletingnoninsertedrecords'] = 'Tentando apagar registros que não foram inseridos por esses testes de unidade (de {$a->table} tabela).';
$string['droptesttables'] = 'Deletar tabelas de teste';
$string['exception'] = 'Exceção';
$string['executablelines'] = 'Linhas executáveis';
$string['fail'] = 'Falhou';
$string['ignorefile'] = 'Ignorar testes no arquivo';
$string['ignorethisfile'] = 'Refazer os testes ignorando esse arquivo.';
$string['installtesttables'] = 'Instalar tabelas de teste';
$string['moodleunittests'] = 'Testes de unidade do moodle: {$a}';
$string['notice'] = 'Aviso';
$string['onlytest'] = 'Somente rodar testes em';
$string['othertestpages'] = 'Outras páginas de teste';
$string['pass'] = 'Passou';
$string['pathdoesnotexist'] = 'O caminho \'{$a}\' não foi encontrado.';
$string['pluginname'] = 'Testes de unidade';
$string['prefix'] = 'Tabela de prefixos de teste unitário';
$string['prefixnotset'] = 'A unidade de teste de prefixo de tabela de banco de dados não está configurado. Preencha e envie este formulário para adicioná-lo config.php.';
$string['reinstalltesttables'] = 'Reinstalar tabelas de teste';
$string['retest'] = 'Fazer os testes novamente';
$string['retestonlythisfile'] = 'Refazer somente esse arquivo de teste.';
$string['runall'] = 'Rodar os testes de todos os arquivos.';
$string['runat'] = 'Rodar em {$a}.';
$string['runonlyfile'] = 'Rodar somente os testes desse arquivo';
$string['runonlyfolder'] = 'Rodar somente os testes dessa pasta';
$string['runtests'] = 'Rodar testes';
$string['rununittests'] = 'Fazer os testes de unidade';
$string['showpasses'] = 'Mostrar sucessos e falhas.';
$string['showsearch'] = 'Mostrar pesquisa por arquivos de teste.';
$string['skip'] = 'Avançar';
$string['stacktrace'] = 'Levantamento das pilhas de execução (Stack Trace):';
$string['summary'] = '{$a->run}/{$a->total} testes completados:
<strong>{$a->passes}</strong> com sucesso, <strong>{$a->fails}</strong> falhas e <strong>{$a->exceptions}</strong> exceções.';
$string['tablesnotsetup'] = 'Tabelas de teste de unidade ainda não estão construídos. Você quer construí-los agora?.';
$string['testdboperations'] = 'Operações de teste de base de dados';
$string['testtablescsvfileunwritable'] = 'O teste de tabelas de arquivo CSV não é gravável ({$a->filename})';
$string['testtablesneedupgrade'] = 'A tabela de testes DB necessita realizar atualização. Deseja proceder com o upgrade neste momento?';
$string['testtablesok'] = 'As tabelas de teste do BD foram instaladas com sucesso.';
$string['thorough'] = 'Fazer um teste completo (pode ser lento).';
$string['timetakes'] = 'Tempo decorrido: {$a}';
$string['totallines'] = 'Total de linhas';
$string['uncaughtexception'] = 'Exceção desconhecida não capturada [{$a->getMessage()}] no [{$a->getFile()}:{$a->getLine()}] .
TESTES CANCELADOS.';
$string['uncoveredlines'] = 'Linhas descobertas';
$string['unittest:execute'] = 'Executar testes de unidade';
$string['unittestprefixsetting'] = 'Prefixo teste de unidade: <strong>{$a->unittestprefix}</strong> (Editar config.php para modificar isso).';
$string['unittests'] = 'Testes de unidade';
$string['updatingnoninsertedrecord'] = 'Tentando atualizar um registro que não foi inserida por esses testes de unidade (ID {$a->id} em {$a->table} tabela).';
$string['version'] = 'Usando <a href="http://sourceforge.net/projects/simpletest/">SimpleTest</a> versão {$a}.';
