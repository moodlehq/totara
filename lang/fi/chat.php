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
 * Strings for component 'chat', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['ajax'] = 'Ajax-versio';
$string['autoscroll'] = 'Automaattinen vieritys';
$string['beep'] = 'kutsu';
$string['cantlogin'] = 'Ei voinut kirjautua chat-huoneeseen!!';
$string['chat:chat'] = 'Kirjaudu chat-huoneeseen';
$string['chat:deletelog'] = 'Chatin lokien poisto';
$string['chat:exportparticipatedsession'] = 'Vie chat-keskustelut, joihin osallistuit';
$string['chat:exportsession'] = 'Vie kaikki chat-keskustelut';
$string['chat:readlog'] = 'Chatin lokien lukeminen';
$string['chat:talk'] = 'Keskustele chatissa';
$string['chatintro'] = 'Johdanto';
$string['chatname'] = 'Chat-huoneen nimi';
$string['chatreport'] = 'Chat-keskustelut';
$string['chattime'] = 'Seuraavan chatin aika';
$string['configmethod'] = 'Ajax chat-metodi tarjoaa ajax-pohjaisen käyttöliittymän, joka ottaa säännöllisesti yhteyttä palvelimelle päivittääkseen chatin. Normaalisti chatin toiminta vaatii selaimen ottavan yhteyttä säännöllisesti palvelimeen. Tämä toimii kaikkialla eikä vaadi asetuksia, mutta saattaa samalla aiheuttaa kuormitusta palvelimelle. Chat-palvelu vaatii unix-komentorivin käyttömahdollisuuden, mutta skaalautuu paremmin laajempaan käyttöön.';
$string['confignormalupdatemode'] = 'Chatin päivitys hoidetaan yleensä HTTP 1.1:n <em>Keep-Alive</em>-ominaisuudella, mutta se on aika raskas palvelimelle. Tehokkaampi tapa on käyttää <em>Stream</em>-menetelmää chatin päivityksessä. <em>Stream</em> skaalautuu paremmin (kuten chatd), mutta palvelimesi ei välttämättä tue sitä.';
$string['configoldping'] = 'Kuinka pitkän ajan kuluttua käyttäjä katsotaan poistuneeksi siitä, kun hänestä ei ole kuulunut mitään?';
$string['configrefreshroom'] = 'Kuinka usein chat-huone päivitetään (sekunteina)? Mitä lyhyempi aika, sen "nopeampi" huone on, mutta palvelimen kuormitus on sitä suurempi, mitä enemmän käyttäjiä on huoneessa samaan aikaan.';
$string['configrefreshuserlist'] = 'Kuinka usein käyttäjälista päivitetään (sekunteina)';
$string['configserverhost'] = 'Sen palvelimen nimi, jolla chat-palvelu sijaitsee';
$string['configserverip'] = 'Chat-palvelun IP-osoite, joka vastaa palvelimen nimeä';
$string['configservermax'] = 'Osallistujien enimmäismäärä';
$string['configserverport'] = 'Chat-palvelun portti';
$string['currentchats'] = 'Aktiiviset chat-keskustelut';
$string['currentusers'] = 'Tämänhetkiset osallistujat';
$string['deletesession'] = 'Poista tämä keskustelu';
$string['deletesessionsure'] = 'Oletko varma, että haluat poistaa tämän keskustelun?';
$string['donotusechattime'] = 'Älä julkaise aikoja';
$string['enterchat'] = 'Napsauta tästä päästäksesi mukaan chattiin';
$string['errornousers'] = 'Muita käyttäjiä ei löydy!';
$string['explaingeneralconfig'] = 'Nämä asetukset ovat <strong>aina</strong> voimassa';
$string['explainmethoddaemon'] = 'Näillä asetuksilla on vaikutusta <strong>vain</strong> jos käytät "Chat-palvelu"-asetusta.';
$string['explainmethodnormal'] = 'Näillä asetuksilla on vaikutusta <strong>vain</strong> jos käytät "Normaali toiminta"-asetusta.';
$string['generalconfig'] = 'Yleiset asetukset';
$string['idle'] = 'Tyhjä';
$string['inputarea'] = 'Kirjoitusalue';
$string['invalidid'] = 'Haluamaasi chat-huonetta ei löytynyt!';
$string['list_all_sessions'] = 'Näytä kaikki keskustelut.';
$string['list_complete_sessions'] = 'Näytä vain päättyneet keskustelut';
$string['listing_all_sessions'] = 'Näytetään kaikki keskustelut';
$string['messagebeepseveryone'] = '{$a} kutsuu kaikkia!';
$string['messagebeepsyou'] = '{$a} on juuri kutsunut sinua!';
$string['messageenter'] = '{$a} on juuri tullut mukaan chattiin';
$string['messageexit'] = '{$a} on lopettanut chatin';
$string['messages'] = 'Viestit';
$string['messageyoubeep'] = 'Kutsuit toista osallistujaa {$a}';
$string['method'] = 'Chat-tapa';
$string['methodajax'] = 'Ajax-metodi';
$string['methoddaemon'] = 'Chat-palvelu';
$string['methodnormal'] = 'Normaali toiminta';
$string['modulename'] = 'Chat';
$string['modulename_help'] = 'Chatissa osallistujat keskustelevat samanaikaisesti eli synkronisesti verkon kautta. Chatilla saatkin aikaan erilaista keskustelua ja aiheen käsittelyä kuin asynkronisilla keskustelualueilla.';
$string['modulenameplural'] = 'Chatit';
$string['neverdeletemessages'] = 'Älä koskaan poista keskusteluja';
$string['nextsession'] = 'Seuraava sovittu keskusteluaika';
$string['no_complete_sessions_found'] = 'Ajastetusti päättyneitä keskusteluja ei ole.';
$string['nochat'] = 'Chatteja ei löytynyt.';
$string['noguests'] = 'Tämä chat ei ole avoinna vierailijoille';
$string['nomessages'] = 'Ei viestejä';
$string['nopermissiontoseethechatlog'] = 'Sinulla ei ole oikeuksia nähdä keskustelujen lokeja.';
$string['normalkeepalive'] = 'Pidä yhteys';
$string['normalstream'] = 'Virta';
$string['noscheduledsession'] = 'Seuraavaa keskusteluaikaa ei ole määritelty';
$string['notallowenter'] = 'Sinulla ei ole pääsyä tähän keskusteluun.';
$string['notlogged'] = 'Et ole kirjautunut!';
$string['oldping'] = 'Yhteyden katkaisun aikaraja';
$string['page-mod-chat-x'] = 'Kaikki chat-moduulin sivut';
$string['pastchats'] = 'Menneet keskustelut';
$string['pluginadministration'] = 'Chatin hallinnoija';
$string['pluginname'] = 'Chat';
$string['refreshroom'] = 'Päivitä huone';
$string['refreshuserlist'] = 'Päivitä osallistujalista';
$string['removemessages'] = 'Poista kaikki viestit';
$string['repeatdaily'] = 'Joka päivä samaan aikaan';
$string['repeatnone'] = 'Ei toistoja - julkaise vain määritetyllä ajalla';
$string['repeattimes'] = 'Keskusteluajan julkaisu ja toisto';
$string['repeatweekly'] = 'Joka viikko samaan aikaan';
$string['saidto'] = 'sanottu henkilölle';
$string['savemessages'] = 'Säästä menneet keskustelut';
$string['seesession'] = 'Katso tätä keskustelua';
$string['send'] = 'Lähetä';
$string['sending'] = 'Lähettää';
$string['serverhost'] = 'Palvelimen nimi';
$string['serverip'] = 'Palvelimen ip-osoite';
$string['servermax'] = 'Osallistujien enimmäismäärä';
$string['serverport'] = 'Palvelimen portti';
$string['sessions'] = 'Chat-keskustelut';
$string['sessionstart'] = 'Keskustelun aloitusaika: {$a}';
$string['strftimemessage'] = '%H:%M';
$string['studentseereports'] = 'Menneet keskustelut näytetään kaikille';
$string['studentseereports_help'] = 'Jos asetettu EI, vain käyttäjät joilla on kyky mod/chat:readlog voivat nähdä chat logit';
$string['talk'] = 'Puhu';
$string['updatemethod'] = 'Päivitysmenetelmä';
$string['updaterate'] = 'Päivitysnopeus';
$string['userlist'] = 'Osallistujalista';
$string['usingchat'] = 'Chat käytössä';
$string['usingchat_help'] = '**Chatin käyttäminen **
Chat-moduuli sisältää ominaisuuksia joilla keskusteleminen saadaan mukavammaksi.
**Hymiöt**
Mitkä tahansa hymiöt jotka voit kirjoittaa muualla moodlessa, voidaan kirjoitaa täällä samoin ja ne näytetään oikein. Esimerkiksi: :-)
**Linkit**

Internetosoiteet muunnetaan linkeiksi automaattisesti
**Tunteilu**

Voit aloittaa rivin "/me" tai ":" tunteillaksesi. Tällä voit kuvaila tekemisisäsi ja tunnetilojasi siten että se erottuu muun tekstin joukosta. Jos nimesi on Pekka ja kirjoitat "/me nauraa!" Tulee chattiin rivi "Pekka nauraa!"
**Kutsut**

Voit lähettää muille kutsumisäänen painamalla "kutsu" linkkiä heidän nimensä vieressä. Voit kutsua kaikkia helposti kirjoittamalla: "beeb all".
**HTML**
: Jos osaat HTML-koodausta voit värittää tekstejäsi, lisätä kuvia yms...';
$string['viewreport'] = 'Näytä menneet keskustelut';
