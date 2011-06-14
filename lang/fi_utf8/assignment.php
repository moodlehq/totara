<?PHP // $Id$ 
      // assignment.php - created with Moodle 1.9.12 (Build: 20110510) (2007101591.03)


$string['allowdeleting'] = 'Salli tiedostojen poistaminen';
$string['allowmaxfiles'] = 'Palautettujen tiedostojen enimmäismäärä';
$string['allownotes'] = 'Salli muistiinpanot';
$string['allowresubmit'] = 'Salli uudelleenpalautus';
$string['alreadygraded'] = 'Vastauksesi on jo arvioitu eikä uudelleenpalautus ole sallittua.';
$string['assignment:grade'] = 'Tehtävän arviointi';
$string['assignment:submit'] = 'Tehtävän palautus';
$string['assignment:view'] = 'Tehtävän tarkastelu';
$string['assignmentdetails'] = 'Tehtävän tiedot';
$string['assignmentmail'] = '$a->teacher on antanut sinulle palautetta tehtävästä \'$a->assignment\'

Voit nähdä sen osoitteessa:

$a->url';
$string['assignmentmailhtml'] = '$a->teacher on antanut sinulle palautetta tehtävästä \'<i>$a->assignment</i>\'<br /><br />

Voit nähdä sen osoitteessa:

<a href=\"$a->url\">Tehtävän palautus</a>.';
$string['assignmentname'] = 'Tehtävän nimi';
$string['assignmenttype'] = 'Tehtävän tyyppi';
$string['availabledate'] = 'Saatavilla';
$string['cannotdeletefiles'] = 'Tapahtui virhe eikä tiedostoja voitu poistaa';
$string['comment'] = 'Kommentoi';
$string['commentinline'] = 'Kommentoi ja muokkaa vastausta';
$string['configitemstocount'] = 'Kohteiden tyypit, jotka lasketaan opiskelijalle tehtävissä.';
$string['configmaxbytes'] = 'Oletusasetus sivuston tehtävien enimmäiskoolle (alisteinen kurssien omille rajoituksille ja muille paikallisille asetuksille)';
$string['configshowrecentsubmissions'] = 'Kaikki näkevät palautustapahtumat viimeisimpien tapahtumien listalla';
$string['confirmdeletefile'] = 'Oletko varma että haluat poistaa tämän tiedoston?<br /><strong>$a</strong>';
$string['deleteallsubmissions'] = 'Poista kaikki palautukset';
$string['deletefilefailed'] = 'Tiedoston poistaminen epäonnistui';
$string['description'] = 'Kuvaus';
$string['draft'] = 'Keskeneräinen';
$string['duedate'] = 'Palautettava viimeistään';
$string['duedateno'] = 'Ei palautuspäivämäärää';
$string['early'] = '$a ajoissa';
$string['editmysubmission'] = 'Muokkaa palautustani';
$string['emailstudents'] = 'Postita varoitukset opiskelijoille';
$string['emailteachermail'] = '$a->username on päivittänyt palautustaan tehtävään \'$a->assignment\'.

Se on saatavilla täällä:

