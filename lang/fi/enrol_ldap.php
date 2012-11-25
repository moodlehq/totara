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
 * Strings for component 'enrol_ldap', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'Annetaan rooli \'{$a->role_shortname}\' käyttäjälle \'{$a->user_username}\' kurssilla \'{$a->course_shortname}\' (id {$a->course_id})';
$string['assignrolefailed'] = 'Ei voitu antaa roolia \'{$a->role_shortname}\' käyttäjälle \'{$a->user_username}\' kurssilla \'{$a->course_shortname}\' (id {$a->course_id})';
$string['autocreate'] = 'Kurssialueet voidaan luoda automaattisesti, jos sellaisille kursseille on ilmoittautumisia, jota ei vielä ole Moodlessa.';
$string['autocreate_key'] = 'Luo automaattisesti';
$string['autocreation_settings'] = 'Automaattisen kurssin luonnin asetukset';
$string['bind_dn'] = 'Jos haluat käyttää bind-useria etsiäksesi käyttäjiä, merkitse se tähän. Esimerkki:  \'cn=ldapuser,ou=public,o=org\'';
$string['bind_dn_key'] = 'Sido käyttäjäkohtainen nimi';
$string['bind_pw'] = 'Salasana ´bind-user´ille.';
$string['bind_pw_key'] = 'Salasana';
$string['bind_settings'] = 'Sitomisasetukset';
$string['cannotcreatecourse'] = 'Ei voitu luoda kurssia: LDAP-merkinnästä puuttuu vaadittava tieto';
$string['category'] = 'Kategoria automaattisesti luoduille kursseille.';
$string['category_key'] = 'Kategoria';
$string['contexts'] = 'LDAP kontekstit';
$string['couldnotfinduser'] = 'Ei löydetty käyttäjää \'{$a}\', ohitetaan';
$string['course_fullname'] = 'Valinnainen: LDAP-kenttä jolta haetaan koko nimi.';
$string['course_fullname_key'] = 'Koko nimi';
$string['course_idnumber'] = 'Linkitä yksilölliseen tunnukseen LDAPssa, yleensä  <em>cn</em> tai <em>uid</em>. On suositeltavaa lukita arvo, jos käytät automaattista kurssin luontia.';
$string['course_idnumber_key'] = 'ID numero';
$string['course_search_sub'] = 'Hae ryhmän jäsenyyksiä alayhteyksistä';
$string['course_search_sub_key'] = 'Hae alayhteyksistä';
$string['course_settings'] = 'Kurssin ilmoittautumisen asetukset';
$string['course_shortname'] = 'Valinnainen: LDAP-kenttä jolta haetaan lyhyt nimi.';
$string['course_shortname_key'] = 'Lyhytnimi';
$string['course_summary'] = 'Valinnainen: LDAP-kenttä jolta haetaan yhteenveto.';
$string['course_summary_key'] = 'Yhteenveto';
$string['coursenotexistskip'] = 'Kurssia \'{$a}\' ei ole olemassa eikä automaattinen luonti ole päällä, ohitetaan';
$string['createcourseextid'] = 'LUO Käyttäjä kirjautunut olemattomalle kurssille \'{$a->courseextid}\'';
$string['createnotcourseextid'] = 'Käyttäjä kirjautunut olemattomalle kurssille \'{$a->courseextid}\'';
$string['creatingcourse'] = 'Luodaan kurssi \'{$a}\'...';
$string['editlock'] = 'Lukitse arvo';
$string['emptyenrolment'] = 'Tyhjä kirjautuminen roolille \'{$a->role_shortname}\' kurssilla \'{$a->course_shortname}\'';
$string['enrolname'] = 'LDAP';
$string['enroluser'] = 'Ilmoita käyttäjä \'{$a->user_username}\' kurssille \'{$a->course_shortname}\' (id {$a->course_id})';
$string['enroluserenable'] = 'Mahdollistettiin kirjautuminen käyttäjälle \'{$a->user_username}\' kurssille \'{$a->course_shortname}\' (id {$a->course_id})';
$string['explodegroupusertypenotsupported'] = 'ldap_explode_group() ei tue valittua käyttäjätyyppiä: {$a}';
$string['extcourseidinvalid'] = 'Kurssin ulkoinen id ei kelpaa!';
$string['extremovedsuspend'] = 'Estettiin kirjautuminen käyttäjältä \'{$a->user_username}\' kurssilla \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extremovedsuspendnoroles'] = 'Estettiin kirjautuminen ja poistettiin roolit käyttäjältä \'{$a->user_username}\' kurssilla \'{$a->course_shortname}\' (id {$a->course_id})';
$string['extremovedunenrol'] = 'Poista käyttäjän oikeudet \'{$a->user_username}\' kurssilta \'{$a->course_shortname}\' (id {$a->course_id})';
$string['failed'] = 'Epäonnistui!';
$string['general_options'] = 'Yleiset asetukset';
$string['group_memberofattribute'] = 'Attribuutin nimi, joka määrittää mihin ryhmiin tietty käyttäjä tai ryhmä kuuluu (esim. memberOf, groupMembership, etc.)';
$string['group_memberofattribute_key'] = '\'Member of\' attribuutti';
$string['host_url'] = 'Määritä LDAP-palvelin URL-muodossa. Malli:  \'ldap://ldap.myorg.com/\'tai \'ldaps://ldap.myorg.com/\'';
$string['host_url_key'] = 'Host URL';
$string['idnumber_attribute'] = 'Jos ryhmän jäsenyys sisältää edustavia nimiä (DN), määrittele sama atribuutti, jota olet käyttänyt käyttäjän \'ID Number\' yhdistämisessä LDAP:in todentamisasetuksissa';
$string['idnumber_attribute_key'] = 'ID numero attribuutti';
$string['ldap:manage'] = 'Hallitse LDAP kirjautumisen instansseja';
$string['ldap_encoding'] = 'Määrittele LDAP-palvelimen käyttämä koodaus. Luultavimmin utf-8, MS AD v2 käyttää oletusalustan koodausta kuten cp1252, cp1250, jne.';
$string['ldap_encoding_key'] = 'LDAP koodaus';
$string['memberattribute'] = 'LDAP jäsenattribuutti';
$string['memberattribute_isdn'] = 'Jos ryhmän jäsenyys sisältää edustavia nimiä (DN), sinun täytyy määritellä se tässä. Jos näin on, sinun täytyy säätää myös tämän osion loput asetukset vastaavasti.';
$string['memberattribute_isdn_key'] = 'Jäsenatribuutti käyttää dn:nää';
$string['nested_groups'] = 'Haluatko käyttää sisäkkäisiä ryhmiä (ryhmien ryhmiä) kirjautumisessa?';
$string['nested_groups_key'] = 'Sisäkkäiset ryhmät';
$string['nested_groups_settings'] = 'Sisäkkäisten ryhmien asetukset';
$string['nosuchrole'] = 'Ei kyseistä roolia: \'{$a}\'';
$string['objectclass'] = 'objektiLuokka jolla etsitään kursseilta. Yleensä \'posixGroup\'.';
$string['objectclass_key'] = 'Objektiluokka';
$string['ok'] = 'OK!';
$string['opt_deref'] = 'Jos ryhmän jäsenyys sisältää edustavia nimiä (DN), määrittele kuinka aliakset käsitellään haun aikana. Valitse yksi seuraavista arvoista: \'Ei\' (LDAP_DEREF_NEVER) tai \'Kyllä\' (LDAP_DEREF_ALWAYS)';
$string['opt_deref_key'] = 'Dereference aliakset';
$string['phpldap_noextension'] = '<em>PHP LDAP moduulia ei löydy. Jos haluat käyttää tätä kirjautumislisäosaa,  varmista ensin, että se on asennettu ja käytössä.</em>';
$string['pluginname'] = 'LDAP kirjautumiset';
$string['pluginname_desc'] = '<p>Voit käyttää LDAP-palvelinta hallinnoidaksesi ilmoittautumisia. Tällöin oletetaan että LDAP-puusi sisältää ryhmät, jotka liittyvät kursseihin ja että jokainen näistä ryhmistä/kursseista tulee sisältämään jäsenyysrekisterin, johon oppilaat liitetään.</p>

