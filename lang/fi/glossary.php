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
 * Strings for component 'glossary', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   glossary
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcomment'] = 'Lisää kommentti';
$string['addentry'] = 'Lisää uusi hakusana';
$string['addingcomment'] = 'Lisää kommentti';
$string['alias'] = 'Avainsana';
$string['aliases'] = 'Avainsana(t)';
$string['aliases_help'] = '<h2>Avainsanat</h2>

<p>Jokaisessa sanaston merkinnässä voi olla aiheeseen liittyvä lista avainsanoja (aliaksia). Näitä sanoja voidaan käyttää vaihtoehtoisina tapoina viittaamaan merkintään. Niitä käytetään esimerkiksi silloin, kun luodaan automaattisia linkkejä.</p>

<p>Erottele avainsanat toisistaan rivinvaihdoilla (ei esim. pilkuilla).</p>';
$string['allcategories'] = 'Kaikki kategoriat';
$string['allentries'] = 'Kaikki';
$string['allowcomments'] = 'Salli hakusanojen kommentit';
$string['allowcomments_help'] = '<h2>Salli hakusanojen kommentointi</h2>

<p>Opiskelijoiden voi antaa kirjoittaa kommentteja hakusanoille. Voit valita onko tämä ominaisuus käytössä vai ei. </p>

<p>Opettajat voivat aina lisätä kommentteja hakusanoille. </p>';
$string['allowduplicatedentries'] = 'Salli samannimiset hakusanat';
$string['allowduplicatedentries_help'] = '<h2>Salli samannimiset hakusanat</h2>

<p>Jos haluat sallia samannimiset hakusanat, voi samalla käsitteellä eli sanaston sanalla olla useita selityksiä.</p>';
$string['allowprintview'] = 'Salli tulostusnäkymä';
$string['allowprintview_help'] = '<h2>Salli tulostusnäkymä</h2>

<p>Opiskelijoiden sallitaan nähdä sanaston tulostusnäkymä.</p>

<p>Opettajat saavat aina käyttää tulostusnäkymää.</p>';
$string['andmorenewentries'] = 'ja {$a} lisää uusia merkintöjä.';
$string['answer'] = 'Vastaus';
$string['approve'] = 'Vahvista';
$string['areyousuredelete'] = 'Haluatko todella poistaa tämän hakusanan?';
$string['areyousuredeletecomment'] = 'Haluatko todella poistaa tämän kommentin?';
$string['areyousureexport'] = 'Haluatko todella viedä tämän hakusanan sanastoon';
$string['ascending'] = 'nouseva';
$string['attachment'] = 'Liite';
$string['attachment_help'] = '<h2>Hakusanojen liitteet</h2>

<p>Voit ladata sanastoon halutessasi <em>yhden</em> liittetiedoston per hakusana. Liitetiedostoa voi käyttää esim. kuvien tai dokumenttien jakamiseen.</p>

<p>Tiedosto voi olla minkä tyyppinen vain, mutta on suositeltavaa käyttää vakiomuotoisia, kolmikirjaimisia tiedostopäätteitä, kuten .doc Word-dokumentille tai .jpg kuvatiedostolle. Näin muiden käyttäjien on helpompi avata tarjolla olevat liitteet.</p>

<p>Jos hakusanaa muokatessa liittää siihen uuden liitetiedoston, korvaa uusi tiedosto mahdollisen olemassa olevan liitetiedoston.</p>

<p>Jos hakusanaa muokatessa jättää liitetiedosto-kentän tyhjäksi, olemassa oleva liitetiedosto säilyy paikallaan.</p>';
$string['author'] = 'tekijä';
$string['authorview'] = 'Selaa kirjoittajan mukaan';
$string['back'] = 'Takaisin';
$string['cantinsertcat'] = 'Kategoriaa ei voi lisätä';
$string['cantinsertrec'] = 'Hakusanaa ei voi lisätä';
$string['cantinsertrel'] = 'Yhteyttä kategorian ja hakusanan välille ei voi lisätä';
$string['casesensitive'] = 'Kirjasinkoolla on merkitystä';
$string['casesensitive_help'] = '<h2>Kirjasinkoon vaikutus</h2>

