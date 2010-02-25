<?php

$filteroptions = array(
    'type' => array(
        'type' => array(
            'filtertype' => 'select',
            'label' => 'Record Type',
            'selectfunc' => 'get_type_list',
            'options' => array('class'=>'limited-width',
        ),
    ),
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
    'course' => array(
        'fullname' => array(
            'filtertype' => 'text',
            'label' => 'Course Name',
        ),
    ),
    'course_category' => array(
        'id' => array(
            'filtertype' => 'select',
            'label' => 'Course Category',
            'selectfunc' => 'get_course_categories_list',
            'options' => array('class' => 'limited-width'),
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
    'course_completion' => array(
        'completeddate' => array(
            'filtertype' => 'date',
            'label' => 'Completed Date',
        ),
        'status' => array(
            'filtertype' => 'select',
            'label' => 'Completion Status',
            'selectfunc' => 'get_completion_status_list',
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

