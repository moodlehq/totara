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
 * Strings for component 'quiz', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   quiz
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessnoticesheader'] = 'Voit esikatsella tätä tenttiä, mutta jos tämä olis oikea suoritus, sinut olisi estetty, koska:';
$string['action'] = 'Toiminto';
$string['adaptive'] = 'Mukautuva tentti ja kysymykset';
$string['adaptive_help'] = '## Mukautuva tentti ja kysymykset
Tällä asetuksella mahdollistetaan sekä koko tentin mukautuvuus opiskelijan vastauksiin että yksittäiset kysymykset, jotka ohjaavat opiskelijan jatkotyöskentelyä hänen vastaustensa perusteella. Jos et halua, että opiskelijat näkevät tuloksiaan jo kesken tentin, valitse tähän asetukseen **Ei** ja säädä haluamasi tentin tallentamisen jälkeinen tulosten näkyvyys asetussivun rasti ruutuun -matriisista.
#### A Mukautuva tentti
Asetuksen ollessa **Kyllä** opiskelijalle sallitaan uusintavastaukset kysymyksiin jo tenttisuorituksen aikana. Tällöin kunkin kysymyksen alle tulee oma **\*|\*-painikkeensa, jota painamalla opiskelija palauttaa ko. kysymyksen vastauksen ja saa arvioinnin samantien. Eli jos opiskelijan vastaus on osittainkin väärä, hän voi palautteen perusteella vastata uudestaan samantien. Vääristä vastauksista on mahdollista vähentää pisteitä, ja tämä asetus määritellään seuraavassa Arvioinnit-kohdassa.
#### B Mukautuvat kysymykset
Tämä asetus mahdollistaa myös sellaiset mukautuvat kysymykset, jotka päivittävät osion jatkoa reaktiona opiskelijan vastauksiin. IMS:n QTI-spesifikaatio määrittelee mukautuvat kysymykset / osiot näin:
>
> Mukautuvassa osiossa mukautetaan joko osion ulkoasua, vastauksen aiheuttamia jatkotoimenpiteitä tai molempia reaktiona opiskelijan suoritukseen. Mukautuva osio voi esimerkiksi alkaa vapaalla tekstivastauksella, ja jos vastaus ei ole riittävä, osio voi jatkua helpottuen monivalinnaksi, josta ehkä vastaavasti on saatavissa vähemmän pisteitä kuin vapaasta tekstivastauksesta. Mukautuvat osiot mahdollistavat formatiivisen suorituksen sekä ohjaamalla opiskelijan tehtävän läpi että mahdollistamalla tuloksen, jossa huomioidaan opiskelijan oppimispolku.
Kun kysymys on mukautuva, se huomioi opiskelijan vastauksen ja saattaa pyytää täydennystä. Yksinkertaisimmissa mukautuvissa kysymyksissä vastaukseen reagointi tarkoittaa vain eroja palauteteksteissä ja mahdollista pyyntöä yrittää uudelleen; monimutkaisemmissa kysymyksissä myös kysymystekstit ja vuorovaikutteiset elementit voivat olla erilaiset.';
$string['addaquestion'] = 'Lisää kysymys ...';
$string['addarandomquestion'] = 'Lisää satunnainen kysymys ...';
$string['addarandomquestion_help'] = 'Kun lisätään satunnainen kysymys, tuloksena on satunnaisesti valittu kysymys tenttiin lisätystä kategoriasta. Tämä tarkoittaa, että eri opiskelijoilla on luultavasti eri valikoima kysymyksiä. Jos tentti sallii useita suorituskertoja, joka suorituskerralla on luultavasti eri kysymykset.';
$string['adddescriptionlabel'] = 'Lisää kuvaus/otsikko';
$string['addingquestion'] = 'Lisätään kysymys';
$string['addingquestions'] = 'Täällä sivun oikealla puolella voit hallinnoida kysymysvarastoasi. Kysymykset on tallennettu kategorioihin ja niitä voi käyttää missä tahansa tentissä ja vaikka aivan eri kurssilla, jos julkaiset ne. <br /><br /> Kun olet valinnut tai luonut kysymyskategorian, voit editoida tai luoda kysymyksiä. Voit valita minkä tahansa kysymyksen ja lisätä sen sivun vasemmalla puolella olevaan tenttiin.';
$string['addmoreoverallfeedbacks'] = 'Lisää {no} palautekenttää';
$string['addnewgroupoverride'] = 'Lisää ryhmälle poikkeuspääsy tenttiin';
$string['addnewpagesafterselected'] = 'Lisää uusia sivuja valittujen kysymysten jälkeen';
$string['addnewquestionsqbank'] = 'Lisää kysymyksiä kategoriaan {$a->catname}: {$a->link}';
$string['addnewuseroverride'] = 'Lisää osallistujille poikkeuspääsy tenttiin';
$string['addpagehere'] = 'Lisää sivu tähän';
$string['addquestion'] = 'Lisää kysymys';
$string['addquestions'] = 'Lisää kysymyksiä';
$string['addquestionstoquiz'] = 'Lisää kysymykset tähän tenttiin';
$string['addrandom'] = 'Lisää {$a} satunnaista kysymystä';
$string['addrandom1'] = '<< Lisää';
$string['addrandom2'] = 'satunnaista kysymystä';
$string['addrandomfromcategory'] = 'Lisää satunnaiset kysymykset kategoriasta:';
$string['addrandomquestion'] = 'Lisää satunnainen kysymys';
$string['addrandomquestiontoquiz'] = 'Lisää satunnainen kysymys tenttiin {$a}';
$string['addselectedtoquiz'] = 'Lisää valittu tenttiin';
$string['addtoquiz'] = 'Lisää tenttiin';
$string['affectedstudents'] = 'Vaikuttaa {$a}';
$string['aftereachquestion'] = 'Joka kysymyksen lisäämisen jälkeen';
$string['afternquestions'] = '{$a}:n kysymyksen lisäämisen jälkeen';
$string['age'] = 'ikä';
$string['allattempts'] = 'Kaikki suorituskerrat';
$string['allinone'] = 'Ei rajoitettu';
$string['allowreview'] = 'Salli tarkastelu';
$string['alreadysubmitted'] = 'Näyttäisi siltä, että olet jo lähettänyt tämän vastauksen.';
$string['alternativeunits'] = 'Vaihtoehtoiset yksiköt';
$string['alwaysavailable'] = 'Aina esillä';
$string['analysisoptions'] = 'Tilastoinnin asetukset';
$string['analysistitle'] = 'Kohteen tilastointitaulukko';
$string['answer'] = 'Vastaus';
$string['answered'] = 'Vastattu';
$string['answerhowmany'] = 'Yksi vai useita vaihtoehtoja?';
$string['answers'] = 'Vaihtoehdot';
$string['answersingleno'] = 'Salli usea vaihtoehto';
$string['answersingleyes'] = 'Vain yksi vaihtoehto';
$string['answerswithacceptederrormarginmustbenumeric'] = 'Vain numeeriset arvot kelpaavat vastauksiin, joihin on määritetty hyväksyttävä virhe';
$string['answertoolong'] = 'Vastaus liian pitkä rivin {$a} jälkeen (255 merkkiä on maksimi).';
$string['aon'] = 'AON-muotoilu';
$string['areyousureremoveselected'] = 'Oletko varma että haluat poistaa kaikki valitut kysymykset?';
$string['asshownoneditscreen'] = 'Muokkaustilassa näkyvä järjestys';
$string['attempt'] = 'Suorituskerta {$a}';
$string['attemptalreadyclosed'] = 'Tämä suoritus on jo valmis.';
$string['attemptclosed'] = 'Suorituskerta ei ole vielä sulkeutunut';
$string['attemptduration'] = 'Suorituksen kesto';
$string['attemptedon'] = 'Yritetty';
$string['attempterror'] = 'Et voi yrittää tätä tenttiä nyt, koska: {$a}';
$string['attemptfirst'] = 'Ensimmäinen suorituskerta';
$string['attemptincomplete'] = 'Suoritus (tekijä {$a}) ei ole vielä valmis.';
$string['attemptlast'] = 'Viimeisin suoritus';
$string['attemptnumber'] = 'Suorituskerta';
$string['attemptquiznow'] = 'Tee tentti nyt';
$string['attempts'] = 'Suorituskerrat';
$string['attemptsallowed'] = 'Montako suorituskertaa sallitaan?';
$string['attemptsdeleted'] = 'Tentin suorituskerrat poistettu';
$string['attemptselection'] = 'Valitse käyttäjien kohdalla tilastoinnissa käytettävät suorituskerrat:';
$string['attemptsexist'] = 'Et voi enää lisätä tai muokata kysymyksiä; tenttiin on jo vastattu.';
$string['attemptsnum'] = 'Suorituksia: {$a}';
$string['attemptsnumthisgroup'] = 'Suorituksia: {$a->total} ({$a->group} tästä ryhmästä)';
$string['attemptsnumyourgroups'] = 'Suorituksia: {$a->total} ({$a->group} omasta ryhmästäsi)';
$string['attemptsonly'] = 'Näytä vain vastanneet opiskelijat';
$string['attemptstillinprogress'] = 'Keskeneräiset suoritukset';
$string['attemptsunlimited'] = 'Rajattomasti suorituskertoja';
$string['back'] = 'Takaisin esikatseluun';
$string['backtocourse'] = 'Takaisin kurssille';
$string['backtoquestionlist'] = 'Takaisin kysymyslistaan';
$string['backtoquiz'] = 'Takaisin tenttien muokkaukseen';
$string['basicideasofquiz'] = 'Tentin rakentamisen perusajatukset';
$string['bestgrade'] = 'Paras arvosana';
$string['bothattempts'] = 'Näytä vastanneet ja vastaamatta olevat opiskelijat';
$string['browsersecurity'] = 'Selaimen tietoturva';
$string['browsersecurity_help'] = '## Näytä "suojatussa" ikkunassa
"Suojatulla" ikkunalla rajoitetaan hieman opiskelijan selaimen käyttöä siten, että tentissä huijaaminen ja tekstin suora kopiointi hankaloituu. Javascriptin on oltava päällä selaimessa.
Suojauksella:
* Tentti näytetään omassa, koko ruudun selainikkunassaan.
* Osa hiiren toiminnoista on estetty.
* Osa näppäimistökomennoista on estetty.

