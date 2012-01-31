<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010, 2011 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Simon Coggins <simonc@catalyst.net.nz>
 * @package totara
 * @subpackage local
 */

    /// Bootstrap custom roles and change sort order of both custom and legacy roles
        $roles = array(
            'guest' => array(
                'name'        => 'Guest',
                'description' => 'Guests have minimal privileges and usually can not enter text anywhere.',
                'legacy'      => 'guest',
                'sortorder'   => '10',
            ),
            'user' => array(
                'name'        => 'Authenticated User',
                'description' => 'All logged in users.',
                'legacy'      => 'user',
                'sortorder'   => '9',
            ),
            'learner' => array(
                'name'        => 'Learner',
                'description' => 'User acquiring knowledge, comprehension, or mastery through learning',
                'legacy'      => 'student',
                'sortorder'   => '8',
            ),
            'assessor' => array(
                'name'        => 'Assessor',
                'description' => 'User tasked with assessing the performance of a learner',
                'sortorder'   => '7',
            ),
            'manager' => array(
                'name'        => 'Manager',
                'description' => 'User tasked with managing the performance of a learner or team',
                'legacy'      => 'manager',
                'sortorder'   => '6',
            ),
            'regionalmananger' => array(
                'name'        => 'Regional Manager',
                'description' => 'User who is responsible for the performance of a region and has access to regional reports',
                'sortorder'   => '5',
            ),
            'noneditingtrainer' => array(
                'name'        => 'Trainer',
                'description' => 'Responsible for delivering training of learners, but may not alter activities.',
                'legacy'      => 'teacher',
                'sortorder'   => '4',
            ),
            'trainer' => array(
                'name'        => 'Editing Trainer',
                'description' => 'Responsible for delivering training of learners, and can alter activities',
                'legacy'      => 'editingteacher',
                'sortorder'   => '3',
            ),
            'regionaltrainer' => array(
                'name'        => 'Regional Trainer',
                'description' => 'User who oversees the delivery of training within a region',
                'sortorder'   => '2',
            ),
        );
        $counter = 100;
        foreach ($roles as $shortname => $roledata) {
            if (array_key_exists('legacy', $roledata) &&
               $oldrole = get_record_select('role', "shortname='".$roledata['legacy']."'")) {
                    $oldrole->name        = $roledata['name'];
                    $oldrole->description = $roledata['description'];
                    update_record('role', $oldrole);
            } else {
                $roledata['shortname'] = $shortname;
                $roledata['legacy'] = '';
                $roledata['sortorder'] = $counter++;
                insert_record('role', (object) $roledata);
            }
            $oldrole = get_record_select('role', "name='".$roledata['name']."'");
        }