<p>Tämä asetus määrittää, onko isojen ja pienten kirjainten käytöllä merkitystä linkitettäessä sanoja automaattisesti ko. hakusanaan.</p>

<p>Esimerkiksi, jos kirjasinkoolla <em>on</em> merkitystä, tekstissä käytetty sana "html" <em>ei</em> linkity hakusanaan "HTML". </p>
';
$string['cat'] = 'kategoria';
$string['categories'] = 'Kategoriat';
$string['category'] = 'Kategoria';
$string['categorydeleted'] = 'Kategoria poistettu';
$string['categoryview'] = 'Selaa kategorioiden mukaan';
$string['changeto'] = 'vaihda {$a}';
$string['cnfallowcomments'] = 'Määritä, saako sanaston hakusanoihin oletuksena lisätä kommentteja';
$string['cnfallowdupentries'] = 'Määritä, saako sanastossa oletuksena olla samannimisiä hakusanoja';
$string['cnfapprovalstatus'] = 'Määritä oletustila opiskelijoiden lisäämille hakusanoille.';
$string['cnfcasesensitive'] = 'Määritä, onko hakusanan kirjasinkoolla merkitystä, kun hakusana linkitetään.';
$string['cnfdefaulthook'] = 'Valitse oletuskokoelma näytettäväksi, kun sanastoon tutustutaan ensimmäistä kertaa.';
$string['cnfdefaultmode'] = 'Valitse oletuskehys, kun sanastoon tutustutaan ensimmäistä kertaa.';
$string['cnffullmatch'] = 'Määritä, tuleeko hakusanan ja linkitettävän kohdetekstin kirjasinkoon olla samat.';
$string['cnflinkentry'] = 'Määritä, onko hakusanan automaattinen linkitys oletus.';
$string['cnflinkglossaries'] = 'Määritä, onko sanaston automaattinen linkitys oletus.';
$string['cnfrelatedview'] = 'Valitse esitystapa automaattiselle linkittämiselle ja hakusanan katsomiselle.';
$string['cnfshowgroup'] = 'Näytetäänkö ryhmäerotin?';
$string['cnfsortkey'] = 'Valitse oletuslajitteluperuste.';
$string['cnfsortorder'] = 'Valitse oletuslajittelujärjestys.';
$string['cnfstudentcanpost'] = 'Voiko opiskelija oletusarvoisesti lisätä hakusanoja?';
$string['comment'] = 'Kommentti';
$string['commentdeleted'] = 'Kommentti poistettu';
$string['comments'] = 'Kommentit';
$string['commentson'] = 'Kommentit tähän';
$string['commentupdated'] = 'Kommentti on päivitetty.';
$string['completionentries'] = 'Opiskelijan täytyy luoda merkintöjä:';
$string['completionentriesgroup'] = 'Vaadi merkintöjä';
$string['concept'] = 'Käsite';
$string['concepts'] = 'Käsitteet';
$string['configenablerssfeeds'] = 'Tämä mahdollistaa uutissyötteiden lähettämisen kaikista sanastoista. Sinun pitää vielä erikseen kytkeä syötteet päälle jokaisen sanaston asetuksista.';
$string['current'] = 'Nykyinen järjestys {$a}';
$string['currentglossary'] = 'Nykyinen sanasto';
$string['date'] = 'päivämäärä';
$string['dateview'] = 'Selaa päiväysten mukaan';
$string['defaultapproval'] = 'Hakusanat julkaistaan heti';
$string['defaultapproval_help'] = '<h2>Hakusanat julkaistaan heti</h2>