HUOM: **Tämä suojaus ei ole vedenpitävä**. Älä luota tähän suojaukseen ainoana suojauskeinona, jos epäilet opiskelijoidesi huijaavan. Verkkoympäristössä on mahdotonta tehdä aukotonta suojausta. Lisävarmistuksena voit esimerkiksi luoda kysymyksistä ison tietokannan, josta arvotaan satunnaisia kysymyksiä. Tai mieti arviointikriteereitäsi uudestaan siten, että opiskelijoiden konstruktiivisella toiminnalla, kuten keskusteluaktiivisuudella, sanastotyöskentelyllä, wiki-aktiivisuudella, tuntiaktiivisuudella tai tehtävillä on merkitystä arvioinnissa.';
$string['calculated'] = 'Lasku';
$string['calculatedquestion'] = 'Laskutehtävää ei ole tuettu rivillä {$a}. Kysymystä ei huomioida.';
$string['cannotcreatepath'] = 'Polkua ei voi luoda ({$a})';
$string['cannoteditafterattempts'] = 'Et voi lisätä tai poistaa kysymyksiä koska tähän tenttiin on jo vastattu. ({$a})';
$string['cannotfindprevattempt'] = 'Aiempaa suoritusta ei löydy pohjaksi.';
$string['cannotfindquestionregard'] = 'Ei voitu hakea kysymyksiä uudelleenarvioitavaksi!';
$string['cannotinsert'] = 'Kysymystä ei voitu sijoittaa';
$string['cannotinsertrandomquestion'] = 'Ei voitu lisätä uutta satunnaista kysymystä!';
$string['cannotloadquestion'] = 'Ei voitu ladata kysymysvaihtoehtoja';
$string['cannotloadtypeinfo'] = 'Ei voida ladata kysymystyypin mukaista kysymystietoa';
$string['cannotopen'] = 'Vientitiedostoa ei voitu luoda ({$a})';
$string['cannotrestore'] = 'Ei voitu palauttaa kysymyssessioita';
$string['cannotreviewopen'] = 'Et voi katsella tätä suoritusta, se on vielä auki';
$string['cannotsavelayout'] = 'Ei voitu tallentaa asettelua';
$string['cannotsavenumberofquestion'] = 'Ei voitu tallentaa kysymysten määrää per sivu';
$string['cannotsavequestion'] = 'Ei voida tallentaa kysymyslistaa';
$string['cannotsetgrade'] = 'Ei voitu asettaa tentille uutta arvosanan ylärajaa';
$string['cannotsetsumgrades'] = 'Ei onnistuttu asettamaan yhteenlaskettuja arvosanoja';
$string['cannotstartgradesmismatch'] = 'Tentin suoritusta ei voida käynnistää. Tenttiin on määritelty maksimipistemäärä {$a->grade}, mutta yhteenkään tentin kysymykseen ei ole määritelty pisteitä. Korjaa tilanne sivulla "Muokkaa tenttiä".';
$string['cannotstartmissingquestion'] = 'Tenttiä ei voi aloittaa. Tentin määritelmä sisältää kysymyksen, jota ei ole.';
$string['cannotstartnoquestions'] = 'Tentin suoritusta ei voida käynnistää; tenttiin ei ole vielä lisätty kysymyksiä.';
$string['cannotwrite'] = 'Vientitiedostoa ei voitu kirjoittaa';
$string['caseno'] = 'Ei, kirjainkoolla ei ole merkitystä';
$string['casesensitive'] = 'Kirjainkoon merkitys';
$string['caseyes'] = 'Kyllä, kirjainkoon pitää täsmätä';
$string['categories'] = 'Kategoriat';
$string['category'] = 'Kategoria';
$string['categoryadded'] = 'Kategoria \'{$a}\' lisätty';
$string['categorydeleted'] = 'Kategoria \'{$a}\' poistettu';
$string['categorynoedit'] = 'Sinulla ei ole muokkausoikeutta kategoria {$a}ssa.';
$string['categoryupdated'] = 'Kategoria päivitettiin onnistuneesti';
$string['close'] = 'Sulje ikkuna';
$string['closebeforeopen'] = 'Tentin päivittäminen ei onnistu. Päättymispäivä on ennen alkamispäivää.';
$string['closed'] = 'Suljettu';
$string['closepreview'] = 'Sulje esikatselu';
$string['closereview'] = 'Sulje katselu';
$string['comment'] = 'Kommentti';
$string['commentorgrade'] = 'Kommentoi tai arvioi uudelleen';
$string['comments'] = 'Kommentit';
$string['completedon'] = 'Valmis';
$string['configadaptive'] = 'Jos valitset tähän asetukseen Kyllä, opiskelijalle sallitaan monta vastausta kysymykseen jopa samalla tentin suorituskerralla.';
$string['configattemptsallowed'] = 'Rajoitus tentin suorituskertoihin.';
$string['configdecimaldigits'] = 'Desimaalien määrä arvosanoissa.';
$string['configdecimalplaces'] = 'Desimaalien määrä tentin arvosanoissa.';
$string['configdecimalplacesquestion'] = 'Desimaalien määrä yksittäisten kysymysten arvosanoissa.';
$string['configdelay1'] = 'Jos asetat aikaviiveen, opiskelijan täytyy odottaa kyseisen ajan verran, ennen kuin hän voi tehdä tentin ensimmäisen suorituskerran jälkeen uudestaan.';
$string['configdelay1st2nd'] = 'Tällä aikaviiveellä rajoitat opiskelijan  toisen suorituskerran aloitusta siihen kunnes tämän verran aikaa on kulunut ensimmäisen suorituskerran lopetuksesta.';
$string['configdelay2'] = 'Jos asetat aikaviiveen tässä, opiskelijan täytyy odottaa kyseisen ajan verran, ennen kolmatta tai sen jälkeisiä suorituskertoja.';
$string['configdelaylater'] = 'Jos asetat aikaviiveen tässä, opiskelijan täytyy odottaa kyseisen ajan verran, ennen kolmatta tai sen jälkeisiä suorituskertoja.';
$string['configeachattemptbuildsonthelast'] = 'Jos sallit useita suorituskertoja, jokainen uusi suoritus sisältää edellisen suorituksen tulokset.';
$string['configgrademethod'] = 'Mitä tapaa pitäisi käyttää laskettaessa opiskelijan lopullinen tentin arvosana, kun useat suorituskerrat on sallittu.';
$string['configintro'] = 'Tässä antamasi arvot määrittelevät oletusarvot, joita käytetään asetuksissa kun luot uuden tentin. Voit myös määrittää mitkä tentin asetukset ovat lisäasetuksia.';
$string['configmaximumgrade'] = 'Tentin oletus maksimiarvosana.';
$string['confignewpageevery'] = 'Kun tenttiin lisätään kysymyksiä, lisätään tenttiin sivunvaihdot automaattisesti tämän asetuksen mukaan.';
$string['configpenaltyscheme'] = 'Mukautuvaa tenttiä käytettäessä jokaisesta väärästä vastauksesta vähennettävä rangaistus.';
$string['configpopup'] = 'Pakota tentti avautumaan ponnahdusikkunassa ja yritä käyttää JavaScriptiä estämään kopioi ja liitä ym. toiminnot tentin aikana.';
$string['configrequirepassword'] = 'Opiskelijoiden on annettava tämä salasana ennen kuin he voivat tehdä tentin.';
$string['configrequiresubnet'] = 'Opiskelijat voivat tehdä tentin vain näiltä tietokoneilta.';
$string['configreviewoptions'] = 'Nämä asetukset määrittelevät mitä tietoa käyttäjät näkevät, kun he katsovat tentin yksittäisiä suorituksia tai tulosraportteja.';
$string['configshowblocks'] = 'Näytä lohkot tentin aikana.';
$string['configshowuserpicture'] = 'Näytä käyttäjän kuva ruudulla tentin aikana.';
$string['configshufflequestions'] = 'Jos otat käyttöön tämän asetuksen, sekoitetaan tentin kysymykset joka kerta kun opiskelija yrittää tenttiä.';
$string['configshufflewithin'] = 'Jos otat käyttöön tämän asetuksen, yksittäisten kysymysten eri osat sekoitetaan joka kerta kun opiskelija yrittää tenttiä, jos asetus on käytössä myös kysymysasetuksissa.';
$string['configtimelimit'] = 'Oletuskesto tenteille minuuteissa. 0 tarkoittaa ettei rajaa ole.';
$string['configtimelimitsec'] = 'Oletuskesto tenteille sekunneissa. 0 tarkoittaa ettei rajaa ole.';
$string['configurerandomquestion'] = 'Määritä kysymys';
$string['confirmclose'] = 'Kun palautat tentin, et voi muuttaa vastauksiasi.';
$string['confirmserverdelete'] = 'Oletko varma, että haluat poistaa palvelimen  <b>{$a}</b> listalta?';
$string['confirmstartattemptlimit'] = 'Sallitut suorituskerrat: {$a}. Olet aloittamassa uutta suoritusta. Haluatko jatkaa?';
$string['confirmstartattempttimelimit'] = 'Tässä tentissä on aikaraja ja suoritusten määrä on rajoitettu {$a} kertaan. Haluatko jatkaa?';
$string['confirmstarttimelimit'] = 'Tässä tentissä on rajattu suoritusaika. Haluatko aloittaa tentin?';
$string['containercategorycreated'] = 'Tämä kategoria luotiin alkuperäisten kategorioiden tallentamiseksi. Alkuperäiset kategoriat siirrettiin sivuston tasolle alla kerrotuista syistä.';
$string['continueattemptquiz'] = 'Jatka viimeisintä suoritusta.';
$string['continuepreview'] = 'Jatka edellistä esikatselua';
$string['copyingfrom'] = 'Luodaan kopio kysymyksestä \'{$a}\'';
$string['copyingquestion'] = 'Kysymystä kopioidaan';
$string['correct'] = 'Oikein';
$string['correctanswer'] = 'Oikea vastaus';
$string['correctanswerformula'] = 'Oikea ratkaisukaava';
$string['correctansweris'] = 'Oikea vastaus: {$a}';
$string['correctanswerlength'] = 'Merkitsevät arvot';
$string['correctanswers'] = 'Oikeat vastaukset';
$string['correctanswershows'] = 'Näytä oikea vastaus';
$string['corrresp'] = 'Oikea vastaus';
$string['countdown'] = 'Laskenta';
$string['countdownfinished'] = 'Tentti sulkeutuu, lähetä vastauksesi nyt.';
$string['countdowntenminutes'] = 'Tentti sulkeutuu kymmenen minuutin kuluttua.';
$string['coursetestmanager'] = 'Course Test Manager-muotoilu';
$string['createcategoryandaddrandomquestion'] = 'Luo kategoria ja lisää satunnainen kysymys';
$string['createfirst'] = 'Sinun on ensin luotava kysymyksiä.';
$string['createmultiple'] = 'Lisää useita satunnaisia kysymyksiä tenttiin';
$string['createnewquestion'] = 'Luo uusi kysymys';
$string['createquestionandadd'] = 'Luo uusi kysymys ja lisää se tenttiin.';
$string['custom'] = 'Mukautettu muoto';
$string['dataitemneed'] = 'Sinun pitää lisätä vähintään yksi kysymys, jotta kysymys voidaan tallentaa.';
$string['datasetdefinitions'] = 'Uudelleenkäytettävät tietojoukkojen määritykset kategoriassa {$a}';
$string['datasetnumber'] = 'Numero';
$string['daysavailable'] = 'Päivää esillä';
$string['decimaldigits'] = 'Desimaalien määrä arvosanoissa';
$string['decimalplaces'] = 'Desimaalien määrä arvosanoissa';
$string['decimalplaces_help'] = '## Desimaalien määrä
Tämä asetus määrittää desimaalien määrän pisteiden ja arvosanojen näkyessä näytöllä. Esim. \'0\' esittää pisteet kokonaislukuina.
Asetus vaikuttaa vain arvosanojen näyttämiseen näytöllä. Sillä ei ole vaikutusta laskutoimituksiin tai arvosanojen pyöristämiseen.';
$string['decimalplacesquestion'] = 'Desimaalien määrä kysymysten arvosanoissa';
$string['decimalplacesquestion_help'] = '## Desimaalien määrä
Tämä asetus määrittää desimaalien määrän pisteiden ja arvosanojen näkyessä näytöllä *kullekin kysymykselle*. Esim. \'0\' esittää pisteet kokonaislukuina.
Asetus vaikuttaa vain arvosanojen näyttämiseen näytöllä. Sillä ei ole vaikutusta laskutoimituksiin tai arvosanojen pyöristämiseen.';
$string['decimalpoints'] = 'Desimaalien määrä';
$string['default'] = 'Oletus';
$string['defaultgrade'] = 'Oletusarviointi kysymyksille';
$string['defaultinfo'] = 'Oletuskategoria kysymyksille.';
$string['delay1'] = 'Toista suorituskertaa edeltävä aikaviive';
$string['delay1st2nd'] = 'Pakotettu viive ensimmäisen ja toisen suorituskerran välissä';
$string['delay1st2nd_help'] = 'Jos asetat aikaviiveen, opiskelija ei pääse tenttiin samantien uudestaan, vaan hänen on odotettava viiveen verran ennen toista suorituskertaa';
$string['delay2'] = 'Myöhempien suorituskertojen välinen aikaviive';
$string['delaylater'] = 'Pakotettu viive myöhempien suorituskertojen välillä';
$string['delaylater_help'] = 'Jos asetat tämän aikaviiveen, opiskelijan pitää odottaa sen verran ennen kolmatta tai useampaa suorituskertaansa samasta tentistä.';
$string['deleteattemptcheck'] = 'Oletko aivan varma, että haluat poistaa kaikki nämä suoritukset?';
$string['deleteselected'] = 'Poista valitut';
$string['deletingquestionattempts'] = 'Poistetaan kysymyksen vastausyritykset';
$string['description'] = 'Kuvaus';
$string['disabled'] = 'Estetty';
$string['displayoptions'] = 'Näyttövalinnat';
$string['download'] = 'Napsauta tallentaaksesi viety kategoriatiedosto koneellesi';
$string['downloadextra'] = '(tiedosto tallennetaan myös kurssin tiedostoihin /quiz-hakemistossa)';
$string['duplicateresponse'] = 'Tätä vastausta ei huomioida, koska annoit vastaavan vastauksen jo aiemmin.';
$string['eachattemptbuildsonthelast'] = 'Perustuuko uusi suoritus edelliselle?';
$string['eachattemptbuildsonthelast_help'] = 'Opiskelijat voivat saada suorittaa saman tentin useammin kuin kerran. Tämä voi tehdä tentin tekemisestä enemmänkin oppimiseen liittyvän toiminnon kuin vain arvioinnin.
Jos tentin saa suorittaa useammin kuin yhden kerran ja tämä asetus on käytössä, jokainen uusi suorituskerta säilyttää edellisen suorituksen vastaukset. Tämä mahdollistaa tentin suorituksen useassa osassa eri kerroilla.
Jos haluat joka suorituskerralle uuden, tyhjän tentin, valitse asetukseksi **Ei**.';
$string['editcategories'] = 'Muokkaa kategorioita';
$string['editcategory'] = 'Muokkaa kategoriaa';
$string['editcatquestions'] = 'Muokkaa kategorian kysymyksiä';
$string['editingquestion'] = 'Muokataan kysymystä';
$string['editingquiz'] = 'Muokataan tenttiä';
$string['editingquiz_help'] = 'Tentin tekemisessä peruskäsitteitä ovat:
* Tentti, joka sisältää kysymyksiä yhdellä tai useammalla sivulla
* Kysymyspankki, joka säilyttää kysymykset jaoteltuna kategorioittain
* Satunnaiset kysymykset, eli kysymykset, jotka arvotaan kullekin opiskelijalle ja kullekin suorituskerralle uudestaan.';
$string['editoverride'] = 'Muokkaa poikkeusta';
$string['editqcats'] = 'Muokkaa kysymyskategorioita';
$string['editquestions'] = 'Muokkaa kysymyksiä';
$string['editquiz'] = 'Muokkaa tenttiä';
$string['editquizquestions'] = 'Muokkaa tentin kysymyksiä';
$string['emailconfirmbody'] = 'Hei {$a->username},

