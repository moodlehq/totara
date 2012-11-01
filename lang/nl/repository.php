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
 * Strings for component 'repository', language 'nl', branch 'MOODLE_22_STABLE'
 *
 * @package   repository
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessiblefilepicker'] = 'Toegankelijke bestandskiezer';
$string['activaterep'] = 'Actieve opslagruimten';
$string['activerepository'] = 'Actieve plugins voor opslagruimte';
$string['activitybackup'] = 'Activiteitsbackup';
$string['add'] = 'Voeg toe';
$string['addfile'] = 'Voeg toe...';
$string['addplugin'] = 'Voeg een plugin voor opslagruimte toe';
$string['allowexternallinks'] = 'Externe links toestaan';
$string['areacategoryintro'] = 'Categorie introductie';
$string['areacourseintro'] = 'Cursus introductie';
$string['areamainfile'] = 'Hoofdbestand';
$string['arearoot'] = 'Systeem';
$string['areauserbackup'] = 'Gebruikersbackup';
$string['areauserdraft'] = 'Kladwerk';
$string['areauserpersonal'] = 'Persoonlijke bestanden';
$string['areauserprofile'] = 'Profiel';
$string['attachedfiles'] = 'Bijlagen';
$string['attachment'] = 'Bijlage';
$string['author'] = 'Auteur';
$string['automatedbackup'] = 'Automatische backups';
$string['back'] = '&laquo; Terug';
$string['backtodraftfiles'] = '&laquo; Terug naar beheer kladbestanden';
$string['cachecleared'] = 'Cache-bestanden zijn verwijderd';
$string['cacheexpire'] = 'Cache verloopt';
$string['cannotaccessparentwin'] = 'Als het vorige venster via HTTPS geopend is, krijgen we er geen toegang toe via het window.opener object, dus we kunnen de opslagruimte voor jou niet automatisch verversen. We hebben je sessie al, dus ga terug naar de bestandskiezer en selecteer de opslagruimte opnieuw. Het zou dan moeten werken.';
$string['cannotdelete'] = 'Kan dit bestand niet verwijderen';
$string['cannotdownload'] = 'Kan dit bestand niet downloaden';
$string['cannotdownloaddir'] = 'Kan deze map niet downloaden';
$string['cannotinitplugin'] = 'Call plugin_init mislukt';
$string['choosealink'] = 'Kies een link...';
$string['chooselicense'] = 'Kies een licentie';
$string['cleancache'] = 'Verwijder cache-bestanden';
$string['close'] = 'Sluit';
$string['commonrepositorysettings'] = 'Algemene instellingen voor opslagruimte';
$string['configallowexternallinks'] = 'Met deze optie bepaal je of gebruikers het recht hebben om te kiezen of externe media naar Moodle gekopieerd wordt of niet. Als dit is uitgeschakeld, dan wordt externe media altijd naar Moodle gekopieerd (dit is gewoonlijk de beste optie voor algemene gegevensintegriteit en veiligheid). Als deze optie is ingeschakeld, dan kunnen gebruikers telkens kiezen als ze media bij een tekst voegen.';
$string['configcacheexpire'] = 'Hoelang dat bestandslijsten lokaal in cache gehouden worden (tijd in seconden) wanneer je in externe opslagruimten bladert.';
$string['configsaved'] = 'Instellingen bewaard!';
$string['confirmdelete'] = 'Weet je zeker dat je deze opslagruimte wil verwijderen - {$a}?';
$string['confirmdeletefile'] = 'Wil je dit bestand echt verwijderen?';
$string['confirmremove'] = 'Wil je deze plugin voor opslagruimte, de opties en <strong>alle verwijzingen</strong> verwijderen - {$a}?';
$string['copying'] = 'Kopiëren';
$string['coursebackup'] = 'Cursusbackups';
$string['create'] = 'Maak';
$string['createfolderfail'] = 'Map maken mislukt';
$string['createfoldersuccess'] = 'Map maken gelukt';
$string['createinstance'] = 'Maak een verwijzing naar een opslagruimte';
$string['createrepository'] = 'Maak een opslagruimte';
$string['createxxinstance'] = 'Maak "{$a}"';
$string['date'] = 'Datum';
$string['deleted'] = 'Opslagruimte verwijderd';
$string['deleterepository'] = 'Verwijder deze opslagruimte';
$string['disabled'] = 'Uitgeschakeld';
$string['download'] = 'Download';
$string['downloadfolder'] = 'Download alles';
$string['downloadsucc'] = 'Download gelukt';
$string['draftareanofiles'] = 'Kan niet gedownload worden wan er zijn geen bestanden aan verbonden';
$string['editrepositoryinstance'] = 'Bewerk een verwijzing naar een opslagruimte';
$string['emptylist'] = 'Lege lijst';
$string['emptytype'] = 'Kan dit type opslagruimte niet maken: het type is leeg';
$string['enablecourseinstances'] = 'Geef gebruikers het recht een opslagruimte toe te voegen aan de cursus';
$string['enableuserinstances'] = 'Geef gebruikers het recht een opslagruimte toe te voegen in de gebruikerscontext';
$string['enter'] = 'Ga binnen';
$string['entername'] = 'Geef een mapnaam';
$string['enternewname'] = 'Geef de nieuwe bestandsnaam';
$string['error'] = 'Onbekende fout!';
$string['errornotyourfile'] = 'Je kan geen bestand kiezen dat niet is toegevoegd door jou';
$string['errorpostmaxsize'] = 'Het geüploade bestand kan groter zijn dan de post_max_size instelling in php.ini.';
$string['erroruniquename'] = 'De naam van de opslagruimte moet uniek zijn';
$string['existingrepository'] = 'Deze opslagruimte bestaat al';
$string['federatedsearch'] = 'Federated search';
$string['fileexists'] = 'De bestandsnaam is al in gebruik, gebruik een andere';
$string['fileexistsdialog_editor'] = 'Een bestand met die naam is al gebruikt al bijlage bij de tekst die je aan het bewerken bent.';
$string['fileexistsdialog_filemanager'] = 'Een bestand met die naam is al als bijlage toegevoegd';
$string['fileexistsdialogheader'] = 'Bestand bestaat al';
$string['filename'] = 'Bestandsnaam';
$string['filenotnull'] = 'Je moet een bestand kiezen om te uploaden.';
$string['filepicker'] = 'Bestandenzoeker';
$string['filesaved'] = 'Bestand bewaard';
$string['filesizenull'] = 'De bestandsgrootte kan niet worden bepaald';
$string['getfile'] = 'Selecteer dit bestand';
$string['hidden'] = 'Verborgen';
$string['iconview'] = 'Bekijk als icoontjes';
$string['instance'] = 'verwijzing';
$string['instancedeleted'] = 'Verwijzing verwijderd';
$string['instances'] = 'Verwijzingen naar opslagruimte';
$string['instancesforcourses'] = '{$a} cursusbrede gemeenschappelijke instanties';
$string['instancesforsite'] = '{$a} site-brede gemeenschappelijke instanties';
$string['instancesforusers'] = '{$a}  Gebruikers private instanties';
$string['invalidfiletype'] = '{$a} bestandstype wordt niet aanvaard';
$string['invalidjson'] = 'Ongeldige JSON-string';
$string['invalidplugin'] = 'Ongeldige opslagruimte-plugin {$a}';
$string['invalidrepositoryid'] = 'Ongeldig opslagruimte-ID';
$string['isactive'] = 'Actief?';
$string['keyword'] = 'Sleutelwoord';
$string['linkexternal'] = 'Link extern';
$string['listview'] = 'Bekijk als lijst';
$string['loading'] = 'Laden...';
$string['login'] = 'Login';
$string['logout'] = 'Uitloggen';
$string['manage'] = 'Beheer opslagruimten';
$string['manageurl'] = 'Beheer';
$string['manageuserrepository'] = 'Beheer individuele opslagruimten';
$string['moving'] = 'Verplaatsen';
$string['noenter'] = 'Niets ingevoerd';
$string['nofilesattached'] = 'Geen bijlage';
$string['nofilesavailable'] = 'Geen bestanden beschikbaar';
$string['nomorefiles'] = 'Geen bijlages meer toegelaten';
$string['nopathselected'] = 'Nog geen bestemming gekozen - dubbelklik op de naam van een map om de bestemming kiezen';
$string['nopermissiontoaccess'] = 'Geen recht op toegang tot deze opslagruimte';
$string['norepositoriesavailable'] = 'Geen enkele van je huidige opslagruimten kan bestanden weergeven in het vereiste formaat.';
$string['norepositoriesexternalavailable'] = 'Geen enkele van je huidige opslagruimten kan externe bestanden weergeven.';
$string['noresult'] = 'Geen zoekresultaat';
$string['notyourinstances'] = 'Je kunt de opslagruimte van een andere gebruiker niet bekijken/bewerken';
$string['off'] = 'Ingeschakeld maar verborgen';
$string['on'] = 'Ingeschakeld en zichtbaar';
$string['openpicker'] = 'Kies een bestand...';
$string['operation'] = 'Bewerking';
$string['overwrite'] = 'Overschrijven';
$string['personalrepositories'] = 'Beschikbare opslagruimten';
$string['plugin'] = 'Plugins opslagruimten';
$string['pluginerror'] = 'Fouten in de opslagruimten-plugin';
$string['pluginname'] = 'Opslagruimte plugin naam';
$string['pluginnamehelp'] = 'Als je dit leeg laat, zal de standaardnaam gebruikt worden';
$string['popup'] = 'Klik op de "Log in"-knop om in te loggen';
$string['popupblockeddownload'] = 'Het downloadvenster is geblokkeerd. Sta pop-ups toe en probeer opnieuw';
$string['preview'] = 'Voorbeeld';
$string['readonlyinstance'] = 'Je kunt een enkel lezen-verwijzing niet bewerken/verwijderen';
$string['refresh'] = 'Vernieuw';
$string['refreshnonjsfilepicker'] = 'Sluit dit venster en ververs de bestandenkiezer zonder Javascript';
$string['removed'] = 'Opslagruimte verwijderd';
$string['renameto'] = 'Hernoem naar';
$string['repositories'] = 'Opslagruimten';
$string['repository'] = 'Opslagruimte';
$string['repositorycourse'] = 'Cursusopslagruimten';
$string['repositoryerror'] = 'Externe opslagruimte gaf een fout: {$a}';
$string['save'] = 'Bewaar';
$string['saveas'] = 'Bewaar als';
$string['saved'] = 'Bewaard';
$string['saving'] = 'Bewaren';
$string['search'] = 'Zoek';
$string['searching'] = 'Zoek in';
$string['sectionbackup'] = 'Sectie backups';
$string['select'] = 'Selecteer';
$string['setmainfile'] = 'Zet als hoofdbestand';
$string['settings'] = 'Instellingen';
$string['setupdefaultplugins'] = 'Instellen van de standaard opslagruimten';
$string['siteinstances'] = 'Verwijzingen naar opslagruimten van de site';
$string['size'] = 'Grootte';
$string['submit'] = 'Verstuur';
$string['sync'] = 'Synchroniseer';
$string['thumbview'] = 'Bekijk als icoontjes';
$string['title'] = 'Kies een bestand';
$string['typenotvisible'] = 'Type niet zichtbaar';
$string['unzipped'] = 'Uitpakken gelukt';
$string['upload'] = 'Upload dit bestand';
$string['uploading'] = 'Uploaden...';
$string['uploadsucc'] = 'Het bestand is met succes geüpload';
$string['usenonjsfilemanager'] = 'Open bestandsbeheer in een nieuw venster';
$string['usenonjsfilepicker'] = 'Open bestandenzoeker in een nieuw venster';
$string['usercontextrepositorydisabled'] = 'Je kunt deze opslagruimte niet bewerken in gebruikerscontext';
$string['wrongcontext'] = 'Je hebt geen toegang tot deze context';
$string['xhtmlerror'] = 'Je gebruikt waarschijnlijk de XHTML strict header. Sommige YUI componenten werken niet in deze modus. Schakel het uit in Moodle';
$string['ziped'] = 'Map met succes gecomprimeerd';
