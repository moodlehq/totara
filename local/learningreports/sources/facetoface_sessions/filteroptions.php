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
        'username' => array(
            'filtertype' => 'text',
            'label' => 'Username',
        ),
        'idnumber' => array(
            'filtertype' => 'text',
            'label' => 'ID Number',
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
    'facetoface' => array(
        'name' => array(
            'filtertype' => 'text',
            'label' => 'Face to face name',
        ),
    ),
    'status' => array(
        'statuscode' => array(
            'filtertype' => 'select',
            'label' => 'Status',
            'selectfunc' => 'get_session_status_list',
            'options' => array('class'=>'limited-width'),
        ),
    ),
    'date' => array(
        'sessiondate' => array(
            'filtertype' => 'date',
            'label' => 'Session Date',
        ),
    ),
    'session' => array(
        'capacity' => array(
            'filtertype' => 'text',
            'label' => 'Session Capacity',
        ),
        'location' => array(
            'filtertype' => 'text',
            'label' => 'Session Location',
        ),
        'venue' => array(
            'filtertype' => 'text',
            'label' => 'Session Venue',
        ),
        'room' => array(
            'filtertype' => 'text',
            'label' => 'Session Room',
        ),
        'pilot' => array(
            'filtertype' => 'select',
            'label' => 'Pilot',
            'selectfunc' => 'get_yesno_list',
            'options' => array('class' => 'limited-width'),
        ),
        'audit' => array(
            'filtertype' => 'select',
            'label' => 'Audit',
            'selectfunc' => 'get_yesno_list',
            'options' => array('class' => 'limited-width'),
        ),
        'coursedelivery' => array(
            'filtertype' => 'select',
            'label' => 'Course Delivery',
            'selectfunc' => 'get_coursedelivery_list',
            'options' => array('class' => 'limited-width'),
        ),
    ),
    /*
    'course_category' => array(
        'id' => array(
            'filtertype' => 'select',
            'label' => 'Course Category',
            'selectfunc' => 'get_course_categories_list',
            'options' => array('class' => 'limited-width'),
        ),
    ),*/
);

