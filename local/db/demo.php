<?php
/*
 * Moodle - Modular Object-Oriented Dynamic Learning Environment
 *          http://moodle.org
 * Copyright (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
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
 * @package    moodle
 * @subpackage local
 * @author     Jonathan Newman <jonathan.newman@catalyst.net.nz>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL
 * @copyright  (C) 1999 onwards Martin Dougiamas  http://dougiamas.com
 *
 * local db upgrades for MITMS 
 */

    /// Insert demo data in these tables: user, position, position_assignments, competency, competency_assignmnets

    $timenow = time();

    /// import demo user data
    require_once('demousers.php');
    foreach($users as $user) {
        insert_record('user', $user);
    }
    // free memory
    $users = array();

    /// import demo position data
    require_once('demopositions.php');
    foreach($positions as $position) {
        $position['timecreated']  = $timenow;
        $position['timemodified'] = $timenow;
        insert_record('position', $position);
    }
    // free memory
    $positions = array();
    
    $role_assignments = array(
    );
    $organisation = array(
    );
    $training_organisation = array(
        '1' => array(
            'fullname'       => 'Retail Institute',
            'shortname'      => 'RI',
        ),
        '2' => array(
            'fullname'       => 'Hospitality Standards Institute',
            'shortname'      => 'HSI',
        ),
        '3' => array(
            'fullname'       => 'Hairdressing Industry Training Organisation',
            'shortname'      => 'HITO',
        ),
        '4' => array(
            'fullname'       => 'Aviation, Tourism and Travel Training Organisation',
            'shortname'      => 'ATTTO',
        ),
        '5' => array(
            'fullname'       => 'Skills Active',
            'shortname'      => 'SA',
        ),
        '6' => array(
            'fullname'       => 'Tranzqual',
            'shortname'      => 'T',
        ),
    );
    $position_frameworks = array(
    );
    $position_depth = array(
    );
    $position_depth_info_fields = array(
    );
    $position_depth_info_category = array(
    );
    $position_depth_info_data = array(
    );
    $position_relations = array(
    );
    $position_assignments = array(
    );
    $position_assignments_history = array(
    );

    if ($defaultcp = get_record_select('competency_framework', "shortname='general'")) {
         $defaultcp->fullname    = 'National Qualifications Framework';
         $defaultcp->shortname   = 'NQF';
         $defaultcp->description = 'The National Qualifications Framework (NQF) is designed to provide:<br>'
                                    .'<li><ul>nationally recognised standards and qualifications</ul>'
                                    .'<ul>recognition and credit for a wide range of knowledge and skills.</ul></li><br>'
                                    .'Unit standards and achievement standards, National Certificates and National Diplomas are registered on the NQF.';

         update_record('competency_framework', $defaultcp);
    }

    $competency_frameworks = array(
        array(
            'id'           => '2',
            'fullname'     => 'New Zealand Standard Classification of Education',
            'shortname'    => 'NZSCED',
            'idnumbner'    => '',
            'isdefault'    => '0',
            'description'  => '',
            'sortorder'    => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
        ),
        array(
            'id'           => '3',
            'fullname'     => 'Retail Institute Qualifications',
            'shortname'    => 'RI Quals',
            'idnumbner'    => '',
            'isdefault'    => '0',
            'description'  => '',
            'sortorder'    => '3',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
        ),
        array(
            'id'           => '4',
            'fullname'     => 'Hospitality Standards Institute Qualifications',
            'shortname'     => 'HSI Quals',
            'idnumbner'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '4',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
        ),
        array(
            'id'           => '5',
            'fullname'     => 'Hairdressing Industry Training Organisation Qualifications',
            'shortname'    => 'HITO Quals',
            'idnumbner'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '5',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
        ),
        array(
            'id'           => '6',
            'fullname'     => 'Aviation, Tourism and Travel Training Organisation Qualifications',
            'shortname'    => 'ATTTO Quals',
            'idnumbner'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '6',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
        ),
        array(
            'id'           => '7',
            'fullname'     => 'Skills Active Qualifications',
            'shortname'    => 'SA Quals',
            'idnumbner'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '7',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
        ),
        array(
            'id'           => '8',
            'fullname'     => 'Tranzqual Qualifications',
            'shortname'    => 'T Quals',
            'idnumbner'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '8',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
        ),
    );
    foreach($competency_frameworks as $competency_framework) {
        insert_record('competency_framework', $competency_framework);
    }

    // update default competency depth details with demo example
    if ($defaultcd = get_record_select('competency_depth', "shortname='Competencies'")) {
         $defaultcd->fullname    = 'Qualifications';
         $defaultcd->shortname   = 'Quals';
         update_record('competency_depth', $defaultcd);
    }
    // add a competency depth level to the default competency framework
    $defaultcd1 = array(
            'fullname'    => 'Detailed Requirements',
            'shortname'   => 'Requirements',
            'description' => '',
            'depthlevel'  => '1',
            'frameworkid' => '1',
    );
    insert_record('competency_depth', $defaultcd1);

    $competency_depths = array(
        array(
            'fullname'    => 'Qualifications',
            'shortname'   => 'Quals',
            'description' => '',
            'depthlevel'  => '0',
        ),
        array(
            'fullname'    => 'Unit Standards',
            'shortname'   => 'US',
            'description' => '',
            'depthlevel'  => '1',
        ),
        array(
            'fullname'    => 'Elements',
            'shortname'   => 'EL',
            'description' => '',
            'depthlevel'  => '2',
        ),
    );
    $competencydepthids = array();
    for ($i = 2; $i < 7; $i++) {
        foreach($competency_depths as $competency_depth) {
            $competency_depth['frameworkid'] = $i;
            $id = insert_record('competency_depth', $competency_depth);
            if ($competency_depth['frameworkid'] == '2') {
                $competencydepthids[] = $id;
            }
        }
    }

    $competency_depth_info_fields = array(
        array(
            'id'           => '1',
            'fullname'     => 'Level',
            'shortname'    => 'Level',
            'description'  => '',
            'depthid'      => '1',
            'datatype'     => 'text',
            'categoryid'   => '1',
            'sortorder'    => '1',
            'hidden'       => '0',
            'required'     => '1',
            'defaultdata'  => '',
        ),
        array(
            'id'           => '2',
            'fullname'     => 'Credits',
            'shortname'    => 'Credits',
            'description'  => '',
            'depthid'      => '1',
            'datatype'     => 'text',
            'categoryid'   => '1',
            'sortorder'    => '2',
            'hidden'       => '0',
            'required'     => '1',
            'defaultdata'  => '',
        ),
        array(
            'id'           => '3',
            'fullname'     => 'Purpose',
            'shortname'    => 'Purpose',
            'description'  => '',
            'depthid'      => '1',
            'datatype'     => 'text',
            'categoryid'   => '1',
            'sortorder'    => '3',
            'hidden'       => '0',
            'required'     => '1',
            'defaultdata'  => '',
        ),
        array(
            'id'           => '4',
            'fullname'     => 'Special Notes',
            'shortname'    => 'Special Notes',
            'description'  => '',
            'depthid'      => '1',
            'datatype'     => 'textarea',
            'categoryid'   => '1',
            'sortorder'    => '4',
            'hidden'       => '0',
            'required'     => '1',
            'defaultdata'  => '',
        ),
    );
    foreach($competency_depth_info_fields as $competency_depth_info_field) {
        $competency_depth_info_field['depthid'] = 1;
        insert_record('competency_depth_info_field', $competency_depth_info_field);
    }

    $competency_depth_info_categories = array(
        array(
            'id'           => '1',
            'name'         => 'High level',
            'sortorder'    => '1',
            'depthid'      => '1',
        ),
        array(
            'id'           => '1',
            'name'         => 'Mid level',
            'sortorder'    => '2',
            'depthid'      => '1',
        ),
        array(
            'id'           => '1',
            'name'         => 'Low level',
            'sortorder'    => '3',
            'depthid'      => '1',
        ),
    );
    foreach($competency_depth_info_categories as $competency_depth_info_category) {
        $competency_depth_info_category['depthid'] = 1;
        insert_record('competency_depth_info_category', $competency_depth_info_category);
    }

    $competency_depth_info_data = array(
        array(
            'id'           => '1',
            'competencyid' => '1',
            'fieldid'      => '1',
            'data'         => '3',
        ),
        array(
            'id'           => '2',
            'competencyid' => '1',
            'fieldid'      => '2',
            'data'         => '45',
        ),
        array(
            'id'           => '3',
            'competencyid' => '1',
            'fieldid'      => '3',
            'data'         => 'This qualification is the first of two qualifications for people who are, or are training to be first line managers (team leaders, supervisors, or charge hands).  People in these roles are likely to be responsible for managing people, resources, or workplace operations, and may have had little, or no formal training.<br/><br/>

The compulsory section specifies the essential oral communication skills required of first line managers, while the elective sections allow people to select from a diverse range of outcomes to allow the qualification to be focused on the specific needs of the individual, business, or workplace.<br/><br/>

Knowledge and skills covered in the first two elective sections include relevant business skills such as administration, quality management, systems and resources, people development, and interpersonal skills.  A third elective allows the candidate to choose from anywhere on the National Qualifications Framework to include industry-specific skills and knowledge, or to build on earlier learning, or begin building a career pathway of his/her choosing.<br/><br/>

The National Certificate in Business (First Line Management) (Level 3) [Ref: 0743] may lead to the National Certificate in Business (First Line Management) (Level 4) [Ref: 0649] and to other qualifications in the Business field such as the National Diploma in Business (Level 5) [Ref: 0783], or other qualifications in business administration, small business management, or Māori business and management.',
        ),
    );
    foreach($competency_depth_info_data as $competency_depth_info_data_item) {
        insert_record('competency_depth_info_data', $competency_depth_info_data_item);
    }

    if ($defaultc = get_record_select('competency', "id='1'")) {
         $defaultc->fullname    = 'National Certificate in Business (First Line Management)';
         $defaultc->shortname   = 'Business';
         $defaultc->idnumber    = '71';
         $defaultc->frameworkid = '1';
         update_record('competency', $defaultc);
    }
    $competencies = array(
        array(
            'id'                  => '2',
            'fullname'            => 'Business',
            'shortname'           => 'Business',
            'description'         => '',
            'idnumber'            => '71',
            'frameworkid'         => '2',
            'parentid'            => '1',
            'sortorder'           => '2',
            'depthid'             => '1',
            'path'                => '1/2',
            'visible'             => '1',
            'aggregationmethod'   => '',
            'scaleid'             => '',
            'proficiencyexpected' => '',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'id'                  => '3',
            'fullname'            => 'Business Management',
            'shortname'           => 'Business Management',
            'description'         => 'Management and Commerce > Business and Management > Business Management',
            'idnumber'            => '080301',
            'frameworkid'         => '2',
            'parentid'            => '1',
            'sortorder'           => '3',
            'depthid'             => '1',
            'path'                => '1/3',
            'visible'             => '1',
            'aggregationmethod'   => '',
            'scaleid'             => '',
            'proficiencyexpected' => '',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'id'                  => '4',
            'fullname'            => 'Give oral instructions in the workplace',
            'shortname'           => 'Give oral instructions',
            'description'         => '',
            'idnumber'            => '1312',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'sortorder'           => '4',
            'depthid'             => '1',
            'path'                => '1/4',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'id'                  => '5',
            'fullname'            => 'Give and respond to feedback on performance',
            'shortname'           => 'Give feedback',
            'description'         => '',
            'idnumber'            => '9705',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'sortorder'           => '5',
            'depthid'             => '1',
            'path'                => '1/5',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'id'                  => '6',
            'fullname'            => 'Listen to gain information in an interactive situation',
            'shortname'           => 'Listen',
            'description'         => '',
            'idnumber'            => '11097',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'sortorder'           => '6',
            'depthid'             => '1',
            'path'                => '1/6',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
    );
    foreach($competencies as $competency) {
        insert_record('competency', $competency);
    }
    $competency_evidence_items = array(
        array(
            'id'           => '1',
            'competencyid' => '',
            'itemtype'     => '',
            'itemmodule'   => '',
            'iteminstance' => '',
            'weight'       => '',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
    );
    $competency_evidence_items_evidence = array(
        array(
            'id'                  => '1',
            'userid'              => '',
            'competencyid'        => '',
            'itemid'              => '',
            'status'              => '',
            'proficiencymeasured' => '',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
        ),
    );
    $competency_evidence = array(
        array(
            'id'                  => '1',
            'userid'              => '',
            'competencyid'        => '',
            'proficiencymeasured' => '',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
        ),
    );
    $competency_relations = array(
        array(
            'id'          => '1',
            'description' => '',
            'id1'         => '',
            'id2'         => '',
        ),
    );
    $competency_template = array(
        array(
            'id'           => '1',
            'name'         => 'General',
            'description'  => 'General competencies applied to all staff',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
    );
    $competency_template_competencies = array(
        array(
            'id'                  => '1',
            'templateid'          => '1',
            'competencyid'        => '',
            'priority'            => '',
            'proficiencyexpected' => '',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
    );
    $competency_template_assignments = array(
        array(
            'id'           => '1',
            'type'         => 'General',
            'instanceid'   => 'General competencies applied to all staff',
            'templateid'   => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
    );
    $scales = array(
        array(
            'id'           => '1',
            'name'         => 'Competency scale',
            'description'  => 'Standard competency scale',
            'timemodified' => $timenow,
        ),
        array(
            'id'           => '2',
            'name'         => 'Competency performance scale',
            'description'  => 'Standard competency performance scale',
            'timemodified' => $timenow,
        ),
    );
    foreach($scales as $scale) {
        insert_record('scale', $scale);
    }

    $scale_values = array(
        array(
            'id'          => '1',
            'scaleid'     => '1',
            'name'        => 'Not competent',
            'description' => 'Not competent',
            'idnumber'    => '1',
            'numeric'     => '0',
            'sortorder'   => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'id'          => '2',
            'scaleid'     => '1',
            'name'        => 'Competent',
            'description' => 'Competent',
            'idnumber'    => '2',
            'numeric'     => '1',
            'sortorder'   => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'id'          => '3',
            'scaleid'     => '2',
            'name'        => 'Not yet competent',
            'description' => 'Not competent',
            'idnumber'    => '1',
            'numeric'     => '0',
            'sortorder'   => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'id'          => '4',
            'scaleid'     => '2',
            'name'        => 'Not yet performing',
            'description' => 'Not yet performing',
            'idnumber'    => '2',
            'numeric'     => '1',
            'sortorder'   => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'id'          => '5',
            'scaleid'     => '2',
            'name'        => 'Performing',
            'description' => 'Performing',
            'idnumber'    => '3',
            'numeric'     => '2',
            'sortorder'   => '3',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
    );
    foreach($scale_values as $scale_value) {
        insert_record('scale_values', $scale_value);
    }   