<p>Tämä asetus määrittelee, mitä tapahtuu opiskelijoiden lisäämille hakusanoille. Ne voidaan automaattisesti julkaista eli laittaa näkyville kaikille. Muuten opettajan täytyy hyväksyä jokainen opiskelijan lisäämä hakusana erikseen.</p>
';
$string['defaulthook'] = 'Oletuskoukku';
$string['defaultmode'] = 'Oletustila';
$string['defaultsortkey'] = 'Järjestämisen oletusperuste';
$string['defaultsortorder'] = 'Oletusjärjestys';
$string['definition'] = 'Määritelmä';
$string['definitions'] = 'Määritelmät';
$string['deleteentry'] = 'Poista hakusana';
$string['deletenotenrolled'] = 'Poista rekisteröitymättömien käyttäjien lisäämät hakusanat';
$string['deletingcomment'] = 'Poistetaan kommenttia';
$string['deletingnoneemptycategory'] = 'Tämän kategorian poistaminen ei poista sen sisältämiä hakusanoja - ne merkitään kategorisoimattomiksi.';
$string['descending'] = 'laskeva';
$string['destination'] = 'Tuotujen merkintöjen kohde';
$string['destination_help'] = '<p>Voit määritellä mihin haluat tuoda hakusanat: </p>
<ul>
<li><strong>Nykyinen sanasto:</strong> Liittää tuodut hakusanat parhaillaan auki olevaan sanastoon.</li>
<li><strong>Uusi sanasto:</strong> Luo uuden sanaston, joka perustuu tietoon valituissa tuoduissa tiedostoissa, ja syöttää uudet hakusanat siihen.</li>
</ul>';
$string['displayformat'] = 'Sanaston selaustapa';
$string['displayformatcontinuous'] = 'Jatkuva';
$string['displayformatdictionary'] = 'Yksinkertainen sanakirja';
$string['displayformatencyclopedia'] = 'Tietosanakirja';
$string['displayformatentrylist'] = 'Hakusanalista';
$string['displayformatfaq'] = 'Usein kysytyt kysymykset (FAQ)';
$string['displayformatfullwithauthor'] = 'Kaikki tiedot';
$string['displayformatfullwithoutauthor'] = 'Kaikki tiedot paitsi tekijä';
$string['displayformat_help'] = '<h2>Sanaston hakusanojen selaustapa</h2>

<p>Tämä asetus määrittelee hakusanojen selaustavan sanastossa. Oletusmuodot ovat:</p>
<blockquote>
<dl>

<dt><b>Hakusanalista</b>:</dt>
<dd>Näyttää hakusanat linkkeinä.</dd>

<dt><strong>Jatkuva</strong>:</dt>
<dd>näyttää hakusanat peräkkäin ilman erottelua, muotoilukuvakkeita lukuun ottamatta.</dd>

<dt><b>Kaikki tiedot</b>:</dt>
<dd>Keskustenlualueen kaltainen näyttömuoto, joka näyttää myös laatijan tiedot. Liitetiedostot näytetään linkkeinä.</dd>

<dt><b>Kaikki tiedot paitsi tekijä</b>:</dt>
<dd>Keskustelualueen kaltainen näyttömuoto, joka ei näytä laatijan tietoja. Liitetiedostot näytetään linkkeinä.</dd>

<dt><b>Tietosanakirja</b>:</dt>
<dd>Kuten \'Kaikki tiedot\', lisäksi kuvat näytetään tekstin joukossa.</dd>

<dt><b>Usein kysytyt kysymykset (FAQ) </b>:</dt>
<dd>Käytännöllinen &quot;usein kysytyt kysymykset&quot; listojen näyttämiseen. Automaattisesti liittää loppuun sanat: KYSYMYS ja VASTAUS, ko. aiheesta ja  mainitussa järjestyksessä. </dd>

<dt><b>Yksinkertainen sanakirja:</b></dt>
<dd>näyttää tavanomaiselta sanakirjalta hakusanoineen. Laatijoita ei näytetä ja liitetiedostot näytetään linkkeinä.</dd>

</dl>
<p>&nbsp;</p>
</blockquote>

<hr />
<p>Moodlen ylläpitäjät voivat luoda uusia esitysmuotoja seuraamalla ohjeita <b>mod/glossary/formats/README.txt</b>.</p>';
$string['displayformats'] = 'Sanaston hakusanojen selaustavat';
$string['displayformatssetup'] = 'Esitysmuodon valinta';
$string['duplicatecategory'] = 'Kopioi kategoria';
$string['duplicateentry'] = 'Samanniminen hakusana';
$string['editalways'] = 'Hakusanat aina muokattavissa';
$string['editalways_help'] = '<h2>Hakusanat aina muokkattavissa</h2>

<p>Tällä valinnalla päätät, voivatko opiskelijat muokata merkintöjään milloin vain. </p>
<p>Voit valita:</p>

<ul>
<li><b>Kyllä:</b> Merkinnät ovat aina muokattavissa.</li>

