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
        insert_record('user', (object)$user);
    }
    // free memory
    $users = array();

    /// import demo position data
    require_once('demopositions.php');
    foreach($positions as $position) {
        $position['timecreated']  = $timenow;
        $position['timemodified'] = $timenow;
        insert_record('position', (object)$position);
    }
    // free memory
    $positions = array();
    
    $role_assignments = array(
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
            'idnumber'    => '',
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
        array(
            'id'           => '3',
            'fullname'     => 'Retail Institute Qualifications',
            'shortname'    => 'RI Quals',
            'idnumber'    => '',
            'isdefault'    => '0',
            'description'  => '',
            'sortorder'    => '3',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        ),
        array(
            'id'           => '4',
            'fullname'     => 'Hospitality Standards Institute Qualifications',
            'shortname'     => 'HSI Quals',
            'idnumber'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '4',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        ),
        array(
            'id'           => '5',
            'fullname'     => 'Hairdressing Industry Training Organisation Qualifications',
            'shortname'    => 'HITO Quals',
            'idnumber'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '5',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        ),
        array(
            'id'           => '6',
            'fullname'     => 'Aviation, Tourism and Travel Training Organisation Qualifications',
            'shortname'    => 'ATTTO Quals',
            'idnumber'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '6',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        ),
        array(
            'id'           => '7',
            'fullname'     => 'Skills Active Qualifications',
            'shortname'    => 'SA Quals',
            'idnumber'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '7',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        ),
        array(
            'id'           => '8',
            'fullname'     => 'Tranzqual Qualifications',
            'shortname'    => 'T Quals',
            'idnumber'    => '',
            'description'  => '',
            'isdefault'    => '0',
            'sortorder'    => '8',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
            'visible'      => 1,
            'hidecustomfields' => 0,
            'showitemfullname' => 1,
            'showdepthfullname' => 1,
        ),
    );
    foreach($competency_frameworks as $competency_framework) {
        insert_record('competency_framework', (object)$competency_framework);
    }

    // update default competency depth details with demo example
    if ($defaultcd = get_record_select('competency_depth', "shortname='Competencies'")) {
         $defaultcd->fullname    = 'Qualifications';
         $defaultcd->shortname   = 'Q';
         update_record('competency_depth', $defaultcd);
    }
    // add a competency depth level to the default competency framework
    $defaultcd1 = array(
            'fullname'     => 'Unit Standards',
            'shortname'    => 'US',
            'description'  => '',
            'depthlevel'   => '2',
            'frameworkid'  => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
    );
    insert_record('competency_depth', (object)$defaultcd1);

    $competency_depths = array(
        array(
            'fullname'     => 'Qualifications',
            'shortname'    => 'Q',
            'description'  => '',
            'depthlevel'   => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'fullname'     => 'Unit Standards',
            'shortname'    => 'US',
            'description'  => '',
            'depthlevel'   => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'fullname'     => 'Elements',
            'shortname'    => 'EL',
            'description'  => '',
            'depthlevel'   => '3',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
    );
    $competencydepthids = array();
    for ($i = 2; $i < 7; $i++) {
        foreach($competency_depths as $competency_depth) {
            $competency_depth['frameworkid'] = $i;
            $id = insert_record('competency_depth', (object)$competency_depth);
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
            'locked'       => '0',
            'required'     => '1',
            'forceunique'  => '1',
            'defaultdata'  => '',
            'param1'       => '30',
            'param2'       => '2048',
            'param3'       => '0',
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
            'locked'       => '0',
            'required'     => '1',
            'forceunique'  => '1',
            'defaultdata'  => '',
            'param1'       => '30',
            'param2'       => '2048',
            'param3'       => '0',
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
            'hidden'       => '1',
            'locked'       => '0',
            'required'     => '1',
            'forceunique'  => '1',
            'defaultdata'  => '',
            'param1'       => '30',
            'param2'       => '2048',
            'param3'       => '0',
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
            'hidden'       => '1',
            'locked'       => '0',
            'required'     => '1',
            'forceunique'  => '1',
            'defaultdata'  => '',
            'param1'       => '30',
            'param2'       => '40',
            'param3'       => '',
        ),
        array(
            'id'           => '5',
            'fullname'     => 'Level',
            'shortname'    => 'Level',
            'description'  => '',
            'depthid'      => '2',
            'datatype'     => 'text',
            'categoryid'   => '4',
            'sortorder'    => '1',
            'hidden'       => '0',
            'locked'       => '0',
            'required'     => '1',
            'forceunique'  => '1',
            'defaultdata'  => '',
            'param1'       => '30',
            'param2'       => '2048',
            'param3'       => '0',
        ),
        array(
            'id'           => '6',
            'fullname'     => 'Credits',
            'shortname'    => 'Credits',
            'description'  => '',
            'depthid'      => '2',
            'datatype'     => 'text',
            'categoryid'   => '4',
            'sortorder'    => '2',
            'hidden'       => '0',
            'locked'       => '0',
            'required'     => '1',
            'forceunique'  => '1',
            'defaultdata'  => '',
            'param1'       => '30',
            'param2'       => '2048',
            'param3'       => '0',
        ),
        array(
            'id'           => '7',
            'fullname'     => 'Version',
            'shortname'    => 'Version',
            'description'  => '',
            'depthid'      => '2',
            'datatype'     => 'text',
            'categoryid'   => '4',
            'sortorder'    => '3',
            'hidden'       => '0',
            'locked'       => '0',
            'required'     => '1',
            'forceunique'  => '1',
            'defaultdata'  => '',
            'param1'       => '30',
            'param2'       => '2048',
            'param3'       => '0',
        ),
    );
    foreach($competency_depth_info_fields as $competency_depth_info_field) {
        insert_record('competency_depth_info_field', (object)$competency_depth_info_field);
    }

    $competency_depth_info_categories = array(
        array(
            'id'           => '1',
            'name'         => 'High level',
            'sortorder'    => '1',
            'depthid'      => '1',
        ),
        array(
            'id'           => '2',
            'name'         => 'Mid level',
            'sortorder'    => '2',
            'depthid'      => '1',
        ),
        array(
            'id'           => '3',
            'name'         => 'Low level',
            'sortorder'    => '3',
            'depthid'      => '1',
        ),
        array(
            'id'           => '4',
            'name'         => 'High level',
            'sortorder'    => '1',
            'depthid'      => '2',
        ),
        array(
            'id'           => '5',
            'name'         => 'Mid level',
            'sortorder'    => '2',
            'depthid'      => '2',
        ),
        array(
            'id'           => '6',
            'name'         => 'Low level',
            'sortorder'    => '3',
            'depthid'      => '2',
        ),
    );
    foreach($competency_depth_info_categories as $competency_depth_info_category) {
        insert_record('competency_depth_info_category', (object)$competency_depth_info_category);
    }

    $competency_depth_info_data = array(
        array(
            'competencyid' => '1',
            'fieldid'      => '1',
            'data'         => '3',
        ),
        array(
            'competencyid' => '1',
            'fieldid'      => '2',
            'data'         => '45',
        ),
        array(
            'competencyid' => '1',
            'fieldid'      => '3',
            'data'         => 'For new team leaders or those who are being developed for team leader or first line management roles.',
        ),
        array(
            'competencyid' => '1',
            'fieldid'      => '4',
            'data'         => 'This qualification is the first of two qualifications for people who are, or are training to be first line managers (team leaders, supervisors, or charge hands).  People in these roles are likely to be responsible for managing people, resources, or workplace operations, and may have had little, or no formal training.<br/><br/>

The compulsory section specifies the essential oral communication skills required of first line managers, while the elective sections allow people to select from a diverse range of outcomes to allow the qualification to be focused on the specific needs of the individual, business, or workplace.<br/><br/>

Knowledge and skills covered in the first two elective sections include relevant business skills such as administration, quality management, systems and resources, people development, and interpersonal skills.  A third elective allows the candidate to choose from anywhere on the National Qualifications Framework to include industry-specific skills and knowledge, or to build on earlier learning, or begin building a career pathway of his/her choosing.<br/><br/>

The National Certificate in Business (First Line Management) (Level 3) [Ref: 0743] may lead to the National Certificate in Business (First Line Management) (Level 4) [Ref: 0649] and to other qualifications in the Business field such as the National Diploma in Business (Level 5) [Ref: 0783], or other qualifications in business administration, small business management, or Māori business and management.',
        ),
        array(
            'competencyid' => '2',
            'fieldid'      => '5',
            'data'         => '3',
        ),
        array(
            'competencyid' => '2',
            'fieldid'      => '6',
            'data'         => '3',
        ),
        array(
            'competencyid' => '2',
            'fieldid'      => '7',
            'data'         => '5',
        ),
        array(
            'competencyid' => '3',
            'fieldid'      => '5',
            'data'         => '3',
        ),
        array(
            'competencyid' => '3',
            'fieldid'      => '6',
            'data'         => '3',
        ),
        array(
            'competencyid' => '3',
            'fieldid'      => '7',
            'data'         => '4',
        ),
        array(
            'competencyid' => '4',
            'fieldid'      => '5',
            'data'         => '2',
        ),
        array(
            'competencyid' => '4',
            'fieldid'      => '6',
            'data'         => '3',
        ),
        array(
            'competencyid' => '4',
            'fieldid'      => '7',
            'data'         => '4',
        ),
        array(
            'competencyid' => '5',
            'fieldid'      => '5',
            'data'         => '3',
        ),
        array(
            'competencyid' => '5',
            'fieldid'      => '6',
            'data'         => '4',
        ),
        array(
            'competencyid' => '5',
            'fieldid'      => '7',
            'data'         => '4',
        ),
        array(
            'competencyid' => '6',
            'fieldid'      => '5',
            'data'         => '3',
        ),
        array(
            'competencyid' => '6',
            'fieldid'      => '6',
            'data'         => '3',
        ),
        array(
            'competencyid' => '6',
            'fieldid'      => '7',
            'data'         => '4',
        ),
        array(
            'competencyid' => '7',
            'fieldid'      => '5',
            'data'         => '3',
        ),
        array(
            'competencyid' => '7',
            'fieldid'      => '6',
            'data'         => '3',
        ),
        array(
            'competencyid' => '7',
            'fieldid'      => '7',
            'data'         => '4',
        ),
        array(
            'competencyid' => '8',
            'fieldid'      => '5',
            'data'         => '3',
        ),
        array(
            'competencyid' => '8',
            'fieldid'      => '6',
            'data'         => '3',
        ),
        array(
            'competencyid' => '8',
            'fieldid'      => '7',
            'data'         => '2',
        ),
    );
    foreach($competency_depth_info_data as $competency_depth_info_data_item) {
        insert_record('competency_depth_info_data', (object)$competency_depth_info_data_item);
    }

    // change the default competency and add its sub-competencies
    if ($defaultc = get_record_select('competency', "id='1'")) {
         $defaultc->fullname    = 'National Certificate in Business (First Line Management) (Level 3) v3';
         $defaultc->shortname   = 'Business L3';
         $defaultc->idnumber    = '71';
         $defaultc->frameworkid = '1';
         update_record('competency', $defaultc);
    }
    $competencies = array(
        array(
            'fullname'            => 'Speak to a specified audience in a predictable situation',
            'shortname'           => 'Speak to an audience',
            'description'         => 'Management Module (Level 4)',
            'idnumber'            => '1307',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'depthid'             => '2',
            'path'                => '/1/2',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'fullname'            => 'Give oral instructions in the workplace',
            'shortname'           => 'Give oral instructions',
            'description'         => '',
            'idnumber'            => '1312',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'depthid'             => '2',
            'path'                => '/1/3',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'fullname'            => 'Write a short report',
            'shortname'           => 'Write a report',
            'description'         => '',
            'idnumber'            => '3492',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'depthid'             => '2',
            'path'                => '/1/4',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'fullname'            => 'Demonstrate knowledge of quality and its management',
            'shortname'           => 'Demonstrate knowledge of quality',
            'description'         => '',
            'idnumber'            => '8085',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'depthid'             => '2',
            'path'                => '/1/5',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'fullname'            => 'Contribute within a group/team which has an objective(s)',
            'shortname'           => 'Contribute within a group',
            'description'         => '',
            'idnumber'            => '9681',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'depthid'             => '2',
            'path'                => '/1/6',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'fullname'            => 'Give and respond to feedback on performance',
            'shortname'           => 'Give feedback',
            'description'         => '',
            'idnumber'            => '9705',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'depthid'             => '2',
            'path'                => '/1/7',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'fullname'            => 'Listen to gain information in an interactive situation',
            'shortname'           => 'Listen',
            'description'         => '',
            'idnumber'            => '11097',
            'frameworkid'         => '1',
            'parentid'            => '1',
            'depthid'             => '2',
            'path'                => '/1/8',
            'visible'             => '1',
            'aggregationmethod'   => '1',
            'scaleid'             => '1',
            'proficiencyexpected' => '1',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
    );
    $sortorder = 2;
    foreach($competencies as $competency) {
        $competency['sortorder'] = $sortorder++;
        insert_record('competency', (object)$competency);
    }
    // add the rest of the competencies in this framework in a nested array
    $competencies = array(
        array(
            'fullname'            => 'National Certificate in Business (First Line Management) (Level 3) v3 and (Level 4) v4',
            'shortname'           => 'Business L3 and L4',
            'description'         => 'Management Award in Communication (Level 3)',
            'idnumber'            => '71',
            'frameworkid'         => '1',
            'parentid'            => '0',
            'visible'             => '1',
            'aggregationmethod'   => '',
            'scaleid'             => '',
            'proficiencyexpected' => '',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
            'subcompetencies'     => array(
                array(
                    'fullname'            => 'Develop strategies to establish and maintain positive workplace relationships',
                    'shortname'           => 'Establish positive relationships',
                    'description'         => '',
                    'idnumber'            => '1987',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '5',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '4',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Supervise workplace operations',
                    'shortname'           => 'Supervise workplace operations',
                    'description'         => '',
                    'idnumber'            => '1988',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '6',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '4',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Identify key workplace organisational principles',
                    'shortname'           => 'Identify workplace principles',
                    'description'         => '',
                    'idnumber'            => '16342',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '2',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Demonstrate and apply knowledge of team building skills',
                    'shortname'           => 'Team building skills',
                    'description'         => '',
                    'idnumber'            => '18336',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '5',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '2',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Demonstrate knowledge of performance management planning',
                    'shortname'           => 'Performance management planning',
                    'description'         => '',
                    'idnumber'            => '23396',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '3',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '1',
                        ),
                    ),
                ),
            ),
        ),
        array(
            'fullname'            => 'National Certificate in Business (First Line Management) (Level 4) v4',
            'shortname'           => 'Business L4',
            'description'         => 'Management Award in Leading Teams',
            'idnumber'            => '71',
            'frameworkid'         => '1',
            'parentid'            => '0',
            'visible'             => '1',
            'aggregationmethod'   => '',
            'scaleid'             => '',
            'proficiencyexpected' => '',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
            'subcompetencies'     => array(
                array(
                    'fullname'            => 'Plan and monitor performance of others',
                    'shortname'           => 'Monitor performance of others',
                    'description'         => '',
                    'idnumber'            => '23997',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '5',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '6',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '1',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Manage interpersonal conflict',
                    'shortname'           => 'Manage interpersonal conflict',
                    'description'         => '',
                    'idnumber'            => '9704',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '6',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '4',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Participate in a formal meeting',
                    'shortname'           => 'Participate in a formal meeting',
                    'description'         => '',
                    'idnumber'            => '9679',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '4',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Apply problem solving techniques',
                    'shortname'           => 'Apply problem solving techniques',
                    'description'         => '',
                    'idnumber'            => '9696',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '4',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Lead a group/team to achieve an objective(s)',
                    'shortname'           => 'Lead a group',
                    'description'         => '',
                    'idnumber'            => '21335',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '5',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '1',
                        ),
                    ),
                ),
                array(
                    'fullname'            => 'Apply time management concepts and methods in business solutions',
                    'shortname'           => 'Time management',
                    'description'         => '',
                    'idnumber'            => '16614',
                    'frameworkid'         => '1',
                    'visible'             => '1',
                    'aggregationmethod'   => '1',
                    'scaleid'             => '1',
                    'proficiencyexpected' => '1',
                    'evidencecount'       => '0',
                    'timecreated'         => $timenow,
                    'timemodified'        => $timenow,
                    'usermodified'        => '2',
                    'customdata'          => array(
                        array(
                            'fieldid'      => '5',
                            'data'         => '4',
                        ),
                        array(
                            'fieldid'      => '6',
                            'data'         => '3',
                        ),
                        array(
                            'fieldid'      => '7',
                            'data'         => '2',
                        ),
                    ),
                ),
            ),
        ),
