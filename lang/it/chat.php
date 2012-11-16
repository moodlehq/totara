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
 * Strings for component 'chat', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   chat
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['ajax'] = 'Versione Ajax';
$string['autoscroll'] = 'Scorrimento automatico';
$string['beep'] = 'campanella';
$string['cantlogin'] = 'Non è stato possibile collegarsi alla chat!';
$string['chat:chat'] = 'Entrare in una chat';
$string['chat:deletelog'] = 'Rimuovere i log delle chat';
$string['chat:exportparticipatedsession'] = 'Esportare sessioni chat alle quali si è partecipato';
$string['chat:exportsession'] = 'Esportare qualsiasi sessione chat';
$string['chat:readlog'] = 'Leggere i log delle chat';
$string['chat:talk'] = 'Parlare in chat';
$string['chatintro'] = 'Testo introduttivo';
$string['chatname'] = 'Nome della chat';
$string['chatreport'] = 'Sessioni di chat';
$string['chattime'] = 'Orario della chat';
$string['configmethod'] = 'Il metodo chat ajax fornisce una chat basata su ajax che contatta il server con regolarità per ricevere gli aggiornamenti. Il metodo normale prevede che i client contattino il server per ottenere gli aggiornamenti. Il metodo normale non richiede configurazione e funziona sempre, tuttavia con molti client collegati contemporaneamente alla chat si potrebbe generare un sovraccarico sul server. Il metodo server chat per essere configurato necessita di accesso ad una shell Unix, ma è molto più veloce e scalabile.';
$string['confignormalupdatemode'] = 'Gli aggiornamenti delle chat sono forniti in modo efficiente utilizzando la funzionalità <em>Keep-Alive</em> dell\'HTTP 1.1, tuttavia questo metodo è gravoso per il server. Un metodo di aggiornamento più avanzato è lo <em>Stream</em>. Il metodo <em>Stream</em> permette di scalare meglio (similmente al Server chat) ma il tuo server potrebbe non supportarlo.';
$string['configoldping'] = 'Tempo massimo per individuare la disconnessione dalla chat di un partecipante (in secondi). Rappresenta un tempo limite, in genere le disconnessioni vengono individuate molto rapidamente. Valori bassi aumentano il carico sul server. Se usi il Metodo normale, questo valore <strog>non deve essere mai inferiore</strong> a 2 * chat_refresh_room.';
$string['configrefreshroom'] = 'Tempo di aggiornamento della chat (in secondi). Impostando un valore basso i tempi di risposta della chat saranno più brevi ma a spese di un carico molto maggiore sul server in presenza di molte connessioni contemporanee. Se utilizzi il Metodo di aggiornamento <em>Stream</em> puoi impostare un valore di aggiornamento più basso, ad esempio 2.';
$string['configrefreshuserlist'] = 'Tempo di aggiornamento dell\'elenco dei partecipanti alla chat (in secondi)';
$string['configserverhost'] = 'Il nome dell\'host dove gira il demone chat';
$string['configserverip'] = 'Indirizzo IP corrispondente al l\'host soprastante';
$string['configservermax'] = 'Numero massimo di utenti ammessi';
$string['configserverport'] = 'Porta del server usata dal demone chat';
$string['currentchats'] = 'Sessioni di chat attive';
$string['currentusers'] = 'Utenti attivi';
$string['deletesession'] = 'Elimina questa sessione';
$string['deletesessionsure'] = 'Sei sicuro di voler eliminare questa sessione?';
$string['donotusechattime'] = 'Senza pubblicare l\'orario';
$string['enterchat'] = 'Entra nella chat';
$string['errornousers'] = 'Non riesco a trovare utenti!';
$string['explaingeneralconfig'] = 'Impostazioni comuni valide con <strong>qualsiasi</strong> metodo di chat';
$string['explainmethoddaemon'] = 'Impostazioni valide <strong>solo</strong> se si sceglie "Server chat" in chat_method';
$string['explainmethodnormal'] = 'Impostazioni valide <strong>solo</strong> se si sceglie  "Metodo standard" in chat_method';
$string['generalconfig'] = 'Configurazione generale';
$string['idle'] = 'Inattivo';
$string['inputarea'] = 'Area di input';
$string['invalidid'] = 'Non è stato possibile trovare la chat!';
$string['list_all_sessions'] = 'Elenca tutte le sessioni';
$string['list_complete_sessions'] = 'Elenca solo  le sessioni terminate';
$string['listing_all_sessions'] = 'Elenco di tutte le sessioni';
$string['messagebeepseveryone'] = '{$a} richiama tutti!';
$string['messagebeepsyou'] = '{$a} ti ha richiamato!';
$string['messageenter'] = '{$a} è entrato nella chat';
$string['messageexit'] = '{$a} ha lasciato la chat';
$string['messages'] = 'Messaggi';
$string['messageyoubeep'] = 'Hai richiamato {$a}';
$string['method'] = 'Metodo chat';
$string['methodajax'] = 'Metodo Ajax';
$string['methoddaemon'] = 'Server chat';
$string['methodnormal'] = 'Metodo standard';
$string['modulename'] = 'Chat';
$string['modulename_help'] = 'Il modulo chat permette di collaborare in modo sincrono via web. E\' molto utile per avere una punto di vista diverso sugli altri mentre si discute su un argomento in quanto l\'interazione è molto diversa da quella riscontrabile nei forum asincroni.';
$string['modulenameplural'] = 'Chat';
$string['neverdeletemessages'] = 'Sempre';
$string['nextsession'] = 'Prossima sessione programmata';
$string['no_complete_sessions_found'] = 'Non ci sono sessioni terminate.';
$string['nochat'] = 'Non sono state trovate chat';
$string['noguests'] = 'La chat non è disponibile agli ospiti';
$string['nomessages'] = 'Non ci sono ancora messaggi';
$string['nopermissiontoseethechatlog'] = 'Non sei autorizzato a visualizzare i log della chat';
$string['normalkeepalive'] = 'KeepAlive';
$string['normalstream'] = 'Stream';
$string['noscheduledsession'] = 'Nessuna sessione programmata';
$string['notallowenter'] = 'Non sei autorizzato ad entrare nella chat';
$string['notlogged'] = 'Non sei autenticato!';
$string['oldping'] = 'Timeout disconnessione';
$string['page-mod-chat-x'] = 'Qualsiasi pagina con chat';
$string['pastchats'] = 'Sessioni di chat svolte';
$string['pluginadministration'] = 'Gestione Chat';
$string['pluginname'] = 'Chat';
$string['refreshroom'] = 'Aggiornamento chat';
$string['refreshuserlist'] = 'Aggiornamento elenco utenti';
$string['removemessages'] = 'Rimuovi tutti i messaggi';
$string['repeatdaily'] = 'Alla stessa ora tutti i giorni';
$string['repeatnone'] = 'Senza ripetizione - solo all\'orario specificato';
$string['repeattimes'] = 'Ripeti le sessioni di chat';
$string['repeatweekly'] = 'Alla stessa ora tutte le settimane';
$string['saidto'] = 'detto a';
$string['savemessages'] = 'Mantieni sessioni di chat svolte per';
$string['seesession'] = 'Visualizza questa sessione';
$string['send'] = 'Invia';
$string['sending'] = 'Invio in corso';
$string['serverhost'] = 'Nome server';
$string['serverip'] = 'Server IP';
$string['servermax'] = 'Max. numero utenti';
$string['serverport'] = 'Porta server';
$string['sessions'] = 'Sessioni chat';
$string['sessionstart'] = 'La sessione di chat inizierà in {$a}';
$string['strftimemessage'] = '%H:%M';
$string['studentseereports'] = 'Tutti i partecipanti possono visualizzare le sessioni svolte';
$string['studentseereports_help'] = 'Impostando a No, solo gli utenti con il privilegio mod/chat:readlog potranno visualizzare i log delle chat';
$string['talk'] = 'Parla';
$string['updatemethod'] = 'Metodo aggiornamento';
$string['updaterate'] = 'Velocità di aggiornamento:';
$string['userlist'] = 'Elenco utenti';
$string['usingchat'] = 'Usano la chat';
$string['usingchat_help'] = 'Il modulo Chat contiene alcune caratteristiche che rendono l\'attività più gradevole.
* Faccine - Come in molte altre parti di Moodle, le faccine (emoticon) possono essere usate anche nella chat. Ad esempio, :-)
* Link - Gli indirizzi Internet verranno trasformati automaticamente in hyperlink.
* Emozioni - E\' possibile inserire testo preceduto da "/me" or ":" per manifestare emozioni. Per esempio, se il tuo nome è Mario e scrivi ":ride!" o "/me ride!" nella chat apparirà "Mario ride!"
* Campanella - E\' possibile inviare un suono ad una persona cliccando su "campanella" accanto al nome del destinatario. Per inviare simultaneamente il suono a tutti i partecipanti alla Chat è possibile è scrivere "beep all".
* HTML - E\' possibile usare l\'HTML per inserire immagini, riprodurre suoni e modificare la dimensione ed il colore del teso.';
$string['viewreport'] = 'Visualizza le sessioni già svolte';
