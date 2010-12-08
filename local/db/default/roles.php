<?php

    /// Bootstrap custom roles and change sort order of both custom and legacy roles
        $roles = array(
            'guest' => array(
                'name'        => 'Guest',
                'description' => 'Guests have minimal privileges and usually can not enter text anywhere.',
                'legacy'      => 'guest',
                'sortorder'   => '9',
            ),
            'user' => array(
                'name'        => 'Authenticated User',
                'description' => 'All logged in users.',
                'legacy'      => 'user',
                'sortorder'   => '8',
            ),
            'learner' => array(
                'name'        => 'Learner',
                'description' => 'User acquiring knowledge, comprehension, or mastery through learning',
                'legacy'      => 'student',
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
        foreach ($roles as $shortname => $roledata) {
            if (array_key_exists('legacy', $roledata)) {
                if ($oldrole = get_record_select('role', "shortname='".$roledata['legacy']."'")) {
                    $oldrole->name        = $roledata['name'];
                    $oldrole->description = $roledata['description'];
                    $oldrole->sortorder   = $roledata['sortorder'];
                    update_record('role', $oldrole);
                }
            } else {
                $roledata['shortname'] = $shortname;
                $roledata['legacy'] = '';
                insert_record('role', $roledata);
            }
            $oldrole = get_record_select('role', "name='".$roledata['name']."'");
        }

