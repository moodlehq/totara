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
 * Strings for component 'group', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   group
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addgroup'] = 'Lisää käyttäjä ryhmään';
$string['addgroupstogrouping'] = 'Lisää ryhmä ryhmittelyyn';
$string['addgroupstogroupings'] = 'Lisää/poista ryhmiä';
$string['adduserstogroup'] = 'Lisää/poista käyttäjiä';
$string['allocateby'] = 'Ryhmittele jäsenet';
$string['anygrouping'] = '[Mikä tahansa ryhmittely]';
$string['autocreategroups'] = 'Luo ryhmät automaattisesti';
$string['backtogroupings'] = 'Takaisin ryhmittelyihin';
$string['backtogroups'] = 'Takaisin ryhmiin';
$string['badnamingscheme'] = 'Pitää sisältää tarkalleen yksi  @- tai yksi #-merkki';
$string['byfirstname'] = 'Aakkosjärjestyksessä etunimen, sukunimen mukaan';
$string['byidnumber'] = 'Aakkosjärjestyksessä id-numeron mukaan';
$string['bylastname'] = 'Aakkosjärjestyksessä sukunimen, etunimen mukaan';
$string['createautomaticgrouping'] = 'Luo automaattinen ryhmittely';
$string['creategroup'] = 'Luo ryhmä';
$string['creategrouping'] = 'Luo ryhmittely';
$string['creategroupinselectedgrouping'] = 'Luo ryhmä ryhmittelyyn';
$string['createingrouping'] = 'Luo ryhmittelyyn';
$string['createorphangroup'] = 'Luo orpo ryhmä';
$string['databaseupgradegroups'] = 'Ryhmien versio on {$a}';
$string['defaultgrouping'] = 'Vakioryhmittely';
$string['defaultgroupingname'] = 'Ryhmittely';
$string['defaultgroupname'] = 'Ryhmä';
$string['deleteallgroupings'] = 'Poista kaikki ryhmittelyt';
$string['deleteallgroups'] = 'Poista kaikki ryhmät';
$string['deletegroupconfirm'] = 'Oletko varma, että haluat poistaa ryhmän \'{$a}\'?';
$string['deletegrouping'] = 'Poista ryhmittely';
$string['deletegroupingconfirm'] = 'Oletko varma, että haluat poistaa ryhmittelyn \'{$a}\'? (Ryhmittelyyn kuuluvia ryhmiä ei poisteta.)';
$string['deletegroupsconfirm'] = 'Oletko varma, että haluat poistaa nämä ryhmät:';
$string['deleteselectedgroup'] = 'Poista valittu ryhmä';
$string['editgroupingsettings'] = 'Muokkaa ryhmittelyasetuksia';
$string['editgroupsettings'] = 'Muokkaa ryhmän asetuksia';
$string['enrolmentkey'] = 'Kurssiavain';
$string['enrolmentkey_help'] = 'Kurssiavaimen käyttö mahdollistaa kurssin rajaamisen vain niille henkilöille, jotka tietävät avaimen. Jos kurssille on määritetty kurssiavain, sen syöttäminen päästää käyttäjän kurssille ja tekee käyttäjästä automaattisesti ryhmän jäsenen.';
$string['erroraddremoveuser'] = 'Virhe käyttäjän {$a} ryhmään lisäyksessä tai siitä poistossa';
$string['erroreditgroup'] = 'Virhe luotaessa/muokattaessa ryhmää {$a}';
$string['erroreditgrouping'] = 'Virhe luotaessa/muokattaessa ryhmittelyä {$a}';
$string['errorinvalidgroup'] = 'Virhe, ryhmä {$a} ei kelpaa';
$string['errorselectone'] = 'Valitse ensin yksi ryhmä';
$string['errorselectsome'] = 'Valitse ensin yksi tai useampi ryhmä';
$string['evenallocation'] = 'Huom. Jotta ryhmäkoot olisivat tasaiset, lopullinen ryhmäkoko eroaa antamastasi ryhmäkoosta.';
$string['existingmembers'] = 'Jäsenet: {$a}';
$string['filtergroups'] = 'Suodata ryhmät:';
$string['group'] = 'Ryhmä';
$string['groupaddedsuccesfully'] = 'Ryhmä {$a} lisättiin onnistuneesti';
$string['groupby'] = 'Tarkenna';
$string['groupdescription'] = 'Ryhmän kuvaus';
$string['groupinfo'] = 'Tietoa valitusta ryhmästä';
$string['groupinfomembers'] = 'Tietoa valituista jäsenistä';
$string['groupinfopeople'] = 'Tietoa valituista käyttäjistä';
$string['grouping'] = 'Ryhmittely';
$string['grouping_help'] = '## Ryhmittelyt
Ryhmittely on "ryhmien ryhmä", eli voit muodostaa yksittäisistä ryhmistä erilaisia kokonaisuuksia ryhmittelyjä käyttämällä. Ryhmittelemällä kurssin osallistujia erilaisiin kokonaisuuksiin voit tarjota heille monipuolisemmat työskentelymahdollisuudet eri ihmisten kanssa.
Esimerkki:
* Ryhmittely 1: Lähiryhmät. Tämän ryhmittelyn alle tulevat ryhmät Tampere, Helsinki, joihin lisäät osallistujia heidän osallistumispaikkansa mukaan.
* Ryhmittely 2: Vertaisryhmät. Tämän ryhmittelyn alle tulevat ryhmät Luonnontieteet, Kielet, Reaaliaineet, joihin lisäät osallistujia heidän pääaineensa mukaan osallistumispaikkakunnasta riippumatta.
* Käytät ryhmittelyä Lähiryhmät keskustelualueella ja wikissä, joissa työstetään kurssin paikkakuntakohtaisten lähitapaamisten sisältöjä.
* Käytät ryhmittelyä Vertaisryhmät keskustelualueella ja wikissä, joilla osallistujat työstävät ainekohtaisia projektejaan.

