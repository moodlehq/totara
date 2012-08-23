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
 * Strings for component 'enrol_meta', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   enrol_meta
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['linkedcourse'] = 'Linkitä kurssi';
$string['meta:config'] = 'Määritä meta-kirjautumis instanssit';
$string['meta:selectaslinked'] = 'Valitse kurssi meta-linkitetyksi';
$string['meta:unenrol'] = 'Peruuta estettyjen käyttäjien rekisteröinti';
$string['nosyncroleids'] = 'Roolit, joita ei synkronoida';
$string['nosyncroleids_desc'] = 'Oletuksena kaikki kurssitason roolimääritykset synkronoidaan yläkursseilta (parent) alakursseille (child). Tässä valittavia rooleja ei synkronoida. Synkronoitavat roolit päivitetään kun cron ajetaan seuraavan kerran.';
$string['pluginname'] = 'Kurssin meta-linkki';
$string['pluginname_desc'] = 'Kurssin meta-linkki kirjautumisplugin synkronoi kirjautumiset ja roolit kahdella eri kurssilla.';
$string['syncall'] = 'Synkronoi kaikki rekisteröityneet käyttäjät';
$string['syncall_desc'] = 'Jos sallittu, kaikki rekisteröityneet käyttäjät synkronoidaan vaikka heillä ei olisikaan roolia pääkurssilla. Jos poistetaan käytöstä, ainoastaan käyttäjät joilla on vähintään yksi rooli, synkronoidaan alakurssille.';
