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
 * Strings for component 'forum', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   forum
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addanewdiscussion'] = 'Lisää uusi viesti';
$string['addanewquestion'] = 'Lisää uusi kysymys';
$string['addanewtopic'] = 'Lisää uusi aihe';
$string['advancedsearch'] = 'Laajennettu haku';
$string['allforums'] = 'Kaikki keskustelualueet';
$string['allowdiscussions'] = 'Voiko {$a} avata uusia keskusteluja?';
$string['allowsallsubscribe'] = 'Kaikki voivat tilata tämän keskustelualueen';
$string['allowsdiscussions'] = 'Tällä keskustelualueella jokainen saa aloittaa yhden uuden keskustelun.';
$string['allsubscribe'] = 'Tilaa kaikki keskustelualueet';
$string['allunsubscribe'] = 'Poista kaikki tilaukset';
$string['alreadyfirstpost'] = 'Tämä on jo keskustelun ensimmäinen viesti';
$string['anyfile'] = 'Mikä tahansa tiedosto';
$string['attachment'] = 'Liite';
$string['attachment_help'] = 'Voit lisätä yhden tai useamman liitetiedoston viestiisi. Jos lisäät kuvan, se näytetään tekstisi jälkeen.

Tästä ominaisuudesta on hyötyä, kun haluat jakaa tiedostoja kaikkien osallistujien kesken. Keskustelualuetta voikin hyvin käyttää kurssituotosten palautukseen, niistä keskusteluun ja myös niiden arviointiin, näin halutessasi.

Liitetiedostot voivat olla minkä tyyppisiä tahansa. Suositeltavaa on kuitenkin, että tiedostot nimetään käyttäen kolmikirjaimisia tiedostopäätteitä, kuten .doc Word -asiakirjoissa ja .jpg tai .png kuvissa. Näin toisten kurssilaisten on helpointa avata ja katsoa liitettäsi omalla selaimellaan.';
$string['attachmentnopost'] = 'Et voi viedä liitteitä ilman viestin id:tä';
$string['attachments'] = 'Liitteet';
$string['blockafter'] = 'Postituksen raja';
$string['blockafter_help'] = 'Tällä asetuksella määrittelet yhden osallistujan kirjoittamien viestien enimmäismäärän seuraavaksi määrittelemäsi ajanjakson aikana.';
$string['blockperiod'] = 'Ajanjakso';
$string['blockperioddisabled'] = 'Rajoitus ei käytössä';
$string['blockperiod_help'] = '<h2>Postituksen rajoittaminen</h2>

<p>Postituksen rajoittamisen idea on yksinkertainen: käyttäjältä estetään viestien lähettäminen keskustelualueelle valitun viestimäärän jälkeen, valitulla ajanjaksolla, ja tätä rajaa lähestyessään käyttäjä saa varoitusviestin aiheesta.</p>

<p>Asettamalla varoituksen rajan 0:ksi kytkeytyy varoitusviesti pois käytöstä, ja asettamalla postitusrajan 0:ksi kytkeytyy viestien rajoitus pois käytöstä. Jos viestien rajoitus on pois käytöstä, varoituskin automaattisesti on.</p>

