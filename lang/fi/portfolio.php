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
 * Strings for component 'portfolio', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   portfolio
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activeexport'] = 'Ratkaise aktiivinen vienti';
$string['activeportfolios'] = 'Käytettävissäolevat portfoliot';
$string['addalltoportfolio'] = 'Vie kaikki portfolioon';
$string['addnewportfolio'] = 'Lisää uusi portfolio';
$string['addtoportfolio'] = 'Vie portfolioon';
$string['alreadyalt'] = 'Vienti käynnissä - ole hyvä ja klikkaa tässä ratkaistaksesi tämän siirron';
$string['alreadyexporting'] = 'Sinulla on jo aktiivinen portfolioon vienti tässä sessiossa. Ennen jatkamista, sinun täytyy joko odottaa viennin loppumista tai lopettaa se. Haluatko odottaa? (Ei lopettaa viennin)';
$string['availableformats'] = 'Käytettävissä olevat vientimuodot';
$string['callbackclassinvalid'] = 'Määritelty callback-luokka oli virheellinen tai ei osa portfolio_caller hierarkiaa';
$string['callercouldnotpackage'] = 'Tietojasi ei voitu paketoida vientiä varten: alkuperäinen virhe oli {$a}';
$string['cannotsetvisible'] = 'Ei voida asettaa näkyväksi - plugini on kokonaan estetty väärän konfiguraation takia';
$string['commonportfoliosettings'] = 'Yleiset portfolion asetukset';
$string['commonsettingsdesc'] = '<p>Tiedoston siirtoon kuluvan ajan arviointi \'Kohtalaiseksi\' tai \'Suureksi\' riippuu siitä pystyykö käyttäjä odottamaan siirron valmistumista vai ei.</p><p>Koot \'Kohtalaiseen\' rajaan asti tapahtuvat välittömästi, ilman että käyttäjältä kysytään mitään. \'Kohtalaiset\' ja \'Suuret\' siirrot tarkoittavat, että käyttäjälle tarjotaan vaihtoehto, mutta häntä varoitetaan, että siirto saattaa kestää jonkin aikaa.</p><p>Lisäksi jotkin portfoliopluginit saattavat jättää tämän asetuksen huomioimatta kokonaan ja pakottaa kaikki siirrot jonoon.</p>';
$string['configexport'] = 'Konfiguroi viedyt tiedot';
$string['configplugin'] = 'Konfiguroi portfolioplugini';
$string['configure'] = 'Konfiguroi';
$string['confirmcancel'] = 'Haluatko varmasti peruuttaa tämän viennin?';
$string['confirmexport'] = 'Ole hyvä ja varmista tämä vienti';
$string['confirmsummary'] = 'Vientisi tiivistelmä';
$string['continuetoportfolio'] = 'Jatka portfolioosi';
$string['deleteportfolio'] = 'Poista portfolioinstanssi';
$string['destination'] = 'Kohde';
$string['disabled'] = 'Valitettavasti portfolioon vientejä ei ole sallittu tällä sivustolla';
$string['disabledinstance'] = 'Estetty';
$string['displayarea'] = 'Vientialue';
$string['displayexpiry'] = 'Siirron vanhenemisaika';
$string['displayinfo'] = 'Vienti-info';
$string['dontwait'] = 'Älä odota';
$string['enabled'] = 'Salli portfoliot';
$string['enableddesc'] = 'Tämä sallii ylläpitäjien konfiguroida etäjärjestelmiä, joihin käyttäjät voivat viedä sisältöjään';
$string['err_uniquename'] = 'Portfolion nimi täytyy olla ainutlaatuinen';
$string['exportalreadyfinished'] = 'Portfolioon vienti valmis!';
$string['exportalreadyfinisheddesc'] = 'Portfolioon vienti valmis!';
$string['exportcomplete'] = 'Portfolioon vienti valmis!';
$string['exportedpreviously'] = 'Aiemmat viennit';
$string['exportexceptionnoexporter'] = 'Aktiivisesta sessiosta ilmeni portfolio_export_exception ilman vientiobjektia';
$string['exportexpired'] = 'Portfolion vienti on vanhentunut';
$string['exportexpireddesc'] = 'Yritit toistaa jonkin tiedon viennin tai aloittaa tyhjän viennin. Tehdäksesi sen, sinun täytyy mennä takaisin alkuperäiseen kohteeseen ja aloittaa alusta. Tämä tapahtuu joskus jos käytät edellinen-painiketta viennin valmistumisen jälkeen tai jos olet tallentanut kirjanmerkkeihin virheellisen url-osoitteen.';
$string['exporting'] = 'Viedään portfolioon';
$string['exportingcontentfrom'] = 'Viedään sisältöä kohteesta {$a}';
$string['exportingcontentto'] = 'Viedään sisältöä kohteeseen {$a}';
$string['exportqueued'] = 'Portfolioon vienti on onnistuneesti lisätty siirtojonoon';
$string['exportqueuedforced'] = 'Portfolioon vienti on onnistuneesti lisätty siirtojonoon (etäjärjestelmä on pakottanut jonossa olevat siirrot)';
$string['failedtopackage'] = 'Ei löydetty paketoitavia tiedostoja';
$string['failedtosendpackage'] = 'Ei onnistuttu lähettämään tietojasi valittuun portfoliojärjestelmään: alkuperäinen virhe oli {$a}';
$string['filedenied'] = 'Tähän tiedostoon pääsy on estetty';
$string['filenotfound'] = 'Tiedostoa ei löydy';
$string['fileoutputnotsupported'] = 'Tiedoston tulosteen uudelleenkirjoittamista ei tueta tälle formaatille';
$string['format_document'] = 'Dokumentti';
$string['format_file'] = 'Tiedosto';
$string['format_image'] = 'Kuva';
$string['format_leap2a'] = 'Leap2A porfolioformaatti';
$string['format_mbkp'] = 'Moodlen varmuuskopioformaatti';
$string['format_pdf'] = 'PDF';
$string['format_plainhtml'] = 'HTML';
$string['format_presentation'] = 'Esitys';
$string['format_richhtml'] = 'HTML liitteiden kanssa';
$string['format_spreadsheet'] = 'Taulukkolaskenta';
$string['format_text'] = 'Pelkkä teksti';
$string['format_video'] = 'Video';
$string['hidden'] = 'Piilotettu';
$string['highdbsizethreshold'] = 'Suuren siirron tietokantakoko';
$string['highdbsizethresholddesc'] = 'Tietokantamerkintöjen määrä, joka ylitettäessä siirron arvioidaan vievän kauan aikaa';
$string['highfilesizethreshold'] = 'Suuren siirron tiedostokoko';
$string['highfilesizethresholddesc'] = 'Tämän rajan ylittävien tiedostokokojen siirron arvioidaan vievän kauan aikaa';
$string['insanebody'] = 'Hei! Tämä viesti on tarkoitettu sivuston {$a->sitename} ylläpitäjälle.

