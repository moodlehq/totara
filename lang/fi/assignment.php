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
 * Strings for component 'assignment', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   assignment
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addsubmission'] = 'Lisää palautus';
$string['allowdeleting'] = 'Salli tiedostojen poistaminen';
$string['allowdeleting_help'] = '## Salli tiedostojen poistaminen
Jos tämä asetus sallitaan, opiskelijat saavat poistaa tehtävään jo lataamiaan tiedostoja siihen asti, kunnes palauttavat tiedostot arvioitaviksi.';
$string['allowmaxfiles'] = 'Palautettujen tiedostojen enimmäismäärä';
$string['allowmaxfiles_help'] = '## Palautukseen lisättävien tiedostojen maksimimäärä
Opiskelijan palautukseensa liittämien tiedostojen maksimimäärä. Tätä lukua ei näytetä opiskelijoille; muista siis lisätä tiedostomäärä osaksi tehtävänantoasi.';
$string['allownotes'] = 'Salli muistiinpanot';
$string['allownotes_help'] = '## Salli muistiinpanot
Jos asetus on päällä, opiskelijat voivat kirjoittaa muistiinpanoja tekstialueelle, joka vastaa Verkkoteksti-tehtävätyyppiä.
Muistiinpanoja voidaan hyödyntää viestinnässä opiskelijan ja arvioijan välillä, kuten arvioinnissa tarvittavan taustatiedon kertomiseen, tehtävän edistymisestä tiedottamiseen tai muuhun tarpeelliseen.';
$string['allowresubmit'] = 'Salli palautus arvioinnin jälkeen';
$string['allowresubmit_help'] = '## Palautus arvioinnin jälkeen
Opiskelija voi muokata verkkotekstiään tai palauttaa uuden version tiedostosta (vanhan päälle) siihen asti, kunnes opettaja arvioi työn. Oletuksena on, että opiskelijat eivät voi palauttaa tehtäviä enää, kun opettaja on tallentanut arvioinnin tai palautteen.
Jos sallit palautuksen myös arvioinnin jälkeen, opiskelijat voivat palauttaa tehtäviään arvioitavaksi uudestaan, esimerkiksi jos alkuperäinen työ on hylätty, tai jos halutaan työstää tekstiä prosessikirjoituksen avulla. Tästä valinnasta on siis hyötyä, kun halutaan ohjata opiskelijoita tekemään parempaa työtä tekstin iteroinnin avulla.
Tätä valintaa ei tietenkään voi käyttää Tehtävänanto-tyyppisessä tehtävässä, jossa opiskelija ei palauta mitään.';
$string['alreadygraded'] = 'Vastauksesi on jo arvioitu. Et voi palauttaa tehtävää uudestaan.';
$string['assignment:exportownsubmission'] = 'Vie oma palautus';
$string['assignment:exportsubmission'] = 'Vie palautus';
$string['assignment:grade'] = 'Tehtävän arviointi';
$string['assignment:submit'] = 'Tehtävän palautus';
$string['assignment:view'] = 'Tehtävän tarkastelu';
$string['assignmentdetails'] = 'Tehtävän tiedot';
$string['assignmentmail'] = '{$a->teacher} on antanut sinulle palautetta tehtävästä \'{$a->assignment}\'

Voit nähdä sen osoitteessa:

{$a->url}';
$string['assignmentmailhtml'] = '{$a->teacher} on antanut sinulle palautetta tehtävästä \'<i>{$a->assignment}</i>\'<br /><br />

Voit nähdä sen osoitteessa:

