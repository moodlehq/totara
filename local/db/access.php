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

    // viewing and managing positions 
    'moodle/local:viewpositions' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:updatepositions' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),
    'moodle/local:deletepositions' => array(
        'captype'      => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
    ),

    // viewing and managing competencies
    'moodle/local:viewcompetencies' => array(
        'riskbitmask' => RISK_PERSONAL,
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:createcompetencies' => array(
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:updatecompetencies' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    ),
    'moodle/local:deletecompetencies' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS,
        'captype'       => 'write',
        'contextlevel'  => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW,
        ),
    )
);

?>