<li><b>Ei:</b> Merkinnät ovat muokattavissa vain valittuna muokkausaikana.</li>
</ul>';
$string['editcategories'] = 'Muokkaa kategorioita';
$string['editentry'] = 'Muokkaa hakusanaa';
$string['editingcomment'] = 'Muokkaa kommenttia';
$string['entbypage'] = 'Näytettävien hakusanojen määrä sivulla';
$string['entries'] = 'Hakusanat';
$string['entrieswithoutcategory'] = 'Kategorisoimattomat hakusanat';
$string['entry'] = 'Hakusana';
$string['entryalreadyexist'] = 'Hakusana on jo olemassa';
$string['entryapproved'] = 'Hakusana on hyväksytty';
$string['entrydeleted'] = 'Hakusana on poistettu';
$string['entryexported'] = 'Hakusanan vienti onnistui';
$string['entryishidden'] = '(tämä hakusana on tällä hetkellä piilotettuna)';
$string['entryleveldefaultsettings'] = 'Hakusanojen oletusasetukset';
$string['entrysaved'] = 'Hakusana on tallennettu';
$string['entryupdated'] = 'Hakusana on päivitetty';
$string['entryusedynalink'] = 'Linkitä automaattisesti';
$string['entryusedynalink_help'] = '<h2>Hakusanan automaatinen linkitys</h2>

<p>Tämän toiminnon päälle kytkeminen mahdollistaa hakusanojen automaattisen linkityksen aina, kun ko. sanoja ja fraaseja käytetään kurssilla, esimerkiksi keskustelualueilla, sisäisissä resurssseissa, viikkoyhteenvedoissa, ja päiväkirjoissa. </p>

<p>Jos et halua tiettyä tekstiä linkitetyksi (esim. keskustelualueen ilmoituksessa), lisää silloin NOLINK ja /NOLINK -elementit tekstin ympärille.</p>

<p>Jotta tämän toiminnon voi kytkeä päälle, tulee automaattisen linkityksen olla aktivoituna sanastossa.</p>';
$string['errcannoteditothers'] = 'Et voi muokata toisten käyttäjien tekemiä hakusanoja.';
$string['errconceptalreadyexists'] = 'Tämä käsite on jo olemassa. Tähän sanastoon ei voi lisätä keskenään samannimisiä hakusanoja.';
$string['errdeltimeexpired'] = 'Et voi poistaa tätä. Aika loppui!';
$string['erredittimeexpired'] = 'Tämän hakusanan muokkausaika on umpeutunut.';
$string['errorparsingxml'] = 'Tiedoston lukemisessa tapahtui virhe. Tarkista, että XML-tiedoston syntaksi on oikein.';
$string['explainaddentry'] = 'Lisää uusi hakusana sanastoon.<br />Käsite ja määritelmä ovat pakollisia kenttiä.';
$string['explainall'] = 'Näytä kaikki hakusanat yhdellä sivulla';
$string['explainalphabet'] = 'Selaa sanastoa tässä hakemistossa.';
$string['explainexport'] = 'Vientitiedosto on luotu.<br />Lataa se ja säilytä sitä huolella. Voit tuoda sen milloin tahansa tälle tai mille tahansa muulle kurssille.';
$string['explainimport'] = 'Määritä tuontitiedosto ja tuonnin asetukset.';
$string['explainspecial'] = 'Näyttää hakusanat, jotka eivät ala kirjainmerkillä';
$string['exportedentry'] = 'Viety hakusana';
$string['exportentries'] = 'Vie hakusanat';
$string['exportentriestoxml'] = 'Tallenna hakusanat XML-tiedostoksi';
$string['exportfile'] = 'Tallenna hakusanat tiedostoksi';
$string['exportglossary'] = 'Vie sanasto';
$string['exporttomainglossary'] = 'Vie pääsanastoon';
$string['filetoimport'] = 'Tuontitiedosto';
$string['filetoimport_help'] = '<p>Valitse tietokoneeltasi se XML-tiedosto, joka sisältää tuotavat hakusanat.</p>';
$string['fillfields'] = 'Käsite ja määritelmä ovat pakollisia kenttiä.';
$string['filtername'] = 'Sanaston automaattinen linkitys';
$string['fullmatch'] = 'Linkitä vain kokonaisiin sanoihin';
$string['fullmatch_help'] = '<h2>Vain kokonaiset sanat</h2>

