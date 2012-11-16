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
 * Strings for component 'rating', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   rating
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aggregateavg'] = 'Értékelések átlaga';
$string['aggregatecount'] = 'Értékelések száma';
$string['aggregatemax'] = 'Maximális értékelés';
$string['aggregatemin'] = 'Minimális értékelés';
$string['aggregatenone'] = 'Nincs értékelés';
$string['aggregatesum'] = 'Értékelések összege';
$string['aggregatetype'] = 'Összegző típus';
$string['aggregatetype_help'] = 'Az összegző típus azt szabja meg, hogy az értékelések milyen kombinációban alakítják ki az osztályozónaplóban a végső osztályzatot.
* Értékelések átlaga - Az összes értékelés számtani közepe
* Értékelések száma - Az értékelt elemek száma lesz a végső osztályzat. A végösszeg nem lehet magasabb, mint a tevékenységre adható maximális pontszám.
* Maximum - A legmagasabb értékelés lesz a végső osztályzat.
* Minimum - A legalacsonyabb értékelés lesz a végső osztályzat.
* Összeg - Az összes értékelés összeadódik. A végösszeg nem lehet magasabb, mint a tevékenységre adható maximális pontszám.
Ha a "Nincs értékelés" van kiválasztva, akkor a tevékenység nem fog megjelenni az osztályozónaplóban.';
$string['allowratings'] = 'Értékelhetők legyenek az elemek?';
$string['allratingsforitem'] = 'Minden leadott értékelés';
$string['capabilitychecknotavailable'] = 'Az engedély ellenőrzése csak a tevékenység mentése után lehetséges.';
$string['couldnotdeleteratings'] = 'Nem törölhető, mert már megtörtént az értékelése.';
$string['norate'] = 'Az elemek nem értékelhetők!';
$string['noratings'] = 'Nincs leadott értékelés';
$string['noviewanyrate'] = 'Csak a saját elemeihez tartozó eredményeket tekintheti meg';
$string['noviewrate'] = 'Ön nem jogosult az elemértékelés megtekintésére.';
$string['rate'] = 'Értékel';
$string['ratepermissiondenied'] = 'Ön nem jogosult az elem értékelésére.';
$string['rating'] = 'Értékelés';
$string['ratinginvalid'] = 'Az osztályozás érvénytelen.';
$string['ratings'] = 'Értékelések';
$string['ratingtime'] = 'Értékelések korlátozása ezen intervallumon belüli elemekre:';
$string['rolewarning'] = 'Értékelési joggal felruházott szerepek';
$string['rolewarning_help'] = 'Értékelések leadásához a felhasználóknak moodle/rating:rate engedéllyel és további esetleges modulfüggő engedélyekkel kell rendelkezni. Az alábbi szerepekkel felruházott felhasználók értékelhetnek elemeket. A szerepek felsorolása a beállítási blokkban található engedélyek ugrópontján keresztül módosítható.';
