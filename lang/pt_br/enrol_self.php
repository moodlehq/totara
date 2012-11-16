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
 * Strings for component 'enrol_self', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_self
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['customwelcomemessage'] = 'Mensagem de boas vindas padrão';
$string['defaultrole'] = 'Atribuição de papel padrão';
$string['defaultrole_desc'] = 'Selecione o papel que deve ser atribuído aos usuários durante a auto inscrição';
$string['editenrolment'] = 'Editar inscrição';
$string['enrolenddate'] = 'Data final';
$string['enrolenddate_help'] = 'Se habilitado, os usuários podem inscrever-se apenas até esta data.';
$string['enrolenddaterror'] = 'A data de encerramento não pode ser anterior à data de início';
$string['enrolme'] = 'Inscreva-me';
$string['enrolperiod'] = 'Duração da inscrição';
$string['enrolperiod_desc'] = 'Duração padrão do período de inscrição (em segundos). Se for atribuído zero, a duração da inscrição será ilimitada por padrão.';
$string['enrolperiod_help'] = 'Intervalo de tempo no qual a inscrição é válida, iniciando no momento em que o usuário realiza sua inscrição. Caso desabilitado, a duração da inscrição será ilimitada.';
$string['enrolstartdate'] = 'Data de início';
$string['enrolstartdate_help'] = 'Se habilitado, os usuários só podem inscrever-se apenas a partir desta data.';
$string['groupkey'] = 'Usar chaves de inscrição de grupo';
$string['groupkey_desc'] = 'Usar chaves de inscrição de grupo por padrão.';
$string['groupkey_help'] = 'Além de restringir acesso ao curso apenas para aqueles que conhecem a chave, o uso de uma chave de inscrição de grupo faz com que os usuários sejam automaticamente incluídos ao grupo quando eles se inscrevem no curso.
Para utilizar uma chave de inscrição de grupo uma chave de inscrição deve ser definida nas configurações do curso assim como a chave de inscrição de grupo nas configurações de grupo.';
$string['longtimenosee'] = 'Cancelar inscrição de usuário inativo';
$string['longtimenosee_help'] = 'Caso um usuário não tenha acessado um curso por um longo período de tempo, então eles terão sua inscrição automaticamente cancelada. Este parâmetro especifica o limite de tempo';
$string['maxenrolled'] = 'Máximo de usuários inscritos';
$string['maxenrolled_help'] = 'Especifica o número máximo de usuários que podem realizar auto - inscrição. ) significa sem limite.';
$string['maxenrolledreached'] = 'Número máximo de usuários com permissão para auto-inscrição já foi alcançado.';
$string['nopassword'] = 'Nenhuma chave de inscrição é necessária.';
$string['password'] = 'Chave de inscrição';
$string['password_help'] = 'Uma chave de inscrição habilita para que o acesso ao curso seja restrito apenas para quem possua a chave.
Caso este campo esteja vazio, qualquer usuário poderá se inscrever no curso.
Caso uma chave de inscrição seja especificada, em qualquer tentativa de inscrição será solicitada a informação da chave. Note que o usuário apenas precisa informar a chave de inscrição apenas UMA VEZ, no momento em qyue realizam a inscrição.';
$string['passwordinvalid'] = 'Chave de inscrição incorreta, por favor tente novamente';
$string['passwordinvalidhint'] = 'Código de inscrição errado, por favor tente novamente<br /> (uma dica - começa com \'{$a}\')';
$string['pluginname'] = 'Autoinscrição';
$string['pluginname_desc'] = 'O plugin de auto inscrição permite que usuários escolham em quais cursos queiram participar. Os cursos devem ser protegidos por umachave de inscrição. Internamente a inscrição é realizada através do plugin de inscrição manual o qual deve ser habilitado no mesmo curso.';
$string['requirepassword'] = 'Exigir chave de inscrição';
$string['requirepassword_desc'] = 'Requer chave de inscrição em novos cursos e previne remoção de chaves de inscrição de cursos existentes.';
$string['role'] = 'Papel atribuído por padrão';
$string['self:config'] = 'Configurar instâncias de auto-inscrição';
$string['self:manage'] = 'Gerenciar usuários inscritos';
$string['self:unenrol'] = 'Desinscrever usuários do curso';
$string['self:unenrolself'] = 'Desinscrever-se do curso';
$string['sendcoursewelcomemessage'] = 'Enviar mensagem de bem-vindos ao curso';
$string['sendcoursewelcomemessage_help'] = 'Se habilitato os usuários recebem uma mensagem de boas vindas por email quando fazem a inscrição em um curso.';
$string['showhint'] = 'Exibir dica';
$string['showhint_desc'] = 'Exibir primeira letra da chave de acesso de visitantes.';
$string['status'] = 'Permitir autoinscrição';
$string['status_desc'] = 'Permitir que os usuários possam se inscrever no curso por padrão.';
$string['status_help'] = 'Esta configuração determina se um usuário pode se inscrever (e também desinscrever caso tenha a permissão apropriada) em um curso';
$string['unenrol'] = 'Cancelar inscrição do usuário';
$string['unenrolselfconfirm'] = 'Você deseja realmente retirar sua matrícula do curso "{$a}"?';
$string['unenroluser'] = 'Deseja mesmo retirar a inscrição de "{$a->user}" do curso "{$a->course}" ?';
$string['usepasswordpolicy'] = 'Usar política de senha';
$string['usepasswordpolicy_desc'] = 'Utilizar política padrão para chaves de inscrição';
$string['welcometocourse'] = 'Bem-vindo ao curso {$a}';
$string['welcometocoursetext'] = 'Bem vindo ao curso {$a->coursename}!

A primeira coisa a fazer é editar o seu Perfil de Usuário do curso para que possamos saber mais sobre você:

{$a->profileurl}';
