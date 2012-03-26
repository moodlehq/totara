<?php
// hierarchy.php - created with Totara langimport script version 1.1

$string['additionaloptions'] = 'Opzioni aggiuntive';
$string['allframeworks'] = 'Tutti i framework';
$string['alltypes'] = 'Tutti i tipi';
$string['assign'] = 'Assegna';
$string['availablex'] = '{$a} disponibile';
$string['bulkactions'] = 'Azioni in blocco';
$string['bulkaddfailed'] = 'Si è verificato un errore nell\'aggiunta di questi elementi alla gerarchia';
$string['bulkaddsuccess'] = '{$a} elementi sono stati aggiunti con successo alla gerarchia';
$string['bulktypechanges'] = 'Riclassificazione in blocco';
$string['bulktypechangesdesc'] = 'Riclassifica di tutti gli elementi dal tipo:';
$string['cancelwithoutassigning'] = 'Annulla senza assegnazione';
$string['changetype'] = 'Modifica tipo';
$string['child'] = 'secondario';
$string['children'] = 'secondari';
$string['choosewhattodowithdata'] = 'Scegliere cosa fare con i dati del campo personalizzato:';
$string['clearsearch'] = 'Annulla ricerca';
$string['clearselection'] = 'Annulla selezione';
$string['confirmmoveitems'] = 'Spostare {$a->num} {$a->items} su "{$a->parentname}"?<br /><br />Tutti i secondari di {$a->items} che vengono spostati saranno allo stesso tempo riassegnati.';
$string['confirmproceed'] = 'Continuare?';
$string['confirmtypechange'] = 'Riclassificare gli elementi e trasferire/eliminare i dati';
$string['currenttype'] = 'Tipo corrente';
$string['customfields'] = 'Campi personalizzati';
$string['datainx'] = 'Dati in {$a}:';
$string['deletecheckdepth'] = 'Si è certi di voler eliminare completamente questo livello di profondità?';
$string['deletechecktype'] = 'Si è certi di voler eliminare completamente questo tipo?';
$string['deletedataconfirmproceed'] = 'DAto che la nuova classe non ha campi personalizzati, questa operazione eliminerà tutti i dati relativi ai seguenti campi personalizzati:{$a}Se si desidera trasferire i dati al nuovo tipo, creare i campi personalizzati appropriati nel nuovo tipo prima di eseguire la riclassificazione. Si desidera continuare?';
$string['deleteddepth'] = 'Il livello di profondità {$a} è stato eliminato.';
$string['deletedepthhaschildren'] = 'Impossibile eliminare il livello di profondità perché in esso sono presenti degli elementi.';
$string['deletedepthnosuchdepth'] = 'IDi di livello di profondità errato. Riprovare.';
$string['deletedepthnotdeepest'] = 'Impossibile eliminare questo livello di profondità perché ci sono livelli di profondità inferiori nello stesso framework.';
$string['deletedtype'] = 'Il tipo "{$a}" è stato eliminato.';
$string['deleteselectedx'] = 'Eliminare {$a} selezionato';
$string['deletethisdata'] = 'Eliminare questo dato';
$string['deletetypenosuchtype'] = 'ID di tipo errato. Riprovare.';
$string['depth'] = 'Profondità {$a}';
$string['depths'] = 'Profondità';
$string['displayoptions'] = 'Opzioni di visualizzazione';
$string['enternamesoneperline'] = 'Immettere i nomi {$a} (uno per riga)';
$string['error:alreadyassigned'] = 'Sono già stati assegnati dei dati a questo campo.';
$string['error:badsortorder'] = 'Impossibile spostare {$a}. Possibile errore nei comandi di ordinamento.';
$string['error:cannotconvertfieldfromxtoy'] = 'Impossibile convertire i campi "{$a->from}" in campi "{$a->to}".';
$string['error:cannotmoveparentintochild'] = 'Impossibile spostare {$a->item}" nel proprio secondario "{$a->newparent}"';
$string['error:checkvariable'] = 'La variabile di controllo era errata. Riprovare.';
$string['error:couldnotmoveitem'] = 'Impossibile spostare {$a}. Errore nell\'aggiornamento del database.';
$string['error:couldnotmoveitemnopeer'] = 'Impossibile spostare {$a}. Non ci sono elementi adiacenti nello stesso livello di profondità con cui effettuare lo scambio.';
$string['error:couldnotreclassifybulk'] = 'Si è verificato un errore nella riclassificazione degli elementi da "{$a->from}" a "{$a->to}"';
$string['error:couldnotreclassifyitem'] = 'Si è verificato un errore nella riclassificazione di quell\'elemento da "{$a->from}" a "{$a->to}"';
$string['error:couldnotupgradehierarchyduetobaddata'] = 'Impossibile aggiornare la gerarchia a causa di dati ({$a}) errati';
$string['error:deletedepthcheckvariable'] = 'La variabile di controllo era errata. Riprovare.';
$string['error:deletetypecheckvariable'] = 'La variabile di controllo era errata. Riprovare.';
$string['error:failedbulkmove'] = 'Si è verificato un errore durante lo spostamento di questi elementi';
$string['error:hierarchyprefixnotfound'] = 'Impossibile trovare il prefisso di gerarchia {$a}';
$string['error:hierarchytypenotfound'] = 'Impossibile trovare il tipo di gerarchia {$a}';
$string['error:invaliditemid'] = 'ID di elemento non valido';
$string['error:invalidparentformove'] = 'La posizione in cui si sta spostando l\'elemento non esiste';
$string['error:nodeletescaleinuse'] = 'Impossibile eliminare una scala in uso. Per eliminare questa scala, non deve essere assegnata ad alcun framework.';
$string['error:nodeletescalevalueinuse'] = 'Impossibile eliminare un valore di scala da una scala in uso. Per eliminare questo valore di scala, essa non deve essere assegnata ad alcun framework.';
$string['error:noframeworksfound'] = 'Non è stato trovato alcun framework {$a} con uno o più livelli di profondità';
$string['error:noitemsselected'] = 'Non è stato selezionato alcun elemento';
$string['error:nonedeleted'] = 'Non è stato possibile eliminare alcun  {$a} selezionato';
$string['error:nonefoundbulk'] = 'Non ci sono elementi di quel tipo da convertire';
$string['error:nonefounditem'] = 'L\'elemento non sembra appartenere al tipo specificato';
$string['error:noreorderscaleinuse'] = 'Impossibile riordinare una scala in uso. Per riordinare questa scala, essa non deve essere assegnata a un framework.';
$string['error:norestorefiles'] = 'Non sono stati trovati file per eseguire il ripristino. {$a}';
$string['error:restoreerror'] = 'Si è verificato un errore nel processo di ripristino: {$a}';
$string['error:somedeleted'] = 'Soltanto {$a->actually_deleted} di un possibile {$a->marked_for_deletion} {$a->items} è stato eliminato';
$string['error:typenotfound'] = 'Impossibile trovare il tipo {$a}';
$string['error:unknownaction'] = 'Azione sconosciuta';
$string['export'] = 'Esportazione';
$string['exportcsv'] = 'Esporta in formato CSV';
$string['exportexcel'] = 'Esporta in formato Excel';
$string['exportods'] = 'Esporta in formato ODS';
$string['exporttext'] = 'Esporta in formato di testo';
$string['exportxls'] = 'Esporta in formato Excel';
$string['filterframework'] = 'Filtra per framework';
$string['frameworkdoesntexist'] = 'Il framework {$a} non esiste';
$string['hidden'] = 'Nascosto';
$string['hidecustomfields'] = 'Nascondi i campi personalizzati';
$string['hidedetails'] = 'Nascondi i dettagli';
$string['hierarchybackup'] = 'Backup di gerarchia';
$string['hierarchyrestore'] = 'Ripristino di gerarchia';
$string['mandatory'] = 'Obbligatorio';
$string['missingframeworkname'] = 'Nome di framework mancante';
$string['missingtypename'] = 'Nome di tipo mancante';
$string['moveselectedxto'] = 'Spostare {$a} selezionato su:';
$string['newtype'] = 'Nuovo tipo';
$string['nocustomfields'] = 'Nessun campo personalizzato';
$string['nodata'] = 'Nessun dato di campo personalizzato';
$string['nopathfoundforid'] = 'Nessun percorso trovato per {$a->prefix} id {$a->id}';
$string['nopermviewhiddenframeworks'] = 'Non si dispone dell\'autorizzazione di visualizzare i framework nascosti';
$string['noresultsfor'] = 'Nessun risultato trovato per "{$a->query}".';
$string['noresultsforinframework'] = 'Nessun risultato trovato per "{$a->query}" nel framework "{$a->framework}".';
$string['noresultsforsearchx'] = 'Nessun risultato trovato per la ricerca di "{$a}"';
$string['noxfound'] = 'Nessun "{$a}" trovato';
$string['optional'] = 'Opzionale';
$string['parentchildselectedwarningdelete'] = 'Nota: è stato selezionato un elemento e anche un dei suoi secondari. Se si elimina un elemento, si eliminano automaticamente tutti i suoi secondari. Per mantenere i secondari di un elemento, spostarli prima di eliminare l\'elemento.';
$string['parentchildselectedwarningmove'] = 'Avviso: è stato selezionato di spostare un elemento e anche uno o più dei suoi secondari. Se si sposta un elemento, tutti i suoi secondari vengono spostati automaticamente.';
$string['pickaframework'] = 'Scegliere un framework';
$string['pickfilehelp'] = 'Se il file che si desidera ripristinare non è disponibile, verificare che il file .zip di backup della gerarchia è salvato in {$a} e che le autorizzazioni sono impostate correttamente.';
$string['pickfilemultiple'] = 'Scegliere un file da ripristinare';
$string['pickfileone'] = 'E\' stato trovato un file. Si desidera ripristinare il file {$a}?';
$string['queryerror'] = 'Errore di query. Non sono stati trovati dei risultati.';
$string['reclassify1of2bulk'] = 'Riclassificazione di {$a->num} {$a->items} - passo 1 di 2';
$string['reclassify1of2desc'] = 'Selezionare il nuovo tipo.';
$string['reclassify1of2item'] = 'Riclassificazione di {$a->name} - passo 1 di 2';
$string['reclassifyingfromxtoybulk'] = 'Riclassificazione di {$a->num} {$a->items} da "{$a->from}" a "{$a->to}"';
$string['reclassifyingfromxtoyitem'] = 'Riclassificazione di "{$a->name}" da "{$a->from}" a "{$a->to}"';
$string['reclassifyitems'] = 'Riclassificazione degli elementi';
$string['reclassifyitemsanddelete'] = 'Riclassificazione degli elementi ed eliminazione dei dati';
$string['reclassifyitemsandtransfer'] = 'Riclassificazione degli elementi e trasferimento/eliminazione dei dati';
$string['reclassifysuccessbulk'] = '{$a->num} {$a->items} riclassificati da "{$a->from}" a "{$a->to}"';
$string['reclassifysuccessitem'] = '"{$a->name}" è stato riclassificato da "{$a->from}" a "{$a->to}"';
$string['reclassifytransferdata'] = 'Si ha l\'opportunità di trasferire i dati del campo personalizzato nel passo 2.';
$string['restore'] = 'Ripristino';
$string['restorenousers'] = 'Non sono stati trovati utenti da ripristinare';
$string['restoreusers'] = '{$a} utenti trovati da ripristinare';
$string['restoreusersanddata'] = 'Ripristina utenti e dati utente';
$string['searchavailable'] = 'Cerca elementi disponibili';
$string['selected'] = 'Selezionato';
$string['selecteditems'] = 'Elementi selezionati';
$string['selectedx'] = '{$a} selezionato';
$string['selectframeworks'] = 'Selezionare i framework da ripristinare';
$string['showdepthfullname'] = 'Mostra nome completo della profondità';
$string['showdetails'] = 'Mostra dettagli';
$string['showdisplayoptions'] = 'Mostra opzioni di visualizzazione';
$string['showingxofyforsearchz'] = 'Visualizzazione di {$a->filteredcount} di {$a->allcount} per la ricerca "{$a->query}".';
$string['showitemfullname'] = 'Mostra nome completo dell\'elemento';
$string['showtypefullname'] = 'Mostra nome completo del tipo';
$string['switchframework'] = 'Alterna framework:';
$string['top'] = 'Alto';
$string['transfertox'] = 'Trasferisci su {$a}';
$string['type'] = 'Tipo';
$string['unclassified'] = 'Non classificato';
$string['xandychild'] = '{$a->item} (e {$a->num} secondario)';
$string['xandychildren'] = '{$a->item} (e {$a->num} secondari)';
$string['xitemsdeleted'] = '{$a->num} {$a->items} e i secondari sono stati eliminati';
$string['xitemsmoved'] = '{$a->num} {$a->items} e tutti i secondari sono stati spostati';
$string['achieved'] = 'Conseguito';
$string['addassignedcompetencies'] = 'Assegna competenze';
$string['addassignedcompetencytemplates'] = 'Assegna modelli di competenza';
$string['addcourseevidencetocompetencies'] = 'Aggiungi una prova di corso alle competenze';
$string['addcourseevidencetocompetency'] = 'Aggiungi una prova di corso alla competenza';
$string['adddepthlevel'] = 'Aggiungi un nuovo livello di profondità';
$string['addedcompetency'] = 'La competenza "{$a}" è stata aggiunta';
$string['competencyaddedframework'] = 'Il quadro di competenza "{$a}" è stato aggiunto';
$string['addmultiplenewcompetency'] = 'Aggiungi più competenze';
$string['addnewcompetency'] = 'Aggiungi nuova competenza';
$string['competencyaddnewframework'] = 'Aggiungi nuovo quadro di competenza';
$string['addnewscalevalue'] = 'Aggiungi nuovo valore di scala';
$string['addnewtemplate'] = 'Aggiungi nuovo modello di competenza';
$string['addtype'] = 'Aggiungi un nuovo tipo';
$string['aggregationmethod'] = 'Metodo di aggregazione';
$string['aggregationmethod1'] = 'Tutti';
$string['aggregationmethod2'] = 'Qualsiasi';
$string['aggregationmethod3'] = 'Off';
$string['aggregationmethod4'] = 'Unità';
$string['aggregationmethod5'] = 'Frazione';
$string['aggregationmethod6'] = 'Somma del ponderato';
$string['aggregationmethod7'] = 'Media del ponderato';
$string['aggregationmethodview'] = 'Metodo di aggregazione {$a}';
$string['allcompetencyscales'] = 'Tutte le scale di competenza';
$string['assigncompetencies'] = 'Assegna competenze';
$string['assigncompetency'] = 'Assegna competenza';
$string['assigncompetencytemplate'] = 'Assegna modello di competenza';
$string['assigncompetencytemplates'] = 'Assegna modelli di competenza';
$string['assigncoursecompletion'] = 'Assegna completamento di corso';
$string['assigncoursecompletions'] = 'Assegna completamenti di corso';
$string['assigncoursecompletiontocompetencies'] = 'Assegna completamento di corso alle competenze';
$string['assigncoursecompletiontocompetency'] = 'Assegna completamento di corso alla competenza';
$string['assignedcompetencies'] = 'Competenze assegnate';
$string['assignedcompetenciesandtemplates'] = 'Competenze assegnate e modelli di competenza';
$string['assignedcompetencytemplates'] = 'Modelli di competenze assegnate';
$string['assignedonly'] = 'Assegnato ma non usato';
$string['assignnewcompetency'] = 'Assegna una nuova competenza';
$string['assignnewevidenceitem'] = 'Assegna nuovo elemento di prova';
$string['assignrelatedcompetencies'] = 'Assegna competenze correlate';
$string['competencybacktoallframeworks'] = 'Torna ai quadri delle competenze';
$string['bulkdeletecompetency'] = 'Elimina tutte le competenze';
$string['bulkmovecompetency'] = 'Sposta tutte le competenze';
$string['cannotupdatedisplaysettings'] = 'Impossibile aggiornare le impostazioni di visualizzazione';
$string['changeto'] = 'Modifica a';
$string['clickfornonjsform'] = 'Fare clic qui per una versione non-javascrip di questo modulo';
$string['clicktoassign'] = 'Fare clic sul pulsante di assegnazione per selezionare una competenza';
$string['clicktoassigntemplate'] = 'Fare clic sul pulsante di assegnazione per selezionare un modello di competenza';
$string['clicktoviewchildren'] = 'Fare clic sul nome di competenza per visualizzare le competenze secondarie (se presenti)';
$string['competencies'] = 'Competenze';
$string['competenciesusedincourse'] = 'Competenze usate in corso';
$string['competency'] = 'Competenza';
$string['competencyaddnew'] = 'Aggiungi una nuova competenza';
$string['competencycustomfields'] = 'Campi personalizzati';
$string['competencydepthcustomfields'] = 'Campi personalizzati di profondità di competenza';
$string['competencydepthlevelview'] = 'Vista del livello di profondità di competenza';
$string['competencyevidence'] = 'Prova di competenza';
$string['competencyframework'] = 'Quadro di competenza';
$string['competencyframeworkmanage'] = 'Gestisci quadri';
$string['competencyframeworks'] = 'Quadri di competenza';
$string['competencyframeworkview'] = 'Visualizza quadri';
$string['competencymanage'] = 'Gestisci competenze';
$string['competencyplural'] = 'Competenze';
$string['competencyscale'] = 'Scala di competenze';
$string['competencyscaleassign'] = 'Scala di competenze';
$string['competencyscaleinuse'] = 'Questa scala è in uso (ad es. gli utenti hanno le competenze contrassegnate con i valori da questa scala). I valori di scala non possono essere creati, riordinati o eliminati per mantenere l\'integrità dei dati. E\' possibile ridenominare i valori di scala ma questo potrebbe confondere gli utenti quando sono effettuate modifiche di efficienza senza avviso';
$string['competencyscales'] = 'Scale di competenza';
$string['competencytemplatemanage'] = 'Gestisci modelli';
$string['competencytemplates'] = 'Modelli di competenza';
$string['competencytypecustomfields'] = 'Campi personalizzati del tipo di competenza';
$string['competencytypes'] = 'Tipi di competenza';
$string['competencytypeview'] = 'Vista del tipo di competenza';
$string['competent'] = 'Competente';
$string['competentwithsupervision'] = 'Competente con supervisione';
$string['couldnotdeletescalevalue'] = 'Si è verificato un problema nell\'eliminazione del valore di scala';
$string['createdon'] = 'Creato il';
$string['createnewcompetency'] = 'Crea una nuova competenza';
$string['competencycreatetype'] = 'Il tipo di competenza "{$a}" è stato creato';
$string['currentlyselected'] = 'Correntemente selezionato';
$string['defaultvalue'] = 'Valore predefinito';
$string['competencydeletecheck'] = 'Si è sicuri di voler eliminare questa competenza, tutte le sue secondarie e i dati in essi contenuti?';
$string['competencydeletecheck11'] = 'Si desidera eliminare la competenza "{$a}"?
<br /><br />
Questo elimina i seguenti dati:<br />
- La competenza "{$a}"';
$string['deletecheckframework'] = 'Si desidera eliminare il quadro "{$a}"?';
$string['deletecheckscale'] = 'Si desidera eliminare completamente questa scala di competenza?';
$string['deletecheckscalevalue'] = 'Si desidera eliminare questo valore di scala di competenza?';
$string['deletechecktemplate'] = 'Si desidera eliminare questo modello di competenza?';
$string['competencydeletecheckwithchildren'] = 'Si desidera eliminare la competenza  "{$a->itemname}" e il suo {$a->children_string}?
<br /><br />
Questo rimuove i seguenti dati: <br />
- La competenza "{$a->itemname}" e i suoi {$a->childcount} {$a->children_string}';
$string['deletecompetency'] = 'Elimina competenza';
$string['deletedcompetency'] = 'La competenza {$a} e i suoi secondari sono stati completamente eliminati.';
$string['deletedcompetencyscale'] = 'La scala di competenza "{$a}" è stata completamente eliminata.';
$string['deletedcompetencyscalevalue'] = 'Il valore della scala di competenza "{$a}" è stata eliminata.';
$string['deletedepth'] = 'Elimina {$a}';
$string['competencydeletedframework'] = 'Il quadro di competenza "{$a}" e i suoi dati sono stati completamente eliminati';
$string['deletedtemplate'] = 'Il modello di competenza {$a} e i suoi dati sono stati completamente eliminati.';
$string['competencydeletedtype'] = 'Il tipo di competenza "{$a}" è stato completamente eliminato.';
$string['deleteframework'] = 'Elimina {$a}';
$string['deleteincludexcustomfields'] = '- record di campo personalizzato {$a}';
$string['deleteincludexevidence'] = '- elemento(i) {$a} di prova';
$string['deleteincludexrelatedcompetencies'] = '- link {$a} alle competenze correlate';
$string['deleteincludexuserstatusrecords'] = '- record di stato del\'utente {$a}';
$string['competencydeletemulticheckwithchildren'] = 'Si desidera eliminare la(e) competenza(e) {$a->num} e {$a->childcount} {$a->children_string}?
<br /><br />
Questo rimuove i seguenti dati: <br />
- La competenza/competenze {$a->num} e {$a->childcount} {$a->children_string}';
$string['deletetype'] = 'Elimina tipo "{$a}"';
$string['depthlevel'] = 'Livello di profondità';
$string['depthlevels'] = 'Livelli di profondità';
$string['descriptionview'] = 'Descrizione';
$string['editcompetency'] = 'Modifica competenza';
$string['editdepthlevel'] = 'Modifica livello di profondità';
$string['competencyeditframework'] = 'Modifica quadro di competenza';
$string['editgeneric'] = 'Modifica {$a}';
$string['editscalevalue'] = 'Modifica valore di scala';
$string['edittemplate'] = 'Modifica modello di competenza';
$string['edittype'] = 'Modifica tipo';
$string['error:addcompetency'] = 'Si è verificato un errore nell\'aggiunta di una competenza "{$a}"';
$string['error:compevidencealreadyexists'] = 'L\'utente ha già una prova di competenza per la competenza scelta. E\' possibile scegliere <a href=\'edit.php?id={$a}\'>Modifica la competenza esistente</a> o aggiungere un\'altra competenza.';
$string['error:couldnotdeletescale'] = 'Si';
$string['competencyerror:createtype'] = 'Errore nella creazione del tipo di competenza "{$a}"';
$string['competencyerror:deletedframework'] = 'Errore di eliminazione del quadro di competenza "{$a}"';
$string['competencyerror:deletedtype'] = 'Errore di eliminazione del tipo di competenza "{$a}"';
$string['error:dialognolinkedcourseitems'] = 'Non ci sono competenza in questo quadro con i corsi assegnati collegati loro';
$string['competencyerror:dialognotreeitems'] = 'Non ci sono competenze in questo quadro';
$string['error:evidencealreadyexists'] = 'Impossibile creare nuove prove di competenza perché esiste un record per quell\'utente e quella competenza';
$string['error:nodeletecompetencyscaleassigned'] = 'Impossibile eliminare la scala di competenza perché è già assegnata a uno o più quadri';
$string['error:nodeletecompetencyscaleinuse'] = 'Impossibile eliminare la scala di competenza perché è in uso';
$string['error:nodeletecompetencyscalevaluedefault'] = 'Impossibile eliminare il valore della scala perché è il predefinito';
$string['error:nodeletecompetencyscalevalueonlyprof'] = 'Impossibile eliminare il valore della scala perché è l\'unico valore competente in questa scala. Contrassegnare un altro valore come competente prima di eliminare';
$string['error:onescalevaluemustbeproficient'] = 'Almeno un valore di scala deve essere contrassegnato come competente costantemetne. Impostare un altro valore di scala su competente prima di deselezionare questo valore.';
$string['error:scaledetails'] = 'Errore nell\'ottenimento dei dettagli della scala';
$string['error:updatecompetency'] = 'Si è verificato un problema nell\'aggiornamento della competenza "{$a}"';
$string['competencyerror:updatetype'] = 'Si è verificato un errore nell\'aggiornamento del tipo di competenza "{$a}"';
$string['evidence'] = 'Prova';
$string['evidenceactivitycompletion'] = 'Completamento di attività';
$string['evidencecount'] = 'Elementi di prova';
$string['evidencecoursecompletion'] = 'completamento del corso';
$string['evidencecoursegrade'] = 'voto del corso';
$string['evidenceitemremovecheck'] = 'Si è certi di voler eliminare questo elemento da "{$a}"?';
$string['evidenceitems'] = 'Elementi di prova';
$string['competencyfeatureplural'] = 'Competenze';
$string['competencyframework'] = 'Quadro di competenze';
$string['competencyframeworks'] = 'Quadri di competenze';
$string['competencyfullname'] = 'Nome completo della competenza';
$string['fullnamedepth'] = 'Nome completo del livello di profondità';
$string['fullnameframework'] = 'Nome completo';
$string['fullnametemplate'] = 'Nome completo di modello';
$string['fullnametype'] = 'Nome completo di tipo';
$string['fullnameview'] = 'Nome completo';
$string['globalsettings'] = 'Impostazioni globali';
$string['competencyidnumber'] = 'Numero ID di competenze';
$string['idnumberframework'] = 'Numero ID';
$string['idnumberview'] = 'Numero ID';
$string['includecompetencyevidence'] = 'Includi prova di competenza';
$string['invalidevidencetype'] = 'Tipo di prova non valido';
$string['invalidnumeric'] = 'Il valore numerico deve essere numerico (o non impostato)';
$string['itemstoadd'] = 'Elementi da aggiungere';
$string['linkcourses'] = 'Link ai corsi';
$string['linktoscalevalues'] = '<a href="view.php?id={$a}&amp;type=competency">Fare clic qui</a> per visualizzare/modificare i valori di scala per questa scala di competenza.';
$string['linktoscalevalues11'] = '<a href="view.php?id={$a}&amp;prefix=competency">Fare clic qui </a> per visualizzare/modificare i valori di scala per questa scala di competenza.';
$string['locatecompetency'] = 'Individua competenza';
$string['locatecompetencytemplate'] = 'Individua modello di competenza';
$string['managecompetencies'] = 'Gestione competenze';
$string['managecompetency'] = 'Gestione competenze';
$string['managecompetencytypes'] = 'Gestione tipi';
$string['missingfullname'] = 'Nome completo competenza mancante';
$string['missingfullnamedepth'] = 'Nome completo livello di profondità mancante';
$string['missingfullnameframework'] = 'Nome completo riquadro mancante';
$string['missingfullnametemplate'] = 'Nome completo modello mancante';
$string['missingfullnametype'] = 'Nome completo tipo mancante';
$string['competencymissingname'] = 'Nome competenza mancante';
$string['competencymissingnameframework'] = 'Nome riquadro competenza mancante';
$string['missingnametemplate'] = 'Nome modello mancante';
$string['competencymissingnametype'] = 'Nome tipo di di competenza  mancante';
$string['missingscale'] = 'Scala mancante';
$string['missingscalevaluename'] = 'Nome del valore di scala mancante';
$string['competencymissingshortname'] = 'Nome abbreviato della competenza mancante';
$string['missingshortnamedepth'] = 'Nome abbreviato del livello di profondità mancante';
$string['missingshortnameframework'] = 'Nome abbreviato del quadro mancante';
$string['missingshortnametemplate'] = 'Nome abbreviato del modello  mancante';
$string['missingshortnametype'] = 'Nome abbreviato del tipo  mancante';
$string['name'] = 'Nome';
$string['noassignedcompetencies'] = 'Nessuna competenza assegnata';
$string['noassignedcompetenciestotemplate'] = 'Nessuna competenza assegnata a questo modello';
$string['noassignedcompetencytemplates'] = 'Nessun modello di competenza assegnato';
$string['nochildcompetencies'] = 'Nessuna competenza secondaria';
$string['nochildcompetenciesfound'] = 'Nessuna competenza secondaria trovata';
$string['nocompetenciesinframework'] = 'Nessuna competenza in questo quadro';
$string['nocompetency'] = 'Nessuna comptenza definita';
$string['nocompetencyscales'] = 'Occorre definire almeno una scala di competenza con i valori prima di poter definire un quadro di competenza';
$string['nocoursecompetencies'] = 'Nessuna competenza di corso';
$string['nocoursesincat'] = 'Nessun corso trovato nella categoria';
$string['nodepthlevels'] = 'Nessun livello di profondità in questo quadro';
$string['noevidenceitems'] = 'Nessun elemento di prova impostato per questa competenza';
$string['noevidencetypesavailable'] = 'Nessun tipo di prova disponibile per questo corso';
$string['competencynoframeworks'] = 'Nessun quadro di corso definito';
$string['competencynoframeworkssetup'] = 'Non ci sono quadri di competenza definiti per questo sito';
$string['nonsensicalproficientvalues'] = 'Attenzione: ci sono dei valori inferiori al competente in questa scala. Si ricorda che la scala dovrebbe essere ordinata dal livello competente in alto al meno competente in basso';
$string['norelatedcompetencies'] = 'Nessun competenza correlata';
$string['noscalesdefined'] = 'Nessuna scala definita';
$string['noscalevalues'] = 'Non ci sono valori di scala definiti per questa scala';
$string['notcompetent'] = 'Non competente';
$string['notemplate'] = 'Non sono definiti modelli di competenza';
$string['notemplateinframework'] = 'Non sono definiti modelli di competenza in questo quadro';
$string['notescalevalueentry'] = 'Un valore per riga - dal più al meno competente';
$string['notypelevels'] = 'Non ci sono tipi in questo quadro';
$string['competencynotypes'] = 'Non ci sono tipi di competenze';
$string['numericalvalue'] = 'Valore numerico';
$string['options'] = 'Opzioni';
$string['parent'] = 'Principale';
$string['positions'] = 'Posizioni';
$string['proficiency'] = 'Competenza';
$string['competencyscaleproficient'] = 'Valore competente';
$string['proficientvaluefrozen'] = 'Non è possibile modificare l\'impostazinoe perché la scala è in uso';
$string['proficientvaluefrozenonlyprof'] = 'Non è possibile modificare questa impostazione perché la scala deve avere almeno un valore di competente';
$string['relatedcompetencies'] = 'Competenze correlate';
$string['relateditemremovecheck'] = 'Si è sicuri di voler eliminare questa relazione di competenza?';
$string['removedcompetencyevidenceitem'] = 'L\'elemento di prova <i>{$a}</i> e i suoi dati sono stati eliminati';
$string['removedcompetencyrelateditem'] = 'La competenza <i>{$a}</i> non è più correlata a questa competenza';
$string['removedcompetencytemplatecompetency'] = 'La competenza <i>{$a}</i> non è più assegnata a questo modello';
$string['competencyreturntoframework'] = 'Tornare al quadro di competenza';
$string['scaleadded'] = 'Scala di competenza "{$a}" aggiunto';
$string['scaledefaultupdated'] = 'Il valore predefinito della scala è stato aggiornato';
$string['scaledeleted'] = 'La scala di competenza "{$a}" è stato eliminato';
$string['scales'] = 'Scale';
$string['scaleupdated'] = 'La scala di competenza "{$a}" aggiornata';
$string['scalevalueadded'] = 'Valore della scala di competenza "{$a}" è stato aggiunto';
$string['competencyscalevalueidnumber'] = 'Numero ID del valore di scala';
$string['competencyscalevaluename'] = 'Nome del valore di scala';
$string['competencyscalevaluenumericalvalue'] = 'Valore numerico del valore di scala';
$string['scalevalues'] = 'Valori di scala';
$string['scalevalueupdated'] = 'Il valore di scala "{$a}" è stato aggiornato';
$string['scalex'] = 'Scala "{$a}"';
$string['selectacompetencyframework'] = 'Selezionare un quadro di competenza';
$string['selectcategoryandcourse'] = 'Selezionare una categoria di corso e scegliere di selezionare gli elementi di prova da:';
$string['selectedcompetencies'] = 'Competenze selezionate:';
$string['selectedcompetencytemplates'] = 'Modelli delle competenze selezionate:';
$string['set'] = 'Set';
$string['competencyshortname'] = 'Nome abbreviato di competenza';
$string['shortnamedepth'] = 'Nome abbreviato di livello di profondità';
$string['shortnameframework'] = 'Nome abbreviato';
$string['shortnametemplate'] = 'Nome abbreviato di modello';
$string['shortnametype'] = 'Nome abbreviato di tipo';
$string['shortnameview'] = 'Nome abbreviato';
$string['template'] = 'Modello di competenza';
$string['templatecompetencyremovecheck'] = 'Si è sicuri di voler disassegnare la competenza da questo modello?';
$string['types'] = 'Tipi';
$string['unknownbuttonclicked'] = 'Pulsante non noto cliccato';
$string['updatedcompetency'] = 'La competenza "{$a}" è stata aggiornata';
$string['competencyupdatedframework'] = 'Il quadro di competenza "{$a}" è stato aggiornato';
$string['competencyupdatetype'] = 'Il tipo di competenza "{$a}" è stato aggiornato';
$string['useresourcelevelevidence'] = 'Usa prova a livello di risorsa';
$string['weight'] = 'Peso';
$string['organisationaddedframework'] = 'Il settore di organizzazione "{$a}" è stato aggiunto';
$string['addedorganisation'] = 'L\'organizzazione "{$a}" è stata aggiunta';
$string['addmultipleneworganisation'] = 'Aggiungi più organizzazioni';
$string['organisationaddnewframework'] = 'Aggiungi un nuovo settore di organizzazione';
$string['addneworganisation'] = 'Aggiungi una nuova organizzazione';
$string['organisationbacktoallframeworks'] = 'Torna a tutti i settori di organizzazione';
$string['bulkdeleteorganisation'] = 'Elimina tutte le organizzazioni';
$string['bulkmoveorganisation'] = 'Sposta tutte le organizzazioni';
$string['chooseorganisation'] = 'Scegli un\'organizzazione';
$string['competencyassigndeletecheck'] = 'Si desidera eliminare questa assegnazione di competenze?';
$string['organisationcreatetype'] = 'E\' stato creato il tipo di organizzazione "{$a}"';
$string['organisationdeletecheck'] = 'Si desidera eliminare questa organizzazione, tutte le sue secondarie e i dati in esse contenuti?';
$string['organisationdeletecheck11'] = 'Si desidera eliminare l\'organizzazione "{$a}"?
<br /><br />
Verranno rimossi i seguenti dati:<br />
- L\'organizzazione "{$a}"';
$string['organisationdeletecheckwithchildren'] = 'Si desidera eliminare l\'organizzazione "{$a->itemname}" e il suo {$a->children_string}?
<br /><br />
Verranno rimossi i seguenti dati: <br />
- L\'organizzazione "{$a->itemname}" e il suo {$a->childcount} {$a->children_string}';
$string['organisationdeletedassignedcompetency'] = 'Competenza non assegnata con successo da questa organizzazione';
$string['organisationdeletedframework'] = 'Il settore di organizzazione "{$a}" e i suoi dati sono stati completamente eliminati';
$string['deletedorganisation'] = 'L\'organizzazione "{$a}" e i suoi secondari sono stati completamente eliminati';
$string['organisationdeletedtype'] = 'Il tipo di organizzazione "{$a}" è stato completamente eliminato';
$string['organisationdeleteincludexlinkedcompetencies'] = '- {$a} link alle competenze';
$string['organisationdeleteincludexposassignments'] = '- {$a} assegnazioni a questa organizzazione (gli utenti assegnati a questa organizzazione saranno non assegnati)';
$string['organisationdeletemulticheckwithchildren'] = 'Si desidera eliminare l\'organizzazione {$a->num} e {$a->childcount} {$a->children_string}?
<br /><br />
Verranno eliminati i seguenti dati: <br />
- L\'organizzazione {$a->num} e {$a->childcount} {$a->children_string}';
$string['deleteorganisation'] = 'Elimina organizzazione';
$string['organisationeditframework'] = 'Modifica settore di organizzazione';
$string['editorganisation'] = 'Modifica organizzazione';
$string['edittypelevel'] = 'Modifica tipo';
$string['error:addorganisation'] = 'Si è verificato un problema nell\'aggiunta dell\'organizzazione "{$a}"';
$string['organisationerror:createtype'] = 'Errore nella creazione del tipo di organizzazione "{$a}"';
$string['organisationerror:deleteassignedcompetency'] = 'Errore nella disassegnazione delle competenze da questa organizzazione';
$string['organisationerror:deletedframework'] = 'Errore nell\'eliminazione del settore dell\'organizzazione "{$a}" e dei suoi dati.';
$string['organisationerror:deletedtype'] = 'Errore nell\'eliminazione del tipo di organizzazione "{$a}"';
$string['organisationerror:dialognotreeitems'] = 'Nessuna organizzazione in questo settore';
$string['error:updateorganisation'] = 'Si è verificato un problema nell\'aggiornamento dell\'organizzazione "{$a}"';
$string['organisationerror:updatetype'] = 'Si è verificato un errore nell\'aggiornamento del tipo di organizzazione "{$a}"';
$string['organisationfeatureplural'] = 'Organizzazioni';
$string['organisationframework'] = 'Settore di organizzazione';
$string['organisationframeworks'] = 'Settori di organizzazione';
$string['organisationfullname'] = 'Nome completo dell\'organizzazione';
$string['organisationidnumber'] = 'Numero ID organizzazione';
$string['manageorganisation'] = 'Gestisci organizzazione';
$string['manageorganisations'] = 'Gestisci organizzazioni';
$string['manageorganisationtypes'] = 'Gestisci tipi';
$string['missingfullname'] = 'Nome completo di organizzazione mancante';
$string['organisationmissingname'] = 'Nome di organizzazione mancante';
$string['organisationmissingnameframework'] = 'Nome di settore di organizzazione mancante';
$string['organisationmissingnametype'] = 'Nome di tipo di organizzazione mancante';
$string['organisationmissingshortname'] = 'Nome abbreviato di organizzazione mancante';
$string['nochildorganisations'] = 'Nessuna organizzazione secondaria definita';
$string['organisationnoframeworks'] = 'Nessun settore di organizzazione disponibile';
$string['organisationnoframeworkssetup'] = 'Non ci sono impostazioni di settore di organizzazione per questo sito';
$string['noorganisation'] = 'Non è stata definita un\'organizzazione';
$string['noorganisationsinframework'] = 'Non ci sono organizzazioni in questo quadro';
$string['organisationnotypes'] = 'Nessun tipo di organizzazione';
$string['nounassignedcompetencies'] = 'Non ci sono competenze non assegnate';
$string['nounassignedcompetencytemplates'] = 'Non ci sono modelli di competenze non assegnate';
$string['organisation'] = 'Organizzazione';
$string['organisationaddnew'] = 'Aggiungi una nuova organizzazione';
$string['organisationcustomfields'] = 'Campi personalizzati';
$string['organisationdepthcustomfields'] = 'Campi personalizzati di profondità di livello';
$string['organisationframework'] = 'Quadro di organizzazione';
$string['organisationframeworkmanage'] = 'Gestisci quadri';
$string['organisationframeworks'] = 'Quadri di organizzazione';
$string['organisationmanage'] = 'Gestisci organizzazioni';
$string['organisationplural'] = 'Organizzazioni';
$string['organisations'] = 'Organizzazioni';
$string['organisationtypecustomfields'] = 'Campi personalizzati del tipo di organizzazione';
$string['organisationtypes'] = 'Tipi di organizzazione';
$string['organisationreturntoframework'] = 'Torna al quadro di organizzazione';
$string['organisationshortname'] = 'Nome abbreviato di organizzazione';
$string['organisationupdatedframework'] = 'Il quadro di organizzazione "{$a}" è stato aggiornato';
$string['updatedorganisation'] = 'L\'organizzazione "{$a}" è stata aggiornata';
$string['organisationupdatetype'] = 'Il tipo di organizzazione "{$a}" è stato aggiornato';
$string['positionaddedframework'] = 'Il settore di posizione "{$a}" è stato eliminato';
$string['addedposition'] = 'La posizione "{$a}" è stata aggiunta';
$string['addmultiplenewposition'] = 'Aggiungi posizioni multiple';
$string['positionaddnewframework'] = 'Aggiungi un nuovo settore di posizione';
$string['addnewposition'] = 'Aggiungi una nuova posizione';
$string['positionbacktoallframeworks'] = 'Torna a tutti i settori di posizione';
$string['bulkdeleteposition'] = 'Elimina tutte le posizioni';
$string['bulkmoveposition'] = 'Sposta tutte le posizioni';
$string['choosemanager'] = 'Scegli manager';
$string['chooseposition'] = 'Scegli posizione';
$string['positioncreatetype'] = 'Il tipo di posizione "{$a}" è stato creato';
$string['positiondeletecheck'] = 'Si desidera eliminare questa posizione, tutte le sue secondarie e il loro rispettivo contenuto?';
$string['positiondeletecheck11'] = 'Si desidera eliminar la posizione "{$a}"?
<br /><br />
Verranno rimossi i seguenti dati:<br />
- La posizione "{$a}"';
$string['positiondeletecheckwithchildren'] = 'Si desidera eliminare la posizione "{$a->itemname}" e i suoi {$a->children_string}?
<br /><br />
Verranno rimossi i seguenti dati: <br />
- La posizione "{$a->itemname}" e i suoi {$a->childcount} {$a->children_string}';
$string['positiondeletedassignedcompetency'] = 'Competenza non assegnata con successo da questa posizione';
$string['positiondeletedframework'] = 'Il settore di posizione "{$a}" e i suoi dati sono stati completamente eliminati';
$string['deletedposition'] = 'La posizione {$a} e i suoi secondari sono stati completamente eliminati';
$string['positiondeletedtype'] = 'Il tipo di posizione "{$a}" è stato completamente eliminato';
$string['positiondeleteincludexlinkedcompetencies'] = '- {$a} link alle competenze';
$string['positiondeleteincludexposassignments'] = '- {$a} assegnazione a questa posizione (gli utenti assegnati a questa posizione saranno non assegnati=';
$string['positiondeletemulticheckwithchildren'] = 'Si desidera eliminare {$a->num} posizione(i) e {$a->childcount} {$a->children_string}?
<br /><br />
Verranno eliminati i seguenti dati: <br />
- La posizione(i) {$a->num} e {$a->childcount} {$a->children_string}';
$string['deleteposition'] = 'Elimina posizione';
$string['positioneditframework'] = 'Modifica settore di posizione';
$string['editposition'] = 'Modifica posizione';
$string['entervaliddate'] = 'Inserisci una data valida';
$string['error:addposition'] = 'Si è verificato un problema nell\'aggiunta della posizione "{$a}"';
$string['positionerror:createtype'] = 'Errore nella creazione del tipo di posizione "{$a}"';
$string['error:dateformat'] = 'Inserire una data in formato {$a}.';
$string['positionerror:deleteassignedcompetency'] = 'Errore nella rimozione dell\'assegnazione di competenza da questa posizione';
$string['positionerror:deletedframework'] = 'Errore nell\'eliminazione del settore "{$a}" e dei suoi dati';
$string['positionerror:deletedtype'] = 'Errore nell\'eliminazione del tipo di posizione "{$a}"';
$string['positionerror:dialognotreeitems'] = 'Nessuna posizione in questo settore';
$string['error:positionnotset'] = 'Non è stata impostata una posizione per questo utente';
$string['error:startafterfinish'] = 'La data di inizio non deve essere successiva alla data di fine';
$string['error:updateposition'] = 'Si è verificato un problema nell\'aggiornamento della posizione "{$a}"';
$string['positionerror:updatetype'] = 'Errore nell\'aggiornamento del tipo di posizione "{$a}"';
$string['error:userownmanager'] = 'Impossibile assegnare un utente come proprio manager';
$string['positionfeatureplural'] = 'Posizioni';
$string['finishdate'] = 'Data di fine';
$string['positionframework'] = 'Settore di posizione';
$string['positionframeworks'] = 'Settori';
$string['positionfullname'] = 'Nome completo di posizione';
$string['positionidnumber'] = 'Numero ID posizione';
$string['manageposition'] = 'Gestisci posizioni';
$string['managepositions'] = 'Gestisci posizioni';
$string['managepositiontypes'] = 'Gestisci tipi';
$string['manager'] = 'Manager';
$string['missingfullname'] = 'Nome completo di posizione mancante';
$string['positionmissingname'] = 'Nome di posizione mancante';
$string['positionmissingnameframework'] = 'Nome di settore di posizione mancante';
$string['positionmissingnametype'] = 'Nome di tipo di posizione mancante';
$string['positionmissingshortname'] = 'Nome abbreviato di posizione mancante';
$string['nocompetenciesassignedtoposition'] = 'Nessuna competenza assegnata alla posizione';
$string['positionnoframeworks'] = 'Nessun settore di posizione disponibile';
$string['positionnoframeworkssetup'] = 'Non ci sono impostazioni di settori di posizione per questo sito';
$string['noposition'] = 'Non sono definite posizioni';
$string['nopositionsassigned'] = 'Non ci sono posizioni correntemente assegnate a questo utente';
$string['nopositionset'] = 'Nessuna posizione impostata';
$string['nopositionsinframework'] = 'Nessuna posizione in questo settore';
$string['positionnotypes'] = 'Nessun tipo di posizione';
$string['position'] = 'Posizione';
$string['positionaddnew'] = 'Aggiungi una nuova posizione';
$string['positionbulkaction'] = 'Tutte le azioni';
$string['positioncustomfields'] = 'Campi personalizzati';
$string['positiondepthcustomfields'] = 'Campi personalizzati di profondità di posizione';
$string['positionframework'] = 'Settore di posizione';
$string['positionframeworkmanage'] = 'Gestisci settori';
$string['positionframeworks'] = 'Settori di posizione';
$string['positionhistory'] = 'Cronologia di posizione';
$string['positionmanage'] = 'Gestisci posizioni';
$string['positionplural'] = 'Posizioni';
$string['positionsaved'] = 'Posizione salvata';
$string['positiontypecustomfields'] = 'Campi personalizzati del tipo di posizione';
$string['positiontypes'] = 'Tipi di posizione';
$string['positionreturntoframework'] = 'Torna al settore di posizione';
$string['positionshortname'] = 'Nome abbreviato di posizione';
$string['startdate'] = 'Data di inizio';
$string['titlefullname'] = 'Titolo (nome completo)';
$string['titleshortname'] = 'Titolo (nome abbreviato)';
$string['typeaspirational'] = 'Posizione ambita';
$string['typeprimary'] = 'Posizione primaria';
$string['typesecondary'] = 'Posizione secondaria';
$string['positionupdatedframework'] = 'Il settore di posizione "{$a}" è stato aggiornato';
$string['updatedposition'] = 'La posizione "{$a}" è stata aggiornata';
$string['updateposition'] = 'Aggiorna posizione';
$string['positionupdatetype'] = 'Il tipo di posizione "{$a}" è stato aggiornato';
$string['addcompetencyevidence'] = 'Aggiungi record di attestato formazione';
$string['addforthisuser'] = 'Aggiungi nuovo record di attestato di formazione per questo utente';
$string['confirmdeletece'] = 'Si desidera eliminare questo record di formazione?';
$string['couldnotdeletece'] = 'Impossibile eliminare questo record di formazione.';
$string['deletecompetencyevidence'] = 'Elimina attestato di formazione';
$string['editcompetencyevidence'] = 'Modifica record di attestato di formazione';
$string['firstselectcompetency'] = 'Selezionare innanzitutto una competenza';
$string['selectcompetency'] = 'Seleziona una competenza';


