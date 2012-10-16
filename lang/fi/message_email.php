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
 * Strings for component 'message_email', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   message_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowusermailcharset'] = 'Salli käyttäjän valita merkistö';
$string['configallowusermailcharset'] = 'Voivatko käyttäjät määrittää oman merkistönsä sähköpostia varten?';
$string['configmailnewline'] = 'Sähköpostiviesteissä käytetyt rivinvaihtomerkit. CRLF vaaditaan RFC 822bis:n mukaan, jotkin sähköpostipalvelimet tekevät automaattisen muunnoksen LF:stä CRLF:ään, toiset palvelimet tekevät väärän muunnoksen CRLF:stä CRCRLF:ään, kuitenkin jotkut hylkäävät posteja joissa on pelkkä LF (esim. qmail). Koita muuttaa tätä asetusta jos sinulla on ongelmia toimittamattomien postien tai tuplarivinvaihtojen kanssa.';
$string['confignoreplyaddress'] = 'Joskus sähköposteja lähetetään käyttäjän puolesta (esim. keskustelualueen viestit). Tässä määrittelemääsi sähköpostiosoitetta käytetään "Lähettäjä"-osoitteena niissä tapauksissa, joissa halutaan etteivät vastaanottajat voi vastata suoraan käyttäjälle (esim. kun käyttäjä haluaa pitää sähköpostiosoitteensa salaisena).';
$string['configsitemailcharset'] = 'Kaikki sähköpostit, jotka teidän sivustolta lähetetään käyttävät tätä merkistöä. Kuitenkin jokainen yksittäinen käyttäjä voi asettaa merkistönsä, jos seuraava asetus on päällä..';
$string['configsmtphosts'] = 'Anna yhden tai useamman, Moodlen sähköpostin lähettämiseen käyttämän, paikallisen SMTP-palvelimen koko nimi (esim. \'mail.a.com\' tai \'mail.a.com;mail.b.com\'). Jos jätät tämän tyhjäksi, Moodle käyttää PHP:n oletustapaa lähettää sähköpostit.';
$string['configsmtpmaxbulk'] = 'SMTP-session lähettämien viestien enimmäismäärä. Viestien ryhmittely voi nopeuttaa viestien lähettämistä. Arvot alle 2 pakottavat uuden SMTP-session luomisen jokaista sähköpostia varten.';
$string['configsmtpuser'] = 'Jos olet määritellyt ylhäällä SMTP-palvelimen ja tuo palvelin vaatii kirjautumista, niin kirjoita käyttäjänimi (ylle) ja salasana (alle) tähän.';
$string['email'] = 'Lähetä sähköposti-ilmoitukset henkilölle';
$string['mailnewline'] = 'Rivinvaihtomerkit sähköposteissa';
$string['noreplyaddress'] = '"Ei vastauksia"-osoite';
$string['pluginname'] = 'Sähköposti';
$string['sitemailcharset'] = 'Merkistö';
$string['smtphosts'] = 'SMTP palvelin';
$string['smtpmaxbulk'] = 'SMTP-session raja';
$string['smtppass'] = 'SMTP salasana';
$string['smtpuser'] = 'SMTP tunnus';
