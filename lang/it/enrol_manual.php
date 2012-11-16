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
 * Strings for component 'enrol_manual', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_manual
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['alterstatus'] = 'Modifica lo stato';
$string['altertimeend'] = 'Modifica data di fine';
$string['altertimestart'] = 'Modifica data di inizio';
$string['assignrole'] = 'Assegna ruolo';
$string['confirmbulkdeleteenrolment'] = 'Sei sicuro di eliminare queste iscrizioni ?';
$string['defaultperiod'] = 'Durata di default dell\'iscrizione';
$string['defaultperiod_desc'] = 'La durata di default dell\'iscrizione, espressa in secondi. Impostarla a zero per una durata di default dell\'iscrizione senza limite.';
$string['defaultperiod_help'] = 'La durata di default dell\'iscrizione, a partire dalla data di iscrizione dell\'utente. Disabilitare l\'impostazione per una durata di default dell\'iscrizione senza limite.';
$string['deleteselectedusers'] = 'Elimina le iscrizioni selezionate';
$string['editenrolment'] = 'Modifica iscrizione';
$string['editselectedusers'] = 'Modifica le iscrizioni selezionate';
$string['enrolledincourserole'] = 'Iscritto al corso "{$a->course}" con il ruolo di "{$a->role}"';
$string['enrolusers'] = 'Iscrivi utenti';
$string['manual:config'] = 'Configurare istanze plugin Iscrizioni manuali';
$string['manual:enrol'] = 'Iscrivere utenti';
$string['manual:manage'] = 'Gestire iscrizioni';
$string['manual:unenrol'] = 'Disiscrivere utenti dai corsi';
$string['manual:unenrolself'] = 'Disiscriversi dai corsi';
$string['pluginname'] = 'Iscrizione manuale';
$string['pluginname_desc'] = 'Il plugin Iscrizione manuale consente di iscrivere manualmente gli utenti ai corsi sia tramite un link nell\'Amministrazione del corso, sia da parte di un utente in possesso dei privilegi necessari, ad esempio un docente. Di norma questo plugin dovrebbe essere abilitato poiché altri plugin di iscrizione, come ad esempio le iscrizioni spontanee, lo richiedono.';
$string['status'] = 'Abilita iscrizione manuale';
$string['status_desc'] = 'Permette l\'accesso ai corsi da parte di utenti iscritti manualmente. Di norma deve rimanere abilitato.';
$string['status_help'] = 'L\'impostazione stabilisce se gli utenti possono essere iscritti manualmente, sia tramite un link nella Amministrazione del corso, sia da parte di un utente in possesso dei privilegi necessari, come ad esempio un docente.';
$string['statusdisabled'] = 'Disabilitato';
$string['statusenabled'] = 'Abilitato';
$string['unenrol'] = 'Cancella iscrizione utente';
$string['unenrolselectedusers'] = 'Cancella iscrizioni degli utenti selezionti';
$string['unenrolselfconfirm'] = 'Sei sicuro di volerti disiscrivere dal corso "{$a}"?';
$string['unenroluser'] = 'Sei sicuro di rimuovere l\'iscrizione dell\'utente "{$a->user}" dal corso "{$a->course}"?';
$string['unenrolusers'] = 'Disiscrivi utenti';
$string['wscannotenrol'] = 'L\'istanza di plugin non può iscrivere manualmente un utente nel corso id = {$a->courseid}';
$string['wsnoinstance'] = 'L\'istanza del plugin iscrizione manuale non esiste oppure è disabilitata nel corso (id = {$a->courseid})';
$string['wsusercannotassign'] = 'Non hai il privilegio di assegnare il ruolo ({$a->roleid}) all\'utente ({$a->userid}) nel corso ({$a->courseid}).';
