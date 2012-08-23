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
 * Strings for component 'gradingform_rubric', language 'hu', branch 'MOODLE_22_STABLE'
 *
 * @package   gradingform_rubric
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcriterion'] = 'Feltétel hozzáadása';
$string['alwaysshowdefinition'] = 'A felhasználók számára engedélyezi a modulban használt rubrika előzetes megtekintését (ellenkező esetben csak pontozás után lesz látható).';
$string['backtoediting'] = 'Vissza a szerkesztéshez';
$string['confirmdeletecriterion'] = 'Biztosan törölni kívánja ezt a feltételt?';
$string['confirmdeletelevel'] = 'Biztosan törölni kívánja ezt a szintet';
$string['criterionaddlevel'] = 'Szint hozzáadása';
$string['criteriondelete'] = 'Feltétel törlése';
$string['criterionempty'] = 'Kattintson a feltétel szerkesztéséhez';
$string['criterionmovedown'] = 'Mozgatás lefelé';
$string['criterionmoveup'] = 'Mozgatás fölfelé';
$string['definerubric'] = 'Rubrika meghatározása';
$string['description'] = 'Leírás';
$string['enableremarks'] = 'A pontozó számára szöveges megjegyzések feltételekhez való hozzáadásának engedélyezése';
$string['err_mintwolevels'] = 'Minden feltételhez legalább két szint tartozik';
$string['err_nocriteria'] = 'A rubrikában legalább egy feltételt meg kell adni';
$string['err_nodefinition'] = 'A szintdefiníció nem lehet üres.';
$string['err_nodescription'] = 'A szintdefiníció nem lehet üres.';
$string['err_scoreformat'] = 'Az egyes szintekhez tartozó pontoknak érvényes nem negatív számoknak kell lenni';
$string['err_totalscore'] = 'A rubrikához tartozó maximális pontszámnak pontozás esetén 0-nál nagyobbnak kell lenni.';
$string['gradingof'] = '{$a} pontozás';
$string['leveldelete'] = 'Szint törlése';
$string['levelempty'] = 'Kattintson a szint szerkesztéséhez';
$string['name'] = 'Név';
$string['needregrademessage'] = 'A rubrika definíciója a tanuló pontozása után módosult. A tanuló a rubrikát mindaddig nem látja, amíg Ön a rubrikát nem ellenőrzi és az osztályzatot nem frissíti.';
$string['pluginname'] = 'Rubrika';
$string['previewrubric'] = 'Rubrika előzetes megtekintése';
$string['regrademessage1'] = 'Olyan rubrika módosítását készül menteni, amelyet már pontozásra használtak. Jelezze, hogy a meglévő pontokat ellenőrizni kell-e. Ez esetben a rubrika a tanulók elől újrapontozásig rejtve marad.';
$string['regrademessage5'] = 'Olyan rubrika lényeges módosítását készül menteni, amelyet már pontozásra használtak. Az osztályozónapló értéke nem változik, de a rubrika a tanulók elől újrapontozásig rejtve marad.';
$string['regradeoption0'] = 'Újrapontozásból kihagy';
$string['regradeoption1'] = 'Újrapontozásra megjelöl';
$string['restoredfromdraft'] = 'MEGJEGYZÉS: az adott személy utolsó pontozási próbálkozásának mentése nem sikerült, ezért visszaálltak a próbapontok. Ha törölni kívánja a módosításokat, használja az alábbi \'Mégse\' gombot.';
$string['rubric'] = 'Rubrika';
$string['rubricmapping'] = 'Pontszám szerinti pontozás illesztési szabályai';
$string['rubricmappingexplained'] = 'A rubrikához tartozó legkisebb lehetséges pontszám <b>{$a->minscore}</b>, mely átalakul a modulban elérhető minimális eredménnyé (ami a skála használata kivételével nulla). A  legmagasabb <b>{$a->maxscore} pontszám</b> maximális eredménnyé alakul át. <br /> A köztes pontszámok kerekítés után a legközelebbi elérhető osztályzattá alakulnak át.<br />Osztályzat helyett skálát használva a pontszámok skálaelemmé alakulnak át, mintha egymást követő egész számok lennének.';
$string['rubricnotcompleted'] = 'Mindegyik feltételhez válasszon valamit.';
$string['rubricoptions'] = 'Rubrika beállításai';
$string['rubricstatus'] = 'Rubrika adott állapota';
$string['save'] = 'Mentés';
$string['saverubric'] = 'Rubrika mentése és elérhetővé tétele';
$string['saverubricdraft'] = 'Mentés piszkozatként';
$string['scorepostfix'] = '{$a} pont';
$string['showdescriptionstudent'] = 'Rubrikaleírás megjelenítése a pontozandók számára';
$string['showdescriptionteacher'] = 'Rubrikaleírás megjelenítése értékelés közben';
$string['showremarksstudent'] = 'Megjegyzések megjelenítése a pontozandók számára';
$string['showscorestudent'] = 'Pontok szintenkénti megjelenítése a pontozandók számára';
$string['showscoreteacher'] = 'Pontok szintenkénti megjelenítése értékelés közben';
$string['sortlevelsasc'] = 'Szintenkénti rendezés';
$string['sortlevelsasc0'] = 'Csökkenő pontok szerint';
$string['sortlevelsasc1'] = 'Növekvő pontok szerint';