Vastauksisesi tenttiin \'{$a->quizname}\' kurssilla \'{$a->coursename}\' on tallennettu {$a->submissiontime}.

Tämä viesti vahvistaa vastauksesi tallentumisen.

Voit katsoa tenttiä osoitteessa {$a->quizurl}.';
$string['emailconfirmsmall'] = 'Kiitos vastauksistasi tenttiin \'{$a->quizname}\'';
$string['emailconfirmsubject'] = 'Vahvistus tentin tallennuksesta: {$a->quizname}';
$string['emailnotifybody'] = 'Hei {$a->username},

Opiskelija {$a->studentname} on tehnyt tentin {$a->quizname} ({$a->quizurl}) kurssilla {$a->coursename}.

Voit tarkastella hänen vastuksiaan osoitteessa {$a->quizreviewurl}.';
$string['emailnotifysmall'] = '{$a->studentname} on vastannut tenttiin {$a->quizname}';
$string['emailnotifysubject'] = 'Opiskelija {$a->studentname} on tehnyt tentin {$a->quizname}';
$string['empty'] = 'Tyhjä';
$string['enabled'] = 'Käytössä';
$string['endtest'] = 'Lopeta tentti';
$string['erroraccessingreport'] = 'Et voi nähdä tätä raporttia';
$string['errorinquestion'] = 'Virhe kysymyksessä';
$string['errormissingquestion'] = 'Virhe: Järjestelmästä ei löydy kysymystä, jonka id on {$a}';
$string['errornotnumbers'] = 'Virhe - vastauksen oltava numeerinen';
$string['errorunexpectedevent'] = 'Arvaamaton tapahtumakoodi {$a->event} löytyi kysymykseen {$a->questionid} tenttisuorituksessa {$a->attemptid}.';
$string['essay'] = 'Essee';
$string['essayquestions'] = 'Kysymykset';
$string['everynquestions'] = 'Kaikki {$a} kysymystä';
$string['everyquestion'] = 'Kaikki kysymykset';
$string['everythingon'] = 'Kaikki';
$string['export'] = 'Vie';
$string['exportcategory'] = 'vientikategoria';
$string['exporterror'] = 'Virhe viennissä';
$string['exportingquestions'] = 'Kysymykset on viety tiedostoon';
$string['exportname'] = 'Tiedostonimi';
$string['exportquestions'] = 'Vie kysymykset tiedostoon';
$string['extraattemptrestrictions'] = 'Ylimääräiset rajoitukset suorituskerroissa';
$string['false'] = 'Epätosi';
$string['feedback'] = 'Palaute';
$string['feedbackerrorboundaryformat'] = 'Palautteen arviointien rajat pitää antaa joko prosentteina tai numeroina. Antamaasi arvoa {$a} ei tunnistettu.';
$string['feedbackerrorboundaryoutofrange'] = 'Palautteen arviointien rajat pitää olla 0% ja 100% välissä. Antamasi arvo {$a} on rajojen ulkopuolella.';
$string['feedbackerrorjunkinboundary'] = 'Palautteen arviointien rajoissa ei saa olla aukkoja.';
$string['feedbackerrorjunkinfeedback'] = 'Palautteet pitää antaa ilman aukkoja.';
$string['feedbackerrororder'] = 'Palautteen arviointien rajojen pitää olla järjestyksessä suurimmasta pienimpään. Antamasi raja {$a} ei sovi tähän järjestykseen.';
$string['file'] = 'Tiedosto';
$string['fileformat'] = 'Tiedostomuoto';
$string['fillcorrect'] = 'Täytä oikeilla';
$string['filloutnumericalanswer'] = 'Anna vähintään yksi mahdollinen vastaus ja virheen raja-arvo. Ensimmäinen sopiva vastaus määrittelee pisteet ja palautteen. Voit myös antaa viimeiseksi vaihtoehdoksi palautteen ilman vastausta. Tämä palaute näytetään niille opiskelijoille, joiden antama vastaus ei sovi mihinkään määrittelemistäsi vastauksista.';
$string['filloutoneanswer'] = 'Anna vähintään yksi mahdollinen vastaus. Tyhjiä vastauksia ei käytetä. Asteriskia (*) voi käyttää jokerimerkkinä korvaamaan minkä tahansa merkkijonon. Ensimmäistä sopivaa vastausta käytetään määrittelemään arvosana ja palaute.';
$string['filloutthreequestions'] = 'Anna vähintään kolme kysymystä ja niille sopivaa vastausta. Voit näiden lisäksi antaa vääriä vastauksia lisäämällä vastauksen, josta puuttuu kysymys.';
$string['fillouttwochoices'] = 'Anna vähintään kaksi vaihtoehtoa. Tyhjäksi jätettyjä vaihtoehtoja ei käytetä.';
$string['finishattemptdots'] = 'Lopeta tentti...';
$string['finishreview'] = 'Lopeta tarkastelu';
$string['forceregeneration'] = 'pakota uudelleenluonti';
$string['formatnotfound'] = 'Vienti/tuontiformaattia {$a} ei löydy';
$string['formatnotimplemented'] = 'Tätä formaattia ei ole toteutettu oikein. Ole ystävällinen ja lähetä virheraportti';
$string['formulaerror'] = 'Kaavavirheitä!';
$string['fractionsaddwrong'] = 'Valitsemasi arviointiasteikko ei yllä 100% asti, vaan jää {$a}%:iin.<br />
Haluatko palata ja korjata tämän kysymyksen?';
$string['fractionsnomax'] = 'Yhden vastauksista pitäisi olla 100%, jotta<br />vastaajan on mahdollista saada täydet pisteet tästä kysymyksestä.<br />
Haluatko palata korjaamaan tämän kysymyksen?';
$string['fromfile'] = 'tiedostosta:';
$string['functiondisabledbysecuremode'] = 'Toiminto on poissa käytöstä';
$string['generalfeedback'] = 'Yleinen palaute';
$string['generalfeedback_help'] = 'Yleinen palaute on teksti, joka näytetään kun kysymykseen on vastattu. Toisin kuin tietyn kysymyksen palaute, joka riippuu annetusta vastauksesta, näytetään aina sama yleinen palaute.';
$string['grade'] = 'Arvosana';
$string['gradeall'] = 'Arvioi kaikki';
$string['gradeaverage'] = 'Arviointien keskiarvo';
$string['gradeboundary'] = 'Arvosanan raja';
$string['gradeessays'] = 'Arvioi esseet';
$string['gradehighest'] = 'Korkein arvosana';
$string['grademethod'] = 'Arviointitapa';
$string['grademethod_help'] = '## Arviointitavat
Kun opiskelija voi vastata tenttiin usean kerran, voidaan lopullinen arviointi laskea eri tavoin:
**Korkein arviointi**

