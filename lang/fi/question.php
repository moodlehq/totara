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
 * Strings for component 'question', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   question
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'Toiminto';
$string['addanotherhint'] = 'Lisää toinen vihje';
$string['addcategory'] = 'Lisää kategoria';
$string['adminreport'] = 'Raportoi mahdollisista ongelmista kysymystietokannassasi.';
$string['answer'] = 'Vastaus';
$string['answersaved'] = 'Vastaus tallennettu';
$string['attemptfinished'] = 'Suoritus päättynyt';
$string['attemptfinishedsubmitting'] = 'Suoritus päättynyt, palautetaan:';
$string['availableq'] = 'Saatavilla?';
$string['badbase'] = 'Huono kanta ennen **: {$a}**';
$string['behaviour'] = 'Käyttäytyminen';
$string['behaviourbeingused'] = 'käytössä oleva käyttäytyminen: {$a}';
$string['broken'] = 'Tämä linkki on "hajonnut". Tiedosto, johon se osoittaa ei ole olemassa';
$string['byandon'] = '<em>{$a->user}</em> - <em>{$a->time}</em>';
$string['cannotcopybackup'] = 'Varmuuskopiotiedostoa ei voitu kopioida';
$string['cannotcreate'] = 'Ei voitu luoda uutta merkintää question_attempts -tauluun';
$string['cannotcreatepath'] = 'Ei voida luoda polkua: {$a}';
$string['cannotdeletebehaviourinuse'] = 'Et voi poistaa toimintaa \'{$a}\'. Se on kysymysten käytössä.';
$string['cannotdeletecate'] = 'Et voi poistaa kyseistä kategoriaa, se on oletuskategoria tälle kontekstille.';
$string['cannotdeletemissingbehaviour'] = 'Et voi poistaa puuttuvan käyttäytymisen asennusta. Järjestelmä vaatii sen.';
$string['cannotdeletemissingqtype'] = 'Et voi poistaa puuttuvan kysymystyypin asennusta. Järjestelmä tarvitsee sitä.';
$string['cannotdeleteneededbehaviour'] = 'Ei voida poistaa kysymysten käyttäytymistä \'{$a}\'. Jotkin muut käyttäytymiset riippuvat siitä.';
$string['cannotdeleteqtypeinuse'] = 'Et voi poistaa kysymystyyppiä \'{$a}\'. Tämän tyyppisiä kysymyksiä on kysymyspankissa.';
$string['cannotdeleteqtypeneeded'] = 'Et voi poistaa kysymystyyppiä \'{$a}\'. Jotkin muut kysymystyypit riippuvat siitä.';
$string['cannotenable'] = 'Kysymystyyppiä {$a} ei voida luoda suoraan.';
$string['cannotenablebehaviour'] = 'Kysymysten käyttäytymistä {$a} ei voida käyttää suoraan. Se on vain sisäiseen käyttöön.';
$string['cannotfindcate'] = 'Ei löydetty kategoriamerkintää.';
$string['cannotfindquestionfile'] = 'Ei löydetty kysymysdatatiedostoa zip:istä';
$string['cannotgetdsfordependent'] = 'Ei löydetä määriteltyä tietojoukkoa tietojoukosta riippuvalle kysymykselle! (kysymys: {$a->id}, tietojoukko: {$a->item})';
$string['cannotgetdsforquestion'] = 'Ei löydetä määriteltyä tietojoukkoa lasku-tehtävälle! (kysymys: {$a})';
$string['cannothidequestion'] = 'Ei voitu piilottaa kysymystä';
$string['cannotimportformat'] = 'Valitettavasti tämän muodon tuontia ei ole vielä toteutettu!';
$string['cannotinsertquestion'] = 'Ei voitu lisätä uutta kysymystä!';
$string['cannotinsertquestioncatecontext'] = 'Ei voitu lisätä uutta kysymyskategoriaa {$a->cat} laiton konteksti-id {$a->ctx}';
$string['cannotloadquestion'] = 'Ei voitu ladata kysymystä';
$string['cannotmovequestion'] = 'Et voi käyttää tätä skripiä siirtääksesi kysymyksiä, joihin liittyy tiedostoja eri alueilta.';
$string['cannotopenforwriting'] = 'Ei voida avata kirjoitettavaksi: {$a}';
$string['cannotpreview'] = 'Et voi esikatsella näitä kysymyksiä!';
$string['cannotread'] = 'Tuontitiedostoa ei voitu lukea tai tiedosto on tyhjä';
$string['cannotretrieveqcat'] = 'Ei voitu hakea kysymyskategoriaa';
$string['cannotunhidequestion'] = 'Ei voitu poistaa kysymyksen piilotusta.';
$string['cannotunzip'] = 'Tiedostoa ei voitu purkaa.';
$string['cannotwriteto'] = 'Ei voida kirjoittaa vietyjä kysymyksiä kohteeseen {$a}';
$string['category'] = 'Kategoria';
$string['categorycurrent'] = 'Nykyinen kategoria';
$string['categorycurrentuse'] = 'Käytä tätä kategoriaa';
$string['categorydoesnotexist'] = 'Kategoriaa ei ole olemassa';
$string['categoryinfo'] = 'Kategorian tiedot';
$string['categorymove'] = 'Kategoria \'{$a->name}\' sisältää \'{$a->count}\' kysymystä. Ole hyvä ja valitse joku toinen kategoria, johon siirrät ne.';
$string['categorymoveto'] = 'Tallenna kategoriaan';
$string['categorynamecantbeblank'] = 'Kategorian nimi ei voi olla tyhjä.';
$string['changeoptions'] = 'Muuta valintoja';
$string['changepublishstatuscat'] = '<a href="{$a->caturl}">Kategoria "{$a->name}"</a> kurssissa "{$a->coursename}" saa jakamisstatuksensa <strong>{$a->changefrom}:sta {$a->changeto}:n</strong>';
$string['check'] = 'Lukitsen vastaukseni';
$string['chooseqtypetoadd'] = 'Valitse lisättävä kysymystyyppi';
$string['clearwrongparts'] = 'Pyyhi väärät vastaukset';
$string['clickflag'] = 'Merkitse kysymys';
$string['clicktoflag'] = 'Klikkaa merkitäksesi tämän kysymyksen';
$string['clicktounflag'] = 'Klikkaa poistaaksesi kysymyksen merkinnän';
$string['clickunflag'] = 'Poista merkintä';
$string['closepreview'] = 'Sulje esikatselu';
$string['combinedfeedback'] = 'Yhdistetty palaute';
$string['comment'] = 'Kommentti';
$string['commented'] = 'Kommentoitu: {$a}';
$string['commentormark'] = 'Kommentoi tai ylitä';
$string['comments'] = 'Kommentit';
$string['commentx'] = 'Kommentit: {$a}';
$string['complete'] = 'Valmis';
$string['contexterror'] = 'Sinun ei olisi pitänyt päästä tänne jos et ole siirtämässä kategoriaa toiseen kontekstiin.';
$string['copy'] = 'Kopioi {$a}:sta ja vaihda linkkejä';
$string['correct'] = 'Oikein';
$string['correctfeedback'] = 'Palaute oikeille vastauksille';
$string['created'] = 'Luotu';
$string['createdby'] = 'Tekijä';
$string['createdmodifiedheader'] = 'Luotu / Viimeksi tallennettu';
$string['createnewquestion'] = 'Luo uusi kysymys...';
$string['cwrqpfs'] = 'Satunnaiset kysymykset valitsemassa kysymyksiä ala-kategorioista.';
$string['cwrqpfsinfo'] = 'Päivitettäessä Moodle 1.9:ään eri kysymyskategoriat eritellään eri asiayhteyksiin. Joidenkin kysymyskategorioiden ja kysymysten jakamis-status muuttuu. Tämä on tarpeellista harvinaisessa tapauksessa, jossa yksi tai enemmän satunnaisista kysymyksistä kyselyssä on asetettu valitsemaan jaetuista ala-kategorioista.

