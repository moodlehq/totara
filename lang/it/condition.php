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
 * Strings for component 'condition', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   condition
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcompletions'] = 'Aggiungi {no} condizioni sulle attività';
$string['addgrades'] = 'Aggiungi {no} condizioni sulle valutazioni';
$string['availabilityconditions'] = 'Condizioni per l\'accesso';
$string['availablefrom'] = 'Disponibile dal';
$string['availablefrom_help'] = 'Le date di disponibilità stabiliscono quando uno studente può accedere all\'attività tramite il link nella home page del corso
La differenza tra le date di disponibilità e la visibilità consistono nel fatto che al di fuori delle date di disponibilità, tramite l\'impostazione di visibilità lo studente può vedere la descrizione dell\'attività mentre le date di disponibilità impediscono del tutto l\'accesso all\'attività';
$string['availableuntil'] = 'Disponibile fino al';
$string['badavailabledates'] = 'Date non valide. Se imposti entrambe le date, la data "Disponibile dal" deve essere anteriore alla data "Disponibile fino al".';
$string['badgradelimits'] = 'Se imposti sia il valore  massimo sia il valore minimo della valutazione, il valore massimo deve essere superiore al minimo.';
$string['completion_complete'] = 'deve risultare completata';
$string['completion_fail'] = 'deve risultare completata senza la sufficienza';
$string['completion_incomplete'] = 'deve risultare non completata';
$string['completion_pass'] = 'deve risultare completata con la sufficienza';
$string['completioncondition'] = 'Stato dell\'attività';
$string['completioncondition_help'] = 'E\' possibile definire condizioni per l\'accesso all\'attività basate sullo stato di completamento di altre attività. Per usare questa impostazione il tracciamento del completamento delle attività deve essere attivo.
E\' possibile aggiungere altre condizioni oltre la prima. L\'attività diverrà disponibile quando tutte le condizioni saranno state soddisfatte.';
$string['configenableavailability'] = 'La disponibilità condizionata consente di definire i criteri (basati su valutazione, date, completamento) per l\'accesso alle attività e alle risorse.';
$string['enableavailability'] = 'Abilita disponibilità condizionata';
$string['grade_atleast'] = 'deve essere almeno';
$string['grade_upto'] = 'e minore di';
$string['gradecondition'] = 'Valutazione da ottenere';
$string['gradecondition_help'] = 'L\'impostazione permette di definire il punteggio da ottenere prima di rendere disponibile l\'attività.
E\' possibile aggiungere altre condizioni oltre la prima. L\'attività diverrà disponibile quando tutte le condizioni saranno state soddisfatte.';
$string['gradeitembutnolimits'] = 'Devi inserire un valore massimo, minimo o entrambi.';
$string['gradelimitsbutnoitem'] = 'Devi scegliere un elemento di valutazione.';
$string['gradesmustbenumeric'] = 'I valori massimo e minimo della valutazione devono essere numerici (o lasciati vuoti).';
$string['none'] = '(nessuno)';
$string['notavailableyet'] = 'Non ancora disponibile';
$string['requires_completion_0'] = 'Disponibile se l\'attività <strong>{$a}</strong> risulta non completata.';
$string['requires_completion_1'] = 'Disponibile dopo il completamento dell\'attività <strong>{$a}</strong>.';
$string['requires_completion_2'] = 'Disponibile dopo il completamento dell\'attività <strong>{$a}</strong> con un voto sufficiente.';
$string['requires_completion_3'] = 'Disponibile dopo il completamento dell\'attività <strong>{$a}</strong> con un voto insufficiente.';
$string['requires_date'] = 'Disponibile a partire da {$a}';
$string['requires_date_before'] = 'Disponibile fino al {$a}';
$string['requires_date_both'] = 'Disponibile dal {$a->from} fino al {$a->until}.';
$string['requires_date_both_single_day'] = 'Disponibile da {$a}.';
$string['requires_grade_any'] = 'Disponibile dopo aver ottenuto una valutazione in <strong>{$a}</strong>.';
$string['requires_grade_max'] = 'Disponibile dopo aver ottenuto un voto adeguato in <strong>{$a}</strong>.';
$string['requires_grade_min'] = 'Disponibile dopo aver ottenuto il voto richiesto in <strong>{$a}</strong>.';
$string['requires_grade_range'] = 'Disponibile dopo aver ottenuto uno specifico voto in <strong>{$a}</strong>.';
$string['showavailability'] = 'Fino a quando l\'attività non è disponibile';
$string['showavailability_hide'] = 'Non visualizzare il titolo';
$string['showavailability_show'] = 'Visualizza il titolo non attivo e le condizioni per l\'accesso';
$string['userrestriction_hidden'] = 'Disponibilità condizionata (invisibile, senza informazioni): &lsquo;{$a}&rsquo;';
$string['userrestriction_visible'] = 'Disponibilità condizionata: &lsquo;{$a}&rsquo;';