Lopullinen arviointi on paras kaikista suorituskerroista.
**Keskiarvo**

Lopullinen arviointi on keskiarvo kaikista suorituskerroista.

**Ensimmäinen suorituskerta**

Lopullinen arviointi on ensimmäinen kaikista suorituskerroista, muita suorituskertoja ei huomioida.

**Viimeisin suorituskerta**

Lopullinen arviointi on viimeisin kaikista suorituskerroista, muita suorituskertoja ei huomioida.
';
$string['gradesdeleted'] = 'Tentin arvosanat poistettu';
$string['gradesofar'] = '{$a->method}: {$a->mygrade} / {$a->quizgrade}.';
$string['gradingdetails'] = 'Pisteet tästä palautuksesta: {$a->raw}/{$a->max}.';
$string['gradingdetailsadjustment'] = 'Huomioiden aiemmat pistevähennykset pisteiksi on tulossa <strong>{$a->cur}/{$a->max}</strong>.';
$string['gradingdetailspenalty'] = 'Tästä palautuksesta vähennetään {$a} pistettä.';
$string['gradingdetailszeropenalty'] = 'Sinulta ei vähennetty pisteitä vastauksestasi.';
$string['gradingmethod'] = 'Arviointitapa: {$a}';
$string['groupoverrides'] = 'Ryhmien poikkeuspääsyt';
$string['groupsnone'] = 'Tällä kurssilla ei ole ryhmiä';
$string['guestsno'] = 'Vierailijat eivät voi katsella tai tehdä tenttejä.';
$string['hidebreaks'] = 'Piilota sivunvaihdot';
$string['hidereordertool'] = 'Piilota uudellenjärjestelytyökalu';
$string['history'] = 'Vastaushistoria:';
$string['howquestionsbehave_desc'] = 'Oletusasetus tentin kysymysten toimintatavalle.';
$string['imagedisplay'] = 'Näytettävä kuva';
$string['import'] = 'Tuo';
$string['import_help'] = 'Tämä toiminnon avulla voit tuoda kysymyksiä ulkoisista tekstitiedostoista.
Jos tiedostosi sisältää muita kuin ascii merkkejä, täytyy tiedoston olla UTF-8 muodossa. Ole erityisen varovainen Microsoft Office ohjelmilla luotujen tiedostojen kanssa, koska nämä käyttävät yleisesti erityistä koodausta, jota ei käsitellä oikein.
Tuonti- ja vientiformaatit ovat plugineilla toteutettavia resursseja. Muita vaihtoehtoisia formaatteja saattaa olla saatavissa Moduulit ja Pluginit -tietokannassa.';
$string['importcategory'] = 'tuonti kategoria';
$string['importerror'] = 'Virhe tuonnissa';
$string['importfilearea'] = 'Tuo kurssilla olevasta tiedostosta';
$string['importfileupload'] = 'Tuo palvelimelle ladattavasta tiedostosta...';
$string['importfromthisfile'] = 'Tuo tästä tiedostosta';
$string['importingquestions'] = 'Tuodaan {$a} kysymystä tiedostosta';
$string['importmax10error'] = 'Kysymyksessä on virhe. Ei voi olla yli kymmentä vastausta';
$string['importmaxerror'] = 'Tässä kysymyksessä on virhe: liian monta vastausta.';
$string['importquestions'] = 'Tuo kysymykset tiedostosta';
$string['inactiveoverridehelp'] = '* Opiskelijalla ei ole oikeata ryhmää tai roolia yrittääkseen tätä tenttiä';
$string['incorrect'] = 'Väärin';
$string['indivresp'] = 'Yksittäiset vastaukset jokaiselle kohteelle';
$string['info'] = 'Tietoa';
$string['infoshort'] = 'i';
$string['inprogress'] = 'Käynnissä';
$string['introduction'] = 'Johdanto';
$string['invalidattemptid'] = 'Suorituskerran ID:tä ei ole';
$string['invalidcategory'] = 'Väärä kategorian ID';
$string['invalidnumericanswer'] = 'Yksi antamistasi vastauksista ei ollut oikea numero.';
$string['invalidnumerictolerance'] = 'Yksi antamistasi toleransseista ei ollut sopiva numero.';
$string['invalidoverrideid'] = 'Virheellinen poikkeus-id';
$string['invalidquestionid'] = 'Virheellinen kysymys id';
$string['invalidquizid'] = 'Virheellinen tentti-id';
$string['invalidsource'] = 'Lähdettä ei hyväksytty.';
$string['invalidsourcetype'] = 'Väärä lähdetyyppi.';
$string['invalidstateid'] = 'Virheellinen tila-id';
$string['lastanswer'] = 'Viimeinen vastauksesi oli';
$string['layout'] = 'Kysymysten sijoittelu sivuille';
$string['layoutasshown'] = 'Sivun ulkoasu näkyvän mukainen.';
$string['layoutasshownwithpages'] = 'Sivun ulkoasu näkyvän mukainen. <small>(Sivunvaihto joka {$a}:n kysymyksen jälkeen.)</small>';
$string['layoutshuffledandpaged'] = 'Kysymykset sekoitetaan, {$a} kysymystä joka sivulla.';
$string['layoutshuffledsinglepage'] = 'Kysymykset sekoitetaan, kaikki kysymykset samalla sivulla.';
$string['link'] = 'Linkki';
$string['listitems'] = 'Lista tentin kysymyksistä';
$string['literal'] = 'vakiomerkintä';
$string['loadingquestionsfailed'] = 'Kysymysten lataaminen ei onnistunut: {$a}';
$string['makecopy'] = 'Tallenna uutena kysymyksenä';
$string['managetypes'] = 'Hallinnoi kysymystyyppejä ja -palvelimia';
$string['manualgrading'] = 'Arviointi';
$string['mark'] = 'Palauta';
$string['markall'] = 'Palauta tentin tämä sivu';
$string['marks'] = 'Pistettä';
$string['match'] = 'Yhteensopivat vastaukset';
$string['matchanswer'] = 'Yhteensopiva vastaus';
$string['matchanswerno'] = 'Sopii vastaukseen {$a}';
$string['max'] = 'Max';
$string['messageprovider:confirmation'] = 'Tenttipalautustesi vahvistusviesti';
$string['messageprovider:submission'] = 'Ilmoitus tenttipalautuksista';
$string['min'] = 'Min';
$string['minutes'] = 'Minuuttia';
$string['missingcorrectanswer'] = 'Oikea vastaus täytyy määrittää';
$string['missingitemtypename'] = 'Puuttuva nimi';
$string['missingquestion'] = 'Tätä kysymystä ei ole enää olemassa';
$string['modulename'] = 'Tentti';
$string['modulename_help'] = 'Tentillä voi suunnitella ja koota kysymysjoukkoja, jotka koostuvat monivalinnoista, oikein/väärin -kysymyksistä, lyhytvastauskysymyksistä sekä esseistä. Kysymykset tallennetaan luokiteltuun tietokantaan, ja niitä voi käyttää usean kerran samalla kurssilla tai jopa toisella kurssilla. Tentteihin voidaan vastata yhden tai useita kertoja. Jokainen vastauskerta arvioidaan automaattisesti (paitsi esseet) ja opettajana voit valita, haluatko antaa palautetta, näyttää oikeat vastaukset vai molemmat.';
$string['modulenameplural'] = 'Tentit';
$string['moveselectedonpage'] = 'Siirrä valitut kysymykset sivulle: {$a}';
$string['multichoice'] = 'Monivalinta';
$string['multipleanswers'] = 'Valitse ainakin yksi vastaus';
$string['multiplier'] = 'Kerroin';
$string['name'] = 'Nimi';
$string['navnojswarning'] = 'Varoitus: nämä linkit eivät tallenna vastauksiasi. Käytä sivun alalaidassa olevaa seuraava-painiketta.';
$string['neverallononepage'] = 'Ei koskaan, kaikki kysymykset yhdellä sivulla';
$string['newattemptfail'] = 'Virhe: Tentin uutta suorituskertaa ei voitu aloittaa';
$string['newpage'] = 'Uusi sivu';
$string['newpage_help'] = 'Pitkissä tenteissä kysymykset kannattaa jakaa usealle sivulle rajoittamalla sivukohtaista kysymysmäärää. Kysymyksiä lisättäessä sivunvaihdot lisätään automaattisesti tällä asetuksella määrittelemäsi sivujaon mukaan. Myöhemmin tenttiä muokatessasi sivunvaihtojen paikkoja on toki mahdollista vielä siirtää.';
$string['newpageevery'] = 'Aloita uusi sivu automaattisesti';
$string['noanswers'] = 'Vastausta ei ole valittu!';
$string['noattempts'] = 'Kukaan ei ole yrittänyt tätä tenttiä.';
$string['noattemptsfound'] = 'Suorituskertoja ei löytynyt';
$string['noattemptstoshow'] = 'Näytettäviä suorituskertoja ei ole';
$string['nocategory'] = 'Väärä kategoria tai ei ollenkaan kategoriaa';
$string['noclose'] = 'Ei sulkeutumispäivämäärää';
$string['nocommentsyet'] = 'Ei kommentteja.';
$string['noconnection'] = 'Ei voitu luoda yhteyttä verkkopalveluun, joka käsittelee tämän kysymyksen. Ota yhteyttä ylläpitäjääsi.';
$string['nodataset'] = 'tyhjää - ei ole muuttuja';
$string['nodatasubmitted'] = 'Mitään tietoa ei palautettu.';
$string['noessayquestionsfound'] = 'Käsin arvioituja kysymyksiä ei löytynyt';
$string['nogradewarning'] = 'Tätä tenttiä ei ole arvioitu, joten et voi määritellä yleistä, arvosanasta riippuvaa  palautetta.';
$string['nomoreattempts'] = 'Enempiä suorituskertoja ei sallita';
$string['none'] = 'Ei yhtään';
$string['noopen'] = 'Ei avautumispäivämäärää';
$string['nooverridedata'] = 'Sinun on määriteltävä poikkeus vähintään yhteen tentin asetuksista. Jos haluat poistaa poikkeuksen, tee se poikkeuksien yhteenvetosivulta.';
$string['nopossibledatasets'] = 'Ei mahdollisia tietojoukkoja';
$string['noquestionintext'] = 'Kysymystekstiin ei ole sisällytetty kysymyksiä';
$string['noquestions'] = 'Kysymyksiä ei ole vielä lisätty.';
$string['noquestionsfound'] = 'Ei löydetty kysymyksiä';
$string['noquestionsinquiz'] = 'Tässä tentissä ei ole kysymyksiä.';
$string['noquestionsnotinuse'] = 'Tämä satunnaiskysymys ei ole käytössä, koska sen kategoria on tyhjä.';
$string['noquestionsonpage'] = 'Tyhjä sivu';
$string['noresponse'] = 'Ei vastausta';
$string['noreview'] = 'Et voi tarkastella tätä tenttiä';
$string['noreviewattempt'] = 'Et voi katsella tätä suorituskertaa';
$string['noreviewshort'] = 'Ei sallittu';
$string['noreviewuntil'] = 'Et voi tarkastella tätä tenttiä ennen {$a}';
$string['noreviewuntilshort'] = 'Saatavissa {$a}';
$string['noscript'] = 'Selaimen JavaScriptin pitää olla toiminnassa, jotta voisit jatkaa';
$string['notavailabletostudents'] = 'Huomio: Tämä tentti ei ole tällä hetkellä opiskelijoidesi saatavilla';
$string['notenoughrandomquestions'] = 'Kategoriassa {$a->category} ei ole tarpeeksi kysymyksiä, jotta voitaisiin luoda kysymys {$a->name} ({$a->id}).';
$string['notenoughsubquestions'] = 'Osakysymyksiä ei ole määritelty riittävästi! <br /> Haluatko palata ja korjata tämän kysymyksen?';
$string['notimedependentitems'] = 'Tenttimoduuli ei tue tällä hetkellä ajasta riippuvia kohteita. Kiertääksesi tämän rajoituksen voit määrätä rajatun ajan koko tentille. Haluatko valita jonkin muun kohteen (vai käytetäänkö nykyistä)?';
$string['notyetgraded'] = 'Ei vielä arvioitu';
$string['notyetviewed'] = 'Ei vielä katsottu';
$string['notyourattempt'] = 'Tämä ei ole sinun suorituksesi!';
$string['noview'] = 'Sisäänkirjautunut käyttäjä ei voi nähdä tätä tenttiä';
$string['numattempts'] = '{$a->studentnum} {$a->studentstring} on yrittänyt tenttiä {$a->attemptnum} kertaa';
$string['numattemptsmade'] = 'Tätä tenttiä on yritetty {$a} kertaa';
$string['numberabbr'] = '#';
$string['numerical'] = 'Numeerinen';
$string['numquestionsx'] = 'Kysymyksiä: {$a}';
$string['onlyteachersexport'] = 'Vain opettajat voivat viedä kysymyksiä';
$string['onlyteachersimport'] = 'Vain opettajat, joilla on muokkausoikeudet, voivat tuoda kysymyksiä';
$string['onthispage'] = 'Tämä sivu';
$string['open'] = 'Ei vastattu';
$string['openclosedatesupdated'] = 'Tentin aloitus- ja lopetuspäivämäärät päivitetty';
$string['optional'] = 'valinnainen';
$string['orderandpaging'] = 'Järjestys ja taitto';
$string['orderandpaging_help'] = 'Numerot 10, 20, 30, ... kysymysten vieressä osoittavat kysymysten järjestyksen. Numerot kasvavat kymmenen välein, jotta väleihin jää tilaa lisäkysymyksille. Järjestääksesi kysymykset uudelleen, muuta numeroita ja klikkaa "Järjestä uudelleen" -painiketta.
Lisätäksesi sivunvaihtoja tiettyjen kysymysten jälkeen, laita merkki valintalaatikkoihin kysymysten vieressä ja klikkaa "Lisää uusi sivu valittujen kysymysten jälkeen" -painiketta.
Järjestääksesi kysymykset useille sivuille, klikkaa "Taita uudelleen" -painiketta ja valitse kysymysten haluttu määrä per sivu.';
$string['orderingquiz'] = 'Järjestys ja taitto';
$string['outof'] = '{$a->grade} pistettä, täydet pisteet {$a->maxgrade}';
$string['outofpercent'] = '{$a->grade} pistettä maksimista {$a->maxgrade} ({$a->percent}%)';
$string['outofshort'] = '{$a->grade}/{$a->maxgrade}';
$string['overallfeedback'] = 'Palaute kokonaisuudesta';
$string['overallfeedback_help'] = 'Palaute kokonaisuudesta näytetään tenttisuorituksen jälkeen. Jos arvosanarajat ovat käytössä (prosentteina tai numerona), voi näytettävä teksti riippua saadusta arvosanasta.';
$string['overdue'] = 'Myöhässä';
$string['override'] = 'Määrittele poikkeus';
$string['overridedeletegroupsure'] = 'Oletko varma että haluat poistaa poikkeuspääsyn ryhmältä {$a}?';
$string['overridedeleteusersure'] = 'Oletko varma että haluat poistaa poikkeuspääsyn käyttäjältä {$a}?';
$string['overridegroup'] = 'Poikkeus ryhmälle';
$string['overridegroupeventname'] = '{$a->quiz} - {$a->group}';
$string['overrides'] = 'Poikkeukset';
$string['overrideuser'] = 'Poikkeus osallistujalle';
$string['overrideusereventname'] = '{$a->quiz} - Poikkeus';
$string['page-mod-quiz-edit'] = 'Muokkaa tenttisivua';
$string['page-mod-quiz-x'] = 'Kaikki tenttimoduulin sivut';
$string['pagesize'] = 'Montako suoritusta sivulla:';
$string['parent'] = 'Kategoriataso';
$string['parentcategory'] = 'Yläkategoria';
$string['parsingquestions'] = 'Luetaan kysymyksiä tuontitiedostosta.';
$string['partiallycorrect'] = 'Osittain oikein';
$string['penalty'] = 'Vähennys';
$string['penaltyscheme'] = 'Vähennetäänkö pisteitä vääristä vastauksista?';
$string['penaltyscheme_help'] = 'Jos tentissä käytetään mukautuvia kysymyksiä, opiskelijan on mahdollista yrittää vastata uudestaan vastattuaan väärin. Jos haluat vähentää opiskelijan pisteitä jokaisesta väärästä vastauksesta, käytä tätä asetusta. Pistevähennyksen suuruus määritellään erikseen jokaiseen kysymykseen ko. kysymystä lisättäessä tai muokattaessa.*Tällä asetuksella ei ole vaikutusta, jos tentissä ei käytetä mukautuvia kysymyksiä.*';
$string['percentcorrect'] = 'Prosenttia oikein';
$string['pleaseclose'] = 'Pyyntösi on käsitelty. Voit nyt sulkea tämän ikkunan.';
$string['pluginadministration'] = 'Tentin hallinnointi';
$string['pluginname'] = 'Tentti';
$string['popup'] = 'Näytä "suojatussa" ikkunassa';
$string['popupblockerwarning'] = 'Tämä osuus tentistä on suojatussa tilassa. Pistä ponnahdusikkunoiden poist pois päältä.';
$string['popupnotice'] = 'Opiskelijat näkevät tämän tentin suojatussa ikkunassa';
$string['preprocesserror'] = 'Virhe esikäsittelyssä!';
$string['preview'] = 'Esikatselu';
$string['previewquestion'] = 'Esikatsele kysymystä';
$string['previewquiz'] = 'Esikatsele {$a}';
$string['previewquiznow'] = 'Esikatsele tenttiä';
$string['previous'] = 'Edellinen tila';
$string['publish'] = 'Julkaise';
$string['publishedit'] = 'Sinulla pitää olla lisäys- ja muokkausoikeudet julkaisevalla kurssilla muokataksesi kysymyksiä tässä kategoriassa.';
$string['qbrief'] = 'Q. {$a}';
$string['qname'] = 'nimi';
$string['qti'] = 'IMS QTI- muoto';
$string['qtypename'] = 'tyyppi, nimi';
$string['question'] = 'Kysymys';
$string['questionbankcontents'] = 'Kysymyspankin sisältö';
$string['questionbankmanagement'] = 'Kysymyspankin hallinnointi';
$string['questionbehaviour'] = 'Kysymysten toiminta';
$string['questioncats'] = 'Kysymyskategoriat';
$string['questiondeleted'] = 'Tämä kysymys on poistettu. Ota yhteyttä opettajaasi.';
$string['questioninuse'] = 'Kysymys \'{$a}\' on jo käytössä:';
$string['questionmissing'] = 'Tästä sessiosta puuttuu kysymys';
$string['questionname'] = 'Kysymyksen nimi';
$string['questionnonav'] = '<span class="accesshide">Kysymys </span>{$a->number}<span class="accesshide"> {$a->attributes}</span>';
$string['questionnonavinfo'] = '<span class="accesshide">Tiedot </span>{$a->number}<span class="accesshide"> {$a->attributes}</span>';
$string['questionnotloaded'] = 'Kysymystä {$a} ei ole ladattu tietokannasta';
$string['questionorder'] = 'Kysymysjärjestys';
$string['questions'] = 'Kysymykset';
$string['questionsinclhidden'] = 'Kysymykset (myös piilotetut)';
$string['questionsinthisquiz'] = 'Tenttiin lisätyt kysymykset';
$string['questionsperpage'] = 'Montako kysymystä sivulla?';
$string['questionsperpageselected'] = 'Kysymysten määrä sivua kohti on asetettu niin, että sivujen taitto on pakotettu. Tämän tuloksena taiton hallintatyökalut on poistettu käytöstä. Voit muuttaa tämän täältä {$a}.';
$string['questionsperpagex'] = 'Kysymyksiä sivulla: {$a}';
$string['questiontext'] = 'Kysymyksen teksti';
$string['questiontextisempty'] = '[Tyhjä kysymysteksti]';
$string['questiontype'] = 'Kysymystyyppi {$a}';
$string['questiontypesetupoptions'] = 'Asetukset kysymystyypeille:';
$string['quiz:attempt'] = 'Yritä tenttejä';
$string['quiz:deleteattempts'] = 'Poista tentin suoritukset';
$string['quiz:emailconfirmsubmission'] = 'Sähköpostivarmistus kun tenttivastaukset palautetaan';
$string['quiz:emailnotifysubmission'] = 'Tilaa sähköpostihuomautus kun tenttivastaukset palautetaan';
$string['quiz:grade'] = 'Arvioi tentit itse';
$string['quiz:ignoretimelimits'] = 'Jätä aikarajat huomioimatta';
$string['quiz:manage'] = 'Tenttien asetukset';
$string['quiz:manageoverrides'] = 'Hallinnoi poikkeuspääsyjä tenttiin';
$string['quiz:preview'] = 'Tenttien esikatselu';
$string['quiz:regrade'] = 'Uudelleenarvioi suoritukset';
$string['quiz:reviewmyattempts'] = 'Tarkastele omia tenttisuorituksiasi';
$string['quiz:view'] = 'Katso tentin tietoja';
$string['quiz:viewreports'] = 'Katso tentin raportteja';
$string['quizavailable'] = 'Tentti on vastattavissa {$a} saakka.';
$string['quizclose'] = 'Tenttiaika päättyy';
$string['quizclosed'] = 'Tentti on suljettu {$a}';
$string['quizcloses'] = 'Tentti sulkeutuu';
$string['quizcloseson'] = 'Tentti sulkeutuu {$a}';
$string['quizisclosed'] = 'Tämä tentti on suljettu';
$string['quizisclosedwillopen'] = 'Tentti suljettu (avautuu {$a})';
$string['quizisopen'] = 'Tämä tentti on auki';
$string['quizisopenwillclose'] = 'Tentti auki (sulkeutuu {$a})';
$string['quiznavigation'] = 'Tentin navigaatio';
$string['quizopen'] = 'Tenttiaika alkaa';
$string['quizopenclose'] = 'Avautumis- ja sulkeutumispäivämäärät';
$string['quizopenclose_help'] = '## Tenttiaika
Voit määritellä aikavälin, jona tentti on näkyvissä opiskelijoille. Ennen aloitusaikaa ja lopetusajan jälkeen tenttiin ei pääse.';
$string['quizopened'] = 'Tämä tentti on auki.';
$string['quizopenedon'] = 'Tämä tentti avautui {$a}';
$string['quizopens'] = 'Tentti aukeaa';
$string['quizopenwillclose'] = 'Tämä tentti on auki, sulkeutuu {$a} kello';
$string['quizordernotrandom'] = 'Tentin kysymyksiä ei ole sekoitettu';
$string['quizorderrandom'] = '* Tentin kysymykset on sekoitettu';
$string['quizsettings'] = 'Tentin asetukset';
$string['quiztimer'] = 'Tentin Aika';
$string['quizwillopen'] = 'Tämä tentti avautuu {$a}';
$string['random'] = 'Satunnaistetut kysymykset';
$string['randomcreate'] = 'Luo satunnaistetut kysymykset';
$string['randomfromcategory'] = 'Satunnainen kysymys kategoriasta:';
$string['randomfromexistingcategory'] = 'Satunnainen kysymys olemassaolevasta kategoriasta';
$string['randomnosubcat'] = 'Kysymykset vain tästä kategoriasta, ei sen alakategorioista';
$string['randomquestionusinganewcategory'] = 'Satunnainen kysymys uudesta kategoriasta';
$string['randomwithsubcat'] = 'Kysymys tästä kategoriasta ja sen alakategorioista';
$string['readytosend'] = 'Olet lähettämässä tentin arvioitavaksi. Oletko varma, että haluat jatkaa?';
$string['reattemptquiz'] = 'Yritä tenttiä uudestaan';
$string['recentlyaddedquestion'] = 'Viimeksi lisätyt kysymykset';
$string['recurse'] = 'Näytä myös kysymykset alakategorioista';
$string['regrade'] = 'Arvioi uudelleen kaikki suorituskerrat';
$string['regradecomplete'] = 'Kaikki suorituskerrat on arvioitu uudelleen.';
$string['regradecount'] = '{$a->changed} / {$a->attempt} suorituksen arviointi muuttui.';
$string['regradedisplayexplanation'] = 'Uudelleenarvioinnin aikana suoritukset näytetään linkkeinä kysymysten tarkasteluikkunaan';
$string['regradenotallowed'] = 'Sinulla ei ole oikeuksia tämän tentin uudelleen arviointiin';
$string['regradingquestion'] = 'Arvioidaan uudelleen "{$a}"';
$string['regradingquiz'] = 'Arvioidaan uudelleen tenttiä "{$a}"';
$string['remove'] = 'Poista';
$string['removeallquizattempts'] = 'Poista kaikki tentin vastauskerrat';
$string['removeemptypage'] = 'Poista tyhjä sivu';
$string['removeselected'] = 'Poista valitut';
$string['rename'] = 'Nimeä uudelleen';
$string['renderingserverconnectfailed'] = 'Palvelin ei kyennyt käsittelemään RQP-pyyntöä. Tarkista, että URL on oikein.';
$string['reorderquestions'] = 'Järjestä kysymykset uudelleen';
$string['reordertool'] = 'Näytä uudelleenjärjestelyn työkalu';
$string['repaginate'] = 'Muotoile sivut uudelleen,  {$a} kysymystä sivulle';
$string['repaginatecommand'] = 'Sivuta uudelleen';
$string['repaginatenow'] = 'Sivuta nyt uudelleen';
$string['replace'] = 'Korvaa';
$string['replacementoptions'] = 'Korvaamisen valinnat';
$string['report'] = 'Raportit';
$string['reportanalysis'] = 'Kohteen tilastointi';
$string['reportfullstat'] = 'Yksityiskohtaiset tilastot';
$string['reportmulti_percent'] = 'Moniprosentuaaliset';
$string['reportmulti_q_x_student'] = 'Useamman opiskelijan valinnat';
$string['reportmulti_resp'] = 'Käyttäjäkohtaiset vastaukset';
$string['reportnotfound'] = 'Raporttia ei tunneta ({$a})';
$string['reportoverview'] = 'Lyhyesti';
$string['reportregrade'] = 'Uudelleenarviointi';
$string['reportresponses'] = 'Yksityiskohtaiset vastaukset';
$string['reports'] = 'Raportit';
$string['reportsimplestat'] = 'Perustilasto';
$string['requirepassword'] = 'Suojaa salasanalla';
$string['requirepassword_help'] = '## Suojaa salasanalla
Tämä kenttä on vapaaehtoinen.
Jos määrittelet salasanan tähän kenttään, tenttiin osallistujien on annettava sama salasana ennen kuin he voivat vastata tenttiin.';
$string['requiresubnet'] = 'Rajaa pääsy verkko-osoitteisiin';
$string['requiresubnet_help'] = '
Tämä kenttä on vapaaehtoinen.
Voit rajata tenttiin pääsyn koskemaan vain tiettyjä LAN:in tai Internetin aliverkkoja listaamalla (pilkulla erotettuna) osittaisia tai kokonaisia IP-osoitteita. Tämä on erityisen hyödyllistä valvottua tenttiä järjestettäessä, kun halutaan varmistaa, että vain tietyssä huoneessa olevat ihmiset pääsevät käsiksi tenttiin.
Esimerkkiosoitteita: **192.168. , 231.54.211.0/20, 231.3.56.211**
Määrittelyssä voi käyttää kolmentyyppisiä osoitteita. Tekstipohjaisia verkkotunnuksia, kuten esimerkki.com, ei voi käyttää.

