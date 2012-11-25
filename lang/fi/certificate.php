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
 * Strings for component 'certificate', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = 'Lisää linkitetty aktiviteetti';
$string['addlinktitle'] = 'Klikkaa lisätäksesi linkitetty aktiviteetti';
$string['awarded'] = 'Annettu';
$string['awardedto'] = 'Annettu käyttäjälle';
$string['borderstyle'] = 'Rajauskuva';
$string['certificate'] = 'Kurssitodistuksen koodin varmistus:';
$string['certificate:manage'] = 'Muokkaa kurssitodistusta';
$string['certificate:student'] = 'Hanki kurssitodistus';
$string['certificate:view'] = 'Tarkastele kurssitodistusta';
$string['certificatename'] = 'Kurssitodistuksen nimi';
$string['certificatereport'] = 'Kurssitodistusraportti';
$string['certificatesfor'] = 'Kurssitodistukset käyttäjälle';
$string['certificatetype'] = 'Kurssitodistuksen tyyppi';
$string['course'] = 'Käyttäjälle';
$string['credithours'] = 'Tunnit';
$string['customtext'] = 'Vapaa tekstikenttä';
$string['date'] = 'Ajankohta';
$string['datefmt_help'] = '**Tulostusmuoto**

Määritä missä muodossa päivämäärä tulostetaan kurssitodistukseen.';
$string['delivery_help'] = '**Toimitustapa**

Määritä tässä kuinka kurssitodistus toimitetaan oppijoille.
**Avaa uudessa ikkunassa:** avaa todistuksen uudessa selainikkunassa.
**Pakotettu lataus:** avaa tiedoston latausikkunan. **(Huomaa: **Internet Explorer ei tue latausikkunan kautta avaamista. Talleta tiedosto ensin.)
**Lähetä sähköpostitse:** lähettää todistuksen oppijalle sähköpostin liitetiedostona.
Kun oppija on saanut todistuksen, he pääsevät linkkiä klikkaamalla tarkastelemaan sitä uudelleen.';
$string['emailothers_help'] = '**Lähetä tiedotteet seuraaville**

Jos haluat lähettää sähköpostitiedotteen henkilöille, joiden tulee saada tieto oppijoiden kurssitodistusten saamisesta, syötä tähän kenttään sähköpostiosoitteet pilkulla eroteltuna.';
$string['emailstudenttext'] = 'Liitteenä on kurssitodistus kurssista {$a->course}.';
$string['emailteachermail'] = '{$a->student} on saanut kurssitodistuksen \'{$a->certificate}\' kurssista {$a->course}.

Voit tarkastella sitä täältä:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->student} on saanut kurssitodistuksen \'<i>{$a->certificate}</i>\' kurssista {$a->course}.

Voit tarkastella sitä täältä:

<a href="{$a->url}">Kurssitodistusraportti</a>.';
$string['emailteachers_help'] = '**Lähetä tiedote kouluttajille**

Jos **Kyllä** on valittuna, kurssin kouluttajat saavat lyhyen sähköpostitiedotteen aina, kun oppijat saavat todistuksen.';
$string['entercode'] = 'Syötä kurssitodistuksen koodi vahvistaaksesi:';
$string['getcertificate'] = 'Hanki kurssitodistus';
$string['grade'] = 'Arvosana';
$string['gradedate'] = 'Arvosnana päivämäärä';
$string['gradefmt_help'] = '**Arvosanan muoto**

Todistukseen tulostettava arvosana voi olla kolmessa muodossa:

**Prosenttiarvosana:** Tulostaa arvostelun prosentteina. **
Pistearvosana: **Tulostaa arvostelun pisteinä.
**Kirjainarvosana:** Tulostaa arvostelun kirjaimina. Voit muokata käytettävissä olevia arvosanakirjaimia type/certificate.php -tiedostossa.';
$string['gradeletter'] = 'Kirjainarvosana';
$string['gradepercent'] = 'Prosenttiarvosana';
$string['gradepoints'] = 'Pistearvosana';
$string['incompletemessage'] = 'Saadaksesi kurssitodistuksen, sinun tulee suorittaa kaikki vaaditut aktiviteetit. Palaa kurssille suorittaaksesi vaaditut aktiviteetit.';
$string['intro'] = 'Esittely';
$string['issued'] = 'Myönnetty';
$string['issueoptions'] = 'Myöntämisen valinnat';
$string['lockingoptions'] = 'Lukitsemisvalinnat';
$string['modulename'] = 'Kurssitodistus';
$string['modulenameplural'] = 'Kurssitodistukset';
$string['mycertificates'] = 'Omat kurssitodistukset';
$string['nocertificatesreceived'] = 'ei ole vielä saanyt yhtään kurssitodistusta.';
$string['nogrades'] = 'Ei arvosanoja';
$string['notapplicable'] = 'Ei saatavilla';
$string['notfound'] = 'Kurssitodistuksen numeroa ei voitu vahvistaa.';
$string['notissued'] = 'Ei ole otettu vastaan';
$string['notissuedyet'] = 'Ei myönnetty vielä';
$string['notreceived'] = 'Et ole saanut tätä kurssitodistusta';
$string['openbrowser'] = 'Avaa uudessa ikkunassa';
$string['opendownload'] = 'Klikkaa alla olevaa painiketta tallentaaksesi kurssitodistuksesi koneellesi';
$string['openemail'] = 'Klikkaa alla olevaa painiketta lähettääksesi kurssitodistuksesi sähköpostiisi.';
$string['openwindow'] = 'Klikkaa alla olevaa painiketta avataksesi kurssitodistuksesi uudessa ikkunassa.';
$string['printdate'] = 'Tulostuspäivä';
$string['printdate_help'] = '**Tulostuspäivä**

Jos tulostuspäivä on valittu näkyväksi, jompi kumpi näistä päivämääristä tulostetaan.
Jos kurssin loppupäivä on valittu, määritä kurssin ajanjakso ja loppumispäivämäärä kurssin asetuksista. Jos kurssin loppupäivää ei ole määritetty, käytetään todistuksen myöntämispäivää käytetään sen sijasta. Voit myös valita tulostettavaksi päivän, jolloin jokin aktiviteetti on arvosteltu. Jos todistus myönnetään ennen tuon aktiviteetin arviointipäivää, käytetään todistuksen myöntämispäivää.
Huomaa, että kertaalleen todistukseen tulostettua päivämäärää voi muuttaa ainoastaan muokkaamalla type/certificate.php -tiedostoa.';
$string['printerfriendly'] = 'Tulostusversio';
$string['printgrade'] = 'Tulosta arvosana';
$string['printhours'] = 'Tulosta tunnit';
$string['printhours_help'] = '**Tulosta opintotunnit**

Syötä tähän kenttään todistukseen tulostettavien opintotuntien/-pisteiden määrä.';
$string['printnumber_help'] = '**Tulosta koodi**

Voit valita todistukseen tulostettavaksi yksilöidyn 10-merkkisen koodin, joka koostuu sattumanvaraisesti valituista kirjaimista ja numeroista. Sama koodi tulostuu myös kouluttajan ajamaan raporttiin kaikista myönnetyistä kurssitodistuksista. Koodeja vertaamalla voi siis vahvistaa todistuksen oikeellisuuden.';
$string['printoutcome'] = 'Tulosta lopputulokset';
$string['printseal'] = 'Leiman tai logon kuva';
$string['printsignature'] = 'Allekirjoituskuva';
$string['printteacher_help'] = '**Tulosta kouluttajan nimi**

Jos haluat tulostaa kouluttajan nimen todistukseen, määritä kouluttajan rooli moduulitasolla. Tee näin, jos esimerkiksi kurssia pitää useampi kuin yksi kouluttaja tai haluat käyttää kurssilla useampia todistuspohjia ja tulostaa kullekin niistä eri kouluttajan nimen.
Valitse todistuksen muokkaustilassa **Paikallisesti jaetut roolit** -välilehti. Määritä sitten Kouluttajan (Trainer tai Editing Trainer) rooli haluamallesi yhdelle tai useammalle henkilölle. Tämä nimi (tai useampi nimi) tulostuu todistukseen Kouluttaja-nimikkeen alle.';
$string['receivedcerts'] = 'Saadut kurssitodistukset';
$string['reportcert_help'] = '**Kurssitodistusraportit**

Jos valitset tässä **Kyllä**, tämän todistuksen myöntämispäivä, koodi ja kurssin nimi näytetään käyttäjän kurssitodistusraporteissa. Jos sallit arvosanatietojen tulostumisen tähän todistukseen, myös se näytetään raporteissa.';
$string['reviewcertificate'] = 'Tarkastele kurssitodistustasi';
$string['verifycertificate'] = 'Vahvista kurssitodistus';
$string['viewcertificateviews'] = 'Tarkastele kurssitodistuksia, jotka on myönnetty {$a}';
$string['viewed'] = 'Sait kurssitodistuksen suorituksesta:';
