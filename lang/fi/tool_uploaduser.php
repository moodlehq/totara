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
 * Strings for component 'tool_uploaduser', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_uploaduser
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowdeletes'] = 'Salli poistot';
$string['allowrenames'] = 'Salli uudelleen nimeäminen';
$string['csvdelimiter'] = 'CSV-erotin';
$string['defaultvalues'] = 'Oletusarvot';
$string['deleteerrors'] = 'Poista virheet';
$string['encoding'] = 'Koodaus';
$string['errors'] = 'Virheitä';
$string['nochanges'] = 'Ei muutoksia';
$string['pluginname'] = 'Lähetä käyttäjät';
$string['renameerrors'] = 'Virheitä uudelleennimeämisessä';
$string['requiredtemplate'] = 'Vaadittu. Voit käyttää tässä mallipohjan syntaksia (%l = lastname, %f = firstname, %u = username). Katso lisätietoja ja esimerkkejä ohjeista.';
$string['rowpreviewnum'] = 'Esikatseltavien rivien määrä';
$string['uploadpicture_baduserfield'] = 'Määritelty käyttäjän attribuutti ei ole kelvollinen. Ole hyvä ja yritä uudelleen.';
$string['uploadpicture_cannotmovezip'] = 'Ei voida siirtää zip-tiedostoa väliaikaiseen hakemistoon.';
$string['uploadpicture_cannotprocessdir'] = 'Ei voida käsitellä pakkaamattomia tiedostoja.';
$string['uploadpicture_cannotsave'] = 'Ei voida tallentaa kuvaa käyttäjälle {$a}. Tarkasta alkuperäinen kuvatiedosto.';
$string['uploadpicture_cannotunzip'] = 'Ei voida purkaa kuvat-tiedostoa.';
$string['uploadpicture_invalidfilename'] = 'Kuvatiedostolla {$a} on virheellisiä merkkejä nimessä. Ohitetaan.';
$string['uploadpicture_overwrite'] = 'Ylikirjoita olemassa olevat käyttäjäkuvat?';
$string['uploadpicture_userfield'] = 'Käytettävä käyttäjäattribuutti kuvien täsmäämiseen:';
$string['uploadpicture_usernotfound'] = 'Käyttäjää, jonka profiilin tietokentässä \'{$a->userfield}\' on arvo \'{$a->uservalue}\', ei ole olemassa. Ohitetaan.';
$string['uploadpicture_userskipped'] = 'Ohitetaan käyttäjä {$a} (käyttäjällä on jo kuva).';
$string['uploadpicture_userupdated'] = 'Kuva päivitetty käyttäjälle {$a}.';
$string['uploadpictures'] = 'Lähetä käyttäjien kuvat';
$string['uploadpictures_help'] = 'Käyttäjien kuvat voidaan ladata zip-tiedostona. Kuvatiedostot tulisi nimetä valittu-käyttäjän-attribuutti.tiedostonimen-pääte, esimerkiksi user1234.jpg käyttäjälle, jonka käyttätunnus on user1234.';
$string['uploadusers'] = 'Lähetä käyttäjät';
$string['uploadusers_help'] = '**Yleensä ei ole tarpeellista tuoda käyttäjiä massoina** - pitääksesi oman ylläpitotyösi alhaisena, sinun pitäisi ensin miettiä sellaisten keinojen käyttämistä, jotka eivät vaadi manuaalista ylläpitoa. Esimerkiksi yhteydenottoa olemassa oleviin ulkoisiin tietokantoihin, tai antaa käyttäjien luoda omat käyttäjätilinsä. **Katso "Käyttäjäntunnistus" ylläpito valikosta. **
Jos olet varma, että haluat tuoda useita käyttäjätunnuksia tekstitiedostosta, silloin sinun täytyy muotoilla tekstitiedostosi seuraavasti:
* **Kaikki kenttien nimet pitää tuontitiedostossa kirjoittaa englanniksi!**
* Tiedoston jokainen rivi sisältää yhden tallenteen
* Jokainen tallenne on sarja tietoja pilkuilla eroteltuna
* Tiedoston ensimmäinen tallenne on erityinen, ja sisältää listan kenttänimiä. Tämä määrittää lopputiedoston muodon.

**Vaaditut kenttänimet:** nämä kentät täytyy olla mukana ensimmäisessä tallenteessa, ja määritelty jokaiselle käyttäjälle.

käyttäjänimi, salasana, etunimi, sukunimi, sähköposti

**Oletus kenttänimet:** nämä ovat valinnaisia - jos niitä ei liitetä, arvot otetaan aiemmalta ylläpitäjältä

yhteisö, osasto, kaupunki, maa, kieli, aikavyöhyke

