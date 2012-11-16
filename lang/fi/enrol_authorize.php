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
 * Strings for component 'enrol_authorize', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_authorize
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminacceptccs'] = 'Mitkä luottokorttityypit hyväksytään?';
$string['adminaccepts'] = 'Valitse maksumetodit ja niiden tyypit jotka hyväksytään';
$string['adminauthorizeccapture'] = 'Tilauksen tarkastelu ja ajoitetun tallennuksen asetukset';
$string['adminauthorizeemail'] = 'Sähköpostin lähetysasetukset';
$string['adminauthorizesettings'] = 'Authorize.Net toimittajan tilin asetukset';
$string['adminauthorizewide'] = 'Yleiset asetukset';
$string['adminconfighttps'] = 'Varmista että olet "<a href="{$a->url}">asettanut loginhttps:n PÄÄLLE</a>" käyttääksesi tätä moduulia<br />kohdassa Sivuston hallinta >> Tietoturva >> HTTP-tietoturva.';
$string['adminconfighttpsgo'] = 'Mene <a href="{$a->url}">suojatulle sivulle</a> konfiguroidaksesi tämän moduulin.';
$string['admincronsetup'] = 'cron.php huoltoskriptiä ei ole ajettu ainakaan 24 tuntiin.<br />Cron täytyy olla käytössä jos haluat käyttää ajastettu tallennus -toimintoa.<br /><b>Salli</b> \'Authorize.Net -plugini\' ja <b>aseta cron</b> oikein; tai <b>poista valinta an_review</b> uudestaan.<br />Jos estät ajastetun tallennuksen, tilisiirrot peruutetaan jos et tarkastele niitä 30 päivän aikana.<br />Tarkasta <b>an_review</b> ja syötä <b>\'0\' an_capture_day</b> -kenttään<br />jos haluat <b>manuaalisesti</b> hyväksyä/hylätä maksut 30 päivän sisällä.';
$string['adminemailexpiredsort'] = 'Kun vireillä olevien vanhentuvien tilausten määrä lähetetään opettajille sähköpostilla, mikä on tärkeä?';
$string['adminemailexpiredsortcount'] = 'Tilausten määrä';
$string['adminemailexpiredsortsum'] = 'Kokonaismäärä';
$string['adminemailexpsetting'] = '(0=estä sähköpostien lähetys, oletus=2, maksimi=5)<br />(Manuaaliset kaappausasetukset sähköpostin lähettämiselle: cron=sallittu, an_review=valittu, an_capture_day=0, an_emailexpired=1-5)';
$string['adminhelpcapturetitle'] = 'Aikataulutettu tallennuspäivä';
$string['adminhelpreviewtitle'] = 'Tilauksen katselu';
$string['adminneworder'] = 'Hyvä Ylläpitäjä,

Olet saanut uuden tilauksen:

Tilaus-ID: {$a->orderid}
Transaktio-ID: {$a->transid}
Käyttäjä: {$a->user} Kurssi: {$a->course}
Määrä: {$a->amount}

AIKATAULUTETTU TALLENNUS SALLITTU?: {$a->acstatus}

Jos aikataulutettu tallennus on aktiivinen, luottokortti tallennetaan {$a->captureon} ja käyttäjä kirjataan kurssille; muussa tapauksessa se vanhenee {$a->expireon} eikä sitä voida tallentaa tämän jälkeen.