$string['organisationframeworkfullname_help'] = 'Il nome completo del quadro è il titolo completo del quadro.';
$string['organisationframeworkdescription_help'] = 'La descrizione del quadro è un campo di testo per la memorizzazione di informazioni aggiuntive sul quadro. E\' visualizzato sulla pagina di gestione delle organizzazioni, sopra la tabella delle organizzazioni.';
$string['organisationframeworkidnumber_help'] = 'Il numero ID del quadro è un numero unico che può essere usato per rappresentare il quadro.</h1>';
$string['organisationframeworkshortname_help'] = 'Il nome abbreviato del quadro è un riferimento rapido al nome completo del quadro e può essere usato per i fini di visualizzazione.';
$string['organisationfullname_help'] = 'Il Nome completo dell\'organizzazione è il titolo completo dell\'organizzazione.';
$string['organisationframework_help'] = '**Quadro dell\'organizzazione** è il nome del quadro in cui si definisce l\'organizzazione.';
$string['organisationframeworks_help'] = 'Un **quadro dell\'organizzazione** è impostato per mantenere la struttura organizzativa dell\'organizzazione.

E\' possibile impostare più quadri dell\'organizzazione. Ad esempio: impostare un quadro per le sottodivisioni o le sussidiarie di un\'azienda.';
$string['competencytype_help'] = 'Gli amministratori possono creare e assegnare tipi di competenze. Se una competenza è assegnata a un tipo, eredita uno dei campi personalizzati che sono stati assegnati a quel tipo. Questo permette di organizzare i meta-data relativi alle competenze e visualizzare soltanto i campi richiesti per ciascun tipo di competenza.';
$string['competencyshortname_help'] = 'Il nome abbreviato della competenza è il nome di riferimento rapido della competenza e può essere usato ai fini della visualizzazione.';
$string['competencyscalevaluenumericalvalue_help'] = 'Il valore numerico del valore di scala è il valore numerico associato al valore della scala.';
$string['competencytemplatefullname_help'] = 'Il nome completo del modello è il titolo completo del modello di competenza impostato.';
$string['competencytemplategeneral_help'] = 'Un **Modello di competenza** permette di raggruppare le competenze contenute in un quadro di competenza.

