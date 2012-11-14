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
 * Strings for component 'mnet', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   mnet
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['RPC_HTTPS_SELF_SIGNED'] = 'HTTPS (itse-allekirjoitettu)';
$string['RPC_HTTPS_VERIFIED'] = 'HTTPS (allekirjoitettu)';
$string['RPC_HTTP_PLAINTEXT'] = 'HTTP (salaamaton)';
$string['RPC_HTTP_SELF_SIGNED'] = 'HTTP (itse-allekirjoitettu)';
$string['RPC_HTTP_VERIFIED'] = 'HTTP (allekirjoitettu)';
$string['aboutyourhost'] = 'Tietoja palvelimestasi';
$string['accesslevel'] = 'Pääsytaso';
$string['addhost'] = 'Lisää isäntä';
$string['addnewhost'] = 'Lisää uusi isäntä';
$string['addtoacl'] = 'Lisää pääsynhallintaan';
$string['allhosts'] = 'Kaikki isännät';
$string['allhosts_no_options'] = 'Vaihtoehdot eivät ole saatavilla useita isäntiä katsellessa';
$string['allow'] = 'Salli';
$string['applicationtype'] = 'Sovelluksen tyyppi';
$string['authfail_nosessionexists'] = 'Valtuutus epäonnistui: mnet-sessiota ei ole.';
$string['authfail_sessiontimedout'] = 'Valtuutus epäonnistui: mnet-sessio on vanhentunut.';
$string['authfail_usermismatch'] = 'Valtuutus epäonnistui: käyttäjä ei täsmää.';
$string['authmnetdisabled'] = 'MNet-todentamismoduuli on <strong>estetty</strong>.';
$string['badcert'] = 'Tämä ei ole kelvollinen sertifikaatti.';
$string['certdetails'] = 'Sertifikaatin tiedot';
$string['configmnet'] = 'MNet mahdollistaa tämän palvelimen kommunikoinnin muiden palvelinten tai palvelujen kanssa.';
$string['couldnotgetcert'] = 'Kohteesta <br />{$a}<br /> ei löytynyt sertifikaattia. Isäntäpalvelin saattaa olla alhaalla tai väärin konfiguroitu.';
$string['couldnotmatchcert'] = 'Tämä ei täsmää verkkopalvelimen tällä hetkellä julkaisemaan sertifikaattiin.';
$string['courses'] = 'kurssit';
$string['courseson'] = 'kurssit';
$string['current_transport'] = 'Nykyinen siirto';
$string['currentkey'] = 'Nykyinen julkinen avain';
$string['databaseerror'] = 'Ei voitu kirjoittaa yksityiskohtia tietokantaan.';
$string['deleteaserver'] = 'Poistetaan palvelin';
$string['deletedhostinfo'] = 'Tämä isäntäpalvelin on poistettu. Jos haluat palauttaa sen, vaihda \'poistettu\' -tila takaisin valintaa \'Ei\'.';
$string['deletedhosts'] = 'Poistetut isäntäpalvelimet: {$a}';
$string['deletehost'] = 'Poista isäntäpalvelin';
$string['deletekeycheck'] = 'Oletko aivan varma että haluat poistaa tämän avaimen?';
$string['deleteoutoftime'] = '60 sekunnin aikarajasi avaimen poistamiseen on umpeutunut. Ole hyvä ja aloita uudelleen.';
$string['deleteuserrecord'] = 'SSO ACL: poista merkintä käyttäjältä  \'{$a->user}\' palvelimelta {$a->host}.';
$string['deletewrongkeyvalue'] = 'Tapahtui virhe. Jos et yrittänyt poistaa palvelimesi SSL-avainta, on mahdollista että olet ollut tahallisen hyökkäyksen kohteena. Toimenpiteisiin ei ryhdytty.';
$string['deny'] = 'Estä';
$string['description'] = 'Kuvaus';
$string['duplicate_usernames'] = 'Epäonnistuttiin indeksin luonnissa käyttäjätaulusi sarakkeisiin "mnethostid" ja "username".<br />Näin voi tapahtua jos sinulla on <a href="{$a}" target="_blank">käyttäjätaulussa kaksoiskappaleita käyttäjätunnuksista</a>.<br />Päivityksesi pitäisi silti onnistua. Klikkaa ylläolevaa linkkiä, niin uuteen ikkunaan avautuu ohjeet tämän ongelman korjaamiseksi. Voit noudattaa ohjeita päivityksen lopussa.<br />';
$string['enabled_for_all'] = '(Tämä palvelu on sallittu kaikille isäntäpalvelimille).';
$string['enterausername'] = 'Ole hyvä ja anna käyttäjätunnus tai pilkulla erotettu lista käyttäjätunnuksista.';
$string['error7020'] = 'Tämä virhe ilmenee yleensä jos etäsivusto on luonut sinulle merkinnän väärällä www-juurella, esimerkiksi, http://yoursite.com eikä http://www.yoursite.com. Sinun tulisi ottaa yhteyttä etäsivuston ylläpitäjään ja pyytää päivittämään merkintä oikeaksi (kuten määritelty tiedostossa config.php),';
$string['error7022'] = 'Etäsivustolle lähettämäsi viesti oli oikein salattu mutta ei allekirjoitettu. Tämä on todella odottamatonta; sinun pitäisi luultavasti ilmoittaa bugista jos tätä tapahtuu (antaen mahdollisimman paljon tietoa kyseessä olevista sovelluversioista jne.).';
$string['error7023'] = 'Etäsivusto on yrittänyt avata lähettämäsi tiedoston salauksen kaikilla sen tiedossa olevilla sivustosi avaimilla. Kaikki yritykset epäonnistuivat. Saatat pystyä korjaamaan virheen asettamalla käsin uuden avaimen sivun kanssa. Tämän tapahtuminen on epätodennäköistä, jollei viimeisestä yhteydestäsi etäsivuun ole kulunut muutamia kuukausia.';
$string['error7024'] = 'Lähetit salaamattoman viestin etäsivustolle mutta etäsivusto ei hyväksy salaamattomia yhteyksiä sivustoltasi. Tämä on todella odottamatonta; sinun pitäisi luultavasti ilmoittaa bugista jos tätä tapahtuu (antaen mahdollisimman paljon tietoa kyseessä olevista sovelluversioista jne.).';
$string['error7026'] = 'Avain, jolla viestisi oli allekirjoitettu eroaa avaimesta, joka etäpalvelimella on tiedossa sinun palvelimellesi. Lisäksi etäpalvelin yritti hakea nykyisen avaimesi mutta epäonnistui. Ole hyvä ja tee manuaalisesti uusi avain etäpalvelimen kanssa ja yritä uudelleen.';
$string['error709'] = 'Etäsivusto epäonnistui SSL-avaimen hankkimisessa sinulta.';
$string['expired'] = 'Tämä avain vanheni';
$string['expires'] = 'Kelvollinen saakka';
$string['expireyourkey'] = 'Poista tämä avain';
$string['expireyourkeyexplain'] = 'Moodle vuorottelee avaimiasi automaattisesti 28 päivän välein (oletuksena) mutta sinulla on mahdollisuus <em>manuaalisesti</em> vanhentaa tämä avain koska tahansa. Tämä on käyttökelpoista ainoastaan jos uskot avaimen turvallisuuden vaarantuneen. Korvaava generoidaan automaattisesti välittömästi.<br />Tämän avaimen poistaminen tekee muiden sovellusten kanssa kommunikoinnin mahdottomaksi, kunnes otat manuaalisesti yhteyttä jokaiseen ylläpitäjään ja annat uuden avaimesi.';
$string['exportfields'] = 'Vietävät kentät';
$string['failedaclwrite'] = 'Ei voitu kirjoittaa MNet:in pääsynhallintalistaan käyttäjälle \'{$a}\'.';
$string['findlogin'] = 'Etsi sisäänkirjautuminen';
$string['forbidden-function'] = 'Funktiota ei ole sallittu RPC:lle.';
$string['forbidden-transport'] = 'Siirtotapa, jota yrität käyttää, ei ole sallittu.';
$string['forcesavechanges'] = 'Pakota muutosten tallennus';
$string['helpnetworksettings'] = 'Konfiguroi MNet-kommunikointi';
$string['hidelocal'] = 'Piilota paikalliset käyttäjät';
$string['hideremote'] = 'Piilota etäkäyttäjät';
$string['host'] = 'isäntä';
$string['hostcoursenotfound'] = 'Isäntää tai kurssia ei löytynyt';
$string['hostdeleted'] = 'Isäntä poistettu';
$string['hostexists'] = 'Samalla isäntäpalvelimen nimellä on jo merkintä (se voidaan poistaa). <a href="{$a}">Napsauta tätä</a> muuttaaksesi merkintää.';
$string['hostlist'] = 'Lista verkotetuista isäntäpalvelimista';
$string['hostname'] = 'Isännän nimi';
$string['hostnamehelp'] = 'Etäisännän täysin pätevä domainnimi, esim. www.example.com';
$string['hostnotconfiguredforsso'] = 'Tätä palvelinta ei ole konfiguroitu etäkirjautumiseen.';
$string['hostsettings'] = 'Isännän asetukset';
$string['http_self_signed_help'] = 'Salli yhteydet käyttäen itse allekirjoitettua DIY SSL-sertifikaattia etäpalvelimella.';
$string['http_verified_help'] = 'Salli yhteydet käyttäen varmennettua SSL-sertifikaattia etäpalvelimella PHP:ssa, mutta yli http:n (ei https).';
$string['https_self_signed_help'] = 'Salli yhteydet http:n yli käyttäen itse allekirjoitettua DIY SSL:ää PHP:ssa etäpalvelimella.';
$string['https_verified_help'] = 'Salli yhteydet käyttäen varmennettua SSL-sertifikaattia etäpalvelimella.';
$string['id'] = 'ID';
$string['idhelp'] = 'Tämä arvo annetaan automaattisesti eikä sitä voi muuttaa';
$string['importfields'] = 'Tuotavat kentät';
$string['inspect'] = 'Tarkasta';
$string['installnosuchfunction'] = 'Koodausvirhe! Jokin yrittää asentaa mnet xmlrpc -funktiota ({$a->method}) tiedostosta ({$a->file}) eikä sitä löydy!';
$string['installnosuchmethod'] = 'Koodausvirhe! Jokin yrittää asentaa mnet xmlrpc -metodia ({$a->method}) luokkaan ({$a->class}) eikä sitä löydy!';
$string['installreflectionclasserror'] = 'Koodausvirhe! MNet introspektio epäonnistui metodille \'{$a->method}\' luokassa \'{$a->class}\'. Alkuperäinen virheviesti, jos se auttaisi, on: \'{$a->error}\'';
$string['installreflectionfunctionerror'] = 'Koodausvirhe! MNet introspektio epäonnistui funktiolle \'{$a->method}\' tiedostossa \'{$a->file}\'. Alkuperäinen virheviesti, jos se auttaisi, on: \'{$a->error}\'';
$string['invalidaccessparam'] = 'Virheellinen pääsyparametri';
$string['invalidactionparam'] = 'Virheellinen toimintoparametri';
$string['invalidhost'] = 'Sinun pitää antaa kelvollinen isännän tunniste';
$string['invalidpubkey'] = 'Avain ei ole kelvollinen SSL-avain. ({$a})';
$string['invalidurl'] = 'Virheellinen URL-parametri.';
$string['ipaddress'] = 'IP-osoite';
$string['is_in_range'] = 'IP-osoite <code>{$a}</code> edustaa kelvollista luotettua isäntäpalvelinta.';
$string['ispublished'] = '{$a} on sallinut tämän palvelun sinulle.';
$string['issubscribed'] = '{$a} on tilannut tämän palvelun palvelimellasi.';
$string['keydeleted'] = 'Avaimesi on onnistuneesti poistettu ja korvattu.';
$string['keymismatch'] = 'Julkinen avain, joka sinulla on tälle palvelimelle, eroaa julkisesta avaimesta, jota palvelin tällä hetkellä julkaisee. Tällä hetkellä julkaistu avain on:';
$string['last_connect_time'] = 'Viimeinen yhteysaika';
$string['last_connect_time_help'] = 'Aika, jolloin viimeksi otit yhteyden tähän palvelimeen.';
$string['last_transport_help'] = 'Siirtotapa, jota käytit viimeiseen yhteyteen tämän palvelimen kanssa.';
$string['leavedefault'] = 'Käytä sen sijaan oletusasetuksia';
$string['listservices'] = 'Listaa palvelut';
$string['loginlinkmnetuser'] = '<br />Jos olet MNet etäkäyttäjä ja voit <a href="{$a}">varmistaa sähköpostiosoitteesi täällä</a>, sinut voidaan ohjata kirjautumissivullesi.<br />';
$string['logs'] = 'lokit';
$string['managemnetpeers'] = 'Hallitse vertaisia';
$string['method'] = 'Metodi';
$string['methodhelp'] = 'Metodiohjeet kohteelle {$a}';
$string['methodsavailableonhost'] = 'Käytettävissä olevat metodit kohteelle {$a}';
$string['methodsavailableonhostinservice'] = 'Käytettävissä olevat metodit palvelulle {$a->service} palvelimella {$a->host}';
$string['methodsignature'] = 'Metodin allekirjoitus kohteelle {$a}';
$string['mnet'] = 'MNet';
$string['mnet_concatenate_strings'] = 'Yhdistä (korkeintaan) 3 merkkijonoa ja palauta tulokset';
$string['mnet_session_prohibited'] = 'Käyttäjät kotipalvelimeltasi eivät tällä hetkellä saa siirtyä kohteeseen {$a}.';
$string['mnetdisabled'] = 'MNet on <strong>estetty</strong>.';
$string['mnetidprovider'] = 'MNet-ID:n tarjoaja';
$string['mnetidproviderdesc'] = 'Voit käyttää tätä apukeinoa hakeaksesi linkin, jossa voit kirjautua, jos voit antaa sähköpostiosoitteen, joka täsmää käyttäjätunnukseen, jolla yritit viimeksi kirjautua.';
$string['mnetidprovidermsg'] = 'Sinun pitäisi pystyä kirjautumaan {$a} -tarjoajallasi.';
$string['mnetidprovidernotfound'] = 'Valitettavasti lisätietoa ei löytynyt.';
$string['mnetlog'] = 'Lokit';
$string['mnetpeers'] = 'Vertaiset';
$string['mnetservices'] = 'Palvelut';
$string['mnetsettings'] = 'MNet-asetukset';
$string['moodle_home_help'] = 'Polku etäpalvelimen MNet-sovelluksen kotisivulle, esim. /moodle/.';
$string['name'] = 'Nimi';
$string['net'] = 'Verkko';
$string['networksettings'] = 'Verkkoasetukset';
$string['never'] = 'Ei koskaan';
$string['noaclentries'] = 'Ei merkintöjä SSO-pääsynhallintalistalla';
$string['noaddressforhost'] = 'Valitettavasti palvelimen nimeä ({$a}) ei voitu ratkaista!';
$string['nocurl'] = 'PHP cURL-kirjastoa ei ole asennettu';
$string['nolocaluser'] = 'Paikallista merkintää etäkäyttäjästä ei ole, eikä sitä voitu luoda, koska tämä palvelin ei luo automaattisesti käyttäjiä. Ole hyvä ja ota yhteyttä ylläpitäjääsi!';
$string['nomodifyacl'] = 'Et voi muokata MNet-pääsynhallintalistaa.';
$string['nonmatchingcert'] = 'Sertifikaatin aihe: <br /><em>{$a->subject}</em><br />ei täsmää palvelimeen, jolta se tuli:<br /><em>{$a->host}</em>.';
$string['nopubkey'] = 'Julkisen avaimen hakemisessa oli ongelma.<br />Ehkä palvelin ei salli MNet:tiä tai avain on virheellinen.';
$string['nosite'] = 'Ei löydetty sivustotason kurssia';
$string['nosuchfile'] = 'Tiedostoa/funktiota ei ole.';
$string['nosuchfunction'] = 'Ei löydetä funktiota, tai funktiota ei ole RPC:lle.';
$string['nosuchmodule'] = 'Funktioon viitattiin väärin tai sitä ei löytynyt. Ole hyvä ja käytä mod/modulename/lib/functionname muotoa.';
$string['nosuchpublickey'] = 'Ei pystytä hankkimaan julkista avainta allekirjoituksen varmistamiseen.';
$string['nosuchservice'] = 'RPC-palvelu ei ole käynnissä tällä palvelimella.';
$string['nosuchtransport'] = 'ID:llä ei ole siirtoa.';
$string['notBASE64'] = 'Tämä merkkijono ei ole base64-koodatussa muodossa. Se ei voi olla kelvollinen avain.';
$string['notPEM'] = 'Tämä avain ei ole PEM-muodossa. Avain ei toimi.';
$string['not_in_range'] = 'IP-osoite <code>{$a}</code> ei edusta kelvollista luotettua palvelinta.';
$string['notenoughidpinfo'] = 'Valitettavasti identiteetintarjoajasi ei anna tarpeeksi tietoa tilisi luomiseen tai päivittämiseen paikallisesti.';
$string['notinxmlrpcserver'] = 'Yritys päästä MNet-etäasiakkaalle, ei kesken XMLRPC-palvelimen suoritusta';
$string['notmoodleapplication'] = 'VAROITUS: Tämä ei ole Moodle-sovellus joten jotkin tarkastusmetodit eivät ehkä toimi oikein.';
$string['notpermittedtojump'] = 'Sinulla ei ole lupaa aloittaa etäsessiota tältä Moodle-palvelimelta.';
$string['notpermittedtojumpas'] = 'Et voi aloittaa etäsessiota kun olet kirjautuneena toisena käyttäjänä.';
$string['notpermittedtoland'] = 'Sinulla ei ole lupaa aloittaa etäsessiota.';
$string['off'] = 'Pois päältä';
$string['on'] = 'Päällä';
$string['options'] = 'Vaihtoehdot';
$string['peerprofilefielddesc'] = 'Täällä voit ohittaa globaalit asetukset siitä, mille profiilikentille lähettää ja tuoda tietoa, kun uusia käyttäjiä luodaan.';
$string['permittedtransports'] = 'Sallitut siirrot';
$string['phperror'] = 'Sisäinen PHP-virhe esti pyyntösi toteutuksen.';
$string['position'] = 'Sijainti';
$string['postrequired'] = 'Poistofunktio vaatii POST-pyynnön.';
$string['profileexportfields'] = 'Lähetettävät kentät';
$string['profilefielddesc'] = 'Täällä voit määrittää listan profiilikentistä, jotka lähetetään ja vastaanotetaan MNet:in yli kun käyttäjätilejä luodaan tai päivitetään. Voit myös ohittaa tämän jokaiselle MNet vertaiselle yksilöllisesti. Huomaa että seuraavat kentät lähetetään aina, eivätkä ne ole valinnaisia: {$a}';
$string['profilefields'] = 'Profiilikentät';
$string['profileimportfields'] = 'Tuotavat kentät';
$string['promiscuous'] = 'Summittainen';
$string['publickey'] = 'Julkinen avain';
$string['publickey_help'] = 'Julkinen avain hankitaan automaattisesti etäpalvelimelta';
$string['publish'] = 'Julkaise';
$string['reallydeleteserver'] = 'Oletko varma että haluat poistaa palvelimen';
$string['receivedwarnings'] = 'Seuraavat varoitukset vastaanotettiin';
$string['recordnoexists'] = 'Merkintää ei ole.';
$string['reenableserver'] = 'Ei - valitse tämä vaihtoehto salliaksesi uudelleen palvelimen.';
$string['registerallhosts'] = 'Rekisteröi kaikki palvelimet (summittainen moodi)';
$string['registerallhostsexplain'] = 'Voit halutessasi rekisteröidä kaikki isäntäpalvelimet, jotka yrittävät ottaa yhteyttä sinuun automaattisesti. Tämä tarkoittaa, että listaasi isäntäpalvelimista tulee merkintä kaikista MNet-sivustoista, jotka ottavat sinuun yhteyttä ja pyytävät julkista avaintasi.<br />Sinulla on alla mahdollisuus konfiguroida palvelut \'Kaikille isännille\' ja salliessasi joitakin palveluita siellä, voit tarjota palveluita mille tahansa etäpalvelimelle.';
$string['registerhostsoff'] = 'Rekisteröi kaikki palvelimet on tällä hetkellä <b>pois päältä</b>';
$string['registerhostson'] = 'Rekisteröi kaikki palvelimet on tällä hetkellä <b>päällä</b>';
$string['remotecourses'] = 'Etäkurssit';
$string['remotehost'] = 'Etäpalvelin';
$string['remotehosts'] = 'Etäpalvelimet';
$string['remoteuserinfo'] = 'Etä {$a->remotetype} -käyttäjä - profiili haettiin kohteesta <a href="{$a->remoteurl}">{$a->remotename}</a>';
$string['requiresopenssl'] = 'Verkko vaatii OpenSSL-lisäosan';
$string['restore'] = 'Palauta';
$string['returnvalue'] = 'Palauta arvo';
$string['reviewhostdetails'] = 'Tarkastele palvelimen tietoja';
$string['reviewhostservices'] = 'Tarkastele palvelimen palveluita';
$string['selectaccesslevel'] = 'Ole hyvä ja valitse pääsytaso listalta.';
$string['selectahost'] = 'Ole hyvä ja valitse etäpalvelin.';
$string['service'] = 'Palvelun nimi';
$string['serviceid'] = 'Palvelun ID';
$string['servicesavailableonhost'] = 'Saatavilla olevat palvelut kohteessa {$a}';
$string['serviceswepublish'] = 'Julkaistavat palvelut kohteelle {$a}.';
$string['serviceswesubscribeto'] = 'Tilatut palvelut kohteelta {$a}.';
$string['settings'] = 'Asetukset';
$string['showlocal'] = 'Näytä paikalliset käyttäjät';
$string['showremote'] = 'Näytä etäkäyttäjät';
$string['ssl_acl_allow'] = 'SSO ACL: Salli käyttäjä {$a->user} kohteesta {$a->host}';
$string['ssl_acl_deny'] = 'SSO ACL: Estä käyttäjä {$a->user} kohteesta {$a->host}';
$string['ssoaccesscontrol'] = 'SSO-pääsynhallinta';
$string['ssoacldescr'] = 'Käytä tätä sivua salliaksesi/kieltääksesi pääsyn tietyiltä etä-MNet-palvelinten käyttäjiltä. Tämä on käytännöllistä kun tarjoat SSO-palveluita etäkäyttäjille. Hallitaksesi <em>paikallisten</em> käyttäjiesi kykyä siirtyä muille MNet isäntäpalvelimille, käytä rooleja antaaksesi heille <em>mnetlogintoremote</em> -kyvyn.';
$string['ssoaclneeds'] = 'Jotta tämä toiminnallisuus toimisi, sinulla täytyy olla Verkkotyöskentely päällä sekä MNet-todentamisplugini käytössä.';
$string['strict'] = 'Tiukka';
$string['subscribe'] = 'Tilaa';
$string['system'] = 'Järjestelmä';
$string['testclient'] = 'MNet -testiasiakas';
$string['testtrustedhosts'] = 'Testaa osoite';
$string['testtrustedhostsexplain'] = 'Anna IP-osoite nähdäksesi onko kyseessä luotettava isäntäpalvelin.';
$string['theypublish'] = 'He julkaisevat';
$string['theysubscribe'] = 'He tilaavat';
$string['transport_help'] = 'Nämä valinnat ovat vastavuoroisia, joten voit pakottaa etäpalvelimen käyttämään varmennettua SSL-sertifikaattia vain, jos myös omalla palvelimellasi on se.';
$string['trustedhosts'] = 'XML-RPC -palvelimet';
$string['trustedhostsexplain'] = '<p>Luotetut palvelimet -mekanismi sallii tiettyjen koneiden suorittaa kutsuja XML-RPC:n kautta mihin tahansa Moodle-API:n osaan. Tämä on käytössä vain Moodlen käyttäytymistä hallitseville skripteille ja sen käyttöönotto voi olla hyvin vaarallista. Jos et ole varma, pidä tämä pois päältä.</p> <p><strong>Tämä ei ole tarvittavaa missään normaalissa MNet-ominaisuudessa!</strong>
Ota ominaisuus käyttöön vain jos tiedät mitä teet.</p> <p>Ottaaksesi sen käyttöön, syötä lista IP-osoitteista tai verkoista, yksi joka riville. Joitakin esimerkkejä:</p> Paikallinen palvelimesi:<br />127.0.0.1<br />Paikallinen palvelimesi (verkon estolla):<br />127.0.0.1/32<br />Vain palvelin IP-osoitteella 192.168.0.7:<br />192.168.0.7/32<br />Mikä tahansa palvelin, jolla IP-osoite on väliltä 192.168.0.1 ja 192.168.0.255:<br />192.168.0.0/24<br />Mikä tahansa palvelin:<br />192.168.0.0/0<br />Selvästikin viimeinen esimerkki <strong>ei</strong> ole suositeltava konfiguraatio.';
$string['turnitoff'] = 'Käännä pois päältä';
$string['turniton'] = 'Käännä päälle';
$string['type'] = 'Tyyppi';
$string['unknown'] = 'Tuntematon';
$string['unknownerror'] = 'Neuvottelun aikana tapahtui tuntematon virhe.';
$string['usercannotchangepassword'] = 'Et voi muutaa salasanaasi täällä koska olet etäkäyttäjä.';
$string['userchangepasswordlink'] = '<br /> Saatat pystyä vaihtamaan salasanasi <a href="{$a->wwwroot}/login/change_password.php">{$a->description}</a> tarjoajallasi.';
$string['usernotfullysetup'] = 'Käyttäjätilisi on keskeneräinen. Sinun täytyy mennä <a href="{$a}">takaisin tarjoajallesi</a> ja varmistaa että profiilisi on siellä kunnossa. Sinun pitää ehkä kirjautua ulos ja sisään uudelleen, jotta tämä toimisi.';
$string['usersareonline'] = 'VAROITUS: {$a} käyttäjää tältä palvelimelta on kirjautuneena sivustollasi.';
$string['validated_by'] = 'Se on verkon : <code>{$a}</code> hyväksymä';
$string['verifysignature-error'] = 'Allekirjoituksen varmistus epäonnistui. Tapahtui virhe.';
$string['verifysignature-invalid'] = 'Allekirjoituksen varmistus epäonnistui. Vaikuttaa siltä ettei tämä tietosisältö ole sinun allekirjoittamasi.';
$string['version'] = 'Versio';
$string['warning'] = 'Varoitus';
$string['wrong-ip'] = 'IP-osoitteesi ei täsmää tietoihimme.';
$string['xmlrpc-missing'] = 'Sinulla täytyy olla XML-RPC asennettuna PHP:ssasi käyttääksesi tätä toimintoa.';
$string['yourhost'] = 'Isäntäpalvelimesi';
$string['yourpeers'] = 'Vertaisesi';