/*
        array(
            'id'                  => '7',
            'fullname'            => 'Business',
            'shortname'           => 'Business',
            'description'         => '',
            'idnumber'            => '71',
            'frameworkid'         => '2',
            'parentid'            => '1',
            'sortorder'           => '1',
            'depthid'             => '1',
            'visible'             => '1',
            'aggregationmethod'   => '',
            'scaleid'             => '',
            'proficiencyexpected' => '',
            'evidencecount' => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
        array(
            'id'                  => '8',
            'fullname'            => 'Business Management',
            'shortname'           => 'Business Management',
            'description'         => 'Management and Commerce > Business and Management > Business Management',
            'idnumber'            => '080301',
            'frameworkid'         => '2',
            'parentid'            => '1',
            'sortorder'           => '2',
            'depthid'             => '1',
            'visible'             => '1',
            'aggregationmethod'   => '',
            'scaleid'             => '',
            'proficiencyexpected' => '',
            'evidencecount'       => '0',
            'timecreated'         => $timenow,
            'timemodified'        => $timenow,
            'usermodified'        => '2',
        ),
*/
    );
    foreach ($competencies as $competency) {
        $subcompetencies = $competency['subcompetencies'];
        $competency['sortorder'] = $sortorder++;
        $competency['depthid'] = 1;
        $newcid = insert_record('competency', (object)$competency);
        foreach ($subcompetencies as $subcompetency) {
            $customdata = $subcompetency['customdata'];
            $subcompetency['parentid'] = $newcid;
            $subcompetency['sortorder'] = $sortorder++;
            $subcompetency['depthid'] = 2;
            $newsubcid = insert_record('competency', $subcompetency);
            foreach ($customdata as $c) {
                $c['competencyid'] = $newsubcid;
                insert_record('competency_depth_info_data', (object)$c);
            }
        }

    }
    $competency_evidence_items = array(
        array(
            'id'           => '1',
            'competencyid' => '',
            'itemtype'     => '',
            'itemmodule'   => '',
            'iteminstance' => '',
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
            'usermodified' => '1',
        ),
        array(
            'id'           => '2',
            'name'         => 'Competency performance scale',
            'description'  => 'Standard competency performance scale',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
    );
    foreach($scales as $scale) {
        insert_record('competency_scale', (object)$scale);
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
        insert_record('competency_scale_values', (object)$scale_value);
    }

    $scale_assignments = array(
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '1',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '2',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '3',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '4',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '5',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '6',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '7',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
        array(
            'id'           => '1',
            'scaleid'      => '1',
            'frameworkid'  => '8',
            'timemodified' => $timenow,
            'usermodified' => '1',
        ),
    );
    foreach($scale_assignments as $scale_assignment) {
        insert_record('competency_scale_assignments', (object)$scale_assignment);
    }

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

    // update default organisation depth details with demo example
    if ($defaultcd = get_record_select('organisation_depth', "shortname='Organisations'")) {
         $defaultcd->fullname    = 'Business Group';
         $defaultcd->shortname   = 'BG';
         update_record('competency_depth', $defaultcd);
    }
    // add a competency depth level to the default competency framework
    $defaultcd1 = array(
            'fullname'     => 'Business Unit',
            'shortname'    => 'BU',
            'description'  => '',
            'depthlevel'   => '2',
            'frameworkid'  => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
    );
    insert_record('organisation_depth', (object)$defaultcd1);

    $organisation_depths = array(
        array(
            'fullname'     => 'Regional Office',
            'shortname'    => 'RO',
            'description'  => '',
            'depthlevel'   => '1',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
        array(
            'fullname'     => 'Area Office',
            'shortname'    => 'AO',
            'description'  => '',
            'depthlevel'   => '2',
            'timecreated'  => $timenow,
            'timemodified' => $timenow,
            'usermodified' => '2',
        ),
    );
    $competencydepthids = array();
    for ($i = 2; $i < 7; $i++) {
        foreach($organisation_depths as $organisation_depth) {
            $organisation_depth['frameworkid'] = $i;
            $id = insert_record('competency_depth', (object)$competency_depth);
            if ($competency_depth['frameworkid'] == '2') {
                $competencydepthids[] = $id;
            }
        }
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
