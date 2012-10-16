<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010 - 2012 Totara Learning Solutions LTD
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
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
 * @author Ciaran Irvine <ciaran@catalyst.net.nz>
 * @package totara
 * @subpackage hierarchy
 */

/*
 * The capabilities are loaded into the database table when the module is
 * installed or updated. Whenever the capability definitions are updated,
 * the module version number should be bumped up.
 *
 * The system has four possible values for a capability:
 * CAP_ALLOW, CAP_PREVENT, CAP_PROHIBIT, and inherit (not set).
 */

$capabilities = array(

        // viewing and managing a competency
        'totara/hierarchy:viewcompetency' => array(
            'riskbitmask' => RISK_PERSONAL,
            'captype' => 'read',
            'contextlevel' => CONTEXT_SYSTEM,
            'archetypes' => array(
                'manager' => CAP_ALLOW,
                'student' => CAP_ALLOW,
                'user' => CAP_ALLOW
                ),
            ),
        'totara/hierarchy:createcompetency' => array(
            'captype'       => 'write',
            'contextlevel'  => CONTEXT_SYSTEM,
            'archetypes' => array(
                'manager' => CAP_ALLOW
                ),
            ),
        'totara/hierarchy:updatecompetency' => array(
            'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
            'captype'       => 'write',
            'contextlevel'  => CONTEXT_SYSTEM,
            'archetypes' => array(
                'manager' => CAP_ALLOW
                ),
            ),
        'totara/hierarchy:deletecompetency' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createcompetencytype' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updatecompetencytype' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deletecompetencytype' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createcompetencyframeworks' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updatecompetencyframeworks' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deletecompetencyframeworks' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createcompetencytemplate' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updatecompetencytemplate' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deletecompetencytemplate' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createcompetencycustomfield' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updatecompetencycustomfield' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deletecompetencycustomfield' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),

        // viewing and managing positions
        'totara/hierarchy:viewposition' => array(
                'riskbitmask' => RISK_PERSONAL,
                'captype'      => 'read',
                'contextlevel' => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW,
                    'student' => CAP_ALLOW,
                    'user' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createposition' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updateposition' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deleteposition' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createpositiontype' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updatepositiontype' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deletepositiontype' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createpositionframeworks' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updatepositionframeworks' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deletepositionframeworks' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createpositioncustomfield' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updatepositioncustomfield' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deletepositioncustomfield' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),

        // viewing and managing organisations
        'totara/hierarchy:vieworganisation' => array(
                'riskbitmask' => RISK_PERSONAL,
                'captype'      => 'read',
                'contextlevel' => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW,
                    'student' => CAP_ALLOW,
                    'user' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createorganisation' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updateorganisation' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deleteorganisation' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createorganisationtype' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updateorganisationtype' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deleteorganisationtype' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createorganisationframeworks' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updateorganisationframeworks' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deleteorganisationframeworks' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:createorganisationcustomfield' => array(
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:updateorganisationcustomfield' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),
        'totara/hierarchy:deleteorganisationcustomfield' => array(
                'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
                'captype'       => 'write',
                'contextlevel'  => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                ),

        // Assign a position to yourself
        'totara/hierarchy:assignselfposition' => array(
                'captype' => 'write',
                'contextlevel' => CONTEXT_SYSTEM,
                ),

        // Assign a position to a user
        'totara/hierarchy:assignuserposition' => array(
                'captype' => 'write',
                'contextlevel' => CONTEXT_SYSTEM,
                'archetypes' => array(
                    'manager' => CAP_ALLOW
                    ),
                )
        );