$a->url';
$string['emailteachermailhtml'] = '$a->username on päivittänyt palautustaan tehtävään \'$a->assignment\'.</i><br /><br />
Se on <a href=\"$a->url\">saatavilla verkkosivulla</a>.';
$string['emailteachers'] = 'Lähetä ilmoitukset opettajille sähköpostilla';
$string['emptysubmission'] = 'Et ole palauttanut vielä mitään.';
$string['enableemailnotification'] = 'Lähetä ilmoitukset sähköpostitse';
$string['existingfiledeleted'] = 'Tiedosto on poistettu: $a';
$string['failedupdatefeedback'] = 'Palautteen tallentaminen käyttäjälle $a epäonnistui';
$string['feedback'] = 'Palaute';
$string['feedbackfromteacher'] = 'Palautetta {$a}lta';
$string['feedbackupdated'] = 'Vastausten palautteet päivitetty $a opiskelijalle';
$string['finalize'] = 'Ei enää palautuksia';
$string['finalizeerror'] = 'Tapahtui virhe eikä tätä palautusta voitu viimeistellä';
$string['graded'] = 'Arvioitu';
$string['guestnosubmit'] = 'Vieraat eivät voi palauttaa tehtäviä. Jos haluat palauttaa tehtävän, kirjaudu sisään tunnuksellasi';
$string['guestnoupload'] = 'Vieraat eivät saa lähettää tiedostoja palvelimelle';
$string['helpoffline'] = '<p>Hyödyllinen, kun tehtävä suoritetaan Moodlen ulkopuolella. Kyseessä saattaa olla esim tehtävä jossain muualla verkossa, esitelmä tai tapaaminen.</p>
<p>Oppilaat voivat nähdä tehtävän kuvauksen, mutta eivät voi palauttaa tiedostoja tai muutakaan. Arvostelu tapahtuu normaalisti ja oppilaat saavat ilmoituksen arvosanoistaan.</p>';
$string['helponline'] = '<p>Tässä tehtävätyypissä opiskelijat muokkaavat tekstiä käyttäen normaaleja tekstinkäsittelytyökaluja. Opettajat voivat arvioida tehtävät verkossa, ja jopa lisätä kommenttejaan tai muokata töitä.</p>
<p>(Jos olet perehtynyt Moodlen aikaisempiin versioihin, tämä tehtävätyyppi on samanlainen kuin aikaisempi Muistio-moduuli.)</p>';
$string['helpupload'] = '<p>Tämä tehtävätyyppi antaa jokaisen osallistujan lähettää yhden tai useampia tiedostoja. Tiedostot voivat olla tekstidokumentteja, kuvia, zip-paketteja ym.</p>
<p>Tehtävätyyppi mahdollistaa myös usean palautetiedoston lähettämisen. Palautetiedostot voidaan lähettää ennen kuin tehtävää on avattu, jolloin jokaiselle osallistujalle voidaan antaa oma tiedosto työstettäväksi.</p>
<p>Osallistujat voivat myös jättää kommentteja omista tiedostoistaan.</p>
<p>Osallistujan pitää lopuksi hyväksyä tehtäväpalautuksensa valmiiksi. Siihen asti kesken olevat tehtävät ovat merkittynä keskeneräisiksi.</p>';
$string['helpuploadsingle'] = '<p>Tämäntyyppisessä tehtävässä kaikki osanottajat voivat palauttaa yhden tiedoston, joka voi olla mitä tahansa tyyppiä.</p>
<p>Se saattaa olla esim. tekstidokumentti, kuva tai zip-pakattu verkkosivu.</p>';
$string['hideintro'] = 'Piilota kuvaus kunnes tehtävä on avoinna';
$string['itemstocount'] = 'Määrä';
$string['late'] = '$a myöhässä';
$string['maximumgrade'] = 'Korkein arvosana';
$string['maximumsize'] = 'Maksimikoko';
$string['modulename'] = 'Tehtävä';
$string['modulenameplural'] = 'Tehtävät';
$string['newsubmissions'] = 'Palautetut tehtävät';
$string['noassignments'] = 'Ei vielä tehtäviä';
$string['noattempts'] = 'Tähän tehtävään ei ole vielä vastattu';
$string['nofiles'] = 'Tiedostoja ei palautettu';
$string['nofilesyet'] = 'Ei palautettuja tiedostoja vielä';
$string['nomoresubmissions'] = 'Enempää palautuksia ei ole sallittu';
$string['nosubmitusers'] = 'Käyttäjillä ei ole oikeuksia palauttaa tätä tehtävää';
$string['notavailableyet'] = 'Tämä tehtävä ei ole vielä avoinna.<br /> Tehtävän ohjeet näytetään alla olevana ajankohtana.';
$string['notes'] = 'Muistiinpanot';
$string['notesempty'] = 'Ei kohteita';
$string['notesupdateerror'] = 'Virhe päivitettäessä muistiinpanoja';
$string['notgradedyet'] = 'Ei vielä arvioitu';
$string['notsubmittedyet'] = 'Ei vielä palautettu';
$string['onceassignmentsent'] = 'Kun tehtävä on lähetetty arvioitavaksi, et voi enää poistaa tai lisätä tiedostoja.';
$string['overwritewarning'] = 'Varoitus: uudelleen lähettäminen KORVAA aiemman vastauksesi.';
$string['pagesize'] = 'Näytettävien tehtävien määrä sivua kohden';
$string['preventlate'] = 'Estä myöhästyneet palautukset';
$string['quickgrade'] = 'Salli nopea arviointi';
$string['responsefiles'] = 'Palautetiedostot';
$string['reviewed'] = 'Arvioinut';
$string['saveallfeedback'] = 'Tallenna palaute';
$string['sendformarking'] = 'Lähetä arvioitavaksi';
$string['showrecentsubmissions'] = 'Näytä viimeisimmät palautukset';
$string['submission'] = 'Palautus';
$string['submissiondraft'] = 'Keskeneräinen palautus';
$string['submissionfeedback'] = 'Palaute tehtävästä';
$string['submissions'] = 'Palautukset';
$string['submissionsaved'] = 'Muutokset tallennettu';
$string['submissionsnotgraded'] = '$a tehtävää arvioimatta';
$string['submitassignment'] = 'Palauta tehtäväsi käyttäen tätä lomaketta';
$string['submitedformarking'] = 'Tehtävä on jo merkitty arvioiduksi eikä sitä voi muuttaa.';
$string['submitformarking'] = 'Lähetä tehtävä arvioitavaksi';
$string['submitted'] = 'Palautettu';
$string['submittedfiles'] = 'Palautetut tiedostot';
$string['trackdrafts'] = 'Ota käyttöön Lähetä arvioitavaksi -toiminto';
$string['typeoffline'] = 'Offline-tehtävä';
$string['typeonline'] = 'Verkkoteksti';
$string['typeupload'] = 'Tiedostojen lähetys';
$string['typeuploadsingle'] = 'Lähetä yksi tiedosto';
$string['unfinalize'] = 'Palauta keskeneräiseksi';
$string['unfinalizeerror'] = 'Tapahtui virhe eikä tätä palautusta voitu palauttaa luonnokseksi';
$string['uploadbadname'] = 'Tiedostonimessä on tuntemattomia merkkejä. Tiedostoa ei voida lähettää.';
$string['uploadedfiles'] = 'lähetetyt tiedostot';
$string['uploaderror'] = 'Tiedoston tallentamisessa palvelimelle tapahtui virhe.';
$string['uploadfailnoupdate'] = 'Tiedosto saapui palvelimelle, mutta vastauksesi tallentamisessa tapahtui virhe.';
$string['uploadfiletoobig'] = 'Valitettavasti tiedosto, jota yritit lähettää, on liian suuri (kokorajoitus on $a tavua).';
$string['uploadnofilefound'] = 'Tiedostoa ei löydy - oletko varma, että valitsit tiedoston lähetettäväksi?';
$string['uploadnotregistered'] = '\'$a\' vastaanotettiin, mutta lähetystäsi ei rekisteröity.';
$string['uploadsuccess'] = '\'$a\' on vastaanotettu palvelimelle.';
$string['usernosubmit'] = 'Valitettavasti et voi palauttaa tehtävää.';
$string['viewfeedback'] = 'Katso tehtävien arviointeja ja palautteita';
$string['viewsubmissions'] = 'Katso palautettuja tehtäviä ($a kpl)';
$string['yoursubmission'] = 'Palautuksesi';
$string['allowmultiple'] = 'Salli useita tiedostoja'; // ORPHANED
$string['attachfile'] = 'Liitä tiedosto'; // ORPHANED
$string['attachfiletoassignment'] = 'Liitä tiedosto(ja) tehtävään'; // ORPHANED
$string['backtoassignment'] = 'Takaisin tehtävään'; // ORPHANED
$string['backtofeedback'] = 'Takaisin palautteeseen'; // ORPHANED
$string['deletecheckfile'] = 'Haluatko varmasti poistaa tämän tiedoston?'; // ORPHANED
$string['deleteednotification'] = 'Tiedosto on poistettu.'; // ORPHANED
$string['deletefail'] = 'Seuraavaa tiedostoa ei ole poistettu:'; // ORPHANED
$string['markingsubmitnotification'] = 'Tiedosto on lähetetty onnistuneesti.'; // ORPHANED
$string['namedeletefile'] = 'Olet poistamassa tätä tiedostoa:'; // ORPHANED
$string['nofilesforsubmit'] = 'Tiedostoa ei löydy - oletko varmasti tuonut tiedoston?'; // ORPHANED
$string['removelink'] = 'Poista'; // ORPHANED

?>