<p>Mikään näistä asetuksista ei rajoita opettajien viestien lähettämistä.</p>';
$string['blogforum'] = 'Normaali keskustelualue näytetään blogimaisessa muodossa';
$string['bynameondate'] = '{$a->name} - {$a->date}';
$string['cannotadd'] = 'Viestiä ei voitu lisätä tähän keskusteluun';
$string['cannotadddiscussion'] = 'Vain ryhmän jäsenet voivat lisätä viestejä tälle keskustelualueelle.';
$string['cannotadddiscussionall'] = 'Sinulla ei ole oikeuksia lisätä kaikille osallistujille näkyvää viestiä.';
$string['cannotaddsubscriber'] = 'Ei voinut lisätä tilaajaa id:llä {$a} tälle keskustelualueelle!';
$string['cannotaddteacherforumto'] = 'Ei voitu lisätä muunnettua opettajakeskustelualuetta kurssille osaan 0.';
$string['cannotcreatediscussion'] = 'Ei voitu luoda uutta keskustelua';
$string['cannotcreateinstanceforteacher'] = 'Ei voitu luoda uutta kurssimoduulia opettajien keskustelualueelle';
$string['cannotdeleteforummodule'] = 'Et voi poistaa keskustelualue-moduulia.';
$string['cannotdeletepost'] = 'Et voi poistaa tätä viestiä!';
$string['cannoteditposts'] = 'Et voi muokata toisten osallistujien viestejä!';
$string['cannotfinddiscussion'] = 'Ei löydetty keskustelua tästä keskustelualueesta';
$string['cannotfindfirstpost'] = 'Tämän keskustelun aloitusviestiä ei löytynyt.';
$string['cannotfindorcreateforum'] = 'Ei löydetty tai voitu luoda pääuutiset -keskustelualuetta sivustolle';
$string['cannotfindparentpost'] = 'Aiempaa viestiä ei löytynyt kirjoitukselle {$a}';
$string['cannotmovefromsingleforum'] = 'Ei voida siirtää keskustelua yksinkertaiselta yhden keskustelun keskustelualueelta';
$string['cannotmovenotvisible'] = 'Keskustelualue ei ole näkyvissä.';
$string['cannotmovetonotexist'] = 'Et voi siirtää kyseiseen keskustelualueeseen - keskustelualuetta ei ole olemassa!';
$string['cannotmovetonotfound'] = 'Kohdekeskustelualuetta ei löytynyt tältä kurssilta.';
$string['cannotmovetosingleforum'] = 'Keskustelualueen tyyppiä ei voi vaihtaa yhdeksi keskusteluksi';
$string['cannotpurgecachedrss'] = 'Ei voitu puhdistaa välimuistissa olevia RSS-syötteitä lähde ja/tai kohde keskustelualueilta - tarkista tiedostosi permissionsforums';
$string['cannotremovesubscriber'] = 'Ei voitu poistaa tilaajaa id:llä {$} tältä keskustelualueelta!';
$string['cannotreply'] = 'Et voi vastata tähän viestiin.';
$string['cannotsplit'] = 'Keskusteluja ei voi erottaa tältä keskustelualueelta';
$string['cannotsubscribe'] = 'Sinun täytyy olla ryhmän jäsen tilataksesi tämän keskustelun.';
$string['cannottrack'] = 'Ei voitu lopettaa keskustelualueen seuraamista';
$string['cannotunsubscribe'] = 'Tämän keskustelun tilaustasi ei voitu perua.';
$string['cannotupdatepost'] = 'Et voi päivittää tätä kirjoitusta';
$string['cannotviewpostyet'] = 'Jotta näkisit muiden vastaukset kysymyksiin, pitää sinun ensin lähettää oma vastauksesi';
$string['cannotviewusersposts'] = 'Tällä käyttäjällä ei ole kirjoituksia, joita voisit katsella';
$string['cleanreadtime'] = 'Kellonaika, jolloin vanhat viestit merkitään luetuiksi';
$string['completiondiscussions'] = 'Opiskelijan pitää avata keskusteluja:';
$string['completiondiscussionsgroup'] = 'Vaadi keskustelua';
$string['completiondiscussionshelp'] = 'vaaditaan keskustelua suoritukseksi';
$string['completionposts'] = 'Opiskelijan täytyy vastata keskusteluun tai aloittaa uusi:';
$string['completionpostsgroup'] = 'Vaadi kirjoituksia';
$string['completionpostshelp'] = 'vaaditaan keskusteluja tai vastauksia suoritukseksi';
$string['completionreplies'] = 'Opiskelijan on vastattava keskusteluihin:';
$string['completionrepliesgroup'] = 'Vaadi vastauksia';
$string['completionreplieshelp'] = 'vaaditaan vastauksia suoritukseksi';
$string['configcleanreadtime'] = 'Kellonaika, jolloin päivittäin poistetaan vanhat viestit \'luettu\'-taulukosta.';
$string['configdigestmailtime'] = 'Käyttäjät, jotka tilaavat keskustelualueviestit sähköpostiinsa tiivistelmänä saavat yhden sähköpostiviestin päivittäin. Tämä asetus säätää, mihin aikaan päivästä tuo sähköposti lähetetään (ensimmäinen cron, joka ajetaan tämän tunnin jälkeen lähettää sähköpostit).';
$string['configdisplaymode'] = 'Oletusasetus keskustelujen näyttämiselle, jos sellaista ei ole asetettu.';
$string['configenablerssfeeds'] = 'Tämä mahdollistaa RSS-syötteet eri keskustelualueilta. Sinun pitää vielä erikseen kytkeä RSS päälle niiden keskustelualueiden asetuksista, joille haluat käyttää RSS-syötteitä.';
$string['configenabletimedposts'] = 'Valitse \'kyllä\', jos haluat sallia valittavaksi ajanjakson keskustelun näyttämiselle. (Kokeellinen ominaisuus, ei täysin testattu.)';
$string['configlongpost'] = 'Tätä pidemmät keskustelut käsitellään pitkinä (HTML-koodia ei lasketa mukaan). Keskustelut sivuston etusivulla, keskustelu-muotoisen kurssin etusivulla sekä käyttäjien profiilisisivuilla olevat viestit lyhennetään jostakin luontevasta kohdasta arvojen forum_shortpost ja forum_longpost väliltä.';
$string['configmanydiscussions'] = 'Yhdellä sivulla näytettävien keskusteluviestien maksimimäärä';
$string['configmaxattachments'] = 'Oletus-enimmäismäärä liitteitä yhdessä keskustelualueviestissä';
$string['configmaxbytes'] = 'Oletusasetus liitetiedoston maksimikoolle koko sivustolla.';
$string['configoldpostdays'] = 'Kuinka monta päivää vanhoja viestejä pidetään luettuina?';
$string['configreplytouser'] = 'Kun viesti keskustelualueelle lähetetään sähköpostilla, pitäisikö sen sisältää kirjoittajan sähköpostiosoite, jotta vastaanottajat voisivat vastata henkilökohtaisesti ennemmin kuin keskustelualueen kautta? Vaikka asetukseksi valittaisiin kyllä, käyttäjät voivat valita asetuksissaan pitävänsä sähköpostiosoitteensa salaisena.';
$string['configshortpost'] = 'Tätä lyhyemmät keskustelut ovat lyhyitä (HTML-koodia ei lasketa mukaan).';
$string['configtrackreadposts'] = 'Aseta ´Kyllä´ jos haluat seurata jokaisen käyttäjän kohdalla viestien luettu/lukematon-tilaa.';
$string['configusermarksread'] = '´Kyllä´ vaatii käyttäjän merkitsevän viestin itse luetuksi, kun taas ´Ei´-asetuksella viestit merkitään automaattisesti luetuiksi, kun ne luetaan.';
$string['confirmsubscribe'] = 'Haluatko tilata keskustelualueen {$a}?';
$string['confirmunsubscribe'] = 'Haluatko perua keskustelualueen {$a} tilauksen?';
$string['couldnotadd'] = 'Viestiäsi ei voida lisätä tuntemattoman virheen takia.';
$string['couldnotdeletereplies'] = 'Valitettavasti viestiä ei voida poistaa, koska siihen on jo vastattu';
$string['couldnotupdate'] = 'Viestiäsi ei voida päivittää tuntemattoman virheen takia';
$string['delete'] = 'Poista';
$string['deleteddiscussion'] = 'Keskustelu on poistettu';
$string['deletedpost'] = 'Viesti on poistettu';
$string['deletedposts'] = 'Nuo viestit on poistettu';
$string['deletesure'] = 'Oletko varma, että haluat poistaa tämän viestin?';
$string['deletesureplural'] = 'Oletko varma, että haluat poistaa tämän viestin ja kaikki vastaukset ({$a} viestiä)?';
$string['digestmailheader'] = 'Tässä on tämän päivän tiivistelmä keskustelualueilta {$a->sitename}. Vaihtaaksesi postitusasetuksia käy osoitteessa {$a->userprefs}.';
$string['digestmailprefs'] = 'asetuksesi';
$string['digestmailsubject'] = '{$a}: kerätyt keskustelut';
$string['digestmailtime'] = 'Keräilty posti lähetetään';
$string['digestsentusers'] = 'Kerätty posti lähetetty {$a} käyttäjälle';
$string['disallowsubscribe'] = 'Tilauksia ei sallita';
$string['disallowsubscribeteacher'] = 'Tilauksia ei sallita (muuta kuin opettajille)';
$string['discussion'] = 'Keskustelu';
$string['discussionmoved'] = 'Tämä keskustelu on siirretty paikkaan \'{$a}\'';
$string['discussionmovedpost'] = 'Tämä keskustelu on siirretty <a href="{$a->discusshref}">tänne</a> keskustelualueella <a href="{$a->forumhref}">{$a->forumname}</a>';
$string['discussionname'] = 'Keskustelun nimi';
$string['discussions'] = 'Keskustelut';
$string['discussionsstartedby'] = 'Keskustelun on aloittanut {$a}';
$string['discussionsstartedbyrecent'] = 'Viimeisimmän keskustelun aloittaja {$a}';
$string['discussionsstartedbyuserincourse'] = 'Käyttäjän {$-> fullname} aloittamat keskustelut kurssilla {$-> coursename}';
$string['discussthistopic'] = 'Keskustele aiheesta';
$string['displayend'] = 'loppuu';
$string['displayend_help'] = 'Tämä asetus määrittää, pitäisikö keskustelualueen viesti piilottaa tietyn päivämäärän jälkeen. Huomaa, että järjestelmänvalvojat voivat aina katsella viestejä.';
$string['displaymode'] = 'Näytön tila';
$string['displayperiod'] = 'Viesti on näkyvissä ajan';
$string['displaystart'] = 'alkaa';
$string['displaystart_help'] = 'Tämä asetus määrittää, pitäisikö keskustelualueen viestin näkyä tietystä päivämäärästä alkaen. Huomaa, että järjestelmänvalvojat voivat aina katsella viestejä.';
$string['eachuserforum'] = 'Jokainen avaa yhden uuden keskustelun';
$string['edit'] = 'Muokkaa';
$string['editedby'] = 'Muokannut {$a->name} - {$a->date}';
$string['editing'] = 'Muokataan';
$string['emptymessage'] = 'Jotain oli vialla viestissäsi. Ehkä jätit viestisi tyhjäksi tai liitetiedosto oli liian suuri. Muutoksiasi EI tallennettu.';
$string['erroremptymessage'] = 'Viestin tekstiosa ei voi olla tyhjä';
$string['erroremptysubject'] = 'Viestin otsikko ei voi olla tyhjä';
$string['errorenrolmentrequired'] = 'Sinun täytyy olla kirjautunut tälle kurssille päästäksesi tähän sisältöön';
$string['errorwhiledelete'] = 'Tapahtui virhe poistettaessa tietoa.';
$string['everyonecanchoose'] = 'Kaikki voivat tilata tämän keskustelualueen';
$string['everyonecannowchoose'] = 'Kaikki voivat nyt halutessaan tilata tämän keskustelualueen';
$string['everyoneisnowsubscribed'] = 'Nyt kaikki tilaavat tämän keskustelualueen';
$string['everyoneissubscribed'] = 'Kaikki tilaavat tämän keskustelualueen';
$string['existingsubscribers'] = 'Nykyiset tilaajat';
$string['exportdiscussion'] = 'Vie koko keskustelu';
$string['forcessubscribe'] = 'Kaikki tilaavat tämän keskustelualueen';
$string['forum'] = 'Keskustelualue';
$string['forum:addnews'] = 'Lisää uutinen';
$string['forum:addquestion'] = 'Lisää kysymys';
$string['forumauthorhidden'] = 'Kirjoittaja (piilotettu)';
$string['forumblockingalmosttoomanyposts'] = 'Lähestyt viestin lähetyksen rajaa. Olet lähettänyt {$a->numposts} viestiä {$a->blockperiod} aikana ja rajana on {$a->blockafter} viestiä.';
$string['forumbodyhidden'] = 'Et voi lukea tätä viestiä, koska et ole vielä osallistunut keskusteluun tai viestin editointiaika ei ole kulunut loppuun.';
$string['forum:createattachment'] = 'Liitetiedoston luonti';
$string['forum:deleteanypost'] = 'Viestin poisto';
$string['forum:deleteownpost'] = 'Oman viestin poisto';
$string['forum:editanypost'] = 'Viestien muokkaus';
$string['forum:exportdiscussion'] = 'Vie koko keskustelu';
$string['forum:exportownpost'] = 'Vie oma viesti';
$string['forum:exportpost'] = 'Vie viesti';
$string['forumintro'] = 'Keskustelualueen johdanto';
$string['forum:managesubscriptions'] = 'Tilausten hallinta';
$string['forum:movediscussions'] = 'Keskusteluiden siirto';
$string['forumname'] = 'Keskustelualueen nimi';
$string['forumposts'] = 'Keskustelualueen viestit';
$string['forum:postwithoutthrottling'] = 'Vapauta viestien kynnyksestä';
$string['forum:rate'] = 'Viestien arviointi';
$string['forum:replynews'] = 'Uutisiin vastaaminen';
$string['forum:replypost'] = 'Viestiin vastaaminen';
$string['forums'] = 'Keskustelualueet';
$string['forum:splitdiscussions'] = 'Keskustelujen jakaminen';
$string['forum:startdiscussion'] = 'Uuden keskustelun luominen';
$string['forumsubjecthidden'] = 'Otsikko (piilotettu)';
$string['forum:throttlingapplies'] = 'Kavennus pätee';
$string['forumtracked'] = 'Uusia viestejä seurataan';
$string['forumtrackednot'] = 'Uusia viestejä ei seurata';
$string['forumtype'] = 'Keskustelualueen tyyppi';
$string['forumtype_help'] = '<h2>Keskustelualueet</h2>