Tämä tapahtuu kun "satunnainen" kysymys on asetettu valitsemaan ala-kategorioista ja yhdellä tai useammalla ala-kategorialla on erilainen jakamis-status verrattuna pääkategoriaan, jossa satunnainen kysymys on luotu.

Päivitettäessä Moodle 1.9:ään, seuraavat kysymyskategoriat, joista pääkategoriassa sijaitsevat satunnaiset kysymykset valitsevat kysymyksiä, saavat jakamisstatuksensa muutettua samaan statukseen kuin kategoria missä satunnainen kysymys sijaitsee. Seuraavat kategoriat sallivat muuttaa jakamisstatuksensa. Kysymykset joihin on vaikutetttu toimivat olemassa olevissa kyselyissä, kunnes poistat ne kyselyistä.';
$string['cwrqpfsnoprob'] = '"Satunnaiset kysymykset valitsemassa kysymyksiä ala-kategorioista" eivät vaikuta sivustosi kysymyskategorioihin.';
$string['decimalplacesingrades'] = 'Desimaalien määrä arvosanoissa';
$string['defaultfor'] = 'Oletus kohteelle {$a}';
$string['defaultinfofor'] = 'Kohteessa \'{$a}\' jaettujen kysymysten oletuskategoria.';
$string['defaultmark'] = 'Oletuspisteet';
$string['deletebehaviourareyousure'] = 'Poista käyttäytyminen {$a}: oletko varma?';
$string['deletebehaviourareyousuremessage'] = 'Olet poistamassa kysymysten käyttäytymisen {$a}. Tämä poistaa kaiken tähän käyttäytymiseen liittyvän tietokannasta. Oletko VARMA että haluat jatkaa?';
$string['deletecoursecategorywithquestions'] = 'Tähän kurssikategoriaan on yhdistetty kysymyksiä kysymyspankista. jos jatkat, ne tuhoutuvat. Voit siirtää niitä käyttämällä kysymyspankki käyttöliittymää.';
$string['deleteqtypeareyousure'] = 'Poista kysymystyyppi {$a}: oletko varma?';
$string['deleteqtypeareyousuremessage'] = 'Olet poistamassa kysymystyyppiä {$a}. Tämä poistaa kaiken tähän kysymystyyppiin liittyvän tietokannasta. Oletko VARMA että haluat jatkaa?';
$string['deletequestioncheck'] = 'Haluatko varmasti poistaa kohteen \'{$a}\'?';
$string['deletequestionscheck'] = 'Oletko varma että haluat poistaa seuraavat kysymykset? <br /><br />{$a}';
$string['deletingbehaviour'] = 'Poistetaan kysymysten käyttäytyminen \'{$a}\'';
$string['deletingqtype'] = 'Poistetaan kysymystyyppi \'{$a}\'';
$string['disabled'] = 'Pois käytöstä';
$string['disterror'] = 'Jakelu {$a} aiheutti ongelmia';
$string['donothing'] = 'Älä kopioi, siirrä tai vaihda linkkejä.';
$string['editcategories'] = 'Editoi kategorioita';
$string['editcategories_help'] = 'Kaiken yhdessä isossa listassa pitämisen sijaan, kysymykset voidaan järjestää kategorioihin ja alakategorioihin.
Jokaisessa kategoriassa on konteksti, joka määrittelee missä kategorian kysymyksiä voidaan käyttää:
* Aktiviteettikonteksti - Kysymykset, jotka ovat käytettävissä ainoastaan aktiviteettimoduulissa
* Kurssikonteksti - Kysymykset, jotka ovat käytettävissä kaikissa aktiviteettimoduuleissa kurssilla
* Kurssikategoriakonteksti - Kysymykset, jotka ovat käytettävissä kaikissa aktiviteettimoduuleissa ja kaikilla kursseilla tietyssä kurssikategoriassa
* Järjestelmäkonteksti - Kysymykset, jotka ovat käytettävissä sivuston kaikilla kursseilla ja kaikissa aktiviteeteissa
Kategorioita käytetään myös satunnaiskysymyksissä kun kysymykset valitaan tietystä kategoriasta.';
$string['editcategory'] = 'Muokkaa kategoriaa';
$string['editingcategory'] = 'Editoi kategoriaa';
$string['editingquestion'] = 'Editoi kysymystä';
$string['editquestion'] = 'Muokkaa kysymystä';
$string['editquestions'] = 'Muokkaa kysymyksiä';
$string['editthiscategory'] = 'Editoi tätä kategoriaa';
$string['emptyxml'] = 'Tuntematon virhe - tyhjä imsmanifest.xml';
$string['enabled'] = 'Käytössä';
$string['erroraccessingcontext'] = 'Ei pääse asiayhteyteen';
$string['errordeletingquestionsfromcategory'] = 'Virhe poistaessa kysymyksiä kategoriasta {$a}';
$string['errorduringpost'] = 'Jälkikäsittelyn aikana tapahtui virhe!';
$string['errorduringpre'] = 'Esikäsittelyn aikana tapahtui virhe!';
$string['errorduringproc'] = 'Käsittelyn aikana tapahtui virhe!';
$string['errorduringregrade'] = 'Kysymystä {$a->qid} ei voitu uudelleenarvioida; siirrytään tilaan {$a->stateid}.';
$string['errorfilecannotbecopied'] = 'Virhe: ei voi kopioida tiedostoa {$a}.';
$string['errorfilecannotbemoved'] = 'Virhe: ei voi siirtää tiedostoa {$a}.';
$string['errorfileschanged'] = 'Virhe: tiedostot jotka ovat linkitetty kysymyksiin ovat muuttuneet lomakkeen näyttämisen jälkeen.';
$string['errormanualgradeoutofrange'] = 'Kysmyksen {$a->name} arvosana {$a->grade} ei ole 0:n ja {$a->maxgrade} välissä. Tulosta ja komenttia ei tallennettu.';
$string['errormovingquestions'] = 'Virhe siirtäessä kysymyksiä id:llä {$a}.';
$string['errorpostprocess'] = 'Jälkikäsittelyn aikana tapahtui virhe!';
$string['errorpreprocess'] = 'Esikäsittelyn aikana tapahtui virhe!';
$string['errorprocess'] = 'Käsittelyn aikana tapahtui virhe!';
$string['errorprocessingresponses'] = 'Vastauksiasi ({$a}) käsitellessä tapahtui virhe. Klikkaa jatka palataksesi sivulle jolla olit ja yritä uudelleen.';
$string['errorsavingcomment'] = 'Virhe tietokanssa tallentaessa kommenttia kysymykseen {$a->name}.';
$string['errorsavingflags'] = 'Virhe tallennettaessa merkinnän tilaa.';
$string['errorupdatingattempt'] = 'Virhe {$a->id} yrittäessä päivittää tietokantaan.';
$string['exportcategory'] = 'Siirrä ulos kategoria.';
$string['exportcategory_help'] = 'Tämä asetus määrittelee kategorian, josta viedyt kysymykset otetaan.
Jotkin tuontiformaatit, kuten GIFT ja Moodle XML, sallivat kategoria- ja kontekstitiedon sisällyttämisen vientitiedostoon, jolloin ne voidaan (niin haluttaessa) palauttaa tuotaessa tiedosto. Jos vaadittu, tarvittavat valintaruudut pitäisi valita.';
$string['exporterror'] = 'Virheitä tapahtui viennin aikana!';
$string['exportfilename'] = 'tentti';
$string['exportnameformat'] = '%Y%m%d-%H%M';
$string['exportquestions'] = 'Vie kysymykset tiedostoon';
$string['exportquestions_help'] = 'Tällä toiminnolla voi siirtää Moodlesta kokonaisen kysymyskategorian tekstitiedostoon.
Huomaa, että monet tiedostotyypit kadottavat jonkin verran informaatiota kysymyksiä siirrettäessä. Tämä johtuu siitä, että kaikki tiedostotyypit eivät tue kaikkia Moodlen eri tehtävätyypeissä käytettyjä ominaisuuksia. Ei siis kannata odottaa, että Moodleen ja Moodlesta siirretyt kysymystiedostot olisivat identtiset. Tietyt tehtävätyypit eivät välttämättä siirry lainkaan. Kannattaa siis aina tarkistaa Moodlesta siirretyt tiedostot ennen kuin käyttää niitä toisessa tuotantoympäristössä.

