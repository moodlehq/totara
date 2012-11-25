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
 * Strings for component 'lesson', language 'fr', branch 'MOODLE_22_STABLE'
 *
 * @package   lesson
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesscontrol'] = 'Contrôle d\'accès';
$string['actionaftercorrectanswer'] = 'Action après réponse correcte';
$string['actionaftercorrectanswer_help'] = 'Après une réponse correcte, il y a 3 possibilités pour la page suivante :
* Normale : suivre la leçon dans l\'ordre logique
* Afficher une page non vue : les pages sont affichées aléatoirement sans qu\'aucune page ne soit affichée deux fois
* Afficher une page sans réponse : les pages sont affichées aléatoirement, certaines pages déjà vues par l\'étudiant lui étant montrée une nouvelle fois, s\'il n\'y a pas répondu ou s\'il y a répondu incorrectement';
$string['actions'] = 'Actions';
$string['activitylink'] = 'Lien vers une activité';
$string['activitylink_help'] = 'Le menu déroulant présente toutes les activités de ce cours. En en choisissant une, un lien vers cette activité apparaîtra à la fin de la leçon.';
$string['activitylinkname'] = 'Allez à {$a}';
$string['addabranchtable'] = 'Ajouter une table de contenu';
$string['addanendofbranch'] = 'Ajouter une fin de branchement';
$string['addanewpage'] = 'Ajouter une page';
$string['addaquestionpage'] = 'Ajouter une page question';
$string['addaquestionpagehere'] = 'Ajouter une page question ici';
$string['addbranchtable'] = 'Ajouter une page de contenu';
$string['addcluster'] = 'Ajouter un groupe';
$string['addedabranchtable'] = 'Page de contenu ajoutée';
$string['addedanendofbranch'] = 'Fin de branchement ajoutée';
$string['addedaquestionpage'] = 'Page question ajoutée';
$string['addedcluster'] = 'Groupe ajouté';
$string['addedendofcluster'] = 'Fin de groupe ajoutée';
$string['addendofcluster'] = 'Ajouter une fin de groupe';
$string['addpage'] = 'Ajouter une page';
$string['anchortitle'] = 'Début du contenu principal';
$string['and'] = 'ET';
$string['answer'] = 'Réponse';
$string['answeredcorrectly'] = 'répondu correctement.';
$string['answersfornumerical'] = 'Les réponses aux questions numériques doivent être constituées d\'une valeur minimale et d\'une valeur maximale.';
$string['arrangebuttonshorizontally'] = 'Arranger horizontalement les boutons de contenu ?';
$string['attempt'] = 'Tentative : {$a}';
$string['attempts'] = 'Tentatives';
$string['attemptsdeleted'] = 'Tentatives supprimées';
$string['attemptsremaining'] = 'Il vous reste {$a} tentative(s)';
$string['available'] = 'Disponible dès le';
$string['averagescore'] = 'Note moyenne';
$string['averagetime'] = 'Durée moyenne';
$string['branch'] = 'Contenu';
$string['branchtable'] = 'Table de contenu';
$string['cancel'] = 'Annuler';
$string['cannotfindanswer'] = 'Impossible de trouver la réponse';
$string['cannotfindattempt'] = 'Impossible de trouver la tentative';
$string['cannotfindessay'] = 'Impossible de trouver la composition';
$string['cannotfindfirstgrade'] = 'Impossible de trouver les évaluations';
$string['cannotfindfirstpage'] = 'Impossible de trouver la première page';
$string['cannotfindgrade'] = 'Impossible de trouver les notes';
$string['cannotfindnewestgrade'] = 'Impossible de trouver la note la plus récente';
$string['cannotfindnextpage'] = 'Sauvegarde de la leçon : page suivante non trouvée !';
$string['cannotfindpagerecord'] = 'Ajout d\'un fin de branche : enregistrement de page non trouvé';
$string['cannotfindpages'] = 'Impossible de trouver les pages de la leçon';
$string['cannotfindpagetitle'] = 'Confirmation de suppression : titre de page non trouvé';
$string['cannotfindpreattempt'] = 'L\'enregistrement de la tentative précédente n\'a pas été trouvé !';
$string['cannotfindrecords'] = 'Impossible de trouver les enregistrements de la leçon';
$string['cannotfindtimer'] = 'Impossible de trouver les enregistrements de la table lesson_timer';
$string['cannotfinduser'] = 'Impossible de trouver les utilisateurs';
$string['canretake'] = 'Les étudiants peuvent refaire la leçon';
$string['casesensitive'] = 'Utiliser les expressions régulières';
$string['casesensitive_help'] = 'Quelques types de question ont une option pouvant être activée en cochant cette case. Les types de question concernés et les détails de l\'option correspondante sont décrits ci-dessous.

1. **Question à choix multiples.** Une variante des questions à choix multiples sont les « **Questions à choix multiples et à réponses multiples** ». Si l\'option est activée, l\'étudiant doit alors cocher toutes les réponses correctes par l\'ensemble proposé. La question peut indiquer ou non le \*nombre\* de bonnes réponses. Par exemple « Choisir deux rois de France dans la liste des personnages suivants » dans le premier cas, et « Lesquels de ces personnages ont été des rois de France ? » Le nombre des bonnes réponses peut varier de 1 au nombre de choix proposés. Une telle question avec une seule bonne réponse est **différente** d\'une simple question à choix multiples, car contrairement à celle-ci, elle permet à l\'étudiant de choisir plusieurs réponses.
2. **Question à réponse courte.** Par défaut, le programme compare la (ou les) réponse(s) attendue(s) avec la réponse saisie par l\'étudiant en utilisant le système d\'analyse simple. Cochez la case **Utiliser les expressions régulières:** si vous souhaitez utiliser cet autre système.

