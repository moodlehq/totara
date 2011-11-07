<?php
// enrol_imsenterprise.php - created with Totara langimport script version 1.1

$string['aftersaving...'] = 'Une fois ces réglages enregistrés, vous voudrez peut-être';
$string['allowunenrol'] = 'Permettre aux données IMS de <strong>désinscrire</strong> les participants';
$string['basicsettings'] = 'Réglages de base';
$string['coursesettings'] = 'Options cours';
$string['createnewcategories'] = 'Créer de nouvelles catégories de cours (cachées) si inexistantes dans Moodle';
$string['createnewcourses'] = 'Créer de nouveaux cours (cachés) si inexistants dans Moodle';
$string['createnewusers'] = 'Créer des comptes utilisateur pour les utilisateurs pas encore enregistrés dans Moodle';
$string['cronfrequency'] = 'Fréquence de traitement';
$string['deleteusers'] = 'Supprimer les comptes utilisateurs comme spécifié dans les données IMS';
$string['description'] = 'Cette méthode vérifiera régulièrement si un fichier texte de format particulier existe à un emplacement déterminé et le traitera. Ce fichier doit être conforme aux <a href=\'../help.php?module=enrol/imsenterprise&amp;file=formatoverview.html\' target=\'_blank\'>spécifications IMS Enterprise</a>, et contenir des éléments XML person, group et membership.';
$string['doitnow'] = 'effectuer immédiatement une importation IMS Enterprise';
$string['enrolname'] = 'Fichier IMS Enterprise';
$string['filelockedmail'] = 'Le fichier texte utilisé pour les inscriptions basées sur un fichier IMS ($a) ne peut pas être supprimé par le script cron. Cela signifie habituellement que les droits sont mal réglés. Veuillez corriger les droits de telle sorte que Moodle puisse effacer le fichier, sans quoi il sera traité de façon répétitive.';
$string['filelockedmailsubject'] = 'Erreur important : fichier d\'inscription';
$string['fixcasepersonalnames'] = 'Mettre en majuscules les initiales des noms réels';
$string['fixcaseusernames'] = 'Mettre les noms d\'utilisateur en minuscules';
$string['imsrolesdescription'] = 'La spécification IMS Enterprise inclut 8 types de rôles distincts. Veuillez choisir comment vous désirez que ces rôles soient attribués dans Moodle, y compris ceux que vous désirez ignorer.';
$string['location'] = 'Emplacement du fichier';
$string['logtolocation'] = 'Emplacement de l\'historique d\'importation (vide pour ne pas avoir d\'historique)';
$string['mailadmins'] = 'Informer l\'administrateur par courriel';
$string['mailusers'] = 'Informer les utilisateurs par courriel';
$string['miscsettings'] = 'Divers';
$string['processphoto'] = 'Ajouter la photo de l\'utilisateur à son profil';
$string['processphotowarning'] = 'Attention ! Le traitement des images est susceptible de charger le serveur de façon significative. Nous vous recommandons de n\'activer pas cette option si un grand nombre d\'étudiants doit être traité.';
$string['restricttarget'] = 'Ne traiter les données que si la cible suivante est spécifiée';
$string['sourcedidfallback'] = 'Utiliser le « sourcedid » comme identifiant pour les personnes dont le champ « userid » est introuvable';
$string['truncatecoursecodes'] = 'Tronquer les codes de cours à cette longueur';
$string['usecapitafix'] = 'Cocher cette case lors de l\'utilisation de « Capita » (leur format XML n\'est pas tout à fait correct)';
$string['usersettings'] = 'Options utilisateurs';
$string['zeroisnotruncation'] = '0 indique pas de troncature';

?>
