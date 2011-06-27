<?PHP // $Id$ 
      // auth.php - created with Moodle 1.9.12 (Build: 20110510) (2007101591.03)


$string['CASform'] = 'Käyttäjäntunnistuksen vaihtoehdot';
$string['accesCAS'] = 'CAS-käyttäjät';
$string['accesNOCAS'] = 'muut käyttäjät';
$string['actauthhdr'] = 'Aktiiviset käyttäjäntunnistuksen lisäosat';
$string['alternatelogin'] = 'Jos kirjoitat tähän URL:n, sitä käytetään kirjautumissivuna tälle sivustolle. Sivun pitäisi sisältää lomake, jonak ominaisuudet on asetettu <strong>\'$a\'</strong> ja joko antaa paluukentät <strong>käyttäjänimi</strong> and <strong>salasana</strong>.<br />

Ole varovainen, ettet syötä virheellistä URL:ää, koska siten voit lukita itsesi ulos sivustoltasi.<br />

Jätä tämä kohta tyhjäksi käyttääksesi oletuskirjautumissivua.';
$string['alternateloginurl'] = 'Vaihtoehtoinen kirjautumis-URL';
$string['auth_cas_auth_user_create'] = 'Luo käyttäjät ulkopuolelta';
$string['auth_cas_baseuri'] = 'Palvelimen URI (tyhjä, jos ei baseURIa)<br /> Esimerkiksi, jos CAS-palvelin on ´host.domaine.fr/CAS/´, niin tällöin<br />
cas_baseuri = CAS/';
$string['auth_cas_baseuri_key'] = 'baseURI';
$string['auth_cas_broken_password'] = 'Et voi jatkaa vaihtamatta salasanaasi. Sivua, jolla voisit sen vaihtaa ei ole. Ota yhteyttä sivuston hallinnoijaan.';
$string['auth_cas_cantconnect'] = 'CAS-moduulin LDAP-osa ei saa yhteyttä serveriin: $a';
$string['auth_cas_casversion'] = 'Versio';
$string['auth_cas_certificate_check'] = 'Valitse \"kyllä\", mikäli haluat validoida serverisertifikaatin';
$string['auth_cas_certificate_check_key'] = 'Serverin validointi';
$string['auth_cas_certificate_path'] = 'CA-ketjutiedoston (PEM-muotoinen) sijainti serverisertifikaatin validointia varten';
$string['auth_cas_certificate_path_empty'] = 'Jos oata käyttöön serverin validoinnin, sinun pitää määritellä serifikaatin sijainti';
$string['auth_cas_certificate_path_key'] = 'Sertifikaatin sijainti';
$string['auth_cas_changepasswordurl'] = 'URL salasanan vaihtoon';
$string['auth_cas_create_user'] = 'Laita tämä asetus päälle, jos haluat lisätä CAS-varmistetut käyttäjät Moodlen tietokantaan. Jos näin ei tehdä, vain jo ennestään Moodlen tietokannassa olevat käyttäjät voivat kirjautua sisään.';
$string['auth_cas_create_user_key'] = 'Luo käyttäjä';
$string['auth_cas_enabled'] = 'Laita tämä asetus päälle, jos haluat käyttää CAS-varmennusta';
$string['auth_cas_hostname'] = 'CAS-palvelimen palvelinnimi 
<br />Esim. host.domain.fr';
$string['auth_cas_hostname_key'] = 'Host-nimi';
$string['auth_cas_invalidcaslogin'] = 'Kirjautumisesi ei onnistunut - sinua ei voitu varmentaa';
$string['auth_cas_language'] = 'Valitse kieli';
$string['auth_cas_language_key'] = 'Kieli';
$string['auth_cas_logincas'] = 'Suojatun yhteyden muodostus';
$string['auth_cas_logoutcas'] = 'Valitse tähän \"kyllä\" mikäli haluat CAS:in kirjautuvan ulos kun katkaiset yhteyden Moodleen';
$string['auth_cas_logoutcas_key'] = 'Kirjaa CAS ulos';
$string['auth_cas_multiauth'] = 'Valitse tähän \"kyllä\" mikäli haluat moninkertaisen käyttäjäntunnistuksen (CAS ja joku muu tunnistustapa)';
$string['auth_cas_multiauth_key'] = 'Moninkertainen käyttäjäntunnistus';
$string['auth_cas_port'] = 'CAS-palvelimen käyttämä portti';
$string['auth_cas_port_key'] = 'Portti';
$string['auth_cas_proxycas'] = 'Valitse tähän \"kyllä\" mikäli käytät CAS:in proxy-tilaa';
$string['auth_cas_proxycas_key'] = 'Proxy-tila';
$string['auth_cas_server_settings'] = 'CAS-palvelimen asetukset';
$string['auth_cas_text'] = 'Suojattu yhteys';
$string['auth_cas_use_cas'] = 'Käytä CAS:ia';
$string['auth_cas_version'] = 'CAS:in versio';
$string['auth_casdescription'] = 'Tässä menetelmässä käytetään CAS-palvelinta (Central Authentication Service) käyttäjien varmennukseen käyttämällä yhden kirjautumisen ympäristöä, Single Sign On environment (SSO). Voit myös käyttää yksinkertaista LDAP-varmistusta. Jos annettu käyttäjänimi ja salasana ovat kelvollisia CAS:n mukaan Moodle luo uuden käyttäjätiedon tietokantaan ottaen käyttäjätiedot LDAP:stä, jos se  on tarpeen. Seuraavilla kirjautumiskerroilla vain käyttäjänimi ja salasana tarkistetaan.';
$string['auth_casnotinstalled'] = 'CAS-käyttäjäntunnistusta ei voida käyttää. PHP LDAP-moduulia ei ole asennettu.';
$string['auth_castitle'] = 'Käytä CAS-palvelinta (SSO)';
$string['auth_changepasswordhelp'] = 'Salasanan vaihto-ohjeet';
$string['auth_changepasswordurl'] = 'Salasanan vaihto URL-osoite';
$string['auth_changepasswordurl_expl'] = 'Syötä url, joka lähetetään käyttäjille, jotka ovat hävittäneet \$a-salasanansa. Aseta <strong>Käytä oletussivua salasanan vaihdolle </strong>-valintaan <strong>Ei</strong>.';
$string['auth_changingemailaddress'] = 'Olet vaihtamassa sähköpostiosoitettasi osoitteesta $a->oldemail osoitteeseen $a->newemail. Turvallisuuden takia uuteen osoitteeseen lähetetään varmistusviesti, jotta voit osoittaa sen kuuluvan sinulle. Osoitteesi päivitetään heti, kun käyt viestin ilmoittamassa URL-osoitteessa.';
$string['auth_common_settings'] = 'Yleiset asetukset';
$string['auth_data_mapping'] = 'Tietojen yhdistäminen';
$string['auth_dbcantconnect'] = 'Ei saatu yhteyttä pyydettyyn käyttäjäntunnistustietokantaan...';
$string['auth_dbchangepasswordurl_key'] = 'URL salasanan vaihdolle';
$string['auth_dbdebugauthdb'] = 'Debug ADOdb';
$string['auth_dbdeleteuser'] = 'Käyttäjä $a[0], id $a[1] poistettiin';
$string['auth_dbdeleteusererror'] = 'Käyttäjää $a poistettaessa tapahtui virhe';
$string['auth_dbdescription'] = 'Tämä moduuli tarkistaa ulkoisen tietokannan taulusta käyttäjätunnuksen ja salasanan. Jos käyttäjätunnus on uusi, myös muita tietoja voidaan kopioida Moodleen.';
$string['auth_dbextencoding'] = 'Ulkoisen tietokannan koodaus';
$string['auth_dbextencodinghelp'] = 'Ulkoisessa tietokannassa käytetty koodaustapa';
$string['auth_dbextrafields'] = 'Nämä kentät ovat valinnaisia. Voit asettaa Moodlen hakemaan valmiiksi joitakin käyttäjätietoja <b>ulkoisesta tietokannasta</b>.<p>Jos jätät nämä kentät tyhjiksi, käytetään oletusasetusarvoja.</p> <p>Käyttäjä voi joka tapauksessa muuttaa omia henkilötietojaan myöhemmin.</p>';
$string['auth_dbfieldpass'] = 'Salasanakentän nimi';
$string['auth_dbfieldpass_key'] = 'Salasanakenttä';
$string['auth_dbfielduser'] = 'Käyttäjätunnuskentän nimi';
$string['auth_dbfielduser_key'] = 'Käyttäjätunnuskenttä';
$string['auth_dbhost'] = 'Tietokantapalvelin';
$string['auth_dbhost_key'] = 'Host';
$string['auth_dbinsertuser'] = 'Käyttäjä $a[0], id $a[1] lisättiin';
$string['auth_dbinsertusererror'] = 'Käyttäjää $a lisätessä tapahtui virhe';
$string['auth_dbname'] = 'Tietokannan nimi';
$string['auth_dbname_key'] = 'Tietokannan nimi';
$string['auth_dbpass'] = 'Salasana käyttäjätunnukselle';
$string['auth_dbpass_key'] = 'Salasana';
$string['auth_dbpasstype'] = 'Määritä salasanakentän käyttämä muoto. MD5-salaus on hyödyllinen, jos haluat käyttää muita web-sovelluksia kuten PostNukea.';
$string['auth_dbpasstype_key'] = 'Salasanamuoto';
$string['auth_dbreviveduser'] = 'Käyttäjä $a[0], id $a[1] elvytettiin';
$string['auth_dbrevivedusererror'] = 'Käyttäjää $a elvytettäessä tapahtui virhe';
$string['auth_dbtable'] = 'Tietokannan taulun nimi';
$string['auth_dbtitle'] = 'Käytä ulkoista tietokantaa';
$string['auth_dbtype'] = 'Tietokannan tyyppi (Katso <a href=\"../lib/adodb/readme.htm#drivers\">ADOdb dokumentoinnista</a> yksityiskohdat)';
$string['auth_dbtype_key'] = 'Tietokanta';
$string['auth_dbuser'] = 'Käyttäjätunnus tietokantaan lukuoikeuksin';
$string['auth_emailchangecancel'] = 'Peruuta sähköpostiosoitteen muutos';
$string['auth_emaildescription'] = 'Sähköpostivarmistus on oletusarvoinen tunnistusmetodi käyttäjälle.
Kun käyttäjä luo itselleen tunnuksen, lähetetään varmistusviesti
käyttäjälle. Viesti sisältää linkin, jonka avulla käyttäjä voi aktivoida tunnuksensa.';
$string['auth_emailnoemail'] = 'Sähköpostin lähettäminen sinulle epäonnistui!';
$string['auth_emailsettings'] = 'Asetukset';
$string['auth_emailtitle'] = 'Käytä sähköpostivarmistusta';
$string['auth_emailupdate'] = 'Sähköpostiosoitteen päivitys';
$string['auth_emailupdatemessage'] = '$a->fullname,

