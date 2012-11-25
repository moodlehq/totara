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
 * Strings for component 'scorm', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   scorm
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activation'] = 'Attivazione';
$string['activityloading'] = 'L\'attività partirà in';
$string['activitypleasewait'] = 'Caricamento in corso...';
$string['adminsettings'] = 'Impostazioni amministrative';
$string['advanced'] = 'Parametri';
$string['aicchacpkeepsessiondata'] = 'Dati sessione AICC HACP';
$string['aicchacpkeepsessiondata_desc'] = 'La durata del mantenimento, espressa in giorni, dei dati delle sessioni esterne AICC HACP. (un valore elevato riempirà la tabella di dati ma può essere utile per eseguire attività si debug)';
$string['aicchacptimeout'] = 'Timeout AICC HACP';
$string['aicchacptimeout_desc'] = 'La durata in minuti in cui una sessione AICC HACP può rimanere aperta';
$string['allowapidebug'] = 'Attiva l\'API di debug e tracking (Imposta la capture mask con apidebugmasjk)';
$string['allowtypeaicchacp'] = 'Abilita AICC HACP esterna';
$string['allowtypeaicchacp_desc'] = 'Abilita la comunicazione   AICC HACP esterna senza necessità di autenticazioni per richieste post provenienti dal pacchetto AICC esterno';
$string['allowtypeexternal'] = 'Abilita i pacchetti di tipo esterno';
$string['allowtypeexternalaicc'] = 'Abilita url AICC diretta';
$string['allowtypeexternalaicc_desc'] = 'Consente di usare url dirette a pacchetti AICC';
$string['allowtypeimsrepository'] = 'Abilita i pacchetti di tipo IMS';
$string['allowtypelocalsync'] = 'Abilita i pacchetti di tipo download';
$string['apidebugmask'] = 'API debug capture mask - utilizza una regex su <username>:<activityname> ad esempio admin:.* eseguirà il debug solo per gli admin.';
$string['areacontent'] = 'File del contenuto';
$string['areapackage'] = 'File del pacchetto';
$string['asset'] = 'Asset';
$string['assetlaunched'] = 'Asset - Visualizzato';
$string['attempt'] = 'Tentativo';
$string['attempt1'] = '1 tentativo';
$string['attempts'] = 'Tentativi';
$string['attemptsx'] = '{$a} tentativi';
$string['attr_error'] = 'Valore non valido per l\'attributo ({$a->attr}) nel tag {$a->tag}.';
$string['autocontinue'] = 'Continuazione automatica';
$string['autocontinue_help'] = 'La continuazione automatica permette di lanciare automaticamente i learning object successivi senza usare il tasto Continua';
$string['autocontinuedesc'] = 'Imposta il default per la continuazione automatica';
$string['averageattempt'] = 'Media tentativi';
$string['badmanifest'] = 'Il manifest contiene alcuni errori: controlla l\'elenco';
$string['badpackage'] = 'Il pacchetto/manifest specificato non è valido. Controlla e riprova.';
$string['browse'] = 'Anteprima';
$string['browsed'] = 'Visitato';
$string['browsemode'] = 'Modalità anteprima';
$string['browserepository'] = 'Visita repository';
$string['cannotfindsco'] = 'SCO non trovata';
$string['chooseapacket'] = 'Scegli o aggiorna un pacchetto';
$string['completed'] = 'Completato';
$string['completionscorerequired'] = 'Richiede punteggio minimo';
$string['completionstatus_completed'] = 'Completato';
$string['completionstatus_failed'] = 'Non superato';
$string['completionstatus_help'] = '# Completamento di attività: richiesta di stato
Per verificare uno o più stati, l\'utente deve soddisfare almeno uno degli stati selezionati per essere contrassegnato come completato per l\'attività SCORM in questione e per qualsiasi altra requisito di completamento di attività.';
$string['completionstatus_passed'] = 'Superato';
$string['completionstatusrequired'] = 'Richiede stato';
$string['confirmloosetracks'] = 'ATTENZIONE: Il pacchetto sembra cambiato o modificato. Se la struttura del pacchetto è cambiata, alcuni tracciamenti degli utenti potrebbero andare persi durante il processo di aggiornamento.';
$string['contents'] = 'Contenuti';
$string['coursepacket'] = 'Pacchetto del corso';
$string['coursestruct'] = 'Struttura del corso';
$string['currentwindow'] = 'Stessa finestra';
$string['datadir'] = 'Errore filesystem: non è possibile creare la cartella dei dati del corso';
$string['defaultdisplaysettings'] = 'Impostazioni di visualizzazione di default';
$string['defaultgradesettings'] = 'Impostazioni di valutazione di default';
$string['defaultothersettings'] = 'Altre impostazioni di default';
$string['deleteallattempts'] = 'Elimina tutti i tentativi SCORM';
$string['deleteattemptcheck'] = 'Sei sicuro di voler eliminare questi tentativi?';
$string['deleteuserattemptcheck'] = 'Sei proprio sicuro di voler eliminare tutti i tuoi tentativi?';
$string['details'] = 'Dettagli tracciamento';
$string['directories'] = 'Visualizza collegamenti';
$string['disabled'] = 'Disabilitato';
$string['display'] = 'Visualizzazione pacchetto';
$string['displayattemptstatus'] = 'Visualizza  lo stato dei tentativi';
$string['displayattemptstatus_help'] = 'Visualizza lo stato dei tentativi ed i punteggi nella pagina di riepilogo del pacchetto SCORM.';
$string['displayattemptstatusdesc'] = 'Imposta il valore di default per la visualizzazione dello stato dei tentativi';
$string['displaycoursestructure'] = 'Visualizza la struttura del corso nella pagina di ingresso';
$string['displaycoursestructure_help'] = 'Visualizza la struttura del corso nella pagina di riepilogo SCORM.';
$string['displaycoursestructuredesc'] = 'Iimposta il valore di default per la visualizzazione della struttura del corso nella pagina di ingresso';
$string['displaydesc'] = 'Imposta il valore di default per la visualizzazione di un pacchetto';
$string['displaysettings'] = 'Impostazioni di visualizzazione';
$string['domxml'] = 'Libreria esterna DOMXML';
$string['duedate'] = 'Data di termine';
$string['element'] = 'Elemento';
$string['elementdefinition'] = 'Definizione Elemento';
$string['enter'] = 'Entra';
$string['entercourse'] = 'Entra nel corso';
$string['errorlogs'] = 'Log degli errori';
$string['everyday'] = 'Ogni giorno';
$string['everytime'] = 'Ogni volta che è usato';
$string['exceededmaxattempts'] = 'Hai raggiunto il massimo numero di tentativi consentito.';
$string['exit'] = 'Esci dal corso';
$string['exitactivity'] = 'Esci dall\'attività';
$string['expired'] = 'Spiacente, questa attività è stata chiusa il {$a} e non è più disponibile';
$string['external'] = 'Aggiornamento pacchetti esterni';
$string['failed'] = 'Fallito';
$string['finishscorm'] = 'Se hai terminato di visualizzare questa risorsa, {$a}';
$string['finishscormlinkname'] = 'fai click qui per tornare alla pagina del corso';
$string['firstaccess'] = 'Primo accesso';
$string['firstattempt'] = 'Primo tentativo';
$string['forcecompleted'] = 'Forza completamento';
$string['forcecompleted_help'] = 'Forzare il completamento assicura che lo stato del tentativo sia "completato". L\'impostazione ha senso solo per i pacchetti SCORM 1.2. E\' particolarmente utile se il pacchetto SCORM non gestisce perfettamente nuovi accessi allo stesso tentativo oppure invia lo stato di completamento in modo improprio.';
$string['forcecompleteddesc'] = 'Imposta il valore di default per l\'opzione Forza completamento';
$string['forcejavascript'] = 'Obbliga gli utenti ad abilitare JavaScript';
$string['forcejavascript_desc'] = 'Impedisce l\'accesso ad oggetti SCORM quando il borwser dell\'utente non supporta javascript oppure non lo ha abilitato. Se l\'impostazione è disbailitata, l\'utente può vedere l\'oggetto SCORM ma la comunicazione dei dati non potrà avvenire.';
$string['forcejavascriptmessage'] = 'Per visualizzare questo oggetto è necessario JavaScript, per favore abilita JavaScript nel tuo browser e riprova';
$string['forcenewattempt'] = 'Forza un nuovo tentativo';
$string['forcenewattempt_help'] = 'Con Forza un nuovo tentativo ogni accesso al pacchetto SCORM sarà considerato un nuovo tentativo.';
$string['forcenewattemptdesc'] = 'Imposta il valore di default per l\'opzione  Forza un nuovo tentativo';
$string['found'] = 'Manifest trovato';
$string['frameheight'] = 'Imposta l\'altezza di default del frame o della finestra';
$string['framewidth'] = 'Imposta la larghezza standard del frame o della finestra';
$string['fullscreen'] = 'Schermo intero';
$string['general'] = 'Dati generali';
$string['gradeaverage'] = 'Media dei voti';
$string['gradeforattempt'] = 'Valutazione del tentativo';
$string['gradehighest'] = 'Voto migliore';
$string['grademethod'] = 'Metodo di valutazione';
$string['grademethod_help'] = 'Il metodo di valutazione definisce come valutare uno specifico tentativo.
Sono disponibili quattro metodi di valutazione:
* Learning object - Il numero di Learning object completati/superati.
* Voto migliore - Il voto più alto ottenuto nei Learning object superati
* Media dei voti - La media di tutti i voti
* Somma dei voti - La somma di tutti i voti';
$string['grademethoddesc'] = 'Imposta il valore di default per il metodo di valutazione';
$string['gradereported'] = 'Voto riportato';
$string['gradescoes'] = 'Learning object';
$string['gradesettings'] = 'Impostazioni di valutazione';
$string['gradesum'] = 'Somma dei voti';
$string['height'] = 'Altezza';
$string['hidden'] = 'Nascosta';
$string['hidebrowse'] = 'Nascondi l\'opzione Anteprima';
$string['hidebrowse_help'] = 'La modalità anteprima permette di visualizzare l\'attività prima di effettuare il tentativo vero e proprio. Se la modalità anteprima è disabilitata il pulsante Anteprima non sarà visibile.';
$string['hidebrowsedesc'] = 'Imposta il valore di default per l\'abilitazione o disabilitazione della modalità anteprima';
$string['hideexit'] = 'Nascondere il link (Esci dal corso)';
$string['hidenav'] = 'Nascondi i pulsanti di navigazione';
$string['hidenavdesc'] = 'Imposta il valore di default per l\'abilitazione o disabilitazione dei pulsanti di navigazione';
$string['hidereview'] = 'Nascondere il pulsante Rivedi';
$string['hidetoc'] = 'Visualizza nel player la struttura del corso';
$string['hidetoc_help'] = 'L\'impostazione determina come viene visualizzata la struttura del corso nel player SCORM';
$string['hidetocdesc'] = 'Imposta il valore di default per la visualizzazione della struttura del corso (TOC) nel player SCORM.';
$string['highestattempt'] = 'Tentativo migliore';
$string['identifier'] = 'Identificativo domanda';
$string['incomplete'] = 'Incompleto';
$string['info'] = 'Info';
$string['interactions'] = 'Interazioni';
$string['interactionscorrectcount'] = 'Numero di risultati corretti per la domanda';
$string['interactionsid'] = 'id dell\'elemento';
$string['interactionslatency'] = 'Il tempo trascorso tra il momento in cui l\'interazione<br /> è stata resa disponibile allo studente<br /> ed il momento in cui lo studente ha dato la prima risposta';
$string['interactionslearnerresponse'] = 'Risposta dello studente';
$string['interactionspattern'] = 'Modello di risposta corretta';
$string['interactionsresponse'] = 'Risposta dello studente';
$string['interactionsresult'] = 'Risultati basati sulle risposte date dallo studente e <br />le risposte corrette';
$string['interactionsscoremax'] = 'Valore massimo nell\'intervallo per il punteggio grezzo';
$string['interactionsscoremin'] = 'Valore minimo nell\'intervallo per il punteggio grezzo';
$string['interactionsscoreraw'] = 'Numero che da uanidea della performance dello studente<br />, relativo all\'intervallo confinato dai valori minimo e massimo.';
$string['interactionssuspenddata'] = 'Fornisce uno spazio per memorizzare e recuperare dati<br />tra le diverse sessioni dello studente';
$string['interactionstime'] = 'Orario di inizio del tentativo';
$string['interactionstype'] = 'Tipo di domanda';
$string['interactionsweight'] = 'Peso assegnato all\'elemento';
$string['invalidactivity'] = 'L\'attività SCORM è errata';
$string['invalidhacpsession'] = 'La sessione HACP non è valida';
$string['invalidmanifestresource'] = 'ATTENZIONE: le seguenti risorse sono presenti nel manifest ma non è stato possibile trovarle:';
$string['invalidurl'] = 'La URL specificata non è valida';
$string['last'] = 'Accesso più recente il';
$string['lastaccess'] = 'Accesso più recente';
$string['lastattempt'] = 'Ultimo tentativo completato';
$string['lastattemptlock'] = 'Blocca dopo l\'ultimo tentativo';
$string['lastattemptlock_help'] = 'Gli studenti non potranno più lanciare il player SCORM se avranno esaurito tutti i tentativi a loro disposizione.';
$string['lastattemptlockdesc'] = 'Imposta il valore di default per il blocco dopo il tentativo finale';
$string['location'] = 'Visualizza la barra dell\'indirizzo';
$string['max'] = 'Punteggio massimo';
$string['maximumattempts'] = 'Numero massimo di tentativi';
$string['maximumattempts_help'] = 'Imposta il numero massimo di tentativi consentitoi. Funziona solamente per pacchetti SCORM.2 e AICC.';
$string['maximumattemptsdesc'] = 'Imposta il valore di default per il numero massimo di tentativi';
$string['maximumgradedesc'] = 'Imposta il valore di default per il punteggio massimo dell\'attività';
$string['menubar'] = 'Visualizza la barra dei menu';
$string['min'] = 'Punteggio minimo';
$string['missing_attribute'] = 'Attributo mancante {$a->attr} nel tag {$a->tag}';
$string['missing_tag'] = 'Tag mancante {$a->tag}';
$string['missingparam'] = 'Parametro obbligatorio mancante o errato';
$string['mode'] = 'Modalità';
$string['modulename'] = 'Pacchetto SCORM';
$string['modulename_help'] = 'SCORM e AICC sono una serie di specifiche di interoperabilità, accessibilità e riuso di contenuti formativi web. Il modulo SCORM/AICC permette di inserire nei corsi pacchetti basati su questi standard.';
$string['modulenameplural'] = 'Pacchetti SCORM';
$string['navigation'] = 'Navigation';
$string['newattempt'] = 'Avvia un nuovo tentativo';
$string['next'] = 'Continua';
$string['no_attributes'] = 'Il tag {$a->tag} deve avere degli attributi';
$string['no_children'] = 'Il tag {$a->tag} deve avere dei figli';
$string['noactivity'] = 'Nessun report';
$string['noattemptsallowed'] = 'Numero di tentativi consentito';
$string['noattemptsmade'] = 'Numero di tentativi che hai effettuato';
$string['nolimit'] = 'Senza limite';
$string['nomanifest'] = 'Manifest non trovato';
$string['noprerequisites'] = 'Spiacente, non hai soddisfatto il numero previsto di  prerequisiti per accedere a questo learning object';
$string['noreports'] = 'Non ci sono report da visualizzare';
$string['normal'] = 'Normale';
$string['noscriptnoscorm'] = 'Il browser utilizzato non supporta javascript o ha il supporto javascript disabilitato. Questo pacchetto SCORM potrebbe non funzionare o non salvare correttamente i dati.';
$string['not_corr_type'] = 'Tipo sbagliato per il tag {$a->tag}';
$string['notattempted'] = 'Non tentato';
$string['notopenyet'] = 'Spiacente, questa attività non è disponibile fino al {$a}';
$string['objectives'] = 'Obiettivi';
$string['optallstudents'] = 'tutti gli utenti';
$string['optattemptsonly'] = 'solo utenti con tentativi';
$string['options'] = 'Opzioni (in alcuni browser non consentite)';
$string['optionsadv'] = 'Opzioni (Avanzate)';
$string['optionsadv_desc'] = 'Imposta le opzioni della finestra come opzioni avanzate.';
$string['optnoattemptsonly'] = 'solo utenti senza tentativi';
$string['organization'] = 'Organizzazione';
$string['organizations'] = 'Organizzazioni';
$string['othersettings'] = 'Impostazioni addizionali';
$string['othertracks'] = 'Altri tracciamenti';
$string['package'] = 'File del pacchetto';
$string['package_help'] = 'Il pacchetto è un file con estensione zip (o pif) che contiene la definizione di un corso in formato SCORM/AICC.';
$string['packagedir'] = 'Errore filesystem: non è possibile creare la cartella del pacchetto';
$string['packagefile'] = 'Non è stato specificato nessun pacchetto/manifest';
$string['packageurl'] = 'URL';
$string['packageurl_help'] = 'Permette di inserire un URL per lo SCORM invece di scegliere un pacchetto con il file picker.';
$string['page-mod-scorm-x'] = 'Qualsiasi pagina con modulo SCORM';
$string['pagesize'] = 'Dimensione pagina';
$string['passed'] = 'Superato';
$string['php5'] = 'PHP5 (libreria DOMXML nativa)';
$string['pluginadministration'] = 'Gestione SCORM/AICC';
$string['pluginname'] = 'Pacchetto SCORM';
$string['popup'] = 'Nuova finestra';
$string['popupmenu'] = 'In un menu a discesa';
$string['popupopen'] = 'Apri il pacchetto in una nuova finestra';
$string['popupsblocked'] = 'Le finestre sembra siano bloccate, impedendo di eseguire il modulo SCORM. Per favore prima di riprovare verifica le impostazioni del browser.';
$string['position_error'] = 'Il tag {$a->tag} non può essere figlio del tag {$a->parent}';
$string['preferencespage'] = 'Preferenze per questa pagina';
$string['preferencesuser'] = 'Preferenze per questo report';
$string['prev'] = 'Precedente';
$string['raw'] = 'Punteggio grezzo';
$string['regular'] = 'Manifest corretto';
$string['report'] = 'Report';
$string['reportcountallattempts'] = '{$a->nbattempts} tentativi per {$a->nbusers} utenti su {$a->nbresults} risultati';
$string['reportcountattempts'] = '{$a->nbresults} risultati ({$a->nbusers} utenti)';
$string['reports'] = 'Report';
$string['resizable'] = 'Permetti il ridimensionamento della finestra';
$string['result'] = 'Risultato';
$string['results'] = 'Risultati';
$string['review'] = 'Rivedi';
$string['reviewmode'] = 'Modalità revisione';
$string['scoes'] = 'Learning Object';
$string['score'] = 'Punteggio';
$string['scorm:deleteownresponses'] = 'Eliminare propri tentativi';
$string['scorm:deleteresponses'] = 'Eliminare tentativi SCORM';
$string['scorm:savetrack'] = 'Essere tracciato';
$string['scorm:skipview'] = 'Saltare pagina introduttiva';
$string['scorm:viewreport'] = 'Visualizzare report';
$string['scorm:viewscores'] = 'Visualizzare punteggi';
$string['scormclose'] = 'Al';
$string['scormcourse'] = 'Corso';
$string['scormloggingoff'] = 'API Logging: Off';
$string['scormloggingon'] = 'API Logging: On';
$string['scormopen'] = 'Dal';
$string['scormresponsedeleted'] = 'I tentativi degli utenti sono stati eliminati';
$string['scormtype'] = 'Tipo';
$string['scormtype_help'] = 'L\'impostazione stabilisce come sarà incluso il pacchetto nel corso. Sono disponibili 5 opzioni:
* Pacchetto caricato - Permette di scegliere un pacchetto SCORM tramite file picker
* Manifest SCORM esterno - Permette di specificare un URL per il file imsmanifest.xml. Nota: se l\'URL appartiene ad un dominio diverso rispetto a questo sito, è preferibile usare "Pacchetto da scaricare", altrimenti le valutazioni voti non saranno salvate.
* Pacchetto da scaricare - Permette di specificare l\' URL del pacchetto che sarà scaricato, decompresso localmente ed aggiornato se il pacchetto viene aggiornato.
* Repository locale IMS - Permette di scegliere un pacchetto da un repository IMS.
* URL AICC esterna - l\'URL di lancio per una attività AICC. Attorno all\'URL verrà costruito uno pseudo package';
$string['scrollbars'] = 'Permetti le barre di scorrimento';
$string['selectall'] = 'Seleziona tutto';
$string['selectnone'] = 'Deseleziona tutto';
$string['show'] = 'Visualizza';
$string['sided'] = 'Lateralmente';
$string['skipview'] = 'Gli studenti saltano la pagina con la struttura del pacchetto';
$string['skipview_help'] = 'L\'impostazione determina se saltare la pagina con la struttura del pacchetto SCORM. Se il pacchetto contiene un solo learning object, la pagina con la struttura può essere saltata sempre.';
$string['skipviewdesc'] = 'Imposta il valore di default per saltare o meno la pagina con la struttura del pacchetto';
$string['slashargs'] = 'ATTENZIONE: l\'opzione slash argument non è abilitata, alcune funzioni potrebbero non comportarsi correttamente.';
$string['stagesize'] = 'Dimensione Frame/Finestra';
$string['stagesize_help'] = 'Queste due impostazioni determinano la dimensione della finestra di visualizzazione del Learning Object.';
$string['started'] = 'Iniziato il';
$string['status'] = 'Stato';
$string['statusbar'] = 'Visualizza la barra di stato';
$string['student_response'] = 'Risposta';
$string['subplugintype_scormreport'] = 'Report';
$string['subplugintype_scormreport_plural'] = 'Report';
$string['suspended'] = 'Sospeso';
$string['syntax'] = 'Errore di sintassi';
$string['tag_error'] = 'Tag sconosciuto ({$a->tag}) con questo valore: {$a->value}';
$string['time'] = 'Tempo';
$string['timerestrict'] = 'Limita il periodo dei tentativi';
$string['title'] = 'Titolo';
$string['toc'] = 'TOC';
$string['too_many_attributes'] = 'Il tag {$a->tag} ha troppi attributi';
$string['too_many_children'] = 'Il tag {$a->tag} ha troppi figli';
$string['toolbar'] = 'Visualizza la barra degli strumenti';
$string['totaltime'] = 'Tempo';
$string['trackingloose'] = 'ATTENZIONE: I dati di tracciamento esistenti saranno eliminati!';
$string['type'] = 'Tipo';
$string['typeaiccurl'] = 'URL AICC esterna';
$string['typeexternal'] = 'Manifest SCORM esterno';
$string['typeimsrepository'] = 'Content repository IMS locale';
$string['typelocal'] = 'Pacchetto caricato';
$string['typelocalsync'] = 'Pacchetto da scaricare';
$string['unziperror'] = 'Errore durante la decompressione del pacchetto';
$string['updatefreq'] = 'Frequenza auto-aggiornamento';
$string['updatefreq_help'] = 'Permette di scaricare ed aggiornare automaticamente il pacchetto esterno.';
$string['updatefreqdesc'] = 'Imposta il valore di default per l\'auto-aggiornamento';
$string['validateascorm'] = 'Valida un pacchetto';
$string['validation'] = 'Risultati della validazione';
$string['validationtype'] = 'L\'impostazione determina la libreria DOMXML usata per validare il manifest SCORM. Se non lo sai lascia l\'impostazione al suo default.';
$string['value'] = 'Valore';
$string['versionwarning'] = 'La versione del manifest è precedente alla 1.3, avviso rilevato al tag {$a->tag}';
$string['viewallreports'] = 'Visualizza lo stato dei {$a} tentativi';
$string['viewalluserreports'] = 'Visualizza il report per {$a} utenti';
$string['whatgrade'] = 'Valutazione tentativi';
$string['whatgrade_help'] = 'Se sono consentiti più tentativi, con questa impostazione è possibile stabilire cosa memorizzare nel registro valutatore: il voto più alto, la media, il primo o l\'ultimo tentativo.
Gestione di tentativi multipli
* Per avviare un nuovo tentativo è necessario spuntare la relativa casella sopra il pulsante Entra nella pagina con la struttura del corso. Accertarsi di consentire l\'accesso a questa pagina se si desidera consentire più tentativi.
* Alcuni pacchetti gestiscono bene i nuovi tentativi mentre altri no. Nel secondo caso si può verificare una sovra scrittura dei dati se lo studente entra nuovamente nello stesso tentativo, anche se il tentativo risulta "completato" o "superato".
* Le impostazioni "Forza completamento", "Forza un nuovo tentativo" e "Blocca dopo l\'ultimo tentativo" permettono di gestire al meglio i tentativi multipli.';
$string['whatgradedesc'] = 'Imposta il metodo di default per la valutazione dei tentativi';
$string['width'] = 'Larghezza';
$string['window'] = 'Finestra';
