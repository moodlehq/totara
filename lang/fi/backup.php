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
 * Strings for component 'backup', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   backup
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['autoactivedescription'] = 'Valitse, tehdäänkö automatisoidut varmuuskopiot. Jos valitaan manuaalinen, automatisoidut kopiot ovat mahdollisia vain automatisoidut kopiot CLI-scriptin kautta. Tämä voidaan tehdä joko manuaalisesti komentorivillä tai cronin avulla.';
$string['autoactivedisabled'] = 'Pois käytöstä';
$string['autoactiveenabled'] = 'Käytössä';
$string['autoactivemanual'] = 'Manuaalinen';
$string['automatedbackupschedule'] = 'Ajoita';
$string['automatedbackupschedulehelp'] = 'Valitse päivät jolloin automaattinen varmuuskopiointi suoritetaan';
$string['automatedbackupsinactive'] = 'Ajoitetut varmuuskopiot eivät ole käytössä.';
$string['automatedbackupstatus'] = 'Ajoitetun varmuuskopioinnin tila';
$string['automatedsettings'] = 'Ajoitetun varmuuskopioinnin asetukset';
$string['automatedsetup'] = 'Ajoitetun varmuuskopioinnin asetustyö';
$string['automatedstorage'] = 'Ajoitetun varmuuskopioinnin tallentaminen';
$string['automatedstoragehelp'] = 'Valitse sijainti, johon haluat automaattisten varmuuskopioiden tallennettavan.';
$string['backupactivity'] = 'Varmuuskopioinnin aktiviteetti: {$a}';
$string['backupcourse'] = 'Varmuuskopioinnin kurssi: {$a}';
$string['backupcoursedetails'] = 'Kurssin tiedot';
$string['backupcoursesection'] = 'Osio: {$a}';
$string['backupcoursesections'] = 'Kurssin osiot';
$string['backupdate'] = 'Päivämäärä, jolloin tehty';
$string['backupdetails'] = 'Varmuuskopion tiedot';
$string['backupdetailsnonstandardinfo'] = 'Valittu tiedosto ei ole standardi Moodlen varmuuskopiotiedosto. Palautusprosessi yrittää muuttaa varmuuskopion standardiin muotoon ja sitten palauttaa sen.';
$string['backupformat'] = 'Formaatti';
$string['backupformatimscc1'] = 'IMS Common Cartridge 1.0';
$string['backupformatimscc11'] = 'IMS Common Cartridge 1.1';
$string['backupformatmoodle1'] = 'Moodle 1';
$string['backupformatmoodle2'] = 'Moodle 2';
$string['backupformatunknown'] = 'Tuntematon muoto';
$string['backupmode'] = 'Moodi';
$string['backupmode10'] = 'Yleinen';
$string['backupmode20'] = 'Tuo';
$string['backupmode30'] = 'Hubi';
$string['backupmode40'] = 'Sama sivusto';
$string['backupmode50'] = 'Automatisoitu';
$string['backupmode60'] = 'Muunnettu';
$string['backupsection'] = 'Varmuuskopioi kurssin osio: {$a}';
$string['backupsettings'] = 'Varmuuskopion asetukset';
$string['backupsitedetails'] = 'Sivuston tiedot';
$string['backupstage16action'] = 'Jatka';
$string['backupstage1action'] = 'Seuraava';
$string['backupstage2action'] = 'Seuraava';
$string['backupstage4action'] = 'Suorita varmuuskopiointi';
$string['backupstage8action'] = 'Jatka';
$string['backuptype'] = 'Tyyppi';
$string['backuptypeactivity'] = 'Aktiviteetti';
$string['backuptypecourse'] = 'Kurssi';
$string['backuptypesection'] = 'Osio';
$string['backupversion'] = 'Varmuuskopion versio';
$string['cannotfindassignablerole'] = 'Varmuuskopiotiedoston roolia {$a} ei voida yhdistää yhteenkään rooliin, jonka voit antaa.';
$string['choosefilefromactivitybackup'] = 'Aktiviteetin varmuuskopioalue';
$string['choosefilefromactivitybackup_help'] = 'Kun aktiviteetteja varmuuskopioidaan oletusarvoilla, varmuuskopiotiedostot tallennetaan tänne';
$string['choosefilefromautomatedbackup'] = 'Ajoitetut varmuuskopiot';
$string['choosefilefromautomatedbackup_help'] = 'Sisältää ajoitetut, automaattisesti luodut varmuuskopiot.';
$string['choosefilefromcoursebackup'] = 'Kurssin varmuuskopioalue';
$string['choosefilefromcoursebackup_help'] = 'Kun kursseja varmuuskopioidaan oletusarvoilla, varmuuskopiotiedostot tallennetaan tänne';
$string['choosefilefromuserbackup'] = 'Käyttäjän yksityinen varmuuskopioalue';
$string['choosefilefromuserbackup_help'] = 'Kun kursseja varmuuskopioidaan käyttäen valintaa "Poista käyttäjätiedot", varmuuskopiotiedostot tallennetaan tänne';
$string['configgeneralactivities'] = 'Aktiviteettien varmuuskopioon sisällyttämisen oletusasetus.';
$string['configgeneralanonymize'] = 'Jos sallittu, kaikki käyttäjiin liittyvä tieto poistetaan oletuksena.';
$string['configgeneralblocks'] = 'Lohkojen varmuuskopioon sisällyttämisen oletusasetus.';
$string['configgeneralcomments'] = 'Kommenttien varmuuskopioon sisällyttämisen oletusasetus.';
$string['configgeneralfilters'] = 'Suotimien varmuuskopioon sisällyttämisen oletusasetus.';
$string['configgeneralhistories'] = 'Käyttäjähistorian varmuuskopioon sisällyttämisen oletusasetus.';
$string['configgenerallogs'] = 'Jos sallittu, lokit sisällytetään oletuksena varmuuskopioihin.';
$string['configgeneralroleassignments'] = 'Jos sallittu, myös roolien jaot varmuuskopioidaan.';
$string['configgeneralusers'] = 'Käyttäjien varmuuskopioon sisällyttämisen oletusasetus.';
$string['configgeneraluserscompletion'] = 'Jos sallittu, tieto käyttäjän kurssisuorituksista sisällytetään oletuksena varmuuskopioihin.';
$string['confirmcancel'] = 'Peruuta varmuuskopiointi';
$string['confirmcancelno'] = 'Pysy tällä sivulla';
$string['confirmcancelquestion'] = 'Haluatko varmasti peruuttaa?
Kaikki syöttämäsi tieto häviää.';
$string['confirmcancelyes'] = 'Peruuta';
$string['confirmnewcoursecontinue'] = 'Uusi kurssivaroitus';
$string['confirmnewcoursecontinuequestion'] = 'Kurssin palautusprosessi luo väliaikaisen (piilotetun) kurssin. Peruuttaaksesi palautuksen klikkaa peruuta. Älä sulje selainta palautuksen aikana.';
$string['coursecategory'] = 'Kategoria, johon kurssi palautetaan';
$string['courseid'] = 'Alkuperäinen ID';
$string['coursesettings'] = 'Kurssin asetukset';
$string['coursetitle'] = 'Otsikko';
$string['currentstage1'] = 'Alkuperäisasetukset';
$string['currentstage16'] = 'Valmis';
$string['currentstage2'] = 'Skeeman asetukset';
$string['currentstage4'] = 'Varmistus ja katselu';
$string['currentstage8'] = 'Luo varmuuskopio';
$string['dependenciesenforced'] = 'Asetuksiasi on muutettu täyttämättömien riippuvuuksien takia';
$string['enterasearch'] = 'Syötä haku';
$string['error_course_module_not_found'] = 'Orpo kurssimoduuli (id: {$a}) havaittu. Tätä moduulia ei varmuuskopioida.';
$string['errorfilenamemustbezip'] = 'Antamasi tiedostonimi täytyy olla ZIP-tiedosto, jossa on .mbz tiedostopääte';
$string['errorfilenamerequired'] = 'Sinun täytyy antaa kelvollinen tiedostonimi tälle varmuuskopiolle';
$string['errorinvalidformat'] = 'Tuntematon varmuuskopion muoto';
$string['errorinvalidformatinfo'] = 'Valittu tiedosto ei ole kelvollinen Moodlen varmuuskopiotiedosto, eikä sitä voida palauttaa.';
$string['errorminbackup20version'] = 'Tämä varmuuskopiotiedosto on luotu jollakin Moodlen varmuuskopioinnin kehitysversiolla ({$a->backup}). Vähimmäisvaatimus on {$a->min}. Ei voida palauttaa.';
$string['errorrestorefrontpage'] = 'Etusivun päälle palauttaminen ei ole sallittua.';
$string['executionsuccess'] = 'Varmuuskopio luotiin onnistuneesti.';
$string['filename'] = 'Tiedostonimi';
$string['generalactivities'] = 'Sisällytä aktiviteetit';
$string['generalanonymize'] = 'Poista käyttäjätiedot';
$string['generalbackdefaults'] = 'Yleiset varmuuskopioinnin oletustiedot';
$string['generalblocks'] = 'Sisällytä lohkot';
$string['generalcomments'] = 'Sisällytä kommentit';
$string['generalfilters'] = 'Sisällytä suodattimet';
$string['generalgradehistories'] = 'Sisällytä historiat';
$string['generalhistories'] = 'Sisällytä historiat';
$string['generallogs'] = 'Sisällytä lokit';
$string['generalroleassignments'] = 'Sisällytä roolit';
$string['generalsettings'] = 'Yleiset varmuuskopioinnin asetukset';
$string['generalusers'] = 'Sisällytä käyttäjät';
$string['generaluserscompletion'] = 'Sisällytä käyttäjän kurssisuoritustieto';
$string['importbackupstage16action'] = 'Jatka';
$string['importbackupstage1action'] = 'Seuraava';
$string['importbackupstage2action'] = 'Seuraava';
$string['importbackupstage4action'] = 'Suorita tuonti';
$string['importbackupstage8action'] = 'Jatka';
$string['importcurrentstage0'] = 'Kurssin valinta';
$string['importcurrentstage1'] = 'Alkuperäisasetukset';
$string['importcurrentstage16'] = 'Valmis';
$string['importcurrentstage2'] = 'Skeeman asetukset';
$string['importcurrentstage4'] = 'Varmistus ja katselu';
$string['importcurrentstage8'] = 'Suorita tuonti';
$string['importfile'] = 'Tuo varmuuskopiotiedosto';
$string['importsuccess'] = 'Tuonti suoritettu. Klikkaa jatka palataksesi kurssille.';
$string['includeactivities'] = 'Sisällytä:';
$string['includeditems'] = 'Sisällytetyt kohteet:';
$string['includesection'] = 'Osio {$a}';
$string['includeuserinfo'] = 'Käyttäjädata';
$string['locked'] = 'Lukittu';
$string['lockedbyconfig'] = 'Tämä asetus on lukittu varmuuskopion oletusasetuksista';
$string['lockedbyhierarchy'] = 'Riippuvuuksien lukitsema';
$string['lockedbypermission'] = 'Sinulla ei ole riittäviä oikeuksia tämän asetuksen muuttamiseen';
$string['loglifetime'] = 'Säilytä lokeja';
$string['managefiles'] = 'Hallitse varmuuskopiotiedostoja';
$string['moodleversion'] = 'Moodlen versio';
$string['moreresults'] = 'Liikaa tuloksia, anna yksityiskohtaisempi haku.';
$string['nomatchingcourses'] = 'Ei näytettäviä kursseja';
$string['norestoreoptions'] = 'Ei ole kategorioita tai olemassaolevia kursseja joille voisit palauttaa.';
$string['originalwwwroot'] = 'Varmuuskopion web-osoite';
$string['previousstage'] = 'Edellinen';
$string['qcategory2coursefallback'] = 'Kysymyskategoria "{$a->name}", alunperin järjestelmä/kurssikategoria -kontekstissa varmuuskopiotiedostossa, luodaan palautuksen toimesta kurssikontekstiin';
$string['qcategorycannotberestored'] = 'Palautus ei voi luoda kysymyskategoriaa "{$a->name}"';
$string['question2coursefallback'] = 'Kysymyskategoria "{$a->name}", alunperin järjestelmä/kurssikategoria -kontekstissa varmuuskopiotiedostossa, luodaan palautuksen toimesta kurssikontekstiin';
$string['questionegorycannotberestored'] = 'Palautus ei voi luoda kysymyksiä "{$a->name}"';
$string['restoreactivity'] = 'Palauta aktiivisuus';
$string['restorecourse'] = 'Palauta kurssi';
$string['restorecoursesettings'] = 'Kurssin asetukset';
$string['restoreexecutionsuccess'] = 'Kurssi palautettiin onnistuneesti. Klikkaamalla "Jatka"-nappia pääset katsomaan palautettua kurssia.';
$string['restorenewcoursefullname'] = 'Uusi kurssin nimi';
$string['restorenewcourseshortname'] = 'Uusi kurssin lyhenne';
$string['restorenewcoursestartdate'] = 'Uusi aloituspäivä';
$string['restorerolemappings'] = 'Palauta roolien linkitykset';
$string['restorerootsettings'] = 'Palauta asetukset';
$string['restoresection'] = 'Palauta osio';
$string['restorestage1'] = 'Vahvista';
$string['restorestage16'] = 'Esikatsele';
$string['restorestage16action'] = 'Suorita palautus';
$string['restorestage1action'] = 'Seuraava';
$string['restorestage2'] = 'Kohde';
$string['restorestage2action'] = 'Seuraava';
$string['restorestage32'] = 'Prosessi';
$string['restorestage32action'] = 'Jatka';
$string['restorestage4'] = 'Asetukset';
$string['restorestage4action'] = 'Seuraava';
$string['restorestage64'] = 'Valmis';
$string['restorestage64action'] = 'Jatka';
$string['restorestage8'] = 'Skeema';
$string['restorestage8action'] = 'Seuraava';
$string['restoretarget'] = 'Palauta kohde';
$string['restoretocourse'] = 'Palauta kurssiin:';
$string['restoretocurrentcourse'] = 'Palauta tälle kurssille';
$string['restoretocurrentcourseadding'] = 'Yhdistä varmuuskopioitu kurssi tähän kurssiin';
$string['restoretocurrentcoursedeleting'] = 'Poista tämän kurssin sisältö ja palauta';
$string['restoretoexistingcourse'] = 'Palauta olemassaolevaan kurssiin';
$string['restoretoexistingcourseadding'] = 'Yhdistä varmuuskopioitu kurssi olemassaolevaan kurssiin';
$string['restoretoexistingcoursedeleting'] = 'Poista olemassaolevan kurssin sisältö ja palauta';
$string['restoretonewcourse'] = 'Palauta uutena kurssina';
$string['restoringcourse'] = 'Kurssin palautus käynnissä';
$string['restoringcourseshortname'] = 'palautetaan';
$string['rootsettingactivities'] = 'Sisällytä aktiviteetit';
$string['rootsettinganonymize'] = 'Poista käyttäjätiedot';
$string['rootsettingblocks'] = 'Sisällytä lohkot';
$string['rootsettingcalendarevents'] = 'Sisällytä kalenterin tapahtumat';
$string['rootsettingcomments'] = 'Sisällytä kommentit';
$string['rootsettingfilters'] = 'Sisällytä suodattimet';
$string['rootsettinggradehistories'] = 'Sisällytä arvosanahistoria';
$string['rootsettingimscc1'] = 'Muunna muotoon IMS Common Cartridge 1.0';
$string['rootsettingimscc11'] = 'Muunna muotoon IMS Common Cartridge 1.1';
$string['rootsettinglogs'] = 'Sisällytä kurssin lokit';
$string['rootsettingroleassignments'] = 'Sisällytä roolit';
$string['rootsettings'] = 'Varmuuskopion asetukset';
$string['rootsettingusers'] = 'Sisällytä osallistujat';
$string['rootsettinguserscompletion'] = 'Sisällytä käyttäjien kurssisuoritusten yksityiskohdat';
$string['sectionactivities'] = 'Aktiviteetit';
$string['sectioninc'] = 'Sisällytetty varmuuskopioon (ei käyttäjätietoja)';
$string['sectionincanduser'] = 'Sisällytetty varmuuskopioon käyttäjätietojen lisäksi';
$string['selectacategory'] = 'Valitse kategoria';
$string['selectacourse'] = 'Valitse kurssi';
$string['setting_course_fullname'] = 'Kurssin nimi';
$string['setting_course_shortname'] = 'Kurssin lyhenne';
$string['setting_course_startdate'] = 'Kurssin aloituspäivä';
$string['setting_keep_groups_and_groupings'] = 'Säilytä nykyiset ryhmät ja ryhmittelyt';
$string['setting_keep_roles_and_enrolments'] = 'Pidä nykyiset roolit ja kursseille kirjautumiset';
$string['setting_overwriteconf'] = 'Päällekirjoita kurssin asetukset';
$string['storagecourseandexternal'] = 'Kurssin varmuuskopion tiedostoalue ja määritetty hakemisto';
$string['storagecourseonly'] = 'Kurssin varmuuskopion tiedostoalue';
$string['storageexternalonly'] = 'Määritetty hakemisto ajoitetuille varmuuskopioille';
$string['totalcategorysearchresults'] = 'Kategorioita yhteensä: {$a}';
$string['totalcoursesearchresults'] = 'Kursseja yhteensä: {$a}';
