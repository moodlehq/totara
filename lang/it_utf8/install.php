<?php
// install.php - created with Totara langimport script version 1.1

$string['aborting'] = 'Interruzione della installazione';
$string['abortinstallation'] = 'Interruzione dell\'installazione';
$string['admindirerror'] = 'La cartella Admin specificata non è corretta';
$string['admindirname'] = 'Cartella Admin';
$string['admindirsetting'] = 'Alcuni web host utilizzano la cartella /admin come URL di accesso a pannelli di controllo od altre funzioni particolari. Tuttavia questo nome coincide con il nome della cartella che Moodle utilizza per i propri file di amministrazione. Per evitare conflitti, è possibile specificare un nome alternativo per la cartella Admin di Moodle. Ad esempio:<p><b>moodleadmin</b></p>
Tutti i link che puntano ai file di amministrazione di Moodle terranno conto di questa variazione.';
$string['admindirsettinghead'] = 'Impostazione della cartella Admin...';
$string['admindirsettingsub'] = 'Alcuni web host utilizzano la cartella /admin come URL di accesso a pannelli di controllo od altre funzioni particolari. Tuttavia questo nome coincide con il nome della cartella che Moodle utilizza per i propri file di amministrazione. Per evitare conflitti, è possibile specificare un nome alternativo per la cartella Admin di Moodle. Ad esempio:<p><b>moodleadmin</b></p>
Tutti i link che puntano ai file di amministrazione di Moodle terranno conto di questa variazione.';
$string['adminemail'] = 'Email:';
$string['adminfirstname'] = 'Nome:';
$string['admininfo'] = 'Dettagli dell\'Amministratore';
$string['adminlastname'] = 'Cognome:';
$string['adminpassword'] = 'Password:';
$string['adminusername'] = 'Username:';
$string['askcontinue'] = 'Continuare (si/no):';
$string['availabledbtypes'] = 'Tipo di Database:';
$string['availablelangs'] = 'Elenco delle lingue disponibili:';
$string['cannotconnecttodb'] = 'Non è stato possibile collegarsi al Database';
$string['caution'] = 'Attenzione';
$string['checkingphpsettings'] = 'Verifica impostazioni PHP';
$string['chooselanguage'] = 'Scegli la lingua';
$string['chooselanguagehead'] = 'Scegli la lingua';
$string['chooselanguagesub'] = 'Scegliete la lingua da usare durante l\'installazione. La lingua usata nel sito e dagli utenti potrà essere modificata in seguito.';
$string['cliadminpassword'] = 'Password per l\'amministratore';
$string['clialreadyinstalled'] = 'Il file config.php è presente, se desiderate aggiornare il sito per favore utilizzate admin/cli/upgrade.php.';
$string['cliinstallfinished'] = 'L\'installazione è stata completata correttamente';
$string['cliinstallheader'] = 'Programma di installazione Moodle $a via linea di comando';
$string['climustagreelicense'] = 'In modalità linea di comando devi accettare la licenza specificando il parametro --agree-license';
$string['clitablesexist'] = 'Le tabelle del database sono già presenti, l\'installazione via linea di comando non può proseguire.';
$string['compatibilitysettings'] = 'Verifica impostazioni PHP...';
$string['compatibilitysettingshead'] = 'Verifica impostazioni PHP...';
$string['compatibilitysettingssub'] = 'Il vostro server deve superare tutti i seguenti test per consentire il corretto funzionamento di Moodle';
$string['configfilecreated'] = 'File di configurazione creato correttamente';
$string['configfiledoesnotexist'] = 'Il file di configurazione non esiste';
$string['configfilenotwritten'] = 'Lo script di installazione non è in grado di creare il file config.php con le  vostre impostazioni, probabilmente perché la cartella di Moodle non ha permessi di scrittura. È possibile copiare manualmente il codice seguente in un file chiamato config.php nella cartella principale di Moodle.';
$string['configfilewritten'] = 'config.php creato correttamente';
$string['configurationcomplete'] = 'Configurazione completata';
$string['configurationcompletehead'] = 'Configurazione completata';
$string['configurationcompletesub'] = 'Moodle ha tentato di salvare la configurazione in un file nella cartella  principale della vostra installazione.';
$string['configurationfileexist'] = 'Il file di configurazione è già esistente!';
$string['creatingconfigfile'] = 'Creazione file di configurazione...';
$string['database'] = 'Database';
$string['databasecreationsettings'] = 'Specificate le impostazioni del Database dove Moodle memorizzerà larga parte dei dati. Il Database sarà configurato automaticamente in accordo alle specifiche fornite.<br /><br /><br />
<b>Tipo:</b> impostato a \"mysql\" dallo script di installazione<br />
<b>Host:</b> impostato a \"localhost\" dallo script di installazione<br />
<b>Nome:</b> nome del Database, ad esempio \"moodle\"<br />
<b>Utente:</b> impostato a \"root\" dallo script di installazione<br />
<b>Password:</b> la password per l\'accesso al Database<br />
<b>Prefisso tabelle:</b> prefisso opzionale da usare per i nomi delle tabelle';
$string['databasecreationsettingshead'] = 'Specificate le impostazioni del Database dove Moodle memorizzerà larga parte dei dati. Il Database sarà configurato automaticamente in accordo alle specifiche fornite.';
$string['databasecreationsettingssub'] = '<b>Tipo:</b> impostato a \"mysql\" dallo script di installazione<br />
<b>Host:</b> impostato a \"localhost\" dallo script di installazione<br />
<b>Nome:</b> nome del Database, ad esempio \"moodle\"<br />
<b>Utente:</b> impostato a \"root\" dallo script di installazione<br />
<b>Password:</b> la password per l\'accesso al Database<br />
<b>Prefisso tabelle:</b> prefisso opzionale da usare per i nomi delle tabelle';
$string['databasecreationsettingssub2'] = '<b>Tipo:</b> impostato a \"mysqli\" dallo script di installazione<br />
<b>Host:</b> impostato a \"localhost\" dallo script di installazione<br />
<b>Nome:</b> nome del Database, ad esempio \"moodle\"<br />
<b>Utente:</b> impostato a \"root\" dallo script di installazione<br />
<b>Password:</b> la password per l\'accesso al Database<br />
<b>Prefisso tabelle:</b> prefisso opzionale da usare per i nomi delle tabelle';
$string['databasehead'] = 'Impostazioni database';
$string['databasehost'] = 'Database host:';
$string['databasename'] = 'Nome del Database';
$string['databasepass'] = 'Password Database';
$string['databasesettings'] = 'Specificate le impostazioni del Database dove Moodle memorizzerà larga parte dei dati. Il Database deve già esistere e dovete disporre di username e password per accedervi.<br />
<b>Tipo:</b> mysql o postgres7<br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso opzionale da usare per i nomi delle tabelle';
$string['databasesettingsformoodle'] = 'Impostazioni del Database di Moodle';
$string['databasesettingshead'] = 'Specificate le impostazioni del Database dove Moodle memorizzerà larga parte dei dati. Il Database deve già esistere e dovete disporre di username e password per accedervi.';
$string['databasesettingssub'] = '<b>Tipo:</b> mysql o postgres7<br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso opzionale da usare per i nomi delle tabelle';
$string['databasesettingssub_mssql'] = '<b>Tipo:</b> SQL*Server (non UTF-8) <strong class=\"errormsg\">Ancora in sperimentazione! (da non usare su siti in produzione)</strong></b><br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b>password dell\'utente<br/>
<b>Prefisso tabelle:</b>prefisso obbligatorio da usare per i nomi delle tabelle';
$string['databasesettingssub_mssql_n'] = '<b>Tipo:</b> SQL*Server (UTF-8 enabled) <br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso obbligatorio  da usare per i nomi delle tabelle';
$string['databasesettingssub_mysql'] = '<b>Tipo:</b> MySQL<br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso opzionale da usare per i nomi delle tabelle';
$string['databasesettingssub_mysqli'] = '<b>Tipo:</b> MySQL Improved<br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso opzionale da usare per i nomi delle tabelle';
$string['databasesettingssub_oci8po'] = '<b>Tipo:</b> Oracle<br/>
<b>Host:</b> da non usare, lasciare vuoto<br />
<b>Nome:</b>i l nome della connessione  tnsnames.ora<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso da usare per i nomi delle tabelle (obbligatorio, max. 2 caratteri)';
$string['databasesettingssub_odbc_mssql'] = '<b>Tipo:</b> SQL*Server (via ODBC) <strong class=\"errormsg\">Ancora in sperimentazione! (da non usare su siti in produzione)</strong></b><br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso obbligatorio da usare per i nomi delle tabelle';
$string['databasesettingssub_postgres7'] = '<b>Tipo:</b> PostgreSQL<br/>
<b>Host:</b> es. localhost o db.isp.com<br />
<b>Nome:</b> il nome del Database, ad esempio \"moodle\"<br/>
<b>Utente:</b> utente del Database<br/>
<b>Password:</b> password dell\'utente<br/>
<b>Prefisso tabelle:</b> prefisso obbligatorio da usare per i nomi delle tabelle';
$string['databasesettingswillbecreated'] = '<b>Attenzione:</b> se il Database specificato non esiste, lo script di installazione tenterà di crearlo.';
$string['databasesocket'] = 'Unix socket';
$string['databasetype'] = 'Tipo di Database';
$string['databasetypehead'] = 'Scegli un database driver';
$string['databasetypesub'] = 'Moodle supporta molti tipi di database. Se non sapete quale usare, contattate l\'  amministratore del vostro server.';
$string['databaseuser'] = 'Utente del Database';
$string['dataroot'] = 'Cartella dei dati';
$string['datarooterror'] = 'La \'Cartella dei dati\' specificata non è stata trovata né è stato possibile crearla. Modificate il percorso oppure createla manualmente.';
$string['datarootpublicerror'] = 'La \'Cartella dei dati\' specificata è accessibile direttamente via web. Dovete specificare una cartella alternativa.';
$string['dbconnectionerror'] = 'Non è possibile connettersi al Database. Verificate le impostazioni che avete fornito.';
$string['dbcreationerror'] = 'Errore nella creazione del Database. Non è possibile creare un Database usando le impostazioni fornite.';
$string['dbhost'] = 'Host server';
$string['dbpass'] = 'Password';
$string['dbprefix'] = 'Prefisso tabelle';
$string['dbtype'] = 'Tipo';
$string['dbwrongencoding'] = 'Il Database selezionato utilizza un codifica sconsigliata ($a). E\' preferibile utilizzare un Database che utilizzi una codifica Unicode (UTF-8). Potete saltare questo test slezionando \"Salta il test dell\'encoding del Database\", tuttavia potreste riscontrare problemi in seguito.';
$string['dbwronghostserver'] = 'E\' necessario attenersi alle indicazioni relative all\'\"Host\" come sopra indicato.';
$string['dbwrongnlslang'] = 'La variabile di ambiente NLS_LANG nel tuo web server deve utilizzare il set di caratteri AL32UTF8. Nella documentazione del PHP trovate le informazioni per configurare OCI8 correttamente.';
$string['dbwrongprefix'] = 'E\' necessario attenersi alle indicazioni relative al \"Prefisso tabelle\" come sopra indicato.';
$string['directorysettings'] = '<p>Verificate e confermate la correttezza degli indirizzi web e dei percorsi assoluti di installazione.</p>
<p><b>Indirizzo web:</b> Specificate l\'indirizzo web per raggiungere la vostra installazione Moodle. Se l\'installazione è raggiungibile da più di una URL, allora specificate la URL che sarà utilizzata dai vostri studenti. Non aggiungete uno slash al termine della URL.</p>
<p><b>Cartella di Moodle:</b> Specificate il percorso assoluto della cartella dove state installando Moodle. Accertatevi che il nome della cartella tenga conto di eventuali lettere maiuscole o minuscole.</p>
<p><b>Cartella dei dati:</b> E\' la cartella dove Moodle inserirà i file caricati dagli utenti. Il web server (in genere \'nobody\' o \'apache\') DEVE avere i permessi di lettura e di scrittura su questa cartella. In aggiunta, la cartella dei dati non deve essere direttamente accessibile via web.</p>';
$string['directorysettingshead'] = 'Verificate e confermate la correttezza degli indirizzi web e dei percorsi assoluti di installazione';
$string['directorysettingssub'] = '<b>Indirizzo web:</b> Specificate l\'indirizzo web per raggiungere la vostra installazione Moodle. Se l\'installazione è raggiungibile da più di una URL, allora specificate la URL che sarà utilizzata dai vostri studenti. Non aggiungete uno slash al termine della URL.
<br/>
<br/>
<b>Cartella di Moodle</b> Specificate il percorso assoluto della cartella dove state installando Moodle. Accertatevi che il nome della cartella tenga conto di eventuali lettere maiuscole o minuscole.
<br/>
<br/>
<b>Cartella dei dati:</b> E\' la cartella dove Moodle inserirà i file caricati dagli utenti. Il web server (in genere \'nobody\' o \'apache\') DEVE avere i permessi di lettura e di scrittura su questa cartella. In aggiunta, la cartella dei dati non deve essere direttamente accessibile via web.';
$string['dirroot'] = 'Cartella di Moodle';
$string['dirrooterror'] = 'L\'impostazione \'Cartella di Moodle\' sembra essere errata - non è possibile trovare l\'installazione di Moodle nel percorso specificato. Il valore sotto riportato è stato ripristinato.';
$string['disagreelicense'] = 'L\'aggiornamento è stato interrotto poiché non avete accettato le condizioni della licenza GPL.';
$string['download'] = 'Download';
$string['downloadlanguagebutton'] = 'Scarica il language pack \"$a\";';
$string['downloadlanguagehead'] = 'Scarica language pack';
$string['downloadlanguagenotneeded'] = 'È possibile continuare l\'installazione utilizzando il language pack \"$a\" di default.';
$string['downloadlanguagepack'] = 'Desiderate scaricare adesso il language pack (si/no):';
$string['downloadlanguagesub'] = 'Se lo desiderate, potete scaricare un Language pack e continuare l\'installazione con la lingua scaricata.<br /><br />Se lo scaricamento del Language pack non andrà a buon fine, l\'installazione proseguirà in lingua Inglese. (Una volta completata l\'instalalzione, avrete comunque la possibilità di scaricare ed installare ulteriori Language pack)';
$string['downloadsuccess'] = 'Language pack scaricato correttamente';
$string['doyouagree'] = 'Siete d\'accordo ? (si/no)';
$string['environmenthead'] = 'Verifica del vostro ambiente...';
$string['environmentsub'] = 'Stiamo verificando che i vari componenti del vostro sistema soddisfino i requisiti necessari.';
$string['environmentsub2'] = 'Ciascuna release di Moodle prevede come requisito minimo una certa versione del PHP assieme ad una serie di estensioni. Prima di una installazione o di un aggiornamento viene eseguita la verifica di questi requisiti minimi. Se non sapete come installare nuove versioni del PHP o le sue estensioni, contattate l\'amministratore del vostro server.';
$string['errorsinenvironment'] = 'Ci sono problemi nel vostro ambiente';
$string['fail'] = 'Test non superato';
$string['fileuploads'] = 'Caricamento file';
$string['fileuploadserror'] = 'Deve essere impostato a on';
$string['fileuploadshelp'] = '<p>Sul vostro server il caricamento dei file sembra sia disabilitato.</p>
<p>Moodle può essere installato, ma senza questa funzionalità non sarà possibile  caricare file nei corsi o modificare le immagini degli utenti..</p>
<p>Per abilitare il caricamento dei file dovete modificare il file php.ini sul vostro sistema impostando <b>file_uploads</b> a \'on\'.</p>';
$string['gdversion'] = 'Versione GD';
$string['gdversionerror'] = 'La libreria GD deve essere presente per poter elaborare e creare immagini';
$string['gdversionhelp'] = '<p>Sul vostro server non sembra sia installata la libreria GD.</p>
<p>GD è una libreria utilizzata dal PHP  per permettere a Moodle di elaborare le immagini (come le immagini dei profili utente) e creare nuove immagini (come i grafici dei log). Moodle può funzionare senza libreria GD - ma queste funzionalità non saranno disponibili sulla vostra installazione.</p>
<p>Per aggiungere il supporto GD al PHP su sistemi operativi Unix/Linux, compilate il PHP utilizzando l\'opzione --with-gd.</p>
<p>Su Windows normalmente è possibile modificare il file php.ini e togliere il commento dalla linea che contiene php_gd2.dll.</p>';
$string['globalsquotes'] = 'Gestione non sicura delle Globals';
$string['globalsquoteserror'] = 'Correggere le impostazioni PHP: disabilitare register_globals e/o abilitare magic_quotes_gpc';
$string['globalsquoteshelp'] = '<p>La combinazione Magic quotes disabilitata e Register Globals abilitata è sconsigliata.</p>

