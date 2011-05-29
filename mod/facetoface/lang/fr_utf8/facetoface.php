<?PHP // $Id$ 
      // facetoface.php - created with Moodle 1.9.12 (Build: 20110510) (2007101591.03)
      // local modifications from http://translate.totaralms.com


$string['addnewfield'] = 'Ajouter un nouveau champs personalisé';
$string['addnewfieldlink'] = 'Créer un nouveau champs personalisé';
$string['addnewnotice'] = 'Ajouter un nouveau message global';
$string['addnewnoticelink'] = 'Créer un nouveau message global';
$string['allowoverbook'] = 'Permettre surréservation';
$string['approvalreqd'] = 'Approbation requise';
$string['approve'] = 'Approuvé';
$string['attendeestablesummary'] = 'Les personnes ayant l\'intention de participer à la session (ou qui ont déjà participées)';
$string['calendaroptions'] = 'Options du calendrier';
$string['cancellationstablesummary'] = 'Liste de personnes qui se sont désinscrit de la session';
$string['cancelreason'] = 'Raison';
$string['conditions'] = 'Conditions';
$string['conditionsexplanation'] = 'Tout les critères suivants doivent être satisfaits pour être afficher au calendrier de formation:';
$string['costheading'] = 'Coût de la session';
$string['currentstatus'] = 'Statut actuel';
$string['customfieldsheading'] = 'Champs personalisés de la session';
$string['decidelater'] = 'Décider ultérieurement';
$string['decline'] = 'Refuser';
$string['edit'] = 'Modifier';
$string['enrolled'] = 'Inscrit';
$string['error:cannotemailuser'] = 'Echec de l\'envoi du  courriel pour l\'enregistrement $a->submissionid à l\'utilisateur $a->userid ($a->useremail).';
$string['error:cannotsendrequestmanager'] = 'Un problème est survenu pendant l\'envoie du message de demande d\'inscription au courriel de votre manager.';
$string['error:cannotsendrequestuser'] = 'Un problème est survenu pendant l\'envoie du message de demande d\'inscription à votre courriel.';
$string['error:couldnotaddfield'] = 'Impossible d\'ajouter un champs personalisé pour la session.';
$string['error:couldnotaddnotice'] = 'Impossible d\'ajouter une notification globale.';
$string['error:couldnotdeletefield'] = 'Impossible de supprimer le champs personalisé de session';
$string['error:couldnotdeletenotice'] = 'Impossible de supprimer une notification globale.';
$string['error:couldnotfindsession'] = 'Impossible de trouver la session ajoutée';
$string['error:couldnotsavecustomfield'] = 'Impossible d\'enregistrer le champs personalisé';
$string['error:couldnotupdatecalendar'] = 'Impossible de modifier l\'événement de session dans le calendrier.';
$string['error:couldnotupdatefield'] = 'Impossible de modifier le champs personalisé de session.';
$string['error:couldnotupdatenotice'] = 'Impossible de modifier la notification globale.';
$string['error:incorrectnotificationtype'] = 'Genre de notification fourni est non valide';
$string['error:manageremailaddressmissing'] = 'A present vous n\'avez pas de manager attribué à votre profile. Veuillez contacter l\'administrateur du site.';
$string['error:nomanagersemailset'] = 'Aucun addresse de courrier éléctronique est défini pour le manager';
$string['error:nopermissiontosignup'] = 'Vous n\'avez pas l\'autorisation de vous inscrire à cette session face à face.';
$string['error:sessionstartafterend'] = 'Echec: La date et heure du début de la session ne peuvent pas avoir lieu après sa fin.';
$string['error:signedupinothersession'] = 'Vous êtes déjà inscrit dans une autre session. Il est impossible de s\'inscrire à plusieurs sessions de la même activité face à face.';
$string['error:unknownbuttonclicked'] = 'Erreur : ce bouton n\'a aucun effet';
$string['field:multiselect'] = 'Sélection multiple';
$string['field:select'] = 'Menu de choix';
$string['field:text'] = 'Texte';
$string['fielddeleteconfirm'] = 'Souhaitez-vous supprimer le champ \'$a\' ainsi que toutes les données associées?';
$string['guestsno'] = 'Désolé, les guests ne sont pas autorisés à s\'inscrire aux sessions.';
$string['icalendarheading'] = 'Pieces-joints iCal';
$string['import'] = 'Importer';
$string['manageremailheading'] = 'Courriers éléctoniques du manager';
$string['noactionableunapprovedrequests'] = 'Aucune demande non approuvée à traiter';
$string['nocustomfields'] = '<p>Aucun champ personalisé est défini.</p>';
$string['nositenotices'] = '<p>Aucune notification globale est definie.</p>';
$string['noticedeleteconfirm'] = 'Souhaitez-vous supprimer la notification globale \'$a->name\'?<br/><blockquote>$a->text</blockquote>';
$string['noticetext'] = 'Texte de la notification';
$string['notsignedup'] = 'Vous n\'êtes pas inscrit à cette session.';
$string['placeholder:attendeeslink'] = '[attendeeslink]';
$string['previoussessionslist'] = 'Liste de toutes les sessions passées pour cette activité face à face';
$string['requestmessage'] = 'Envoyer un message';
$string['requeststablesummary'] = 'Les personnes demandant de participer à la session';
$string['sessioninprogress'] = 'Session en cours';
$string['sessionisfull'] = 'La session est complete. Veuillez choisir une autre session ou contacter l\'organisateur(ice).';
$string['sessionrequiresmanagerapproval'] = 'La réservation nécessite l\'approbation de votre manager.';
$string['sessionroles'] = 'Rôles de la session';
$string['sessionsdetailstablesummary'] = 'Description de la session actuelle.';
$string['setting:addchangemanageremaildefault'] = 'Demander aux utilisateurs l\'addresse courriel de leur manager.';
$string['setting:defaultrequestinstrmngrdefault'] = 'Ce message vous informe que votre coéquipier [firstname] [lastname] a demandé une réservation au cours affiché ci-dessous.

