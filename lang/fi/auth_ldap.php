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
 * Strings for component 'auth_ldap', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_ldap
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_ldap_ad_create_req'] = 'Ei voida luoda uutta tiliä Active Directoryyn. Varmista että kaikki vaatimukset tämän toteuttamiseen on täytetty (LDAPS-yhteys, käyttäjällä riittävät oikeudet, jne.)';
$string['auth_ldap_attrcreators'] = 'Lista ryhmistä tai konteksteista, joiden jäsenillä on lupa luoda attribuutteja. Erota ryhmät puolipisteellä \';\'. Yleensä jotain kuten \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_attrcreators_key'] = 'Attribuuttien luojat';
$string['auth_ldap_auth_user_create_key'] = 'Luo käyttäjiä ulkoisesti';
$string['auth_ldap_bind_dn'] = 'Jos haluat käyttää välityskäyttäjää yhteyden muodostamiseen, määritä se tähän. Esim. \'cn=ldapuser,ou=public,o=org\'';
$string['auth_ldap_bind_dn_key'] = 'Ainutlaatuinen nimi';
$string['auth_ldap_bind_pw'] = 'Salasana välityskäyttäjälle.';
$string['auth_ldap_bind_pw_key'] = 'Salasana';
$string['auth_ldap_bind_settings'] = 'Sidosasetukset';
$string['auth_ldap_changepasswordurl_key'] = 'Web-osoite salasanan muuttamiseen';
$string['auth_ldap_contexts'] = 'Lista konteksteista, missä käyttäjät sijaitsevat. Erota kontekstit toisistaan \';\'-merkillä. Esim: \'ou=users,o=org; ou=others,o=org\'';
$string['auth_ldap_contexts_key'] = 'Kontekstit';
$string['auth_ldap_create_context'] = 'Jos sähköpostiviestillä tunnuksensa varmentaneet käyttäjät luodaan automaattisesti ldap-hakemistoon, määritä tässä konteksti, minne käyttäjät luodaan. On hyvä käyttää jotain erityistä kontekstia, jotta vältyt tietoturvariskeiltä. Tätä kontekstia ei tarvitse erikseen lisätä yllä olevaan muuttujaan.';
$string['auth_ldap_create_context_key'] = 'Uusien käyttäjien konteksti';
$string['auth_ldap_create_error'] = 'Virhe luotaessa käyttäjää LDAP:iin.';
$string['auth_ldap_creators'] = 'Lista ryhmistä, joiden jäsenet voivat luoda uusia kursseja Moodleen. Erota useat ryhmät toisistaan \';\'-merkillä. Esimerkiksi \'cn=teachers,ou=staff,o=myorg;\'';
$string['auth_ldap_creators_key'] = 'Luojat';
$string['auth_ldap_expiration_desc'] = 'Valitse "Ei" poistaaksesi vanhentuneiden salasanojen seurannan. Tai "LDAP" jos haluat näyttää käyttäjille viestin kun heidän salasanansa on vanhenemassa.';
$string['auth_ldap_expiration_key'] = 'Erääntymisaika';
$string['auth_ldap_expiration_warning_desc'] = 'päivien määrä ennen salasanan voimassaolon loppumista on asetettu.';
$string['auth_ldap_expiration_warning_key'] = 'Erääntymisajan varoitus';
$string['auth_ldap_expireattr_desc'] = 'Valinnainen: ylimääritä haluamasi';
$string['auth_ldap_expireattr_key'] = 'Erääntymisajan attribuutti';
$string['auth_ldap_graceattr_desc'] = 'Valinnainen: ohita graceLogin atribuutti';
$string['auth_ldap_gracelogin_key'] = 'Novell eDirectoryn Grace-kirjautumisen attribuutti';
$string['auth_ldap_gracelogins_desc'] = 'Käytä LDAP graceLogin -ominaisuutta. Esim. Edirectory voidaan konfiguroida kirjaamaan käyttäjä sisään vielä muutaman kerran salasanan vanhenemisen jälkeen, jotta salasana voidaan vaihtaa. Jos haluat antaa ilmoituksen, kun käyttäjä käyttää grace-logineja, valitse "Kyllä".';
$string['auth_ldap_gracelogins_key'] = 'Novell eDirectoryn Grace-kirjautumiset';
$string['auth_ldap_groupecreators'] = 'Lista ryhmistä tai konteksteista, joiden jäsenten sallitaan luovan ryhmiä. Erota ryhmät puolipisteellä \';\'. Yleensä jotakin kuten \'cn=teachers,ou=staff,o=myorg\'';
$string['auth_ldap_groupecreators_key'] = 'Ryhmän luojat';
$string['auth_ldap_host_url'] = 'Määritä LDAP-palvelin URL-muodossa. Esim. \'ldap://ldap.myorg.com/\' tai \'ldaps://ldap.myorg.com/\'';
$string['auth_ldap_host_url_key'] = 'Isännän web-osoite';
$string['auth_ldap_ldap_encoding'] = 'Määritä LDAP-palvelimen käyttämä koodaus. Luultavimmin utf-8, MS AD v2 käyttää alustan oletuskoodausta kuten cp1252, cp1250, etc.';
$string['auth_ldap_ldap_encoding_key'] = 'LDAP-koodaus';
$string['auth_ldap_login_settings'] = 'Kirjautumisasetukset';
$string['auth_ldap_memberattribute'] = 'Valinnainen: ylimääritä käyttäjän ryhmäjäsenyysattribuutti. Yleensä \'member\' tai \'groupMembership\'';
$string['auth_ldap_memberattribute_isdn'] = 'Vaihtoehtoinen: Ohittaa jäsenattribuuttiarvojen käsittelyn, joko 0 tai 1';
$string['auth_ldap_memberattribute_isdn_key'] = 'Jäsenattribuutti käyttää dn:ää';
$string['auth_ldap_memberattribute_key'] = 'Jäsenattribuutti';
$string['auth_ldap_no_mbstring'] = 'Tarvitset mbstring-laajennuksen luodaksesi käyttäjiä Active Directoryyn.';
$string['auth_ldap_noconnect'] = 'LDAP-moduuli ei voi yhdistää palvelimelle: {$a}';
$string['auth_ldap_noconnect_all'] = 'LDAP-moduuli ei voi yhdistää millekään palvelimelle: {$a}';
$string['auth_ldap_noextension'] = '<em>PHP LDAP -moduuli ei näyttäisi olevan tavoitettavissa. Ole hyvä ja varmista että se on asennettu ja sallittu jos haluat käyttää tätä autentikointimoduulia.</em>';
$string['auth_ldap_objectclass'] = 'Valinnainen: ylimääritä objectClass, jota käytetään käyttäjien hakuun.';
$string['auth_ldap_objectclass_key'] = 'Objektiluokka';
$string['auth_ldap_opt_deref'] = 'määrittää, kuinka aliakset käsitellään haun aikana. Valitse yksi seuraavista vaihtoehdoista: "Ei" (LDAP_DEREF_NEVER) tai "Kyllä" (LDAP_DEREF_ALWAYS)';
$string['auth_ldap_opt_deref_key'] = 'De-referenssi aliakset';
$string['auth_ldap_passtype'] = 'Määritä uusien tai muuttuneiden salasanojen formaatti LDAP-serverillä.';
$string['auth_ldap_passtype_key'] = 'Salasanan muoto';
$string['auth_ldap_passwdexpire_settings'] = 'LDAP -salasanojen vanheneminen';
$string['auth_ldap_preventpassindb'] = 'Valitse kyllä, jos haluat estää salasanojen tallentamisen Moodlen tietokantaa.';
$string['auth_ldap_preventpassindb_key'] = 'Piilota salasanat';
$string['auth_ldap_search_sub'] = 'Aseta arvo <> 0, jos haluat hakea käyttäjiä myös alikonteksteista.';
$string['auth_ldap_search_sub_key'] = 'Etsi alikonteksteista';
$string['auth_ldap_server_settings'] = 'LDAP -palvelimen asetukset';
$string['auth_ldap_unsupportedusertype'] = 'auth: ldap user_create() ei tue valittua käyttäjätyyppiä: {$a}';
$string['auth_ldap_update_userinfo'] = 'Päivitä käyttäjätiedot LDAP:ista Moodleen (etunimi, sukunimi, osoite..). Katso <a href="/auth/ldap/attr_mappings.php">/auth/ldap/attr_mappings.php</a> tarkempia määrittelytietoja.';
$string['auth_ldap_user_attribute'] = 'Valinnainen: ylimäärittele attribuutti käyttäjänimille. Yleensä \'cn\'.';
$string['auth_ldap_user_attribute_key'] = 'Käyttäjäattribuutti';
$string['auth_ldap_user_exists'] = 'LDAP-käyttäjänimi on jo olemassa';
$string['auth_ldap_user_settings'] = 'Käyttäjien etsintä';
$string['auth_ldap_user_type'] = 'Valitse kuinka käyttäjät tallennetaan LDAP:iin. Tämä asetus myös määrittää kuinka sisäänkirjautumisen voimassaolo, vapaat sisäänkirjautumiset ja käyttäjien luominen toimii';
$string['auth_ldap_user_type_key'] = 'Käyttäjän tyyppi';
$string['auth_ldap_usertypeundefined'] = 'config.user_type:ä ei ole määritelty tai funktio ldap_expirationtime2unix ei tue valittua tyyppiä!';
$string['auth_ldap_usertypeundefined2'] = 'config.user_type:ä ei ole määritelty tai funktio ldap_unixi2expirationtime ei tue valittua tyyppiä!';
$string['auth_ldap_version'] = 'Palvelimella käytettävä LDAP -protokollaversio';
$string['auth_ldap_version_key'] = 'Versio';
$string['auth_ldapdescription'] = 'Tämä tapa tarjoaa käyttäjätunnistuksen LDAP-palvelimelta. Jos salasana ja tunnus täsmäävät, Moodle luo uuden käyttäjän  tietokantaansa. Tämä moduuli voi lukea käyttäjän attribuutteja LDAPista ja täyttää etukäteen halutut kentät Moodlessa.