Voit myös hyväksyä/kieltää maksun kirjataksesi opiskelijan välittömästi tästä linkistä: {$a->url}';
$string['adminnewordersubject'] = '{$a->course}: Uusi tilaus: {$a->orderid}';
$string['adminpendingorders'] = 'Olet poistanut ajastettu tallennus -toiminnon käytöstä.<br />Yhteensä {$a->count} tilisiirtoa tilassa \'Valtuutettu/Odottaa tallennusta\' peruutetaan jollet tarkasta niitä.<br />Hyväksyäksesi/hylätäksesi maksut, siirry sivulle <a href=\'{$a->url}\'>Maksujen Hallinta</a>.';
$string['adminteachermanagepay'] = 'Opettajat voivat hallinnoida kurssin maksuja.';
$string['allpendingorders'] = 'Kaikki vireillä olevat tilaukset';
$string['amount'] = 'Määrä';
$string['anauthcode'] = 'Hanki authcode';
$string['anauthcodedesc'] = 'Jos käyttäjän luottokorttia ei voida tallentaa suoraan internetistä, hanki valtuutuskoodi puhelimella asiakkaan pankista.';
$string['anavs'] = 'Osoitteenvarmistusjärjestelmä';
$string['anavsdesc'] = 'Valitse tämä jos olet aktivoinut Osoitteenvarmistusjärjestelmän (AVS) Authorize.Net toimittajan tililläsi. Tämä vaatii osoitekenttiä kuten katu, osavaltio, maa ja postinumero kun käyttäjät täyttävät maksulomakkeen.';
$string['ancaptureday'] = 'Tallennuspäivä';
$string['ancapturedaydesc'] = 'Tallenna luottokortti automaattisesti jos opettaja tai ylläpitäjä eivät tarkastele tilausta määritellyssä aikavälissä. CRON TÄYTYY OLLA TOIMINNASSA. <br />(0 tarkoittaa että aikataulutettu tallennus on estetty sekä opettaja tai ylläpitäjä tarkastelevat tilausta manuaalisesti. Siirto peruutetaan jos estät aikataulutetun tallennuksen tai jos et tarkastele sitä 30 päivän aikana.)';
$string['anemailexpired'] = 'Erääntymisen ilmoitus';
$string['anemailexpireddesc'] = 'Tämä on käytännöllinen \'manuaalisessa tallennuksessa\'. Ylläpitäjille ilmoitetaan vireillä olevien tilausten erääntymisestä näin monta päivää aiemmin.';
$string['anemailexpiredteacher'] = 'Erääntymisen ilmoitus - Opettaja';
$string['anemailexpiredteacherdesc'] = 'Jos olet sallinut manuaalisen tallentamisen (kts. yllä) ja opettajat voivat hallita maksuja, heille voidaan myös ilmoittaa vireillä olevien tilausten erääntymisestä. Tämä lähettää sähköpostin jokaiselle kurssin opettajalle erääntyvien tilausten määrästä.';
$string['anlogin'] = 'Authorize.net: Käyttäjänimi';
$string['anpassword'] = 'Authorize.net: Salasana';
$string['anreferer'] = 'Viittaaja';
$string['anrefererdesc'] = 'Määritä URL-viittaaja jos olet asettanut tämän Authorize.Net toimittajan tililläsi. Tämä lähettää rivin "Viittaaja: URL" upotettuna verkkopyynnössä.';
$string['anreview'] = 'Tarkastelu';
$string['anreviewdesc'] = 'Tarkastele tilausta ennen luottokortin käsittelyä.';
$string['antestmode'] = 'Testitila';
$string['antestmodedesc'] = 'Tee siirrot vain testitilassa (rahaa ei siirretä)';
$string['antrankey'] = 'Authorize.net: Rahansiirtoavain';
$string['approvedreview'] = 'Hyväksytty tarkastelu';
$string['authcaptured'] = 'Valtuutettu / Tallennettu';
$string['authcode'] = 'Valtuutuskoodi';
$string['authorize:config'] = 'Konfiguroi Authorize.Net:in kirjaamisinstanssit';
$string['authorize:manage'] = 'Hallitse kirjautuneita käyttäjiä';
$string['authorize:managepayments'] = 'Hallitse maksuja';
$string['authorize:unenrol'] = 'Poista käyttäjät kurssilta';
$string['authorize:unenrolself'] = 'Poista minut kurssilta';
$string['authorize:uploadcsv'] = 'Lataa CSV-tiedosto';
$string['authorizedpendingcapture'] = 'Valtuutettu / Vireillä oleva tallennus';
$string['authorizeerror'] = 'Authorize.Net virhe: {$a}';
$string['avsa'] = 'Osoite (katu) täsmää, postinumero ei.';
$string['avsb'] = 'Ei annettu osoitetietoa';
$string['avse'] = 'Osoitteenvarmistusjärjestelmä (AVS) -virhe';
$string['avsg'] = 'Ei-U.S. kortin avaajapankki';
$string['avsn'] = 'Ei vastaavuutta osoitteessa (katu) tai postionumerossa';
$string['avsp'] = 'Osoitteenvarmistusjärjestelmä (AVS) ei soveltuva';
$string['avsr'] = 'Yritä uudelleen - järjestelmä ei saatavissa tai aika loppunut';
$string['avsresult'] = 'AVS tulos: {$a}';
$string['avss'] = 'Avaajapankki ei tue palvelua';
$string['avsu'] = 'Osoitetieto ei ole saatavilla';
$string['avsw'] = '9 merkkinen postinumero täsmää, osoite (katu) ei';
$string['avsx'] = 'Osoite (katu) ja 9 merkkinen postinumero täsmäävät';
$string['avsy'] = 'Osoite (katu) ja 5 merkkinen postinumero täsmäävät';
$string['avsz'] = '5 merkkinen postinumero täsmää, osoite (katu) ei';
$string['canbecredit'] = 'Voidaan hyvittää {$a->upto} asti';
$string['cancelled'] = 'Peruutettu';
$string['capture'] = 'Tallenna';
$string['capturedpendingsettle'] = 'Tallennettu / Vireillä oleva tilitys';
$string['capturedsettled'] = 'Tallennettu / Tilitetty';
$string['captureyes'] = 'Luottokortti tallennetaan ja opiskelija lisätään kurssille. Oletko varma?';
$string['cccity'] = 'Kaupunki';
$string['ccexpire'] = 'Vanhenemispäivämäärä';
$string['ccexpired'] = 'Luottokortti on vanhentunut';
$string['ccinvalid'] = 'Virheellinen luottokortin numero';
$string['cclastfour'] = 'CC viimeiset neljä';
$string['ccno'] = 'Luottokortin numero';
$string['ccstate'] = 'Osavaltio';
$string['cctype'] = 'Luottokortin tyyppi';
$string['ccvv'] = 'Kortin vahvistus';
$string['ccvvhelp'] = 'Katso kortin takaa (3 viimeistä numeroa)';
$string['choosemethod'] = 'Jos tiedät ilmoittautumisavaimen kurssille, kirjoita se alle;<br /> Muuten sinun täytyy maksaa tästä kurssista.';
$string['chooseone'] = 'Täytä toinen tai molemmat seuraavista kahdesta kentästä. Salasanaa ei näytetä.';
$string['cost'] = 'Hinta';
$string['costdefaultdesc'] = '<strong>Kurssin asetuksissa syötä -1</strong> käyttääksesi tätä oletushintaa kurssin hintakenttään.';
$string['currency'] = 'Valuutta';
$string['cutofftime'] = 'Keskeytysaika';
$string['cutofftimedesc'] = 'Siirron keskeytysaika. Koska viimeinen siirto otetaan tilitykseen?';
$string['dataentered'] = 'Syötetty tieto';
$string['delete'] = 'Tuhoa';
$string['description'] = 'Authorize.net-moduuli antaa sinun tarjota maksullisia kursseja maksun tarjoajien välityksellä. On olemassa kaksi tapaa asettaa kurssin maksu (1) sivuston laajuinen hinta oletuksena koko sivustolle tai (2) kurssiasetus, jonka voit asettaa joka kurssille erikseen. Kurssin oma hinta-asetus ohittaa koko sivustoa koskevan hinta-asetuksen';
$string['echeckabacode'] = 'Pankin ABA-numero';
$string['echeckaccnum'] = 'Tilinumero';
$string['echeckacctype'] = 'Tilin tyyppi';
$string['echeckbankname'] = 'Pankin nimi';
$string['echeckbusinesschecking'] = 'Liiketoiminnan shekin käyttö';
$string['echeckchecking'] = 'Shekin käyttö';
$string['echeckfirslasttname'] = 'Tilin omistaja';
$string['echecksavings'] = 'Säästöt';
$string['enrolenddate'] = 'Loppumispäivä';
$string['enrolenddaterror'] = 'Kirjautumisen loppumispäivä ei voi olla ennen alkamispäivää';
$string['enrolname'] = 'Authorize.netin luottokorttiyhdyskäytävä';
$string['enrolperiod'] = 'Kirjautumisen kesto';
$string['enrolstartdate'] = 'Alkamispäivä';
$string['expired'] = 'Erääntynyt';
$string['expiremonth'] = 'Erääntymiskuukausi';
$string['expireyear'] = 'Erääntymisvuosi';
$string['firstnameoncard'] = 'Etunimi kortissa';
$string['haveauthcode'] = 'Minulla on jo valtuutuskoodi';
$string['howmuch'] = 'Kuinka paljon?';
$string['httpsrequired'] = 'Olemme pahoillamme mutta pyyntöäsi ei voida käsitellä nyt. Sivuston asetuksia ei voitu säätää oikein.<br /><br />Älä syötä luottokorttisi numeroa jos et näe keltaisen lukon kuvaa selaimesi alaosassa. Jos kuva näkyy, se tarkoittaa että sivu lähettää kaiken tiedon salattuna asiakkaan ja palvelimen välillä. Tällöin luottokorttisi numeroa ei voida kaapata internetistä, koska yhteys koneiden välillä on suojattu.';
$string['invalidaba'] = 'Virheellinen ABA-numero';
$string['invalidaccnum'] = 'Virheellinen tilinumero';
$string['invalidacctype'] = 'Virheellinen tilin tyyppi';
$string['isbusinesschecking'] = 'Onko liiketoiminnan shekkitili?';
$string['lastnameoncard'] = 'Sukunimi kortissa';
$string['logindesc'] = 'Voit asettaa <a href="{$a->url}">loginhttps</a> asetuksen Ylläpidon Asetukset/Turvallisuus-osiossa.
<br /><br />
Tämän valinnan käyttö käskee Moodlea käyttämään turvattua https-yhteyttä vain kirjautumis- ja maksusivuille.';
$string['logininfo'] = 'Kun konfiguroit Authorize.Net tiliäsi, kirjautumisnimi on vaadittu ja sinun pitää antaa <strong>joko</strong> siirron avain <strong>tai</strong> salasana oikeaan kohtaan. Suosittelemme siirtoavaimen käyttöä tietoturvan takia.';
$string['methodcc'] = 'Luottokortti';
$string['methodccdesc'] = 'Valitse luottokortti ja sallitut tyypit alta';
$string['methodecheck'] = 'eCheck (ACH)';
$string['methodecheckdesc'] = 'Valitse eCheck ja sallitut tyypit alta';
$string['missingaba'] = 'Puuttuva ABA-numero';
$string['missingaddress'] = 'Puuttuva osoite';
$string['missingbankname'] = 'Puuttuva pankin nimi';
$string['missingcc'] = 'Puuttuva kortin numero';
$string['missingccauthcode'] = 'Puuttuva valtuutuskoodi';
$string['missingccexpiremonth'] = 'Puuttuva erääntymiskuukausi';
$string['missingccexpireyear'] = 'Puuttuva erääntymisvuosi';
$string['missingcctype'] = 'Puuttuva kortin tyyppi';
$string['missingcvv'] = 'Puuttuva varmistusnumero';
$string['missingzip'] = 'Puuttuva postinumero';
$string['mypaymentsonly'] = 'Näytä vain omat maksuni';
$string['nameoncard'] = 'Nimi kortissa';
$string['new'] = 'Uusi';
$string['nocost'] = 'Tälle kurssille kirjautuminen Authorize.Neti:in kautta ei maksa mitään';
$string['noreturns'] = 'Ei palautuksia!';
$string['notsettled'] = 'Ei tilitetty';
$string['orderdetails'] = 'Tilauksen yksityiskohdat';
$string['orderid'] = 'TilausID';
$string['paymentmanagement'] = 'Maksun hallinta';
$string['paymentmethod'] = 'Maksutapa';
$string['paymentpending'] = 'Maksusi on vireillä tälle kurssille tilausnumerolla {$a->orderid}. Katso <a href=\'{$a->url}\'>Tilaustiedot</a>.';
$string['pendingecheckemail'] = 'Hyvä hallinnoija,

