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
 * Strings for component 'certificate', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = 'Aggiungi un\'altra opzione di attività collegata';
$string['addlinktitle'] = 'Fare clic per aggiungere un\'opzione di attività collegata';
$string['awarded'] = 'Premiato';
$string['awardedto'] = 'Premiato a';
$string['back'] = 'Indietro';
$string['border'] = 'Confine';
$string['borderblack'] = 'Nero';
$string['borderblue'] = 'Blu';
$string['borderbrown'] = 'Marrone';
$string['bordercolor'] = 'Linee dei bordi';
$string['bordergreen'] = 'Verde';
$string['borderlines'] = 'Linee';
$string['borderstyle'] = 'Immagine del bordo';
$string['certificate'] = 'Verifica del codice di certificato:';
$string['certificate:manage'] = 'Gestisci certificato';
$string['certificate:printteacher'] = 'Stampa docente';
$string['certificate:student'] = 'Ottieni certificato';
$string['certificate:view'] = 'Visualizza certificato';
$string['certificatename'] = 'Nome di certificato';
$string['certificatereport'] = 'Report dei certificati';
$string['certificatesfor'] = 'Certificati per';
$string['certificatetype'] = 'Tipo di certificato';
$string['code'] = 'Codice';
$string['course'] = 'Per';
$string['coursegrade'] = 'Grado del corso';
$string['coursename'] = 'Corso';
$string['credithours'] = 'Ore di credito';
$string['customtext'] = 'Testo personalizzato';
$string['customtext_help'] = '<p align="center">
  <b>Testo personalizzato</b>
</p>

Se si desidera che il certificato sia stampato con nomi diversi per il formatore rispetto a quellli assegnati al ruolo di formatore, non selezionare Stampa formatore o altra immagine di firma, eccetto l\'immagine della riga. Immettere i nomi dei formatori in questo riquadro di testo come li si desidera visualizzare. Per impostazione predefinita, questo testo è collocato in basso a sinistra del certificato. E\' possibile modificare la posizione nel file certificato/tipo/"nome di tipo"/certificate.php. 

In quel file, individuare la linea di codice simile a questa in fondo alla pagina:

