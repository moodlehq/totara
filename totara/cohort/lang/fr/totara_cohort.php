<?PHP // $Id$
      // totara_cohort.php - created with Moodle 1.9.15 (Build: 20111128) (2007101591.07)


$string['abouttocreate'] = 'Vous êtes sur le point de créer une nouvelle cohorte appelée {$a}"';
$string['addcohort'] = 'Créer nouvelle cohorte';
$string['anycohort'] = 'Tout';
$string['assign'] = 'Assigner';
$string['assignmemberstocohort'] = 'Assigner des membres à cette cohorte';
$string['assignto'] = 'Membres \'{$a}\' de la cohorte';
$string['backtocohorts'] = 'Retour aux cohortes';
$string['cannoteditcohort'] = 'Cette cohorte ne peut être modifiée après création';
$string['childrenincluded'] = 'enfants inclus';
$string['clear'] = 'Effacer';
$string['cohort'] = 'Cohorte';
$string['cohort:assign'] = 'Assigner membres cohorte';
$string['cohort:manage'] = 'Gérer les cohortes';
$string['cohort:view'] = 'Utiliser les cohortes et afficher les membres';
$string['cohortmembers'] = 'Membres cohorte';
$string['cohorts'] = 'Cohortes';
$string['cohortsin'] = 'Cohortes disponibles';
$string['component'] = 'Source';
$string['confirmdynamiccohortcreation'] = 'Confirmer la création dynamique de cohortes';
$string['createdynamiccohort'] = 'Créer cohorte dynamique';
$string['createnewcohort'] = 'Créer nouvelle cohorte';
$string['criteria'] = 'Critères';
$string['criteriaoptional'] = 'Tous les critères sont optionnels mais vous devez en choisir au moins un.';
$string['currentusers'] = 'Utilisateurs actuels';
$string['currentusersmatching'] = 'Correspondance utilisateurs actuels';
$string['delcohort'] = 'Supprimer cohorte';
$string['delconfirm'] = 'Voulez-vous vraiment supprimer la cohorte \'{$a}\' ?';
$string['deletethiscohort'] = 'Supprimer cette cohorte';
$string['description'] = 'Description';
$string['duplicateidnumber'] = 'Une cohorte avec le même numéro ID existe déjà';
$string['dynamic'] = 'Dynamique';
$string['dynamiccohortcriteria'] = 'Critères cohorte dynamique';
$string['dynamiccohortcriterialower'] = 'Critères cohorte dynamique';
$string['editcohort'] = 'Modifier cohorte';
$string['editdetails'] = 'Modifier détails';
$string['editmembers'] = 'Modifier membres';
$string['failedtodeleted'] = 'Echec de la suppression de la cohorte';
$string['idnumber'] = 'ID';
$string['includechildren'] = 'Inclure enfants';
$string['members'] = 'Membres';
$string['memberscount'] = 'Taille';
$string['mustselectonecriteria'] = 'Vous devez choisir au moins un critère';
$string['name'] = 'Nom';
$string['nocomponent'] = 'Crée manuellement';
$string['nocriteriaset'] = '(pas de critère sélectionné, supprimer cette cohorte)';
$string['notvalidprofilefield'] = 'Veuillez sélectionner un champ de profil valide';
$string['organisation'] = 'Organisation';
$string['overview'] = 'Vue d\'ensemble';
$string['pleasesearchmore'] = 'Veuillez affiner la recherche';
$string['pleaseusesearch'] = 'Veuillez utiliser la recherche';
$string['position'] = 'Poste';
$string['potusers'] = 'Utilisateurs potentiels';
$string['potusersmatching'] = 'Utilisateurs correspondant potentiellement';
$string['role'] = 'Rôle';
$string['selectfromcohort'] = 'Choisir membres de la cohorte';
$string['set'] = 'Régler';
$string['successfullyaddedcohort'] = 'Cohorte ajoutée avec succès';
$string['successfullydeleted'] = 'Cohorte supprimée avec succès';
$string['successfullyupdated'] = 'Cohorte mise à jour avec succès';
$string['thiscohortwillhave'] = 'La cohorte possèdera {$a} membres à ce moment précis';
$string['toomanyusersmatchsearch'] = 'Trop d\'utilisateurs correspondent à cette recherche';
$string['toomanyuserstoshow'] = 'Trop d\'utilisateurs à afficher';
$string['type'] = 'Type';
$string['userprofilefield'] = 'Champ profil d\'utilisateur';
$string['values'] = 'Valeurs';
$string['viewmembers'] = 'Afficher membres';
$string['type_help'] = '<h1>Type de cohorte</h1>

<p>Le type de cohorte peut être \défini\' oy \'dynamique\'.</p>
<p>Les cohortes définies sont une liste prédéfinie d\'utilisateurs, manuellement créée par le créateur de la cohorte. Le créateur peut ajouter ou retirer des utilisateurs, hors de quoi la liste est statique.</p>
<p>Les cohortes dynamiques sont déterminées par une règle ou une série de règles, et les utilisateurs inclus dans la cohorte seront mis à jour automatiquement pour ajouter les utilisateurs correspondant aux règles (et retirer ceux qui n\'y correspondent plus).</p>
<p>Les membres d\'une cohorte définie peuvent être modifiés à tout moment, mais les règles qui définissent une cohorte ne peuvent être modifiées qu\'après l\'enregistrement de la cohorte.</p>';
$string['profilefieldvalues_help'] = '<h1>Valeur du champ profil cohorte</h1>

<p>Si sélectionné, les membres de la cohorte dynamique seront choisis si leur champ de profil correspond à une valeur particulière.</p>
<p>Les valeurs peuvent être une ou plusieurs chaînes de caractères, séparées par des virgules. Les utilisateurs correspondant à au moins une des chaînes seront inclus dans la cohorte.</p>';
$string['positionincludechildren_help'] = '<h1>Inclure organisations enfant dans la cohorte</h1>

<p>Si la case \'Inclure les enfants\' est cochée alors tous les utilisateurs au poste sélectionné, et de tout poste en dessous du poste sélectionné, seront inclus dans cette cohorte.</p>
<p>Si \'Inclure les enfants\' n\'est pas coché, seuls les utilisateurs du poste sélectionné seront engagés dans cette cohorte.</p>';
$string['orgincludechildren_help'] = '<h1>Inclure organisations enfant dans la cohorte</h1>

<p>Si la case \'Inclure les enfants\' est cochée alors tous les utilisateurs de l\'organisation sélectionnée, et de toute organisation en dessous de l\'organisation sélectionnée, seront inclus dans cette cohorte.</p>
<p>Si \'Inclure les enfants\' n\'est pas coché, seuls les utilisateurs de l\'organisation sélectionnée seront engagés dans cette cohorte.</p>';

?>
