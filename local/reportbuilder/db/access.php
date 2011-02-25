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
 * @subpackage reportbuilder 
 */

/**
* Capability definitions for the reportbuilder module.
*
* The capabilities are loaded into the database table when the module is
* installed or updated. Whenever the capability definitions are updated,
* the module version number should be bumped up.
*
* The system has four possible values for a capability:
* CAP_ALLOW, CAP_PREVENT, CAP_PROHIBIT, and inherit (not set).
*
*
* CAPABILITY NAMING CONVENTION
*
* It is important that capability names are unique. The naming convention
* for capabilities that are specific to modules and blocks is as follows:
*   [mod/block]/<component_name>:<capabilityname>
*
* component_name should be the same as the directory name of the mod or block.
*
* For local modules the naming convention is:
*   local/<component_name>:<capabilityname>
*
* Core moodle capabilities are defined thus:
*    moodle/<capabilityclass>:<capabilityname>
*
* Examples: mod/forum:viewpost
*           block/recent_activity:view
*           moodle/site:deleteuser
*
* The variable name for the capability definitions array follows the format
*   $<componenttype>_<component_name>_capabilities
*
* For the core capabilities, the variable is $moodle_capabilities.
*
* For local modules, the variable is $capabilities in 2.0 and
* $local_<component_name>_capabilities in 1.9.
*/

$capabilities = array(

// Ability to create, edit and delete report builder reports view
// the report builder administrative pages
'local/reportbuilder:managereports' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS | RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW
        )
    ),

);

// add this to make it 1.9 compatible
$local_reportbuilder_capabilities = $capabilities;
?>