Quando si crea un evento di formazione, ad esempio un corso introduttivo, lo si può collegare a un Modello di competenza chiamato \'nuove competenze del dipendente\'; e prenderne automaticamente le varie competenze, anziché selezionare le competenze una ad una.';
$string['organisationidnumber_help'] = 'Il Numero ID dell\'organizzazione è un numero unico usato per rappresentare l\'organizzazione.';
$string['competencytemplateshortname_help'] = 'Il Nome abbreviato di modello è il nome di riferimento rapido per il modello di competenza e può essere usato ai fini di visualizzazione.';
$string['organisationdescription_help'] = 'Un campo a testo libero che include maggiori dettagli sull\'organizzazione. Questi dati sono visualizzati quando viene visualizzato l\'elenco di gerarchia e la pagina di organizzazione individuale.';
$string['organisationparent_help'] = '**L\'organizzazione principale** permette di gestire le relazioni principale/secondario fra le organizzazioni.

Selezionare **Organizzazione principale** dal menu a discesa. Selezionare **Alto** se si desidera posizionare l\'organizzazione al primo posto della gerarchia.

Se si modifica l\'organizzazione principale di un elemento, questo si sposta per lasciare posto al nuovo principale e tutti i secondari si spostano conseguentemente.

**Nota:** per impostare una relazione principale/secondario occorre avere almeno un elemento nel quadro. Altrimenti, l\'opzione non viene visualizzata.';
$string['positionfullname_help'] = '**Il Nome completo della posizione** è il titolo di lavoro completo.';
$string['positionframeworkshortname_help'] = 'Il Nome abbreviato del quadro è un riferimento rapido per il nome completo del quadro ai fini della visualizzazione.';
$string['positionidnumber_help'] = '**Il Numero ID di posizione** è un numero unico usato per rappresentare la posizione. Si tratta di un campo opzionale.';
$string['positionparent_help'] = '**La posizione principale** permette di gestire le relazioni principale/secondario fra le posizioni.

