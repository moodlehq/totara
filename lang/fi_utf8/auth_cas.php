<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_cas_baseuri'] = 'Palvelimen URI (tyhjä, jos ei baseURIa)<br /> Esimerkiksi, jos CAS-palvelin on ´host.domaine.fr/CAS/´, niin tällöin<br />
cas_baseuri = CAS/';
$string['auth_cas_create_user'] = 'Laita tämä asetus päälle, jos haluat lisätä CAsvarmistetut käyttäjät Moodlen tietokantaan. Jos näin ei tehdä, vain jo ennestään Moodlen tietokannassa olevat käyttäjät voivat kirjautua sisään.';
$string['auth_cas_enabled'] = 'Laita tämä asetus päälle, jos haluat käyttää CAS-varmennusta';
$string['auth_cas_hostname'] = 'CAS-palvelimen palvelinnimi 
<br />Esim. host.domain.fr';
$string['auth_cas_invalidcaslogin'] = 'Kirjautumisesi ei onnistunut - sinua ei voitu varmentaa';
$string['auth_cas_language'] = 'Valitse kieli';
$string['auth_cas_logincas'] = 'Suojatun yhteyden muodostus';
$string['auth_cas_port'] = 'CAS-palvelimen käyttämä portti';
$string['auth_cas_server_settings'] = 'CAS-palvelimen asetukset';
$string['auth_cas_text'] = 'Suojattu yhteys';
$string['auth_cas_version'] = 'CAS:in versio';
$string['auth_casdescription'] = 'Tässä menetelmässä käytetään CAS-palvelinta (Central Authentication Service) käyttäjien varmennukseen käyttämällä yhden kirjautumisen ympäristöä, Single Sign On environment (SSO). Voit myös käyttää yksinkertaista LDAP-varmistusta. Jos annettu käyttäjänimi ja salasana ovat kelvollisia CAS:n mukaan Moodle luo uuden käyttäjätiedon tietokantaan ottaen käyttäjätiedot LDAP:stä, jos se  on tarpeen. Seuraavilla kirjautumiskerroilla vain käyttäjänimi ja salasana tarkistetaan.';
$string['auth_castitle'] = 'Käytä CAS-palvelinta (SSO)';