Tällä hetkellä Moodle tukee seuraavia tiedostotyyppejä:
**GIFT tiedostotyyppi**
GIFT on kattavin tiedoston vienti- tai tuontimuoto, jolla voi siirtää Moodle tenttikysymyksiä tekstitiedostoon. GIFT on alunperin suunniteltu helpoksi työkaluksi, jolla opettaja voi kirjoittaa kysymyksiä tekstitiedostoon. GIFT tukee monivalintaa, oikein/väärin -kysymyksiä, lyhytvastauksia, yhdistelyä ja numeerisia kysymyksiä, sekä "puuttuva sana" -aukkotehtäviä. Huomaa, että Cloze-aukkotehtäviä ei tällä hetkellä tueta. Erilaisia kysymystyyppejä voi tallentaa samaan tiedostoon ja tietostotyyppi tukee myös rivien kommentointia, kysymysten nimiä, palautetta ja prosentuaalisesti painotettua arvostelua. Esimerkiksi:

Kuka oli Sepeteuksen poikien isä? {=Sepeteus ~Virtanen ~ei kukaan}
Sepeteus oli poikiensa {~veli =isä ~eno}.
Sepeteus oli poikiensa äiti. {FALSE}
Kenen isä Sepeteus oli? {=poikiensa =lastensa}
Koska Suomi itsenäistyi? {#1917}';
$string['feedback'] = 'Palaute';
$string['filecantmovefrom'] = 'Kysymystiedostoja ei voida siirtää, koska sinulla ei ole oikeuksia poistaa tiedostoja niiden alkuperäisestä sijainnista.';
$string['filecantmoveto'] = 'Kysymystiedostoja ei voida siirtää tai kopioida, koska sinulla ei ole oikeuksia lisätä tiedostoja valitsemaasi kohteeseen.';
$string['fileformat'] = 'Tiedostomuoto';
$string['filesareacourse'] = 'Kurssin tiedostoalue';
$string['filesareasite'] = 'Sivuston tiedostoalue';
$string['filestomove'] = 'Siirrä/kopioi tiedostoja {$a}?';
$string['fillincorrect'] = 'Täytä oikeat vastukset';
$string['flagged'] = 'Merkitty';
$string['flagthisquestion'] = 'Merkitse tämä kysymys';
$string['formquestionnotinids'] = 'Lomake sisäsi kysymyksen, jota ei ole kysymys-id:issä';
$string['fractionsnomax'] = 'Yhden vastauksen pitää olla 100%, jotta voidaan antaa täydet pisteet tälle kysymykselle.';
$string['generalfeedback'] = 'Yleinen palaute';
$string['generalfeedback_help'] = 'Yleinen palaute näytetään opiskelijalle kun he ovat vastanneet kysymykseen. Toisin kuin palaute, joka riippuu kysymystyypistä ja opiskelijan vastauksesta, sama yleinen palaute -teksti näytetään kaikille oppilaille.
Voit käyttää yleistä palautetta kertoaksesi oppilaille mitä tietoja kysymys testasi, tai antaaksesi heille linkin lisäinnformaatioon, jota he voivat käyttää jos he eivät ymmärtäneet kysymyksiä.';
$string['getcategoryfromfile'] = 'Hae kategoria tiedostosta';
$string['getcontextfromfile'] = 'Hae asiayhteys tiedostosta';
$string['hidden'] = 'Piilotettu';
$string['hintn'] = 'Vihje {no}';
$string['hinttext'] = 'Vihjeteksti';
$string['howquestionsbehave'] = 'Kysymysten toimintatapa';
$string['howquestionsbehave_help'] = 'Opiskelijat voivat olla tenttikysymysten kanssa vuorovaikutuksessa eri tavoin. Opiskelijat esimerkiksi voivat vastata kaikkiin kysymyksiin ja palauttaa koko tentin ennen kuin vastaukset arvioidaan ja he saavat palautetta. Vaihtoehtoisesti opiskelijat voivat palauttaa joka kysymyksen tentissä erikseen saadakseen välittömän palautteen, ja jos he eivät anna heti oikeata vastausta, he voivat yrittää uudelleen pienemmällä pistemäärällä.';
$string['ignorebroken'] = 'Jätä vialliset linkit huomiotta';
$string['importcategory'] = 'Tuo kategoria';
$string['importcategory_help'] = 'Tämä asetus määrittelee kategorian, johon tuodut kysymykset sijoitetaan.
Jotkin tuontiformaatit, kuten GIFT ja Moodle XML, saattavat sisällyttää kategoria- ja kontekstitiedon tuontitiedostoon. Käyttääksesi tätä tietoa, valitun kategorian sijaan, tarvittavien valintalaatikoiden pitäisi olla valittuna. Jos tuontitiedostossa määriteltyjä kategorioita ei ole, ne luodaan.';
$string['importerror'] = 'Tapahtui virhe tuonnin aikana';
$string['importerrorquestion'] = 'Virhe tuotaessa tiedostoa';
$string['importfromcoursefiles'] = '... tai valitse tuotava kurssitiedosto.';
$string['importfromupload'] = 'Valitse ladattava tiedosto ...';
$string['importingquestions'] = 'Tuodaan {$a} kysymystä tiedostosta';
$string['importparseerror'] = 'Löydettiin virhe(itä) jäsennettäessä tuontitiedostoa. Kysymyksiä ei tuotu. Tuodaksesi kysymyksiä, yritä uudelleen asettaen \'Pysähdy virheessä\' valintaan \'Ei\'';
$string['importquestions'] = 'Tuo kysymyksiä tiedostosta';
$string['importquestions_help'] = 'Tämä toiminto mahdollistaa monessa eri formaatissa olevien kysymysten tuonnin tekstitiedostosta. Huomioi että tiedoston täytyy käyttää UTF-8 koodausta.';
$string['importwrongfiletype'] = 'Valitsemasi tiedoston tyypin ({$a->actualtype}) ei täsmää tämän tuontiformaatin odottamaan tyyppiin ({$a->expectedtype}).';
$string['impossiblechar'] = 'Mahdoton merkki {$a} havaittu sulkumerkkinä';
$string['includesubcategories'] = 'Näytä kysymykset myös alakategorioista';
$string['incorrect'] = 'Väärin';
$string['incorrectfeedback'] = 'Väärille vastauksille';
$string['information'] = 'Informaatio';
$string['invalidanswer'] = 'Puutteellinen vastaus';
$string['invalidarg'] = 'Ei annettu valideja argumentteja tai virheellinen palvelimen konfiguraatio';
$string['invalidcategoryidforparent'] = 'Virheellinen ylätason kategoria-id!';
$string['invalidcategoryidtomove'] = 'Virheellinen siirrettävä kategoria-id!';
$string['invalidconfirm'] = 'Varmistusmerkkijono oli virheellinen';
$string['invalidcontextinhasanyquestions'] = 'Kelpaamaton asiayhteys syötetty question_context_has_any_questions.';
$string['invalidpenalty'] = 'Virheellinen pistevähennys';
$string['invalidwizardpage'] = 'Määritelty virheellinen tai puuttuva wizard-sivu!';
$string['lastmodifiedby'] = 'Viimeinen muokkaaja';
$string['linkedfiledoesntexist'] = 'Linkitetty tiedosto {$a}:ta ei ole olemassa';
$string['makechildof'] = 'Tee lapsiobjekti kohteelle \'{$a}\'';
$string['makecopy'] = 'Tee kopio';
$string['maketoplevelitem'] = 'Siirrä ylemmälle tasolle';
$string['manualgradeoutofrange'] = 'Tämä arvosana on validien raja-arvojen ulkopuolella.';
$string['manuallygraded'] = 'Opettajan arvioima {$a->mark} palautteella: {$a->comment}';
$string['mark'] = 'Pisteet';
$string['markedoutof'] = 'Kokonaispisteet';
$string['markedoutofmax'] = 'Kokonaispisteistä {$a}';
$string['markoutofmax'] = 'Pisteet {$a->mark} kokonaispisteistä {$a->max}';
$string['marks'] = 'Pisteet';
$string['matcherror'] = 'Arvosanat eivät täsmää arviointiasetuksiin - kysymys ohitettu';
$string['matchgrades'] = 'Yhdistä arvosanat';
$string['matchgrades_help'] = 'Tuotujen arvosanojen täytyy täsmätä yhden validin arvosanalistan kanssa - 100, 90, 80, 75, 70, 66.666, 60, 50, 40, 33.333, 30, 25, 20, 16.666, 14.2857, 12.5, 11.111, 10, 5, 0 (myös negatiiviset arvot). Jos ei, on kaksi vaihtoehtoa:
* Virhe jos arvosanaa ei ole listalla - Jos kysymys sisältää arvosanoja, joita ei löydy listalta, näytetään virhe, eikä kysymystä tuoda
* Lähin arvosana jos ei listalla - Jos löydetään arvosana, joka ei täsmää listalla olevien arvojen kanssa, arvosana muutetaan lähinnä sitä olevaan listan arvoon';
$string['matchgradeserror'] = 'Virhe jos arvosanaa ei ole listattu';
$string['matchgradesnearest'] = 'Lähin arvosana jos ei listalla';
$string['missingcourseorcmid'] = 'Täytyy antaa kurssi-id tai cm-id kohteelle print_question';
$string['missingcourseorcmidtolink'] = 'Täytyy antaa kurssi-id tai cm-id kohteelle get_question_edit_link.';
$string['missingimportantcode'] = 'Tästä kysymystyypistä puuttuu tärkeä koodi: {$a}.';
$string['missingoption'] = 'Aukkotehtävästä {$a} puuttuu asetukset';
$string['modified'] = 'Viimeksi tallennettu';
$string['move'] = 'Siirrä {$a}:stä ja muuta linkkejä.';
$string['movecategory'] = 'Siirrä kategoria';
$string['movedquestionsandcategories'] = '{$a->oldplace}:sta {$a->newplace}:n siirretyt kysymykset ja kysymyskategoriat';
$string['movelinksonly'] = 'Vaihda vain mihin linkit osoittavat, älä siirrä tai kopioi tiedostoja.';
$string['moveq'] = 'Siirrä kysymys tai kysymykset';
$string['moveqtoanothercontext'] = 'Siirrä kysymykset toiseen asiayhteyteen.';
$string['moveto'] = 'Siirrä kohteeseen >>';
$string['movingcategory'] = 'Kategoriaa siirretään';
$string['movingcategoryandfiles'] = 'Oletko varma että haluat siirtää kategorian {$a->name} ja kaikki alikategoriat kontekstiin "{$a->contextto}"? Olemme havainneet {$a->urlcount} tiedostoja linkitettynä kysymyksistä {$a->fromareaname}, haluatko kopioida tai siirtää nämä {$a->toareaname}?';
$string['movingcategorynofiles'] = 'Oletko varma että haluat siirtää kategorian "{$a->name}" ja kaikki alikategoriat "{$a->contextto}" asiayhteyteen?';
$string['movingquestions'] = 'Kysymyksiä ja tiedostoja siirretään';
$string['movingquestionsandfiles'] = 'oletko varma, että haluat siirtää kysymykset {$a->questions} asiayhteyteen <strong>"{$a->tocontext}"</strong>? <br>
olemme havainneet <strong>{$a->urlcount} tiedostojen</strong> olevan linkitettynä näistä kysymyksistä {$a->fromareaname}, haluatko kopioida tai siirtää nämä tänne: {$a->toareaname}?';
$string['movingquestionsnofiles'] = 'Oletko varma, että haluat siirtää kysymykset {$a->questions} asiayhteyteen <strong>"{$a->tocontext}"</strong>? Yhtään tiedostoa ei ole linkitettynä näistä kysymyksistä {$a->fromareaname}.';
$string['needtochoosecat'] = 'Siirtääksesi tämän kysymyksen sinun täytyy valita kategoria tai paina Peruuta.';
$string['nocate'] = 'Ei sellaista kategoriaa {$a}!';
$string['nopermissionadd'] = 'Sinulla ei ole lupaa lisätä kysymyksiä tänne.';
$string['nopermissionmove'] = 'Sinulla ei ole lupaa siirtää kysymyksiä täältä. Sinun täytyy tallentaa kysymys tähän kategoriaan tai tallentaa se uutena kysymyksenä.';
$string['noprobs'] = 'Tietokannastasi ei löytynyt ongelmia.';
$string['noquestionsinfile'] = 'Tuontitiedostosta ei löydy kysymyksiä';
$string['noresponse'] = '[Ei vastausta]';
$string['notanswered'] = 'Ei vastattu';
$string['notenoughanswers'] = 'Tämän tyypin kysymys vaatii vähintään {$a} vastausta';
$string['notenoughdatatoeditaquestion'] = 'Kysymyksen id tai kategorian id ja kysymyksen tyyppiä ei ole määritelty.';
$string['notenoughdatatomovequestions'] = 'Sinun täytyy hankkia kysymys id:t kysymyksille jotka halluat siirtää.';
$string['notflagged'] = 'Ei merkitty';
$string['notgraded'] = 'Ei arvioitu';
$string['notshown'] = 'Ei näytetty';
$string['notyetanswered'] = 'Ei vielä vastattu';
$string['notyourpreview'] = 'Tämä esikatselu ei kuulu sinulle';
$string['novirtualquestiontype'] = 'Ei virtuaalista kysymystyyppiä kysymystyypille {$a}';
$string['numqas'] = 'Vastausten määrä';
$string['numquestions'] = 'Kysymysten määrä';
$string['numquestionsandhidden'] = '{$a->numquestions} (+{$a->numhidden} piilotettu(a))';
$string['options'] = 'Asetukset';
$string['page-question-category'] = 'Kysymyskategoriasivu';
$string['page-question-edit'] = 'Kysymyksen muokkaussivu';
$string['page-question-export'] = 'Kysymyksen vientisivu';
$string['page-question-import'] = 'Kysymyksen tuontisivu';
$string['page-question-x'] = 'Kaikki kysymyssivut';
$string['parent'] = 'Yläkategoria';
$string['parentcategory'] = 'Yläkategoria';
$string['parentcategory_help'] = 'Tämä yläkategoria on se, mihin uusi kategoria sijoitetaan. "Ylä" tarkoittaa että tämä kategoria ei sisälly muihin kategorioihin. Kategoriakontekstit näytetään lihavoituna. Jokaisessa kontekstissa täytyy olla ainakin yksi kategoria.';
$string['parenthesisinproperclose'] = 'Sulkuja ennen ** ei ole oikein suljettu kohteessa {$a}**';
$string['parenthesisinproperstart'] = 'Sulkuja ennen ** ei ole oikein aloitettu kohteessa {$a}**';
$string['parsingquestions'] = 'Jäsennetään kysymyksiä tuontitiedostosta.';
$string['partiallycorrect'] = 'Osittain oikein';
$string['partiallycorrectfeedback'] = 'Kaikille osittain oikeille vastauksille';
$string['penaltyfactor'] = 'Vähennyskerroin';
$string['penaltyfactor_help'] = 'Tällä asetuksella määrittelet, paljonko vääristä vastauksista vähennetään osapisteitä. Asetusta voi käyttää ainoastaan kun käytät tentissä mukautuvia kysymyksiä.
Vähennyskerroin on luku suljetulta väliltä 0-1. Vähennyskerroin 1 tarkoittaa, että opiskelijan on osattava vastata oikein ensimmäisellä vastauskerralla saadakseen tehtävästä pisteitä. Vähennyskerroin 0 tarkoittaa, että opiskelija voi yrittää tehtävää niin monta kertaa kuin haluaa ja oikein vastatessaan saa silti täydet pisteet.';
$string['penaltyforeachincorrecttry'] = 'Pistevähennys jokaisesta virheellisestä vastauksesta';
$string['penaltyforeachincorrecttry_help'] = 'Jos käytät mukautuvia kysymyksiä, joissa opiskelija saa yrittää samaa tehtävää useita kertoja, tällä asetuksella säätelet miten vääristä vastauksista rangaistaan.
Vähennys on suhteessa tehtävän alkuperäiseen pistemäärään. Jos tehtävästä saa 3p ja vähennys on 0,3333333, opiskelija saa oikeasta vastauksesta ensimmäisellä yrittämällä 3p, toisella yrittämällä 2p ja kolmannella yrittämällä 1p.';
$string['permissionedit'] = 'Muokata tätä kysymystä';
$string['permissionmove'] = 'Siirtää tämä kysymys';
$string['permissionsaveasnew'] = 'Tallentaa tämä kysymys uutena kysymyksenä';
$string['permissionto'] = 'Sinulla on oikeus:';
$string['previewquestion'] = 'Esikatsele kysymystä: {$a}';
$string['published'] = 'jaettu';
$string['qbehaviourdeletefiles'] = 'Kaikki kysymykseen \'{$a->behaviour}\' liittyvä data on poistettu tietokannasta. Viimeistelläksesi poiston ja estääksesi itsenäisen uudelleenasennuksen, poista vielä tämä hakemisto: {$a->directory}';
$string['qtypedeletefiles'] = 'Kaikki kysymystyyppiin \'{$a->qtype}\' liittyvä data on poistettu tietokannasta. Viimeistelläksesi poiston ja estääksesi itsenäisen uudelleenasennuksen, poista vielä tämä hakemisto: {$a->directory}';
$string['qtypeveryshort'] = 'T';
$string['questionaffected'] = '<a href="{$a->qurl}">Kysymys "{$a->name}" ({$a->qtype})</a> on tässä kysymyskategoriassa, mutta sitä myös käytetään <a href="{$a->qurl}">kyselyssä "{$a->quizname}"</a> toisessa kurssissa "{$a->coursename}".';
$string['questionbank'] = 'Kysymyspankki';
$string['questionbehaviouradminsetting'] = 'Kysymysten käyttäytymisen asetukset';
$string['questionbehavioursdisabled'] = 'Estettävät kysymysten käyttäytymiset';
$string['questionbehavioursdisabledexplained'] = 'Kirjoita pilkuilla erotettu lista toiminnoista, joiden et halua näkyvän pudotusvalikossa';
$string['questionbehavioursorder'] = 'Kysymysten käyttäytymisten järjestys';
$string['questionbehavioursorderexplained'] = 'Kirjoita pilkuilla erotettu lista toiminnoista siinä järjestyksessä, jossa haluat niiden näkyvän pudotusvalikossa';
$string['questioncategory'] = 'Kysymyskategoria';
$string['questioncatsfor'] = 'Kysymyskategoriat kohteelle \'{$a}\'';
$string['questiondoesnotexist'] = 'Kysymystä ei ole olemassa';
$string['questionidmismatch'] = 'Kysymys-id:t ovat yhteensopimattomia';
$string['questionname'] = 'Kysymyksen nimi';
$string['questionno'] = 'Kysymys {$a}';
$string['questions'] = 'Kysymykset';
$string['questionsaveerror'] = 'Kysymystä tallennettaessa tapahtui virhe - ({$a})';
$string['questionsinuse'] = '(* Tähdellä merkityt kysymykset ovat jo käytössä joissakin tenteissä. Näitä kysymyksiä ei poisteta tenteistä vaan ainoastaan kategorialistalta.)';
$string['questionsmovedto'] = 'Käytössä olevat kysymykset on siirretty {$a} ylempään kurssikategoriaan.';
$string['questionsrescuedfrom'] = 'Kysymykset tallennettu asiayhteydestä {$a}.';
$string['questionsrescuedfrominfo'] = 'Kun asiayhteys poistettiin, nämä kysymykset tallennettiin, koska ne voivat olla käytössä.';
$string['questiontext'] = 'Kysymysteksti';
$string['questiontype'] = 'Kysymystyyppi';
$string['questionuse'] = 'Käytä kysymystä tässä aktiviteetissa';
$string['questionvariant'] = 'Kysymysvariantti';
$string['questionx'] = 'Kysymys {$a}';
$string['requiresgrading'] = 'Vaatii arvioinnin';
$string['responsehistory'] = 'Vastaushistoria';
$string['restart'] = 'Aloita uudelleen';
$string['restartwiththeseoptions'] = 'Aloita uudelleen näillä asetuksilla';
$string['reviewresponse'] = 'Esikatsele vastausta';
$string['rightanswer'] = 'Oikea vastaus';
$string['saved'] = 'Tallennettu: {$a}';
$string['saveflags'] = 'Tallenna kysymysmerkintöjen tila';
$string['selectacategory'] = 'Valitse kategoria:';
$string['selectaqtypefordescription'] = 'Valitse kysymystyyppi nähdäksesi sen kuvauksen.';
$string['selectcategoryabove'] = 'Valitse kategoria ylhäältä';
$string['selectquestionsforbulk'] = 'Valitse kysymykset massatoiminnoille';
$string['settingsformultipletries'] = 'Useiden suorituskertojen asetukset';
$string['shareincontext'] = 'Jaa asiayhteys {$a}:lle';
$string['showhidden'] = 'Näytä myös vanhat kysymykset';
$string['showmarkandmax'] = 'Näytä pisteet ja maksimi';
$string['showmaxmarkonly'] = 'Näytä vain maksimipisteet';
$string['shown'] = 'Näytetty';
$string['shownumpartscorrect'] = 'Näytä oikeiden vastausten määrä';
$string['shownumpartscorrectwhenfinished'] = 'Näytä oikeiden vastausten määrä';
$string['showquestiontext'] = 'Näytä kysymysteksti kysymyslistalla';
$string['specificfeedback'] = 'Erityinen palaute';
$string['started'] = 'Aloitettu';
$string['state'] = 'Tila';
$string['step'] = 'Askel';
$string['stoponerror'] = 'Pysähdy virheessä';
$string['stoponerror_help'] = 'Tämä asetus määrittelee pysähtyykö tuontiprosessi kun virhe havaitaan, jolloin kysymyksiä ei tuoda, vai ohitetaanko virheelliset kysymykset ja validit kysymykset tuodaan.';
$string['submissionoutofsequence'] = 'Pääsy poissa sekvenssistä. Ole hyvä äläkä paina edellinen-painiketta kun työskentelet tenttikysymysten kanssa.';
$string['submissionoutofsequencefriendlymessage'] = 'Olet syöttänyt tietoa normaalin sarjan ulkopuolelta. Näin voi tapahtua jos käytät selaimesi Siirry Taaksepäin/Eteenpäin -painikkeita; ole hyvä äläkä käytä näitä testin aikana. Näin voi tapahtua myös jos klikkaat jotain samalla kun sivu latautuu. Klikkaa <strong>Jatka</strong> siirtyäksesi eteenpäin.';
$string['submit'] = 'Palauta';
$string['submitandfinish'] = 'Palauta ja lopeta';
$string['submitted'] = 'Palauta: {$a}';
$string['tofilecategory'] = 'Kirjoita kategoria tiedostoon';
$string['tofilecontext'] = 'Kirjoita asiayhteys tiedostoon';
$string['uninstallbehaviour'] = 'Poista tämän kysymysten käyttäytymisen asennus.';
$string['uninstallqtype'] = 'Poista tämän kysymystyypin asennus.';
$string['unknown'] = 'Tuntematon';
$string['unknownbehaviour'] = 'Tuntematon käyttäytyminen: {$a}.';
$string['unknownquestion'] = 'Tuntematon kysymys: {$a}.';
$string['unknownquestioncatregory'] = 'Tuntematon kysymyskategoria: {$a}.';
$string['unknownquestiontype'] = 'Tuntematon kysymystyyppi';
$string['unknowntolerance'] = 'Tuntematon toleranssityyppi {$a}';
$string['unpublished'] = 'Jakamaton';
$string['upgradeproblemcategoryloop'] = 'Havaittiin virhe päivitettäessä kysymyskategorioita. Kategoriapuussa on silmukka. Vaikutuksen kohteena olevat id:t ovat {$a}.';
$string['upgradeproblemcouldnotupdatecategory'] = 'Ei voitu päivittää kysymyskategoriaa {$a->name} ({$a->id}).';
$string['upgradeproblemunknowncategory'] = 'Havaittiin virhe päivitettäessä kysymyskategorioita. Kategoria {$a->id} viittaa yläkategoriaan {$a->parent}, jota ei ole olemassa. Yläkategoriaa muutettiin ongelman korjaamiseksi.';
$string['whethercorrect'] = 'Jos oikein';
$string['withselected'] = 'Valituilla';
$string['wrongprefix'] = 'Väärin muotoiltu nimen etuliite {$a}';
$string['xoutofmax'] = '{$a->mark} maksimista {$a->max}';
$string['yougotnright'] = 'Olet valinnut oikein {$a->num}.';
$string['youmustselectaqtype'] = 'Sinun täytyy valita kysymystyyppi.';
$string['yourfileshoulddownload'] = 'Vientitiedostosi lataaminen alkaa pian. Jos ei, napsauta <a href="{$a}">tästä</a>.';
