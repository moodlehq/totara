<?PHP // $Id$ 
      // enrol_dbpositions.php - created with Moodle 1.9.12 (Build: 20110510) (2007101591.03)


$string['dbhost'] = 'Server IP-namn eller nummer';
$string['dbname'] = 'Databasnamn';
$string['dbpass'] = 'Lösenord för server';
$string['dbtable'] = 'Databastabell';
$string['dbtype'] = 'Databastyp';
$string['dbuser'] = 'Serveranvändare';
$string['description'] = 'Du kan använda en extern databas(nästan vilken som helst) för att styra dina relationer mellan användare. Det antas din externa databas innehåller ett fält som innehåller två användar-ID, och en roll-ID. Dessa jämförs med de fält du väljer i de lokala tabellerna för användare och roll';
$string['enrolname'] = 'Extern databas (användarrelation)';
$string['localobjectuserfield'] = 'Namnet på fältet i tabellen användare som vi använder för att matcha poster i den remota databasen (ex idnummer). för den <i>object</i> tilldelade rollen';
$string['localrolefield'] = 'Namnet på fältet i rollertabellen vi använder för att matcha poster i fjärrdatabasen (t.ex. kort namn).';
$string['localsubjectuserfield'] = 'Namnet på fältet i användartabellen vi använder för att matcha poster i fjärrdatabasen (t.ex. idnumret). för <i>ämnet</i> rolltilldelning';
$string['remote_fields_mapping'] = 'Mappning för databasfält';
$string['remoteobjectuserfield'] = 'Namnet på fältet i fjärrtabellen vi använder för att matcha poster i användartabellen för <i>objektets</i> rolltilldelning';
$string['remoterolefield'] = 'Namnet på fältet i fjärrtabellen vi använder för att matcha poster i rolltabellen.';
$string['remotesubjectuserfield'] = 'Namnet på fältet i fjärrtabellen vi använder för att matcha poster i användartabellen för <i>ämnet</i> rolltilldelning';
$string['server_settings'] = 'Serverinställningar för extern databas';
$string['useauthdb'] = 'Använd samma inställningar för databaskopplingen som Databasautentiseringspluginen använder(Du måste specificera tabellnamnet)';
$string['useenroldatabase'] = 'Använd samma inställningar för databaskopplingen som Databasinskrivningspluginen använder(Du måste specificera tabellnamnet)';

?>
