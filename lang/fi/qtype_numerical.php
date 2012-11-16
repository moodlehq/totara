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
 * Strings for component 'qtype_numerical', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_numerical
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acceptederror'] = 'Sallittu virhe';
$string['addmoreanswerblanks'] = 'Lisää kenttiä {no} vaihtoehdolle';
$string['addmoreunitblanks'] = 'Lisää kenttiä {no} yksikölle';
$string['answermustbenumberorstar'] = 'Vastauksen pitää olla numero, esimerkiksi -1.234 tai 3e8, tai \'*\'.';
$string['answerno'] = 'Vaihtoehto {$a}';
$string['decfractionofquestiongrade'] = 'murto-osana (0-1) kysymysarvosanasta';
$string['decfractionofresponsegrade'] = 'murto-osana (0-1) vastausarvosanasta';
$string['decimalformat'] = 'desimaalit';
$string['editableunittext'] = 'tekstinsyöttöelementti';
$string['errornomultiplier'] = 'Tälle yksikölle pitää antaa kerroin.';
$string['errorrepeatedunit'] = 'Ei voi olla saman nimisiä yksiköitä.';
$string['geometric'] = 'Geometrinen';
$string['invalidnumber'] = 'Sinun täytyy antaa validi numero.';
$string['invalidnumbernounit'] = 'Sinun täytyy antaa validi numero. Älä lisää yksikköä vastaukseesi.';
$string['invalidnumericanswer'] = 'Yksi antamistasi vastauksista ei ollut validi numero.';
$string['invalidnumerictolerance'] = 'Yksi antamistasi toleransseista ei ollut validi numero.';
$string['leftexample'] = 'vasemmalla, esimerkiksi $1.00 tai £1.00';
$string['manynumerical'] = 'Yksiköt ovat valinnaisia. Jos yksikkö annetaan, sitä käytetään vastauksen muuttamiseen Yksikkö 1:deksi ennen arviointia.';
$string['multiplier'] = 'Kerroin';
$string['nominal'] = 'Nimellinen';
$string['noneditableunittext'] = 'Yksikön nro 1 EI-muokattava teksti';
$string['nonvalidcharactersinnumber'] = 'EI-valideja merkkejä numerossa';
$string['notenoughanswers'] = 'Anna vähintään yksi vastaus.';
$string['nounitdisplay'] = 'Ei yksikön arvostelua';
$string['numericalmultiplier'] = 'Kerroin';
$string['numericalmultiplier_help'] = 'Kerroin on tekijä, jolla vastauksen numeerinen osa kerrotaan.
Ensimmäiseksi lisättävällä mittayksiköllä on oletuskerroin 1. Jos siis oikea numeerinen vastaus on 5500 ja laitat ensimmäiseksi mittayksiköksi W, oikea vastaus on 5500W.
Jos lisäät toiseksi mittayksiköksi kW ja sille kertoimeksi 0,001, lisäät samalla oikeaksi vastausvaihtoehdoksi 5,5kW. Näin oikeita vastausvaihtoehtoja on yhteensä kaksi: 5500W ja 5,5kW.
Huomaa myös, että jos käytät hyväksyttävää virhemarginaalia, sekin kerrotaan annetulla kertoimella. Näin esimerkiksi 100W:n virhemarginaali muunnettaisiin virhemarginaaliksi 0,1kW.';
$string['oneunitshown'] = 'Yksikkö 1 näytetään automaattisesti vastauslaatikon vieressä.';
$string['onlynumerical'] = 'Yksikköjä ei käytetä; vain numeerinen vastaus arvioidaan.';
$string['pleaseenterananswer'] = 'Ole hyvä ja anna vastaus.';
$string['pleaseenteranswerwithoutthousandssep'] = 'Ole hyvä ja anna vastauksesi ilman tuhaterotinta ({$a}).';
$string['pluginname'] = 'Numeerinen kysymys';
$string['pluginname_help'] = 'Opiskelijan näkökulmasta numeerinen kysymys näyttää lyhytvastaus-kysymykseltä. Erona on, että numeerisessa vastauksessa saa olla hyväksyttävä virhemarginaali. Näin voit yhden hyväksytyn vastauksen sijaan hyväksyä rajatun vastausjoukon. Esimerkiksi jos oikea vastaus on 10 ja hyväksyttävä virhemarginaali on 2, kaikki vastaukset välillä 8-12 hyväksytään oikeiksi vastauksiksi.';
$string['pluginnameadding'] = 'Lisätään numeerinen kysymys';
$string['pluginnameediting'] = 'Muokataan numeerista kysymystä';
$string['pluginnamesummary'] = 'Numeeriset vastaukset, mahdollisesti mittayksikön kera, joita verratan mallivastauksiin, mahdollisesti virhemarginaalin kera.';
$string['relative'] = 'Suhteellinen';
$string['rightexample'] = 'oikealla, esimerkiksi 1.00cm tai 1.00km';
$string['selectunit'] = 'Valitse yksi yksikkö';
$string['selectunits'] = 'Valitse yksiköt';
$string['studentunitanswer'] = 'Yksiköt syötetään käyttäen';
$string['tolerancetype'] = 'Toleranssityyppi';
$string['unit'] = 'Yksikkö';
$string['unitappliedpenalty'] = 'Nämä arvosanat sisältävät {$a}:n pistevähennyksen väärästä yksiköstä.';
$string['unitchoice'] = 'valinta monesta vaihtoehdosta';
$string['unitedit'] = 'Muokkaa yksikköä';
$string['unitgraded'] = 'Yksikkö on annettava ja se arvioidaan.';
$string['unithandling'] = 'Yksikön käsittely';
$string['unithdr'] = 'Yksikkö {$a}';
$string['unitincorrect'] = 'Et antanut oikeata yksikköä.';
$string['unitmandatory'] = 'Pakollinen';
$string['unitmandatory_help'] = '* Vastaus arvioidaan käyttäen kirjoitettua yksikköä.
* Yksikön pistevähennys tehdään jos yksikkökenttä on tyhjä.';
$string['unitnotselected'] = 'Sinun on valittava yksikkö.';
$string['unitonerequired'] = 'Sinun on annettava ainakin yksi yksikkö';
$string['unitoptional'] = 'Valinnainen yksikkö';
$string['unitoptional_help'] = '* Jos yksikkökenttä ei ole tyhjä, vastaus arvioidaan käyttäen tätä yksikköä.
* Jos yksikkö on huonosti kirjoitettu tai tuntematon, vastausta pidetään virheellisenä.';
$string['unitpenalty'] = 'Yksikkörangaistus';
$string['unitpenalty_help'] = 'Pistevähennys tehdään jos
* yksikkökenttään syötetään väärä yksikkö, tai
* yksikkö syötetään arvokenttään';
$string['unitposition'] = 'Yksiköt';
$string['unitselect'] = 'pudotusvalikko';
$string['validnumberformats'] = 'Validit numeroformaatit';
$string['validnumberformats_help'] = '* desimaalinumerot pilkulla tai pisteellä erotettuna, kuten 13500.67, 13 500.67, 13500,67 or 13 500,67
* jos käytät pilkkua "," tuhansien erottajana, muista käyttää pistettä "." desimaalierottimena, kuten 13,500.67 : 13,500.
* käytä eksponenttiin kuten 1.350067 * 10<sup>4</sup> muotoa 1.350067 E4 tai 1.350067 E04';
$string['validnumbers'] = '13500.67, 13 500.67, 13,500.67, 13500,67, 13 500,67, 1.350067 E4 tai 1.350067 E04';
