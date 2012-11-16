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
 * Strings for component 'certificate', language 'fr', branch 'MOODLE_22_STABLE'
 *
 * @package   certificate
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlinklabel'] = 'Ajouter une activité dépendante de plus';
$string['addlinktitle'] = 'Cliquer pour ajouter une activité dépendante de plus';
$string['awarded'] = 'Décerné';
$string['awardedto'] = 'Décerné à';
$string['back'] = 'Retour';
$string['border'] = 'Bordure';
$string['borderblack'] = 'Noir';
$string['borderblue'] = 'Bleu';
$string['borderbrown'] = 'Brun';
$string['bordercolor'] = 'Lignes de bordure';
$string['bordergreen'] = 'Vert';
$string['borderlines'] = 'Lignes';
$string['borderstyle'] = 'Image de bordure';
$string['certificate'] = 'Vérification du code de certificat';
$string['certificate:manage'] = 'Gérer le certificat';
$string['certificate:printteacher'] = 'Imprimer le professeur';
$string['certificate:student'] = 'Obtenir le certificat';
$string['certificate:view'] = 'Voir le certificat';
$string['certificatename'] = 'Nom du certificat';
$string['certificatereport'] = 'Rapports de certificat';
$string['certificatesfor'] = 'Certificats pour';
$string['certificatetype'] = 'Genre de certificat';
$string['code'] = 'Code';
$string['course'] = 'Pour';
$string['coursegrade'] = 'Note du cours';
$string['coursename'] = 'Cours';
$string['credithours'] = 'Heures de crédit';
$string['customtext'] = 'Texte personnalisé';
$string['date'] = 'Le';
$string['datefmt'] = 'Format de date';
$string['datefmt_help'] = 'Choisir un format de date à imprimer sur le certificat.';
$string['datehelp'] = 'Date';
$string['delivery_help'] = 'Choisissez ici la manière dont vos étudiants recevront leur certificat.
**Ouvrir dans navigateur :** Ouvre le certificat dans une nouvelle fenêtre du navigateur.
**Forcer le téléchargement :** Ouvre la fenêtre de téléchargement de fichier par navigateur. **(Note : **Internet Explorer ne permet pas l\'ouverture depuis la fenêtre de téléchargement du navigateur. L\'option enregistrer doit être sélectionnée d\'abord.)
**Certificat par e-mail :** Choisir cet option envoie le certificat par e-mail en tant que pièce jointe.
Après réception d\'un certificat, un apprenti peut cliquez à nouveau sur le lien du certificat et voir la date d\'obtention du certificat, et pourront examiner leur certificat reçu.';
$string['designoptions'] = 'Options de design';
$string['download'] = 'Force téléchargement';
$string['emailcertificate'] = 'Mél (pensez à sauvegarder)';
$string['emailothers'] = 'Envoyer méls à d\'autres personnes';
$string['emailothers_help'] = 'Entrez les adresses e-mail ici, séparées par des virgules, de ceux qui recevront un e-mail de notification quand l\'apprenti reçoit un certificat.';
$string['emailstudenttext'] = 'Veuillez trouver votre certificat pour {$a->course} ci-joint.';
$string['emailteachermail'] = '{$a->student} a reçu son certificat : \'{$a->certificate}\' pour le cours {$a->course}.

Vous pouvez le voir ici:

{$a->url}';
$string['emailteachermailhtml'] = '{$a->student} a reçu son certificat : \'<i>{$a->certificate}</i>\' pour le cours {$a->course}.

Vous pouvez le voir ici:

<a href="{$a->url}">Rapport de certificat</a>.';
$string['emailteachers'] = 'Envoyer des méls au professeurs';
$string['emailteachers_help'] = 'Si coché, les enseignants recevront un cours e-mail de notification à chaque fois qu\'un apprenti reçoit un certificat.';
$string['entercode'] = 'Veuillez entrer le code de vérification du certificat';
$string['getcertificate'] = 'Recevoir votre certificat';
$string['grade'] = 'Note';
$string['gradedate'] = 'Date reception  de la note';
$string['gradefmt_help'] = '3 formats de note sont disponibles pour l\'impression sur certificat :
**Note en poucents :** Imprimer le pourcentage en tant que note.
**Note en points : ** Imprimer la valeur en points de la note.
**Letter Grade :** Imprimer la note en poucentage avec une lettre. Les valeurs pour les lettres peuvent être personnalisées dans type/certificate.php.';
$string['gradeletter'] = 'Note en lettres';
$string['gradepercent'] = 'Note en pourcentage';
$string['gradepoints'] = 'Note en points';
$string['incompletemessage'] = 'Afin de pouvoir télécharger votre certificat vous devez compléter tout les activités exigées. Veuillez retourner au cours pour continuer.';
$string['intro'] = 'Introduction';
$string['issued'] = 'Delivré';
$string['issueoptions'] = 'Options de délivrement';
$string['lockingoptions'] = 'Options de verouillage';
$string['modulename'] = 'Certificat';
$string['modulenameplural'] = 'Certificats';
$string['mycertificates'] = 'Mes certificats';
$string['nocertificatesreceived'] = 'N\'a reçu aucun certificat de cours';
$string['nogrades'] = 'Aucune note disponible';
$string['notapplicable'] = 'Non applicable';
$string['notfound'] = 'Validation du numéro de certificat impossible.';
$string['notissued'] = 'Non reçu';
$string['notissuedyet'] = 'Pas encore délivré';
$string['notreceived'] = 'Vous n\'avez pas reçu ce certificat';
$string['openbrowser'] = 'Ouvrir dans une nouvelle fenêtre';
$string['opendownload'] = 'Cliquer le bouton ci-dessous afin de sauvegarder le certificat sur votre PC';
$string['openemail'] = 'Cliquer le bouton ci-dessous afin de recevoir le certificat par mél en piece joint.';
$string['openwindow'] = 'Cliquer le bouton ci-dessous afin d\'ouvrir le certificat dans une nouvelle fenêtre.';
$string['printdate'] = 'Imprimer la date';
$string['printdate_help'] = 'Il s\'agit de la date qui sera imprimée, si une date est sélectionnée. Si la date de fin du cours et sélectionnée, vous devez autoriser la période de temps et paramétrer les date de fin du cours dans les paramètres du cours. Si la date de fin de cours n\'est pas configurée, la date de réception sera imprimée. Vous pouvez aussi choisir d\'imprimer la date de graduation d\'une activité. Si un certificat est généré avec graduation de cette activité, la date de réception sera imprimée.
Veuillez noter qu\'une fois la date imprimée sur un certificat, elle ne peut être modifiée sauf personnalisation du fichier type/certificate.php.';
$string['printerfriendly'] = 'Page imprimable';
$string['printgrade'] = 'Imprimer la note';
$string['printhours'] = 'Imprimer les heures de crédit';
$string['printhours_help'] = 'Entrez ici le nombre d\'heures de crédit à imprimer sur le certificat.';
$string['printnumber_help'] = 'Un code unique de 10 caractères (lettres et chiffres) peut être imprimé sur le certificat. Ce nombre peut ensuite être vérifié en le comparant au cade affiché dans le rapport "Voir certificats générés" de l\'enseignant.';
$string['printoutcome'] = 'Imprimer objectif';
$string['printseal'] = 'Sigle ou logo';
$string['printsignature'] = 'Image de signature';
$string['printteacher'] = 'Imprimer le(s) nom(s) de professeur(s)';
$string['printteacher_help'] = 'Pour imprimer le nom de l\'enseignant sur le certificat, configurez le rôle de l\'enseignant au niveau module. Faites-le si, par exemple, vous avez plus d\'un enseignant par cours ou si vous avez plusieurs certificats pour ce cours et que vous souhaitez imprimer des noms d\'enseignant différents pour chaque certificat. Cliquez sur modifier le certificat, puis cliquez sur l\'onglet Rôles attribués locale. Puis attribuez le rôle d\'enseignant (enseignant éditeur) au certificant (il n\'ont PAS besoin d\'être enseignants dans le cours--vous pouvez attribuer ce rôle à n\'importe qui. Ces noms seront imprimés sur le certificat pour enseignant.';
$string['printwmark'] = 'Image filigrane';
$string['receivedcerts'] = 'Certificats reçus';
$string['receiveddate'] = 'Date reçu';
$string['report'] = 'Rapport';
$string['reportcert_help'] = 'Si vous choisissez Oui ici, la date de réception du certificat, son numéro de code et le nom du cours seront affichés dans les rapports de certificat de l\'utilisateur. Si vous choisissez d\'imprimer une note sur ce certificat, alors la note doit sera aussi affichée dans le rapport de certificat.';
$string['reviewcertificate'] = 'Revoir votre certificat';
$string['sigline'] = 'ligne';
$string['textoptions'] = 'Options de texte';
$string['to'] = 'Délivré à';
$string['validate'] = 'Verifier';
$string['verifycertificate'] = 'Verifier le certificat';
$string['viewcertificateviews'] = 'Voir les {$a} certificats délivré';
$string['viewed'] = 'Vous avez reçu ce certificat le:';
$string['viewtranscript'] = 'Voir les certificats';
