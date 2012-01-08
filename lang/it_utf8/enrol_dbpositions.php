<?PHP // $Id$ 
      // enrol_dbpositions.php - created with Moodle 1.9.14 (Build: 20111010) (2007101591.06)


$string['dbhost'] = 'Numero o nome dell\'IP server';
$string['dbname'] = 'Nome del database';
$string['dbpass'] = 'Password del server';
$string['dbtable'] = 'Tabella del database';
$string['dbtype'] = 'Tipo di database';
$string['dbuser'] = 'Utente server';
$string['description'] = 'E\' possibile usare un database esterno (di praticamente qualsiasi tipo) per controllare le interazioni fra gli utenti. Si suppone che il database esterno contiene un campo con due ID utente e un ID ruolo. Questi ID sono confrontati ai campi selezionati nelle tabelle dei ruoli e dell\'utente locale';
$string['enrolname'] = 'Database esterno (assegnazioni di posizione)';
$string['fullnamefield'] = 'Il nome del campo nel database esterno che verrà usato come nome completo di assegnazione della posizione.';
$string['localobjectuserfield'] = 'Il nome del campo nella tabella dell\'utente che si usa per far corrispondere le voci nel database remoto (ad es. numero id) per l\'assegnazione del ruolo di <i>membro del personale</i>';
$string['localorgfield'] = 'Il nome del campo nella tabella delle organizzazioni che si usa per far corrispondere le voci nel database remoto(ad es. numeroid).';
$string['localposfield'] = 'Il nome del campo nella tabelle delle posizioni che si usa per corrispondere alle voci nel database remoto (ad es. numero id).';
$string['localsubjectuserfield'] = 'Il nome del campo nella tabella dell\'utente che si usa per far corrispondere le voci nel database remoto (ad es. numero id), per l\'assegnazione del ruolo di <i>manager</i>';
$string['postypefield'] = 'Campo del tipo di posizione - Il nome del campo nella tabella esterna che descrive il tipo di posizione da creare - primaria, secondaria, ascensionale. Se questo campo non è specificato, si suppone che tutte le righe si riferiscono alle assegnazioni di posizione primaria.';
$string['remote_fields_mapping'] = 'Mappatura del campo di database';
$string['remoteobjectuserfield'] = 'Il nome del campo nella tabella remota che si usa per far corrispondere le voci nella tabella utente per l\'assegnazione dei ruoli di <i>membro del personale</i>';
$string['remoteorgfield'] = 'Il nome del campo nella tabella remota che si usa per far corrispondere le voci nel database delle organizzazioni (ad es team)';
$string['remoteposfield'] = 'Il nome del campo nella tabella remota che si usa per far corrispondere le voci nella tabella delle posizioni (ad es posizione)';
$string['remotesubjectuserfield'] = 'Il nome del campo nella tabella remota che si usa per far corrispondere le voci nella tabella utente per l\'assegnazione del ruolo di <i>gestore</i>';
$string['roleshortname'] = 'Il nome abbreviato del ruolo che dovrebbe essere assegnato al gestore nell\'ambito di membro del personale';
$string['server_settings'] = 'Impostazioni del server del database esterno';
$string['shortnamefield'] = 'Il nome del campo nella tabella remota da usare come nome abbreviato di assegnazione della posizione';
$string['useauthdb'] = 'Per la connessione del database usare le stesse impostazioni del plug-in di autenticazione del database (occorre specificare il nome della tabella)';
$string['useenroldatabase'] = 'Per la connessione del database usare le stesse impostazioni del plug-in di iscrizione del database (occorre specificare il nome della tabella)';

?>
