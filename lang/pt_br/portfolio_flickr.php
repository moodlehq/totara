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
 * Strings for component 'portfolio_flickr', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio_flickr
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikey'] = 'Chave API';
$string['contenttype'] = 'Tipos de conteúdo';
$string['err_noapikey'] = 'Sem chave de API';
$string['err_noapikey_help'] = 'Não há uma chave API configurada para este plugin. Você deve obter uma em http://flickr.com/services/api/keys/apply';
$string['hidefrompublicsearches'] = 'Ocultar estas imagens de buscas públicas?';
$string['isfamily'] = 'Visível para a família';
$string['isfriend'] = 'Visível para os amigos';
$string['ispublic'] = 'Público (qualquer um pode ver)';
$string['moderate'] = 'Moderado';
$string['noauthtoken'] = 'Não foi possível trazer um token de autenticação para uso nesta sessão';
$string['other'] = 'Arte, ilustração, CGI ou outro tipo de imagem não fotográfica';
$string['photo'] = 'Fotos';
$string['pluginname'] = 'Flickr.com';
$string['restricted'] = 'Restrito';
$string['safe'] = 'Seguro';
$string['safetylevel'] = 'Nível de segurança';
$string['screenshot'] = 'Capturas de tela';
$string['set'] = 'Configurado';
$string['setupinfo'] = 'Instruções de configuração';
$string['setupinfodetails'] = 'Para obter a chave API e a frase secreta, faça o login no Flickr e <a href="{$a->applyurl}">gere uma nova chave</a>. Uma vez que a nova chave e o segredo foram gerados para você, siga o link \'Edit auth flow for this app\' na página. Defina \'App Type\' como \'Web Application\'. No campo "Callback URL", coloque o valor: <br/><code>{$a->callbackur>}</code><br/>Opcionalmente, você também pode fornecer sua descrição e logotipo do site Moodle. Estes itens podem ser definidos posteriormente em <a href="{$a->keysurl}">na página </a> que lista seus aplicativos do Flickr.';
$string['sharedsecret'] = 'Frase secreta';
$string['title'] = 'Título';
$string['uploadfailed'] = 'Falha ao enviar imagem(ns) para Flickr.com: {$a}';
