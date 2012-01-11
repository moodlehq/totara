<?php
// enrol_dbpositions.php - created with Totara langimport script version 1.1

$string['dbhost'] = 'Nom ou numéro IP du serveur';
$string['dbname'] = 'Nom de la base de données';
$string['dbpass'] = 'Mot de passe serveur';
$string['dbtable'] = 'Table de la base de données';
$string['dbtype'] = 'Type de base de données';
$string['dbuser'] = 'Utilisateur serveur';
$string['description'] = 'Vous pouvez utiliser une base de données externe (d\'à peu près tout type) pour contrôler les relations entre utilisateurs. Il est considéré que votre base externe contient un champ avec deux ID d\'utilisateur, et un ID de rôle. Ces champs sont comparés à ceux que vous choisissez dans les tables de rôles et utilisateurs locaux';
$string['enrolname'] = 'Base de données externe (affectation de postes)';
$string['fullnamefield'] = 'Le nom du champ dans la base de données externe utilisé pour le nom complet de l\'affectation du poste';
$string['localobjectuserfield'] = 'Le nom du champ dans la table utilisateur utilisée pour faire correspondre les entrées de la base externe (par ex. idnumber), pour l\'affectation de rôle aux <i>membre d\'équipe</i>.';
$string['localorgfield'] = 'Le nom du champ de la table organisations utilisé pour faire correspondre les entrées de la base externe (par ex. idnumber)';
$string['localposfield'] = 'Le nom du champ de la table postes utilisé pour faire correspondre les entrées de la base externe (par ex. idnumber)';
$string['localsubjectuserfield'] = 'Le nom du champ de la table utilisateur utilisé pour faire correspondre les entrées de la base externe (par ex. idnumber) pour l\'affectation de rôle <i>manager</i>';
$string['postypefield'] = 'Champ type de poste - Le nom du champ de la table externe décrivant le type de poste créé - primaire/secondaire/visé. Si non spécifié, toutes les lignes sont considérées liées à des postes primaires.';
$string['remote_fields_mapping'] = 'Mapping des champs de la base';
$string['remoteobjectuserfield'] = 'Le nom du champ de la table externe utilisé pour faire correspondre les entrées de la table utilisateur pour l\'affectation du rôle <i>membre d\'équipe</i>.';
$string['remoteorgfield'] = 'Le nom du champ de la table externe utilisé pour faire correspondre les entrées de la base organisations (par ex. team).';
$string['remoteposfield'] = 'Le nom du champ de la table externe utilisé pour faire correspondre les entrées de la base postes (par ex. position).';
$string['remotesubjectuserfield'] = 'Le nom du champ de la table externe utilisé pour faire correspondre les entrées de la table utilisateurs pour l\'affectation du rôle <i>manager</i>';
$string['roleshortname'] = 'Le nom abrégé du rôle qui doit être affecté au manager dans le contexte membre d\'équipe';
$string['server_settings'] = 'Paramètres serveur de base de données externe';
$string['shortnamefield'] = 'Le nom du champ de la table externe utilisé pour le nom abrégé du poste';
$string['useauthdb'] = 'Utilisez les mêmes paramètres pour la connection à la base de données que pour le plugin d\'identification à la base que vous utilisez (vous devrez quand même spécifier le nom de la table)';
$string['useenroldatabase'] = 'Utilisez les mêmes paramètres pour la connection à la base de données que pour le plugin d\'enrôlement à la base que vous utilisez (vous devrez quand même spécifier le nom de la table)';

?>
