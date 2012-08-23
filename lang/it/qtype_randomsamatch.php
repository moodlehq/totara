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
 * Strings for component 'qtype_randomsamatch', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_randomsamatch
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addingrandomsamatch'] = 'Creazione Corrispondenze di domande a Risposta Breve';
$string['editingrandomsamatch'] = 'Modifica Corrispondenze di domande a Risposta Breve';
$string['nosaincategory'] = 'Non ci sono domande a risposta breve nella categoria scelta \'<b>{$a->catname}</b>\'. Scegli un\'altra categoria o inserisce qualche domanda in questa categoria.';
$string['notenoughsaincategory'] = 'Ci sono solo {$a->nosaquestions}<domande a risposta breve nella categoria "{$a->catname}". Scegli un\'altra categoria, aggiungi alcune domande in questa categoria o riduci il numero di domande.';
$string['randomsamatch'] = 'Corrispondenze con domande a Risposta Breve';
$string['randomsamatch_help'] = 'Dal punto di vista dello studente, la domanda è come la domanda a corrispondenza. La differenza consiste nel fatto che l\'elenco dei nomo o delle affermazioni (domande) per la corrispondenza sono prese in modo random dalle domande a risposta breve presenti nella categoria di domande in uso. Devono essere disponibili un numero sufficiente di domande a risposta breve non utilizzate, altrimenti verrà visualizzato un messaggio di errore.';
$string['randomsamatchsummary'] = 'Simile alla domanda Corrispondenza ma creata pescando a caso domande a Risposta breve presenti in una data categoria.';
