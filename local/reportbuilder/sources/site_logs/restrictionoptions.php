<?php

// this file contains information used to provide restriction options, which are
// a way of limiting what records are displayed in a particular form. Each element
// in the array below will appear in the report builder.
//
// Array elements are as follows:
//
// 'title' key => Title of the restriction. Appears in the report builder interface as
//                the checkbox label
// 'field' key => SQL fragment providing the name of the field the restriction should
//                be applied to
// 'joins' key => Array of join names, same as in columnoptions. This should specific
//                which joins are needed to make the field name defined above available.
// 'funcname' key => Name of a function called to build the restriction. These restriction
//                   functions are stored in reportbuilder/restrictionfuncs.php and are
//                   automatically prefixed with 'reportbuilder_restriction_' so just
//                   provide the suffix.
//                   The function should return either a single item (to be matched to
//                   field), or an array of items (to be compared to field using an
//                   IN () clause).
//                   If the function returns null then that particular filter will
//                   return no results. Note that filters are combined using an OR
//                   clause so if multiple filters are defined, results that match
//                   any one filter are shown.
// 'capability' key => A moodle capability, required for the restriction to return
//                     any results. These capabilities are also used to determine
//                     if a user should be able to see the report at all, and if
//                     a link to it appears in the Report Manager block.
//                     Note that if no capability is defined, all users will be
//                     able to see the results of the restriction if it is enabled.
// 'default' key => Set to 1 if setting is checked for new reports or 0 if disabled
//                  by default. Unless the source is public I would always define
//                  strict default settings, to prevent all users seeing data when
//                  report is first created but before admin has configured it. If
//                  no default restrictions are set, all users will be able to see
//                  all records when a new report is first created.
//
// There is a special field value of 'all', which if enabled and the user has the
// specified capability, overrides all the other restrictions and shows all
// results. Useful for admin reports but make sure the correct capability is set!
//
// restriction options for this source
$restrictionoptions = array(
    array(
        'name' => 'own',
        'funcname' => 'own_records',  // function called to apply restriction
        'title' => 'Self',  // for text describing option in admin settings
        'field' => 'base.userid',      // field to apply limit to
        'joins' => array(),         // joins required for above field
        'capability' => 'moodle/local:viewownreports', // cap required, if not set then restriction can be applied without needing any capability
        'default' => '0', // if 1, this setting is checked for new reports
    ),
    array(
        // no capability required as report checks for staff
        'name' => 'staff',
        'funcname' => 'staff_records',
        'title' => 'Direct Reports',
        'field' => 'base.userid',
        'joins' => array(),
        'default' => '0',
    ),
    array(
        'name' => 'local',
        'funcname' => 'local_records',
        'title' => 'Current Local staff',
        'field' => 'base.userid',
        'joins' => array(),
        'capability' => 'moodle/local:viewlocalreports',
        'default' => '0',
    ),
    array(
        'name' => 'local_completed',
        'funcname' => 'local_completed_records',
        'title' => 'Those Completed Locally',
        'field' => 'pa.organisationid',
        'joins' => array('position_assignment'),
        'capability' => 'moodle/local:viewlocalreports',
        'default' => '0',
    ),
    array(
        'name' => 'all',
        'funcname' => 'all',
        'title' => 'All Records',
        // note this is a special value - when field set to "all" and
        // user has capability skips normal process and displays all
        // records independent of other restrictions
        'field' => 'all',
        'capability' => 'moodle/local:viewallreports',
        'default' => '0',
    ),
);