<p>Jos automaattinen linkitys on päällä, sallii tämän asetus ainoastaan kokonaiset sanat linkittymään keskenään, esimerkiksi, "pallo" ei silloin linkity sanaan "pallokala". Hakusanan on siis vastattava tarkalleen kurssialueella käytettyä sanaa, jotta se linkittyy.';
$string['glossary:approve'] = 'Hakusanojen hyväksyminen';
$string['glossary:comment'] = 'Kommenttien luonti';
$string['glossary:export'] = 'Hakusanojen vienti';
$string['glossary:exportentry'] = 'Vie yksittäinen merkintä';
$string['glossary:exportownentry'] = 'Vie yksittäinen oma merkintä';
$string['glossary:import'] = 'Hakusanojen tuonti';
$string['glossaryleveldefaultsettings'] = 'Sanastojen oletusasetukset';
$string['glossary:managecategories'] = 'Kategorioiden hallinta';
$string['glossary:managecomments'] = 'Kommenttien hallinta';
$string['glossary:manageentries'] = 'Hakusanojen hallinta';
$string['glossary:rate'] = 'Hakusanojen arviointi';
$string['glossarytype'] = 'Sanaston tyyppi';
$string['glossarytype_help'] = '<h2>Kurssin pääsanaston määrittäminen</h2>

<p>Sanastojärjestelmä mahdollistaa hakusanojen viennin kurssialueen mistä tahansa toissijaisesta sanastosta kurssialueen pääsanastoon. Tehdäksesi tämän sinun pitää määritellä, mikä sanasto on tämä pääsanasto. Kurssialueella voi olla vain yksi pääsanasto.</p>

<p>Oletusarvoisesti vain opettajat saavat päivittää pääsanastoa.</p>';
$string['glossary:view'] = 'Sanaston katselu';
$string['glossary:viewallratings'] = 'Näytä kaikki arviot';
$string['glossary:viewanyrating'] = 'Näytä saatujen arvioiden yhteismäärä';
$string['glossary:viewrating'] = 'Tarkastele saamiasi arviointeja';
$string['glossary:write'] = 'Luo uusia hakusanoja';
$string['guestnoedit'] = 'Vierailijat eivät voi muokata sanastoja';
$string['importcategories'] = 'Tuo kategorioita';
$string['importedcategories'] = 'Tuodut kategoriat';
$string['importedentries'] = 'Tuodut hakusanat';
$string['importentries'] = 'Tuo hakusanoja';
$string['importentriesfromxml'] = 'Tuo hakusanoja XML-tiedostosta';
$string['includegroupbreaks'] = 'Sisällytä ryhmäjaot';
$string['isglobal'] = 'Onko tämä sanasto yhteinen kaikille kurssialueille?';
$string['isglobal_help'] = '<h2>Yhteisen sanaston määrittely</h2>

<p>Ylläpitäjät voivat määritellä sanaston olevan yhteisesti kaikkien kurssialueiden käytössä.</p>

<p>Nämä sanastot voivat olla osa mitä tahansa kurssia, mutta yleensä ne ovat etusivulla. </p>

<p>Erona kurssikohtaiseen sanastoon on, että yhteisen sanaston hakusanoilla voidaan luoda linkkejä mille tahansa kurssialueelle, ei ainoastaan sillä kurssialueella, jolle sanasto kuuluu.</p>';
$string['letter'] = 'kirjain';
$string['linkcategory'] = 'Linkitä tämä kategoria automaattisesti';
$string['linkcategory_help'] = '<p>Tässä määrittelet linkitetäänko kategoria nimet aytomaatisesti vai ei.</p>

<p>Kategoriat linkitetään aina kokonaisiin sanoihin kirjainkoko huomioiden.</p>';
$string['linking'] = 'Automaattinen linkitys';
$string['mainglossary'] = 'Pääsanasto';
$string['maxtimehaspassed'] = 'Kommentin ({$a}) sallittu muokkausaika on ylittynyt.';
$string['modulename'] = 'Sanasto';
$string['modulename_help'] = '<p><img valign="middle" src="<?php echo $CFG->wwwroot?>/mod/glossary/icon.gif"> <strong>Sanasto</strong></p>

