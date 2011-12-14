<?PHP // $Id$ 
      // enrol_dbpositions.php - created with Moodle 1.9.14 (Build: 20111010) (2007101591.06)


$string['dbhost'] = 'Numéro ou nom IP du serveur';
$string['dbname'] = 'Nom de la base de données';
$string['dbpass'] = 'Mot de passe serveur';
$string['dbtable'] = 'Table base de données';
$string['dbtype'] = 'Type de base de données';
$string['dbuser'] = 'Utilisateur serveur';
$string['description'] = 'Vous pouvez utiliser une base de données externe (d\'à peu près tout type) pour contrôler les relations entre utilisateurs. Il est considéré que votre base de données externe contient un champ contenant deux ID utilisateur, et un ID de rôle. Ces données sont comparées aux champs sélectionnés pour l\'utilisateur local et les tables de rôles.';
$string['enrolname'] = 'Base de données externe (Assignation position)';
$string['fullnamefield'] = 'Le nom du champ dans la base de données externe à utiliser pour le nom complet de l\'assignation de la position.';
$string['localobjectuserfield'] = 'Le nom du champ de la table utilisateur utilisée pour faire correspondre les entrées dans la base de données à distance (ex : idnumber) pour l\'assignation du rôle <i>membre de l\'équipe</i>';
$string['localorgfield'] = 'Le nom du champ de la table organisations utilisée pour faire correspondre les entrées dans la base de données à distance (ex : idnumber).';
$string['localposfield'] = 'Le nom du champ de la table positions utilisée pour faire correspondre les entrées dans la base de données à distance (ex : idnumber)';
$string['localsubjectuserfield'] = 'Le nom du champ de la table utilisateur utilisée pour faire correspondre les entrées dans la base de données à distance (ex : idnumber) pour l\'assignation du rôle <i>gestionnaire</i>';
$string['postypefield'] = 'Champ type de position - Le nom du champ dans la table externe décrivant le type de position à créer -primaire/secondaire/aspirante-. Si non spécifié, il est considéré que toutes les lignes sont liées à des assignations de position primaire.';
$string['remote_fields_mapping'] = 'Mapping des champs de la base de données';
$string['remoteobjectuserfield'] = 'Le nom du champ de la table à distance utilisée pour faire correspondre les entrées dans la table utilisateur pour l\'assignation du rôle <i>membre de l\'équipe</i>';
$string['remoteorgfield'] = 'Le nom du champ de la table à distance utilisée pour faire correspondre les entrées dans la base de données organisations (ex : équipe)';
$string['remoteposfield'] = 'Le nom du champ de la table à distance utilisée pour faire correspondre les entrées dans la base de données positions (ex : position)';
$string['remotesubjectuserfield'] = 'Le nom du champ de la table à distance utilisée pour faire correspondre les entrées dans la table utilisateur pour l\'assignation du rôle <i>gestionnaire</i>';
$string['roleshortname'] = 'Le nom court du rôle qui doit être assigné au gestionnaire dans un contexte de membre d\'équipe.';
$string['server_settings'] = 'Réglages de la base de données externe';
$string['shortnamefield'] = 'Le nom du champ de la base de données externe à utiliser pour le nom court de l\'assignation de la position.';
$string['useauthdb'] = 'Utilisez les mêmes réglages pour la connexion à la base de données, car le plugin d\'authentification de la base de données utilise (Vous devrez quand même spécifier le nom de la table)';
$string['useenroldatabase'] = 'Utilisez les mêmes réglages pour la connexion à la base de données, car le plugin d\'enrôlement de la base de données utilise (Vous devrez quand même spécifier le nom de la table)';

?>