Les autres types de questions n\'utilisent pas l\'option de question.';
$string['checkbranchtable'] = 'Vérifier la page de contenu';
$string['checkedthisone'] = 'ont coché cette option.';
$string['checknavigation'] = 'Vérifier la navigation';
$string['checkquestion'] = 'Vérifier la question';
$string['classstats'] = 'Statistique de classe';
$string['clicktodownload'] = 'Cliquer sur le lien ci-dessous pour télécharger le fichier.';
$string['clicktopost'] = 'Cliquer ici pour envoyer votre note dans la liste des Meilleures résultats.';
$string['cluster'] = 'Groupe';
$string['clusterjump'] = 'Question non vue du groupe';
$string['clustertitle'] = 'Groupe';
$string['collapsed'] = 'Réduire';
$string['comments'] = 'Vos commentaires';
$string['completed'] = 'Terminé';
$string['completederror'] = 'Terminer la leçon';
$string['completethefollowingconditions'] = 'Vous devez remplir la (les) condition(s) suivante(s) dans la leçon <b>{$a}</b> avant de continuer.';
$string['conditionsfordependency'] = 'Condition(s) de dépendance';
$string['configactionaftercorrectanswer'] = 'L\'action à effectuer par défaut après une réponse correcte';
$string['configmaxanswers'] = 'Nombre maximal par défaut de réponses par page';
$string['configmaxhighscores'] = 'Nombres de meilleurs résultats affichés';
$string['configmediaclose'] = 'Afficher un bouton fermer dans la fenêtre surgissante créée pour un fichier média lié';
$string['configmediaheight'] = 'Hauteur de la fenêtre affichée pour un fichier média lié';
$string['configmediawidth'] = 'Largeur de la fenêtre affichée pour un fichier média lié';
$string['configslideshowbgcolor'] = 'Couleur de fond du diaporama';
$string['configslideshowheight'] = 'Hauteur du slideshow';
$string['configslideshowwidth'] = 'Largeur du slideshow';
$string['confirmdelete'] = 'Supprimer la page';
$string['confirmdeletionofthispage'] = 'Voulez-vous vraiment supprimer cette page ?';
$string['congratulations'] = 'Félicitations - la leçon est terminée';
$string['continue'] = 'Continuer';
$string['continuetoanswer'] = 'Continuer pour modifier les réponses.';
$string['continuetonextpage'] = 'Continuer vers la page suivante';
$string['correctanswerjump'] = 'Lien après réponse correcte';
$string['correctanswerscore'] = 'Score des réponses correctes';
$string['correctresponse'] = 'Feedback réponse correcte';
$string['credit'] = 'Crédit';
$string['customscoring'] = 'Score personnalisé';
$string['customscoring_help'] = 'Cette option vous permettra d\'affecter une valeur numérique à chaque réponse. Les réponses peuvent avoir une valeur négative ou positive. Les questions importées auront automatiquement la valeur 1 pour les réponses correctes et 0 pour les réponses incorrectes. Toutefois, vous pourrez changer ces valeurs après l\'importation.';
$string['deadline'] = 'À faire jusqu\'au';
$string['defaultessayresponse'] = 'Votre composition sera évaluée par un enseignant de ce cours.';
$string['deleteallattempts'] = 'Supprimer toutes les tentatives des leçons';
$string['deletedefaults'] = 'Leçon par défaut {$a} x supprimée';
$string['deletedpage'] = 'Page supprimée';
$string['deleting'] = 'En cours de suppression';
$string['deletingpage'] = 'Suppression de la page ? {$a}';
$string['dependencyon'] = 'Dépend de';
$string['dependencyon_help'] = 'Grâce à ce réglage, l\'accès à cette leçon peut dépendre des résultats de l\'étudiant à d\'autres leçons. Si les résultats attendus ne sont pas atteints, l\'étudiant n\'aura pas accès à cette leçon.
Les conditions applicables sont les suivantes.

\* **|Durée utilisée :** l\'étudiant doit avoir passé au moins cette durée sur la leçon considérée.
\* **|Terminé :** l\'étudiant doit avoir terminé la leçon considérée.
\* **|Note plus haute que :** la note obtenue à leçon considérée doit avoir été supérieure à la note définie ici.