<p>Vaihtoehtoina on valikoima erilaisia keskustelualueita:</p>

<p><b>Yksi keskustelu</b> - vain yksittäinen aihe, joka on kokonaisuudessaan yhdellä sivulla. Käyttökelpoinen lyhyissä, tarkasti rajatuissa keskusteluissa.</p>

<p><b>Keskustelualue yleiseen käyttöön</b> - avoin keskustelualue, jossa kuka tahansa voi aloittaa uuden keskustelunaiheen milloin tahansa. Tämä on paras vaihtoehto yleiskäyttöön.</p>

<p><b>Jokainen avaa yhden uuden keskustelun </b> - Jokainen voi lähettää tasan yhden uuden keskustelunaiheen (kaikki voivat kuitenkin vastata jokaiseen). Tämä vaihtoehto on käytännöllinen, jos haluat, että jokainen opiskelija aloittaa uuden keskustelun esim. siitä, millaisia ajatuksia viikon aihe on heissä herättänyt, ja kaikki muut vastaavat.</p>

<p><b>Kysymys- ja vastausalue</b> - vaatii opiskelijoilta oman viestin ennen kuin he pääsevät näkemään muiden opiskelijoiden viestejä. Ensimmäisen viestinsä jälkeen opiskelijat voivat lukea muiden opiskelijoiden viestejä ja vastata niihin. Tämä ominaisuus mahdollistaa kaikille osallistujille yhtäläisen mahdollisuuden tuottaa oma alustuksensa, kannustaen itsenäiseen ajatteluun.</p>

