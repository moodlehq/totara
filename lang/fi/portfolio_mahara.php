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
 * Strings for component 'portfolio_mahara', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio_mahara
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enableleap2a'] = 'Salli Leap2A-portfoliotuki (vaatii Mahara 1.3 tai uudemman)';
$string['err_invalidhost'] = 'Virheellinen MNet-isäntäkone';
$string['err_invalidhost_help'] = 'Tämä moduuli on väärin konfiguroitu osoittamaan virheelliseen (tai poistettuun) MNet-isäntään. Tämä moduuli riippuu Moodle Networking -vertaisista, joilla SSO IDP julkaistu, SSO_SP tilattu ja portfolio tilattu **sekä** julkaistu.';
$string['err_networkingoff'] = 'MNet on pois päältä';
$string['err_networkingoff_help'] = 'MNet on pois päältä. Aktivoi se ennen kuin säädät tämän lisäosan asetuksia. Kaikki tämän lisäosan instanssit on asetettu piilotetuiksi kunnes MNet on aktivoitu. Muista vaihtaa asetukset käsin uudelleen näkyviksi. Niitä ei voida käyttää ennen tätä.';
$string['err_nomnetauth'] = 'MNet-autentikointimoduuli on estetty';
$string['err_nomnetauth_help'] = 'MNet-autentikointimoduuli vaaditaan tässä palvelussa mutta se on estetty';
$string['err_nomnethosts'] = 'Vaatii MNetin';
$string['err_nomnethosts_help'] = 'Tämä lisäosa on riippuvainen sellaisista MNet vertaisista, joilla on SSO IDP julkaistu, SSO SP tilattu, portfoliopalvelut julkaistu **ja** tilattu sekä MNet kirjautumislisäosa. Kaikki tämän lisäosan instanssit on piilotettu kunnes nämä ehdot täyttyvät. Tämän jälkeen ne täytyy asettaa manuaalisesti näkyviksi.';
$string['failedtojump'] = 'Ei pystytty aloittamaan kommunikointia etäpalvelimen kanssa';
$string['failedtoping'] = 'Ei pystytty aloittamaan kommunikointia etäpalvelimen {$a} kanssa';
$string['mnet_nofile'] = 'Ei löydetty tiedostoa siirto-objektissa - outo virhe';
$string['mnet_nofilecontents'] = 'Löydettiin tiedosto siirto-objektissa mutta ei saatu sisältöä - outo wirhe: {$a}';
$string['mnet_noid'] = 'Ei löydetty tähän avaimeen täsmäävää siirtomerkintää';
$string['mnet_notoken'] = 'Ei löydetty tähän siirtoon täsmäävää avainta';
$string['mnet_wronghost'] = 'Etäisäntä ei täsmännyt tämän avaimen siirtomerkintään';
$string['mnethost'] = 'MNet-isäntäkone';
$string['pf_name'] = 'Portfoliopalvelut';
$string['pluginname'] = 'Mahara ePortfolio';
$string['senddisallowed'] = 'Et voi siirtää tiedostoja Maharaan tällä hetkellä';
$string['url'] = 'Web-osoite';
