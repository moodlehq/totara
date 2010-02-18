<?php
// This file defines the possible filters that can be included in reports
// from this source
//
// The format of this file is a multidimensional array:
//
// outer key => 'type' of field
// inner key => 'value' of field
//   These are used to link a filter to the column using 'type' and 'name' from
//   columnoptions.php. This allows the filter to know what SQL to use to 
//   generate the filter.
//
// 'filtertype' key => This determines the sort of filter to display. Options
//                     include text (plain text field), date (before, after or 
//                     between a date range) and select (choose from pulldown).
//                     Other options can be set up but the filters must be 
//                     created. See reportbuilder/filters/ for existing and 
//                     example filters.
// 'label' key => This is the label that appears next to the filter form 
//                element, and also appears in the pulldown when an admin 
//                is building a report. Use of get_string is allowed/encouraged.
// 'selectfunc' key => If the type is 'select', this provides the name of a 
//                     function to be used to generate the pulldown menu of 
//                     options. The filter functions should be defined in
//                     sources/*/filterfuncs.php and should return an array 
//                     with name/value pairs corresponding to the value and
//                     display text for the select menu.
// 'options' key => If the type is 'select', this provides a way to provide
//                  additional options to the select element to format the 
//                  appearance of the pulldown. See formslib docs for details
//                  of format. 

// used to fix IE issue with fixed width selects
$selectwidth = array('class' => 'mitms-limited-width','onMouseDown'=>"if(document.all) this.className='mitms-expanded-width';",'onBlur'=>"if(document.all) this.className='mitms-limited-width';",'onChange'=>"if(document.all) this.className='mitms-limited-width';");

// define filter options for this source
$filteroptions = array(
    'user' => array(
        'fullname' => array(
            'filtertype' => 'text',
            'label' => 'Participant Name',
        ),
        'firstname' => array(
            'filtertype' => 'text',
            'label' => get_string('firstname'),
        ),
        'lastname' => array(
            'filtertype' => 'text',
            'label' => get_string('lastname'),
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
            'options' => $selectwidth,
        ),
        'positionid' => array(
            'filtertype' => 'select',
            'label' => 'Participant\'s Current Position',
            'selectfunc' => 'get_positions_list',
            'options' => $selectwidth,
        ),
        'managername' => array(
            'filtertype' => 'text',
            'label' => 'Manager\'s Name',
        ),
        'title' => array(
            'filtertype' => 'text',
            'label' => 'User\'s Job Title',
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
            'options' => $selectwidth,
        ),
        'organisationid' => array(
            'filtertype' => 'select',
            'label' => 'Office when completed',
            'selectfunc' => 'get_organisations_list',
            'options' => $selectwidth,
        ),
        'positionid' => array(
            'filtertype' => 'select',
            'label' => 'Position when completed',
            'selectfunc' => 'get_positions_list',
            'options' => $selectwidth,
        ),
        'assessor' => array(
            'filtertype' => 'text',
            'label' => 'Assessor Name',
        ),
        'assessorname' => array(
            'filtertype' => 'text',
            'label' => 'Assessor Organisation',
        ),
    ),
    'user_profile' => array(
        // just a text field, would be better as date
        // but field is text not timestamp
        'dob' => array(
            'filtertype' => 'text',
            'label' => 'Date of Birth',
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

