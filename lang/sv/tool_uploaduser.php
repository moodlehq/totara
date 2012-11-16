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
 * Strings for component 'tool_uploaduser', language 'sv', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_uploaduser
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowdeletes'] = 'Tillåt borttagningar';
$string['allowrenames'] = 'Tillåt namnbyten';
$string['csvdelimiter'] = 'Avskiljare för CSV';
$string['defaultvalues'] = 'Förinställda standardvärden';
$string['deleteerrors'] = 'Ta bort fel';
$string['encoding'] = 'Inkodning';
$string['errors'] = 'Fel';
$string['nochanges'] = 'Inga ändringar';
$string['renameerrors'] = 'Fel vid namnbyte';
$string['requiredtemplate'] = 'Obligatoriskt. Du kan använda syntax för mall här  (%l = lastname, %f = firstname, %u = username).Se hjälpen för detaljer och exempel.';
$string['rowpreviewnum'] = 'Förhandsgranska rader';
$string['uploadpicture_baduserfield'] = 'Det attribut för användare som har angivits är inte giltigt. Var snäll och försök igen.';
$string['uploadpicture_cannotmovezip'] = 'Det går inte att flytta zip-filen till en temporär katalog.';
$string['uploadpicture_cannotprocessdir'] = 'Det går inte att behandla de icke-hoppackade filerna';
$string['uploadpicture_cannotsave'] = 'Det går inte att spara bilden för användare {$a}. Kontrollera originalbilden.';
$string['uploadpicture_cannotunzip'] = 'Det går inte att packa upp filen med bilder.';
$string['uploadpicture_invalidfilename'] = 'Bildfilen {$a} s namn innehåller ogiltiga tecken. Hoppar över.';
$string['uploadpicture_overwrite'] = 'Vill du skriva över de befintliga användarbilderna?';
$string['uploadpicture_userfield'] = 'Attribut för användare som kan användas för att matcha bilder:';
$string['uploadpicture_usernotfound'] = 'Det finns ingen användare med ett \'{$a->userfield}\' värde av \'{$a->uservalue}\'. Hoppar över.';
$string['uploadpicture_userskipped'] = 'Hoppar över användare {$a} (det finns redan en bild).';
$string['uploadpicture_userupdated'] = 'Bilden för användare {$a} har uppdaterats.';
$string['uploadpictures'] = 'Ladda upp bilder för användare';
$string['uploadpictures_help'] = 'Det går att ladda upp användarbilder som zippade bildfiler. Man bör ge bildfilerna ett namn \*chosen-user-attribute.extension\*. Om t.ex. det valda användarattribut som används för att matcha bilder är användarnamn och detta namn är pelle1234, då bör filnamnet på bilden vara pelle1234.jpg.
De bildformat som stödjs är gif, jpg, och png.
Namn på bildfiler är inte skiftlägeskänsliga.';
$string['uploadusers'] = 'Ladda upp användare';
$string['uploadusers_help'] = 'Lägg till att börja med märke till att **det i de flesta fall inte är nödvändigt att importera användare i bulk**. För att minimera ditt underhållsarbete bör du istället först och främst undersöka de olika inte-manuella alternativen för autenticering, som t.ex. att koppla till befintliga externa databaser eller att låta användarna skapa sina konton själva. För mer info se sektionen för autenticering i menyerna för administration.
Om du är säker på att du vill importera ett flertal användarkonton från en textfil då behöver du formatera din textfil enligt följande:

* Varje rad i filen innehåller en post
* Varje post utgörs av en serie data som är separerade med komman (eller andra avskiljare)
* Den första posten i posten är speciell och innehåller en lista med namn på de olika fälten. Detta fungerar som en mall för formatet på resten av filen.

**Obligatoriska fältnamn:** dessa fält måste ingå i den första posten och vara definierade för varje användare