Selezionare la **Posizione principale** dal menu a discesa. Selezionare **Alto** se si desidera posizionare al primo posto della gerarchia.

Se si modifica la posizione del principale di un elemento questo viene spostato al di sotto del suo principale e tutti i secondari sono spostati conseguentemente.

**Nota:** per impostare una relazione principale/secondario occorre avere almeno un elemento nel quadro. Altrimenti, questa opzione non viene visualizzata.';
$string['positiontype_help'] = 'Gli amministratori possono creare e assegnare tipi di posizioni. Se a una posizione è assegnato un tipo, questo assume i campi personalizzati che sono stati assegnati a quel tipo. Questo permette di organizzare i meta-dati relativi alle posizioni e di visualizzare soltanto i campi che sono richiesti da ciascuna posizione.';
$string['positionshortname_help'] = '**Il Nome abbreviato della posizione** è il nome di riferimento rapido del titol di lavoro e può essere utilizzato per i fini di visualizzazione.';
$string['positionframeworks_help'] = 'A **Il quadro di posizione** è usato per impostare e mantenere le diverse posizioni nell\'organizzazione.

E\' possibile impostare tassonomie di più posizioni (quadri) entro un\'organizzazione.';
$string['positionframeworkidnumber_help'] = 'Il Numero ID del quadro è un numero unico che può essere usato per rappresentare il quadro.';
$string['organisationtype_help'] = 'Gli amministratori possono creare e assegnare tipi di organizzazione. Se un\'organizzazione ha un tipo assegnato, eredita i campi personalizzati che sono stati asseganti a quel tipo. Questo permette di organizzare i meta-data relativi all\'organizzazione e mostrare soltanto i campi che ogni tipo di organizzazione richiede.';
$string['organisationshortname_help'] = 'Il Nome abbreviato dell\'organizzazione è un nome di riferimento rapido per l\'organizzazione e può essere usato per fini di visualizzazione.';
$string['positiondescription_help'] = 'Un campo a testo libero che fornisce maggiori dettagli su questa posizione. I dati sono visualizzati quando viene visualizzato l\'elenco di gerarchia e la pagina di posizione individuale.';
$string['positionframework_help'] = '**Il quadro di posizione** è un quadro specifico per l\'impostazione di un elenco di posizioni (ruoli di lavoro). Ci possono essere più quadri di posizione (elenchi).';
$string['positionframeworkfullname_help'] = 'Il Nome completo del quadro è il titolo completo del quadro.';
$string['positionframeworkdescription_help'] = 'La descrizione di quadro è un campo di testo per la memorizzazione di informazioni aggiuntive sul quadro. E\' visualizzata sulla pagina di gestione delle posizioni, sopra la tabella delle posizioni.';
$string['competencyscalevaluename_help'] = '**Il Nome del valore della scala** è il nome del valore della scala di competenza che viene aggiunto o modificato.

