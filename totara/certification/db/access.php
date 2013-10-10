<?php
/*
 * This file is part of Totara LMS
 *
 * Copyright (C) 2010-2013 Totara Learning Solutions LTD
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
 * @author Jon Sharp <jon.sharp@catalyst-eu.net>
 * @package totara
 * @subpackage certification
 */

defined('MOODLE_INTERNAL') || die();

$capabilities = array(
    // View a certification.
    'totara/certification:viewcertification' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
            'user' => CAP_ALLOW,
        )
    ),
    // View hidden certifications.
    'totara/certification:viewhiddencertifications' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'coursecreator' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'manager' => CAP_ALLOW
        )
    ),
    // Access any user's certifications.
    'totara/certification:accessanycertification' => array(
        'riskbitmask' => RISK_PERSONAL,
        'captype' => 'read',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW
        )
    ),
    // Create new certifications.
    'totara/certification:createcertification' => array(
        'riskbitmask' => RISK_XSS | RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        )
    ),
    // Delete certifications.
    'totara/certification:deletecertification' => array(
        'riskbitmask' => RISK_DATALOSS |
            RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        ),
        'clonepermissionsfrom' => 'totara/certification:createcertification'
    ),
    // Ability to edit and delete certifications.
    'totara/certification:configurecertification' => array(
        'riskbitmask' => RISK_DATALOSS | RISK_XSS |
            RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        )
    ),
    // Ability to edit the certification details tab.
    'totara/certification:configuredetails' => array(
        'riskbitmask' => RISK_DATALOSS | RISK_XSS |
            RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        ),
        'clonepermissionsfrom' => 'totara/certification:configurecertification'
    ),
    // Ability to add and remove certification content and configure the flow of content.
    'totara/certification:configurecontent' => array(
        'riskbitmask' => RISK_DATALOSS |
            RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        )
    ),
    // Ability to add and remove certification recertificationdetails.
    'totara/certification:configurerecertificationdetails' => array(
        'riskbitmask' => RISK_DATALOSS |
            RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        )
    ),
    // Ability to add and remove certification messages.
    'totara/certification:configuremessages' => array(
        'riskbitmask' => RISK_DATALOSS |
            RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        )
    ),
    // Ability to view exception reports and handle exceptions.
    'totara/certification:handleexceptions' => array(
        'riskbitmask' => RISK_DATALOSS |
            RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_PROGRAM,
        'archetypes' => array(
            'manager' => CAP_ALLOW,
        )
    ),
);
