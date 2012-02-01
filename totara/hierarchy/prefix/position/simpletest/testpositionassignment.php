<?php
/**
 * Unit test to make sure manager path is correctly calculated
 *
 * @author Alastair Munro <alastair.munro@totaralms.com>
 *
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');
}

require_once($CFG->dirroot . '/lib/accesslib.php');
require_once($CFG->libdir . '/simpletestlib.php');
require_once($CFG->dirroot . '/hierarchy/prefix/position/lib.php');

class positionassignment_test extends prefix_changing_test_case {

    var $user_data = array(
        array('id',                 'auth',             'confirmed',
            'policyagreed',         'deleted',          'mnethostid',
            'username',             'password',         'idnumber',
            'firstname',            'lastname',         'email',
            'emailstop',            'icq',              'skype',
            'yahoo',                'aim',              'msn',
            'phone1',               'phone2',           'institution',
            'department',           'address',          'city',
            'country',              'lang',             'theme',
            'timezone',             'firstaccess',      'lastaccess',
            'lastlogin',            'currentlogin',     'lastip',
            'secret',               'picture',          'url',
            'description',          'mailformat',       'maildigest',
            'maildisplay',          'htmleditor',       'ajax',
            'autosubscribe',        'trackforums',      'timemodified',
            'trustbitmask',         'imagealt',         'screenreader',
            ),
        //16 lines * 3 columns = 48 fields
        array(1,                    'auth1',            0,
            0,                      0,                  10,
            'user1',                'test',             'idnumber',
            '10012',                'name1',            'user1@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '12',               0,
            0,                      'desc1',            1,
            0,                      2,                  1,
            1,                      1,                  0,
            0,                      0,                  'imgalt1',
            0,                      0,                  0,
            0,                      0,                  0
            ),
        array(2,                    'auth2',            0,
            0,                      0,                  20,
            'user2',                'test',             'idnumber',
            '20022',                'name2',            'user2@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '22',               0,
            0,                      'desc2',            2,
            0,                      2,                  2,
            2,                      2,                  0,
            0,                      0,                  'imgalt2',
            0,                      0,                  0,
            0,                      0,                  0
            ),
        array(3,                    'auth3',            0,
            0,                      0,                  30,
            'user3',                'test',             'idnumber',
            '30032',                'name3',            'user3@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '32',               0,
            0,                      'desc3',            3,
            0,                      2,                  3,
            3,                      3,                  0,
            0,                      0,                  'imgalt3',
            0,                      0,                  0,
            0,                      0,                  0
            ),
        array(4,                    'auth4',            0,
            0,                      0,                  40,
            'user4',                'test',             'idnumber',
            '40042',                'name4',            'user4@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '42',               0,
            0,                      'desc4',            4,
            0,                      2,                  4,
            4,                      4,                  0,
            0,                      0,                  'imgalt4',
            0,                      0,                  0,
            0,                      0,                  0
            ),
        array(5,                    'auth5',            0,
            0,                      0,                  40,
            'user5',                'test',             'idnumber',
            '50052',                'name5',            'user5@example.com',
            1,                      0,                  'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'test',             'test',
            'test',                 'NZ',               'en_utf8',
            'test',                 '52',               0,
            0,                      'desc5',            5,
            0,                      2,                  5,
            5,                      5,                  0,
            0,                      0,                  'imgalt5',
            0,                      0,                  0,
            0,                      0,                  0
            ),
    );

    var $pos_assignment_data = array(
        array('id', 'fullname', 'shortname', 'timecreated', 'timemodified', 'usermodified', 'userid', 'positionid', 'type', 'managerid', 'managerpath'),
        array(1, 'Test Assignment 1', 'Test 1', 1326139001, 1326139001, 1, 2, 1, 1, 1, '/1/2'),
        array(2, 'Test Assignment 2', 'Test 2', 1326139105, 1326139105, 1, 3, 1, 1, 1, '/1/3'),
        array(3, 'Test Assignment 3', 'Test 3', 1326139697, 1326139697, 1, 1, 1, 1, null, '/1'),
        array(4, 'Test Assignment 5', 'Test 5', 1326139697,1326139697, 1, 5, 1, 1, null, '/5'),
    );

    var $role_assignments_data = array(
        array('id', 'roleid', 'contextid', 'userid', 'hidden',
            'timestart', 'timeend'),
        array(1,  1,  1,  2,  0,  0,  0),
        array(2,  2,  2,  2,  1,  0,  0),
        array(3,  3,  3,  3,  0,  0,  0),
        array(4,  2,  3,  2,  0,  0,  0),
    );

    var $prog_pos_assignment_data = array(
        array('id', 'userid', 'positionid', 'type', 'timeassigned'),
        array(1, 1, 3, 1, 1326143871),
        array(2, 2, 1, 1, 1326143871),
    );

    var $pos_data = array(
        array('id', 'shortname', 'frameworkid', 'path', 'visible', 'timecreated', 'timemodified', 'usermodified', 'parentid', 'typeid'),
        array(1, 'pos1', 1, '/1', 1, 1298947833, 1298947833, 1, 0, 0),
        array(2, 'pos2', 1, '/2', 1, 1298947833, 1298947833, 1, 0, 0),
    );

    var $pos_framework_data = array(
        array('id', 'shortname', 'sortorder', 'timecreated', 'timemodified', 'usermodified', 'visible', 'hidecustomfields', 'fullname'),
        array(1, 'all pos', 1, 1298947578, 1298947578, 1, 1, 0, 'All Positions'),
    );


    function setup() {
        // function to load test tables
        global $db,$CFG;
        parent::setUp();

        // try statement temporary - rebuilds error'ed tables
        // without having to manually disable setup / teardown functions
        try {
            load_test_table($CFG->prefix . 'role_assignments', $this->role_assignments_data, $db);
            load_test_table($CFG->prefix . 'pos_framework', $this->pos_framework_data, $db);
            load_test_table($CFG->prefix . 'pos', $this->pos_data, $db);
            load_test_table($CFG->prefix . 'prog_pos_assignment', $this->prog_pos_assignment_data, $db);
            load_test_table($CFG->prefix . 'user', $this->user_data, $db);
            load_test_table($CFG->prefix . 'pos_assignment', $this->pos_assignment_data, $db);
        }
        catch (Exception $e) {
            tearDown();
            //setup();
        }

        // pos_assignment object (used for creating new pos_assignment)
        $this->pos_assignment[0] = new stdClass();
        $this->pos_assignment[0]->fullname = 'Test Assignment 5';
        $this->pos_assignment[0]->shortname = 'Test 5';
        $this->pos_assignment[0]->timecreated = 1326139697;
        $this->pos_assignment[0]->timemodified = 1326139697;
        $this->pos_assignment[0]->usermodified = 1;
        $this->pos_assignment[0]->userid = 4;
        $this->pos_assignment[0]->positionid = 1;
        $this->pos_assignment[0]->type = 1;
    }

    function tearDown() {
        global $db, $CFG;

        remove_test_table($CFG->prefix . 'role_assignments', $db);
        remove_test_table($CFG->prefix . 'user', $db);
        remove_test_table($CFG->prefix . 'pos_assignment', $db);
        remove_test_table($CFG->prefix . 'pos', $db);
        remove_test_table($CFG->prefix . 'pos_framework', $db);
        remove_test_table($CFG->prefix . 'prog_pos_assignment', $db);

        parent::tearDown();
    }

    function test_assign_top_level_user() {
        //Assign to top level user
        //Assign B->A then check B
        $assignment = new position_assignment(array('userid' => 2, 'type' => 1));
        $assignment->managerid = 5;

        assign_user_position($assignment, true);

        if (!$field = get_field('pos_assignment', 'managerpath', 'userid', 2)) {
            $this->fail();
        }
        //Check correct path
        $this->assertEqual($field, '/5/2');


        //Reassign A and check B updates correctly
        $assignment2 = new position_assignment(array('userid' => 5, 'type' => 1));
        $assignment2->managerid = 3;
        assign_user_position($assignment2, true);

        if (!$field = get_field('pos_assignment', 'managerpath', 'userid', 2)) {
            $this->fail();
        }
        //Check correct path
        $this->assertEqual($field, '/1/3/5/2');
    }

    function test_assign_lower_level_user() {
        //Assign to a lower level user
        //Assign B->A where A is assigned to X
        $assignment = new position_assignment(array('userid' => 5, 'type' => 1));
        $assignment->managerid = 2;
        assign_user_position($assignment, true);

        if (!$field = get_field('pos_assignment', 'managerpath', 'userid', 5)) {
            $this->fail();
        }
        $this->assertEqual($field, '/1/2/5');

        //Reassign A to a new parent and check B is updated
        $assignment2 = new position_assignment(array('userid' => 2, 'type' => 1));
        $assignment2->managerid = 3;
        assign_user_position($assignment2, true);

        if (!$field = get_field('pos_assignment', 'managerpath', 'userid', 5)) {
            $this->fail();
        }
        $this->assertEqual($field, '/1/3/2/5');
    }

    function test_assign_to_user_wo_assignment() {
        //Assign to a user without a position assignment
        //Assign B->A where a doens't have a pos_assignment record

        $assignment = new position_assignment(array('userid' => 5, 'type' => 1));
        $assignment->managerid = 4;
        assign_user_position($assignment, true);

        if (!$field = get_field('pos_assignment', 'managerpath', 'userid', 5)) {
            $this->fail();
        }
        $this->assertEqual($field, '/4/5');


        $assignment2 = new position_assignment($this->pos_assignment[0]);
        $assignment2->managerid = 3;
        assign_user_position($assignment2, true);

        //Assign A->C and check B updates correctly
        if (!$field = get_field('pos_assignment', 'managerpath', 'userid', 5)) {
            $this->fail();
        }
        $this->assertEqual($field, '/1/3/4/5');
    }
}


?>
