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
 * Strings for component 'tool_uploaduser', language 'nl', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_uploaduser
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowdeletes'] = 'Verwijderen toestaan';
$string['allowrenames'] = 'Gebruikersnamen bijwerken toestaan';
$string['allowsuspends'] = 'Sta het schorsen en activeren van accounts toe';
$string['csvdelimiter'] = 'Scheidingsteken voor CSV';
$string['defaultvalues'] = 'Standaardwaarden';
$string['deleteerrors'] = 'Verwijder fouten';
$string['encoding'] = 'Codering';
$string['errors'] = 'Fouten';
$string['nochanges'] = 'Geen wijzigingen';
$string['pluginname'] = 'Gebruiker upload';
$string['renameerrors'] = 'Fouten in hernoemen';
$string['requiredtemplate'] = 'Vereist. Je kunt hier sjabloonsyntax gebruiken (%l = achternaam, %f = voornaam, %u = gebruikersnaam). Bekijk het helpbestand voor details en voorbeelden.';
$string['rowpreviewnum'] = 'Voorbeeld rijen';
$string['uploadpicture_baduserfield'] = 'Het gespecificeerde gebruikersattribuut is niet geldig. Probeer opnieuw.';
$string['uploadpicture_cannotmovezip'] = 'Kan zip-bestand niet naar tijdelijke map verplaatsten.';
$string['uploadpicture_cannotprocessdir'] = 'Kan uitgepakte bestanden niet verwerken';
$string['uploadpicture_cannotsave'] = 'Kan afbeelding voor gebruiker {$a} niet bewaren. Controleer het originele afbeeldingsbestand.';
$string['uploadpicture_cannotunzip'] = 'Kan fotobestanden niet uitpakken';
$string['uploadpicture_invalidfilename'] = 'Afbeeldingsbestand {$a} heeft ongeldige tekens in de naam. Overgeslagen.';
$string['uploadpicture_overwrite'] = 'Bestaande gebruikersfoto\'s overschrijven?';
$string['uploadpicture_userfield'] = 'Gebruikersattribuut waaraan foto\'s gekoppeld worden:';
$string['uploadpicture_usernotfound'] = 'De gebruiker met \'{$a->userfield}\' met de waarde \'{$a->uservalue}\' bestaat niet. Overgeslagen.';
$string['uploadpicture_userskipped'] = 'Gebruiker {$a} overgeslagen (heeft al een afbeelding)';
$string['uploadpicture_userupdated'] = 'Foto geüpdatet voor gebruiker {$a}';
$string['uploadpictures'] = 'Upload gebruikersfoto\'s';
$string['uploadpictures_help'] = 'Gebruikersfoto\'s kunnen als zip-bestand of afbeeldingsbestand geüpload worden. De bestanden moeten als naam \*gekozen-gebruikersattribuut.extentie\* hebben. Bijvoorbeeld, als het gekozen gebruikersattribuut voor het koppelen van de afbeeldingen de gebruikersnaam is en de gebruikersnaam is user1234, dan moet de bestandsnaam user1234.jpg zijn.
Ondersteunde afbeeldingsformaten zijn gif, jpg, en png.
Afbeeldingsbestandsnamen zijn niet hoofdlettergevoelig.';
$string['uploadusers'] = 'Uploaden';
$string['uploadusers_help'] = 'Eerst deze opmerking: **Het is gewoonlijk niet nodig om gebruikers in bulk te importeren** - om je onderhoudstaken te beperken, kun je beter eerst manieren verkennen die geen manueel onderhoud vragen, zoals connectie met externe databanken of gebruikers zelf accounts laten aanmaken. Meer over dit onderwerp in het authenticatiedeel van de beheermenu\'s.
Als je echt een reeks gebruikers wil importeren vanuit een tekstbestand, dan moeten je tekstbestanden als volgt opgemaakt worden:

