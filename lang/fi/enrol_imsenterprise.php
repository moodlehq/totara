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
 * Strings for component 'enrol_imsenterprise', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_imsenterprise
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aftersaving...'] = 'Kun olet tallentanut asetuksesi, saatat haluta';
$string['allowunenrol'] = 'Salli IMS-tiedon <strong>rekisteröidä pois</strong> opiskelijoita/opettajia';
$string['allowunenrol_desc'] = 'Jos sallittu, kurssin kirjautumiset poistetaan kun niin on määritelty Enterprise-tiedoissa.';
$string['basicsettings'] = 'Perusasetukset';
$string['coursesettings'] = 'Kurssitietojen asetukset';
$string['createnewcategories'] = 'Luo uudet (piilotetut) kurssikategoriat, jos niitä ei löydy Moodlesta';
$string['createnewcategories_desc'] = 'Jos <org><orgunit> elementti on läsnä kurssin tulevassa datassa, sen sisältöä käytetään kategorian määrittämiseen jos kurssi luodaan alusta. Plugini EI muuta olemassa olevien kurssien kategorioita.

Jos halutulla nimellä ei ole valmiina kategoriaa, luodaan piilotettu kategoria.';
$string['createnewcourses'] = 'Luo uudet (piilotetut) kurssit, jos niitä ei löydy Moodlesta';
$string['createnewcourses_desc'] = 'Jos sallittu, IMS Enterprise -kirjautumisplugini voi luoda uusia kursseja jos kursseja löytyy IMS-tiedoista mutta ei Moodlen tietokannasta. Uudet luodut kurssit ovat aluksi piilotettuja.';
$string['createnewusers'] = 'Luo käyttäjätilit käyttäjille, jotka eivät vielä ole rekisteröityneet Moodleen';
$string['createnewusers_desc'] = 'IMS Enterprise kirjautumisdata tyypillisesti kuvaa käyttäjäjoukkoa. Jos sallittu, tilit voidaan luoda käyttäjille, joita ei vielä ole Moodlen tietokannassa.

Käyttäjiä etsitään ensin "id-numerolla" ja sitten Moodlen käyttäjätunnuksella. IMS Enterprise plugini ei tuo salasanoja. Autentikointipluginin käyttö on suositeltavaa käyttäjien todentamiseksi.';
$string['cronfrequency'] = 'Käsittelyn toistuvuus';
$string['deleteusers'] = 'Poista käyttäjätilit kun määritelty IMS-tiedoissa';
$string['deleteusers_desc'] = 'Jos sallittu, IMS Enterprise -kirjautumisdata voi määrittää käyttäjätilien poistamisen (jos "recstatus" on asetettu arvoon 3, mikä edustaa tilin poistamista). Kuten Moodlessa on käytäntö, käyttäjämerkintää ei oikeasti poisteta tietokannasta vaan tili merkitään poistetuksi.';
$string['doitnow'] = 'suorita IMS Enterprise -tuonti nyt';
$string['filelockedmail'] = 'Cron-prosessi ei voi poistaa tekstitiedostoa, jota käytät IMS-tiedostopohjaisiin rekisteröimisiin ({$a}). Ole hyvä ja korjaa oikeudet että Moodle voi poistaa tiedoston, muuten se saatetaan käsitellä toistuvasti.';
$string['filelockedmailsubject'] = 'Tärkeä virhe: Kirjautumistiedosto';
$string['fixcasepersonalnames'] = 'Muuta henkilökohtaisten nimien Alkukirjaimet Isoiksi';
$string['fixcaseusernames'] = 'Muuta käyttäjätunnukset pieniksi kirjaimiksi';
$string['ignore'] = 'Jätä huomiotta';
$string['importimsfile'] = 'Tuo IMS Enterprise -tiedosto';
$string['imsrolesdescription'] = 'IMS Enterprise -määrittely sisältää 8 erilaista roolityyppiä. Ole hyvä ja valitse miten haluat että ne jaetaan Moodlessa, sisältäen tiedon pitäisikö jokin niistä jättää huomiotta.';
$string['location'] = 'Tiedoston sijainti';
$string['logtolocation'] = 'Lokitiedoston sijainti (jätä tyhjäksi jos lokia ei käytetä)';
$string['mailadmins'] = 'Ilmoita ylläpitäjälle sähköpostilla';
$string['mailusers'] = 'Ilmoita käyttäjille sähköpostilla';
$string['miscsettings'] = 'Sekalaista';
$string['pluginname'] = 'IMS Enterprise -tiedosto';
$string['pluginname_desc'] = 'Tämä metodi tarkastaa toistuvasti ja käsittelee, erityisesti muotoillun tekstitiedoston määrittelemästäsi kohteesta. Tiedoston täytyy olla IMS Enterprisen määrityksien mukainen sisältäen henkilö, ryhmä ja jäsenyys XML-elementit.';
$string['processphoto'] = 'Lisää käyttäjän valokuvatieto profiiliin';
$string['processphotowarning'] = 'Varoitus: Kuvankäsittely aiheuttaa todennäköisesti suuren kuormituksen palvelimelle. Tämän asetuksen aktivointia ei suositella jos käsiteltävien oppilaiden määrä on suuri.';
$string['restricttarget'] = 'Käsittele tiedot vain jos seuraava kohde on määritelty';
$string['restricttarget_desc'] = 'IMS Enterprise datatiedosto voisi olla tarkoitettu monille "kohteille" - eri oppimisenhallintajärjestelmille tai eri järjestelmille koulun/yliopiston sisällä. Enterprise-tiedostossa on mahdollista määritellä, että data on tarkoitettu yhdelle tai useammalle nimetylle kohdejärjestelmälle, nimeämällä järjestelmät <target> tageilla <properties> tagin sisällä.

