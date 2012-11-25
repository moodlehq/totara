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
 * Strings for component 'report_security', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   report_security
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['check_configrw_details'] = '<p>On suositeltavaa että tiedosto-oikeudet tiedostolle config.php muutetaan asennuksen jälkeen niin, että verkkopalvelin ei voi muokata tiedostoa.
Huomaa että tämä ei paranna turvallisuutta merkittävästi, vaikka se voikin hidastaa tai rajoittaa yleisiä hyväksikäyttöjä.</p>';
$string['check_configrw_name'] = 'Kirjoitettava config.php';
$string['check_configrw_ok'] = 'config.php ei ole PHP skripteillä muokattavissa';
$string['check_configrw_warning'] = 'PHP skriptit voivat muokata config.php:ta';
$string['check_cookiesecure_details'] = '<p>Jos otat käyttöön https-yhteyden, on suositeltavaa että otat käyttöön myös turvatut evästeet. Sinun tulisi lisätä myös pysyvä ohjaus http:stä https:ään.</p>';
$string['check_cookiesecure_error'] = 'Ole hyvä ja anna varmennettu eväste';
$string['check_cookiesecure_name'] = 'Varmennetut evästeet';
$string['check_cookiesecure_ok'] = 'Varmennetut evästeet sallittu.';
$string['check_defaultuserrole_details'] = '<p>Kaikille sisäänkirjautuneille käyttäjille annetaan oletuskäyttäjäroolin kyvyt. Muista varmistaa, ettei tälle roolille ole annettu riskialttiita kykyjä.</p> <p>Ainoa tuettu legacy-tyypin rooli oletuskäyttäjäroolille on <em>Tunnistautunut käyttäjä</em>. Kurssin katselu -kykyä ei saa olla sallittu.</p>';
$string['check_defaultuserrole_error'] = 'Käyttäjän oletusrooli "{$a}" on väärin määritelty!';
$string['check_defaultuserrole_name'] = 'Oletusrooli kaikille käyttäjille';
$string['check_defaultuserrole_notset'] = 'Oletusroolia ei ole asetettu.';
$string['check_defaultuserrole_ok'] = 'Oletusrooli kaikille käyttäjille -määrittely on OK.';
$string['check_displayerrors_details'] = '<p>PHP-asetuksen <code>display_errors</code> salliminen ei ole suositeltavaa tuotantosivustoilla, koska virheviestit saattavat paljastaa arkaluontoista tietoa palvelimestasi.</p>';
$string['check_displayerrors_error'] = 'PHP-asetus virheiden näyttämiseen on sallittu. On suositeltavaa että tämä estetään.';
$string['check_displayerrors_name'] = 'PHP-virheiden näyttäminen';
$string['check_displayerrors_ok'] = 'PHP-virheiden näyttäminen estetty.';
$string['check_emailchangeconfirmation_details'] = '<p>On suositeltavaa että sähköpostin varmistus -vaihe vaaditaan kun käyttäjät muuttavat sähköpostiosoitettaan profiiliinsa. Jos estetty, roskapostittajat saattavat yritää käyttää palvelinta roskapostin lähettämiseen.</p> <p>Sähköpostikenttä voidaan myös lukita kirjautumislisäosista, mitä vaihtoehtoa ei käsitellä täällä.</p>';
$string['check_emailchangeconfirmation_error'] = 'Käyttäjät voivat antaa minkä tahansa sähköpostiosoitteen.';
$string['check_emailchangeconfirmation_info'] = 'Käyttäjät voivat antaa sähköpostiosoitteen ainoastaan sallituista domaineista.';
$string['check_emailchangeconfirmation_name'] = 'Sähköpostin muutoksen varmistus';
$string['check_emailchangeconfirmation_ok'] = 'Varmistus sähköpostin muutoksesta käyttäjän profiiliin.';
$string['check_embed_details'] = '<p>Rajoittamaton objektien upotus on todella vaarallista - kuka tahansa rekisteröitynyt käyttäjä voi laukaista XSS-hyökkäyksen kohti muita palvelimen käyttäjiä. Tämä asetus pitäisi estää tuotantopalvelimilla.</p>';
$string['check_embed_error'] = 'Rajoittamaton objektien upotus sallittu - tämä on suurimmalle osalle palvelimista hyvin vaarallista.';
$string['check_embed_name'] = 'Salli EMBED ja OBJECT';
$string['check_embed_ok'] = 'Rajoittamatonta objektien upotusta ei ole sallittu';
$string['check_frontpagerole_details'] = '<p>Etusivun oletusrooli annetaan kaikille rekisteröityneille käyttäjille etusivun toimintoja varten. Muista varmistaa, ettei tällä roolilla ole sallittuna riskialttiita kykyjä.</p>
<p>On suositeltavaa luoda tätä tarkoitusta varten erillinen rooli legacy-tyypin roolin sijaan.</p>';
$string['check_frontpagerole_error'] = 'Havaittu väärin määritelty etusivun rooli "{$a}"!';
$string['check_frontpagerole_name'] = 'Etusivun rooli';
$string['check_frontpagerole_notset'] = 'Etusivun roolia ei ole asetettu.';
$string['check_frontpagerole_ok'] = 'Etusivun roolimääritys on OK.';
$string['check_globals_details'] = '<p>Register globals -asetusta pidetään hyvin epäluotettavana PHP-asetuksena.</p> <p><code>register_globals=off</code> täytyy olla asetettuna PHP-konfiguraatiossa. Tätä asetusta muutetaan muokkaamalla tiedostoasi <code>php.ini</code>, Apache/IIS -konfiguraatiota tai <code>.htaccess</code> -tiedostoa.</p>';
$string['check_globals_error'] = 'Register globals TÄYTYY olla estetty. Korjaa PHP-asetukset välittömästi!';
$string['check_globals_name'] = 'Register globals';
$string['check_globals_ok'] = 'Register globals on estetty.';
$string['check_google_details'] = '<p>Avoin Googlelle -asetus sallii hakukoneiden päästä kursseille vierailijana. Ei ole järkeä sallia tätä asetusta jos vierailijakirjautumista ei ole sallittu.</p>';
$string['check_google_error'] = 'Hakukoneiden pääsy on sallittu mutta vierailijapääsy on estetty.';
$string['check_google_info'] = 'Hakukoneet pääsevät vierailijan roolissa.';
$string['check_google_name'] = 'Avoin Googlelle';
$string['check_google_ok'] = 'Hakukoneiden pääsyä ei ole sallittu';
$string['check_guestrole_details'] = '<p>Vierailija-roolia käytetään ei-kirjautuneille käyttäjille väliaikaiselle kurssille pääsylle. Muista varmistaa, ettei tälle roolille ole annettu riskialttiita kykyjä.</p>
<p>Ainoa tuettu legacy-tyypin rooli vierailijaroolille on <em>Vierailija</em>.</p>';
$string['check_guestrole_error'] = 'Vierailijarooli "{$a}" on väärin määritelty!';
$string['check_guestrole_name'] = 'Vierailijarooli';
$string['check_guestrole_notset'] = 'Vierailijaroolia ei ole asetettu.';
$string['check_guestrole_ok'] = 'Vierailijaroolin määrittely on OK.';
$string['check_mediafilterswf_details'] = '<p>Automaattinen swf-upotus on hyvin vaarallista - kuka tahansa rekisteröitynyt käyttäjä voi laukaista XSS-hyökkäyksen kohti muita palvelimen käyttäjiä. Ole hyvä ja estä tämä asetus tuotantopalvelimilla.</p>';
$string['check_mediafilterswf_error'] = 'Flash-mediasuodatin on aktivoitu - tämä on todella vaarallista suurimmalle osalle palvelimista.';
$string['check_mediafilterswf_name'] = 'Sallittu .swf mediasuodatin';
$string['check_mediafilterswf_ok'] = 'Flash-mediasuodatin ei ole aktivoitu';
$string['check_noauth_details'] = '<p><em>Ei tunnistusta</em> -lisäosaa ei ole takoitettu tuotantosivustoille. Estä se, ellei tämä ole testaussivusto.</p>';
$string['check_noauth_error'] = 'Ei autentikointia -pluginia ei voi käyttää tuotantosivustoilla.';
$string['check_noauth_name'] = 'Ei autentikointia';
$string['check_noauth_ok'] = 'Ei autentikointia -plugini on estetty.';
$string['check_openprofiles_details'] = '<p>Roskapostittajat voivat hyväksikäyttää avoimia profiileita. On suositeltavaa että joko <code>Pakota käyttäjät kirjautumaan profiileihin</code> tai <code>Pakota käyttäjät kirjautumaan</code> on käytössä.</p>';
$string['check_openprofiles_error'] = 'Kuka tahansa voi katsella käyttäjäprofiileja kirjautumatta sisään.';
$string['check_openprofiles_name'] = 'Avoimet käyttäjäprofiilit';
$string['check_openprofiles_ok'] = 'Kirjautuminen vaaditaan ennen käyttäjäprofiilien katselua.';
$string['check_passwordpolicy_details'] = '<p>On suositeltavaa asettaa salasanakäytäntö, koska salasanan arvaaminen on usein helpoin tapa saada valtuuttamaton pääsy järjestelmään.
Älä silti aseta vaatimuksia liian tiukoiksi, koska se saattaa johtaa siihen, että käyttäjät eivät joko muista salasanojaan tai kirjoittavat ne muistiin.</p>';
$string['check_passwordpolicy_error'] = 'Salasanakäytäntöä ei ole asetettu.';
$string['check_passwordpolicy_name'] = 'Salasanakäytäntö';
$string['check_passwordpolicy_ok'] = 'Salasanakäytäntö sallittu';
$string['check_passwordsaltmain_details'] = '<p>Salasanan tarkisteen asettaminen vähentää huomattavasti riskiä salasanavarkauteen.</p> <p>Salasanatarkisteen asettamiseksi lisää seuraava rivi tiedostoosi config.php:</p> <code>$CFG->passwordsaltmain = \'tähän jokin pitkä satunnainen merkkijono\';</code> <p>Satunnaisen merkkijonon pitäisi olla sekoitus kirjaimia, numeroita ja muita merkkejä. Vähintään 40 merkin käyttöä suositellaan.</p> <p>Jos haluat muuttaa tarkistetta, lue <a href="{$a}" target="_blank">salasanatarkisteen dokumentaatio</a>. Kun olet asettanut tarkisteen ÄLÄ poista sitä, koska sitten et enää pysty kirjautumaan sivustollesi!</p>';
$string['check_passwordsaltmain_name'] = 'Salasanan suolaus';
$string['check_passwordsaltmain_ok'] = 'Salasanan suolaus on OK';
$string['check_passwordsaltmain_warning'] = 'Salasanan suolausta ei ole määritelty';
$string['check_passwordsaltmain_weak'] = 'Salasanan suolaus on heikko';
$string['check_riskadmin_detailsok'] = '<p>Varmista seuraava lista järjestelmän ylläpitäjistä:</p>{$a}';
$string['check_riskadmin_detailswarning'] = '<p>Varmista seuraava lista järjestelmän ylläpitäjistä:</p>{$a->admins} <p>On suositeltavaa antaa ylläpitäjän rooli vain järjestelmän tasolla. Seuraavilla käyttäjillä on (tukematon) ylläpitäjän rooli muissa konteksteissa:</p>{$a->unsupported}';
$string['check_riskadmin_name'] = 'Ylläpitäjät';
$string['check_riskadmin_ok'] = 'Löydettiin {$a} palvelimen ylläpitäjä(ä).';
$string['check_riskadmin_unassign'] = '<a href="{$a->url}">{$a->fullname} ({$a->email}) näytä roolien jaot</a>';
$string['check_riskadmin_warning'] = 'Löydettiin {$a->admincount} palvelimen ylläpitäjää ja {$a->unsupcount} tukematonta ylläpitäjäroolin jakoa.';
$string['check_riskbackup_details_overriddenroles'] = '<p>Nämä aktiiviset ohitukset antavat käyttäjille kyvyn sisällyttää käyttäjien tiedot varmuuskopioihin. Varmista, että tämä oikeus on tarpeellinen.</p> {$a}';
$string['check_riskbackup_details_systemroles'] = '<p>Seuraavat järjestelmäroolit sallivat tällä hetkellä käyttäjien sisällyttää käyttäjätiedot varmuuskopioihin. Varmistathan, että tämä oikeus on tarpeellinen.</p> {$a}';
$string['check_riskbackup_details_users'] = '<p>Ylläolevien roolien tai paikallisten ohitusten johdosta seuraavat käyttäjätilit voivat tällä hetkellä tehdä varmuuskopioita, joissa on mukana henkilökohtaisia tietoja käyttäjiltä, jotka ovat kirjautuneena heidän kurssillaan.Varmista että he ovat (a) luotettuja ja (b) suojattuja vahvoilla salasanoilla:</p> {$a}';
$string['check_riskbackup_detailsok'] = 'Mikään rooli ei selvästi salli käyttäjätietojen varmuuskopiointia. Huomaa kuitenkin että ylläpitäjät, joilla on "doanything" -kyky, luultavasti pystyvät silti tekemään tämän.';
$string['check_riskbackup_editoverride'] = '<a href="{$a->url}">{$a->name} kontekstissa {$a->contextname}</a>';
$string['check_riskbackup_editrole'] = '<a href="{$a->url}">{$a->name}</a>';
$string['check_riskbackup_name'] = 'Käyttäjädatan varmuuskopiointi';
$string['check_riskbackup_ok'] = 'Mikään rooli ei selkeästi salli käyttäjädatan varmuuskopiointia';
$string['check_riskbackup_unassign'] = '<a href="{$a->url}">{$a->fullname} ({$a->email}) kontekstissa {$a->contextname}</a>';
$string['check_riskbackup_warning'] = 'Löydettiin {$a->rolecount} roolia, {$a->overridecount} ohitusta ja {$a->usercount} käyttäjää, joilla on kyky ottaa varmuuskopio käyttäjien tiedoista.';
$string['check_riskxss_details'] = '<p>RISK_XSS osoittaa kaikki vaaralliset kyvyt, joita vain luotetut käyttäjät voivat käyttää.</p> <p>Varmennathan seuraavan lista käyttäjistä ja varmistat, että luotat heihin täysin tällä palvelimella:</p><p>{$a}</p>';
$string['check_riskxss_name'] = 'XSS luotetut käyttäjät';
$string['check_riskxss_warning'] = 'RISK_XSS - löysi {$a} käyttäjää, joihin täytyy luottaa.';
$string['check_unsecuredataroot_details'] = '<p>Dataroot-hakemistoon ei saa päästä suoraan verkosta. Paras tapa varmistaa tämä on käyttää hakemistoa, joka ei ole julkisessa verkkohakemistossa.</p> <p>Jos siirrät hakemistoa, sinun täytyy päivittää <code>$CFG->dataroot</code> -asetus <code>config.php</code> -tiedostossa.</p>';
$string['check_unsecuredataroot_error'] = 'Dataroot-hakemistosi <code>{$a}</code> on väärässä paikassa ja avoinna verkkoon!';
$string['check_unsecuredataroot_name'] = 'Turvaton dataroot';
$string['check_unsecuredataroot_ok'] = 'Dataroot-hakemisto ei saa olla avoinna verkkoon.';
$string['check_unsecuredataroot_warning'] = 'Dataroot-hakemistosi <code>{$a}</code> on väärässä paikassa ja saattaa olla avoinna verkkoon.';
$string['configuration'] = 'Konfiguraatio';
$string['description'] = 'Kuvaus';
$string['details'] = 'Yksityiskohdat';
$string['issue'] = 'Asia';
$string['pluginname'] = 'Turvallisuuden yleiskatsaus';
$string['security:view'] = 'Näytä tuvaraportti';
$string['status'] = 'Tila';
$string['statuscritical'] = 'Kriittinen';
$string['statusinfo'] = 'Informaatio';
$string['statusok'] = 'OK';
$string['statusserious'] = 'Vakava';
$string['statuswarning'] = 'Varoitus';
$string['timewarning'] = 'Ole kärsivällinen. tiedon käsittelyssä saattaa kestää kauan...';
