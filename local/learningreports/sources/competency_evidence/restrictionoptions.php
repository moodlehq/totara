<?php

$restrictionoptions = array(
    array(
        'funcname' => 'own_records',  // function called to apply restriction: see learningreport_restriction_* in learningreports/restrictionfuncs.php
        'title' => 'Self',  // for text describing option in admin settings
        'field' => 'base.userid',      // field to apply limit to
        'joins' => array(), // joins required for above field
        'capability' => 'moodle/local:viewownreports', // cap required, if not set then restriction can be applied without needing any capability
        'default' => '1', // if 1, this setting is checked for new reports
    ),
    array(
        'funcname' => 'staff_records',
        'title' => 'Direct Reports',
        'field' => 'base.userid',
        'joins' => array(),
        'capability' => 'moodle/local:viewstaffreports',
        'default' => '0',
    ),
    array(
        'funcname' => 'local_records',
        'title' => 'Current Local staff',
        'field' => 'base.userid',
        'joins' => array(),
        'capability' => 'moodle/local:viewlocalreports',
        'default' => '0',
    ),
    array(
        'funcname' => 'local_completed_records',
        'title' => 'Those Completed Locally',
        'field' => 'base.organisationid',
        'joins' => array(),
        'capability' => 'moodle/local:viewlocalreports',
        'default' => '0',
    ),
    array(
        'funcname' => 'all',
        'title' => 'All Records',
        // note this is a special value - when field set to "all" and
        // user has capability skips normal process and displays all
        // records independent of other restrictions
        'field' => 'all',
        'capability' => 'moodle/site:viewreports',
        'default' => '0',
    ),
);

