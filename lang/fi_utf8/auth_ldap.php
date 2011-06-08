<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_ldap_bind_dn'] = 'Jos haluat käyttää välityskäyttäjää yhteyden muodostamiseen, määritä se tähän. Esim. \'cn=ldapuser,ou=public,o=org\'';
$string['auth_ldap_bind_pw'] = 'Salasana välityskäyttäjälle.';
$string['auth_ldap_bind_settings'] = 'Sidosasetukset';
$string['auth_ldap_contexts'] = 'Lista konteksteista, missä käyttäjät sijaitsevat. Erota kontekstit toisistaan \';\'-merkillä. Esim: \'ou=users,o=org; ou=others,o=org\'';
$string['auth_ldap_create_context'] = 'Jos sähköpostiviestillä tunnuksensa varmentaneet käyttäjät luodaan automaattisesti ldap-hakemistoon, määritä tässä konteksti, minne käyttäjät luodaan. On hyvä käyttää jotain erityistä kontekstia, jotta vältyt tietoturvariskeiltä. Tätä kontekstia ei tarvitse erikseen lisätä yllä olevaan muuttujaan.';
$string['auth_ldap_creators'] = 'Lista ryhmistä, joiden jäsenet voivat luoda uusia kursseja Moodleen. Erota useat ryhmät toisistaan \';\'-merkillä. Esimerkiksi \'cn=teachers,ou=staff,o=myorg;\'';
$string['auth_ldap_expiration_desc'] = 'Valitse \"Ei\" poistaaksesi vanhentuneiden salasanojen seurannan. Tai \"LDAP\" jos haluat näyttää käyttäjille viestin kun heidän salasanansa on vanhenemassa.';
$string['auth_ldap_expiration_warning_desc'] = 'päivien määrä ennen salasanan voimassaolon loppumista on asetettu.';
$string['auth_ldap_expireattr_desc'] = 'Valinnainen: ylimääritä haluamasi';
$string['auth_ldap_graceattr_desc'] = 'Valinnainen: ohita graceLogin atribuutti';
$string['auth_ldap_gracelogins_desc'] = 'Käytä LDAP graceLogin -ominaisuutta. Esim. Edirectory voidaan konfiguroida kirjaamaan käyttäjä sisään vielä muutaman kerran salasanan vanhenemisen jälkeen, jotta salasana voidaan vaihtaa. Jos haluat antaa ilmoituksen, kun käyttäjä käyttää grace-logineja, valitse \"Kyllä\".';
$string['auth_ldap_host_url'] = 'Määritä LDAP-palvelin URL-muodossa. Esim. \'ldap://ldap.myorg.com/\' tai \'ldaps://ldap.myorg.com/\'';
$string['auth_ldap_login_settings'] = 'Kirjautumisasetukset';
$string['auth_ldap_memberattribute'] = 'Valinnainen: ylimääritä käyttäjän ryhmäjäsenyysattribuutti. Yleensä \'member\' tai \'groupMembership\'';
$string['auth_ldap_objectclass'] = 'Valinnainen: ylimääritä objectClass, jota käytetään käyttäjien hakuun.';
$string['auth_ldap_opt_deref'] = 'määrittää, kuinka aliakset käsitellään haun aikana. Valitse yksi seuraavista vaihtoehdoista: \"Ei\" (LDAP_DEREF_NEVER) tai \"Kyllä\" (LDAP_DEREF_ALWAYS)';
$string['auth_ldap_passwdexpire_settings'] = 'LDAP -salasanojen vanheneminen';
$string['auth_ldap_preventpassindb'] = 'Valitse kyllä, jos haluat estää salasanojen tallentamisen Moodlen tietokantaa.';
$string['auth_ldap_search_sub'] = 'Aseta arvo <> 0, jos haluat hakea käyttäjiä myös alikonteksteista.';
$string['auth_ldap_server_settings'] = 'LDAP -palvelimen asetukset';
$string['auth_ldap_update_userinfo'] = 'Päivitä käyttäjätiedot LDAP:ista Moodleen (etunimi, sukunimi, osoite..). Katso <a href=\"/auth/ldap/attr_mappings.php\">/auth/ldap/attr_mappings.php</a> tarkempia määrittelytietoja.';
$string['auth_ldap_user_attribute'] = 'Valinnainen: ylimäärittele attribuutti käyttäjänimille. Yleensä \'cn\'.';
$string['auth_ldap_user_settings'] = 'Käyttäjien etsintä';
$string['auth_ldap_user_type'] = 'Valitse kuinka käyttäjät tallennetaan LDAP:iin. Tämä asetus myös määrittää kuinka sisäänkirjautumisen voimassaolo, vapaat sisäänkirjautumiset ja käyttäjien luominen toimii';
$string['auth_ldap_version'] = 'Palvelimella käytettävä LDAP -protokollaversio';
$string['auth_ldapdescription'] = 'Tämä tapa tarjoaa käyttäjätunnistuksen LDAP-palvelimelta. Jos salasana ja tunnus täsmäävät, Moodle luo uuden käyttäjän  tietokantaansa. 

Seuraavilla kerroilla ainoastaan tunnus ja salasana tarkistetaan.';
$string['auth_ldapextrafields'] = 'Nämä kentät ovat valinnaisia. Voit asettaa Moodlen hakemaan käyttäjätietoja tässä määritellyistä <b>LDAP-kentistä</b>. Mikäli jätät nämä tyhjiksi, mitään tietoja ei haeta LDAP-palvelimelta ja käytetään Moodlen oletusarvoja.
<p>Käyttäjä voi joka tapauksessa muuttaa omia henkilötietojaan jälkeenpäin.</p>';
$string['auth_ldaptitle'] = 'Käytä LDAP-palvelinta';