* Elke lijn van het bestand moet één record bevatten
* Elke record is een datareeks, gescheiden door komma\'s (of andere scheidingstekens)
* Het eerste record van het bestand is speciaal: het bevat de lijst met veldnamen. Dit bepaalt de opmaak van de rest van het bestand.
>
>
> **Vereiste veldnamen:** deze velden moeten in de eerste record staan en voor elke gebruiker bepaald zijn
>
>
> \`firstname, lastname,\` wanneer ingevoegd wordt of \`username\` wanneer bestaande accounts aangepast worden
>
>
>
> **Optionele veldnamen:** deze zijn optioneel - als er voor een veld geen waarde is, wordt de standaardwaarde gebruikt
>
>
>
> \`institution, department, city, country, lang, auth, ajax, timezone, idnumber, icq, phone1, phone2, address, url, description, mailformat, maildisplay, htmleditor, autosubscribe, emailstop\`
>
>
>
> **Aangepaste veldnamen in het profiel:** optioneel, xxxxx is de echte aangepaste profiel veldnaam (de unieke korte naam)
>
>
> \`profile\_field\_xxxxx\`
>
>
> **Speciale veldnamen:** gebruikt voor het wijzigen van gebruikersnamen en voor het verwijderen van gebruikers, zie verder
>
>
> \`deleted, oldusername\`
>
>
> **Aanmeldingsveldnamen (optioneel):** De cursusnamen zijn de "verkorte namen" van de cursussen. Indien opgegeven zal de gebruiker aangemeld worden in de cursus. "Type" betekent de rol die de gebruiker zal krijgen in die cursus na zijn aanmelding.
> Waarde 1 is de standaard cursus rol, 2 is de standaard leraar rol en 3 is de standaard leraar zonder bewerken rol. Je kunt ook het role-veld gebruiken om een rol rechtstreeks te specifiëren. Gebruik ofwel de verkorte rolnaam of id (numerieke namen van rollen worden niet ondersteund. Gebruikers kunnen ook aan groepen toegewezen worden (group1 in course1, group2 in course2, etc.). Ook groepen worden geïdentifieerd door namen (numerieke namen worden niet ondersteund).
>
>
> \`course1, group1, type1, role1, course2, group2, type2, role2, etc\`
>
>
>
* Komma\'s in de gegevens mag je als &#44 noteren. Het script zal automatisch de komma juist terugplaatsen.
* Voor Boolse velden gebruik je 0 voor onwaar en 1 voor waar.
* Opmerking: Als een gebruiker al in de databank geregistreerd is, dan zal dit script het userID teruggeven (de databankindex)en deze leerling als leerling aanmelden in de gespecifieerde cursus ZONDER de andere gespecifieerde data te wijzigen.

Hier krijg je een voorbeeld van een geldig bestand om te importeren:
`username, password, firstname, lastname, email, lang, idnumber, maildisplay, course1, group1, type1
jonest, verysecret, Tom, Jones, jonest@someplace.edu, en, 3663737, 1, Intro101, Section 1, 1
reznort, somesecret, Trent, Reznor, reznort@someplace.edu, en_us, 6736733, 0, Advanced202, Section 3, 3`
## Sjablonen
De standaardwaarden worden verwerkt als sjablonen waarin volgende codes toegelaten zijn:
* \`%l\` - zal vervangen worden door de achternaam
* \`%f\` - zal vervangen worden door de voornaam
* \`%u\` - zal vervangen worden door de gebruikersnaam
* \`%%\` - zal vervangen worden door de %

Tussen het procent-teken (%) en de andere codeletters (l, f of u) zijn volgende operatoren toegelaten:
* min-teken (-) - de informatie, gespecifieerd door de codeletter zal omgezet worden naar kleine letters
* plus teken (+) - de informatie, gespecifieerd door de codeletter zal omgezet worden naar hoofdletters
* een decimaal getal - de informatie, gespecifieerd door de codeletter zal afgekort worden naar dat aantal tekens
Bijvoorbeeld: als de voornaam John is en de achternaam is Doe, dat zullen volgende waarden verkregen worden met de verschillende sjablonen:
* %l%f = DoeJohn
* %l%1f = DoeJ
* %-l%+f = doeJOHN
* %-f\_%-l = john\_doe
* http://www.example.com/~%u/ = http://www.example.com/~jdoe/ (if the username is jdoe or %-1f%-l)
Het verwerken van sjablonen wordt alleen voor de standaardwaarden gedaan en niet voor de waarden die uit het CSV-bestand gehaald worden.
Om juiste Moodle gebruikersnamen te maken wordt de gebruikersnaam altijd naar kleine letters geconverteerd. Meer nog, als de "Uitgebreide tekenset in gebruikersnamen toestaan" optie op de site-reglementpagina is uitgeschakeld, dan zullen alle tekens die geen letters zijn, zoals cijfers, liggend streepje (-), en punt (.) verwijderd worden.
Als de voornaam bijvoorbeeld John Jr. is en de achternaam Doe, dan zal username %-f\_%-l john jr.\_doe produceren wanneer Uitgebreide tekenset in gebruikersnamen toestaan ingeschakeld is, en johnjr_doe wanneer uitgeschakeld.
Wanneer "Afhandeling van dubbele nieuwe gebruikersnamen" is ingesteld op Teller toevoegen, dan zal een opklimmend cijfer toegevoegd worden bij dubbele gebruikersnamen die het sjabloon produceerd.
Bijvoorbeeld, als het CSV-bestand de gebruikers John Doe, Jane Doe and Jenny Doe bevat zonder gebruikersnamen, de standaard gebruikersnaam is ingesteld als %-1f%-l en de Afhandeling van dubbele nieuwe gebruikersnamen is ingesteld op teller toevoegen, dan zullen de geproduceerde gebruikersnamen jdoe, jdoe2 en jdoe3 zijn.

Standaard veronderstelt Moodle dat je nieuwe gebruikersaccounts wil aanmaken en zal records waarvan de gebruikersnaam overeenkomt met een bestaande account overslaan. Je kunt echter door de instelling "Update bestaande accounts" op **Ja** zet, dan zal de bestaande gebruikersaccount aangepast worden.
Bij het updaten van bestaande accounts, kun je gebruikersnamen ook aanpassen. Zet de instelling "Gebruikersnamen bijwerken toestaan" op **Ja** en geef in je bestand een veld me met als veldnaam \`oldusername\`.
**Opgelet:** fouten tijdens het updaten van bestaande gebruikersaccounts, kan de gegevens van die accounts behoorlijk beschadigen. Wees voorzichtig met de updatefunctie.
## Accounts verwijderen
Als het veld \`deleted\` toegevoegd wordt, zullen gebruikers die daar een waarde 1 opgegeven kregen verwijderd worden. Hiervoor mag je alle velden weglaten, behalve het veld \`username\` (dat in het CSV bestand moet zitten of je moet er een standaardwaarde voor opgeven.
Verwijderen en uploaden van accounts kan met een enkel CSV-bestand gedaan worden. Onderstaand bestand zal bijvoorbeeld de gebruiker Tom Jones toevoegen en de gebruiker reznort verwijderen:
`username, firstname, lastname, deleted
jonest, Tom, Jones, 0
reznort, , , 1
`';
$string['uploaduserspreview'] = 'Voorbeeld uploaden gebruikers';
$string['uploadusersresult'] = 'Resultaat uploaden gebruikers';
$string['useraccountupdated'] = 'Gebruiker geüpdatet';
$string['useraccountuptodate'] = 'Gebruiker up-to-date';
$string['userdeleted'] = 'Gebruiker verwijderd';
$string['userrenamed'] = 'Gebruiker hernoemd';
$string['userscreated'] = 'Gebruikers gecreëerd';
$string['usersdeleted'] = 'Gebruikers verwijderd';
$string['usersrenamed'] = 'Gebruikers hernoemd';
$string['usersskipped'] = 'Gebruikers overgeslagen';
$string['usersupdated'] = 'Gebruikers geüpdatet';
$string['usersweakpassword'] = 'Gebruikers met een zwak wachtwoord';
$string['uubulk'] = 'Selecteer voor bulkoperaties';
$string['uubulkall'] = 'Alle gebruikers';
$string['uubulknew'] = 'Nieuwe gebruikers';
$string['uubulkupdated'] = 'geüpdate gebruikers';
$string['uucsvline'] = 'CSV-lijn';
$string['uulegacy1role'] = '(Oorspronkelijk leerling) typeN=1';
$string['uulegacy2role'] = '(Oorspronkelijk leraar) typeN=2';
$string['uulegacy3role'] = '(Oorspronkelijk leraar zonder bewerken) typeN=3';
$string['uunoemailduplicates'] = 'Voorkom duplicaten van e-mailadressen';
$string['uuoptype'] = 'Uploadtype';
$string['uuoptype_addinc'] = 'Allen toevoegen, zet een teller achter de gebruikersnaam indien nodig';
$string['uuoptype_addnew'] = 'Enkel nieuwe gebruikers toevoegen, bestaande overslaan';
$string['uuoptype_addupdate'] = 'Nieuwe gebruikers toevoegen en bestaande updaten';
$string['uuoptype_update'] = 'Enkel bestaande gebruikers updaten';
$string['uupasswordcron'] = 'Gegenereerd in cron';
$string['uupasswordnew'] = 'Nieuw wachtwoord';
$string['uupasswordold'] = 'Bestaand wachtwoord';
$string['uustandardusernames'] = 'Maak gebruikersnamen standaard';
$string['uuupdateall'] = 'Overschrijven met bestand en standaardinstellingen';
$string['uuupdatefromfile'] = 'Overschrijven met bestand';
$string['uuupdatemissing'] = 'Ontbrekende waarden invullen vanuit bestand en standaardwaarden';
$string['uuupdatetype'] = 'Details van bestaande gebruikers';
$string['uuusernametemplate'] = 'Sjabloon gebruikersnaam';
