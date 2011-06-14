<?php

// All of the language strings in this file should also exist in
// auth.php to ensure compatibility in all versions of Moodle.

$string['auth_dbdescription'] = 'Tämä moduuli tarkistaa ulkoisen tietokannan taulusta käyttäjätunnuksen ja salasanan. Jos käyttäjätunnus on uusi, myös muita tietoja voidaan kopioida Moodleen.';
$string['auth_dbextrafields'] = 'Nämä kentät ovat valinnaisia. Voit asettaa Moodlen hakemaan valmiiksi joitakin käyttäjätietoja <b>ulkoisesta tietokannasta</b>.<p>Jos jätät nämä kentät tyhjiksi, käytetään oletusasetusarvoja.</p> <p>Käyttäjä voi joka tapauksessa muuttaa omia henkilötietojaan myöhemmin.</p>';
$string['auth_dbfieldpass'] = 'Salasanakentän nimi';
$string['auth_dbfielduser'] = 'Käyttäjätunnuskentän nimi';
$string['auth_dbhost'] = 'Tietokantapalvelin';
$string['auth_dbname'] = 'Tietokannan nimi';
$string['auth_dbpass'] = 'Salasana käyttäjätunnukselle';
$string['auth_dbpasstype'] = 'Määritä salasanakentän käyttämä muoto. MD5-salaus on hyödyllinen, jos haluat käyttää muita web-sovelluksia kuten PostNukea.';
$string['auth_dbtable'] = 'Tietokannan taulun nimi';
$string['auth_dbtitle'] = 'Käytä ulkoista tietokantaa';
$string['auth_dbtype'] = 'Tietokannan tyyppi (Katso <a href=\"../lib/adodb/readme.htm#drivers\">ADOdb dokumentoinnista</a> yksityiskohdat)';
$string['auth_dbuser'] = 'Käyttäjätunnus tietokantaan lukuoikeuksin';