<a href="{$a->url}">Tehtävän palautus</a>.';
$string['assignmentmailsmall'] = 'Opettajan {$a->teacher} antama palaute on lisätty tehtävän palautukseesi \'{$a->assignment}\'';
$string['assignmentname'] = 'Tehtävän nimi';
$string['assignmentsubmission'] = 'Tehtävän palautukset';
$string['assignmenttype'] = 'Tehtävän tyyppi';
$string['availabledate'] = 'Palautettavissa alkaen';
$string['cannotdeletefiles'] = 'Tapahtuneen virheen takia tiedostoja ei voitu poistaa';
$string['cannotviewassignment'] = 'Et voi katsella tätä tehtävää';
$string['comment'] = 'Kommentoi';
$string['commentinline'] = 'Kopioi palautus palautteen pohjaksi';
$string['commentinline_help'] = '## Palautuksen kopiointi palautteen pohjaksi
Jos käytät tätä mahdollisuutta, opiskelijan palauttama teksti kopioidaan palautteesi pohjaksi palautekenttään, samalla idealla kuin sähköpostiviestin vastaukseen kopioidaan alkuperäinen viesti. Tämä mahdollistaa kontekstisidonnaisen kommentoinnin, jolloin alkuperäiseen vastaukseen ei erikseen tarvitse viitata.
Huomaa kuitenkin, että opiskelijan vastausta ja sinun palautettasi ei erotella mitenkään, joten korosta palautettasi vaikkapa toisella tekstivärillä, tekstin taustavärillä, erilaisella kirjasimella tai erottelemalla palautteesi selkeästi omiin kappaleisiinsa, omalla nimelläsi varustettuna. Vastaavasti, jos et halua erotella omaa osuuttasi opiskelijan vastauksesta, voit suoraan muokata alkuperäistä tekstiä.';
$string['configitemstocount'] = 'Osat, jotka sisällytetään opiskelijan palautukseen Tehtävissä.';
$string['configmaxbytes'] = 'Oletusasetus sivuston tehtävien enimmäiskoolle (alisteinen kurssien omille rajoituksille ja muille paikallisille asetuksille)';
$string['configshowrecentsubmissions'] = 'Kaikki näkevät palautustapahtumat viimeisimpien tapahtumien listalla';
$string['confirmdeletefile'] = 'Oletko varma että haluat poistaa tämän tiedoston?<br /><strong>{$a}</strong>';
$string['coursemisconf'] = 'Kurssi on väärin konfiguroitu';
$string['currentgrade'] = 'Nykyinen arvosana';
$string['deleteallsubmissions'] = 'Poista kaikki palautukset';
$string['deletefilefailed'] = 'Tiedoston poistaminen epäonnistui';
$string['description'] = 'Kuvaus';
$string['downloadall'] = 'Lataa kaikki tehtävät zip-tiedostona';
$string['draft'] = 'Keskeneräinen';
$string['due'] = 'Tehtävä palautettava viimeistään';
$string['duedate'] = 'Palautettava viimeistään';
$string['duedateno'] = 'Ei palautuspäivämäärää';
$string['early'] = '{$a} ajoissa';
$string['editmysubmission'] = 'Kirjoita';
$string['editthesefiles'] = 'Muokkaa näitä tiedostoja';
$string['editthisfile'] = 'Päivitä tämä tiedosto';
$string['emailstudents'] = 'Postita varoitukset opiskelijoille';
$string['emailteachermail'] = '{$a->username} on päivittänyt {$a->timeupdated} palautustaan tehtävään \'{$a->assignment}\'.