\`firstname(förnamn), lastname (efternamn)\` när du matar in eller uppdaterar \`username(användarnamn)\`


**Valfria fältnamn:** alla dessa fältnamn är helt valfria: Om det finns ett värde för fältet i filen då kommer det värdet att användas; om inte så kommer standardvärdet för det fältet att användas.


\`institution, department(avdelning), city (stad, ort), country (land), lang (språk), auth, ajax, timezone (tidszon), idnumber (id-nummer), icq, phone1 (tfn1), phone2 (tfn2), address (adress), url, description (beskrivning), mailformat (format på e-post), maildisplay (visning av e-post), htmleditor (XHTML-redigerare), autosubscribe (prenumerera automatiskt, emailstop\`


**Standardnamn för fält i profilen:** valfritt, xxxxx är det riktiga standardnamnet på fältet i användarprofilen (dvs det unika kortnamnet)


\`profile\_field\_xxxxx\`


**Speciella fältnamn:** dessa används för att ändra användarnamn och för att ta bort användare, se nedan:


\`deleted (borttagen), oldusername (gammaltanvändarnamn)\`


**Fältnamn för registrering (valfritt):** Kursnamnen utgörs av "kortnamnen" på kurserna - om det finns sådana så kommer användaren att registreras på de kurserna.


"Type" betyder den typ av roll som ska användas för den aktuella registreringen på kursen.
Värde 1 är den förvalda standardrollen i kursen, 2 är den auktoriserade (distans)lärarrollen och 3 är den auktoriserade icke-redigerande (distans)lärarrollen.

Du kan använda rollfältet istället för att ange rollerna direkt; isåfall ska du antingen använda kortnamnet för rollen eller ID (numeriska namn på roller stödjs inte).


Du kan även dela in användare i grupper i kurs (grupp1 i kurs1, grupp2 i kurs2, etc.). Grupper identifieras igen via sina namn eller IDn (numeriska namn på grupper stödjs inte).

\`course1, type1, role1, group1, course2, type2, role2, group2, etc.\`


* Komman inom datan bör du märka upp som &#44 - skriptet kommer automatiskt att avkoda
dessa och omvandla dem till komman.
* När det gäller Booleanska fält ska du använda 0 för "false" (falsk) och 1 för "true" (sann).

Här är ett exempel på en giltig fil för import:
`username, password, firstname, lastname, email, lang, idnumber, maildisplay, course1, group1, type1
jonest, mycket_hemligt, Tom, Jonsson, jonest@ort.edu, sv, 3663737, 1, Intro101, Section 1, 1
reznort, lite_hemligt, Trent, Reznor, reznort@skaane.edu, sv, 6736733, 0, Advanced202, Section 3, 3
`
## Mallar
Standardvärdena behandlas som mallar och i dem är de följande koderna tillåtna:
* \`%l\` - kommer att ersättas av lastname
* \`%f\` - kommer att ersättas av firstname
* \`%u\` - kommer att ersättas av username
* \`%%\` - kommer att ersättas av %

Mellan procenttecknet (%) och valfri kodbokstav (l, f eller u) är de följande modifierarna tillåtna:
* (-) minustecknet - den information som specificeras av kodbokstaven kommer att omvandlas till minuskler (små bokstäver)
* (+) plustecknet - t den information som specificeras av kodbokstaven kommer att omvandlas till VERSALER (stora bokstäver)
* (~) tildetecknet - den information som specificeras av kodbokstaven kommer att omvandlas till "Title Case"
* ett decimaltal - den information som specificeras av kodbokstaven kommer att trunkeras till det antalet tecken

Om t.ex. förnamnet är Johan och efternamnet är Andersson då kommer du att få följande värden om du använder de angivna mallarna:
* %l%f = AnderssonJohan
* %l%1f = AnderssonJ
* %-l%+f = anderssonJOHAN
* %-f\_%-l = johan\_andersson
* http://www.example.com/~%u/ = http://www.example.com/~jdoe/ (om användarnamnet är jdoe eller %-1f%-l)

Denna behandling av mallarna tillämpas bara på standardvärdena och inte på den värden som hämtas från den (kommaseparerade) CSV-filen.
För att du ska kunna skapa riktiga användarnamn för Moodle så omvandlas användarnamnen alltid till minuskler (små bokstäver). Dessutom är det så att om alternativet "Tillåt specialtecken i användarnamn" på sidan Regler för användning är avaktiverat så kommer tecken som inte är bokstäver, siffror, bindestreck (-) och punkt (.) att tas bort.
Om t.ex. förnamnet är Johan Jr. och efternamnet är Andersson då kommer användarnamnet %-f\_%-l att resultera i johan jr.\_andersson när "Tillåt specialtecken i användarnamn" är aktiverat och johanjr.andersson när det är avaktiverat.
När "Lägg till räknare" i "Hantering av nya användarnamn som är dubbletter" är aktiverat så kommer en räknare att automatiskt lägga till ett tal till de dubbletter av användarnamn som skapas av mallen.
Om t.ex. CSV-filen innehåller användarna Johan Andersson, Janna Andersson och Johanna Andersson utan uttryckliga användarnamn så kommer det standardmässiga användarnamnet att vara %-1f%-l.
Och om dessutom "Lägg till räknare" i "Hantering av nya användarnamn som är dubbletter" är aktiverat då kommer de resulterande användarnamnen att bli jandersson, jandersson2 och jandersson3.

## Att uppdatera befintliga konton
Som standardmässigt förval så kommer Moodle att anta att du kommer att skapa nya konton och därför hoppa över poster där användarnamnet överensstämmer med ett befintligt konto.
Om du däremot tillåter uppdatering så kommer även det befintliga användarkontot att uppdateras.
När du uppdaterar befintliga konton så kan du även byta användarnamnen. Ange isåfall **"Ja"** som svar på "Tillåt namnbyten" och ta även med ett fält i din fil som ska heta \`oldusername\`.
**OBS!** Alla fel som kan uppstå när du uppdaterar befintliga konton kan påverka dina användare på ett menligt sätt. Var därför försiktig när du använder det här alternativet.
## Att ta bort konton
Om fältet \`deleted (borttagen)\` finns med så kommer användare med värdet 1 för det
att tas bort. I det här fallet kan alla fält undantas utom det för \`username (användarnamn)\`.
Du kan ta bort eller ladda upp konton med hjälp av en enda CSV-fil. Den följande filen kommer t.ex. att lägga till användaren Johan Andersson och ta bort användaren kurtnilsson:
`username, firstname, lastname, deleted
jand, Johan, Andersson, 0
kurtnilsson, , , 1
`';
$string['uploaduserspreview'] = 'Ladda upp förhandsgranskning av användare';
$string['uploadusersresult'] = 'Ladda upp resultat för användare';
$string['useraccountupdated'] = 'Användare har uppdaterats';
$string['userdeleted'] = 'Användare borttagen';
$string['userrenamed'] = 'Användare  har fått nya namn';
$string['userscreated'] = 'Användare har skapats';
$string['usersdeleted'] = 'Användare borttagna';
$string['usersrenamed'] = 'Användare  har fått nya namn';
$string['usersskipped'] = 'Användare hoppades över';
$string['usersupdated'] = 'Användare har uppdaterats';
$string['usersweakpassword'] = 'Användare som har ett svagt lösenord';
$string['uubulk'] = 'Markera för bearbetning i bulk';
$string['uubulkall'] = 'Alla användare';
$string['uubulknew'] = 'Nya användare';
$string['uubulkupdated'] = 'Uppdaterade användare';
$string['uucsvline'] = 'CSV-rad';
$string['uulegacy1role'] = '(Original Student) typeN=1';
$string['uulegacy2role'] = '(Original lärare) typeN=2';
$string['uulegacy3role'] = '(Original icke-redigrerande lärare) typeN=3';
$string['uunoemailduplicates'] = 'Förhindra att den skapas dubletter av e-postadresser';
$string['uuoptype'] = 'Typ av uppladdning';
$string['uuoptype_addinc'] = 'Lägg till alla, koppla till en räknare till användarnamn om det behövs.';
$string['uuoptype_addnew'] = 'Lägg endast till en ny, hoppa över befintliga användare';
$string['uuoptype_addupdate'] = 'Lägg till nya och uppdatera befintliga användare';
$string['uuoptype_update'] = 'Uppdatera endast befintliga användare';
$string['uupasswordnew'] = 'Nytt lösenord för användare';
$string['uupasswordold'] = 'Befintligt lösenord för användare';
$string['uuupdateall'] = 'Överskrid med fil och standardmässiga förval';
$string['uuupdatefromfile'] = 'Överskrid med fil';
$string['uuupdatemissing'] = 'Fyll i det som saknas från fil och standardmässiga förval';
$string['uuupdatetype'] = 'Befintliga detaljer för användare';