Autant que de besoin, il est possible de combiner ces différents critères.';
$string['description'] = 'Description';
$string['detailedstats'] = 'Statistiques détaillées';
$string['didnotanswerquestion'] = 'N\'a pas répondu à cette question';
$string['didnotreceivecredit'] = 'N\'a pas reçu de point';
$string['displaydefaultfeedback'] = 'Afficher le feedback par défaut';
$string['displaydefaultfeedback_help'] = 'Réglé sur **Oui**, ce paramètre permet d\'afficher un feedback par défaut lorsqu\'aucun autre n\'a été défini spécifiquement. Les feedbacks par défaut sont « C\'est une réponse correcte » et « C\'est une mauvaise réponse ».
Réglé sur **Non**, ce paramètre n\'affiche aucun feedback s\'il n\'a pas été défini. Dans ce cas, l\'utilisateur est directement envoyé à la question suivante.';
$string['displayhighscores'] = 'Afficher les meilleurs résultats';
$string['displayinleftmenu'] = 'Afficher dans le menu à gauche ?';
$string['displayleftif'] = 'N\'afficher le menu de gauche que si la note est supérieure à';
$string['displayleftif_help'] = 'Ce réglage détermine si un participant doit obtenir une note minimale pour que le menu de gauche soit affiché. Ceci impose au participant de parcourir la totalité de la leçon lors de sa première tentative, puis lui permet d\'utiliser le menu pour sa relecture, s\'il a obtenu la note requise.';
$string['displayleftmenu'] = 'Afficher le menu de gauche';
$string['displayleftmenu_help'] = 'Si ce réglage est activé, une liste des pages est affichée.';
$string['displayofgrade'] = 'Affichage de la note (pour l\'étudiant)';
$string['displayreview'] = 'Offrir la possibilité de refaire une question';
$string['displayreview_help'] = 'Si cette option est activée, lorsqu\'une question reçoit une réponse incorrecte, l\'étudiant a la possibilité de corriger celle-ci (sans obtenir de point) ou de continuer la leçon.';
$string['displayscorewithessays'] = 'Vous avez obtenu un score de {$a->score} sur {$a->tempmaxgrade} aux questions notées automatiquement.<br />Les notes de votre(vos) {$a->essayquestions} composition(s) sera(ont) évaluée(s) et ajoutée(s)<br />au score final ultérieurement.<br /><br />Votre note actuelle sans la(les) composition(s) est de {$a->score} sur {$a->grade}.';
$string['displayscorewithoutessays'] = 'Votre score est de {$a->score} (sur {$a->grade}).';
$string['edit'] = 'Modifier';
$string['editingquestionpage'] = 'Modifier la page de question {$a}';
$string['editlessonsettings'] = 'Modifier les réglages de la leçon';
$string['editpage'] = 'Modifier le contenu de la page';
$string['editpagecontent'] = 'Modifier le contenu de la page';
$string['email'] = 'Courriel';
$string['emailallgradedessays'] = 'Envoyer par courriel TOUTES les compositions évaluées';
$string['emailgradedessays'] = 'Envoyer par courriel les compositions évaluées';
$string['emailsuccess'] = 'Envoi effectué avec succès';
$string['emptypassword'] = 'Le mot de pass ne peut pas être vide';
$string['endofbranch'] = 'Fin de branchement';
$string['endofcluster'] = 'Fin du groupe';
$string['endofclustertitle'] = 'Fin de groupe';
$string['endoflesson'] = 'Fin de la leçon';
$string['enteredthis'] = 'a tapé ceci';
$string['entername'] = 'Saississez un pseudonyme pour la liste des meilleurs résultats';
$string['enterpassword'] = 'Veuillez saisir le mot de passe :';
$string['eolstudentoutoftime'] = 'Attention : le temps à votre disposition pour cette leçon est échu. Votre dernière réponse ne sera pas prise en compte si elle est survenue après l\'échéance.';
$string['eolstudentoutoftimenoanswers'] = 'vous n\'avez répondu à aucune question. Votre note pour cette leçon est de 0.';
$string['essay'] = 'Composition';
$string['essayemailmessage'] = '<p>Question ouverte :<blockquote>{$a->question}</blockquote></p><p>Votre réponse :<blockquote><em>{$a->response}</em></blockquote></p><p>Commentaire de l\'enseignant :<blockquote><em>{$a->comment}</em></blockquote></p><p>Vous avez obtenu {$a->earned} points sur un total de {$a->outof} à cette question ouverte.</p><p>Votre note pour cette leçon est maintenant {$a->newgrade} &#37;.</p>';
$string['essayemailmessage2'] = '<p>Question ouverte :<blockquote>{$a->question}</blockquote></p><p>Votre réponse :<blockquote><em>{$a->response}</em></blockquote></p><p>Commentaire de l\'évaluateur :<blockquote><em>{$a->comment}</em></blockquote></p><p>Vous avez obtenu {$a->earned} points sur un total de {$a->outof} à cette question ouverte.</p><p>Votre note pour cette leçon est maintenant {$a->newgrade} &#37;.</p>';
$string['essayemailsubject'] = 'Votre note pour la question {$a}';
$string['essays'] = 'Compositions';
$string['essayscore'] = 'Score de votre composition';
$string['fileformat'] = 'Format de fichier';
$string['finish'] = 'Terminer';
$string['firstanswershould'] = 'La première réponse devrait toujours diriger vers la page « Réponse correcte »';
$string['firstwrong'] = 'Vous ne recevez malheureusement pas ce point, car votre réponse n\'est pas correcte. Voulez-vous essayer de deviner la bonne réponse, pour le plaisir d\'apprendre (mais sans recevoir de point) ?';
$string['flowcontrol'] = 'Contrôle du déroulement';
$string['full'] = 'Agrandir';
$string['general'] = 'Général';
$string['gotoendoflesson'] = 'Aller à la fin de la leçon';
$string['grade'] = 'Note';
$string['gradebetterthan'] = 'Note supérieure à (&#37;)';
$string['gradebetterthanerror'] = 'Obtenir une note supérieure à {$a} pour-cents';
$string['gradeessay'] = 'Évaluer les questions de composition ({$a->notgradedcount} sans note et {$a->notsentcount} pas envoyés)';
$string['gradeis'] = 'La note est {$a}';
$string['gradeoptions'] = 'Options des notes';
$string['handlingofretakes'] = 'Traitement des différentes tentatives';
$string['handlingofretakes_help'] = 'Lorsque les étudiants ont le droit de répéter la leçon, cette option permet à l\'enseignant d\'afficher comme note de la leçon, par exemple dans la page des notes, la note **moyenne** de toutes les tentatives ou la note de la **meilleure** tentative des étudiants.
Cette option peut être modifiée en tout temps.';
$string['havenotgradedyet'] = 'Pas encore été notée.';
$string['here'] = 'ici';
$string['highscore'] = 'Meilleure note';
$string['highscores'] = 'Meilleures notes';
$string['hightime'] = 'Plus longue durée';
$string['importcount'] = 'Importation de {$a} questions';
$string['importppt'] = 'Importer un diaporama PowerPoint';
$string['importppt_help'] = '## Avertissement
Cette fonctionnalité présente des problèmes d\'utilisation importants, qui ont fait l\'objet d\'une longue discussion dans les forums de Moodle. Vous pouvez utilement [vous y reporter](http://moodle.org/mod/forum/discuss.php?d=86054). Il y est notamment suggéré de convertir la présentation au format Flash, à l\'aide d\'outils tels que Speechi, Flashpoint ou OpenOffice.Org. Une autre possibilité évoquée consiste à générer un document PDF à partir de la présentation. Les documents Flash ou PDF ainsi obtenus sont, eux, aisément intégrables dans Moodle.
## Utilisation de l\'importation PowerPoint
Toutes les diapositives de la présentation PowerPoint sont importées comme des tables de branchement, comportant des boutons Précédent et Suivant.