Verrattuna siihen, ettet käyttäisi ryhmittelyjä, mutta hyödyntäisit ryhmäkohtaisia työskentelyalueita, kaikkien ryhmien (jotka olet muodostanut esim. em. esimerkin lähi- ja vertaisryhmistä) näkyvät osallistujille jokaisen ryhmäkohtaisen aktiviteetin ryhmälistassa (pudotusvalikossa). On siis osallistujien kannalta selkeämpää käyttää ryhmittelyjä, jolloin he tietävät, kenen kanssa pitikään tehdä mitäkin.
*Jotta ryhmittely toimii, Ryhmien näkyvyys -asetukseen on valittava joko Erilliset tai Näkyvät ryhmät.*';
$string['groupingdescription'] = 'Ryhmittelyn kuvaus';
$string['groupingname'] = 'Ryhmittelyn nimi';
$string['groupingnameexists'] = 'Ryhmittely \'{$a}\' on jo olemassa tällä kurssilla, käytä jotain toista nimeä.';
$string['groupings'] = 'Ryhmittelyt';
$string['groupingsonly'] = 'Vain ryhmittelyt';
$string['groupmember'] = 'Ryhmän jäsen';
$string['groupmemberdesc'] = 'Vakiorooli ryhmän jäsenelle';
$string['groupmembers'] = 'Ryhmän jäsenet';
$string['groupmembersonly'] = 'Näkyy vain ryhmien jäsenille';
$string['groupmembersonly_help'] = '## Näkyvyys vain ryhmien jäsenille
Jos rastit ruudun Näkyy vain ryhmien jäsenille, lisäämääsi aktiviteettiin tai resurssiin pääsevät vain ne opiskelijat, jotka kuuluvat valitsemasi ryhmittelyn sisältämiin ryhmiin, tai, jos et ole valinnut ryhmittelyä, vähintään yhteen mutta mihin tahansa ryhmään.';
$string['groupmembersonlyerror'] = 'Sinun pitää olla vähintään yhden ryhmän jäsen voidaksesi käyttää tätä aktiviteettia.';
$string['groupmemberssee'] = 'Näytä ryhmän jäsenet';
$string['groupmembersselected'] = 'Valitun ryhmän jäsenet';
$string['groupmode'] = 'Ryhmämoodi';
$string['groupmode_help'] = '## Osallistujien ryhmittely
Ryhmätoiminnossa on kolme vaihtoehtoa:

