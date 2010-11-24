<?php
//
// Capability definitions for the dashboard module.
//
// The capabilities are loaded into the database table when the module is
// installed or updated. Whenever the capability definitions are updated,
// the module version number should be bumped up.
//
// The system has four possible values for a capability:
// CAP_ALLOW, CAP_PREVENT, CAP_PROHIBIT, and inherit (not set).
//
//
// CAPABILITY NAMING CONVENTION
//
// It is important that capability names are unique. The naming convention
// for capabilities that are specific to modules and blocks is as follows:
//   [mod/block]/<component_name>:<capabilityname>
//
// component_name should be the same as the directory name of the mod or block.
//
// For local modules the naming convention is:
//   local/<component_name>:<capabilityname>
//
// Core moodle capabilities are defined thus:
//    moodle/<capabilityclass>:<capabilityname>
//
// Examples: mod/forum:viewpost
//           block/recent_activity:view
//           moodle/site:deleteuser
//
// The variable name for the capability definitions array follows the format
//   $<componenttype>_<component_name>_capabilities
//
// For the core capabilities, the variable is $moodle_capabilities.
//
// For local modules, the variable is $capabilities in 2.0 and
// $local_<component_name>_capabilities in 1.9.

$capabilities = array(

// Ability to administer dashboards; default dashboard layout, dashlets, etc.
'local/dashboard:admin' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS | RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW
        )
    ),

// Ability to view dashboard
'local/dashboard:view' => array(
        'captype' => 'read',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'guest' => CAP_ALLOW,
            'student' => CAP_ALLOW,
            'teacher' => CAP_ALLOW,
            'editingteacher' => CAP_ALLOW,
            'coursecreator' => CAP_ALLOW,
            'admin' => CAP_ALLOW
        )
    ),

// Ability to edit a dasboard: add/edit/move dashlets, etc.
'local/dashboard:edit' => array(
        'riskbitmask'   => RISK_PERSONAL | RISK_DATALOSS | RISK_CONFIG,
        'captype' => 'write',
        'contextlevel' => CONTEXT_SYSTEM,
        'legacy' => array(
            'admin' => CAP_ALLOW
            'student' => CAP_ALLOW,
        )
    ),

);

// add this to make it 1.9 compatible
$local_dashboard_capabilities = $capabilities;
?>