Seuraavilla kerroilla ainoastaan tunnus ja salasana tarkistetaan.';
$string['auth_ldapextrafields'] = 'Nämä kentät ovat valinnaisia. Voit asettaa Moodlen hakemaan käyttäjätietoja tässä määritellyistä <b>LDAP-kentistä</b>. Mikäli jätät nämä tyhjiksi, mitään tietoja ei haeta LDAP-palvelimelta ja käytetään Moodlen oletusarvoja.
<p>Käyttäjä voi joka tapauksessa muuttaa omia henkilötietojaan jälkeenpäin.</p>';
$string['auth_ldapnotinstalled'] = 'Ei voida käyttää LDAP-kirjautumista. PHP LDAP -moduulia ei ole asennettu.';
$string['auth_ntlmsso'] = 'NTLM SSO';
$string['auth_ntlmsso_enabled'] = 'Aseta valinnaksi kyllä yrittääksesi SSO-kirjautumista NTLM-domainilta. <strong>Huomaa:</strong> tämä vaatii toimiakseen lisäasetuksia verkkopalvelimella, katso <a href="http://docs.moodle.org/en/NTLM_authentication">http://docs.moodle.org/en/NTLM_authentication</a>';
$string['auth_ntlmsso_enabled_key'] = 'Ota käyttöön';
$string['auth_ntlmsso_ie_fastpath'] = 'Aseta valinnaksi kyllä, salliaksesi NTLM SSO fast path:in (ohittaa tietyt vaiheet ja toimii vain jos asiakkaan selain on MS Internet Explorer).';
$string['auth_ntlmsso_ie_fastpath_key'] = 'MS IE fast path?';
$string['auth_ntlmsso_subnet'] = 'Jos asetettu, yritetään SSO-kirjautumista ainoastaan tämän aliverkon asiakkaille. Muoto: xxx.xxx.xxx.xxx/verkon_peite. Erota useat aliverkot pilkulla \',\'.';
$string['auth_ntlmsso_subnet_key'] = 'Aliverkko';
$string['auth_ntlmsso_type'] = 'Verkkoplavelimella määritelty kirjautumistapa käyttäjien todentamiseen (jos et ole varma, valitse NTLM)';
$string['auth_ntlmsso_type_key'] = 'Autentikointityyppi';
$string['connectingldap'] = 'Otetaan yhteyttä LDAP-palvelimeen...';
$string['creatingtemptable'] = 'Luodaan väliaikainen taulu {$a}';
$string['didntfindexpiretime'] = 'password_expire() ei löytänyt erääntymisaikaa.';
$string['didntgetusersfromldap'] = 'Ei saatu käyttäjiä LDAP:ista -- virhe? -- poistutaan';
$string['gotcountrecordsfromldap'] = 'Saatiin {$a} merkintää LDAP:ista';
$string['morethanoneuser'] = 'Outoa! Löydettiin useampi kuin yksi käyttäjä ldap:ista. Käytetään vain ensimmäistä.';
$string['needbcmath'] = 'Tarvitset BCMath-laajennuksen käyttääksesi grace-kirjautumista Active Directoryn kanssa.';
$string['needmbstring'] = 'Tarvitset mbstring-laajennuksen muuttaaksesi salasanoja Active Directoryssä.';
$string['nodnforusername'] = 'Virhe kohteessa user_update_password(). Ei DN:ää käyttäjälle: {$a->username}';
$string['noemail'] = 'Sähköpostin lähettäminen sinulle epäonnistui!';
$string['notcalledfromserver'] = 'Ei pitäisi olla kutsuttu verkkopalvelimelta!';
$string['noupdatestobedone'] = 'Ei tehtäviä päivityksiä';
$string['nouserentriestoremove'] = 'Ei poistettavia käyttäjämerkintöjä';
$string['nouserentriestorevive'] = 'Ei palautettavia käyttäjämerkintöjä';
$string['nouserstobeadded'] = 'Ei lisättäviä käyttäjiä';
$string['ntlmsso_attempting'] = 'Yritetään SSO-kirjautumista NTLM:n kautta...';
$string['ntlmsso_failed'] = 'Automaattikirjautuminen epäonnistui, yritä normaalia kirjautumissivua...';
$string['ntlmsso_isdisabled'] = 'NTLM SSO on estetty.';
$string['ntlmsso_unknowntype'] = 'Tuntematon ntlmsso-tyyppi!';
$string['pluginname'] = 'Käytä LDAP-palvelinta';
$string['pluginnotenabled'] = 'Moduulia ei ole sallittu!';
$string['renamingnotallowed'] = 'Käyttäjän uudelleennimeäminen ei ole sallittu LDAP:issa';
$string['rootdseerror'] = 'Virhe rootDSE-kyselyssä Active Directorylle';
$string['updatepasserror'] = 'Virhe kohteessa user_update_password(). Virhekoodi: {$a->errno}; Virhemerkkijono: {$a->errstring}';
$string['updatepasserrorexpire'] = 'Virhe kohteessa user_update_password() luettaessa salasanan erääntymisaikaa. Virhekoodi: {$a->errno}; Virhemerkkijono: {$a->errstring}';
$string['updatepasserrorexpiregrace'] = 'Virhe kohteessa user_update_password() muokattaessa erääntymisaikaa ja/tai grace-kirjautumisia. Virhekoodi: {$a->errno}; Virhemerkkijono: {$a->errstring}';
$string['updateremfail'] = 'Virhe päivitettäessä  LDAP-merkintää. Virhekoodi: {$a->errno}; Virhemerkkijono: {$a->errstring}<br/>Avain ({$a->key}) - vanha moodlearvo: \'{$a->ouvalue}\' uusi arvo: \'{$a->nuvalue}\'';
$string['updateremfailamb'] = 'Ei voitu päivittää LDAP:ia epäselvällä kentällä {$a->key}; vanha moodlearvo: \'{$a->ouvalue}\', uusi arvo: \'{$a->nuvalue}\'';
$string['updateusernotfound'] = 'Käyttäjää ei löydetty ulkoisesti päivitettäessä. Yksityiskohdat: etsintäkanta: \'{$a->userdn}\'; etsintäsuodatin: \'(objectClass=*)\'; etsintäattribuutit: {$a->attribs}';
$string['user_activatenotsupportusertype'] = 'auth: ldap user_activate() ei tue valittua käyttäjätyyppiä: {$a}';
$string['user_disablenotsupportusertype'] = 'auth: ldap user_disable() ei tue valittua käyttäjätyyppiä: {$a}';
$string['useracctctrlerror'] = 'Virhe haettaessa userAccountControl:ia kohteelle {$a}';
$string['userentriestoadd'] = 'Lisättävät käyttäjämerkinnät: {$a}';
$string['userentriestoremove'] = 'Poistettavat käyttäjämerkinnät: {$a}';
$string['userentriestorevive'] = 'Palautettavat käyttäjämerkinnät: {$a}';
$string['userentriestoupdate'] = 'Päivitettävät käyttäjämerkinnät: {$a}';
$string['usernotfound'] = 'Käyttäjää ei löytynyt LDAP:ista';
