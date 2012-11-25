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
 * Strings for component 'plagiarism_turnitin', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   plagiarism_turnitin
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminlogin'] = 'Kirjaudu Turnitiniin Ylläpitäjänä';
$string['compareinstitution'] = 'Vertaa palautettuja tiedostoja tämän laitoksen sisällä palautettuihin töihin.';
$string['compareinstitution_help'] = 'Tämä vaihtoehto on saatavilla vain jos olet hankkinut räätälöidyn solmun. Asetus pitäisi olla "Ei" jos et ole varma.';
$string['compareinternet'] = 'Vertaa palautettuja tiedostoja Internetiin';
$string['compareinternet_help'] = 'Tämä vaihtoehto mahdollistaa palautusten vertaamisen internetsisältöön jota Turnitin indeksoi';
$string['comparejournals'] = 'Vertaa palautettuja tiedostoja Päiväkirjoihin, aikakauslehtiin, julkaisuihin';
$string['comparejournals_help'] = 'Tämä vaihtoehto mahdollistaa palautusten vertaamisen Päiväkirjoihin, aikakauslehtiin ja julkaisuihin, joita Turnitin indeksoi';
$string['comparestudents'] = 'Vertaa palautettuja tiedostoja muiden opiskelijoiden tiedostoihin';
$string['comparestudents_help'] = 'Tämä vaihtoehto mahdollistaa palautusten vertaamisen muiden opiskelijoiden tiedostoihin';
$string['configdefault'] = 'Tämä on oletusasetus tehtävänluontisivulle. Vain käyttäjät, joilla on kyky plagiarism/turnitin:enableturnitin voivat muuttaa tätä asetusta yksittäiselle tehtävälle';
$string['configusetiimodule'] = 'Salli Turnitin-palautus.';
$string['defaultsdesc'] = 'Seuraavat asetukset ovat oletuksena, kun Turnitin laitetaan päälle Aktiviteettimoduulissa';
$string['defaultupdated'] = 'Turnitin-oletukset päivitetty';
$string['draftsubmit'] = 'Milloin tiedosto pitäisi palauttaa Turnitiniin';
$string['excludebiblio'] = 'Älä sisällytä lähdeluetteloa';
$string['excludebiblio_help'] = 'Lähdeluettelomateriaalit voidaan myös sisällyttää tai jättää pois tarkasteltaessa Alkuperäisyysraporttia. Tätä asetusta ei voida muuttaa kun ensimmäinen tiedosto on palautettu.';
$string['excludematches'] = 'Älä sisällytä pieniä osumia';
$string['excludematches_help'] = 'Voit jättää pienet osumat pois raportista prosenttien tai sanamäärien mukaan - valitse tyyppi, mitä haluat käyttää ja syötä prosentit tai sanamäärä alla olevaan laatikkoon.';
$string['excludequoted'] = 'Älä sisällytä siteerattua materiaalia';
$string['excludequoted_help'] = 'Siteeratut materiaalit voidaan myös sisällyttää tai jättää pois tarkasteltaessa Alkuperäisyysraporttia. Tätä asetusta ei voida muuttaa kun ensimmäinen tiedosto on palautettu.';
$string['file'] = 'Tiedosto';
$string['filedeleted'] = 'Tiedosto poistettu jonosta';
$string['fileresubmitted'] = 'Tiedosto asetettu jonoon uudelleenpalautusta varten';
$string['module'] = 'Moduuli';
$string['name'] = 'Nimi';
$string['percentage'] = 'Prosentti';
$string['pluginname'] = 'Turnitin plagioinninestomoduuli';
$string['reportgen'] = 'Koska Alkuperäisyysraportit muodostetaan';
$string['reportgen_help'] = 'Tämä vaihtoehto antaa sinun valita koska Alkuperäisyysraportti pitäisi muodostaa';
$string['reportgenduedate'] = 'Palautuspäivänä';
$string['reportgenimmediate'] = 'Välittömästi (ensimmäinen raportti on lopullinen)';
$string['reportgenimmediateoverwrite'] = 'Välittömästi (voidaan ylikirjoittaa raportteja)';
$string['resubmit'] = 'Uudelleenpalauta';
$string['savedconfigfailure'] = 'Ei voida yhdistää/todentaa Turnitiniin - sinulla saattaa olla väärä Salausavain/Tilin ID -yhdistelmä tai tämä palvelin ei voi yhdistää API:in.';
$string['savedconfigsuccess'] = 'Turnitin-asetukset tallennettu ja Opettajatili luotu';
$string['showstudentsreport'] = 'Näytä samankaltaisuusraportti opiskelijalle';
$string['showstudentsreport_help'] = 'Samankaltaisuusraportista käy ilmi mitkä osat palautuksesta olivat plagioituja sekä missä Turnitin ensi kertaa näki sisällön';
$string['showstudentsscore'] = 'Näytä samankaltaisuuspisteet opiskelijalle';
$string['showstudentsscore_help'] = 'Samankaltaisuuspisteet on palautuksen sisällön prosenttimäärä, joka on yhdistetty muuhun materiaaliin - korkea tulos on yleensä huono.';
$string['showwhenclosed'] = 'Koska Aktiviteetti sulkeutui';
$string['similarity'] = 'Samankaltaisuus';
$string['status'] = 'Tila';
$string['studentdisclosure'] = 'Opiskelijajulkaisu';
$string['studentdisclosure_help'] = 'Tämä teksti näytetään kaikille opiskelijoille tiedostonlataussivulla.';
$string['studentdisclosuredefault'] = 'Kaikki ladatut tiedostot palautetaan plagioinnintunnistuspalvelu Turnitin.com:iin';
$string['submitondraft'] = 'Palauta tiedosto kun ensi kertaa ladattu';
$string['submitonfinal'] = 'Palauta tiedosto kun opiskelija lähettää arvioitavaksi';
$string['teacherlogin'] = 'Kirjaudu Turnitiniin Opettajana';
$string['tii'] = 'Turnitin';
$string['tiiaccountid'] = 'Turnitin Tilin ID';
$string['tiiaccountid_help'] = 'Tämä on Turnitin.com:in antama Tilin ID';
$string['tiiapi'] = 'Turnitin API';
$string['tiiapi_help'] = 'Tämä on Turnitin API:n osoite - yleensä https://api.turnitin.com/api.asp';
$string['tiiconfigerror'] = 'Tapahtui sivuston konfiguraatiovirhe yritettäessä lähettää tiedostoa Turnitiniin';
$string['tiiemailprefix'] = 'Opiskelijan Sähköpostin etuliite';
$string['tiiemailprefix_help'] = 'Sinun tulee asettaa tämä jos et halua että opiskelijat pystyvät kirjautumaan turnitin.com sivustolle tarkastelemaan täysiä raportteja.';
$string['tiienablegrademark'] = 'Salli Arvosanamerkintä (Kokeellinen)';
$string['tiienablegrademark_help'] = 'Arvosanamerkintä on Turnitinin valinnainen ominaisuus - käyttääksesi sitä, sinun on pitänyt sisällyttää se Turnitin-tilaukseen. Ominaisuuden käyttäminen johtaa palautussivujen hitaaseen latautumiseen.';
$string['tiierror'] = 'TII-Virhe:';
$string['tiierror1007'] = 'Turnitin ei voinut käsitellä tiedostoa koska se on liian iso';
$string['tiierror1008'] = 'Tapahtui virhe lähetettäessä tiedostoa Turnitiniin';
$string['tiierror1009'] = 'Turnitin ei voinut käsitellä tiedostoa - tiedostotyyppiä ei tueta. Validit tiedostotyypit ovat MS Word, Acrobat PDF, Postscript, Text, HTML, WordPerfect sekä Rich Text Format';
$string['tiierror1010'] = 'Turnitin ei voinut käsitellä tiedostoa - tiedostossa täytyy olla enemmän kuin 100 merkkiä';
$string['tiierror1011'] = 'Turnitin ei voinut käsitellä tiedostoa - tiedosto on väärin muotoiltu ja joka kirjaimen välissä vaikuttaa olevan välilyöntejä.';
$string['tiierror1012'] = 'Turnitin ei voinut käsitellä tiedostoa - tiedoston pituus ylittää Turnitinin rajat';
$string['tiierror1013'] = 'Turnitin ei voinut käsitellä tiedostoa - tiedostossa täytyy olla enemmän kuin 20 sanaa';
$string['tiierror1020'] = 'Turnitin ei voinut käsitellä tiedostoa - tiedostossa on merkkejä ei-tuetusta merkkijoukosta';
$string['tiierror1023'] = 'Turnitin ei voinut käsitellä pdf-tiedostoa - varmista ettei se ole salasanasuojattu ja sisältää skannattujen kuvien sijaan valittavissa olevaa tekstiä';
$string['tiierror1024'] = 'Turnitin ei voinut käsitellä tiedostoa - se ei ole Turnitinin kriteerien mukainen tekstitiedosto';
$string['tiierrorpaperfail'] = 'Turnitin ei voinut käsitellä tiedostoa.';
$string['tiierrorpending'] = 'Tiedosto odottaa palautusta Turnitiniin';
$string['tiiexplain'] = 'Turnitin on kaupallinen tuote ja sinun on täytynyt maksaa palvelun käytöstä; lisätietoa osoitteesta <a href="http://docs.moodle.org/en/Turnitin_administration">http://docs.moodle.org/en/Turnitin_administration</a>';
$string['tiiexplainerrors'] = 'Tämä sivu listaa Turnitiniin palautetut tiedostot, jotka ovat tällä hetkellä virhetilassa. Lista Turnitinin Virhekoodeista ja niiden kuvauksista löytyy osoitteesta:<a href="http://docs.moodle.org/en/Turnitin_errors">docs.moodle.org/en/Turnitin_errors</a><br/>Kun tiedostot on resetoitu, cron yrittää lähettää tiedoston uudelleen Turnitiniin.<br/>Kun tiedostot poistetaan tältä sivulta, niitä ei voida enää palauttaa uudelleen Turnitiniin, eikä virheitä enää näytetä opettajille eikä opiskelijoille';
$string['tiisecretkey'] = 'Turnitin Salausavain';
$string['tiisecretkey_help'] = 'Kirjaudu Turnitin.com:iin sivustosi ylläpitäjänä saadaksesi tämän.';
$string['tiisenduseremail'] = 'Lähetä käyttäjälle sähköpostia';
$string['tiisenduseremail_help'] = 'Lähetä sähköpostilla jokaiselle TII-järjestelmään luodulle opiskelijalle linkki, josta sallitaan väliaikaisella salasanalla kirjautuminen osoitteeseen www.turnitin.com';
$string['turnitin'] = 'Turnitin';
$string['turnitin:enable'] = 'Salli opettajan sallia/estää Turnitin-moduulin sisällä';
$string['turnitin:viewfullreport'] = 'Salli opettajan nähdä Turnitinistä palautettu koko raportti';
$string['turnitin:viewsimilarityscore'] = 'Salli opettajan nähdä Turnitinistä palautetut samankaltaisuuspisteet';
$string['turnitin_attemptcodes'] = 'Virhekoodit automaattiseen uudelleenlähettämiseen';
$string['turnitin_attemptcodes_help'] = 'Virhekoodit, jotka Turnitin yleensä hyväksyy toisella yrityksellä (Muutokset tähän kenttään saattavat aihetuttaa lisälataamista palvelimellasi)';
$string['turnitin_attempts'] = 'Uudelleenyritysten määrä';
$string['turnitin_attempts_help'] = 'Kuinka monesti määritellyt koodit lähetetään uudelleen Turnitiniin, 1 tarkoittaa että tiedostot, joissa on määritelty virhekoodi, lähetetään kahdesti.';
$string['turnitin_institutionnode'] = 'Salli Instituutio-Solmu';
$string['turnitin_institutionnode_help'] = 'Jos olet asettanut/hankkinut tilisi kanssa instituutio-solmun, salli tämä, jotta solmu voitaisiin valita luotaessa tehtäviä. HUOMAA: jos sinulla ei ole instituutio-solmua, tämän salliminen johtaa tehtäväpalautuksesi epäonnistumiseen.';
$string['turnitindefaults'] = 'Turnitin-oletukset';
$string['turnitinerrors'] = 'Turnitin-virheet';
$string['useturnitin'] = 'Oat käyttöön Turnitin';
$string['wordcount'] = 'Sanojen määrä';