**Valinnaiset kenttänimet: **kaikki nämä ovat täysin valinnaisia. Kurssinimet ovat kurssien "lyhytnimiä" - jos ne säilytetään nykyisellään, käyttäjä merkitään kursseille opiskelijana. Ryhmänimien täytyy yhdistyä vastaaviin kursseihin, esim. ryhmä 1 kurssi 1:een, ryhmän 2 kurssi 2:een, jne.

tunnistenumero, ICQ, puhelin1, puhelin2, osoite, url, kuvaus, postimuotoilu, postinäyttö, html-editori, autoalaindeksi, kurssi1, kurssi2, kurssi3, kurssi4, kurssi5, ryhmä1, ryhmä2, ryhmä3, ryhmä4, ryhmä5

* Pilkut aineiston sisässä pitäisi olla koodattu &#44:nä - scripti !!!!!!! tulkitsee automaattisesti nämä takaisin pilkuiksi.
* Boolean kentille (tosi/epätosi), käytä 0 epätodelle ja 1 todelle.
* Huomaa: jos käyttäjätunnus on jo Moodlen käyttäjätietokannassa, scripti palauttaa automaattisesti userid numeron ko. käyttäjälle, ja rekisteröi käyttäjän opiskelijana määritellyille kursseille ILMAN, että päivittäisi kannassa olevia käyttäjätietoja.

Tässä esimerkki kelpaavasta tuontitiedostosta:
username, password, firstname, lastname, email, lang, idnumber, maildisplay, course1, group1
jonest, verysecret, Tom, Jones, jonest@someplace.edu, en, 3663737, 1, Intro101, Section 1
reznort, somesecret, Trent, Reznor, reznort@someplace.edu, en_us, 6736733, 0, Advanced202, Section 3';
$string['uploaduserspreview'] = 'Lähetä käyttäjät -esikatselu';
$string['uploadusersresult'] = 'Lähetä käyttäjät -tulokset';
$string['useraccountupdated'] = 'Käyttäjä päivitetty';
$string['useraccountuptodate'] = 'Käyttäjä ajantasalla';
$string['userdeleted'] = 'Käyttäjän tiedot poistettu';
$string['userrenamed'] = 'Käyttäjä nimetty';
$string['userscreated'] = 'Käyttäjä luotu';
$string['usersdeleted'] = 'Käyttäjät poistettu';
$string['usersrenamed'] = 'Käyttäjät nimetty';
$string['usersskipped'] = 'Käyttäjät ohitettu';
$string['usersupdated'] = 'Käyttäjät päivitetty';
$string['usersweakpassword'] = 'Käyttäjät, joilla on heikko salasana';
$string['uubulk'] = 'Valitse useiden käyttäjien hallintaan';
$string['uubulkall'] = 'Kaikki käyttäjät';
$string['uubulknew'] = 'Uudet käyttäjät';
$string['uubulkupdated'] = 'Päivitetyt käyttäjät';
$string['uucsvline'] = 'CSV-rivi';
$string['uulegacy1role'] = '(Alkuperäinen Opiskelija) typeN=1';
$string['uulegacy2role'] = '(Alkuperäinen Opettaja) typeN=2';
$string['uulegacy3role'] = '(Alkuperäinen Ei-muokkaava Opettaja) typeN=3';
$string['uunoemailduplicates'] = 'Estä sähköpostiosoitteiden kaksoiskappaleet';
$string['uuoptype'] = 'Lataustyyppi';
$string['uuoptype_addinc'] = 'Lisää kaikki, lisää tarvittaessa numero käyttäjätunnuksiin';
$string['uuoptype_addnew'] = 'Lisää vain uudet ja ohita olemassa olevat käyttäjät';
$string['uuoptype_addupdate'] = 'Lisää uudet ja päivitä olemassa olevat käyttäjät';
$string['uuoptype_update'] = 'Ainoastaan päivitä olemassa olevat käyttäjät';
$string['uupasswordcron'] = 'Generoitu cron:issa';
$string['uupasswordnew'] = 'Uusi salasana';
$string['uupasswordold'] = 'Aikaisempi salasana';
$string['uustandardusernames'] = 'Standardisoi käyttäjätunnukset';
$string['uuupdateall'] = 'Ylikirjoita tiedostolla ja oletuksilla';
$string['uuupdatefromfile'] = 'Ylikirjoita tiedostolla';
$string['uuupdatemissing'] = 'Täytä puuttuvat tiedostosta ja oletuksista';
$string['uuupdatetype'] = 'Olemassa olevat käyttäjätiedot';
$string['uuusernametemplate'] = 'Käyttäjätunnuksen mallipohja';