\* **|Ei ryhmiä** - kaikki kurssialueen osallistujat ovat yhtä samaa yhteisöä.
\* **|Erilliset ryhmät** - jokainen ryhmä voi nähdä ainoastaan oman ryhmänsä tuottamat sisällöt, muiden ryhmien työt ja osallistujat ovat näkymättömiä
\* **|Näkyvät ryhmät** - jokainen osallistuja työskentelee omassa ryhmässään, mutta voi nähdä myös muut ryhmät

Ryhmät voidaan määritellä kahdella tasolla:

\* **|Kurssitaso**: ryhmäytys, joka on määritelty kurssitasolla, ryhmäyttää oletusarvoisesti kaikki toiminnot kurssialueella.
\* **|Aktiviteettitaso**: jokaiselle aktiviteetille, joka tukee ryhmiä, on mahdollista määritellä oma ryhmäytyminen.';
$string['groupmodeforce'] = 'Pakota ryhmämoodi';
$string['groupmodeforce_help'] = '## Pakotetut ryhmät
Jos ryhmäytyminen on kurssitasolla lukittu, samaa ryhmittelyä (ei ryhmiä / näkyvät ryhmät / erilliset ryhmät) sovelletaan kaikissa sen kurssin toiminnoissa ja aktiviteettikohtaiset ryhmäyttämiset jätetään huomiotta.
Ryhmien pakottaminen on hyödyllistä lähinnä silloin, kun haluaa perustaa kurssin muutamille täysin erillisille joukoille.';
$string['groupmy'] = 'Oma ryhmäni';
$string['groupname'] = 'Ryhmän nimi';
$string['groupnameexists'] = 'Ryhmä nimeltään \'{$a}\' on jo olemassa tällä kurssilla, valitse toinen nimi.';
$string['groupnotamember'] = 'Et ole tämän ryhmän jäsen';
$string['groups'] = 'Ryhmät';
$string['groupscount'] = 'Ryhmät ({$a})';
$string['groupsgroupings'] = 'Ryhmät &amp; ryhmittelyt';
$string['groupsinselectedgrouping'] = 'Ryhmät ryhmittelyssä:';
$string['groupsnone'] = 'Ei ryhmiä';
$string['groupsonly'] = 'Vain ryhmät';
$string['groupspreview'] = 'Ryhmien esikatselu';
$string['groupsseparate'] = 'Erilliset ryhmät';
$string['groupsvisible'] = 'Näkyvät ryhmät';
$string['grouptemplate'] = 'Ryhmä @';
$string['hidepicture'] = 'Piilota kuva';
$string['importgroups'] = 'Tuo ryhmät';
$string['importgroups_help'] = 'Ryhmät voidaan tuoda tekstitiedostolla. Tiedoston pitäisi olla seuraavassa muodossa:
* Tiedoston jokainen rivi sisältää yhden merkinnän
* Jokainen merkintä on pilkuilla erotettu sarja tietoa
* Ensimmäinen merkintä sisältää listan kentän nimistä, jotka määrittelevät lopputiedoston muodon
* Vaadittu kentän nimi on \'groupname\'
* Valinnaisia kenttien nimiä ovat \'description\', \'enrolmentkey\', \'picture\' ja \'hidepicture\'';
$string['javascriptrequired'] = 'Tämä sivu vaatii JavaScriptin käyttöä.';
$string['members'] = 'Ryhmäkoko';
$string['membersofselectedgroup'] = 'Ryhmän jäsenet:';
$string['namingscheme'] = 'Nimeämiskäytäntö';
$string['namingscheme_help'] = '## Automaattisesti luotavien ryhmien nimeäminen
Luodessasi ryhmät automaattisesti Moodle myös nimeää tai numeroi ne automaattisesti. Tähän on kaksi vaihtoehtoa:

* @-merkki aakkostaa ryhmät suuraakkosin eli A, B, C,... Jos esimerkiksi olet muodostamassa työskentelypareja, voit antaa nimeämiskäytännöksi "Pari @", jolloin saat ryhmät Pari A, Pari B jne.
* # -merkki numeroi ryhmät. Esimerkiksi nimeämiskäytännöllä "Vertaisryhmä #" saat ryhmät Vertaisryhmä 1, Vertaisryhmä 2 jne.';
$string['newgrouping'] = 'Uusi ryhmittely';
$string['newpicture'] = 'Uusi kuva';
$string['newpicture_help'] = 'Voit lähettää kuvan tietokoneeltasi palvelimelle. Tätä kuvaa käytetään eri paikoissa edustamassa sinua.
Tästä syystä lähikuva kasvoistasi on käyttökelpoisin mutta voit toki käyttää mitä tahansa haluamaasi kuvaa.
Kuvan on oltava JPG tai PNG -tallennusmuodossa (eli tiedostonimi päättyy kirjaimiin .jpg tai .png).
Kuvatiedoston voit saada aikaan käyttäen jotain seuraavista tavoista:
1. Digitaalikameraa käyttämällä valokuvasi on tietokoneellasi todennäköisesti valmiiksi oikeassa muodossa.
2. Voit skannata paperikuvan tietokoneellesi.
3. Jos olet taiteellinen, voit piirtää kuvan kuvankäsittelyohjelmalla.
Varmista, että kuva on JPG- tai PNG-muodossa.
Kun lähetät kuvan, napsauta "Browse" nappulaa tällä editointisivulla ja valitse kuva kovalevyltäsi.
HUOMAA: Varmista että tiedosto ei ole suurempi kuin annettu maksimikoko, muutoin sitä ei voi lähettää.
Napsauta sitten "Päivitä profiilini" ("Update my Profile") alhaalla - kuvatiedosto leikkautuu neliöksi ja koko muuttuu 100x100 pikseliksi.
Kun joudut takaisin profiilisivullesi, voi olla että kuva näyttää samalta kuin ennenkin. Siinä tapauksessa paina selaimesi "Päivitä" -nappulaa.';
$string['noallocation'] = 'Ei ryhmiinjakoa';
$string['nogroups'] = 'Tällä kurssilla ei ole ryhmiä';
$string['nogroupsassigned'] = 'Ei ryhmiä määriteltynä';
$string['nopermissionforcreation'] = 'Sinulla ei ole tarpeeksi oikeuksia ryhmän \'{$a}\' luomiseksi';
$string['nosmallgroups'] = 'Ehkäise viimeinen pieni ryhmä';
$string['notingrouping'] = '[Ei ryhmittelyssä]';
$string['nousersinrole'] = 'Valitussa roolissa ei ole sopivia käyttäjiä';
$string['number'] = 'Ryhmä/jäsen määrä';
$string['numgroups'] = 'Ryhmien määrä';
$string['nummembers'] = 'Jäsentä per ryhmä';
$string['overview'] = 'Yhteenveto';
$string['potentialmembers'] = 'Mahdolliset jäsenet: {$a}';
$string['potentialmembs'] = 'Mahdolliset jäsenet';
$string['printerfriendly'] = 'Tulostusystävällinen versio';
$string['random'] = 'Sattumanvaraisesti';
$string['removefromgroup'] = 'Poista käyttäjiä ryhmästä {$a}';
$string['removefromgroupconfirm'] = 'Haluatko varmasti poistaa käyttäjän "{$a->user}" ryhmästä "{$a->group}"?';
$string['removegroupfromselectedgrouping'] = 'Poista ryhmä ryhmittelystä';
$string['removegroupingsmembers'] = 'Poista kaikki ryhmät ryhmittelyistä';
$string['removegroupsmembers'] = 'Poista kaikki ryhmän jäsenet';
$string['removeselectedusers'] = 'Poista valitut jäsenet';
$string['selectfromrole'] = 'Valitse jäsenet roolista';
$string['showgroupsingrouping'] = 'Näytä ryhmittelyn ryhmät';
$string['showmembersforgroup'] = 'Näytä ryhmän jäsenet';
$string['toomanygroups'] = 'Liian vähän käyttäjiä annettuun ryhmämäärään - vain {$a} käyttäjää valitussa roolissa.';
$string['usercount'] = 'Käyttäjien määrä';
$string['usercounttotal'] = 'Käyttäjien määrä ({$a})';
$string['usergroupmembership'] = 'Valitun käyttäjän jäsenyydet:';