<p>L\'impostazione consigliata per il vostro php.ini è: <b>magic_quotes_gpc = On</b> e <b>register_globals = Off</b>

<p>Qualora non abbiate accesso al file php.ini, potreste aggiungere le seguenti linee in un file .htaccess da salvare nella Cartella di Moodle:</p>
<blockquote><div>php_value magic_quotes_gpc On</div></blockquote>
<blockquote><div>php_value register_globals Off</div></blockquote>';
$string['inputdatadirectory'] = 'Cartella dei dati:';
$string['inputwebadress'] = 'Indirizzo Web:';
$string['inputwebdirectory'] = 'Cartella di Moodle:';
$string['installation'] = 'Installazione';
$string['installationiscomplete'] = 'L\'installazione è stata completata!';
$string['invalidargumenthelp'] = 'Errore: argomento(i) non valido(i)
Utilizzo: \$ php cliupgrade.php OPZIONI
Utilizzare l\'opzione --help per visualizzare l\'aiuto';
$string['invalidemail'] = 'Email non corretta';
$string['invalidhost'] = 'Host non corretto';
$string['invalidint'] = 'Errore: il valore non è un intero';
$string['invalidintrange'] = 'Errore: il valore eccede il consentito';
$string['invalidpath'] = 'Percorso non valido';
$string['invalidsetelement'] = 'Errore: il valore fornito non è nelle tra le opzioni date';
$string['invalidtextvalue'] = 'Testo non valido';
$string['invalidurl'] = 'URL non corretta';
$string['invalidvalueforlanguage'] = 'Valore non valido per l\'opzione --lang. Usate --help per l\'aiuto';
$string['invalidyesno'] = 'Errore: il valore non è un si/no valido';
$string['langdownloaderror'] = 'Purtroppo la lingua \"$a\" non è stata installata. L\'installazione proseguirà in lingua Inglese.';
$string['langdownloadok'] = 'La lingua \"$a\" è stata installata. L\'installazione proseguirà in questa lingua.';
$string['locationanddirectories'] = 'Percorsi e cartelle';
$string['magicquotesruntime'] = 'Magic Quotes Run Time';
$string['magicquotesruntimeerror'] = 'Dovrebbe essere impostata ad off';
$string['magicquotesruntimehelp'] = '<p>L\'opzione Magic Quotes Run Time deve essere impostata a off per permettere a Moodle di funzionare correttamente.</p>
<p>Normalmente off è l\'impostazione di  default per questa variabile ... controllate l\'impostazione <b>magic_quotes_runtime</b> nel file php.ini.</p>
<p>Qualora non abbiate accesso al file php.ini, potreste aggiungere le seguenti linee in un file .htaccess da salvare nella Cartella di Moodle:: <blockquote>php_value magic_quotes_runtime Off</blockquote>
</p>';
$string['memorylimit'] = 'Memory Limit';
$string['memorylimiterror'] = 'Il limite di memoria del PHP è impostato a un valore troppo basso ... potrebbero verificarsi problemi in futuro.';
$string['memorylimithelp'] = '<p>Il limite della memoria assegnata al PHP attualmente è $a.</p>
<p>Questo limite potrà causare problemi nel funzionamento di Moodle, specialmente se usate molti moduli di attività con molti utenti.</p>
<p>Vi raccomandiamo di impostare il PHP con un limite più alto se possibile, ad esempio 40M.
Ci sono diversi modi che potete provare:
<ol>
<li>Se possibile, ricompilate il PHP con l\'opzione <i>--enable-memory-limit</i>.
Questo permetterà  a Moodle di impostare il limite di memoria da solo.</li>
<li>Se avete accesso al file php.ini, è possibile modificare la variabile <b>memory_limit</b> a un valore più alto, ad esempio 40M. Se non avete accesso, potete chiedere al vostro amministratore di sistema di farlo.</li>
<li>Su alcuni server PHP è possibile creare un file .htaccess nella Cartella di Moodle che contenga questa linea:
<blockquote>php_value memory_limit 40M</blockquote>
<p>Tuttavia, su alcuni server questo impedirà  a <b>tutte</b> le pagine PHP di funzionare (vedrete degli errori quando visualizzerete le pagine) cosi dovrete rimuovere il file .htaccess.</li></ol>';
$string['mssql'] = 'SQL*Server (mssql)';
$string['mssql_n'] = 'SQL*Server con supporto UTF-8 (mssql_n)';
$string['mssqlextensionisnotpresentinphp'] = 'Il PHP non è stato configurato correttamente con l\'estensione MSSQL e non può comunicare con SQL*Server. Controllate il vostro php.ini o ricompilate il PHP.';
$string['mysql'] = 'MySQL (mysql)';
$string['mysqlextensionisnotpresentinphp'] = 'Il PHP non è stato configurato correttamente con l\'estensione MySQL e non può comunicare con MySQL. Controllate il vostro php.ini o ricompilate il PHP.';
$string['mysqli'] = 'MySQL Improved (mysqli)';
$string['mysqliextensionisnotpresentinphp'] = 'Il PHP non è stato configurato correttamente con l\'estensione MySQLi e non può comunicare con MySQL. Controllate il vostro php.ini o ricompilate il PHP. Il PHP 4 non ha estensioni per MySQLi.';
$string['nativemysqli'] = 'Improved MySQL (native/mysqli)';
$string['nativemysqlihelp'] = 'Specificate le impostazioni del Database dove Moodle memorizzerà larga parte dei dati. Il Database deve già esistere e dovete disporre di username e password per accedervi. Il Prefisso delle tabelle è opzionale.';
$string['nativeoci'] = 'Oracle (native/oci)';
$string['nativepgsql'] = 'PostgreSQL (native/pgsql)';
$string['nativepgsqlhelp'] = 'Specificate le impostazioni del Database dove Moodle memorizzerà larga parte dei dati. Il Database deve già esistere e dovete disporre di username e password per accedervi. Il Prefisso delle tabelle è obbligatorio.';
$string['newline'] = 'n';
$string['oci8po'] = 'Oracle (oci8po)';
$string['ociextensionisnotpresentinphp'] = 'Il PHP non è stato configurato correttamente con l\'estensione OCI8 e non può comunicare con Oracle. Controllate il vostro php.ini o ricompilate il PHP.';
$string['odbc_mssql'] = 'SQL*Server via ODBC (odbc_mssql)';
$string['odbcextensionisnotpresentinphp'] = 'Il PHP non è stato configurato correttamente con l\'estensione ODBC e non può comunicare con SQL*Server. Controllate il vostro php.ini o ricompilate il PHP.';
$string['pass'] = 'Test superato';
$string['paths'] = 'Percorsi';
$string['pathserrcreatedataroot'] = 'Lo script di installazione non ha potuto creare la Cartella dei dati ($a->dataroot).';
$string['pathshead'] = 'Conferma percorsi';
$string['pathsrodataroot'] = 'La Cartella dei dati non è scrivibile.';
$string['pathsroparentdataroot'] = 'La cartella superiore ($a->parent) non è scrivibile. Lo script di installazione non può creare la Cartella dei dati ($a->dataroot).';
$string['pathssubadmindir'] = 'Alcuni web host utilizzano la cartella /admin come URL di accesso a pannelli di controllo od altre funzioni particolari. Tuttavia questo nome coincide con il nome della cartella che Moodle utilizza per i propri file di amministrazione. Per evitare conflitti, è possibile specificare un nome alternativo per la cartella Admin di Moodle. Ad esempio:<p><b>moodleadmin</b></p>
Tutti i link che puntano ai file di amministrazione di Moodle terranno conto di questa variazione.';
$string['pathssubdataroot'] = 'E\' necessario specificare una cartella dove Moodle inserirà i file caricati dagli utenti. Il web server (in genere \'nobody\' o \'apache\') DEVE avere i permessi di lettura e di scrittura su questa cartella. In aggiunta, la cartella dei dati NON DEVE essere direttamente accessibile via web. Se la Cartella dei dati non esiste, lo script di installazione tenterà di crearla.';
$string['pathssubdirroot'] = 'Percorso assoluto della installazione Moodle. Modificatelo solamente se avete bisogno di usare link simbolici.';
$string['pathssubwwwroot'] = 'Indirizzo web per accedere a questa installazione di Moodle. Non è possibile accedere a Moodle usando indirizzi multipli. Se il vpstro sito ha indirizzi web pubblici multipli, dovete configurare dei re-indirizzamenti permanenti su tutti gli altri indirizzi.
Se il vostro sito è accessibile sia dalla Internet che dalla Intranet, allora usate l\'indirizzo Internet pubblico ed impostate il DNS in modo che anche gli utenti intranet possano accedere all\'indirizzo pubblico.';
$string['pathsunsecuredataroot'] = 'La posizione della Cartella dei dati non è sicura';
$string['pathswrongadmindir'] = 'La cartella Admin non esiste';
$string['pathswrongdirroot'] = 'La posizione della cartella Dirroot è errata';
$string['pdosqlite3'] = 'SQLite 3 (PDO)<strong class=\"errormsg\">Ancora in sperimentazione! (da non usare su siti in produzione)</strong></b>';
$string['pearargerror'] = 'La libreria PEAR non è in grado di identificare argumentsn';
$string['pgsqlextensionisnotpresentinphp'] = 'Il PHP non è stato configurato correttamente con l\'estensione PGSQL e non può comunicare con PostgreSQL. Controllate il vostro php.ini o ricompilate il PHP.';
$string['php52versionerror'] = 'La versione del PHP deve essere almeno la 5.2.4';
$string['php52versionhelp'] = '<p>Moodle necessita come minimo della versione 5.2.4 del PHP.</p>
<p>La versione installata nel vostro sistema è la $a</p>
<p>Dovete aggiornare la versione del PHP oppure spostarsi su un host che abbia una versione più aggiornata del PHP!</p>';
$string['phpextension'] = '$a estensioni PHP';
$string['phpversion'] = 'Versione PHP';
$string['phpversionerror'] = 'La versione del PHP deve essere almeno 4.3.0 o 5.1.0 (la versione 5.0.x ha numerosi bug noti).';
$string['phpversionhelp'] = '<p>Moodle necessita come minimo della versione 4.3.0 o 5.1.0 del PHP. (La versione 5.0.x soffre di problemi ben conosciuti)</p>
<p>La versione installata nel vostro sistema è la $a</p>
<p>Dovete aggiornare la versione del PHP oppure spostarsi su un host che abbia una versione più aggiornata del PHP!<br>
(Se avete la 5.0.x, potete fare il downgrade alla versione 4.4.x)</p>';
$string['postgres7'] = 'PostgreSQL (postgres7)';
$string['postgresqlwarning'] = '<strong>Nota:</strong> Se incontri problemi di connessione, prova ad impostare il campo Host Server 
host=\'postgresql_host\' port=\'5432\' dbname=\'postgresql_database_name\' user=\'postgresql_user\' password=\'postgresql_user_password\'
lsciando vuoti i campi Database, User e Password. Per maggiorni informazioni <a href=\"http://docs.moodle.org/en/Installing_Postgres_for_PHP\">Moodle Docs</a>';
$string['releasenoteslink'] = 'Per informazioni su questa versione di Moodle, fate riferimento alle Note di Rilascio su $a';
$string['safemode'] = 'Safe Mode';
$string['safemodeerror'] = 'Moodle può avere problemi con il safe mode impostato a on';
$string['safemodehelp'] = '<p>Moodle può avere diversi problemi con l\'impostazione Safe Mode ad on, non ultima l\'impossibilità  di creare nuovi file.</p>
<p>Safe mode è normalmente abiltato da paranoici web server pubblici, se è cosi l\'unica soluzione è trovare un nuovo web server per il tuo sito di Moodle.</p>
<p>È possibile a continuare l\'installazione se si vuole, ma aspettatevi alcuni problemi in seguito.</p>';
$string['selectlanguage'] = 'Selezione la lingua per l\'installazione';
$string['sessionautostart'] = 'Session Auto Start';
$string['sessionautostarterror'] = 'Dovrebbe essere impostata ad off';
$string['sessionautostarthelp'] = '<p>Moodle richiede il supporto delle sessioni e non funziona senza.</p>
<p>Le sessioni possono essere abilitate nel file php.ini ... cerca il parametro session.auto_start.</p>';
$string['sitefullname'] = 'Nome del sito :';
$string['siteinfo'] = 'Dettagli del sito';
$string['sitenewsitems'] = 'Numero di news :';
$string['siteshortname'] = 'Nome del sito abbreviato:';
$string['sitesummary'] = 'Descrizione del sito :';
$string['skipdbencodingtest'] = 'Salta il test della codifica del Database';
$string['sqliteextensionisnotpresentinphp'] = 'Il PHP non è stato configurato correttamente con l\'estensione SQLite extension. Controllate il vostro php.ini o ricompilate il PHP.';
$string['tableprefix'] = 'Prefisso tabelle:';
$string['unsafedirname'] = 'Errore: caratteri non sicuri nel nome della directory. I caratteri validi sono a-zA-Z0-9_-n';
$string['upgradingactivitymodule'] = 'Aggiornamento Moduli di Attività';
$string['upgradingbackupdb'] = 'Aggiornamento Database Backup';
$string['upgradingblocksdb'] = 'Aggiornamento Database Blocchi';
$string['upgradingblocksplugin'] = 'Aggiornamento Plugin Blocchi';
$string['upgradingcompleted'] = 'Aggiornamento completato...';
$string['upgradingcourseformatplugin'] = 'Aggiornamento Plugin Formato Corsi';
$string['upgradingenrolplugin'] = 'Aggiornamento Plugin Iscrizione';
$string['upgradinggradeexportplugin'] = 'Aggiornamento Plugin Esportazione Valutazioni';
$string['upgradinggradeimportplugin'] = 'Aggiornamento Plugin Importazione Valutazioni';
$string['upgradinggradereportplugin'] = 'Aggiornamento Plugin Report Valutazioni';
$string['upgradinglocaldb'] = 'Aggiornamento Database Locale';
$string['upgradingmessageoutputpluggin'] = 'Aggiornamento Plugin Messaggi';
$string['upgradingqtypeplugin'] = 'Aggiornamento Plugin Tipi Domande';
$string['upgradingrpcfunctions'] = 'Aggiornamento Funzionalità RPC';
$string['usagehelp'] = 'Sinossi:
\$php cliupgrade.php OPZIONI

