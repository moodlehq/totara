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
 * Strings for component 'message_email', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   message_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowusermailcharset'] = 'Permitir que usuários escolham set de caracteres';
$string['configallowusermailcharset'] = 'Ativando isto cada usuário do site poderá escolher o próprio conjunto de caracteres para o email.';
$string['configmailnewline'] = 'Caracteres de nova linha utilizados em mensagens de email. CRLF é obrigatório de acordo como RFC822bis, alguns servidores de email fazem a conversão automática de LF para CRLF, outros servidores de email fazem a conversão incorreta de CRLF para CRCRLF, e outros ainda rejeitam emails só com LF (qmail por exemplo). Tente mudar esta configuração caso você esteja tendo problemas com emails não enviados ou linhas em branco a mais.';
$string['confignoreplyaddress'] = 'Mensagens de correio eletrônico são às vezes enviadas em nome de um usuário (por exemplo, as mensagens dos fóruns). O endereço fornecido aqui será usado no campo "De" nos casos em que os destinatários não devam responder diretamente ao usuário (por exemplo, quando o usuário optar por manter seu endereço privado).';
$string['configsitemailcharset'] = 'Todos os emails criados pelo site utilizarão o conjunto de caracteres aqui definido. Para que os usuários possam personalizar esta configuração é necessário ativar a próxima opção.';
$string['configsmtphosts'] = 'Indicar o endereço completo de um ou mais servidores SMTP locais que o Moodle deve utilizar para o envio de correio eletrônico (por exemplo: \'mail.a.com\' or \'mail.a.com;mail.b.com\'). Se deixar em branco, o Moodle usará o método PHP padrão de envio de email.';
$string['configsmtpmaxbulk'] = 'Número máximo de mensagens enviadas por sessão SMTP. Agrupar mensagens pode acelerar o envio de emails. Valores inferiores a 2 forçam a criação de uma nova sessão SMTP para cada email.';
$string['configsmtpuser'] = 'Se você especificou um servidor SMTP acima e o servidor requer autenticação, inserira aqui o usuário e a senha.';
$string['email'] = 'Enviar email de notificações para';
$string['mailnewline'] = 'Caracteres de nova linha no email';
$string['noreplyaddress'] = 'Endereço de No-reply';
$string['pluginname'] = 'Email';
$string['sitemailcharset'] = 'Conjunto de caracteres';
$string['smtphosts'] = 'Servidores SMTP';
$string['smtpmaxbulk'] = 'Limite de sessão SMTP';
$string['smtppass'] = 'Senha de SMTP';
$string['smtpuser'] = 'Usuário do SMTP';
