<?PHP // $Id$ 
      // customfields.php - created with Moodle 1.9.12 (Build: 20110510) (2007101591.03)
      // local modifications from http://translate.totaralms.com


$string['category'] = 'Catégorie';
$string['categorynamemustbeunique'] = 'Nom de la catégorie (doit être unique)';
$string['categorynamenotunique'] = 'Ce nom de la catégorie est déjà utilisé';
$string['commonsettings'] = 'Paramètres communs';
$string['confirmcategorydeletion'] = 'Le(s) {$a} champ(s) de la catégorie seront déplacé vers la catégorie mère (ou une autre si il n\'y a pas de catégorie mère).<br /> Etes vous sûr de vouloir supprimer cette catégorie?';
$string['confirmfielddeletion'] = 'L\'(es) {$a} entrée(s) du champ seront supprimé.<br /> Etes vous sûr de vouloir supprimer ce champ?';
$string['coursecustomfields'] = 'Champs personnalisés du cours';
$string['createcustomfieldcategory'] = 'Créer une catégorie de champs personnalisés';
$string['createnewcategory'] = 'Création d\'une nouvelle catégorie';
$string['createnewcustomfield'] = 'Créer un nouveau champ personnalisé';
$string['createnewfield'] = 'Créer un nouveau &quot;{$a}&quot; champ personnalisé';
$string['customfield'] = 'Champ personnalisé';
$string['customfieldcategories'] = 'Catégories de champs personnalisés';
$string['customfields'] = 'Champs personnalisés';
$string['customfieldtypecheckbox'] = 'Case à cocher';
$string['customfieldtypefile'] = 'Ficher';
$string['customfieldtypemenu'] = 'Menu déroulant';
$string['customfieldtypetext'] = 'Texte';
$string['customfieldtypetextarea'] = 'Zone de texte';
$string['defaultchecked'] = 'Cocher par défaut';
$string['defaultdata'] = 'Valeur par défaut';
$string['deletecategory'] = 'Suppression de la catégorie';
$string['deletefield'] = 'Suppression du champ';
$string['description'] = 'Description du champ';
$string['editcategory'] = 'Modification de la catégorie de champs personnalisés:';
$string['editfield'] = 'Modification du champ personnalisé:';
$string['fieldcolumns'] = 'Colonnes';
$string['fieldispassword'] = 'S\'agit-il d\'un champ mot de passe?';
$string['fieldmaxlength'] = 'Longueur maximale';
$string['fieldrows'] = 'Lignes';
$string['fieldsize'] = 'Taille d\'affichage';
$string['forceunique'] = 'Est-ce que les données devraient être uniques?';
$string['locked'] = 'Est-ce que le champ est verouillé?';
$string['menudefaultnotinoptions'] = 'La valeur par défaut ne fait pas partie des options';
$string['menunooptions'] = 'Aucune option de menu fournie';
$string['menuoptions'] = 'Options du menu (une par ligne)';
$string['menutoofewoptions'] = 'Il faut au moins 2 options';
$string['nocustomfieldcategories'] = 'Il faut ajouter une catégorie pour les champs personnalisés';
$string['nocustomfieldcategoriesdefined'] = 'Il n\'existe aucune catégorie';
$string['nocustomfieldsdefined'] = 'Aucun champ n\'a été définie';
$string['customfieldrequired'] = 'Est-ce que le champ est obligatoire?';
$string['returntocategories'] = 'Retourner ver les catégories de champs personnalisés';
$string['returntoframework'] = 'Retourner vers le cadre';
$string['shortname'] = 'Nom abrègé (doit être unique)';
$string['shortnamenotunique'] = 'Ce nom abrègé est déjà utilisé';
$string['specificsettings'] = 'Paramètres spécifiques';
$string['visible'] = 'Caché sur la page de paramètres?';
$string['customfieldhidden_help'] = '# Caché sur la page de paramètres ?

Si Oui le champ personnalisé ne sera pas visible sur la page des paramètres ou à tout autre endroit où il aurait été affiché. Si Non le champ peersonnalisé sera visible.';
$string['customfieldfullname_help'] = '# Nom complet du champ personnalisé

Le nom complet du champ personnalisé est son titre complet.';
$string['customfieldforceunique_help'] = '# Les données doivent-elles être uniques ?

Si Oui le champ personnalisé n\'acceptera qu\'une valeur unique. Si une valeur dupliquée est entrée, un message d\'erreur sera affiché lors de l\'enregistrement.