OPZIONI
--lang Lingua da utilizzare durante l\'installazione. Default Inglese (en)
--webaddr Indirzzo web del sito Moodle
--datadir percorso assoluto della Cartela dei dati (da mettere fuori dallo spazio web)
--dbtype Tipo di Database. Default mysql
--dbhost Database host. Default localhost
--dbname Nome del Database. Default moodle
--dbuser Database user. Default vuoto
--dbpass Database password. Default vuoto
--prefix Prefisso tabelle. Default mdl
--verbose 0 Nessun output, 1 Output riassuntivo (Default), 2 Output dettagliato
--interactivelevel 0 Non interattivo, 1 semi interattivo(Default), 2 interattivo
--agreelicense Yes(Default) o No
--confirmrelease Yes(Default) o No
--sitefullname Nome del sito. Default : Moodle Site (Per favore cambiatelo!!)
--siteshortname Nome abbreviato del sito. Default moodle
--sitesummary Descrizione del sito. Default vuoto
--adminfirstname Nome dell\'amministratore. Default Admin
--adminlastname Cognome dell\'amministratore. Default User
--adminusername Username per l\'amministratore. Default admin
--adminpassword Password per l\'amministratore. Default admin
--adminemail Indirizzo email dell\'amministratore. Default root@localhost
--help visualizza questo aiuto

