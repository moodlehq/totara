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
 * Strings for component 'portfolio_mahara', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio_mahara
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enableleap2a'] = 'Habilitar o suporte para Portfólio Leap2a (requer Mahara 1.3)';
$string['err_invalidhost'] = 'Servidor MNet inválido';
$string['err_invalidhost_help'] = 'Este plugin está mal configurado para apontar para um host do MNet inválido (ou excluído). Este plugin se baseia em pares Moodle Networking com SSO IDP publicou, SSO_SP subscrito e portfólio subscrito <b>e</b> publicado.';
$string['err_networkingoff'] = 'MNet está desabilitado';
$string['err_networkingoff_help'] = 'MNet está desligado completamente. Ative-o antes de tentar configurar este plugin. Todas as instâncias deste plugin foi programado para não visíveis até que isso seja corrigido - você precisará configurá-los para manully visível novamente. Eles não pode ser usado até que isso aconteça';
$string['err_nomnetauth'] = 'O plugin de autenticação MNet está desabilitado';
$string['err_nomnetauth_help'] = 'O plugin de autenticação MNet está desabilitado, mas é requerido para este serviço.';
$string['err_nomnethosts'] = 'Depende de MNet';
$string['err_nomnethosts_help'] = 'Este plugin se baseia em pares MNet com SSO IDP publicou, SSO SP subscrito, portfólio de serviços publicados <b>e</b> subscrito, bem como o plugin de autenticação MNet. Todas as instâncias deste plugin foram escondidos até que essas condições sejam cumpridas. Eles, então, manualmente precisa definir a visível novamente.';
$string['failedtojump'] = 'Falha ao iniciar a comunicação com o servidor remoto';
$string['failedtoping'] = 'Falha ao iniciar a comunicação com o servidor remoto: {$a}';
$string['mnethost'] = 'Servidor MNet';
$string['mnet_nofile'] = 'Não foi possível transferir objeto - Erro estranho.';
$string['mnet_nofilecontents'] = 'Encontrado arquivo em objeto de transferência, mas não conseguia conteúdo - erro estranho: {$a}';
$string['mnet_noid'] = 'Não foi possível localizar o registro de transferência de correspondência para este token';
$string['mnet_notoken'] = 'Não foi possível encontrar símbolo correspondente esta transferência';
$string['mnet_wronghost'] = 'Host remoto não coincidir com o registro de transferência para este token';
$string['pf_description'] = 'Permitir que usuários o envio de conteúdo Moodle para este host <br /> Para se inscrever <b>e</b> publicar este serviço para permitir que usuários autenticados em seu site para enviar conteúdo para {$a} <br /><ul><li> <em>Dependência:</em> Você também deve <strong>publicar</strong> o SSO (Identificar Provider) serviço para {$a}. </li><li> <em>Dependência:</em> Você também deve <strong>assinar</strong> o serviço SSO (Provedor de Serviço) em {$a} </li><li> <em>Dependência:</em> Você também deve habilitar o plugin de autenticação MNet. </li></ul><br />';
$string['pf_name'] = 'Serviços de portfólio';
$string['pluginname'] = 'Mahara ePortfolio';
$string['senddisallowed'] = 'Você não pode transferir arquivos no Mahara neste momento';
$string['url'] = 'URL';