Un valore di scala permette di definire l\'evoluzione dello studente in una competenza. E\' possibile aggiungere il numero desiderato di valori di scala.

**Nota: **ricordarsi di impostare il valore Predefinito ed Esperto.';
$string['competencyscalesgeneral_help'] = '**Le Scale di competenza **permettono di definire i criteri di misurazione di una competenza. Ad esempio, una scala potrebbe avere tre valori \'competente, competente con supervisione e non competente\'.

Impostare una scala di competenza prima di definire un quadro o qualsiasi altra competenza.';
$string['competencyevidenceproficiency_help'] = 'Questo campo indica se l\'utente è esperto o non nella competenza assegnata. Le opzioni visualizzate nell\'elenco a discesa dipendono dalla scala di competenza assegnata alla competenza, pertanto occorre selezionare la competenza prima di modificare questo campo. Deve essere impostato un Esperto prima di poter aggiungere o aggiornare un record di prova della competenza.';
$string['competencyevidenceposition_help'] = 'Questa opzione indica la posizione in cui si trovava l\'utente al momento del completamento dell\'elemento di prova della competenza. Nella maggior parte dei casi, corrisponde all\'organizzazione corrente dell\'utente. Dato che gli utenti cambiano ruolo con il tempo, qui è mantenuto un record del loro ruolo al momento del completamento. Questo campo è opzionale.';
$string['competencyevidencetimecompleted_help'] = 'E\' il record dell\'ora di completamento della prova di competenza.';
$string['competencyevidenceuser_help'] = 'L\'utente cui è assegnato questo elemento di prova della competenza. Non è possibile riassegnare un elemento di prova della competenza a un altro utente. Se si ha l\'autorizzazione, è possibile creare un nuovo elemento di prova della competenza per un utente, facendo clic sul pulsante della pagina Record personali dell\'utente. E\' anche possibile modificare la prova per quell\'utente andando al record che si trova nel report e facendo clic sull\'icona di modifica.';
$string['competencyframeworkdescription_help'] = 'La descrizione del quadro è un campo di testo per l\'archiviazione di informazioni aggiuntive sul quadro. E\' visualizzato sulla pagina di gestione delle competenze, sopra la tabella delle competenze.';
$string['competencyframework_help'] = 'Le competenze sono raggruppate o categorizzate e archiviate in un ‘Quadro di competenza’. Dopo aver impostato un quadro di competenza, è possibile definire le rispettive competenze.';
$string['competencyevidenceorganisation_help'] = 'Questa opzione indica l\'organizzazione in cui si trovava l\'utente al momento del completamento dell\'elemento di prova della competenza. Nella maggior parte dei casi, corrisponde all\'organizzazione corrente dell\'utente. Dato che gli utenti cambiano con il tempo, qui è mantenuto un record di dove si trovavano al momento del completamento. Questo campo è opzionale.';
$string['competencyevidencecompetency_help'] = 'La competenza da assegnare all\'utente. Se si modifica un elemento di prova della competenza esistente, questo non può essere modificato. Tuttavia, è possibile creare un nuovo elemento di prova della competenza (se si è autorizzati) visitando la pagina Record personali dell\'utente e facendo clic sul pulsante \'Aggiungi prova di competenza\'.