Si Non toute valeur sera acceptée pour ce champ personnalisé.';
$string['customfieldlocked_help'] = '# Ce champ est-il verrouillé ?

Si Oui le champ personnalisé n\'affichera que les informations enregistrées lors de sa création. Ce champ ne peut être modifié.';
$string['customfieldmenuoptions_help'] = '# Options du menu (Menu de choix)

Entrez les options du menu qui apparaîtront dans le menu déroulant.

N\'entrez qu\'une option par ligne.';
$string['customfieldshortname_help'] = '# Nom abrégé du champ personnalisé

Le nom abrégé du champ personnalisé est le nom abrégé du champ personnalisé utilisé pour l\'affichage.

Les champs personnalisés apparaissent en tant qu\'option sur l\'écran de modification d\'objet pour les objets du même niveau de profondeur que le champ personnalisé.';
$string['customfieldrowstextarea_help'] = '# Lignes (champ texte)

Règle la hauteur du champ texte qui sera disponible (nombre de lignes).';
$string['customfieldrequired_help'] = '# Ce champ est-il obligatoire ?

Si Oui, le champ sera obligatoire lors de la création d\'objets sur ce niveau de profondeur.

Si Non, le champ sera optionnel lors de la création d\'objets sur ce niveau de profondeur.';
$string['customfieldfieldsizetext_help'] = '# Taille d\'affichage (Entrée texte)

La taille d\'affichage règle le nombre de caractères affichés dans le champ texte.';
$string['customfieldmaxlengthtext_help'] = '# Longueur maximale (Entrée texte)

La longueur maximale en caractères que le champ texte acceptera.';
$string['customfielddefaultdatatext_help'] = '# Valeur par défaut (entrée texte)

La valeur par défaut est le texte qui apparaîtra dans le champ texte par défaut.

Laisser ce champ vide si aucun texte par défaut n\'est requis.';
$string['customfieldcategory_help'] = '# Catégorie

Une **Catégorie** est créée pour grouper ensemble les champs personnalisés additionnels sur une page, par exemple pour une page de compétence, de poste ou d\'organisation.';
$string['customfieldcategories_help'] = '# Catégories de champs personnalisés

Les **Catégories de champs personnalisés** vous permettent de configurer des catégories personnalisées pour conserver des champs personnalisés sur un niveau de profondeur.

Les catégories de champs personnalisés et les champs personnalisés sont configurés pour permettre l\'enregistrement de toutes les informations utiles et des objets de hiérarchie, ainsi que pour les faire apparaître dans les pages \'Ajout/Modification d\'objet de hiérarchie\'.

Les noms de catégories de champs personnalisés doivent être uniques sur le niveau de profondeur. Vous devez avoir au moins une catégorie de champs personnalisés configurée pour configurer les champs personnalisés.

**Ajouter une catégorie personnalisée : **Clique sur **Créer catégorie de champs personnalisés** pour ajouter une catégorie de champs personnalisés.

**Modifier/Supprimer une catégorie personnalisée : **Cliquez sur **Activer l\'édition** pour modifier ou supprimer une catégorie de champs personnalisés existante.';
$string['customfielddefaultdatatextarea_help'] = '# Valeur par défaut (champ texte)

La valeur par défaut est le texte qui apparaîtra dans le champ texte par défaut.

Laisser vide si aucun texte par défaut n\'est requis.';
$string['customfieldcategoryname_help'] = '# Nom de la catégorie du champ personnalisé

Le **Nom de la catégorie du champ personnalisé** vous aide à grouper les types de champs personnalisés dont vous avez besoin et doivent être uniques sur le niveau de profondeur sur lequel vous travaillez. 

Entrez le nom et cliquez sur **Enregistrer les modifications**.';
$string['customfieldcolumnstextarea_help'] = '# Colonnes (champ texte)

Les **Colonnes** définissent la largeur du champ disponible.';
$string['customfielddefaultdatamenu_help'] = '# Valeur par défaut (menu de choix)

Réglez la valeur par défaut qui apparaîtra dans le menu déroulant. La valeur par défaut doit apparaître dans le menu d\'options du dessus.

Laisser vide si aucune valeur par défaut n\'est requise.';
$string['customfielddefaultdatacheckbox_help'] = '# Cochée par défaut (case à cocher)

Si Oui la case à cocher personnalisée sera cochée par défaut.

Si Non la case à cocher personnalisée ne sera pas cochée par défaut.';