<p>Blogi-tyyppinen keskustelu - avoin keskustelualue, jonka keskusteluaiheet listataan yhdellä sivulla ja kussakin on linkki "keskustele tästä aiheesta".</p>

<p>Lisäksi kullakin kurssialueella on keskustelualue <b>Uutiset</b>, jolle vain opettajat voivat kirjoittaa ja viestit pakotetaan kaikkien osallistujien sähköpostiin.</p>';
$string['forum:viewallratings'] = 'Näytä kaikki eri käyttäjien antamat arvioinnit';
$string['forum:viewanyrating'] = 'Kaikkien arviointien katselu';
$string['forum:viewdiscussion'] = 'Keskustelujen katselu';
$string['forum:viewhiddentimedposts'] = 'Katsele piilo ajastettuja viestejä';
$string['forum:viewqandawithoutposting'] = 'Näytä aina kysymys ja vastausalueen viestit.';
$string['forum:viewrating'] = 'Näytä saamasi kokonaisarviointi';
$string['forum:viewsubscribers'] = 'Tilaajien tarkastelu';
$string['generalforum'] = 'Keskustelualue yleiseen käyttöön';
$string['generalforums'] = 'Yleiset keskustelualueet';
$string['inforum'] = '{$a} :ssa';
$string['introblog'] = 'Tämän keskustelualueen viestit on kopioitu tänne automaattisesti tämän kurssin käyttäjien blogeista, koska kyseisiä blogimerkintöjä ei ole enää saatavilla.';
$string['intronews'] = 'Yleiset uutiset ja tiedotteet';
$string['introsocial'] = 'Avoin keskustelualue vapaalle keskustelulle';
$string['introteacher'] = 'Opettajien oma keskustelualue';
$string['invalidaccess'] = 'Sivulle ei saavuttu oikein';
$string['invaliddiscussionid'] = 'Keskustelun ID oli väärä tai sitä ei enää ole';
$string['invalidforcesubscribe'] = 'Virheellinen pakota tilaus -tila';
$string['invalidforumid'] = 'Keskustelualueen ID oli väärä';
$string['invalidparentpostid'] = 'Alkuperäisen viestin ID oli väärä';
$string['invalidpostid'] = 'Virheellinen viestin ID - {$}';
$string['lastpost'] = 'Viimeisin viesti';
$string['learningforums'] = 'Keskustelualueet opiskelulle';
$string['longpost'] = 'Pitkä viesti';
$string['mailnow'] = 'Postita nyt';
$string['manydiscussions'] = 'Keskustelua sivulla';
$string['markalldread'] = 'Merkitse kaikki viestit tässä keskustelussa luetuiksi';
$string['markallread'] = 'Merkitse kaikki viestit tällä keskustelualueella luetuiksi';
$string['markread'] = 'Merkitse luetuksi';
$string['markreadbutton'] = 'Merkitse<br />luetuksi';
$string['markunread'] = 'Merkitse lukemattomaksi';
$string['markunreadbutton'] = 'Merkitse<br />lukemattomaksi';
$string['maxattachments'] = 'Liitetiedostojen maksimimäärä';
$string['maxattachments_help'] = 'Tällä asetuksella määrittelet yhteen keskusteluviestiin lisättävien liitetiedostojen enimmäismäärän.';
$string['maxattachmentsize'] = 'Liitteen maksimikoko';
$string['maxattachmentsize_help'] = '<h2>Liitetiedoston maksimikoko</h2>