Vireillä olevia echeckkejä on nyt {$a->count} ja sinun täytyy ladata csv-tiedosto rekisteröidäksesi käyttäjät.

Klikkaa linkkiä ja lue help-tiedosto avautuvalta sivulta: {$a->course}';
$string['pendingechecksubject'] = '{$a->course}: Vireillä olevat eCheckit({$a->count})';
$string['pendingordersemail'] = 'Hyvä ylläpitäjä,

{$a->pending} siirtoa kurssille "{$a->course}" erääntyy jos et hyväksy maksuja {$a->days} päivän aikana.

Tämä on varoitusviesti koska et sallinut aikataulutettua tallennusta. Tämä tarkoittaa, että sinun täytyy hyväksyä tai hylätä maksut manuaalisesti.

Hyväksyäksesi/hylätäksesi vireillä olevat maksut mene sivulle: {$a->url}

Jos et halua enää varoitussähköposteja, salli aikataulutettu tallennus sivulla: {$a->enrolurl}';
$string['pendingordersemailteacher'] = 'Hyvä opettaja,

{$a->pending} siirtoa maksoivat {$a->currency} {$a->sumcost} kurssille "{$a->course}". Siirrot vanhenevat jos et hyväksy maksua {$a->days} päivän kuluessa.

Sinun täytyy hyväksyä tai hylätä maksut manuaalisesti koska ylläpitäjä ei ole sallinut aikataulutettua tallennusta.

