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
 * Strings for component 'qtype_randomsamatch', language 'fr', branch 'MOODLE_22_STABLE'
 *
 * @package   qtype_randomsamatch
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addingrandomsamatch'] = 'Ajout d\'une question d\'appariement aléatoire';
$string['editingrandomsamatch'] = 'Modification d\'une question d\'appariement aléatoire';
$string['nosaincategory'] = 'Il n\'y a pas de questions à réponse courte dans la catégorie choisie « {$a->catname} ». Veuillez choisir une autre catégorie ou créer plus de questions dans cette catégorie.';
$string['notenoughsaincategory'] = 'Il n\'y a que {$a->nosaquestions} question(s) à réponse courte dans la catégorie choisie « {$a->catname} ». Veuillez choisir une autre catégorie, créer plus de questions dans cette catégorie ou réduire le nombre choisi de questions.';
$string['randomsamatch'] = 'Appariement aléatoire';
$string['randomsamatch_help'] = 'Du point de vue du participant, la question ressemblera à une question d\'appariement. La différence est que la liste des noms ou des questions est remplie en tirant aléatoirement parmi les questions à réponse courte de la catégorie actuelle. Il doit y avoir un nombre suffisant de questions à réponse courte restant dans la catégorie, ou un message d\'erreur s\'affichera.';
$string['randomsamatchsummary'] = 'Similaire à une question d\'appariement, mais créée aléatoirement à partir de questions à réponses courtes d\'une catégorie particulière.';
