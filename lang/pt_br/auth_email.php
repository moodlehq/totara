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
 * Strings for component 'auth_email', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_emaildescription'] = 'Confirmação via correio eletrônico é o método de autenticação predefinido. Depois que o usuário se inscrever, escolhendo o nome de usuário e a senha, receberá uma mensagem de confirmação via Email. Essa mensagem contém um link seguro a uma página onde o usuário deve confirmar a sua inscrição. Quando o usuário preencher os campos relativos ao nome de usuário e à senha na página de ingresso, estes dados serão confrontados com os valores arquivados na base de dados.';
$string['auth_emailnoemail'] = 'A tentativa de lhe enviar um email falhou!';
$string['auth_emailrecaptcha'] = 'Adiciona uma confirmação visual/sonora para o formulário da página de inscrição, nos registros por e-mail. Isso protege seu site contra spammers e contribui para uma causa que vale à pena. Veja http://recaptcha.net/learnmore.html para mais detalhes.';
$string['auth_emailrecaptcha_key'] = 'Ativar elemento reCAPTCHA';
$string['auth_emailsettings'] = 'Configurações';
$string['pluginname'] = 'Autenticação via correio eletrônico';
