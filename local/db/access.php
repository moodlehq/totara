<?php
/**
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    moodle
 * @subpackage local
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * Capability definitions for the Moodle Industry Training Management System.
 *
 * The capabilities are loaded into the database table when the module is
 * installed or updated. Whenever the capability definitions are updated,
 * the module version number should be bumped up.
 *
 * The system has four possible values for a capability:
 * CAP_ALLOW, CAP_PREVENT, CAP_PROHIBIT, and inherit (not set).
*/

$local_capabilities = array(

    // viewing and managing a competency
    'moodle/local:viewcompetency' => array(
        'riskbitmask' => RISK_PERSONAL,
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createcompetency' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatecompetency' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletecompetency' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createcompetencydepth' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatecompetencydepth' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletecompetencydepth' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createcompetencyframeworks' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatecompetencyframeworks' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletecompetencyframeworks' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createcompetencytemplate' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatecompetencytemplate' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletecompetencytemplate' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createcompetencycustomfield' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatecompetencycustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletecompetencycustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // viewing and managing positions
    'moodle/local:viewposition' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:createposition' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:updateposition' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:deleteposition' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:createpositiondepth' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatepositiondepth' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletepositiondepth' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createpositionframeworks' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatepositionframeworks' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletepositionframeworks' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createpositioncustomfield' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatepositioncustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletepositioncustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // viewing and managing organisations
    'moodle/local:vieworganisation' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:createorganisation' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:updateorganisation' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:deleteorganisation' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:createorganisationdepth' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updateorganisationdepth' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deleteorganisationdepth' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createorganisationframeworks' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updateorganisationframeworks' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deleteorganisationframeworks' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createorganisationcustomfield' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updateorganisationcustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deleteorganisationcustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Ability for administrators to change the module settings
    'moodle/local:admin' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Ability for managers to receive notification emails.
    // used by lplan_email_notification
    'moodle/local:receivenotification' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
    ),

    // Assign a position to yourself
    'moodle/local:assignselfposition' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
    ),

    // Assign a position to a user
    'moodle/local:assignuserposition' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Mark another user complete in course completion
    'moodle/local:markcomplete' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_COURSE,
        'legacy' => array(
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'coursecreator' => CAP_ALLOW,
            'admin' => CAP_ALLOW
        )
    ),

    // Managing course custom fields
    'moodle/local:createcoursecustomfield' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatecoursecustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletecoursecustomfield' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
);