<BLOCKQUOTE>
Sanastossa kurssialueen osallistujat voivat luoda ja ylläpitää listaa hakusanoista tai vaikkapa kerätä yhteistä lähdeluetteloa. Hakusanojen selausvaihtoehtoja on useita. Opettajat voivat myös tuoda saman kurssin sisällä hakusanoja yhdestä sanastosta toiseen eli pääsanastoon. Kurssin aineistoissa ja aktiviteeteissa mainitut hakusanat on myös mahdollista linkittää automaattisesti sanastojen määritelmiin.
</BLOCKQUOTE>';
$string['modulenameplural'] = 'Sanastot';
$string['newentries'] = 'Uudet sanaston hakusanat';
$string['newglossary'] = 'Uusi sanasto';
$string['newglossarycreated'] = 'Uusi sanasto luotu.';
$string['newglossaryentries'] = 'Uudet sanaston hakusanat:';
$string['nocomment'] = 'Kommentteja ei löytynyt';
$string['nocomments'] = '(Tälle hakusanalle ei löytynyt kommentteja)';
$string['noconceptfound'] = 'Käsitettä tai määritelmää ei löytynyt.';
$string['noentries'] = 'Tästä osiosta ei löytynyt hakusanoja';
$string['noentry'] = 'Hakusanoja ei löytynyt.';
$string['nopermissiontodelcomment'] = 'Et voi poistaa muiden antamia kommentteja!';
$string['nopermissiontodelinglossary'] = 'Et voi kommentoida tässä sanastossa!';
$string['nopermissiontoviewresult'] = 'Voit katsella vain omien merkintöjesi tuloksia';
$string['notapproved'] = 'sanastomerkintää ei ole vielä hyväksytty.';
$string['notcategorised'] = 'Kategorisoimaton';
$string['numberofentries'] = 'Hakusanojen lukumäärä';
$string['onebyline'] = '(yksi riviä kohden)';
$string['page-mod-glossary-edit'] = 'Sanaston lisää/muokkaa merkintää -sivu';
$string['page-mod-glossary-view'] = 'Näytä  sanaston muokkaussivu';
$string['page-mod-glossary-x'] = 'Kaikki sanastomoduulisivut';
$string['pluginadministration'] = 'Sanaston hallinnointi';
$string['pluginname'] = 'Sanasto';
$string['popupformat'] = 'Ponnahdusikkunan muoto';
$string['printerfriendly'] = 'Tulostukseen soveltuva versio';
$string['printviewnotallowed'] = 'Tulostusnäkymä ei ole sallittu';
$string['question'] = 'Kysymys';
$string['rejectedentries'] = 'Hylätyt hakusanat';
$string['rejectionrpt'] = 'Hylkäysraportti';
$string['resetglossaries'] = 'Poista hakusanoja';
$string['resetglossariesall'] = 'Poista hakusanat kaikista sanastoista';
$string['rssarticles'] = 'Uutissyötteiden viimeisimpien merkintöjen määrä';
$string['rssarticles_help'] = '<p>Tämä valinta antaa sinun määritellä niiden merkintöjen määrän, joka sisällytetään uutissyötteeseen.</p>
<p>Määrä 5:n ja 20:n välillä olisi normaali suurimmalle osalle sanastoista. Kasvata määrää, jos sanastoa päivitetään usein.</p>';
$string['rsssubscriberss'] = 'Näytä uutissyötteet {$a}';
$string['rsstype'] = 'Tämän aktiviteetin uutissyöte';
$string['rsstype_help'] = '<p>Tällä valinnalla voit näyttää uutissyötteitä tästä sanastosta. Voit valita kahden syöttötyypin välillä:</p>
<ul>
<li><b>Nimen kanssa:</b> Syötteet sisältävät tekijöiden nimet.
<li><b>Ilman nimeä:</b> Syötteet eivät sisällä tekijöiden nimiä.
</ul>';
$string['searchindefinition'] = 'Vapaatekstihaku';
$string['secondaryglossary'] = 'Toissijainen sanasto';
$string['showall'] = 'Näytä linkki "Kaikki merkinnät"';
$string['showall_help'] = '<h2>Selailu aakkostetussa näkymässä</h2>

