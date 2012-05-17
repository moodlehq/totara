<?php
// totara_cohort.php - created with Totara langimport script version 1.1

$string['abouttocreate'] = 'Si sta per creare una nuova coorte chiamata "{$a}"';
$string['addcohort'] = 'Crea nuova coorte';
$string['anycohort'] = 'Qualsiasi';
$string['assign'] = 'Assegna';
$string['assignmemberstocohort'] = 'Assegna membri alla coorte';
$string['assignto'] = 'Membri della coorte "{$a}"';
$string['backtocohorts'] = 'Torna alle coorti';
$string['cannoteditcohort'] = 'Questa coorte non può essere modificata una volta creata';
$string['childrenincluded'] = 'secondari inclusi';
$string['clear'] = 'Annulla';
$string['cohort'] = 'Coorte';
$string['cohort:assign'] = 'Assegna i membri della coorte';
$string['cohort:manage'] = 'Gestisci coorte';
$string['cohort:view'] = 'Usa le coorti e visualizza i membri';
$string['cohortmembers'] = 'Membri di coorte';
$string['cohorts'] = 'Coorti';
$string['cohortsin'] = 'Coorti disponibili';
$string['component'] = 'Origine';
$string['confirmdynamiccohortcreation'] = 'Conferma creazione coorte dinamica';
$string['createdynamiccohort'] = 'Crea coorte dinamica';
$string['createnewcohort'] = 'Crea nuova coorte';
$string['criteria'] = 'Criteri';
$string['criteriaoptional'] = 'Tutti i criteri sono opzionali ma occorre selezionare almeno un\'opzione';
$string['currentusers'] = 'Utenti correnti';
$string['currentusersmatching'] = 'Utenti correnti corrispondenti';
$string['delcohort'] = 'Elimina coorte';
$string['delconfirm'] = 'Si desidera eliminare la coorte \'{$a}\'?';
$string['deletethiscohort'] = 'Elimina questa coorte';
$string['description'] = 'Descrizione';
$string['duplicateidnumber'] = 'Esiste già una coorte con lo stesso numero ID';
$string['dynamic'] = 'Dinamico';
$string['dynamiccohortcriteria'] = 'Criteri di coorte dinamici';
$string['dynamiccohortcriterialower'] = 'Criteri di coorte dinamici';
$string['editcohort'] = 'Modifica coorte';
$string['editdetails'] = 'Modifica dettagli';
$string['editmembers'] = 'Modifica membri';
$string['failedtodeleted'] = 'Impossibile eliminare la coorte';
$string['idnumber'] = 'ID';
$string['includechildren'] = 'Includi secondari';
$string['members'] = 'Membri';
$string['memberscount'] = 'Dimensione';
$string['mustselectonecriteria'] = 'Occorre selezionare almeno un criterio';
$string['name'] = 'Nome';
$string['nocomponent'] = 'Creato manualmente';
$string['nocriteriaset'] = '(nessun criterio impostato, eliminare questa coorte)';
$string['notvalidprofilefield'] = 'Selezionare un campo di profilo valido';
$string['organisation'] = 'Organizzazione';
$string['overview'] = 'Panoramica';
$string['pleasesearchmore'] = 'Affinare la ricerca';
$string['pleaseusesearch'] = 'Usare questa ricerca';
$string['position'] = 'Posizione';
$string['potusers'] = 'Utenti potenziali';
$string['potusersmatching'] = 'Potenziali utenti corrispondenti';
$string['role'] = 'Ruolo';
$string['selectfromcohort'] = 'Seleziona i membri dalla coorte';
$string['set'] = 'Impostazione';
$string['successfullyaddedcohort'] = 'Coorte aggiunta con successo';
$string['successfullydeleted'] = 'Coorte eliminata con successo';
$string['successfullyupdated'] = 'Coorte aggiornata con successo';
$string['thiscohortwillhave'] = 'Questa coorte avrà {$a} membri in questo momento';
$string['toomanyusersmatchsearch'] = 'Troppi utenti corrispondono alla ricerca';
$string['toomanyuserstoshow'] = 'Ci sono troppi utenti visualizzati';
$string['type'] = 'Tipo';
$string['userprofilefield'] = 'Campo profilo utente';
$string['values'] = 'Valori';
$string['viewmembers'] = 'Visualizza membri';
$string['type_help'] = '<h1>Tipo di coorte</h1>

<p>Il tipo di coorte può essere \'fisso\' o \'dinamico\'.</p>
<p>Le coorti fisse sono un elenco predefinito di utenti, creati manualmente dal creatore di coorte. Il creatore può aggiungere o rimuovere gli utenti ma altrimenti l\'elenco è statico.</p>
<p>Le coorti dinamiche sono determinate da una regola o set di regole e gli utenti inclusi nella coorte aggiornano dinamicamente per includere gli utenti che corrispondono a quelle regole (e rimuovere gli utenti che non corrispondono).</p>
<p>I membri di una coorte fissa possono essere modificati in qualsiasi momento, ma le regole che definiscono una coorte dinamica non possono essere modificate quando la coorte è stata salvata.</p>';
$string['profilefieldvalues_help'] = '<h1>Valori del campo di profilo di coorte</h1>

<p>Se selezionato, i membri della coorte dinamica saranno scelti in base a quelli che hanno un campo di profilo utente che corrisponde a un particolare valore.</p>
<p>I valori possono essere una singola stringa di testo o un elenco separato da virgola di diverse stringhe di testo. Se un elenco separato da virgola è fornito, gli utenti che corrispondono alle stringhe individuali saranno inclusi nella coorte.</p>';
$string['positionincludechildren_help'] = '<h1>Coorte include le posizioni secondarie</h1>

<p>Se la casella di controllo \'Includi secondari\' è selezionata tutti gli utenti nella posiizone selezionata e tutte le posizioni sotto la posizione selezionata nella gerarchia sono visualizzati in questa coorte.</p>
<p>Se \'Includi secondari\' non è selezionato, soltanto gli utenti cui è assegnata la posizione esatta selezionata saranno assegnati alla coorte.</p>';
$string['orgincludechildren_help'] = '<h1>Coorte includi organizzazioni secondarie</h1>

<p>Se la casella di controllo \'Includi secondari\' è selezionata, tutti gli utenti nell\'organizzazione selezionata e un\'organizzazione sotto all\'organizzazione selezionata nella gerarchia sarà visualizzata nella coorte.</p>
<p>Se \'Includi secondari\' non è selezionato, soltanto gli utenti cui è assegnata l\'organizzazione selezionata saranno assegnati alla coorte.</p>';

?>
