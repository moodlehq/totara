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
 * Strings for component 'enrol', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actenrolshhdr'] = 'Plugins de inscrição em curso disponíveis';
$string['addinstance'] = 'Adicionar método';
$string['ajaxnext25'] = 'Próximos 25...';
$string['ajaxoneuserfound'] = '1 usuário encontrado';
$string['ajaxxusersfound'] = '{$a} usuários encontrados';
$string['assignnotpermitted'] = 'Você não tem permissão ou não pode atribuir papéis neste curso.';
$string['bulkuseroperation'] = 'Operação em um conjunto de usuários';
$string['configenrolplugins'] = 'Por favor selecione todos os plugins necessários e organize-os na ordem apropriada.';
$string['custominstancename'] = 'Nome personalizado da instância';
$string['defaultenrol'] = 'Adicionar instância a novos cursos';
$string['defaultenrol_desc'] = 'É possível adcionar este plugin a todos os novos cursos por padrão.';
$string['deleteinstanceconfirm'] = 'Você quer realmente excluir a instância do plugin de inscrição "{$a->name}" com {$a->users} usuários inscritos?';
$string['durationdays'] = '{$a} dias';
$string['enrol'] = 'Inscrição';
$string['enrolcandidates'] = 'Usuários não inscritos';
$string['enrolcandidatesmatching'] = 'Usuários não matriculados achados';
$string['enrolcohort'] = 'Inscrever coorte';
$string['enrolcohortusers'] = 'Inscrever usuários';
$string['enrollednewusers'] = '{$a} novos usuários inscritos com sucesso';
$string['enrolledusers'] = 'Usuários inscritos';
$string['enrolledusersmatching'] = 'Usuários matriculados achados';
$string['enrolme'] = 'Faça a minha inscrição neste curso';
$string['enrolmentinstances'] = 'Métodos de inscrição';
$string['enrolmentnew'] = 'Nova inscrição em {$a}';
$string['enrolmentnewuser'] = '{$a->user} fez a inscrição em "{$a->course}"';
$string['enrolmentoptions'] = 'Opções de inscrição';
$string['enrolments'] = 'Inscrições';
$string['enrolnotpermitted'] = 'Você não tem permissão para inscrever alguém neste curso';
$string['enrolperiod'] = 'Período de validade da inscrição';
$string['enroltimeend'] = 'Inscrição termina';
$string['enroltimestart'] = 'Inscrição começa';
$string['enrolusage'] = 'Instâncias / matrículas';
$string['enrolusers'] = 'Inscrever usuários';
$string['errajaxfailedenrol'] = 'Falha ao inscrever usuário';
$string['errajaxsearch'] = 'Erro ao procurar usuários';
$string['erroreditenrolment'] = 'Um erro ocorreu enquanto se tentava editar as inscrições dos usuários';
$string['errorenrolcohort'] = 'Erro ao criar uma instância de sincronização de inscrição de coorte neste curso.';
$string['errorenrolcohortusers'] = 'Erro ao inscrever membros do coorte neste curso.';
$string['errorwithbulkoperation'] = 'Ocorreu um erro no processamento das alterações no conjunto de inscrições';
$string['extremovedaction'] = 'Ação para desinscrição externa';
$string['extremovedaction_help'] = 'Selecionar o que deve ser feito quando a inscrição de usuários desaparece de uma fonte externa de inscrições. Note que alguns dadoss de usuários e configurações são apagadas do curso quando é cancelada a matrícula.';
$string['extremovedkeep'] = 'Manter usuário inscrito';
$string['extremovedsuspend'] = 'Desativar inscrição no curso';
$string['extremovedsuspendnoroles'] = 'Desativar inscrição no curso e remover papéis';
$string['extremovedunenrol'] = 'Desinscrever usuário do curso';
$string['finishenrollingusers'] = 'Concluir a inscrição de usuários';
$string['invalidenrolinstance'] = 'Instância de inscrição inválida';
$string['invalidrole'] = 'Papel inválido';
$string['manageenrols'] = 'Gerenciar plugins de inscrição';
$string['manageinstance'] = 'Gerenciar';
$string['nochange'] = 'Nenhuma alteração';
$string['noexistingparticipants'] = 'Nenhum participante existente';
$string['noguestaccess'] = 'Visitantes não podem acessar este curso, por favor tente fazer login.';
$string['none'] = 'Nenhum';
$string['notenrollable'] = 'Você não pode se inscrever neste curso.';
$string['notenrolledusers'] = 'Outros usuários';
$string['otheruserdesc'] = 'Os usuários a seguir não estão matriculados neste curso, mas tem papéis herdados ou atribuidos dentro do curso.';
$string['participationactive'] = 'Ativo';
$string['participationstatus'] = 'Estado';
$string['participationsuspended'] = 'Suspenso';
$string['periodend'] = 'até {$a}';
$string['periodstart'] = 'de {$a}';
$string['periodstartend'] = 'de {$a->start} até {$a->end}';
$string['recovergrades'] = 'Restaurar as notas antigas do usuário se possível';
$string['rolefromcategory'] = '{$a->role} (Herdado da categoria do curso)';
$string['rolefrommetacourse'] = '{$a->role} (Herdado de curso pai)';
$string['rolefromsystem'] = '	
{$a->role} (Atribuído no nível do site)';
$string['rolefromthiscourse'] = '{$a->role} (Atribuído neste curso)';
$string['startdatetoday'] = 'Hoje';
$string['synced'] = 'Sincronizadas';
$string['totalenrolledusers'] = '{$a} usuários inscritos';
$string['totalotherusers'] = '{$a} outros usuários';
$string['unassignnotpermitted'] = 'Você não tem permissão para retirar papéis neste curso';
$string['unenrol'] = 'Cancelar inscrição';
$string['unenrolconfirm'] = 'Você quer mesmo desinscrever o usuário "{$a->user}" do curso "{$a->course}"?';
$string['unenrolme'] = 'Cancelar a minha inscrição no curso {$a}';
$string['unenrolnotpermitted'] = 'Você não tem permissão ou não pode desinscrever este usuário deste curso.';
$string['unenrolroleusers'] = 'Cancelar inscrições';
$string['uninstallconfirm'] = 'Você está prestes a excluir completamente o plugin de inscrição \'{$a}\'. Isto excluirá totalmente qualquer informação no banco de dados associada com esta forma de inscrição. Tem CERTEZA que deseja continuar?';
$string['uninstalldeletefiles'] = 'Todos os dados associados ao plugin de inscrição \'{$a->plugin}\' foram excluídos do banco de dados. Para completar a exclusão (e evitar que se reinstale), você deve excluir o diretório {$a->directory} do seu servidor.';
$string['unknowajaxaction'] = 'Ação solicitada desconhecida';
$string['unlimitedduration'] = 'Ilimitado';
$string['usersearch'] = 'Busca';
$string['withselectedusers'] = 'Com os usuários selecionados';
