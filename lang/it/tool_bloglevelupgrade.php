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
 * Strings for component 'tool_bloglevelupgrade', language 'it', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_bloglevelupgrade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bloglevelupgradedescription'] = '<p>Il sito è stato da poco aggiornato a Moodle 2.0.</p>
<p>In Moodle 2.0 la visibilità dei Blog è stata semplificata, tuttavia il tuo sito sta ancora utilizzando le impostazioni di visibilità Blog precedenti.</p>
<p>Per conservare la visibilità dei blog per corso e per gruppo, devi lanciare lo script di aggiornamento che creerà un forum di tipo "blog" in tutti i corsi dove gli iscritti hanno inserito post di blog, copiandoci poi gli interventi. </p>
<p>I Blog verranno poi disattivati a livello di sito. Nessun intervento verrà eliminato durante l\'elaborazione dello script.</p>
<p>Puoi lanciare lo script  accedendo alla <a href="{$a->fixurl}">pagina di aggiornamento Blog</a>.</p>';
$string['bloglevelupgradeinfo'] = 'In Moodle 2.0 la visibilità dei Blog è stata semplificata, tuttavia il tuo sito sta ancora utilizzando le impostazioni di visibilità Blog precedenti. Per conservare la visibilità dei blog per corso e per gruppo, devi lanciare lo script di aggiornamento che creerà un forum di tipo "blog" in tutti i corsi dove gli iscritti hanno inserito post di blog, copiandoci poi gli interventi.I Blog verranno poi disattivati a livello di sito. Nessun intervento verrà eliminato durante l\'elaborazione dello script.';
$string['bloglevelupgradeprogress'] = 'Stato avanzamento della conversione: analizzati {$a->userscount} utenti, convertiti {$a->blogcount} interventi.';
$string['pluginname'] = 'Aggiornamento Visibilità del Blog';
