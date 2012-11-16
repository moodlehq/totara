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
 * Strings for component 'auth_shibboleth', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_shibboleth
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_shib_auth_method'] = 'Todentamismetodin nimi';
$string['auth_shib_auth_method_description'] = 'Anna Shibboleth-todentamiselle nimi, joka on tuttu käyttäjillesi. Tämä voi olla Shibboleth-federaatiosi nimi, esim. <tt>SWITCHaai Kirjautuminen</tt> tai <tt>InCommon Kirjautuminen</tt> tai jokin samankaltainen.';
$string['auth_shib_changepasswordurl'] = 'Web-osoite salasanan muuttamiseen';
$string['auth_shib_convert_data'] = 'Tiedon muokaamisen API';
$string['auth_shib_convert_data_description'] = 'Voit käyttää tätä APIa muokataksesi edelleen tietoja, joita Shibboleth tarjoaa. Lue  <a href="../auth/shibboleth/README.txt" target="_blank">README (englanniksi)</a> saadakseis lisää tietoa.';
$string['auth_shib_convert_data_warning'] = 'Tiedosto ei ole olemassa tai se ei ole verkkopalvelinprosessin luettavissa!';
$string['auth_shib_idp_list'] = 'Identiteetin tarjoajat';
$string['auth_shib_idp_list_description'] = 'Tarjoa lista Identiteetintarjoaja entiteettiID:istä, joista käyttäjä valitsee kirjautumissivulla.<br />Joka rivillä täytyy olla pilkulla erotettuna tiedot entiteettiID:lle ldP:stä (katso Shobbolethin metadatatiedosto) sekä ldP:n nimi koska se saatetaan näyttää alasvetovalikossa.<br />Vaihtoehtoisena kolmantena parametrina voit lisätä Shibboleth-session käynnistäjän sijainnin, jota käytetään jos Moodle-asennuksesi on osa moni-federaatioasennusta.';
$string['auth_shib_instructions'] = 'Käytä <a href="{$a}">Shibboleth-kirjautumista</a> käyttääksesi yhteyden muodostamiseen Shibbolethia, jos se on tarjolla. <br />
Muuten voit käyttää tätä tavallista kirjautumislomaketta.';
$string['auth_shib_instructions_help'] = 'Tähän voit kirjoittaa lisäohjeita käyttäjillesi selittääksesi Shibboleth-varmennusta. Nämä ohjeet näytetään kirjautumissivun ohjeosiossa. Siinä pitäisi olla linkki, joka ohjaa käyttäjät "**{$a}**", niin että Shibbolethin käyttäjät voivat kirjautua sisään Moodleen. Jos jätät tämän tyhjäksi, näytetää käyttäjille tavalliset ohjeet (eivät käsittele erityisesti Shibbolethia)';
$string['auth_shib_integrated_wayf'] = 'Moodle WAYF-palvelu';
$string['auth_shib_integrated_wayf_description'] = 'Jos valitset tämän, Moodle käyttää omaa WAYF-palvelua Shobbilethille konfiguroidun sijasta.Moodle näyttää alasvetovalikon tällä vaihtoehtoisella kirjautumissivulla, jossa käyttäjän on valittava oma Identiteetintarjoaja.';
$string['auth_shib_logout_return_url'] = 'Vaihtoehtoinen web-osoite uloskirjauduttaessa';
$string['auth_shib_logout_return_url_description'] = 'Anna web-osoite, johon Shibboleth-käyttäjät ohjataan kun he kirjautuvat ulos.<br />Jos jätetään tyhjäksi, käyttäjät ohjataan kohteeseen, johon Moodle ohjaa käyttäjät';
$string['auth_shib_logout_url'] = 'Shibboleth Palveluntarjoajan uloskirjautumisen käsittelyn web-osoite';
$string['auth_shib_logout_url_description'] = 'Anna web-osoite Shibboleth Palveluntarjoajan uloskirjautumisen käsittelijään. Tämä on tavallisesti <tt>/Shibboleth.sso/Logout</tt>';
$string['auth_shib_no_organizations_warning'] = 'Jos haluat käyttää integroitua WAYF-palvelua, sinun täytyy antaa pilkulla erotettu lista Identiteetin Tarjoaja entiteettiID:istä, niiden nimistä ja vaihtoehtoisesti session käynnistäjistä.';
$string['auth_shib_only'] = 'Vain Shibboleth';
$string['auth_shib_only_description'] = 'Käytä tätä valintaa, jos haluat pakottaa Shibboleth-varmennuksen';
$string['auth_shib_username_description'] = 'Sen verkkopalvelimen Shibboleth-ympäristön muuttujan nimi, jota käytetään Moodlen käyttäjänimenä.';
$string['auth_shibboleth_contact_administrator'] = 'Jos et liity kyseisiin organisaatioihin ja tarvitset pääsyn kurssille tällä palvelimella, ole hyvä ja ota yhteyttä';
$string['auth_shibboleth_errormsg'] = 'Ole hyvä ja valitse organisaatio jonka jäsen olet!';
$string['auth_shibboleth_login'] = 'Shibboleth-kirjautuminen';
$string['auth_shibboleth_login_long'] = 'Kirjaudu Moodleen Shibbolethin kautta';
$string['auth_shibboleth_manual_login'] = 'Manuaalinen kirjautuminen';
$string['auth_shibboleth_select_member'] = 'Olen jäsen ...';
$string['auth_shibboleth_select_organization'] = 'Kirjautuaksesi Shibbolethin kautta, ole hyvä ja valitse organisaatiosi alasvetovalikosta:';
$string['auth_shibbolethdescription'] = 'Tätä menetelmää käyttäessä käyttäjät luodaan ja varmennetaan käyttäen href="http://shibboleth.internet2.edu/" target="_blank">Shibboleth-käyttäjänvarmennusta</a>. Lue <a href="../auth/shibboleth/README.txt" target="_blank">README (englanniksi)</a>, jossa kerrotaan kuinka Moodle asetetaan käyttämään Shibbolethin-varmennusta.';
$string['pluginname'] = 'Shibboleth';
$string['shib_no_attributes_error'] = 'Vaikutat olevan Shibboleth-todennettu mutta Moodle ei vastaanottanut mitään käyttäjäattribuutteja. Ole hyvä ja varmista että Identiteetintarjoajasi julkaisee tarvittavat attribuutit ({$a}) Palveluntarjoajalle, jota Moodle käyttää, tai ilmoita ylläpitäjälle tästä palvelimesta.';
$string['shib_not_all_attributes_error'] = 'Moodle tarvitsee tiettyjä Shibboleth-attribuutteja, joita ei sinun tapauksessasi löydy. Attribuutit ovat: {$a}<br />Ole hyvä ja ota yhteyttä tämän palvelimen tai Identiteetintarjoajasi ylläpitäjään';
$string['shib_not_set_up_error'] = 'Shibboleth-kirjautumista ei ole asennettu oikein koska tälle sivulle ei löydy Shibboleth ympäristönmuuttujia. Ole hyvä ja lue täältä lisätietoa <a href="README.txt">README</a> siitä, miten Shibboleth-kirjautuminen konfiguroidaan, tai ota yhteyttä tämän Moodle-asennuksen ylläpitäjään.';
