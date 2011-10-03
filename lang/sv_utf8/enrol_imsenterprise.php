<?PHP // $Id: enrol_imsenterprise.php,v 1.2 2007/05/26 21:11:05 koenr Exp $ 
      // enrol_imsenterprise.php - created with Moodle 1.8 (2007021501)


$string['aftersaving...'] = 'När Du väl har sparat Dina inställningar så kanske Du vill';
$string['allowunenrol'] = 'Tillåt IMS data att <strong>avregistrera</strong> lärande och distanslärare';
$string['basicsettings'] = 'Grundläggande inställlningar';
$string['coursesettings'] = 'Alternativ för kursdata';
$string['createnewcategories'] = 'Skapa nya (dolda) kurskategorier om det inte går att hitta några i Moodle.';
$string['createnewcourses'] = 'Skapa nya (dolda) kurser om det inte går att hitta några i Moodle.';
$string['createnewusers'] = 'Skapa användarkonton för användare som ännu inte är registrerade i Moodle.';
$string['cronfrequency'] = 'Hur ofta cron processas';
$string['deleteusers'] = 'Ta bort användarkonton när detta är angivet i IMS data.';
$string['description'] = 'Den här metoden kommer upprepade gånger att leta efter och processa en specialformaterad textfil på den plats som Du anger. Filen måste överensstämma med <a href=\'../help.php?module=enrol/imsenterprise&file=formatoverview.html\' target=\'_blank\'>IMS Enterprise specifikationerna</a> och innehålla XML-element för person, grupp och medlemsskap.';
$string['doitnow'] = 'importera en IMS Enterprise nu';
$string['enrolname'] = 'IMS Enterprise-fil';
$string['filelockedmail'] = 'Det går inte att radera den textfil (som baserar sig på en IMS-fil) och som Du använder för registreringar ($a) med hjälp av processen för cron. Detta innebär vanligtvis att det är något problem med rättigheterna. Var snäll och ställ in rättigheterna så att Moodle kan ta bort filen annars kan den komma att processas upprepade gånger.';
$string['filelockedmailsubject'] = 'Viktigt fel: fil för registreringar';
$string['fixcasepersonalnames'] = 'Ändra personnamn till stora bokstäver';
$string['fixcaseusernames'] = 'Ändra användarnamn till små bokstäver';
$string['imsrolesdescription'] = 'Specifikationen för IMS Enterprise inkluderar 8 olika specifika typer av roller. Var snäll och välj hur Du vill att de ska tilldelas i Moodle, inklusive huruvida någon av dem inte ska användas.';
$string['location'] = 'Placering av fil';
$string['logtolocation'] = 'Loggfil för placering av output (tom om det inte finns några loggar)';
$string['mailadmins'] = 'Meddela administratören via e-post';
$string['mailusers'] = 'Meddela användarna via e-post';
$string['miscsettings'] = 'Övrigt';
$string['processphoto'] = 'Läggt till data för användarfoto till profilen';
$string['processphotowarning'] = 'Varning! Att behandla bilder kommer sannolikt att innebära stor belastning på servern. Därför rekommenderar vi Dig att inte aktivera det här alternativet om det är troligt att Du kommer att behandla många studenter/elever/deltagare/lärande.';
$string['restricttarget'] = 'Behandla data bara om det följande målet är angivet';
$string['sourcedidfallback'] = 'Använd  &quot;sourcedid&quot; för en persons userid om det inte går att hitta fältet &quot;userid&quot;';
$string['truncatecoursecodes'] = 'Trunkera kurskoderna till den här längden';
$string['usecapitafix'] = 'Markera den här kryssrutan om Du använder \"Capita\" (deras XML-format är lite fel)';
$string['usersettings'] = 'Alternativ för användardata';
$string['zeroisnotruncation'] = '0 innebär att det inte ska vara någon trunkering';

?>