Jotkin portfoliopluginit on automaattisesti estetty virheellisen konfiguraation takia. Tämä tarkoittaa että käyttäjät eivät voi viedä sisältöjään näihin portfolioihin.

Estettyjen portfoliopluginien lista on:

{$a->textlist}

Tämä pitäisi korjata mahdollisimman pian vierailemalla osoitteessa {$a->fixurl}.';
$string['insanebodyhtml'] = '<p>Hei! Tämä viesti on tarkoitettu sivuston {$a->sitename} ylläpitäjälle.</p>
<p>Jotkin portfoliomoduulit on automaattisesti estetty virheellisen konfiguraation takia. Tämä tarkoittaa että käyttäjät eivät voi viedä sisältöjään näihin portfolioihin.</p>
<p>Estettyjen portfoliomoduulien lista on:</p>
{$a->textlist}
<p>Tämä pitäisi korjata mahdollisimman pian vierailemalla <a href="{$a->fixurl}">portfolioiden asetussivulla</a></p>';
$string['insanebodysmall'] = 'Hei! Tämä viesti on tarkoitettu sivuston {$a->sitename} ylläpitäjälle. Jotkin portfoliomoduulit on automaattisesti estetty virheellisen konfiguraation takia. Tämä tarkoittaa että käyttäjät eivät voi viedä sisältöjään näihin portfolioihin. Tämä pitäisi korjata mahdollisimman pian vierailemalla osoitteessa {$a->fixurl}.';
$string['insanesubject'] = 'Jotkin portfoliot on automaattisesti estetty';
$string['instancedeleted'] = 'Portfolio poistettu onnistuneesti';
$string['instanceismisconfigured'] = 'Portfolio on väärin konfiguroitu, ohitetaan. Virhe oli: {$a}';
$string['instancenotdelete'] = 'Ei voitu poistaa portfoliota';
$string['instancenotsaved'] = 'Ei voitu tallentaa portfoliota';
$string['instancesaved'] = 'Portfolio tallennettu onnistuneesti';
$string['invalidaddformat'] = 'Virheellinen lisäysformaatti ohjattu kohteeseen portfolio_add_button. ({$a}) Pitää olla muotoa PORTFOLIO_ADD_XXX';
$string['invalidbuttonproperty'] = 'Ei löydetty ominaisuutta ({$a}) portfolio_button:ista';
$string['invalidconfigproperty'] = 'Ei löydetty konfiguraatio-ominaisuutta ({$a->property} luokasta {$a->class})';
$string['invalidexportproperty'] = 'Ei löydetty viennin konfiguraatio-ominaisuutta ({$a->property} luokasta {$a->class})';
$string['invalidfileareaargs'] = 'Virheelliset tiedostoalueen argumentit ohjattu kohteelle set_file_and_format_data - täytyy sisältää contextid, component, filearea ja itemid';
$string['invalidformat'] = 'Jokin yrittää viedä virheellistä formaattia';
$string['invalidinstance'] = 'Ei löydetty portfolioinstanssia';
$string['invalidpreparepackagefile'] = 'Virheellinen kutsu kohteelle prepare_package_file - täytyy asettaa joko yksittäinen tai useampi tiedosto';
$string['invalidproperty'] = 'Ei löydetty ominaisuutta ({$a->property} luokasta {$a->class})';
$string['invalidsha1file'] = 'Virheellinen kutsu kohteelle get_sha1_file - täytyy asettaa joko yksittäinen tai useampi tiedosto';
$string['invalidtempid'] = 'Virheellinen vienti-id. Ehkä se on vanhentunut';
$string['invaliduserproperty'] = 'Ei löydetty käyttäjän konfigurointiominaisuutta ({$a->property} luokasta {$a->class})';
$string['leap2a_emptyselection'] = 'Vaadittua arvoa ei ole valittu';
$string['leap2a_entryalreadyexists'] = 'Yritit lisätä Leap2A-merkintää id:llä ({$a}) joka on jo olemassa tässä syötteessä';
$string['leap2a_feedtitle'] = 'Leap2A vienti Moodlesta kohteeseen {$a}';
$string['leap2a_filecontent'] = 'Yritettiin asettaa Leap2A-merkinnän sisältö tiedostoon, tiedoston alaluokan käyttämisen sijasta';
$string['leap2a_invalidentryfield'] = 'Yritit asettaa merkintäkenttää jota ei ole olemassa ({$a}) tai et voi asettaa suoraan';
$string['leap2a_invalidentryid'] = 'Yritit päästä merkintään id:llä jota ei ole olemassa ({$a})';
$string['leap2a_missingfield'] = 'Vaadittu Leap2A-merkinnän kenttä {$a} puuttuu';
$string['leap2a_nonexistantlink'] = 'Leap2A-merkintä ({$a->from}) yritti linkittää merkintään jota ei ole olemassa ({$a->to}). rel: {$a->rel}';
$string['leap2a_overwritingselection'] = 'Ylikirjoitetaan alkuperäinen tyyppi merkinnästä ({$a}) valintaan make_selection';
$string['leap2a_selflink'] = 'Leap2A-merkintä ({$a->id}) yritti linkittää itseensä. rel: {$a->rel}';
$string['logs'] = 'Siirtolokit';
$string['logsummary'] = 'Edelliset onnistuneet siirrot';
$string['manageportfolios'] = 'Hallitse portfolioita';
$string['manageyourportfolios'] = 'Hallitse portfolioitasi';
$string['mimecheckfail'] = 'Portfolioplugini {$a->plugin} ei tue kyseistä mimetyyppiä {$a->mimetype}';
$string['missingcallbackarg'] = 'Puuttuva callback argumentti {$a->arg} luokalle {$a->class}';
$string['moderatedbsizethreshold'] = 'Kohtalaisen siirron tietokantakoko';
$string['moderatedbsizethresholddesc'] = 'Tietokantamerkintöjen määrä, joka ylitettäessä siirron arvioidaan vievän kohtalaisesti aikaa';
$string['moderatefilesizethreshold'] = 'Kohtalaisen siirron tiedostokoko';
$string['moderatefilesizethresholddesc'] = 'Tämän rajan ylittävien tiedostokokojen siirron arvioidaan vievän kohtalaisesti aikaa';
$string['multipleinstancesdisallowed'] = 'Yritetään luoda toinen instanssi pluginista joka ei salli useita instansseja ({$a})';
$string['mustsetcallbackoptions'] = 'Sinun täytyy asettaa callback-asetukset joko portfolio_add_button -muodostimessa tai käyttäen set_callback_options -metodia';
$string['noavailableplugins'] = 'Valitettavasti ei ole portfolioita joihin voisit viedä';
$string['nocallbackclass'] = 'Ei löydetty callback-luokkaa jota käyttää ({$a})';
$string['nocallbackfile'] = 'Jokin on rikki moduulissa josta yrität viedä - ei löydetty vaadittavaa tiedostoa ({$a})';
$string['noclassbeforeformats'] = 'Sinun täytyy asettaa callback-luokka ennen kuin kutsut kohdetta set_formats kohteessa portfolio_button';
$string['nocommonformats'] = 'Ei yhteisiä formaatteja yhdenkään portfoliopluginin ja kutsumiskohteen {$a->location} välillä (kutsujan tukemat {$a->formats})';
$string['noinstanceyet'] = 'Ei vielä valittu';
$string['nologs'] = 'Ei näytettäviä lokeja!';
$string['nomultipleexports'] = 'Valitettavasti portfoliokohde ({$a->plugin}) ei tue useita vientejä yhtä aikaa. Ole hyvä, <a href="{$a->link}">suorita nykyinen loppuun ensin</a> ja yritä sitten uudelleen';
$string['nonprimative'] = 'Ei-alkeellinen arvo välitettiin callback-argumenttina kohteelle portfolio_add_button. Ei voida jatkaa. Avain oli {$a->key} ja arvo oli {$a->value}';
$string['nopermissions'] = 'Valitettavasti sinulla ei ole vaadittavia oikeuksia tiedostojen viemiseen tältä alueelta';
$string['notexportable'] = 'Valitettavasti valitsemasi sisällön tyyppi ei ole vietävissä';
$string['notimplemented'] = 'Valitettavasti yrität viedä sisältöä formaatissa, jota ei ole vielä toteutettu ({$a})';
$string['notyetselected'] = 'Ei vielä valittu';
$string['notyours'] = 'Yrität jatkaa portfolioon vientiä joka ei kuulu sinulle!';
$string['nouploaddirectory'] = 'Ei voitu luoda väliaikaista hakemistoa tietojesi paketointiin';
$string['off'] = 'Sallittu mutta piilotettu';
$string['on'] = 'Sallittu ja näkyvissä';
$string['plugin'] = 'Portfolioplugini';
$string['plugincouldnotpackage'] = 'Ei voitu paketoida tietojasi vientiä varten: alkuperäinen virhe oli {$a}';
$string['pluginismisconfigured'] = 'Portfolioplugini on väärin konfiguroitu, ohitetaan. Virhe oli: {$a}';
$string['portfolio'] = 'Portfolio';
$string['portfolios'] = 'Portfoliot';
$string['queuesummary'] = 'Jonossa olevat siirrot';
$string['returntowhereyouwere'] = 'Palaa takaisin missä olit';
$string['save'] = 'Tallenna';
$string['selectedformat'] = 'Valittu vientiformaatti';
$string['selectedwait'] = 'Valittu odottamaan?';
$string['selectplugin'] = 'Valitse kohde';
$string['singleinstancenomultiallowed'] = 'Vain yksi portfolioplugini-instanssi on käytettävissä. Se ei tue useita vientejä per sessio ja tällä pluginilla on jo aktiivinen vienti käynnissä!';
$string['somepluginsdisabled'] = 'Jotkin kokonaiset portfoliopluginit on estetty, koska ne ovat joko väärin konfiguroituja tai riippuvat jostakin muusta, joka on:';
$string['sure'] = 'Oletko varma että haluat poistaa kohteen \'{$a}\'? Tätä ei voi peruuttaa.';
$string['thirdpartyexception'] = 'Kolmannen osapuolen poikkeus tuli kesken portolioon viennin ({$a}). Poikkeus saatiin kiinni ja käsiteltiin mutta asia pitäisi korjata';
$string['transfertime'] = 'Siirtoaika';
$string['unknownplugin'] = 'Tuntematon (saattaa olla tämän jälkeen poistettu ylläpitäjän toimesta)';
$string['wait'] = 'Odota';
$string['wanttowait_high'] = 'Ei ole suositeltavaa että odotat tämän siirron valmistumista, mutta voit tehdä näin, jos olet varma ja tiedät mitä teet';
$string['wanttowait_moderate'] = 'Haluatko odottaa tätä siirtoa? Siinä saattaa kestää muutamia minuutteja';
