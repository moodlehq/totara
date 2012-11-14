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
 * Strings for component 'message', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   message
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcontact'] = 'Lägg till kontakt';
$string['addsomecontacts'] = 'För att skicka ett meddelande till någon, eller lägga till en genväg till dem på den här sidan så använder Du <a href="{$a}">Sök </a> här ovan.';
$string['addsomecontactsincoming'] = 'De här meddelandena är från personer som inte finns med i Din kontaktlista. För att lägga till dem till Dina kontakter så ska Du klicka på ikonen "Lägg till kontakt" som Du hittar intill deras namn.';
$string['ago'] = 'För {$a} sedan';
$string['ajax_gui'] = 'Chatrum Ajax';
$string['allmine'] = 'Alla meddelanden från mig till mig';
$string['allstudents'] = 'Alla meddelanden mellan studenter/elever/deltagare/lärande i kursen';
$string['allusers'] = 'Alla meddelanden från alla användare';
$string['backupmessageshelp'] = 'Om detta är altiverat så kommer snabbmeddelanden att tas med i automatiska säkerhetskopieringar för hela webbplatsen.';
$string['beepnewmessage'] = 'Avge en ljudsignal när det kommer in ett nytt meddelande';
$string['blockcontact'] = 'Blockera kontakt';
$string['blockedmessages'] = '{$a} meddelande(n) till/från blockerade användare';
$string['blockedusers'] = 'Blockerade användare ({$a})';
$string['blocknoncontacts'] = 'Blockera alla nya meddelanden från personer som inte finns med på min kontaktlista.';
$string['contactlistempty'] = 'Din kontaktlista är tom.';
$string['contacts'] = 'Kontakter';
$string['context'] = 'Sammanhang';
$string['couldnotfindpreference'] = 'Det gick inte att ladda preferenserna {$a}.  Matchar komponenten och det namn Du angav till message_send() en rad i message_provider? Tillhandahållarna av meddelanden måste finnas i databasen så att användarna kan konfigurera hur de vill bli uppmärksammade när de tar emot meddelanden.';
$string['deletemessagesdays'] = 'Antal dagar innan gamla meddelanden tas bort automatiskt';
$string['disabled'] = 'Funktionen meddelanden är avaktiverad på den här webbplatsen';
$string['discussion'] = 'Diskussion';
$string['editmymessage'] = 'Meddelanden';
$string['emailmessages'] = 'E-postmeddelanden när jag arbetar i frånkopplat läge';
$string['emailtagline'] = 'Det här e-postmeddelandet är en kopia av ett meddelande som har skickats till Dig på "{$a->sitename}". Gå till  {$a->url} för att svara.';
$string['emptysearchstring'] = 'Du måste söka efter någonting';
$string['errorcallingprocessor'] = 'Fel i sb m anrop till den definierade processorn';
$string['formorethan'] = 'I mer än';
$string['gotomessages'] = 'Gå till meddelanden';
$string['guestnoeditmessage'] = 'Gästanvändare kan inte redigera alternativen för meddelanden';
$string['guestnoeditmessageother'] = 'Gästanvändare kan inte redigera andra alternativ för meddelanden';
$string['includeblockedusers'] = 'Ta med blockerade användare';
$string['incomingcontacts'] = 'Inkommande kontakter ({$a})';
$string['keywords'] = 'Nyckelord';
$string['keywordssearchresults'] = 'Funna meddelanden: {$a}';
$string['keywordssearchresultstoomany'] = 'Det fanns fler än {$a} meddelanden. Specificera Din sökning noggrannare';
$string['loggedin'] = 'Uppkopplad';
$string['loggedindescription'] = 'När jag är inloggad';
$string['loggedoff'] = 'Inte uppkopplad';
$string['loggedoffdescription'] = 'När jag inte är uppkopplad';
$string['mailsent'] = 'Ditt meddelande har skickats via e-post';
$string['maxmessages'] = 'Maximalt antal meddelanden som ska visas i historiken över diskussionsämnen';
$string['message'] = 'Meddelande';
$string['messagehistory'] = 'Historik för meddelanden';
$string['messagehistoryfull'] = 'Alla meddelanden';
$string['messages'] = 'Meddelanden';
$string['messaging'] = 'Skickar meddelanden';
$string['messagingdisabled'] = 'Funktionen för meddelanden är avaktiverad på den här webbplatsen, det kommer att skickas ut e-post istället.';
$string['mostrecent'] = 'Aktuella meddelanden';
$string['mycontacts'] = 'Mina kontakter';
$string['newonlymsg'] = 'Visa bara nya';
$string['newsearch'] = 'Ny sökning';
$string['noframesjs'] = 'Använd ett mer tillgängligt gränssnitt';
$string['nomessages'] = 'Inga avvaktande meddelanden';
$string['nomessagesfound'] = 'Det gick inte att hitta några nya meddelanden';
$string['noreply'] = 'Svara inte på detta meddelande';
$string['nosearchresults'] = 'Din sökning gav inga träffar';
$string['offline'] = 'Frånkopplat läge';
$string['offlinecontacts'] = 'Kontakter i frånkopplat läge ({$a})';
$string['online'] = 'Uppkopplad';
$string['onlinecontacts'] = 'Kontakter i uppkopplat läge ({$a})';
$string['onlyfromme'] = 'Endast meddelanden från mig';
$string['onlymycourses'] = 'Endast i mina kurser';
$string['onlytome'] = 'Endast meddelanden till mig';
$string['pagerefreshes'] = 'Den här sidan uppdateras automatiskt var {$a} sekund';
$string['private_config'] = 'Pop-up-fönster med meddelande';
$string['providers_config'] = 'Konfigurera metoderna för att annonsera inkommande meddelanden';
$string['readmessages'] = '{$a} lästa meddelanden';
$string['removecontact'] = 'Ta bort kontakt';
$string['savemysettings'] = 'Spara mina inställningar';
$string['search'] = 'Sök';
$string['searchcombined'] = 'Sök personer och meddelanden';
$string['searchforperson'] = 'Sök en person';
$string['searchmessages'] = 'Sök meddelande';
$string['sendmessage'] = 'Skicka meddelande';
$string['sendmessageto'] = 'Skicka meddelande till {$a}';
$string['sendmessagetopopup'] = 'Skicka meddelande till {$a} - nytt fönster';
$string['settings'] = 'Inställningar';
$string['settingssaved'] = 'Dina inställningar har sparats';
$string['showmessagewindow'] = 'Visa fönstret för meddelanden automatiskt när jag får nya meddelanden (Du behöver se till att inställningarna i Din webbläsare inte blockerar popup-fönster på den här webbplatsen)';
$string['strftimedaydatetime'] = '%A, %d %B %Y, %I:%M %p';
$string['timenosee'] = 'Antal minuter som jag var uppkopplad';
$string['timesent'] = 'Tid för avsändning';
$string['unblockcontact'] = 'Ta bort blockering av användare';
$string['unreadmessages'] = '({$a}) olästa meddelanden';
$string['unreadnewmessage'] = 'Nytt meddelande från {$a}';
$string['unreadnewmessages'] = 'Nya meddelanden från {$a}';
$string['userisblockingyou'] = 'Den här användaren har blockerat Dig från att skicka meddelanden till dem';
$string['userisblockingyounoncontact'] = 'Den här användaren accepterar bara meddelanden från personer på sin kontaktlista och där finns Du f.n. inte med.';
$string['userssearchresults'] = '{$a} användare hittades';