1. Ouvrez votre présentation PowerPoint.
2. Enregistrez-la au format HTML (sans option particulière).
3. Vous obtenez un fichier .htm et un dossier contenant toutes les diapositives converties en pages web.
Compressez en ZIP le dossier **uniquement**.
4. Rendez-vous sur votre site Moodle et créez une nouvelle leçon.
5. Après avoir défini les paramètres de la leçon, à la question « Par quoi voulez-vous commencer ? », quatres propositions vous sont faites. Cliquez sur « Importer Powerpoint ».
6. À l\'aide du bouton « Parcourir » retrouvez le fichier ZIP créé à l\'étape 3. Puis cliquez sur « Déposer ce fichier ».
7. Si tout s\'est bien déroulé, la page suivante affiche un bouton « Continuer ».

Si votre présentation comporte des images, elles sont enregistrées avec les fichiers du cours, dans le dossier moddata/XY, où X représente le nom de votre leçon, et Y est un chiffre (habituellement 0). De même, à l\'occasion de l\'importation, des fichiers sont créés dans le répertoire moodledata, dans un dossier temp/lesson. A priori, ces fichiers ne sont pas supprimés par importppt.php.';
$string['importquestions'] = 'Importer des questions';
$string['importquestions_help'] = 'Cette fonction vous permet d\'importer des questions depuis des fichiers texte externes, déposés dans Moodle à l\'aide d\'un formulaire.
Plusieurs formats de fichier sont supportés :
## Format GIFT

Le format GIFT est le format le plus complet disponible pour l\'importation de questions de tests dans Moodle. Il a été conçu pour permettre aux enseignants d\'écrire facilement des questions dans un fichier texte. Il supporte les questions à Choix multiples, Vrai-Faux, à Réponse courte, d\'Appariement, Numériques, ainsi que l\'insertion de \_\_\_|\_\_ pour le format Mot manquant. Ces différents types de questions peuvent être mélangés dans un même fichier texte, et le format permet en outre des lignes de commentaires, des noms pour les questions, les feedbacks et les notes pondérées (en %). Voici quelques exemples :

