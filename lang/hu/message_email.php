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
 * Strings for component 'message_email', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   message_email
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowusermailcharset'] = 'Felhasználók számára karakterkészlet kiválasztásának engedélyezése';
$string['configallowusermailcharset'] = 'Bekapcsolásakor a felhasználó saját karakterkészletet állíthat be az e-mailhez.';
$string['configmailnewline'] = 'Levélüzenetekben használt újsor-karakterek. A CRLF használatát az RFC 822bis írja elő, egyes mailszerverek automatikusan végrehajtják az LF-ről CRLF-re való átalakítást, más mailszerverek hibásan alakítják át a CRLF-et CRCRLF-re, és vannak olyanok, amelyek elutasítják a sima LF-et tartalmazó leveleket (például a qmail). Próbálja meg módosítani ezt a beállítást, ha gondja van a kézbesítetlen levelekkel vagy a kettős új sorokkal.';
$string['confignoreplyaddress'] = 'E-maileket esetenként egy felhasználó nevében továbbít a rendszer (pl. fórumüzenetek). Az itt megadott e-mail cím jelenik meg mint \'Feladó\' azon esetekben, amikor a címzettek nem válaszolhatnak közvetlenül a felhasználónak (például amikor a felhasználó úgy dönt, hogy címét nem hozza nyilvánosságra).';
$string['configsitemailcharset'] = 'A portálon létrejövő összes e-mail ebben a karakterkészletben jelenik meg. Egyébként bármely felhasználó beállíthatja, ha az alábbi lehetőség be van kapcsolva.';
$string['configsmtphosts'] = 'Adja meg egy vagy több olyan helyi SMTP-szerver teljes nevét, amelyet a Moodle levélküldésre használhat (pl. \'mail.a.com\' vagy \'mail.a.com;mail.b.com\'). Ha nem alapértelmezett (vagyis 25) portot ad meg, használhatja a [server]:[port] alakot (pl. \'mail.a.com:587\'. Ha üresen hagyja, a Moodle levélküldésre a PHP alapbeállítás szerinti módszerét fogja használni.';
$string['configsmtpmaxbulk'] = 'Egy SMTP-folyamat alatt küldött üzenetek maximális száma. Az üzenetek csoportosítása felgyorsíthatja az e-mailek küldését. A 2-nél alacsonyabb értékek minden egyes e-mailhez új SMTP-folyamatot írnak elő.';
$string['configsmtpuser'] = 'Ha fentebb beállított egy SMTP-szervert és a szervernek hitelesítésre van szüksége, a felhasználónevet és a jelszót adja meg itt.';
$string['email'] = 'E-mailben értesítendők';
$string['mailnewline'] = 'Újsor-karakterek a levélben';
$string['noreplyaddress'] = 'Választ nem váró cím';
$string['pluginname'] = 'E-mail';
$string['sitemailcharset'] = 'Karakterkészlet';
$string['smtphosts'] = 'SMTP-gazdagépek';
$string['smtpmaxbulk'] = 'Az SMTP-folyamat korlátja';
$string['smtppass'] = 'SMTP-jelszó';
$string['smtpuser'] = 'SMTP-felhasználó';
