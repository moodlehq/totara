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
 * Strings for component 'install', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   install
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['admindirerror'] = 'Ylläpitohakemisto on määritetty väärin';
$string['admindirname'] = 'Ylläpitohakemisto';
$string['admindirsetting'] = 'Jotkut web-palvelut käyttävät /admin hakemistoa ylläpitotarkoituksiin tms. Valitettavasti tämä on ristiriidassa Moodlen ylläpitosivujen normaalin paikan kanssa. Voit korjata tämän nimeämällä asennuksesi ylläpitohakemiston uudelleen ja laittamalla uuden nimen tähän. Esimerkiksi:
<br /> <br /><b>moodleadmin</b><br /> <br />
Tämä korjaa ylläpitolinkit Moodlessa.';
$string['admindirsettinghead'] = 'Asetetaan ylläpitohakemisto';
$string['admindirsettingsub'] = 'Jotkut sivustot käyttävät /admin-hakemistoa omiin tarkoituksiinsa. Tämä on ristiriidassa moodlen /admin-kansion kanssa.
Voit korjata tämän nimeämällä moodlen admin-kansion uudelleen antamalla uuden nimen tähän.Esimerkiksi:
<br /> <br /><b>moodleadmin</b><br /> <br />
Tämä korjaa ylläpitolinkit Moodlessa.';
$string['availablelangs'] = 'Saatavilla olevat kielipaketit';
$string['caution'] = 'Varoitus';
$string['chooselanguage'] = 'Valitse kieli';
$string['chooselanguagehead'] = 'Valitse kieli';
$string['chooselanguagesub'] = 'Valitse kieli asennusohjelmaa varten. Tätä kieltä käytetään sivuston oletuskielenä. Voit valita muita kieliä käyttöösi myöhemmin.';
$string['cliadminpassword'] = 'Uusi ylläpitäjän salasana';
$string['cliadminusername'] = 'Ylläpitäjätilin käyttäjätunnus';
$string['clialreadyconfigured'] = 'Tiedosto config.php on jo olemassa, käytä admin/cli/install_database.php -tiedostoa jos haluat asentaa tämän sivuston.';
$string['clialreadyinstalled'] = 'Tiedosto config.php on jo olemassa, ole hyvä ja käytä admin/cli/upgrade.php:ta jos haluat päivittää sivustosi';
$string['cliinstallfinished'] = 'Asennus suoritettu onnistuneesti.';
$string['cliinstallheader'] = 'Moodlen {$a} komentoriviasennusohjelma';
$string['climustagreelicense'] = 'Ei-interaktiivisessa moodissa sinun täytyy hyväksyä lisenssi valitsemalla --agree-license';
$string['clitablesexist'] = 'Tietokantataulut on jo luotu, cli-asennusta ei voida jatkaa.';
$string['compatibilitysettings'] = 'Tarkistetaan PHP:n asetukset';
$string['compatibilitysettingshead'] = 'Tarkistetaan PHP:n asetukset';
$string['compatibilitysettingssub'] = 'Palvelimesi pitää läpäistä kaikki testit jotta moodle toimisi oikein.';
$string['configfilenotwritten'] = 'Asennus ei pystynyt luomaan automaattisesti config.php -tiedostoa, joka olisi sisältänyt valitsemasi asetukset, todennäköisesti koska Moodlen hakemisto on kirjoitussuojattu. Voit manuaalisesti kopioida seuraavan koodin tiedostoon nimeltä config.php Moodlen päähakemiston sisällä.';
$string['configfilewritten'] = 'config.php on luotu.';
$string['configurationcomplete'] = 'Asetukset suoritettu';
$string['configurationcompletehead'] = 'Asetukset suoritettu';
$string['configurationcompletesub'] = 'Moodle yritti tallentaa asetustiedostoa "config.php" moodlen asennuskansioon.';
$string['database'] = 'Tietokanta';
$string['databasecreationsettings'] = 'Nyt sinun täytyy asettaa asetukset tietokannalle, johon suurin osa Moodlen tiedoista tallennetaan. <br />
<br /> <br />
<b>Type:</b> asennusohjelma asettaa asetusarvoksi "mysql"<br />
<b>Host:</b> asennusohjelma asettaa asetusarvoksi "localhost"<br />
<b>Name:</b> tietokannan nimi, esim. moodle<br />
<b>User:</b>asennusohjelma asettaa oletuskäyttäjäksi "root"-käyttäjän <br />
<b>Password:</b> salasanasi tietokantaan<br />
<b>Tables Prefix:</b> valinnanvarainen etuliite kaikille taulukoille tietokannassasi';
$string['databasecreationsettingshead'] = 'Määrittele tietokanta-asetusten avulla minne moodle tallentaa tietonsa. Tietokanta luodaan seuraavien asetusten avulla automaattisesti.l';
$string['databasecreationsettingssub'] = '<b>Tyyppi:</b> Asennusohjelman lukitsema "mysql" <br />
<b>Palvelin:</b> Asennusohjelman lukitsema "localhost" <br />
<b>Nimi:</b> tietokannan nimi, esim. moodle<br />
<b>Käyttäjä:</b> Asennusohjelman lukitsema "root" <br />
<b>Salasana:</b> Tietokannan salasana<br />
<b>Talukon etuliite:</b> Etuliite kaikille tietokannan tauluille';
$string['databasecreationsettingssub2'] = '<b>Tyyppi:</b> asennusohjelma korjasi muotoon "mysqli"<br />
<b>Isäntä:</b>asennusohjelma korjasi muotoon "localhost"<br />
<b>Nimi:</b> tietokannan nimi, esim. moodle<br />
<b>Käyttäjä:</b> asennusohjelma korjasi muotoon "root"<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulujen Etuliite:</b> valinnainen etuliite kaikkien taulujen nimille';
$string['databasehead'] = 'Tietokannan asetukset';
$string['databasehost'] = 'Tietokannan isäntä';
$string['databasename'] = 'Tietokannan nimi';
$string['databasepass'] = 'Tietokannan salasana';
$string['databasesettings'] = 'Nyt sinun täytyy valita tietokanta missä suurin osa Moodlen tiedoista säilytetään. Tämän tietokannan täytyy jo valmiiksi olla luotu, kuten myös käyttäjänimen ja salasanan, joilla siihen päästään. .<br />
<br /> <br />
<b>Tyyppi:</b> mysql or postgres7<br />
<b>Palvelin:</b> localhost or db.isp.com<br />
<b>Nimi:</b> tietokannan nimi, eg moodle<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b> omavalintainen etuliite jota käytetään kaikissa taulukoissa';
$string['databasesettingshead'] = 'Määrittele tietokanta-asetusten avulla minne moodle tallentaa tietonsa. Tietokannan pitää olla jo luotuna.';
$string['databasesettingssub'] = '<b>Tyyppi:</b> mysql tai postgres7<br />
<b>Host:</b> esim localhost tai db.isp.com<br />
<b>Nimi:</b> Tietokannan nimi, eg moodle<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi e<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b> omavalintainen etuliite jota käytetään kaikissa taulukoissa';
$string['databasesettingssub_mssql'] = '<b>Tyyppi:</b> SQLServer (ei UTF-8) <br />
<b><strong class="errormsg">Kokeellinen! (ei tuotantokäyttöön)</strong></b><br /><b>Isäntä:</b> esim. localhost tai db.isp.com<br />
<b>Nimi:</b> Tietokannan nimi, esim. moodle<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b> etuliite jota käytetään kaikissa taulukoissa (pakollinen)';
$string['databasesettingssub_mssql_n'] = '<b>Tyyppi:</b> SQLServer (UTF-8) <br />
<b>Isäntä:</b> esim. localhost tai db.isp.com<br />
<b>Nimi:</b> Tietokannan nimi, esim. moodle<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b> etuliite jota käytetään kaikissa taulukoissa (pakollinen)';
$string['databasesettingssub_mysql'] = '<b>Tyyppi:</b> mysql<br />
<b>Host:</b> esim localhost tai db.isp.com<br />
<b>Nimi:</b> Tietokannan nimi, eg moodle<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b> omavalintainen etuliite jota käytetään kaikissa taulukoissa';
$string['databasesettingssub_mysqli'] = '<b>Tyyppi:</b> Parannettu MySQL<br />
<b>Isäntä:</b> esim. localhost tai db.isp.com<br />
<b>Nimi:</b> Tietokannan nimi, esim. moodle<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b> etuliite jota käytetään kaikissa taulukoissa (pakollinen)';
$string['databasesettingssub_oci8po'] = '<b>Tyyppi:</b>Oracle<br />
<b>Host:</b> ei käytössä jätä tyhjäksi<br />
<b>Nimi:</b> tnsnames.ora yhteyden nimi<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b>  etuliite jota käytetään kaikissa taulukoissa (max 2 merkkiä)';
$string['databasesettingssub_odbc_mssql'] = '<b>Tyyppi:</b> SQL*Server (over ODBC) <b><strong class="errormsg">Kokeellinen! (ei tuotantokäyttöön)</strong></b><br /> <b>Isäntä:</b> tietolähteen DSN-nimi ODBC-ohjauspaneelissa<br /> <b>Nimi:</b> tietokannan nimi, esim. moodle<br /> <b>Käyttäjä:</b> tietokannan käyttäjänimi<br /> <b>Salasana:</b> tietokannan salasana<br /> <b>Taulun etuliite:</b> etuliite käytettäväksi kaikissa taulujen nimissä (vapaaehtoinen)';
$string['databasesettingssub_postgres7'] = '<b>Tyyppi:</b> PostgreSQL <br />
<b>Host:</b> esim localhost tai db.isp.com<br />
<b>Nimi:</b> Tietokannan nimi, eg moodle<br />
<b>Käyttäjä:</b> tietokantasi käyttäjänimi<br />
<b>Salasana:</b> tietokantasi salasana<br />
<b>Taulukon etuliite:</b> pakollinen etuliite jota käytetään kaikissa taulukoissa';
$string['databasesettingswillbecreated'] = '<b>Huomaa:</b> Jos tietokantaa ei ole, asennusohjelma yrittää luoda sen automaattisesti.';
$string['databasesocket'] = 'Unix-kanta';
$string['databasetypehead'] = 'Valitse tietokannan ajuri';
$string['databasetypesub'] = 'Moodle tukee useita eri tyyppisiä tietokantapalvelimia. Ole hyvä ja ota yhteyttä palvelimen ylläpitäjään jos ei tiedä mitä tyyppiä käyttää.';
$string['databaseuser'] = 'Tietokannan käyttäjä';
$string['dataroot'] = 'Datahakemisto';
$string['datarooterror'] = '\'Datahakemistoa\', jonka määrittelit, ei löydetty, eikä sitä voitu luoda. Korjaa polku, tai luo hakemisto manuaalisesti.';
$string['datarootpermission'] = 'Datahakemistojen oikeudet';
$string['datarootpublicerror'] = 'Määrittelemääsi \'datahakemistoon\' on suora yhteys verkosta, sinun täytyy käyttää toista hakemistoa.';
$string['dbconnectionerror'] = 'Emme pystyneet kytkeytymään tietokantaan, jonka määrittelit. Tarkista tietokanta-asetuksesi.';
$string['dbcreationerror'] = 'Tietokannan luomisvirhe. Ei pystytty luomaan annettua tietokannan nimeä tarjotuilla asetuksilla.';
$string['dbhost'] = 'Isäntäpalvelin';
$string['dbpass'] = 'Salasana';
$string['dbport'] = 'Portti';
$string['dbprefix'] = 'Taulukon etumerkki';
$string['dbtype'] = 'Tyyppi';
$string['dbwrongencoding'] = 'Valittu tietokanta ei käytä suositeltavaa UTF-8 (UNICODE) merkistöä jota olsi parempi käyttää. Voit ohittaa tämän testin valitsemalla "Ohita tietokannan merkistö testi" asetuksen.';
$string['dbwronghostserver'] = 'Sinun pitää seurata Palvelin sääntöjä jotka selitetty ylempänä.';
$string['dbwrongnlslang'] = 'Verkkopalvelimesi NLS_LANG -ympäristömuuttujan täytyy käyttää AL32UTF8 merkkijoukkoa. Katso ohjeet PHP-dokumentaatiosta kuinka konfiguroida OCI8 oikein.';
$string['dbwrongprefix'] = 'Sinun pitää seurata Taulun etuliite sääntöjä jotka selitetty ylempänä.';
$string['directorysettings'] = '<p>Vahvista tämän Moodle asennuksen sijainti.</p>