1. Täydellinen IP-osoite, kuten **192.168.10.1** joka vastaa yksittäistä tietokonetta (tai välipalvelinta).
2. Osittainen IP-osoite, kuten **192.168**, joka vastaa kaikkia annetuilla numeroilla alkavia osoitteita.
3. CIDR (Classless Inter-Domain Routing), kuten **231.54.211.0/20**, joka sallii vieläkin tarkemman aliverkon määrittelyn.
4. A range of IP addresses **231.3.56.10-20** The range applies to the last
part of the address, so this means all the IP addresses from 231.3.56.10
to 231.3.56.20.


Välilyönneillä ei ole merkitystä.';
$string['response'] = 'Vastaus';
$string['responses'] = 'Vastaukset';
$string['results'] = 'Tulokset';
$string['reuseifpossible'] = 'käytä aikaisemmin poistettuja';
$string['reverttodefaults'] = 'Palauta tenttioletukset';
$string['review'] = 'Näytä uudelleen';
$string['reviewafter'] = 'Salli tentin tarkastelu sulkemisen jälkeen';
$string['reviewalways'] = 'Salli tentin tarkastelu milloin tahansa';
$string['reviewattempt'] = 'Tarkastele suoritusta';
$string['reviewbefore'] = 'Salli tentin tarkastelu kun tentti on avoimena';
$string['reviewclosed'] = 'Kun tentti on suljettu';
$string['reviewduring'] = 'Tenttisuorituksen aikana';
$string['reviewimmediately'] = 'Heti suorituksen jälkeen';
$string['reviewnever'] = 'Älä salli tentin tarkastelua koskaan';
$string['reviewofattempt'] = 'Näytetään suoritus {$a}';
$string['reviewofpreview'] = 'Esikatselun tarkastelu';
$string['reviewopen'] = 'Myöhemmin, kun tentti on yhä auki';
$string['reviewoptions'] = 'Opiskelijat saavat katsoa tentin';
$string['reviewoptionsheading'] = 'Tuloksista näytetään opiskelijoille';
$string['reviewoptionsheading_help'] = 'Näillä asetuksilla määrittelet, mitä tietoja opiskelijat saavat nähdä tenttiä tai tentin tuloksia katsoessaan.

