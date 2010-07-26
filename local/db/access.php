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

  // Capability definitions for the lplan module
    // Ability for users to view their own plans
    'moodle/local:idpviewownplan' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        ),
    ),

    // Ability for users to edit their own plans
    'moodle/local:idpeditownplan' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        ),
    ),

    // Ability for managers to view a user's plan
    'moodle/local:idpviewplan' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
    ),

    // Ability for users to view the comments on their own plans
    'moodle/local:idpviewowncomment' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        ),
    ),

    // Ability for users to comment on their own plans
    'moodle/local:idpaddowncomment' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        ),
    ),

    // Ability for managers to view a user's plan comments
    'moodle/local:idpviewcomment' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
    ),

    // Ability for managers to comment on a user's plan
    'moodle/local:idpaddcomment' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
    ),

    //Ability for managers to set users current IDP
    'moodle/local:idpsetcurrent' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER
    ),

    //Ability for managers to evaluate a users IDP
    'moodle/local:idpuserevaluate' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER
    ),

    // Ability for users to submit their own plans for approval
    'moodle/local:idpsubmitownplan' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        ),
    ),

    // Ability for managers to approve a specific user's plan
    'moodle/local:idpapproveplan' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Ability for managers to approve a specific user's plan on
    // behalf of someone else who has approval rights for that user
    'moodle/local:idpapproveplanonbehalf' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_USER,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Ability for users to view their own list of plans
    'moodle/local:idpviewownlist' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        ),
    ),

    // Ability for managers to view the list of a user's plan
    'moodle/local:idpviewlist' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
    ),

    // Ability for managers to look at their own overview page
    'moodle/local:idpmanagerownoverview' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Ability to look at managers overview pages
    'moodle/local:idpmanageroverview' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
    ),

    // Ability for trainees to look at their own overview page
    'moodle/local:idptraineeownoverview' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Ability for managers to look at a trainee's overview page
    'moodle/local:idptraineeoverview' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
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

    // Ability for local administrators to view reports for staff in their region
    'moodle/local:viewlocalreports' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'riskbitmask' => RISK_PERSONAL,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),

    // Ability for staff to view reports for their subordinates
    'moodle/local:viewstaffreports' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'riskbitmask' => RISK_PERSONAL,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
        ),
    ),

    // Ability for staff to view their own reports
    'moodle/local:viewownreports' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'riskbitmask' => RISK_PERSONAL,
        'legacy' => array(
            'admin' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'student' => CAP_ALLOW,
        ),
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

    // Ability for a user to view any report builder reports
    'moodle/local:viewallreports' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_USER,
        'riskbitmask' => RISK_PERSONAL,
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

    // Add a competency to an IDP
    'moodle/local:idpaddcompetency' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'user' => CAP_ALLOW
        )
    ),

    // Add a competency template to an IDP
    'moodle/local:idpaddcompetencytemplate' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'user' => CAP_ALLOW
        )
    ),

    // Add a competency to an IDP from position
    'moodle/local:idpaddcompetencyfrompos' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'user' => CAP_ALLOW
        )
    ),

    // Add a competency template to an IDP from position
    'moodle/local:idpaddcompetencytemplatefrompos' => array(
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'user' => CAP_ALLOW
        )
    ),
);