<p>Oletetaan myös, että kurssit määritellään ryhminä LDAPssä ja että jokaisessa ryhmässä on useita jäsenyyskenttiä (<em>member</em> or <em>memberUid</em>), jotka sisältävät yksilöllisen identiteetin käyttäjillä.</p>

<p>Käyttääksesi LDAP-ilmoittautumisia käyttäjilläsi <strong>täytyy</strong> olla kelvollinen id-numero kentässään. LDAP-ryhmillä täytyy olla tämä id-numero jäsenyyskentässään, jotta käyttäjä voi liittyä kurssille. Yleensä tämä toimii hyvin, jos käytät jo LDAP-varmennusta.</p>

<p>Ilmoittautumiset päivitetään kun käyttäjät kirjautuvat sisään. Voit myös ajaa scriptin, joka pitää ilmoittautumiset synkronoituina. Se löytyy  <em>enrol/ldap/enrol_ldap_sync.php</em> polulta.</p>

<p>Tämä laajennus voidaan myös asettaa luomaan uusia kursseja kun LDAPhen luodaan uusia ryhmiä.</p>';
$string['pluginnotenabled'] = 'Plugin ei ole käytössä!';
$string['role_mapping'] = '<p>Jokaiselle roolille jotka haluat jakaa LDAPista täytyy määrittää lista konteksteista, joissa roolikurssien ryhmät sijaitsevat. Erota eri kontekstit puolipilkulla \';\'.</p><p>Sinun täytyy myös määrittää LDAP-palvelimesi ryhmän jäsenien pitämiseen käyttämä atribuutti. Yleensä \'member\' tai \'memberUid\'</p>';
$string['role_mapping_key'] = 'Mappaa roolit LDAP:ista';
$string['roles'] = 'Roolien mappaukset';
$string['server_settings'] = 'LDAP-palvelimen asetukset';
$string['synccourserole'] = '== Synkronoidaan kurssi \'{$a->idnumber}\' roolille \'{$a->role_shortname}\'';
$string['template'] = 'Valinnainen: automaattisesti luodut kurssit voivat kopioida asetuksensa käyttäen pohjana mallikurssin asetuksia.';
$string['template_key'] = 'Malli';
$string['unassignrole'] = 'Poistetaan rooli \'{$a->role_shortname}\' käyttäjältä \'{$a->user_username}\' kurssilla \'{$a->course_shortname}\' (id {$a->course_id})';
$string['unassignrolefailed'] = 'Ei voitu poistaa roolia \'{$a->role_shortname}\' käyttäjältä \'{$a->user_username}\' kurssilla \'{$a->course_shortname}\' (id {$a->course_id})';
$string['unassignroleid'] = 'Poistetaan rooli id \'{$a->role_id}\' käyttäjältä id \'{$a->user_id}\'';
$string['updatelocal'] = 'Päivitä paikalliset tiedot';
$string['user_attribute'] = 'Jos ryhmän jäsenyys sisältää edustavia nimiä (DN), määrittele atribuutti jota käytetään nimeämään/etsimään käyttäjiä. Jos käytät LDAP-todentamista, tämän arvon pitäisi täsmätä atribuuttiin, joka on määritelty \'ID Number\' yhdistämisessä LDAP-todentamispluginissa';
$string['user_attribute_key'] = 'ID numero attribuutti';
$string['user_contexts'] = 'Jos ryhmän jäsenyys sisältää edustavia nimiä (DN), määrittele lista konteksteista, joissa käyttäjät sijaitsevat. Erota eri kontekstit puolipilkulla \';\'. Esimerkiksi: \'ou=users,o=org; ou=others,o=org\'';
$string['user_contexts_key'] = 'Kontekstit';
$string['user_search_sub'] = 'Jos ryhmän jäsenyys sisältää edustavia nimiä (DN), määrittele suoritetaanko käyttäjien haut myös alikonteksteissa';
$string['user_search_sub_key'] = 'Hae alikonteksteista';
$string['user_settings'] = 'Käyttäjien etsintäasetukset';
$string['user_type'] = 'Jos ryhmän jäsenyys sisältää edustavia nimiä (DN), määrittele kuinka käyttäjät säilytetään LDAP:issa.';
$string['user_type_key'] = 'Käyttäjätyyppi';
$string['version'] = 'LDAP-protokollan versio, jota palvelimesi käyttää.';
$string['version_key'] = 'Versio';