<P>Keskustelualueen perustaja voi määritellä liitetiedostoille maksimikoon tai estää halutessaan liitetiedostojen lataamisen.</p>';
$string['maxtimehaspassed'] = 'Valitettavasti suurin sallittu muokkausaika on ylittynyt tämän ({$a}) viestin osalta!';
$string['message'] = 'Viesti';
$string['messageprovider:digests'] = 'Tilatut keskustelutiivistelmät';
$string['messageprovider:posts'] = 'Tilatut keskusteluviestit';
$string['missingsearchterms'] = 'Seuraavat etsityt termit esiintyvät vain tämän viestin HTML-merkinnöissä:';
$string['modeflatnewestfirst'] = 'Näytä vastaukset peräkkäin, uusin ensin';
$string['modeflatoldestfirst'] = 'Näytä vastaukset peräkkäin, vanhin ensin';
$string['modenested'] = 'Näytä vastaukset sisäkkäin';
$string['modethreaded'] = 'Näytä vastaukset säikeittäin';
$string['modulename'] = 'Keskustelualue';
$string['modulename_help'] = 'Keskustelualue on eräs keskeisimmistä Moodlen tarjoamista toiminnallisuuksista - suurin osa kurssin keskusteluista käydään tyypillisesti keskustelualueilla. Keskustelualueita voi rakentaa useilla eri tavoilla ja niihin voi lisätä vertaisarvioinnin. Viesteissä voi myös olla mukana liitteitä. Jos osallistuja tilaa keskustelualueen, hän saa kopiot kaikista uusista viesteistä sähköpostiinsa. Opettaja voi myös halutessaan pakottaa kaikki osallistujat tilaamaan tietyn keskustelualueen, kuten kurssin uutiset.';
$string['modulenameplural'] = 'Keskustelualueet';
$string['more'] = 'lisää';
$string['movedmarker'] = '(Siirretty)';
$string['movethisdiscussionto'] = 'Siirrä tämä keskustelu ...';
$string['mustprovidediscussionorpost'] = 'Viedäksesi sinun on annettava joko keskustelun tai viestin id';
$string['namenews'] = 'Uutiset';
$string['namenews_help'] = 'Keskustelualue Uutiset luodaan automaattisesti kullekin kurssialueelle, ja kullakin kurssialueella voi olla tasan yksi Uutiset-keskustelualue. Vain opettajat ja ylläpito voivat kirjoittaa viestejä. Uusimmat uutisviestit näkyvät halutessasi sivulohkossa Viimeisimmät uutiset, ja kaikki viestit lähtevät pakotetusti kaikkien osallistujien sähköpostiin.';
$string['namesocial'] = 'Yleinen keskustelu';
$string['nameteacher'] = 'Opettajien keskustelualue';
$string['newforumposts'] = 'Keskustelualueen uudet viestit';
$string['noattachments'] = 'Tässä viestissä ei ole liitteitä.';
$string['nodiscussions'] = 'Tällä keskustelualueella ei ole vielä keskusteluja';
$string['nodiscussionsstartedby'] = '{$} ei ole aloittanut keskusteluja';
$string['nodiscussionsstartedbyyou'] = 'Et ole vielä aloittanut yhtään keskustelua';
$string['noguestpost'] = 'Vierailijat eivät voi kirjoittaa keskustelualueelle';
$string['noguesttracking'] = 'Vierailijat eivät voi asettaa seuraamisvalintoja.';
$string['nomorepostscontaining'] = 'Viestejä, jotka sisältävät \'{$a}\', ei löytynyt.';
$string['nonews'] = 'Ei vielä uutisia';
$string['noonecansubscribenow'] = 'Tilauksia ei sallita.';
$string['nopermissiontosubscribe'] = 'Sinulla ei ole oikeuksia nähdä tämän keskustelualueen tilaajia.';
$string['nopermissiontoview'] = 'Sinulla ei ole oikeuksia nähdä tätä viestiä.';
$string['nopostforum'] = 'Et voi lähettää viestejä tälle keskustelualueelle';
$string['noposts'] = 'Ei viestejä';
$string['nopostscontaining'] = 'Viestejä, jotka sisältävät \'{$a}\' ei löytynyt';
$string['nopostsmadebyuser'] = '{$} ei ole lähettänyt yhtään viestiä';
$string['nopostsmadebyyou'] = 'Et ole lähettänyt yhtään viestiä';
$string['noquestions'] = 'Alueella ei vielä ole kysymyksiä';
$string['nosubscribers'] = 'Tällä keskustelualueella ei ole tilaajia';
$string['notexists'] = 'Keskustelua ei ole enää olemassa';
$string['nothingnew'] = 'Ei mitään uutta {$a}';
$string['notingroup'] = 'Sinun pitää olla ryhmän jäsen saadaksesi nähdä tämän keskustelualueen.';
$string['notinstalled'] = 'Keskustelualue -moduulia ei ole asennettu';
$string['notpartofdiscussion'] = 'Tämä viesti ei ole osa mitään keskustelua!';
$string['notrackforum'] = 'Älä seuraa lukemattomia viestejä';
$string['noviewdiscussionspermission'] = 'Sinulla ei ole oikeuksia lukea tämän keskustelualueen viestejä';
$string['nowallsubscribed'] = 'Tilaus päällä kaikilla keskustelualueilla kurssilla {$a}.';
$string['nowallunsubscribed'] = 'Tilaus pois päältä kaikilla keskustelualueilla kurssilla {$a}.';
$string['nownotsubscribed'] = '{$a->name} EI saa kopioita viesteistä\'{$a->forum}\' sähköpostiinsa.';
$string['nownottracking'] = '{$a->name} ei enää seuraa \'{$a->forum}\'.';
$string['nowsubscribed'] = '{$a->name} SAA kopiot viesteistä \'{$a->forum}\' sähköpostiinsa.';
$string['nowtracking'] = '{$a->name} seuraa nyt \'{$a->forum}\'.';
$string['numposts'] = '{$a} viestiä';
$string['olderdiscussions'] = 'Vanhat keskustelut';
$string['oldertopics'] = 'Vanhat aiheet';
$string['oldpostdays'] = 'Lue jonkun ajan kuluttua';
$string['openmode0'] = 'Ei keskusteluja, ei vastauksia';
$string['openmode1'] = 'Ei keskusteluja, mutta vastaaminen sallitaan';
$string['openmode2'] = 'Keskustelut ja vastaukset sallitaan';
$string['overviewnumpostssince'] = 'viestiä edellisen kirjautumisen jälkeen';
$string['overviewnumunread'] = 'lukematta';
$string['page-mod-forum-discuss'] = 'Keskustelualuemoduulin viestiketjusivu';
$string['page-mod-forum-view'] = 'Keskustelualuemoduulin pääsivu';
$string['page-mod-forum-x'] = 'Kaikki keskustelualuemoduulin sivut';
$string['parent'] = 'Näytä aiempi';
$string['parentofthispost'] = 'Tämän viestin alku';
$string['pluginadministration'] = 'Keskustelualueen hallinnointi';
$string['pluginname'] = 'Keskustelualue';
$string['postadded'] = '<p>Viestisi on lisätty.</p><p>Sinulla on {$a} aikaa muokata viestiä, jos haluat muuttaa sitä.</p>';
$string['postaddedsuccess'] = 'Viestisi on lähetetty';
$string['postaddedtimeleft'] = 'Sinulla on {$a} aikaa muokata viestiäsi.';
$string['postincontext'] = 'Katso tätä viestiä asiayhteydessään';
$string['postmailinfo'] = 'Tämä on kopio viestistä sivustolla {$a}.';
$string['postmailnow'] = '<p>Viesti lähetetään heti kaikille tilaajille</p>';
$string['postrating1'] = 'Suurimmaksi osaksi eristyvää osaamista';
$string['postrating2'] = 'Eristyvää ja sosiaalista osaamista';
$string['postrating3'] = 'Suurimmaksi osaksi sosiaalista osaamista';
$string['posts'] = 'Viestit';
$string['postsmadebyuser'] = 'Käyttäjän {$a} kirjoittamat viestit';
$string['postsmadebyuserincourse'] = 'Käyttäjän {$a->fullname} kirjoittamat viestit kurssilla {$a->coursename}';
$string['posttoforum'] = 'Lähetä viesti';
$string['postupdated'] = 'Viestisi on päivitetty';
$string['potentialsubscribers'] = 'Mahdolliset tilaajat';
$string['processingdigest'] = 'Kerätään viestejä käyttäjälle {$a}';
$string['processingpost'] = 'Käsitellään viestiä {$a}';
$string['prune'] = 'Jaa';
$string['prunedpost'] = 'Uusi keskustelu on luotu tästä viestistä';
$string['pruneheading'] = 'Jaa keskustelu ja siirrä tämä viesti uuteen keskusteluun';
$string['qandaforum'] = 'Kysymys- ja vastausalue';
$string['qandanotify'] = 'Tämä on kysymys- ja vastausalue. Nähdäksesi muiden viestit kirjoita ensin omasi.';
$string['re'] = 'Re:';
$string['readtherest'] = 'Lue loput tästä aiheesta';
$string['replies'] = 'Vastaukset';
$string['repliesmany'] = '{$a} vastausta tähän mennessä';
$string['repliesone'] = '{$a} vastaus tähän mennessä';
$string['reply'] = 'Vastaa';
$string['replyforum'] = 'Vastaa keskustelualueelle';
$string['replytouser'] = 'Käytä sähköpostiosoitetta vastauksissa';
$string['resetforums'] = 'Poista viestit foorumista';
$string['resetforumsall'] = 'Poista kaikki viestit';
$string['resetsubscriptions'] = 'Poista keskustelualueen tilaukset';
$string['resettrackprefs'] = 'Poista kaikki keskustelualueen seurannan asetukset';
$string['rssarticles'] = 'Viimeisimpien RSS-viestien määrä';
$string['rssarticles_help'] = '<P ALIGN=CENTER><B>Viimeisimpien merkintöjen määrä</B></P>

