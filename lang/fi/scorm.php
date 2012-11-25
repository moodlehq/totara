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
 * Strings for component 'scorm', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   scorm
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activation'] = 'Aktivointi';
$string['activityloading'] = 'Sinut automaattisesti uudelleen ohjataan aktiviteettiin';
$string['activitypleasewait'] = 'Aktiviteettia ladataan, odota ...';
$string['adminsettings'] = 'Ylläpidon asetukset';
$string['advanced'] = 'Parametrit';
$string['aicchacpkeepsessiondata'] = 'AICC HACP session data';
$string['aicchacpkeepsessiondata_desc'] = 'AICC HACP -istuntojen ulkoisten tietojen säilytysaika päivissä (pitkä aika täyttää taulukon vanhalla tiedolla mutta saattaa olla hyödyllinen testausvaiheessa)';
$string['aicchacptimeout'] = 'AICC HACP Timeout';
$string['aicchacptimeout_desc'] = 'Maksimiminuuttimäärä, jonka ulkoinen AICC HACP -istunto voi olla auki';
$string['allowapidebug'] = 'Aktivoi API-virheidenetsintä (aseta capture mask apidebugmask:illa)';
$string['allowtypeaicchacp'] = 'Ota käyttöön ulkoinen AICC HACP';
$string['allowtypeaicchacp_desc'] = 'Tämä asetus mahdollistaa ulkoisen AICC HACP-kommunikaation (lomakkeet ja tiedostojen lataaminen ulkoisesta AICC-paketista) ilman sisäänkirjautumista.';
$string['allowtypeexternal'] = 'Salli ulkoinen pakettityyppi';
$string['allowtypeexternalaicc'] = 'Ota käyttöön suora AICC-osoite';
$string['allowtypeexternalaicc_desc'] = 'Jos käytössä, tämä mahdollistaa suoran osoitteen yksinkertaiseen AICC-pakettiin';
$string['allowtypeimsrepository'] = 'Salli IMS-pakettityyppi';
$string['allowtypelocalsync'] = 'Salli ladattu pakettityyppi';
$string['apidebugmask'] = 'API virheiden etsintä capture mask - käytä yksinkertaista regex:iä kohteessa <username>:<activityname> esim. admin:.* etsii virheitä vain admin-käyttäjästä';
$string['areacontent'] = 'Sisältötiedostot';
$string['areapackage'] = 'Pakettitiedosto';
$string['asset'] = 'Sivu';
$string['assetlaunched'] = 'Sivu - katseltu';
$string['attempt'] = 'Suorituskerta';
$string['attempt1'] = '1 suorituskerta';
$string['attempts'] = 'Suorituskerrat';
$string['attemptsx'] = '{$a} suorituskertaa';
$string['attr_error'] = 'Virheellinen arvo attribuutille ({$a->attr}) merkinnässä  {$a->tag}';
$string['autocontinue'] = 'Jatka automaattisesti';
$string['autocontinue_help'] = 'Jos sallittu, seuraavat oppimiskohteet käynnistetään automaattisesti, muuten täytyy käyttää Jatka-painiketta.';
$string['autocontinuedesc'] = 'Tämä asetus määrittää aktiviteetin automaattisen jatkamisen oletuksen';
$string['averageattempt'] = 'Suorituskertojen keskiarvo';
$string['badmanifest'] = 'Manifest -virheitä, katso virheloki';
$string['badpackage'] = 'Määritelty paketti/manifest ei ole voimassa oleva. Tarkista se ja yritä uudelleen.';
$string['browse'] = 'Selaa';
$string['browsed'] = 'Selattu';
$string['browsemode'] = 'Esikatselunäkymä';
$string['browserepository'] = 'Selaa varastoa';
$string['cannotfindsco'] = 'Ei löydetä SCO:ta';
$string['chooseapacket'] = 'Valitse tai päivitä SCORM-paketti';
$string['completed'] = 'Suoritettu';
$string['completionscorerequired'] = 'Vaadi minimipistemäärä';
$string['completionstatus_completed'] = 'Suoritettu';
$string['completionstatus_failed'] = 'Hylätty';
$string['completionstatus_help'] = '# Aktiviteetin suorittaminen: Vaadi tietty tila
Yhden tai useamman tilan valitseminen tarkoittaa sitä, että käyttäjän tulee saavuttaa ainakin yksi valituista tiloista, jotta tämä SCORM-aktiviteetti merkitään hänen osaltaan suoritetuksi, muiden mahdollisten aktiviteetin suorittamisvaatimusten lisäksi.';
$string['completionstatus_passed'] = 'Hyväksytty';
$string['completionstatusrequired'] = 'Vaadi tieto suorituksen tilasta';
$string['confirmloosetracks'] = 'VAROITUS: Pakettia on vaihdettu tai muokattu. Jos paketin rakennetta on vaihdettu, jotkut käyttäjä jäljet saattavat hävitä päivitysprosessin aikana.';
$string['contents'] = 'Sisältö';
$string['coursepacket'] = 'Kurssipaketti';
$string['coursestruct'] = 'Kurssin rakenne';
$string['currentwindow'] = 'Nykyinen ikkuna';
$string['datadir'] = 'Tiedoston luontivirhe: Kurssin datahakemistoa ei voi luoda';
$string['defaultdisplaysettings'] = 'Näytön oletusasetukset';
$string['defaultgradesettings'] = 'Arvioinnin oletusasetukset';
$string['defaultothersettings'] = 'Muut oletusasetukset';
$string['deleteallattempts'] = 'Poista kaikki SCORM-suorituskerrat';
$string['deleteattemptcheck'] = 'Haluatko varmasti poistaa nämä suorituskerrat?';
$string['deleteuserattemptcheck'] = 'Haluatko varmasti poistaa kaikki suorituksesi?';
$string['details'] = 'Jäljitä yksityiskohdat';
$string['directories'] = 'Näytä linkit kansioihin';
$string['disabled'] = 'Estetty';
$string['display'] = 'Näytä paketti';
$string['displayattemptstatus'] = 'Näytä suorituskerran tila';
$string['displayattemptstatus_help'] = 'Jos käytössä, suorituskertojen pisteet ja arvosanat näytetään SCORM-sivulla.';
$string['displayattemptstatusdesc'] = 'Tämä asetus määrittää oletusarvon \'Näytä suorituskerran tila\' -asetukselle';
$string['displaycoursestructure'] = 'Näytä kurssin rakenne aloitussivulla';
$string['displaycoursestructure_help'] = 'Jos sallittu, sisällysluettelo näytetään SCORM-sivulla.';
$string['displaycoursestructuredesc'] = 'Tämä asetus määrittää oletusarvon \'Näytä kurssin rakenne aloitussivulla\' -asetukselle';
$string['displaydesc'] = 'Tämä asetus määrittelee oletuksen asetukselle näytetäänkö aktiviteetin paketti';
$string['displaysettings'] = 'Näyttöasetukset';
$string['domxml'] = 'DOMXML ulkoinen kirjasto';
$string['duedate'] = 'Määräpäivä';
$string['element'] = 'Elementti';
$string['elementdefinition'] = 'Elementin määrittely';
$string['enter'] = 'Liity';
$string['entercourse'] = 'Liity SCORM-kurssille';
$string['errorlogs'] = 'Virheloki';
$string['everyday'] = 'Joka päivä';
$string['everytime'] = 'Joka kerta kun sitä on käytetty';
$string['exceededmaxattempts'] = 'Olet suorittanut maksimimäärän kertoja';
$string['exit'] = 'Poistu kurssilta';
$string['exitactivity'] = 'Poistu aktiviteetistä';
$string['expired'] = 'Valitettavasti tämä aktiviteetti on sulkeutunut {$a} eikä ole enää saatavilla';
$string['external'] = 'Päivitä ulkoisten pakettien ajanottoa';
$string['failed'] = 'Epäonnistui';
$string['finishscorm'] = 'Jos olet lopettanut tämän aktiviteetin tarkastelun, {$a}';
$string['finishscormlinkname'] = 'klikkaa tässä palataksesi kurssisivulle';
$string['firstaccess'] = 'Ensimäinen käynti';
$string['firstattempt'] = 'Ensimmäinen suorituskerta';
$string['forcecompleted'] = 'Pakota valmiiksi';
$string['forcecompleted_help'] = 'Jos käytössä, nykyinen suorituskerta on pakotettu tilaan "valmis". Tätä asetusta sovelletaan vain SCORM 1.2 paketteihin. Se on hyödyllinen, jos SCORM-paketti ei osaa käsitellä suoritukseen uudelleenmenemistä oikein review tai browse -moodissa, tai muuten käsittelee väärin suorituksen tilan.';
$string['forcecompleteddesc'] = 'Tämä asetus määrittää oletusarvon \'Pakota valmiiksi\' -asetukselle';
$string['forcejavascript'] = 'Pakota käyttäjät sallimaan JavaScript';
$string['forcejavascript_desc'] = 'Jos käytössä, (suositeltua) tämä estää pääsyn SCORM-aineistoihin kun JavaScript ei ole käyttäjän selaimessa päällä/tuettu. Jos ei päällä, käyttäjä voi katsella SCORM:ia mutta API-viestit epäonnistuvat eikä arvosanatietoja tallenneta.';
$string['forcejavascriptmessage'] = 'Tämän kohteen tarkasteluun vaaditaan JavaScript, salli JavaScriptin käyttö selaimesi asetuksista ja yritä uudelleen.';
$string['forcenewattempt'] = 'Pakota uusi suorituskerta';
$string['forcenewattempt_help'] = 'Jos asetus on käytössä, jokainen SCORM-paketin avaus lasketaan uudeksi suorituskerraksi.';
$string['forcenewattemptdesc'] = 'Tämä asetus määrittää oletusarvon \'Pakota uusi suorituskerta\' -asetukselle';
$string['found'] = 'Manifest';
$string['frameheight'] = 'Tämä asetus asettaa SCO-kehyksen oletuskorkeuden';
$string['framewidth'] = 'Tämä asetus asettaa SCO-kehyksen oletusleveyden';
$string['fullscreen'] = 'Sovita koko ruudulle';
$string['general'] = 'Yleiset tiedot';
$string['gradeaverage'] = 'Keskiarvo';
$string['gradeforattempt'] = 'Suorituskerran arvosana';
$string['gradehighest'] = 'Korkein arviointi';
$string['grademethod'] = 'Arviointitapa';
$string['grademethod_help'] = 'Arviointimenetelmä määrittelee, miten kunkin suorituskerran arvosana määräytyy. Arviointimenetelmiä on neljä:
* Oppimisaihiot: suoritettujen oppimisaihioiden lukumäärä
* Korkein arvosana: Kaikista suoritetuista oppimisaihioista saatu korkein arvosana
* Arvosanojen keskiarvo: kaikkien saatujen arvosanojen keskiarvo
* Arvosanojen summa: Kaikkien saatujen arvosanojen summa';
$string['grademethoddesc'] = 'Tämä asetus määrittää oletusarviointitavan aktiviteetille';
$string['gradereported'] = 'Arvosana raportoitu';
$string['gradescoes'] = 'Oppimisobjektit';
$string['gradesettings'] = 'Arvosana-asetukset';
$string['gradesum'] = 'Yhteistulos';
$string['height'] = 'Korkeus';
$string['hidden'] = 'Piilotettu';
$string['hidebrowse'] = 'Poista esikatselu käytöstä';
$string['hidebrowse_help'] = 'Esikatselutila sallii opiskelijan selata aktiviteettia ennen sen yrittämistä. Jos esikatselutila on estetty, on esikatselu-painike piilotettu.';
$string['hidebrowsedesc'] = 'Tämä asetus määrittelee oletuksen, sallitaanko vai estetäänkö esikatselutila';
$string['hideexit'] = 'Piilota poistu-linkki';
$string['hidenav'] = 'Piilota navigointipainikkeet';
$string['hidenavdesc'] = 'Tämä asetus määrittelee oletuksen, näytetäänkö navigaatiopainikkeet';
$string['hidereview'] = 'Piilota esikatselu-painike';
$string['hidetoc'] = 'Näytä kurssin rakennenäkymä';
$string['hidetoc_help'] = 'Tämä asetus määrittelee miten sisällysluettelo näytetään SCORM-soittimessa.';
$string['hidetocdesc'] = 'Tämä asetus määrittelee oletuksen, näytetäänkö kurssirakenne (sisällysluettelo) SCORM-soittimessa';
$string['highestattempt'] = 'Paras suorituskerta';
$string['identifier'] = 'Kysymyksen tunniste';
$string['incomplete'] = 'Kesken';
$string['info'] = 'Tiedot';
$string['interactions'] = 'Linkitykset';
$string['interactionscorrectcount'] = 'Kysymyksen oikeiden vastausten määrä';
$string['interactionsid'] = 'Elementin ID';
$string['interactionslearnerresponse'] = 'Oppijan vastaus';
$string['interactionspattern'] = 'Oikean vastauksen kaava';
$string['interactionsresponse'] = 'Opiskelijan vastaus';
$string['interactionsresult'] = 'Tulos perustuen opiskelijan vastaukseen sekä <br />oikeaan tulokseen';
$string['interactionstype'] = 'Kysymystyyppi';
$string['interactionsweight'] = 'Elementtiin liitetty painoarvo';
$string['invalidactivity'] = 'Scorm-aktiviteetti on väärä';
$string['invalidhacpsession'] = 'Virheellinen HACP-sessio';
$string['invalidurl'] = 'Virheellinen web-osoite määritelty';
$string['last'] = 'Viimeksi';
$string['lastaccess'] = 'Viimeisin käynti';
$string['lastattempt'] = 'Viimeisin suorituskerta';
$string['lastattemptlock'] = 'Lukitse viimeisen suorituskerran jälkeen';
$string['lastattemptlock_help'] = 'Jos käytössä, opiskelija ei voi käynnistää SCORM-soitinta käytettyään kaikki sallitut suorituskerrat.';
$string['lastattemptlockdesc'] = 'Tämä asetus määrittelee oletuksen \'Lukitse viimeisen suorituskerran jälkeen\' -asetukselle';
$string['location'] = 'Näytä sijaintirivi';
$string['max'] = 'Maksimitulos';
$string['maximumattempts'] = 'Suorituskertojen määrä';
$string['maximumattempts_help'] = 'Tällä asetuksella voit rajoittaa suorituskertoja. Asetus toimii vain SCORM 1.2 ja AICC -paketeissa.';
$string['maximumattemptsdesc'] = 'Tämä asetus määrittelee oletuksen aktiviteetin maksimi yrityskerroille';
$string['maximumgradedesc'] = 'Tämä asetus määrittelee oletuksen aktiviteetin yläarvosanalle';
$string['menubar'] = 'Näytä valikkorivi';
$string['min'] = 'Minimitulos';
$string['missing_attribute'] = 'Puuttuva attribuutti ({$a->attr}) merkinnässä  {$a->tag}';
$string['missing_tag'] = 'Puuttuva merkintä {$a->tag}';
$string['missingparam'] = 'Vaadittu puuttuu tai on väärä';
$string['mode'] = 'Muoto';
$string['modulename'] = 'SCORM-paketti';
$string['modulename_help'] = 'SCORM ja AICC ovat määrittelyiden kokoelma, joka mahdollistaa verkkopohjaisen oppimateriaalin uudelleenkäytön ja toimivuuden eri järjestelmissä. SCORM/AICC-moduuli mahdollistaa SCORM/AICC-pakettien lisäämisen kurssille.';
$string['modulenameplural'] = 'SCORM-paketit';
$string['navigation'] = 'Navigaatio';
$string['newattempt'] = 'Aloita uusi suorituskerta';
$string['next'] = 'Jatka';
$string['no_attributes'] = 'Merkinnällä {$a->tag} pitää olla attribuutit';
$string['no_children'] = 'Merkinnällä {$a->tag} pitää olla lapsi';
$string['noactivity'] = 'Ei mitään raportoitavaa';
$string['noattemptsallowed'] = 'Sallittujen suorituskertojen määrä';
$string['noattemptsmade'] = 'Suorituskertojesi määrä';
$string['nolimit'] = 'Rajoittamattomasti suorituskertoja';
$string['nomanifest'] = 'Manifestia ei löydy';
$string['noprerequisites'] = 'Valitettavasti et ole suorittanut tarpeeksi päästäksesi tähän oppimisobjektiin';
$string['noreports'] = 'Ei raporttia näytettäväksi';
$string['normal'] = 'Normaali';
$string['noscriptnoscorm'] = 'Selaimesi ei tue javascriptiä tai tuki on pois päältä. SCORM-pakettia ei välttämättä voi toistaa eikä tietoja tallenneta.';
$string['not_corr_type'] = 'Tyyppivirhe merkinnässä {$a->tag}';
$string['notattempted'] = 'Ei yritetty';
$string['notopenyet'] = 'Valitettavasti aktiviteetti aukeaa {$a}';
$string['objectives'] = 'Tavoitteet';
$string['optallstudents'] = 'kaikki käyttäjät';
$string['optattemptsonly'] = 'vain käyttäjät, joilla suorituskertoja';
$string['options'] = 'Valinnat (estetty joiltakin selaimilta)';
$string['optionsadv'] = 'Valinnat (edistyneet)';
$string['optnoattemptsonly'] = 'vain käyttäjät, joilla ei ole yhtään suorituskertaa';
$string['organization'] = 'Organisaatio';
$string['organizations'] = 'Organisaatiot';
$string['othersettings'] = 'Lisäasetukset';
$string['othertracks'] = 'Muut seurannat';
$string['package'] = 'Tiedostopaketti';
$string['package_help'] = 'Tämä tiedostopaketti on zip (tai pif) -tiedosto, jossa on SCORM/AICC curssin määrittelytiedostot.';
$string['packagedir'] = 'Tiedoston luontivirhe: paketin hakemistoa ei voi luoda';
$string['packagefile'] = 'Pakettitiedostoa ei määritetty';
$string['packageurl'] = 'Web-osoite';
$string['packageurl_help'] = 'Tämä asetus sallii web-osoitteen määrittelyn SCORM-paketteihin, tiedoston valitsemisen sijasta.';
$string['page-mod-scorm-x'] = 'Kaikki SCORM-moduulisivut';
$string['pagesize'] = 'Sivun koko';
$string['passed'] = 'Hyväksytty';
$string['php5'] = 'PHP 5 (oma DOMXML -kirjasto)';
$string['pluginadministration'] = 'SCORM/AICC -hallinto';
$string['pluginname'] = 'SCORM-paketti';
$string['popup'] = 'Uusi ikkuna';
$string['popupmenu'] = 'Pudotusvalikossa';
$string['popupopen'] = 'Avaa paketti uudessa ikkunassa';
$string['popupsblocked'] = 'Scorm-moduuli ei käynnisty, koska ponnahdusikkunat on ilmeisesti estetty. Tarkista selaimesi asetukset ennen uutta yritystä.';
$string['position_error'] = 'Merkintä {$a->tag} ei voi olla merkinnän {$a->parent} lapsi.';
$string['preferencespage'] = 'Tämän sivun asetukset';
$string['preferencesuser'] = 'Tämän raportin asetukset';
$string['prev'] = 'Edellinen';
$string['raw'] = 'Perus pisteet';
$string['regular'] = 'Tavallinen manifesti';
$string['report'] = 'Raportti';
$string['reportcountallattempts'] = '{$a->nbattempts} suorituskertaa käyttäjällä {$a->nbusers}, tuloksesta {$a->nbresults}';
$string['reportcountattempts'] = '{$a->nbresults} tulosta ({$a->nbusers} käyttäjää)';
$string['reports'] = 'Raportit';
$string['resizable'] = 'Salli ikkunan koon muuttaminen';
$string['result'] = 'Tulos';
$string['results'] = 'Tulokset';
$string['review'] = 'Esikatsele';
$string['reviewmode'] = 'Esikatselutila';
$string['scoes'] = 'Sisältöobjektit';
$string['score'] = 'Tulos';
$string['scorm:deleteownresponses'] = 'Poista omat suoritukset';
$string['scorm:deleteresponses'] = 'Poista SCORM-suoritukset';
$string['scorm:savetrack'] = 'Jälkien tallennus';
$string['scorm:skipview'] = 'Ohita yhteenveto';
$string['scorm:viewreport'] = 'Raporttien katselu';
$string['scorm:viewscores'] = 'Tulosten katselu';
$string['scormclose'] = 'Kunnes';
$string['scormcourse'] = 'SCORM-kurssi';
$string['scormloggingoff'] = 'API-loggaus pois päältä';
$string['scormloggingon'] = 'API-loggaus päällä';
$string['scormopen'] = 'Auki';
$string['scormresponsedeleted'] = 'Poistettiin käyttäjän suorituskerrat';
$string['scormtype'] = 'Tyyppi';
$string['scormtype_help'] = 'Tämä asetus määrittelee, miten SCORM-paketti liitetään kurssialueelle. Tähän on jopa neljä eri vaihtoehtoa:
* Ladattu paketti: voit valita SCORM-paketin tiedostonvalitsimesta
* Ulkoinen SCORM-manifesti: voit määritellä imsmanifest.xml-tiedoston osoitteen. HUOM: jos osoite on muualla kuin omalla palvelimellasi, seuraava "Ladattava paketti" -vaihtoehto on parempi, koska muuten arvosanoja ei tallenneta.
* Ladattava paketti: voit määritellä sen verkko-osoitteen, josta paketti ladataan. Paketti puretaan ja tallennetaan paikallisesti, ja päivitettään automaattisesti aina kun ulkoinen SCORM-paketti päivittyy.
* Paikallinen IMS-sisältörepositorio: paketin voi valita IMS-repositoriosta
* Ulkoinen AICC: valittu verkko-osoite on aloitussivu yksittäiselle AICC-aktiviteetille. Tätä varten tehdään pseudo-paketti Moodleen.';
$string['scrollbars'] = 'Salli ikkunan vieritys';
$string['selectall'] = 'Valitse kaikki';
$string['selectnone'] = 'Poista kaikki valinnat';
$string['show'] = 'Näytä';
$string['sided'] = 'Reunassa';
$string['skipview'] = 'Opiskelija ohittaa sisältörakenne sivun';
$string['skipview_help'] = 'Tämä asetus määrittelee, pitäisikö sisältörakennesivua koskaan ohittaa (jättää näyttämättä). Jos paketissa on vain yksi oppimiskohde, sisältörakennesivu voidaan aina ohittaa.';
$string['skipviewdesc'] = 'Tämä asetus määrittelee oletuksen, koska ohittaa sivun sisältörakenne';
$string['slashargs'] = 'VAROITUS: kauttaviiva-argumentit on estetty tällä sivustolla eivätkä objektit ehkä toimi odotetulla tavalla!';
$string['stagesize'] = 'Kehyksen/ikkunan koko';
$string['stagesize_help'] = 'Nämä kaksi asetusta määrittävät kehyksen/ikkunan leveyden ja korkeuden oppimiskohteille.';
$string['started'] = 'Aloitettu';
$string['status'] = 'Tila';
$string['statusbar'] = 'Näytä tilarivi';
$string['student_response'] = 'Vastaus';
$string['subplugintype_scormreport'] = 'Raportti';
$string['subplugintype_scormreport_plural'] = 'Raportit';
$string['suspended'] = 'Keskytetty';
$string['syntax'] = 'Muotovirhe';
$string['tag_error'] = 'Tuntematon merkintä ({$a->tag}) sisällössä: {$a->value}';
$string['time'] = 'Aika';
$string['timerestrict'] = 'Rajoita vastaukset tälle aikavälille';
$string['title'] = 'Otsikko';
$string['toc'] = 'sisällysluettelo';
$string['too_many_attributes'] = 'Merkinnällä {$a->tag} on liikaa attribuutteja';
$string['too_many_children'] = 'Merkinnällä {$a->tag} on liikaa lapsia';
$string['toolbar'] = 'Näytä työkalurivi';
$string['totaltime'] = 'Aika';
$string['trackingloose'] = 'VAROITUS: Tämän SCORM-paketin seurantatiedot menetetään!';
$string['type'] = 'Tyyppi';
$string['typeaiccurl'] = 'Ulkoinen AICC-osoite';
$string['typeexternal'] = 'Ulkoinen SCORM-luettelo';
$string['typeimsrepository'] = 'Paikallinen IMS-sisällön repository';
$string['typelocal'] = 'Palveluun ladattu paketti';
$string['typelocalsync'] = 'Ladattu paketti';
$string['unziperror'] = 'Paketin purkamisessa tapahtui virhe';
$string['updatefreq'] = 'Automaattinen päivitys frekvenssi';
$string['updatefreq_help'] = 'Tällä asetuksella aktivoit ulkoisen tiedostopaketin automaattisen latauksen ja päivityksen.';
$string['updatefreqdesc'] = 'Tämä asetus määrittää aktiviteetin automaattisen päivityksen oletustiheyden';
$string['validateascorm'] = 'Tarkista SCORM-paketti';
$string['validation'] = 'Tarkistuksen tulos';
$string['validationtype'] = 'Valitse DOMXML-kirjasto jota käytetään SCORM-manifestin tarkistamiseen. Älä muuta asetusta, jos et ole varma mitä teet.';
$string['value'] = 'Arvo';
$string['versionwarning'] = 'Manifestin versio on vanhempi kuin 1.3, varoitus merkinnästä {$a->tag}.';
$string['viewallreports'] = 'Näytä raportit {$a} suorituskerrasta';
$string['viewalluserreports'] = 'Näytä raportit {$a} käyttäjistä';
$string['whatgrade'] = 'Arvioidut suorituskerrat';
$string['whatgrade_help'] = 'Jos olet sallinut useita suorituskertoja, tämä asetus määrittelee, tallennetaanko arviointikirjaan suoritusten arvosanoista korkein, keskiarvo, ensimmäinen vai viimeinen.
Useiden suorituskertojen käsittely
* mahdollisuus uuden suorituskerran aloittamiseen tarjotaan osallistujalle valintaruutuna sisällön rakenne -sivulla, joten tarkista, että opiskelijoille on pääsy tuolle sivulle, jos haluat sallia useamman kuin yhden suorituskerran.
* Joissain SCORM-paketeissa on valmiudet peräkkäisten suorituskertojen käsittelyyn, mutta monissa ei ole. Tämä tarkoittaa, että jos osallistuja palaa jo tallennettuun suorituskertaan ja SCORM-sisällössä ei ole sisäistä käsittelyä aiempien suorituskertojen päällekirjoittamisen estämiseksi, aiempi suorituskerta voi tästä johtuen tuhoutua päällekirjoitettuna, vaikka se olisikin tallennettu "valmiina" tai "suoritettuna".
* Asetuksissa "pakota suoritetuksi", "pakota uusi suorituskerta" ja "lukitse viimeisen suorituskerran jälkeen" on lisää useiden suorituskertojen säätömahdollisuuksia.';
$string['whatgradedesc'] = 'Tämä asetus määrittää arvioitavan suorituskerran oletusarvon';
$string['width'] = 'Leveys';
$string['window'] = 'Ikkuna';