<p><b>Web-osoite:</b>
Määritä koko Web osoite, josta Moodlea käytetään.
Jos websivustoosi päästään monen URL:n kautta, valitse kaikkein luonnollisin vaihtoehto, se jota oppilaasikin käyttäisivät. Älä sisällytä kenoviivaa.</p>

<p><b>Moodle-hakemisto:</b>
Määritä koko hakemistopolku tähän asennukseen. Varmista, että isot/pienet kirjaimet ovat oikein.</p>

<p><b>Data-hakemisto:</b>
Tarvitset paikan, jonne Moodle voi tallentaa ladatut tiedostot. Tämän hakemiston pitäisi olla luettavissa ja kirjoitettavissa web palvelin käyttäjän taholta (usein \'nobody\' tai \'apache\'), mutta sen ei pitäisi olla käytettävissä suoraan web:in kautta. Asennusohjelma yrittää luoda hakemiston ellei sitä ole olemassa.</p>';
$string['directorysettingshead'] = 'Vahvista tämän Moodle asennuksen sijainti';
$string['directorysettingssub'] = '<p>Vahvista tämän Moodle asennuksen sijainti.</p>

<p><b>Web-osoite:</b>
Määritä koko Web osoite, josta Moodlea käytetään.
Jos websivustoosi päästään monen URL:n kautta, valitse kaikkein luonnollisin vaihtoehto, se jota oppilaasikin käyttäisivät. Älä sisällytä kenoviivaa.</p>

<p><b>Moodle-hakemisto:</b>
Määritä koko hakemistopolku tähän asennukseen. Varmista, että isot/pienet kirjaimet ovat oikein.</p>

<p><b>Data-hakemisto:</b>
Tarvitset paikan, jonne Moodle voi tallentaa ladatut tiedostot. Tämän hakemiston pitäisi olla luettavissa ja kirjoitettavissa web palvelin käyttäjän taholta (usein \'nobody\' tai \'apache\'), mutta sen ei pitäisi olla käytettävissä suoraan web:in kautta. Asennusohjelma yrittää luoda hakemiston ellei sitä ole olemassa.</p>';
$string['dirroot'] = 'Moodle-hakemisto';
$string['dirrooterror'] = '\'Moodle hakemisto\' -asetus näyttäisi olevan väärin - Moodle-asennusta ei löytynyt. Arvo alapuolella on nollattu.';
$string['download'] = 'Lataa';
$string['downloadlanguagebutton'] = 'Lataa "{$a}"  kielipaketti';
$string['downloadlanguagehead'] = 'Lataa kielipaketti';
$string['downloadlanguagenotneeded'] = 'Voit jatkaa asennusta oletuskielellä, "{$a}"';
$string['downloadlanguagesub'] = 'Sinulla on mahdollisuus ladata kielipaketti ja jatkaa asennusprosessia tämmä kielellä.<br /><br />Jos et pysty lataamaan kielipakettia, asennusta jatketaan englanniksi. (Kun asennus on valmis sinulla on mahdollisuus ladata ja asentaa muita kielipaketteja.)';
$string['doyouagree'] = 'Hyväksytkö? (yes/no):';
$string['environmenthead'] = 'Ympäristön tarkistus';
$string['environmentsub'] = 'Asennusohjelma tarkistaa että järjestelmäsi vastaa moodlen vaatimuksia';
$string['environmentsub2'] = 'Jokaisessa Moodle-julkaisussa on joitakin vähimmäisvaatimuksia PHP-versiolta sekä joitakin pakollisia PHP-lisäosia.
Ennen jokaista asennusta ja päivitystä suoritetaan täysi ympäristön tarkistus. Ole hyvä ja ota yhteyttä palvelimen ylläpitoon jos et tiedä kuinka asentaa uutta versiota tai PHP-lisäosia.';
$string['errorsinenvironment'] = 'Ympäristön tarkastus epäonnistui!';
$string['fail'] = 'Virhe';
$string['fileuploads'] = 'Tiedostojen lähettäminen';
$string['fileuploadserror'] = 'Tämän pitäisi olla päällä';
$string['fileuploadshelp'] = '<p>Tiedostojen lähettäminen ei näyttäisi olevan käytössä palvelimellasi.</p>

<p>Moodle voidaan silti asentaa, mutta ilman tätä ominaisuutta et pysty lataamaan kurssitiedostoja tai uuden käyttäjän profiilikuvia.</p>

<p>Mahdollistaaksesi tiedostojen latauksen sinun (tai järjestelmän ylläpitäjän) täytyy muokata php.ini -tiedostoa ja muuttaa asetukseksi kohtaan <b>file_uploads</b>  \'1\'.</p>';
$string['gdversion'] = 'GD versio';
$string['gdversionerror'] = 'GD kirjaston pitäisi olla päällä, että voidaan käsitellä ja luoda kuvia.';
$string['gdversionhelp'] = '<p>Palvelimellasi ei näyttäisi olevan GD:tä asennettuna.</p>

<p>GD on kirjasto jonka PHP vaatii jotta Moodlen voisi käsitellä kuvia (esimerkiksi käyttäjä kuvia) ja luoda uusia kuvia (esimerkiksi kaavioita) Moodle toimii ilman GD:täkin, mutta silloin nämä toiminnot eivät ole saatavilla.</p>

<p>Lisätäksesi GD:n PHP:hen Unix:in alaisena, käännä PHP käyttäen --with-gd parametria.</p>

<p>Windowsin alaisena voit yleensä muokata php.ini:ä ja olla kommentoimatta rivivertailua php_gd2.dll.</p>';
$string['globalsquotes'] = 'Globaalien muuttujien turvaton käsittely';
$string['globalsquoteserror'] = 'Korjaa PHP-asetuksesi: estä register_globals ja/tai salli magic_quotes_gpc';
$string['globalsquoteshelp'] = '<p>Ei ole suositeltavaa yhtäaikaa estää magic_quotes_gpc:tä ja sallia register_globals:ia.</p>

<p>Suositeltu asetus on <b>magic_quotes_gpc = On</b> ja <b>register_globals = Off</b> php.ini:ssä</p>

<p>Jos sinulla ei ole pääsyä php.ini-tiedostoon, pystyt ehkä lisäämään seuraavan rivin tiedostoon .htaccess Moodle hakemistossasi:</p>
<blockquote><div>php_value magic_quotes_gpc On</div></blockquote>
<blockquote><div>php_value register_globals Off</div></blockquote>';
$string['inputdatadirectory'] = 'Datahakemisto:';
$string['inputwebadress'] = 'Web-osoite:';
$string['inputwebdirectory'] = 'Moodle-hakemisto:';
$string['installation'] = 'Asennus';
$string['langdownloaderror'] = 'Valitettavasti kieltä "{$a}" ei voitu ladata. Asennus jatkuu englanniksi.';
$string['langdownloadok'] = 'Kilei "{$a}" asennettiin onnistuneesti. Asennus jatkuu tällä kielellä.';
$string['magicquotesruntime'] = 'Magic quotes ajoaika';
$string['magicquotesruntimeerror'] = 'Tämän pitäisi olla poissa päältä';
$string['magicquotesruntimehelp'] = '<p>Magic quotes ajoajan pitäisi olla pois päältä, jotta Moodle voi toimia kunnolla.</p>

<p>Normaalisti se on pois päältä oletuksena... Katso asetukset
<b>magic_quotes_runtime</b> php.ini -tiedostosta.</p>

<p>Jos sinulla ei ole pääsyä php.ini:isi, saatat pystyä asettamaan seuraavan rivin tiedostoon nimeltä .htaccess Moodlen hakemiston sisällä:
<blockquote>php_value magic_quotes_runtime Off</blockquote>
</p>';
$string['memorylimit'] = 'Muistiraja';
$string['memorylimiterror'] = 'PHP muistiraja on asetettu aika alas... Se saattaa aiheuttaa ongelmia myöhemmin.';
$string['memorylimithelp'] = '<p>PHP muistiraja palvelimellesi on tällä hetkellä asetettu {$a}:han.</p>

<p>Tämä saattaa aiheuttaa Moodlelle muistiongelmia myöhemmin, varsinkin jos sinulla on paljon mahdollisia moduuleita ja/tai paljon käyttäjiä.</p>

<p>Suosittelemme, että valitset asetuksiksi PHP:n korkeimmalla mahdollisella raja-arvolla, esimerkiksi 40M.
On olemassa monia tapoja joilla voit yrittää tehdä tämän:</p>
<ol>
<li>Jos pystyt, uudelleenkäännä PHP <i>--enable-memory-limit</i>. :llä.
Tämä sallii Moodlen asettaa muistirajan itse.</li>
<li>Jos sinulla on pääsy php.ini tiedostoosi, voit muuttaa <b>memory_limit</b> asetuksen siellä johonkin kuten 40M. Jos sinulla ei ole pääsyoikeutta, voit kenties pyytää ylläpitäjää tekemään tämän puolestasi.</li>
<li>Joillain PHP palvelimilla voit luoda a .htaccess tiedoston Moodle hakemistossa, sisältäen tämän rivin:
<p><blockquote>php_value memory_limit 40M</blockquote></p>
<p>Kuitenkin, joillain palvelimilla tämä estää  <b>kaikkia</b> PHP sivuja toimimasta (näet virheet, kun katsot sivuja), joten sinun täytyy poistaa .htaccess tiedosto.</p></li>
</ol>';
$string['mssql'] = 'SQL*Server (mssql)';
$string['mssql_n'] = 'SQL*Server jossa UTF-8 -tuki (mssql_n)';
$string['mssqlextensionisnotpresentinphp'] = 'PHP:ta ei ole oikein konfiguroitu MSSQL-lisäosan kanssa, jotta se voisi kommunnikoida SQL*Palvelimen kanssa. Ole hyvä ja tarkasta php.ini -tiedostosi tai käännä PHP uudestaan.';
$string['mysql'] = 'MySQL (mysql)';
$string['mysqlextensionisnotpresentinphp'] = 'PHP:tä ei ole kunnolla valittu asetukseksi MySQL -laajennuksen kanssa, jotta se voisi kommunikoida MySQL:n kanssa. Tarkista php.ini -tiedostosi tai käännä PHP uudelleen.';
$string['mysqli'] = 'Parannettu MySQL (mysqli)';
$string['mysqliextensionisnotpresentinphp'] = 'PHP:ta ei ole oikein konfiguroitu MySQLi-lisäosan kanssa, jotta se voisi kommunnikoida MySQL:n kanssa. Ole hyvä ja tarkasta php.ini -tiedostosi tai käännä PHP uudestaan. MySQLi-lisäosaa ei ole saatavilla PHP-versiolle 4.';
$string['nativemssql'] = 'SQL*Server FreeTDS (native/mssql)';
$string['nativemssqlhelp'] = 'Nyt sinun tulee konfiguroida tietokanta, jossa suurin osa Moodlen tiedoista säilytetään. Tämän tietokannan, sekä käyttäjätunnuksen ja salasanan sille, tulee olla jo luotu. Taulun etuliite on pakollinen.';
$string['nativemysqli'] = 'Parannettu MySQL (native/mysqli)';
$string['nativemysqlihelp'] = 'Nyt sinun tulee konfiguroida tietokanta, jossa suurin osa Moodlen tiedoista säilytetään. Tietokanta voidaan luoda jos tietokannan käyttäjällä on tarvittavat oikeudet, käyttäjätunnuksen ja salasanan tulee olla jo luotu. Taulun etuliite on valinnainen.';
$string['nativeoci'] = 'Oracle (native/oci)';
$string['nativeocihelp'] = 'Nyt sinun tulee konfiguroida tietokanta, jossa suurin osa Moodlen tiedoista säilytetään. Tämän tietokannan, sekä käyttäjätunnuksen ja salasanan sille, tulee olla jo luotu. Taulun etuliite on pakollinen.';
$string['nativepgsql'] = 'PostgreSQL (native/pgsql)';
$string['nativepgsqlhelp'] = 'Nyt sinun tulee konfiguroida tietokanta, jossa suurin osa Moodlen tiedoista säilytetään. Tämän tietokannan, sekä käyttäjätunnuksen ja salasanan sille, tulee olla jo luotu. Taulun etuliite on pakollinen.';
$string['nativesqlsrv'] = 'SQL*Server Microsoft (native/sqlsrv)';
$string['nativesqlsrvhelp'] = 'Nyt sinun tulee konfiguroida tietokanta, jossa suurin osa Moodlen tiedoista säilytetään. Tämän tietokannan, sekä käyttäjätunnuksen ja salasanan sille, tulee olla jo luotu. Taulun etuliite on pakollinen.';
$string['oci8po'] = 'Oracle (oci8po)';
$string['ociextensionisnotpresentinphp'] = 'PHP:ta ei ole oikein konfiguroitu OCI8-lisäosan kanssa, jotta se voisi kommunnikoida Oraclen kanssa. Ole hyvä ja tarkasta php.ini -tiedostosi tai käännä PHP uudestaan.';
$string['odbc_mssql'] = 'SQL*Palvelin yli ODBC:n (odbc_mssql)';
$string['odbcextensionisnotpresentinphp'] = 'PHP:ta ei ole oikein konfiguroitu ODBC-lisäosan kanssa, jotta se voisi kommunnikoida SQL*Palvelimen kanssa. Ole hyvä ja tarkasta php.ini -tiedostosi tai käännä PHP uudestaan.';
$string['pass'] = 'Tarkastettu';
$string['paths'] = 'Polut';
$string['pathserrcreatedataroot'] = 'Asennusohjelma ei voi luoda datahakemistoa ({$a->dataroot}).';
$string['pathshead'] = 'Varmista polut';
$string['pathsrodataroot'] = 'Dataroot-hakemisto ei ole kirjoitettavissa.';
$string['pathsroparentdataroot'] = 'Ylähakemisto ({$a->parent}) ei ole kirjoitettavissa. Asennusohjelma ei voi luoda datahakemistoa ({$a->dataroot}).';
$string['pathssubadmindir'] = 'Jotkut sivustot käyttävät /admin URL-osoitetta hallintapaneelille tai vastaavalle. Tämä on valitettavasti ristiriidassa Moodlen normaalin admin-sivun sijainnin kanssa.
Voit korjata tämän nimeämällä asennuksesi admin-hakemiston uudelleen, antamalla uuden nimen tähän. Esimerkiksi: <em>moodleadmin</em>. Tämä korjaa admin-linkit Moodlessa.';
$string['pathssubdataroot'] = 'Tarvitset paikan, jonne Moodle voi tallentaa ladatut tiedostot. Tämän hakemiston pitäisi olla luettavissa ja kirjoitettavissa web-palvelimen käyttäjän taholta (yleensä "nobody" tai "apache"), mutta se ei saa olla käytettävissä suoraan web:in kautta. Jos hakemistoa ei ole, asennusohjelma yrittää luoda sen.';
$string['pathssubdirroot'] = 'Koko hakemistopolku Moodle-asennukseen.';
$string['pathssubwwwroot'] = 'Moodlen koko verkko-osoite.
Moodleen ei ole mahdollista päästä käyttäen useita osoitteita.
Jos sivustollasi on useita julkisisa osoitteita, sinun täytyy asettaa pysyvät ohjaukset kaikkiin niistä lukuunottamatta tätä.
Jos sivustollesi on pääsy sekä Intranetistä että Internetistä, käytä tässä julkista osoitetta ja aseta DNS niin, että myös Intranet-käyttäjät voivat käyttää julkista osoitetta.
Jos osoite ei ole oikea, muuta URL-osoitetta selaimessasi aloittaaksesi asennuksen uudelleen eri arvolla.';
$string['pathsunsecuredataroot'] = 'Dataroot-sijainti on turvallinen';
$string['pathswrongadmindir'] = 'Admin-hakemistoa ei ole';
$string['pgsqlextensionisnotpresentinphp'] = 'PHP:ta ei ole oikein konfiguroitu PGSQL-lisäosan kanssa, jotta se voisi kommunnikoida PostgreSQL:n kanssa. Ole hyvä ja tarkasta php.ini -tiedostosi tai käännä PHP uudestaan.';
$string['phpextension'] = '{$a} PHP-lisäosa';
$string['phpversion'] = 'PHP versio';
$string['phpversionhelp'] = '<p>Moodle vaatii vähintään PHP version 4.3.0 tai 5.1.0 (5.0.x -versiossa on joitakin tunnettuja ongelmia).</p>
<p>Käytät parhaillaan versiota {$a}</p>
<p>Sinun täytyy päivittää PHP tai siirtää asennus palvelimelle jossa on uudempi PHP-versio!<br>
(jos sinulla on versio 5.0.x, voit myös siirtyä versioon 4.4.x) </p>';
$string['postgres7'] = 'PostgreSQL (postgres7)';
$string['releasenoteslink'] = 'Halutessasi lisätietoa tästä Moodle-versiosta, katso julkaisutiedot osoitteessa {$a}';
$string['safemode'] = 'Safe mode';
$string['safemodeerror'] = 'Moodlella saattaa olla ongelmia PHP:n  Safe Moden ollessa päällä';
$string['safemodehelp'] = '<p>Moodlella saattaa olla lukuisia ongelmia Safe Moden ollessa päällä, joista vähäisin ei ole se, ettei se todennäköisesti pysty luomaan uusia tiedostoja.</p>
<p>Turvatila on yleensä aktivoinut paranoidinen web-palvelun pitäjä, joten sinun ehkä täytyy vaihtaa palveluntarjoajaa Moodlen ylläpitoa varten.</p>

<p>Voit yrittää jatkaa asennusta, mutta varaudu ongelmiin myöhemmin.</p>';
$string['sessionautostart'] = 'Istunnon automaattinen aloitus';
$string['sessionautostarterror'] = 'Tämän pitäisi olla pois päältä';
$string['sessionautostarthelp'] = '<p>Moodle vaatii istuntotukea, eikä toimi ilman sitä.</p>

<p>istunto voidaan mahdollistaa php.ini tiedostossa... Etsi istuntoa varten.auto_start parameter.</p>';
$string['skipdbencodingtest'] = 'Ohita tietokannan merkistötesti';
$string['sqliteextensionisnotpresentinphp'] = 'PHP:ta ei ole oikein konfiguroitu SQLite-lisäosan kanssa. Ole hyvä ja tarkasta php.ini -tiedostosi tai käännä PHP uudestaan.';
$string['upgradingqtypeplugin'] = 'Päivitetään kysymys/tyyppi -moduuli';
$string['welcomep10'] = '{$a->installername} ({$a->installerversion})';
$string['welcomep20'] = 'Näet tämän sivun koska olet onnistuneesti asentanut ja käynnistänyt <strong>{$a->packname} {$a->packversion}</strong> paketin tietokoneellasi.
Onnittelut!';
$string['welcomep30'] = 'Tämä julkaisu <strong>{$a->installername}</strong> sisältää sovellukset ympäristön luomiseen, jossa <strong>Moodle</strong> toimii:';
$string['welcomep40'] = 'Tämä paketti sisältää myös <strong>Moodlen {$a->moodlerelease} ({$a->moodleversion})</strong>.';
$string['welcomep50'] = 'Kaikkia tämän paketin sovelluksia hallitsevat niihin liittyvät lisenssit. Koko <strong>{$a->installername}</strong> paketti on <a href="http://www.opensource.org/docs/definition_plain.html">avointa lähdekoodia</a> ja sitä jaellaan <a href="http://www.gnu.org/copyleft/gpl.html">GPL</a> lisenssin alla.';
$string['welcomep60'] = 'Seuraavat sivut opastavat sinua helposti seurattavien vaiheiden läpi <strong>Moodlen</strong> konfiguroinnissa koneellesi. Voit hyväksyä oletusasetukset tai vaihtoehtoisesti muuttaa niitä tarvitsemallasi tavalla.';
$string['welcomep70'] = 'Napsauta "Seuraava"-painiketta jatkaaksesi moodlen asennusta';
$string['wwwroot'] = 'Web-osoite';
$string['wwwrooterror'] = 'Web-osoite ei näyttäisi olevan voimassa- tämä Moodle asennus ei näyttäisi olevan siellä.';