<P>Tässä voit valita kuinka monta viestiä haluat ottaa mukaan uutissyötteeseen.


<P>Useimmille keskustelualueille riittää 5-20 viestiä. Määrää kannattaa suurentaa, jos keskustelualuetta käytetään paljon.';
$string['rsssubscriberssdiscussions'] = 'Näytä keskustelueen uutissyöte';
$string['rsssubscriberssposts'] = 'Näytä alueen "{$a}" viestien uutissyöte';
$string['rsstype'] = 'Tämän aktiviteetin syöte';
$string['rsstype_help'] = '<P ALIGN=CENTER><B>Uutissyöte tältä keskustelualueelta</B></P>

<P>Voit valita kahden eri uutissyötteen väliltä:</p>

<UL>
<LI><B>Keskustelut:</B> Tätä käytettäessä syötteeseen otetaan mukaan keskustelualueille aloitetut uudet keskustelut.</li>


<LI><B>Viestit:</B> Tätä käytettäessä syötteeseen otetaan mukaan kaikki keskustelualueelle tulleet uudet viestit. </li>
</UL>';
$string['search'] = 'Etsi';
$string['searchdatefrom'] = 'Viestien on oltava tätä uudempia';
$string['searchdateto'] = 'Viestien on oltava tätä vanhempia';
$string['searchforumintro'] = 'Syötä hakusanat yhteen tai useampaan seuraavista kentistä:';
$string['searchforums'] = 'Etsi viesteistä';
$string['searchfullwords'] = 'Näiden sanojen tulee olla kokonaisina sanoina';
$string['searchnotwords'] = 'Näitä sanoja EI saa esiintyä hakutuloksissa';
$string['searcholderposts'] = 'Selaa vanhoja viestejä';
$string['searchphrase'] = 'Tämän sanan pitää olla viesteissä tässä muodossa';
$string['searchresults'] = 'Haun tulokset';
$string['searchsubject'] = 'Näiden sanojen pitää olla viestien aiheessa';
$string['searchuser'] = 'Viestin kirjoittajan nimen on oltava';
$string['searchuserid'] = 'Kirjoittajan Moodle ID';
$string['searchwhichforums'] = 'Valitse miltä keskustelualueilta etsitään';
$string['searchwords'] = 'Nämä sanat saavat olla viestien missä osassa tahansa';
$string['seeallposts'] = 'Katso kaikki tämän käyttäjän kirjoittamat viestit';
$string['shortpost'] = 'Lyhyt viesti';
$string['showsubscribers'] = 'Näytä/Muokkaa tilaajia';
$string['singleforum'] = 'Yksi keskustelu';
$string['smallmessage'] = '{$a->user} kirjoitti keskusteluun {$a->forumname}';
$string['startedby'] = 'Aloittanut:';
$string['subject'] = 'Aihe';
$string['subscribe'] = 'Tilaa tämä keskustelualue';
$string['subscribeall'] = 'Tilaa tämä keskustelualue kaikille';
$string['subscribed'] = 'Tilaaja';
$string['subscribeenrolledonly'] = 'Vain kirjautuneet käyttäjät saavat tilata keskustelualueen sähköpostiinsa.';
$string['subscribenone'] = 'Peru tämän keskustelualueen tilaukset kaikilta';
$string['subscribers'] = 'Tilaajat';
$string['subscribersto'] = 'Tilaa \'{$a}\'';
$string['subscribestart'] = 'Lähetä sähköpostiini kopiot viesteistä tälle keskustelualueelle';
$string['subscribestop'] = 'En halua kopioita tälle keskustelualueelle lähetetyistä viesteistä';
$string['subscription'] = 'Tilaus';
$string['subscriptionauto'] = 'Automaattitilaus';
$string['subscriptiondisabled'] = 'Tilaus pois päältä';
$string['subscriptionforced'] = 'Pakotettu tilaus';
$string['subscription_help'] = '<h2>Keskustelualueen tilaaminen</h2>