Yleensä sinun ei tarvitse huolehtia tästä. Jätä asetus tyhjäksi ja Moodle käsittelee aina datatiedoston, oli kohde sitten määritelty tai ei. Muussa tapauksessa lisää täsmällinen nimi <target> tagissa.';
$string['roles'] = 'Roolit';
$string['sourcedidfallback'] = 'Käytä &quot;sourcedid&quot; henkilön käyttäjä-id:nä jos henkilön &quot;userid&quot; -kenttää ei löydy';
$string['sourcedidfallback_desc'] = 'IMS-datassa <sourceid> -kenttä edustaa henkilön pysyvää ID-koodia kuten käytetty lähdejärjestelmässä. <userid> -kenttä on erillinen kenttä, jonka tulisi sisältää käyttäjän käyttämä ID-koodi sisään kirjauduttaessa. Monessa tapauksessa nämä koodit voivat olla samoja - mutta eivät aina.

Jotkin opiskelijatietojärjestelmät epäonnistuvat <userid> -kentän tulostamisessa. Jos näin tapahtuu, sinun tulisi sallia tämä asetus, jotta <sourcedid> -kenttää voitaisiin käyttää Moodlekäyttäjän ID:nä. Muussa tapauksessa jätä tämä asetus pois päältä.';
$string['truncatecoursecodes'] = 'Lyhennä kurssikoodit tähän pituuteen';
$string['truncatecoursecodes_desc'] = 'Joissakin tapauksissa saatat haluta lyhentää kurssikoodit tiettyyn pituuteen ennen käsittelyä. Tässä tapauksessa syötä merkkien määrä laatikkoon. Muuten, jätä laatikko tyhjäksi, jolloin lyhentämistä ei tapahdu.';
$string['usecapitafix'] = 'Valitse tämä laatikko jos käytetään &quot;Capita&quot; (kyseinen XML-muoto on hieman väärä)';
$string['usecapitafix_desc'] = 'Capita:n tuottamassa opiskelijatiedon järjestelmässä on huomattu yksi virhe XML-koodissa. Jos käytät Capitaa, sinun pitäisi sallia tämä asetus - muussa tapauksessa jätä kohta valitsematta.';
$string['usersettings'] = 'Käyttäjätiedon asetukset';
$string['zeroisnotruncation'] = '0 tarkoittaa ei lyhennystä';
