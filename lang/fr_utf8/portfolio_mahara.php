<?php
// portfolio_mahara.php - created with Totara langimport script version 1.1

$string['err_invalidhost'] = 'Ce plugin pointe vers un hôte mnet non valide ou supprimé. Il nécessite l\'utilisation de pairs Réseau Moodle avec SSO (fournisseur d\'identité) publiée et abonnement SSO au portfolio (fournisseur de service).';
$string['err_networkingoff'] = 'Le Réseau Moodle est totalement désactivé. Veuillez l\'activer avant de configurer ce plugin. En attendant, toutes les instances de ce plugin ont été cachées. Vous devrez les rendre visibles manuellement ultérieurement. Elles ne peuvent être utilisées actuellement.';
$string['err_nomnetauth'] = 'La méthode d\'authentification mnet est désactivée, alors que ce service en a besoin.';
$string['err_nomnethosts'] = 'Ce plugin nécessite l\'utilisation de pairs Réseau Moodle avec SSO (fournisseur d\'identité) publiée et abonnement SSO au portfolio (fournisseur de service), ainsi que la méthode d\'authentification mnet. Toutes les instances de ce plugin ont été cachées. Vous devrez les rendre visibles manuellement une fois la configuration corrigée. Ces instances ne peuvent pas fonctionner jusque là.';
$string['failedtojump'] = 'Échec de communication avec le serveur distant';
$string['failedtoping'] = 'Échec de communication avec le serveur distant : $a';
$string['mnet_nofile'] = 'Impossible de trouver de fichier dans l\'objet transfert - erreur bizarre';
$string['mnet_nofilecontents'] = 'Fichier trouvé  dans l\'objet transfert, mais impossible d\'obtenir son contenu - erreur bizarre : $a';
$string['mnet_noid'] = 'Impossible de trouver l\'enregistrement du transfert pour ce jeton';
$string['mnet_notoken'] = 'Impossible de trouver le jeton correspondant à ce transfert';
$string['mnet_wronghost'] = 'Le serveur distant ne correspond pas à l\'enregistrement du transfert pour ce jeton';
$string['mnethost'] = 'Hôte réseau Moodle';
$string['pf_description'] = 'Permet aux utilisateurs de copier des contenus du site Moodle sur ce serveur.<br />En vous abonnant à ce service, vous permettrez aux utilisateurs authentifiés de votre site de copier des contenus sur $a<br /><ul><li><em>Dépendance</em> : vous devez également <strong>publier</strong> le service SSO (fournisseur d\'identité) vers $a.</li><li><em>Dépendance</em> : vous devez également vous <strong>abonner</strong> au service SSO (fournisseur de service) de $a</li><li><em>Dépendance</em> : vous devez également activer la méthode d\'authentification mnet.</li></ul><br />';
$string['pf_name'] = 'Services portfolio';
$string['pluginname'] = 'Portfolio Mahara';
$string['senddisallowed'] = 'Il n\'est actuellement pas possible de transférer des fichiers vers Mahara';
$string['url'] = 'URL';

?>