Quando viene creato un nuovo elemento di prova della competenza, si può scegliere di aggiungere una prova per una competenza esistente o di creare una nuova competenza. Se si sceglie \'Seleziona una competenza\', nella finestra a comparsa visualizzata occorre selezionare una delle competenze dell\'elenco. Se si sceglie \'Crea una nuova competenza\' viene visualizzato un modulo in cui occorre scegliere un quadro e definire la nuova competenza.

Non è possibile creare due elementi di prova delle competenze che si riferiscono allo stesso utente e competenza. Se si cerca di farlo, viene visualizzato un link per modificare il record originale o scegliere un\'altra competenza.';
$string['competencydescription_help'] = 'Un campo a testo libero in cui possono includere maggiori dettagli su questa competenza. Questi dati sono mostrati nella visualizzazione dell\'elenco di gerarchia e della pagina della competenza individuale.';
$string['competencyaggregationmethod_help'] = 'Il metodo di aggregazione definisce il modo in cui il sistema calcola il raggiungimento della competenza.

Se il metodo di aggregazione è impostato su Tutti, tutte le competenze secondarie dovranno essere raggiunte per la competenza principale prima che siano dichiarate complete.

Se il metodo di aggregazione è impostato su Qualsiasi, solo una delle competenze secondarie deve essere soddisfatta per raggiungere la competenza principale (e le sue relative competenze secondarie).