Utilizzo:
\$php cliupgrade.php --lang=en --webaddr=http://www.example.com --moodledir=/var/www/html/moodle --datadir=/var/moodledata --dbtype=mysql --dbhost=localhost --dbname=moodle --dbuser=root --prefix=mdl --agreelicense=yes --confirmrelease=yes --sitefullname=\"Example Moodle Site\" --siteshortname=moodle --sitesummary=siteforme --adminfirstname=Admin --adminlastname=User --adminusername=admin --adminpassword=admin --adminemail=admin@example.com --verbose=1 --interactivelevel=2';
$string['versionerror'] = 'Interrotto dall\'utente a causa di errore di versione';
$string['welcomep10'] = '$a->installername ($a->installerversion)';
$string['welcomep20'] = 'Se vedete questa pagina avete installato correttamente e lanciato il pacchetto <strong>$a->packname $a->packversion</strong>. Complimenti!';
$string['welcomep30'] = 'La release di <strong>$a->installername</strong> include un applicazione per creare l\'ambiente dive girerà <strong>Moodle</strong>:';
$string['welcomep40'] = 'Il pacchetto include anche <strong>Moodle $a->moodlerelease ($a->moodleversion)</strong>.';
$string['welcomep50'] = 'L\'utilizzo delle applicazioni incluse in questo pacchetto è regolato dalle rispettive licenze. L\'intero pacchetto <strong>$a->installername</strong> è <a href=\"http://www.opensource.org/docs/definition_plain.html\">open source</a> ed è distribuito in accordo alla licenza <a href=\"http://www.gnu.org/copyleft/gpl.html\">GPL</a>.';
$string['welcomep60'] = 'Le prossime pagine vi guideranno attraverso semplici passi per installare e configurare <strong>Moodle</strong> nel vostro computer. Potete utilizzare le impostazioni di default oppure modificarle per adeguarle alle vostre esigenze.';
$string['welcomep70'] = 'Fate click sul pulsante \"Avanti\" per continuare l\'installazione di <strong>Moodle</strong>.';
$string['welcometext'] = '---Benvenuti nell\'installatore di Moodle a linea di comando---';
$string['writetoconfigfilefaild'] = 'Errore: scrittura del file di configurazione fallita';
$string['wwwroot'] = 'Indirizzo web';
$string['wwwrooterror'] = 'L\'indirizzo web sembra non essere valido - questa installazione di Moodle non sembra trovarsi dove indicato. L\'indirizzo è stato reimpostato';
$string['yourchoice'] = 'La vostra scelta:';

?>
