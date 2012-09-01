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
 * Strings for component 'webservice', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   webservice
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessexception'] = 'Pääsyn hallinnan poikkeus';
$string['accesstofunctionnotallowed'] = 'Pääsy funktioon {$a}() ei ole sallittu. Ole hyvä ja tarkasta onko funktion sisältämä palvelu toiminnassa. Palvelun asetuksissa: jos palvelu on rajoitettu, tarkasta että käyttäjä on listattu. Tarkasta palvelun asetuksissa myös IP-rajoitukset tai vaatiiko palvelu jonkin kyvyn.';
$string['actwebserviceshhdr'] = 'Aktiiviset verkkopalveluprotokollat';
$string['addaservice'] = 'Lisää palvelu';
$string['addcapabilitytousers'] = 'Tarkista käyttäjät kyky';
$string['addcapabilitytousersdescription'] = 'Käyttäjillä pitäisi olla kaksi kykyä - webservice:createtoken sekä kyky joka täsmää käytettävien protokollien kanssa, esimerkiksi webservice/rest:use, webservice/soap:use. Saavuttaaksesi tämän, luo verkkopalvelurooli, jolla on kyseiset kyvyt sallittu ja jaa rooli verkkopalveluiden käyttäjälle järjestelmäroolina.';
$string['addfunction'] = 'Lisää toiminto';
$string['addfunctionhelp'] = 'Valitse palveluun lisättävä toiminto';
$string['addfunctions'] = 'Lisää toiminnot';
$string['addfunctionsdescription'] = 'Valitse vaadittavat toiminnot luodulle palvelulle.';
$string['addrequiredcapability'] = 'Anna/poista vaadittu kyky';
$string['addservice'] = 'Lisää uusi palvelu: {$a->name} (id: {$a->id})';
$string['addservicefunction'] = 'Lisää toiminnot palveluun "{$a}"';
$string['allusers'] = 'Kaikki käyttäjät';
$string['amftestclient'] = 'AMF testiasiakasohjelma';
$string['apiexplorer'] = 'API explorer';
$string['apiexplorernotavalaible'] = 'API explorer ei vielä käytössä';
$string['arguments'] = 'Argumentit';
$string['authmethod'] = 'Autentikointitapa';
$string['cannotcreatetoken'] = 'Ei oikeutta luoda verkkopalveluavainta palvelulle {$a}.';
$string['cannotgetcoursecontents'] = 'Ei saada kurssin sisältöä';
$string['checkusercapability'] = 'Tarkista käyttäjän kyky';
$string['checkusercapabilitydescription'] = 'Käyttäjillä tulisi olla oikeat kyvyt käytettävien protokollien mukaan, esimerkiksi webservice/rest:use, webservice/soap:use. Saavuttaaksesi tämän, luo verkkopalvelurooli, jolla on protokollakyvyt sallittu ja jaa rooli verkkopalveluiden käyttäjälle järjestelmäroolina.';
$string['configwebserviceplugins'] = 'Tietoturvasyistä vain käytössä olevat protokollat tulisi sallia.';
$string['context'] = 'Konteksti';
$string['createservicedescription'] = 'Palvelu on joukko verkkopalvelun toimintoja. Sinä sallit käyttäjän pääsyn uuteen palveluun. <strong>Lisää palvelu</strong> -sivulla valitse vaihtoehdot \'Salli\' sekä \'Valtuutetut käyttäjät\'. Valitse \'Ei vaadittua kykyä\'.';
$string['createserviceforusersdescription'] = 'Palvelu on joukko verkkopalvelun toimintoja. Sinä sallit käyttäjien pääsyn uuteen palveluun. <strong>Lisää palvelu</strong> -sivulla valitse vaihtoehdot \'Salli\' sekä poista valinta kohdasta \'Valtuutetut käyttäjät\'. Valitse \'Ei vaadittua kykyä\'.';
$string['createtoken'] = 'Luo avain';
$string['createtokenforuser'] = 'Luo avain käyttäjälle';
$string['createtokenforuserauto'] = 'Luo avain käyttäjälle automaattisesti';
$string['createtokenforuserdescription'] = 'Luo avain verkkopalvelun käyttäjälle.';
$string['createuser'] = 'Luo tietty käyttäjä';
$string['createuserdescription'] = 'Verkkopalvelun käyttäjän vaaditaan esittävän Moodlea ohjaavan järjestelmän.';
$string['default'] = 'Oletus "{$a}"';
$string['deleteaservice'] = 'Poista palvelu';
$string['deleteservice'] = 'Poista palvelu: {$a->name} (id: {$a->id})';
$string['deleteserviceconfirm'] = 'Palvelun poistaminen poistaa myös siihen liittyvät avaimet. Haluatko todella poistaa ulkoisen palvelun "{$a}"?';
$string['deletetokenconfirm'] = 'Haluatko todella poistaa verkkopalvelun avaimen käyttäjältä <strong>{$a->user}</strong> palvelussa <strong>{$a->service}</strong>?';
$string['disabledwarning'] = 'Kaikki verkkopalvelun protokollat on estetty. "Salli verkkopalvelut" -asetus löytyy Lisäasetuksista.';
$string['doc'] = 'Dokumentaatio';
$string['docaccessrefused'] = 'Sinulla ei ole oikeuksia nähdä tämän avaimen dokumentaatiota';
$string['documentation'] = 'verkkopalvelun dokumentaatio';
$string['downloadfiles'] = 'Voi ladata tiedostoja';
$string['downloadfiles_help'] = 'Jos sallittu, kuka tahansa käyttäjä voi ladata tiedostoja turva-avaimillaan. Tietenkin käyttäjät ovat rajoitettu tiedostoihin joita heidän on sallittu ladata sivustolla.';
$string['editaservice'] = 'Muokkaa palvelua';
$string['editservice'] = 'Muokkaa palvelua: {$a->name} (id: {$a->id})';
$string['enabled'] = 'Sallittu';
$string['enabledirectdownload'] = 'Verkkopalvelun tiedostojen lataaminen täytyy olla sallittu ulkoisen palvelun asetuksissa';
$string['enabledocumentation'] = 'Salli kehittäjädokumentaatio';
$string['enabledocumentationdescription'] = 'Yksityiskohtainen verkkopalvelujen dokumentaatio on saatavilla sallituille protokollille.';
$string['enablemobilewsoverview'] = 'Mene ylläpitosivulle {$a->manageservicelink}, valitse asetus "{$a->enablemobileservice}" ja tallenna. Asetukset määritellään valmiiksi ja kaikki sivuston käyttäjät voivat käyttää virallista Moodlen mobiilisovellusta. Nykyinen tila: {$a->wsmobilestatus}';
$string['enableprotocols'] = 'Salli protokollat';
$string['enableprotocolsdescription'] = 'Vähintään yksi protokolla pitäisi olla sallittu. Tietoturvasyistä vain protokollat joita tullaan käyttämään, pitäisi sallia.';
$string['enablews'] = 'Salli verkkopalvelut';
$string['enablewsdescription'] = 'Verkkopalvelut pitää sallia Edistyneistä asetuksista.';
$string['entertoken'] = 'Anna avain:';
$string['error'] = 'Virhe: {$a}';
$string['errorcatcontextnotvalid'] = 'Et voi suorittaa toimintoja kategoriakontekstissa (category id:{$a->catid}). Kontekstin virheilmoitus oli: {$a->message}';
$string['errorcodes'] = 'Virheilmoitus';
$string['errorcoursecontextnotvalid'] = 'Et voi suorittaa toimintoja kurssikontekstissa (course id:{$a->courseid}). Kontekstin virheilmoitus oli: {$a->message}';
$string['errorinvalidparam'] = 'Parametri "{$a}" on virheellinen';
$string['errornotemptydefaultparamarray'] = 'Verkkopalvelun kuvauksen parametri nimeltään \'{$a}\' on rakenteeltaan yksittäinen tai moninkertainen. Oletus voi olla vain tyhjä taulukko. Tarkista verkkopalvelun kuvaus.';
$string['erroroptionalparamarray'] = 'Verkkopalvelun kuvauksen parametri nimeltään \'{$a}\' on rakenteeltaan yksittäinen tai moninkertainen. Sen arvoksi ei voida asettaa VALUE_OPTIONAL. Tarkista verkkopalvelun kuvaus.';
$string['execute'] = 'Suorita';
$string['executewarnign'] = 'VAROITUS: Jos valitset suorita, tietokantaasi muokataan, eikä muutoksia voida palauttaa automaattisesti!';
$string['externalservice'] = 'Ulkoinen palvelu';
$string['externalservicefunctions'] = 'Ulkoisen palvelun toiminnot';
$string['externalservices'] = 'Ulkoiset palvelut';
$string['externalserviceusers'] = 'Ulkoisen palvelun käyttäjät';
$string['failedtolog'] = 'Ei voitu kirjoittaa lokiin';
$string['filenameexist'] = 'Tiedoston nimi on jo olemassa: {$a}';
$string['forbiddenwsuser'] = 'Ei voida luoda avainta vahvistamattomalle, poistetulle, keskeytetylle tai vierailijakäyttäjälle.';
$string['function'] = 'Toiminto';
$string['functions'] = 'Toiminnot';
$string['generalstructure'] = 'Yleinen rakenne';
$string['information'] = 'Informaatio';
$string['installexistingserviceshortnameerror'] = 'Verkkopalvelun lyhytnimi "{$a}" on jo olemassa. Ei voida asentaa/päivittää toista verkkopalvelua tällä lyhytnimellä.';
$string['installserviceshortnameerror'] = 'Koodausvirhe: palvelun lyhytnimi "{$a}" saa sisältää vain numeroita, kirjaimia sekä merkit _-..';
$string['invalidextparam'] = 'Virheellinen ulkoinen api-parametri: {$a}';
$string['invalidextresponse'] = 'Virheellinen ulkoinen api-vastaus: {$a}';
$string['invalidiptoken'] = 'Virheellinen avain - IP:täsi ei tueta';
$string['invalidtimedtoken'] = 'Virheellinen avain - avain vanhentunut';
$string['invalidtoken'] = 'Virheellinen avain - avainta ei löytynyt';
$string['invalidtokensession'] = 'Virheellinen sessioon perustuva avain - sessiota ei löytynyt tai se on vanhentunut';
$string['iprestriction'] = 'IP-rajoitus';
$string['iprestriction_help'] = 'Käyttäjän on kutsuttava verkkopalvelua listatuista IP-osoitteista.';
$string['key'] = 'Avain';
$string['keyshelp'] = 'Avaimia käytetään Moodletiliisi pääsyyn ulkoisista sovelluksista.';
$string['manageprotocols'] = 'Hallitse protokollia';
$string['managetokens'] = 'Hallitse avaimia';
$string['missingcaps'] = 'Puuttuvat kyvyt';
$string['missingcaps_help'] = 'Lista palvelun käyttöön vaadituista kyvyistä, joita käyttäjällä ei ole. Puuttuvat kyvyt pitää lisätä käyttäjän rooliin, jotta palvelua voidaan käyttää.';
$string['missingpassword'] = 'Puuttuva salasana';
$string['missingrequiredcapability'] = 'Kyky {$a} vaaditaan.';
$string['missingusername'] = 'Puuttuva käyttäjänimi';
$string['missingversionfile'] = 'Koodausvirhe: tiedostosta version.php puuttuu komponentti {$a}';
$string['mobilewsdisabled'] = 'Estetty';
$string['mobilewsenabled'] = 'Sallittu';
$string['nofunctions'] = 'Tällä palvelulla ei ole toimintoja.';
$string['norequiredcapability'] = 'Ei vaadittua kykyä';
$string['notoken'] = 'Avainlista on tyhjä.';
$string['onesystemcontrolling'] = 'Yksi järjestelmä hallitsee Moodlea avaimella';
$string['onesystemcontrollingdescription'] = 'Seuraavat vaiheet auttavat sinua Moodle-verkkopalvelun käyttöönotossa järjestelmälle, joka hallitsee Moodlea. Nämä vaiheet auttavat myös suositellun turva-avaimen todentamismetodin asettamisessa.';
$string['operation'] = 'Toiminta';
$string['optional'] = 'Valinnainen';
$string['passwordisexpired'] = 'Salasana on vanhentunut.';
$string['phpparam'] = 'XML-RPC (PHP-rakenne)';
$string['phpresponse'] = 'XML-RPC (PHP-rakenne)';
$string['postrestparam'] = 'PHP-koodi REST:ille (POST-pyyntö)';
$string['potusers'] = 'Ei valtuutettuja käyttäjiä';
$string['potusersmatching'] = 'Ei täsmääviä valtuutettuja käyttäjiä';
$string['print'] = 'Tulosta kaikki';
$string['protocol'] = 'Protokolla';
$string['protocolnotallowed'] = 'Et voi käyttää {$a} -protokollaa (puuttuva kyky: webservice/{$a}:use)';
$string['removefunction'] = 'Poista';
$string['removefunctionconfirm'] = 'Haluatko todella poistaa toiminnon "{$a->function}" palvelusta "{$a->service}"?';
$string['requireauthentication'] = 'Tämä metodi vaatii todentamisen sekä luvan xxx.';
$string['required'] = 'Vaadittu';
$string['requiredcapability'] = 'Vaadittu kyky';
$string['requiredcapability_help'] = 'Jos asetettu, vain käyttäjät, joilla on vaadittu kyky pääsevät palveluun.';
$string['requiredcaps'] = 'Vaaditut kyvyt';
$string['resettokenconfirm'] = 'Haluatko todella asettaa uudelleen tämän verkkopalvelun avaimen käyttäjälle <strong>{$a->user}</strong> palvelussa <strong>{$a->service}</strong>?';
$string['resettokenconfirmsimple'] = 'Haluatko todella asettaa tämän avaimen uudelleen? Tallennetut linkit, joissa on vanha avain, eivät toimi tämän jälkeen.';
$string['response'] = 'Vastaus';
$string['restcode'] = 'REST';
$string['restexception'] = 'REST';
$string['restoredaccountresetpassword'] = 'Palautetun tilin täytyy asettaa uusi salasana ennen avaimen saantia.';
$string['restparam'] = 'REST (POST parametrit)';
$string['restrictedusers'] = 'Vain valtuutetut käyttäjät';
$string['restrictedusers_help'] = 'Tämä asetus määrittelee voivatko kaikki käyttäjät, joilla on oikeus luoda verkkopalvelujen avain, luoda myös avaimen tähän palveluun käyttäjän oman turva-avaimet -sivun kautta, vai voivatko ainoastaan valtuutetut käyttäjät tehdä sen.';
$string['securitykey'] = 'Turva-avain (token)';
$string['securitykeys'] = 'Turva-avaimet';
$string['selectauthorisedusers'] = 'Valitse valtuutetut käyttäjät';
$string['selectedcapability'] = 'Valittu';
$string['selectedcapabilitydoesntexit'] = 'Äskettäin asetettua vaadittavaa kykyä ({$a}) ei ole enää olemassa. Ole hyvä ja muuta sitä ja tallenna muutokset.';
$string['selectservice'] = 'Valitse palvelu';
$string['selectspecificuser'] = 'Valitse tietty käyttäjä';
$string['selectspecificuserdescription'] = 'Lisää verkkopalvelun käyttäjä valtuutetuksi käyttäjäksi.';
$string['service'] = 'Palvelu';
$string['servicehelpexplanation'] = 'Palvelu on joukko toimintoja. Palveluun voi olla pääsy kaikilla tai vain tietyillä käyttäjillä.';
$string['servicename'] = 'Palvelun nimi';
$string['servicenotavailable'] = 'Verkkopalvelua ei ole käytettävissä (joko sitä ei ole olemassa tai se on poistettu käytöstä)';
$string['servicesbuiltin'] = 'Sisäänrakennetut palvelut';
$string['servicescustom'] = 'Räätälöidyt palvelut';
$string['serviceusers'] = 'Valtuutetut käyttäjät';
$string['serviceusersettings'] = 'Käyttäjäasetukset';
$string['serviceusersmatching'] = 'Valtuutetut käyttäjät jotka täsmäävät';
$string['serviceuserssettings'] = 'Muuta valtuutettujen käyttäjien asetuksia';
$string['simpleauthlog'] = 'Yksinkertainen autentikointi -kirjautuminen';
$string['step'] = 'Vaihe';
$string['testauserwithtestclientdescription'] = 'Simuloi ulkoista pääsyä palveluun käyttämällä verkkopalvelun testiasiakasohjelmaa. Ennen sen käyttöä kirjaudu käyttäjänä, jolla on kyky moodle/webservice:createtoken ja hanki turva-avain Oma profiili -asetusten kautta. Käytät tätä avainta testiasiakasohjelmassa. Testiasiakasohjelmassa valitse sallittu protokolla, jossa on avaimen todentaminen. <strong>VAROITUS: Funktio, jota testaat SUORITETAAN tälle käyttäjälle, joten ole varovainen mitä testaat!</strong>';
$string['testclient'] = 'Verkkopalvelun testiasiakas';
$string['testclientdescription'] = '* Verkkopalvelun asiakasohjelma <strong>suorittaa</strong> funktiot <strong>OIKEASTI</strong>. Älä testaa funktioita, joita et tunne. <br/>* Kaikkia olemassa olevia verkkopalvelun funktioita ei ole vielä toteutettu testiasiakasohjelmaan. <br/>* Testataksesi ettei käyttäjä pääse joihinkin funktioihin, voit testata joitakin funktioita, joita et sallinut.<br/>* Jotta näkisit selvempiä virheilmoituksia aseta virheiden etsinnäksi <strong>{$a->mode}</strong> kohteeseen {$a->atag}<br/>* Siirry kohteeseen {$a->amfatag}.';
$string['testwithtestclient'] = 'Testaa palvelua';
$string['testwithtestclientdescription'] = 'Simuloi ulkoista pääsyä palveluun käyttämällä verkkopalvelun testiasiakasohjelmaa. Käytä sallittua protokollaa, jossa on avaimen todentaminen. <strong>VAROITUS: Funktiot, joita testaat SUORITETAAN, joten ole varovainen mitä testaat!</strong>';
$string['token'] = 'Avain';
$string['tokenauthlog'] = 'Avaimen todentaminen';
$string['tokencreatedbyadmin'] = 'Vain ylläpitäjä voi asettaa uudelleen (*)';
$string['tokencreator'] = 'Luoja';
$string['unknownoptionkey'] = 'Tuntemattoman valinnan avain ({$a})';
$string['updateusersettings'] = 'Päivitä';
$string['userasclients'] = 'Käyttäjät asiakkaina avaimella';
$string['userasclientsdescription'] = 'Seuraavat vaiheet auttavat sinua asettamaan Moodlen verkkopalvelun käyttäjille asiakkaina. Nämä vaiheet auttavat myös asettamaan suositellun avaimen (turva-avaimet) todentamismetodin. Tässä käyttötapauksessa käyttäjä generoi avaimensa turva-avaimet -sivulta Minun profiilini -asetusten kautta.';
$string['usermissingcaps'] = 'Puuttuvat kyvyt: {$a}';
$string['usernameorid'] = 'Käyttäjätunnus / Käyttäjä-id';
$string['usernameorid_help'] = 'Anna käyttäjätunnus tai käyttäjän id.';
$string['usernameoridnousererror'] = 'Ei löydetty käyttäjiä tällä käyttäjätunnuksella/käyttäjä-id:llä.';
$string['usernameoridoccurenceerror'] = 'Tällä käyttäjätunnuksella löydettiin useampi kuin yksi käyttäjä. Ole hyvä ja anna käyttäjän id.';
$string['usernotallowed'] = 'Käyttäjällä ei ole pääsyä palveluun. Ensin sinun täytyy sallia käyttäjä kohteen {$a} sallitut käyttäjät hallintasivulla.';
$string['usersettingssaved'] = 'Käyttäjäasetukset tallennettu';
$string['validuntil'] = 'Voimassa asti';
$string['validuntil_help'] = 'Jos asetettu, palvelu ei ole enää tämän päivämäärän jälkeen aktiivinen tälle käyttäjälle.';
$string['webservice'] = 'Verkkopalvelu';
$string['webservices'] = 'Verkkopalvelut';
$string['webservicesoverview'] = 'Yleiskatsaus';
$string['webservicetokens'] = 'Verkkopalvelun avaimet';
$string['wrongusernamepassword'] = 'Väärä käyttäjätunnus tai salasana';
$string['wsaccessuserdeleted'] = 'Verkkopalveluun pääsy kielletty poistetulta käyttäjätunnukselta: {$a}';
$string['wsaccessuserexpired'] = 'Verkkopalveluun pääsy kielletty vanhentuneen salasanan käyttäjätunnukselta: {$a}';
$string['wsaccessusernologin'] = 'Verkkopalveluun pääsy kielletty nologin-kirjautumista käyttävältä käyttäjätunnukselta: {$a}';
$string['wsaccessusersuspended'] = 'Verkkopalveluun pääsy kielletty keskeytetyltä käyttäjätunnukselta: {$a}';
$string['wsaccessuserunconfirmed'] = 'Verkkopalveluun pääsy kielletty vahvistamattomalta käyttäjätunnukselta: {$a}';
$string['wsauthmissing'] = 'Verkkopalvelun autentikointiliitännäinen puuttuu.';
$string['wsauthnotenabled'] = 'Verkkopalvelun autentikointiliitännäinen on pois käytöstä.';
$string['wsclientdoc'] = 'Moodlen verkkopalvelun isäntäkoneen dokumentaatio';
$string['wsdocapi'] = 'API-dokumentaatio';
$string['wsdocumentation'] = 'Verkkopalvelun dokumentaatio';
$string['wsdocumentationdisable'] = 'Verkkopalvelun dokumentaatio on estetty.';
$string['wsdocumentationintro'] = 'Jos haluat luoda asiakkaan, lue {$a->doclink}';
$string['wsdocumentationlogin'] = 'tai anna verkkopalvelun käyttäjätunnuksesi ja salasanasi:';
$string['wspassword'] = 'Verkkopalvelun salasana';
$string['wsusername'] = 'Verkkopalvelun käyttäjätunnus';