cert_printtext(150, 450, \'\', \'\', \'\', \'\', \'\'); 

I due numeri riflettono la posizione di X (dalla sinistra) e di Y (dal basso all\'alto) per il testo. E\' possibile modificare tali valori come desiderato. 

E\' anche possibile usare il riquadro di testo per immettere html. Ad esempio, si può aggiungere un link o un\'immagine.

<div style="border: 1px solid black;font-size: 12px">
  Sono disponibili i seguenti tag html: <ul type="square">
    <li>
      <br> and <p>
    </li>
    <li>
      <b>, <i> and <u>
    </li>
    <li>
      <img> (src e larghezza (o altezza) sono obbligatori)
    </li>
    <li>
      <a> (href è obbligatorio)
    </li>
    <li>
      <font>: possibili attributi sono:<br /> color: codice di colore hex<br /> face: arial, times, courier, helvetica, symbol
    </li>
  </ul>
</div>

Example html:

Mr. James Salesman, Manager<br><br>Sales Department<br><br><font color="#0000CC"><b>Your Company<font face="Symbol">&Ograve;</font></b></font><img src="http://yourmoodle.com/mod/certificate/pix/seals/Logo.png" width="100"><p><a href="http://www.site.com target="_blank">Click here</a></p>';
$string['date'] = 'Il';
$string['datefmt_help'] = '<p align="center">
  <b>Stampa data</b>
</p>

Scegli un formato di data per stampare la data sul certificato.';
$string['datehelp'] = 'Data';
$string['delivery_help'] = '<p align="center">
  <b>Modalità di emissione</b>
</p>

Scegliere qui come si desidera che gli studenti ricevano il loro certificato.

**Apri nel browser:** apre il certificato in una nuova finestra del browser.   
**Forza download:** apre la finestra di download del file del browser. **(Nota: **Internet Explorer non supporta l\'opzione di apertura dalla finestra di download. L\'opzione di salvataggio deve essere selezionata).  
**Invia certificato per e-mail:** scegliendo questa opzione il certificato viene inviato per e-mail allo studente in allegato.

Dopo che uno studente riceve il certificato, se fanno clic sul link del certificato, visualizzano la data in cui hanno ricevuto il certificato e saranno in grado di rivedere il certificato ricevuto.';
$string['designoptions'] = 'Opzioni di sviluppo';
$string['download'] = 'Forza download';
$string['emailcertificate'] = 'E-mail (ricordarsi di salvare)';
$string['emailothers'] = 'E-mail altri';
$string['emailothers_help'] = '<p align="center">
  <b>Inviare allerte e-mail agli altri</b>
</p>

Inserire qui gli indirizzi e-mail, separati da virgola, degli utenti che si desiderano avvisare con un breve messaggio quando gli studenti ricevono un certificato.';
$string['emailstudenttext'] = 'Allegato il certificato per {$a->course}.';
$string['emailteachermail'] = '{$a->student} hanno ricevuto il loro certificato: \'{$a->certificate}\'
for {$a->course}.

Per visualizzarlo, andare a:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->student} hanno ricevuto il loro  certificato: \'<i>{$a->certificate}</i>\'
for {$a->course}.

Per visualizzarlo, andare a:

<a href="{$a->url}">Report di certificato</a>.';
$string['emailteachers'] = 'E-mail formatore';
$string['emailteachers_help'] = '<p align="center">
  <b>Allerte e-mail ai formatori</b>
</p>

Se abilitato, i formatori sono notificati con una breve e-mail quando gli studenti ricevono un certificato.';
$string['entercode'] = 'Inserire un codice di certificato per verificare:';
$string['getcertificate'] = 'Ottieni il certificato';
$string['grade'] = 'Grado';
$string['gradedate'] = 'Data di grado';
$string['gradefmt_help'] = '<p align="center">
  <strong>Formato di voto</strong>
</p>

<p align="left">
  Ci sono tre formati disponibili se si sceglie di stampare un voto sul certificato:
</p>

<p align="left">
  <strong>Voto percentuale:</strong> stampa il voto come percentuale.<strong><br /> Voto a punti: </strong>stampa il valore in punti del voto. <br /> <strong>Voto in lettere:</strong> stampa il voto in lettera. I valori per i voti in formato lettera possono essere personalizzati in type/certificate.php.
</p>';
$string['gradeletter'] = 'Grado di lettera';
$string['gradepercent'] = 'Grado di percentuale';
$string['gradepoints'] = 'Grado di punti';
$string['incompletemessage'] = 'Per scaricare il certificato, occorre completare tutte le attività richieste. Tornare al corso per completare il lavoro';
$string['intro'] = 'Introduzione';
$string['issued'] = 'Emesso';
$string['issueoptions'] = 'Opzioni di emissione';
$string['lockingoptions'] = 'Opzioni di blocco';
$string['modulename'] = 'Certificato';
$string['modulenameplural'] = 'Certificati';
$string['mycertificates'] = 'I miei certificati';
$string['nocertificatesreceived'] = 'non ha ricevuto alcun certificato di corso';
$string['nogrades'] = 'Nesun grado disponibile';
$string['notapplicable'] = 'N/D';
$string['notfound'] = 'Il numero di certificato non può essere validato';
$string['notissued'] = 'Non ricevuto';
$string['notissuedyet'] = 'Non emesso';
$string['notreceived'] = 'Non si sono ricevuti certificati';
$string['openbrowser'] = 'Apri in una nuova finestra';
$string['opendownload'] = 'Fare clic sul pulsante di seguito per salvare il certificato sul computer';
$string['openemail'] = 'Fare clic sul pulsante di seguito e il certificato verrà inviato per allegato e-mail';
$string['openwindow'] = 'Fare clic sul pulsante di seguito per aprire il certificato in una nuova finestra del browser';
$string['printdate'] = 'Stampa data';
$string['printdate_help'] = '<p align="center">
  <b>Stampa data</b>
</p>

E\' la data che viene stampata, se viene selezionata una data di stampa. Se la data di fine del corso è selezionata, è necessario abilitare l\'intervallo della data e impostare la data di fine del corso nelle impostazioni del corso. Se la data di fine del corso non è impostata, verrà stampata la data ricevuta. Si può anche scegliere di stampare la data di un\'attività che ha un voto. Se un certificato è emesso prima che l\'attività viene valutata, verrà stampata la data ricevuta. 

Si noti che una volta che la data è stampata su un certificato, non può essere modificata eccetto se si è personalizzato il file type/certificate.php.';
$string['printerfriendly'] = 'Pagina stampabile';
$string['printgrade'] = 'Grado di stampa';
$string['printhours'] = 'Stampa ore di credito';
$string['printhours_help'] = '<p align="center">
  <b>Stampa delle ore di credito</b>
</p>

Inserire qui il numero delle ore di credito da stampare sul certificato.';
$string['printnumber_help'] = '<p align="center">
  <b>Stampa di un numero di codice</b>
</p>

Un codice unico di 10 cifre di lettere e numeri casuali può essere stampato sul certificato. Questo numero può essere verificato confrontandolo con il numero di codice visualizzato nel report del formatore "Visualizza certificati emessi".';
$string['printoutcome'] = 'Risultato di stampa';
$string['printseal'] = 'Immagine del timbro o del logo';
$string['printsignature'] = 'Immagine della firma';
$string['printteacher'] = 'Stampa nome(i) del docente';
$string['printteacher_help'] = '<p align="center">
  <b>Stampa di formatore</b>
</p>

Per stampare il nome di un formatore sul certificato, impostare il ruolo di formatore a livello del modulo. Farlo ad esempio se ci sono più formatori per il corso o se ci sono più di un certificato e si desiderano stampare diversi nomi di formatori su ciascun certificato. Fare clic su modifica il certificato e sulla scheda Ruoli assegnati localmente. Assegnare il ruolo di formatore (modificare il formatore) sul certificato (non devono essere un formatore nel corso, si può assegnare il ruolo a chiunque). I nomi sono stampati sul certificato per il formatore.';
$string['printwmark'] = 'Immagine in filigrana';
$string['receivedcerts'] = 'Certificati ricevuti';
$string['receiveddate'] = 'Data ricevuta';
$string['report'] = 'Report';
$string['reportcert_help'] = '<p align="center">
  <b>Report dei certificati</b>
</p>

Se si seleziona Si, la data di ricezione del certificato, il numero di codice e il nome di corso sono visualizzati sui report di certificato dell\'utente. Se si sceglie di stampare un voto su questo certificato, il voto viene visualizzato sul report del certificate.';
$string['reviewcertificate'] = 'Rivedi il certificato';
$string['sigline'] = 'linea';
$string['textoptions'] = 'Opzioni di testo';
$string['to'] = 'Rilasciato il';
$string['validate'] = 'Verifica';
$string['verifycertificate'] = 'Verifica certificato';
$string['viewcertificateviews'] = 'Visualizza {$a} certificati rilasciati';
$string['viewed'] = 'Il certificato è stato emesso in data:';
$string['viewtranscript'] = 'Visualizza certificati';
