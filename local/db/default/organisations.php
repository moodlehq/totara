<?php

    if ($defaultof = get_record_select('organisation_framework', "shortname='general'")) {
         $defaultof->fullname    = 'National Office';
         $defaultof->shortname   = 'NO';
         $defaultof->idnumber    = '1';

         update_record('organisation_framework', $defaultof);
    }

    $organisation_frameworks = array(
        array(
            'id'           => '2',
            'fullname'     => 'Regional Offices',
            'shortname'    => 'RO',
            'idnumber'     => '2',
            'isdefault'    => '0',
            'description'  => '',
            'sortorder'    => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        ),
    );
    foreach($organisation_frameworks as $organisation_framework) {
        insert_record('organisation_framework', (object)$organisation_framework);
    }

    $organisation_depths = array(
        array(
            'fullname'     => 'Business Group',
            'shortname'    => 'BG',
            'description'  => '',
            'depthlevel'   => '1',
            'frameworkid'  => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'fullname'     => 'Business Unit',
            'shortname'    => 'BU',
            'description'  => '',
            'depthlevel'   => '2',
            'frameworkid'  => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'fullname'     => 'Regional Office',
            'shortname'    => 'RO',
            'description'  => '',
            'depthlevel'   => '1',
            'frameworkid'  => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'fullname'     => 'Area Office',
            'shortname'    => 'AO',
            'description'  => '',
            'depthlevel'   => '2',
            'frameworkid'  => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
    );
    $organisationdepthids = array();
    foreach($organisation_depths as $organisation_depth) {
        insert_record('organisation_depth', (object)$organisation_depth);
    }

    $organisations = array(
        array(
            'fullname'            => 'Organisational Development',
            'shortname'           => 'OD',
            'description'         => '',
            'idnumber'            => '3',
            'frameworkid'         => '1',
            'parentid'            => '0',
            'visible'             => '1',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
            'subcompetencies'     => array(
                array(
                    'fullname'            => '',
                    'shortname'           => '',
                    'description'         => '',
                    'idnumber'            => '',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '',
                            'data'         => '',
                        ),
                        array(
                            'fieldid'      => '',
                            'data'         => '',
                        ),
                        array(
                            'fieldid'      => '',
                            'data'         => '',
                        ),
                    ),
                ),
            ),
        ),
    );