Se on saatavilla täällä:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->username} on päivittänyt palautustaan tehtävään <i>\'{$a->assignment}\', {$a->timeupdated}.</i><br /><br />
Se on <a href="{$a->url}">saatavilla verkkosivulla</a>.';
$string['emailteachers'] = 'Ilmoita palautuksesta opettajille';
$string['emailteachers_help'] = '## Ilmoita palautuksesta opettajille
Jos tämä toiminto on aktivoitu, saavat kaikki opettajat sähköposti-ilmoituksen, kun opiskelija palauttaa tehtävän tai muuttaa vastaustaan.
Vain opettajat, jotka voivat arvioida ko. tehtävän, saavat nämä ilmoitukset. Esimerkiksi, jos kurssialueella käytetään erillisiä ryhmiä, osaan ryhmistä rajoitetut opettajat eivät saa toisiin ryhmiin palautettuja töitä.
Tehtävänannoissa (offline-tehtävä) sähköpostia ei tietenkään lähetetä, sillä opiskelijat eivät palauta mitään.';
$string['emptysubmission'] = 'Et ole palauttanut vielä mitään.';
$string['enablenotification'] = 'Lähetä ilmoitukset sähköpostitse';
$string['enablenotification_help'] = '### Annetusta arvioinnista viesti opiskelijoille
Asetuksen ollessa valittuna Moodle lähettää opiskelijalle sähköpostitse tiedon antamastasi arvioinnista. Viesti on tämän tyylinen: "Oiva Opettaja on antanut sinulle palautetta tehtävästä \'Palauta seminaariesitelmäsi tänne\'. Voit nähdä sen osoitteessa: [linkki tehtävän palautukseen]".
**Huomaa**, että asetuksesi tallentuu käytettäväksi kaikissa tehtävissä kaikilla kursseillasi.';
$string['errornosubmissions'] = 'Ladattavia palautuksia ei ole';
$string['existingfiledeleted'] = 'Tiedosto on poistettu: {$a}';
$string['failedupdatefeedback'] = 'Palautteen tallentaminen käyttäjälle {$a} epäonnistui';
$string['feedback'] = 'Palaute';
$string['feedbackfromteacher'] = 'Palautetta opettajalta {$a}';
$string['feedbackupdated'] = 'Vastausten palautteet päivitetty {$a} opiskelijalle';
$string['finalize'] = 'Estä palautusten muutokset';
$string['finalizeerror'] = 'Tapahtuneen virheen takia tätä palautusta ei voitu viimeistellä';
$string['graded'] = 'Arvioitu';
$string['guestnosubmit'] = 'Vierailijat eivät voi palauttaa tehtäviä. Jos haluat palauttaa tehtävän, kirjaudu ensin.';
$string['guestnoupload'] = 'Vierailijat eivät saa ladata tiedostoja palvelimelle';
$string['helpoffline'] = '<p>Hyödyllinen, kun haluat arvioida tehtävän, jonka opiskelijat tekevät Moodlen ulkopuolella, kuten tehtävä muualla verkossa tai lähitehtävä kuten esitelmä tai läsnäolo tapaamisessa.</p>
<p>Opiskelijat voivat nähdä tehtävän kuvauksen, mutta eivät voi palauttaa mitään. Arvostelu tapahtuu normaalisti ja opiskelijat saavat ilmoituksen arvosanoistaan.</p>';
$string['helponline'] = '<p>Tässä tehtävätyypissä opiskelijat muokkaavat tekstiä käyttäen normaaleja tekstinkäsittelytyökaluja. Opettajat voivat arvioida tehtävät verkossa, ja jopa lisätä kommenttejaan tai muokata töitä.</p>
<p>(Jos olet perehtynyt Moodlen aikaisempiin versioihin, tämä tehtävätyyppi on samanlainen kuin aikaisempi Muistio-moduuli.)</p>';
$string['helpupload'] = '<p>Tämä tehtävätyyppi antaa jokaisen osallistujan lähettää yhden tai useampia tiedostoja. Tiedostot voivat olla tekstidokumentteja, kuvia, zip-paketteja ym.</p>
<p>Tehtävätyyppi mahdollistaa myös usean palautetiedoston lähettämisen. Palautetiedostot voidaan lähettää ennen kuin tehtävää on avattu, jolloin jokaiselle osallistujalle voidaan antaa oma tiedosto työstettäväksi.</p>
<p>Osallistujat voivat myös jättää kommentteja omista tiedostoistaan.</p>
<p>Osallistujan pitää lopuksi hyväksyä tehtäväpalautuksensa valmiiksi. Siihen asti kesken olevat tehtävät ovat merkittynä keskeneräisiksi. Voit arvioida nykyistä tilannetta milloin tahansa, keskeneräiset tehtävät on merkittynä Luonnoksiksi. Voit palauttaa minkä tahansa arvioimattoman tehtävän Luonnokseksi.</p>';
$string['helpuploadsingle'] = '<p>Tämäntyyppisessä tehtävässä kaikki osanottajat voivat palauttaa yhden tiedoston, joka voi olla mitä tahansa tyyppiä.</p>
<p>Se voi olla esim. tekstidokumentti, kuva tai zip-pakattu verkkosivu.</p>';
$string['hideintro'] = 'Piilota kuvaus kunnes tehtävä on avoinna';
$string['hideintro_help'] = '## Piilota tehtävän kuvaus ennen aloituspäivää
Jos tämä asetus on valittuna, tehtävän kuvaus ei näy opiskelijoille ennen tehtävän aloituspäivää.';
$string['invalidassignment'] = 'Virheellinen tehtävä';
$string['invalidfileandsubmissionid'] = 'Tiedosto tai palautuksen ID puuttuu';
$string['invalidid'] = 'Virheellinen tehtävän ID';
$string['invalidsubmissionid'] = 'Virheellinen palautuksen ID';
$string['invalidtype'] = 'Virheellinen tehtävätyyppi';
$string['invaliduserid'] = 'Virheellinen käyttäjän ID';
$string['itemstocount'] = 'Määrä';
$string['lastgrade'] = 'Viimeinen arvosana';
$string['late'] = '{$a} myöhässä';
$string['maximumgrade'] = 'Korkein arvosana';
$string['maximumsize'] = 'Maksimikoko';
$string['maxpublishstate'] = 'Suurin näkyvyys blogikirjoitukselle ennen eräpäivää';
$string['messageprovider:assignment_updates'] = 'Tehtävän ilmoitukset';
$string['modulename'] = 'Tehtävä';
$string['modulename_help'] = 'Tehtävissä opettaja määrittelee tehtävänannon ja palautusmuodon, joiden mukaan opiskelija tekee tehtävän ja mahdollisessti palauttaa tuotoksen palvelimelle. Palautus voi olla yksi tai useita tiedostoja tai verkkoteksti. Tyypillisiä tehtäviä ovat esseet, projektit ja raportit. Poikkeuksena muihin tehtävätyyppeihin Tehtävänannossa (offline-tehtävä) opiskelija ei palauta mitään vaan suorittaa tehtävän muuta kautta. Kaikille tehtävätyypeille yhteistä on, että opiskelijan palautuksen ja palautteen näkevät vain opiskelija itse ja kurssin opettajat. Suoritukset voidaan arvioida ja opettaja voi antaa niistä palautetta.';
$string['modulenameplural'] = 'Tehtävät';
$string['newsubmissions'] = 'Palautetut tehtävät';
$string['noassignments'] = 'Ei vielä tehtäviä';
$string['noattempts'] = 'Tähän tehtävään ei ole vielä vastattu';
$string['noblogs'] = 'Sinulla ei ole blogikirjoituksia, joita lähettää!';
$string['nofiles'] = 'Tiedostoja ei palautettu';
$string['nofilesyet'] = 'Tiedostoja ei ole vielä palautettu';
$string['nomoresubmissions'] = 'Et voi palauttaa (tällä hetkellä tai useampia) tiedostoja.';
$string['norequiregrading'] = 'Ei ole tehtäviä, jotka vaativat arviointia';
$string['nosubmisson'] = 'Tehtäviä ei ole palautettu';
$string['notavailableyet'] = 'Tämä tehtävä ei ole vielä avoinna.<br /> Tehtävän ohjeet näytetään alla olevana ajankohtana.';
$string['notes'] = 'Muistiinpanot';
$string['notesempty'] = 'Ei kohteita';
$string['notesupdateerror'] = 'Virhe päivitettäessä muistiinpanoja';
$string['notgradedyet'] = 'Ei vielä arvioitu';
$string['notsubmittedyet'] = 'Ei vielä palautettu';
$string['onceassignmentsent'] = 'Kun tehtävä on lähetetty arvioitavaksi, et voi enää poistaa tai lisätä tiedostoja.';
$string['operation'] = 'Toiminta';
$string['optionalsettings'] = 'Valinnaiset asetukset';
$string['overwritewarning'] = 'Varoitus: uudelleen lähettäminen KORVAA aiemman vastauksesi.';
$string['page-mod-assignment-submissions'] = 'Tehtävämoduulin palautussivu';
$string['page-mod-assignment-view'] = 'Tehtävämoduulin pääsivu';
$string['page-mod-assignment-x'] = 'Mikä tahansa tehtävämoduulin sivu';
$string['pagesize'] = 'Näytettävien palautusten määrä sivulla';
$string['pluginadministration'] = 'Tehtävän hallinnointi';
$string['pluginname'] = 'Tehtävä';
$string['popupinnewwindow'] = 'Avaa ponnahdusikkuna';
$string['preventlate'] = 'Estä myöhästyneet palautukset';
$string['quickgrade'] = 'Salli nopea arviointi';
$string['quickgrade_help'] = '## Nopea arviointi
Nopean arvioinnin avulla voit helposti arvioida useita opiskelijapalautuksia samalla sivulla.
Valitse haluamasi arvioinnit asteikosta ja kirjoita sanalliset kommentit kullekin arvioitavalle opiskelijalle. Tallenna kaikki kirjaamasi arvioinnit yhdellä kerralla sivun alareunan **Tallenna palaute** -painikkeella.
Normaalit arviointipainikkeet näkymän oikean reunan Tilanne-sarakkeessa toimivat tavalliseen tapaan, jos tarvitset enemmän tilaa sanallisen palautteen kirjoittamiselle tai haluat liittää palautteeseesi tiedoston.
**Huomaa**, että valitsemasi Nopea arviointi -asetus tallennetaan oletuksasetukseksi kaikkiin tehtäviin kaikilla kurssialueillasi.';
$string['requiregrading'] = 'Vaadi arviointi';
$string['responsefiles'] = 'Palautetiedosto';
$string['reviewed'] = 'Arvioinut';
$string['saveallfeedback'] = 'Tallenna arvioinnit';
$string['selectblog'] = 'Valitse minkä blogikirjoituksen haluat lähettää';
$string['sendformarking'] = 'Lähetä arvioitavaksi';
$string['showrecentsubmissions'] = 'Näytä viimeisimmät palautukset';
$string['submission'] = 'Palautus';
$string['submissiondraft'] = 'Keskeneräinen palautus';
$string['submissionfeedback'] = 'Palaute tehtävästä';
$string['submissions'] = 'Palautukset';
$string['submissionsaved'] = 'Muutokset tallennettu';
$string['submissionsnotgraded'] = '{$a} tehtävää arvioimatta';
$string['submitassignment'] = 'Palauta tehtäväsi käyttäen tätä lomaketta';
$string['submitedformarking'] = 'Tehtävä on jo lähetetty arvioitavaksi eikä sitä enää voi muokata.';
$string['submitformarking'] = 'Lähetä tehtävä arvioitavaksi';
$string['submitted'] = 'Palautettu';
$string['submittedfiles'] = 'Palautetut tiedostot';
$string['subplugintype_assignment'] = 'Tehtävän tyyppi';
$string['subplugintype_assignment_plural'] = 'Tehtävätyypit';
$string['trackdrafts'] = 'Ota Lähetä arvioitavaksi -toiminto käyttöön';
$string['trackdrafts_help'] = '## Lähetä arvioitavaksi
Lähetä arvioitavaksi -painikkeella opiskelija voi ilmoittaa arvioijalle, milloin hänen palautuksensa on valmis ja arvioitavissa. Arvioija voi tarvittaessa palauttaa tehtävän muokattavaksi, jos palautusta on esimerkiksi korjattava ennen lopullista arviointia.';
$string['typeblog'] = 'Blogikirjoitus';
$string['typeoffline'] = 'Tehtävänanto';
$string['typeonline'] = 'Verkkoteksti';
$string['typeupload'] = 'Tiedostojen palautus';
$string['typeuploadsingle'] = 'Yhden tiedoston palautus';
$string['unfinalize'] = 'Palauta muokattavaksi';
$string['unfinalize_help'] = 'Kun palautat tehtävän muokattavaksi, opiskelija voi korjata palautustaan esim. palautteesi perusteella ja palauttaa sen uudestaan.';
$string['unfinalizeerror'] = 'Tapahtuneen virheen takia tätä palautusta ei voitu palauttaa muokattavaksi.';
$string['uploadafile'] = 'Lähetä tiedosto';
$string['uploadbadname'] = 'Tiedostonimessä on tuntemattomia merkkejä. Tiedostoa ei voida tallentaa.';
$string['uploadedfiles'] = 'lähetetyt tiedostot';
$string['uploaderror'] = 'Tiedoston tallentamisessa palvelimelle tapahtui virhe.';
$string['uploadfailnoupdate'] = 'Tiedosto saapui palvelimelle, mutta vastauksesi tallentamisessa tapahtui virhe.';
$string['uploadfiles'] = 'Lähetä tiedostot';
$string['uploadfiletoobig'] = 'Tiedosto, jota yritit lähettää, on liian suuri (kokorajoitus on {$a} tavua).';
$string['uploadnofilefound'] = 'Tiedostoa ei löydy - oletko varma, että valitsit tiedoston lähetettäväksi?';
$string['uploadnotregistered'] = '\'{$a}\' vastaanotettiin, mutta lähetystäsi ei rekisteröity.';
$string['uploadsuccess'] = '\'{$a}\' on vastaanotettu palvelimelle.';
$string['usermisconf'] = 'Käyttäjä on väärin konfiguroitu';
$string['usernosubmit'] = 'Valitettavasti et saa jättää palautusta.';
$string['viewfeedback'] = 'Katso tehtävien arviointeja ja palautteita';
$string['viewmysubmission'] = 'Näytä palautukseni';
$string['viewsubmissions'] = 'Katso palautettuja tehtäviä ({$a} kpl)';
$string['yoursubmission'] = 'Palautuksesi';