Olet pyytänyt sähköpostiosoiteen muutosta moodle sivustolla $a->site. Osoitteesi päivitetään heti, kun käyt web-selaimella seuraavassa osoitteessa.

\$a-url';
$string['auth_fccreators'] = 'Tämän ryhmän (ryhmien) jäsenet saavat luoda uusia kursseja. Erottele useat ryhmänimet \';\'-merkillä. Nimet on oltava täysin samoin kuin FirstClass -palvelimella.';
$string['auth_fccreators_key'] = 'Luojat';
$string['auth_fcdescription'] = 'Tämä menetelmä käyttää FirstClass -palvelinta tarkistaakseen, ovatko annettu käyttäjänimi ja salasana voimassaolevia.';
$string['auth_fcfppport'] = 'Palvelinportti (3333 on yleisin)';
$string['auth_fchost'] = 'FirstClass -palvelimen osoite. Käytä IP-numeroa tai DNS-nimeä.';
$string['auth_fcpasswd'] = 'Salasana yllä olevalle tilille';
$string['auth_fcpasswd_key'] = 'Salasana';
$string['auth_fctitle'] = 'Käytä FirstClass -palvelinta';
$string['auth_fcuserid'] = 'Käyttäjätunnus FirstClass -tilille etuoikeutetulla \"alaylläpitäjä\" -asetuksella.';
$string['auth_fieldlock'] = 'Lukitse arvo';
$string['auth_fieldlock_expl'] = '<p><b>Lukitse arvo:</b>Päällä ollessaan tämä asetus estää Moodlen käyttäjiä ja ylläpitäjiä muokkaamasta kenttää suoraan. Käytä täta asetusta, jos hallinnoit tätä tietoa ulkoisesta järjestelmästä.</p>';
$string['auth_fieldlocks'] = 'Lukitse käyttäjien kentät';
$string['auth_fieldlocks_help'] = '<p>Voit lukita käyttäjien tietokentät. Tämä on hyödyllistä sivustoilla, joilla ylläpitäjät hallinnoivat käyttäjätietoja käsin muokkaamalla käyttäjärekistereitä tai kopioimalla palvelimelle käyttäen ´Upload Users´-toimintoa. Jos lukitset kenttiä, joita Moodle tarvitsee, varmista että annat kenttien tiedot luodessasi käyttäjiä tai muuten käyttäjätilit ovat käyttökelvottomia.</p>
<p>Harkitse ´Lukitsematon, jos tyhjä´-asetuksen käyttöä välttääksesi tämän ongelman.</p>';
$string['auth_imapdescription'] = 'Tämä tapa käyttää IMAP-palvelinta käyttäjätunnuksen ja salasanan tarkistamiseen.';
$string['auth_imaphost'] = 'IMAP-palvelimen osoite. Käytä IP-numeroa, älä domainnimeä.';
$string['auth_imapport'] = 'IMAP-palvelimen portti, yleensä 143 tai 993.';
$string['auth_imaptitle'] = 'Käytä IMAP-palvelinta';
$string['auth_imaptype'] = 'IMAP-palvelimen tyyppi. Katso ohjeesta (yllä) lisätietoja.';
$string['auth_ldap_bind_dn'] = 'Jos haluat käyttää välityskäyttäjää yhteyden muodostamiseen, määritä se tähän. Esim. \'cn=ldapuser,ou=public,o=org\'';
$string['auth_ldap_bind_pw'] = 'Salasana välityskäyttäjälle.';
$string['auth_ldap_bind_settings'] = 'Sidosasetukset';
$string['auth_ldap_contexts'] = 'Lista konteksteista, missä käyttäjät sijaitsevat. Erota kontekstit toisistaan \';\'-merkillä. Esim: \'ou=users,o=org; ou=others,o=org\'';
$string['auth_ldap_contexts_key'] = 'Kontekstit';
$string['auth_ldap_create_context'] = 'Jos sähköpostiviestillä tunnuksensa varmentaneet käyttäjät luodaan automaattisesti ldap-hakemistoon, määritä tässä konteksti, minne käyttäjät luodaan. On hyvä käyttää jotain erityistä kontekstia, jotta vältyt tietoturvariskeiltä. Tätä kontekstia ei tarvitse erikseen lisätä yllä olevaan muuttujaan.';
$string['auth_ldap_create_context_key'] = 'Uusien käyttäjien konteksti';
$string['auth_ldap_creators'] = 'Lista ryhmistä, joiden jäsenet voivat luoda uusia kursseja Moodleen. Erota useat ryhmät toisistaan \';\'-merkillä. Esimerkiksi \'cn=teachers,ou=staff,o=myorg;\'';
$string['auth_ldap_creators_key'] = 'Luojat';
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
$string['auth_ldap_preventpassindb_key'] = 'Piilota salasanat';
$string['auth_ldap_search_sub'] = 'Aseta arvo <> 0, jos haluat hakea käyttäjiä myös alikonteksteista.';
$string['auth_ldap_server_settings'] = 'LDAP -palvelimen asetukset';
$string['auth_ldap_update_userinfo'] = 'Päivitä käyttäjätiedot LDAP:ista Moodleen (etunimi, sukunimi, osoite..). Katso <a href=\"/auth/ldap/attr_mappings.php\">/auth/ldap/attr_mappings.php</a> tarkempia määrittelytietoja.';
$string['auth_ldap_user_attribute'] = 'Valinnainen: ylimäärittele attribuutti käyttäjänimille. Yleensä \'cn\'.';
$string['auth_ldap_user_settings'] = 'Käyttäjien etsintä';
$string['auth_ldap_user_type'] = 'Valitse kuinka käyttäjät tallennetaan LDAP:iin. Tämä asetus myös määrittää kuinka sisäänkirjautumisen voimassaolo, vapaat sisäänkirjautumiset ja käyttäjien luominen toimii';
$string['auth_ldap_version'] = 'Palvelimella käytettävä LDAP -protokollaversio';
$string['auth_ldap_version_key'] = 'Versio';
$string['auth_ldapdescription'] = 'Tämä tapa tarjoaa käyttäjätunnistuksen LDAP-palvelimelta. Jos salasana ja tunnus täsmäävät, Moodle luo uuden käyttäjän  tietokantaansa. 