Quelle était la couleur de la jument blanche de Napoléon ?{~Verte ~Noire =Blanche}
La monture de Napoléon était {=une jument ~un étalon ~un mulet}.
La jument de Napoléon était verte.{FALSE}
Quelle était la nationalité de Napoléon ?{=Corse =Française}
En quelle année Napoléon est-il mort ?{#1821}

[Plus d\'informations sur le format GIFT](help.php?file=formatgift.html&module=quiz)

## Format Aiken

Le format Aiken fournit une manière très simple de créer des questions à choix multiples dans un format facile à lire. Voici un exemple de ce format :

Quelle est la réponse correcte à cette question ?
A. Celle-ci ?
B. Peut-être cette réponse ?
C. Ou celle-ci ?
D. Voilà la bonne !
ANSWER: D

[Plus d\'informations sur le format Aiken](help.php?file=formataiken.html&module=quiz)

## Format « Mots manquants »

Ce format ne supporte que les questions à choix multiples. Chaque réponse proposée est préfixée par un tilde (~), et la réponse correcte est préfixée par un signe égal (=). Voici un exemple :

Dès le moment où, enfants, nous explorons notre corps, nous devenons des étudiants en {=anatomie et physiologie ~réflexologie ~science ~expérimentation}, et dans un sens nous restons des étudiants pour toute notre vie.

[Plus d\'informations sur le format « Mots manquants »](help.php?file=formatmissingword.html&module=quiz)

## Format AON

Ce format est identique au format « Mots manquants », mais lors de l\'importation, les questions à réponse courte sont 4 par 4 converties en questions d\'appariement.
En outre, les réponses sont mélangées aléatoirement durant l\'importation.
Le nom de ce format provient de l\'institution qui a parrainé le développement de nombreuses fonctionnalité des tests.

## Format Blackboard

Les questions exportées en format Blackboard peuvent également être importées, grâce aux fonctions XML intégrées dans PHP.
[Plus d\'informations sur le format Blackboard](help.php?file=formatblackboard.html&module=quiz)

## Format CTM (Course Test Manager)

Les questions en format CTM peuvent également être importées, pour autant que votre Moodle puisse avoir accès à la base de données Access qui les contient. La procédure d\'importation dépend du serveur sur lequel tourne votre Moodle.
Sous Windows, la base Access peut être directement importée comme n\'importe quelle autre fichier.
Avec Linux, vous devez configurer dans le même réseau que votre serveur un ordinateur Windows avec la base de données CTM et le logiciel ODBC Socket Server, qui utilisera XML pour transférer les données sur le moodle de votre serveur Linux.
Veuillez SVP lire attentivement le fichier d\'aide ci-dessous avant d\'utiliser cette importation.
[Plus d\'informations sur le format CTM](help.php?file=formatctm.html&module=quiz)

## Format personnalisé

Si vous désirez importer votre propre format, vous pouvez l\'implémenter directement en modifiant le fichier mod/quiz/format/custom.php.
Il y a peu de code à écrire, juste de quoi extraire une simple question à partir d\'un texte donné.
[Plus d\'informations sur le format personnalisé.](help.php?file=formatcustom.html&module=quiz)

D\'autres formats seront bientôt disponibles pour l\'importation, notamment WebCT, IMS QTI et tout ceux que les utilisateurs de Moodle pourront apporter!';
$string['insertedpage'] = 'Page insérée';
$string['invalidfile'] = 'Fichier non valide';
$string['invalidid'] = 'Aucun identifiant de cours ou de leçon n\'a été fourni';
$string['invalidlessonid'] = 'Identifiant de leçon non valide';
$string['invalidpageid'] = 'Identifiant de page non valide';
$string['jump'] = 'Aller';
$string['jumps'] = 'Sauts';
$string['jumps_help'] = 'Chaque réponse (pour les questions) ou description (pour les pages de contenu) possède un lien correspondant. Ce lien peut être relatif, comme cette page ou la page suivante, ou absolu, en spécifiant une page de la leçon.';
$string['jumpsto'] = 'Saute vers <em>{$a}</em>';
$string['leftduringtimed'] = 'Vous avez quitté une leçon à durée limitée.<br />Veuillez cliquer sur Continuer pour recommencer cette leçon.';
$string['leftduringtimednoretake'] = 'Vous avez quitté une leçon à durée limitée et vous n\'êtes<br />pas autorisé à la recommencer ou la continuer.';
$string['lesson:edit'] = 'Modifier les activités leçon';
$string['lesson:manage'] = 'Gérer les activités leçon';
$string['lessonattempted'] = 'Leçon effectuée';
$string['lessonclosed'] = 'Cette leçon n\'est plus disponible depuis {$a}.';
$string['lessoncloses'] = 'La leçon se termine';
$string['lessoncloseson'] = 'La leçon se termine le {$a}';
$string['lessonformating'] = 'Format de la leçon';
$string['lessonmenu'] = 'Menu leçon';
$string['lessonnotready'] = 'Cette leçon n\'est encore prête. Veuillez contacter votre {$a}.';
$string['lessonnotready2'] = 'Cette leçon n\'est encore prête.';
$string['lessonopen'] = 'Cette leçon sera ouverte le {$a}.';
$string['lessonopens'] = 'La leçon s\'ouvre';
$string['lessonpagelinkingbroken'] = 'La première page n\'a pas été trouvée. Les liens de la leçon sont vraisemblablement cassés. Veuillez contacter un administrateur.';
$string['lessonstats'] = 'Statistiques de la leçon';
$string['linkedmedia'] = 'Médias liés';
$string['loginfail'] = 'Connexion échouée, veuillez réessayer...';
$string['lowscore'] = 'Note la plus basse';
$string['lowtime'] = 'Plus courte durée';
$string['manualgrading'] = 'Évaluer les compositions';
$string['matchesanswer'] = 'Correspond avec la réponse';
$string['matching'] = 'Correspondant';
$string['matchingpair'] = 'Paire correspondante {$a}';
$string['maxgrade'] = 'Note maximale';
$string['maxgrade_help'] = 'Cette valeur détermine la note maximale pouvant être accordée dans cette leçon. Elle doit se situer entre 0 et 100%. Cette valeur peut être modifiée en tout temps durant la leçon. Tout changement aura un effet immédiat dans la page des notes, ainsi que dans les différentes listes affichées pour les étudiants. Si l\'ont met 0 pour cette valeur, la leçon n\'apparaîtra dans aucune des pages de notes.';
$string['maxhighscores'] = 'Nombre de meilleurs résultats affichés';
$string['maximumnumberofanswersbranches'] = 'Nombre maximal de réponses';
$string['maximumnumberofanswersbranches_help'] = 'Cette valeur détermine le nombre maximal de réponses utilisables dans la leçon. Si une leçon n\'utilise que des questions vrai/faux, elle peut être fixée à 2. Ce paramètre peut être modifié à tout moment, car il n\'a d\'effet que sur ce que voit l\'enseignant, pas sur les données.';
$string['maximumnumberofattempts'] = 'Nombre maximal de tentatives';
$string['maximumnumberofattempts_help'] = 'Ce réglage fixe le nombre maximal de tentatives à disposition des étudiants pour répondre à chaque question. Si une réponse incorrecte est répétée, lorsque cette valeur est atteinte, la page suivante de la leçon est affichée.';
$string['maximumnumberofattemptsreached'] = 'Le nombre maximal de tentatives a été atteint - On passe à la page suivante';
$string['maxtime'] = 'Durée maximale (minutes)';
$string['maxtimewarning'] = 'Il vous reste {$a} minute(s) pour terminer la leçon.';
$string['mediaclose'] = 'Afficher un bouton fermer :';
$string['mediafile'] = 'Pop-up vers fichier ou page web';
$string['mediafile_help'] = 'Cette option créera au début de la leçon une fenêtre surgissante contenant un fichier (par exemple un fichier mp3) ou une page web. En outre, un lien permettant de rouvrir cette fenêtre sera affiché sur chacune des pages de la leçon.
Un bouton « Fermer la fenêtre » peut être affiché optionnellement au bas de la fenêtre surgissante. la taille de la fenêtre (hauteur et largeur) peut également être spécifiée.
Les types de fichiers ci-dessous peuvent être placés dans une telle fenêtre.

* MP3
* Quicktime
* Realmedia
* Windows Media Player
* HTML
* Texte
* GIF
* JPEG
* PNG

Tous les autres types de fichiers seront indiqués par un lien pour téléchargement.';
$string['mediafilepopup'] = 'Cliquer ici pour afficher';
$string['mediaheight'] = 'Hauteur fenêtre :';
$string['mediawidth'] = 'Largeur :';
$string['messageprovider:graded_essay'] = 'Notification d\'évaluation de composition';
$string['minimumnumberofquestions'] = 'Nombre minimal de questions';
$string['minimumnumberofquestions_help'] = 'Ce paramètre spécifie le nombre minimum de questions qui seront utilisées pour calculer la note de l\'activité. Si la leçon contient une ou plusieurs pages de contenu, le nombre minimum de questions doit être fixé à zéro.
S\'il est fixé à 20, cela signifie que le texte suivant sera ajouté à la page d\'accueil de la leçon : « Dans cette leçon, vous devez répondre à au moins 20 questions. Vous pouvez répondre répondre à plus de questions si vous le souhaitez. Quoiqu\'il en soit, si vous répondez à moins de 20 questions, votre note sera calculée comme si vous en aviez traité 20.»';
$string['missingname'] = 'Veuillez saisir un pseudo';
$string['modattempts'] = 'Permettre la relecture par les étudiants';
$string['modattempts_help'] = 'Ce réglage permet aux étudiants de revenir sur une leçon passée pour modifier leurs réponses.';
$string['modattemptsnoteacher'] = 'La critique par les étudiants ne fonctionne que pour les étudiants.';
$string['modulename'] = 'Leçon';
$string['modulename_help'] = 'Une leçon permet de transmettre des informations de façon très flexible. Elle se compose de plusieurs pages qui chacune se termine normalement par une question et un choix de réponses. Selon le choix de l\'étudiant, la leçon peut se poursuivre par la page suivante ou par une autre page. Le parcours suivi peut être simple ou complexe, selon la structure du matériel présenté.';
$string['modulenameplural'] = 'Leçons';
$string['move'] = 'Déplacer la page';
$string['movedpage'] = 'Page déplacée';
$string['movepagehere'] = 'Déplacer la page ici';
$string['moving'] = 'Déplacement de la page : {$a}';
$string['multianswer'] = 'Plusieurs réponses';
$string['multianswer_help'] = 'Quelques types de question ont une option pouvant être activée en cochant cette case. Les types de question concernés et les détails de l\'option correspondante sont décrits ci-dessous.

1. **Question à choix multiples.** Une variante des questions à choix multiples sont les « **Questions à choix multiples et à réponses multiples** ». Si l\'option est activée, l\'étudiant doit alors cocher toutes les réponses correctes par l\'ensemble proposé. La question peut indiquer ou non le \*nombre\* de bonnes réponses. Par exemple « Choisir deux rois de France dans la liste des personnages suivants » dans le premier cas, et « Lesquels de ces personnages ont été des rois de France ? » Le nombre des bonnes réponses peut varier de 1 au nombre de choix proposés. Une telle question avec une seule bonne réponse est **différente** d\'une simple question à choix multiples, car contrairement à celle-ci, elle permet à l\'étudiant de choisir plusieurs réponses.
2. **Question à réponse courte.** Par défaut, le programme compare la (ou les) réponse(s) attendue(s) avec la réponse saisie par l\'étudiant en utilisant le système d\'analyse simple. Cochez la case **Utiliser les expressions régulières:** si vous souhaitez utiliser cet autre système.

Les autres types de questions n\'utilisent pas l\'option de question.';
$string['multichoice'] = 'Choix multiples';
$string['multipleanswer'] = 'Réponses multiples';
$string['nameapproved'] = 'Nom approuvé';
$string['namereject'] = 'Désolé, votre nom a été rejeté par le filtre.<br />Veuillez essayer un autre nom.';
$string['new'] = 'Nouveau';
$string['nextpage'] = 'Page suivante';
$string['noanswer'] = 'Aucune réponse donnée. Veuillez revenir en arrière et donner une réponse.';
$string['noattemptrecordsfound'] = 'Aucune tentative trouvée : pas de note';
$string['nobranchtablefound'] = 'Aucune page de contenu';
$string['nocommentyet'] = 'Pas encore de commentaire.';
$string['nocoursemods'] = 'Aucune activité trouvée';
$string['nocredit'] = 'Pas de crédit';
$string['nodeadline'] = 'Pas d\'échéance';
$string['noessayquestionsfound'] = 'Il n\'y a pas de question de composition dans cette leçon.';
$string['nohighscores'] = 'Pas de meilleur résultat';
$string['nolessonattempts'] = 'Personne n\'a encore fait cette leçon.';
$string['nooneansweredcorrectly'] = 'Personne n\'a répondu correctement.';
$string['nooneansweredthisquestion'] = 'Personne n\'a répondu à cette question.';
$string['noonecheckedthis'] = 'Personne n\'a coché cette option.';
$string['nooneenteredthis'] = 'Personne n\'a tapé ceci.';
$string['noonehasanswered'] = 'Personne n\'a encore répondu à une question de composition.';
$string['noretake'] = 'Vous n\'êtes pas autorisé à refaire cette leçon.';
$string['normal'] = 'Normal - suivre le parcours de la leçon';
$string['notcompleted'] = 'Pas terminé';
$string['notdefined'] = 'Non défini';
$string['nothighscore'] = 'Vous n\'entrez pas parmi les {$a} meilleurs résultats.';
$string['notitle'] = 'Pas de titre';
$string['numberofcorrectanswers'] = 'Nombre de réponses correctes : {$a}';
$string['numberofcorrectmatches'] = 'Nombre d\'appariements corrects : {$a}';
$string['numberofpagestoshow'] = 'Nombre de pages à afficher';
$string['numberofpagestoshow_help'] = 'Ce paramètre n\'est utilisé que pour les leçons de type « cartes éclair » (flash cards). La valeur par défaut est de 0, ce qui signifie que toutes la pages (cartes) sont affichées dans une leçon. Une valeur non-nulle de ce paramètre définit le nombre de pages à afficher. La leçon est terminée après que ce nombre de pages a été affiché et la note est présentée à l\'étudiant.
Si la valeur de ce paramètre dépasse le nombre effectif de pages de la leçon, la fin de la leçon a lieu après l\'affichage de toutes les pages.';
$string['numberofpagesviewed'] = 'Nombre de questions répondues : {$a}';
$string['numberofpagesviewednotice'] = 'Nombre de questions répondues : {$a->nquestions} ; (vous devez répondre au moins à {$a->minquestions})';
$string['numerical'] = 'Numérique';
$string['ongoing'] = 'Afficher le score actuel';
$string['ongoing_help'] = 'Grâce à cette option, l\'étudiant pourra voir, sur chaque page, son nombre de points par rapport au maximum possible. Par exemple : sur quatre questions à 5 points, l\'étudiant s\'est trompé à une. Il sera affiché qu\'il a a obtenu 15 points sur 20.';
$string['ongoingcustom'] = 'Vous avez jusqu\'ici reçu {$a->score} sur un maximum de {$a->currenthigh} point(s).';
$string['ongoingnormal'] = 'Vous avez répondu correctement à {$a->correct} tentatives sur {$a->viewed}.';
$string['onpostperpage'] = 'Seulement un message par note';
$string['options'] = 'Options';
$string['or'] = 'OU';
$string['ordered'] = 'Ordonnés';
$string['other'] = 'Autre';
$string['outof'] = 'sur {$a}';
$string['overview'] = 'Vue d\'ensemble';
$string['overview_help'] = 'Une leçon est constituée de plusieurs pages et éventuellement de pages de contenu.
Une page contient des données et se termine souvent par une question. Un lien est associé à chaque réponse. Ce lien peut être relatif, comme cette page ou page suivante, ou absolue, en spécifiant une des pages de la leçon. Une page de contenu est une page qui contient des liens vers d\'autres pages de la leçon, comme une table des matières.';
$string['page'] = 'Page : {$a}';
$string['page-mod-lesson-edit'] = 'Modifier page de leçon';
$string['page-mod-lesson-view'] = 'Afficher ou prévisualiser une page leçon';
$string['page-mod-lesson-x'] = 'Toute page de leçon';
$string['pagecontents'] = 'Contenu de la page';
$string['pages'] = 'Pages';
$string['pagetitle'] = 'Titre de la page';
$string['password'] = 'Mot de passe';
$string['passwordprotectedlesson'] = '{$a} est une leçon protégée par mot de passe.';
$string['pleasecheckoneanswer'] = 'Valider la réponse choisie';
$string['pleasecheckoneormoreanswers'] = 'Valider la ou les réponses choisies';
$string['pleaseenteryouranswerinthebox'] = 'Veuillez saisir votre réponse dans le champ';
$string['pleasematchtheabovepairs'] = 'Valider les appariements choisis';
$string['pluginadministration'] = 'Administration de la leçon';
$string['pluginname'] = 'Leçon';
$string['pointsearned'] = 'Points reçus';
$string['postprocesserror'] = 'Erreur lors du post-traitement !';
$string['postsuccess'] = 'Message envoyé avec succès';
$string['pptsuccessfullimport'] = 'Pages correctement importées de la présentation PowerPoint';
$string['practice'] = 'Leçon d\'entraînement';
$string['practice_help'] = 'Le résultat d\'une leçon d\'entraînement n\'apparaîtra pas dans le carnet de notes.';
$string['preprocesserror'] = 'Erreur lors du pré-traitement !';
$string['preview'] = 'Prévisualisation';
$string['previewlesson'] = 'Prévisualiser {$a}';
$string['previouspage'] = 'Page précédente';
$string['processerror'] = 'Erreur lors du traitement !';
$string['progressbar'] = 'Barre de progression';
$string['progressbar_help'] = 'Si ce réglage est activé, une barre de progression est affichée en bas des page de la leçon, indiquant le pourcentage approximatif du travail effectué.';
$string['progressbarteacherwarning'] = 'La barre de progression ne s\'affiche pas pour {$a}';
$string['progressbarteacherwarning2'] = 'La barre de progression ne sera pas affichée, car vous pouvez modifier cette leçon';
$string['progresscompleted'] = 'Vous avez terminé {$a} % de la leçon';
$string['qtype'] = 'Type de page';
$string['question'] = 'Question';
$string['questionoption'] = 'Question';
$string['questiontype'] = 'Type de question';
$string['randombranch'] = 'Page de contenu aléatoire';
$string['randompageinbranch'] = 'Question aléatoire au sein d\'une page de contenu';
$string['rank'] = 'Rang';
$string['rawgrade'] = 'Note brute';
$string['receivedcredit'] = 'A reçu les points';
$string['redisplaypage'] = 'Réafficher la page';
$string['report'] = 'Rapport';
$string['reports'] = 'Rapports';
$string['response'] = 'Feedback';
$string['retakesallowed'] = 'Plusieurs tentatives permises';
$string['retakesallowed_help'] = 'Cette option détermine si les étudiants peuvent suivre la leçon une seule fois ou à plusieurs reprises. Il est préférable de permettre aux étudiants de suivre la leçon à plusieurs reprises lorsque l\'enseignant estime que le sujet doit être approfondi et très bien compris. Dans le cas où la leçon sert plutôt de test, l\'étudiant ne devrait faire la leçon qu\'une seule fois.
La note retenue dans la page **Notes** est soit la note **moyenne**, soit la note **maximale** obtenue lors des différents essais, dans le cas où la leçon est faite plusieurs fois. Un paramètre permet de choisir laquelle de ces deux options est utilisée.
Toutefois, l\'outil d\'analyse des résultats aux questions utilise uniquement les réponses faites lors de la première tentative, et que les autres tentatives des étudiants sont ignorées.
Par défaut, cette option est réglée sur **Non**, ce qui veut dire que les étudiants peuvent suivre la leçon à plusieurs reprises. On considère que seules des circonstances exceptionnelles devraient mener à régler cette valeur sur **Oui**.';
$string['returnto'] = 'Retour à {$a}';
$string['returntocourse'] = 'Retour au cours';
$string['review'] = 'Relecture';
$string['reviewlesson'] = 'Revoir la leçon';
$string['reviewquestionback'] = 'Oui, j\'aimerais essayer à nouveau';
$string['reviewquestioncontinue'] = 'Non, je veux passer à la question suivante';
$string['sanitycheckfailed'] = 'Vérification échouée : cette tentative a été supprimée';
$string['savechanges'] = 'Enregistrer les modifications';
$string['savechangesandeol'] = 'Enregistrer tous les changements et aller à la fin de la leçon.';
$string['savepage'] = 'Enregistrer la page';
$string['score'] = 'Score';
$string['scores'] = 'Scores';
$string['secondpluswrong'] = 'Pas tout à fait. Voulez-vous essayer à nouveau ?';
$string['selectaqtype'] = 'Sélectionner un type de question';
$string['shortanswer'] = 'Réponse courte';
$string['showanunansweredpage'] = 'Afficher une page sans réponse';
$string['showanunseenpage'] = 'Afficher une page non vue';
$string['singleanswer'] = 'Réponse simple';
$string['skip'] = 'Sauter la navigation';
$string['slideshow'] = 'Diaporama';
$string['slideshow_help'] = 'Ce réglage permet d\'afficher la leçon à la manière d\'une présentation, avec une largeur et une hauteur déterminées, et une couleur de fond personnalisée. Le cas échéant, une barre de défilement s\'affichera. Les pages de questions échapperont à ce mode, seules les pages de tables de branchements s\'afficheront par défaut comme une présentation. Des boutons avec l\'inscription (dans la langue par défaut) « Précédent » et « Suivant » apparaîtront dans le coin inférieur droit de la présentation si la page a prévu cette option. Les autres boutons seront centrés en bas de la présentation.';
$string['slideshowbgcolor'] = 'Couleur de fond du diaporama';
$string['slideshowheight'] = 'Hauteur du diaporama';
$string['slideshowwidth'] = 'Largeur du diaporama';
$string['startlesson'] = 'Commencer la leçon';
$string['studentattemptlesson'] = 'Tentative numéro {$a->attempt} de {$a->firstname} {$a->lastname}';
$string['studentname'] = 'Nom de l\'étudiant';
$string['studentoneminwarning'] = 'Attention : il vous reste moins d\'une minute pour terminer la leçon.';
$string['studentresponse'] = 'Feedback de {$a}';
$string['submit'] = 'Envoyer';
$string['submitname'] = 'Proposer un nom';
$string['teacherjumpwarning'] = 'Un lien {$a->cluster} ou un lien {$a->unseen} est utilisé dans cette leçon. Un lien « Page suivante » sera utilisé à sa place. Veuillez vous connecter en tant que participant pour tester ces liens.';
$string['teacherongoingwarning'] = 'Le score actuel n\'est affiché que pour les étudiants. Veuillez vous connecter en tant qu\'étudiant pour tester le score actuel.';
$string['teachertimerwarning'] = 'Le chronomètre ne fonctionne que pour les étudiants. Veuillez vous connecter en tant qu\'étudiant pour tester le chronomètre.';
$string['thatsthecorrectanswer'] = 'C\'est une réponse correcte';
$string['thatsthewronganswer'] = 'C\'est une mauvaise réponse';
$string['thefollowingpagesjumptothispage'] = 'Les pages suivantes renvoient vers cette page';
$string['thispage'] = 'Cette page';
$string['timeremaining'] = 'Durée restante';
$string['timespenterror'] = 'Passer au moins {$a} minutes dans la leçon';
$string['timespentminutes'] = 'Durée utilisée (minutes)';
$string['timetaken'] = 'Durée utilisée';
$string['topscorestitle'] = 'Les {$a} meilleurs résultats';
$string['truefalse'] = 'Vrai/Faux';
$string['unabledtosavefile'] = 'Le fichier déposé n\'a pas pu être enregistré.';
$string['unknownqtypesnotimported'] = '{$a} questions de types de questions non supportés n\'ont pas été importées';
$string['unseenpageinbranch'] = 'Question non vue au sein d\'une page de contenu';
$string['unsupportedqtype'] = 'Type de question non supporté ({$a}) !';
$string['updatedpage'] = 'Page modifiée';
$string['updatefailed'] = 'Modification échouée';
$string['usemaximum'] = 'Utiliser le maximum';
$string['usemean'] = 'Utiliser la moyenne';
$string['usepassword'] = 'Leçon protégée par mot de passe';
$string['usepassword_help'] = 'L\'étudiant doit saisir un mot de passe pour accéder à la leçon.';
$string['viewgrades'] = 'Afficher les notes';
$string['viewhighscores'] = 'Afficher les meilleurs résultats.';
$string['viewreports'] = 'Afficher les {$a->attempts} tentatives terminées';
$string['viewreports2'] = 'Afficher les {$a} tentatives terminées';
$string['welldone'] = 'Bien joué !';
$string['whatdofirst'] = 'Par quoi voulez-vous commencer ?';
$string['wronganswerjump'] = 'Lien après mauvaise réponse';
$string['wronganswerscore'] = 'Score des mauvaises réponses';
$string['wrongresponse'] = 'Feedback mauvaise réponse';
$string['xattempts'] = '{$a} tentatives';
$string['youhaveseen'] = 'Vous avez déjà vu au moins une page de cette leçon.<br />Voulez-vous commencer à la dernière page que vous avez vue ?';
$string['youmadehighscore'] = 'Vous avez un des {$a} meilleurs résultats.';
$string['youranswer'] = 'Votre réponse';
$string['yourcurrentgradeis'] = 'Votre note actuelle est {$a}';
$string['yourcurrentgradeisoutof'] = 'Votre note actuelle est {$a->grade} sur {$a->total}';
$string['youshouldview'] = 'Vous devriez répondre au moins à {$a}';
