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
 * Strings for component 'tool_bloglevelupgrade', language 'fi', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_bloglevelupgrade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bloglevelupgradedescription'] = '<p>Tämä sivusto on äskettäin päivitetty Moodle-versioon 2.0.</p> <p>Blogin näkyvyyttä yksinkertaistettiin 2.0:ssa, mutta sivustosi käyttää yhä yhtä vanhoista näkyvyystyypeistä. </p> <p>Säilyttääksesi kurssipohjaisen tai ryhmäpohjaisen näkyvyyden sivustosi blogikirjoituksissa, sinun tulee ajaa seuraava päivitysskripti, joka luo erityisen "blogi" -tyypin keskustelualueen joka kurssille, jonka rekisteröityneillä käyttäjillä on blogikirjoituksia, ja kopioi nämä blogimerkinnät tälle keskustelualueelle. </p> <p>Tämän jälkeen blogit otetaan sivustolla kokonaan pois käytöstä. Prosessin aikana ei poisteta blogimerkintöjä.</p> <p>Voit ajaa skriptin vierailemalla <a href="{$a->fixurl}">blogin päivityssivulla</a>.</p>';
$string['bloglevelupgradeinfo'] = 'Blogin näkyvyyttä yksinkertaistettiin 2.0:ssa, mutta sivustosi käyttää yhä yhtä vanhoista näkyvyystyypeistä. Säilyttääksesi kurssipohjaisen tai ryhmäpohjaisen näkyvyyden sivustosi blogikirjoituksissa,seuraava päivitysskripti luo erityisen "blogi" -tyypin keskustelualueen joka kurssille, jonka rekisteröityneillä käyttäjillä on blogikirjoituksia, ja kopioi nämä blogimerkinnät tälle keskustelualueelle. Tämän jälkeen blogit otetaan sivustolla kokonaan pois käytöstä. Prosessin aikana ei poisteta blogimerkintöjä.';
$string['bloglevelupgradeprogress'] = 'Muunnoksen edistyminen: {$a->userscount} käyttäjää tarkasteltu, {$a->blogcount} merkintää muunnettu.';
$string['pluginname'] = 'Blogin näkyvyyden päivitys';
