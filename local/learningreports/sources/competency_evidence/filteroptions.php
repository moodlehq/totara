<?php

$filteroptions = array(
    'user' => array(
        'firstname' => array(
            'filtertype' => 'text',
            'label' => get_string('lastname'),
        ),
        'lastname' => array(
            'filtertype' => 'text',
            'label' => get_string('firstname'),
        ),
        'fullname' => array(
            'filtertype' => 'text',
            'label' => 'Participant Name',
        ),
        'organisationid' => array(
            'filtertype' => 'select',
            'label' => 'Participant\'s Current Office',
            'selectfunc' => 'get_organisations_list',
            'options' => array('class' => 'limited-width'),
        ),
        'positionid' => array(
            'filtertype' => 'select',
            'label' => 'Participant\'s Current Position',
            'selectfunc' => 'get_positions_list',
            'options' => array('class' => 'limited-width'),
        ),
    ),
    'competency' => array(
        'fullname' => array(
            'filtertype' => 'text',
            'label' => 'Competency Name',
        ),
    ),
    'competency' => array(
        'fullname' => array(
            'filtertype' => 'text',
            'label' => 'Competency Name',
        ),
        'idnumber' => array(
            'filtertype' => 'text',
            'label' => 'Competency ID',
        ),
    ),
    'competency_evidence' => array(
        'completeddate' => array(
            'filtertype' => 'date',
            'label' => 'Completed Date',
        ),
        'proficiency' => array(
            'filtertype' => 'select',
            'label' => 'Proficiency',
            'selectfunc' => 'get_proficiency_list',
            'options' => array('class' => 'limited-width'),
        ),
        'organisationid' => array(
            'filtertype' => 'select',
            'label' => 'Office when completed',
            'selectfunc' => 'get_organisations_list',
            'options' => array('class' => 'limited-width'),
        ),
        'positionid' => array(
            'filtertype' => 'select',
            'label' => 'Position when completed',
            'selectfunc' => 'get_positions_list',
            'options' => array('class' => 'limited-width'),
        ),
    ),
);

