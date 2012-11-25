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
 * Strings for component 'auth_mnet', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_mnet_auto_add_remote_users'] = 'Kun valintana on Kyllä, luodaan automaattisesti paikallinen käyttäjämerkintä kun etäkäyttäjä kirjautuu ensimmäisen kerran sisään.';
$string['auth_mnet_roamin'] = 'Näiden isäntien käyttäjät voivat tulla sivustollesi';
$string['auth_mnet_roamout'] = 'Käyttäjäsi voivat siirtyä näiden isäntien sivustoille';
$string['auth_mnet_rpc_negotiation_timeout'] = 'XMLRPC-siirron yli tapahtuvan todentamisen aikakatkaisu sekunteina.';
$string['auth_mnetdescription'] = 'Käyttäjät todennetaan Moodle Network -asetuksissa määritellyn luotetun verkon mukaan.';
$string['auto_add_remote_users'] = 'Lisää automaattisesti etäkäyttäjät';
$string['pluginname'] = 'MNet-todentaminen';
$string['rpc_negotiation_timeout'] = 'RPC-neuvottelun aikakatkaisu';
$string['sso_idp_description'] = 'Julkaise tämä palvelu salliaksesi käyttäjiesi siirtyä sivustolle {$a} ilman että heidän tarvitsee kirjautua sinne uudelleen. <ul><li><em>Riippuvaisuus</em>: Sinun täytyy myös <strong>tilata</strong> SSO (Palveluntarjoaja) -palvelu kohteessa {$a}.</li></ul><br />Tilaa tämä palvelu salliaksesi todennettujen käyttäjien päästä sivustollesi kohteesta {$a} ilman uudelleenkirjautumista. <ul><li><em>Riippuvaisuus</em>: Sinun täytyy myös <strong>julkaista</strong> SSO (Palveluntarjoaja) -palvelu kohteelle {$a}.</li></ul><br />';
$string['sso_idp_name'] = 'SSO (Identiteetintarjoaja)';
$string['sso_mnet_login_refused'] = 'Käyttäjän {$a->user} ei sallita kirjautua kohteesta {$a->host}.';
$string['sso_sp_description'] = 'Julkaise tämä palvelu salliaksesi todennettujen käyttäjien siirtyä sivustollesi kohteesta {$a} ilman että heidän tarvitsee kirjautua sinne uudelleen. <ul><li><em>Riippuvaisuus</em>: Sinun täytyy myös <strong>tilata</strong> SSO (Identiteetintarjoaja) -palvelu kohteesta {$a}.</li></ul><br />Tilaa tämä palvelu salliaksesi käyttäjiesi siirtyä sivustolle {$a} ilman uudelleenkirjautumista. <ul><li><em>Riippuvaisuus</em>: Sinun täytyy myös <strong>julkaista</strong> SSO (identiteetintarjoaja) -palvelu kohteelle {$a}.</li></ul><br />';
$string['sso_sp_name'] = 'SSO (Palveluntarjoaja)';
