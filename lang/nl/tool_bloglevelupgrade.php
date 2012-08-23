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
 * Strings for component 'tool_bloglevelupgrade', language 'nl', branch 'MOODLE_22_STABLE'
 *
 * @package   tool_bloglevelupgrade
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bloglevelupgradedescription'] = '<p>Deze site is pas geüpgraded naar Moodle 2.0.</p>
<p>De zichtbaarheid van blogs is vereenvoudigd in 2.0, maar jouw site gebruikt nog de oude zichtbaarheidstypes.</p>
<p>Om de cursusgebaseerde of groepsgebaseerde zichtbaarheid van blogberichten te bewaren, moet je volgend upgradescript laten lopen, wat een speciaal forumtype "blog" zal creëren in de cursussen waar aangemelde gebruikers blogs hebben gemaakt en zal deze blogs naar dit speciale forum kopiëren.</p>
<p>Blogs zullen dan volledig uitgeschakeld worden op site niveau. Er zullen geen blogberichten verwijderd worden tijdens het proces.</p>
<p>Je kunt het script starten door <a href="{$a->fixurl}">de blog upgradepagina</a> te bezoeken.</p>';
$string['bloglevelupgradeinfo'] = 'De zichtbaarheid van blogs is vereenvoudigd in Moodle 2.0. Om de cursusgebaseerde of groepsgebaseerde zichtbaarheid van blogberichten te bewaren, zal een upgradescript een speciaal forumtype "blog" creëren in de cursussen waar aangemelde gebruikers blogs hebben gemaakt en zal deze blogs naar dit speciale forum kopiëren. Blogs zullen dan volledig uitgeschakeld worden op site niveau. Er zullen geen blogberichten verwijderd worden tijdens het proces.';
$string['bloglevelupgradeprogress'] = 'Vooruitgang conversie: {$a->userscount} gebruikers nagekeken, {$a->blogcount} items geconverteerd';
$string['pluginname'] = 'Zichtbaarheid blogs upgrade';