Cours: [facetofacename]
Coût: [cost]

Durée: [duration]
Date(s): 
[alldates]

Situation: [session:location]
Lieu: [session:venue]
Salle: [session:room]

Veuillez suivre le lien suivant afin d\'approuver la demande:
[attendeeslink]#unapproved


*** La demande de réservation de l\'utilisateur [firstname] [lastname] se trouve en copie ci-dessous ****';
$string['setting:defaultrequestsubjectdefault'] = 'Demande de réservation de cours : [facetofacename], [starttime]-[finishtime]';
$string['setting:defaultvalue'] = 'Valeur par défaut';
$string['setting:isfilter'] = 'Affichage comme filtre';
$string['setting:possiblevalues'] = 'Liste de valeurs possibles';
$string['setting:sessionroles'] = 'Les utilisateurs ayant un des rôles sélectionner peuvent être suivi avec chaque session face à face';
$string['setting:sessionroles_caption'] = 'Rôles de la session';
$string['setting:showinsummary'] = 'Afficher dans les listes et les exportation';
$string['setting:type'] = 'Genre de champ';
$string['showoncalendar'] = 'Afficher au calendrier';
$string['signupforthissession'] = 'M\'inscrire à cette session face à face';
$string['signups'] = 'Inscriptions';
$string['sitenoticesheading'] = 'Notifications globales';
$string['status_approved'] = 'Approuvé';
$string['status_booked'] = 'Réservé';
$string['status_declined'] = 'Refusé';
$string['status_fully_attended'] = 'Aucune absence';
$string['status_no_show'] = 'Aucune participation';
$string['status_partially_attended'] = 'Participation partielle';
$string['status_requested'] = 'Requis';
$string['status_session_cancelled'] = 'Session annulée';
$string['status_user_cancelled'] = 'Annulation par l\'utilisateur';
$string['status_waitlisted'] = 'Mis sur la liste d\'attente';
$string['timerequested'] = 'Heure demandée';
$string['unapprovedrequests'] = 'Demandes non approuvées';
$string['upcomingsessionslist'] = 'Afficher toutes les sessions futures de cette activité face à face';
$string['userwillbewaitlisted'] = 'Cette session est complète. Veuillez cliquer le bouton \"M\'inscrire\" afin d\'être mis sur la liste d\'attente.';
$string['validation:needatleastonedate'] = 'Il faut donner une date ou activer la liste d\'attente.';

?>