Se il metodo di aggregazione è impostato su Off, allora il aggiungimento automatico è disattivato per quella competenza. (Può comunque essere contrassegnata come completa manualmente).';
$string['competencyevidenceassessmenttype_help'] = 'Il campo del tipo di valutazione è un campo a testo libero per l\'immissione di informazioni aggiuntive sulla valutazione di questa competenza. I contenuti possono variare e il campo è opzionale.';
$string['competencyevidenceassessor_help'] = 'E\' possibile selezionare un valutatore, cioè un utente che ha valutato l\'abilità dell\'utente nella competenza in questione. Il campo del Valutatore è opzionale quindi nell\'elenco a discesa selezionare l\'opzione \'Seleziona un valutatore...\' se non si vuole assegnare un valutatore.

L\'elenco a discesa presenta tutti gli utenti moodle che hanno il ruolo di valutatore. Se l\'utente che si desidera aggiungere non è presente o non ci sono opzioni disponibili, rivolgersi a un amministratore per aggiungere quell\'utente al ruolo di valutatore.';
$string['competencyevidenceassessorname_help'] = 'Il campo Nome del valutatore si riferisce al nome dell\'organizzazione che ha eseguito la valutazione dell\'utente per quella competenza. Si tratta di un campo opzionale che può essere lasciato vuoto.';
$string['competencyscalevalueidnumber_help'] = 'Il numero ID della scala è un numero unico usato per rappresentare il valore della scala.';
$string['competencyframeworkfullname_help'] = 'Il nome completo del quadro è il titolo completo del quadro.';
$string['competencyscaleassign_help'] = 'Una Scala di competenza definisce i criteri di misurazione di una competenza. Si tratta del nome di scala cui viene aggiunto il valore.';
$string['competencyscale_help'] = '**La Scala** è il nome della Scala di competenza che è usata nel quadro di competenza.

