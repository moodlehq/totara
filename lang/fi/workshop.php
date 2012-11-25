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
 * Strings for component 'workshop', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   workshop
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Pääsynvalvonta';
$string['aggregategrades'] = 'Laske arvosanat uudestaan';
$string['aggregation'] = 'Arvosanojen kooste';
$string['allocate'] = 'Jaa palautteenantovuorot';
$string['allocatedetails'] = 'odotettavissa: {$a->expected}<br />palautettu: {$a->submitted}<br />jaettavana: {$a->allocate}';
$string['allocation'] = 'Palautevuorojen jakaminen';
$string['allocationdone'] = 'Palautevuorojen jako on valmis';
$string['allocationerror'] = 'Virhe palautevuorojen jaossa';
$string['allsubmissions'] = 'Kaikki palautukset';
$string['alreadygraded'] = 'Arvioitu';
$string['areainstructauthors'] = 'Ohjeet työn palautukselle';
$string['areainstructreviewers'] = 'Arviointiohjeet';
$string['areasubmissionattachment'] = 'Palautuksen liitteet';
$string['areasubmissioncontent'] = 'Palautustekstit';
$string['assess'] = 'Arvioi';
$string['assessedexample'] = 'Arvioidut esimerkkipalautukset';
$string['assessedsubmission'] = 'Arvioitu palautus';
$string['assessingexample'] = 'Arvioidaan esimerkkipalautuksia';
$string['assessingsubmission'] = 'Arvioidaan palautusta';
$string['assessment'] = 'Arviointi';
$string['assessmentby'] = 'palaute käyttäjältä <a href="{$a->url}">{$a->name}</a>';
$string['assessmentbyfullname'] = 'Arvioinnin tehnyt {$a}';
$string['assessmentbyyourself'] = 'Arviointisi';
$string['assessmentdeleted'] = 'Palautteenantovuoro poistettu';
$string['assessmentend'] = 'Arviointiaika loppuu';
$string['assessmentenddatetime'] = 'Arviointiaika loppuu: {$a->daydatetime} ({$a->distanceday})';
$string['assessmentendevent'] = '{$a} (arviointiaika loppuu)';
$string['assessmentform'] = 'Arviointimatriisi';
$string['assessmentofsubmission'] = '<a href="{$a->assessmenturl}">Arviointi</a> palautukselle <a href="{$a->submissionurl}">{$a->submissiontitle}</a>';
$string['assessmentreference'] = 'Mallivastaus';
$string['assessmentreferenceconflict'] = 'Esimerkkipalautusta, johon olet tehnyt mallivastauksen, ei voi harjoitusarvioida.';
$string['assessmentreferenceneeded'] = 'Tee mallivastaus arvioimalla tämä esimerkkipalautus. Klikkaa sitä varten \'Jatka\' -painiketta.';
$string['assessmentsettings'] = 'Arviointiasetukset';
$string['assessmentstart'] = 'Arvioitavissa alkaen';
$string['assessmentstartdatetime'] = 'Arvioitavissa alkaen {$a->daydatetime} ({$a->distanceday})';
$string['assessmentstartevent'] = '{$a} (vertaisarviointi aukeaa)';
$string['assessmentweight'] = 'Arvioinnin painotus';
$string['assignedassessments'] = 'Vertaisarvioitavaksi annetut palautukset';
$string['assignedassessmentsnone'] = 'Sinulle ei ole annettu vertaisarviointeja';
$string['backtoeditform'] = 'Palaa muokkaamaan lomaketta';
$string['byfullname'] = 'käyttäjältä <a href="{$a->url}">{$a->name}</a>';
$string['calculategradinggrades'] = 'Laske vertaispalautteiden arvosanat';
$string['calculategradinggradesdetails'] = 'odotettavissa: {$a->expected}<br />laskettu: {$a->calculated}';
$string['calculatesubmissiongrades'] = 'Laske palautettujen tehtävien arvosanat';
$string['calculatesubmissiongradesdetails'] = 'odotettavissa: {$a->expected}<br />laskettu: {$a->calculated}';
$string['chooseuser'] = 'Valitse käyttäjä...';
$string['clearaggregatedgrades'] = 'Poista arvosanakoosteet';
$string['clearaggregatedgrades_help'] = 'Palautettujen tehtävien arvosanakoosteet ja vertaispalautteiden arvosanat nollataan. Voit laskea ne uudestaan Palautteiden arviointivaiheessa.';
$string['clearaggregatedgradesconfirm'] = 'Haluatko poistaa jo lasketut arvosanat palautetuille tehtäville ja vertaispalautteiden arvosanat?';
$string['clearassessments'] = 'Poista palautteet';
$string['clearassessments_help'] = 'Palautettujen tehtävien arvosanakoosteet ja vertaispalautteiden arvosanat nollataan. Arviointimatriisin täyttöohjeet säilytetään, mutta arvioijien täytyy avata ja tallentaa arviointilomake uudelleen, jotta annetut arvosanat voidaan laskea.';
$string['clearassessmentsconfirm'] = 'Haluatko poistaa kaikki palautteet ja arvosanat? Et voi palauttaa tietoja itse vaan vertaisarvioijien täytyy antaa uudet palautteet.';
$string['configexamplesmode'] = 'Oletusmoodi esimerkkien arvioinneille työpajoissa';
$string['configgrade'] = 'Arvosanan oletusyläraja palautuksille työpajoissa';
$string['configgradedecimals'] = 'Desimaalien oletusmäärä näytettäessä arvosanat';
$string['configgradinggrade'] = 'Arvosanan oletusyläraja arvioinneille työpajoissa';
$string['configmaxbytes'] = 'Tiedostokokojen oletusyläraja kaikissa sivuston työpajoissa (riippuu myös kurssirajoista sekä muista paikallisista asetuksista)';
$string['configstrategy'] = 'Työpajan oletusarviointitapa';
$string['createsubmission'] = 'Palauta';
$string['daysago'] = '{$a} päivää sitten';
$string['daysleft'] = '{$a} päivää jäljellä';
$string['daystoday'] = 'tänään';
$string['daystomorrow'] = 'huomenna';
$string['daysyesterday'] = 'eilen';
$string['deadlinesignored'] = 'Aikarajoitukset eivät koske sinua';
$string['editassessmentform'] = 'Muokkaa arviointimatriisia';
$string['editassessmentformstrategy'] = 'Muokkaa arviointilomaketta ({$a})';
$string['editingassessmentform'] = 'Muokataan arviointimatriisia';
$string['editingsubmission'] = 'Muokataan palautusta';
$string['editsubmission'] = 'Muokkaa palautusta';
$string['err_multiplesubmissions'] = 'Toinen palautusversio on tallennettu sillä aikaa kun muokkasit tätä lomaketta. Et voi palauttaa useita versioita.';
$string['err_removegrademappings'] = 'Ei voida poistaa käyttämättömiä arvosanalinkityksiä';
$string['evaluategradeswait'] = 'Odota kunnes vertaispalautteet on annettu ja arvosanat laskettu';
$string['evaluation'] = 'Palautteiden arviointi';
$string['evaluationmethod'] = 'Palautteiden arviointitapa';
$string['evaluationmethod_help'] = 'Palautteiden arviointitapa määrittelee, kuinka annettujen vertaispalautteiden arvosana lasketaan. Toistaiseksi on vain yksi vaihtoehto: vertailu vertaisarviointien keskiarvoon.
HUOMAA: jos vertaisarvioijia on kaksi ja he ovat antaneet eri arvosanat, kummankaan antama arvosana ei voi olla keskiarvo. Tämä kompensoidaan antamalla kummallekin arvioijalle joka tapauksessa täydet vertaisarviointipisteet. Tämän korjaamiseksi voit antaa itse kolmannen arvioinnin tai vahvistaa jommankumman vertaisarvioinnin painotusta. Lisätietoja löydät ohjeesta http://docs.moodle.org/22/en/Using_Workshop';
$string['example'] = 'Esimerkkipalautus';
$string['exampleadd'] = 'Lisää esimerkkipalautus';
$string['exampleassess'] = 'Arvioi esimerkkipalautus';
$string['exampleassessments'] = 'Arvioitavat esimerkkipalautukset';
$string['exampleassesstask'] = 'Arvioi esimerkit';
$string['exampleassesstaskdetails'] = 'odotettavissa: {$a->expected}<br />arvioitu: {$a->assessed}';
$string['examplecomparing'] = 'Verrataan esimerkkipalautusten arviointeja';
$string['exampledelete'] = 'Poista esimerkki';
$string['exampledeleteconfirm'] = 'Haluatko poistaa seuraavan esimerkkipalautuksen? Klikkaa \'Jatka\' -painiketta poistaaksesi palautuksen.';
$string['exampleedit'] = 'Muokkaa esimerkkiä';
$string['exampleediting'] = 'Muokataan esimerkkiä';
$string['exampleneedassessed'] = 'Anna ensin palautetta kaikkiin esimerkkitehtäviin';
$string['exampleneedsubmission'] = 'Palauta ensin työsi ja harjoittele palautteenantoa esimerkkitehtävissä';
$string['examplesbeforeassessment'] = 'Esimerkit ovat käytettävissä oman palautuksen jälkeen ja ne täytyy arvioida ennen vertaisarviointia';
$string['examplesbeforesubmission'] = 'Esimerkit täytyy arvioida ennen omaa palautusta';
$string['examplesmode'] = 'Esimerkkien arvioinnin moodi';
$string['examplesubmissions'] = 'Esimerkkipalautukset';
$string['examplesvoluntary'] = 'Esimerkkipalautusten arviointi on vapaaehtoista';
$string['feedbackauthor'] = 'Palaute tekijälle';
$string['feedbackby'] = 'Palautteen antoi {$a}';
$string['feedbackreviewer'] = 'Palaute arvioijalle';
$string['formataggregatedgrade'] = '{$a->grade}';
$string['formataggregatedgradeover'] = '<del>{$a->grade}</del><br /><ins>{$a->over}</ins>';
$string['formatpeergrade'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span>';
$string['formatpeergradeover'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span>';
$string['formatpeergradeoverweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">(<del>{$a->gradinggrade}</del> / <ins>{$a->gradinggradeover}</ins>)</span> @ <span class="weight">{$a->weight}</span>';
$string['formatpeergradeweighted'] = '<span class="grade">{$a->grade}</span> <span class="gradinggrade">({$a->gradinggrade})</span> @ <span class="weight">{$a->weight}</span>';
$string['givengrades'] = 'Osallistujan antamat vertaisarviot';
$string['gradecalculated'] = 'Palautuksen laskettu arvosana';
$string['gradedecimals'] = 'Desimaalien määrä arvosanoissa';
$string['gradegivento'] = '&gt;';
$string['gradeinfo'] = 'Arvosana: {$a->received} / {$a->max}';
$string['gradeitemassessment'] = '{$a->workshopname} (arviointi)';
$string['gradeitemsubmission'] = '{$a->workshopname} (palautus)';
$string['gradeover'] = 'Korvaa palautuksen arvosana';
$string['gradereceivedfrom'] = '&lt;';
$string['gradesreport'] = 'Työpajan arvosanaraportti';
$string['gradinggrade'] = 'Vertaisarvioinnin arvosana';
$string['gradinggrade_help'] = 'Tämä asetus määrittää vertaisarvioinnin korkeimman arvosanan.';
$string['gradinggradecalculated'] = 'Arvioinnin laskettu arvosana';
$string['gradinggradeof'] = 'Vertaisarvioinnin arvosana (max {$a})';
$string['gradinggradeover'] = 'Sivuuta vertaisarvioinnin arvosana';
$string['gradingsettings'] = 'Arvioinnin asetukset';
$string['iamsure'] = 'Kyllä, olen varma';
$string['info'] = 'Tietoa';
$string['instructauthors'] = 'Ohjeet tehtävän tekijälle';
$string['instructreviewers'] = 'Ohjeet vertaisarvioijille';
$string['introduction'] = 'Esittely';
$string['latesubmissions'] = 'Myöhästyneet palautukset';
$string['latesubmissions_desc'] = 'Salli palautukset määräajan jälkeen';
$string['latesubmissions_help'] = 'Jos asetus on päällä, tekijä voi palauttaa työn palautuksen määräajan jälkeen tai vertaisarviointivaiheen aikana. Myöhästyneitä palautuksia ei kuitenkaan voi muokata.';
$string['latesubmissionsallowed'] = 'Myöhästyneet palautukset sallitaan';
$string['maxbytes'] = 'Tiedoston maksimikoko';
$string['modulename'] = 'Työpaja';
$string['modulenameplural'] = 'Työpajat';
$string['mysubmission'] = 'Palautukseni';
$string['nattachments'] = 'Liitteiden maksimimäärä';
$string['noexamples'] = 'Tässä työpajassa ei vielä ole esimerkkejä';
$string['noexamplesformready'] = 'Määrittele arviointimatriisi ensin, ennen kuin teet esimerkkitöitä harjoitusarvioitaviksi';
$string['nogradeyet'] = 'Ei arvioitu';
$string['nosubmissionfound'] = 'Tällä käyttäjällä ei ole palautettuja töitä';
$string['nosubmissions'] = 'Tässä työpajassa ei ole palautettuja töitä';
$string['notassessed'] = 'Ei vielä vertaisarvioitu';
$string['nothingtoreview'] = 'Ei arvioitavaa';
$string['notoverridden'] = 'Ei ylitetty';
$string['noworkshops'] = 'Tällä kurssialueella ei ole työpajoja';
$string['noyoursubmission'] = 'Et ole vielä palauttanut työtäsi';
$string['nullgrade'] = '-';
$string['page-mod-workshop-x'] = 'Kaikki työpajamoduulin sivut';
$string['participant'] = 'Osallistuja';
$string['participantrevierof'] = 'Osallistuja vertaisarvioi:';
$string['participantreviewedby'] = 'Osallistujan työn on vertaisarvioinut';
$string['phaseassessment'] = 'Vertaisarviointi';
$string['phaseclosed'] = 'Suljettu';
$string['phaseevaluation'] = 'Vertaisarvioiden arviointi';
$string['phasesetup'] = 'Asetusten määrittely';
$string['phasesubmission'] = 'Töiden palautus';
$string['pluginadministration'] = 'Työpajan asetukset';
$string['pluginname'] = 'Työpaja';
$string['prepareexamples'] = 'Valmistele esimerkkipalautukset';
$string['previewassessmentform'] = 'Esikatsele';
$string['publishedsubmissions'] = 'Julkaistut palautukset';
$string['publishsubmission'] = 'Julkaise palautus';
$string['publishsubmission_help'] = 'Julkaistut palautukset näkyvät muille kun työpaja on suljettu';
$string['reassess'] = 'Arvioi uudelleen';
$string['receivedgrades'] = 'Osallistujan saamat vertaisarviot';
$string['recentassessments'] = 'Työpajan arvioinnit';
$string['recentsubmissions'] = 'Työpajan palautukset';
$string['saveandclose'] = 'Tallenna ja sulje';
$string['saveandcontinue'] = 'Tallenna ja jatka muokkausta';
$string['saveandpreview'] = 'Tallenna ja esikatsele';
$string['selfassessmentdisabled'] = 'Ei itsearviointia';
$string['someuserswosubmission'] = 'Vähintään yhdeltä osallistujalta puuttuu työn palautus';
$string['sortasc'] = 'Nouseva järjestys';
$string['sortdesc'] = 'Laskeva järjestys';
$string['strategy'] = 'Arviointimenetelmä';
$string['strategy_help'] = 'Arviointimenetelmä määrittelee käytetyn vertaisarviointitavan ja töiden pisteytystavan. Tähän on neljä eri vaihtoehtoa:
* Kertyvä arviointi - Määriteltyjen kriteerien perusteella annetaan palaute ja arvosana
* Kommentit - Määriteltyjen kriteerien perusteella annetaan palaute mutta ei arvosanaa
* Virheiden määrä - Kommentteja sekä kyllä/ei arvio annetaan määriteltyjen väitteiden suhteen
* Arviointimatriisi - Annetaan laadullinen arvio määriteltyjen arviointikriteerien perusteella';
$string['strategyhaschanged'] = 'Työpajan arvostelustrategia on muuttunut sen jälkeen kun lomake avattiin muokattavaksi.';
$string['submission'] = 'Palautus';
$string['submissionattachment'] = 'Liite';
$string['submissionby'] = 'Työn tekijä: {$a}';
$string['submissioncontent'] = 'Palautuksen sisältö';
$string['submissionend'] = 'Palautusten määräaika';
$string['submissionenddatetime'] = 'Palautusten määräaika {$a->daydatetime} ({$a->distanceday})';
$string['submissionendevent'] = '{$a} (palautusten määräaika)';
$string['submissiongrade'] = 'Työn arvosana';
$string['submissiongrade_help'] = 'Tämä asetus määrittelee palautetun työn maksimiarvosanan.';
$string['submissiongradeof'] = 'Työn arvosana (max {$a})';
$string['submissionsettings'] = 'Työn palauttamiseen liittyvät asetukset';
$string['submissionstart'] = 'Palautettavissa alkaen';
$string['submissionstartdatetime'] = 'Palautettavissa alkaen {$a->daydatetime} ({$a->distanceday})';
$string['submissionstartevent'] = '{$a} (palautusaika alkaa)';
$string['submissiontitle'] = 'Otsikko';
$string['subplugintype_workshopallocation'] = 'Palautteenantovuorojen jakotapa';
$string['subplugintype_workshopallocation_plural'] = 'Palautteenantovuorojen jakotavat';
$string['subplugintype_workshopeval'] = 'Vertaisarviointien arviointitapa';
$string['subplugintype_workshopeval_plural'] = 'Vertaisarviointien arviointitavat';
$string['subplugintype_workshopform'] = 'Arviointimenetelmä';
$string['subplugintype_workshopform_plural'] = 'Arviointimenetelmät';
$string['switchingphase'] = 'Vaihdetaan vaihetta';
$string['switchphase'] = 'Vaihda tähän vaiheeseen';
$string['switchphase10info'] = 'Olet vaihtamassa työpajan vaiheen <strong>Alkuasetusten määrittelyyn</strong>. Tässä vaiheessa käyttäjät eivät voi muokata palautuksiaan tai vertaisarvioitaan. Opettajat voivat käyttää tätä vaihetta muokatakseen työpajan asetuksia, arviointimenetelmää tai arviointimatriiseja.';
$string['switchphase20info'] = 'Olet vaihtamassa työpajan vaiheen <strong>Töiden palautukseen</strong>, jonka aikana opiskelijat voivat palauttaa työnsä (palautusaikaan mennessä, jos olet sen määritellyt) ja opettajat voivat jakaa palautteenantovuorot vertaisarviointia varten.';
$string['switchphase30info'] = 'Olet vaihtamassa työpajan vaiheen <strong>Vertaisarviointiin</strong>, jossa osallistujat arvioivat heille jaetut työt (mahdollisesti asettamasi arviointiajan aikana).';
$string['switchphase40info'] = 'Olet vaihtamassa työpajan vaiheen <strong>Vertaisarvioiden arviointiin</strong>, jossa osallistujat eivät muokata palautuksiaan tai antamiaan vertaisarvioita. Opettajat laskevat työpajan loppuarvosanat  siihen tarkoitetuilla arviointivälineillä ja antavat palautetta vertaisarvioijille.';
$string['switchphase50info'] = 'Olet sulkemassa työpajaa. Tämän jälkeen arvosanat näkyvät arviointikirjassa, jolloin opiskelijat näkevät palauttamansa työt ja saamansa arvioinnit.';
$string['taskassesspeers'] = 'Arvioi vertaisia';
$string['taskassesspeersdetails'] = 'kaikkiaan: {$a->total}<br />tekemättä: {$a->todo}';
$string['taskassessself'] = 'Arvioi oma työsi';
$string['taskinstructauthors'] = 'Anna ohjeet töiden palautukseen liittyen';
$string['taskinstructreviewers'] = 'Anna ohjeet vertaisarvioinnille';
$string['taskintro'] = 'Aseta työpajan esittely';
$string['tasksubmit'] = 'Palauta työsi';
$string['toolbox'] = 'Työpajan työkalupakki';
$string['undersetup'] = 'Työpajan asetuksia ollaan määrittelemässä. Kestää hetken, ennen kuin pääset työpajaan.';
$string['useexamples'] = 'Käytä esimerkkipalautuksia';
$string['useexamples_desc'] = 'Esimerkkipalautukset ovat vertaisarvioinnin harjoittelua varten';
$string['useexamples_help'] = 'Jos esimerkkipalautukset ovat käytössä, osallistujat voivat harjoitella vertaisarviointia yhdessä tai useammassa esimerkkipalautuksessa ja verrata arvioitaan mallivastaukseen. Esimerkkipalautusten arviointeja ei huomioida vertaisarvioinnin arvosanaa laskettaessa.';
$string['usepeerassessment'] = 'Käytä vertaisarviointia';
$string['usepeerassessment_desc'] = 'Opiskelijat arvioivat muiden töitä';
$string['usepeerassessment_help'] = 'Jos vertaisarviointi on käytössä, osallistujille jaetaan arvioitavaksi muiden osallistujien töitä ja osallistuja saa arvosanan oman työnsä lisäksi myös antamistaan vertaisarvioista.';
$string['userdatecreated'] = 'palautettu <span>{$a}</span>';
$string['userdatemodified'] = 'muokattu <span>{$a}</span>';
$string['userplan'] = 'Työpajan suunnittelija';
$string['userplan_help'] = 'Työpajan suunnittelija näyttää kaikki toiminnan vaiheet ja listaa joka vaiheen tehtävät. Aktiivinen vaihe on korostettu ja tehtävien suorittamista merkitään ruksilla.';
$string['useselfassessment'] = 'Käytä itsearviointia';
$string['useselfassessment_desc'] = 'Opiskelijat arvioivat oman työnsä';
$string['useselfassessment_help'] = 'Jos itsearvointi on käytössä, osallistuja arvioi oman työnsä ja saa arvosanan palauttamansa työn lisäksi myös antamastaan itsearviosta.';
$string['weightinfo'] = 'Painotus: {$a}';
$string['withoutsubmission'] = 'Vertaisarvioija, joka ei ole palauttanut omaa työtä';
$string['workshop:allocate'] = 'Jaa vertaisarviointivuorot';
$string['workshop:editdimensions'] = 'Muokkaa arviointimatriiseja';
$string['workshop:ignoredeadlines'] = 'Jätä aikarajoitukset huomiotta';
$string['workshop:manageexamples'] = 'Hallinnoi esimerkkipalautuksia';
$string['workshop:overridegrades'] = 'Sivuuta lasketut arvosanat';
$string['workshop:peerassess'] = 'Anna vertaisarviointi';
$string['workshop:publishsubmissions'] = 'Julkaise palautukset';
$string['workshop:submit'] = 'Lähetä';
$string['workshop:switchphase'] = 'Vaihda vaihetta';
$string['workshop:view'] = 'Näytä työpaja';
$string['workshop:viewallassessments'] = 'Näytä kaikki vertaisarvioinnit';
$string['workshop:viewallsubmissions'] = 'Näytä kaikki palautetut työt';
$string['workshop:viewauthornames'] = 'Näytä tekijöiden nimet';
$string['workshop:viewauthorpublished'] = 'Näytä julkaistujen töiden tekijät';
$string['workshop:viewpublishedsubmissions'] = 'Näytä julkaistut työt';
$string['workshop:viewreviewernames'] = 'Näytä vertaisarvioijien nimet';
$string['workshopfeatures'] = 'Työpajan ominaisuudet';
$string['workshopname'] = 'Työpajan nimi';
$string['yourassessment'] = 'Arviosi';
$string['yoursubmission'] = 'Palautuksesi';