<p>Keskustelualueen tilaaminen merkitsee sitä, että tilaajalle lähetetään sähköpostilla kopio jokaisesta kyseiseen foorumiin lähetettävästä viestistä. Viestit lähetetään <?PHP echo $CFG->maxeditingtime/60 ?> minuuttia sen jälkeen kuin kirjoittaja on ne laatinut. Tuon ajan sisään kirjoittajalla on myös mahdollista muokata viestiään siten, että muokkaus ehtii lähteviin sähköposteihin.</p>

<p>Tavallisesti osallistuja voi valita, tilaako hän keskustelualueen vai ei. Jos opettaja kuitenkin edellyttää tietyn keskustelualueen tilaamisen, tämä valintamahdollisuus ei päde, vaan jokainen kurssilainen saa sähköpostikopiot. Pakotettu tilaus sopii erityisen hyvin Uutisiin, ja muillekin keskustelualueille kurssin alussa, ennen kuin kaikille on selvää, että he voivat tilata näitä sähköposteja itse.</p>';
$string['subscriptionmode'] = 'Tilauksen tila';
$string['subscriptionmode_help'] = '<h2>Keskustelualueen tilaaminen</h2>

<P>Keskustelualueen tilaaminen merkitsee sitä, että tilaajalle lähetetään sähköpostilla kopio jokaisesta kyseiselle keskustelualueelle lähetettävästä viestistä (viestit lähetetään <?PHP echo $CFG->maxeditingtime/60 ?> minuuttia sen jälkeen kuin kirjoittaja on ne laatinut).</P>