La scala di competenza è impostata nel quadro di competenza. Solo una scala di competenza può essere usata in ciascun quadro.

E\' possibile impostare una nuova scala di competenza in Gerarchie/Competenze/Gestion quadri del menu \'Amministrazione sito\'.';
$string['competencyscaledefault_help'] = 'Il **Valore predefinito** viene assegnato automaticamente a un utente quando non ha ancora dimostrato la competenza richiesta dagli elementi di prova della competenza specificatia (completamento del corso/attività o raggiungimento del voto per il corso/attività).';
$string['competencyscaleproficient_help'] = 'Il valore di Esperto è un modo con cui il sistema tiene traccia dell\'abilità in una particolare competenza. Permette di seguire l\'evoluzione dei piani di formazione e visualizza gli avvisi di scadenza soltanto per le competenze incomplete.
Un utente è considerato \'Esperto\' se il valore di scala impostato ha \'esperto\' selezionato. Ci possono essere più valori di scala impostati su Esperto, e almeno un valore di scala deve essere impostato su Esperto. Questo valore può essere modificato mediante il valore di scala.

Il valore di scala inferiore che è contrassegnato come esperto è attribuito automaticamente a un utente che ha dimostrato l\'abilità richiesta dall\'elemento di prova specificata della competenza (ad es., completamento del corso/attività, superamento del livello di corso/attività).';
$string['competencyscalescalevalues_help'] = 'Immettere i valori per la scala per le competenze (uno per riga), dal più competente al meno competente. Ad esempio:

<p class="indent">
  <i> Competente<br /> Competente con supervisione<br /> Non competente<br /> </i>
</p>';
$string['competencyscalescalename_help'] = 'Il nome di scala della competenza che si trova nel riquadro Competenza.';
$string['competencyframeworkgeneral_help'] = '**I quadri di competenza **permettono di raggruppare le abilità, le conoscenze e i comportamenti richiesti al personale.

Le competenze possono essere raggruppate in diversi tipi di quadri. Ad esempio, un quadro potrebbe includere tutti gli standard di competenza nazionale del settore (presi da un ente governativo), e un altro potrebbe includere le competenze specifiche definite internamente.

Prima di impostare un quadro di competenza, occorre impostare una **Scala di competenza**.';
$string['competencyparent_help'] = '**Parent competency** permette di gestire le relazioni principale/secondario fra due competenze.

Selezionare la **Competenza principale** dall\'elenco a discesa. Selezionare **Top** se si desidera che la competenza sia collocata al livello superiore della gerarchia.

Se si modifica la competenza principale di un componente, questo passa a un livello inferiore rispetto al principale e tutti i secondari si spostano di conseguenza.

**Nota:** per impostare delle relazioni principale/secondario, occorre avere almeno un altro elemento nell\'ambito. Altrimenti, l\'opzione non verrà visualizzata.';
$string['competencyframeworks_help'] = '**I quadri di competenza **permettono di raggruppare le abilità, le conoscenze e i comportamenti richiesti al personale.

Le competenze possono essere raggruppate in diversi tipi di quadri. Ad esempio, un quadro potrebbe includere tutti gli standard di competenza nazionale del settore (presi da un ente governativo), e un altro potrebbe includere le competenze specifiche definite internamente.

Prima di impostare un quadro di competenza, occorre impostare una **Scala di competenza**.';
$string['competencyframeworkidnumber_help'] = 'Il numero ID del quadro è un numero unico che può essere usato per rappresentare il quadro.</h1>';
$string['competencyidnumber_help'] = 'Il numero ID della competenza è un numero unico usato per rappresentare la competenza.';
$string['competencyframeworkscale_help'] = 'Le scale di competenza permettono di definire i criteri per misurare una competenza. Ad esempio, una scala può avere tre valori ‘competente, competente con supervisione, not competente’.

Usare l\'opzione delle scale di competenza per aggiungere una nuova scala, quindi aggiungere i valori della scala che sono usati per definire l\'evoluzione di uno studente in una competenza. E\' possibile aggiungere il numero di valori desiderati. Ci sono impostazioni di valore Predefinito ed Esperto.';
$string['competencyframeworkshortname_help'] = 'Il nome abbreviato del quadro è un riferimento rapido al nome del quadro e può essere usato ai fini di visualizzazione.';
$string['competencyfullname_help'] = 'Il nome completo della competenza è il titolo completo della competenza.';
