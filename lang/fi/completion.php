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
 * Strings for component 'completion', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   completion
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['achievinggrade'] = 'Saavutetaan arvosana';
$string['activities'] = 'Aktiviteetit';
$string['activitiescompleted'] = 'Suoritetut aktiviteetit';
$string['activitycompletion'] = 'Aktiviteettien suoritus';
$string['activityrpl'] = 'Aktiviteetit/aiemman suorituksen hyväksilukeminen';
$string['addcourseprerequisite'] = 'Lisää kurssin esitietovaatimus';
$string['afterspecifieddate'] = 'Määritellyn päivän jälkeen';
$string['aggregateall'] = 'Kaikki';
$string['aggregateany'] = 'Mikä tahansa';
$string['aggregationmethod'] = 'Yhdistämismenetelmä';
$string['all'] = 'Kaikki';
$string['any'] = 'Mikä tahansa';
$string['approval'] = 'Hyväksyminen';
$string['badautocompletion'] = 'Kun valitset automaattisen suorituksen, sinun pitää sallia myös vähintään yksi vaatimus (alapuolelta).';
$string['complete'] = 'Valmis';
$string['completed'] = 'Suoritettu';
$string['completedunlocked'] = 'Suoritusvalintojen lukitus poistettu';
$string['completedunlockedtext'] = 'Kun tallennat muutokset, kaikkien käyttäjien suoritusten tila poistetaan. Jos muutat mieltäsi, älä tallenna.';
$string['completedwarning'] = 'Suoritusvalinnat lukittu';
$string['completedwarningtext'] = 'Yksi tai useampi opiskelija ({$a}) on jo merkinnyt tämän aktiviteetin suoritetuksi. Suoritusasetusten muuttaminen poistaa opiskelijoiden suoritusten tilan ja saattaa aiheuttaa hämmennystä. Siksi asetukset on lukittu, eikä niitä pitäisi avata, jollei se ole ehdottoman välttämätöntä.';
$string['completeviarpl'] = 'Suorita hyväksyttämällä aiempi suoritus';
$string['completion'] = 'Suoritusten seuranta';
$string['completion-alt-auto-enabled'] = 'Järjestelmä merkitsee kohteen suoritetuksi määritellyin ehdoin';
$string['completion-alt-auto-fail'] = 'Suoritettu (ei saavutettu hyväksyttyä arvosanaa)';
$string['completion-alt-auto-n'] = 'Suorittamatta: {$a}';
$string['completion-alt-auto-pass'] = 'Suoritettu (hyväksytty arvosana)';
$string['completion-alt-auto-y'] = 'Suoritettu: {$a}';
$string['completion-alt-manual-enabled'] = 'Opiskelijat voivat manuaalisesti merkitä tämän kohteen suoritetuksi';
$string['completion-alt-manual-n'] = 'Ei suoritettu: {$a}. Valitse merkitäksesi suoritetuksi.';
$string['completion-alt-manual-y'] = 'Suoritettu: {$a}. Valitse merkitäksesi keskeneräiseksi.';
$string['completion-title-manual-n'] = 'Merkitse suoritetuksi: {$a}';
$string['completion-title-manual-y'] = 'Merkitse suorittamattomaksi: {$a}';
$string['completion_automatic'] = 'Näytä aktiviteetti suoritetuksi kun ehdot täyttyvät';
$string['completion_help'] = 'Jos sallittu, aktiviteettien suorituksia seurataan joko manuaalisesti tai automaattisesti, perustuen tiettyihin ehtoihin. Haluttaessa voidaan asettaa myös useita ehtoja. Jos useita ehtoja on asetettu, aktiviteetti on suoritettu vasta kun KAIKKI ehdot täyttyvät.
Valintaruutu aktiviteetin nimen vieressä kurssisivulla näyttää milloin aktiviteetti on suoritettu.';
$string['completion_manual'] = 'Opiskelijat voivat manuaalisesti merkitä tämän aktiviteetin suoritetuksi';
$string['completion_none'] = 'Älä huomioi aktiivisuuden suorituksia';
$string['completiondisabled'] = 'Poistettu käytöstä, ei näytetä aktiviteetin asetuksissa';
$string['completionenabled'] = 'Käytössä, hallinta suoritus- ja aktiivisuusasetusten kautta';
$string['completionexpected'] = 'Odotettu suoritusaika';
$string['completionexpected_help'] = 'Tämä asetus määrittää päivämäärän, jolloin aktiviteetti pitäisi olla suoritettu. Päivämäärää ei näytetä opiskelijoille ja se on näkyvissä ainoastaan aktiviteettien suoritusraportissa.';
$string['completionicons'] = 'Suoritusten valintalaatikot';
$string['completionicons_help'] = 'Valintaruutua aktiviteetin nimen vieressä voidaan käyttää ilmaisemaan milloin aktiviteetti on suoritettu.
Jos valintaruudun merkintä näytetään katkoviivalla, voit klikata sitä kun olet mielestäsi suorittanut aktiviteetin. (Uudelleenklikkaaminen poistaa valinnan jos muutat mielesi.) Valintaruudun merkkaaminen on vapaavalintaista ja ainoastaan tapa seurata edistymistä kurssilla.
Jos valintaruutu on tyhjä, merkintä ilmestyy automaattisesti kun olet suorittanut aktiviteetin opettajan asettamien ehtojen mukaan.';
$string['completionmenuitem'] = 'Suoritus';
$string['completionnotenabled'] = 'Suorituksia ei ole käytössä';
$string['completionnotenabledforcourse'] = 'Suorituksia ei seurata tällä kurssilla';
$string['completionnotenabledforsite'] = 'Suorituksia ei seurata tällä sivustolla';
$string['completiononunenrolment'] = 'Suoritus peruttaessa ilmoittautuminen';
$string['completionsettingslocked'] = 'Suoritusasetukset lukittu';
$string['completionstartonenrol'] = 'Suoritusten seuranta alkaa ilmoittautumisvaiheessa';
$string['completionstartonenrolhelp'] = 'Aloita opiskelijan suoritusten seuranta ilmoittautumisen jälkeen';
$string['completionusegrade'] = 'Vaadi arvosana';
$string['completionusegrade_desc'] = 'Opiskelijan on saatava arvosana saadakseen suoritusmerkinnän aktiviteetista';
$string['completionusegrade_help'] = 'Jos käytössä, tämä aktiviteetti katsotaan suoritetuksi kun opiskelija saa siitä arvosanan. Suoritettu ja hylätty -kuvakkeet näytetään jos hyväksytty arvosana on asetettu aktiviteetille.';
$string['completionview'] = 'Vaadi avaaminen';
$string['completionview_desc'] = 'Opiskelijan pitää avata aktiviteetti saadakseen suoritusmerkinnän';
$string['configenablecompletion'] = 'Jos käytössä, voit ottaa suoritusten seurannan (edistymisen) käyttöön kurssilla.';
$string['configenablecourserpl'] = 'Salli kurssin merkitseminen suoritetuksi luomalla aiemman oppimisen hyväksilukemisrekisteri.';
$string['configenablemodulerpl'] = 'Salli moduulin minkä tahansa suorittamiskriteerin merkitseminen suoritetuksi luomalla aiemman oppimisen hyväksilukemisrekisteri.';
$string['confirmselfcompletion'] = 'Vahvista omaehtoinen suorittaminen';
$string['coursealreadycompleted'] = 'Olet jo suorittanut tämän kurssin';
$string['coursecomplete'] = 'Kurssi suoritettu';
$string['coursecompleted'] = 'Kurssi suoritettu';
$string['coursegrade'] = 'Kurssin arvosana';
$string['courseprerequisites'] = 'Kurssin esitietovaatimukset';
$string['courserpl'] = 'Kurssin korvaaminen aiemmalla suorituksella';
$string['courserplorallcriteriagroups'] = 'Korvaava suoritus kurssille tai <br />\nkaikille vaatimusryhmille';
$string['courserploranycriteriagroup'] = 'Korvaava suoritus kurssille tai <br />\nmille tahansa vaatimusryhmälle';
$string['coursesavailable'] = 'Saatavilla olevat kurssit';
$string['coursesavailableexplaination'] = '<i>Kurssin suorituskriteerit pitää määritellä kurssille jotta se  näytetään tällä listalla</i>';
$string['criteria'] = 'Kriteeri';
$string['criteriagroup'] = 'Kriteeriryhmä';
$string['criteriarequiredall'] = 'Kaikki alla olevat kriteerit vaaditaan';
$string['criteriarequiredany'] = 'Jokin alla olevista kriteereistä vaaditaan';
$string['csvdownload'] = 'Lataa laskentataulukko-muodossa (UTF-8 .csv)';
$string['datepassed'] = 'Suorituspäivämäärä';
$string['days'] = 'Päivää';
$string['daysafterenrolment'] = 'Päivää ilmoittautumisen jälkeen';
$string['deletecoursecompletiondata'] = 'Poista kurssin suoritustiedot';
$string['deletedcourse'] = 'Poistettu kurssi';
$string['dependencies'] = 'Riippuvuudet';
$string['dependenciescompleted'] = 'Suoritetut riippuvuudet';
$string['durationafterenrolment'] = 'Kesto ilmoittautumisen jälkeen';
$string['editcoursecompletionsettings'] = 'Muokkaa kurssin suoritusasetuksia';
$string['enablecompletion'] = 'Ota käyttöön suoritusten seuranta';
$string['enablecourserpl'] = 'Salli kursseille aiemman oppimisen hyväksilukeminen';
$string['enablemodulerpl'] = 'Salli moduuleille aiemman oppimisen hyväksilukeminen';
$string['enrolmentduration'] = 'Päivää jäljellä';
$string['err_noactivities'] = 'Suoritustietoja ei ole sallittu millekään aktiviteetille, joten mitään ei voida näyttää. Voit sallia suoritustiedot muokkaamalla aktiviteetin asetuksia.';
$string['err_nocourses'] = 'Kurssisuoritusten seurantaa ei ole sallittu millekään muille kursseille, joten mitään ei voida näyttää. Voit sallia kurssisuoritusten seurannan kurssin asetuksista.';
$string['err_nocriteria'] = 'Tälle kurssille ei ole määritelty yhtään suoritusvaatimusta';
$string['err_nograde'] = 'Tälle kurssille ei ole asetettu kurssin läpäisyn arvosanaa. Salliaksesi tämän kriteerityypin, sinun täytyy luoda läpäisyn arvosana tälle kurssille.';
$string['err_noroles'] = 'Tällä kurssilla ei ole rooleja, joilla olisi kyky \'moodle/course:markcomplete\'. Voit sallia tämän kriteerityypin lisäämällä tämä kyky rooliin/rooleihin.';
$string['err_nousers'] = 'Tällä kurssilla tai tässä ryhmässä ei ole opiskelijoita, joille näytettäisiin suoritustiedot. (Oletuksena suoritustiedot näytetään vain opiskelijoille, joten näet tämän virheen, jos opiskelijoita ei ole. Ylläpitäjät voivat muokata tätä asetusta ylläpitonäyttöjen kautta.)';
$string['err_settingslocked'] = 'Yksi tai useampi opiskelija on jo suorittanut kriteerin, joten asetukset on lukittu. Suorituskriteeriasetusten avaaminen poistaa kaiken olemassa olevan käyttäjätiedon ja saattaa aiheuttaa hämmennystä.';
$string['err_system'] = 'Suoritusjärjestelmässä tapahtui sisäinen virhe. (Järjestelmän ylläpitäjät voivat sallia virheenjäljitystiedot, nähdäkseen yksityiskohtaisempaa tietoa.)';
$string['error:rplsaredisabled'] = 'Hallinnoija on poistanut käytöstä rekisterin aiemman oppimisen hyväksilukemisesta';
$string['excelcsvdownload'] = 'Lataa Excel-yhteensopivassa muodossa (.csv)';
$string['fraction'] = 'Murtoluku';
$string['inprogress'] = 'Kesken';
$string['manualcompletionby'] = 'Manuaalinen suoritusmerkintä henkilöltä';
$string['manualselfcompletion'] = 'Manuaalinen omaehtoinen suoritus';
$string['markcomplete'] = 'Merkitse suoritetuksi';
$string['markedcompleteby'] = 'Merkinnyt suoritetuksi: {$a}';
$string['markingyourselfcomplete'] = 'Merkitset itsellesi suoritetuksi';
$string['moredetails'] = 'Lisätietoja';
$string['nocriteriaset'] = 'Ei suoritusehtoja määritelty tälle kurssille';
$string['notcompleted'] = 'Keskeneräinen';
$string['notenroled'] = 'Et ole ilmoittautuneena kurssille';
$string['notyetstarted'] = 'Ei vielä aloitettu';
$string['overallcriteriaaggregation'] = 'Kokonaiskriteerien koostamisen tyyppi';
$string['pending'] = 'Odottaa';
$string['periodpostenrolment'] = 'Esi-ilmoittautumisen ajanjakso';
$string['prerequisites'] = 'Esitietovaatimukset';
$string['prerequisitescompleted'] = 'Esitietovaatimukset saavutettu';
$string['progress'] = 'Opiskelijan edistyminen';
$string['progress-title'] = '{$a->user}, {$a->activity}: {$a->state} {$a->date}';
$string['recognitionofpriorlearning'] = 'Aiemman oppimisen tunnistaminen';
$string['remainingenroledfortime'] = 'Ilmoittautuminen voimassa määritellyn ajanjakson';
$string['remainingenroleduntildate'] = 'Ilmoittautuminen astuu voimaan määriteltynä päivänä';
$string['reportpage'] = 'Näytetään käyttäjät {$a->from} - {$a->to} / {$a->total}.';
$string['requiredcriteria'] = 'Vaaditut kriteerit';
$string['restoringcompletiondata'] = 'Kirjoittaa suoritustietoja';
$string['rpl'] = 'Korvaava suoritus';
$string['saved'] = 'Tallennettu';
$string['seedetails'] = 'Näytä yksityiskohdat';
$string['self'] = 'Itse';
$string['selfcompletion'] = 'Omaehtoinen suoritus';
$string['showinguser'] = 'Näkyy käyttäjälle';
$string['showrpl'] = 'Näytä korvaava suoritus';
$string['showrpls'] = 'Näytä korvaavat suoritukset';
$string['unenrolingfromcourse'] = 'Peru kurssin ilmoittautuminen';
$string['unenrolment'] = 'Ilmoittautumisen peruminen';
$string['unit'] = 'Yksikkö';
$string['unlockcompletion'] = 'Poista lukitus suoritusvalinnoista';
$string['unlockcompletiondelete'] = 'Poista lukitus suoritusvalinnoista ja poista suoritustiedot';
$string['usealternateselector'] = 'Käytä vaihtoehtoista kurssin valintaa';
$string['usernotenroled'] = 'Käyttäjä ei ole ilmoittautunut kurssille';
$string['viewcoursereport'] = 'Näytä kurssin raportti';
$string['viewingactivity'] = 'Näytetään {$a}';
$string['writingcompletiondata'] = 'Kirjoittaa suoritustietoja';
$string['xdays'] = '{$a} päivää';
$string['yourprogress'] = 'Oma edistymiseni';
