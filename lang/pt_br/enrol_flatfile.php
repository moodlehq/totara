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
 * Strings for component 'enrol_flatfile', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_flatfile
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['filelockedmail'] = 'O arquivo de texto que você está utilizando para fazer as inscrições ({$a}) não pôde ser cancelado pelo processo cron. Isto normalmente significa que a configuração das permissões do arquivo não é compatível. Por favor corrija as permissões para que o sistema possa cancelar o arquivo e impedir que o mesmo seja processado diversas vezes.';
$string['filelockedmailsubject'] = 'Erro importante: Arquivo de inscrição';
$string['location'] = 'Localização do arquivo';
$string['mailadmin'] = 'Avisar administrador via email';
$string['mailstudents'] = 'Notificar alunos por email';
$string['mailteachers'] = 'Notificar professores por email';
$string['mapping'] = 'Mapeamento do arquivo plano';
$string['messageprovider:flatfile_enrolment'] = 'Mensagem de inscrição por arquivo plano';
$string['pluginname'] = 'Arquivo plano (CSV)';
$string['pluginname_desc'] = 'Este método irá verificar repetidamente e processar um arquivo de texto especialmente formatado no local que você especificar. O arquivo é do tipo separado por vírgula e deverá ter quatro ou seis campos por linha:
* <pre class="informationbox">, operação, função, número de identificação (usuário), número de identificação (curso) [, horário de inicio, horário de encerramento], onde:
* operação  = add | del
* função = estudante | professor | professor-editor
* número de itendificação (usuário) = idnumber na tabela de usuário NB não Id
 * número de identificação (curso) = idnumber na tabela de cursos NB não Id
* horário de inicio =  hora de início (em segundos desde a época)
* horário de encerramento =  tempo final (em segundos desde a epoca) - opcional </ pre>
Poderia ser algo assim: <pre class="informationbox">
add, estudante, 5, CF101
add, professor, 6, CF101
add professor-editor, 7, CF101 del, estudante, 8, CF101
del, estudante, 17, CF101
add, estudante, 21, CF101, 1091115000, 1091215000 </ pre>';
