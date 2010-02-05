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
        'username' => array(
            'filtertype' => 'text',
            'label' => 'Username',
        ),
        'idnumber' => array(
            'filtertype' => 'text',
            'label' => 'ID Number',
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
        'manager_name' => array(
            'filtertype' => 'text',
            'label' => 'Manager\'s Name',
        ),
    ),
    'competency' => array(
        'fullname' => array(
            'filtertype' => 'text',
            'label' => 'Competency Name',
        ),
        'shortname' => array(
            'filtertype' => 'text',
            'label' => 'Competency Short Name',
        ),
        'idnumber' => array(
            'filtertype' => 'text',
            'label' => 'Competency ID Number',
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
    'user_profile' => array(
        // just a text field, would be better as date
        // but field is text not timestamp
        'dob' => array(
            'filtertype' => 'text',
            'label' => 'Date of Birth',
        ),
        'title' => array(
            'filtertype' => 'text',
            'label' => 'Job Title',
        ),
        'nzqaid' => array(
            'filtertype' => 'text',
            'label' => 'NZQA ID',
        ),
        'jade' => array(
            'filtertype' => 'text',
            'label' => 'Jade Number',
        ),
    ),
);

