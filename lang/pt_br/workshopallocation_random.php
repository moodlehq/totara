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
 * Strings for component 'workshopallocation_random', language 'pt_br', branch 'MOODLE_22_STABLE'
 *
 * @package   workshopallocation_random
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addselfassessment'] = 'Adicionar auto-avaliações';
$string['allocationaddeddetail'] = 'Nova avaliação a ser realizada: <strong> {$a->reviewername} </strong> é crítico de <strong>{$a->authorname}</strong>';
$string['allocationdeallocategraded'] = 'Impossível desalocar avaliação já avaliada: crítico <strong>{$a->reviewername}</strong>, autor do envio: <strong>{$a->authorname}</strong>';
$string['allocationreuseddetail'] = 'Avaliação reutilizada: <strong>{$a->reviewername}</strong> tido como crítico de <strong>{$a->authorname}</strong>';
$string['allocationsettings'] = 'Configurações da alocação';
$string['assessmentdeleteddetail'] = 'Avaliação desalocada: <strong>{$a->reviewername}</strong> não é mais p crítico de <strong>{$a->authorname}</strong>';
$string['assesswosubmission'] = 'Participantes podem avaliar sem ter enviado nada';
$string['confignumofreviews'] = 'Número padrão de envios a ser alocado aleatoriamente';
$string['excludesamegroup'] = 'Evitar revisões por pares do mesmo grupo';
$string['noallocationtoadd'] = 'Nenhuma alocação para adicionar';
$string['nogroupusers'] = 'Aviso <p>: Se o workshop for configurado modo  \'grupos visíveis\' ou no modo "grupos separados", então os usuários DEVEM fazer parte de pelo menos um grupo a receber avaliações de pares que lhes são atribuídas por esta ferramenta. Uusuários sem grupo ainda podem receber novas auto-avaliações ou suas avaliações existentes podem ser removidas </ p> <p Esses usuários não estão alocados em um grupo: {$ A} </ p>';
$string['numofdeallocatedassessment'] = 'Desalocando {$a} avaliações';
$string['numofrandomlyallocatedsubmissions'] = 'Alocando aleatoriamente {$a} envios';
$string['numofreviews'] = 'Número de críticos';
$string['numofselfallocatedsubmissions'] = 'Auto-alocando {$a} envio(s)';
$string['numperauthor'] = 'por envio';
$string['numperreviewer'] = 'por crítico';
$string['pluginname'] = 'Alocação aleatória';
$string['randomallocationdone'] = 'Alocação aleatória concluída';
$string['removecurrentallocations'] = 'Remover atuais alocações';
$string['resultnomorepeers'] = 'Não existem mais pares disponíveis';
$string['resultnomorepeersingroup'] = 'Não existem mais pares disponíveis neste grupo separado';
$string['resultnotenoughpeers'] = 'Não existem pares suficientes disponíveis';
$string['resultnumperauthor'] = 'Tentando alocar {$a} revisores por autor';
$string['resultnumperreviewer'] = 'Tentando alocar {$a} revisores por revisor';
$string['stats'] = 'Estatísticas da alocação atual';