<p>Voit mukauttaa tapoja, joilla käyttäjä selaa sanastoa. Selaaminen ja etsiminen ovat aina saatavilla, mutta voit määrittää kolme muutakin valintaa: </p>

<p><b>Näytä erikoismerkit</b> mahdollistaa tai estää selaamisen erikoismerkkien, kuten @, #, mukaan.</p>

<p><strong>Näytä aakkosittain</strong> mahdollistaa tai estää selaamisen aakkosjärjestyksessä.</p>

<p><strong>Näytä kaikki</strong> mahdollistaa tai estää kaikkien hakusanojen selaamisen kerralla.</p>
';
$string['showalphabet'] = 'Näytä aakkosittain';
$string['showalphabet_help'] = '<p>Voit mukauttaa tapoja, joilla käyttäjä selaa sanastoa. Selaaminen ja etsiminen ovat aina saatavilla, mutta voit määrittää kolme muutakin valintaa: </p>

<p><b>Näytä erikoismerkit</b> mahdollistaa tai estää selaamisen erikoismerkkien, kuten @, #, mukaan.</p>

<p><strong>Näytä aakkosittain</strong> mahdollistaa tai estää selaamisen aakkosjärjestyksessä.</p>

<p><strong>Näytä kaikki</strong> mahdollistaa tai estää kaikkien hakusanojen selaamisen kerralla.</p>';
$string['showspecial'] = 'Näytä linkki "Erikoismerkit"';
$string['showspecial_help'] = '<p>Voit mukauttaa tapoja, joilla käyttäjä selaa sanastoa. Selaaminen ja etsiminen ovat aina saatavilla, mutta voit määrittää kolme muutakin valintaa: </p>

<p><b>Näytä erikoismerkit</b> mahdollistaa tai estää selaamisen erikoismerkkien, kuten @, #, mukaan.</p>

<p><strong>Näytä aakkosittain</strong> mahdollistaa tai estää selaamisen aakkosjärjestyksessä.</p>

<p><strong>Näytä kaikki</strong> mahdollistaa tai estää kaikkien hakusanojen selaamisen kerralla.</p>';
$string['sortby'] = 'Lajittele...';
$string['sortbycreation'] = 'Luontiajan mukaan';
$string['sortbylastupdate'] = 'Viimeisimmän päivityksen mukaan';
$string['sortchronogically'] = 'Lajittele kronologisesti';
$string['special'] = 'Erikoismerkit';
$string['standardview'] = 'Selaa aakkosjärjestyksessä';
$string['studentcanpost'] = 'Opiskelijat voivat lisätä hakusanoja';
$string['totalentries'] = 'Hakusanojen kokonaismäärä';
$string['usedynalink'] = 'Sanaston automaattinen linkitys';
$string['usedynalink_help'] = '<h2>Sanaston automaattinen linkitys</h2>

<p>Tämän toiminnon käyttö sallii sanaston yksittäisten hakusanojen linkittyä automaattisesti aina, kun käsitesanoja ja fraaseja käytetään kurssialueella. Linkitys toimii kaikissa aktiviteeteissa, kuten keskustelualueilla, resursseissa ja yhteenvedoissa.</p>

<p>Huomaa, että linkityksen mahdollistaminen sanastolle ei automaattisesti kytke päälle linkitystä hakusanoille, vaan linkitys täytyy asettaa jokaiselle hakusanalle erikseen. </p>
<p>Jos et halua tiettyä tekstiä linkitetyksi (esim. keskustelualueen ilmoituksessa), lisää silloin  &lt;nolink&gt; ja &lt;/nolink&gt; -merkinnät ko. tekstin ympärille.</p>

<p>Huomaa, että myös kategorianimet linkitetään.</p>';
$string['waitingapproval'] = 'Odottamassa hyväksyntää';
$string['warningstudentcapost'] = '(Soveltuu vain jos sanasto ei ole pääsanasto)';
$string['withauthor'] = 'Käsitteet kirjoittajineen';
$string['withoutauthor'] = 'Käsitteet ilman kirjoittajaa';
$string['writtenby'] = 'kirjoittanut';
$string['youarenottheauthor'] = 'Et ole kirjoittanut tätä kommenttia, joten et voi muokata sitä.';
