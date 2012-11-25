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
 * Strings for component 'auth_cas', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_cas
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['CASform'] = 'Autentikointivalinta';
$string['accesCAS'] = 'CAS-käyttäjät';
$string['accesNOCAS'] = 'muut käyttäjät';
$string['auth_cas_auth_user_create'] = 'Luo käyttäjät ulkoisesti';
$string['auth_cas_baseuri'] = 'Palvelimen URI (tyhjä, jos ei baseURIa)<br /> Esimerkiksi, jos CAS-palvelin on ´host.domaine.fr/CAS/´, niin tällöin<br />
cas_baseuri = CAS/';
$string['auth_cas_baseuri_key'] = 'Base URI';
$string['auth_cas_broken_password'] = 'Et voi jatkaa muuttamatta salasanaasi. Salasanan muuttamiseen ei kuitenkaan ole sivua, joten ota yhteyttä Moodle ylläpitäjään.';
$string['auth_cas_cantconnect'] = 'LDAP-osa CAS-moduulista ei saa yhteyttä palvelimeen: {$a}';
$string['auth_cas_casversion'] = 'CAS-protokollan Versio';
$string['auth_cas_certificate_check'] = 'Valitse vaihtoehto \'Kyllä\' jos haluat vahvistaa palvelimen sertifikaatin';
$string['auth_cas_certificate_check_key'] = 'Palvelimen vahvistus';
$string['auth_cas_certificate_path'] = 'CA-ketjutiedoston (PEM-formaatti) polku palvelimen sertifikaatin vahvistukseen';
$string['auth_cas_certificate_path_empty'] = 'Jos kytket palvelinvahvistuksen päälle, sinun täytyy määrittää sertifikaatin polku';
$string['auth_cas_certificate_path_key'] = 'Sertifikaatin polku';
$string['auth_cas_changepasswordurl'] = 'Web-osoite salasanan vaihtamiseen';
$string['auth_cas_create_user'] = 'Laita tämä asetus päälle, jos haluat lisätä CAsvarmistetut käyttäjät Moodlen tietokantaan. Jos näin ei tehdä, vain jo ennestään Moodlen tietokannassa olevat käyttäjät voivat kirjautua sisään.';
$string['auth_cas_create_user_key'] = 'Luo käyttäjä';
$string['auth_cas_enabled'] = 'Laita tämä asetus päälle, jos haluat käyttää CAS-varmennusta';
$string['auth_cas_hostname'] = 'CAS-palvelimen palvelinnimi
<br />Esim. host.domain.fr';
$string['auth_cas_hostname_key'] = 'Isäntäpalvelimen nimi';
$string['auth_cas_invalidcaslogin'] = 'Kirjautumisesi ei onnistunut - sinua ei voitu varmentaa';
$string['auth_cas_language'] = 'Valitse kirjautumissivujen kieli';
$string['auth_cas_language_key'] = 'Kieli';
$string['auth_cas_logincas'] = 'Suojatun yhteyden muodostus';
$string['auth_cas_logoutcas'] = 'Valitse vaihtoehto \'Kyllä\' jos haluat kirjautua ulos CAS:ista kun katkaiset yhteyden Moodleen.';
$string['auth_cas_logoutcas_key'] = 'Kirjaudu ulos CAS:ista';
$string['auth_cas_multiauth'] = 'Valitse vaihtoehto \'kyllä\' jos haluat käyttää useampaa kirjautumislähdettä (CAS + muu todentaminen)';
$string['auth_cas_multiauth_key'] = 'Multi-autentikointi';
$string['auth_cas_port'] = 'CAS-palvelimen käyttämä portti';
$string['auth_cas_port_key'] = 'Portti';
$string['auth_cas_proxycas'] = 'Valitse vaihtoehto \'kyllä\' jos käytät CAS:ia välityspalvelin-tilassa';
$string['auth_cas_proxycas_key'] = 'Välityspalvelinmoodi';
$string['auth_cas_server_settings'] = 'CAS-palvelimen asetukset';
$string['auth_cas_text'] = 'Suojattu yhteys';
$string['auth_cas_use_cas'] = 'Käytä CAS:ia';
$string['auth_cas_version'] = 'Käytettävä CAS-protokollan versio';
$string['auth_casdescription'] = 'Tässä menetelmässä käytetään CAS-palvelinta (Central Authentication Service) käyttäjien varmennukseen käyttämällä yhden kirjautumisen ympäristöä, Single Sign On environment (SSO). Voit myös käyttää yksinkertaista LDAP-varmistusta. Jos annettu käyttäjänimi ja salasana ovat kelvollisia CAS:n mukaan Moodle luo uuden käyttäjätiedon tietokantaan ottaen käyttäjätiedot LDAP:stä, jos se  on tarpeen. Seuraavilla kirjautumiskerroilla vain käyttäjänimi ja salasana tarkistetaan.';
$string['auth_casnotinstalled'] = 'Ei voida käyttää CAS-autentikointia. PHP:n LDAP-moduulia ei ole asennettu.';
$string['noldapserver'] = 'CAS:ille ei ole konfiguroitu LDAP palvelinta! Synkronointi estetty.';
$string['pluginname'] = 'Käytä CAS-palvelinta (SSO)';