{$a->url}';
$string['pendingorderssubject'] = 'VAROITUS: {$a->course}, {$a->pending} tilaus(ta) erääntyy {$a->days} päivän kuluessa.';
$string['pluginname'] = 'Authorize.Net';
$string['reason11'] = 'Palautettiin siirron kaksoiskappale.';
$string['reason13'] = 'Toimittajan Kirjautumis-ID on virheellinen tai tili ei ole aktiivinen.';
$string['reason16'] = 'Siirtoa ei löytynyt.';
$string['reason17'] = 'Toimittaja ei hyväksy tämän tyyppistä luottokorttia.';
$string['reason245'] = 'Tätä eCheck-tyyppiä ei sallita, kun käytetään maksuyhdyskäytävän isännöimää maksukaavaketta.';
$string['reason246'] = 'Tätä eCheck-tyyppiä ei sallita.';
$string['reason27'] = 'Siirrosta seurasi AVS-yhteensopimattomuus. Annettu osoite ei täsmää kortinomistajan laskutusosoitteeseen.';
$string['reason28'] = 'Toimittaja ei hyväksy tämän tyyppistä luottokorttia.';
$string['reason30'] = 'Konfiguraatio prosessorin kanssa on virheellinen. Soita toimittajan palveluntarjoajalle.';
$string['reason39'] = 'Annettu valuuttakoodi on joko virheellinen, sitä ei tueta, tämä toimittaja ei salli sitä tai sillä ei ole vaihtokurssia.';
$string['reason43'] = 'Toimittaja oli prosessorissa väärin asetettu. Soita toimittajasi palveluntarjoajalle.';
$string['reason44'] = 'Tämä siirto on hylätty. Korttikoodin suodatinvirhe!';
$string['reason45'] = 'Tämä siirto on hylätty. Korttikoodin / AVS:n suodatinvirhe!';
$string['reason47'] = 'Tilitykseen pyydetty summa ei voi olla isompi kuin alkuperäinen valtuutettu summa.';
$string['reason5'] = 'Tarvitaan validi määrä.';
$string['reason50'] = 'Tämä siirto odottaa tilitystä eikä sitä voida hyvittää.';
$string['reason51'] = 'Kaikkien luottojen summa tätä siirtoa vastaan on suurempi kuin alkuperäinen siirtosumma.';
$string['reason54'] = 'Viitatulla siirrolla ei ole kriteereitä luoton saamiseen.';
$string['reason55'] = 'Luottojen summa viitattua siirtoa vastaan ylittäisi alkuperäisen veloitusmäärän.';
$string['reason56'] = 'Tämä toimittaja hyväksyy vain eCheck (ACH) -siirrot; luottokorttisiirtoja ei hyväksytä.';
$string['refund'] = 'Hyvitys';
$string['refunded'] = 'Hyvitetty';
$string['returns'] = 'Palautukset';
$string['reviewfailed'] = 'Tarkasetele epäonnistuneita';
$string['reviewnotify'] = 'Maksusi tarkastetaan. Opettajasi lähettää sinulle sähköpostia muutaman päivä kuluessa.';
$string['sendpaymentbutton'] = 'Lähetä maksu';
$string['settled'] = 'Tilitetty';
$string['settlementdate'] = 'Tilityspäivä';
$string['shopper'] = 'Ostaja';
$string['status'] = 'Salli Authorize.Net kirjautumiset';
$string['subvoidyes'] = 'Hyvitetty siirto ({$a->transid}) peruutetaan, tämä aiheuttaa tilillesi veloituksen määrälle {$a->amount}. Oletko varma?';
$string['tested'] = 'Testattu';
$string['testmode'] = '[TESTAUSTILA]';
$string['testwarning'] = 'Tallennus/Mitätöinti/Hyvitys näyttää toimivan testitilassa, mutta merkintää ei päivitetty tai syötetty tietokantaan.';
$string['transid'] = 'Siirto-ID';
$string['underreview'] = 'Tarkasteltavana';
$string['unenrolselfconfirm'] = 'Haluatko todella poistua kurssilta "{$a}"?';
$string['unenrolstudent'] = 'Poistetaanko opiskelija kurssilta?';
$string['uploadcsv'] = 'Lähetä CSV-tiedosto';
$string['usingccmethod'] = 'Rekisteröidy käyttäen <a href="{$a->url}"><strong>Luottokorttia</strong></a>';
$string['usingecheckmethod'] = 'Rekisteröidy käyttäen <a href="{$a->url}"><strong>eCheckkiä</strong></a>';
$string['verifyaccount'] = 'Varmista Authorize.Net toimittajan tilisi';
$string['verifyaccountresult'] = '<b>Varmistuksen tulos:</b> {$a}';
$string['void'] = 'Mitätön';
$string['voidyes'] = 'Siirto peruutetaan. Oletko varma?';
$string['welcometocoursesemail'] = 'Hyvä {$a->name},

Kiitos maksustasi. Olet rekisteröitynyt näille kursseille:

{$a->courses}

Voit tarkastella maksutietojasi tai muokata profiiliasi:
{$a->paymenturl}
{$a->profileurl}';
$string['youcantdo'] = 'Et voi suorittaa tätä toimintoa: {$a->action}';
$string['zipcode'] = 'Postinumero';
