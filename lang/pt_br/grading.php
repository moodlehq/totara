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
 * Strings for component 'grading', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   grading
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activemethodinfo'] = '\'{$a->method}\' está selecionado como o método de avaliação para a área \'{$a->area}\'';
$string['activemethodinfonone'] = 'Não há nenhum método de avaliação avançado selecionado para a área \'{$a->area}\'. Avaliação simples será usada.';
$string['changeactivemethod'] = 'Muda o método de avaliação para';
$string['clicktoclose'] = 'clique para fechar';
$string['exc_gradingformelement'] = 'Não foi possível inicializar o elemento de formulário de avaliação';
$string['formnotavailable'] = 'Método avançado de avaliação foi selecionado mas o formulário de avaliação ainda não está disponível. Talvez você precise definí-lo por um link no bloco de Administração.';
$string['gradingformunavailable'] = 'Aviso: o formulário de avaliação avançada não está pronto ainda. O método simples de avaliação será usado até que o formulário tenha um status válido.';
$string['gradingmanagement'] = 'Avaliação avançada';
$string['gradingmanagementtitle'] = 'Avaliação avançada: {$a->component} ({$a->area})';
$string['gradingmethod'] = 'Método de avaliação';
$string['gradingmethod_help'] = 'Escolha o método avançado de classificação que deve ser utilizado no contexto atual.

Para desabilitar classificação avançada e retornar ao método de classificação padrão, escolha \'Classificação simples direta\'';
$string['gradingmethodnone'] = 'Método simples de avaliação';
$string['gradingmethods'] = 'Métodos de avaliação';
$string['manageactionclone'] = 'Criar avaliação a partir de um modelo';
$string['manageactiondelete'] = 'Apaga o formulário atualmente definido';
$string['manageactiondeleteconfirm'] = 'Você vai apagar o formulário de avaliação \'{$a->formname}\' e todas as informações associadas do \'{$a->component} ({$a->area})\'. Por favor, certifique-se que entende as seguintes consequencias:

* Não há como reverter essa operação.
* Você pode mudar para outro método de avaliação incluindo o \'Método simples de avaliação\' sem apagar esse formulário.
* Todas as informações sobre como os formulários são preenchidos serão perdidas.
* As notas calculadas guardadas no Caderno de Notas não serão afetadas. Mas a explicação sobre como elas foram calculadas não estarão disponíveis.
* Essa operação não afeta eventuais cópias desse formulário em outras atividades.';
$string['manageactiondeletedone'] = 'O formulário foi excluído com sucesso';
$string['manageactionedit'] = 'Editar a definição atual de formulário';
$string['manageactionnew'] = 'Definir nova avaliação do início';
$string['manageactionshare'] = 'Publicar o formulário como novo modelo';
$string['manageactionshareconfirm'] = 'Você está prestes a fazer uma cópia do formulário de avaliação \'{$a}\' um novo modelo público. Outros usuários do site serão capazes de criar novos formulários de avaliação baseados neste modelo.';
$string['manageactionsharedone'] = 'O formulário foi salvo com sucesso como modelo';
$string['noitemid'] = 'Avaliação não é possível. O item de nota não existe.';
$string['nosharedformfound'] = 'Nenhum modelo encontrado';
$string['searchownforms'] = 'Incluir meus próprios formulários';
$string['searchtemplate'] = 'Busca de formulários de avaliação';
$string['searchtemplate_help'] = 'Você pode procurar pelo formulário de classificação e utilizar como modelo para um novo formulário de classificação aqui.
Simplesmente digite palavras que devem aparecer em algum lugar no nome do formulário, sua descrição ou no próprio corpo do formulário. Para pesquisar por uma frase, escreva a consulta completa digitando aspas duplas ao seu redor.

Por padrão, apenas formulários de classificação que foram salvos como formulários compartilhados serão incluídos nos resultados da pesquisa. Você pode também incluir seu próprio formulário de classificação nos resultados da pesquisa. Deste modo você pode simplesmente reutilizar seu formulário de classificação sem a necessidade de compartilhar o mesmo. Apenas formulários marcados como \'Prontos pra reutilização\' podem ser reutilizados desta maneira.';
$string['statusdraft'] = 'Rascunho';
$string['statusready'] = 'Pronto para uso';
$string['templatedelete'] = 'Excluir';
$string['templatedeleteconfirm'] = 'Você está prestes a apagar o modelo compartilhado \'{$a}\'. Apagá-lo não afetará os formulários que foram criados a partir dele.';
$string['templateedit'] = 'Editar';
$string['templatepick'] = 'Usar este modelo';
$string['templatepickconfirm'] = 'Você quer usar o formulário de avaliação \'{$a->formname}\' como modelo para o novo formulário \'{$a->component} ({$a->area})\'?';
$string['templatepickownform'] = 'Usar este fomulário como modelo';
$string['templatesource'] = 'Localização: {$a->component} ({$a->area})';
$string['templatetypeown'] = 'Meus formulários';
$string['templatetypeshared'] = 'Modelo compartilhado';
