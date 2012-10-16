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
 * Strings for component 'auth_db', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   auth_db
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['auth_dbcantconnect'] = 'Ei voitu yhdistää määriteltyyn autentikointitietokantaan...';
$string['auth_dbchangepasswordurl_key'] = 'Web-osoite salasanan vaihtamiseen';
$string['auth_dbdebugauthdb'] = 'Debuggaa ADOdb';
$string['auth_dbdebugauthdbhelp'] = 'Debuggaa ADOdb-yhteys ulkoiseen tietokantaan - käytä kun kirjautumisen yhteydessä tulee tyhjä sivu. Ei sovellu tuotantosivustoille.';
$string['auth_dbdeleteuser'] = 'Poistettu käyttäjä {$a->name} id:llä {$a->id}';
$string['auth_dbdeleteusererror'] = 'Virhe poistettaessa käyttäjää {$a}';
$string['auth_dbdescription'] = 'Tämä moduuli tarkistaa ulkoisen tietokannan taulusta käyttäjätunnuksen ja salasanan. Jos käyttäjätunnus on uusi, myös muita tietoja voidaan kopioida Moodleen.';
$string['auth_dbextencoding'] = 'Ulkoinen db-enkoodaus';
$string['auth_dbextencodinghelp'] = 'Ulkoisessa tietokannassa käytetty enkoodaus';
$string['auth_dbextrafields'] = 'Nämä kentät ovat valinnaisia. Voit asettaa Moodlen hakemaan valmiiksi joitakin käyttäjätietoja <b>ulkoisesta tietokannasta</b>.<p>Jos jätät nämä kentät tyhjiksi, käytetään oletusasetusarvoja.</p> <p>Käyttäjä voi joka tapauksessa muuttaa omia henkilötietojaan myöhemmin.</p>';
$string['auth_dbfieldpass'] = 'Salasanakentän nimi';
$string['auth_dbfieldpass_key'] = 'Salasana-kenttä';
$string['auth_dbfielduser'] = 'Käyttäjätunnuskentän nimi';
$string['auth_dbfielduser_key'] = 'Käyttäjätunnus-kenttä';
$string['auth_dbhost'] = 'Tietokantapalvelin';
$string['auth_dbhost_key'] = 'Isäntäpalvelin';
$string['auth_dbinsertuser'] = 'Syötettiin käyttäjä {$a->name} id:llä {$a->id}';
$string['auth_dbinsertusererror'] = 'Virhe syötettäessä käyttäjää {$a}';
$string['auth_dbname'] = 'Tietokannan nimi';
$string['auth_dbname_key'] = 'Tietokannan nimi';
$string['auth_dbpass'] = 'Salasana käyttäjätunnukselle';
$string['auth_dbpass_key'] = 'Salasana';
$string['auth_dbpasstype'] = '<p>Määritä salasanakentän käyttämä muoto. MD5-salaus on hyödyllinen, jos haluat käyttää muita web-sovelluksia kuten PostNukea.</p> <p>Käytä \'sisäistä\' jos haluat ulkoisen tietokannan hallitsevan käyttäjätunnuksia &amp; sähköposteja, mutta Moodlen hallitsevan salasanoja. Jos käytät \'sisäistä\' sinun <i>täytyy</i> antaa sähköposti ulkoisen tietokannan sähköpostikenttään sekä ajaa admin/cron.php ja auth/db/cli/sync_users.php tasaisin väliajoin. Moodle lähettää sähköpostin uusille käyttäjille, joilla on väliaikainen salasana.</p>';
$string['auth_dbpasstype_key'] = 'Salasanan muoto';
$string['auth_dbreviveduser'] = 'Palautettiin käyttäjä {$a->name} id:llä {$a->id}';
$string['auth_dbrevivedusererror'] = 'Virhe palautettaessa käyttäjää {$a}';
$string['auth_dbsetupsql'] = 'SQL-asetuskomento';
$string['auth_dbsetupsqlhelp'] = 'SQL-komento erityisille tietokannan asetuksille - käytetty usein kommunikaatiokoodauksen asettamiseen - esimerkiksi MySQL ja PostgreSQL: <em>SET NAMES \'utf8\'</em>';
$string['auth_dbsuspenduser'] = 'Jäädytettiin käyttäjä {$a->name} id:llä {$a->id}';
$string['auth_dbsuspendusererror'] = 'Virhe jäädytettäessä käyttäjää {$a}';
$string['auth_dbsybasequoting'] = 'Käytä sybase-lainausmerkkejä';
$string['auth_dbsybasequotinghelp'] = 'Sybase-tyylin yksittäisten lainausmerkkien ohittaminen - tarvitaan Oracle, MS SQL sekä joillekin muille tietokannoille. Älä käytä MySQL:n kanssa!';
$string['auth_dbtable'] = 'Tietokannan taulun nimi';
$string['auth_dbtable_key'] = 'Taulu';
$string['auth_dbtype'] = 'Tietokannan tyyppi (Katso <a href="http://phplens.com/adodb/supported.databases.html">ADOdb-dokumentaatiosta</a> yksityiskohdat)';
$string['auth_dbtype_key'] = 'Tietokanta';
$string['auth_dbupdatinguser'] = 'Päivitetään käyttäjä {$a->name} id:llä {$a->id}';
$string['auth_dbuser'] = 'Käyttäjätunnus tietokantaan lukuoikeuksin';
$string['auth_dbuser_key'] = 'Tietokannan käyttäjä';
$string['auth_dbusernotexist'] = 'Ei voida päivittää käyttäjää, jota ei ole olemassa: {$a}';
$string['auth_dbuserstoadd'] = 'Lisättävät käyttäjämerkinnät: {$a}';
$string['auth_dbuserstoremove'] = 'Poistettavat käyttäjämerkinnät: {$a}';
$string['pluginname'] = 'Käytä ulkoista tietokantaa';
