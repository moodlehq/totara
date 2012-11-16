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
 * Strings for component 'blog', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   blog
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addnewentry'] = 'Lisää uusi merkintä';
$string['addnewexternalblog'] = 'Rekisteröi ulkoinen blogi';
$string['assocdescription'] = 'Jos kirjoitat kurssista ja/tai aktiviteettimoduuleista, valitse ne tästä.';
$string['associated'] = 'Yhdistetty {$a}';
$string['associatewithcourse'] = 'Blogi kurssista {$a->coursename}';
$string['associatewithmodule'] = 'Blogi moduulista {$a->modtype}: {$a->modname}';
$string['association'] = 'Yhdistyminen';
$string['associations'] = 'Yhdistymiset';
$string['associationunviewable'] = 'Muut eivät voi katsella tätä kirjoitusta kunnes se on yhdistetty kurssiin tai \'Julkaise\' -kenttää on muutettu';
$string['autotags'] = 'Lisää avainsanat';
$string['autotags_help'] = 'Anna yksi tai useampi paikallinen tunniste (erotettu pilkuilla), jotka haluat automaattisesti lisätä jokaiseen ulkoisesta paikkalliseen blogiisi kopioituun kirjoitukseen.';
$string['backupblogshelp'] = 'Jos päällä, blogit sisällytetään sivuston automaattisiin varmuuskopiointeihin.';
$string['blockexternalstitle'] = 'Ulkoiset blogit';
$string['blocktitle'] = 'Blogitunnisteet-lohkon otsikko';
$string['blog'] = 'Blogi';
$string['blogaboutthis'] = 'Kirjoita tästä blogiin {$a->type}';
$string['blogaboutthiscourse'] = 'Kirjoita tästä kurssista blogiin';
$string['blogaboutthismodule'] = 'Kirjoita tästä moduulista {$a} blogiin';
$string['blogadministration'] = 'Blogin hallinta';
$string['blogdeleteconfirm'] = 'Poista tämä blogi?';
$string['blogdisable'] = 'Bloggaus on estetty!';
$string['blogentries'] = 'Merkintöjä';
$string['blogentriesabout'] = 'Blogikirjoitukset aiheesta {$a}';
$string['blogentriesbygroupaboutcourse'] = 'Ryhmän {$a->group} blogikirjoitukset kurssista {$a->course}';
$string['blogentriesbygroupaboutmodule'] = 'Ryhmän {$a->group} blogikirjoitukset moduulista {$a->mod}';
$string['blogentriesbyuseraboutcourse'] = 'Käyttäjän {$a->user} blogikirjoitukset kurssista {$a->course}';
$string['blogentriesbyuseraboutmodule'] = 'Käyttäjän {$a->user} blogikirjoitukset moduulista {$a->mod}';
$string['blogentrybyuser'] = 'Merkinnän kirjoittaja: {$a}';
$string['blogpreferences'] = 'Blogin asetukset';
$string['blogs'] = 'Blogit';
$string['blogscourse'] = 'Kurssin blogit';
$string['blogssite'] = 'Sivuston blogit';
$string['blogtags'] = 'Blogin asiasanat';
$string['cannotviewcourseblog'] = 'Sinulla ei ole vaadittavia oikeuksia tämän kurssin blogien katseluun';
$string['cannotviewcourseorgroupblog'] = 'Sinulla ei ole vaadittavia oikeuksia tämän kurssin/ryhmän blogien katseluun';
$string['cannotviewsiteblog'] = 'Sinulla ei ole vaadittavia oikeuksia kaikkien sivuston blogien katseluun';
$string['cannotviewuserblog'] = 'Sinulla ei ole vaadittavia oikeuksia käyttäjien blogien lukemiseen';
$string['configexternalblogcrontime'] = 'Kuinka usein Moodle tarkastaa ulkoiset blogit uusien kirjoitusten varalta.';
$string['configmaxexternalblogsperuser'] = 'Kuinka monta ulkoista blogia jokainen käyttäjä voi linkittää Moodleblogiinsa.';
$string['configuseblogassociations'] = 'Mahdollistaa blogikirjoitusten yhdistämisen kursseihin ja kurssimoduuleihin.';
$string['configuseexternalblogs'] = 'Antaa käyttäjien määrittää ulkoisia blogisyötteitä. Moodle tarkastaa nämä syötteet tasaisin väliajoin ja kopioi uudet kirjoitukset käyttäjän paikalliseen blogiin.';
$string['courseblog'] = 'Kurssiblogi: {$a}';
$string['courseblogdisable'] = 'Kurssiblogeja ei ole sallittu';
$string['courseblogs'] = 'Käyttäjät voivat nähdä vain kurssikavereidensa blogit';
$string['deleteblogassociations'] = 'Poista blogien yhdisteet';
$string['deleteblogassociations_help'] = 'Jos valittu, blogikirjoitukset eivät enää ole yhdistetty tähän kurssiin tai mihinkään kurssiaktiviteetteihin tai resursseihin. Itse blogikirjoituksia ei poisteta.';
$string['deleteexternalblog'] = 'Poista ulkoinen blogi';
$string['deleteotagswarn'] = 'Oletko varma, että haluat poistaa nämä asiasanat kaikista blogikirjoituksista ja koko järjestelmästä?';
$string['description'] = 'Kuvaus';
$string['description_help'] = 'Kirjoita lyhyt yhteenveto ulkoisen blogisi sisällöstä. (Jos et kirjoita mitään, käytetään ulkoisen blogisi kuvausta.)';
$string['disableblogs'] = 'Poista blogit kokonaan käytöstä';
$string['donothaveblog'] = 'Valitettavasti sinulla ei ole omaa blogia.';
$string['editentry'] = 'Muokkaa blogimerkintää';
$string['editexternalblog'] = 'Muokkaa ulkoista blogia';
$string['emptybody'] = 'Blogimerkinnän tekstiosa ei voi olla tyhjä';
$string['emptyrssfeed'] = 'Syöttämäsi web-osoite ei osoita kelvolliseen RSS-syötteeseen';
$string['emptytitle'] = 'Blogimerkinnän otsikko ei voi olla tyhjä';
$string['emptyurl'] = 'Sinun täytyy antaa web-osoite kelvolliseen RSS-syötteeseen';
$string['entrybody'] = 'Blogimerkinnän tekstiosa';
$string['entrybodyonlydesc'] = 'Blogimerkinnän kuvaus';
$string['entryerrornotyours'] = 'Tämä merkintä ei ole sinun';
$string['entrysaved'] = 'Merkintäsi on tallennettu';
$string['entrytitle'] = 'Merkinnän otsikko';
$string['entryupdated'] = 'Blogimerkintä päivitetty';
$string['externalblogcrontime'] = 'Ulkoisen blogin cron-aikataulu';
$string['externalblogdeleteconfirm'] = 'Posta tämä ulkoinen blogi?';
$string['externalblogdeleted'] = 'Ulkoinen blogi poistettu';
$string['externalblogs'] = 'Ulkoiset blogit';
$string['feedisinvalid'] = 'Tämä syöte on virheellinen';
$string['feedisvalid'] = 'Tämä syöte on kelvollinen';
$string['filterblogsby'] = 'Suodata blogit...';
$string['filtertags'] = 'Suodata tunnisteet';
$string['filtertags_help'] = 'Voit käyttää tätä toimintoa haluamiesi kirjoitusten suodattamiseen. Jos määrittelet tähän tunnisteita (erotettu pilkulla), niin ainoastaan näillä tunnisteilla merkityt kirjoitukset kopioidaan ulkoisesta blogista.';
$string['groupblog'] = 'Ryhmän blogi: {$a}';
$string['groupblogdisable'] = 'Ryhmäblogi ei ole käytössä';
$string['groupblogentries'] = 'Ryhmän {$a->groupname} blogikirjoitukset, jotka on yhdistetty kurssiin {$a->coursename}';
$string['groupblogs'] = 'Käyttäjät näkevät vain saman ryhmän blogit';
$string['incorrectblogfilter'] = 'Määritelty väärä blogisuotimen tyyppi';
$string['intro'] = 'Tämä RSS-syöte on automaattisesti muodostettu yhdestä tai useammasta blogista.';
$string['invalidgroupid'] = 'Virheellinen ryhmän ID';
$string['invalidurl'] = 'Web-osoitteeseen ei saatu yhteyttä';
$string['linktooriginalentry'] = 'Linkki alkuperäiseen blogikirjoitukseen';
$string['maxexternalblogsperuser'] = 'Ulkoisten blogien enimmäismäärä per käyttäjä';
$string['mustassociatecourse'] = 'Jos olet julkaisemassa kurssille tai ryhmän jäsenille, sinun täytyy yhdistää kurssi tämän kirjoituksen kanssa';
$string['name'] = 'Nimi';
$string['name_help'] = 'Anna kuvaava nimi ulkoiselle blogillesi. (Jos nimeä ei anneta, käytetään ulkoisen blogin nimeä.)';
$string['noentriesyet'] = 'Ei näkyviä merkintöjä';
$string['noguestpost'] = 'Vierailijat eivät voi kirjoittaa blogeihin.';
$string['nopermissionstodeleteentry'] = 'Sinulla ei ole oikeuksia poistaa tätä blogikirjoitusta';
$string['norighttodeletetag'] = 'Sinulla ei ole lupaa poistaa tätä asiasanaa - {$a}';
$string['nosuchentry'] = 'Blogikirjoitusta ei löytynyt';
$string['notallowedtoedit'] = 'Et voi muokata tätä merkintää';
$string['numberofentries'] = 'Merkintöjä: {$a}';
$string['numberoftags'] = 'Näytettävien asiasanojen määrä';
$string['page-blog-edit'] = 'Blogien muokkaussivut';
$string['page-blog-index'] = 'Blogien listaussivut';
$string['page-blog-x'] = 'Kaikki blogisivut';
$string['pagesize'] = 'Blogimerkintöjen määrä sivulla';
$string['permalink'] = 'Pysyväislinkki';
$string['personalblogs'] = 'Käyttäjät voivat nähdä vain oman bloginsa';
$string['preferences'] = 'Asetukset';
$string['publishto'] = 'Julkaise';
$string['publishto_help'] = 'Sinulla on kolme vaihtoehtoa:
* Sinä (luonnostila) - Vain sinä ja ylläpitäjät näkevät merkinnän
* Kirjautuneet käyttäjät - Kaikki Moodleen kirjautuneet voivat lukea merkinnän
* Koko maailma - Kaikki, mukaanlukien vierailijat, voivat lukea tämän merkinnän';
$string['publishtocourse'] = 'Yhteisten kurssien käyttäjät';
$string['publishtocourseassoc'] = 'Yhdistetyn kurssin jäsenet';
$string['publishtocourseassocparam'] = 'Kurssin {$a} jäsenet';
$string['publishtogroup'] = 'Yhteisen ryhmän käyttäjät';
$string['publishtogroupassoc'] = 'Ryhmäsi jäsenet yhdistetyllä kurssilla';
$string['publishtogroupassocparam'] = 'Ryhmäsi jäsenet kurssilla {$a}';
$string['publishtonoone'] = 'Itsellesi (keskeneräinen)';
$string['publishtosite'] = 'Kaikille tällä sivustolla';
$string['publishtoworld'] = 'Kaikille Internetin käyttäjille';
$string['readfirst'] = 'Lue tämä ensin';
$string['relatedblogentries'] = 'Liittyvät blogikirjoitukset';
$string['retrievedfrom'] = 'Haettu kohteesta';
$string['rssfeed'] = 'Blogin RSS-syöte';
$string['searchterm'] = 'Etsi: {$a}';
$string['settingsupdatederror'] = 'Blogin asetuksia ei voitu päivittää tapahtuneen virheen takia.';
$string['siteblog'] = 'Sivuston blogi: {$a}';
$string['siteblogdisable'] = 'Sivuston blogi ei ole käytössä';
$string['siteblogs'] = 'Kaikki käyttäjät näkevät kaikki blogimerkinnät';
$string['tagdatelastused'] = 'Päiväys, jolloin asiasanaa on viimeksi käytetty';
$string['tagparam'] = 'Asiasana: {$a}';
$string['tags'] = 'Asiasanat';
$string['tagsort'] = 'Asiasanojen lajitteluperuste';
$string['tagtext'] = 'Asiasanan teksti';
$string['timefetched'] = 'Viimeisen synkronoinnin ajankohta';
$string['timewithin'] = 'Näytä asiasanat, joita on käytetty näin monen päivän sisällä';
$string['updateentrywithid'] = 'Päivitä merkintää';
$string['url'] = 'Verkko-osoite';
$string['url_help'] = 'Anna ulkoisen blogisi uutissyötteen osoite.';
$string['useblogassociations'] = 'Salli blogien yhdisteet';
$string['useexternalblogs'] = 'Salli ulkoiset blogit';
$string['userblog'] = 'Käyttäjän blogi: {$a}';
$string['userblogentries'] = 'Käyttäjän {$a} blogikirjoitukset';
$string['valid'] = 'Kelvollinen';
$string['viewallblogentries'] = 'Tämän {$a}:n kaikki blogikirjoitukset';
$string['viewallmodentries'] = 'Näytä tämän {$a->type}:n kaikki blogikirjoitukset';
$string['viewallmyentries'] = 'Näytä kaikki omat blogikirjoitukseni';
$string['viewblogentries'] = 'Kirjoitukset tästä {$a->type}';
$string['viewblogsfor'] = 'Näytä kaikki merkinnät kohteelle...';
$string['viewcourseblogs'] = 'Näytä kaikki merkinnät tälle kurssille';
$string['viewentriesbyuseraboutcourse'] = 'Näytä kaikki käyttäjän {$a} merkinnät tästä kurssista';
$string['viewgroupblogs'] = 'Näytä merkinnät ryhmälle...';
$string['viewgroupentries'] = 'Ryhmämerkinnät';
$string['viewmodblogs'] = 'Merkinnät moduulille...';
$string['viewmodentries'] = 'Moduulimerkinnät';
$string['viewmyentries'] = 'Omat merkinnät';
$string['viewmyentriesaboutcourse'] = 'Näytä omat merkinnät tästä kurssista';
$string['viewmyentriesaboutmodule'] = 'Näytä omat merkinnät moduulista {$a}';
$string['viewsiteentries'] = 'Näytä kaikki merkinnät';
$string['viewuserentries'] = 'Näytä kaikki merkinnät käyttäjältä {$a}';
$string['worldblogs'] = 'Kuka tahansa voi lukea merkinnät, jotka ovat avoinna kaikille internet-käyttäjille';
$string['wrongpostid'] = 'Väärä blogikirjoituksen id';
