<?PHP // $Id$ 
      // enrol_database.php - created with Moodle 1.9 + (Build: 20080324) (2007101509)


$string['autocreate'] = 'Det går att skapa kurser automatiskt om det finns registreringar på en kurs som ännu inte finns i Moodle.';
$string['autocreation_settings'] = 'Inställningar för automatiskt skapande av kurser';
$string['category'] = 'Kategorin för automatiskt skapade kurser';
$string['course_fullname'] = 'Namnet på fältet där kursens fullständiga namn är lagrat.';
$string['course_id'] = 'Namnet på fältet där kursens ID är lagrat. Värdena i detta fält används för att matcha dem som finns i fältet \'enrol_db_l_coursefield\' i Moodles kurstabell.';
$string['course_shortname'] = 'Namnet på fältet där kursens kortnamn är lagrat.';
$string['course_table'] = 'Namnet på den tabell där vi väntar oss att hitta detaljerad information om kursen (kortnamn, fullständigt namn, ID osv.)';
$string['dbhost'] = 'Serverns IP-nummer eller namn';
$string['dbname'] = 'Databasens namn';
$string['dbpass'] = 'Lösenord för server';
$string['dbtable'] = 'Databastabell';
$string['dbtype'] = 'Typ av databas';
$string['dbuser'] = 'Serveranvändare';
$string['defaultcourseroleid'] = 'Den här rollen kommer att tilldelas om ingen annan roll anges.';
$string['description'] = 'Du kan använda en extern databas (nästan vilken som helst) för att ha kontroll på registreringarna till Dina kurser. Utgångspunkten är att Din externa databas innehåller ett fält med kursens ID och ett fält med användarens ID, Dessa används för att jämföra med de fält som Du väljer i den lokala kursen och i användartabellerna,';
$string['disableunenrol'] = 'Om detta är inställt till Ja som kommer användare som tidigare har varit registrerade via ett plugin-program för den externa databasen INTE att avregistreras av samma plugin, oavsett vilket innehåll databasen har.';
$string['enrol_database_autocreation_settings'] = 'Automatiskt skapande av nya kurser';
$string['enrolname'] = 'Extern databas';
$string['general_options'] = 'Allmänna alternativ';
$string['host'] = 'Databasserverns värdnamn';
$string['ignorehiddencourse'] = 'Om detta är inställt till \"Ja\" så kommer inga studenter/elever/deltagare/lärande att registreras på kurser som inte är öppna för dem.';
$string['local_fields_mapping'] = '(Lokala) databasfält i Moodle';
$string['localcoursefield'] = 'Det namn på fältet i tabellen för kurser som vi använder för att matcha inmatningar i fjärrdatabasen (t.ex. idnummer).';
$string['localrolefield'] = 'Det namn på fältet i tabellen för roller som vi använder för att matcha inmatningar i fjärrdatabasen (t.ex. kortnamn).';
$string['localuserfield'] = 'Det namn på fältet i tabellen för användare som vi använder för att matcha inmatningar i fjärrdatabasen (t.ex. idnummer).';
$string['name'] = 'Den specifika databas som ska användas';
$string['pass'] = 'Lösenord för åtkomst till servern.';
$string['remote_fields_mapping'] = 'Databasfält  (fjärr) för registrering';
$string['remotecoursefield'] = 'Det namn på fältet i fjärrtabellen som vi använder för att matcha inmatningar i tabellen för kurser.';
$string['remoterolefield'] = 'Det namn på fältet i fjärrtabellen som vi använder för att matcha inmatningar i tabellen för roller.';
$string['remoteuserfield'] = 'Det namn på fältet i fjärrtabellen som vi använder för att matcha inmatningar i tabellen för användare.';
$string['server_settings'] = 'Inställningar för extern databasserver';
$string['student_coursefield'] = 'Det namn på fältet i tabellen för registrering av deltagare där vi förväntar oss att hitta kursens ID.';
$string['student_l_userfield'] = 'Det namn på fältet i den lokala tabellen för användare som vi använder för att matcha användare mot en fjärrpost för deltagare (t.ex. ett ID-nummer)';
$string['student_r_userfield'] = 'Det namn på fältet i den fjärrtabellen för användare  där vi förväntar oss att hitta användarens ID.';
$string['student_table'] = 'Namnet på den tabell där registringar av deltagare finns lagrade.';
$string['teacher_coursefield'] = 'Det namn på fältet i tabellen för registreringar av lärare där vi förväntar oss att hitta kursens ID.';
$string['teacher_l_userfield'] = 'Det namn på fältet i den lokala tabellen för användare som vi använder för att matcha användare mot en fjärrpost för distanslärare (t.ex. ID-nummer).';
$string['teacher_r_userfield'] = 'Det namn på fältet i fjärrtabellen för registreringar av lärare där där vi förväntar oss att hitta användar-IDn.';
$string['teacher_table'] = 'Namnet på den tabell där registringar av distanslärare finns lagrade.';
$string['template'] = 'Valfritt: automatiskt skapade kurser kan kopiera sina inställningar från mall till en kurs. Mata in kortnamnet på den mallen här.';
$string['type'] = 'Typ av databasserver';
$string['user'] = 'Användarnamn för åtkomst till servern.';
$string['local_coursefield'] = 'Det namn på fältet i kurstabellen som vi använder för att matcha bidrag i fjärrdatabasen (t.ex. id-nummer).'; // ORPHANED

?>
