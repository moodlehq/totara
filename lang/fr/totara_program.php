<?php

/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Strings for component 'totara_program', language 'fr', branch 'totara-2.2'
 * @package totara
 * @subpackage totara_program
 */

$string['action'] = 'Action';
$string['addcohortstoprogram'] = 'Ajouter des cohortes au programme';
$string['addcohorttoprogram'] = 'Ajouter une cohorte au programme';
$string['addcompetency'] = 'Ajouter une compétence';
$string['addcourse'] = 'Ajouter un cours';
$string['addcourses'] = 'Ajouter des cours';
$string['added'] = 'Ajouté';
$string['addindividualstoprogram'] = 'Ajouter des individus au programme';
$string['addindividualtoprogram'] = 'Ajouter un individu au programme';
$string['addmanagerstoprogram'] = 'Ajouter des gestionnaires au programme';
$string['addmanagertoprogram'] = 'Ajouter un gestionnaire au programme';
$string['addnew'] = 'Ajouter un nouveau';
$string['addnewprogram'] = 'Ajouter un nouveau programme';
$string['addorganisationstoprogram'] = 'Ajouter des organisations au programme';
$string['addorganisationtoprogram'] = 'Ajouter une organisation au programme';
$string['addorremovecourses'] = 'Ajouter/supprimer des cours';
$string['addpositiontoprogram'] = 'Ajouter un poste au programme';
$string['addprogramcontent_help'] = '# Ajouter des contenus au programme
En ajoutant des ensembles de cours, vous pouvez construire le chemin d\'apprentissage du programme. Une fois les ensembles ajoutés, les relations entre ensembles peuvent être configurées. Les ensembles peuvent être créés en ajoutant des cours manuellement, en choisissant une compétence prédéfinie ou en configurant un seul cours réccurent.
Une fois que plusieurs ensembles ont été créés, les diviseurs d\'ensembles sont utilisés pour permettre la création de séquences (dépendances) entre eux. Un programe d\'exemple comprenant quatre ensembles de cours définis peut avoir les dépendances suivantes :
* A partir du premier ensemble, l\'apprenti doit achever un cours (coursA ou coursB) avant de continuer vers l\'ensemble deux.
* A partir de l\'ensemble deux l\'apprenti doit achever tous les cours (coursC, coursD et coursE) avant de passer à l\'ensemble trois ou quatre.
* A partir de l\'ensemble trois l\'apprenti doit achever un cours (coursE) ou tous les cours de l\'ensemble quatre (coursF et coursGà).
Une fois le chemin d\'apprentissage achevé, l\'apprenti a achevé le programme.
Les ensembles peuvent être créés en ajoutant :
## Ensemble de cours
Permet la création de plusieurs ensembles de cours avec dépendances.
## Compétence
Permet la création de plusieurs ensembles de cours à partir d\'élément de preuve de compétence prédéfinis. Quand une compétence est utilisée pour créer un ensemble, celle-ci devient fixe et ne peut être modifiée.
## Cours unique
Force l\'autorisationn d\'un cours unique avec récurrence.
Après avoir choisi un ensemble de cours ou une compétence, le cours unique avec récurrence est retiré de la liste.';
$string['affectedusercount'] = 'Nombre d\'apprentis affectés par ces modifications :';
$string['afterprogramiscompleted'] = 'Après achèvement du programme';
$string['afterprogramisdue'] = 'Après la date limite du programme';
$string['aftersetisdue'] = 'Après la date limite de cet ensemble';
$string['allbelow'] = 'Tous ci-dessous';
$string['allbelowlower'] = 'tous ci-dessous';
$string['allcompletiontimeunknownissues'] = 'Toutes les questions de date limite inconnue';
$string['allcourses'] = 'Tous les cours';
$string['allcoursesfrom'] = 'tous les cours de';
$string['allcurrentlyassignedissues'] = 'Toutes les questions actuellement assignées';
$string['allextensionrequestissues'] = 'Toutes les demandes d\'extension';
$string['alllearners'] = 'Tous les apprentis';
$string['allowedtimeforprogramaslearner'] = 'Vous avez le droit à {$a->num} {$a->periodstr} pour compléter ce programme.';
$string['allowedtimeforprogramasmanager'] = '{$a->fullname} a le droit à {$a->num} {$a->periodstr} pour compléter ce programme.';
$string['allowedtimeforprogramviewing'] = 'Un apprenti a le droit à {$a->num} {$a->periodstr} pour compléter ce programme.';
$string['allowtimeforprogram'] = 'Donner le droit à {$a->num} {$a->periodstr} pour compléter ce programme.';
$string['allowtimeforset'] = 'Donner le droit à {$a->num} {$a->periodstr} pour compléter cet ensemble.';
$string['alltimeallowanceissues'] = 'Toutes les questions liées aux délais';
$string['and'] = 'et';
$string['anothercourse'] = 'un autre cours';
$string['areyousuredeletemessage'] = 'Voulez-vous vraiment supprimer ce message ?';
$string['assignedasindividual'] = 'Assigner en tant qu\'individu.';
$string['assignmentcriterialearner'] = 'Il vous est demandé de compléter le programme d\'après les critères suivants :';
$string['assignmentcriteriamanager'] = 'L\'apprenti doit compléter ce programme d\'après les critères suivants :';
$string['assignments'] = 'Affectations';
$string['availability'] = 'Disponibilité';
$string['availablefrom'] = 'Disponible du';
$string['availabletostudents'] = 'Disponible pour les étudiants';
$string['availabletostudentsnot'] = 'Indisponible pour les étudiants';
$string['availableuntil'] = 'Disponible jusqu\'à';
$string['backtoallextrequests'] = 'Retour à toutes les demandes d\'extension';
$string['beforecourseends'] = 'avant la fin du cours';
$string['beforeprogramisdue'] = 'Avant la date limite du programme';
$string['beforesetisdue'] = 'Avant la date limite de l\'ensemble';
$string['browsecategories'] = 'Parcourir les catégories';
$string['cancel'] = 'Annuler';
$string['cancelprogramblurb'] = 'Annuler supprimera toutes les modifications non enregistrées.';
$string['cancelprogrammanagement'] = 'Effacer les modifications non enregistrées';
$string['category'] = 'Catégorie';
$string['changecourse'] = 'Modifier le cours';
$string['checkprogramdelete'] = 'Voulez-vous vraiment supprimer le programme et tous les objets liés ?';
$string['chooseicon'] = 'Choisir une icône à insérer';
$string['chooseitem'] = 'Choisir objet';
$string['choseautomaticallydetermine'] = 'Vous avez choisi de laisser le système déterminer automatiquement une date limite réaliste pour la réalisation de ce programme.';
$string['chosedenyextensionexception'] = 'Vous avez choisi de refuser la ou les demandes d\'extension suivantes';
$string['chosedismissexception'] = 'Vous avez choisi de retirer cette exception';
$string['chosegrantextensionexception'] = 'Vous avez choisi d\'accepter la ou les demandes d\'extension suivantes';
$string['choseoverrideexception'] = 'Vous avez choisi d\'écraser l\'exception et de continuer avec cette affectation';
$string['cohort'] = 'Cohorte';
$string['cohortname'] = 'Nom de cohorte';
$string['cohorts'] = 'Cohortes';
$string['cohorts_category'] = 'cohorte(s)';
$string['competency'] = 'Compétence';
$string['competencycourseset_help'] = '# Ensemble de cours par compétences
Cet ensemble a été créé à partir d\'une compétence prédéterminée.
Quand une compétence est utilisée pour créer un ensemble, celle-ci devient fixe et ne peut être modifiée. Les cours de l\'ensemble ne peuvent être modifiés. Si les cours de cet ensemble doivent être modifiés, un ensemble de cours manuel doit être créé et les cours ajoutés un à un.
Les options d\'opérateurs dans un ensemble de cours par compétence (\'un cours\' ou \'tous les cours\') sont déterminés par les paramètres de compétence prédéfinis.';
$string['complete'] = 'Achevé';
$string['completeallcourses'] = 'Tous les cours de cet ensemble doivent être achevés (sauf si ensemble optionnel).';
$string['completeanycourse'] = 'Chaque cours de cet ensemble doit être achevé.';
$string['completeby'] = 'Achevé par';
$string['completebytime'] = 'Achevé par {$a}';
$string['completewithin'] = 'Achevé d\'ici';
$string['completewithinevent'] = 'Achevé d\'ici {$a->num} {$a->period} de {$a->event} {$a->instance}';
$string['completioncriteria'] = 'Critères d\'achèvement';
$string['completiondate'] = 'Date de fin';
$string['completionofcourse'] = 'achèvement du cours';
$string['completionofprogram'] = 'cours achevé';
$string['completionstatus'] = 'Statut';
$string['completiontimeunknown'] = 'Temps d\'achèvement inconnu';
$string['completiontype_help'] = '# Type d\'achèvement
Les options d\'opérateurs (\'L\'apprenti doit achever\') au sein d\'un ensemble sont \'un cours\', signifiant OU ou \'tous les cours\' signifiant ET. L\'idée est de garder un flux facilement lisible pour les humains. Selon l\'option choisie, le texte devant les cours sera modifié automatiquement.';
$string['confirmassignmentchanges'] = 'Confirmer les modifications d\'affectation';
$string['confirmcontentchanges'] = 'Confirmer les modifications du contenu';
$string['confirmmessagechanges'] = 'Confirmer les modifications de messages';
$string['confirmresolution'] = 'Confirmer la résolution de problèmes';
$string['content'] = 'Contenu';
$string['contentupdatednotsaved'] = 'Contenu du programme modifié (pas encore enregistré)';
$string['continue'] = 'Continuer';
$string['couldnotinsertnewrecord'] = 'Impossible d\'insérer un nouvel enregistrement';
$string['course'] = 'Cours';
$string['coursecompletion'] = 'Achèvement du cours';
$string['coursecreation_help'] = '# Création de cours
La création de cours définit le moment où le cours doit être copié et recréé.
Cela se base sur les dates de début et de fin spécifiées dans les paramètres du cours.';
$string['coursename'] = 'Nom du cours';
$string['coursenamelink'] = 'Nom du cours';
$string['courses'] = 'Cours';
$string['coursesetcompleted'] = 'Ensemble de cours achevé';
$string['coursesetcompletedmessage_help'] = '# Message d\'achèvement de l\'ensemble de cours
Ce message sera envoyé à chaque fois qu\'un ensemble de cours est achevé.';
$string['coursesetdue'] = 'Date limite de l\'ensemble de cours';
$string['coursesetduemessage_help'] = '# Message de date de fin de cours
Ce message sera envoyé au moment spécifié avant la date de fin du cours.';
$string['coursesetoverdue'] = 'Date limite de l\'ensemble de cours dépassée';
$string['coursesetoverduemessage_help'] = '# Message après date de fin d\'ensemble de cours
Ce message sera envoyé au moment spécifié après la date de fin de l\'ensemble de cours.';
$string['createandnext'] = 'Créer et passer à l\'étape suivante';
$string['createandreturn'] = 'Créer et revenir à la vue d\'ensemble';
$string['createcourse'] = 'Créer le cours';
$string['createnewprogram'] = 'Créer un nouveau programme';
$string['createprogram'] = 'Créer un programme';
$string['currentduedate'] = 'Date limite actuelle';
$string['currenticon'] = 'Icône actuelle';
$string['currentlyassigned'] = 'Actuellement affecté';
$string['dateinprofilefield'] = 'date du champ profil';
$string['days'] = 'Jour(s)';
$string['daysremaining'] = '{$a} jours restants';
$string['defaultenrolmentmessage_message'] = 'Vous faites désormais partie du programme %programfullname%.';
$string['defaultenrolmentmessage_subject'] = 'Vous avez été engagé dans le programme %programfullname%.';
$string['defaultexceptionreportmessage_message'] = 'Il existe des exceptions dans le programme %programfullname% qui doivent être résolues.';
$string['defaultexceptionreportmessage_subject'] = 'Des exceptions demandent une attention particulière dans le programme %programfullname%.';
$string['defaultprogramfullname'] = 'Nom complet du programme 101';
$string['defaultprogramshortname'] = 'P101';
$string['delete'] = 'Supprimer';
$string['deletecourse'] = 'Supprimer cours';
$string['deleteprogram'] = 'Supprimer programme "{$a}"';
$string['deleteprogrambutton'] = 'Supprimer programme';
$string['deny'] = 'Refuser';
$string['denyextensionrequest'] = 'Refuser la demande d\'extension';
$string['description'] = 'Description';
$string['details'] = 'Détails';
$string['directteam'] = 'équipe directe';
$string['dismissandtakenoaction'] = 'Refuser et ne prendre aucune mesure';
$string['duedate'] = 'Date limite';
$string['duedatenotset'] = 'Pas de date limité configurée';
$string['duestatus'] = 'Date limite/Statut';
$string['editassignments'] = 'Modifier affectations';
$string['editcontent'] = 'Modifier contenu';
$string['editmessages'] = 'Modifier messages';
$string['editprogramassignments'] = 'Modifier affectations du programme';
$string['editprogramcontent'] = 'Modifier contenus du programme';
$string['editprogramdetails'] = 'Modifier les détails du programme';
$string['editprogrammessages'] = 'Modifier messages du programme';
$string['editprogramroleassignments'] = 'Modifier les affectations de rôles du programme';
$string['editprograms'] = 'Ajouter/éditer les programmes';
$string['endnote'] = 'Note de fin du programme';
$string['enrolmentmessage_help'] = '# Message d\'engagement
Ce message sera envoyé automatiquement à chaque fois qu\'un utilisateur sera affecté automatiquement à un programme.';
$string['error:availibileuntilearlierthanfrom'] = 'La date disponible jusqu\'à ne peut être passée';
$string['error:badcheckvariable'] = 'La variable de vérification est erronée - veuillez réessayer';
$string['error:cannotrequestextnotuser'] = 'Vous ne pouvez demander une extension pour un autre utilisateur';
$string['error:couldnotloadextension'] = 'Erreur, impossible de charger l\'extension';
$string['error:coursecreation_nonzero'] = 'La date de création du cours doit être supérieur à 0 jour avant la fin du cours';
$string['error:courses_endenroldate'] = 'Vous devez choisir une date de fin d\'engagement pour ce cours, si vous souhaitez qu\'il se répète';
$string['error:courses_nocourses'] = 'Les ensembles de cours doivent comprendre au moins un cours.';
$string['error:deleteset'] = 'Impossible de supprimer l\'ensemble. Ensemble non trouvé.';
$string['error:failedsendextensiondenyalert'] = 'Erreur, impossible d\'alerter l\'utilisateur du refus de sa demande d\'extension';
$string['error:failedsendextensiongrantalert'] = 'Erreur, impossible d\'alerter l\'utilisateur de l\'acceptation de sa demande d\'extension';
$string['error:failedtofindmanagerrole'] = 'Impossible de trouver le rôle pour ce nom abrégé de gestionnaire';
$string['error:failedtofindstudentrole'] = 'Impossible de trouver le rôle pour ce nom abrégé d\'étudiant';
$string['error:failedtofinduser'] = 'Impossible de trouver l\'utilisateur avec l\'id {$a}';
$string['error:failedupdateextension'] = 'Erreur, impossible de modifier le programme avec la nouvelle date limite';
$string['error:inaccessible'] = 'Vous ne pouvez actuellement pas accéder à ce programme';
$string['error:invaliddate'] = 'La date n\'est pas valide';
$string['error:invalidid'] = 'Il s\'agit du id programme invalide';
$string['error:invalidshortname'] = 'Il s\'agit du nom abrégé de programme invalide';
$string['error:invaliduser'] = 'Erreur, utilisateur non valide';
$string['error:mainmessage_empty'] = 'Le message est requis';
$string['error:messagesubject_empty'] = 'Le sujet du message est requis';
$string['error:nopermissions'] = 'Vous n\'avez pas les permissions nécessaires pour effectuer cette action';
$string['error:noprogramcompletionfound'] = 'Aucun enregistrement de programme achevé trouvé';
$string['error:notusersmanager'] = 'Vous n\'êtes pas le gestionnaire de l\'utilisateur ayant demandé l\'extension';
$string['error:processingextrequest'] = 'Une erreur est survenue lors du traitement de la demande d\'extension';
$string['error:recurrence_nonzero'] = 'La récurrence doit être supérieur à 0';
$string['error:setunableaddcompetency'] = 'Impossible d\'ajouter la compétence à l\'ensemble. L\'ensemble ou la compétence n\'a pas été trouvé.';
$string['error:setunabletoaddcourse'] = 'Impossible d\'ajouter le cours à l\'ensemble. Le cours ou l\'ensemble n\'a pas été trouvé.';
$string['error:setunabletodeletecourse'] = 'Impossible de supprimer le cours de l\'ensemble {$a}';
$string['error:setupprogcontent'] = 'Impossible de configurer le contenu du programme';
$string['error:timeallowednum_nonzero'] = 'Le temps accordé doit être supérieur à zéro';
$string['error:unabletoaddset'] = 'Impossible d\'ajouter un nouvel ensemble. Le type d\'ensemble n\'a pas été reconnu.';
$string['error:unabletosetupprogcontent'] = 'Impossible de configurer le contenu du programme.';
$string['error:updateextensionstatus'] = 'Erreur, impossible de modifier le statut de l\'extension';
$string['errorsinform'] = 'Il existe des erreurs dans ce formulaire. Veuillez vérifier la liste ci-dessous et corriger les erreurs avant d\'enregistrer.';
$string['eventnotfound'] = 'L\'événement d\'affectation du programme d\'id {$a} n\'a pas été trouvé.';
$string['exceptionreportmessage_help'] = '# Message de rapport d\'exception
Ce message sera envoyé à l\'administrateur du site à chaque fois que des nouvelles exceptions seront ajoutées au rapport d\'exception du programme.';
$string['exceptions'] = 'Rapport d\'exception ({$a})';
$string['exceptionsreport'] = 'Rapport d\'exception';
$string['extenduntil'] = 'Etendu jusqu\'à';
$string['extensionbeforenow'] = 'Impossible de demander une extension à une date passée';
$string['extensiondate'] = 'Date d\'extension';
$string['extensiondenied'] = 'Extension refusée';
$string['extensiondeniedmessage'] = 'Votre demande d\'extension a été refusée.';
$string['extensionearlierthanduedate'] = 'La date d\'extension ne peut être inférieure à la date limite actuelle';
$string['extensiongranted'] = 'Extension accordée';
$string['extensiongrantedmessage'] = 'Une extension vous a été accordée jusqu\'au {$a}.';
$string['extensionrequest'] = 'Demande d\'extension';
$string['extensionrequestfailed'] = 'Echec de la demande d\'extension. Veuillez réessayer.';
$string['extensionrequestfailed:nomanager'] = 'La demande d\'extension n\'a pas été envoyée. Le gestionnaire n\'a pas été trouvé.';
$string['extensionrequestmessage'] = '<p>Un utilisateur a demandé l\'extension du programme <em>{$a->programfullname}</em>. Voici les détails de la requête :</p><ul><li>Date : {$a->extensiondatestr}</li><li>Motif : {$a->extensionreason}</li></ul>
extensionrequestmessage';
$string['extensionrequestmessage_help'] = '# Message de demande d\'extension
Ce message sera envoyé au gestionnaire de l\'apprenti à chaque fois qu\'une demande d\'extension du programme est effctuée.';
$string['extensionrequestnotsent'] = 'La demande d\'extension n\'a PAS été envoyée. Veuillez réessayer.';
$string['extensionrequestsent'] = 'La demande d\'extension a été envoyée.';
$string['extensions'] = 'Extensions';
$string['failedtoresolve'] = 'Impossible de résoudre les exceptions suivantes';
$string['findprograms'] = 'Trouver des programmes';
$string['firstlogin'] = 'Premier login';
$string['for'] = 'Pour';
$string['fullname'] = 'Nom complet';
$string['grant'] = 'Accorder';
$string['grantdeny'] = 'Accorder / Refuser';
$string['grantextensionrequest'] = 'Accorder la demande d\'extension';
$string['header:hash'] = '#';
$string['header:id'] = 'ID';
$string['header:issue'] = 'Question';
$string['header:learners'] = 'Apprentis';
$string['holdposof'] = 'Poste de \'{$a}\'';
$string['hours'] = 'Heure(s)';
$string['icon'] = 'Icône';
$string['idnumberprogram'] = 'ID';
$string['incomplete'] = 'Non achevé';
$string['individualname'] = 'Nom de l\'individu';
$string['individuals'] = 'Individus';
$string['individuals_category'] = 'individu(s)';
$string['instructions:assignments1'] = 'Les catégories peuvent être utilisées pour affecter le programme à des ensembles d\'apprents.';
$string['instructions:messages1'] = 'Configurez les déclencheurs d\'événements et de rappels associés au programme.';
$string['instructions:programassignments'] = 'Affectez des apprentis en masse et sélectionnez des critères d\'achèvement relatifs ou fixes<br />(Affecter des apprentis par organisation, poste, cohorte, hiérarchie ou individuellement)';
$string['instructions:programcontent'] = 'Définissez le contenu du programme en ajoutant des ensembles de cours et / ou compétences';
$string['instructions:programdetails'] = 'Définissez le nom du programme, sa disponibilité et sa description';
$string['instructions:programexceptions'] = 'Traitez rapidement les questions liées aux affectations en choisissant \'type\' et en appliquant une \'action\'';
$string['instructions:programmessages'] = 'Définissez les messages et rappels du programme comme demandé';
$string['label:competencyname'] = 'Nom de la compétence';
$string['label:coursecreation'] = 'Quand créer un nouveau cours';
$string['label:learnermustcomplete'] = 'L\'apprenti doit achever';
$string['label:message'] = 'Message';
$string['label:nextsetoperator'] = 'Prochain opérateur d\'ensemble';
$string['label:noticeformanager'] = 'Note pour le gestionnaire';
$string['label:recurcreation'] = 'Création du cours';
$string['label:recurrence'] = 'Récurrence';
$string['label:sendnoticetomanager'] = 'Envoyer une note au gestionnaire';
$string['label:setname'] = 'Choisir nom';
$string['label:subject'] = 'Sujet';
$string['label:timeallowance'] = 'Temps imparti';
$string['label:trigger'] = 'Déclencheur';
$string['launchcourse'] = 'Démarrer le cours';
$string['launchprogram'] = 'Démarrer le programme';
$string['learnerenrolled'] = 'Apprenti enrôlé';
$string['learnerfollowup'] = 'Suivi apprenti';
$string['learnerfollowupmessage_help'] = '# Message de suivi
Ce message sera envoyé à l\'étudiant au moment spécifié après achèvement du programme.';
$string['learnersassigned'] = '{$a->total} apprenti(s) affecté(s). {$a->assignments} apprenti(s) sont actifs, {$a->exceptions} avec des exception(s)';
$string['learnersselected'] = 'apprentis sélectionnés';
$string['learnerunenrolled'] = 'Apprenti dé-affecté';
$string['legend:courseset'] = 'Ensemble de cours {$a}';
$string['legend:coursesetcompletedmessage'] = 'MESSAGE D\'ENSEMBLE DE COURS ACHEVE';
$string['legend:coursesetduemessage'] = 'MESSAGE DE DATE LIMITE D\'ENSEMBLE DE COURS ATTEINTE';
$string['legend:coursesetoverduemessage'] = 'MESSAGE DE DATE LIMITE D\'ENSEMBLE DE COURS DEPASSEE';
$string['legend:enrolmentmessage'] = 'MESSAGE D\'ENGAGEMENT';
$string['legend:exceptionreportmessage'] = 'MESSAGE DE RAPPORT D\'EXCEPTION';
$string['legend:extensionrequestmessage'] = 'MESSAGE DE DEMANDE D\'EXTENSION';
$string['legend:learnerfollowupmessage'] = 'MESSAGE DE SUIVI APPRENTI';
$string['legend:programcompletedmessage'] = 'MESSAGE DE PROGRAMME ACHEVE';
$string['legend:programduemessage'] = 'MESSAGE DE DATE LIMITE DU PROGRAMME ATTEINTE';
$string['legend:programoverduemessage'] = 'MESSAGE DE DATE LIMITE DU PROGRAMME DEPASSEE';
$string['legend:recurringcourseset'] = 'Ensemble de cours récurrent';
$string['legend:unenrolmentmessage'] = 'MESSAGE DE DESENGAGEMENT';
$string['mainmessage_help'] = '# Corps du message
Le corps du message sera affiché aux destinatairres du messages sur leur panneau de contrôle.
Le corps du message peut contenir des variables qui seront remplacées lors de l\'envoi du message. ';
$string['manageextensionrequests'] = 'Voir le rapport d\'exception pour accorder ou refuser les demandes d\'extension';
$string['manageextensions'] = 'Gérer les extensions';
$string['managementhierarchy'] = 'Hiérarchie de gestion';
$string['managermessage_help'] = '# Note pour gestionnaire
Si la case \'Envoyer note au gestionnaire\' est cochée, le gestionnaire du destinataire du message recevra aussi une note qui peut être spécifiée dans ce champ.
La note au gestionnaire peut contenir des variables qui seront remplacées dans le message envoyé.';
$string['managername'] = 'Nom du gestionnaires';
$string['managers_category'] = 'équipe(s) degestion';
$string['mandatory'] = 'Obligatoire';
$string['memberofcohort'] = 'Membre de la cohorte \'{$a}\'.';
$string['memberoforg'] = 'Membre de l\'organisation \'{$a}\'.';
$string['messages'] = 'Messages';
$string['messagesubject_help'] = '# Sujet du message
Le sujet du message affiché aux destinataires sur leur panneau de contrôle. 255 caractères max.
Le sujet peut contenir des variables qui seront remplacées dans le message envoyé.';
$string['missingshortname'] = 'Nom abrégé manquant';
$string['months'] = 'Mois';
$string['movedown'] = 'Vers le bas';
$string['moveselectedprogramsto'] = 'Déplacer les programmes sélectionnés vers...';
$string['moveup'] = 'Vers le haut';
$string['multicourseset_help'] = '# Ensemble de cours
Il s\'agit d\'un ensemble de cours choisis individuellement à partir du catalogue de cours.
Vous pouvez définir le nom de l\'ensemble, si l\'apprenti doit achever un ou tous les cours, et les délais généralement alloués pour achever l\'ensemble.';
$string['nocoursecontent'] = 'Pas de contenu de cours.';
$string['nocourses'] = 'Pas de cours';
$string['noduedate'] = 'Pas de date limite';
$string['noextensions'] = 'Personne dans votre personnel n\'a demandé d\'extensions.';
$string['noprogramassignments'] = 'Le programme ne contient aucune affectation';
$string['noprogramcontent'] = 'Le programme ne contient aucun contenu';
$string['noprogramexceptions'] = 'Aucune exception';
$string['noprogrammessages'] = 'Le programme ne contient aucun message';
$string['noprograms'] = 'Aucun programme';
$string['noprogramsfound'] = 'Aucun programme trouvé avec les mots \'{$a}\'';
$string['noprogramsyet'] = 'Pas de programmes dans cette catégorie';
$string['norequiredlearning'] = 'Aucun apprentissage requis';
$string['notavailable'] = 'Indisponible';
$string['notifymanager_help'] = '# Envoyer note au gestionnaire
Cochez cette case si vous voulez aussi envoyer une note au gestionnaire du destinataire du message.';
$string['notmanager'] = 'Vous n\'êtes pas un gestionnaire';
$string['nouserextensions'] = '{$a} n\'a aucune demande d\'extension en attente';
$string['novalidprograms'] = 'Aucun programme valide';
$string['numlearners'] = '# apprentis';
$string['of'] = 'sur';
$string['ok'] = 'Ok';
$string['onecourse'] = 'Un cours';
$string['onecoursesfrom'] = 'un cours de';
$string['onedayremaining'] = '1 jour restant';
$string['or'] = 'ou';
$string['organisationname'] = 'Nom d\'organisation';
$string['organisations'] = 'Organisations';
$string['organisations_category'] = 'organisation(s)';
$string['orviewprograms'] = 'ou afficher les programmes dans cette catégorie({$a})';
$string['overrideandaddprogram'] = 'Ecraser et ajouter un programme';
$string['overview'] = 'Vue d\'ensemble';
$string['partofteam'] = 'Membre de l\'équipe \'{$a}\'.';
$string['pendingextension'] = 'Vous avez actuellement une demande d\'extension en attent';
$string['pleaseentervaliddate'] = 'Veuillez entrer une date valide au format {$a}.';
$string['pleaseentervalidreason'] = 'Veuillez entrer un motif valide';
$string['pleaseentervalidunit'] = 'Veuillez entrer un nombre valable entre 0 et 999';
$string['pleasepickaninstance'] = 'Veuillez sélectionner un objet';
$string['pleasesetcompletiontimes'] = 'Veuillez configurer une date de fin pour tous les objets';
$string['positions'] = 'Postes';
$string['positions_category'] = 'poste(s)';
$string['positionsname'] = 'Noms de postes';
$string['positionstartdate'] = 'Date de début du poste';
$string['profilefielddate'] = 'Date du champ de profil';
$string['prog_courseset_completed_message'] = 'Message d\'achèvement d\'un ensemble de cours';
$string['prog_courseset_due_message'] = 'Message de fin de cours';
$string['prog_courseset_overdue_message'] = 'Message de date de fin de cours dépassée';
$string['prog_enrolment_message'] = 'Message d\'engagement';
$string['prog_exception_report_message'] = 'Message de rapport d\'exception';
$string['prog_extension_request_message'] = 'Message de demande d\'extension';
$string['prog_learner_followup_message'] = 'Message de suivi d\'apprenti';
$string['prog_program_completed_message'] = 'Message de programme achevé';
$string['prog_program_due_message'] = 'Message de date de fin du programme';
$string['prog_program_overdue_message'] = 'Message de date de fin du programme dépassée';
$string['prog_unenrolment_message'] = 'Message de désengagement';
$string['prognamelinkedicon'] = 'Nom du programme et icône liée';
$string['program'] = 'Programme';
$string['program:accessanyprogram'] = 'Accéder à tout programme';
$string['program:configureassignments'] = 'Configurer les affectations du programme';
$string['program:configurecontent'] = 'Configurer le contenu du programme';
$string['program:configuremessages'] = 'Configurer les messages du programme';
$string['program:configureprogram'] = 'Configurer les programmes';
$string['program:createprogram'] = 'Créer des programmes';
$string['program:handleexceptions'] = 'Gérer les exceptions du programme';
$string['program:manageextensions'] = 'Gérer les extensions';
$string['program:viewhiddenprograms'] = 'Afficher les programmes cachés';
$string['program:viewprogram'] = 'Afficher les programmes';
$string['programassignments'] = 'Affectations au programme';
$string['programassignmentssaved'] = 'Affecations au programme enregistrées';
$string['programavailability_help'] = '# Disponibilité du programme
Cette option vous permet de "cacher" votre programme complètement.
Il ne figurera dans aucune liste de programmes, à part pour les administrateurs.
Même si des étudiants essayent directement d\'accéder à l\'URL du programme, ils ne seront pas autorisés à entrer.
Si vous configurez les dates "Disponible de" et "Disponible jusqu\'à", les étudiants pourront trouver en entrer dans le programme pendant la période spécifiée par ces dates, mais ne pourront pas y accéder en dehors.';
$string['programcategory_help'] = '# Catégories de programme/cours
Votre administrateur Moodle peut avoir configuré plusieurs catégories de programmes/cours.
Par exemple, "Science", "Sciences humaines", "Santé publique" etc..
Choisissez la catégoriant correspondant le mieux à votre programme. Ce choix affectera le lieu d\'affichage de votre programme sur la liste de programmes et peut le rendre plus facile à trouver pour vos apprentis.';
$string['programcompleted'] = 'Programme achevé';
$string['programcompletedmessage_help'] = '# Message d\'achèvement du programme
Ce message sera envoyé chaque fois qu\'un programme sera achevé.';
$string['programcompletion'] = 'Achèvement du programme';
$string['programcontent'] = 'Contenu du programme';
$string['programcontentsaved'] = 'Contenu du programme enregistré';
$string['programcreatefail'] = 'Impossible de créer le programme. Raison : "{$a}"';
$string['programcreatesuccess'] = 'Réussite de la création du programme';
$string['programdeletefail'] = 'Impossible de supprimer le programme "{$a}"';
$string['programdeletesuccess'] = 'Programme "{$a}" supprimé avec succès';
$string['programdetails'] = 'Détails du programme';
$string['programdetailssaved'] = 'Détails du programme enregistrés avec succès';
$string['programdue'] = 'Fin du programme';
$string['programduedate'] = 'Date de fin du programme';
$string['programduemessage_help'] = '# Message de fin du programme
Ce message sera envoyé au moment spécifié avant la fin d\'un programme.';
$string['programends'] = 'Le programme se termine';
$string['programexceptions'] = 'Exceptions du programme';
$string['programfullname_help'] = '# Nom complet du programme
Le nom complet du programme est affiché au sommet de l\'écran et dans les listes de programmes.';
$string['programicon'] = 'Icône du programme';
$string['programid'] = 'Id du programme';
$string['programidnotfound'] = 'Aucun programme n\'existe pour l\'ID : "{$a}"';
$string['programidnumber'] = 'Numéro Id programme';
$string['programidnumber_help'] = '# Numéro ID du programme
Le numéro ID du programme est seulement utilisé lors de la comparaison du cours avec les systèmes externes - il n\'est jamais affiché dans Moodle. si vous avez un nom de code officiel pour ce programme, utilisez-le ici... sinon vous pouvez laisser ce champ libre.';
$string['programlive'] = 'Attention : le programme est en cours';
$string['programmandatory'] = 'Obligations programme';
$string['programmessages'] = 'Messages programme';
$string['programmessagessaved'] = 'Messages enregistrés du programme';
$string['programmessagessavedsuccessfully'] = 'Les messages du programme ont bien été enregistrés';
$string['programname'] = 'Nom du programme';
$string['programnotavailable'] = 'Ce programme n\'est pas disponible pour les étudiants';
$string['programnotcurrentlyavailable'] = 'Ce programme n\'est actuellement pas disponible pour les étudiants';
$string['programnotlive'] = 'Le programme n\'est pas en cours';
$string['programoverdue'] = 'Date limite du programme dépassée';
$string['programoverduemessage_help'] = '# Message après date de fin de programme
Ce message sera envoyé au moment spécifié après la fin du programme.';
$string['programrecurring'] = 'Programme récurrent';
$string['programs'] = 'Programmes';
$string['programscomplete'] = 'Programmes achevés';
$string['programshortname'] = 'Nom abrégé du programme';
$string['programshortname_help'] = '# Nom abrégé du programme
Le nom abrégé du programme sera utilisé à plusieurs enddroits où le nom complet n\'est pas adapté (par exemple ligne de sujet d\'un message d\'alerte).';
$string['programsinthiscategory'] = 'Programmes dans cette catégorie ({$a})';
$string['programsmovedout'] = 'Programmes déplacés hors de {$a}';
$string['programupdatecancelled'] = 'Annulation de la mise à jour du programme';
$string['programupdatefail'] = 'Echec lors de la mise à jour du programme';
$string['programupdatesuccess'] = 'Programme mis à jour avec succès';
$string['programvisibility_help'] = '# Visibilité du programme
Si le programme est visible, celui-ci apparaîtra dans les listes de programmes et les résultats de recherche, et les apprentis pourront voir les contenus du programme.
Si le programme n\'est pas visible, il ne figurera pas dans les listes de programmes ou dans les résultats de recherche, mais le programme sera toujours affiché dans les projets d\'apprentissage des apprentis affectés au programme et les apprentis peuvent toujours accéder à l\'URL du programme.';
$string['progress'] = 'Progrès';
$string['reason'] = 'Motif de l\'extension';
$string['reasonforextension'] = 'Motif de l\'extension';
$string['recurrence_help'] = '# Récurrence
La récurrence définit la période de temps durant laquelle un cours doit être répété. La récurrence peut être spécifiée en jours, semaines ou mois.';
$string['recurring'] = 'Récurrent';
$string['recurringcourse'] = 'Cours récurrent';
$string['recurringcourse_help'] = '# Cours récurrent
Affiche le cours récurrent sélectionné.
Un seul cours peut être récurrent. Pour modifier le cours, sélectionnez un nouveau cours dans le menu déroulant et cliquez sur "Modifier le cours" pour enregistrer la modification.';
$string['recurringcourseset_help'] = '# Ensemble de cours récurrent
Un ensemble de cours récurrent n\'autorise la sélection que d\'un seul cours. Il est impossible de définir plusieurs cours à partir de différents ensembles ou différentes compétences.';
$string['recurringprogramhistory'] = 'Enregistrements de l\'historique du programme récurrent {$a}';
$string['recurringprogramhistoryfor'] = 'Enregistrements de l\'historique pour {$a->username} pour le programme récurrent {$a->progname}';
$string['recurringprograms'] = 'Programmes récurrents';
$string['removed'] = 'Supprimé';
$string['repeatevery'] = 'Répéter chaque';
$string['requestextension'] = 'Demander une extension';
$string['requiredlearning'] = 'Apprentissage requis';
$string['requiredlearninginstructions'] = 'Vos apprentissages requis sont affichés ci-dessous.';
$string['requiredlearninginstructionsuser'] = 'Les apprentissages requis pour {$a} sont affichés ci-dessous.';
$string['returntoprogram'] = 'Retour au programme';
$string['rolprogramsourcename'] = 'Historique d\'apprentissage : Programmes';
$string['saveallchanges'] = 'Enregistrer toutes les modifications';
$string['saveprogram'] = 'Enregistrer le programme';
$string['searchforindividual'] = 'Chercher un individu par nom ou ID';
$string['searchprograms'] = 'Chercher des programmes';
$string['select'] = 'Choisir';
$string['selectcompetency'] = 'Choisir une compétence';
$string['selectcourse'] = 'Choisir un cours';
$string['setcompletion'] = 'Choisir achèvement';
$string['setfixedcompletiondate'] = 'Choisir une date d\'achèvement fixe';
$string['setlabel_help'] = '# Label de l\'ensemble de cours
Utilisez le label de l\'ensemble de cours pour décrire le groupe de cours de l\'ensemble.
Le but est de rendre chaque ensemble plus lisible et faciliter la compréhension du chemin d\'apprentissage par les apprentis. Par exemple, le premier ensemble de cours peut s\'appeler "Phase Une - Introduction" et le second "Phase Deux - Santé et sécurité".';
$string['setofcourses'] = 'Ensemble de cours';
$string['setrealistictimeallowance'] = 'Choisir un délai réaliste';
$string['settimerelativetoevent'] = 'Choisir une date relative à un événement';
$string['shortname'] = 'Nom abrégé';
$string['showingresults'] = 'Affichage des résultats {$a->from} - {$a->to} sur {$a->total}';
$string['source'] = 'Source';
$string['startdate'] = 'Date de début';
$string['startinposition'] = 'Poste de départ';
$string['status'] = 'Statut';
$string['successfullyresolvedexceptions'] = 'Exceptions résolues avec succès';
$string['summary'] = 'Résumé';
$string['then'] = 'puis';
$string['therearenoprogramstodisplay'] = 'Aucun programme à afficher';
$string['thisactioncannotbeundone'] = 'Cette action ne peut être annulée';
$string['thiswillaffect'] = 'Ceci affectera {$a} apprentis';
$string['timeallowance'] = 'Temps alloué';
$string['timeallowance_help'] = '# Allocation de temps
Paramètre la quantité de temps impartie avant l\'achèvement des cours de l\'ensemble. Il s\'agit d\'une indication générale du temps restant avant l\'achèvement de l\'ensemble, et non la durée réelle que le cours nécessite. Celui-ci peut être paramétré au niveau du cours.';
$string['toprogram'] = 'au programme';
$string['tosaveassignments'] = 'Pour enregistrer toutes les modifications d\'affactations, cliquez sur \'Enregistrez toutes les modifications\'. Pour modifier les modifications d\'affectations, cliquez sur \'Modifier les affectations\'. Il est impossible d\'annuler l\'enregistrement des affectations.';
$string['tosavecontent'] = 'Pour enregistrer toutes les modifications de contenus, cliquez sur \'Enregistrez toutes les modifications\'. Pour modifier les modifications d\'affectations, cliquez sur \'Modifier les affectations\'. Il est impossible d\'annuler l\'enregistrement des contenus.';
$string['tosavemessages'] = 'Pour enregistrer toutes les modifications de messages, cliquez sur \'Enregistrez toutes les modifications\'. Pour modifier les modifications d\'affectations, cliquez sur \'Modifier les affectations\'. Il est impossible d\'annuler l\'enregistrement des messages.';
$string['total'] = 'Total';
$string['totalassignments'] = 'Affecations potentielles totales';
$string['totalassignments_help'] = '# Affectations totales
Le nombre total d\'affectations affiché sur la page d\'affectations du programme et la page d\'ensemble, représentant le nombre total d\'apprentis dans toutes les catégories attribuées et non le nombre d\'apprentis actuellement affectés au programme.
Si un apprenti appartient à une organisation qui se voit attribuer un programme et qui occupe est poste affecté au programme, alors l\'apprenti devra être compté dans chaque catégories (mais ne sera affecté au programme qu\'une seule fois).';
$string['trigger_help'] = '# Déclencheur
Le déclencheur de temps détermine quand le message lié à l\'événement est envoyé (par example 4 semaines après achèvement du programme).';
$string['type'] = 'Type';
$string['unenrolment'] = 'Désengagement';
$string['unenrolmentmessage_help'] = '# Message de désengagement
Ce message est envoyé à chaque fois qu\'un utilisateur est désengagé d\'un programme.';
$string['unknownexception'] = 'Exception inconnue';
$string['unknownusersrequiredlearning'] = 'Apprentissages requis de l\'utilisateur inconnus';
$string['unresolvedexceptions'] = '{$a} questions non résolues';
$string['untitledset'] = 'Ensemble sans titre';
$string['update'] = 'Enregistrer';
$string['updateextensionfailall'] = 'Impossible de mettre à jour toutes les extensions';
$string['updateextensionfailcount'] = 'Echec de la mise à jour de {$a} extensions';
$string['updateextensions'] = 'Mettre à jour les extensions';
$string['updateextensionsuccess'] = 'Toutes les extensions ont été mises à jour avec succès';
$string['userid'] = 'ID utilisateur';
$string['variablesubstitution_help'] = '# Substitution de variables
Dans les messages de programme, certaines variables peuvent être insérées dans le sujet et/ou le corps d\'un message dans le but d\'être remplacées par les vraies valeurs lors de l\'envoi du message. Les variables doivent être insérées dans le texte exactement comme montré ci-dessous. Les variables suivantes peuvent être utilisées :
%programfullname%
: Ceci sera remplacé par le nom complet du programme
%setlabel%
: Ceci sera remplacé par le label de l\'ensemble de cours (seulement si le message est lié à un ensemble de cours)';
$string['viewallprograms'] = 'Voir tous les programmes';
$string['viewallrequiredlearning'] = 'Voir tous';
$string['viewexceptions'] = 'Voir les rapports d\'exceptions pour résoudre des problèmes.';
$string['viewinguserextrequests'] = 'Visualisation des demandes d\'extension pour {$a}';
$string['viewingxusersprogram'] = 'Vous visualisez les progrès de <a href="{$a->wwwroot}/user/view.php?id={$a->id}">{$a->fullname}\'s</a> sur ce programme.';
$string['viewprogram'] = 'Voir le programme';
$string['viewprogramassignments'] = 'Voir les affectations du programme';
$string['viewprogramdetails'] = 'Voir les détails du programme';
$string['viewrecurringprogramhistory'] = 'Voir l\'historique';
$string['visible'] = 'Visible';
$string['weeks'] = 'Semaine(s)';
$string['xlearnerscurrentlyenrolled'] = '{$a} apprentis sont actuellement engagés dans ce programme.';
$string['xsrequiredlearning'] = 'Les apprentissages obligatoires de {$a}';
$string['years'] = 'Année(s)';
$string['youareviewingxsrequiredlearning'] = 'Vous visualisez les aprentissages obligatoires de <a href="{$a->site}/user/view.php?id={$a->userid}">{$a->name}\'s</a>.';
$string['youhaveadded'] = 'Vous avez ajouté {$a->itemnames} à ce programme<br />
<br />
<strong>Ceci assignera {$a->affectedusers} utilisateurs au programme</strong><br />
<br />
Cette modification sera prise en compte après avoir cliqué sur le bouton \'Enregistrer toutes les modifications\' de l\'écran principal des affectations au programme.';
$string['youhavemadefollowingchanges'] = 'Vous avez effectué les modifications suivantes au programme';
$string['youhaveremoved'] = 'Vous avez retiré {$a->itemname} de ce programme<br />
<br />
<strong>Ceci désengagera {$a->affectedusers} utilisateurs de ce programme</strong><br />
<br />
Cette modification sera prise en compte après avoir cliqué sur le bouton \'Enregistrer toutes les modifications\' de l\'écran principal des affectations au programme.';
$string['youhaveunsavedchanges'] = 'Vous avez annulé toutes les modifications';
$string['youmustcompletebeforeproceedingtolearner'] = 'Vous devez achever {$a->mustcomplete} avant de passer à {$a->proceedto}';
$string['youmustcompletebeforeproceedingtomanager'] = 'doit achever {$a->mustcomplete} avant de passer à {$a->proceedto}';
$string['youmustcompletebeforeproceedingtoviewing'] = 'Un apprenti doit achever {$a->mustcomplete} avant de passer à {$a->proceedto}';
$string['youmustcompleteorlearner'] = 'Vous devez achever {$a}';
$string['youmustcompleteormanager'] = 'doit achever {$a}';
$string['youmustcompleteorviewing'] = 'Un apprenti doit achever {$a}';
$string['z:incompleterecurringprogrammessage'] = 'Un cours dans un programme récurrent dans lequel vous êtes engagé a atteint sa date de fin, mais vous n\'avez pas achevé le cours. Ce cours doit être achevé pour être en accord avec les critères du programme.';
$string['z:incompleterecurringprogramsubject'] = 'Cours récurrent inachevé';
