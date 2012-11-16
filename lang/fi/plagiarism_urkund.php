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
 * Strings for component 'plagiarism_urkund', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   plagiarism_urkund
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['defaultsdesc'] = 'Seuraavat ovat oletuksasetukset, kun URKUND sallitaan Aktiviteettimoduulissa';
$string['defaultupdated'] = 'Oletusarvot päivitetty';
$string['filereset'] = 'Tiedosto on resetoitu uudelleenpalautettavaksi URKUND:iin';
$string['optout'] = 'Jättäydy pois';
$string['pending'] = 'Tiedosto odottaa palautusta URKUND:iin';
$string['pluginname'] = 'URKUND plagioinninestomoduuli';
$string['previouslysubmitted'] = 'Aiemmin palautettu';
$string['processing'] = 'Tämä tiedosto on palautettu URKUND:iin, odotetaan analyysin valmistumista';
$string['savedconfigfailed'] = 'Annettiin väärä käyttäjätunnus/salasana -yhdistelmä, URKUND on estetty, ole hyvä ja yritä uudelleen.';
$string['savedconfigsuccess'] = 'Plagioinnineston asetukset tallennettu';
$string['showwhenclosed'] = 'Koska Aktiviteetti suljettu';
$string['similarity'] = 'URKUND';
$string['studentdisclosure'] = 'Opiskelijajulkaisu';
$string['studentdisclosure_help'] = 'Tämä teksti näytetään kaikille opiskelijoille tiedostonlataussivulla.';
$string['studentdisclosuredefault'] = 'Kaikki ladatut tiedostot lähetetään plagioinnintunnistuspalvelu URKUND:iin. Jos haluat estää dokumenttisi käytön muiden yritysten analyysin lähteenä tämän sivuston ulkopuolella, voit käyttää "jättäydy pois" -linkkiä, joka annetaan raportin luomisen jälkeen.';
$string['studentemailcontent'] = 'Moduuliin {$a->modulename} kurssilla {$a->coursename} lähettämäsi tiedosto on nyt plagioinninestotyökalu URKUND:in käsittelemä.
{$a->modulelink}

Jos haluat estää dokumenttisi käytön muiden yritysten analyysin lähteenä tämän sivuston ulkopuolella, voit käyttää tätä "jättäydy pois" -linkkiä:
{$a->optoutlink}';
$string['studentemailsubject'] = 'URKUND on käsitellyt tiedoston';
$string['submitondraft'] = 'Lähetä tiedosto kun ensi kerran ladattu';
$string['submitonfinal'] = 'Lähetä tiedosto kun opiskelija lähettää arvioitavaksi';
$string['toolarge'] = 'Tämä tiedosto on liian suuri URKUND:in käsiteltäväksi';
$string['unknownwarning'] = 'Tapahtui virhe yritettäessä lähettää tiedostoa URKUND:iin';
$string['unsupportedfiletype'] = 'URKUND ei tue tätä tiedostotyyppiä';
$string['urkund'] = 'URKUND plagioinninestomoduuli';
$string['urkund_api'] = 'URKUND Integraatio-osoite';
$string['urkund_api_help'] = 'Tämä on URKUND API:n osoite';
$string['urkund_draft_submit'] = 'Milloin tiedosto tulisi lähettää URKUND:iin';
$string['urkund_lang'] = 'Kieli';
$string['urkund_lang_help'] = 'URKUND:in antama kielikoodi';
$string['urkund_password'] = 'Salasana';
$string['urkund_password_help'] = 'URKUND:in antama salasana API:in';
$string['urkund_receiver'] = 'Vastaanotettu osoite';
$string['urkund_receiver_help'] = 'Tämä on URKUND:in opettajalle antama ainutlaatuinen osoite';
$string['urkund_show_student_report'] = 'Näytä samankaltaisuusraportti opiskelijalle';
$string['urkund_show_student_report_help'] = 'Samankaltaisuusraportista käy ilmi mitkä osat palautuksesta olivat plagioituja sekä missä URKUND ensi kertaa näki sisällön';
$string['urkund_show_student_score'] = 'Näytä samankaltaisuuspisteet opiskelijalle';
$string['urkund_show_student_score_help'] = 'Samankaltaisuuspisteet ilmaisee kuinka monta prosenttia palautetusta työstä on täsmännyt muuhun sisältöön.';
$string['urkund_studentemail'] = 'Lähetä opiskelijalle sähköposti';
$string['urkund_studentemail_help'] = 'Tämä lähettää sähköpostin opiskelijalle kun tiedosto on käsitelty ja raportti on saatavilla. Sähköposti sisältää myös "jättäydy pois" -linkin.';
$string['urkund_username'] = 'Käyttäjätunnus';
$string['urkund_username_help'] = 'URKUND:in antama käyttäjätunnus API:in';
$string['urkunddefaults'] = 'URKUND-oletukset';
$string['urkundexplain'] = 'Lisätietoa tästä moduulista: <a href="http://www.urkund.com/int/en/" target="_blank">http://www.urkund.com/int/en/</a>';
$string['useurkund'] = 'Aktivoi URKUND';