<P>Tyypillisesti kurssialueen osallistujien annetaan valita, haluaako hän tilata keskustelualueen vai ei. Joskus on kuitenkin syytä pakottaa osallistujat tietyn keskustelualueen tilaamiseen, jolloin kaikki käyttäjät liitetään sen tilaajiksi automaattisesti. Tämä vaihtoehto sopii erityisen hyvin Uutisille ja keskustelualueisiin kurssin alussa, ennen kuin kaikille on selvää, että he voivat tilata näitä sähköposteja itse.</P>

<p>Jos valitset vaihtoehdon "<strong>Kyllä, aluksi</strong>", kaikki nykyiset ja tulevat käyttäjät liitetään tilaajiksi automaattisesti, mutta he voivat perua tilauksen koska tahansa. Jos valitset "<strong>Kyllä, pysyvästi</strong>", käyttäjät eivät voi itse perua tilausta.</p>

<p>Huomaa kuinka "Kyllä, aluksi" -vaihtoehto toimii olemassa olevaa keskustelualuetta päivitettäessä: vaihdettaessa "Kyllä, aluksi" vaihtoehdosta vaihtoehtoon "Ei", olemassa olevia tilaajia ei poisteta, vaan valinta vaikuttaa vain tuleviin käyttäjiin. Samoin jos myöhemmin valitsee "Kyllä, aluksi", vaikuttaa sekin vain tuleviin käyttäjiin eikä kurssilla jo oleviin.</p>';
$string['subscriptionoptional'] = 'Valinnainen tilaus';
$string['subscriptions'] = 'Tilaukset';
$string['thisforumisthrottled'] = 'Keskustelualueelle lähetettävien viestien määrää on rajoitettu. Voit lähettää {$a->blockafter} viestiä {$a->blockperiod}';
$string['timedposts'] = 'Ajastettu viesti';
$string['timestartenderror'] = 'Loppumisaika ei voi olla ennen alkamisaikaa';
$string['trackforum'] = 'Seuraa lukemattomia viestejä';
$string['tracking'] = 'Seuraa';
$string['trackingoff'] = 'Pois päältä';
$string['trackingon'] = 'Päällä';
$string['trackingoptional'] = 'Valinnainen';
$string['trackingtype'] = 'Luettujen viestien seuranta';
$string['trackingtype_help'] = '<h2>Luettujen viestien seuranta</h2>

<p>Jos luettujen viestien seuranta on päällä, keskustelualueen viesteistä näytetään osallistujan lukemat ja lukemattomat viestit. Halutessaan opettaja voi pakottaa viestien seurannan päälle.</p>

<p>Asetuksella on kolme vaihtoehtoa:</p>
<ul>
<li> Valinnainen [oletus]: osallistujat voivat laittaa asetuksen päälle tai pois mielensä mukaan.</li>
<li>Päällä: Seuranta on aina päällä.</li>
<li>Pois päältä: Seuranta on aina pois päältä.</li>
</ul>';
$string['unread'] = 'Lukematta';
$string['unreadposts'] = 'Lukemattomia viestejä';
$string['unreadpostsnumber'] = '{$a} lukematonta viestiä';
$string['unreadpostsone'] = '1 lukematon viesti';
$string['unsubscribe'] = 'Peru tämän keskustelualueen tilaus';
$string['unsubscribeall'] = 'Poista tilaus kaikilta keskustelualueilta';
$string['unsubscribeallconfirm'] = 'Tilaat nyt {$a} keskustelualuetta. Haluatko poistaa tilauksen kaikilta keskustelualueilta ja poistaa automaattiset tilaukset käytöstä?';
$string['unsubscribealldone'] = 'Kaikki tilauksesi on nyt poistettu. Saatat silti saada viestejä keskustelualueilta, joissa kaikki on pakotettu tilaajiksi. Jos et halua saada mitään sähköposteja, voit määrittää sähköpostiosoitteesi pois käytöstä omassa profiilissasi.';
$string['unsubscribeallempty'] = 'Et tilaa yhtään keskustelualuetta. Jos et halua saada mitään sähköposteja, voit määrittää sähköpostiosoitteesi pois käytöstä omassa profiilissasi.';
$string['unsubscribed'] = 'Tilaamaton';
$string['unsubscribeshort'] = 'Peru tilaus';
$string['usermarksread'] = 'Manuaalinen viestien luetuksi merkkaaminen';
$string['viewalldiscussions'] = 'Näytä kaikki keskustelut';
$string['warnafter'] = 'Varoituksen raja';
$string['warnafter_help'] = 'Opiskelijota voidaan varoittaa kun heidän kirjoittamiensa viestien määrä lähestyy annettua maksimia annetulla ajanjaksolla. Tämä asetus määrittelee monenko viestin jälkeen heitä varoitetaan. Käyttäjien, joilla on kyky mod/forum:postwithoutthrottling, viestien määrää ei rajoiteta.';
$string['warnformorepost'] = 'Varoitus! Tällä keskustelualueella on useampia kuin yksi keskustelu. Nyt näytetään tuorein.';
$string['yournewquestion'] = 'Uusi kysymyksesi';
$string['yournewtopic'] = 'Uusi keskusteluaiheesi';
$string['yourreply'] = 'Vastauksesi';