\* **|Heti suorituksen jälkeen** tarkoittaa kahden minuutin sisällä Tallenna kaikki ja lopeta -painikkeen painamisen jälkeen.
\* **|Myöhemmin, kun tentti on yhä auki** tarkoittaa tuon em. kahden minuutin jälkeistä aikaa, mikä ajastetuilla tenteillä päättyy tentin päättymisaikaan.
\* **|Kun tentti on suljettu** koskee vain *ajastettujen tenttien* päättymisajan jälkeistä aikaa. Jos tentillä ei ole päättymisaikaa, näillä asetuksilla ei ole merkitystä.

Opettajat ja ylläpitäjät näkevät koko ajan kaikki opiskelijoiden tenttitiedot.';
$string['reviewresponse'] = 'Tarkastelun vastaukset';
$string['reviewresponsetoq'] = 'Näytä vastaus (kysymys {$a})';
$string['reviewthisattempt'] = 'Tarkastele tämän suorituskerran vastauksiasi';
$string['rqp'] = 'Etäkysymys';
$string['rqps'] = 'Etäkysymykset';
$string['sameasoverall'] = 'Sama kuin yleisarvosanalle';
$string['save'] = 'Tallenna';
$string['saveandedit'] = 'Tallenna muutokset ja muokkaa kysymyksiä';
$string['saveattemptfailed'] = 'Suoritusta ei voitu tallentaa.';
$string['savedfromdeletedcourse'] = 'Tallennettu poistetulta kurssilta "{$a}"';
$string['savegrades'] = 'Tallenna arvioinnit';
$string['savemyanswers'] = 'Tallenna vastaukseni';
$string['savenosubmit'] = 'Välitallennus';
$string['saveoverrideandstay'] = 'Tallenna ja lisää toinen poikkeus';
$string['savequiz'] = 'Tallenna koko tentti';
$string['saving'] = 'Tallentaa';
$string['savingnewgradeforquestion'] = 'Tallennetaan uusi arvosana kysymys-id:lle {$a}.';
$string['savingnewmaximumgrade'] = 'Tallennetaan uusi arvosanamaksimi.';
$string['score'] = 'Tulos';
$string['scores'] = 'Pisteet';
$string['select'] = 'Valitse';
$string['selectall'] = 'Valitse kaikki';
$string['selectcategory'] = 'Valitse kategoria';
$string['selectedattempts'] = 'Valitut suoritukset';
$string['selectnone'] = 'Poista valinta kaikista';
$string['selectquestiontype'] = '-- Valitse kysymystyyppi --';
$string['serveradded'] = 'Palvelin lisätty';
$string['serveridentifier'] = 'Palvelimen tunnus';
$string['serverinfo'] = 'Tietoa palvelimesta';
$string['servers'] = 'Palvelimet';
$string['serverurl'] = 'Palvelimen web-osoite';
$string['settingsoverrides'] = 'Asetusten ohitukset';
$string['shortanswer'] = 'Lyhyt vastaus';
$string['show'] = 'Näytä';
$string['showall'] = 'Näytä kaikki kysymykset yhdellä sivulla';
$string['showblocks'] = 'Näytä lohkon tentin aikana';
$string['showblocks_help'] = 'Jos kyllä, normaalit lohkot näytetään tenttisuorituksen aikana';
$string['showbreaks'] = 'Näytä sivunvaihdot';
$string['showcategorycontents'] = 'Näytä kategorian sisältö {$a->arrow}';
$string['showcorrectanswer'] = 'Näytä oikeat vastaukset palautteessa?';
$string['showdetailedmarks'] = 'Näytä pisteytyksen yksityiskohdat';
$string['showeachpage'] = 'Näytä yksi sivu kerrallaan';
$string['showfeedback'] = 'Näytä palaute vastaamisen jälkeen?';
$string['showinsecurepopup'] = 'Käytä tentissä \'suojattua\' ponnahdusikkunaa';
$string['shownoattempts'] = 'Näytä opiskelijat, joilla ei ole suorituksia';
$string['shownoattemptsonly'] = 'Näytä vain ne opiskelijat, joilla ei ole suorituksia';
$string['showteacherattempts'] = 'Näytä opettajan suoritukset';
$string['showuserpicture'] = 'Näytä käyttäjän kuva';
$string['showuserpicture_help'] = 'Jos sallittu, opiskelijan nimi ja kuva näytetään ruudulla tentin aikana sekä tentin jälkeen sitä tarkasteltaessa. Näin on helpompaa varmistaa että opiskelija on kirjautuneena sisään omilla tunnuksillaan valvotussa tentissä.';
$string['shuffle'] = 'Sekoita';
$string['shuffleanswers'] = 'Sekoita vastausten järjestys';
$string['shuffledrandomly'] = 'Sekoitettu satunnaisesti';
$string['shufflequestions'] = 'Sekoita kysymykset';
$string['shufflequestionsselected'] = 'Kysymysten sekoitus on käytössä, joten jotkut sivuihin liittyvät toiminnot eivät ole käytössä. Muuttaaksesi sekoitusasetusta, {$a}.';
$string['shufflewithin'] = 'Sekoita kysymyksen osien järjestys';
$string['shufflewithin_help'] = '## Sekoita kysymyksen osien järjestys
Tämä asetus sekoittaa kysymyksen osat satunnaiseen järjestykseen joka kerta kun vastaaja aloittaa tentin, edellyttäen, että asetus on päällä myös kysymyksen asetuksissa. Ajatuksena on vain hankaloittaa vieruskaverilta vastausten kopiointia.
Asetus soveltuu tietysti vain kysymystyyppeihin, joissa on alikohtia sekoitettavaksi, eli monivalinta- ja yhdistä parit -kysymykset. Monivalintakysymyksessä vastaukset sekoitetaan vain kun tämä asetus on "Kyllä". Yhdistä parit -kysymystyypissä vastaukset sekoitetaan aina, ja tällä asetuksella määritellään, sekoitetaanko lisäksi kysymys-vastaus -parit.';
$string['singleanswer'] = 'Valitse vastaus';
$string['sortage'] = 'Järjestä iän mukaan';
$string['sortalpha'] = 'Järjestä nimen mukaan';
$string['sortquestionsbyx'] = 'Lajittele kysymykset {$a}:n mukaan';
$string['sortsubmit'] = 'Järjestä kysymykset';
$string['sorttypealpha'] = 'Järjestä tyyppi, nimi';
$string['specificapathnotonquestion'] = 'Määritelty tiedostopolku ei ole määritellyssä kysymyksessä';
$string['specificquestionnotonquiz'] = 'Määritelty kysymys ei ole määritellyssä tentissä';
$string['startagain'] = 'Aloita uudestaan';
$string['startattempt'] = 'Aloita tentti';
$string['startedon'] = 'Aloitettiin';
$string['startnewpreview'] = 'Aloita uusi esikatselu';
$string['statenotloaded'] = 'Kysymyksen {$a} tila ei ole ladattu tietokannasta';
$string['status'] = 'Tila';
$string['stoponerror'] = 'Lopeta virheeseen';
$string['submitallandfinish'] = 'Palauta kaikki ja lopeta';
$string['subneterror'] = 'Tämä tentti on saatavilla vain tietyistä osoitteista. Tietokoneesi osoite ei ole sallittujen osoitteiden joukossa.';
$string['subnetnotice'] = 'Tentti on lukittu, niin että se on saatavilla vain tietyiltä verkkoalueilta. Tietokoneesi ei ole osa hyväksyttyä aliverkkoa. Opettajana voit kuitenkin silti katsella tenttiä.';
$string['subplugintype_quiz'] = 'Raportti';
$string['subplugintype_quiz_plural'] = 'Raportit';
$string['subplugintype_quizaccess'] = 'Saatavuussääntö';
$string['subplugintype_quizaccess_plural'] = 'Saatavuussäännöt';
$string['substitutedby'] = 'korvataan';
$string['summaryofattempt'] = 'Tenttisuorituksen yhteenveto';
$string['summaryofattempts'] = 'Yhteenveto aiemmista suorituksistasi';
$string['temporaryblocked'] = 'Et väliaikaisesti voi yrittää tenttiä uudelleen. <br/> Voit yrittää uudelleen:';
$string['theattempt'] = 'Suorituskerta';
$string['time'] = 'Aika';
$string['timecompleted'] = 'Suoritettu';
$string['timedelay'] = 'Et voi vastata tenttiin, koska edellisestä suorituskerrasta ei ole kulunut tarpeeksi kauan aikaa';
$string['timeleft'] = 'Aikaa jäljellä';
$string['timelimit'] = 'Suoritusaika';
$string['timelimit_help'] = 'Yleensä tentin suoritusaikaa ei ole rajoitettu, eli tentin tekijä voi käyttää tentin tekemiseen niin paljon aikaa kuin haluaa.
Jos määrittelet tentille suoritusajan eli maksimikeston minuutteina, huomioithan seuraavaa:

* Käytetyn selaimen on tuettava Javascriptiä - sen ansiosta ajastin toimii tarkoitetulla tavalla.
* Tentin aikana näytetään ajastin ponnahdusikkunassa.
* Suoritusajan täytyttyä tentti palautuu automaattisesti ja siihen mennessä vastatut kysymykset tallentuvat.
* Jos vastaaja onnistuu huijaamaan ja ylittää suoritusajan 60 sekunnilla, tentti arvioidaan automaattisesti nollan pisteen arvoiseksi.';
$string['timelimitexeeded'] = 'Tenttiaika päättyi!';
$string['timelimitmin'] = 'Suoritusaika (minuuttia)';
$string['timelimitsec'] = 'Suoritusaika (sekuntia)';
$string['timestr'] = '%d.%m.%y kello %H:%M:%S';
$string['timesup'] = 'Aika loppui!';
$string['timetaken'] = 'Suoritusaika';
$string['tofile'] = 'tiedostoon';
$string['tolerance'] = 'Toleranssi';
$string['toomanyrandom'] = 'Haluttu satunnaisten kysymysten määrä on suurempi kuin tämän kysymyskategorian kysymysten määrä ({$a}).';
$string['top'] = 'Päätaso';
$string['totalpointsx'] = 'Arvosanojen summa: {$a}';
$string['totalquestionsinrandomqcategory'] = 'Kategoriassa yhteensä {$a} kysymystä';
$string['true'] = 'Tosi';
$string['truefalse'] = 'Tosi/Epätosi';
$string['type'] = 'Tyyppi';
$string['unfinished'] = 'avoin';
$string['ungraded'] = 'Arvioimatta';
$string['unit'] = 'Yksikkö';
$string['unknowntype'] = 'Kysymyksen tyyppiä ei ole tuettu rivillä {$a}. Kysymys ohitetaan.';
$string['unusedcategorydeleted'] = 'Tämä kategoria poistettiin, koska kurssin poistamisen jälkeen sen kysymyksiä ei enää käytetty.';
$string['updatesettings'] = 'Päivitä tentin asetukset';
$string['updatingatttemptgrades'] = 'Päivitetään suorituskertojen arvosanat.';
$string['updatingfinalgrades'] = 'Päivitetään lopullisia arvosanoja.';
$string['updatingthegradebook'] = 'Päivitetään Arvioinnit.';
$string['upgradesure'] = '<div>Erityisesti tentti-moduuli muokkaa rajusti tenttitaulukoita, eikä tätä päivitystä ole vielä testattu riittävästi. Kannattaa ehdottomasti tehdä varmuuskopio tietokannastasi ennen kuin jatkat.</div>';
$string['upgradingquizattempts'] = 'Päivitetään tenttisuoritukset: tentti {$a->done}/{$a->outof} (Tentti id {$a->info})';
$string['upgradingveryoldquizattempts'] = 'Päivitetään todella vanhoja tenttisuorituksia: {$a->done}/{$a->outof}';
$string['url'] = 'Web-osoite';
$string['usedcategorymoved'] = 'Tämä kategoria siirrettiin sivuston tasolle, koska kurssin poistamisen jälkeen sen kysymyksiä käyttivät yhä muut tentit palvelimella.';
$string['useroverrides'] = 'Osallistujien poikkeuspääsyt';
$string['usersnone'] = 'Opiskelijoilla ei ole pääsyä tähän tenttiin.';
$string['validate'] = 'Vahvista';
$string['viewallanswers'] = 'Katso {$a} suoritetut tentit';
$string['viewallreports'] = 'Katso raportit {$a} suorituksista';
$string['viewed'] = 'Katsottu';
$string['warningmissingtype'] = '<b>Tätä kysymystyyppiä ei ole asennettu Moodlees.</b> Ota yhteyttä Moodle ylläpitäjääsi.';
$string['wheregrade'] = 'Missä arvosanani on?';
$string['wildcard'] = 'Muuttuja';
$string['windowclosing'] = 'Tämä ikkuna sulkeutuu pian.';
$string['withsummary'] = 'yhteenvetotilastojen kanssa';
$string['wronguse'] = 'Et voi käyttää tätä sivua noin';
$string['xhtml'] = 'XHTML-muoto';
$string['youneedtoenrol'] = 'Sinun pitää reksteröityä tälle kurssille ennen kuin voit suorittaa tämän tentin';
$string['yourfinalgradeis'] = 'Lopullinen tuloksesi tästä tentistä on: {$a}';