Seuraavilla kerroilla ainoastaan tunnus ja salasana tarkistetaan.';
$string['auth_ldapextrafields'] = 'Nämä kentät ovat valinnaisia. Voit asettaa Moodlen hakemaan käyttäjätietoja tässä määritellyistä <b>LDAP-kentistä</b>. Mikäli jätät nämä tyhjiksi, mitään tietoja ei haeta LDAP-palvelimelta ja käytetään Moodlen oletusarvoja.
<p>Käyttäjä voi joka tapauksessa muuttaa omia henkilötietojaan jälkeenpäin.</p>';
$string['auth_ldaptitle'] = 'Käytä LDAP-palvelinta';
$string['auth_manualdescription'] = 'Käyttäjät eivät voi itse luoda omia tunnuksiaan. Pääkäyttäjien pitää luoda kaikki käyttäjät käsin.';
$string['auth_manualtitle'] = 'Käsinluonti';
$string['auth_multiplehosts'] = 'Voit määritellä useita osoitteita ( joku.jossain.com;joku.toinen.com;... )';
$string['auth_nntpdescription'] = 'Tämä tapa käyttää NNTP-palvelinta käyttäjän tunnistukseen.';
$string['auth_nntphost'] = 'NNTP-palvelimen osoite. Käytä IP-numeroa, älä domainnimeä.';
$string['auth_nntpport'] = 'NNTP-palvelimen portti (yleensä 119)';
$string['auth_nntptitle'] = 'Käytä NNTP-palvelinta';
$string['auth_nonedescription'] = 'Käyttäjät voivat luoda vapaasti uuden tunnuksen ilman sähköpostivarmistusta. 
Jos käytät tätä tapaa, mieti, mitä tietoturva- tai ylläpito-ongelmia tämä voi aiheuttaa.';
$string['auth_nonetitle'] = 'Ei tunnistusta';
$string['auth_pamdescription'] = 'Tämä menetelmä käyttää PAM:ia päästäkseen käsiksi tämän palvelimen alkuperäisiin käyttäjänimiin. Sinun täytyy asentaa <a href=\"http://www.math.ohio-state.edu/~ccunning/pam_auth/\" target=\"_blank\">PHP4 PAM Authentication</a> päästäksesi käyttämään tätä moduulia.';
$string['auth_pamtitle'] = 'PAM (kytkettävät oikeuksientarkistamismoduulit)';
$string['auth_passwordisexpired'] = 'Salasanasi on vanhentunut. Haluatko vaihtaa salasanasi nyt?';
$string['auth_passwordwillexpire'] = 'Salasanasi vanhentuu $a päivässä. Haluatko vaihtaa salasanasi nyt?';
$string['auth_pop3description'] = 'Tämä tapa käyttää POP3-palvelinta käyttäjän tunnistukseen.';
$string['auth_pop3host'] = 'POP3-palvelimen osoite. Käytä IP-numeroa, älä domainnimeä.';
$string['auth_pop3mailbox'] = 'Postilaatikon nimi jonka kanssa yritetään yhteyttä. (yleensä INBOX)';
$string['auth_pop3port'] = 'POP3-palvelimen portti (yleensä 110 )';
$string['auth_pop3title'] = 'Käytä POP3-palvelinta';
$string['auth_pop3type'] = 'Palvelimen tyyppi. Jos käytätte salattua yhteyttä, valitse pop3cert.';
$string['auth_radiushost'] = 'RADIUS-palvelimen osoite';
$string['auth_radiusnasport'] = 'Palvelimen portti';
$string['auth_radiussecret'] = 'jaettu salainen sana';
$string['auth_radiustitle'] = 'Käytä RADIUS-palvelinta';
$string['auth_shib_convert_data'] = 'Tiedon muokaamisen API';
$string['auth_shib_convert_data_description'] = 'Voit käyttää tätä APIa muokataksesi edelleen tietoja, joita Shibboleth tarjoaa. Lue  <a href=\"../auth/shibboleth/README.txt\" target=\"_blank\">README (englanniksi)</a> saadakseis lisää tietoa.';
$string['auth_shib_convert_data_warning'] = 'Tiedosto ei ole olemassa tai se ei ole verkkopalvelinprosessin luettavissa!';
$string['auth_shib_instructions'] = 'Käytä <a href=\"$a\">Shibboleth-kirjautumista</a> käyttääksesi yhteyden muodostamiseen Shibbolethia, jos se on tarjolla. <br />
Muuten voit käyttää tätä tavallista kirjautumislomaketta.';
$string['auth_shib_instructions_help'] = 'Tähän voit kirjoittaa lisäohjeita käyttäjillesi selittääksesi Shibboleth-varmennusta. Nämä ohjeet näytetään kirjautumissivun ohjeosiossa. Siinä pitäisi olla linkki, joka ohjaa käyttäjät \"<b>$a</b>\", niin että Shibbolethin käyttäjät voivat kirjautua sisään Moodleen. Jos jätät tämän tyhjäksi, näytetää käyttäjille tavalliset ohjeet (eivät käsittele erityisesti Shibbolethia)';
$string['auth_shib_only'] = 'Vain Shibboleth';
$string['auth_shib_only_description'] = 'Käytä tätä valintaa, jos haluat pakottaa Shibboleth-varmennuksen';
$string['auth_shib_username_description'] = 'Sen verkkopalvelimen Shibboleth-ympäristön muuttujan nimi, jota käytetään Moodlen käyttäjänimenä.';
$string['auth_shibboleth_errormsg'] = 'Valitse organisaation, jonka jäsen olet!';
$string['auth_shibboleth_login'] = 'Shibboleth-kirjautuminen';
$string['auth_shibboleth_manual_login'] = 'Sisäänkirjautuminen käsin';
$string['auth_shibbolethdescription'] = 'Tätä menetelmää käyttäessä käyttäjät luodaan ja varmennetaan käyttäen href=\"http://shibboleth.internet2.edu/\" target=\"_blank\">Shibboleth-käyttäjänvarmennusta</a>. Lue <a href=\"../auth/shibboleth/README.txt\" target=\"_blank\">README (englanniksi)</a>, jossa kerrotaan kuinka Moodle asetetaan käyttämään Shibbolethin-varmennusta.';
$string['auth_shibbolethtitle'] = 'Shibboleth';
$string['auth_updatelocal'] = 'Päivitä sisäinen arvo';
$string['auth_updatelocal_expl'] = '<p><b>Päivitä sisäinen arvo:</b> Jos ei onnistu, kenttä päivittyy joka kerta käyttäjän kirjautuessa tai käyttäjäsynkronoinnin yhteydessä. Kentät jotka on asetettu päivittymään paikallisesti tulisi lukita.</p>';
$string['auth_updateremote'] = 'Päivitä ulkoinen arvo';
$string['auth_updateremote_expl'] = '<p><b>Päivitä ulkoinen tieto:</b> Jos tämä ei onnistu, ulkoinen tieto päivitetään samalla kun käyttäjärekisteri päivitetään. Kenttien pitäisi olla lukitsemattomia, jotta editointi sallitaan.</p>';
$string['auth_updateremote_ldap'] = '<p><b>Huomautus:</b> Ulkoisen LDAP -tiedon päivitys vaatii, että asetetaan binddn ja bindpw
kaikille sidoskäyttäjille muotoiluoikeus kaikkiin käyttäjärekistereihin. Se ei tällä hetkellä säilytä moniarvoisia määreitä, eikä poista ylimääräisiä arvoja päivityksessä. </p>';
$string['auth_user_create'] = 'Käyttäjän luonti';
$string['auth_user_creation'] = 'Käyttäjät voivat itse luoda tunnuksensa. Käyttäjätiedot tarkistetaan sähköpostin avulla. Jos aktivoit tämän vaihtoehdon, muista myös määritellä kayttäjäntunnistuksen muut tähän liittyvät asetukset.';
$string['auth_usernameexists'] = 'Käyttäjätunnus on jo käytössä. Valitse joku toinen.';
$string['authenticationoptions'] = 'Käyttäjätunnistuksen asetukset';
$string['authinstructions'] = 'Tähän voi kirjoittaa ohjeet opiskelijoille, mitä tunnusta ja salasanaa heidän tulisi käyttää. Tämä teksti näkyy kirjautumissivulla.';
$string['changepassword'] = 'Salasananvaihto-URL';
$string['changepasswordhelp'] = 'Tässä osoitteessa käyttäjät voivat vaihtaa unohtamansa salasanan. Käyttäjille tämä näkyy painikkeena kirjautumissivulla ja heidän käyttäjätietosivullaan.';
$string['chooseauthmethod'] = 'Valitse käyttäjäntunnistusmetodi:';
$string['createpasswordifneeded'] = 'Luo salasana tarvittaessa';
$string['enterthenumbersyouhear'] = 'Syötä kuulemasi numerot';
$string['enterthewordsabove'] = 'Syötä ylläolevat sanat';
$string['errorminpassworddigits'] = 'Salasanassa pitää olla vähintään $a merkki(ä).';
$string['errorminpasswordlength'] = 'Salasanan pitää olla vähintään $a merkkiä pitkä.';
$string['errorpasswordupdate'] = 'Salasanaa päivittäessä sattui virhe, salasanaa ei vaihdettu';
$string['forcechangepassword'] = 'Pakota salasanan vaihto';
$string['forcechangepassword_help'] = 'Pakota käyttäjät vaihtamaan salasanaa heidän seuraavalla Moodleen kirjautumiskerrallaan.';
$string['forcechangepasswordfirst_help'] = 'Pakota käyttäjät vaihtamaan salasanaa heidän ensimmäisellä Moodleen kirjautumiskerrallaan.';
$string['forcedchangeinstructions'] = 'Pakotetun vaihdon ohjeet';
$string['guestloginbutton'] = 'Kirjaudu vieraana-painike';
$string['infilefield'] = 'Salasana on tiedostossa';
$string['informpasswordpolicy'] = 'Salasanassa pitää olla $a';
$string['instructions'] = 'Ohjeet';
$string['internal'] = 'Sisäinen';
$string['locked'] = 'Lukittu';
$string['md5'] = 'MD5-salaus';
$string['nopasswordchange'] = 'Salasanaa ei voi vaihtaa';
$string['passwordhandling'] = 'Salasanakentän käsittely';
$string['plaintext'] = 'Selväkielinen teksti';
$string['showguestlogin'] = 'Voit näyttää tai piilottaa Kirjaudu vieraana-painikkeen kirjautumissivulla.';
$string['stdchangepassword'] = 'Käytä norminmukaista Vaihda salasana -sivua';
$string['stdchangepassword_expl'] = 'Jos ulkoinen oikeuksien tarkistaminen sallii salasanojen vaihdot Moodlen kautta, vaihda tämä muotoon kyllä. Tämä asetus syrjäyttää \"Vaihda salasana URL\".';
$string['stdchangepassword_explldap'] = 'HUOMAUTUS: On suositeltavaa, että käytetään ennemmin LDAP- kuin SSL-salakirjoitettua tunnelia (ldaps://), jos LDAP-palvelin on etäkäytössä.';
$string['unlocked'] = 'Lukitsematon';
$string['unlockedifempty'] = 'Lukitsematon, jos tyhjä';
$string['update_never'] = 'Ei koskaan';
$string['update_oncreate'] = 'Luotaessa';
$string['update_onlogin'] = 'Jokaisella kirjautumisella';
$string['update_onupdate'] = 'Päivitettäessä';

?>
